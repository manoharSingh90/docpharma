
<?php
echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.js']);
?>

<body>
	
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
	<form method="post" action="<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"save"]); ?>" enctype="multipart/form-data">
	
	<input type="hidden" name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
	
	<input type="hidden" name="id" value="<?php echo $rescheduleData["id"]; ?>">
	<input type="hidden" name="doctor_id" class="doctor_id" value="<?php echo $rescheduleData["doctor_id"]; ?>">
	<input type="hidden" name="patient_id" class="patient_id" value="<?php echo $rescheduleData["patient_id"]; ?>">
	
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<a href="<?php echo $this->url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" class="backLink text-uppercase"><img src="<?php echo PATH."img/doctor/back-arrow.png" ?>"> Back</a>
						<div class="customHead"> <b><img src="<?php echo PATH."img/doctor/doctor-app.png" ?>" alt="" /></b> <span>Reschedule Appointment</span> </div>
					</li>
					<li class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pull-right">
						<div class="headLink"> 
							<a href="javascript:void(0);" class="pull-right btn btn-primary text-uppercase saveReschedule" data-toggle="modal" data-target="#saveModal-popup">Save </a>
							<a href="javascript:void(0);" data-toggle="modal" data-target="#cancelModal" class="pull-right btn btn-default text-uppercase">Cancel</a> 
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="customerlistWrap">
						<p class="curretn-appointment">
							Current Appointment Scheduled on <?php echo $rescheduleData["appointment_date"]." at ".$rescheduleData["appointment_time"]; ?>
						</p>
						
						<div class="fixdoctor">
						<div class="customformwrap">
									<label class="customLabel">Doctor Name</label>
									<p>Dr. <?php echo isset($rescheduleData["doctor_detail"]["first_name"]) ? $rescheduleData["doctor_detail"]["first_name"]." ".$rescheduleData["doctor_detail"]["middle_name"]." ".$rescheduleData["doctor_detail"]["last_name"] : ""; ?></p>
								</div>
						</div>
						<div class="createappointment rescheduledview clearfix">
							<div class="col-lg-2 col-md-2 col-sm-6">
								<div class="customformwrap">
									<label class="customLabel">FULL NAME</label>
									<p><?php echo isset($rescheduleData["patient_detail"]["fname"]) ? $rescheduleData["patient_detail"]["fname"]." ".$rescheduleData["patient_detail"]["mname"]." ".$rescheduleData["patient_detail"]["lname"]. " (".$rescheduleData["patient_detail"]["title"].")" : ""; ?></p>
								</div>
							</div>
							
							<?php
							$currentYear = date("Y");
							$dob = explode(" ",$rescheduleData["patient_detail"]["dob"]); ?>
							<div class="col-lg-2 col-md-2 col-sm-6">
								<div class="customformwrap">
									<label class="customLabel">AGE (Date Of Birth)</label>
									<p><?php echo $currentYear - $dob[2]; ?> (<?php echo isset($rescheduleData["patient_detail"]["dob"]) ? $rescheduleData["patient_detail"]["dob"] : ""; ?>)</p>
								</div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-6">
								<div class="customformwrap">
									<label class="customLabel">Gender</label>
									<p><?php echo isset($rescheduleData["patient_detail"]["gender"]) ? $rescheduleData["patient_detail"]["gender"] : ""; ?></p>
								</div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-6">
								<div class="customformwrap">
									<label class="customLabel">PHONE NUMBER</label>
									<?php
									$explodeCode = isset($rescheduleData["patient_detail"]["country_code"]) ? explode(",",$rescheduleData["patient_detail"]["country_code"]) : "";
									$explodeNumber = isset($rescheduleData["patient_detail"]["m_number"]) ? explode(",",$rescheduleData["patient_detail"]["m_number"]) : "";
									
									if(isset($explodeCode) && !empty($explodeCode)) {
									foreach($explodeCode as $key => $value) { ?>
										<p><?php echo $value." ".$explodeNumber[$key]; ?></p>
									<?php } } ?>
									
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="customformwrap">
									<label class="customLabel">Comments</label>
									<p><?php echo isset($rescheduleData["comments"]) ? $rescheduleData["comments"] : ""; ?></p>
								</div>
							</div>

						</div>
						<div class="customerlistHead text-center"> <span>Date of appointment</span>&nbsp;&nbsp;
							 <div class="searchBox calenderwith">
								<input type="text" id="birthdateval" name="appointment_date" placeholder="Search by doctor name">
								<button><b class="sprite clderIcon cld_icon clderIconClick"></b></button>
							</div>
						</div>

						<i class="noties">Select a time slot for the appointment</i>
						<div class="tablewrap ">
							<table id="customerTable" style="width:100%">
								<thead>
									<tr>
										<th><span class="alignTh">Time</span></th>
										<th>Patient Name</th>
										<th>Patient Contact</th>
										<th>Comments</th>
									</tr>
								</thead>
								
					<tbody id="timingData">
					<?php
					if(isset($doctorTiming) && !empty($doctorTiming)) {
					foreach($doctorTiming as $key => $value) {
						
						$count = 0;
						for($time=strtotime($value["start_time"]." ".$value["start_meridiem"]); $time<=strtotime($value["end_time"]." ".$value["end_meridiem"]); $time+=(60*$value["duration_time"]))
						{ $count++; ?>
						
						<?php if(empty($savedTiming)) { ?>
							<tr>
								<td>
									<div class="customradio appradio">
										<label>
											<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
											<span class="chengecolor"><?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?></span>
										</label>
									</div>
								</td>
								<td><span class="yettitle noAppointmentDiv noAppointmentDiv_<?php echo $key.$count; ?>">No Appointment yet</span></td>
								<td><span class="chengecolor">&nbsp;</span></td>
								<td>
									<div class="form-group textareaDiv textareaDiv_<?php echo $key.$count; ?>" style="display: none;">
										<textarea class="form-control" name="comments[]"></textarea>
									</div>
								</td>
							</tr>
						<?php }
						
						else { ?>
						
							<?php if(in_array(date('h:i A', strtotime(gmdate("H:i",$time))),array_column($savedTiming, 'appointment_time')) && in_array($currentDate,array_column($savedTiming, 'appointment_date'))) {
								
							$checkKey = array_keys(array_column($savedTiming, 'appointment_time'), date('h:i A', strtotime(gmdate("H:i",$time))));
							$checkKey = $checkKey[0];
							?>
							<tr>
								<td>
									<span class="alignTd"><?php echo isset($savedTiming[$checkKey]["appointment_time"]) ? $savedTiming[$checkKey]["appointment_time"] : ""; ?></span>
								</td>
								<td>
									<span class="userName chengecolor"><?php echo isset($savedTiming[$checkKey]["patient_details"]["fname"]) ? $savedTiming[$checkKey]["patient_details"]["fname"]." ".$savedTiming[$checkKey]["patient_details"]["mname"]." ".$savedTiming[$checkKey]["patient_details"]["lname"] : ""; ?></span>
								</td>
								<td>
									<span class="chengecolor"><?php echo isset($savedTiming[$checkKey]["patient_details"]["m_number"]) ? $savedTiming[$checkKey]["patient_details"]["m_number"] : ""; ?></span>
								</td>
								<td><?php echo isset($savedTiming[$checkKey]["comments"]) ? $savedTiming[$checkKey]["comments"] : ""; ?></td>
							</tr>
							<?php }
							
							else { ?>
							<tr>
								<td>
									<div class="customradio appradio">
										<label>
											<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
											<span class="chengecolor"><?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?></span>
										</label>
									</div>
								</td>
								<td><span class="yettitle noAppointmentDiv noAppointmentDiv_<?php echo $key.$count; ?>">No Appointment yet</span></td>
								<td><span class="chengecolor">&nbsp;</span></td>
								<td>
									<div class="form-group textareaDiv textareaDiv_<?php echo $key.$count; ?>" style="display: none;">
										<textarea class="form-control" name="comments[]"></textarea>
									</div>
								</td>
							</tr>
							<?php } ?>
						
						<?php }
						
					} } } ?>
					</tbody>
								
							</table>
						</div>
					 </div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="saveModal-popup" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Save APPOINTMENT</h4>
				</div>
				<div class="modal-body text-center">
					<p>Are you sure you want to reschedule your appointment?</p>
				</div>
				<div class="modal-footer text-center">
					<a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">No</a>
					<input type="submit" class="btn btn-primary text-uppercase" value="Yes">
				</div>
			</div>
		</div>
	</div>
	
	</form>
	
	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
	 
