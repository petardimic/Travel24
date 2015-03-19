<?php
    if($stops!='')
    {
        foreach($stops as $stop)
        {
            if($stop!='')
            {
?>
        <div class="top10"><input type="checkbox" name="stops_filter" class="stops_nm" style="padding-top:5px;" value="<?php echo $stop; ?>" checked  onclick="return filter();"/>
            <?php
                if($stop==0) echo 'Non-Stop';
                else if($stop==1) echo 'One Stop';
                else if($stop==2) echo 'Two Stop';
                else if($stop==3) echo 'Three Stop';
                else if($stop==4) echo 'Four Stop';
                else if($stop==5) echo 'Five Stop';
            ?>
        </div>
<?php
            }
        }
    }
?>