AccessorMutator
===============

This package provides acessors and mutators implementation.

Getters and setters are useful for variable that specifically need to be encapsulated. They implement read and write, read-only and write-only property features.

Comparing to `stdClass`, this class will throw an exception when trying to get or set undefined properties.

Public properties can be accessed and mutated using getter and setter without defining their methods. Unsetting it will destroy the variable and cannot be access or mutated using getter and setter methods afterward.

Note that using getter and setter, the property name becomes case insensitive as all method names in PHP are case insensitive.

To define a read-only property, define a private property and a getter method.

To define a write-only property, define a private property and a setter method.

Usage
-----

```php
class SomeClass
{
    use \Achsoft\Utility\AccessorMutator\AccessorMutatorTrait;
    
    private $foo;
    private $bar;
    private $baz;
    
    public $blah;
    
    public function __construct()
    {
        $this->bar = 'bar';
    }
    
    // Readable
    public function getFoo()
    {
        return $this->foo;
    }
    
    // and writeable
    public function setFoo($value)
    {
        $this->foo = $value
    }
    
    // Read-only
    public function getBar()
    {
        return $this->bar;
    }
    
    // Write-only
    public function setBaz($value)
    {
        $this->baz = $value;
    }
}

$someClass = new SomeClass();
$someClass->foo = 'foo';
$someClass->baz = 'baz';

```
`SomeClass::foo` is readable and writeable.

* `$someClass->foo` is equivalent to `$someClass->getFoo()`.
* `$someClass->foo = 'foo'` is equivalent to `$someClass->setFoo('foo')`.

`SomeClass::bar` is read-only.

* `$someClass->bar = 'foo'` or `$someClass->setBar('foo')` throws an exception.
* `isset($someClass->bar)` returns `true`.
* `unset($someClass->bar)` throws an exception.

`SomeClass::baz` is write-only

* `$someClass->baz` or `$someClass->getBaz()` throws an exception.
* `isset($someClass->baz)` returns `true`.

`SomeClass::blah` is public property. So,

* `$someClass->getBlah()` is equivalent to `$someClass->blah`.
* `$someClass->setBlah('blah')` is equivalent to `$someClass->blah = 'blah'`.



License
-------

This package is licensed under the MIT License. See the `LICENSE` file for details.
