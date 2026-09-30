
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mengatur path root project
$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS bawaan project -->
    <link rel="stylesheet" href="<?php echo $base; ?>style.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">

            <a class="navbar-brand fw-bold" href="<?php echo $base; ?>index.php">
                SIMPUS-Mini
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarMenu"
                    aria-controls="navbarMenu"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>index.php">
                            Beranda
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>buku/list.php">
                            Daftar Buku
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>buku/tambah.php">
                            Tambah Buku
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>anggota/list.php">
                            Daftar Anggota
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>anggota/tambah.php">
                            Tambah Anggota
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <main class="container py-4">