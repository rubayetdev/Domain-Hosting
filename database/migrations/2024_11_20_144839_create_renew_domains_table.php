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
        Schema::create('renew_domains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('user_id')->on('users');
            $table->string('domain_id');
            $table->foreign('domain_id')->references('domain_id')->on('domains');
            $table->date('register_date');
            $table->date('expire_date');
            $table->text('domain_type');
            $table->decimal('price',10,2);
            $table->string('status');
            $table->string('payment_id');
            $table->foreign('payment_id')->references('payment_id')->on('payment_histories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renew_domains');
    }
};
