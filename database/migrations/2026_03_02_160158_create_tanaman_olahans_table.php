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
        Schema::create('tanaman_olahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tanaman_id')->constrained('tanamans')->onDelete('cascade');
            $table->text('langkah_pengolahan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanaman_olahans');
    }
};
