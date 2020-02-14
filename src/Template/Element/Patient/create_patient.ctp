
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo isset($data['id']) || isset($appointmentDetails["patient_detail"]["id"]) ? "Edit Patient" : "Create Patient"; ?></h4>
      </div>
      <div class="modal-body clearfix">
        
	<form method="post" action="<?php echo $this->url->build(["controller" => "patient","action" => "save"]); ?>" class="create-patient-form clearfix" >
	
	<input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
	
	<?php
	if($this->request->getParam('controller')=="Patient")
	{
		$pageName = "Patient";
	}
	else if($this->request->getParam('controller')=="Appointment" && $this->request->getParam('action')=="index")
	{
		$pageName = "Appointment";
	}
	else if($this->request->getParam('controller')=="Pharmacy")
	{
		$pageName = "Pharmacy";
	}
	else
	{
		$pageName = $this->request->getParam('pass')[0];
	}
	?>
	
	<input type="hidden" name="pageName" value="<?php echo $pageName; ?>" >
	
	 <input type="hidden" name="id" id="id" value="<?php echo isset($data['id']) ? $data['id'] : ((isset($appointmentDetails["patient_detail"]["id"])) ? $appointmentDetails["patient_detail"]["id"] : "" ); ?>" >
	 
		<fieldset class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		  	<div class="customformwrap">
               <label class="customLabel">Title<span class="starClass"> *</span></label>
			    <select class="custominput singleselect mandatory" name="title" id="title">
			     <option value="">Select</option>
                  <option value="Ms" <?php echo isset($data['title']) && $data['title']=='Ms' ? 'selected' : ((isset($appointmentDetails["patient_detail"]["title"])) && $appointmentDetails["patient_detail"]["title"]=="Ms" ? "selected" : "" ); ?> >Ms.</option>
                  <option  value="Mr" <?php echo isset($data['title']) && $data['title']=='Mr' ? 'selected' : ((isset($appointmentDetails["patient_detail"]["title"])) && $appointmentDetails["patient_detail"]["title"]=="Mr" ? "selected" : "" ); ?> >Mr.</option>
				  <option  value="Mrs" <?php echo isset($data['title']) && $data['title']=='Mrs' ? 'selected' : ((isset($appointmentDetails["patient_detail"]["title"])) && $appointmentDetails["patient_detail"]["title"]=="Mrs" ? "selected" : "" ); ?> >Mrs.</option>
                </select>
			 <p class="msg1 errorClass1"></p>			
			</div>
		 </fieldset> 
		 
		 <fieldset class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		  	<div class="customformwrap">
              <label class="customLabel">First Name<span class="starClass"> *</span></label>
			  <input type="text" class="custominput text-capitalize mandatory" name="fname" id="fname" value="<?php echo isset($data['fname']) ? $data['fname'] : ((isset($appointmentDetails["patient_detail"]["fname"])) ? $appointmentDetails["patient_detail"]["fname"] : "" ); ?>" autocomplete="off" maxlength="20">
			  <p class="msg1 errorClass1"></p>
			</div>
		 </fieldset>
		 
		<fieldset class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		  	<div class="customformwrap">
               <label class="customLabel">Middle Name</label>
			  	<input type="text" class="custominput text-capitalize mandatory" name="mname" id="mname" value="<?php echo isset($data['mname']) ? $data['mname'] : ((isset($appointmentDetails["patient_detail"]["mname"])) ? $appointmentDetails["patient_detail"]["mname"] : "" ); ?>" autocomplete="off" maxlength="20">
			</div>
		 </fieldset>
		 
		<fieldset class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		  	<div class="customformwrap">
               <label class="customLabel">Last Name<span class="starClass"> *</span></label>
			  	<input type="text" class="custominput text-capitalize mandatory" name="lname" id="lname" value="<?php echo isset($data['lname']) ? $data['lname'] : ((isset($appointmentDetails["patient_detail"]["lname"])) ? $appointmentDetails["patient_detail"]["lname"] : "" ); ?>" autocomplete="off" maxlength="20">
				<p class="msg1 errorClass1"></p>
			</div>
		 </fieldset>
		 
		 <div class="clearfix"></div>
		 
		<fieldset class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		  	<div class="customformwrap">
               <label class="customLabel">Gender<span class="starClass"> *</span></label>
			  <select class="custominput singleselect mandatory" name="gender" id="gender">
			    <option value="">Select</option>
                  <option value="Male" <?php echo isset($data['gender']) && $data['gender']=='Male' ? 'selected' : ((isset($appointmentDetails["patient_detail"]["gender"])) && $appointmentDetails["patient_detail"]["gender"]=="Male" ? "selected" : "" ); ?> >Male</option>
                  <option value="Female" <?php echo isset($data['gender']) && $data['gender']=='Female' ? 'selected' : ((isset($appointmentDetails["patient_detail"]["gender"])) && $appointmentDetails["patient_detail"]["gender"]=="Female" ? "selected" : "" ); ?> >Female</option>
                </select>
			  <p class="msg1 errorClass1"></p>
			</div>
		 </fieldset>
			  
		<?php $expDOB = explode(' ',$data['dob']); $dob2 = date_create($expDOB[1]);  $dateForm = date_format($dob2,"m"); 
		$arr = array($expDOB[0],$dateForm,$expDOB[2]); $impDOB = implode('/',$arr); ?>	  
		<fieldset class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		    <div class="customformwrap">
			<label class="customLabel">Date of Birth<span class="starClass"> *</span></label>
			<input type="text" value="<?php echo isset($data['dob']) ? $impDOB : ((isset($appointmentDetails["patient_detail"][$impDOB])) ? $appointmentDetails["patient_detail"][$impDOB] : "" ); ?>" name="dob" id="birthdateval_patient" class="custominput mandatory" placeholder="DD/MM/YYYY"/>
			<b class="sprite clderIcon cld_icon clderIconClick"></b>
			<p class="msg1 errorClass1"></p></div>
		</fieldset>
		
		<?php $dob = isset($data['dob']) ? explode(' ',$data['dob']) : ((isset($appointmentDetails["patient_detail"]["dob"])) ? explode(' ',$appointmentDetails["patient_detail"]['dob']) : "" );  $currentYear = date("Y");
         $diff = $currentYear-$dob[2]; ?>
		 
		<div class="appendGuardian">
		<?php if($diff < 18){ ?>
		<fieldset class="col-lg-4 col-md-4 col-sm-6 col-xs-12 gname">
		  	<div class="customformwrap">
               <label class="customLabel">Guardian Name<span class="starClass"> *</span></label>
			  	<input type="text" class="custominput text-capitalize mandatory" id="gname" name="guardian_name" value="<?= isset($data['guardian_name']) ? $data['guardian_name'] : ((isset($appointmentDetails["patient_detail"]["guardian_name"])) ? $appointmentDetails["patient_detail"]["guardian_name"] : "" ); ?>" autocomplete="off">
				<p class="msg1 errorClass1" maxlength="25"></p>
			</div>
		 </fieldset>
		 
		 <fieldset class="col-lg-4 col-md-4 col-sm-6 col-xs-12 gcontact">
		  	<div class="customformwrap">
               <label class="customLabel">Contact No.<span class="starClass"> *</span></label>
			  	<input type="text" class="custominput phone1 mandatory" id="gcontact" name="guardian_contact" value="<?= isset($data['guardian_contact']) ? $data['guardian_contact'] : ((isset($appointmentDetails["patient_detail"]["guardian_contact"])) ? $appointmentDetails["patient_detail"]["guardian_contact"] : "" ); ?>" autocomplete="off" maxlength="10">
				<p class="msg1 errorClass1"></p>
			</div>
		 </fieldset>
		 
		 <fieldset class="col-lg-4 col-md-4 col-sm-6 col-xs-12 grelation">
		  	<div class="customformwrap">
               <label class="customLabel">Relation<span class="starClass"> *</span></label>
			  	<input type="text" class="custominput text-capitalize mandatory" id="grelation" name="relation" value="<?= isset($data['relation']) ? $data['relation'] : ((isset($appointmentDetails["patient_detail"]["relation"])) ? $appointmentDetails["patient_detail"]["relation"] : "" ); ?>" autocomplete="off" maxlength="25">
				<p class="msg1 errorClass1"></p>
			</div>
		 </fieldset>
		 <?php } ?>	
		</div>	
        	
		
	<?php $country_code = isset($data['country_code']) ? explode(',',$data['country_code']) : ((isset($appointmentDetails["patient_detail"]["country_code"])) ? explode(',',$appointmentDetails["patient_detail"]['country_code']) : "" ); ?>	
			
	<?php $m_number = isset($data['m_number']) ? explode(',',$data['m_number']) : ((isset($appointmentDetails["patient_detail"]["m_number"])) ? explode(',',$appointmentDetails["patient_detail"]['m_number']) : "" ); ?>
	
	<div class="col-md-6 col-sm-12">
		 <?php if(empty($data['id']) && empty($appointmentDetails["patient_detail"]["id"])){ ?>			  
   		<fieldset class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-left:0;">
		 <div class="customformwrap">
		   <label class="customLabel">Counrty Code<span class="starClass"> *</span></label>
			<select class="custominput singleselect mandatory" name="country_code[]" id="country_code">
			 <option value="">Select </option>
			<option value="+91" >+91 </option> 
			<option value="+22" >+22 </option> 
			<option value="+34" >+34 </option>                 
			</select>
			<p class="msg1 errorClass1"></p>
			</div>
			</fieldset>	
				
			<fieldset class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding-right: 0;">	
			<div class="customformwrap">
			<label class="customLabel">Mobile Number<span class="starClass"> *</span></label>
			<input type="text" class="custominput inputwith-abbbtn mandatory" name="m_number[]" id="phone" maxlength="10" autocomplete="off">
			<div class="addmoreBtn patinumclick" ><b class="sprite addplusIcon" id="adphn"></b></div>
			<p class="msg1 errorClass1"></p>
			</div>
			</fieldset>	
		 <?php } else { ?>
         <?php $count = sizeof($country_code);
			for($i=0; $i<=$count-1; $i++){ 
			if(!empty($m_number[$i])){ ?>			 
		   <div class="remove_phone">
			<fieldset class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-left:0;">
			<div class="customformwrap">
               <label class="customLabel">Counrty Code</label>
			  	<select class="custominput singleselect" name="country_code[]">
				<option value="+91" <?php echo isset($country_code[$i]) && $country_code[$i]=='+91' ? 'selected' : ((isset($appointmentDetails["patient_detail"][$country_code[$i]])) && $appointmentDetails["patient_detail"][$country_code[$i]]=="+91" ? "selected" : "" ); ?> >+91 </option> 
				<option value="+22" <?php echo isset($country_code[$i]) && $country_code[$i]=='+22' ? 'selected' : ((isset($appointmentDetails["patient_detail"][$country_code[$i]])) && $appointmentDetails["patient_detail"][$country_code[$i]]=="+22" ? "selected" : "" ); ?> >+22 </option> 
                <option value="+34" <?php echo isset($country_code[$i]) && $country_code[$i]=='+34' ? 'selected' : ((isset($appointmentDetails["patient_detail"][$country_code[$i]])) && $appointmentDetails["patient_detail"][$country_code[$i]]=="+34" ? "selected" : "" ); ?> >+34 </option>                 
				</select>
			    </div>		          			
				</fieldset>
				
           <fieldset class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding-right: 0;">	
		  	<div class="customformwrap">
			<label class="customLabel">Mobile Number</label>
			<input type="text" class="custominput inputwith-abbbtn phone1" name="m_number[]" id="phone" value="<?php echo isset($m_number[$i]) ? $m_number[$i] : ((isset($appointmentDetails["patient_detail"][$m_number[$i]])) ? $appointmentDetails["patient_detail"][$m_number[$i]] : "" ); ?>" maxlength="10" autocomplete="off">
		   <div class="<?php echo $m_number[$i]==$m_number[0]? 'addmoreBtn':'addminusBtn'; ?> patinumclick" ><b class="sprite <?php echo $m_number[$i]==$m_number[0]? 'addplusIcon':'minusIcon'; ?>" id="<?php echo $m_number[$i]==$m_number[0]? 'adphn':'remove_phn'; ?>"></b></div>
			<p class="msg4 errorClass1"></p>
			</div>		 	
			</fieldset>				
			</div>
		 <?php } } }?>		
		<div class="addphone"></div>
			</div>
			
			<?php $email = isset($data['email']) ? explode(',',$data['email']) : ((isset($appointmentDetails["patient_detail"]["email"])) ? explode(',',$appointmentDetails["patient_detail"]['email']) : "" ); ?>
			
			<fieldset class="col-sm-6 col-xs-12" id="field_wrapper1">
			<?php if(empty($data['id']) && empty($appointmentDetails["patient_detail"]["id"])){?>
		  	<div class="customformwrap">
            <label class="customLabel">Email Address<span class="starClass"> *</span></label>
			<input type="email" class="custominput inputwith-abbbtn mandatory" name="email[]" id="email" autocomplete="off">
		    <div class="addmoreBtn patiemailclick "><b class="sprite addplusIcon" id="addplusIcon2"></b>
			</div>
			<p class="msg1 errorClass1"></p>
			</div>
			
			<?php } else{	
			$count = sizeof($email);
			for($i=0; $i<=$count-1; $i++){
			if(!empty($email[$i])){ ?>
		  	<div class="customformwrap">
			<label class="customLabel">Email Address</label>
			<input type="email" class="custominput inputwith-abbbtn" name="email[]" id="email" value="<?php echo isset($email[$i]) ? $email[$i] : ""; ?>" autocomplete="off">
			<div class="addmoreBtn patinumclick" ><b class="sprite <?php echo $email[$i]==$email[0]? 'addplusIcon':'minusIcon'; ?>" id="<?php echo $email[$i]==$email[0]? 'addplusIcon2':'remove_button1'; ?>"></b></div>
			</div>
			<?php } } } ?>
		   </fieldset>
	<div class="clearfix"></div>
	
	<?php $allergies = isset($data['allergy']) ? explode(',',$data['allergy']) : ((isset($appointmentDetails["patient_detail"]["allergy"])) ? explode(',',$appointmentDetails["patient_detail"]['allergy']) : "" );
	/* if(isset($allergies) && !empty($allergies)) {
	foreach($allergies as $key=>$value){
	if($key!=0)
	{
		$oldallergy[] = $value;
	} } }
	$allergyName = isset($allergies[0]) && !empty($allergies[0]) ? explode("_",$allergies[0]) : ""; */
	//echo "<pre>"; print_r($allergies);print_r($oldallergy);
	?>
		 <fieldset class="col-sm-6 col-xs-12" >		
		  	<div class="customformwrap">
            <label class="customLabel">Name of Allergy</label>
			
			<textarea name="old_allergy" style="display:none;"><?php echo isset($allergies) ? implode(",",$allergies) : ""; ?></textarea>
			<input type="hidden" class="countAllergyDiv" value="0">
			
			<?php
			if(isset($allergies) && !empty($allergies)) {
			foreach($allergies as $key => $value) {
			$allergyName = explode("_",$value); ?>
			<div class="allergyDiv">
				<div class="inputaddBtn" data-id="<?php echo $key; ?>" >
					<select class="custominput  singleselect allergyData" id="allergyData" name="allergy[]" data-placeholder="Search for allergy">
						<option value="<?php echo $value; ?>" ><?php echo $allergyName[1]; ?></option>
					</select>
				</div><span class="addmoreBtn patinumclick <?php echo $key==0 ? "addAllergy" : "removeAllergy"; ?>" ><b class="sprite <?php echo $key==0 ? "addplusIcon" : "minusIcon"; ?>" ></b></span>
			</div>
			<?php } }
			else { ?>
			<div class="allergyDiv">
				<div class="inputaddBtn">
					<select class="custominput singleselect allergyData" id="allergyData" name="allergy[]" data-placeholder="Search for allergy">
						<option value="">Search Allergy</option>
					</select>
				</div><span class="addmoreBtn patinumclick addAllergy" ><b class="sprite addplusIcon" ></b></span>
			</div>
			<?php } ?>
			
			<div class="appendAllergy"></div>
			</div>
		</fieldset>
			
		    
		<fieldset class="col-sm-6 col-xs-12">		
		  	<div class="customformwrap">
               <label class="customLabel">Conditions</label>
				<?php
				$conditions = isset($data['conditions']) ? explode(",",$data['conditions']) : ((isset($appointmentDetails["patient_detail"]["conditions"])) ? explode(",",$appointmentDetails["patient_detail"]["conditions"]) : "" );
				if(!empty($conditions)) {
				foreach($conditions as $key => $value) { ?>
				<div class="conditionDiv">
			  	<input type="text" class="custominput text-capitalize inputwith-abbbtn" name="conditions[]" value="<?php echo $value; ?>"><span class="addmoreBtn patinumclick <?php echo $key==0 ? "addCondition" : "removeCondition"; ?> " ><b class="sprite <?php echo $key==0 ? "addplusIcon" : "minusIcon"; ?>" ></b></span>
				</div>
				<?php } }
				else { ?>
				<div class="conditionDiv">
			  	<input type="text" class="custominput inputwith-abbbtn" name="conditions[]">
				<span class="addmoreBtn patinumclick addCondition " ><b class="sprite addplusIcon" ></b></span>
				</div>
				<?php } ?>
				<div class="appendCondition"></div>
			</div>
		</fieldset>
		 
		 <input type="hidden" name="remark_id" id="id" value="<?php echo isset($remarkData['id']) ? $remarkData['id'] : ((isset($appointmentDetails["patient_detail"]["id"])) ? $appointmentDetails["patient_detail"]["id"] : "" ); ?>" >
		 <fieldset class="col-sm-6 col-xs-12">
		  	<div class="customformwrap">
               <label class="customLabel">Patient Remark</label>
			   <?php $remarks = isset($remarkData['remarks']) ? explode(",",$remarkData['remarks']) : ((isset($appointmentDetails["patient_detail"]["remarks"])) ? explode(",",$appointmentDetails["patient_detail"]["remarks"]) : "" );
				
				if(!empty($remarks)) {
				foreach($remarks as $key => $value) { ?>
			    <div class="remarkDiv">
			  	<input type="text" class="custominput text-capitalize mandatory" name="patient_remark[]" value="<?php echo $value; ?>" id="patient_remark" autocomplete="off"><span class="addmoreBtn patinumclick <?php echo $key==0 ? "addRemark" : "removeRemark"; ?>"><b class="sprite <?php echo $key==0 ? "addplusIcon" : "minusIcon"; ?>" ></b></span>	
				</div>
				<?php } }
				else { ?>
				<div class="remarkDiv">
			  	<input type="text" class="custominput text-capitalize mandatory" name="patient_remark[]" autocomplete="off">
				<span class="addmoreBtn patinumclick addRemark"><b class="sprite addplusIcon"></b></span>	
				</div>
				<?php } ?>
                <div class="appendRemark"></div>				
			</div>
		 </fieldset>
		 
		  <fieldset class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
		  	<div class="customformwrap">
               <label class="customLabel">Notes</label>
			  	<textarea class="custominput" style="min-height: 60px;" name="notes"><?= isset($data['notes']) ? $data['notes'] : ((isset($appointmentDetails["patient_detail"]["notes"])) ? $appointmentDetails["patient_detail"]["notes"] : "" ); ?></textarea>
				<p class="msg1 errorClass1"></p>
			</div>
		 </fieldset>
		 
	    <fieldset class="address-fieldset col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  	<div class="customformwrap">
               <label class="customLabel">Address<span class="starClass"> *</span></label>
			  	<input type="text" class="custominput text-capitalize mandatory" name="address" value="<?php echo isset($data['address']) ? $data['address'] : ((isset($appointmentDetails["patient_detail"]["address"])) ? $appointmentDetails["patient_detail"]["address"] : "" ); ?>" id="address" autocomplete="off">
				<p class="msg1 errorClass1"></p>
			</div>
		 </fieldset>
	
			  <fieldset class="contryformwrap col-lg-6 col-md-6 col-sm-6 col-xs-12">
			    <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                 <label class="customLabel">Country</label>
                <select class="custominput singleselect " name="country" id="country" value="">
                 <option value="">Select</option>
                 <option value="India" <?php echo isset($data['country']) && $data['country']=='India' ? 'selected' : ((isset($appointmentDetails["patient_detail"]['country'])) && $appointmentDetails["patient_detail"]['country']=="India" ? "selected" : "" ); ?>>India</option>
                 <option value="UK" <?php echo isset($data['country']) && $data['country']=='UK' ? 'selected' : ((isset($appointmentDetails["patient_detail"]['country'])) && $appointmentDetails["patient_detail"]['country']=="UK" ? "selected" : "" ); ?>>UK</option>
                </select>
			   </div>
				  <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12" >
                 <label class="customLabel">State</label>				 
                <select class="custominput singleselect" name="state" id="state" value="">
                  <option value="">Select</option>
                  <option value="Delhi" <?php echo isset($data['state']) && $data['state']=='Delhi' ? 'selected' : ((isset($appointmentDetails["patient_detail"]['state'])) && $appointmentDetails["patient_detail"]['state']=="Delhi" ? "selected" : "" ); ?>>Delhi</option>
                  
                </select>
			   </div>			
			  </fieldset>
			  
			  <fieldset class="contryformwrap col-lg-6 col-md-6 col-sm-6 col-xs-12">
			    <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                 <label class="customLabel">City</label>
                <select class="custominput singleselect" name="city" id="city" value="">
                 <option value="">Select</option>
                  <option value="Delhi" <?php echo isset($data['city']) && $data['city']=='Delhi' ? 'selected' : ((isset($appointmentDetails["patient_detail"]['city'])) && $appointmentDetails["patient_detail"]['city']=="Delhi" ? "selected" : "" ); ?>>Delhi</option>
				 
                </select>
			   </div>
				  <div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
                 <label class="customLabel">Pincode</label>
              	<input type="text" class="custominput"  name="pincode" id="pincode" value="<?php echo isset($data['pincode']) ? $data['pincode'] : ((isset($appointmentDetails["patient_detail"]["pincode"])) ? $appointmentDetails["patient_detail"]["pincode"] : "" ); ?>" autocomplete="off">
			   </div>
			
			  </fieldset>
					 
	  </div>
	  
      <div class="modal-footer text-center clearfix">
        <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
       <button type="submit" class="btn btn-primary text-uppercase" id="submit">Save</button>
      </div>
	   </form>
    </div>
  </div>
  <?= $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']); ?>
  <?= $this->Html->script(['pharmacy/jquery.formatter.min.js']); ?>
