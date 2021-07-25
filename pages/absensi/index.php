<?php
require_once("../../etc/config.php");
require_once("../../etc/function.php");

$result = mysqli_query($mysqli, "SELECT * FROM absensi");
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
              <h1>Laporan Absensi</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
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
                        <th>Absen</th>
                        <th>Nama</th>
                        <th>Nomor Induk</th>
                        <th>Cabang / Gedung</th>
                        <th>Kategori</th>
                        <th>ID Mesin</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($data = mysqli_fetch_array($result)) {
                        if ($data['kategori'] == 1) {
                          $kategori = "Masuk";
                        } elseif ($data['kategori'] == 2) {
                          $kategori = "Mulai Istirahat";
                        } elseif ($data['kategori'] == 3) {
                          $kategori = "Selesai Istirahat";
                        } elseif ($data['kategori'] == 4) {
                          $kategori = "Pulang";
                        }

                        //menghindari program error karena tag tidak terdaftar
                        if ($data['nomor_induk'] == "") {
                          continue;
                        }

                        $cabang = getAnyTampil($mysqli, "lokasi", "cabang_gedung", "id", getAnyTampil($mysqli,"cabang_gedung","pengguna","nomor_induk",$data['nomor_induk']));
                        $zona = getAnyTampil($mysqli, "zona_waktu", "cabang_gedung", "id", getAnyTampil($mysqli,"cabang_gedung","pengguna","nomor_induk",$data['nomor_induk']));

                        if($zona == 1){
                          $seconds = "+25200 seconds";
                        } else if($zona == 2){
                          $seconds = "+28800 seconds";
                        } else {
                          $seconds = "+32400 seconds";
                        }

                        $startTime = date($data['absen']);
                      ?>
                        <tr>
                          <td><?php echo date('Y-m-d H:i:s',strtotime($seconds,strtotime($startTime))) ?></td>
                          <td><?php echo getAnyTampil($mysqli, 'nama', 'pengguna', 'nomor_induk', $data['nomor_induk']) ?></td>
                          <td><?php echo $data['nomor_induk'] ?></td>
                          <td><?php echo $cabang ?></td>
                          <td><?php echo $kategori ?></td>
                          <td><?php echo $data['idmesin'] ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Absen</th>
                        <th>Nama</th>
                        <th>Nomor Induk</th>
                        <th>Cabang / Gedung</th>
                        <th>Kategori</th>
                        <th>ID Mesin</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
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