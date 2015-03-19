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
<form name="flight_search" method="POST" action="<?php echo site_url(); ?>/flights/search">
    <input type="radio" name="journey_type" value="OneWay" id="oneway"  <?php echo($_SESSION['journey_type']=='OneWay' ? 'checked' : ''); ?>/>One Way&nbsp;&nbsp;
    <input type="radio" name="journey_type" value="Round" id="roundtrip" <?php echo($_SESSION['journey_type']=='Round' ? 'checked' : ''); ?> />Round Trip&nbsp;&nbsp;
    <input type="radio" name="journey_type" value="MultiCity" id="multicity" <?php echo($_SESSION['journey_type']=='MultiCity' ? 'checked' : ''); ?> />Multi City
    <div style="clear:both;"></div>
    <label>Leaving From</label>
    <input type="text" class="search_input_box" name="from_city" id="airportcodeinput" value="<?php echo(isset($_SESSION['fromcityval']) ? $_SESSION['fromcityval'] : ''); ?>" /> 
    <div style="clear:both;"></div>
    <label>Travelling To</label>
    <input type="text" class="search_input_box" name="to_city" id="testtoinput" onblur="addinanotherinput1(this.value)" value="<?php echo(isset($_SESSION['tocityval']) ? $_SESSION['tocityval'] : ''); ?>" /> 
    <div style="clear:both;"></div>
    <div class="wid100 top10 fleft"><label>Departure</label>
        <input type="text" class="search_input_box5" name="sd" id="datepicker" readonly="readonly" value="<?php echo(isset($_SESSION['sd']) ? $_SESSION['sd'] : ''); ?>" /> </div>
        
        <?php if(isset($_SESSION['ed']) && $_SESSION['ed']!=''){ ?>
    <div class="wid100 top10 fleft" id="return_date"><label>Return</label>
        <input type="text" class="search_input_box5" name="ed" id="datepicker1" readonly="readonly" value="<?php echo(isset($_SESSION['ed']) ? $_SESSION['ed'] : ''); ?>" /> </div>
        <?php } ?>

    <div style="clear:both;"></div>
    <div class="wid100 top10 fleft"><label>Adult(12+)</label>
        <select name="adult" id="s1" class="search_input_box6">
            <?php foreach($adult_arr as $sa) { ?>
                <option value="<?php echo $sa; ?>" <?php echo($_SESSION['adults']==$sa ? 'selected="selected"' : ''); ?>><?php echo $sa; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="wid100 top10 fleft"><label>Child(2-11)</label>
        <div id="child">
            <select id="s2" name="child" class="search_input_box6" style=" margin-top:5px;">
                <option value="<?php echo $_SESSION['childs']; ?>"><?php echo $_SESSION['childs']; ?></option>
            </select>
        </div>
    </div>
    <div style="clear:both;"></div>
    <div class="wid100 top10 fleft"><label>Infant(0-2)</label>
        <select id="s3" name="infant" class="search_input_box6" style="margin-top:5px;">
                <option value="<?php echo $_SESSION['infants']; ?>"><?php echo $_SESSION['infants']; ?></option>
        </select>
    </div>
    <div class="wid100 top10 fleft" ><label>Cabin</label>
        <select name="cabin" style="width:100%;" class="search_input_box6">
                <option value="All" <?php echo($_SESSION['cabin']=='All' ? 'selected="selected"' : ''); ?>>All</option>
                <option value="First, Supersonic" <?php echo($_SESSION['cabin']=='First, Supersonic' ? 'selected="selected"' : ''); ?>>First, Supersonic</option>
                <option value="Business" <?php echo($_SESSION['cabin']=='Business' ? 'selected="selected"' : ''); ?>>Business</option>
                <option value="Economic" <?php echo($_SESSION['cabin']=='Economic' ? 'selected="selected"' : ''); ?>>Economic</option>
                <option value="Premium Economy" <?php echo($_SESSION['cabin']=='Premium Economy' ? 'selected="selected"' : ''); ?>>Premium Economy</option>
                <option value="Standard Economy" <?php echo($_SESSION['cabin']=='Standard Economy' ? 'selected="selected"' : ''); ?>>Standard Economy</option>
        </select>
    </div>
    <input type="checkbox" name="nonstop" value="nonstop" <?php echo($_SESSION['nonstop']=='nonstop' ? 'checked="checked"' : ''); ?>>Direct Connection
    <div class="search_btn1" style="margin-bottom:30px;"><input type="button" name="modify_search" value="SEARCH" onclick="return submitFlight();"></div>
</form>

</div>

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