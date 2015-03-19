 <?php 
// echo'<pre/>ghghfg';print_r($flightDetails_return);exit;
 $from=explode(',',$_SESSION['fromcityval']);
  $to=explode(',',$_SESSION['tocityval']);
  //print_r($to);
 $city_name=$this->Flight_Model->city($from[1]);
  $tocity=$this->Flight_Model->city($to[1]);
 if($flightDetails_oneway!='')
 {
		if($flightDetails_oneway['stops']==0){
		$eft=$flightDetails_oneway['eft'];
		$cicode=$flightDetails_oneway['cicode'];
		$name=$flightDetails_oneway['name'];
		$fnumber=$flightDetails_oneway['fnumber'];
		$equipmentType=$flightDetails_oneway['equipmentType'];
		$TaxAmount=$flightDetails_oneway['TaxAmount'];	
		$FareAmount=$flightDetails_oneway['FareAmount'];
		$id=$flightDetails_oneway['id'];	
		$duration_final1=$flightDetails_oneway['duration_final1'];
		$dateOfDeparture=$flightDetails_oneway['dep_date'];
		$timeOfDeparture=$flightDetails_oneway['ddate1'];
		$dateOfArrival=$flightDetails_oneway['arv_date'];
		$timeOfArrival=$flightDetails_oneway['adate1'];
		$locationIdDeparture=$flightDetails_oneway['dlocation'];
		
		if(isset($flightDetails_oneway['dlocation'])){
			$locationIdArival=$flightDetails_oneway['alocation'];
			}
		else{
			$locationIdArival=$flightDetails_oneway['alocation']['value'];
			}
			$city_name=$this->Flight_Model->cityname($locationIdDeparture);
		$city_name_ar=$this->Flight_Model->cityname($locationIdArival);
			
	if($flightDetails_return!=''){
		if($flightDetails_return['stops']==0){
			$cicode_ret=$flightDetails_return['cicode'];
			$eft_ret=$flightDetails_return['eft'];
			$name_ret=$flightDetails_return['name'];
			$fnumber_ret=$flightDetails_return['fnumber'];
			$equipmentType_ret=$flightDetails_return['equipmentType'];
			$dlocation_ret=$flightDetails_return['dlocation'];
			if(isset($flightDetails_return['dlocation'])){
			$locationIdArival_ret=$flightDetails_return['alocation'];
			}
		else{
			$locationIdArival_ret=$flightDetails_return['alocation']['value'];
			}
			$ddate_ret=$flightDetails_return['ddate'];
			$adate_ret=$flightDetails_return['adate'];
			$ddate1_ret=$flightDetails_return['ddate1'];
			$adate1_ret=$flightDetails_return['adate1'];
			$duration_final1_ret=$flightDetails_return['duration_final1'];
			$FareAmount_ret=$flightDetails_return['FareAmount'];
			$TaxAmount_ret=$flightDetails_return['TaxAmount'];
			$id_ret=$flightDetails_return['id'];
			$city_name=$this->Flight_Model->cityname($locationIdDeparture);
			$city_name_ar=$this->Flight_Model->cityname($locationIdArival);
			
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
                                <h4 style="margin: 0px;"><?php echo $locationIdDeparture ?> - <?php echo $locationIdArival ?> | <?php echo $dateOfDeparture;?> &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['adults']?> voksen</h4>
                            <h4 style="margin: 0px;"><?php echo $dlocation_ret ?> - <?php echo $locationIdArival_ret ?> | <?php echo $ddate_ret;?> </h4>     
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
                                <div class="span9">
                                    <div class="row-fluid">
                                        <div class="span8">
                                            <div class="row-fluid">
                                            <label><?php echo $city_name->city;?></label>
                                                <div class="span4">
                                                    
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time=explode(' ',$timeOfDeparture); echo $locationIdDeparture ?> <?php echo $time[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                                <div class="span1">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-left-icon.png">
                                                </div>
                                                
                                            </div>
                                            <div class="row-fluid">
                                                    <label><?php echo $city_name_ar->city;?></label>
                                                    
                                                <div class="span4"><input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret=explode(' ',$ddate1_ret); echo $dlocation_ret ?> <?php echo $time_ret[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                                <div class="span2">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-right-icon.png">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php echo $duration_final1?>
                                                </div>
                                                <div class="span6">
                                                
                                                   <?php echo $flightDetails_oneway['stops'].' Stopp'?> (<?php echo 0?>)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    <?php echo $duration_final1_ret?>
                                                </div>
                                                <div class="span6">
                                               
                                                   <?php echo  $flightDetails_return['stops'].' Stopp'?> (<?php echo 0?>)
                                                    
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

                                <div class="span3 align-right">
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <span> <b style=""><?php echo $FareAmount.' EUR'?></b></span>
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
			<?php }
			else{
				for($r=0;$r<$flightDetails_return['stops'];$r++){
					
			$cicode_ret=$flightDetails_return['cicode'][$r];
			$eft_ret=$flightDetails_return['eft'];
			$name_ret=$flightDetails_return['name'][$r];
			$fnumber_ret=$flightDetails_return['fnumber'][$r];
			$equipmentType_ret=$flightDetails_return['equipmentType'];
			$dlocation_ret=$flightDetails_return['dlocation'][$r];
			if(isset($flightDetails_return['alocation'][$r])){
			$locationIdArival_ret=$flightDetails_return['alocation'];
			}
		else{
			$locationIdArival_ret=$flightDetails_return['alocation'][$r]['value'];
			}
			$ddate_ret=$flightDetails_return['ddate'][$r];
			$adate_ret=$flightDetails_return['adate'][$r];
			$ddate1_ret=$flightDetails_return['ddate1'][$r];
			$adate1_ret=$flightDetails_return['adate1'][$r];
			$duration_final1=$flightDetails_return['duration_final1'][$r];
			$FareAmount_ret=$flightDetails_return['FareAmount'];
			$TaxAmount_ret=$flightDetails_return['TaxAmount'];
			$id_ret=$flightDetails_return['id'];
					
					}
				}?>
		
		<!--<div class="flight-search-box top20">
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
                                <h4 style="margin: 0px;"><?php echo $locationIdDeparture ?> - <?php echo $locationIdArival ?> | <?php echo $dateOfDeparture;?> &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['adults']?> voksen</h4>
                                
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
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time=explode(' ',$timeOfDeparture); echo $locationIdDeparture ?> <?php echo $time[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                                <div class="span2 top300">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-left-icon.png">
                                                </div>
                                                
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <label><?php echo $city_name_ar->city;?></label>
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret=explode(' ',$ddate1_ret); echo $dlocation_ret ?> <?php echo $time_ret[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                                <div class="span2 top300">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-right-icon.png">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php echo $duration_final1?>
                                                </div>
                                                <div class="span6">
                                                
                                                   <?php echo $flightDetails_oneway['stops'].' Stopp'?> (<?php echo 0?>)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    <?php echo $duration_final1_ret?>
                                                </div>
                                                <div class="span6">
                                               
                                                   <?php echo  $flightDetails_return['stops'].' Stopp'?> (<?php echo 0?>)
                                                    
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
                                            <span> <b style=""><?php echo $FareAmount.' EUR'?></b></span>
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
            </div>-->
            
            
		<?php }	}	
	else{?>
		
		
		<?php for($i=0;$i<$flightDetails_oneway['stops'];$i++){
					$cicode=$flightDetails_oneway['cicode'][$i];
					$eft=$flightDetails_oneway['eft'];
					$name=$flightDetails_oneway['name'][$i];
					$fnumber=$flightDetails_oneway['fnumber'][$i];
					$equipmentType=$flightDetails_oneway['equipmentType'];
					$locationIdDeparture=$flightDetails_oneway['dlocation'][$i];
					if(isset($flightDetails_oneway['alocation'][$i])){
					$locationIdArival=$flightDetails_oneway['alocation'][$i];
					}
					else{
					$locationIdArival=$flightDetails_oneway['alocation'][$i]['value'];
					}
					$dateOfDeparture=$flightDetails_oneway['dep_date'][$i];
					$timeOfDeparture=$flightDetails_oneway['ddate1'][$i];
					$dateOfArrival=$flightDetails_oneway['arv_date'][$i];
					$timeOfArrival=$flightDetails_oneway['adate1'][$i];
					$TaxAmount=$flightDetails_oneway['TaxAmount'];	
					$FareAmount=$flightDetails_oneway['FareAmount'];
					$id=$flightDetails_oneway['id'];
					$duration_final1=$flightDetails_oneway['duration_final1'][$i];
					}
					$city_name=$this->Flight_Model->cityname($flightDetails_oneway['dlocation'][0]);
			$city_name_ar=$this->Flight_Model->cityname($flightDetails_oneway['alocation'][1]);
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
					
                                <h4 style="margin: 0px;"><?php echo $flightDetails_oneway['dlocation'][0] ?> - <?php echo $flightDetails_oneway['dlocation'][1] ?> | <?php echo $flightDetails_oneway['dep_date'][0];?> &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['adults']?> voksen</h4>
                                <h4 style="margin: 0px;"><?php echo $flightDetails_oneway['alocation'][0] ?> - <?php echo $flightDetails_oneway['alocation'][1] ?> | <?php echo $flightDetails_oneway['dep_date'][1];?></h4>
                                
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
                                <div class="span9">
                                    <div class="row-fluid">
                                        <div class="span8">
                                            <div class="row-fluid">
                                                    <label><?php echo $city_name->city;?></label>
                                                <div class="span4">
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time=explode(' ',$flightDetails_oneway['ddate1'][0]); echo $flightDetails_oneway['dlocation'][0] ?> <?php echo $time[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                    
                                                </div>
                                                <div class="span2">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-left-icon.png">
                                                </div>
                                                <div class="span4">
                                                <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time1=explode(' ',$flightDetails_oneway['ddate1'][1]); echo $flightDetails_oneway['dlocation'][1]?> <?php echo $time1[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <label><?php echo $city_name_ar->city;?></label>
                                                <div class="span4">
                                                    
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret=explode(' ',$flightDetails_oneway['adate1'][0]); echo $flightDetails_oneway['alocation'][0] ?> <?php echo $time_ret[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                                <div class="span2">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-right-icon.png">
                                                </div>
                                                <div class="span4">
                                                <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret1=explode(' ',$flightDetails_oneway['adate1'][1]); echo $flightDetails_oneway['alocation'][1] ?> <?php echo $time_ret1[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php echo $flightDetails_oneway['duration_final1'][0]?>
                                                </div>
                                                <div class="span6">
                                                
                                                   <?php echo $flightDetails_oneway['stops'].' Stopp'?> (<?php echo $flightDetails_oneway['dlocation'][1]?>)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    <?php echo $flightDetails_oneway['duration_final1'][1]?>
                                                </div>
                                                <div class="span6">
                                               
                                                   <?php echo  $flightDetails_return['stops'].' Stopp'?> (<?php  echo $flightDetails_oneway['alocation'][0]?>)
                                                    
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

                                <div class="span3 align-right">
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <span> <b style=""><?php echo $flightDetails_oneway['FareAmount'].' EUR'?></b></span>
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
					<?php 
				if($flightDetails_return!=''){		
		if($flightDetails_return['stops']==0){
			$cicode_ret=$flightDetails_return['cicode'];
			$eft_ret=$flightDetails_return['eft'];
			$name_ret=$flightDetails_return['name'];
			$fnumber_ret=$flightDetails_return['fnumber'];
			$equipmentType_ret=$flightDetails_return['equipmentType'];
			$dlocation_ret=$flightDetails_return['dlocation'];
			if(isset($flightDetails_return['dlocation'])){
			$locationIdArival_ret=$flightDetails_return['alocation'];
			}
		else{
			$locationIdArival_ret=$flightDetails_return['alocation']['value'];
			}
			$ddate_ret=$flightDetails_return['ddate'];
			$adate_ret=$flightDetails_return['adate'];
			$ddate1_ret=$flightDetails_return['ddate1'];
			$adate1_ret=$flightDetails_return['adate1'];
			$duration_final1=$flightDetails_return['duration_final1'];
			$FareAmount_ret=$flightDetails_return['FareAmount'];
			$TaxAmount_ret=$flightDetails_return['TaxAmount'];
			$id_ret=$flightDetails_return['id'];
			}
			else{
				for($r=0;$r<$flightDetails_return['stops'];$r++){
					
			$cicode_ret=$flightDetails_return['cicode'][$r];
			$eft_ret=$flightDetails_return['eft'];
			$name_ret=$flightDetails_return['name'][$r];
			$fnumber_ret=$flightDetails_return['fnumber'][$r];
			$equipmentType_ret=$flightDetails_return['equipmentType'];
			$dlocation_ret=$flightDetails_return['dlocation'][$r];
			if(isset($flightDetails_return['alocation'][$r])){
			$locationIdArival_ret=$flightDetails_return['alocation'];
			}
		else{
			$locationIdArival_ret=$flightDetails_return['alocation'][$r]['value'];
			}
			$ddate_ret=$flightDetails_return['ddate'][$r];
			$adate_ret=$flightDetails_return['adate'][$r];
			$ddate1_ret=$flightDetails_return['ddate1'][$r];
			$adate1_ret=$flightDetails_return['adate1'][$r];
			$duration_final1=$flightDetails_return['duration_final1'][$r];
			$FareAmount_ret=$flightDetails_return['FareAmount'];
			$TaxAmount_ret=$flightDetails_return['TaxAmount'];
			$id_ret=$flightDetails_return['id'];
					
					}
				}
		}
			}
				
	
			}
	else
	{
		$id=0;$lowest_price=0;
		$date_sess=date("m-d-y");
		$date_sess_ed=date("m-d-y");
	}
 
						?>
                <!--<div class="flight-search-box top20">
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
            </div>-->
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