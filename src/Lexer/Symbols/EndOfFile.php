<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer\Symbols;

use Star\WrapIt\Lexer\Definition;
use Star\WrapIt\Extension\WrapExtension;

final class EndOfFile implements Definition
{
    /**
     * @param WrapExtension $template
     */
    public function acceptTemplate(WrapExtension $template): void
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }
}
