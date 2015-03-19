// JavaScript Document

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
	
function  setToShowOnHomePage(id)
{

var pdtid	=	id;
var val	=	document.getElementById("isHome"+id).value;


	
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("displayActive"+id).innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","homePage.php?param="+val+"&id="+id,true);
xmlhttp.send();
}



function imagefunction(id)
{
	var host=window.location.host;
	var prot=window.location.protocol;
	var url=window.location.pathname;
	var path=prot+'//'+host+url;
	var imgid = id;
	var curVal	=$("#dis_id"+imgid).html();
	var cnt=parseInt(curVal)+parseInt(1);
		$.ajax({
			   type:"post",
			   url:"likecommentreport.php?data=like",
			   data:"imgid=" + imgid + "&count=" + curVal + "&root=" + path,
			   cache:false,
			   success:function(response){
				  
					if(response!="false"){
							
							$("#dis_id"+imgid).html(cnt);
							
					}
					
				   }
			   
			   });



}


function dislikeimagefunction(id)
{
		var imgid = id;
	var curVal	=$("#dis_id"+imgid).html();
	var cnt=parseInt(curVal)-parseInt(1);
		$.ajax({
			   type:"post",
			   url:"likecommentreport.php?data=dislike",
			   data:"imgid=" + imgid + "&count=" + curVal,
			   cache:false,
			   success:function(response){
					if(response!="false"){
							
							$("#dis_id"+imgid).html(cnt);
							
							}
				   }
			   
			   });

}
function session(imgid){

					document.location.href='comments.php?data='+imgid;
					
}
function emailcheck()
{
	
	var email = document.getElementById("email").value;
	//alert (email);
	//loc = div_id;
  document.getElementById("rcheck").innerHTML='loading...';
  var strURL="id_check.php?email="+email;
  //alert(strURL);
  var req5 = getXMLHTTP();
  if (req5) 
  {
	 
   req5.onreadystatechange = function()
   {
    if (req5.readyState == 4) 
    {
      if (req5.status == 200) 
      {  
	    //alert(req5.responseText);
        document.getElementById("rcheck").innerHTML=req5.responseText;
		if(req5.responseText == '<center><b style="color:#67B211; font-size:11px; padding-left:0px; padding-top:0px;">Email already exists</b></center>') 
		{
			//alert('A');
			
			document.getElementById("email").value = "";
			document.getElementById("email").focus();
			
		}
		
		if(req5.responseText == '<center><b style="color:#67B211; font-size:11px; padding-left:0px; padding-top:0px;">Email already exists</b></center><center><b style="color:#67B211; font-size:11px; padding-left:0px; padding-top:0px;">Email already exists</b></center>') 
		{
			//alert(req5.responseText);
			alert('B');
			document.getElementById("email").value = "";
			document.getElementById("email").focus();
			
		}
		//alert(req5.responseText);
		//alert('C');
		
		
	  }
      else
      {
        alert("There was a problem while using XMLHTTP:\n" + req5.statusText);
      }
    }               
   }            
   req5.open("GET", strURL, true);
   req5.send(null);
  } 
}

function setToHide(val)
{
	alert('H');
}
