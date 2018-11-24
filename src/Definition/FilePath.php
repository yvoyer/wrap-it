<?php declare(strict_types=1);

namespace Star\WrapIt\Definition;

use Webmozart\Assert\Assert;

final class FilePath
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $extension;

    private function __construct(string $path, string $extension)
    {
        $this->path = $path;
        $this->extension = $extension;
    }

    public function toString(): string
    {
        return $this->path . "." . $this->extension;
    }

    public function hasExtension(string $extension): bool
    {
        return $this->extension === $extension;
    }

    public function withExtension(string $extension): self
    {
        return new self($this->path, $extension);
    }

    public function isDir(): bool
    {
        return \is_dir($this->toString());
    }

    public static function fromExistingPath(string $path): self
    {
        Assert::fileExists($path);
        $info = pathinfo($path);

        return new self(
            $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'],
            $info['extension']
        );
    }

    public static function fromPath(string $path): self
    {
        $info = pathinfo($path);

        return new self(
            $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'],
            $info['extension']
        );
    }
}
