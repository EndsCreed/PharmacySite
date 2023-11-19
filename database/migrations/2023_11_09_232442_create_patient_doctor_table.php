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
        Schema::create('patient_doctor', function (Blueprint $table) {
            $table->integer('patient')->unique();
            $table->integer('doctor');
            $table->foreign('patient')->references('sin')->on('patients');
            $table->foreign('doctor')->references('sin')->on('doctors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_doctor');
    }
};
