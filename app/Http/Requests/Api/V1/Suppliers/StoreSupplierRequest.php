<?php

namespace App\Http\Requests\Api\V1\Suppliers;

use App\Enums\CompanyRegistrationType;
use App\Enums\ISO3166Alpha2;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'active' => 'required|boolean',
            'company_name' => 'required|string|unique:suppliers,company_name|min:10|max:255',
            'trading_name' => 'required|string|unique:suppliers,trading_name|min:10|max:255',
            'registration_number' => 'required|string|unique:suppliers,registration_number|min:11|max:14',
            'registration_type' => ['required', 'string', Rule::in(CompanyRegistrationType::values())],
            'contact_email' => 'nullable|email',
            'contact_isd_code' => 'nullable|string|min:1|max:5',
            'contact_phone_number' => 'nullable|string|min:4|max:12',
            'address_country' => ['nullable', 'string', Rule::in(ISO3166Alpha2::values())],
            'address_postal_code' => 'nullable|string|min:1|max:10',
            'address_province' => 'nullable|string|min:2|max:255',
            'address_street' => 'nullable|string|min:2|max:255',
        ];
    }
}
