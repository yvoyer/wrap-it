<?php declare(strict_types=1);

namespace Star\WrapIt\Extension\Languages\Php\Templates;

use Star\WrapIt\Extension\Languages\Php\PhpTemplate;

final class FinalClass implements PhpTemplate
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = ucfirst($name);
    }

    public function getContent(): string
    {
        return "\nfinal class {$this->name}";
    }
}
