<?php

namespace ultimo\validation\validators;

class EmailAddress extends \ultimo\validation\Validator {
  public const INVALID_EMAILADDRESS = 'invalid_emailaddress';
  
  public function valueIsValid($value): bool {
    
    // First, we check that there's one @ symbol, 
    // and that the lengths are right.
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $value)) {
      // Email invalid because wrong number of characters 
      // in one section or wrong number of @ symbols.
      $this->addError(self::INVALID_EMAILADDRESS);
      return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $value);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
      if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
        $this->addError(self::INVALID_EMAILADDRESS);
        return false;
      }
    }
    // Check if domain is IP. If not, 
    // it should be valid domain name
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) {
      $domain_array = explode(".", $email_array[1]);
      if (sizeof($domain_array) < 2) {
        $this->addError(self::INVALID_EMAILADDRESS);
        return false; // Not enough parts to domain
      }
      for ($i = 0; $i < sizeof($domain_array); $i++) {
        if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])| ([A-Za-z0-9]+))$/", $domain_array[$i])) {
          $this->addError(self::INVALID_EMAILADDRESS);
          return false;
        }
      }
    }
    
    return true;
  }
  
}