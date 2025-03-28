<?php

use Illuminate\Support\Facades\Route;
use Yuloma\SanctumTokenManager\Livewire\TokenManager;

Route::middleware(['web', 'auth'])->prefix('sanctum-tokens')->group(function () {
    Route::get('/', TokenManager::class)->name('sanctum-tokens.index');
});
