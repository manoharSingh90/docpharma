<header>
		<?php echo $this->element("left_panel"); ?>
</header>

<form method="post" id="upload" action="<?php echo $this->Url->build(["controller" =>"inventory","action" => "addProduct"]); ?>" onsubmit="return validateForm()">
	
<input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
	
	<div class="main-wraper">
	<?php echo $this->Flash->render('flash', ['element' => 'success']); ?>
		<div class="container">
			<div class="row">
				<ul class="customHeadWrap">
					<li class="col-md-5 col-12"> <a href="<?= $this->Url->build(["controller" =>"inventory","action" => "index"]); ?>" class="text-uppercase backLink"><i class="sprite backIcon"></i> Back</a>
						<div class="customHead"> <b><i class="sprite productIcon"></i></b> <span>Product Management</span> </div>
					</li>
					<li class="col-md-7 col-12 text-right">
					<div class="headLink"><a href="" class="btn btn-secondary text-uppercase" data-toggle="modal" data-target="#ProductModal">Add Product</a><a href="<?php echo PATH.'sheet/product_sheet.xls'; ?>" target="_blank" class="btn btn-secondary text-uppercase">Download Format</a>
					<a href="#" class="btn btn-secondary text-uppercase inputHit">Upload Sheet</a>
					<input class="hidden inputBox uploadSheet" type="file" name="upload_sheet"/> </div>
					</li>
				</ul>
			</div>
		</div>
<div class="container">
	<div class="customerlistWrap">
		<div class="customerlist-option">
			<div class="row">
				<div class="col-12 col-md-8">
					<ul>
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
					</ul>
				</div>
				<div class="col-12 col-md-4 text-right">
					<div class="searchBox">
						<input type="text" placeholder="Search Product/Manufacturer" id="search"/>
						<button><i class="sprite searchIcon"></i></button>
					</div>
					<?php echo $this->Flash->render('flash', ['element' => 'success']); ?>
				</div>
			</div>
		</div>
		<div class="tablewrap">
			<table id="customerTable" style="width:100%">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Manufacturer</th>
						<th>Product Type</th>
						<th>Quantity In Pack</th>
						<th>Dosages</th>
						<th>Quantity Alert</th>
						
						<th class="actionWrap text-center">Action</th>
					</tr>
				</thead>
				<tbody>
				 <?php if(!empty($productTable)) { foreach($productTable as $product){  ?>
					<?php if($product['is_active']==1){ ?><tr>
						<td><?= ucfirst($product['product_name']); ?></td>
						
						<td><?= ucfirst($product['manufacturer_name']); ?></td>
						
						<td><?= $product['product_type_name']; ?></td>
						
						<td><?= $product['qty_in_pack']; ?></td>
						
						<td><?= $product['dosages_type']; ?></td>
						
						<td><?= $product['qty_alert']; ?></td>
						<td class="text-center actionLinks"><a href="" class="text-uppercase" data-toggle="modal" data-target="#newProductModal<?= isset($product['id'])?$product['id']:''; ?>" >Edit</a> | <!--<a href="#" class="text-uppercase" data-toggle="modal" data-target="#confirmationModal<?= isset($product['id'])?$product['id']:''; ?>">Enable</a>--><a href="#" class="text-uppercase" data-toggle="modal" data-target="#disableProductModal<?= isset($product['id'])?$product['id']:''; ?>">Disable</a></td>
				 </tr><?php } } } ?>
				 
				</tbody>
			</table>
		</div>
		<!--<div class="loadmore" id="<?= $proID; ?>"><span >.</span></div>-->
	</div>
</div>
</div>

