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
        Schema::create('contracts', function (Blueprint $table) {
            $table->string('company');
            $table->foreignId('pharmacy')->references('id')->on('pharmacies');
            $table->foreign('company')->references('name')->on('companies');
            $table->date('issued');
            $table->date('expires');
            $table->integer('supervisorID');
            $table->timestamps();
            $table->unique(['company','pharmacy']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
