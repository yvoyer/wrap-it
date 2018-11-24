<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer;

/**
 * @api
 * @since 1.0.0
 */
interface ParseWalker
{
    /**
     * Enter the validation of the $keyword
     *
     * @param string $keyword
     */
    public function enterRequiredKeyword(string $keyword): void;

    /**
     * Enter the validation of the $token
     *
     * @param string $token
     */
    public function enterToken(string $token): void;
}
