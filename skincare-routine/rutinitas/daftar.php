<?php
require_once "../includes/koneksi.php";

$query = pg_query(
    $conn,
    "SELECT * FROM rutinitas ORDER BY waktu, urutan, id"
);

include "../includes/header.php";
?>

<h2>Daftar Rutinitas Skincare</h2>

<a href="tambah.php" class="btn">+ Tambah Produk</a>

<br><br>

<table>
    <tr>
        <th>No</th>
        <th>Produk</th>
        <th>Kategori</th>
        <th>Waktu</th>
        <th>Urutan</th>
        <th>Catatan</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;

    while ($row = pg_fetch_assoc($query)):
    ?>

    <tr>
        <td><?= $no++ ?></td>

        <td><?= htmlspecialchars($row['produk']) ?></td>

        <td><?= htmlspecialchars($row['kategori']) ?></td>

        <td><?= htmlspecialchars($row['waktu']) ?></td>

        <td><?= (int)$row['urutan'] ?></td>

        <td><?= htmlspecialchars($row['catatan'] ?? '') ?></td>

        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>

            |

            <a href="hapus.php?id=<?= $row['id'] ?>"
               onclick="return confirm('Yakin ingin menghapus data ini?')">
               Hapus
            </a>
        </td>
    </tr>

    <?php endwhile; ?>

</table>

<?php include "../includes/footer.php"; ?>