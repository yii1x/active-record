<?php
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 */

namespace Yii1x\ActiveRecord;

use ReflectionClass;
use Yii1x\ActiveRecord\Attributes\Database;
use Yii1x\ActiveRecord\Attributes\Table;
use Yii1x\ActiveRecord\Exceptions\DbException;
use Yii1x\ActiveRecord\Db\Schema\DbTableSchema;

class ActiveRecordMetaData
{
    /**
     * @var DbTableSchema the table schema information
     */
    public DbTableSchema $tableSchema;
    /**
     * @var array table columns
     */
    public array $columns = [];
    /**
     * @var array list of relations
     */
    public array $relations = [];
    /**
     * @var array attribute default values
     */
    public array $attributeDefaults = [];

    private string $_modelClassName;

    /**
     * Constructor.
     * @param ActiveRecord $model the model instance
     * @throws DbException if specified table for active record class cannot be found in the database
     */
    public function __construct(ActiveRecord $model)
    {
        $this->_modelClassName = get_class($model);
        if (($table = $model->getDbConnection()->getSchema()->getTable($model->tableName())) === null) {
            throw new DbException(
                sprintf(
                    'The table "%s" for active record class "%s" cannot be found in the database.',
                    $model->tableName(),
                    $this->_modelClassName,
                )
            );
        }

        if (($modelPk = $model->primaryKey()) !== null || $table->primaryKey === null) {
            $table->primaryKey = $modelPk;
            if (is_string($table->primaryKey) && isset($table->columns[$table->primaryKey]))
                $table->columns[$table->primaryKey]->isPrimaryKey = true;
            elseif (is_array($table->primaryKey)) {
                foreach ($table->primaryKey as $name) {
                    if (isset($table->columns[$name]))
                        $table->columns[$name]->isPrimaryKey = true;
                }
            }
        }
        $this->tableSchema = $table;
        $this->columns = $table->columns;

        foreach ($table->columns as $name => $column) {
            if (!$column->isPrimaryKey && $column->defaultValue !== null)
                $this->attributeDefaults[$name] = $column->defaultValue;
        }

        foreach ($model->relations() as $name => $config) {
            $this->addRelation($name, $config);
        }
    }

    /**
     * Adds a relation.
     *
     * $config is an array with three elements:
     * relation type, the related active record class and the foreign key.
     *
     * @param string $name $name Name of the relation.
     * @param array $config $config Relation parameters.
     * @return void
     * @throws DbException
     * @since 1.1.2
     */
    public function addRelation(string $name, array $config): void
    {
        if (isset($config[0], $config[1], $config[2]))  // relation class, AR class, FK
            $this->relations[$name] = new $config[0]($name, $config[1], $config[2], array_slice($config, 3));
        else {
            throw new DbException(
                sprintf(
                    'Active record "%s" has an invalid configuration for relation "%s". It must specify the relation type, the related active record class and the foreign key.',
                    $this->_modelClassName,
                    $name,
                )
            );
        }
    }

    /**
     * Checks if there is a relation with specified name defined.
     *
     * @param string $name $name Name of the relation.
     * @return boolean
     * @since 1.1.2
     */
    public function hasRelation($name)
    {
        return isset($this->relations[$name]);
    }

    /**
     * Deletes a relation with specified name.
     *
     * @param string $name $name
     * @return void
     * @since 1.1.2
     */
    public function removeRelation($name)
    {
        unset($this->relations[$name]);
    }
}
