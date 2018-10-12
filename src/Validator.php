<?php

namespace ultimo\validation;

abstract class Validator {
  protected $defaultMessage = null;
  protected $errors = [];
  protected $variables = [];
  
  public function isValid($value): bool {
    $this->variables = ['value' => $value];
    $this->errors = [];
    return $this->valueIsValid($value);
  }
  
  protected function addError(string $error): void {
    $this->errors[] = $error;
  }
  
  public function setDefaultMessage(string $defaultMessage): void {
    $this->defaultMessage = $defaultMessage;
  }
  
  public function getMessages(Translator $translator): array {
    $messages = [];
    foreach ($this->errors as $error) {
      $messages[] = $translator->getValidationMessage($this, $error, $this->variables);
    }
    return $messages;
  }
  
  public function getErrors(): array {
    return $this->errors;
  }
  
  abstract protected function valueIsValid($value): bool;
  
  public function getVariables(): array {
    return $this->variables;
  }
  
  protected function setVariables(array $variables): void {
    $this->variables = array_merge($this->variables, $variables);
  }
  
  protected function setVariable(string $name, $value): void {
    $this->variables[$name] = $value;
  }
  
}