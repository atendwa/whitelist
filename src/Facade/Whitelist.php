<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IpWhitelist
 */
class Whitelist extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'whitelist';
    }
}
