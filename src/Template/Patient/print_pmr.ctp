<?php

require_once('fpdf/fpdf.php');
require_once('fpdi/fpdi.php');

$fileName='/var/www/html/docpharmaUAT/src/Template/Patient/medicationPDF.pdf';

$datefrm=str_split(date('dmY'));
$pdf = new FPDI();
$pdf->setSourceFile($fileName);
$pdf->AddPage();
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 10, 10, 200);
$pdf->SetFont('Arial','',5);
$pdf->SetTextColor(50,50,50);
$pdf->SetFont('Arial','',7);

$pdf->SetXY(28, 27.1);
$pdf->Write(0,$finalData["patient_name"]);

$pdf->SetXY(30, 31.1);
$pdf->Write(0,$finalData["patient_allergy"]);

$pdf->SetXY(30, 35.2);
$pdf->Write(0,$finalData["patient_address"]);

$pdf->SetXY(33, 39.3);
$pdf->Write(0,$finalData["start_date"]);

$pdf->SetXY(145, 27.1);
$pdf->Write(0,$finalData["patient_dob"]);

$pdf->SetXY(150, 31.1);
$pdf->Write(0,"Dr. ".$finalData["doctor_name"]);


if(!empty($finalData["medication"])) {
foreach($finalData["medication"] as $key => $value)
{
	$topSpace = $key==0 ? 56*($key+1) : 56+(23*$key);
	$pdf->SetXY(17.5, $topSpace);
	$pdf->Write(0,$value["product_name"]);
	
	if($value["morning"] && !empty($value["morning"]))
		{
		$instruction = $value["morning"]=="Anytime" ? "(Take in the Mor. - ".$value["morning_quantity"]." ".$value["product_type"].")" : "(Take in the Mor. ".$value["morning"]." Food - ".$value["morning_quantity"]." ".$value["product_type"].")";
		$morningSpace = $key==0 ? 60*($key+1) : 60+(23*$key);
		$pdf->SetXY(17.5, $morningSpace);
		$pdf->Write(0,$instruction);
		
		$key==0 ? $pdf->SetXY(62,53.5*($key+1)) : $pdf->SetXY(62,53.5+($key*23));
		$pdf->Write(0,"Mor");
	}
	if($value["afternoon"] && !empty($value["afternoon"]))
	{
		$instruction = $value["afternoon"]=="Anytime" ? "(Take in the Aft. - ".$value["afternoon_quantity"]." ".$value["product_type"].")" : "(Take in the Aft. ".$value["morning"]." Food - ".$value["afternoon_quantity"]." ".$value["product_type"].")";
		$afternoonSpace = $key==0 ? 63*($key+1) : 63+(23*$key);
		$pdf->SetXY(17.5, $afternoonSpace);
		$pdf->Write(0,$instruction);
		
		$key==0 ? $pdf->SetXY(62,57*($key+1)) : $pdf->SetXY(62,57+($key*23));
		$pdf->Write(0,"Aft");
	}
	if($value["evening"] && !empty($value["evening"]))
	{
		$instruction = $value["evening"]=="Anytime" ? "(Take in the Eve. - ".$value["evening_quantity"]." ".$value["product_type"].")" : "(Take in the Eve. ".$value["evening"]." Food - ".$value["evening_quantity"]." ".$value["product_type"].")";
		$eveningSpace = $key==0 ? 66*($key+1) : 66+(23*$key);
		$pdf->SetXY(17.5, $eveningSpace);
		$pdf->Write(0,$instruction);
		
		$key==0 ? $pdf->SetXY(62,60.5*($key+1)) : $pdf->SetXY(62,60.5+($key*23));
		$pdf->Write(0,"Eve");
	}
	if($value["dinner"] && !empty($value["dinner"]))
	{
		$instruction = $value["dinner"]=="Anytime" ? "(Take in the Din. - ".$value["dinner_quantity"]." ".$value["product_type"].")" : "(Take in the Din. ".$value["dinner"]." Food - ".$value["dinner_quantity"]." ".$value["product_type"].")";
		$dinnerSpace = $key==0 ? 69*($key+1) : 69+(23*$key);
		$pdf->SetXY(17.5, $dinnerSpace);
		$pdf->Write(0,$instruction);
		
		$key==0 ? $pdf->SetXY(62,63.5*($key+1)) : $pdf->SetXY(62,63.5+($key*23));
		$pdf->Write(0,"Din");
	}
	if($value["abbreviation_meaning"] && !empty($value["abbreviation_meaning"]))
	{
		$instruction = "(".$value["abbreviation_meaning"].")";
		$instructionSpace = $key==0 ? 60*($key+1) : 60+(23*$key);
		$pdf->SetXY(17.5, $instructionSpace);
		$pdf->Write(0,$instruction);
	}
} }
$pdf->SetXY(38, 51);
$pdf->Write(0,$bnkname);
$axsi=102;

ob_end_clean();
$pdf->Output('/var/www/html/docpharmaUAT/src/Template/Patient/medicationPDF.pdf','I');
?>