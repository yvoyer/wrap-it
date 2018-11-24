<?php declare(strict_types=1);

namespace Star\WrapIt\Extension;

use Star\WrapIt\Definition\ClassName;

interface WrapExtension
{
    public function visitClassDefinition(ClassName $token): void;

    public function getContent(): string;
}
