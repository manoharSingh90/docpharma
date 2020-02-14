
<?php
echo $this->Html->css(['doctor/jquery.modal']);
echo $this->Html->script(['pharmacy/jquery.modal.min.js']);
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
					<li class="col-md-6 col-sm-12">
						<div class="customHead">
							<div class="backbtn"><a href="<?php echo $this->url->build(["controller"=>"Doctor","action"=>"listing"]); ?>" ><img src="<?php echo PATH."img/doctor/back-arrow.png" ?>" alt="#" /> Back</a></div>
							<b><img src="<?php echo PATH."img/doctor/user-icon.png" ?>" alt="#" /></b> <span>View Doctor Profile</span> </div>
					</li>
					<li class="col-md-6 col-sm-12 text-right "> 
						<a href="<?php echo $this->Url->build(["controller"=>"Doctor","action"=>"index",base64_encode($data["id"])]); ?>" class="btn btn-secondary text-uppercase viewhistory">Edit</a>
						
						<?php if($data["is_active"]==1) { ?>
						<a href="javascript:void(0);" class="btn btn-secondary text-uppercase viewhistory viewAppointment" id="<?php echo $data["id"]; ?>">View Appointment</a>
						<?php } ?>
						
						<div class="" style="display: none;">
							<a href="edit-doctor-profile.html" class="btn btn-default text-uppercase viewhistory">Reject</a>
							<a href="edit-doctor-profile.html" class="btn btn-primary text-uppercase viewhistory">Approve</a> 
						</div>
					</li>
					 
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="doctorWrap">
				<div class="userViewwrap">
				<h3 class="doctorTitle">Personal information</h3>
				<ul class="clearfix userViewlist">
					<li class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
						<div class="customformwrap">
							<div class="imageviewuser">
							<img src="<?php echo isset($data["image"]) && !empty($data["image"]) ? PATH."img/images/doctor/".$data["image"] : PATH."img/doctor/placeholder.png" ?>" />
							</div>
						</div>
					</li>
					<li class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">FULL NAME</label>
							<p class="slt-viewlist">
								Dr. <?php echo isset($data["first_name"]) ? $data["first_name"]." ".$data["middle_name"]." ".$data["last_name"] : ""; ?>
							</p>
						</div>
					</li>
					
					<?php
					$currentYear = date("Y");
					$dob = explode("/",date("d/m/Y",strtotime($data["dob"]))); ?>
					<li class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">AGE (Date Of Birth)</label>
							<p class="slt-viewlist">
								<?php
								if(isset($dob[0])) {
								echo $currentYear - $dob[2]; ?> (<?php echo $dob[0]."/".$dob[1]."/".$dob[2]; ?>)
								<?php } ?>
							</p>
						</div>
					</li>
					<li class="col-lg-2 col-md-2 col-sm-5 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">Gender</label>
							<p class="slt-viewlist">
								<?php
								if(isset($data["id"])) {
								echo isset($data["gender"]) && $data["gender"]==1 ? "Male" : "Female";
								} ?>
							</p>
						</div>
					</li>
					
					<?php $phoneData = isset($data["phone"]) && !empty($data["phone"]) ? json_decode($data["phone"],true) : ""; ?>
					<li class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">PHONE NUMBER</label>
							<p class="slt-viewlist">
								<?php echo isset($phoneData[0]["phone_code"]) ? $phoneData[0]["phone_code"] : ""; ?> <?php echo isset($phoneData[0]["phone"]) ? $phoneData[0]["phone"] : ""; ?>
							</p>
						</div>
					</li>
					
					<?php $emailData = isset($data["email"]) && !empty($data["email"]) ? json_decode($data["email"],true) : ""; ?>
					<li class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">EMAIL</label>
							<p class="slt-viewlist">
								<?php echo isset($emailData[0]) ? $emailData[0] : ""; ?>
							</p>
						</div>
					</li>
					<li class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">Type</label>
							<p class="slt-viewlist">
								<?php echo isset($data["type"]) ? $data["type"] : ""; ?>
							</p>
						</div>
					</li>
					<li class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">Speciality</label>
							<p class="slt-viewlist">
								<?php echo isset($data["speciality"]) ? $data["speciality"] : ""; ?>
							</p>
						</div>
					</li>
				  </ul>
					</div>
				<div class="userViewwrap">
				<h3 class="doctorTitle">Registration information</h3>
				<ul class="clearfix userViewlist">
					<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">Registration Number</label>
							<p class="slt-viewlist">
								<?php echo isset($data["registration_number"]) ? $data["registration_number"] : ""; ?>
							</p>
						</div>
					</li>
					<li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">Registering Authority</label>
							<p class="slt-viewlist">
								<?php echo isset($data["registration_authority"]) ? $data["registration_authority"] : ""; ?>
							</p>
						</div>
					</li>
					<li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
						<div class="customformwrap">
							<label class="customLabel">Registering State</label>
							<p class="slt-viewlist">
								<?php echo isset($data["registration_state"]) ? $data["registration_state"] : ""; ?>
							</p>
						</div>
					</li>
					 
				  </ul>
					</div>
					
				<div class="userViewwrap">
					<h3 class="doctorTitle">Qualifications</h3>
					<ul class="clearfix userViewlist">
					<?php if(isset($data["qualification"]) && !empty($data["qualification"])) {
						  $qualificationData = json_decode($data["qualification"],true);
						  foreach($qualificationData as $key => $value) { ?>
						<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel"><?php echo $value["university"]; ?></label>
								<p class="slt-viewlist"><?php echo !empty($value["degree"]) ? $value["degree"]. " (".$value["passing_year"].")" : ""; ?>
								</p>
							</div>
						</li>
						<?php } } ?>
					</ul>
				</div>
				
				<div class="userViewwrap">
					<h3 class="doctorTitle">AFFILIATION</h3>
					<ul class="clearfix userViewlist">
					<?php if(isset($data["affiliation"]) && !empty($data["affiliation"])) {
						  $affiliationData = json_decode($data["affiliation"],true);
						  foreach($affiliationData as $key => $value) { ?>
						<li class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<p class="slt-viewlist"><?php echo $value; ?></p>
							  
							</div>
						</li>
					<?php } } ?>
					</ul>
				</div>
				
				<div class="userViewwrap">
					<h3 class="doctorTitle">Timing</h3>
					<ul class="clearfix userViewlist border-bottom-0">
					<?php if(isset($data["timing"]) && !empty($data["timing"])) {
						$timeData = json_decode($data["timing"],true);
						foreach($timeData as $key => $value) {
						foreach($value as $timeKey => $timeValue) { ?>
							<li class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="customformwrap">
									<?php //if($timeKey==0) { ?>
									<label class="customLabel"><?php echo str_replace(",",", ",$timeValue["day"]); ?></label>
									<!--<p class="slt-viewlist"></p>-->
									<?php //} ?>
									
									<span><?php //echo $timeKey==0 ? "" : ", "; ?><?php echo $timeValue["start_time"]." ".$timeValue["start_meridiem"]." - ".$timeValue["end_time"]." ".$timeValue["end_meridiem"]; ?></span>
									<br>Appointment Average Duration Time: <?php echo $timeValue["duration_time"]." ".$timeValue["duration_min"] ?>
								</div>
							</li>
						<?php } } } ?>
					  </ul>
				</div>
				
			</div>
		</div>
	</div>

	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
	<script type="text/javascript">
		$(document).ready(function() {
			
			var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
			
			$('.customerTable').DataTable({
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
			
			$(".viewAppointment").click(function()
			{
				$.ajax({
					url: '<?php echo $this->Url->build(["controller"=>"Doctor", "action"=>"setDoctorSession"]); ?>',  
					type: "POST",
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					data: {"id":$(this).attr("id")},
					success: function(data)
					{
						window.location = '<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"listing"]); ?>';
					}   
				});
			});
		});
	</script>
</body>