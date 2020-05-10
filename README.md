# sequencescanner
Scan Blue Ray playlist files to match play sequence found in mpls files.

Quick tool I needed to do match up a sequence with stubborn Blue Ray discs containing more then 400 fake play sequences.

## Install

    git clone https://github.com/steinmb/sequencescanner.git
    cd sequencescanner
    composer install
    composer dumpautoload -o
    
Test with client code example

    php sequence.php <directory> <comma separated list of sequences>

## Example on how to use

```php
include_once __DIR__ . '/vendor/autoload.php';
use steinmb\scanner\Playlist;
use steinmb\scanner\Scanner;

$directoryToScan = 'Volumes/HACKERS/BDMV/PLAYLIST';
$sequence = [00506, 00500, 00001, 00502];
$playlist = new Playlist($directoryToScan);
$scanner = new Scanner($playlist, $sequence);
$scanner->searchSequence();
```
