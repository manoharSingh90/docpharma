<div class="col-lg-4 col-md-4 col-sm-12 pull-right">
	<div class="mediciandetailWrap">
		<ul class="medician-main">
			<li class="medicianList">
				<div class="medicianTitle toggleHead"><span>Medical history </span> <!--<small class="pull-right printericon"> <b class="sprite printIcon"></b></small>--> </div>
				<div class="toggleContent">
				
				<textarea class="oldCondtions" cols="20" rows="4" style="display:none;"><?php echo isset($appointmentDetails["patient_detail"]["conditions"]) ? $appointmentDetails["patient_detail"]["conditions"] : ""; ?></textarea>
				
					<div class="repeathistory">
						<div class="medicianSubTitle">
							<p class="toggleSubHead">Conditions </p>
						</div>
						<div class="toggleSubContent">
							<ul class="medicianSub-wrap">
								<li class="medicianSub-list">
									<div class="text-center firsttimevisi">
										<div class="noyet"><input type="text" class="condtionsData"></div>
										<div class="linedefaultbtn saveConditions"> <span>ADD</span> </div>
									</div>
								</li>
							</ul>
							
							<div class="conditionList">
								<?php
								if(isset($appointmentDetails["patient_detail"]["conditions"]) && !empty($appointmentDetails["patient_detail"]["conditions"])) {
								$conditionData = explode(",",$appointmentDetails["patient_detail"]["conditions"]);
								foreach($conditionData as $key => $value) { ?>
									<span>* <?php echo $value; ?></span>
								<?php } } ?>
							</div>
							
						</div>
					</div>
					<div class="repeathistory">
						<div class="medicianSubTitle">
							<p class=" toggleSubHead active">Allergies</p> <a class="mediedit saveAllergy">Save</a> </div>
						<div class="toggleSubContent" style="display: block;">
							<div class="creatallegies clearfix">
								<div class="addorderarea">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="selectnation">
											<div class="sltbox-wrap">
											<div class="customformwrap">
												<label class="customLabel">Allergy NAME</label>
												<select class="custominput singleselect allergyData" id="allergyData">
													<option value="">Select Allergy</option>
												</select>
											</div>
								<input type="hidden" class="doctorID" value="<?php echo isset($appointmentDetails["doctor_detail"]["id"]) ? $appointmentDetails["doctor_detail"]["id"] : ""; ?>" >
								<input type="hidden" class="patientID" value="<?php echo isset($appointmentDetails["patient_detail"]["id"]) ? $appointmentDetails["patient_detail"]["id"] : ""; ?>" >
								<textarea class="oldAllergy" cols="50" rows="4" style="display:none;"><?php echo isset($appointmentDetails["patient_detail"]["allergy"]) ? $appointmentDetails["patient_detail"]["allergy"] : ""; ?></textarea>
											</div>
										</div>
								
									<div class="allergyList">
										<?php
										if(isset($appointmentDetails["patient_detail"]["allergy"]) && !empty($appointmentDetails["patient_detail"]["allergy"])) {
										$allergyData = explode(",",$appointmentDetails["patient_detail"]["allergy"]);
										foreach($allergyData as $key => $value) {
										$allergyName = explode("_",$value); ?>
											<span>* <?php echo $allergyName[1]; ?></span>
										<?php } } ?>
									</div>
								
									</div>
									
								
									<!--<div class="addPlusWrap">
										<div class="col-lg-12">
											<div class="addPlus">
												<div class="customformwrap">
													<input type="text" placeholder="Add Other Allergies" id="allergiInput" class="custominput chkValue newAllergy" /> <span class="addprod allergiesClick">Add</span> </div>
											</div>
										</div>
										<div class="col-lg-12">
											<ul class="addtagswrap" id="addtagsallergies"> </ul>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="showValue">
											<ul> </ul>
										</div>
									</div>-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
	
	<?php if($this->request->getSession()->read('role_id')==2 && $this->request->getParam('action')=="doctorConsultant") { ?>
	<div class="">
		<div class="combgcolor">
			<div class="sameHeadAfter">PRESCRIPTION</div>
			<?php
			if(isset($prescriptionData) && !empty($prescriptionData)) {
			foreach($prescriptionData as $key => $value) {
			$productGUID[] = $value["product_guid"];
			} } ?>
			<textarea class="productGUID" rows="5" cols="30" style="display:none;"><?php echo isset($productGUID) ? implode(",",$productGUID) : ""; ?></textarea>
			<div class="itemsell">
				<p>DOSAGES</p>
				
				<?php
				if(isset($prescriptionData) && !empty($prescriptionData)) {
				foreach($prescriptionData as $key => $value) {
				if(!empty($value["product_name"])) {
					
				$customTimes = $value["custom_times"] && !empty($value["custom_times"]) ? json_decode($value["custom_times"],true) : "";
				
				$dayCheck = isset($value["day_of_week"]) && !empty($value["day_of_week"]) ? ' ('.$value["day_of_week"].')' : ""; ?>
				
				<div class="repeatbilling repeatmedici" id="prescriptionDiv_<?php echo $value["dvID"]; ?>" >
					<div class="itemsellslt clearfix">
						<div class="pull-left medicianWrap"> <b class="sprite deleteIcon" data-toggle="modal" data-target="#deleteModal_<?php echo $value["dvID"]; ?>"></b>
						<small>1</small>
						<span><?php echo $value["product_name"]; ?></span>
						<p><?php echo $value["duration_no"]." ".$value["duration_frequency"].$dayCheck; ?></p>
						</div>
						<div class="pull-right editPrice text-right">
							<b><?php echo $value["total_qty"]." ".$value["product_type"]; ?></b> 
							<span class="edit" id="<?php echo $value["dvID"]; ?>" data-id="<?php echo $value["ppID"]; ?>">Edit</span> 
						</div>
					</div>
					<div class="itemsellmedici">
					
						<?php
						if(isset($customTimes) && !empty($customTimes)) {
						foreach($customTimes as $timesKey => $timesValue) { ?>
							<span class="clearfix">
								<?php //echo "* ".$timesValue["time"]." ".$timesValue["meridiem"]." (".$timesValue['meridiem_quantity']." Tablets)"; ?>
								<?php echo "* ".$timesValue["time"]." (".$timesValue["abbreviation_meaning"].")"; ?>
							</span>
						<?php } }
						
						else if($value["abbreviation_meaning"] && !empty($value["abbreviation_meaning"])) {
						$abbreviationData = explode(" ",$value["abbreviation_meaning"]);
						foreach($abbreviationData as $abbreviationKey => $abbreviationValue) {
						if(!empty($abbreviationValue)) { ?>
							<span class="clearfix">
								<?php echo "* ".$abbreviationValue; ?>
							</span>
						<?php } } }
						
						else { ?>
							<span style="display:block;"><?php echo ($value["morning"]=="Anytime") ? "* Take in the Morning (".$value["morning_quantity"]." ".$value["product_type"].")" : ((!empty($value["morning"])) ? "* Take in the Morning ".$value["morning"]." Food (".$value["morning_quantity"]." ".$value["product_type"].")" : ""); ?></span>
							<span style="display:block;"><?php echo ($value["afternoon"]=="Anytime") ? "* Take in the Afternoon (".$value["afternoon_quantity"]." ".$value["product_type"].")" : ((!empty($value["afternoon"])) ? "* Take in the Afternoon ".$value["afternoon"]." Food (".$value["afternoon_quantity"]." ".$value["product_type"].")" : ""); ?></span>
							<span style="display:block;"><?php echo ($value["evening"]=="Anytime") ? "* Take in the Evening (".$value["evening_quantity"]." ".$value["product_type"].")" : ((!empty($value["evening"])) ? "* Take in the Evening ".$value["evening"]." Food (".$value["evening_quantity"]." ".$value["product_type"].")" : ""); ?></span>
							<span style="display:block;"><?php echo ($value["dinner"]=="Anytime") ? "* Take at Night (".$value["dinner_quantity"]." ".$value["product_type"].")" : ((!empty($value["dinner"])) ? "* Take at Night ".$value["dinner"]." Food (".$value["dinner_quantity"]." ".$value["product_type"].")" : ""); ?></span>
						<?php } ?>
						
						<p class="medinote"><?php echo $value["notes"]; ?></p>
					</div>
				</div>
				
				
				<!---- DELETE POPUP  ------>
				<div id="deleteModal_<?php echo $value["dvID"]; ?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header text-center">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Delete confirm</h4> </div>
							<div class="modal-body">
								<div class="deletecontent text-center"> Are you sure want to delete this. </div>
							</div>
							<div class="modal-footer">
								<div class="centerAlign"> 
								<a href="javascript:void(0);" class="defaultBtn" data-dismiss="modal">Cancel</a> 
								<a href="javascript:void(0);" class="defaultBtn belu deletePrescription" id="<?php echo $value["dvID"]; ?>">Yes</a> </div>
							</div>
						</div>
					</div>
				</div>
				
				
				<?php } } } ?>
				
				<hr/>
				<!--<div class="totalsave clearfix">
					<div class="centerAlign"> <a href="javascript:void(0);" class="btn btn-blue">SAVE</a> </div>
				</div>-->
			</div>
		</div>
	</div>
	<?php } ?>
	
	<div class="mediciandetailWrap">
		<ul class="medician-main">
			<li class="medicianList">
				<div class="medicianTitle toggleHead"><span>Notes </span> </div>
				<input type="hidden" name="notesID" class="notesID">
				<div class="toggleContent">
					<div class="mediNotes-wrap">
						<div class="form-group">
							<textarea class="form-control notesData" placeholder="Add Notes"></textarea>
						</div>
						<div class="text-right clearfix">
							<div class="linedefaultbtn pull-right saveNotes"> <span class="">Save</span> </div> <!--<small class="pull-right printericon graysceale"> <b class="sprite printIcon"></b></small>--> </div>
					</div>
					<div class="searchBox calenderwith">
						<input type="text" id="notesCalender" placeholder="Search by Date">
						<button><b class="sprite clderIcon cld_icon clderIconClick notesCalender"></b></button>
					</div>
					<p class="noteadded noNotesDiv" style="display:<?php echo isset($doctorNotesData) && empty($doctorNotesData) ? "block" : "none"; ?>">No Notes Added</p>
					<div class="savedNotes">
						<?php
						if(isset($doctorNotesData) && !empty($doctorNotesData)) {
						foreach($doctorNotesData as $key => $value) {
						?>
						<div class="repeathistory notesDate" id="<?php echo $value["date"]; ?>">
							<div class="medicianSubTitle">
								<p class=" toggleSubHead"><?php echo $value["date"]; ?></p> <a class="mediedit editNotes" id="<?php echo $value["id"]; ?>">Edit</a> </div>
							<div class="toggleSubContent">
								<ul class="medicianSub-wrap notesborder">
									<li class="medicianSub-list">
										<p class="notes_<?php echo $value["id"]; ?>"><?php echo $value["notes"]; ?></p>
										<!--<small class="printericon"><b class="sprite printIcon"></b>Print</small>-->
									</li>
								</ul>
							</div>
						</div>
						<?php } } ?>
						<!--<div class="loadmore recoadload"><span>LOAD MORE</span></div>-->
					</div>
				</div>
			</li>
		</ul>
	</div>
