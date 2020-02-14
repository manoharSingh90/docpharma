<header>
		<?php echo $this->element("left_panel"); ?>
</header>
<form id="formID" method="post" action="<?php echo $this->Url->build(["controller" => "inventory","action" => "save"]); ?>" class="create-patient-form clearfix" >

<input type="hidden"  name="_csrfToken" value=<?php echo json_encode($this->request->getParam('_csrfToken')); ?> >

<input type="hidden" name="id[]" value="<?= isset($data['id'])?$data['id']:''; ?>">
<div class="main-wraper">
  <div class="container">
    <div class="row">
      <ul class="customHeadWrap">
        <li class="col-md-6 col-12"> <a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" => "index"]); ?>" class="text-uppercase backLink"><i class="sprite backIcon"></i> Back</a>
          <div class="customHead"> <b><i class="sprite productIcon"></i></b> <span><?= isset($product['id'])?'Edit Inventory':'Create Inventory'; ?></span> </div>
        </li>	
        <li class="col-md-6 col-12 text-right">
          <div class="headLink"><a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" => "index"]); ?>" class="btn text-uppercase btn-default">Cancel</a> 
		  <button type="submit" id="submit" class="btn text-uppercase btn-primary">Save</button></div>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="customerlistWrap onlytable">
      <div class="tablewrap">
        <table id="customerTable" style="width:100%">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Manufacturer</th>
              <th>Batch No.</th>
              <th>Expiry Date</th>
              <th>No. Of Pack</th>
              <th>Total Quantity</th>
              <th>Per Pack Price</th>
              <th>Type</th>
              <th>Location</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr class="incr">
              <td>
			   <select class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-control singleselect manufacturer mandatory product_id" name="product_id[]" data-id="1" id="product_id">
                 <option value="">Select</option>
                  <?php foreach($produc as $product){ ?>
                    <?php if($product['is_active']==1){ ?>				  
                  <option value="<?= $product['id']; ?>" <?= $data['product_id']==$product['id']? 'selected':''; ?>>
				  <?= ucfirst($product['product_name']); ?></option><?php } } ?>
                </select>
				<p class="msg1 errorProduct"></p>
              </td>
              <td><input class="form-control emptyTD manufac_1" value="<?= isset($productData[0]['manufacturer_name'])?$productData[0]['manufacturer_name']:''; ?>" readonly /></td>
			  
              <td>
                <input type="text" class="form-control mandatory batch_no" name="batch_no[]" id="batch_no"
				value="<?= isset($productData[0]['batch_no'])?$productData[0]['batch_no']:''; ?>" autocomplete="off"/>
				<p class="msg1 errorQuant"></p>
              </td>
              <td>	
              <div class="dateWrapdate">			  
		      <input type="text" class="form-control recurring mandatory expiry_date callDate_1" data-id="1" name="expiry_date[]" value="<?= isset($productData[0]['expiry_date'])?$productData[0]['expiry_date']:''; ?>" autocomplete="off"><p class="msg1 errorQuant"></p>
			  </div>
		     </td>
			 
			 <td>
                <div class="qtyInput">
                 <input type="text" class="form-control quant1 numPack pack_1" name="no_of_pack[]" value="<?= isset($productData[0]['no_of_pack'])?$productData[0]['no_of_pack']:''; ?>"  data-id="1" maxlength="6" 
				 autocomplete="off" />
                 <p class="errorQuant msg2"></p>				 
                </div>
             </td> 
			  
			 <td>
              <div class="clearfix">			 
		      <input type="text" class="form-control quant1 read_1" id="quantity" name="quantity[]" value="<?= isset($productData[0]['quantity'])?$productData[0]['quantity']:''; ?>" autocomplete="off" maxlength="10" >
			  <p class="msg1 errorQuant"></p>
			  </div>
		     </td>
			         
			  <td>              
			  <input type="text" class="form-control mandatory quant2 unit_price" name="unit_price[]" id="unit_price"
			  value="<?= isset($productData[0]['unit_price'])?$productData[0]['unit_price']:''; ?>" autocomplete="off" maxlength="8" />
		      <p class="msg1 msg2 errorQuant"></p>            
              </td>
			  
             <td><input class="form-control manufactype_1" value="<?= isset($productData[0]['dosages_type'])?$productData[0]['dosages_type']:''; ?>" readonly /></td>
              <td>
                <input type="text" class="form-control locationInput mandatory location" name="location[]" id="location" value="<?= isset($productData[0]['location'])?$productData[0]['location']:''; ?>" autocomplete="off"><p class="msg1 errorQuant"></p>                 
              </td>
              <td class="text-center"><a class="addmoreBtn"><b class="sprite addplusIcon addNewLayer"></b></a></td>
            </tr>
			
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
 </form>
