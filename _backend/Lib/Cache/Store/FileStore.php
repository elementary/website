<?php

namespace App\Lib\Cache\Store;

use App\Lib\Cache\StoreInterface;

class FileStore extends BaseStore implements StoreInterface
{
    /**
     * Returns the directory we use to store cache files.
     *
     * @return string
     */
    protected function cacheDirectory()
    {
        $path = sys_get_temp_dir();

        if (substr($path, strlen($path) - 1) !== '/') {
            $path .= '/';
        }

        return $path.'elementary/website';
    }

    /**
     * Returns the full path to the cache file.
     *
     * @param string $key
     *
     * @return string
     */
    protected function cachePath($key)
    {
        return $this->cacheDirectory().'/'.base64_encode($key);
    }

    /**
     * Reads the cache file.
     *
     * @param string $key
     *
     * @return mixed|null;
     */
    protected function readCache($key)
    {
        $path = $this->cachePath($key);

        if (file_exists($path) === false) {
            return;
        }

        return unserialize(file_get_contents($path));
    }

    /**
     * Writes the cache to file.
     *
     * @param string $key
     * @param mixed  $contents
     */
    protected function writeCache($key, $contents)
    {
        $filePath = $this->cachePath($key);

        if (file_exists($filePath) === false) {
            $fileDirectory = $this->cacheDirectory();

            if (file_exists($fileDirectory) === false) {
                mkdir($fileDirectory, 0644, true);
            }
        }

        file_put_contents($filePath, serialize($contents));
    }

    /**
     * Returns a key from the file.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    public function get($key)
    {
        $content = $this->readCache($key);

        if ($content == null) {
            return;
        }

        $time = $content['time'];
        if ($time <= time()) {
            $this->forget($key);

            return;
        }

        return $content['data'];
    }

    /**
     * Puts a value into the file.
     *
     * @param string $key
     * @param mixed  $value
     * @param int    $minutes
     */
    public function put($key, $value, $minutes = 0)
    {
        $this->writeCache($key, array(
            'data' => $value,
            'time' => $this->getTime($minutes),
        ));
    }

    /**
     * Sets a cache value to be cached forever.
     *
     * @param string $key
     * @param int    $value
     */
    public function forever($key, $value)
    {
        $content = $this->readCache($key);

        if ($content == null) {
            return;
        }

        $content['time'] = $this->getTime(0);

        $this->writeCache($key, $content);
    }

    /**
     * Removes a value from the cache.
     *
     * @param string $key
     */
    public function forget($key)
    {
        $filePath = $this->cachePath($key);

        if (file_exists($filePath) === true) {
            unlink($filePath);
        }
    }

    /**
     * Removes all values from the cache.
     */
    public function flush()
    {
        $fileDirectory = $this->cacheDirectory();

        $files = array_diff(scandir($fileDirectory, array('..', '.')));
        foreach ($files as $file) {
            unlink($fileDirectory.'/'.$file);
        }

        rmdir($fileDirectory);
    }
}
