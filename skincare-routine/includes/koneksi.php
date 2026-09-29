<?php
$host = "localhost";
$port = "5432";
$dbname = "db_skincare";
$user = "postgres";
$password = "12345678";

$conn = pg_connect(
    "host=$host port=$port dbname=$dbname user=$user password=$password"
);

if (!$conn) {
    die("Koneksi database gagal. Cek PostgreSQL, nama database, username, dan password.");
}
?>