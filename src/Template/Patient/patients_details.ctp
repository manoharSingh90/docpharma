
<?php
echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']);
?>

<body>

<header>
<?php echo $this->element("left_panel"); ?>
</header>

<div class="main-wraper">
<div class="container">
	<div class="row">
		<ul class="customHeadWrap">
			<li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<a href="<?php echo $this->Url->build(["controller" => "patient","action" => "index"]); ?>" class="backLink text-uppercase"><img src="<?php echo PATH.'img/doctor/back-arrow.png'; ?>"> Back</a>
				<div class="customHead"> <b><img src="<?php echo PATH.'img/doctor/doctor-app.png'; ?>" alt="" /></b> <span>Patients Details</span> </div>
			</li>
			<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
			<div class="headLink">
			<a class="pull-right btn btn-secondary text-uppercase" data-toggle="modal" data-target="#createpatient-Modal">Edit Patient Details</a>
			
			<?php if($this->request->getSession()->read('role_id')==4 && isset($ppData["id"]) && !empty($ppData["id"])) { ?>
			<a href="<?php echo $this->Url->build(["controller"=>"patient","action"=>"patientPmr",base64_encode($data['id'])]); ?>" class="pull-right btn btn-secondary text-uppercase">VIEW PMR</a><?php } ?>
			</div>
			</li>
		</ul>
	</div>
</div>

<!-- Patient Information -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="doctorWrap">
				<div class="userViewwrap">
					<h3 class="doctorTitle">Patient Information</h3>
					<ul class="clearfix userViewlist mb0">
						<li class="col-lg-3 col-md-3 col-sm-6">
							<div class="customformwrap">
								<label class="customLabel">FULL NAME</label>
								<p><?php echo $data['title']; ?> <?php echo $data['fname']; ?> <?php echo $data['mname']; ?> <?php echo $data['lname']; ?></p>
							</div>
						</li>
						<?php $dob=explode(' ',$data['dob']); $currentYear = date("Y"); $age = $currentYear-$dob[2]; ?>
						<li class="col-lg-2 col-md-2 col-sm-6">
							<div class="customformwrap">
								<label class="customLabel">AGE (Date Of Birth)</label>
								<p><?= $dob[2] ? $age : ''; ?> (<?= $data['dob']; ?>)</p>
							</div>
						</li>
						<li class="col-lg-2 col-md-2 col-sm-6">
							<div class="customformwrap">
								  <label class="customLabel">Gender</label>
								<p><?php echo $data['gender']; ?></p>
							</div>
						</li>
						<?php $numb=explode(',',$data['m_number']); $country_code=explode(',',$data['country_code']);?>
						<li class="col-lg-2 col-md-2 col-sm-6">
							<div class="customformwrap">
								<label class="customLabel">PHONE NUMBER</label>
								<?php foreach($country_code as $codeKey => $codeValue ){ ?>
								<p class="para"><?php echo $codeValue;?> 
								<span><?php echo $numb[$codeKey]; ?></span></p><?php } ?>
								
							</div>
						</li>
						<?php $email=explode(',',$data['email']);?>
						<li class="col-lg-3 col-md-3 col-sm-12">
							<div class="customformwrap">
								<label class="customLabel">Email</label>
								<p><?php foreach($email as $emails){ echo $emails;  echo '<br>'; }?>
							</div>
						</li>
						<?php if($age < 18){ ?>
						<li class="col-lg-3 col-md-3 col-sm-12">
							<div class="customformwrap">
								<label class="customLabel">Guardian Name</label>
								<p><?php echo $data['guardian_name']; ?></p>
							</div>
						</li>
						<li class="col-lg-3 col-md-3 col-sm-12">
							<div class="customformwrap">
								<label class="customLabel">Guardian Contact</label>
								<p><?php echo $data['guardian_contact']; ?></p>
							</div>
						</li>
						<li class="col-lg-3 col-md-3 col-sm-12">
							<div class="customformwrap">
								<label class="customLabel">Relation</label>
								<p><?php echo $data['relation']; ?></p>
							</div>
						</li>
						<?php } ?>
						<li class="col-lg-3 col-md-3 col-sm-12">
							<div class="customformwrap">
								<label class="customLabel">Notes</label>
								<p><?php echo $data['notes']; ?></p>
							</div>
						</li>
						<li class="col-lg-4 col-md-4 col-sm-6 mb0">
							<div class="customformwrap">
								<label class="customLabel">Address</label>
								<p><?php echo $data['address']; ?>, <?php echo $data['pincode']; ?>, <?php echo $data['city']; ?>, <?php echo $data['state']; ?>, <?php echo $data['country']; ?></p>
							</div>
						</li>
					</ul>
				</div>
				
				<?php $allergy = explode(',',$data['allergy']); if(!empty($allergy[1]) || !empty($data['conditions'])) { ?>						
				<div class="viewallergiesWrap">
				<?php if(!empty($allergy[1])) { ?>
				 <div class="addorderbody">
				  <h3>ALLERGIES</h3>						 
				  <div class="addorderarea">		  
					<div class="selectprolist"> 
				   <span><?php foreach($allergy as $key=>$value){
					$ex=explode('_',$value); echo $ex[1];?> &nbsp;&nbsp; <?php  }?></span>
				  </div>
				  </div>
				</div>
				<hr>
				<?php } ?>
				
				<?php if(!empty($data['conditions'])){?>				
				<div class="addorderbody">
				  <h3>CONDITIONS</h3>
				  <div class="addorderarea">
					<div class="selectprolist">
				   <span><?php echo $data['conditions']; ?></span>
				   </div>
				  </div>
				</div>
				<?php } ?>
			  </div>
			  <?php } ?>
			</div>
		</div>
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
									<label class="customLabel">PHONE NUMBER</label>
									<p></p>
								</div>
							</li>
							<li>
								<div class="customformwrap">
									<label class="customLabel">Phone Number</label>
									<p>+91 9685XXXX52, +91 7625XXX781</p>
								</div>
							</li>
							<li>
								<div class="customformwrap">
									<label class="customLabel">AGE (DATE OF BIRTH)</label>
									<p>21 (03 Apr 1995)</p>
								</div>
							</li>
							<li>
								<div class="customformwrap">
									<label class="customLabel">Email</label>
									<p>bhavyasinghsharma@gmail.com</p>
								</div>
							</li>
							<li>
								<div class="customformwrap">
									<label class="customLabel">Address</label>
									<p> #03 - Ground Floor A-42/6, Pinnacle Tower, Sector 62, Noida, Uttar Pradesh 201301</p>
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
				<button type="button" class="btn btn-primary text-uppercase" data-toggle="modal" data-target="#createpatient-Modal">Edit</button>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Modal -->
