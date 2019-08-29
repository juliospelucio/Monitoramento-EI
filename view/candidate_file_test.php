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
        // Title
        $this->Cell(0,10,$this->encode('Prefeitura Municipal de Machado'),0,0,'C');
        $this->Ln(7);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,$this->encode('Secretaria Municipal de Educação'),0,0,'C');
        $this->Ln(9);
        $this->SetFont('Arial','B',15);
        $this->Cell(0,10,$this->encode('Ficha de Cadastro - Educação Infantil'),0,0,'C');
        // Line break
        $this->Ln(15);
    }

    // Page body
    function Body(){
        $this->AddPage();
        $this->Line(10,65,205,65);
        $this->SetFont('Arial','',14);
        $this->cell(60,8,$this->encode("Data de Cadastro: "),0,0,'L');
        $this->cell(25);

        $this->cell(95,8,$this->encode("Telefone(s): "),0,0,'L');
        $this->Ln(20);

        $this->cell(0,8,$this->encode("Rua: "),0,0,'L');
        $this->Ln(20);

        $this->cell(115,8,$this->encode("Nome: "),0,0,'L');
        $this->cell(05);
        $this->cell(65,8,$this->encode("Data de Nascimento: "),0,0,'L');
        $this->Ln(20);

        $this->cell(0,8,$this->encode("Pai: "),0,0,'L');
        $this->Ln(20);

        $this->cell(0,8,$this->encode("Mãe: "),0,0,'L');
        $this->Ln(20);

        $this->cell(32,8,$this->encode("Observações: "),0,0,'L');
        $this->SetFont('Arial','',12);
        $this->Cell(01);
        $this->MultiCell(160,8,"\n\n\n",1,'L');
        $this->SetFont('Arial','',14);

        // $this->Rect(42,173,150,20);

        $this->Ln(18);

        $this->cell(0,8,$this->encode("Assinatura do Responsável: _______________________________________________"),0,0,'L');
        $this->Line(0,230,210,230);

        $this->SetCreator('MVEI',1);
        $this->SetAuthor('SEMED - Machado',1);
        $this->SetTitle('ficha_do_candidato',1);
        $this->Output('','ficha_do_candidato_'.date("d-m-Y"));    
    }

    // Page footer
    function Footer(){
        // Position at 1.5 cm from bottom
        $this->SetY(-65);
        // Arial italic 8
        $this->SetFont('Arial','B',15);
        $this->cell(0,15,$this->encode("Via do Candidato"),0,0,'C');
        $this->Ln(12);
        $this->SetFont('Arial','',14);
        $this->cell(0,15,$this->encode("Nome: "),0,0,'L');
        $this->Ln(12);
        $this->cell(0,15,$this->encode("Mãe: "),0,0,'L');
        $this->Ln(12);
        $this->cell(65,15,$this->encode("Data de Cadastro: "),0,0,'L');
        $this->Ln(12);
        $this->cell(0,15,$this->encode("Responsável pelo Cadastro: _______________________________________________"),0,0,'L');
    }

    //Encode to UTF-8
    public function encode($str){
        return iconv('UTF-8', 'windows-1252', $str);
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->Body();
?>