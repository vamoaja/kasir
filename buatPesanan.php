<?php
include 'koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $koneksi

// Ambil data menu dari tabel menu
$query_menu = "SELECT * FROM menu";
$result_menu = mysqli_query($koneksi, $query_menu);

// Ambil data pelanggan dari tabel pelanggan
$query_pelanggan = "SELECT * FROM pelanggan";
$result_pelanggan = mysqli_query($koneksi, $query_pelanggan);

// Ambil data meja dari tabel meja yang statusnya aktif (status = 1)
$query_meja = "SELECT * FROM meja WHERE statusMeja = '1'";
$result_meja = mysqli_query($koneksi, $query_meja);


// Ambil data user dari tabel user dengan level waiter
$query_user = "SELECT * FROM user WHERE level='waiter'";
$result_user = mysqli_query($koneksi, $query_user);

// Tangani proses penyimpanan data pesanan
if(isset($_POST['submit'])) {
    $idMenu = $_POST['idMenu'];
    $idPelanggan = $_POST['idPelanggan'];
    $jumlah = $_POST['jumlah'];
    $idMeja = $_POST['idMeja'];
    $idUser = $_POST['idUser'];

    // Lakukan query untuk menyimpan data pesanan ke dalam database
    $query = "INSERT INTO pesanan (idMenu, idPelanggan, jumlah, idMeja, idUser) VALUES ('$idMenu', '$idPelanggan', '$jumlah', '$idMeja', '$idUser')";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil dieksekusi
    if($result) {
        // Redirect kembali ke halaman order setelah menyimpan data pesanan
        header("Location: order.php");
        exit;
    } else {
        echo "Gagal menyimpan data pesanan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tambah Pesanan - RESTAURANT</title>
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
                            <h2>Tambah Pesanan</h2>
                        </div>
                        <form method="POST">
                        <div class="form-floating mb-3">
                                <select class="form-select" id="idPelanggan" name="idPelanggan">
                                    <?php
                                    // Tampilkan opsi untuk idPelanggan
                                    while($row_pelanggan = mysqli_fetch_assoc($result_pelanggan)) {
                                        echo "<option value='".$row_pelanggan['idPelanggan']."'>".$row_pelanggan['namaPelanggan']."</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idPelanggan">Nama Pelanggan</label>
                            </div>
                        <div class="form-floating mb-3">
                                <select class="form-select" id="idMenu" name="idMenu">
                                    <?php
                                    // Tampilkan opsi untuk idMenu
                                    while($row_menu = mysqli_fetch_assoc($result_menu)) {
                                        echo "<option value='".$row_menu['idMenu']."'>".$row_menu['namaMenu']."</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idMenu">Nama Menu</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah">
                                <label for="jumlah">Jumlah</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idMeja" name="idMeja">
                                    <?php
                                    // Tampilkan opsi untuk idMeja
                                    while($row_meja = mysqli_fetch_assoc($result_meja)) {
                                        echo "<option value='".$row_meja['idMeja']."'>".$row_meja['kodeMeja']."</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idMeja">Kode Meja</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idUser" name="idUser">
                                    <?php
                                    // Tampilkan opsi untuk idUser
                                    while($row_user = mysqli_fetch_assoc($result_user)) {
                                        echo "<option value='".$row_user['idUser']."'>".$row_user['namaUser']."</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idUser">Nama User</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="order.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
