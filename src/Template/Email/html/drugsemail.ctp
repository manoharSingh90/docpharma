<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<title>DocPharmRx</title>
	<style type="text/css">

.modal-body {
    position: relative;
    padding: 15px;
}

.perviewWrap .datetitle {
    margin-bottom: 0;
    color: #282828;
    text-transform: uppercase;
    font-weight: 600;
    border-bottom: 1px solid #d7d7d7;
    padding: 12px 24px;
    font-family: 'Calibri';
    margin-top: 0;
    font-size: 20px;
}

.appoin-sub-wrap .appoin-sub-list {
    position: relative;
    padding-bottom: 20px;
}
li {
    list-style: none;
    margin-bottom: 15px;
}
.perviewWrap .appoin-sub-wrap {
    margin-bottom: 0;
}
.modal-body ul {
    margin-bottom: 0;
}
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.appoin-sub-wrap {
    padding: 0px 24px;
}
.appoin-sub-wrap .appoin-sub-list .tablewrap table {
    border: 1px solid #cfcfcf;
}
.appoin-sub-wrap .appoin-sub-list h3 {
    color: #003471;
    font-size: 20px;
    text-transform: uppercase;
    font-family: 'bebas_neuebook';
    font-weight: bold;
}
.appoin-sub-wrap .appoin-sub-list p {
    color: #4c4c4c;
    line-height: 20px;
    font-size: 14px;
}
.tablewrap {
    min-height: 350px;
	padding-top: 15px;
}
.tablewrap thead {
    background: #f9f9f9;
}
.perviewWrap{
    border: 1px solid #e0e0da;
}
.appoin-sub-wrap .appoin-sub-list .orderlisting {
    margin-left: 15px;
}
tbody {
    display: table-row-group;
    vertical-align: middle;
    border-color: inherit;
}
.tablewrap tbody tr td {
    color: #696969;
    vertical-align: middle;
    font-size: 12px;
    padding: 6px 22px;
    border-bottom: 1px solid #cfcfcf;
    font-weight: 400;
}
.tablewrap thead tr th {
    border-bottom-style: dashed;
}
.tablewrap thead tr th {
    color: #b0b0b0;
    text-transform: uppercase;
    font-size: 11px;
    padding: 6px 22px;
    font-weight: normal;
    border-bottom: 1px solid #cfcfcf;
    font-weight: 600;
}
.appoin-sub-wrap .appoin-sub-list tr td small {
    display: inline-block;
    width: calc(100% - 15px);
    padding-left: 8px;
}
.printHead {
    padding: 12px 4px;
    border-bottom: 1px solid #d7d7d7;
	margin:0 24px;
	} 
.printHead h3	{
    color: #282828;
    text-transform: uppercase;
    font-weight: 600;
    font-family: 'Calibri';
    margin-top: 5px;
	margin-bottom: 0;
    font-size: 20px;
}	
.printHead p {
	margin: 0;
text-transform: uppercase;
font-size: 13px;
font-weight: 600;
}

.printHead small {
	display: block;
font-size: 12px;
opacity: .8;
}


		
		.ExternalClass {
			width: 100%;
		}
		.ExternalClass,
		.ExternalClass p,
		.ExternalClass span,
		.ExternalClass font,
		.ExternalClass td,
		.ExternalClass div {
			line-height: 100%;
		}
		
		body {
			-webkit-text-size-adjust: none;
			-ms-text-size-adjust: none;
		}
		
		body {
			margin: 0;
			padding: 0;
		}
		
		body,
		#body_style {
			width: 100% !important;
			min-height: inherit;
			color: #3c4556;
			background: #fff;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 13px;
			line-height: 1.4;
		}
		
		table {
			border-spacing: 0;
		}
		
		table td {
			border-collapse: collapse;
		}
		
		p {
			margin: 0;
			padding: 0;
			margin-bottom: 0;
		}
		
		img {
			display: block;
			border: none;
			outline: none;
			text-decoration: none;
		}
		
		table {
			border-collapse: collapse;
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}
		/****** MEDIA QUERIES ********/
		
		@media only screen and (max-width: 639px) {
			body[yahoo] .hide {
				display: none !important;
			}
			body[yahoo] .mobiwide {
				width: 25px !important;
			}
			body[yahoo] .table {
				width: 320px !important;
			}
			body[yahoo] .innertable {
				width: 280px !important;
			}
			body[yahoo] .changeColor {
				color: #505E6D;
				font-size: 9px;
			}
			body[yahoo] .fontSize {
				font-size: 12px !important;
			}
		}
	</style>
</head>

<?php $savedPatientDrugs = json_decode($savedPatientDrugs,true); ?>

<body style="width:100% !important; color:#3c4556; background:#fff; font-family:Arial,Helvetica,sans-serif; font-size:14px; line-height:1.4;" bgcolor="#fff" yahoo="fix">

	<div class="modal-body">
				
				<?php
				if(isset($savedPatientDrugs) && !empty($savedPatientDrugs)) {
				?>
					<div class="perviewWrap" id="printData">
						<div class="clearfix printHead">
						<h3>DRUG INTERACTION</h3>
						<p><?php echo $drugInteractions; ?></p>
						</div>
						<ul class="appoin-sub-wrap">
							<li class="appoin-sub-list">
								<h3 class="clearfix">Prescription</h3>
								<div class="tablewrap" style="min-height:200px;">
									<table class="customerTable" style="width:100%">
										<thead>
											<tr>
												<th>Medicine</th>
												<th>Prescribed Date</th>
												<th>Dosage / Timing</th>
											</tr>
										</thead>
										<tbody>
							
								<?php foreach(array_values($savedPatientDrugs) as $mKey => $mValue) { ?>
									<tr>
										<td><?php echo isset($mValue["product_name"]) ? $mValue["product_name"] : ""; ?></td>
										<td><?php echo isset($mValue["created_dttm"]) ? $mValue["created_dttm"] : ""; ?></td>
										<td><?php echo isset($mValue["total_qty"]) ? $mValue["total_qty"] : ""; ?> Tablets | <?php echo $mValue["duration_no"]." ".$mValue["duration_frequency"]; ?></td>
									</tr>
								<?php } ?>

										</tbody>
									</table>
								</div>
							</li>
						</ul>
					</div>
				<?php } ?>
					
				</div>
				
	<div style="margin-left:15px;">
	<p><b>Thanks.</b></p>
	</div>
	
</body>

</html>