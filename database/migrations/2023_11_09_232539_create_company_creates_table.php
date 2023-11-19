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
        Schema::create('company_creates', function (Blueprint $table) {
            $table->string('company');
            $table->integer('drug')->unique();
            $table->foreign('drug')->references('id')->on('drugs');
            $table->foreign('company')->references('name')->on('companies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_creates');
    }
};
