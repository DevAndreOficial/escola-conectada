<?php
/*
function view(string $template, array $data = [])
{
    global $twig;

    return $twig->render(str_replace('.', '/', $template) . '.twig', $data);
}
*/

namespace App\Suporte;

use App\Core\Helpers;
use Twig\Lexer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class Template
{
    private Environment $twig;

    public function __construct(string $diretorio)
    {
        $loader = new FilesystemLoader($diretorio);
        $this->twig = new Environment($loader);
        
        // Registra os helpers antes de qualquer renderização
        $this->registrarHelpers();
    }

    /**
     * Renderiza uma view convertendo pontos em barras.
     * Exemplo: 'site.home' vira 'site/home.twig'
     */
    public function renderizar(string $view, array $dados = []): string
    {
        $template = str_replace('.', '/', $view) . '.twig';
        return $this->twig->render($template, $dados);
    }

    /**
     * Adiciona funções customizadas ao Twig
     */
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