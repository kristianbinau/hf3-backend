<?php

/**
 * @property string $table
 */
interface IAbstractOrm
{
    /**
     * Fetch & return one record only.
     */
    public const FETCH_ONE = 1;

    /**
     * Fetch multiple records.
     */
    public const FETCH_MANY = 2;

    /**
     * Retrieve a record by its primary key (PK).
     *
     * @access public
     * @static
     * @param int $pk
     * @return Object
     */
    public static function retrieveByPK(int $pk): object;

    /**
     * Retrieve a record by a particular column name.
     *
     * @access public
     * @static
     * @param string $field
     * @param mixed $value
     * @param int $return
     * @return Object|Object[]
     */
    public static function retrieveByField(string $field, mixed $value, int $return = self::FETCH_MANY): object|array;

    /**
     * Save to the database.
     *
     * @access public
     * @return void
     */
    public function save(): void;
}
