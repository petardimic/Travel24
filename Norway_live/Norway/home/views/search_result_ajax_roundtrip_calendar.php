<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Norway</title>
        <meta name="description" content="Full view calendar component for twitter bootstrap with year, month, week, day views.">
        <meta name="keywords" content="jQuery,Bootstrap,Calendar,HTML,CSS,JavaScript,responsive,month,week,year,day">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="<?php print WEB_DIR ?>css/1200.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/980.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/979.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/979-768.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/767.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/480.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/bootstrap.css" rel="stylesheet"> 
        <!--<link href="css/bootstrap.min.css" rel="stylesheet">--> 
        <link href="<?php print WEB_DIR ?>css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="<?php print WEB_DIR ?>css/custom.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/date/kendo.common.min.css" rel="stylesheet" />
        <link href="<?php print WEB_DIR ?>css/date/kendo.default.min.css" rel="stylesheet" />
        <link href="<?php print WEB_DIR ?>css/responsive-calendar.css" rel="stylesheet">
        <link href="<?php print WEB_DIR ?>css/less/responsive-calendar.less" rel="stylesheet">
        <link href="<?php print WEB_DIR ?>css/calendar.css" rel="stylesheet">
        <link href="<?php print WEB_DIR ?>css/jquery.css" rel="stylesheet">
        <script type="text/javascript" src="<?php print WEB_DIR ?>js/Jquery.ui.js"></script>
         <script type="text/javascript" src="<?php print WEB_DIR ?>js/jquery.new.js"></script>
        <script type="text/javascript" src="<?php print WEB_DIR ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="<?php print WEB_DIR ?>images/img/favicon.png">
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"> 
		 
