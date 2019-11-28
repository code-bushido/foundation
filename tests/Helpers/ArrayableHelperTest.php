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

namespace BushidoTests\Foundation;

use Bushido\Foundation\Contracts\Arrayable;
use Bushido\Foundation\Helpers\ArrayableHelper;
use PHPUnit\Framework\TestCase;

class ArrayableHelperTest extends TestCase
{
    public function testSimpleArray()
    {
        $example = ['abc', 'x' => 'test', 5 => 6];

        $this->assertSame($example, ArrayableHelper::processArray($example));
    }

    public function testArray()
    {
        $example = ['a' => 'b', 'c' => ['x', 'y', 'z']];

        $this->assertSame($example, ArrayableHelper::processArray($example));
    }

    public function testArrayable()
    {
        $example = ['a' => 'b', 'c' => (new ExampleArrayble())];

        $this->assertSame(['a' => 'b', 'c' => ['x' => 'y']], ArrayableHelper::processArray($example));
    }
}

class ExampleArrayble implements Arrayable
{
    public function toArray(): array
    {
        return ['x' => 'y'];
    }
}
