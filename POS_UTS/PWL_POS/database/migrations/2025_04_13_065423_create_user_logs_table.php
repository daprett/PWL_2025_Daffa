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
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id('logs_id'); // Primary key
            $table->unsignedBigInteger('performed_by')->index(); // ID user yang melakukan aksi
            $table->string('activity'); // Nama aktivitas, misalnya: "Tambah User"
            $table->string('target')->nullable(); // User yang ditarget (optional)
            $table->timestamp('performed_at')->useCurrent(); // Waktu kejadian
            $table->text('detail')->nullable(); // Keterangan tambahan

            // Foreign key ke tabel m_user
            $table->foreign('performed_by')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
    }
};
