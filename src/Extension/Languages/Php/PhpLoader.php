<?php declare(strict_types=1);

namespace Star\WrapIt\Extension\Languages\Php;

use Star\WrapIt\Extension\ExtensionLoader;
use Star\WrapIt\Extension\WrapExtension;

final class PhpLoader implements ExtensionLoader
{
    public function loadTemplate(string $language): WrapExtension
    {
        return new PhpExtension((string) \realpath(__DIR__ . '/../../../../bin'));
    }
}
