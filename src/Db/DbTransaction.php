<?php
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link https://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace Yii1x\ActiveRecord\Db;

use Yii1x\ActiveRecord\Exceptions\DbException;

/**
 * CDbTransaction represents a DB transaction.
 *
 * It is usually created by calling {@link DbConnection::beginTransaction}.
 *
 * The following code is a common scenario of using transactions:
 * <pre>
 * $transaction=$connection->beginTransaction();
 * try
 * {
 *    $connection->createCommand($sql1)->execute();
 *    $connection->createCommand($sql2)->execute();
 *    //.... other SQL executions
 *    $transaction->commit();
 * }
 * catch(Exception $e)
 * {
 *    $transaction->rollback();
 * }
 * </pre>
 *
 * @property DbConnection $connection The DB connection for this transaction.
 * @property boolean $active Whether this transaction is active.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db
 * @since 1.0
 */
class DbTransaction
{

    public function __construct(
        private readonly ?DbConnection $_connection = null,
        private bool                   $_active = true
    )
    {
    }

    /**
     * Commits a transaction.
     * @throws DbException if the transaction or the DB connection is not active.
     */
    public function commit(): void
    {
        if ($this->_active && $this->_connection->getActive()) {
            if ($this->_connection->getPdoInstance()->inTransaction())
                $this->_connection->getPdoInstance()->commit();
            $this->_active = false;
        } else
            throw new DbException('DbTransaction is inactive and cannot perform commit or roll back operations.');
    }

    /**
     * Rolls back a transaction.
     * @throws DbException if the transaction or the DB connection is not active.
     */
    public function rollback(): void
    {
        if ($this->_active && $this->_connection->getActive()) {
            if ($this->_connection->getPdoInstance()->inTransaction())
                $this->_connection->getPdoInstance()->rollBack();
            $this->_active = false;
        } else
            throw new DbException('DbTransaction is inactive and cannot perform commit or roll back operations.');
    }

    /**
     * @return DbConnection|null the DB connection for this transaction
     */
    public function getConnection(): ?DbConnection
    {
        return $this->_connection;
    }

    /**
     * @return boolean whether this transaction is active
     */
    public function getActive(): bool
    {
        return $this->_active;
    }

    /**
     * @param boolean $value whether this transaction is active
     */
    protected function setActive(bool $value): void
    {
        $this->_active = $value;
    }
}
