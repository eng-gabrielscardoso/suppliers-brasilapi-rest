<?php

namespace App\Providers;

use App\Enums\Support\MIMEType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class HttpServiceProvider extends ServiceProvider
{
    /**
     * Register any HTTP-related services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any HTTP-related services.
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
