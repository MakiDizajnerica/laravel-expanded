<?php

namespace MakiDizajnerica\Expanded\Concerns;

trait EnumToArray
{
    /**
     * Get case names.
     *
     * @return array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get case values.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get cases as array.
     *
     * @return array
     */
    public static function toArray(): array
    {
        return array_combine(self::names(), self::values());
    }
}
