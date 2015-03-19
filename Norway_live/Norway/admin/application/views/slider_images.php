<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>travelingmart - Administration</title>

<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>

<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/jquery-ui-1.8.18.custom.min.js"></script> 
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/jquery-1.2.3.min.js"></script> 
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/light-box.css"></script> <!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->


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
function delete_pic(id)
{

	if(confirm('Are you sure want to delete this Picture?'))
	{
		$('#pic'+id).hide();
		var strURL="<?php echo WEB_URL_ADMIN?>admin/delete_picture/"+id;
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

function popup_close()
{
	$('#login-box').hide();
	$('#mask').hide();
}

function popup_close1()
{
	$('#login-box1').hide();
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
	//alert('amnad');return false;
	/*alert(valcheck2);
	alert($('#apartfec_val').val(valcheck2));*/
	if(valcheck2 != ""){
   		return true;
	}
	alert('Please select atleast one check bos');
	return false;
}
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

</head>
<body>
<?php $this->load->view('header'); ?>

<div id="container_warpper" style="padding-top:2px; margin-top:58px;">
  
	 <div  style="margin-left:0px; margin-top:4px;">
            <!-- Dynamic table -->
            <div style="width: 980px;">
                  
 <div style="text-align:right; padding-bottom:5px; font-weight:bold; ">  Upload a valid file with extension JPG, JPEG, PNG.     | <a href="#login-box" class="login-window"><img src="<?php echo WEB_DIR?>supplier_includes/images/up-load.png" width="122" height="24" border="0" style="margin:0px 5px 0 0; vertical-align:top;" /></a></div>
 <form method="post" action="<?php echo WEB_URL_ADMIN?>admin/check_pictures" onsubmit="return facilities();">
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
		<?php  $m = 1;$k=1;
		if(isset($pic)){ if($pic != '') { ?>
            <tr>
                <td  width="100%">
				<?php foreach($pic as $p){ ?>
                 <div class="image-box" id="pic<?php echo $p->slider_images_id;?>">
                 <div>
                 <img src="<?php echo WEB_DIR_ADMIN?>static_images/<?php echo $p->image_name;?>" width="185" height="120" border="0" style="margin:4px;" />
                 <div class="checkbox-bg">
                 <span style="margin-top:0px; float:left;"><input name="htlfcltycb" id="htlfcltycb" type="checkbox" <?php if($p->image_status  == 1){?> checked="checked" <?php }?> value="<?php echo $p->slider_images_id;?>" /></span>
                 <span style="margin-top:0px; float:left;"><img src="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/minus.png" width="16" height="16" border="0" style="  margin-left:1px; margin-top:1px; cursor:pointer;" onclick="return delete_pic('<?php echo $p->slider_images_id;?>');"/></span>
                  
              
                 
                 
                 </div>
                 <div ><textarea name="cmnts_<?php echo $p->slider_images_id; ?>" id="cmnts_<?php echo $p->slider_images_id; ?>" cols="" rows="" class="text-box-bg"><?php echo $p->image_title ;?></textarea></div>
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
    <div id="login-box" class="login-popup" style="height:auto; background-color:#F4F4F4;">
       <img src="<?php echo WEB_DIR; ?>images/close_pop.png" id="close" onclick="return popup_close();" style="cursor:pointer;" class="btn_close" title="Close Window" alt="Close" />
         
	<form name="pic_browse" method="post" class="signin" action="<?php echo WEB_URL_ADMIN?>admin/upload_picture" enctype="multipart/form-data">
                
                
                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="20">&nbsp;</td>
    <td><span style="color:#000;">Instruction: browse your files and select the pictures to upload. Check the color of the border on this screen to identify their quality.<br />
      Tip: high resolution images (at least 800 x 600 pixels) will help your hotel convert better, which means even more bookings! </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="200"><span style="color:#000;"><strong>Image :</strong></span></td>
        <td><span style="color:#000;">
          <input type="file" id="image1" name="image1" style=" border:1px #bebebe solid; padding:3px; width:200px;"  />
        </span></td>
      </tr>
     <?php /*?> <tr>
        <td height="8" colspan="2"></td>
        </tr>
      <tr>
        <td><span style="color:#000;"><strong>Ttile :</strong></span></td>
        <td><span style="color:#000;">
          <input type="text" style=" border:1px #bebebe solid; padding:3px; width:200px;" id="title" name="title" />
          </span></td>
      </tr>
      <tr>
        <td height="8" colspan="2"></td>
      </tr>
      <tr>
        <td><span style="color:#000;"><strong>Sentence : </strong></span></td>
        <td><span style="color:#000;">
          <input type="text" id="sentence" style=" border:1px #bebebe solid; padding:3px; width:200px;" name="sentence" />
          </span></td>
      </tr>
      <tr>
        <td height="8" colspan="2"></td>
      </tr>
      <tr>
        <td><span style="color:#000;"><strong>URL :</strong></span></td>
        <td><span style="color:#000;">
          <input type="text" style=" border:1px #bebebe solid; padding:3px; width:200px;" id="url" name="url" />
          </span></td>
      </tr>
      <tr>
        <td height="8" colspan="2"></td>
      </tr>
      <tr>
        <td><span style="color:#000;"><strong>Action :</strong></span></td>
        <td><span style="color:#000;">
          <input type="text" style=" border:1px #bebebe solid; padding:3px; width:200px;" id="action" name="action" />
          </span></td>
      </tr><?php */?>
    </table></td>
  </tr>
      </table>
                
                
                
                
                <div style="float:left; margin-left:215px; margin-top:10px;">
         <input name="" type="submit" value=""  class="login-inner-save" />
      </div>
  </form>
</div>
        
        
        <div id="login-box1" class="login-popup" style="height:auto; background-color:#F4F4F4;">
       <img src="<?php echo WEB_DIR; ?>images/close_pop.png" id="close" onclick="return popup_close1();" style="cursor:pointer;" class="btn_close" title="Close Window" alt="Close" />
         
	<form name="pic_browse" method="post" class="signin" action="<?php echo WEB_URL_ADMIN?>admin/upload_picture_update" enctype="multipart/form-data">
                
                <input type="hidden" id="edit_unique_id" name="unique_id"/>
                <input type="hidden" name="image_name" id="update_image_name"/>
<table width="95%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="20">&nbsp;</td>
                    <td>&nbsp;</td>
      </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><span style="color:#000;">Instruction: browse your files and select the pictures to upload. Check the color of the border on this screen to identify their quality.<br />
                    Tip: high resolution images (at least 800 x 600 pixels) will help your hotel convert better, which means even more bookings! </span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                      <tr>
                        <td valign="top"><span style="color:#000;"><strong>Image :</strong></span></td>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="230" valign="top"><span style="color:#000;">
                            <input type="file" id="image1" name="image1" />
                            
                            </span></td>
                            <td valign="top"><div id="modify_img"></div></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><strong>Ttile :</strong></td>
                        <td><input type="text" id="edit_title" name="title" style="width:200px; padding:3px; border:1px #b9b9b9 solid;" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><strong>Sentence : </strong></td>
                        <td><input type="text" id="edit_sentence" name="sentence" style="width:200px; padding:3px; border:1px #b9b9b9 solid;"/></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><strong>URL :</strong></td>
                        <td><input type="text" id="edit_url" name="url" style="width:200px; padding:3px; border:1px #b9b9b9 solid;"/></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><strong>Action :</strong></td>
                        <td><input type="text" id="edit_action" name="action" style="width:200px; padding:3px; border:1px #b9b9b9 solid;"/></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
      </table>
                <p style="color:#000;"><br/>
                  <br>


                <div style="float:left; margin-left:134px;">
         <input name="" type="submit" value=""  class="login-inner-save" />
         </div>
  </form>
		</div>
    
    </div> </div>
    <div class="fix">
    </div>
    </div>

  <div class="clr"></div>
</div>
<!--footer-->
<?php $this->load->view('footer'); ?>
    <!--footer end-->
</body>
</html>
<script type="text/javascript">
//slider_images_id,image_name,image_status,Title,Sentence
function edit(slider_images_id,image_name,image_status,Title,Sentence,url,action)
{
	$('#edit_sentence').val(Sentence);
	$('#edit_title').val(Title);
	$('#edit_url').val(url);
	$('#edit_unique_id').val(slider_images_id);
	$('#update_image_name').val(image_name);
	$('#edit_action').val(action);
	$('#modify_img').html('<img src="<?php echo WEB_DIR_ADMIN?>static_images/'+image_name+'"width="80" height="50">')
}

</script>