<header>
		<?php echo $this->element("left_panel"); ?>
</header>

<div class="main-wraper">
<?php echo $this->Flash->render('flash', ['element' => 'success']); ?>
  <div class="container">
    <div class="row">
      <ul class="customHeadWrap">
        <li class="col-md-6 col-12"><a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" =>"OrderForm"]); ?>" class="text-uppercase backLink"><i class="sprite backIcon"></i> Back</a>
          <div class="customHead"> <b><i class="sprite orderIcon"></i></b> <span>Order Form Details</span> </div>
        </li>
        <li class="col-md-6 col-12 text-right">
          <div class="headLink"><a href="#" class="btn btn-secondary text-uppercase" data-toggle="modal" data-target="#sendemailModal">Email</a> <a href="<?= $this->Url->build(["controller" =>"Inventory","action" =>"printSheet",$data['slug']]); ?>" class="btn btn-secondary text-uppercase" target="_blank">Print</a> <a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" =>"createOrderForm",$data['slug']]); ?>" class="btn btn-secondary text-uppercase">Edit</a></div>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="customerlistWrap">
      <div class="customerlist-option">
        <div class="row">
          <div class="col-12 col-md-8">
            <p class="updatedText"><?= $data['order_name'];?></p>
            <small class="updatedDate">Last Updated: <?php $lst_date = date_create($data['modified_dttm']); echo $lst_updt = date_format($lst_date,"d F Y"); ?></small></div>
          <div class="col-12 col-md-4 text-right">
            <div class="searchBox">
              <input type="text" placeholder="Search Product" id="srch"/>
              <button><i class="sprite searchIcon"></i></button>
            </div>
          </div>
        </div>
      </div>
      <div class="tablewrap">
        <table id="customerTable" style="width:100%">
          <thead>
            <tr>
              <th>Serial No.</th>
              <th>Product Name</th>
              <th>Manufacturer</th>
              <th>No. Of Pack</th>
              <th>Total Quantity</th>
              <th>Type</th>
              <th class="text-center nosort">Action</th>
            </tr>
          </thead>
          <tbody>
		  <?php if(!empty($productData)) { foreach($productData as $key=>$value){ ?>
            <tr>
              <td><?php echo $key+1; ?></td>
              <td><a class="prod"><?= ucfirst($value["product_name"]); ?></a></td>
              <td><?= ucfirst($value["manufacturer_name"]); ?></td>
              <td><?= $value['num_of_pack']; ?></td>
              <td><?= $value['quantity_ordered']; ?></td>
              <td><?= $value["dosages_type"]; ?></td>            
			  			  
              <td class="text-center"> <a href="" class="text-uppercase actionLink text-link" data-toggle="modal" data-target="#updateProductModal<?= $value["id"]; ?>">Edit</a> | <a href="#" class="text-uppercase actionLink"  data-toggle="modal" data-target="#confirmationModal<?= $value["id"]; ?>"><i class="sprite deleteIcon"></i></a> </td>
            </tr>
		  <?php } } ?>
          </tbody>
        </table>
      </div>
     <!-- <div class="loadmore"><span>LOAD MORE</span></div>-->
    </div>
  </div>
</div>


<form method="post" action="<?php echo $this->Url->build(["controller" => "inventory","action" =>"sendMail"]); ?>" class="create-patient-form clearfix">
<input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
<div id="sendemailModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body">
        <p class="text-center">Are you want to Send Mail?</p>
		<div class="orderTitle">
        <label>Enter your email id</label>
        <input type="email" class="form-control mandatory" name="send_mail" value="" id="mail">
		<p class="msg1 errorClass1"></p>
        <input type="hidden" class="form-control" name="orderForm" value="2">
        <input type="hidden" class="form-control" name="id" value="<?= $data['id'];?>">
        <input type="hidden" class="form-control" name="product_id" value="<?= $data['product_id'];?>">
		<input type="hidden" class="form-control" name="quantity_ordered" value="<?= $data['quantity_ordered'];?>" >
		<?php foreach($productData as $key=>$value){ ?>
        <input type="hidden" class="form-control" name="product_name[]" value="<?= $value['product_name'];?>" >
		<input type="hidden" class="form-control" name="manufacturer_name[]" value="<?=  $value["manufacturer_name"]; ?>" >
		<input type="hidden" class="form-control" name="dosages_type[]" value="<?= $value["dosages_type"]; ?>" >
		<?php } ?>
        <input type="hidden" class="form-control" name="order_name" value="<?= $data['order_name'];?>" >       
        <input type="hidden" class="form-control" name="order_date" value="<?= $data['order_date'];?>" >
         </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
        <button type="submit" id="submit" class="btn btn-primary text-uppercase">Send</button>
      </div>
    </div>
  </div>
