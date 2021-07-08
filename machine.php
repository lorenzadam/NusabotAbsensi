<?php
if (isset($_GET['tag'])) {
    //ambil waktu UTC, letakan di awal agar mengurangi jeda waktu antara data terkirim dan data diproses
    $waktu = gmdate("Y-m-d H:i:s");

    //Variabel basis data
    $databaseHost = 'localhost';
    $databaseName = 'absensi';
    $databaseUsername = 'root';
    $databasePassword = '';

    $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

    $idmesin = $_GET['idmesin'];
    $tag = $_GET['tag'];
    $nomor_induk = getNomorInduk($mysqli, $tag);

    // Statement SQL
    $sql = "INSERT INTO absensi (nomor_induk, absen, idmesin)
    VALUES ('$nomor_induk','$waktu', '$idmesin')";

    $result = mysqli_query($mysqli, $sql);

    if (!$result) {
        die('Query salah: ' . mysqli_error($conn));
    }
}

//ambil nomor induk berdasarkan tag
function getNomorInduk($mysqli, $tag)
{
    $sql = "SELECT nomor_induk FROM pengguna WHERE tag = '$tag'";
    $result = mysqli_fetch_row(mysqli_query($mysqli, $sql));
    return $result['0'];
}
