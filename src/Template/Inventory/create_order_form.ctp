<header>
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
        <input type="text" class="form-control ordername mandatory" name="order_name" value="<?= isset($data['order_name'])?ucfirst($data['order_name']):''; ?>" id="ordername" autocomplete="off" />
      </div>
      <div class="tablewrap">
        <table id="customerTable" style="width:100%">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Manufacturer</th>
              <th>No. Of Pack</th>
              <th>Type</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr class="incr">
              <td>
                <select class="form-control singleselect mandatory manufacturer product_name" name="product_id[]" id="product_id" 
                </select>
              </td>
             <td> <input class="form-control manufac_1" readonly /></td>			              
              <td><input class="form-control manufactype_1" readonly /> </td>
              <td class="text-center"><a class="addNewLayer addmoreBtn" href="#"><b class="sprite addplusIcon"></b></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#customerTable').DataTable({
			responsive: true,
			info: false,
			paging: false,
			searching: false,
		});
		$(document).on("click", ".menutoggle", function (e) {
			e.preventDefault();
			$(this).toggleClass('active');
			$('header').toggleClass('active');
		});
		$(".singleselect").select2();
		//ADD MORE
		$(document).on('click', '.addNewLayer', function (e) {
			e.preventDefault();
		var data = $('<tr class="incr"> <input type="hidden" class="form-control" name="order_detail_id[]" value=""/><td><select class="form-control singleselect mandatory manufacturer product_name" name="product_id[]" id="product_id" data-id="'+countClass+'"><option value="">Select</option><?php foreach($produc as $product){ ?> <option value="<?= $product['id']; ?>"><?= ucfirst($product['product_name']); ?></option><?php } ?></select><p class="msg1 errorProduct"></p></td><td><input class="form-control manufac_'+countClass+'" readonly /></td><td><div class="qtyInput"> <input type="text" class="form-control quant2 numPack pack_'+countClass+'" name="num_of_pack[]" data-id="'+countClass+'" autocomplete="off" /><p class="errorQuant msg2"></p></div></td><td><div class="qtyInput"><input type="text" class="form-control qtyInput quant2 read_'+countClass+'" name="quantity_ordered[]" id="quantity_ordered" autocomplete="off"/><p class="errorQuant msg2"></p></div></td><td><input class="form-control manufactype_'+countClass+'" readonly /></td><td class="text-center"><a class="addmoreBtn"><b class="sprite minusIcon removelayer"></b></a></td></tr>');
		$(this).closest('table').append(data);
		});
	});
</script>