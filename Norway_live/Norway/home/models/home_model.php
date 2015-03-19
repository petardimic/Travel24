<?php 
class Home_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
		function insert_data($welcomepoint,$frststay,$bkgpnt,$earnpt,$usedpt,$balpt,$member)
  {
  
			  
			  $data=array('welcome_point'=>$welcomepoint,'first_stay'=>$frststay,'regular_booking'=>$bkgpnt,'total_point'=>$earnpt,'point_use'=>$usedpt,'bal_pnt'=>$balpt,'memid'=>$member);

		   $this->db->insert('member_reward_pont',$data);
		  // echo $this->db->last_query();
		 }
		 
	function insert_into_member_registration($fname,$lname,$country,$address,$number,$nationality,$email,$password,$MEMcode)
  {
  
			  $date=date('Y-m-d');
			  $data=array('first_name'=>$fname,'last_name'=>$lname,'country'=>$country,'address'=>$address,'number'=>$number,'nationality'=>$nationality,'email'=>$email,'password'=>$password,'MEMcode'=>$MEMcode,'join_date'=>$date);

		   $this->db->insert('member_registration',$data);
		  // echo $this->db->last_query();
		 }
		 
		 function insert_into_member_registration_new($title,$fname,$lname,$country,$city,$state,$address,$number,$email,
		 $password,$MEMcode,$request)
  {
  
			  
			  $data=array('title'=>$title,'first_name'=>$fname,'last_name'=>$lname,'country'=>$country,'city'=>$city,'state'=>$state,'address'=>$address,'number'=>$number,'email'=>$email,'password'=>$password,'MEMcode'=>$MEMcode,'request'=>$request);

		   $this->db->insert('member_registration',$data);
		  // echo $this->db->last_query();
		 }
		 
		 
		function insert_new_member_registration($fname,$lname,$email,$password,$city,$country,$number,$MEMcode,$address)
  {
  
             
			  
			  $data=array('first_name'=>$fname,'last_name'=>$lname,'country'=>$country,'number'=>$number,'email'=>$email,'password'=>$password,'MEMcode'=>$MEMcode,'address'=>$address);

		   $this->db->insert('member_registration',$data);
		
		 }
		 
		 	function insert_into_customer_support($name,$email,$phone,$subject,$message)
  {
  
			  
			  $data=array('name'=>$name,'email'=>$email,'phone'=>$phone,'subject'=>$subject,'message'=>$message);

		   $this->db->insert('customer_support',$data);
		  //echo $this->db->last_query(); exit;
		 }
		 
function check_email_exists($email)
{
	$que="select * from  member_registration where email ='$email'";
		
		$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 1;
			}else{
				return 0;
			}
}

function get_member($memid)
{
	$que="select * from   member_registration where MEMcode ='$memid'";
		
		$query= $this->db->query($que);
			return $query->row();
}

