<?php
include 'koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $koneksi

// Periksa apakah parameter idTransaksi telah diterima dari URL
if(isset($_GET['idTransaksi'])) {
    // Ambil nilai idTransaksi dari URL
    $idTransaksi = $_GET['idTransaksi'];
    
    // Lakukan query untuk menghapus data menu berdasarkan idTransaksi
    $query = "DELETE FROM transaksi WHERE idTransaksi=$idTransaksi";
    $result = $koneksi->query($query);
    
    // Periksa apakah penghapusan data berhasil
    if($result) {
        // Redirect kembali ke halaman admin setelah menghapus data
        header("Location: kasir.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID transaksi tidak ditemukan.";
    exit;
}
?>
