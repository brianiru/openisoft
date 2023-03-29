<?php
// if session is not set start session
if (!isset($_SESSION)) {
    session_start();
}

// Connect to the database
include "dbh.php";

// Import FPDF library
require('fpdf185/fpdf.php');

// Define query to retrieve requests for current user
$user_id = $_SESSION['user_id']; // Change this to the way you retrieve the user ID
$sql = "SELECT * FROM requests WHERE driver = $user_id";

$result = $conn->query($sql);

// Create new FPDF object
$pdf = new FPDF();

// Add new page to PDF document
$pdf->AddPage();

// Set font and font size for title
$pdf->SetFont('Arial', 'B', 16);

// Write title to PDF
$pdf->Cell(0, 10, 'Requests Report', 0, 1, 'C');

// Set font and font size for table header
$pdf->SetFont('Arial', 'B', 12);

// Define table headers
$pdf->Cell(10, 20, 'ID', 1, 0, 'C');
$pdf->Cell(30, 20, 'Name', 1, 0, 'C');
$pdf->Cell(50, 20, 'Email', 1, 0, 'C');
$pdf->Cell(40, 20, 'Address', 1, 0, 'C');
// $pdf->Cell(60, 50, 'Message', 1, 0, 'C');
$pdf->Cell(30, 20, 'Date', 1, 1, 'C');

// Set font and font size for table content
$pdf->SetFont('Arial', '', 12);

// Add data to table
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(10, 20, $row['id'], 1, 0, 'C');
    $pdf->Cell(30, 20, $row['name'], 1, 0, 'C');
    $pdf->Cell(50, 20, $row['email'], 1, 0, 'C');
    $pdf->Cell(40, 20, $row['address'], 1, 0, 'C');
    // $pdf->Cell(60, 50, $row['message'], 1, 0, 'C');
    $pdf->Cell(30, 20, $row['date'], 1, 1, 'C');
}

// Output the PDF document
$pdf->Output();
