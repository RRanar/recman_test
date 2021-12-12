<?php

namespace App;

use App\Http\Router;
use App\Http\NotFoundHttpException;
use App\Models\User;

class Application {

    private function __construct(){}

    public static function start()
    {
       try {
            session_start();
            Router::start();
       } catch (NotFoundHttpException $e) {
            echo 'Not Found 404';
       } catch (\Exception $e) {
           echo $e->getMessage();
       }
    }
}