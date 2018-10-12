<?php

namespace ultimo\validation\validators;

class InArray extends \ultimo\validation\Validator {
  public const NOT_IN_ARRAY = 'not_in_array';
  
  protected $validValues;
  
  public function __construct(array $validValues) {
    $this->validValues = $validValues;
  }
  
  protected function valueIsValid($value): bool {
    if (!in_array($value, $this->validValues)) {
      $this->addError(self::NOT_IN_ARRAY);
      return false;
    }
    return true;
  }
}