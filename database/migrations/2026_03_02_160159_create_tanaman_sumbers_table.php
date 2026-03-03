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
        Schema::create('tanaman_sumbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained('tanamans')->onDelete('cascade');
            $table->string('judul_jurnal');
            $table->string('penulis')->nullable();
            $table->string('tahun')->nullable();
            $table->string('link_jurnal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanaman_sumbers');
    }
};
