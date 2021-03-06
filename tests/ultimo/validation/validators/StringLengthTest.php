<?php

namespace ultimo\validation\validators;

use PHPUnit\Framework\TestCase;

class StringLengthTest extends TestCase {
  
  protected $validator;
  
  public function setup() {
    $this->validator = new StringLength(3, 6);
  }
  
  public function testGetMinIsSetMin() {
    $this->assertEquals(3, $this->validator->getMin());
  }
  
  public function testGetMaxIsSetMax() {
    $this->assertEquals(6, $this->validator->getMax());
  }
  
  public function testEmptyStringIsInvalid() {
    $this->assertFalse($this->validator->isValid(''));
    $this->assertSame([StringLength::TOO_SHORT], $this->validator->getErrors());
  }
  
  public function testTooShortStringIsInvalid() {
    $this->assertFalse($this->validator->isValid('ab'));
    $this->assertSame([StringLength::TOO_SHORT], $this->validator->getErrors());
  }
  
  public function testTooLongStringIsInvalid() {
    $this->assertFalse($this->validator->isValid('abcdefg'));
    $this->assertSame([StringLength::TOO_LONG], $this->validator->getErrors());
  }
  
  public function testBetweenMinimumAndMaximumLengthStringIsValid() {
    $this->assertTrue($this->validator->isValid('abcd'));
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function testMinimumLengthStringIsValid() {
    $this->assertTrue($this->validator->isValid('abc'));
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function testMaximumLengthStringIsValid() {
    $this->assertTrue($this->validator->isValid('abcdef'));
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function testUtf8StringConsistingOfMoreBytesThanMaximumIsValid() {
    $this->assertTrue($this->validator->isValid('���')); // 3 chars, 9 bytes
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function testTooShortUtf8StringConsistingOfMoreBytesThanMinimumIsInvalid() {
    $this->assertFalse($this->validator->isValid('��')); // 2 chars, 6 bytes
    $this->assertSame([StringLength::TOO_SHORT], $this->validator->getErrors());
  }
  
  public function testWithNoMaximumLongStringIsValid() {
    $this->validator = new StringLength(3);
    $this->assertTrue($this->validator->isValid('abcdefdefghijklmnopqrstuwvwxyzabcdefdefghijklmnopqrstuwvwxyzabcdefdefghijklmnopqrstuwvwxyz'));
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function testWithNoMinimumEmptyStringIsValid() {
    $this->validator = new StringLength(null, 3);
    $this->assertTrue($this->validator->isValid(''));
    $this->assertSame([], $this->validator->getErrors());
  }
}