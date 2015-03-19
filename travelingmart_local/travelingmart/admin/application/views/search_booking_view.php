<?php
//print_r($onrequest_booking);
//exit;
?>

<script type="text/javascript" src="<?php print WEB_DIR_ADMIN; ?>js/jquery_tab2.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>js/paginator.js"></script>
<script type="text/javascript">
	
	$(function () { itemsPerPage = 10; paginatorStyle = 2; enableGoToPage = true; $("#example1").pagination();  });
	function book_vali()
{
	
	var chks = document.getElementsByName('book_id');
	var chks1 = document.getElementsByName('onreq_status');
	if(chks1=='-Select-')
	{
		 alert("Please select Edit Status.");
  		return false;
	}
	else
	{
		var checkCount = 0;
		 for (var i = 0; i < chks.length; i++)
		 {
			  if (chks[i].checked)
			  {
			   checkCount++;
			  }
		 }
		 if (checkCount < 1)
		 {
			  alert("Please select atleast one.");
			  return false;
		 }
 	}
 
  document.form1.submit();
 
 }

</script>


<style type="text/css">
.paginator .active
  {
   color:#0033CC;
   padding:2px 10px;
   margin:5px;
   text-decoration:none;
  }
  
  .paginator .inactive
  {
   color:#000000;
   cursor:default;
   text-decoration:none;
   background-color:gainsboro;
   padding:2px 10px;
   margin:5px;
  }
  
  
  
