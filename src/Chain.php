<?php

namespace ultimo\validation;

class Chain {
  protected $validators = array();
  protected $errors = array();
  protected $translator = null;
  protected $customErrors = array();
  
  public function appendValidator(Validator $validator) {
    $this->validators[] = $validator;
  }
  
  public function prependValidator(Validator $validator) {
    array_unshift($this->validators, $validator);
  }
  
  public function isValid($value, $breakOnFailure=false) {
    $this->errors = array();
    $this->customErrors = array();
    $valid = true;
    
    foreach ($this->validators as $validator) {
      if (!$validator->isValid($value)) {
        $valid = false;
        
        if ($breakOnFailure) {
          return false;
        }
      }
    }
    
    return $valid;
  }
  
  public function getMessages(Translator $translator) {
    $messages = array();
    
    foreach ($this->customErrors as $error) {
      $messages[] = $translator->getValidationMessage(null, $error, array());
    }
    
    foreach ($this->validators as $validator) {
      $messages = array_merge($messages, $validator->getMessages($translator));
    }
    
    return $messages;
  }
  
  public function getErrors() {
    $errors = $this->customErrors;
    
    foreach ($this->validators as $validator) {
      foreach ($validator->getErrors() as $error) {
        $errors[] = array($validator, $error);
      }
    }
    
    return $errors;
  }
  
  public function addCustomError($error) {
    $this->customErrors[] = $error;
  }
  
  public function getValidators() {
    return $this->validators;
  }
  
}