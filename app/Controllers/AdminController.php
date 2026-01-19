<?php

namespace App\Controllers;

class AdminController
{
    public function index()
    {
        return view('admin.dashboard');
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