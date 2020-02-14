<?php //echo "<pre>";
//print_r($popupData);die;
require_once('TCPDF/tcpdf.php');

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

//$dayCheck = isset($previousData[0]["day_of_week"]) && !empty($previousData[0]["day_of_week"]) ? ' ('.$previousData[0]["day_of_week"].')' : "";
$medicineData = "";
$prescriptionDiv = isset($popupData["medicine"][0]["product_name"]) && !empty($popupData["medicine"][0]["product_name"]) ? "block" : "none";

foreach(array_values($popupData["medicine"]) as $mKey => $mValue) {
if(!empty($mValue["product_name"])) {
		$drugs = "";
		$customDrugs = "";
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
		$anytimeDinner = $mValue["dinner"]=="Anytime" ? "Take at Night (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")" : "Take at Night ".$mValue["dinner"]." Food (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")";
		
		if($mValue["custom_times"] && !empty($mValue["custom_times"]))
		{
			$customTimes = json_decode($mValue["custom_times"],true);
			if(!empty($customTimes))
			{
				foreach($customTimes as $timesKey => $timesValue) {
				$customDrugs .= '<p class="drugTiming"><small> '.$timesValue["time"].' ('.$timesValue["abbreviation_meaning"].') </small></p>'; }
			}
		}
		
		/* if($mValue["abbreviation_meaning"] && !empty($mValue["abbreviation_meaning"]))
		{
			$customDrugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$mValue["abbreviation_meaning"].'</small></p>';
		} */
		
		if(!empty($mValue["morning"])) {
			$drugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$anytimeMorning.'</small></p>';}
		//if(!empty($mValue["midday"])) {
			//$drugs .= '<p class="drugTiming"><small> '.$anytimeMidday.' Mid Day</small></p>';}
		if(!empty($mValue["afternoon"])) {
			$drugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$anytimeAfternoon.'</small></p>';}
		if(!empty($mValue["evening"])) {
			$drugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$anytimeEvening.'</small></p>';}
		if(!empty($mValue["dinner"])) {
			$drugs .= '<p class="drugTiming"><img src="'.$image.'" width="14"><small> '.$anytimeDinner.'</small></p>';}
		
		$SNO = $mKey+1;
		$timings = isset($drugs) && !empty($drugs) ? $drugs : $customDrugs;
		
		$medicineData .='<tr>
			<td align="center" width="9%" style="border: 1px solid #aaa;">'.$SNO.'</td>
			<td align="center" width="30%" style="border: 1px solid #aaa;">'.$mValue["product_name"].'</td>
			<td align="center" width="10%" style="border: 1px solid #aaa;">'.$mValue["total_qty"].' '.$mValue["product_type"].'</td>
			<td align="center" width="25%" style="border: 1px solid #aaa;">'.$timings.'</td>
			<td align="center" width="13%" style="border: 1px solid #aaa;">'.$mValue["duration_no"]." ".$mValue["duration_frequency"].$dayCheck.'</td>
			<td align="center" width="13%" style="border: 1px solid #aaa;">'.$mValue["notes"].'</td>
		</tr>';} }

$testData = "";
if(!empty($testReportData)) {
$count=0;
foreach($testReportData as $key => $value) {
if($value["test_recommended"]==1) { $count++;
$testData .='<p>'.$count.". ".$value["test_name"].'</p>';} } }
//print_r($medicineData);die;
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
			<th align="left" width="20%"><h3 class="pull-left">'.$popupData["visit_date"].'</h3></th>
			<th align="right" width="60%"><p style="margin:0; margin-bottom:1px; padding:0;">Patient - '.$popupData["patient_title"].'. '.$popupData["patient_Fname"].' '.$popupData["patient_Mname"].' '.$popupData["patient_Lname"].'</p><p style="margin:0; margin-bottom:1px; padding:0;">DOB - '.$popupData["patient_dob"].'</p><p style="margin:0; margin-bottom:1px; padding:0;">Address - '.$popupData["patient_address"].', '.$popupData["patient_state"].', '.$popupData["patient_country"].'</p><small style="margin:0; display:block; padding:0;">Doctor - Dr. '.$popupData["doctor_Fname"].' '.$popupData["doctor_Mname"].' '.$popupData["doctor_Lname"].'</small></th>
			<th align="right" width="20%"><img src="'.$qrImage.'" width="90" border="0"></th>
        </tr>
	</table>
	
	

  <br>
  <hr>
  <h3 style="font-size:14px; text-transform:uppercase; margin:0; color:#003471; font-weight:normal">Observation</h3>
  <p style="margin:0; padding:0;">'.$popupData["observation"].'</p>
  <br>
  
  <div style="display:'.$prescriptionDiv.';">
  <hr>
  <h3 style="font-size:14px; text-transform:uppercase; margin:0; color:#003471; font-weight:normal">Prescription</h3>
  <table width="100%" cellpadding="10" style="border: 1px solid #aaa; width: 100%; border-collapse: collapse;">
    <thead>
      <tr bgcolor="#ccc" style="background:#ccc; color:#111; text-transform:uppercase; font-size:12px;">
        <th align="center" width="9%" style="border: 1px solid #aaa; ">S.No.</th>
        <th align="center" width="30%" style="border: 1px solid #aaa;">Medicine</th>
        <th align="center" width="10%" style="border: 1px solid #aaa;">Quantity</th>
        <th align="center" width="25%" style="border: 1px solid #aaa;">Dosage</th>
        <th align="center" width="13%" style="border: 1px solid #aaa;">Duration</th>
        <th align="center" width="13%" style="border: 1px solid #aaa;">Notes</th>
      </tr>
    </thead>
    <tbody>'.$medicineData.'
    </tbody>
  </table>
   <br>
     <br>
	</div>

  <hr>
  <h3 style="font-size:14px; text-transform:uppercase; margin:0; color:#003471; font-weight:normal">Notes for Patient</h3>
  <p style="margin:0; padding:0;">'.$popupData["patient_notes"].'</p>
    <br>
  <hr>
  <h3 style="font-size:14px; text-transform:uppercase; margin:0; color:#003471; font-weight:normal">Recommended Tests</h3>
  '.$testData.'
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