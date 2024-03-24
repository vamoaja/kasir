<?php
include 'koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $koneksi

// Periksa apakah parameter idMenu telah diterima dari URL
if(isset($_GET['idMenu'])) {
    // Ambil nilai idMenu dari URL
    $idMenu = $_GET['idMenu'];
    
    // Lakukan query untuk menghapus data menu berdasarkan idMenu
    $query = "DELETE FROM menu WHERE idMenu=$idMenu";
    $result = $koneksi->query($query);
    
    // Periksa apakah penghapusan data berhasil
    if($result) {
        // Redirect kembali ke halaman admin setelah menghapus data
        header("Location: admin.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID menu tidak ditemukan.";
    exit;
}
?>
