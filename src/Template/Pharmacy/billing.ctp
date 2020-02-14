
<?php
//echo $this->Html->css(['pharmacy/after_pharmacy']);
echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.js','pharmacy/bootstrap-datetimepicker.min-date.js','pharmacy/bootstrap-multiselect.js']);
?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>


<body>

	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
<div class="main-wraper clearfix">

	<div class="container">
		<div>
			<ul class="customHeadWrap row">
				<li class="col-md-6 col-sm-12">
					<a href="<?php echo $this->url->build(["controller"=>"Pharmacy","action"=>"listing"]); ?>" class="text-uppercase backLink"><i class="sprite backIcon"></i> Back</a>
					<div class="customHead">
						<b><i class="sprite billingIcon"></i></b>
						<span>Billing</span>
					</div>
				</li>
				<li class="col-md-6 col-sm-12">
					<a class="pull-right btn btn-secondary text-uppercase" href="#" data-toggle="modal" data-target="#createpatient-Modal">Create new patient</a>
				</li>
			</ul>
		</div>
	</div>

<div class="container">
	<div class="row">
	
	<form method="post" action="<?php echo $this->Url->build(["controller"=>"Pharmacy", "action"=>"saveprescription"]); ?>" enctype="multipart/form-data" id="formData">
	
	<input type="hidden" name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
	
	<!-- CUSTOMER DIV RIGHT -->
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-right">
		<div class="combgcolor deliverypickupWrap active clearfix">
			<div class="clearfix">
				<h3 class="toggletitleLabel" id="toggletitleLabel">Customer<span class="starClass"> *</span></h3>
					<div class="customformwrap">
						<select class="custominput singleselect selectPatient patient_id" name="patient_id">
							<option value="">Select Patient</option>
							<?php
							if(isset($patientData) && !empty($patientData)) {
							foreach($patientData as $key => $value) { ?>
								<option value="<?php echo $value["id"]; ?>"><?php echo $value["title"]." ".$value["fname"]." ".$value["mname"]." ".$value["lname"]; ?> | <?php echo $value["m_number"]; ?></option>
							<?php } } ?>
						</select>
						<span class="errorClass patientErrorClass">Field Required</span>
					</div>

					<div class="deliveryToggle">
						<ul class="customerdetails" style="display:none;">
							<li>Age : <span class="patientAge"></span><small class="patientGender"></small></li>
						</ul>

						<div class="usermoreOpction viewRemarksDiv" style="display:none;">
							<a href="#" class="viewmodalclick" data-toggle="modal" data-target="#viewdetails-Modal">View Details</a>
							<a href="javascript:void(0);" class="remarkClick1" data-toggle="modal" data-target="#addRemarks">Remarks</a>
						</div>
					</div>
			</div>

			<div class="clearfix">
				<div class="deliveryToggle">
					<div class="prescribingRow clearfix">
						<div class="customformwrap clearfix">
							<label class="customLabel">PRESCRIBING DOCTOR<span class="starClass"> *</span></label>
							<select id="tags" class="custominput singleselect doctor_id" name="doctor_id">
								<option value="">Select Doctor</option>
								<?php
								if(isset($doctorData) && !empty($doctorData)) {
								foreach($doctorData as $key => $value) { ?>
									<option value="<?php echo $value["id"]; ?>"><?php echo $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"]; ?></option>
								<?php } } ?>
							</select>
							<span class="errorClass doctorErrorClass">Field Required</span>
						</div>
					</div>
				</div>
			</div>
        </div>
	</div>
	<!-- CUSTOMER DIV RIGHT -->
	<!-- VIEW DETAILS MODAL -->
	<div id="viewdetails-Modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" >
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
											<label class="customLabel">FULL NAME</label>
											<p class="fullName"></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Phone Number</label>
											<p class="phoneNumber"></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">AGE (DATE OF BIRTH)</label>
											<p class="age"></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Email</label>
											<p class="email"></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Address</label>
											<p class="address"></p>
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
						<!--<button type="button" class="btn btn-primary text-uppercase" data-toggle="modal" data-target="#createpatient-Modal">Edit</button>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-left">
		<div class="combgcolor selecttransparent">
			<div class="repeatDosageWrap">
				<div class="dosageTitle clearfix">PRODUCTS &amp; DOSAGE
					<div class="countProduct">1</div>
					<div class="toggleproduct  pull-right"><span></span></div>
				</div>
			
			<div class="prescriptionLeftDiv">
				<?php echo $this->element("Pharmacy/prescription_left_details"); ?>
			</div>

		</div>
			
			<!--<div class="linedefaultbtn repeatproduct"> <span>ADD ANOTHER PRODUCT</span></div>-->

        </div>
		
	</div>


	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="combgcolor deliverypickupWrap active clearfix">
			<div class=" plaseselect ">
				<h3 class="toggletitleLabel" id="toggletitleLabel1">Delivery / Pickup</h3>
				<div class="deliveryToggle">
				
					<div class="plaseselectArea clearfix">
						<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding0">
							<div class="customradio">
								<label>
								<b></b><span class="address"></span>
								</label>
							</div>
							<div class=""></div>
						</li>
					</div>
					
					<!--<div class="customformwrap clearfix">
						<select class="custominput singleselect" id="pickupAdd">
							<option selected>Delivery</option>
							<option>Pickup</option>
						</select>
					</div>
					
					<div class="plaseselectArea clearfix">
						<p>ADDRESS DETAILS (Please select the delivery address)</p>
						<ul>
							<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding0">
								<div class="customradio">
									<label>
									<input type="radio" checked name="gender">
									<b></b><span>B-44, SECTOR 60</span> <span>NOIDA, U.P.</span> <span>301201<small>(Default)</small></span>
									</label>
								</div>
								<div class=""></div>
							</li>

							<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding0">
								<div class="customradio">
									<label>
									<input type="radio" name="gender">
									<b></b> <span>TOWER 2, 1201</span> <span>VIPUL GREENS,</span> <span>SOHNA ROAD,</span> <span>GURGAON</span> <span>122004</span>
									</label>
								</div>
							</li>
						</ul>

						<span class="addAddress addresClick">ADD NEW ADDRESS</span>
					</div>-->
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="prescriptionRightDiv">
			<?php echo $this->element("Pharmacy/prescription_right_details"); ?>
		</div>
	</div>

		</form>
		</div>
	
	</div>

</div>

	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->

<!---- POPUP  ------>

<div id="createpatient-Modal" class="modal fade" role="dialog">
	<?php echo $this->element("Patient/create_patient"); ?>
</div>
	

<div class="modal modalpopup confirmpop" id="addnewaddress" style="display:none;" data-backdrop="static" data-keyboard="false">

  <div class="modalpopup-container medium-modal">

    <div class="modalpopup-header">

      <h2 class="modalpopup-title">ADD NEW ADDRESS</h2>

      <a href="#" class="closeClick" rel="modal:close">&times;</a></div>

    <div class="modalpopup-content">

      <ul class=" clearfix">

        <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

          <div class="mapwrap"> <span>(Drag and drop the pin at your location)</span>

            <div id="myMap"></div>

          </div>

        </li>

        <li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

          <div class="addressPopup">

            <div class="customformwrap">

              <label class="customLabel">Address</label>

              <input id="address" type="text" class="custominput" value="B-44 Sector 60 Noida" />

              <div class="editbtnOpt editclickevent">Edit</div>

            </div>

            <div class="inputWrapRow">

              <div class="customformwrap">

                <input type="text" id="latitude" placeholder="Latitude" class="custominput" />

              </div>

              <div class="customformwrap">

                <input type="text" id="longitude" placeholder="Longitude" class="custominput" />

              </div>

            </div>

            <ul class="citypin">

              <li>

                <div class="customformwrap">

                  <label class="customLabel">Country</label>

                  <select class="custominput singleselect ">

                    <option>Delhi</option>

                    <option>Noida</option>

                  </select>

                </div>

              </li>

              <li>

                <div class="customformwrap">

                  <label class="customLabel">State</label>

                  <select class="custominput singleselect ">

                    <option>Delhi</option>

                    <option>Noida</option>

                  </select>

                </div>

              </li>

              <li>

                <div class="customformwrap">

                  <label class="customLabel">City</label>

                  <select class="custominput singleselect ">

                    <option>Delhi</option>

                    <option>Noida</option>

                  </select>

                </div>

              </li>

              <li>

                <div class="customformwrap">

                  <label class="customLabel">Pincode</label>

                  <input id="address" type="text" class="custominput" value="110032" />

                </div>

              </li>

            </ul>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">

              <div class="customformwrap">

                <label class="customLabel">Mobile Nember</label>

                <input type="number" class="custominput" value="9658748547" />

                <div class="editbtnOpt editclickevent">Change</div>

              </div>

            </div>

          </div>

        </li>

      </ul>

    </div>

    <div class="modalpopup-footer">

      <div class="centerAlign"> <a href="" class="defaultBtn">Cancel</a> <a href="" class="defaultBtn belu">Add</a> </div>

    </div>

  </div>

</div>

<!---- DELETE POPUP  ------>

