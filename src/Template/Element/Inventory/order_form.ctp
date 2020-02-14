
<?php
//echo "<pre>"; print_r($manufacturers); die;

 foreach($order_form as $orderFrm){ 
 $lst_date = date_create($orderFrm['modified_dttm']);
 $lst_updt = date_format($lst_date,"d M Y"); ?>
            <tr>
              <td><a href="#" class="userName"><?= ucfirst($orderFrm['order_name']); ?></a> </td>
              <td>2<?php //foreach($productData as $key=>$quant){ if($orderFrm['id']==$quant['orderFormID']) { 
			   //$quant['orderFormID']; } } ?> </td>
              <td> <p class="textWidth"><?= $lst_updt; ?></p> </td>
              <td class="text-center">
              <div class="orderLinks"><a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" =>"viewOrderForm",$orderFrm['id']]); ?>" class="text-uppercase text-link">View</a>
				| <a href="<?php echo $this->Url->build(["controller" =>"Inventory","action" =>"printSheet",$orderFrm['slug']]); ?>" class="text-uppercase text-dark" target="_blank"><i class="sprite printIcon"></i></a>
				| <a href="#" class="text-uppercase text-dark" data-toggle="modal" data-target="#sendemailModal<?= $orderFrm['id']; ?>"><i class="sprite emailIcon"></i></a>
				|<a class="text-uppercase" data-toggle="modal" data-target="#confirmationModal<?= $orderFrm['id']; ?>"><i class="sprite deleteIcon"></i></a> </div>
              </td>
            </tr>
			<?php } ?>