<!-- newModal -->
	<div id="ProductModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Product</h4> </div>
			<div class="modal-body">
				<ul class="row">
					<li class="col-sm-12">
						<label class="form-label">Product Name</label>						
						<select class="form-control singleselect mandatory produc product_name" name="product_name" id="product_name" autocomplete="off" >
						<option value="">Search Products</option>
						</select>
						<p class="msg1 errorClass1 alertProduct"></p>
					</li>
					
					<li class="col-sm-12">
						<label class="form-label">Manufacturer</label>
						<select class="form-control createDropdown_add mandatory" name="manufacturer_id" id="manufact_id">	
                        <option value="">Select</option>						
						<?php foreach($manufact as $key=>$manu){ ?>
						<option value="<?= $manu['id']; ?>" ><?= $manu['manufacturer_name']; ?></option>
						<?php } ?>							
						</select>
						<p class="msg1 errorClass1"></p>
						<input type="hidden" name="manufacturer_name" />
						<p class="msg1 errorClass1 alertmanu"></p>
					</li>
					<li class="col-sm-6">
						<label class="form-label">Product Type</label>
						<select class="form-control singleselect mandatory product_type" name="product_type_id" 
						id="product_type_id">
						<option value="">Select</option>
						<?php foreach($product_type as $product_ty){ ?>							    
							<option value="<?= $product_ty['id']; ?>"><?= $product_ty['product_type_name']; ?></option>
						<?php } ?>	
						</select>
						<p class="msg1 errorClass1"></p>
					</li>
					<li class="col-sm-6">
						<label class="form-label">Dosages</label>
						<select class="form-control singleselect mandatory product_dosage" name="product_dosage_id" id="product_dosages_id">
						 <option value="">Select</option>							
						<?php foreach($product_dosages as $product_dos){ ?>							 
						<option value="<?= $product_dos['id']; ?>"><?= $product_dos['dosages_type']; ?></option>
						<?php } ?>	
						</select>
						<p class="msg1 errorClass1"></p>
					</li>
					<li class="col-sm-6">
						<label class="form-label">Quantity In pack</label>
						<input type="text" class="form-control mandatory quant1 qty_in_pack" name="qty_in_pack" 
						value="" id="qty_in_pack" autocomplete="off"/><p class="msg1 errorClass1"></p>
					<p class="msg2 errorClass1"></li>
					
					<li class="col-sm-12 col-md-6">
						<label class="form-label">Quantity Alert</label>
						<input type="text" class="form-control mandatory quant2 qty_alert" name="qty_alert" value="" id="qty_alert" autocomplete="off"/><p class="msg1 errorClass1"></p>
						<p class="msg3 errorClass1"></p></li>
				</ul>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
				<button type="submit" id="submit" class="btn btn-primary text-uppercase" onsubmit="getmodal()">Create</button>
			</div>
		</div>
	</div>
