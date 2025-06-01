<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource\Pages;

use Atendwa\Filakit\Pages\EditRecord;
use Atendwa\Whitelist\Filament\Resources\IpAddressWhitelistResource;

class EditIpAddressWhitelist extends EditRecord {
    protected static string $resource = IpAddressWhitelistResource::class;
}
