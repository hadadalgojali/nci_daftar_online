<?php
namespace Doctrine\Common;
class ClassLoader{
    protected $fileExtension = '.php';
    protected $namespace;
    protected $includePath;
    protected $namespaceSeparator = '\\';
    public function __construct($ns = null, $includePath = null){
        $this->namespace = $ns;
        $this->includePath = $includePath;
    }
    public function setNamespaceSeparator($sep){
        $this->namespaceSeparator = $sep;
    }
    public function getNamespaceSeparator(){
        return $this->namespaceSeparator;
    }
    public function setIncludePath($includePath){
        $this->includePath = $includePath;
    }
    public function getIncludePath(){
        return $this->includePath;
    }
    public function setFileExtension($fileExtension){
        $this->fileExtension = $fileExtension;
    }
    public function getFileExtension(){
        return $this->fileExtension;
    }
    public function register() {
        spl_autoload_register(array($this, 'loadClass'));
    }
    public function unregister() {
        spl_autoload_unregister(array($this, 'loadClass'));
    }
    public function loadClass($className){
        if ($this->namespace !== null && strpos($className, $this->namespace.$this->namespaceSeparator) !== 0) {
            return false;
        }
        require ($this->includePath !== null ? $this->includePath . DIRECTORY_SEPARATOR : '')
               . str_replace($this->namespaceSeparator, DIRECTORY_SEPARATOR, $className)
               . $this->fileExtension;

        return true;
    }
    public function canLoadClass($className) {
        if ($this->namespace !== null && strpos($className, $this->namespace.$this->namespaceSeparator) !== 0) {
            return false;
        }
        $file = str_replace($this->namespaceSeparator, DIRECTORY_SEPARATOR, $className) . $this->fileExtension;
        if ($this->includePath !== null) {
            return file_exists($this->includePath . DIRECTORY_SEPARATOR . $file);
        }
        return (false !== stream_resolve_include_path($file));
    }
    public static function classExists($className) {
        if (class_exists($className, false) || interface_exists($className, false)) {
            return true;
        }
        foreach (spl_autoload_functions() as $loader) {
            if (is_array($loader)) {
                if (is_object($loader[0])) {
                    if ($loader[0] instanceof ClassLoader) { 
                        if ($loader[0]->canLoadClass($className)) {
                            return true;
                        }
                    } else if ($loader[0]->{$loader[1]}($className)) {
                        return true;
                    }
                } else if ($loader[0]::$loader[1]($className)) {
                    return true;
                }
            } else if ($loader instanceof \Closure) {
                if ($loader($className)) {
                    return true;
                }
            } else if (is_string($loader) && $loader($className)) {
                return true;
            }
        }
        return class_exists($className, false) || interface_exists($className, false);
    }
    public static function getClassLoader($className) {
         foreach (spl_autoload_functions() as $loader) {
            if (is_array($loader)
                && $loader[0] instanceof ClassLoader
                && $loader[0]->canLoadClass($className)
            ) {
                return $loader[0];
            }
        }
        return null;
    }
}
