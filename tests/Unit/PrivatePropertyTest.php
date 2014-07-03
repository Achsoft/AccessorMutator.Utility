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
 * Tests for private properties.
 * 
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 */
class PrivatePropertyTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->object = new \Test\Fixture\Object();
    }
    
    public function testGet()
    {
        $message = 'Getting undefined property: ' . get_class($this->object)
            . '::privateProperty';
        $exception = '\Achsoft\Utility\AccessorMutator\Exception\UndefinedPropertyException';
        $this->setExpectedException($exception, $message);
        var_dump($this->object->privateProperty);
    }
    
    public function testGetter()
    {
        $message = 'Unknown method: ' . get_class($this->object)
            . '::getPrivateProperty';
        $exception = '\BadMethodCallException';
        $this->setExpectedException($exception, $message);
        var_dump($this->object->getPrivateProperty());
    }
    
    public function testIsset()
    {
        $this->assertFalse(isset($this->object->privateProperty));
    }
    
    public function testSet()
    {
        $message = 'Setting undefined property: ' . get_class($this->object)
            . '::privateProperty';
        $exception = '\Achsoft\Utility\AccessorMutator\Exception\UndefinedPropertyException';
        $this->setExpectedException($exception, $message);
        $this->object->privateProperty = 'bar';
    }
    
    public function testSetter()
    {
        $message = 'Unknown method: ' . get_class($this->object)
            . '::setPrivateProperty';
        $exception = '\BadMethodCallException';
        $this->setExpectedException($exception, $message);
        $this->object->setPrivateProperty('bar');
    }
}
