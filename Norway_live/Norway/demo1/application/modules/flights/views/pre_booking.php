<?php //echo '<pre />';print_r($flightDetails);die; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> DEMO</title>
<!-- CSS --><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>

</head>

<script type="text/javascript" src="<?php print base_url()?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
    
     <!--###########DATE PICKER#############-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui1.css" />
    <!--###########DATE PICKER#############--->
<body>
<div>
<?php 
	if(isset($_SESSION['payment_gateway_error']) && $_SESSION['payment_gateway_error']=='error')
	{
		?>
        <script>
		alert('Payment gateway details are not correct. Please enter correct information !!!');
		</script>
<?php
$_SESSION['payment_gateway_error']='noerror';
	}
?>
</div>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('home/header1'); ?>
        <!--########################## HEADER INCLUDE ##############################-->
        <!--#################################### BODY CONTENT STARTS #################################################--->
       
        <form name="pre_booking" id="pre_booking" method="POST" action="#" class='form-horizontal form-validate' onsubmit="return b2clogincheck();">
        <div class="inner_wrapper">
            <!-- LEFT PART -->

            <div class="left_part"> 

                <!--############################ Flight Details AREA #########################-->
                <div class="left_header1_bg top20"><span class="left20">Flight Details</span></div>
                <div style="clear:both;"></div>
                <div class="lblue1_bg ">

                    <div> 
                        <div class=" traveller_blue_bg"><span class="left10" style="font-weight:bold;">Onward</span></div>

                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><div class="fleft" style="width:80px;">
                                <?php 
									$stops=$flightDetails->stops;
									if($flightDetails->stops==0)
									{ 
								?>
										<img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flightDetails->cicode; ?>.gif" />
                                <?php 
									}
									else
									{
										$cicode=explode('<br>',$flightDetails->cicode);
										$alocation=explode('<br>',$flightDetails->alocation);
										$fnumber=explode('<br>',$flightDetails->fnumber);
										$dlocation=explode('<br>',$flightDetails->dlocation);
										$ddate1=explode('<br>',$flightDetails->ddate1);
										
								?>
										<img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[0]; ?>.gif" />
                                <?php
									} 
                                 ?>
                            </div><span class="left20" style="text-align:left; margin-left:0px; "><?php echo $_SESSION['toCity']; ?>(<?php $stops=$flightDetails->stops; echo($flightDetails->stops==0 ? $flightDetails->alocation:$alocation[$stops]); ?>)
                                <br />
                                <span class="flight_booking_smalltxt left20" style="margin-left:0px; ">
								<?php
								    if($stops==0)
									 echo $flightDetails->cicode.' - '.$flightDetails->fnumber;
									else
									{
										for($l=0;$l<count($cicode);$l++)
										{
											 echo $cicode[$l].' - '.$fnumber[$l].'<br />';
										}
									}
								?>  
								</span></span></div>
                              
                             

                        <div class="top10" style="border-bottom:1px solid #ccc;"> </div>	
                        <div class=" traveller_blue_bg"><div class="left10 flight_booking_blue_txt" style="line-height:18px !important; padding:5px 0 5px 10px; margin:2px 0 2px 0; font-weight:bold; font-size:11px;">
							<?php
							 echo $_SESSION['fromCity']; ?>
							  (<?php $stops=$flightDetails->stops; echo($flightDetails->stops==0 ? $flightDetails->dlocation:$dlocation[$stops]); ?>)
							  <br /> <span style="font-weight:normal;">TO</span><br />
							   <?php echo $_SESSION['toCity']; ?> (<?php $stops=$flightDetails->stops; echo($flightDetails->stops==0 ? $flightDetails->alocation:$alocation[$stops]); ?>) </div></div>
                        <div  style="border-bottom:1px solid #ccc;"> </div>

                        <div class="top10 left10" style="font-size:11px; line-height:18px;">
                            <?php 
                                if($flightDetails->stops==0) echo 'Non-Stop';
                                else if($flightDetails->stops==1) echo 'One-Stop';
                                else 'Multi Stops';
                            ?>
                            <br />
                            <?php 
                                if($flightDetails->stops==0)
                                {
                                   // echo $flightDetails->ddate1;
								   $ddate1 = $flightDetails->ddate1;
									 $ddate2 = explode(' ',$ddate1);
									 echo $ddate2[1];
									 $ddate3 = explode('-',$ddate2[0]);
									 $dates = "20".$ddate3[2]."-".$ddate3[1]."-".$ddate3[0];
									 echo ", ".date('d D M, Y ', strtotime($dates));
									 ?>
                                     <input type="hidden" name="departure_date" id="departure_date" value="<?php echo $dates; ?>"  /> <?php
                                }
                                else
                                 {
									// echo $ddate1[0];
									 $ddate1 = $ddate1[0];
									 $ddate2 = explode(' ',$ddate1);
									 echo $ddate2[1];
									 $ddate3 = explode('-',$ddate2[0]);
									 $dates = "20".$ddate3[2]."-".$ddate3[1]."-".$ddate3[0];
									 echo ", ".date('d D M, Y ', strtotime($dates));
									 ?>
                                     <input type="hidden" name="departure_date" id="departure_date" value="<?php echo $dates; ?>"  />
                                     <?php
								 }
                            ?></div>
						<?php if($flightDetails->journey_types == "Round") { ?>
                              <div class="clear"></div>
                              <div class="clear"></div><div class="clear"></div>
                         <div class=" traveller_blue_bg"><span class="left10" style="font-weight:bold;">Return</span></div>

                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><div class="fleft" style="width:80px;">
                                <?php 
									$stops=$flight_details_return->stops;
									if($flight_details_return->stops==0)
									{ 
								?>
										<img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flight_details_return->cicode; ?>.gif" />
                                <?php 
									}
									else
									{
										$cicode=explode('<br>',$flight_details_return->cicode);
										$alocation=explode('<br>',$flight_details_return->alocation);
										$fnumber=explode('<br>',$flight_details_return->fnumber);
										$dlocation=explode('<br>',$flight_details_return->dlocation);
										$ddate1=explode('<br>',$flight_details_return->ddate1);
										
								?>
										<img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[0]; ?>.gif" />
                                <?php
									} 
                                 ?>
                            </div><span class="left20" style="text-align:left; margin-left:0px; "><?php echo $_SESSION['fromCity']; ?>(<?php $stops=$flight_details_return->stops; echo($flight_details_return->stops==0 ? $flight_details_return->alocation:$alocation[$stops]); ?>)
                                <br />
                                <span class="flight_booking_smalltxt left20" style="margin-left:0px; ">
								<?php
								    if($stops==0)
									 echo $flight_details_return->cicode.' - '.$flight_details_return->fnumber;
									else
									{
										for($l=0;$l<count($cicode);$l++)
										{
											 echo $cicode[$l].' - '.$fnumber[$l].'<br />';
										}
									}
								?>  
								</span></span></div>
                                
                                <div class="top10" style="border-bottom:1px solid #ccc;"> </div>	
                        <div class=" traveller_blue_bg"><div class="left10 flight_booking_blue_txt" style="line-height:18px !important; padding:5px 0 5px 10px; margin:2px 0 2px 0; font-weight:bold; font-size:11px;">
							<?php
							 echo $_SESSION['toCity']; ?>
							  (<?php $stops=$flight_details_return->stops; echo($flight_details_return->stops==0 ? $flight_details_return->dlocation:$dlocation[$stops]); ?>)
							  <br /> <span style="font-weight:normal;">TO</span><br />
							   <?php echo $_SESSION['fromCity']; ?> (<?php $stops=$flight_details_return->stops; echo($flight_details_return->stops==0 ? $flight_details_return->alocation:$alocation[$stops]); ?>) </div></div>
                        <div  style="border-bottom:1px solid #ccc;"> </div>
                        <div class="top10 left10" style="font-size:11px; line-height:18px;">
                            <?php 
                                if($flight_details_return->stops==0) echo 'Non-Stop';
                                else if($flight_details_return->stops==1) echo 'One-Stop';
                                else 'Multi Stops';
                            ?>
                            <br />
                            <?php 
                                if($flight_details_return->stops==0)
                                {
                                    //echo $flight_details_return->ddate1;
									$ddate1 = $flight_details_return->ddate1;
									 $ddate2 = explode(' ',$ddate1);
									 echo $ddate2[1];
									 $ddate3 = explode('-',$ddate2[0]);
									 $dates = "20".$ddate3[2]."-".$ddate3[1]."-".$ddate3[0];
									 echo ", ".date('d D M, Y ', strtotime($dates));
									 ?>
                                     <input type="hidden" name="return_date" id="return_date" value="<?php echo $dates; ?>"  /><?php
                                }
								
                                else
								{
									//echo $ddate1[0];
                                 $ddate1 = $ddate1[0];
								 $ddate2 = explode(' ',$ddate1);
								 echo $ddate2[1];
								 $ddate3 = explode('-',$ddate2[0]);
								 $dates = "20".$ddate3[2]."-".$ddate3[1]."-".$ddate3[0];
								 echo ", ".date('d D M, Y ', strtotime($dates));
								 ?>
                                 <input type="hidden" name="return_date" id="return_date" value="<?php echo $dates; ?>"  />
                                 <?php
								}
                            ?></div>
                            <?php } ?>
                    </div>
                </div>
                <!--############################ Flight details AREA  END#########################-->

                <!--############################ Fare details AREA #########################-->

            <div class="left_header1_bg top20"><span class="left20" >Fare Details</span></div>
                <div style="clear:both;"></div>
                <div class="lblue1_bg " style="padding-bottom:20px;">

                    <div> 
                        <div class=" traveller_blue_bg"><span class="left10" style="font-weight:bold;">Base Fare</span></div>

                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><span class="flight_booking_smalltxt">
                                <?php echo $_SESSION['adults']; ?> Adult<?php if($_SESSION['adults'] > 1) { ?>(s) <?php } ?>
                                <span id="base_fare_id" style="float:right; font-weight:bold; margin-right:10px;">&#36;<?php 
                                    if(isset($flight_details_return)) { 
                                        echo (($flightDetails->Adult_FareAmount-$flightDetails->Adult_TaxAmount) + ($flight_details_return->Adult_FareAmount-$flight_details_return->Adult_TaxAmount))*$_SESSION['adults'];
                                    }
                                    else
                                    {
                                        echo (($flightDetails->Adult_FareAmount-$flightDetails->Adult_TaxAmount)*$_SESSION['adults']);
                                    }?>
                                </span>
                                <?php if($_SESSION['childs']!=0){ ?><br />
                                <?php echo $_SESSION['childs']; ?> Child<?php if($_SESSION['childs'] > 1) { ?>(s) <?php } ?>
                                <span id="base_fare_id" style="float:right; font-weight:bold; margin-right:10px;">&#36;<?php 
                                    if(isset($flight_details_return)) { 
                                        echo (($flightDetails->Child_FareAmount-$flightDetails->Child_TaxAmount) + ($flight_details_return->Child_FareAmount-$flight_details_return->Child_TaxAmount))*$_SESSION['childs'];
                                    }
                                    else
                                    {
                                       echo (($flightDetails->Child_FareAmount-$flightDetails->Child_TaxAmount)*$_SESSION['childs']);
                                    }?>
                                </span>
                                <?php } if($_SESSION['infants']!=0){ ?><br />
                                <?php echo $_SESSION['infants']; ?> Infant<?php if($_SESSION['infants'] > 1) { ?>(s) <?php } ?>
                                <span id="base_fare_id" style="float:right; font-weight:bold; margin-right:10px;">&#36;<?php 
                                    if(isset($flight_details_return)) { 
                                        echo (($flightDetails->Infant_FareAmount-$flightDetails->Infant_TaxAmount) + ($flight_details_return->Infant_FareAmount-$flight_details_return->Infant_TaxAmount))*$_SESSION['infants'];
                                    }
                                    else
                                    {
                                        echo (($flightDetails->Infant_FareAmount-$flightDetails->Infant_TaxAmount)*$_SESSION['infants']);
                                    }?>
                                </span>
                                <?php } ?>
                           <?php /*?><span class="flight_booking_smalltxt left80">
                               <?php 
                                    if($flightDetails->stops==0)
                                    {
                                        $flightDetails->cicode.' - '.$flightDetails->fnumber;
                                    }
                                    else
                                    {
                                        for($l=0;$l<count($cicode);$l++)
										{
											 echo $cicode[$i].' - '.$fnumber[$l].'<br />';
										}
                                    }
                               ?>
                           </span><?php */?></span></div>

                        <div class="top10" style="border-bottom:1px solid #ccc;"> </div>	
                        <div class=" traveller_blue_bg"><div class="left10 flight_booking_blue_txt" style="line-height:18px !important; font-weight:bold; font-size:11px; font-family:Arial, Helvetica, sans-serif; padding:5px 0 5px 10px; margin:2px 0 2px 0; ">Taxes & other charges </div></div>

                        
                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><span class="flight_booking_smalltxt">
                                <?php echo $_SESSION['adults']; ?> Adult<?php if($_SESSION['adults'] > 1) { ?>(s) <?php } ?>
                                <span id="base_fare_id" style="float:right; font-weight:bold; margin-right:10px;">&#36;<?php 
                                    if(isset($flight_details_return)) { 
                                        echo (($flightDetails->Adult_TaxAmount) + ($flight_details_return->Adult_TaxAmount))*$_SESSION['adults'];
                                    }
                                    else
                                    {
                                        echo (($flightDetails->Adult_TaxAmount)*$_SESSION['adults']);
                                    }?>
                                </span>
                                <?php if($_SESSION['childs']!=0){ ?><br />
                                <?php echo $_SESSION['childs']; ?> Child<?php if($_SESSION['childs'] > 1) { ?>(s) <?php } ?>
                                <span id="base_fare_id" style="float:right; font-weight:bold; margin-right:10px;">&#36;<?php 
                                    if(isset($flight_details_return)) { 
                                        echo (($flightDetails->Child_TaxAmount) + ($flight_details_return->Child_TaxAmount))*$_SESSION['childs'];
                                    }
                                    else
                                    {
                                       echo (($flightDetails->Child_TaxAmount)*$_SESSION['childs']);
                                    }?>
                                </span>
                                <?php } if($_SESSION['infants']!=0){ ?><br />
                                <?php echo $_SESSION['infants']; ?> Infant<?php if($_SESSION['infants'] > 1) { ?>(s) <?php } ?>
                                <span id="base_fare_id" style="float:right; font-weight:bold; margin-right:10px;">&#36;<?php 
                                    if(isset($flight_details_return)) { 
                                        echo (($flightDetails->Infant_TaxAmount) + ($flight_details_return->Infant_TaxAmount))*$_SESSION['infants'];
                                    }
                                    else
                                    {
                                        echo (($flightDetails->Infant_TaxAmount)*$_SESSION['infants']);
                                    }?>
                                </span>
                                <?php } ?>
                           </span></div>
                        
                        
                        <div  style="border-bottom:1px solid #ccc; margin-top:5px;"> </div>
