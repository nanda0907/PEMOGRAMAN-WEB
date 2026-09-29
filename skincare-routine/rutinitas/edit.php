<?php
require_once "../includes/koneksi.php";

$id = (int)$_GET['id'];

$query = pg_query_params(
    $conn,
    "SELECT * FROM rutinitas WHERE id = $1",
    [$id]
);

$data = pg_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan.");
}

include "../includes/header.php";
?>

<h2>Edit Rutinitas</h2>

<form action="proses_edit.php" method="POST">

    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    <label>Nama Produk</label>
    <input type="text" name="produk"
           value="<?= htmlspecialchars($data['produk']) ?>" required>

    <label>Kategori</label>
    <select name="kategori" required>
        <?php
        $kategoriList = [
            "Cleanser", "Toner", "Serum",
            "Moisturizer", "Sunscreen", "Lainnya"
        ];

        foreach ($kategoriList as $kategori):
        ?>
            <option value="<?= $kategori ?>"
                <?= $data['kategori'] == $kategori ? 'selected' : '' ?>>
                <?= $kategori ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Waktu</label>
    <select name="waktu" required>
        <option value="Pagi"
            <?= $data['waktu'] == 'Pagi' ? 'selected' : '' ?>>
            Pagi
        </option>

        <option value="Malam"
            <?= $data['waktu'] == 'Malam' ? 'selected' : '' ?>>
            Malam
        </option>
    </select>

    <label>Urutan Pemakaian</label>
    <input type="number" name="urutan"
           value="<?= $data['urutan'] ?>" min="1" required>

    <label>Catatan</label>
    <textarea name="catatan"><?= htmlspecialchars($data['catatan'] ?? '') ?></textarea>

    <br><br>

    <button type="submit">Update</button>
    <a href="daftar.php">Batal</a>

</form>

<?php include "../includes/footer.php"; ?>