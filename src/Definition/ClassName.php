<?php declare(strict_types=1);

namespace Star\WrapIt\Definition;

use Star\WrapIt\Lexer\Definition;
use Star\WrapIt\Extension\WrapExtension;

final class ClassName implements Definition
{
    /**
     * @var string
     */
    private $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param WrapExtension $template
     */
    public function acceptTemplate(WrapExtension $template): void
    {
        $template->visitClassDefinition($this);
    }

    public function isFinal(): bool
    {
        return true;
    }

    public function isAbstract(): bool
    {
        return false;
    }

    public function hasExtends(): bool
    {
        return count($this->getExtends()) > 0;
    }

    public function getExtends(): array
    {
        return [];
    }

    public function hasImplements(): bool
    {
        return count($this->getImplements()) > 0;
    }

    public function getImplements(): array
    {
        return [];
    }

    public static function withName(string $name): self
    {
        return new self($name);
    }
}
