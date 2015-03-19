
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Khempsons</title>
		<style type="text/css">
		a:link {
	color: #333;
	text-decoration: none;
}
        a:visited {
	color: #333;
	text-decoration: none;
}
        a:hover {
	color: #456e08;
	text-decoration: none;
}
        a:active {
	text-decoration: none;
}
        </style>
 <div class="clr"></div>
<script type="text/javascript">
function filter_by(value)
{
	document.getElementById("filter").submit();
}
</script>

 <div id="container_warpper" >

	
    <div class="suplr">

    	<div class="headersuplr_new"><?php echo $sup_details->agency_name?> ' s Properties</div>
        <div class="suplr_table"><br />
        	<table width="100%" style="height:auto; border-collapse: collapse; color:#000;" >
            	<tr bgcolor="#eeeeee" style="height:50px;">
                	<td width="7%"align="left" valign="middle"  style="padding-left:15px; border-bottom:1px solid #dcdcdc;">No</td>
<?php /*?>                    <td width="24%" align="left" valign="middle"  style="padding-left:15px; border-bottom:1px solid #dcdcdc;">Country</td>
<?php */?>                    <td width="16%" align="left" valign="middle"   style="padding-left:15px; border-bottom:1px solid #dcdcdc;">City </td>
                    <td width="22%" align="left" valign="middle"  style="padding-left:15px; border-bottom:1px solid #dcdcdc;">Accommodation Name</td>
                    <td width="10%" align="left" valign="middle"  style="padding-left:15px; border-bottom:1px solid #dcdcdc;">Status</td>
                    <td width="12%" align="left" valign="middle"  style="padding-left:15px; border-bottom:1px solid #dcdcdc;">View Details</td>
                    <td width="14%" align="left" valign="middle"  style="padding-left:15px; border-bottom:1px solid #dcdcdc;">Action</td>
                </tr>
                <?php if(isset($prop)){ if($prop!= '') { 
				$m=1;
     		   foreach ($prop as $row){ 
	  		  ?>
                <tr>
                	<td height="30" style="padding-left:15px; border-bottom:1px solid #dcdcdc;"><?php echo $m; ?></td>
<?php /*?>                    <td  style="border-bottom:1px solid #dcdcdc; padding-left:15px; border-left:1px solid #dcdcdc;"><?php echo $row->name; ?></td>
<?php */?>                    <td  style="border-bottom:1px solid #dcdcdc; padding-left:15px; border-left:1px solid #dcdcdc;"><?php $city = $this->Supplier_Model->get_city($row->city); if($city) { $x = explode(',',$city);echo $x[0]; } else echo $row->city; ?></td>
                    <td  style="border-bottom:1px solid #dcdcdc; padding-left:15px; border-left:1px solid #dcdcdc;"><?php echo $row->apartment_name; ?></td>
                    <td  style="border-bottom:1px solid #dcdcdc; padding-left:15px; border-left:1px solid #dcdcdc;">
					<?php if($row->status == 0){?><a href="<?php echo WEB_URL_ADMIN?>admin/prop_status/<?php echo $row->status?>/<?php echo $row->sup_apart_list_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/prop_status/<?php echo $row->status?>/<?php echo $row->sup_apart_list_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td>
                    <td  style="border-bottom:1px solid #dcdcdc; padding-left:15px; border-left:1px solid #dcdcdc;" class="link_new"><a href="<?php print WEB_URL_ADMIN?>admin/supplier_home/<?php echo $row->sup_apart_list_id; ?>/1/<?php echo $id?>">View</a></td>
                     <td  style="border-bottom:1px solid #dcdcdc; padding-left:15px; border-left:1px solid #dcdcdc;" class="link_new"><a href=<?php print WEB_URL_ADMIN ."admin/delete_prop/".$row->user_id."/".$row->sup_apart_list_id;?> class="add_update_link" onclick="return confirm('Are you sure want to delete this user?')"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" /></a></td>
                </tr>
                <?php $m++;}}}?>
            </table>
        </div>
	</div>







</div>
