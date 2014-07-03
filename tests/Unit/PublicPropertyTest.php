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
 * Tests for public properties.
 * 
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 */
class PublicPropertyTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->object = new \Test\Fixture\Object();
    }
    
    public function testGet()
    {
        $this->assertEquals('foo', $this->object->publicProperty);
    }
    
    public function testGetter()
    {
        $this->assertEquals('foo', $this->object->getPublicProperty());
    }
    
    public function testIsset()
    {
        $this->assertTrue(isset($this->object->publicProperty));
    }
    
    /**
     * @depends testGet
     */
    public function testSet()
    {
        $this->object->publicProperty = 'bar';
        $this->assertEquals('bar', $this->object->publicProperty);
    }
    
    /**
     * @depends testGet
     */
    public function testSetter()
    {
        $this->object->setPublicProperty('bar');
        $this->assertEquals('bar', $this->object->publicProperty);
    }
}
