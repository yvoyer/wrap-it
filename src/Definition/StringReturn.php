<?php declare(strict_types=1);

namespace Star\WrapIt\Definition;

use Star\WrapIt\Extension\WrapExtension;

final class StringReturn implements ReturnValue
{
    public function acceptExtension(WrapExtension $extension): void
    {
        $extension->visitMethodReturn($this);
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }
}
