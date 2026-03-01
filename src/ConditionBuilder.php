<?php

namespace Yii1x\ActiveRecord;

use Yii1x\ActiveRecord\Db\Schema\DbCriteria;
use Yii1x\ActiveRecord\Exceptions\DbException;
use Yii1x\ActiveRecord\Relations\{ActiveRelation, BelongsToRelation};

class ConditionBuilder
{
    public function __construct(
        protected ActiveRecord $model,
        public DbCriteria      $criteria,
        protected bool         $modelContext = true,
    )
    {

    }

    public function where(string|\Closure $column, mixed $comparison = null, mixed $value = null, $operator = 'AND'): static
    {
        if ($column instanceof \Closure) {
            $column($cb = new ConditionBuilder($this->model, new DbCriteria(), $this->modelContext));
            $this->criteria->mergeWith($cb->criteria);
        } else {
            if ($value === null) {
                $value = $comparison;
                $comparison = '=';
            }
            $this->criteria->compare($column, $comparison . $value, operator: $operator);
        }
        return $this;
    }

    public function whereIn(string $column, array $value, $operator = 'AND'): static
    {
        $this->criteria->addInCondition($column, $value, $operator);
        return $this;
    }

    public function whereNotIn(string $column, array $value, $operator = 'AND'): static
    {
        $this->criteria->addNotInCondition($column, $value, $operator);
        return $this;
    }

    public function whereRaw(string $condition, string $operator = 'AND'): static
    {
        $this->criteria->addCondition($condition, $operator);
        return $this;
    }

    public function whereHas(string $tableName, ?\Closure $callback = null, string $operator = 'AND', ?string $tableAlias = null): static
    {
        $tableAlias ??= $tableName;
        $conditionBuilder = new static($this->model, new DbCriteria(['select' => '1', 'alias' => $tableAlias]), false);
        if ($callback) {
            $callback($conditionBuilder);
        }
        $cmd = $this->model->commandBuilder->createFindCommand($tableName, $conditionBuilder->criteria, $tableAlias);
        $this->whereRaw('EXISTS(' . $cmd->getText() . ')', $operator);
        $this->criteria->params += $conditionBuilder->criteria->params;
        return $this;
    }

    /**
     * Build where exists condition
     * @param string $relation
     * @param \Closure $callback
     * @param string $operator
     * @param string|null $relAlias
     * @return $this
     */
    public function whereRelation(string $relation, ?\Closure $callback = null, string $operator = 'AND', ?string $relAlias = null): static
    {
        if (!$this->modelContext) {
            throw new DbException('Model context not set');
        }
        /** @var ActiveRelation $rel */
        if (!$rel = $this->model->getActiveRelation($relation)) {
            throw new DbException('Relation "' . $relation . '" does not exist.');
        }
        $relAlias ??= $relation;
        $relModel = ActiveRecord::model($rel->className);
        if ($rel instanceof BelongsToRelation) {
            $fkMap = is_string($rel->foreignKey) ? [$rel->foreignKey => $this->model->getTableSchema()->primaryKey] : $rel->foreignKey;
        } else {
            $fkMap = is_string($rel->foreignKey) ? [$rel->foreignKey => $relModel->getTableSchema()->primaryKey] : $rel->foreignKey;
            $fkMap = array_flip($fkMap);
        }

        $conditionBuilder = new static($relModel, new DbCriteria(['select' => '1', 'alias' => $relAlias]));
        if ($callback) {
            $callback($conditionBuilder);
        }
        foreach ($fkMap as $pk => $fk) {
            if (is_array($pk) || is_array($fk)) {
                throw new DbException("Relation '{$relation}' has composite key. " . "Define all fields explicitly in foreignKey array.");
            }
            $conditionBuilder->whereRaw("{$relAlias}.{$fk} = {$this->criteria->alias}.{$pk}");
        }
        $cmd = $relModel->commandBuilder->createFindCommand($relModel->tableName(), $conditionBuilder->criteria, $relAlias);
        $this->whereRaw('EXISTS(' . $cmd->getText() . ')', $operator);
        $this->criteria->params += $conditionBuilder->criteria->params;
        return $this;
    }

}
