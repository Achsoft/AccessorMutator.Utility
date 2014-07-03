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

namespace Achsoft\Utility\AccessorMutator;

use Achsoft\Utility\AccessorMutator\Exception\UndefinedPropertyException;
use Achsoft\Utility\AccessorMutator\Exception\UnreadablePropertyException;
use Achsoft\Utility\AccessorMutator\Exception\UnwriteablePropertyException;

/**
 * This class provides acessors and mutators implementation.
 * 
 * Getters and setters are useful for variable that specifically need to be
 * encapsulated. They implement read and write, read-only and write-only 
 * property features.
 * 
 * Comparing to stdClass, this class will throw an exception when trying to get
 * or set undefined properties.
 * 
 * Public properties can be accessed and mutated using getter and setter 
 * without defining their getter and setter methods. 
 * 
 * Unsetting a public property will destroy the variable and it cannot be
 * access or mutated using getter and setter methods afterward.
 * 
 * Note that using getter and setter, the property name becomes case 
 * insensitive as all method names in PHP are case insensitive.
 *
 * To define a read-only property, define a private property and a getter 
 * method.
 * 
 * To define a write-only property, define a private property and a setter
 * method.
 * 
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 * @package Achsoft\Utility\AccessorMutator
 * @version 0.1.0
 * @since 0.1.0
 */
trait AccessorMutatorTrait
{
    /**
     * Call the named method which is not a class method.
     * 
     * This method overrides the PHP magic method.
     * 
     * @param string $method Method name
     * @param array $arguments Method arguments
     * @throws \BadMethodCallException if no getter exists or the named method
     *      is undefined.
     * @throws \Achsoft\Utility\AccessorMutator\Exception\UnreadablePropertyException
     *      if getting write-only property
     * @throws \Achsoft\Utility\AccessorMutator\Exception\UnwriteablePropertyException
     *      if writing readonly-only property
     * @since 0.1.0
     */
    public function __call($method, $arguments)
    {
        $prefix = substr($method, 0, 3);
        $property = lcfirst(substr($method, 3));
        if ($prefix === 'get' && count($arguments) === 0) {
            if ($this->isPublicProperty($this, $property)) {
                return $this->$property;
            }
            if (method_exists($this, 'set' . $property)) {
                $message = 'Getting write-only property: %s::%s';
                throw new UnreadablePropertyException(
                    sprintf($message, get_called_class(), $property)
                );
            }
        }
        if ($prefix === 'set' && count($arguments) === 1) {
            if ($this->isPublicProperty($this, $property)) {
                $this->$property = $arguments[0];
                return;
            }
            if (method_exists($this, 'get' . $property)) {
                $message = 'Setting read-only property: %s::%s';
                throw new UnwriteablePropertyException(
                    sprintf($message, get_called_class(), $property)
                );
            }
        }
        $message = 'Unknown method: %s::%s()';
        throw new \BadMethodCallException(
            sprintf($message, get_called_class(), $method)
        );
    }
    
    /**
     * Return a property value.
     *
     * This method overrides the PHP magic method.
     *
     * @param string $property Property name
     * @return mixed The property value
     * @throws \Achsoft\Utility\AccessorMutator\Exception\UndefinedPropertyException
     *      if getting undefined property
     * @throws \Achsoft\Utility\AccessorMutator\Exception\UnreadablePropertyException
     *      if getting write-only property
     * @since 0.1.0
     */
    public function __get($property)
    {
        $getter = 'get' . $property;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
        $setter = 'set' . $property;
        if (method_exists($this, $setter)) {
            $message = 'Getting write-only property: %s::%s';
            throw new UnreadablePropertyException(
                sprintf($message, get_called_class(), $property)
            );
        }
        $message = 'Getting undefined property: %s::%s';
        throw new UndefinedPropertyException(
            sprintf($message, get_called_class(), $property)
        );
    }
    /**
     * Check whether the property is set or not null.
     *
     * This method overrides the PHP magic method.
     *
     * @param string $property Property name
     * @return bool Whether the property is set or not null
     * @since 0.1.0
     */
    public function __isset($property)
    {
        $getter = 'get' . $property;
        if (method_exists($this, $getter)) {
            return $this->$getter() !== null;
        }
        $setter = 'set' . $property;
        if (method_exists($this, $setter)) {
            return isset($this->$property);
        }
        return false;
    }
    
    /**
     * Set a property value.
     *
     * This method overrides the PHP magic method.
     *
     * @param string $property Property name
     * @param mixed $value Property value
     * @throws \Achsoft\Utility\AccessorMutator\Exception\UndefinedPropertyException
     *      if getting undefined property
     * @throws \Achsoft\Utility\AccessorMutator\Exception\UnwriteablePropertyException
     *      if writing readonly-only property
     * @since 0.1.0
     */
    public function __set($property, $arguments)
    {
        $setter = 'set' . $property;
        if (method_exists($this, $setter)) {
            $this->$setter($arguments);
            return;
        }
        $getter = 'get' . $property;
        if (method_exists($this, $getter)) {
            $message = 'Setting read-only property: %s::%s';
            throw new UnwriteablePropertyException(
                sprintf($message, get_called_class(), $property)
            );
        }
        $message = 'Setting undefined property: %s::%s';
        throw new UndefinedPropertyException(
            sprintf($message, get_called_class(), $property)
        );
    }
    
    /**
     * Unset a property to null.
     *
     * This method overrides the PHP magic method.
     *
     * @param string $property Property name
     * @since 0.1.0
     */
    public function __unset($property)
    {
        $setter = 'set' . $property;
        if (method_exists($this, $setter)) {
            $this->$setter(null);
            return;
        }
    }
    
    /**
     * Check whether a property is public.
     * 
     * This method is faster than using reflection class.
     *
     * @param string $class Class name
     * @param string $name Name of the property to check
     * @return bool Whether the named property is public
     * @since 0.1.0
     */
    final protected function isPublicProperty($class, $name)
    {
        $properties = (array)$class;
        // as an array, non-public property names contain null byte
        return array_search($name, array_keys($properties)) !== false;
    }
}
