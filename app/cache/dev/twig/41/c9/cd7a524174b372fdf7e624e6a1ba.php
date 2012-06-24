<?php

/* CodeSearchBundle:Search:index.html.twig */
class __TwigTemplate_41c9cd7a524174b372fdf7e624e6a1ba extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>Code Search Engine</title>
    </head>
    <body>
        <h1>Code Search Engine</h1>
        <form action=\"\" method=\"get\">
            <p>Search source code for: <input type=\"text\" value=\"\" name=\"q\" size=\"80\" /> <input type=\"submit\" value=\"Search\" /></p>
        </form>
        ";
        // line 12
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "res"));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 13
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "item"), "C14N"), "html", null, true);
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 15
        echo "    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "CodeSearchBundle:Search:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 15,  34 => 13,  30 => 12,  17 => 1,);
    }
}
