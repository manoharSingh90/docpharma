
<?php echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.js']); ?>

<body>
	
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
<form method="post" action="<?php echo $this->url->build(["controller" => "executive","action" => "save"]); ?>" class="create-patient-form clearfix">
	<div class="main-wraper">
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-md-6 col-sm-12">
						<div class="customHead">
							<div class="backbtn">
							<a href="<?php echo $this->url->build(["controller" => "executive","action" => "index"]); ?>"><img src="<?php echo PATH.'img/doctor/back-arrow.png'; ?>" alt="#" /> Back</a>
							</div>
							<b><img src="<?php echo PATH.'img/doctor/user-icon.png'; ?>" alt="#" /></b><a href="<?php echo $this->url->build(["controller" => "executive","action" => "save"]); ?>"><span>Create New Executive Assistants</span></a> </div>
					</li>
					<li class="col-md-6 col-sm-12 text-right ">
						<a href="#" class="btn btn-default text-uppercase viewhistory" data-toggle="modal" data-target="#cancelModal">Cancel</a>
						<button type="submit" id="submit" class="btn btn-primary text-uppercase viewhistory">Save</button> 
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="doctorWrap">
				<div class="userViewwrap">
			<form method="post" action="<?php echo $this->Url->build(["controller" => "executive","action" => "save"]); ?>" class="create-patient-form clearfix">
			
			<input type="hidden" name="id" value="<?php echo isset($data["id"]) ? $data["id"] : ""; ?>">
			<?php if($data['id']){?>
			<input type="hidden" name="modified_by" value="<?php echo $this->request->getSession()->read('role_id'); ?>">
			<?php } ?>
			<input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
			 
					<h3 class="doctorTitle">Personal information</h3>
					<ul class="clearfix userViewlist">

						<li class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
							<div class="slt-gender">
								<div class="customformwrap">
									<label class="customLabel">Title</label>
									<select class="custominput singleselect" name="title">
									<option value="Ms" <?php echo $data['title']=='Ms' ? 'selected' : ""; ?>>Ms.</option>
									<option value="Mrs" <?php echo $data['title']=='Mrs' ? 'selected' : ""; ?>>Mrs.</option>
									<option value="Mr" <?php echo $data['title']=='Mr' ? 'selected' : ""; ?>>Mr.</option>
										
									</select>
								</div>
							</div>
						</li>
						<li class="col-lg-3 col-md-2 col-sm-12 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">First Name<span class="starClass"> *</span></label>
								<input type="text" name="first_name" value="<?php echo $data['first_name'] ? $data['first_name'] : "";?>" id="fname" class="custominput mandatory" autocomplete="off">
								<span class="msg"></span>
							</div>							
						</li>
						
						<li class="col-lg-3 col-md-2 col-sm-12 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Middle Name</label>
								<input type="text" value="<?php echo $data['middle_name'] ? $data['middle_name'] : "";?>" name="middle_name" class="custominput" autocomplete="off"/>
							</div>
						</li>
						<li class="col-lg-3 col-md-2 col-sm-12 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Last Name<span class="starClass"> *</span></label>
								<input type="text" value="<?php echo $data['last_name'] ? $data['last_name'] : "";?>" name="last_name" id="lname" class="custominput mandatory" autocomplete="off"/>
								<span class="msg"></span>
							</div>							
						</li>
						
						<li class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
							<div class="slt-gender">
								<div class="customformwrap">
									<label class="customLabel">Gender</label>
									<select class="custominput singleselect" name="gender">
									<option value="Male" <?php echo $data['gender']=='Male' ? 'selected':''; ?>>Male</option>
									<option value="Female" <?php echo $data['gender']=='Female' ? 'selected':''; ?>>Female</option>
									</select>
								</div>
							</div>
						</li>
						
						<li class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
							<div class="customformwrap">
								<label class="customLabel">Date of Birth</label>
								<input type="text" value="<?php echo $data['dob'] ? $data['dob'] : "";?>" name="dob" id="birthdateval" class="custominput" placeholder="DD/MM/YYYY" />
								<b class="sprite clderIcon cld_icon clderIconClick"></b> </div>
						</li>


                      <?php $email = explode(',',$data['email']); ?>
						<li class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
						<div class="customformwrap">
						<?php if(empty($data['id'])){ ?>							
								<label class="customLabel">Email<span class="starClass"> *</span></label>
								<input type="email" name="email[]" id="email" class="custominput inputwith-abbbtn mandatory" autocomplete="off"/>
								<div class="addmoreBtn otheremailClick "><b class="sprite addplusIcon addmail"></b></div>
							    <span class="msg"></span>
						<?php }else{ 
						$count = sizeof($email);
			           for($i=0; $i<=$count-1; $i++){ ?>
					   			<div class="remove_email">
						        <label class="customLabel">E-mail<?php echo $email[$i]==$email[0]? '<span class="starClass"> *</span>':''; ?></label>
								<input type="email" value="<?php echo $email[$i] ? $email[$i] : ""; ?>" name="email[]" class="custominput inputwith-abbbtn" autocomplete="off"/>
								<div class="addmoreBtn otheremailClick "><b class="sprite <?php echo $email[$i]==$email[0]? 'addplusIcon':'addminusIcon';?> <?php echo $email[$i]==$email[0]? 'addmail':'removemail'; ?>"></b></div>
								</div>
								<?php } } ?>
					      </div>
							<div class="emailrepeat"></div>
						</li>
						 <?php $phone = explode(',',$data['phone']); $phone_code = explode(',',$data['phone_code']); ?>
						<li class="col-lg-4 col-md-5 col-sm-9 col-xs-12">
						<?php if(empty($data['id'])){ ?>
						
							<div class="col-lg-3 col-md-3 col-sm-2 col-xs-4" style="padding-left: 0;">	
							 <div class="customformwrap">
									<label class="customLabel">prefix Code</label>
									<select class="custominput singleselect" name="phone_code[]">
										<option value="+91" >+91</option>
										<option value="+90" >+90</option>
									</select>
								</div>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-8" style="padding-right: 0;">
								<div class="customformwrap">
									<label class="customLabel">Phone Number<span class="starClass"> *</span></label>
									<input type="text" name="phone[]" id="phone" class="custominput inputwith-abbbtn mandatory phone1" maxlength="10" autocomplete="off"/>
									<div class="addmoreBtn otherdocClick"><b class="sprite addplusIcon addphone"></b></div>
									<span class="msg"></span>
								</div>
								
							</div>
							<?php }else{ 
						      $count = sizeof($phone_code);
			                  for($i=0; $i<=$count-1; $i++){ ?>
							  <div class="remove_phone">
							  <div class="col-lg-3 col-md-3 col-sm-2 col-xs-4" style="padding-left: 0;">
							  <div class="customformwrap">
							  <label class="customLabel">prefix Code</label>
							  <select class="custominput singleselect" name="phone_code[]">
								<option value="+91" <?php echo $phone_code[$i]=='+91' ? "selected" : "" ; ?> >+91 </option> 
								<option value="+90" <?php echo $phone_code[$i]=='+90' ? "selected" : "" ; ?> >+90 </option> 
								</select>
							</div>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-8" style="padding-right: 0;">
								<div class="customformwrap">
									<label class="customLabel">Phone Number<?php echo $phone[$i]==$phone[0]? '<span class="starClass"> *</span>':''; ?></label>
									<input type="text" value="<?php echo $phone[$i] ? $phone[$i] : ""; ?>" name="phone[]" class="custominput inputwith-abbbtn phone1" maxlength="10" autocomplete="off"/>
									<div class="addmoreBtn otherdocClick"><b class="sprite <?php echo $phone[$i]==$phone[0]? 'addplusIcon':'addminusIcon'; ?> <?php echo $phone[$i]==$phone[0]? 'addphone':'removephone';?>"></b></div>
								</div>
							</div>
							</div>
							  <?php } } ?>
							  
							<div class="adddocnumber"></div>
							
						</li>
						 
						<li class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
							<div class="slt-gender">
								<div class="customformwrap">
									<label class="customLabel">Type</label>
									<select class="custominput singleselect" name="type">
									<option value="Permanent" <?php echo $data['type']=='Permanent'? 'selected':''; ?>>Permanent</option>
									<option value="Temporary" <?php echo $data['type']=='Temporary'? 'selected':''; ?>>Temporary</option>
									</select>
								</div>
							</div>
						</li>
					</ul>
					</form> 
				</div>
				
				<?php $permission = explode(',',$data['permission']); ?>
				<div class="userViewwrap">
						<h3 class="doctorTitle">PERMISSIONS</h3>
					<ul class="clearfix userViewlist">
					
							<li class="col-lg-3 col-md-12 col-sm-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" name="permission[]" value="1" 
											<?php echo (in_array(1,$permission)) ? 'checked' : ''; ?>>
											<b></b><span>Appointment Setup and Details</span></label>
									</div>
							</li>
								<li class="col-lg-2 col-md-12 col-sm-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" name="permission[]" value="2"
											<?php echo (in_array(2,$permission)) ? 'checked' : ''; ?>>
											<b></b><span>Medical History</span></label>
									</div>
								</li>
								<li class="col-lg-2 col-md-12 col-sm-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" name="permission[]" value="3" 
											<?php echo (in_array(3,$permission)) ? 'checked' : ''; ?>>
											<b></b><span>View/Upload Reports</span></label>
									</div>
								</li>
								 
								<li class="col-lg-2 col-md-12 col-sm-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" name="permission[]" value="4" 
											<?php echo (in_array(4,$permission)) ? 'checked' : ''; ?>>
											<b></b><span>Visit History</span></label>
									</div>
								</li>
					</ul>
			
				</div>

			</div>
		</div>
	</div>
