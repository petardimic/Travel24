
<?php 
//echo '<pre/>';print_r($finalinformation);exit;?>
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
//echo '<pre/>';print_r($finalinformation);exit;
 $from=explode(',',$_SESSION['fromcityval']);
  $to=explode(',',$_SESSION['tocityval']);
  //print_r($to);
 $city_name=$this->Flight_Model->city($from[1]);
  $tocity=$this->Flight_Model->city($to[1]);
 if($finalinformation!='')
 {
	
	
	if(!empty($finalinformation))
	{
		
		
		$totalFareAmount=$finalinformation['Total_FareAmount'];
			$totalTaxAmount=$finalinformation['TaxAmount'];
		$passenger_count=$_SESSION['adults']+$_SESSION['childs']+$_SESSION['infants'];?>
		<strong><?php echo  $city_name->city; ?>  To <?php echo $tocity->city?> <?php echo $_SESSION['sd']?></strong> 
		</div></div>
         <div class="row-fluid">                             
		<?php
		//$count_code = count($flightDetails1['oneWay']['marketingCarrier']);
		//echo $count_code;
		
		if($finalinformation['stops']==0){
								  	$locationIdDeparture=$finalinformation['dlocation'];
									$locationIdArival=$finalinformation['alocation'];
									$flightnumber=$finalinformation['fnumber'];
									$name=$finalinformation['name'];
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
                                                                <td> <?php $time=explode(' ',$finalinformation['ddate1'][0]);echo $time[0]?>" </td>
                                                                <td> <?php echo $time[1]?></td>
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
				for($i=0;$i<=$finalinformation['stops'];$i++){
				//	echo $finalinformation['stops'];
								 $locationIdDeparture=$finalinformation['dlocation'][$i];
								$locationIdArival=$finalinformation['alocation'][$i];
								
								$flightnumber=$finalinformation['fnumber'][$i];
								$name = $finalinformation['name'][$i];
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
                                                                <td> <?php $time=explode(' ',$finalinformation['ddate1'][$i]);echo $time[0]?> </td>
                                                                <td> <?php echo $time[1]?></td>
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
                               
                       
                       
				<?php }
		
		
		
		
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
