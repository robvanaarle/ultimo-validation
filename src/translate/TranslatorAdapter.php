<?php

namespace ultimo\validation\translate;

class TranslatorAdapter implements \ultimo\validation\Translator {
  protected $translator;
  
  public function __construct(\ultimo\translate\Translator $translator) {
    $this->translator = $translator;
  }
  
  public function getValidationMessage(\ultimo\validation\Validator $validator=null, $error, array $variables): string {
    if ($validator !== null) {
      $nameElems = explode('\\', get_class($validator));
      $className = array_pop($nameElems);
      $key = 'validate.' . strtolower($className) . '.' . $error;
    } else {
      $key = $error;
    }

    return $this->translator->translate($key, $variables);
  }
}