<?php declare(strict_types=1);

namespace Star\WrapIt\Extension\Languages\Php\Templates;

use Star\WrapIt\Extension\Languages\Php\PhpTemplate;

final class PhpOpenTag implements PhpTemplate
{
    public function getContent(): string
    {
        return '<?php ';
    }
}
