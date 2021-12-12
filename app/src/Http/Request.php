<?php

namespace App\Http;

class Request {

    protected $method;

    protected $path = '/';

    protected $body = '';

    protected $headers = [];

    public function __construct()
    {
        $this->setPath();
        $this->setMethod();
        $this->setHeaders();
        if ($this->hasBody()) {
            $this->setBody();    
        }
    }

    protected function setHeaders():void
    {
        foreach($_SERVER as $key=>$val) {
            if (strpos($key, 'HTTP') === false) {
                continue;
            }

            $newKey = strtolower(
                str_replace(
                    'HTTP-',
                    '',
                    $key
                )
            );

            $this->headers[$newKey] = $val; 
        }
    }

    protected function setMethod():void
    {
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
    }

    protected function setPath():void
    {
        $this->path = $_SERVER['REQUEST_URI'];
    }

    protected function setBody():void
    {
        $this->body = file_get_contents('php://input');
    }

    protected function hasBody():bool
    {
        if ($_SERVER['CONTENT_LENGTH'] > 0) {
            return true;
        }

        return false;
    }

    public function getMethod():string
    {
        return $this->method;
    }

    public function getPath():string
    {
        return $this->path;
    }

}