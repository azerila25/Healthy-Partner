<?php
include 'db.php';

// logika Create, Update, Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create or Update
    if (isset($_POST['save'])) {
        $id_booking = $_POST['id_booking'];
        $nomor_ktp = $_POST['nomor_ktp'];
        $nama_pasien = $_POST['nama_pasien'];
        $nama_dokter = $_POST['nama_dokter'];
        $jenis_pengobatan = $_POST['jenis_pengobatan'];
        $tanggal_ket = $_POST['tanggal_ket'];

        if ($id_booking) {
            // Update
            $query = "UPDATE booking SET nomor_ktp='$nomor_ktp', nama_pasien='$nama_pasien', nama_dokter='$nama_dokter', jenis_pengobatan='$jenis_pengobatan', tanggal_ket='$tanggal_ket' WHERE id_booking=$id_booking";
        } else {
            // Insert
            $query = "INSERT INTO booking (nomor_ktp, nama_pasien, nama_dokter, jenis_pengobatan, tanggal_ket) VALUES ('$nomor_ktp', '$nama_pasien', '$nama_dokter', '$jenis_pengobatan', '$tanggal_ket')";
        }
        $conn->query($query);
    } elseif (isset($_POST['delete'])) {
        // Delete
        $id_booking = $_POST['id_booking'];
        $query = "DELETE FROM booking WHERE id_booking=$id_booking";
        $conn->query($query);
    }
}

$query = "SELECT * FROM booking ORDER BY tanggal_ket";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pasien - Data Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="image/LogoHP.png" type="image/x-icon">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Manage Pasien Booking</h2>
        <form method="POST" class="mb-4">
            <input type="hidden" name="id_booking" id="id_booking">
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
                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" required>
            </div>
            <div class="mb-3">
                <label for="jenis_pengobatan" class="form-label">Jenis Pengobatan</label>
                <input type="text" class="form-control" id="jenis_pengobatan" name="jenis_pengobatan" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_ket" class="form-label">Tanggal Praktek</label>
                <input type="date" class="form-control" id="tanggal_ket" name="tanggal_ket" required>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nomor KTP</th>
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>Jenis Pengobatan</th>
                    <th>Tanggal Praktek</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nomor_ktp']}</td>
                            <td>{$row['nama_pasien']}</td>
                            <td>{$row['nama_dokter']}</td>
                            <td>{$row['jenis_pengobatan']}</td>
                            <td>{$row['tanggal_ket']}</td>
                            <td>
                                <button class='btn btn-warning' onclick='edit({$row['id_booking']}, \"{$row['nomor_ktp']}\", \"{$row['nama_pasien']}\", \"{$row['nama_dokter']}\", \"{$row['jenis_pengobatan']}\", \"{$row['tanggal_ket']}\")'>Edit</button>
                                <form method='POST' class='d-inline'>
                                    <input type='hidden' name='id_booking' value='{$row['id_booking']}'>
                                    <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Tidak ada data.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <td>
            <a href='admin.php' class='btn btn-success'>Halaman Jadwal Dokter</a>
        </td>
    </div>

    <script>
        function edit(id_booking, nomor_ktp, nama_pasien, nama_dokter, jenis_pengobatan, tanggal_ket) {
            document.getElementById('id_booking').value = id_booking;
            document.getElementById('nomor_ktp').value = nomor_ktp;
            document.getElementById('nama_pasien').value = nama_pasien;
            document.getElementById('nama_dokter').value = nama_dokter;
            document.getElementById('jenis_pengobatan').value = jenis_pengobatan;
            document.getElementById('tanggal_ket').value = tanggal_ket;
        }
    </script>
</body>
</html>
