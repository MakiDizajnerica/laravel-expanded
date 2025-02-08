<?php

namespace MakiDizajnerica\Expanded\Support;

use AllowDynamicProperties;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Arrayable;

#[AllowDynamicProperties]
abstract class DataObject implements Arrayable
{
    /**
     * @param  mixed $data
     * @param  bool $extend
     * @return void
     */
    public function __construct(mixed $data = null, bool $extend = true)
    {
        $this->populateData($data, $extend);
    }

    /**
     * @param  mixed $data
     * @param  bool $extend
     * @return static
     */
    public static function make(mixed $data = null, bool $extend = true): static
    {
        return new static($data, $extend);
    }

    /**
     * @param  mixed $data
     * @param  bool $extend
     * @return void
     */
    private function populateData(mixed $data, bool $extend): void
    {
        if (! $data) {
            return;
        }

        $properties = $this->parseData($data);

        if (! $extend) {
            $properties = array_filter($properties, fn ($key) => property_exists($this, $key), ARRAY_FILTER_USE_KEY);
        }

        foreach ($properties as $key => $value) {
            $this->setProperty($key, $value);
        }
    }

    /**
     * @param  mixed $data
     * @return array
     */
    private function parseData(mixed $data): array
    {
        if (is_object($data)) {
            return $data instanceof Arrayable
                ? $data->toArray()
                : get_object_vars($data);
        }

        return $data;
    }

    /**
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    protected function setProperty(string $key, mixed $value): void
    {
        $setter = 'set' . ucfirst(Str::camel($key));

        if (method_exists($this, $setter)) {
            call_user_func([$this, $setter], $value);

            return;
        }

        $this->{$key} = $value;
    }

    /**
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    protected function getProperty(string $key, mixed $default = null): mixed
    {
        $getter = 'get' . ucfirst(Str::camel($key));

        if (method_exists($this, $getter)) {
            return call_user_func([$this, $getter]);
        }

        if (property_exists($this, $key) && isset($this->{$key})) {
            return $this->{$key};
        }

        return $default;
    }

    /**
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function set(string $key, mixed $value): void
    {
        $this->setProperty($key, $value);
    }

    /**
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->getProperty($key, $default);
    }

    /**
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function __set(string $key, mixed $value): void
    {
        $this->setProperty($key, $value);
    }

    /**
     * @param  string $key
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->getProperty($key);
    }

    /**
     * @param  string $key
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return isset($this->{$key});
    }

    /**
     * @param  string $key
     * @return void
     */
    public function __unset(string $key): void
    {
        unset($this->{$key});
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $properties = get_object_vars($this);

        foreach ($properties as $key => $value) {
            if ($value instanceof Arrayable) {
                $properties[$key] = $value->toArray();
            }
        }

        return $properties;
    }
}
