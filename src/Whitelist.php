<?php

declare(strict_types=1);

namespace Atendwa\Whitelist;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Throwable;

class Whitelist
{
    /**
     * @throws Throwable
     */
    public function allows(?Model $model = null): bool
    {
        $model = $model ?? request()->user();

        if (! $model instanceof Model) {
            Gate::denyIf($this->denies(), 'Your IP address is not whitelisted.');

            return false;
        }

        $ip = request()->ip();
        $ips = $model->getRelationValue('ips');

        $column = 'action';

        return collect($ips->where($column, 'whitelist')->pluck('ip_addresses'))->collapse()->contains($ip) &&
            collect($ips->where($column, 'blacklist')->pluck('ip_addresses'))->collapse()->doesntContain($ip);
    }

    /**
     * @throws Throwable
     */
    public function authorize(): void
    {
        Gate::denyIf($this->denies(), 'Your IP address is not whitelisted.');
    }

    /**
     * @throws Throwable
     */
    public function denies(?Model $model = null): bool
    {
        return ! $this->allows($model);
    }
}
