<?php
include 'db.php';

// Query untuk mengambil data jadwal dokter
$query = "SELECT * FROM jadwaldokter ORDER BY tanggal_ket";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/LogoHP.png" type="image/x-icon">
    <title>Healthy Partner</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="image/HP_logo.png" style="height: 50px;" alt=""></a>
        </div>
    </nav>

    <!-- Hero  -->
    <section class="hero-section">
        <div class="container">
            <h1>"It is health that is real wealth and not pieces of gold and silver."</h1>
            <p>- Mahatma Gandhi -</p>
            <p style="padding: 30px;">Selamat datang di rumah sakit Healthy Partner. Komitmen kami adalah memberikan layanan kesehatan terbaik untuk Anda dan keluarga. Bersama tenaga medis profesional dan fasilitas modern, kami siap membantu menjaga kesehatan Anda.</p>
        </div>
    </section>

    <!-- Jadwal Dokter -->
    <section class="doctor-schedule-section">
        <div class="container mt-5">
            <h2 class="text-center mb-4">Jadwal Dokter</h2>
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Dokter</th>
                        <th scope="col">Fasilitas Kesehatan</th>
                        <th scope="col">Tanggal Ketersediaan</th>
                        <th scope="col">Pesan Antrian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <th scope='row'>{$no}</th>
                                <td>{$row['nama_dokter']}</td>
                                <td>{$row['jenis_pengobatan']}</td>
                                <td>{$row['tanggal_ket']}</td>
                                <td>
                                    <a href='booking.php?id={$row['id']}' class='btn btn-success'>Booking Jadwal</a>
                                </td>

                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Tidak ada data jadwal dokter.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>Copyright &copy; 2024 Healthy Partner. All Rights Reserved.<br>Made with ❤️ by Kelompok 3 Kelas 3KA33</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
