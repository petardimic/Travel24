<?php 
class Hotel_Model extends CI_Model
{

		function __construct()
		{
		
		parent::__construct();
		
		}
		
		function hotel_details()
		{
			$this->db->select('*');
			$this->db->from('hotel_details');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function package_details()
		{
			$this->db->select('*');
			$this->db->from('package');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function package_details_per($start,$limit)
		{
			$sel = "select * from package Limit $start,$limit";
			$query = $this->db->query($sel);
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
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
		function hotel_details_merge()
		{
			$this->db->select('distinct(hotel_name)');
			$this->db->from('hotel_details');
			
			$query=$this->db->get();
			
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function hotel_details_merge_per($start,$limit)
		{
			$sel = "select distinct(hotel_name) from hotel_details Limit $start,$limit";
			$query = $this->db->query($sel);
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function hotel_package_merge()
		{
			$this->db->select('distinct(package_name)');
			$this->db->from('package');
			
			$query=$this->db->get();
			
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function hotel_package_merge_per($start,$limit)
		{
			$sel = "select distinct(package_name) from package Limit $start,$limit";
			$query = $this->db->query($sel);
			
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function car_details_merge()
		{
			$this->db->select('distinct(travel_name)');
			$this->db->from('car_details');			
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function hotel_city_details()
		{
			$this->db->select('distinct(city)');
			$this->db->from('hotel_details');
			$query=$this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function package_city_details()
		{
			$this->db->select('distinct(city)');
			$this->db->from('package');
			$query=$this->db->get();
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
		function car_city_details()
		{
			$this->db->select('distinct(city)');
			$this->db->from('car_details');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
			
		}
	function delete_hotel_details($hotel_id)
	     {		
		$this->db->where('hotel_id', $hotel_id);
		$this->db->delete('hotel_details'); 
		
	     }
	function delete_package_details($hotel_id)
	     {		
		$this->db->where('package_id', $hotel_id);
		$this->db->delete('package_details');
		$this->db->where('package_id', $hotel_id);
		$this->db->delete('package'); 
		
	     }
		 
	function delete_hotel_details_all($hotel_id)
	     {		
		$this->db->where('hid', $hotel_id);
		$this->db->delete('hotel_details_all'); 
		
	     }
    function hotel_det($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_details');	   
		$this->db->where('hotel_id',$id);
		
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
	function package_det($id)
	{
		$this->db->select('*');
		$this->db->from('package');	   
		$this->db->where('package_id',$id);
		
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
	function hotel_det_all($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_details_all');	
		$this->db->where('hotel_details_all.hotel_id',$id);
		$query=$this->db->get();
		if($query->num_rows() =='' || $query->num_rows() ==0)
		{ 
			return '';
		}
		else
		{
		 	return $query->row();
		}
	} 
	function package_det_all($id)
	{
		$this->db->select('*');
		$this->db->from('package_details');	
		$this->db->where('package_details.package_id',$id);
		$query=$this->db->get();
		if($query->num_rows() =='' || $query->num_rows() ==0)
		{ 
			return '';
		}
		else
		{
		 	return $query->row();
		}
	} 
	function car_det_all($id)
	{
		$this->db->select('*');
		$this->db->from('car_details_all');	
		$this->db->where('travel_id',$id);
		$query=$this->db->get();
		if($query->num_rows() =='' || $query->num_rows() ==0)
		{ 
			return '';
		}
		else
		{
		 	return $query->row();
		}
	} 
	
	function update_hotel_details($id,$hname,$hcity,$hcpname,$hemail,$hoffice_no,$hwebsite)
	{
	    $data=array('hotel_name'=>$hname,'city'=>$hcity,'contact_person'=>$hcpname,'email_id'=>$hemail,'contact_num'=>$hoffice_no,'website'=>$hwebsite);
	     $this->db->where('hotel_id',$id);
		 $this->db->update('hotel_details',$data);
	
	}
	function add_all_hotel_details($hid,$hdesc,$rooms,$hbreakfast,$hparking,$hbuilt,$hstar_rate,$hcancellationploicy)
	{
	  
		$data=array('hotel_id'=>$hid,'details'=>$hdesc,'number_of_rooms'=>$rooms,'breakfast'=>$hbreakfast,'parking'=>$hparking,'hotel_built'=>$hbuilt,'star_rate'=>$hstar_rate,'cancellation_policy'=>$hcancellationploicy);
	    
		 $this->db->insert('hotel_details_all',$data);
		 //echo $this->db->last_query();
	 
		
	}
	function add_all_package_details($hid,$hdesc,$rooms,$hbreakfast,$hparking,$hbuilt,$hstar_rate,$hcancellationploicy)
	{
	  
		$data=array('package_id'=>$hid,'details'=>$hdesc,'number_of_rooms'=>$rooms,'breakfast'=>$hbreakfast,'parking'=>$hparking,'year_built'=>$hbuilt,'star_rate'=>$hstar_rate,'cancellation_policy'=>$hcancellationploicy);
	    
		 $this->db->insert('package_details',$data);
		 //echo $this->db->last_query();
	 
		
	}
	function add_all_car_details($hid,$hdesc,$rooms,$hstar_rate,$hcancellationploicy,$terms)
	{
	  
		$data=array('travel_id'=>$hid,'details'=>$hdesc,'number_of_vehicles'=>$rooms,'star_rate'=>$hstar_rate,'cancellation_policy'=>$hcancellationploicy,'terms'=>$terms);
	    	$this->db->insert('car_details_all',$data);
	}
	function update_all_hotel_details($hid,$hdesc,$rooms,$hbreakfast,$hparking,$hbuilt,$hstar_rate,$hcancellationploicy)
	{
         $data=array('details'=>$hdesc,'number_of_rooms'=>$rooms,'breakfast'=>$hbreakfast,'parking'=>$hparking,'hotel_built'=>$hbuilt,'star_rate'=>$hstar_rate,'cancellation_policy'=>$hcancellationploicy);
	    $this->db->where('hotel_id',$hid);
		 $this->db->update('hotel_details_all',$data);		
	}
	function update_all_package_details($hid,$hdesc,$rooms,$hbreakfast,$hparking,$hbuilt,$hstar_rate,$hcancellationploicy)
	{
         $data=array('details'=>$hdesc,'number_of_rooms'=>$rooms,'breakfast'=>$hbreakfast,'parking'=>$hparking,'hotel_built'=>$hbuilt,'star_rate'=>$hstar_rate,'cancellation_policy'=>$hcancellationploicy);
	    $this->db->where('package_id',$hid);
		 $this->db->update('package_details',$data);		
	}
	function update_all_car_details($hid,$hdesc,$rooms,$hstar_rate,$hcancellationploicy,$terms)
	{
         $data=array('details'=>$hdesc,'number_of_vehicles'=>$rooms,'star_rate'=>$hstar_rate,'cancellation_policy'=>$hcancellationploicy,'terms'=>$terms);
	    $this->db->where('travel_id',$hid);
		 $this->db->update('car_details_all',$data);		
	}
		function edit_status_hotel_sup($id,$status1)
	{
	 
		$data=array('status'=>$status1);
		$this->db->where('hotel_id',$id);
		$this->db->update('hotel_details',$data);
	}
	function edit_status_package($id,$status1)
	{
	 
		$data=array('status'=>$status1);
		$this->db->where('package_id',$id);
		$this->db->update('package_details',$data);
	}
	function edit_status_room_sup($roomid,$status1)
	{
	 
		$data=array('rstatus'=>$status1);
		$this->db->where('rid',$roomid);
		$this->db->update('room_details',$data);
		//echo $this->db->last_query();
	}
	function add_room_details($hotel_id,$roomid,$room_translated,$room_english,$max_capacity,$extra_beds,$existing_beds,$startdate,$enddate,$rate)
	{
		$data = array('hotel_id'=>$hotel_id,'room_id'=>$roomid,'twin_room'=>$room_translated,'room_type_name'=>$room_english,'quad_room'=>$extra_beds,'triple_room'=>$existing_beds,'startdate'=>$startdate,'enddate'=>$enddate,'single_room'=>$rate);
		$this->db->insert('room_details',$data);	
	}
	function add_pictures_details($roomid,$image,$b)
	{
		$data=array('room_picture'.$b=>$image);
		$this->db->where('room_id',$roomid);
		$this->db->update('room_details',$data);
	}
	function room_det_all($id)
	{
		$this->db->select('*');
		$this->db->from('room_details AS r');
		$this->db->join('hotel_details AS h', 'h.hotel_id = r.hotel_id');
		$this->db->where('r.hotel_id',$id);
		$query=$this->db->get();
		
		if($query->num_rows() =='' || $query->num_rows() ==0)
		{ 
			return '';
		}
		else
		{
		 	return $query->result();
	  
		}
	}
	function room_det($room_id)
	{
		$this->db->select('*');
		$this->db->from('room_details');
		$this->db->where('room_id',$room_id);
		$this->db->order_by('rid','desc');
		$query=$this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() =='' || $query->num_rows() ==0)
		{ 
			return '';
		}
		else
		{
		 	return $query->row();
	  
		}
	}
	function room_det_id($room_id)
	{
		$this->db->select('*');
		$this->db->from('room_details');
		$this->db->where('rid',$room_id);
		
		$query=$this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() =='' || $query->num_rows() ==0)
		{ 
			return '';
		}
		else
		{
		 	return $query->row();
	  
		}
	}
	function edit_room($roomid,$room_translated_edit,$room_english_edit,$existing_bedding_edit,$extra_beds_edit,$maxcapcaity,$img1,$img2,$img3,$startdate,$enddate,$rate)
	{
		$data = array('twin_room'=>$room_translated_edit,'room_type_name'=>$room_english_edit,'triple_room'=>$existing_bedding_edit,'quad_room'=>$extra_beds_edit,'room_picture0'=>$img1,'room_picture1'=>$img2,'room_picture2'=>$img3,'startdate'=>$startdate,'enddate'=>$enddate,'single_room'=>$rate);
		$this->db->where('room_id',$roomid);
		$this->db->update('room_details',$data);			
	}
	function room_status($roomid)
	{
		$this->db->select('status');
		$this->db->from('room_details');
		$this->db->where('room_id',$roomid);
		$query = $this->db->get();
		if($query->num_rows() == '' || $query->num_rows() == 0)
		{
			return '';
		}
		else
		{
			return $query->row();
		}
	}
function delete_room_details($rid)
	     {		
		$this->db->where('rid',$rid);
		$this->db->delete('room_details'); 
		
	     }
		
	function hotel_FILTER_byname($name)
		{
		$this->db->select('*');
		$this->db->from('hotel_details');	   
		
		$this->db->where('hotel_name',$name);
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
	function package_FILTER_byname($name)
		{
		$this->db->select('*');
		$this->db->from('package');	   
		
		$this->db->where('package_name',$name);
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
	function package_FILTER_byname_per($name,$start,$limit)
		{
			$sel = "select * from package where package_name = '".$name."' Limit $start,$limit";
			$query = $this->db->query($sel);
		
		if($query->num_rows() =='')
		{ 
			return '';
		}
		else
		{
		  return $query->result();
	  
		}	
}
	function hotel_FILTER_byname_car($name)
	{
		$this->db->select('*');
		$this->db->from('car_details');	   
		$this->db->where('travel_name',$name);
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
function hotel_info_bycountry($name)
		{
		$this->db->select('*');
		$this->db->from('hotel_details');	   
		
		$this->db->where('city',$name);
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
	function package_info_bycountry($name)
		{
		$this->db->select('*');
		$this->db->from('package');	   
		
		$this->db->where('city',$name);
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
	function package_info_bycountry_per($name,$start,$limit)
		{
		$sel = "select * from package where city = '".$name."' Limit $start,$limit";
			$query = $this->db->query($sel);
				if($query->num_rows() =='')
		{ 
			return '';
		}
		else
		{
		  return $query->result();
	  
		}	
}
	function hotel_info_bycountry_car($name)
		{
		$this->db->select('*');
		$this->db->from('car_details');	   
		
		$this->db->where('city',$name);
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
	function front_end_status($id,$status)
	{
		$data = array('status'=>$status);
		$this->db->where('package_id',$id);
		$this->db->update('package',$data);
	}
	function delete_agent($id)
	{
		$this->db->where('agent_id',$id);
		$this->db->delete('agent_profile_details');
		$this->db->where('agent_id',$id);
		$this->db->delete('agent_login_info'); 
	}
}

?>
