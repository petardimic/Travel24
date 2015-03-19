<?php
    $adult_arr=array();

    $adult_arr[] = "1";
    $adult_arr[] = "2";
    $adult_arr[] = "3";
    $adult_arr[] = "4";
    $adult_arr[] = "5";
    $adult_arr[] = "6";
    $adult_arr[] = "7";
    $adult_arr[] = "8";
    $adult_arr[] = "9";

    $adult_arr1[1][] = "0";
    $adult_arr1[1][] = "1";
    $adult_arr1[1][] = "2";
    $adult_arr1[1][] = "3";
    $adult_arr1[1][] = "4";
    $adult_arr1[1][] = "5";
    $adult_arr1[1][] = "6";
    $adult_arr1[1][] = "7";
    $adult_arr1[1][] = "8";

    $adult_arr1[2][] = "0";
    $adult_arr1[2][] = "1";
    $adult_arr1[2][] = "2";
    $adult_arr1[2][] = "3";
    $adult_arr1[2][] = "4";
    $adult_arr1[2][] = "5";
    $adult_arr1[2][] = "6";
    $adult_arr1[2][] = "7";

    $adult_arr1[3][] = "0";
    $adult_arr1[3][] = "1";
    $adult_arr1[3][] = "2";
    $adult_arr1[3][] = "3";
    $adult_arr1[3][] = "4";
    $adult_arr1[3][] = "5";
    $adult_arr1[3][] = "6";

    $adult_arr1[4][] = "0";
    $adult_arr1[4][] = "1";
    $adult_arr1[4][] = "2";
    $adult_arr1[4][] = "3";
    $adult_arr1[4][] = "4";
    $adult_arr1[4][] = "5";


    $adult_arr1[5][] = "0";
    $adult_arr1[5][] = "1";
    $adult_arr1[5][] = "2";
    $adult_arr1[5][] = "3";
    $adult_arr1[5][] = "4";

    $adult_arr1[6][] = "0";
    $adult_arr1[6][] = "1";
    $adult_arr1[6][] = "2";
    $adult_arr1[6][] = "3";

    $adult_arr1[7][] = "0";
    $adult_arr1[7][] = "1";
    $adult_arr1[7][] = "2";

    $adult_arr1[8][] = "0";
    $adult_arr1[8][] = "1";

    $adult_arr2[9][] = "0";
    $adult_arr2[9][] = "1";
    $adult_arr2[9][] = "2";
    $adult_arr2[9][] = "3";
    $adult_arr2[9][] = "4";
    $adult_arr2[9][] = "5";
    $adult_arr2[9][] = "6";
    $adult_arr2[9][] = "7";
    $adult_arr2[9][] = "8";
    $adult_arr2[9][] = "9";

    $adult_arr2[8][] = "0";
    $adult_arr2[8][] = "1";
    $adult_arr2[8][] = "2";
    $adult_arr2[8][] = "3";
    $adult_arr2[8][] = "4";
    $adult_arr2[8][] = "5";
    $adult_arr2[8][] = "6";
    $adult_arr2[8][] = "7";
    $adult_arr2[8][] = "8";

    $adult_arr2[7][] = "0";
    $adult_arr2[7][] = "1";
    $adult_arr2[7][] = "2";
    $adult_arr2[7][] = "3";
    $adult_arr2[7][] = "4";
    $adult_arr2[7][] = "5";
    $adult_arr2[7][] = "6";
    $adult_arr2[7][] = "7";

    $adult_arr2[6][] = "0";
    $adult_arr2[6][] = "1";
    $adult_arr2[6][] = "2";
    $adult_arr2[6][] = "3";
    $adult_arr2[6][] = "4";
    $adult_arr2[6][] = "5";
    $adult_arr2[6][]= "6";

    $adult_arr2[5][] = "0";
    $adult_arr2[5][] = "1";
    $adult_arr2[5][] = "2";
    $adult_arr2[5][] = "3";
    $adult_arr2[5][] = "4";
    $adult_arr2[5][] = "5";

    $adult_arr2[4][] = "0";
    $adult_arr2[4][] = "1";
    $adult_arr2[4][] = "2";
    $adult_arr2[4][] = "3";
    $adult_arr2[4][] = "4";

    $adult_arr2[3][] = "0";
    $adult_arr2[3][] = "1";
    $adult_arr2[3][] = "2";
    $adult_arr2[3][] = "3";

    $adult_arr2[2][] = "0";
    $adult_arr2[2][] = "1";
    $adult_arr2[2][] = "2";

    $adult_arr2[1][] = "0";
    $adult_arr2[1][] = "1";
?>

