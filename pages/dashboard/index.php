<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Attendance and Leave Charts</title>
  <!-- Link ke Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

  <!-- Chart 1: Jumlah Hadir dan Terlambat Masuk -->
  <div style="width: 80%; margin: auto; padding-top: 50px;">
    <canvas id="attendanceChart"></canvas>
  </div>

  <!-- Chart 2: Jumlah Cuti Per Bulan -->
  <div style="width: 80%; margin: auto; padding-top: 50px;">
    <canvas id="leaveChart"></canvas>
  </div>

  <!-- Script untuk Kedua Chart -->
  <script>
    // Data untuk Chart 1: Jumlah Hadir dan Terlambat Masuk
    const attendanceData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: 'Jumlah Hadir',
          backgroundColor: 'rgba(75, 192, 192, 0.5)',
          borderColor: 'rgba(75, 192, 192, 1)',
          data: [10, 15, 12, 14, 13, 9, 11, 14, 16, 12, 14, 15],
        },
        {
          label: 'Jumlah Terlambat',
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          data: [3, 2, 4, 1, 3, 2, 5, 2, 3, 4, 1, 2],
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
          text: 'Jumlah Hadir dan Terlambat Masuk per Bulan'
        }
      }
    };

    // Chart 1: Jumlah Hadir dan Terlambat Masuk
    const ctx1 = document.getElementById('attendanceChart').getContext('2d');
    new Chart(ctx1, {
      type: 'bar',
      data: attendanceData,
      options: attendanceOptions
    });

    // Data untuk Chart 2: Jumlah Cuti Per Bulan
    const leaveData = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: 'Jumlah Cuti',
          backgroundColor: 'rgba(54, 162, 235, 0.5)',
          borderColor: 'rgba(54, 162, 235, 1)',
          data: [2, 4, 3, 5, 1, 2, 6, 3, 4, 2, 5, 3],
        }
      ]
    };

    const leaveOptions = {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Jumlah Cuti per Bulan'
        }
      }
    };

    // Chart 2: Jumlah Cuti Per Bulan
    const ctx2 = document.getElementById('leaveChart').getContext('2d');
    new Chart(ctx2, {
      type: 'bar',
      data: leaveData,
      options: leaveOptions
    });
  </script>

</body>
</html>
