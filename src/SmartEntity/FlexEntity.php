<?php
/*
 * This file is part of the Bushido\Foundation package.
 *
 * (c) Wojciech Nowicki <wnowicki@me.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Bushido\Foundation\SmartEntity;

use Bushido\Foundation\Contracts\Makeable;
use Bushido\Foundation\Exceptions\InvalidArgumentException;
use Bushido\Foundation\Helpers\ArrayableHelper;
use Bushido\Foundation\Helpers\ChangeCase;

class FlexEntity implements Entity
{
    private $data = [];

    /**
     * @param array $components
     * @return static
     */
    public static function make(array $components): Makeable
    {
        $entity = new static();

        foreach ($components as $k => $v) {
            $entity->{'set' . ChangeCase::snakeToCamel($k)}($v);
        }
        return $entity;
    }

    public function toArray(): array
    {
        return ArrayableHelper::processArray($this->data);
    }

    public function toJson(int $options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    public function __toString(): string
    {
        return $this->toJson();
    }

    public function __call(string $name, array $arguments)
    {
        $action = substr($name, 0, 3);
        $property = ChangeCase::camelToSnake(substr($name, 3));
        switch ($action) {
            case 'set':
                return $this->set($property, $arguments);
            case 'get':
                return $this->get($property);
            case 'add':
                return $this->add($property, $arguments);
        }
        throw new \RuntimeException('Call to undefined method '.__CLASS__.'::'.$name.'()');
    }

    /**
     * @param string $property
     * @param array $arguments
     * @return $this
     */
    private function set(string $property, array $arguments)
    {
        $this->checkArguments($arguments, $property);
        $this->data[$property] = $arguments[0];

        return $this;
    }

    private function get(string $property)
    {
        if (array_key_exists($property, $this->data)) {
            return $this->data[$property];
        }

        return null;
    }

    private function add(string $name, array $arguments)
    {
        if (!isset($this->data[$name]) || is_array($this->data[$name])) {
            $this->data[$name][] = $arguments[0];

            return $this;
        }

        throw new InvalidArgumentException('Expected property [' . $name . '] to be array type');
    }

    private function checkArguments(array $arguments, $property): void
    {
        if (count($arguments) == 0) {
            throw new \RuntimeException('Missing argument on method ' . __CLASS__ . '::set_' . $property . '() call');
        }
    }
}
