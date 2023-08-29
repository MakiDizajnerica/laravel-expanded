<?php

namespace MakiDizajnerica\Expanded\Mixins;

use Closure;

class StrMixin
{
    /**
     * Get username from email or string.
     * Only using [a-zA-Z0-9] characters.
     *
     * @return \Closure
     */
    public function username(): Closure
    {
        return function(string $string): string {
            if (static::contains($string, '@')) {
                $string = static::before($string, '@');
            }

            return preg_replace("/[^a-zA-Z0-9]+/", '', $string);
        };
    }
}
