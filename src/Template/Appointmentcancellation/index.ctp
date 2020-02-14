<?php /* // your first date coming from a mysql database (date fields) 
$dateA = '2008-03-01 13:34'; 
// your second date coming from a mysql database (date fields) 
$dateB = '2007-04-14 15:23'; 
if(strtotime($dateA) > strtotime($dateB)){ 
    // bla bla  
}*/?>
<header>
		<?php echo $this->element("left_panel"); ?>
</header>
	<form method="post" action="<?php echo $this->Url->build(["controller" =>"appointmentcancellation","action" => "deleteAppointment"]); ?>">
	<input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
						<div class="customHead"> <b><img src="<?php echo PATH.'img/doctor/doctor-app.png';?>" alt="" /></b> <span>Bulk Appointment Cancellation</span> </div>
					</li>
					<li class="col-lg-4 col-md-5 col-sm-12 col-xs-12 pull-right">
						<div class="headLink"><a href="#" id="butt" class="pull-right btn btn-primary text-uppercase" data-toggle="modal" data-target="#cancelModal">Cancel Appointments </a> </div>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
		 
					<div class="customerlistWrap">
						<div class="createappointment clearfix" >
							<div class="col-lg-12 col-md-12 col-sm-12">
							<?php if($this->request->getSession()->read('role_id')==1) { ?>
								<div class="slt-gender col-lg-4 col-md-4 col-sm-12 col-xs-6">
									<div class="customformwrap">
										<label class="customLabel">Select Doctor</label>										
										<select class="selectbox custominput singleselect">
										<option value="0">Select</option>
											<?php 
											if(isset($data) && !empty($data)) {
											foreach($data as $key=>$value){ ?>
											<option value="<?php echo $value['id']; ?>">Dr.<?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?>
											</option>
											<?php } } ?>
										</select>
										
									</div>
								</div>
					   <?php } else { ?>
					 <input type="hidden" name="doctor_id" class="selectbox2" value="<?= $data[0]["id"]; ?>">
					<?php } ?>
					<div class="col-lg-8 col-md-4 col-sm-4">
							<div class="customformwrap col-lg-6" style="padding-left: 0; padding-right: 0;">
							<label class="customLabel">Message</label>
							<textarea class="custominput mandatory message" style="min-height: 60px;" name="message"></textarea>
							<p class="msg4 errorClass1"></p>
							</div>
					</div>
							</div>
						</div>
						
						<div class="bulkcustomWrap clearfix col-lg-12 row">
							<div class="customerlistHead"> <span class="titledate">Date of appointment</span>&nbsp;&nbsp;
								<div class="searchBox calenderwith showsingledate">
							<input type="text" id="birthdateval" class="calender date appntDate" placeholder="Select Date" autocomplete="off">	
							<button type="button"><b class="sprite clderIcon cld_icon clderIconClick"></b></button>
								</div>
								
								<div class="calenderwith showrangedate datetimecalen">
								<div class='col-md-6'>
								<div class="form-group customformwrap">		
                                <label class="customLabel">From</label>								
								<div class='input-group date searchBox calenderwith'>								
								<input type='text' id='datetimepicker6' placeholder="Select Start Date" class="form-control first_date" autocomplete="off"/>
								<button><b class="sprite clderIcon cld_icon clderIconClick"></b></button>
									</div>
								</div>
							</div>
									<div class='col-md-6'>
								<div class="form-group customformwrap">		
                                   <label class="customLabel">To</label>								
									<div class='input-group date searchBox calenderwith'>									
									<input type='text' id='datetimepicker7' placeholder="Select End Date" class="form-control second_date" autocomplete="off"/>
									<button><b class="sprite clderIcon cld_icon clderIconClick"></b></button>

										
									</div>
								</div>
							</div>			
						</div>

				<div class="sltdaterange">
					<div class="dateText">
						<p class="singledate singleclick">Single Date</p>
						<p class="rangedate multiclick">Select Date Range</p>
					</div>
				</div>

				<div class="timerange">
					<span class="titledate">Time Range</span>&nbsp;&nbsp;
					<div class="customformwrap">
					<input type="time" class="custominput without_ampm" value="12:00" id="start_time">
					</div>
					<select class="form-control locationInput start">
					   <option>AM</option>
						<option>PM</option>						
					</select>
					<div class="customformwrap">
					<input type="time" class="custominput without_ampm" value="12:00" id="end_time">
					</div>
					<select class="form-control locationInput end">
						<option>PM</option>
						<option class="optionAM" >AM</option>
					</select>
				</div>
			</div>
		</div>
		<i class="noties">Select a time slot for the appointment</i>
		<div class="tablewrap">
			<table id="customerTable" style="width:100%">
				<thead>
					<tr>
						<th>
							<div class="customcheckbox timeCheck">
								<label>
									<input type="checkbox" class="selectAll" data-name="allcheckbox"> <b></b>
									<span class="chengecolor">Time</span></label>
							</div>
						</th>
						<th>Patient Name</th>
						<th>Patient Contact</th>
						<th>Comments</th>
					</tr>
				</thead>
				<tbody>
				<?php if($this->request->getSession()->read('role_id')==2) {
				if(!empty($appointment)) {  foreach($appointment as $appointments){
					 if(($appointments['bulkcancellation_status']==1)){
						
				 if(function_exists('date_default_timezone_set')) {
					date_default_timezone_set("Asia/Kolkata");
					}
					$today = date("H:i"); 
					sscanf($today, "%d:%d:%d", $hours1, $minutes1, $seconds1);
					$today_time_seconds = isset($hours1) ? $hours1 * 3600 + $minutes1 * 60 + $seconds1 : $minutes1 * 60 + $seconds1; 
										
					$givendate=date("H:i", strtotime($appointments['appointment_time1'])); //die;
					sscanf($givendate, "%d:%d:%d", $hours, $minutes, $seconds);
					$given_time_seconds = isset($hours) ? $hours * 3600 + $minutes * 60 + $seconds : $minutes * 60 + $seconds;
					$expld =  explode(',' ,$appointments['appointment_time1']); 
					$time = strtotime($appointments['appointment_date1']);
					$newformat = date('Y-m-d',$time);  
					 ?>
					 
					<tr>
					<td>
					<div class="customcheckbox timeCheck">
						<label>
						<?php if(($newformat == date('Y-m-d'))) {
                         if(($given_time_seconds >= $today_time_seconds) && ($appointments['payment_data']==0) && ($appointments['queue_data']==0)){	?>
						<input type="checkbox" name="check[]" data-name="checkbox" value="<?= $appointments['id']; ?>"><b></b>
						<?php } }  else { ?>
						<input type="checkbox" name="check[]" data-name="checkbox" value="<?= $appointments['id']; ?>"><b></b>
						<?php } ?>
						<span class="chengecolor"><?= $expld[1] ?></span></label>
					</div>
				</td>
				<td><span class="userName chengecolor">
				<?php foreach($patients as $patient){ echo $patient['id'] == $appointments['patient_id'] ? $patient['fname'].' '.$patient['mname'].' '.$patient['lname'] : ''; } ?></span></td>
				<td><span class="chengecolor"><?php foreach($patients as $patient){ $explCountry = explode(',' ,$patient['country_code']); $explNum = explode(',' ,$patient['m_number']); echo $patient['id'] == $appointments['patient_id'] ? $explCountry[0]." ".$explNum[0] : ''; } ?></span></td>
				<td><?= $appointments['comments'] ?> </td>
					</tr>
				<?php } } } } ?>		
				</tbody>
			</table>
		</div>

	</div>
	</div>
	</div>
	</div>
	</div>	
	
	<!-- Cancel Modal -->
	<div id="cancelModal" class="modal fade" role="dialog">
		<div class="modal-dialog cancellationpopup">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cancel APPOINTMENT</h4>
				</div>
				<div class="modal-body">
					<div class="bulkmodal">
						<p class="text-center">Are you sure you want to cancel appointments?</p>

						<!--<ul class="bulkmodalwrap">
							<li class="bulkmodalliat">
								<div class="customformwrap clearfix">
									<label class="customLabel">Cancellation Message</label>
									<select id="tags" class="custominput singleselect">
										<option></option>
										<option>The Doctor is not avaliable on this particular day. We apologize for the inconvinience.</option>
										<option>The clinic will be closed on the particular day as per government instructions.</option>
									</select>
								</div>
							</li>
							<li class="bulkmodalliat col-lg-6 col-md-6 col-sm-6 col-sm-12">
								<div class="customformwrap">
									<label class="customLabel">Date</label>
									<p>25 Oct, 2018 - 30 Oct, 2018</p>
								</div>
							</li>
							<li class="bulkmodalliat col-lg-6 col-md-6 col-sm-6 col-sm-12">
								<div class="customformwrap">
									<label class="customLabel">Time</label>
									<p>12PM - 2PM, 4PM - 8PM </p>
								</div>
							</li>
						</ul>-->
					</div>
				</div>
				<div class="modal-footer text-center">
					<a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</a>
					<button type="submit" name="save" class="btn btn-primary text-uppercase">Done</button>
				</div>
			</div>
		</div>
	</div>
