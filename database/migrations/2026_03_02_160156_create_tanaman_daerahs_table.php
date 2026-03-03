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
        Schema::create('tanaman_daerahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained('tanamans')->onDelete('cascade');
            $table->string('nama_daerah');
            $table->string('daerah_asal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanaman_daerahs');
    }
};
