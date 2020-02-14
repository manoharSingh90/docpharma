
<?php
echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.js','pharmacy/bootstrap-multiselect.js','jquery.MultiFile-minified.js']);
?>
	
<body>
	
	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>
	
	<div class="main-wraper clearfix">
		<div class="container">
			<div>
				<ul class="customHeadWrap row">
					<li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" class="backLink text-uppercase"><img src="<?php echo PATH."img/doctor/back-arrow.png" ?>"> Back</a>
						<div class="customHead"> <b><img src="<?php echo PATH."img/doctor/doctor-app.png" ?>" alt="" /></b> <span>Consultation</span> </div>
					</li>
					<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
						<div class="headLink"> <a href="javascript:void(0);" class="pull-right btn btn-primary text-uppercase checkValidation1 sendFinalMail" data-toggle="modal" data-target="#saveModal-popup">Save </a> <a href="javascript:void(0);" data-toggle="modal" data-target="#cancelModal" class="pull-right btn btn-default text-uppercase">Cancel</a> </div>
					</li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="doctorWrap">
						<div class="userViewwrap">
							<h3 class="doctorTitle">Patient Information</h3>
							<ul class="clearfix userViewlist">
								<li class="col-lg-3 col-md-3 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">FULL NAME</label>
										<p><?php echo isset($appointmentDetails["patient_detail"]["fname"]) ? $appointmentDetails["patient_detail"]["fname"]." ".$appointmentDetails["patient_detail"]["mname"]." ".$appointmentDetails["patient_detail"]["lname"] : ""; ?></p>
									</div>
								</li>
								
								<?php
								$currentYear = date("Y");
								$dob = explode(" ",$appointmentDetails["patient_detail"]["dob"]); ?>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">AGE (Date Of Birth)</label>
										<p><?php echo $currentYear - $dob[2]; ?> (<?php echo isset($appointmentDetails["patient_detail"]["dob"]) ? $appointmentDetails["patient_detail"]["dob"] : ""; ?>)</p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">Gender</label>
										<p><?php echo isset($appointmentDetails["patient_detail"]["gender"]) ? $appointmentDetails["patient_detail"]["gender"] : ""; ?></p>
									</div>
								</li>
								
								<?php
								$explodeCode = isset($appointmentDetails["patient_detail"]["country_code"]) ? explode(",",$appointmentDetails["patient_detail"]["country_code"]) : "";
								$explodePhone = isset($appointmentDetails["patient_detail"]["m_number"]) ? explode(",",$appointmentDetails["patient_detail"]["m_number"]) : "";
								?>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">PHONE NUMBER</label>
										<?php
										if(isset($explodeCode) && !empty($explodeCode)) {
										foreach($explodeCode as $key => $value) {
										?>
										<p><?php echo $value." ".$explodePhone[$key]; ?></p>
										<?php } } ?>
									</div>
								</li>
								
								<?php
								$explodeEmail = isset($appointmentDetails["patient_detail"]["email"]) ? explode(",",$appointmentDetails["patient_detail"]["email"]) : "";
								?>
								<li class="col-lg-3 col-md-3 col-sm-12">
									<div class="customformwrap">
										<label class="customLabel">Email</label>
										<?php
										if(isset($explodeEmail) && !empty($explodeEmail)) {
										foreach($explodeEmail as $key => $value) {
										?>
										<p><?php echo $value; ?></p>
										<?php } } ?>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-12 pull-right text-right">
									<div class="usermoreOpction"> <a href="#" class="viewmodalclick" data-toggle="modal" data-target="#viewdetails-Modal">View Details</a> </div>
								</li>
							</ul>
						</div>
						<div class="userViewwrap">
							<h3 class="doctorTitle">Appoinment information</h3>
							<ul class="clearfix userViewlist">
								<li class="col-lg-3 col-md-3 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">Date of Appointment</label>
										<p><?php echo isset($appointmentDetails["appointment_date"]) ? $appointmentDetails["appointment_date"] : ""; ?></p>
									</div>
								</li>
								<li class="col-lg-2 col-md-2 col-sm-6">
									<div class="customformwrap">
										<label class="customLabel">Time of Appointment</label>
										<p><?php echo isset($appointmentDetails["appointment_time"]) ? $appointmentDetails["appointment_time"] : ""; ?></p>
									</div>
								</li>
								<li class="col-lg-6 col-md-6 col-sm-12">
									<div class="customformwrap">
										<label class="customLabel">Comments</label>
										<p><?php echo isset($appointmentDetails["comments"]) ? $appointmentDetails["comments"] : ""; ?></p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-5 col-sm-12 text-right" style="display:none;">
				<span class="text-uppercase text-link">
					<a class="text-uppercase text-link productPopup" href="#" data-toggle="modal" data-target="#productPopup">ProductPopup</a>
				</span>
			</div>
			
			<!-- PRESCRIPTION DETAILS -->
			<div class="row">
				<?php echo $this->element("Appointment/prescription_right_details"); ?>
				<div class="leftDiv">
					<?php echo $this->element("Appointment/prescription_left_details"); ?>
				</div>
			</div>
			<!-- PRESCRIPTION DETAILS -->
			
		</div>
	</div>
	
	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
	
	<!---- POPUP  ------>
	<div class="modal modalpopup confirmpop" id="addnewaddress" style="display:none;">
		<div class="modalpopup-container medium-modal">
			<div class="modalpopup-header">
				<h2 class="modalpopup-title">ADD NEW ADDRESS</h2> <a href="#" class="closeClick" rel="modal:close">&times;</a> </div>
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
									<input type="text" id="latitude" placeholder="Latitude" class="custominput" /> </div>
								<div class="customformwrap">
									<input type="text" id="longitude" placeholder="Longitude" class="custominput" /> </div>
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
										<input id="address" type="text" class="custominput" value="110032" /> </div>
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
	<!---- REMARK POPUP  ------>
	<div class="modal modalpopup confirmpop" id="remarkpopup" style="display:none;">
		<div class="modalpopup-container medium-modal">
			<div class="modalpopup-header">
				<h2 class="modalpopup-title">Customer Remarks</h2> <a href="#" class="closeClick" rel="modal:close">&times;</a> </div>
			<div class="modalpopup-content">
				<div class="remarkarea">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
						<textarea class="customtexrarea"></textarea>
						<div class="centerAlign"> <span class="defaultBtn belu">Add</span> </div>
					</div>
				</div>
				<hr />
				<div class="previewRemark clearfix">
					<div class="customformwrap clearfix">
						<div class="customLabel">Preview Remarks</div>
					</div>
					<ul>
						<li class="clearfix">
							<div class="perviewRemarkHeader clearfix"> <span class="col-lg-9 col-md-9 col-sm-10 col-xs-10"><span>Added On 21st Jan, 2017</span></span> <span class="col-lg-3 col-md-3 col-sm-3 col-xs-2 alignright"> <b class="pull-right togglearrow"><i class="sprite arrowupIcon"></i></b> <b class="pull-right"><i class="sprite deleteIcon deleteClick"></i></b> </span> </div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 togglelistwrap">
								<p>After this code executes, clicking on Trigger the handler will also alert the message. The click event is only triggered after this exact series of events: The mouse button is depressed while the pointer is inside the element.</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!---- GENERICS POPUP  ------>
	<div class="modal modalpopup genericmpdal" id="remarkpopup" style="display:none;">
		<div class="modalpopup-container modal-md">
			<div class="modalpopup-header">
				<h2 class="modalpopup-title">Generics</h2> <a href="#" class="closeClick" rel="modal:close">&times;</a> </div>
			<div class="modalpopup-content">
				<div class="genericsWrap">
					<div class="row">
						<ul class="generic_wrap">
							<li class="clearfix">
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<div class="customformwrap">
										<label class="customLabel">PRODUCT NAME</label>
										<input type="text" class="custominput" value="Alegra 125 MG"> <small class="outstock">(Out Of Stock)</small> </div>
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
											<input type="radio" name="gender"> <b></b> <span>HISTAFREE 180 MG</span> <small> (Mankind Pharma Ltd - Rs. 143)</small></label>
									</div>
								</div>
								<div class="modalgenerics">
									<div class="customradio">
										<label>
											<input type="radio" name="gender"> <b></b> <span>FEXOVA 180 MG</span> <small> (Ipca Laboratories Ltd - Rs. 156)</small></label>
									</div>
								</div>
								<div class="modalgenerics">
									<div class="customradio">
										<label>
											<input type="radio" name="gender"> <b></b> <span>HISTAFREE 180 MG</span> <small> (Mankind Pharma Ltd - Rs. 143)</small></label>
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
	<!-- MODAL -->
	<div id="updateModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add to Order Form</h4> </div>
				<div class="modal-body">
					<div class="directOrder">
						<div class="row">
							<div class="col-sm-6">Alegra 125 MG</div>
							<div class="col-sm-6">
								<input class="form-control" type="text" /> <small class="text-muted pull-right" style="padding-top:.75rem; padding-right:.5rem;">Qty.</small> </div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="centerAlign"> <a href="#" class="defaultBtn">Cancel</a> <a href="#" class="defaultBtn belu">Add</a> </div>
				</div>
			</div>
		</div>
	</div>
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
											<label class="customLabel">FULL NAME</label>
											<p><?php echo isset($appointmentDetails["patient_detail"]["fname"]) ? $appointmentDetails["patient_detail"]["fname"]." ".$appointmentDetails["patient_detail"]["mname"]." ".$appointmentDetails["patient_detail"]["lname"] : ""; ?></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Phone Number</label>
											<p><?php echo isset($appointmentDetails["patient_detail"]["m_number"]) ? $appointmentDetails["patient_detail"]["m_number"] : ""; ?></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">AGE (DATE OF BIRTH)</label>
											<p><?php echo $currentYear - $dob[2]; ?> (<?php echo isset($appointmentDetails["patient_detail"]["dob"]) ? $appointmentDetails["patient_detail"]["dob"] : ""; ?>)</p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Email</label>
											<p><?php echo isset($appointmentDetails["patient_detail"]["email"]) ? $appointmentDetails["patient_detail"]["email"] : ""; ?></p>
										</div>
									</li>
									<li>
										<div class="customformwrap">
											<label class="customLabel">Address</label>
											<p><?php echo isset($appointmentDetails["patient_detail"]["address"]) ? $appointmentDetails["patient_detail"]["address"].", ".$appointmentDetails["patient_detail"]["state"].", ".$appointmentDetails["patient_detail"]["country"]." ".$appointmentDetails["patient_detail"]["pincode"] : ""; ?></p>
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
	<!-- EDIT APP Modal -->
	<div id="createpatient-Modal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Patient Information</h4> </div>
				<div class="modal-body">
					<form class="create-patient-form">
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">First Name</label>
								<input type="text" class="custominput"> </div>
						</fieldset>
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">Middle Name</label>
								<input type="text" class="custominput"> </div>
						</fieldset>
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">Last Name</label>
								<input type="text" class="custominput"> </div>
						</fieldset>
						<fieldset>
							<label class="datebirtdTitle clearfix">Date Of Birth</label>
							<div class="customformwrap dateslt">
								<select class="custominput singleselect ">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
									<option>6</option>
									<option>7</option>
									<option>8</option>
									<option>9</option>
									<option>10</option>
									<option>11</option>
									<option>12</option>
									<option>13</option>
									<option>14</option>
									<option>15</option>
									<option>16</option>
									<option>17</option>
									<option>18</option>
									<option>19</option>
									<option>20</option>
									<option>21</option>
									<option>22</option>
									<option>23</option>
									<option>24</option>
									<option>25</option>
									<option>26</option>
									<option>27</option>
									<option>28</option>
									<option>29</option>
									<option>30</option>
								</select>
							</div>
							<div class="customformwrap monthslt">
								<select class="custominput singleselect ">
									<option>Jan</option>
									<option>Feb</option>
									<option>Mar</option>
									<option>Apr</option>
									<option>May</option>
									<option>Jun</option>
									<option>July</option>
									<option>Aug</option>
									<option>Sep</option>
									<option>Oct</option>
									<option>Nov</option>
									<option>Dec</option>
								</select>
							</div>
							<div class="customformwrap yearslt">
								<select class="custominput singleselect ">
									<option>1991</option>
									<option>1992</option>
									<option>1993</option>
									<option>1994</option>
									<option>1995</option>
									<option>1996</option>
									<option>1997</option>
									<option>1998</option>
									<option>1999</option>
									<option>2000</option>
									<option>2001</option>
									<option>2002</option>
									<option>2003</option>
									<option>2004</option>
									<option>2005</option>
									<option>2006</option>
									<option>2007</option>
									<option>2008</option>
									<option>2009</option>
									<option>2010</option>
									<option>2011</option>
									<option>2012</option>
									<option>2013</option>
									<option>2014</option>
									<option>2015</option>
									<option>2016</option>
									<option>2017</option>
									<option>2018</option>
								</select>
							</div>
						</fieldset>
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">Mobile Number</label>
								<input type="text" class="custominput"> </div>
						</fieldset>
						<fieldset>
							<div class="customformwrap">
								<label class="customLabel">Email Address</label>
								<input type="text" class="custominput"> </div>
						</fieldset>
						<fieldset class="address-fieldset">
							<div class="customformwrap">
								<label class="customLabel">Address</label>
								<input type="text" class="custominput">
								<input type="text" class="custominput"> </div>
						</fieldset>
						<fieldset class="contryformwrap">
							<div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
								<label class="customLabel">Country</label>
								<select class="custominput singleselect ">
									<option>1</option>
								</select>
							</div>
							<div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
								<label class="customLabel">State</label>
								<select class="custominput singleselect ">
									<option>1</option>
								</select>
							</div>
						</fieldset>
						<fieldset class="contryformwrap">
							<div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
								<label class="customLabel">City</label>
								<select class="custominput singleselect ">
									<option>1</option>
								</select>
							</div>
							<div class="customformwrap col-lg-6 col-md-6 col-lg-6 col-sm-12">
								<label class="customLabel">Pincode</label>
								<input type="text" class="custominput"> </div>
						</fieldset>
					</form>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary text-uppercase">Add</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Cancel Modal -->
	<div id="cancelModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cancel APPOINTMENT</h4> </div>
				<div class="modal-body text-center">
					<p>Are you sure you want to cancel appointment?</p>
				</div>
				<div class="modal-footer text-center"> <a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">No</a> <a href="<?php echo $this->url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" class="btn btn-primary text-uppercase">Yes</a> </div>
			</div>
		</div>
	</div>
	<!-- SAVE Modal -->
	<div id="saveModal-popup" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Save APPOINTMENT</h4> </div>
				<div class="modal-body text-center">
					<p>Are you sure you want to save appointment?</p>
				</div>
				<div class="modal-footer text-center"> <a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">No</a> <a href="<?php echo $this->url->build(["controller"=>"Appointment","action"=>"listing"]); ?>" class="btn btn-primary text-uppercase">Yes</a> </div>
			</div>
		</div>
	</div>
	<!-- PRINT Modal -->
	<div id="printModal-popup" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Preview</h4>
				</div>
				<div class="modal-body">

				<?php
				if(isset($prescriptionData) && !empty($prescriptionData)) {
				
				$popupData = array();
				foreach($prescriptionData as $key => $value) {
				if(date("d M Y")==$value["visit_date"]) {
					$popupData["doctor_Fname"] = $value["doctor_Fname"];
					$popupData["doctor_Mname"] = $value["doctor_Mname"];
					$popupData["doctor_Lname"] = $value["doctor_Lname"];
					$popupData["patient_title"] = $value["patient_title"];
					$popupData["patient_Fname"] = $value["patient_Fname"];
					$popupData["patient_Mname"] = $value["patient_Mname"];
					$popupData["patient_Lname"] = $value["patient_Lname"];
					$popupData["patient_dob"] = $value["patient_dob"];
					$popupData["patient_address"] = $value["patient_address"];
					$popupData["patient_country"] = $value["patient_country"];
					$popupData["patient_state"] = $value["patient_state"];
					$popupData["visit_date"] = $value["visit_date"];
					$popupData["observation"] = $value["observation"];
					$popupData["patient_notes"] = $value["patient_notes"];
					$popupData["medicine"][$key]["notes"] = $value["notes"];
					$popupData["medicine"][$key]["product_name"] = $value["product_name"];
					$popupData["medicine"][$key]["product_type"] = $value["product_type"];
					$popupData["medicine"][$key]["dosage_qty"] = $value["dosage_qty"];
					$popupData["medicine"][$key]["duration_no"] = $value["duration_no"];
					$popupData["medicine"][$key]["duration_frequency"] = $value["duration_frequency"];
					$popupData["medicine"][$key]["total_qty"] = $value["total_qty"];
					$popupData["medicine"][$key]["day_of_week"] = $value["day_of_week"];
					$popupData["medicine"][$key]["morning"] = $value["morning"];
					//$popupData["medicine"][$key]["midday"] = $value["midday"];
					$popupData["medicine"][$key]["afternoon"] = $value["afternoon"];
					$popupData["medicine"][$key]["evening"] = $value["evening"];
					$popupData["medicine"][$key]["dinner"] = $value["dinner"];
					$popupData["medicine"][$key]["morning_quantity"] = $value["morning_quantity"];
					$popupData["medicine"][$key]["afternoon_quantity"] = $value["afternoon_quantity"];
					$popupData["medicine"][$key]["evening_quantity"] = $value["evening_quantity"];
					$popupData["medicine"][$key]["dinner_quantity"] = $value["dinner_quantity"];
					$popupData["medicine"][$key]["custom_times"] = $value["custom_times"];
					$popupData["medicine"][$key]["abbreviation"] = $value["abbreviation"];
					$popupData["medicine"][$key]["abbreviation_meaning"] = $value["abbreviation_meaning"];
				} }

				if(isset($popupData) && !empty($popupData)) {
				?>
					<div class="perviewWrap" id="printData">
						<div class="clearfix printHead">
							<h3 class="pull-left"><?php echo isset($popupData["visit_date"]) ? $popupData["visit_date"] : ""; ?></h3>
							<div class="pull-right">
								<div class="pull-left text-right patientInfo">
									<p>Patient - <?php echo $popupData["patient_title"].". ".$popupData["patient_Fname"]." ".$popupData["patient_Mname"]." ".$popupData["patient_Lname"]; ?></p>
									<p>DOB - <?php echo $popupData["patient_dob"]; ?></p>
									<p>Address - <?php echo $popupData["patient_address"].", ".$popupData["patient_state"].", ".$popupData["patient_country"]; ?></p>
									<small>Doctor - <?php echo "Dr. ".$popupData["doctor_Fname"]." ".$popupData["doctor_Mname"]." ".$popupData["doctor_Lname"]; ?></small>
								</div>	
								<div class="pull-right text-right qrCode">
									<img src="<?php echo PATH."img/doctor/qrcode.png"; ?>">
								</div>
							</div>
						</div>
						<ul class="appoin-sub-wrap">
							<li class="appoin-sub-list">
								<h3 class="clearfix">Observation</h3>
								<p><?php echo isset($popupData["observation"]) ? $popupData["observation"] : ""; ?></p>
							</li>
							<li class="appoin-sub-list" style="display:<?php echo isset($popupData["medicine"][0]["product_name"]) && !empty($popupData["medicine"][0]["product_name"]) ? "block" : "none"; ?>">
								<h3 class="clearfix">Prescription</h3>
								<!--<p><?php //echo isset($popupData["notes"]) ? $popupData["notes"] : ""; ?></p>-->
								<div class="tablewrap" style="min-height:200px;">
									<table class="customerTable" style="width:100%">
										<thead>
											<tr>
												<th>S.No.</th>
												<th>Medicine</th>
												<th>Quantity</th>
												<th>Dosage</th>
												<th>Duration</th>
												<th>Notes</th>
											</tr>
										</thead>
										<tbody>
							
								<?php
								foreach(array_values($popupData["medicine"]) as $mKey => $mValue) {
								if(!empty($mValue["product_name"])) {
								$dayCheck = isset($mValue["day_of_week"]) && !empty($mValue["day_of_week"]) ? ' ('.$mValue["day_of_week"].')' : ""; ?>
									<tr>
										<td><?php echo $mKey+1; ?></td>
										<td><?php echo isset($mValue["product_name"]) ? $mValue["product_name"] : ""; ?></td>
										<td><?php echo $mValue["total_qty"]." ".$mValue["product_type"]; ?></td>
										<td>
										
										<?php
										if(strpos(strtolower($mValue["product_type"]), 'patch') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-01.png";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'gel') !== false || strpos(strtolower($mValue["product_type"]), 'cream') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-02.png";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'inj') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-03.png";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'cap') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-04.png";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'tab') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-05.png";
										}
										else
										{
											$drugsImage = "";
										} ?>
										
										<ul class="tablateicon">
											<?php if($mValue["morning"] && !empty($mValue["morning"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["morning"]=="Anytime" ? "Take in the Morning (".$mValue["morning_quantity"]." ".$mValue["product_type"].")" : "Take in the Morning ".$mValue["morning"]." Food (".$mValue["morning_quantity"]." ".$mValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($mValue["afternoon"] && !empty($mValue["afternoon"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["afternoon"]=="Anytime" ? "Take in the Afternoon (".$mValue["afternoon_quantity"]." ".$mValue["product_type"].")" : "Take in the Afternoon ".$mValue["afternoon"]." Food (".$mValue["afternoon_quantity"]." ".$mValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($mValue["evening"] && !empty($mValue["evening"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["evening"]=="Anytime" ? "Take in the Evening (".$mValue["evening_quantity"]." ".$mValue["product_type"].")" : "Take in the Evening ".$mValue["evening"]." Food (".$mValue["evening_quantity"]." ".$mValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($mValue["dinner"] && !empty($mValue["dinner"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["dinner"]=="Anytime" ? "Take at Night (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")" : "Take at Night ".$mValue["dinner"]." Food (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($mValue["custom_times"] && !empty($mValue["custom_times"])) {
											$customTimes = json_decode($mValue["custom_times"],true); ?>
											<?php foreach($customTimes as $timesKey => $timesValue) { ?><li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $timesValue["time"]." (".$timesValue["abbreviation_meaning"].")"; ?> </small>
											</li>
											<?php } } ?>
											<?php if($mValue["abbreviation_meaning"] && !empty($mValue["abbreviation_meaning"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["abbreviation_meaning"]; ?> </small>
											</li>
											<?php } ?>
										</ul>
										</td>
										<td><?php echo $mValue["duration_no"]." ".$mValue["duration_frequency"].$dayCheck; ?></td>
										<td><?php echo isset($mValue["notes"]) ? $mValue["notes"] : ""; ?></td>
									</tr>
								<?php } } ?>

										</tbody>
									</table>
								</div>
							</li>
							<li class="appoin-sub-list">
								<h3 class="clearfix">Notes for Patient</h3>
								<p><?php echo isset($popupData["patient_notes"]) ? $popupData["patient_notes"] : ""; ?></p>
							</li>
							<li class="appoin-sub-list">
								<h3 class="clearfix">Recommended Tests</h3>
								<?php
								if(!empty($testReportData)) {
								$count=0;
								foreach($testReportData as $key => $value) {
								if($value["test_recommended"]==1) { $count++; ?>
								<ol>
									<li>
										<p><?php echo $count.". ".$value["test_name"]; ?></p>
									</li>
								</ol>
								<?php } } } ?>
							</li>
						</ul>
					</div>
				<?php } } ?>
				</div>
				<div class="modal-footer text-center"> <a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</a>
				<?php if(isset($prescriptionData) && !empty($prescriptionData)) { ?>
				<a href="<?php echo $this->url->build(["controller"=>"Appointment","action"=>"printdata",base64_encode($appointmentDetails["id"])]); ?>" target="_blank" class="btn btn-primary text-uppercase printDiv">Print</a>
				<?php }
				else { ?>
				<a class="btn btn-primary text-uppercase printDiv" disabled>Print</a>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>

<!-- EMAIL Modal -->
	<div id="emailModal-popup" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Preview</h4> </div>
				<div class="modal-body">
				<?php
				if(isset($prescriptionData) && !empty($prescriptionData)) {
				
				$popupData = array();
				foreach($prescriptionData as $key => $value) {
				if(date("d M Y")==$value["visit_date"]) {
					$popupData["doctor_Fname"] = $value["doctor_Fname"];
					$popupData["doctor_Mname"] = $value["doctor_Mname"];
					$popupData["doctor_Lname"] = $value["doctor_Lname"];
					$popupData["patient_title"] = $value["patient_title"];
					$popupData["patient_Fname"] = $value["patient_Fname"];
					$popupData["patient_Mname"] = $value["patient_Mname"];
					$popupData["patient_Lname"] = $value["patient_Lname"];
					$popupData["patient_dob"] = $value["patient_dob"];
					$popupData["patient_address"] = $value["patient_address"];
					$popupData["patient_country"] = $value["patient_country"];
					$popupData["patient_state"] = $value["patient_state"];
					$popupData["visit_date"] = $value["visit_date"];
					$popupData["observation"] = $value["observation"];
					$popupData["patient_notes"] = $value["patient_notes"];
					$popupData["medicine"][$key]["notes"] = $value["notes"];
					$popupData["medicine"][$key]["product_name"] = $value["product_name"];
					$popupData["medicine"][$key]["product_type"] = $value["product_type"];
					$popupData["medicine"][$key]["dosage_qty"] = $value["dosage_qty"];
					$popupData["medicine"][$key]["duration_no"] = $value["duration_no"];
					$popupData["medicine"][$key]["duration_frequency"] = $value["duration_frequency"];
					$popupData["medicine"][$key]["total_qty"] = $value["total_qty"];
					$popupData["medicine"][$key]["day_of_week"] = $value["day_of_week"];
					$popupData["medicine"][$key]["morning"] = $value["morning"];
					//$popupData["medicine"][$key]["midday"] = $value["midday"];
					$popupData["medicine"][$key]["afternoon"] = $value["afternoon"];
					$popupData["medicine"][$key]["evening"] = $value["evening"];
					$popupData["medicine"][$key]["dinner"] = $value["dinner"];
					$popupData["medicine"][$key]["morning_quantity"] = $value["morning_quantity"];
					$popupData["medicine"][$key]["afternoon_quantity"] = $value["afternoon_quantity"];
					$popupData["medicine"][$key]["evening_quantity"] = $value["evening_quantity"];
					$popupData["medicine"][$key]["dinner_quantity"] = $value["dinner_quantity"];
					$popupData["medicine"][$key]["custom_times"] = $value["custom_times"];
					$popupData["medicine"][$key]["abbreviation"] = $value["abbreviation"];
					$popupData["medicine"][$key]["abbreviation_meaning"] = $value["abbreviation_meaning"];
				} }

				if(isset($popupData) && !empty($popupData)) {
				?>
					<div class="perviewWrap" id="printData">
						<div class="clearfix printHead">
							<h3 class="pull-left"><?php echo isset($popupData["visit_date"]) ? $popupData["visit_date"] : ""; ?></h3>
							<div class="pull-right">
								<div class="pull-left text-right patientInfo">
									<p>Patient - <?php echo $popupData["patient_title"].". ".$popupData["patient_Fname"]." ".$popupData["patient_Mname"]." ".$popupData["patient_Lname"]; ?></p>
									<p>DOB - <?php echo $popupData["patient_dob"]; ?></p>
									<p>Address - <?php echo $popupData["patient_address"].", ".$popupData["patient_state"].", ".$popupData["patient_country"]; ?></p>
									<small>Doctor - <?php echo "Dr. ".$popupData["doctor_Fname"]." ".$popupData["doctor_Mname"]." ".$popupData["doctor_Lname"]; ?></small>
								</div>	
								<div class="pull-right text-right qrCode">
									<img src="<?php echo PATH."img/doctor/qrcode.png"; ?>">
								</div>
							</div>
						</div>
						<ul class="appoin-sub-wrap">
							<li class="appoin-sub-list">
								<h3 class="clearfix">Observation</h3>
								<p><?php echo isset($popupData["observation"]) ? $popupData["observation"] : ""; ?></p>
							</li>
							<li class="appoin-sub-list" style="display:<?php echo isset($popupData["medicine"][0]["product_name"]) && !empty($popupData["medicine"][0]["product_name"]) ? "block" : "none"; ?>">
								<h3 class="clearfix">Prescription</h3>
								<p><?php echo isset($popupData["notes"]) ? $popupData["notes"] : ""; ?></p>
								<div class="tablewrap" style="min-height:200px;">
									<table class="customerTable" style="width:100%">
										<thead>
											<tr>
												<th>S.No.</th>
												<th>Medicine</th>
												<th>Quantity</th>
												<th>Dosage</th>
												<th>Duration</th>
												<th>Notes</th>
											</tr>
										</thead>
										<tbody>
							
								<?php
								foreach(array_values($popupData["medicine"]) as $mKey => $mValue) {
								if(!empty($mValue["product_name"])) {
								$dayCheck = isset($mValue["day_of_week"]) && !empty($mValue["day_of_week"]) ? ' ('.$mValue["day_of_week"].')' : ""; ?>
									<tr>
										<td><?php echo $mKey+1; ?></td>
										<td><?php echo isset($mValue["product_name"]) ? $mValue["product_name"] : ""; ?></td>
										<td><?php echo $mValue["total_qty"]." ".$mValue["product_type"]; ?></td>
										<td>
										
										<?php
										if(strpos(strtolower($mValue["product_type"]), 'patch') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-01.png";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'gel') !== false || strpos(strtolower($mValue["product_type"]), 'cream') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-02.png";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'inj') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-03.png";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'cap') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-04.png";
										}
										else if(strpos(strtolower($mValue["product_type"]), 'tab') !== false)
										{
											$drugsImage = PATH."img/doctor/pharmacyicon/Icon-05.png";
										}
										else
										{
											$drugsImage = "";
										} ?>
										
										<ul class="tablateicon">
											<?php if($mValue["morning"] && !empty($mValue["morning"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["morning"]=="Anytime" ? "Take in the Morning (".$mValue["morning_quantity"]." ".$mValue["product_type"].")" : "Take in the Morning ".$mValue["morning"]." Food (".$mValue["morning_quantity"]." ".$mValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($mValue["afternoon"] && !empty($mValue["afternoon"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["afternoon"]=="Anytime" ? "Take in the Afternoon (".$mValue["afternoon_quantity"]." ".$mValue["product_type"].")" : "Take in the Afternoon ".$mValue["afternoon"]." Food (".$mValue["afternoon_quantity"]." ".$mValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($mValue["evening"] && !empty($mValue["evening"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["evening"]=="Anytime" ? "Take in the Evening (".$mValue["evening_quantity"]." ".$mValue["product_type"].")" : "Take in the Evening ".$mValue["evening"]." Food (".$mValue["evening_quantity"]." ".$mValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($mValue["dinner"] && !empty($mValue["dinner"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["dinner"]=="Anytime" ? "Take at Night (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")" : "Take at Night ".$mValue["dinner"]." Food (".$mValue["dinner_quantity"]." ".$mValue["product_type"].")"; ?> </small></li>
											<?php } ?>
											<?php if($mValue["custom_times"] && !empty($mValue["custom_times"])) {
											$customTimes = json_decode($mValue["custom_times"],true); ?>
											<?php foreach($customTimes as $timesKey => $timesValue) { ?><li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $timesValue["time"]." (".$timesValue["abbreviation_meaning"].")"; ?> </small>
											</li>
											<?php } } ?>
											<?php if($mValue["abbreviation_meaning"] && !empty($mValue["abbreviation_meaning"])) { ?>
											<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $mValue["abbreviation_meaning"]; ?> </small>
											</li>
											<?php } ?>
										</ul>
										</td>
										<td><?php echo $mValue["duration_no"]." ".$mValue["duration_frequency"].$dayCheck; ?></td>
										<td><?php echo isset($mValue["notes"]) ? $mValue["notes"] : ""; ?></td>
									</tr>
								<?php } } ?>

										</tbody>
									</table>
								</div>
							</li>
							<li class="appoin-sub-list">
								<h3 class="clearfix">Notes for Patient</h3>
								<p><?php echo isset($popupData["patient_notes"]) ? $popupData["patient_notes"] : ""; ?></p>
							</li>
							<li class="appoin-sub-list">
								<h3 class="clearfix">Recommended Tests</h3>
								<?php
								if(!empty($testReportData)) {
								$count=0;
								foreach($testReportData as $key => $value) {
								if($value["test_recommended"]==1) { $count++; ?>
								<ol>
									<li>
										<p><?php echo $count.". ".$value["test_name"]; ?></p>
									</li>
								</ol>
								<?php } } } ?>
							</li>
							
							<li class="appoin-sub-list">
								<h3 class="clearfix">Email To :</h3>
								<?php $emailToSend = explode(",",$appointmentDetails["patient_detail"]["email"]); ?>
								<p><input type="text" class="emailToSend" size="25" value="<?php echo $emailToSend[0]; ?>"></p>
								<p class="emailErrorMessage" style="display:none; color:red;">Enter Email</p>
							</li>
							
						</ul>
						
					</div>
				<?php } } ?>
				
				</div>

				<div class="emailMessage" style="display:none; text-align:center; color:green;">Mail sent successfully</div>

				<div class="modal-footer text-center"> <a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">No</a> <a href="javascript:void(0);" class="btn btn-primary text-uppercase emailPrescription">Email</a> </div>

				<textarea rows="5" cols="15" class="emailPrescriptionData" style="display:none;"><?php echo json_encode($prescriptionData); ?></textarea>

			</div>
		</div>
	</div>
	
<!-- REPEAT MEDICION Modal -->
<div id="repeatmediction-popup" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Repeat Medication</h4>
			</div>
			<div class="modal-body">
				<div class="perviewWrap">
					<ul class="appoin-sub-wrap">
						<li class="appoin-sub-list">
							<div class="tablewrap">
								<table class="customerTable" style="width:100%">
									<thead>
										<tr>
											<th>Select</th>
											<th>Medicine</th>
											<th>Quantity</th>
											<th>Dosage</th>
											<th>Duration</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if(isset($medicationData) && !empty($medicationData)) {
										foreach($medicationData as $key => $value) {
										
										$dayCheck = isset($value["day_of_week"]) && !empty($value["day_of_week"]) ? ' ('.$value["day_of_week"].')' : ""; ?>
										
										<tr>
											<td>
												<div class="customcheckbox timeCheck">
													<label>
														<input type="radio" name="selectMedication" value="<?php echo $value["id"]; ?>" <?php echo $key==0 ? "checked" : ""; ?> > <b></b> </label>
												</div>
											</td>
											<td><?php echo $value["product_name"]; ?></td>
											<td><?php echo $value["total_qty"]." ".$value["product_type"]; ?></td>
											<td>
											
											<?php
											if(strpos(strtolower($value["product_type"]), 'patch') !== false)
											{
												$drugsImage = PATH."img/doctor/pharmacyicon/Icon-01.png";
											}
											else if(strpos(strtolower($mValue["product_type"]), 'gel') !== false || strpos(strtolower($value["product_type"]), 'cream') !== false)
											{
												$drugsImage = PATH."img/doctor/pharmacyicon/Icon-02.png";
											}
											else if(strpos(strtolower($value["product_type"]), 'inj') !== false)
											{
												$drugsImage = PATH."img/doctor/pharmacyicon/Icon-03.png";
											}
											else if(strpos(strtolower($value["product_type"]), 'cap') !== false)
											{
												$drugsImage = PATH."img/doctor/pharmacyicon/Icon-04.png";
											}
											else if(strpos(strtolower($value["product_type"]), 'tab') !== false)
											{
												$drugsImage = PATH."img/doctor/pharmacyicon/Icon-05.png";
											}
											else
											{
												$drugsImage = "";
											} ?>
											
											<ul class="tablateicon">
												<?php if($value["morning"] && !empty($value["morning"])) { ?>
												<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $value["morning"]=="Anytime" ? "Take in the Morning (".$value["morning_quantity"]." ".$value["product_type"].")" : "Take in the Morning ".$value["morning"]." Food (".$value["morning_quantity"]." ".$value["product_type"].")"; ?> </small></li>
												<?php } ?>
												<?php if($value["afternoon"] && !empty($value["afternoon"])) { ?>
												<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $value["afternoon"]=="Anytime" ? "Take in the Afternoon (".$value["afternoon_quantity"]." ".$value["product_type"].")" : "Take in the Afternoon ".$value["afternoon"]." Food (".$value["afternoon_quantity"]." ".$value["product_type"].")"; ?> </small></li>
												<?php } ?>
												<?php if($value["evening"] && !empty($value["evening"])) { ?>
												<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $value["evening"]=="Anytime" ? "Take in the Evening (".$value["evening_quantity"]." ".$value["product_type"].")" : "Take in the Evening ".$value["evening"]." Food (".$value["evening_quantity"]." ".$value["product_type"].")"; ?> </small></li>
												<?php } ?>
												<?php if($value["dinner"] && !empty($value["dinner"])) { ?>
												<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $value["dinner"]=="Anytime" ? "Take at Night (".$value["dinner_quantity"]." ".$value["product_type"].")" : "Take at Night ".$value["dinner"]." Food (".$value["dinner_quantity"]." ".$value["product_type"].")"; ?> </small></li>
												<?php } ?>
												<?php if($value["custom_times"] && !empty($value["custom_times"])) {
												$customTimes = json_decode($value["custom_times"],true); ?>
												<?php foreach($customTimes as $timesKey => $timesValue) { ?><li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $timesValue["time"]." (".$timesValue["abbreviation_meaning"].")"; ?> </small>
												</li>
												<?php } } ?>
												<?php if($value["abbreviation_meaning"] && !empty($value["abbreviation_meaning"])) { ?>
												<li class="drugTiming"><img src="<?php echo $drugsImage; ?>"><small><?php echo $value["abbreviation_meaning"]; ?> </small>
												</li>
												<?php } ?>
											</ul>
											</td>
											<td><?php echo $value["duration_no"]." ".$value["duration_frequency"].$dayCheck; ?></td>
										</tr>
										<?php } } ?>
									</tbody>
								</table>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="modal-footer text-center"> <a href="javascript:void(0);" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</a> <a href="javascript:void(0);" class="btn btn-primary text-uppercase repeatMedication" data-dismiss="modal">Repeat</a> </div>
		</div>
	</div>
</div>


<div id="interaction-popup" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Interaction</h4>
			</div>
			<div class="modal-body">
				<div class="interactionData">
				</div>
			</div>
		</div>
	</div>
</div>


<!---- PRODUCT POPUP  ------>
<div id="productPopup" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg modalpopup" style="max-width:500px;">
		<div class="modal-content modalpopup-container">
			<div class="modal-header text-center modalpopup-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modalpopup-title modalpopup-title">Products</h2>
			</div>
			<div class="modal-body clearfix">
				<div style="overflow:auto; max-height:60vh;">
					<ul class="CIMS_Products">
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
$(document).ready(function () {
	

var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
/* $(".submit").click(function()
{
	$(this).css("pointer-events","none");
	
	var formData = $("form").serialize();
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"saveprescription"]); ?>',  
		type: "POST",
		dataType: 'json',
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		data: formData,
		success: function(data)
		{
			if(data==123)
			{
				location.reload();
			}
		}   
	});
	
}); */


$('body').on('click','.sendFinalMail',function()
{
	var emailID = $(".emailToSend").val();
	var emailData = $(".emailPrescriptionData").text();
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"sendmail"]); ?>',
		type: "POST",
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		data: {'email' : emailID, 'emailData' : emailData},
		success: function(data)
		{
			$(".emailMessage").css("display", "block").fadeOut(3000);
			$(".emailPrescription").prop('disabled', false);
		}   
	});
});

/* var ppID = '<?php echo isset($prescriptionData[0]["ppID"]) ? $prescriptionData[0]["ppID"] : ""; ?>';
var emailStatus = '<?php echo isset($prescriptionData[0]["email_status"]) ? $prescriptionData[0]["email_status"] : ""; ?>';

if(emailStatus!=1)
{
	var emailID = $(".emailToSend").val();
	var emailData = $(".emailPrescriptionData").text();
	
	$(this).prop('disabled', true);
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"sendmail"]); ?>',
		type: "POST",
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		data: {'email' : emailID, 'emailData' : emailData, 'ppID' : ppID},
		success: function(data)
		{
			$(".emailMessage").css("display", "block").fadeOut(3000);
			$(".emailPrescription").prop('disabled', false);
		}   
	});
} */

$('body').on('click','.emailPrescription',function()
{
	var emailID = $(".emailToSend").val();
	var emailData = $(".emailPrescriptionData").text();
	
	if(emailID!="") {
	$(this).prop('disabled', true);
	
	$(".emailMessage").css("display", "block").fadeOut(3000);
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"sendmail"]); ?>',
		type: "POST",
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		data: {'email' : emailID, 'emailData' : emailData},
		success: function(data)
		{
			$(".emailPrescription").prop('disabled', false);
		}   
	});
	}
	else
	{
		$(".emailErrorMessage").css("display", "block").fadeOut(3000);
	}
});

var countFinalSubmit = 1;
$('body').on('click','.checkValidation',function()
{
	if($("#product_name").val()=="" && $(".test_id").val()=="")
	{
		//$(".productErrorClass").css("display","block");
		$(".productTestError").css("display","block");
		return false;
	}
	
	if(countFinalSubmit!=1)
	{
		$(this).prop('disabled', true);
	}
	countFinalSubmit++;
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
		$(".morning").val("Anytime");
		$(".morningAnytime").addClass("active");
		$(".morningInput").attr("readonly",false);
	}
	else
	{
		$(".morning").val("");
		$(".morningAnytime").removeClass("active");
		$(".morningInput").attr("readonly",true);
		$(".morningInput").val("");
	}
});
$('body').on('click','#afternoon',function()
{
	if($(this).is(":checked"))
	{
		$(".afternoon").val("Anytime");
		$(".afternoonAnytime").addClass("active");
		$(".afternoonInput").attr("readonly",false);
	}
	else
	{
		$(".afternoon").val("");
		$(".afternoonAnytime").removeClass("active");
		$(".afternoonInput").attr("readonly",true);
		$(".afternoonInput").val("");
	}
});
$('body').on('click','#evening',function()
{
	if($(this).is(":checked"))
	{
		$(".evening").val("Anytime");
		$(".eveningAnytime").addClass("active");
		$(".eveningInput").attr("readonly",false);
	}
	else
	{
		$(".evening").val("");
		$(".eveningAnytime").removeClass("active");
		$(".eveningInput").attr("readonly",true);
		$(".eveningInput").val("");
	}
});
$('body').on('click','#dinner',function()
{
	if($(this).is(":checked"))
	{
		$(".dinner").val("Anytime");
		$(".dinnerAnytime").addClass("active");
		$(".dinnerInput").attr("readonly",false);
	}
	else
	{
		$(".dinner").val("");
		$(".dinnerAnytime").removeClass("active");
		$(".dinnerInput").attr("readonly",true);
		$(".dinnerInput").val("");
	}
});

$('body').on('click','.morningSchedule',function()
{
	$(".morning").val($(this).text());
});
$('body').on('click','.middaySchedule',function()
{
	$(".midday").val($(this).text());
});
$('body').on('click','.afternoonSchedule',function()
{
	$(".afternoon").val($(this).text());
});
$('body').on('click','.eveningSchedule',function()
{
	$(".evening").val($(this).text());
});
$('body').on('click','.dinnerSchedule',function()
{
	$(".dinner").val($(this).text());
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

$('body').on('change','.attachReport',function()
{
	var extension = this.files[0].name.split('.').pop().toLowerCase();
	
	if(extension=='png' || extension=='jpg' || extension=='jpeg' || extension=='pdf')
	{
		$(".attacheview").text(this.files[0].name);
	}
	else
	{
		alert("Please select png, jpg, jpeg or pdf file");
		return false;
	}
});

$('body').on('click','.repeatMedication',function()
{
	var id = $('input[name=selectMedication]:checked').val();
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"medicationdetails"]); ?>',  
		type: "POST",
		data: {'id' : id},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".medicationData").html(data);
			$(".singleselect").select2();
			$("#product_name").select2({
				dropdownCssClass: "product_name"
			});
		}   
	});
});


$('body').on('click','.donePopupProduct',function()
{
	if($('.pickMed').is(':checked'))
	{
		var product_guid = $('input[name=pickMed]:checked').val().split("_");
		$(".product_name").html('<option value="'+$('input[name=pickMed]:checked').val()+'">'+product_guid[1]+'</option>');
		
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
		
		$(".cancelPopupProduct").click();
		$('input:radio[name=product_search_by]')[0].checked = true;
	}
	else
	{
		alert("Select a product");
		return false;
	}
});


$('body').on('click','.product_search_by',function()
{
	$("#product_name").html('<option value="">Select Product</option>');
});


$('body').on('change','.product_name',function()
{
	var url = window.location.href;
	var dataID = $('.product_name :selected').attr("data-id");
	
	if(url.indexOf('www') != -1) {
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
	else {
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
				if(data!="")
				{
					var obj = $.parseJSON(data);
					if(obj!="") {
					$(".CIMS_Products").html("");
					$(".productPopup").click();
							
					jQuery.each(obj, function(i, val)
					{
						if(val.id!="")
						{
							$(".CIMS_Products").append('<li><label><input type="radio" value="'+val.id+'_'+val.name+'" name="pickMed" class="pickMed"/>'+val.name+'</label></li>');
						}
					}); }
				}
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
				if(data!="")
				{
					var obj = $.parseJSON(data);
					if(obj!="") {
					$(".CIMS_Products").html("");
					$(".productPopup").click();
							
					jQuery.each(obj, function(i, val)
					{
						if(val.id!="")
						{
							$(".CIMS_Products").append('<li><label><input type="radio" value="'+val.id+'_'+val.name+'" name="pickMed" class="pickMed"/>'+val.name+'</label></li>');
						}
					}); }
				}
			}
		});
		}
	}
});

var timeout;
var delay = 1000;
var isLoading = false;
$('body').on('keyup','input.select2-search__field',function()
{
	if($(this).parent().parent().hasClass("product_name")) {
	if(timeout)
    clearTimeout(timeout);
	reloadProduct();
	}
	
	if($(this).parent().parent().hasClass("allergyData")) {
	if(timeout)
    clearTimeout(timeout);
	reloadAllergy();
	}
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
				$("#product_name").html('<option data-id="" value="">Searching .....</option>');
				
				if(url.indexOf('www') != -1) {
				$.ajax({
					url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
					type: "POST",
					data: {'value' : $(".product_name input.select2-search__field").val() , 'type' : 'medicines' , 'product_search_by' : $("input[name='product_search_by']:checked").val()},
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					success: function(data)
					{
						$(".select2-results__option").css("display","none");
						$(".productErrorClass").css("display","none");
						$("#product_name").html("");
						
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
										if(data!="")
										{
											var obj = $.parseJSON(data);
											if(obj!="") {
											$(".CIMS_Products").html("");
											$(".productPopup").click();
													
											jQuery.each(obj, function(i, val)
											{
												if(val.id!="")
												{
													$(".CIMS_Products").append('<li><label><input type="radio" value="'+val.id+'_'+val.name+'" name="pickMed" class="pickMed"/>'+val.name+'</label></li>');
												}
											}); }
										}
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
					}
				});
				}
				else {
				$.ajax({
					url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
					type: "POST",
					data: {'value' : $(".product_name input.select2-search__field").val() , 'type' : 'medicines' , 'product_search_by' : $("input[name='product_search_by']:checked").val()},
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					success: function(data)
					{
						$(".select2-results__option").css("display","none");
						$(".productErrorClass").css("display","none");
						$("#product_name").html("");
						
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
										if(data!="")
										{
											var obj = $.parseJSON(data);
											if(obj!="") {
											$(".CIMS_Products").html("");
											$(".productPopup").click();
													
											jQuery.each(obj, function(i, val)
											{
												if(val.id!="")
												{
													$(".CIMS_Products").append('<li><label><input type="radio" value="'+val.id+'_'+val.name+'" name="pickMed" class="pickMed"/>'+val.name+'</label></li>');
												}
											}); }
										}
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

function reloadAllergy()
{
    if(!isLoading)
    {             
        timeout = setTimeout(function() {
	
			var count = $(".allergyData input.select2-search__field").val().length;
			
			var url = window.location.href;
			
			if(count>4)
			{
				$("#allergyData").html('<option data-id="" value="">Searching .....</option>');
				
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
						$(".select2-results__option").css("display","none");
						$("#allergyData").html("");
						var obj = $.parseJSON(data);
						if(obj!="")
						{
							jQuery.each(obj, function(i, val)
							{
								var value = val.id+"_"+val.name;
								$("#allergyData").append('<option value="'+value+'">'+val.name+'</option>');
							});
						}
						else
						{
							$("#allergyData").append('<option value="">No Allergy Found</option>');
						}
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
						$(".select2-results__option").css("display","none");
						$("#allergyData").html("");
						var obj = $.parseJSON(data);
						if(obj!="")
						{
							jQuery.each(obj, function(i, val)
							{
								var value = val.id+"_"+val.name;
								$("#allergyData").append('<option value="'+value+'">'+val.name+'</option>');
							});
						}
						else
						{
							$("#allergyData").append('<option value="">No Allergy Found</option>');
						}
					}
				});
				}
			}
			if(count==0)
			{
				$("#allergyData").html('<option value="">Select Allergy</option>');
			}
			
            setTimeout(function() { isLoading = false; }, delay);
        }, delay);
    }
}

$('body').on('click','.saveConditions',function()
{
	var patientID = $(".patientID").val();
	var oldCondtions = $(".oldCondtions").val();
	var condtionsData = $(".condtionsData").val();
	
	if($.trim(condtionsData)=="")
	{
		alert("No condtion added");
		return false;
	}
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"addconditions"]); ?>',  
		type: "POST",
		data: {'id' : patientID , 'oldCondtions' : oldCondtions , 'condtionsData' : condtionsData},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".conditionList").append('<span>* '+condtionsData+'</span>');
			
			if(oldCondtions=="")
			{
				$(".oldCondtions").val($(".condtionsData").val());
			}
			else
			{
				$(".oldCondtions").val($(".oldCondtions").val()+","+$(".condtionsData").val());
			}
			$(".condtionsData").val("");
		}   
	});
});

$('body').on('click','.saveAllergy',function()
{
	var patientID = $(".patientID").val();
	var oldAllergy = $(".oldAllergy").val();
	var allergyData = $(".allergyData").val();
	
	var allergyName = $(".allergyData").val().split("_");
	
	if($.trim(allergyData)=="")
	{
		alert("No allergy added");
		return false;
	}
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"addallergy"]); ?>',  
		type: "POST",
		data: {'id' : patientID , 'oldAllergy' : oldAllergy , 'allergyData' : allergyData},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".allergyList").append('<span>* '+allergyName[1]+'</span>');
			
			if(oldAllergy=="")
			{
				$(".oldAllergy").val($(".allergyData").val());
			}
			else
			{
				$(".oldAllergy").val($(".oldAllergy").val()+","+$(".allergyData").val());
			}
			$(".allergyData").html('<option value="">Select Allergy</option>');
		}   
	});
});

