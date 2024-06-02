<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    public function boot()
    {
        parent::boot();
        //guest user routes
        Route::middleware(['guest', 'api'])
            ->prefix('v1')
            ->group(function () {
                require base_path('routes/api.php');
            });
    }
}
