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

interface Arrayable
{
    /**
     * An array representation of object
     *
     * @return array
     */
    public function toArray(): array;
}
