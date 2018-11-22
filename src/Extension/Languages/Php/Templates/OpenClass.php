<?php declare(strict_types=1);

namespace Star\WrapIt\Extension\Languages\Php\Templates;

use Star\WrapIt\Extension\Languages\Php\PhpTemplate;

final class OpenClass implements PhpTemplate
{
    /**
     * @var int
     */
    private $indent = 0;

    /**
     * @var string
     */
    private $char = ' ';

    public function getContent(): string
    {
        return \str_repeat($this->char, $this->indent) . "{";
    }
}
