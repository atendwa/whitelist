<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource\Pages;

use Atendwa\Filakit\Pages\ListRecords;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource;

class ListIpAddressWhitelists extends ListRecords {
    protected static string $resource = IpAddressWhitelistResource::class;
}
