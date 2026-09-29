<?php
include "../includes/header.php";
?>

<h2>Tambah Rutinitas Skincare</h2>

<form action="proses_tambah.php" method="POST">

    <label>Nama Produk</label>
    <input type="text" name="produk" required>

    <label>Kategori</label>
    <select name="kategori" required>
        <option value="">Pilih Kategori</option>
        <option value="Cleanser">Cleanser</option>
        <option value="Toner">Toner</option>
        <option value="Serum">Serum</option>
        <option value="Moisturizer">Moisturizer</option>
        <option value="Sunscreen">Sunscreen</option>
        <option value="Lainnya">Lainnya</option>
    </select>

    <label>Waktu Pemakaian</label>
    <select name="waktu" required>
        <option value="">Pilih Waktu</option>
        <option value="Pagi">Pagi</option>
        <option value="Malam">Malam</option>
    </select>

    <label>Urutan Pemakaian</label>
    <input type="number" name="urutan" min="1" required>

    <label>Catatan</label>
    <textarea name="catatan"></textarea>

    <br><br>

    <button type="submit">Simpan</button>
    <a href="daftar.php">Batal</a>

</form>

<?php include "../includes/footer.php"; ?>