<div style="float:left; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
<form name="flight_search"  method="POST" action="<?php echo site_url(); ?>/flights/search">
    <input type="radio"  name="journey_type" value="OneWay" id="oneway"  <?php echo($_SESSION['journey_type']=='OneWay' ? 'checked' : ''); ?>/><span >One Way&nbsp;&nbsp;</span>
    <input type="radio"  name="journey_type" value="Round" id="roundtrip" <?php echo($_SESSION['journey_type']=='Round' ? 'checked' : ''); ?> /><span style=" ">Round Trip&nbsp;&nbsp;</span>
    <div style="clear:both;"></div>
    <?php /*?><input type="radio" style="font-size:10px;" name="journey_type" value="MultiCity" id="multicity" <?php echo($_SESSION['journey_type']=='MultiCity' ? 'checked' : ''); ?> /><span  >Multi City</span><?php */?>
    <div style="clear:both;"></div>
    <label style="margin:12px 0px 5px 5px; float:left; ">Leaving From</label>
    <input type="text" class="search_input_box" style="font-size:12px; width:175px;" name="from_city" id="airportcodeinput" value="<?php echo(isset($_SESSION['fromcityval']) ? $_SESSION['fromcityval'] : ''); ?>" /> 
    <div style="clear:both;"></div>
    <label style="margin:5px 0px 3px 5px; float:left; ">Travelling To</label>
    <input type="text" class="search_input_box"  style="font-size:12px;  width:175px;" name="to_city" id="testtoinput" onblur="addinanotherinput1(this.value)" value="<?php echo(isset($_SESSION['tocityval']) ? $_SESSION['tocityval'] : ''); ?>" /> 
    <div style="clear:both;"></div>
    <div class="wid100 top10 fleft" style="margin:9px 0px 3px 5px; float:left; "><label style="margin:0px 0px 3px 5px; float:left; ">Departure</label>
        <input type="text" class="search_input_box5" name="sd" id="datepicker" readonly="readonly" style="font-size:12px; padding:0px 5px;" value="<?php echo(isset($_SESSION['sd']) ? $_SESSION['sd'] : ''); ?>" /> </div>
        
        
    <div class="wid100 top10 fleft" id="return_date" <?php echo($_SESSION['journey_type']=='Round'?'style="display:block"':'style="display:none"'); ?>><label style="margin:0px 0px 3px 5px; float:left; ">Return</label>
        <input type="text" class="search_input_box5" name="ed" style="font-size:12px; padding:0px 5px;  " id="datepicker1" readonly="readonly" value="<?php echo(isset($_SESSION['ed']) ? $_SESSION['ed'] : ''); ?>" /> </div>
       

    <div style="clear:both;"></div>
    <div class="wid100 top10 fleft" style="margin-left:5px; margin-top:3px; width:92px;"><label style="margin:5px 0px 3px 5px; float:left; ">Adult(12+)</label>
        <select name="adult" id="s1" class="search_input_box2" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; padding:5px; height:30px; width:85px;">
            <?php foreach($adult_arr as $sa) { ?>
                <option value="<?php echo $sa; ?>" <?php echo($_SESSION['adults']==$sa ? 'selected="selected"' : ''); ?>><?php echo $sa; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="wid100 top10 fleft" style="margin-left:5px; margin-top:3px; width:85px;" ><label style="margin:5px 0px 3px 5px; float:left; ">Child(2-11)</label>
        <div id="child">
            <select id="s2" name="child" class="search_input_box2"  style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; padding:5px; height:30px; width:85px;">
                <option value="<?php echo $_SESSION['childs']; ?>"><?php echo $_SESSION['childs']; ?></option>
            </select>
        </div>
    </div>
    <div style="clear:both;"></div>
    <div class="wid100 top10 fleft" style="margin-left:5px; margin-top:3px; width:92px;""><label style="margin:5px 0px 3px 5px; float:left; ">Infant(0-2)</label>
        <select id="s3" name="infant" class="search_input_box2"  style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; padding:5px; height:30px; width:85px;">
                <option value="<?php echo $_SESSION['infants']; ?>"><?php echo $_SESSION['infants']; ?></option>
        </select>
    </div>
    <div class="wid100 top10 fleft" style="margin-left:5px; margin-top:3px; width:85px;"><label style="margin:5px 0px 3px 5px; float:left; ">Cabin</label>
        <select name="cabin" style="-moz-appearance: none; -webkit-appearance: none; text-indent: 0.01px; text-overflow: ''; padding:5px; height:30px; width:85px;" class="search_input_box2" >
                <option value="All" <?php echo($_SESSION['cabin']=='All' ? 'selected="selected"' : ''); ?>>All</option>
                <option value="First, Supersonic" <?php echo($_SESSION['cabin']=='First, Supersonic' ? 'selected="selected"' : ''); ?>>First, Supersonic</option>
                <option value="Business" <?php echo($_SESSION['cabin']=='Business' ? 'selected="selected"' : ''); ?>>Business</option>
                <option value="Economic" <?php echo($_SESSION['cabin']=='Economic' ? 'selected="selected"' : ''); ?>>Economic</option>
                <option value="Premium Economy" <?php echo($_SESSION['cabin']=='Premium Economy' ? 'selected="selected"' : ''); ?>>Premium Economy</option>
                <option value="Standard Economy" <?php echo($_SESSION['cabin']=='Standard Economy' ? 'selected="selected"' : ''); ?>>Standard Economy</option>
        </select>
    </div>
     <div style="clear:both;"></div>
    
    <div style="margin:5px 5px 5px 5px; "><input type="button" name="modify_search" value="SEARCH" onclick="return submitFlight();" style="padding:5px 10px; background: linear-gradient(180deg, #BB1010 35%, #F80000 76%) repeat scroll 0 0 rgba(0, 0, 0, 0); border: 2px solid #FFFFFF;
    border-radius: 5px;
    color: #FFFFFF;
    cursor: pointer; float:right; margin:5px 0px 10px 0px;"></div>
</form>

</div>

<script>
    function zeroPad(num, count)
    {
        var numZeropad = num + '';
        while (numZeropad.length < count) {
            numZeropad = "0" + numZeropad;
        }
        return numZeropad;
    }
    
    function dateADD(currentDate)
    {
        var valueofcurrentDate = currentDate.valueOf() + (24 * 60 * 60 * 1000);
        var newDate = new Date(valueofcurrentDate);
        return newDate;
    }
    var holydays = ['14-01-2014', '15-01-2014', '16-01-2014'];
	function highlightDays(date) {
		//alert("hii");
    for (var i = 0; i < 3; i++) {
        if (new Date(holydays[i]).toString() == date.toString()) {
			alert("hi");
            return [true, 'highlight'];
        }
    }
    return [true, ''];

}
var holydays = ['01/01/2014','01/20/2014','02/17/2014','05/26/2014','07/04/2014','09/01/2014','10/13/2014','11/11/2014','11/27/2014','12/25/2014'];
var tips  = ['New Year','Martin Luther King Day','Presidents Day (Washington Birthday)','Memorial Day','Independence Day','Labor Day','Columbus Day','Veterans Day','','Christmas']; 
function highlightDays(date) {
   
    for (var i = 0; i < holydays.length; i++) {
        if (new Date(holydays[i]).toString() == date.toString()) {
            return [true, 'highlight',tips[i]];
        }
    }
    return [true, ''];

}
    $(function() {
		
        $( "#datepicker" ).datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            minDate: 1,
			firstDay: 1,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        
        $( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true,
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            minDate: 1
        });
        
    });
   
   $("#datepicker").change(function(){
				var selectedDate1= $("#datepicker").datepicker('getDate');
			  	var nextdayDate  = dateADD(selectedDate1);
				var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());
				$t = nextDateStr;
				$('#out').html('<input type="text" name="ed" id="datepicker1" class="search_input_box4" value="'+$t+'"/> ');+
				$(function() {
							$( "#datepicker1").datepicker({
								changeMonth: true,
								changeYear: true,
								 numberOfMonths: 2,
								 firstDay: 1,
								dateFormat: 'dd-mm-yy',
								buttonImageOnly: true,
								minDate: $t
							});

						});
			});
    
    $('#oneway').click(function () {
        $('#return_date').hide();
    });
    $('#roundtrip').click(function () {
		//alert("hi");
        $('#return_date').show();
    });
