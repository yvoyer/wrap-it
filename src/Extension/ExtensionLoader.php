<?php declare(strict_types=1);

namespace Star\WrapIt\Extension;

interface ExtensionLoader
{
    public function loadTemplate(string $language): WrapExtension;
}
