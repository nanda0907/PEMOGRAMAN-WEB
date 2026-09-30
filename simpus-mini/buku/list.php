<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

// PROSES HAPUS BUKU
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['hapus_buku'])
) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id && $id > 0) {
        try {
            $stmt = $pdo->prepare(
                "DELETE FROM buku WHERE id = :id"
            );

            $stmt->execute([
                ':id' => $id
            ]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'pesan' => 'Buku berhasil dihapus!'
                ];
            } else {
                $_SESSION['flash'] = [
                    'type' => 'danger',
                    'pesan' => 'Data buku tidak ditemukan.'
                ];
            }

        } catch (PDOException $e) {
            error_log($e->getMessage());

            $_SESSION['flash'] = [
                'type' => 'danger',
                'pesan' => 'Buku gagal dihapus. Data mungkin masih digunakan oleh transaksi atau peminjaman.'
            ];
        }
    } else {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'pesan' => 'ID buku tidak valid.'
        ];
    }

    header('Location: list.php');
    exit;
}

$page_title = "Daftar Buku";

include __DIR__ . '/../includes/header.php';

// Notifikasi
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Ambil data buku terbaru dari PostgreSQL
$stmt = $pdo->query(
    "SELECT * FROM buku ORDER BY id DESC"
);

$daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Buku</h2>

    <a href="tambah.php" class="btn btn-primary">
        + Tambah Buku
    </a>
</div>

<!-- Pesan notifikasi -->
<?php if ($flash): ?>
    <div class="alert alert-<?php echo $flash['type'] === 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show">
        <?php echo htmlspecialchars($flash['pesan']); ?>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Pencarian -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <label for="search-input" class="form-label">
            Cari Judul Buku
        </label>

        <input type="text"
               id="search-input"
               class="form-control"
               placeholder="Ketik judul buku...">
    </div>
</div>

<!-- Tabel Buku -->
<div class="card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-primary">
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($daftarBuku)): ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada data buku. Silakan tambah lewat menu Tambah Buku.
                            </td>
                        </tr>
                    <?php else: ?>

                        <?php foreach ($daftarBuku as $buku): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($buku['judul'] ?? ''); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($buku['pengarang'] ?? ''); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars((string) ($buku['tahun'] ?? '')); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars((string) ($buku['stok'] ?? 0)); ?>
                                </td>

                                <td>
                                    <a href="edit.php?id=<?php echo (int) $buku['id']; ?>"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="list.php"
                                          style="display: inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus buku ini?');">

                                        <input type="hidden"
                                               name="id"
                                               value="<?php echo (int) $buku['id']; ?>">

                                       <button type="submit" name="hapus_buku" value="1" class="btn btn-warning btn-sm" style="font-size: 12px; padding: 4px 8px;">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>