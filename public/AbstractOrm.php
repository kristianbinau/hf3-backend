<?php

use JetBrains\PhpStorm\Pure;

require('IAbstractOrm.php');

abstract class AbstractOrm implements IAbstractOrm
{
    protected static PDO $pdo;
    protected static string $primaryKey = 'id';
    protected static string $table;

    /**
     * Loading options.
     */
    const
        LOAD_BY_PK = 1,
        LOAD_BY_ARRAY = 2,
        LOAD_EMPTY = 3;

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
                $this->loadByPK($data);
                break;

            case self::LOAD_BY_ARRAY:
                $this->loadByArray($data);
                break;

            case self::LOAD_EMPTY:
                $this->generateEmpty();
                break;
        }

        $this->initialise();
    }

    /**
     * @inheritDoc
     */
    public static function retrieveByPK(int $pk): object
    {
        $reflectionObj = new ReflectionClass(static::class);

        return $reflectionObj->newInstanceArgs([$pk, self::LOAD_BY_PK]);
    }

    /**
     * @inheritDoc
     */
    public static function retrieveByField(string $field, mixed $value, int $return = self::FETCH_MANY): object|array
    {
        $sql = sprintf(
            "SELECT %s FROM %s WHERE :field = :value",
            self::getTablePk(),
            self::getTableName()
        );

        if ($return === self::FETCH_ONE) {
            $sql .= ' LIMIT 0,1';
        }

        $stmt = self::getConn()->prepare($sql);
        $stmt->bindParam(':field', $field, PDO::PARAM_STR);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt === false) {
            throw new Exception('Unable to fetch the column names.');
        }

        $ids = [];
        foreach ($stmt as $row) {
            $ids[] = $row[self::getTablePk()];
        }

        $rows = [];
        foreach ($ids as $id) {
            $reflectionObj = new ReflectionClass(static::class);

            $rows[] =  $reflectionObj->newInstanceArgs([$id, self::LOAD_BY_PK]);
        }

        return $rows;
    }

    /**
     * @inheritDoc
     */
    public function save(): void
    {
        // TODO: Implement save() method.
    }


    /**
     * Load by Primary Key
     *
     * @access private
     * @param int $id
     * @return void
     * @throws Exception
     */
    private function loadByPK(int $id): void
    {
        $this->{self::getTablePk()} = $id;

        $this->generateFromDatabase();
    }

    /**
     * Fetch the data from the database.
     *
     * @access private
     * @return void
     * @throws Exception If the record is not found.
     */
    private function generateFromDatabase(): void
    {
        $stmt = self::getConn()->prepare(
            sprintf(
                "SELECT * FROM `%s` WHERE `%s` = :id;",
                self::getTableName(),
                self::getTablePk()
            )
        );
        $id = $this->getId();
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($row)) {
            throw new Exception(sprintf("%s record not found in database. (PK: %s)", static::class, $id));
        }

        foreach ($row as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Load by array.
     *
     * @access private
     * @param array $data
     * @return void
     */
    private function loadByArray(array $data): void
    {
        // set our data
        foreach ($this->$data as $key => $value) {
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
    private function generateEmpty(): void
    {
        foreach ($this->getColumnNames() as $field) {
            $this->{$field} = null;
        }
    }


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
     * Get the PK field name for class.
     *
     * @access private
     * @static
     * @return int
     */
    #[Pure] private function getId(): int
    {
        return $this->{static::getTablePk()};
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
                "DESCRIBE %s;",
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
     * @access public
     */
    public static function setConn($host = 'mariadb', $db = 'example_app', $user = 'sail', $pass = 'password', $charset = 'utf8mb4'): void
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
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
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