</script>
<script type="text/javascript">
    var s1 =  document.getElementById("s1");
    var s2 = document.getElementById("s2");
    var s3 = document.getElementById("s3");
    onchange_comb(); //Change options after page load
    s1.onchange = onchange_comb; // change options when s1 is changed
    function onchange_comb()
    {
        if (s1.value == '9') {
               s2.style.visibility = 'hidden';
               child.style.visibility = 'hidden';
           }else{
               s2.style.visibility = 'visible';
               child.style.visibility = 'visible';
           }

           <?php foreach ($adult_arr as $sa) {?>
               if (s1.value == '<?php echo $sa; ?>') {
                   option_html = "";
                   <?php if (isset($adult_arr1[$sa])) { ?> // Make sure position is exist
                       <?php foreach ($adult_arr1[$sa] as $value) { ?>
                           option_html += "<option><?php echo $value; ?></option>";
                       <?php } ?>
                   <?php } ?>
                   s2.innerHTML = option_html;
               }
           <?php } ?>

           <?php foreach ($adult_arr as $sa) {?>
               if (s1.value == '<?php echo $sa; ?>') {
                   option_html = "";
                   // Make sure position is exist
                       <?php foreach ($adult_arr2[$sa] as $value) { ?>
                           option_html += "<option><?php echo $value; ?></option>";
                       <?php } ?>

                   s3.innerHTML = option_html;
               }
           <?php } ?>
    }
    
    function addinanotherinput1(val)
    {
        document.getElementById("airfill_1").value=val;   		
    }
    
    function submitFlight()
    {
        document.flight_search.submit();
    }
</script>