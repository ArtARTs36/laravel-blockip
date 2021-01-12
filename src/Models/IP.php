<?php

namespace ArtARTs36\LaravelBlockIp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $identity
 */
class IP extends Model
{
    public const FIELD_IDENTITY = 'identity';

    public $timestamps = false;

    protected $table = 'blockip_ips';

    protected $fillable = [
        self::FIELD_IDENTITY,
    ];

    /**
     * @return Collection|IP[]
     */
    public static function getByIdentities(array $ips): Collection
    {
        return static::query()
            ->whereIn(static::FIELD_IDENTITY, $ips)
            ->get();
    }

    public static function createMany(array $ips): bool
    {
        $records = array_map(function (string $ip) {
            return [
                static::FIELD_IDENTITY => $ip,
            ];
        }, $ips);

        return static::query()->insert($records);
    }

    public static function isBlocked(string $ip): bool
    {
        return static::query()->where(static::FIELD_IDENTITY, $ip)->exists();
    }
}
