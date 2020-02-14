<header>
		<?php echo $this->element("left_panel"); ?>
</header>

<div class="main-wraper">
<?php echo $this->Flash->render('flash', ['element' => 'success']); ?>
  <div class="container">
    <div class="row">
      <ul class="customHeadWrap">
        <li class="col-md-6 col-12">
          <div class="customHead"> <b><i class="sprite productIcon"></i></b> <span>Product Inventory</span> </div>
        </li>
        <li class="col-md-6 col-12 text-right">
			<div class="headLink">
         <a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" =>"createOrderForm"]); ?>" class="btn btn-secondary text-uppercase">Create Order Form</a>
				</div>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="customerlistWrap withtabs">
      <div class="tabLinks">
        <ul>
         <li><a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" => "index"]); ?>">Products</a></li>
          <li><a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" => "orderForm"]); ?>" class="active">Order Forms</a></li>
        </ul>
      </div>
      <div class="customerlist-option">
        <div class="row">
          <div class="col-12 col-md-8"> </div>
          <div class="col-12 col-md-4 text-right">
            <div class="searchBox">
              <input type="text" placeholder="Search order form name" id="search"/>
              <button><i class="sprite searchIcon"></i></button>
            </div>
          </div>
        </div>
      </div>
    <div class="mailMessage"></div>
      <div class="tablewrap">
        <table id="customerTable" style="width:100%">
          <thead>
            <tr>
              <th>Order Form Name</th>
              <th>No. of Products</th>
              <th>Last Updated</th>
              <th class="nosort text-center">Action</th>
            </tr>
          </thead>
          <tbody>
		  <?php foreach($orderForm as $orderFrm){ 
		  $lst_date = date_create($orderFrm['modified_dttm']);
		  $lst_updt = date_format($lst_date,"d M Y"); ?>
            <tr>
              <td><a href="#" class="userName"><?= ucfirst($orderFrm['order_name']); ?></a> </td>
              <td><?php $n=0;  foreach($productData as $key=>$quant){ if($orderFrm['id']==$quant['orderFormID']) { 
			    $n++; }  } echo $n; ?> </td>
              <td>
                <p class="textWidth"><?= $lst_updt; ?></p>
              </td>
              <td class="text-center">
                <div class="orderLinks"><a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" =>"viewOrderForm",$orderFrm['slug']]); ?>" class="text-uppercase text-link">View</a>
				| <a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" =>"printSheet",$orderFrm['slug']]); ?>" class="text-uppercase text-dark" target="_blank"><i class="sprite printIcon"></i></a>
				| <a href="#" class="text-uppercase text-dark" data-toggle="modal" data-target="#sendemailModal<?= $orderFrm['id']; ?>"><i class="sprite emailIcon"></i></a>
				|<a class="text-uppercase" data-toggle="modal" data-target="#confirmationModal<?= $orderFrm['id']; ?>"><i class="sprite deleteIcon"></i></a> </div>
              </td>
            </tr>
			<?php } ?>
            
          </tbody>
        </table>
      </div>
     <!-- <div class="loadmore"><span>LOAD MORE</span></div>-->
    </div>
  </div>
</div>

<!-- Modal -->
<?php foreach($orderForm as $orderFrm){ ?>
<form method="post" action="<?php echo $this->url->build(["controller" => "inventory","action" =>"deleteOrderForm"]); ?>" class="create-patient-form clearfix">
<input type="hidden" name="_csrfToken" value="<?= $this->request->getParam('_csrfToken'); ?>" >
<div id="confirmationModal<?= $orderFrm['id']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body text-center">
        <p>Are you sure you want to delete this Order Form?</p>
      </div>
	  <input type="hidden" name="id" value="<?= $orderFrm['id']?$orderFrm['id']:''; ?>">
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary text-uppercase">Delete</button>
      </div>
    </div>
  </div>
</div>
</form>
<?php } ?>
<!-- Modal -->
<?php foreach($orderForm as $orderFrm){ ?>
 <form method="post" action="<?php echo $this->url->build(["controller" => "inventory","action" =>"sendMail"]); ?>" class="create-patient-form clearfix">
 <input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
 <div id="sendemailModal<?= $orderFrm['id']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body ">
        <p class="text-center">Are you want to Send Mail?</p>
		<div class="orderTitle">
        <label>Enter your email id</label>
        <input type="email" class="form-control mandatory" name="send_mail" value="" id="mail">
		<p class="msg1 errorClass1"></p>
        <input type="hidden" class="form-control" name="orderForm" value="1">
        <input type="hidden" class="form-control" name="id" value="<?= $orderFrm['id']?>">
        <input type="hidden" class="form-control" name="product_id" value="<?= $orderFrm['product_id']?>">
        <input type="hidden" class="form-control" name="order_name" value="<?= $orderFrm['order_name']?>">
        <input type="hidden" class="form-control" name="quantity_ordered" value="<?= $orderFrm['quantity_ordered']?>">
        <input type="hidden" class="form-control" name="order_date" value="<?= $orderFrm['order_date']?>">
         </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
        <button type="submit" id="submitMail" class="btn btn-primary text-uppercase">Send</button>
      </div>
    </div>
  </div>
</div>
</form>
<?php } ?>

<script>

$('#submitMail').click(function () {
	//alert();
	$('.mailMessage').text('The Mail Has Been Send.').show();
}); 

$('#search').keyup(function (e) {
	
	var value = $(this).val().toLowerCase();
	//alert(value);
	$.ajax({
	type:'get',	
	url:'<?= $this->Url->build(["controller" => "inventory","action" =>"searchData3"]); ?>',
	data:{value:value},
	success:function(response){	
		console.log(response);
		//alert(response);
		$('tbody').empty();
		$('tbody').append(response);
		}
		
	});
});

$('#submit').click(function (e) {
	$(".mandatory").each(function()
	{
		if($(this).val()=="")
		{
			$(this).next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
			$(this).next().next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
		}
	});
	
	if($('#mail').val()=="" )
	{
		return false;
	}
    
});

</script>

<script type="text/javascript">
	$(document).ready(function () {

		$('#customerTable').DataTable({
			responsive: true,
			info: false,
			paging: false,
			searching: false,
			aoColumnDefs: [{
					'bSortable': false,
					'aTargets': ['nosort']
			}]
		});

		$('.menutoggle').click(function () {
			$(this).toggleClass('active');
			$('header').toggleClass('active');
		});

		
	});
</script>

   <!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->