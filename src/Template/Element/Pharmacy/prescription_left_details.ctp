<div class="noCollapes">
	<ul class="clearfix row">
	
		<input type="hidden" name="prescription_id" class="prescriptionID" value="<?php echo isset($prescriptionID) ? $prescriptionID : ""; ?>" >
		<input type="hidden" class="savedPatient" value="<?php echo isset($patientID) ? $patientID : ""; ?>" >
		<input type="hidden" class="savedDoctor" value="<?php echo isset($doctorID) ? $doctorID : ""; ?>" >
	
		<li class="col-md-5 col-sm-12">
			<div class="customformwrap">
				<label class="customLabel">PRODUCT NAME<span class="starClass"> *</span></label>
				<!--<input autocomplete="off" type="text" class="custominput mandatory " name="product_name">-->
				<select class="custominput singleselect product_name" id="product_name" name="product_name">
					<option value="">Select Product</option>
				</select>
				<span class="errorClass productErrorClass">Field Required</span>
			</div>
		</li>
		<li class="col-md-7 col-sm-12">
			<div class="row quantyDeal">
				<div class="col-md-7 col-sm-12"><p class="cmyTitle">Mfgd : <span class="companyName"></span></p></div>
				<div class="col-md-5 col-sm-12 text-right orderFormDiv" style="display:none;">
					<span class="text-uppercase text-link">
						<a class="text-uppercase text-link orderForm" href="#" data-toggle="modal" data-target="#addOrderDiv">Add to Order Form</a>
					</span>
				</div>
				<div class="col-md-5 col-sm-12 text-right" style="display:none;">
					<span class="text-uppercase text-link">
						<a class="text-uppercase text-link Popup" href="#" data-toggle="modal" data-target="#popup">Popup</a>
					</span>
				</div>
			</div> 
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
							</div>
							<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
								<div class="addmoreBtn addtimeClick"><b class="sprite addplusIcon"></b></div>
							</div>
						</div>
						<div class="appendCustomTime"></div>
					</div>
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
							<div class="row clearfix doserowChk">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" class="checkedvalue" id="afternoon"> <b></b><span>AFTERNOON</span>
										</label>
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
											<input type="checkbox" class="checkedvalue" id="evening"> <b></b><span>EVENING</span>
										</label>
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
											<input type="checkbox" class="checkedvalue" id="dinner"> <b></b><span>DINNER</span>
										</label>
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
			<!--<div class="text-right mt-4"> <a href="" class="btn btn-default">RESET</a> 
				<input type="button" class="btn btn-primary submit checkValidation" value="ADD TO PRESCRIPTION"> 
			</div>-->
		</li>
	</ul>
			
	<input type="hidden" class="productID" name="product_id">
	<div class="batchMainWrap">
		<ul class="row batchwrap batchDiv">
			<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="customformwrap">
					<label class="customLabel">BATCH CODE<span class="starClass"> *</span></label>
					<select class="custominput singleselect batchCode" data-id="1" name="inventory_id[]" id="batchCode_1">
						<option value="">Select Batch</option>
					</select>
					<span class="errorClass batchErrorClass">Field Required</span>
					<span class="quantityLeft_1"></span>
				</div>
			</li>
			
			<input type="hidden" name="quantity_left[]" class="quantity_left_1">
			<input type="hidden" name="total_quantity[]" class="total_quantity_1">
			<input type="hidden" name="unit_price[]" class="unit_price_1">
			<input type="hidden" name="totalPacks[]" class="totalPacks_1">
			
			<li class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="customformwrap">
					<label class="customLabel">QUANTITY</label>
					<input type="text" class="custominput quantity_1" name="quantity[]"/>
				</div>
			</li>
			<li class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
				<div class="customformwrap">
					<label class="customLabel">PRODUCT EXPIRY</label>
					<input type="text" class="custominput expiry_1" name="expiry_date[]" readonly/>
					<!--<input type="text" class="custominput approvalDate">
					<b class="sprite clderIcon cld_icon clderIconClick"></b>-->
				</div>
			</li>
			<li class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
				<div class="addmoreBtn repear_bClick"><b class="sprite addplusIcon addInventory"></b></div>
			</li>
		</ul>
		<div class="appendInventory"></div>
		
		
		<!--############# DRUG ALLERGIES DIV-->
		<div class="drugsAllergiesDiv">
			<?php echo $this->element("Pharmacy/drugs_allergies"); ?>
		</div>
		<!--############# DRUG ALLERGIES DIV-->
		
		
		<!--<div class="packagingLabel clearfix">
			<p>PACKAGING &amp; LABELING</p>
			<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
				<div class="customcheckbox">
					<label>
					<input type="checkbox">
					<b></b><span>PRINT LABEL</span>
					</label>
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
				<div class="customcheckbox">
					<label>
					<input type="checkbox">
					<b></b><span>MDS REQUIRED</span></label>
				</div>
			</div>
		</div>-->
		
		<div style="margin-bottom:20px;">
			<input type="button" class="btn btn-primary submit checkValidation" value="SAVE & ADD ANOTHER PRODUCT">
		</div>

	</div>

</div>