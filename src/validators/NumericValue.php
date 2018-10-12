<?php

namespace ultimo\validation\validators;

class NumericValue extends \ultimo\validation\Validator {
  public const TOO_LOW = 'too_low';
  public const TOO_HIGH = 'too_high';
  public const NOT_WHOLE = 'not_whole';
  public const NOT_NUMERIC = 'not_numeric';
  
  protected $min;
  protected $max;
  protected $whole;
  
  public function __construct(?int $min, ?int $max=null, bool $whole=false) {
    $this->min = $min;
    $this->max = $max;
    $this->whole = $whole;
  }
  
  protected function valueIsValid($value): bool {
    $this->setVariables(['min' => $this->min, 'max' => $this->max]);
    
    if (!is_numeric($value)) {
      $this->addError(self::NOT_NUMERIC);
      return false;
    } else if ($this->whole && (is_int($value) || !preg_match("/^-?[0-9]+$/", $value))) {
      $this->addError(self::NOT_WHOLE);
      return false;
    } else if ($this->min !== null && $value < $this->min) {
      $this->addError(self::TOO_LOW);
      return false;
    } else if ($this->max !== null && $value > $this->max) {
      $this->addError(self::TOO_HIGH);
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
  
  public function getWhole(): ?bool {
    return $this->whole;
  }
  
  public function getVariables(): array {
    return ['min' => $this->min, 'max' => $this->max];
  }
}