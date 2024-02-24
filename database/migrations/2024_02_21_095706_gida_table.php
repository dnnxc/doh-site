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
        Schema::create('gida_table', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('province');
            $table->string('city');
            $table->string('barangay');
            $table->unsignedInteger('year');
            $table->unsignedInteger('population');
            $table->unsignedInteger('ip_population');
            $table->unsignedInteger('hrh');
            $table->unsignedInteger('wo_bhs');
            $table->unsignedInteger('wo_electricity');
            $table->unsignedInteger('wo_signal');
            $table->unsignedInteger('wo_internet');
            $table->unsignedInteger('proportion_sanitary');
            $table->unsignedInteger('proportion_water');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gida_table');
    }
};
