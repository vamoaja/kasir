<?php
include 'koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $namaUser

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RESTAURANT</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">S

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-ico  ns@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">

        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fas fa-">RESTAURANT</i></h3>
                </a>

                <div class="navbar-nav w-100">
                    <a href="kasir.php" class="nav-item nav-link active ">
                        <i class="fa fa-tachometer-alt me-2"></i>Entri Transaksi</a>



                </div>

            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">

                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <span class="d-none d-lg-inline-flex ms-auto text-secondary">HALAMAN KASIR</span>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <div class="m-1">
                            <div class="nav-item">
                                <a href="index.php" class="btn btn-primary">
                                    <span class="">Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->





            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">DATA TRANSAKSI</h6>
                        <a href="buatTransaksi.php" class="btn btn-primary ">Tambah Transaksi</a>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">No</th>
                                    <th scope="col">ID Pesanan</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Bayar</th>
                                    <th scope="col">Kembalian</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                // Sisipkan file koneksi.php untuk mengakses database
                                include 'koneksi.php';

                                // Lakukan query untuk mengambil data dari tabel menu
                                $query = "SELECT * FROM transaksi";
                                $result = $koneksi->query($query);

                                // Jika query berhasil dieksekusi dan mendapatkan setidaknya satu baris data
                                if ($result && $result->num_rows > 0) {
                                    $no = 1;
                                    // Lakukan iterasi untuk menampilkan data ke dalam tabel HTML
                                    while ($row = $result->fetch_assoc()) {

                                        // Lakukan koneksi ke database di sini
                                
                                        // Query untuk mengambil namaMenu dari idPesanan
                                        $query_idPesanan = "SELECT idPesanan FROM pesanan WHERE idPesanan = '" . $row['idPesanan'] . "'";
                                        $result_idPesanan = mysqli_query($koneksi, $query_idPesanan);
                                        $row_idPesanan = mysqli_fetch_assoc($result_idPesanan);
                                        $idPesanan = $row_idPesanan['idPesanan'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $no++; ?>
                                            </td>
                                            <td>
                                                <?php echo $idPesanan; ?>
                                            </td>
                                            <td>Rp.
                                                <?php echo number_format($row['total'], 0, ',', '.'); ?>
                                            </td>

                                            <td>Rp.
                                                <?php echo number_format($row['bayar'], 0, ',', '.'); ?>
                                            </td>
                                            <td>Rp.
                                                <?php echo number_format($row['kembalian'], 0, ',', '.'); ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                    onclick="window.location.href='editTransaksi.php?idTransaksi=<?php echo $row['idTransaksi']; ?>'"
                                                    data-id="<?php echo $row['idTransaksi']; ?>"
                                                    data-menu="<?php echo $row['idTransaksi']; ?>">Edit</button>
                                                <!-- Modal Delete -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusModal<?php echo $row['idTransaksi']; ?>">Delete</button>
                                                <!-- Modal Delete End -->
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="hapusModal<?php echo $row['idTransaksi']; ?>" tabindex="-1"
                                            aria-labelledby="hapusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="hapusTransaksi.php?idTransaksi=<?php echo $row['idTransaksi']; ?>"
                                                            class="btn btn-danger ">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete End -->
                                        <?php
                                    }
                                } else {
                                    // Jika query tidak mengembalikan hasil
                                    echo "<tr><td colspan='7'>Tidak ada data yang tersedia</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <a href="cetakTransaksi.php" target="_blank" class="btn btn-success float-start">Generate
                                Laporan</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Content End -->


        <!-- Back to Top -->

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>