<?php
/*
 * This file is part of the Bushido\Foundation package.
 *
 * (c) Wojciech Nowicki <wnowicki@me.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Bushido\Foundation\Helpers;

class ChangeCase
{
    public static function camelToSnake(string $string): string
    {
        $string[0] = strtolower($string[0]);
        return strtolower(preg_replace("/([A-Z])/", "_$1", $string));
    }

    public static function snakeToCamel(string $string, bool $firstLowercase = false): string
    {
        $rtn = str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($string))));
        if ($firstLowercase) {
            $rtn[0] = strtolower($rtn[0]);
        }
        return $rtn;
    }
}