$('body').on('click','.saveNotes',function()
{
	var notesID = $(".notesID").val();
	var doctorID = $(".doctorID").val();
	var patientID = $(".patientID").val();
	var notesData = $(".notesData").val();
	var date = $("#notesCalender").val();
	
	if($.trim(notesData)=="")
	{
		alert("No notes added");
		return false;
	}
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"addnote"]); ?>',  
		type: "POST",
		data: {'notesID' : notesID, 'doctorID' : doctorID, 'patientID' : patientID , 'notesData' : notesData , 'date' : date},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".notesData").val("");
			$(".noNotesDiv").css("display","none");
			
			$(".savedNotes").html("");
			var obj = $.parseJSON(data);
			jQuery.each(obj, function(i, val)
			{
				var checkDisplay = date==val.date ? 'block' : 'none';
				$(".savedNotes").append('<div class="repeathistory notesDate" id="'+val.date+'" style="display:'+checkDisplay+'"><div class="medicianSubTitle"><p class=" toggleSubHead">'+val.date+'</p> <a class="mediedit editNotes" id="'+val.id+'">Edit</a> </div><div class="toggleSubContent"><ul class="medicianSub-wrap notesborder"><li class="medicianSub-list"><p class="notes_'+val.id+'">'+val.notes+'</p></li></ul></div></div>');
			});
			
			$(".notesID").val("");
		}   
	});
});

