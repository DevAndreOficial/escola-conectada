<?php
/*
namespace App\Controllers;

class HomeController
{

    public function index()
    {
        //return "Conectado com sucesso!";
        return view('home.index', ['title' => 'Página Inicial']);
    }
}
*/

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Helpers;

class HomeController extends Controller
{
    public function __construct()
    {
        // Passa o caminho das views para o pai
        parent::__construct(__DIR__ . '/../Views');
    }

    public function index()
    {
        // Agora você usa o método renderizar da classe Template
        echo $this->template->renderizar('home.index', [
            'titulo' => 'Página Inicial'
        ]);
    }
}