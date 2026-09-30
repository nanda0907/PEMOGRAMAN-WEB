
<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// Mengambil ID anggota dari URL
$id = $_GET['id'] ?? '';

if (!is_numeric($id)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'ID anggota tidak valid.'
    ];

    header('Location: list.php');
    exit;
}

// Mengambil data anggota berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute(['id' => (int) $id]);

$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika data tidak ditemukan
if (!$anggota) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Data anggota tidak ditemukan.'
    ];

    header('Location: list.php');
    exit;
}

// Menampilkan header setelah proses redirect selesai
$page_title = "Edit Anggota";
include __DIR__ . '/../includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

        <div class="card shadow-sm">

            <div class="card-header bg-warning">
                <h4 class="mb-0">Edit Anggota</h4>
            </div>

            <div class="card-body">

                <form method="POST" action="proses_update.php">

                    <!-- ID anggota yang akan diupdate -->
                    <input type="hidden" name="id"
                           value="<?php echo $anggota['id']; ?>">

                    <div class="mb-3">
                        <label for="nama" class="form-label">
                            Nama Anggota
                        </label>

                        <input type="text" class="form-control"
                               id="nama" name="nama"
                               value="<?php echo htmlspecialchars($anggota['nama']); ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="no_anggota" class="form-label">
                            Nomor Anggota
                        </label>

                        <input type="text" class="form-control"
                               id="no_anggota" name="no_anggota"
                               value="<?php echo htmlspecialchars($anggota['no_anggota']); ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">
                            Alamat
                        </label>

                        <textarea class="form-control"
                                  id="alamat" name="alamat"
                                  rows="3"><?php echo htmlspecialchars($anggota['alamat'] ?? ''); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">
                            Nomor HP
                        </label>

                        <input type="text" class="form-control"
                               id="no_hp" name="no_hp"
                               value="<?php echo htmlspecialchars($anggota['no_hp'] ?? ''); ?>">
                    </div>

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-warning">
                            Simpan Perubahan
                        </button>

                        <a href="list.php" class="btn btn-secondary">
                            Kembali
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>