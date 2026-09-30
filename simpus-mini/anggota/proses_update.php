
<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// Mengambil data dari form
$id = $_POST['id'] ?? '';
$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');

// Validasi data
$errors = [];

if (!is_numeric($id)) {
    $errors[] = "ID anggota tidak valid.";
}

if ($nama === '') {
    $errors[] = "Nama anggota wajib diisi.";
}

if ($no_anggota === '') {
    $errors[] = "Nomor anggota wajib diisi.";
}

// Jika ada kesalahan
if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];

    header('Location: list.php');
    exit;
}

try {

    // Update data anggota berdasarkan ID
    $stmt = $pdo->prepare(
        "UPDATE anggota
         SET nama = :nama,
             no_anggota = :no_anggota,
             alamat = :alamat,
             no_hp = :no_hp
         WHERE id = :id"
    );

    $stmt->execute([
        'nama' => $nama,
        'no_anggota' => $no_anggota,
        'alamat' => $alamat,
        'no_hp' => $no_hp,
        'id' => (int) $id
    ]);

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Data anggota berhasil diperbarui.'
    ];

} catch (PDOException $e) {

    // Nomor anggota tidak boleh duplikat
    if ($e->getCode() === '23505') {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Nomor anggota sudah digunakan.'
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Gagal memperbarui data anggota.'
        ];
    }

}

header('Location: list.php');
exit;