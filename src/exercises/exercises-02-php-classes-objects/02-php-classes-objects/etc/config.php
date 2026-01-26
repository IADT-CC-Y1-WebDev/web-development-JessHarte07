<?php

spl_autoload_register(function ($class) {
    // Convert namespace separators to directory separators
    // College\Student becomes College/Student
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Build the full file path
    $file = __DIR__ . '/../classes/' . $path . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});
