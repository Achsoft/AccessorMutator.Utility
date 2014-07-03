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
 * Tests for write only properties.
 * 
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 */
class WriteOnlyPropertyTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->object = new \Test\Fixture\Object();
    }
    
    public function testGet()
    {
        $message = 'Getting write-only property: ' . get_class($this->object)
            . '::writeOnlyProperty';
        $exception = '\Achsoft\Utility\AccessorMutator\Exception\UnreadablePropertyException';
        $this->setExpectedException($exception, $message);
        var_dump($this->object->writeOnlyProperty);
    }
    
    public function testGetter()
    {
        $message = 'Getting write-only property: ' . get_class($this->object)
            . '::writeOnlyProperty';
        $exception = '\Achsoft\Utility\AccessorMutator\Exception\UnreadablePropertyException';
        $this->setExpectedException($exception, $message);
        var_dump($this->object->getWriteOnlyProperty());
    }
    
    public function testIsset()
    {
        $this->assertTrue(isset($this->object->writeOnlyProperty));
    }
    
    public function testSet()
    {
        $reflectionClass = new \ReflectionClass($this->object);
        $reflectionProperty = $reflectionClass->getProperty('writeOnlyProperty');
        $reflectionProperty->setAccessible(true);
        $this->object->writeOnlyProperty = 'bar';
        $this->assertEquals('bar', $reflectionProperty->getValue($this->object));
    }
    
    public function testSetter()
    {
        $reflectionClass = new \ReflectionClass($this->object);
        $reflectionProperty = $reflectionClass->getProperty('writeOnlyProperty');
        $reflectionProperty->setAccessible(true);
        $this->object->setWriteOnlyProperty('bar');
        $this->assertEquals('bar', $reflectionProperty->getValue($this->object));
    }
}
