<?php

spl_autoload_register(function ($className) {

    $directories = [
        __DIR__ . '/../services/',
        __DIR__ . '/../models/',
        __DIR__ . '/../controllers/',
        __DIR__ . '/../views/',
        __DIR__ . '/../config/'
    ];

    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});