</script>
</head>
<?php 
	//echo '<pre/>';print_r($flight_result);
	$r=0;
	foreach($flight_result['oneway'] as $testing_oneway)
	{
		$result_oneway[$r++]=$testing_oneway;
	}
	$r=0;
	foreach($flight_result['Return'] as $testing_return)
	{
		$result_return[$r++]=$testing_return;
	}
	if(!empty($result_oneway))
	{
		$id=$result_oneway[0]['rand_id'];
		$curr_code=$result_oneway[0]['ccode'];
		$lowest_price=$result_oneway[0]['Total_FareAmount'];
		$date_sess_sd=$_SESSION[$id]['sd'];
		$date_sess_ed=$_SESSION[$id]['ed'];
		$passenger_count=$_SESSION[$id]['adults']+$_SESSION[$id]['childs']+$_SESSION[$id]['infants'];
	}
	else
	{
		$id=0;$lowest_price=0;
		$date_sess=date("m-d-y");
		$date_sess_ed=date("m-d-y");
	}
	//echo '<pre/>';print_r($result_oneway);print_r($result_return);exit;
	$date_sd['cal_date'][0] = date('D j M',(strtotime("-3 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][1] = date('D j M',(strtotime("-2 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][2] = date('D j M',(strtotime("-1 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][3] = date('D j M',(strtotime("+0 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][4] = date('D j M',(strtotime("+1 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][5] = date('D j M',(strtotime("+2 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][6] = date('D j M',(strtotime("+3 day", (strtotime($date_sess_sd)))));
	
	
	$date_sd1['cal_date'][0] = date('d-m-Y',(strtotime("-3 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][1] = date('d-m-Y',(strtotime("-2 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][2] = date('d-m-Y',(strtotime("-1 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][3] = date('d-m-Y',(strtotime("+0 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][4] = date('d-m-Y',(strtotime("+1 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][5] = date('d-m-Y',(strtotime("+2 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][6] = date('d-m-Y',(strtotime("+3 day", (strtotime($date_sess_sd)))));
	
	$date_ed['cal_date'][0] = date('D j M',(strtotime("-3 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][1] = date('D j M',(strtotime("-2 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][2] = date('D j M',(strtotime("-1 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][3] = date('D j M',(strtotime("+0 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][4] = date('D j M',(strtotime("+1 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][5] = date('D j M',(strtotime("+2 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][6] = date('D j M',(strtotime("+3 day", (strtotime($date_sess_ed)))));
	
	$date_ed1['cal_date'][0] = date('d-m-Y',(strtotime("-3 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][1] = date('d-m-Y',(strtotime("-2 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][2] = date('d-m-Y',(strtotime("-1 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][3] = date('d-m-Y',(strtotime("+0 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][4] = date('d-m-Y',(strtotime("+1 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][5] = date('d-m-Y',(strtotime("+2 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][6] = date('d-m-Y',(strtotime("+3 day", (strtotime($date_sess_ed)))));
	
	
	if(!empty($result_oneway))
	{
		for($i=0;$i<(count($result_oneway));$i++) 
		{
			if(is_array($result_oneway[$i]['ddate1']))
				$sd=$result_oneway[$i]['ddate1'][0];
			else
				$sd=$result_oneway[$i]['ddate1'];
			
			$cinval = explode("-",$sd);
			$sdd=$cinval[0]."-".$cinval[1]."-20".$cinval[2];
			$date_result_oneway=(date('D j M',((strtotime($sdd)))));
			for($k=0;$k<7;$k++)
			{			
				
				if($date_result_oneway==$date_sd['cal_date'][$k])
				{
					//$count=(count($result_return[$i]['adate1']));
					if(is_array($result_return[$i]['adate1']))
						$ed=$result_return[$i]['adate1'][0];
					else
						$ed=$result_return[$i]['adate1'];
											
					$cinval = explode("-",$ed);
					$edd=$cinval[0]."-".$cinval[1]."-20".$cinval[2];
					$date_result_return=(date('D j M',((strtotime($edd)))));
					
					for($j=0;$j<7;$j++)
					{
						if($date_result_return==$date_ed['cal_date'][$j])
						{
							$Total_FareAmount[$k][$j]=$result_oneway[$i]['Total_FareAmount'];
							$flight_id[$k][$j]=$result_oneway[$i]['id'];
							$flight_id1[$k][$j]=$result_return[$i]['id'];
							if((count($result_oneway[$i]['name']))<=1)
								$name[$k][$j]=$result_oneway[$i]['name'];
							else
								$name[$k][$j]=$result_oneway[$i]['name'][0];
						}
					}
				}
			}
		}
	}
		
		 //echo '<pre/>';print_r($name); print_r($Total_FareAmount);print_r($flight_id1);print_r($flight_id);exit;		
		
?>
<div class="header">
            <div class="container">
                <div class="row-fluid top-bottom15">
                    <div class="span4">
                        <img src="<?php print WEB_DIR ?>images/img/logo.png">
                    </div>
                    <div class="span8">
                        <div class="navbar top25">
                            <!--<div class="navbar-inner">-->
                            <div class="container">
                                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <!--<a class="brand" href="#">Project name</a>-->
                                <div class="nav-collapse collapse">
                                    <ul class="nav">
                                        <li class="active"><a href="#">FLYBILLETTER</a></li>
                                        <li><a href="#about">HOTELL</a></li>
                                        <li><a href="#contact">STOREBYFERIE</a></li>
                                        <li><a href="#contact">SOL OG BAD</a></li>
                                        <li><a href="#contact">TOPPLISTER</a></li>
                                    </ul>
                                </div><!--/.nav-collapse -->
                            </div>
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--<div class="flight-calander">
                        <table class="table cal-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Retur<br/><?php echo $date_ed['cal_date'][0]; ?></th>
                                    <th>Retur<br/><?php echo $date_ed['cal_date'][1]; ?></th>
                                    <th>Retur<br/><?php echo $date_ed['cal_date'][2]; ?></th>
                                    <th>Retur<br/><?php echo $date_ed['cal_date'][3]; ?></th>
                                    <th>Retur<br/><?php echo $date_ed['cal_date'][4]; ?></th>
                                    <th>Retur<br/><?php echo $date_ed['cal_date'][5]; ?></th>
                                    <th>Retur<br/><?php echo $date_ed['cal_date'][6]; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            
                            
                            
                                <tr class="null-bg">
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,-  <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,-<div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr class="null-bg1">
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                                <tr>
                                    <td class="bg-cal">Retur <br/>Mandag <br/>17-mar-2014</td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                    <td>5 960,- <div class="green-tag"></div></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>-->
<div style="width: 1000px; margin: 0 auto;">
<!--<div style="width:1000px; float:left; min-height:40px;margin-top: 10px;"><h1><span id="result_count"></span>&nbsp;<?php echo $r; ?> Flights Available from <?php echo $_SESSION['fromcityval']; ?> to <?php echo $_SESSION['tocityval']; ?> </h1>-->
<div style="clear:both;">&nbsp;</div></div>

 <div class="flight-calander">
                        <table class="table cal-table">
    <th></th>
    <th>Return<br/><?php echo $date_ed['cal_date'][0]; ?></th>
    <th>Return<br/><?php echo $date_ed['cal_date'][1]; ?></th>
    <th>Return<br/><?php echo $date_ed['cal_date'][2]; ?></th>
    <th>Return<br/><?php echo $date_ed['cal_date'][3]; ?></th>
    <th>Return<br/><?php echo $date_ed['cal_date'][4]; ?></th>
    <th>Return<br/><?php echo $date_ed['cal_date'][5]; ?></th>
    <th>Return<br/><?php echo $date_ed['cal_date'][6]; ?></th>
  </tr>
	<?php for($ii=0;$ii<7;$ii++)
		{
			?>
			<tr>
				<?php if($ii==3){?>
					<th  class="bg-cal" style="border:1px solid #DDDDDD;">Departure<br/><?php echo $date_sd['cal_date'][$ii]; ?></th>
				<?php }else{?>
					<th  class="bg-cal" style="border:1px solid #DDDDDD;">Departure<br/><?php echo $date_sd['cal_date'][$ii]; ?></th>
				<?php } ?>
				
				
				
				<!-- Row0 -->

				<?php for($kk=0;$kk<7;$kk++){
					$date_id=$ii.$kk;
					$_SESSION[$id][$date_id]['date_sd']=$date_sd1['cal_date'][$ii];
					$_SESSION[$id][$date_id]['date_ed']=$date_ed1['cal_date'][$kk];
					
					if(isset($Total_FareAmount[$ii][$kk]))
					{ 
						if($Total_FareAmount[$ii][$kk]==$lowest_price)
						{
							// echo '<pre>ghgh'.$ii.$kk;echo $Total_FareAmount[0][1];
							?>
							<td class="calender_bg_div">
									<?php 
										if(isset($flight_id[$ii][$kk]))
										{?>
											<a target="_blank" href="#">
											<?php 
										}
										else
										{
											?> <?php 
										}?>
										<?php if(isset($name[$ii][$kk])){ echo substr($name[$ii][$kk],0,25)."<br/><span> From </span><strong><span>".$Total_FareAmount[$ii][$kk]."<br/></span></strong><span>for ".$passenger_count." Passenger(s)</span><br><span style='color:red; line-height:10px;'>* Lowest Price</span>"; }else { echo "" ; } ?>
									</a>
									
									
								
                                <div align="center">
                                <a target="_blank" href="#">
										<span style="font-size:10px;color:#088A08; line-height:10px;"><?php echo "Search More";?></span>
									</a>
                                    </div>
                                    
							</td>
				   <?php }
						else
						{?>
							<td class="calender_bg_div">
								
									<?php if(isset($flight_id[$ii][$kk])){?>
									<a target="_blank" href="#">
										<?php }else{?><?php }?>
									<?php if(isset($name[$ii][$kk])){ echo substr($name[$ii][$kk],0,25)."<br/><span> From </span><strong><span>".$Total_FareAmount[$ii][$kk].' EUR'."<br/></span></strong><span>for ".$passenger_count." Passenger(s)</span>"; }else { echo "" ; } ?>
									</a>
								
                                <div align="center">
                                <a target="_blank" href="#">
										<span style="font-size:10px;color:#088A08; line-height:10px;"><?php echo "Search More";?></span>
									</a>
                                    </div>
							</td>
				  <?php }
					}
					else
					{ ?>
						<td>
								
								<?php if(isset($flight_id[$ii][$kk])){?>
								<a target="_blank" href="#">
									<?php }else{?><?php }?>
									<?php echo "No Fares";?>
								</a>
							
						</td>	
			  <?php } }
				?>
				</tr>
			  <?php }  ?>
				
			
</table>
<br />


</div>
<div style="clear:both;"></div>


