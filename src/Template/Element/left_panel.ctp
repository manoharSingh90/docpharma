<div class="menutoggle"> <span></span> </div>
<h1 class="logosite"><a href="#"><img class="headerlogoImg" src="<?php echo PATH."img/doctor/logo.png" ?>" alt="Pharmacy" /></a>Pharmacy</h1>
<div class="userDetail"> <a href="#" class="active"><b><img src="<?php echo PATH."img/doctor/profile.png" ?>" alt="#" /></b>
		<p><?php echo isset($name["first_name"]) ? $name["first_name"]." ".$name["middle_name"]." ".$name["last_name"] : "Admin"; ?></p>
	</a> </div>
	<?php $users_id = $this->request->getSession()->read('users_id');
	   $role_id = $this->request->getSession()->read('role_id'); ?>
	   
<div class="collapse navbar-collapse nav-pills-with-dropdown customHeader" id="navbarToggle">
	<ul class="nav nav-pills">
	<?php if($role_id==1 ||$role_id==2){ 
	if($role_id==1){?>
	<li><a href="<?php echo $this->Url->build(["controller"=>"Doctor","action"=>"listing"]); ?>" title="Doctor" class="<?php echo $this->request->getParam('controller')== "Doctor" ? "active" : ""; ?>">Doctor</a></li><?php } ?>
		<li><a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" title="Appointments" class="<?php echo $this->request->getParam('controller')== "Appointment" ? "active" : ""; ?>">Appointments</a></li>
		<li><a href="<?php echo $this->Url->build(["controller"=>"Patient","action"=>"index"]); ?>" title="Patients" class="<?php echo $this->request->getParam('controller')== "Patient" ? "active" : ""; ?>">Patients</a></li>
		<li><a href="<?php echo $this->Url->build(["controller"=>"Blackout","action"=>"index"]); ?>" title="Blackout Dates">Blackout Dates</a></li>
		<li><a href="<?php echo $this->Url->build(["controller"=>"Appointmentcancellation","action"=>"index"]); ?>" title="Bulk Cancellations">Bulk Cancellations</a></li>
		<?php if($role_id==1){?>
		<li><a href="<?php echo $this->Url->build(["controller"=>"executive","action"=>"index"]); ?>" title="Executive Assistants">Executive Assistants</a></li><?php } ?>
		<li><a href="<?php echo $this->Url->build(["controller"=>"Report","action"=>"details"]); ?>" title="Reports">Reports</a></li>
		
	<?php }elseif($role_id==3){?>
	<li><a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" title="#">Appointments</a></li>
	<li><a href="<?php echo $this->Url->build(["controller"=>"Report","action"=>"details"]); ?>" title="Reports">Reports</a></li><?php }
	
	else if($role_id==4)
	{ ?>
		<li><a href="<?php echo $this->Url->build(["controller"=>"Pharmacy","action"=>"listing"]); ?>">Billing</a></li>
		<li><a href="<?php echo $this->Url->build(["controller"=>"Patient","action"=>"index"]); ?>" title="Customers" class="<?php echo $this->request->getParam('controller')== "Patient" ? "active" : ""; ?>">Customers</a></li>
		<li><a href="<?php echo $this->Url->build(["controller"=>"inventory","action"=>"index"]); ?>" title="Patients" class="">Product Inventory</a></li>
		<li><a href="<?php echo $this->Url->build(["controller"=>"Report","action"=>"details"]); ?>" title="Patients" class="">Reports</a></li>
	<?php } ?>
		<li><a href="<?php echo $this->Url->build(["controller"=>"Abbreviation","action"=>"listing"]); ?>" title="Settings">Settings</a></li>
	</ul>
</div>
<div class="logoutWrap"><a href="<?php echo $this->Url->build(["controller" => "login","action" => "logout"]); ?>" class="logout"><b><img src="<?php echo PATH."img/doctor/logout.png" ?>" alt="#" /></b></a></div>
