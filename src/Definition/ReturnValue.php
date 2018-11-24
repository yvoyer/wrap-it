<?php declare(strict_types=1);

namespace Star\WrapIt\Definition;

use Star\WrapIt\Extension\WrapExtension;

interface ReturnValue
{
    public function acceptExtension(WrapExtension $extension): void;
}
