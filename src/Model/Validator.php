<?php

namespace Yii1x\ActiveRecord\Model;

use Yii1x\Validator\Rules\{BooleanRule,
    CompareRule,
    DateRule,
    DefaultValueRule,
    EmailRule,
    FileRule,
    FilterRule,
    NumberRule,
    RangeRule,
    RegularExpressionRule,
    RequiredRule,
    SafeRule,
    StringRule,
    TypeRule,
    UnsafeRule,
    UrlRule};
use Yii1x\ActiveRecord\Model\Rules\ExistRule;
use Yii1x\ActiveRecord\Model\Rules\UniqueRule;

class Validator extends \Yii1x\Validator\Validator
{
    protected static array $ruleAlias = [
        'required' => RequiredRule::class,
        'filter' => FilterRule::class,
        'match' => RegularExpressionRule::class,
        'email' => EmailRule::class,
        'url' => UrlRule::class,
        'compare' => CompareRule::class,
        'length' => StringRule::class,
        'in' => RangeRule::class,
        'numerical' => NumberRule::class,
        'type' => TypeRule::class,
        'file' => FileRule::class,
        'default' => DefaultValueRule::class,
        'boolean' => BooleanRule::class,
        'safe' => SafeRule::class,
        'unsafe' => UnsafeRule::class,
        'date' => DateRule::class,
        'unique' => UniqueRule::class,
        'exist' => ExistRule::class,
    ];
}
