<?php
// Note o caminho exato extraído do seu erro:
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use App\Nucleo\Helpers;

try {
    Router::setDefaultNamespace('\App\Controllers');

    Router::group(['prefix' => URL_DESENVOLVIMENTO], function () {
        Router::get('/', 'HomeController@index');
        Router::get('/sobre', 'SobreController@index');
        Router::get('/users', 'UserController@index')->name('users.index');
        Router::get('/users/{id}', 'UserController@show')->name('users.show');

        // Processa o POST do formulário
        Router::post('/login', 'LoginController@autenticar')->name('login.post');
        // Logout
        Router::get('/logout', 'LoginController@logout')->name('logout');
    });

    Router::start();
} catch (NotFoundHttpException $e) {
    // Agora o PHP vai "reconhecer" o erro e entrar aqui
    Helpers::erro404();
} catch (\Exception $e) {
    // Para qualquer outro tipo de erro
    echo "Erro interno: " . $e->getMessage();
}
