<?php
/*
 * This file is part of the Bushido\Foundation package.
 *
 * (c) Wojciech Nowicki <wnowicki@me.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BushidoTests\Foundation\SmartEntity;

use Bushido\Foundation\SmartEntity\FlexEntity;
use Bushido\Foundation\SmartEntity\SmartEntity;

class TestEntity extends SmartEntity
{
    protected $properties = [
        'int_property' => self::TYPE_INT,
        'bool_property' => self::TYPE_BOOL,
        'string_property' => self::TYPE_STRING,
        'numeric_property' => self::TYPE_NUMERIC,
        'float_property' => self::TYPE_FLOAT,
        'array_property' => self::TYPE_ARRAY,
        'flex_property' => FlexEntity::class,
    ];

}
