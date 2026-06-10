<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Jalur untuk menampilkan halaman utama aplikasi
Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');

// Jalur untuk memproses form saat user klik tombol "Simpan Transaksi"
Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');