function hotel_cnt($city)
{
	
	$query = "select * from hotel_list where Destination='".$city."'";
              $query= $this->db->query($query);
			return $query->result();
}

 function check_member_login($username,$password)
    {
	
		$this->db->select('*');
		$this->db->from('member_registration');
	 $this->db->where('email',$username);
		$this->db->where('password',$password);
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
	function get_all_details($id)
	{
		$this->db->select('*');
		$this->db->from('member_registration');	   	 		
		$this->db->where('MEMcode',$id);
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
	function member_last_login($memberid)
		{
			
		$this->db->select('*');
		$this->db->from('member_registration');	   	 		
		$this->db->where('MEMcode',$memberid);
			
		$query=$this->db->get();

		//var_dump($query);
		
		if($query->num_rows() =='')
		{ 
			return '';
		}
		else
		{
		  return $query->row();
	  
		}
		
		}
		
		function update_member_registration($memberid,$fname,$lname,$country,$address,$number,$nationality)
		{
	$data=array('first_name'=>$fname,'last_name'=>$lname,'country'=>$country,'address'=>$address,'number'=>$number,'nationality'=>$nationality);
	 $this->db->where('MEMcode',$memberid);
  	$this->db->update('member_registration',$data);
	
	 }
	 
	 function update_data($welcomepoint,$frststay,$bkgpnt,$earnpt,$usedpt,$balpt,$member)
  {
  
			  
			  $data=array('welcome_point'=>$welcomepoint,'first_stay'=>$frststay,'regular_booking'=>$bkgpnt,'total_point'=>$earnpt,'point_use'=>$usedpt,'bal_pnt'=>$balpt);
 $this->db->where('memid',$member);
  	$this->db->update('member_reward_pont',$data);
		   
		  // echo $this->db->last_query();
		 }
		 
	 function member_registration_update($title,$fname,$lname,$country,$city,$state,$address,$number,$email,
		 $password,$memberid,$request)
		{
	$data=array('first_name'=>$fname,'last_name'=>$lname,'country'=>$country,'state'=>$state,'city'=>$city,'address'=>$address,'number'=>$number,'title'=>$title,'request'=>$request);
	 $this->db->where('MEMcode',$memberid);
  	$this->db->update('member_registration',$data);
	
	 }
	 
	 
	 function insert_into_review($about,$aboutyou,$rate1,$rate2,$rate3,$rate4,$rate5,$rate6,$memberid)
  {
  
			  
			  $data=array('MEMcode'=>$memberid,'about'=>$about,'desc'=>$aboutyou,'rate1'=>$rate1,'rate2'=>$rate2,'rate3'=>$rate3,'rate4'=>$rate4,'rate5'=>$rate5,'rate6'=>$rate6);

		   $this->db->insert('member_review',$data);
		  // echo $this->db->last_query();
		 }
		 
		  function insert_into_hotel_review($about,$aboutyou,$rate1,$rate2,$rate3,$rate4,$rate5,$rate6)
  {
  
			  $memberid='';
			  $data=array('MEMcode'=>$memberid,'about'=>$about,'desc'=>$aboutyou,'rate1'=>$rate1,'rate2'=>$rate2,'rate3'=>$rate3,'rate4'=>$rate4,'rate5'=>$rate5,'rate6'=>$rate6);

		   $this->db->insert('hotel_member_review',$data);
		  // echo $this->db->last_query();
		 }
		 function get_innohotel()
		 {
			 $query =$this->db->query("select * from search_result sr inner join search_result_rooms sh on sr.criteria_id = sh.criteria_id where sr.supplier_id = 'HOTSP1356466811' AND sh.single_rate != 0 ORDER BY search_result_id DESC");
			if($query->num_rows() == '' )
			{
			   $query1 =$this->db->query("select * from search_result sr inner join search_result_rooms sh on sr.criteria_id = sh.criteria_id where sr.supplier_id = 'HOTSP1356466811' AND sh.double_rate != 0 ORDER BY search_result_id DESC");
			   if($query1->num_rows() == '' )
			   {
				   return '';
			   }
			   else
			   {
				   return $query1->row(); 
			   }
			 }
			 else
			 {
				return $query->row(); 
			 }
		 }
		function get_Lakeshore()
		 {
			 $query =$this->db->query("select * from search_result sr inner join search_result_rooms sh on sr.criteria_id = sh.criteria_id where sr.supplier_id = 'HOTSP1356468078' AND sh.single_rate != 0 ORDER BY search_result_id DESC");
			if($query->num_rows() == '' )
			{
			   $query1 =$this->db->query("select * from search_result sr inner join search_result_rooms sh on sr.criteria_id = sh.criteria_id where sr.supplier_id = 'HOTSP1356468078' AND sh.double_rate != 0 ORDER BY search_result_id DESC");
			   if($query1->num_rows() == '' )
			   {
				   return '';
			   }
			   else
			   {
				   return $query1->row(); 
			   }
			 }
			 else
			 {
				return $query->row(); 
			 }
		 }
		 function get_Well_Park_Residence()
		 {
			 $query =$this->db->query("select * from search_result sr inner join search_result_rooms sh on sr.criteria_id = sh.criteria_id where sr.supplier_id = 'HOTSP1356468180' AND sh.single_rate != 0 ORDER BY search_result_id DESC");
			if($query->num_rows() == '' )
			{
			   $query1 =$this->db->query("select * from search_result sr inner join search_result_rooms sh on sr.criteria_id = sh.criteria_id where sr.supplier_id = 'HOTSP1356468180' AND sh.double_rate != 0 ORDER BY search_result_id DESC");
			   if($query1->num_rows() == '' )
			   {
				   return '';
			   }
			   else
			   {
				   return $query1->row(); 
			   }
			 }
			 else
			 {
				return $query->row(); 
			 }
		 }
		 function get_Radisson()
		 {
			 $query =$this->db->query("select * from search_result sr inner join search_result_rooms sh on sr.criteria_id = sh.criteria_id where sr.supplier_id = 'HOTSP1356467725' AND sh.single_rate != 0 ORDER BY search_result_id DESC");
			if($query->num_rows() == '' )
			{
			   $query1 =$this->db->query("select * from search_result sr inner join search_result_rooms sh on sr.criteria_id = sh.criteria_id where sr.supplier_id = 'HOTSP1356467725' AND sh.double_rate != 0 ORDER BY search_result_id DESC");
			   if($query1->num_rows() == '' )
			   {
				   return '';
			   }
			   else
			   {
				   return $query1->row(); 
			   }
			 }
			 else
			 {
				return $query->row(); 
			 }
		 }
		 
		 function get_all_reward_point($memid)
	{
		$this->db->select('*');
		$this->db->from('member_reward_pont');	   	 		
		$this->db->where('memid',$memid);
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
	function get_airport_code($airport_from)
		{
			$this->db->select('*');
			$this->db->from('flight_city_code');
			$this->db->where('airport_name',$airport_from);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';			
				}else{
					$res=$query->row();				
					return $res->airport_code;
				}
		}
		function get_unique_segments($idprop,$nbopt)
		{
			$query = $this->db->query("select * from segments where idprop='".$idprop."' AND codseg='D' AND nbopt = '".$nbopt."' ORDER BY segid");

			if($query->num_rows() =='')
			{ 
				return '';
			}
			else
			{
			 	return $query->result();
			}
		}
		function get_airport_code_name($airport_from)
		{
			$this->db->select('*');
			$this->db->from('flight_city_code');
			$this->db->where('airport_code',$airport_from);
			$query=$this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
				}else{
					$res=$query->row();				
					return $res->airport_city;
				}
		}
		function get_unique_segments_r($idprop,$nbopt)
		{
			$query = $this->db->query("select * from segments where idprop='".$idprop."' AND codseg='R' AND nbopt = '".$nbopt."' ORDER BY segid");

			if($query->num_rows() =='')
			{ 
				return '';
			}
			else
			{
			 	return $query->result();
			}
		}
		function get_countries_flight()
		{
			$this->db->select('*');
			$this->db->from('countires');
			$this->db->where('languagecode','en');
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				$val =   $query->result();
				return $val;
			}
		}
		function get_back_images()
		{
			$this->db->select('*');
			$this->db->from('back_images');
			$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				return $query->row();
			}
		}
		function get_flight_details1($seg_id,$f_priceid)
		{
			//echo $seg_id;
			//echo "<br />".$f_priceid; exit;
			$this->db->select('*');
			$this->db->from('segments');
			$this->db->where('segid',$seg_id);
			//$this->db->where('f_priceid',$f_priceid);
			$query=$this->db->get();
			//echo $this->db->last_query(); exit;
			//echo $query->num_rows();
			if($query->num_rows() ==''){
				return '';			
				}else{
				
					return $query->row();
				}
		}
		function get_flight_fare_anand($f_priceid)
		{
			$this->db->select('f_priceid');
			$this->db->from('segments');
			$this->db->where('segid',$f_priceid);
			//$this->db->where('f_priceid',$f_priceid);
			$query=$this->db->get();
			//echo $query->num_rows();
			if($query->num_rows() ==''){
				return '';			
				}else{
				
					$val = $query->row();
					return $val->f_priceid;
				}
		}
		function get_flight_fare($f_priceid)
		{
			$this->db->select('*');
			$this->db->from('flight_price_details');
			$this->db->where('pid',$f_priceid);
			//$this->db->where('f_priceid',$f_priceid);
			$query=$this->db->get();
			//echo $query->num_rows();
			if($query->num_rows() ==''){
				return '';			
				}else{
				
					return $query->result();
				}
		}
		function get_last_email($id)
		{
			$this->db->select('email');
			$this->db->from('user');
			$this->db->where('user_id',$id);
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
			  	$val =   $query->row();
			 	 return $val->email;		 
			}		
		}
		function check_hotels($result_id)
		{
			$this->db->select('*');
			$this->db->from('search_result');
			$this->db->where('result_id',$result_id);
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
		function delete_search_result($sec_id)	
		{	
			$date = date('Y-m-d');
			$this->db->where('criteria_id',$sec_id);	
			$this->db->delete('search_result');	
			
			//$this->db->where('date <>',$date);	
			//$this->db->delete('search_result');
			
			$this->db->where('criteria_id',$sec_id);	
			$this->db->delete('goglobal_hotel_det');	
			
			$this->db->where('criteria_id',$sec_id);	
			$this->db->delete('goglobal_hotel_picts');	
			
		}
		function get_countrycode($name)
		{
			$this->db->select('*');
			$this->db->from('hotelspro_cities');
			$this->db->where('City',$name);
			$query = $this->db->get();
			//echo $query->num_rows();exit;
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
			  	return $query->row();
		 
			}	
		}
		function get_cntryname($id)
		{
			$this->db->select('*');
			$this->db->from('hotelspro_cities');
			$this->db->where('hotelspro_cities_id',$id);
			$query = $this->db->get();
			//echo $query->num_rows();exit;
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
			  	return $query->row();
		 
			}	
		}
		
		function crs_availability($cin,$cout,$city,$adult_count,$days)
		{
			$query = $this->db->query("SELECT * FROM sup_apart_maintain_month sm inner join sup_apart_list sa on sa.sup_apart_list_id = sm.sup_apart_list_id inner join sup_apart_rateplan s1 on s1.sup_apart_rateplan_id = sm.sup_apart_rateplan_id AND date = '".$cin."' AND city = '".$city."' AND sm.capacity >='".$adult_count."' AND sm.available >=1 AND sm.status = 1");
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				return  $query->result();
			}
		}
		function get_individual_dates_avail($id,$night,$adult_count,$cin)
		{
			$rate = 0;
			//echo "SELECT * FROM sup_apart_maintain_month sm WHERE date = '".$cin."' AND sm.sup_apart_rateplan_id = '".$id."' AND  sm.capacity >='".$adult_count."' AND sm.available >=1";
			for($k=0; $k<$night;$k++)
			{
				$date =  date("Y-m-d", strtotime('+'.$k.' day', strtotime($cin)));
				$query = $this->db->query("SELECT * FROM sup_apart_maintain_month sm WHERE date = '".$date."' AND sm.sup_apart_rateplan_id = '".$id."' AND  sm.capacity >='".$adult_count."' AND sm.available >=1 AND sm.status = 1");
				if($query->num_rows() == 0)
				{
					return '';			
				}
				else
				{
					$val = $query->row();
					$rate = $rate + $val->rate;
				}
			}
			return $rate;
		}
		function get_class_type_id($id)
		{
			$query = $this->db->query("SELECT * FROM sup_apart_profile sa inner join sup_apartclass_type sl on sa.sup_apartclass_type_id = sl.sup_apartclass_type_id WHERE sup_apart_list_id = '".$id."'");
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';			
			}else{
			$res=$query->result();	
			//print_r($res);exit;
				$val =  $query->row();				
				return $val->sup_apartclass_type_id;
			}
		}
		function get_status($id)
		{
			$query = $this->db->query("select status from sup_apart_maintain_month where sup_apart_maintain_month_id = ".$id."");
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();
				return $val->status;
			}
		}
		function get_images($id)
		{
		//echo "select image_name,added_by from sup_apart_pictures where sup_apart_list_id = ".$id." AND status = 1 order by sup_apart_pictures_id LIMIT 0,1";exit;
			$query = $this->db->query("select image_name,added_by from sup_apart_pictures where sup_apart_list_id = ".$id." AND status = 1 order by sup_apart_pictures_id LIMIT 0,1");
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();
				return $val;
			}
		}
		function get_common_markup($id)
	{
		$this->db->select('commision_id');
		$this->db->from('user');
		$this->db->where('user_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$val =  $query->row();
			return $val->commision_id;
		}
	}
	function get_comm_val($id)
	{
		$this->db->select('*');
		$this->db->from('commision');
		$this->db->where('commision_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			return  $query->row();
		}
	}
	function get_least_cost($id)
	{
		$this->db->select('min(rate) as rate');
		$this->db->from('sup_apart_maintain_month');
		$this->db->where('sup_apart_list_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$val =   $query->row();
			return $val->rate;
		}
	}
	function get_starrate($id)
	{
		$this->db->select('star');
		$this->db->from('sup_apart_profile');
		$this->db->where('sup_apart_list_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$val =   $query->row();
			return $val->star;
		}
	}
	function get_address($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_profile');
		$this->db->where('sup_apart_list_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			return $query->row();
		
		}
	}
	function get_allcur()
	{
		$this->db->select('*');
		$this->db->from('currency_converter');
		$query=$this->db->get();
		if($query->num_rows() =='')
			{ return '';
			}
			else{
			  return $query->result();
			
			}	
	}
	function get_taxes($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_taxes');
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			return  $query->row();
		}
	}
	function get_cur($id)
		{
			$query = $this->db->query("SELECT currency FROM currency_converter c inner join sup_apart_profile s on s.currency_id = c.currency_id  WHERE s.sup_apart_list_id = '".$id."'");
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$res = $query->row();	
				return $res->currency;	
			}
		}
		function get_def_val($cur)
		{
			$this->db->select('currency_value');
			$this->db->from('currency_converter');
			$this->db->where('currency',$cur);
			$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$res = $query->row();	
				return $res->currency_value;	
			}
		}
		function can($id)
		{
			$this->db->select('*');
			$this->db->from('sup_apart_rateplan');
			$this->db->where('sup_apart_rateplan_id',$id);
			$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				return  $query->row();
			}
		}
		function get_apt_fac($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_facilities');
		$this->db->where('sup_apart_list_id',$id);
		$this->db->where('sup_apart_list_id',$id);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			return  $query->result();
		}
	}
	function get_cat($id)
	{
		$this->db->select('sup_apart_category_id');
		$this->db->from('sup_apart_rateplan');
		$this->db->where('sup_apart_rateplan_id',$id);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$val =  $query->row();
			return $val->sup_apart_category_id;
		}
	}
	function get_cat_desc($id)
	{
		$query=$this->db->query("SELECT * FROM sup_apart_rateplan sr inner join sup_apart_category sc on sc.sup_apart_category_id  = sr.sup_apart_category_id  WHERE sr.sup_apart_rateplan_id = '".$id."'");
		if($query->num_rows() ==''){
				return '';			
			}else{
			$res=$query->row();	
			//print_r($res);exit;
				return $res->desc;				
			}
	}
	function get_rate_plan($id)
	{
		$this->db->select('rate_name');
		$this->db->from('sup_apart_rateplan');
		$this->db->where('sup_apart_rateplan_id',$id);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$val =  $query->row();
			return $val->rate_name;
		}
	}
	function get_unit_name($id)
	{
		$this->db->select('category_name');
		$this->db->from('sup_apart_category');
		$this->db->where('sup_apart_category_id',$id);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$val =  $query->row();
			return $val->category_name;
		}
	}
	function get_roomfac($id,$apt_id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_roomfacilities');
		$this->db->where('sup_apart_category_id',$id);
		$this->db->where('sup_apart_list_id',$apt_id);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			return  $query->result();
		}
	}
	function insert_search_result_crs($api,$city,$cntry_name,$sup_apart_list_id,$itemVal,$star_rate,$pernight11,$tot_cost_val,$unit_name,$rate_plan,$breakfast,$adult_count,$address,$sec_res,$cin,$cout,$image,$night,$fac1,$roomfac1,$latitude,$longitude,$common_commission_id,$cat_num,$status,$comm,$capacity,$currency,$can_cost,$charge_nights,$can_time,$district_id,$class_type)
	{
		//echo $tot_cost_val;exit;
		$date = date('Y-m-d');
		$data = array('api_name'=>$api,'city_name'=>$city,'country_name'=>$cntry_name,'hotel_id'=>$sup_apart_list_id,'hotel_name'=>$itemVal,'star_rate'=>$star_rate,'nightperroom'=>$tot_cost_val,'cost_value'=>$tot_cost_val,'room_type'=>$unit_name,'plan_type'=>$rate_plan,'nopax'=>$adult_count,'location'=>$address,'criteria_id'=>$sec_res,'commission'=>$common_commission_id,'cin'=>$cin,'cout'=>$cout,'image_url'=>$image,'noofdays'=>$night,'amenities'=>$fac1,'room_amenities'=>$roomfac1,'latitude'=>$latitude,'longitude'=>$longitude,'room_catecode'=>$cat_num,'status'=>$status,'commission'=>$comm,'capacity'=>$capacity,'cost_type'=>$currency,'cancellation_night'=>$charge_nights,'cancellation_value'=>$can_cost,'cancellation_before_days'=>$can_time,'inclusion'=>$breakfast,'district_id'=>$district_id,'room_usecode'=>$class_type,'min_price'=>$tot_cost_val,'max_price'=>$tot_cost_val,'date'=>$date);
		$this->db->insert('search_result',$data);
		//$data1 = array('sec_res'=>$sec_res,'hotel_id'=>$sup_apart_list_id);
		//$this->db->insert('booking_roomsearch',$data1);
	}
	function holiday_search_dom($type, $city, $checkin, $checkout)
		{
			$query = $this->db->query("select * from activities where ex_location LIKE '%$city%' ");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				return  $query->result();
			}	
		}
		function modify_holiday_search($holiday_type, $holiday_theme)
		{
			$query = $this->db->query("select * from activities where ex_type LIKE '$holiday_type%' AND holiday_theme = '$holiday_theme' ");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				return  $query->result();
			}	
		}
		function modify_holiday_search_all($holiday_type)
		{
			$query = $this->db->query("select * from activities where ex_type LIKE '$holiday_type%' ");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				return  $query->result();
			}	
		}
		function get_offer_holiday()
		{
			$query = $this->db->query("select * from activities WHERE holiday_theme != 'Romantic' AND holiday_theme != 'Honeymoon' AND ex_type='int' order by excursion_id desc limit 0,1 ");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				return  $query->row();
			}	
		}
		function getholiday_count($theme)
		{
			$ex_type = $this->session->userdata('holiday_type');
			$query = $this->db->query("select holiday_theme from activities Where holiday_theme ='$theme' AND ex_type = '$ex_type'");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '0';
			}
			else
			{
				return $query->num_rows();
			}	
		}
		function holiday_cities()
		{
			$holiday_type = $this->session->userdata('holiday_type');
			$query = $this->db->query("select DISTINCT ex_location from activities Where ex_type = '$holiday_type'");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				return  $query->result();
			}	
		}
		function holiday_count()
		{
			$ex_type = $this->session->userdata('holiday_type');
			$query = $this->db->query("select * from activities");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '0';
			}
			else
			{
				return $query->num_rows();
			}	
		}
		
		function holiday_themes()
		{
			$query = $this->db->query("select DISTINCT item from holiday_themes");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				return  $query->result();
			}	
		}
		function get_holidaycitycount($city)
		{
			$ex_type = $this->session->userdata('holiday_type');
			$query = $this->db->query("select * from activities Where ex_location ='$city' AND ex_type = '$ex_type'");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '0';
			}
			else
			{
				return $query->num_rows();
			}	
		}
		function holiday_confirm_price($ex_id)
		{
			$query = $this->db->query("select * from activities where excursion_id = '".$ex_id."' ");
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				return  $query->row();
			}	
		}
		function get_packages()
		{
			$this->db->select('*');
			$this->db->from('activities');
			$this->db->where('ex_price !=','');
			$this->db->order_by('excursion_id','desc');
			$this->db->limit('3');
			$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				return $query->result();
			}
		}
		function getholiday_hotels($ex_id)
		{
			$this->db->select('*');
			$this->db->from('holiday_hotel');
			$this->db->where('ex_id',$ex_id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->result();
			}
		}
		function get_hotel_star($hotelcode)
		{
			$this->db->select('StarRating');
			$this->db->from('hotel_list');
			$this->db->where('HotelCode',$hotelcode);
			$query=$this->db->get();
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{
					  $res = $query->row();
					  return $res->StarRating;
				}
		}
		function get_dest($ex_id)
		{
			$this->db->select('*');
			$this->db->from('holiday_destination');
			$this->db->where('ex_id',$ex_id);
			$query=$this->db->get();
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{
					  return $query->result();
				}
		}
		function get_all($sec_res,$start,$per_page,$sort_asc_data,$sort_asc_type)
		{
			if($sort_asc_data != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type  LIMIT $start,$per_page");
			}
			else
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  GROUP BY hotel_id  ORDER BY `nightperroom` asc LIMIT $start,$per_page");
			}
			//ORDER BY `nightperroom` ASC
			//echo $this->db->last_query();exit;
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function hotel_location_results($sec_res,$start,$per_page,$location)
		{
			$loc1 = '';
			if(strstr($location,","))
			{
				$location = explode(',',$location);
				foreach($location as $loc)
				{
					if($loc != '')
					{
						$loc1 .=  "'".$loc."',";
					}
				}
				$loc1 = substr($loc1,0,-1);
			}
			else
			{
				$loc1 = $location;
			}
			$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `location` IN ($loc1)  GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start, $per_page");
			//echo $this->db->last_query();exit;
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function hotel_board_results($sec_res,$start,$per_page,$board)
		{
			$bord1 = '';
			if(strstr($board,","))
			{
				$board = explode(',',$board);
				foreach($board as $bord)
				{
					if($bord != '')
					{
						$bord1 .=  "'".$bord."',";
					}
				}
				$bord1 = substr($bord1,0,-1);
			}
			else
			{
				$bord1 = $board;
			}
			$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` IN ($bord1)  GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start, $per_page");
			//echo $this->db->last_query();exit;
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function get_all_sort($sec_res,$start,$per_page,$star,$hotel,$loc_a,$bord_type_a,$hotel,$sort_asc_data,$sort_asc_type)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				$loc_a1 = explode('@',$loc_a);
				foreach($loc_a1 as $l)
				{
					if($l != '')
					{
						$loc_new .= "'".$l."',";
					}
				}
				$loc_new = substr($loc_new,0,-1);				
			}
			else
			{
				$loc_new = '';
			}
			if($bord_type_a != '')
			{
				$bord_type_new = '';
				$bord_type_a1 = explode(',',$bord_type_a);
				foreach($bord_type_a1 as $l)
				{
					if($l != '')
					{
						$bord_type_new .= "'".trim($l)."',";
					}
				}
				$bord_type_new = substr($bord_type_new,0,-1);				
			}
			else
			{
				$bord_type_new = '';
			}
			if($loc_new != '' && $star != '' && $bord_type_new != '' && $hotel != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `hotel_name` LIKE '%$hotel%' AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `hotel_name` LIKE '%$hotel%' AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
				
			}
			else if($loc_new != '' && $star != '' && $bord_type_new != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");	
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");	
				}
			}
			else if($loc_new != '' && $star != '' && $hotel != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `hotel_name` LIKE '%$hotel%' GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `hotel_name` LIKE '%$hotel%' GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			
			else if($loc_new != '' && $hotel != '' && $bord_type_new != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `location` NOT IN  ($loc_new) AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `location` NOT IN  ($loc_new) AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			else if($hotel != '' && $star != '' && $bord_type_new != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `hotel_name` LIKE '%$hotel%' AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `hotel_name` LIKE '%$hotel%' AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			/*else if($loc_new != '' && $star != '' && $bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id LIMIT $start,$per_page");
			}*/
			else if($loc_new != '' && $star != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `star_rate` IN ($star) AND `location` NOT IN ($loc_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `star_rate` IN ($star) AND `location` NOT IN ($loc_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
				
			}
			else if($loc_new != '' && $bord_type_new != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` NOT IN ($bord_type_new)  AND `location` NOT IN ($loc_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` NOT IN ($bord_type_new)  AND `location` NOT IN ($loc_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
				
			}
			else if($star != '' && $bord_type_new != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` NOT IN ($bord_type_new)  AND star_rate IN ($star) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` NOT IN ($bord_type_new)  AND star_rate IN ($star) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			else if($hotel != '' && $star != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `star_rate` IN ($star) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `star_rate` IN ($star) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			else if($hotel != '' && $loc_new != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `location` NOT IN ($loc_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `location` NOT IN ($loc_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			else if($hotel != '' && $bord_type_new != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			
			
		/*	
			else if($loc_new != '' && $star != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) GROUP BY hotel_id LIMIT $start,$per_page");
			}
			else if($loc_new != '' && $bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND `plan_type` NOT IN ($bord_type_new)  AND `location` NOT IN ($loc_new) GROUP BY hotel_id LIMIT $start,$per_page");
			}
			else if($star != '' && $bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND `plan_type` NOT IN ($bord_type_new)  AND star_rate IN ($star) GROUP BY hotel_id LIMIT $start,$per_page");
			}*/
			else if($star != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND star_rate IN ($star) AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND star_rate IN ($star) AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			else if($loc_new != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `location` NOT IN  ($loc_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `location` NOT IN  ($loc_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			else if($hotel != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			else if($bord_type_new != '')
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			else
			{
				if($sort_asc_data != '')
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') GROUP BY hotel_id ORDER BY $sort_asc_data $sort_asc_type LIMIT $start,$per_page");
				}
				else
				{
					$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') GROUP BY hotel_id ORDER BY `nightperroom` ASC LIMIT $start,$per_page");
				}
			}
			//echo $this->db->last_query();exit;
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{
					 return $query->result();
				}
		}
		function get_all_count($sec_res)
		{
			//echo "SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  GROUP BY hotel_id LIMIT $start, $per_page";
			$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  GROUP BY hotel_id ORDER BY `nightperroom` ASC");
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function get_all_count_sort($sec_res,$start,$per_page,$star,$hotel,$loc_a,$bord_type_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				$loc_a1 = explode('@',$loc_a);
				foreach($loc_a1 as $l)
				{
					$loc_new .= "'".$l."',";
				}
				$loc_new = substr($loc_new,0,-1);				
			}
			else
			{
				$loc_new = '';
			}
			if($bord_type_a != '')
			{
				$bord_type_new = '';
				$bord_type_a1 = explode(',',$bord_type_a);
				foreach($bord_type_a1 as $l)
				{
					$bord_type_new .= "'".trim($l)."',";
				}
				$bord_type_new = substr($bord_type_new,0,-1);				
			}
			else
			{
				$bord_type_new = '';
			}
			if($loc_new != '' && $star != '' && $bord_type_new != '' && $hotel != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `hotel_name` LIKE '%$hotel%' AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id");
			}
			else if($loc_new != '' && $star != '' && $bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id");
			}
			else if($loc_new != '' && $star != '' && $hotel != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `location` NOT IN  ($loc_new) AND `hotel_name` LIKE '%$hotel%' GROUP BY hotel_id");
			}
			
			else if($loc_new != '' && $hotel != '' && $bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `location` NOT IN  ($loc_new) AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id");
			}
			else if($hotel != '' && $star != '' && $bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND star_rate IN ($star) AND `hotel_name` LIKE '%$hotel%' AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id");
			}
			
			
			
			else if($loc_new != '' && $star != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `star_rate` IN ($star) AND `location` NOT IN ($loc_new) GROUP BY hotel_id");
			}
			else if($loc_new != '' && $bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` NOT IN ($bord_type_new)  AND `location` NOT IN ($loc_new) GROUP BY hotel_id");
			}
			else if($star != '' && $bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` NOT IN ($bord_type_new)  AND star_rate IN ($star) GROUP BY hotel_id");
			}
			else if($hotel != '' && $star != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `star_rate` IN ($star) GROUP BY hotel_id");
			}
			else if($hotel != '' && $loc_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `location` NOT IN ($loc_new) GROUP BY hotel_id");
			}
			else if($hotel != '' && $bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id");
			}
			
			
			
			
			else if($star != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `star_rate` IN ($star) GROUP BY hotel_id");
			}
			else if($loc_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `location` NOT IN ($loc_new) GROUP BY hotel_id");
			}
			else if($bord_type_new != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `plan_type` NOT IN ($bord_type_new) GROUP BY hotel_id");
			}
			else if($hotel != '')
			{
				$query = $this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND `hotel_name` LIKE '%$hotel%' GROUP BY hotel_id");
			}
			
			
			
			//echo $this->db->last_query();exit;
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->result();
			}
		}
		function results_5star()
		{
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='5' GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_4star()
		{
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='4' GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_3star()
		{
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='3' GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_2star()
		{
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='2' GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_1star()
		{
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='1' GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_0star()
		{
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='' GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		
		
		
		
		function results_5star_loc($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				$loc_a1 = explode('@',$loc_a);
				foreach($loc_a1 as $l)
				{
					$loc_new .= "'".$l."',";
				}
				$loc_new = substr($loc_new,0,-1);				
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='5'AND `location` NOT IN  ($loc_new)  GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_4star_loc($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				$loc_a1 = explode('@',$loc_a);
				foreach($loc_a1 as $l)
				{
					$loc_new .= "'".$l."',";
				}
				$loc_new = substr($loc_new,0,-1);				
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='4' AND `location` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_3star_loc($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				$loc_a1 = explode('@',$loc_a);
				foreach($loc_a1 as $l)
				{
					$loc_new .= "'".$l."',";
				}
				$loc_new = substr($loc_new,0,-1);				
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='3' AND `location` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_2star_loc($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				$loc_a1 = explode('@',$loc_a);
				foreach($loc_a1 as $l)
				{
					$loc_new .= "'".$l."',";
				}
				$loc_new = substr($loc_new,0,-1);				
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='2' AND `location` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_1star_loc($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				$loc_a1 = explode('@',$loc_a);
				foreach($loc_a1 as $l)
				{
					$loc_new .= "'".$l."',";
				}
				$loc_new = substr($loc_new,0,-1);				
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='1' AND `location` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_0star_loc($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				$loc_a1 = explode('@',$loc_a);
				foreach($loc_a1 as $l)
				{
					$loc_new .= "'".$l."',";
				}
				$loc_new = substr($loc_new,0,-1);				
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='' AND `location` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		
		
		
		
		
		function results_5star_plan($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				if(strstr($loc_a,','))
				{
					$loc_a1 = explode(',',$loc_a);
					foreach($loc_a1 as $l)
					{
						if($l != '')
						{
							$loc_new .= "'".$l."',";
						}
					}
					$loc_new = substr($loc_new,0,-1);				
				}
				else
				{
					$loc_new = "'".$loc_a."'";
				}
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='5' AND plan_type NOT IN ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_4star_plan($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				if(strstr($loc_a,','))
				{
					$loc_a1 = explode(',',$loc_a);
					foreach($loc_a1 as $l)
					{
						if($l != '')
						{
							$loc_new .= "'".$l."',";
						}
					}
					$loc_new = substr($loc_new,0,-1);				
				}
				else
				{
					$loc_new = "'".$loc_a."'";
				}
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='4' AND `plan_type` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_3star_plan($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				if(strstr($loc_a,','))
				{
					$loc_a1 = explode(',',$loc_a);
					foreach($loc_a1 as $l)
					{
						if($l != '')
						{
							$loc_new .= "'".$l."',";
						}
					}
					$loc_new = substr($loc_new,0,-1);				
				}
				else
				{
					$loc_new = "'".$loc_a."'";
				}
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='3' AND `plan_type` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_2star_plan($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				if(strstr($loc_a,','))
				{
					$loc_a1 = explode(',',$loc_a);
					foreach($loc_a1 as $l)
					{
						if($l != '')
						{
							$loc_new .= "'".$l."',";
						}
					}
					$loc_new = substr($loc_new,0,-1);				
				}
				else
				{
					$loc_new = "'".$loc_a."'";
				}
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='2' AND `plan_type` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_1star_plan($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				if(strstr($loc_a,','))
				{
					$loc_a1 = explode(',',$loc_a);
					foreach($loc_a1 as $l)
					{
						if($l != '')
						{
							$loc_new .= "'".$l."',";
						}
					}
					$loc_new = substr($loc_new,0,-1);				
				}
				else
				{
					$loc_new = "'".$loc_a."'";
				}
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='1' AND `plan_type` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		function results_0star_plan($loc_a)
		{
			if($loc_a != '')
			{
				$loc_new = '';
				if(strstr($loc_a,','))
				{
					$loc_a1 = explode(',',$loc_a);
					foreach($loc_a1 as $l)
					{
						if($l != '')
						{
							$loc_new .= "'".$l."',";
						}
					}
					$loc_new = substr($loc_new,0,-1);				
				}
				else
				{
					$loc_new = "'".$loc_a."'";
				}
			}
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation')  AND `star_rate` ='' AND `plan_type` NOT IN  ($loc_new) GROUP BY hotel_id");
		if($query->num_rows() =='')
				{
					return 0;
				}
				else
				{//echo 'asdfasf';
					 return $query->result();
					//  return $ct;
				}
		}
		
		
		
		
		
		function get_global_citycode($city)
		{
			$this->db->select('cityID');
			$this->db->from('go_global_city');
			$this->db->where('city',$city);
			$query=$this->db->get();
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{
					  $ct = $query->row();
					  return $ct->cityID;
				}
		}
		function get_hp_citycode($city)
		{
			$this->db->select('DestinationId');
			$this->db->from('hotelspro_cities');
			$this->db->where('City',$city);
			$query=$this->db->get();
			//echo $this->db->last_query(); exit;
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{
					  $ct = $query->row();
					  return $ct->DestinationId;
				}
		}
		function get_pro_pre_detail_hotelspro1($hcode)
		{
			$que = "SELECT * FROM (`search_result`) WHERE `result_id` = '$hcode' 
			";
			//charval
			$query= $this->db->query($que);
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		function insert_gta_temp_result($sec_res,$api,$itemCode,$room_code,$room_type,$cost_val,$status_val,$meals_val,$adult,$child,$star)
		{
				
				$cost_val = $cost_val;
				$date = date('Y-m-d');
				$cin = $this->session->userdata('start_date');
				$cout = $this->session->userdata('end_date');
				$location = $this->session->userdata('disp_city'); 
				//,'plan_type'=>$meals_val
				$data=array('criteria_id'=>$sec_res,'date'=>$date,'api_name'=>$api,'hotel_id'=>$itemCode,'room_catecode'=>$room_code,'room_type'=>$room_type,'inclusion'=>$meals_val,'nightperroom'=>$cost_val,'cost_value'=>$cost_val,'status'=>$status_val,'adult'=>$adult,'child'=>$child,'cost_type'=>'USD','cin'=>$cin,'cout'=>$cout,'location'=>$location,'star_rate'=>$star);
				//echo '<pre>'; print_r($data);exit; 
				$this->db->insert('search_result',$data);
				//echo $this->db->last_query();
			   return $this->db->insert_id();
			
		}
		function get_pro_pre_detail_hotelspro($hcode)
		{
			//echo $hcode; exit;
			$que = "SELECT * FROM (`search_result`) WHERE `result_id` = '$hcode' 
			";
			//charval
			$query= $this->db->query($que);
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		function gethb_hotelimage_new_pro($hotelCode)
		{
		//$val="GEN";
			$query = $this->db->query("SELECT * FROM  hotel_list WHERE 	HotelCode='$hotelCode'");
			if($query->num_rows =='')
			{
				return '';
			}else{
				return $query->row();
			}
		}
		function delete_already_hotels($ses_id,$id)
		{
			$this->db->query("DELETE FROM search_result where criteria_id = '".$ses_id."' AND hotel_id='".$id."'");
			//echo $this->db->last_query();exit;
		}
		function get_markup()
		{
			$query = $this->db->query("SELECT * FROM  markup");
			if($query->num_rows =='')
			{
				return '';
			}else{
				return $query->row();
			}
		}
		function insert_global_hotels($api_name,$sec_res,$city_code,$HotelSearchCode,$HotelCode,$HotelName,$CountryId,$CxlDeadline,$RoomType,$RoomBasis,$Availability,$TotalPrice,$Currency,$Category,$Location,$LocationCode,$Preferred,$Remark,$Thumbnail,$Rating,$RatingImage,$ReviewCount,$Reviews)
		{
			$api_name = 'goglobal';
			if($Availability == '1')
			{
				$Availability = 'Available';
			}
			else
			{
				$Availability = 'Not Available';
			}
			$days = $this->session->userdata('dt');
			$date = date('Y-m-d');
			$data = array('api_name'=>$api_name,'date'=>$date,'criteria_id'=>$sec_res,'city_name'=>$city_code,'HotelSearchCode'=>$HotelSearchCode,'hotel_id'=>$HotelCode,'hotel_name'=>mysql_real_escape_string($HotelName),'country_name'=>$CountryId,'cancellation_date'=>$CxlDeadline,'room_type'=>mysql_real_escape_string($RoomType),'plan_type'=>$RoomBasis,'status'=>$Availability,'nightperroom'=>$TotalPrice,'cost_type'=>$Currency,'star_rate'=>$Category,'location'=>mysql_real_escape_string($Location),'LocationCode'=>$LocationCode,'preferred'=>$Preferred,'description'=>mysql_real_escape_string($Remark),'image_url'=>mysql_real_escape_string($Thumbnail),'image'=>mysql_real_escape_string($Thumbnail),'Rating'=>$Rating,'RatingImage'=>$RatingImage,'ReviewCount'=>$ReviewCount,'Reviews'=>mysql_real_escape_string($Reviews),'cost_value'=>$TotalPrice,'noofdays'=>$days); 
			$this->db->insert('search_result',$data); 
		}
		function insert_hotel_det($hid,$sec_res,$HotelSearchCode,$HotelName,$Address,$CityCode,$Phone,$Fax,$Category,$Description,$HotelFacilities,$RoomFacilities,$RoomCount,$Longitude,$Latitude)
		{
			$data = array('hotel_id'=>$hid,'criteria_id'=>$sec_res,'HotelSearchCode'=>$HotelSearchCode,'HotelName'=>$HotelName,'Address'=>$Address,'CityCode'=>$CityCode,'Phone'=>$Phone,'Fax'=>$Fax,'Category'=>$Category,'Description'=>$Description,'HotelFacilities'=>$HotelFacilities,'RoomFacilities'=>$RoomFacilities,'RoomCount'=>$RoomCount,'Longitude'=>$Longitude,'Latitude'=>$Latitude);
			$this->db->insert('goglobal_hotel_det',$data);
			return $this->db->insert_id();
		}
		function insert_hotel_pictures($id,$sec_res,$hid,$picts)
		{
			$data = array('id'=>$id,'criteria_id'=>$sec_res,'hotel_id'=>$hid,'picts'=>$picts);
			$this->db->insert('goglobal_hotel_picts',$data);
		}
		function delete_hotel_det($sec_res,$hid)
		{
			$this->db->where('criteria_id',$sec_res);	
			$this->db->where('hotel_id',$hid);	
			$this->db->delete('goglobal_hotel_det');	
			
			$this->db->where('criteria_id',$sec_res);	
			$this->db->where('hotel_id',$hid);	
			$this->db->delete('goglobal_hotel_picts');	
		}
		function get_hotel_det($HotelSearchCode,$hid)
		{
			$this->db->select('*');
			$this->db->from('goglobal_hotel_det');
			$this->db->where('HotelSearchCode',$HotelSearchCode);
			$this->db->where('hotel_id',$hid);
			$query=$this->db->get();
			//echo $this->db->last_query(); exit;
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{
					  return $query->row();
				}
		}
		function get_cancel_attrib_new($result_id)
		{
			//echo $result_id;exit;
			$this->db->select('*');
			$this->db->from('search_result');
			$this->db->where('result_id',$result_id);
			
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();

			}
		}
		function get_searchresult($id)
		{
			$this->db->select('*');
			$this->db->from('search_result');
			$this->db->where('result_id',$id);
			$this->db->join('hotel_list', 'search_result.hotel_id = hotel_list.HotelCode');
			//$this->db->join('hotel_desc', 'search_result.hotel_id = hotel_desc.HotelCode');
			$query = $this->db->get();	
			
			if($query->num_rows() == 0 )
			{
			   return '';   
			  }else{
			  return $query->row(); 
			  }
			
		}
		function contact_info_detail_update($tran_id)
		{
			$this->db->select('*');
			$this->db->from('customer_contact_details');
			$this->db->where('customer_contact_details_id',$tran_id);
			$query = $this->db->get();	
			return $query->row();
		}
		function pass_info_detail($tran_id)
		{
			$que="select * from  customer_info_details WHERE customer_info_details_id = ".$tran_id." or parent_id = ".$tran_id."";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
					return '';
			}else{
				return $query->result();
			}
	
		}
		function inser_customer_book_hotelpro($h_hotel_id,$h_hotel_name,$h_star,$h_description,$h_address,$h_phone,$h_fax,$h_room_type,$h_cancel_policy,$cin,$cout,$date,$roomcountss,$user_id,$nights,$trans_id,$h_adult,$h_child,$con_id,$dateFromValc,$h_city,$api,$ProcessId,$agent_id,$policies)
				{
					//echo $dateFromValc; exit;
					//echo "<pre>"; print_r($policies); exit;
				$h_adult= $this->session->userdata('adult_count');
				$h_child= $this->session->userdata('child_count');
				$policy1 = $policies[0]->remarks;
				$policy2 = $policies[1]->remarks;
				$day_before_check = $policies[0]->cancellationDay;
				$feeType = $policies[0]->feeType;
				$feeAmount = $policies[0]->feeAmount;
				//$policy = $policy1;
				$policy = 'Cancellation penalty for cancellation made within '.$day_before_check.' days of the '.$this->session->userdata('sd').'
						 is 1 night room rate.<br>Cancellations made within '.$day_before_check.' days of the '.$this->session->userdata('sd').' (after the deadline)  will be assessed a cancellation penalty.
						 ';
				
			$data=array('customer_contact_details_id'=>$con_id,'hotel_code'=>$h_hotel_id,'hotel_name'=>$h_hotel_name,'star'=>$h_star,
						'description'=>$h_description,'address'=>$h_address,'phone'=>$h_phone,'fax'=>$h_fax,'room_type'=>$h_room_type,'cancel_policy'=>$h_cancel_policy,'check_in'=>$cin,'check_out'=>$cout,'voucher_date'=>$date,'no_of_room'=>$roomcountss,'provider_id'=>'1','nights'=>$nights,'adult'=>$h_adult,'child'=>$h_child,'cancel_tilldate'=>$dateFromValc,'city'=>$h_city,'api'=>$api,'item_code'=>$ProcessId,'trans_id'=>$trans_id,'cancel_policy'=>$policy);
						$this->db->insert('hotel_booking_info',$data);
						return $this->db->insert_id();
				
			 }
                         function insert_payment_detail($val_last,$locale,$batchNo,$command,$message,$version,$cardType,$orderInfo,$receiptNo,$merchantID,$authorizeID,$merchTxnRef,$transactionNo,$acqResponseCode,$txnResponseCode)
                         {
                             $data = array('book_id'=>$val_last,'locale'=>$locale,'batchNo'=>$batchNo,'command'=>$command,'message'=>$message,'version'=>$version,'cardType'=>$cardType,'orderInfo'=>$orderInfo,'receiptNo'=>$receiptNo,'merchantID'=>$merchantID,'authorizeID'=>$authorizeID,'merchTxnRef'=>$merchTxnRef,'transactionNo'=>$transactionNo,'acqResponseCode'=>$acqResponseCode,'txnResponseCode'=>$txnResponseCode);
                             $this->db->insert('payment_details',$data);
                             
                         }
                         function payment_details($id)
                         {
                            $que="select * from  payment_details WHERE book_id = ".$id."";
                            $query= $this->db->query($que);
                            if($query->num_rows() ==''){
                            		return '';
                            }else{
                            	return $query->row();
                            } 
                         }
			 function getconfirmation($id)
			 {
				$que="select * from  transaction_details WHERE hotel_booking_id = ".$id."";
				$query= $this->db->query($que);
				if($query->num_rows() ==''){
						return '';
				}else{
					return $query->row();
				}
			 }
			 function inser_customer_book_hotelpro_trans_hotel($trans_id,$ConfirmationNumbervalue,$userid,$val_last,$BookingStatusvalue)
			{
		
				$this->db->query("UPDATE transaction_details SET prn_no='$ConfirmationNumbervalue', 	booking_number='$ConfirmationNumbervalue',  user_id='$userid' , hotel_booking_id='$val_last', status='$BookingStatusvalue'  WHERE customer_contact_details_id ='$trans_id'");
				
				
			}
		function get_hotel_dethp($hid)
		{
			$this->db->select('*');
			$this->db->from('hotel_list');
			$this->db->where('HotelCode',$hid);
			$query=$this->db->get();
			//echo $this->db->last_query(); exit;
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{
					  return $query->row();
				}
		}
		function get_hotel_desc($hid)
		{
			$this->db->select('*');
			$this->db->from('hotel_desc');
			$this->db->where('HotelCode',$hid);
			$query=$this->db->get();
			//echo $this->db->last_query(); exit;
			if($query->num_rows() =='')
				{
					return '';
				}
				else
				{
					  return $query->row();
				}
		}
		function hotel_images($hid)
		{
			$this->db->select('*');
			$this->db->from('goglobal_hotel_picts');
			$this->db->where('hotel_id',$hid);
			$this->db->group_by('picts');
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
			    return $query->result();
			}
		}
		function get_hotel_facilities($hotelcode)
		{
			$this->db->select('*');
			$this->db->from('hotel_amenties');
			$this->db->where('HotelCode',$hotelcode);
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
		function get_rooms($hid,$sec_id)
		{
			//echo $sec_id; exit;
			$this->db->select('*');
			$this->db->from('search_result');
			$this->db->where('hotel_id',$hid);
			$this->db->where('criteria_id',$sec_id);
			$this->db->order_by('nightperroom','asc');
			//$this->db->group_by('room_type');
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
			    return $query->result();
			}
		}
		function get_rooms_lowest($hid,$sec_id)
		{
			//echo $sec_id; exit;
			$this->db->select('*');
			$this->db->from('search_result');
			$this->db->where('hotel_id',$hid);
			$this->db->where('criteria_id',$sec_id);
			$this->db->order_by('nightperroom','asc');
			$this->db->limit(1);
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
		function insert_booking($GoBookingCode,$GoReference,$ClientBookingCode,$BookingStatus,$TotalPrice,$Currency,$HotelName,$HotelSearchCode,$RoomType,$RoomBasis,$ArrivalDate,$CancellationDeadline,$Nights,$NoAlternativeHotel,$title,$first_name,$last_name,$email_id)
		{
			$check_out = $this->session->userdata('end_date');
			$voucher_date = date('Y-m-d');
			$city = $this->session->userdata('disp_city');
			$disp_country = $this->session->userdata('disp_country');
			$name = $title." ".$first_name." ".$last_name;
			$data = array('ProcessId'=>$GoBookingCode,'booking_ref_no'=>$GoReference,'itemcode'=>$ClientBookingCode,'status'=>$BookingStatus,'amount'=>$TotalPrice,'Currency'=>$Currency,'hotelname'=>$HotelName,'hotel_code'=>$HotelSearchCode,'room_type'=>$RoomType,'roomCode'=>$RoomBasis,'check_in'=>$ArrivalDate,'check_out'=>$check_out,'cancel_tilldate'=>$CancellationDeadline,'Nights'=>$Nights,'NoAlternativeHotel'=>$NoAlternativeHotel,'voucher_date'=>$voucher_date,'city'=>$city,'countryName'=>$disp_country,'name1'=>$name,'email'=>$email_id);
			$this->db->insert('booking_ref',$data);
			return $this->db->insert_id();
		}
		function insert_book_details($HotelSearchCode,$start_date,$nights,$room_type,$room_count)
		{
			
		}
		function book_det($id)
		{
			$this->db->select('*');
			$this->db->from('booking_ref');
			$this->db->where('booking_no',$id);
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
		function book_det_hp($id)
		{
			$this->db->select('*');
			$this->db->from('hotel_booking_info');
			$this->db->where('hotel_booking_info_id',$id);
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
		function update_hotel_status($id,$GoBookingCode,$BookingStatus)
		{
			$data = array('status'=>$BookingStatus);
			$this->db->where('booking_no',$id);
			$this->db->update('booking_ref',$data);
		}
		function update_hotel_status2($id,$GoBookingCode,$BookingStatus,$GoReference,$TotalPrice,$Currency)
		{
			$data = array('status'=>$BookingStatus,'booking_ref_no'=>$GoReference,'ProcessId'=>$GoBookingCode,'amount'=>$TotalPrice,'Currency'=>$Currency);
			$this->db->where('booking_no',$id);
			$this->db->update('booking_ref',$data);
		}
		function update_hotel_status3($id,$GoBookingCode,$SupplierReferenceNumber,$BookedAndPayableBy,$Remarks,$address)
		{
			$data = array('itemcode'=>$SupplierReferenceNumber,'remark'=>$Remarks,'address'=>$address,'bankName'=>$BookedAndPayableBy);
			$this->db->where('booking_no',$id);
			$this->db->update('booking_ref',$data);
		}
		function last_view_hotel()
		{
			$city_code = $this->session->userdata('citycode');
			$this->db->select('*');
			$this->db->from('go_global_city');
			$this->db->where('cityid',$city_code);
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit('6');
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
			    return $query->result();
			}
		}
		function get_board_types()
		{
			$sec_id = $this->session->userdata('sec_res');
			$this->db->select('*');
			$this->db->from('search_result');
			$this->db->where('criteria_id',$sec_id);
			$this->db->group_by('plan_type');
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
			    return $query->result();
			}
		}
		function get_landmarks()
		{
			$sec_id = $this->session->userdata('sec_res');
			$this->db->select('*');
			$this->db->from('search_result');
			$this->db->where('criteria_id',$sec_id);
			$this->db->group_by('location');
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
			    return $query->result();
			}
		}
		function get_cnt_cur()
		{
			/*$this->db->select('*');
			$this->db->from('currency_converter');
			$this->db->where('currency','USD');
			$this->db->where('currency','EUR');
			$this->db->where('currency','CAD');
			$this->db->where('currency','GBP');*/
			// where currency ='USD' OR currency ='EUR' OR currency ='CAD' OR currency ='GBP'
			$que="select * from  currency_converter";
		
			$query= $this->db->query($que);
			//$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				return $query->result();	
			}
		}
		function insert_football_event($event_id,$event_type_id,$event_name,$event_place,$event_currency,$event_date,$event_time,$handlingfee,$size_433x274,$home_team,$guest_team,$city,$country,$tournament,$event_page,$event_text,$session)
		{
			$data = array('event_id'=>$event_id,'event_type_id'=>$event_type_id,'event_name'=>$event_name,'event_place'=>$event_place,'event_currency'=>$event_currency,'event_date'=>$event_date,'event_time'=>$event_time,'handlingfee'=>$handlingfee,'size_433x274'=>$size_433x274,'home_team'=>$home_team,'guest_team'=>$guest_team,'city'=>$city,'country'=>$country,'tournament'=>$tournament,'event_page'=>$event_page,'event_text'=>$event_text,'session_id'=>$session,'date'=>date('Y-m-d'));
			$this->db->insert('football_events',$data);
			return $this->db->insert_id();
		}
		function insert_football_tickets($id,$ticket_id,$ticket_price,$service_fee,$category,$session)
		{
			$data = array('event_id'=>$id,'ticket_id'=>$ticket_id,'ticket_price'=>$ticket_price,'service_fee'=>$service_fee,'category'=>$category,'session_id'=>$session,'date'=>date('Y-m-d'));
			$this->db->insert('football_tickets',$data);
		}
		function check_football_inserted($date)
		{
			$que="select * from football_tickets where date = '$date'";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return 1;	
			}
		}
		function all_football_events()
		{
			$que="select home_team,id from football_events  GROUP BY home_team ORDER BY RAND() LIMIT 0,13";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return $query->result();
			}
		}
		function all_football_events_all()
		{
			$que="select home_team,event_id from football_events GROUP BY home_team";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return $query->result();
			}
		}
		function get_football_results($start,$per_page)
		{
			$que="select * from football_events ORDER BY RAND() LIMIT $start,$per_page";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return $query->result();
			}
		}
		function get_football_results2($start,$per_page,$team,$date_rnge,$start_date,$end)
		{
			//echo $start;
			$start_date1 = explode('/',$start_date);
			$start_date = $start_date1[2].'-'.$start_date1[1].'-'.$start_date1[0];
			$end1 = explode('/',$end);
			$end = $end1[2].'-'.$end1[1].'-'.$end1[0];
			if($team == 0)
			{
				$que="select * from football_events where event_date BETWEEN '$start_date' AND '$end' ORDER BY event_date LIMIT $start,$per_page";
			}
			else
			{
				$que="select * from football_events where event_name like '%$team%' AND event_date BETWEEN '$start_date' AND '$end' ORDER BY event_date LIMIT $start,$per_page";
			}
			//OR guest_team = '$team'
			//echo "select * from football_events where home_team = '$team' OR guest_team = '$team' AND event_date BETWEEN '$start_date' AND '$end' ORDER BY RAND() LIMIT $start,$per_page"; exit;
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return $query->result();
			}
		}
		function get_all_football_results()
		{
			$que="select * from football_events ";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return $query->result();
			}
		}
		function get_all_football_results2($team,$start_date,$end_date)
		{
			//OR guest_team = '$team'
			$start_date1 = explode('/',$start_date);
			$start_date = $start_date1[2].'-'.$start_date1[1].'-'.$start_date1[0];
			$end1 = explode('/',$end_date);
			$end = $end1[2].'-'.$end1[1].'-'.$end1[0];
			if($team == 0)
			{
				$que="select * from football_events where event_date BETWEEN '$start_date' AND '$end'";
			}
			else
			{
				$que="select * from football_events where event_name like '%$team%' AND event_date BETWEEN '$start_date' AND '$end'";
			}
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return $query->result();
			}
		}
		function all_football_event_det($id)
		{
			$que="select * from football_events where id='$id'";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return $query->row();
			}
		}
		function get_tickets($id) 
		{
			$que="select * from football_tickets where event_id='$id'";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
                            return $query->result();
			}
		}
                function get_tktdet($tk_id)
                {
                    $que="select * from football_tickets where id='$tk_id'";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
                            return $query->row();
			}
                }
                function insert_foobal_booking($id,$tk_id,$currency,$quantity,$title,$first_name,$last_name,$gender,$phone,$company_name,$address,$city,$postcode,$state,$country,$hotelname,$hotel_book_info,$hotel_arriving_date,$arriving_time,$hotelphone,$amount)
                {
                    $data = array('event_id'=>$id,'tk_id'=>$tk_id,'currency'=>$currency,'quantity'=>$quantity,'title'=>$title,'first_name'=>$first_name,'last_name'=>$last_name,'gender'=>$gender,'phone'=>$phone,'company_name'=>$company_name,'address'=>$address,'city'=>$city,'postcode'=>$postcode,'hotel_book_info'=>$hotel_book_info,'hotel_arriving_date'=>$hotel_arriving_date,'arriving_time'=>$arriving_time,'hotelphone'=>$hotelphone,'amount'=>$amount);
                    $this->db->insert('football_book_det',$data);
                }
		function guest_det($id) 
		{
			$que="select * from customer_contact_details where customer_contact_details_id='$id'";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return $query->row();
			}
		}
		function get_hotels($city) 
		{
			$que="select * from go_global_city where city='$city' GROUP BY `Name`";
			$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return 0;			
			}
			else
			{
				return $query->result();
			}
		}
		function get_holiday_country()
		{
			$this->db->select('*');
			$this->db->from('country');
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows =='')
				{
					return '';
				}else{
					return $query->result();
				}
		}
		function get_holiday_language()
		{
			$this->db->select('*');
			$this->db->from('language');
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows =='')
				{
					return '';
				}else{
					return $query->result();
				}
		}
		function add_agent_register_details($details){
				$this->db->insert('agents',$details);
				//$this->db->last_query();exit;
			}
}
?>
