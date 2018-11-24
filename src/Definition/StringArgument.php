<?php declare(strict_types=1);

namespace Star\WrapIt\Definition;

use Star\WrapIt\Extension\WrapExtension;

final class StringArgument implements MethodArgument
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function acceptExtension(WrapExtension $extension): void
    {
        $extension->visitMethodArgument($this);
    }

    public static function fromString(string $name): self
    {
        return new self($name);
    }
}