</div>
</form>


<!-- DeleteModal -->
 <?php foreach($productData as $key=>$value){ ?>
 <form method="post" action="<?php echo $this->url->build(["controller" =>"inventory","action"=>"deleteOrder"]); ?>" class="create-patient-form clearfix">
 <input type="hidden" name="_csrfToken" value="<?= $this->request->getParam('_csrfToken'); ?>" >
<div id="confirmationModal<?= $value["id"]; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
	  <input type="hidden" name="id" value="<?= $value['id']?$value['id']:''; ?>">
      <div class="modal-body text-center">
        <p>Are you sure you want to delete this order?</p>
      </div>
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
<?php foreach($productData as $key=>$value){ ?>
<form method="post" action="<?= $this->url->build(["controller" =>"inventory","action"=>"editOrderForm"]); ?>" class="create-patient-form clearfix">
<input type="hidden" name="_csrfToken" value="<?= $this->request->getParam('_csrfToken'); ?>" >
<div id="updateProductModal<?= $value["id"]; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Order </h4>
      </div>
      <div class="modal-body">
        <ul class="row">
          <li class="col-sm-12">
            <label class="form-label">Product Name</label>
			<input type="hidden" name="id" value="<?= isset($value['id'])?$value['id']:''; ?>">
			
            <input type="text" class="form-control" value="<?= ucfirst($value["product_name"]); ?>"  readonly />
			
          </li>
          <li class="col-sm-12 col-md-6">
            <label class="form-label">Manufacturer</label>
            <input type="text" class="form-control manufacturer" manu-id="<?= $value["productID"]; ?>" value="<?= ucfirst($value["manufacturer_name"]); ?>" readonly />

          </li>
          <li class="col-sm-12 col-md-6">
            <label class="form-label">Type</label>
             <input type="text" class="form-control" value="<?= ucfirst($value["dosages_type"]); ?>" readonly />
          </li>
		  
          <li class="col-sm-12 col-md-6">
            <label class="form-label">No. Of Pack</label>
            <input type="text" class="form-control quant1 numPack" value="<?= isset($value['num_of_pack'])?
			$value['num_of_pack']:''; ?>" name="num_of_pack" data-id="1" autocomplete="off" />						
          </li>
		  
          <li class="col-sm-12 col-md-6">
            <label class="form-label">Total Quantity</label>
            <input type="text" class="form-control quant1 read" value="<?= isset($value['quantity_ordered'])?
			$value['quantity_ordered']:''; ?>" name="quantity_ordered" id="quant" autocomplete="off"/>						
          </li>
        </ul>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary text-uppercase">Save</button>
      </div>
    </div>
  </div>
</div>
</form>
 <?php } ?>
 
<script>
 
 $("#srch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
 
$("body").on("keyup",".numPack",function(){
	 
	//var abc = $(this).attr("data-id");
	var product_id = $('.manufacturer').attr("manu-id");
	var value = $(this).val();
	//alert(product_id+' '+abc);
	//alert(product_id);
	 $.ajax({
	type:'get',	
	url:'<?= $this->Url->build(["controller"=>"inventory","action"=>"findManufac"]); ?>',
	data:{value:product_id},
	success:function(response){
		console.log(response);
		//alert(response);
		var obj = jQuery.parseJSON(response);
		//alert(obj.qty_in_pack);
		var mult = value*(obj.qty_in_pack);		
		//$('#emTD'+abc).empty();
		$('.read').val(mult);		
		}		
	 }); 
}); 
 
 $('.quant1').keypress(function (event){
	var keycode = event.which;
	if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57)))) {
		event.preventDefault();
	//$('.msg2').text('Digits Only!!').fadeIn('slow').delay(2500).fadeOut();
	}
	});
	
	  function update(product_id,product,quant){	  
      $('#quant').val(quant);
      $('#prod_id').val(product_id);
      $('#product_name').val(product);
		
       }
	   
		/* $('#srch').keyup(function(){
		//alert("sdahjvdh");
		var g = $(this).val().toUpperCase();
		$('tr td .prod').each(function(){
		var s = $(this).text().toUpperCase();
		//alert(s);
		if (s.indexOf(g)!=-1) {
		$(this).parent().parent().show();
		}
		else {
		$(this).parent().parent().hide();
		}		
		}); 
		});  */


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