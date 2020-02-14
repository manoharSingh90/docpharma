  

	<header>
		<?php echo $this->element("left_panel"); ?>
	</header>

<div class="main-wraper">
  <div class="container">
    <div class="row">
      <ul class="customHeadWrap">
        <li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="customHead"> <b><i class="sprite customerIcon"></i></b> <span>ALL Patients</span> </div>
        </li> 
		  <li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
           <div class="d-inline-block">
						<div class="custom-radio d-inline-block">
							<input type="radio" class="custom-control-input patientDob" id="radio_dob" name="userDetails"> <b></b>
							<label class="custom-label" for="radio_dob">DOB</label>
						</div>
						<div class="custom-radio d-inline-block">
							<input type="radio" checked class="custom-control-input patientName" id="radio_name" name="userDetails"> <b></b>
							<label class="custom-label" for="radio_name">Name</label>
						</div>
					</div>
					
				<div class="searchWrap onlysearch">		
				<div class="searchclient searchPatient">
                   <input type="text" placeholder="Search Patients" id="search1">
                    <b><img src="<?= PATH.'img/doctor/icons-search.png'; ?>"></b>
				</div>
			
                 <div class="searchclient searchDob" style="display:none;">
                    <input type="text" id="search2" placeholder="DD/MM/YYYY">
                    <b><img src="<?= PATH.'img/doctor/icons-search.png'; ?>"></b>
				</div>			
				</div>	
        </li>
        <li class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pull-right patientTspace">
		<a href="" class="pull-right btn btn-secondary text-uppercase" data-toggle="modal" data-target="#createpatient-Modal">Create New Patient</a></li>
         
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="customerlistWrap">   
     <div class="customerlist-Sort"> <span>Sort By :</span><!-- <a href="javascript:void(0);" title="Alphabetical Order" id="alphabetical">Alphabetical Order</a> --><a href="javascript:void(0);" title="Newly Added" id="new">Newly Added </a> </div>
      <div class="tablewrap">
	  
        <table id="customerTable" style="width:100%">
          <thead>
            <tr>
              <th>Name</th>
              <th>Date Of Birth</th>
              <th>Email</th>
              <th>Phone</th>
              <th class="actionWrap nosort">Action</th>
            </tr>
          </thead>
		  
          <tbody>
		   <?php  foreach($query as $queries){ 
		   $m_number = explode(',',$queries['m_number']); 
		   $email = explode(',',$queries['email']); 
		   $country_code = explode(',',$queries['country_code']); 
		   $dob = date_create($queries['dob']); ?>
            <tr>
              <td><a href="javascript:void(0);" class="userName"><?= $queries['fname'].' '.$queries['lname'] ?></a></td>
              <td class="userDOB"><?= date_format($dob,'d M Y'); ?></td>
              <td><?= $email[0] ?></td>
              <td><?= $country_code[0]; ?> <?= $m_number[0]; ?></td>
              <td>
              <div class="usermoreOpction"><a href="<?php echo $this->Url->build(["controller" => "Patient","action" => "patients_details",$queries->id]); ?>">View Details</a> 
				</div>
              </td>
            </tr>
			 <?php } ?>
			  
          </tbody>
		</table>
      </div>
	  <!--<div class="loadmore"><a href="" title="Load More" id="load_more"><span>LOAD MORE</span></a></div>-->
    </div>
  </div>
</div>

	<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->

<!-- Modal -->
<div id="createpatient-Modal" class="modal fade" role="dialog">
	<?php echo $this->element("Patient/create_patient"); ?>
