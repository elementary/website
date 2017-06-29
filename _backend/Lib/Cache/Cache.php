<?php

namespace App\Lib\Cache;

use Closure;

class Cache
{
    /**
     * The storage we are using for the cache.
     *
     * @var \App\Lib\Cache\StoreInterface
     */
    protected $store;

    /**
     * Creates a new cache using the given storage interface.
     *
     * @param StoreInterface
     */
    public function __construct(StoreInterface $store)
    {
        $this->store = $store;
    }

    /**
     * Gets a value from the cache.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $value = $this->store->get($key);

        if ($value != null) {
            return $value;
        }

        return $default;
    }

    /**
     * Remembers a value in the cache. Runs closure to generate new cache.
     *
     * @param string  $key
     * @param int     $minutes
     * @param closure $closure
     *
     * @return mixed
     */
    public function remember($key, $minutes, Closure $closure)
    {
        $value = $this->get($key);

        if ($value != null) {
            return $value;
        }

        $newValue = $closure();

        $this->put($key, $newValue, $minutes);

        return $newValue;
    }

    /**
     * Redirect any none-cache method to the storage.
     * NOTE: This is a PHP magic function. Try not to break it.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->store->$method(...$parameters);
    }
}
