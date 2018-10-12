<?php

namespace ultimo\validation\validators;

use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase {
  protected $validator;
  
  public function setup() {
    $this->validator = new EmailAddress();
  }
  
  public function provideValidEmailAddresses() {
    return array(
      array('name@server.com'),
      array('name.lastname@server.com'),
      array('name@server.co.uk'),
      array('name+label@server.com')
    );
  }
  
  /**
   * @dataProvider provideValidEmailAddresses
   */
  public function testEmailAddressIsValid($emailAddress) {
    $this->assertTrue($this->validator->isValid($emailAddress));
    $this->assertSame(array(), $this->validator->getErrors());
  }
  
  public function provideInvalidEmailAddresses() {
    return array(
      array('name@server'),
      array('@server.com'),
      array('name@server.c'),
      array('name@weird@server.com')
    );
  }
  
  /**
   * @dataProvider provideInvalidEmailAddresses
   */
  public function testEmailAddressIsInvalid($emailAddress) {
    $this->assertFalse($this->validator->isValid($emailAddress));
    $this->assertSame(array(EmailAddress::INVALID_EMAILADDRESS), $this->validator->getErrors());
  }
}