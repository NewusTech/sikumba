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
        Schema::table('form_pengajuan', function (Blueprint $table) {
            $table->string('qty_package')->nullable()->change();
            $table->string('biaya')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_pengajuan', function (Blueprint $table) {
            $table->integer('qty_package')->nullable()->change();
            $table->dropColumn('biaya');
        });
    }
};
