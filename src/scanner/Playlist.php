<?php declare(strict_types = 1);

namespace steinmb\scanner;

use InvalidArgumentException;

final class Playlist
{
    private ?string $directory = null;

    public function __construct(string $directory)
    {
        if (is_dir($directory)) {
            $this->directory = $directory;
        }
        else {
            throw new InvalidArgumentException('Not a valid directory: ' . $directory);
        }
    }

    public function fileNames(): array
    {
        $fileNames = scandir($this->directory);
        return array_diff($fileNames, ['..', '.']);
    }

    public function fileNamesFlatten(): string
    {
        return implode(', ', $this->fileNames());
    }

    public function numberOfValidFiles(): int
    {
        $results = [];

        foreach ($this->fileNames() as $fileName) {
            preg_match_all('/\d{5}.mpls/', (string) $fileName, $matches);

            if ($matches[0]) {
                $results[] = $matches[0];
            }
        }

        return count($results);
    }

    public function getFileContent(string $fileName)
    {
        return file_get_contents($this->directory . '/' . $fileName);
    }
}
