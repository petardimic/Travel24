<div id="sidebar">
            <a href="#">
                <div style="font-size: 30px; font-family: Arial, Helvetica, sans-serif; margin: 5px 0 0 0;"></div>
            </a>
            <div class="fix">
                &nbsp;</div>
            <!-- #user_box -->
            <div class="fix">
            </div>
            
            <div id="ctl00_xpnlMainMenu">
				<ul id="accordion" class="menu_new">
                    <li>
                    <a id="ctl00_HyperLink4" causesvalidation="false">Supplier Profile</a>
                        </li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png">
			             <a id="Your Personal details" title="Your Personal details" <?php if(isset($perflag)){if($perflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/personel_details/<?php echo $this->session->userdata('admin_user_id');?>/1">&nbsp;&nbsp;&nbsp;Your Personal Details </a>
					
                  <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img1">
                    <a id="Your address" title="Your address" <?php if(isset($paflag)){if($paflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/address_details/<?php echo $this->session->userdata('admin_user_id');?>/1">&nbsp;&nbsp;&nbsp;Your address</a>
                 
                  <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img5">
                    <a id="Manage Users" title="Manage Users" <?php if(isset($psflag)){if($psflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/manageusers/<?php echo $this->session->userdata('admin_user_id');?>/1">&nbsp;&nbsp;&nbsp;Manage Users</a>
                    <br>
                </ul>
                <div class="fix">
                </div>
                <ul id="accordion" class="menu_new">
                    <li>
                    <a id="ctl00_HyperLink4" causesvalidation="false">Property Profile</a>
                        </li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png">
					<?php if($this->session->userdata('apt_id')!=''){?>
                    <a id="GeneralInfo" title="GeneralInfo" <?php if(isset($gciflag)){if($gciflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>admin/supplier_home/<?php echo $this->session->userdata('apt_id');?>/1/<?php echo $this->session->userdata('admin_user_id')?>">&nbsp;&nbsp;&nbsp;General & Contact Information </a>
					<?php }else{?>
					<a id="GeneralInfo"  title="GeneralInfo" <?php if(isset($gcflag)){if($gcflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>admin/add_accommodation/1">&nbsp;&nbsp;&nbsp;General & Contact Information </a>
					<?php }?>
                     <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img4">
                    <a id="Payment Details" title="Payment Details" <?php if(isset($ppflag)){if($ppflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/payment_details/<?php echo $this->session->userdata('admin_user_id');?>/<?php echo $this->session->userdata('apt_id');?>/1">&nbsp;&nbsp;&nbsp;Payment Details</a>
                  <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img1">
                    <a id="PropertyInfo" title="PropertyInfo" <?php if(isset($piflag)){if($piflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/property_info/1">&nbsp;&nbsp;&nbsp;Property Information</a>
                  <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img4">
                    <a id="AccommodationFacility" title="AccommodationFacility" <?php if(isset($afflag)){if($afflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/appartment_facilities/1">&nbsp;&nbsp;&nbsp;Accommodation Facilities				</a>
                  <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img5">
                    <?php /*?><a id="SpaceFacility" title="SpaceFacility" <?php if(isset($sfflag)){if($sfflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/room_facilities/1">&nbsp;&nbsp;&nbsp;Space Facilities</a>
                  <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img6"><?php */?>
                    <a id="GeneralSettings" title="GeneralSettings" <?php if(isset($gsflag)){if($gsflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/general_settings/1">&nbsp;&nbsp;&nbsp;General Settings</a>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img6">
                    <a id="ApartmentPicture" title="ApartmentPicture" <?php if(isset($apflag)){if($apflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/appartment_pictures/1">&nbsp;&nbsp;&nbsp;Accommodation Pictures</a>
                    <br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img6">
                    <a id="DetailLocation" title="DetailLocation" <?php if(isset($dlflag)){if($dlflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/detail_loc/1">&nbsp;&nbsp;&nbsp;Detail Location</a>
                    <br>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img6">
                    <a id="DetailLocation" title="DetailLocation" <?php if(isset($prop_levellflag)){if($prop_levellflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/prop_level/1">&nbsp;&nbsp;&nbsp;Payment Processing</a>
                    <br />
                </ul>
                <div class="fix">
                </div>
                <ul id="accordion">
                    <li>
                        <a id="ctl00_xbtInventoryManagement" causesvalidation="false">Inventory Management</a></li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img8">
                   	 <a id="CategoryType" title="CategoryType" <?php if(isset($ctflag)){if($ctflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/unit/1">&nbsp;&nbsp;&nbsp;Category Type</a>
                   <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img2">
                    <a id="RateTactics" title="RateTactics" <?php if(isset($rtflag)){if($rtflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/rate/1">&nbsp;&nbsp;&nbsp;Rate Tactics</a>
                   <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img7">
                    <a id="ExtraService" title="ExtraService" <?php if(isset($mflag)){if($mflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/maintain_by_month/1">&nbsp;&nbsp;&nbsp;Maintain by Month </a>
                   <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img7">
                    <a id="ExtraService" title="ExtraService" <?php if(isset($opflag)){if($opflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/open_close_date/1">&nbsp;&nbsp;&nbsp;Open/Close Dates</a>
                  <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img3">
                    <a id="HouseRules" title="HouseRules" <?php if(isset($hrflag)){if($hrflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/house_rules/1">&nbsp;&nbsp;&nbsp;House Rules</a>
                  <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img7">
                    <a id="ExtraService" title="ExtraService" <?php if(isset($esflag)){if($esflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/extra_services/1">&nbsp;&nbsp;&nbsp;Extra Services</a>
                 
                </ul>
                <div class="fix">
                </div>
                <ul id="accordion">
                    <li>
                      
                  <li>
                        <a id="ctl00_HyperLink3" causesvalidation="false">Booking Details</a></li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal.png" id="ctl00_Img10">
                    <a id="BookingList" title="BookingList" <?php if(isset($blflag)){if($blflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>supplier/booking_list/1">&nbsp;&nbsp;&nbsp;Booking List</a>
                </ul>
                <div class="fix">
                </div>
                
            
</div>
            
</div>