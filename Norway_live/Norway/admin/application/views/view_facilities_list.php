<?php $this->load->view('header');?>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>js/sorting.js"></script>
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Travelingmart</title>
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
   <script type="text/javascript">
  function abc1()
  {
  //	alert('anand');
  $('#add_comm').show();
  $('#view_comm').hide();
  $('#edit_comm').hide();
   $('#page').hide();
  }
  function xyz()
  {
  //	alert('anand');
  $('#add_comm').hide();
  $('#view_comm').show();
  $('#edit_comm').hide();
    $('#page').show();
  }
  function edit(str,cards)
  {
  $('#edit_comm').show();
  $('#add_comm').hide();
  $('#view_comm').hide();
   $("#card_id").val(str);
  $("#edit_card").val(cards);
   $('#page').hide();
<?php /*?>  	<?php print WEB_URL_ADMIN ."admin/edit_cardaccept_list/".$row->sup_apart_cardaccept_list_id;?><?php */?>
  }
  </script>
  <style>
table.sortable thead {
    background-color:#eee;
    color:#FFFFFF;
    font-weight: bold;
    cursor: default;
}

</style>
 <div id="container_warpper" style="padding-bottom:50px;" >
<div class="left_menu_sub">
		<ul>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_suppliers">View Suppliers</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/cardaccept_list">Cards Accepted List</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/facilities_list"  class="active">Facilities List</a></li>
            <li><a href="<?php echo WEB_URL_ADMIN?>admin/roomfacilities_list">Unit Facilities List</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/timezone_list">Timezone List</a></li>
			<li style="border:none;"><a href="<?php echo WEB_URL_ADMIN?>admin/apartclass_type">Class Type List</a></li>
		</ul>
	</div>
    <div class="right-wrapper">
 <div style="width:790px; height:20px; margin-left:10px; margin-top:20px;">
  <span style="color:#000; background:#EFA146; width:150px; float:left; border-right:1px solid #fff; text-align:center; cursor:pointer;" onclick="return xyz();">View Facilities</span>&nbsp;<span style="color:#000; background:#EFA146; width:150px; float:right; text-align:center; cursor:pointer;" onclick="return abc1();">Add Facility</span>  </div>
 <table width="790" border="0" align="left" cellpadding="0" cellspacing="0" class="sortable" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:0px 0 5px 10px;" id="view_comm">
     <thead>
<tr style="background-color:#333333; height:30px;">
	
       
<th width="173" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Facility</b></th> 
<th width="169" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Edit</b></th>
	<th width="298" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Status</b></th>
	<th width="298" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Front end display</b></th>
	<th width="338" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></th>
	
    </tr>
    </thead>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($users)){ if($users!= '') { ?>
     
      <?php 
	   foreach ($users as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; " id="row<?php echo $row->sup_apart_facilities_list_id?>">
	
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	   <span id="new_change<?php echo $row->sup_apart_facilities_list_id?>">
	   <?php if($row->booking_type_fac_id!='0') {?><b><?php echo $row->facilities;?></b><?php }else{?><?php echo $row->facilities;?><?php }?>
       </span></td>
	 
       <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	  <img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit" onclick="return edit('<?php echo $row->sup_apart_facilities_list_id;?>','<?php echo $row->facilities;?>');"/></td> 
		
		
	<?php /*?><td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->status==0){?><a href="<?php echo WEB_URL_ADMIN?>admin/facility_status/<?php echo $row->status?>/<?php echo $row->sup_apart_facilities_list_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/facility_status/<?php echo $row->status?>/<?php echo $row->sup_apart_facilities_list_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td><?php */?>
    
    
     <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; cursor:pointer;"><span id="status_sor" style="display:none;"><?php echo $row->status ?></span><?php if($row->status==0){?>
  
    <span id="deactive<?php echo $row->sup_apart_facilities_list_id?>">
    <img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20" onclick="return abc('<?php echo $row->status?>','<?php echo $row->sup_apart_facilities_list_id?>')">
    </span>
	
	<?php }else{?>
  
    <span id="deactive<?php echo $row->sup_apart_facilities_list_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20" onclick="return abc('<?php echo $row->status?>','<?php echo $row->sup_apart_facilities_list_id?>')"></span>
	
	<?php }?></td>
    
	
		<?php /*?><td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->front_status==0){?><a href="<?php echo WEB_URL_ADMIN?>admin/frtfacility_status/<?php echo $row->front_status?>/<?php echo $row->sup_apart_facilities_list_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/frtfacility_status/<?php echo $row->front_status?>/<?php echo $row->sup_apart_facilities_list_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td> <?php */?>
        
        
        
        
           <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; cursor:pointer; "><span id="frnt_status_sor" style="display:none;"><?php echo $row->front_status ?></span>
		   <?php if($row->front_status==0){?>
        <span id="deactive_frnt<?php echo $row->sup_apart_facilities_list_id?>">
        <img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20" onclick="return frnt('<?php echo $row->front_status?>','<?php echo $row->sup_apart_facilities_list_id?>')">
		</span>
		<?php }else{?>
        <span id="deactive_frnt<?php echo $row->sup_apart_facilities_list_id?>">
        <img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20" onclick="return frnt('<?php echo $row->front_status?>','<?php echo $row->sup_apart_facilities_list_id?>')">
		</span>
		<?php }?></td> 
        
        
		
		<?php /*?><td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."admin/delete_facility/".$row->sup_apart_facilities_list_id;?> class="add_update_link" onclick="return confirm('Are you sure want to delete this user?')"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" /></a></td> <?php */?>
        
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333;cursor:pointer; "><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" onclick="delete_cls('<?php echo $row->sup_apart_facilities_list_id;?>')" /></td> 
    </tr>
          <?php
	  }}}else{ echo "No records found";}?>  <?php 
	  ?>
  
