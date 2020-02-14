    <header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	<form method="post" action="<?= $this->Url->build(["controller" =>"blackout","action" => "save"]); ?>">
	<input type="hidden" name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
	<input type="hidden" name="id" value="<?php echo isset($valuee['id'])?$valuee['id']:''; ?>" >
	
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
						<a href="<?php echo $this->Url->build(["controller"=>"blackout","action"=>"index"]); ?>" class="backLink text-uppercase">
						<img src="<?php echo PATH.'img/doctor/back-arrow.png'; ?>">Back</a>
						<div class="customHead"><b><img src="<?php echo PATH.'img/doctor/doctor-app.png';?>" alt="" /></b> <span><?php echo isset($valuee['id'])?'Edit Blackout Date':'Create Blackout Date'; ?></span></div>
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
					<?php if($this->request->getSession()->read('role_id')==1) { ?>
						<div class="slt-gender col-lg-8 col-md-8 col-sm-8">
							<div class="customformwrap">
								<label class="customLabel">Select Doctor</label>
								<select class="custominput singleselect selectbox mandatory" name="doctor_id" id="doct_id">
								
									<option value="">Select</option>
									<?php 
									if(isset($data) && !empty($data)) {
									foreach($data as $key=>$value){ ?>
									<option id="<?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?>" value="<?php echo $value['id']; ?>" <?php echo $value['id']==$valuee['doctor_id'] ? 'selected' : ''; ?> >Dr.<?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?>
									</option>
									<?php } } ?>
									
								</select>
								<p class="msg1 errorClass1"></p>
							</div>
						</div>
					<?php } else { ?>
					<input type="hidden" name="doctor_id" value="<?= $data[0]["id"]; ?>">
					<?php } ?>
					</div>					
				</div>
				
