<?php
declare(strict_types = 1);

namespace steinmb\scanner;

final class Scanner {

    private $playlist;

    public function __construct(Playlist $playlist)
    {
        $this->playlist = $playlist;
    }

    public function searchSequence(string $sequence)
    {
        foreach ($this->playlist->getAllFilenames() as $fileName) {
            $content = $this->playlist->getFileContent($fileName);
            $tracks = Tracks::fromString($fileName, $this->getTrackList($content));
            echo 'tracks:' . $tracks->numberOfTracks() . PHP_EOL;
        }
    }

    private function getTrackList(string $content): array
    {
        $matches = [];
        preg_match_all('/\d{5}/', $content, $matches);
        return $matches;
    }

}