<!--                        <div class="left10 top10" style="font-size:11px; font-weight:normal; margin-top:5px;"><span class="flight_booking_smalltxt">Fee & Surcharge 

                                <span style="float:right; margin-right:10px; font-weight:bold" id="tax_id">&#36;<?php 
                                if(isset($flight_details_return)) 
                                { 
                                    echo ($flightDetails->TaxAmount + $flight_details_return->TaxAmount); 
                                }
                                else
                                {
                                    echo $flightDetails->TaxAmount;
                                }
                                ?>  </span></span>
                        </div>-->
                                
<!--                        <div  style="border-bottom:1px solid #ccc; margin-top:5px;"> </div>-->

                        <div class="red_txt left10 top10" style=" font-weight:bold;"><span class="fleft">Total</span><span id="total_fareamount" style="float:right; margin-right:10px; font-weight:bold">&#36;<?php 
                            if(isset($flight_details_return)) 
                            { 
                                echo ($flightDetails->Total_FareAmount + $flight_details_return->Total_FareAmount);
                            }
                            else
                            {
                                    echo $flightDetails->Total_FareAmount;
                            }
                            ?>
                            </span></div>
						<?php if($flightDetails->journey_types == "Round") { ?>
                        <input type="hidden" id="total_amount" value="<?php echo $flightDetails->Total_FareAmount + $flight_details_return->Total_FareAmount; ?>"  />
                        <input type="hidden" id="tax" value="<?php echo $flightDetails->TaxAmount + $flight_details_return->TaxAmount; ?>"  />
                         <input type="hidden" id="base_fare" value="<?php echo ($flightDetails->Total_FareAmount + $flight_details_return->Total_FareAmount) - ($flightDetails->TaxAmount + $flight_details_return->TaxAmount); ?>"  />
                        <?php } else { ?>
                        <input type="hidden" id="total_amount" value="<?php echo $flightDetails->Total_FareAmount; ?>"  />
                        <input type="hidden" id="tax" value="<?php echo $flightDetails->TaxAmount; ?>"  />
                        <input type="hidden" id="base_fare" value="<?php echo ($flightDetails->Total_FareAmount - $flightDetails->TaxAmount); ?>"  />
                        <?php } ?>
                    </div>
                </div>

                <!--############################ Fare details AREA  END #########################-->

                <!--############################ HOTEL DETAILS AREA #########################-->
                <?php /*?><div class="left_header1_bg top20"><span class="left20">Hotel deals in <?php  $tocityval = $this->session->userdata('tocityval'); 
             $city = explode('-',$tocityval);
		echo $city1 = $city[0];?></span></div><?php */?>
                <div style="clear:both;"></div>
                <?php /*?><div class="lblue1_bg ">
                    <?php if(isset($results)) { if($results != '') { foreach($results as $row) { 
						
						 if($row->hotelRating=='1.0' || $row->hotelRating=='1.5')
						$starRating=1;
						if($row->hotelRating=='2.0' || $row->hotelRating=='2.5')
							$starRating=2;
						if($row->hotelRating=='3.0' || $row->hotelRating=='3.5')
							$starRating=3;
						if($row->hotelRating=='4.0' || $row->hotelRating=='4.5')
							$starRating=4;
						if($row->hotelRating=='5.0' || $row->hotelRating=='5.5')
							$starRating=5;
						?>
					
					
                   
					<div class="wid80 fleft">
                        <img src="http://media.expedia.com<?php echo $row->thumbNailUrl; ?>" />
                    </div>
                    <div class="wid140 fleft"> <div class="left10" style="font-size:11px; font-weight:normal;"><?php echo $row->name; ?>, <?php echo $row->address1; ?></div>

                        <div class="left10"><div class="stars<?php echo $starRating; ?>"></div> </div>
                        <div class="left10 blue_txt2">&#36;<?php echo $row->lowRate; ?></div>
                    </div>
                    <div style="clear:both;" ></div>
                    <div class="top10" style="border-bottom:1px solid #ccc; margin-top:5px; margin-bottom:5px;"> </div>
					
					<?php } } } ?>
                </div><?php */?>

                <div >&nbsp;&nbsp;</div> <!--############################ HOTEL DETAILS AREA  END#########################-->

            </div>

            <!-- LEFT PART END -->

            <!-- RIGHT PART -->
            
            <div class="right_part top30" style="width:766px;">
                <div class="right_main_header">Traveller Details</div>

                <div class="right_main_bar top20" style="margin-top:10px;"  >
                    <div class="fleft left20">Passanger Details</div>
                    <div class="fright" style="margin-right:20px;">Adults 12+ yrs (1) </div> </div>
                <div class="clear"></div>

                <?php
              
                    $dlocArray=explode('<br>',$flightDetails->dlocation);
                    $alocArray=explode('<br>',$flightDetails->alocation);
                    $dloc=$dlocArray[0];
                    $aloc=end($alocArray);
                
                
                $query=$this->db->query($sql="select country from city_code_amadeus where city_code='".$dloc."'");
                $query1=$this->db->query($sql="select country from city_code_amadeus where city_code='".$aloc."'");
                //echo $query->countrycode.'<<<>>>';
                //$query1->countrycode;
                //die;
                $internationalCheck='false';
                if($query->num_rows()>0 && $query1->num_rows()>0)
                {
                    //echo 'hello';die;
                    $loc=$query->row();
                    $loc1=$query1->row();
                    $alocCountry=$loc->country;
                    $dlocCountry=$loc1->country;
                    if($alocCountry==$dlocCountry)
                    {
                        $internationalCheck='false';
                    }
                    else
                    {
                        $internationalCheck='true';
                        $countryQuery=$this->db->query($sql="select * from country where 1 order by name asc");
                    }
                }
                
            ?>
            <input type="hidden" name="internationalCheck" value="<?php echo $internationalCheck; ?>"  />
                <div class="detail_area top10">
                <div class="traveller_blue_bg" style="color:#0F4F8B; padding-left:10px; font-weight:bold;">  Adults 12+ yrs (<?php echo $_SESSION['adults'];?>)</div> 
                    <div class="traveller_blue_bg" style="color:#0F4F8B; padding-left:10px; background-color:#FFF; border-bottom:1px dashed #CCC; padding-bottom:2px;"><img src="<?php echo base_url(); ?>assets/images/alert.png" /> <strong>Please Note </strong>: Please make sure that the name entered is exactly as per traveller's passport.  Traveler age is calculated as per the travel date. </div> 
                    <?php 
                        for($i=0;$i<$_SESSION['adults'];$i++)
                        {
                            
                    ?>
                    <div class="Adults">
                    
                    <div  style="width:10px; background-color:#CEECFB; border-radius:50px; float:left; margin-top:7px; padding:7px 10px; margin-right:10px; font-size:12px; font-weight:bold; color:#0F4F8B;"><?php echo $i+1; ?>.</div>
                        
                        <div class="wid100 fleft" style="width:85px;"><label class="left10">Title:</label>
                            <select name="saladult[]" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:75px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;" >
                                <option value="">Select</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                            </select>
                        </div>

                        <div class="wid190 fleft"><label class="left10">First Name:</label><br />
                            <input name="lnameadult[]" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text"  /></div>
                            
                           

                        <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                            <input name="fnameadult[]" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text"  /></div>
                               <?php
                        if($internationalCheck=='true')
                        {
                    ?>
                    <div class="wid190 fleft" style="width:120px; margin-top:5px;"><label class="left10">Adult Birth Date:</label><br />
                    <input id="datepickerc_0<?php echo $i; ?>" class="search_input_box4 fleft validate[required]" type="text" style="width:100px" title="Dob"  value="" name="adobadult[]" />
                     </div>
                    <?php
						}
						?>
                     
                    <div style="clear:both;"></div>  
                      <?php
                        if($internationalCheck=='true')
                        {
                    ?>
<!--                    <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Middle Name:</label><br />-->
                    <input class="travller_inputbox178 fleft" type="hidden"  name="plname[]" value="" onpaste="return false;" colspan="2" />
<!--                    </div>-->
                    
                    
                    
                    <div class="wid190 fleft" style=" margin-top:5px;"><label class="left10">Place of Issue:</label><br />
                    <input type="text" class="travller_inputbox178 fleft validate[required]" name="Pcountry[]">
                    <?php /*?><select autocomplete="off" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:120px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;" name="Pcountry[]">
                        <option value="">Select Cousntry</option>
                    <?php 
                        if($countryQuery->num_rows()>0)
                        {
                            $countryList=$countryQuery->result_array();
                            foreach($countryList as $clist)
                            {
                    ?>
                                <option value="<?php echo $clist['name']; ?>"><?php echo $clist['name']; ?></option>
                    <?php
                            }
                        }
                    ?>
                    </select><?php */?>
                    </div>
                    
                    <div class="wid190 fleft" style="width:120px; margin-top:5px;"><label class="left10">Passport Number:</label><br />
          <input class="travller_inputbox178 fleft" type="text" name="passportadult[]"  value="" />
          </div>
          
          <div style="clear:both"></div>
          <div class="wid190 fleft" style="width:200px; margin-top:5px;"><label class="left10">Visa Number:</label><br />
                    <input class="travller_inputbox178 fleft" type="text"  name="visaadult[]"  value="" />
                    </div>
                    
                     <div class="wid190 fleft" style="width:200px; margin-top:5px;"><label class="left10">Passport Expiry Date:</label><br />
                    <input id="passport_expiry<?php echo $i; ?>" class="search_input_box4 fleft" type="text" title="Dob"  value="" style="width:100px" name="pexpiry[]" />
                    </div>
                    
                    <div style="clear:both;"></div>
                    </div>
                    <?php
                        }
                        else
                        {
                    ?>
                    </div>
                    <div style="clear:both;"></div>
                    <?php
                        }
                    }
                    ?>
                    
                    <?php
                        if($_SESSION['childs'] > 0)
                        {
                   ?>
                            <div class="traveller_blue_bg" style="color:#0F4F8B; padding-left:10px; border-bottom:1px #CCC dashed; font-weight:bold; ">  Child 2-11 yrs (<?php echo $_SESSION['childs']; ?>) </div>
                   <?php
                            for($c=0;$c<$_SESSION['childs'];$c++)
                            {
                    ?>
                        
                        <div class="Adults">
                        <div  style="width:10px; background-color:#CEECFB; border-radius:50px; float:left; margin-top:7px; padding:7px 10px; margin-right:10px; font-size:12px; font-weight:bold; color:#0F4F8B;"><?php echo $c+1; ?>.</div>
                            <div class="wid100 fleft" style="width:85px;"><label class="left10">Title:</label>
                                <select name="salchild[]" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:75px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;" >
                                    <option value="">Select</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                </select>
                            </div>

                            <div class="wid190 fleft"><label class="left10">First Name:</label><br />
                                <input name="lnamechild[]" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text"  /></div>

                            <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                                <input name="fnamechild[]" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text"  /></div>
                                
                            <div class="wid190 fleft"><label class="left10">Date Of Birth:</label><br />
                                <input name="adobchild[]" class="search_input_box4 validate[required]" id="adobchild<?php echo $c; ?>" type="text"  style="border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;" /></div>    
                        
                        <?php
                        if($internationalCheck=='true')
                        {
                        ?>
<!--                        <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Middle Name:</label><br />-->
                            <input type="hidden" class="travller_inputbox178 fleft" name="plnamechild[]" value="" onpaste="return false;" colspan="2" />
<!--                            </div>-->
                            <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Place of Issue:</label><br />
                           
                             <input type="text" class="travller_inputbox178 fleft validate[required]" name="Pcountrychild[]">
                            <?php /*?><select autocomplete="off" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:155px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;" name="Pcountrychild[]">
                                <option value="">Select Country</option>
                                <?php 
                                    if($countryQuery->num_rows()>0)
                                    {
                                        $countryList=$countryQuery->result_array();
                                        foreach($countryList as $clist)
                                        {
                                ?>
                                            <option value="<?php echo $clist['name']; ?>"><?php echo $clist['name']; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select><?php */?></div>
                            <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Passport Number:</label><br />
                            <input class="travller_inputbox178 fleft validate[required]"  type="text" name="passportchild[]" value="" onpaste="return false;" /></div>
                            <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Visa Number:</label><br />
                            <input class="travller_inputbox178 fleft validate[required]"  type="text" name="visachild[]" value="" onpaste="return false;" /></div>
                            <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Passport Expiry Date:</label><br />
                            <input id="child_passport_exp<?php echo $c; ?>" class="search_input_box4 validate[required]" type="text" style="width:130px" title="Dob"  value="" name="pexpirychild[]" /></div>
                      </div>
                    <?php 
                        }
                        else
                        {
                   ?>
                    </div>
                   <?php
                        }
                    ?>
                    <?php 
                            }
                        }
                    ?>
                  
                    
                    <?php
                        if($_SESSION['infants'] > 0)
                        {
                    ?>
                            <div class="traveller_blue_bg" style="color:#0F4F8B; padding-left:10px; border-bottom:1px #CCC dashed; font-weight:bold; ">  Infant 0-2 yrs (<?php echo  $_SESSION['infants'] ; ?>) </div>
                    <?php
                            for($c=0;$c<$_SESSION['infants'];$c++)
                            {
                    ?>
                     <div style="clear:both;"></div>
                        <div class="Adults">
                         <div  style="width:10px; background-color:#CEECFB; border-radius:50px; float:left; margin-top:7px; padding:7px 10px; margin-right:10px; font-size:12px; font-weight:bold; color:#0F4F8B;"><?php echo $c+1; ?>.</div>
                            <div class="wid100 fleft" style="width:85px;"><label class="left10">Title:</label>
                                <select name="salinfant[]" class="search_input_box2 fleft validate[required]"  style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:75px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;" >
                                    <option value="">Select</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                </select>
                            </div>

                            <div class="wid190 fleft"><label class="left10">First Name:</label><br />
                                <input name="lnameinfant[]" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text"  /></div>

                            <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                                <input name="fnameinfant[]" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text"  /></div>
                                
                            <div class="wid190 fleft"><label class="left10">Date Of Birth:</label><br />
                                <input name="adobinfant[]" class="search_input_box4 validate[required]" id="adobinfant<?php echo $c; ?>" type="text" style="border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;"   /></div>
                        </div>
                        <?php
                        if($internationalCheck=='true')
                        {
                        ?>
<!--                        <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Middle Name:</label><br />-->
                            <input class="travller_inputbox178 fleft" type="hidden" name="plnameinfant[]" value="" onpaste="return false;" colspan="2" />
<!--                            </div>-->
                           <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Place of Issue:</label><br />
                             <input type="text" class="travller_inputbox178 fleft validate[required]" name="Pcountryinfant[]">
                           <?php /*?><select autocomplete="off" class="search_input_box2 fleft validate[required]"  style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:135px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;" name="Pcountryinfant[]">
                                <option value="">Select Country</option>
                                <?php 
                                    if($countryQuery->num_rows()>0)
                                    {
                                        $countryList=$countryQuery->result_array();
                                        foreach($countryList as $clist)
                                        {
                                ?>
                                            <option value="<?php echo $clist['name']; ?>"><?php echo $clist['name']; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select><?php */?></div>
                            <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Passport Number:</label><br />
                            <input class="travller_inputbox178 fleft validate[required]" type="text" name="passportinfant[]" value="" />
                            </div>
                            
                            <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Visa Number:</label><br />
                            <input class="travller_inputbox178 fleft validate[required]" type="text" name="visainfant[]" placeholder="" value="" />
                            </div>
                            <div class="wid190 fleft" style="margin-top:5px;"><label class="left10">Passport Expiry Date:</label><br />
                            <input id="infant_passport_expiry<?php echo $c; ?>" class="search_input_box4 validate[required]" type="text" style="width:130px" title="Dob" value="" name="pexpiryinfant[]" />
                            </div>
                            
                        <?php 
                        }
                        ?>
                    <?php 
                            }
                        }
                    ?>
                    <input type="hidden" name="result_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="rand_id" value="<?php echo $rand_id; ?>">
                </div>
                <div class="clear"></div>

                <div class="right_main_bar top20" style="margin-top:13px;">
                    <div class="fleft left20">Contact Details</div>
                </div>
                <div class="clear"></div>
				<?php  if(isset($_SESSION['user_email'])) { if($_SESSION['user_email'] != '') { $contact_det = $this->Flights_Model->get_contactdetails($_SESSION['user_email']); } }
				if($this->session->userdata('customer_id') != '' ) {
                    $contact_det= $this->Home_Model->getcustomerdet($this->session->userdata('customer_id')); }//echo "<pre>"; print_r($contact_det);
				 ?>
				
                <div class="detail_area top10">

                    <div class="top10">
                        <div class="wid100 fleft" style="width:85px;"><label class="left10">Title:</label>
                            <select name="user_title" class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:75px; padding:5px; font-size:11px;"  >
                                <option value="">Select</option>
                                <option value="Mr" <?php if(isset($contact_det)) { if($contact_det->title != '') { if($contact_det->title == 'Mr') { echo "selected"; } } } ?>>Mr</option>
                                <option value="Mrs" <?php if(isset($contact_det)) { if($contact_det->title != '') { if($contact_det->title == 'Mrs') { echo "selected"; } } } ?>>Mrs</option>
                            </select>
                        </div>

                        <div class="wid190 fleft"><label class="left10">First Name:</label><br />
                            <input name="user_fname" value="<?php if(isset($contact_det)) { if($contact_det->firstname != '') { echo $contact_det->firstname; }} ?>" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text"  /></div>

                        <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                            <input name="user_lname" value="<?php if(isset($contact_det)) { if($contact_det->lastname != '') { echo $contact_det->lastname; }} ?>"  class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text" /></div>

                        <div class="clear"></div>
                        <div class="top10">
                            <label class="left10">Address</label><br />
                            <textarea name="user_address" rows="2" style="border:1px solid #aacde6; border-radius:5px; width:475px;" class="validate[required]"  ><?php if(isset($contact_det)) { if($contact_det->address != '') { echo $contact_det->address; }} ?></textarea></div>
                        <div class="top10">
                            <div class="wid190 fleft"><label class="left10">City:</label><br />
                                <input name="user_city"  value="<?php if(isset($contact_det)) { if($contact_det->city != '') { echo $contact_det->city; }} ?>" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text"  />
                            </div>
                            <div class="wid190 fleft"><label class="left10">Pin Code:</label><br />
                                <input name="user_pincode" class="travller_inputbox178 fleft" type="text" value="<?php if(isset($contact_det)) { if($contact_det->zip != '') { echo $contact_det->zip; }} ?>"  /></div>
                            <div class="wid190 fleft"><label class="left10">State:</label><br />
                                <input name="user_state"  value="<?php if(isset($contact_det)) { if($contact_det->state != '') { echo $contact_det->state; }} ?>" class="travller_inputbox178 fleft validate[required]" type="text"   /></div>
                        </div> 
                        <div class="clear"></div>
                        <div class="top10"><div class="wid190 fleft"><label class="left10">Country:</label><br />
                                <input name="user_country" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" value="<?php if(isset($contact_det)) { if($contact_det->country != '') { echo $contact_det->country; }} ?>" type="text"  /></div>
                            <div class="wid190 fleft"><label class="left10">E-mail:</label><br />
                                <input name="user_email" readonly="readonly" class="travller_inputbox178 fleft validate[required,custom[email]]" type="text" value="<?php echo(isset($_SESSION['guest_email']) ? $_SESSION['guest_email'] : $_SESSION['user_email']) ?>"  /></div>
                            <div class="wid190 fleft"><label class="left10">Mobile:</label><br />
                                <input name="user_mobile" class="travller_inputbox178 fleft validate[required,custom[phone]]" value="<?php if(isset($contact_det)) { if($contact_det->mobile != '') { echo $contact_det->mobile; }} ?>" type="text" /></div>
                        </div>

                        <div class="clear"></div>
                        <div class="traveller_blue_bg top10"><input name="user_update" type="checkbox" value=""  class="fleft" style="margin-top:8px;"/><div style="color:#0F4F8B; padding-left:10px;">Update my profile with this contact details. for flight </div></div>
                    </div>                      
                </div>
                <div class="clear"></div>

                <div class="flight_booking_bluebg top10">
                    <div  style="color:#fff; padding-left:10px; font-weight:bold;">Redeem your coupon / promo code here :&nbsp;
                        <input name="promo_code" id="promo_code" type="text" class="travller_inputbox284" />

                        <span class="book_btn fleft " style="width:70px; margin-top:0px; height:auto; padding:5px 0px; background:url(<?php echo base_url(); ?>assets/images/orangebg.jpg) repeat;" onclick="check_promocode();">REDEEM</span>
                    </div>
                </div>
                <script type="text/javascript">
					function check_promocode()
					{
						var promo_code = $('#promo_code').val();
						var total_amount = $('#total_amount').val();
						var departure_date = $('#departure_date').val();
						var return_date = $('#return_date').val();
						var tax = $('#tax').val();
						var base_fare = $('#base_fare').val();
						if(promo_code != '')
						{
							$.ajax
							({
								 type: "POST",
								 url: "<?php echo site_url(); ?>/flights/get_promo_values",
								 data: "promo_code="+promo_code+"&total_amount="+total_amount+"&departure_date="+departure_date+"&return_date="+return_date+"&tax="+tax+"&base_fare="+base_fare,
								 dataType: "json",
								 success: function(data)
								 {
									 if(data != '') {
									//$("#total_fareamount").html(msg);
									$('#total_fareamount').text(data.total_amount);
									$('#total_fareamount2').text(data.total_amount);
									$('#base_fare_id').text(data.base_fare);
									$('#tax_id').text(data.tax);
									}
								}
							});
						}
					}
				</script>
                <div class="clear"></div>
                <div class="right_main_bar top10">
                    <div class="fleft left20"> &nbsp;Proceed to Payment</div>
                </div>
                <div class="detail_area top10" style="padding-bottom:40px;">

                    <div class="top10 left10" style="margin-left:10px;">
                        <div class="flight_booking_header1" style="font-size:13px; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">Credit Card Details </div>
                         

                        <div class="top20 left50" style="margin-left:0px; margin-top:0px;">
                            <div class="fleft top20 wid170" style="text-align:right;">Name of the Credit card:</div> <div class="wid190 fleft left10"><label class="left10">First Name:</label><br />
                                <input name="cardfirst_name" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]"  type="text" /></div> <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                                <input name="cardlast_name" class="travller_inputbox178 fleft validate[required,custom[onlyLetterSp]]" type="text" /></div>

                            <div class="clear"></div> 

                            <div class="fleft top20 wid170" style="text-align:right; margin-top:16px;">Billing address (line 1): </div> <div class="wid190 fleft left10">
                                <input name="billing_address" class="travller_inputbox284 fleft top10 validate[required]" type="text" /></div> 

                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right; margin-top:16px;">Billing address (line 2):  </div> <div class="wid190 fleft left10">
                                <input name="billing_address2" class="travller_inputbox284 fleft top10" type="text" /></div> 

                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right; margin-top:16px;">City:  </div> <div class="wid190 fleft left10">
                                <input name="card_city" class="travller_inputbox284 fleft top10 validate[required]" type="text" /></div> 

                            <div class="clear"></div>  
							<?php //$country = $this->Flights_Model->get_countries(); ?>
                            <div class="fleft top20 wid170" style="text-align:right; margin-top:16px;">Country:  </div> <div class="wid190 fleft left10">
                                <select name="card_country"class="search_input_box2 validate[required]" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:200px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px; margin-top:10px;">
                                <option value="">Select</option>
                                <option value="USA">United States Of America</option>
                                <option value="CAN">Canada</option>
								
                                </select></div> 

                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right; margin-top:16px;">Postel Code / Zip:  </div> <div class="wid190 fleft left10">
                              <input name="input" class="travller_inputbox284 fleft top10 validate[required]" type="text" style="width:100px;" />
                          </div> 

                            <div class="clear"></div>  

