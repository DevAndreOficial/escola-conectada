<?php

namespace App\Nucleo;

use Exception;

class Helpers {

    public static function redirecionar(string $url = null) {
        header("HTTP/1.1.302 Found");
        $local = ($url ? self::url($url) : self::url());
        header("Location: $local");
        exit;
    }
    public static function erro404() {
        // Você pode renderizar uma view do Twig aqui ou dar um header 404
        header("HTTP/1.0 404 Not Found");
        echo "Ops! Página não encontrada. Verifique a URL.";
        // Se tiver o Twig configurado:
        // echo $twig->render('erros/404.html');
        exit;
    }
    

 /**
 * Valida um CPF.
 *
 * @param string $cpf
 * @return bool
 */

function urlAmigavel(string $string): string {
    // Mapa de substituições para remover acentos
    $mapa = [
        'Á'=>'A','À'=>'A','Â'=>'A','Ã'=>'A','Ä'=>'A','á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a',
        'É'=>'E','È'=>'E','Ê'=>'E','Ë'=>'E','é'=>'e','è'=>'e','ê'=>'e','ë'=>'e',
        'Í'=>'I','Ì'=>'I','Î'=>'I','Ï'=>'I','í'=>'i','ì'=>'i','î'=>'i','ï'=>'i',
        'Ó'=>'O','Ò'=>'O','Ô'=>'O','Õ'=>'O','Ö'=>'O','ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o',
        'Ú'=>'U','Ù'=>'U','Û'=>'U','Ü'=>'U','ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u',
        'Ç'=>'C','ç'=>'c','Ñ'=>'N','ñ'=>'n'
    ];

    // Remove tags e espaços extras
    $url = strip_tags(trim($string));

    // Substitui caracteres acentuados
    $url = strtr($url, $mapa);

    // Substitui qualquer caractere não alfanumérico por hífen
    $url = preg_replace('/[^a-zA-Z0-9]+/', '-', $url);

    // Remove hífens múltiplos
    $url = preg_replace('/-+/', '-', $url);

    // Remove hífen no início/fim
    $url = trim($url, '-');

    // Converte para minúsculas
    return strtolower($url);
}


function dataAtual()
{
    $diaMes = date('d');
    $diaSemana = date('w');
    $mes = date('n') - 1;
    $ano = date('Y') - 1;

    $nomesDiasDaSemana = [
        'domingo',
        'segunda-feira',
        'terça-feira',
        'quarta-feira',
        'quinta-feira',
        'sexta-feira',
        'sábado'
    ];
    $nomesDosMeses = [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
    ];

    $dataFormatada = $nomesDiasDaSemana[$diaSemana] . ', '.$diaMes. ' de ' . $nomesDosMeses[$mes] . ' de ' . $ano;
    return $dataFormatada;
}

public static function url (string $url = null): string
{
    $servidor = $_SERVER['SERVER_NAME'] ?? '';
    $ambiente = ($servidor === 'localhost') ? URL_DESENVOLVIMENTO : URL_PRODUCAO;

    // Remove barra no final do ambiente e no início da URL
    return rtrim($ambiente, '/') . '/' . ltrim($url, '/');
}

// function url(string $path, array $params = []): string
// {
//     $servidor = $_SERVER['SERVER_NAME'] ?? '';
//     $ambiente = ($servidor === 'localhost') ? URL_DESENVOLVIMENTO : URL_PRODUCAO;

//     // Garante que não haja // no meio da URL
//     $base = rtrim($ambiente, '/') . '/' . ltrim($path, '/');

//     // Se tiver parâmetros, adiciona na URL
//     if (!empty($params)) {
//         $base .= '?' . http_build_query($params);
//     }

//     return $base;
// }

function localhost()
{
    $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');

    if ($servidor == 'localhost')
        return true;
    return false;
}

function validarUrl(string $url): bool
{
    // Verifica tamanho mínimo
    if (mb_strlen($url) < 10) {
        return false;
    }
    // Usa o filtro nativo do PHP
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        return false;
    }
    // Garante que começa com http:// ou https://
    return str_starts_with($url, 'http://') || str_starts_with($url, 'https://');
}

function validarEmail(string $email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarUrlComFiltro(string $url)
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

function contarTempo(string $data): string
{
    $tempo = strtotime($data);
    $agora = time();
    $diferenca = $agora - $tempo;

    if ($diferenca < 60) {
        return "agora";
    }

    $minutos = floor($diferenca / 60);
    if ($minutos < 60) {
        return $minutos === 1 ? "há 1 minuto" : "há $minutos minutos";
    }

    $horas = floor($diferenca / 3600);
    if ($horas < 24) {
        return $horas === 1 ? "há 1 hora" : "há $horas horas";
    }

    $dias = floor($diferenca / 86400);
    if ($dias < 7) {
        return $dias === 1 ? "há 1 dia" : "há $dias dias";
    }

    $semanas = floor($dias / 7);
    if ($semanas < 5) {
        return $semanas === 1 ? "há 1 semana" : "há $semanas semanas";
    }

    $meses = floor($dias / 30);
    if ($meses < 12) {
        return $meses === 1 ? "há 1 mês" : "há $meses meses";
    }

    $anos = floor($dias / 365);
    return $anos === 1 ? "há 1 ano" : "há $anos anos";

    // Estrutura Match
    // $saudacao = match ($hora) {
    //     "1", "2" => "Boa noite",
    //     default => "Bom dia"
    // };

}

function formatarValor(float|int|null $valor = null, bool $comMoeda = true): string
{
    // Se valor for null, retorna "0,00"
    $valor = $valor ?? 0;

    // Formata com 2 casas, vírgula e ponto
    $formatado = number_format($valor, 2, ',', '.');

    // Retorna com ou sem "R$"
    return $comMoeda ? "R$ {$formatado}" : $formatado;
}

function formatarNumero(int $numero = 0)
{
    return number_format($numero ? $numero : 0, 0, '.', '.');
}

/**
 * Retorna uma mensagem de saudação conforme a hora atual.
 *
 * @return string
 */
public static function saudacao(): string
{
    $hora = (int) date('H');

    if ($hora >= 0 && $hora < 6) {
        return "Boa noite";
    } elseif ($hora >= 6 && $hora < 12) {
        return "Bom dia";
    } elseif ($hora >= 12 && $hora < 18) {
        return "Boa tarde";
    } else {
        return "Boa noite";
    }
}

/**
 * Resume um texto
 * 
 * @param string $texto texto para resumir
 * @param int $limite numero total de caracteres.
 * @param string $continue (opcional) o que dever ser exibido ao final do resumo.
 * @return string $textoResumido 
 */
    public static function resumirTexto($texto, $limite, $continue = '...')
    {
        $textoLimpo = trim(strip_tags($texto));
        if (mb_strlen($textoLimpo) < $limite)
            return $textoLimpo;
        $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ''));

        return $resumirTexto . $continue;
    }
}
