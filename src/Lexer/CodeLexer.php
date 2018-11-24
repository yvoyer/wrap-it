<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer;

interface CodeLexer
{
    /**
     * @return bool
     *
     * @api
     * @since 1.0.0
     */
    public function hasNextSymbol(): bool;

    /**
     * @return Definition
     *
     * @api
     * @since 1.0.0
     */
    public function parseDefinition(): Definition;

    /**
     * Return the next symbol without moving the pointer
     * @return string
     *
     * @api
     * @since 1.0.0
     */
    public function nextSymbol(): string;

    /**
     * Move the pointer after the $symbol
     *
     * @param string $symbol
     *
     * @api
     * @since 1.0.0
     */
    public function moveAfterSymbol(string $symbol): void;
}