</div>
</form>

 <?php if(!empty($produc)){ foreach($produc as $product){ ?> 
<form method="post" action="<?= $this->Url->build(["controller" =>"inventory","action" =>"addProduct"]); ?>">
<input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
<!-- EditProductModalModal -->	
<div id="newProductModal<?= isset($product['id'])?$product['id']:''; ?>" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?= isset($product['id'])?'Edit Product':'Add Product'; ?></h4> </div>
			<div class="modal-body">
			<?php //pre($product['id']); ?>
				<ul class="row">
					<li class="col-sm-12">
						<label class="form-label">Product Name</label>						
						<select class="form-control singleselect mandatory produc product_name edit_product" name="product_name"  autocomplete="off" id="edit_product<?= isset($product['id'])?$product['id']:''; ?>">										
						<option value="<?= isset($product['product_guid'])?$product['product_guid'].'_'.$product['product_name']:'';?>" <?= isset($product['product_guid'])?'selected':'';?> > <?= ucfirst($product['product_name']); ?> </option>
						</select>
						<p class="msg1 errorClass1 alertProduct"></p>
					</li>
					<input type="hidden" name="id" value="<?= isset($product['id'])?$product['id']:''; ?>" >	
					<li class="col-sm-12">
						<label class="form-label">Manufacturer</label>
						<select class="form-control createDropdown_add mandatory manufac" name="manufacturer_id">
						 <option value="">Select</option>
						<?php if(!empty($produc)){ foreach($manufact as $manu){ ?>		                    			
						<option value="<?= isset($manu['id'])?$manu['id']:'' ?>" <?= isset($manu['id']) && $manu['id']==$product['manufacturer_id'] ? 'selected' : '' ?> ><?php echo ucfirst($manu['manufacturer_name']); ?></option>	<?php } } ?>							
						</select>
					</li>
					<li class="col-sm-6">
						<label class="form-label">Product Type</label>
						<select class="form-control singleselect mandatory" name="product_type_id">
						<option value="">Select</option>
						<?php if(!empty($produc)){ foreach($product_type as $product_ty){ ?>							    
							<option value="<?= $product_ty['id']; ?>" <?= isset($product_ty['id']) && $product_ty['id']==$product['product_type_id']?'selected':'';?> ><?= $product_ty['product_type_name']; ?></option>
						<?php } } ?>	
						</select>
						<p class="msg1 errorClass1"></p>
					</li>
					<li class="col-sm-6">
						<label class="form-label">Dosages</label>
						<select class="form-control singleselect mandatory" name="product_dosage_id">
						 <option value="">Select</option>							
						<?php if(!empty($produc)){ foreach($product_dosages as $product_dos){ ?> <option value="<?= isset($product_dos['id'])?$product_dos['id']:''; ?>" <?= isset($product_dos['id'])&& $product_dos['id']==$product['product_dosage_id']?'selected':'';?> ><?= $product_dos['dosages_type']; ?></option>
						<?php } } ?>	
						</select>
						<p class="msg1 errorClass1"></p>
					</li>
					<li class="col-sm-6">
						<label class="form-label">Quantity In pack</label>
						<input type="text" class="form-control mandatory quant1" name="qty_in_pack" 
						value="<?= isset($product['qty_in_pack'])?$product['qty_in_pack']:'';?>"/><p class="msg1 errorClass1"></p>
					</li>
					
					<li class="col-sm-12 col-md-6">
						<label class="form-label">Quantity Alert</label>
						<input type="text" class="form-control mandatory quant2" name="qty_alert" value="<?= isset($product['qty_alert']) ? $product['qty_alert']:'';?>"/><p class="msg1 errorClass1"></p></li>
				</ul>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary text-uppercase"><?= isset($product['id'])?'Update':'Create'; ?></button>
			</div>
		</div>
	</div>
</div>
</form>
 <?php } } ?>	

 <?php foreach($produc as $product){ ?>
<form method="post" action="<?php echo $this->Url->build(["controller" =>"inventory","action" =>"disable"]); ?>">
	
<input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
	
	<!-- Modal -->	
	<div id="disableProductModal<?= isset($product['id'])?$product['id']:''; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
		<?php //pre($product); ?>
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Disable Product</h4> </div>
				<div class="modal-body">
					<ul class="row">
						<li class="col-sm-12">
							<label class="form-label">Product Name</label>
							<input type="text" class="form-control" value="<?= isset($product['product_name'])?ucfirst($product['product_name']):'';?>" readonly /> </li>
						<input type="hidden" name="id" value="<?= isset($product['id'])?$product['id']:''; ?>" >
                        <input type="hidden" name="value" value="0" >						
						<li class="col-sm-12">						
							<label class="form-label">Manufacturer</label>							
							<input type="text" class="form-control" value="<?php foreach($manufact as $manu){ echo $manu['id']==$product['manufacturer_id']?ucfirst($manu['manufacturer_name']):''; }?>" readonly /> </li>
						<li class="col-sm-12 col-md-6">
						<label class="form-label">Type</label>
						<input type="text" class="form-control" value="<?php foreach($product_type as $product_ty){ echo $product_ty['id']==$product['product_type_id']?$product_ty['product_type_name']:''; }?>" readonly /> </li>
						<li class="col-sm-12 col-md-6">
						<label class="form-label">Dosages</label>
						<input type="text" class="form-control" value="<?php foreach($product_dosages as $product_dos){ echo $product_dos['id']==$product['product_dosage_id']?$product_dos['dosages_type']:''; }?>" readonly /> </li>
						
						<li class="col-sm-12 col-md-6">
						<label class="form-label">Quantity In pack</label>
						<input type="text" class="form-control" value="<?= $product['qty_in_pack']?$product['qty_in_pack']:'';?>" readonly /> </li>
							
						<li class="col-sm-12 col-md-6">							
						<label class="form-label">Quantity Alert</label>
						<input type="text" class="form-control" value="<?= isset($product['qty_alert'])?$product['qty_alert']:'';?>" readonly /> </li>
						
						<li class="col-sm-12">
							<label class="form-label">Reason</label>
							<select id="reasonSelect" class="form-control" name="reason">
								<option value="discontinue">Discontinue</option>
								<option value="batch recall">Batch Recall</option>
								<option value="shortage">Shortage</option>
								<option value="other">Other</option>
							</select>
						</li>			
					</ul>
				</div>
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary text-uppercase">Disable</button>
				</div>
			</div>
		</div>
	</div>
	</form>
<?php } ?>

