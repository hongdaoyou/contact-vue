<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::any('/contact/index/index/{controller}/{method?}', function ($controller, $method = 'index') {
    $namespace = 'App\\Http\\Controllers\\';
    $controllerName = $namespace . ucfirst($controller) ; //'. 'Controller';
    
    if (class_exists($controllerName)) {
        $instance = app()->make($controllerName);
        
        if (method_exists($instance, $method)) {
            return app()->call([$instance, $method]);
        }
    }
    
    abort(404);
});
