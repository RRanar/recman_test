<?php

const NAMESPACE_PATHS = [
    'App' => __DIR__. '/src',
    'App\\Models' => __DIR__ . '/src/Models',
    'App\\Controllers' => __DIR__. '/src/Controllers'
];

spl_autoload_register(function ($class) {
    $classComponents = explode('\\', $class);
    $realClass = array_pop($classComponents);
    $classNamespace = implode('\\', $classComponents);

    if (in_array($classNamespace, array_keys(NAMESPACE_PATHS))) {
        require_once NAMESPACE_PATHS[$classNamespace] . '/' . $realClass . '.php';
    }
});