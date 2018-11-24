<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer;

final class WrapParser
{
    /**
     * @param string $content
     *
     * @return ParsedCode
     */
    public function parse(string $content): ParsedCode
    {
        $lexer = WrapLexer::fromString($content);

        $symbols = [];
        while ($lexer->hasNextSymbol()) {
            $symbols[] = $lexer->parseDefinition();
        }

        return new ParsedCode(...$symbols);
    }
}
