<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Policies;

use Atendwa\Support\Concerns\Support\UsesPolicySetup;
use Atendwa\Support\Policy;

class IpAddressWhitelistPolicy extends Policy
{
    use UsesPolicySetup;
}
