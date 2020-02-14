
<?php
echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']);
?>

<header>
	<?php echo $this->element("left_panel"); ?>
</header>

<?php
if(isset($savedPrescription) && !empty($savedPrescription)) {
foreach($savedPrescription as $dateKey => $dateValue) {
foreach(array_values($dateValue) as $key => $value) {
if($key==0)
{
	$patientID[] = $value["patient_id"];
	$doctorName[$dateKey] = $value["doctor_name"];
} } } } ?>

	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-md-8 col-12"><a href="<?= $this->Url->build(["controller"=>"patient","action"=>"patientsDetails",$patientID[0]]); ?>" class="text-uppercase backLink"><i class="sprite backIcon"></i> Back</a>
						<div class="customHead"> <b><i class="sprite customerIcon"></i></b> <span>View Patient's Medication Records</span> </div>
					</li>
					<li class="col-md-4 col-12 text-right"><a href="<?= $this->Url->build(["controller"=>"patient","action"=>"patientsDetails",$patientID[0]]); ?>" class="btn btn-secondary text-uppercase">View Details</a></li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="customerlistWrap">
				<div class="pmrBox-option">
					<div class="row">
						<div class="col-12 col-md-8">
							<!--<div class="customerlist-Sort"> <span>Sort By :</span> <a href="javascript:void(0);" title="Most Recent">Most Recent</a> <a href="javascript:void(0);" title="Least Recent">Least Recent</a> </div>-->
						</div>
						<div class="col-12 col-md-4 text-right">
							<div class="searchBox">
								<input type="text" class="searchDoctor" placeholder="Search by doctor name">
								<button><i class="sprite searchIcon"></i></button>
							</div>
						</div>
					</div>
				</div>
				<ul class="purchasePopup pmrBox">
				<?php
				if(isset($savedPrescription) && !empty($savedPrescription)) {
				foreach($savedPrescription as $dateKey => $dateValue) { ?>
					<li class="purchaseList doctorName" id="<?php echo $doctorName[$dateKey]; ?>">
					<form method="post" action="<?php echo $this->Url->build(["controller"=>"Patient","action"=>"printPmr"]); ?>" target="_blank">
					<input type="hidden" name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
					<div class="purchaseDate toggleHead">
						<span></span><small><?php echo $dateKey; ?> - Delivery</small></div>
						<div class="toggleContent">
							<p class="purchaseDoctor clearfix">Prescribing Doctor - Dr. <?php echo $doctorName[$dateKey]; ?></p>
							<div class="tablewrap">
								<table class="customerTable" style="width:100%">
									<thead>
										<tr>
											<th>
												<div class="checkWrap">
													<input type="checkbox" class="checkAll" data-name="allcheckbox" /> </div>
											</th>
											<th>Medicine</th>
											<th>Quantity</th>
											<th>Dosage</th>
											<th>Duration</th>
											<th>Notes</th>
										</tr>
									</thead>
									<tbody>
									<?php
									if(!empty($dateValue)) {
									foreach(array_values($dateValue) as $key => $value) {
									$dayCheck = isset($value["day_of_week"]) && !empty($value["day_of_week"]) ? ' ('.$value["day_of_week"].')' : ""; ?>
									<tr>
										<td>
											<div class="checkWrap">
												<input type="checkbox" class="checkBox" name="checkbox[]" data-name="checkbox" value="<?php echo $value["ID"]; ?>" /> </div>
										</td>
										<td><?php echo isset($value["product_name"]) ? $value["product_name"] : ""; ?></td>
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
											<?php if($value["abbreviation_meaning"] && !empty($value["abbreviation_meaning"])) { ?>
											<li class="drugTiming"><img src="<?php echo strtolower($value["product_type"])=="inj" ? PATH."img/doctor/pharmacyicon/Icon-03.png" : PATH."img/doctor/pharmacyicon/Icon-05.png"; ?>"><small><?php echo $value["abbreviation_meaning"]; ?> </small>
											</li>
											<?php } ?>
										</ul>
										</td>
										<td><?php echo $value["duration_no"]." ".$value["duration_frequency"].$dayCheck; ?></td>
										<td><?php echo isset($value["notes"]) ? $value["notes"] : ""; ?></td>
									</tr>
									<?php } } ?>
									</tbody>
								</table>
							</div>
							
							<div id="datePopup_<?php echo $dateKey; ?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-lg modalpopup" style="max-width:500px; overflow:visible;">
								<div class="modal-content modalpopup-container">
									<div class="modal-header text-center modalpopup-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h2 class="modalpopup-title modalpopup-title">Date</h2>
									</div>
									<div class="modal-body clearfix">
										<div class="row pt-3 pb-3">
										<div class="col-sm-3 col-xs-12"></div>
											<div class="col-sm-6 col-xs-12">
												<div class="customformwrap">
													<label class="customLabel">Select Date<span class="starClass"> *</span></label>
													<input type="text" name="start_date" id="start_date_<?php echo $dateKey; ?>" class="custominput" placeholder="Select"/><b class="sprite clderIcon cld_icon clderIconClick"></b>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer clearfix">
										<input type="submit" class="text-uppercase btn btn-sm btn-primary" value="Submit">
									</div>
								</div>
								</div>
							</div>
							
							<a href="javascript:void(0);" class="text-uppercase btn btn-sm btn-primary" data-toggle="modal" data-target="#datePopup_<?php echo $dateKey; ?>">Print MAR</a> &nbsp;&nbsp; <a href="<?php echo $this->Url->build(["controller"=>"Pharmacy","action"=>"printdata",base64_encode($dateValue[0]["prescription_id"])]); ?>" target="_blank" class="text-uppercase btn btn-sm btn-primary">Print Invoice</a>
						</div>
					</form>
					</li>
				<?php } } ?>
				</ul>
			</div>
		</div>
	</div>
	
<script type="text/javascript">
$(document).ready(function ()
{
$("body").on("keyup",".searchDoctor",function()
{
	var search = $(this).val().toLowerCase();
	
	$('.doctorName').each(function()
	{
		var doctorName = $(this).attr("id").toLowerCase();
		if (doctorName.indexOf(search)!=-1)
		{
			$(this).show();
		}
		else
		{
			$(this).hide();
		}		
	});
});

<?php
if(isset($savedPrescription) && !empty($savedPrescription)) {
foreach($savedPrescription as $dateKey => $dateValue) { ?>
$('#start_date_<?php echo $dateKey; ?>').datetimepicker({
   format: 'DD MMM YYYY',
	minDate: moment(),
	//maxDate: moment(),
	useStrict:true,
	//inline: true,
});
<?php } } ?>

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
	
<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
<!-- FOOTER -->