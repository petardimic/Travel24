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
        <div class="wid250 fright toplayer1" style="width:auto;  ">
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
           <span class="call_txt" style="float:right;">877 714 7144</span>
            <span class="fleft" style="float:right;"><img src="<?php echo base_url(); ?>assets/images/phone_icon.png" /></span>
            
            <span class="call_small_txt" style="float:right;">Call an <br /> expert</span>
            
        </div>
    </div><!-- INNER WRAPPER END -->
    <div class="header1"></div>