<script>
$(document).ready(function () {
	
	$('#birthdateval_patient').formatter({
     'pattern': '{{99}}/{{99}}/{{9999}}'
      });
	
	$('#birthdateval_patient').blur(function() {
	var curtYear = '<?= date('Y') ?>';
	var dobYear = $(this).val();
	var res = dobYear.split("/");
	var diffYear = curtYear-res[2];
	//alert(diffYear);
	if(diffYear < 18){
	$('.gname').remove();
	$('.gcontact').remove();
	$('.grelation').remove();
	$('.appendGuardian').append('<fieldset class="col-lg-4 col-md-4 col-sm-6 col-xs-12 gname"><div class="customformwrap"> <label class="customLabel">Guardian Name<span class="starClass"> *</span></label><input type="text" class="custominput text-capitalize mandatory" name="guardian_name" id="gname" value="<?= isset($data['guardian_name']) ? $data['guardian_name'] : ((isset($appointmentDetails["patient_detail"]["guardian_name"])) ? $appointmentDetails["patient_detail"]["guardian_name"] : "" ); ?>" autocomplete="off"><p class="msg1 errorClass1" maxlength="25"></p></div></fieldset><fieldset class="col-lg-4 col-md-4 col-sm-6 col-xs-12 gcontact"><div class="customformwrap"><label class="customLabel">Contact No.<span class="starClass"> *</span></label><input type="text" class="custominput phone1 mandatory" name="guardian_contact" id="gcontact" value="<?= isset($data['guardian_contact']) ? $data['guardian_contact'] : ((isset($appointmentDetails["patient_detail"]["guardian_contact"])) ? $appointmentDetails["patient_detail"]["guardian_contact"] : "" ); ?>" autocomplete="off" maxlength="10"><p class="msg1 errorClass1"></p></div></fieldset><fieldset class="col-lg-4 col-md-4 col-sm-6 col-xs-12 grelation"><div class="customformwrap"><label class="customLabel">Relation<span class="starClass"> *</span></label><input type="text" class="custominput text-capitalize mandatory" name="relation" id="grelation" value="<?= isset($data['relation']) ? $data['relation'] : ((isset($appointmentDetails["patient_detail"]["relation"])) ? $appointmentDetails["patient_detail"]["relation"] : "" ); ?>" autocomplete="off" maxlength="25"><p class="msg1 errorClass1"></p></div></fieldset>');		
	}
	else { 
	$('.gname').remove();
	$('.gcontact').remove();
	$('.grelation').remove();
	}
	});
	
	$('.clderIconClick').click(function() {
	$('#birthdateval_patient').click();
			});
			
	$('#birthdateval_patient').datetimepicker({
		           useCurrent: false,
                   format: 'DD/MM/YYYY',
		 			//minDate: moment(),
					maxDate: moment(),
		 			useStrict:true,
		 			locale:  moment.locale('en', {
			week: { dow: 1 }
         })
      });
	  
	  var savedDate = '<?php echo isset($data["dob"]) ? $data["dob"] : ""; ?>';
	  if(savedDate!="") {
		$("#birthdateval_patient").val('<?php echo isset($data["dob"]) ? $data["dob"] : ""; ?>');
	}
			
$('#submit').click(function (e) {
	
	$(".mandatory").each(function()
	{
		if($(this).val()=="")
		{
			$(this).next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
			$(this).next().next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
		}
	});
	
	/* if($('.appendGuardian').prop('style','block')){
		return false;
	} */
	
	if($('#fname').val()=="" || $('#lname').val()=="" || $('#phone').val()=="" || $('#email').val()=="" || $('#address').val()=="" || $('#gender').val()=="" || $('#title').val()=="" || $('#birthdateval_patient').val()=="" || $('#country_code').val()=="" || $('#allergy').val()=="" || $('#gname').val()=="" || $('#gcontact').val()=="" || $('#grelation').val()=="")
	{
		return false;
	}
    
});

var maxField = 3;
var fieldHTML ='<div class="remove_phone"><fieldset class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-left: 0;"><div class="customformwrap"><select class="custominput singleselect" name="country_code[]"><option value="">Select</option><option value="+91" >+91 </option><option value="+22" >+22 </option><option value="+34" >+34 </option></select></div></fieldset><fieldset class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding-right: 0;"><div class="customformwrap"><input type="text" class="custominput inputwith-abbbtn phone1" name="m_number[]" id="phone" maxlength="10" autocomplete="off" ><div class="addmoreBtn patinumclick" ><b class="sprite minusIcon" id="remove_phn"></b></div></p></div></fieldset></div>';


     var x = 1;
	 $('#adphn').click(function(){	 
		 if(x < maxField){ 
		  x++;
		  $('.addphone').append(fieldHTML);	 
          $(".singleselect").select2();		  
		   }
	 });  
	 
	 $('body').on('click','#remove_phn',function(e){
        e.preventDefault();
		$(this).closest(".remove_phone").remove();
		 x--;
		 });
	
	var addButton1 = $('#addplusIcon2');
	var wrapper1 = $('#field_wrapper1');
	var fieldHTML1 = '<div class="customformwrap" id="remove1"><label class="customLabel">Email Address</label><input type="text" class="custominput inputwith-abbbtn" name="email[]"><div class="addminusBtn patinumclick" ><b class="sprite minusIcon" id="remove_button1"></b></div></div>';
	var t = 1;
	$(addButton1).click(function(){
		 if(t < maxField){ 
		  t++;
		  $(wrapper1).append(fieldHTML1);
		   }
    });
	 $(wrapper1).on('click', '#remove_button1', function(e){
        e.preventDefault();
		$(this).closest(".customformwrap").remove();
		 t--;
		 });

 $('#phone').keypress(function (event){
  var keycode = event.which;
    if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});

$("body").on("keypress",".phone1",function(event){
  var keycode = event.which;
    if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});


var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;

var timeout;
var delay = 1000;
var isLoading = false;
$('body').on('keyup','.allergyData input.select2-search__field',function()
{
	if(timeout)
    clearTimeout(timeout);
	reloadAllergy();
});

function reloadAllergy()
{
    if(!isLoading)
    {             
        timeout = setTimeout(function() {
			
		var count = $(".allergyData input.select2-search__field").val().length;
	
		var url = window.location.href;
		
		if(count>2)
		{
			if(url.indexOf('www') != -1) {
			$.ajax({
				url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
				type: "POST",
				data: {'value' : $(".allergyData input.select2-search__field").val() , 'type' : 'allergies'},
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				success: function(data)
				{
					if($(".countAllergyDiv").val()=="" || $(".countAllergyDiv").val()==0)
					{
						$("#allergyData").html("");
					}
					else
					{
						$("#allergyData_"+$(".countAllergyDiv").val()).html("");
					}
					var obj = $.parseJSON(data);
					jQuery.each(obj, function(i, val)
					{
						var value = val.id+"_"+val.name;
						if($(".countAllergyDiv").val()=="" || $(".countAllergyDiv").val()==0)
						{
							$("#allergyData").append('<option value="'+value+'">'+val.name+'</option>');
						}
						else
						{
							$("#allergyData_"+$(".countAllergyDiv").val()).append('<option value="'+value+'">'+val.name+'</option>');
						}
						
					});
				}
			});
			}
			else {
			$.ajax({
				url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
				type: "POST",
				data: {'value' : $(".allergyData input.select2-search__field").val() , 'type' : 'allergies'},
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				success: function(data)
				{
					if($(".countAllergyDiv").val()=="" || $(".countAllergyDiv").val()==0)
					{
						$("#allergyData").html("");
					}
					else
					{
						$("#allergyData_"+$(".countAllergyDiv").val()).html("");
					}
					var obj = $.parseJSON(data);
					jQuery.each(obj, function(i, val)
					{
						var value = val.id+"_"+val.name;
						if($(".countAllergyDiv").val()=="" || $(".countAllergyDiv").val()==0)
						{
							$("#allergyData").append('<option value="'+value+'">'+val.name+'</option>');
						}
						else
						{
							$("#allergyData_"+$(".countAllergyDiv").val()).append('<option value="'+value+'">'+val.name+'</option>');
						}
					});
				}
			});
			}
		}
		if(count==0)
		{
			if($(".countAllergyDiv").val()=="" || $(".countAllergyDiv").val()==0)
			{
				$("#allergyData").html('<option value="">Select Allergy</option>');
			}
			else
			{
				$("#allergyData_"+$(".countAllergyDiv").val()).html('<option value="">Select Allergy</option>');
			}
		}
		
		setTimeout(function() { isLoading = false; }, delay);
        }, delay);
    }
}

$('body').on('click','.inputaddBtn',function()
{
	$(".countAllergyDiv").val($(this).attr("data-id"));
});

$('body').on('click','.addAllergy',function()
{
	var countClass = $('.removeAllergy').length+1;
	$(".appendAllergy").append('<div class="allergyDiv"><div class="inputaddBtn" data-id="'+countClass+'"><select class="custominput singleselect_'+countClass+' allergyData" id="allergyData_'+countClass+'" data-id="'+countClass+'" name="allergy[]" data-placeholder="Search for allergy"><option value="">Search Allergy</option></select></div><span class="addmoreBtn patinumclick removeAllergy" ><b class="sprite minusIcon" ></b></span></div>');
	$(".singleselect_"+countClass).select2();
});
$('body').on('click','.removeAllergy',function()
{
	$(this).closest(".allergyDiv").remove();
});

$('body').on('click','.addCondition',function()
{
	$(".appendCondition").append('<div class="conditionDiv"><input type="text" class="custominput inputwith-abbbtn" name="conditions[]"><span class="addmoreBtn patinumclick removeCondition" ><b class="sprite minusIcon" ></b></span></div>');
});

$('body').on('click','.removeCondition',function()
{
	$(this).closest(".conditionDiv").remove();
});

$('body').on('click','.addRemark',function()
{
	$(".appendRemark").append('<div class="remarkDiv"><input type="text" class="custominput" name="patient_remark[]" autocomplete="off"><span class="addmoreBtn patinumclick removeRemark" ><b class="sprite minusIcon" ></b></span></div>');
});

$('body').on('click','.removeRemark',function()
{
	$(this).closest(".remarkDiv").remove();
});
      
});
</script>