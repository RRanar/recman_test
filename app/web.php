<?php

use App\Application;
use App\Http\Router;
use App\Controllers\MainController;
use App\Controllers\RegisterController;
use App\Controllers\AuthController;

// GET
Router::get('/', [MainController::class, 'index']);
Router::get('/register', [RegisterController::class, 'index']);
Router::get('/auth', [AuthController::class, 'index']);
// POST
Router::post('/register', [RegisterController::class, 'register']);
Router::post('/auth', [AuthController::class, 'auth']);

Application::start();