<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer;

use Star\WrapIt\Extension\WrapExtension;

interface Definition
{
    /**
     * @param WrapExtension $extension
     */
    public function acceptExtension(WrapExtension $extension): void;
}
