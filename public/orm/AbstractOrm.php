<?php

use JetBrains\PhpStorm\Pure;

abstract class AbstractOrm implements IAbstractOrm
{
    /**
     * Orm properties.
     */
    protected static PDO $pdo;
    protected static string $primaryKey = 'id';
    protected static string $table;
    private bool $isNew = false;

    /**
     * Loading options.
     */
    public const
        LOAD_BY_PK = 1,
        LOAD_EMPTY = 2;

    /**
     * Executed just after the record has loaded.
     * Abstract for heirs.
     *
     * @access protected
     * @return void
     */
    abstract protected function initialise(): void;

    /**
     * Constructor.
     *
     * @access public
     * @param mixed $data
     * @param integer $method
     * @return void
     * @throws Exception
     */
    final public function __construct(mixed $data = null, int $method = self::LOAD_EMPTY)
    {
        switch ($method) {
            case self::LOAD_BY_PK:
                $this->buildById($data);
                break;

            case self::LOAD_EMPTY:
                $this->buildEmpty();
                break;
        }

        $this->initialise();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function save(): void
    {
        if ($this->isNew()) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(): void
    {
        $sql = 'DELETE FROM users WHERE id=:id';
        $stmt= self::getConn()->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @inheritDoc
     * @throws ReflectionException
     */
    public static function retrieveByPK(int $pk): object
    {
        $reflectionObj = new ReflectionClass(static::class);

        return $reflectionObj->newInstanceArgs([$pk, self::LOAD_BY_PK]);
    }

    /**
     * @inheritDoc
     * @throws Exception
     * @throws ReflectionException
     */
    public static function retrieveByField(string $field, mixed $value, int $return = self::FETCH_MANY): object|array
    {
        $sql = sprintf(
            'SELECT %s FROM %s WHERE %s = :value',
            self::getTablePk(),
            self::getTableName(),
            $field
        );

        if ($return === self::FETCH_ONE) {
            $sql .= ' LIMIT 0,1';
        }

        $stmt = self::getConn()->prepare($sql);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt === false) {
            throw new Exception('Unable to fetch the column names.');
        }

        $rows = [];
        foreach ($stmt as $row) {
            $rows[] = self::retrieveByPK($row[self::getTablePk()]);
        }

        return $rows;
    }


    /** Construct new instances. */

    /**
     * Fetch the data from the database.
     *
     * @access private
     * @param int $id
     * @return void
     * @throws Exception
     */
    private function buildById(int $id): void
    {
        $stmt = self::getConn()->prepare(
            sprintf(
                'SELECT * FROM `%s` WHERE `%s` = :id;',
                self::getTableName(),
                self::getTablePk()
            )
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($row)) {
            throw new Exception(sprintf('%s record not found in database. (PK: %s)', static::class, $id));
        }

        foreach ($row as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Generate object with null values.
     * Fetches column names using DESCRIBE.
     *
     * @access private
     * @return void
     * @throws Exception
     */
    private function buildEmpty(): void
    {
        foreach ($this->getColumnNames() as $field) {
            $this->{$field} = null;
        }

        $this->isNew = true;
    }


    /** Insert and update instances. */

    /**
     * Insert into DB from properties of $this.
     *
     * @throws Exception
     */
    private function insert(): void
    {
        [$insertColumns, $insertData, $updateColumnsAndData] = $this->insertUpdatePDOStrings();

        $sql = sprintf(
            'INSERT INTO `%s` (%s) VALUES (%s)',
            self::getTableName(),
            $insertColumns,
            $insertData
        );

        $stmt = self::getConn()->prepare($sql);
        $this->insertUpdatePDOBinds($stmt);

        $stmt->execute();
        $id = self::getConn()->lastInsertId();

        $this->id = $id;
        $this->isNew = false;
    }

    /**
     * Update DB from properties of $this.
     *
     * @throws Exception
     */
    private function update(): void
    {
        [$insertColumns, $insertData, $updateColumnsAndData] = $this->insertUpdatePDOStrings();

        $sql = sprintf(
            'UPDATE `%s` SET %s WHERE id=:id',
            self::getTableName(),
            $updateColumnsAndData
        );

        $stmt = self::getConn()->prepare($sql);
        $this->insertUpdatePDOBinds($stmt);

        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Take table columns and create insert and update string for PDO.
     *
     * @access private
     * @return array
     * @throws Exception
     */
    private function insertUpdatePDOStrings(): array
    {
        $columnNames = $this->getColumnNames();

        $insertColumns = [];
        $insertData = [];
        $updateColumnsAndData = [];

        foreach ($columnNames as $columnName) {
            if ($columnName === 'id') {
                continue;
            }

            switch (gettype($this->{$columnName})) {
                case 'string':
                case 'integer':
                case 'boolean':
                    break;

                default:
                    continue 2; // Continue foreach
            }

            $insertColumns[] = $columnName;
            $insertData[] = ':' . $columnName;
            $updateColumnsAndData[] = $columnName . '=:' . $columnName;
        }

        $insertColumns = implode(', ', $insertColumns);
        $insertData = implode(', ', $insertData);
        $updateColumnsAndData = implode(', ', $updateColumnsAndData);

        return [$insertColumns, $insertData, $updateColumnsAndData];
    }

    /**
     * Take table columns and bind values for PDO..
     *
     * @access private
     * @param PDOStatement $stmt
     * @throws Exception
     */
    private function insertUpdatePDOBinds(PDOStatement $stmt): void
    {
        $columnNames = $this->getColumnNames();

        foreach ($columnNames as $columnName) {
            if ($columnName === 'id') {
                continue;
            }

            switch (gettype($this->{$columnName})) {
                case 'string':
                    $stmt->bindParam(':' . $columnName, $this->{$columnName}, PDO::PARAM_STR);
                    break;

                case 'integer':
                    $stmt->bindParam(':' . $columnName, $this->{$columnName}, PDO::PARAM_INT);
                    break;

                case 'boolean':
                    $stmt->bindParam(':' . $columnName, $this->{$columnName}, PDO::PARAM_BOOL);
                    break;

                default:
                    continue 2; // Continue foreach
            }
        }
    }


    /** Get info about instances. */

    /**
     * Get the table name for class.
     *
     * @access private
     * @static
     * @return string
     * @throws Exception
     */
    private static function getTableName(): string
    {
        return static::$table ?? throw new Exception('Table not defined.');
    }

    /**
     * Fetch column names directly from Database.
     *
     * @access private
     * @return array
     * @throws Exception
     */
    private function getColumnNames(): array
    {
        $stmt = self::getConn()->query(
            sprintf(
                'DESCRIBE %s;',
                self::getTableName()
            )
        );

        if ($stmt === false) {
            throw new Exception('Unable to fetch the column names.');
        }

        $columns = [];
        foreach ($stmt as $row) {
            $columns[] = $row['Field'];
        }

        return $columns;
    }

    /**
     * Get the PK field name for class.
     *
     * @access private
     * @static
     * @return string
     */
    private static function getTablePk(): string
    {
        return static::$primaryKey;
    }

    /**
     * Check if new
     *
     * @access public
     * @return boolean
     */
    protected function isNew(): bool
    {
        return $this->isNew;
    }


    /** Database connection. */

    /**
     * @access public
     */
    public static function setConn($host = 'mariadb', $db = 'hf3_backend', $user = 'sail', $pass = 'password', $charset = 'utf8mb4'): void
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // WHY THIS EWW, so close PDO
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
            self::$pdo = $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @access protected
     * @return PDO
     */
    protected static function getConn(): PDO
    {
        return self::$pdo;
    }
 }
