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

namespace Test\Fixture;

/**
 * Mock Object that use AccessorMutatorTrait.
 * 
 * @author Achmad F. Ibrahim <acfatah@gmail.com>
 */

class Object
{
    use \Achsoft\Utility\AccessorMutator\AccessorMutatorTrait;
    
    private $privateProperty = 'foo';
    protected $protectedProperty = 'foo';
    public $publicProperty = 'foo';
    
    private $readOnlyProperty = 'foo';
    private $writeOnlyProperty = 'foo';
    private $propertyByGetterAndSetter = 'foo';
    
    public function getReadOnlyProperty()
    {
        return $this->readOnlyProperty;
    }
    
    public function setWriteOnlyProperty($value)
    {
        $this->writeOnlyProperty = $value;
    }
    
    public function getPropertyByGetterAndSetter()
    {
        return $this->propertyByGetterAndSetter;
    }
    
    public function setPropertyByGetterAndSetter($value)
    {
        $this->propertyByGetterAndSetter = $value;
    }
}
