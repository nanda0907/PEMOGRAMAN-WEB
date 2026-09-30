<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/includes/koneksi.php';

$page_title = "Beranda";

// Hitung jumlah buku dari database
$stmtBuku = $pdo->query("SELECT COUNT(*) FROM buku");
$totalBuku = (int) $stmtBuku->fetchColumn();

// Hitung jumlah anggota dari database
$stmtAnggota = $pdo->query("SELECT COUNT(*) FROM anggota");
$totalAnggota = (int) $stmtAnggota->fetchColumn();

// Jumlah buku yang sedang dipinjam
// Karena proyek ini belum memiliki tabel peminjaman,
// nilainya tetap 0 terlebih dahulu.
$totalDipinjam = 0;

include __DIR__ . '/includes/header.php';
?>

<!-- Judul Beranda -->
<div class="p-4 p-md-5 mb-4 bg-light rounded-3 shadow-sm">
    <div class="container-fluid py-3">
        <h2 class="display-6 fw-bold">
            Selamat Datang di Sistem Perpustakaan Mini
        </h2>

        <p class="col-md-8 fs-5">
            Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.
        </p>

        <a href="buku/list.php" class="btn btn-primary btn-lg">
            Lihat Daftar Buku
        </a>
    </div>
</div>

<!-- Ringkasan -->
<h2 class="mb-3">Ringkasan</h2>

<div class="row g-4">

    <!-- Total Buku -->
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Total Buku</h5>

                <h2 class="card-text fw-bold">
                    <?php echo $totalBuku; ?>
                </h2>
            </div>
        </div>
    </div>

    <!-- Total Anggota -->
    <div class="col-md-4">
        <div class="card text-white bg-success shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Total Anggota</h5>

                <h2 class="card-text fw-bold">
                    <?php echo $totalAnggota; ?>
                </h2>
            </div>
        </div>
    </div>

    <!-- Sedang Dipinjam -->
    <div class="col-md-4">
        <div class="card text-white bg-warning shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Sedang Dipinjam</h5>

                <h2 class="card-text fw-bold">
                    <?php echo $totalDipinjam; ?>
                </h2>
            </div>
        </div>
    </div>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>