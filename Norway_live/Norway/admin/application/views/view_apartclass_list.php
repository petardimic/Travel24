<?php $this->load->view('header');?>
<script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>js/sorting.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
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
     <style>
table.sortable thead {
    background-color:#eee;
    color:#FFFFFF;
    font-weight: bold;
    cursor: default;
}

</style>
    <style>
table.sortable thead {
    background-color:#eee;
    color:#FFFFFF;
    font-weight: bold;
    cursor: default;
}

</style>
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
    $('#page').hide();
  $("#edit_card").val(cards);
<?php /*?>  	<?php print WEB_URL_ADMIN ."admin/edit_cardaccept_list/".$row->sup_apart_cardaccept_list_id;?><?php */?>
  }
  </script>
 <div id="container_warpper" style="padding-bottom:50px;" >
<div class="left_menu_sub">
		<ul>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_suppliers">View Suppliers</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/cardaccept_list">Cards Accepted List</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/facilities_list">Facilities List</a></li>
            <li><a href="<?php echo WEB_URL_ADMIN?>admin/roomfacilities_list">Unit Facilities List</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/timezone_list">Timezone List</a></li>
			<li style="border:none;"><a href="<?php echo WEB_URL_ADMIN?>admin/apartclass_type"  class="active">Class Type List</a></li>
		</ul>
	</div>
    <div class="right-wrapper">
    
    <?php /*?> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/a">A</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/b">B</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/c">C</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/d">D</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/e">E</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/f">F</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/g">G</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/h">H</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/i">I</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/j">J</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/k">K</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/l">L</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/m">M</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/n">N</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/o">O</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/p">P</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/q">Q</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/r">R</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/s">S</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/t">T</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/u">U</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/v">V</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/w">W</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/x">X</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/y">Y</a> <a href="<?php echo WEB_URL_ADMIN?>admin/class_filter/z">Z</a><?php */?>
    
 <div style="width:790px; height:20px; margin-left:10px; margin-top:20px;">
  <span style="color:#000; background:#EFA146; width:150px; float:left; text-align:center; cursor:pointer; border-right:1px solid #fff;" onclick="return xyz();">View Class Type</span>
  
  <span style="color:#000; background:#EFA146; width:150px; float:right; text-align:center; cursor:pointer;" onclick="return abc1();">Add Class Type</span> 
  </div>
 <table width="790" border="0" align="left" cellpadding="0" cellspacing="0" class="sortable" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:0px 0 5px 10px;" id="view_comm">
   <thead>
<tr style="background-color:#333; height:30px;">

