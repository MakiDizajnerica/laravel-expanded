<?php

namespace MakiDizajnerica\Expanded\Mixins;

use Closure;

class ArrMixin
{
    /**
     * Merge two arrays by appending one array keys to other array values.
     *
     * @return \Closure
     */
    public static function mergeByAppending(): Closure
    {
        return function (array $toAppendOn, array $toAppend, bool $returnDefault = false, mixed $default = null): array {
            return array_map(function ($value) use ($toAppend, $returnDefault, $default) {
                return static::get(
                    $toAppend, $value, $returnDefault
                        ? $default
                        : $value
                );
            }, $toAppendOn);
        };
    }
}