</div>


<script type="text/javascript">

$(document).ready(function() {

var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;

$('body').on('click','.deletePrescription',function()
{
	var id = $(this).attr("id");
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"deleteprescription"]); ?>',  
		type: "POST",
		data: {'id' : id},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$("#prescriptionDiv_"+id).remove();
			$("#deleteModal_"+id).modal('toggle');
		}   
	});
	
});

$('body').on('click','.edit',function()
{
	var id = $(this).attr("id");
	var ppID = $(this).attr("data-id");
	
	$.ajax({
		url: '<?php echo $this->url->build(["controller"=>"Appointment", "action"=>"edit"]); ?>',  
		type: "POST",
		data: {'id' : id , 'ppID' : ppID},
		headers:
		{
			'X-CSRF-Token': csrfToken    
		},
		success: function(data)
		{
			$(".leftDiv").html(data);
			$(".singleselect").select2();
			$("#birthdateval").daterangepicker({
				autoUpdateInput: true,
				singleDatePicker: true,
				locale: {
					format: 'DD MMM YYYY'
				}
			});
			$("#previousCalender").daterangepicker({
				autoUpdateInput: true,
				singleDatePicker: true,
				locale: {
					format: 'DD MMM YYYY'
				}
			});
			$("#reportCalender").daterangepicker({
				autoUpdateInput: true,
				singleDatePicker: true,
				locale: {
					format: 'DD MMM YYYY'
				}
			});
			
			$('#product_name').selectize({
			valueField: 'id',
			labelField: 'name',
			searchField: ['name'],
			placeholder: 'Type and Select',
			options: [],
			  render: {
				option: function(item, escape)
				{
					return '<div>' + escape(item.name) + '</div>';
				}
			},
			load: function(query, callback)
			{
				if (!query.length) return callback();
				
				if($("input[name='product_search_by']:checked").val()==1) //FOR BRAND
				{
					var request = '<Request><List><Product><ByName>'+query+'</ByName></Product></List></Request>';
				}
				else //FOR MOLECULE
				{
					var request = '<Request><List><Molecule><ByName>'+query+'</ByName></Molecule></List>';
				}
				$.ajax({
					url: '<?php echo $this->Url->build(["controller"=>"Appointment", "action"=>"getCimsMedicines"]); ?>',
					type: 'POST',
					dataType: 'json',
					data: {'CIMS_Request' : request},
					headers:
					{
						'X-CSRF-Token': csrfToken    
					},
					error: function()
					{
						callback();
					},
					success: function(response)
					{
						//console.log(response);
						callback(response);
					}
				});
			}
		});

			
			/* $('#product_name').selectize(); */
		}   
	});
});

});

</script>
