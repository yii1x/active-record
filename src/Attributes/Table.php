<?php

namespace Yii1x\ActiveRecord\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class Table
{
    public function __construct(public string $name)
    {
    }
}