<?php declare(strict_types=1);

namespace Star\WrapIt\Lexer\Symbols;

use Star\WrapIt\Definition\ClassName;
use Star\WrapIt\Lexer\CodeLexer;
use Star\WrapIt\Lexer\Definition;
use Star\WrapIt\Lexer\ParseWalker;
use Star\WrapIt\Lexer\WrapKeyword;
use Star\WrapIt\Lexer\WrapSymbol;

final class Aggregate implements WrapKeyword
{
    const KEYWORD = 'aggregate';

    /**
     * @var ClassName
     */
    private $className;

    private function __construct(ClassName $name)
    {
        $this->className = $name;
//        $className = $lexer->nextSymbol();
//        $lexer->moveAfterSymbol($className);
//
//        $class = MClass::withName($className);
//
//        // todo $walker->enterKeyword(new KExtends());
//        // todo $class = $class->addExtends(...$walker->walkClassNames(new Tokens\TComma()));
//        // todo $walker->enterKeyword(new KImplements());
//        // todo $class = $class->addImplements(...$walker->walkInterfaceNames(new Tokens\TComma()));
//
//        return $class;
    }

    public function buildDefinition(CodeLexer $lexer, ParseWalker $walker): Definition
    {
        return $this->className;
    }

    public static function create(CodeLexer $lexer, ParseWalker $walker): WrapSymbol
    {
        $walker->enterRequiredKeyword('aggregate');
        $className = $lexer->nextSymbol();
        $lexer->moveAfterSymbol($className);

        return new self(ClassName::withName($className));
    }
}
