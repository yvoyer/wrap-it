<?php declare(strict_types=1);

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use org\bovigo\vfs;
use Star\WrapIt\Definition;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var vfs\vfsStreamDirectory
     */
    private $root;

    /**
     * @var \Star\WrapIt\Environment
     */
    private $env;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->root = vfs\vfsStream::setup();
        $this->env = new \Star\WrapIt\Environment(new \Star\WrapIt\Extension\Languages\Php\PhpLoader());
    }

    /**
     * @Given I create a file named :arg1 with content:
     */
    public function iCreateAFileNamedWithContent(string $filename, PyStringNode $string)
    {
        $this->root->addChild($file = new vfs\vfsStreamFile($filename));
        $file->setContent($string->getRaw());
    }

    /**
     * @When I generate the code for file :arg1 in :arg2 language
     */
    public function iGenerateTheCodeForFileInLanguage(string $filename, string $language)
    {
        $wrapPath = $this->root->getChild($filename)->url();
        \file_put_contents(
            Definition\FilePath::fromExistingPath($wrapPath)->withExtension($language)->toString(),
            $this->env->render(\file_get_contents($wrapPath), $language)
        );
    }

    /**
     * @Then The file :arg1 should have a content of:
     */
    public function theFileShouldHaveAContentOf(string $filename, PyStringNode $string)
    {
        Assert::assertSame(
            $string->getRaw(), \file_get_contents($this->root->getChild($filename)->url())
        );
    }
}
