 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php print WEB_DIR; ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR; ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title><?php StayServiced - Administation?></title>
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
function abc1()
{
	$('#add_comm').show();
	$('#cities').hide();
	$('#add_dest').hide();
	$('#add_heading').show();
	$('#view_heading').hide();
	 $('#page').hide();
}
 function edit(id,city_value,tite,image,order,image_t,edit_text,edit_page_t,edit_meta,edit_metakeyword)
  { //alert(edit_page_t);
  $('#add_dest').hide();
  $('#cities').hide();
   $("#edit_id").val(id);
  $("#edit_city").val(city_value);
  $('#edit_title').val(tite);
 $('#edit_image_del').val(image);
  $('#edit_image_view').html('<img src="<?php echo WEB_DIR_ADMIN?>uploadimage/'+image+'" "width="40" height="50" >');
  $('#edit_order').val(order);
  $('#image_t').val(image_t);
   $('#edit_text').val(edit_text);
   $('#edit_page_t').val(edit_page_t);
   $('#edit_meta').val(edit_meta);
   $('#edit_metakeyword').val(edit_metakeyword);
  $('#edit_comm').show();
  	$('#view_heading').hide();
	$('#edit_heading').show();
  $('#page').hide();
<?php /*?>  	<?php print WEB_URL_ADMIN ."admin/edit_cardaccept_list/".$row->sup_apart_cardaccept_list_id;?><?php */?>
  }
  function hide_this()
  {
	  $('#add_heading').hide();
	  $('#view_heading').show();
	  $('#cities').show();
	  $('#add_dest').show();
	  $('#add_comm').hide();
	   $('#page').show();
  }
    function hide_this1()
  {
	  $('#edit_heading').hide();
	 //
	  $('#view_heading').show();
	  $('#add_dest').show();
	  $('#cities').show();
	  $('#pop_hide').hide();
	  $('#edit_comm').hide();
	   $('#page').show();
  }
</script>

 <div id="container_warpper" style="padding-bottom:50px;" >
 <div style="background:#EFA146; color:#000; padding:4px;" id="view_heading" >View Popular Destinations</div>
 
  <div style="background:#EFA146; color:#000; padding:4px; display:none;" id="add_heading" >Add Popular Destinations<span style="float:right; cursor:pointer;" onclick="return hide_this();">Back to Popular destinatinos</span></div>
  
  <div style="background:#EFA146; color:#000; padding:4px; display:none;" id="edit_heading" >Edit Popular Destinations<span style="float:right; cursor:pointer;" onclick="return hide_this1();">Back to Popular destinatinos</span></div>
<div style="float:right; padding-top:10px; padding-right:20px; cursor:pointer;" id="add_dest" onclick="return abc1();">
Add Destination
</div>

 <table width="980" border="0" align="left" cellpadding="0" id="cities" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;" >
     