</form>
	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
		<!-- Cancel Modal -->
	 
<div id="cancelModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cancel EXECUTIVE ASSISTANTS</h4>
      </div>
      <div class="modal-body text-center">
        <p>Are you sure you want to discard the user information?</p>
      </div>
      <div class="modal-footer text-center">
        <a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">No</a>
        <a href="<?php echo $this->Url->build(["controller" => "executive","action" => "index"]); ?>" class="btn btn-primary text-uppercase">Yes</a>
      </div>
    </div>
  </div>
</div>
<?= $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']); ?>
<?= $this->Html->script(['pharmacy/jquery.formatter.min.js']); ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".singleselect").select2();
			
	$('#birthdateval').formatter({
     'pattern': '{{99}}/{{99}}/{{9999}}'
      });
			
	$('.clderIconClick').click(function() {
	$('#birthdateval').click();
			});
			
	$('#birthdateval').datetimepicker({
		           useCurrent: false,
                   format: 'DD/MM/YYYY',
		 			//minDate: moment(),
					maxDate: moment(),
		 			useStrict:true,
		 			locale:  moment.locale('en', {
			week: { dow: 1 }
         })
      });
			
			$('.othercontactClick').click(function() {
				$('.formlist').removeClass('othercontact')
			});
			
			$('.othertimeaddClick').click(function() {
				$('.repeattimerow').addClass('active')
			});
			$('.otheremailClick').click(function() {
				$('.emailrepeat').addClass('active')
			});
			$('.otherdocClick').click(function() {
				$('.adddocnumber').addClass('active')
			});

			$('.menutoggle').click(function() {
				$(this).toggleClass('active');
				$('header').toggleClass('active');
			});

			$('.weeklyWrap a').click(function() {
				$(this).toggleClass('active');
			});

