<?php

namespace ImClarky\TescoApi\Tests;

use ReflectionClass;

class PHPUnitHelpers
{
    public static function callMethodAsPublic($class, $method, $args = null)
    {
        $class = new ReflectionClass($class);

        $method = $class->getMethod($method);
        $method->setAccessible(true);

        if ($args) {
            return is_array($args)
                ? $method->invokeArgs($args)
                : $method->invokeArgs([$args]);
        }

        return $method->invoke();
    }

    public static function getPropertyAsPublic($object, $property)
    {
        $class = new ReflectionClass($object);
        $prop = $class->getProperty($property);
        $prop->setAccessible(true);

        return $prop->getValue($object);
    }
}
