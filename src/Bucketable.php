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

/**
 * Defining the main Bucketable behavior
 *
 * @package bucketable
 * @author  Oliver Mack
 */
interface Bucketable extends
    ArrayAccess,
    IteratorAggregate,
    Countable
{
    /**
     * Sets $data for the given $key
     * @param string $key
     * @param mixed  $data
     */
    public function setKey($key, $data);

    /**
     * Gets the value of the given $key
     *
     * Returns $default if $key does not exist
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public function getKey($key, $default = null);

    /**
     * Checks if the given $key exists
     *
     * @param  string  $key
     * @return boolean
     */
    public function hasKey($key);

    /**
     * Checks if the given $key is not set or is empty
     *
     * @param  string  $key
     * @return boolean
     */
    public function keyIsEmpty($key);

    /**
     * Checks if the storage is empty
     *
     * @return boolean
     */
    public function isEmpty();
}
