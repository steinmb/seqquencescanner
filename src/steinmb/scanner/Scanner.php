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

    public function searchSequence(): array
    {
        $result = [];

        foreach ($this->playlist->getAllFilenames() as $fileName) {
            $content = $this->playlist->getFileContent($fileName);
            $result[] = Tracks::fromString($fileName, $this->getTrackList($content));
        }

        return $result;
    }

    private function getTrackList(string $content): array
    {
        $matches = [];
        preg_match_all('/\d{5}/', $content, $matches);
        return $matches[0];
    }

    public function matchStart(Tracks $tracks)
    {
        $match = 0;
        $list = $tracks->trackListFlatten();
//        echo $list . PHP_EOL;
        $pattern = implode(',', $this->sequence);

        if (false !== strpos($list, $pattern)) {
            return 1;
        }

        return $match;
    }

    public function matchEnd(Tracks $tracks)
    {
        print_r($this->sequence);
        print_r($tracks->trackList());
    }

}
