
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<body>
	
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="customHead"> <b><img src="<?php echo PATH."img/doctor/doctor-app.png" ?>" alt="" /></b> <span>Appointments</span> </div>
					</li>
					<li class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pull-right"> <a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"index"]); ?>" class="pull-right btn btn-secondary text-uppercase">Create New Appointment</a></li>
					<li class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
						<div class="searchclient">
							<input type="text" class="searchPatient" placeholder="Search Patient" /> <b><img src="<?php echo PATH."img/doctor/icons-search.png" ?>" /></b></div>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-9 col-sm-12">
					<div class="customerlistWrap ">
							
							<input type="hidden" class="doctorID" value="<?php echo isset($_SESSION["doctorID"]) ? $_SESSION["doctorID"] : ""; ?>" >
							
							<div class="executivewrap">
							<?php if($this->request->getSession()->read('role_id')==1) { ?>
							<div class="slt-gender col-lg-5 col-md-5 col-sm-5">
								<div class="customformwrap">
									<label class="customLabel">Select Doctor</label>
									<select class="custominput singleselect doctor_id">
										<option value="0">All</option>
										<?php
										if(isset($doctorData) && !empty($doctorData)) {
										foreach($doctorData as $key => $value) { ?>
											<option value="<?php echo $value["id"]; ?>" <?php echo isset($_SESSION["doctorID"]) && $_SESSION["doctorID"]==$value["id"] ? "selected" : ""; ?> >
												Dr. <?php echo $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"]; ?>
											</option>
										<?php } } ?>
									</select>
								</div>
							</div>
							<?php }
							else { ?>
							<input type="hidden" class="doctor_id" value="<?php echo isset($doctorData[0]["id"]) ? $doctorData[0]["id"] : ""; ?>" >
							<?php } ?>
							
							
							<!--<div class="customerlistHead text-center pull-right">
								<div class="searchBox calenderwith">
									<input type="text" style="cursor:pointer;" readonly id="birthdateval" placeholder="Select">
									<button type="button"><b class="sprite clderIcon cld_icon clderIconClick"></b></button>
								</div>
							</div>-->
							
							<div class="col-lg-5 col-md-5 col-sm-12 pull-right">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="customformwrap">
									<label class="customLabel">From</label></div>
								<div class="searchBox calenderwith">
									<input type="text" style="cursor:pointer;" class="form-control" id="datetimepicker6" placeholder="Select" />
									<button type="button"><b class="sprite clderIcon cld_icon clderIconClick datetimepicker6Button"></b></button>
								</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="customformwrap">
									<label class="customLabel">To</label></div>
								<div class="searchBox calenderwith">
									<input type="text" style="cursor:pointer;" class="form-control" id="datetimepicker7" placeholder="Select" />
									<button type="button"><b class="sprite clderIcon cld_icon clderIconClick datetimepicker7Button"></b></button>
								</div>
								</div>
							</div>
							
						</div>
						<div class="tablewrap ">
							<table id="customerTable" style="width:100%">
								<thead>
									<tr>
										<th><div class="managetitle">Date/Time</div></th>
										<?php if($this->request->getSession()->read('role_id')==1) { ?>
										<th>Doctor Name</th>
										<?php } ?>
										<th>Patient Name</th>
										<th><div class="paticonta">Patient Contact</div></th>
										<th>Queue</th>
										<th class="actionWrap02">Action</th>
									</tr>
								</thead>
								
						<tbody id="listingData">
						<?php
						//if(isset($appointmentData) && !empty($appointmentData)) {
						//foreach($appointmentData as $key => $value) { ?>
							<!--<tr class="row_<?php echo $value["id"]; ?>">
								<td>
									<span><?php echo isset($value["appointment_time"]) ? $value["appointment_time"] : ""; ?></span>
								</td>
								<?php if($this->request->getSession()->read('role_id')==1) { ?>
								<td>
									<span class="userName chengecolor">Dr. <?php echo isset($value["doctor_detail"]["first_name"]) ? $value["doctor_detail"]["first_name"]." ".$value["doctor_detail"]["middle_name"]." ".$value["doctor_detail"]["last_name"] : ""; ?></span>
								</td>
								<?php } ?>
								<td>
									<span class="userName chengecolor patientName"><?php echo isset($value["patient_detail"]["fname"]) ? $value["patient_detail"]["fname"]." ".$value["patient_detail"]["mname"]." ".$value["patient_detail"]["lname"] : ""; ?></span>
								</td>
								<td>
									<span class="chengecolor"><?php echo isset($value["patient_detail"]["m_number"]) ? $value["patient_detail"]["m_number"] : ""; ?></span>
								</td>
								
								<td>
									<span class="movequeueBtn moveToQueue moveToQueue_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" style="display:<?php echo $value["queue_data"]==1 || $value["payment_data"]==2 ? "none" : "block"; ?>;" >Move to Queue</span>
									<span class="movequeueBtn removeFromQueue removeFromQueue_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" style="display:<?php echo $value["queue_data"]==0 || $value["payment_data"]==1 || $value["payment_data"]==2 ? "none" : "block"; ?>;" >Remove Queue</span>
									<span class="movequeueBtn paymentPending_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" style="display:<?php echo $value["payment_data"]==1 ? "block" : "none"; ?>;" >Payment Pending</span>
									<span class="movequeueBtn paymentDone_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" style="display:<?php echo $value["payment_data"]==2 ? "block" : "none"; ?>;" >Payment Done</span>
								</td>
								
								<td>
									<div class="usermoreOpction">
										<a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"appointment_details",$value["id"]]); ?>">View</a>
										<a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"reschedule_appointment",$value["id"]]); ?>" class="colorBrown reschedule reschedule_<?php echo $value["id"]; ?>" style="display:<?php echo $value["payment_data"]==1 || $value["payment_data"]==2 ? "none" : "inline-block"; ?>" >Reschedule</a> 
										<a href="#" class="colorBrown cancelLink cancelLink_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" data-toggle="modal" data-target="#cancelModal" style="display:<?php echo $value["payment_data"]==1 || $value["payment_data"]==2 ? "none" : "inline-block"; ?>" >Cancel</a>
									</div>
								</td>
							</tr>-->
							
						<?php //} } ?>
						
						<div id="cancelModal" class="modal fade" role="dialog">
							<div class="modal-dialog cancellationpopup">
							<div class="modal-content">
							  <div class="modal-header  text-center">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Cancel APPOINTMENT</h4>
							  </div>
							  <div class="modal-body">
								  <div class="bulkmodal">
								<p class="text-center">Are you sure you want to cancel appointment?</p>
								  
								  <ul class="bulkmodalwrap">
									  <li class="bulkmodalliat">
										  <div class="customformwrap clearfix">
										  <label class="customLabel">Cancelation Message</label>
										  <select id="tags" class="custominput singleselect cancel_message" name="cancel_message">
											<option value="">Cancelation Message</option>
											<option value="The Doctor is not avaliable on this particular day. We apologize for the inconvinience.">The Doctor is not avaliable on this particular day. We apologize for the inconvinience.</option>
											<option value="The clinic will be closed on the particular day as per government instructions.">The clinic will be closed on the particular day as per government instructions.</option>
										  </select>
										</div></li>
								 
									   
								   </ul>
										</div>
							  </div>
							  <div class="modal-footer text-center">
								<a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</a>
								<a href="javascript:void(0);" class="btn btn-primary text-uppercase cancelAppointment">Done </a>
							  </div>
							</div>
							</div>
						</div>
						
						</tbody>
						
							</table>
						</div>
						<div class="loadmore" style="display:none;"><span>LOAD MORE</span></div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					
					<?php if($this->request->getSession()->read('role_id')==1) { ?>
					<div class="inpatient">
						<p>In Patient : <span class="inPatientName" id=""></span></p>
					</div>
					<?php }
					else { ?>
					<!--<a class="inpatient inPatientLink" href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"doctor_consultant",isset($inPatientName[0]["id"]) ? base64_encode($inPatientName[0]["id"]) : ""]); ?>">-->
					<a class="inpatient inPatientLink" href="#">
						<p>In Patient : <span class="inPatientName" id=""></span></p>
					</a>
					<?php } ?>
					<ul class="nav nav-tabs">
						<li class="active queueTab"><a data-toggle="tab" href="#queue">Queue</a></li>
						<li class="paymentTab"><a data-toggle="tab" href="#payment">Payment</a></li>
					</ul>
				<div class="combgcolor padding-conrol">
						<div class="tab-content">
							<div id="queue" class="tab-pane fade in active">
								<div class="tablewrap tabtable">
									<table style="width:100%">
										<thead>
											<tr>
												<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Patient Name</th>
												<th class="text-right">In Patient</th>
											</tr>
										</thead>
										
										<tbody id="sortable" class="queueData">
										<?php
										if(isset($appointmentData) && !empty($appointmentData)) {
										foreach($appointmentData as $queueKey => $queueValue) {
										if($queueValue["clinic_id"]==$this->request->getSession()->read('clinic_id') && $queueValue["queue_data"]==1 && $queueValue["payment_data"]==0) { ?>
											<tr id="queueTR_<?php echo $queueValue["id"]; ?>" >
												<td>
													<span class="short-icon">
														<img src="<?php echo PATH."img/doctor/short.png" ?>" alt="#" />
													</span>&nbsp;&nbsp;&nbsp;&nbsp;
													<a href="javascript:void(0);" class="userName waitingName_<?php echo $queueValue["id"]; ?>"><?php echo $queueValue["patient_detail"]["fname"]." ".$queueValue["patient_detail"]["mname"]." ".$queueValue["patient_detail"]["lname"]; ?></a>
												</td>
												<td class="text-center">
													<div class="customradio queueCheck" >
														<label>
															<input type="radio" name="queue" class="waitingID" value="<?php echo $queueValue["id"]; ?>"> <b></b>
														</label>
													</div>
												</td>
											</tr>
										<?php } } } ?>
										</tbody>
										
									</table>
								</div>
								<div class="text-center">
								<span class="btn btn-primary movepaybtn text-uppercase moveToPayment">Move to Payment</span>
								</div>
							</div>
							<div id="payment" class="tab-pane fade">
								<div class="tablewrap tabtable">
									<table style="width:100%">
										<thead>
											<tr>
												<th>Patient Name</th>
												<th class="text-right">Paid</th>
											</tr>
										</thead>
										<tbody class="paymentPending">
										<?php
										if(isset($appointmentData) && !empty($appointmentData)) {
										foreach($appointmentData as $paymentKey => $paymentValue) {
										if($paymentValue["clinic_id"]==$this->request->getSession()->read('clinic_id') && $paymentValue["payment_data"]==1) { ?>
											<tr id="paymentTR_<?php echo $paymentValue["id"]; ?>" >
												<td>
												<a href="javascript:void(0);" class="userName">
													<?php echo $paymentValue["patient_detail"]["fname"]." ".$paymentValue["patient_detail"]["mname"]." ".$paymentValue["patient_detail"]["lname"]; ?>
												</a></td>
												<td class="text-center">
													<div class="customcheckbox paymentCheck">
														<label>
															<input type="checkbox" class="paymentCheckBox" value="<?php echo $paymentValue["id"]; ?>"> <b></b>
														</label>
													</div>
												</td>
											</tr>
										<?php } } } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		
	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
	<!-- Cancel Modal -->
	 
