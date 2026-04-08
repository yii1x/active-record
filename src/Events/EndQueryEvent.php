<?php

namespace Yii1x\ActiveRecord\Events;

use Yii1x\ActiveRecord\Db\DbConnection;

readonly class EndQueryEvent
{
    public function __construct(
        public string       $queryId,
        public string       $sql,
        public array        $params,
        public float        $duration,
        public string       $connectionName,
        public DbConnection $connection,
    )
    {

    }
}
