<?php

namespace ultimo\validation\validators;

class RegEx extends \ultimo\validation\Validator {
  private $regex;
  private $negate;
  private $error;
  
  public function __construct($regex, $error, $negate=false) {
    $this->regex = $regex;
    $this->error = $error;
    if ($negate) {
      $this->negate = true;
    } else {
      $this->negate = false;
    }
  }
  
  protected function valueIsValid($value) {
    
    $matches = preg_match($this->regex, $value);
    if (($matches == 0) != $this->negate) {
      $this->addError($this->error);
      return false;
    } else {
      return true;
    }
  }
  
}