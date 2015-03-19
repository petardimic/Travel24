<!-- FOOTER WRAPPER -->   <footer>
    <div class="footer_wrapper">
        <div class="inner_wrapper">
            <div class="wid320 fleft top10">
                <div class="footer_header" style="font-weight:bold; font-size:13px;">About us</div>
                <div class="top10" style="color:#fff; font-size:12px; line-height:17px;">
                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                     <p>

Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five </p>
                </div>  <div class="top30"><img src="<?php echo base_url(); ?>assets/images/payment.png" /></div>
                <div></div>
            </div>
            <div class="wid320 fleft top10 left60">
                <div class="footer_header" style="font-weight:bold; font-size:13px;">Newsletter</div>
                <div class="top10">
                    <form class="form-inline">
                        <input type="text" placeholder="Enter Your E-mail Address" id="email_sub" name="email_sub" class="newsletter_input" onblur="return check_new_sub(this.value);">
                        <span  class="newsletter_btn" onclick="return check_subsrcibe();" style="cursor:pointer;">Submit</span>
                    </form>
<span id="user_error1" style="color:#FFF;"></span>
                </div>


                <div class="top10" style="color:#fff; font-size:13px; line-height:17px;">Enter your email address below to receive our monthly fun-filled newsletter.</div>	
                <div class="footer_header top30" style="font-weight:bold; font-size:13px;">Share with us</div>
                <div class="top10">
                    <span><a href="#" target="_blank"><img src="<?php echo base_url(); ?>assets/images/share/facebook.png" width="30" border="0" /></a></span>
                    
                    <span class="left20"><a href="#" target="_blank"><img src="<?php echo base_url(); ?>assets/images/share/twitter.png" width="30" border="0" /></a></span>
                    
                    <span class="left20"><img src="<?php echo base_url(); ?>assets/images/share/google.png" width="30" /></span>
                    <span class="left20"><img src="<?php echo base_url(); ?>assets/images/share/diggit.png" width="30" /></span>
                    <span class="left20"><img src="<?php echo base_url(); ?>assets/images/share/reddit.png" width="30" /></span>
                    <span class="left20"><img src="<?php echo base_url(); ?>assets/images/share/linkedin.png" width="30" /></span>

<div class="top10"><span><img src="<?php echo base_url(); ?>assets/images/share/stumbleupon.png" width="30" /></span>
                        <span class="left20"><img src="<?php echo base_url(); ?>assets/images/share/email.png" width="30" /></span>
                        <span class="left20"><img src="<?php echo base_url(); ?>assets/images/share/pinterest.png" width="30" /></span>
                        <span class="left20"><img src="<?php echo base_url(); ?>assets/images/share/bookmark.png" width="30" /></span>
                        <span class="left20"><img src="<?php echo base_url(); ?>assets/images/share/orkut.png" width="30" /></span>
                        <span class="left20"><img src="<?php echo base_url(); ?>assets/images/share/blogger.png" width="30" /></span></div>

                </div>

            </div>

            <div class="wid200 fleft top10" >
                <div class="footer_header left60 top10" style="font-weight:bold; font-size:13px;">Links</div>
                <div class="footer_txt left40">	<ul>
                       
                        <li><a href="">Flights </a></li>
                        <li><a href="">Packages </a></li>
                        <li><a href="">Events </a></li>
                        <li><a href="">FAQ's </a></li>
                        <li><a href="">Privacy </a></li>
                        <li><a href="">Cookie Policy </a></li>
                        <li><a href="">Feedback </a></li>
                    </ul> </div>
                <div></div>
            </div>


        </div>
        <div class="clear"></div>
        <div style="background-color:#277eb9; line-height:40px; width:100%; float:left; color:#FFF; " >
                                                    
        </div></div>

</footer> <!-- FOOTER WRAPPER END --> 
</div>  <!-- Wrapper END -->    
<script type="text/javascript">
function check_new_sub(email)
{
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("user_error1").innerHTML = "Please enter a valid email address";
		document.getElementById("email_sub").value = '';
		document.getElementById("email_sub").focus();
		return false;
	}
	else
	{
		/* $.ajax
			({
				 type: "POST",
				 url: "<?php echo site_url(); ?>/home/check_sub",
				  data: "source="+email,
				  success: function(msg)
				  {
					 if(msg == 1)
					 {
						 document.getElementById("user_error1").innerHTML = "Email id already exists";
						 document.getElementById("email_sub").value = '';
				 		 document.getElementById("email_sub").focus();
						 return false;
					 }
					 else
					 {
					  	 document.getElementById("user_error1").innerHTML = "Thanks for subscribing with us!!!!";
					 }
				  }
			});*/
		 document.getElementById("user_error1").innerHTML = "";
	}
}
function check_subsrcibe()
{
	var email = $('#email_sub').val();
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("user_error1").innerHTML = "Please enter a valid email address";
		document.getElementById("email_sub").value = '';
		document.getElementById("email_sub").focus();
		return false;
	}
	else
	{
		$.ajax
			({
				 type: "POST",
				 url: "<?php echo site_url(); ?>/home/check_sub",
				  data: "source="+email,
				  success: function(msg)
				  {
					 if(msg == 1)
					 {
						 document.getElementById("user_error1").innerHTML = "Email id already exists";
						 document.getElementById("email_sub").value = '';
				 		 document.getElementById("email_sub").focus();
						 return false;
					 }
					  else
					 {
					  	document.getElementById("user_error1").innerHTML = "Thanks for subscribing with us!!!!";
					 }
				  }
			});
	}
}
</script>
