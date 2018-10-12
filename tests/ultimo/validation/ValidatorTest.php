<?php

namespace ultimo\validation;

use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase {
  
  public function testValidValueIsValidAndContainsNoErrors() {
    $mock = $this->getMockForAbstractClass('\ultimo\validation\Validator');
    $mock->expects($this->once())
         ->method('valueIsValid')
         ->with($this->equalTo('value_to_test'))
         ->will($this->returnValue(true));
    
    $this->assertTrue($mock->isValid('value_to_test'));
    $this->assertSame(array(), $mock->getErrors());
  }
  
  public function testInvalidValueIsNotValidAndContainsErrors() {
    $mock = $this->getMockForAbstractClass('\ultimo\validation\Validator');
    $mock->expects($this->once())
         ->method('valueIsValid')
         ->with($this->equalTo('value_to_test'))
         ->will($this->returnValue(false));
    
    $this->assertFalse($mock->isValid('value_to_test'));
  }
  
  public function testSubclassesCanAddErrors() {
    $mock = $this->getMockForAbstractClass('\ultimo\validation\Validator');
    $mock->expects($this->once())
         ->method('valueIsValid')
         ->will($this->returnCallback(function() use ($mock) {
           // It is bad practice to test protected functions, but addError() is
           // a function especially made available to subclasses.
           $class = new \ReflectionClass(get_class($mock));
           $method = $class->getMethod('addError');
           $method->setAccessible(true);
           
           $method->invokeArgs($mock, array('result_error'));
           
           return false;
         }));   
    $mock->isValid('value_to_test');
         
    $this->assertSame(array('result_error'), $mock->getErrors());
  }
  
  public function testSubclassesCanAddAVariable() {
    $mock = $this->getMockForAbstractClass('\ultimo\validation\Validator');
    $mock->expects($this->once())
         ->method('valueIsValid')
         ->will($this->returnCallback(function() use ($mock) {
           // It is bad practice to test protected functions, but setVariable() is
           // a function especially made available to subclasses.
           $class = new \ReflectionClass(get_class($mock));
           $method = $class->getMethod('setVariable');
           $method->setAccessible(true);
           
           $method->invokeArgs($mock, array('var_name', 42));
           
           return false;
         }));
    $mock->isValid('value_to_test');
    
    $this->assertSame(array('value' => 'value_to_test', 'var_name' => 42), $mock->getVariables());
  }
  
  public function testSubclassesCanAddVariables() {
    $mock = $this->getMockForAbstractClass('\ultimo\validation\Validator');
    $mock->expects($this->once())
         ->method('valueIsValid')
         ->will($this->returnCallback(function() use ($mock) {
           // It is bad practice to test protected functions, but setVariables() is
           // a function especially made available to subclasses.
           $class = new \ReflectionClass(get_class($mock));
           $method = $class->getMethod('setVariables');
           $method->setAccessible(true);
           
           $method->invokeArgs($mock, array(array('var_name' => 42)));
           
           return false;
         }));
    $mock->isValid('value_to_test');
    
    $this->assertSame(array('value' => 'value_to_test', 'var_name' => 42), $mock->getVariables());
  }

}