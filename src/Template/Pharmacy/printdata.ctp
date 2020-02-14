<?php //echo "<pre>";
//print_r($savedPrescription);die;
require_once(PDFPATH.'/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Prescription Details');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style

$medicineData = "";
$count=0;
foreach(array_values($savedPrescription) as $mKey => $mValue) {
		$drugs = "";
		$customDrugs = "";
		$inventoryData = "";
		$dayCheck = isset($mValue["day_of_week"]) && !empty($mValue["day_of_week"]) ? ' ('.$mValue["day_of_week"].')' : "";
		
		if(strpos(strtolower($mValue["product_type"]), 'patch') !== false)
		{
			$image = $patchImage;
		}
		else if(strpos(strtolower($mValue["product_type"]), 'gel') !== false || strpos(strtolower($mValue["product_type"]), 'cream') !== false)
		{
			$image = $gelCreamImage;
		}
		else if(strpos(strtolower($mValue["product_type"]), 'inj') !== false)
		{
			$image = $injectionImage;
		}
		else if(strpos(strtolower($mValue["product_type"]), 'cap') !== false)
		{
			$image = $capsuleImage;
		}
		else if(strpos(strtolower($mValue["product_type"]), 'tab') !== false)
		{
			$image = $tabletImage;
		}
		else
		{
			$image = "";
		}
		
		$anytimeMorning = $mValue["morning"]=="Anytime" ? "Take in the Morning (".$mValue["morning_quantity"]." ".$mValue["product_type"].")" : "Take in the Morning ".$mValue["morning"]." Food (".$mValue["morning_quantity"]." ".$mValue["product_type"].")";
		$anytimeAfternoon = $mValue["afternoon"]=="Anytime" ? "Take in the Afternoon (".$mValue["afternoon_quantity"]." ".$mValue["product_type"].")" : "Take in the Afternoon ".$mValue["afternoon"]." Food (".$mValue["afternoon_quantity"]." ".$mValue["product_type"].")";
		$anytimeEvening = $mValue["evening"]=="Anytime" ? "Take in the Evening (".$mValue["evening_quantity"]." ".$mValue["product_type"].")" : "Take in the Evening ".$mValue["evening"]." Food (".$mValue["evening_quantity"]." ".$mValue["product_type"].")";
		$anytimeDinner = $mValue["dinner"]=="Anytime" ? "Take in the Dinner (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")" : "Take in the Dinner ".$mValue["dinner"]." Food (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")";
		
		if($mValue["custom_times"] && !empty($mValue["custom_times"]))
		{
			$customTimes = json_decode($mValue["custom_times"],true);
			if(!empty($customTimes))
			{
				foreach($customTimes as $timesKey => $timesValue) {
				$customDrugs .= '<p class="drugTiming"><small> '.$timesValue["time"].' ('.$timesValue["abbreviation_meaning"].') </small></p>'; }
			}
		}
		
										
		if(isset($mValue["inventory"]) && !empty($mValue["inventory"]))
		{
			foreach($mValue["inventory"] as $inventoryKey => $inventoryValue)
			{
				$inventoryData .=' * '.$inventoryValue["batch_no"]." (".$inventoryValue["quantity"].") - ".$inventoryValue["expiry_date"].'';
			}
		}
		
		/* if($mValue["abbreviation_meaning"] && !empty($mValue["abbreviation_meaning"]))
		{
			$customDrugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$mValue["abbreviation_meaning"].'</small></p>';
		} */
		
		if(!empty($mValue["morning"])) {
			$drugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$anytimeMorning.'</small></p>';}
		if(!empty($mValue["afternoon"])) {
			$drugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$anytimeAfternoon.'</small></p>';}
		if(!empty($mValue["evening"])) {
			$drugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$anytimeEvening.'</small></p>';}
		if(!empty($mValue["dinner"])) {
			$drugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$anytimeDinner.'</small></p>';}
		
		$SNO = $mKey+1;
		$timings = isset($drugs) && !empty($drugs) ? $drugs : $customDrugs;
		
		$medicineData .='<tr>
			<td align="center" width="7%" style="border: 1px solid #aaa;">'.$SNO.'</td>
			<td width="25%" style="border: 1px solid #aaa;">'.$mValue["product_name"].' <p style=" margin-bottom:0; padding-top:0; opacity:.75;">('.$inventoryData.')</p></td>
			<td align="center" width="11%" style="border: 1px solid #aaa;">'.$mValue["total_qty"].' '.$mValue["product_type"].'</td>
			<td width="24%" style="border: 1px solid #aaa;">'.$timings.'</td>
			<td width="11%" style="border: 1px solid #aaa;">'.$mValue["duration_no"]." ".$mValue["duration_frequency"].$dayCheck.'</td>
			<td width="12%" style="border: 1px solid #aaa;">'.$mValue["notes"].'</td>
			<td align="right" width="10%" style="border: 1px solid #aaa;">INR '.$mValue["unit_price_total"].'</td>
		</tr>';
		
		$count = $count + $mValue["unit_price_total"];
		}
//echo $count;
$s = $savedPrescription[0]["created_dttm"];
$dt = new DateTime($s);
$date = $dt->format('d M Y');
		
$html = '
<!-- EXAMPLE OF CSS STYLE -->
<style>
    td {
        border: 1px solid #ccc;
        background-color: #fff;
    }
	ul {
		margin:0;
		padding:0;
		background:#f00;
	}
	.drugTiming
	{
		font-size: 16px;
	}
	
</style>
<div class="perviewWrap" id="printData">
	<table width="100%" cellpadding="2" style="border: 0px solid #fff; width: 100%; border-collapse: collapse;">
		<tr>
			<th align="left" width="20%"><h3 class="pull-left">'.$date.'</h3></th>
			<th align="right" width="80%"><p style="margin:0; margin-bottom:1px; padding:0;">Patient - '.$savedPrescription[0]["patient_name"].'</p><p style="margin:0; margin-bottom:1px; padding:0;">DOB - '.$savedPrescription[0]["patient_dob"].'</p><p style="margin:0; margin-bottom:1px; padding:0;">Address - '.$savedPrescription[0]["patient_address"].'</p><small style="margin:0; display:block; padding:0;">Doctor - Dr. '.$savedPrescription[0]["doctor_name"].'</small></th>
        </tr>
	</table>
  <br>
  <hr>
  
  <table width="100%" cellpadding="10" style="border: 1px solid #aaa; width: 100%; border-collapse: collapse;">
    <thead>
      <tr bgcolor="#ccc" style="background:#ccc; color:#111; text-transform:uppercase; font-size:12px;">
        <th align="center" width="7%" style="border: 1px solid #aaa; ">S.No.</th>
        <th width="25%" style="border: 1px solid #aaa;">Medicine</th>
        <th align="center" width="11%" style="border: 1px solid #aaa;">Quantity</th>
        <th width="24%" style="border: 1px solid #aaa;">Dosage</th>
        <th width="11%" style="border: 1px solid #aaa;">Duration</th>
        <th width="12%" style="border: 1px solid #aaa;">Notes</th>
        <th align="right" width="10%" style="border: 1px solid #aaa;">Price</th>
      </tr>
    </thead>
    <tbody style="color:#111;  font-size:12px;">'.$medicineData.'
    </tbody>
  </table>
   <br>
     <br>
	 
	 <div align="right">Total : INR '.$count.'</div>

</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
//$pdf->AddPage();


// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
//$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_061.pdf', 'I');
die;