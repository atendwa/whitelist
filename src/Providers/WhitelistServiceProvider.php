<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Providers;

use Atendwa\Whitelist\Console\Commands\InstallWhitelist;
use Atendwa\Whitelist\Http\Middleware\AllowWhitelistedIps;
use Atendwa\Whitelist\Models\IpAddressWhitelist;
use Atendwa\Whitelist\Policies\IpAddressWhitelistPolicy;
use Atendwa\Whitelist\Whitelist;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class WhitelistServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/whitelist.php', 'whitelist');
        $this->app->singleton('whitelist', fn (): Whitelist => new Whitelist());

        AliasLoader::getInstance()->alias('whitelisted', AllowWhitelistedIps::class);
        Gate::policy(IpAddressWhitelist::class, IpAddressWhitelistPolicy::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../../database/migrations' => database_path('migrations')], 'migrations');
            $this->publishes([__DIR__ . '/../../config/whitelist.php' => config_path('whitelist.php')], 'config');

            $this->commands(InstallWhitelist::class);
        }
    }
}
