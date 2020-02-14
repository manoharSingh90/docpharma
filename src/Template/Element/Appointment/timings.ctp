<?php

if(isset($doctorTiming) && !empty($doctorTiming)) {
foreach($doctorTiming as $key => $value) {
	
	$count = 0;
	for($time=strtotime($value["start_time"]." ".$value["start_meridiem"]); $time<=strtotime($value["end_time"]." ".$value["end_meridiem"]); $time+=(60*$value["duration_time"]))
	{ $count++; ?>
	
	<?php if(empty($savedTiming)) { ?>
		<tr>
			<td>
				<div class="customradio appradio">
					<label>
						<?php
						
						//CHECK BLACKOUT DATES
						if(array_key_exists($currentDate,$checkBlackout))
						{
							if($currentDate==date("d M Y"))
							{
								if($time > strtotime(date("h:i A", strtotime("+330 minutes"))))
								{
									if(strtotime($checkBlackout[$currentDate]["blackout_starttime"])<=$time && $time<=strtotime($checkBlackout[$currentDate]["blackout_endtime"]))
									{
									}
									else
									{ ?>
										<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
									<?php }
								}
							}
							else
							{
								if(strtotime($checkBlackout[$currentDate]["blackout_starttime"])<=$time && $time<=strtotime($checkBlackout[$currentDate]["blackout_endtime"]))
								{
								}
								else
								{ ?>
									<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
								<?php }
							}
						}
						//CHECK BLACKOUT DATES
						else
						{
							if($currentDate==date("d M Y")) {
							if($time > strtotime(date("h:i A", strtotime("+330 minutes")))) { ?>
							<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
							<?php } }
							else { ?>
							<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
							<?php }
						} ?>
						
						<span class="chengecolor"><?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?></span>
					</label>
				</div>
			</td>
			<td><span class="yettitle noAppointmentDiv noAppointmentDiv_<?php echo $key.$count; ?>">No Appointment yet</span></td>
			<td><span class="chengecolor">&nbsp;</span></td>
			<td>
				<div class="form-group textareaDiv textareaDiv_<?php echo $key.$count; ?>" style="display: none;">
					<textarea class="form-control" name="comments[]"></textarea>
				</div>
			</td>
		</tr>
	<?php }
	
	else { ?>
	
		<?php if(in_array(date('h:i A', strtotime(gmdate("H:i",$time))),array_column($savedTiming, 'appointment_time')) && in_array($currentDate,array_column($savedTiming, 'appointment_date'))) {
			
		$checkKey = array_keys(array_column($savedTiming, 'appointment_time'), date('h:i A', strtotime(gmdate("H:i",$time))));
		$checkKey = $checkKey[0];
		?>
		<tr>
			<td>
				<span class="alignTd timingsSpan"><?php echo isset($savedTiming[$checkKey]["appointment_time"]) ? $savedTiming[$checkKey]["appointment_time"] : ""; ?></span>
			</td>
			<td>
				<span class="userName chengecolor"><?php echo isset($savedTiming[$checkKey]["patient_detail"]["fname"]) ? $savedTiming[$checkKey]["patient_detail"]["fname"]." ".$savedTiming[$checkKey]["patient_detail"]["mname"]." ".$savedTiming[$checkKey]["patient_detail"]["lname"] : ""; ?></span>
			</td>
			<td>
				<span class="chengecolor"><?php echo isset($savedTiming[$checkKey]["patient_detail"]["m_number"]) ? $savedTiming[$checkKey]["patient_detail"]["m_number"] : ""; ?></span>
			</td>
			<td><?php echo isset($savedTiming[$checkKey]["comments"]) ? $savedTiming[$checkKey]["comments"] : ""; ?></td>
		</tr>
		<?php }
		
		else { ?>
		<tr>
			<td>
				<div class="customradio appradio">
					<label>
						<?php
						//CHECK BLACKOUT DATES
						if(array_key_exists($currentDate,$checkBlackout))
						{
							if($currentDate==date("d M Y"))
							{
								if($time > strtotime(date("h:i A", strtotime("+330 minutes"))))
								{
									if(strtotime($checkBlackout[$currentDate]["blackout_starttime"])<=$time && $time<=strtotime($checkBlackout[$currentDate]["blackout_endtime"]))
									{
									}
									else
									{ ?>
										<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
									<?php }
								}
							}
							else
							{
								if(strtotime($checkBlackout[$currentDate]["blackout_starttime"])<=$time && $time<=strtotime($checkBlackout[$currentDate]["blackout_endtime"]))
								{
								}
								else
								{ ?>
									<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
								<?php }
							}
						}
						//CHECK BLACKOUT DATES
						else
						{
							if($currentDate==date("d M Y")) {
							if($time > strtotime(date("h:i A", strtotime("+330 minutes")))) { ?>
							<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
							<?php } }
							else { ?>
							<input type="radio" class="appointment_time" data-id="<?php echo $key.$count; ?>" name="appointment_time" value="<?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?>"><b></b>
							<?php }
						} ?>
						<span class="chengecolor"><?php echo date('h:i A', strtotime(gmdate("H:i",$time))); ?></span>
					</label>
				</div>
			</td>
			<td><span class="yettitle noAppointmentDiv noAppointmentDiv_<?php echo $key.$count; ?>">No Appointment yet</span></td>
			<td><span class="chengecolor">&nbsp;</span></td>
			<td>
				<div class="form-group textareaDiv textareaDiv_<?php echo $key.$count; ?>" style="display: none;">
					<textarea class="form-control" name="comments[]"></textarea>
				</div>
			</td>
		</tr>
		<?php } ?>
	
	<?php }


} } } ?>