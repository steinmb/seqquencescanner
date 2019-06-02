<?php
declare(strict_types = 1);

include_once __DIR__ . '/vendor/autoload.php';

use steinmb\scanner;

$directoryToScan = __DIR__ . '/../PLAYLIST/';
$playlist = new scanner\Playlist($directoryToScan);

$sequence = ['00506', '00502', '00516', '00515', '00510', '00500', '00513', '00508'];
$scanner = new scanner\Scanner($playlist, $sequence);
$scanner->searchSequence();