<tr style="background-color:#333; height:30px;">
<td width="140" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>S.No</b></td>
<td width="140" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Thumbnail</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>City</b></td>
 <td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Title</b></td>
  <td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>City/Region Id</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Display Order</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>DB Number</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>API Number</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Total</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Update</b></td>

	<td width="126" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Edit</b></td>
	<td width="126" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Status</b></td>
	<td width="93" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></td>
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($users)){ if($users!= '') { ?>
     
      <?php 
	  $i = 1;
	   foreach ($users as $row){ 
	   $crs_props = 0;
	   $api_props = 0;
	  $db_cnt = '';
	  $api_cnt = '';
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; " id="row<?php echo $row->popular_destinations_id?>">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $i; ?></td>
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if(isset($row->image)){if($row->image != ''){?>
        <div style="border:1px solid;height:55px; border-color:#666; width:65px; padding-top:5px;">
        <img src="<?php echo WEB_DIR_ADMIN?>uploadimage/<?php echo $row->image?>" height="50" width="60" align="center"  />
        </div>
		<?php }}?></td>
           <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->city_value;?></td>
              <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->title;?></td>
              <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->region_code !=''){echo $row->region_code;}else{echo $row->city_code;}?></td>
                 <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->order_disp;?></td>
                    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->region_code != '')
					{
						foreach($res as $row1)
		 				{	
					 		$crs_props = $crs_props + $this->Home_Model->get_crs_props_region($row1->sup_apartclass_type_id,$row->region_code);
		 				}
						 echo $crs_props;
					}
					elseif(isset($row->city_code)){if($row->city_code != ''){						
						foreach($res as $row1)
		 				{	
					 		$crs_props = $crs_props + $this->Home_Model->get_crs_props($row1->sup_apartclass_type_id,$row->city_code);
		 				}
						 echo $crs_props;}}?></td>
                       <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->region_code != '')
					{
						foreach($res as $row1)
		 				{	
					 		$api_props = $api_props + $this->Home_Model->get_api_props_region($row1->booking_type_id_new,$row->region_code);
		 				}
						 echo $crs_props;
					}
					  elseif(isset($row->city_code)){if($row->city_code != ''){						   
						   foreach($res as $row1)
		 					{
								if($row1->booking_type_id_new != 0)
								{
							 		$api_props = $api_props + $this->Home_Model->get_api_props($row1->booking_type_id_new,$row->city_code);
								}
		 					}
						    echo $api_props;}}?></td>
      <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $total_cnt = $crs_props + $api_props;$this->Home_Model->update_total_pop($row->popular_destinations_id,$total_cnt)?></td>
	 <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php echo WEB_URL_ADMIN?>admin/update_pop_table/<?php echo $row->city_code?>">update</a></td>
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	  <span id="image_id<?php echo $row->popular_destinations_id?>"><img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit" onclick="return edit('<?php echo $row->popular_destinations_id?>','<?php echo $row->city_value;?>','<?php echo $row->title;?>','<?php echo $row->image?>','<?php print $row->order_disp;?>','<?php echo $row->image_text?>','<?php echo mysql_real_escape_string($row->edit_text);?>','<?php echo mysql_real_escape_string($row->edit_page_title);?>','<?php echo mysql_real_escape_string($row->edit_meta);?>','<?php echo mysql_real_escape_string($row->edit_metakeyword);?>');"/>
      </span>
      </td> 
        
<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">

<?php if($row->status==0){?>
 <span id="deactive<?php echo $row->popular_destinations_id?>">
<img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20" onclick="return abc('<?php echo $row->status?>','<?php echo $row->popular_destinations_id?>')">
</span><?php }else{?>
 <span id="deactive<?php echo $row->popular_destinations_id?>">
<img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20" onclick="return abc('<?php echo $row->status?>','<?php echo $row->popular_destinations_id?>')">
</span>
<?php }?></td>  
		
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" onclick="delete_cls('<?php echo $row->popular_destinations_id;?>')"  /></td> 
	 </tr>
          <?php
	  $i++; }}}else{ echo "No records found";}?>  <?php 
	  ?>
</table>

<table style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;  margin:0px 0 0px 8px;" id="page">
 <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr>
</table>
<form name="form1" id="add_comm" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/add_pop_dest_city" method="post" enctype="multipart/form-data">

<div style="border:1px #ccc solid; margin-left:0px;" >
 <table style="width:900px; padding:15px;">
  <tr>
	<td>Add City</td>
	<td> <input name="city" id="city" syle="width:550px;">
				<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR?>test.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('city').value = obj.id; } };
	    var as_json = new AutoSuggest('city', options);
        </script></td></tr>
    <tr>
    <tr>
	<td>Title</td>
	<td> <input name="title" id="title" syle="width:550px;" type="text">
				</td></tr>
    <tr>
    <tr>
	<td>Thumbnail</td>
	<td> <input name="image1" id="image1" syle="width:550px;" type="file">
				</td><td></td></tr>
              
     
    <tr>
	<td>Add Display Order</td>
	<td> <input name="order" id="order" syle="width:550px;" type="text" onblur="return valid_order(this.value);">
				<br/><span id="order_err"></span></td></tr>
                
                 <tr>
	<td>Image text</td>
	<td> <input name="image_text" id="image_text" syle="width:550px;" type="text">
				</td><td></td></tr> 
				
	 <tr>	           
    <td>Edit Text</td>
	<td> <textarea name="edit_text" id="add_text" syle="width:950px;"></textarea>
				</td></tr>
				
	 <tr>	           
    <td>Edit Page Title</td>
	<td> <input name="edit_page_t" id="add_page_t" syle="width:550px;" type="text">
				</td></tr>
				
	 <tr>	           
    <td>Edit Meta Page Description</td>
	<td> <input name="edit_meta" id="add_meta" syle="width:550px;" type="text">
				</td></tr>
		
	<tr>	           
    <td>Edit Meta Keyword</td>
	<td> <input name="edit_metakeyword" id="add_metakeyword" syle="width:550px;" type="text">
				</td></tr>
                
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


