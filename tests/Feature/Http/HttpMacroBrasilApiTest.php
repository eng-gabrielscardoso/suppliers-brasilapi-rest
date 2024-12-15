<?php

use Illuminate\Support\Facades\Http;
use App\Providers\AppServiceProvider;
use Symfony\Component\HttpFoundation\Response;

beforeEach(function () {
    $app = new AppServiceProvider(app());

    $app->boot();
});

test('should register the brasilApi macro correctly', function () {
    Http::fake([
        'https://brasilapi.com.br/api/*' => Http::response([
            'cnpj' => '54258480000114',
            'cnae_fiscal' => 8219999,
            'razao_social' => '54.258.480 GABRIEL SANTOS CARDOSO',
        ], 200),
    ]);

    $response = Http::brasilApi()->get('/cnpj/v1/54258480000114');

    expect($response->status())->toBe(Response::HTTP_OK);
    expect($response->json())->toMatchArray([
        'cnpj' => '54258480000114',
        'cnae_fiscal' => 8219999,
        'razao_social' => '54.258.480 GABRIEL SANTOS CARDOSO',
    ]);
});

test('should makes a real request to brasilAPI for a CNPJ search', function () {
    $response = Http::brasilApi()->get('/cnpj/v1/54258480000114');

    dd($response->body());

    expect($response->status())->toBe(Response::HTTP_OK);
    expect($response->json('cnpj'))->toBe('54258480000114');
    expect($response->json('cnae_fiscal'))->toBe(8219999);
    expect($response->json('razao_social'))->toBe('54.258.480 GABRIEL SANTOS CARDOSO');
    expect($response->json())->toHaveKeys(['cnpj', 'razao_social', 'nome_fantasia', 'cnae_fiscal']);
});
