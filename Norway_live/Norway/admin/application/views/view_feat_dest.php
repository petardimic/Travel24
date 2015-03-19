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
}
 function edit(id,city_value,tite,loc_selected,text_image)
  {
  $('#add_dest').hide();
  $('#cities').hide();
   $("#edit_id").val(id);
  $("#edit_city").val(city_value);
  $('#edit_title').val(tite);
 $('#edit_loc').val(loc_selected);
$('#image_text').val(text_image);
 $('#edit_comm').show();
  $('#page').hide();
<?php /*?>  	<?php print WEB_URL_ADMIN ."admin/edit_cardaccept_list/".$row->sup_apart_cardaccept_list_id;?><?php */?>
  }
  function edit_api(id,city_value,tite,loc_selected,text_image)
  {
	   $('#add_dest').hide();
  $('#cities').hide();
   $("#edit_id_api").val(id);
  $("#edit_city_api").val(city_value);
  $('#edit_title_api').val(tite);
 $('#edit_loc_api').val(loc_selected);
$('#image_text_api').val(text_image);
 $('#edit_comm_api').show();
  $('#page').hide();
  }
</script>

<script language="javascript">
	
function frnt(status,id,cont)
{
	//alert(cont);return false;
	$.post("<?php echo WEB_URL_ADMIN?>admin/fea_dest_status",{'status':status,'id':id,'cont':cont},function(data){
//alert(data); return false;
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
function frnt_euro(status,id,cont)
{
	//alert(cont);return false;
	$.post("<?php echo WEB_URL_ADMIN?>admin/fea_dest_euro_status",{'status':status,'id':id,'cont':cont},function(data){
//alert(data); return false;
			if(status == 1)
			{
				$('#deactive_frnt_euro'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate "width="20" height="20" onclick="return frnt_euro(0,'+id+')">');
			}
			else
			{
				$('#deactive_frnt_euro'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate "width="20" height="20" onclick="return frnt_euro(1,'+id+')">');
			}
	});
}
function frnt_east(status,id,cont)
{
	//alert(cont);return false;
	$.post("<?php echo WEB_URL_ADMIN?>admin/fea_dest_east_status",{'status':status,'id':id,'cont':cont},function(data){
//alert(data); return false;
			if(status == 1)
			{
				$('#deactive_frnt_east'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate "width="20" height="20" onclick="return frnt_east(0,'+id+')">');
			}
			else
			{
				$('#deactive_frnt_east'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate "width="20" height="20" onclick="return frnt_east(1,'+id+')">');
			}
	});
}
function frnt_asia(status,id,cont)
{
	//alert(cont);return false;
	$.post("<?php echo WEB_URL_ADMIN?>admin/fea_dest_asia_status",{'status':status,'id':id,'cont':cont},function(data){
//alert(data); return false;
			if(status == 1)
			{
				$('#deactive_frnt_asia'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate "width="20" height="20" onclick="return frnt_asia(0,'+id+')">');
			}
			else
			{
				$('#deactive_frnt_asia'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate "width="20" height="20" onclick="return frnt_asia(1,'+id+')">');
			}
	});
}
function frnt_southeastasia(status,id,cont)
{
	//alert(cont);return false;
	$.post("<?php echo WEB_URL_ADMIN?>admin/fea_dest_southasia_status",{'status':status,'id':id,'cont':cont},function(data){
//alert(data); return false;
			if(status == 1)
			{
				$('#deactive_frnt_southeastasia'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate "width="20" height="20" onclick="return frnt_southeastasia(0,'+id+')">');
			}
			else
			{
				$('#deactive_frnt_southeastasia'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate "width="20" height="20" onclick="return frnt_southeastasia(1,'+id+')">');
			}
	});
}
function frnt_oceania(status,id,cont)
{
	//alert(cont);return false;
	$.post("<?php echo WEB_URL_ADMIN?>admin/fea_dest_oceania_status",{'status':status,'id':id,'cont':cont},function(data){
//alert(data); return false;
			if(status == 1)
			{
				$('#deactive_frnt_oceania'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate "width="20" height="20" onclick="return frnt_oceania(0,'+id+')">');
			}
			else
			{
				$('#deactive_frnt_oceania'+id).html('<img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate "width="20" height="20" onclick="return frnt_oceania(1,'+id+')">');
			}
	});
}


</script>


 <div id="container_warpper" style="padding-bottom:50px;" >
 <div style="background:#EFA146; color:#000; padding:4px;" id="view_heading" >View Featured Properties</div>
  <div style="background:#EFA146; color:#000; padding:4px; display:none;" id="add_heading" >Add Featured Property</div>
<div style="float:right; padding-top:10px; padding-right:20px; cursor:pointer;" id="add_dest" onclick="return abc1();">
Add Featured Property
</div>

 <table width="980" border="0" align="left" cellpadding="0" id="cities" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;" >
     
<tr style="background-color:#333; height:30px;">
<td width="140" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>S.No</b></td>
<td width="140" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Property Name</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Country/City</b></td>
 <td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Americas</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Europe</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Middle East</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Asia</b></td>
<td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Southeast Asia</b></td>
	<td width="126" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Oceina</b></td>
	<td width="126" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Edit</b></td>
	<td width="93" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></td>
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($users)){ if($users!= '') { ?>
     
      <?php 
	  $i = 1;
	   foreach ($users as $row){ 
	  
	  if($row->america)
	  {
		  $loc_selected = 'america';
	  }
	  else if($row->europe)
	  {
		  $loc_selected = 'europe';
	  }
	  else if($row->middle_east)
	  {
		  $loc_selected = 'middle_east';
	  }
	  else if($row->asia)
	  {
		  $loc_selected = 'asia';
	  }
	  else if($row->southeastasia)
	  {
		  $loc_selected = 'southeastasia';
	   }
	   else if($row->oceania)
	   {
		   $loc_selected = 'oceania';
	   }
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; " id="row<?php echo $row->featured_prop ?>">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $i; ?></td>
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->hotel_name?></td>
           <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->city ;?></td>
              <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->america == 1){?><span id="deactive_frnt<?php echo $row->featured_prop?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" width="20" height="20" onclick="return frnt('<?php echo $row->america?>','<?php echo $row->featured_prop?>','america')" /></span><?php }else{?> <span id="deactive_frnt<?php echo $row->featured_prop?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" width="20" height="20" onclick="return frnt('<?php echo $row->america?>','<?php echo $row->featured_prop?>','america')"/></span><?php }?></td>
                 <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->europe == 1){?><span id="deactive_frnt_euro<?php echo $row->featured_prop?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" width="20" height="20" onclick="return frnt_euro('<?php echo $row->europe?>','<?php echo $row->featured_prop?>','europe')"/></span><?php }else{?><span id="deactive_frnt_euro<?php echo $row->featured_prop?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" width="20" height="20" onclick="return frnt_euro('<?php echo $row->europe?>','<?php echo $row->featured_prop?>','europe')"/></span><?php }?></td>
                    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->middle_east == 1){?><span id="deactive_frnt_east<?php echo $row->featured_prop?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" width="20" height="20" onclick="return frnt_east('<?php echo $row->middle_east?>','<?php echo $row->featured_prop?>','middle_east')"/></span><?php }else{?><span id="deactive_frnt_east<?php echo $row->featured_prop?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" width="20" height="20" onclick="return frnt_east('<?php echo $row->middle_east?>','<?php echo $row->featured_prop?>','middle_east')"/></span><?php }?></td>
                       <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->asia == 1){?><span id="deactive_frnt_asia<?php echo $row->featured_prop?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" width="20" height="20" onclick="return frnt_asia('<?php echo $row->asia?>','<?php echo $row->featured_prop?>','asia')"/></span><?php }else{?><span id="deactive_frnt_asia<?php echo $row->featured_prop?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" width="20" height="20" onclick="return frnt_asia('<?php echo $row->asia?>','<?php echo $row->featured_prop?>','asia')"/></span><?php }?></td>
                      
      <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->southeastasia == 1){?>
      <span id="deactive_frnt_southeastasia<?php echo $row->featured_prop?>">
      <img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" width="20" height="20" onclick="return frnt_southeastasia('<?php echo $row->southeastasia?>','<?php echo $row->featured_prop?>','southeastasia')"/>
      </span>
      <?php }else{?>
      <span id="deactive_frnt_southeastasia<?php echo $row->featured_prop?>">
      <img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" width="20" height="20"onclick="return frnt_southeastasia('<?php echo $row->southeastasia?>','<?php echo $row->featured_prop?>','southeastasia')"/>
      </span>
      <?php }?></td>
	
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	 <?php if($row->oceania  == 1){?>
     <span id="deactive_frnt_oceania<?php echo $row->featured_prop?>">
     <img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" width="20" height="20" onclick="return frnt_oceania('<?php echo $row->oceania?>','<?php echo $row->featured_prop?>','oceania')"/>
     </span>
     <?php }else{?>
     <span id="deactive_frnt_oceania<?php echo $row->featured_prop?>">
     <img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" width="20" height="20" onclick="return frnt_oceania('<?php echo $row->oceania?>','<?php echo $row->featured_prop?>','oceania')"/>
     </span>
     <?php }?>
      </td> 
        
<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	  <span id="image_id<?php echo $row->featured_prop?>"><img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit"
      <?php if($row->type == 'stay'){?>
       onclick="return edit('<?php echo $row->featured_prop?>','<?php echo $row->city ?>','<?php echo $row->hotel_name?>','<?php if(isset($loc_selected)){if($loc_selected != '') { print $loc_selected; } }else { echo ''; }?>','<?php echo mysql_real_escape_string($row->image_text);?>');"
       <?php }else{?>
              onclick="return edit_api('<?php echo $row->featured_prop?>','<?php echo $row->city ?>','<?php echo $row->hotel_name?>','<?php print $loc_selected;?>','<?php echo mysql_real_escape_string($row->image_text);?>');"
       <?php }?>/>
      </span>
      </td>   
		
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" onclick="delete_cls('<?php echo $row->featured_prop;?>')"  /></td> 
	 </tr>
          <?php
	  $i++; }}}else{ echo "No records found";}?>  <?php 
	  ?>
</table>

<table style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;  margin:0px 0 0px 8px;" id="page">
 <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr>
</table>
<form name="form1" id="add_comm" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/add_fet_dest_city" method="post" >

<div style="border:1px #ccc solid; margin-left:0px;" >
 <table style="width:900px; padding:15px;">
 
  <tr>
	
	<td> <input type="radio" name="fet" id="fet_stay" checked="checked"> Travelingmart</td>
    <td> <input type="radio" name="fet" onclick="return add_api_hotel();" > Booking.com</td>
        </tr>
        
  <tr>
	<td>Add City</td>
	<td> <input name="city" id="city" syle="width:550px;">
				<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR?>test.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('city').value = obj.id; } };
	    var as_json = new AutoSuggest('city', options);
        </script></td>
        </tr>
  
    <tr>
	<td>Add Travelingmart Property</td>
	<td> <input name="hotel" id="hotel" syle="width:550px;" type="text">
	<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR?>auto_hotel.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('hotel').value = obj.id; } };
	    var as_json = new AutoSuggest('hotel', options);
        </script>
    
    </td>
    </tr>
	
     <tr>
	<td>Add Location</td>
	<td> <select name="loc" id="loc" syle="width:200px;">
    <option value="america">america</option>
    <option value="europe">europe</option>
    <option value="middle_east">middle_east</option>
    <option value="asia">asia</option>
    <option value="southeastasia">southeastasia</option>
    <option value="oceania">oceania</option>
    </select>
				</td></tr>
<tr>
	<td>Image Text</td>
	<td><textarea style="width:230px;" name="image_text"></textarea>
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



<form name="form1" id="add_api_hotel" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/add_fet_dest_city_api" method="post" >

<div style="border:1px #ccc solid; margin-left:0px;" >
 <table style="width:900px; padding:15px;">
 
  <tr>
	
	<td> <input type="radio" name="fet1" onclick="return disp_crs();" > Travelingmart</td>
    <td> <input type="radio" name="fet1" id="fet_api" checked="checked" > Booking.com</td>
        </tr>
        
  <tr>
	<td>Add City</td>
	<td> <input name="city" id="city1" syle="width:550px;">
				<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR?>test.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('city').value = obj.id; } };
	    var as_json = new AutoSuggest('city1', options);
        </script></td>
        </tr>
  
    <tr>
	<td>Add Booking Property</td>
	<td> <input name="hotel" id="hotel1" syle="width:550px;" type="text">
	<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR?>auto_hotel_api.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('hotel').value = obj.id; } };
	    var as_json = new AutoSuggest('hotel1', options);
        </script>
    
    </td>
    </tr>
	
     <tr>
	<td>Add Location</td>
	<td> <select name="loc" id="loc" syle="width:200px;">
    <option value="america">america</option>
    <option value="europe">europe</option>
    <option value="middle_east">middle_east</option>
    <option value="asia">asia</option>
    <option value="southeastasia">southeastasia</option>
    <option value="oceania">oceania</option>
    </select>
				</td></tr>