<?php $date1 = date("d M Y",strtotime($valuee['blackout_startdate']));
		  $date2 = date("d M Y",strtotime($valuee['blackout_enddate']));
		  $time1 = date("h A",strtotime($valuee['blackout_starttime']));
		  $exp_time1 = explode(' ',$time1);
		  $time2 = date("h A",strtotime($valuee['blackout_endtime'])); 
		  $exp_time2 = explode(' ',$time2); 
		  $currentDate = date('d M Y'); ?>
		  
 <div class="createblackdate">
	<div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-2">
		<div class="createblacklist clearfix"> <span class="titlecolortitle">Select Date Range</span>
			<div class="datefromText">
			<input type="text" id="productOnlyDate" class="hiddenCld mandatory" name="blackout_date">			
			<label>From</label>&nbsp;&nbsp;<span id="belowStartDate" data-id="" class="mandatory">
			<?= !empty($valuee['blackout_startdate'])?$date1:$currentDate ?></span>&nbsp;&nbsp; 
			<label>To</label> &nbsp;&nbsp;<span id="belowEndDate" data-id="" class="mandatory">
			<?= !empty($valuee['blackout_enddate'])?$date2:$currentDate ?></span>
			<b class="clderIcon sprite callCld"></b> <!--<p class="msg8 errorClass1"></p>--></div>
		</div>
				
	<div class="clearfix createblacklist">
	<div class="timerange"> <span class="titlecolortitle">Time Range</span>
	
		<div class="customformwrap">	
		<?php //echo $time2; ?>
		 <select class="form-control locationInput" name="start_time" id="start_time">
		 <?php for($i=1; $i<=12; $i++){ ?>
		 <option value="<?= $i.':00' ?>" <?= isset($exp_time1[0]) && $exp_time1[0]==$i ? 'selected' : '' ?>><?= $i.':00' ?></option>
		 <?php } ?>
		 </select>
		 </div>
		
		<select class="form-control locationInput am" name="amtime">
		<option value="AM" <?= !empty($valuee['blackout_starttime']) && $exp_time1[1]=='AM' ?'selected':'';?>>AM</option>
		<option value="PM" <?= !empty($valuee['blackout_starttime']) && $exp_time1[1]=='PM' ?'selected':'';?>>PM</option>
		</select>
		
		<div class="customformwrap">		 
		 <select class="form-control locationInput" id="end_time" name="end_time">
		 <?php for($i=1; $i<=12; $i++){ ?>
		 <option value="<?= $i.':00' ?>" <?= isset($exp_time2[0]) && $exp_time2[0]==$i ? 'selected' : '' ?>><?= $i.':00' ?></option>
		 <?php } ?>
		 </select></div>
		
		<select class="form-control locationInput pm" name="pmtime">
		<option value="PM" <?= !empty($valuee['blackout_endtime']) && $exp_time2[1]=='PM' ? 'selected' : '' ?>>PM</option>
		<option class="optionAM" value="AM" <?= !empty($valuee['blackout_endtime']) && $exp_time2[1]=='AM' ? 'selected' : '' ?>>AM</option>		
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
			<textarea class="custominput" style="min-height: 60px;" name="comments" id="note"><?php echo isset($valuee['comments'])?$valuee['comments']:''; ?></textarea>
			<!--<p class="msg4 errorClass1"></p>-->
			</div>
		</div>
		<br />
		<br />
		<div class="clearfix">
			<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-3"> <a href="<?= $this->Url->build(["controller" =>"blackout","action" => "index"]); ?>" class="btn btn-default">Cancel</a> <a href="#" id="submit" class="btn btn-primary" data-toggle="modal" data-target="#cancelModal">Save</a> </div>
		</div>
							</div>
						</div>
					</div>
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
					<h4 class="modal-title">CREATE BLACKOUT DATES</h4>
				</div>
				<div class="modal-body text-center">
					<p>Are you sure you want to blackout appointment?</p>
					<!--<ul class="text-left ">
						<li class="">
							<div class="customformwrap">
								<label class="customLabel">Doctor Name</label>
								<p id="doct_name"></p>
							</div>
						</li>
						<li>
							<div class="customformwrap">
								<label class="customLabel">Date</label>
								<p id="black_date"></p>
							</div>
						</li>
						<li>
							<div class="customformwrap">
								<label class="customLabel">Time</label>
								<p id="black_time"></p>
							</div>
						</li>
					</ul>-->
				</div>
				<div class="modal-footer text-center"> <a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</a> <button type="submit" class="btn btn-primary text-uppercase">Confirm</button> </div>
			</div>
		</div>
	</div>
	</form>
<?php echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.js']); ?>
<script>
$(document).on("change",".am",function(){
		if($(this).val()=='PM'){
		$('.optionAM').prop('disabled',true);	
		} 
       else {
		 $('.optionAM').prop('disabled',false);  
	   } 		
	});	

