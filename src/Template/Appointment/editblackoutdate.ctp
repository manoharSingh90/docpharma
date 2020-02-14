<?php
echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.js']);
?>

<body>
	<!-- HEADER -->
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
						<a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"blackoutdatelisting"]); ?>" class="backLink text-uppercase"><img src="<?php echo PATH."img/doctor/back-arrow.png" ?>"> Back</a>
						<div class="customHead"> <b><img src="images/doctor-app.png" alt="" /></b> <span>Create Blackout Date</span> </div>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="customerlistWrap clearfix">
						<div class="createappointment clearfix">
							<div class="col-lg-6 col-md-8 col-sm-12">
								<div class="slt-gender col-lg-8 col-md-8 col-sm-8">
									<div class="customformwrap">
										<label class="customLabel">Select Doctor</label>
										<select class="custominput singleselect">
											<option>Dr. Bhavya Sharma</option>
											<option>Dr. Ram Babu</option>
											<option>Dr. Ajeet Singh</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="createblackdate">
							<div class="col-lg-offset-3">
								<div class="createblacklist clearfix"> <span class="titlecolortitle">Select Date</span>
									<div class="datefromText">
										<input type="text" id="productOnlyDate" class="hiddenCld">
										<label>From</label> <span id="belowStartDate" data-id="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										<label>To</label> <span id="belowEndDate" data-id="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <b class="clderIcon sprite callCld"></b> </div>
								</div>
								<div class="clearfix createblacklist">
									<div class="timerange"> <span class="titlecolortitle">Time Range</span>
										<div class="customformwrap">
											<input type="time" class="custominput without_ampm"> </div>
										<select class="form-control locationInput">
											<option>AM</option>
											<option>PM</option>
										</select>
										<div class="customformwrap">
											<input type="time" class="custominput without_ampm"> </div>
										<select class="form-control locationInput">
											<option>AM</option>
											<option>PM</option>
										</select>
									</div>
									 <div class="timerange repeatblackoutTime"> <span class="titlecolortitle">Other Time Range</span>
										<div class="customformwrap">
											<input type="time" class="custominput without_ampm"> </div>
										<select class="form-control locationInput">
											<option>AM</option>
											<option>PM</option>
										</select>
										<div class="customformwrap">
											<input type="time" class="custominput without_ampm"> </div>
										<select class="form-control locationInput">
											<option>AM</option>
											<option>PM</option>
										</select>
									</div>
								</div>
								<div class="clearfix">
									<div class="customformwrap col-lg-6" style="padding-left: 0; padding-right: 0;">
										<label class="customLabel">Notes</label>
										<textarea class="custominput" style="min-height: 60px;"></textarea>
									</div>
								</div>
								<br/>
								<br/>
								<div class="clearfix">
									<div class="col-lg-offset-2"> <a href="#" class="btn btn-default">Cancel</a> <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#cancelModal">Save</a> </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- FOOTER -->
	<footer>
		<?php echo $this->element("footer"); ?>
	</footer>
	<!-- Modal -->
	<div id="confirmationModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Confirmation</h4> </div>
				<div class="modal-body text-center">
					<p>Are you sure you want to delete this inventory?</p>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary text-uppercase">Confirm</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Cancel Modal -->
	<div id="cancelModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">CREATE BLACKOUT DATES</h4> </div>
				<div class="modal-body text-center">
					<p>Are you sure you want to blackout appointment?</p>
					<ul class="text-left ">
						<li class="">
							<div class="customformwrap">
								<label class="customLabel">Doctor Name</label>
								<p>Dr. Bhavya Sharma</p>
							</div>
						</li>
						<li>
							<div class="customformwrap">
								<label class="customLabel">Date</label>
								<p>12 Oct, 2018 - 18 Oct, 2018</p>
							</div>
						</li>
						<li>
							<div class="customformwrap">
								<label class="customLabel">Time</label>
								<p>10AM - 12PM, 7PM - 10PM</p>
							</div>
						</li>
					</ul>
				</div>
				<div class="modal-footer text-center"> <a href="blackout-date.html"	class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</a> <a href="blackout-date.html" class="btn btn-primary text-uppercase">Confirm</a> </div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function () {
			$(".singleselect").select2();
			$('#customerTable').DataTable({
				responsive: true
				, info: false
				, paging: false
				, searching: false
				, ordering: false
			});
			$('.menutoggle').click(function () {
				$(this).toggleClass('active');
				$('header').toggleClass('active');
			});
			$('.otherdocClick').click(function () {
				$('.repeatblackoutTime').addClass('active');
			});
			$('.clderIconClick').click(function () {
				$('#birthdateval').click();
			});
			$("#birthdateval").daterangepicker({
				autoUpdateInput: true
				, singleDatePicker: true
				, locale: {
					format: 'DD MMM YYYY'
				}
			});
			$("#birthdateval").on('apply.daterangepicker', function (ev, picker) {
				$(this).val(picker.startDate.format('DD MMM YYYY'));
			});
			$("#birthdateval").on('cancel.daterangepicker', function (ev, picker) {
				$(this).val('');
			});
			$('.singleclick').hide()
			$('.showrangedate').hide();
			$('.multiclick').click(function () {
				$(this).hide();
				$('.singleclick').show();
				$('.showrangedate').show();
				$('.showsingledate').hide();
				$('#daterange').click();
			});
			$('.singleclick').click(function () {
				$(this).hide();
				$('.showrangedate').hide();
				$('.showsingledate').show();
				$('.multiclick').show();
				$('#birthdateval').click();
			});
			var $abovestartDate = $("#aboveStartDate").attr("data-id");
			var $aboveendDate = $("#aboveEndDate").attr("data-id");
			$('#overAllDate').daterangepicker({
				"autoApply": true
				, "minDate": 0
				, "startDate": $abovestartDate
				, "endDate": $aboveendDate
				, "maxDate": moment()
			, }, function (start, end, label) {
				console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
				$("#aboveStartDate").text(start.format('DD MMM YYYY'))
				$("#aboveEndDate").text(end.format('DD MMM YYYY'))
			});
			var $belowstartDate = $("#aboveStartDate").attr("data-id");
			var $belowendDate = $("#aboveEndDate").attr("data-id");
			$('#productOnlyDate').daterangepicker({
				"autoApply": true
				, "minDate": moment()
				, "startDate": $belowstartDate
				, "endDate": $belowendDate
					//, "maxDate": moment()
					
			, }, function (start, end, label) {
				console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
				$("#belowStartDate").text(start.format('DD MMM YYYY'))
				$("#belowEndDate").text(end.format('DD MMM YYYY'))
			});
			$(document).on("click", ".callCld", function () {
				$(this).closest(".datefromText").find("input").trigger("click");
			});
			$('.appradio input').each(function () {
				if ($(this).is(':checked')) {
					$(this).parents('tr').addClass('active');
				}
				else {
					$(this).parents('tr').removeClass('active');
				}
			});
			$('.appradio input').click(function () {
				if ($(this).is(':checked')) {
					$(this).parents('tr').addClass('active');
				}
				else {
					$(this).parents('tr').removeClass('active');
				}
			});
			$("#daterange").keyup(function () {
				if ($(this).val().length == 0) {
					$('#daterange').removeClass('active');
				}
				else {
					$('#daterange').addClass('active');
				}
			});
		});
	</script>
</body>
