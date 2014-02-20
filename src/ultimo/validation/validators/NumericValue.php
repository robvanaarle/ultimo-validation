<?php

namespace ultimo\validation\validators;

class NumericValue extends \ultimo\validation\Validator {
  
  const TOO_LOW = 'too_low';
  const TOO_HIGH = 'too_high';
  
  private $min;
  private $max;
  
  public function __construct($min, $max=null) {
    $this->min = $min;
    $this->max = $max;
  }
  
  protected function valueIsValid($value) {
    $this->setVariables(array('min' => $this->min, 'max' => $this->max));
    
    if ($this->min !== null && $value < $this->min) {
      $this->addError(self::TOO_LOW);
      return false;
    } else if ($this->max !== null && $value > $this->max) {
      $this->addError(self::TOO_HIGH);
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
  
  public function getVariables() {
    return array('min' => $this->min, 'max' => $this->max);
  }
}