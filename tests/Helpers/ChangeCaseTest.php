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

use Bushido\Foundation\Helpers\ChangeCase;

class ChangeCaseTest extends \PHPUnit\Framework\TestCase
{
    public function testCamelToSnake()
    {
        $this->assertSame('fred_buddy', ChangeCase::camelToSnake('FredBuddy'));
        $this->assertSame('one_two_three', ChangeCase::camelToSnake('OneTwoThree'));
    }
    public function testSnakeToCamel()
    {
        $this->assertSame('FredBuddy', ChangeCase::snakeToCamel('fred_buddy'));
        $this->assertSame('OneTwoThree', ChangeCase::snakeToCamel('one_two_three'));
    }
    public function testSnakeToCamelLow()
    {
        $this->assertSame('oneTwoThree', ChangeCase::snakeToCamel('one_two_three', true));
    }
}
