<?php

namespace ultimo\validation\validators;

class StringLength extends \ultimo\validation\Validator {
  const TOO_SHORT = 'too_short';
  const TOO_LONG = 'too_long';
  
  protected $min;
  protected $max;
  
  public function __construct(?int $min, ?int $max=null) {
    $this->min = $min;
    $this->max = $max;
  }
  
  protected function valueIsValid($value): bool {
    $this->setVariables(['min' => $this->min, 'max' => $this->max]);
    
    if ($this->min !== null && strlen($value) < $this->min) {
      $this->addError(self::TOO_SHORT);
      return false;
    } else if ($this->max !== null && strlen($value) > $this->max) {
      $this->addError(self::TOO_LONG);
      return false;
    }
    return true;
  }
  
  public function getMin(): ?int {
    return $this->min;
  }
  
  public function getMax(): ?int {
    return $this->max;
  }
}