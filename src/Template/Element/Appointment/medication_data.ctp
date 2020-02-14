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
					<input type="radio" class="product_search_by" name="product_search_by" value="1" <?php echo isset($medicationData["product_search_by"]) && $medicationData["product_search_by"]==1 ? "checked" : ""; ?> ><span class="product_search_by_text">Product</span>
					<input type="radio" class="product_search_by" name="product_search_by" value="2" <?php echo isset($medicationData["product_search_by"]) && $medicationData["product_search_by"]==2 ? "checked" : ""; ?> ><span class="product_search_by_text">Molecule</span>
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
				<!--<input autocomplete="off" type="text" class="custominput mandatory " name="product_name" value="<?php echo isset($medicationData["product_guid"]) ? $medicationData["product_guid"] : ""; ?>" >-->
				<!--<select class="custominput singleselect product_name" id="product_name" name="product_name">-->
				<select class="product_name" id="product_name" name="product_name">
					<option value="<?php echo isset($medicationData["product_guid"]) ? $medicationData["product_guid"]."_".$medicationData["product_name"] : ""; ?>">
						<?php echo isset($medicationData["product_name"]) ? $medicationData["product_name"] : ""; ?>
					</option>
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
						<input autocomplete="off" type="text" id="qty" class="custominput" name="dosage_qty" value="<?php echo isset($medicationData["dosage_qty"]) ? $medicationData["dosage_qty"] : ""; ?>" /> <small class="text-muted text-right center-block"><span class="formName"></span></small> </div>
				</div>-->
				<input type="hidden" name="product_type" class="product_type" value="<?php echo isset($medicationData["product_type"]) ? $medicationData["product_type"] : ""; ?>">
				<div class="frequencyDiv" style="display:<?php echo isset($medicationData["abbreviation"]) && empty($medicationData["abbreviation"]) ? "block" : "none"; ?>" >
				<div class="col-md-6 col-sm-12">
					<div class="customformwrap">
						<label class="customLabel">FREQUENCY</label>
						<div class="defaultTime1">
							<select id="secudelMedician" class="custominput singleselect dosage_frequency" name="dosage_frequency">
								<option <?php echo isset($medicationData["dosage_frequency"]) && $medicationData["dosage_frequency"]=="Daily" ? "selected" : ""; ?> >Daily</option>
								<option <?php echo isset($medicationData["dosage_frequency"]) && $medicationData["dosage_frequency"]=="Weekly" ? "selected" : ""; ?> >Weekly</option>
								<!--<option>Monthly</option>-->
							</select>
						</div>
						<div class="customtime1" style="display:none;" >
							<input type="text" class="custominput witoutbg" name="dosage_no_frequency" value="<?php echo isset($medicationData["custom_times"]) && !empty($medicationData["custom_times"]) ? $medicationData["dosage_frequency"] : ""; ?>" /> 
						</div>
					</div>
				</div>
				</div>
				<div class="col-sm-12"> </div>
				<div class="col-md-6 col-sm-12">
					<div class="customformwrap">
						<label class="customLabel">DURATION</label>
						<input autocomplete="off" type="text" id="price" class="custominput" name="duration_no" value="<?php echo isset($medicationData["duration_no"]) ? $medicationData["duration_no"] : ""; ?>" /> </div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="customformwrap">
						<label class="customLabel">&nbsp;</label>
						<div class="defaultTime1">
							<select class="custominput singleselect defaultTime duration_frequency" name="duration_frequency">
								<option <?php echo isset($medicationData["duration_frequency"]) && $medicationData["duration_frequency"]=="Day" ? "selected" : ""; ?> >Day</option>
								<option <?php echo isset($medicationData["duration_frequency"]) && $medicationData["duration_frequency"]=="Week" ? "selected" : ""; ?> >Week</option>
								<!--<option>Month</option>-->
							</select>
						</div>
						<div class="customtime1" style="display:none;" >
							<input type="text" class="custominput witoutbg" name="duration_no_frequency" value="<?php echo isset($medicationData["custom_times"]) && !empty($medicationData["custom_times"]) ? $medicationData["duration_frequency"] : ""; ?>" /> </div>
					</div>
				</div>
				<div class="col-md-5 col-sm-12 mt-4">
					<div class="customformwrap qua_input">
						<label class="customLabel">TOTAL QUANTITY</label>
						<input type="text" id="total" class="custominput" name="total_qty" value="<?php echo isset($medicationData["total_qty"]) ? $medicationData["total_qty"] : ""; ?>" /> </div> <small class="text-muted">Tablets</small> </div>
				<div class="col-md-12 col-sm-12 mt-4">
					<div class="customformwrap">
						<label class="customLabel">Notes</label>
						<textarea class="custominput" name="notes"><?php echo isset($medicationData["notes"]) ? $medicationData["notes"] : ""; ?></textarea>
					</div>
				</div>
			</div>
		</li>
		<li class="col-md-7 col-sm-12">
		
		<input type="hidden" name="customCheck" class="customCheck" value="<?php echo isset($medicationData["custom_times"]) && !empty($medicationData["custom_times"]) ? 1 : ""; ?>" >
		
			<div class="doserowWrap">
				<!-- CUSTOM TIME -->
				<div class="customtime" style="display:<?php echo isset($medicationData["custom_times"]) && !empty($medicationData["custom_times"]) ? "block" : "none"; ?>" >
					<div class="doserowHeader clearfix">
						<p class="col-lg-8 col-md-7 col-sm-12 col-xs-12 title">CUSTOM TIME</p>
						<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 alignright"><span class="addtimingClick">ADD TIMINGS</span></div>
					</div>
					<?php
					$customTimes = isset($medicationData["custom_times"]) ? json_decode($medicationData["custom_times"],true) : "";
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
								<textarea class="form-control abbreviation_meaning abbreviation_meaning_0" readonly name="abbreviation_meaning[]" rows="3"><?php echo isset($customTimes[0]["abbreviation_meaning"]) ? $customTimes[0]["abbreviation_meaning"] : ""; ?></textarea>
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
				<div class="defaultTime" style="display:<?php echo isset($medicationData["custom_times"]) && empty($medicationData["custom_times"]) ? "block" : "none"; ?>" >
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
						$dayOfWeek = isset($medicationData["day_of_week"]) && !empty($medicationData["day_of_week"]) ? explode(",",$medicationData["day_of_week"]) : ""; ?>
						<div class="weeklyWrap" style="display:<?php echo isset($medicationData["dosage_frequency"]) && $medicationData["dosage_frequency"]=="Weekly" ? "block" : "none"; ?>">
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
											<input type="checkbox" class="checkedvalue" id="morning" <?php echo isset($medicationData["morning"]) && !empty($medicationData["morning"]) ? "checked" : ""; ?> > <b></b><span>MORNING</span></label>
									</div>
								</div>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input type="number" name="morning_quantity" class="form-control morningInput" min="0" max="999" value="<?php echo isset($medicationData["morning_quantity"]) && !empty($medicationData["morning_quantity"]) ? $medicationData["morning_quantity"] : ""; ?>" <?php echo isset($medicationData["morning_quantity"]) && empty($medicationData["morning_quantity"]) ? "readonly" : ""; ?> >
								
									<div class="doserowselect doserowselectPharmacy <?php echo isset($medicationData["morning"]) && empty($medicationData["morning"]) ? "active" : ""; ?>" >
									<input type="hidden" name="morning" class="morning" value="<?php echo isset($medicationData["morning"]) ? $medicationData["morning"] : ""; ?>" >
									<a href="javascript:void(0);" class="morningSchedule <?php echo isset($medicationData["morning"]) && $medicationData["morning"]=="Before" ? "active" : ""; ?>" >Before</a> 
									<a href="javascript:void(0);" class="morningSchedule <?php echo isset($medicationData["morning"]) && $medicationData["morning"]=="After" ? "active" : ""; ?>" >After</a> 
									<a href="javascript:void(0);" class="morningSchedule <?php echo isset($medicationData["morning"]) && $medicationData["morning"]=="Anytime" ? "active" : ""; ?>" >Anytime</a>
									</div>
								</div>
							</div>
							<div class="row clearfix doserowChk">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" class="checkedvalue" id="afternoon" <?php echo isset($medicationData["afternoon"]) && !empty($medicationData["afternoon"]) ? "checked" : ""; ?> > <b></b><span>AFTERNOON</span></label>
									</div>
								</div>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input type="number" name="afternoon_quantity" class="form-control afternoonInput" min="0" max="999" value="<?php echo isset($medicationData["afternoon_quantity"]) && !empty($medicationData["afternoon_quantity"]) ? $medicationData["afternoon_quantity"] : ""; ?>" <?php echo isset($medicationData["afternoon_quantity"]) && empty($medicationData["afternoon_quantity"]) ? "readonly" : ""; ?> >
								
									<div class="doserowselect doserowselectPharmacy <?php echo isset($medicationData["afternoon"]) && empty($medicationData["afternoon"]) ? "active" : ""; ?>" >
									<input type="hidden" name="afternoon" class="afternoon" value="<?php echo isset($medicationData["afternoon"]) ? $medicationData["afternoon"] : ""; ?>" >
									<a href="javascript:void(0);" class="afternoonSchedule <?php echo isset($medicationData["afternoon"]) && $medicationData["afternoon"]=="Before" ? "active" : ""; ?>" >Before</a> 
									<a href="javascript:void(0);" class="afternoonSchedule <?php echo isset($medicationData["afternoon"]) && $medicationData["afternoon"]=="After" ? "active" : ""; ?>" >After</a> 
									<a href="javascript:void(0);" class="afternoonSchedule <?php echo isset($medicationData["afternoon"]) && $medicationData["afternoon"]=="Anytime" ? "active" : ""; ?>" >Anytime</a>
									</div>
								</div>
							</div>
							<div class="row clearfix doserowChk">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" class="checkedvalue" id="evening" <?php echo isset($medicationData["evening"]) && !empty($medicationData["evening"]) ? "checked" : ""; ?> > <b></b><span>EVENING</span></label>
									</div>
								</div>
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<input type="number" name="evening_quantity" class="form-control eveningInput" min="0" max="999" value="<?php echo isset($medicationData["evening_quantity"]) && !empty($medicationData["evening_quantity"]) ? $medicationData["evening_quantity"] : ""; ?>" <?php echo isset($medicationData["evening_quantity"]) && empty($medicationData["evening_quantity"]) ? "readonly" : ""; ?> >
								
									<div class="doserowselect doserowselectPharmacy <?php echo isset($medicationData["evening"]) && empty($medicationData["evening"]) ? "active" : ""; ?>" >
									<input type="hidden" name="evening" class="evening" value="<?php echo isset($medicationData["evening"]) ? $medicationData["evening"] : ""; ?>" >
									<a href="javascript:void(0);" class="eveningSchedule <?php echo isset($medicationData["evening"]) && $medicationData["evening"]=="Before" ? "active" : ""; ?>" >Before</a> 
									<a href="javascript:void(0);" class="eveningSchedule <?php echo isset($medicationData["evening"]) && $medicationData["evening"]=="After" ? "active" : ""; ?>" >After</a> 
									<a href="javascript:void(0);" class="eveningSchedule <?php echo isset($medicationData["evening"]) && $medicationData["evening"]=="Anytime" ? "active" : ""; ?>" >Anytime</a>
									</div>
								</div>
							</div>
							<div class="row clearfix doserowChk">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="customcheckbox">
										<label>
											<input type="checkbox" class="checkedvalue" id="dinner" <?php echo isset($medicationData["dinner"]) && !empty($medicationData["dinner"]) ? "checked" : ""; ?> > <b></b><span>NIGHT</span></label>
									</div>
								</div>
								<div class="col-md-9 col-sm-12 col-xs-12">
									<input type="number" name="dinner_quantity" class="form-control dinnerInput" min="0" max="999" value="<?php echo isset($medicationData["dinner_quantity"]) && !empty($medicationData["dinner_quantity"]) ? $medicationData["dinner_quantity"] : ""; ?>" <?php echo isset($medicationData["dinner_quantity"]) && empty($medicationData["dinner_quantity"]) ? "readonly" : ""; ?> >
								
									<div class="doserowselect doserowselectPharmacy <?php echo isset($medicationData["dinner"]) && empty($medicationData["dinner"]) ? "active" : ""; ?>" >
									<input type="hidden" name="dinner" class="dinner" value="<?php echo isset($medicationData["dinner"]) ? $medicationData["dinner"] : ""; ?>" >
									<a href="javascript:void(0);" class="dinnerSchedule <?php echo isset($medicationData["dinner"]) && $medicationData["dinner"]=="Before" ? "active" : ""; ?>" >Before</a> 
									<a href="javascript:void(0);" class="dinnerSchedule <?php echo isset($medicationData["dinner"]) && $medicationData["dinner"]=="After" ? "active" : ""; ?>" >After</a> 
									<a href="javascript:void(0);" class="dinnerSchedule <?php echo isset($medicationData["dinner"]) && $medicationData["dinner"]=="Anytime" ? "active" : ""; ?>" >Anytime</a></div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="text-right mt-4"> <a href="" class="btn btn-default">RESET</a> 
			<input type="submit" class="btn btn-primary submit" value="ADD TO PRESCRIPTION">
			<!--<a class="btn btn-primary submit">ADD TO PRESCRIPTION</a>--> 
			</div>
		</li>
	</ul>
</div>