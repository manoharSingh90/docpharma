<?php echo $this->Html->css(['pharmacy/after_pharmacy']); 
echo $this->Html->script(['pharmacy/dataTables.responsive.min.js']); ?>
<div class="main-wraper">
  <div class="container">
    <div class="row">
      <ul class="customHeadWrap">
        <li class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
          <div class="customHead"><b><i class="sprite customerIcon"></i></b> <span>CUSTOMERS</span> </div>
        </li>
        <li class="col-lg-3 col-md-6 col-sm-12 col-xs-12 pull-right"> <a href="<?php echo $this->url->build(["controller" => "customer","action" => "createCustomer"]); ?>" class="pull-right btn btn-secondary text-uppercase">CREATE NEW CUSTOMER</a></li>
        <li class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
          <div class="searchclient">
            <input type="text" placeholder="SEARCH Customer" id="search"/>
            <b><img src="<?php echo PATH.'img/pharmacy/icons-search.png'; ?>" /></b></div>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="customerlistWrap">
      <h3 class="customerlistHead">ALL CUSTOMERS</h3>
      <div class="customerlist-Sort"> <span>Sort By :</span><!-- <a href="javascript:void(0);" title="Alphabetical Order">Alphabetical Order</a>--><a href="javascript:void(0);" title="Newly Added" id="newelyadded">Newly Added </a></div>
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
		  <?php foreach($query as $queries){
		  $email=explode(',',$queries['email']); $phone=explode(',',$queries['phone']); $phone_code=explode(',',$queries['phone_code']); ?>
            <tr>
              <td><a href="javascript:void(0);" class="userName"><?php echo $queries['title'];?>&nbsp;<?php echo $queries['first_name'];?>&nbsp;<?php echo $queries['last_name'];?></a></td>
              <td><?php echo $queries['dob'];?></td>
              <td><?php echo $email[0];?></td>
              <td><?php echo $phone_code[0];?>&nbsp;<?php echo $phone[0];?></td>
              <td>
              <div class="usermoreOpction"> <a href="<?php echo $this->Url->build(["controller" => "customer","action" => "customerDetails",$queries['id']]); ?>">View Details</a><a href="#">Create Bill</a></div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="loadmore"><span>LOAD MORE</span></div>
    </div>
  </div>
</div>

<!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->
<script type="text/javascript">
		$(document).ready(function () {
			
			
			$('.menutoggle').click(function () {
				$(this).toggleClass('active');
				$('header').toggleClass('active');
			});
			
						
		//For search
		$('#search').keyup(function(){
		//alert("sdahjvdh");
		var g = $(this).val().toLowerCase();
		$('.userName').each(function(){
		var s = $(this).text().toLowerCase();
		//alert(s);
		if (s.indexOf(g)!=-1) {
		$(this).parent().parent().show();
		}
		else {
		$(this).parent().parent().hide();
		}		
		}); 
		});
		
		$('#newelyadded').click(function(){
		$.ajax({
			//type:'POST',
			url:'<?php echo $this->url->build(["controller" => "customer","action" => "newelyAdded"]); ?>',
			success:function(response){ 
			console.log(response);
			$("tbody").empty();
			$('tbody').append(response);
			}
		});
		return false;
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
		});
	</script>
</body>
</html>