<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer\Symbols;

use Star\WrapIt\Lexer\CodeLexer;
use Star\WrapIt\Lexer\Definition;
use Star\WrapIt\Lexer\ParseWalker;
use Star\WrapIt\Lexer\WrapSymbol;
use Star\WrapIt\Lexer\WrapToken;
use Star\WrapIt\Extension\WrapExtension;

final class CurlyOpen implements WrapToken, Definition
{
    const TOKEN = '{';

    public function buildDefinition(CodeLexer $lexer, ParseWalker $walker): Definition
    {
        return $this;
    }

    public function acceptTemplate(WrapExtension $template): void
    {
    }

    public static function create(CodeLexer $lexer, ParseWalker $walker): WrapSymbol
    {
        $walker->enterToken(self::TOKEN);
        return new self();
    }
}
