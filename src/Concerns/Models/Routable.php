<?php

namespace MakiDizajnerica\Expanded\Concerns\Models;

trait Routable
{
    /**
     * Get the route key for the Model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        if (! property_exists($this, 'routeKeyName')) {
            return $this->getKeyName();
        }

        return $this->routeKeyName;
    }
}
