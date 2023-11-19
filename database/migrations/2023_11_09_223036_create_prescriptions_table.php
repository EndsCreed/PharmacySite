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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor');
            $table->integer('drug');
            $table->integer('patient');
            $table->date('date');
            $table->foreign('doctor')->references('sin')->on('doctors');
            $table->foreign('patient')->references('sin')->on('patients');
            $table->foreign('drug')->references('id')->on('drugs');
            $table->integer('quantity');
            $table->unique(['doctor','patient','drug','date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
