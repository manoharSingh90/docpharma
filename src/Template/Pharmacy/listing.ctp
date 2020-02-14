  
<header>
	<?php echo $this->element("left_panel"); ?>
</header>

<div class="main-wraper">
	<div class="container">
		<div class="row">
			<ul class="customHeadWrap">
				<li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="customHead">
					<b><i class="sprite customerIcon"></i></b>
					<span>Billing</span>
				</div>
				</li> 
				<li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="searchclient">
					<input type="text" class="searchPatient" placeholder="Search Patients" id="srch">
					<b><img src="<?php echo PATH.'img/doctor/icons-search.png'; ?>"></b>
				</div>
				</li>
				<li class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pull-right patientTspace">
					<a href="<?php echo $this->Url->build(["controller"=>"Pharmacy","action"=>"billing"]); ?>" class="pull-right btn btn-secondary text-uppercase">Create Billing</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="customerlistWrap">
			<div class="tablewrap">
				<table id="customerTable" style="width:100%">
					<thead>
						<tr>
							<th>Patient Name</th>
							<th>Patient Contact</th>
							<th>Prescribing Doctor</th>
							<th class="actionWrap nosort">Action</th>
						</tr>
					</thead>
			  
					<tbody>
					<?php
					if(isset($savedPrescription) && !empty($savedPrescription)) {
					foreach($savedPrescription as $key => $value) { ?>
						<tr>
							<td class="patientName"><?php echo $value["patient_name"]; ?></td>
							<td><?php echo $value["patient_phone"]; ?></td>
							<td><?php echo $value["doctor_name"]; ?></td>
							<td><a href="<?php echo $this->url->build(["controller"=>"Pharmacy","action"=>"billingdetails",base64_encode($value["prescription_id"])]); ?>" class="text-uppercase actionLink text-link">View</a></td>
						</tr>
					<?php } } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- FOOTER -->
<?php echo $this->element("footer"); ?>
<!-- FOOTER -->

<?php echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']); ?>
<script type="text/javascript">
$(document).ready(function()
{
	$(".singleselect").select2();
	$('.menutoggle').click(function () {
		$(this).toggleClass('active');
		$('header').toggleClass('active');
	});
				
   $('#customerTable').DataTable({
		responsive: true
		, info: false
		, paging: false
		, searching: false
		, ordering: true,
		aoColumnDefs: [{
			'bSortable': false,
			'aTargets': ['nosort']
		}]
	});
	
	$("body").on("keyup",".searchPatient",function()
	{
		var search = $(this).val().toLowerCase();
		
		$('.patientName').each(function()
		{
			var patientName = $(this).text().toLowerCase();
			if (patientName.indexOf(search)!=-1)
			{
				$(this).parent().show();
			}
			else
			{
				$(this).parent().hide();
			}		
		});
	});
});
		
</script>
