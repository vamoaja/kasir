<?php
include 'koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $koneksi

// Ambil data menu dari tabel menu
$query_pesanan = "SELECT * FROM pesanan";
$result_pesanan = mysqli_query($koneksi, $query_pesanan);



// Tangani proses penyimpanan data pesanan
// Tangani proses penyimpanan data pesanan
if (isset ($_POST['submit'])) {
    $idPesanan = $_POST['idPesanan'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $kembalian = isset ($_POST['kembalian']) ? $_POST['kembalian'] : 0; // Set nilai default jika 'kembalian' tidak ada dalam $_POST

    // Lakukan query untuk menyimpan data pesanan ke dalam database
    $query = "INSERT INTO transaksi (idPesanan,total, bayar, kembalian) VALUES ('$idPesanan','$total','$bayar','$kembalian')";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Redirect kembali ke halaman kasir setelah menyimpan data pesanan
        header("Location: kasir.php");
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
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h2>Tambah Pesanan</h2>
                        </div>
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idPesanan" name="idPesanan">
                                    <?php
                                    // Ambil data idPesanan dari tabel pesanan
                                    $query_pesanan = "SELECT * FROM pesanan";
                                    $result_pesanan = mysqli_query($koneksi, $query_pesanan);

                                    // Tampilkan opsi untuk idPesanan
                                    while ($row_pesanan = mysqli_fetch_assoc($result_pesanan)) {
                                        echo "<option value='" . $row_pesanan['idPesanan'] . "'>" . $row_pesanan['idPesanan'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idPesanan">ID Pesanan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="total" name="total" placeholder="total">
                                <label for="total">Total</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="bayar" name="bayar" placeholder="bayar"
                                    oninput="hitungKembalian()">
                                <label for="bayar">Bayar</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="kembalian" name="kembalian"
                                    placeholder="kembalian" readonly>
                                <label for="kembalian">Kembalian</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="kasir.php" class="btn btn-secondary">Kembali</a>
                        </form>

                        <script>
                            function hitungKembalian() {
                                var total = parseFloat(document.getElementById('total').value);
                                var bayar = parseFloat(document.getElementById('bayar').value);

                                var kembalian = bayar - total;

                                // Pastikan kembalian tidak negatif
                                if (kembalian >= 0) {
                                    document.getElementById('kembalian').value = kembalian;
                                } else {
                                    // Jika kembalian negatif, isi dengan 0
                                    document.getElementById('kembalian').value = 0;
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>