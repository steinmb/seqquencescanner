<?php
declare(strict_types = 1);

namespace steinmb\scanner;

use InvalidArgumentException;

final class Playlist
{
    private $directory;

    public function __construct(string $directory)
    {
        if (is_dir($directory)) {
            $this->directory = $directory;
        }
        else {
            throw new InvalidArgumentException('Not a valid directory: ' . $directory);
        }
    }

    public function getAllFilenames(): array
    {
        $fileNames = scandir($this->directory);
        return array_diff($fileNames, ['..', '.']);
    }

    public function getFileContent(string $fileName)
    {
        return file_get_contents($this->directory . '/' . $fileName);
    }
}
