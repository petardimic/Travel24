<div id="wrapper">
    <div class="inner_wrapper ">
    
        <div class="logo toplayer">
			<a href="<?php echo base_url(); ?>">
			 <img src="<?php echo base_url(); ?>assets/images/logo.png" border="0" />
			 </a>
			 
		   </div>
        <div class="clear"></div>
        <!-- NAVIGATION -->
        
        <!-- NAVIGATION END -->
       <div class="header-rights">
<div class="header-rights-top">
<div class="header-top-in">

<div class="toplink"  style="float:right; margin-top:0px; background: linear-gradient(to bottom, #2981bc 0%, #2981bc 50%, #1c699d 50%, #1c699d 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);border-radius:5px; padding:8px; color:#fff;">
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
							<span style="color:#000; font-weight:bold;">Hi, <?php echo $custdet->firstname; ?></span>
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
            </div>
</div>

<div class="header-top-in right10" style="margin-right:0px;">
<span class="call_small_txt">Call an <br /> expert</span>
            <span class="fleft"><img src="<?php echo base_url(); ?>assets/images/phone_icon.png" /></span>
            <span class="call_txt">1234567890</span>
</div>

</div>

<div class="header-rights-bottom">

<nav>	
            
        </nav>
</div>
</div>
</div></div>
    <div class="header1"></div>
