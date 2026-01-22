<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class AdminController extends Controller
{

    public function __construct()
    {
        // Passa o caminho das views para o pai
        parent::__construct(__DIR__ . '/../../Views');
    }

    public function dashboard()
    {
        // Agora você usa o método renderizar da classe Template
        echo $this->template->renderizar('administracao.dashboard', [
            'titulo' => 'Página Inicial'
        ]);
    }

    public function users()
    {
        return view('admin.users');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function logout()
    {
        session_destroy();
        return redirect('/login');
    }
}