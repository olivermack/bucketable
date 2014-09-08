<?php

/*
 * This file is part of Bucketable.
 *
 * Copyright (c) 2014 Oliver Mack
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Bucketable;

/**
 * Defining the main Bucketable behavior
 *
 * @package bucketable
 * @author  Oliver Mack
 */
trait BucketableTrait
{
    /**
     * The data storage for bucket data
     *
     * @var array
     */
    protected $bucketStorage = array();

    /**
     * Sets $data for the given $key
     *
     * @param string $key
     * @param mixed  $data
     *
     * @return $this
     */
    public function setKey($key, $data)
    {
        $this->bucketStorage[$key] = $data;

        return $this;
    }

    /**
     * Gets the value of the given $key
     *
     * Returns $default if $key does not exist
     *
     * @param  string $key
     * @param  mixed  $default
     *
     * @return mixed|null
     */
    public function getKey($key, $default = null)
    {
        if ($this->hasKey($key)) {
            return $this->bucketStorage[$key];
        }

        return $default;
    }

    /**
     * Checks if the given $key exists
     *
     * @param  string $key
     *
     * @return boolean
     */
    public function hasKey($key)
    {
        return isset($this->bucketStorage[$key]);
    }

    /**
     * Removes the given $key from the storage
     *
     * @param  string $key
     *
     * @return $this
     */
    public function removeKey($key)
    {
        unset($this->bucketStorage[$key]);

        return $this;
    }

    /**
     * Checks if the given $key is not set or is empty
     *
     * @param  string $key
     *
     * @return boolean
     */
    public function keyIsEmpty($key)
    {
        $val = $this->getKey($key);

        return empty($val);
    }

    /**
     * Checks if the storage is empty
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return empty($this->bucketStorage);
    }

    /**
     * Gets the value of the given $key
     *
     * Returns null if key does not exist.
     *
     * @param string $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->getKey($offset);
    }

    /**
     * Set the given key in the bucket
     *
     * @param  string $offset
     * @param  mixed  $value  the payload to store
     */
    public function offsetSet($offset, $value)
    {
        $this->setKey($offset, $value);
    }

    /**
     * Checks if given key is registered
     *
     * @param  string $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->hasKey($offset);
    }

    /**
     * Remove given offset from storage
     *
     * @param  string $offset
     *
     * @return $this
     */
    public function offsetUnset($offset)
    {
        return $this->removeKey($offset);
    }

    /**
     * Counts the keys in the storage
     *
     * @return int
     */
    public function count()
    {
        return count($this->bucketStorage);
    }

    /**
     * Obtain an iterator for the storage
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->bucketStorage);
    }
}