<?php foreach($produc as $product){ ?>
<form method="post" action="<?php echo $this->Url->build(["controller" =>"inventory","action" =>"disable"]); ?>">
	
<input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
	
	<!-- Enable Modal -->
	<div id="confirmationModal<?= isset($product['id'])?$product['id']:''; ?>" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header  text-center">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Confirmation</h4> </div>
				<div class="modal-body text-center">
					<p>Are you sure you want to enable this product?</p>
				</div>
				<input type="hidden" name="id" value="<?= isset($product['id'])?$product['id']:''; ?>" >				
				<input type="hidden" name="value" value="1" >
				<div class="modal-footer text-center">
					<button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary text-uppercase">Enable</button>
				</div>
			</div>
		</div>
	</div>	
	</form>
<?php } ?>		

<script>
 function edit_product(product_id, manuID, product_name, manufacturer_name, product_type_name, qty_in_pack, dosages_type, qty_alert){
	//alert(product_name); 
	$('#product_name').val(product_id);
	//$('#manufact_id').val(manuID).find("option[value=" + manuID +"]").attr('selected', true);
	//$('#manufact_id option:contains('+manuID+')').attr('selected', 'selected');
	//$('option#abcd').val(manuID).attr('selected', 'selected');
	$('.product_type').val(product_type_name);
	$('.qty_in_pack').val(qty_in_pack);	
	$('.product_dosage').val(dosages_type);
	$('.qty_alert').val(qty_alert);
	
 }
 
</script>		
	
<script>

$(document).ready(function () {
 
  $('.loadmore').click(function (e) {
	 var ID = $(this).attr('id');
	  //alert(value);
	 $.ajax({
	type:'get',	
	url:'<?= $this->Url->build(["controller" =>"inventory","action" =>"loadMore"]); ?>',
	data:{value:value},
	success:function(response){	
	console.log(response);
        $('tbody').empty();
		$('tbody').append(response);
	}
	
     });
   }); 
   
   $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
		
	$('.quant1').keypress(function (event){
	var keycode = event.which;
	if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57)))) {
		event.preventDefault();
	$('.msg2').text('Digits Only!!').fadeIn('slow').delay(2500).fadeOut();
	}
	});
	
	$('.quant2').keypress(function (event){
	var keycode = event.which;
	if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57)))) {
		event.preventDefault();
	$('.msg3').text('Digits Only!!').fadeIn('slow').delay(2500).fadeOut();
	}
	});
			
	$('#submit').click(function () {
		
	$(".mandatory").each(function()
	{
		if($(this).val()=="")
		{
			$(this).next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
			$(this).next().next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
		}
	});
	
	if( $('#product_name').val()=="" || $('#manufact_id').val()=="" || $('#product_type_id').val()=="" || $('#qty_in_pack').val()=="" || $('#product_dosages_id').val()=="" || $('#type').val()=="" || $('#qty_alert').val()=="")
	{
		return false;
	}
    
});

	$('body').on('change','.produc',function(){ 
		var value = $(this).val().toLowerCase();
		//alert(value);
		var splitProduct = value.split('_');
		//alert(splitProduct[1]);
		var split01 = splitProduct[1];
		 $.ajax({
		type:'get',	
		url:'<?= $this->Url->build(["controller" =>"inventory","action" =>"checkDuplicate"]); ?>',
		data:{value:split01},
		success:function(response){	
		console.log(response);
		$('.alertProduct').text(response).delay(2500).fadeOut();
		$(this).val().empty();
		//alert(response);
		}
		 });
		}); 

  $('.searchByAlpha').click(function (e) {
	var value = $(this).text();
	//alert(value);
	$.ajax({
	type:'get',	
	url:'<?php echo $this->Url->build(["controller" =>"inventory","action" => "alphabets"]); ?>',
	data:{value:value},
	success:function(response){	
		console.log(response);
		$('tbody').empty();
		$('tbody').append(response);
		}
		
	});
});

