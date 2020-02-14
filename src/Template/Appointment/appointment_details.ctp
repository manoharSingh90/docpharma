
<?php
echo $this->Html->script(['pharmacy/moment.min.js', 'pharmacy/bootstrap-datetimepicker.js']);
?>

<body>
	
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
	<div class="main-wraper">
	<input type="hidden" class="doctorID" value="<?php echo isset($appointmentDetails["doctor_detail"]["id"]) ? $appointmentDetails["doctor_detail"]["id"] : ""; ?>" >
	<input type="hidden" class="patientID" value="<?php echo isset($appointmentDetails["patient_detail"]["id"]) ? $appointmentDetails["patient_detail"]["id"] : ""; ?>" >
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<a href="<?php echo $this->url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" class="backLink text-uppercase"><img src="<?php echo PATH."img/doctor/back-arrow.png" ?>"> Back</a>
						<div class="customHead"> <b><img src="<?php echo PATH."img/doctor/doctor-app.png" ?>" alt="" /></b> <span>Appointment Details</span> </div>
					</li>
					<?php $id = $appointmentDetails["id"]; ?>
					<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
						<!--<div class="headLink"> <a href="<?php //echo $this->url->build(["controller"=>"Appointment","action"=>"reschedule_appointment",base64_encode($appointmentDetails["id"])]); ?>" class="pull-right btn btn-secondary text-uppercase">Reschedule Appointment </a> <a href="javascript:void(0);" class="pull-right btn btn-secondary text-uppercase" data-toggle="modal" data-target="#createpatient-Modal">Edit Patient Details</a> </div>-->
						<div class="headLink"> <a href="<?php echo $this->url->build(["controller"=>"Appointment","action"=>"reschedule_appointment",$appointmentDetails["id"]]); ?>" class="pull-right btn btn-secondary text-uppercase" style="display:<?php echo $appointmentDetails["payment_data"]==1 || $appointmentDetails["payment_data"]==2 ? "none" : "block"; ?>" >Reschedule Appointment </a> <a href="javascript:void(0);" class="pull-right btn btn-secondary text-uppercase" data-toggle="modal" data-target="#createpatient-Modal">Edit Patient Details</a> </div>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="doctorWrap">
						<div class="userViewwrap">
							<h3 class="doctorTitle">Patient Information</h3>
							<ul class="clearfix userViewlist">
								<li class="col-lg-3 col-md-3 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">FULL NAME</label>
										<p><?php echo isset($appointmentDetails["patient_detail"]["fname"]) ? $appointmentDetails["patient_detail"]["fname"]." ".$appointmentDetails["patient_detail"]["mname"]." ".$appointmentDetails["patient_detail"]["lname"] : ""; ?></p>
									</div>
								</li>
								
								<?php
								$currentYear = date("Y");
								$dob = explode(" ",$appointmentDetails["patient_detail"]["dob"]); ?>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">AGE (Date Of Birth)</label>
										<p><?php echo $currentYear - $dob[2]; ?> (<?php echo isset($appointmentDetails["patient_detail"]["dob"]) ? $appointmentDetails["patient_detail"]["dob"] : ""; ?>)</p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">Gender</label>
										<p><?php echo isset($appointmentDetails["patient_detail"]["gender"]) ? $appointmentDetails["patient_detail"]["gender"] : ""; ?></p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">PHONE NUMBER</label>
										<?php
										$explodeCode = isset($appointmentDetails["patient_detail"]["country_code"]) ? explode(",",$appointmentDetails["patient_detail"]["country_code"]) : "";
										$explodeNumber = isset($appointmentDetails["patient_detail"]["m_number"]) ? explode(",",$appointmentDetails["patient_detail"]["m_number"]) : "";
										
										if(isset($explodeCode) && !empty($explodeCode)) {
										foreach($explodeCode as $key => $value) { ?>
											<p><?php echo $value." ".$explodeNumber[$key]; ?></p>
										<?php } } ?>
										
									</div>
								</li>
								<li class="col-lg-3 col-md-3 col-sm-12">
									<div class="customformwrap">
										<label class="customLabel">Email</label>
										<?php
										$explodeEmail = isset($appointmentDetails["patient_detail"]["email"]) ? explode(",",$appointmentDetails["patient_detail"]["email"]) : "";
										
										if(isset($explodeEmail) && !empty($explodeEmail)) {
										foreach($explodeEmail as $key => $value) { ?>
											<p><?php echo $value; ?></p>
										<?php } } ?>
										
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-12 pull-right text-right">
									<div class="usermoreOpction"> <a href="#" data-toggle="modal" data-target="#viewdetails-Modal">View Details</a> </div>
								</li>
							</ul>
						</div>
						<div class="userViewwrap">
							<h3 class="doctorTitle">Appoinment information</h3>
							<ul class="clearfix userViewlist">
								<li class="col-lg-3 col-md-3 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">Doctor Name</label>
										<p>Dr. <?php echo isset($appointmentDetails["doctor_detail"]["first_name"]) ? $appointmentDetails["doctor_detail"]["first_name"]." ".$appointmentDetails["doctor_detail"]["middle_name"]." ".$appointmentDetails["doctor_detail"]["last_name"] : ""; ?></p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">Date of Appointment</label>
										<p><?php echo isset($appointmentDetails["appointment_date"]) ? $appointmentDetails["appointment_date"] : ""; ?></p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">Time of Appointment</label>
										<p><?php echo isset($appointmentDetails["appointment_time"]) ? $appointmentDetails["appointment_time"] : ""; ?></p>
									</div>
								</li>
								<li class="col-lg-4 col-md-6 col-sm-12">
									<div class="customformwrap">
										<label class="customLabel">Comments</label>
										<p><?php echo isset($appointmentDetails["comments"]) ? $appointmentDetails["comments"] : ""; ?></p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12">
					<div class="row">
						<div class="col-lg-8 col-md-8 text-right">
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#todayvisitsTab" aria-expanded="true">Previous Visits</a></li>
								<li class=""><a data-toggle="tab" href="#reportsTab" aria-expanded="false">Reports</a></li>
							</ul>
						</div>
					</div>
					<div class="tab-content">
						<div id="todayvisitsTab" class="tab-pane fade in active">
							<?php echo $this->element("Appointment/previous_visit_tab"); ?>
						</div>
						<div id="reportsTab" class="tab-pane fade">
							<?php echo $this->element("Appointment/reports_tab"); ?>
						</div>
					</div>
				</div>
				
				<?php echo $this->element("Appointment/prescription_right_details"); ?>
				
			</div>
		</div>
	</div>
	
	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
	<!-- VIEW DETAILS MODAL -->
	<div id="viewdetails-Modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">View Patient Details</h4> </div>
				<div class="modal-body">
					<div class="viewmodalOrder">
						<div class="row">
							<div class="col-lg-12">
								<ul>
									<li>
										<div class="customformwrap">
											<label class="customLabel">FULL NAME</label>
											<p><?php echo isset($appointmentDetails["patient_detail"]["fname"]) ? $appointmentDetails["patient_detail"]["fname"]." ".$appointmentDetails["patient_detail"]["mname"]." ".$appointmentDetails["patient_detail"]["lname"] : ""; ?></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Phone Number</label>
											<p><?php echo isset($appointmentDetails["patient_detail"]["m_number"]) ? $appointmentDetails["patient_detail"]["m_number"] : ""; ?></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">AGE (DATE OF BIRTH)</label>
											<p><?php echo $currentYear - $dob[2]; ?> (<?php echo isset($appointmentDetails["patient_detail"]["dob"]) ? $appointmentDetails["patient_detail"]["dob"] : ""; ?>)</p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Email</label>
											<p><?php echo isset($appointmentDetails["patient_detail"]["email"]) ? $appointmentDetails["patient_detail"]["email"] : ""; ?></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Address</label>
											<p><?php echo isset($appointmentDetails["patient_detail"]["address"]) ? $appointmentDetails["patient_detail"]["address"].", ".$appointmentDetails["patient_detail"]["state"].", ".$appointmentDetails["patient_detail"]["country"]." ".$appointmentDetails["patient_detail"]["pincode"] : ""; ?></p>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="centerAlign">
						<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Done</button>
						<!--<button type="button" class="btn btn-primary text-uppercase" data-toggle="modal" data-target="#createpatient-Modal">Edit</button>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- UPLOAD REPORTS FILE DETAILS MODAL -->
	<div id="uploadreports-modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Upload Reports</h4> </div>
				<div class="modal-body">
					<div class="viewmodalOrder">
						<div class="row">
							<div class="col-lg-12">
								<ul class="uploadrepmodal">
									<li>
										<div class="customformwrap">
											<label class="customLabel">Test Name</label>
											<input type="text" class="custominput" /> </div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Date of Test</label>
											<input type="text" class="custominput" id="reportsdate" />
											<button><b class="sprite clderIcon cld_icon reportsClick"></b></button>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Notes</label>
											<textarea class="custominput"></textarea>
										</div>
									</li>
								</ul>
								<p class="attacheview">attachfilename<b>X</b></p>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="centerAlign">
						<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button> <span class="btn btn-secondary upload-secondry text-uppercase uploadsec"><input type="file" /> attach </span> </div>
				</div>
			</div>
		</div>
	</div>
	
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
					<h4 class="modal-title">Confirmation</h4> </div>
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
	
