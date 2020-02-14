<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pharmacy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
   
    </head>
	<?php echo $this->Html->css(['pharmacy/pharmacy','pharmacy/bootstrap.min']);
	  echo $this->Html->script(['pharmacy/jquery3.2.1.js','pharmacy/bootstrap.min.js']);?>

<body>
   <!-- HEADER -->
   <?php //echo $this->element("left_panel"); ?>
   
    
    <div class="main-body">
                <div class="bannerWrap">
                <div class="bannerImage"><img src="<?php echo $this->request->webroot.'img/doctor/login-banner.jpg'; ?>" alt="#" /></div>
                 <!-- LOGIN HEADING -->
                <div class="loginArea">
			
					<div class="signTitle">
					<h1>Welcome<h2>
					
                <a href="<?php echo $this->url->build(["controller" => "login","action" => "logout"]); ?>"> <button type="submit" class="defaultBtn btn-md">Logout</button></a></br>
                  <?php $ff=$this->request->session()->read('login');	
				    print_r($ff);  					 					 
					 ?>
					</div>
                   
                </div>
                </div>
                </div>
         
</body>

</html>