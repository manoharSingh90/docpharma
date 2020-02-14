<header>
		<?php echo $this->element("left_panel"); ?>
</header>
<form method="post" id="upload" action="">
<div class="main-wraper">
<?php echo $this->Flash->render('flash', ['element' => 'success']); ?>
  <div class="container">
    <div class="row">
      <ul class="customHeadWrap">
        <li class="col-md-3 col-12">
          <div class="customHead"> <b><i class="sprite productIcon"></i></b> <span>Product Inventory</span> </div>
        </li>
        <li class="col-md-9 col-12 text-right">
          <div class="headLink"><a href="<?php echo $this->Url->build(["controller" =>"inventory","action" => "productManagement"]); ?>" class="btn btn-secondary text-uppercase">Products Mgmt.</a> 
		  <a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" => "createInventory"]); ?>" class="btn btn-secondary text-uppercase">Create Inventory</a><a href="<?php echo PATH.'sheet/inventory_sheet.xls'; ?>" target="_blank" class="btn btn-secondary text-uppercase">Download Format</a><a href="#" class="btn btn-secondary text-uppercase inputHit">Upload Sheet</a>
		  <input class="hidden inputBox uploadSheet" type="file" name="upload_sheet"/> 
		  <a href="<?php echo $this->Url->build(["controller" =>"Inventory","action"=>"printInventorySheet"]); ?>" class="btn btn-secondary text-uppercase" target="_blank">Print</a>
          
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="customerlistWrap withtabs">
      <div class="tabLinks">
        <ul>
          <li><a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" => "index"]); ?>" class="active">Products</a></li>
          <li><a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" => "orderForm"]); ?>">Order Forms</a></li>
        </ul>
      </div>
      <div class="customerlist-option">
        <div class="row">
          <div class="col-12 col-md-8">
           <!-- <ul>
			<li class="searchByAll"><a href="javascript:void(0);"><b>All:</b></a></li>
              <li class="searchByAlpha"><a href="javascript:void(0);">A</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">B</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">C</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">E</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">F</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">G</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">H</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">I</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">J</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">K</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">L</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">M</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">N</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">O</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">P</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">Q</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">R</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">S</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">T</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">U</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">V</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">W</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">X</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">Y</a></li>
				<li class="searchByAlpha"><a href="javascript:void(0);">Z</a></li>
            </ul>-->
          </div>
          <div class="col-12 col-md-4 text-right">
            <div class="searchBox">
              <input type="text" placeholder="Search Product/Manufacturer" id="srch"/>
              <button><i class="sprite searchIcon"></i></button>
            </div>
          </div>
        </div>
      </div>
      <div class="tablewrap">
        <table id="customerTable" style="width:100%">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Manufacturer</th>
              <th class="nosort">Batch No.</th>
              <th>Expiry Date</th>
              <th>No. Of Pack</th>
              <th>Total Quantity</th>
              <th>Per Pack Price</th>
              <th>Type</th>
              <th>Shelf Location</th>
              <th class="text-center nosort">Action</th>
            </tr>
          </thead>
          <tbody>
		  <?php $n=1;
			if(!empty($productData)){
		  foreach($productData as $queries){
			  $date=date_create($queries['expiry_date']);
              $dateFormat = date_format($date,"d M Y"); ?>
            <tr <?php if(strtotime($queries['expiry_date']) < (time()-(60*60*24))){ ?> class="alertRow" <?php } ?>>
              <td>
                <a class="userName"><?= ucfirst($queries['product_name']); ?></a>
              </td>
			 
              <td class="manuName_<?= $n;?>"><?= ucfirst($queries['manufacturer_name']); ?></td>
			  
              <td>
                <p class="textWidth"><?= $queries['batch_no']; ?></p>
              </td>
              <td>
			  <?php if(strtotime($queries['expiry_date']) < (time()-(60*60*24))){ ?>
			  <p class="textWidth" style="color:red;"><?php echo $dateFormat; ?> !</p><?php } else{ ?>
			  <p class="textWidth"><?= $dateFormat; ?></p><?php } ?>
              </td>
              <td> <?= $queries['no_of_pack']; ?> </td>
              <td> <?php if($queries['quantity']<=$queries['qty_alert']){?>
			  <i class="sprite cautionRedIcon"></i> <?php } ?> <?= $queries['quantity'];?> 
			  <?php if($queries['quantity']<=$queries['qty_alert']){ ?>
			  <a href="#" class="createCircle" data-toggle="modal" data-target="#selectProductModal<?= $queries['inventoryID']; ?>">+</a> <?php } ?></td>
              <td> <?= $queries['unit_price']; ?> </td>
              <td class="protype_<?= $n;?>"><?= $queries['dosages_type']; ?></td>
              <td><?= $queries['location']; ?></td>
			  
              <td class="text-center"><a href="<?= $this->url->build(["controller" => "inventory","action" => "createInventory",$queries['inventoryID']]); ?>" class="text-uppercase text-link">Edit</a></td>
            </tr>
			<?php $n++; } } ?>
          </tbody>
        </table>
      </div>
      <!--<div class="loadmore"><span>LOAD MORE</span></div>-->
    </div>
  </div>