<!-- Modal -->
<div id="confirmationModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header  text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body text-center">
        <p>Are you sure you want to delete this inventory?</p>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-default text-uppercase" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary text-uppercase">Delete</button>
      </div>
    </div>
  </div>
</div>
<?php echo $this->Html->script(['pharmacy/moment.min.js','pharmacy/bootstrap-datetimepicker.min-date.js']); ?>
<script>
/* $('#submit').click(function (e) {
	
	$(".mandatory").each(function()
	{
		if($(this).val()=="")
		{
			$(this).next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
			$(this).next().next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
		}
	});
	
	if($('#product_id').val()=="" || $('#batch_no').val()=="" || $('#quantity').val()=="" || $('#location').val()=="" || $('#expiry_date').val()=="" || $('#unit_price').val()=="" )
	{
		return false;
	}
    
}); */

$('#submit').click(function(e) {

        var isValid = true;
        $(' input[type="text"]').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;
				$(this).next('p.errorQuant').text('Field is required').fadeIn('slow').delay(2500).fadeOut();               
            }
			
            
        });
		
		$('select.mandatory').each(function() {
            if ($.trim($(this).val()) == '') {
                isValid = false;				
			  $(this).next().next('p.errorProduct').text('Product is required').fadeIn('slow').delay(2500).fadeOut();              
           } 
			          
        });
		
        if (isValid == false)
            e.preventDefault();
        
    });
  
 $("body").on("keyup",".numPack",function(){
	 
	var abc = $(this).attr("data-id");
	var product_id = $('.manufacturer[data-id="'+abc+'"]').val();
	var value = $(this).val();
	
	//alert(product_id+' '+value);
	 $.ajax({
	type:'get',	
	url:'<?php echo $this->Url->build(["controller" => "inventory","action" =>"findManufac"]); ?>',
	data:{value:product_id},
	success:function(response){
		console.log(response);
		//alert(response);
		var obj = jQuery.parseJSON(response);
		//alert(obj.qty_in_pack);
		var mult = value*(obj.qty_in_pack);		
		$('#emTD').empty();
		$('.read_'+abc).val(mult);		
		}		
	 }); 
}); 

$('.quant1').keypress(function (event){
	var keycode = event.which;
	if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57)))) {
		event.preventDefault();
	}
	});
			
 $("body").on("change",".manufacturer",function(){
	
	var abc = $(this).attr("data-id");
	//alert(abc);
	var value = $(this).val().toLowerCase();
	//alert(value);
	$.ajax({
	type:'get',	
	url:'<?php echo $this->Url->build(["controller" => "inventory","action" =>"findManufac"]); ?>',
	data:{value:value},
	success:function(response){
		console.log(response);
		//alert(response);
		var obj = jQuery.parseJSON(response);
		//alert(obj.qty_in_pack);
		$('#empTD').empty();
		$('#emptyTD').empty();
		var vlu = $('.pack_'+abc).val();
		$('.read_'+abc).val(vlu*(obj.qty_in_pack));
		$('.manufac_'+abc).val(obj.manu);
		$('.manufactype_'+abc).val(obj.type);
		}		
	 });
   });
