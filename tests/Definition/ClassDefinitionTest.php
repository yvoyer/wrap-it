<?php declare(strict_types=1);

namespace Star\WrapIt\Definition;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Star\WrapIt\Extension\WrapExtension;

final class ClassDefinitionTest extends TestCase
{
    /**
     * @var WrapExtension|MockObject
     */
    private $extension;

    public function setUp()
    {
        $this->extension = $this->createMock(WrapExtension::class);
    }

    public function test_it_should_have_a_name()
    {
        $class = ClassDefinition::fromString('name');

        $this->extension
            ->expects($this->once())
            ->method('visitClass')
            ->with($this->equalTo(ClassName::fromString('name')));

        $class->acceptExtension($this->extension);
    }

    public function test_it_should_add_method()
    {
        $class = ClassDefinition::fromString('name')
            ->withConstruct('construct');

        $this->extension
            ->expects($this->once())
            ->method('visitMethod')
            ->with($this->equalTo(MethodName::fromString('construct')));

        $class->acceptExtension($this->extension);
    }

    public function test_it_should_add_method_with_return_value()
    {
        $class = ClassDefinition::fromString('name')
            ->withConstruct('construct', new StringReturn());

        $this->extension
            ->expects($this->once())
            ->method('visitMethodReturn')
            ->with($this->equalTo(new StringReturn()));

        $class->acceptExtension($this->extension);
    }

    public function test_it_should_add_method_with_arguments()
    {
        $class = ClassDefinition::fromString('name')
            ->withConstruct('construct', null, StringArgument::fromString('arg'));

        $this->extension
            ->expects($this->once())
            ->method('visitMethodArgument')
            ->with($this->equalTo(StringArgument::fromString('arg')));

        $class->acceptExtension($this->extension);
    }
}
