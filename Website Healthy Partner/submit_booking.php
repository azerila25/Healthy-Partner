<?php
include 'db.php'; // Menghubungkan ke database

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_ktp = $conn->real_escape_string($_POST['nomor_ktp']);
    $nama_pasien = $conn->real_escape_string($_POST['nama_pasien']);
    $id_jadwal = (int)$_POST['id_jadwal'];

    // Ambil data jadwal dokter berdasarkan id_jadwal
    $query = "SELECT nama_dokter, jenis_pengobatan, tanggal_ket FROM jadwaldokter WHERE id = $id_jadwal";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $jadwal = $result->fetch_assoc();
        $nama_dokter = $jadwal['nama_dokter'];
        $jenis_pengobatan = $jadwal['jenis_pengobatan'];
        $tanggal_ket = $jadwal['tanggal_ket'];

        // Masukkan data ke tabel booking (asumsikan tabel bernama 'booking')
        $insert_query = "INSERT INTO booking (nomor_ktp, nama_pasien, nama_dokter, jenis_pengobatan, tanggal_ket) VALUES ('$nomor_ktp', '$nama_pasien', '$nama_dokter', '$jenis_pengobatan', '$tanggal_ket')";

        if ($conn->query($insert_query)) {
            echo "<script>alert('Booking berhasil!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Gagal melakukan booking. Silakan coba lagi.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Jadwal tidak ditemukan. Silakan coba lagi.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.location.href = 'index.php';</script>";
}

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $nomor_ktp = $conn->real_escape_string($_POST['nomor_ktp']);
    $nama_pasien = $conn->real_escape_string($_POST['nama_pasien']);
    $nama_dokter = $conn->real_escape_string($_POST['nama_dokter']);
    $jenis_pengobatan = $conn->real_escape_string($_POST['jenis_pengobatan']);
    $tanggal_ket = $conn->real_escape_string($_POST['tanggal_ket']);
    $id_jadwal = (int)$_POST['id_jadwal'];

    // Query untuk menyimpan data ke tabel booking
    $insert_query = "
        INSERT INTO booking (nomor_ktp, nama_pasien, nama_dokter, jenis_pengobatan, tanggal_ket) 
        VALUES ('$nomor_ktp', '$nama_pasien', '$nama_dokter', '$jenis_pengobatan', '$tanggal_ket')
    ";

    // Eksekusi query
    if ($conn->query($insert_query)) {
        echo "<script>alert('Booking berhasil!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan booking: " . $conn->error . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.location.href = 'index.php';</script>";
}
?>