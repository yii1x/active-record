<?php
/**
 * DbTableSchema class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link https://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace Yii1x\ActiveRecord\Db\Schema;

/**
 * CDbTableSchema is the base class for representing the metadata of a database table.
 *
 * It may be extended by different DBMS driver to provide DBMS-specific table metadata.
 *
 * CDbTableSchema provides the following information about a table:
 * <ul>
 * <li>{@link name}</li>
 * <li>{@link rawName}</li>
 * <li>{@link columns}</li>
 * <li>{@link primaryKey}</li>
 * <li>{@link foreignKeys}</li>
 * <li>{@link sequenceName}</li>
 * </ul>
 *
 * @property array $columnNames List of column names.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db.schema
 * @since 1.0
 */
class DbTableSchema
{
    /**
     * @var string name of this table.
     */
    public ?string $name = null;
    /**
     * @var string raw name of this table. This is the quoted version of table name with optional schema name. It can be directly used in SQLs.
     */
    public ?string $rawName = null;
    /**
     * @var string|array primary key name of this table. If composite key, an array of key names is returned.
     */
    public $primaryKey = null;
    /**
     * @var string sequence name for the primary key. Null if no sequence.
     */
    public $sequenceName = null;
    /**
     * @var array foreign keys of this table. The array is indexed by column name. Each value is an array of foreign table name and foreign column name.
     */
    public array $foreignKeys = [];
    /**
     * @var array column metadata of this table. Each array element is a CDbColumnSchema object, indexed by column names.
     */
    public array $columns = [];

    /**
     * Gets the named column metadata.
     * This is a convenient method for retrieving a named column even if it does not exist.
     * @param string $name column name
     * @return DbColumnSchema metadata of the named column. Null if the named column does not exist.
     */
    public function getColumn(string $name): ?DbColumnSchema
    {
        return $this->columns[$name] ?? null;
    }

    /**
     * @return array list of column names
     */
    public function getColumnNames(): array
    {
        return array_keys($this->columns);
    }
}
