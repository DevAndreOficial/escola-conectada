<?php

namespace App\Middlewares;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class AlunoMiddleware implements IMiddleware
{
    public function handle(Request $request): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            empty($_SESSION['user']) ||
            $_SESSION['user']['perfil'] !== 'aluno'
        ) {
            header('Location: ' . URL_DESENVOLVIMENTO . '/');
            exit;
        }
    }
}
