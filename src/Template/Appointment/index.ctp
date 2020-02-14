
<body>
	
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
	<form method="post" action="<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"save"]); ?>" enctype="multipart/form-data">
	
	<input type="hidden" name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
	
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" class="backLink text-uppercase"><img src="<?php echo PATH."img/doctor/back-arrow.png" ?>"> Back</a>
						<div class="customHead"> <b><img src="<?php echo PATH."img/doctor/doctor-app.png" ?>" alt="" /></b> <span>Create New Appointment</span> </div>
					</li>
					<li class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pull-right">
						<div class="headLink">
							<input type="submit" class="pull-right btn btn-primary text-uppercase saveAppointment" value="Save">
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
						<?php if($this->request->getSession()->read('role_id')==1) { ?>
						<div class="clearfix createnewdoctor">
							<div class="slt-gender col-lg-4 col-md-4 col-sm-8">
								<div class="customformwrap">
									<label class="customLabel">Doctor Name<span class="starClass"> *</span></label>
									<select class="custominput singleselect doctor_id mandatory" name="doctor_id">
										<option value="">Select Doctor</option>
										<?php
										if(isset($doctorData) && !empty($doctorData)) {
										foreach($doctorData as $key => $value) { ?>
											<option value="<?php echo $value["id"]; ?>">
												Dr. <?php echo $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"]; ?>
											</option>
										<?php } } ?>
									</select>
									<span class="errorClass doctorErrorClass" style="display:none;">Field Required</span>
								</div>
							</div>
							
							<div class="slt-gender col-lg-8 col-md-8 col-sm-8 getDoctorTimings"></div>
							
						</div>
						<br>
						<hr/>
						<?php }
						else { ?>
						<input type="text" class="doctor_id" name="doctor_id" value="<?php echo isset($doctorData[0]["id"]) ? $doctorData[0]["id"] : ""; ?>" style="display:none;" >
						
						<div class="clearfix" style="padding:20px 20px;">
							<div class="customformwrap">
								<h4 class="text-primary h5 text-uppercase" style="color:#2587f9;">Doctor Timings</h4>
								<div class="slt-gender getDoctorTimings"></div>
							</div>
						</div>
						<hr/>
						<?php } ?>
						
						<input type="hidden" class="patientID" value="<?php echo isset($_SESSION["patientID"]) ? $_SESSION["patientID"] : ""; ?>" >
						<div class="createappointment clearfix">
							<div class="col-lg-7 col-md-7 col-sm-12">
								<div class="slt-gender col-lg-8 col-md-8 col-sm-8">
									<div class="customformwrap">
										<label class="customLabel">Full Name<span class="starClass"> *</span></label>
										<select class="custominput singleselect patient_id mandatory" name="patient_id">
											<option value="">Select Patient</option>
											<?php
											if(isset($patientData) && !empty($patientData)) {
											foreach($patientData as $key => $value) { ?>
												<option value="<?php echo $value["id"]; ?>" <?php echo isset($_SESSION["patientID"]) && $_SESSION["patientID"]==$value["id"] ? "selected" : ""; ?> >
													<?php echo $value["fname"]." ".$value["mname"]." ".$value["lname"]; ?>
												</option>
											<?php } } ?>
										</select>
										<span class="errorClass patientErrorClass" style="display:none;">Field Required</span>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4"><div class="link-href" style="cursor:pointer;" data-toggle="modal" data-target="#createpatient-Modal">Create new patient</div></div>
							</div>
							<div class="col-lg-1 col-md-1 col-sm-4 col-xs-6">
							<div class="customformwrap">
										<label class="customLabel">Age</label>
										<p class="patientAge"></p>
									</div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
							<div class="customformwrap">
										<label class="customLabel">Gender</label>
										<p class="patientGender"></p>
									</div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-6">
							<div class="customformwrap">
										<label class="customLabel">Phone Number</label>
										<p class="patientPhone"></p>
									</div>
							</div>
						</div>
						<div class="customerlistHead text-center"> <span>Date of appointment</span>&nbsp;&nbsp;
							<div class="searchBox calenderwith">
							<input autocomplete="off" type="text" style="cursor:pointer;" id="birthdateval" placeholder="Select" name="appointment_date">
								<button type="button"><b class="sprite clderIcon cld_icon clderIconClick"></b></button>
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
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	</form>
	
	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
	<!-- Modal -->
	<div id="createpatient-Modal" class="modal fade" role="dialog">
		<?php echo $this->element("Patient/create_patient"); ?>
	</div>
	
	<!-- Modal -->
