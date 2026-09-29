<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$base = "/PEMOGRAMAN-WEB/skincare-routine/";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlowTrack</title>

    <link rel="stylesheet" href="<?= $base ?>assets/assets/style.css?v=3">
</head>
<body>

<header>
    <div class="container">
        <h1>GlowTrack</h1>

        <nav>
            <a href="<?= $base ?>index.php">Beranda</a>
            <a href="<?= $base ?>rutinitas/daftar.php">Rutinitas</a>
            <a href="<?= $base ?>rutinitas/tambah.php">Tambah</a>
        </nav>
    </div>
</header>

<main class="container">

<?php if (isset($_SESSION['success'])): ?>
    <p class="alert">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </p>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <p class="alert">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>