<script type="text/javascript">
$(document).ready(function () {
	
var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;

$('body').on('keyup','input.select2-search__field',function()
{
	var count = $(this).val().length;
	
	var url = window.location.href;
	
	if(count>2)
	{
		if(url.indexOf('www') != -1) {
		$.ajax({
			url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
			type: "POST",
			data: {'value' : $(this).val() , 'type' : 'allergies'},
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			success: function(data)
			{
				$(".allergyData").html("");
				var obj = $.parseJSON(data);
				jQuery.each(obj, function(i, val)
				{
					var value = val.id+"_"+val.name;
					$(".allergyData").append('<option value="'+value+'">'+val.name+'</option>');
				});
			}
		});
		}
		else {
		$.ajax({
			url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
			type: "POST",
			data: {'value' : $(this).val() , 'type' : 'allergies'},
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			success: function(data)
			{
				$(".allergyData").html("");
				var obj = $.parseJSON(data);
				jQuery.each(obj, function(i, val)
				{
					var value = val.id+"_"+val.name;
					$(".allergyData").append('<option value="'+value+'">'+val.name+'</option>');
				});
			}
		});
		}
	}
	if(count==0)
	{
		$(".allergyData").html('<option value="">Select Allergy</option>');
	}
});

$('body').on('click','.saveConditions',function()
{
	var patientID = $(".patientID").val();
	var oldCondtions = $(".oldCondtions").val();
	var condtionsData = $(".condtionsData").val();
	
	if($.trim(condtionsData)=="")
	{
		alert("No condtion added");
		return false;
	}
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"addconditions"]); ?>',  
		type: "POST",
		data: {'id' : patientID , 'oldCondtions' : oldCondtions , 'condtionsData' : condtionsData},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".conditionList").append('<span>* '+condtionsData+'</span>');
			
			if(oldCondtions=="")
			{
				$(".oldCondtions").val($(".condtionsData").val());
			}
			else
			{
				$(".oldCondtions").val($(".oldCondtions").val()+","+$(".condtionsData").val());
			}
			$(".condtionsData").val("");
		}   
	});
});

