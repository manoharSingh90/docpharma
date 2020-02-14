<header>		<?php echo $this->element("left_panel"); ?></header><form method="post" action="<?php echo $this->url->build(["controller" => "inventory","action" =>"saveOrderForm"]); ?>" class="create-patient-form clearfix orderForm" ><input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >
<div class="main-wraper">
  <div class="container">
    <div class="row">
      <ul class="customHeadWrap">
        <li class="col-md-6 col-12"> <a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" => "orderForm"]); ?>" class="text-uppercase backLink"><i class="sprite backIcon"></i> Back</a>
        <div class="customHead"> <b><i class="sprite orderIcon"></i></b> <span>Create Order Form</span> </div>
        </li>
        <li class="col-md-6 col-12 text-right">
          <div class="headLink"><a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" => "orderForm"]); ?>" class="btn text-uppercase btn-default">Cancel</a> <button type="submit" id="submit" class="btn text-uppercase btn-primary">Save</button></div>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="customerlistWrap">
      <div class="orderTitle">
        <label>Order Form Name</label>
        <input type="text" class="form-control ordername mandatory" name="order_name" value="<?= isset($data['order_name'])?ucfirst($data['order_name']):''; ?>" id="ordername" autocomplete="off" />		<p class="msg1 errorQuant"></p>        <input type="hidden" class="form-control" name="orderForm_id" value="<?= isset($data['id'])?$data['id']:''; ?>"/>
      </div>
      <div class="tablewrap">
        <table id="customerTable" style="width:100%">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Manufacturer</th>
              <th>No. Of Pack</th>              <th>Total Quantity</th>
              <th>Type</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>        <?php if(empty($data['id'])){ ?>
            <tr class="incr">			 <input type="hidden" class="form-control" name="order_detail_id[]" value=""/>
              <td>
                <select class="form-control singleselect mandatory manufacturer product_name" name="product_id[]" id="product_id" 				data-id="1">				<option value="">Select</option>                  <?php foreach($produc as $product){ ?>                    <?php if($product['is_active']==1){ ?>					                    <option value="<?= $product['id']; ?>"><?= ucfirst($product['product_name']); ?></option>						  <?php } } ?>
                </select>				<p class="msg1 errorProduct"></p>
              </td>
             <td> <input class="form-control manufac_1" readonly /></td>			              			  			  <td>                <div class="qtyInput">                 <input type="text" class="form-control quant1 numPack pack_1" name="num_of_pack[]" data-id="1" 				 autocomplete="off" />                 <p class="errorQuant msg2"></p>				                 </div>              </td>			  			  <td>                <div class="qtyInput">                  <input type="text" class="form-control qtyInput quant1 read_1" name="quantity_ordered[]" id="quantity_ordered" autocomplete="off"/><p class="errorQuant msg2"></p>                </div>              </td>			  
              <td><input class="form-control manufactype_1" readonly /> </td>
              <td class="text-center"><a class="addNewLayer addmoreBtn" href="#"><b class="sprite addplusIcon"></b></a></td>
            </tr>			        <?php }else{ ?>		<?php foreach($productData as $key=>$value){ ?>		 <tr class="incr">		 <input type="hidden" class="form-control" name="order_detail_id[]" value="<?= isset($value['order_detailsID'])?$value['order_detailsID']:''; ?>"/>              <td>                <select class="form-control singleselect mandatory manufacturer product_name" name="product_id[]"				data-id="<?= $key+1; ?>">				<option value="">Select</option>                  <?php foreach($produc as $product){ ?>                   <?php if($product['is_active']==1){ ?>					                    <option value="<?= $product['id']; ?>" <?= $value['ProductID']==$product['id']?'selected':''; ?>> <?= ucfirst($product['product_name']); ?></option><?php } } ?>                </select>				<p class="msg1 errorClass1"></p>              </td>             <td class="nothing<?= $key+1; ?>"><input class="form-control manufac_<?= $key+1; ?>" value="<?= isset($value['manufacturer_name'])?$value['manufacturer_name']:''; ?>" readonly /></td>						<td>                <div class="qtyInput">                 <input type="text" class="form-control quant1 numPack pack_<?= $key+1; ?>" name="num_of_pack[]" value="<?= isset($value['num_of_pack'])?$value['num_of_pack']:''; ?>" data-id="<?= $key+1; ?>" autocomplete="off" />                 <p class="errorQuant msg2"></p>				                 </div>              </td>               <td>                <div class="qtyInput">                  <input type="text" class="form-control qtyInput mandatory quant1 read_<?= $key+1; ?>" name="quantity_ordered[]" value="<?= isset($value['quantity_ordered'])?$value['quantity_ordered']:''; ?>" 				  autocomplete="off"/>				  <p class="errorClass1 msg2"></p>                </div>              </td>			              <td class="nothing<?= $key+1; ?>"> <input class="form-control manufactype_<?= $key+1; ?>" value="<?= isset($value['dosages_type'])?$value['dosages_type']:''; ?>" readonly /> </td>   			  			  <td class="text-center"><a class="addmoreBtn"><b class="sprite <?php echo $key==0 ?'addplusIcon':'minusIcon'; ?> 			  <?php echo $key==0 ? 'addNewLayer':'removelayer'; ?>"></b></a></td>                     </tr>						<?php } ?> <!--<a href="" class="addNewLayer addmoreBtn more"><b class="sprite addplusIcon"></b></a>--> <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div></form><script>$(document).ready(function () {$("body").on("keyup",".numPack",function(){	 	var abc = $(this).attr("data-id");	var product_id = $('.manufacturer[data-id="'+abc+'"]').val();	var value = $(this).val();	//alert(product_id+' '+abc);	//alert(abc);	 $.ajax({	type:'get',		url:'<?php echo $this->Url->build(["controller" => "inventory","action" =>"findManufac"]); ?>',	data:{value:product_id},	success:function(response){		console.log(response);		//alert(response);		var obj = jQuery.parseJSON(response);		//alert(obj.qty_in_pack);		var mult = value*(obj.qty_in_pack);				$('#emTD'+abc).empty();		$('.read_'+abc).val(mult);				}			 }); }); $('.quant1').keypress(function (event){	var keycode = event.which;	if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57)))) {		event.preventDefault();	//$('.msg2').text('Digits Only!!').fadeIn('slow').delay(2500).fadeOut();	}	});		$("body").on("keypress",".quant2",function(event){     var keycode = event.which;    if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57 )|| (keycode == 46)))) {        event.preventDefault();    }   });	 /* $("body").on("click","#submit",function(){		$(".mandatory").each(function()	{		if($(this).val()=="")		{			$(this).next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();			$(this).next().next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();			//return false;		}	});		if($('#product_id').val()=="" || $('#quantity_ordered').val()=="" || $('#ordername').val()=="")	{		return false;	}	});  */$('#submit').click(function(e) {        var isValid = true;        $(' input[type="text"]').each(function() {            if ($.trim($(this).val()) == '') {                isValid = false;				$(this).next('p.errorQuant').text('Field is required').fadeIn('slow').delay(2500).fadeOut();                           }			                    });				$('select.mandatory').each(function() {            if ($.trim($(this).val()) == '') {                isValid = false;							  $(this).next().next('p.errorProduct').text('Product is required').fadeIn('slow').delay(2500).fadeOut();                         } 			                  });		        if (isValid == false)            e.preventDefault();            }); /* $('#product_id').change(function (e) {	//alert();	var value = $(this).val().toLowerCase();	//alert(value);	$.ajax({	type:'get',		url:'<?php echo $this->Url->build(["controller" => "inventory","action" =>"findManufac"]); ?>',	data:{value:value},	success:function(response){		console.log(response);		var obj = jQuery.parseJSON(response);		$('.manufac').val(obj.manu);		$('.manufactype').val(obj.type);		}			 });	   }); */      $("body").on("change",".manufacturer",function(){		var abc = $(this).attr("data-id");	//alert(abc);	var value = $(this).val().toLowerCase();	//alert(value);	$.ajax({	type:'get',		url:'<?php echo $this->Url->build(["controller" => "inventory","action" =>"findManufac"]); ?>',	data:{value:value},	success:function(response){		console.log(response);		/* alert(response);*/				var obj = jQuery.parseJSON(response);		$('#empTD'+abc).empty();		$('#emptyTD'+abc).empty();		var vlu = $('.pack_'+abc).val();		$('.read_'+abc).val(vlu*(obj.qty_in_pack));		$('.manufac_'+abc).val(obj.manu);		$('.manufactype_'+abc).val(obj.type);		}			 });   });});</script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#customerTable').DataTable({
			responsive: true,
			info: false,
			paging: false,
			searching: false,			ordering: false
		});
		$(document).on("click", ".menutoggle", function (e) {
			e.preventDefault();
			$(this).toggleClass('active');
			$('header').toggleClass('active');
		});
		$(".singleselect").select2();
		//ADD MORE
		$(document).on('click', '.addNewLayer', function (e) {
			e.preventDefault();		var countClass = $('.incr').length+1;
		var data = $('<tr class="incr"> <input type="hidden" class="form-control" name="order_detail_id[]" value=""/><td><select class="form-control singleselect mandatory manufacturer product_name" name="product_id[]" id="product_id" data-id="'+countClass+'"><option value="">Select</option><?php foreach($produc as $product){ ?> <option value="<?= $product['id']; ?>"><?= ucfirst($product['product_name']); ?></option><?php } ?></select><p class="msg1 errorProduct"></p></td><td><input class="form-control manufac_'+countClass+'" readonly /></td><td><div class="qtyInput"> <input type="text" class="form-control quant2 numPack pack_'+countClass+'" name="num_of_pack[]" data-id="'+countClass+'" autocomplete="off" /><p class="errorQuant msg2"></p></div></td><td><div class="qtyInput"><input type="text" class="form-control qtyInput quant2 read_'+countClass+'" name="quantity_ordered[]" id="quantity_ordered" autocomplete="off"/><p class="errorQuant msg2"></p></div></td><td><input class="form-control manufactype_'+countClass+'" readonly /></td><td class="text-center"><a class="addmoreBtn"><b class="sprite minusIcon removelayer"></b></a></td></tr>');
		$(this).closest('table').append(data);        $(".singleselect").select2();				
		});						$("body").on("keypress",".quant2",function(event){        var keycode = event.which;          if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57 )))) {        event.preventDefault();		 }		});				$(document).on('click', '.removelayer', function (e) {			//e.preventDefault();			$(this).closest('tr').remove();						});
	});
</script>    <!-- FOOTER -->	<?php echo $this->element("footer"); ?>	<!-- FOOTER -->