<?php echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']); ?>

<script type="text/javascript">

$(document).ready(function ()
{
	var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
	
	$("body").on("click",".moveToQueue",function()
	{
		var id = $(this).attr("id");
		var name = $(this).parent().prev().prev().children().text();
		
		$(".moveToQueue_"+id).css("display","none");
		$(".removeFromQueue_"+id).css("display","block");
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"updatequeue"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":id, "type":"addqueue"},
			success: function(data)
			{
				$(".queueData").append('<tr id="queueTR_'+id+'"><td><span class="short-icon"><img src="<?php echo PATH."img/doctor/short.png" ?>" alt="#" /></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="userName waitingName_'+id+'">'+name+'</a></td><td class="text-center"><div class="customradio queueCheck" ><label><input type="radio" name="queue" class="waitingID" value="'+id+'"> <b></b></label></div></td></tr>');
			}   
		});
	});
	
	$("body").on("click",".removeFromQueue",function()
	{
		var id = $(this).attr("id");
		
		$(".moveToQueue_"+id).css("display","block");
		$(".removeFromQueue_"+id).css("display","none");
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"updatequeue"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":id, "type":"removequeue"},
			success: function(data)
			{
				$('#queueTR_'+id).remove();
			}   
		});
	});
	
	$("body").on("click",".waitingID",function()
	{
		var id = $(this).val();
		var name = $(".waitingName_"+id).text();
		
		var doctorURL = '<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"doctor_consultant"]); ?>';
		
		$(".inPatientName").text(name);
		$(".inPatientName").attr("id",id);
		//$(this).attr("disabled",true);
		//$(".inPatientLink").attr("href", "http://docpharmrx.com/docpharma/appointment/doctor-consultant/"+id);
		$(".inPatientLink").attr("href", doctorURL+"/"+id);
	});
	
	$("body").on("click",".moveToPayment",function()
	{
		var id = $("input[name='queue']:checked").val();
		var name = $(".waitingName_"+id).text();
		
		if(name!="") {
			
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"updatequeue"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":id, "type":"paymentqueue"},
			success: function(data)
			{
				$(".paymentTab").addClass("active");
				$("#payment").addClass("active in");
				$(".queueTab").removeClass("active");
				$("#queue").removeClass("active in");
				$('#queueTR_'+id).remove();
				
				$(".moveToQueue_"+id).css("display","none");
				$(".removeFromQueue_"+id).css("display","none");
				$(".paymentDone_"+id).css("display","none");
				$(".paymentPending_"+id).css("display","block");
				
				$(".paymentPending").append('<tr id="paymentTR_'+id+'"><td><a href="javascript:void(0);" class="userName">'+name+'</a></td><td class="text-center"><div class="customcheckbox paymentCheck"><label><input type="checkbox" class="paymentCheckBox" value="'+id+'"> <b></b></label></div></td></tr>');
				
				var inPatientNameID = $(".inPatientName").attr("id");
				if(id==inPatientNameID)
				{
					$(".inPatientName").text("");
					$(".inPatientLink").attr("href", "#");
					$(".reschedule_"+id).css("display", "none");
					$(".cancelLink_"+id).css("display", "none");
				}
			}   
		});
		}
	});
	
	$("body").on("click",".paymentCheckBox",function()
	{
		var id = $(this).val();
		var name = $(".waitingName_"+id).text();
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"updatequeue"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":id, "type":"paymentdone"},
			success: function(data)
			{
				$('#queueTR_'+id).remove();
				$('#paymentTR_'+id).remove();
				
				$(".moveToQueue_"+id).css("display","none");
				$(".removeFromQueue_"+id).css("display","none");
				$(".paymentPending_"+id).css("display","none");
				$(".paymentDone_"+id).css("display","block");
			}   
		});
	});
	
	$("body").on("keyup",".searchPatient",function()
	{
		var search = $(this).val().toLowerCase();
		
		$('.patientName').each(function()
		{
			var patientName = $(this).text().toLowerCase();
			if (patientName.indexOf(search)!=-1)
			{
				$(this).parent().parent().show();
			}
			else
			{
				$(this).parent().parent().hide();
			}		
		});
		/* if(search=="")
		{
			$(".loadmore").css("display","block");
		}
		else
		{
			$(".loadmore").css("display","none");
		} */
	});
	
	$("body").on("click",".cancelLink",function()
	{
		$(".cancelAppointment").attr("id",$(this).attr("id"));
	});
	
	$("body").on("click",".cancelAppointment",function()
	{
		var id = $(this).attr("id");
		var message = $(".cancel_message").val();
		if(message=="")
		{
			alert("Select a message");
			return false;
		}
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"removeStatus"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {"id":id, "message":message},
			success: function(data)
			{
				$(".row_"+id).remove();
				$('#cancelModal').modal('toggle');
				$(".cancel_message").html('<option></option><option value="The Doctor is not avaliable on this particular day. We apologize for the inconvinience.">The Doctor is not avaliable on this particular day. We apologize for the inconvinience.</option><option value="The clinic will be closed on the particular day as per government instructions.">The clinic will be closed on the particular day as per government instructions.</option>');
			}   
		});
	});
	
	$("body").on("blur","#datetimepicker6",function()
	{
		var doctorID = $(".doctor_id").val();
		var fromDate = $('#datetimepicker6').val();
		var toDate = $('#datetimepicker7').val();
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getListingData"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken   
			},
			data: {"id":doctorID, "fromDate":fromDate, "toDate":toDate},
			success: function(data)
			{
				$("#listingData").html(data);
			}   
		});
	});
	
	$("body").on("blur","#datetimepicker7",function()
	{
		var doctorID = $(".doctor_id").val();
		var fromDate = $('#datetimepicker6').val();
		var toDate = $('#datetimepicker7').val();
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getListingData"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken   
			},
			data: {"id":doctorID, "fromDate":fromDate, "toDate":toDate},
			success: function(data)
			{
				$("#listingData").html(data);
			}   
		});
	});
	
	$("body").on("change",".doctor_id",function()
	{
		var doctorID = $(this).val();
		var fromDate = $('#datetimepicker6').val();
		var toDate = $('#datetimepicker7').val();
		
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getListingData"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken   
			},
			data: {"id":doctorID, "fromDate":fromDate, "toDate":toDate},
			success: function(data)
			{
				$("#listingData").html(data);
			}   
		});
	});
	
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
	  
	$('#datetimepicker6').datetimepicker({
		format: 'DD MMM YYYY',
		useStrict:true,
		 locale:  moment.locale('en', {
			week: { dow: 1 }
		}),
	});
	$('#datetimepicker7').datetimepicker({
		format: 'DD MMM YYYY',
		useStrict:true,
		 locale:  moment.locale('en', {
			week: { dow: 1 }
		}),
	});
	$("#datetimepicker6").on("dp.change", function (e) {
		$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
	});
	$("#datetimepicker7").on("dp.change", function (e) {
		$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
	});
	
	$(document).on('click','.datetimepicker6Button', function() {
		$('#datetimepicker6').focus();
	});
	$(document).on('click','.datetimepicker7Button', function() {
		$('#datetimepicker7').focus();
	});
	  
	$( "#sortable" ).sortable();
	
	var phpDate = '<?php echo date("d-m-Y") ?>';
	$('#birthdateval').val(phpDate);
	
	$('.paymentCheck input').each(function(){
		  if ($(this).is(':checked')) {
			  $(this).parents('tr').addClass('active');
		  } else {
			  $(this).parents('tr').removeClass('active');

		  }
	});
	$('.paymentCheck input').click(function(){
		  if ($(this).is(':checked')) {
			  $(this).parents('tr').addClass('active');
		  } else {
			  $(this).parents('tr').removeClass('active');

		  }
	});
			
	$('.timeCheck input').each(function(){
		  if ($(this).is(':checked')) {
			  $(this).parents('tr').addClass('active');
		  } else {
			  $(this).parents('tr').removeClass('active');

		  }
	});
	$('.timeCheck input').click(function(){
		  if ($(this).is(':checked')) {
			  $(this).parents('tr').addClass('active');
		  } else {
			  $(this).parents('tr').removeClass('active');

		  }
	});
		 
	$('.queueCheck input').each(function(){
		 
		  if ($(this).is(':checked')) {
			 
			  $(this).parents('tr').addClass('active');
		  } 
	});
	$('.queueCheck input').change(function(){
		$('.queueCheck input').parents('tr').removeClass('active');
		  if ($(this).is(':checked')) {
			 
			  $(this).parents('tr').addClass('active');
		  } 
	});
			
	$("#tags").select2({
		tags: true,
		createTag: function(params) {
			return {
				id: params.term,
				text: params.term,
				newOption: true
			}
		},
		templateResult: function(data) {
			var $result = $("<span></span>");

			$result.text(data.text);

			if (data.newOption) {
				$result.append(" <em>(new)</em>");
			}

			return $result;
		}
	});
	
});


$(window).on("load", function()
{
	var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
	if($(".doctorID").val()!="")
	{
		var fromDate = '<?php echo date("d M Y") ?>';
		var toDate = '<?php echo date("d M Y",strtotime("+7 day", strtotime(date("d M Y")) ) ) ?>';
		$('#datetimepicker6').val(fromDate);
		$('#datetimepicker7').val(toDate);
		
		var doctorID = $(".doctor_id").val();
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getListingData"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken   
			},
			data: {"id":doctorID, "fromDate":fromDate, "toDate":toDate},
			success: function(data)
			{
				$("#listingData").html(data);
			}   
		});
	}
	else
	{
		var fromDate = '<?php echo date("d M Y") ?>';
		var toDate = '<?php echo date("d M Y") ?>';
		$('#datetimepicker6').val(fromDate);
		$('#datetimepicker7').val(toDate);
		
		var doctorID = $(".doctor_id").val();
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getListingData"]); ?>',  
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken   
			},
			data: {"id":doctorID, "fromDate":fromDate, "toDate":toDate},
			success: function(data)
			{
				$("#listingData").html(data);
			}   
		});
	}
});

</script>
</body>