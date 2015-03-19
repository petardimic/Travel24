<?php
    if($airline!='')
    {
		$air[]=array();
		foreach($airline as $line)
		{
			if(strpos($line->name, '<br>'))
			{
				$res=explode('<br>',$line->name);
				for($f=0;$f<count($res);$f++)
				{
					$air[]=$res[$f];
				}
			}
			else
			{
					$air[]=$line->name;
			}
			
		}
		$flights=array_unique($air);
		//echo "<pre>"; print_r($flights); exit;
		$flights = array_splice($flights, 1, count($flights));
        foreach($flights as $line1)
        {
            if($line1!='')
            {
?>
				<div class="top10"><input type="checkbox" name="airline_filter" class="airline_nm" style="padding-top:5px;" value="<?php echo $line1; ?>" checked  onclick="return filter_new();"/><?php echo($line1=='Nacil Air India' ? 'Air India' : $line1); ?></div>
<?php
            }
        }
    }
?>

  