</form>

<?= $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js','pharmacy/bootstrap-datetimepicker.js']); ?>
<script>
      		
	$(document).ready(function(){
		
  $('#butt').click(function (e) {
	
	 $(".mandatory").each(function()
	   {
		if($(this).val()=="")
		{
			$(this).next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();			
		}
	});
	
	if($('.message').val()=="")
	{
		return false;
	}
    
	   var favorite = [];			
		$("input[name='check[]']:checked").each(function() {           
			favorite.push($(this).val());               
		});
		
		if(favorite.length==0){
			alert('Please select any of the appointment');				
			return false;
		}	
	
 });
			
		var phpDate = '<?= date('d M Y'); ?>';
	    $('#birthdateval').val(phpDate);
	    $('#datetimepicker6').val(phpDate);
	    $('#datetimepicker7').val(phpDate);
		
		var users_id = '<?= $this->request->getSession()->read('users_id') ? $this->request->getSession()->read('users_id') : ""; ?>';
		var clinic_id = '<?= $this->request->getSession()->read('clinic_id') ? $this->request->getSession()->read('clinic_id') : ""; ?>';
		var role_id = '<?= $this->request->getSession()->read('role_id') ? $this->request->getSession()->read('role_id') : ""; ?>';
		
		$('select.selectbox').change(function(){
		var id= typeof($(this).val())?$(this).val():"";
		var appointed_date = $(".calender").val();
		var first_date2 = $(".first_date").val();
		var second_date2 = $(".second_date").val();
		//alert(first_date2+" to "+second_date2+" "+id);
		
		$.ajax({
		url:"<?= $this->Url->build(["controller" => "appointmentcancellation","action" => "selectAppointments"]); ?>",
		data: {id:id, appointed_date:appointed_date, first_date:first_date2, second_date:second_date2},
		success:function(response){ 
		//alert(response);
		console.log(response);	
			$('#customerTable tbody').empty();
			$('#customerTable tbody').append(response);
	        }
		  });
		 });
		 
		 
		 $("body").on("blur",".calender",function(){
		 
		  //alert(users_id);
		  var date = $(this).val();		  
		  if(role_id==1){
		  var doctor_id = typeof($(".selectbox").val())?$(".selectbox").val():'';
		  
		  }else if(users_id!=="" && role_id==2 && clinic_id!==""){
		  var doctor_id = $('.selectbox2').val();
		  //alert(doctor_id);
		  }
		  
		  $.ajax({
		  url:"<?php echo $this->Url->build(["controller" => "appointmentcancellation","action" => "selectAppointments"]); ?>",
		data: {id:doctor_id, appointed_date:date},
		success:function(response){ 
		//alert(response);
		console.log(response);		
			$('#customerTable tbody').empty();
			$('#customerTable tbody').append(response);	
		}
		  });
           }); 

   $("body").on("blur",".first_date",function(){
		  var first_date = $(this).val();
		  //var doctor_id1 = $(".selectbox").val();
		  var second_date1 = $(".second_date").val();
		 //alert(first_date+" to "+second_date1+" "+doctor_id1);
		  if(clinic_id==1 && role_id==1){
		  var doctor_id1 = typeof($(".selectbox").val())?$(".selectbox").val():'';
		  
		  }else if(users_id!=="" && role_id==2 && clinic_id!==""){
		  var doctor_id1 = $('.selectbox2').val();
		  }
		  
		$.ajax({
		url:"<?php echo $this->Url->build(["controller" => "appointmentcancellation","action" => "selectAppointments"]); ?>",
		data: {id:doctor_id1, first_date:first_date,second_date:second_date1},
		 success:function(response){	
		console.log(response);
		$('#customerTable tbody').empty();
		$('#customerTable tbody').append(response);
		} 
		});
           });  

   $("body").on("blur",".second_date",function(){
		  var second_date = $(this).val();
		  //var doctor_id2 = $(".selectbox").val();
		  var first_date1 = $(".first_date").val();
		  //alert(first_date1+" to "+second_date+" "+doctor_id2);
		  
		  if(clinic_id==1 && role_id==1){
		  var doctor_id2 = typeof($(".selectbox").val())?$(".selectbox").val():'';
		  
		  }else if(users_id!=="" && role_id==2 && clinic_id!==""){
		  var doctor_id2 = $('.selectbox2').val();
		  }
		  
		$.ajax({
		url:"<?php echo $this->Url->build(["controller" => "appointmentcancellation","action" => "selectAppointments"]); ?>",
		data: {id:doctor_id2,first_date:first_date1, second_date:second_date},
		success:function(response){	
		console.log(response);
		$('#customerTable tbody').empty();
		$('#customerTable tbody').append(response);
		} 
		});
           }); 

 	$(document).on("change",".start",function(){
		if($(this).val()=='PM'){
		$('.optionAM').prop('disabled',true);	
		} 
       else {
		 $('.optionAM').prop('disabled',false);  
	   } 		
	});	
		   
		$("body").on("blur","#start_time",function(){
		  var time_start = $(this).val()+" "+$(".start").val();
		  var time_end = $("#end_time").val()+" "+$(".end").val();
		  //var doctor_id1 = $(".selectbox").val();
		  var appointed_date1 = $(".calender").val();
		  
		  if(clinic_id==1 && role_id==1){
		  var doctor_id1 = typeof($(".selectbox").val())?$(".selectbox").val():'';
		  
		  }else if(users_id!=="" && role_id==2 && clinic_id!==""){
		  var doctor_id1 = $('.selectbox2').val();
		  }
		  
		$.ajax({
		url:"<?php echo $this->Url->build(["controller" => "appointmentcancellation","action" => "selectAppointments"]); ?>",
		data: {time_start:time_start,time_end:time_end,id:doctor_id1,appointed_date:appointed_date1},
	    success:function(response){	
		console.log(response);
		$('#customerTable tbody').empty();
		$('#customerTable tbody').append(response);
		} 
		});
           }); 
		   
	 $("body").on("blur","#end_time",function(){
		  var time_end1 = $(this).val()+" "+$(".end").val();
		  var time_start1 = $("#start_time").val()+" "+$(".start").val();
		  //var doctor_id2 = $(".selectbox").val();
		  var appointed_date2 = $(".calender").val();
		  
		  if(clinic_id==1 && role_id==1){
		  var doctor_id2 = typeof($(".selectbox").val())?$(".selectbox").val():'';
		  
		  }else if(users_id!=="" && role_id==2 && clinic_id!==""){
		  var doctor_id2 = $('.selectbox2').val();
		  }
		  
		$.ajax({
		url:"<?= $this->Url->build(["controller" => "appointmentcancellation","action" => "selectAppointments"]); ?>",
		data: {time_end:time_end1,time_start:time_start1,id:doctor_id2,appointed_date:appointed_date2},
		success:function(response){	
		console.log(response);
		$('#customerTable tbody').empty();
		$('#customerTable tbody').append(response);
		} 
		  });
           });    
		

     $("body").on("change",".start",function(){
		  var time_start = $("#start_time").val()+" "+$(this).val();
		  var time_end = $("#end_time").val()+" "+$(".end").val();
		  //var doctor_id1 = $(".selectbox").val();
		  var appointed_date1 = $(".calender").val();
		  
		  if(clinic_id==1 && role_id==1){
		  var doctor_id1 = typeof($(".selectbox").val())?$(".selectbox").val():'';
		  
		  }else if(users_id!=="" && role_id==2 && clinic_id!==""){
		  var doctor_id1 = $('.selectbox2').val();
		  }
		  
		$.ajax({
		url:"<?php echo $this->Url->build(["controller" => "appointmentcancellation","action" => "selectAppointments"]); ?>",
		data: {time_start:time_start,time_end:time_end,id:doctor_id1,appointed_date:appointed_date1},
	    success:function(response){	
		console.log(response);
		$('#customerTable tbody').empty();
		$('#customerTable tbody').append(response);
		} 
		});
           }); 
		   
	 $(document).on("change",".end",function(){
		  var time_end1 = $("#end_time").val()+" "+$(this).val();
		  var time_start1 = $("#start_time").val()+" "+$(".start").val();
		  //var doctor_id2 = $(".selectbox").val();
		  var appointed_date2 = $(".calender").val();
		  
		  if(clinic_id==1 && role_id==1){
		  var doctor_id2 = typeof($(".selectbox").val())?$(".selectbox").val():'';
		  
		  }else if(users_id!=="" && role_id==2 && clinic_id!==""){
		  var doctor_id2 = $('.selectbox2').val();
		  }
		  
		$.ajax({
		url:"<?= $this->Url->build(["controller" => "appointmentcancellation","action" => "selectAppointments"]); ?>",
		data: {time_end:time_end1,time_start:time_start1,id:doctor_id2,appointed_date:appointed_date2},
		success:function(response){	
		console.log(response);
		$('#customerTable tbody').empty();
		$('#customerTable tbody').append(response);
		} 
		  });
           });		
		
		 });
		 
