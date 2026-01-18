<?php

namespace App\Controllers;

class UserController
{
    public function show($id)
    {
        // Apenas teste
        $user = ['id' => $id, 'name' => 'User ' . $id];

        return view('users.show', ['user' => $user]);
    }
}