<tr>
	<td>Image Text</td>
	<td><textarea style="width:230px;" name="image_text"></textarea>
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


<form action="<?php echo WEB_URL_ADMIN?>admin/update_fet_dest_city" id="edit_comm" method="post" style="display:none;">
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
	<td>Edit Hotel</td>
	<td> <input name="hotel" id="edit_title" syle="width:550px;" type="text">
				<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR?>auto_hotel.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('hotel').value = obj.id; } };
	    var as_json = new AutoSuggest('edit_title', options);
        </script>
                </td></tr>
    <tr>
	<td>Add Location</td>
	<td> <select name="loc" id="edit_loc" syle="width:200px;">
    <option value="america">america</option>
    <option value="europe">europe</option>
    <option value="middle_east">middle_east</option>
    <option value="asia">asia</option>
    <option value="southeastasia">southeastasia</option>
    <option value="oceania">oceania</option>
    </select>
				</td></tr>
<tr>
	<td>Edit Image Text</td>
	<td> <textarea id="image_text" name="image_text" style="width:230px;"></textarea>
				</td></tr>
                
                <tr>
	
	<td>
	 </td>
	<td> <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22">
	<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="22" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
    </td>
	</tr>
  </table>
  </div>	
             
   </form>    
		
	<form action="<?php echo WEB_URL_ADMIN?>admin/update_fet_dest_city_api" id="edit_comm_api" method="post" style="display:none;">
