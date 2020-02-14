<?php
//echo "<pre>"; print_r($inventory); die;
 
            foreach($inventory as $invent){ 
		  $product_id=isset($invent['product_id'])?explode(",",$invent['product_id']):''; 
		  $batch_no=isset($invent['batch_no'])?explode(",",$invent['batch_no']):'';
		  $quantity=isset($invent['quantity'])?explode(",",$invent['quantity']):'';
		  $expiry_date4=isset($invent['expiry_date'])?explode(" ",$invent['expiry_date']):'';
		  $expiry_date1=isset($expiry_date4[0])?explode(",",$expiry_date4[0]):'';		 
		  $expiry_date2=isset($expiry_date4[1])?explode(",",$expiry_date4[1]):'';		 
		  $expiry_date3=isset($expiry_date4[2])?explode(",",$expiry_date4[2]):'';		 
		  $location=isset($invent['location'])?explode(",",$invent['location']):''; 
		   foreach($product_id as $key=>$value){ ?>
            <tr>
              <td>
                <p class="textWrap"><a href="#" class="userName"><?php foreach($produc as $product){ echo $product['id']==$product_id[$key]?$product['product_name']:''; }?></a></p>
              </td>
              <td>Cipla</td>
              <td>
                <p class="textWidth"><?= $batch_no[$key]; ?></p>
              </td>
              <td>
                <p class="textWidth"><?= $expiry_date1[$key]." ".$expiry_date2[$key]." ".$expiry_date3[$key]; ?></p>
              </td>
              <td> <?= $quantity[$key]; ?> </td>
              <td> Strips </td>
              <td><?= $location[$key]; ?></td>
              <td class="text-center"><a href="<?php echo $this->url->build(["controller" => "inventory","action" => "createInventory",$queries['id']]); ?>" class="text-uppercase text-link">Update</a></td>
            </tr>
		  <?php }} ?>