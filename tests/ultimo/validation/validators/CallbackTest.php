<?php

namespace ultimo\validation\validators;

use PHPUnit\Framework\TestCase;

class CallbackTest extends TestCase {
  public function testCallbackValidationIsValid() {
    $mock = $this->createMock(CallbackMock::class);
    $mock->expects($this->once())
         ->method('callback')
         ->with($this->equalTo('value_to_test'), $this->equalTo('foo'), $this->equalTo(42))
         ->will($this->returnValue(true));
    
    $validator = new Callback([$mock, 'callback'], ['foo', 42]);
    
    $this->assertTrue($validator->isValid('value_to_test'));
    $this->assertSame([], $validator->getErrors());
  }
  
  public function testCallbackValidationIsInvalid() {
    $mock = $this->createMock(CallbackMock::class);
    $mock->expects($this->once())
         ->method('callback')
         ->will($this->returnValue('some_error'));
    
    $validator = new Callback([$mock, 'callback']);
    
    $this->assertFalse($validator->isValid('value_to_test'));
    $this->assertSame(['some_error'], $validator->getErrors());
  }
}

class CallbackMock {
  function callback($value, ...$args) {
    
  }
}