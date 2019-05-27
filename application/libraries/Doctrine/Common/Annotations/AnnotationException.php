<?php
namespace Doctrine\Common\Annotations;
class AnnotationException extends \Exception{
    public static function syntaxError($message){
        return new self('[Syntax Error] ' . $message);
    }
    public static function semanticalError($message){
        return new self('[Semantical Error] ' . $message);
    }
    public static function semanticalErrorConstants($identifier, $context = null){
        return self::semanticalError(sprintf(
            "Couldn't find constant %s%s", $identifier,
            $context ? ", $context." : "."
        ));
    }
    public static function creationError($message) {
        return new self('[Creation Error] ' . $message);
    }
    public static function typeError($attributeName, $annotationName, $context, $expected, $actual) {
        return new self(sprintf(
            '[Type Error] Attribute "%s" of @%s declared on %s expects %s, but got %s.',
            $attributeName,
            $annotationName,
            $context,
            $expected,
            is_object($actual) ? 'an instance of '.get_class($actual) : gettype($actual)
        ));
    }
    public static function requiredError($attributeName, $annotationName, $context, $expected) {
        return new self(sprintf(
            '[Type Error] Attribute "%s" of @%s declared on %s expects %s. This value should not be null.',
            $attributeName,
            $annotationName,
            $context,
            $expected
        ));
    }
}
