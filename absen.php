<?php
require_once("etc/config.php");

$nama = "";
$id = 1;
$nomor_induk = "";
$absen = date('Y-m-d H:i:s'); 
$absen_maks = date('Y-m-d H:i:s', strtotime('+8 hours')); 
$idmesin = 1; 
$pesan_absen = ""; 

if (isset($_POST['tag'])) {
    $result = mysqli_query($mysqli, "SELECT nomor_induk, nama FROM pengguna WHERE tag = '{$_POST['tag']}'");
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $nomor_induk = $user['nomor_induk'];
        $nama = $user['nama'] . " (" . $nomor_induk . ")";

        $jam_absen = date('H', strtotime($absen));
        if ($jam_absen < 9) {
            $kategori = 1; 
        } else {
            $kategori = 2; 
        }

        $query = "INSERT INTO absensi (nomor_induk, absen, absen_maks, kategori, idmesin) 
                  VALUES ('$nomor_induk', '$absen', '$absen_maks', '$kategori', '$idmesin')";

        if (mysqli_query($mysqli, $query)) {
            $pesan_absen = "ABSEN BERHASIL";
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    } else {
        $nama = "Tag tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Tag | Nusabot</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
        .pesan-absen {
            font-size: 24px;
            font-weight: bold;
            color: green;
            margin-bottom: 10px;
        }
        .nama-user {
            font-size: 18px;
        }
    </style>
</head>

<body class="hold-transition lockscreen" onload="display_ct();">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <b id="ct"></b> <?php echo $nama_zona; ?>
        </div>
        
        <!-- Pesan absen berhasil -->
        <div class="text-center pesan-absen"><?php echo $pesan_absen; ?></div>
        
        <!-- Nama pengguna -->
        <div class="lockscreen-name nama-user"><?php echo $nama; ?></div>

        <!-- Form scan tag -->
        <form method="post" action="">
            <div class="lockscreen-item">
                <div class="lockscreen-image">
                    <img src="dist/img/logo-me.png" alt="User Image">
                </div>

                <div class="lockscreen-credentials">
                    <div class="input-group">
                        <input type="password" name="tag" class="form-control" placeholder="Scan Tag Anda" required autofocus>
                        <div class="input-group-append">
                            <button type="button" class="btn">
                                <i class="fas fa-arrow-right text-muted"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/deed.id" target="_blank"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<script type="text/javascript">
    function display_c() {
        var refresh = 1000;
        mytime = setTimeout('display_ct()', refresh)
    }

    function display_ct() {
        var x = new Date();
        var weekdays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        var x1 = weekdays[x.getDay()] + ", " + (x.getMonth() + 1) + "/" + x.getDate() + "/" + x.getFullYear() + "   " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds();
        document.getElementById('ct').innerHTML = x1;
        display_c();
    }
</script>
</html>
