<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource\Pages;

use Atendwa\Filakit\Pages\CreateRecord;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource;

class CreateIpAddressWhitelist extends CreateRecord
{
    protected static string $resource = IpAddressWhitelistResource::class;
}
