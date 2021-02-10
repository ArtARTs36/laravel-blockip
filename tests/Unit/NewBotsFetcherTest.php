<?php

namespace ArtARTs36\LaravelBlockIp\Tests\Unit;

use ArtARTs36\LaravelBlockIp\Fetchers\CleanTalk\NewBotsFetcher;
use PHPUnit\Framework\TestCase;

final class NewBotsFetcherTest extends TestCase
{
    /**
     * @covers \ArtARTs36\LaravelBlockIp\Fetchers\CleanTalk\NewBotsFetcher::fetch
     */
    public function testFetch(): void
    {
        $fetcher = $this->createInstance(
            file_get_contents(__DIR__ . '/../MockData/cleantalk_newbotfetcher_response.txt')
        );

        self::assertCount(75, $fetcher->fetch());
    }

    protected function createInstance(string $response): NewBotsFetcher
    {
        return new class($response) extends NewBotsFetcher {
            protected $content;

            public function __construct(string $response)
            {
                $this->content = $response;
            }

            protected function getContent(): string
            {
                return $this->content;
            }
        };
    }
}
