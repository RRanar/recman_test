<?php

namespace App\Controllers;

use App\Viewer;

class MainController {
    public static function index()
    {
        $content = [
            'name' => 'walker',
            'authorize' => false,
            'authLink' => '/auth',
            'registerLink' => '/register'
        ];

        if (isset($_SESSION['user'])) {
            $content['name'] = $_SESSION['user']['name'];
            $content['authorize'] = $_SESSION['user']['isAuthorized'];
        }

        $content['authorize'] = $content['authorize'] ? 'Authorize' : 'Not authorize'; 

        return Viewer::render('home', $content, 'base');
    }
}