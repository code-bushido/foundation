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
use Bushido\Foundation\Exceptions\InvalidArgumentException;
use Bushido\Foundation\SmartEntity\Entity;
use Bushido\Foundation\SmartEntity\FlexEntity;
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

    public function testNotDefined()
    {
        $this->expectException(\RuntimeException::class);

        TestEntity::make([])->setWrong(123);
    }

    public function testWrongInternalType()
    {
        $this->expectException(InvalidArgumentException::class);

        TestEntity::make([])->setBoolProperty(123);
    }

    public function testWrongObjectType()
    {
        $this->expectException(InvalidArgumentException::class);

        TestEntity::make([])->setFlexProperty(123);
    }

    public function testSetObject()
    {
        $entity = TestEntity::make([])->setFlexProperty([]);

        $this->assertInstanceOf(FlexEntity::class, $entity->getFlexProperty());

        $entity->setFlexProperty(FlexEntity::make([]));

        $this->assertInstanceOf(FlexEntity::class, $entity->getFlexProperty());
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
            'flex_property' => [[]],
        ];

        $entity = TestEntity::make($ar);

        $this->assertIsArray($entity->toArray());
        $this->assertSame($ar, $entity->toArray());
    }
}
