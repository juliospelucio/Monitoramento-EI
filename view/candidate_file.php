<?php 
require('../controller/PDFController.php');
if (isset($_SESSION['admin']) && $_SESSION['admin']==1) {
	// Instanciation of inherited class
	$pdf = new PDF($candidate);
	$pdf->Body();
}
?>