</div>
	
	<div id="viewdetails-Modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View Patient Details</h4>
      </div>
      <div class="modal-body">
				<div class="viewmodalOrder">
					<div class="row">
						<div class="col-lg-12">
							<ul>
							<li>
								<div class="customformwrap">
							<label class="customLabel">PHONE NUMBER</label>
							<p>Bhavya Sharma</p>
							</div>
								</li>
								<li>
								<div class="customformwrap">
							<label class="customLabel">Phone Number</label>
							<p>+91 9685XXXX52, +91 7625XXX781</p>
							</div>
								</li>
								<li>
								<div class="customformwrap">
							<label class="customLabel">AGE (DATE OF BIRTH)</label>
							<p>21 (03 Apr 1995)</p>
							</div>
								</li>
								<li>
								<div class="customformwrap">
							<label class="customLabel">Email</label>
							<p>bhavyasinghsharma@gmail.com</p>
							</div>
								</li>
								<li>
								<div class="customformwrap">
							<label class="customLabel">Address</label>
							<p> #03 - Ground Floor A-42/6, Pinnacle Tower, Sector 62, Noida, Uttar Pradesh 201301</p>
							</div>
								</li>
								 
							</ul>
						
							</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="centerAlign">
				 
					 <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Done</button>
        <button type="button" class="btn btn-primary text-uppercase"  data-toggle="modal" data-target="#createpatient-Modal">Edit</button>
				
				</div>
			</div>
		</div>
	</div>
	</div>
<?= $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js','pharmacy/jquery.formatter.min.js']); ?>

	<script type="text/javascript">
		$(document).ready(function () {
			$(".singleselect").select2();				
				 
			$("#allergyData").select2({
				dropdownCssClass: "allergyData"
			});
			
			$('.menutoggle').click(function () {
				$(this).toggleClass('active');
				$('header').toggleClass('active');
			});
			
			$(document).on('show.bs.modal', '.modal', function (event) {
				var zIndex = 1040 + (10 * $('.modal:visible').length);
				$(this).css('z-index', zIndex);
				setTimeout(function () {
					$('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
				}, 0);
			});
			
			$('.patinumclick').click(function () {
				$('.patiothernumber').addClass('active');
					});
			$('.patiemailclick').click(function () {
				$('.patiotheremail').addClass('active');
					});
					
	$(".patientDob").on("click", function() {
    $(".searchPatient").hide();
    $(".searchDob").show();			
	});	
		
	$(".patientName").on("click", function() {
	$(".searchDob").hide();
	$(".searchPatient").show();	
	}); 
		
	$('#search1').keyup(function(){
		
		var g = $(this).val().toLowerCase();
		$('.userName').each(function(){
		var s = $(this).text().toLowerCase();
	
		if (s.indexOf(g)!=-1) {
		$(this).parent().parent().show();
		}
		else {
		$(this).parent().parent().hide();
		}		
		}); 
		});
		
    $(document).on("blur","#search2",function(){		
		var dob = $(this).val();
		//alert(dob);
		$.ajax({
			url:'<?= $this->Url->build(["controller" =>"Patient","action" =>"searchDOB"]); ?>',
			data: {dob:dob},
			success:function(response){ 
			console.log(response);
			$("tbody").empty();
			$('tbody').append(response);
			}
		});
	});					
		
	  $('#alphabetical').click(function(){
		$.ajax({
			url:'<?php echo $this->Url->build(["controller" => "Patient","action" => "alpha"]); ?>',
			success:function(response){ 
			console.log(response);
			$("tbody").empty();
			$('tbody').append(response);
			}
		});
		return false;
		});
		
       $('#new').click(function(){
		$.ajax({
			url:'<?php echo $this->Url->build(["controller" => "Patient","action" => "newelyAdded"]); ?>',
			success:function(response){ 
			console.log(response);
			$("tbody").empty();
			$('tbody').append(response);
			}
		});
		return false;
		});	
		
      $('#load_more').click(function(){
		$.ajax({
			//type:'POST',
			url:'<?php echo $this->Url->build(["controller" => "patient","action" => "loadMore",$queries->id]); ?>',
			success:function(response){ 
			console.log(response);
			//$("tbody").empty();
			$('tbody').append(response);
			}
		});
		return false;
		});			

           $('#search2').formatter({
                 'pattern': '{{99}}/{{99}}/{{9999}}'
                 });
				 
			$('#search2').datetimepicker({
		           useCurrent: false,
                   format: 'DD/MM/YYYY',
		 			//minDate: moment(),
					maxDate: moment(),
		 			useStrict:true,
		 			locale:  moment.locale('en', {
			week: { dow: 1 }
         })
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
			
			
			/*$('#customerTable').DataTable({
			info: false,
				bFilter : false,               
				bLengthChange: false
				, searching: false
				, ordering: true,
				responsive: true
				});  */
				

});
		
		
	</script>
