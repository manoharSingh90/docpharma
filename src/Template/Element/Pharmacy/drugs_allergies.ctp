
<div class="shidulTimeWrap drugsDiv">
	<div class="shidulTimeHeader"> <b><i class="sprite drug-Sm-Icon"></i></b>DRUG INTERACTION<sup><i class="sprite errorPinkIcon"></i></sup> <span class="arrowCkeck pull-right"><b><i class="sprite arrowupIcon"></i></b></span></div>

	<div class="shidulTimebody drugDetails">
		<p class="shidulTimebody-title drugInteractions"></p>

		<ul class="clearfix">
		<?php
		if(isset($savedPatientDrugs) && !empty($savedPatientDrugs)) {
		foreach($savedPatientDrugs as $key => $value) {
		$productGUID[] = $value["product_guid"];
		} } ?>
		<textarea class="productGUID" rows="5" cols="30" style="display:none;"><?php echo isset($productGUID) ? implode(",",$productGUID) : ""; ?></textarea>
		
		<?php
		if(isset($savedPatientDrugs) && !empty($savedPatientDrugs)) {
		foreach($savedPatientDrugs as $key => $value) {
		$dayCheck = isset($value["day_of_week"]) && !empty($value["day_of_week"]) ? ' ('.$value["day_of_week"].')' : "";
		$date = explode(" ",$value["created_dttm"]); ?>
			<li class="col-lg-5 col-md-4 col-sm-12 col-xs-12">
				<div class="madicainSlt">
					<span><?php echo $value["product_name"]; ?></span>
				</div>
			</li>
			<li class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
				<div class="madicainByDate">
				  <p>Prescribed On <?php echo $date[0]; ?></p>
				</div>
			</li>
			<li class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="madicainTime">
				<ul>
					<li><?php echo $value["total_qty"]." ".$value["product_type"]; ?></li>
					<li><?php echo $value["duration_no"]." ".$value["duration_frequency"]; ?></li>
				</ul>
				</div>
			</li>
			<div class="clearfix"></div>
		<?php } } ?>
		</ul>
	</div>

	<div class="shidulTimefooter">
		<!--<a href="javascript:void(0)"><b><i class="sprite printIcon"></i></b> Print</a>-->
		<a href="javascript:void(0)" class="sprite emailIcon"><b style="margin-left:27px;"><i class=""></i>Email</b> </a>
	</div>
	
	<div class="emailMessage" style="display:none; text-align:left; color:green;">Mail sent successfully</div>
</div>


<?php
$allergyData = isset($savedPatientAllergies["allergy"]) && !empty($savedPatientAllergies["allergy"]) ? explode(",",$savedPatientAllergies["allergy"]) : "";

if(isset($allergyData) && !empty($allergyData)) {
foreach($allergyData as $key => $value) {
$explode = explode("_",$value);
$allergyGUID[] = $explode[0];
} } ?>
<textarea class="allergyGUID" rows="5" cols="30" style="display:none;"><?php echo isset($allergyGUID) ? implode(",",$allergyGUID) : ""; ?></textarea>
		
<div class="shidulTimeWrap allergiesDiv">
	<div class="shidulTimeHeader">
		<b><i class="sprite generics-Sm-Icon"></i></b>ALLERGIES<sup><i class="sprite errorPinkIcon"></i></sup> <span class="arrowCkeck pull-right"><b><i class="sprite arrowupIcon"></i></b></span>
	</div>

	<div class="shidulTimebody allergyDetails">
		<p class="shidulTimebody-title allergyInteractions"></p>
		<ul class="clearfix">
			<?php
			if(isset($allergyData) && !empty($allergyData)) {
			foreach($allergyData as $key => $value) {
			$explode = explode("_",$value); ?>
			<li class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
				<div class="madicainSlt">
					<span><?php echo $explode[1]; ?></span>
				</div>
			</li>
			<?php } } ?>
		</ul>
	</div>
</div>