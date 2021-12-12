<?php

namespace App\Http;

class Router {
    
    protected static $request;

    protected static $paths = [];

    private function __construct(){}

    public static function start()
    {
        if (empty(self::$request)) {
            self::$request = new Request();
        }

        $requestMethod = self::$request->getMethod();
        $requestPath = self::$request->getPath();

        foreach (self::$paths[$requestMethod] as $path=>$callback) {
            if ($path == $requestPath) {
                return call_user_func_array($callback, [self::$request]);
            }
        }

        throw new NotFoundHttpException;
    }

    public static function get(string $path, $callback)
    {
        self::$paths['get'][$path] = $callback;
    } 

    public static function post(string $path, $callback)
    {
        self::$paths['post'][$path] = $callback;
    } 
}