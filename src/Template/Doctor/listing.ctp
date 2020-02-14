
<body>

	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-md-6 col-sm-5 col-12">
						<div class="customHead"> <b><i class="sprite settingIcon"></i></b> <span>Doctor</span> </div>
					</li>
					<li class="col-md-2 col-sm-3 col-12">
						<div class="d-inline-block pull-right">
							<div class="custom-radio d-inline-block">
								<label class="custom-label" for="name">Name
									<input type="radio" class="custom-control-input nameRadio" id="name" name="search" checked> <b></b>
								</label>
							</div>
							<div class="custom-radio d-inline-block">
								<label class="custom-label" for="dob">DOB
									<input type="radio" class="custom-control-input dobRadio" id="dob" name="search"> <b></b>
								</label>
							</div>
						</div>
					 </li>
					<li class="col-md-4 col-sm-4 col-12">
						<div class="searchclient searchByNameDiv">
							<input autocomplete="off" type="text" class="searchDoctorName" placeholder="Search by Name" />
							<b><img src="<?php echo PATH."img/doctor/icons-search.png" ?>" /></b>
						</div>
						<div class="searchclient searchByDOBDiv" style="display:none;">
							<input autocomplete="off" type="text" class="searchDoctorDOB" id="birthdateval" placeholder="DD/MM/YYYY" style="cursor:pointer;" />
							<b><img src="<?php echo PATH."img/doctor/icons-search.png" ?>" /></b>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="clearfix posirelative">
				<ul class="nav nav-tabs pull-left">
					<li class="active"><a data-toggle="tab" href="#doctorTab" aria-expanded="true">All</a></li>
					<!--<li><a data-toggle="tab" href="#executiveTab" aria-expanded="true">New Requests</a></li>-->
				</ul>
				<div class="pull-right crtdoctorbtn">
					<a href="<?php echo $this->url->build(["controller"=>"Doctor","action"=>"index"]); ?>" class="btn btn-secondary text-uppercase ">Create New Doctor</a>
				</div>
			</div>
			
			<div class="tab-content">
				<div id="doctorTab" class="tab-pane fade in active">
					<div class="reportPage onlytable radiusleft0 docviewtable">
						<div class="tablewrap ">
							<table id="doctorTable" style="width:100%">
								<thead>
									<tr>
										<th>Doctor Name</th>
										<th>Contact</th>
										<th>Email ID </th>
										<th class="text-center nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($allData) && !empty($allData)) {
									foreach($allData as $key => $value) {
									
									$emailData = isset($value["email"]) && !empty($value["email"]) ? json_decode($value["email"],true) : "";
									$phoneData = isset($value["phone"]) && !empty($value["phone"]) ? json_decode($value["phone"],true) : "";
									
									$currentYear = date("Y");
									$dob = explode("/",date("d/m/Y",strtotime($value["dob"])));
									?>
									<tr class="<?php //echo $value["id"]==1 ? "alertRow" : ""; ?>">
										<td class="doctorName">
											<?php echo isset($value["first_name"]) ? $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"] : ""; ?>
											<div><?php echo $dob[0]."/".$dob[1]."/".$dob[2]; ?> (<?php echo $currentYear - $dob[2] ?> yrs)</div>
											<div class="doctorDOB" style="display:none;"><?php echo $dob[0]."/".$dob[1]."/".$dob[2]; ?></div>
										</td>
										<td><?php echo $phoneData[0]["phone_code"]."-".$phoneData[0]["phone"]; ?></td>
										<td><?php echo $emailData[0]; ?></td>
										<td class="text-center">
											<a href="<?php echo $this->url->build(["controller"=>"Doctor","action"=>"doctorprofile",base64_encode($value["id"])]); ?>" class="text-uppercase actionLink text-link">View</a> | 
											<a href="<?php echo $this->url->build(["controller"=>"Doctor","action"=>"index",base64_encode($value["id"])]); ?>" class="text-uppercase actionLink text-link">Edit</a> | 
											<a class="text-uppercase actionLink text-link activateClass activateClass_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" data-id="<?php echo $value["is_active"]; ?>" style="cursor:pointer;">
												<?php echo $value["is_active"]==1 ? "De-Activate" : "Activate"; ?>
											</a>
										</td>
									</tr>
									<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<div id="executiveTab" class="tab-pane fade">
						<div class="reportPage onlytable radiusleft0 docviewtable">
						<div class="tablewrap ">
							<table id="executiveTable" style="width:100%">
								<thead>
									<tr>
										<th>Doctor Name</th>
									 	<th>Contact</th>
										<th>Email ID </th>
									  	<th class="text-center nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($allData) && !empty($allData)) {
									foreach($allData as $key => $value) {
									$emailData = isset($value["email"]) && !empty($value["email"]) ? json_decode($value["email"],true) : "";
									$phoneData = isset($value["phone"]) && !empty($value["phone"]) ? json_decode($value["phone"],true) : "";
									?>
									<tr>
										<td><?php echo isset($value["first_name"]) ? $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"] : ""; ?></td>
										<td><?php echo $phoneData[0]["phone_code"]."-".$phoneData[0]["phone"]; ?></td>
										<td><?php echo $emailData[0]; ?></td>
										<td class="text-center">
											<a href="<?php echo $this->url->build(["controller"=>"Doctor","action"=>"doctorprofile",$value["id"]]); ?>" class="text-uppercase actionLink text-link">Review</a>
										</td>
									</tr>
									<?php } } ?>
								</tbody>
							</table>
						</div>
					</div>
			
				</div>
			</div>
		</div>
	</div>

	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->

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
					<p>Are you sure you want to de-activate this doctor?</p>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">No</button>
					<button type="button" class="btn btn-primary text-uppercase">Yes</button>
				</div>
			</div>
		</div>
	</div>
	
	<!-- APPROVE Modal -->
	<div id="approveModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Confirmation</h4>
				</div>
				<div class="modal-body text-center">
					<p>Are you sure you want to approve the doctor profile?</p>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Reject</button>
					<button type="button" class="btn btn-primary text-uppercase">Approve</button>
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
	
	<?php echo $this->Html->script(['pharmacy/jquery.formatter.min.js','pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']); ?>
	
	<script type="text/javascript">
		$(document).ready(function() {
			
			var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
			
			$('#birthdateval').datetimepicker({
				format: 'DD/MM/YYYY',
				//minDate: moment(),
				maxDate: moment(),
				useStrict:true,
				//inline: true,
				locale:  moment.locale('en', {
					week: { dow: 1 }
				}),
			});
			  
			$('#birthdateval').formatter({
			 'pattern': '{{99}}/{{99}}/{{9999}}'
			});
			
			$("body").on("keyup",".searchDoctorName",function()
			{
				var search = $(this).val().toLowerCase();
				
				$('.doctorName').each(function()
				{
					var doctorName = $(this).text().toLowerCase();
					if (doctorName.indexOf(search)!=-1)
					{
						$(this).parent().show();
					}
					else
					{
						$(this).parent().hide();
					}		
				});
			});
			
			$("body").on("blur",".searchDoctorDOB",function()
			{
				var search = $(this).val().toLowerCase();
				
				$('.doctorDOB').each(function()
				{
					var doctorDOB = $(this).text();
					if(doctorDOB.indexOf(search)!=-1)
					{
						$(this).parent().parent().show();
					}
					else
					{
						$(this).parent().parent().hide();
					}		
				});
			});
			
			$("body").on("click",".activateClass",function()
			{
				var id = $(this).attr("id");
				var status = $(this).attr("data-id");
				
				$.ajax({
					url: '<?php echo $this->Url->build(["controller"=>"Doctor", "action"=>"activateStatus"]); ?>',  
					type: "POST",
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					data: {"id":id, "status":status},
					success: function(data)
					{
						location.reload();
					}   
				});
			});
			
			$("body").on("click",".nameRadio",function()
			{
				$(".searchByNameDiv").css("display","inline-block");
				$(".searchByDOBDiv").css("display","none");
			});
			
			$("body").on("click",".dobRadio",function()
			{
				$(".searchByDOBDiv").css("display","inline-block");
				$(".searchByNameDiv").css("display","none");
			});

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
			/* $.fn.dataTable.Responsive.breakpoints = [
    { name: 'desktop', width: Infinity },
    { name: 'tablet',  width: Infinity },
    { name: 'fablet',  width: 768 },
    { name: 'phone',   width: 480 }
]; */
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
		
		$(window).on("load", function()
		{
			$("#birthdateval").val("");
		});
	</script>
</body>