<td width="371" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Property Class</b></td> 
<td width="66" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Edit</b></td>
	<td width="125" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Status</b></td>
	<td width="125" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Front end display</b></td>
	<td width="80" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></td>
	
    </tr>
    </thead>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($users)){ if($users!= '') { ?>
     
      <?php 
	   foreach ($users as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; " id="row<?php echo $row->sup_apartclass_type_id;?>">
		 <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	<span id="new_change<?php echo $row->sup_apartclass_type_id?>">
	
			<?php if($row->booking_type_id_new!=0) { ?><b><?php echo $row->apartclass;?></b><?php } else { ?> <?php echo $row->apartclass; ?><?php } ?>
            </span></td>
	
       <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	  <img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit" onclick="return edit('<?php echo $row->sup_apartclass_type_id;?>','<?php echo $row->apartclass;?>');"/></td> 
		
		
	<?php /*?><td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->status==0){?><a href="<?php echo WEB_URL_ADMIN?>admin/room_apartclass_type_status/<?php echo $row->status?>/<?php echo $row->sup_apartclass_type_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/room_apartclass_type_status/<?php echo $row->status?>/<?php echo $row->sup_apartclass_type_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td><?php */?> 
	
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; cursor:pointer;"><?php if($row->status==0){?>
    <span id="deactive<?php echo $row->sup_apartclass_type_id?>">
    <img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20" onclick="return abc('<?php echo $row->status?>','<?php echo $row->sup_apartclass_type_id?>')">
    </span>
	
	<?php }else{?>
    
    <span id="deactive<?php echo $row->sup_apartclass_type_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20" onclick="return abc('<?php echo $row->status?>','<?php echo $row->sup_apartclass_type_id?>')"></span>
	
	<?php }?></td>
    
    
    
    
	<?php /*?><td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->front_status==0){?><a href="<?php echo WEB_URL_ADMIN?>admin/frontroom_apartclass_type_status/<?php echo $row->front_status?>/<?php echo $row->sup_apartclass_type_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/frontroom_apartclass_type_status/<?php echo $row->front_status?>/<?php echo $row->sup_apartclass_type_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td> <?php */?>
		
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; cursor:pointer; ">
        <span id="status_sor" style="display:none;"><?php echo $row->status ?></span>
		<?php if($row->front_status==0){?>
        <span id="deactive_frnt<?php echo $row->sup_apartclass_type_id?>">
        <img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20" onclick="return frnt('<?php echo $row->front_status?>','<?php echo $row->sup_apartclass_type_id?>')">
		</span>
		<?php }else{?>
        <span id="deactive_frnt<?php echo $row->sup_apartclass_type_id?>">
        <img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20" onclick="return frnt('<?php echo $row->front_status?>','<?php echo $row->sup_apartclass_type_id?>')">
		</span>
		<?php }?></td> 
        
        
        
        
		<?php /*?><td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."admin/delete_apartclass_type/".$row->sup_apartclass_type_id;?> class="add_update_link" onclick="return confirm('Are you sure want to delete this user?')"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" /></a></td> <?php */?>
        
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333;cursor:pointer; "><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" onclick="delete_cls('<?php echo $row->sup_apartclass_type_id;?>')" /></td> 
        
        
   </tr>
           <?php
	  }}}else{ echo "No records found";}?>  <?php 
	  ?>
  
</table>
<table style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;  margin:0px 0 0px 8px;" id="page">
 <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr>
</table>
<form name="form1" id="add_comm" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/add_apartclass_type" method="post">
	<input name="services" value="" class="user_fld_box-fld-2" type="hidden" />
   <div style="border:1px #ccc solid; margin-left:10px;" >
  <table style="width:600px; padding:15px;">
  <tr>
	<td>Apart class</td>
	<td><input type="card" name="card" id="value"/></td></tr>
    <tr><td height="10"></td></tr>
	
	<td>
	  </td>
	<td><input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22">
	<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="22" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
    </td>
	</tr>
  </table>
  </div>
</form>
<?php /*?><form name="form1" id="edit_comm" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/update_apartclass_type" method="post"><?php */?>
	<input name="card_id" id="card_id" value="" type="hidden" />
   <div style="border:1px #ccc solid; margin-left:10px; display:none;" id="edit_comm" >
  <table style="width:600px; padding:15px;">
  <tr>
	<td>Edit Apart class</td>
	<td><input type="text" name="edit_card" id="edit_card" value=""/></td></tr>
    <tr><td height="10"></td></tr>
	
	<td>
	 </td>
	<td> <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22" onclick="return update_fac();">
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
	$.post("<?php echo WEB_URL_ADMIN?>admin/room_apartclass_type_status",{'status':status,'id':id},function(data){
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
	$.post("<?php echo WEB_URL_ADMIN?>admin/frontroom_apartclass_type_status",{'status':status,'id':id},function(data){
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
	if(confirm('Are you sure want to delete this class type?'))
	{
		$.post("<?php echo WEB_URL_ADMIN?>admin/delete_apartclass_type",{'id':id},function(data){
			$('#row'+id).remove();
		});
	}
}
function update_fac()
{
	var card_id = $('#card_id').val();
	var edit_card = $('#edit_card').val();
	$.post("<?php echo WEB_URL_ADMIN?>admin/update_apartclass_type",{'edit_card':edit_card,'card_id':card_id},function(data){
		$('#view_comm').show();
		$('#edit_comm').hide();
		$('#new_change'+card_id).html(edit_card);
		/*$('#image_id'+card_id).html('<img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit"
		 onclick="return edit('10','asdfasdf');"/>');*/
	});
}
</script>