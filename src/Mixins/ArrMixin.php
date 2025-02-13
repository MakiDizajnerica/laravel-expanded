<?php

namespace MakiDizajnerica\Expanded\Mixins;

class ArrMixin
{
    /**
     * Merge two arrays by appending one array keys to other array values.
     *
     * @param  array $toAppendOn
     * @param  array $toAppend
     * @param  bool  $returnDefault
     * @param  mixed $default
     * @return array
     */
    public static function mergeByAppending(array $toAppendOn,
                                            array $toAppend,
                                            bool $returnDefault = false,
                                            mixed $default = null): array
    {
        return array_map(function ($value) use ($toAppend, $returnDefault, $default) {
            return static::get(
                $toAppend, $value, $returnDefault
                    ? $default
                    : $value
            );
        }, $toAppendOn);
    }
}
