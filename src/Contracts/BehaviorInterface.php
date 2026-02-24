<?php

namespace Yii1x\ActiveRecord\Contracts;

use Yii1x\ActiveRecord\Model\CComponent;

interface BehaviorInterface
{
    /**
     * Attaches the behavior object to the component.
     * @param CComponent $component the component that this behavior is to be attached to.
     */
    public function attach(CComponent $component);

    /**
     * Detaches the behavior object from the component.
     * @param CComponent $component the component that this behavior is to be detached from.
     */
    public function detach(CComponent $component);

    /**
     * @return boolean whether this behavior is enabled
     */
    public function getEnabled(): bool;

    /**
     * @param boolean $value whether this behavior is enabled
     */
    public function setEnabled(bool $value): static;
}