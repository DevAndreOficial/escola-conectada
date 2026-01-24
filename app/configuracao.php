<?php
// Arquivo de configuração";

date_default_timezone_set('UTC');

define('SITE_NOME', 'Escola Conectada');
define('SITE_DESCRICAO', 'Sistema');
define('APP_DEBUG', true);

define('APP_ENV', $_SERVER['SERVER_NAME'] === 'localhost' ? 'dev' : 'prod');

define('APP_URL_DEV', 'http://localhost');
define('APP_URL_PROD', 'https://www.escola-conectada.com');

define('APP_BASE_PATH', '/www.escola-conectada.com');


// Configurações de Banco de Dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'escola_conectada_db');
define('DB_USUARIO', 'root');
define('DB_PORT', '3306');
define('DB_SENHA', '');
define('DB_CHARSET', 'utf8');
define('DB_OPCOES', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_CASE => PDO::CASE_NATURAL,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
]);

// Recursos Públicos
define('URL_CSS', APP_BASE_PATH . 'public/css/');
define('URL_JS',  APP_BASE_PATH . 'public/js/');
define('URL_IMG', APP_BASE_PATH . 'public/img/');

// Caminho físico do projeto no servidor
define('DIR_PATH', __DIR__ . '/'); 

// Pastas específicas
define('DIR_INCLUDES', DIR_PATH . 'app/includes/');
define('DIR_VIEWS',    DIR_PATH . 'app/Views/');
define('DIR_MODELS',   DIR_PATH . 'app/Models/');

// Informações do Sistema
define('APP_NAME', 'Escola Conectada');
define('APP_VERSION', '1.0.0');
define('SUPPORT_EMAIL', 'contato@escola-conectada.com');
