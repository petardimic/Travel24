<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script  language="javascript">

<!--<script language="text/javascript">-->
	
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

	function availa(val)
	{
	//alert ("check");
	  if(val=='')
	  {
	  
	  document.getElementById("available").innerHTML="Check For Availability";
	  }
	  else
	  {
	 
	  var strUrl="nameCheck.php?value="+val;
	  //alert ("inside else");
	  var obj = getXMLHTTP();
          if (obj) 
             {
			 
   				obj.onreadystatechange = function(){ 
				//alert ("inside onreadychange");
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

<body>

<form method="post" >

<input type="text" name="textfield" id="check"  onkeyup="availa(this.value);"/>

<input type="submit" value="SUBMIT" />

<div id="available">&nbsp;&nbsp;&nbsp;&nbsp;Check Availability</div>
</form>
</body>
</html>
