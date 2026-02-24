<?php
/**
 * CMysqlTableSchema class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link https://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace Yii1x\ActiveRecord\Db\Schema\Mysql;

use Yii1x\ActiveRecord\Db\Schema\DbTableSchema;

/**
 * CMysqlTableSchema represents the metadata for a MySQL table.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db.schema.mysql
 * @since 1.0
 */
class MysqlTableSchema extends DbTableSchema
{
    /**
     * @var string name of the schema (database) that this table belongs to.
     * Defaults to null, meaning no schema (or the current database).
     */
    public $schemaName;
}
