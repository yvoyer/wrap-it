<?php declare(strict_types=1);

namespace Star\WrapIt\Extension\Languages\Php\Templates;

use Star\WrapIt\Extension\Languages\Php\PhpTemplate;

final class PrivateConstruct implements PhpTemplate
{
    public function getContent(): string
    {
        return <<<PHP
private function __construct() {
}

public static function fromEmpty(): self 
{
return new self(); 
}
PHP;
    }
}
