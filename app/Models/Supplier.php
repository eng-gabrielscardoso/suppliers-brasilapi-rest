<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use App\Enums\CompanyRegistrationType;
use App\Enums\ISO3166Alpha2;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use Filterable, HasFactory, Searchable, SoftDeletes, Sortable;

    protected $fillable = [
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
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'registration_type' => CompanyRegistrationType::class,
            'address_country' => ISO3166Alpha2::class,
        ];
    }
}