$('#submit').click(function (e) {
	
	$(".mandatory").each(function()
	{
		if($(this).val()=="")
		{
			$(this).next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
			$(this).next().next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
		}
	});
	
	if($('#doct_id').val()=="" || $('#productOnlyDate').val()=="")
	{
		return false;
	}
    
});
</script>
	<script type="text/javascript">
		$(document).ready(function() {
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
			$('.otherdocClick').click(function() {
				$('.repeatblackoutTime').addClass('active');
			});
			$('.clderIconClick').click(function() {
				$('#birthdateval').click();
			});
			$("#birthdateval").daterangepicker({
				autoUpdateInput: true,
				singleDatePicker: true,
				locale: {
					format: 'DD MMM YYYY'
				}
			});
			$("#birthdateval").on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD MMM YYYY'));
			});
			$("#birthdateval").on('cancel.daterangepicker', function(ev, picker) {
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
			});
			$('.singleclick').click(function() {
				$(this).hide();
				$('.showrangedate').hide();
				$('.showsingledate').show();
				$('.multiclick').show();
				$('#birthdateval').click();
			});
			var $abovestartDate = $("#aboveStartDate").attr("data-id");
			var $aboveendDate = $("#aboveEndDate").attr("data-id");
			$('#overAllDate').daterangepicker({
				"autoApply": true,
				"minDate": 0,
				"startDate": $abovestartDate,
				"endDate": $aboveendDate,
				"firstDayOfWeek": 2,
				"maxDate": moment(),
			}, function(start, end, label) {
				console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
				$("#aboveStartDate").text(start.format('DD MMM YYYY'))
				$("#aboveEndDate").text(end.format('DD MMM YYYY'))
			});
			var $belowstartDate = $("#aboveStartDate").attr("data-id");
			var $belowendDate = $("#aboveEndDate").attr("data-id");
			$('#productOnlyDate').daterangepicker({
				"autoApply": true,
				"minDate": moment(),
				"startDate": $belowstartDate,
				"endDate": $belowendDate,
				"firstDayOfWeek": 2,
					//, "maxDate": moment()
					locale: {
                    firstDay: 1
                    }
			}, function(start, end, label) {
				console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
				$("#belowStartDate").text(start.format('DD MMM YYYY'))
				$("#belowEndDate").text(end.format('DD MMM YYYY'))
			});
			$(document).on("click", ".callCld", function() {
				$(this).closest(".datefromText").find("input").trigger("click");
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
			$("#daterange").keyup(function() {
				if ($(this).val().length == 0) {
					$('#daterange').removeClass('active');
				} else {
					$('#daterange').addClass('active');
				}
			});
		});
	</script>
	
	<script>
	/*$(document).ready(function() {
	$('select.selectbox').change(function(){
		var id= typeof($(this).val())?$(this).val():"";
		var start_time = $("#start_time").val() +" "+ $('select.am').val();
		var end_time = $("#end_time").val() +" "+ $('select.pm').val();
		var first_date = $("#belowStartDate").text();
		var second_date = $("#belowEndDate").text();
		//alert(start_time+" to "+end_time+" "+first_date+" To "+second_date+" "+id);
		
		$.ajax({
		url:"<?php echo $this->Url->build(["controller" => "blackout","action" => "blackoutDatetime"]); ?>",
		data: {id:id, start_time:start_time, end_time:end_time, first_date:first_date, second_date:second_date},
		
		  });
		 });
		 
		$(document).on('blur','#belowStartDate',function(){
		alert();
		var doctor_id = typeof($(".selectbox").val())?$(".selectbox").val():"";
		var start_time1 = $("#start_time").val() +" "+ $('select.am').val();
		var end_time1 = $("#end_time").val() +" "+ $('select.pm').val();
		var first_date1 = $("#belowStartDate").text();
		var second_date1 = $("#belowEndDate").text();
		alert(start_time1+" to "+end_time1+" "+first_date1+" To "+second_date1+" "+doctor_id);
		
		//$.ajax({
		//url:"<?php echo $this->Url->build(["controller" => "blackout","action" => "blackoutDatetime"]); ?>",
		//data: {id:id, start_time:start_time, end_time:end_time, first_date:first_date, second_date:second_date},
		
		  //});
		 });
		 
		 $("body").on("blur","#start_time",function(){
		  var start_time2 = $(this).val() +" "+ $('select.am').val();
		  var end_time2 = $("#end_time").val() +" "+ $('select.pm').val();
		  var doctor_id2 = typeof($(".selectbox").val())?$(".selectbox").val():"";
		  var first_date2 = $("#belowStartDate").text();
		  var second_date2 = $("#belowEndDate").text();
		  alert(start_time2+" to "+end_time2+" "+first_date2+" To "+second_date2+" "+doctor_id2);
		  
		//$.ajax({
		//url:"<?php echo $this->Url->build(["controller" => "appointmentcancellation","action" => "selectAppointments"]); ?>",
		//data: {time_start:time_start,time_end:time_end,id:doctor_id1,appointed_date:appointed_date1},
	     
		//});
           }); 
		  
	});*/
	</script>
	
	
   <!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->