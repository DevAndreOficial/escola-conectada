<?php

namespace sistema\Nucleo; 
// Define o namespace da classe (ajuda na organização do projeto e evita conflitos de nomes)

/**
 * Documentação da classe
 * Classe responsável por criar e renderizar mensagens (alerts) no formato HTML
 */
class Mensagem {
    
    private $texto; // Armazena o texto da mensagem
    public $css;    // Armazena as classes CSS (ex: alert alert-success)

    // Encadeamento de métodos - é quando um método retorna a própria classe (para usar em sequência)
    public function sucesso(string $mensagem): Mensagem {
        // Define a classe CSS para mensagem de sucesso (corrigido: success, antes estava "sucess")
        $this->css = "alert alert-success";  
        
        // Filtra o texto da mensagem antes de armazenar
        $this->texto = $this->filtrar($mensagem);

        // Retorna a própria instância, permitindo encadeamento de métodos
        return $this;
    }

    // Renderiza a mensagem em formato HTML
    public function renderizar(): string {
        // Cria uma <div> com a classe CSS e o texto da mensagem
        return "<div class='[$this->css}' role='alert'> {$this->texto}<div>";
    }

    // Método privado que filtra a mensagem contra códigos maliciosos (XSS)
    private function filtrar(string $mensagem): string {
        return filter_var($mensagem, FILTER_SANITIZE_SPECIAL_CHARS);
        // Também poderia usar FILTER_DEFAULT, mas FILTER_SANITIZE_SPECIAL_CHARS é mais seguro
    }

    // Método mágico __toString()
    // Permite que o objeto seja usado diretamente em um echo
    public function __toString()
    {
        // Quando o objeto for convertido em string, retorna o HTML da mensagem
        return $this->renderizar();
    }
}
