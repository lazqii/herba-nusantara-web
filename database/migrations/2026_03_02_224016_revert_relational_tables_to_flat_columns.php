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
        // Drop relational tables
        Schema::dropIfExists('tanaman_sumbers');
        Schema::dropIfExists('tanaman_efek_sampings');
        Schema::dropIfExists('tanaman_olahans');
        Schema::dropIfExists('tanaman_khasiats');
        Schema::dropIfExists('tanaman_daerahs');
        Schema::dropIfExists('tanaman_ilmiahs');

        // Add flat columns to tanamans table
        Schema::table('tanamans', function (Blueprint $table) {
            $table->string('nama_ilmiah')->nullable();
            $table->text('khasiat')->nullable();
            $table->text('olahan')->nullable();
            $table->text('efek_samping')->nullable();
            $table->string('sumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tanamans', function (Blueprint $table) {
            $table->dropColumn(['nama_ilmiah', 'khasiat', 'olahan', 'efek_samping', 'sumber']);
        });

        // Recreate relational tables
        Schema::create('tanaman_ilmiahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained()->onDelete('cascade');
            $table->string('nama_ilmiah');
            $table->string('famili')->nullable();
            $table->timestamps();
        });
        
        Schema::create('tanaman_daerahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained()->onDelete('cascade');
            $table->string('nama_daerah');
            $table->string('daerah_asal')->nullable();
            $table->timestamps();
        });

        Schema::create('tanaman_khasiats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained()->onDelete('cascade');
            $table->string('khasiat');
            $table->string('penjelasan')->nullable();
            $table->timestamps();
        });

        Schema::create('tanaman_olahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained()->onDelete('cascade');
            $table->text('langkah_pengolahan');
            $table->timestamps();
        });

        Schema::create('tanaman_efek_sampings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained()->onDelete('cascade');
            $table->string('efek_samping');
            $table->timestamps();
        });

        Schema::create('tanaman_sumbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained()->onDelete('cascade');
            $table->string('judul_jurnal')->nullable();
            $table->string('penulis')->nullable();
            $table->string('tahun')->nullable();
            $table->string('link_jurnal')->nullable();
            $table->timestamps();
        });
    }
};
