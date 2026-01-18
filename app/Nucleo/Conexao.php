<?php
//Seguindo o padrão simgletron

namespace sistema\Nucleo;

use PDO;
use PDOException;


class Conexao
{
    private static $instacia;

    public static function getInstacia(): PDO
    {
        if (empty(self::$instacia)) {
            try {
                self::$instacia = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_BANCO, DB_USUARIO, DB_SENHA, DB_OPCOES);
            } catch (PDOException $e) {
                die("Erro de conexão" . $e->getMessage());
            }
        }
        return self::$instacia;
    }

    protected function __construct() {}
    private function __clone(): void {}
}
