<?php
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link https://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace Yii1x\ActiveRecord\Db\Schema\Pgsql;

use Yii1x\ActiveRecord\Db\Schema\DbTableSchema;

class PgsqlTableSchema extends DbTableSchema
{
    /**
     * @var string|null name of the schema that this table belongs to.
     */
    public ?string $schemaName = null;
}