<div class="modal modalpopup deletemodal" id="deleteModal" style="display:none;" data-backdrop="static" data-keyboard="false">

  <div class="modalpopup-container small-modal">

    <div class="modalpopup-header">

      <h2 class="modalpopup-title">Delete confirm</h2>

      <a href="#" class="closeClick" rel="modal:close">&times;</a></div>

    <div class="modalpopup-content">

      <div class="deletecontent text-center"> Are you sure want to delete this. </div>

    </div>

    <div class="modalpopup-footer">

      <div class="centerAlign"> <a href="" class="defaultBtn">Cancel</a> <a href="" class="defaultBtn belu">Yes</a> </div>

    </div>

  </div>

</div>


<!---- GENERICS POPUP  ------>

<div class="modal modalpopup genericmpdal" id="remarkpopup" style="display:none;" data-backdrop="static" data-keyboard="false">

  <div class="modalpopup-container modal-md">

    <div class="modalpopup-header">

      <h2 class="modalpopup-title">Generics</h2>

      <a href="#" class="closeClick" rel="modal:close">&times;</a></div>

    <div class="modalpopup-content">

      <div class="genericsWrap">

        <div class="row">

          <ul class="generic_wrap">

            <li class="clearfix">

              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                <div class="customformwrap">

                  <label class="customLabel">PRODUCT NAME</label>

                  <input type="text" class="custominput" value="Alegra 125 MG">

                  <small class="outstock">(Out Of Stock)</small> </div>

              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                <div class="usermoreOpction  centerAlign"> <a href="javascript:void(0);">Place Order</a></div>

              </div>

            </li>

            <li class="clearfix">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="customformwrap">

                  <label class="customLabel">SALT INFORMATION</label>

                  <p>Fexofenadine (180 Mg), Sulfate (4%)</p>

                </div>

              </div>

            </li>

            <li class="clearfix">

              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="customformwrap">

                  <label class="customLabel">SUBSTITUE PRODUCTS</label>

                  <p><small>The following medicines may be used as a substitute. Please select any from the inventory:</small></p>

                </div>

              </div>

            </li>

            <li class="clearfix">

              <div class="modalgenerics">

                <div class="customradio">

                  <label>

                    <input type="radio" name="gender">

                    <b></b> <span>HISTAFREE 180 MG</span> <small> (Mankind Pharma Ltd - Rs. 143)</small></label>

                </div>

              </div>

              <div class="modalgenerics">

                <div class="customradio">

                  <label>

                    <input type="radio" name="gender">

                    <b></b> <span>FEXOVA 180 MG</span> <small> (Ipca Laboratories Ltd - Rs. 156)</small></label>

                </div>

              </div>

              <div class="modalgenerics">

                <div class="customradio">

                  <label>

                    <input type="radio" name="gender">

                    <b></b> <span>HISTAFREE 180 MG</span> <small> (Mankind Pharma Ltd - Rs. 143)</small></label>

                </div>

              </div>

            </li>

          </ul>

        </div>

      </div>

    </div>

    <div class="modalpopup-footer">

      <div class="centerAlign"> <a href="" class="defaultBtn">Cancel</a> <a href="" class="defaultBtn belu">Done</a> </div>

    </div>

  </div>

</div>


<!---- REMARK POPUP  ------>
<div id="addRemarks" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg modalpopup" style="max-width:500px;">
    <div class="modal-content modalpopup-container">
		<div class="modal-header text-center modalpopup-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h2 class="modalpopup-title modalpopup-title">Customer Remarks</h2>
		</div>
		<div class="modal-body clearfix">
			<div class="remarkarea">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
					<textarea class="customtexrarea patientRemarks"></textarea>
					<div class="centerAlign"> <span class="defaultBtn belu addPatientRemarks">Add</span></div>
				</div>
			</div>
			<hr/>
			<div class="previewRemark clearfix savedPatientRemarks" style="display:none;">
				<div class="customformwrap clearfix">
					<div class="customLabel">Preview Remarks</div>
				</div>
				<ul class="remarksData">
				</ul>
			</div>
		</div>
	</div>
	</div>
</div>


<!---- ORDER FORM POPUP  ------>
<div id="addOrderDiv" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg modalpopup" style="max-width:500px;">
    <div class="modal-content modalpopup-container">
		<div class="modal-header text-center modalpopup-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h2 class="modalpopup-title modalpopup-title">Add to Order Form</h2>
		</div>
		<input type="hidden" class="orderproductGUID">
		<div class="modal-body clearfix">
			<div class="directOrder">
				<div class="row">
					<div class="col-sm-12 col-md-2"></div>
					<div class="col-sm-12 col-md-8">
						<div class="pt-2 previousOrderNameDiv">
							<small class="text-muted" style="padding-top:.75rem; padding-right:.5rem;">Order Name</small>
							<select class="custominput singleselect savedOrderName">
								<option value="">Select</option>
								<?php
								if(isset($orderFormData) && !empty($orderFormData)) {
								foreach($orderFormData as $orderKey => $orderValue) { ?>
								<option value="<?php echo $orderValue["id"]; ?>"><?php echo $orderValue["order_name"]; ?></option>
								<?php } } ?>
							</select>
						</div>
						
						<div class="pt-2 newOrderNameDiv" style="display:none;">
							<small class="text-muted" style="padding-top:.75rem; padding-right:.5rem;">Order Name</small>
							<input type="text" class="form-control width100 newOrderName">
						</div>
						
						<div class="pb-2 text-right">
							<a href="#" class="text-primary createNewOrder"><small>+Create New Order Form</small></a>
							<a href="#" class="text-primary previousOrder" style="display:none;"><small>+Previous Order Form</small></a>
						</div>
						
						<p class="orderProductName mb-0"></p>
						
						<div class="pt-2 ">
							<small class="text-muted" style="padding-top:.75rem; padding-right:.5rem;">Qty.</small>
							<input class="form-control orderProductQuantity width100" type="text"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer text-center clearfix">
			<div class="centerAlign"> <a href="javascript:void(0);" class="defaultBtn cancelOrder" data-dismiss="modal">Cancel</a> <a href="javascript:void(0);" class="defaultBtn belu addOrder">Add</a> </div>
		</div>
	</div>
	</div>
</div>
<!---- ORDER FORM POPUP  ------>

<!---- PRODUCT POPUP  ------>
<div id="popup" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg modalpopup" style="max-width:500px;">
		<div class="modal-content modalpopup-container">
			<div class="modal-header text-center modalpopup-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modalpopup-title modalpopup-title">popup</h2>
			</div>
			<div class="modal-body clearfix">
				<div style="overflow:auto; max-height:60vh;">
					<ul class="CIMS_InventoryProducts">
					</ul>
				</div>
			</div>
			<div class="modal-footer text-center clearfix">
				<div class="centerAlign">
					<a href="javascript:void(0);" class="defaultBtn cancelPopupProduct" data-dismiss="modal">Cancel</a><a href="javascript:void(0);" class="defaultBtn belu donePopupProduct">Done</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!---- PRODUCT POPUP  ------>


<script type="text/javascript">

