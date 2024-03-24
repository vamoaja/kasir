<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "resto");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Periksa apakah form login dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa kredensial pengguna
    $query = "SELECT * FROM user WHERE namaUser='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah ada baris yang sesuai
    if (mysqli_num_rows($result) == 1) {
        // Ambil informasi level pengguna dari hasil query
        $user_data = mysqli_fetch_assoc($result);
        $level = $user_data['level'];

        // Berdasarkan level pengguna, arahkan ke halaman yang sesuai
        switch ($level) {
            case 'administrator':
                header("Location: admin.php");
                break;
            case 'waiter':
                header("Location: waiter.php");
                break;
            case 'kasir':
                header("Location: kasir.php");
                break;
            case 'owner':
                header("Location: owner.php");
                break;
            default:
                // Jika level tidak dikenali, arahkan ke halaman default
                header("Location: index.php");
                break;
        }
    } else {
        // Gagal login, tampilkan pesan kesalahan
        echo "Username atau password salah.";
    }
}
?>
