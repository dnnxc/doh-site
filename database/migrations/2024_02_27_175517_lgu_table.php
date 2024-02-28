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
        Schema::create('lgu_table', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('province');
            $table->string('city');
            $table->unsignedInteger('year');
            $table->unsignedInteger('tb_case');
            $table->unsignedInteger('tb_treatment');
            $table->unsignedDecimal('safe_water',5,2);
            $table->unsignedDecimal('stunting',5,2);
            $table->unsignedDecimal('full_immune',5,2);
            $table->unsignedDecimal('risk_philpen',5,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lgu_table');
    }
};
