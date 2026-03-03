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
        Schema::table('tanamans', function (Blueprint $table) {
            $table->string('scientific_name')->nullable();
            $table->string('kategori')->nullable();
            $table->text('manfaat')->nullable();
            $table->text('cara_pengolahan')->nullable();
            $table->text('efek_samping')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tanamans', function (Blueprint $table) {
            $table->dropColumn(['scientific_name', 'kategori', 'manfaat', 'cara_pengolahan', 'efek_samping']);
        });
    }
};
