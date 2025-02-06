<?php
$host = "localhost"; // Sesuaikan dengan konfigurasi database Anda
$user = "root";      // Username database
$pass = "";          // Password database
$dbname = "healthypartner"; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
