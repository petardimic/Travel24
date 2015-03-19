 <?php 
  //echo'<pre/>oneway';print_r($flightDetails_oneway);echo '<br/>';
  //echo'<pre/>return';print_r($flightDetails_return);echo '<br/>';exit;
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
                            <h4 style="margin: 0px;"><?php echo $flightDetails_return['dlocation'] ?> - <?php echo $flightDetails_return['alocation'] ?> | <?php echo $flightDetails_return['dep_date']?> </h4>     
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
                                                    
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time=explode(' ',$flightDetails_oneway['ddate1']); echo $flightDetails_oneway['dlocation'] ?> <?php echo $time[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                                <div class="span1">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-left-icon.png">
                                                </div>
                                                 <div class="span4">
                                                    
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time1=explode(' ',$flightDetails_oneway['adate1']); echo  $flightDetails_oneway['alocation']?> <?php echo $time1[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                    <label><?php echo $city_name_ar->city;?></label>
                                                    
                                                <div class="span4"><input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret=explode(' ',$flightDetails_return['ddate1']); echo $flightDetails_return['dlocation'] ?> <?php echo $time_ret[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                                <div class="span2">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-right-icon.png">
                                                </div>
                                                 <div class="span4"><input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret1=explode(' ',$flightDetails_return['adate1']); echo $flightDetails_return['alocation'] ?> <?php echo $time_ret1[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php  
													 $finaltime=str_split($flightDetails_oneway['eft'],2);
													 echo $finaltime[0].'h '.$finaltime[1].'m' ?>
                                                </div>
                                                <div class="span6">
                                                
                                                   <?php 
											
												   echo $flightDetails_oneway['stops'].' Stopp'?> (<?php echo 0?>)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    <?php 
													$finaltime1=str_split($flightDetails_return['eft'],2);
													 echo $finaltime1[0].'h '.$finaltime1[1].'m';?>
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
			$ddate_ret=$flightDetails_return['dep_date'][$r];
			$adate_ret=$flightDetails_return['adate'][$r];
			$ddate1_ret=$flightDetails_return['ddate1'][$r];
			$adate1_ret=$flightDetails_return['adate1'][$r];
			$duration_final1=$flightDetails_return['duration_final1'][$r];
			$FareAmount_ret=$flightDetails_return['FareAmount'];
			$TaxAmount_ret=$flightDetails_return['TaxAmount'];
			$id_ret=$flightDetails_return['id'];
					
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
                                <h4 style="margin: 0px;"><?php echo $locationIdDeparture ?> - <?php echo $locationIdArival ?> | <?php echo $dateOfDeparture;?> &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['adults']?> voksen</h4>
                                 <h4 style="margin: 0px;"><?php echo $flightDetails_return['dlocation'][0] ?> - <?php echo $flightDetails_return['alocation'][1] ?> | <?php echo $flightDetails_return['dep_date'][0];?> </h4>
                                
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
                                                 <div class="span4">
                                                 <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time1=explode(' ',$ddate1_ret); echo $locationIdArival ?> <?php echo $time1[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                
                                                    <label><?php echo $city_name_ar->city;?></label>
                                                    <div class="span4">
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret=explode(' ',$flightDetails_return['ddate1'][0]); echo $flightDetails_return['dlocation'][0] ?> <?php echo $time_ret[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                                <div class="span1">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-right-icon.png">
                                                </div>
                                                <div class="span4">
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret1=explode(' ',$flightDetails_return['adate1'][1]); echo $flightDetails_return['alocation'][1] ?> <?php echo $time_ret1[1]?>" style="background-color: #276baa;border: 1px solid #276baa;color:#fff;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php 
													 $timedd1=str_split($flightDetails_oneway['eft'],2);
													 echo $timedd1[0].'h '.$timedd1[1].'m';
													 ?>
                                                </div>
                                                <div class="span6">
                                                
                                                   <?php echo $flightDetails_oneway['stops'].' Stopp'?> (<?php echo 0?>)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    <?php 
													$timadd=str_split($flightDetails_return['eft'],2);
													echo $timadd[0].'h '.$timadd[1].'m';
														
													?>
                                                </div>
                                                <div class="span6">
                                               
                                                   <?php echo  $flightDetails_return['stops'].' Stopp'?> (<?php echo $flightDetails_return['alocation'][0]?>)
                                                    
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
            
            
		<?php } }	}	
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
					
                                <h4 style="margin: 0px;"><?php echo $flightDetails_oneway['dlocation'][0] ?> - <?php echo $flightDetails_oneway['alocation'][1] ?> | <?php echo $flightDetails_oneway['dep_date'][0];?> &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['adults']?> voksen</h4>
                                <h4 style="margin: 0px;"><?php echo $flightDetails_return['dlocation'] ?> - <?php echo $flightDetails_return['alocation'] ?> | <?php echo $flightDetails_return['dep_date'];?></h4>
                                
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
                                                <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time1=explode(' ',$flightDetails_oneway['adate1'][1]); echo $flightDetails_oneway['alocation'][1]?> <?php echo $time1[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <label><?php echo $city_name_ar->city;?></label>
                                                <div class="span4">
                                                    
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret=explode(' ',$flightDetails_return['ddate1']); echo $flightDetails_return['dlocation'] ?> <?php echo $time_ret[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                                <div class="span2">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-right-icon.png">
                                                </div>
                                                <div class="span4">
                                                <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret1=explode(' ',$flightDetails_return['adate1']); echo $flightDetails_return['alocation'] ?> <?php echo $time_ret1[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php
													$timadd=str_split($flightDetails_oneway['eft'],2);
													echo $timadd[0].'h '.$timadd[1].'m';
													
													  ?>
                                                </div>
                                                <div class="span6">
                                                
                                                   <?php echo $flightDetails_oneway['stops'].' Stopp'?> (<?php echo $flightDetails_oneway['dlocation'][1]?>)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    <?php 
													$finaltime=str_split($flightDetails_return['eft'],2);
													echo $finaltime[0].'h '.$finaltime[1].'m';
												
													?>
                                                </div>
                                                <div class="span6">
                                               
                                                   <?php echo  $flightDetails_return['stops'].' Stopp'?> (<?php  echo 0;?>)
                                                    
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
					
					}?>
                    
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
					
                                <h4 style="margin: 0px;"><?php echo $flightDetails_oneway['dlocation'][0] ?> - <?php echo $flightDetails_oneway['alocation'][1] ?> | <?php echo $flightDetails_oneway['dep_date'][0];?> &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['adults']?> voksen</h4>
                                <h4 style="margin: 0px;"><?php echo $flightDetails_oneway['alocation'][1] ?> - <?php echo $flightDetails_oneway['dlocation'][0] ?> | <?php echo $flightDetails_return['dep_date'][0];?></h4>
                                
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
                                                <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time1=explode(' ',$flightDetails_oneway['adate1'][1]); echo $flightDetails_oneway['alocation'][1]?> <?php echo $time1[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <label><?php echo $city_name_ar->city;?></label>
                                                <div class="span4">
                                                    
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret=explode(' ',$flightDetails_return['ddate1'][0]); echo $flightDetails_oneway['alocation'][1] ?> <?php echo $time_ret[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                                <div class="span2">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-right-icon.png">
                                                </div>
                                                <div class="span4">
                                                <input type="text" readonly="readonly" class="span12 place-color" value="<?php $time_ret1=explode(' ',$flightDetails_return['adate1'][1]); echo $flightDetails_oneway['dlocation'][0] ?> <?php echo $time_ret1[1]?>" style="background-color: #958c29;border: 1px solid #958c29;color:#fff;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php
													$timefinal1=str_split($flightDetails_oneway['eft'],2);
													echo $timefinal1[0].'h '.$timefinal1[1].'m';
													
													  ?>
                                                </div>
                                                <div class="span6">
                                                
                                                   <?php echo $flightDetails_oneway['stops'].' Stopp'?> (<?php echo $flightDetails_oneway['dlocation'][1]?>)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    <?php 
													$timefinal=str_split($flightDetails_return['eft'],2);
													echo $timefinal[0].'h '.$timefinal[1].'m';
													
														
													?>
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
				<?php }
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
                
                      <div id="showinformation"></div>   
                         
 <script>     
function showmoreinform() {
	//alert('jhgjhgjgh');
$("#showinformation").html('');
$('#showinformation').hide();
$.ajax({
type: "POST",
url: "<?php echo WEB_URL; ?>flight/showmoreinform",
success:function(response) {
$("#showinformation").html(response);
$('#showinformation').show();
 }
});
}
//Call AJAX:
//$(document).ready(showdetials);
</script>