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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->enum('type', ['pemasukan', 'pengeluaran']); // Menentukan jenis transaksi
        $table->integer('amount'); // Nominal uang
        $table->string('description'); // Keterangan transaksi (misal: "Beli kopi")
        $table->date('date'); // Tanggal transaksi
        $table->timestamps(); // Otomatis membuat kolom created_at & updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
