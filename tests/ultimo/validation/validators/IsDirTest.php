<?php

namespace ultimo\validation\validators;

use PHPUnit\Framework\TestCase;

class IsDirTest extends TestCase {
  
  public function testExistingDirIsValid() {
    $validator = new IsDir();
    $this->assertTrue($validator->isValid(__DIR__));
  }
  
  public function testNonExistingDirIsInvalid() {
    $validator = new IsDir();
    $this->assertFalse($validator->isValid(__DIR__ . 'nonexistingpostfix'));
    $this->assertSame([IsDir::NOT_A_DIR], $validator->getErrors());
  }
}