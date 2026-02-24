<?php

namespace Yii1x\ActiveRecord\Model;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link https://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */
class ModelBehavior extends Behavior
{
    /**
     * Declares events and the corresponding event handler methods.
     * The default implementation returns 'onAfterConstruct', 'onBeforeValidate' and 'onAfterValidate' events and handlers.
     * If you override this method, make sure you merge the parent result to the return value.
     * @return array events (array keys) and the corresponding event handler methods (array values).
     * @see Behavior::events
     */
    public function events(): array
    {
        return [
            'onAfterConstruct' => 'afterConstruct',
            'onBeforeValidate' => 'beforeValidate',
            'onAfterValidate' => 'afterValidate',
        ];
    }

    /**
     * Responds to {@link Model::onAfterConstruct} event.
     * Override this method and make it public if you want to handle the corresponding event
     * of the {@link Behavior::owner owner}.
     * @param Event $event event parameter
     */
    protected function afterConstruct(Event $event)
    {
    }

    /**
     * Responds to {@link Model::onBeforeValidate} event.
     * Override this method and make it public if you want to handle the corresponding event
     * of the {@link owner}.
     * You may set {@link ModelEvent::isValid} to be false to quit the validation process.
     * @param ModelEvent $event event parameter
     */
    protected function beforeValidate(Event $event)
    {
    }

    /**
     * Responds to {@link Model::onAfterValidate} event.
     * Override this method and make it public if you want to handle the corresponding event
     * of the {@link owner}.
     * @param ModelEvent $event event parameter
     */
    protected function afterValidate(ModelEvent $event)
    {
    }
}
