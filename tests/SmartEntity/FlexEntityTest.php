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
use Bushido\Foundation\SmartEntity\FlexEntity;
use \PHPUnit\Framework\TestCase;

class FlexEntityTest extends TestCase
{
    public function testInstance()
    {
        $entity = new FlexEntity();

        $this->assertInstanceOf(Makeable::class, $entity);
        $this->assertInstanceOf(Entity::class, $entity);
        $this->assertInstanceOf(FlexEntity::class, $entity);
    }

    public function testMake()
    {
        $entity = FlexEntity::make(['a' => 1, 'b' => 2]);

        $this->assertSame(1, $entity->getA());
    }

    public function testToArray()
    {
        $ar = ['a' => 1, 'b' => 2];
        $entity = FlexEntity::make($ar);

        $this->assertSame($ar, $entity->toArray());
    }

    public function testToString()
    {
        $ar = ['a' => 1, 'b' => 2];
        $entity = FlexEntity::make($ar);

        $this->assertSame('{"a":1,"b":2}', (string) $entity);
    }

    public function testGetSet()
    {
        $entity = new FlexEntity();

        $this->assertSame($entity, $entity->setX('bbc'));
        $this->assertSame('bbc', $entity->getX());
    }

    public function testAdd()
    {
        $entity = new FlexEntity();

        $this->assertSame($entity, $entity->addX('bbc'));
        $this->assertIsArray($entity->getX());
        $this->assertSame(['bbc'], $entity->getX());
    }

    public function testToJson()
    {
        $entity = FlexEntity::make(['a' => 1, 'b' => 2]);

        $this->assertSame('{"a":1,"b":2}', $entity->toJson());
    }
}
