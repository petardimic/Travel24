<?php 
class Home_Model extends CI_Model
{

		function __construct()
		{
		
		parent::__construct();
		
		}
		function admin_login_check_db($username,$passwd)
		{
			
			$this->db->select('*');
			$this->db->from('admin_new');
			$this->db->where('user',$username);
			$this->db->where('password',$passwd);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
			
		}
		function super_login_check_db($username,$passwd)
		{
			
			$this->db->select('*');
			$this->db->from('superadmin');
			$this->db->where('username',$username);
			$this->db->where('password',$passwd);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
			
		}
		function get_country()
		{	
			$this->db->select('distinct(country_name)');
			$this->db->from('api_hotels_city');
			$query=$this->db->get();
			return $query->result();
		}
		function get_uer_type()
		{
			$this->db->select('*');
			$this->db->from('user_type');
			$query=$this->db->get();
			return $query->result();
		}
		function hotel_FILTER_byname($name)
		{
		$this->db->select('*');
		$this->db->from('user u');	   
		$this->db->join('user_profile us','u.user_id=us.user_id');
		$this->db->where('agency_name',$name);
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
		function user_registration($user_type,$userf_name,$userl_name,$gender,$dob,$address,$country,$city,$postalcode,$email,$office_no,$mob_phn,$nation,$passd,$date,$added,$status,$comm_id,$agency_name,$currency)
		{
			$data=array("first_name"=>$userf_name,"last_name"=>$userl_name,"email"=>$email,"password"=>$passd,"user_type_id"=>$user_type,"added_by"=>$added,'status'=>$status,'commision_id'=>$comm_id,'agency_name'=>$agency_name,'currency_id'=>$currency);
			$this->db->insert('user',$data);
			$id =  $this->db->insert_id();
			$data1 = array("gender"=>$gender,"dob"=>$dob,"address"=>$address,"mobile_no"=>$office_no,"alternative_no"=>$mob_phn,"country"=>$country,"city"=>$city,"postal_code"=>$postalcode,"nationality"=>$nation,"user_id"=>$id);
			$this->db->insert('user_profile',$data1);
			if($user_type == 1)
			{
			$apt_id = 'APT'.time();
			$data2 = array('user_id'=>$id,'apartment_id'=>$apt_id,'first_name'=>$userf_name,'last_name'=>$userl_name,'email'=>$email,'city'=>$city,'country_id'=>$country,'added_by'=>1,'status'=>1);
			$this->db->insert('sup_apart_list',$data2);
			}
			
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
	function get_brand_name()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_type_id',1);
		$this->db->where('agency_name <>','');
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
		function get_ind_country($id)
		{
			$this->db->select('name');
			$this->db->from('countires');
			$this->db->where('countrycode',$id);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				$val =  $query->row();
				return  $val->name;
			}
			
		}
		function get_cnt($id)
		{
			$this->db->select('name');
			$this->db->from('countires');
			$this->db->where('countrycode',$id);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				$val =  $query->row();
				return  $val->name;
			}
		}
		function update_user($userf_name,$userl_name,$address,$country,$city,$postalcode,$office_no,$mob_phn,$nation,$id,$comm_id)
		{
			$data=array("first_name"=>$userf_name,"last_name"=>$userl_name,'commision_id'=>$comm_id);
			$this->db->where('user_id',$id);
			$this->db->update('user',$data);
			 
			$data1 = array("address"=>$address,"mobile_no"=>$office_no,"alternative_no"=>$mob_phn,"country"=>$country,"city"=>$city,"postal_code"=>$postalcode,"nationality"=>$nation);
			$this->db->where('user_id',$id);
			$this->db->update('user_profile',$data1);
			 

		}
		function update_cust($userf_name,$userl_name,$userm_name,$gender,$address,$country,$city,$postalcode,$office_no,$mob_phn,$nation,$passport_num,$state,$company,$id,$comm_id)
		{
			$data=array("first_name"=>$userf_name,"last_name"=>$userl_name,'commision_id'=>$comm_id,'middle_name'=>$userm_name,'commision_id'=>$comm_id,'agency_name'=>$company);
			$this->db->where('user_id',$id);
			$this->db->update('user',$data);
			 
			$data1 = array('address'=>$address,"mobile_no"=>$office_no,"alternative_no"=>$mob_phn,"country"=>$country,"city"=>$city,"postal_code"=>$postalcode,"nationality"=>$nation,'gender'=>$gender,'passport_num'=>$passport_num);
			$this->db->where('user_id',$id);
			$this->db->update('user_profile',$data1);
			 

		}
		function get_special_req1($id,$gid)
		{
			$this->db->select('*');
			$this->db->from('guest_details');
			$this->db->where('passenger_info_id',$id);
			$this->db->where('guest_details_id',$gid);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();
				return $val->request;
			}

		}
		function update_agent($userf_name,$userl_name,$com_type,$comp_name,$address,$country,$city,$postalcode,$office_no,$mob_phn,$mark_up,$id,$comm_id)
		{
			$data=array("first_name"=>$userf_name,"last_name"=>$userl_name,'commision_id'=>$comm_id,'markup'=>$mark_up,'commision_id'=>$comm_id,'agency_name'=>$comp_name,'com_type'=>$com_type);
			$this->db->where('user_id',$id);
			$this->db->update('user',$data);
			 
			$data1 = array('address'=>$address,"mobile_no"=>$office_no,"alternative_no"=>$mob_phn,"country"=>$country,"city"=>$city,"postal_code"=>$postalcode);
			$this->db->where('user_id',$id);
			$this->db->update('user_profile',$data1);
			 

		}
		function update_sup($userf_name,$userl_name,$address,$country,$city,$postalcode,$office_no,$mob_phn,$nation,$id,$comm_id,$brand,$position,$markup)
		{
			$data=array("first_name"=>$userf_name,"last_name"=>$userl_name,'commision_id'=>$comm_id,'position'=>$position,'agency_name'=>$brand,'markup'=>$markup);
			$this->db->where('user_id',$id);
			$this->db->update('user',$data);
			 $data1 = array("address"=>$address,"mobile_no"=>$office_no,"alternative_no"=>$mob_phn,"country"=>$country,"city"=>$city,"postal_code"=>$postalcode,"nationality"=>$nation);
			$this->db->where('user_id',$id);
			$this->db->update('user_profile',$data1);
		}
		function view_users()
		{
			$query = $this->db->query('select * from user u inner join user_profile us on u.user_id = us.user_id inner join user_type ut on u.user_type_id = ut.user_type_id');
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->result();
			}
		}
		function get_type($id)
		{
			$this->db->select('user_type');
			$this->db->from('user_type');
			$this->db->where('user_type_id',$id);
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				$val =  $query->row();
				return $val->user_type;
			}
		}
		function view_users_sub()
		{
			
			$query = $this->db->query('select * from user u inner join user_profile us on u.user_id = us.user_id');
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->result();
			}
		}
		function view_users_sub_ind($id)
		{
			
			$query = $this->db->query('select * from user u inner join user_profile us on u.user_id = us.user_id WHERE u.user_id='.$id);
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->row();
			}
		}
		function popular_dest()
		{
			$this->db->select('*');
			$this->db->from('popular_destinations');
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
		function fet_dest()
		{
			$this->db->select('*');
			$this->db->from('featured_prop');
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
		function get_notify($id)
		{
			$this->db->select('*');
			$this->db->from('notification_users');
			$this->db->where('user_id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}	
		}
		function add_pop_dest_city($disp_city,$citycode,$order,$title,$img1,$image_text,$edit_text,$edit_page_t,$edit_meta,$edit_metakeyword)
		{
			$data = array('city_value'=>$disp_city,'city_code'=>$citycode,'order_disp'=>$order,'title'=>$title,'image'=>$img1,'image_text'=>$image_text,'edit_text'=>$edit_text,'edit_page_title'=>$edit_page_t,'edit_meta'=>$edit_meta,'edit_metakeyword'=>$edit_metakeyword);
			$this->db->insert('popular_destinations',$data);
		}
		function add_pop_dest_region($disp_city,$citycode,$order,$title,$img1,$image_text,$edit_text,$edit_page_t,$edit_meta,$edit_metakeyword)
		{
			$data = array('city_value'=>$disp_city,'region_code'=>$citycode,'order_disp'=>$order,'title'=>$title,'image'=>$img1,'image_text'=>$image_text,'edit_text'=>$edit_text,'edit_page_title'=>$edit_page_t,'edit_meta'=>$edit_meta,'edit_metakeyword'=>$edit_metakeyword);
			$this->db->insert('popular_destinations',$data);
		}
		function update_pop_dest_city($disp_city,$citycode,$order,$title,$img1,$image_text,$edit_text,$edit_page_t,$edit_meta,$edit_metakeyword,$edit_id)
		{
			$data = array('city_value'=>$disp_city,'city_code'=>$citycode,'order_disp'=>$order,'title'=>$title,'image'=>$img1,'image_text'=>$image_text,'edit_text'=>$edit_text,'edit_page_title'=>$edit_page_t,'edit_meta'=>$edit_meta,'edit_metakeyword'=>$edit_metakeyword);
			$this->db->where('popular_destinations_id',$edit_id);
			$this->db->update('popular_destinations',$data);
		}
		function update_pop_dest_region($disp_city,$citycode,$order,$title,$img1,$image_text,$edit_text,$edit_page_t,$edit_meta,$edit_metakeyword,$edit_id)
		{
			$data = array('city_value'=>$disp_city,'region_code'=>$citycode,'order_disp'=>$order,'title'=>$title,'image'=>$img1,'image_text'=>$image_text,'edit_text'=>$edit_text,'edit_page_title'=>$edit_page_t,'edit_meta'=>$edit_meta,'edit_metakeyword'=>$edit_metakeyword);
			$this->db->where('popular_destinations_id',$edit_id);
			$this->db->update('popular_destinations',$data);
		}
		function add_fet_dest_city($disp_city,$citycode,$hotel,$loc,$hotel_id,$type,$image_text)
		{
			$loc_america = '';
			$loc_asia = '';
			$loc_europe = '';
			$loc_middle_east = '';
			$loc_oceania = '';
			$loc_southeastasia = '';
			if($loc == 'america')
			{
				$loc_america = 1;
			}
			else if($loc == 'europe')
			{
				$loc_europe = 1;
			}
			else if($loc == 'middle_east')
			{
				$loc_middle_east = 1;
			}
			else if($loc == 'asia')
			{
				$loc_asia = 1;
			}
			else if($loc == 'southeastasia')
			{
				$loc_southeastasia = 1;
			}
			else if($loc == 'oceania')
			{
				$loc_oceania = 1;
			}
			$data = array('city'=>$disp_city,'city_code'=>$citycode,'hotel_name'=>$hotel,'hotel_id'=>$hotel_id,'america'=>$loc_america,'europe'=>$loc_europe,'middle_east'=>$loc_middle_east,'asia'=>$loc_asia,'southeastasia'=>$loc_southeastasia,'oceania'=>$loc_oceania,'type'=>$type,'image_text'=>$image_text);
			$this->db->insert('featured_prop',$data);
		}
		function get_hotel_id($hotel,$citycode)
		{
			$this->db->select('sup_apart_list_id');
			$this->db->from('sup_apart_list');
			$this->db->where('apartment_name',$hotel);
			$this->db->where('city',$citycode);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				$val=$query->row();
				return $val->sup_apart_list_id;
			}	
		}
		function get_hotel_id1($hotel,$citycode)
		{
			$this->db->select('sup_apart_list_id');
			$this->db->from('sup_apart_list');
			$this->db->where('apartment_name',$hotel);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				$val=$query->row();
				return $val->sup_apart_list_id;
			}	
		}
		function get_hotel_id_api($hotel,$citycode)
		{
			$this->db->select('hotel_id');
			$this->db->from('booking_gethotels');
			$this->db->where('name',$hotel);
			$this->db->where('city_id',$citycode);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				$val=$query->row();
				return $val->hotel_id;
			}	
		}
		function get_hotel_id_api1($hotel,$citycode)
		{
			$this->db->select('hotel_id');
			$this->db->from('booking_gethotels');
			$this->db->where('name',$hotel);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				$val=$query->row();
				return $val->hotel_id;
			}	
		}
		
		function up_fet_dest_city($disp_city,$citycode,$hotel,$loc,$edit_id,$image_text)
		{
			$loc_america = '';
			$loc_asia = '';
			$loc_europe = '';
			$loc_middle_east = '';
			$loc_oceania = '';
			$loc_southeastasia = '';
			if($loc == 'america')
			{
				$loc_america = 1;
			}
			else if($loc == 'europe')
			{
				$loc_europe = 1;
			}
			else if($loc == 'middle_east')
			{
				$loc_middle_east = 1;
			}
			else if($loc == 'asia')
			{
				$loc_asia = 1;
			}
			else if($loc == 'southeastasia')
			{
				$loc_southeastasia = 1;
			}
			else if($loc == 'oceania')
			{
				$loc_oceania = 1;
			}
			$data = array('city'=>$disp_city,'city_code'=>$citycode,'hotel_name'=>$hotel,'america'=>$loc_america,'europe'=>$loc_europe,'middle_east'=>$loc_middle_east,'asia'=>$loc_asia,'southeastasia'=>$loc_southeastasia,'oceania'=>$loc_oceania,'image_text'=>$image_text);
			$this->db->where('featured_prop',$edit_id);
			$this->db->update('featured_prop',$data);
		}
		function order_avail($order)
		{
			$this->db->select('order_disp');
			$this->db->from('popular_destinations');
			$this->db->where('order_disp',$order);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
			
		}
		function get_cnt_db($city)
		{
			$query =  $this->db->query("select count(*) as cnt from sup_apart_list where city ='".$city."' AND status = 1");
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				$val =  $query->row();
				return $val->cnt;
			}
		}
		function get_api_props($id,$city_ud)
		{
			$this->db->select('count(*) as api_cnt');
			$this->db->from('booking_gethotels');
			$this->db->where('city_id',$city_ud);
			$this->db->where('hoteltype_id',$id);
			$this->db->where('minrate <>','0');
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();
				return $val->api_cnt;
			}
		}
		function get_api_props_region($id,$city_ud)
		{
			//echo "select count(*) as api_cnt from booking_gethotels h inner join booking_region_hotels br on br.hotel_id = h.hotel_id where br.region_id ='".$city_ud."' AND h.hoteltype_id =".$id;exit;
			$query =  $this->db->query("select count(*) as api_cnt from booking_gethotels h inner join booking_region_hotels br on br.hotel_id = h.hotel_id where br.region_id ='".$city_ud."' AND h.hoteltype_id =".$id);
			/*$this->db->select('count(*) as api_cnt');
			$this->db->from('booking_gethotels');
			$this->db->where('city_id',$city_ud);
			$this->db->where('hoteltype_id',$id);
			$this->db->where('minrate <>','0');
			$query = $this->db->get();*/
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();
				return $val->api_cnt;
			}
		}
		function get_crs_props($id,$city_id)
		{
			$query=$this->db->query("SELECT count(*) as crs_cnt FROM sup_apart_list s inner join sup_apart_profile sl on s.sup_apart_list_id = sl.sup_apart_list_id where sl.sup_apartclass_type_id =".$id." AND s.city =".$city_id);
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();	
				return $val->crs_cnt;
			}	
		}
		function get_crs_props_region($id,$city_id)
		{
			$query=$this->db->query("SELECT count(*) as crs_cnt FROM sup_apart_list s inner join sup_apart_profile sl on s.sup_apart_list_id = sl.sup_apart_list_id where sl.sup_apartclass_type_id =".$id." AND s.region =".$city_id);
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();	
				return $val->crs_cnt;
			}	
		}
		function get_api_cnts()
		{
			$this->db->select('*');
			$this->db->from('sup_apartclass_type');
			$this->db->where('status',1);
			$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				return $query->result();
			}
		}
		function get_cnt_api($city)
		{
			$query =  $this->db->query("select count(*) as cnt from booking_gethotels where city_id ='".$city."' AND hoteltype_id = 2 AND minrate != 0");
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				$val =  $query->row();
				return $val->cnt;
			}
		}
		function view_suppliers()
		{
			$query = $this->db->query('select * from user u inner join user_profile us on u.user_id = us.user_id WHERE u.user_type_id = 1');
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->result();
			}
		}
		function view_suppliers_asc_names()
		{
			$query = $this->db->query('select * from user u inner join user_profile us on u.user_id = us.user_id WHERE u.user_type_id = 1 order by first_name asc');
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->result();
			}
		}
		
		function edit_user($id)
		{
			$query = $this->db->query("select * from user u inner join user_profile us on u.user_id = us.user_id where u.user_id = '".$id."'");
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->row();
			}
		}
		function change_pwd($adminid,$oldpwd,$newpwd)
		{
			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where('admin_id',$adminid);
			$this->db->where('password',$oldpwd);
			$query=$this->db->get();
			return $query->result();
		}
		function update_pwd($adminid,$newpwd)
		{
			$data = array(
               'password' => $newpwd
                );
 		  $this->db->where('admin_id',$adminid);
  		  $this->db->update('admin',$data);
		}
		function add_hotel($hotel_name,$contact_person,$email,$office_no,$website,$city,$sell_envirn)
		{
			$curr_time = "HOTS".time();
			$data=array("hotel_id"=>$curr_time,"hotel_name"=>$hotel_name,"contact_person"=>$contact_person,"city"=>$city,"email_id"=>$email,"contact_num"=>$office_no,"website"=>$website,'envirn'=>$sell_envirn);
			$this->db->insert('hotel_details',$data);	
		}
		function add_package($package_name,$hotel_name,$days,$nights,$city,$newdate,$newdate1,$cost,$specification,$map)
		{	
			$curr_time = "PACK".time();
			$data=array("package_id"=>$curr_time,"package_name"=>$package_name,"hotel_name"=>$hotel_name,"days"=>$days,"nights"=>$nights,"city"=>$city,"startdate"=>$newdate,"enddate"=>$newdate1,"cost"=>$cost,"des"=>$specification,"map"=>$map);
			$this->db->insert('package',$data);	
		}
		function update_package($package_name,$hotel_name,$days,$nights,$city,$newdate,$newdate1,$cost,$specification,$id,$map)
		{	
			$data=array("package_name"=>$package_name,"hotel_name"=>$hotel_name,"days"=>$days,"nights"=>$nights,"city"=>$city,"startdate"=>$newdate,"enddate"=>$newdate1,"cost"=>$cost,"des"=>$specification,"map"=>$map);
			$this->db->where('package_id',$id);
  		  $this->db->update('package',$data);
		}
		function add_car($hotel_name,$contact_person,$email,$office_no,$website,$city,$sell_envirn)
		{
			$curr_time = "TRAV".time();
			$data=array("travel_id"=>$curr_time,"travel_name"=>$hotel_name,"contact_person"=>$contact_person,"city"=>$city,"email_id"=>$email,"contact_num"=>$office_no,"website"=>$website,'envirn'=>$sell_envirn);
			$this->db->insert('car_details',$data);	
		}
		function agent_registration($agent_name,$agency_name,$address,$country,$city,$pincode,$email,$off_phn,$mob_phn,$agent_login,$passd)
		{	
			$curr_time = date("Y-m-d H:i:s");
			$data=array("agent_name"=>$agent_name,"agency_name"=>$agency_name,"agent_address"=>$address,"country"=>$country,"city"=>$city,"pincode"=>$pincode,"email"=>$email,"office_num"=>$off_phn,"mob_num"=>$mob_phn,"created_date"=>$curr_time);
			 $this->db->insert('agent_profile_details',$data);
			 $latest_id = $this->db->insert_id();
			 $data=array("agent_id"=>$latest_id,"login_name"=>$agent_login,"password"=>$passd);
			 $this->db->insert('agent_login_info',$data);
			 return 1;
			 
		}
		function insert_image($img1,$img2,$img3,$img4,$img5,$hotel_id)
		{
			$data = array('hotel_picture1' => $img1,'hotel_picture2' => $img2,'hotel_picture3' => $img3,'hotel_picture4' => $img4,'hotel_picture5' => $img5);
			$this->db->where('hotel_id',$hotel_id);
	  		$this->db->update('hotel_details',$data);
		}
		function insert_pack_image($img1,$img2,$img3,$img4,$img5,$hotel_id)
		{
			$data = array('hotel_picture1' => $img1,'hotel_picture2' => $img2,'hotel_picture3' => $img3,'hotel_picture4' => $img4,'hotel_picture5' => $img5);
			$this->db->where('package_id',$hotel_id);
	  		$this->db->update('package_details',$data);
		}
		function get_image($hotel_id)
		{
			$this->db->select('*');
			$this->db->from('hotel_details');
			$this->db->where('hotel_id',$hotel_id);
                        $query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}else{
				return $query->row();
			}
		}
		function get_packimage($hotel_id)
		{
			$this->db->select('*');
			$this->db->from('package_details');
			$this->db->where('package_id',$hotel_id);
            $query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}else{
				return $query->row();
			}
		}
		function add_commission_detail($value,$type,$created_by)
		{
			$data = array("value"=>$value,"type"=>$type,"created_by"=>$created_by);
		 	$this->db->insert('commision_new',$data);
		}
		function view_commission_detail()
	{
		$this->db->select('*');
		$this->db->from('commision_new');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}
	function user_type($value)
	{
		$data = array('user_type'=>$value);
		$this->db->insert('user_type',$data);
	}
	function add_user_type()
	{
		$this->db->select('*');
		$this->db->from('user_type');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}
