
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? '';

if (!is_numeric($id) || (int)$id <= 0) {
    die("ID buku tidak valid. ID dari URL: " . htmlspecialchars((string)$id));
}

// Ambil data buku
$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => (int)$id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    die("Data buku dengan ID tersebut tidak ditemukan.");
}

// Header dipanggil setelah pengecekan selesai
$page_title = "Edit Buku";
include __DIR__ . '/../includes/header.php';
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Edit Buku</h4>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="proses_update.php?id=<?php echo (int)$buku['id']; ?>">

                        <input type="hidden" name="id"
                               value="<?php echo (int)$buku['id']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" name="judul"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($buku['judul']); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pengarang</label>
                            <input type="text" name="pengarang"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($buku['pengarang'] ?? ''); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" name="tahun"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($buku['tahun']); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn"
                                   class="form-control"
                                   value="<?php echo htmlspecialchars($buku['isbn'] ?? ''); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok"
                                   class="form-control" min="0"
                                   value="<?php echo htmlspecialchars($buku['stok']); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="">Pilih Kategori</option>

                                <option value="fiksi"
                                    <?php echo ($buku['kategori'] ?? '') === 'fiksi' ? 'selected' : ''; ?>>
                                    Fiksi
                                </option>

                                <option value="non-fiksi"
                                    <?php echo ($buku['kategori'] ?? '') === 'non-fiksi' ? 'selected' : ''; ?>>
                                    Non-Fiksi
                                </option>

                                <option value="referensi"
                                    <?php echo ($buku['kategori'] ?? '') === 'referensi' ? 'selected' : ''; ?>>
                                    Referensi
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning">
                            Simpan Perubahan
                        </button>

                        <a href="list.php" class="btn btn-secondary">
                            Kembali
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>