<?php

namespace Yii1x\ActiveRecord;

use Yii1x\ActiveRecord\Db\Schema\DbCriteria;

class ConditionBuilder
{
    public function __construct(protected ActiveRecord $model, public DbCriteria $criteria)
    {

    }

    public function where(string|\Closure $column, mixed $comparison = null, mixed $value = null, $operator = 'AND'): static
    {
        if ($column instanceof \Closure) {
            $column($cb = new ConditionBuilder($this->model, new DbCriteria()));
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

    /**
     * Build where exists condition
     * @param string $relation
     * @param \Closure $callback
     * @param string $operator
     * @param string|null $relAlias
     * @return $this
     */
    public function whereRelation(string $relation, \Closure $callback, string $operator = 'AND', string $relAlias = null): static
    {
        $callback(new static($this->model, new DbCriteria()));
    }
}
