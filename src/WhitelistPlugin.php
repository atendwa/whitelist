<?php

declare(strict_types=1);

namespace Atendwa\Whitelist;

use Atendwa\Filakit\Concerns\UsesPluginSetup;
use Atendwa\Filakit\Panel;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource;
use Filament\Contracts\Plugin;

class WhitelistPlugin implements Plugin
{
    use UsesPluginSetup;

    public function register(Panel|\Filament\Panel $panel): void
    {
        $panel->resources([IpAddressWhitelistResource::class]);
    }
}
