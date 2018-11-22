<?php declare(strict_types=1);

namespace Star\WrapIt\Extension\Languages\Php;

interface PhpTemplate
{
    public function getContent(): string;
}
