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
        Schema::create('progres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerima_id');
            $table->string('TahunPengerjaan')->nullable(); 
            $table->string('jenisPekerjaan')->nullable();
            $table->string('langsirMaterial')->nullable();
            $table->string('jarakLangsir')->nullable();
            $table->string('bedaLangsir')->nullable();
            $table->string('metodeLangsir')->nullable();
            $table->string('KondisiLokasiPekerjaan')->nullable();
            $table->string('KondisiTanahLokasiPekerjaan')->nullable();
            $table->string('PotensiMasalahSosial')->nullable();
            $table->string('TerlampirAktePendirian')->nullable();
            $table->string('TerlampirNPWP')->nullable();
            $table->string('TerlampirBukuRekening')->nullable();
            $table->string('TerlampirProgres')->nullable();
            $table->string('TerlampirRab')->nullable();
            $table->string('TerlampirLembarKerja')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres');
    }
};
