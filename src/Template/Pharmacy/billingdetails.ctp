
<html>

<body>

	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-md-8 col-12">
						<a href="<?php echo $this->Url->build(["controller"=>"Pharmacy","action"=>"listing"]); ?>" class="text-uppercase backLink"><i class="sprite backIcon"></i> Back</a>
						<div class="customHead">
							<b><i class="sprite customerIcon"></i></b>
							<span>View Billing Details</span>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="customerlistWrap">
				<div class="pmrBox-option"></div>
				<ul class="purchasePopup pmrBox">
					<li class="purchaseList">
					<?php
					$s = $savedPrescription[0]["created_dttm"];
					$dt = new DateTime($s);
					$date = $dt->format('d M Y');
					?>
				
				<div>
					<div class="row pt-3 pb-4">
						<div class="col-sm-12 col-md-6">
							<div class="purchaseDate"><p class="text-big"><?php echo $date; ?></p></div>
						</div>
						<div class="col-sm-12 col-md-6">
							<div class="patient-Info text-right">
								<p>Patient - <?php echo $savedPrescription[0]["patient_name"]; ?></p>
								<p>DOB - <?php echo $savedPrescription[0]["patient_dob"]; ?></p>
								<p>Address - <?php echo $savedPrescription[0]["patient_address"]; ?></p>
								<small>Doctor - Dr. <?php echo $savedPrescription[0]["doctor_name"]; ?></small>
							</div>
						</div>
					</div>
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
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(isset($savedPrescription) && !empty($savedPrescription)) {
							foreach($savedPrescription as $key => $value) {
							$dayCheck = isset($value["day_of_week"]) && !empty($value["day_of_week"]) ? ' ('.$value["day_of_week"].')' : ""; ?>
								<tr>
									<td><?php echo $key+1; ?></td>
									<td>
										<?php echo isset($value["product_name"]) ? $value["product_name"] : ""; ?>
										<span class="clearfix"></span>
										(<?php
										if(isset($value["inventory"]) && !empty($value["inventory"])) {
										foreach($value["inventory"] as $inventoryKey => $inventoryValue) { ?>
										<span class="<?php echo $inventoryKey!=0 ? "clearfix" : ""; ?>"> * <?php echo $inventoryValue["batch_no"]." (".$inventoryValue["quantity"].") - ".$inventoryValue["expiry_date"]; ?></span>
										<?php } } ?>)
									</td>
									<td><?php echo $value["total_qty"]." ".$value["product_type"]; ?></td>
									<td>
									<ul class="tablateicon">
										<?php if($value["morning"] && !empty($value["morning"])) { ?>
										<li class="drugTiming"><img src="<?php echo strtolower($value["product_type"])=="inj" ? PATH."img/doctor/pharmacyicon/Icon-03.png" : PATH."img/doctor/pharmacyicon/Icon-05.png"; ?>"><small><?php echo $value["morning"]=="Anytime" ? "Take in the Morning (".$value["morning_quantity"]." ".$value["product_type"].")" : "Take in the Morning ".$value["morning"]." Food (".$value["morning_quantity"]." ".$value["product_type"].")"; ?> </small></li>
										<?php } ?>
										<?php if($value["afternoon"] && !empty($value["afternoon"])) { ?>
										<li class="drugTiming"><img src="<?php echo strtolower($value["product_type"])=="inj" ? PATH."img/doctor/pharmacyicon/Icon-03.png" : PATH."img/doctor/pharmacyicon/Icon-05.png"; ?>"><small><?php echo $value["afternoon"]=="Anytime" ? "Take in the Afternoon (".$value["afternoon_quantity"]." ".$value["product_type"].")" : "Take in the Afternoon ".$value["afternoon"]." Food (".$value["afternoon_quantity"]." ".$value["product_type"].")"; ?> </small></li>
										<?php } ?>
										<?php if($value["evening"] && !empty($value["evening"])) { ?>
										<li class="drugTiming"><img src="<?php echo strtolower($value["product_type"])=="inj" ? PATH."img/doctor/pharmacyicon/Icon-03.png" : PATH."img/doctor/pharmacyicon/Icon-05.png"; ?>"><small><?php echo $value["evening"]=="Anytime" ? "Take in the Evening (".$value["evening_quantity"]." ".$value["product_type"].")" : "Take in the Evening ".$value["evening"]." Food (".$value["evening_quantity"]." ".$value["product_type"].")"; ?> </small></li>
										<?php } ?>
										<?php if($value["dinner"] && !empty($value["dinner"])) { ?>
										<li class="drugTiming"><img src="<?php echo strtolower($value["product_type"])=="inj" ? PATH."img/doctor/pharmacyicon/Icon-03.png" : PATH."img/doctor/pharmacyicon/Icon-05.png"; ?>"><small><?php echo $value["dinner"]=="Anytime" ? "Take in the Dinner (".$value["dinner_quantity"]." ".$value["product_type"].")" : "Take in the Dinner ".$value["dinner"]." Food (".$value["dinner_quantity"]." ".$value["product_type"].")"; ?> </small></li>
										<?php } ?>
										<?php if($value["custom_times"] && !empty($value["custom_times"])) {
										$customTimes = json_decode($value["custom_times"],true); ?>
										<?php foreach($customTimes as $timesKey => $timesValue) { ?><li class="drugTiming"><img src="<?php echo strtolower($value["product_type"])=="inj" ? PATH."img/doctor/pharmacyicon/Icon-03.png" : PATH."img/doctor/pharmacyicon/Icon-05.png"; ?>">
										<small><?php echo $timesValue["time"]." (".$timesValue["abbreviation_meaning"].")"; ?></small></li>
										<?php } } ?>
										<?php if($value["abbreviation_meaning"] && !empty($value["abbreviation_meaning"])) { ?>
										<li class="drugTiming"><img src="<?php echo strtolower($value["product_type"])=="inj" ? PATH."img/doctor/pharmacyicon/Icon-03.png" : PATH."img/doctor/pharmacyicon/Icon-05.png"; ?>"><small><?php echo $value["abbreviation_meaning"]; ?> </small>
										</li>
										<?php } ?>
									</ul>
									</td>
									<td><?php echo $value["duration_no"]." ".$value["duration_frequency"].$dayCheck; ?></td>
									<td><?php echo isset($value["notes"]) ? $value["notes"] : ""; ?></td>
									<td><?php echo isset($value["unit_price_total"]) ? "INR ".$value["unit_price_total"] : ""; ?></td>
								</tr>
							<?php } } ?>
							</tbody>
						</table>
					</div>
					<!--<a href="#" class="text-uppercase btn btn-sm btn-primary">Print MAR</a> &nbsp;&nbsp; <a href="#" class="text-uppercase btn btn-sm btn-primary">Print Invoice</a>-->
					
					<a href="<?php echo $this->Url->build(["controller"=>"Pharmacy","action"=>"printdata",base64_encode($savedPrescription[0]["prescription_id"])]); ?>" target="_blank" class="text-uppercase btn btn-sm btn-primary">Print</a>
				</div>
				</li>
				</ul>
			</div>
		</div>
	</div>
	
	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
	<script type="text/javascript">
		$(document).ready(function () {
			$('.customerTable').DataTable({
					responsive: true
				, info: false
				, paging: false
				, searching: false
				, ordering: false
			});
			
			$('.viewhistory').click(function () {
				$('#purchaseHistory').modal();
			});
			$(document).on("click", ".menutoggle", function (e) {
				e.preventDefault();
				$(this).toggleClass('active');
				$('header').toggleClass('active');
			});
			$('.chkValue').keyup(function () {
				if ($(this).val().length == 0) {
					$(this).parents('.customformwrap').find('.addprod').removeClass('active');
				}
				else {
					$(this).parents('.customformwrap').find('.addprod').addClass('active');
				}
			});
			// EDIT CLICK
			$('.editclickevent').click(function () {
				$(this).parents('li').find('input, select').removeAttr('disabled');
				$(this).remove();
			});
			// CHECKBOX TOGGLE FUNCTION
			$('[data-name="allcheckbox"]').on('click', function () {
				var $this = $(this);
				var $checkbox = $this.closest('.tablewrap').find('[data-name="checkbox"]');
				if (this.checked) {
					$checkbox.each(function () {
						this.checked = true;
					});
				}
				else {
					$checkbox.each(function () {
						this.checked = false;
					});
				}
			});
			$('[data-name="checkbox"]').on('click', function () {
				var $this = $(this);
				var $total = $this.closest('.tablewrap').find('[data-name="checkbox"]');
				var $checked = $this.closest('.tablewrap').find('[data-name="checkbox"]:checked');
				var $allcheckbox = $this.closest('.tablewrap').find('[data-name="allcheckbox"]');
				if ($checked.length == $total.length) {
					$allcheckbox.prop('checked', true);
					console.log('ALL');
				}
				else if ($checked.length > 0) {
					console.log($checked.length);
				}
				else {
					$allcheckbox.prop('checked', false);
					console.log('ZERO');
				}
			});
			$(document).on('click', '.toggleHead', function (e) {
				e.preventDefault();
				$(this).toggleClass('active');
				$(this).closest('li').find('.toggleContent').slideToggle();
			});
		});
	</script>
</body>

</html>