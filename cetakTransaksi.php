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

        $this->Cell(0, 10, 'Laporan Transaksi', 0, false, 'C', 0, '', 0, false, 'M', 'M');

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
$pdf->SetTitle('Laporan Transaksi');
$pdf->SetSubject('Laporan Transaksi');
$pdf->SetKeywords('TCPDF, PDF, Laporan, Transaksi');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Ambil data dari tabel pesanan
$query = "SELECT transaksi.idTransaksi, pesanan.idPesanan, transaksi.total, transaksi.bayar 
          FROM transaksi 
          INNER JOIN pesanan ON transaksi.idPesanan = pesanan.idPesanan";
$result = mysqli_query($koneksi, $query);

// Header
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(25, 10, 'ID Transaksi', 1, 0, 'C');
$pdf->Cell(25, 10, 'ID Pesanan', 1, 0, 'C');
$pdf->Cell(30, 10, 'Total', 1, 0, 'C');
$pdf->Cell(30, 10, 'Bayar', 1, 1, 'C');

// Data
$pdf->SetFont('helvetica', '', 10);
while($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(25, 10, $row['idTransaksi'], 1, 0, 'C');
    $pdf->Cell(25, 10, $row['idPesanan'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['total'], 1, 0, 'R');
    $pdf->Cell(30, 10, $row['bayar'], 1, 1, 'R');
}


// Output PDF to browser
$pdf->Output('laporan_pesanan.pdf', 'I');
?>
