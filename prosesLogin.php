<?php
session_start(); // Mulai session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi untuk mengakses database
    include 'koneksi.php';

    // Tangkap data yang dikirimkan melalui form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa kredensial pengguna dalam database
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $koneksi->query($query);

    // Periksa apakah hasil query mengembalikan setidaknya satu baris (pengguna ditemukan)
    if ($result && $result->num_rows > 0) {
        // Ambil data pengguna dari hasil query
        $user = $result->fetch_assoc();

        // Set session untuk pengguna yang berhasil login
        $_SESSION['username'] = $user['username'];
        $_SESSION['level'] = $user['level']; // Misalnya, 'admin' atau 'waiter'

        // Redirect ke halaman yang sesuai berdasarkan peran pengguna
        if ($user['level'] == 'administrator') {
            header("Location: admin.php");
            exit;
        } elseif ($user['level'] == 'waiter') {
            header("Location: waiter.php");
            exit;
        }
    } else {
        // Jika kredensial tidak cocok, tampilkan pesan kesalahan
        echo "Username atau password salah.";
    }
} else {
    // Jika bukan metode POST, tampilkan pesan kesalahan
    echo "Metode tidak valid.";
}
?>
