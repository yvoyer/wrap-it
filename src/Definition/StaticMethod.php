<?php declare(strict_types=1);

namespace Star\WrapIt\Definition;

use Star\WrapIt\Extension\WrapExtension;

final class StaticMethod implements MethodDefinition
{
    /**
     * @var MethodName
     */
    private $name;

    /**
     * @var MethodArgument[]
     */
    private $arguments;

    /**
     * @var ReturnValue
     */
    private $return;

    private function __construct(MethodName $name, ReturnValue $return, MethodArgument ...$arguments)
    {
        $this->name = $name;
        $this->arguments = $arguments;
        $this->return = $return;
    }

    public function acceptExtension(WrapExtension $extension): void
    {
        $extension->visitMethod($this->name);

        foreach ($this->arguments as $argument) {
            $argument->acceptExtension($extension);
        }

        $this->return->acceptExtension($extension);
    }

    public function returning(ReturnValue $return): self
    {
        return new self($this->name, $return, $this->arguments);
    }

    public function havingArguments(MethodArgument ...$arguments): self
    {
        return new self($this->name, $this->return, ...$arguments);
    }

    public static function fromName(MethodName $name): self
    {
        return new self($name, new VoidReturn());
    }

    public static function fromString(string $name): self
    {
        return new self(MethodName::fromString($name), new VoidReturn());
    }
}
