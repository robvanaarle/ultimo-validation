<?php

namespace ultimo\validation\validators;

class ImageType extends \ultimo\validation\Validator {
  const INVALID_TYPE = 'invalid_type';
  
  private $imageTypes;

  public function __construct(array $imageTypes) {
    $this->imageTypes = $imageTypes;
  }
  
  protected function valueIsValid($value) {
    $extensions = array();
    foreach ($this->imageTypes as $type) {
      $extensions[] = \ultimo\graphics\gd\Image::getExtensionByType($type);
    }
    
    
    $this->setVariables(array('extensions' => implode(', ', $extensions)));
    
    if ($value === null || !$value instanceof \ultimo\net\http\php\sapi\UploadedFile) {
      return true;
    }
    
    $size = @getimagesize($value->tmp_name);
    if ($size === false || !in_array($size[2], $this->imageTypes)) {
      $this->addError(self::INVALID_TYPE);
      return false;
    }
    
    return true;
  }
  
  
  
  public function getImageTypes() {
    return $this->imageTypes;
  }
}