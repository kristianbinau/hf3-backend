<?php

require('IAbstractOrm.php');

abstract class AbstractOrm implements IAbstractOrm
{
    protected static PDO $pdo;
    protected static string $primaryKey = 'id';
    protected static string $table;

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
     */
    final public function __construct($data = null)
    {
        // TODO: Implement __construct() method.
        $this->initialise();
    }

    /**
     * @inheritDoc
     */
    public static function retrieveByPK(int $pk): object
    {
        // TODO: Implement retrieveByPK() method.
    }

    /**
     * @inheritDoc
     */
    public static function retrieveByField(string $field, mixed $value, int $return = self::FETCH_MANY): object|array
    {
        // TODO: Implement retrieveByField() method.
    }

    /**
     * @inheritDoc
     */
    public function save(): void
    {
        // TODO: Implement save() method.
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
