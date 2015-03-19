<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DSS Travels</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body ><!--header-->
<?php 
    $flight_det = $this->Flights_Model->getflightdetvoucher($id);
    $book_det = $this->Flights_Model->getflightbookdet($id);
    $all_passenegers = $this->Flights_Model->getall_passengers($id);
?>
<div style="float:left; height:auto; width:100%;"><!--content-->
<div style="margin:auto; height:auto; width:800px;">
<div class="content" style="width:800px; padding-bottom:10px;">
  <table border="0" cellpadding="0" cellspacing="0" width="800" style="font-size:13px; border:1px #be1313 solid; font-family:Arial, Helvetica, sans-serif; font-weight:normal;" >
    <tbody>
      <tr>
        <th height="90" align="left" style="color:#FFF; padding-left:15px; font-weight:bold; font-size:16px; font-family:Arial, Helvetica, sans-serif;" ><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="200" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="color:#000;">
              <tr >
                <td  >&nbsp;</td>
              </tr>
              <tr >
                <td style="font-size:24px;">BOOKING VOUCHER</td>
              </tr>
              <tr>
                <td height="5" style="font-size:16px;"></td>
              </tr>
              <tr>
                <td style="font-size:14px;">Date: <?php echo date('D, d M Y',strtotime($book_det->creation_date)); ?></td>
              </tr>
            </table></td>
            <td width="200" align="right"><img src="<?php echo base_url(); ?>assets/images/logo.png"   /></td>
            </tr>
        </table></th>
      </tr>
      <tr>
        <th height="30" align="right" style="color:#FFF; padding-left:15px; font-weight:bold; font-size:16px; font-family:Arial, Helvetica, sans-serif;" ><a href="javascript:window.print()"><img src="<?php echo base_url(); ?>assets/images/print.png" width="20" height="19" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      </tr>
      <tr><td style="padding:0px 20px;">Dear <?php echo $book_det->fname." ".$book_det->lname; ?>, <br /><br />
Thanks you for booking with Akbartravel.us. Your booking has been accepted. On Approval/Clearance of your payment, we will send you another email with your e-ticket. This will take a maximum of 4 hours.
Akbartravels.us Reference number: 	<?php echo $book_det->booking_id; ?>.

