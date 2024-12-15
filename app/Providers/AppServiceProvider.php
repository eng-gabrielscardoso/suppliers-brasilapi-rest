<?php

namespace App\Providers;

use App\Enums\Support\MIMEType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Global Macro For Brasil API
        Http::macro('brasilApi', function () {
            return Http::withHeaders([
                'Accept' => MIMEType::ApplicationJson->value,
                'Content-Type' => MIMEType::ApplicationJson->value,
            ])->baseUrl(config('services.brasilApi.url'));
        });
    }
}
