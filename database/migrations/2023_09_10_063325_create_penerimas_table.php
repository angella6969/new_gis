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
        Schema::create('penerimas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daerah_irigasi_id');
            $table->foreignId('map_id')->nullable();
            $table->string('Kabupaten');
            $table->string('provinsi');
            $table->string('Desa');
            $table->string('Kecamatan');
            $table->string('names'); 
            $table->string('IrigasiDesaTerbangun')->nullable();
            $table->string('IrigasiDesaBelumTerbangun')->nullable();
            $table->string('PolaTanamSaatIni')->nullable();
            $table->string('JenisVegetasi')->nullable();
            $table->string('MendapatkanP4_ISDA')->nullable();
            $table->string('TahunMendapatkan')->nullable();
            $table->string('peta_pdf')->nullable();
            $table->string('jaringan_pdf')->nullable();
            $table->string('dokumentasi_pdf')->nullable();
            $table->string('xAx')->nullable();
            $table->string('yAx')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimas');
    }
};
