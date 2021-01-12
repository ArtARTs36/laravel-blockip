<?php

namespace ArtARTs36\LaravelBlockIp\Console\Commands;

use ArtARTs36\LaravelBlockIp\Fetchers\FetcherFactory;
use ArtARTs36\LaravelBlockIp\Updater;
use Illuminate\Console\Command;

class GetNewIps extends Command
{
    protected $signature = 'blockip:get-new-ips {--fetcher=}';

    protected $description = 'Get new ip into spam list';

    public function handle(FetcherFactory $factory, Updater $updater)
    {
        try {
            $fetcher = $this->option('fetcher') ?
                $factory->factory($this->option('fetcher')) :
                $factory->first();

            $updater->update($fetcher);
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }
    }
}