<form action="<?php echo WEB_URL_ADMIN?>admin/update_pop_dest_city" id="edit_comm" method="post" enctype="multipart/form-data" style="display:none;">
<input type="hidden" name="edit_id" id="edit_id" />
<input type="hidden" id="edit_image_del" name="edit_image_del" />
	<div style="border:1px #ccc solid; margin-left:10px; " >
  <table style="width:600px; padding:15px;">
 <tr>
	<td>Edit City</td>
	<td> <input name="city" id="edit_city" syle="width:550px;">
				<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR?>test.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('edit_city').value = obj.id; } };
	    var as_json = new AutoSuggest('edit_city', options);
        </script></td></tr>
    <tr>
    <tr>
	<td>Edit Title</td>
	<td> <input name="title" id="edit_title" syle="width:550px;" type="text">
				</td></tr>
    <tr>
    <tr>
	<td>Edit Thumbnail</td>
	<td> <input name="image1" id="edit_image" syle="width:550px;" type="file">
				</td><td id="edit_image_view"></td></tr>
    <tr>
	<td>Edit Display Order</td>
	<td> <input name="order" id="edit_order" syle="width:550px;" type="text" onblur="return valid_order(this.value);">
				<br/><span id="order_err"></span></td></tr>
     <tr>	           
    <td>Edit Image Text</td>
	<td> <input name="image_t" id="image_t" syle="width:550px;" type="text">
				</td></tr>
		
	 <tr>	           
    <td>Edit Text</td>
	<td> <textarea name="edit_text" id="edit_text" syle="width:950px;"></textarea>
				</td></tr>
				
	 <tr>	           
    <td>Edit Page Title</td>
	<td> <input name="edit_page_t" id="edit_page_t" syle="width:550px;" type="text">
				</td></tr>
				
	 <tr>	           
    <td>Edit Meta Page Description</td>
	<td> <input name="edit_meta" id="edit_meta" syle="width:550px;" type="text">
				</td></tr>
		
	<tr>	           
    <td>Edit Meta Keyword</td>
	<td> <input name="edit_metakeyword" id="edit_metakeyword" syle="width:550px;" type="text">
				</td></tr>
                
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
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
<script type="text/javascript">
function abc(status,id)
{
	$.post("<?php echo WEB_URL_ADMIN?>admin/dest_status",{'status':status,'id':id},function(data){
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

function delete_cls(id)
{
	if(confirm('Are you sure want to delete this city?'))
	{
		$.post("<?php echo WEB_URL_ADMIN?>admin/delete_dest",{'id':id},function(data){
			$('#row'+id).remove();
		});
	}
}
function valid_order(email)
{
/*	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(user) == true)
	{*/

if(email != 0)
{
		$.post("<?php echo WEB_URL_ADMIN?>admin/order_avail",{'order':email},function(data){

		if(data == 1)
		{
			document.getElementById('order_err').innerHTML="<font color=red>this order is not available</font>";
			document.getElementById("order").value = '';
			document.getElementById("order").focus();
			
		}
		else
		{
			document.getElementById('order_err').innerHTML='';
		}
		});
	}
	else
	{
		document.getElementById('order_err').innerHTML="<font color=red>please don't add 0 as display order</font>";
			document.getElementById("order").value = '';
			document.getElementById("order").focus();	
	}
}
</script>
