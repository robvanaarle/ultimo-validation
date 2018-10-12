<?php

namespace ultimo\validation\validators;

use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase {
  protected $validator;
  
  public function setup() {
    $this->validator = new EmailAddress();
  }
  
  public function provideValidEmailAddresses() {
    return [
      ['name@server.com'],
      ['name.lastname@server.com'],
      ['name@server.co.uk'],
      ['name+label@server.com']
    ];
  }
  
  /**
   * @dataProvider provideValidEmailAddresses
   */
  public function testEmailAddressIsValid($emailAddress) {
    $this->assertTrue($this->validator->isValid($emailAddress));
    $this->assertSame([], $this->validator->getErrors());
  }
  
  public function provideInvalidEmailAddresses() {
    return [
      ['name@server'],
      ['@server.com'],
      ['name@server.c'],
      ['name@weird@server.com']
    ];
  }
  
  /**
   * @dataProvider provideInvalidEmailAddresses
   */
  public function testEmailAddressIsInvalid($emailAddress) {
    $this->assertFalse($this->validator->isValid($emailAddress));
    $this->assertSame([EmailAddress::INVALID_EMAILADDRESS], $this->validator->getErrors());
  }
}