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

<?php $popupData = json_decode($emailData,true); ?>

<body style="width:100% !important; color:#3c4556; background:#fff; font-family:Arial,Helvetica,sans-serif; font-size:14px; line-height:1.4;" bgcolor="#fff" yahoo="fix">

	<div style="margin-left:15px;">
	<p><b>Dear <?php echo $popupData["patient_Fname"]." ".$popupData["patient_Mname"]." ".$popupData["patient_Lname"]; ?>,</b></p>
	<p><b>Please check your prescription as mentioned below :</b></p>
	</div>

	<div class="modal-body">
				
				<?php
				if($emailData) {

				if(isset($popupData) && !empty($popupData)) {
				?>
					<div class="perviewWrap" id="printData">
						<div class="clearfix printHead">
						<table width="100%" border="0" style="border-collapse:collapse; border:none;">
						<tr>
							<td align="left">
								<h3 class="pull-left"><?php echo isset($popupData["visit_date"]) ? $popupData["visit_date"] : ""; ?></h3>
								<br/>
								<div class="pull-right text-right">
									<p>Patient - <?php echo $popupData["patient_title"].". ".$popupData["patient_Fname"]." ".$popupData["patient_Mname"]." ".$popupData["patient_Lname"]; ?></p>
									<p>DOB - <?php echo $popupData["patient_dob"]; ?></p>
									<p>Address - <?php echo $popupData["patient_address"].", ".$popupData["patient_state"].", ".$popupData["patient_country"]; ?></p>
									<small>Doctor - <?php echo "Dr. ".$popupData["doctor_Fname"]." ".$popupData["doctor_Mname"]." ".$popupData["doctor_Lname"]; ?></small>
								</div>
								</td>
							<td align="right"><br/><span class="pull-right"><img src="cid:45" width="95" border="0" style="display:block; border:none;"></span></td>
						</tr>
						</table>
						</div>
						<ul class="appoin-sub-wrap">
							<li class="appoin-sub-list">
								<h3 class="clearfix">Observation</h3>
								<p><?php echo isset($popupData["observation"]) ? $popupData["observation"] : ""; ?></p>
							</li>
							<li class="appoin-sub-list" style="display:<?php echo isset($popupData["medicine"][0]["product_name"]) && !empty($popupData["medicine"][0]["product_name"]) ? "block" : "none"; ?>">
								<h3 class="clearfix">Prescription</h3>
								<div class="tablewrap" style="min-height:200px;">
									<table class="customerTable" style="width:100%">
										<thead>
											<tr>
												<th>S.No.</th>
												<th>Medicine</th>
												<th>Quantity</th>
												<th style="padding:6px 80px;">Dosage</th>
												<th>Duration</th>
												<th>Notes</th>
											</tr>
										</thead>
										<tbody>
							
								<?php
								foreach(array_values($popupData["medicine"]) as $mKey => $mValue) {
								if(!empty($mValue["product_name"])) {
								$dayCheck = isset($mValue["day_of_week"]) && !empty($mValue["day_of_week"]) ? ' ('.$mValue["day_of_week"].')' : ""; ?>
									<tr>
										<td><?php echo $mKey+1; ?></td>
										<td><?php echo isset($mValue["product_name"]) ? $mValue["product_name"] : ""; ?></td>
										<td><?php echo isset($mValue["total_qty"]) ? $mValue["total_qty"]." ".$mValue["product_type"] : ""; ?></td>
										<td>
										
										<?php
										if(strpos(strtolower($mValue["product_type"]), 'patch') !== false)
										{
											$drugsImage = "cid:46";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'gel') !== false || strpos(strtolower($mValue["product_type"]), 'cream') !== false)
										{
											$drugsImage = "cid:47";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'inj') !== false)
										{
											$drugsImage = "cid:48";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'cap') !== false)
										{
											$drugsImage = "cid:49";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'tab') !== false)
										{
											$drugsImage = "cid:50";
										}
										else
										{
											$drugsImage = "";
										}
										?>
										
										<ul class="tablateicon" style="font-size:13px;">
											<?php if($mValue["morning"] && !empty($mValue["morning"])) { ?>
											<li style="margin-bottom:auto; display:inline-flex;"><img src="<?php echo $drugsImage; ?>" style="height:14px;"><small><?php echo $mValue["morning"]=="Anytime" ? "Take in the Morning (".$mValue["morning_quantity"]." ".$mValue["product_type"].")" : "Take in the Morning ".$mValue["morning"]." Food (".$mValue["morning_quantity"]." ".$mValue["product_type"].")"; ?></small></li>
											<div class="clearfix"></div>
											<?php } ?>
											<?php if($mValue["afternoon"] && !empty($mValue["afternoon"])) { ?>
											<li style="margin-bottom:auto; display:inline-flex;"><img src="<?php echo $drugsImage; ?>" style="height:14px;"><small><?php echo $mValue["afternoon"]=="Anytime" ? "Take in the Afternoon (".$mValue["afternoon_quantity"]." ".$mValue["product_type"].")" : "Take in the Afternoon ".$mValue["afternoon"]." Food (".$mValue["afternoon_quantity"]." ".$mValue["product_type"].")"; ?></small></li>
											<div class="clearfix"></div>
											<?php } ?>
											<?php if($mValue["evening"] && !empty($mValue["evening"])) { ?>
											<li style="margin-bottom:auto; display:inline-flex;"><img src="<?php echo $drugsImage; ?>" style="height:14px;"><small><?php echo $mValue["evening"]=="Anytime" ? "Take in the Evening (".$mValue["evening_quantity"]." ".$mValue["product_type"].")" : "Take in the Evening ".$mValue["evening"]." Food (".$mValue["evening_quantity"]." ".$mValue["product_type"].")"; ?></small></li>
											<div class="clearfix"></div>
											<?php } ?>
											<?php if($mValue["dinner"] && !empty($mValue["dinner"])) { ?>
											<li style="margin-bottom:auto; display:inline-flex;"><img src="<?php echo $drugsImage; ?>" style="height:14px;"><small><?php echo $mValue["dinner"]=="Anytime" ? "Take at Night (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")" : "Take at Night ".$mValue["dinner"]." Food (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")"; ?></small></li>
											<div class="clearfix"></div>
											<?php } ?>
											<?php if($mValue["custom_times"] && !empty($mValue["custom_times"])) {
											$customTimes = json_decode($mValue["custom_times"],true); ?>
											<?php foreach($customTimes as $timesKey => $timesValue) { ?><li style="margin-bottom:auto; display:inline-flex;"><img src="<?php echo $drugsImage; ?>" style="height:14px;"><small><?php echo $timesValue["time"]." (".$timesValue["abbreviation_meaning"].")"; ?> </small>
											<div class="clearfix"></div>
											</li>
											<?php } } ?>
											<?php if($mValue["abbreviation_meaning"] && !empty($mValue["abbreviation_meaning"])) { ?>
											<li class="drugTiming" style="margin-bottom:auto; display:inline-flex;"><img src="<?php echo $drugsImage; ?>" style="height:14px;"><small><?php echo $mValue["abbreviation_meaning"]; ?> </small>
											</li><div class="clearfix"></div>
											<?php } ?>
										</ul>
										</td>
										<td><?php echo $mValue["duration_no"]." ".$mValue["duration_frequency"].$dayCheck; ?></td>
										<td><?php echo isset($mValue["notes"]) ? $mValue["notes"] : ""; ?></td>
									</tr>
								<?php } } ?>

										</tbody>
									</table>
								</div>
							</li>
							<li class="appoin-sub-list">
								<h3 class="clearfix">Notes for Patient</h3>
								<p><?php echo isset($popupData["patient_notes"]) ? $popupData["patient_notes"] : ""; ?></p>
							</li>
							<li class="appoin-sub-list">
								<h3 class="clearfix">Recommended Tests</h3>
								<?php
								$testReportData = json_decode($testReportData,true);
								if(!empty($testReportData)) {
								$count=0;
								foreach($testReportData as $key => $value) {
								if($value["test_recommended"]==1) { $count++; ?>
								<p><?php echo $count.". ".$value["test_name"]; ?></p>
								<?php } } } ?>
							</li>
						</ul>
					</div>
				<?php } } ?>
					
				</div>
				
	<div style="margin-left:15px;">
	<p><b>Thanks.</b></p>
	</div>
	
</body>

</html>