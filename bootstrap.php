<?php

class Autoloader
{
    public static function register()
    {

        $directory = array(
            'config/', 'src/'
        );

        $fileFormat = '.class.php';

        foreach ($directory as $current_dir) {
            $files = scandir($current_dir);
            foreach ($files as $current_file) {
                if (strpos($current_file, $fileFormat) > 0) {
                    include $current_dir . $current_file;
                }
            }
        }
    }
}

Autoloader::register();
