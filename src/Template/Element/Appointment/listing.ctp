<?php
if(isset($appointmentData) && !empty($appointmentData)) {
foreach($appointmentData as $key => $value) {
if($value["doctor_detail"]["is_active"] && $value["doctor_detail"]["is_active"]==1) { ?>
	<tr class="row_<?php echo $value["id"]; ?>">
		<td>
			<span>
				<p><?php echo isset($value["appointment_date1"]) ? date("d M Y",strtotime($value["appointment_date1"])) : ""; ?></p>
				<p><?php echo isset($value["appointment_time"]) ? $value["appointment_time"] : ""; ?></p>
			</span>
		</td>
		<?php if($this->request->getSession()->read('role_id')==1) { ?>
		<td>
			<span class="userName chengecolor">Dr. <?php echo isset($value["doctor_detail"]["first_name"]) ? $value["doctor_detail"]["first_name"]." ".$value["doctor_detail"]["middle_name"]." ".$value["doctor_detail"]["last_name"] : ""; ?></span>
		</td>
		<?php } ?>
		<td>
			<span class="userName chengecolor patientName"><?php echo isset($value["patient_detail"]["fname"]) ? $value["patient_detail"]["fname"]." ".$value["patient_detail"]["mname"]." ".$value["patient_detail"]["lname"] : ""; ?></span>
		</td>
		<td>
			<span class="chengecolor"><?php echo isset($value["patient_detail"]["m_number"]) ? $value["patient_detail"]["m_number"] : ""; ?></span>
		</td>
		
		<?php
		$queueData = isset($queueData) ? $queueData : "";
		$paymentDone = isset($paymentDone) ? $paymentDone : "";
		$id = $value["id"];
		?>
		<td>
			<span class="movequeueBtn moveToQueue moveToQueue_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" style="display:<?php echo $value["queue_data"]==1 || $value["payment_data"]==2 ? "none" : "block"; ?>; pointer-events:<?php echo strtotime($value["appointment_date1"]) < strtotime(date("Y-m-d")) ? "none" : ""; ?>;" >Move to Queue</span>
			
			<span class="movequeueBtn removeFromQueue removeFromQueue_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" style="display:<?php echo $value["queue_data"]==0 || $value["payment_data"]==1 || $value["payment_data"]==2 ? "none" : "block"; ?>; pointer-events:<?php echo strtotime($value["appointment_date1"]) < strtotime(date("Y-m-d")) ? "none" : ""; ?>;" >Remove Queue</span>
			
			<span class="movequeueBtn paymentPending_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" style="display:<?php echo $value["payment_data"]==1 ? "block" : "none"; ?>; pointer-events:<?php echo strtotime($value["appointment_date1"]) < strtotime(date("Y-m-d")) ? "none" : ""; ?>; background-color:red;" >Payment Pending</span>
			
			<span class="movequeueBtn paymentDone_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" style="display:<?php echo $value["payment_data"]==2 ? "block" : "none"; ?>; pointer-events:<?php echo strtotime($value["appointment_date1"]) < strtotime(date("Y-m-d")) ? "none" : ""; ?>; background-color:green;" >Payment Done</span>
		</td>
		
		<td>
			<div class="usermoreOpction">
				<!--<a href="<?php //echo $this->Url->build(["controller"=>"Appointment","action"=>"appointment_details",base64_encode($value["id"])]); ?>">View</a> 
				<a href="<?php //echo $this->Url->build(["controller"=>"Appointment","action"=>"reschedule_appointment",base64_encode($value["id"])]); ?>" class="colorBrown">Reschedule</a>--> 
				<a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"appointment_details",$value["id"]]); ?>">View</a> 
				<a href="<?php echo $this->Url->build(["controller"=>"Appointment","action"=>"reschedule_appointment",$value["id"]]); ?>" class="colorBrown reschedule reschedule_<?php echo $value["id"]; ?>" style="display:<?php echo $value["payment_data"]==1 || $value["payment_data"]==2 ? "none" : "inline-block"; ?>" >Reschedule</a> 
				<a href="#" class="colorBrown cancelLink cancelLink_<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>" data-toggle="modal" data-target="#cancelModal" style="display:<?php echo $value["payment_data"]==1 || $value["payment_data"]==2 ? "none" : "inline-block"; ?>" >Cancel</a>
			</div>
		</td>
	</tr>
<?php } } }

else
{ ?>
	<tr>
		<td><?php echo "No Data available in table"; ?></td>
		<?php if($this->request->getSession()->read('role_id')==1) { ?>
		<td></td>
		<?php } ?>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
<?php }
?>