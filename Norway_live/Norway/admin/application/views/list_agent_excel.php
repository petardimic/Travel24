<?php 
 $filename = "agent_list" . date('Ymd') . ".xls"; 
 header("Content-Disposition: attachment; filename=\"$filename\""); 
                 header("Content-Type: application/vnd.ms-excel"); $flag = false; 
				 ?>
 <div class="clr">
 
 <div class="clr">
 


 <table width="100%" border="0" align="right" cellpadding="8" cellspacing="3" style="background-color:#fff; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px -120px;" class="sortable">
     
       <thead><tr style="background-color:#505e91; height:30px; color:#fff;">
	    <th width="142" height="49" align="center" valign="middle" style="border-right:1px solid #FFF
        ; padding:10px 10px 10px 10px; "><b>SL.No</b></th>
       <th width="142" height="49" align="center" valign="middle" style="border-right:1px solid #FFF
        ; padding:10px 10px 10px 10px; "><b>AgentID</b></th>
       <th width="142" height="49" align="center" valign="middle" style="border-right:1px solid #FFF
        ; padding:10px 10px 10px 10px;"><b>Agency Name</b></th>
     
       <th width="142" height="49" align="center" valign="middle" style="border-right:1px solid #FFF
        ; padding:10px 10px 10px 10px;"><b>Contact Person </b></th>
        <th width="72" height="49" align="center" valign="middle" style="border-right:1px solid #FFF
        ; padding:10px 10px 10px 10px; "><b>Contact No </b></th>
       
         <th width="137" height="49" align="center" valign="middle" style="border-right:1px solid #FFF
        ; padding:10px 10px 10px 10px;"><b>	E-mail ID </b></th>
         
         
		 
 <th width="137" height="49" align="center" valign="middle" style="border-right:1px solid #FFF
        ; padding:10px 10px 10px 10px;"><b>Balance</b></th>
		
		 
    </tr></thead>
      <?php
	  if(isset($list_agent)){ if($list_agent != '') {
		  
		  $i=1; ?>
     <tbody>
      <?php 
	   foreach ($list_agent as $row){ 
	  
		  ?>
          <tr style="height:25px;">
		  <td align="left" valign="middle" style="border-right:1px solid #FFF
        ; padding:0 5px 0 5px; color:#333; height:30px; ">
		<?php echo  $i; ?>
        </td>
          <td align="left" valign="left" style="border-right:1px solid #FFF
        ; padding:0 5px 0 5px; color:#333; height:30px; "><a href="<?php print WEB_URL_ADMIN.'admin/view_user_detail/'.$row->agent_id; ?>"><?php
		echo $row->agent_id;
		 ?></a>
		</td>
          <td align="left" valign="middle" style="border-right:1px solid #FFF
        ; padding:0 5px 0 5px; color:#333; height:30px; ">
		<?php echo $row->agency_name; ?>
        </td>
            <td align="left" valign="middle" style="border-right:1px solid #FFF
        ; padding:0 5px 0 5px; color:#333; height:30px; "><?php print $row->agent_name; ?></td>
        
        
        <td align="left" valign="middle" style="border-right:1px solid #FFF
        ; padding:0 5px 0 5px; color:#333; height:30px; "><?php print $row->mobile_phone; ?></td>
       
       
     
		 
         <td align="left" valign="middle" style="border-right:1px solid #FFF
        ; padding:0 5px 0 5px; color:#333; "><?php echo $row->email;?></td>
		  <td align="left" valign="middle" style="border-right:1px solid #FFF
        ; padding:0 5px 0 5px; color:#333; "><?php echo $row->account_balance;?></td>
		
          </tr>
		
          <?php    $i++;
	  }}else{?>
	 <tr><td colspan="14" align="center" style="color:#000000;"><?php  echo 'No Agents found'; ?></td></tr>
	 <?php }}
	  ?>
     </tbody>
</table>

			</div>
        
		

