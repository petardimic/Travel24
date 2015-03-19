<script type="text/javascript">
function display_rooms(val)
{
	if(val == 1)
	{
		$('.row_2').hide();
		$('.row_3').hide();
	}
	else if(val == 2)
	{
		$('.row_2').show();
		$('.row_3').hide();
		$("#roomrow_2").hide();
		$("#roomrow_3").hide();
	}
	else
	{
		$('.row_2').show();
		$('.row_3').show();
		$("#roomrow_2").hide();
		$("#roomrow_3").hide();
	}
}
function get_hotels()
{
	var city = $("#city").val();
	$.ajax
    ({
         type: "POST",
         url: "<?php echo WEB_URL?>home/get_hotels",
	     data: "city="+city,
		 success: function(msg)
         {
			$("#hotel_names").html(msg);
		 }
     });
}

$(document).ready(function() {
	
	 $(function(){
					$( "#sd_hotel" ).datepicker({
						numberOfMonths: 1,
						minDate: 0
					});
					$( "#ed_hotel" ).datepicker({
						numberOfMonths: 1,
						minDate: 0
					});
					
				});
	 		$('#sd_hotel').change(function(){
				
		   var selectedDate = $(this).datepicker('getDate');
		    var str1 = $( "#ed_hotel" ).val();
			
			var predayDate = dateADD(selectedDate);
			var str2 = zeroPad(predayDate.getDate(),2)+"/"+zeroPad((predayDate.getMonth()+1),2)+"/"+(predayDate.getFullYear());
			var dt1 = parseInt(str1.substring(0,2),10);
			var mon1 = parseInt(str1.substring(3,5),10);
			var yr1 = parseInt(str1.substring(6,10),10);
			var dt2 = parseInt(str2.substring(0,2),10);
			var mon2 = parseInt(str2.substring(3,5),10);
			var yr2 = parseInt(str2.substring(6,10),10);
			var date1 = new Date(yr1, mon1, dt1);
			var date2 = new Date(yr2, mon2, dt2);
			if(date2 < date1)
			{
			}
			else
			{
			   var nextdayDate  = dateADD(selectedDate);
			   var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"/"+zeroPad((nextdayDate.getMonth()+1),2)+"/"+(nextdayDate.getFullYear());
			   $t = nextDateStr;
			   $( "#ed_hotel" ).datepicker({
							numberOfMonths: 1,
							minDate: $t
						});
			   $( "#ed_hotel" ).val($t);
			}
		 });	
		 $('#ed_hotel').change(function(){
		   var selectedDate = $(this).datepicker('getDate');
		    var str1 = $( "#sd_hotel" ).val();
			var predayDate = dateSUB(selectedDate);
			var str2 = zeroPad(predayDate.getDate(),2)+"/"+zeroPad((predayDate.getMonth()+1),2)+"/"+(predayDate.getFullYear());
			var dt1 = parseInt(str1.substring(0,2),10);
			var mon1 = parseInt(str1.substring(3,5),10);
			var yr1 = parseInt(str1.substring(6,10),10);
			var dt2 = parseInt(str2.substring(0,2),10);
			var mon2 = parseInt(str2.substring(3,5),10);
			var yr2 = parseInt(str2.substring(6,10),10);
			var date1 = new Date(yr1, mon1, dt1);
			var date2 = new Date(yr2, mon2, dt2);
			if(date2 > date1)
			{
			}
			else
			{
			   var nextdayDate  = dateSUB(selectedDate);
			   var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"/"+zeroPad((nextdayDate.getMonth()+1),2)+"/"+(nextdayDate.getFullYear());
			   $t = nextDateStr;
			   $( "#sd_hotel" ).datepicker({
							numberOfMonths: 1,
							minDate: $t
						});
			   $( "#sd_hotel" ).val($t);
			}
		 });	
		
});
function dateADD(currentDate)
{
 var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
 var newDate =new Date(valueofcurrentDate);
 return newDate;
} 
function dateSUB(currentDate)
{
 var valueofcurrentDate=currentDate.valueOf()-(24*60*60*1000);
 var newDate =new Date(valueofcurrentDate);
 return newDate;
} 
function zeroPad(num,count)
{
	var numZeropad = num + '';
	while(numZeropad.length < count) {
	numZeropad = "0" + numZeropad;
	}
	return numZeropad;
}
function get_searchengine(val)
{
	if(val == 'H')
	{
		$("#hotel_search").show();
		$("#hotel_flight_search").hide();
	}
	if(val == 'FH')
	{
		$("#hotel_search").hide();
		$("#hotel_flight_search").show();
	}
}
</script>
<div class="search_engin">
<div class="search_head">Search For Hotel</div>
<div class="search_engin1">