$('.searchByAll').click(function (e) {
	var value = $(this).text();
	//alert(value);
	$.ajax({
	type:'get',	
	url:'<?php echo $this->Url->build(["controller" =>"inventory","action" => "all"]); ?>',
	data:{value:value},
	success:function(response){	
		console.log(response);
		$('tbody').empty();
		$('tbody').append(response);
		}
		
	});
});


var timeout;
var delay = 1000;
var isLoading = false;
$('body').on('keyup','.product_name input.select2-search__field',function()
{
    if(timeout)
    clearTimeout(timeout);
    reloadProduct();
});

function reloadProduct()
{
    if(!isLoading)
    {
        timeout = setTimeout(function() {

            var count = $(".product_name input.select2-search__field").val().length;

            var url = window.location.href;

            if(count>2)
            {
                if(url.indexOf('www') != -1) {
                $.ajax({
                    url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
                    type: "POST",
                    data: {'value' : $(".product_name  input.select2-search__field").val() , 'type' : 'medicines'},
                    headers:
                    {
                        'X-CSRF-Token': '<?php echo json_encode($this->request->getParam('_csrfToken')); ?>'
                    },
                    success: function(data)
                    {
                        $(".select2-results__option").css("display","none");
                        $(".productErrorClass").css("display","none");
                        $("#product_name").html("");
                       
                        var obj = $.parseJSON(data);
                        if(obj!="") {
                        jQuery.each(obj, function(i, val)
                        {
                            var value = val.id+"_"+val.name;
                            $("#product_name").append('<option  value="'+value+'">'+val.name+'</option>');
                                                        							
                        }); }
                        else
                        {
                            $("#product_name").append('<option value="">No Product Found</option>');                          
                                                   
                        }

                        $.ajax({
                            url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
                            type: "POST",
                            data: {'product_name' : $('.product_name :selected').val() ,  'type' : 'companyFormName'},
                            headers:
                            {
                                'X-CSRF-Token': '<?php echo json_encode($this->request->getParam('_csrfToken')); ?>'
                            },
                            success: function(data)
                            {
                                var obj = $.parseJSON(data);
                                $(".companyName").text(obj.companyName);
                                $(".formName").text(obj.formName);
                            }
                        });
                    }
                });
                }
                else {
                $.ajax({
                    url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
                    type: "POST",
                    data: {'value' : $(".product_name  input.select2-search__field").val() , 'type' : 'medicines'},
                    headers:
                    {
                        'X-CSRF-Token': '<?php echo json_encode($this->request->getParam('_csrfToken')); ?>'
                    },
                    success: function(data)
                    {
                        $(".select2-results__option").css("display","none");
                        $(".productErrorClass").css("display","none");
                        $("#product_name").html("");
                       
                        var obj = $.parseJSON(data);
                        if(obj!="") {
                        jQuery.each(obj, function(i, val)
                        {
                            var value = val.id+"_"+val.name;
                            $("#product_name").append('<option  value="'+value+'">'+val.name+'</option>');
                                                        
                        }); }
                        else
                        {
                            $("#product_name").append('<option value="">No Product  Found</option>');
                            
                        }

                        $.ajax({
                            url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
                            type: "POST",
                            data: {'product_name' : $('.product_name :selected').val() ,  'type' : 'companyFormName'},
                            headers:
                            {
                                'X-CSRF-Token': '<?php echo json_encode($this->request->getParam('_csrfToken')); ?>'
                            },
                            success: function(data)
                            {
                                var obj = $.parseJSON(data);
                                $(".companyName").text(obj.companyName);
                                $(".formName").text(obj.formName);
                            }
                        });
                    }
                });
                }
            }
            if(count==0)
            {
                $("#product_name").html('<option value="">Select Product</option>');
                
            }

            setTimeout(function() { isLoading = false; }, delay);
        }, delay);
    }
}

