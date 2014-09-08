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

namespace BucketableUnitTest\Bucketable;

use Bucketable\Bucket;

class BucketTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Bucketable\Bucketable */
    private $bucket;

    public function setUp()
    {
        $this->bucket = new Bucket();
    }

    public function testBucketableInterfaceImplementation()
    {
        $this->assertInstanceOf('\Bucketable\Bucketable', $this->bucket);
    }

    public function testArrayAccessInterfaceImplementation()
    {
        $this->assertInstanceOf('\ArrayAccess', $this->bucket);
    }

    public function testIteratorAggregateInterfaceImplementation()
    {
        $this->assertInstanceOf('\IteratorAggregate', $this->bucket);
    }

    public function testCountableInterfaceImplementation()
    {
        $this->assertInstanceOf('\Countable', $this->bucket);
    }

    public function testCanSetAndGetKey()
    {
        $this->bucket->setKey('foo', 'bar');
        $this->assertEquals('bar', $this->bucket->getKey('foo'));
    }

    public function testSetKeyProvidesFluentInterface()
    {
        $this->assertInstanceOf(get_class($this->bucket), $this->bucket->setKey('foo', 'bar'));
    }

    public function testGetKeyReturnsGivenDefault()
    {
        $this->assertNull($this->bucket->getKey('foo'));
        $this->assertEquals('bar', $this->bucket->getKey('foo', 'bar'));
    }

    public function testHasKey()
    {
        $this->assertFalse($this->bucket->hasKey('foo'));
        $this->bucket->setKey('foo', 'bar');
        $this->assertTrue($this->bucket->hasKey('foo'));
    }

    public function testRemoveKey()
    {
        $this->bucket->setKey('foo', 'bar');
        $this->bucket->setKey('foo2', 'bar2');
        $this->bucket->removeKey('foo2');
        $this->assertFalse($this->bucket->hasKey('foo2'));
        $this->assertTrue($this->bucket->hasKey('foo'));
    }

    public function testRemoveKeyProvidesFluentInterface()
    {
        $this->assertInstanceOf(get_class($this->bucket), $this->bucket->removeKey('foo'));
    }

    public function testKeyIsEmpty()
    {
        $this->assertTrue($this->bucket->keyIsEmpty('foo'));
        $this->bucket->setKey('foo', '');
        $this->assertTrue($this->bucket->keyIsEmpty('foo'));
        $this->bucket->setKey('foo', array());
        $this->assertTrue($this->bucket->keyIsEmpty('foo'));
        $this->bucket->setKey('foo', 0);
        $this->assertTrue($this->bucket->keyIsEmpty('foo'));

        $this->bucket->setKey('foo', array('bar'));
        $this->assertFalse($this->bucket->keyIsEmpty('foo'));
        $this->bucket->setKey('foo', 'a');
        $this->assertFalse($this->bucket->keyIsEmpty('foo'));
        $this->bucket->setKey('foo', 1);
        $this->assertFalse($this->bucket->keyIsEmpty('foo'));
    }
}
