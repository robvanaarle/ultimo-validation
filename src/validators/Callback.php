<?php

namespace ultimo\validation\validators;

class Callback extends \ultimo\validation\Validator {
  protected $function;
  protected $args;
  
  public function __construct(callable $function, array $args=[]) {
    $this->function = $function;
    $this->args = $args;
  }
  
  protected function valueIsValid($value): bool {
    $args = $this->args;
    array_unshift($args, $value);
    
    $result = call_user_func_array($this->function, $args);
    if ($result !== true) {
      $this->addError($result);
      return false;
    } else {
      return true;
    }
  }
  
}