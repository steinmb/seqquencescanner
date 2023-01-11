<?php declare(strict_types = 1);

namespace steinmb\scanner;

/**
 * Class Tracks
 *
 * Value object.
 * @package steinmb\scanner
 */
final class Tracks
{
    private ?array $list = null;
    private ?string $fileName = null;

    private function __construct()
    {
    }

    public static function fromString(string $fileName, array $list): Tracks
    {
        $object = new self();
        $object->fileName = $fileName;
        $object->list = $list;

        return $object;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function trackList(): array
    {
        return $this->list;
    }

    public function trackListFlatten(): string
    {
        return implode(',', $this->list);
    }

    public function numberOfTracks(): int
    {
        return is_countable($this->list) ? count($this->list) : 0;
    }

}