<div class="fleft top20 wid170" style="text-align:right;  margin-top:16px;">Creadit Card No:  </div> <div class="wid190 fleft left10">
                                <input name="card_number" id="card_number" class="valid travller_inputbox284 fleft top10 validate[required,custom[card_validation_v2]]" type="text" style="width:180px;" />
                                <div class="fleft top10 left10"  style="margin-top:0px;"> <ul class="cards">
        <li class="visa">Visa</li>
        <li class="visa_electron">Visa Electron</li>
        <li class="mastercard">MasterCard</li>
        <li class="amex">Amex</li>
      </ul></div> 
                                </div> 
<div class="clear"></div>
  <input type="hidden"  class =" validate[required] " id="card_valid_number" name="card_valid_number"  />
    <input type="hidden"  class=" validate[required] " id="card_type" name="card_type"  />
                           <?php /*?> <div class="fleft top20 wid170" style="text-align:right;  margin-top:16px;">Credit Cart Type:  </div> <div class="wid190 fleft left10">
                            
                                 <select id="card_type" name="card_type" class="search_input_box2 validate[required]"  style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:200px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px; margin-top:10px;">
                                <option value="">Select</option>
                                <option value="MC">Master Card</option>
                                <option value="VI">Visa</option>
                                <option value="VE">Visa Electron</option>
                                <option value="AX">American Express</option>
                                </select></div><?php */?> 

                            <div class="clear"></div>  
                            
