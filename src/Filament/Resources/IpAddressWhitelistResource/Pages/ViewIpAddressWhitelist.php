<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource\Pages;

use Atendwa\Filakit\Pages\ViewRecord;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource;

class ViewIpAddressWhitelist extends ViewRecord
{
    protected static string $resource = IpAddressWhitelistResource::class;
}
