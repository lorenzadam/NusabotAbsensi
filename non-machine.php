<?php
require_once("etc/config.php");
$id = 1;
if (isset($_POST['tag'])) {
    //ambil waktu UTC, letakan di awal agar mengurangi jeda waktu antara data terkirim dan data diproses
    $waktu = gmdate("Y-m-d H:i:s");

    //Variabel basis data
    $databaseHost = 'localhost';
    $databaseName = 'absensi';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

    // $idmesin = $_GET['idmesin'];
    $tag = $_POST['tag'];
    $nomor_induk = getNomorInduk($mysqli, $tag);
    $kategori = $_POST['kategori'];

    //ambil jam absen maksimal
    if ($kategori == 1) {
        $jam_maksimal = getAbsenMaks($mysqli, "jam_masuk", getCabangGedung($mysqli, $tag));
    } else if ($kategori == 2) {
        $jam_maksimal = getAbsenMaks($mysqli, "istirahat_mulai", getCabangGedung($mysqli, $tag));
    } else if ($kategori == 3) {
        $jam_maksimal = getAbsenMaks($mysqli, "istirahat_selesai", getCabangGedung($mysqli, $tag));
    } else if ($kategori == 4) {
        $jam_maksimal = getAbsenMaks($mysqli, "jam_pulang", getCabangGedung($mysqli, $tag));
    }

    $maksimal = gmdate("Y-m-d $jam_maksimal");

    // Statement SQL
    $sql = "INSERT INTO absensi (nomor_induk, absen, absen_maks, kategori)
    VALUES ('$nomor_induk','$waktu', '$maksimal', '$kategori')";

    $result = mysqli_query($mysqli, $sql);

    if (!$result) {
        die('Query salah: ' . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absen</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition lockscreen" onload="display_ct();">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <b id="ct"></b> <?php echo $nama_zona ?>
        </div>
        <!-- User name -->
        <div class="lockscreen-name"><?php echo $nama ?></div>

        <!-- START LOCK SCREEN ITEM -->
        <form method="post" action="">
            <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                    <img src="dist/img/logo-me.png" alt="User Image">
                </div>
                <!-- /.lockscreen-image -->

                <!-- lockscreen credentials (contains the form) -->

                <div class="lockscreen-credentials">
                    <div class="input-group">
                        <input type="password" name="tag" class="form-control" placeholder="Scan" required autofocus>
                        <select class="form-control" name="kategori">
                            <option value="1">Masuk</option>
                            <option value="2">Mulai Istirahat</option>
                            <option value="3">Selesai Istirahat</option>
                            <option value="4">Pulang</option>
                        </select>

                        <div class="input-group-append">
                            <button type="button" class="btn">
                                <i class="fas fa-arrow-right text-muted"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- /.lockscreen credentials -->

            </div>
            <div class="text-center">
                <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/deed.id" target="_blank"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>
            </div>
        </form>
    </div>
    <!-- /.center -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<script type="text/javascript">
    function display_c() {
        var refresh = 1000; // Refresh rate in milli seconds
        mytime = setTimeout('display_ct()', refresh)
    }

    function display_ct() {
        var x = new Date();
        var weekdays = new Array(7);
        weekdays[0] = "Minggu";
        weekdays[1] = "Senin";
        weekdays[2] = "Selasa";
        weekdays[3] = "Rabu";
        weekdays[4] = "Kamis";
        weekdays[5] = "Jumat";
        weekdays[6] = "Sabtu";

        var x1 = x.getMonth() + 1 + "/" + x.getDate() + "/" + x.getFullYear();
        x1 = weekdays[x.getDay()] + ", " + x1 + "   " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds();
        document.getElementById('ct').innerHTML = x1;
        display_c();
    }
</script>

</html>


<?php
//ambil nomor induk berdasarkan tag
function getNomorInduk($mysqli, $tag)
{
    $sql = "SELECT nomor_induk FROM pengguna WHERE tag = '$tag'";
    $result = mysqli_fetch_row(mysqli_query($mysqli, $sql));
    return $result['0'];
}

function getCabangGedung($mysqli, $tag)
{
    $sql = "SELECT cabang_gedung FROM pengguna WHERE tag = '$tag'";
    $result = mysqli_fetch_row(mysqli_query($mysqli, $sql));
    return $result['0'];
}

function getAbsenMaks($mysqli, $absen, $id)
{
    $sql = "SELECT $absen FROM cabang_gedung WHERE id = '$id'";
    $result = mysqli_fetch_row(mysqli_query($mysqli, $sql));
    return $result['0'];
}

?>