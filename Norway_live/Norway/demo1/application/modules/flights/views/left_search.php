<div style="height:8px;"></div>
                  <div class="lhsside_topbg"></div>
		<div class="lhsside_middliebg">
<form action="<?php echo WEB_URL; ?>flight/search" name="modifySearch" method="post" >
			    <div style="width:100%; float:left; color:#FFF; text-align:left; margin-left:10px; font-family:Arial, Helvetica, sans-serif;">
				<span style="font-size:30px; font-weight:bold; font-family:Arial, Helvetica, sans-serif;">Modify</span>your search</div>
               
    			   <div style="width:210px; float:left; margin-left:10px;" class="domesticTbl">
				<div class="flight_innerpage_from">
				    <div style="color:#FFF; font-size:12px; font-family:Arial, Helvetica, sans-serif;  height:58px;">From<br />

<script type="text/javascript" src="<?php print WEB_DIR; ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR; ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<p> <input type="hidden" id="testid" value="" style="font-size: 10px; width: 20px;" disabled="disabled" />
<input  name="from_city" value="<?php echo $_SESSION['fromcityval']; ?>"  style="width:205px;height:22px"  id="testinput"  type="text" size="28" />
<script type="text/javascript">
var options = {
script:"<?php print WEB_DIR; ?>test_city.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('testid').value = obj.id; } };
var as_json = new AutoSuggest('testinput', options);
</script>
				    </div>
					</div>

			<div class="flight_innerpage_from">
			    <div style="color:#FFF; font-size:12px; font-family:Arial, Helvetica, sans-serif; height:58px; margin-top:5px;">To<br />

<script type="text/javascript" src="<?php print WEB_DIR; ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR; ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<p> <input type="hidden" id="testid2" value="" style="font-size: 10px; width: 20px;" disabled="disabled" />
<input  name="to_city" value="<?php echo $_SESSION['tocityval']; ?>"  style="width:205px;height:22px"  id="testinput2"  type="text" size="28" />
<script type="text/javascript">
var options = {
script:"<?php print WEB_DIR; ?>test_city.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('testid2').value = obj.id; } };
var as_json = new AutoSuggest('testinput2', options);
</script> 
			    </div>
			</div>
			<div class="flight_innerpage_from">
			 <div style="color:#FFF; font-size:12px; font-family:Arial, Helvetica, sans-serif; height:22px; margin-top:5px;">Depart Date<br />
				  
					    <script type="text/javascript">
						$(document).ready(function()
						{
							$("#drop").change(function(){
								//alert($("#pickup").val());
								var drop = $("#pickup").val();
								if(drop == $(this).val()){
									alert('Picking and Droping point should not be same');
									//$("#drp").html('Picking and Droping point should not be same');
									return false;
								}
								if($("#drop").val() !='')
								{
									$('#drp').html('');
								}
							});
							
							$("#pickup").change(function(){
								//alert($("#pickup").val());
								
								if($("#pickup").val() !='')
								{
									$('#pic').html('');
								}
							});
							
							$("#submit1").click(function(){
								if($("#inputfiled").val() == ''){
									//alert('Enter city name');
									$('#cty').html('Select City Name');
									return false;
								} if($('#pickup').val() == ''){
									$('#pic').html('Select Picking Point');
									return false;
								} if($('#drop').val() == ''){
									//alert($('#drop').val());
									$('#drp').html('Select Droping Point');
									return false;
								}
							
							
								var drop = $("#pickup").val();
									var drop1 = $("#drop").val();
								if(drop == drop1){
									alert('Picking and Droping point should not be same');
									//$("#drp").html('Picking and Droping point should not be same');
									return false;
								}
								
								
							});
							
							
							
						    $val=$("input[name='mode']").val();
						    if($val==1) 
						    {
							$("#domesticTbl").show();
							$(".internationalTbl").hide();
						    }
						    else 
						    {
							$("#domesticTbl").hide();
							$(".internationalTbl").show();
						    }
							
						    $("input[name='mode']").change(function()
						    {
							$val=$(this).val();
							if($val==1) 
							{
							    $("#domesticTbl").show();
							    $(".internationalTbl").hide();
							}
							else 
							{
							    $("#domesticTbl").hide();
							    $(".internationalTbl").show();
							}
						    });
						});
						
						function zeroPad(num,count)
						{
						    var numZeropad = num + '';
						    while(numZeropad.length < count) {
							numZeropad = "0" + numZeropad;
						    }
						    return numZeropad;
						}
						function dateADD(currentDate)
						{
						    var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
						    var newDate =new Date(valueofcurrentDate);
						    return newDate;
						}
						function dateADD1(currentDate)
						{
						    var valueofcurrentDate=currentDate.valueOf()-(24*60*60*1000);
						    var newDate =new Date(valueofcurrentDate);
						    return newDate;
						}

						$(function() {
						    $( "#datepicker" ).datepicker({
							numberOfMonths: 3,
							dateFormat: 'dd-mm-yy',
			
							minDate: 0
		  
						    });
						    $( "#datepicker1" ).datepicker({
							numberOfMonths: 3,
							dateFormat: 'dd-mm-yy',
			
							minDate: 1
		  
						    });
		
		
		
						    $('#datepicker').change(function(){
							//$t=$(this).val();
						
							var selectedDate = $(this).datepicker('getDate');
							var str1 = $( "#datepicker" ).val();
		
							var predayDate  = dateADD(selectedDate);
							var str2 = zeroPad(predayDate.getDate(),2)+"-"+zeroPad((predayDate.getMonth()+1),2)+"-"+(predayDate.getFullYear());

	
							var dt1  = parseInt(str1.substring(0,2),10);
							var mon1 = parseInt(str1.substring(3,5),10);
							var yr1  = parseInt(str1.substring(6,10),10);
							var dt2  = parseInt(str2.substring(0,2),10);
							var mon2 = parseInt(str2.substring(3,5),10);
							var yr2  = parseInt(str2.substring(6,10),10);
							var date1 = new Date(yr1, mon1, dt1);
							var date2 = new Date(yr2, mon2, dt2);
							if(date2 < date1)
							{
		 
							}
							else
							{
							    var nextdayDate  = dateADD(selectedDate);
							    var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());

							    $t = nextDateStr;
							    $( "#datepicker1" ).datepicker({
								numberOfMonths: 1,
								dateFormat : 'dd-mm-yy',
								minDate: 1
							    });
							    $( "#datepicker1" ).val($t);
							    // $('#datepicker1').datepicker('option', 'minDate', $t);s
							}							   
						    });
		  
						    $('#datepicker1').change(function(){
							//$t=$(this).val();
		 
							var selectedDate = $(this).datepicker('getDate');
							var str1 = $( "#datepicker" ).val();
		
							var predayDate  = dateADD1(selectedDate);
							var str2 = zeroPad(predayDate.getDate(),2)+"-"+zeroPad((predayDate.getMonth()+1),2)+"-"+(predayDate.getFullYear());

	
							var dt1  = parseInt(str1.substring(0,2),10);
							var mon1 = parseInt(str1.substring(3,5),10);
							var yr1  = parseInt(str1.substring(6,10),10);
							var dt2  = parseInt(str2.substring(0,2),10);
							var mon2 = parseInt(str2.substring(3,5),10);
							var yr2  = parseInt(str2.substring(6,10),10);
							var date1 = new Date(yr1, mon1, dt1);
							var date2 = new Date(yr2, mon2, dt2);
							if(date2 < date1)
							{
							    var nextdayDate  = dateADD1(selectedDate);
							    var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());

							    $t = nextDateStr;
							    $( "#datepicker" ).datepicker({
								numberOfMonths: 1,
								dateFormat : 'dd-mm-yy',
								minDate: 0
							    });
							    $( "#datepicker" ).val($t);
							}
							else
							{
		 
							    // $('#datepicker1').datepicker('option', 'minDate', $t);s
							}
						    });
						    
						    $( "#datepicker2,#datepicker4" ).datepicker({
							numberOfMonths: 1,
							dateFormat: 'dd-mm-yy',			
							minDate: 0
		  
						    });
						    $( "#datepicker3,#datepicker5" ).datepicker({
							numberOfMonths: 1,
							dateFormat: 'dd-mm-yy',			
							minDate: 1		  
						    });

						    $('#datepicker4').change(function()
						    {
							//$t=$(this).val();
							var selectedDate = $(this).datepicker('getDate');
							var str1 = $( "#datepicker4" ).val();
		
							var predayDate  = dateADD(selectedDate);
							var str2 = zeroPad(predayDate.getDate(),2)+"-"+zeroPad((predayDate.getMonth()+1),2)+"-"+(predayDate.getFullYear());

	
							var dt1  = parseInt(str1.substring(0,2),10);
							var mon1 = parseInt(str1.substring(3,5),10);
							var yr1  = parseInt(str1.substring(6,10),10);
							var dt2  = parseInt(str2.substring(0,2),10);
							var mon2 = parseInt(str2.substring(3,5),10);
							var yr2  = parseInt(str2.substring(6,10),10);
							var date1 = new Date(yr1, mon1, dt1);
							var date2 = new Date(yr2, mon2, dt2);
							if(date2 < date1)
							{
		 
							}
							else
							{
							    var nextdayDate  = dateADD(selectedDate);
							    var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());

							    $t = nextDateStr;
							    $( "#datepicker5" ).datepicker({
								numberOfMonths: 1,
								dateFormat : 'dd-mm-yy',
								minDate: 1
							    });
							    $( "#datepicker5" ).val($t);
							}							   
						    });
		  
						    $('#datepicker3').change(function()
						    {
							var selectedDate = $(this).datepicker('getDate');
							var str1 = $( "#datepicker2" ).val();
		
							var predayDate  = dateADD1(selectedDate);
							var str2 = zeroPad(predayDate.getDate(),2)+"-"+zeroPad((predayDate.getMonth()+1),2)+"-"+(predayDate.getFullYear());

	
							var dt1  = parseInt(str1.substring(0,2),10);
							var mon1 = parseInt(str1.substring(3,5),10);
							var yr1  = parseInt(str1.substring(6,10),10);
							var dt2  = parseInt(str2.substring(0,2),10);
							var mon2 = parseInt(str2.substring(3,5),10);
							var yr2  = parseInt(str2.substring(6,10),10);
							var date1 = new Date(yr1, mon1, dt1);
							var date2 = new Date(yr2, mon2, dt2);
							if(date2 < date1)
							{
							    var nextdayDate  = dateADD1(selectedDate);
							    var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());

							    $t = nextDateStr;
							    $( "#datepicker2" ).datepicker({
								numberOfMonths: 1,
								dateFormat : 'dd-mm-yy',
								minDate: 0
							    });
							    $( "#datepicker2" ).val($t);
							}
							else
							{
		 
							    // $('#datepicker1').datepicker('option', 'minDate', $t);s
							}
						    });	
						});
						
						
						
						
						
						
					    </script>
					    <?php
					    $current_dte = date("d-m-Y", strtotime("+7 days"));
					    $next_dte = date("d-m-Y", strtotime("+8 days"));
					    if (!$this->input->cookie('sd'))
					    {
						$sd_val = $current_dte;
						$ed_val = $next_dte;
					    } else
					    {
						$sd_val = $this->input->cookie('sd');
						$ed_val = $this->input->cookie('ed');
					    }
					    ?>
					    <input  value="<?php echo $_SESSION['sd']; ?>" name="sd" id="datepicker"   readonly="readonly" class="CHECK_TX_BG" type="text" /></div>
			</div><div style="height:15px; clear:both;">&nbsp;</div>
			
