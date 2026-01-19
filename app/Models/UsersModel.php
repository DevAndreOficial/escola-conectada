<?php

namespace App\Models;
use App\Core\Database;

use PDO;

class UsersModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConexao();
    }

    public function buscarParaLogin(string $login): ?object
    {
        $sql = "
            SELECT *
            FROM usuarios
            WHERE email = :login
               OR username = :login
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        return $user ?: null;
    }
}
