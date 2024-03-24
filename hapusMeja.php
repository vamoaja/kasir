<?php
include 'koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $koneksi

// Periksa apakah parameter idMeja telah diterima dari URL
if(isset($_GET['idMeja'])) {
    // Ambil nilai idMeja dari URL
    $idMeja = $_GET['idMeja'];
    
    // Lakukan query untuk menghapus data menu berdasarkan idMeja
    $query = "DELETE FROM meja WHERE idMeja=$idMeja";
    $result = $koneksi->query($query);
    
    // Periksa apakah penghapusan data berhasil
    if($result) {
        // Redirect kembali ke halaman admin setelah menghapus data
        header("Location: meja.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID meja tidak ditemukan.";
    exit;
}
?>
