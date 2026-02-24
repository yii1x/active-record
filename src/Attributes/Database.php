<?php

namespace Yii1x\ActiveRecord\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class Database
{
    public function __construct(public string $name)
    {
    }
}
