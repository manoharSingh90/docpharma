<div class="tabingcolender">
	<!--<div class="searchBox calenderwith previousCalender">
		<input type="text" id="previousCalender" placeholder="Search by doctor name">
		<button><b class="sprite clderIcon cld_icon clderIconClick"></b></button>
	</div>-->
</div>

<div class="customerlistWrap radiusleft0">
	<ul class="appoin-wrap">
		<?php
		if(isset($previousData) && !empty($previousData)) {

		$popupData = array();
		$previousValue = "";
		$addKey = 0;
		foreach($previousData as $key => $value)
		{
			if($previousValue!=$value["visit_date"] && $key!=0)
			{
				$addKey++;
			}
		
			$popupData[$addKey]["appointment_id"] = $value["appointment_id"];
			$popupData[$addKey]["observation"] = $value["observation"];
			$popupData[$addKey]["patient_notes"] = $value["patient_notes"];
			$popupData[$addKey]["visit_date"] = $value["visit_date"];
			$popupData[$addKey]["medicine"][$key]["notes"] = $value["notes"];
			$popupData[$addKey]["medicine"][$key]["product_name"] = $value["product_name"];
			$popupData[$addKey]["medicine"][$key]["product_type"] = $value["product_type"];
			$popupData[$addKey]["medicine"][$key]["dosage_qty"] = $value["dosage_qty"];
			$popupData[$addKey]["medicine"][$key]["duration_no"] = $value["duration_no"];
			$popupData[$addKey]["medicine"][$key]["duration_frequency"] = $value["duration_frequency"];
			$popupData[$addKey]["medicine"][$key]["total_qty"] = $value["total_qty"];
			$popupData[$addKey]["medicine"][$key]["morning"] = $value["morning"];
			$popupData[$addKey]["medicine"][$key]["afternoon"] = $value["afternoon"];
			$popupData[$addKey]["medicine"][$key]["evening"] = $value["evening"];
			$popupData[$addKey]["medicine"][$key]["dinner"] = $value["dinner"];
			$popupData[$addKey]["medicine"][$key]["morning_quantity"] = $value["morning_quantity"];
			$popupData[$addKey]["medicine"][$key]["afternoon_quantity"] = $value["afternoon_quantity"];
			$popupData[$addKey]["medicine"][$key]["evening_quantity"] = $value["evening_quantity"];
			$popupData[$addKey]["medicine"][$key]["dinner_quantity"] = $value["dinner_quantity"];
			$popupData[$addKey]["medicine"][$key]["custom_times"] = $value["custom_times"];
			$popupData[$addKey]["medicine"][$key]["abbreviation"] = $value["abbreviation"];
			$popupData[$addKey]["medicine"][$key]["abbreviation_meaning"] = $value["abbreviation_meaning"];
			
			$previousValue = $value["visit_date"];
		} ?>
		
		<?php foreach($popupData as $key => $value) { ?>
		<li class="appoinList">
						<a style="display:none;" class="pull-right printericon printBlank" href="<?php echo $this->url->build(["controller"=>"Appointment","action"=>"printdata",base64_encode($value["appointment_id"])]); ?>" target="_blank"><b class="sprite printIcon"></b></a>
			<div class="appoinDate toggleHead">
				<span class="previousDateData"><?php echo isset($value["visit_date"]) ? $value["visit_date"] : ""; ?></span>

			</div>
			<div class="toggleContent">
				<ul class="appoin-sub-wrap">
					<li class="appoin-sub-list">
						<h3 class="clearfix">Observation</h3>
						<p><?php echo isset($value["observation"]) ? $value["observation"] : ""; ?></p>
						<!--<div class="doc-reperts">
							<h4>Reports</h4>
							<span>
							<?php
							$imageName = isset($value["test_report_filename"]) ? explode(",",$value["test_report_filename"]) : "";
							?>
							<img src="<?php echo PATH."img/doctor/attachedfile.png" ?>" />
							<?php echo isset($imageName[1]) && !empty($imageName[1]) ? $imageName[1] : ""; ?>
							</span>
						</div>-->
					</li>
					<li class="appoin-sub-list">
						<h3 class="clearfix">Prescription</h3>
						<div class="tablewrap">
							<table class="customerTable" style="width:100%">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Medicine</th>
										<th>Quantity</th>
										<th>Dosage</th>
										<th>Duration</th>
										<th>Notes</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach(array_values($value["medicine"]) as $pKey => $pValue) { ?>
									<tr>
										<td><?php echo $pKey+1; ?></td>
										<td><?php echo isset($pValue["product_name"]) ? $pValue["product_name"] : ""; ?></td>
										<td><?php echo $pValue["total_qty"]." ".$pValue["product_type"]; ?></td>
										<td>
										
										<?php
										if(strpos(strtolower($pValue["product_type"]), 'patch') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-01.png";
										}
										else if(strpos(strtolower($pValue["product_type"]), 'gel') !== false || strpos(strtolower($pValue["product_type"]), 'cream') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-02.png";
										}
										else if(strpos(strtolower($pValue["product_type"]), 'inj') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-03.png";
										}
										else if(strpos(strtolower($pValue["product_type"]), 'cap') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-04.png";
										}
										else if(strpos(strtolower($pValue["product_type"]), 'tab') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-05.png";
										}
										else
										{
											$drugsImage = "";
										} ?>
										
										<ul class="tablateicon">
											<?php if($pValue["morning"] && !empty($pValue["morning"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $pValue["morning"]=="Anytime" ? "Take in the Morning (".$pValue["morning_quantity"]." ".$pValue["product_type"].")" : "Take in the Morning ".$pValue["morning"]." Food (".$pValue["morning_quantity"]." ".$pValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($pValue["afternoon"] && !empty($pValue["afternoon"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $pValue["afternoon"]=="Anytime" ? "Take in the Afternoon (".$pValue["afternoon_quantity"]." ".$pValue["product_type"].")" : "Take in the Afternoon ".$pValue["afternoon"]." Food (".$pValue["afternoon_quantity"]." ".$pValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($pValue["evening"] && !empty($pValue["evening"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $pValue["evening"]=="Anytime" ? "Take in the Evening (".$pValue["evening_quantity"]." ".$pValue["product_type"].")" : "Take in the Evening ".$pValue["evening"]." Food (".$pValue["evening_quantity"]." ".$pValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($pValue["dinner"] && !empty($pValue["dinner"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $pValue["dinner"]=="Anytime" ? "Take at Night (".$pValue["dinner_quantity"]." ".$pValue["product_type"].")" : "Take at Night ".$pValue["dinner"]." Food (".$pValue["dinner_quantity"]." ".$pValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($pValue["custom_times"] && !empty($pValue["custom_times"])) {
											$customTimes = json_decode($pValue["custom_times"],true); ?>
											<?php foreach($customTimes as $timesKey => $timesValue) { ?><li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $timesValue["time"]." (".$timesValue["abbreviation_meaning"].")"; ?> </small>
											</li>
											<?php } } ?>
											<?php if($pValue["abbreviation_meaning"] && !empty($pValue["abbreviation_meaning"])) {
											$abbreviationData = explode(",",$pValue["abbreviation_meaning"]); ?>
											<?php foreach($abbreviationData as $abbreviationKey => $abbreviationValue) { ?><li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $abbreviationValue; ?> </small>
											</li>
											<?php } } ?>
										</ul>
										</td>
										<td><?php echo $pValue["duration_no"]." ".$pValue["duration_frequency"]; ?></td>
										<td><?php echo isset($pValue["notes"]) ? $pValue["notes"] : ""; ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</li>
					<li class="appoin-sub-list">
						<h3 class="clearfix">Notes for Patient</h3>
						<p><?php echo isset($value["patient_notes"]) ? $value["patient_notes"] : ""; ?></p>
					</li>
					<li class="appoin-sub-list">
						<h3 class="clearfix">Recommended Tests</h3>
						<?php
						if(!empty($allReportsData)) {
						$count=0;
						foreach($allReportsData as $key => $value) {
						if($value["test_recommended"]==1) { $count++; ?>
						<ol>
							<li>
								<p><?php echo $count.". ".$value["test_name"]; ?></p>
							</li>
						</ol>
						<?php } } } ?>
					</li>
				</ul>
			</div>
		</li>
		<?php } }
		else { ?>
		<li class="appoin-sub-list">
			<div class="tablewrap">
				<table class="customerTable" style="width:100%">
					<thead>
						<tr>
							<th> S.No.</th>
							<th>Medicine</th>
							<th>Dosage</th>
							<th>Timing</th>
							<th>Duration</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "No data available in table"; ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</li>
		<?php } ?>
	</ul>
</div>