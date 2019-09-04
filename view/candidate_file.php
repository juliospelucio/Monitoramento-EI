<?php 
require('../controller/PDFController.php');

// Instanciation of inherited class
$pdf = new PDF($candidate);
$pdf->Body();
?>