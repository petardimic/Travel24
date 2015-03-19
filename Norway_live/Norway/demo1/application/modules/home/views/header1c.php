<?php /*?><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php */?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/popbox_new.css" type="text/css" media="screen" charset="utf-8">

  <script type="text/javascript" charset="utf-8"  src="<?php echo base_url(); ?>assets/js/popbox_new.js"></script>
  
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      $('.popbox,.popbox1').popbox();
    });
  </script>
<div id="wrapper">
    <div class="inner_wrapper ">
        <div class="logo toplayer">
			<a href="<?php echo base_url(); ?>">
			 <img src="<?php echo base_url(); ?>assets/images/logo.png" border="0" />
			 </a>
			 
		   </div>
        <div class="clear"></div>
        <!-- NAVIGATION -->
        <nav>	
            <div id="navbar">
                <ul>
                    <li ><a href="<?php echo site_url(); ?>/home/flights" style="background: linear-gradient(to bottom, #033A76 0%, #2679B4 50%, #145893 50%, #033A76 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);"><img src="<?php echo base_url(); ?>assets/images/flight_icon.png" border="0" align="absmiddle" /> Flights </a> </li>
                    <li><a href="<?php echo site_url(); ?>/home/hotels"><img src="<?php echo base_url(); ?>assets/images/hotel_icon.png" border="0" align="absmiddle" style="margin-top:-5px;" /> Hotel</a></li>
                    <li><a href="<?php echo site_url(); ?>/home/cars"><img src="<?php echo base_url(); ?>assets/images/car_icon.png" border="0" align="absmiddle" style="margin-top:-5px;" /> Car</a></li>
                   <?php /*?> <li><a href="<?php echo site_url(); ?>/home/packages"><img src="<?php echo base_url(); ?>assets/images/packages_icon.png" border="0" align="absmiddle" style="margin-top:-5px;" />Packages</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Contact us</a></li><?php */?>
                </ul>
            </div>
        </nav>
        <!-- NAVIGATION END -->
        <div class="wid250 fright toplayer1" style="width:auto; width:350px;">
            <div class="toplink"  style="float:right;">
                <ul>
                    <li>
                        <?php if($this->session->userdata('customer_id') != '' ) {
                            $custdet= $this->home->getcustomerdet($this->session->userdata('customer_id'));
                        }
						else if($_SESSION['user_email'] != '' )
						{
							$custdet= $this->home->check_password($_SESSION['user_email']);
						}
					 if($this->session->userdata('customer_id') != '' || $_SESSION['user_email'] != '' ) { ?>
							<span style="color:#CE2E2E">Hi, <?php echo $custdet->firstname; ?></span>
					<?php } else { ?>
						<a href="<?php echo site_url(); ?>/home/login"> Login</a>
					<?php } ?>
					</li> |
                    <li>
						<?php if($this->session->userdata('customer_id') != '' || $_SESSION['user_email'] != '') { ?>
						<a href="<?php echo site_url(); ?>/home/myaccount">My Account</a>
						<?php } else { ?>
						<a href="<?php echo site_url(); ?>/home/register">Regsiter</a>
						<?php } ?></li>
						<?php if($this->session->userdata('customer_id') != '' || $_SESSION['user_email'] != '') { ?> | <?php } ?>
                    <li>
						<?php if($this->session->userdata('customer_id') != '' || $_SESSION['user_email'] != '') { ?>
						<a href="<?php echo site_url(); ?>/home/custlogout">Logout</a>
						<?php } else { ?>
						<?php /*?><a href="<?php echo site_url(); ?>/crm/support">Support</a><?php */?>
						<?php } ?></li>
                </ul>
            </div> <div style="clear:both"></div>
            <span class="call_txt" style="float:right; border-left:1px solid #CCC; padding-left:5px;">          
            
              <div id="language">
<div class="popbox"  style="float:left; width:25px;" >
            <a class="open" href="#" style="float:left;   width:60px;"> <img src="<?php echo base_url(); ?>assets/images/america.jpg" border="0" /> <img src="<?php echo base_url(); ?>assets/images/arow.png" border="0" /> </a>
            <div class="collapse"  >
      <div style="display: none; top: 10px; left: 0px;" class="box">
        
<div style="float:left; margin-left:20px; padding-top:25px; position:absolute;"><a href="#"  ><img src="<?php echo base_url(); ?>assets/images/top.png" border="0"  /></a></div>
        <div style="width:140px; height:auto; float:left; background:#fff; border:solid 1px #d9d9d9; border:solid 1px #BBBBBB;
      border-radius:5px; margin-top:36px; box-shadow:0px 0px 15px #999; margin-left:-40px; ">
      
              
        
        
        <div style="float:left; width:124px; height:75px; font-size:10px; font-size:12px; color:#333; padding:0px 10px ; ">
        	 	
             <div class="topmainlinks">	
            <ul>
            <li><a href="http://www.akbartravelsonline.com/" target="_blank"> <span style="color:#626262; text-decoration:none;"> <img src="<?php echo base_url(); ?>assets/images/4.jpg" border="0" />&nbsp; India</span></a></li>
            <li><a href="http://www.akbartravels.ae/" target="_blank"><span style="color:#626262; text-decoration:none;"> <img src="<?php echo base_url(); ?>assets/images/1.jpg" border="0" />&nbsp; UAE</span></a></li>
            </ul>
             	
            </div>	
            
             	
            
             	
            
             	
            
      
         
         </div>
        
        </div>
</div></div></div>
</div>
            </span>
           <span class="call_txt" style="float:right; padding-right:15px;">877 714 7144</span>
            <span class="fleft" style="float:right;"><img src="<?php echo base_url(); ?>assets/images/phone_icon.png" /></span>
            
            <span class="call_small_txt" style="float:right;">Call an <br /> expert</span>
            
        </div>
    </div><!-- INNER WRAPPER END -->
    <div class="header1"></div>