$(document).ready(function() {

    $(".singleselect").select2();
	
	$("#product_name").select2({
		dropdownCssClass: "product_name"
	});
	
	$("#allergyData").select2({
		dropdownCssClass: "allergyData"
	});

    $('.addtimeClick').click(function() {
        $(this).parents('.row').find('.customTimewrap').removeClass('active');
    });

    $(".approvalDate").daterangepicker({
        autoUpdateInput: true,
        singleDatePicker: true,
        locale: {
            format: 'DD MMM YYYY'
        }
    });

    $('.menutoggle').click(function() {
        $(this).toggleClass('active');
        $('header').toggleClass('active');
    });

    $('#toggletitleLabel').click(function() {
        $(this).toggleClass('active');
        $(this).parents('.deliverypickupWrap').find('.deliveryToggle').slideToggle();
    });
	
	$('#toggletitleLabel1').click(function() {
        $(this).toggleClass('active');
        $(this).parents('.deliverypickupWrap').find('.deliveryToggle').slideToggle();
    });

    $('.multiselect').multiselect({
        maxHeight: 280,
        numberDisplayed: 5
    });

    $('body').on('change','#secudelMedician',function()
	{
        if (this.value == 'Daily') {
            $('.monthlyWrap').hide();
            $('.weeklyWrap').hide();
            $('.dailyWrap').show();
        }

        if (this.value == 'Weekly') {
            $('.monthlyWrap').hide();
            $('.weeklyWrap').show();
            $('.dailyWrap').show();
        }

        if (this.value == 'Monthly') {
            $('.monthlyWrap').show();
            $('.weeklyWrap').show();
            $('.dailyWrap').show();
        }
    });

    $('#pickupAdd').on('change', function() {
        if (this.value == 'Delivery') {
            $(this).parents('.deliveryToggle').find('.plaseselectArea ').slideDown();
        }
        if (this.value == 'Pickup') {
            $(this).parents('.deliveryToggle').find('.plaseselectArea ').slideUp();
        }
    });

    var qty = $('#qty').val();
	var price = $('#price').val();
	
	$('body').on('keyup','#price',function()
	{
		var price = $('#price').val();
		var frequency = ($('.duration_frequency').val()=="Day") ? 1 : (($('.dosage_frequency').val()=="Weekly" && $('.duration_frequency').val()=="Week") ? 1 : 7);
		
		if($(".customCheck").val()=="")
		{
			var morningVal = $(".morningInput").val()!="" ? $(".morningInput").val() : 0;
			var afternoonVal = $(".afternoonInput").val()!="" ? $(".afternoonInput").val() : 0;
			var eveningVal = $(".eveningInput").val()!="" ? $(".eveningInput").val() : 0;
			var dinnerVal = $(".dinnerInput").val()!="" ? $(".dinnerInput").val() : 0;
			
			if(morningVal==0 && afternoonVal==0 && eveningVal==0 && dinnerVal==0)
			{
				var shiftTotal = 1;
			}
			else
			{
				var shiftTotal = parseInt(morningVal) + parseInt(afternoonVal) + parseInt(eveningVal) + parseInt(dinnerVal);
			}
			
			if($('.dosage_frequency').val()=="Weekly")
			{
				weekTotal = 0;
				$(".days").each(function(index)
				{
					if($(this).val()!="")
					{
						weekTotal = parseInt(weekTotal) + 1;
					}
				});
				weekTotal = weekTotal==0 ? 1 : weekTotal;
				shiftTotal = parseInt(shiftTotal) * parseInt(weekTotal);
			}
		}
		else
		{
			shiftTotal = 0;
			$(".meridiemInput").each(function(index)
			{
				if($(this).val()!="")
				{
					shiftTotal = parseInt(shiftTotal) + parseInt($(this).val());
				}
				else
				{
					shiftTotal = 1;
				}
			});
		}
		
		if(price!="")
		{
			$('#total').val(parseInt(price) * parseInt(frequency) * (parseInt(shiftTotal)));
		}
	});
	$('body').on('change','.dosage_frequency',function()
	{
		var price = $('#price').val();
		var frequency = $('.dosage_frequency').val()=="Daily" || $('.dosage_frequency').val()=="Weekly" ? 1 : 7;
		
		if($(this).val()=="Weekly")
		{
			$(".duration_frequency").html("<option>Week</option>");
		}
		else
		{
			$(".duration_frequency").html("<option selected>Day</option><option>Week</option>");
		}
		
		if($(".customCheck").val()=="")
		{
			var morningVal = $(".morningInput").val()!="" ? $(".morningInput").val() : 0;
			var afternoonVal = $(".afternoonInput").val()!="" ? $(".afternoonInput").val() : 0;
			var eveningVal = $(".eveningInput").val()!="" ? $(".eveningInput").val() : 0;
			var dinnerVal = $(".dinnerInput").val()!="" ? $(".dinnerInput").val() : 0;
			
			if(morningVal==0 && afternoonVal==0 && eveningVal==0 && dinnerVal==0)
			{
				var shiftTotal = 1;
			}
			else
			{
				var shiftTotal = parseInt(morningVal) + parseInt(afternoonVal) + parseInt(eveningVal) + parseInt(dinnerVal);
			}
			
			if($('.dosage_frequency').val()=="Weekly")
			{
				weekTotal = 0;
				$(".days").each(function(index)
				{
					if($(this).val()!="")
					{
						weekTotal = parseInt(weekTotal) + 1;
					}
				});
				weekTotal = weekTotal==0 ? 1 : weekTotal;
				shiftTotal = parseInt(shiftTotal) * parseInt(weekTotal);
			}
		}
		else
		{
			shiftTotal = 0;
			$(".meridiemInput").each(function(index)
			{
				if($(this).val()!="")
				{
					shiftTotal = parseInt(shiftTotal) + parseInt($(this).val());
				}
				else
				{
					shiftTotal = 1;
				}
			});
		}
		
		if(price!="")
		{
			$('#total').val(parseInt(price) * parseInt(frequency) * (parseInt(shiftTotal)));
		}
	});
	$('body').on('change','.duration_frequency',function()
	{
		var price = $('#price').val();
		var frequency = ($('.duration_frequency').val()=="Day") ? 1 : (($('.dosage_frequency').val()=="Weekly" && $('.duration_frequency').val()=="Week") ? 1 : 7);
		
		if($(".customCheck").val()=="")
		{
			var morningVal = $(".morningInput").val()!="" ? $(".morningInput").val() : 0;
			var afternoonVal = $(".afternoonInput").val()!="" ? $(".afternoonInput").val() : 0;
			var eveningVal = $(".eveningInput").val()!="" ? $(".eveningInput").val() : 0;
			var dinnerVal = $(".dinnerInput").val()!="" ? $(".dinnerInput").val() : 0;
			
			if(morningVal==0 && afternoonVal==0 && eveningVal==0 && dinnerVal==0)
			{
				var shiftTotal = 1;
			}
			else
			{
				var shiftTotal = parseInt(morningVal) + parseInt(afternoonVal) + parseInt(eveningVal) + parseInt(dinnerVal);
			}
			
			if($('.dosage_frequency').val()=="Weekly")
			{
				weekTotal = 0;
				$(".days").each(function(index)
				{
					if($(this).val()!="")
					{
						weekTotal = parseInt(weekTotal) + 1;
					}
				});
				weekTotal = weekTotal==0 ? 1 : weekTotal;
				shiftTotal = parseInt(shiftTotal) * parseInt(weekTotal);
			}
		}
		else
		{
			shiftTotal = 0;
			$(".meridiemInput").each(function(index)
			{
				if($(this).val()!="")
				{
					shiftTotal = parseInt(shiftTotal) + parseInt($(this).val());
				}
				else
				{
					shiftTotal = 1;
				}
			});
		}
		
		if(price!="")
		{
			$('#total').val(parseInt(price) * parseInt(frequency) * (parseInt(shiftTotal)));
		}
	});

    $('.clderIconClick').click(function() {
        $(this).siblings('.approvalDate').click();
    });

    $('.toggleproduct').click(function() {
        $(this).toggleClass('active');
        $(this).parents('.repeatDosageWrap').find('.repeatDosage').slideToggle();
    });

    $('.repeatproduct').click(function() {
        $('.collapesclick').slideUp();
        $('.repeatDosageWrap').removeClass('addproductWrap');
    });

    $(".controlNumber").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    $('.shidulTimeHeader').click(function() {
        $(this).toggleClass('active');
        $(this).siblings('.shidulTimebody').slideToggle();
    })

    $("body").on("click",".togglearrow",function() {
        $(this).toggleClass('active');
        $(this).parents('.perviewRemarkHeader').siblings('.togglelistwrap').slideToggle();
    });

    $('.addresClick').click(function() {
        $('#addnewaddress').modal();
    });

    $('.remarkClick').click(function() {
        $('#remarkpopup').modal();
    });

    $('.deleteClick').click(function() {
        $('#deleteModal').modal();
    });

    $(".checkedvalue").click(function() {
        if ($(this).is(':checked')) {
            $(this).parents('.doserowChk').find('.doserowselect').removeClass('active');
        } else {
            $(this).parents('.doserowChk').find('.doserowselect').addClass('active');
            $(this).parents('.doserowChk').find('.doserowselect a').removeClass('active');
        }
    });

    $(".chkValue").keyup(function() {
        if ($(this).val().length == 0) {
            $(this).parents('.customformwrap').find('.addprod').removeClass('active');
        } else {
            $(this).parents('.customformwrap').find('.addprod').addClass('active');
        }
    });

    $('.editclickevent').click(function() {
        $(this).parents('li').find('input, select').removeAttr('disabled');
        $(this).remove();
    })

    $('.doserowselect a').click(function() {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
    });

    $('.weeklyWrap a').click(function() {
        $(this).toggleClass('active');
    });
	
	$('body').on('click','.cstmTimeClick',function() {
		$('.defaultTime').hide();
		$('.frequencyDiv').hide();
		$('#total').attr("readonly",false);
		$('.customtime').show();
		$(".customCheck").val("1");
	});
	$('body').on('click','.addtimingClick',function() {
		$('.defaultTime').show();
		$('.frequencyDiv').show();
		$('#total').attr("readonly",true);
		$('.customtime').hide();
		$(".customCheck").val("");
	});

    $("#tags").select2({
        tags: true,
        createTag: function(params) {
            return {
                id: params.term,
                text: params.term,
                newOption: true
            }
        },

        templateResult: function(data) {
            var $result = $("<span></span>");
            $result.text(data.text);
            if (data.newOption) {
                $result.append(" <em>(new)</em>");
            }
            return $result;
        }
    });

	$('#customerTable').DataTable({
		responsive: true,
		info: false,
		paging: false,
		searching: false,
		ordering: false
	});
		
    $('.updateLink').click(function() {
        $('#updateModal').modal();
    });
	
	
var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;

$('body').on('keyup','.morningInput, .afternoonInput, .eveningInput, .dinnerInput',function()
{
	var price = $('#price').val();
	var frequency = ($('.duration_frequency').val()=="Day") ? 1 : (($('.dosage_frequency').val()=="Weekly" && $('.duration_frequency').val()=="Week") ? 1 : 7);
	
	if($(".customCheck").val()=="")
	{
		var morningVal = $(".morningInput").val()!="" ? $(".morningInput").val() : 0;
		var afternoonVal = $(".afternoonInput").val()!="" ? $(".afternoonInput").val() : 0;
		var eveningVal = $(".eveningInput").val()!="" ? $(".eveningInput").val() : 0;
		var dinnerVal = $(".dinnerInput").val()!="" ? $(".dinnerInput").val() : 0;
		
		if(morningVal==0 && afternoonVal==0 && eveningVal==0 && dinnerVal==0)
		{
			var shiftTotal = 1;
		}
		else
		{
			var shiftTotal = parseInt(morningVal) + parseInt(afternoonVal) + parseInt(eveningVal) + parseInt(dinnerVal);
		}
		
		if($('.dosage_frequency').val()=="Weekly")
		{
			weekTotal = 0;
			$(".days").each(function(index)
			{
				if($(this).val()!="")
				{
					weekTotal = parseInt(weekTotal) + 1;
				}
			});
			weekTotal = weekTotal==0 ? 1 : weekTotal;
			shiftTotal = parseInt(shiftTotal) * parseInt(weekTotal);
		}
	}
	
	if(price!="")
	{
		$('#total').val(parseInt(price) * parseInt(frequency) * (parseInt(shiftTotal)));
	}
});

$('body').on('keyup','.meridiemInput',function()
{
	var price = $('#price').val();
	var frequency = ($('.duration_frequency').val()=="Day") ? 1 : (($('.dosage_frequency').val()=="Weekly" && $('.duration_frequency').val()=="Week") ? 1 : 7);
	
	if($(".customCheck").val()!="")
	{
		shiftTotal = 0;
		$(".meridiemInput").each(function(index)
		{
			if($(this).val()!="")
			{
				shiftTotal = parseInt(shiftTotal) + parseInt($(this).val());
			}
			else
			{
				shiftTotal = 1;
			}
		});
	}
	
	if(price!="")
	{
		$('#total').val(parseInt(price) * parseInt(frequency) * (parseInt(shiftTotal)));
	}
});

$('body').on('change','.batchCode',function()
{
	if($(this).val()!="")
	{
		$(".batchErrorClass").css("display","none");
	}
});

$('body').on('change','.doctor_id',function()
{
	if($(this).val()!="")
	{
		$(".doctorErrorClass").css("display","none");
	}
});

$('body').on('change','.selectPatient',function()
{
	if(!$(this).parent().prev().hasClass("active")) {
		$(this).parent().prev(".toggletitleLabel").click();
	}
	
	if($(this).val()!="") {
	
	$(".viewRemarksDiv").css("display","block");
	$(".customerdetails").css("display","block");
	$(".patientErrorClass").css("display","none");
	
	if($(".doctor_id").val()=="")
	{
		$(".doctorErrorClass").css("display","block");
	}
		
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getPatitentData"]); ?>',
		type: "POST",
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		data: {'id' : $(this).val()},
		success: function(data)
		{
			var obj = jQuery.parseJSON(data);
			var currentYear = new Date();
			
			var getDOB = obj.dob.split(' ');
			
			$(".patientAge").text(currentYear.getFullYear()-getDOB[2] + " years (" + obj.dob + ")");
			$(".patientGender").text(obj.gender);
			
			$(".fullName").text(obj.title + " " + obj.fname + " " + obj.mname + " " + obj.lname);
			$(".phoneNumber").text(obj.m_number);
			$(".age").text(currentYear.getFullYear()-getDOB[2] + " years (" + obj.dob + ")");
			$(".email").text(obj.email);
			$(".address").text(obj.address);
			
			
			$.ajax({
				url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getPatientPrescriptions"]); ?>',
				type: "POST",
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				data: {'patient_id' : $(".selectPatient").val()},
				success: function(data)
				{
					$(".drugsAllergiesDiv").html(data);
					
					var url = window.location.href;
					
					if(url.indexOf('www') != -1)
					{
						if($.trim($("#product_name").val())!="") {
						$.ajax({
							url: 'http://www.docpharmrx.com/testing/Interaction.php',
							type: "POST",
							data: {'product_name' : $('.product_name :selected').val() , 'productGUID' : $(".productGUID").text() , 'allergyGUID' : $(".allergyGUID").text()},
							headers:
							{
								'X-CSRF-Token': csrfToken    
							},
							success: function(data)
							{
								var obj = $.parseJSON(data);
								$(".drugInteractions").html(obj.drugInteraction);
								$(".allergyInteractions").html(obj.allergyInteraction);
							}
						}); }
					}
					else
					{
						if($.trim($("#product_name").val())!="") {
						$.ajax({
							url: 'http://docpharmrx.com/testing/Interaction.php',
							type: "POST",
							data: {'product_name' : $('.product_name :selected').val() , 'productGUID' : $(".productGUID").text() , 'allergyGUID' : $(".allergyGUID").text()},
							headers:
							{
								'X-CSRF-Token': csrfToken    
							},
							success: function(data)
							{
								var obj = $.parseJSON(data);
								$(".drugInteractions").html(obj.drugInteraction);
								$(".allergyInteractions").html(obj.allergyInteraction);
							}
						}); }
					}
				} 
			});
			
			
			$.ajax({
				url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getPatitentRemarks"]); ?>',
				type: "POST",
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				data: {'patient_id' : $(".selectPatient").val()},
				success: function(data)
				{
					if(data!="")
					{
						$(".savedPatientRemarks").css("display","block");
						$(".remarksData").html("");
						var obj = jQuery.parseJSON(data);
						jQuery.each(obj, function(i, val)
						{
							var createdDate = val.created_dttm.split('T');
							
							$(".remarksData").append('<li class="clearfix remarkAppendDiv_'+val.id+'"><div class="perviewRemarkHeader clearfix"> <span class="col-lg-9 col-md-9 col-sm-10 col-xs-10"><span>Added On '+createdDate[0]+'</span></span> <span class="col-lg-3 col-md-3 col-sm-3 col-xs-2 alignright"> <b class="pull-right togglearrow"><i class="sprite arrowupIcon"></i></b> <b class="pull-right"><i class="sprite deleteIcon deleteClick1 deleteRemark" id="'+val.id+'"></i></b> </span> </div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 togglelistwrap"><p>'+val.remarks+'</p></div></li>');
						});
					}
					else
					{
						$(".savedPatientRemarks").css("display","none");
					}
				} 
			});
		} 
	}); }
	else
	{
		$(".viewRemarksDiv").css("display","none");
		$(".patientAge").text("");
		$(".patientGender").text("");
	}
});

