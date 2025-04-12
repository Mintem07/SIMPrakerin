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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('kelompok_id')->constrained('kelompoks')->onDelete('cascade');
            $table->foreignId('pembimbing_id')->constrained('pembimbings')->onDelete('cascade');
            $table->decimal('average_poin', 5, 2)->nullable();
            $table->decimal('report_poin', 5, 2)->nullable();
            $table->string('form_bukti');
            $table->enum('status', ['Pending', 'Lulus', 'Tidak Lulus'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};