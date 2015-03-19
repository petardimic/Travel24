		<?php /* ?><?php $filename ="newsletter_email.xls";
		 //echo $contents = html_entity_decode($email);

		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename); 
		//echo strip_tags($email);
		$con ='';
		//$con = "<table><tr><th>SI No.</th><th>Email Id</th></tr>";
		$i =1;
		foreach($news_letter as $row)
		{
			$con.= $row->email."  ";
			$i++;
		}
		//$con.= "</table>";
		echo strip_tags($con);?>  <?php */ ?>
		
		<?php function cleanData(&$str)
			 {
			 //$str = preg_replace("/\t/", "\\t", $str); 
			///$str = preg_replace("/\r?\n/", "\\n", $str); if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
			 } 

		 $filename = "subscribed" . time(). ".xls"; 
		 header("Content-Disposition: attachment; filename=\"$filename\""); 
                 header("Content-Type: application/vnd.ms-excel"); $flag = false; 
                 //foreach($news_letter as $row) { if(!$flag) {  echo implode("\t", array_keys($row->email)) . "\r\n"; $flag = true; } array_walk($row, 'cleanData'); echo implode("\t", array_values($row->email)) . "\r\n"; } exit; 
		print_r($email);
		?>
		
