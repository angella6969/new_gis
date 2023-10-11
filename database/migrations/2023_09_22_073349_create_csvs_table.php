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
        Schema::create('csvs', function (Blueprint $table) {
            $table->id();
            $table->string('NUMPOINTS');
            $table->string('WADMKC');
            $table->string('WADMKK');
            $table->string('WADMPR');
            $table->longText('WKT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csvs');
    }
};
