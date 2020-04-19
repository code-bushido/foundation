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

use Bushido\Foundation\Contracts\Arrayable;

class ArrayableHelper
{
    public static function processArray(array $data): array
    {
        $rtn = [];
        foreach ($data as $k => $v) {
            if ($v instanceof Arrayable) {
                $rtn[$k] = $v->toArray();
                continue;
            }
            if (is_array($v)) {
                $rtn[$k] = self::processArray($v);
                continue;
            }
            $rtn[$k] = $v;
        }
        return $rtn;
    }
}
