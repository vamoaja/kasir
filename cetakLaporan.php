<?php
// Sisipkan file koneksi.php untuk mengakses variabel $koneksi
include 'koneksi.php';

// Load TCPDF library
require_once('tcpdf/tcpdf.php');

// Extend TCPDF class to create custom header and footer
class MYPDF extends TCPDF {
    // Page header
    public function Header() {
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title

        $this->Ln(5);

        $this->Cell(0, 10, 'Laporan Pesanan', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        // Line break setelah judul
        $this->Ln(20);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Halaman ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Create new PDF document
$pdf = new MYPDF();

// Set document properties
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Laporan Pesanan');
$pdf->SetSubject('Laporan Pesanan');
$pdf->SetKeywords('TCPDF, PDF, Laporan, Pesanan');


// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Ambil data dari tabel pesanan
$query = "SELECT pesanan.idPesanan, pelanggan.namaPelanggan, menu.namaMenu, pesanan.jumlah, meja.kodeMeja, user.namaUser 
          FROM pesanan 
          INNER JOIN pelanggan ON pesanan.idPelanggan = pelanggan.idPelanggan 
          INNER JOIN menu ON pesanan.idMenu = menu.idMenu 
          INNER JOIN meja ON pesanan.idMeja = meja.idMeja 
          INNER JOIN user ON pesanan.idUser = user.idUser";
$result = mysqli_query($koneksi, $query);

// Header
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(20, 10, 'ID Pesanan', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama Pelanggan', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama Menu', 1, 0, 'C');
$pdf->Cell(20, 10, 'Jumlah', 1, 0, 'C');
$pdf->Cell(30, 10, 'Kode Meja', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama User', 1, 1, 'C');

// Data
$pdf->SetFont('helvetica', '', 10);
while($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(20, 10, $row['idPesanan'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['namaPelanggan'], 1, 0, 'L');
    $pdf->Cell(40, 10, $row['namaMenu'], 1, 0, 'L');
    $pdf->Cell(20, 10, $row['jumlah'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['kodeMeja'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['namaUser'], 1, 1, 'L');
}


// Output PDF to browser
$pdf->Output('laporan_pesanan.pdf', 'I');
?>