$('body').on('click','.addPatientRemarks',function()
{
	if($(".patientRemarks").val()=="")
	{
		alert("Enter some remarks");
		return false;
	}
	else
	{
		$.ajax({
			url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"savePatitentRemarks"]); ?>',
			type: "POST",
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {'patient_id' : $(".selectPatient").val(), 'remarks' : $(".patientRemarks").val()},
			success: function(data)
			{
				$(".savedPatientRemarks").css("display","block");
				$(".remarksData").html("");
				var obj = jQuery.parseJSON(data);
				jQuery.each(obj, function(i, val)
				{
					var createdDate = val.created_dttm.split('T');
					
					$(".remarksData").append('<li class="clearfix remarkAppendDiv_'+val.id+'"><div class="perviewRemarkHeader clearfix"> <span class="col-lg-9 col-md-9 col-sm-10 col-xs-10"><span>Added On '+createdDate[0]+'</span></span> <span class="col-lg-3 col-md-3 col-sm-3 col-xs-2 alignright"> <b class="pull-right togglearrow"><i class="sprite arrowupIcon"></i></b> <b class="pull-right"><i class="sprite deleteIcon deleteClick1 deleteRemark" id="'+val.id+'"></i></b> </span> </div><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 togglelistwrap"><p>'+val.remarks+'</p></div></li>');
				});
				
				$(".patientRemarks").val("");
			} 
		});
	}
});

$('body').on('click','.deleteRemark',function()
{
	var id = $(this).attr("id");
	$.ajax({
	url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"deleteRemark"]); ?>',
	type: "POST",
	headers:
	{
		'X-CSRF-Token': csrfToken    
	},
	data: {'id' : id},
	success: function(data)
	{
		$(".remarkAppendDiv_"+id).remove();
	} 
});
});

$('body').on('click','.days',function()
{
	if($(this).val()=="")
	{
		$(this).val($(this).attr("placeholder"));
		$(this).css("background","#8f4b79");
		$(this).css("color","#fff");
		$(this).css("border-color","#8f4b79");
	}
	else
	{
		$(this).val("");
		$(this).css("background","");
		$(this).css("color","");
		$(this).css("border-color","");
	}
	
	var price = $('#price').val();
	var frequency = ($('.duration_frequency').val()=="Day") ? 1 : (($('.dosage_frequency').val()=="Weekly" && $('.duration_frequency').val()=="Week") ? 1 : 7);
	
	if($(".customCheck").val()=="")
	{
		var morningVal = $(".morningInput").val()!="" ? $(".morningInput").val() : 0;
		var afternoonVal = $(".afternoonInput").val()!="" ? $(".afternoonInput").val() : 0;
		var eveningVal = $(".eveningInput").val()!="" ? $(".eveningInput").val() : 0;
		var dinnerVal = $(".dinnerInput").val()!="" ? $(".dinnerInput").val() : 0;
		
		if(morningVal==0 && afternoonVal==0 && eveningVal==0 && dinnerVal==0)
		{
			var shiftTotal = 1;
		}
		else
		{
			var shiftTotal = parseInt(morningVal) + parseInt(afternoonVal) + parseInt(eveningVal) + parseInt(dinnerVal);
		}
		
		if($('.dosage_frequency').val()=="Weekly")
		{
			weekTotal = 0;
			$(".days").each(function(index)
			{
				if($(this).val()!="")
				{
					weekTotal = parseInt(weekTotal) + 1;
				}
			});
			weekTotal = weekTotal==0 ? 1 : weekTotal;
			shiftTotal = parseInt(shiftTotal) * parseInt(weekTotal);
		}
	}
	
	if(price!="")
	{
		$('#total').val(parseInt(price) * parseInt(frequency) * (parseInt(shiftTotal)));
	}
});