</script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#customerTable').DataTable({
			responsive: true,
			info: false,
			paging: false,
			searching: false,
			ordering: false
		});

	/* $('.recurring2').focus(function () {
    $(this).datetimepicker({
		
                   format: 'DD MMM YYYY',
		 			minDate: moment(),
					//maxDate: moment(),
		 			//useStrict:true,
		 			//keepOpen: true,
					//inline: true,
				//	widgetParent: 'body'

    });
   }); */
   
   /* $('body').on('focus',".recurring", function(){
    $(this).datetimepicker({		
	   format: 'DD MMM YYYY',
		minDate: moment(),
		//maxDate: moment(),
		//useStrict:true,
		//keepOpen: true,
		//inline: true,
	   //widgetParent: 'body'
    });
   }); */

     $('.recurring').datetimepicker({
			format: 'DD MMM YYYY',
		    minDate: moment()
		//maxDate: moment(),
		//useStrict:true,
		//keepOpen: true,
		//inline: true,
		 });   
	 
		$('.menutoggle').click(function () {
			$(this).toggleClass('active');
			$('header').toggleClass('active');
		});
		$(".singleselect").select2();

				//ADD MORE
		$(document).on('click', '.addNewLayer', function (e) {
			e.preventDefault();
       var countClass = $('.incr').length+1;
       var data = $('<tr class="incr"><input type="hidden" name="id[]" value=""><td><select class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-control singleselect mandatory manufacturer product_id" name="product_id[]" data-id="'+countClass+'"><option value="">Select</option><?php foreach($produc as $product){ ?><?php if($product['is_active']==1){ ?>	<option value="<?= $product['id']; ?>"><?= ucfirst($product['product_name']); ?></option><?php } } ?> </select><p class="msg1 errorProduct"></p></td><td><input  class="form-control manufac_'+countClass+'" readonly /></td><td><input type="text" class="form-control mandatory batch_no" name="batch_no[]" autocomplete="off"/><p class="msg1 errorQuant"></p></td><td><div class="dateWrapdate"><input type="text" class="form-control mandatory recurring expiry_date data-id="'+countClass+'" name="expiry_date[]"></div><p class="msg1 errorQuant"></p></td><td><div class="qtyInput"><input type="text" class="form-control quant1 numPack pack_'+countClass+'" name="no_of_pack[]" data-id="'+countClass+'" maxlength="6" autocomplete="off" /><p class="errorQuant msg2"></p></div></td><td><div class="qtyInput"><input type="text" class="form-control quant1 read_'+countClass+'" name="quantity[]" maxlength="10" autocomplete="off"><p class="msg3 errorQuant"></p></div></td><td><input type="text" class="form-control mandatory quant2 unit_price" name="unit_price[]" maxlength="8" autocomplete="off" /><p class="msg1 msg2 errorQuant"></p></td><td><input  class="form-control manufactype_'+countClass+'" readonly /></td><td><input class="form-control locationInput mandatory location" name="location[]" autocomplete="off"><p class="msg1 errorQuant"></p></td><td class="text-center"><a class="addmoreBtn"><b class="sprite minusIcon removelayer"></b></a></td></tr>');
	 
		$(this).closest('table').append(data);
        $(".singleselect").select2();		
        $('.recurring').datetimepicker({ format: 'DD MMM YYYY', minDate: moment() }); 
		}); 
		     
		
		$(document).on('click', '.removelayer', function (e) {	
			$(this).closest('tr').remove();			
			});
			
    
	
	$("body").on("keypress",".quant2",function(event){
     var keycode = event.which;
    if (!(event.shiftKey == false && ((keycode >= 48 && keycode <= 57 )|| (keycode == 46)))) {
        event.preventDefault();
    }
   });
   
   
   /* $("body").on("click","#submit",function(){
	
	$(".mandatory").each(function()
	{
		if($(this).val()=="")
		{
			$(this).next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
			$(this).next().next(".errorClass1").text('Field is required').fadeIn('slow').delay(2500).fadeOut();
		}
	});
	
	if($('.product_id').val()=="" || $('.batch_no').val()=="" || $('.quantity').val()=="" || $('.location').val()=="" || $('.expiry_date').val()=="" || $('.unit_price').val()=="" )
	 {
		//alert();
		return false;
	 }
     
  }); */
 
});
</script>
    <!-- FOOTER -->
	<?php echo $this->element("footer"); ?>
	<!-- FOOTER -->