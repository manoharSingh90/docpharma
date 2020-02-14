<div class="noCollapes">
	<ul class="clearfix row">
	
		<input type="hidden" name="prescription_id" value="<?php echo isset($editPrescriptionData["prescription_id"]) ? $editPrescriptionData["prescription_id"] : ""; ?>" >
		<input type="hidden" name="product_id" value="<?php echo isset($editPrescriptionData["product_id"]) ? $editPrescriptionData["product_id"] : ""; ?>" >
		<input type="hidden" class="savedPatient" value="<?php echo isset($editPrescriptionData["patient_id"]) ? $editPrescriptionData["patient_id"] : ""; ?>" >
		<input type="hidden" class="savedDoctor" value="<?php echo isset($editPrescriptionData["doctor_id"]) ? $editPrescriptionData["doctor_id"] : ""; ?>" >
	
		<li class="col-md-5 col-sm-12">
			<div class="customformwrap">
				<label class="customLabel">PRODUCT NAME<span class="starClass"> *</span></label>
				<select class="custominput singleselect product_name" id="product_name" name="product_name">
					<option value="<?php echo isset($editPrescriptionData["product_guid"]) ? $editPrescriptionData["product_guid"]."_".$editPrescriptionData["product_name"] : ""; ?>">
						<?php echo isset($editPrescriptionData["product_name"]) ? $editPrescriptionData["product_name"] : ""; ?>
					</option>
				</select>
				<span class="errorClass productErrorClass">Field Required</span>
			</div>
		</li>
		<li class="col-md-7 col-sm-12">
			<div class="row quantyDeal">
				<div class="col-md-7 col-sm-12"><p class="cmyTitle">Mfgd : <span class="companyName"></span></p></div>
				<div class="col-md-5 col-sm-12 text-right">
					<span class="text-uppercase text-link">
						<a class="text-uppercase text-link orderForm" href="#" data-toggle="modal" data-target="#addOrderDiv">Add to Order Form</a>
					</span>
					<!--<span class="text-uppercase text-link updateLink">Add to Order Form</span>-->
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
						<input autocomplete="off" type="text" id="qty" class="custominput" name="dosage_qty" value="<?php echo isset($editPrescriptionData["dosage_qty"]) ? $editPrescriptionData["dosage_qty"] : ""; ?>" /> <small class="text-muted text-right center-block"><span class="formName"></span></small> </div>
				</div>-->
				<input type="hidden" name="product_type" class="product_type" value="<?php echo isset($editPrescriptionData["product_type"]) ? $editPrescriptionData["product_type"] : ""; ?>">
				<div class="frequencyDiv" style="display:<?php echo isset($editPrescriptionData["abbreviation"]) && empty($editPrescriptionData["abbreviation"]) ? "block" : "none"; ?>" >
				<div class="col-md-6 col-sm-12">
					<div class="customformwrap">
						<label class="customLabel">FREQUENCY</label>
						<div class="defaultTime1">
							<select id="secudelMedician" class="custominput singleselect dosage_frequency" name="dosage_frequency">
								<option <?php echo isset($editPrescriptionData["dosage_frequency"]) && $editPrescriptionData["dosage_frequency"]=="Daily" ? "selected" : ""; ?> >Daily</option>
								<option <?php echo isset($editPrescriptionData["dosage_frequency"]) && $editPrescriptionData["dosage_frequency"]=="Weekly" ? "selected" : ""; ?> >Weekly</option>
								<!--<option>Monthly</option>-->
							</select>
						</div>
						<div class="customtime1" style="display:none;">
							<input type="text" class="custominput witoutbg" name="dosage_no_frequency" value="<?php echo isset($editPrescriptionData["custom_times"]) && !empty($editPrescriptionData["custom_times"]) ? $editPrescriptionData["dosage_frequency"] : ""; ?>" />
						</div>
					</div>
				</div>
				</div>
				<div class="col-sm-12"> </div>
				<div class="col-md-6 col-sm-12">
					<div class="customformwrap">
						<label class="customLabel">DURATION</label>
						<input autocomplete="off" type="text" id="price" class="custominput" name="duration_no" value="<?php echo isset($editPrescriptionData["duration_no"]) ? $editPrescriptionData["duration_no"] : ""; ?>" /> </div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="customformwrap">
						<label class="customLabel">&nbsp;</label>
						<div class="defaultTime1">
							<select class="custominput singleselect defaultTime duration_frequency" name="duration_frequency">
								<option <?php echo isset($editPrescriptionData["duration_frequency"]) && $editPrescriptionData["duration_frequency"]=="Day" ? "selected" : ""; ?> >Day</option>
								<option <?php echo isset($editPrescriptionData["duration_frequency"]) && $editPrescriptionData["duration_frequency"]=="Week" ? "selected" : ""; ?> >Week</option>
								<!--<option>Month</option>-->
							</select>
						</div>
						<div class="customtime1" style="display:none;">
							<input type="text" class="custominput witoutbg" name="duration_no_frequency" value="<?php echo isset($editPrescriptionData["custom_times"]) && !empty($editPrescriptionData["custom_times"]) ? $editPrescriptionData["duration_frequency"] : ""; ?>" />
						</div>
					</div>
				</div>
				<div class="col-md-5 col-sm-12 mt-4">
					<div class="customformwrap qua_input">
						<label class="customLabel">TOTAL QUANTITY</label>
						<input type="text" id="total" class="custominput" name="total_qty" value="<?php echo isset($editPrescriptionData["total_qty"]) ? $editPrescriptionData["total_qty"] : ""; ?>" <?php echo isset($editPrescriptionData["abbreviation"]) && empty($editPrescriptionData["abbreviation"]) ? "readonly" : ""; ?> /> </div> <!--<small class="text-muted">Tablets</small>--> </div>
				<div class="col-md-12 col-sm-12 mt-4">
					<div class="customformwrap">
						<label class="customLabel">Notes</label>
						<textarea class="custominput" name="notes"><?php echo isset($editPrescriptionData["notes"]) ? $editPrescriptionData["notes"] : ""; ?></textarea>
					</div>
				</div>
			</div>
		</li>
		
		<li class="col-md-7 col-sm-12">
		
		<input type="hidden" name="customCheck" class="customCheck" value="<?php echo isset($editPrescriptionData["custom_times"]) && !empty($editPrescriptionData["custom_times"]) ? 1 : ""; ?>" >
		
			<div class="doserowWrap">
				<!-- CUSTOM TIME -->
				<div class="customtime" style="display:<?php echo isset($editPrescriptionData["custom_times"]) && !empty($editPrescriptionData["custom_times"]) ? "block" : "none"; ?>" >
					<div class="doserowHeader clearfix">
						<p class="col-lg-8 col-md-7 col-sm-12 col-xs-12 title">CUSTOM TIME</p>
						<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 alignright"><span class="addtimingClick">ADD TIMINGS</span></div>
					</div>
					<?php
					$customTimes = isset($editPrescriptionData["custom_times"]) ? json_decode($editPrescriptionData["custom_times"],true) : "";
					?>
					<!--<div class="row clearfix">
						<div class=" customTimewrap clearfix">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="customformwrap">
									<input type="time" name="time[]" class="custominput witoutbg without_ampm" value="<?php echo isset($customTimes[0]["time"]) ? $customTimes[0]["time"] : "00:00"; ?>" /> </div>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 customTimePM">
							
								<input type="number" name="meridiem_quantity[]" class="form-control meridiemInput mr-2" min="0" max="999" value="<?php echo isset($customTimes[0]["meridiem_quantity"]) ? $customTimes[0]["meridiem_quantity"] : "00:00"; ?>" ><div class="customradio"><label><input type="radio" name="meridiem[0]" value="AM" <?php echo isset($customTimes[0]["meridiem"]) && $customTimes[0]["meridiem"]=="AM" ? "checked" : ""; ?> > <b></b><span>AM</span></label></div><div class="customradio"><label><input type="radio" name="meridiem[0]" value="PM" <?php echo isset($customTimes[0]["meridiem"]) && $customTimes[0]["meridiem"]=="PM" ? "checked" : ""; ?> > <b></b><span>PM</span></label></div><div class="addmoreBtn addtimeClick"><b class="sprite addplusIcon"></b></div>
							</div>
						</div>
						
					<div class="appendCustomTime">
					<?php
					//if(isset($customTimes) && !empty($customTimes)) {
					//foreach($customTimes as $key => $value) {
					//if($key!=0) { ?>
						<div class=" customTimewrap clearfix appendDiv">
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="customformwrap">
									<input type="time" name="time[]" class="custominput witoutbg without_ampm" value="<?php echo isset($value["time"]) ? $value["time"] : ""; ?>" />
								</div>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 customTimePM">
							
								<input type="number" name="meridiem_quantity[]" class="form-control meridiemInput mr-2" min="0" max="999" value="<?php echo isset($value["meridiem_quantity"]) ? $value["meridiem_quantity"] : "00:00"; ?>" ><div class="customradio"><label><input type="radio" name="meridiem[<?php echo $key; ?>]" value="AM" <?php echo isset($value["meridiem"]) && $value["meridiem"]=="AM" ? "checked" : ""; ?> > <b></b><span>AM</span></label></div><div class="customradio"><label><input type="radio" name="meridiem[<?php echo $key; ?>]" value="PM" <?php echo isset($value["meridiem"]) && $value["meridiem"]=="PM" ? "checked" : ""; ?> > <b></b><span>PM</span></label></div><div class="addmoreBtn"><b class="sprite removeCustomTime"></b></div>
							</div>
						</div>
					<?php //} } } ?>
					</div>
						
					</div>-->
					
					<div class="row clearfix">
						<div class=" customTimewrap clearfix">
							<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12">
								<div class="customformwrap">
									<input type="time" name="time[]" class="custominput witoutbg without_ampm" value="<?php echo isset($customTimes[0]["time"]) ? $customTimes[0]["time"] : "00:00"; ?>" /> </div>
							</div>
							<div class="col-lg-7 col-md-8 col-sm-6 col-xs-12 customTimePM typeareaInput">
								<input autocomplete="off" type="text" class="form-control abbreviation abbreviation_0" id="0" name="abbreviation[]" value="<?php echo isset($customTimes[0]["abbreviation"]) ? $customTimes[0]["abbreviation"] : ""; ?>" >
								<div class="textCustomarea">
									<label for="0">
										<textarea class="form-control abbreviation_meaning abbreviation_meaning_0" readonly name="abbreviation_meaning[]" rows="3"><?php echo isset($customTimes[0]["abbreviation_meaning"]) ? $customTimes[0]["abbreviation_meaning"] : ""; ?></textarea>
									</label>
								</div>
							</div>
							<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
								<div class="addmoreBtn addtimeClick"><b class="sprite addplusIcon"></b></div>
							</div>
						</div>
						
					<div class="appendCustomTime">
					<?php
					if(isset($customTimes) && !empty($customTimes)) {
					foreach($customTimes as $key => $value) {
					if($key!=0) { ?>
						<div class=" customTimewrap clearfix appendDiv">
							<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12">
								<div class="customformwrap">
									<input type="time" name="time[]" class="custominput witoutbg without_ampm" value="<?php echo isset($value["time"]) ? $value["time"] : ""; ?>" />
								</div>
							</div>
							<div class="col-lg-7 col-md-8 col-sm-6 col-xs-12 customTimePM typeareaInput">
								<input autocomplete="off" type="text" class="form-control abbreviation abbreviation_<?php echo $key; ?>" id="<?php echo $key; ?>" name="abbreviation[]" value="<?php echo isset($value["abbreviation"]) ? $value["abbreviation"] : ""; ?>" >
								<div class="textCustomarea">
									<label for="<?php echo $key; ?>">
										<textarea class="form-control abbreviation_meaning abbreviation_meaning_<?php echo $key; ?>" readonly name="abbreviation_meaning[]" rows="3"><?php echo isset($value["abbreviation_meaning"]) ? $value["abbreviation_meaning"] : ""; ?></textarea>
									</label>
								</div>
							</div>
							<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
								<div class="addmoreBtn"><b class="sprite removeCustomTime"></b></div>
							</div>
						</div>
					<?php } } } ?>
					</div>
						
					</div>
					
				</div>
				<div class="defaultTime" style="display:<?php echo isset($editPrescriptionData["custom_times"]) && empty($editPrescriptionData["custom_times"]) ? "block" : "none"; ?>" >
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
						<?php
						$dayOfWeek = isset($editPrescriptionData["day_of_week"]) && !empty($editPrescriptionData["day_of_week"]) ? explode(",",$editPrescriptionData["day_of_week"]) : ""; ?>
						<div class="weeklyWrap" style="display:<?php echo isset($editPrescriptionData["dosage_frequency"]) && $editPrescriptionData["dosage_frequency"]=="Weekly" ? "block" : "none"; ?>">
						<input type="text" name="day_of_week[Mon]" class="days" placeholder="Mon" value="<?php echo !empty($dayOfWeek) && in_array("Mon", $dayOfWeek) ? "Mon" : ""; ?>" style="<?php echo !empty($dayOfWeek) && in_array("Mon", $dayOfWeek) ? "background:#8f4b79; color:#fff; border-color:#8f4b79;" : ""; ?>" readonly>
						<input type="text" name="day_of_week[Tue]" class="days" placeholder="Tue" value="<?php echo !empty($dayOfWeek) && in_array("Tue", $dayOfWeek) ? "Tue" : ""; ?>" style="<?php echo !empty($dayOfWeek) && in_array("Tue", $dayOfWeek) ? "background:#8f4b79; color:#fff; border-color:#8f4b79;" : ""; ?>" readonly>
						<input type="text" name="day_of_week[Wed]" class="days" placeholder="Wed" value="<?php echo !empty($dayOfWeek) && in_array("Wed", $dayOfWeek) ? "Wed" : ""; ?>" style="<?php echo !empty($dayOfWeek) && in_array("Wed", $dayOfWeek) ? "background:#8f4b79; color:#fff; border-color:#8f4b79;" : ""; ?>" readonly>
						<input type="text" name="day_of_week[Thu]" class="days" placeholder="Thu" value="<?php echo !empty($dayOfWeek) && in_array("Thu", $dayOfWeek) ? "Thu" : ""; ?>" style="<?php echo !empty($dayOfWeek) && in_array("Thu", $dayOfWeek) ? "background:#8f4b79; color:#fff; border-color:#8f4b79;" : ""; ?>" readonly>
						<input type="text" name="day_of_week[Fri]" class="days" placeholder="Fri" value="<?php echo !empty($dayOfWeek) && in_array("Fri", $dayOfWeek) ? "Fri" : ""; ?>" style="<?php echo !empty($dayOfWeek) && in_array("Fri", $dayOfWeek) ? "background:#8f4b79; color:#fff; border-color:#8f4b79;" : ""; ?>" readonly>
						<input type="text" name="day_of_week[Sat]" class="days" placeholder="Sat" value="<?php echo !empty($dayOfWeek) && in_array("Sat", $dayOfWeek) ? "Sat" : ""; ?>" style="<?php echo !empty($dayOfWeek) && in_array("Sat", $dayOfWeek) ? "background:#8f4b79; color:#fff; border-color:#8f4b79;" : ""; ?>" readonly>
						<input type="text" name="day_of_week[Sun]" class="days" placeholder="Sun" value="<?php echo !empty($dayOfWeek) && in_array("Sun", $dayOfWeek) ? "Sun" : ""; ?>" style="<?php echo !empty($dayOfWeek) && in_array("Sun", $dayOfWeek) ? "background:#8f4b79; color:#fff; border-color:#8f4b79;" : ""; ?>" readonly>
						</div>
						<div class="dailyWrap">
							<div class="row clearfix doserowChk">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" class="checkedvalue" id="morning" <?php echo isset($editPrescriptionData["morning"]) && !empty($editPrescriptionData["morning"]) ? "checked" : ""; ?> > <b></b><span>MORNING</span>
										</label>
									</div>
								</div>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input type="number" name="morning_quantity" class="form-control morningInput" min="0" max="999" value="<?php echo isset($editPrescriptionData["morning_quantity"]) && !empty($editPrescriptionData["morning_quantity"]) ? $editPrescriptionData["morning_quantity"] : ""; ?>" <?php echo isset($editPrescriptionData["morning_quantity"]) && empty($editPrescriptionData["morning_quantity"]) ? "readonly" : ""; ?> >
								
									<div class="doserowselect doserowselectPharmacy <?php echo isset($editPrescriptionData["morning"]) && empty($editPrescriptionData["morning"]) ? "active" : ""; ?>" >
									<input type="hidden" name="morning" class="morning" value="<?php echo isset($editPrescriptionData["morning"]) ? $editPrescriptionData["morning"] : ""; ?>" >
									<a href="javascript:void(0);" class="morningSchedule <?php echo isset($editPrescriptionData["morning"]) && $editPrescriptionData["morning"]=="Before" ? "active" : ""; ?>" >Before</a>
									<a href="javascript:void(0);" class="morningSchedule <?php echo isset($editPrescriptionData["morning"]) && $editPrescriptionData["morning"]=="After" ? "active" : ""; ?>" >After</a> 
									<a href="javascript:void(0);" class="morningSchedule morningAnytime <?php echo isset($editPrescriptionData["morning"]) && $editPrescriptionData["morning"]=="Anytime" ? "active" : ""; ?>" >Anytime</a>
									</div>
								</div>
							</div>
							<div class="row clearfix doserowChk">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" class="checkedvalue" id="afternoon" <?php echo isset($editPrescriptionData["afternoon"]) && !empty($editPrescriptionData["afternoon"]) ? "checked" : ""; ?> > <b></b><span>AFTERNOON</span>
										</label>
									</div>
								</div>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input type="number" name="afternoon_quantity" class="form-control afternoonInput" min="0" max="999" value="<?php echo isset($editPrescriptionData["afternoon_quantity"]) && !empty($editPrescriptionData["afternoon_quantity"]) ? $editPrescriptionData["afternoon_quantity"] : ""; ?>" <?php echo isset($editPrescriptionData["afternoon_quantity"]) && empty($editPrescriptionData["afternoon_quantity"]) ? "readonly" : ""; ?> >
								
									<div class="doserowselect doserowselectPharmacy <?php echo isset($editPrescriptionData["afternoon"]) && empty($editPrescriptionData["afternoon"]) ? "active" : ""; ?>" >
									<input type="hidden" name="afternoon" class="afternoon" value="<?php echo isset($editPrescriptionData["afternoon"]) ? $editPrescriptionData["afternoon"] : ""; ?>" >
									<a href="javascript:void(0);" class="afternoonSchedule <?php echo isset($editPrescriptionData["afternoon"]) && $editPrescriptionData["afternoon"]=="Before" ? "active" : ""; ?>" >Before</a> 
									<a href="javascript:void(0);" class="afternoonSchedule <?php echo isset($editPrescriptionData["afternoon"]) && $editPrescriptionData["afternoon"]=="After" ? "active" : ""; ?>" >After</a> 
									<a href="javascript:void(0);" class="afternoonSchedule afternoonAnytime <?php echo isset($editPrescriptionData["afternoon"]) && $editPrescriptionData["afternoon"]=="Anytime" ? "active" : ""; ?>" >Anytime</a>
									</div>
								</div>
							</div>
							<div class="row clearfix doserowChk">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" class="checkedvalue" id="evening" <?php echo isset($editPrescriptionData["evening"]) && !empty($editPrescriptionData["evening"]) ? "checked" : ""; ?> > <b></b><span>EVENING</span>
										</label>
									</div>
								</div>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input type="number" name="evening_quantity" class="form-control eveningInput" min="0" max="999" value="<?php echo isset($editPrescriptionData["evening_quantity"]) && !empty($editPrescriptionData["evening_quantity"]) ? $editPrescriptionData["evening_quantity"] : ""; ?>" <?php echo isset($editPrescriptionData["evening_quantity"]) && empty($editPrescriptionData["evening_quantity"]) ? "readonly" : ""; ?> >
								
									<div class="doserowselect doserowselectPharmacy <?php echo isset($editPrescriptionData["evening"]) && empty($editPrescriptionData["evening"]) ? "active" : ""; ?>" >
									<input type="hidden" name="evening" class="evening" value="<?php echo isset($editPrescriptionData["evening"]) ? $editPrescriptionData["evening"] : ""; ?>" >
									<a href="javascript:void(0);" class="eveningSchedule <?php echo isset($editPrescriptionData["evening"]) && $editPrescriptionData["evening"]=="Before" ? "active" : ""; ?>" >Before</a> 
									<a href="javascript:void(0);" class="eveningSchedule <?php echo isset($editPrescriptionData["evening"]) && $editPrescriptionData["evening"]=="After" ? "active" : ""; ?>" >After</a> 
									<a href="javascript:void(0);" class="eveningSchedule eveningAnytime <?php echo isset($editPrescriptionData["evening"]) && $editPrescriptionData["evening"]=="Anytime" ? "active" : ""; ?>" >Anytime</a>
									</div>
								</div>
							</div>
							<div class="row clearfix doserowChk">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" class="checkedvalue" id="dinner" <?php echo isset($editPrescriptionData["dinner"]) && !empty($editPrescriptionData["dinner"]) ? "checked" : ""; ?> > <b></b><span>DINNER</span>
										</label>
									</div>
								</div>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input type="number" name="dinner_quantity" class="form-control dinnerInput" min="0" max="999" value="<?php echo isset($editPrescriptionData["dinner_quantity"]) && !empty($editPrescriptionData["dinner_quantity"]) ? $editPrescriptionData["dinner_quantity"] : ""; ?>" <?php echo isset($editPrescriptionData["dinner_quantity"]) && empty($editPrescriptionData["dinner_quantity"]) ? "readonly" : ""; ?> >
								
									<div class="doserowselect doserowselectPharmacy <?php echo isset($editPrescriptionData["dinner"]) && empty($editPrescriptionData["dinner"]) ? "active" : ""; ?>" >
									<input type="hidden" name="dinner" class="dinner" value="<?php echo isset($editPrescriptionData["dinner"]) ? $editPrescriptionData["dinner"] : ""; ?>" >
									<a href="javascript:void(0);" class="dinnerSchedule <?php echo isset($editPrescriptionData["dinner"]) && $editPrescriptionData["dinner"]=="Before" ? "active" : ""; ?>" >Before</a> 
									<a href="javascript:void(0);" class="dinnerSchedule <?php echo isset($editPrescriptionData["dinner"]) && $editPrescriptionData["dinner"]=="After" ? "active" : ""; ?>" >After</a> 
									<a href="javascript:void(0);" class="dinnerSchedule dinnerAnytime <?php echo isset($editPrescriptionData["dinner"]) && $editPrescriptionData["dinner"]=="Anytime" ? "active" : ""; ?>" >Anytime</a></div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<!--<div class="text-right mt-4"> <a href="" class="btn btn-default">RESET</a> 
				<input type="submit" class="btn btn-primary submit checkValidation" value="UPDATE PRESCRIPTION">
			</div>-->
		</li>
		
	</ul>
			
	<input type="hidden" class="productID" name="product_id" value="<?php echo $editPrescriptionData["product_id"]; ?>">
	<div class="batchMainWrap">
		<?php
		if(!empty($editPrescriptionData["inventory"])) {
		foreach($editPrescriptionData["inventory"] as $key => $value) { ?>
		<?php if($key!=0) { ?><div class="appendDiv"><?php } ?>
		<ul class="row batchwrap batchDiv">
			<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="customformwrap">
					<label class="customLabel">BATCH CODE<span class="starClass"> *</span></label>
					<select class="custominput singleselect batchCode" data-id="<?php echo $key+1; ?>" name="inventory_id[]" id="batchCode_<?php echo $key+1; ?>">
						<option value="">Select Batch</option>
						<?php
						if(!empty($inventoryData)) {
						foreach($inventoryData as $inventoryKey => $inventoryValue) { ?>
						<option value="<?php echo $inventoryValue["id"]; ?>" <?php echo $value["inventory_id"]==$inventoryValue["id"] ? "selected" : ""; ?> ><?php echo $inventoryValue["batch_no"]; ?></option>
						<?php } } ?>
					</select>
					<?php if($key==0) { ?>
					<span class="errorClass batchErrorClass">Field Required</span>
					<?php } ?>
					<span class="quantityLeft_<?php echo $key+1; ?>"></span>
				</div>
			</li>
			
			<?php
			if(!empty($inventoryData)) {
			foreach($inventoryData as $inventoryKey => $inventoryValue) {
			if($value["inventory_id"]==$inventoryValue["id"]) { ?>
			<input type="hidden" name="quantity_left[]" class="quantity_left_<?php echo $key+1; ?>" value="<?php echo $inventoryValue["qty_available"]; ?>">
			<input type="hidden" name="total_quantity[]" class="total_quantity_<?php echo $key+1; ?>" value="<?php echo $inventoryValue["quantity"]; ?>">
			<input type="hidden" name="unit_price[]" class="unit_price_<?php echo $key+1; ?>" value="<?php echo $inventoryValue["unit_price"]; ?>">
			<input type="hidden" name="totalPacks[]" class="totalPacks_<?php echo $key+1; ?>" value="<?php echo $inventoryValue["no_of_pack"]; ?>">
			<?php } } } ?>
			
			<li class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="customformwrap">
					<label class="customLabel">QUANTITY</label>
					<input type="text" class="custominput quantity_<?php echo $key+1; ?>" name="quantity[]" value="<?php echo $value["quantity"]; ?>"/>
				</div>
			</li>
			<li class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
				<div class="customformwrap">
					<label class="customLabel">PRODUCT EXPIRY</label>
					<input type="text" class="custominput expiry_<?php echo $key+1; ?>" value="<?php echo $value["expiry_date"]; ?>" name="expiry_date[]" readonly/>
					<!--<input type="text" class="custominput approvalDate">
					<b class="sprite clderIcon cld_icon clderIconClick"></b>-->
				</div>
			</li>
			<li class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
				<div class="addmoreBtn repear_bClick"><b class="sprite addplusIcon <?php echo $key==0 ? "addInventory" : "removeInventory"; ?>"></b></div>
			</li>
		</ul>
		<?php if($key!=0) { ?></div><?php } ?>
		<?php } }
		else { ?>
		<ul class="row batchwrap batchDiv">
			<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="customformwrap">
					<label class="customLabel">BATCH CODE</label>
					<select class="custominput singleselect batchCode_1" data-id="1" name="inventory_id[]" id="batchCode_1">
						<option value="0">Select Batch</option>
					</select>
					<span class="quantityLeft_1"></span>
				</div>
			</li>
			<li class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="customformwrap">
					<label class="customLabel">QUANTITY</label>
					<input type="text" class="custominput quantity_1" name="quantity[]"/>
				</div>
			</li>
			<li class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
				<div class="customformwrap">
					<label class="customLabel">PRODUCT EXPIRY</label>
					<input type="text" class="custominput expiry_1" readonly/>
					<!--<input type="text" class="custominput approvalDate">
					<b class="sprite clderIcon cld_icon clderIconClick"></b>-->
				</div>
			</li>
			<li class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
				<div class="addmoreBtn repear_bClick"><b class="sprite addplusIcon addInventory"></b></div>
			</li>
		</ul>	
		<?php } ?>
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
			<input type="button" class="btn btn-primary submit checkValidation" value="UPDATE">
		</div>

	</div>

</div>