$('body').on('click','.saveAllergy',function()
{
	var patientID = $(".patientID").val();
	var oldAllergy = $(".oldAllergy").val();
	var allergyData = $(".allergyData").val();
	
	var allergyName = $(".allergyData").val().split("_");
	
	if($.trim(allergyData)=="")
	{
		alert("No allergy added");
		return false;
	}
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"addallergy"]); ?>',  
		type: "POST",
		data: {'id' : patientID , 'oldAllergy' : oldAllergy , 'allergyData' : allergyData},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".allergyList").append('<span>* '+allergyName[1]+'</span>');
			
			if(oldAllergy=="")
			{
				$(".oldAllergy").val($(".allergyData").val());
			}
			else
			{
				$(".oldAllergy").val($(".oldAllergy").val()+","+$(".allergyData").val());
			}
			$(".allergyData").html('<option value="">Select Allergy</option>');
		}   
	});
});
	
$('body').on('click','.saveNotes',function()
{
	var notesID = $(".notesID").val();
	var doctorID = $(".doctorID").val();
	var patientID = $(".patientID").val();
	var notesData = $(".notesData").val();
	var date = $("#notesCalender").val();
	
	if($.trim(notesData)=="")
	{
		alert("No notes added");
		return false;
	}
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"addnote"]); ?>',  
		type: "POST",
		data: {'notesID' : notesID, 'doctorID' : doctorID, 'patientID' : patientID , 'notesData' : notesData , 'date' : date},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".notesData").val("");
			$(".noNotesDiv").css("display","none");
			
			$(".savedNotes").html("");
			var obj = $.parseJSON(data);
			jQuery.each(obj, function(i, val)
			{
				$(".savedNotes").append('<div class="repeathistory" id="'+val.date+'"><div class="medicianSubTitle"><p class=" toggleSubHead">'+val.date+'</p> <a class="mediedit editNotes" id="'+val.id+'">Edit</a> </div><div class="toggleSubContent"><ul class="medicianSub-wrap notesborder"><li class="medicianSub-list"><p class="notes_'+val.id+'">'+val.notes+'</p></li></ul></div></div>');
			});
			
			$(".notesID").val("");
		}   
	});
});

