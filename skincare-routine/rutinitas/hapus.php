<?php
session_start();
require_once "../includes/koneksi.php";

$id = (int)$_GET['id'];

$query = pg_query_params(
    $conn,
    "DELETE FROM rutinitas WHERE id = $1",
    [$id]
);

if ($query) {
    $_SESSION['success'] = "Data berhasil dihapus!";
} else {
    $_SESSION['error'] = "Data gagal dihapus!";
}

header("Location: daftar.php");
exit;
?>