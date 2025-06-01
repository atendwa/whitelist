<?php

declare(strict_types=1);

use Atendwa\Support\Concerns\Support\InferMigrationDownMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    use InferMigrationDownMethod;

    public function up(): void
    {
        Schema::create('ip_address_whitelists', function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->unsignedInteger('user_id')->index()->nullable();
            $blueprint->json('ip_addresses');
            $blueprint->string('action')->default('whitelist');
            $blueprint->timestamps();
        });
    }
};
