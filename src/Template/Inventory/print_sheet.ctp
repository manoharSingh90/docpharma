<?php //echo "<pre>";
//print_r($orderForm);die;
//require_once('Appointment/TCPDF/tcpdf.php');
require_once(PDFPATH.'/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Order Form Details');
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
          $orderData = '';
           $n=1;
		  $exp_product = isset($orderForm[0]['product_id'])?explode(',',$orderForm[0]['product_id']):'';
		  $exp_quant = isset($orderForm[0]['quantity_ordered'])?explode(',',$orderForm[0]['quantity_ordered']):'';
		  //pre($produc); die;
		  
		  foreach($productData as $key=>$value){ //pre($data); die;		  		  
          $orderData .='<tr>
			<td align="center" width="9%" style="border: 1px solid #aaa;">'.$n.'</td>
			<td align="center" width="25%" style="border: 1px solid #aaa;">'.ucfirst($value["product_name"]).'</td>
			<td align="center" width="25%" style="border: 1px solid #aaa;">'.ucfirst($value["manufacturer_name"]).'</td>
			<td align="center" width="15%" style="border: 1px solid #aaa;">'.$value["num_of_pack"].'</td>
			<td align="center" width="15%" style="border: 1px solid #aaa;">'.$value["quantity_ordered"].'</td>
			<td align="center" width="15%" style="border: 1px solid #aaa;">'.$value["dosages_type"].'</td>
		    </tr>';
			$n++; }
           //pre($orderData); die;

$html = '
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
<h3 style="font-size:14px; text-transform:uppercase; margin:0; color:#003471; font-weight:normal">ORDER FORM DETAILS</h3>
  <table width="100%" cellpadding="10" style="border: 1px solid #aaa; width: 100%; border-collapse: collapse;">
    <thead>
      <tr bgcolor="#ccc" style="background:#ccc; color:#111; text-transform:uppercase; font-size:12px;">
        <th align="center" width="9%" style="border: 1px solid #aaa; ">S.No.</th>
        <th align="center" width="25%" style="border: 1px solid #aaa;">Product Name</th>
        <th align="center" width="25%" style="border: 1px solid #aaa;">Manufacturer Name</th>
        <th align="center" width="15%" style="border: 1px solid #aaa;">No. Of Pack</th>
        <th align="center" width="15%" style="border: 1px solid #aaa;">Total Quantity</th>
        <th align="center" width="15%" style="border: 1px solid #aaa;">Type</th>
   
      </tr>
    </thead>
    <tbody>'.$orderData.'
    </tbody>
  </table>';

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