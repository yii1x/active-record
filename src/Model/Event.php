<?php

namespace Yii1x\ActiveRecord\Model;

/**
 * Event is the base class for all event classes.
 *
 * It encapsulates the parameters associated with an event.
 * The {@link sender} property describes who raises the event.
 * And the {@link handled} property indicates if the event is handled.
 * If an event handler sets {@link handled} to true, those handlers
 * that are not invoked yet will not be invoked anymore.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.base
 * @since 1.0
 */
class Event
{
    /**
     * @var boolean whether the event is handled. Defaults to false.
     * When a handler sets this true, the rest of the uninvoked event handlers will not be invoked anymore.
     */
    public bool $handled = false;

    /**
     * Constructor.
     * @param mixed|null $sender sender of the event
     * @param mixed $params additional parameters for the event
     */
    public function __construct(public mixed $sender = null, public mixed $params = null)
    {
    }
}