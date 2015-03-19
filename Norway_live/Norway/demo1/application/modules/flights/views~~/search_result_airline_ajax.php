<?php
    if($airline!='')
    {
        foreach($airline as $line)
        {
            if($line!='')
            {
?>
        <div class="top10"><input type="checkbox" name="airline_filter" class="airline_nm" style="padding-top:5px;" value="<?php echo $line; ?>" checked  onclick="return filter();"/><?php echo $line; ?></div>
<?php
            }
        }
    }
?>
  
