<?php
require_once("../../etc/config.php");
require_once("../../etc/function.php");

// Inisialisasi variabel
$id_mesin = '';
$id_cabang_gedung = '';
$keterangan = '';
$isEdit = false;
$message = '';

// Proses Tambah/Ubah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mesin = $_POST['id_mesin'] ?? '';
    $id_cabang_gedung = $_POST['id_cabang_gedung'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';

    if ($id_mesin) {
        // Proses Edit
        $query = "UPDATE mesin SET id_cabang_gedung = '$id_cabang_gedung', keterangan = '$keterangan' WHERE id_mesin = $id_mesin";
        if (mysqli_query($mysqli, $query)) {
            $message = 'Data mesin berhasil diperbarui!';
        } else {
            $message = 'Error: ' . mysqli_error($mysqli);
        }
    } else {
        // Proses Tambah
        $query = "INSERT INTO mesin (id_cabang_gedung, keterangan) VALUES ('$id_cabang_gedung', '$keterangan')";
        if (mysqli_query($mysqli, $query)) {
            $message = 'Data mesin berhasil ditambahkan!';
        } else {
            $message = 'Error: ' . mysqli_error($mysqli);
        }
    }
}

// Proses Ambil data untuk Edit
if (isset($_GET['edit'])) {
    $id_mesin = $_GET['edit'];
    $result = mysqli_query($mysqli, "SELECT * FROM mesin WHERE id_mesin = $id_mesin");
    if ($row = mysqli_fetch_assoc($result)) {
        $id_cabang_gedung = $row['id_cabang_gedung'];
        $keterangan = $row['keterangan'];
        $isEdit = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesin Absensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Mesin Absensi</h2>
        
        <!-- Tombol untuk membuka form tambah/ubah -->
        <button class="btn btn-primary mb-3" onclick="document.getElementById('form-container').style.display='block'">
            <?php echo $isEdit ? 'Ubah Mesin' : 'Tambah Mesin Baru'; ?>
        </button>

        <!-- Form untuk Tambah atau Edit Mesin -->
        <div id="form-container" class="card p-4 mb-4" style="display: <?php echo $isEdit ? 'block' : 'none'; ?>;">
            <form action="mesin_absensi.php" method="post">
                <input type="hidden" name="id_mesin" value="<?php echo $id_mesin; ?>">
                <div class="form-group">
                    <label for="id_cabang_gedung">ID Cabang Gedung:</label>
                    <input type="text" name="id_cabang_gedung" id="id_cabang_gedung" class="form-control" value="<?php echo htmlspecialchars($id_cabang_gedung); ?>" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?php echo htmlspecialchars($keterangan); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <?php echo $isEdit ? 'Simpan Perubahan' : 'Simpan'; ?>
                </button>
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('form-container').style.display='none'">Batal</button>
            </form>
        </div>

        <!-- Tabel Daftar Mesin -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Mesin</th>
                    <th>ID Cabang Gedung</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil data dari tabel mesin
                $result = mysqli_query($mysqli, "SELECT * FROM mesin");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_mesin']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_cabang_gedung']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                    echo "<td><a href='mesin_absensi.php?edit=" . $row['id_mesin'] . "' class='btn btn-warning btn-sm'>Ubah</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="notification" class="notification"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        const message = "<?php echo $message; ?>";
        if (message) {
            const notification = document.getElementById('notification');
            notification.innerText = message;
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>
