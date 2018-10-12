<?php

namespace ultimo\validation;

abstract class Validator {
  private $defaultMessage = null;
  private $errors = array();
  private $variables = array();
  
  public function isValid($value) {
    $this->variables = array('value' => $value);
    $this->errors = array();
    return $this->valueIsValid($value);
  }
  
  protected function addError($error) {
    $this->errors[] = $error;
  }
  
  public function setDefaultMessage($defaultMessage) {
    $this->defaultMessage = $defaultMessage;
  }
  
  public function getMessages(Translator $translator) {
    $messages = array();
    foreach ($this->errors as $error) {
      $messages[] = $translator->getValidationMessage($this, $error, $this->variables);
    }
    return $messages;
  }
  
  public function getErrors() {
    return $this->errors;
  }
  
  abstract protected function valueIsValid($value);
  
  public function getVariables() {
    return $this->variables;
  }
  
  protected function setVariables(array $variables) {
    $this->variables = array_merge($this->variables, $variables);
  }
  
  protected function setVariable($name, $value) {
    $this->variables[$name] = $value;
  }
  
}