<?php
include 'db.php';

// Logika Create, Update, Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create or Update
    if (isset($_POST['save'])) {
        $id = $_POST['id'];
        $nama_dokter = $_POST['nama_dokter'];
        $jenis_pengobatan = $_POST['jenis_pengobatan'];
        $tanggal_ket = $_POST['tanggal_ket'];

        if ($id) {
            // Update
            $query = "UPDATE jadwaldokter SET nama_dokter='$nama_dokter', jenis_pengobatan='$jenis_pengobatan', tanggal_ket='$tanggal_ket' WHERE id=$id";
        } else {
            // Insert
            $query = "INSERT INTO jadwaldokter (nama_dokter, jenis_pengobatan, tanggal_ket) VALUES ('$nama_dokter', '$jenis_pengobatan', '$tanggal_ket')";
        }
        $conn->query($query);
    } elseif (isset($_POST['delete'])) {
        // Delete
        $id = $_POST['id'];
        $query = "DELETE FROM jadwaldokter WHERE id=$id";
        $conn->query($query);
    }
}

$query = "SELECT * FROM jadwaldokter ORDER BY tanggal_ket";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jadwal Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="image/LogoHP.png" type="image/x-icon">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Manage Jadwal Dokter Healthy Partner</h2>
        <form method="POST" class="mb-4">
            <input type="hidden" name="id" id="id">
            <div class="mb-3">
                <label for="nama_dokter" class="form-label">Nama Dokter</label>
                <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" required>
            </div>
            <div class="mb-3">
                <label for="jenis_pengobatan" class="form-label">Fasilitas Kesehatan</label>
                <input type="text" class="form-control" id="jenis_pengobatan" name="jenis_pengobatan" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_ket" class="form-label">Tanggal Ketersediaan</label>
                <input type="date" class="form-control" id="tanggal_ket" name="tanggal_ket" required>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Dokter</th>
                    <th>Fasilitas Kesehatan</th>
                    <th>Tanggal Ketersediaan</th>
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
                            <td>{$row['nama_dokter']}</td>
                            <td>{$row['jenis_pengobatan']}</td>
                            <td>{$row['tanggal_ket']}</td>
                            <td>
                                <button class='btn btn-warning' onclick='edit({$row['id']}, \"{$row['nama_dokter']}\", \"{$row['jenis_pengobatan']}\", \"{$row['tanggal_ket']}\")'>Edit</button>
                                <form method='POST' class='d-inline'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <td>
            <a href='admin2.php' class='btn btn-success'>Halaman Booking Pasien</a>
        </td>
    </div>


    <script>
        function edit(id, nama_dokter, jenis_pengobatan, tanggal_ket) {
            document.getElementById('id').value = id;
            document.getElementById('nama_dokter').value = nama_dokter;
            document.getElementById('jenis_pengobatan').value = jenis_pengobatan;
            document.getElementById('tanggal_ket').value = tanggal_ket;
        }
    </script>
</body>
</html>
