<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});

// Router::addGroup('/contact/index/index', function () {
//     Router::get('/{controller}/{method?}', 'App\Controller\IndexController@handler');
//     // 添加其他路由...
// });


// Router::addRoute(['GET', 'POST', 'HEAD', 'PUT', 'DELETE'], '/contact/index/index/{controller}/{method}', 'App\Controller\{controller}@{method}');



Router::addRoute(['GET', 'POST', 'HEAD', 'PUT', 'DELETE'], '/contact/index/index/{controller}/{method}', function($controller='index', $method = 'index') {
    // 根据传入的控制器和方法执行相应的逻辑
    // echo 'aaa';
    $controllerName = '\\App\\Controller\\' . ucfirst($controller) ;
    if (class_exists($controllerName)) {
        $controllerInstance = new $controllerName();
        if (method_exists($controllerInstance, $method)) {
            return $controllerInstance->{$method}();
        } else {
            return 'Method not found';
        }
    } else {
        return 'Controller not found';
    }
});
