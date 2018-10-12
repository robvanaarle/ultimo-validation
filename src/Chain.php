<?php

namespace ultimo\validation;

class Chain {
  protected $validators = [];
  protected $errors = [];
  protected $translator = null;
  protected $customErrors = [];
  
  public function appendValidator(Validator $validator): void {
    $this->validators[] = $validator;
  }
  
  public function prependValidator(Validator $validator): void {
    array_unshift($this->validators, $validator);
  }
  
  public function isValid($value, bool $breakOnFailure=false): bool {
    $this->errors = [];
    $this->customErrors = [];
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
  
  public function getMessages(Translator $translator): array {
    $messages = [];
    
    foreach ($this->customErrors as $error) {
      $messages[] = $translator->getValidationMessage(null, $error, []);
    }
    
    foreach ($this->validators as $validator) {
      $messages = array_merge($messages, $validator->getMessages($translator));
    }
    
    return $messages;
  }
  
  public function getErrors(): array {
    $errors = $this->customErrors;
    
    foreach ($this->validators as $validator) {
      foreach ($validator->getErrors() as $error) {
        $errors[] = [$validator, $error];
      }
    }
    
    return $errors;
  }
  
  public function addCustomError($error): void {
    $this->customErrors[] = $error;
  }
  
  public function getValidators(): array {
    return $this->validators;
  }
  
}