<?php
include 'koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $koneksi

// Periksa apakah parameter idPesanan telah diterima dari URL
if(isset($_GET['idPesanan'])) {
    // Ambil nilai idPesanan dari URL
    $idPesanan = $_GET['idPesanan'];
    
    // Lakukan query untuk menghapus data menu berdasarkan idPesanan
    $query = "DELETE FROM pesanan WHERE idPesanan=$idPesanan";
    $result = $koneksi->query($query);
    
    // Periksa apakah penghapusan data berhasil
    if($result) {
        // Redirect kembali ke halaman admin setelah menghapus data
        header("Location: order.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID pesanan tidak ditemukan.";
    exit;
}
?>
