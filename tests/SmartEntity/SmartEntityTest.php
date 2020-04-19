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

use Bushido\Foundation\Contracts\Makeable;
use Bushido\Foundation\SmartEntity\Entity;
use Bushido\Foundation\SmartEntity\SmartEntity;
use PHPUnit\Framework\TestCase;

class SmartEntityTest extends TestCase
{
    public function testInstance()
    {
        $entity = new TestEntity();

        $this->assertInstanceOf(Makeable::class, $entity);
        $this->assertInstanceOf(Entity::class, $entity);
        $this->assertInstanceOf(SmartEntity::class, $entity);
    }

    public function testMake()
    {
        $entity = TestEntity::make([]);

        $this->assertInstanceOf(SmartEntity::class, $entity);
    }

    public function testToArray()
    {
        $ar = [
            'int_property' => 73,
            'bool_property' => true,
            'string_property' => 'some string',
            'numeric_property' => 34,
            'float_property' => 7.5,
            'array_property' => ['test'],
        ];

        $entity = TestEntity::make($ar);

        $this->assertIsArray($entity->toArray());
        $this->assertSame($ar, $entity->toArray());
    }
}
