
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
						<div class="customHead"> <b><img src="images/doctor-app.png" alt="" /></b> <span>Bulk Appointment Cancellation</span> </div>
					</li>
					<li class="col-lg-4 col-md-5 col-sm-12 col-xs-12 pull-right">
						<div class="headLink"> <a href="#" class="pull-right btn btn-primary text-uppercase" data-toggle="modal" data-target="#cancelModal">Cancel Appointments </a> </div>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
		 
					<div class="customerlistWrap">
						<div class="createappointment clearfix">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="slt-gender col-lg-4 col-md-4 col-sm-12 col-xs-6 ">
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
						<div class="bulkcustomWrap clearfix col-lg-12 row">
							<div class="customerlistHead"> <span class="titledate">Date of appointment</span>&nbsp;&nbsp;
								<div class="searchBox calenderwith showsingledate">
									<input type="text" id="birthdateval" placeholder="Select Date">
									<button><b class="sprite clderIcon cld_icon clderIconClick"></b></button>
								</div>
								<div class="calenderwith showrangedate  datetimecalen">
									
		<div class='col-md-6'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker6'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-6'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker7'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
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

								<div class="timerange ">
									<span class="titledate">Time Range</span>&nbsp;&nbsp;

									<div class="customformwrap">
										<input type="time" class="custominput without_ampm" value="10:12">
									</div>
									<select class="form-control locationInput">
										<option>AM</option>
										<option>PM</option>
									</select>
									<div class="customformwrap">
										<input type="time" class="custominput without_ampm" value="20:12">
									</div>
									<select class="form-control locationInput">
										<option>AM</option>
										<option>PM</option>
									</select>

								</div>
							</div>
						</div>
						<i class="noties">Select a time slot for the appointment</i>
						<div class="tablewrap ">
							<table id="customerTable" style="width:100%">
								<thead>
									<tr>
										<th>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" class="selectAll" data-name="allcheckbox" checked> <b></b><span class="chengecolor">Time</span></label>
											</div>
										</th>
										<th>Patient Name</th>
										<th>Patient Contact</th>
										<th>Comments</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" data-name="checkbox" checked> <b></b><span class="chengecolor">9:00 AM</span></label>
											</div>
										</td>
										<td><span class="userName chengecolor">Jatin Verma (Mr)</span></td>
										<td><span class="chengecolor">+91 838782882</span></td>
										<td> Check reports of Medical tests prescribed in the last apointment. </td>
									</tr>
									<tr>
										<td>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" data-name="checkbox" checked> <b></b><span class="chengecolor">9:15 AM</span></label>
											</div>
										</td>
										<td><span class="userName chengecolor">Somya Banerjee (Mrs)</span></td>
										<td><span class="chengecolor">+91 838782882</span></td>
										<td> First Appointment, priority. </td>
									</tr>
									<tr>
										<td>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" data-name="checkbox" checked> <b></b><span class="chengecolor">9:30 AM</span></label>
											</div>
										</td>
										<td><span class="userName chengecolor">Karan Gupta (Mr)</span></td>
										<td><span class="chengecolor">+91 838782882</span></td>
										<td> No comments </td>
									</tr>
									<tr>
										<td>
											<span class="chengecolor">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9:30 AM</span>
										</td>
										<td><span class="yettitle">No Appointment yet</span></td>
										<td><span class="chengecolor">&nbsp;</span></td>
										<td>
											<div class="form-group" style="display: none;">
												<textarea class="form-control"></textarea>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" data-name="checkbox" checked> <b></b><span class="chengecolor">9:45 AM</span></label>
											</div>
										</td>
										<td><span class="userName chengecolor">Jatin Verma (Mr)</span></td>
										<td><span class="chengecolor">+91 838782882</span></td>
										<td> Critical case. </td>
									</tr>
									<tr>
										<td>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" data-name="checkbox" checked> <b></b><span class="chengecolor">10:00 AM</span></label>
											</div>
										</td>
										<td><span class="userName chengecolor">Jatin Verma (Mr)</span></td>
										<td><span class="chengecolor">+91 838782882</span></td>
										<td> No comments </td>
									</tr>
									<tr>
										<td>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" data-name="checkbox" checked> <b></b><span class="chengecolor">9:15 AM</span></label>
											</div>
										</td>
										<td><span class="userName chengecolor">Somya Banerjee (Mrs)</span></td>
										<td><span class="chengecolor">+91 838782882</span></td>
										<td> First Appointment, priority. </td>
									</tr>
									<tr>
										<td>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" data-name="checkbox" checked> <b></b><span class="chengecolor">9:30 AM</span></label>
											</div>
										</td>
										<td><span class="userName chengecolor">Karan Gupta (Mr)</span></td>
										<td><span class="chengecolor">+91 838782882</span></td>
										<td> No comments </td>
									</tr>
									<tr>
										<td>
											<span class="chengecolor">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9:30 AM</span>
										</td>
										<td><span class="yettitle">No Appointment yet</span></td>
										<td><span class="chengecolor">&nbsp;</span></td>
										<td>
											<div class="form-group" style="display: none;">
												<textarea class="form-control"></textarea>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" data-name="checkbox" checked> <b></b><span class="chengecolor">9:45 AM</span></label>
											</div>
										</td>
										<td><span class="userName chengecolor">Jatin Verma (Mr)</span></td>
										<td><span class="chengecolor">+91 838782882</span></td>
										<td> Critical case. </td>
									</tr>
									<tr>
										<td>
											<div class="customcheckbox timeCheck">
												<label>
													<input type="checkbox" data-name="checkbox" checked> <b></b><span class="chengecolor">10:00 AM</span></label>
											</div>
										</td>
										<td><span class="userName chengecolor">Jatin Verma (Mr)</span></td>
										<td><span class="chengecolor">+91 838782882</span></td>
										<td> No comments </td>
									</tr>
								</tbody>
							</table>
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
	<div id="createpatient-Modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create New Patient</h4>
				</div>
				<div class="modal-body">

					<form class="create-patient-form">
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">First Name</label>
								<input type="text" class="custominput">
							</div>
						</fieldset>
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">Middle Name</label>
								<input type="text" class="custominput">
							</div>
						</fieldset>
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">Last Name</label>
								<input type="text" class="custominput">
							</div>
						</fieldset>

						<fieldset>
							<label class="datebirtdTitle clearfix">Date Of Birth</label>

							<div class="customformwrap dateslt">

								<select class="custominput singleselect ">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
									<option>7</option>
									<option>8</option>
									<option>9</option>
									<option>10</option>
									<option>11</option>
									<option>12</option>
									<option>13</option>
									<option>14</option>
									<option>15</option>
									<option>16</option>
									<option>17</option>
									<option>18</option>
									<option>19</option>
									<option>20</option>
									<option>21</option>
									<option>22</option>
									<option>23</option>
									<option>24</option>
									<option>25</option>
									<option>26</option>
									<option>27</option>
									<option>28</option>
									<option>29</option>
									<option>30</option>
								</select>
							</div>
							<div class="customformwrap monthslt">


								<select class="custominput singleselect ">
									<option>Jan</option>
									<option>Feb</option>
									<option>Mar</option>
									<option>Apr</option>
									<option>May</option>
									<option>Jun</option>
									<option>July</option>
									<option>Aug</option>
									<option>Sep</option>
									<option>Oct</option>
									<option>Nov</option>
									<option>Dec</option>
								</select>

							</div>
							<div class="customformwrap yearslt">

								<select class="custominput singleselect ">
									<option>1991</option>
									<option>1992</option>
									<option>1993</option>
									<option>1994</option>
									<option>1995</option>
									<option>1996</option>
									<option>1997</option>
									<option>1998</option>
									<option>1999</option>
									<option>2000</option>
									<option>2001</option>
									<option>2002</option>
									<option>2003</option>
									<option>2004</option>
									<option>2005</option>
									<option>2006</option>
									<option>2007</option>
									<option>2008</option>
									<option>2009</option>
									<option>2010</option>
									<option>2011</option>
									<option>2012</option>
									<option>2013</option>
									<option>2014</option>
									<option>2015</option>
									<option>2016</option>
									<option>2017</option>
									<option>2018</option>

								</select>
							</div>



						</fieldset>
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">Mobile Number</label>
								<input type="text" class="custominput">
							</div>
						</fieldset>
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">Email Address</label>
								<input type="text" class="custominput">
							</div>
						</fieldset>
						<fieldset class="address-fieldset">
							<div class="customformwrap">
								<label class="customLabel">Address</label>
								<input type="text" class="custominput">
								<input type="text" class="custominput">
							</div>
						</fieldset>
						<fieldset class="contryformwrap">
							<div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
								<label class="customLabel">Country</label>
								<select class="custominput singleselect ">
									<option>1</option>
								</select>
							</div>
							<div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
								<label class="customLabel">State</label>
								<select class="custominput singleselect ">
									<option>1</option>
								</select>
							</div>

						</fieldset>
						<fieldset class="contryformwrap">
							<div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
								<label class="customLabel">City</label>
								<select class="custominput singleselect ">
									<option>1</option>
								</select>
							</div>
							<div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
								<label class="customLabel">Pincode</label>
								<input type="text" class="custominput">
							</div>

						</fieldset>
					</form>

				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary text-uppercase">Add</button>
				</div>
			</div>
		</div>
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
		<div class="modal-dialog cancellationpopup">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cancel APPOINTMENT</h4>
				</div>
				<div class="modal-body">
					<div class="bulkmodal">
						<p class="text-center">Are you sure you want to cancel all appointments?</p>

						<ul class="bulkmodalwrap">
							<li class="bulkmodalliat">
								<div class="customformwrap clearfix">
									<label class="customLabel">Cancelation Message</label>
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

						</ul>
					</div>
				</div>
				<div class="modal-footer text-center">
					<a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</a>
					<a href="appointments.html" class="btn btn-primary text-uppercase">Done </a>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			 $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
			//,inline: true
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });

			$(".singleselect").select2();
			
			$('.menutoggle').click(function() {
				$(this).toggleClass('active');
				$('header').toggleClass('active');
			});
			$('.clderIconClick').click(function() {
				$('#birthdateval').click();
			});
			$("#birthdateval").daterangepicker({
				//autoUpdateInput: true,
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


$('#customerTable').DataTable({
				responsive: true,
				info: false,
				paging: false,
				searching: false,
				ordering: false
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
		});
	</script>
</body>

</html>