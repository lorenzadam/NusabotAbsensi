<?php
require_once("../../etc/config.php");  
require_once("../../etc/function.php"); 

$cabangGedungList = [];
$lokasiCabang = "Semua Cabang";
$result = mysqli_query($mysqli, "
    SELECT DISTINCT pengguna.cabang_gedung AS id, cabang_gedung.lokasi 
    FROM pengguna
    JOIN cabang_gedung ON pengguna.cabang_gedung = cabang_gedung.id
");

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cabangGedungList[] = $row;
    }
}

$tepatWaktu = array_fill(0, 12, 0);
$terlambat = array_fill(0, 12, 0);

$cabangGedungId = isset($_GET['cabangGedung']) ? (int)$_GET['cabangGedung'] : null;

if ($cabangGedungId) {
    $result = mysqli_query($mysqli, "
        SELECT MONTH(absensi.absen) AS bulan,
               SUM(CASE WHEN absensi.kategori = '1' THEN 1 ELSE 0 END) AS tepat_waktu,
               SUM(CASE WHEN absensi.kategori = '2' THEN 1 ELSE 0 END) AS terlambat
        FROM absensi
        JOIN pengguna ON absensi.nomor_induk = pengguna.nomor_induk
        WHERE pengguna.cabang_gedung = $cabangGedungId
        GROUP BY MONTH(absensi.absen)
    ");

    $lokasiResult = mysqli_query($mysqli, "
        SELECT lokasi 
        FROM cabang_gedung 
        WHERE id = $cabangGedungId 
        LIMIT 1
    ");
    if ($lokasiResult) {
        $lokasiRow = mysqli_fetch_assoc($lokasiResult);
        $lokasiCabang = $lokasiRow['lokasi'];
    }

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bulanIndex = (int)$row['bulan'] - 1;
            $tepatWaktu[$bulanIndex] = (int)$row['tepat_waktu'];
            $terlambat[$bulanIndex] = (int)$row['terlambat'];
        }
    }
}
?>

<style>
  .form-container {
    width: 80%;
    margin: auto;
    padding-top: 20px;
    text-align: center;
    font-family: Arial, sans-serif;
  }

  .form-container label {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-right: 10px;
  }

  .form-container select {
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ddd;
    border-radius: 5px;
    outline: none;
    cursor: pointer;
    background-color: #f9f9f9;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  .form-container select:hover,
  .form-container select:focus {
    border-color: #5c90d2;
    box-shadow: 0 0 5px rgba(92, 144, 210, 0.5);
  }
</style>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Attendance and Leave Charts</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

  <!-- Form Pilihan Cabang/Gedung -->
<div class="form-container">
  <form method="GET" action="">
    <label for="cabangGedung">Pilih Cabang/Gedung:</label>
    <select name="cabangGedung" id="cabangGedung" onchange="this.form.submit()">
      <option value="">-- Semua Cabang --</option>
      <?php foreach ($cabangGedungList as $cabang): ?>
        <option value="<?php echo $cabang['id']; ?>" <?php echo ($cabangGedungId == $cabang['id']) ? 'selected' : ''; ?>>
          <?php echo $cabang['lokasi']; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </form>
</div>


  <div style="width: 80%; margin: auto; padding-top: 50px;">
    <canvas id="attendanceChart"></canvas>
  </div>
  
  <script>
    const tepatWaktu = <?php echo json_encode($tepatWaktu); ?>;
    const terlambat = <?php echo json_encode($terlambat); ?>;
    const lokasiCabang = "<?php echo $lokasiCabang; ?>";

    const attendanceData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: 'Jumlah Tepat Waktu',
          backgroundColor: 'rgba(75, 192, 192, 0.5)',
          borderColor: 'rgba(75, 192, 192, 1)',
          data: tepatWaktu,
        },
        {
          label: 'Jumlah Terlambat',
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          data: terlambat,
        }
      ]
    };

    const attendanceOptions = {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Jumlah Tepat Waktu dan Terlambat per Bulan - ' + lokasiCabang
        }
      }
    };

    // Inisialisasi Chart
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: attendanceData,
      options: attendanceOptions
    });
  </script>

</body>
</html>