<div id="confirmationModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body text-center">
        <p>Are you sure you want to delete this inventory?</p>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary text-uppercase">Delete</button>
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
        <h4 class="modal-title">Cancel APPOINTMENT</h4>
      </div>
      <div class="modal-body text-center">
        <p>Are you sure you want to cancel appointment?</p>
      </div>
      <div class="modal-footer text-center">
        <a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">No</a>
        <a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" class="btn btn-primary text-uppercase">Yes</a>
      </div>
    </div>
  </div>
</div>
<?php echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']); ?>

<script type="text/javascript">
$(document).ready(function ()
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
	
	var countFinalSubmit = 1;
	$("body").on("click",".saveAppointment",function()
	{
		$(".mandatory").each(function()
		{
			if($(this).val()=="")
			{
				$(this).next().next(".errorClass").css("display","block");
			}
		});
		
		if($('.doctorErrorClass').css('display')=='block' || $('.patientErrorClass').css('display')=='block')
		{
			return false;
		}
		else if(!$('.appointment_time').is(':checked'))
		{
			alert("Select an appointment");
			return false;
		}
		else
		{
			if(countFinalSubmit!=1)
			{
				$(this).prop('disabled', true);
			}
			countFinalSubmit++;
		}
		
	});
	
	$("body").on("blur","#birthdateval",function()
	{	
		var weekday = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

		var a = new Date($("#birthdateval").val());
		
		var day = weekday[a.getDay()];
		
		var doctorID = $(".doctor_id").val();
		
		var currentDate = $("#birthdateval").val();

		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getSlotData"]); ?>',  
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

	$("body").on("change",".doctor_id",function()
	{
		$(this).next().next(".errorClass").css("display","none");
		
		var weekday = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

		var a = new Date($("#birthdateval").val());
		
		var day = weekday[a.getDay()];
		var doctorID = $(this).val();
		
		var currentDate = $("#birthdateval").val();

		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getSlotData"]); ?>',  
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
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getDoctorTimings"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":doctorID},
			success: function(data)
			{
				$(".getDoctorTimings").html(data);
			} 
		});

	});
	
	if($(".patientID").val()!="")
	{
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getPatitentData"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":$(".patientID").val()},
			success: function(data)
			{
				var obj = jQuery.parseJSON(data);
				var currentYear = new Date();

				var getDOB = obj.dob.split(' ');

				$(".patientAge").text(currentYear.getFullYear() - getDOB[2]);
				$(".patientGender").text(obj.gender);
				
				var phoneData = obj.m_number.split(',');
				$(".patientPhone").text("");
				jQuery.each(phoneData, function(i, val)
				{
					$(".patientPhone").append(val+"<br>");
				});
			}   
		});
	}

	$("body").on("change",".patient_id",function()
	{
		$(this).next().next(".errorClass").css("display","none");
		
		var patientID = $(this).val();
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getPatitentData"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":patientID},
			success: function(data)
			{
				var obj = jQuery.parseJSON(data);
				var currentYear = new Date();

				var getDOB = obj.dob.split(' ');

				$(".patientAge").text(currentYear.getFullYear() - getDOB[2]);
				$(".patientGender").text(obj.gender);
				
				var phoneData = obj.m_number.split(',');
				$(".patientPhone").text("");
				jQuery.each(phoneData, function(i, val)
				{
					$(".patientPhone").append(val+"<br>");
				});
			}   
		});
	});
	
	$(".singleselect").select2();
	
	$("#allergyData").select2({
		dropdownCssClass: "allergyData"
	});
	
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
	$('.searchBox').click(function () {
		$('#birthdateval').click();
	});
	
	$(document).on('click','.clderIconClick', function() {
		$('#birthdateval').focus();
	});
	
	$('#birthdateval').datetimepicker({
		            //format: 'LT'
					minDate: moment().subtract(1, 'days'),
					//maxDate: moment(),
                    format: 'DD MMM YYYY',
					locale:  moment.locale('en', {
						week: { dow: 1 }
					}),
					
                });
	var phpDate = '<?php echo date("d M Y") ?>';
	$('#birthdateval').val(phpDate);

	if($('.doctor_id').css('display')=='none')
	{
		var weekday = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

		var a = new Date($("#birthdateval").val());
		
		var day = weekday[a.getDay()];
		
		var doctorID = $(".doctor_id").val();
		
		var currentDate = $("#birthdateval").val();

		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getSlotData"]); ?>',  
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
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getDoctorTimings"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":doctorID},
			success: function(data)
			{
				$(".getDoctorTimings").html(data);
			} 
		});
	}
 
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
	
});
</script>

</body>