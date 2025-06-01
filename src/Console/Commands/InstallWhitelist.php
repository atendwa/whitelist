<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Console\Commands;

use Atendwa\Support\Command;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource;
use Atendwa\Whitelist\Providers\WhitelistServiceProvider;

class InstallWhitelist extends Command
{
    protected $signature = 'whitelist:install';

    protected $description = 'Install the whitelist package';

    protected string $provider = WhitelistServiceProvider::class;

    protected array $resources = [IpAddressWhitelistResource::class];
}
