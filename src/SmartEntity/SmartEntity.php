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
use Bushido\Foundation\Exception;
use Bushido\Foundation\Exceptions\InvalidArgumentException;

/**
 * @todo support for some common classes
 * @todo limited internal type arrays
 */
abstract class SmartEntity extends FlexEntity
{
    protected $properties = [];

    /**
     * @param string $propertyName
     * @param array $arguments
     * @return $this
     * @throws Exception
     * @throws InvalidArgumentException
     */
    protected function set(string $propertyName, array $arguments)
    {
        $value = $this->fetchValue($arguments, $propertyName);

        if (!$this->isPropertySet($propertyName)) {
            throw new \RuntimeException('Property [' . $propertyName . '] not set');
        }

        $type = $this->properties[$propertyName];

        if ($this->isInternalType($type)) {
            if ($this->validateInternalType($value, $type)) {
                parent::set($propertyName, [$value]);

                return $this;
            }

            throw new InvalidArgumentException(
                'Expected value to be type of [' . self::INTERNAL_TYPES[$type] . '] different type was given'
            );
        }

        if ($this->isTypeArrayOfObjects($type) && is_array($value)) {
            return parent::set($propertyName, [$this->processArrayOfObj($value, $type)]);
        }

        return parent::set($propertyName, [$this->processObjectType($value, $type)]);
    }

    /**
     * @param int|string $type
     * @return bool
     */
    private function isInternalType($type): bool
    {
        return is_numeric($type) && array_key_exists($type, self::INTERNAL_TYPES);
    }

    private function isPropertySet($propertyName): bool
    {
        return array_key_exists($propertyName, $this->properties);
    }

    /**
     * @param mixed $value
     * @param string $class
     * @return mixed
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function processObjectType($value, string $class)
    {
        $this->isClassOrInterface($class);

        if (is_array($value) && is_subclass_of($class, Makeable::class)) {
            return $class::make($value);
        }

        if (is_a($value, $class)) {
            return $value;
        }

        throw new InvalidArgumentException(
            'Expected value to be object of [' . $class . '] type different type was given'
        );
    }

    /**
     * @param string $class
     * @return bool
     * @throws Exception
     */
    private function isClassOrInterface(string $class): bool
    {
        if (class_exists($class) || interface_exists($class)) {
            return true;
        }

        throw new Exception('Non existing class or interface [' . $class . ']');
    }

    private function isTypeArrayOfObjects($type): bool
    {
        return strpos($type, '[]') !== false;
    }

    /**
     * @param array $value
     * @param mixed $type
     * @return array
     * @throws Exception
     * @throws InvalidArgumentException
     */
    private function processArrayOfObj(array $value, $type): array
    {
        $ar = [];
        $class = $this->getClassNameFromType($type);

        foreach ($value as $key => $obj) {
            $ar[$key] = $this->processObjectType($obj, $class);
        }

        return $ar;
    }

    private function getClassNameFromType($type): string
    {
        return (string) str_replace(self::EXT_ARRAY, '', $type);
    }

    private function validateInternalType($value, $type): bool
    {
        switch ($type) {
            case self::TYPE_ARRAY:
                return is_array($value);
            case self::TYPE_INT:
                return is_int($value);
            case self::TYPE_STRING:
                return is_string($value);
            case self::TYPE_BOOL:
                return is_bool($value);
            case self::TYPE_FLOAT:
                return is_float($value);
            case self::TYPE_NUMERIC:
                return is_numeric($value);
        }

        return false;
    }

    /**
     * @param string $property
     * @param array $arguments
     * @return $this
     * @throws Exception
     * @throws InvalidArgumentException
     */
    protected function add(string $property, array $arguments)
    {
        $this->fetchValue($arguments, $property);

        if (!array_key_exists($property, $this->properties) ||
            !($this->isArrayOfObjects($this->properties[$property]) || $this->properties[$property] == self::TYPE_ARRAY)
        ) {
            throw new Exception('Can not use addProperty on non object array property');
        }

        if ($arguments[0] === null) {
            return $this;
        }

        if ($this->isArrayOfObjects($this->properties[$property])) {
            $arguments[0] = $this->processObjectType(
                $arguments[0],
                $this->getClassNameFromType($this->properties[$property])
            );
        }

        return parent::add($property, $arguments);
    }

    private function isArrayOfObjects($type): bool
    {
        return strpos($type, '[]') !== false;
    }
}
