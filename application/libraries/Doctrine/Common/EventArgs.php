<?php
namespace Doctrine\Common;
class EventArgs{
    private static $_emptyEventArgsInstance;
    public static function getEmptyInstance(){
        if ( ! self::$_emptyEventArgsInstance) {
            self::$_emptyEventArgsInstance = new EventArgs;
        }
        return self::$_emptyEventArgsInstance;
    }
}