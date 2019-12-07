<?php

namespace App\Enums;

class BaseEnum
{

    public static function getConstant($value)
    {
        $constantName = null;
        $class = new \ReflectionClass(get_called_class());
        $constants = $class->getConstants();

        foreach ($constants as $key => $val) {
            if ($val == $value ) {
                $constantName = $key;
                break;
            }
        }

        return $constantName;
    }

    public static function getArrayConstants()
    {
        $class = new \ReflectionClass(get_called_class());

        return $class->getConstants();
    }

}
