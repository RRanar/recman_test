<?php

if (in_array('.env', scandir(__DIR__)) && is_readable(__DIR__. '/.env')) {
    $envsContent = file(__DIR__. '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envsContent as $envPair) {
        if (strpos(trim($envPair), '#') === 0 ) {
            continue;
        }
        [$name, $val] = explode('=', $envPair, 2);
        $name = trim($name);
        if (getenv($name) === false) {
            putenv($name. '='. trim($val));
        }
    }
}

spl_autoload_register(function ($class) {
    $baseDir = __DIR__. '/' . getenv('SRC_DIRECTORY');
    $classComponents = explode('\\', $class);
    $realClass = array_pop($classComponents);
    $mainNamespace = getenv('MAIN_NAMESPACE');

    if (!empty($classComponents)) {
        $classComponents[0] = $baseDir;
    }

    $classDir = implode(DIRECTORY_SEPARATOR, $classComponents);

    if (is_dir($classDir)) {
        require_once $classDir . '/' . $realClass . '.php';
    }
});