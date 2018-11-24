<?php declare(strict_types=1);

namespace Star\WrapIt\Definition;

use Star\WrapIt\Lexer\Definition;
use Star\WrapIt\Extension\WrapExtension;

final class ClassDefinition implements Definition
{
    /**
     * @var ClassName
     */
    private $name;

    /**
     * @var MethodDefinition[]
     */
    private $methods;

    private function __construct(ClassName $name, MethodDefinition ...$methods)
    {
        $this->name = $name;
        $this->methods = $methods;
    }

    public function withConstruct(string $name, ReturnValue $return = null, MethodArgument ...$arguments): self
    {
        $method = StaticMethod::fromString($name)
            ->havingArguments($arguments)
            ->returning($return);

        return new self(
            $this->name,
            ...array_merge(
                $this->methods,
                [
                    $method,
                ]
            )
        );
    }

    public function acceptExtension(WrapExtension $extension): void
    {
        $extension->visitClass($this->name);
        foreach ($this->methods as $method) {
            $method->acceptExtension($extension);
        }
    }

    public static function withName(ClassName $name): self
    {
        return new self($name);
    }

    public static function fromString(string $name): self
    {
        return self::withName(ClassName::fromString($name));
    }
}
