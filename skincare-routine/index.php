<?php
require_once "includes/koneksi.php";

$total = pg_fetch_assoc(
    pg_query($conn, "SELECT COUNT(*) AS total FROM rutinitas")
);

$pagi = pg_fetch_assoc(
    pg_query($conn, "SELECT COUNT(*) AS total FROM rutinitas WHERE waktu='Pagi'")
);

$malam = pg_fetch_assoc(
    pg_query($conn, "SELECT COUNT(*) AS total FROM rutinitas WHERE waktu='Malam'")
);

include "includes/header.php";
?>

<h2>Selamat Datang di GlowTrack</h2>
<p>Catat dan atur rutinitas skincare kamu setiap hari.</p>

<div class="hero">
    <h3>Rawat Kulitmu Setiap Hari</h3>
    <p>Kelola produk skincare pagi dan malam dengan mudah.</p>

    <a href="rutinitas/daftar.php" class="btn">Lihat Rutinitas</a>
    <a href="rutinitas/tambah.php" class="btn">Tambah Produk</a>
</div>

<h2>Ringkasan Rutinitas</h2>

<div class="dashboard">
    <div class="card">
        <h3>Total Rutinitas</h3>
        <p><?= $total['total'] ?></p>
    </div>

    <div class="card">
        <h3>Rutinitas Pagi</h3>
        <p><?= $pagi['total'] ?></p>
    </div>

    <div class="card">
        <h3>Rutinitas Malam</h3>
        <p><?= $malam['total'] ?></p>
    </div>
</div>

<?php include "includes/footer.php"; ?>