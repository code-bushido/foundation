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

    public function testNonExistingMethod()
    {
        $entity = new FlexEntity();

        $this->expectException(\RuntimeException::class);
        $entity->badMethod();
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

    public function testSetEmpty()
    {
        $entity = new FlexEntity();

        $this->expectException(\RuntimeException::class);
        $entity->setX();
    }

    public function testGetEmpty()
    {
        $entity = new FlexEntity();

        $this->assertSame(null, $entity->getX());
    }

    public function testAdd()
    {
        $entity = new FlexEntity();

        $this->assertSame($entity, $entity->addX('bbc'));
        $this->assertIsArray($entity->getX());
        $this->assertSame(['bbc'], $entity->getX());
        $entity->addX('cnn');
        $this->assertSame(['bbc', 'cnn'], $entity->getX());
    }

    public function testAddWithKey()
    {
        $entity = new FlexEntity();

        $this->assertSame($entity, $entity->addX('bbc', 'uk'));
        $this->assertIsArray($entity->getX());
        $this->assertSame(['uk' => 'bbc'], $entity->getX());
        $entity->addX('cnn', 'us');
        $this->assertSame(['uk' => 'bbc', 'us' => 'cnn'], $entity->getX());
    }

    public function testAddToNonArray()
    {
        $entity = new FlexEntity();

        $entity->setX('bbc');

        $this->expectException(InvalidArgumentException::class);
        $entity->addX('vvv');
    }

    public function testToJson()
    {
        $entity = FlexEntity::make(['a' => 1, 'b' => 2]);

        $this->assertSame('{"a":1,"b":2}', $entity->toJson());
    }

    public function testNameConvention()
    {
        $ar = ['aaa' => 1, 'bb_cc' => 2];
        $entity = FlexEntity::make($ar);

        $this->assertSame(1, $entity->getAaa());
        $this->assertSame(2, $entity->getBbCc());

        $entity->setXyZ(3);

        $this->assertArrayHasKey('xy_z', $entity->toArray());
    }

    public function testClone()
    {
        $entity = FlexEntity::make(['obj' => FlexEntity::make([]), [1,2,3,4]]);

        $entityTwo = clone $entity;

        $this->assertNotSame($entity->getObj(), $entityTwo->getObj());
    }
}