<?php if(!empty($produc)){ foreach($produc as $product) { ?>
$('body').on('keyup','.edit_product<?= isset($product['id'])?$product['id']:''; ?> input.select2-search__field',function()
{
    if(timeout)
    clearTimeout(timeout);
    reloadProduct<?= isset($product['id'])?$product['id']:''; ?>();
});

function reloadProduct<?= isset($product['id'])?$product['id']:''; ?>()
{
    if(!isLoading)
    {
        timeout = setTimeout(function() {

            var count = $(".edit_product<?= isset($product['id'])?$product['id']:''; ?> input.select2-search__field").val().length;

            var url = window.location.href;

            if(count>2)
            {
                if(url.indexOf('www') != -1) {
                $.ajax({
                    url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
                    type: "POST",
                    data: {'value' : $(".edit_product<?= isset($product['id'])?$product['id']:''; ?>  input.select2-search__field").val() , 'type' : 'medicines'},
                    headers:
                    {
                        'X-CSRF-Token': '<?php echo json_encode($this->request->getParam('_csrfToken')); ?>'
                    },
                    success: function(data)
                    {
                        $(".select2-results__option").css("display","none");
                        $(".productErrorClass").css("display","none");
                        $("#edit_product<?= isset($product['id'])?$product['id']:''; ?>").html("");
                       
                        var obj = $.parseJSON(data);
                        if(obj!="") {
                        jQuery.each(obj, function(i, val)
                        {
                            var value = val.id+"_"+val.name;
                            $("#edit_product<?= isset($product['id'])?$product['id']:''; ?>").append('<option  value="'+value+'">'+val.name+'</option>');
                                                        							
                        }); }
                        else
                        {
                            $("#edit_product<?= isset($product['id'])?$product['id']:''; ?>").append('<option value="">No Product Found</option>');                          
                                                   
                        }

                        $.ajax({
                            url: 'http://www.docpharmrx.com/testing/CIMSSampleCode.php',
                            type: "POST",
                            data: {'product_name' : $('.edit_product<?= isset($product['id'])?$product['id']:''; ?> :selected').val() ,  'type' : 'companyFormName'},
                            headers:
                            {
                                'X-CSRF-Token': '<?php echo json_encode($this->request->getParam('_csrfToken')); ?>'
                            },
                            success: function(data)
                            {
                                var obj = $.parseJSON(data);
                                $(".companyName").text(obj.companyName);
                                $(".formName").text(obj.formName);
                            }
                        });
                    }
                });
                }
                else {
                $.ajax({
                    url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
                    type: "POST",
                    data: {'value' : $(".edit_product<?= isset($product['id'])?$product['id']:''; ?>  input.select2-search__field").val() , 'type' : 'medicines'},
                    headers:
                    {
                        'X-CSRF-Token': '<?php echo json_encode($this->request->getParam('_csrfToken')); ?>'
                    },
                    success: function(data)
                    {
                        $(".select2-results__option").css("display","none");
                        $(".productErrorClass").css("display","none");
                        $("#edit_product<?= isset($product['id'])?$product['id']:''; ?>").html("");
                       
                        var obj = $.parseJSON(data);
                        if(obj!="") {
                        jQuery.each(obj, function(i, val)
                        {
                            var value = val.id+"_"+val.name;
                            $("#edit_product<?= isset($product['id'])?$product['id']:''; ?>").append('<option  value="'+value+'">'+val.name+'</option>');
                                                        
                        }); }
                        else
                        {
                            $("#edit_product<?= isset($product['id'])?$product['id']:''; ?>").append('<option value="">No Product  Found</option>');
                            
                        }

                        $.ajax({
                            url: 'http://docpharmrx.com/testing/CIMSSampleCode.php',
                            type: "POST",
                            data: {'product_name' : $('.edit_product<?= isset($product['id'])?$product['id']:''; ?> :selected').val() ,  'type' : 'companyFormName'},
                            headers:
                            {
                                'X-CSRF-Token': '<?php echo json_encode($this->request->getParam('_csrfToken')); ?>'
                            },
                            success: function(data)
                            {
                                var obj = $.parseJSON(data);
                                $(".companyName").text(obj.companyName);
                                $(".formName").text(obj.formName);
                            }
                        });
                    }
                });
                }
            }
            if(count==0)
            {
                $("#edit_product<?= isset($product['id'])?$product['id']:''; ?>").html('<option value="">Select Product</option>');
                
            }

            setTimeout(function() { isLoading = false; }, delay);
        }, delay);
    }
}
<?php } } ?>

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
			var  csrf = '<?php echo json_encode($this->request->getParam('_csrfToken')); ?>';
		    var frm=$("form#upload")[0];
            var formData = new FormData(frm);
        $.ajax({
            url : '<?=$this->Url->build(["controller"=>"inventory","action"=>"targetUpload"]);?>',
            type :'POST',
			headers : {'X-CSRF-Token':csrf},
            dataType :'json',
            processData: false,
            contentType: false,
            data : formData,
            success: function(response){
			console.log(response);	
            alert(response.msg);			
			}
			
		});
		
		/*var profilePic = curr[0].files[0]; 
			//alert(profilePic);			
			var fd = new FormData();
			fd.append("format", "json");   // 2
			fd.append("type", curr.attr('rel'));
			fd.append("uploadfile", profilePic);   
			 fd.append("Month", selectedMonth);   
			fd.append("Year", selectedYear);   
			fd.append("Year", selectedYear);  
			
			var xhr = new XMLHttpRequest();
			xhr.open("get", '<?=$this->Url->build(["controller"=>"inventory","action"=>"targetUpload"]);?>');   // 4
			xhr.onload  = function(json)
			{ 
				if (xhr.status == 200)
				{  
					//overlayHide();
					var detls=$.parseJSON(xhr.response);
					//console.log(detls);
					if(detls.msg=='success')
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
					if(detls.msg=='Success')
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
			}; 
			xhr.send(fd); */
		} 
	});
});