$('#submit').click(function (e) {
	
	$(".mandatory").each(function()
	{
		if($(this).val()=="")
		{
			$(this).next(".msg").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
			$(this).next().next(".msg").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
		}
	});
	
	if($('#fname').val()=="" || $('#lname').val()=="" || $('#phone').val()=="" || $('#email').val()=="")
	{
		return false;
	}
    
});

var maxField = 3;
var fieldHTML = '<div class="remove_email"><div class="customformwrap"><label class="customLabel">Email</label><input type="email" name="email[]" class="custominput inputwith-abbbtn" /><div class="addminusBtn otheremailClick "><b class="sprite addminusIcon removemail"></b></div></div></div>';


     var x = 1;
	 $('.addmail').click(function(){	 
		 if(x < maxField){ 
		  x++;
		  $('.emailrepeat').append(fieldHTML);			  
		   }
	 });  
	 
	 $('body').on('click','.removemail',function(e){
        e.preventDefault();
		$(this).closest(".remove_email").remove();
		 x--;
		 });
		 
var fieldHTML2 = '<div class="remove_phone"><div class="col-lg-3 col-md-3 col-sm-2 col-xs-4" style="padding-left: 0;">	<div class="customformwrap"><label class="customLabel">prefix Code</label><select class="custominput singleselect" name="phone_code[]"><option value="+91" >+91</option><option value="+90" >+90</option></select></div></div><div class="col-lg-9 col-md-9 col-sm-12 col-xs-8" style="padding-right: 0;"><div class="customformwrap"><label class="customLabel">Phone Number</label><input type="text" name="phone[]" maxlength="10" class="custominput inputwith-abbbtn phone1" /><div class="addminusBtn otherdocClick"><b class="sprite addminusIcon removephone"></b></div></div></div></div>';


     var w = 1;
	 $('.addphone').click(function(){	 
		 if(w < maxField){ 
		  w++;
		  $('.adddocnumber').append(fieldHTML2);
		  $(".singleselect").select2();
		   }
	 });  
	 
	 $('body').on('click','.removephone',function(e){
        e.preventDefault();
		$(this).closest(".remove_phone").remove();
		 w--;
		 });		 
		 
		 
$("body").on("keypress",".phone1",function(event){
  var keycode = event.which;
    if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});		 
		});
	</script>
 

</body>

</html>