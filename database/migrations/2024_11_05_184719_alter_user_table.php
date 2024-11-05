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
        Schema::table('users',function (Blueprint $table){
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('companyEmail')->unique();
            $table->string('companyName');
            $table->string('companyLogo');
            $table->string('fname');
            $table->string('lname');
            $table->string('phone')->unique();
            $table->string('wpNumber')->unique();
            $table->string('city');
            $table->string('postal_code');
            $table->string('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
