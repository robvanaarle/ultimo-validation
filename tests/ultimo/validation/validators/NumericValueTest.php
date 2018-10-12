<?php

namespace ultimo\validation\validators;

use PHPUnit\Framework\TestCase;

class NumericValueTest extends TestCase {
  
  public function testGetMinIsSetMin() {
    $validator = new NumericValue(3, 6);
    $this->assertEquals(3, $validator->getMin());
  }
  
  public function testGetMaxIsSetMax() {
    $validator = new NumericValue(3, 6);
    $this->assertEquals(6, $validator->getMax());
  }
  
  public function testGetWholeIsSetWhole() {
    $validator = new NumericValue(3, 6, true);
    $this->assertTrue($validator->getWhole());
  }
  
  public function testStringIsInvalid() {
    $validator = new NumericValue(3, 6);
    $this->assertFalse($validator->isValid("abc"));
    $this->assertSame([NumericValue::NOT_NUMERIC], $validator->getErrors());
  }
  
  public function testBelowMinIsInvalid() {
    $validator = new NumericValue(3, 6);
    $this->assertFalse($validator->isValid(2));
    $this->assertSame([NumericValue::TOO_LOW], $validator->getErrors());
  }
  
  public function testAboveMaxIsInvalid() {
    $validator = new NumericValue(3, 6);
    $this->assertFalse($validator->isValid(7));
    $this->assertSame([NumericValue::TOO_HIGH], $validator->getErrors());
  }
  
  public function testMinIsValid() {
    $validator = new NumericValue(3, 6);
    $this->assertTrue($validator->isValid(3));
    $this->assertSame([], $validator->getErrors());
  }
  
  public function testMaxIsValid() {
    $validator = new NumericValue(3, 6);
    $this->assertTrue($validator->isValid(6));
    $this->assertSame([], $validator->getErrors());
  }
  
  public function testFractionIsValid() {
    $validator = new NumericValue(3, 6, false);
    $this->assertTrue($validator->isValid(4.5));
    $this->assertSame([], $validator->getErrors());
  }
  
  public function testFractionIsInvalid() {
    $validator = new NumericValue(3, 6, true);
    $this->assertFalse($validator->isValid(4.5));
    $this->assertSame([NumericValue::NOT_WHOLE], $validator->getErrors());
  }
  
}