<table width="100%" border="0" cellspacing="0" cellpadding="0">
				    <tr>
					<td align="left" class="flight_innerpage_adult">
					    <div style="color:#FFF; font-size:12px; font-family:Arial, Helvetica, sans-serif; height:56px;">Adult <span style="font-size:10px; color:#CCC; font-family:Arial, Helvetica, sans-serif;">12+</span><br />

						<select name="adult" class="engin_text_box" style="width:60px;">
						    <?php
						    for ($i = 1; $i <= 4; $i++)
						    {if($i!=$_SESSION['adults'])
							{
							?>
    						    <option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php }else { ?>
						    <option selected="selected" value="<?php echo $i?>"> <?php echo $i; ?></option>;
							<?php
						    }}
						    ?>
						</select>
					    </div>
					</td>
					<td align="left" class="flight_innerpage_adult">
					    <div style="color:#FFF; font-size:12px; font-family:Arial, Helvetica, sans-serif; height:56px; margin-left:14px;">Child <span style="font-size:10px; color:#CCC; font-family:Arial, Helvetica, sans-serif;">2-11</span><br />

						<select name="child" class="engin_text_box" style="width:60px;">
						    <?php
						    for ($i = 0; $i <= 3; $i++)
						    {if($i!=$_SESSION['childs'])
							{
							?>
    						    <option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php }else { ?>
						    <option selected="selected" value="<?php echo $i?>"> <?php echo $i; ?></option>;
							<?php
						    }}
						    ?>
						</select>
					    </div>
					</td>
					<td align="left" class="flight_innerpage_adult">
					    <div style="color:#FFF; font-size:12px; font-family:Arial, Helvetica, sans-serif; height:56px; margin-left:14px;">Infant <span style="font-size:10px; color:#CCC;">0-2</span><br />
							
						<select name="infant" class="engin_text_box" style="width:60px; float:none;">
						    <?php
						    for ($i = 0; $i <= 2; $i++)
						    {	if($i!=$_SESSION['infants'])
							{
							?>
    						    <option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php }else { ?>
						    <option selected="selected" value="<?php echo $i?>"> <?php echo $i; ?></option>;
							<?php
						    }}
						    ?>
						</select>
					    </div>
					</td>
				    </tr>
				</table>
                <div style="height:10px; clear:both;">&nbsp;</div>		
				
				<table width="210" border="0" cellspacing="0" cellpadding="0">
				    <tr>
					<td height="50" align="right">
					    <input type="image" src="<?php echo WEB_DIR; ?>images/search_bt.png" width="83" height="27" border="0" />
					</td>
				    </tr>
				</table>

				</div>
		</form>
</div>