<script type="text/javascript">
function show_fare_summary(id){

      var moveLeft = 20;
     var moveDown = 10;
        $('#pop-up'+id).show(); 
		 $('#pop-up'+id).css({"position": "absolute",
        "width": "215px",
        "padding": "10px",
        "background":"#F3F8FA",
        "color": "#000000",
       " border": "1px solid #1C9BD1",
       " font-size": "90%"
			});       
		 $('#trigger'+id).mousemove(function(e) {
			   $('#pop-up'+id).css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
													});                           
                                                                                                           
 }
 
 function hide_fare_summary(id){
     
        $('#pop-up'+id).hide(); 
		                                                           
 }
 </script>
					<style type="text/css">
   
								a {
									color: #3875b9;
									text-decoration:none;
								  }
								  a:hover {
									  color:#09a60f;
								  }
								  div#pop-up1 {
									display: none;
									position: absolute;
									width: 270px;
									height:80px;
									background: #fff;
									color: #000000;
									border: 1px solid #CCC;;
								  }
								  </style>
                            <div class="fleft top20 wid170" style="text-align:right;  margin-top:16px;">CVV No:  </div> <div class=" fleft left10">
                                <input name="card_cvv" class="travller_inputbox77 fleft top10 validate[required,custom[onlyNumberSp]]" type="password" id="cvv" maxlength='4'/></div> <div class="top20 left10"><a href="#" class="travller_blue_txt" id="trigger1" style="background-image:none; margin-left:5px;" onMouseOver="show_fare_summary(1)" onMouseOut="hide_fare_summary(1)">What is this? </a></div>
