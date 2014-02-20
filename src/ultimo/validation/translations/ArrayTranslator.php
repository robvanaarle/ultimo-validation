<?php

namespace ultimo\validation\translations;

abstract class ArrayTranslator implements \ultimo\validation\Translator {
  
  static protected $translations = array();
  
  public function getValidationMessage(\ultimo\validation\Validator $validator, $error, array $variables) {
    $key = strtolower(str_replace('\\', '.', get_class($validator))) . '.' . $error;
 
    if (!array_key_exists($key, static::$translations)) {
      return null;
    }
    
    $message = static::$translations[$key];
    foreach($variables as $var => $val) {
      $message = str_replace('%'.$var.'%', $val, $message);
    }
    return $message;
  }
}