$('body').on('click','#morning',function()
{
	if($(this).is(":checked"))
	{
		$(".morning").parent().removeClass("active");
		$(".morning").val("Anytime");
		$(".morningAnytime").addClass("active");
		$(".morningInput").attr("readonly",false);
	}
	else
	{
		$(".morning").parent().addClass("active");
		$(".morning").val("");
		$(".morningAnytime,.morningSchedule").removeClass("active");
		$(".morningInput").attr("readonly",true);
		$(".morningInput").val("");
	}
});
$('body').on('click','#afternoon',function()
{
	if($(this).is(":checked"))
	{
		$(".afternoon").parent().removeClass("active");
		$(".afternoon").val("Anytime");
		$(".afternoonAnytime").addClass("active");
		$(".afternoonInput").attr("readonly",false);
	}
	else
	{
		$(".afternoon").parent().addClass("active");
		$(".afternoon").val("");
		$(".afternoonAnytime,.afternoonSchedule").removeClass("active");
		$(".afternoonInput").attr("readonly",true);
		$(".afternoonInput").val("");
	}
});
$('body').on('click','#evening',function()
{
	if($(this).is(":checked"))
	{
		$(".evening").parent().removeClass("active");
		$(".evening").val("Anytime");
		$(".eveningAnytime").addClass("active");
		$(".eveningInput").attr("readonly",false);
	}
	else
	{
		$(".evening").parent().addClass("active");
		$(".evening").val("");
		$(".eveningAnytime,.eveningSchedule").removeClass("active");
		$(".eveningInput").attr("readonly",true);
		$(".eveningInput").val("");
	}
});
$('body').on('click','#dinner',function()
{
	if($(this).is(":checked"))
	{
		$(".dinner").parent().removeClass("active");
		$(".dinner").val("Anytime");
		$(".dinnerAnytime").addClass("active");
		$(".dinnerInput").attr("readonly",false);
	}
	else
	{
		$(".dinner").parent().addClass("active");
		$(".dinner").val("");
		$(".dinnerAnytime,.dinnerSchedule").removeClass("active");
		$(".dinnerInput").attr("readonly",true);
		$(".dinnerInput").val("");
	}
});

$('body').on('click','.morningSchedule',function()
{
	$(".morning").val($(this).text());
	$(".morningSchedule").removeClass("active");
	$(this).addClass("active");
});
$('body').on('click','.afternoonSchedule',function()
{
	$(".afternoon").val($(this).text());
	$(".afternoonSchedule").removeClass("active");
	$(this).addClass("active");
});
$('body').on('click','.eveningSchedule',function()
{
	$(".evening").val($(this).text());
	$(".eveningSchedule").removeClass("active");
	$(this).addClass("active");
});
$('body').on('click','.dinnerSchedule',function()
{
	$(".dinner").val($(this).text());
	$(".dinnerSchedule").removeClass("active");
	$(this).addClass("active");
});


var timeoutAbbreviation;
var delayAbbreviation = 1000;
var isLoadingAbbreviation = false;
$('body').on('keyup','.abbreviation',function()
{
	if(timeoutAbbreviation)
	var id = $(this).attr("id");
    clearTimeout(timeoutAbbreviation);
	checkAbbreviation(id);
});
function checkAbbreviation(id)
{
    if(!isLoadingAbbreviation)
    {             
        timeoutAbbreviation = setTimeout(function() {
			
			$.ajax({
				url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"checkAbbreviation"]); ?>',  
				type: "POST",
				data: {'abbreviation' : $(".abbreviation_"+id).val()},
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				success: function(data)
				{
					$(".abbreviation_meaning_"+id).val(data);
				}   
			});
			
			setTimeout(function() { isLoadingAbbreviation = false; }, delayAbbreviation);
        }, delayAbbreviation);
    }
}

$('body').on('click','.addtimeClick',function()
{
	var countClass = $('.appendDiv').length + 1;
	
	$(".appendCustomTime").append('<div class=" customTimewrap clearfix appendDiv"><div class="col-lg-4 col-md-3 col-sm-4 col-xs-12"><div class="customformwrap"><input type="time" name="time[]" class="custominput witoutbg without_ampm" value="00:00" /> </div></div><div class="col-lg-7 col-md-8 col-sm-6 col-xs-12 customTimePM typeareaInput"><input autocomplete="off" type="text" class="form-control abbreviation abbreviation_'+countClass+'" id="'+countClass+'" name="abbreviation[]"><div class="textCustomarea"><label for="'+countClass+'"><textarea class="form-control abbreviation_meaning abbreviation_meaning_'+countClass+'" readonly name="abbreviation_meaning[]" rows="3"></textarea></label></div></div><div class="col-lg-1 col-md-1 col-sm-2 col-xs-12"><div class="addmoreBtn"><b class="sprite removeCustomTime"></b></div></div></div>');
	
});

$('body').on('click','.removeCustomTime',function()
{
	$(this).closest(".appendDiv").remove();
	
	var price = $('#price').val();
	var frequency = ($('.duration_frequency').val()=="Day") ? 1 : (($('.dosage_frequency').val()=="Weekly" && $('.duration_frequency').val()=="Week") ? 1 : 7);
	
	if($(".customCheck").val()!="")
	{
		shiftTotal = 0;
		$(".meridiemInput").each(function(index)
		{
			if($(this).val()!="")
			{
				shiftTotal = parseInt(shiftTotal) + parseInt($(this).val());
			}
			else
			{
				shiftTotal = 1;
			}
		});
	}
	
	if(price!="")
	{
		$('#total').val(parseInt(price) * parseInt(frequency) * (parseInt(shiftTotal)));
	}
});

$("body").on("click",".checkValidation",function()
{
	if($(".patient_id").val()=="")
	{
		$(".patientErrorClass").css("display","block");
		return false;
	}
	if($(".doctor_id").val()=="")
	{
		$(".doctorErrorClass").css("display","block");
		return false;
	}
	if($("#product_name").val()=="")
	{
		$(".productErrorClass").css("display","block");
		return false;
	}
	if($(".batchCode").val()=="")
	{
		$(".batchErrorClass").css("display","block");
		return false;
	}
	
	$(this).prop('disabled', true);
	
	var formData = $("#formData").serialize();
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"save"]); ?>',  
		type: "POST",
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		data: formData,
		success: function(data)
		{
			$(".prescriptionLeftDiv").html(data);
			$(".singleselect").select2();
			$(".customerdetails").css("display","none");
			$(".patient_id").val($(".savedPatient").val()).trigger('change');
			$(".doctor_id").val($(".savedDoctor").val()).trigger('change');
			$("#product_name").select2({
				dropdownCssClass: "product_name"
			});
			
			var prescriptionID = $(".prescriptionID").val();
			
			$.ajax({
				url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getsavedprescription"]); ?>',  
				type: "POST",
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				data: {"prescriptionID" : prescriptionID},
				success: function(data)
				{
					$(".prescriptionRightDiv").html(data);
				}   
			});
			
		$(".drugDetails").text("");
		} 
	});
	return false;  
});

$('body').on('click','.createNewOrder',function()
{
	$(".newOrderNameDiv").css("display","block");
	$(".previousOrder").css("display","block");
	$(".previousOrderNameDiv").css("display","none");
	$(this).css("display","none");
});

$('body').on('click','.previousOrder',function()
{
	$(".previousOrderNameDiv").css("display","block");
	$(".createNewOrder").css("display","block");
	$(".newOrderNameDiv").css("display","none");
	$(this).css("display","none");
});

$('body').on('click','.addOrder',function()
{
	if($(".previousOrderNameDiv").css('display')=='block')
	{
		var orderFormID = $(".savedOrderName").val();
		var orderName = "";
		if(orderFormID=="")
		{
			alert("Select Order");
			return false;
		}
	}
	else
	{
		var orderFormID = "";
		var orderName = $(".newOrderName").val();
		if(orderName=="")
		{
			alert("Order Name Required");
			return false;
		}
	}
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"addorder"]); ?>',
		type: "POST",
		headers:
		{
			'X-CSRF-Token': csrfToken   
		},
		data: {"orderFormID":orderFormID, "orderName":orderName, "orderproductGUID":$(".orderproductGUID").val(), "orderProductName":$(".orderProductName").text(), "orderProductQuantity":$(".orderProductQuantity").val()},
		success: function(data)
		{
			$(".orderProductName").text("");
			$(".orderProductQuantity").val("");
			$(".cancelOrder").click();
			
			if($('#addOrderDiv').hasClass("lastPopup"))
			{
				$('#popup').modal('show');
				$('#addOrderDiv').modal('hide');
				$('#addOrderDiv').removeClass('lastPopup');
			}
		} 
	});
});


