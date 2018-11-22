<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer;

use Star\WrapIt\Extension\WrapExtension;

final class ParsedCode
{
    /**
     * @var Definition[]
     */
    private $symbols = [];

    public function __construct(Definition ...$symbols)
    {
        $this->symbols = $symbols;
    }

    public function acceptTemplate(WrapExtension $visitor): void
    {
        foreach ($this->symbols as $symbol) {
            $symbol->acceptTemplate($visitor);
        }
    }
}
