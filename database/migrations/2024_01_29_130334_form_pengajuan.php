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
        Schema::create('form_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->integer('userID')->nullable();
            $table->string('name')->nullable();
            $table->string('sealing_mark')->nullable();
            $table->date('date')->nullable();
            $table->string('berkas')->nullable();
            $table->string('berkas_laporan')->nullable();
            $table->string('berkas_analis')->nullable();
            $table->string('report_sealing')->nullable();
            $table->string('consignment_commodity')->nullable();
            $table->string('identification')->nullable();
            $table->string('exporting_comp')->nullable();
            $table->text('address')->nullable();
            $table->string('regist_number')->nullable();
            $table->string('type_commodity')->nullable();
            $table->string('type_packing')->nullable();
            $table->integer('qty_package')->nullable();
            $table->string('weight')->nullable();
            $table->string('volume')->nullable();
            $table->integer('type')->nullable();
            $table->string('file_pengajuan')->nullable();
            $table->integer('status')->nullable();
            $table->integer('user_confirm')->default(0);
            $table->integer('admin_confirm')->default(0);
            $table->string('no_surat')->nullable();
            $table->string('commodity_surat')->nullable();
            $table->string('noserial_surat')->nullable();
            $table->string('sample_desc_surat')->nullable();
            $table->string('code_number_surat')->nullable();
            $table->date('received_surat')->nullable();
            $table->date('testing_surat')->nullable();
            $table->date('analisdate_surat')->nullable();
            $table->string('no_laporan')->nullable();
            $table->json('detail')->nullable();
            $table->json('detail_tambahan')->nullable();
            $table->json('detail_laporan')->nullable();
            $table->string('no_sni')->nullable();
            $table->string('grade')->nullable();
            $table->string('note_sertif')->nullable();
            $table->string('note_laporan')->nullable();
            $table->integer('done_survey')->default(0);
            $table->string('bukti_pembayaran_pengujian')->nullable();
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
