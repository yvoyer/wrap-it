<?php declare(strict_types=1);

namespace Star\WrapIt;

use Star\WrapIt\Extension\ExtensionLoader;
use Star\WrapIt\Lexer\WrapParser;

final class Environment
{
    /**
     * @var ExtensionLoader
     */
    private $loader;

    /**
     * @param ExtensionLoader $loader
     */
    public function __construct(ExtensionLoader $loader)
    {
        $this->loader = $loader;
    }

    public function render(string $code, string $language): string
    {
        $parser = new WrapParser();
        $code = $parser->parse($code);

        $template = $this->loader->loadTemplate($language);
        $code->acceptTemplate($template); // todo still usefull?

        return $template->getContent();
    }
}