</div>

<!-- Modal -->
<?php foreach($productData as $queries){ ?>
<div id="selectProductModal<?= $queries['inventoryID']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add to Order Form</h4>
        <small>Select an Order Form to add Product</small> </div>
      <div class="modal-body productBox">
        <ul class="productList">
		<?php foreach($orderForm as $order){ ?>
          <li class="orderClick" order-id="<?= $this->Url->build(["controller" =>"inventory","action" =>"createOrderForm",$order['slug']]); ?>" product-name="<?= $queries['product_name']; ?>"> 
		  <p> <?= ucfirst($order['order_name']); ?></p></li>   
        <?php } ?>		  
        </ul>	  
        <a href="<?= $this->Url->build(["controller"=>"inventory","action"=>"createOrderForm"]); ?>">+ 
		Create New Order Form</a></div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
        <a href="" class="btn btn-primary text-uppercase appendOrder">Add</a> </div>
    </div>
  </div>
</div>
<?php } ?>
</form>
<script>
$('li.orderClick').click(function () {	
	var order_id = $(this).attr("order-id");
	var product_name = $(this).attr("product-name");
	//alert(product_name);
	var qwe = $('.appendOrder').attr("href", order_id);
	
});


$('.textWrap').click(function (e) {
	//$(this).class('active');
	var value = $(this).text();
	var abc = $(this).attr("data-id");
	//alert(abc);
	$.ajax({
	type:'get',	
	url:'<?php echo $this->Url->build(["controller" =>"inventory","action" => "manuname"]); ?>',
	data:{value:value},
	success:function(response){	
		console.log(response);
		//alert(response);
		var obj = jQuery.parseJSON(response);		
		$('.manuName_'+abc).text(obj.manu);
		$('.protype_'+abc).text(obj.type);
		}		
	});
});

  $("#srch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

$('.searchByAlpha').click(function (e) {
	//$(this).class('active');
	var value = $(this).text();
	//alert(value);
	$.ajax({
	type:'get',	
	url:'<?php echo $this->Url->build(["controller" =>"inventory","action" => "alphabets2"]); ?>',
	data:{value:value},
	success:function(response){	
		console.log(response);
		$('tbody').empty();
		$('tbody').append(response);
		}
		
	});
}); 

$('.searchByAll').click(function (e) {
	//$(this).class('active');
	var value = $(this).text();
	//alert(value);
	$.ajax({
	type:'get',	
	url:'<?php echo $this->Url->build(["controller" =>"inventory","action" => "allbet"]); ?>',
	data:{value:value},
	success:function(response){	
		console.log(response);
		$('tbody').empty();
		$('tbody').append(response);
		}
		
	});
});


$(".uploadSheet").change(function()
	{    
		
		var curr=$(this);
		var ext = curr.val().split('.').pop().toLowerCase();
		
		if($.inArray(ext, ['xls','xlsx','xlsb']) == -1) {
			alert('invalid file!');
		}
		else
		{
			//overlayShow();
		var selectedMonth = $('.ui-datepicker-month :selected').val();
		var selectedYear = $('.ui-datepicker-year :selected').val();
		var  csrf = '<?php echo $this->request->getParam('_csrfToken'); ?>';
		var frm=$("form#upload")[0];
        var formData = new FormData(frm);
        $.ajax({
            url : '<?php echo $this->Url->build(["controller"=>"inventory","action"=>"sheetUpload"]); ?>',
            type :'POST',
			headers : {'X-CSRF-Token':csrf},
            dataType :'json',
            processData: false,
            contentType: false,
            data : formData,
             success: function(response) {
				console.log(response);	
				alert(response.msg);
				}
			
			/* var xhr = new XMLHttpRequest();
			{ 
				if (xhr.status == 200)
				{  
				var detls=$.parseJSON(xhr.response);
			
					if(detls.msg=='error')
					{
						
						$('.total_rows').text(detls.totalrows);
						$('.total_succs').text(detls.tsuccess);
						$('.total_failed').text(detls.terror);
						$('#error_model').modal('show');
					}
					
					else if(detls.msg=='invalid')
					{
						//overlayHide()
						alert('Please correct your excel sheet.');
					}
					if(detls.msg=='success')
					{
						alert('Data Uploaded Successfully.');
						location.reload(); 
					}
				}
				else
				{
					//overlayHide()
					alert('Please correct your excel sheet.');
				}     
			}
			  xhr.send(fd);  */
			});
		} 
	});

</script>

<script type="text/javascript">
	$(document).ready(function () {

		$(document).on("click", ".menutoggle", function (e) {
			e.preventDefault();
			$(this).toggleClass('active');
			$('header').toggleClass('active');
		});
		
		// SELECT PRODUCT LIST
		$(document).on("click", ".productList li", function (e) {
			e.preventDefault();
			$(this).toggleClass('active');
			$(this).siblings().removeClass('active');
		});
		
		// SELECT SHEET
		$(document).on("click", ".inputHit", function (e) {
			e.preventDefault();
			$('.inputBox').trigger('click');
		});	
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
	});
</script>

    <!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->