function edit_commission_details($commission,$markup)		
	{
		$data=array('value'=>$markup);
		$this->db->where('commision_id',$commission);
		$this->db->update('commision_new',$data);	
	}
	function insert_ip($ipadds,$desc)
	{
		$data = array('ip_address'=>$ipadds,'description'=>$desc);
		$this->db->insert('ip_control',$data);
	}
	function get_comm_id()
	{
		$this->db->select('*');
		$this->db->from('commision_new');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}
function currency_details()
	{
		$this->db->select('*');
		$this->db->from('currency_converter');
		$this->db->order_by('currency','asc');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}	
function update_currency_detail($currencyid,$amt)		
	{
		$data=array('currency_value'=>$amt);
		$this->db->where('currency_id',$currencyid);
		$this->db->update('currency_converter',$data);
	}
function website_settings_details()
{
	
	$this->db->select('*');
	$this->db->from('website_settings');
	$query=$this->db->get();
/*	echo $this->db->last_query();
	exit;*/
	if($query->num_rows() == ''){
	
	return '';
	}
	else{
	
	$row=$query->result();
	return $row;
	}
	
	}	
function get_currency_types(){
	
	$this->db->select('*');
	$this->db->from('currency_converter');
	$query=$this->db->get();
	
	if($query->num_rows() == ''){
	return '';
	}
	else{
	 return $query->result();
	}
	
	}
