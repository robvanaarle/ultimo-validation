<?php

namespace ultimo\validation\validators;

class StringLength extends \ultimo\validation\Validator {
  const TOO_SHORT = 'too_short';
  const TOO_LONG = 'too_long';
  
  private $min;
  private $max;
  
  public function __construct($min, $max=null) {
    $this->min = $min;
    $this->max = $max;
  }
  
  protected function valueIsValid($value) {
    $this->setVariables(array('min' => $this->min, 'max' => $this->max));
    
    if ($this->min !== null && strlen($value) < $this->min) {
      $this->addError(self::TOO_SHORT);
      return false;
    } else if ($this->max !== null && strlen($value) > $this->max) {
      $this->addError(self::TOO_LONG);
      return false;
    }
    return true;
  }
  
  public function getMin() {
    return $this->min;
  }
  
  public function getMax() {
    return $this->max;
  }
}