</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#datetimepicker6').datetimepicker({
                   format: 'DD MMM YYYY',
		 			minDate: new Date().setHours(0,0,0,0),
					locale:  moment.locale('en', {
			week: { dow: 1 }
		}),
					useCurrent: false
            }).on("dp.change", function(e) {
				$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
			});
			
			$('#datetimepicker7').datetimepicker({
                format: 'DD MMM YYYY',
		 		minDate: new Date().setHours(0,0,0,0),
				locale:  moment.locale('en', {
			week: { dow: 1 }
		}),
				useCurrent: false
            }).on("dp.change", function(e) {
				$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
			});
			
			/*
			$("#datetimepicker6").on("dp.change", function(e) {
				$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
			});
			$("#datetimepicker7").on("dp.change", function(e) {
				$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
			});
			*/
			
			/*
            $('#datetimepicker6').datetimepicker({
                   format: 'DD MMM YYYY',
		 			minDate: new Date().setHours(0,0,0,0),
					useCurrent: false
            });
			
			$('#datetimepicker7').datetimepicker({
                format: 'DD MMM YYYY',
		 			minDate: new Date().setHours(0,0,0,0),
					useCurrent: false
            });
*/
			$(".singleselect").select2();

			$('.menutoggle').click(function() {
				$(this).toggleClass('active');
				$('header').toggleClass('active');
			});
			$('.clderIconClick').click(function() {
				$('#birthdateval').click();
			});
			
			
			$('#birthdateval').datetimepicker({
				//date:new Date(),
                   format: 'DD MMM YYYY',
		 			minDate: new Date().setHours(0,0,0,0),
					locale:  moment.locale('en', {
			                 week: { dow: 1 } }),
					useCurrent: false,
					//maxDate: moment()
					//minDate: moment()
		 			 });

			$("#birthdateval").on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD MMM YYYY'));
			});

			$("#birthdateval").on('cancel.daterangepicker', function(ev, picker) {
				$(this).val('');
			});

			$('#daterange').daterangepicker({
				autoUpdateInput: false,
				autoApply: true,
				timePicker: true,
				startDate: moment().startOf('hour'),
				endDate: moment().startOf('hour').add(32, 'hour'),
				locale: {
					format: 'DD MMM YYYY hh:mm A'
				}
			});

			$('#daterange').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD MMM YYYY hh:mm A') + ' - ' + picker.endDate.format('DD MMM YYYY hh:mm A'));
			});

			$('#daterange').on('cancel.daterangepicker', function(ev, picker) {
				$(this).val('');
			});

			$('.singleclick').hide()
			$('.showrangedate').hide();
			$('.multiclick').click(function() {
				$(this).hide();
				$('.singleclick').show();
				$('.showrangedate').show();
				$('.showsingledate').hide();
				$('#daterange').click();
				$('.timerange').hide();

			});

			$('.singleclick').click(function() {
				$(this).hide();
				$('.showrangedate').hide();
				$('.showsingledate').show();
				$('.multiclick').show();
				$('#birthdateval').click();
				$('.timerange').show();
			});

			$('.clderIconClickrange').click(function() {
				$('#daterange').click();
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

			
			//////////////////////////////
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
			/////////////////////////
			// CHECKBOX TOGGLE FUNCTION

			$('[data-name="allcheckbox"]').on('click', function() {
				var $this = $(this);
				var $checkbox = $this.closest('.tablewrap').find('[data-name="checkbox"]');
				if (this.checked) {
					$checkbox.each(function() {
						this.checked = true;
					});
				} else {

					$checkbox.each(function() {
						this.checked = false;


					});
				}
			});

			$('[data-name="checkbox"]').on('click', function() {
				if (!this.checked) {
					$('.selectAll').prop('checked', false);
				}

				var $this = $(this);
				var $total = $this.closest('.tablewrap').find('[data-name="checkbox"]');
				var $checked = $this.closest('.tablewrap').find('[data-name="checkbox"]:checked');
				var $allcheckbox = $this.closest('.tablewrap').find('[data-name="allcheckbox"]');
				if ($checked.length == $total.length) {
					$allcheckbox.prop('checked', true);
					console.log('ALL');
				} else if ($checked.length > 0) {
					console.log($checked.length);
				} else {
					$allcheckbox.prop('checked', false);
					console.log('ZERO');
				}
			});
			
			$('#customerTable').DataTable({
				responsive: true,
				info: false,
				paging: false,
				searching: false,
				ordering: false
			});
		});
	</script>

    <!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->