<?php

namespace App\Support;

trait EnumToArray
{
    /**
     * Return all names from enum
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Return all values from array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Return all values from array indexed by name
     */
    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }
}
