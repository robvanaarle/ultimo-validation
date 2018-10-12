<?php

namespace ultimo\validation\validators;

class Date extends \ultimo\validation\Validator {
  const INVALID_DATE = 'invalid_date';
  
  protected $format;
  
  public function __construct($format) {
    $this->format = $format;
  }
  
  protected function phpFormatToReadableFormat($format) {
    $table = array(
     'y' => 'yy',
     'Y' => 'yyyy',
     'm' => 'mm',
     'n' => 'm',
     'd' => 'dd',
     'j' => 'd',
     'H' => 'hh',
     'h' => 'h',
     'i' => 'mm',
     's' => 'ss',
     'a' => 'am',
     'A' => 'AM'
    );
    
    return str_replace(array_keys($table), $table, $format);
  }
  
  protected function valueIsValid($value) {
    $this->setVariable('format', $this->phpFormatToReadableFormat($this->format));
    
    $dateTime = \DateTime::createFromFormat($this->format, $value);
    
    if ($dateTime === false) {
      $this->addError(self::INVALID_DATE);
      return false;
    }
    
    $formattedValue = $dateTime->format($this->format);
    if ($formattedValue !== $value) {
      $this->addError(self::INVALID_DATE);
      return false;
    }
    
    return true;
  }
}