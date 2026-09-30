
<?php
$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Buku</h4>
            </div>

            <div class="card-body">

                <?php if ($flash): ?>
                    <div class="alert alert-<?php echo $flash['type'] === 'success' ? 'success' : 'danger'; ?>">
                        <?php echo $flash['pesan']; ?>
                    </div>
                <?php endif; ?>

                <form id="form-tambah" method="post" action="proses_tambah.php">

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control"
                               id="judul" name="judul" required>
                    </div>

                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" class="form-control"
                               id="pengarang" name="pengarang" required>
                    </div>

                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control"
                               id="tahun" name="tahun"
                               min="1900" max="2026" required>
                    </div>

                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control"
                               id="isbn" name="isbn">
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control"
                               id="stok" name="stok"
                               min="0" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori">
                            <option value="fiksi">Fiksi</option>
                            <option value="non-fiksi">Non-Fiksi</option>
                            <option value="referensi">Referensi</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            Simpan
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