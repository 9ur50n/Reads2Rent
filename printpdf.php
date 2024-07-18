<?php 
session_start();
$_SESSION['username'];
$username=$_SESSION['username'];
//database connection
$user = "root";
$pass = ""; 
$host = "localhost";
$dbname= "read2rent";
$errors = array(); 
$db= mysqli_connect($host, $user, $pass, $dbname);


$record0 = "SELECT * FROM detail WHERE transID= (SELECT MAX(transID) FROM buyrent where (SELECT usID FROM users WHERE usUsername= '$username'))";
$record = mysqli_query($db, $record0) or die ("Error: " .mysqli_error($db));
ob_end_clean(); 
require('fpdf/fpdf.php'); 


// Instantiate and use the FPDF class  
foreach ($record as $fetch):
$pdf = new FPDF(); 
  
//Add a new page 
$pdf->AddPage(); 
  
// Set the font for the text 
$pdf->SetFont('Arial', 'B', 18); 
  
// Prints a cell with given text  
$pdf->Cell(30);
$pdf->Cell(60,20,'Receipt ID  : ');
$pdf->Cell(80, 20, $fetch['deID']);
$pdf->Ln(20); 
$pdf->Cell(30);
$pdf->Cell(60,20,'date            :'); 
$pdf->Cell(80, 20, $fetch['deDate']);
$pdf->Ln(20); 
$pdf->Cell(30);
$pdf->Cell(60,20,'Book ID     : '); 
$pdf->Cell(80, 20, $fetch['bookID']);
$pdf->Ln(20); 

  
// return the generated output 
$pdf->Output(); 
endforeach;

?>