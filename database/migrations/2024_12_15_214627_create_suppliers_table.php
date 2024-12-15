<?php

use App\Enums\CompanyRegistrationType;
use App\Enums\ISDCode;
use App\Enums\ISO3166Alpha2;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            $table->boolean('active')->default(true);

            $table->string('company_name', 255)->unique();
            $table->string('trading_name', 255)->unique();

            $table->string('registration_number', 14)->unique();
            $table->enum('registration_type', CompanyRegistrationType::values());

            $table->string('contact_email', 255)->nullable();
            $table->string('contact_isd_code', 5)->nullable();
            $table->string('contact_phone_number', 12)->nullable();

            $table->enum('address_country', ISO3166Alpha2::values())->nullable();
            $table->string('address_postal_code', 10)->nullable();
            $table->string('address_province', 255)->nullable();
            $table->string('address_street', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
