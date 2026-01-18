<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../app/Views');

$twig = new Environment($loader, [
    'cache' => __DIR__ . '/../storage/cache',
    'auto_reload' => true,
]);

return $twig;
