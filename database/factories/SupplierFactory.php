<?php

namespace Database\Factories;

use App\Enums\CompanyRegistrationType;
use App\Enums\ISDCode;
use App\Enums\ISO3166Alpha2;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'active' => $this->faker->boolean(),
            'company_name' => $this->faker->unique()->company(),
            'trading_name' => $this->faker->unique()->company(),
            'registration_number' => $this->faker->unique()->numerify('##############'),
            'registration_type' => $this->faker->randomElement(CompanyRegistrationType::values()),
            'contact_email' => $this->faker->companyEmail(),
            'contact_isd_code' => $this->faker->numerify('##'),
            'contact_phone_number' => $this->faker->numerify('###########'),
            'address_country' => $this->faker->randomElement(ISO3166Alpha2::values()),
            'address_postal_code' => $this->faker->numerify('##########'),
            'address_province' => $this->faker->address(),
            'address_street' => $this->faker->streetAddress(),
        ];
    }
}
