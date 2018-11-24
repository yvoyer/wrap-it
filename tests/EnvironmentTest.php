<?php declare(strict_types=1);

namespace Star\WrapIt;

use PHPUnit\Framework\TestCase;
use Star\WrapIt\Extension\ExtensionLoader;

final class EnvironmentTest extends TestCase
{
    public function test_it_return_the_transformed_code()
    {
        $env = new Environment($this->createMock(ExtensionLoader::class));
        $this->assertSame('', $env->render('', 'language'));
    }
}
