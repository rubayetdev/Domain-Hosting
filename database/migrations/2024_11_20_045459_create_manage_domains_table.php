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
        Schema::create('manage_domains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_no');
            $table->foreign('order_no')->references('order_id')->on('orders');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('user_id')->on('users');
            $table->text('ns1')->nullable();
            $table->text('ns2')->nullable();
            $table->text('ns3')->nullable();
            $table->text('ns4')->nullable();
            $table->text('eppcode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_domains');
    }
};
