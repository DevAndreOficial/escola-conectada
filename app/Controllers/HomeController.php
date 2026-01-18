<?php

namespace App\Controllers;

class HomeController
{

    public function index()
    {
        //return "Conectado com sucesso!";
        return view('home.index', ['title' => 'Página Inicial']);
    }
}