<!--for tab-->  
  .tab-box2 { 
  border-bottom: 1px solid #DDD;
  padding-bottom:5px;
  

}
.tab-box2 a {
  border:1px solid #DDD;
  color:#fff;
  padding: 1px 15px;
  text-decoration:none;
  background-color: #EFA146;
}
.tab-box2 a.activeLink { 
  background-color: #fff; 
  border-bottom: 0; 
  color:#000000;
  padding: 1px 15px !important;
}
.tabcontent { border: 1px solid #ddd; border-top: 0; padding: 5px;}
.hide { display: none;}

<!--for tab-->
</style>
<!--for tab start-->
<script type="text/javascript">
  $(document).ready(function() {
    $(".tabLink").each(function(){
      $(this).click(function(){
        tabeId = $(this).attr('id');
        $(".tabLink").removeClass("activeLink");
        $(this).addClass("activeLink");
        $(".tabcontent").addClass("hide");
        $("#"+tabeId+"-1").removeClass("hide")   
        return false;	  
      });
    });  
  });
</script>

<!--for tab end-->
<div id="container_warpper"  >
      
  <div class="tab-box2" style="margin-top:30px !important; margin-left:11px !important; padding:0 15px; "> 
    <a href="javascript:;" class="tabLink activeLink" id="cont-1">Confirm Booking<?php 
	   $count=0;
	   if(isset($confirm_booking)){ if($confirm_booking != '') { foreach ($confirm_booking as $row)
	   {
	   $count=$count+1;
	   }
	   }}
	   echo '('.$count.')';
	   ?></a> 
    <a href="javascript:;" class="tabLink " id="cont-2">Cancel Booking <?php 
	   $counta=0;
	   if(isset($cancel_booking)){ if($cancel_booking != '') { foreach ($cancel_booking as $row)
	   { 
	   
	   $counta=$counta+1;
	   }
	   }}
	   echo '('.$counta.')';
	   ?></a> 
    <a href="javascript:;" class="tabLink " id="cont-3">Request Booking<?php 
	   $counta=0;
	   if(isset($onrequest_booking)){ if($onrequest_booking != '') { foreach ($onrequest_booking as $row)
	   { 
	   
	   $counta=$counta+1;
	   }
	   }}
	   echo '('.$counta.')';
	   ?></a> 
  </div>
  
  <div class="tabcontent" id="cont-1-1" style="padding-left:4px; margin-left:11px;  border-top:solid 1px #ddd; margin-bottom:20px;"> 
   
   
   <table width="957" height="57" border="0" style="font-family:14px; margin-top:10px; ">
           <tr bgcolor="#333">
                <td width="98" align="center" bgcolor="#333"><font color="#fff">Booking Id</font></td>
                <td width="110" align="center" bgcolor="#333"><font color="#fff">Agent Name</font></td>
                <td width="90" align="center" bgcolor="#333"><font color="#fff">Start</font></td>
                 <td width="104" align="center" bgcolor="#333"><font color="#fff">Booking Name</font></td>
              <?php /*?>  <td width="72" align="center" bgcolor="#74941d"><font color="#fff">Passenger</font></td><?php */?>
                <td width="74" align="center" bgcolor="#333"><font color="#fff">Total Price</font></td>
                <td width="310" align="center" bgcolor="#333"><font color="#fff">Status</font></td>
                 <td width="141" align="center" bgcolor="#333"><font color="#fff">Requested Date</font></td>
      </tr>
              <?php 

  if(isset($confirm_booking)){ if($confirm_booking != '') { ?>
              <?php $i=1;  foreach ($confirm_booking as $row){ 
	  
	  ?>
              <tr>
                <td height="27" align="center" style="border:solid 1px #ccc;"><?php echo $row->booking_no; ?>
                <?php /*?>  <a href="<?php print WEB_URL_ADMIN.'/admin/voucher_print_db'.'/'.$row->booking_no; ?>"><?php echo $row->booking_no; ?></a><?php */?>
                </td>
                <td align="center" style="border:solid 1px #ccc;"><?php $name=$this->Home_Model->get_agentid($row->user_id); 
				if($name==""){echo "customer";}else{echo $name;}?></td>
                <td align="center" style="border:solid 1px #ccc;"><?php $date_ck= $row->voucher_date;
					   echo date('d M  Y', strtotime($date_ck)); 
					   ?></td>
              <td align="center" style="border:solid 1px #ccc;"><?php print $row->first_name.' '.$row->last_name; ?></td>
              <?php /*?><td style="border:solid 1px #ccc;"><?php print $this->Home_Model->get_tot_passanger($row->booking_no); ?></td><?php */?>
                <td align="center" style="border:solid 1px #ccc;"><?php print ceil($row->amount); ?></td>
                <td style="border:solid 1px #ccc;">
				<?php
				if($row->status=='confirmed'||$row->status=='Confirmed'||$row->status=='Confirmed or Completed' )
				{
					if($row->api=='crs')
					{
				?>
				<?php echo 'CONFIRMED';?>
				<?php /*?><a href="<?php print WEB_URL_ADMIN.'admin/cancel_booking_db'.'/'.$row->booking_no;?>"><?php echo 'CONFIRMED';?></a><?php */?>
				<?php
				}
				else
				{
					?>
					<!--<a href="<?php print WEB_URL_ADMIN.'admin/cancel_booking'.'/'.$row->booking_no;?>"></a>--><?php echo 'CONFIRMED';?>
                <?php
				}
				}
			
		
				?>
				</td>
               
              <td style="border:solid 1px #ccc;"><?php $voucher_date= $row->voucher_date;
					   echo date('d M  Y', strtotime($voucher_date)); 
					   ?></td>
                  <?php
	?>
               
              </tr>
              <?php $i++; } ?>
              <?php } else { ?>
              <tr>
                <td colspan="8" align="center" style="border:solid 1px #ccc;">No Records Found!!</td>
              </tr>
              <?php } } ?>
            </table>
   
   
   
   
   
  </div><!--first tab-->
  
  <div class="tabcontent hide" id="cont-2-1" style="border-top:solid 1px #ddd; margin-left:11px; margin-bottom:20px"> 
  
  <table width="957" height="57" border="0" style="font-family:14px; margin-top:10px; ">
            <tr bgcolor="#33CCFF">
              <td align="center" bgcolor="#333"><font color="#fff">Booking Id</font></td>
              <td align="center" bgcolor="#333"><font color="#fff">Agent Name</font></td>
              <td align="center" bgcolor="#333"><font color="#fff">Start</font></td>
              <td align="center" bgcolor="#333"><font color="#fff">Booking Name</font></td>
           <?php /*?>   <td align="center" bgcolor="#74941d"><font color="#fff">Passenger</font></td><?php */?>
              <td align="center" bgcolor="#333"><font color="#fff">Total Price</font></td>
              <td align="center" bgcolor="#333"><font color="#fff">Status</font></td>
              <td align="center" bgcolor="#333"><font color="#fff">Requested Date</font></td>
            </tr>
            <?php 

  if(isset($cancel_booking)){ if($cancel_booking != '') { ?>
            <?php $i=1;  foreach ($cancel_booking as $row){ 
	  
	  ?>
            <tr>
              <td height="27" style="border:solid 1px #ccc;"><?php echo $row->booking_no; ?></td>
             <td style="border:solid 1px #ccc;"><?php $name=$this->Home_Model->get_agentid($row->user_id); 
				if($name==""){echo "customer";}else{echo $name;}?></td>
              <td style="border:solid 1px #ccc;"><?php $date_ck= $row->check_in;
					   echo date('d M  Y', strtotime($date_ck)); 
					   ?></td>
              <td style="border:solid 1px #ccc;"><?php print $row->first_name.' '.$row->last_name; ?></td>
           <?php /*?>   <td style="border:solid 1px #ccc;"><?php print $this->Home_Model->get_tot_passanger($row->booking_no); ?></td><?php */?>
              <td style="border:solid 1px #ccc;"><?php print ceil($row->amount); ?></td>
              <td style="border:solid 1px #ccc;"><?php
						echo $row->status;
						?></td>
                        <td style="border:solid 1px #ccc;"><?php $voucher_date= $row->voucher_date;
					   echo date('d M  Y', strtotime($voucher_date)); 
					   ?></td>
            </tr>
            <?php $i++; } ?>
            <?php } else { ?>
            <tr>
              <td colspan="9" align="center" style="border:solid 1px #ccc;">No Records Found!!</td>
            </tr>
            <?php } } ?>
          </table>
  
  
  
  </div> <!--second tab-->
  
  <div class="tabcontent hide" id="cont-3-1" style="border-top:solid 1px #ddd; margin-left:11px; margin-bottom:20px;"> 
   
   
   
   <table width="957" height="57" border="0" style="font-family:14px; margin-top:10px; margin-bottom:20px">
              <tr bgcolor="#33CCFF">
               
                <td align="center" bgcolor="#333"><font color="#fff">Booking Id</font></td>
                <td align="center" bgcolor="#333"><font color="#fff">Agent Name</font></td>
                <td align="center" bgcolor="#333"><font color="#fff">Start</font></td>
                <td align="center" bgcolor="#333"><font color="#fff">Booking Name</font></td>
   <?php /*?>             <td align="center" bgcolor="#74941d"><font color="#fff">Passenger</font></td><?php */?>
                <td align="center" bgcolor="#333"><font color="#fff">Total Price</font></td>
                <!--<td align="center" bgcolor="#FFCC66"><strong><font color="#000000">Status</font></strong></td>-->
         <?php /*?>       <td align="center" bgcolor="#74941d"><font color="#fff">Charges Deadline</font></td><?php */?>
                <td align="center" bgcolor="#333"><font color="#fff">Requested Date</font></td>
               <td align="center" bgcolor="#333"><font color="#fff">Change Status</font></td>
              </tr>
              <?php 

  if(isset($onrequest_booking)){ if($onrequest_booking != '') { ?>
              <?php $i=1;  foreach ($onrequest_booking as $row){ 
	  
	  ?>
              <tr>
          
                <td style="border:solid 1px #ccc;"><a href="<?php print WEB_URL_ADMIN.'/admin/voucher_print_db'.'/'.$row->booking_no; ?>"><?php echo $row->booking_no; ?></a></td>
                <td style="border:solid 1px #ccc;"><?php print $this->Home_Model->get_agentid($row->user_id); ?></td>
                <td style="border:solid 1px #ccc;"><?php $date_ck= $row->check_in;
					   echo date('d M  Y', strtotime($date_ck)); 
					   ?></td>
                <td style="border:solid 1px #ccc;"><?php print $row->first_name.' '.$row->last_name; ?></td>
    <?php /*?>            <td style="border:solid 1px #ccc;"><?php print $this->Home_Model->get_tot_passanger($row->booking_no); ?></td><?php */?>
                <td style="border:solid 1px #ccc;"><?php print ceil($row->amount); ?></td>
                <?php /*?><td style="border:solid 1px #ccc;"><?php $cancel_fromdate= $row->cancel_fromdate;
					   //echo date('d M  Y', strtotime($cancel_fromdate)); 
					   echo $cancel_fromdate;
					   ?></td><?php */?>
                <td style="border:solid 1px #ccc;"><?php $voucher_date= $row->voucher_date;
					   echo date('d M  Y', strtotime($voucher_date)); 
					   ?></td>
                    <td style="border:solid 1px #ccc;">
                      <script type="text/javascript">
						  function chstatus1<?php echo $row->booking_no?>()
						  {
							document.getElementById('chstatus<?php echo $row->booking_no?>').submit(); 
							
						  }
						  </script>
                         
                    <form name="chstatus" id="chstatus<?php echo $row->booking_no?>" method="post" action="<?php echo WEB_URL_ADMIN;?>/admin/changestatus/<?php echo $row->booking_no?>">
                  <select name="chstatus"  id="chstatus<?php echo $row->booking_no?>" >  
<?php /*?>				  onchange="chstatus1<?php echo $row->booking_no?>()"<?php */?>
                            <option value="0">Change status</option>
                          <option value="Confirmed">Confirm</option>
                          <option value="Cancelled">Cancel</option>
                          </select>
                            </form>
                          </td>    
              </tr>
              <?php $i++; } ?>
              <?php } else { ?>
              <tr>
                <td colspan="9" align="center" style="border:solid 1px #ccc;">No Records Found!!</td>
              </tr>
              <?php } } ?>
            </table>
   
   
   
  </div><!--third tab-->

 </div>
 
	  
   

     
	
	 	  
    
   
  

