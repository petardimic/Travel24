<div id="panel12"  class="row-fluid" >
                     <div class="row-fluid top20">
                <div class="span6">
                    <div class="reisedetaljer-head">
                        <strong>Lavpriskalender</strong>
                    </div>
                </div>
                       <!--<div class="span6 align-right">
                             <div id="hide" class="detail-cross-btn">Skjul Detaljer X</div>
                </div>-->
            </div>
<div class="flight-calander">
                        <div class="row-fluid">
                            <div class="span12">
<?php 
//echo '<pre/>';print_r($flightDetails1);exit;
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
		
		$totalFareAmount=$flightDetails1['Recomm']['totalFareAmount']['value'];
			$totalTaxAmount=$flightDetails1['Recomm']['totalTaxAmount']['value'];
		$passenger_count=$_SESSION['adults']+$_SESSION['childs']+$_SESSION['infants'];?>
		<strong><?php echo  $city_name->city; ?>  To <?php echo $tocity->city?> <?php echo $_SESSION['sd']?></strong> 
		</div></div>
         <div class="row-fluid">                             
		<?php
		$count_code = count($flightDetails1['oneWay']['marketingCarrier']);
		//echo $count_code;
		
		if($count_code<=1){
			$dateOfDeparture=$flightDetails1['oneWay']['dateOfDeparture']['value'];
		$timeOfDeparture=$flightDetails1['oneWay']['timeOfDeparture']['value'];
		$dateOfArrival=$flightDetails1['oneWay']['dateOfArrival']['value'];
		$timeOfArrival=$flightDetails1['oneWay']['timeOfArrival']['value'];
	
		$depart_layover = ((substr("$dateOfDeparture", 0, -4)) . "-" . (substr("$dateOfDeparture", -4, 2)) . "-" . (substr("$dateOfDeparture", -2))) . " " . ((substr("$timeOfDeparture", 0, -2)) . ":" . (substr("$timeOfDeparture", -2))) . "";
                              
								$arrival_layover = ((substr("$dateOfArrival", 0, -4)) . "-" . (substr("$dateOfArrival", -4, 2)) . "-" . (substr("$dateOfArrival", -2))) . " " . ((substr("$timeOfArrival", 0, -2)) . ":" . (substr("$timeOfArrival", -2))) . "";
                                
                                $date_c = new DateTime($depart_layover);
                                $date_d = new DateTime($arrival_layover);
                                $interval_layover = date_diff($date_c, $date_d);
								 $timeformat_ret= $interval_layover->format('%h hours %i minutes');
								  $locationIdDeparture=$flightDetails1['oneWay']['locationIdDeparture']['value'];
								$locationIdArival=$flightDetails1['oneWay']['locationIdArival']['value'];
																$cityname=$this->Flight_Model->city($locationIdDeparture);
								$cityname1=$this->Flight_Model->city($locationIdArival);?>

                                           
                            <div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4><?php echo $cityname->city?> - <?php echo $cityname1->city?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td><?php $date= str_split($dateOfDeparture,2);echo $date[0].'/'.$date[1]?> </td>
                                                                <td> <?php $time=str_split($timeOfDeparture,2);echo $time[0].':'.$time[1]?></td>
                                                            </tr>
                                                            
                                                            
                                                            <tr class="success1">
                                                                <td>Flight No:</td>
                                                                <td><?php echo $flightnumber?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Flight Type:</td>
                                                                <td><?php echo $name?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Fare Amount:</td>
                                                                <td><?php echo $totalFareAmount?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Tax Amount:</td>
                                                                <td><?php echo $totalTaxAmount?></td>
                                                            </tr>
                                                             <tr class="success1">
                                                                <td>Total Adult:</td>
                                                                <td><?php echo $_SESSION['adults']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Child:</td>
                                                                <td><?php echo $_SESSION['childs']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Child:</td>
                                                                <td><?php echo $_SESSION['infants']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Passenger:</td>
                                                                <td><?php echo $passenger_count?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                       
								
								<?php
			}
			else{
				for($i=0;$i<$count_code;$i++){
					$dateOfDeparture=$flightDetails1['oneWay']['dateOfDeparture'][$i]['value'];
		$timeOfDeparture=$flightDetails1['oneWay']['timeOfDeparture'][$i]['value'];
		$dateOfArrival=$flightDetails1['oneWay']['dateOfArrival'][$i]['value'];
		$timeOfArrival=$flightDetails1['oneWay']['timeOfArrival'][$i]['value'];
	
		$depart_layover = ((substr("$dateOfDeparture", 0, -4)) . "-" . (substr("$dateOfDeparture", -4, 2)) . "-" . (substr("$dateOfDeparture", -2))) . " " . ((substr("$timeOfDeparture", 0, -2)) . ":" . (substr("$timeOfDeparture", -2))) . "";
                              
								$arrival_layover = ((substr("$dateOfArrival", 0, -4)) . "-" . (substr("$dateOfArrival", -4, 2)) . "-" . (substr("$dateOfArrival", -2))) . " " . ((substr("$timeOfArrival", 0, -2)) . ":" . (substr("$timeOfArrival", -2))) . "";
                                
                                $date_c = new DateTime($depart_layover);
                                $date_d = new DateTime($arrival_layover);
                                $interval_layover = date_diff($date_c, $date_d);
								 $timeformat_ret= $interval_layover->format('%h hours %i minutes');
								 $locationIdDeparture=$flightDetails1['oneWay']['locationIdDeparture'][$i]['value'];
								$locationIdArival=$flightDetails1['oneWay']['locationIdArival'][$i]['value'];
								
								$flightnumber=$flightDetails1['oneWay']['flightOrtrainNumber'][$i]['value'];
								$name = $this->Flight_Model->get_flight_name($flightDetails1['oneWay']['marketingCarrier'][$i]);
								$cityname=$this->Flight_Model->city($locationIdDeparture);
								$cityname1=$this->Flight_Model->city($locationIdArival);
					?>
				
				
                                           
                            <div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4><?php echo $cityname->city?> To <?php echo $cityname1->city?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td><?php $date= str_split($dateOfDeparture,2);echo $date[0].'/'.$date[1]?> </td>
                                                                <td> <?php $time=str_split($timeOfDeparture,2);echo $time[0].':'.$time[1]?></td>
                                                            </tr>
                                                            
                                                            
                                                            <tr class="success1">
                                                                <td>Flight No:</td>
                                                                <td><?php echo $flightnumber?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Flight Type:</td>
                                                                <td><?php echo $name?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Fare Amount:</td>
                                                                <td><?php echo $totalFareAmount?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Tax Amount:</td>
                                                                <td><?php echo $totalTaxAmount?></td>
                                                            </tr>
                                                             <tr class="success1">
                                                                <td>Total Adult:</td>
                                                                <td><?php echo $_SESSION['adults']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Child:</td>
                                                                <td><?php echo $_SESSION['childs']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Child:</td>
                                                                <td><?php echo $_SESSION['infants']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Passenger:</td>
                                                                <td><?php echo $passenger_count?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                                                               
				<?php }?>

                                </div>
                                <strong><?php echo $tocity->city; ?> - <?php echo $city_name->city?> <?php echo $_SESSION['ed']?></strong> 
                            
                       
                        <div class="row-fluid">
				<?php }
		
		$refret=$flightDetails1['Return']['ref']['value'];
		$eftret=$flightDetails1['Return']['eft']['value'];
		$count_code1 = count($flightDetails1['Return']['marketingCarrier']);
		if($count_code<=1){
			$dateOfDepartureret=$flightDetails1['Return']['dateOfDeparture']['value'];
		$timeOfDepartureret=$flightDetails1['Return']['timeOfDeparture']['value'];
		$dateOfArrivalret=$flightDetails1['Return']['dateOfArrival']['value'];
		$timeOfArrivalret=$flightDetails1['Return']['timeOfArrival']['value'];
		
		$depart_layover_ret = ((substr("$dateOfDepartureret", 0, -4)) . "-" . (substr("$dateOfDepartureret", -4, 2)) . "-" . (substr("$dateOfDepartureret", -2))) . " " . ((substr("$timeOfDepartureret", 0, -2)) . ":" . (substr("$timeOfDepartureret", -2))) . "";
                               
								
								$arrival_layover_ret = ((substr("$dateOfArrivalret", 0, -4)) . "-" . (substr("$dateOfArrivalret", -4, 2)) . "-" . (substr("$dateOfArrivalret", -2))) . " " . ((substr("$timeOfArrivalret", 0, -2)) . ":" . (substr("$timeOfArrivalret", -2))) . "";
                              
                                $date_c_ret = new DateTime($depart_layover_ret);
                                $date_d_ret = new DateTime($arrival_layover_ret);
                                $interval_layover_ret = date_diff($date_c_ret, $date_d_ret);
		$interval_layover1_ret = date_diff($date_c1_ret, $date_d1_ret);
		$locationIdDepartureret=$flightDetails1['Return']['locationIdDeparture']['value'];
		$locationIdArivalret=$flightDetails1['Return']['locationIdArival']['value'];
		$flightnumber_ret=$flightDetails1['Return']['flightOrtrainNumber']['value'];
				$cityname1=$this->Flight_Model->city($locationIdDepartureret);
								$cityname11=$this->Flight_Model->city($locationIdArivalret);?>
		
		<div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4><?php echo $cityname1->city?> - <?php echo $cityname11->city?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td><?php $date1= str_split($dateOfDepartureret,2);echo $date1[0].'/'.$date1[1]?> </td>
                                                                <td> <?php $time1=str_split($timeOfDeparture,2);echo $time[0].':'.$time1[1]?></td>
                                                            </tr>
                                                            
                                                            
                                                            <tr class="success1">
                                                                <td>Flight No:</td>
                                                                <td><?php echo $flightnumber_ret?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Flight Type:</td>
                                                                <td><?php echo $name?></td>
                                                            </tr>
                                                             <tr class="success1">
                                                                <td>Total Fare Amount:</td>
                                                                <td><?php echo $totalFareAmount?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Tax Amount:</td>
                                                                <td><?php echo $totalTaxAmount?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Adult:</td>
                                                                <td><?php echo $_SESSION['adults']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Child:</td>
                                                                <td><?php echo $_SESSION['childs']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Child:</td>
                                                                <td><?php echo $_SESSION['infants']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Passenger:</td>
                                                                <td><?php echo $passenger_count?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
		<?php }
		else{
			for($s=0;$s<$count_code;$s++){
			$dateOfDepartureret=$flightDetails1['Return']['dateOfDeparture'][$s]['value'];
		$timeOfDepartureret=$flightDetails1['Return']['timeOfDeparture'][$s]['value'];
		$dateOfArrivalret=$flightDetails1['Return']['dateOfArrival'][$s]['value'];
		$timeOfArrivalret=$flightDetails1['Return']['timeOfArrival'][$s]['value'];
		
		$depart_layover_ret = ((substr("$dateOfDepartureret", 0, -4)) . "-" . (substr("$dateOfDepartureret", -4, 2)) . "-" . (substr("$dateOfDepartureret", -2))) . " " . ((substr("$timeOfDepartureret", 0, -2)) . ":" . (substr("$timeOfDepartureret", -2))) . "";
                               
								
								$arrival_layover_ret = ((substr("$dateOfArrivalret", 0, -4)) . "-" . (substr("$dateOfArrivalret", -4, 2)) . "-" . (substr("$dateOfArrivalret", -2))) . " " . ((substr("$timeOfArrivalret", 0, -2)) . ":" . (substr("$timeOfArrivalret", -2))) . "";
                              
                                $date_c_ret = new DateTime($depart_layover_ret);
                                $date_d_ret = new DateTime($arrival_layover_ret);
                                $interval_layover_ret = date_diff($date_c_ret, $date_d_ret);
		$locationIdDepartureret=$flightDetails1['Return']['locationIdDeparture'][$s]['value'];
		$locationIdArivalret=$flightDetails1['Return']['locationIdArival'][$s]['value'];
		$name1 = $this->Flight_Model->get_flight_name($flightDetails1['Return']['marketingCarrier'][$s]);
		$flightnumber_ret=$flightDetails1['Return']['flightOrtrainNumber'][$s]['value'];
		$cityname1=$this->Flight_Model->city($locationIdDepartureret);
								$cityname11=$this->Flight_Model->city($locationIdArivalret);
			?>
			<div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4><?php echo $cityname1->city?> - <?php echo $cityname11->city?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td><?php $date1= str_split($dateOfDepartureret,2);echo $date1[0].'/'.$date1[1]?> </td>
                                                                <td> <?php $time1=str_split($timeOfDepartureret,2);echo $time1[0].':'.$time1[1]?></td>
                                                            </tr>
                                                            
                                                            
                                                            <tr class="success1">
                                                                <td>Flight No:</td>
                                                                <td><?php echo $flightnumber_ret?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Flight Type:</td>
                                                                <td><?php echo $name1?></td>
                                                            </tr>
                                                             <tr class="success1">
                                                                <td>Total Fare Amount:</td>
                                                                <td><?php echo $totalFareAmount?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Tax Amount:</td>
                                                                <td><?php echo $totalTaxAmount?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Adult:</td>
                                                                <td><?php echo $_SESSION['adults']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Child:</td>
                                                                <td><?php echo $_SESSION['childs']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Child:</td>
                                                                <td><?php echo $_SESSION['infants']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>Total Passenger:</td>
                                                                <td><?php echo $passenger_count?></td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
			
			
			<?php
			}
	}
		
		
	}
	else
	{
		$id=0;$lowest_price=0;
		$date_sess=date("m-d-y");
		$date_sess_ed=date("m-d-y");
	}
 }
	?>
    </div>
</div>
</div>
