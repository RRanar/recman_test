<?php

namespace App\Controllers;

use App\Viewer;

class AuthController {

    public static function index()
    {
        return Viewer::render(
            'auth',
             [
                 'registerLink' => '/register',
                 'authLink' => '/auth'
             ],
              'base'
        );
    }

}