$('body').on('click','.donePopupProduct',function()
{
	if($('.pickMed').is(':checked'))
	{
		var product_guid = $('input[name=pickMed]:checked').val();
	}
	else
	{
		alert("Select a product");
		return false;
	}
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getProductInventory"]); ?>',
		type: "POST",
		data: {'product_guid' : product_guid, "type" : "CIMS"},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			var obj = $.parseJSON(data);
			if(obj!="") {
				
			var nameID = $('input[name=pickMed]:checked').val().split("_");
			$(".product_name").html('<option value="'+$('input[name=pickMed]:checked').val()+'">'+nameID[1]+'</option>');
			$(".cancelPopupProduct").click();
				
			jQuery.each(obj, function(i, val)
			{
				if(i==0)
				{
					$(".productID").val(val.productID);
				}
				$("#batchCode_1").append('<option value="'+val.id+'">'+val.batch_no+'</option>');
			}); }
			else
			{
				var nameID = $('.product_name :selected').val().split("_");
				$(".orderForm").click();
				$(".orderproductGUID").val(nameID[0]);
				$(".orderProductName").text(nameID[1]);
				
				$("#batchCode_1").html('<option value="">Select Batch</option>');
			}
			
			var url = window.location.href;
			if(url.indexOf('www') != -1)
			{
				$.ajax({
					url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
					type: "POST",
					data: {'product_name' : $('.product_name :selected').val() , 'type' : 'companyFormName'},
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					success: function(data)
					{
						var obj = $.parseJSON(data);
						$(".companyName").text(obj.companyName);
						$(".formName").text(obj.formName);
						$(".product_type").val(obj.formName);
					}
				});
			}
			else
			{
				$.ajax({
					url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
					type: "POST",
					data: {'product_name' : $('.product_name :selected').val() , 'type' : 'companyFormName'},
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					success: function(data)
					{
						var obj = $.parseJSON(data);
						$(".companyName").text(obj.companyName);
						$(".formName").text(obj.formName);
						$(".product_type").val(obj.formName);
					}
				});
			}
		}
	});
});


$('body').on('change','.product_name',function()
{
	var url = window.location.href;
	var dataID = $('.product_name :selected').attr("data-id");
	
	if($(this).val()=="")
	{
		return false;
	}
	
	if(url.indexOf('www') != -1)
	{
		$.ajax({
			url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
			type: "POST",
			data: {'product_name' : $('.product_name :selected').val() , 'type' : 'companyFormName'},
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			success: function(data)
			{
				var obj = $.parseJSON(data);
				$(".companyName").text(obj.companyName);
				$(".formName").text(obj.formName);
				$(".product_type").val(obj.formName);
			}
		});
		
		if($.trim($(".productGUID").text())!="") {
		$.ajax({
			url: 'http://www.docpharmrx.com/testing/Interaction.php',
			type: "POST",
			data: {'product_name' : $('.product_name :selected').val() , 'productGUID' : $(".productGUID").text() , 'allergyGUID' : $(".allergyGUID").text()},
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			success: function(data)
			{
				var obj = $.parseJSON(data);
				$(".drugInteractions").html(obj.drugInteraction);
				$(".allergyInteractions").html(obj.allergyInteraction);
			}
		}); }
	}
	else
	{
		$.ajax({
			url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
			type: "POST",
			data: {'product_name' : $('.product_name :selected').val() , 'type' : 'companyFormName'},
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			success: function(data)
			{
				var obj = $.parseJSON(data);
				$(".companyName").text(obj.companyName);
				$(".formName").text(obj.formName);
				$(".product_type").val(obj.formName);
			}
		});
		
		if($.trim($(".productGUID").text())!="") {
		$.ajax({
			url: 'http://docpharmrx.com/testing/Interaction.php',
			type: "POST",
			data: {'product_name' : $('.product_name :selected').val() , 'productGUID' : $(".productGUID").text() , 'allergyGUID' : $(".allergyGUID").text()},
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			success: function(data)
			{
				var obj = $.parseJSON(data);
				$(".drugInteractions").html(obj.drugInteraction);
				$(".allergyInteractions").html(obj.allergyInteraction);
			}
		}); }
	}
	
	
	if(dataID=="Product")
	{
		$.ajax({
			url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getProductInventory"]); ?>',
			type: "POST",
			data: {'product_guid' : $('.product_name :selected').val(), "type" : "CIMS"},
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			success: function(data)
			{
				var obj = $.parseJSON(data);
				if(obj!="") {
				jQuery.each(obj, function(i, val)
				{
					if(i==0)
					{
						$(".productID").val(val.productID);
					}
					$("#batchCode_1").append('<option value="'+val.id+'">'+val.batch_no+'</option>');
				}); }
				else
				{
					var nameID = $('.product_name :selected').val().split("_");
					$(".orderForm").click();
					$(".orderproductGUID").val(nameID[0]);
					$(".orderProductName").text(nameID[1]);
					
					$("#batchCode_1").html('<option value="">Select Batch</option>');
				}
			}
		});
	}
	
	
	if(dataID=="Molecule")
	{
		var url = window.location.href;
		if(url.indexOf('www') != -1) {
		$.ajax({
			url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
			type: "POST",
			data: {'product_id' : $('.product_name :selected').val() , 'type' : 'Molecule'},
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			success: function(data)
			{
				if(data!="") {
				$.ajax({
					url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getAvailableProducts"]); ?>',
					type: "POST",
					data: {'product_data' : data},
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					success: function(data)
					{
						var obj = $.parseJSON(data);
						if(obj!="") {
						$(".CIMS_InventoryProducts").html("");
						$(".Popup").click();
						jQuery.each(obj, function(i, val)
						{
							if(val.product_id!="")
							{
								$(".CIMS_InventoryProducts").append('<li><div class="row"><div class="col-sm-8"><label><input type="radio" value="'+val.product_guid+'_'+val.product_name+'" name="pickMed" class="pickMed"/>'+val.product_name+'</label></div><div class="col-sm-4  text-uppercase"><span class="text-success">&check;</span></div></div></li>');
							}
							else
							{
								$(".CIMS_InventoryProducts").append('<li><div class="row"><div class="col-sm-8"><label><input type="radio" name="pickMed" class="pickMed" disabled/>'+val.product_name+'</label></div><div class="col-sm-4 text-uppercase"><span class=" text-danger">&#10005;</span> <a href="#" class="text-primary small ml-2 addOrderCall" data-name="'+val.product_name+'" data-id="'+val.product_guid+'">Add to order</a></div></div></li>');
							}
						}); }
					}
				}); }
			}
		});
		}
		else {
		$.ajax({
			url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
			type: "POST",
			data: {'value' : $(".product_name input.select2-search__field").val() , 'type' : 'Molecule'},
			headers:
			{
				'X-CSRF-Token': csrfToken  
			},
			success: function(data)
			{
				if(data!="") {
				$.ajax({
					url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getAvailableProducts"]); ?>',
					type: "POST",
					data: {'product_data' : data},
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					success: function(data)
					{
						var obj = $.parseJSON(data);
						if(obj!="") {
						$(".CIMS_InventoryProducts").html("");
						$(".Popup").click();
						
									
						jQuery.each(obj, function(i, val)
						{
							if(val.product_id!="")
							{
								$(".CIMS_InventoryProducts").append('<li><div class="row"><div class="col-sm-8"><label><input type="radio" value="'+val.product_guid+'_'+val.product_name+'" name="pickMed" class="pickMed"/>'+val.product_name+'</label></div><div class="col-sm-4  text-uppercase"><span class="text-success">&check;</span></div></div></li>');
							}
							else
							{
								$(".CIMS_InventoryProducts").append('<li><div class="row"><div class="col-sm-8"><label><input type="radio" name="pickMed" class="pickMed" disabled/>'+val.product_name+'</label></div><div class="col-sm-4 text-uppercase"><span class=" text-danger">&#10005;</span> <a href="#" class="text-primary small ml-2 addOrderCall" data-name="'+val.product_name+'" data-id="'+val.product_guid+'">Add to order</a></div></div></li>');
							}
						}); }
					}
				}); }
			}
		});
		}
	}
	
});

$('body').on('click','.addOrderCall',function()
{
	$('#popup').modal('hide');
	$('#addOrderDiv').modal('show');
	$('#addOrderDiv').addClass('lastPopup');
	
	$(".orderproductGUID").val("");
	$(".orderProductName").text("");
	$(".orderproductGUID").val($(this).attr("data-id"));
	$(".orderProductName").text($(this).attr("data-name"));
});

$('#addOrderDiv').on('hidden.bs.modal',function(e)
{
	if($('#addOrderDiv').hasClass("lastPopup"))
	{
		$('#popup').modal('show');
		$('#addOrderDiv').modal('hide');
		$('#addOrderDiv').removeClass('lastPopup');
	}
});

$('body').on('click','.emailIcon',function()
{
	if($.trim($(".drugInteractions").text())!="")
	{
		$.ajax({
			url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"sendmail"]); ?>',  
			type: "POST",
			data: {'patient_id' : $(".selectPatient").val() , drugInteractions : $(".drugInteractions").text() , email : $(".email").text()},
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			success: function(data)
			{
				$(".emailMessage").css("display", "block").fadeOut(3000);
			}   
		});
	}
});