function website_settings_update($data,$id){
	
	$this->db->where('setting_id',$id);
		$this->db->update('website_settings',$data);
	//echo $this->db->last_query();
   }
 function apiselect()
	{
		$this->db->select('*');
		$this->db->from('api_control');
		$query=$this->db->get();
	
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	
	}
	function api_status($id,$status){
   $data=array('status'=>$status);
   $this->db->where('api_id',$id);
   $this->db->update('api_control',$data);
   
   }
	function discount($id,$discount)
	{
		$data = array("markup"=>$discount);
		$this->db->where('agent_id',$id);
		$this->db->update('agent_profile_details',$data);
	}
	function get_discount($id)
	{
		$query = $this->db->query("select * from user u inner join commision_new c on u.commision_id = c.commision_id WHERE u.user_id ='".$id."'");
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 	return $query->row();
		}
	}
	function default_currency()
	{
		$this->db->select('*');
		$this->db->from('website_settings');
		$this->db->join('currency_converter','currency_converter.currency_id = website_settings.fixed_amount');
		$query = $this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->row();
		}
	}
	function add_currency_details($currency_code,$currency_name,$amount)
	{
		$date = date('y-m-d H:i:s', time());
		$currency_code = strtoupper($currency_code);
		$currency_name = strtoupper($currency_name);
		$amount = strtoupper($amount);
		$data=array('currency'=>$currency_code,'currency_name'=>$currency_name,'currency_value'=>$amount,'currency_updated'=>$date,'currency_entered'=>$date);
		$this->db->insert('currency_converter',$data);
	}
	function edit_currency($id)
	{
		$this->db->select('*');
		$this->db->from('currency_converter');
		$this->db->where('currency_id',$id);
		$query = $this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->row();
		}
	}
	function update_currency_details($currency_code,$currency_name,$amount,$currencyid)
	{
		$date = date('y-m-d H:i:s', time());
		$currency_code = strtoupper($currency_code);
		$currency_name = strtoupper($currency_name);
		$amount = strtoupper($amount);
		$data=array('currency'=>$currency_code,'currency_name'=>$currency_name,'currency_value'=>$amount,'currency_updated'=>$date);
		$this->db->where('currency_id',$currencyid);
		$this->db->update('currency_converter',$data);
	}
	function delete_currency_details($id)
	{
		$this->db->where('currency_id', $id);
		$this->db->delete('currency_converter'); 
		
	}
	function delete_customer_details($id)
	{
		//$this->db->where('user_id', $id);
		//$this->db->delete('user'); 
		$this->db->where('id', $id);
		$this->db->delete('customer'); 
		
	}
	function get_ip_valid($ip)
	{
		$this->db->select('ipcontrol_id');
		$this->db->from('ip_control');
		$this->db->where('ip_address',$ip);
		$this->db->where('status','Active');
		$query = $this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		  $val = $query->row();
		   return $val->ipcontrol_id;
		 //return $query->ipcontrol_id;
		}
	}
	function view_agents()
	{
		$query = $this->db->query('select * from user u inner join user_profile us on u.user_id = us.user_id WHERE u.user_type_id = 2');
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}	
	function view_cust_details($id)
	{
		$this->db->select('*');
		$this->db->from('user u');
		$this->db->join('user_profile us','u.user_id = us.user_id');
		$this->db->where('u.user_id',$id);
		$query = $this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}
	function view_agents_per($start,$limit)
	{
		$query = $this->db->query('select * from user u inner join user_profile us on u.user_id = us.user_id WHERE u.user_type_id = 2');
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function view_customers()
	{
		$query = $this->db->query('select * from user u inner join user_profile us on u.user_id = us.user_id WHERE u.user_type_id = 4');
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function view_customers1()
	{
		$query = $this->db->query('select * from customer');
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function view_customers_per($start,$limit)
	{
		$sel = $this->db->query("select * from user u inner join user_profile us on u.user_id = us.user_id WHERE u.user_type_id = 3 Limit $start,$limit");
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function view_customer_detail($custid)
	{
		$this->db->select('*');
		$this->db->from('customer_login');
		$this->db->where('cust_id',$custid);
		$query = $this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->row();
		}
	}
	function view_customer_detail1($custid)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$custid);
		$query = $this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->row();
		}
	}
	function update_cust1($id,$first_name,$last_name,$mobile_no,$pan,$city,$state,$country,$pincode,$designation)
	{
		$data = array('first_name'=>$first_name,'last_name'=>$last_name,'mobile_no'=>$mobile_no,'pan'=>$pan,'city'=>$city,'state'=>$state,'country'=>$country,'pincode'=>$pincode,'designation'=>$designation);
		$this->db->where('id',$id);
		$this->db->update('customer',$data);
	}
	function view_visa_applied()
	{
		$this->db->select('*');
		$this->db->from('visa_apply');
		$query = $this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function view_visa_applied_per($start,$limit)
	{
		$sel = "select * from visa_apply Limit $start,$limit";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	
	function view_visa_applied_with_dependent($id)
	{
		$this->db->select('*');
		$this->db->from('visa_apply_dependent');
		$this->db->where('visa_id',$id);
	
		$query = $this->db->get();
			//echo $this->db->last_query();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	
	function visa_det($id)
	{
		$this->db->select('*');
		$this->db->from('visa_apply');	   
		$this->db->where('visa_id',$id);
		
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
	
	
	function update_agent_status($id,$status)
	{
		//echo $status;
		/*if($status=='yes')
		{
			$status='no';
		}
		else
		{
			$status='yes';
		}*/
		$data = array('status' => $status);
		$this->db->where('agent_id',$id);
  		$this->db->update('agents',$data);
		//echo $this->db->last_query();exit;
	}
	function update_prop_status($status,$id)
	{
		if($status== 0)
		{
			$status= 1;
		}
		else
		{
			$status= 0;
		}
		$data = array('status' => $status);
		$this->db->where('sup_apart_list_id',$id);
  		$this->db->update('sup_apart_list',$data);
		//echo $this->db->last_query();exit;
	}
	function get_citycode($disp_city,$countrycode)
		{
			$this->db->select('city_id');
			$this->db->from('booking_cities');
			$this->db->where('name',$disp_city);
			$this->db->where('countrycode',$countrycode);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				$val =   $query->row();
				return $val->city_id;
			}
			
		}
		function get_regioncode($disp_city,$countrycode)
		{
			$this->db->select('region_id');
			$this->db->from('booking_regions');
			$this->db->where('name',$disp_city);
			$this->db->where('countrycode',$countrycode);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				$val =   $query->row();
				return $val->region_id;
			}
			
		}
		
	function update_sup_status($status,$id)
	{
		if($status=='InActive')
		{
			$status='Active';
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',5);
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				  $val =  $query->row();
				  $this->db->select('first_name,email');
				  $this->db->from('user');
				  $this->db->where('user_id',$id);
				  $query1=$this->db->get();
				  if($query1->num_rows() =='')
				  {
					 return '';
				  }
				  else
				  {
					 $val1 =  $query1->row();  
					 $name = $val1->first_name;
					 $email = $val1->email;
				  }
				 /* require("PHPMailer/class.phpmailer.php"); 
				  $mail = new PHPMailer();
				  $mail->From = 'info@stayserviced.com';
				  $mail->FromName = "no-reply@stayserviced.com";
				  $mail->Host='mail.stayserviced.com';
				  $mail->Port='587';
				  $mail->Username   = 'info@stayserviced.com';
				  $mail->Password   = 'sunlight';
				  $mail->SMTPKeepAlive = true;
				  $mail->Mailer = "smtp";
				  $mail->WordWrap = FALSE;
				  $mail->IsSMTP();
				  $mail->IsHTML(true);
				  $mail->AddAddress($email);
				  $sub =  $val->email_subject;
				  $msg = str_replace('{name}',ucfirst($name),$val->html_content);
				  $msg.= $val->footer;
				  $mail->Subject = $sub;
				  $mail->Body = $msg;
				  $mail->SMTPAuth   = true;                 // enable SMTP authentication
				  $mail->CharSet = 'utf-8';
				  $mail->SMTPDebug  = 0;
				  if(!$mail->Send())
				  {
					  show_error($this->email->print_debugger());
				  }*/		  
			}	
		}
		else
		{
			$status='InActive';
		}
		$data = array('status' => $status);
		$this->db->where('user_id',$id);
  		$this->db->update('user',$data);
		//echo $this->db->last_query();exit;
	}
	
	function agent_view_status($status,$id)
	{
		//echo $status;echo $id;exit;
		if($status=='InActive')
		{
			$status='Active';
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',8);
			$query=$this->db->get();
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				  $val =  $query->row();
				  $this->db->select('first_name,email');
				  $this->db->from('user');
				  $this->db->where('user_id',$id);
				  $query1=$this->db->get();
				  if($query1->num_rows() =='')
				  {
					 return '';
				  }
				  else
				  {
					 $val1 =  $query1->row();  
					 $name = $val1->first_name;
					 $email = $val1->email;
				  }
				  require("PHPMailer/class.phpmailer.php"); 
				  $mail = new PHPMailer();
				  $mail->From = 'info@stayserviced.com';
				  $mail->FromName = "no-reply@stayserviced.com";
				  $mail->Host='mail.stayserviced.com';
				  $mail->Port='587';
				  $mail->Username   = 'info@stayserviced.com';
				  $mail->Password   = 'sunlight';
				  $mail->SMTPKeepAlive = true;
				  $mail->Mailer = "smtp";
				  $mail->WordWrap = FALSE;
				  $mail->IsSMTP();
				  $mail->IsHTML(true);
				  $mail->AddAddress($email);
				  $sub =  $val->email_subject;
				  $msg = str_replace('{name}',ucfirst($name),$val->html_content);
				  $msg.= $val->footer;
				  $mail->Subject = $sub;
				  $mail->Body = $msg;
				  $mail->SMTPAuth   = true;                 // enable SMTP authentication
				  $mail->CharSet = 'utf-8';
				  $mail->SMTPDebug  = 0;
				  if(!$mail->Send())
				  {
					  show_error($this->email->print_debugger());
				  }		  
			}	
		}
		else
		{
			$status='InActive';
		}
		$data = array('status' => $status);
		$this->db->where('user_id',$id);
  		$this->db->update('user',$data);
		//echo $this->db->last_query();exit;
	}
	
	function update_subadmin_status($status,$id)
	{
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('status' => $status);
		$this->db->where('admin_id',$id);
  		$this->db->update('admin',$data);
		//echo $this->db->last_query();exit;
	}
	function update_ip_status($status,$id)
	{
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('ipstatus' => $status);
		$this->db->where('admin_id',$id);
  		$this->db->update('admin',$data);
		//echo $this->db->last_query();exit;
	}
	function get_ip()
	{
		$this->db->select('*');
		$this->db->from('ip_control');
		$query = $this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function update_comm_status($status,$id)
	{
		if($status=='Active')
		{
			$status='Inactive';
		}
		else
		{
			$status='Active';
		}
		$data = array('status' => $status);
		$this->db->where('commision_id',$id);
  		$this->db->update('commision_new',$data);
		//echo $this->db->last_query();exit;
	}
	function edit_ip_status($status,$id)
	{
		if($status=='Active')
		{
			$status='Inactive';
		}
		else
		{
			$status='Active';
		}
		$data = array('status' => $status);
		$this->db->where('ipcontrol_id',$id);
  		$this->db->update('ip_control',$data);
		//echo $this->db->last_query();exit;
	}
	function delete_ip($id)
	{
		$this->db->where('ipcontrol_id',$id);
		$this->db->delete('ip_control'); 
	}
	function delete_user($id)
	{
		$this->db->where('user_id',$id);
		$this->db->delete('user'); 
		$this->db->where('user_id',$id);
		$this->db->delete('user_profile'); 
	}
	function delete_sup($id)
	{
		$this->db->where('user_id',$id);
		$this->db->delete('user'); 
		$this->db->where('user_id',$id);
		$this->db->delete('user_profile'); 
	}
	
	function delete_viewagent($id)
	{
		$this->db->where('user_id',$id);
		$this->db->delete('user'); 
		//$this->db->where('user_id',$id);
		//$this->db->delete('user_profile'); 
	}
	
	function delete_subadmin($id)
	{
		$this->db->where('admin_id',$id);
		$this->db->delete('admin'); 
	}
	function update_visa_status($id,$status)
	{
		if($status=='Deactive')
		{
			$status='Active';
		}
		else
		{
			$status='Deactive';
		}
		$data = array('status' => $status);
		$this->db->where('visa_id',$id);
  		$this->db->update('visa_apply',$data);
		//echo $this->db->last_query();exit;
	}
	
	function delete_visa_applied($visa_id)
	 {		
		$this->db->where('visa_id', $visa_id);
		$this->db->delete('visa_apply'); 
	
	 }
	
	function agent_details($id)
	{
		//echo "select * from user u inner join user_profile us on u.user_id = us.user_id WHERE u.user_type_id ='".$id."'";exit;<br />
		//echo "select * from user u inner join user_profile us on u.user_id = us.user_id inner join agent_account_info a on a.user_id = u.user_id WHERE u.user_id ='".$id."'";exit;
		$query = $this->db->query("select * from user u inner join user_profile us on u.user_id = us.user_id WHERE u.user_id ='".$id."'");
		
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->row();
		}
	}
	function delete_agent($id)
	{
		$this->db->where('agent_id', $id);
		$this->db->delete('agents'); 
	}
	function add_agents_deposit($id,$amount_deposited,$current_limit,$newdate,$mode_deposit,$bank_name,$branch_name,$city,$remarks,$transaction_id,$cheque_no,$remarks,$cheque_no)
	{
		
		$this->db->select('*');
		$this->db->from('agent_profile_details');
		$this->db->where('agent_id',$id);
		$query=$this->db->get();
		$row=$query->row();
		
		$bal=$row->Total_Bal;
	    $old_current_limit = $row->current_limit;
		
		$bal_amt=$bal+$amount_deposited;
		
		$current_limit=$current_limit;
		
		
		$data=array('current_limit'=>$current_limit,'Total_Bal'=>$bal_amt);
		$this->db->where('agent_id',$id);
		$this->db->update('agent_profile_details',$data);
		
		
		$data=array("user_id"=>$id,"deposited_amount"=>$amount_deposited,"current_limit"=>$current_limit,"date_of_deposit"=>$newdate,"mode_of_deposit"=>$mode_deposit,"bank_name"=>$bank_name,"branch_name"=>$branch_name,"city"=>$city,"transaction_id"=>$transaction_id,"cheque_no"=>$cheque_no,"remarks"=>$remarks,"cheque_date"=>$cheque_no );
		$this->db->insert('agent_amount_deposit',$data);
		
	}
	function add_agents_deposit1($id,$amount_deposited,$current_limit,$newdate,$mode_deposit,$bank_name,$branch_name,$city,$remarks,$transaction_id,$remarks,$cheque_no )
	{
		$this->db->select('*');
		$this->db->from('agent_account_info');
		$this->db->where('user_id',$id);
		$query=$this->db->get();
		$row=$query->row();	
		$bal=$row->Total_Bal;
	    $old_current_limit = $row->current_limit;
		$bal_amt=$bal+$amount_deposited;
		$current_limit = $current_limit;
		$data=array('current_limit'=>$current_limit,'Total_Bal'=>$bal_amt,'avail_bal'=>$bal_amt);
		$this->db->where('user_id',$id);
		$this->db->update('agent_account_info',$data);
		
		//echo $newdate; exit;
		$data=array("user_id"=>$id,"deposited_amount"=>$amount_deposited,"current_limit"=>$current_limit,"date_of_deposit"=>$newdate,"mode_of_deposit"=>$mode_deposit,"bank_name"=>$bank_name,"branch_name"=>$branch_name,"city"=>$city,"transaction_id"=>$transaction_id,"remarks"=>$remarks,"cheque_date"=>$cheque_no );
		$this->db->insert('agent_amount_deposit',$data);
	}
	function get_deposited_agent($id)
	{
	//	echo "select * from user u inner join agent_amount_deposit us on u.user_id = us.user_id WHERE u.user_id ='".$id."'";exit;
		$query = $this->db->query("select * from user u inner join agent_amount_deposit us on u.user_id = us.user_id WHERE u.user_id ='".$id."'");
		/*$this->db->select('*');
		$this->db->from('agent_amount_deposit');
		$this->db->where('user_id',$id);
		$query = $this->db->get();*/
		//echo $query->num_rows();exit;
		if($query->num_rows() == 0)
		{
			return '';
		}
		else
		{
			return $query->result();
		}
	}
	function get_available_amt($id)
	{
		$this->db->select('*');
		$this->db->from('agent_account_info');
		$this->db->where('user_id',$id);
		$query= $this->db->get();
		if($query->num_rows() == 0)
		{
			return '';
		}
		else
		{
			return $query->row();
		}
		
	}
	function get_deposited_agent_per($id,$start,$limit)
	{
		$query = $this->db->query("select * from user u inner join agent_amount_deposit us on u.user_id = us.user_id WHERE u.user_id ='".$id."' Limit $start,$limit");
		if($query->num_rows() == 0)
		{
			return '';
		}
		else
		{
			return $query->result();
		}
	}
	function search_booking_view($sd,$ed)
		{
			$select="select * from user a inner join booking_ref b on  b.customer_id =a.user_id where b.check_in>='".$sd."' and b.check_out<='".$ed."' and b.status='Confirmed'";	
			$query = $this->db->query($select);
			if($query->num_rows() =='')
			{ 
				return '';
			}
			else
			{
			  return $query->result();
			}
		}
		function search_cancel_booking_view($sd,$ed)
		{
			$select="select * from user a inner join booking_ref b on  b.customer_id=a.user_id where b.check_in >='".$sd."' and b.check_out <='".$ed."' AND b.status='Cancelled' GROUP BY booking_no";
			$query = $this->db->query($select);
			if($query->num_rows() =='')
			{ 
				return '';
			}
			else
			{
			  return $query->result();
			}
		
		}	
		function search_onreq_booking_view($sd,$ed)
		{
			$select="select * from user a inner join booking_ref b on  b.customer_id=a.user_id where b.check_in >='".$sd."' and b.check_out <='".$ed."' AND b.status='Pending Confirmation' GROUP BY booking_no";
			$query = $this->db->query($select);
			if($query->num_rows() =='')
			{ 
				return '';
			}
			else
			{
			  return $query->result();
		  	}
		}
		function get_agentid($hid)
		{
			
		$this->db->select('first_name');
		$this->db->from('user');	   	 		
		$this->db->where('user_id',$hid);
			
		$query=$this->db->get();

		//var_dump($query);
		
		if($query->num_rows() =='')
		{ 
			return '';
		}
		else
		{
		 $val= $query->row();
		 return $val->first_name;
	  
		}
		
		}
		function get_tot_passanger($hid)
		{
			
		$sel="select count(booking_id) as  book_id from book_passanger_info where booking_id ='".$hid."'";
		$query=$this->db->query($sel);
		if($query->num_rows() =='')
		{ 
			return '';
		}
		else
		{
		 $val= $query->row();
		 return $val->book_id ;
	  
		}
		
		}
		
			
		function admin_last_login($adminid)
		{
			
		$this->db->select('*');
		$this->db->from('admin_login');	   	 		
		$this->db->where('admin_id',$adminid);
			
		$query=$this->db->get();

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
		function show_val($bookid)
		{

				$this->db->select('*');
				$this->db->from('booking_ref');
				//$this->db->join('book_passanger_info','book_passanger_info.booking_id=booking_ref.booking_no','inner');
				$this->db->where('booking_no',$bookid);
				$query=$this->db->get();
				if($query->num_rows() ==''){
					return '';			
				}else{
					return $query->row();				
				}
		
		}
		function cancel_info($id)
		{
		$this->db->select('*');
		$this->db->from('cancellation_details');	   
		$this->db->where('hotel_id',$id);
		
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
		function agent_total_bal_db($id,$amt)
		{
		
			$data=array('Total_Bal'=>$amt);
			$this->db->where('agent_id',$id);
			$this->db->update('agent_profile_details',$data);		
		}
		 function update_book_status_db($status,$book_id)
	  {
	        $data=array('status'=>$status);
			$this->db->where('booking_no',$book_id);
			$this->db->update('booking_ref',$data);	
	  }
		function Agent_mark_details($id)
	  {
		
		$this->db->select('*');
		$this->db->from('agent_profile_details');
		$this->db->where('agent_id',$id);
		
		$query=$this->db->get();
		if($query->num_rows =='')
		{
			return '';
		}else{
			return $query->row();
		}
	  }		
		function update_stat($id,$status)
	{
	$data=array('status'=>$status);
	$this->db->where('booking_no',$id);
	$this->db->update('booking_ref',$data);

	}
	function get_booking_details_db($book_id)
		 {
/*	echo "select * from booking_ref where booking_no = '$book_id'";exit*/;
	  $querydb=$this->db->query("select * from booking_ref where booking_no = '$book_id'");
	  return  $querydb->row();
		 }	
		 function manage_user()
	{
		$this->db->select('*');
		$this->db->from('agent_profile_details');
        //$this->db->join('agent_profile_details','agent_profile_details.agentid=deposit_details.agentid','right');
        $this->db->where('newuser','0');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}
	
function manage_user1()
	{
		$this->db->select('*');
		$this->db->from('agent_profile_details');
        //$this->db->join('agent_profile_details','agent_profile_details.agentid=deposit_details.agentid','right');
        $this->db->where('status','active');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}
	
function manage_user2()
	{
		$this->db->select('*');
		$this->db->from('agent_profile_details');
        //$this->db->join('agent_profile_details','agent_profile_details.agentid=deposit_details.agentid','right');
		$this->db->where('status','inactive');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}
	
	function update_customer($agent_name,$last_name,$address,$city,$pincode,$country,$mobile,$cust_id)
{
	
	$data=array('cust_name'=>$agent_name,'last_name'=>$last_name,'cust_add'=>$address,'cust_city'=>$city,'cust_zip'=>$pincode,'cust_country'=>$country,'cust_mobile'=>$mobile);
		$this->db->where('cust_id',$cust_id);
		$this->db->update('customer_login',$data);
		
}	
	function get_req_pack()
	{
		$this->db->select('*');
		$this->db->from('package_request');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}
	function del_req($id)
	{
		$this->db->where('req_id',$id);
		$this->db->delete('package_request');
	}
	function get_admin_email()
		{
			$this->db->select('email_id');
			$this->db->from('website_settings');	
			$query=$this->db->get();	
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->row();				
			}
		}
	function check_username_valid($email,$user_type)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->where('user_type_id',$user_type);
		$query=$this->db->get();
	//	echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  $row=$query->row();
		  return $row->email;
		}	
	}
	function check_admin_valid($email)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('email',$email);
		$query=$this->db->get();
	//	echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  $row=$query->row();
		  return $row->email;
		}
	}
	function add_subadmin($userf_name,$userl_name,$email,$login,$passd,$status,$create,$date,$admin_type)
	{
		$data = array("first_name "=>$userf_name,"last_name"=>$userl_name,"email"=>$email,"password"=>$passd,"status"=>$status,"created_by"=>$create,"created_date"=>$date,"admin_type"=>$admin_type);
		$this->db->insert('admin',$data);
	}
	function get_subadmins()
	{
		$this->db->select('*');
		$this->db->from('admin_new');
		$this->db->where('user','admin');
		$query=$this->db->get();
	//	echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_admin_list()
	{
		$this->db->select('*');
		$this->db->from('admin_new');
		$query=$this->db->get();
	//	echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function get_subadmin($id)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('admin_id',$id);
		$query=$this->db->get();
	//	echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->row();
		}
	}
	function update_subadmin($id,$userf_name,$userl_name)
	{
		$data = array("first_name"=>$userf_name,"last_name"=>$userl_name);
		$this->db->where('admin_id',$id);
		$this->db->update('admin',$data);
	}
	function cardaccept_list()
	{
		$this->db->select('*');
		$this->db->from('sup_apart_cardaccept_list');
		$query=$this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function add_cardaccept_list($card)
	{
		$data = array('cards'=>$card);
		$this->db->insert('sup_apart_cardaccept_list',$data);
	}
	function update_cardaccept_list($card_id,$edit_card)
	{
		$data = array('cards'=>$edit_card);
		$this->db->where('sup_apart_cardaccept_list_id',$card_id);
		$this->db->update('sup_apart_cardaccept_list',$data);
	}
	function update_cardaccept_status($status,$id)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('status' => $status);
		$this->db->where('sup_apart_cardaccept_list_id',$id);
  		$this->db->update('sup_apart_cardaccept_list',$data);
		//echo $this->db->last_query();exit;
	}
	function delete_cardaccept($id)
	{
		$this->db->where('sup_apart_cardaccept_list_id',$id);
		$this->db->delete('sup_apart_cardaccept_list'); 
	}
	function facilities_list()
	{
		$this->db->select('*');
		$this->db->from('sup_apart_facilities_list');
		$query=$this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function add_facility_list($card)
	{
		$data = array('facilities'=>$card);
		$this->db->insert('sup_apart_facilities_list',$data);
	}
	function update_facility_list($card_id,$edit_card)
	{
		$data = array('facilities'=>$edit_card);
		$this->db->where('sup_apart_facilities_list_id',$card_id);
		$this->db->update('sup_apart_facilities_list',$data);
	}
	function update_facility_status($status,$id)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('status' => $status);
		$this->db->where('sup_apart_facilities_list_id',$id);
  		$this->db->update('sup_apart_facilities_list',$data);
		//echo $this->db->last_query();exit;
	}
	function update_dest_status($status,$id)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('status' => $status);
		$this->db->where('popular_destinations_id',$id);
  		$this->db->update('popular_destinations',$data);
		//echo $this->db->last_query();exit;
	}
	function frtupdate_facility_status($status,$id)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('front_status' => $status);
		$this->db->where('sup_apart_facilities_list_id',$id);
  		$this->db->update('sup_apart_facilities_list',$data);
		//echo $this->db->last_query();exit;
	}
	function featu_desti_status($status,$id,$cont)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('america' => $status);
		$this->db->where('featured_prop',$id);
		//$this->db->where('america',$cont);
  		$this->db->update('featured_prop',$data);
		//echo $this->db->last_query();exit;
	}
	function featu_desti_euro_status($status,$id,$cont)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('europe' => $status);
		$this->db->where('featured_prop',$id);
		//$this->db->where('america',$cont);
  		$this->db->update('featured_prop',$data);
		//echo $this->db->last_query();exit;
	}
	function featu_desti_east_status($status,$id,$cont)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('middle_east' => $status);
		$this->db->where('featured_prop',$id);
		//$this->db->where('america',$cont);
  		$this->db->update('featured_prop',$data);
		//echo $this->db->last_query();exit;
	}
	function featu_desti_asia_status($status,$id,$cont)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('asia' => $status);
		$this->db->where('featured_prop',$id);
		//$this->db->where('america',$cont);
  		$this->db->update('featured_prop',$data);
		//echo $this->db->last_query();exit;
	}
	function featu_desti_southasia_status($status,$id,$cont)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('southeastasia' => $status);
		$this->db->where('featured_prop',$id);
		//$this->db->where('america',$cont);
  		$this->db->update('featured_prop',$data);
		//echo $this->db->last_query();exit;
	}
	function featu_desti_oceania_status($status,$id,$cont)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('oceania' => $status);
		$this->db->where('featured_prop',$id);
		//$this->db->where('america',$cont);
  		$this->db->update('featured_prop',$data);
		//echo $this->db->last_query();exit;
	}
	function delete_facility($id)
	{
		$this->db->where('sup_apart_facilities_list_id',$id);
		$this->db->delete('sup_apart_facilities_list'); 
	}
	function delete_dest($id)
	{
		$this->db->where('popular_destinations_id',$id);
		$this->db->delete('popular_destinations'); 
	}
	function delete_fet($id)
	{
		$this->db->where('featured_prop',$id);
		$this->db->delete('featured_prop'); 
	}
	function facilities_list_per($start,$limit)
	{	
		$sel = "select * from sup_apart_facilities_list order by facilities Limit $start,$limit";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function popular_dest_per($start,$limit)
	{		
		$sel = "select * from popular_destinations order by order_disp  Limit $start,$limit";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function popular_fet_per($start)
	{		
		$sel = "select * from featured_prop Limit $start";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function roomfacilities_list()
	{
		$this->db->select('*');
		$this->db->from('sup_apart_roomfacilities_list');
		$query=$this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function roomfacilities_list_per($start,$limit)
	{	
		$sel = "select * from sup_apart_roomfacilities_list order by roomfacilities Limit $start,$limit";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function roomfacilities_list_filter($id)
	{
	//	echo "select * from sup_apart_roomfacilities_list where roomfacilities LIKE '".$id."%'";exit;
		$sel = "select * from sup_apart_roomfacilities_list where roomfacilities LIKE '".$id."%'";
		$query = $this->db->query($sel);
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function roomfacilities_list_per_filter($start,$limit,$id)
	{	
		$sel = "select * from sup_apart_roomfacilities_list where roomfacilities LIKE '".$id."%' order by roomfacilities Limit $start,$limit";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function view_users_per($start,$limit)
	{	
//	$query = $this->db->query('');
		$sel = "select * from user u inner join user_profile us on u.user_id = us.user_id inner join user_type ut on u.user_type_id = ut.user_type_id Limit $start,$limit";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function add_room_facility_list($card)
	{
		$data = array('roomfacilities'=>$card);
		$this->db->insert('sup_apart_roomfacilities_list',$data);
	}
	function update_room_facility_list($card_id,$edit_card)
	{
		$data = array('roomfacilities'=>$edit_card);
		$this->db->where('sup_apart_roomfacilities_list_id',$card_id);
		$this->db->update('sup_apart_roomfacilities_list',$data);
	}
	function update_timezone($card_id,$edit_card,$value,$edit_location)
	{
		$data = array('time'=>$edit_card,'value'=>$value,'time_location'=>$edit_location);
		$this->db->where('sup_apart_timezone_list_id',$card_id);
		$this->db->update('sup_apart_timezone_list',$data);
	}
	function update_room_facility_status($status,$id)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('status' => $status);
		$this->db->where('sup_apart_roomfacilities_list_id',$id);
  		$this->db->update('sup_apart_roomfacilities_list',$data);
		//echo $this->db->last_query();exit;
	}
	function update_timezone_status($status,$id)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('status' => $status);
		$this->db->where('sup_apart_timezone_list_id',$id);
  		$this->db->update('sup_apart_timezone_list',$data);
		//echo $this->db->last_query();exit;
	}
	function delete_room_facility($id)
	{
		$this->db->where('sup_apart_roomfacilities_list_id',$id);
		$this->db->delete('sup_apart_roomfacilities_list'); 
	}
	function delete_timezone($id)
	{
		$this->db->where('sup_apart_timezone_list_id',$id);
		$this->db->delete('sup_apart_timezone_list'); 
	}
	function timezone_list()
	{
		$this->db->select('*');
		$this->db->from('sup_apart_roomfacilities_list');
		$query=$this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function timezone_list_per($start,$limit)
	{	
		$sel = "select * from sup_apart_timezone_list order by time_location Limit $start,$limit";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function apartclass_type()
	{
		$this->db->select('*');
		$this->db->from('sup_apartclass_type');
		$query=$this->db->get();
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function apartclass_type_per($start,$limit)
	{	
		$sel = "select * from sup_apartclass_type order by apartclass Limit $start,$limit";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function apartclass_type_filter($id)
	{
		$sel = "select * from sup_apartclass_type where apartclass LIKE '".$id."%'  order by apartclass";
		$query = $this->db->query($sel);
		if($query->num_rows() =='')
		{ return '';
		}else{
		  return $query->result();
		}
	}
	function apartclass_type_per_filter($start,$limit,$id)
	{	
		$sel = "select * from sup_apartclass_type  where apartclass LIKE '".$id."%' order by apartclass Limit $start,$limit";
		$query = $this->db->query($sel);
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function add_apartclass_type($card)
	{
		$data = array('apartclass'=>$card);
		$this->db->insert('sup_apartclass_type',$data);
	}
	function update_apartclass_type($card_id,$edit_card)
	{
		$data = array('apartclass'=>$edit_card);
		$this->db->where('sup_apartclass_type_id',$card_id);
		$this->db->update('sup_apartclass_type',$data);
	}
	function update_room_apartclass_type_status($status,$id)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('status' => $status);
		$this->db->where('sup_apartclass_type_id',$id);
  		$this->db->update('sup_apartclass_type',$data);
		//echo $this->db->last_query();exit;
	}
	function update_frnroom_apartclass_type_status($status,$id)
	{
		//echo $status;echo $id;exit;
		if($status==0)
		{
			$status=1;
		}
		else
		{
			$status=0;
		}
		$data = array('front_status' => $status);
		$this->db->where('sup_apartclass_type_id',$id);
  		$this->db->update('sup_apartclass_type',$data);
		//echo $this->db->last_query();exit;
	}
	function delete_apartclass_type($id)
	{
		$this->db->where('sup_apartclass_type_id',$id);
		$this->db->delete('sup_apartclass_type'); 
	}
	function get_timezone()
	{
		$this->db->select('value');
		$this->db->from('sup_apart_timezone_list');
		$query=$this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 return $query->result();
		}
	}
	function add_timezone($card,$value,$location)
	{
		$data = array('time'=>$card,'value'=>$value,'time_location'=>$location);
		$this->db->insert('sup_apart_timezone_list',$data);
	}
	function add_static($menu,$sub_menu_about,$sub_menu_insider,$title,$test,$date)
	{
		if($sub_menu_about != '')
		{
			$this->db->select('static_pages_id');
			$this->db->from('static_pages');
			$this->db->where('sub_menu',$sub_menu_about);
			$query=$this->db->get();
			if($query->num_rows() == '')
			{
				$data = array('menu'=>$menu,'sub_menu'=>$sub_menu_about,'title'=>$title,'content'=>$test,'date'=>$date);
				$this->db->insert('static_pages',$data);
			}
			else
			{
			 	$val =  $query->row();
				$data = array('menu'=>$menu,'sub_menu'=>$sub_menu_about,'title'=>$title,'content'=>$test,'date'=>$date);
				$this->db->where('static_pages_id',$val->static_pages_id);
				$this->db->update('static_pages',$data);
			}
		}
		else if($sub_menu_insider != '')
		{
			$this->db->select('static_pages_id');
			$this->db->from('static_pages');
			$this->db->where('sub_menu',$sub_menu_insider);
			$query=$this->db->get();
			if($query->num_rows() == '')
			{
				$data = array('menu'=>$menu,'sub_menu'=>$sub_menu_insider,'title'=>$title,'content'=>$test,'date'=>$date);
				$this->db->insert('static_pages',$data);
			}
			else
			{
			 	$val =  $query->row();
				$data = array('menu'=>$menu,'sub_menu'=>$sub_menu_insider,'title'=>$title,'content'=>$test,'date'=>$date);
				$this->db->where('static_pages_id',$val->static_pages_id);
				$this->db->update('static_pages',$data);
			}
		}
		else if($menu == 'Contact Us')
		{
			$this->db->select('static_pages_id');
			$this->db->from('static_pages');
			$this->db->where('menu',$menu);
			$query=$this->db->get();
			if($query->num_rows() == '')
			{
				$data = array('menu'=>$menu,'title'=>$title,'content'=>$test,'date'=>$date);
				$this->db->insert('static_pages',$data);
			}
			else
			{
			 	$val =  $query->row();
				$data = array('menu'=>$menu,'title'=>$title,'content'=>$test,'date'=>$date);
				$this->db->where('static_pages_id',$val->static_pages_id);
				$this->db->update('static_pages',$data);
			}
		}
		else if($menu == 'FAQ')
		{
			$this->db->select('static_pages_id');
			$this->db->from('static_pages');
			$this->db->where('menu',$menu);
			$query=$this->db->get();
			if($query->num_rows() == '')
			{
				$data = array('menu'=>$menu,'title'=>$title,'content'=>$test,'date'=>$date);
				$this->db->insert('static_pages',$data);
			}
			else
			{
			 	$val =  $query->row();
				$data = array('menu'=>$menu,'title'=>$title,'content'=>$test,'date'=>$date);
				$this->db->where('static_pages_id',$val->static_pages_id);
				$this->db->update('static_pages',$data);
			}
		}
	}
	function view_static()
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$query=$this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 	return $query->result();
		}
	}
	function edit_static_page($id)
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('static_pages_id',$id);
		$query=$this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 	return $query->row();
		}
	}
	function update_static($menu,$sub_menu_about,$sub_menu_insider,$title,$test,$date,$id)
	{
			$data = array('title'=>$title,'content'=>$test,'date'=>$date);
			$this->db->where('static_pages_id',$id);
			$this->db->update('static_pages',$data);
	}
	function delete_static_page($id)
	{
		$this->db->where('static_pages_id',$id);
		$this->db->delete('static_pages'); 
	}
	function frontend_view($id)
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('static_pages_id',$id);
		$query=$this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 	return $query->row();
		}
	}
	function add_ext($menu,$title,$date)
	{
		if($menu != '')
		{
			$this->db->select('external_links_id');
			$this->db->from('external_links');
			$this->db->where('name',$menu);
			$query=$this->db->get();
			if($query->num_rows() == '')
			{
				$data = array('name'=>$menu,'url'=>$title,'date'=>$date);
				$this->db->insert('external_links',$data);
			}
			else
			{
			 	$val =  $query->row();
				$data = array('name'=>$menu,'url'=>$title,'date'=>$date);
				$this->db->where('external_links_id',$val->external_links_id);
				$this->db->update('external_links',$data);
			}
		}
	}
	function get_external_links()
	{
	
		$this->db->select('*');
		$this->db->from('external_links');
		$query=$this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 	return $query->result();
		}
	}
	function edit_ext_page($id)
	{
		$this->db->select('*');
		$this->db->from('external_links');
		$this->db->where('external_links_id',$id);
		$query=$this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 	return $query->row();
		}
	}
	function update_ext($menu,$title,$date,$id)
	{
			$data = array('url'=>$title,'date'=>$date);
			$this->db->where('external_links_id',$id);
			$this->db->update('external_links',$data);
	}
	function delete_ext_page($id)
	{
		$this->db->where('external_links_id',$id);
		$this->db->delete('external_links'); 
	}
	function add_city($title,$content,$date)
	{
		$data = array('city_name'=>$title,'content'=>$content,'date'=>$date);
		$this->db->insert('city_guides',$data);
	}
	function get_cities()
	{
		$this->db->select('*');
		$this->db->from('city_guides');
		$query=$this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 	return $query->result();
		}
	}
	function update_city_status($id,$status)
	{
		//echo $status;echo $id;exit;
		if($status == 0)
		{
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		$data = array('status' => $status);
		$this->db->where('city_guides_id',$id);
  		$this->db->update('city_guides',$data);
		//echo $this->db->last_query();exit;
	}
	function edit_city_page($id)
	{
		$this->db->select('*');
		$this->db->from('city_guides');
		$this->db->where('city_guides_id',$id);
		$query=$this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 	return $query->row();
		}
	}
	function update_city_guide($title,$test,$date,$id)
	{
			$data = array('city_name'=>$title,'content'=>$test,'date'=>$date);
			$this->db->where('city_guides_id',$id);
			$this->db->update('city_guides',$data);
	}
	function view_city($id)
	{
		$this->db->select('*');
		$this->db->from('city_guides');
		$this->db->where('city_guides_id',$id);
		$query=$this->db->get();
		if($query->num_rows() == '')
		{
			return '';
		}
		else
		{
		 	return $query->row();
		}
	}
	function delete_city_page($id)
	{
		$this->db->where('city_guides_id',$id);
		$this->db->delete('city_guides'); 
	}
	function get_static()
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('sub_menu',' About Us');
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
	function get_team()
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('sub_menu','The Team');
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
	function get_careers()
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('sub_menu','Careers');
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
	function get_insider()
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('sub_menu','Price Guarantee');
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
	function get_save()
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('sub_menu','Save up to 30%');
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
	function get_contact()
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('menu','Contact Us');
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
	function get_faq()
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('menu','FAQ');
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
		function get_solutions()
	{
		$this->db->select('*');
		$this->db->from('static_pages');
		$this->db->where('sub_menu','Our Solutions');
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
				return $query->row();
		}
	}
	function get_blog()
	{
		$this->db->select('url');
		$this->db->from('external_links');
		$this->db->where('name','Blog');
		$query=$this->db->get();
		
			if($query->num_rows() ==''){
				return '';
			}else{
				$val = $query->row();
				return $val->url;
			}
	}
		function get_help()
	{
		$this->db->select('url');
		$this->db->from('external_links');
		$this->db->where('name','Help');
		$query=$this->db->get();
		
			if($query->num_rows() ==''){
				return '';
			}else{
				$val = $query->row();
				return $val->url;
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
		function get_sup_email_sending($id)
		{
			$this->db->select('confirmation_mail');
			$this->db->from('sup_apart_profile');
			$this->db->where('sup_apart_list_id',$id);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			 $val =  $query->row();
			 return $val->confirmation_mail;
			}
		}
	function get_sup_email($id)
		{
			$this->db->select('email,fname');
			$this->db->from('sup_apartcontact_info');
			$this->db->where('sup_apartcontact_type_id',1);
			$this->db->where('sup_apart_list_id',$id);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			 return  $query->row();
			 
			}
		}
		function get_confrm_mail_reciept()
		{
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',10);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
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
		function get_booking_details1($id)
		{

			$this->db->select('*');
			$this->db->from('booking_ref');
			$this->db->where('booking_ref_no',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				//$val = $query->row();	
				//return $val->user_id;
				return $query->row();

			}

		}
		function get_confrm_mail()
		{
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',12);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
			}
		}
		function get_book_details12($id)
		{

			$this->db->select('*');
			$this->db->from('passenger_info');
			$this->db->where('booking_no',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				//$val = $query->row();	
				//return $val->user_id;
				return $query->row();

			}

		}
		function get_book_det($id)
		{

			$this->db->select('*');
			$this->db->from('guest_details');
			$this->db->where('passenger_info_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				//$val = $query->row();	
				//return $val->user_id;
				return $query->result();

			}

		}
		function get_accom_name($hotel_code)
		{

			$this->db->select('apartment_name');
			$this->db->from('sup_apart_list');
			$this->db->where('sup_apart_list_id',$hotel_code);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				//$val = $query->row();	
				//return $val->user_id;
				 $val = $query->row();
				return $val->apartment_name;

			}

		}
		function get_resend_voucher($id)
		{
			$query = $this->db->query("SELECT * FROM booking_ref sa inner join passenger_info sl on sa.booking_no = sl.booking_no WHERE  	booking_ref_no 	= '".$id."'");
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
			 
			}
		}
		/*function get_resend_voucher($id)
		{
			$query = $this->db->query("SELECT * FROM booking_ref sa inner join passenger_info sl on sa.booking_no = sl.booking_no WHERE  	booking_ref_no 	= '".$id."'");
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
			 
			}
		}*/
		/*function get_confrm_mail()
		{
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',12);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
			}
		}*/
	function get_bookings($stat)
	{
		if($stat == 1)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no");
		}
		else if($stat == 2)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no AND b.status = 'Cancel'");
		}
		else if($stat == 4)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_bookings1($class,$stat)
	{
		
		//echo "SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$class."'";exit;
		if($stat == 1)
		{
			
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apart_list s1 on s1.sup_apart_list_id = b.hotel_code WHERE s1.user_id = '".$class."'");
		}
		else if($stat == 2)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apart_list s1 on s1.sup_apart_list_id = b.hotel_code WHERE s1.user_id = '".$class."'  AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apart_list s1 on s1.sup_apart_list_id = b.hotel_code WHERE s1.user_id = '".$class."'  AND b.status = 'Cancel'");
		}
		else if($stat == 4)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apart_list s1 on s1.sup_apart_list_id = b.hotel_code WHERE s1.user_id = '".$class."'  AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_bookings2($id,$id1,$stat)
	{
		if($stat == 1)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apart_list s1 on s1.sup_apart_list_id = b.hotel_code WHERE s1.user_id = '".$id."'  AND b.booking_ref_no LIKE  '".$id1."%'");
		}
		else if($stat == 2)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apart_list s1 on s1.sup_apart_list_id = b.hotel_code WHERE s1.user_id = '".$id."'  AND b.booking_ref_no LIKE  '".$id1."%' AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.booking_ref_no LIKE  '".$id1."%' AND b.status = 'Cancel'");
		}
		else if($stat == 4)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code sup_apart_list s1 on s1.sup_apart_list_id = b.hotel_code WHERE s1.user_id = '".$id."'  AND b.booking_ref_no LIKE  '".$id1."%' AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_bookings3($id,$stat)
	{
		if($stat == 1)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.booking_ref_no LIKE  '".$id."%'");
		}
		else if($stat == 2)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.booking_ref_no LIKE  '".$id."%'  AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.booking_ref_no LIKE  '".$id."%'  AND b.status = 'Cancel'");
		}
		else if($stat == 4)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.booking_ref_no LIKE  '".$id."%'  AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_bookings4($id,$id1,$newdate,$newdate1,$stat)
	{
		if($stat == 1)
		{
			//echo "SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.booking_ref_no LIKE  '".$id1."%' AND b.voucher_date between '".$newdate."' AND '".$newdate1."'";exit;
		$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.booking_ref_no LIKE  '".$id1."%' AND b.voucher_date between '".$newdate."' AND '".$newdate1."'");
		}
		else if($stat == 2)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.booking_ref_no LIKE  '".$id1."%' AND b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.booking_ref_no LIKE  '".$id1."%' AND b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.status = 'Cancel'");
		}
		else if($stat == 4)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.booking_ref_no LIKE  '".$id1."%' AND b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_bookings7($newdate,$newdate1,$stat)
	{
		if($stat == 1)
		{
			//echo "SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.booking_ref_no LIKE  '".$id1."%' AND b.voucher_date between '".$newdate."' AND '".$newdate1."'";exit;
		$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE b.voucher_date between '".$newdate."' AND '".$newdate1."'");
		}
		else if($stat == 2)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE  b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.status = 'Cancel'");
		}
		else if($stat == 4)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_bookings8($id,$stat)
	{
		if($stat == 1)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.booking_ref_no LIKE  '".$id."%'");
		}
		else if($stat == 2)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.booking_ref_no LIKE  '".$id."%'  AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.booking_ref_no LIKE  '".$id."%'  AND b.status = 'Cancel'");
		}
		else if($stat == 4)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.booking_ref_no LIKE  '".$id."%'  AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_bookings10()
	{
		$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no");
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function view_agent_bookings($id)
	{
		$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.agent_id='".$id."'" );
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function view_agent_bookings_dates_status($id,$newdate,$newdate1,$stat)
	{
		if($stat == 1)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.agent_id='".$id."'");
		}
		else if($stat == 2)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.agent_id='".$id."' AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE  b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.agent_id='".$id."' AND b.status = 'Cancel'");
		} 
		else if($stat == 4)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.agent_id='".$id."' AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function view_agent_bookings__status($id,$stat)
	{
		if($stat == 1)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.agent_id='".$id."'");
		}
		else if($stat == 2)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.agent_id='".$id."' AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE   b.agent_id='".$id."' AND b.status = 'Cancel'");
		} 
		else if($stat == 4)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE  b.agent_id='".$id."' AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function view_cust_bookings($id)
	{
		$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.customer_id='".$id."'" );
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function view_cust_bookings_dates_status($id,$newdate,$newdate1,$stat)
	{
		if($stat == 1)
		{
		
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.customer_id='".$id."'");
		}
		else if($stat == 2)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.customer_id='".$id."' AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE  b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.customer_id='".$id."' AND b.status = 'Cancel'");
		} 
		else if($stat == 4)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.customer_id='".$id."' AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function view_cust_bookings__status($id,$stat)
	{
		if($stat == 1)
		{
			$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.customer_id='".$id."'");
		}
		else if($stat == 2)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE b.customer_id='".$id."' AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE   b.customer_id='".$id."' AND b.status = 'Cancel'");
		} 
		else if($stat == 4)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no WHERE  b.customer_id='".$id."' AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_bookings9($id)
	{ //echo $stat; echo $id;exit;
	
			//echo "SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' ";exit;
		$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' ");
		
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_bookings5($id,$newdate,$newdate1,$stat)
	{
		if($stat == 1)
		{
		$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.voucher_date between '".$newdate."' AND '".$newdate1."'");
		}
		else if($stat == 2)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."'  AND b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.status = 'Available'");
		}
		else if($stat == 3)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.status = 'Cancel'");
		}
		else if($stat == 4)
		{
				$query = $this->db->query("SELECT * FROM booking_ref as b inner join passenger_info as p on p.booking_no = b.booking_no inner join sup_apart_profile s on s.sup_apart_list_id = b.hotel_code inner join sup_apartclass_type s1 on s1.sup_apartclass_type_id = s.sup_apartclass_type_id WHERE s1.sup_apartclass_type_id = '".$id."' AND b.voucher_date between '".$newdate."' AND '".$newdate1."' AND b.status = 'OnRequest'");
		}
			if($query->num_rows() =='')
			{
				 return '';
			}
			else
			{
				 return $query->result();
			}
	}
	function get_book_status($id)
	{
		$this->db->select('status');
		$this->db->from('booking_ref');
		$this->db->where('booking_ref_no',$id);
		$query=$this->db->get();
	//	echo $this->db->last_query();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			 $val = $query->row();
			 return $val->status;
		}
	}
	function Update_cancel_status($statusvalue,$id)
	{
		$data=array('status'=>$statusvalue);
		$this->db->where('booking_ref_no',$id);
		$this->db->update('booking_ref',$data);	
	}
	function view_emails()
	{
		$this->db->select('*');
		$this->db->from('email_types');
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
	function add_email_type($add_email_type,$add_email_code)
	{
		$data=array('email_title'=>$add_email_type,'email_code'=>$add_email_code);
		$this->db->insert('email_types',$data);	
	}
	function edit_email_type($id)
	{
		$this->db->select('*');
		$this->db->from('email_types');
		$this->db->where('email_types_id',$id);
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
	function get_email_content($id)
	{
		$this->db->select('*');
		$this->db->from('email_contents');
		$this->db->where('email_types_id',$id);
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
	function edit_email_type_content($add_email_type,$add_email_code,$id)
	{
		$data=array('email_title'=>$add_email_type,'email_code'=>$add_email_code);
		$this->db->where('email_types_id',$id);
		$this->db->update('email_types',$data);	
	}
	function delete_email_type($id)
	{
		$this->db->where('email_types_id', $id);
		$this->db->delete('email_types');
	}
	function add_email_content($email_type_id,$title,$subject,$html_content,$footer)
	{
		$this->db->select('email_contents_id');
		$this->db->from('email_contents');
		$this->db->where('email_types_id',$email_type_id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() =='')
		{
			$data=array('email_types_id'=>$title,'email_subject'=>$subject,'html_content'=>$html_content,'footer'=>$footer);
			$this->db->insert('email_contents',$data);	
		}
		else
		{
			  $val =  $query->row();
			  $data=array('email_subject'=>$subject,'html_content'=>$html_content,'footer'=>$footer);
			  $this->db->where('email_types_id',$email_type_id);
			  $this->db->update('email_contents',$data);	
			  
		}	
	}
	function update_comm($comm,$comm_status)
	{
		$this->db->select('admin_commission_id');
		$this->db->from('admin_commission');
		$query=$this->db->get();
		if($query->num_rows() =='')
		{
			$data=array('gta'=>$comm,'status'=>$comm_status);
			$this->db->insert('admin_commission',$data);	
		}
		else
		{
			  $val =  $query->row();
			$data=array('gta'=>$comm,'status'=>$comm_status);
			  $this->db->where('admin_commission_id',$val->admin_commission_id);
			  $this->db->update('admin_commission',$data);	
			  
		}	
	}
	function admin_commission()
	{
		$this->db->select('*');
		$this->db->from('admin_commission');
		$this->db->where('admin_commission_id',1);
		$query=$this->db->get();
		if($query->num_rows() =='')
		{
			return '';
		}
		else
		{
			  return  $query->row();
			
			  
		}	
	}
	function view_prop($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_list');
		//$this->db->join('country','country.country_id = sup_apart_list.country_id','inner');
		$this->db->where('user_id',$id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function get_city($city_code)
		{
			$this->db->select('city');
			$this->db->from('api_hotels_city');
			$this->db->where('gta',$city_code);
			$query=$this->db->get();
			
			if($query->num_rows() ==''){
				return '';
			}else{
				$val =  $query->row();
				return $val->city;
			}	
		}	
		function get_detail_ref($id)
		{
			$query = $this->db->query("SELECT * FROM booking_ref sa inner join passenger_info sl on sa.booking_no = sl.booking_no WHERE  	booking_ref_no 	= '".$id."'");
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
			 
			}
		}
		function get_confrm_mail_req()
		{
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',11);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
			}
		}
		function update_cancel_booking($id)
		{
			$data = array("status"=>'Cancel');
			$this->db->where('booking_ref_no',$id);
			$this->db->update('booking_ref',$data);
		}
		function cancel_info_mail()
		{
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',15);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
			}
		}
		function get_sup_name($id)
		{
			$this->db->select('email,fname');
			$this->db->from('sup_apartcontact_info');
			$this->db->where('sup_apartcontact_type_id',1);
			$this->db->where('sup_apart_list_id',$id);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			 return  $query->row();
			}
		}
		function get_confrm_mail_sup()
		{
			$this->db->select('*');
			$this->db->from('email_contents');
			$this->db->where('email_types_id',14);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			  return $query->row();
			}
		}
		function update_request_booking($id)
		{
			$data = array("status"=>'Available');
			$this->db->where('booking_ref_no',$id);
			$this->db->update('booking_ref',$data);
		}
		function get_rate_id($type,$roomcode)
		{
			$this->db->select('sup_apart_rateplan_id');
			$this->db->from('sup_apart_rateplan');
			$this->db->where('sup_apart_category_id',$roomcode);
			$this->db->where('rate_name',$type);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			  $val = $query->row();
			  return $val->sup_apart_rateplan_id;
			}
		}
		function update_maintain_month($rate_id,$date,$cnt_room,$apt_id)
		{
			$this->db->select('available');
			$this->db->from('sup_apart_maintain_month');
			$this->db->where('sup_apart_rateplan_id',$rate_id);
			$this->db->where('sup_apart_list_id',$apt_id);
			$this->db->where('date',$date);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ 
				$data1 = array('available'=>$cnt_room);
				$this->db->where('sup_apart_rateplan_id',$rate_id);
				$this->db->where('sup_apart_list_id',$apt_id);
				$this->db->where('date',$date);
				$this->db->update('sup_apart_maintain_month',$data1);
			}
			else
			{
			 	$val =   $query->row();
			 	$avail = $val->available;
				$up_avail = $avail + $cnt_room;
				$data1 = array('available'=>$up_avail);
				$this->db->where('sup_apart_rateplan_id',$rate_id);
				$this->db->where('sup_apart_list_id',$apt_id);
				$this->db->where('date',$date);
				$this->db->update('sup_apart_maintain_month',$data1);
			}
		}
		function update_maintain_month_add($rate_id,$date,$cnt_room,$apt_id)
		{
			$this->db->select('available');
			$this->db->from('sup_apart_maintain_month');
			$this->db->where('sup_apart_rateplan_id',$rate_id);
			$this->db->where('sup_apart_list_id',$apt_id);
			$this->db->where('date',$date);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ 
				return '';
			}
			else
			{
			 	$val =   $query->row();
			 	$avail = $val->available;
				$up_avail = $avail - $cnt_room;
				$data1 = array('available'=>$up_avail);
				$this->db->where('sup_apart_rateplan_id',$rate_id);
				$this->db->where('sup_apart_list_id',$apt_id);
				$this->db->where('date',$date);
				$this->db->update('sup_apart_maintain_month',$data1);
			}
		}
		function newsletter()
		{
			$this->db->select('*');
			$this->db->from('subscribed_users');
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
		function delete_prop($user_id,$prop_id)
		{
			$this->db->where('user_id',$user_id);
			$this->db->where('sup_apart_list_id',$prop_id);
			$this->db->delete('sup_apart_list'); 
		}
		function payment_details($payment,$currency)
		{
			$data = array('payment_value'=>$payment,'currency'=>$currency);
			$this->db->select('payment_id ');
			$this->db->from('payment');
			$this->db->where('payment_id',1);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ 
				$this->db->insert('payment',$data);
			}
			else
			{
				$this->db->where('payment_id',1);
			 	$this->db->update('payment',$data);
				
			}
			
		}
		function get_payment()
		{
			$this->db->select('*');
			$this->db->from('payment');
			$this->db->where('payment_id',1);
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
		function update_total_pop($id,$cnt)
		{
			$data = array('total'=>$cnt);
			$this->db->where('popular_destinations_id',$id);
			$this->db->update('popular_destinations',$data);
		}
		function get_countrycode($name)
		{
			$this->db->select('countrycode');
			$this->db->from('countires');
			$this->db->where('name',$name);
			$this->db->where('languagecode','en');
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				$val =   $query->row();
				return $val->countrycode;
			}
		}
		function getadminmarkup($id)
		{
			$this->db->select('*');
			$this->db->from('commision_new');
			$this->db->where('commision_id',$id);
			$query = $this->db->get();
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				$val =   $query->row();
				return $val;
			}
		}
		function get_phonenumber($id)
		{
			$this->db->select('*');
			$this->db->from('sup_apartcontact_info');
			$this->db->where('sup_apart_list_id',$id);
			$this->db->where('sup_apartcontact_type_id',1);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();
				return $val->phone;
			}
		}
		function gt_hotel_address($id)
		{
			$this->db->select('address');
			$this->db->from('booking_ref');
			$this->db->where('booking_no',$id);
			$query = $this->db->get();
			if($query->num_rows() =='')
			{ return '';
			}else{
			 $val =  $query->row();
			 return $val->address;
			}
		}
		function get_allroomguests($id)
		{
			$this->db->select('*');
			$this->db->from('guest_details');
			$this->db->where('passenger_info_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				return $query->result();
			}
		}
		function get_con_pdf($id)
		{
			$this->db->select('cnfm_pdf');
			$this->db->from('booking_ref');
			$this->db->where('booking_ref_no',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();
				return $val->cnfm_pdf;
			}
		}
		function get_special_req($id)
		{
			$this->db->select('*');
			$this->db->from('guest_details');
			$this->db->where('passenger_info_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =  $query->row();
				return $val->request;
			}

		}
		function get_remarks($type,$roomcode)
		{
			$this->db->select('rate_remarks');
			$this->db->from('sup_apart_rateplan');
			$this->db->where('rate_name',$type);
			$this->db->where('sup_apart_category_id',$roomcode);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				
				$val = $query->row();
				return $val->rate_remarks;

			}

		}
		function booking_availability_without_dates_pop($city,$apt_id_activate)
		{
		$query=$this->db->query("SELECT * FROM booking_gethotels where city_id = '".$city."' AND hoteltype_id IN(".$apt_id_activate.") AND minrate != 0 ORDER BY preferred DESC");
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				return   $query->result();
			}
		}
		function crs_availability_without_dates($city)
	{
		$query = $this->db->query("SELECT * FROM sup_apart_list WHERE city = '".$city."' AND status = 1");
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			return  $query->result();
		}
	}
	function get_cntryname($id)
	{
		$this->db->select('name');
		$this->db->from('country');
		$this->db->where('country_id',$id);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$val = $query->row();
			return $val->name;
		}
	}
	function get_min_cost($id)
		{
			$this->db->select('min(rate) as minimum');
			$this->db->from('sup_apart_maintain_month');
			$this->db->where('sup_apart_list_id',$id);
			$query1 = $this->db->get();
			//echo $this->db->last_query();exit;
				if($query1->num_rows() ==''){
				return '';			
				}else{
					$val1 = $query1->row();
					return $val1->minimum;
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
	function get_comm_val($id)
	{
		$this->db->select('*');
		$this->db->from('commision_new');
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
	function get_apt_fac($id)
	{
		$this->db->select('*');
		$this->db->from('sup_apart_facilities');
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
	function insert_search_result_crs($api,$city,$cntry_name,$sup_apart_list_id,$itemVal,$star_rate,$pernight11,$tot_cost_val,$unit_name,$rate_plan,$breakfast,$adult_count,$address,$image,$night,$fac1,$roomfac1,$latitude,$longitude,$common_commission_id,$cat_num,$status,$comm,$capacity,$currency,$can_cost,$charge_nights,$can_time,$district_id,$class_type)
	{
		//echo $tot_cost_val;exit;
		$data = array('api_name'=>$api,'city_name'=>$city,'country_name'=>$cntry_name,'hotel_id'=>$sup_apart_list_id,'hotel_name'=>$itemVal,'star_rate'=>$star_rate,'nightperroom'=>$pernight11,'cost_value'=>$tot_cost_val,'room_type'=>$unit_name,'plan_type'=>$rate_plan,'nopax'=>$adult_count,'location'=>$address,'commission'=>$common_commission_id,'image_url'=>$image,'noofdays'=>$night,'amenities'=>$fac1,'room_amenities'=>$roomfac1,'latitude'=>$latitude,'longitude'=>$longitude,'room_catecode'=>$cat_num,'status'=>$status,'commission'=>$comm,'capacity'=>$capacity,'cost_type'=>$currency,'cancellation_night'=>$charge_nights,'cancellation_value'=>$can_cost,'cancellation_before_days'=>$can_time,'inclusion'=>$breakfast,'district_id'=>$district_id,'room_usecode'=>$class_type,'min_price'=>$tot_cost_val,'max_price'=>$tot_cost_val,'date'=>date('Y-m-d'));
		$this->db->insert('search_result_pop',$data);
		
	}
	function insert_booking_availability_without_dates($hotel_id,$address,$city_id,$hotel_name,$countrycode,$sec_res,$minrate,$class,$latitude,$longitude,$img,$currencycode,$hoteltype_id,$all,$class_type,$district_id,$bookk_fac_all,$preferred)
		{
			$data = array('api_name'=>'book','city_name'=>$city_id,'country_name'=>$countrycode,'hotel_id'=>$hotel_id,'hotel_name'=>$hotel_name,'location'=>$address,'criteria_id'=>$sec_res,'nightperroom'=>$minrate,'star_rate'=>$class,'latitude'=>$latitude,'longitude'=>$longitude,'image_url'=>$img,'cost_type'=>$currencycode,'room_code'=>$hoteltype_id,'amenities'=>$all,'room_usecode'=>$class_type,'status'=>'Available','district_id'=>$district_id,'price_breakup'=>$bookk_fac_all,'preferred'=>$preferred);
			$this->db->insert('search_result_pop',$data);
		}
		function get_class_type_id($id)
		{
			$query = $this->db->query("SELECT * FROM sup_apart_profile sa inner join sup_apartclass_type sl on sa.sup_apartclass_type_id 	 = sl.sup_apartclass_type_id WHERE sup_apart_list_id = '".$id."'");
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
		function get_images($id)
	{
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
	function get_booking_city($id)
	{
		$this->db->select('name');
		$this->db->from('booking_cities');
		$this->db->where('city_id',$id);
		$query  = $this->db->get();
		if($query->num_rows() =='')
		{
			return '';			
		}
		else
		{
			$val =  $query->row();				
			return $val->name;
		}
		
	}
	function get_book_image($hotel_id)
		{
			$this->db->select('url_original');
			$this->db->from('booking_gethotelphotos');
			$this->db->where('hotel_id',$hotel_id);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
				$val =  $query->row();
				return $val->url_original;
			}
		}
		function get_amenties($id)
		{
			$this->db->select('*');
			$this->db->from('booking_gethotelfacilities');
			$this->db->where('hotel_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				return  $query->result();	
			}	
		}
		function get_class_type_booking($id)
	{
		
		$this->db->select('sup_apartclass_type_id');
		$this->db->from('sup_apartclass_type');
		$this->db->where('booking_type_id_new',$id);
		$query  = $this->db->get();
		if($query->num_rows() =='')
		{
			return '';			
		}
		else
		{
			$val = $query->row();				
			return $val->sup_apartclass_type_id;
			
		}
	}
	function get_booking_nodates_fac($id)
		{
			$this->db->select('hotelfacilitytype_id');
			$this->db->from('booking_gethotelfacilities');
			$this->db->where('hotel_id',$id);
			$query = $this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				return $query->result();	
			}
		}
		function get_book_facility_name($id)
		{
			$this->db->select('sup_apart_facilities_list_id');
			$this->db->from('sup_apart_facilities_list');
			$this->db->where('booking_type_fac_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';			
			}
			else
			{
				$val =   $query->row();	
				return $val->sup_apart_facilities_list_id;
			}	
		}
		function delete_pop($id)
		{
			$this->db->where('city_name', $id);
			$this->db->delete('search_result_pop'); 
		}
		function get_all_pic()
	{
		$this->db->select('*');
		$this->db->from('slider_images');
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			return $query->result();
		}

	}
	function upload_picture($img,$title,$sentence,$url,$action)
	{
		$data = array('image_name'=>$img,'Ttile'=>$title,'Sentence'=>$sentence,'URL'=>$url,'action'=>$action);
		
		$this->db->insert('slider_images',$data);
	}
	function add_check_pictures($checkval,$comments)
	{
		$data = array('image_title'=>$comments,'image_status'=>1);
		$this->db->where('slider_images_id',$checkval);
		$this->db->update('slider_images',$data);
	}
	function update_uncheck_pictures()
	{
		$data = array('image_status'=>0);
		$this->db->update('slider_images',$data);
	}
	function delete_picture($id)
	{
		$this->db->select('image_name');
		$this->db->from('slider_images');
		$this->db->where('slider_images_id',$id);
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
		$this->db->where('slider_images_id',$id);
		$this->db->delete('slider_images');	
	}
	function add_banner_image($image,$image_text,$image_url)
		{
			$data=array('image_name'=>$image,'link_text'=>$image_text,'image_url'=>$image_url);
			$this->db->insert('banner_images',$data);
		}
		function banner_images()
		{
			$this->db->select('*');
			$this->db->from('banner_images');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			

			}else{
				return $query->result();				
			}
		}
		function banner_image($id)
		{
			$this->db->select('*');
			$this->db->from('banner_images');
			$this->db->where('id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->result();				
			}
		}
		function update_banner_image($id,$image,$image_text,$image_url)
		{
			$data=array('image_name'=>$image,'link_text'=>$image_text,'image_url'=>$image_url);
			$this->db->where('id',$id);
			$this->db->update('banner_images',$data);
		}
		function bottom_images()
		{
			$this->db->select('*');
			$this->db->from('bottom_images');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->row();				
			}
		}
		function add_bottom_images($image,$image2,$image3,$image4)
		{
			$data=array('image'=>$image,'image2'=>$image2,'image3'=>$image3,'image4'=>$image4); 
			$this->db->update('bottom_images',$data);
		}
		function update_markup_new($payment_gateway,$gateway_type,$hotel,$hotel_type,$holidays,$holiday_type,$football_type,$football)
		{
			$data = array('payment_gateway'=>$payment_gateway,'gateway_type'=>$gateway_type,'hotel'=>$hotel,'hotel_type'=>$hotel_type,'holidays'=>$holidays,'holiday_type'=>$holiday_type,'football_type'=>$football_type,'football'=>$football);
			$this->db->update('markup',$data);
		}
		function update_markup($payment_gateway,$bus,$car,$hotel,$air_india,$jetairways,$jetlite,$kingfisher,$airindia_express,$goair,$indigo,$spicjet,$air_india_inter,$jetairways_inter,$jetlite_inter,$kingfisher_inter,$airindia_express_inter,$goair_inter,$indigo_inter,$mdlr,$paramount,$spicejet,$other_flights,$holidays,$gateway_type,$car_type,$hotel_type,$holiday_type,$air_india_type,$jetairways_type,$jetlite_type,$kingfisher_type,$airindia_express_type,$goair_type,$indigo_type,$spicjet_type,$air_india_inter_type,$jetairways_inter_type,$jetlite_inter_type,$kingfisher_inter_type,$airindia_express_inter_type,$goair_inter_type,$indigo_inter_type,$mdlr_type,$spicejet_type ,$other_flights_type)
	{
		//echo $hotel_type; exit;
		$data = array('payment_gateway'=>$payment_gateway,'bus'=>$bus,'car'=>$car,'hotel'=>$hotel,'air_india'=>$air_india,'jetairways'=>$jetairways,'jetlite'=>$jetlite,'kingfisher'=>$kingfisher,'airindia_express'=>$airindia_express,'go_air'=>$goair,'indigo'=>$indigo,'spice_jet'=>$spicjet,'air_india_inter'=>$air_india_inter,'jetairways_inter'=>$jetairways_inter,'jetlite_inter'=>$jetlite_inter,'kingfisher_inter'=>$kingfisher_inter,'air_india_express_inter'=>$airindia_express_inter,'goair_inter'=>$goair_inter,'indigo_inter'=>$indigo_inter,'mdlr_inter'=>$mdlr,'paramount_inter'=>$paramount,'spice_jet_inter'=>$spicejet,'other_flight'=>$other_flights,'holidays'=>$holidays,'gateway_type'=>$gateway_type,'car_type'=>$car_type,'hotel_type'=>$hotel_type,'holiday_type'=>$holiday_type,'air_india_type'=>$air_india_type,'jetairways_type'=>$jetairways_type,'jetlite_type'=>$jetlite_type,'kingfisher_type'=>$kingfisher_type,'airindia_express_type'=>$airindia_express_type,'goair_type'=>$goair_type,'indigo_type'=>$indigo_type,'spicjet_type'=>$spicjet_type,'air_india_inter_type'=>$air_india_inter_type,'jetairways_inter_type'=>$jetairways_inter_type,'jetlite_inter_type'=>$jetlite_inter_type,'kingfisher_inter_type'=>$kingfisher_inter_type,'airindia_express_inter_type'=>$airindia_express_inter_type,'goair_inter_type'=>$goair_inter_type,'indigo_inter_type'=>$indigo_inter_type,'mdlr_type'=>$mdlr_type,'spicejet_type'=>$spicejet_type,'other_flights_type'=>$other_flights_type);
		$this->db->update('markup',$data);
	}
	function update_rebate($payment_gateway,$bus,$car,$hotel,$air_india,$jetairways,$jetlite,$kingfisher,$airindia_express,$goair,$indigo,$spicjet,$air_india_inter,$jetairways_inter,$jetlite_inter,$kingfisher_inter,$airindia_express_inter,$goair_inter,$indigo_inter,$mdlr,$paramount,$spicejet,$other_flights,$holidays,$markup_type)
	{
		$data = array('payment_gateway'=>$payment_gateway,'bus'=>$bus,'car'=>$car,'hotel'=>$hotel,'air_india'=>$air_india,'jetairways'=>$jetairways,'jetlite'=>$jetlite,'kingfisher'=>$kingfisher,'airindia_express'=>$airindia_express,'go_air'=>$goair,'indigo'=>$indigo,'spice_jet'=>$spicjet,'air_india_inter'=>$air_india_inter,'jetairways_inter'=>$jetairways_inter,'jetlite_inter'=>$jetlite_inter,'kingfisher_inter'=>$kingfisher_inter,'air_india_express_inter'=>$airindia_express_inter,'goair_inter'=>$goair_inter,'indigo_inter'=>$indigo_inter,'mdlr_inter'=>$mdlr,'paramount_inter'=>$paramount,'spice_jet_inter'=>$spicejet,'other_flight'=>$other_flights,'holidays'=>$holidays,'markup_type'=>$markup_type);
		$this->db->update('rebate',$data);
	}
	function get_markup()
		{
			$this->db->select('*');
			$this->db->from('markup');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->row();				
			}
		}
		function get_rebate()
		{
			$this->db->select('*');
			$this->db->from('rebate');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->row();				
			}
		}
		function get_agents()
		{
			$this->db->select('*');
			$this->db->from('agents');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->result();				
			}
		}
		function get_agents_det($id)
		{
			$this->db->select('*');
			$this->db->from('agents');
			$this->db->where('agent_id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->row();				
			}	
		}
		function cities()
		{
			$this->db->select('*');
			$this->db->from('hotelspro_cities');
			$this->db->where('Country','India');
			$this->db->order_by('City','asc');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->result();				
			}
		}
		function update_member_crdit($id,$balance,$remarks,$amount)
		{
			$data = array('account_balance'=>$balance,'remarks'=>$remarks,'credit'=>$amount);
			$this->db->where('agent_id',$id);
			$this->db->update('agents',$data);
		}
		function search_book_hotel($status,$transaction_id,$city,$book_from,$book_to)
		{
			$query = $this->db->query("select * from hotel_booking_info u inner join transaction_details us on u.hotel_booking_info_id  = us.hotel_booking_id ");
			//echo $this->db->last_query(); exit;
			if($query->num_rows() =='')
			{
				return '';
			}
			else
			{
				return $query->result();
			}
		}
		function franchise_list()
		{
			$this->db->select('*');
			$this->db->from('franchise');
			//$this->db->order_by('City','asc');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->result();				
			}
		}
		function franchise_edit($id)
		{
			$this->db->select('*');
			$this->db->from('franchise');
			$this->db->where('id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';			
			}else{
				return $query->row();				
			}
		}
		function update_franchise($franchise_name,  $agent_name, $org_name, $nearest_bra, $land_line, $fax, $mobile_no,  $website_add, $other_det, $off_add, $country, $bank_name, $bank_acc, $pan_no, $pan_name, $service_tax, $details, $gds,$currency,$id)
		{
		
		$data = array('franchise_name'=>$franchise_name,  'agent_name'=>$agent_name, 'org_name'=>$org_name, 'nearest_bra'=>$nearest_bra, 'land_line'=>$land_line, 'fax'=>$fax, 'mobile_no'=>$mobile_no, 'website_add'=>$website_add, 'other_det'=>$other_det, 'off_add'=>$off_add, 'country'=>$country, 'bank_name'=>$bank_name, 'bank_acc'=>$bank_acc, 'pan_no'=>$pan_no, 'pan_name'=>$pan_name, 'service_tax'=>$service_tax, 'details'=>$details, 'gds'=>$gds, 'currency'=>$currency);
		//echo "<pre>";print_r($data);exit;
		$this->db->where('id',$id);
			$this->db->update('franchise',$data);
		}
		function delete_franchise($id)
		{
			$this->db->where('id',$id);
			$this->db->delete('franchise');
		}
		function insert_excursion($ex_type,$ex_location,$ex_name,$ex_duration,$ex_details,$ex_price,$ex_product_code,$ex_video,$ex_shedule_details,$ex_price_infant,$ex_price_child,$ex_price_adult, $ex_price_excludes, $ex_additional_details,$ex_more_det,$img1,$ex_diving,$ex_surfing,$added_by,$country, $cancel_policy,$term_cond,$holiday_theme,$duration_hours,$price_fake,$highlight,$inclusion,$exclusion,$transportation,$itinary_basic,$holiday_plan)
		{
			$data = array('ex_type'=>$ex_type,'ex_diving'=>$ex_diving,'ex_surfing'=>$ex_surfing,'ex_location'=>$ex_location,'ex_name'=>$ex_name,'ex_duration'=>$ex_duration,'ex_detail'=>$ex_details,'ex_price'=>$ex_price,'ex_productcode'=>$ex_product_code,'ex_video'=>$ex_video,'ex_shedule'=>$ex_shedule_details,'ex_priceinfant'=>$ex_price_infant,'ex_pricechild'=>$ex_price_child,'ex_priceadult'=>$ex_price_adult,'ex_additionaldet'=>$ex_additional_details,'ex_moredet'=>$ex_more_det,'ex_mainimage'=>$img1, 'added_by'=>$added_by,'country'=>$country,'cancel_policy'=>$cancel_policy,'term_cond'=>$term_cond,'holiday_theme'=>$holiday_theme,'duration_hours'=>$duration_hours,'price_fake'=>$price_fake,'highlight'=>$highlight,'inclusion'=>$inclusion,'exclusion'=>$exclusion,'transportation'=>$transportation,'itinary_basic'=>$itinary_basic,'holiday_plan'=>$holiday_plan);
			//echo "<pre>";print_r($data);exit;
			$this->db->insert('activities',$data);
			return $this->db->insert_id();
		}
		function update_holiday($ex_id,$ex_type,$ex_location,$ex_name,$ex_duration,$ex_details,$ex_price,$ex_product_code,$ex_video,$ex_shedule_details,$ex_price_infant,$ex_price_child,$ex_price_adult, $ex_price_excludes, $ex_additional_details,$ex_more_det,$img1,$ex_diving,$ex_surfing,$added_by,$country,$cancel_policy,$term_cond,$holiday_theme,$duration_hours,$price_fake,$highlight,$inclusion,$exclusion,$transportation,$itinary_basic,$holiday_plan)
		{
			$data = array('ex_type'=>$ex_type,'ex_diving'=>$ex_diving,'ex_surfing'=>$ex_surfing,'ex_location'=>$ex_location,'ex_name'=>$ex_name,'ex_duration'=>$ex_duration,'ex_detail'=>$ex_details,'ex_price'=>$ex_price,'ex_productcode'=>$ex_product_code,'ex_video'=>$ex_video,'ex_shedule'=>$ex_shedule_details,'ex_priceinfant'=>$ex_price_infant,'ex_pricechild'=>$ex_price_child,'ex_priceadult'=>$ex_price_adult,'ex_additionaldet'=>$ex_additional_details,'ex_moredet'=>$ex_more_det,'ex_mainimage'=>$img1, 'added_by'=>$added_by,'country'=>$country,'cancel_policy'=>$cancel_policy,'term_cond'=>$term_cond,'holiday_theme'=>$holiday_theme,'duration_hours'=>$duration_hours,'price_fake'=>$price_fake,'highlight'=>$highlight,'inclusion'=>$inclusion,'exclusion'=>$exclusion,'transportation'=>$transportation,'itinary_basic'=>$itinary_basic,'holiday_plan'=>$holiday_plan);
			$this->db->where('excursion_id',$ex_id);
			$this->db->update('activities',$data);
			
		}
		function insert_holiday_hotel($ex_id,$hotel_name,$hotel_city,$duration,$duration_hours,$star_rate,$meal_plan,$hotel_facility,$type)
		{
			$data = array('ex_id'=>$ex_id,'hotel_name'=>$hotel_name,'hotel_city'=>$hotel_city,'duration'=>$duration,'duration_hours'=>$duration_hours,'star_rate'=>$star_rate,'meal_plan'=>$meal_plan,'hotel_facility'=>$hotel_facility,'type'=>$type);
			$this->db->insert('holiday_hotel',$data);
			return $this->db->insert_id();
		}
		function insert_holiday_destination($ex_id,$destination_name,$destination_det)
		{
			$data = array('ex_id'=>$ex_id,'destination_name'=>$destination_name,'destination_det'=>$destination_det);
			$this->db->insert('holiday_destination',$data);
			return $this->db->insert_id();
		}
		function add_banner_holidaydest($img_banner,$dest_id,$ex_id)
		{
			$data = array('img_banner'=>$img_banner,'dest_id'=>$dest_id,'ex_id'=>$ex_id);
			$this->db->insert('holiday_dest_images',$data);
		}
		function add_banner_holidayhotel($img_banner,$hotel_id,$ex_id)
		{
			$data = array('img_banner'=>$img_banner,'hotel_id'=>$hotel_id,'ex_id'=>$ex_id);
			$this->db->insert('holiday_hotel_images',$data);
		}
		function get_holiday_hotels($ex_id)
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
		function get_holiday_dest($ex_id)
		{
			$this->db->select('*');
			$this->db->from('holiday_destination');
			$this->db->where('ex_id',$ex_id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->result();
			}
		}
		function HolidayGallery($id)
		{
			$this->db->select('*');
			$this->db->from('holiday_gallery');
			$this->db->where('ex_id',$id);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->result();
			}
		}
		function delete_gallery_pic($id)
		{
			$this->db->where('gallery_id',$id);
			$this->db->delete('holiday_gallery');
		}
		function add_new_photo($img1,$title,$ex_id)
		{
			$data = array('image'=>$img1, 'title'=>$title, 'ex_id'=>$ex_id);	
			$this->db->insert('holiday_gallery',$data);
		}
	function get_excursion()
		{
			$this->db->select('*');
			$this->db->from('activities');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->result();
			}
		}
		function get_excursion_domestic()
		{
			$this->db->select('*');
			$this->db->from('activities');
			$this->db->where('ex_type','dom');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->result();
			}
		}
		function insert_select_dome($holiday1,$holiday2,$holiday3,$holiday4)
		{
			$data = array('holiday1'=>$holiday1,'holiday2'=>$holiday2,'holiday3'=>$holiday3,'holiday4'=>$holiday4);
			$this->db->update('holiday_selected',$data);
		}
		function insert_select_inter($holiday1,$holiday2,$holiday3,$holiday4)
		{
			$data = array('holiday1'=>$holiday1,'holiday2'=>$holiday2,'holiday3'=>$holiday3,'holiday4'=>$holiday4);
			$this->db->update('holiday_selected_inter',$data);
		}
		function get_selected_holiday()
		{
			$this->db->select('*');
			$this->db->from('holiday_selected');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->row();
			}
		}
		function get_selected_holiday_inter()
		{
			$this->db->select('*');
			$this->db->from('holiday_selected_inter');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->row();
			}
		}
		function get_excursion_inter()
		{
			$this->db->select('*');
			$this->db->from('activities');
			$this->db->where('ex_type','int');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->result();
			}
		}
		function get_excursion_det($excursion_id)
		{
			$this->db->select('*');
			$this->db->from('activities');
			$this->db->where('excursion_id',$excursion_id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->row();
			}
		}
		function update_excursion($ex_type,$excursion_id,$ex_location,$ex_name,$ex_duration,$ex_details,$ex_price,$ex_product_code,$ex_video,$ex_shedule_details,$ex_price_infant,$ex_price_child,$ex_price_adult,$ex_price_includes, $ex_price_includes2, $ex_price_includes3, $ex_price_includes4, $ex_price_includes5, $ex_price_includes6, $ex_price_includes7, $ex_price_includes8, $ex_price_includes9, $ex_price_includes_chk, $ex_price_includes_chk2, $ex_price_includes_chk3, $ex_price_includes_chk4, $ex_price_includes_chk5, $ex_price_includes_chk6, $ex_price_includes_chk7, $ex_price_includes_chk8, $ex_price_includes_chk9,$ex_price_excludes,$ex_additional_details,$ex_more_det,$img1,$img_banner,$ex_diving,$ex_surfing,$country,$cancel_policy,$term_cond)
		{
			$data = array('ex_type'=>$ex_type,'ex_diving'=>$ex_diving,'ex_surfing'=>$ex_surfing,'ex_location'=>$ex_location,'ex_name'=>$ex_name,'ex_duration'=>$ex_duration,'ex_detail'=>$ex_details,'ex_price'=>$ex_price,'ex_productcode'=>$ex_product_code,'ex_video'=>$ex_video,'ex_shedule'=>$ex_shedule_details,'ex_priceinfant'=>$ex_price_infant,'ex_pricechild'=>$ex_price_child,'ex_priceadult'=>$ex_price_adult,'ex_priceincludes'=>$ex_price_includes, 'ex_priceincludes2'=>$ex_price_includes2, 'ex_priceincludes3'=>$ex_price_includes3, 'ex_priceincludes4'=>$ex_price_includes4, 'ex_priceincludes5'=>$ex_price_includes5, 'ex_priceincludes6'=>$ex_price_includes6,'ex_priceincludes7'=>$ex_price_includes7, 'ex_priceincludes8'=>$ex_price_includes8, 'ex_priceincludes9'=>$ex_price_includes9, 'ex_price_includes_chk'=>$ex_price_includes_chk, 'ex_price_includes_chk2'=>$ex_price_includes_chk2,'ex_price_includes_chk3'=>$ex_price_includes_chk3, 'ex_price_includes_chk4'=>$ex_price_includes_chk4, 'ex_price_includes_chk5'=>$ex_price_includes_chk5,'ex_price_includes_chk6'=>$ex_price_includes_chk6,'ex_price_includes_chk7'=>$ex_price_includes_chk7, 'ex_price_includes_chk8'=>$ex_price_includes_chk8,'ex_price_includes_chk9'=>$ex_price_includes_chk9,'ex_priceexcludes'=>$ex_price_excludes,'ex_additionaldet'=>$ex_additional_details,'ex_moredet'=>$ex_more_det,'ex_mainimage'=>$img1,'ex_image'=>$img_banner,'country'=>$country,'cancel_policy'=>$cancel_policy,'term_cond'=>$term_cond);
			$this->db->where('excursion_id',$excursion_id);
			$this->db->update('activities',$data);
		}
		function delete_excursion($excursion_id)
		{
			$this->db->where('excursion_id', $excursion_id);
			$this->db->delete('activities'); 
		}
		function add_notice($notice_title, $notice_content, $img_banner, $id)
		{
			$data = array('notice_title'=>$notice_title , 'notice_content'=>$notice_content , 'img_banner'=>$img_banner);
			//echo "<pre>";print_r($data);exit;
			$this->db->where('id',$id);
			$this->db->update('franchise',$data);
		}
		function get_notice($id)
		{
			
			$this->db->select('*');
			$this->db->from('franchise');
			$this->db->where('id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->row();
			}
		}
		function franchise_acc_det($id)
		{
			$this->db->select('*');
			$this->db->from('franchise');
			$this->db->where('id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
				return $query->row();
			}
		}
		function add_franchise_deposit($id,$amount_deposited,$current_limit,$newdate,$mode_deposit,$bank_name,$branch_name,$city,$remarks,$transaction_id)
		{
			$this->db->select('*');
			$this->db->from('franchise');
			$this->db->where('id',$id);
			$query=$this->db->get();
			$row=$query->row();
			
			$bal=$row->account_balance;
			$old_current_limit = $row->current_limit;
			
			$bal_amt=$bal+$amount_deposited;
			
			$current_limit=$current_limit;
			
			
			$data=array('current_limit'=>$current_limit,'account_balance'=>$bal_amt);
			$this->db->where('id',$id);
			$this->db->update('franchise',$data);
			
			
			$data=array("franchise_id"=>$id,"deposited_amount"=>$amount_deposited,"current_limit"=>$current_limit,"date_of_deposit"=>$newdate,"mode_of_deposit"=>$mode_deposit,"bank_name"=>$bank_name,"branch_name"=>$branch_name,"city"=>$city,"transaction_id"=>$transaction_id,"remarks"=>$remarks,"status"=>'active' );
			$this->db->insert('franchise_amount_deposit',$data);
		}
		function add_franchise_deposit_chque($id,$amount_deposited,$current_limit,$newdate,$mode_deposit,$bank_name,$branch_name,$city,$remarks,$transaction_id,$cheque_no,$cheque_date )
		{
			$this->db->select('*');
			$this->db->from('franchise');
			$this->db->where('id',$id);
			$query=$this->db->get();
			$row=$query->row();
			
			$bal=$row->account_balance;
			$old_current_limit = $row->current_limit;
			
			$bal_amt=$bal+$amount_deposited;
			
			$current_limit=$current_limit;
			
			
			$data=array('current_limit'=>$current_limit,'account_balance'=>$bal_amt);
			$this->db->where('id',$id);
			$this->db->update('franchise',$data);
			
			
			$data=array("franchise_id"=>$id,"deposited_amount"=>$amount_deposited,"current_limit"=>$current_limit,"date_of_deposit"=>$newdate,"mode_of_deposit"=>$mode_deposit,"bank_name"=>$bank_name,"branch_name"=>$branch_name,"city"=>$city,"transaction_id"=>$transaction_id,"cheque_no"=>$cheque_no,"remarks"=>$remarks,"cheque_date"=>$cheque_date,"status"=>'active' );
			$this->db->insert('franchise_amount_deposit',$data);
		}
		function get_deposited_franchise($id)
		{
			$this->db->select('*');
			$this->db->from('franchise_amount_deposit');
			$this->db->where('franchise_id',$id);
			$this->db->where('status','active');
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
		function change_deposited_status_franchise($id,$status)
		{
			$data = array('status'=>$status);
			$this->db->where('franchise_amount_deposit_id',$id);
			$this->db->update('franchise_amount_deposit',$data);
		}
		function bus_requests()
		{
			$this->db->select('*');
			$this->db->from('offline_bus');
			$this->db->order_by('id','desc');
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
		function offline_requests()
		{
			$this->db->select('*');
			$this->db->from('offline_offer');
			$this->db->order_by('id','desc');
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
		function flight_requests()
		{
			$this->db->select('*');
			$this->db->from('offline_flight');
			$this->db->order_by('id','desc');
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
		function hotel_requests()
		{
			$this->db->select('*');
			$this->db->from('offline_hotel');
			$this->db->order_by('id','desc');
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
		function hotel_page_offers()
		{
			$this->db->select('*');
			$this->db->from('hotel_list');
			$this->db->where('Country !=','India');
			$this->db->where('HotelImages1 !=','');
			$this->db->where('StarRating =','5');
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
		function hotel_page_offers2()
		{
			$this->db->select('*');
			$this->db->from('hotel_list');
			$this->db->where('Country =','India');
			$this->db->where('HotelImages1 !=','');
			$this->db->where('StarRating =','5');
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
		function holidays_requests()
		{
			$this->db->select('*');
			$this->db->from('offline_holidays');
			$this->db->order_by('id','desc');
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
		function news_management()
		{
			$this->db->select('*');
			$this->db->from('news_management');
			$this->db->order_by('id','desc');
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
		function insert_news($news_for,$show_at,$news_title,$message)
		{
			$data = array('news_for'=>$news_for,'show_at'=>$show_at,'new_title'=>$news_title,'message'=>$message);
			$this->db->insert('news_management',$data);
			
		}
		function get_news_det($id)
		{
			$this->db->select('*');
			$this->db->from('news_management');
			$this->db->where('id',$id);
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
		function update_news($id,$news_for,$show_at,$news_title,$message)
		{
			$data = array('news_for'=>$news_for,'show_at'=>$show_at,'new_title'=>$news_title,'message'=>$message);
			$this->db->where('id',$id);
			$this->db->update('news_management',$data);
		}
		function update_member_service($id,$flight,$hotel,$bus,$holidays)
		{
			$data = array('service_flight'=>$flight,'service_bus'=>$bus,'service_hotel'=>$hotel,'service_holidays'=>$holidays);
			$this->db->where('agent_id',$id);
			$this->db->update('agents',$data);
		}
		function gethoteloffers()
		{
			$this->db->select('*');
			$this->db->from('hotel_list');
			$this->db->where('Country','India');
			$this->db->where('HotelImages1 !=','');
			$this->db->where('StarRating','5');
			$this->db->group_by('HotelName');
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
		function insert_selected_hotel($hotel_list_id,$status)
		{
			if($status == 'active')
			{
				$date_time = date('Y-m-d H-i-s');
				$data = array('selected'=>'inactive','date_time'=>$date_time);
				$this->db->where('hotel_list_id',$hotel_list_id);
				$this->db->update('hotel_list',$data);
			}
			else
			{
				$date_time = date('Y-m-d H-i-s');
				$data = array('selected'=>'active','date_time'=>$date_time);
				$this->db->where('hotel_list_id',$hotel_list_id);
				$this->db->update('hotel_list',$data);
			}
		}
		function get_selected()
		{
			$this->db->select('*');
			$this->db->from('selected_hotels');
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
		function cms_update($val,$content)
		{
			if($val == '1')
			{
				$data = array('whyus'=>$content);
				$this->db->update('content_cms',$data);
			}
			if($val == '2')
			{
				$data = array('aboutus'=>$content);
				$this->db->update('content_cms',$data);
			}
			if($val == '3')
			{
				$data = array('contactus'=>$content);
				$this->db->update('content_cms',$data);
			}
			if($val == '4')
			{
				$data = array('faq'=>$content);
				$this->db->update('content_cms',$data);
			}
			if($val == '5')
			{
				$data = array('terms'=>$content);
				$this->db->update('content_cms',$data);
			}
			if($val == '6')
			{
				$data = array('privacy'=>$content);
				$this->db->update('content_cms',$data);
			}
			if($val == '7')
			{
				$data = array('feedback'=>$content);
				$this->db->update('content_cms',$data);
			}
		}
		function cms_update_agent($agent_moreprofit,$agent_ontarget,$agent_customersupport)
		{
			$data = array('agent_moreprofit'=>$agent_moreprofit,'agent_ontarget'=>$agent_ontarget,'agent_customersupport'=>$agent_customersupport);
			$this->db->update('content_cms',$data);
		}
		function get_cms()
		{
			$this->db->select('*');
			$this->db->from('content_cms');
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
		function hotel_offers_add($inter1,$inter2,$inter3,$dom1,$dom2,$dom3)
		{
			$data = array('inter1'=>$inter1,'inter2'=>$inter2,'inter3'=>$inter3,'dom1'=>$dom1,'dom2'=>$dom2,'dom3'=>$dom3);
			$this->db->update('hotelpage_offers',$data);
		}
		function get_list_hoteloffers()
		{
			$this->db->select('*');
			$this->db->from('hotelpage_offers');
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
		function get_hot_det($id)
		{
			$this->db->select('*');
			$this->db->from('hotel_list');
			$this->db->where('hotel_list_id',$id);
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
		function holiday_themes()
		{
			$this->db->select('*');
			$this->db->from('holiday_themes');
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
		function add_banner_holiday($image,$ex_id)
		{
			$data = array('image'=>$image,'ex_id'=>$ex_id);
			$this->db->insert('holiday_banner',$data);
		}
		function insert_admin($username,$password,$country,$city,$postalcodem,$userf_name,$userl_name,$position,$email,$office_no,$mob_phn,$nation)
		{
			$data = array('user'=>$username,'password'=>$password,'country'=>$country,'city'=>$city,'postalcodem'=>$postalcodem,'first_name'=>$userf_name,'last_name'=>$userl_name,'position'=>$position,'email'=>$email,'office_no'=>$office_no,'mob_phn'=>$mob_phn,'nation'=>$nation,'created_by'=>'1','created_date'=>date('Y-m-d H:i:s'));
			$this->db->insert('admin_new',$data);
			return $this->db->insert_id();
		}
		function insert_access_id($admin_id)
		{
			$data = array('admin_id'=>$admin_id);
			$this->db->insert('admin_access',$data);
		}
		function update_admin($id,$username,$password,$country,$city,$postalcode,$userf_name,$userl_name,$position,$email,$office_no,$mob_phn,$nation)
		{
			$data = array('user'=>$username,'password'=>$password,'country'=>$country,'city'=>$city,'postalcodem'=>$postalcodem,'first_name'=>$userf_name,'last_name'=>$userl_name,'position'=>$position,'email'=>$email,'office_no'=>$office_no,'mob_phn'=>$mob_phn,'nation'=>$nation,'created_by'=>'1','created_date'=>date('Y-m-d H:i:s'));
			$this->db->where('admin_id',$id);
			$this->db->update('admin_new',$data);
		}
		function admin_status($status,$id)
		{
			$data = array('status'=>$status);
			$this->db->where('admin_id',$id);
			$this->db->update('admin_new',$data);
		}
		function admin_list()
		{
			$this->db->select('*');
			$this->db->from('admin_new');
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
		function admin_det($id)
		{
			$this->db->select('*');
			$this->db->from('admin_new');
			$this->db->where('admin_id',$id);
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
		function insert_admin_access($admin_id,$supplier,$agent,$slider_image,$holidays,$Markup,$member_credit,$changepassword,$offlinebus,$offlineflight,$offlineoffer,$offlinehotel,$offlineholiday,$news_management,$imagemanagement,$B2C_report,$B2B_report,$service_managemnt,$page_management,$user_managemnt,$banner_images,$mail_agent,$lbs_flight)
		{
			$data = array('supplier'=>$supplier,'agent'=>$agent,'slider_image'=>$slider_image,'holidays'=>$holidays,'markup'=>$Markup,'member_credit'=>$member_credit,'changepassword'=>$changepassword,'offlinebus'=>$offlinebus,'offlineflight'=>$offlineflight,'offlineoffer'=>$offlineoffer,'offlinehotel'=>$offlinehotel,'offlineholiday'=>$offlineholiday,'news_management'=>$news_management,'imagemanagement'=>$imagemanagement,'b2c_report'=>$B2C_report,'b2b_report'=>$B2B_report,'service_managemnt'=>$service_managemnt,'page_management'=>$page_management,'usermanagement'=>$user_managemnt,'banner_images'=>$banner_images,'mail_agent'=>$mail_agent,'lbs_flight'=>$lbs_flight);
			$this->db->where('admin_id',$admin_id);
			$this->db->update('admin_access',$data);
		}
		function access_details($id)
		{
			$this->db->select('*');
			$this->db->from('admin_access');
			$this->db->where('admin_id',$id);
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
		function list_agent()
		{
			$this->db->select('*');
			$this->db->from('agents');
			$this->db->order_by('agent_id','desc');	   
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
		function list_user()
		{
			$this->db->select('*');
			$this->db->from('user_login');	   
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
		function view_agent_detail($id)
		{
			$this->db->select('*');
			$this->db->from('agents');
			$this->db->where('agent_id',$id);
			$query=$this->db->get();
			if($query->num_rows()=='')
			{
				return '';
			}else{
				
			return $query->result();
			}
		}
		function agent_deposit($id)
		{
			$this->db->select('*');
			$this->db->from('user_deposit');
			//$this->db->from('agent_profile_details','agent_profile_details.agentid=deposit_details.agentid','inner');
			$this->db->where('User_id',$id);
			$query=$this->db->get();
			if($query->num_rows()=='')
			{
				return '';
			}else{
				
			return $query->result();
			}
		}
		function admin_deposit_details($id)
		{
			$this->db->select('*');
			$this->db->from('agent_deposit');
			//$this->db->join('agent_profile_details','agent_profile_details.agentid=deposit_details.agentid','inner');
			$this->db->where('User_id ',$id);
			$query=$this->db->get();
			if($query->num_rows()=='')
			{
				return '';
			}else{
				
			return $query->result();
			}
		}
		function add_new_deposit_details($agnt,$amount_depo,$current_limit,$dob,$mode_of_depo,$bank_name,$branch_name,$city,$remarks,$trans_id,$cheque_no,$cheque_date,$admin_name,$remarks)
		{
		
			/*Edit here*/
			$this->db->select('*');
			$this->db->from('agents');
			$this->db->where('agent_id',$agnt);
			$query=$this->db->get();
			$row=$query->row();
			
			if($row!='')
			{
			$bal=$row->account_balance;
			}
			else
			{
				$bal=0;
			}
		
			$bal_amt=$amount_depo;
			
			
			$data=array('acc_balance_new'=>$bal_amt);
			$this->db->where('agent_id',$agnt);
			$this->db->update('agents',$data);
			
			$timezone = "Asia/Kolkata";
			//date_default_timezone_set($timezone);
			date_default_timezone_set('UTC');

			 $tme=date("H:i:s");
			 
			 $utype="admin";
			//list($d,$m,$Y)=explode("-",$dob);
	
			//$dob='';
	
			$data=array('User_id'=>$agnt,'Amount'=>$amount_depo,'Balance'=>$amount_depo,'DateOfPay'=>$dob,'Type_of_pay'=>$mode_of_depo,'BankName'=>$bank_name,'Branch'=>$branch_name,'City'=>$city,'Remark'=>$remarks,'UserTime'=>$tme,'Transaction_Id'=>$trans_id,'Cheque_Date'=>$cheque_date,'Cheque_No'=>$cheque_no,'User_Type'=>$utype,'admin_name'=>$admin_name,'remarks'=>$remarks);
		//echo "<pre>"; print_r($data); exit;
			$this->db->insert('agent_deposit',$data);
		
		}
	function lbs_flight()
	{
		$this->db->select('*');
		$this->db->from('lbs_flight');
		$this->db->order_by('id','desc');
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}
	function get_agents_search($agent_id,$agent_name,$cell_no,$email_id)
	{
		/*$this->db->select('*');
		$this->db->from('agents');
		$this->db->like('agent_id',$agent_id);
		$this->db->like('agent_name',$agent_name);
		$query=$this->db->get();*/
		$query = $this->db->query("select * from agents where agent_id = '".$agent_id."' OR agent_name = '".$agent_name."' OR mobile_phone ='".$cell_no."' OR email = '".$email_id."'");
		//echo $this->db->last_query();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->result();
		}
	}
	function markup_agents_insert($agent_id,$payment_gateway,$gateway_type,$hotel,$hotel_type,$bus,$bus_type,$car,$car_type,$holidays,$holiday_type,$airindia_dom,$airindia_type,$jet_airways_dom,$jeta_type,$jetlite_dom,$jetlite_type,$kingfisher_dom,$kingfisher_type,$airindia_express,$aiindiaex_type,$goair_dom,$goair_type,$indigo_dom,$indigo_type,$spicejet_dom,$spicejet_type,$all_dom_airline,$other_airline,$airindia_inter,$airindia_typeinter,$jetairways_inter,$jetairways_typeinter,$jetlite_inter,$jetlite_typeinter,$kingfisher_inter,$kingfisher_typeinter,$airindiaexp_inter,$airindiaex_typeinter,$goair_inter,$goair_typeinter,$indigo_inter,$indigo_typeinter,$mdlr_inter,$mdlr_typeinter,$paramount_inter,$paramount_typeinter,$spicejet_inter,$spicejet_typeinter,$other_inter,$other_typeinter)
	{
		$data = array('agent_id'=>$agent_id,'payment_gateway'=>$payment_gateway,'gateway_type'=>$gateway_type,'hotel'=>$hotel,'hotel_type'=>$hotel_type,'bus'=>$bus,'bus_type'=>$bus_type,'car'=>$car,'car_type'=>$car_type,'holidays'=>$holidays,'holiday_type'=>$holiday_type,'airindia_dom'=>$airindia_dom,'airindia_type'=>$airindia_type,'jet_airways_dom'=>$jet_airways_dom,'jeta_type'=>$jeta_type,'jetlite_dom'=>$jetlite_dom,'jetlite_type'=>$jetlite_type,'kingfisher_dom'=>$kingfisher_dom,'kingfisher_type'=>$kingfisher_type,'airindia_express'=>$airindia_express,'aiindiaex_type'=>$aiindiaex_type,'goair_dom'=>$goair_dom,'goair_type'=>$goair_type,'indigo_dom'=>$indigo_dom,'indigo_type'=>$indigo_type,'spicejet_dom'=>$spicejet_dom,'spicejet_type'=>$spicejet_type,'all_dom_airline'=>$all_dom_airline,'other_airline'=>$other_airline,'airindia_inter'=>$airindia_inter,'airindia_typeinter'=>$airindia_typeinter,'jetairways_inter'=>$jetairways_inter,'jetairways_typeinter'=>$jetairways_typeinter,'jetlite_inter'=>$jetlite_inter,'jetlite_typeinter'=>$jetlite_typeinter,'kingfisher_inter'=>$kingfisher_inter,'kingfisher_typeinter'=>$kingfisher_typeinter,'airindiaexp_inter'=>$airindiaexp_inter,'airindiaex_typeinter'=>$airindiaex_typeinter,'goair_inter'=>$goair_inter,'goair_typeinter'=>$goair_typeinter,'indigo_inter'=>$indigo_inter,'indigo_typeinter'=>$indigo_typeinter,'mdlr_inter'=>$mdlr_inter,'mdlr_typeinter'=>$mdlr_typeinter,'paramount_inter'=>$paramount_inter,'paramount_typeinter'=>$paramount_typeinter,'spicejet_inter'=>$spicejet_inter,'spicejet_typeinter'=>$spicejet_typeinter,'other_inter'=>$other_inter,'other_typeinter'=>$other_typeinter);
		//$this->db->where('agent_id',$agent_id);
		$this->db->insert('agent_markup',$data);
	}
	function delete_markup($agent_id)
	{
		$this->db->where('agent_id',$agent_id);
		$this->db->delete('agent_markup');
	}
	function get_agent_markup($id)
	{
		$this->db->select('*');
		$this->db->from('agent_markup');
		$this->db->where('agent_id',$id);
		$query=$this->db->get();
		if($query->num_rows()=='')
		{
			return '';
		}else{
			
		return $query->row();
		}
	}
}

?>
