<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Core\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        // Passa o caminho das views para o pai
        parent::__construct(__DIR__ . '/../Views');
    }

    public function loginForm()
    {
        // Agora você usa o método renderizar da classe Template
        echo $this->template->renderizar('home.login', [
            'titulo' => 'Página Inicial'
        ]);
    }
    public function autenticar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $login = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST, 'senha');

        if (!$login || !$senha) {
            header('Location: ' . URL_DESENVOLVIMENTO . '/login');
            exit;
        }
        
        $usersModel = new UsersModel();
        $user = $usersModel->buscarParaLogin($login);

        // Usuário não existe
        if (!$user) {
            header('Location: ' . URL_DESENVOLVIMENTO . '/login');
            exit;
        }
        // Usuário inativo
        if ((int)$user->status !== 1) {
            header('Location: ' . URL_DESENVOLVIMENTO . '/login');
            exit;
        }


        // Senha inválida
        if (!password_verify($senha, $user->senha)) {
            header('Location: ' . URL_DESENVOLVIMENTO . '/login');
            exit;
        }

        // Login válido
        $_SESSION['user'] = [
            'id'     => $user->id_usuario,
            'nome'   => $user->username,
            'perfil' => $user->perfil
        ];

        // Redirecionamento por perfil
        switch ($user->perfil) {
            case 'admin':
                $destino = '/admin/dashboard';
                break;

            case 'professor':
                $destino = '/professor/dashboard';
                break;

            case 'aluno':
                $destino = '/aluno/dashboard';
                break;

            default:
                $destino = '/';
        }

        header('Location: ' . URL_DESENVOLVIMENTO . $destino);
        exit;
    }
}
