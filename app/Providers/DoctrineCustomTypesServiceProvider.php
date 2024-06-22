<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class DoctrineCustomTypesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the tinyinteger type with Doctrine DBAL
        if (!Type::hasType('tinyinteger')) {
            Type::addType('tinyinteger', \Doctrine\DBAL\Types\IntegerType::class);
        }
    }
}