var timeout;
var delay = 1000;
var isLoading = false;
$('body').on('keyup','.product_name input.select2-search__field',function()
{
	//if($(this).parent().parent().hasClass("product_name")) {
	if(timeout)
    clearTimeout(timeout);
	reloadProduct();
	//}
	
	/* if($(this).parent().parent().hasClass("allergyData")) {
	if(timeout)
    clearTimeout(timeout);
	reloadAllergy();
	} */
});

function reloadProduct()
{
    if(!isLoading)
    {             
        timeout = setTimeout(function() {
			
			var count = $(".product_name input.select2-search__field").val().length;
			
			var url = window.location.href;
			
			if(count>4)
			{
				if(url.indexOf('www') != -1) {
				$.ajax({
					url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
					type: "POST",
					data: {'value' : $(".product_name input.select2-search__field").val() , 'type' : 'medicines'},
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					success: function(data)
					{
						$(".select2-results__option").css("display","none");
						$(".productErrorClass").css("display","none");
						$("#product_name").html("");
						
						$("#batchCode_1").html('<option value="">Select Batch</option>');
						$(".quantity_1").val("");
						$(".expiry_1").val("");
						$(".appendDiv").remove();
						$(".productID").val("");
						$(".custominput expiry_1").val("");
						$(".quantityLeft_1").text("");
						
						var obj = $.parseJSON(data);
						if(obj!="")
						{
							//$("#product_name").append('<option data-id="" value="">Select Product</option>');
							jQuery.each(obj, function(i, val)
							{
								var value = val.id+"_"+val.name;
								$("#product_name").append('<option data-id="'+val.type+'" value="'+value+'">'+val.name+'</option>');
							});
							
							var dataID = $('.product_name :selected').attr("data-id");
							if(dataID=="Product")
							{
								$.ajax({
									url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getProductInventory"]); ?>',
									type: "POST",
									data: {'product_guid' : $('.product_name :selected').val(), "type" : "CIMS"},
									headers:
									{
										'X-CSRF-Token': csrfToken    
									},
									success: function(data)
									{
										var obj = $.parseJSON(data);
										if(obj!="") {
										jQuery.each(obj, function(i, val)
										{
											if(i==0)
											{
												$(".productID").val(val.productID);
											}
											$("#batchCode_1").append('<option value="'+val.id+'">'+val.batch_no+'</option>');
										}); }
										else
										{
											var nameID = $('.product_name :selected').val().split("_");
											$(".orderForm").click();
											$(".orderproductGUID").val(nameID[0]);
											$(".orderProductName").text(nameID[1]);
											
											$("#batchCode_1").html('<option value="">Select Batch</option>');
										}
									}
								});
							}
							
							if(dataID=="Molecule")
							{
								$.ajax({
									url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
									type: "POST",
									data: {'product_id' : $('.product_name :selected').val() , 'type' : 'Molecule'},
									headers:
									{
										'X-CSRF-Token': csrfToken    
									},
									success: function(data)
									{
										if(data!="") {
										$.ajax({
											url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getAvailableProducts"]); ?>',
											type: "POST",
											data: {'product_data' : data},
											headers:
											{
												'X-CSRF-Token': csrfToken    
											},
											success: function(data)
											{
												var obj = $.parseJSON(data);
												if(obj!="") {
												$(".CIMS_InventoryProducts").html("");
												$(".Popup").click();
												jQuery.each(obj, function(i, val)
												{
													if(val.product_id!="")
													{
														$(".CIMS_InventoryProducts").append('<li><div class="row"><div class="col-sm-8"><label><input type="radio" value="'+val.product_guid+'_'+val.product_name+'" name="pickMed" class="pickMed"/>'+val.product_name+'</label></div><div class="col-sm-4  text-uppercase"><span class="text-success">&check;</span></div></div></li>');
													}
													else
													{
														$(".CIMS_InventoryProducts").append('<li><div class="row"><div class="col-sm-8"><label><input type="radio" name="pickMed" class="pickMed" disabled/>'+val.product_name+'</label></div><div class="col-sm-4 text-uppercase"><span class=" text-danger">&#10005;</span> <a href="#" class="text-primary small ml-2 addOrderCall" data-name="'+val.product_name+'" data-id="'+val.product_guid+'">Add to order</a></div></div></li>');
													}
												}); }
											}
										}); }
									}
								});
							}
						}
						else
						{
							$("#product_name").append('<option data-id="" value="">No Product Found</option>');
						}
						
						$.ajax({
							url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
							type: "POST",
							data: {'product_name' : $('.product_name :selected').val() , 'type' : 'companyFormName'},
							headers:
							{
								'X-CSRF-Token': csrfToken    
							},
							success: function(data)
							{
								var obj = $.parseJSON(data);
								$(".companyName").text(obj.companyName);
								$(".formName").text(obj.formName);
								$(".product_type").val(obj.formName);
							}
						});
						
						if($.trim($(".productGUID").text())!="")
						{
							$.ajax({
								url: 'http://www.docpharmrx.com/testing/Interaction.php',
								type: "POST",
								data: {'product_name' : $('.product_name :selected').val() , 'productGUID' : $(".productGUID").text() , 'allergyGUID' : $(".allergyGUID").text()},
								headers:
								{
									'X-CSRF-Token': csrfToken    
								},
								success: function(data)
								{
									var obj = $.parseJSON(data);
									$(".drugInteractions").html(obj.drugInteraction);
									$(".allergyInteractions").html(obj.allergyInteraction);
								}
							});
						}
						
					}
				});
				}
				else {
				$.ajax({
					url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
					type: "POST",
					data: {'value' : $(".product_name input.select2-search__field").val() , 'type' : 'medicines'},
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					success: function(data)
					{
						$(".select2-results__option").css("display","none");
						$(".productErrorClass").css("display","none");
						$("#product_name").html("");
						
						$("#batchCode_1").html('<option value="">Select Batch</option>');
						$(".quantity_1").val("");
						$(".expiry_1").val("");
						$(".appendDiv").remove();
						$(".productID").val("");
						$(".custominput expiry_1").val("");
						$(".quantityLeft_1").text("");
						
						var obj = $.parseJSON(data);
						if(obj!="")
						{
							//$("#product_name").append('<option data-id="" value="">Select Product</option>');
							jQuery.each(obj, function(i, val)
							{
								var value = val.id+"_"+val.name;
								$("#product_name").append('<option data-id="'+val.type+'" value="'+value+'">'+val.name+'</option>');
							});
							
							var dataID = $('.product_name :selected').attr("data-id");
							if(dataID=="Product")
							{
								$.ajax({
									url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getProductInventory"]); ?>',
									type: "POST",
									data: {'product_guid' : $('.product_name :selected').val(), "type" : "CIMS"},
									headers:
									{
										'X-CSRF-Token': csrfToken    
									},
									success: function(data)
									{
										var obj = $.parseJSON(data);
										if(obj!="") {
										jQuery.each(obj, function(i, val)
										{
											if(i==0)
											{
												$(".productID").val(val.productID);
											}
											$("#batchCode_1").append('<option value="'+val.id+'">'+val.batch_no+'</option>');
										}); }
										else
										{
											var nameID = $('.product_name :selected').val().split("_");
											$(".orderForm").click();
											$(".orderproductGUID").val(nameID[0]);
											$(".orderProductName").text(nameID[1]);
											
											$("#batchCode_1").html('<option value="">Select Batch</option>');
										}
									}
								});
							}
							
							if(dataID=="Molecule")
							{
								$.ajax({
									url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
									type: "POST",
									data: {'product_id' : $('.product_name :selected').val() , 'type' : 'Molecule'},
									headers:
									{
										'X-CSRF-Token': csrfToken    
									},
									success: function(data)
									{
										if(data!="") {
										$.ajax({
											url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getAvailableProducts"]); ?>',
											type: "POST",
											data: {'product_data' : data},
											headers:
											{
												'X-CSRF-Token': csrfToken    
											},
											success: function(data)
											{
												var obj = $.parseJSON(data);
												if(obj!="") {
												$(".CIMS_InventoryProducts").html("");
												$(".Popup").click();
												jQuery.each(obj, function(i, val)
												{
													if(val.product_id!="")
													{
														$(".CIMS_InventoryProducts").append('<li><div class="row"><div class="col-sm-8"><label><input type="radio" value="'+val.product_guid+'_'+val.product_name+'" name="pickMed" class="pickMed"/>'+val.product_name+'</label></div><div class="col-sm-4  text-uppercase"><span class="text-success">&check;</span></div></div></li>');
													}
													else
													{
														$(".CIMS_InventoryProducts").append('<li><div class="row"><div class="col-sm-8"><label><input type="radio" name="pickMed" class="pickMed" disabled/>'+val.product_name+'</label></div><div class="col-sm-4 text-uppercase"><span class=" text-danger">&#10005;</span> <a href="#" class="text-primary small ml-2 addOrderCall" data-name="'+val.product_name+'" data-id="'+val.product_guid+'">Add to order</a></div></div></li>');
													}
												}); }
											}
										}); }
									}
								});
							}
						}
						else
						{
							$("#product_name").append('<option data-id="" value="">No Product Found</option>');
						}
						
						$.ajax({
							url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
							type: "POST",
							data: {'product_name' : $('.product_name :selected').val() , 'type' : 'companyFormName'},
							headers:
							{
								'X-CSRF-Token': csrfToken    
							},
							success: function(data)
							{
								var obj = $.parseJSON(data);
								$(".companyName").text(obj.companyName);
								$(".formName").text(obj.formName);
								$(".product_type").val(obj.formName);
							}
						});
						
						if($.trim($(".productGUID").text())!="")
						{
							$.ajax({
								url: 'http://docpharmrx.com/testing/Interaction.php',
								type: "POST",
								data: {'product_name' : $('.product_name :selected').val() , 'productGUID' : $(".productGUID").text() , 'allergyGUID' : $(".allergyGUID").text()},
								headers:
								{
									'X-CSRF-Token': csrfToken    
								},
								success: function(data)
								{
									var obj = $.parseJSON(data);
									$(".drugInteractions").html(obj.drugInteraction);
									$(".allergyInteractions").html(obj.allergyInteraction);
								}
							});
						}
						
					}
				});
				}
				
			}
			if(count==0)
			{
				$("#product_name").html('<option value="">Select Product</option>');
			}
			
            setTimeout(function() { isLoading = false; }, delay);
        }, delay);
    }
}

