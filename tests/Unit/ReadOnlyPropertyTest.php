<?php

/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file.
 * Redistributions of files must retain the above copyright notice.
 * 
 * @copyright (c) 2014, Achmad F. Ibrahim
 * @link https://github.com/Achsoft
 * @license http://opensource.org/licenses/mit-license.php The MIT License (MIT)
 */

namespace Test\Unit;

/**
 * Tests for read only properties.
 * 
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 */
class ReadOnlyPropertyTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->object = new \Test\Fixture\Object();
    }
    
    public function testGet()
    {
        $this->assertEquals('foo', $this->object->readOnlyProperty);
    }
    
    public function testGetter()
    {
        $this->assertEquals('foo', $this->object->getReadOnlyProperty());
    }
    
    /**
     * @depends testGet
     */
    public function testIsset()
    {
        $this->assertTrue(isset($this->object->readOnlyProperty));
    }
    
    public function testSet()
    {
        $message = 'Setting read-only property: ' . get_class($this->object)
            . '::readOnlyProperty';
        $exception = '\Achsoft\Utility\AccessorMutator\Exception\UnwriteablePropertyException';
        $this->setExpectedException($exception, $message);
        $this->object->readOnlyProperty = 'bar';
    }
    
    public function testSetter()
    {
        $message = 'Setting read-only property: ' . get_class($this->object)
            . '::readOnlyProperty';
        $exception = '\Achsoft\Utility\AccessorMutator\Exception\UnwriteablePropertyException';
        $this->setExpectedException($exception, $message);
        $this->object->setReadOnlyProperty('bar');
    }
}
