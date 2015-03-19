<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Open/Close Dates</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery-1.4.3.min.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>
<?php /*?><script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script><?php */?>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>

<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->

<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
table.display td select {
    background: none repeat scroll 0 0 #F2F2F2;
    border: 1px solid #DCDCDC;
    border-radius: 3px 3px 3px 3px;
    color: #555555;
    font-size: 11px;
    height: 30px;
}
table.display td input {
   /* background: none repeat scroll 0 0 #FFFFFF;*/
    border: 1px solid #DCDCDC;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-size: 11px;
    height: 25px;
    vertical-align: middle;
}
.border-bottom {
    border-bottom: 1px solid #E7E7E7;
    vertical-align: top;
}
</style>
</head>
<body>

<div class="wrapper">
    <!-- Top navigation bar -->
   <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

   <!-- <div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
  <!--  <div class="wrapper">
        <!-- Content -->
        <!--<div class="content">
            <!-- Dynamic table -->
           <!-- <div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                           <div style="color:#fff !important; height:22px; width:100%; font-size:18px; padding:8px 12px;">Open/Close Dates<span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A; margin-right:15px;">Go to List</a></span></div>
                           
                    		
                             </div>   
                        </div><!--title-->
                    <!--</div>
                </div>-->
                

	<div id="container_warpper" >       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">Open/Close Dates<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%; overflow:auto; height:auto; min-height:545px;">
    <table class="display tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%" style="border:solid 1px #ccc;" >
	<?php if(isset($months)){if($months!=''){?>
           <tr>
            <td>
			 <form name="rate_details" id="rate_details" action="<?php echo WEB_URL_ADMIN?>supplier/open_close_date/1" method="post">
             <div style="color:#000 !important; height:30px; width:100%; font-size:13px; padding-top:5px; background:#dcdcdc; border:solid 1px #bebdbd; text-align:center">
                    Select Month: <select name="month" style="width:180px; height:25px;" onchange="this.form.submit();">
					<?php foreach($months as $row){?>
					<option value="<?php echo $row->month.','.$row->year?>" <?php if(isset($month_name)){if($month_name!=''){ if($month_name ==  $row->month){?> selected="selected"<?php }?>><?php  echo $row->month.'-'.$row->year ?></option>
					<?php }}}?>
							 </select></div>
					</form>
							

			</td>
             </tr>
		
             <tr>
             <td>
             <div style="width:100%; height:80px;">
             <div style="float:left; width:13%; line-height:3;  padding-left:10px">Days of : 
			 <?php if(isset($month_name) && isset($year_name)){ $nmonth = date('m',strtotime($month_name));if($month_name!='' && $year_name!=''){echo $month_name.'-'.$year_name; $num = cal_days_in_month(CAL_GREGORIAN, $nmonth, $year_name);}}?><br />
               									Close out all rate plans</div>
			
             <div style="float:left; width:85%; border:solid 3px #dcdcdc">
             <table width="100%">
             <tr>
			 <?php 
			 if(isset($num)){
			 for($i=1;$i<=$num;$i++){?>			 
             <td style="border-right:solid 1px #dcdcdc"><?php echo $i;?></td>
			 <?php }}?>
             </tr>
             
             
              <tr style="border-top:solid 1px #dcdcdc">
			   <?php 
			   $apt_id = $this->session->userdata('apt_id');
			    if(isset($num)){
			 for($i=1;$i<=$num;$i++){
			 $nmonth = date('m',strtotime($month_name));
			 $date1 = $year_name.'-'.$nmonth.'-'.$i;?>
				<td style="border-right:solid 1px #dcdcdc"> <a href="<?php echo WEB_URL?>supplier/open_all/1/<?php echo $date1.'/'.$apt_id.'/'.$month_name.'/'.$year_name;?>"><img src="<?php echo WEB_DIR;?>/images/tick.gif" width="16" hight="16" title="open all room types" /></a> <br /><a href="<?php echo WEB_URL?>supplier/close_all/1/<?php echo $date1.'/'.$apt_id.'/'.$month_name.'/'.$year_name;?>"><img src="<?php echo WEB_DIR;?>/images/crs.gif" width="16" hight="16" title="close all room types"/></a></td>
			 <?php }}?>
            
          
             </tr>
			 	<?php }}?>
             </table>
           
             
             </div>
             
             </div>
             
             </td>
             
             </tr>
               <?php $pat_id = $this->session->userdata('apt_id');if(isset($plan)){if($plan!=''){
			   foreach($plan as $p){ ?>
             
                  <tr>
             <td>
             <div style="color:#ff0000; font-size:14px;"><?php echo $room_name = $this->Supplier_Model->get_cat_name($p->sup_apart_category_id,$pat_id);?></div>
			 <?php $rate_plan = $this->Supplier_Model->get_rate_plan_open($p->sup_apart_category_id,$pat_id);?>
            
			 
			 <?php if(isset($rate_plan)){if($rate_plan!=''){foreach($rate_plan as $r){?>
			  <div style="width:100%; height:86px; ">
			 
			  <table width="98%">
			  <tr>
			  <td style="background:#e7e7e7"><div style=" width:132px; ;"><?php echo $r->rate_name;$r->sup_apart_rateplan_id?></div></td>
       
			 
			  <?php ?>
			  <?php if(isset($month_name) && isset($year_name)){ $nmonth = date('m',strtotime($month_name));if($month_name!='' && $year_name!=''){$num = cal_days_in_month(CAL_GREGORIAN, $nmonth, $year_name);}}?>
			   
			
				 
		    <td  style="border:solid 3px #dcdcdc">
			<table ><tr> 
			 
			  
			<?php $res = '';if(isset($num)){for($i=1;$i<=$num;$i++){
			$nmonth = date('m',strtotime($month_name));
			$date1 = $year_name.'-'.$nmonth.'-'.$i;
			$r->sup_apart_rateplan_id;
			$get_status = $this->Supplier_Model->get_maintain_status($r->sup_apart_rateplan_id,$pat_id,$date1);
			//echo $get_status;
			if($get_status == NULL)
			{
				 $res = "no";
			}
			else if($get_status!=''){if($get_status->status ==0 || $get_status->status==1)
			{
				 $res = $get_status->status;
			}
			}?>
			<?php if($res == 1){?>	
				<td style="border-right:solid 1px #dcdcdc; width:60%;"><a href="<?php echo WEB_URL?>supplier/change_status/1/<?php echo $get_status->sup_apart_maintain_month_id?>/<?php echo $get_status->status.'/'.$month_name.'/'.$year_name;?>"><img src="<?php echo WEB_DIR;?>/images/tick.gif"  width="16" hight="16" alt="t" title="click to close" /></a></td>
				<?php }else if($res == "no"){?>
				<td style="border-right:solid 1px #dcdcdc; width:60%;"><img src="<?php echo WEB_DIR;?>/images/no-room.png"  width="16" hight="16" title="Room is not added" /></td>
				<?php }else{?>
				<td style="border-right:solid 1px #dcdcdc; width:60%;"><a href="<?php echo WEB_URL?>supplier/change_status/1/<?php echo $get_status->sup_apart_maintain_month_id?>/<?php echo $get_status->status.'/'.$month_name.'/'.$year_name;?>"><img src="<?php echo WEB_DIR;?>/images/crs.gif"  width="16" hight="16" alt="click to open" title="click to open" /></a></td>
				<?php }?>
 	        <?php }}?>
			
             </tr></table></td>
	
             
             
             </table>
       
             
        
             
             
             <?php }}}?>
             </td>
             
             </tr>
			<?php }}}?>
                           
        </table>
     
    </div> </div>
    <div class="fix">
    </div>
    </div>
    <!--<div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span>--><!--</span>
        </div>
    </div>-->
                <!-- Footer -->
</body></html>