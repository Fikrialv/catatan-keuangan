<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // 1. Menampilkan halaman utama beserta data keuangan
// 1. Menampilkan halaman utama beserta data keuangan
    public function index()
    {
        // Menambahkan ::query() membantu VS Code memahami Eloquent Laravel
        $transactions = Transaction::query()->latest()->get();

        // Hitung total pemasukan
        $totalPemasukan = Transaction::query()->where('type', 'pemasukan')->sum('amount');

        // Hitung total pengeluaran
        $totalPengeluaran = Transaction::query()->where('type', 'pengeluaran')->sum('amount');

        // Hitung sisa saldo akhir
        $totalSaldo = $totalPemasukan - $totalPengeluaran;

        // Kirim data di atas ke halaman 'index' di folder views
        return view('index', compact('transactions', 'totalPemasukan', 'totalPengeluaran', 'totalSaldo'));
    }

    // 2. Menyimpan transaksi baru yang diinput user
    public function store(Request $request)
    {
        // Validasi input dari user menggunakan format Array agar lebih aman dan bebas error pemisah
        $request->validate([
            'type'        => ['required', 'in:pemasukan,pengeluaran'],
            'amount'      => ['required', 'numeric', 'min:1'],
            'description' => ['required', 'string', 'max:255'],
            'date'        => ['required', 'date'],
        ]);

        // Simpan ke database menggunakan Model Transaction
        Transaction::create($request->all());

        // Setelah sukses, kembalikan user ke halaman utama dengan pesan sukses
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dicatat!');
    }
}