<?php 

namespace App\Controllers;

use App\Viewer;
use App\Http\Request;

class RegisterController {

    public static function index()
    {
        return Viewer::render(
            'register',
             [
                 'registerLink' => '/register',
                 'authLink' => '/auth'
             ],
              'base'
        );
    }

    public static function register(Request $request)
    {
        var_dump($request->getBody());
        exit;
    }

}