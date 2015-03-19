<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<title>Endevour Travels</title>
<link type="text/css" href="<?php echo WEB_DIR?>css/style.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/jquery-1.4.2.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>
<script>
function zeroPad(num,count)
{
	var numZeropad = num + '';
	while(numZeropad.length < count) {
	numZeropad = "0" + numZeropad;
	}
	return numZeropad;
}
function dateADD(currentDate)
{
 var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
 var newDate =new Date(valueofcurrentDate);
 return newDate;
} 
$(document).ready(function(){
	var type = "<?php echo $users->user_type_id;?>";
if(type !='')
{
	document.getElementById('user_type').disabled = true;
}
	$(function() {
			$("#dob").datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: '<?php echo WEB_DIR_ADMIN?>media/cal_new.png ',
			buttonImageOnly: true,
			maxDate: 0
		});
		

	});

});
</script>
<style type="text/css">
/*#container_warpper {
    background: none repeat scroll 0 0 #FFFFFF;
    border-color: #74941D;
    border-left: 3px solid #74941D;
    border-style: solid;
    border-width: 2px 3px 3px;
    height: auto !important;
    margin: auto;
    overflow: hidden;
    width: 1000px;
}*/
</style>
</head>
<body>
<!--<div id="inner-pagetit">Agent Registration</div>-->
<div id="container_warpper" >
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/insert_news">

<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;">
<tr><td>
<table align="left" width="920" border="0" cellpadding="5" cellspacing="5" style="border:1px #f6f4f4 solid; padding-right:15px;">
<div id="inner-pagetit" style="background-color:#333333; color:#fff; height:20px; padding:10px;"><span style="padding-left:10px">Add News</span></div>

<tr>
	<td>News For</td>
	<td><input type="radio" value="B2B" name="news_for" checked="checked"  /> B2B <input type="radio" value="B2C" name="news_for"  /> B2C</td>
</tr>


<tr>
	<td>Show At</td>
	<td><select name="show_at" style="width:180px;">
    	<option value="">- Type -</option>
        <option value="News">News</option>
        <option value="Testimonials">Testimonials</option>
        </select></td>
</tr>
<tr>
	<td>News Title</td>
	<td><input type="text" style="width:180px;" name="news_title" id="news_title"  /></td>
</tr>
<tr>
	<td>Message</td>
	<td><textarea name="message" id="message" rows="10" cols="50"></textarea></td>
</tr>


<tr>
<td></td>
<td><input type="image" src="<?php echo WEB_DIR_ADMIN?>images/addimage.jpg"   name="submit_agent" value="Add News"/></td>
 </tr>
</table>
</td>
<td valign="top">

</td></tr>
</table>
</form>
<div style="clear:both;"></div>
</div>
<div style="width:940px; margin:0 auto">
<?php $this->view('footer');?>
</div>
</body>
</html>
