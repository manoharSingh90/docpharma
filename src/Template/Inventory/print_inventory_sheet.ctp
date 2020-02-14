<?php //echo "<pre>";
//print_r($query);die;
//require_once(PDFPATH.'/tcpdf.php');
require_once(PDFPATH.'/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Inventory Details');
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

     $n=1;
	 $productDa = '';
	 //pre($productData); die;
	 if(!empty($productData)){
           foreach($productData as $product){
           $productDa .='<tr>
		      <td align="center" width="8%" style="border: 1px solid #aaa;">'.$n.'</td>
              <td align="center" width="14%" style="border: 1px solid #aaa;">'.ucfirst($product['product_name']).'</td>
              <td align="center" width="16%" style="border: 1px solid #aaa;">'.ucfirst($product['manufacturer_name']).'</td>
              <td align="center" width="10%" style="border: 1px solid #aaa;">'.$product['batch_no'].'</td>
              <td align="center" width="15%" style="border: 1px solid #aaa;">'.$product['expiry_date'].'</td>
              <td align="center" width="10%" style="border: 1px solid #aaa;">'.$product['no_of_pack'].'</td>
              <td align="center" width="12%" style="border: 1px solid #aaa;">'.$product['quantity'].'</td>
              <td align="center" width="12%" style="border: 1px solid #aaa;">'.$product['dosages_type'].'</td>
              <td align="center" width="12%" style="border: 1px solid #aaa;">'.$product['location'].'</td>
            </tr>';
	 $n++; } }
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
<h3 style="font-size:14px; text-transform:uppercase; margin:0; color:#003471; font-weight:normal">PRODUCT INVENTORY</h3>
  <table width="100%" cellpadding="10" style="border: 1px solid #aaa; width: 100%; border-collapse: collapse;">
    <thead>
      <tr bgcolor="#ccc" style="background:#ccc; color:#111; text-transform:uppercase; font-size:12px;">
        <th align="center" width="8%" style="border: 1px solid #aaa; ">S.No.</th>
        <th align="center" width="14%" style="border: 1px solid #aaa;">Product Name</th>
        <th align="center" width="16%" style="border: 1px solid #aaa;">Manufacturer Name</th>
        <th align="center" width="10%" style="border: 1px solid #aaa;">Batch No.</th>
        <th align="center" width="15%" style="border: 1px solid #aaa;">Expiry Date</th>
        <th align="center" width="10%" style="border: 1px solid #aaa;">No. Of Pack </th>
        <th align="center" width="12%" style="border: 1px solid #aaa;">Total Quantity </th>
        <th align="center" width="12%" style="border: 1px solid #aaa;">Type</th>
        <th align="center" width="12%" style="border: 1px solid #aaa;">Location</th>
   
      </tr>
    </thead>
    <tbody>'.$productDa.'
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