<?php
namespace Doctrine\Common;
class Version{
    const VERSION = '2.3.0';
    public static function compare($version) {
        $currentVersion = str_replace(' ', '', strtolower(self::VERSION));
        $version = str_replace(' ', '', $version);

        return version_compare($version, $currentVersion);
    }
}