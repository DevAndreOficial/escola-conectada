<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\ProfessorMiddleware;
use App\Middlewares\AlunoMiddleware;
use App\Middlewares\EncarregadoMiddleware;
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

            Router::get('/logout', 'AuthController@logout')->name('logout');
            Router::get('/', 'HomeController@index')->name('home');
            Router::get('/sobre', 'SobreController@index');

            /*
            |----------------------------
            | Rotas do administrador
            |----------------------------
            
            Router::group([
                'middleware' => AdminMiddleware::class,
                'namespace' => 'App\Controllers\Admin'
            ], function () {
                Router::get('/admin/dashboard', 'AdminController@dashboard');
                Router::get('/admin/usuarios', 'AdminController@usuarios');
            });
            */

            Router::group(['middleware' => AdminMiddleware::class], function () {
                Router::get('/admin/dashboard', 'Admin\AdminController@dashboard');
                Router::get('/admin/usuarios', 'Admin\AdminController@usuarios');
                // outras rotas aqui
            });




            /*
            |----------------------------
            | Rotas do professor
            |----------------------------
            */
            Router::group(['middleware' => ProfessorMiddleware::class], function () {
                Router::get('/professor/dashboard', 'ProfessorController@dashboard');
                Router::get('/professor/atividades', 'ProfessorController@atividades');
                // outras rotas do professor aqui
            });

            /*
            |----------------------------
            | Rotas do aluno
            |----------------------------
            */
            Router::group(['middleware' => AlunoMiddleware::class], function () {
                Router::get('/aluno/dashboard', 'AlunoController@dashboard');
                Router::get('/aluno/atividades', 'AlunoController@atividades');
                // outras rotas do aluno aqui
            });

            /*
            |----------------------------
            | Rotas do encarregado
            |----------------------------
            */
            Router::group(['middleware' => EncarregadoMiddleware::class], function () {
                Router::get('/encarregado/dashboard', 'EncarregadoController@dashboard');
                // outras rotas do encarregado aqui
            });
        });
    });

    Router::start();
} catch (NotFoundHttpException $e) {
    Helpers::erro404();
} catch (\Throwable $e) {
    Helpers::erro500($e);
}
