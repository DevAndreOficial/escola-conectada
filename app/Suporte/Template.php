<?php

namespace sistema\Suporte;

use App\Nucleo\Helpers;
use Twig\Lexer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class Template
{
    private Environment $twig;

    public function __construct(string $diretorio)
    {
        // Configura o carregador e o ambiente Twig
        $loader = new FilesystemLoader($diretorio);
        $this->twig = new Environment($loader);
        
        // Registra as funções (helpers) antes do uso
        $this->registrarHelpers();
    }

    /**
     * Ajustado para aceitar o formato "pasta.arquivo"
     */
    public function renderizar(string $view, array $dados = []): string
    {
        $caminho = str_replace('.', '/', $view) . '.twig';
        return $this->twig->render($caminho, $dados);
    }

    private function registrarHelpers(): void
    {
        $this->twig->addFunction(new TwigFunction('url', function (string $url = null) {
            return Helpers::url($url);
        }));

        $this->twig->addFunction(new TwigFunction('saudacao', function () {
            return Helpers::saudacao();
        }));

        $this->twig->addFunction(new TwigFunction('resumirTexto', function ($texto, $limite = 100) {
            return Helpers::resumirTexto($texto, $limite);
        }));
    }
}