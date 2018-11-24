<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer\Symbols;

use Star\WrapIt\Lexer\Definition;
use Star\WrapIt\Extension\WrapExtension;

final class Implement implements Definition
{
    /**
     * @param WrapExtension $extension
     */
    public function acceptExtension(WrapExtension $extension): void
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }
}
