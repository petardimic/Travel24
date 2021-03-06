
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Voucher </title>

	<link rel="shortcut icon" href="<?php echo WEB_DIR ?>images/fav_icon.ico" />
<link href="<?php echo WEB_DIR?>css/voucher.css" rel="stylesheet" type="text/css" />

<style>
.logotext
{
	width:280px;
	height:20px;
	float:left;
	font-family:Arial, Helvetica, sans-serif;
	font-size:36px;
	color:#ffa500;
	margin-top:15px;
	/*text-align:center;*/
}
.logotext a
{
	width:280px;
	height:20px;
	float:left;
	font-family:Arial, Helvetica, sans-serif;
	font-size:36px;
	color:#ffa500;
	margin-top:15px;
	text-decoration:none;
	/*text-align:center;*/
}</style>
 
	

</head>

<body ><!--header-->

<div style="float:left; height:auto; width:100%;"><!--content-->
<div style="margin:auto; height:auto; width:800px;">
<div class="content" style="width:800px; padding-bottom:10px;">
<?php //if(isset($etour_voucher) && $etour_voucher=='etour'){ ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-44759003-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<table border="0" cellpadding="0" cellspacing="0" width="800" style="font-size:13px; border:1px #dcdbdb solid; font-family:Arial, Helvetica, sans-serif; font-weight:normal;" >
    <tbody>
     
      <tr>
        <th align="left" style="color:#FFF; padding-left:15px; font-weight:bold; font-size:16px; font-family:Arial, Helvetica, sans-serif;" ><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="middle">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="middle"><span style="font-family:Arial, Helvetica, sans-serif; font-size:30px; color:#000; font-weight:bold;">Hotel Booking <span style="font-size:16px;">Voucher</span></span></td>
            <td width="200" align="right" valign="top"> <a href="<?php print WEB_URL ?>home/index"><img src="<?php print WEB_DIR_ADMIN ?>images/logo_new.png" border="0" /></a>  <?php /*?><img src="<?php echo WEB_DIR?>images/logo.jpg" width="328" height="53" border="0" /><?php */?>&nbsp;</td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th height="10" align="left" bgcolor="#E6E6E6" ></th>
      </tr>
      <tr>
        <th height="30" align="right" style="color:#FFF; padding-left:15px; font-weight:bold; font-size:16px; font-family:Arial, Helvetica, sans-serif;" ><a href="<?php echo WEB_DIR?>images/print.png"  onclick="javascript:window.print();"></a>&nbsp;&nbsp;</th>
      </tr>
      <tr>
        <th align="left" class="firststylehead1"><table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" style="font-size:13px;  font-family:Arial, Helvetica, sans-serif; font-weight:normal;" >
          <tbody>
            
            <tr>
              <th align="left" style="font-weight:normal; color:#333; font-size:12px;">Booking ID</th>
              <th align="left" >:</th>
              <th align="left" ><?php echo $hotel->ProcessId;?></th>
              <th align="left" valign="middle" style="font-weight:normal; color:#333; font-size:12px;">Room Type</th>
              <th align="left" valign="middle"  >:</th>
              <th align="left" valign="middle"  ><?php echo $hotel->room_type?></span></th>
              </tr>
            <tr>
              <th align="left" style="font-weight:normal; color:#333; font-size:12px;">Hotel Name</th>
              <th align="left" >:</th>
              <th align="left" ><?php echo $hotel->hotelname?></th>
              <th align="left" valign="middle" style="font-weight:normal; color:#333; font-size:12px;">Check in Date</th>
              <th align="left" valign="middle"  >:</th>
              <th align="left" valign="middle"  ><?php echo $hotel->check_in?></span></th>
              </tr>
            <tr>
              <th width="200" align="left" style="font-weight:normal; color:#333; font-size:12px;">Destination</th>
              <th width="5" align="left" >:</th>
              <th width="250" align="left" ><?php echo $hotel->city?></th>
              <th width="150" align="left" valign="middle" style="font-weight:normal; color:#333; font-size:12px;">Check Out Date</th>
              <th width="5" align="left" valign="middle"  >:</th>
              <th align="left" valign="middle"  ><?php echo $hotel->check_out?></span></th>
            </tr>
            <?php $status = $hotel->status;
					if($status == 'C')
					{
						$status = 'Confirm';
					}
					elseif($status == 'RQ')
					{
						$status = 'Request- Status is not final';
					}
					elseif($status == 'RX')
					{
						$status = 'Request Cancel';
					}
					elseif($status == 'X')
					{
						$status = 'Cancel';
					}
					elseif($status == 'RJ')
					{
						$status = 'Reject';
					}
					elseif($status == 'VCH')
					{
						$status = 'Voucher Issued';
					}
					elseif($status == 'VRQ')
					{
						$status = 'Voucher Request';
					}?>
            <tr>
              <th rowspan="" align="left" valign="top" style="font-weight:normal; color:#333; font-size:12px;">Booking Status</th>
              <th rowspan="" align="left" valign="top"  >:</th>
              <th rowspan="" align="left" valign="top"  ><?php echo $status?></th>
              <th align="left" valign="middle" style="font-weight:normal; color:#333; font-size:12px;">Rooms</th>
              <th align="left" valign="middle"  >:</th>
              <th align="left" valign="middle" >1</span></th>
            </tr>
            <tr>
			 <th rowspan="" align="left" valign="top" style="font-weight:normal; color:#333; font-size:12px;">Cancellation Till Date</th>
              <th rowspan="" align="left" valign="top"  >:</th>
              <th rowspan="" align="left" valign="top"  ><?php echo $hotel->cancel_tilldate?></th>
              <th align="left" valign="middle"style="font-weight:normal; color:#333; font-size:12px;" >Supplier Reference Number</th>
              <th align="left" valign="middle"  >:</th>
              <th align="left" valign="middle"  ><?php echo $hotel->itemcode; ?> </th>
            </tr>
            
             <tr>
			 <th rowspan="" align="left" valign="top" style="font-weight:normal; color:#333; font-size:12px;">Booked and Payable By</th>
              <th rowspan="" align="left" valign="top"  >:</th>
              <th rowspan="" align="left" valign="top"  ><?php echo $hotel->bankName?></th>
              <th align="left" valign="middle"style="font-weight:normal; color:#333; font-size:12px;" >Remark</th>
              <th align="left" valign="middle"  >:</th>
              <th align="left" valign="middle"  ><?php echo $hotel->remark; ?> </th>
            </tr>
           
           
            <tr>
              <th colspan="6" align="left" >&nbsp;</th>
            </tr>
            <tr>
              <th colspan="8" align="left" bgcolor="#E6E6E6" class="firststylehead">Guest Information :</th>
            </tr>
            <tr>
              <th colspan="8" align="left" class="firststylehead1" style="padding-top:10px; padding-bottom:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td width="170" align="center"><strong>Name</strong></td>
                  <td align="center"><strong>Email Id</strong></td>
                </tr>
                
                <tr>
                  <td align="center"><span style="font-weight:normal; color:#333; font-size:12px;"><?php echo $hotel->name1; ?></span></td>
                  <td align="center"><span style="font-weight:normal; color:#333; font-size:12px;"><?php echo $hotel->email; ?></span></td>
                </tr>
              </table></th>
            </tr>
            
             <tr>
              <th colspan="8" align="left" bgcolor="#E6E6E6" class="firststylehead">Cancellation Policy:</th>
            </tr>
             <tr>
                  <td colspan="8">Cancelation Till Date : <?php echo $hotel->cancel_tilldate?></td>
                  
                </tr>
            
            
            
            
          </tbody>
        </table></th>
      </tr>
      
    </tbody>
  </table>

<?php //}else{ ?>
 
</div>

</div>

</div>




</body>
</html>
