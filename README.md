# Ultimo Validation
Extensible validation library

Allows validations to be chained. Several validators are supplied. Translation of validation messages is supported and this can be linked to Ultimo Translate.

## Requirements
* PHP 5.3
* Ultimo Translate (optional)

## Usage
	$chain = \ultimo\validation\Chain();
	$chain->appendValidator(new \ultimo\validation\validators\NotEmpty());
	$chain->appendValidator(new \ultimo\validation\validators\NumericValue(1, 255));

	if (!$chain->isValid(1337)) {
		print_r($chain->getErrors());
	}