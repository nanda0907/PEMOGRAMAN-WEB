<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../includes/koneksi.php';

// PROSES HAPUS ANGGOTA
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['hapus_anggota'])
) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id && $id > 0) {
        try {
            $stmt = $pdo->prepare(
                "DELETE FROM anggota WHERE id = :id"
            );

            $stmt->execute([
                ':id' => $id
            ]);

            if ($stmt->rowCount() > 0) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'pesan' => 'Anggota berhasil dihapus!'
                ];
            } else {
                $_SESSION['flash'] = [
                    'type' => 'danger',
                    'pesan' => 'Data anggota tidak ditemukan.'
                ];
            }

        } catch (PDOException $e) {
            error_log($e->getMessage());

            $_SESSION['flash'] = [
                'type' => 'danger',
                'pesan' => 'Anggota gagal dihapus. Data mungkin masih memiliki peminjaman.'
            ];
        }
    } else {
        $_SESSION['flash'] = [
            'type' => 'danger',
            'pesan' => 'ID anggota tidak valid.'
        ];
    }

    header('Location: list.php');
    exit;
}

$page_title = "Daftar Anggota";

include __DIR__ . '/../includes/header.php';

// Notifikasi
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Ambil data anggota terbaru dari PostgreSQL
$stmt = $pdo->query(
    "SELECT * FROM anggota ORDER BY id DESC"
);

$daftarAnggota = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Anggota</h2>

    <a href="tambah.php" class="btn btn-primary">
        + Tambah Anggota
    </a>
</div>

<!-- Notifikasi -->
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
            Cari Nama Anggota
        </label>

        <input type="text"
               id="search-input"
               class="form-control"
               placeholder="Ketik nama anggota...">
    </div>
</div>

<!-- Tabel Anggota -->
<div class="card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="table-primary">
                    <tr>
                        <th>No. Anggota</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($daftarAnggota)): ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada data anggota. Silakan tambah lewat menu Tambah Anggota.
                            </td>
                        </tr>
                    <?php else: ?>

                        <?php foreach ($daftarAnggota as $anggota): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($anggota['no_anggota'] ?? ''); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($anggota['nama'] ?? ''); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($anggota['alamat'] ?? ''); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($anggota['no_hp'] ?? ''); ?>
                                </td>

                                <td>
                                    <a href="edit.php?id=<?php echo (int) $anggota['id']; ?>"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="list.php"
                                          style="display: inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">

                                        <input type="hidden"
                                               name="id"
                                               value="<?php echo (int) $anggota['id']; ?>">

                                        <button type="submit"
                                                name="hapus_anggota"
                                                value="1"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
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