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
        Schema::create('data_sertifikat', function (Blueprint $table) {
            $table->id();
            $table->string('kepala_dinas')->nullable();
            $table->string('nip')->nullable();
            $table->string('kepala_bpsmb')->nullable();
            $table->string('nip_bpsmb')->nullable();
            $table->string('technical_manager')->nullable();
            $table->string('nip_manager')->nullable();
            $table->string('no_lab')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sertifikat');
    }
};
