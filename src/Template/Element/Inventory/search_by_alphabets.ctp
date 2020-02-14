
<?php
//echo "<pre>"; print_r($manufacturers); die;

 foreach($products as $product){ ?>
            <?php if($product['is_active']==1){ ?><tr>
              <td><?=  ucfirst($product['product_name']); ?></a></td>
			  
              <td><?php foreach($manufact as $manuf){ if($manuf['id']==$product['manufacturer_id']){ echo  ucfirst($manuf['manufacturer_name']); } } ?></td>
			  
              <td><?php foreach($product_type as $product_t){ if($product_t['id']==$product['product_type_id']){ echo  ucfirst($product_t['product_type_name']); } } ?></td>
			  
             <td><?= $product['qty_in_pack'];?></td>
             <td><?php foreach($product_dosages as $product_dos){ if($product_dos['id']==$product['product_dosage_id']){ echo  ucfirst($product_dos['dosages_type']); } } ?></td>
						
			<td><?= $product['qty_alert'];?></td>
			<td class="text-center actionLinks"><a href="" class="text-uppercase" data-toggle="modal" data-target="#newProductModal<?= isset($product['id'])?$product['id']:''; ?>">Edit</a> | <!--<a href="#" class="text-uppercase" data-toggle="modal" data-target="#confirmationModal<?= isset($product['id'])?$product['id']:''; ?>">Enable</a>--><a href="#" class="text-uppercase" data-toggle="modal" data-target="#disableProductModal<?= isset($product['id'])?$product['id']:''; ?>">Disable</a></td>
            </tr>
			<?php } } ?>