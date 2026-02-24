<?php

namespace Yii1x\ActiveRecord\Relations;

use Yii1x\ActiveRecord\Exceptions\DbException;

class ManyManyRelation extends HasManyRelation
{
    /**
     * @var string name of the junction table for the many-to-many relation.
     */
    private $_junctionTableName = null;
    /**
     * @var array list of foreign keys of the junction table for the many-to-many relation.
     */
    private $_junctionForeignKeys = null;

    /**
     * @return string junction table name.
     * @since 1.1.12
     */
    public function getJunctionTableName()
    {
        if ($this->_junctionTableName === null)
            $this->initJunctionData();
        return $this->_junctionTableName;
    }

    /**
     * @return array list of junction table foreign keys.
     * @since 1.1.12
     */
    public function getJunctionForeignKeys()
    {
        if ($this->_junctionForeignKeys === null)
            $this->initJunctionData();
        return $this->_junctionForeignKeys;
    }

    /**
     * Initializes values of {@link junctionTableName} and {@link junctionForeignKeys} parsing
     * {@link foreignKey} value.
     * @throws DbException if {@link foreignKey} has been specified in wrong format.
     */
    private function initJunctionData()
    {
        if (!preg_match('/^\s*(.*?)\((.*)\)\s*$/', $this->foreignKey, $matches)) {
            throw new DbException(sprintf('The relation "%s" in active record class "%s" is specified with an invalid foreign key. The format of the foreign key must be "joinTable(fk1,fk2,...)".', $this->name, $this->className));
        }
        $this->_junctionTableName = $matches[1];
        $this->_junctionForeignKeys = preg_split('/\s*,\s*/', $matches[2], -1, PREG_SPLIT_NO_EMPTY);
    }
}
