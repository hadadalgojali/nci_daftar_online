<?php
namespace Doctrine\Common\Annotations;
class Annotation{
    public $value;
    public final function __construct(array $data){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
    public function __get($name){
        throw new \BadMethodCallException(
            sprintf("Unknown property '%s' on annotation '%s'.", $name, get_class($this))
        );
    }
    public function __set($name, $value){
        throw new \BadMethodCallException(
            sprintf("Unknown property '%s' on annotation '%s'.", $name, get_class($this))
        );
    }
}