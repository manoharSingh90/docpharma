<?php if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}
 $today = date("H:i"); //die;
sscanf($today, "%d:%d:%d", $hours1, $minutes1, $seconds1);
$today_time_seconds = isset($hours1) ? $hours1 * 3600 + $minutes1 * 60 + $seconds1 : $minutes1 * 60 + $seconds1; 
//pre($list); die;
?> 

<?php if(isset($list) && !empty($list)){ foreach($list as $lists){
	  if(($lists['bulkcancellation_status']==1)){
$givendate=date("H:i", strtotime($lists['appointment_time1'])); //die;
sscanf($givendate, "%d:%d:%d", $hours, $minutes, $seconds);
$given_time_seconds = isset($hours) ? $hours * 3600 + $minutes * 60 + $seconds : $minutes * 60 + $seconds;
$app = explode(',',$lists['appointment_time1']);
$time = strtotime($lists['appointment_date1']);
$newformat = date('Y-m-d',$time); 
 //die;  
?>       
<tr>
<td>
<div class="customcheckbox timeCheck">
<label>
<?php //echo $app[0]." ".date("m")." ".$lists['appointment_date1'];
if(($newformat == date('Y-m-d'))) {
if(($given_time_seconds >= $today_time_seconds) && (($lists['payment_data']==0) && ($lists['queue_data']==0))) { ?> 
<input type="checkbox" name="check[]" data-name="checkbox" value="<?= $lists['id']; ?>"><b></b>
<?php } }  else { ?>
<input type="checkbox" name="check[]" data-name="checkbox" value="<?= $lists['id']; ?>"><b></b>
<?php } ?>
<span class="chengecolor"><?= $app[1]; ?></span></label>
</div>
</td>
<td><span class="userName chengecolor">
<?php foreach($data as $daa){ echo $daa['id']==$lists['patient_id']?$daa['fname'].' '.$daa['mname'].' '.$daa['lname']:''; }?></span></td>
<td><span class="chengecolor"><?php foreach($data as $daa){ $explCountry = explode(',' ,$daa['country_code']); $explNum = explode(',' ,$daa['m_number']); echo $daa['id']==$lists['patient_id']?$explCountry[0]." ".$explNum[0]:'';}?></span></td>
<td><?php echo $lists['comments']?> </td>
</tr>
<?php } } } ?>

