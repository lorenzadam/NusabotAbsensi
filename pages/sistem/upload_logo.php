<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Sistem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Pengaturan Sistem</h2>

    <?php
    // Notifikasi berhasil atau gagal upload
    $uploadMessage = "";
    $alertType = "";

    // Set direktori tujuan penyimpanan file
    $target_dir = "../../dist/img/";
    $target_file = $target_dir . "logo.png"; // Nama file tetap "logo.png"
    $uploadOk = 1;

    if (isset($_POST["upload_logo"])) {
        $imageFileType = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));

        // Periksa apakah file benar-benar gambar
        $check = getimagesize($_FILES["logo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadMessage = "File bukan gambar.";
            $alertType = "danger";
            $uploadOk = 0;
        }

        // Batasi jenis file yang boleh di-upload
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            $uploadMessage = "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            $alertType = "danger";
            $uploadOk = 0;
        }

        // Batasi ukuran file (maksimum 10MB)
        if ($_FILES["logo"]["size"] > 10000000) {
            $uploadMessage = "Maaf, ukuran file terlalu besar (maks 10MB).";
            $alertType = "danger";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            // Upload file dan timpa logo.png yang sudah ada
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                $uploadMessage = "Logo berhasil diunggah sebagai logo.png!";
                $alertType = "success";
            } else {
                $uploadMessage = "Maaf, terjadi kesalahan saat mengunggah logo.";
                $alertType = "danger";
            }
        }
    }
    ?>

    <?php if (!empty($uploadMessage)) : ?>
        <div class="alert alert-<?= $alertType; ?>"><?= $uploadMessage; ?></div>
    <?php endif; ?>

    <!-- Form upload logo -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="logo">Pilih Logo:</label>
            <input type="file" name="logo" id="logo" class="form-control-file" required>
        </div>
        <button type="submit" name="upload_logo" class="btn btn-primary">Unggah Logo</button>
    </form>
</div>

<!-- Menyertakan Bootstrap JS dan dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
