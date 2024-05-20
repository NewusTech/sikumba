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
        Schema::create('form_kalibrasi', function (Blueprint $table) {
            $table->id();
            $table->integer('userID')->nullable();
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->string('berkas')->nullable();
            $table->string('berkas_laporan')->nullable();
            $table->string('berkas_analis')->nullable();
            $table->text('address')->nullable();
            $table->string('nama_alat')->nullable();
            $table->string('merek_alat')->nullable();
            $table->string('serial_number_alat')->nullable();
            $table->string('kapasitas')->nullable();
            $table->string('area_kalibrasi')->nullable();
            $table->string('file_pengajuan')->nullable();
            $table->integer('status')->nullable();
            $table->integer('user_confirm')->default(0);
            $table->integer('admin_confirm')->default(0);
            $table->integer('done_survey')->default(0);
            $table->string('bukti_pembayaran_kalibrasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
