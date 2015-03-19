<?php
    if($stops!='')
    {
        foreach($stops as $stop)
        {
            if($stop->stops!='')
            {
?>
        <div class="top10"><input type="checkbox" name="stops_filter" class="stops_nm" style="padding-top:5px;" value="<?php echo $stop->stops; ?>" checked  onclick="return filter();"/>
            <?php
                if($stop->stops==0) echo 'Non-Stop';
                else if($stop->stops==1) echo 'One Stop';
                else if($stop->stops==2) echo 'Two Stop';
                else if($stop->stops==3) echo 'Three Stop';
                else if($stop->stops==4) echo 'Four Stop';
                else if($stop->stops==5) echo 'Five Stop';
            ?>
        </div>
<?php
            }
        }
    }
?>
