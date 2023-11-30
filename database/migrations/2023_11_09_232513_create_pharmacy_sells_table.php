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
        Schema::create('pharmacy_sells', function (Blueprint $table) {
            $table->foreignId('pharmacy')->references('id')->on('pharmacies');
            $table->foreignId('drug')->references('id')->on('drugs');
            $table->double('price');
            $table->timestamps();
            $table->unique(['pharmacy','drug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_sells');
    }
};
