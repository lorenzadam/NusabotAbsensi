<?php
require_once("etc/config.php");
session_start();
$error = "Masukan nomor induk dan password";

if (isset($_POST['login'])) {
  $nomor_induk = $_POST['nomor_induk'];
  $password =  md5($_POST['password']);

  $sql = "SELECT nomor_induk,nama FROM pengguna WHERE nomor_induk = '$nomor_induk' and password = '$password'";
  $result = mysqli_query($mysqli, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $nomor_induk = $row['nomor_induk'];
  $nama = $row['nama'];

  $count = mysqli_num_rows($result);

  if ($count == 1) {
    $_SESSION['nomor_induk'] = $nomor_induk;
    $_SESSION['nama'] = $nama;
    $_SESSION['login'] = 1;

    header("location: index.php");
  } else {
    $error = "Nomor Induk / Password Salah";
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="https://nusabot.id/wp-content/uploads/2020/07/g1291-192x192.png" sizes="192x192"/>
  <link rel="apple-touch-icon" href="https://nusabot.id/wp-content/uploads/2020/07/g1291-180x180.png"/>
  <meta name="msapplication-TileImage" content="https://nusabot.id/wp-content/uploads/2020/07/g1291-270x270.png"/>
  <title>Absensi | Nusabot</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <img src="dist/img/logo-all.png" alt="Nusabot Logo" width="30%">
      </div>
      <div class="card-body">
        <p class="login-box-msg"><?php echo $error ?></p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="nomor_induk" placeholder="Nomor Induk" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" name="login" class="btn btn-primary btn-block">Masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
