<body>
	
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-md-6 col-12"><a href="<?php echo $this->url->build(["controller" => "executive","action" => "index"]); ?>" class="text-uppercase backLink"><i class="sprite backIcon"></i> Back</a>
						<div class="customHead"> <b><i class="sprite settingIcon"></i></b> <span>Executive Assistant Details</span> </div>
					</li>
					<li class="col-md-6 col-12 text-right"><a href="<?php echo $this->url->build(["controller" => "executive","action" => "createEa",$data['id']]); ?>" class="btn btn-secondary text-uppercase">Edit Details</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="doctorWrap">
						<div class="userViewwrap">
							<h3 class="doctorTitle">Personal Information</h3>
							<ul class="clearfix userViewlist">
								<li class="col-lg-3 col-md-3 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">FULL NAME</label>
										<p><?php echo $data['first_name']; ?>&nbsp;<?php echo $data['middle_name']; ?>&nbsp;<?php echo $data['last_name']; ?></p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">AGE (Date Of Birth)</label>
										<p><?php echo $data['dob']; ?></p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">Gender</label>
										<p><?php echo $data["gender"]=='Male' ? "Male" : "Female"; ?></p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">PHONE NUMBER</label>
										<p><?php $phone=explode(',',$data['phone']); $phone_code=explode(',',$data['phone_code']); echo $phone_code[0]; ?>-<?php echo $phone[0]; ?></p>
									</div>
								</li>
								<li class="col-lg-3 col-md-3 col-sm-12">
									<div class="customformwrap">
										<label class="customLabel">Email</label>
										<p><?php $email=explode(',',$data['email']); echo $email[0]; ?></p>
									</div>
								</li>
							</ul>
						</div>
						
						<!--<div class="userViewwrap">
							<h3 class="doctorTitle">Login information</h3>
							<ul class="clearfix userViewlist">
								<li class="col-lg-3 col-md-3 col-sm-6" style="display: none;">
									<div class="customformwrap">
										<label class="customLabel">User NAME</label>
										<p>Bhavya Sharma</p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">Password</label>
										<p>********* &nbsp;&nbsp;<a href="#" class="text-uppercase text-link">View</a></p>
									</div>
								</li>
							</ul>
						</div>-->

<?php $permission = explode(',',$data['permission']); ?> 

						<div class="userViewwrap">
							<h3 class="doctorTitle">Permissions</h3>
							<?php if (! empty($permission)) {
                         foreach ($permission as $per) { ?>
							<ul class="userViewlist">
								<li class="col-lg-3 col-md-12 col-sm-12">
								<div class="customformwrap">
								<p><?php if($per==1){ echo 'Appointment Setup and Details'; }elseif($per==2){ echo 'Medical History'; }elseif($per==3){ echo 'View/Upload Reports'; }elseif($per==4){ echo 'Visit History'; }?> </p>
								</div>
								</li>
													  
							</ul>
							<?php } } ?>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
/*$hobbies = array('Cricket', 'Music', 'Reading');
if (! empty($hobbies)) {
  foreach ($hobbies as $myHobby) {
    $checked = (in_array($myHobby, $hobby)) ? 'checked="checked"' : '';
?>
<input type="checkbox" name="hobby[]" value="<?php echo $myHobby;?>" size="17" <?php echo $checked;?>><?php echo $myHobby;?>
<?php
    }
}*/
?>
	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->

	<!-- EDIT MODAL -->
	<div id="editEmployeeModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Details</h4>
				</div>
				<div class="modal-body">
					<ul class="row">
						<li class="col-sm-12">
							<label class="form-label">First Name</label>
							<input type="text" class="form-control" value="Bhavya" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Middle Name</label>
							<input type="text" class="form-control" value="" />
						</li>
						<li class="col-sm-12">
							<label class="form-label">Last Name</label>
							<input type="text" class="form-control" value="Sharma" />
						</li>
						<li class="col-4 col-md-3">
							<label class="form-label">DOB</label>
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
						
						<li class="col-lg-12 col-md-12 col-sm-12">
							<label class="form-label">PERMISSIONS</label>
									<div class="customcheckbox pointernone">
										<label>
											<input type="checkbox" checked="">
											<b></b><span>Appointment Setup and Details</span></label>
									</div>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox">
											<b></b><span>Medical History</span></label>
									</div>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox">
											<b></b><span>View Reports</span></label>
									</div>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox">
											<b></b><span>Upload Reports</span></label>
									</div>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox">
											<b></b><span>Visit History</span></label>
									</div>
								</li>
						 
					</ul>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary text-uppercase">Save</button>
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
					<p>Are you sure you want to deassign this user?</p>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary text-uppercase">Deassign</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {

			$('#customerTable').DataTable({
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

</html>