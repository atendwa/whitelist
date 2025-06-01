<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Models;

use App\Models\User;
use Atendwa\Filakit\Contracts\ModelHasIcon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IpAddressWhitelist extends Model implements ModelHasIcon
{
    public const ACTIONS = [
        'whitelist' => 'Whitelist',
        'blacklist' => 'Blacklist',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function getIcon(): string
    {
        return asString(config('whitelist.resource.icon'));
    }

    /**
     * @return array<string>
     */
    protected function casts(): array
    {
        return [
            'ip_addresses' => 'array',
        ];
    }
}
