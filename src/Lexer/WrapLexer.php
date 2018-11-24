<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer;

use Star\WrapIt\Lexer\Symbols;

final class WrapLexer implements CodeLexer
{
    /**
     * @var string
     */
    private $originalContent;

    /**
     * @var string
     */
    private $currentContent;

    /**
     * @var int
     */
    private $currentLine = 1;

    /**
     * @var string[]|WrapSymbol[]
     */
    private $supportedSymbols = [
        Symbols\Aggregate::KEYWORD => Symbols\Aggregate::class,
        Symbols\CurlyOpen::TOKEN => Symbols\CurlyOpen::class,
        Symbols\CurlyClose::TOKEN => Symbols\CurlyClose::class,
    ];

    private function __construct(string $content)
    {
        $this->currentContent = \trim($content);
        $this->originalContent = $content;
    }

    public function hasNextSymbol(): bool
    {
        return \strlen($this->currentContent) > 0;
    }

    public function parseDefinition(): Definition
    {
        if (! $this->hasNextSymbol()) {
            return new Symbols\EndOfFile();
        }

        $symbol = $this->parseSymbol($this->nextSymbol(), $walker = new SymbolParser($this));

        return $symbol->buildDefinition($this, $walker);
    }

    public function nextSymbol(): string
    {
        $nextPosition = \strpos($this->currentContent, ' ');
        if ($nextPosition === false) {
            $nextPosition = \strpos($this->currentContent, "\n");

            if (false !== $nextPosition) {
                $this->currentLine ++;
            }
        }

        $symbol = $this->currentContent;
        if ($nextPosition > 0) {
            $symbol = \substr($this->currentContent, 0, (int) $nextPosition);
        }

        foreach ($this->supportedSymbols as $_K => $keyword) {
            if (\strpos($symbol, $_K) === 0 && $symbol !== $_K) {
                throw new ParseError(
                    \sprintf(
                        'Missing T_SPACE after keyword "%s" at line %d, got "%s".',
                        $_K,
                        $this->currentLine,
                        $symbol
                    )
                );
            }
        }

        return $symbol;
    }

    public function moveAfterSymbol(string $symbol): void
    {
        $this->currentContent = \trim(\substr($this->currentContent, \strlen($symbol)));
    }

    private function supportSymbol(string $keyword): bool
    {
        return array_key_exists($keyword, $this->supportedSymbols);
    }

    private function parseSymbol(string $symbol, ParseWalker $walker): WrapSymbol
    {
        if (! $this->supportSymbol($symbol)) {
            throw new SyntaxError(
                \sprintf('Unexpected symbol "%s" at line %d.', $symbol, $this->currentLine)
            );
        }

        return $this->supportedSymbols[$symbol]::create($this, $walker);
    }

    public static function fromString(string $content): CodeLexer
    {
        return new self($content);
    }
}
