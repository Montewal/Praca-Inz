<?php
session_start();
require_once "../Classes/Classess.php";
require('../../vendor/tfpdf/tfpdf.php');

$pdf = new tFPDF('P','mm','A4');
$pdf->AddPage();
$pdf->AddFont('Times','','times.ttf',true);
$pdf->SetFont('Times','B',20);
$pdf->Cell(71 ,10,'',0,0);
$pdf->Cell(59 ,5,'Faktura',0,1);
$pdf->Cell(55 ,10,'',0,0);
$pdf->Cell(59 ,10,'nr. '.Generate::Invoice_RefCode(),0,1);
$pdf->Cell(59 ,10,'',0,1);

$pdf->SetFont('Times','BU',15);
$pdf->Cell(70 ,7,'Sprzedawca',0,0);
$pdf->Cell(59 ,5,'',0,0);
$pdf->Cell(59 ,7,'Nabywca',0,1);

$pdf->SetFont('Times','',10);
$pdf->Cell(110 ,5,'IT World',0,0);
$pdf->Cell(30 ,5,'ID Klienta:',0,0);
$pdf->Cell(34 ,5,'',0,1); // pobierz id z bazy
$pdf->Cell(110 ,5,'Wrocław, Serwisantów 12',0,0);
$pdf->Cell(30 ,5,'Data Wystawienia:',0,0);
$pdf->Cell(40 ,5,date("Y m d h:i:sa"),0,1);
$pdf->Cell(110 ,5,'helpdesk@IT_World',0,0);
$pdf->Cell(30 ,5,'Email: ',0,0);
$pdf->Cell(34 ,5,'',0,1); // pobierz email z bazy
$pdf->Cell(110 ,5,'',0,1);
$pdf->Cell(30 ,5,'Nr konta: 40 0874 9852 XXXX 3258 XXXX 7539',0,1);
$pdf->Cell(30 ,5,'Termin zapłaty: '.date('Y m d', strtotime(date("Y-m-d"). ' + 1 days')),0,1);
$pdf->Cell(59 ,5,'',0,0);
$pdf->Cell(189 ,10,'',0,1);
$pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Times','',10);
$pdf->Cell(10 ,6,'ID',1,0,'C');
$pdf->Cell(80 ,6,'Nazwa',1,0,'C');
$pdf->Cell(18 ,6,'Ilość',1,0,'C');
$pdf->Cell(39 ,6,'Koszt za sztukę [Brutto]',1,0,'C');
$pdf->Cell(40 ,6,'Koszt całkowity [Brutto]',1,1,'C');

if(isset($_SESSION["cart"]))
{
	$total_price = 0;
    $a = 1;
    foreach ($_SESSION["cart"] as $product)
    {		
        $pdf->SetFont('Times','',10);
        $pdf->Cell(10 ,6,$a++,1,0,'C');
        $pdf->Cell(80 ,6,$product['name'],1,0,'C');
        $pdf->Cell(18 ,6,$product["quantity"],1,0,'C');
        $pdf->Cell(39 ,6,$product["price"],1,0,'C');
        $pdf->Cell(40 ,6,$product["price"]*$product["quantity"],1,1,'C');  
        $total_price += ($product["price"]*$product["quantity"]);
    }
    $pdf->Cell(118 ,6,'',0,0);
    $pdf->Cell(29 ,6,'Podsumowanie:',0,0);
    $pdf->Cell(40 ,6,$total_price,1,1,'C'); 
}
$pdf->Cell(30 ,10,'',0,1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(30 ,5,'Metoda:  Przelew',0,1);
$pdf->SetFont('Times','U',15);
$pdf->Cell(30 ,3,'',0,1);
$pdf->Cell(10 ,7,'Razem do Zapłaty: '.$total_price.'/zł',0,1);
$pdf->SetFont('Times','',10);
$pdf->Cell(10 ,5,'Kwota słownie: '.Generate::numberToText($total_price).' złotych',0,1);

$pdf->Output();
?>