$('body').on('click','.editNotes',function()
{
	var id = $(this).attr("id");
	$(".notesID").val(id);
	$(".notesData").val($(".notes_"+id).text());
});

$("body").on("change","#notesCalender",function()
{
	var currentDate = $(this).val();
	
	$('.repeathistory').each(function()
	{
		var dateData = $(this).attr("id");
		
		if (currentDate==dateData)
		{
			$(this).show();
		}
		else
		{
			$(this).hide();
		}		
	});
});
	
$("body").on("change","#previousCalender",function()
{
	var currentDate = $(this).val();
	
	$('.previousDateData').each(function()
	{
		var dateData = $(this).text();
		
		if (dateData.indexOf(currentDate)!=-1)
		{
			$(this).parent().parent().show();
		}
		else
		{
			$(this).parent().parent().hide();
		}		
	});
});

$("body").on("change","#reportCalender",function()
{
	var currentDate = $(this).val();
	
	$('.dateData').each(function()
	{
		var dateData = $(this).text();
		
		if (dateData.indexOf(currentDate)!=-1)
		{
			$(this).parent().parent().show();
		}
		else
		{
			$(this).parent().parent().hide();
		}		
	});
});

$('.notesCalender').click(function () {
	$('#notesCalender').click();
});
$("#notesCalender").daterangepicker({
	autoUpdateInput: true,
	singleDatePicker: true,
	locale: {
		format: 'DD MMM YYYY'
	}
});

$('.calender').click(function () {
	$('#reportCalender').click();
});
$("#reportCalender").daterangepicker({
	autoUpdateInput: true,
	singleDatePicker: true,
	locale: {
		format: 'DD MMM YYYY'
	}
});

$('.previousCalender').click(function () {
	$('#previousCalender').click();
});
$("#previousCalender").daterangepicker({
	autoUpdateInput: true,
	singleDatePicker: true,
	locale: {
		format: 'DD MMM YYYY'
	}
});
	
	$(".singleselect").select2();
	$('#customerTable').DataTable({
		responsive: true
		, info: false
		, paging: false
		, searching: false
		, ordering: false
	});
	$('#reportsTable').DataTable({
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
	///// REPORTS DATE
	$('.reportsClick').click(function () {
		$('#reportsdate').click();
	});
	$("#reportsdate").daterangepicker({
		autoUpdateInput: true
		, singleDatePicker: true
		, locale: {
			format: 'DD MMM YYYY'
		}
	});
	$('.clderIconClick').click(function () {
		$('#selectdateval').click();
	});
	$("#selectdateval").daterangepicker({
		autoUpdateInput: true
		, singleDatePicker: true
		, locale: {
			format: 'DD MMM YYYY'
		}
	});
	$('.clderIconClick03').click(function () {
		$('#selectdateval03').click();
	});
	$("#selectdateval03").daterangepicker({
		autoUpdateInput: true
		, singleDatePicker: true
		, locale: {
			format: 'DD MMM YYYY'
		}
	});
	$('.clderIconClick04').click(function () {
		$('#selectdateval04').click();
	});
	$("#selectdateval04").daterangepicker({
		autoUpdateInput: true
		, singleDatePicker: true
		, locale: {
			format: 'DD MMM YYYY'
		}
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
	$(document).on('click', '.toggleHead', function (e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$(this).closest('li').find('.toggleContent').slideToggle();
		$(this).closest('li').find('.repeathistory').slideToggle();
	});
	$(document).on('click', '.toggleSubHead', function (e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$(this).closest('.repeathistory').find('.toggleSubContent').slideToggle();
	});
});
</script>
</body>