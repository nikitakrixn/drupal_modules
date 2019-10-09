<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/modal_form/templates/modal_form.html.twig */
class __TwigTemplate_3767aad2180d1ba61e16cbef85f799c61e5e4e9c61cf05b783ba06852add3a46 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@classy/misc/status-messages.html.twig", "modules/custom/modal_form/templates/modal_form.html.twig", 1);
        $this->blocks = [
            'messages' => [$this, 'block_messages'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 3];
        $filters = ["t" => 7];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['t'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doGetParent(array $context)
    {
        return "@classy/misc/status-messages.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_messages($context, array $blocks = [])
    {
        // line 3
        echo "  ";
        if ( !twig_test_empty(($context["message_list"] ?? null))) {
            // line 4
            echo "    <div class=\"message-popup\" role=\"alert\">
     <div class=\"message-popup-container\">
       <div class=\"message-popup-title\">
         <h2>";
            // line 7
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Status Message"));
            echo "</h2>
       </div>
        ";
            // line 9
            $this->displayParentBlock("messages", $context, $blocks);
            echo "
        <a href=\"#\" class=\"message-popup-close img-replace\">Close</a>
     </div>
    </div>

  ";
        }
    }

    public function getTemplateName()
    {
        return "modules/custom/modal_form/templates/modal_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 9,  75 => 7,  70 => 4,  67 => 3,  64 => 2,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/modal_form/templates/modal_form.html.twig", "/app/modules/custom/modal_form/templates/modal_form.html.twig");
    }
}
