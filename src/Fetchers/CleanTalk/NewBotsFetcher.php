<?php

namespace ArtARTs36\LaravelBlockIp\Fetchers\CleanTalk;

use ArtARTs36\LaravelBlockIp\Contracts\Fetcher;

class NewBotsFetcher implements Fetcher
{
    protected $url = 'https://cleantalk.org/blacklists';

    protected $regexLink = "/<a href=\"([^\"]*)\" title=\"(.*)\">(.*)<\/a>/iU";

    protected $regexLinksContainer = '/<ul class="list___ips_emails list-unstyled">(.*)<\/ul>/i';

    public function fetch(): array
    {
        $container = $this->getLinksContainer($this->getContent());

        $matches = [];

        preg_match_all($this->regexLink, $container, $matches);

        return $matches[3];
    }

    protected function getLinksContainer(string $content): string
    {
        $matches = [];

        preg_match($this->regexLinksContainer, $content, $matches);

        return $matches[1];
    }

    protected function getContent(): string
    {
        return file_get_contents($this->url);
    }
}
