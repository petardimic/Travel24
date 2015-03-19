<div id="panel12"  class="row-fluid" >
                     <div class="row-fluid top20">
                <div class="span6">
                    <div class="reisedetaljer-head">
                        <strong>Finn billigste reise</strong>
                    </div>
                </div>
                       <div class="span6 align-right">
                             <div id="hide" class="detail-cross-btn" onclick="slidehide();">Skjul detaljer X</div>
                </div>
            </div>
<div class="flight-calander">
                        <div class="row-fluid">
                            <div class="span12">
<?php 
//echo '<pre/>';print_r($flightDetails2);exit;
 $from=explode(',',$_SESSION['fromcityval']);
  $to=explode(',',$_SESSION['tocityval']);
  //print_r($to);
 $city_name=$this->Flight_Model->city($from[1]);
  $tocity=$this->Flight_Model->city($to[1]);?>
 <strong><?php echo  $city_name->city; ?>  To <?php echo $tocity->city?> <?php echo $_SESSION['sd']?></strong> 
 </div></div>
 <div class="row-fluid"> 
 <?php if($flightDetails1!='')
 {
	$r=0;
	
	if(!empty($flightDetails1))
	{
		$passenger_count=$_SESSION['adults']+$_SESSION['childs']+$_SESSION['infants'];
		if($flightDetails1['stops']==0){
			//echo 'fgxkdfjhk';
			
			$cityname=$this->Flight_Model->city($flightDetails1['dlocation']);
			$cityname1=$this->Flight_Model->city($flightDetails1['alocation']);?>
		
		<div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4><?php echo $city_name->city?> - <?php echo $city_name1->city?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th style="border-right:1px solid #DDDDDD;">Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Ankomstdato:</td>
                                                                <td><?php echo $flightDetails1['dep_date']?></td>
                                                            </tr>
                                                             <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Ankomsttid:</td>
                                                                <td> <?php $time=explode(' ',$flightDetails1['ddate1']);echo $time[1]?></td>
                                                            </tr>
                                                            
                                                            <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Flight nr:</td>
                                                                <td><?php echo $flightDetails1['fnumber']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Flight navn:</td>
                                                                <td><?php echo $flightDetails1['name']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Totalpris:</td>
                                                                <td><?php echo $flightDetails1['FareAmount'].' EUR'?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Skatter:</td>
                                                              <td><?php echo $flightDetails1['TaxAmount'].' EUR'?></td>
                                                            </tr>
                                                             <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Sum voksen:</td>
                                                               <td><?php echo $_SESSION['adults']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Sum barn:</td>
                                                              <td><?php echo $_SESSION['childs']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Sum spedbarn:</td>
                                                              <td><?php echo $_SESSION['infants']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td style="border-right:1px solid #DDDDDD;">Totalsum reisende:</td>
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
		
		<?php	}
			else{
				for($i=0;$i<=$flightDetails1['stops'];$i++){
					$city_name=$this->Flight_Model->city($flightDetails1['dlocation'][$i]);
					$city_name1=$this->Flight_Model->city($flightDetails1['alocation'][$i]);?>
				<div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4><?php echo $city_name->city?> - <?php echo $city_name1->city?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th style="border-right:1px solid #DDDDDD;">Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Ankomstdato:</td>
                                                                <td> <?php echo $flightDetails1['dep_date'][$i]?></td>
                                                            </tr>
                                                            
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Ankomsttid:</td>
                                                                <td> <?php $time=explode(' ',$flightDetails1['ddate1'][$i]);echo $time[1]?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Flight nr:</td>
                                                                <td><?php echo $flightDetails1['fnumber'][$i]?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Flight navn:</td>
                                                                <td><?php echo $flightDetails1['name'][$i]?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Totalpris:</td>
                                                                <td><?php echo $flightDetails1['FareAmount'].' EUR'?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Skatter:</td>
                                                                <td><?php echo $flightDetails1['TaxAmount'].' EUR'?></td>
                                                            </tr>
                                                             <tr class="success1">
                                                               <td style="border-right:1px solid #DDDDDD;">Sum voksen:</td>
                                                                <td><?php echo $_SESSION['adults']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Sum barn:</td>
                                                                <td><?php echo $_SESSION['childs']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Sum spedbarn:</td>
                                                                <td><?php echo $_SESSION['infants']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Totalsum reisende:</td>
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
		?>
		
		
                   
                            
                </div> 
                 <strong><?php echo $tocity->city; ?> - <?php echo $city_name->city?> <?php echo $_SESSION['ed']?></strong>            
              <div class="row-fluid">         
								
								<?php
			}
			if($flightDetails2!=''){
				$passenger_count=$_SESSION['adults']+$_SESSION['childs']+$_SESSION['infants'];
				if($flightDetails2['stops']==0){
					
					$cityname_ret=$this->Flight_Model->city($flightDetails2['dlocation']);
			$cityname_ret1=$this->Flight_Model->city($flightDetails2['alocation']);?>
                <div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4><?php echo $cityname_ret->city?> To <?php echo $cityname_ret1->city?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th style="border-right:1px solid #DDDDDD;">Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Hjemreisedato:</td>
                                                                <td> <?php echo $flightDetails2['dep_date']?> </td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Hjemreisetid:</td>
                                                                <td> <?php $time2=explode(' ',$flightDetails2['ddate1']);echo $time2[1]?></td>
                                                            </tr>
                                                            
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Flight nr:</td>
                                                                <td><?php echo $flightDetails2['fnumber']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Flight navn:</td>
                                                              <td><?php echo $flightDetails2['name']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Totalpris:</td>
                                                              <td><?php echo $flightDetails2['FareAmount'].' EUR'?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Skatter:</td>
                                                              <td><?php echo $flightDetails2['TaxAmount'].' EUR'?></td>
                                                            </tr>
                                                             <tr class="success1">
                                                               <td style="border-right:1px solid #DDDDDD;">Sum voksen:</td>
                                                               <td><?php echo $_SESSION['adults']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Sum barn:</td>
                                                              <td><?php echo $_SESSION['childs']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Sum spedbarn:</td>
                                                              <td><?php echo $_SESSION['infants']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Totalsum reisende:</td>
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
                
				<?php 	}
				else{
					for($s=0;$s<=$flightDetails2['stops'];$s++){
						//echo $flightDetails2['stops'];
						$city_name_ret=$this->Flight_Model->city($flightDetails2['dlocation'][$s]);
					$city_name_ret1=$this->Flight_Model->city($flightDetails2['alocation'][$s]);?>
						<div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4><?php echo $city_name_ret->city?> To <?php echo $city_name_ret1->city?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th style="border-right:1px solid #DDDDDD;">Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Hjemreisedato:</td>
                                                                <td> <?php echo $flightDetails2['dep_date'][$s]?> </td>
                                                            </tr>
                                                             <tr class="success1">
                                                               <td style="border-right:1px solid #DDDDDD;">Hjemreisetid:</td>
                                                                <td> <?php $time2=explode(' ',$flightDetails2['ddate1'][$s]);echo $time2[1]?></td>
                                                            </tr>
                                                            
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Flight nr:</td>
                                                                <td><?php echo $flightDetails2['fnumber'][$s]?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Flight navn:</td>
                                                                <td><?php echo $flightDetails2['name'][$s]?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Totalpris:</td>
                                                                <td><?php echo $flightDetails2['FareAmount'].' EUR'?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Skatter:</td>
                                                                <td><?php echo $flightDetails2['TaxAmount'].' EUR'?></td>
                                                            </tr>
                                                             <tr class="success1">
                                                               <td style="border-right:1px solid #DDDDDD;">Sum voksen:</td>
                                                                <td><?php echo $_SESSION['adults']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Sum barn:</td>
                                                                <td><?php echo $_SESSION['childs']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Sum spedbarn:</td>
                                                                <td><?php echo $_SESSION['infants']?></td>
                                                            </tr>
                                                            <tr class="success1">
                                                              <td style="border-right:1px solid #DDDDDD;">Totalsum reisende:</td>
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
			
			
		
	?>
		
		
		
    </div>
</div>
</div>

<?php //session_destroy();?>
 <script>     
function slidehide() {
$('#showinformation').hide();

}
</script>