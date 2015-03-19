<?php

/*
note:
this is just a static test version using a hard-coded countries array.
normally you would be populating the array out of a database

the returned xml has the following structure
<results>
	<rs>foo</rs>
	<rs>bar</rs>
</results>
*/
$input = strtolower( $_GET['input'] );

if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.108')
{
$con=mysql_connect('localhost','root','');
mysql_select_db('norway_db');
mysql_set_charset('utf8',$con);
}
else
{
$con=mysql_connect('localhost','travel24','iemamaeyiewieceisoph');
mysql_select_db('travel24');
}
$sql="SELECT city,country, city_code FROM city_code_amadeus WHERE city_code LIKE '%$input%' OR city LIKE '%$input%' OR country LIKE '%$input%' order by city_code ASC";
$query=mysql_query($sql);
$aUsers=array();
while($row=mysql_fetch_array($query))
{
	//echo '<pre>'; print_r($row);exit;
	$aUsers[]=html_entity_decode(stripslashes(trim($row['city']).'-'.trim($row['country']).','.trim($row['city_code'])));
	
}
	$input = strtolower( $_GET['input'] );
	$len = strlen($input);
	$aResults = array();
	if ($len)
	{
		for ($i=0;$i<count($aUsers);$i++)
		{
				$aResults[] = array( "id"=>($i+1) ,"value"=>stripslashes($aUsers[$i]));
		}
	}
	
	
	
	if (isset($_REQUEST['json']))
	{
		header("Content-Type: application/json");
		echo "{\"results\": [";
		$arr = array();
	
		for ($i=0;$i<count($aResults);$i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['value']."\", \"value\": \"".$aResults[$i]['value']."\",  \"info\": \"\"}";
		}
		
		echo implode(", ", $arr);
		echo "]}";
		
	}
	

?>
