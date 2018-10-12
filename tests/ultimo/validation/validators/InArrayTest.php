<?php

namespace ultimo\validation\validators;

use PHPUnit\Framework\TestCase;

class InArrayTest extends TestCase {
  
  protected $validator;
  
  public function setup() {
    $this->validator = new InArray([2, "3", "abc", "12345678901234567890123456789012345678901234567890123456789012345678901234567890"]);
  }
  
  public function testElementNotInArrayIsInvalid() {
    $this->assertFalse($this->validator->isValid('not_present'));
    $this->assertSame([InArray::NOT_IN_ARRAY], $this->validator->getErrors());
  }
  
  public function testStringInArrayIsValid() {
    $this->assertTrue($this->validator->isValid('abc'));
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function testIntegerInArrayIsValid() {
    $this->assertTrue($this->validator->isValid(2));
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function testIntegerAsStringInArrayIsValid() {
    $this->assertTrue($this->validator->isValid(3));
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function testStringAsIntegerInArrayIsValid() {
    $this->assertTrue($this->validator->isValid("2"));
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function testLongStringInArrayIsValid() {
    $this->assertTrue($this->validator->isValid('12345678901234567890123456789012345678901234567890123456789012345678901234567890'));
    $this->assertSame([], $this->validator->getErrors());
  }
}