$('body').on('click','.edit',function()
{
	var id = $(this).attr("id");
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"editprescription"]); ?>',  
		type: "POST",
		data: {'id':id},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".prescriptionLeftDiv").html(data);
			$(".singleselect").select2();
			$("#product_name").select2({
				dropdownCssClass: "product_name"
			});
			
			if(!$(".selectPatient").parent().prev().hasClass("active")) {
				$(".selectPatient").parent().prev(".toggletitleLabel").click();
			}
			
			
			$.ajax({
				url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getPatientPrescriptions"]); ?>',
				type: "POST",
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				data: {'patient_id' : $(".selectPatient").val()},
				success: function(data)
				{
					$(".drugsAllergiesDiv").html(data);
					
					var url = window.location.href;
					
					if(url.indexOf('www') != -1)
					{
						if($.trim($("#product_name").val())!="") {
						$.ajax({
							url: 'http://www.docpharmrx.com/testing/Interaction.php',
							type: "POST",
							data: {'product_name' : $('.product_name :selected').val() , 'productGUID' : $(".productGUID").text() , 'allergyGUID' : $(".allergyGUID").text()},
							headers:
							{
								'X-CSRF-Token': csrfToken    
							},
							success: function(data)
							{
								var obj = $.parseJSON(data);
								$(".drugInteractions").html(obj.drugInteraction);
								$(".allergyInteractions").html(obj.allergyInteraction);
							}
						}); }
					}
					else
					{
						if($.trim($("#product_name").val())!="") {
						$.ajax({
							url: 'http://docpharmrx.com/testing/Interaction.php',
							type: "POST",
							data: {'product_name' : $('.product_name :selected').val() , 'productGUID' : $(".productGUID").text() , 'allergyGUID' : $(".allergyGUID").text()},
							headers:
							{
								'X-CSRF-Token': csrfToken    
							},
							success: function(data)
							{
								var obj = $.parseJSON(data);
								$(".drugInteractions").html(obj.drugInteraction);
								$(".allergyInteractions").html(obj.allergyInteraction);
							}
						}); }
					}
				} 
			});
			
	
			$.ajax({
				url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getPatitentData"]); ?>',
				type: "POST",
				headers:
				{
					'X-CSRF-Token': csrfToken    
				},
				data: {'id' : $(".savedPatient").val()},
				success: function(data)
				{
					var obj = jQuery.parseJSON(data);
					var currentYear = new Date();
					
					var getDOB = obj.dob.split(' ');
					
					$(".doctorErrorClass").css("display","none");
					$(".patient_id").val($(".savedPatient").val()).trigger('change');
					$(".doctor_id").val($(".savedDoctor").val()).trigger('change');
					
					$(".patientAge").text(currentYear.getFullYear()-getDOB[2] + " years (" + obj.dob + ")");
					$(".patientGender").text(obj.gender);
					
					$(".fullName").text(obj.title + " " + obj.fname + " " + obj.mname + " " + obj.lname);
					$(".phoneNumber").text(obj.m_number);
					$(".age").text(currentYear.getFullYear()-getDOB[2] + " years (" + obj.dob + ")");
					$(".email").text(obj.email);
					$(".address").text(obj.address);
				} 
			});
			
		}   
	});
});

$('body').on('click','.deletePrescription',function()
{
	var id = $(this).attr("id");
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"deleteprescription"]); ?>',  
		type: "POST",
		data: {'id' : id},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".prescriptionDiv_"+id).remove();
			$("#deleteModal_"+id).modal('toggle');
			
			$(".totalProductPrice").text(data);
		}   
	});
});

$('body').on('change','.batchCode',function()
{
	var id = $(this).val();
	var dataID = $(this).attr("data-id");
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getinventorydata"]); ?>',  
		type: "POST",
		data: {'id' : id},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			var obj = jQuery.parseJSON(data);
			
			$(".quantityLeft_"+dataID).text("You have " +obj.qty_available+ " quantities");
			$(".expiry_"+dataID).val(obj.expiry_date);
			$(".quantity_left_"+dataID).val(obj.qty_available);
			$(".total_quantity_"+dataID).val(obj.quantity);
			$(".unit_price_"+dataID).val(obj.unit_price);
			$(".totalPacks_"+dataID).val(obj.no_of_pack);
		}   
	});
});

$("body").on("click",".addInventory",function()
{
	var countClass = $('.batchDiv').length+1;
	
	$(".appendInventory").append('<div class="appendDiv"><ul class="row batchwrap batchDiv"><li class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="customformwrap"><label class="customLabel">BATCH CODE</label><select class="custominput singleselect batchCode" data-id="'+countClass+'" name="inventory_id[]" id="batchCode_'+countClass+'"><option value="0">Select Batch</option></select><span class="quantityLeft_'+countClass+'"></span></div></li><input type="hidden" name="quantity_left[]" class="quantity_left_'+countClass+'"><input type="hidden" name="total_quantity[]" class="total_quantity_'+countClass+'"><input type="hidden" name="unit_price[]" class="unit_price_'+countClass+'"><input type="hidden" name="totalPacks[]" class="totalPacks_'+countClass+'"><li class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><div class="customformwrap"><label class="customLabel">QUANTITY</label><input type="text" class="custominput quantity_'+countClass+'" name="quantity[]"/></div></li><li class="col-lg-4 col-md-4 col-sm-10 col-xs-10"><div class="customformwrap"><label class="customLabel">PRODUCT EXPIRY</label><input type="text" class="custominput expiry_'+countClass+'" name="expiry_date[]" readonly/></div></li><li class="col-lg-1 col-md-1 col-sm-2 col-xs-2"><div class="addmoreBtn repear_bClick"><b class="sprite addplusIcon removeInventory"></b></div></li></ul></div>');
	$(".singleselect").select2();
	
	$("#product_name").select2({
		dropdownCssClass: "product_name"
	});
	
	if($('.productID').val()!="") {
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Pharmacy", "action"=>"getProductInventory"]); ?>',
		type: "POST",
		data: {'productID' : $('.productID').val()},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			var obj = $.parseJSON(data);
			if(obj!="") {
			jQuery.each(obj, function(i, val)
			{
				$("#batchCode_"+countClass).append('<option value="'+val.id+'">'+val.batch_no+'</option>');
			}); }
			else
			{
				$("#batchCode_"+countClass).append('<option value="">Select Batch</option>');
			}
		}
	}); }
});

$('body').on('click','.removeInventory',function()
{
	$(this).closest(".appendDiv").remove();
});
	
});


</script> 

<script type="text/javascript">

	var map;
	var marker;
	var myLatlng = new google.maps.LatLng(28.6026290529761, 77.36447996035463);
	var geocoder = new google.maps.Geocoder();
	var infowindow = new google.maps.InfoWindow();

	function initialize() {
	var mapOptions = {
		zoom: 16
		, center: myLatlng
		, disableDefaultUI: true
		, mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("myMap"), mapOptions);
	marker = new google.maps.Marker({
		map: map
		, position: myLatlng
		, draggable: true
		, icon: '../images/workshop-icon.png'
	});

	geocoder.geocode({
		'latLng': myLatlng
	}, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			if (results[0]) {
				$('#latitude,#longitude').show();
				$('#address').val(results[0].formatted_address);
				$('#latitude').val(marker.getPosition().lat());
				$('#longitude').val(marker.getPosition().lng());
				infowindow.setContent(results[0].formatted_address);
				infowindow.open(map, marker);
			}
		}
	});

	google.maps.event.addListener(marker, 'dragend', function () {
		geocoder.geocode({
			'latLng': marker.getPosition()
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					$('#address').val(results[0].formatted_address);
					$('#latitude').val(marker.getPosition().lat());
					$('#longitude').val(marker.getPosition().lng());
					infowindow.setContent(results[0].formatted_address);
					infowindow.open(map, marker);
				}
			}
		});
	});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
	
</script>

</body>