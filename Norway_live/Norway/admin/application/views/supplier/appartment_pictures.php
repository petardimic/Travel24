<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Accommodation Picture</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/jquery-ui-1.8.18.custom.min.js"></script> 
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/jquery-1.2.3.min.js"></script> 
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/light-box.css"></script> 
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->


<script type="text/javascript">
function popup_close()
{
	$('#login-box').hide();
	$('#mask').hide();
}

$(document).ready(function() {
		$('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
$(document).ready(function(){
						
			$('.popup').css('display','none');
			$('.popup1').css('display','none');
			$('.eassy-popup').css('display','none');
			$('.categories-icon li').click(function(){
				$('.popup').css('display','block');				
				}); 
			$('.featured-icon li').click(function(){
				$('.popup').css('display','block');	
				$('.popup1').css('display','none');				
				});
			$('.categories-icon span').click(function(){
				$('.popup1').css('display','block');				
				});
			$('.popup div').click(function(){
				$('.popup').css('display','none');				
				});
			$('.popup1 span').click(function(){
				$('.popup1').css('display','none');				
				});
			$("#eassy-step").hover(
			    function () {
				  $('.eassy-popup').css('display','block');
			    }, 
			    function () {
			      $('.eassy-popup').css('display','none');
			    }
			);
			$('#add_option1 input:radio').click(function(){
				var value = $(this).val();
				$('#testinput').val(value);
			}); 
					
		});
</script>
<style type="text/css">

a { 
	text-decoration:none; 
	color:#00c6ff;
}

.post { margin: 0 auto; padding-bottom: 50px; float: left; width: 960px; }



.btn-sign a { color:#fff; text-shadow:0 1px 2px #161616; }

#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

.login-popup{
	display:none;
	background: #333;
	padding: 10px; 	
	border: 2px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999;
	-moz-box-shadow: 0px 0px 20px #999; /* Firefox */
    -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
    -moz-border-radius: 3px; /* Firefox */
    -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close {
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#999; 
	font-size:11px; 
	line-height:18px;
} 

form.signin .textbox input { 
	background:#666666; 
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#fff; 
	border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
    -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:200px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
	border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:214px;
}

.button:hover { background:#ddd; }

</style>
<script type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
function facilities()
{
	var valcheck2 = [];
	var selectedVariants = $("input[name=htlfcltycb]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#apartfec_val').val('');
	$('#apartfec_val').val(valcheck2);
	/*alert(valcheck2);
	alert($('#apartfec_val').val(valcheck2));*/
	if(valcheck2 != ""){
   		return true;
	}
	
	return false;
}
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
function delete_pic(id)
{

	if(confirm('Are you sure want to delete this Picture?'))
	{
		$('#pic'+id).hide();
		var strURL="<?php echo WEB_URL_ADMIN?>supplier/delete_picture/"+id;
		// alert(strURL);
		 var req = getXMLHTTP();
		 if (req) {
		
					
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							
							if (req.status == 200) {	
											
								var s=req.responseText;	
								if(s !='')
								{
									//alert(s);
								}					
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}				
					}			
					req.open("GET", strURL, true);
					req.send(null);
				}
	}
	else
	{
		return false;
	}			
}
</script>
</head>
<body>

<div class="wrapper">
    <!-- Top navigation bar -->
     <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

    <!--<div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div>--><!--sidebar-position-->
    <!-- Content wrapper -->
   <!-- <div class="wrapper">-->
        <!-- Content -->
       <!-- <div class="content">
            <!-- Dynamic table -->
            <!--<div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Accommodation Picture</span>
                               <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>-->
                
    <div style="display: none;" id="ctl00_DescriptionHolder_XpnlSuccess">
	
                <div align="center">
                    <div class="status_msg">
                        <strong>SUCCESS: </strong>All Details Saved / Updated Successfully
                    </div>
                </div>
            
</div>
            

                <div class="error-text">
                </div>
                
                
    <div id="ctl00_OptionalLinks_UpdatePanel_upConfirmation">
	
            
        
</div>

 
 
 <div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content">
         <div class="headersuplr_new1">Accommodation Picture<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="text-align:right; padding-bottom:5px; font-weight:bold; paddong-top:10px; border-bottom:2px #666 solid;">  Upload a valid file with extension JPG, JPEG, PNG.     | <a href="#login-box" class="login-window"><img src="<?php echo WEB_DIR?>supplier_includes/images/up-load.png" width="122" height="24" border="0" style="margin:0px 5px 0 0; vertical-align:top;" /></a></div>
        <div style="float:left; width:100%;">
 <form method="post" action="<?php echo WEB_URL_ADMIN?>supplier/check_pictures" onsubmit="return facilities();">
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
		<?php  $m = 1;$k=1;
		if(isset($pic)){ if($pic != '') { ?>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="100%">
				<?php foreach($pic as $p){ ?>
                 <div class="image-box" id="pic<?php echo $p->sup_apart_pictures_id;?>">
                 <div>
 				 <?php if($p->added_by == 0){ ?>
                	 <img src="<?php echo WEB_DIR?>uploadimage/<?php echo $p->image_name;?>" width="185" height="120" border="0" style="margin:4px;" />
                 <?php }
				 	  else if($p->added_by == 1){?>
          			 <img src="<?php echo WEB_DIR_ADMIN?>uploadimage/<?php echo $p->image_name;?>" width="185" height="120" border="0" style="margin:4px;" />
                 <?php }?>

                 
                 <div class="checkbox-bg">
                 <span style="float:left; margin-top:2px;">
				 <input name="htlfcltycb" id="htlfcltycb" type="checkbox" <?php if($p->status == 1){ ?> checked="checked" <?php } else { ?> checked="checked" <?php } ?> value="<?php echo $p->sup_apart_pictures_id;?>" />
			<input type="hidden" name="status" id="status" value="<?php echo $p->status; ?>"/></span>
                 <span style=" float:left;">
				 <img src="<?php echo WEB_DIR?>supplier_includes/images/minus.png" width="18" height="18" border="0" style="vertical-align:top; margin-left:5px;" onclick="return delete_pic('<?php echo $p->sup_apart_pictures_id;?>');"/></span>
                 </div>
                 <div ><textarea name="cmnts_<?php echo $p->sup_apart_pictures_id; ?>" id="cmnts_<?php echo $p->sup_apart_pictures_id; ?>" cols="" rows="" class="text-box-bg"><?php echo $p->title;?></textarea></div>
                 </div>
                 </div>
                 <?php $k++; }?>
                </td>
				<?php if($m%5 == 0){
							echo "</tr><tr>";
						}
						?>
              <?php $m++;?> 
            </tr>
			<?php }}?>
			<tr>
				<td colspan="5" align="left" style="border-top:#ccc 1px solid;">
                <input type="hidden" id="count" name="count" value="<?php echo $m-1; ?>"/>
                <input type="hidden" id="apartfec_val" name="apartfec_val" value=""/>
                <div style="float:right;"><input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" />
                    </div></td>
			</tr>
        </tbody>
    </table>
	</form>
    <div id="login-box" class="login-popup" style="height:150px; background-color:#F4F4F4;">
       <img src="<?php echo WEB_DIR; ?>images/close_pop.png" id="close" onclick="return popup_close();" style="cursor:pointer;" class="btn_close" title="Close Window" alt="Close" />
         
	<form name="pic_browse" method="post" class="signin" action="<?php echo WEB_URL_ADMIN?>supplier/upload_picture" enctype="multipart/form-data">
                
                
                <p style="color:#000;">
                Instruction: browse your files and select the pictures to upload. Check the color of the border on this screen to identify their quality.<br>Tip: high resolution images (at least 800 x 600 pixels) will help your hotel convert better, which means even more bookings!    <br/>
                <br><input type="file" id="image1" name="image1">
                </p><br />
                <div style="text-align:center">
         <input name="" type="submit" value=""  class="login-inner-save" />
         </div>
          </form>
		</div>
    
    </div> </div>
    <div class="fix">
    </div></div></div>
   <!-- <div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span>--><!--</span>
        </div>
    </div>-->
                <!-- Footer -->
</body></html>
