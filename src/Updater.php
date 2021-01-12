<?php

namespace ArtARTs36\LaravelBlockIp;

use ArtARTs36\LaravelBlockIp\Contracts\Fetcher;
use ArtARTs36\LaravelBlockIp\Models\IP;

class Updater
{
    /**
     * @return int
     */
    public function update(Fetcher $fetcher): bool
    {
        $newIps = $fetcher->fetch();
        $having = IP::getByIdentities($newIps)
            ->pluck(IP::FIELD_IDENTITY)
            ->toArray();

        return IP::createMany(array_diff($newIps, $having));
    }
}
