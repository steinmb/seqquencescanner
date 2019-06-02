<?php
declare(strict_types = 1);

include_once __DIR__ . '/vendor/autoload.php';

use steinmb\scanner;

$directoryToScan = __DIR__ . '/../PLAYLIST/';
$playlist = new scanner\Playlist($directoryToScan);
$scanner = new scanner\Scanner($playlist);

$scanner->searchSequence('501, 502');
