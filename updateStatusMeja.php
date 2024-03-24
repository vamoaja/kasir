<?php
// Sisipkan file koneksi.php untuk mengakses database
include 'koneksi.php';

// Pastikan permintaan POST berisi data yang diperlukan
if(isset($_POST['idMeja']) && isset($_POST['newStatus'])) {
    // Tangkap data dari permintaan POST
    $idMeja = $_POST['idMeja'];
    $newStatus = $_POST['newStatus'];

    // Lakukan query untuk memperbarui status meja di database
    $query = "UPDATE meja SET statusMeja='$newStatus' WHERE idMeja=$idMeja";
    $result = $koneksi->query($query);

    // Periksa apakah query berhasil dieksekusi
    if($result) {
        // Redirect kembali ke halaman admin setelah memperbarui status meja
        header("Location: admin.php");
        exit;
    } else {
        echo "Gagal memperbarui status meja.";
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}
?>
