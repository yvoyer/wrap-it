<?php declare(strict_types=1);

namespace Star\WrapIt\Extension;

use Star\WrapIt\Definition\ClassName;
use Star\WrapIt\Definition\MethodArgument;
use Star\WrapIt\Definition\MethodName;
use Star\WrapIt\Definition\ReturnValue;

interface WrapExtension
{
    public function visitClass(ClassName $class): void;

    public function visitMethod(MethodName $method): void;

    public function visitMethodArgument(MethodArgument $argument): void;

    public function visitMethodReturn(ReturnValue $return): void;

    public function getContent(): string;
}
