<?php
require_once("../../etc/config.php");
require_once("../../etc/function.php");

$id_mesin = '';
$id_cabang_gedung = '';
$keterangan = '';
$isEdit = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mesin = $_POST['id_mesin'] ?? '';
    $id_cabang_gedung = $_POST['id_cabang_gedung'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';

    if ($id_mesin) {
        $query = "UPDATE mesin SET id_cabang_gedung = '$id_cabang_gedung', keterangan = '$keterangan' WHERE id_mesin = $id_mesin";
        if (mysqli_query($mysqli, $query)) {
            echo "<script>alert('Data mesin berhasil diperbarui!'); window.location.href='mesin_absensi.php';</script>";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    } else {
        $query = "INSERT INTO mesin (id_cabang_gedung, keterangan) VALUES ('$id_cabang_gedung', '$keterangan')";
        if (mysqli_query($mysqli, $query)) {
            echo "<script>alert('Data mesin berhasil ditambahkan!'); window.location.href='mesin_absensi.php';</script>";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    }
}

if (isset($_GET['edit'])) {
    $id_mesin = $_GET['edit'];
    $result = mysqli_query($mysqli, "SELECT * FROM mesin WHERE id_mesin = $id_mesin");
    if ($row = mysqli_fetch_assoc($result)) {
        $id_cabang_gedung = $row['id_cabang_gedung'];
        $keterangan = $row['keterangan'];
        $isEdit = true;
    }
}

$queryCabang = "SELECT id, lokasi FROM cabang_gedung";
$resultCabang = mysqli_query($mysqli, $queryCabang);

// Query untuk tabel mesin dengan nama cabang
$result = mysqli_query($mysqli, "
    SELECT 
        mesin.id_mesin, 
        cabang_gedung.lokasi AS nama_cabang, 
        mesin.keterangan 
    FROM 
        mesin 
    INNER JOIN 
        cabang_gedung 
    ON 
        mesin.id_cabang_gedung = cabang_gedung.id
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesin Absensi</title>
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Mesin</h3>
                        </div>
                        <div class="card-body">
                            <table id="tabel-mesin" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Mesin</th>
                                        <th>Nama Cabang</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['id_mesin']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nama_cabang']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                                        echo "<td>
                                                <a href='mesin_absensi.php?edit=" . $row['id_mesin'] . "' class='btn btn-primary btn-sm'>
                                                    <i class='fas fa-edit'></i> Ubah
                                                </a>
                                              </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card card-primary mt-4">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $isEdit ? 'Ubah Mesin' : 'Tambah Mesin Baru'; ?></h3>
                        </div>
                        <form action="mesin_absensi.php" method="post">
                            <input type="hidden" name="id_mesin" value="<?php echo $id_mesin; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id_cabang_gedung">Cabang Gedung</label>
                                    <select name="id_cabang_gedung" id="id_cabang_gedung" class="form-control" required>
                                        <option value="" disabled selected>Pilih Cabang Gedung</option>
                                        <?php
                                        while ($cabang = mysqli_fetch_assoc($resultCabang)) {
                                            $selected = $cabang['id'] == $id_cabang_gedung ? 'selected' : '';
                                            echo "<option value='{$cabang['id']}' $selected>{$cabang['lokasi']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control"
                                        value="<?php echo htmlspecialchars($keterangan); ?>" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo $isEdit ? 'Simpan Perubahan' : 'Simpan'; ?>
                                </button>
                                <a href="mesin_absensi.php" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>

    <script>
        $(function () {
            $("#tabel-mesin").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                buttons: [
                    "copy", "csv", "excel", "pdf", "print", "colvis"
                ]
            }).buttons().container().appendTo('#tabel-mesin_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>
