
<?php
//echo "<pre>"; print_r($list); die;

 foreach($list as $lists){ ?>
            <tr>
              <td><a href="javascript:void(0);" class="userName"><?php echo $lists['fname']; ?></a></td>
              <td><?php echo $lists['dob']; ?></td>
              <td><?php echo $lists['email']; ?></td>
              <td><?php echo $lists['m_number']; ?></td>
              <td>
              <div class="usermoreOpction"><a href="<?php echo $this->url->build(["controller" => "patient","action" => "patients_details",$lists['id']]); ?>" >View Details</a> 
				</div>
              </td>
            </tr>
			 <?php } ?>