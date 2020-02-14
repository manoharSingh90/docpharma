 
<?php
echo $this->Html->css(['pharmacy/pharmacy','pharmacy/bootstrap.min']);
?>

    <div class="navbar">
        <div class="container">
            <h1 class="logosite">
                <a href="<?php echo $this->Url->build(["controller" => "login","action" => "login"]); ?>">
				<img class="headerlogoImg" src="<?php echo $this->request->getAttribute("webroot").'img/doctor/login_logo.png'; ?>" alt="Pharmacy" /></a>Pharmacy</h1>
           <div class="headerlogo navbar-header">
				<div type="button" class="navbar-toggle"> <div class="menutoggle"><span></span></div> </div>
			</div>
            <div class="collapse navbar-collapse nav-pills-with-dropdown customHeader" id="navbarToggle">
                <ul class="nav nav-pills">
                    <li><a href="javascript:void(0)" title="Home">Home</a></li>
                    <li><a href="javascript:void(0)" title="What We Offer">What We Offer</a></li>
                    <li><a href="javascript:void(0)" title="About Us">About Us</a></li>
                  <li><a href="javascript:void(0)" title="Testimonials">Testimonials</a></li>
                    <li><a href="javascript:void(0)" title="Contact Us">Contact Us</a></li>
						<li class="mobilenav"> <a href="index.html">Login</a></li>
					<li class="mobilenav"><a href="signup.html">Sign Up</a></li>
                </ul>
            </div>
            
            <!-- SIGN IN WRAP -->
            <div class="loginControl pull-right dsknav"> <a href="javascript:void(0)">Login</a> <a href="javascript:void(0)" class="active">Sign Up</a> </div>
        </div>
        </div>
    
	
    <div class="main-body">
                <div class="bannerWrap">
                <div class="bannerImage"><img src="<?php echo $this->request->getAttribute("webroot").'img/doctor/login-banner.jpg'; ?>" alt="#" /></div>
                 <!-- LOGIN HEADING -->
                <div class="loginArea">
					<div class="signTitle">
                <h2 class="sameHead loginHead">Login</h2>
				<p class="registeresHead">Registered Email Address &amp; Password</p>
				</div>
			
			 <form id="signinForm" role="form"  method="post" action="<?php echo $this->Url->build(["controller" => "login","action" => "login"]); ?>">
			
			<div class="loginFormArea">
			<p id="msg3"><?= $this->Flash->render('flash', ['element' => 'error']); ?>  </p>			
			<div class="loginForm">
				<h4 class="sameHead">Login Credentials</h4>
					<div class="inputWrap">
					<label>Email</label>
					<input type="hidden"  name="_csrfToken" value="<?php echo $this->request->getParam("_csrfToken"); ?>">
					<input autocomplete="off" type="email" class="inputfield" name="email" id="emails">
					<p id="msg1"></p>					
					</div>
					<div class="inputWrap">
					<label>Password</label>
					<input type="password" class="inputfield" name="password" id="passwords" autocomplete="off">
					<p id="msg2"></p>					
					</div>
					
					<a href="javascript:void(0)" class="forgotbox">FORGOT PASSWORD</a>
					</div>
                     <button type="submit" class="defaultBtn btn-md submit">Login</button>
                    </div>
					</form>
                </div>
                </div>
         <!-- CONTACT US -->
        <div class="contactformwraper">
            <div class="container">
                <div class="row">
                    <div class="centerAlign">
                        <h2 class="sameHead">Contact Us</h2> </div> <span class="colltext">Call or write to us for any assistance.</span>
                    <ul class="contactfield">
                        <li class="col-lg-4 col-md-4 col-sm-12 col-lg-offset-1">
                            <div class="inputWrap">
                                <input type="email" class="inputfield" placeholder="EMAIL"> </div>
                        </li>
                        <li class="col-lg-4 col-md-4 col-sm-12">
                            <div class="inputWrap">
                                <input type="number" class="inputfield" placeholder="PHONE"> </div>
                        </li>
                        <li class="col-lg-2 col-md-4 col-sm-12">
                            <div class="inputWrap">
                                <button>Submit</button>
                            </div>
                        </li>
                    </ul>
                </div>
               
            </div>
        </div>
			<div class="contactform"> 
			<span><b><i class="sprite callIcon"></i></b>1800 - 2193 - 3123</span> 
			<span><b><i class="sprite msgIcon"></i></b><a href="mailto:info@pharmacy.com">info@pharmacy.com</a></span> </div>
      <!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
    </div>
  <script type="text/javascript">
	$(document).ready(function() {			  
		$(".submit").click(function() {
		var email =  $('#emails').val();
		var password =  $('#passwords').val();
		if(email.length == 0){
		 $('#msg1').text('*Field is required').fadeIn('slow').delay(2200).fadeOut();
		 return false;
		}
		if(password.length == 0){
		 $('#msg2').text('*Field is required').fadeIn('slow').delay(2200).fadeOut();
		 return false;
		}				
		 /*var inv = '<?php echo $this->Flash->render('flash', ['element' => 'error']); ?>';		 
		alert(inv);		 
		 if(inv){
		 alert(inv);
		$('#msg3').append(inv);
		 }*/
		});
      	
			

$('.navbar-toggle').click(function(){
	$('.customHeader').slideToggle();
});

		 
			
        });
    </script>