<input type="hidden" name="edit_id_api" id="edit_id_api" />
<input type="hidden" id="edit_image_del" name="edit_image_del" />
	<div style="border:1px #ccc solid; margin-left:10px; " >
  <table style="width:600px; padding:15px;">
 <tr>
	<td>Edit City</td>
	<td> <input name="edit_city" id="edit_city_api" syle="width:550px;">
				<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR?>test.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('edit_city_api').value = obj.id; } };
	    var as_json = new AutoSuggest('edit_city_api', options);
        </script></td></tr>
    <tr>
    <tr>
	<td>Edit Hotel</td>
	<td> <input name="edit_hotel" id="edit_title_api" syle="width:550px;" type="text">
				<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR?>auto_hotel_api.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('edit_title_api').value = obj.id; } };
	    var as_json = new AutoSuggest('edit_title_api', options);
        </script>
                </td></tr>
    <tr>
	<td>Add Location</td>
	<td> <select name="edit_loc" id="edit_loc_api" syle="width:200px;">
    <option value="america">america</option>
    <option value="europe">europe</option>
    <option value="middle_east">middle_east</option>
    <option value="asia">asia</option>
    <option value="southeastasia">southeastasia</option>
    <option value="oceania">oceania</option>
    </select>
				</td></tr>
<tr>
	<td>Edit Image Text</td>
	<td> <textarea id="image_text_api" name="image_text" style="width:230px;"></textarea>
				</td></tr>
                
                <tr>
	
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

function delete_cls(id)
{
	if(confirm('Are you sure want to delete this facility type?'))
	{
		$.post("<?php echo WEB_URL_ADMIN?>admin/delete_fet",{'id':id},function(data){
			$('#row'+id).remove();
		});
	}
}
function valid_order(email)
{
/*	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(user) == true)
	{*/


		$.post("<?php echo WEB_URL_ADMIN?>admin/order_avail",{'order':email},function(data){

		if(data == 1)
		{
			document.getElementById('order_err').innerHTML="<font color=red>This Order is available</font>";
			document.getElementById("order").value = '';
			document.getElementById("order").focus();
			
		}
		else
		{
			document.getElementById('order_err').innerHTML='';
		}
		});
	//}
}
function add_api_hotel()
{
	document.getElementById('fet_stay').checked = false;
	document.getElementById('fet_api').checked = true;
	$('#add_comm').hide();
	$('#add_api_hotel').show();
}
function disp_crs()
{
document.getElementById('fet_api').checked = false;
document.getElementById('fet_stay').checked = true;
		$('#add_comm').show();
	$('#add_api_hotel').hide();
}
</script>
