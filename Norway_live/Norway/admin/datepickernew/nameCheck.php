<?php 

mysql_connect("localhost","root","");
mysql_select_db("test");
$nme=$_GET['value'];
//echo $nme;
$qry=mysql_query("select name from user where name='$nme'");
$row=mysql_num_rows($qry);
if($row==0)
{
echo "<font color=blue>User Name Available </font>";
}
else
{
echo "<font color=red> User Name Already exists</font> ";
}

?>