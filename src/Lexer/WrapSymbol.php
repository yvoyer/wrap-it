<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer;

interface WrapSymbol
{
    /**
     * Build the definition for the symbol
     *
     * @param CodeLexer $lexer
     * @param ParseWalker $walker
     *
     * @return Definition
     */
    public function buildDefinition(CodeLexer $lexer, ParseWalker $walker): Definition;

    /**
     * @param CodeLexer $lexer
     * @param ParseWalker $walker
     *
     * @return WrapSymbol
     */
    public static function create(CodeLexer $lexer, ParseWalker $walker): WrapSymbol;
}
