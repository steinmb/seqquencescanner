<?php
declare(strict_types = 1);

namespace steinmb\scanner;

final class Scanner {

    private $playlist;
    private $sequence;

    public function __construct(Playlist $playlist, array $sequence)
    {
        $this->playlist = $playlist;
        $this->sequence = $sequence;
    }

    private function trackList(): array
    {
        $results = [];

        foreach ($this->playlist->getAllFilenames() as $fileName) {
            $content = $this->playlist->getFileContent($fileName);
            $results[] = Tracks::fromString($fileName, $this->getTrackList($content));
        }

        return $results;
    }

    public function searchSequence()
    {
        $match = 0;
        $results = $this->trackList();

        foreach ($results as $result) {
            $hit = $this->matchStart($result);

            if ($hit) {
                echo $result->getFileName() . PHP_EOL;
                echo $result->trackListFlatten() . PHP_EOL;
                $match++;
            }
        }

        echo 'Found ' . $match . PHP_EOL;
    }

    private function getTrackList(string $content): array
    {
        $matches = [];
        preg_match_all('/\d{5}/', $content, $matches);
        return $matches[0];
    }

    private function matchStart(Tracks $tracks): int
    {
        $match = 0;
        $list = $tracks->trackListFlatten();
        $pattern = implode(',', $this->sequence);

        if (false !== strpos($list, $pattern)) {
            return 1;
        }

        return $match;
    }

}
