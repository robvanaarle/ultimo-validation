<?php

namespace ultimo\validation\validators;

class NotEmpty extends \ultimo\validation\Validator {
  public const IS_EMPTY = 'empty';
  
  protected function valueIsValid($value): bool {
    if ((is_string($value) && strlen($value) == 0) || $value === null) {
      $this->addError(self::IS_EMPTY);
      return false;
    }
    
    return true;
  }
}