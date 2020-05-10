<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use steinmb\scanner\Playlist;
use steinmb\scanner\Tracks;

final class ScannerTest extends TestCase
{

    public function testTracksCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Tracks::class,
            Tracks::fromString('somthing.txt', ['01, 0,2'])
        );
    }

    public function testException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Playlist('invalidDirectory');
    }

}