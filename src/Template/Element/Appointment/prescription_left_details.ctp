<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-left">
	<div class="row">
		<div class="col-lg-8 col-md-8 text-right">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#todayvisitsTab" aria-expanded="true">Today’s Visits</a></li>
				<li><a data-toggle="tab" href="#previsitsTab" aria-expanded="true">Previous Visits</a></li>
				<li class=""><a data-toggle="tab" href="#reportsTab" aria-expanded="false">Reports</a></li>
			</ul>
		</div>
	</div>
	<div class="tab-content">
		
		
		<div id="todayvisitsTab" class="tab-pane fade in active">
			
			<form method="post" action="<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"saveprescription"]); ?>" enctype="multipart/form-data">
		
			<div class="combgcolor selecttransparent radiusleft0">
			
			<input type="hidden" name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >

			<input type="hidden" name="dvID" value="<?php echo isset($doctorVisitData["id"]) ? $doctorVisitData["id"] : ""; ?>" >

			<input type="hidden" name="doctor_id" value="<?php echo $appointmentDetails["doctor_id"]; ?>" >
			<input type="hidden" name="patient_id" value="<?php echo $appointmentDetails["patient_id"]; ?>" >
			<input type="hidden" name="appointment_id" value="<?php echo $appointmentDetails["id"]; ?>" >
			
			<?php
			$uploadedTestID = array();
			$uploadedTestName = array();
			$uploadedTestData = array();
			$recommnededeTestID = array();
			$recommnededeTestName = array();
			if(!empty($testReportData))
			{
				foreach($testReportData as $key => $value)
				{
					if($value["test_recommended"]==0)
					{
						$uploadedTestID[] = $value["test_id"];
						$uploadedTestName[] = $value["test_name"];
						$uploadedTestData["test_date"] = $value["test_date"];
						$uploadedTestData["test_notes"] = $value["test_notes"];
						$uploadedTestData["test_report_filename"] = $value["test_report_filename"];
					}
					if($value["test_recommended"]==1)
					{
						$recommnededeTestID[] = $value["test_id"];
						$recommnededeTestName[] = $value["test_name"];
					}
				}
			} ?>
			
				<div class="observationWrap">
					<div class="observationTitle">Observation</div>
					<div class="form-group">
						<textarea class="form-control" name="observation"><?php echo isset($doctorVisitData["observation"]) ? $doctorVisitData["observation"] : ""; ?></textarea>
					</div>
					<div class="clearfix uploadfiledoc"> <span class="btn btn-secondary text-uppercase" data-toggle="modal" data-target="#uploadreports-modal">Upload</span>
						<div class="uploadlist" style="display: none;"> <a href="javascript:void(0);" class="linkBtn btn btn-secondary" title="Attach File">BROWSE</a>
							<input type="file" class="browseInput multi with-preview" multiple="multiple" /> </div>
					</div>
				</div>
				<div class="medicarewrap clearfix">
					<div class="observationTitle pull-left">Prescription</div><a href="#" class="repeatmedic" data-toggle="modal" data-target="#repeatmediction-popup">Repeat Medication</a>
					<div class="shidulTimefooter pull-right" style="display:block;">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#printModal-popup"><b><i class="sprite printIcon"></i></b> Print</a>
						<a href="javascript:void(0)" data-toggle="modal" data-target="#emailModal-popup"> <b><i class="sprite emailIcon"></i></b> Email</a>
					</div>
				</div>
				<div class="clearfix medicationData">
					<div class="dosageTitle clearfix">
						<div class="countProduct">1</div>
						<div class="toggleproduct  pull-right"> <span></span> </div>
					</div>
					<div class="noCollapes">
						<ul class="clearfix row">
							<li class="col-md-5 col-sm-12">
								<div class="customformwrap">
									<label class="customLabel">Search By</label>
									<div class="customLabel">
										<input type="radio" class="product_search_by" name="product_search_by" value="1" checked><span class="product_search_by_text">Product</span>
										<input type="radio" class="product_search_by" name="product_search_by" value="2"><span class="product_search_by_text">Molecule</span>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="noCollapes">
						<ul class="clearfix row">
							<li class="col-md-5 col-sm-12">
								<div class="customformwrap">
									<label class="customLabel">PRODUCT NAME<!--<span class="starClass"> *</span>--></label>
									<!--<input autocomplete="off" type="text" class="custominput mandatory " name="product_name">-->
									<!--<select class="custominput singleselect product_name" id="product_name" name="product_name">-->
									<select class="product_name" id="product_name" name="product_name">
										<option value="">Select Product</option>
									</select>
									<span class="errorClass productErrorClass">Field Required</span>
								</div>
							</li>
							<li class="col-md-7 col-sm-12">
								<p class="cmyTitle">Mfgd : <span class="companyName"></span></p> 
							</li>
						</ul>
					</div>
					<div class="repeatDosage collapesclick">
						<ul class="row">
							<li class="col-md-5 col-sm-12">
								<div class="row">
									<!--<div class="col-md-6 col-sm-12">
										<div class="customformwrap">
											<label class="customLabel">DOSAGE</label>
											<input autocomplete="off" type="text" id="qty" class="custominput" name="dosage_qty" /> <small class="text-muted text-right center-block"><span class="formName"></span></small> </div>
									</div>-->
									<input type="hidden" name="product_type" class="product_type">
									<div class="frequencyDiv">
									<div class="col-md-6 col-sm-12">
										<div class="customformwrap">
											<label class="customLabel">FREQUENCY</label>
											<div class="defaultTime1">
												<select id="secudelMedician" class="custominput singleselect dosage_frequency" name="dosage_frequency">
													<option selected>Daily</option>
													<option>Weekly</option>
													<!--<option>Monthly</option>-->
												</select>
											</div>
											<div class="customtime1" style="display:none;">
												<input type="text" class="custominput witoutbg" name="dosage_no_frequency" /> </div>
										</div>
									</div>
									</div>
									<div class="col-sm-12"> </div>
									<div class="col-md-6 col-sm-12">
										<div class="customformwrap">
											<label class="customLabel">DURATION</label>
											<input autocomplete="off" type="text" id="price" class="custominput" name="duration_no" /> </div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="customformwrap">
											<label class="customLabel">&nbsp;</label>
											<div class="defaultTime1">
												<select class="custominput singleselect defaultTime duration_frequency" name="duration_frequency">
													<option selected>Day</option>
													<option>Week</option>
													<!--<option>Month</option>-->
												</select>
											</div>
											<div class="customtime1" style="display:none;">
												<input type="text" class="custominput witoutbg" name="duration_no_frequency" /> </div>
										</div>
									</div>
									<div class="col-md-5 col-sm-12 mt-4">
										<div class="customformwrap qua_input">
											<label class="customLabel">TOTAL QUANTITY</label>
											<input type="text" id="total" class="custominput" name="total_qty" readonly /> </div> <!--<small class="text-muted">Tablets</small>--> </div>
									<div class="col-md-12 col-sm-12 mt-4">
										<div class="customformwrap">
											<label class="customLabel">Notes</label>
											<textarea class="custominput" name="notes"></textarea>
										</div>
									</div>
								</div>
							</li>
							<li class="col-md-7 col-sm-12">
							
							<input type="hidden" name="customCheck" class="customCheck">
							
								<div class="doserowWrap">
									<!-- CUSTOM TIME -->
									<div class="customtime">
										<div class="doserowHeader clearfix">
											<p class="col-lg-8 col-md-7 col-sm-12 col-xs-12 title">CUSTOM TIME</p>
											<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 alignright"><span class="addtimingClick">ADD TIMINGS</span></div>
										</div>
										<div class="row clearfix">
											<div class=" customTimewrap clearfix">
												<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12">
													<div class="customformwrap">
														<input type="time" name="time[]" class="custominput witoutbg without_ampm" value="00:00" />
													</div>
												</div>
												<div class="col-lg-7 col-md-8 col-sm-6 col-xs-12 customTimePM typeareaInput">
													<input autocomplete="off" type="text" class="form-control abbreviation abbreviation_0" id="0" name="abbreviation[]">
													<div class="textCustomarea">
														<label for="0">
															<textarea class="form-control abbreviation_meaning abbreviation_meaning_0" readonly name="abbreviation_meaning[]" rows="3"></textarea>
														</label>
													</div>
													
													<!--<input type="number" name="meridiem_quantity[]" class="form-control meridiemInput mr-2" min="0" max="999"><div class="customradio"><label><input type="radio" name="meridiem[0]" value="AM" checked> <b></b><span>AM</span></label></div><div class="customradio"><label><input type="radio" name="meridiem[0]" value="PM"> <b></b><span>PM</span></label></div><div class="addmoreBtn addtimeClick"><b class="sprite addplusIcon"></b></div>-->
												</div>
												<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
													<div class="addmoreBtn addtimeClick"><b class="sprite addplusIcon"></b></div>
												</div>
											</div>
											<div class="appendCustomTime"></div>
										</div>
											
											<!--<div class="row clearfix">
												<div class=" customTimewrap clearfix">
													<textarea class="form-control" name="abbreviation" rows="5"></textarea>
												</div>
											</div>-->
									</div>
									<div class="defaultTime">
										<div class="doserowHeader clearfix">
											<p class="title">TIMINGS <small>(Please select all that apply)</small> <span class="cstmTimeClick pull-right">ADD CUSTOM TIME</span></p>
										</div>
										<div class="doserow clearfix">
											<!-- MONTHLY -->
											<div class="monthlyWrap">
												<div class="customformwrap">
													<select class="custominput multiselect" id="multiselectClick" multiple data-placeholder="Select Months">
														<option>JANUARY</option>
														<option>FEBUARY</option>
														<option>MARCH</option>
														<option>APRIL</option>
														<option>May</option>
														<option>Jun</option>
														<option>July</option>
														<option>August</option>
														<option>September</option>
														<option>October</option>
														<option>November</option>
														<option>December</option>
													</select>
												</div>
											</div>
											
											<!-- WEEKLEY -->
											<div class="weeklyWrap">
											<input type="text" name="day_of_week[Mon]" class="days" placeholder="Mon" readonly>
											<input type="text" name="day_of_week[Tue]" class="days" placeholder="Tue" readonly>
											<input type="text" name="day_of_week[Wed]" class="days" placeholder="Wed" readonly>
											<input type="text" name="day_of_week[Thu]" class="days" placeholder="Thu" readonly>
											<input type="text" name="day_of_week[Fri]" class="days" placeholder="Fri" readonly>
											<input type="text" name="day_of_week[Sat]" class="days" placeholder="Sat" readonly>
											<input type="text" name="day_of_week[Sun]" class="days" placeholder="Sun" readonly>
											</div>
											<div class="dailyWrap">
												<div class="row clearfix doserowChk">
													<div class="col-md-3 col-sm-12 col-xs-12">
														<div class="customcheckbox">
															<label>
																<input type="checkbox" class="checkedvalue" id="morning"> <b></b><span>MORNING</span>
															</label>
														</div>
													</div>
													<div class="col-md-9 col-sm-12 col-xs-12">
														<input type="number" name="morning_quantity" class="form-control morningInput" min="0" max="999" readonly>
													
														<div class="doserowselect active doserowselectPharmacy">
														<input type="hidden" name="morning" class="morning">
														<a href="javascript:void(0);" class="morningSchedule">Before</a> 
														<a href="javascript:void(0);" class="morningSchedule">After</a> 
														<a href="javascript:void(0);" class="morningSchedule morningAnytime">Anytime</a>
														</div>
													</div>
												</div>
												<!--<div class="row clearfix doserowChk">
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
														<div class="customcheckbox">
															<label>
																<input type="checkbox" class="checkedvalue" id="midday"> <b></b><span>MID DAY</span></label>
														</div>
													</div>
													<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
														<div class="doserowselect active"> 
														<input type="hidden" name="midday" class="midday">
														<a href="javascript:void(0);" class="middaySchedule">Before</a> 
														<a href="javascript:void(0);" class="middaySchedule">After</a> 
														<a href="javascript:void(0);" class="middaySchedule">Anytime</a> 
														</div>
													</div>
												</div>-->
												<div class="row clearfix doserowChk">
													<div class="col-md-3 col-sm-12 col-xs-12">
														<div class="customcheckbox">
															<label>
																<input type="checkbox" class="checkedvalue" id="afternoon"> <b></b><span>AFTERNOON</span></label>
														</div>
													</div>
													<div class="col-md-9 col-sm-12 col-xs-12">
														<input type="number" name="afternoon_quantity" class="form-control afternoonInput" min="0" max="999" readonly>
													
														<div class="doserowselect active doserowselectPharmacy">
														<input type="hidden" name="afternoon" class="afternoon">
														<a href="javascript:void(0);" class="afternoonSchedule">Before</a> 
														<a href="javascript:void(0);" class="afternoonSchedule">After</a> 
														<a href="javascript:void(0);" class="afternoonSchedule afternoonAnytime">Anytime</a>
														</div>
													</div>
												</div>
												<div class="row clearfix doserowChk">
													<div class="col-md-3 col-sm-12 col-xs-12">
														<div class="customcheckbox">
															<label>
																<input type="checkbox" class="checkedvalue" id="evening"> <b></b><span>EVENING</span></label>
														</div>
													</div>
													<div class="col-md-9 col-sm-12 col-xs-12">
														<input type="number" name="evening_quantity" class="form-control eveningInput" min="0" max="999" readonly>
													
														<div class="doserowselect active doserowselectPharmacy">
														<input type="hidden" name="evening" class="evening">
														<a href="javascript:void(0);" class="eveningSchedule">Before</a> 
														<a href="javascript:void(0);" class="eveningSchedule">After</a> 
														<a href="javascript:void(0);" class="eveningSchedule eveningAnytime">Anytime</a>
														</div>
													</div>
												</div>
												<div class="row clearfix doserowChk">
													<div class="col-md-3 col-sm-12 col-xs-12">
														<div class="customcheckbox">
															<label>
																<input type="checkbox" class="checkedvalue" id="dinner"> <b></b><span>NIGHT</span></label>
														</div>
													</div>
													<div class="col-md-9 col-sm-12 col-xs-12">
														<input type="number" name="dinner_quantity" class="form-control dinnerInput" min="0" max="999" readonly>
													
														<div class="doserowselect active doserowselectPharmacy">
														<input type="hidden" name="dinner" class="dinner">
														<a href="javascript:void(0);" class="dinnerSchedule">Before</a> 
														<a href="javascript:void(0);" class="dinnerSchedule">After</a> 
														<a href="javascript:void(0);" class="dinnerSchedule dinnerAnytime">Anytime</a></div>
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="text-right mt-4"> <a href="" class="btn btn-default">RESET</a> 
								<input type="submit" class="btn btn-primary submit checkValidation" value="ADD TO PRESCRIPTION">
								<!--<a class="btn btn-primary submit">ADD TO PRESCRIPTION</a>-->
								<div class="errorClass productTestError">Select Product Name or Test</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="addnoteswrap">
					<div class="observationWrap">
						<div class="observationTitle">Notes FOr Patient</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Add Notes" name="patient_notes"><?php echo isset($doctorVisitData["patient_notes"]) ? $doctorVisitData["patient_notes"] : ""; ?></textarea>
						</div>
						<div class="observationTitle">Recommended Tests</div>
						<div class="row">
							<div class="col-sm-8 col-md-6 col-12">
								<select class="custominput singleselect test_id" name="test_id[]" multiple data-placeholder="Select Test">
									<?php
									if(isset($testMasterData) && !empty($testMasterData)) {
									foreach($testMasterData as $key => $value) {
									?>
									<option value="<?php echo $value["id"]; ?>" <?php echo in_array($value["id"],$recommnededeTestID) ? "selected" : ""; ?> ><?php echo $value["test_name"]; ?></option>
									<?php } } ?>
								</select>
							</div>
						</div>
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
												<select class="custominput singleselect" name="report_test_id[]" multiple data-placeholder="Select Test">
													<?php
													if(isset($testMasterData) && !empty($testMasterData)) {
													foreach($testMasterData as $key => $value) {
													?>
													<option value="<?php echo $value["id"]; ?>" <?php echo in_array($value["id"],$uploadedTestID) ? "selected" : ""; ?> ><?php echo $value["test_name"]; ?></option>
													<?php } } ?>
												</select>
											</div>
										</li>
										<li>
											<div class="customformwrap openCalender">
												<label class="customLabel">Date of Test</label>
												<input type="text" class="custominput" id="birthdateval" name="test_date" value="<?php echo isset($uploadedTestData["test_date"]) ? $uploadedTestData["test_date"] : ""; ?>" />
												<b class="sprite clderIcon cld_icon reportsClick"></b>
											</div>
										</li>
										<li>
											<div class="customformwrap">
												<label class="customLabel">Notes</label>
												<textarea class="custominput" name="test_notes"><?php echo isset($uploadedTestData["test_notes"]) ? $uploadedTestData["test_notes"] : ""; ?></textarea>
											</div>
										</li>
									</ul>
									<?php
									$imageName = isset($uploadedTestData["test_report_filename"]) ? explode(",",$uploadedTestData["test_report_filename"]) : "";
									?>
									<p class="attacheview"><?php echo isset($imageName) && !empty($imageName) ? $imageName[1] : ""; ?></p>
									<input type="hidden" name="oldImage" value="<?php echo isset($uploadedTestData["test_report_filename"]) ? $uploadedTestData["test_report_filename"] : ""; ?>" >
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="centerAlign">
							<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button> <span class="btn btn-secondary upload-secondry text-uppercase uploadsec">
							<input type="file" name="test_report_filename" class="attachReport" /> attach </span> </div>
					</div>
				</div>
			</div>
		
			</form>
		
		</div>
		
		
		<div id="previsitsTab" class="tab-pane fade">
			<?php echo $this->element("Appointment/previous_visit_tab"); ?>
		</div>
		<div id="reportsTab" class="tab-pane fade">
			<?php echo $this->element("Appointment/reports_tab"); ?>
		</div>
		
	</div>
</div>
