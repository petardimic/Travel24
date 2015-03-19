<script type="text/javascript">
function display_rooms(val)
{
	if(val == 1)
	{
		$('#row2').hide();
		$('#row3').hide();
	}
	else if(val == 2)
	{
		$('#row2').show();
		$('#row3').hide();
	}
	else
	{
		$('#row2').show();
		$('#row3').show();
	}
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
</script>
<div class="search_engin">
<div class="search_head">Search For Flight</div>
<div class="search_engin1">

<div class="hotel_search_engin_sub">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-left:15px;" >
      <tr>
        <td width="120" align="left" valign="top"  ></td>
        <td height="12" align="left" valign="top" ></td>
      </tr>
      <tr>
        <td align="left" valign="top" ><table width="100%" border="0" align="left" style="float:left; margin-top:5px; font-weight:bold;" cellpadding="0" cellspacing="0">
          <tr>
            <td width="25" height="26" align="left" valign="middle"><input id="otripid7" name="rnd_one" checked="checked" value="O" class="rdo"  type="radio"  /></td>
            <td width="88" align="left" valign="middle" style="padding-top:5px;">Flight only</td>
          </tr>
          <tr>
            <td height="26" align="left" valign="middle"><input id="otripid8" name="rnd_one"  value="O" class="rdo"  type="radio"  /></td>
            <td align="left" valign="middle" style="padding-top:5px;">Flight + Hotel</td>
            </tr>
        </table></td>
        <td height="12" valign="top"  >&nbsp;</td>
      </tr>
      <tr>
        <td></td>
        <td height="15"></td>
      </tr>
    </table>

</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="float:left;">
  <form name="hotel" method="post" action="<?php echo WEB_URL ?>home/load_hotel">
    <tr>
      <td><table width="95%" border="0" cellpadding="0" cellspacing="0" style="margin-left:20px; font-size:11px; color:#060606;" >
        <tr>
          <td height="15"><table width="55%" border="0" align="left" style="float:left; margin-top:5px; font-weight:bold;" cellpadding="0" cellspacing="0">
            <tr>
              <td width="10" height="26" align="left" valign="middle"><input id="otripid" name="rnd_one" checked="checked" value="O" class="rdo"  type="radio"  /></td>
              <td align="left" valign="middle" style="padding-top:5px;">One Way </td>
              <td width="10" align="left" valign="middle" style="padding-top:5px;"><input id="otripid2" name="rnd_one" checked="checked" value="O" class="rdo"  type="radio"  /></td>
              <td align="left" valign="middle" style="padding-top:5px;">Round trip</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="15"></td>
          </tr>
        <tr>
          <td height="12" valign="top" >From</td>
          </tr>
        <tr>
          <td height="3"></td>
          </tr>
        <tr>
          <td><input name="hotel_city" type="text" class="field" id="city"  />
            </td>
          </tr>
        <script type="text/javascript">
	    var options = {
		script:"<?php echo WEB_DIR?>test.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('city').value = obj.id; } };
	    var as_json = new AutoSuggest('city', options);
        </script>
        <tr>
          <td height="5"></td>
        </tr>
        <tr>
          <td height="12" valign="top" >To</td>
        </tr>
        <tr>
          <td height="3"></td>
        </tr>
        <tr>
          <td><input name="city" type="text" class="field" id="city2"  /></td>
        </tr>
        <tr>
          <td><table width="30%" border="0" cellpadding="1" cellspacing="0"  >
            <tr>
              <td height="23">Departure</td>
              <td width="35">&nbsp;</td>
              <td>Return</td>
              </tr>
            <tr>
              <td class="sub_input_bg2"><input name="sd_hotel" type="text"  value=""  class="datefield"   id="sd_hotel"/></td>
              <td>&nbsp;</td>
              <td class="sub_input_bg2"><span id="out2">
                <input name="ed_hotel" type="text" value="" class="datefield"     id="ed_hotel"/>
                </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="10"> </td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td width="100">Adult(s)</td>
              <td width="100">Children(s)</td>
              <td width="100">lnfant(s)</td>
              </tr>
            <tr>
              <td><select name="child[]2" id="child[]" style="width:80px; " class="field" onchange="get_child_ages(this.value);" >
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select></td>
              <td><select name="child[]3" id="child[]2" style="width:80px; " class="field" onchange="get_child_ages(this.value);" >
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select></td>
              <td><select name="child[]4" id="child[]3" style="width:80px; " class="field" onchange="get_child_ages(this.value);" >
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="97%" border="0" cellpadding="0" cellspacing="0" style="padding-top:5px; ">
            <tr>
              <td height="20" align="left" valign="top" style="padding-top:8px; ">Cabin Class</td>
              <!-- <td width="25" align="left" valign="top" style="padding-top:8px;">&nbsp;</td>-->
              
              <!--<td width="25" align="left" valign="top" style="padding-top:8px;">&nbsp;</td>-->
              <!-- <td width="25" align="left" valign="top" style="padding-top:8px;">&nbsp;</td>-->
              </tr>
            <script type="text/javascript">
			  function get_roomtypes(room)
			  {
				  if(room == 'SGL')
				  {
					$("#roomrow_1").hide();
				  }
				  else if(room == 'DBL')
				  {
					 $("#roomrow_1").show();
				  }
				  else if(room == 'TWN')
				  {
					 $("#roomrow_1").show();
				  }
				  else if(room == 'TPL')
				  {
					 $("#roomrow_1").hide();
				  }
				  else if(room == 'QDR')
				  {
					 $("#roomrow_1").hide();
				  }
				  else if(room == 'DBLSGL')
				  {
					  $("#roomrow_1").show();
					  
				  }
			  }
			  function get_child_ages(child)
			  {
				  if(child == '1')
				  {
					  $("#age1_tite").show();
					  $("#age2_tite").hide();
					   $("#age1_room1").show();
					   $("#age2_room1").hide();
				  }
				  else  if(child == '2')
				  {
					   $("#age1_tite").show();
					   $("#age2_tite").show();
					   $("#age1_room1").show();
					   $("#age2_room1").show();
				  }
				  else
				  {
					  $("#age1_tite").hide();
					   $("#age2_tite").hide();
					   $("#age1_room1").hide();
					   $("#age2_room1").hide();
				  }
			  }
			  </script>
            <tr>
              <td align="left" ><select name="room_types[]" id="room_types" style="width:170px;"  class="field" onchange="get_roomtypes(this.value);" >
                <option selected="selected" value="E">Economy</option>
<option value="B">Business</option>
                </select></td>
              
              
              
              </tr>
            <!--  <tr><td colspan="5" height="10"></td></tr>
               <tr style="display:none;" id="row2">
              <td align="left" ></td>
              <td align="left" >&nbsp;</td>
              <td align="left" ><select name="adult[]" id="adult" style="width:92px; " class="field" >
              	<option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                </select></td>
              <td align="left" >&nbsp;</td>
              <td height="16" align="left" > 
                <select name="child[]" id="child" style="width:92px;"  class="field" >
                 <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                
                  </select></td>
              
              </tr>
              <tr><td colspan="5" height="10"></td></tr>
               <tr style="display:none" id="row3">
              <td align="left" ></td>
              <td align="left" >&nbsp;</td>
              <td align="left" ><select name="adult[]" id="adult" style="width:92px; " class="field" >
              	<option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                </select></td>
              <td align="left" >&nbsp;</td>
              <td height="16" align="left" > 
                <select name="child[]" id="child" style="width:92px;"  class="field" >
                 <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                
                  </select></td>
              
              </tr>-->
            </table></td>
          </tr>
        <tr>
          <td align="right"><input type="image" src="<?php print WEB_DIR ?>images/search.png" border="0" /></a></td>
          </tr>
        <tr>
          <td height="5"></td>
          </tr>
        </table></td>
      </tr>
  </form>
</table>


</div>
</div>