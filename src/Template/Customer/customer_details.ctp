<?php echo $this->Html->css(['pharmacy/after_pharmacy','pharmacy/jquery.modal.css']);echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.js','pharmacy/jquery.modal.min.js']); ?>
<div class="main-wraper">
  <div class="container">
    <div class="row">
      <ul class="customHeadWrap">
        <li class="col-md-6 col-sm-12">
          <div class="customHead"> <b><i class="sprite customerIcon"></i></b> <span>Customer Details</span> </div>
        </li>
        <li class="col-md-6 col-sm-12 text-right"> <a href="customerdetails_pmr.html" class="btn btn-secondary text-uppercase">View PMR</a> <a href="<?php echo $this->Url->build(["controller" => "customer","action" => "createCustomer",$data['id']]); ?>" class="btn btn-secondary text-uppercase editcustomer">Edit Customer</a> </li>
      </ul>
    </div>
  </div>  <?php $email=explode(',',$data['email']); $phone=explode(',',$data['phone']); $phone_code=explode(',',$data['phone_code']); ?>
  <div class="container">
    <div class="customerlistWrap">
      <ul class="clearfix userView">
        <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="customformwrap">
            <label class="customLabel">Customer Name</label>
           <p class="slt-viewlist"><?php echo $data['title'];?>&nbsp;<?php echo $data['first_name'];?>&nbsp;<?php echo $data['last_name'];?></p>
          </div>
        </li>
        <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="customformwrap">
            <label class="customLabel">Email</label>
            <p class="slt-viewlist"><?php foreach($email as $emails){ echo $emails;  echo ' '; } ?></p>
          </div>
        </li>
        <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="customformwrap">
            <label class="customLabel">Phone Number</label>
            <p class="slt-viewlist"><?php foreach($phone_code as $phone_codes){  echo $phone_codes; }?>&nbsp;<?php foreach($phone as $phones){ echo $phones; echo ' '; }?></p>
          </div>
        </li>
        <li class="col-lg-3 col-md-2 col-sm-6 col-xs-12">
          <div class="customformwrap">
            <label class="customLabel">Gender</label>
            <p class="slt-viewlist"><?php echo $data['gender'];?></p>
          </div>
        </li>
        <li class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="customformwrap">
            <label class="customLabel">Date Of Birth</label>
            <p class="slt-viewlist"><?php echo $data['dob'];?></p>
          </div>
        </li>
        <li class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="customformwrap">
            <label class="customLabel">ADDRESS</label>
            <p class="slt-viewlist"><?php echo $data['address'];?>, <?php echo $data['city'];?>, <?php echo $data['state'];?> <?php echo $data['pincode'];?>, <?php echo $data['country'];?></p>
          </div>
        </li>
      </ul>
      <hr>	  <?php $allergies = explode(',',$data['allergies']); $conditions = explode(',',$data['conditions']); $other_allergies = explode(',',$data['other_allergies']); $other_conditions = explode(',',$data['other_conditions']);?> 
      <div class="viewallergiesWrap ">
        <div class="addorderbody">
          <h3>ALLERGIES</h3>		 
          <div class="addorderarea">		  
            <div class="selectprolist"> <?php if (! empty($allergies)) {           foreach ($allergies as $aller) { ?><span><?php echo $aller; ?></span><?php } } ?>		   <?php if (! empty($other_allergies)) {           foreach ($other_allergies as $other_aller) { ?><span><?php echo $other_aller; ?></span><?php } } ?></div>
          </div>
        </div>
        <hr>
        <div class="addorderbody">
          <h3>CONDITIONS</h3>
          <div class="addorderarea">
            <div class="selectprolist"><?php if (! empty($conditions)) {           foreach ($conditions as $cond) { ?><span><?php echo $cond; ?></span><?php } } ?>		   <?php if (! empty($other_conditions)) {           foreach ($other_conditions as $other_con) { ?><span><?php echo $other_con; ?></span><?php } } ?></div>
          </div>
          <div class="centerAlign"> <a href="<?php echo $this->url->build(["controller" => "customer","action" => "index"]); ?>" class="btn btn-default text-uppercase">Back</a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- FOOTER -->
<script type="text/javascript">
	$(document).ready(function () {
		$('.customerTable').DataTable({
			responsive: true,
			info: false,
			paging: false,
			searching: false,
			ordering: false
		});

		$('.menutoggle').click(function () {
			$(this).toggleClass('active');
			$('header').toggleClass('active');
		});

		$('.chkValue').keyup(function () {
			if ($(this).val().length == 0) {
				$(this).parents('.customformwrap').find('.addprod').removeClass('active');
			}
			else {
				$(this).parents('.customformwrap').find('.addprod').addClass('active');
			}
		});

		// EDIT CLICK
		$('.editclickevent').click(function () {
			$(this).parents('li').find('input, select').removeAttr('disabled');
			$(this).remove();
		});

	});
</script>
</body>
</html>