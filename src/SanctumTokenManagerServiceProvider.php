<?php

namespace Yuloma\SanctumTokenManager;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Yuloma\SanctumTokenManager\Livewire\TokenManager;

class SanctumTokenManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('sanctum-token-manager::token-manager', TokenManager::class);

        $this->publishes([
            __DIR__ . '/../config/sanctum_token_manager.php' => config_path('sanctum_token_manager.php'),
        ], 'sanctum-token-manager-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/sanctum-token-manager'),
        ], 'sanctum-token-manager-views');

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'sanctum-token-manager');

        $this->publishes([
            __DIR__ . '/../lang' => resource_path('lang/vendor/sanctum-token-manager'),
        ], 'lang');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sanctum-token-manager');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/sanctum_token_manager.php', 'sanctum_token_manager'
        );
    }
}
