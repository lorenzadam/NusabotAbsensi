<?php
require_once("../../etc/config.php");
require_once("../../etc/function.php");

if (isset($_POST['tambah'])) {
  $hari_kerja = $_POST['hari_kerja'];
  $pilihan_kerja = "";
  for ($i = 0; $i < count($hari_kerja); $i++) {
    if ($i == count($hari_kerja) - 1) {
      $pilihan_kerja = $pilihan_kerja . $hari_kerja[$i];
    } else {
      $pilihan_kerja = $pilihan_kerja . $hari_kerja[$i] . ",";
    }
  }
  $result = mysqli_query($mysqli, "INSERT INTO cabang_gedung(lokasi,jam_masuk,jam_pulang,istirahat_mulai,istirahat_selesai,hari_kerja) VALUES('{$_POST['lokasi']}','{$_POST['jam_masuk']}','{$_POST['jam_pulang']}','{$_POST['istirahat_mulai']}','{$_POST['istirahat_selesai']}','$pilihan_kerja')");
  $successAdd = 1;
}

if (isset($_POST['ubah'])) {
  $hari_kerja = $_POST['hari_kerja'];
  $pilihan_kerja = "";
  for ($i = 0; $i < count($hari_kerja); $i++) {
    if ($i == count($hari_kerja) - 1) {
      $pilihan_kerja = $pilihan_kerja . $hari_kerja[$i];
    } else {
      $pilihan_kerja = $pilihan_kerja . $hari_kerja[$i] . ",";
    }
  }

  $result = mysqli_query($mysqli, "UPDATE cabang_gedung SET lokasi='{$_POST['lokasi']}',jam_masuk='{$_POST['jam_masuk']}',jam_pulang='{$_POST['jam_pulang']}',istirahat_mulai='{$_POST['istirahat_mulai']}',istirahat_selesai='{$_POST['istirahat_selesai']}',hari_kerja='$pilihan_kerja' WHERE id='{$_POST['id']}'");
  $successEdit = 1;
}

if (isset($_GET['id'])) {
  $nama = getAnyTampil($mysqli, 'lokasi', 'cabang_gedung', 'id', $_GET['id']);
  $aktif = getAnyTampil($mysqli, 'aktif', 'cabang_gedung', 'id', $_GET['id']);
  if ($aktif == 1) {
    $aktif = 0;
    $aktifText = "non-aktif";
  } else {
    $aktif = 1;
    $aktifText = "aktif";
  }
  $result = mysqli_query($mysqli, "UPDATE cabang_gedung SET aktif='$aktif' WHERE id='{$_GET['id']}'");
  $successDelete = 1;
}

$result = mysqli_query($mysqli, "SELECT * FROM cabang_gedung");
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Cabang / Gedung</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
        <?php if ($successAdd == 1) { ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
            <b><?php echo $_POST['lokasi'] ?></b> sudah ditambahkan.
          </div>
        <?php } else if ($successEdit == 1) { ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
            <b><?php echo $_POST['lokasi_lama'] ?></b> sudah berhasil diubah.
          </div>
        <?php } else if ($successDelete == 1) { ?>
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation"></i> Berhasil!</h5>
            Status <b><?php echo $nama ?></b> menjadi <b><?php echo $aktifText ?></b>.
          </div>
        <?php } ?>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Lokasi</th>
                        <th>Masuk</th>
                        <th>Pulang</th>
                        <th>Mulai Istirahat</th>
                        <th>Selesai Istirahat</th>
                        <th>Hari Kerja</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($data = mysqli_fetch_array($result)) {
                        if ($data['aktif'] == 1) {
                          $aktif = "Aktif";
                        } else {
                          $aktif = "Non-aktif";
                        }

                        if ($data['id'] == 1) {
                          continue;
                        }
                      ?>
                        <tr>
                          <td><?php echo $data['lokasi'] ?></td>
                          <td><?php echo $data['jam_masuk'] ?></td>
                          <td><?php echo $data['jam_pulang'] ?></td>
                          <td><?php echo $data['istirahat_mulai'] ?></td>
                          <td><?php echo $data['istirahat_selesai'] ?></td>
                          <td><?php echo $data['hari_kerja'] ?></td>
                          <td><?php echo $aktif ?></td>
                          <td><a href="edit.php?id=<?= $data['id'] ?>"><i class="fas fa-edit"></i></a> | <a href="index.php?id=<?= $data['id'] ?>"><i class="fas fa-minus-circle"></i></a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Lokasi</th>
                        <th>Masuk</th>
                        <th>Pulang</th>
                        <th>Mulai Istirahat</th>
                        <th>Selesai Istirahat</th>
                        <th>Hari Kerja</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Data Baru</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="index.php">
                  <div class="card-body">
                    <div class="form-group">
                      <label>Lokasi</label>
                      <input type="text" name="lokasi" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Jam Masuk</label>
                      <input type="time" name="jam_masuk" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Jam Pulang</label>
                      <input type="time" name="jam_pulang" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Mulai Istirahat</label>
                      <input type="time" name="istirahat_mulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Selesai Istirahat</label>
                      <input type="time" name="istirahat_selesai" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label>Hari Kerja</label>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="senin" value="1" name="hari_kerja[]">
                        <label for="senin" class="custom-control-label">Senin</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="selasa" value="2" name="hari_kerja[]">
                        <label for="selasa" class="custom-control-label">Selasa</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="rabu" value="3" name="hari_kerja[]">
                        <label for="rabu" class="custom-control-label">Rabu</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="kamis" value="4" name="hari_kerja[]">
                        <label for="kamis" class="custom-control-label">Kamis</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="jumat" value="5" name="hari_kerja[]">
                        <label for="jumat" class="custom-control-label">Jumat</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="sabtu" value="6" name="hari_kerja[]">
                        <label for="sabtu" class="custom-control-label">Sabtu</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="minggu" value="7" name="hari_kerja[]">
                        <label for="minggu" class="custom-control-label">Minggu</label>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    })
  </script>
</body>

</html>