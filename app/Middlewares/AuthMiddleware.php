<?php

namespace App\Middlewares;

use App\Core\Helpers;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter;

class AuthMiddleware implements IMiddleware
{
    public function handle(Request $request): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['user'])) {
            SimpleRouter::response()
                ->redirect(Helpers::url('login'))
                ->send();
            exit;
        }
    }
}
