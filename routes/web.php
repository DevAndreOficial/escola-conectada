<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use App\Middlewares\AuthMiddleware;
use App\Core\Helpers;

try {

    /*
    |--------------------------------------------------
    | Configuração base
    |--------------------------------------------------
    */

    Router::setDefaultNamespace('App\Controllers');

    /*
    |--------------------------------------------------
    | Grupo principal com prefixo do ambiente
    |--------------------------------------------------
    */

    Router::group(['prefix' => URL_DESENVOLVIMENTO], function () {

        /*
        |----------------------------
        | Rotas públicas (sem login)
        |----------------------------
        */

        Router::get('/login', 'AuthController@loginForm')->name('login.form');
        Router::post('/login', 'AuthController@autenticar')->name('login.post');

        /*
        |----------------------------
        | Rotas protegidas (com login)
        |----------------------------
        */

        Router::group(['middleware' => AuthMiddleware::class], function () {

            Router::get('/', 'HomeController@index')->name('home');

            Router::get('/sobre', 'SobreController@index');

            Router::get('/users', 'UserController@index')->name('users.index');
            Router::get('/users/{id}', 'UserController@show')->name('users.show');

            Router::get('/logout', 'AuthController@logout')->name('logout');
        });

    });

    Router::start();

} catch (NotFoundHttpException $e) {

    Helpers::erro404();

} catch (\Throwable $e) {

    Helpers::erro500($e);

}
