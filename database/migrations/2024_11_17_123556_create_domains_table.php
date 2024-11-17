<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain_id')->unique();
            $table->string('domain_name');
            $table->decimal('domain_price',10,2);
            $table->decimal('domain_transfer_price',10,2);
            $table->decimal('domain_renew_price',10,2);
            $table->decimal('reseller_domain_price',10,2);
            $table->decimal('reseller_domain_transfer_price',10,2);
            $table->decimal('reseller_domain_renew_price',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
