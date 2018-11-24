<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer;

final class SymbolParser implements ParseWalker
{
    /**
     * @var WrapLexer
     */
    private $lexer;

    public function __construct(WrapLexer $lexer)
    {
        $this->lexer = $lexer;
    }

    public function enterToken(string $token): void
    {
        $this->lexer->moveAfterSymbol($token);
    }

    public function enterRequiredKeyword(string $keyword): void
    {
        $this->lexer->moveAfterSymbol($keyword);
    }
}
