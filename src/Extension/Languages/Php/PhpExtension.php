<?php declare(strict_types=1);

namespace Star\WrapIt\Extension\Languages\Php;

use Star\WrapIt\Definition\ClassName;
use Star\WrapIt\Extension\Languages\Php\Templates;
use Star\WrapIt\Extension\WrapExtension;
use Symfony\Component\Process\Process;
use Webmozart\Assert\Assert;

final class PhpExtension implements WrapExtension
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $binDir;

    public function __construct(string $binDir)
    {
        $this->binDir = $binDir;
        Assert::directory($binDir);
    }

    public function visitClassDefinition(ClassName $token): void
    {
        $templates[] = new Templates\PhpOpenTag();
        $templates[] = new Templates\DeclareStrictTypes();
        $templates[] = new Templates\FinalClass($token->getName());
        $templates[] = new Templates\OpenClass();
        $templates[] = new Templates\PrivateConstruct();
        $templates[] = new Templates\EndClass();

        $this->content = implode(
            '',
            array_map(
                function (PhpTemplate $template) {
                    return $template->getContent();
                },
                $templates
            )
        );
    }

    public function getContent(): string
    {
        $dir = \sys_get_temp_dir();
        $file = $dir . DIRECTORY_SEPARATOR . uniqid('code-') . '.php';
        Assert::greaterThan(\file_put_contents($file, $this->content), 0);
        Assert::file($file);

        $scriptPath = $this->binDir . DIRECTORY_SEPARATOR . 'phpcbf';
        Assert::file($scriptPath);

        $process = new Process("php {$scriptPath} {$file}");
        $process->run();
        $content = \file_get_contents($file);
        if (false === $content) {
            throw new \RuntimeException(sprintf('Unable to read file "%s".', $file));
        }

        return $content;
    }
}
