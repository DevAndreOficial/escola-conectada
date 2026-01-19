<?php

namespace App\Core;

use App\Suporte\Template;

class Controller {
    protected Template $template;

    public function __construct(string $diretorio) 
    {
        $this->template = new Template($diretorio);
    }
}