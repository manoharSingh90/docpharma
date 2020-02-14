
<body>
	
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-md-6 col-sm-12">
						<div class="customHead">
							<div class="backbtn">
								<a href="<?php echo $this->url->build(["controller"=>"Doctor","action"=>"listing"]); ?>"><img src="<?php echo PATH."img/doctor/back-arrow.png" ?>" alt="#" /> Back</a>
							</div>
							<b><img src="<?php echo PATH."img/doctor/user-icon.png" ?>" alt="#" /></b> <span><?php echo isset($data["id"]) ? "Edit" : "Create Doctor"; ?> Profile</span>
						</div>
					</li>
					<li class="col-md-6 col-sm-12 text-right ">
						<a href="#" class="btn btn-default text-uppercase viewhistory" data-toggle="modal" data-target="#cancelModal">Cancel</a>
						<a href="#" class="btn btn-primary text-uppercase viewhistory checkValidation" data-toggle="modal" data-target="#saveModal">Save</a> </li>

				</ul>
			</div>
		</div>
		
		<form method="post" action="<?php echo $this->url->build(["controller"=>"Doctor", "action"=>"save"]); ?>" enctype="multipart/form-data">

		<input type="hidden" class="users_id" name="users_id" value="<?php echo isset($usersData["id"]) ? $usersData["id"] : ""; ?>">
		
		<input type="hidden" class="id" name="id" value="<?php echo isset($data["id"]) ? $data["id"] : ""; ?>">
		
		<input type="hidden" name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
		
		<div class="container">
			<div class="doctorWrap">
				<div class="userViewwrap">
					<h3 class="doctorTitle">Personal information</h3>
					<ul class="clearfix userViewlist">
						<li class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Title</label>
								<select class="custominput singleselect" name="title">
										<option value="Dr" <?php echo isset($data["title"]) && $data["title"]=="Dr" ? "selected" : ""; ?> >Dr</option>
									</select>
							</div>
						</li>
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">First Name<span class="starClass"> *</span></label>
								<input autocomplete="off" type="text" class="custominput text-capitalize mandatory" name="first_name" value="<?php echo isset($data["first_name"]) ? $data["first_name"] : ""; ?>" />
								<span class="errorClass firstErrorClass">Field Required</span>
							</div>
						</li>
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Middle Name</label>
								<input autocomplete="off" type="text" class="custominput text-capitalize" name="middle_name" value="<?php echo isset($data["middle_name"]) ? $data["middle_name"] : ""; ?>" />
							</div>
						</li>
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Last Name<span class="starClass"> *</span></label>
								<input autocomplete="off" type="text" class="custominput text-capitalize mandatory" name="last_name" value="<?php echo isset($data["last_name"]) ? $data["last_name"] : ""; ?>" />
								<span class="errorClass lastErrorClass">Field Required</span>
							</div>
						</li>
						
						<li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
							<div class="slt-gender">
								<div class="customformwrap">
									<label class="customLabel">Gender<span class="starClass"> *</span></label>
									<select class="custominput singleselect genderMandatory" name="gender">
										<option value="">Select</option>
										<option value="1" <?php echo isset($data["gender"]) && $data["gender"]==1 ? "selected" : ""; ?> >Male</option>
										<option value="2" <?php echo isset($data["gender"]) && $data["gender"]==2 ? "selected" : ""; ?> >Female</option>
									</select>
									<span class="errorClass genderErrorClass">Field Required</span>
								</div>
							</div>
						</li>
						
						<div class="clearfix"></div>
						
						<?php $dob = explode("/",date("d/m/Y",strtotime($data["dob"]))); ?>
						<input type="hidden" class="savedDOB" value="<?php echo isset($data["dob"]) ? $dob[0]."/".$dob[1]."/".$dob[2] : ""; ?>">
						<li class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Date of Birth</label>
								<input autocomplete="off" type="text" id="birthdateval" style="cursor:pointer;" class="custominput" name="dob" value="<?php echo isset($data["dob"]) ? $dob[0]."/".$dob[1]."/".$dob[2] : ""; ?>" placeholder="DD/MM/YYYY"/>
								<b class="sprite clderIcon cld_icon clderIconClick"></b> </div>
								<span class="errorClass dateErrorClass">Age should be 18 years above</span>
								<input type="hidden" class="checkDate">
						</li>

						<?php $emailData = isset($data["email"]) && !empty($data["email"]) ? json_decode($data["email"],true) : ""; ?>
						<li class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
							<div class="customformwrap">
							
								<?php if(empty($emailData)) { ?>
								<label class="customLabel">Email<span class="starClass"> *</span></label>
								<input autocomplete="off" type="email" class="custominput inputwith-abbbtn emailMandatory mandatory" name="email[]" /><div class="addmoreBtn otheremailClick "><b class="sprite addplusIcon addEmail"></b></div>
								<span class="errorClass emailErrorClass">Field Required</span>
								<span class="errorClass checkEmail">Email Exists</span>
								<?php }
								else {
									foreach($emailData as $key => $value) { ?>
								<div class="appendDiv">
								<label class="customLabel">Email</label>
								<input autocomplete="off" type="email" class="custominput inputwith-abbbtn emailMandatory" name="email[]" value="<?php echo $value; ?>" <?php echo $key==0 ? "readonly" : ""; ?> /><div class="addmoreBtn otheremailClick "><b class="sprite addplusIcon <?php echo $key==0 ? "addEmail" : "removeEmail"; ?>"></b></div>
								<span class="errorClass emailErrorClass">Field Required</span>
								</div>
								<?php } } ?>
							</div>
							<div class="appendEmail"></div>
						</li>
						
						<?php $phoneData = isset($data["phone"]) && !empty($data["phone"]) ? json_decode($data["phone"],true) : ""; ?>
						<li class="col-lg-4 col-md-5 col-sm-8 col-xs-12">
							
							<?php if(empty($phoneData)) { ?>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-2" style="padding-left: 0;">
								<div class="customformwrap">
									<label class="customLabel">prefix Code</label>
									<select class="custominput singleselect" name="phone_code[]">
										<option value="+91">+91</option>
										<option value="+90">+90</option>
									</select>
								</div>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-10">
								<div class="customformwrap">
									<label class="customLabel">Phone Number</label>
									<input autocomplete="off" type="text" maxlength="10" class="custominput inputwith-abbbtn phone" name="phone[]" />
									<div class="addmoreBtn otherdocClick"><b class="sprite addplusIcon addPhone"></b></div>
								</div>
							</div>
							<?php }
							else {
								foreach($phoneData as $key => $value) { ?>
								<div class="appendDiv">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-2" style="padding-left: 0;">
									<div class="customformwrap">
										<label class="customLabel">prefix Code</label>
										<select class="custominput singleselect" name="phone_code[]">
											<option value="+91" <?php echo $value["phone_code"]=="+91" ? "selected" : ""; ?> >+91</option>
											<option value="+90" <?php echo $value["phone_code"]=="+90" ? "selected" : ""; ?> >+90</option>
										</select>
									</div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-10">
									<div class="customformwrap">
										<label class="customLabel">Phone Number</label>
										<input autocomplete="off" type="text" maxlength="10" class="custominput inputwith-abbbtn phone" name="phone[]" value="<?php echo isset($value["phone"]) ? $value["phone"] : ""; ?>" />
										<div class="addmoreBtn otherdocClick"><b class="sprite addplusIcon <?php echo $key==0 ? "addPhone" : "removePhone"; ?>"></b></div>
									</div>
								</div>
								</div>
							<?php } } ?>
							<div class="appendPhone"></div>
						</li>

						<li class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
							<div class="slt-gender">
								<div class="customformwrap">
									<label class="customLabel">Type</label>
									<select class="custominput singleselect" name="type">
										<option value="">Select</option>
										<option value="Permanent" <?php echo isset($data["type"]) && $data["type"]=="Permanent" ? "selected" : ""; ?> >Permanent</option>
										<option value="Temporary" <?php echo isset($data["type"]) && $data["type"]=="Temporary" ? "selected" : ""; ?> >Temporary</option>
										<option value="Locum" <?php echo isset($data["type"]) && $data["type"]=="Locum" ? "selected" : ""; ?> >Locum</option>
									</select>
								</div>
							</div>
						</li>
						
						<div class="clearfix"></div>
						
						<li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Speciality</label>
								<input autocomplete="off" type="text" class="custominput text-capitalize" name="speciality" value="<?php echo isset($data["speciality"]) ? $data["speciality"] : ""; ?>" />
							</div>
						</li>
						<div class="clearfix"></div>
						
						<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							 <div class="uploadShow">
									<div class="imgarea" id="form1" runat="server">
										<img id="blah" src="<?php echo isset($data["image"]) && !empty($data["image"]) ? PATH."img/images/doctor/".$data["image"] : PATH."img/doctor/placeholder.png" ?>" alt="#" />
    								</div>
								</div>
									<div class="uploadimageWrap">
									<div class="uploadimage">
										<p class="uploadClick btn btn-secondary text-uppercase">Upload/Edit</p>
										<input type='file' id="imgInp" name="image" />
										<input type='hidden' name="oldImage" value="<?php echo isset($data["image"]) ? $data["image"] : ""; ?>" />
									</div> 
								 </div>
						</li>
					</ul>
				</div>
				<div class="userViewwrap">
					<h3 class="doctorTitle">Registration information</h3>
					<ul class="clearfix userViewlist">
						<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Registration Number<span class="starClass"> *</span></label>
								<input autocomplete="off" type="text" class="custominput text-capitalize mandatory" name="registration_number" value="<?php echo isset($data["registration_number"]) ? $data["registration_number"] : ""; ?>" />
								<span class="errorClass rnoErrorClass">Field Required</span>
							</div>

						</li>
						<li class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Registering Authority<span class="starClass"> *</span></label>
								<input autocomplete="off" type="text" class="custominput text-capitalize mandatory" name="registration_authority" value="<?php echo isset($data["registration_authority"]) ? $data["registration_authority"] : ""; ?>" />
								<span class="errorClass rauthErrorClass">Field Required</span>
							</div>
						</li>
						<li class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Registering State<span class="starClass"> *</span></label>
								<input autocomplete="off" type="text" class="custominput text-capitalize mandatory" name="registration_state" value="<?php echo isset($data["registration_state"]) ? $data["registration_state"] : ""; ?>" />
								<span class="errorClass rstateErrorClass">Field Required</span>
							</div>
						</li>

					</ul>
				</div>
				
				<?php
				$qualificationData = isset($data["qualification"]) && !empty($data["qualification"]) ? json_decode($data["qualification"],true) : "";
				?>
				<div class="userViewwrap">
					<h3 class="doctorTitle">Qualifications</h3>
					<ul class="clearfix userViewlist">
					
					<?php if(empty($qualificationData)) { ?>
						<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">University</label>
								<input autocomplete="off" type="text" class="custominput text-capitalize" name="university[]" />
							</div>
						</li>
						<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Degree</label>
								<input autocomplete="off" type="text" class="custominput text-capitalize" name="degree[]" />
							</div>
						</li>
						<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="slt-gender col-lg-5 col-md-4 col-sm-6 col-xs-12">
								<div class="customformwrap">
									<label class="customLabel">Passing Year</label>
									<select class="custominput singleselect" name="passing_year[]">
										<option value="">Select</option>
										<?php for($i=2018; $i>=1960; $i--) { ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="addmoreBtn doceditbtn"><b class="sprite addplusIcon addQualification"></b></div>
						</li>
					<?php }
					else {
						foreach($qualificationData as $key => $value) { ?>
						<div class="appendDiv">
						<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">University</label>
								<input autocomplete="off" type="text" class="custominput text-capitalize" name="university[]" value="<?php echo $value["university"]; ?>" />
							</div>
						</li>
						<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Degree</label>
								<input autocomplete="off" type="text" class="custominput text-capitalize" name="degree[]" value="<?php echo $value["degree"]; ?>" />
							</div>
						</li>
						<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="slt-gender col-lg-5 col-md-4 col-sm-6 col-xs-12">
								<div class="customformwrap">
									<label class="customLabel">Passing Year</label>
									<select class="custominput singleselect" name="passing_year[]">
										<option value="">Select</option>
										<?php for($i=2019; $i>=1960; $i--) { ?>
										<option value="<?php echo $i; ?>" <?php echo $i==$value["passing_year"] ? "selected" : ""; ?> ><?php echo $i; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="addmoreBtn doceditbtn"><b class="sprite addplusIcon <?php echo $key==0 ? "addQualification" : "removeQualification"; ?>"></b></div>
						</li></div>
						<?php } } ?>
						
						<div class="appendQualification"></div>
						
					</ul>
				</div>
				
				<?php
				$affiliationData = isset($data["affiliation"]) && !empty($data["affiliation"]) ? json_decode($data["affiliation"],true) : "";
				?>
				<div class="userViewwrap">
					<h3 class="doctorTitle">Affiliation</h3>
					<div class="clearfix userViewlist affiliationWrap">
						<?php if(empty($affiliationData)) { ?>
							<div class="col-lg-6 col-md-5 col-sm-10 col-xs-10">
								<div class="customformwrap">
									<input autocomplete="off" type="text" class="custominput text-capitalize" name="affiliation[]" />
								</div>
							</div>
							<div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
								<div class="addmoreBtn"><b class="sprite addplusIcon affiliClick"></b></div>
							</div>
							<div class="clearfix"></div>
						<?php }
						else {
							foreach($affiliationData as $key => $value) { ?>
							<div class="appendDiv">
							<div class="col-lg-6 col-md-5 col-sm-10 col-xs-10">
								<div class="customformwrap">
									<input autocomplete="off" type="text" class="custominput text-capitalize" name="affiliation[]" value="<?php echo $value; ?>" />
								</div>
							</div>
							<div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
								<div class="addmoreBtn"><b class="sprite addplusIcon <?php echo $key==0 ? "affiliClick" : "removeAffiliation"; ?>"></b></div>
							</div>
							<div class="clearfix"></div><br></div>
							<?php }
						} ?>
						<?php if(empty($affiliationData)) { ?><br><?php } ?>
						<div class="appendAffiliation"></div>	
					</div>
				</div>
				
				<?php
				$timingData = isset($data["timing"]) && !empty($data["timing"]) ? json_decode($data["timing"],true) : ""; ?>
				
				<?php
				if(isset($timingData) && !empty($timingData)) {
				foreach($timingData as $key => $value) {
				foreach($value as $timeKey => $timeValue) {
				if($timeKey==0) {
				$exp[] = explode(",",$timeValue["day"]);
				} } }
				if(!empty($exp)) {
				foreach($exp as $expKey => $expValue) {
					$finalArray[] = implode(",",$expValue);
				} } }
				$daysData = isset($finalArray) ? str_replace(',', '', implode(",",$finalArray)) : "";
				?>
				<input type="hidden" name="daysData" class="daysData mandatory" size="100" value="<?php echo isset($daysData) ? $daysData : ""; ?>" >
				
				<?php if(empty($timingData)) { ?>
				<div class="userViewwrap timeDiv">
					<h3 class="doctorTitle">Timing</h3>
					<div class="userViewlist bottomspace">
						<div class="clearfix">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="customformwrap">
									<label class="customLabel">Day of week<span class="starClass"> *</span></label>
								</div>
								<div class="weeklyWrap weeklyborder" style="display: block;">
									<input type="text" data-id="0" name="days[0][Mon]" class="days days_0" placeholder="Mon" readonly>
									<input type="text" data-id="0" name="days[0][Tue]" class="days days_0" placeholder="Tue" readonly>
									<input type="text" data-id="0" name="days[0][Wed]" class="days days_0" placeholder="Wed" readonly>
									<input type="text" data-id="0" name="days[0][Thu]" class="days days_0" placeholder="Thu" readonly>
									<input type="text" data-id="0" name="days[0][Fri]" class="days days_0" placeholder="Fri" readonly>
									<input type="text" data-id="0" name="days[0][Sat]" class="days days_0" placeholder="Sat" readonly>
									<input type="text" data-id="0" name="days[0][Sun]" class="days days_0" placeholder="Sun" readonly>
								</div>
								
							</div>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="customformwrap">
										<label class="customLabel">&nbsp;&nbsp;Start Time</label>
									</div>
									<div class="timecreate clearfix">
										<div class="customformwrap">
											<input type="time" class="custominput witoutbg without_ampm" value="00:00" name="fullSchedule[0][start_time][0]">
										</div>
										<div class="customTimePM">
											<select class="form-control locationInput" name="fullSchedule[0][start_meridiem][0]">
												<option value="AM">AM</option>
												<option value="PM">PM</option>
											</select>

										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="customformwrap">
										<label class="customLabel">&nbsp;&nbsp;End Time</label>
									</div>
									<div class="timecreate clearfix">
										<div class="customformwrap">
											<input type="time" class="custominput witoutbg without_ampm" value="00:00" name="fullSchedule[0][end_time][0]">
										</div>
										<div class="customTimePM">
											<select class="form-control locationInput" name="fullSchedule[0][end_meridiem][0]">
												<option value="AM">AM</option>
												<option value="PM">PM</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
								<div class="customformwrap">
									<label class="customLabel">&nbsp;&nbsp;Average Appointment DURATION</label>
								</div>

								<div class="timecreate durationtime clearfix">
									<div class="customformwrap">
										<select class="form-control locationInput" name="fullSchedule[0][duration_time][0]">
											<option value="15">15</option>
											<option value="30">30</option>
										</select>
									</div>
									<div class="customTimePM">
										<select class="form-control locationInput" name="fullSchedule[0][duration_min][0]">
											<option value="Min">Min</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-2 col-xs-4">
								<div class="addmoreBtn othertimeaddClick addtimeclearclick" id="0"><b class="sprite addplusIcon addDuration"></b></div>
							</div>
						</div>
						
						<div class="appendDuration"></div>

					</div>
				</div>
				
				<?php }
				
				else {
				foreach($timingData as $key => $value) { ?>
				<div class="appendDiv">
				<div class="userViewwrap timeDiv">
					<h3 class="doctorTitle">Timing</h3>
					
					<div class="userViewlist bottomspace">
						<div class="clearfix">
							
							<?php foreach($value as $timeKey => $timeValue) { ?>
							
							<?php if($timeKey==0) {
								  $explodeTime = explode(",",$timeValue["day"]);
								?>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="customformwrap">
									<label class="customLabel">Day of week</label>
								</div>
								<div class="weeklyWrap weeklyborder" style="display: block;">
									<input type="text" name="days[<?php echo $key; ?>][Mon]" value="<?php echo in_array("Mon",$explodeTime) ? "Mon" : ""; ?>" data-id="<?php echo $key; ?>" class="days days_<?php echo $key; ?>" placeholder="Mon" readonly style="<?php echo in_array("Mon",$explodeTime) ? "background:#8f4b79; color:#fff; border-color:#8f4b79" : ""; ?>" >
									
									<input type="text" name="days[<?php echo $key; ?>][Tue]" value="<?php echo in_array("Tue",$explodeTime) ? "Tue" : ""; ?>" data-id="<?php echo $key; ?>" class="days days_<?php echo $key; ?>" placeholder="Tue" readonly style="<?php echo in_array("Tue",$explodeTime) ? "background:#8f4b79; color:#fff; border-color:#8f4b79" : ""; ?>" >
									
									<input type="text" name="days[<?php echo $key; ?>][Wed]" value="<?php echo in_array("Wed",$explodeTime) ? "Wed" : ""; ?>" data-id="<?php echo $key; ?>" class="days days_<?php echo $key; ?>" placeholder="Wed" readonly style="<?php echo in_array("Wed",$explodeTime) ? "background:#8f4b79; color:#fff; border-color:#8f4b79" : ""; ?>" >
									
									<input type="text" name="days[<?php echo $key; ?>][Thu]" value="<?php echo in_array("Thu",$explodeTime) ? "Thu" : ""; ?>" data-id="<?php echo $key; ?>" class="days days_<?php echo $key; ?>" placeholder="Thu" readonly style="<?php echo in_array("Thu",$explodeTime) ? "background:#8f4b79; color:#fff; border-color:#8f4b79" : ""; ?>" >
									
									<input type="text" name="days[<?php echo $key; ?>][Fri]" value="<?php echo in_array("Fri",$explodeTime) ? "Fri" : ""; ?>" data-id="<?php echo $key; ?>" class="days days_<?php echo $key; ?>" placeholder="Fri" readonly style="<?php echo in_array("Fri",$explodeTime) ? "background:#8f4b79; color:#fff; border-color:#8f4b79" : ""; ?>" >
									
									<input type="text" name="days[<?php echo $key; ?>][Sat]" value="<?php echo in_array("Sat",$explodeTime) ? "Sat" : ""; ?>" data-id="<?php echo $key; ?>" class="days days_<?php echo $key; ?>" placeholder="Sat" readonly style="<?php echo in_array("Sat",$explodeTime) ? "background:#8f4b79; color:#fff; border-color:#8f4b79" : ""; ?>" >
									
									<input type="text" name="days[<?php echo $key; ?>][Sun]" value="<?php echo in_array("Sun",$explodeTime) ? "Sun" : ""; ?>" data-id="<?php echo $key; ?>" class="days days_<?php echo $key; ?>" placeholder="Sun" readonly style="<?php echo in_array("Sun",$explodeTime) ? "background:#8f4b79; color:#fff; border-color:#8f4b79" : ""; ?>" >
								</div>
							</div>
							<?php } ?>
							
							<?php if($timeKey!=0) { ?>
							<div class="appendDiv">
							<?php } ?>
							
							<?php if($timeKey!=0) { ?>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"></div>
							<?php } ?>
							
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="customformwrap">
										<label class="customLabel">&nbsp;&nbsp;Start Time</label>
									</div>
									<div class="timecreate clearfix">
										<div class="customformwrap">
											<input type="time" class="custominput witoutbg without_ampm" value="<?php echo $timeValue["start_time"]; ?>" name="fullSchedule[<?php echo $key; ?>][start_time][<?php echo $timeKey; ?>]">
										</div>
										<div class="customTimePM">
											<select class="form-control locationInput" name="fullSchedule[<?php echo $key; ?>][start_meridiem][<?php echo $timeKey; ?>]">
												<option value="AM" <?php echo isset($timeValue["start_meridiem"]) && $timeValue["start_meridiem"]=="AM" ? "selected" : ""; ?> >AM</option>
												<option value="PM" <?php echo isset($timeValue["start_meridiem"]) && $timeValue["start_meridiem"]=="PM" ? "selected" : ""; ?> >PM</option>
											</select>

										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="customformwrap">
										<label class="customLabel">&nbsp;&nbsp;End Time</label>
									</div>
									<div class="timecreate clearfix">
										<div class="customformwrap">
											<input type="time" class="custominput witoutbg without_ampm" value="<?php echo $timeValue["end_time"]; ?>" name="fullSchedule[<?php echo $key; ?>][end_time][<?php echo $timeKey; ?>]">
										</div>
										<div class="customTimePM">
											<select class="form-control locationInput" name="fullSchedule[<?php echo $key; ?>][end_meridiem][<?php echo $timeKey; ?>]">
												<option value="AM" <?php echo isset($timeValue["end_meridiem"]) && $timeValue["end_meridiem"]=="AM" ? "selected" : ""; ?> >AM</option>
												<option value="PM" <?php echo isset($timeValue["end_meridiem"]) && $timeValue["end_meridiem"]=="PM" ? "selected" : ""; ?> >PM</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
								<div class="customformwrap">
									<label class="customLabel">&nbsp;&nbsp;Average Appointment DURATION</label>
								</div>

								<div class="timecreate durationtime clearfix">
									<div class="customformwrap">
										<select class="form-control locationInput" name="fullSchedule[<?php echo $key; ?>][duration_time][<?php echo $timeKey; ?>]">
											<option value="15" <?php echo isset($timeValue["duration_time"]) && $timeValue["duration_time"]==15 ? "selected" : ""; ?> >15</option>
											<option value="30" <?php echo isset($timeValue["duration_time"]) && $timeValue["duration_time"]==30 ? "selected" : ""; ?> >30</option>
										</select>
									</div>
									<div class="customTimePM">
										<select class="form-control locationInput" name="fullSchedule[<?php echo $key; ?>][duration_min][<?php echo $timeKey; ?>]">
											<option value="Min" <?php echo isset($timeValue["duration_min"]) && $timeValue["duration_min"]=="Min" ? "selected" : ""; ?> >Min</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-2 col-xs-4">
								<div class="addmoreBtn othertimeaddClick addtimeclearclick" id="<?php echo $key; ?>"><b class="sprite addplusIcon <?php echo $timeKey==0 ? "addDuration" : "removeDuration"; ?>"></b></div>
								
								<?php if($key!=0 && $timeKey==0) { ?>
								<div class="linedefaultbtn allothertimeaddClick removeAnotherTime" style="margin-left:10px;"> <span>Remove Time</span></div>
								<?php } ?>
								
							</div>
							
						<?php if($timeKey!=0) { ?>
						</div>
						<?php } ?>
						
						<?php } ?>
					</div>
						
						<div class="appendDuration">
						<?php foreach($value as $timeKey => $timeValue) {
							if($timeKey!=0) { ?>
							<div class="appendDiv"></div>
						<?php } } ?>
						</div>

					</div>
					
				</div>
				</div>
				<?php } } ?>
				
				<div class="appendAnotherTime"></div>
				
				<div class="errorClass timingErrorClass" style="font-size:14px;">Field Required</div>
				
				<div class="linedefaultbtn allothertimeaddClick addAnotherTime"> <span>Add Another Time</span> </div>
				
				<?php //if(!isset($data["id"])) { ?>
				<!--<div class="userViewwrap">
					<h3 class="doctorTitle">Password</h3>
					<ul class="clearfix userViewlist border-bottom-0">
						<li class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">New Password<span class="starClass"> *</span></label>
								<input autocomplete="off" type="password" class="custominput mandatory newPassword" />
								<span class="errorClass passwordErrorClass" >Field Required</span>
							</div>
						</li>
						<li class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Confirm Password<span class="starClass"> *</span></label>
								<input autocomplete="off" type="password" class="custominput mandatory confirmPassword" name="password" />
								<span class="errorClass confirmErrorClass">Field Required</span>
								<span style="color:red; display:none;">Password Mismatch</span>
							</div>
						</li>
					</ul>
				</div>
				<?php //}
				//else { ?>
				<div class="userViewwrap">
					<h3 class="doctorTitle">Change Password</h3>
					<ul class="clearfix userViewlist border-bottom-0">
						<li class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Old Password</span></label>
								<input autocomplete="off" type="password" class="custominput editOldPassword" />
								<span class="errorClass passwordErrorClass">Field Required</span>
							</div>
						</li>
						<li class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">New Password</span></label>
								<input autocomplete="off" type="password" class="custominput editNewPassword" name="password" />
								<span class="errorClass confirmErrorClass">Field Required</span>
							</div>
						</li>
						<li class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
							<a class="btn btn-primary text-uppercase changPassword">Save</a>
						</li>
					</ul>
				</div>-->
				<?php //} ?>
				
			</div>
		</div>
		
		<div id="cancelModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cancel</h4>
				</div>
				<div class="modal-body text-center">
					<p>Are you sure you want to cancel this changes?</p>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">No</button>
					<a href="<?php echo $this->url->build(["controller"=>"Doctor","action"=>"listing"]); ?>" class="btn btn-primary text-uppercase">Yes</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	
	<div id="saveModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Save</h4>
				</div>
				<div class="modal-body text-center">
					<p>Are you sure you want to save this changes?</p>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase finalCancel" data-dismiss="modal">Cancel</button>
					<input type="submit" class="btn btn-primary text-uppercase submit finalSubmit" value="Save">
				</div>
			</div>
		</div>
	</div>
	
	
		</form>
		
	</div>

	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
<?php echo $this->Html->script(['pharmacy/jquery.formatter.min.js','pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']); ?>
	
<script type="text/javascript">
		
function readURL(input)
{
	var extension = input.files[0].name.split('.').pop().toLowerCase();
	var imageSize = input.files[0].size;
	
	if(extension=='png' || extension=='jpg' || extension=='jpeg')
	{
		if(Math.round(imageSize/(1024 * 1024)) > 11)
		{
			alert('Please select image size upto 10 MB');
			return false;
		}
	}
	else
	{
		alert("Please select png, jpg or jpeg file");
		return false;
	}
		
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#blah').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}
    
$("#imgInp").change(function()
{
	readURL(this);
});
	
$(document).ready(function()
{
	$(".singleselect").select2();
	/* $('.clderIconClick').click(function() {
		$('#birthdateval').click();
	}); */
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

	var expires = new Date();
	var birthDate = $("#birthdateval").val().split('/');
	$(".checkDate").val(expires.getFullYear()-birthDate[2]);

	$("body").on("blur","#birthdateval",function()
	{
		var birthDate = $("#birthdateval").val().split('/');
		$(".checkDate").val(expires.getFullYear()-birthDate[2]);
		if($(".checkDate").val()>17)
		{
			$(".dateErrorClass").css("display","none");
		}
	});

	$('.othercontactClick').click(function() {
		$('.formlist').removeClass('othercontact')
	});

	$('.othertimeaddClick').click(function() {
		//$(this).hide();
		$('.repeattimerow').addClass('active')
	});
	$('.allothertimeaddClick').click(function() {
		$('.allrepeattimerow').addClass('active')
	});
	
	$('.affiliClick').click(function()
	{
		var countClass = $('.removeAffiliation').length;
		if(countClass<4) {
		$(".appendAffiliation").append('<div class="appendDiv"><div class="col-lg-6 col-md-5 col-sm-10 col-xs-10"><div class="customformwrap"><input autocomplete="off" type="text" class="custominput text-capitalize" name="affiliation[]" /></div></div><div class="col-lg-1 col-md-1 col-sm-1 col-xs-2"><div class="addmoreBtn"><b class="sprite addplusIcon removeAffiliation"></b></div></div><div class="clearfix"></div><br></div>');
		}
	});
	
	$('body').on('click','.removeAffiliation',function()
	{
		$(this).closest(".appendDiv").remove();
	});
	
	$('.addQualification').click(function()
	{
		var countClass = $('.removeQualification').length;
		if(countClass<4) {
		$(".appendQualification").append('<div class="appendDiv"><li class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="customformwrap"><label class="customLabel">University</label><input autocomplete="off" type="text" class="custominput text-capitalize" name="university[]" /></div></li><li class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="customformwrap"><label class="customLabel">Degree</label><input autocomplete="off" type="text" class="custominput text-capitalize" name="degree[]" /></div></li><li class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="slt-gender col-lg-5 col-md-4 col-sm-6 col-xs-12"><div class="customformwrap"><label class="customLabel">Passing Year</label><select class="custominput singleselect" name="passing_year[]"><option value="">Select</option><?php for($i=2018; $i>=1960; $i--) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?></select></div></div><div class="addmoreBtn doceditbtn"><b class="sprite addplusIcon removeQualification"></b></div></li></div>');
		$(".singleselect").select2();
		}
	});
	
	$('body').on('click','.removeQualification',function()
	{
		$(this).closest(".appendDiv").remove();
	});
	
	$('.addEmail').click(function()
	{
		var countClass = $('.removeEmail').length;
		if(countClass<4) {
		$(".appendEmail").append('<div class="appendDiv"><label class="customLabel">Email</label><input autocomplete="off" type="email" class="custominput inputwith-abbbtn" name="email[]" /><div class="addmoreBtn otheremailClick "><b class="sprite addplusIcon removeEmail"></b></div><span class="errorClass emailErrorClass">Field Required</span></div>');
		}
	});
	
	$('body').on('click','.removeEmail',function()
	{
		$(this).closest(".appendDiv").remove();
	});
	
	$('.addPhone').click(function()
	{
		var countClass = $('.removePhone').length;
		if(countClass<4) {
		$(".appendPhone").append('<div class="appendDiv"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-2" style="padding-left: 0;"><div class="customformwrap"><label class="customLabel">prefix Code</label><select class="custominput singleselect" name="phone_code[]"><option value="+91">+91</option><option value="+90">+90</option></select></div></div><div class="col-lg-9 col-md-9 col-sm-9 col-xs-10"><div class="customformwrap"><label class="customLabel">Phone Number</label><input autocomplete="off" type="text" maxlength="10" class="custominput inputwith-abbbtn phone" name="phone[]" style="margin-right:14px;" /><div class="addmoreBtn otherdocClick"><b class="sprite addplusIcon removePhone"></b></div></div></div></div>');
		$(".singleselect").select2();
		}
	});
	
	$('body').on('click','.removePhone',function()
	{
		$(this).closest(".appendDiv").remove();
	});
	
	$('.addAnotherTime').click(function()
	{
		if($(".daysData").val().indexOf("Mon")!=-1 && $(".daysData").val().indexOf("Tue")!=-1 && $(".daysData").val().indexOf("Wed")!=-1 && $(".daysData").val().indexOf("Thu")!=-1 && $(".daysData").val().indexOf("Fri")!=-1 && $(".daysData").val().indexOf("Sat")!=-1 && $(".daysData").val().indexOf("Sun")!=-1)
		{
			alert("No days left");
			return false;
		}
		
		var countClass = $('.timeDiv').length;
		
		$(".appendAnotherTime").append('<div class="appendDiv"><div class="userViewwrap timeDiv"><h3 class="doctorTitle">Timing</h3><div class="userViewlist bottomspace"><div class="clearfix"><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="customformwrap"><label class="customLabel">Day of week</label></div><div class="weeklyWrap weeklyborder" style="display: block;"><input type="text" name="days['+countClass+'][Mon]" data-id="'+countClass+'" class="days days_'+countClass+'" placeholder="Mon" readonly> <input type="text" name="days['+countClass+'][Tue]" data-id="'+countClass+'" class="days days_'+countClass+'" placeholder="Tue" readonly> <input type="text" name="days['+countClass+'][Wed]" data-id="'+countClass+'" class="days days_'+countClass+'" placeholder="Wed" readonly> <input type="text" name="days['+countClass+'][Thu]" data-id="'+countClass+'" class="days days_'+countClass+'" placeholder="Thu" readonly> <input type="text" name="days['+countClass+'][Fri]" data-id="'+countClass+'" class="days days_'+countClass+'" placeholder="Fri" readonly> <input type="text" name="days['+countClass+'][Sat]" data-id="'+countClass+'" class="days days_'+countClass+'" placeholder="Sat" readonly> <input type="text" name="days['+countClass+'][Sun]" data-id="'+countClass+'" class="days days_'+countClass+'" placeholder="Sun" readonly></div></div><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="customformwrap"><label class="customLabel">&nbsp;&nbsp;Start Time</label></div><div class="timecreate clearfix"><div class="customformwrap"><input type="time" class="custominput witoutbg without_ampm" value="00:00" name="fullSchedule['+countClass+'][start_time][0]"></div> <div class="customTimePM"><select class="form-control locationInput" name="fullSchedule['+countClass+'][start_meridiem][0]"><option value="AM">AM</option><option value="PM">PM</option></select></div></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="customformwrap"><label class="customLabel">&nbsp;&nbsp;End Time</label></div><div class="timecreate clearfix"><div class="customformwrap"><input type="time" class="custominput witoutbg without_ampm" value="00:00" name="fullSchedule['+countClass+'][end_time][0]"></div> <div class="customTimePM"><select class="form-control locationInput" name="fullSchedule['+countClass+'][end_meridiem][0]"><option value="AM">AM</option><option value="PM">PM</option></select></div></div></div></div><div class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><div class="customformwrap"><label class="customLabel">&nbsp;&nbsp;Average Appointment DURATION</label></div><div class="timecreate durationtime clearfix"><div class="customformwrap"><select class="form-control locationInput" name="fullSchedule['+countClass+'][duration_time][0]"><option value="15">15</option><option value="30">30</option></select></div> <div class="customTimePM"><select class="form-control locationInput" name="fullSchedule['+countClass+'][duration_min][0]"><option value="Min">Min</option></select></div></div></div><div class="col-lg-2 col-md-4 col-sm-2 col-xs-4"><div class="addmoreBtn othertimeaddClick addtimeclearclick" id="'+countClass+'"><b class="sprite addplusIcon addDuration"></b></div><div class="linedefaultbtn allothertimeaddClick removeAnotherTime" style="margin-left:10px;"> <span>Remove Time</span> </div></div></div><div class="appendDuration"></div></div></div></div>');
	});
	
	$('body').on('click','.removeAnotherTime',function()
	{
		var id = $(this).prev().attr("id");
		
		$(".days_"+id).map(function()
		{
			if(this.value!="")
			{
				$(".daysData").val($(".daysData").val().replace(this.value,''));
			}
		}).get();
		
		$(this).closest(".appendDiv").remove();
	});
	
	$('body').on('click','.addDuration',function()
	{
		var countFullTime = $(this).parent().attr("id");
		
		var countTime = $(this).parent().parent().parent().next(".appendDuration").children('.appendDiv').length + parseInt(1);
		
		$(this).parent().parent().parent().next(".appendDuration").append('<div class="appendDiv"><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"></div><div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="customformwrap"><label class="customLabel">&nbsp;&nbsp;Start Time</label></div><div class="timecreate clearfix"><div class="customformwrap"><input type="time" class="custominput witoutbg without_ampm" value="00:00" name="fullSchedule['+countFullTime+'][start_time]['+countTime+']"></div> <div class="customTimePM"><select class="form-control locationInput" name="fullSchedule['+countFullTime+'][start_meridiem]['+countTime+']"><option value="AM">AM</option><option value="PM">PM</option></select></div></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="customformwrap"><label class="customLabel">&nbsp;&nbsp;End Time</label></div><div class="timecreate clearfix"><div class="customformwrap"><input type="time" class="custominput witoutbg without_ampm" value="00:00" name="fullSchedule['+countFullTime+'][end_time]['+countTime+']"></div> <div class="customTimePM"><select class="form-control locationInput" name="fullSchedule['+countFullTime+'][end_meridiem]['+countTime+']"><option value="AM">AM</option><option value="PM">PM</option></select></div></div></div></div><div class="col-lg-2 col-md-2 col-sm-3 col-xs-4"><div class="customformwrap"><label class="customLabel">&nbsp;&nbsp;Average Appointment DURATION</label></div><div class="timecreate durationtime clearfix"><div class="customformwrap"><select class="form-control locationInput" name="fullSchedule['+countFullTime+'][duration_time]['+countTime+']"><option value="15">15</option><option value="30">30</option></select></div> <div class="customTimePM"><select class="form-control locationInput" name="fullSchedule['+countFullTime+'][duration_min]['+countTime+']"><option value="Min">Min</option></select></div></div></div><div class="col-lg-2 col-md-4 col-sm-2 col-xs-4"><div class="addmoreBtn othertimeaddClick addtimeclearclick"><b class="sprite addplusIcon removeDuration" ></b></div></div><div class="clearfix"></div></div>');
	});
	
	$('body').on('click','.removeDuration',function()
	{
		$(this).closest(".appendDiv").remove();
	});
	
	$('.otheremailClick').click(function() {
		$('.emailrepeat').addClass('active')
	});

	$('.otherdocClick').click(function() {
		$('.adddocnumber').addClass('active')
	});

	$('.univerotherclick').click(function() {
		$('.otheruniver').addClass('active')
	});

	$('.menutoggle').click(function() {
		$(this).toggleClass('active');
		$('header').toggleClass('active');
	});
	
	$('body').on('click','.days',function()
	{
		$(".timingErrorClass").css("display","none");
		
		if($(this).val()=="")
		{
			if($(".daysData").val().indexOf($(this).attr("placeholder")) == -1)
			{
				$(".daysData").val($(".daysData").val()+$(this).attr("placeholder"));
				
				$(this).val($(this).attr("placeholder"));
				$(this).css("background","#8f4b79");
				$(this).css("color","#fff");
				$(this).css("border-color","#8f4b79");
			}
		}
		else
		{
			$(".daysData").val($(".daysData").val().replace($(this).attr("placeholder"),''));
			
			$(this).val("");
			$(this).css("background","");
			$(this).css("color","");
			$(this).css("border-color","");
		}
	});
	
	$('body').on('click','.weeklyWrap a',function()
	{
		$(this).toggleClass('active');
	});
	
	$('#triggerClick').click(function(){
		$('.uploadImgClick').click();
	});
			
	$('.uploadClick').click(function()
	{
		$('#imgInp').click();
	});
	 
	
	var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
	/* $(".submit").click(function()
	{
		var formData = $("form").serialize();
		$.ajax({
			url: '<?php echo $this->url->build(["controller"=>"Doctor", "action"=>"save"]); ?>',  
			type: "POST",
			dataType: 'json',
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: formData,
			success: function(data)
			{
				//window.location.href = "<?php echo $this->url->build(["controller"=>"Doctor", "action"=>"doctorprofile",1]); ?>";
				window.location.href = "http://localhost/cake/doctor/doctorprofile/"+data;
			}   
		});
		return false;  
	}); */
		
	$(".mandatory").blur(function()
	{
		$(this).next(".errorClass").css("display","none");
	});
	
	$("body").on("change",".genderMandatory",function()
	{
		$(".genderMandatory").next().next(".errorClass").css("display","none");
	});
	
	$("body").on("blur",".emailMandatory",function()
	{
		$(this).next().next(".errorClass").css("display","none");
		
		if($(this).val()!="")
		{
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(regex.test($(this).val()) == false)
			{
				$(this).next().next(".errorClass").text("Enter Valid Email").css("display","block");
			}
			
			if($(".users_id").val()=="") {
			var clinicID = '<?php echo $this->request->getSession()->read('clinic_id'); ?>';
			var emailValue = $(this).val();
			$.ajax({
				url: '<?php echo $this->url->build(["controller"=>"Doctor", "action"=>"checkemail"]); ?>',
				type: "POST",
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				data: {'clinicID':clinicID, 'emailValue':emailValue},
				success: function(data)
				{
					
					if(data==1)
					{
						$(".checkEmail").css("display","block");
					}
					else
					{
						$(".checkEmail").css("display","none");
					}
				}   
			});
			}
		}
	});
	
	$(".newPassword").blur(function()
	{
		if($(this).val().length == 0)
		{
			$(".passwordErrorClass").css("display","none");
		}
		else if($(this).val().length < 8)
		{
			$(".passwordErrorClass").text("Password should be atleast 8 digits");
			$(".passwordErrorClass").css("display","block");
		}
		else
		{
			$(".passwordErrorClass").css("display","none");
		}
	});
	
	$(".editOldPassword").blur(function()
	{
		if($(this).val().length != 0)
		{
			$(".passwordErrorClass").css("display","none");
		}
	});
	
	$(".editNewPassword").blur(function()
	{
		if($(this).val().length == 0)
		{
			$(".confirmErrorClass").css("display","none");
		}
		else if($(this).val().length < 8)
		{
			$(".confirmErrorClass").text("Password should be atleast 8 digits");
			$(".confirmErrorClass").css("display","block");
		}
		else
		{
			$(".confirmErrorClass").css("display","none");
		}
	});
	
	$(".confirmPassword").blur(function()
	{
		if($(this).val()==$(".newPassword").val())
		{
			$(this).next().css("display","none");
			$(this).next().next().css("display","none");
		}
		else
		{
			$(this).next().next().css("display","block");
		}
	});
	
	$("body").on("keypress",".phone",function(event)
	{
		var keycode = event.which;
		if(!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57))))
		{
			event.preventDefault();
		}
	});
	
	var countFinalSubmit = 1;
	$("body").on("click",".finalSubmit",function()
	{
		if(countFinalSubmit!=1)
		{
			$(this).prop('disabled', true);
			$(".finalCancel").prop('disabled', true);
		}
		countFinalSubmit++;
	});
	
	$(".checkValidation").click(function()
	{
		$(".mandatory").each(function()
		{
			if($(this).val()=="")
			{
				$(this).next(".errorClass").css("display","block");
				
				if($(".emailMandatory").val()=="")
				{
					$(".emailMandatory").next().next(".errorClass").css("display","block");
				}
				
				if($(".daysData").val()=="")
				{
					$(".timingErrorClass").css("display","block");
				}
				
				if($(".genderMandatory").val()=="")
				{
					$(".genderMandatory").next().next(".errorClass").css("display","block");
				}
			}
			else
			{
				$(this).next(".errorClass").css("display","none");
				
				/* if($(".newPassword").val().length > 1 && $(".newPassword").val().length < 8)
				{
					$(".passwordErrorClass").text("Password should be atleast 8 digits");
					$(".passwordErrorClass").css("display","block");
				} */
			}
		});
		
		if($('.firstErrorClass').css('display')=='block' || $('.lastErrorClass').css('display')=='block' || $('.genderErrorClass').css('display')=='block' || $('.emailErrorClass').css('display')=='block' || $('.rnoErrorClass').css('display')=='block' || $('.rauthErrorClass').css('display')=='block' || $('.rstateErrorClass').css('display')=='block' || $('.passwordErrorClass').css('display')=='block' || $('.confirmErrorClass').css('display')=='block' || $('.timingErrorClass').css('display')=='block' || $('.checkEmail').css('display')=='block')
		{
			return false;
		}
		if($('.confirmPassword').next().next().css('display')=='block')
		{
			$(".confirmPassword").next(".errorClass").css("display","none");
			return false;
		}
		/* if($('.confirmPassword').val()!=$(".newPassword").val())
		{
			$('.confirmPassword').next().next().css("display","block");
			return false;
		} */
		if($(".checkDate").val()<18)
		{
			$(".dateErrorClass").css("display","block");
			return false;
		}
	});
	
	$(".changPassword").click(function()
	{
		var id = $(".id").val();
		if($(".editOldPassword").val()=="" || $(".editNewPassword").val()=="")
		{
			$(".passwordErrorClass").text("Field Required").css("display","block");
			$(".confirmErrorClass").text("Field Required").css("display","block");
			return false;
		}
		else if($(".editNewPassword").val().length < 8)
		{
			$(".confirmErrorClass").text("Password should be atleast 8 digits");
			$(".confirmErrorClass").css("display","block");
			return false;
		}
		else
		{
			$.ajax({
				url: '<?php echo $this->url->build(["controller"=>"Doctor", "action"=>"changepassword"]); ?>',
				type: "POST",
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				data: {'id':id, 'oldPassword':$(".editOldPassword").val(), 'newPassword':$(".editNewPassword").val()},
				success: function(data)
				{
					$(".passwordErrorClass").fadeIn().text(data).fadeOut(3000);
					if(data=="Password Changed")
					{
						$(".editOldPassword,.editNewPassword").val("");
					}
				}   
			});
		}
	});
	
});

$(window).on("load", function()
{
	$("#birthdateval").val($(".savedDOB").val());
	
	if($("#birthdateval").val()!="")
	{
		var expires = new Date();
		var birthDate = $("#birthdateval").val().split('/');
		$(".checkDate").val(expires.getFullYear()-birthDate[2]);
	}
});
		
		
		  
	</script>
	 

</body>