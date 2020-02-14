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
								<a href="<?php echo $this->url->build(["controller"=>"Abbreviation","action"=>"listing"]); ?>"><img src="<?php echo PATH."img/doctor/back-arrow.png" ?>" alt="#" /> Back</a>
							</div>
							<b><img src="<?php echo PATH."img/doctor/user-icon.png" ?>" alt="#" /></b> <span><?php echo isset($data["id"]) ? "Edit" : "Create"; ?> Abbreviation</span>
						</div>
					</li>
				</ul>
			</div>
		</div>
		
		<form method="post" action="<?php echo $this->url->build(["controller"=>"Abbreviation", "action"=>"save"]); ?>" enctype="multipart/form-data">
		
		<input type="hidden" class="id" name="id" value="<?php echo isset($data["id"]) ? $data["id"] : ""; ?>">
		
		<input type="hidden" name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
		
		<div class="container">
			<div class="doctorWrap">
				<div class="userViewwrap">
					<div class="row">
						<div class="col-xs-12 col-sm-2 col-md-4"></div>
						
						<div class="col-xs-12 col-sm-8 col-md-4">
							<ul class="clearfix userViewlist">
								<li>
									<div class="customformwrap">
										<label class="customLabel">Abbreviation<span class="starClass"> *</span></label>
										<input autocomplete="off" type="text" class="custominput mandatory" name="abbreviation" value="<?php echo isset($data["abbreviation"]) ? $data["abbreviation"] : ""; ?>" />
										<span class="errorClass abbreviationErrorClass">Field Required</span>
									</div>
								</li>
								<li>
									<div class="customformwrap">
										<label class="customLabel">Meaning<span class="starClass"> *</span></label>
										<textarea class="mandatory custominput" name="meaning"><?php echo isset($data["meaning"]) ? $data["meaning"] : ""; ?></textarea>
										<span class="errorClass meaningErrorClass">Field Required</span>
									</div>
								</li>
								<li>
									<div class="customformwrap text-right">
										<input type="submit" class="btn btn-primary submit checkValidation" value="SAVE">
									</div>
								</li>
							</ul>
						</div>
						
						<div class="col-xs-12 col-sm-2 col-md-4"></div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>

	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->

<script type="text/javascript">

$(".mandatory").blur(function()
{
	$(this).next(".errorClass").css("display","none");
});

$(".checkValidation").click(function()
{
	$(".mandatory").each(function()
	{
		if($(this).val()=="")
		{
			$(this).next(".errorClass").css("display","block");
		}
		else
		{
			$(this).next(".errorClass").css("display","none");
		}
	});
	
	if($('.abbreviationErrorClass').css('display')=='block' || $('.meaningErrorClass').css('display')=='block')
	{
		return false;
	}
});
</script>