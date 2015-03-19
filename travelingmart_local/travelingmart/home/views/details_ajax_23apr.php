 <?php 
 //echo'<pre/>ghghfg';print_r($flightDetails1);exit;
 $from=explode(',',$_SESSION['fromcityval']);
  $to=explode(',',$_SESSION['tocityval']);
  //print_r($to);
 $city_name=$this->Flight_Model->city($from[1]);
  $tocity=$this->Flight_Model->city($to[1]);
 if($flightDetails1!='')
 {
	$r=0;
	
	if(!empty($flightDetails1))
	{
		$ref=$flightDetails1['oneWay']['ref']['value'];
		$eft=$flightDetails1['oneWay']['eft']['value'];
		$eft=$flightDetails1['oneWay']['eft']['value'];
		$dateOfDeparture=$flightDetails1['oneWay']['dateOfDeparture'][0]['value'];
		$dateOfDepartur1=$flightDetails1['oneWay']['dateOfDeparture'][1]['value'];
		$timeOfDeparture=$flightDetails1['oneWay']['timeOfDeparture'][0]['value'];
		$timeOfDeparture1=$flightDetails1['oneWay']['timeOfDeparture'][1]['value'];
		$dateOfArrival=$flightDetails1['oneWay']['dateOfArrival'][0]['value'];
		$dateOfArrival1=$flightDetails1['oneWay']['dateOfArrival'][1]['value'];
		$timeOfArrival=$flightDetails1['oneWay']['timeOfArrival'][0]['value'];
		$timeOfArrival1=$flightDetails1['oneWay']['timeOfArrival'][1]['value'];
		
		$depart_layover = ((substr("$dateOfDeparture", 0, -4)) . "-" . (substr("$dateOfDeparture", -4, 2)) . "-" . (substr("$dateOfDeparture", -2))) . " " . ((substr("$timeOfDeparture", 0, -2)) . ":" . (substr("$timeOfDeparture", -2))) . "";
                                $depart_layover1 = ((substr("$dateOfDepartur1", 0, -4)) . "-" . (substr("$dateOfDepartur1", -4, 2)) . "-" . (substr("$dateOfDepartur1", -2))) . " " . ((substr("$timeOfDeparture1", 0, -2)) . ":" . (substr("$timeOfDeparture1", -2))) . "";
								
								$arrival_layover = ((substr("$dateOfArrival", 0, -4)) . "-" . (substr("$dateOfArrival", -4, 2)) . "-" . (substr("$dateOfArrival", -2))) . " " . ((substr("$timeOfArrival", 0, -2)) . ":" . (substr("$timeOfArrival", -2))) . "";
                                $arrival_layover1 = ((substr("$dateOfArrival1", 0, -4)) . "-" . (substr("$dateOfArrival1", -4, 2)) . "-" . (substr("$dateOfArrival1", -2))) . " " . ((substr("$timeOfArrival1", 0, -2)) . ":" . (substr("$timeOfArrival1", -2))) . "";
                                $date_c = new DateTime($depart_layover);
								$date_c1 = new DateTime($depart_layover1);
                                $date_d = new DateTime($arrival_layover);
								$date_d1 = new DateTime($arrival_layover1);
                                $interval_layover = date_diff($date_c, $date_d);
								$interval_layover1 = date_diff($date_c1, $date_d1);
		                        $timeformat= $interval_layover->format('%h hours %i minutes');
                        		$timeformat1 = $interval_layover1->format('%h hours %i minutes');
								//$interval_layover->h.':'.$interval_layover->i;
								$time1 = strtotime('$interval_layover->h:$interval_layover->i:$interval_layover->s');
								$time2 = strtotime('$interval_layover1->h:$interval_layover1->i:$interval_layover1->s');
								$diff = $time2 - $time1;
								//echo 'Diff: '.date('H:i:s', $diff);
		//echo 'jghjghjfa'.$depart_layover.'jghjfhb'.$arrival_layover.'uttyutyc'.$timeformat.'ttyutyd'. $timeformat1;exit;
		$locationIdDeparture=$flightDetails1['oneWay']['locationIdDeparture'][0]['value'];
		$locationIdDeparture1=$flightDetails1['oneWay']['locationIdDeparture'][1]['value'];
		$locationIdArival=$flightDetails1['oneWay']['locationIdArival'][0]['value'];
		$locationIdArival1=$flightDetails1['oneWay']['locationIdArival'][1]['value'];
		$refret=$flightDetails1['Return']['ref']['value'];
		$eftret=$flightDetails1['Return']['eft']['value'];
		$dateOfDepartureret=$flightDetails1['Return']['dateOfDeparture'][0]['value'];
		$dateOfDepartureret1=$flightDetails1['Return']['dateOfDeparture'][1]['value'];
		$timeOfDepartureret=$flightDetails1['Return']['timeOfDeparture'][0]['value'];
		$timeOfDeparture1ret=$flightDetails1['Return']['timeOfDeparture'][1]['value'];
		$dateOfArrivalret=$flightDetails1['Return']['dateOfArrival'][0]['value'];
		$dateOfArrivalret1=$flightDetails1['Return']['dateOfArrival'][1]['value'];
		$timeOfArrivalret=$flightDetails1['Return']['timeOfArrival'][0]['value'];
		$timeOfArrival1ret=$flightDetails1['Return']['timeOfArrival'][1]['value'];
		
		$depart_layover_ret = ((substr("$dateOfDepartureret", 0, -4)) . "-" . (substr("$dateOfDepartureret", -4, 2)) . "-" . (substr("$dateOfDepartureret", -2))) . " " . ((substr("$timeOfDepartureret", 0, -2)) . ":" . (substr("$timeOfDepartureret", -2))) . "";
                                $depart_layover_ret1 = ((substr("$dateOfDepartureret1", 0, -4)) . "-" . (substr("$dateOfDepartureret1", -4, 2)) . "-" . (substr("$dateOfDepartureret1", -2))) . " " . ((substr("$timeOfDeparture1ret", 0, -2)) . ":" . (substr("$timeOfDeparture1ret", -2))) . "";
								
								$arrival_layover_ret = ((substr("$dateOfArrivalret", 0, -4)) . "-" . (substr("$dateOfArrivalret", -4, 2)) . "-" . (substr("$dateOfArrivalret", -2))) . " " . ((substr("$timeOfArrivalret", 0, -2)) . ":" . (substr("$timeOfArrivalret", -2))) . "";
                                $arrival_layover_ret1 = ((substr("$timeOfDeparture1ret", 0, -4)) . "-" . (substr("$timeOfDeparture1ret", -4, 2)) . "-" . (substr("$timeOfDeparture1ret", -2))) . " " . ((substr("$timeOfArrival1ret", 0, -2)) . ":" . (substr("$timeOfArrival1ret", -2))) . "";
                                $date_c_ret = new DateTime($depart_layover_ret);
								$date_c1_ret = new DateTime($depart_layover_ret1);
                                $date_d_ret = new DateTime($arrival_layover_ret);
								$date_d1_ret = new DateTime($arrival_layover_ret1);
								//echo 'fhgfh';print_r($date_c_ret);$ss=explode(' ',$date_c_ret);
                                $interval_layover_ret = date_diff($date_c_ret, $date_d_ret);
								//print_r($interval_layover_ret);
		$interval_layover1_ret = date_diff($date_c1_ret, $date_d1_ret);
		 $timeformat_ret= $interval_layover_ret->format('%h hours %i minutes');
                        		$timeformat1_ret1 = $interval_layover1_ret->format('%h h %i m');
		$locationIdDepartureret=$flightDetails1['Return']['locationIdDeparture'][0]['value'];
		$locationIdDeparture1ret1=$flightDetails1['Return']['locationIdDeparture'][1]['value'];
		$locationIdArivalret=$flightDetails1['Return']['locationIdArival'][0]['value'];
		$locationIdArival1ret=$flightDetails1['Return']['locationIdArival'][1]['value'];
		$totalFareAmount=$flightDetails1['Recomm']['totalFareAmount']['value'];
		$passenger_count=$_SESSION[$id]['adults']+$_SESSION[$id]['childs']+$_SESSION[$id]['infants'];
		$city_name=$this->Flight_Model->cityname($locationIdDeparture);
		$city_name1=$this->Flight_Model->cityname($locationIdDeparture1);		
		$city_name_ret=$this->Flight_Model->cityname($locationIdDeparture1ret);
		$city_name_ret1=$this->Flight_Model->cityname($locationIdDeparture1ret1);
	}
	else
	{
		$id=0;$lowest_price=0;
		$date_sess=date("m-d-y");
		$date_sess_ed=date("m-d-y");
	}
 }
						?>
                <div class="flight-search-box top20">
                <div class="row-fluid">
                    <div class="span4">
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="<?php print WEB_DIR ?>images/img/sas.png">
                            </a>
                            <div class="media-body top10">
                                <h4 class="media-heading">Scandinavian Airlines</h4>    
                            </div>
                        </div>
                        <h5>FLYAVGANGER MED SAS /STARALLIANCE</h5>
                        <div class="row-fluid">
                            <div class="span12">
                                <h4 style="margin: 0px;"><?php echo $locationIdDeparture ?> - <?php echo $locationIdArival1 ?> | <?php $departdate= explode('-',$depart_layover); echo $departdate[0].'/'.$departdate[1];?> &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['adults']?> voksen</h4>
                                <h4 style="margin: 0px;"><?php echo $locationIdDepartureret?> - <?php echo $locationIdDeparture?> |<?php $arrivaldate=explode('-',$arrival_layover_ret);  echo $arrivaldate[0].'/'.$arrivaldate[1];?> </h4>
                            </div>
                        </div>
                        <div class="row-fluid top10">
                            <div class="span12">
                                <h5><input  type="submit" name="submit"  id="show" style="background:none; border:none;color:blue; font-size:15px;text-align:center;text-decoration: underline;"" value="Mer info om denne reisen" onclick="showmoreinform();" > </h5>
                            </div>
                        </div>
                    </div>
                    <div class="span8">
                        <div class="flight-home">
                            <div class="row-fluid">
                                <div class="span8">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <label><?php echo $city_name->city;?></label>
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php echo $locationIdDeparture ?> <?php echo $interval_layover->h.':'.$interval_layover->i?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                                <div class="span2 top300">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-left-icon.png">
                                                </div>
                                                <div class="span5">
                                                  
                                                    <input type="text" readonly="readonly" class="span12 top25-rep place-color" value="<?php echo $locationIdArival1 ?> <?php echo $interval_layover1->h.':'.$interval_layover1->i?>" style="background-color: #276baa;border: 1px solid #276baa;color:#fff;">
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <label><?php echo $tocity->city;?></label>
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php echo $locationIdDepartureret ?> <?php echo $interval_layover_ret->h.':'.$interval_layover_ret->i?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                                <div class="span2 top300">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-right-icon.png">
                                                </div>
                                                <div class="span5">
                                                   
                                                    <input type="text" readonly="readonly" class="span12 top25-rep place-color" value="<?php echo $locationIdArival1ret ?> <?php echo $interval_layover1_ret->h.':'.$interval_layover1_ret->i?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php echo $interval_layover1->h.'t '.$interval_layover1->i.'m'?>
                                                </div>
                                                <div class="span6">
                                                <?php $count=$flightDetails1['oneWay']['locationIdDeparture'];
												 if($count=1){ $stops=0;}
												 if($count=2){ $stops=1;
												 }?>
                                                   <?php echo  $stops.' Stopp'?> (<?php echo $locationIdDeparture1?>)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    <?php echo $interval_layover1_ret->h.'t '.$interval_layover1_ret->i.'m'?>
                                                </div>
                                                <div class="span6">
                                                <?php $count1=$flightDetails1['Return']['locationIdDeparture'];
												 if($count1=1){ $stopss=0;}
												 if($count1=2){ $stopss=1;
												 }?>
                                                   <?php echo  $stopss.' Stopp'?> (<?php echo $locationIdDeparture1ret1?>)
                                                    
                                                </div>
                                            </div>
                                            <div class="row-fluid align-right">
                                                <div class="span12">
                                                    <h5><a href="#" style="text-decoration: underline; color: #fff;">+9 ledige plasser</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="span4 align-right">
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <span> <b style=""><?php echo $totalFareAmount.' EUR'?></b></span>
                                        </div>
                                    </div>
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <img src="<?php print WEB_DIR ?>images/img/price-btn.png">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                      <div id="showinformation"></div>   
                         
                     <script>     function showmoreinform() {
	//alert('jhgjhgjgh');
	 $("#showinformation").html('');

$.ajax({
           type: "POST",
           url: "<?php echo WEB_URL; ?>flight/showmoreinform",
           
           success:function(response) {
            $("#showinformation").html(response);
           }

      });
}
//Call AJAX:
//$(document).ready(showdetials);
</script>