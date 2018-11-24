<?php declare(strict_types=1);

namespace Star\WrapIt\Extension\Languages\Php;

use PHPUnit\Framework\TestCase;
use Star\WrapIt\Definition\ClassName;

final class PhpExtensionTest extends TestCase
{
    /**
     * @var PhpExtension
     */
    private $extension;

    public function setUp()
    {
        $this->extension = new PhpExtension((string) \realpath(__DIR__ . '/../../../../bin'));
    }

    public function test_it_should_generate_an_empty_class()
    {
        $this->extension->visitClassDefinition(ClassName::withName('name'));
        $expected = <<<PHP
<?php declare(strict_types=1);

final class Name
{
    private function __construct()
    {
    }

    public static function fromEmpty(): self
    {
        return new self();
    }
}

PHP;
        $this->assertSame($expected, $this->extension->getContent());
    }
}
