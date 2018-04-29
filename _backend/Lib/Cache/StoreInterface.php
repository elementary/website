<?php

namespace App\Lib\Cache;

interface StoreInterface
{
    /**
     * Returns a key from the cache.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    public function get($key);

    /**
     * Returns many values from the cache.
     *
     * @param string[] $keys
     *
     * @return mixed|null[]
     */
    public function getMany(array $keys);

    /**
     * Puts a value into the cache.
     *
     * @param string $key
     * @param mixed $value
     * @param int $minutes
     */
    public function put($key, $value, $minutes = 0);

    /**
     * Puts many values into the cache.
     *
     * @param array $items $key
     * @param int $minutes
     */
    public function putMany(array $items, $minutes = 0);

    /**
     * Sets a value to be cached forever.
     *
     * @param string $key
     * @param mixed $value
     */
    public function forever($key, $value);

    /**
     * Removes a value from the cache.
     *
     * @param string $key
     */
    public function forget($key);

    /**
     * Removes all values from the cache.
     */
    public function flush();
}
