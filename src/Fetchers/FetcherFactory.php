<?php

namespace ArtARTs36\LaravelBlockIp\Fetchers;

use ArtARTs36\LaravelBlockIp\Contracts\Fetcher;
use ArtARTs36\LaravelBlockIp\Fetchers\CleanTalk\NewBotsFetcher;
use Illuminate\Container\Container;

class FetcherFactory
{
    public const BY_SLUG = [
        'cleantalk-newbots' => NewBotsFetcher::class,
    ];

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function factory(string $slug): Fetcher
    {
        if (! $this->has($slug)) {
            throw new \RuntimeException('Fetcher Class Not Found!');
        }

        return $this->container->make(static::BY_SLUG[$slug]);
    }

    public function first(): Fetcher
    {
        return $this->factory(array_key_first(static::BY_SLUG));
    }

    protected function has(string $slug): bool
    {
        return isset(static::BY_SLUG[$slug]);
    }
}
