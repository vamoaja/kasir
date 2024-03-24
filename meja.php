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
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fas fa-">RESTAURANT</i></h3>
                </a>

                <div class="navbar-nav w-100">
                    <a href="admin.php" class="nav-item nav-link ">
                        <i class="fa fa-keyboard me-2"></i>Entri Barang</a>
                    <a href="meja.php" class="nav-item nav-link active">
                        <i class="fa fa-keyboard me-2"></i>Entri Meja</a>

                </div>

            </nav>
        </div>
        <!-- sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">

                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <span class="d-none d-lg-inline-flex ms-auto text-secondary"><b>HALAMAN ADMIN</b></span>

                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        </div>
                    </div>
                    <div class="m-1">
                        <div class="nav-item">
                            <a href="index.php" class="btn btn-primary">
                                <span class="">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">DATA MEJA</h6>
                        <a href="buatMeja.php" class="btn btn-primary">Tambah Meja</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">No</th>
                                    <th scope="col">No Meja</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Status Meja</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Sisipkan file koneksi.php untuk mengakses database
                                include 'koneksi.php';

                                // Lakukan query untuk mengambil data dari tabel menu
                                $query = "SELECT * FROM meja";
                                $result = $koneksi->query($query);

                                // Jika query berhasil dieksekusi dan mendapatkan setidaknya satu baris data
                                if ($result && $result->num_rows > 0) {
                                    $no = 1;
                                    // Lakukan iterasi untuk menampilkan data ke dalam tabel HTML
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $no++; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['kodeMeja']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['keterangan']; ?>
                                            </td>
                                            <td>
                                                <button
                                                    class="btn btn-<?php echo ($row['statusMeja'] == 1) ? 'success' : 'danger'; ?> btn-sm status-btn"
                                                    data-id="<?php echo $row['idMeja']; ?>"
                                                    data-status="<?php echo $row['statusMeja']; ?>">
                                                    <?php echo ($row['statusMeja'] == 1) ? 'Tersedia' : 'Tidak Tersedia'; ?>
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                    onclick="window.location.href='editMeja.php?idMeja=<?php echo $row['idMeja']; ?>'"
                                                    data-id="<?php echo $row['idMeja']; ?>"
                                                    data-nama="<?php echo $row['kodeMeja']; ?>"
                                                    data-harga="<?php echo $row['keterangan']; ?>">Edit</button>
                                                <!-- Modal Delete -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusModal<?php echo $row['idMeja']; ?>">Delete</button>
                                                <!-- Modal Delete End -->
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="hapusModal<?php echo $row['idMeja']; ?>" tabindex="-1"
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
                                    echo "<tr><td colspan='4'>Tidak ada data yang tersedia</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->



        </div>
        <!-- Content End -->
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
    <script>
        // Ambil semua tombol status dengan class status-btn
        var statusButtons = document.querySelectorAll('.status-btn');

        // Iterasi melalui setiap tombol status
        statusButtons.forEach(function (button) {
            // Tambahkan event listener untuk setiap tombol
            button.addEventListener('click', function () {
                // Dapatkan ID meja dari atribut data-id
                var idMeja = this.getAttribute('data-id');
                // Dapatkan status meja dari atribut data-status
                var currentStatus = this.getAttribute('data-status');
                // Ubah status meja menjadi yang baru
                var newStatus = (currentStatus == 1) ? 0 : 1;
                // Kirim permintaan POST ke updateStatusMeja.php untuk memperbarui status meja
                fetch('updateStatusMeja.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'idMeja=' + idMeja + '&newStatus=' + newStatus
                })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(function (data) {
                        // Perbarui tampilan tombol status dan atribut data-status setelah berhasil diperbarui di database
                        button.setAttribute('data-status', newStatus);
                        button.innerHTML = (newStatus == 1) ? 'Tersedia' : 'Tidak Tersedia';
                        button.classList.remove((currentStatus == 1) ? 'btn-success' : 'btn-danger');
                        button.classList.add((newStatus == 1) ? 'btn-success' : 'btn-danger');
                    })
                    .catch(function (error) {
                        console.error('There has been a problem with your fetch operation:', error);
                    });
            });
        });
    </script>
</body>

</html>