<p>For any concerns / quries pertaining to this booking, We request you to quote this reference number in all your furture communications with us.</p>
<!-- For any further clarification on this booking, please feel free to contact our Customer support team on the above numbers or Email address: -->
Team Akbar Travels USA</td></tr>
      <tr>
        <th align="left" valign="top" class="firststylehead1">&nbsp;</th>
      </tr>
      <tr>
        <th align="left" valign="top" class="firststylehead1"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="font-size:13px;  font-family:Arial, Helvetica, sans-serif; font-weight:normal;" >
          <tbody>
            <tr>
              <th align="right" ><table style="border:1px #0d4c88 solid; " width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td width="180" height="20" align="left" bgcolor="#0d4c88" style=" font-weight:normal; font-size:12px; color:#FFF;"><strong>Travellers Information:</strong></td>
                  </tr>
                  <?php $i=1;
                  if(isset($all_passenegers)) { if($all_passenegers != '') { foreach($all_passenegers as $pass) { ?>
                <tr>
                  <td height="20" align="left" valign="top" style=" font-weight:normal; font-size:12px;"><?php echo $i; ?>) <?php echo $pass->salutation.". ".$pass->lname." ".$pass->fname; ?></td>
                  </tr>
                  <?php $i++; } } } ?>
              </table></th>
            </tr>
            <tr>
              <th align="left" >&nbsp;</th>
            </tr>
            <tr>
              <th width="155" align="left" ><table style="border:1px #be1313 solid; " width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td height="22" colspan="3" align="left" bgcolor="#be1313"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="color:#FFF;">Booking Information<?php /* ?>e-Ticket Receipt- <?php echo $book_det->PNR_Number; ?> - <?php echo $flight_det->airline_code; ?> <?php echo $flight_det->fnumber; ?>- <?php echo $flight_det->ddate; ?> - <?php echo $flight_det->dlocation; ?></span><?php */ ?></td>
                        <td align="right" style="color:#FFF;"><?php /* ?>Today's Date: <?php echo date('D, d M Y',strtotime(date('Y-m-d'))); ?><?php */ ?></td>
                      </tr>
                  </table></td>
                  </tr>
                <tr>
                  <td width="220" height="20" align="center" style=" border-right:1px solid #be1313; font-size:12px;">                    e-Ticket Number : <?php echo $book_det->PNR_Number; ?><br /></td>
                  <td width="250" align="center" style=" border-right:1px solid #be1313; line-height:18px;"><!-- Akbar Reservation<br /> 
                    Number: --><?php echo $book_det->booking_id; ?></td>
                  <td align="center" style=" border-right:1px solid #be1313; line-height:18px;">Ticket Issue Date: <?php echo date('D, d M Y',strtotime($book_det->creation_date)); ?></td>
                  </tr>
                
                </table></th>
            </tr>
            <tr>
              <th align="left" >&nbsp;</th>
            </tr>
            <?php //echo "<pre>"; print_r($flight_det); ?>
            <tr>
              <th align="left" ><table style="border:1px #0d4c88 solid; " width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td width="70" align="left" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">Dep. Date</td>
                  <td width="70" align="left" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">Dep. Time</td>
                  <td width="100" align="left" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">From</td>
                  <td width="100" align="left" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">To</td>
                  <td align="left" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">Flight No.</td>
                  <td align="left" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">Dep.Terminal</td>
                  <td align="left" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">Airline</td>
                  <td height="20" align="left" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="middle" style=" font-weight:bold; font-size:12px; color:#0d4c88; border-bottom:1px #6b9cca dashed; ">Onward</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td height="20" align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php 
					  if(strpos($flight_det->airline_code,'<br>'))
                                          {
                                              $dep_dateArr=explode('<br>',$flight_det->dep_date);
                                              $arv_dateArr=explode('<br>',$flight_det->arv_date);
                                              $d_dateArr=explode('<br>',$flight_det->ddate);
                                              $d_locationArr=explode('<br>',$flight_det->dlocation);
                                              $a_locationArr=explode('<br>',$flight_det->alocation);
                                              $f_numberArr=explode('<br>',$flight_det->fnumber);
                                              $airline_codeArr=explode('<br>',$flight_det->airline_code);
                                              $air_lineArr=explode('<br>',$flight_det->airline);
                                              
                                              $dep_date=$dep_dateArr[0];
                                              $arv_date=end($arv_dateArr);
                                              $d_date=$d_dateArr[0];
                                              $d_location=$d_locationArr[0];
                                              $a_location=end($a_locationArr);
                                              $f_number=$f_numberArr[0];
                                              $airline_code=$airline_codeArr[0];
                                              $air_line=$air_lineArr[0];
                                          }
                                          else
                                          {
                                              $dep_date=$flight_det->dep_date;
                                              $arv_date=$flight_det->arv_date;
                                              $d_date=$flight_det->ddate;
                                              $d_location=$flight_det->dlocation;
                                              $a_location=$flight_det->alocation;
                                              $f_number=$flight_det->fnumber;
                                              $airline_code=$flight_det->airline_code;
                                              $air_line=$flight_det->airline;
                                          }
                                          $dep = $dep_date;
					  $deps = explode('/',$dep);
					  $depss = "20".$deps[2]."-".$deps[1]."-".$deps[0];
					 // echo '<pre />';print_r($flight_det);echo $depss;die;
					  $ret = $arv_date;
					  $rets = explode('/',$ret);
					  $retss = "20".$rets[2]."-".$rets[1]."-".$rets[0];
					  
					  echo date('d M',strtotime($depss)); ?>
					  <?php $ddate = $d_date; 
						   $dtime = explode('(',$ddate);?>
						   </td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php echo substr($dtime[1],0,-1); ?></td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;">
				  <?php 	
				  			$dept = $this->Flights_Model->get_airportname($d_location);
				   ?>
                    <?php echo $dept->city."(".$dept->city_code.")"; ?></td>
                     <?php
                        $arrive = $this->Flights_Model->get_airportname($a_location); 
                     ?>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php echo $arrive->city."(".$arrive->city_code.")"; ?></td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php echo $airline_code.'-'.$f_number; ?></td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php echo $dept->city; ?></td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $airline_code; ?>.gif" width="80" height="29" border="0" /></td>
                  <td height="20" align="left" valign="middle" style=" font-weight:normal; border-bottom:1px #6b9cca solid;font-size:12px;"><?php $air_line; ?></td>
                </tr>
                 <?php if($flight_det->journey_type != 'OneWay') 
                 {		 
                    $return_flight = $this->Flights_Model->get_return_flightss($book_det->result_id); ?>
                <tr>
                  <td align="left" valign="middle" style=" font-weight:bold; font-size:12px; color:#0d4c88; border-bottom:1px #6b9cca dashed; ">Return</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td align="left" valign="top" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca dashed;">&nbsp;</td>
                  <td height="20" align="left" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca solid;">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php 
					  if(strpos($return_flight->airline_code,'<br>'))
                                          {
                                              $ret_dep_dateArr=explode('<br>',$return_flight->dep_date);
                                              $ret_arv_dateArr=explode('<br>',$return_flight->arv_date);
                                              $ret_d_dateArr=explode('<br>',$return_flight->ddate);
                                              $ret_d_locationArr=explode('<br>',$return_flight->dlocation);
                                              $ret_a_locationArr=explode('<br>',$return_flight->alocation);
                                              $ret_f_numberArr=explode('<br>',$return_flight->fnumber);
                                              $ret_airline_codeArr=explode('<br>',$return_flight->airline_code);
                                              $ret_air_lineArr=explode('<br>',$return_flight->airline);
                                              
                                              $ret_dep_date=$ret_dep_dateArr[0];
                                              $ret_arv_date=end($ret_arv_dateArr);
                                              $ret_d_date=$ret_d_dateArr[0];
                                              $ret_d_location=$ret_d_locationArr[0];
                                              $ret_a_location=end($ret_a_locationArr);
                                              $ret_f_number=$ret_f_numberArr[0];
                                              $ret_airline_code=$ret_airline_codeArr[0];
                                              $ret_air_line=$ret_air_lineArr[0];
                                          }
                                          else
                                          {
                                              $ret_dep_date=$return_flight->dep_date;
                                              $ret_arv_date=$return_flight->arv_date;
                                              $ret_d_date=$return_flight->ddate;
                                              $ret_d_location=$return_flight->dlocation;
                                              $ret_a_location=$return_flight->alocation;
                                              $ret_f_number=$return_flight->fnumber;
                                              $ret_airline_code=$return_flight->airline_code;
                                              $ret_air_line=$return_flight->airline;
                                          }
                  
                                          $dep = $ret_dep_date;
					  $deps = explode('/',$dep);
					  $depss = "20".$deps[2]."-".$deps[1]."-".$deps[0];
					  
					  $ret = $ret_arv_date;
					  $rets = explode('/',$ret);
					  $retss = "20".$rets[2]."-".$rets[1]."-".$rets[0];
					  
					  echo date('d M',strtotime($depss)); ?>
					  <?php $ddate = $ret_d_date; 
						   $dtime = explode('(',$ddate);?>
						   </td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php echo substr($dtime[1],0,-1); ?></td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php $dept = $this->Flights_Model->get_airportname($ret_d_location); ?>
                    <?php echo $dept->city."(".$dept->city_code.")"; ?></td>
                     <?php $arrive = $this->Flights_Model->get_airportname($ret_a_location); ?>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php echo $arrive->city."(".$arrive->city_code.")"; ?></td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php echo $ret_airline_code.'-'.$ret_f_number; ?></td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><?php echo $dept->city; ?></td>
                  <td align="left" valign="middle" style=" font-weight:normal; font-size:12px; border-bottom:1px #6b9cca solid;"><img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $ret_airline_code; ?>.gif" width="80" height="29" border="0" /></td>
                  <td height="20" align="left" valign="middle" style=" font-weight:normal; border-bottom:1px #6b9cca solid;font-size:12px;"><?php $ret_air_line; ?></td>
                </tr>
                <?php } ?>
                </table></th>
            </tr>
            <tr>
              <th align="left" >&nbsp;</th>
            </tr>
            <tr>
              <th colspan="3" align="left" ><table style="border:1px #be1313 solid; " width="100%" border="0" cellpadding="3" cellspacing="0">
                <tr>
                  <td width="450" align="left" bgcolor="#be1313"style="color:#FFF;">&nbsp;e-Ticket Numbers :</span></td>
                  <td width="450" height="22" align="left" bgcolor="#be1313"style="color:#FFF;">&nbsp;&nbsp;Booking Refrence :</span></td>
                  </tr>
                <tr>
                  <td align="left" valign="top" style="font-size:12px; font-weight:bold;"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                      <td style="color:#be1313; font-weight:bold;">Onward</td>
                    </tr>
                    <tr>
                      <td>NA</td>
                    </tr>
                   <?php 
                        if($flight_det->journey_type != 'OneWay')
                        {
                   ?>
                    <tr>
                      <td style="color:#be1313; font-weight:bold;">Return</td>
                    </tr>
                    <tr>
                      <td>NA</td>
                    </tr>
                   <?php 
                        }
                   ?>
                  </table></td>
                  <td height="20" align="left" valign="top" style=" font-size:12px; font-weight:normal;"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                      <td>AT Ref.</td>
                      <td>: Onward</td>
                    </tr>
                    <tr>
                      <td>Airline Ref. </td>
                      <td>: NA</td>
                    </tr>
                    <?php 
                        if($flight_det->journey_type != 'OneWay')
                        {
                   ?>     
                    <tr>
                      <td>AT Ref.</td>
                      <td>: Onward</td>
                    </tr>
                    <tr>
                      <td>Airline Ref. </td>
                      <td>: NA</td>
                    </tr>
                    <?php 
                        }
                    ?>
                  </table></td>
                  </tr>
               <!-- <tr>
                  <td height="20" colspan="4" align="left" style=" font-size:12px; font-weight:normal;">DEL TG BKK Q87.00Q7.50(TG CNX 123.24 TG BKK 123.24 )TG MNL Q66.50 263.59<br />
                    NUC671.07END ROE55.407 XT 147WO1461YM1231TS</td>
                  </tr>-->                <!--<tr>
                  <td align="left" style=" font-size:12px;">&nbsp;</td>
                  <td align="left" style=" font-size:12px;">&nbsp;</td>
                  <td align="left" style=" font-size:12px; font-weight:normal;">INR</td>
                  <td height="20" align="left" style=" font-size:12px;"><span style="font-weight:normal; color:#333; font-size:12px;"> 1839.00 JN</span></td>
                  </tr>
                <tr>
                  <td align="left" style=" font-size:12px; font-weight:normal">&nbsp;</td>
                  <td align="left" style=" font-size:12px; font-weight:normal">&nbsp;</td>
                  <td align="left" style=" font-size:12px; font-weight:normal">INR</td>
                  <td height="20" align="left" style=" font-size:12px; font-weight:normal">2839.00 XT</td>
                  </tr>-->
                </table></th>
            </tr>
            <tr>
              <th colspan="3" align="left" class="firststylehead1" >&nbsp;</th>
            </tr>
            <tr>
              <th colspan="3" align="left" style="font-size:12px;" ><table style="border:1px #0d4c88 solid; " width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td width="70" height="20" align="right" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">Pax</td>
                  <td width="100" align="right" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">Basic Fare</td>
                  <td width="100" align="right" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">Tax &amp; Charges </td>
                  <td width="100" align="right" bgcolor="#0d4c88" style="    font-weight:normal; font-size:12px; color:#FFF;">Discounts</td>
                  <td width="100" align="right" bgcolor="#0d4c88" style="font-weight:bold; font-size:12px; color:#FFF;">Total</td>
                  </tr>
                  <?php
                     $onward_basefare = ($flight_det->totalFareAmount_Price-$flight_det->totalTaxAmount_Price);
                     $onward_totalTaxAmount_Price = $flight_det->totalTaxAmount_Price;
                     $onward_total = $flight_det->totalFareAmount_Price;
                     
                     if($flight_det->journey_type != 'OneWay') 
                     {
                        $return_basefare = ($return_flight->totalFareAmount_Price-$return_flight->totalTaxAmount_Price);
                        $return_totalTaxAmount_Price = $return_flight->totalTaxAmount_Price;
                        $return_total = $return_flight->totalFareAmount_Price;
		     }
                     else
                     {
                            $return_basefare = '';
                            $return_totalTaxAmount_Price = '';
                            $return_total = '';
                     }
                   ?>
                <?php
                    $adultCount=0;
                    $childCount=0;
                    $infantCount=0;
                    foreach($all_passenegers as $paxDetail)
                    {
                        if($paxDetail->type=='Adult')
                        {
                            $adultCount++;
                        }
                        if($paxDetail->type=='Child')
                        {
                            $childCount++;
                        }
                        if($paxDetail->type=='Infant')
                        {
                            $infantCount++;
                        }
                    }
                ?>
                <tr>
                  <td height="20" align="right" valign="middle" style=" font-weight:bold; font-size:12px;  border-bottom:1px #6b9cca dashed; ">Adult X <?php echo $adultCount; ?></td>
                  <td align="right" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&#36;<?php echo $onward_basefare + $return_basefare; ?></td>
                  <td align="right" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&#36;<?php echo $onward_totalTaxAmount_Price + $return_totalTaxAmount_Price; ?></td>
                  <td align="right" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">-</td>
                  <td align="right" valign="top" style="font-weight:bold; font-size:12px; border-bottom:1px #6b9cca dashed;">&#36;<?php echo ($onward_total + $return_total); ?></td>
                </tr>
                
                <?php 
                    if($childCount>0)
                    {
                ?>
                    <tr>
                        <td height="20" align="right" valign="middle" style=" font-weight:bold; font-size:12px;  border-bottom:1px #6b9cca dashed; ">Child X <?php echo $childCount; ?></td>
                        <td align="right" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&#36;<?php echo $onward_basefare + $return_basefare; ?></td>
                        <td align="right" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&#36;<?php echo $onward_totalTaxAmount_Price + $return_totalTaxAmount_Price; ?></td>
                        <td align="right" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">-</td>
                        <td align="right" valign="top" style="font-weight:bold; font-size:12px; border-bottom:1px #6b9cca dashed;">&#36;<?php echo ($onward_total + $return_total); ?></td>
                    </tr>
                <tr>
                <?php
                    }
                ?>
                 <?php 
                    if($infantCount>0)
                    {
                ?>
                    <tr>
                        <td height="20" align="right" valign="middle" style=" font-weight:bold; font-size:12px;  border-bottom:1px #6b9cca dashed; ">Infant X <?php echo $infantCount; ?></td>
                        <td align="right" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&#36;<?php echo $onward_basefare + $return_basefare; ?></td>
                        <td align="right" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">&#36;<?php echo $onward_totalTaxAmount_Price + $return_totalTaxAmount_Price; ?></td>
                        <td align="right" valign="top" style=" font-weight:normal; font-size:12px;  border-bottom:1px #6b9cca dashed;">-</td>
                        <td align="right" valign="top" style="font-weight:bold; font-size:12px; border-bottom:1px #6b9cca dashed;">&#36;<?php echo ($onward_total + $return_total); ?></td>
                    </tr>
                <tr>
                <?php
                    }
                ?>
                  <td height="50" colspan="5" align="right" valign="middle" style=" font-weight:bold; font-size:12px; line-height:20px; ">
                    <span style="font-size:16px; color:#be1313;">NET PAYABLE : &#36;<?php echo ($onward_total + $return_total); ?></span></td>
                  </tr>
              </table></th>
            </tr>
            <tr>
              <th colspan="3" align="left" style="font-size:12px;" >&nbsp;</th>
            </tr>
            <tr>
              <th colspan="3" align="left" style="font-size:12px;" >+ BAGGAGE DISCOUNTS MAY APPLY BASED ON FREQUENT FLYER STATUS/ONLINE CHECKIN/FORM OF PAYMENT/MILITARY/ETC.</th>
            </tr>
            <tr>
              <th colspan="3" align="left" class="firststylehead1" >&nbsp;</th>
            </tr>
          </tbody>
        </table></th>
      </tr>
    </tbody>
  </table>
</div>

</div>
</div>




</body>
</html>