$('body').on('click','.editNotes',function()
{
	var id = $(this).attr("id");
	$(".notesID").val(id);
	$(".notesData").val($(".notes_"+id).text());
});

$("body").on("change","#notesCalender",function()
{
	var currentDate = $(this).val();
	
	$('.notesDate').each(function()
	{
		var dateData = $(this).attr("id");
		
		if (currentDate==dateData)
		{
			$(this).show();
		}
		else
		{
			$(this).hide();
		}		
	});
});

$("body").on("change","#previousCalender",function()
{
	var currentDate = $(this).val();
	
	$('.previousDateData').each(function()
	{
		var dateData = $(this).text();
		
		if (dateData.indexOf(currentDate)!=-1)
		{
			$(this).parent().parent().show();
		}
		else
		{
			$(this).parent().parent().hide();
		}		
	});
});

$("body").on("change","#reportCalender",function()
{
	var currentDate = $(this).val();
	
	$('.dateData').each(function()
	{
		var dateData = $(this).text();
		
		if (dateData.indexOf(currentDate)!=-1)
		{
			$(this).parent().parent().show();
		}
		else
		{
			$(this).parent().parent().hide();
		}		
	});
});

$('.notesCalender').click(function () {
	$('#notesCalender').click();
});
$("#notesCalender").daterangepicker({
	autoUpdateInput: true,
	singleDatePicker: true,
	locale: {
		format: 'DD MMM YYYY'
	}
});

