<?php

namespace ultimo\validation\validators;

class NotEmptyTest extends \PHPUnit_Framework_TestCase {
  protected $validator;
  
  public function setup() {
    $this->validator = new NotEmpty();
  }
  
  public function testEmptyStringIsInvalid() {
    $this->assertFalse($this->validator->isValid(''));
  }
  
  public function testNonEmptyStringIsValid() {
    $this->assertTrue($this->validator->isValid('a'));
  }
  
  public function testIntegerIsValid() {
    $this->assertTrue($this->validator->isValid(42));
  }
  
  public function testFloatIsValid() {
    $this->assertTrue($this->validator->isValid(1.1));
  }
  
  public function testZeroFloatIsValid() {
    $this->assertTrue($this->validator->isValid(0.0));
  }
  
  public function testInvalidStringReturnsErrorEmpty() {
    $this->validator->isValid('');
    $this->assertSame(array(NotEmpty::IS_EMPTY), $this->validator->getErrors());
  }
}