<?php

namespace ultimo\validation\validators;

use PHPUnit\Framework\TestCase;

class NotEmptyTest extends TestCase {
  protected $validator;
  
  public function setup() {
    $this->validator = new NotEmpty();
  }
  
  public function testEmptyStringIsInvalid() {
    $this->assertFalse($this->validator->isValid(''));
    $this->assertSame(array(NotEmpty::IS_EMPTY), $this->validator->getErrors());
  }
  
  public function testNonEmptyStringIsValid() {
    $this->assertTrue($this->validator->isValid('a'));
    $this->assertSame(array(), $this->validator->getErrors());
  }
  
  public function testIntegerIsValid() {
    $this->assertTrue($this->validator->isValid(42));
    $this->assertSame(array(), $this->validator->getErrors());
  }
  
  public function testFloatIsValid() {
    $this->assertTrue($this->validator->isValid(1.1));
    $this->assertSame(array(), $this->validator->getErrors());
  }
  
  public function testZeroFloatIsValid() {
    $this->assertTrue($this->validator->isValid(0.0));
    $this->assertSame(array(), $this->validator->getErrors());
  }
  
}