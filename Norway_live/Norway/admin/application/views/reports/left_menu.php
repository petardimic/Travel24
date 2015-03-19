 

<ul>
			
     
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/reports" style="text-decoration:none;" 
			<?php if($flag =='1') 
		 		{ 
					echo "class='active'";
		 		}?>>Hotel</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/reports_flight" style="text-decoration:none;" 
            <?php if($flag =='2') 
		 		{ 
					echo "class='active'";
		 		}?>>Flights</a></li>

			
            <li
            <?php if($flag =='4') 
		 		{ 
					echo "class='active'";
		 		}?>
                ><a href="<?php  print WEB_URL_ADMIN?>admin/reports_car" style="text-decoration:none;">Car</a></li>
  			<li 
            <?php if($flag =='5') 
		 		{ 
					echo "class='active'";
		 		}?>><a href="<?php  print WEB_URL_ADMIN?>admin/reports_holiday" style="text-decoration:none;">Packages</a></li>
                <?php /*?><li 
            <?php if($flag =='6') 
		 		{ 
					echo "class='active'";
		 		}?>><a href="<?php  print WEB_URL_ADMIN?>admin/reports_flighthotel" style="text-decoration:none;">Flight + Hotel</a></li>
                <li 
           
                 <li 
            <?php if($flag =='7') 
		 		{ 
					echo "class='active'";
		 		}?>><a href="<?php  print WEB_URL_ADMIN?>admin/reports_flighthotelcar" style="text-decoration:none;">Hotel + Car</a></li>
                <li 
            <?php if($flag =='8') 
		 		{ 
					echo "class='active'";
		 		}?>><a href="#" style="text-decoration:none;">Flight + Car</a></li><?php */?>
                
		</ul>
      