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

/**
 * @todo clone implementation
 * @todo add method
 * @todo support for some common classes
 * @todo limited internal type arrays
 */
abstract class SmartEntity extends FlexEntity
{
    protected $properties = [];

    protected function set(string $propertyName, array $arguments)
    {
        $value = $this->fetchValue($arguments, $propertyName);

        if (!$this->isPropertySet($propertyName)) {
            throw new \RuntimeException();
        }

        $type = $this->properties[$propertyName];

        if ($this->isInternalType($type)) {
            if ($this->validateInternalType($value, $type)) {
                parent::set($propertyName, [$value]);

                return $this;
            }

            throw new InvalidArgumentException(
                'Expected value to be type of [' . $this->propertyInternalTypes()[$type] . '] different type was given'
            );
        }

        if ($this->isTypeArrayOfObjects($type) && is_array($value)) {
            return $this->processArrayOfObj($value, $type);
        }

        parent::set($propertyName, [$this->processObjectType($value, $type)]);
    }

    private function isInternalType($type)
    {
        return is_numeric($type) && array_key_exists($type, $this->propertyInternalTypes());
    }

    private function isPropertySet($propertyName): bool
    {
        return count($this->properties) == 0 || array_key_exists($propertyName, $this->properties);
    }

    private function processObjectType($value, $class)
    {
        $this->isClassOrInterface($class);

        if (is_array($value) && is_subclass_of($class, Makeable::class)) {
            return $class::make($value);
        }

        if (is_a($value, $class)) {
            return $value;
        }

        throw new InvalidArgumentException(
            'Expected value to be object of [' . $class . '] type ' . $this->checkType($value) . '] was given'
        );
    }

    private function isClassOrInterface($class): bool
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

    private function processArrayOfObj(array $value, $type)
    {
        $ar = [];
        $class = $this->getClassNameFromType($type);

        foreach ($value as $obj) {
            $ar[] = $this->processObjectType($obj, $class);
        }

        return $ar;
    }

    private function getClassNameFromType($type)
    {
        return (string) str_replace('[]', '', $type);
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

    private function propertyInternalTypes()
    {
        return [
            self::TYPE_ARRAY => 'array',
            self::TYPE_INT => 'int',
            self::TYPE_STRING => 'string',
            self::TYPE_BOOL => 'bool',
            self::TYPE_FLOAT => 'float',
            self::TYPE_NUMERIC => 'numeric',
        ];
    }
}