</table>
<table style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;  margin:0px 0 0px 8px;" id="page">
 <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr>
</table>
<form name="form1" id="add_comm" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/add_facility_list" method="post">
	<input name="services" value="" class="user_fld_box-fld-2" type="hidden" />
<div style="border:1px #ccc solid; margin-left:10px;" >
 <table style="width:600px; padding:15px;">
  <tr>
	<td>Facility</td>
	<td><input type="card" name="card" id="value"/></td></tr>
    <tr><td height="10"></td></tr>
	
	<td>
	 </td>
	<td> <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22">
	<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="22" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
    </td>
	</tr>
  </table>
  </div>
</form>
<?php /*?><form name="form1" id="edit_comm" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/update_facility_list" method="post"><?php */?>
	<input name="card_id" id="card_id" value="" type="hidden" />
    <div style="border:1px #ccc solid; margin-left:10px; display:none;" id="edit_comm"  >
  <table style="width:600px; padding:15px;">
  <tr>
	<td>Edit Facility</td>
	<td><input type="text" name="edit_card" id="edit_card" value=""/></td></tr>
    <tr><td height="10"></td></tr>
	<tr>
	<td></td>
	<td><input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22" onclick="return update_fac();">
	<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="22" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
    </td>
	</tr>
  </table>
  </div>
<?php /*?></form><?php */?>
</div>
</div>
<?php $this->load->view('footer');?>

<script type="text/javascript">
function abc(status,id)
{
	$.post("<?php echo WEB_URL_ADMIN?>admin/facility_status",{'status':status,'id':id},function(data){
			if(status == 1)
			{
				$('#deactive'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate "width="20" height="20" onclick="return abc(0,'+id+')">');
			}
			else
			{
				$('#deactive'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate "width="20" height="20" onclick="return abc(1,'+id+')">');
			}
	});
}
function frnt(status,id)
{
	$.post("<?php echo WEB_URL_ADMIN?>admin/frtfacility_status",{'status':status,'id':id},function(data){
			if(status == 1)
			{
				$('#deactive_frnt'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate "width="20" height="20" onclick="return frnt(0,'+id+')">');
			}
			else
			{
				$('#deactive_frnt'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate "width="20" height="20" onclick="return frnt(1,'+id+')">');
			}
	});
}
function delete_cls(id)
{
	if(confirm('Are you sure want to delete this facility type?'))
	{
		$.post("<?php echo WEB_URL_ADMIN?>admin/delete_facility",{'id':id},function(data){
			$('#row'+id).remove();
		});
	}
}
function update_fac()
{
	var card_id = $('#card_id').val();
	var edit_card = $('#edit_card').val();
	//alert(edit_card);return false
	$.post("<?php echo WEB_URL_ADMIN?>admin/update_facility_list",{'edit_card':edit_card,'card_id':card_id},function(data){
		$('#view_comm').show();
		$('#edit_comm').hide();
		$('#new_change'+card_id).html(edit_card);
	});
}
function status()
{
	//alert('anand');
}
</script>
