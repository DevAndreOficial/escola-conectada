<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* home/index.twig */
class __TwigTemplate_d251eeccfe65baf6b6ac349a58231b8d extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layouts/main.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("layouts/main.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<div class=\"app-layout d-flex\">
        <div class=\"main flex-fill\">
            <header class=\"d-flex align-items-center justify-content-between px-3 py-2 border-bottom\">
                <div class=\"d-flex align-items-center\">
                    <div class=\"rounded-circle d-inline-flex align-items-center justify-content-center\"
                        style=\"width: 45px; height: 45px; background: var(--primary); color: white; font-size: 1.5rem; font-weight: bold;\">
                        📚
                    </div>
                    <h4 class=\"mb-0\">Escola Conectada</h4>
                </div>
                <div>
                    <button class=\"btn btn-sm btn-primary me-2\" id=\"open-create\">Criar</button>
                </div>
            </header>

            <main class=\"container py-5\">
                <div class=\"row justify-content-center\">
                    <div class=\"col-md-6 col-lg-5\">
                        <div class=\"card shadow-sm login-card\">
                            <div class=\"card-body p-4\">
                                <h3 class=\"card-title mb-3\">Entrar</h3>
                                <p class=\"text-muted mb-4\">Escolha o tipo de utilzador e efetue o login.</p>

                                <form id=\"login-form\" action=\"\">
                                    <div class=\"mb-3\">
                                        <label class=\"form-label\">Perfil</label>
                                        <select id=\"profile\" class=\"form-select\" required>
                                            <option value=\"\">Selecione um perfil</option>
                                            <option value=\"aluno\">Aluno</option>
                                            <option value=\"professor\">Professor</option>
                                            <option value=\"encarregado\">Encarregado de Educação</option>
                                            <option value=\"admin\">Administrador</option>
                                        </select>
                                    </div>

                                    <div class=\"mb-3\">
                                        <label class=\"form-label\">Email o Matricula</label>
                                        <input id=\"email\" type=\"email\" class=\"form-control\"
                                            placeholder=\"seu@exemplo.com\" required />
                                    </div>

                                    <div class=\"mb-3\">
                                        <label class=\"form-label\">Senha</label>
                                        <input id=\"password\" type=\"password\" class=\"form-control\" placeholder=\"••••••••\"
                                            required />
                                    </div>

                                    <div class=\"d-grid\">
                                        <button class=\"btn btn-primary\" type=\"submit\">Entrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal (usado para criar/adicionar) -->
    <div class=\"modal fade\" id=\"createModal\" tabindex=\"-1\" aria-hidden=\"true\">
        <div class=\"modal-dialog\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\">Criar item</h5>
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                </div>
                <div class=\"modal-body\">
                    <form id=\"create-form\">
                        <div class=\"mb-3\">
                            <label class=\"form-label\">Nome</label>
                            <input type=\"text\" class=\"form-control\" id=\"create-name\" required />
                        </div>
                        <div class=\"mb-3\">
                            <label class=\"form-label\">Descrição</label>
                            <textarea class=\"form-control\" id=\"create-desc\"></textarea>
                        </div>
                    </form>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Cancelar</button>
                    <button type=\"button\" class=\"btn btn-primary\" id=\"create-submit\">Criar</button>
                </div>
            </div>
        </div>
    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/index.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "home/index.twig", "/opt/lampp/htdocs/www.escola-conectada.com/app/Views/home/index.twig");
    }
}
