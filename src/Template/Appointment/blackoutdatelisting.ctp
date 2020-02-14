

<body>
	<!-- HEADER -->
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-md-6 col-12">
						<div class="customHead"> <b><i class="sprite settingIcon"></i></b> <span>Blackout Dates</span> </div>
					</li>
					<li class="col-md-6 col-12 text-right"><a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"createblackoutdate"]); ?>" class="btn btn-secondary text-uppercase">Create Blackout Dates</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			 
			<div class="tab-content">
				 <div id="executiveTab" class="tab-pane fade in active">
						<div class="reportPage onlytable">
						<div class="tablewrap ">
							<table id="executiveTable" style="width:100%">
								<thead>
									<tr>
										<th>Doctor Name</th>
									 	<th>Blackout Dates</th>
										<th>Time </th>
										<th class="commentblackout">Comments </th>
									 	<th class="text-center nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Dr. Ravi Verma</td>
									 	<td>1 Oct, 2018 - 10 Oct, 2018</td>
									 	<td>9:00 AM - 05:30PM</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</td>
										<td class="text-center">
											  <a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"editblackoutdate"]); ?>" class="text-uppercase actionLink text-link" >Edit</a> | <a href="#" class="text-uppercase actionLink text-secondary" data-toggle="modal" data-target="#confirmationModal">Remove</a></td>
									</tr>
									<tr>
										<td>Dr. Vivaan Gupta</td>
										 
										<td>1 Oct, 2018 - 10 Oct, 2018</td>
									 	<td>9:00 AM - 05:30PM</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</td>
										<td class="text-center">
											  <a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"editblackoutdate"]); ?>" class="text-uppercase actionLink text-link" >Edit</a> | <a href="#" class="text-uppercase actionLink text-secondary" data-toggle="modal" data-target="#confirmationModal">Remove</a></td>	</tr>
									<tr>
										<td>Dr. Reyansh Chauhan</td>
										 
										<td>1 Oct, 2018 - 10 Oct, 2018</td>
									 	<td>9:00 AM - 05:30PM</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</td>
										<td class="text-center">
											  <a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"editblackoutdate"]); ?>" class="text-uppercase actionLink text-link" >Edit</a> | <a href="#" class="text-uppercase actionLink text-secondary" data-toggle="modal" data-target="#confirmationModal">Remove</a></td></tr>
									<tr>
										<td>Dr. Sai Garg</td>
										<td>1 Oct, 2018 - 10 Oct, 2018</td>
									 	<td>9:00 AM - 05:30PM</td>
										<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</td>
										<td class="text-center">
											  <a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"editblackoutdate"]); ?>" class="text-uppercase actionLink text-link" >Edit</a> | <a href="#" class="text-uppercase actionLink text-secondary" data-toggle="modal" data-target="#confirmationModal">Remove</a></td></tr>
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
	<div id="newEmployeeModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create New Employee</h4>
				</div>
				<div class="modal-body">
					<ul class="row">
						<li class="col-sm-12">
							<label class="form-label">First Name</label>
							<input type="text" class="form-control" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Middle Name</label>
							<input type="text" class="form-control" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Last Name</label>
							<input type="text" class="form-control" />
						</li>
						<li class="col-4 col-md-3">
							<label class="form-label">Date of birth</label>
							<select class="form-control">
								<option>01</option>
								<option>02</option>
								<option>03</option>
								<option>04</option>
								<option>05</option>
								<option>06</option>
								<option>07</option>
								<option>08</option>
								<option>09</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
							</select>
						</li>
						<li class="col-4 col-md-4">
							<label class="form-label"></label>
							<select class="form-control">
								<option>Jan</option>
								<option>Feb</option>
								<option>Mar</option>
								<option>Apr</option>
								<option>May</option>
								<option>Jun</option>
								<option>Jul</option>
								<option>Aug</option>
								<option>Sep</option>
								<option>Oct</option>
								<option>Nov</option>
								<option>Dec</option>
							</select>
						</li>
						<li class="col-4 col-md-5">
							<label class="form-label"></label>
							<select class="form-control">
								<option>2018</option>
								<option>2017</option>
								<option>2016</option>
								<option>2015</option>
								<option>2014</option>
							</select>
						</li>
						<li class="col-sm-12">
							<label class="form-label">Mobile Number</label>
							<input type="text" class="form-control" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Email Address</label>
							<input type="email" class="form-control" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Username</label>
							<input type="text" class="form-control" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Password</label>
							<input type="password" class="form-control" />
						</li>
					</ul>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary text-uppercase">Create</button>
				</div>
			</div>
		</div>
	</div>

	<!-- EDIT MODAL -->
	<div id="editEmployeeModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Employee</h4>
				</div>
				<div class="modal-body">
					<ul class="row">
						<li class="col-sm-12">
							<label class="form-label">First Name</label>
							<input type="text" class="form-control" value="Prashant" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Middle Name</label>
							<input type="text" class="form-control" value="Kumar" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Last Name</label>
							<input type="text" class="form-control" value="Verma" />
						</li>
						<li class="col-4 col-md-3">
							<label class="form-label">Date of birth</label>
							<select class="form-control">
								<option>01</option>
								<option>02</option>
								<option>03</option>
								<option>04</option>
								<option selected>05</option>
								<option>06</option>
								<option>07</option>
								<option>08</option>
								<option>09</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
							</select>
						</li>
						<li class="col-4 col-md-4">
							<label class="form-label"></label>
							<select class="form-control">
								<option>Jan</option>
								<option>Feb</option>
								<option>Mar</option>
								<option>Apr</option>
								<option>May</option>
								<option selected>Jun</option>
								<option>Jul</option>
								<option>Aug</option>
								<option>Sep</option>
								<option>Oct</option>
								<option>Nov</option>
								<option>Dec</option>
							</select>
						</li>
						<li class="col-4 col-md-5">
							<label class="form-label"></label>
							<select class="form-control">
								<option>2018</option>
								<option selected>2017</option>
								<option>2016</option>
								<option>2015</option>
								<option>2014</option>
							</select>
						</li>
						<li class="col-sm-12">
							<label class="form-label">Mobile Number</label>
							<input type="text" class="form-control" value="098989898" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Email Address</label>
							<input type="email" class="form-control" value="pcverma@gmail.com	" />
						</li>
					</ul>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary text-uppercase">Create</button>
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
					<p>Are you sure you want to remove this?</p>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary text-uppercase">Remove</button>
				</div>
			</div>
		</div>
	</div>
	<!-- CHANGE REQUEST MODAL -->
	<div id="changerequestModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Change Request</h4>
				</div>
				<div class="modal-body text-center">
					<p>The doctor has requested to change the following information</p>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Reject</button>
					<button type="button" class="btn btn-primary text-uppercase">Approve</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function() {

			$('#doctorTable').DataTable({
				responsive: true,
				info: false,
				paging: false,
				searching: false,
				aoColumnDefs: [{
					'bSortable': false,
					'aTargets': ['nosort']
				}]
			});
			$('#executiveTable').DataTable({
				responsive: true,
				info: false,
				paging: false,
				searching: false,
				aoColumnDefs: [{
					'bSortable': false,
					'aTargets': ['nosort']
				}]
			});

			$('.menutoggle').click(function() {
				$(this).toggleClass('active');
				$('header').toggleClass('active');
			});


		});
	</script>
</body>
