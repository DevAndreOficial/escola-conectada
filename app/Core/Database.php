<?php
//Seguindo o padrão simgletron

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instacia;

    public static function getConexao(): PDO
    {
        if (empty(self::$instacia)) {
            try {
                self::$instacia = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USUARIO, DB_SENHA, DB_OPCOES);
            } catch (PDOException $e) {
                die("Erro de conexão" . $e->getMessage());
            }
        }
        return self::$instacia;
    }

    protected function __construct() {}
    private function __clone(): void {}
}
