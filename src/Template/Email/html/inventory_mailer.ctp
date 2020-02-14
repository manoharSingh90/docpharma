<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
<title>DocPharmRx</title>
</head>

<body>
<table width="100%" bgcolor="#efefef" border="0" cellpadding="0" cellspacing="0" style="border:0; border-collapse:collapse; margin:0; padding:0;">
  <tr>
    <td height="20"></td>
  </tr>
  <tr>
    <td><table width="680" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" align="center" style="border:0; border-collapse:collapse; margin:0 auto; padding:0; box-shadow:0 0 6px rgba(0,0,0,0.04);">
        <tr>
          <td height="25"></td>
        </tr>
        <tr>
          <td align="center"><img src="cid:12345" width="215" height="40" alt="logo" style="border:0; display:block; margin:0;"/></td>
        </tr>
        <tr>
          <td height="35"></td>
        </tr>
        <tr>
          <td colspan="3"><table width="94%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" align="center" style="border:0; border-collapse:collapse; margin:0 auto; padding:0;">
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#474747;"><strong>Dear username<span></span>,</strong></td>
              </tr>
              <tr>
                <td height="20"></td>
              </tr>
                <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#999;"><strong style="color:#555;font-size:16px; "><?= ucfirst($frmdta['order_name']); ?></strong> | <small class="updatedDate">Last Updated: <?php $lst_date = date_create($frmdta['order_date']); echo $lst_updt = date_format($lst_date,"d F Y"); ?></small></td>
              </tr>
               <tr>
                <td height="15"></td>
              </tr>
              <tr>
                <td><table width="100%" bgcolor="#ffffff" border="0" cellpadding="8" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#555;">
                    <thead>
                      <tr align="left" bgcolor="#dddddd" style="font-size:12px; color:#aaa; text-transform:uppercase;">
                        <th style="font-weight:normal">Sr. No.</th>
                        <th style="font-weight:normal">Product Name</th>
                        <th style="font-weight:normal">Manufacturer Name</th>
                        <th style="font-weight:normal">No. Of Pack</th>
                        <th style="font-weight:normal">Total Quantity</th>
                        <th style="font-weight:normal">Type</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $n=1; 
					  foreach($prod as $key=>$value){  ?>
                      <tr>
                        <td><?= $n; ?></td>
                        <td><?= $value['product_name']; ?></td>
                        <td><?= $value['manufacturer_name']; ?></td>
                        <td><?= $value['num_of_pack']; ?></td>
                        <td><?= $value['quantity_ordered']; ?></td>
                        <td><?= $value['dosages_type']; ?></td>
                      </tr>
                      <?php $n++; } ?>
                    </tbody>
                  </table></td>
              </tr>
              <tr>
                <td colspan="3" height="35"></td>
              </tr>
              <tr>
                <td colspan="3"><hr style="border:1px solid #eee;"/></td>
              </tr>

              <tr>
                <td colspan="3" height="10"></td>
              </tr>
              <tr>
                <td colspan="3" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#999; border-radius:0 0 10px 10px;">&copy; 2019, docpharmrx.  All Rights Reserved. </td>
              </tr>
              <tr>
                <td colspan="3" height="10"></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="3" height="15"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="25"></td>
  </tr>
  <tr>
    <td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#a2a2a2;">For any queries, please <a href="#" style="color: #2488f8; text-decoration: none;">get in touch</a> with us.</td>
  </tr>
  <tr>
    <td height="20"></td>
  </tr>
</table>
   
</body>

</html>