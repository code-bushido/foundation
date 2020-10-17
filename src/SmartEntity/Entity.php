<?php
/*
 * This file is part of the Bushido\Foundation package.
 *
 * (c) Wojciech Nowicki <wnowicki@me.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Bushido\Foundation\SmartEntity;

use Bushido\Foundation\Contracts\EntityInterface;
use Bushido\Foundation\Contracts\Jsonable;
use Bushido\Foundation\Contracts\Makeable;

interface Entity extends EntityInterface, Makeable, Jsonable
{
    public const TYPE_ARRAY = 1;
    public const TYPE_BOOL = 2;
    public const TYPE_INT = 4;
    public const TYPE_FLOAT = 8;
    public const TYPE_NUMERIC = 12;
    public const TYPE_STRING = 16;
    public const TYPE_OBJECT = 32;

    public const EXT_ARRAY = '[]';

    public const INTERNAL_TYPES = [
        self::TYPE_ARRAY => 'array',
        self::TYPE_INT => 'int',
        self::TYPE_STRING => 'string',
        self::TYPE_BOOL => 'bool',
        self::TYPE_FLOAT => 'float',
        self::TYPE_NUMERIC => 'numeric',
    ];
}
