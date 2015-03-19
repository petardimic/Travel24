 <?php 
 //echo'<pre/>ghghfg';print_r($fetch_result_id);exit;
 $from=explode(',',$_SESSION['fromcityval']);
  $to=explode(',',$_SESSION['tocityval']);
  //print_r($to);
 $city_name=$this->Flight_Model->city($from[1]);
  $tocity=$this->Flight_Model->city($to[1]);
 if($fetch_result_id!='')
 {
	$r=0;
	
	if(!empty($flightDetails1))
	{}
	else
	{
		$id=0;$lowest_price=0;
		$date_sess=date("m-d-y");
		$date_sess_ed=date("m-d-y");
	}
 }
 if($fetch_result_id['stops']==0){
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
                                <h4 style="margin: 0px;"><?php echo $fetch_result_id['dlocation'] ?> - <?php echo $fetch_result_id['alocation'] ?> | <?php echo $fetch_result_id['dep_date']?> &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['adults']?> voksen</h4>
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
                                        <div class="span8">
                                            <div class="row-fluid">
                                                
                                                    <label><?php echo $city_name->city;?></label>
                                                    <div class="span4">
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php echo $fetch_result_id['dlocation']?> <?php $time=explode(' ',$fetch_result_id['ddate1']);echo $time[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                                <div class="span2">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-left-icon.png">
                                                </div>
                                                <div class="span4">
                                                  
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php echo $fetch_result_id['alocation'] ?> <?php $time1=explode(' ',$fetch_result_id['adate1']);echo $time1[1];?>" style="background-color: #276baa;border: 1px solid #276baa;color:#fff;">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="span4">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php echo $fetch_result_id['duration_final']?>
                                                </div>
                                                <div class="span6">
                                                <?php 
												 ?>
                                                   <?php echo $fetch_result_id['stops']
                                                .' Stopp'?> (<?php echo  0?>)
                                                </div>
                                            </div>
                                            
                                            <div class="row-fluid align-right">
                                                <div class="span12">
                                                    <h5><a href="#" style="text-decoration: underline; color: #fff;">+2 ledige plasser</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="span4 align-right">
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <span> <b style=""><?php echo $fetch_result_id['Total_FareAmount'].' EUR'?></b></span>
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
            
            <?php } else{?>
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
                                <h4 style="margin: 0px;"><?php echo $fetch_result_id['dlocation'][0] ?> - <?php echo $fetch_result_id['alocation'][1] ?> | <?php echo $fetch_result_id['dep_date'][0]?> &nbsp; &nbsp; &nbsp; <?php echo $_SESSION['adults']?> voksen</h4>
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
                                        <div class="span8">
                                            <div class="row-fluid">
                                              
                                                    <label><?php echo $city_name->city;?></label>
                                                      <div class="span4">
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php echo $fetch_result_id['dlocation'][0]?> <?php $time=explode(' ',$fetch_result_id['ddate1'][0]);echo $time[1]?>" style="background-color: #276baa;border: 1px solid #276baa; color:#fff;">
                                                </div>
                                                <div class="span2">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-left-icon.png">
                                                </div>
                                                <div class="span4">
                                                  
                                                    <input type="text" readonly="readonly" class="span12 place-color" value="<?php echo $fetch_result_id['alocation'][1] ?> <?php $time1=explode(' ',$fetch_result_id['adate1'][0]);echo $time1[1];?>" style="background-color: #276baa;border: 1px solid #276baa;color:#fff;">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="span4">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                     <?php echo $fetch_result_id['duration_final1'][0]?>
                                                </div>
                                                <div class="span6">
                                                <?php 
												 ?>
                                                   <?php echo $fetch_result_id['stops']
                                                .' Stopp'?> (<?php echo  $fetch_result_id['dlocation'][1]?>)
                                                </div>
                                            </div>
                                            
                                            <div class="row-fluid align-right">
                                                <div class="span12">
                                                    <h5><a href="#" style="text-decoration: underline; color: #fff;">+2 ledige plasser</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="span4 align-right">
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <span> <b style=""><?php echo $fetch_result_id['Total_FareAmount'].' EUR'?></b></span>
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
            <?php } ?>
                      <div id="showinformation"></div>   
                         
                     <script>     function showmoreinform() {
	//alert('jhgjhgjgh');
	 $("#showinformation").html('');

$.ajax({
           type: "POST",
           url: "<?php echo WEB_URL; ?>flight/showmoreinform_oneway",
           
           success:function(response) {
            $("#showinformation").html(response);
           }

      });
}
//Call AJAX:
//$(document).ready(showdetials);
</script>