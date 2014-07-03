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
 * Tests for properties created by getter and setter.
 * 
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 */
class PropertyByGetterAndSetterTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->object = new \Test\Fixture\Object();
    }
    
    public function testGet()
    {
        $this->assertEquals('foo', $this->object->propertyByGetterAndSetter);
    }
    
    public function testGetter()
    {
        $this->assertEquals('foo', $this->object->getPropertyByGetterAndSetter());
    }
    
    public function testIsset()
    {
        $this->assertTrue(isset($this->object->propertyByGetterAndSetter));
    }
    
    /**
     * @depends testGet
     */
    public function testSet()
    {
        $this->object->propertyByGetterAndSetter = 'bar';
        $this->assertEquals('bar', $this->object->propertyByGetterAndSetter);
    }
    
    /**
     * @depends testGet
     */
    public function testSetter()
    {
        $this->object->setPropertyByGetterAndSetter('bar');
        $this->assertEquals('bar', $this->object->propertyByGetterAndSetter);
    }
    
    /**
     * @depends testGet
     */
    public function testUnset()
    {
        unset($this->object->propertyByGetterAndSetter);
        $this->assertEquals(null, $this->object->propertyByGetterAndSetter);
    }
}
