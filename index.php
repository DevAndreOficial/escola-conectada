<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/app/configuracao.php';
require __DIR__ . '/vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;

// Twig
$twig = require __DIR__ . '/bootstrap/twig.php';
$GLOBALS['twig'] = $twig;

// Helpers
require __DIR__ . '/app/Helpers/view.php';

// Rotas
require __DIR__ . '/routes/web.php';