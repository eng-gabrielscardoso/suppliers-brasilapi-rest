<?php

use App\Models\Supplier;
use Illuminate\Http\Response;

test('should list all suppliers', function () {
    Supplier::factory(3)->create();

    $response = $this->getJson(route('suppliers.index'));

    $response->assertOk();
    $response->assertJsonCount(3, 'data');
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'active',
                'company_name',
                'trading_name',
                'registration_number',
                'registration_type',
                'contact_email',
                'contact_isd_code',
                'contact_phone_number',
                'address_country',
                'address_postal_code',
                'address_province',
                'address_street',
                'created_at',
                'updated_at',
            ],
        ],
    ]);
});

test('should create a new supplier', function () {
    $data = [
        'active' => true,
        'company_name' => '54.258.480 GABRIEL SANTOS CARDOSO',
        'trading_name' => 'Gabriel Santos Cardoso',
        'registration_number' => '54258480000114',
        'registration_type' => 'cnpj',
        'contact_email' => 'eng.gabrielscardoso@gmail.com',
        'contact_isd_code' => '55',
        'contact_phone_number' => '91986253389',
        'address_country' => 'BR',
        'address_postal_code' => '68445000',
        'address_province' => 'PA',
        'address_street' => 'João Pantoja de Castro'
    ];

    $response = $this->postJson(route('suppliers.store'), $data);

    $response->assertCreated();
    $response->assertJsonCount(15, 'data');
    $response->assertJsonStructure([
        'data' => [
            'id',
            'active',
            'company_name',
            'trading_name',
            'registration_number',
            'registration_type',
            'contact_email',
            'contact_isd_code',
            'contact_phone_number',
            'address_country',
            'address_postal_code',
            'address_province',
            'address_street',
            'created_at',
            'updated_at',
        ],
    ]);
});

test('should deny creation of new supplier with dirty request', function () {
    $data = [
        'company_name' => '54.258.480 GABRIEL SANTOS CARDOSO',
        'trading_name' => 'Gabriel Santos Cardoso',
        'registration_number' => '54258480000114',
        'registration_type' => 'cnpj',
    ];

    $response = $this->postJson(route('suppliers.store'), $data);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $this->assertSame("The active field is required.", $response->json()['message']);
});

test('should retrieve a specific supplier', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->getJson(route('suppliers.show', ['supplier' => $supplier->id]));

    $response->assertOk();
    $response->assertJsonCount(16, 'data');
    $response->assertJsonStructure([
        'data' => [
            'id',
            'active',
            'company_name',
            'trading_name',
            'registration_number',
            'registration_type',
            'contact_email',
            'contact_isd_code',
            'contact_phone_number',
            'address_country',
            'address_postal_code',
            'address_province',
            'address_street',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]);
    $this->assertSame($supplier->trading_name, $response->json()['data']['trading_name']);
});

test('should get an error when try to get an non existent supplier', function () {
    Supplier::factory()->create();

    $response = $this->getJson(route('suppliers.show', ['supplier' => 123]));

    $response->assertStatus(Response::HTTP_NOT_FOUND);
    $this->assertSame("The request supplier were not found or not exists", $response->json()['message']);
});

test('should update an supplier', function () {
    $supplier = Supplier::factory()->create();

    $data = [
        'trading_name' => 'Gabriel Santos Cardoso',
    ];

    $response = $this->patchJson(route('suppliers.update', ['supplier' => $supplier->id]), $data);

    $response->assertOk();
    $response->assertJsonCount(16, 'data');
    $response->assertJsonStructure([
        'data' => [
            'id',
            'active',
            'company_name',
            'trading_name',
            'registration_number',
            'registration_type',
            'contact_email',
            'contact_isd_code',
            'contact_phone_number',
            'address_country',
            'address_postal_code',
            'address_province',
            'address_street',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]);
    $this->assertSame($supplier->company_name, $response->json()['data']['company_name']);
    $this->assertSame('Gabriel Santos Cardoso', $response->json()['data']['trading_name']);
});

test('should deny supplier update with dirty request', function () {
    $supplier = Supplier::factory()->create();

    $data = [
        'registration_type' => 'mei',
    ];

    $response = $this->patchJson(route('suppliers.update', ['supplier' => $supplier->id]), $data);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $this->assertSame("The selected registration type is invalid.", $response->json()['message']);
});

test('should soft delete a supplier', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->deleteJson(route('suppliers.destroy', ['supplier' => $supplier->id]));

    $response->assertNoContent();

    $response = $this->getJson(route('suppliers.show', ['supplier' => $supplier->id]));

    $response->assertStatus(Response::HTTP_NOT_FOUND);
    $this->assertSame("The request supplier were not found or not exists", $response->json()['message']);
});
