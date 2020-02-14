
<?php
//echo "<pre>"; print_r($list); die;

 foreach($list as $lists){ $li2=explode(',',$lists['email']); $li3=explode(',',$lists['m_number']);?>
            <tr>
              <td><a href="javascript:void(0);" class="userName">
			  <?= $lists['fname'].' '.$lists['mname'].' '.$lists['lname'] ?></a></td>
              <td><?php echo $lists['dob']; ?></td>
              <td><?php echo $li2[0]; ?></td>
              <td><?php echo $li3[0]; ?></td>
              <td>
              <div class="usermoreOpction"><a href="<?php echo $this->Url->build(["controller" => "patient","action" => "patients_details",$lists['id']]); ?>" >View Details</a> 
				</div>
              </td>
            </tr>
			 <?php } ?>