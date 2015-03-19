<?php 
class Hotel_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function get_dest_Code($city,$cntry)
	{
		$this->db->select('DestinationId');
		$this->db->from('hotelspro_cities');
		$this->db->where('Country',$cntry);
		$this->db->where('City',$city);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$row=$query->row();
			return $row->DestinationId;
		}
	}
	function get_comm_admin()
	{
		$this->db->select('value');
		$this->db->from('hotel_commission');
		$this->db->where('com_id','2');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$row=$query->row();
			return $row->value;
		}
		
	}
	function get_comm_admin1()
	{
		$this->db->select('value');
		$this->db->from('hotel_commission');
		$this->db->where('com_id','1');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
			$row=$query->row();
			return $row->value;
		}
		
	}
	function insert_last_viewed($sec_res,$hotel_name,$hotel_code)
	{
		
			$data=array('sess_id'=>$sec_res,'hcode'=>$hotel_code,'hname'=>$hotel_name);
			//echo '<pre>'; print_r($data);exit;
			$this->db->insert('last_viewd_details',$data);
			//echo $this->db->last_query();
		   //return $this->db->insert_id();
		
	}
	function insert_gta_temp_result($sec_res,$api,$itemCode,$room_code,$room_type,$cost_val,$status_val,$meals_val,$adult,$child)
	{
			
			$cost_val = $cost_val;
			$data=array('session_id'=>$sec_res,'api'=>$api,'hotel_code'=>$itemCode,'room_code'=>$room_code,'room_type'=>$room_type,'inclusion'=>$meals_val,'total_cost'=>$cost_val,'status'=>$status_val,'adult'=>$adult,'child'=>$child);
			//echo '<pre>'; print_r($data);exit;
			$this->db->insert('api_hotel_detail_t',$data);
			//echo $this->db->last_query();
		   return $this->db->insert_id();
		
	}
	function delete_session($sec)
	{
		$this->db->query("DELETE FROM api_hotel_detail_t where session_id = '".$sec."'");
	}
	
	
	function delete_hotel($sec)
	{
		$this->db->query("DELETE FROM  	search_result where criteria_id = '".$sec."'");
		$this->db->query("DELETE FROM  	search_result_rooms where criteria_id = '".$sec."'");
	}
	
	

	function fetch_search_result_sBYp($ses_id,$limit=false,$start=false, $page=1, $minVal, $maxVal, $minStar = 0, $maxStar = 5, $fac = '', $sorting='')
	{
	              	
	
		
		
		//echo $maxVal;exit;
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if ($minVal!='') {
			if($maxVal!="many")
			{
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
			}
			else
			{
				
				$where.= "AND (t.total_cost >=$minVal)";
			}
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
	//echo $where;exit;
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
						switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			
			if($limit!='')
			{
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit";
			}
			else
			{
				
				$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
			}
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	
	}
	
	
	function fetch_search_result_sBYs($ses_id,$limit,$start, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='',$str_value)
	{
		
		
		
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating='".$str_value."')";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
						switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			if($limit!='')
			{
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit ";
			}
			else
			{
				$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
			}
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	
	}
	function fetch_search_result_shtol_price($ses_id,$limit,$start,$page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='star_desc')
	{
		
		
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit ";
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	
	}
	
	function fetch_search_result_shtol($ses_id, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='star_desc')
	{
		
		
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	
	}
	
	function fetch_search_result_sltoh_price($ses_id,$limit,$start, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='star_asc')
	{
		
		
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
		
			
				$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit";
				
			
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
			
			
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	
	}
	
	
	function fetch_search_result_sltoh($ses_id, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='star_asc')
	{
		
		
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
		
			
				$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
				
			
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
			
			
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	
	}
	
	
	function fetch_search_result_ahtol($ses_id,$limit=false,$start=false, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='name_desc')
	{
		
		
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.HotelName, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.HotelName DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			if($limit!='')
			{
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit ";
			}
			else
			{
				$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
				
			}
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	
	}
	
	function fetch_search_result_altoh_price($ses_id,$limit,$start, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='name_asc')
	{
		
		
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.HotelName, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.HotelName DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit ";
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	
	}
	
	
	function fetch_search_result_altoh($ses_id, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='name_asc')
	{
		
		
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.HotelName, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.HotelName DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	
	}
	function fetch_search_result_phtol($ses_id,$limit=false,$start=false,$page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='price_desc')
	{
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			
			if($limit!='')
			{
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit ";
			}
			else
			{
				$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order  ";
				
			}
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	}
	function fetch_search_result_ptol($ses_id, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='price_asc')
	{
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	}
	function fetch_star_result_details($ses_id,$limit=false,$start=false,$strvalue)
	{
		
			//exit;
		$starvalue = '';
	if(count($strvalue)==1)
	{
		
	  foreach($strvalue as $rows)
	  {
		$starvalue= $rows;  
	   }	
	}
	else
	{
		foreach($strvalue as $rows1)
	  {
		$starvalue .=$rows1.",";  
	   }	
		
	}
	$strval= rtrim($starvalue, ',');
		if($limit=='')
		{
		//echo "select * from search_result sh  where sh.criteria_id = '".$ses_id."' AND min_cost != 0 AND sh.star_rate IN ('$strval') GROUP BY sh.supplier_id";exit;
		$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$ses_id."' AND min_cost != 0 AND sh.star_rate IN ($strval) GROUP BY sh.supplier_id ORDER BY  star_rate DESC");
	//echo "select * from search_result sh  where sh.criteria_id = '".$ses_id."' AND min_cost != 0 AND sh.star_rate IN ($strval) GROUP BY sh.supplier_id";exit;
}
else
{
	
	$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$ses_id."' AND min_cost != 0 AND sh.star_rate IN ($strval) GROUP BY sh.supplier_id ORDER BY  star_rate DESC limit $start,$limit");
}
	return $query->result();
	
	}
	
	
	
	function fetch_price_result_details($ses_id,$limit=false,$start=false,$pricevalue,$strvalue,$facility)
	{
		
			//exit;
		$where = '';
		if(!empty($pricevalue))
		
		{
	if(count($pricevalue)==1)
	{
		
	  foreach($pricevalue as $rows)
	  {
		 $pricevalue1= explode("-",$rows);
		$where .= "AND min_cost BETWEEN $pricevalue1[0] AND $pricevalue1[1]" ; 
	   }	
	}
	else
	{
		
		for($i=0;$i<count($pricevalue);$i++)
		{
			if($i==0)
			{
			 $pricevalue1= explode("-",$pricevalue[$i]);
		$where .= "AND min_cost BETWEEN $pricevalue1[0] AND $pricevalue1[1]" ; 
		    }
		    else
		    {
				 $pricevalue1= explode("-",$pricevalue[$i]);
		$where .= " OR min_cost BETWEEN $pricevalue1[0] AND $pricevalue1[1]" ; 
				
			}
		
		}
		
		
	}
  }
  
  if(!empty($strvalue))
		
		{
			$svalue='';
			$starvalue='';
			if(count($strvalue)==1)
	{
		
	  foreach($strvalue as $rows)
	  {
		$svalue= $rows;  
	   }	
	}
	else
	{
		foreach($strvalue as $rows1)
	  {
		$starvalue .=$rows1.",";  
	   }	
		$svalue=rtrim($starvalue, ',');
	}
	$where .= " AND sh.star_rate IN ($svalue)"; 
	
		}
		
		  if(!empty($facility))
		
		{
			$Fvalue='';
			$AMIvalue='';
			if(count($facility)==1)
	{
		
	  foreach($facility as $rows1)
	  {
		$where .= " AND sh.amenities LIKE ('%$rows1%')";  
	   }	
	}
	else
	{
		foreach($facility as $rows2)
	  {
		$where .= " AND sh.amenities LIKE ('%$rows2%')";  
	   }	
		
	}
	
	
		}
		
	//echo $where;exit;
		if($limit=='')
		{
//echo "select * from search_result sh  where sh.criteria_id = '".$ses_id."' AND min_cost != 0  $where GROUP BY sh.supplier_id ORDER BY  min_cost ASC";exit;
		$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$ses_id."' AND min_cost != 0  $where GROUP BY sh.supplier_id ORDER BY  min_cost ASC");
	
		}
		else
		{
			
			$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$ses_id."' AND min_cost != 0 $where GROUP BY sh.supplier_id ORDER BY  min_cost ASC limit $start,$limit");
		}
	return $query->result();
	
	}
	
	function fetch_search_result_ptol_page($ses_id,$limit,$start, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='price_asc')
	{
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit ";
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	}
	
	function fetch_last_viewd_deta($sec_res)
	{
		
	
	
	$query=$this->db->query("SELECT *
FROM (
`api_hotel_detail_t`
)
JOIN `last_viewd_details` ON `last_viewd_details`.`sess_id` = `api_hotel_detail_t`.`session_id`
AND `last_viewd_details`.`hcode` = `api_hotel_detail_t`.`hotel_code`JOIN `hotel_list` ON `last_viewd_details`.`hcode` = `hotel_list`. `HotelCode` 
WHERE sess_id = '$sec_res'
GROUP BY last_viewd_details.hcode");


	//echo $this->db->last_query();exit;
	
		
		if($query->num_rows() ==''){
			return '';			
		}
		else
		{
				return $query->result(); 
		}
		
	}
	
	function fetch_search_result($ses_id, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='')
	{
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta
//echo $select; exit;
		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	//echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	}
	
	function fetch_search_result_page($ses_id,$limit,$start,$page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='')
	{
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit ";
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta

		//echo $select;exit;
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		//$this->db->limit($limit, $start);
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code )  as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
	
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	}
	
	function fetch_sort_by_facilty($ses_id, $fac,$limit=false,$start=false)
	{
		$sorting='';
		$page=1;
		$maxStar = 5;
		$minStar = 0;
		$maxVal = '';
		$minVal = '';
		//echo "san".$fac;exit;
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
		} else {
			
			if($limit!='')
			{
				$where.= " and f.PAmenities like '%$fac%'";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND  t.hotel_code = f.HotelCode AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order limit $start,$limit";
			}
			else
			{
			$where.= " and f.PAmenities like '%$fac%'";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND  t.hotel_code = f.HotelCode AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			}
			//echo $select; exit;
		} 
		//chitta

		//echo $select; exit;
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
		//	echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	}
	function fetch_search_result_per($ses_id, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='')
	{
		
		$display_perpage = 10;
		$start_pos = $display_perpage * ($page-1);
		$where = '';
		
		if (!empty($minVal)) {
			$where.= "AND (t.total_cost BETWEEN $minVal AND $maxVal)";
		}
		
		$where.= " AND (p.StarRating BETWEEN 0 AND 5)";
		$order = 'ORDER BY low_cost ASC';
		if (!empty($sorting)) {
			switch ($sorting) {
			case 'name_asc':
				$order = 'ORDER BY p.hotel_name, low_cost ASC';
				break;
			case 'name_desc':
				$order = 'ORDER BY p.hotel_name DESC, low_cost ASC';
				break;
			case 'star_asc':
				$order = 'ORDER BY p.StarRating, low_cost ASC';
				break;
			case 'star_desc':
				$order = 'ORDER BY p.StarRating DESC, low_cost ASC';
				break;
			case 'price_asc':
				$order = 'ORDER BY low_cost ASC';
				break;
			case 'price_desc':
				$order = 'ORDER BY low_cost DESC';
				break;
				default:
				$order = 'ORDER BY low_cost ASC';
				break;
			}
		}
		
		if (empty($fac)) {
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND session_id = '$ses_id' $where GROUP BY t.hotel_code $order ";
		} else {
			$where.= " and MATCH(f.fac) AGAINST ('$fac' IN BOOLEAN MODE)";
			$select = "SELECT SQL_CALC_FOUND_ROWS *, MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where GROUP BY t.hotel_code $order";
			//echo $select; exit;
		} 
		//chitta

		
		$query = $this->db->query($select);
		//echo "<pre>"; print_r($query);exit;
		if ( $query->num_rows > 0 ) {
		
			$data['result'] = $query->result();
			//echo "<pre>"; print_r($data['result']);exit;
			$count = $this->db->query('SELECT FOUND_ROWS() as rowcount');
			$count = $count->result();

			$data['totRow'] = $count[0]->rowcount;
		
		
		if (empty($fac)) {
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
		} else {
			
			$select2 = "select MIN(low_cost) as minVal, MAX(low_cost) as maxVal from (
				SELECT MIN(t.total_cost) as low_cost FROM api_hotel_detail_t t, hotel_list p, hotel_amenties f, hotel_desc d WHERE t.hotel_code = p.HotelCode AND d.HotelCode = p.HotelCode and t.hotel_code = f.hotel_code AND t.session_id = '$ses_id' $where group by  t.hotel_code ) as tab";
				
			//echo $select2; exit;
		}
		
		//	echo $select2; exit();
			$query2 = $this->db->query($select2);
			$result2 = $query2->result();
			$data['minVal'] = $result2[0]->minVal;
			$data['maxVal'] = $result2[0]->maxVal;
			//$data['totRow'] = $result2[0]->totRow;
			return $data;
		}
      return false;
	
	}
	function get_merge_inclsuion_hotelsbed($hcode,$api,$cid,$cname)
		{
			if($api == 'hotelspro')
			{
					$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hcode' AND `api` = '$api' AND `status` IN ('AVAILABLE', 'OK','Available', 'InstantConfirmation', 'true') AND `session_id` = '$cid'";
			}
			else
			{
			$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hcode' AND `api` = '$api' AND `status` IN ('AVAILABLE', 'OK', 
			'Available', 'InstantConfirmation', 'true') AND `session_id` = '$cid' AND `contractnameVal` = '$cname'  GROUP BY inclusion,contractnameVal 
			";
		$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `hotel_code` = '$hcode' AND `api` = '$api' AND `status` IN ('AVAILABLE', 'OK', 
			'Available', 'InstantConfirmation', 'true') AND `session_id` = '$cid'   GROUP BY inclusion 
			";
			}
			//charval
			$query= $this->db->query($que);
			
			//echo $this->db->last_query();
			//}
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_searchresult($id)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('api_temp_hotel_id',$id);
		$this->db->join('hotel_list', 'api_hotel_detail_t.hotel_code = hotel_list.HotelCode');
		$this->db->join('hotel_desc', 'api_hotel_detail_t.hotel_code = hotel_desc.HotelCode');
		$query = $this->db->get();	
		
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  return $query->row(); 
		  }
		
	}
	function fetch_search_result_map_new_select($id)
		{
		
			$query=$this->db->query("SELECT  *, MIN(t.total_cost) AS low_cost FROM api_hotel_detail_t t, hotel_list p 
WHERE t.hotel_code = p.HotelCode AND t.api_temp_hotel_id='".$id."'");
		
		
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result_array();
				
			}
		}
		function get_facility_details_hotel($id)
	{
		$this->db->select('*');
		$this->db->from('hotel_amenties');
		$this->db->where('HotelCode',$id);
		//$this->db->where('fac_type','hotel');
		//$this->db->group_by("fac"); 
		$query = $this->db->get();	
//		echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  
		  return  $query->result(); 
		  }
		
	}
	function get_facility_details_room($id)
	{
			$this->db->select('*');
		//$this->db->from('api_permanent_facility');
		$this->db->from('hotel_amenties');
		$this->db->where('HotelCode',$id);
		//$this->db->where('fac_type','room');
	//$this->db->group_by("fac"); 
		$query = $this->db->get();	
//		echo $this->db->last_query();exit;
		if($query->num_rows() == 0 )
		{
		   return '';   
		  }else{
		  
		  return  $query->result(); 
		  }
		
	}
	function get_pro_pre_detail_hotelspro($hcode)
		{
			$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE `api_temp_hotel_id` = '$hcode' 
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
		function fetch_gta_temp_result_room_result_id($ses_id,$hotel_code)
	{
		$this->db->select('*');
		$this->db->from('api_hotel_detail_t');
		$this->db->where('session_id',$ses_id);
		$this->db->where('api_temp_hotel_id',$hotel_code);
		//$this->db->where('inclusion','Bed &amp; Breakfast');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->row();
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
		function get_cancel_attrib_new($result_id)
		{
			//echo $result_id;exit;
			$this->db->select('*');
			$this->db->from('api_hotel_detail_t');
			$this->db->where('api_temp_hotel_id',$result_id);
			
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();

			}
		}
		function get_individual_hotelspro($session,$hotel_code)
		{
			$this->db->select('*');
			$this->db->from('api_hotel_detail_t');
			$this->db->where('session_id',$session);
			$this->db->where('hotel_code',$hotel_code);
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();

			}
		}
		function get_details($id)
	{
		$que = "SELECT * FROM (`api_hotel_detail_t`) WHERE api_temp_hotel_id = $id";
			//charval
			$query= $this->db->query($que);
			//echo $this->db->last_query();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
	}
	function get_individual_hotelspro_room($result_id)
		{
			$this->db->select('*');
			$this->db->from('api_hotel_detail_t');
			$this->db->where('api_temp_hotel_id',$result_id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
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
		function inser_customer_book_hotelpro($h_hotel_id,$h_hotel_name,$h_star,$h_description,$h_address,$h_phone,$h_fax,$h_room_type,$h_cancel_policy,$cin,$cout,$date,$roomcountss,$user_id,$nights,$trans_id,$h_adult,$h_child,$con_id,$dateFromValc,$h_city,$api,$ProcessId,$memid)
 	{
		//echo $dateFromValc; exit;
	$h_adult= $this->session->userdata('adult_count');
	$h_child= $this->session->userdata('child_count');

$data=array('customer_contact_details_id'=>$con_id,'hotel_code'=>$h_hotel_id,'hotel_name'=>$h_hotel_name,'star'=>$h_star,
			'description'=>$h_description,'address'=>$h_address,'phone'=>$h_phone,'fax'=>$h_fax,'room_type'=>$h_room_type,'cancel_policy'=>$h_cancel_policy,'check_in'=>$cin,'check_out'=>$cout,'voucher_date'=>$date,'no_of_room'=>$roomcountss,'provider_id'=>'1','nights'=>$nights,'adult'=>$h_adult,'child'=>$h_child,'cancel_tilldate'=>$dateFromValc,'city'=>$h_city,'api'=>$api,'item_code'=>$ProcessId,'trans_id'=>$trans_id,'memid'=>$memid);
			$this->db->insert('hotel_booking_info',$data);
			return $this->db->insert_id();
	
 }
 function inser_customer_book_hotelpro_trans_hotel($trans_id,$ConfirmationNumbervalue,$userid,$val_last,$BookingStatusvalue)
	{

	 	$this->db->query("UPDATE transaction_details SET prn_no='$ConfirmationNumbervalue',booking_number='$ConfirmationNumbervalue',  user_id='$userid' , hotel_booking_id='$val_last', status='$BookingStatusvalue'  WHERE customer_contact_details_id ='$trans_id'");
		
		
	}
	function book_detail_view_voucher1($book_id)
	{
		   $this->db->select('*');
		   $this->db->from('hotel_booking_info');
			$this->db->where('hotel_booking_info_id',$book_id);
				//$this->db->where('agent_id', $this->session->userdata('agentid'));

				$query=$this->db->get();
				//echo $this->db->last_query();exit;
				if($query->num_rows() ==''){
					return '';
				}else{
					return $query->row();
				}
		 }
		 function book_detail_view($book_id)
	{
		   $this->db->select('*');
		   $this->db->from('hotel_booking_info');
			$this->db->where('hotel_booking_info_id',$book_id);
				//$this->db->where('agent_id', $this->session->userdata('agentid'));

				$query=$this->db->get();
				//echo $this->db->last_query();exit;
				if($query->num_rows() ==''){
					return '';
				}else{
					return $query->row();
				}
		 }
	function transation_detail_contact($id)
	{

		$que="select * from  transaction_details WHERE 	customer_contact_details_id = ".$id." ";
		
	
		$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}

	}
	function booking_transation_detail($id)
	{

		$que="select * from  transaction_details WHERE 	hotel_booking_id = ".$id." ";
		
	
		$query= $this->db->query($que);
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}

	}
		function gethb_hoteldet($hotelCode)
		{
			$query = $this->db->query("SELECT * FROM hb_hotel WHERE HOTELCODE='$hotelCode'");
			if($query->num_rows =='')
			{
				return '';
			}else{
				return $query->row();
			}
		}
		function gethb_hotelimage_new($hotelCode)
		{
		//$val="GEN";
			$query = $this->db->query("SELECT * FROM  hotel_list WHERE HotelCode='$hotelCode'");
			if($query->num_rows =='')
			{
				return '';
			}else{
				return $query->result();
			}
		}
		function get_city_code($city)
		{
			$this->db->select('*');
			//$this->db->from('api_hotels_city');
			$this->db->from('hotelspro_cities');
			$this->db->where('City',$city);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->row(); 
			  }
	
		}
		function get_room_process($id)
		{
			$query = $this->db->query('select * from hotel_booking_info WHERE hotel_booking_info_id='.$id);
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->row();
			}
		}
		function get_amout_cancel1($id)
		{
			$query = $this->db->query('select * from hotel_booking_info h inner join transaction_details t on h.hotel_booking_info_id = t.hotel_booking_id WHERE t.transaction_details_id='.$id);
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->row();
			}
		}
		function update_booking_status1($cancel_status,$cancel_note,$tot_cancel,$id)
		{
			$data=array('status'=>$cancel_status);
		   $this->db->where('transaction_details_id',$id);
		   $this->db->update('transaction_details',$data);
		}
		function get_book_status($id)
		{
			$query = $this->db->query('select * from transaction_details WHERE hotel_booking_id ='.$id);
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->row();
			}
		}
		function delete_already_hotels($ses_id,$id)
		{
			$this->db->query("DELETE FROM api_hotel_detail_t where session_id = '".$ses_id."' AND hotel_code='".$id."'");
			//echo $this->db->last_query();exit;
		}
		
		function fetch_min_price($sec_res,$supplier_id)
		{
			$query = $this->db->query("SELECT min(single_rate) as min_cost FROM search_result_rooms WHERE 
 criteria_id='".$sec_res."' AND supplier_id='".$supplier_id."' AND single_rate != 0");
		
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->result();
			}
		}
		
		function fetch_min_price1($sec_res,$supplier_id)
		{
			echo "SELECT min(single_rate) as min_cost FROM search_result_rooms WHERE 
 criteria_id='".$sec_res."' AND supplier_id='".$supplier_id."' AND double_rate != 0";
			$query = $this->db->query("SELECT min(single_rate) as min_cost FROM search_result_rooms WHERE 
 criteria_id='".$sec_res."' AND supplier_id='".$supplier_id."' AND double_rate != 0");
		
			if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->result();
			}
		}
		
		function get_result($sec,$limit=false,$start=false)
		{
			if($limit=="")
			{
			
		$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY min_cost ASC");
	}
	else
	{
		$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY min_cost ASC limit $start,$limit ");
	}

		if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->result();
			}
		}
		
		function fetch_search_result_hotel_ptol($sec,$limit=false,$start=false)
		{
			if($limit=="")
			{
			
		$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY min_cost ASC");
	}
	else
	{
		$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY min_cost ASC limit $start,$limit");
	}

		if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->result();
			}
		}
		
			function fetch_search_result_hotel_sltoh($sec,$limit=false,$start=false)
		{
			if($limit=="")
			{
						
				$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY star_rate ASC");
			}
			else
			{
				$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY star_rate ASC limit $start,$limit");
			}

		    if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->result();
			}
		}
		
		
		function fetch_search_result_hotel_shtol($sec,$limit=false,$start=false)
		{
			if($limit=="")
			{
						
				$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY star_rate DESC");
			}
			else
			{
				$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY star_rate DESC limit $start,$limit");
			}

		    if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->result();
			}
		}
		
		function fetch_search_result_hotel_altoh($sec,$limit=false,$start=false)
		{
			if($limit=="")
			{
						
				$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY hotel_name ASC");
			}
			else
			{
				$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY hotel_name ASC limit $start,$limit");
			}

		    if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->result();
			}
		}
		function fetch_search_result_hotel_ahtol($sec,$limit=false,$start=false)
		{
			if($limit=="")
			{
						
				$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY hotel_name DESC");
			}
			else
			{
				$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY hotel_name DESC limit $start,$limit");
			}

		    if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->result();
			}
		}
		
		
		function fetch_search_result_hotel_pHol($sec,$limit=false,$start=false)
		{
			if($limit=="")
			{
			
		$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY min_cost DESC");
	}
	else
	{
		$query =$this->db->query("select * from search_result sh  where sh.criteria_id = '".$sec."' AND min_cost != 0 GROUP BY sh.supplier_id ORDER BY min_cost DESC limit $start,$limit");
	}

		if($query->num_rows() == '')
			{
				return '';
			}
			else
			{
			 return $query->result();
			}
		}
		
		
		function get_all_bookid()
		{
			
		  $memid=$this->session->userdata('memberid');	
		  $this->db->select('*');
			$this->db->from('hotel_booking_info');
			$this->db->join('member_registration', 'member_registration.MEMcode  = hotel_booking_info.memid');
			$this->db->where('hotel_booking_info.memid',$memid);
			$this->db->order_by('hotel_booking_info.hotel_booking_info_id','desc');
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->result(); 
			  }
		}
		
		function get_all_bookid_ind($id)
		{
			
		  $memid=$this->session->userdata('memberid');	
		  $this->db->select('*');
			$this->db->from('hotel_booking_info');
			$this->db->join('member_registration', 'member_registration.MEMcode  = hotel_booking_info.memid');
			$this->db->join('transaction_details', 'transaction_details.hotel_booking_id  = hotel_booking_info.hotel_booking_info_id');
			$this->db->where('hotel_booking_info_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->row(); 
			  }
		}
		
			function get_all_bookid_details($id)
		{
			
		  
		  $this->db->select('*');
			$this->db->from('transaction_details');
			$this->db->where('transaction_details_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->row(); 
			  }
		}
				function get_one_bd_bookid_details($id)
		{
			
		  
		  $this->db->select('*');
			$this->db->from('transaction_details');
			$this->db->where('hotel_booking_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->row(); 
			  }
		}
		function get_one_bookid_details($id)
		{
			
			 
		  $this->db->select('*');
			$this->db->from('hotel_booking_info');
			$this->db->join('transaction_details', 'transaction_details.transaction_details_id  = hotel_booking_info.trans_id');
			$this->db->where('hotel_booking_info.hotel_booking_info_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->row(); 
			  }
		}
		function get_onebook_details($id)
		{
			
			 
		  $this->db->select('*');
			$this->db->from('hotel_booking_info');
			$this->db->join('transaction_details', 'transaction_details.hotel_booking_id  = hotel_booking_info.hotel_booking_info_id');
			$this->db->where('hotel_booking_info.hotel_booking_info_id',$id);
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->row(); 
			  }
		}
		
		
		function hotel_details($hid)
		{
			$sec_res=$this->session->userdata('ses_id');
			//echo "select * from search_result where criteria_id = '".$sec_res."' AND hotel_id = '".$hid."'";
		$query = $this->db->query("select * from search_result where criteria_id = '".$sec_res."' AND hotel_id = '".$hid."'");
		if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->row(); 
			  }
			
		}
		function get_room_details($id)
		{
			$sec_res=$this->session->userdata('ses_id');
		 $query =$this->db->query("select * from search_result_rooms where criteria_id = '".$sec_res."' AND 
		 supplier_id = '".$id."' GROUP BY roomid ");
		if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->result(); 
			  }
		}
		
		function room_cost_days($roomid,$sup_id)
		{
			$sec=$this->session->userdata('ses_id');
			//echo "select * from search_result_rooms WHERE criteria_id='".$sec."' AND supplier_id = '".$sup_id."' AND roomid ='".$roomid."' GROUP BY day";exit;
		$query = $this->db->query("select * from search_result_rooms WHERE criteria_id='".$sec."' AND supplier_id = '".$sup_id."' AND roomid ='".$roomid."' GROUP BY day");
		if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
				 
			return  $row = $query->result(); 
			 
		
			  }
			
		}
		
		function get_room_details_new($id,$rid)
		{
			
			$sec_res=$this->session->userdata('ses_id');
		$query =$this->db->query("select * from search_result_rooms where criteria_id = '".$sec_res."' AND supplier_id = '".$id."' AND roomid ='".$rid."'");
			if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  return $query->row(); 
			  }
		}
		function get_last_insert_id()
		{
				$query =$this->db->query("select hotel_booking_info_id from hotel_booking_info ORDER BY hotel_booking_info_id DESC");
			if($query->num_rows() == '' )
			{
			   return '';   
			  }else{
			  $val = $query->row(); 
			  return $val->hotel_booking_info_id;
			  }
		}
		function get_cust_login_details($id)
		{
			if($id != '')
			{
				$query = $this->db->query('select * from user WHERE user_id='.$id);
				if($query->num_rows() == '')
				{
					return '';
				}
				else
				{
				 return $query->row();
				}
			}
			else
			{
				return '';
			}
			
		}
	}
?>
