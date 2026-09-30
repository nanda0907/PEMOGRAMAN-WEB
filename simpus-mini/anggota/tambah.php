
<?php
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Anggota</h4>
            </div>

            <div class="card-body">

                <?php if ($flash): ?>
                    <div class="alert alert-<?php echo $flash['type'] === 'success' ? 'success' : 'danger'; ?>">
                        <?php echo $flash['pesan']; ?>
                    </div>
                <?php endif; ?>

                <form id="form-tambah" method="post" action="proses_tambah.php">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control"
                               id="nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_anggota" class="form-label">No. Anggota</label>
                        <input type="text" class="form-control"
                               id="no_anggota" name="no_anggota" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control"
                               id="alamat" name="alamat">
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control"
                               id="no_hp" name="no_hp">
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