<div id="cancelModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reschedule APPOINTMENT</h4>
      </div>
      <div class="modal-body text-center">
        <p>Are you sure you don't want to reschedule your appointment?</p>
      </div>
      <div class="modal-footer text-center">
        <a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">No</a>
        <a href="<?php echo $this->url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" class="btn btn-primary text-uppercase">Yes</a>
      </div>
    </div>
  </div>
</div>

	<script type="text/javascript">
$(document).ready(function()
{
	var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
	
	$("body").on("click",".appointment_time",function()
	{
		var radioID = $(this).attr("data-id");
		$(".noAppointmentDiv").css("display","block");
		$(".textareaDiv").css("display","none");
		
		$(".noAppointmentDiv_"+radioID).css("display","none");
		$(".textareaDiv_"+radioID).css("display","block");
	});
	
	$("body").on("click",".saveReschedule",function()
	{
		if(!$('.appointment_time').is(':checked'))
		{
			alert("Select an appointment");
			return false;
		}
	});
	
	$("body").on("change","#birthdateval",function()
	{	
		var weekday = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

		var a = new Date($("#birthdateval").val());
		
		var day = weekday[a.getDay()];
		
		var doctorID = $(".doctor_id").val();
		
		var currentDate = $("#birthdateval").val();

		$.ajax({
			url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"getSlotData"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":doctorID, "getDay":day, "currentDate":currentDate},
			success: function(data)
			{
				$("#timingData").html(data);
			}   
		});

	});
	
	$(".singleselect").select2();
	$('#customerTable').DataTable({
		responsive: true,
		info: false,
		paging: false,
		searching: false,
		ordering: false
	});
	$('.menutoggle').click(function() {
		$(this).toggleClass('active');
		$('header').toggleClass('active');
	});
	$('.searchBox').click(function() {
		$('#birthdateval').click();
	});
	var today = new Date();
	$("#birthdateval").daterangepicker({
		autoUpdateInput: true,
		singleDatePicker: true,
		minDate: today,
		locale: {
			format: 'DD MMM YYYY'
		}
	});

	$('.appradio input').each(function() {
		if ($(this).is(':checked')) {
			$(this).parents('tr').addClass('active');
		} else {
			$(this).parents('tr').removeClass('active');
		}
	});
	$('.appradio input').click(function() {
		if ($(this).is(':checked')) {
			$(this).parents('tr').addClass('active');
		} else {
			$(this).parents('tr').removeClass('active');
		}
	});


});
	</script>
</body>