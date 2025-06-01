<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Concerns;

use Atendwa\Whitelist\Models\IpAddressWhitelist;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CanBeWhitelisted
{
    /**
     * @return HasMany<IpAddressWhitelist, $this>
     */
    public function ips(): HasMany
    {
        return $this->hasMany(IpAddressWhitelist::class);
    }
}
