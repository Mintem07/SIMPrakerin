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
        Schema::table('pembimbings', function (Blueprint $table) {
            $table->string('jenis_kelamin')->after('nama_pembimbing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembimbings', function (Blueprint $table) {
            $table->dropColumn('jenis_kelamin');
        });
    }
};