<div class="hotel_search_engin_sub" style="background-image:none;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-left:15px;" >
      <tr>
        <td width="120" height="5" align="left" valign="top"  ></td>
        </tr>
      <tr>
        <td height="12" align="left" valign="top" ><table width="100%" border="0" align="left" style="float:left; margin-top:5px; font-weight:bold;" cellpadding="0" cellspacing="0">
          <tr>
            <td width="25" height="26" align="left" valign="middle"><input id="hotel" name="rnd_one" checked="checked" value="H" class="rdo"  type="radio"  onclick="get_searchengine(this.value);"  /></td>
            <td align="left" valign="middle" style="padding-top:5px;">Hotel only</td>
            <td width="20" align="left" valign="middle" style="padding-top:5px;"><input id="flight_hotel" name="rnd_one"  value="FH" class="rdo"  type="radio"  onclick="get_searchengine(this.value);"  /></td>
            <td align="left" valign="middle" style="padding-top:5px;">Flight + Hotel</td>
            </tr>
        </table></td>
        </tr>
    </table>

</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="float:left;" id="hotel_search">
  <form name="hotel" method="post" action="<?php echo WEB_URL ?>home/load_hotel">
    <tr>
      <td><table width="95%" border="0" cellpadding="0" cellspacing="0" style="margin-left:20px; font-size:11px; color:#060606;" >
        <tr>
          <td height="5"></td>
        </tr>
        <tr>
          <td><input type="text" name="hotel_city" id="city"  class="field"   style="width:290px; color:#666; " onfocus="if (this.value == 'Enter your City / Location') {this.value=''}" onblur="get_hotels(); if(this.value == '') { this.value='Enter your City / Location'}" value="Enter your City / Location" />
            
            
            </td>
          </tr>
        <script type="text/javascript">
	    var options = {
		script:"<?php echo WEB_DIR?>test.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('city').value = obj.id; } };
	    var as_json = new AutoSuggest('city', options);
        </script>
        <tr>
          <td height="15"></td>
          </tr>
        <tr>
          <td><select name="hotel_name" class="field" id="hotel_names" style="width:300px; color:#666;">
            <option value="">Select Hotel Name</option>
            </select>
            </td>
          </tr>
        
        <tr>
          <td height="5"></td>
          </tr>
        
        
        
        <tr>
          <td><table width="95%" border="0" cellpadding="1" cellspacing="0"  >
            <tr>
              <td height="23">Check-in Date</td>
              <td width="55">&nbsp;</td>
              <td>Number of Nights</td>
              </tr>
            <tr>
              <td class="sub_input_bg2"><input name="sd_hotel" type="text"  value=""  class="datefield"   id="sd_hotel"/></td>
              <td>&nbsp;</td>
              <td class="sub_input_bg2">
               <select class="field" name="nights" style="width:120px;"id="nights"/>
                <option value="">select</option>
                <?php for($i = 1; $i<=30; $i++)
								{?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php	}?> 
                </select>
                </td>
              </tr>
            </table></td>
          </tr>
        <tr>
          <td><table width="97%" border="0" cellpadding="0" cellspacing="0" style="padding-top:5px; ">
            <!-- <tr>
              <td height="19" align="left" valign="top" style="padding-top:8px;">Rooms</td>
              
              
              </tr>-->
            <tr>
              <td height="19" align="left" valign="top" style="padding-top:8px; ">Check-out Date</td>
              <td>Number of Rooms</td>
              </tr>
            <tr class="row_1">
              <td align="left" > <span id="out2"><input name="ed_hotel" type="text" class="datefield"  id="ed_hotel"/></span></td>
              
              <td id="duration_new"><select name="room_count" id="room_count" style="width:120px;"  class="field" onchange="display_rooms(this.value);" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                </select>
                </td>
              
              </tr>
            <tr>
              <!--<td align="left" ><select name="room_count" id="room_count" style="width:92px;"  class="field" onchange="display_rooms(this.value);" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                </select></td>-->
              
              
              <tr>
                <td height="19" align="left" valign="top" style="padding-top:8px; ">Room Types</td>
                
                </tr>
            <script type="text/javascript">
			  function get_roomtypes(room)
			  {
				  if(room == 'SGL')
				  {
					$("#roomrow_1").hide();
					$("#age1_tite").hide();
					$("#age2_tite").hide();
					$("#age1_room1").hide();
					$("#age2_room1").hide();
					$("#child_room1").hide();
					$("#child_title").hide();
				  }
				  else if(room == 'DBL')
				  {
					 $("#roomrow_1").show();
					 $("#child_room1").show();
					 $("#child_title").show();
				  }
				  else if(room == 'TWN')
				  {
					 $("#roomrow_1").show();
					  $("#child_room1").show();
					 $("#child_title").show();
				  }
				  else if(room == 'TPL')
				  {
					 $("#roomrow_1").hide();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
				  else if(room == 'QDR')
				  {
					 $("#roomrow_1").hide();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
				  else if(room == 'DBLSGL')
				  {
					  $("#roomrow_1").show();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
			  }
			  function get_child_ages(child)
			  {
				  //alert(child);
				  if(child == '1')
				  {
					  $("#age1_tite").show();
					  $("#age2_tite").hide();
					  $("#age1_room1").show();
					  $("#age2_room1").hide();
					  $("#infant_room1").hide();
					  $("#infant_tit").hide();
				  }
				  if(child == '2')
				  {
					   $("#age1_tite").show();
					   $("#age2_tite").show();
					   $("#age1_room1").show();
					   $("#age2_room1").show();
					   $("#infant_room1").hide();
				  }
				  if(child == '0')
				  {
					   $("#infant_room1").show();
					   $("#infant_tit").show();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
				  }
			  }
			   function get_roomtypes2(room)
			  {
				  if(room == 'SGL')
				  {
					$("#roomrow_2").hide();
					$("#age1_tite").hide();
					$("#age2_tite").hide();
					$("#age1_room1").hide();
					$("#age2_room1").hide();
					$("#child_room1").hide();
					$("#child_title").hide();
				  }
				  else if(room == 'DBL')
				  {
					 $("#roomrow_2").show();
					 $("#child_room1").show();
					 $("#child_title").show();
				  }
				  else if(room == 'TWN')
				  {
					 $("#roomrow_2").show();
					  $("#child_room1").show();
					 $("#child_title").show();
				  }
				  else if(room == 'TPL')
				  {
					 $("#roomrow_2").hide();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
				  else if(room == 'QDR')
				  {
					 $("#roomrow_2").hide();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
				  else if(room == 'DBLSGL')
				  {
					  $("#roomrow_2").show();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
				  else
				  {
					  $("#roomrow_2").hide();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
			  }
			  function get_child_ages2(child)
			  {
				  //alert(child);
				  if(child == '1')
				  {
					  $("#age1_tite2").show();
					  $("#age2_tite2").hide();
					  $("#age1_room2").show();
					  $("#age2_room2").hide();
					  $("#infant_room2").hide();
					  $("#infant_tit2").hide();
				  }
				  if(child == '2')
				  {
					   $("#age1_tite2").show();
					   $("#age2_tite2").show();
					   $("#age1_room2").show();
					   $("#age2_room2").show();
					   $("#infant_room2").hide();
				  }
				  if(child == '0')
				  {
					   $("#infant_room2").show();
					   $("#infant_tit2").show();
					  $("#age1_tite2").hide();
					  $("#age2_tite2").hide();
					  $("#age1_room2").hide();
					  $("#age2_room2").hide();
				  }
			  }
			  function get_roomtypes3(room)
			  {
				  if(room == 'SGL')
				  {
					$("#roomrow_3").hide();
					$("#age1_tite").hide();
					$("#age2_tite").hide();
					$("#age1_room1").hide();
					$("#age2_room1").hide();
					$("#child_room1").hide();
					$("#child_title").hide();
				  }
				  else if(room == 'DBL')
				  {
					 $("#roomrow_3").show();
					 $("#child_room1").show();
					 $("#child_title").show();
				  }
				  else if(room == 'TWN')
				  {
					 $("#roomrow_3").show();
					  $("#child_room1").show();
					 $("#child_title").show();
				  }
				  else if(room == 'TPL')
				  {
					 $("#roomrow_3").hide();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
				  else if(room == 'QDR')
				  {
					 $("#roomrow_3").hide();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
				  else if(room == 'DBLSGL')
				  {
					  $("#roomrow_3").show();
					  $("#age1_tite").hide();
					  $("#age2_tite").hide();
					  $("#age1_room1").hide();
					  $("#age2_room1").hide();
					  $("#child_room1").hide();
					  $("#child_title").hide();
				  }
				  else
				  {
					  $("#roomrow_3").hide();
					$("#age1_tite").hide();
					$("#age2_tite").hide();
					$("#age1_room1").hide();
					$("#age2_room1").hide();
					$("#child_room1").hide();
					$("#child_title").hide();
				  }
			  }
			  function get_child_ages3(child)
			  {
				  //alert(child);
				  if(child == '1')
				  {
					  $("#age1_tite3").show();
					  $("#age2_tite3").hide();
					  $("#age1_room3").show();
					  $("#age2_room3").hide();
					  $("#infant_room3").hide();
					  $("#infant_tit3").hide();
				  }
				  if(child == '2')
				  {
					   $("#age1_tite3").show();
					   $("#age2_tite3").show();
					   $("#age1_room3").show();
					   $("#age2_room3").show();
					   $("#infant_room3").hide();
					    $("#infant_tit3").hide();
				  }
				  if(child == '0')
				  {
					   $("#infant_room3").show();
					   $("#infant_tit3").show();
					  $("#age1_tite3").hide();
					  $("#age2_tite3").hide();
					  $("#age1_room3").hide();
					  $("#age2_room3").hide();
				  }
			  }
			  </script>
            
            <tr class="row_1">
              <td align="left" ><select name="room_types" id="room_types" style="width:170px;"  class="field" onchange="get_roomtypes(this.value);" >
                <option value="SGL">Single room</option>
                <option value="DBL">Double room</option>
                <option value="TWN">Twin room</option>
                <option value="TPL">Triple room</option>
                <option value="QDR">Quadruple room</option>
                <option value="DBLSGL">Double for Single Use</option>
                </select></td>
              
              
              
              </tr>
            <tr class="row_1">
              <td height="5" colspan="2" align="left" > </td>
              </tr>
            <tr id="roomrow_1" style="display:none;" class="row_1">
              <td height="16" colspan="2" align="left" ><table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="100" id="child_title"> Children </td>
                  <td id="age1_tite" style="display:none;"> Age1 </td>
                  <td id="age2_tite" style="display:none;"> Age2 </td>
                  <td id="infant_tit" > Cot </td>
                  </tr>
                <tr class="row_1">
                  <td><select name="child" id="child_room1" style="width:80px;  " class="field" onchange="get_child_ages(this.value);" >
                    <option value="0">select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </select></td>
                  <td><select name="child_age1" id="age1_room1" style="width:50px; display:none; "  class="field" >
                    <option value="0">select</option>
                    <?php for($i = 2; $i<=18; $i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?>
                    </select></td>
                  <td><select name="child_age2" id="age2_room1" style="width:50px; display:none;"  class="field" >
                    <option value="0">select</option>
                    <?php for($i = 2; $i<=18; $i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?>
                    </select></td>
                  <td align="left"><select name="infant" id="infant_room1" style="width:100px; "  class="field" >
                    <option value="">select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </select></td>
                  </tr>
                </table></td>
              </tr>
            <tr class="row_2" style="display:none;">
              <td align="left" ><select name="room_types2" id="room_types" style="width:170px;"  class="field" onchange="get_roomtypes2(this.value);" >
                <option value="" selected="selected">select</option>
                <option value="SGL">Single room</option>
                <option value="DBL">Double room</option>
                <option value="TWN">Twin room</option>
                <option value="TPL">Triple room</option>
                <option value="QDR">Quadruple room</option>
                <option value="DBLSGL">Double for Single Use</option>
                </select></td>
              
              
              
              </tr>
            <tr class="row_2"> 
              <td height="5" colspan="2" align="left" > </td>
              </tr>
            <tr id="roomrow_2" style="display:none;" class="row_2">
              <td height="16" colspan="2" align="left" ><table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="100" id="child_title"> Children </td>
                  <td id="age1_tite2" style="display:none;"> Age1 </td>
                  <td id="age2_tite2" style="display:none;"> Age2 </td>
                  <td id="infant_tit2" > Cot </td>
                  </tr>
                <tr class="row_1">
                  <td><select name="childroom2" id="child_room1" style="width:100px;  " class="field" onchange="get_child_ages2(this.value);" >
                    <option value="0">select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </select></td>
                  <td><select name="child2_age1" id="age1_room2" style="width:100px; display:none; "  class="field" >
                    <option value="0">select</option>
                    <?php for($i = 2; $i<=18; $i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?>
                    </select></td>
                  <td><select name="child2_age2" id="age2_room2" style="width:100px; display:none;"  class="field" >
                    <option value="0">select</option>
                    <?php for($i = 2; $i<=18; $i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?>
                    </select></td>
                  <td align="left"><select name="infant2" id="infant_room2" style="width:100px; "  class="field" >
                    <option value="">select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </select></td>
                  </tr>
                </table></td>
              </tr>
            
            <tr class="row_3" style="display:none;">
              <td align="left" ><select name="room_types3" id="room_types" style="width:170px;"  class="field" onchange="get_roomtypes3(this.value);" >
                <option value="" selected="selected">select</option>
                <option value="SGL">Single room</option>
                <option value="DBL">Double room</option>
                <option value="TWN">Twin room</option>
                <option value="TPL">Triple room</option>
                <option value="QDR">Quadruple room</option>
                <option value="DBLSGL">Double for Single Use</option>
                </select></td>
              
              
              
              </tr>
            <tr  class="row_3" >
              <td height="5" colspan="2" align="left" > </td>
              </tr>
            <tr id="roomrow_3" style="display:none;"  class="row_3"  >
              <td height="16" colspan="2" align="left" ><table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="100" id="child_title"> Children </td>
                  <td id="age1_tite3" style="display:none;"> Age1 </td>
                  <td id="age2_tite3" style="display:none;"> Age2 </td>
                  <td id="infant_tit3" > Cot </td>
                  </tr>
                <tr class="row_1">
                  <td><select name="childroom3" id="child_room1" style="width:80px;  " class="field" onchange="get_child_ages3(this.value);" >
                    <option value="0">select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </select></td>
                  <td><select name="child3_age1" id="age1_room3" style="width:50px; display:none; "  class="field" >
                    <option value="0">select</option>
                    <?php for($i = 2; $i<=18; $i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?>
                    </select></td>
                  <td><select name="child3_age2" id="age2_room3" style="width:50px; display:none;"  class="field" >
                    <option value="0">select</option>
                    <?php for($i = 2; $i<=18; $i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option><?php } ?>
                    </select></td>
                  <td align="left"><select name="infant3" id="infant_room3" style="width:100px; "  class="field" >
                    <option value="">select</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </select></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        <tr>
          <td align="right" valign="top"><input type="image" src="<?php print WEB_DIR ?>images/search.png" border="0" /></a></td>
          </tr>
        <tr>
          <td height="5"></td>
          </tr>
        </table></td>
      </tr>
  </form>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="float:left; display:none;" id="hotel_flight_search">
  <tr>
    <td><img src="<?php echo WEB_DIR?>images/commingsoon_flight.jpg" /></td>
  </tr>
  
</table>
</div>
</div>