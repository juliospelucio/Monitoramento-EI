<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/Monitoramento-EI/assets/helpers.php";
require_once '../controller/CandidateController.php';
require('../controller/fpdf_controller.php');

class PDF extends FPDF{

    // Page header
    function Header(){
        // Logo
        $this->Image('../assets/img/brasão.png',91,null,25);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        $this->Ln(3);
        // Title
        $this->Cell(0,10,$this->encode('Secretaria Municipal de Educação'),0,0,'C');
        $this->Ln(9);
        $this->Cell(0,10,$this->encode('Ficha de Cadastro para Vaga'),0,0,'C');
        // Line break
        $this->Ln(15);
    }

   /* function Footer(){
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
        // Print centered page number
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }*/

    //Encode to UTF-8
    public function encode($str){
        return iconv('UTF-8', 'windows-1252', $str);
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Line(10,60,205,60);
$pdf->SetFont('Arial','',14);
$pdf->cell(60,15,$pdf->encode("Data de Cadastro: 12/08/2019"),0,0,'L');
$pdf->cell(25);
$pdf->cell(95,15,$pdf->encode("Telefone(s): (35) 98703-7999 / (35) 93295-8700"),0,0,'L');
// $pdf->Line(10,80,205,80);
$pdf->Ln(18);

$pdf->cell(0,15,$pdf->encode("Rua: Olímpio Pereira, n° 288 - Centro"),0,0,'L');
// $pdf->Line(10,100,205,100);
$pdf->Ln(18);

$pdf->cell(115,15,$pdf->encode("Nome: Júlio dos Santos Pelúcio"),0,0,'L');
$pdf->cell(05);
$pdf->cell(65,15,$pdf->encode("Data de Nascimento: 27/02/1996"),0,0,'L');
// $pdf->Line(10,120,205,120);
$pdf->Ln(18);

$pdf->cell(0,15,$pdf->encode("Pai: Bartolomeu Pereira Pelúcio"),0,0,'L');
// $pdf->Line(10,140,205,140);
$pdf->Ln(18);

$pdf->cell(0,15,$pdf->encode("Mãe: Francisca Isabel dos Santos"),0,0,'L');
// $pdf->Line(10,160,205,160);
$pdf->Ln(18);

$pdf->cell(0,15,$pdf->encode("Observações:    O candidato já passou da idade de ir para creche, deve trabalhar já."),0,0,'L');
/*$pdf->Line(42,180,205,180);
$pdf->Line(10,187,205,187);
$pdf->Line(10,194,205,194);*/ //Lines
$pdf->Rect(45,155,160,20);
$pdf->Ln(25);

$pdf->cell(0,15,$pdf->encode("Assinatura do Responsável:"),0,0,'L');
$pdf->Line(75,190,205,190);
$pdf->Ln(18);

$pdf->Line(0,200,210,200);

$pdf->SetFont('Arial','B',15);
$pdf->cell(0,15,$pdf->encode("Via do Candidato"),0,0,'C');
$pdf->Ln(15);

$pdf->SetFont('Arial','',14);
$pdf->cell(0,15,$pdf->encode("Nome: Júlio dos Santos Pelúcio"),0,0,'L');
$pdf->Ln(15);
$pdf->cell(0,15,$pdf->encode("Mãe: Francisca Isabel dos Santos"),0,0,'L');
$pdf->Ln(15);
$pdf->cell(65,15,$pdf->encode("Data de Cadastro: 12/08/2019"),0,0,'L');
$pdf->Ln(15);
$pdf->cell(0,15,$pdf->encode("Responsável pelo Cadastro:"),0,0,'L');
$pdf->Line(75,270,205,270);
$pdf->Output();
?>
