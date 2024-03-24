<?php
include 'koneksi.php';

// Tangani proses pengeditan data pesanan
if(isset($_POST['submit'])) {
    $idPesanan = $_POST['idPesanan'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $kembalian = $_POST['kembalian'];
    $idTransaksi = $_POST['idTransaksi']; // Tambahkan ini untuk mendapatkan idTransaksi

    // Lakukan query update ke database
    $query = "UPDATE transaksi SET idPesanan='$idPesanan', total='$total', bayar='$bayar', kembalian='$kembalian' WHERE idTransaksi='$idTransaksi'";
    $result = $koneksi->query($query);

    // Periksa apakah query berhasil dieksekusi
    if($result) {
        // Redirect kembali ke halaman kasir setelah mengedit
        header("Location: kasir.php");
        exit;
    } else {
        echo "Gagal mengedit data.";
    }
}

// Ambil data pesanan berdasarkan idPesanan yang diterima dari parameter URL
if(isset($_GET['idTransaksi'])) {
    $idTransaksi = $_GET['idTransaksi'];
    $query = "SELECT * FROM transaksi WHERE idTransaksi=$idTransaksi";
    $result = $koneksi->query($query);

    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idPesanan = $row['idPesanan'];
        $total = $row['total'];
        $bayar = $row['bayar'];
        $kembalian = $row['kembalian'];
    } else {
        echo "Data Transaksi tidak ditemukan.";
        exit;
    }
} else {
    echo "ID Transaksi tidak ditemukan.";
    exit;
}

// Ambil data pesanan dari tabel pesanan
$query_pesanan = "SELECT * FROM pesanan";
$result_pesanan = mysqli_query($koneksi, $query_pesanan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Pesanan - RESTAURANT</title>
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
                        <h2>Edit Pesanan</h2>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="idTransaksi" value="<?php echo $idTransaksi; ?>"> <!-- Tambahkan input hidden untuk idTransaksi -->
                        <div class="form-floating mb-3">
                            <select class="form-select" id="idPesanan" name="idPesanan">
                                <?php
                                // Tampilkan opsi untuk idPesanan
                                while($row_pesanan = mysqli_fetch_assoc($result_pesanan)) {
                                    if($row_pesanan['idPesanan'] == $idPesanan) {
                                        echo "<option value='".$row_pesanan['idPesanan']."' selected>".$row_pesanan['idPesanan']."</option>";
                                    } else {
                                        echo "<option value='".$row_pesanan['idPesanan']."'>".$row_pesanan['idPesanan']."</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="idPesanan">ID Pesanan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="total" name="total" value="<?php echo $total; ?>" placeholder="Total">
                            <label for="total">Total</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="bayar" name="bayar" value="<?php echo $bayar; ?>" placeholder="Bayar" oninput="hitungKembalian()">
                            <label for="bayar">Bayar</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="kembalian" name="kembalian" value="<?php echo $kembalian; ?>" placeholder="kembalian">
                            <label for="kembalian">Kembalian</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <a href="kasir.php" class="btn btn-secondary">Cancel</a>
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
