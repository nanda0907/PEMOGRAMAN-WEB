
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

// Ambil ID dari POST, jika tidak ada ambil dari URL
$id = $_POST['id'] ?? $_GET['id'] ?? '';

if (!is_numeric($id) || (int)$id <= 0) {
    die("ID buku tidak valid. POST ID: "
        . htmlspecialchars((string)($_POST['id'] ?? 'kosong'))
        . " | URL ID: "
        . htmlspecialchars((string)($_GET['id'] ?? 'kosong')));
}

$id = (int)$id;

// Ambil data form
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

// Validasi
if ($judul === '' || $pengarang === '' ||
    !is_numeric($tahun) || !is_numeric($stok) ||
    (int)$stok < 0) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Data buku tidak lengkap atau tidak valid.'
    ];

    header("Location: edit.php?id=" . $id);
    exit;
}

try {
    // Update data buku di PostgreSQL
    $sql = "UPDATE buku
            SET judul = :judul,
                pengarang = :pengarang,
                tahun = :tahun,
                isbn = :isbn,
                stok = :stok,
                kategori = :kategori
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':judul' => $judul,
        ':pengarang' => $pengarang,
        ':tahun' => (int)$tahun,
        ':isbn' => $isbn === '' ? null : $isbn,
        ':stok' => (int)$stok,
        ':kategori' => $kategori === '' ? null : $kategori,
        ':id' => $id
    ]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Data buku berhasil diperbarui.'
    ];

    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Gagal update: ' . $e->getMessage()
    ];

    header('Location: edit.php?id=' . $id);
    exit;
}