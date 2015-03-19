<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link type="text/css" href="css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="ui.core.js"></script>
<script type="text/javascript" src="ui.datepicker.js"></script>
<script type="text/javascript">

function val()
{
//alert ("check");
document.debit.datepicker1.value=document.debit.datepicker.value;
}


$(document).ready(function(){

$("div#credit").hide();
$("div#debit").hide();

  $(".c").change(function(){
  	$val=$(this).val();
	
	if($val==1){
	$('#credit').slideDown(1000);
	$('#debit').slideUp(1000);
	}
	else if($val==2) {
	$('#debit').slideDown(1000);
	$('#credit').slideUp(1000);
	}
	else if($val==3){
	$('#debit').slideUp(1000);
	$('#credit').slideUp(1000);

	}
  });
  $('#d').click(function(){
  $('.c').removeAttr('checked');
  });
});
</script>
<!--<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	</script>-->
    <script>
	  
	$(function() {
	next_date=document.debit.datepicker.value;
	ext=next_date.split('/');
	var date = new Date(ext[1]);
	  //date.setMonth(date.getMonth() + 2, 1);
		date.setMonth(date.ext[1] +1, date.ext[2] +1);
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: 0
		});
		
		$( "#datepicker1" ).datepicker({
		
		// $('#mydate').datepicker({defaultDate: date});
		defaultDate: date,
		//	defaultDate: $.datepicker.parseDate("m d y", "12 30 2010") ,
			changeMonth: true,
			changeYear: true,
			minDate: 0
		});
	});
	</script>
    
<script language="javascript">
	
	function getXMLHTTP() 
    { //fuction to return the xml http object
        var xmlhttp=false;    
        try{
             xmlhttp=new XMLHttpRequest();
           }
           catch(e) 
           {        
            try
            {            
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e)
            {
                try
                {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1)
                {
                    xmlhttp=false;
                }
            }
        }         
        return xmlhttp;
    }
	
// if(document.
	function availa(val)
	{
	//alert (" check for ");
		  
	  if(val=='')
	  {
	  
	  document.getElementById("available").innerHTML="Check for Availability";
	  }
	  else if (document.debit.textfield.value.length > 4 )
	  {
	  
	  var strUrl="nameCheck.php?value="+val ;
	  var obj = getXMLHTTP();
          if (obj) 
             {			 
   				obj.onreadystatechange = function(){
				  // alert (" check for ");
 					   if (obj.readyState == 4) 
  						  {
    						  if (obj.status == 200) 
     							 {    
    	 							   document.getElementById('available').innerHTML=obj.responseText;
								  }
    						  else
   								   {
   								     alert(" PROBLEM IN XMLHTTP:\n" + obj.statusText);
 							       }
 						   }               
  				 }            
 				  obj.open("GET", strUrl, true);
 				  obj.send(null);
 			 } 
	  
	  }
	
	}
	
	</script>




</head>

<body onload="">
<p></p>
<!--<input type="button" id="d" value="reset"  /> -->
<table width="514" height="103">
  <tr>
    <td height="26"><h3>Payment Option</h3></td>
    <td height="26">&nbsp;</td>
    <td height="26">&nbsp;</td>
  </tr>
  <tr>
    <td width="132">CREDIT CARD</td>
    <td width="20">
    <input type="radio" id="CreditCard" name="group" value="1" class="c"/>    </td>
    <td width="105">DEBIT CARD </td>
    <td width="37">
    <input type="radio" id="DebitCard" name="group"  value="2" class="c"/>    </td>
    <td  align="center" colspan="2" >NONE </td>
    <td width="103">
    <input type="radio" id="Unselect" name="group" checked="checked" value="3" class="c" />    </td>
  </tr>
  <tr>  </tr>
</table>

<br />

<div id="credit" >
<form method="post" action="datepicker.php">
<table width="601" height="135">
  <tr>
    <td colspan="3"><div align="center"><h3>CREDIT CARD FORM</h3></div></td>
  </tr>
  <tr>
    <td width="121">Card holder's name</td>
    <td width="215"><label>
      <input type="text" name="textfield" id="textfield" />
    </label></td>
    <td width="249">&nbsp;</td>
  </tr>
  <tr>
    <td>Card No.</td>
    <td><input type="text" name="textfield2" id="textfield2" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>CW No.</td>
    <td><input type="text" name="textfield3" id="textfield3" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit" value="SUBMIT" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>


<div id="debit" >
<form method="post" name="debit">
<table width="600" height="135">
  <tr>
    <td colspan="3"><div align="center"><h3>DEBIT CARD FORM</h3></div></td>
  </tr>
  <tr>
    <td width="121">NAME</td>
    <td width="215"><label>
      <input type="text" name="textfield" id="textfield"  onkeyup="availa(this.value)" />
    </label></td>
    <td width="200"><div id="available"><font color="#003333">Check Availability</font></div></td>
  </tr>
  <tr>
    <td>ACCNT NO.</td>
    <td><input type="text" name="textfield2" id="textfield2" /></td>
    <td>&nbsp;</td>
  </tr>
   <tr>
     <td ><div align="left">F Date</div></td>
     <td ><label>
       <input type="text" name="datepicker" id="datepicker" />
      <input type="hidden" id="format" value="yy-mm-dd" />        </label></td>
      <td ><div align="left">T Date</div></td>
     <td ><label>
       <input type="text" name="datepicker1" id="datepicker1" value=""/>
      <input type="hidden" id="format" value="yy-mm-dd" />        </label></td>
   </tr>
   <tr>
    <td colspan="2" align="center"><input type="submit" name="submit" value="SUBMIT" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>

</body>
</html>