<div id="createpatient-Modal" class="modal fade" role="dialog">
<?php echo $this->element("Patient/create_patient"); ?></div>

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
<script>
	 function edit_cat(id,title,fname,mname,lname,gender,dob,m_number,email,address,country,state,city,pincode){
	//alert(gender);
	
	/*$('#title').val(title); 
	$('#fname').val(fname); 
	$('#mname').val(mname); 
	$('#lname').val(lname); 
	$('#gender').val(gender);  */-->
	
	var arr2 = m_number.split(",");
	//alert(arr2);
	var var1 = arr2[0];
	var var2 = arr2[1];
	var var3 = arr2[2];
	$('#m_number').val(var1); 
	
	/*$('#email').val(email); 
	$('#address').val(address); 
	$('#country').val(country); 
	$('#state').val(state); 
	$('#city').val(city); 
	$('#pincode').val(pincode); 
	$('#id').val(id); */
	
	}
</script>
<script type="text/javascript">
$(document).ready(function () {
	$(".singleselect").select2();
	
	$("#allergyData").select2({
		dropdownCssClass: "allergyData"
	});
	
	$('.patinumclick').click(function () {
		$('.patiothernumber').addClass('active');
	});
	$('.patiemailclick').click(function () {
		$('.patiotheremail').addClass('active');
	});
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
	/* $('.clderIconClick').click(function () {
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
	///////
	$('.reportsClick').click(function () {
		$('#reportsdate').click();
	});
	$("#reportsdate").daterangepicker({
		autoUpdateInput: true
		, singleDatePicker: true
		, locale: {
			format: 'DD MMM YYYY'
		}
	}); */
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
	});
	$(document).on('click', '.toggleSubHead', function (e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$(this).closest('.repeathistory').find('.toggleSubContent').slideToggle();
	});
	
});
</script>
</body>