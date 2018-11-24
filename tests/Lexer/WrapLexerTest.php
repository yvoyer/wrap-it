<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer;

use PHPUnit\Framework\TestCase;
use Star\WrapIt\Definition\ClassDefinition;
use Star\WrapIt\Lexer\Symbols;

final class WrapLexerTest extends TestCase
{
    public function test_it_should_return_end_of_file_marker()
    {
        $lexer = WrapLexer::fromString('');
        $this->assertFalse($lexer->hasNextSymbol());
        $this->assertInstanceOf(Symbols\EndOfFile::class, $lexer->parseDefinition());
    }

    public function test_it_should_return_end_of_line_marker()
    {
        $lexer = WrapLexer::fromString("\n\n");
        $this->assertFalse($lexer->hasNextSymbol());
        $this->assertInstanceOf(Symbols\EndOfFile::class, $lexer->parseDefinition());
    }

    public function test_it_should_throw_exception_when_code_with_not_supported_keyword_given()
    {
        $lexer = WrapLexer::fromString("not-supported { }");
        $this->expectException(SyntaxError::class);
        $this->expectExceptionMessage('Unexpected symbol "not-supported" at line 1.');
        $lexer->parseDefinition();
    }

    public function test_it_should_parse_class_definition()
    {
        $wrap = <<<CODE
aggregate SomeClass 
{
}
CODE;

        $lexer = WrapLexer::fromString($wrap);
        /**
         * @var ClassDefinition $marker
         */
        $this->assertInstanceOf(ClassDefinition::class, $marker = $lexer->parseDefinition());

        $this->assertTrue($lexer->hasNextSymbol());
        $this->assertInstanceOf(Symbols\CurlyOpen::class, $lexer->parseDefinition());

        $this->assertTrue($lexer->hasNextSymbol());
        $this->assertInstanceOf(Symbols\CurlyClose::class, $lexer->parseDefinition());

        $this->assertFalse($lexer->hasNextSymbol());
    }

    public function test_it_should_throw_exception_when_no_space_between_token()
    {
        $lexer = WrapLexer::fromString('aggregateInvalid {}');
        $this->assertTrue($lexer->hasNextSymbol());

        $this->expectException(ParseError::class);
        $this->expectExceptionMessage('Missing T_SPACE after keyword "aggregate" at line 1, got "aggregateInvalid".');
        $lexer->parseDefinition();
    }
}
