<?php 
class Supplier_Model extends CI_Model
{

	function __construct()
		{
		
		parent::__construct();
		
		}
		
		function hotel_details($id)
		{
			$this->db->select('*');
			$this->db->from('hotel_details');
			$this->db->where('created_by',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function get_plan_picures($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_plapictures');
		$this->db->where('sup_apart_rate_id',$id);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ 
			return '';
		}
		else
		{
			 return $query->result();
		}
	}
	function insert_pay_process($value,$id)
	{
		$data = array('payment_process_value'=>$value,'sup_apart_list_id'=>$id);
		$this->db->insert('payment_process',$data);
	}
	function update_pay_process($value,$id)
	{
		$data = array('payment_process_value'=>$value);
		$this->db->where('sup_apart_list_id',$id);
		$this->db->update('payment_process',$data);	
	}
	function get_region_name($id)
		{
			$this->db->select('name');
			$this->db->from('booking_regions');
			$this->db->where('region_id',$id);
			$this->db->where('languagecode','en');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				$val =  $query->row();
				return $val->name;
			}		
			
		}
		function get_city_name($id)
		{
			$this->db->select('name');
			$this->db->from('booking_cities');
			$this->db->where('city_id',$id);
			$this->db->where('languagecode','en');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				$val =  $query->row();
				return $val->name;
			}		
			
		}
		function get_district_name($id)
		{
			$this->db->select('name');
			$this->db->from('booking_getdistricts');
			$this->db->where('district_id',$id);
			$this->db->where('languagecode','en');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				$val =  $query->row();
				return $val->name;
			}		
			
		}
	function get_pay_process($id)
	{
		$this->db->select('*');
		$this->db->from('payment_process');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return $query->row();	
		}
	}
	function delete_planpicture($id)
	{
		$this->db->select('image_name');
		$this->db->from('sup_apart_plapictures');
		$this->db->where('sup_apart_plapictures_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			$val =  $query->row();	
			return $val->image_name;			
		}
		
	}
	function add_check_planpictures($apartid,$checkval,$comments)
	{//echo $comments;exit;
		$data = array('title'=>$comments,'status'=>1);
		$this->db->where('sup_apart_plapictures_id',$checkval);
		$this->db->update('sup_apart_plapictures',$data);	
	}
	function delete_planpictures($id)
	{
		
		$this->db->where('sup_apart_plapictures_id',$id);
		$this->db->delete('sup_apart_plapictures');	
	}
	function upload_plan_picture($img,$id,$room_id)
	{
		$data = array('sup_apart_list_id'=>$id,'image_name'=>$img,'sup_apart_rate_id'=>$room_id);
		$this->db->insert('sup_apart_plapictures',$data);
	}
	function get_country()
	{	
		$this->db->select('*');
		$this->db->from('countires');
		$this->db->order_by('name','ASC');
		$query=$this->db->get();
		return $query->result();
	}
	function get_language()
	{
		$this->db->select('*');
		$this->db->from('language');
		$query=$this->db->get();
		return $query->result();
	}
	function insert_contact($fname,$lname,$phone,$fax,$email,$req,$user_id,$apt_id)
	{
		
		$data = array('user_id'=>$user_id,'sup_apart_list_id'=>$apt_id,'sup_apartcontact_type_id'=>$req,'phone'=>$phone,'fname'=>$fname,'lname'=>$lname,'fax'=>$fax,'email'=>$email);
		$this->db->insert('sup_apartcontact_info',$data);
	}
	function delete_contact($apt_id)
	{
		$this->db->where('sup_apart_list_id', $apt_id);
		$this->db->delete('sup_apartcontact_info'); 
	}
	function get_reservation_info($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apartcontact_info');
		$this->db->where('sup_apart_list_id',$id);
		$this->db->where('sup_apartcontact_type_id',1);
		$query=$this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
		
	}
	function insert_general_settings($checkin_from,$checkin_to,$checkout_from,$checkout_to,$checkin_hr,$checkout_hr,$collection,$desc,$state_tax,$state_percentage,$state_percentage_val,$state_persons,$state_price,$city_tax,$city_percentage,$city_percentage_val,$city_persons,$city_price,$room_tax,$room_percentage,$room_percentage_val,$room_persons,$room_price,$vat_tax,$vat_percentage,$vat_percentage_val,$vat_persons,$vat_price,$service_tax,$service_percentage,$service_percentage_val,$service_persons,$service_price,$group,$apartid,$state_totalstay_flag,$state_fixedprice_flag,$cit_totalstay_flag,$city_fixedprice_flag,$room_totalstay_flag,$room_fixedprice_flag,$vat_totalstay_flag,$vat_fixedprice_flag,$service_totalstay_flag,$service_fixedprice_flag)
	{		//print $checkin_from; 
			//print $checkout_from; exit;
		$data = array('sup_apart_list_id'=>$apartid,'checkinfrom'=>$checkin_from,'checkoutfrom'=>$checkout_from,'checkinto'=>$checkin_to,'checkoutto'=>$checkout_to,'checkin_after'=>$checkin_hr,'checkout_after'=>$checkout_hr,'key_collection'=>$collection,'key_collection_desc'=>$desc,'grp_reservation'=>$group);
		$this->db->insert('sup_apart_generalsettings',$data);
		$data1 = array('sup_apart_list_id'=>$apartid,'state_tax'=>$state_tax,'state_totalstay_flag'=>$state_totalstay_flag,'state_totalstay_percent'=>$state_percentage_val,'state_fixedprice_flag'=>$state_fixedprice_flag,'state_per_person'=>$state_persons,'state_fixedprice'=>$state_price,'city_tax'=>$city_tax,'city_totalstay_flag'=>$cit_totalstay_flag,'city_totalstay_percent'=>$city_percentage_val,'city_fixedprice_flag'=>$city_fixedprice_flag,'city_per_person'=>$city_persons,'city_fixedprice'=>$city_price,'room_tax'=>$room_tax,'room_totalstay_flag'=>$room_totalstay_flag,'room_totalstay_percent'=>$room_percentage_val,'room_fixedprice_flag'=>$room_fixedprice_flag,'room_per_person'=>$room_persons,'room_fixedprice'=>$room_price,'vat_tax'=>$vat_tax,'vat_totalstay_flag'=>$vat_totalstay_flag,'vat_totalstay_percent'=>$vat_percentage_val,'vat_fixedprice_flag'=>$vat_fixedprice_flag,'vat_per_person'=>$vat_persons,'vat_fixedprice'=>$vat_price,'service_tax'=>$service_tax,'service_totalstay_flag'=>$service_totalstay_flag,'service_totalstay_percent'=>$service_percentage_val,'service_fixedprice_flag'=>$service_fixedprice_flag,'service_per_person'=>$service_persons,'service_fixedprice'=>$service_price);
		$this->db->insert('sup_apart_taxes',$data1);
		
	}
	function insert_house_info($atimefrom,$dtimebefore,$checkin_from1,$costin1,$checkin_from2,$costin2,$checkout_from1,$costout1,$checkout_from2,$costout2,$mistay,$mxstay,$pmode,$rentamtday,$clean,$supp,$apt_id,$policy,$pets)
	{
		$data = array('sup_apart_list_id'=>$apt_id,'arrivaltime_from'=>$atimefrom,'departtime_before'=>$dtimebefore,'checkin_time1'=>$checkin_from1,'checkin_time2'=>$checkin_from2,'checkout_time1'=>$checkout_from1,'checkout_time2'=>$checkout_from2,'checkin_extracost1'=>$costin1,'checkin_extracost2'=>$costin2,'checkout_extracost2'=>$costout1,'checkout_extracost1'=>$costout2,'mini_stay'=>$mistay,'max_stay'=>$mxstay,'rent_amount_days'=>$rentamtday,'payment_mode'=>$pmode,'cleaning'=>$clean,'supplies'=>$supp,'policy'=>$policy,'pets'=>$pets);
		$this->db->insert('sup_apart_houserules',$data);
	}
	function update_house_info($atimefrom,$dtimebefore,$checkin_from1,$costin1,$checkin_from2,$costin2,$checkout_from1,$costout1,$checkout_from2,$costout2,$mistay,$mxstay,$pmode,$rentamtday,$clean,$supp,$apt_id,$policy,$pets)
	{
		$data = array('arrivaltime_from'=>$atimefrom,'departtime_before'=>$dtimebefore,'checkin_time1'=>$checkin_from1,'checkin_time2'=>$checkin_from2,'checkout_time1'=>$checkout_from1,'checkout_time2'=>$checkout_from2,'checkin_extracost1'=>$costin1,'checkin_extracost2'=>$costin2,'checkout_extracost2'=>$costout1,'checkout_extracost1'=>$costout2,'mini_stay'=>$mistay,'max_stay'=>$mxstay,'rent_amount_days'=>$rentamtday,'payment_mode'=>$pmode,'cleaning'=>$clean,'supplies'=>$supp,'policy'=>$policy,'pets'=>$pets);
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->update('sup_apart_houserules',$data);
	}
	function get_bokings_sup($id)
		{
			$query = $this->db->query("SELECT * FROM booking_ref sa inner join passenger_info sl on sa.booking_no = sl.booking_no WHERE hotel_code= '".$id."'");
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
			  return $query->result();
			 
			}
		}
	function insert_general_settings_cards($user,$apartid,$checkval)
	{
		$data1 = array('sup_apart_list_id'=>$apartid,'sup_apart_cardaccept_list_id'=>$checkval);
		$this->db->insert('sup_apart_cardaccepted',$data1);
	}
	function get_rules($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_houserules');
		$this->db->where('sup_apart_list_id',$id);
		$query=$this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
	}
	function get_market_info($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apartcontact_info');
		$this->db->where('sup_apart_list_id',$id);
		$this->db->where('sup_apartcontact_type_id',2);
		$query=$this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
	} 
	function get_rate($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_rateplan');
		$this->db->where('sup_apart_rateplan_id',$id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
	}
	function get_plans($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_category');
		$this->db->where('sup_apart_list_id',$id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_rate_plans($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_rateplan');
		$this->db->where('sup_apart_list_id',$id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_maintain_plans($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_rateplan r');
		$this->db->join('sup_apart_category c','c.sup_apart_category_id = r.sup_apart_category_id');
		$this->db->where('r.sup_apart_list_id',$id);
		$this->db->order_by('r.sup_apart_rateplan_id','ASC');
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_first_details($room_id,$newdate,$newdate1)
	{
		$query = $this->db->query("SELECT * FROM sup_apart_maintain_month m inner join sup_apart_rateplan s on s.sup_apart_rateplan_id = m.sup_apart_rateplan_id WHERE date BETWEEN '".$newdate."' AND '".$newdate1."' AND m.sup_apart_rateplan_id = '".$room_id."'");
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_name($room_id)
	{
		$query = $this->db->query("SELECT s1.category_name,s.rate_name FROM sup_apart_rateplan s inner join sup_apart_category s1 on s.sup_apart_category_id = s1.sup_apart_category_id WHERE s.sup_apart_rateplan_id = '".$room_id."'");
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
	}
	function get_latest_details($newdate,$newdate1,$room_plan)
	{
		//echo "SELECT * FROM sup_apart_maintain_month m inner join sup_apart_rateplan s on s.sup_apart_rateplan_id = m.sup_apart_rateplan_id WHERE date BETWEEN '".$newdate."' AND '".$newdate1."' AND m.sup_apart_rateplan_id = '".$room_plan."' ";exit;
		$query = $this->db->query("SELECT * FROM sup_apart_maintain_month m inner join sup_apart_rateplan s on s.sup_apart_rateplan_id = m.sup_apart_rateplan_id WHERE date BETWEEN '".$newdate."' AND '".$newdate1."' AND m.sup_apart_rateplan_id = '".$room_plan."' ORDER BY date");
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_latest_details_week($newdate,$newdate1,$room_plan,$checkedval)
	{
	$day = '';
	$val  = explode(',',$checkedval);
	foreach($val as $row){
	
		$day .= "'".$row."'".',';
		}
		$day1 = substr($day,0,-1);
		$query = $this->db->query("SELECT * FROM sup_apart_maintain_month m inner join sup_apart_rateplan s on s.sup_apart_rateplan_id = m.sup_apart_rateplan_id WHERE date BETWEEN '".$newdate."' AND '".$newdate1."' AND m.sup_apart_rateplan_id = '".$room_plan."' AND day IN (".$day1.") ORDER BY date");
		
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_all_months($id)
	{
		$date = date('Y-m-d');
		$this->db->select('distinct(month),year');
		$this->db->from('sup_apart_maintain_month');
		$this->db->where('sup_apart_list_id',$id);
		$this->db->where('date >=',$date);
		$this->db->order_by('date','ASC');
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_all_dates($month,$year,$apt_id)
	{
		$this->db->select('distinct(date)');
		$this->db->from('sup_apart_maintain_month');
		$this->db->where('month',$month);
		$this->db->where('year',$year);
		$this->db->where('sup_apart_list_id',$apt_id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_indiv_plans($apt_id)
	{
		$this->db->select('distinct(sup_apart_category_id)');
		$this->db->from('sup_apart_rateplan');
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->order_by('sup_apart_category_id','ASC');
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_all_rates($month_name,$year_name,$apt_id)
	{
		$this->db->select('distinct(sup_apart_rateplan_id)');
		$this->db->from('sup_apart_maintain_month');
		$this->db->where('month',$month_name);
		$this->db->where('year',$year_name);
		$this->db->where('sup_apart_list_id',$apt_id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_maintain_status($rateplan_id,$pat_id,$date1)
	{
		$this->db->select('status,sup_apart_maintain_month_id');
		$this->db->from('sup_apart_maintain_month');
		$this->db->where('sup_apart_rateplan_id',$rateplan_id);
		$this->db->where('sup_apart_list_id',$pat_id);
		$this->db->where('date',$date1);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
	}
	function get_cat_name($id,$apt_id)
	{
		$this->db->select('category_name');
		$this->db->from('sup_apart_category');
		$this->db->where('sup_apart_category_id',$id);
		$this->db->where('sup_apart_list_id',$apt_id);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  $val = $query->row();
		  return $val->category_name;
		}
	}
	function cat_name($id)
	{
		$this->db->select('sup_apart_category_id');
		$this->db->from('sup_apart_rateplan');
		$this->db->where('sup_apart_rateplan_id',$id);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
			$val = $query->row();
			return $val->sup_apart_category_id;
		}
	}
	function get_rate_plan_open($id,$apt_id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_rateplan');
		$this->db->where('sup_apart_category_id',$id);
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->order_by('sup_apart_rateplan_id','ASC');
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ 
			return '';
		}
		else
		{
		  	return $query->result();
		}
	}
	function change_status($id,$status)
	{
		if($status == 1)
			{
				$status = 0;
			}
			else
			{
				$status = 1;
			}
			$data = array('status'=>$status);
			$this->db->where('sup_apart_maintain_month_id',$id);
			$this->db->update('sup_apart_maintain_month',$data);
	}
	function open_all($date,$id)
	{
		$status = 1;
		$data = array('status'=>$status);
		$this->db->where('sup_apart_list_id',$id);
		$this->db->where('date',$date);
		$this->db->update('sup_apart_maintain_month',$data);
	}
	function close__all($date,$id)
	{
		$status = 0;
		$data = array('status'=>$status);
		$this->db->where('sup_apart_list_id',$id);
		$this->db->where('date',$date);
		$this->db->update('sup_apart_maintain_month',$data);
	}
	function get_maintain_all_status($id,$date)
	{
		//$this->db->select('')
	}
	function get_unit_apt($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_category');
		$this->db->where('sup_apart_list_id',$id);
		$this->db->order_by('sup_apart_category_id','ASC');
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function add_rate_details($rate_plan,$default_avail,$capacity,$def_max,$def_min,$day_befr,$rate,$booking,$breakfast,$breakfast_type,$breakfastfrom,$breakfastto,$cancellation,$cancellation_days,$cancellation_nights,$charges,$charge_percent,$charge_rate,$per_night,$booking_details,$cancel_details,$apt_id,$plan,$newdate,$newdate1,$remarks_room,$diff,$type_book,$pre_payment,$percentage,$amount,$security_deposit,$deposit_method,$percentage_val,$per_days,$amount_val,$amt_days)
	{
		//$this->db->where('sup_apart_list_id',$apt_id);
	//	$this->db->delete('sup_apart_rateplan');
		
		$data = array('sup_apart_list_id'=>$apt_id,'rate_name'=>$rate_plan,'default_availablity'=>$default_avail,'capacity'=>$capacity,'max_stay'=>$def_max,'mini_stay'=>$def_min,'days_before'=>$day_befr,'default_rate'=>$rate,'booking_type'=>$booking,'breakfast'=>$breakfast,'breakfast_type'=>$breakfast_type,'breakfast_from'=>$breakfastfrom,'breakfast_to'=>$breakfastto,'book_policy'=>$booking_details,
		'cancel_comments'=>$cancel_details,'policy_flag'=>$cancellation,'hours1'=>$cancellation_days,'hours2'=>$cancellation_nights,'charges'=>$charges,'charge_persent'=>$charge_percent,'charge_price'=>$charge_rate,'charge_nights'=>$per_night,'sup_apart_category_id'=>$plan,'startdate'=>$newdate,'enddate'=>$newdate1,'rate_remarks'=>$remarks_room,'type_book'=>$type_book,'security_deposit'=>$security_deposit,'deposit_method'=>$deposit_method,'percentage_val'=>$percentage_val,'per_days'=>$per_days,'amount_val'=>$amount_val,'amt_days'=>$amt_days);
		$this->db->insert('sup_apart_rateplan',$data);
		$latest_id = $this->db->insert_id();
		 if($type_book == 1)
					{
						$type_book = 0;
					}
					else
					{
						$type_book =1;
					}
		for ($i=0; $i<=$diff; $i++)
			{
 			    $date = date('Y-m-d', strtotime($newdate . "+$i day"));
				$new1= date("D", strtotime($newdate . "+$i day"));
				$month= date("M", strtotime($newdate . "+$i day"));
				$year= date("Y", strtotime($newdate . "+$i day"));
				$data1 = array('sup_apart_rateplan_id'=>$latest_id,'sup_apart_list_id'=>$apt_id,'date'=>$date,'day'=>$new1,'available'=>$default_avail,'min_stay'=>$def_min,'maxi_stay'=>$def_max,'rate'=>$rate,'month'=>$month,'year'=>$year,'capacity'=>$capacity,'on_request'=>$type_book);
				$this->db->insert('sup_apart_maintain_month',$data1);
			}
			$data8 = array('type_book'=>$pre_payment,'total_percentage'=>$percentage,'total_amount'=>$amount,'sup_rate_plan_id'=>$latest_id);
			$this->db->insert('pre_payment',$data8);
		

	}
	function update_rate_details($rate_plan,$default_avail,$capacity,$def_max,$def_min,$day_befr,$rate,$booking,$breakfast,$breakfast_type,$breakfastfrom,$breakfastto,$cancellation,$cancellation_days,$cancellation_nights,$charges,$charge_percent,$charge_rate,$per_night,$booking_details,$cancel_details,$apt_id,$id,$newdate,$newdate1,$remarks_room,$diff,$type_book,$pre_payment,$percentage,$amount,$security_deposit,$deposit_method,$percentage_val,$per_days,$amount_val,$amt_days)
	{
		//echo $id;exit;
	//echo $cancellation_days;echo $charge_percent;exit;
		//$this->db->where('sup_apart_rateplan_id',$id);
		//$this->db->delete('sup_apart_rateplan');
		$data = array('sup_apart_list_id'=>$apt_id,'rate_name'=>$rate_plan,'default_availablity'=>$default_avail,'capacity'=>$capacity,'max_stay'=>$def_max,'mini_stay'=>$def_min,'days_before'=>$day_befr,'default_rate'=>$rate,'booking_type'=>$booking,'breakfast'=>$breakfast,'breakfast_type'=>$breakfast_type,'breakfast_from'=>$breakfastfrom,'breakfast_to'=>$breakfastto,'book_policy'=>$booking_details,
		'cancel_comments'=>$cancel_details,'policy_flag'=>$cancellation,'hours1'=>$cancellation_days,'hours2'=>$cancellation_nights,'charges'=>$charges,'charge_persent'=>$charge_percent,'charge_price'=>$charge_rate,'charge_nights'=>$per_night,'rate_remarks'=>$remarks_room,'type_book'=>$type_book,'security_deposit'=>$security_deposit,'deposit_method'=>$deposit_method,'percentage_val'=>$percentage_val,'per_days'=>$per_days,'amount_val'=>$amount_val,'amt_days'=>$amt_days);
		$this->db->where('sup_apart_rateplan_id',$id);
		$this->db->update('sup_apart_rateplan',$data);
		 if($type_book == 1)
					{
						$type_book = 0;
					}
					else
					{
						$type_book =1;
					}
		for ($i=0; $i<=$diff; $i++)
			{
 			    $date = date('Y-m-d', strtotime($newdate . "+$i day"));
				$new1= date("D", strtotime($newdate . "+$i day"));
				$month= date("M", strtotime($newdate . "+$i day"));
				$year= date("Y", strtotime($newdate . "+$i day"));
				$this->db->select('sup_apart_maintain_month_id');
				$this->db->from('sup_apart_maintain_month');
				$this->db->where('date',$date);
				$this->db->where('sup_apart_rateplan_id',$id);
				$query=$this->db->get();
	
				if($query->num_rows() =='')
				{
					
					 $data1 = array('sup_apart_rateplan_id'=>$id,'sup_apart_list_id'=>$apt_id,'date'=>$date,'day'=>$new1,'available'=>$default_avail,'min_stay'=>$def_min,'maxi_stay'=>$def_max,'rate'=>$rate,'month'=>$month,'year'=>$year,'capacity'=>$capacity,'on_request'=>$type_book);
				$this->db->insert('sup_apart_maintain_month',$data1);
				}
				else
				{
					 $val =  $query->row();
					 $sup_apart_maintain_month_id = $val->sup_apart_maintain_month_id;
					
		  			$data2 = array('sup_apart_list_id'=>$apt_id,'date'=>$date,'day'=>$new1,'available'=>$default_avail,'min_stay'=>$def_min,'maxi_stay'=>$def_max,'rate'=>$rate,'month'=>$month,'year'=>$year,'capacity'=>$capacity,'on_request'=>$type_book);
				$this->db->where('sup_apart_maintain_month_id',$sup_apart_maintain_month_id);
				$this->db->update('sup_apart_maintain_month',$data2);
				
				}
			}
			$this->db->select('sup_rate_plan_id');
			$this->db->from('pre_payment');
			$this->db->where('sup_rate_plan_id',$id);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{
				$data8 = array('type_book'=>$pre_payment,'total_percentage'=>$percentage,'total_amount'=>$amount,'sup_rate_plan_id'=>$id);
				$this->db->insert('pre_payment',$data8);
			}
			else
			{
				$data8 = array('type_book'=>$pre_payment,'total_percentage'=>$percentage,'total_amount'=>$amount);
				$this->db->where('sup_rate_plan_id',$id);
				$this->db->update('pre_payment',$data8);
			}
	}
	function pre_payment($id)
	{
		$this->db->select('*');
		$this->db->from('pre_payment');
		$this->db->where('sup_rate_plan_id',$id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
		
	}
	function get_months($apt_id,$room_id)
	{
		$this->db->select('distinct(month),year');
		$this->db->from('sup_apart_maintain_month');
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->where('sup_apart_rateplan_id',$room_id);
		$this->db->order_by('date','ASC');
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_min_date($month,$year,$room_plan,$apt_id)
	{	
		$this->db->select('min(date) as min_date');
		$this->db->from('sup_apart_maintain_month');
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->where('sup_apart_rateplan_id',$room_plan);
		$this->db->where('month',$month);
		$this->db->where('year',$year);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  $val =  $query->row();
		  return $val->min_date;
		}
	}
	function get_max_date($month,$year,$room_plan,$apt_id)
	{	
		$this->db->select('max(date) as max_date');
		$this->db->from('sup_apart_maintain_month');
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->where('sup_apart_rateplan_id',$room_plan);
		$this->db->where('month',$month);
		$this->db->where('year',$year);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  $val =  $query->row();
		  return $val->max_date;
		}
	}
	function delete_room($id,$apt_id)
	{
		$this->db->where('sup_apart_rateplan_id',$id);
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->delete('sup_apart_rateplan');
		$this->db->where('sup_apart_rateplan_id',$id);
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->delete('sup_apart_maintain_month');
	}
	function update_all($room_id,$apt_id,$newdate,$newdate1)
	{
		$query = $this->db->query("UPDATE  sup_apart_maintain_month SET on_request = 0,block_arrival = 0,block_departure = 0 WHERE sup_apart_rateplan_id = '".$room_id."' AND sup_apart_list_id = '".$apt_id."' AND date BETWEEN '".$newdate."' AND '".$newdate1."'");	
	}
	function update_onreq($apt_id,$on_req_checked_val,$room_id)
	{
		$data = array('on_request'=>1);
		$this->db->where('date',$on_req_checked_val);
		$this->db->where('sup_apart_rateplan_id',$room_id);
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->update('sup_apart_maintain_month',$data);
	}
	function update_on_arr($apt_id,$on_req_checked_val,$room_id)
	{
		$data = array('block_arrival'=>1);
		$this->db->where('date',$on_req_checked_val);
		$this->db->where('sup_apart_rateplan_id',$room_id);
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->update('sup_apart_maintain_month',$data);
	}
	function update_on_blk($apt_id,$on_req_checked_val,$room_id)
	{
		$data = array('block_departure'=>1);
		$this->db->where('date',$on_req_checked_val);
		$this->db->where('sup_apart_rateplan_id',$room_id);
		$this->db->where('sup_apart_list_id',$apt_id);
		$this->db->update('sup_apart_maintain_month',$data);
	}
	function update_by_month($apt_id,$room_id,$price,$avail,$min_stay,$max_stay,$date)
	{
		/*if($avail)
		{*/
		$this->db->query("UPDATE sup_apart_maintain_month SET rate = '".$price."', available = '".$avail."', min_stay = '".$max_stay."',maxi_stay = '".$min_stay."' WHERE sup_apart_rateplan_id = '".$room_id."' AND sup_apart_list_id = '".$apt_id."' AND date = '".$date."'");
		/*}
		else
		{
			//echo "UPDATE sup_apart_maintain_month SET rate = '".$price."', status=0, available = '".$avail."', min_stay = '".$max_stay."',maxi_stay = '".$min_stay."' WHERE sup_apart_rateplan_id = '".$room_id."' AND sup_apart_list_id = '".$apt_id."' AND date = '".$date."' ";exit;
			$this->db->query("UPDATE sup_apart_maintain_month SET rate = '".$price."', status=0, available = '".$avail."', min_stay = '".$max_stay."',maxi_stay = '".$min_stay."' WHERE sup_apart_rateplan_id = '".$room_id."' AND sup_apart_list_id = '".$apt_id."' AND date = '".$date."'");
		}
		*/
		
		
	}
	function get_units($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_category');
		$this->db->where('sup_apart_list_id',$id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_unit_details_indi($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_category');
		$this->db->where('sup_apart_category_id',$id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function cat_status($id,$stat)
	{
		if($stat == 1)
		{
			$stat = 0;
		}
		else
		{
			$stat = 1;
		}
		$data = array('status'=>$stat);
		$this->db->where('sup_apart_category_id',$id);
		$this->db->update('sup_apart_category',$data);
	}
	function delete_unit($id)
	{	
		$this->db->where('sup_apart_category_id',$id);
		$this->db->delete('sup_apart_category');
	}
	function get_plan_listval($aptid)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_rateplan');
		$this->db->where('sup_apart_list_id',$aptid);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}		
		
	} 
	function get_rooms($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_rateplan s');
		$this->db->join('sup_apart_category c','c.sup_apart_category_id = s.sup_apart_category_id');
		$this->db->where('s.sup_apart_list_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}		
		
	}
	function get_unit_details($aptid)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_unitdetails');
		$this->db->where('sup_apart_list_id',$aptid);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}		
		
	} 
	function get_extra_details($aptid)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_extraservice');
		$this->db->where('sup_apart_list_id',$aptid);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}		
		
	} 
	function get_finance_info($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apartcontact_info');
		$this->db->where('sup_apart_list_id',$id);
		$this->db->where('sup_apartcontact_type_id',3);
		$query=$this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
	}
	function get_language_sup($id)
	{
		$query = $this->db->query("select language_id from language where language_id = '".$id."'");
		if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				$val =  $query->row();
				return $val->language_id;
			}
	}
	function delete_unit_info($id)
	{
		$this->db->where('sup_apart_list_id',$id);
		$this->db->delete('sup_apart_unitdetails');
	}
	function delete_extra_info($id)
	{
		$this->db->where('sup_apart_list_id',$id);
		$this->db->delete('sup_apart_extraservice');
	}
	function update_unit_info($apt_id,$personn,$personm,$size,$rooms,$terrace,$floors,$brooms,$charge,$unitcate,$plan,$id,$desc)
	{
		$data = array('sup_apart_list_id'=>$apt_id,'max_persons'=>$personm,'normal_persons'=>$personn,'size'=>$size,'bedrooms'=>$rooms,'terrace'=>$terrace,'floors'=>$floors,'bathrooms'=>$brooms,'add_charges'=>$charge,'category_name'=>$unitcate,'sup_apart_categoryrate'=>$plan,'desc'=>$desc);
		$this->db->where('sup_apart_category_id',$id);
		$this->db->update('sup_apart_category',$data);
	}
	function insert_unit_info($apt_id,$personn,$personm,$size,$rooms,$terrace,$floors,$brooms,$charge,$unitcate,$plan,$desc)
	{
		$data = array('sup_apart_list_id'=>$apt_id,'max_persons'=>$personm,'normal_persons'=>$personn,'size'=>$size,'bedrooms'=>$rooms,'terrace'=>$terrace,'floors'=>$floors,'bathrooms'=>$brooms,'add_charges'=>$charge,'category_name'=>$unitcate,'sup_apart_categoryrate'=>$plan,'desc'=>$desc);
		$this->db->insert('sup_apart_category',$data);
	}
	function insert_extra_info($apt_id,$service,$cost,$mode)
	{
		$data = array('sup_apart_list_id'=>$apt_id,'extraservice'=>$service,'cost'=>$cost,'mode'=>$mode);
		$this->db->insert('sup_apart_extraservice',$data);
	}
	function check_username_valid($email)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->where('user_type_id',1);
		$query=$this->db->get();
	//	echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  $row=$query->row();
		  return $row->email;
		}	
	}
    function get_roomfecilities($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_roomfacilities');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return $query->result();				
		}
	} 
	function del_supplier_roomfecility($hotelid)
	{
		$this->db->delete('sup_apart_roomfacilities',array('sup_apart_category_id'=>$hotelid));
	}
	function add_supplier_roomfecility($user,$apartid,$checkval,$comments,$sup_apart_category_id)
	{
		$data1=array('sup_apart_list_id'=>$apartid,'sup_apart_roomfacilities_list_id'=>$checkval,'comments'=>$comments,'sup_apart_category_id'=>$sup_apart_category_id);
		$this->db->insert('sup_apart_roomfacilities',$data1);	
	} 
   function get_apartfecilities($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_facilities');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return $query->result();				
		}
	} 
	function get_apartfecilitylist()
	{
		$this->db->select('*');
		$this->db->from('sup_apart_facilities_list');
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return $query->result();				
		}
	} 
	function del_supplier_apartfecility($hotelid)
	{
		$this->db->delete('sup_apart_facilities',array('sup_apart_list_id'=>$hotelid));
	}
	function add_supplier_apartfecility($user,$apartid,$checkval,$comments)
	{
		$data1=array('sup_apart_list_id'=>$apartid,'sup_apart_facilities_list_id'=>$checkval,'comments'=>$comments);
		$this->db->insert('sup_apart_facilities',$data1);	
	} 
	function add_check_pictures($apartid,$checkval,$comments,$status)
	{ //print $checkval ; 
	//	print $status ;
	//print $apartid ; exit;
		if($status == 1)
		{
			$stat = 0 ;
		}
		else
		{
			$stat = 1 ;
		}
		
		//print $stat ; exit;
		$data = array('title'=>$comments,'status'=>$stat);
		$this->db->where('sup_apart_pictures_id',$checkval);
		$this->db->update('sup_apart_pictures',$data);	
	}
	function add_check_roomfecility($user,$apartid,$checkval,$comments,$id)
	{
		$data = array('title'=>$comments,'status'=>1);
		$this->db->where('sup_apart_roompictures_id',$checkval);
		$this->db->update('sup_apart_roompictures',$data);	
	}
	function delete_picture($id)
	{
		$this->db->select('image_name');
		$this->db->from('sup_apart_pictures');
		$this->db->where('sup_apart_pictures_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			$val =  $query->row();	
			return $val->image_name;			
		}
		
	}
	function delete_roompicture($id)
	{
		$this->db->select('image_name');
		$this->db->from('sup_apart_roompictures');
		$this->db->where('sup_apart_roompictures_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			$val =  $query->row();	
			return $val->image_name;			
		}
		
	}
	function delete_pictures($id)
	{
		
		$this->db->where('sup_apart_pictures_id',$id);
		$this->db->delete('sup_apart_pictures');	
	}
	function delete_roompictures($id)
	{
		
		$this->db->where('sup_apart_roompictures_id',$id);
		$this->db->delete('sup_apart_roompictures');	
	}
	function get_cards()
	{
		$this->db->select('*');
		$this->db->from('sup_apart_cardaccept_list');
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return  $query->result();	
		
		}
	}
	function get_cardacceptedlist($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_cardaccepted');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return  $query->result();	
		
		}
	}
	function get_taxes($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_generalsettings');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return  $query->row();	
		
		}
	}
	function delete_general_settings($id)
	{
		$this->db->where('sup_apart_list_id',$id);
		$this->db->delete('sup_apart_generalsettings');
		$this->db->where('sup_apart_list_id',$id);
		$this->db->delete('sup_apart_cardaccepted');
		$this->db->where('sup_apart_list_id',$id);
		$this->db->delete('sup_apart_taxes');
	}
	function get_times()
	{
		$this->db->select('*');
		$this->db->from('sup_apart_checktimes');
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return  $query->result();	
		
		}
	}
	function get_general($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_taxes');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return  $query->row();	
		
		}
	}
	function get_position($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_profile');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
	}
	function get_location($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_detailedlocation');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
	}
	function delete_location($id)
	{
		$this->db->where('sup_apart_list_id',$id);
		$this->db->delete('sup_apart_detailedlocation');
	}
	function get_picures($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_pictures');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ 
			return '';
		}
		else
		{
			 return $query->result();
		}
		
	}
	function get_room_picures($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_roompictures');
		$this->db->where('sup_apart_category_id',$id);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{ 
			return '';
		}
		else
		{
			 return $query->result();
		}
	}
	function upload_picture($img,$id)
	{
		
		$data = array('sup_apart_list_id'=>$id,'image_name'=>$img,'added_by'=>1);
		$this->db->insert('sup_apart_pictures',$data);
	}
	function upload_room_picture($img,$id,$room_id)
	{
		$data = array('sup_apart_list_id'=>$id,'image_name'=>$img,'sup_apart_category_id'=>$room_id,'added_by'=>1);
		$this->db->insert('sup_apart_roompictures',$data);
	}
	function add_location($location,$airport,$transport,$interest,$apt_id)
	{
		$data = array('location'=>$location,'nearby_airport'=>$airport,'nearby_transport'=>$transport,'nearby_placeinterest'=>$interest,'sup_apart_list_id'=>$apt_id);
		$this->db->insert('sup_apart_detailedlocation',$data);
	}
	function insert_property_info($class,$group,$long,$lat,$time_zone,$star,$currency,$website,$response,$fax,$email,$confirmation_fax,$confirmation_email,$apt_id,$address,$prop_info)
	{
		$data = array('sup_apart_list_id'=>$apt_id,'sup_apartclass_type_id'=>$class,'longitude'=>$long,'latitude'=>$lat,'sup_apart_timezone_list_id'=>$time_zone,'brand'=>$group,'booking_type'=>$response,'confirmation_type_fax'=>$fax,'confirmation_type_email'=>$email,'confirmation_fax'=>$confirmation_fax,'confirmation_mail'=>$confirmation_email,'star'=>$star,'website'=>$website,'address'=>$address,'currency_id'=>$currency,'details'=>$prop_info);
		$this->db->insert('sup_apart_profile',$data);
	}
	
	function get_sup_cnt($id)
	{
		$this->db->select('country_id');
		$this->db->from('sup_apart_list');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			$val = $query->row();				
			return $val->country_id;
		}
	}
	function get_profile($id)
	{
//		echo $id;exit;
		$this->db->select('*');
		$this->db->from('sup_apart_profile');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return $query->row();				
		}
	}
	function delete_property_info($id)
	{
		$this->db->where('sup_apart_list_id',$id);
		$this->db->delete('sup_apart_profile');
	}
	function get_pwd($email)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->where('user_type_id',1);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return $query->row();
			
		}
	}
	function check_sup_email_valid($email)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->where('user_type_id',1);
		$query=$this->db->get();
	//	echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  $row=$query->row();
		  return $row->email;
		}	
	}
	function check_cust_email_valid($email)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->where('user_type_id',4);
		$query=$this->db->get();
	//	echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  $row=$query->row();
		  return $row->email;
		}	
	}
	function check_confirm_pwd($id,$cur_pwd)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_id',$id);
		$this->db->where('password',$cur_pwd);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  $row=$query->row();
		  return $row->email;
		}	
	}
	function change_password($new_pwd,$id)
	{
		$data = array('password'=>$new_pwd);
		$this->db->where('user_id',$id);
		$this->db->update('user',$data);
	}
	function get_sup_details($id)
	{
		//echo "select * from user u inner join user_profile us on u.user_id = us.user_id";exit;
		$query = $this->db->query("select * from user u inner join user_profile us on u.user_id = us.user_id where u.user_id ='".$id."' ");
		//$query = $this->db->query("select * from user u inner join sup_apart_list us on u.user_id = us.user_id where us.sup_apart_list_id ='".$id."' ");
		if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->row();
			}
	}
	function update_personel_info($user_id,$fname,$lname,$cnum,$brand,$pos,$noofemp)
	{
		$data = array('first_name'=>$fname,'last_name'=>$lname,'agency_name'=>$brand,'position'=>$pos,'noofemp'=>$noofemp);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data);
		$data1 = array('mobile_no'=>$cnum);
		$this->db->where('user_id',$user_id);
		$this->db->update('user_profile',$data1);
	}
	function update_adds_info($user_id,$address,$country,$state,$city,$postal_code)
	{
		$data = array('address'=>$address,'country'=>$country,'state'=>$state,'city'=>$city,'postal_code'=>$postal_code);
		$this->db->where('user_id',$user_id);
		$this->db->update('user_profile',$data);
	}
	function update_payment_details($user_id,$transfer_to,$acc_num,$swjft,$currency,$payment,$bank_name,$bank_adds1,$bank_adds2,$country,$bank_state,$bank_city,$postal_code,$tax_id,$apt_id)
	{
		$this->db->select('user_id');
		$this->db->from('user_payment_details');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{
				$data = array('transfer_to'=>$transfer_to,'acc_num'=>$acc_num,'swjft'=>$swjft,'payment_currency'=>$currency,'max_payment'=>$payment,'bank_name'=>$bank_name,'address1'=>$bank_adds1,'address2'=>$bank_adds2,'bacnk_country'=>$country,'bank_state'=>$bank_state,'bank_city'=>$bank_city,'postal_code'=>$postal_code,'tax_id'=>$tax_id,'user_id'=>$user_id,'sup_apart_id'=>$apt_id);
				$this->db->insert('user_payment_details',$data);
		}
		else
		{
			$data = array('transfer_to'=>$transfer_to,'acc_num'=>$acc_num,'swjft'=>$swjft,'payment_currency'=>$currency,'max_payment'=>$payment,'bank_name'=>$bank_name,'address1'=>$bank_adds1,'address2'=>$bank_adds2,'bacnk_country'=>$country,'bank_state'=>$bank_state,'bank_city'=>$bank_city,'postal_code'=>$postal_code,'tax_id'=>$tax_id);
			$this->db->where('user_id',$user_id);
			$this->db->where('sup_apart_id',$apt_id);
			$this->db->update('user_payment_details',$data);
		}
	}
	function get_payment_details($id,$sup_id)
	{
		$this->db->select('*');
		$this->db->from('user_payment_details');
		$this->db->where('user_id',$id);
		$this->db->where('sup_apart_id',$sup_id);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}
	function add_site($user_id,$site_id,$site_name,$url,$status)
	{
		$data = array('site_id'=>$site_id,'site_name'=>$site_name,'url'=>$url,'status'=>$status,'user_id'=>$user_id);
		$this->db->insert('user_sites',$data);
	}
	function sites($id)
	{
		$this->db->select('*');
		$this->db->from('user_sites');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			return $query->result();
		}
	}
	function get_sup_details1($id)
	{
		//echo "select * from user u inner join user_profile us on u.user_id = us.user_id";exit;
		$query = $this->db->query("select * from sup_apart_list where sup_apart_list_id ='".$id."' ");
		//$query = $this->db->query("select * from user u inner join sup_apart_list us on u.user_id = us.user_id where us.sup_apart_list_id ='".$id."' ");
		if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->row();
			}
	}
	function update_names($fname,$lname,$user_id)
	{
		$data = array('first_name'=>$fname,'last_name'=>$lname);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data);
		$data1 = array('first_name'=>$fname,'last_name'=>$lname);
		$this->db->where('user_id',$user_id);
		$this->db->update('sup_apart_list',$data);
		
	}
	function update_sup_list($fname,$lname,$user_id,$apt_name,$city,$email,$apt,$district,$region)
	{
		$data = array('first_name'=>$fname,'last_name'=>$lname,'user_id'=>$user_id,'apartment_name'=>$apt_name,'city'=>$city,'email'=>$email,'district_id'=>$district,'region'=>$region);
		$this->db->where('sup_apart_list_id',$apt);
		$this->db->update('sup_apart_list',$data);
	}
	function insert_sup_list($fname,$lname,$user_id,$apt_name,$city,$country,$language,$email,$apt,$district,$region)
	{
		$data = array('first_name'=>$fname,'last_name'=>$lname,'user_id'=>$user_id,'apartment_name'=>$apt_name,'city'=>$city,'country_id'=>$country,'language_id'=>$language,'email'=>$email,'apartment_id'=>$apt,'district_id'=>$district,'region'=>$region);
		$this->db->insert('sup_apart_list',$data);
		return $this->db->insert_id();
	}
	function get_classtype()
	{
		$this->db->select('*');
		$this->db->from('sup_apartclass_type');
		$query = $this->db->get();
		if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->result();
			}
	}
	function get_timezone()
	{
		$this->db->select('*');
		$this->db->from('sup_apart_timezone_list');
		$query = $this->db->get();
		if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->result();
			}
	}
	function get_currency()
	{
		$this->db->select('*');
		$this->db->from('currency_converter');
		$query = $this->db->get();
		if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->result();
			}
	}
	function get_sup_id($id)
	{
		$query = $this->db->query("select sup_apart_list_id from sup_apart_list where user_id = '".$id."'");
		if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				$val =  $query->row();
				return $val->sup_apart_list_id;
			}
	}
	function get_apt_details($id)
	{
		$query = $this->db->query("select * from sup_apart_list WHERE sup_apart_list_id ='".$id."'");
		if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->row();
			}
	}
	function add_supplier($country,$city,$appt_name,$language,$gen_sal,$fname,$lname,$email,$passd,$prop_name)
	{
	$data = array('first_name'=>$fname,'agency_name'=>$appt_name,'last_name'=>$lname,'email'=>$email,'password'=>$passd,'added_by'=>0,'status'=>'Inactive','user_type_id'=>1);
	$this->db->insert('user',$data);
	$id = $this->db->insert_id();
	$apt_id = 'APT'.time();
 	$data1 = array('user_id'=>$id,'apartment_id'=>$apt_id,'apartment_name'=>$prop_name,'first_name'=>$fname,'last_name'=>$lname,'email'=>$email,'city'=>$city,'country_id'=>$country,'language_id'=>$language,'added_by'=>0,'status'=>0);
	$this->db->insert('sup_apart_list',$data1);
	$data2 = array('country'=>$country,'user_id'=>$id,'city'=>$city);
	$this->db->insert('user_profile',$data2);
	}
	
	function check_login_sup($login_name,$password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$login_name);
		$this->db->where('password',$password);
		$this->db->where('user_type_id',1);
		$this->db->where('status','Active');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function apartment_list($user)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_list');
		$this->db->join('country','country.country_id = sup_apart_list.country_id','inner');
		$this->db->where('user_id',$user);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function insert_into_manage($fname,$lname,$pincode,$position,$email,$pwd,$id,$user_id)
	{
		$data = array('fname'=>$fname,'lname'=>$lname,'pin'=>$pincode,'position'=>$position,'email'=>$email,'password'=>$pwd,'prop'=>$id,'user_id'=>$user_id);
		$this->db->insert('manage_users',$data);	
		
	}
	function delete_user($id)
	{
		$this->db->where('manage_users_id',$id);
		$this->db->delete('manage_users');
	}
	function udpate_into_manage($fname,$lname,$pincode,$position,$id,$user_id,$id1)
	{
		$data = array('fname'=>$fname,'lname'=>$lname,'pin'=>$pincode,'position'=>$position,'prop'=>$id,'user_id'=>$user_id);
		$this->db->where('manage_users_id',$id1);
		$this->db->update('manage_users',$data);	
		
	}
	function edit_user_manage($id)
		{
			$this->db->select('*');
			$this->db->from('manage_users');
			$this->db->where('manage_users_id',$id);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
			  return $query->row();
			 
			}
		}
		function supplier_group_list($uid)
		{
			$this->db->select('hotel_group_book.group_reservation_id,hotel_group_book_itinerary.destination,hotel_group_book_itinerary.checkin,hotel_group_book_itinerary.checkout,hotel_group_book_itinerary.rooms,hotel_group_book_itinerary.comments,hotel_group_book.hotel_group_book_id,hotel_group_book.user_id,user.email,user.first_name');
			$this->db->from('groubook_match_rooms');
			$this->db->join('hotel_group_book','hotel_group_book.hotel_group_book_id = groubook_match_rooms.hotel_group_book_id','inner');
			$this->db->join('hotel_group_book_itinerary','hotel_group_book_itinerary.hotel_group_book_id = groubook_match_rooms.hotel_group_book_id','inner');
			$this->db->join('user','user.user_id = hotel_group_book.user_id','inner');
			$this->db->where('groubook_match_rooms.user_id',$uid);
			$this->db->order_by('assigned_date','DESC');
        	$this->db->group_by('groubook_match_rooms.hotel_group_book_id'); 
			$query = $this->db->get();
			//print_r( $this->db->last_query());exit();
			if($query->num_rows()== '')
			{
				return '';
			}			
			else
			{
				return $query->result();
			}
		}
		
		function agent_group_list($uid)
		{
			$uid = 3;
			$this->db->select('hotel_group_book.group_reservation_id,hotel_group_book_itinerary.destination,hotel_group_book_itinerary.checkin,hotel_group_book_itinerary.checkout,hotel_group_book_itinerary.rooms,hotel_group_book_itinerary.comments,hotel_group_book.hotel_group_book_id,hotel_group_book.user_id');
			$this->db->from('groubook_match_rooms');
			$this->db->join('hotel_group_book','hotel_group_book.hotel_group_book_id = groubook_match_rooms.hotel_group_book_id','inner');
			$this->db->join('hotel_group_book_itinerary','hotel_group_book_itinerary.hotel_group_book_id = groubook_match_rooms.hotel_group_book_id','inner');
			$this->db->join('group_book_agents','group_book_agents.group_book_agents_id = hotel_group_book.group_book_agents_id','inner');
			$this->db->where('hotel_group_book.group_book_agents_id',$uid);
			$this->db->order_by('assigned_date','DESC');
        	$this->db->group_by('groubook_match_rooms.hotel_group_book_id'); 
			$query = $this->db->get();
			//print_r( $this->db->last_query());exit();
			if($query->num_rows()== '')
			{
				return '';
			}			
			else
			{
				return $query->result();
			}
		}
		function get_groupresev_details($gid)
		{
			$this->db->select('hotel_group_book.group_name,hotel_group_book.group_book_type_id,hotel_group_book.request_date,hotel_group_book.status,hotel_group_book.request_date,hotel_group_book_itinerary.rating,hotel_group_book_itinerary.bid_amount,hotel_group_book.hotel_group_book_id,hotel_group_book.group_reservation_id,currency_converter.currency,group_book_type.type_name,hotel_group_book.hotel_group_book_id,
hotel_group_book_itinerary.destination,hotel_group_book_itinerary.checkin,hotel_group_book_itinerary.checkout,hotel_group_book_itinerary.rooms,hotel_group_book_itinerary.comments,user.last_name,user.first_name,user.middle_name,user.user_name,user.email as uemail,group_book_agents.agent_name,group_book_agents.email');
			$this->db->from('hotel_group_book');	   
			$this->db->join('hotel_group_book_itinerary','hotel_group_book.hotel_group_book_id = hotel_group_book_itinerary.hotel_group_book_id','inner');			
			$this->db->join('group_book_type','group_book_type.group_book_type_id = hotel_group_book.group_book_type_id','inner');
			$this->db->join('currency_converter','currency_converter.currency_id = hotel_group_book_itinerary.currency_id','inner');
			$this->db->join('user','user.user_id = hotel_group_book.user_id','inner');	
			$this->db->join('group_book_agents','group_book_agents.group_book_agents_id = hotel_group_book.group_book_agents_id','inner');
			$this->db->where('hotel_group_book.hotel_group_book_id',$gid);
			$query = $this->db->get();
			//echo "sdfsdfds";print_r( $this->db->last_query());exit();
			if($query->num_rows()== '')
			{
				return '';
			}			
			else
			{
				return $query->result();
			}  
		}
		function get_hotel_details($gid)
		{
			$this->db->select('hotel_group_book.hotel_group_book_id,hotel_group_book.request_date,hotel_group_book.status,hotel_group_book.request_date,hotel_group_book_itinerary.rating,hotel_group_book_itinerary.bid_amount,hotel_group_book.hotel_group_book_id,hotel_group_book.group_reservation_id,hotel_group_book_itinerary.destination,hotel_group_book_itinerary.checkin,hotel_group_book_itinerary.checkout,hotel_group_book_itinerary.rooms,hotel_group_book_itinerary.comments');
			$this->db->from('hotel_group_book');	   
			$this->db->join('hotel_group_book_itinerary','hotel_group_book.hotel_group_book_id = hotel_group_book_itinerary.hotel_group_book_id','inner');			
			$this->db->where('hotel_group_book.hotel_group_book_id',$gid);
			$query = $this->db->get();
			if($query->num_rows()== '')
			{
				return '';
			}			
			else
			{
				$result['hotel'] = $query->result();
				$rating = $result['hotel'][0]->rating; 
				$destination = $result['hotel'][0]->destination;
				$amount = $result['hotel'][0]->bid_amount;
				$rooms = $result['hotel'][0]->rooms; 
				$destpos = strpos($destination, ",");
				$destination = substr($destination,0,$destpos);
	
				$this->db->select('hotel_search_result.result_id,hotel_search_result.hotel_name,hotel_search_result.hotel_name,hotel_search_result.city_name,hotel_search_result.offer_price,hotel_search_result.cost_type,hotel_search_result.address');
				$this->db->from('hotel_search_result');	   
				$this->db->where('hotel_search_result.star_rate IN ('.$rating.')');
				$this->db->where('hotel_search_result.city_name LIKE',$destination.'%');
				$this->db->where('hotel_search_result.offer_price <= ',$amount);
				$this->db->where('hotel_search_result.offer_price != ',0);
				$this->db->where('hotel_search_result.no_of_room >= ',$rooms);
				$query = $this->db->get();
				if($query->num_rows()== '')
				{
					return '';
				}			
				else
				{
					if($log == 1){
						return $query->num_rows();
					}else{
						return $query->result();
					}
				}
			}  
		}
		function car_details()
		{
			$this->db->select('*');
			$this->db->from('car_details');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function supplier_info($id)
		{
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('user_id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}function gbagent_info($id)
		{
			$this->db->select('*');
			$this->db->from('group_book_agents');
			$this->db->where('group_book_agents_id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function supplier_info2($id)
		{
			$this->db->select('*');
			$this->db->from('user_profile');
			$this->db->where('user_id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		function usertype()
		{
			$select="select * from  user_type";
			$query = $this->db->query($select);	
			//$query=$this->db->get();

			//var_dump($query);
		
			if($query->num_rows() =='')
			{ 
				return '';
			}
			else
			{
			  return $query->result();
		  
			}
		}
		
		function get_rooms_list()
	  {
		$this->db->select('*');
		$this->db->from('sup_apart_roomfacilities');
		//$this->db->where('sup_apart_list_id',$user);
		$query = $this->db->get();
		if($query->num_rows() <= 0)
		{
			return '';			
		}
		else
		{
			return $query->result();				
		}
       }
		
		function get_roomfecilitylist()
	    {
			$this->db->select('*');
			$this->db->from('sup_apart_roomfacilities_list');
			//$this->db->where('sup_apart_list_id ',$id);
			$query = $this->db->get();
			if($query->num_rows() <= 0)
			{
				return '';			
			}
			else
			{
				return $query->result();				
			}
	   
		}
		
		
		
		function insert_user($username,$firstname,$middlename,$lastname,$email,$password,$user_type)
		{
			 $str="%y-%m-%d %h:%i:%a";
			 $time=time();
			 $cdate=mdate($str,$time); 
			$data=array('user_name'=>$username,'first_name'=>$firstname,'middle_name'=>$middlename,'last_name'=>$lastname,'email'=>$email,'password'=>$password,'user_type_id'=>$user_type,'status'=>'Active','last_login'=>$cdate);
			$this->db->insert('user',$data); 
			return $this->db->insert_id();
		}
		function update_supplier($username,$firstname,$middlename,$lastname,$email,$user_type,$user_id)
		{
			$data=array('user_name'=>$username,'first_name'=>$firstname,'middle_name'=>$middlename,'last_name'=>$lastname,'email'=>$email,'user_type_id'=>$user_type);
			$this->db->where('user_id',$user_id);
			$this->db->update('user',$data);
		}
		function insert_profile($gender,$address,$mobile_no,$alternative_no,$country,$city,$postal_code,$nationality,$user_id)
		{
			$data=array('gender'=>$gender,'address'=>$address,'mobile_no'=>$mobile_no,'alternative_no'=>$alternative_no,'country'=>$country,'city'=>$city,'postal_code'=>$postal_code,'nationality'=>$nationality,'user_id'=>$user_id);
			$this->db->insert('user_profile',$data);
			return $this->db->insert_id();
		}
		function update_profile_supplier($gender,$address,$mobile_no,$alternative_no,$country,$city,$postal_code,$nationality,$user_id)
		{
			$data=array('gender'=>$gender,'address'=>$address,'mobile_no'=>$mobile_no,'alternative_no'=>$alternative_no,'country'=>$country,'city'=>$city,'postal_code'=>$postal_code,'nationality'=>$nationality);
			$this->db->where('user_id',$user_id);
			$this->db->update('user_profile',$data);
		}
		function hotel_details_merge($id)
		{
			$this->db->select('distinct(hotel_name)');
			$this->db->from('hotel_details');
			$this->db->where('created_by',$id);
			$query=$this->db->get();
			
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function get_city($city_code)
		{
			$this->db->select('name,countrycode');
			$this->db->from('booking_cities');
			$this->db->where('city_id',$city_code);
			$query=$this->db->get();
			
			if($query->num_rows() ==''){
				return '';
			}else{
				$val =  $query->row();
				$this->db->select('name');
				$this->db->from('countires');
				$this->db->where('countrycode',$val->countrycode);
				$query1=$this->db->get();
				if($query->num_rows() ==''){
				return '';
				}else{
					$val1 =  $query1->row();
				return $val->name.','.$val1->name;
				}
			}	
		}	
		function get_sup_emails()
		{
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',4);
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				  return $query->row();
			}	
		}
		function get_forgotpassword_emails()
		{
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',6);
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				  return $query->row();
			}
		}
		function get_users($id)
	{
		$this->db->select('*');
		$this->db->from('manage_users');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		if($query->num_rows() <= 0){
			return '';			
		}else{
			return $query->result();				
		}
	}
	function get_booking_details($id)
		{
			$query = $this->db->query("SELECT * FROM booking_ref sa inner join passenger_info sl on sa.booking_no = sl.booking_no WHERE  	booking_ref_no 	= '".$id."'");
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
			 
			}
		}
		function get_bokings_sup_status($id,$status)
		{
			$query = $this->db->query("SELECT * FROM booking_ref sa inner join passenger_info sl on sa.booking_no = sl.booking_no WHERE hotel_code= '".$id."' AND  status = '".$status."'");
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
			  return $query->result();
			 
			}
		}
		function get_bokings_sup_dates_status($id,$sdate,$edate,$status)
		{
			$query = $this->db->query("SELECT * FROM booking_ref sa inner join passenger_info sl on sa.booking_no = sl.booking_no WHERE hotel_code= '".$id."' AND voucher_date between '".$sdate."' AND '".$edate."' AND status = '".$status."'");
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
			  return $query->result();
			 
			}
		}
		function get_bokings_sup_dates($id,$sdate,$edate)
		{
			$query = $this->db->query("SELECT * FROM booking_ref sa inner join passenger_info sl on sa.booking_no = sl.booking_no WHERE hotel_code= '".$id."' AND voucher_date between '".$sdate."' AND '".$edate."'");
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
			  return $query->result();
			 
			}
		}
}
?>
