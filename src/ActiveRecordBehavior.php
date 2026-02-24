<?php
/**
 * ActiveRecordBehavior class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link https://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace Yii1x\ActiveRecord;

use Yii1x\ActiveRecord\Model\Event;
use Yii1x\ActiveRecord\Model\ModelBehavior;
use Yii1x\ActiveRecord\Model\ModelEvent;

/**
 * CActiveRecordBehavior is the base class for behaviors that can be attached to {@link ActiveRecord}.
 * Compared with {@link ModelBehavior}, CActiveRecordBehavior attaches to more events
 * that are only defined by {@link ActiveRecord}.
 *
 * @property ActiveRecord $owner The owner AR that this behavior is attached to.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.db.ar
 */
class ActiveRecordBehavior extends ModelBehavior
{
    /**
     * Declares events and the corresponding event handler methods.
     * If you override this method, make sure you merge the parent result to the return value.
     * @return array events (array keys) and the corresponding event handler methods (array values).
     * @see Behavior::events
     */
    public function events(): array
    {
        return array_merge(parent::events(), array(
            'onBeforeSave' => 'beforeSave',
            'onAfterSave' => 'afterSave',
            'onBeforeDelete' => 'beforeDelete',
            'onAfterDelete' => 'afterDelete',
            'onBeforeFind' => 'beforeFind',
            'onAfterFind' => 'afterFind',
            'onBeforeCount' => 'beforeCount',
        ));
    }

    /**
     * Responds to {@link ActiveRecord::onBeforeSave} event.
     * Override this method and make it public if you want to handle the corresponding
     * event of the {@link Behavior::owner owner}.
     * You may set {@link ModelEvent::isValid} to be false to quit the saving process.
     * @param ModelEvent $event event parameter
     */
    protected function beforeSave(ModelEvent $event)
    {
    }

    /**
     * Responds to {@link ActiveRecord::onAfterSave} event.
     * Override this method and make it public if you want to handle the corresponding event
     * of the {@link Behavior::owner owner}.
     * @param Event $event event parameter
     */
    protected function afterSave(Event $event)
    {
    }

    /**
     * Responds to {@link ActiveRecord::onBeforeDelete} event.
     * Override this method and make it public if you want to handle the corresponding event
     * of the {@link Behavior::owner owner}.
     * You may set {@link ModelEvent::isValid} to be false to quit the deletion process.
     * @param Event $event event parameter
     */
    protected function beforeDelete(Event $event)
    {
    }

    /**
     * Responds to {@link ActiveRecord::onAfterDelete} event.
     * Override this method and make it public if you want to handle the corresponding event
     * of the {@link Behavior::owner owner}.
     * @param Event $event event parameter
     */
    protected function afterDelete(Event $event)
    {
    }

    /**
     * Responds to {@link ActiveRecord::onBeforeFind} event.
     * Override this method and make it public if you want to handle the corresponding event
     * of the {@link Behavior::owner owner}.
     * @param Event $event event parameter
     */
    protected function beforeFind(Event $event)
    {
    }

    /**
     * Responds to {@link ActiveRecord::onAfterFind} event.
     * Override this method and make it public if you want to handle the corresponding event
     * of the {@link Behavior::owner owner}.
     * @param Event $event event parameter
     */
    protected function afterFind(Event $event)
    {
    }

    /**
     * Responds to {@link ActiveRecord::onBeforeCount} event.
     * Override this method and make it public if you want to handle the corresponding event
     * of the {@link Behavior::owner owner}.
     * @param Event $event event parameter
     * @since 1.1.14
     */
    protected function beforeCount(Event $event)
    {
    }
}
