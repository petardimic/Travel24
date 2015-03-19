<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link type="text/css" href="css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="ui.core.js"></script>
<script type="text/javascript" src="ui.datepicker.js"></script>
 <script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: 0
		});
		$( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: 0
		});		
	});
	</script>
</head>

<body>
<table width="371" height="106">
  <tr>
    <td height="100" ><!--<div align="left">Date</div>--></td>
    <td ><label>   <input type="text" name="datepicker" id="datepicker" size="10" />   <img src="calendar.jpg" />   </label></td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td height="100" ><!--<div align="left">Date</div>--></td>
    <td ><label>   <input type="text" name="datepicker1" id="datepicker1" size="10" />   <img src="calendar.jpg" />   </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
