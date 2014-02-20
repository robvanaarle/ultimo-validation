<?php

namespace ultimo\validation\validators;

class IsDir extends \ultimo\validation\Validator {
  const NOT_A_DIR = 'not_a_dir';
  
  protected function valueIsValid($value) {
    if (!is_dir($value)) {
      $this->addError(self::NOT_A_DIR);
      return false;
    }
    
    return true;
  }
}