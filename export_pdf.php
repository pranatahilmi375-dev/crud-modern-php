<?php
require('includes/fpdf/fpdf.php');
include 'includes/config.php';

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0,10,'Data Users',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15,10,'ID',1);
$pdf->Cell(50,10,'Name',1);
$pdf->Cell(70,10,'Email',1);
$pdf->Cell(40,10,'Phone',1);
$pdf->Ln();

$pdf->SetFont('Arial','',10);

$data = mysqli_query($conn, "SELECT * FROM users");

while ($row = mysqli_fetch_assoc($data)) {
    $pdf->Cell(15,10, $row['id'],1);
    $pdf->Cell(50,10, $row['name'],1);
    $pdf->Cell(70,10, $row['email'],1);
    $pdf->Cell(40,10, $row['phone'],1);
    $pdf->Ln();
}

$pdf->Output();
?>
