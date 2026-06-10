<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Keuangan Pribadi</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* DEFINISI VARIABEL WARNA YANG KONSISTEN */
        :root {
            --bg-body: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            --text-main: #1e293b;
            --text-muted: #64748b;
            --card-bg: #ffffff;
            --card-hover-shadow: rgba(0, 0, 0, 0.08);
            
            /* Warna khusus tabel mode terang */
            --table-thead-bg: #f8fafc;
            --table-thead-text: #475569;
            --table-tr-bg: #ffffff;
            --table-tr-hover: #f1f5f9;
            
            --input-bg: #ffffff;
            --input-border: #cbd5e1;
            --input-text: #1e293b;
        }

        [data-theme="dark"] {
            --bg-body: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --card-bg: #1e293b;
            --card-hover-shadow: rgba(0, 0, 0, 0.4);
            
            /* Warna khusus tabel mode gelap (DIJAMIN KONTRAS) */
            --table-thead-bg: #111827;
            --table-thead-text: #94a3b8;
            --table-tr-bg: #334155;
            --table-tr-hover: #475569;
            
            --input-bg: #1e293b;
            --input-border: #475569;
            --input-text: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            min-height: 100vh;
            color: var(--text-main);
            transition: background 0.3s ease, color 0.3s ease;
        }
        .main-title {
            font-weight: 700;
            color: var(--text-main);
        }
        
        .theme-toggle-btn {
            background: var(--card-bg);
            color: var(--text-main);
            border: 1px solid var(--input-border);
            padding: 10px 16px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .theme-toggle-btn:hover { transform: scale(1.05); }

        .custom-card {
            background: var(--card-bg);
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }
        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px var(--card-hover-shadow);
        }

        .bg-gradient-balance { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .bg-gradient-income { background: linear-gradient(135deg, #10b981, #047857); }
        .bg-gradient-expense { background: linear-gradient(135deg, #ef4444, #b91c1c); }
        
        .stat-card {
            border: none;
            border-radius: 16px;
            color: white !important;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }

        /* Form Inputs Custom */
        .form-control, .form-select {
            background-color: var(--input-bg) !important;
            color: var(--input-text) !important;
            border-radius: 10px;
            padding: 10px 14px;
            border: 1px solid var(--input-border) !important;
        }
        .form-control::placeholder {
            color: var(--text-muted);
            opacity: 0.7;
        }

        .btn-submit {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            color: white;
        }

        /* RE-DESIGN UTUH STRUKTUR TABEL (Bebas dari Class Tabrakan Bootstrap) */
        .custom-table-container {
            width: 100%;
            overflow-x: auto;
        }
        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        .custom-table th {
            background-color: var(--table-thead-bg);
            color: var(--table-thead-text);
            padding: 16px;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
        }
        .custom-table th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
        .custom-table th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

        .custom-table tbody tr {
            background-color: var(--table-tr-bg);
            transition: background-color 0.2s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.01);
        }
        .custom-table tbody tr:hover {
            background-color: var(--table-tr-hover);
        }
        .custom-table td {
            padding: 16px;
            color: var(--text-main);
            border: none;
            vertical-align: middle;
        }
        .custom-table tbody tr td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
        .custom-table tbody tr td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
        
        .badge-custom { padding: 6px 12px; border-radius: 8px; font-weight: 500; font-size: 0.85rem; }
        .bg-success-custom { background-color: rgba(16, 185, 129, 0.15); color: #10b981; }
        .bg-danger-custom { background-color: rgba(239, 68, 68, 0.15); color: #ef4444; }
    </style>
</head>
<body>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-5" data-aos="fade-down" data-aos-duration="1000">
            <div>
                <h1 class="main-title mb-1"><i class="fa-solid fa-wallet text-primary me-2"></i>Catatan Keuangan</h1>
                <p class="mb-0" style="color: var(--text-muted);">Kelola finansial harianmu dengan elegan</p>
            </div>
            <button id="themeToggle" class="theme-toggle-btn">
                <i id="themeIcon" class="fa-solid fa-moon me-2"></i><span id="themeText">Dark Mode</span>
            </button>
        </div>

        <div class="row text-center mb-5">
            <div class="col-md-4 mb-3" data-aos="zoom-in" data-aos-delay="100">
                <div class="card stat-card bg-gradient-balance p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="opacity-75">Total Saldo</span>
                        <i class="fa-solid fa-scale-balanced fa-2x opacity-50"></i>
                    </div>
                    <h3 class="text-white">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="col-md-4 mb-3" data-aos="zoom-in" data-aos-delay="200">
                <div class="card stat-card bg-gradient-income p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="opacity-75">Total Pemasukan</span>
                        <i class="fa-solid fa-arrow-trend-up fa-2x opacity-50"></i>
                    </div>
                    <h3 class="text-white">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="col-md-4 mb-3" data-aos="zoom-in" data-aos-delay="300">
                <div class="card stat-card bg-gradient-expense p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="opacity-75">Total Pengeluaran</span>
                        <i class="fa-solid fa-arrow-trend-down fa-2x opacity-50"></i>
                    </div>
                    <h3 class="text-white">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-right" data-aos-duration="1000">
                <div class="card custom-card p-4">
                    <h4 class="mb-4 font-weight-bold" style="color: var(--text-main);"><i class="fa-solid fa-square-plus text-primary me-2"></i>Tambah Data</h4>
                    <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold" style="color: var(--text-muted);">JENIS TRANSAKSI</label>
                            <select name="type" class="form-select" required>
                                <option value="pemasukan">🟢 Pemasukan</option>
                                <option value="pengeluaran">🔴 Pengeluaran</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold" style="color: var(--text-muted);">NOMINAL (RP)</label>
                            <input type="number" name="amount" class="form-control" placeholder="Mulai dari 1..." min="1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold" style="color: var(--text-muted);">KETERANGAN</label>
                            <input type="text" name="description" class="form-control" placeholder="Contoh: Gaji, Beli Kopi" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold" style="color: var(--text-muted);">TANGGAL</label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-submit w-100">Simpan Catatan</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8" data-aos="fade-left" data-aos-duration="1000">
                <div class="card custom-card p-4">
                    <h4 class="mb-4 font-weight-bold" style="color: var(--text-main);"><i class="fa-solid fa-history text-primary me-2"></i>Riwayat Transaksi</h4>
                    <div class="custom-table-container">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>TANGGAL</th>
                                    <th>KETERANGAN</th>
                                    <th>JENIS</th>
                                    <th class="text-end">NOMINAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $t)
                                    <tr>
                                        <td class="small fw-medium" style="color: var(--text-muted);">{{ \Carbon\Carbon::parse($t->date)->format('d M Y') }}</td>
                                        <td class="fw-semibold" style="color: var(--text-main);">{{ $t->description }}</td>
                                        <td>
                                            @if($t->type == 'pemasukan')
                                                <span class="badge-custom bg-success-custom"><i class="fa-solid fa-circle-arrow-up me-1"></i>Pemasukan</span>
                                            @else
                                                <span class="badge-custom bg-danger-custom"><i class="fa-solid fa-circle-arrow-down me-1"></i>Pengeluaran</span>
                                            @endif
                                        </td>
                                        <td class="text-end {{ $t->type == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                            <span class="fw-bold">Rp {{ number_format($t->amount, 0, ',', '.') }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5" style="color: var(--text-muted);">
                                            <i class="fa-solid fa-receipt fa-3x opacity-25 mb-3 d-block"></i>
                                            Belum ada transaksi yang dicatat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        AOS.init({ once: true });

        const themeToggleBtn = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const themeText = document.getElementById('themeText');
        
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);
        updateToggleUI(currentTheme);

        themeToggleBtn.addEventListener('click', () => {
            let theme = document.documentElement.getAttribute('data-theme');
            let newTheme = theme === 'light' ? 'dark' : 'light';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateToggleUI(newTheme);
        });

        function updateToggleUI(theme) {
            if (theme === 'dark') {
                themeIcon.className = 'fa-solid fa-sun me-2';
                themeText.innerText = 'Light Mode';
            } else {
                themeIcon.className = 'fa-solid fa-moon me-2';
                themeText.innerText = 'Dark Mode';
            }
        }

        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#3b82f6',
                timer: 2300
            });
        @endif
    </script>
</body>
</html>