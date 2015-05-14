<?php

namespace ultimo\validation\validators;

class NumericValue extends \ultimo\validation\Validator {
  
  const TOO_LOW = 'too_low';
  const TOO_HIGH = 'too_high';
  const NOT_WHOLE = 'not_whole';
  
  private $min;
  private $max;
  private $whole;
  
  public function __construct($min, $max=null, $whole=false) {
    $this->min = $min;
    $this->max = $max;
    $this->whole = $whole;
  }
  
  protected function valueIsValid($value) {
    $this->setVariables(array('min' => $this->min, 'max' => $this->max));
    
    if ($this->whole && (is_int($value) || !preg_match("/^-?[0-9]+$/", $value))) {
      $this->addError(self::NOT_WHOLE);
      return false;
    } if ($this->min !== null && $value < $this->min) {
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