<?php 
class Vehicle_Model extends CI_Model
{

		function __construct()
		{
		
		parent::__construct();
		
		}
		
function add_vehicle_name($veh_name)
{

  $data=array('vehicle_name'=>$veh_name);
  $this->db->insert('vehicle',$data);	
	
}
function delete_vehicle_name($vehid)
{
	 $this->db->where('veh_id',$vehid);
  $this->db->delete('vehicle_details');	
	
}
function get_vehicles()
{
	$this->db->select('distinct(vehicle_name)');
			$this->db->from('vehicle');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}		
	
}
	function get_cities()
	{
		$this->db->select('*');
		$this->db->from('city_saudi');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}	
	}
	function except_city($city)
	{
		$this->db->select('*');
		$this->db->from('city_saudi');
		$this->db->where('city_name <>',$city);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}	
	}
	function edit_status_vehicle($id,$status)
	{
		$data=array('veh_status'=>$status);
		$this->db->where('veh_id',$id);
		$this->db->update('vehicle_details',$data);
	}
function add_vehicle_details($name,$vehi_name,$vehi_number,$vehi_model,$vehi_address,$vehi_seating,$vehi_luggage,$vehi_pickcity,$vehi_facility,$pickdate,$dropdate,$vehi_droptime,$vehi_dropcity,$category,$source_city,$destination_city,$tolocation,$fromlocation,$vehi_milecharge,$img1)
{

	$data=array('veh_name'=>$name,'veh_type'=>$vehi_name,'veh_number'=>$vehi_number,'veh_model'=>$vehi_model,'veh_address'=>$vehi_address,'veh_seating'=>$vehi_seating,'veh_luggage'=>$vehi_luggage,'veh_city_pickup'=>$vehi_pickcity,'veh_image'=>$img1,'veh_facility'=>$vehi_facility,'pick_up_date'=>$pickdate,'drop_off_date'=>$dropdate,'pick_up_time'=>$vehi_droptime,'drop_off_time'=>$vehi_dropcity,'pickupcity'=>$source_city,'drop_off_city'=>$destination_city,'pickuplocation'=>$tolocation,'dropdownlocation'=>$fromlocation,'per_mile_charge'=>$vehi_milecharge,'category'=>$category);
	$this->db->insert('vehicle_details',$data);
}
	function vehicle_details()
	{
		$this->db->select('*');
		$this->db->from('vehicle_details');
		$query=$this->db->get();
		if($query->num_rows() ==''){

			return '';
		}
		else{
			return $query->result();
		}	
	}
	function vehicle_details_per($start,$limit)
	{
		$sel = "select * from vehicle_details Limit $start,$limit";
			$query = $this->db->query($sel);

		if($query->num_rows() ==''){

			return '';
		}
		else{
			return $query->result();
		}	
	}
	function edit_vehicles($id)
	{
		$this->db->select('*');
		$this->db->from('vehicle_details');
		$this->db->where('veh_id',$id);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->row();
		}
	}
	function edit_vehicle_details($name,$vehi_name,$vehi_number,$vehi_model,$vehi_address,$vehi_seating,$vehi_luggage,$vehi_pickcity,$vehi_facility,$pickdate,$dropdate,$vehi_droptime,$vehi_dropcity,$category,$source_city,$destination_city,$tolocation,$fromlocation,$vehi_milecharge,$img1,$id)
	{
		$data=array('veh_name'=>$name,'veh_type'=>$vehi_name,'veh_number'=>$vehi_number,'veh_model'=>$vehi_model,'veh_address'=>$vehi_address,'veh_seating'=>$vehi_seating,'veh_luggage'=>$vehi_luggage,'veh_city_pickup'=>$vehi_pickcity,'veh_image'=>$img1,'veh_facility'=>$vehi_facility,'pick_up_date'=>$pickdate,'drop_off_date'=>$dropdate,'pick_up_time'=>$vehi_droptime,'drop_off_time'=>$vehi_dropcity,'pickupcity'=>$source_city,'drop_off_city'=>$destination_city,'pickuplocation'=>$tolocation,'dropdownlocation'=>$fromlocation,'per_mile_charge'=>$vehi_milecharge,'category'=>$category);
		  $this->db->where('veh_id',$id);
		 $this->db->update('vehicle_details',$data);	
	}
	function vehicle_filter_by_name($comp_name)
	{
		$this->db->select('*');
		$this->db->from('vehicle_details');
		$this->db->where('veh_name',$comp_name);
		$query = $this->db->get();
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	function vehicle_filter_by_name_per($comp_name,$start,$limit)
	{
		$sel = "select * from vehicle_details where veh_name = '".$comp_name."'  Limit $start,$limit";
		$query = $this->db->query($sel);
		
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	function vehicle_filter_by_city($country)
	{
		$this->db->select('*');
		$this->db->from('vehicle_details');
		$this->db->where('veh_city_pickup',$country);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	function vehicle_filter_by_city_per($country,$start,$limit)
	{
		$sel = "select * from vehicle_details where veh_city_pickup = '".$country."'  Limit $start,$limit";
		$query = $this->db->query($sel);
		
		//echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	function vehicle_details_merge()
	{
		$this->db->select('distinct(veh_name)');
			$this->db->from('vehicle_details');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}	
	}
	
	function vehicle_city_details()
	{
			$this->db->select('distinct(veh_city_pickup)');
			$this->db->from('vehicle_details');
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}	
	}
	function vehicle_model()
	{
		$this->db->select('distinct(veh_type)');
			$this->db->from('vehicle_details');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
	}
	function vehicle_filter_by_model($veh_model)
	{
		$this->db->select('*');
		$this->db->from('vehicle_details');
		$this->db->where('veh_type',$veh_model);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	function vehicle_filter_by_model_per($veh_model,$start,$limit)
	{
		$sel = "select * from vehicle_details where veh_type = '".$veh_model."'  Limit $start,$limit";
		$query = $this->db->query($sel);
		//echo $this->db->last_query();exit;
		if($query->num_rows() ==''){
			return '';
		}
		else{
			return $query->result();
		}
	}
	function vehicle_model_type()
	{
		$this->db->select('distinct(veh_type)');
			$this->db->from('vehicle_details');
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
	}
	
	function get_agentname($id)
	{
		$this->db->select('*');
			$this->db->from('agent_profile_details');
			$this->db->where('agent_id',$id);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		
	}
	
}

?>