<div id="pop-up1">
	<div style="color:#FFF; background-color:#0d4c88; padding-left:10px; padding-top:8px; font-weight:bold; font-size:14px; height:25px;"> <strong>CVV Number</strong></div>
	<div style="color:#fff; padding-left:10px; padding-top:3px; padding-bottom:3px; font-weight:normal; font-size:11px; height:18px; line-height:17px;">
	Card Verification Value Code
The security code is the last
3 Digits Printed on the signature
panel on the BACK of your card 
	</div></div>
                                    
                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right;  margin-top:16px;">Card Expiry Date:  </div> <div class=" fleft left10">
                                <select name="exp_year" class="search_input_box2 validate[required] top10" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:99px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;" >
                                <option value="">Select Year</option>
                                <?php for($i=14; $i<=20; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                                </select> </div> <div class="fleft top20 left20">/</div> <div class="wid190 fleft left20">
                                <select name="exp_month" class="search_input_box2 validate[required] top10" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; width:110px; padding:5px; font-size:11px; border: 1px solid #AACDE6;border-radius: 4px; font-size: 12px; height: 24px; padding: 0 5px;" >
                                <option value="">Select Month</option>
                                <option value="01">01</option>
                               <option value="02">02</option>
                               <option value="03">03</option>
                               <option value="04">04</option>
                               <option value="05">05</option>
                               <option value="06">06</option>
                               <option value="07">07</option>
                               <option value="08">08</option>
                               <option value="09">09</option>
                               <option value="10">10</option>
                               <option value="11">11</option>
                               <option value="12">12</option>
                                </select></div>
                        </div>



                    </div>

                </div>

                <div >  

                    <div class="fright top20" style="text-align:right; ">Total you need to pay : <span class="red_txt" id="total_fareamount2" style="font-size:20px; font-weight:bold;">&#36;<?php 
                            if(isset($flight_details_return->Total_FareAmount))
                            {
                                echo ($flightDetails->Total_FareAmount + $flight_details_return->Total_FareAmount); 
                            }
                            else
                                echo ($flightDetails->Total_FareAmount); 
                        ?> </span>
                        <div>Click the button below to make the payment & complete your booking</div>

                        <button class="flight_booking_redbtn top10" style="margin-bottom:10px;">MAKE PAYMENT</button>
                    </div>
                </div>
            </div>
            <?php 
                            if(isset($flight_details_return->Total_FareAmount))
                            {
                                $amount = ($flightDetails->Total_FareAmount + $flight_details_return->Total_FareAmount); 
                            }
                            else
                                $amount = ($flightDetails->Total_FareAmount); 
                        ?>
                        <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
            </form>
        </div>

        <!-- RIGHT PART END -->


</div>
    <!--#################################### BODY CONTENT ENDS ###################################################--->
    <!--########################## FOOTER INCLUDE ##############################-->
    <?php $this->load->view('home/footer'); ?>
    <!--########################## FOOTER INCLUDE ##############################-->               
</body>

      
</html>
 <script class="secret-source">
		$(document).ready(function(){
			$("#pre_booking").validationEngine();
	});
  
    </script>

              
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    function zeroPad(num, count)
    {
        var numZeropad = num + '';
        while (numZeropad.length < count) {
            numZeropad = "0" + numZeropad;
        }
        return numZeropad;
    }
    
    function dateADD(currentDate)
    {
        var valueofcurrentDate = currentDate.valueOf() + (24 * 60 * 60 * 1000);
        var newDate = new Date(valueofcurrentDate);
        return newDate;
    }
    var holydays = ['14-01-2014', '15-01-2014', '16-01-2014'];
	function highlightDays(date) {
		//alert("hii");
    for (var i = 0; i < 3; i++) {
        if (new Date(holydays[i]).toString() == date.toString()) {
			//alert("hi");
            return [true, 'highlight'];
        }
    }
    return [true, ''];

}
var holydays = ['01/01/2014','01/20/2014','02/17/2014','05/26/2014','07/04/2014','09/01/2014','10/13/2014','11/11/2014','11/27/2014','12/25/2014'];
var tips  = ['New Year','Martin Luther King Day','Presidents Day (Washington Birthday)','Memorial Day','Independence Day','Labor Day','Columbus Day','Veterans Day','','Christmas']; 
function highlightDays(date) {
   
    for (var i = 0; i < holydays.length; i++) {
        if (new Date(holydays[i]).toString() == date.toString()) {
            return [true, 'highlight',tips[i]];
        }
    }
    return [true, ''];

}
    $(function() {
		<?php for($c=0; $c<$_SESSION['childs']; $c++) { ?>
        $( "#adobchild<?php echo $c; ?>" ).datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            yearRange: '-100y:c+nn',
            maxDate: '-1d',
			firstDay: 1,
			changeMonth : true,
            changeYear : true,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        <?php } ?>
		
		<?php for($i=0; $i<$_SESSION['infants']; $i++) { ?>
        $( "#adobinfant<?php echo $i; ?>" ).datepicker({
           numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            yearRange: '-100y:c+nn',
            maxDate: '-1d',
			firstDay: 1,
			changeMonth : true,
            changeYear : true,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        <?php } ?>
       <?php for($c=0; $c<$_SESSION['adults']; $c++) { ?>
        $( "#datepickerc_0<?php echo $c; ?>" ).datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            yearRange: '-100y:c+nn',
            maxDate: '-1d',
			firstDay: 1,
			changeMonth : true,
            changeYear : true,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        <?php } ?>
		 <?php for($c=0; $c<$_SESSION['adults']; $c++) { ?>
        $( "#passport_expiry<?php echo $c; ?>" ).datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
           	minDate: 1,
			firstDay: 1,
			changeMonth : true,
            changeYear : true,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        <?php } ?>
		<?php for($c=0; $c<$_SESSION['childs']; $c++) { ?>
        $( "#child_passport_exp<?php echo $c; ?>" ).datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
           	minDate: 1,
			firstDay: 1,
			changeMonth : true,
            changeYear : true,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        <?php } ?>
		<?php for($c=0; $c<$_SESSION['infants']; $c++) { ?>
        $( "#infant_passport_expiry<?php echo $c; ?>" ).datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
           	minDate: 1,
			firstDay: 1,
			changeMonth : true,
            changeYear : true,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        <?php } ?>
    });
   
   
</script>

<!--Credit card validation-->

<!-- CSS --><link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/creditcard_validation/creditCardValidator.css" type="text/css"/>

<script src="<?php print base_url()?>assets/js/creditcard_validation/jquery.creditCardValidator.js" type="text/javascript"></script>
<script>
// Generated by CoffeeScript 1.4.0
(function() {
$(function() {
$(".demo .numbers li").wrapInner('<a href="#"></a>').click(function(e) {
e.preventDefault();
return $("#card_number").val($(this).text()).trigger("input")
}
);
$(".vertical.maestro").hide().css( {
opacity:0
}
);
return $("#card_number").validateCreditCard(function(e) {
if(e.card_type==null) {
$(".cards li").removeClass("off");
$("#card_number").removeClass("valid");
$(".vertical.maestro").slideUp( {
duration:200
}
).animate( {
opacity:0
}, {
queue:!1, duration:200
}
);
return
}

if(e.card_type.name == 'visa')
{
	$("#card_type").val("VI");
	//document.getElementById('card_type').getElementsByTagName('option')[2].selected = 'selected'
}
if(e.card_type.name == 'visa_electron')
{
	$("#card_type").val("VI");
	//document.getElementById('card_type').getElementsByTagName('option')[3].selected = 'selected'
}
if(e.card_type.name == 'mastercard')
{
	$("#card_type").val("MC");
	//document.getElementById('card_type').getElementsByTagName('option')[1].selected = 'selected'
}
if(e.card_type.name == 'amex')
{
	$("#card_type").val("AX");
	//document.getElementById('card_type').getElementsByTagName('option')[4].selected = 'selected'
}
$(".cards li").addClass("off");
$(".cards ."+e.card_type.name).removeClass("off");
e.card_type.name==="maestro"?$(".vertical.maestro").slideDown( {
duration:200
}
).animate( {
opacity:1
}, {
queue:!1
}
):$(".vertical.maestro").slideUp( {
duration:200
}
).animate( {
opacity:0
}, {
queue:!1, duration:200
}
);
if(e.length_valid&&e.luhn_valid)
{
	$("#card_valid_number").val("ok");
}
else
{
	$("#card_valid_number").val("");
}
return e.length_valid&&e.luhn_valid?$("#card_number").addClass("valid"):$("#card_number").removeClass("valid")
}, {
accept:["visa", "visa_electron", "mastercard", "maestro", "amex"]
}
)

}
)
}
).call(this);


</script>