</script>		
	<script type="text/javascript">
		$(document).ready(function () {
			$(".singleselect").select2();
			
			 <?php if(!empty($produc)){ foreach($produc as $product) { ?>
			 $("#edit_product<?= isset($product['id'])?$product['id']:''; ?>").select2({
				dropdownCssClass: "edit_product<?= isset($product['id'])?$product['id']:''; ?>"
			});
			 <?php } } ?>
			
			$("#product_name").select2({
				dropdownCssClass: "product_name"
			});
			
			$('#customerTable').DataTable({
				responsive: true
				, info: false
				, paging: false
				, searching: false
				, ordering: false
			});
			$(document).on("click", ".menutoggle", function (e) {
				e.preventDefault();
				$(this).toggleClass('active');
				$('header').toggleClass('active');
			});
			// SELECT SHEET
			$(document).on("click", ".inputHit", function (e) {
				e.preventDefault();
				$('.inputBox').trigger('click');
			});
			// SELECT NAME
			$(".createDropdown_add").select2({
				tags: true,
				language: {
					noResults: function () {
						return '<small class="text-muted">No Match Found</small> <a href="#" class="text-link text-uppercase pull-right">Add New</a>';
					}
				},
				escapeMarkup: function (markup) {
					return markup;
				},
				insertTag: function (data, tag) {
					tag.text = "Add New: '<strong>" + tag.text + "</strong>' ";
					data.push(tag);
				}
			});
			
			$(".createDropdown").select2({
				tags: true,
				language: {
					noResults: function () {
						return '<small class="text-muted">No Match Found</small> <a href="#" class="text-link text-uppercase pull-right">Add New</a>';
					}
				},
				escapeMarkup: function (markup) {
					return markup;
				}
			});
			// SELECT SHEET
			$('#reasonSelect').on('change', function () {
				if ($(this).val() == 'other') {
					$('#othreMessage').show();
				}
				else {
					$('#othreMessage').hide();
				}
			});
		});
	</script>
	
 <!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->