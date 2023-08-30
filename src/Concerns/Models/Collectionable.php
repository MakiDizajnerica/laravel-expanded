<?php

namespace MakiDizajnerica\Expanded\Concerns\Models;

use Illuminate\Database\Eloquent\Collection;

trait Collectionable
{
    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = []): Collection
    {
        if (property_exists($this, 'collection')
            && is_a($this->collection, Collection::class, true)) {
            return app($this->collection, ['items' => $models]);
        }

        return new Collection($models);
    }
}
