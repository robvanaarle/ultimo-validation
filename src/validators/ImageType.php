<?php

namespace ultimo\validation\validators;

class ImageType extends \ultimo\validation\Validator {
  public const INVALID_TYPE = 'invalid_type';
  
  protected $imageTypes;

  public function __construct(array $imageTypes) {
    $this->imageTypes = $imageTypes;
  }
  
  protected function valueIsValid($value): bool {
    $extensions = [];
    foreach ($this->imageTypes as $type) {
      $extensions[] = \ultimo\graphics\gd\Image::getExtensionByType($type);
    }
    
    $this->setVariables(['extensions' => implode(', ', $extensions)]);
    
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
  
  
  public function getImageTypes(): array {
    return $this->imageTypes;
  }
}