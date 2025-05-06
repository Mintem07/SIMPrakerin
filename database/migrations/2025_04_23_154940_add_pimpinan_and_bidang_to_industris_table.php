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
        Schema::table('industris', function (Blueprint $table) {
            $table->string('pimpinan')->after('nama_industri');
            $table->string('bidang')->after('pimpinan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('industris', function (Blueprint $table) {
            $table->dropColumn(['pimpinan', 'bidang']);
        });
    }
};