$('.calender').click(function () {
	$('#reportCalender').click();
});
$("#reportCalender").daterangepicker({
	autoUpdateInput: true,
	singleDatePicker: true,
	locale: {
		format: 'DD MMM YYYY'
	}
});

$('.previousCalender').click(function () {
	$('#previousCalender').click();
});
$("#previousCalender").daterangepicker({
	autoUpdateInput: true,
	singleDatePicker: true,
	locale: {
		format: 'DD MMM YYYY'
	}
});

$('.openCalender').click(function () {
	$('#birthdateval').click();
});
$("#birthdateval").daterangepicker({
	autoUpdateInput: true,
	singleDatePicker: true,
	locale: {
		format: 'DD MMM YYYY'
	}
});
	
	
	$(".singleselect").select2();
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
	$(document).on('click', '.toggleHead', function (e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$(this).closest('li').find('.toggleContent').slideToggle();
		//$(this).closest('li').find('.repeathistory').slideToggle();
	});
	$(document).on('click', '.toggleSubHead', function (e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$(this).closest('.repeathistory').find('.toggleSubContent').slideToggle();
	});
	$('body').on('click','.addtimeClick',function() {
		$(this).parents('.row').find('.customTimewrap').removeClass('active');
	});
	$('body').on('click','.clderIconClick',function() {
		$('#selectdateval').click();
	});
	$("#selectdateval").daterangepicker({
		autoUpdateInput: true
		, singleDatePicker: true
		, locale: {
			format: 'DD MMM YYYY'
		}
	});
	$('body').on('click','.clderIconClick02',function() {
		$('#selectdateval02').click();
	});
	$("#selectdateval02").daterangepicker({
		autoUpdateInput: true
		, singleDatePicker: true
		, locale: {
			format: 'DD MMM YYYY'
		}
	});
	$('body').on('click','.clderIconClick03',function() {
		$('#selectdateval03').click();
	});
	$("#selectdateval03").daterangepicker({
		autoUpdateInput: true
		, singleDatePicker: true
		, locale: {
			format: 'DD MMM YYYY'
		}
	});
	$(".approvalDate").daterangepicker({
		autoUpdateInput: true
		, singleDatePicker: true
		, locale: {
			format: 'DD MMM YYYY'
		}
	});
	$('body').on('click','.menutoggle',function() {
		$(this).toggleClass('active');
		$('header').toggleClass('active');
	});
	$('body').on('click','.toggletitleLabel',function() {
		$(this).toggleClass('active');
		$(this).parents('.deliverypickupWrap').find('.deliveryToggle').slideToggle();
	});
	$('body').on('change','#secudelMedician',function() {
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
	$('.multiselect').multiselect({
		maxHeight: 280
		, numberDisplayed: 5
	});
	$('body').on('change','#pickupAdd',function() {
		if (this.value == 'Delivery') {
			$(this).parents('.deliveryToggle').find('.plaseselectArea ').slideDown();
		}
		if (this.value == 'Pickup') {
			$(this).parents('.deliveryToggle').find('.plaseselectArea ').slideUp();
		}
	});
	var qty = $('#qty').val();
	var price = $('#price').val();
	
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
	$('body').on('click','.doserowselect a',function() {
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
	});
	$('body').on('click','.weeklyWrap a',function() {
		$(this).toggleClass('active');
	});
	$('body').on('click','.clderIconClick',function() {
		$(this).siblings('.approvalDate').click();
	});
	$('body').on('click','.repear_bClick',function() {
		$(this).hide();
		$('.repeatbatch').show();
	});
	$('body').on('click','.toggleproduct',function() {
		$(this).toggleClass('active');
		$(this).parents('.repeatDosageWrap').find('.repeatDosage').slideToggle();
	});
	$('body').on('click','.repeatproduct',function() {
		$('.collapesclick').slideUp();
		$('.repeatDosageWrap').removeClass('addproductWrap');
	});
	
	$(".controlNumber").on("click", function () {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
		}
		else {
			
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			}
			else {
				newVal = 0;
			}
		}
		$button.parent().find("input").val(newVal);
	});
	$('.shidulTimeHeader').click(function () {
		$(this).toggleClass('active');
		$(this).siblings('.shidulTimebody').slideToggle();
	})
	$('.togglearrow').click(function () {
		$(this).toggleClass('active');
		$(this).parents('.perviewRemarkHeader').siblings('.togglelistwrap').slideToggle();
	});
	$('body').on('click','.checkedvalue',function() {
		var className = $(this).attr("id");
		if ($(this).is(':checked')) {
			$(this).parents('.doserowChk').find('.doserowselect').removeClass('active');
		}
		else {
			$("."+className).val("");
			$(this).parents('.doserowChk').find('.doserowselect').addClass('active');
			$(this).parents('.doserowChk').find('.doserowselect a').removeClass('active');
		}
	});
	/* $(".chkValue").keyup(function () {
		if ($(this).val().length == 0) {
			$(this).parents('.customformwrap').find('.addprod').removeClass('active');
		}
		else {
			$(this).parents('.customformwrap').find('.addprod').addClass('active');
		}
	}); */
	
	$('.editclickevent').click(function () {
			$(this).parents('li').find('input, select').removeAttr('disabled');
			$(this).remove();
		});
		
	$("#product_name").select2({
		dropdownCssClass: "product_name"
	});
	$("#allergyData").select2({
		dropdownCssClass: "allergyData"
	});
		
	$("#tags").select2({
		tags: true
		, createTag: function (params) {
			return {
				id: params.term
				, text: params.term
				, newOption: true
			}
		}
		, templateResult: function (data) {
			var $result = $("<span></span>");
			$result.text(data.text);
			if (data.newOption) {
				$result.append(" <em>(new)</em>");
			}
			return $result;
		}
	});
	$('#customerTable').DataTable({
		responsive: true
		, info: false
		, paging: false
		, searching: false
		, ordering: false
	});
	$('#reportsTable').DataTable({
		responsive: true
		, info: false
		, paging: false
		, searching: false
		, ordering: false
	});
	$('.allergiesClick').click(function () {
		var new_task = $('#allergiInput').val();
		$('#addtagsallergies').append('<li class="addtagsList"><span class="closeTags" ><img src="<?php echo PATH."img/doctor/close.png"; ?>" alt="Close" /></span><p>' + new_task + '</p></li>');
		$('#allergiInput').val('');
		return false;
	});
	$(document).on('click', '.closeTags', function () {
		$(this).parents('.addtagsList').remove();
	});
	
	$('.sltbox-title').click(function (e) {
		e.stopPropagation();
		$(this).parents('.sltbox-wrap').find('.searchloaction').show();
	});
	$('.main-wraper').click(function () {
		$('.searchloaction').hide();
	});
	$('.searchloaction').click(function (e) {
		e.stopPropagation();
	});
	$('.checkClick').click(function () {
		if ($(this).closest('.checkBox').find('input:checked').length == '1') {
			var xx = $(this).closest('.checkBox').find('label').html();
			list = '<li><span onClick="removeCheck(this);" data-val="' + xx + '"><img src="<?php echo PATH."img/doctor/close.png"; ?>" alt="Close" /></span><p>' + xx + '</p></li>';
			$('.showValue ul').append(list);
		}
		else {
			var len = $('.showValue ul li').length;
			for (var k = 0; k < len; k++) {
				if ($(this).closest('.checkBox').find('label').html() == $('.showValue ul li').eq(k).find('p').html()) {
					$('.showValue ul li').eq(k).remove();
				}
			}
		}
	});
});

function removeCheck(curr) {
	var len = $('.showValue ul li').length;
	var xx = curr.getAttribute('data-val');
	for (var k = 0; k < len; k++) {
		if (xx == $('.showValue ul li').eq(k).find('p').html()) {
			$('.showValue ul li').eq(k).remove();
		}
	}
	var len1 = $('.checkBox').length;
	for (var k = 0; k < len1; k++) {
		if (xx == $('.checkBox').eq(k).find('label').html()) {
			$('.checkBox').eq(k).find('input').removeAttr('checked');
		}
	}
}

function myFunction() {
	var input, filter, ul, li, a, i;
	input = document.getElementById("search");
	filter = input.value.toUpperCase();
	ul = document.getElementById("filterlist");
	li = ul.getElementsByTagName("li");
	for (i = 0; i < li.length; i++) {
		a = li[i].getElementsByTagName("label")[0];
		if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
			li[i].style.display = "";
		}
		else {
			li[i].style.display = "none";
		}
	}
}
	</script>
</body>