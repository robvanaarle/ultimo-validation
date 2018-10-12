<?php

namespace ultimo\validation;

interface Translator {
  /**
   * Provides a text for an error in a validator class.
   * @param Validator $validator The class the error exists in, or null if it is
   * a custom error not bound to a specific validator.
   * @param string $error The error to get the text for.
   * @return string The text for the error.
   */
  public function getValidationMessage(Validator $validator=null, string $error, array $variables): string;
}