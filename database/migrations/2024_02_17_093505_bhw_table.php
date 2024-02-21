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
        Schema::create('bhw_table', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('province');
            $table->string('city');
            $table->unsignedInteger('population');
            $table->unsignedInteger('male');
            $table->unsignedInteger('female');
            $table->unsignedInteger('elementary');
            $table->unsignedInteger('high_school');
            $table->unsignedInteger('college');
            $table->unsignedInteger('others');
            $table->unsignedInteger('age_18_29');
            $table->unsignedInteger('age_30_59');
            $table->unsignedInteger('age_60_above');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bhw_table');
    }
};
