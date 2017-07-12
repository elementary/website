<?php

namespace App\Lib\Cache\Store;

class BaseStore
{
    /**
     * Returns the current time plus minutes.
     *
     * @param int $minutes
     *
     * @return int
     */
    protected function getTime($minutes = 0)
    {
        // Consider 0 minutes as an infinite time
        if ($minutes === 0) {
            return 9999999999;
        }

        return time() + ($minutes * 60);
    }

    /**
     * Returns many values from the file.
     *
     * @param string[] $keys
     *
     * @return mixed|null[]
     */
    public function getMany(array $keys)
    {
        return array_map(function ($key) {
            return $this->get($key);
        }, $keys);
    }

    /**
     * Puts many values into the file.
     *
     * @param array $items   $key
     * @param int   $minutes
     */
    public function putMany(array $items, $minutes = 0)
    {
        array_walk(function ($value, $key) {
            $this->put($key, $value, $minutes);
        }, $items);
    }
}
