<?php

namespace ultimo\validation\translations;

class nl_NL extends ArrayTranslator
{
  static protected $translations = array(
    'ultimo.validation.validators.notempty.empty' => 'Dit mag niet leeg zijn.',
    'ultimo.validation.validators.stringlength.too_short' => 'Te kort, minimaal %min% tekens.',
    'ultimo.validation.validators.stringlength.too_long' => 'Te lang, maximaal %max% tekens.',
    'ultimo.validation.validators.emailaddress.invalid_emailaddress' => 'Ongeldig email adres.'
  );
  
}