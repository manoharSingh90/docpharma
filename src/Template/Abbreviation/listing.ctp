  
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
					<span>Abbreviation</span>
				</div>
				</li> 
				<li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="searchclient">
					<input type="text" class="searchAbbreviation" placeholder="Search Abbreviation" id="srch">
					<b><img src="<?php echo PATH.'img/doctor/icons-search.png'; ?>"></b>
				</div>
				</li>
				<li class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pull-right patientTspace">
					<a href="<?php echo $this->Url->build(["controller"=>"Abbreviation","action"=>"index"]); ?>" class="pull-right btn btn-secondary text-uppercase">Create Abbreviation</a>
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
							<th>Abbreviation</th>
							<th>Meaning</th>
							<th class="actionWrap nosort">Action</th>
						</tr>
					</thead>
			  
					<tbody>
					<?php
					if(isset($abbreviationData) && !empty($abbreviationData)) {
					foreach($abbreviationData as $key => $value) { ?>
						<tr class="tr">
							<td class="abbreviation"><?php echo $value["abbreviation"]; ?></td>
							<td><?php echo $value["meaning"]; ?></td>
							<td>
								<a href="<?php echo $this->url->build(["controller"=>"Abbreviation","action"=>"index",base64_encode($value["id"])]); ?>" class="text-uppercase actionLink text-link">Edit</a> /
								<a href="javascript:void(0);" class="text-uppercase actionLink text-link delete" id="<?php echo $value["id"]; ?>">Delete</a></td>
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
	var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
	
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
	
	$("body").on("keyup",".searchAbbreviation",function()
	{
		var search = $(this).val().toLowerCase();
		
		$('.abbreviation').each(function()
		{
			var abbreviation = $(this).text().toLowerCase();
			if (abbreviation.indexOf(search)!=-1)
			{
				$(this).parent().show();
			}
			else
			{
				$(this).parent().hide();
			}		
		});
	});
	
	$("body").on("click",".delete",function()
	{
		$.ajax({
			url: '<?php echo $this->Url->build(["controller"=>"Abbreviation","action"=>"deleteAbbreviation"]); ?>',
			type: 'post',
			headers:
			{
				'X-CSRF-Token': csrfToken    
			},
			data: {'id':$(this).attr("id")},
			success: function(data)
			{
				location.reload();
			}
		});
	});
});
		
</script>
