<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //Deklarasi fungsi dengan nama up dengan void yang berati tidak mengembalikan nilai
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id(); //atribut sebagai primary key  
            $table->String('name'); // atribut bertype String yang dapat diisikan nama 
            $table->text('description'); // atribut bertype text yang dapat di isikan text(deskripsi)
            $table->timestamps(); //menyimpan waktu saat di buat pertamakali 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
