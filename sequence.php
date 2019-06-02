<?php
declare(strict_types = 1);

include_once __DIR__ . '/vendor/autoload.php';

use steinmb\scanner;

$directoryToScan = __DIR__ . '/../PLAYLIST/';
$sequence = ['00506', '00502', '00516', '00515', '00510', '00500', '00513', '00508'];

$playlist = new scanner\Playlist($directoryToScan);
$scanner = new scanner\Scanner($playlist, $sequence);
$results = $scanner->searchSequence();
$match = 0;
var_dump($argv);

foreach ($results as $result) {
    $hit = $scanner->matchStart($result);

    if ($hit) {
        echo $result->getFileName() . PHP_EOL;
        echo $result->trackListFlatten() . PHP_EOL;
        $match++;
    }
}

echo 'Found ' . $match . PHP_EOL;
