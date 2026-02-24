<?php
/**
 * CCubridTableSchema class file.
 *
 * @author Esen Sagynov <kadismal@gmail.com>
 * @link https://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace Yii1x\ActiveRecord\Db\Schema\Cubrid;

use Yii1x\ActiveRecord\Db\Schema\DbTableSchema;

/**
 * CCubridTableSchema represents the metadata for a CUBRID database table.
 *
 * @author Esen Sagynov <kadismal@gmail.com>
 * @package system.db.schema.cubrid
 * @since 1.1.16
 */
class CubridTableSchema extends DbTableSchema
{
    /**
     * @var string name of the schema (database) that this table belongs to.
     * Defaults to null, meaning no schema (or the current database).
     */
    public $schemaName;
}
