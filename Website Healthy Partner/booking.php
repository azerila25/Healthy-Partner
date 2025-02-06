<?php
// Menghubungkan ke database
include 'db.php'; 

// Ambil ID jadwal dokter dari parameter URL
$id_jadwal = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data jadwal dokter berdasarkan ID
$query = "SELECT * FROM jadwaldokter WHERE id = $id_jadwal";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $jadwal = $result->fetch_assoc();
} else {
    echo "<script>alert('Jadwal tidak ditemukan.'); window.location.href = 'index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Booking Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="image/LogoHP.png" type="image/x-icon">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Formulir Booking Dokter</h2>
        <form action="submit_booking.php" method="POST">
            <div class="mb-3">
                <label for="nomor_ktp" class="form-label">Nomor KTP</label>
                <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" required>
            </div>
            <div class="mb-3">
                <label for="nama_pasien" class="form-label">Nama Pasien</label>
                <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" required>
            </div>
            <div class="mb-3">
                <label for="nama_dokter" class="form-label">Nama Dokter</label>
                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" value="<?= $jadwal['nama_dokter']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="jenis_pengobatan" class="form-label">Fasilitas Kesehatan</label>
                <input type="text" class="form-control" id="jenis_pengobatan" name="jenis_pengobatan" value="<?= $jadwal['jenis_pengobatan']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="tanggal_ket" class="form-label">Tanggal Praktek</label>
                <input type="text" class="form-control" id="tanggal_ket" name="tanggal_ket" value="<?= $jadwal['tanggal_ket']; ?>" readonly>
            </div>
            <input type="hidden" name="id_jadwal" value="<?= $jadwal['id']; ?>">
            <button type="submit" class="btn btn-primary">Booking</button>
        </form>
    </div>
</body>
</html>
