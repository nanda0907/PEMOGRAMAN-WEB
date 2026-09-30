<?php
$host     = "ep-falling-violet-b4jw076m-pooler.c-6.us-east-2.aws.neon.tech";
$port     = "5432";
$dbname   = "neondb";
$user     = "neondb_owner";
$password = "npg_gr3XPBodOKv8";
$sslmode  = "require";

$conn = pg_connect(
    "host=$host port=$port dbname=$dbname user=$user password=$password sslmode=$sslmode"
);

if (!$conn) {
    die("Koneksi database gagal. Periksa host, username, password, dan sslmode.");
}

echo "Koneksi database berhasil!";
?>