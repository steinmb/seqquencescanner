<?php
declare(strict_types = 1);

include_once __DIR__ . '/vendor/autoload.php';

use steinmb\scanner;

if (count($argv) !== 3) {
    echo 'Usage: php sequence.php <directory to scan> <comma separated list of mpls tracks>' . PHP_EOL;
    echo 'Example: php sequence.php /Users/steinmb/PLAYLIST "00506, 00500, 00001, 00502"' . PHP_EOL;
    exit;
}

$directoryToScan = $argv[1];
$playlist = new scanner\Playlist($directoryToScan);

if (!$playlist->numberOfValidFiles()) {
    echo 'Found no files to analyze. ' . PHP_EOL;
    exit;
}

echo 'Found: ' . $playlist->numberOfValidFiles() . ' mpls tracks to analyze.' . PHP_EOL;

$string = str_replace(' ', '', $argv[2]);
$sequence = explode(',', $string);
$scanner = new scanner\Scanner($playlist, $sequence);
$scanner->searchSequence();
