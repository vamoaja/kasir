<?php
include 'koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $koneksi

// Tangani proses pengeditan data menu
if(isset($_POST['submit'])) {
    $idMeja = $_POST['idMeja'];
    $kodeMeja = $_POST['kodeMeja'];
    $keterangan = $_POST['keterangan'];

    // Lakukan query update ke database
    $query = "UPDATE meja SET kodeMeja='$kodeMeja', keterangan='$keterangan' WHERE idMeja=$idMeja";
    $result = $koneksi->query($query);

    // Periksa apakah query berhasil dieksekusi
    if($result) {
        // Redirect kembali ke halaman admin setelah mengedit
        header("Location: meja.php");
        exit;
    } else {
        echo "Gagal mengedit data.";
    }
}

// Ambil data menu berdasarkan idMeja yang diterima dari parameter URL
if(isset($_GET['idMeja'])) {
    $idMeja = $_GET['idMeja'];
    $query = "SELECT * FROM meja WHERE idMeja=$idMeja";
    $result = $koneksi->query($query);

    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $kodeMeja = $row['kodeMeja'];
        $keterangan = $row['keterangan'];
    } else {
        echo "Data meja tidak ditemukan.";
        exit;
    }
} else {
    echo "ID meja tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Meja - RESTAURANT</title>
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
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">

    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2>Edit Meja</h2>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="idMeja" value="<?php echo $idMeja; ?>">
                        <div class="form-floating mb-3">
    <input type="text" class="form-control" id="kodeMeja" name="kodeMeja" value="<?php echo $kodeMeja; ?>" placeholder="Kode Meja">
    <label for="kodeMeja">Kode Meja</label>
</div>
<div class="form-floating mb-3">
    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Leave a comment here" style="height: 100px;"><?php echo $keterangan; ?></textarea>
    <label for="keterangan">Keterangan</label>
</div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <a href="meja.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
