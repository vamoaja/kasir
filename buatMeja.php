<?php
include 'koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $koneksi

// Tangani proses penyimpanan data menu
if (isset ($_POST['submit'])) {
    $kodeMeja = $_POST['kodeMeja'];
    $keterangan = $_POST['keterangan'];
    $statusMeja = ($_POST['gridRadios'] == 'option1') ? 1 : 0; // Tetapkan nilai statusMeja sesuai pilihan radio

    // Lakukan query untuk menyimpan data menu ke dalam database
    $query = "INSERT INTO meja (kodeMeja, keterangan, statusMeja) VALUES ('$kodeMeja', '$keterangan','$statusMeja')";
    $result = $koneksi->query($query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Redirect kembali ke halaman admin setelah menyimpan data menu
        header("Location: meja.php");
        exit;
    } else {
        echo "Gagal menyimpan data meja.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tambah Meja - RESTAURANT</title>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">

        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h2>Tambah Meja</h2>
                        </div>
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="kodeMeja" name="kodeMeja"
                                    placeholder="name@example.com">
                                <label for="kodeMeja">Kode Meja</label>
                            </div>

                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="keterangan"
                                        name="keterangan" style="height: 150px;"></textarea>
                                    <label for="keterangan">Keterangan</label>
                                </div>
                            </div>

                            <div class="col-sm-10 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1"
                                        value="option1" checked>
                                    <label class="form-check-label" for="gridRadios1">Tersedia</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2"
                                        value="option2">
                                    <label class="form-check-label" for="gridRadios2">Tidak Tersedia</label>
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="admin.php" class="btn btn-secondary">Kembali</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</body>

</html>