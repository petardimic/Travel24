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
            <?php if($this->session->userdata('new_user_id')){?>
            <?php }else{?>
				<ul id="accordion" class="menu" style="width:210px;">
                    <li>
                    <a id="ctl00_HyperLink4" causesvalidation="false">Holidays</a>
                        </li>
                    
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal1.png" id="ctl00_Img1">
                    <a id="Your address" title="Your address" <?php if(isset($gcflag)){if($gcflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>admin/add_excursion">&nbsp;&nbsp;&nbsp;Add Holidays</a>
                 
                  
                    <br>
                   <?php /*?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal1.png" id="ctl00_Img5">
                    <a id="Manage Users" title="Manage Users" <?php if(isset($gcflag)){if($gcflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>admin/list_excursion_domestic">&nbsp;&nbsp;&nbsp; List Domestic Holidays</a>
                    <br><?php */?>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal1.png" id="ctl00_Img5">
                    <a id="Manage Users" title="Manage Users" <?php if(isset($gcflag)){if($gcflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>admin/list_excursion_inetr">&nbsp;&nbsp;&nbsp; List Holidays</a>
                     <br>
                    <?php /*?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal1.png" id="ctl00_Img5">
                    <a id="Manage Users" title="Manage Users" <?php if(isset($gcflag)){if($gcflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>admin/list_selected_dome">&nbsp;&nbsp;&nbsp; Front End Domestic Listing</a>
                     <br>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal1.png" id="ctl00_Img5">
                    <a id="Manage Users" title="Manage Users" <?php if(isset($gcflag)){if($gcflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>admin/list_selected_inter">&nbsp;&nbsp;&nbsp; Front End International Listing</a><?php */?>
                </ul>
                <?php }?>
                
                <div class="fix">
                </div>
                <ul id="accordion" class="menu" style="width:210px;">
                    <li>
                    <a id="ctl00_HyperLink4" causesvalidation="false">Reports</a>
                        </li>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WEB_DIR?>supplier_includes/images/aNormal1.png" id="ctl00_Img1">
                    <a id="Your address" title="Your address" <?php if(isset($gcflag)){if($gcflag){echo 'class="leftNavbookactive"';}} ?> href="<?php echo WEB_URL_ADMIN?>admin/holiday_reports">&nbsp;&nbsp;&nbsp;Holiday Reports</a>
                 
                  
                    <br>
                        </ul>
                
            
</div>
            
</div>
