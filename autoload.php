<?php
function classLoader($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/src/class/' . $path . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('classLoader');