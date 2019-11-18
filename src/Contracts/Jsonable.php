<?php
/*
 * This file is part of the Bushido\Foundation package.
 *
 * (c) Wojciech Nowicki <wnowicki@me.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Bushido\Foundation\Contracts;

interface Jsonable
{
    /**
     * JSON representation of an object
     *
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = 0): string;
}
