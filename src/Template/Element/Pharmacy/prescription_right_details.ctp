<div class="combgcolor">
	<div class="sameHeadAfter">BILLING DETAILS</div>
	<div class="itemsell">
		
		<p>(<?php echo isset($savedPrescription) ? count($savedPrescription) : 0; ?>) Item in the cart</p>
		<?php
		$totalCost=0;
		if(isset($savedPrescription) && count($savedPrescription)!=0) {
		foreach($savedPrescription as $key => $value) { $totalCost = $totalCost+$value["unit_price_total"]; ?>
		<div class="repeatbilling prescriptionDiv_<?php echo $value["id"]; ?>">
			<div class="itemsellslt clearfix">
				<div class="pull-left medicianWrap">
					<b class="sprite deleteIcon" data-toggle="modal" data-target="#deleteModal_<?php echo $value["id"]; ?>"></b> <small>1</small> <span><?php echo $value["product_name"]; ?></span>
					<p><?php echo $value["total_qty"]." ".$value["product_type"]; ?></p>
					<?php
					if(isset($value["inventory"]) && !empty($value["inventory"])) {
					foreach($value["inventory"] as $inventoryKey => $inventoryValue) { ?>
					<p>* <?php echo $inventoryValue["batch_no"]." (".$inventoryValue["quantity"].") - ".$inventoryValue["expiry_date"]; ?></p>
					<?php } } ?>
				</div>
				<div class="pull-right editPrice text-right"> <b>INR	<a class="singleProductPrice"><?php echo $value["unit_price_total"]; ?></a></b> <span class="edit" id="<?php echo $value["id"]; ?>">Edit</span> </div>
			</div>

			<div class="itemsellFooter">
				<div class="customcheckbox">
					<label>
					<input type="checkbox">
					<b></b><span>MDS (QTY: 2)</span></label>
				</div>
				<div class="customcheckbox">
					<label>
					<input type="checkbox">
					<b></b><span>PRINT LABEL</span></label>
				</div>
			</div>
		</div>
		
		<!---- DELETE POPUP  ------>
		<div id="deleteModal_<?php echo $value["id"]; ?>" class="modal fade" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header text-center">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Delete confirm</h4> </div>
					<div class="modal-body">
						<div class="deletecontent text-center"> Are you sure want to delete this. </div>
					</div>
					<div class="modal-footer">
						<div class="centerAlign"> 
						<a href="javascript:void(0);" class="defaultBtn" data-dismiss="modal">Cancel</a> 
						<a href="javascript:void(0);" class="defaultBtn belu deletePrescription" id="<?php echo $value["id"]; ?>">Yes</a> </div>
					</div>
				</div>
			</div>
		</div>
		
		<?php } } ?>
	
		<hr/>

		<div class="totalcost row">
			<div class="col-lg-8 col-md-8 col-sm-7 col-xs-7">
				<h4>TOTAL COST</h4>
				<span class="totalDetail">MDS Charges</span> <span class="totalDetail">GST</span> <span class="totalDetail">Delivery Charges</span>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 alignright">
				<h4=>INR <a class="totalProductPrice"><?php echo isset($totalCost) ? $totalCost : ""; ?></a></h4>
				<span class="totalDetail">0</span> <span class="totalDetail">0</span> <span class="totalDetail">0</span>
			</div>
		</div>

		<div class="totalsave clearfix">
			<!--<div class="itemsellFooter">
				<div class="customcheckbox">
					<label>
					<input type="checkbox">
					<b></b><span>LABEL</span></label>
				</div>
				<div class="customcheckbox">
					<label>
					<input type="checkbox">
					<b></b><span>ENABLE LARGE FONT</span></label>
				</div>
				<div class="customcheckbox">
					<label>
					<input type="checkbox">
					<b></b><span>Print MAR</span></label>
				</div>
			</div>-->
			<div class="centerAlign">
				<?php if(isset($prescriptionID) && !empty($prescriptionID)) { ?>
				<a href="<?php echo $this->Url->build(["controller"=>"Pharmacy","action"=>"listing"]); ?>" class="btn btn-blue">SAVE</a>
				<a href="<?php echo $this->Url->build(["controller"=>"Pharmacy","action"=>"printdata",$prescriptionID]); ?>" class="btn btn-blue" target="_blank">PRINT</a>
				<?php }
				else { ?>
				<a href="javascript:void(0);" class="btn btn-blue">SAVE</a>
				<a href="javascript:void(0);" class="btn btn-blue">PRINT</a>
				<?php } ?>
			</div>
		</div>
	</div>

</div>