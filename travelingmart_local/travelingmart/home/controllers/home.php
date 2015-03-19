<?php
session_start();
class Home extends CI_Controller {

	public function __construct()
    {
	    parent::__construct();
		//$this->load->model('supplier_model');
		$this->load->model('Home_Model');
		$this->load->model('Hotel_Model');
		//$this->load->model('Member_Model');
	}
	
	function goglobal_availability()
	{
		
		
		$xml = '<Root>
					<Header>
						<Agency>1521228</Agency>
						<User>TRVLMRTXML</User>
						<Password>SLA2WLEP</Password>
						<Operation>HOTEL_SEARCH_REQUEST</Operation>
						<OperationType>Request</OperationType>
					</Header>
					<Main>
						<SortOrder>1</SortOrder>
						<FilterPriceMin>0</FilterPriceMin>
						<FilterPriceMax>10000</FilterPriceMax>
						<MaximumWaitTime>20</MaximumWaitTime>
						<MaxResponses>500</MaxResponses>
						<FilterRoomBasises>
							<FilterRoomBasis>HB</FilterRoomBasis>
						</FilterRoomBasises>
						<HotelName></HotelName>
						<CityCode>75</CityCode>
						<ArrivalDate>2013-09-25</ArrivalDate>
						<Nights>1</Nights>
						<Stars>5</Stars>
						<Rooms>
							<Room Type="SGL" RoomCount="1" />
						</Rooms>
					</Main>
				</Root>';
			$URL2 ="http://xml.qa.goglobal.travel/XMLWebService.asmx";
			
		$action = "http://www.goglobal.travel/MakeRequest";
			
			$data = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <MakeRequest xmlns="http://www.goglobal.travel/">
      <requestType>11</requestType>
      <xmlRequest>'.$xml.'</xmlRequest>
    </MakeRequest>
  </soap:Body>
</soap:Envelope>';

			$ch2=curl_init();
		  //$header[] = "Accept: application/xml";
		  echo $data; 
			curl_setopt($ch2, CURLOPT_URL, $URL2);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
	
        	$httpHeader2 = array(
            "Content-type: text/xml;charset=\"utf-8\"",
			"Accept: text/xml",
			"Cache-Control: no-cache",
			"Pragma: no-cache",
			"SOAPAction: ".$action,
			"Content-length: ".strlen($data)
			
       	 );
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
		
		curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
		$data2=curl_exec($ch2);
		$error2=curl_getinfo( $ch2, CURLINFO_HTTP_CODE );
		curl_close($ch2);
		echo "<pre>"; $error2; 
		echo "<pre>";print_r($data2);
		
	}
	function get_hotels()
	{
		$city1 = $this->input->post('city');
		$city2 = explode(',',$city1);
		$hotels = $this->Home_Model->get_hotels($city2[0]);
		echo '<option value="">Select Hotel Name</option>
					';
		foreach($hotels as $htl)
		{
			echo '<option value="'.$htl->Name.'">'.$htl->Name.'</option>';
		}
		//echo '</select>';
	}
	function hotel_search()
	{
		header('Cache-Control: max-age=900');
		/*$sec_res=$this->session->userdata('sec_res');
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  GROUP BY hotel_id");
		$data['results'] = $sresult=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='5' GROUP BY hotel_id");
		$data['results_5star'] = $results_5star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='4' GROUP BY hotel_id");
		$data['results_4star'] = $results_4star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='3' GROUP BY hotel_id");
		$data['results_3star'] = $results_3star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='2' GROUP BY hotel_id");
		$data['results_2star'] = $results_2star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='1' GROUP BY hotel_id");
		$data['results_1star'] = $results_1star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='0' GROUP BY hotel_id");
		$data['results_0star'] = $results_0star=$query->result();*/
		//$this->load->view('hotel/hotel_search',$data);	
		$changed_cur = $this->input->post('changed_cur');
		if($changed_cur == '')
		{
			require_once('geoplugin.class.php');
			$geoplugin = new geoPlugin();
			$geoplugin->locate($_SERVER['REMOTE_ADDR']);
			"Currency Code: {$geoplugin->currencyCode} <br />\n".
			"Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
			"Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
			$data['host_currencyCode'] = $geoplugin->currencyCode;
			//$data['host_currencyCode'] = 'USD';
			$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
		}
		else
		{
			$data['host_currencyCode'] = $changed_cur;
			//$data['host_currencyCode'] = 'USD';
			$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
		}
		$sec_res=$this->session->userdata('sec_res');
		$query=$this->db->query("SELECT cost_type FROM search_result WHERE criteria_id = '$sec_res'");	
		$val = $query->row();
		
		if($changed_cur != '')
		{
			$this->session->set_userdata(array('host_currencyCode'=>$changed_cur));
		}
		
		$data['changed_cur'] = $data['host_currencyCode'];
		$data['anand'] = $anand =$val->cost_type;
		//echo '<pre>'; print_r($data);exit;
		$this->load->view('hotel/hotel_search',$data);		
	}
	function hotel_location_results()
	{
		//echo $this->input->post('loca');
		header('Cache-Control: max-age=900');
		$location = '';
		$start = 1;
		$per_page = 15;
		$sec_res=$this->session->userdata('sec_res');
		$count_loc = $this->input->post('count_loc');
		for($i = 1; $i<=$count_loc; $i++) 
		{
			//echo $this->input->post('loca'.$i); 
			$location .= $this->input->post('loca'.$i);
		}
		//echo $location; exit;
		$loc = explode(',',$location);
		//echo "<pre>"; print_r($loc); exit;
		$data['loc'] = $loc;
		$data['result_pag_data'] = $this->Home_Model->hotel_location_results($sec_res,$start,$per_page,$location);
		$this->load->view('hotel/hotel_search',$data);
	}
	
	function deals()
	{
		$this->load->view('holiday/deals');
	}
	function hotel_location_results2()
	{
		//echo $this->input->post('loca');
		header('Cache-Control: max-age=900');
		$location = '';
		$start = 1;
		$per_page = 15;
		$sec_res=$this->session->userdata('sec_res');
		$count_loc = $this->input->post('count_loc');
		for($i = 1; $i<=$count_loc; $i++) 
		{
			//echo $this->input->post('loca'.$i); 
			$location .= $this->input->post('loca'.$i);
		}
		//echo $location; exit;
		$loc = explode(',',$loca);
		//echo "<pre>"; print_r($loc); exit;
		$data['loc'] = $loc;
		$data['result_pag_data'] = $this->Home_Model->hotel_location_results($sec_res,$start,$per_page,$location);
		$this->load->view('hotel/hotel_search',$data);
	}
	function hotel_board_results()
	{
		header('Cache-Control: max-age=900');
		$bord_type = '';
		$start = 1;
		$per_page = 15;
		$sec_res=$this->session->userdata('sec_res');
		$count_loc = $this->input->post('board_count');
		for($i = 1; $i<=$count_loc; $i++) 
		{
			//echo $this->input->post('loca'.$i); 
			$bord_type .= $this->input->post('bord_type'.$i);
		}
		//echo $location; exit;
		$bord = explode(',',$bord_type);
		//echo "<pre>"; print_r($loc); exit;
		$data['bord'] = $bord;
		$data['result_pag_data'] = $this->Home_Model->hotel_board_results($sec_res,$start,$per_page,$bord_type);
		$this->load->view('hotel/hotel_search',$data);
	}
	/*function results_sort()
	{
		
		$sec_res=$this->session->userdata('sec_res');
		$page = $this->input->post('page');
		$star = $this->input->post('star');
		$anand = $this->input->post('anand');
		$changed_cur = $this->input->post('changed_cur');
	//	$hotel = $this->input->post('hotel');
		$hotel = '';
		$loc_a = $this->input->post('loc_a');
		if($loc_a != '')
		{
			$loc_a = substr($loc_a,0,-1);
		}
		//echo $loc_a;exit;
		$cur_page = $page;
		$page -= 1;
		$per_page = 25;
		
		$start = $page * $per_page;
		
		$data['result_pag_data'] = $result_pag_data = $this->Home_Model->get_all_sort($sec_res,$start,$per_page,$star,$hotel,$loc_a);
		if($changed_cur == '')
		{
			if($this->session->userdata('host_currencyCode'))
			{
			}
			else
			{
				require_once('geoplugin.class.php');
				$geoplugin = new geoPlugin();
				$geoplugin->locate($_SERVER['REMOTE_ADDR']);
				"Currency Code: {$geoplugin->currencyCode} <br />\n".
				"Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
				"Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
				$data['host_currencyCode'] = $geoplugin->currencyCode;
				$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
			}
		}
		else
		{//echo ';aasdfasdf';exit;
			$data['host_currencyCode'] = $changed_cur;
			$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
		}
		//echo $this->session->userdata('host_currencyCode');
//		echo $anand;exit;
		if($this->session->userdata('host_currencyCode') != $anand)
		{
		
			$url = "http://www.google.com/ig/calculator?hl=en&q=1".$anand."=?".$this->session->userdata('host_currencyCode');
			$options = array(
					CURLOPT_RETURNTRANSFER => true, // return web page
					CURLOPT_HEADER         => false,// don't return headers
					CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
			);
			$ch = curl_init($url);
			curl_setopt_array( $ch, $options );
			$amtcon = curl_exec( $ch ); //let's fetch the result using cURL
			curl_close( $ch );
			if( $amtcon === FALSE )
				return $amtcon;
				$amtcon = explode('"',$amtcon);
				$amtcon = str_replace(chr(160), '', substr( $amtcon[3], 0, strpos($amtcon[3], ' ') ) );
				( $amtcon == 0 ) ? FALSE : $amtcon;		
				$data['new_cost'] = sprintf ("%.2f", $amtcon);
		}
		else
		{
			$data['new_cost'] = '';
		}
		$hotel_search_result  = $this->load->view('hotel/search_result_ajax',$data,true);
		$hotel_search_star  = $this->load->view('hotel/search_result_star',$data,true);
		
		 // Content for Data


		
		//$query_pag_num = count($hotel_search_result);
		$query_pag_num = $this->Home_Model->get_all_count($sec_res);
		$count = count($query_pag_num);
		$no_of_paginations = ceil($count / $per_page);
		//$count = count($result_pag_data);
		$no_of_paginations = ceil($count / $per_page);
		$msg = $this->pagination($cur_page,$no_of_paginations);
			print json_encode(array(
					'hotel_search_result' => $hotel_search_result,
					'msg' => $msg,
					'count'=>$count,
					'hotel_search_star'=>$hotel_search_star
					));
			
	}*/
	function currency_converter($from, $to, $total_currency='') 
    {
        $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $from . $to . '=X';
        $handle = @fopen($url, 'r');
        if ($handle) {
            $result = fgets($handle, 4096);
            fclose($handle);
        }
        $allData = explode(',', $result); /* Get all the contents to an array */

        $to_currency_value = $allData[1];
        $time = $allData[2] . ':' . $allData[3];

        $final_currency_value = $total_currency * $to_currency_value;
        return $to_currency_value;
    }
	function results()
	{
		$sec_res=$this->session->userdata('sec_res');
		$page = $this->input->post('page');
		$anand = $this->input->post('anand');
		$changed_cur = $this->input->post('changed_cur');
		$star = $this->input->post('star');
		$bord_type_a = $this->input->post('bord_type_a');
		$hotel = $this->input->post('hotel');
		$loc_a = $this->input->post('loc_a');
		$sort_asc_data = $this->input->post('sort_asc_data');
		$sort_asc_type = $this->input->post('sort_asc_type');
		if($loc_a != '')
		{
			$loc_a = substr($loc_a,0,-1);
		}
		if($star != '')
		{
			$star = substr($star,0,-1);
		}
		if($bord_type_a != '')
		{
			$bord_type_a = substr($bord_type_a,0,-1);
		}
		//echo $star;exit;
		$data['star'] = $star;
		$data['loc_a'] = $loc_a;
		$data['bord_type_a'] = $bord_type_a;
		$data['hotel'] = $hotel;
		$cur_page = $page;
		$page -= 1;
		$per_page = 25;
		$start = $page * $per_page;
		$hotel_search_star = '';
		if($changed_cur == '')
		{
			if($this->session->userdata('host_currencyCode'))
			{
			}
			else
			{
				require_once('geoplugin.class.php');
				$geoplugin = new geoPlugin();
				$geoplugin->locate($_SERVER['REMOTE_ADDR']);
				"Currency Code: {$geoplugin->currencyCode} <br />\n".
				"Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
				"Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
				$data['host_currencyCode'] = $geoplugin->currencyCode;
				//$data['host_currencyCode'] = 'USD';
				$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
			}
		}
		else
		{//echo ';aasdfasdf';exit;
			//$data['host_currencyCode'] = $changed_cur;
			$data['host_currencyCode'] = 'USD';
			$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
		}
		
		if($this->session->userdata('host_currencyCode') != $anand)
		{
			$data['new_cost'] = $this->currency_converter($anand,$this->session->userdata('host_currencyCode'));
		}
		else
		{
			$data['new_cost'] = '';
		}
		if($loc_a != '' || $star != '' || $hotel != '' || $bord_type_a != '' || $hotel != '')
		{
			$data['result_pag_data'] = $result_pag_data = $this->Home_Model->get_all_sort($sec_res,$start,$per_page,$star,$hotel,$loc_a,$bord_type_a,$hotel,$sort_asc_data,$sort_asc_type);
		}
		else
		{	//echo 'asdfasdf'; exit;
			$data['result_pag_data'] = $result_pag_data = $this->Home_Model->get_all($sec_res,$start,$per_page,$sort_asc_data,$sort_asc_type);
		}
//echo "result";	echo '<pre>'; print_r($data);exit;
		$hotel_search_result  = $this->load->view('hotel/search_result_ajax',$data,true);
		$hotel_search_star  = $this->load->view('hotel/search_result_star',$data,true);
		
		 // Content for Data


/* --------------------------------------------- */
		if($loc_a != '' || $star != '' || $hotel != '' || $bord_type_a != '')
		{
			$query_pag_num = $this->Home_Model->get_all_count_sort($sec_res,$start,$per_page,$star,$hotel,$loc_a,$bord_type_a);
		}
		else
		{
			$query_pag_num = $this->Home_Model->get_all_count($sec_res);
		}
$count = count($query_pag_num);
$no_of_paginations = ceil($count / $per_page);
$msg = $this->pagination($cur_page,$no_of_paginations);
	print json_encode(array(
			'hotel_search_result' => $hotel_search_result,
			'msg' => $msg,
			'count'=>$count,
			'hotel_search_star'=>$hotel_search_star
			));
	}
	function pagination($cur_page,$no_of_paginations)
	{
			
		$msg = "";
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
$msg = "<div class='data'><ul>" . $msg . "</ul></div>";
/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>First</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>Previous</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#e32121;' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
}
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px; border:1px #e32121 solid; margin-right:5px; padding:2px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
return $msg;
	}
	function hotel_search_filter()
	{
		header('Cache-Control: max-age=900');
		$star = $this->input->post('star');
		$hotel_name = $this->input->post('hotel_name');
		$sec_res=$this->session->userdata('sec_res');
		if($star != '')
		{
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND `star_rate` IN  ($star) GROUP BY hotel_id");
			//echo "SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND `star_rate` IN  ('0','1','2','3','4','5') GROUP BY hotel_id";
			$data['results'] = $sresult=$query->result();
		}
		elseif($hotel_name != '' )
		{
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND `hotel_name` LIKE  '%$hotel_name%' GROUP BY hotel_id");
			$data['results'] = $sresult=$query->result();
		}
		//echo "<pre>"; print_r($sresult); exit;
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='5' GROUP BY hotel_id");
		$data['results_5star'] = $results_5star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='4' GROUP BY hotel_id");
		$data['results_4star'] = $results_4star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='3' GROUP BY hotel_id");
		$data['results_3star'] = $results_3star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='2' GROUP BY hotel_id");
		$data['results_2star'] = $results_2star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='1' GROUP BY hotel_id");
		$data['results_1star'] = $results_1star=$query->result();
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request')  AND `star_rate` ='0' GROUP BY hotel_id");
		$data['results_0star'] = $results_0star=$query->result();
		$this->load->view('hotel/hotel_search_ajax',$data);	
	}
	/*function prop_detail($hid,$hotelname)
	{
		header('Cache-Control: max-age=900');
		$sec_res=$this->session->userdata('sec_res');
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND hotel_id = $hid");
		$data['res'] = $sresult=$query->result();
		//echo "<pre>"; print_r($sresult); exit;
		$data['cnt'] = $this->Home_Model->get_allcur();
		$this->load->view('hotel/prop_detail',$data);
	}*/
	function cancelation_policyhp()
	{
		$result_id = $this->input->post('result_id');
		//$hotel_code = $this->input->post('hotel_code');
		$pre = $this->Home_Model->get_pro_pre_detail_hotelspro($result_id);
		//$service=$this->Hotel_Model->get_searchresult($result_id);
		//$data['service']=$service;
		$hotel_proid = $pre->room_catecode;
		$data['tot']= $pre->nightperroom;
		$data['usd']= $pre->nightperroom;
		$data['share_cost']=$pre->nightperroom;
		$data['pro_room_type']= $pre->room_type;
		$without_markup=$pre->nightperroom;
		$data['inc']=$pre->inclusion;
		$hotel_code = $pre->hotel_id;
		$processId=$hotel_proid;
		if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.108')
		{
			$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
		}
		else
		{
			$url = "http://api.hotelspro.com/4.1/hotel/b2bHotelSOAP.wsdl";
			//$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
		}
		$client = new SoapClient($url, array('trace' => 1));
   		
		try
		{
			$data['errordesc']='';
			$getHotelCancellationPolicy = $client->getHotelCancellationPolicy("WTBSbm8yS001a0dVNFo3VTdMcWFDOUphNEhwNnRDOGlKQ21nZHorSHd0TnNnd3dncjNUbjZrTjhVaTZ6N29ERA==", $processId);
		}
		
		catch (SoapFault $exception)
		{
			$data['errordesc'] = $exception->getMessage();
		} 
		if($data['errordesc']!='')
  		{
			$data['error']=$data['errordesc'];
			echo $data['error'];
			//$this->load->view('hotel/error_page',$data);
		}
		else
		{
			//echo "<pre>"; print_r($getHotelCancellationPolicy); exit;
			$val=array();
			$val1=array();
			$policies = is_array($getHotelCancellationPolicy->cancellationPolicy) ? $getHotelCancellationPolicy->cancellationPolicy : array($getHotelCancellationPolicy->cancellationPolicy);
			//echo "<pre/>";print_r($policies);exit;
			foreach ($policies as $policy) {
       		$val[]= $policy->cancellationDay;
		 	if(isset($policy->currency))
			{
          		$val1[]=  $policy->currency;
			}
		 	else
		 	{
				$val1[]="USD";
			}
      		$val2=  $policy->feeAmount;
    		$cutype = $policy->feeType;
          }
		if($cutype=='Percent')
		{
			$cancelamount=($data['tot']/100)*$val2;
		}
		else
		{
			$cancelamount=$val2;
		}
		$day_before_check=$val[0];

		$data['charge_ty']=$val1[0];
		$data['charge_amt']=$cancelamount;

		$data['hotel_code']=$hotel_code;
		$data['hotel_proid']=$hotel_proid;
		$data['result_id']=$result_id;
		$data['api']='hotelspro';
	
		  $cancel='Cancellation penalty for cancellation made within '.$day_before_check.' days of the '.$this->session->userdata('sd').'
						 is 1 night room rate.';

						  
                    $cancel .='<br>Cancellations made within '.$day_before_check.' days of the '.$this->session->userdata('sd').' (after the deadline)  will be assessed a cancellation penalty.';
					//echo $cancel;exit;
       // $data['cancel_policy']=$cancel;
	   echo "<td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='color:#333;'>
      <tr>
        
        <td valign='top'><table width='98%' border='0' align='left' cellpadding='5' cellspacing='0' style='padding-left:10px;'>
          <tr>
            <td colspan='2'>&nbsp;</td>
            </tr>
          <tr>
            <td height='30' colspan='2' style='border-bottom:1px #bfbfbf dashed; padding-bottom:5px;  line-height:18px;'><strong>Cancellation Description</strong>
			<br />
			Arrival Date : ".$this->session->userdata('sd')."
			<br />
			Cancellation Policy : ".$cancel."<br />
             </td>
            </tr>
          
         
        </table></td>
      </tr>
      <tr>
        <td valign='top'>&nbsp;</td>
        <td valign='top'>&nbsp;</td>
      </tr>
    </table></td>";
		}
	}
	function cancelation_policy()
	{
		 $hotel_search = $this->input->post('hotel_search');
		 $arrival_date = $this->session->userdata('start_date');
		 if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
				{
					$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '1521228';
					$user = 'TRVLMRTXML';
					$password = 'SLA2WLEP';
				}
				else
				{
					$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '37398';
					$user = 'TRAVELLINGMARTXML';
					$password = 'SAYADMANAMAH';
                    /*$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '1521228';
					$user = 'TRVLMRTXML';
					$password = 'SLA2WLEP';*/
				}
		 try {
			 $options = array(
			  'soap_version' => SOAP_1_1,
			  'exceptions' => true,
			  'trace'   => 1,
			  'cache_wsdl' => WSDL_CACHE_NONE,
			  "Content-Type: text/json; charset=UTF-8",
				"Content-Encoding: UTF-8",
				"Accept: application/xml",
				"Accept-Encoding: gzip"
			 );
			 
			 $soapclient = new SoapClient($url, $options);
			} catch(Exception $e) {
			 echo "<h2>Exception Error!</h2>";
			 echo $e->getMessage();
			}
			 
			try {
			 $param1=array ("requestType"=>"9","xmlRequest"=>"<Root>
				<Header>
					<Agency>".$agency."</Agency>
					<User>".$user."</User>
					<Password>".$password."</Password>
					<Operation>BOOKING_VALUATION_REQUEST</Operation>
					<OperationType>Request</OperationType>
				</Header>
				<Main>
					<HotelSearchCode>".$hotel_search."</HotelSearchCode>
					<ArrivalDate>".$arrival_date."</ArrivalDate>
				</Main>
			</Root>");
			//print_r($param1);  exit;
			 $result1 = $soapclient->MakeRequest($param1);
			} catch(Exception $e) {
			 echo "Caught exception : ", $e->getMessage, "\n";
			}
			 
			//echo "<pre>";
			//print_r($result1); exit;
			$arr1 = (array) $result1;
			$array1 = $this->xml2array($arr1['MakeRequestResult']);
			if(isset($array1['Root']['Main']))
			{
				$hotel = $array1['Root']['Main'];
				if(isset($hotel['HotelSearchCode']['value']))
				{
					$data['HotelSearchCode'] = $HotelSearchCode = $hotel['HotelSearchCode']['value'];
				}
				else
				{
					$data['HotelSearchCode'] = $HotelSearchCode = '';
				}
				if(isset($hotel['HotelSearchCode']['value']))
				{
					$data['ArrivalDate'] = $ArrivalDate = $hotel['ArrivalDate']['value'];
				}
				else
				{
					$data['ArrivalDate'] = $ArrivalDate = '';
				}
				if(isset($hotel['CancellationDeadline']['value']))
				{
					$data['CancellationDeadline'] = $hotel['CancellationDeadline']['value'];
				}
				else
				{
					$data['CancellationDeadline'] = '';
				}
				if(isset($hotel['Remarks']['value']))
				{
					$data['Remarks'] = $hotel['Remarks']['value'];
				}
				else
				{
					$data['Remarks'] = '';
				}
				if(isset($hotel['Rates']['value']))
				{
					$data['Rates'] = $hotel['Rates']['value'];
				}
				else
				{
					$data['Rates'] = '';
				}
			}
			//echo "<pre>"; print_r($array1); exit;
			
			echo "<td><table width='100%' border='0' cellspacing='0' cellpadding='0' style='color:#333;'>
      <tr>
        
        <td valign='top'><table width='98%' border='0' align='left' cellpadding='5' cellspacing='0' style='padding-left:10px;'>
          <tr>
            <td colspan='2'>&nbsp;</td>
            </tr>
          <tr>
            <td height='30' colspan='2' style='border-bottom:1px #bfbfbf dashed; padding-bottom:5px;  line-height:18px;'><strong>Cancellation Description</strong>
			<br />
			Arrival Date : ".$ArrivalDate."
			<br />
			Cancellation Deadline : ".$data['CancellationDeadline']."<br />
             Cancellation Policy : ".$data['Remarks']." </td>
            </tr>
          
         
        </table></td>
      </tr>
      <tr>
        <td valign='top'>&nbsp;</td>
        <td valign='top'>&nbsp;</td>
      </tr>
    </table></td>";

	}
	function price_breakdown()
	{
		
		try {
			 $options = array(
			  'soap_version' => SOAP_1_1,
			  'exceptions' => true,
			  'trace'   => 1,
			  'cache_wsdl' => WSDL_CACHE_NONE,
			  "Content-Type: text/json; charset=UTF-8",
				"Content-Encoding: UTF-8",
				"Accept: application/xml",
				"Accept-Encoding: gzip"
			 );
			 
			 if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
				{
					$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '1521228';
					$user = 'TRVLMRTXML';
					$password = 'SLA2WLEP';
				}
				else
				{
					$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '37398';
					$user = 'TRAVELLINGMARTXML';
					$password = 'SAYADMANAMAH';
                    /*$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '1521228';
					$user = 'TRVLMRTXML';
					$password = 'SLA2WLEP';*/
				}
			 $soapclient = new SoapClient($url, $options);
			} catch(Exception $e) {
			 echo "<h2>Exception Error!</h2>";
			 echo $e->getMessage();
			}
			 
			try {
			 $param_price=array ("requestType"=>"14","xmlRequest"=>"<Root>
				<Header>
					<Agency>".$agency."</Agency>
					<User>".$user."</User>
					<Password>".$password."</Password>
					<Operation>PRICE_BREAKDOWN_REQUEST</Operation>
					<OperationType>Request</OperationType>
				</Header>
				<Main>
					<HotelSearchCode>37312/6352/3</HotelSearchCode>
				</Main>
			</Root>");
			//print_r($param_price); exit;
			 $result_price = $soapclient->MakeRequest($param_price);
			 
			} catch(Exception $e) {
			 echo "Caught exception : ", $e->getMessage, "\n";
			}
			 
			//echo "<pre>";
			//print_r($result); exit;
			$arr_price = (array) $result_price;
			$array_price = $this->xml2array($arr_price['MakeRequestResult']);
			echo "<pre>"; print_r($array_price); 
			if(isset($array['Root']['Main']))
			{
				$hotel = $array['Root']['Main'];
				$data['price_break'] = $hotel;
			}
	}
	function prop_detail($hid,$hotelname,$api1,$result_id)
	{
		if($api1 == '2')
		{
			$api = 'hotelspro';
		}
		else
		{
			$api = 'goglobal';
		}
		//echo $api; exit;
		header('Cache-Control: max-age=900');
		$sec_res=$this->session->userdata('sec_res');
		$arrival_date = $this->session->userdata('start_date');
		//$this->Home_Model->delete_hotel_det($sec_res,$hid);
		
		if($api == 'goglobal')
		{
			
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND hotel_id = $hid AND result_id = $result_id");
			$data['res'] = $sresult = $query->row();
			
			
			if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
			{
				$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
				$agency = '1521228';
				$user = 'TRVLMRTXML';
				$password = 'SLA2WLEP';
			}
			else
			{
				$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
				$agency = '37398';
				$user = 'TRAVELLINGMARTXML';
				$password = 'SAYADMANAMAH';
                /*$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
				$agency = '1521228';
				$user = 'TRVLMRTXML';
				$password = 'SLA2WLEP';*/
			}
			
			try {
			 $options = array(
			  'soap_version' => SOAP_1_1,
			  'exceptions' => true,
			  'trace'   => 1,
			  'cache_wsdl' => WSDL_CACHE_NONE,
			  "Content-Type: text/json; charset=UTF-8",
				"Content-Encoding: UTF-8",
				"Accept: application/xml",
				"Accept-Encoding: gzip"
			 );
			 
			 $soapclient = new SoapClient($url, $options);
			} catch(Exception $e) {
			 echo "<h2>Exception Error!</h2>";
			 echo $e->getMessage();
			}
			 
			try {
			 $param=array ("requestType"=>"61","xmlRequest"=>"<Root>
				<Header>
					<Agency>".$agency."</Agency>
					<User>".$user."</User>
					<Password>".$password."</Password>
					<Operation>HOTEL_INFO_REQUEST</Operation>
					<OperationType>Request</OperationType>
				</Header>
				<Main>
					<HotelSearchCode>".$sresult->HotelSearchCode."</HotelSearchCode>
				</Main>
			</Root>");
			//print_r($param); exit;
			 $result = $soapclient->MakeRequest($param);
			} catch(Exception $e) {
			 echo "Caught exception : ", $e->getMessage, "\n";
			}
			 
			//echo "<pre>";
			//print_r($result); exit;
			$arr = (array) $result;
			$array = $this->xml2array($arr['MakeRequestResult']);
			//echo "<pre>"; print_r($array); exit;
			if(isset($array['Root']['Header']))
			{
				$headr = $array['Root']['Header'];
				$Agency = $headr['Agency']['value'];
				$User = $headr['User']['value'];
				$Password = $headr['Password']['value'];
				$Operation = $headr['Operation']['value'];
			}
			if(isset($array['Root']['Main']))
			{
				$hotel = $array['Root']['Main'];
				if(isset($hotel['HotelSearchCode']['value']))
				{
					$HotelSearchCode = $hotel['HotelSearchCode']['value'];
				}
				else
				{
					$HotelSearchCode = '';
				}
				if(isset($hotel['HotelName']['value']))
				{
					$HotelName = $hotel['HotelName']['value'];
				}
				else
				{
					$HotelName = '';
				}
				if(isset($hotel['Address']['value']))
				{
					$Address = $hotel['Address']['value'];
				}
				else
				{
					$Address = '';
				}
				if(isset($hotel['CityCode']['value']))
				{
					$CityCode = $hotel['CityCode']['value'];
				}
				else
				{
					$CityCode = '';
				}
				if(isset($hotel['GeoCodes']))
				{
					$GeoCodes = $hotel['GeoCodes'];
					if(isset($GeoCodes['Longitude']['value']))
					{
						$Longitude = $GeoCodes['Longitude']['value'];
					}
					else
					{
						$Longitude = '';
					}
					if(isset($GeoCodes['Latitude']['value']))
					{
						$Latitude = $GeoCodes['Latitude']['value'];
					}
					else
					{
						$Latitude = '';
					}
				}
				else
				{
					$Longitude = '';
					$Latitude = '';
				}
				if(isset($hotel['Phone']['value']))
				{
					$Phone = $hotel['Phone']['value'];
				}
				else
				{
					$Phone = '';
				}
				if(isset($hotel['Fax']['value']))
				{
					$Fax = $hotel['Fax']['value'];
				}
				else
				{
					$Fax = '';
				}
				if(isset($hotel['Category']['value']))
				{
					$Category = $hotel['Category']['value'];
				}
				else
				{
					$Category = '';
				}
				if(isset($hotel['Description']['value']))
				{
					$Description = $hotel['Description']['value'];
				}
				else
				{
					$Description = '';
				}
				if(isset($hotel['HotelFacilities']['value']))
				{
					$HotelFacilities = $hotel['HotelFacilities']['value'];
				}
				else
				{
					$HotelFacilities = '';
				}
				if(isset($hotel['RoomFacilities']['value']))
				{
					$RoomFacilities = $hotel['RoomFacilities']['value'];
				}
				else
				{
					$RoomFacilities = '';
				}
				if(isset($hotel['RoomCount']['value']))
				{
					$RoomCount = $hotel['RoomCount']['value'];
				}
				else
				{
					$RoomCount = '';
				}
				$id = $this->Home_Model->insert_hotel_det($hid,$sec_res,$HotelSearchCode,$HotelName,$Address,$CityCode,$Phone,$Fax,$Category,$Description,$HotelFacilities,$RoomFacilities,$RoomCount,$Longitude,$Latitude);
				if(isset($hotel['Pictures']))
				{
					if(isset($hotel['Pictures']['Picture'][0]))
					{
						$Pictures = $hotel['Pictures'];
						foreach($Pictures as $pic)
						{
							foreach($pic as $pict)
							{
								$picts = $pict['value'];
								//echo $Description = $pict['attr'];
								$this->Home_Model->insert_hotel_pictures($id,$sec_res,$hid,$picts);
							}
						}
					}
					else
					{
						$Pictures = $hotel['Pictures'];
						foreach($Pictures as $pict)
						{
							$picts = $pict['value'];
							$this->Home_Model->insert_hotel_pictures($id,$sec_res,$hid,$picts);
						}
					}
				}
			}
			$data['cnt'] = $this->Home_Model->get_allcur();
			$data['HotelSearchCode'] = $sresult->HotelSearchCode;
			$data['hid'] = $hid;
			$data['sec_id'] = $sec_res;
			//$this->load->view('hotel/prop_detail',$data);
			redirect('home/prop_details/'.$hid.'/'.$result_id,'refresh');
		}
		else if($api == 'hotelspro')
		{
			$result_id = $hotelname;
			$pre = $this->Home_Model->get_pro_pre_detail_hotelspro($result_id);
			$hotel_code = $pre->hotel_id;
			$hotel_proid = $pre->room_code;
			$data['tot']= $pre->nightperroom;
			$data['usd']= $pre->nightperroom;
			$data['share_cost']=$pre->nightperroom;
			$data['pro_room_type']= $pre->room_type;
			$without_markup=$pre->nightperroom;
			$data['inc']=$pre->inclusion;
			/*$client = new SoapClient("http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1));
			$processId=$hotel_proid;*/
			$hotel_image= $this->Home_Model->gethb_hotelimage_new_pro($pre->hotel_id);
			if($hotel_image!="")
			{
				$img1=array();
				$img1[] = $hotel_image->HotelImages1;
				$img1[] = $hotel_image->HotelImages2;
				$img1[] = $hotel_image->HotelImages3;
				
				$data['img_array']=$img1;
			}
			else
			{
				$img1="";
				$data['img_array']="";
			}
			$data['errordesc'] = '';
			//echo $this->session->userdata('searchId'); exit;
			if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
			{
				$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			else
			{
				$url = "http://api.hotelspro.com/4.1/hotel/b2bHotelSOAP.wsdl";
				//$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			$client = new SoapClient($url, array('trace' => 1));
			try
			{
				$pid=$this->session->userdata('searchId');
				$hid=$hotel_code;
				$allocateHotelCode = $client->allocateHotelCode("WTBSbm8yS001a0dVNFo3VTdMcWFDOUphNEhwNnRDOGlKQ21nZHorSHd0TnNnd3dncjNUbjZrTjhVaTZ6N29ERA==",$pid,$hid);
			}
			catch (SoapFault $exception) 
			{
				$data['errordesc'] = $exception->getMessage();
			} 
			if($data['errordesc']!='')
			{
			   $data['error']=$data['errordesc'];
			   $this->load->view('hotel/error_page',$data);                   
			}
			else
			{
				$hid=$hotel_code;
				$this->Home_Model->delete_already_hotels($this->session->userdata('sec_res'),$hid);
				if (is_object($allocateHotelCode->availableHotels)) 
				{
					$availableHotels[] = $allocateHotelCode->availableHotels;
				}
				else
				{
					$availableHotels = $allocateHotelCode->availableHotels;
				}
			
			//echo '<pre>'; print_r($availableHotels);exit;
			foreach((array)$availableHotels as $hnum => $hotel) 
			{
				$processId = $hotel->processId; 
				$hotelCode =  $hotel->hotelCode;
				$availabilityStatus = $hotel->availabilityStatus;
				$totalPrice = $hotel->totalPrice;
				$totalTax =  $hotel->totalTax;
				$currency =  $hotel->currency;
				$boardType =  $hotel->boardType;
				if (is_object($hotel->rooms))
				{
					$roomResponse[] = $hotel;
				}
				else 
				{
					$roomResponse = $hotel->rooms;
				}
				$roomCategory=array();
				//$totalRoomRate=array();
				$each_ngt_amount=array();
				$totalcost_m_m_ddn=array();
				foreach ((array)$roomResponse as $rnum => $room) 
				{
					$roomCategory[] = $room->roomCategory;
					$totalRoomRate =  $room->totalRoomRate;
					if (is_object($room->paxes)) 
					{
						$roomsInfo[] = $room->paxes;
					}
					else 
					{
						$roomsInfo = $room->paxes;
					}
					if (is_object($room->ratesPerNight))
					{
					   $ratesPerNight[] = $room->ratesPerNight;
					} 
					else 
					{
						$ratesPerNight = $room->ratesPerNight;
					}
					foreach ((array)$roomsInfo as $pnum => $pax) 
					{
						$paxType= $pax->paxType;
					}
					foreach ((array)$ratesPerNight as $rpnum => $price) 
					{    
						$priceeachrate = $price->date;
						$each_ngt_amount[] = $price->amount;
					}
					$a=count($each_ngt_amount);
					$roomrateavg = $totalRoomRate/$a;
					unset($each_ngt_amount);
					$totalcost_m_m_ddn[]=$roomrateavg;
				}
				$api="hotelspro";	
				$totalcost_m_m = $totalPrice;
				$roomtype=implode("<br>",$roomCategory);
				$totalRoomRate=implode("-",$totalcost_m_m_ddn);
				$sec_res=$this->session->userdata('sec_res');
				$adult =  $this->session->userdata('adult_count');
				$child =  $this->session->userdata('child_count');
				$star = $this->Home_Model->get_hotel_star($hotelCode);
				$markup = $this->Home_Model->get_markup();
				if($markup != '')
				{
					if($markup->hotel_type == 'fixed')
					{
						$totalRoomRate = $totalRoomRate + $markup->hotel;
					}
					else
					{
						$totalRoomRate = $totalRoomRate + (($totalRoomRate * $markup->hotel)/100);
					}
				}
				else
				{
					$totalRoomRate = $totalRoomRate;
				}
				$reserv = $this->Home_Model->insert_gta_temp_result($sec_res,'hotelspro',$hotelCode,$processId,$roomtype,$totalRoomRate,$availabilityStatus,$boardType,$adult,$child,$star);   
					  }
					  redirect('home/prop_details2/'.$reserv,'refresh');
			}
			$data['cnt'] = $this->Home_Model->get_allcur();
			//$data['HotelSearchCode'] = $sresult->HotelSearchCode;
			$data['hid'] = $hid;
			$data['sec_id'] = $sec_res;
			//$this->load->view('hotel/prop_detail',$data);
			
		}
		//exit;
		//echo "<pre>"; print_r($sresult); exit;
		
	}
	function prop_details2($reserv)
	{
		$sec_res = $this->session->userdata('sec_res');
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND result_id = $reserv ORDER BY nightperroom asc");
		$data['res'] = $sresult = $query->row();
		$changed_cur = $this->input->post('changed_cur');
		//$query2=$this->db->query("SELECT HotelSearchCode FROM goglobal_hotel_det WHERE criteria_id = '$sec_res' AND hotel_id = $hid");
		//$data['res2'] = $sresult1 = $query2->row();
		//$data['HotelSearchCode'] = $sresult1->HotelSearchCode;
		//$data['hid'] = $hid;
		$data['hotel_code'] = $sresult->hotel_id;
		$data['api'] = $sresult->api_name;
		$data['sec_id'] = $sec_res;
		$data['anand'] = $anand =$sresult->cost_type;
		if($changed_cur == '')
		{
			if($this->session->userdata('host_currencyCode'))
			{
			}
			else
			{
				require_once('geoplugin.class.php');
				$geoplugin = new geoPlugin();
				$geoplugin->locate($_SERVER['REMOTE_ADDR']);
				"Currency Code: {$geoplugin->currencyCode} <br />\n".
				"Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
				"Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
				//$data['host_currencyCode'] = $geoplugin->currencyCode;
				$data['host_currencyCode'] = 'USD';
				$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
			}
		}
		else
		{
			//$data['host_currencyCode'] = $changed_cur;
			$data['host_currencyCode'] = 'USD';
			$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
		}
		if($this->session->userdata('host_currencyCode') != $anand)
		{
			//$url = "http://www.google.com/ig/calculator?hl=en&q=1".$anand."=?".$this->session->userdata('host_currencyCode');
			$url = "http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency=".$anand."&ToCurrency=".$this->session->userdata('host_currencyCode').""; 
			$options = array(
					CURLOPT_RETURNTRANSFER => true, // return web page
					CURLOPT_HEADER         => false,// don't return headers
					CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
			);
			$ch = curl_init($url);
			curl_setopt_array( $ch, $options );
			$amtcon = curl_exec( $ch ); //let's fetch the result using cURL
			//echo $amtcon;
			curl_close( $ch );
			$array = $this->xml2array($amtcon);
			if(isset($array['double']['value']))
			{
				$data['new_cost'] = $array['double']['value'];
			}
			else
			{
				$data['new_cost'] = '';
			}
		}
		else
		{
			$data['new_cost'] = '';
		}
		//echo '<pre>'; print_r($data);exit;
		$this->load->view('hotel/prop_detail',$data);
	}
	function prop_details($hid,$result_id)
	{
		//echo $hid; criteria_id = '$sec_res' AND
		$sec_res = $this->session->userdata('sec_res');
		$query=$this->db->query("SELECT * FROM search_result WHERE  `status` IN ('AVAILABLE','Available','active','OnRequest','On Request') AND hotel_id = $hid AND result_id = $result_id ORDER BY nightperroom asc");
		$data['res'] = $sresult = $query->row();
		//echo "<pre>"; print_r($sresult); exit;
		$changed_cur = $this->input->post('changed_cur');
		$query2=$this->db->query("SELECT HotelSearchCode FROM goglobal_hotel_det WHERE criteria_id = '$sec_res' AND hotel_id = $hid");
		$data['res2'] = $sresult1 = $query2->row();
		$data['HotelSearchCode'] = $sresult1->HotelSearchCode;
		$data['hid'] = $hid;
		$data['sec_id'] = $sec_res;
		$data['anand'] = $anand =$sresult->cost_type; 
		if($changed_cur == '')
		{
			if($this->session->userdata('host_currencyCode'))
			{
			}
			else
			{
				require_once('geoplugin.class.php');
				$geoplugin = new geoPlugin();
				$geoplugin->locate($_SERVER['REMOTE_ADDR']);
				"Currency Code: {$geoplugin->currencyCode} <br />\n".
				"Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
				"Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
				//$data['host_currencyCode'] = $geoplugin->currencyCode;
				$data['host_currencyCode'] = 'USD';
				$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
			}
		}
		else
		{
			//$data['host_currencyCode'] = $changed_cur;
			$data['host_currencyCode'] = 'USD';
			$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
		}
		if($this->session->userdata('host_currencyCode') != $anand)
		{
			//$url = "http://www.google.com/ig/calculator?hl=en&q=1".$anand."=?".$this->session->userdata('host_currencyCode');
			$url = "http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency=".$anand."&ToCurrency=".$this->session->userdata('host_currencyCode').""; 
			//echo $url;
			$options = array(
					CURLOPT_RETURNTRANSFER => true, // return web page
					CURLOPT_HEADER         => false,// don't return headers
					CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
			);
			$ch = curl_init($url);
			curl_setopt_array( $ch, $options );
			$amtcon = curl_exec( $ch ); //let's fetch the result using cURL
			//echo $amtcon;
			curl_close( $ch );
			$array = $this->xml2array($amtcon);
			
			if(isset($array['double']['value']))
			{
				//echo "hi"; exit;
				$data['new_cost'] = $array['double']['value'];
			}
			else
			{
				$data['new_cost'] = '';
			}
		}
		else
		{
			$data['new_cost'] = '';
		}
		//echo $data['new_cost'];exit;
		$data['api'] = 'goglobal';
		$this->load->view('hotel/prop_detail',$data);
	}
	function reservation_from($result_id)
	{
		$re = $this->Home_Model->check_hotels($result_id);
		if($re != '')
		{
			$sec_res = $this->session->userdata('sec_res');
			$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND result_id = $result_id");
			$data['res'] = $sresult = $query->row();
			$data['hid'] = $hid = $sresult->hotel_id;
			if(isset($hid)) { if($hid != '') { 
			$query2=$this->db->query("SELECT HotelSearchCode FROM goglobal_hotel_det WHERE criteria_id = '$sec_res' AND  hotel_id = $hid");
			$data['res2'] = $sresult1 = $query2->row();
			
			$data['HotelSearchCode'] = $sresult1->HotelSearchCode;
			}}
			$data['sec_id'] = $sec_res;
			$this->load->view('hotel/reservation_from',$data);
		} 
		else
		{
			redirect('home/index','refresh');
		}
	}
	function vpc_php_serverhost_do()
	{
		$SECURE_SECRET = "0C18F047EAD2F57442A9268D91B4751D";
		$vpcURL = $_POST["virtualPaymentClientURL"] . "?";
		unset($_POST["virtualPaymentClientURL"]); 
		unset($_POST["SubButL"]);
		$md5HashData = $SECURE_SECRET;
		ksort ($_POST);
		
		$appendAmp = 0;
		foreach($_POST as $key => $value) {

    	if (strlen($value) > 0) {
			
				if ($appendAmp == 0) {
					$vpcURL .= urlencode($key) . '=' . urlencode($value);
					$appendAmp = 1;
				} else {
					$vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
				}
				$md5HashData .= $value;
			}
		}
		if (strlen($SECURE_SECRET) > 0) {
			$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($md5HashData));
		}
		redirect($vpcURL);
	}
	function make_payment()
	{
		//echo 'aaa';exit;
		header('Cache-Control: max-age=900');
		$api = $this->input->post('api');
		$result_id = $this->input->post('result_id');
		$search=$this->Home_Model->get_cancel_attrib_new($result_id);
		
        $fname = $this->input->post('first_name');
		$lname = $this->input->post('last_name');
        $title = $this->input->post('title');
                
       $fname2 = $this->input->post('first_name2');
		$lname2 = $this->input->post('last_name2');
        $title2 = $this->input->post('title2');
                
        $fname3 = $this->input->post('first_name3');
		$lname3 = $this->input->post('last_name3');
        $title3 = $this->input->post('title3');
			
		$data['phone_co']= '';
		$data['email_co']=$this->input->post('email_id');
		//echo "<pre>"; print_r($search); exit;
		$user_id ='';
		
                    //$data['amount'] = $search->nightperroom * 0.377 * 1000;
                    $url = "http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency=".$search->cost_type."&ToCurrency=USD";  
			//echo $url; exit;
                        $options = array(
					CURLOPT_RETURNTRANSFER => true, // return web page
					CURLOPT_HEADER         => false,// don't return headers
					CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
			);
			$ch = curl_init($url);
			curl_setopt_array( $ch, $options );
			$amtcon = curl_exec( $ch ); //let's fetch the result using cURL
			//echo $amtcon; exit;
			curl_close( $ch );
			$array = $this->xml2array($amtcon);
			if(isset($array['double']['value']))
			{
				$data['new_cost'] = $new_cost = $array['double']['value'];
			}
			else
			{
				$data['new_cost'] = $new_cost = '';
			}
                       // $data['amount'] = $search->nightperroom * $new_cost * 1000;
					    $data['amount'] = $search->nightperroom * 100; 
               
                $HotelSearchCode = $this->input->post('HotelSearchCode');
                $adult = $this->input->post('adult');
		$adult2 = $this->input->post('adult2');
		$adult3 = $this->input->post('adult3');
                $this->session->set_userdata(array('result_id'=>$result_id,'first_name'=>$fname,'last_name'=>$lname,'email_id'=>$data['email_co'],'api'=>$api,'HotelSearchCode'=>$HotelSearchCode,'title'=>$title,'adult'=>$adult,'adult2'=>$adult2,'adult3'=>$adult3,'first_name2'=>$fname2,'last_name2'=>$lname2,'title2'=>$title2,'first_name3'=>$fname3,'last_name3'=>$lname3,'title3'=>$title3));
		$this->load->view('hotel/load_payment_gateway',$data);
	}
	function reservation_fromhp($result_id)
	{
		$sec_res = $this->session->userdata('sec_res');
		$query=$this->db->query("SELECT * FROM search_result WHERE criteria_id = '$sec_res' AND `status` IN ('AVAILABLE','Available','active','OnRequest','On Request','InstantConfirmation') AND result_id = $result_id");
		$data['res'] = $sresult = $query->row();
		$data['hotel_code'] = $hid = $sresult->hotel_id;	
		$data['sec_id'] = $sec_res;
		$this->load->view('hotel/reservation_from',$data);
	}
	function booking_after_payment()
	{
                $this->load->helper('url');
               // echo $this->uri->segment(3,1); exit;
                $amount          = $_REQUEST["vpc_Amount"];
                $locale          = $_REQUEST["vpc_Locale"];
                $batchNo         = $_REQUEST["vpc_BatchNo"];
                $command         = $_REQUEST["vpc_Command"];
                $message         = $_REQUEST["vpc_Message"];
                $version         = $_REQUEST["vpc_Version"];
                $cardType        = $_REQUEST["vpc_Card"];
                $orderInfo       = $_REQUEST["vpc_VerStatus"];
                $receiptNo       = $_REQUEST["vpc_ReceiptNo"];
                $merchantID      = $_REQUEST["vpc_Merchant"];
                $authorizeID     = $_REQUEST["vpc_AuthorizeId"];
                $merchTxnRef     = $_REQUEST["vpc_MerchTxnRef"];
                $transactionNo   = $_REQUEST["vpc_TransactionNo"]; 
                $acqResponseCode = $_REQUEST["vpc_AcqResponseCode"];
                $txnResponseCode = $_REQUEST["vpc_TxnResponseCode"];
                if($txnResponseCode == "C")
                {
                     $errorTxt = "Cancelled the Transaction, Reservation Incomplete";
                     $data['errordesc']=$errorTxt;
			
		     $this->load->view('hotel/error_page',$data);
                }
                elseif ($txnResponseCode == "7" || $txnResponseCode == "No Value Returned") {
                        $errorTxt = "Error In Transaction System.";
                        $data['errordesc']=$errorTxt;
			
			$this->load->view('hotel/error_page',$data);
                    }
                elseif ($txnResponseCode == 0) {
		$api = $this->session->userdata('api');
                if($api == 'hotelspro')
		{
			$result_id = $this->session->userdata('result_id');
			$search=$this->Home_Model->get_cancel_attrib_new($result_id);
			$fname = $this->session->userdata('first_name');
			$lname = $this->session->userdata('last_name');
			$trns_id =  time();
			 for($i=0; $i< count($fname); $i++)
			 {
				$data1 = array(
					 'last_name' => $lname[$i], 
					 'first_name' => $fname[$i],
					 'parent_id' => $trns_id
			);
				
			$this->db->insert('customer_info_details', $data1);//adult_booking_details 
			$customer_info_details_id = $this->db->insert_id();
				
			}
			$data['surname_co']=$lname[0];
			$data['name_co']=$fname[0];
			$data['phone_co']= '';
			$data['email_co']=$this->session->userdata('email_id');
			$data4 = array(
						 'last_name' => $data['surname_co'], 
						 'first_name' => $data['name_co'],
						 'mobile' => $data['phone_co'],
						 'email' => $data['email_co'],
						 'customer_info_details_id' =>$customer_info_details_id
					);
			$this->db->insert('customer_contact_details', $data4); 
			$parent_customer_id = $this->db->insert_id();
			$user_id ='';
			$data5 = array(
				 'product_id' => 2,
				 'user_id' => $user_id,
				 'amount' => $search->nightperroom,
				 'customer_contact_details_id' => $parent_customer_id, 
				 'created_date' => date("Y-m-d")
			);
			
			$this->db->insert('transaction_details', $data5); //exit;
			$parent_transaction_id = $this->db->insert_id();
			//echo $result_id; exit;
			$service=$this->Home_Model->get_searchresult($result_id);
			//echo "<pre>"; print_r($service); exit;
			$h_hotel_id = $service->hotel_id;
			$h_hotel_name = $service->HotelName;
			$h_star = $service->StarRating;
			//$h_description = $service->HotelInfo;
			$h_description = '';
			$h_address = $service->HotelAddress;
			$h_city = $service->Destination;
			$h_phone = $service->HotelPhoneNumber;
			$h_fax = '';
			$trans_id = $parent_customer_id;
	 		$contact_info=$this->Home_Model->contact_info_detail_update($trans_id);
           	$con_id = $contact_info->customer_info_details_id;
	 		$pass_info=$this->Home_Model->pass_info_detail($trns_id);
			$con_id_org =$contact_info->customer_contact_details_id;
			
			$fname1=$pass_info[0]->first_name;			 
			$lname1=$pass_info[0]->last_name;	
		
			$adults=$search->adult;
			$child=$search->child;
			$roomcat=$search->room_catecode;
			$hotel_id=$search->hotel_id;
			
			$leadTravellerInfo = array();
			$paxInfo = array("paxType" => "Adult", "title" => 'Mr', "firstName" => $fname1, "lastName" => $lname1);
			//echo "<pre>"; print_r($paxInfo);exit;
			$leadTravellerInfo = $paxInfo;
			$leadTravellerInfo["paxInfo"] = $paxInfo;
			$leadTravellerInfo["nationality"] = "US";
			
			$processId=$search->room_catecode;
			if(count($pass_info)>1)
			{
				for($i=1;$i< count($pass_info);$i++)
				{
					  $otherTravellerInfo[] = array("title" => 'Mr', "firstName" => $pass_info[$i]->first_name, "lastName" => $pass_info[$i]->last_name);
				}
			}
			else
			{
				$otherTravellerInfo= '';
			}
			//echo "<pre>"; print_r($otherTravellerInfo); exit;
			 $preferences = "";
       		 $note = "";
	    	 $agencyReferenceNumber = 'AL2001';
			//echo $processId.$agencyReferenceNumber;
			//print_r($otherTravellerInfo); exit;
			//print_r($leadTravellerInfo.$otherTravellerInfo.$preferences.$note); exit;
			if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
			{
				$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			else
			{
				$url = "http://api.hotelspro.com/4.1/hotel/b2bHotelSOAP.wsdl";
				//$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			 $client = new SoapClient($url, array('trace' => 1));
				 try {
	 
			   $data['errordesc']='';
			   $makeHotelBooking = $client->makeHotelBooking("WTBSbm8yS001a0dVNFo3VTdMcWFDOUphNEhwNnRDOGlKQ21nZHorSHd0TnNnd3dncjNUbjZrTjhVaTZ6N29ERA==", $processId, $agencyReferenceNumber, $leadTravellerInfo,$otherTravellerInfo,  $preferences, $note);
			//echo "<pre>"; print_r($makeHotelBooking);exit;
			  $hotel = $makeHotelBooking->hotelBookingInfo;
			  $rooms = is_array($hotel->rooms) ? $hotel->rooms : array($hotel->rooms);
			  $policies = is_array($hotel->cancellationPolicy) ? $hotel->cancellationPolicy : array($hotel->cancellationPolicy);
			}
			 catch (SoapFault $exception) {
		 
			 $data['errordesc'] = $exception->getMessage();
		 
			}
			if($data['errordesc']!='')
			{
				$data['errordesc']=$data['errordesc'];
				//echo "<pre>"; print_r($data['error']); exit;
				$this->load->view('hotel/error_page',$data);
     		}
			else
			{
				//echo "hi";
				  $ProcessIdvalue = $makeHotelBooking->trackingId;

				  if (false == empty($hotel)) 
				  {
				  $BookingStatusvalue11 = $hotel->bookingStatus;
				  if($BookingStatusvalue11==1)
				  {
					  $BookingStatusvalue ='Confirmed Booking';
				  }
				  elseif($BookingStatusvalue11==2)
				  {
					  $BookingStatusvalue ='On Request Booking';
				  }
				  elseif($BookingStatusvalue11==3)
				  {
					  $BookingStatusvalue ='Rejected Booking';
				  }
				  elseif($BookingStatusvalue11==4)
				  {
					  $BookingStatusvalue ='Cancelled Booking';
				  }
				  elseif($BookingStatusvalue11==5)
				  {
					  $BookingStatusvalue ='Payment Processing';
				  }
				  $CheckInvalue = $hotel->checkIn;
				  $CheckOutvalue = $hotel->checkOut;
				  $BoardTypevalue = $hotel->boardType;
				  $cancellationPolicy11 = $hotel->cancellationPolicy;
				  foreach ($cancellationPolicy11 as $policy)
				  {
						 $val[]= $policy->cancellationDay;
						 if(isset($policy->currency))
						 {
						  $val1[]=  $policy->currency;
						 }
						 else
						 {
							 $val1[]="USD";
						 }
					  $val2=  $policy->feeAmount;
					  $cutype = $policy->feeType;
				   //  $policy->remarks;
				  }
				  $newdate = strtotime ( '-'.$val[0].' day' , strtotime ( $CheckInvalue ) ) ;
				  $cancel_till_date = date ( 'Y-m-d' , $newdate );
			 }
			// $ConfirmationNumbervalue='';
			if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
			{
				$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			else
			{
				$url = "http://api.hotelspro.com/4.1/hotel/b2bHotelSOAP.wsdl";
				//$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			 $client = new SoapClient($url, array('trace' => 1));
			  $trackingId=$ProcessIdvalue;
			  try {
				   $data['errordesc']='';
				   $getHotelBookingStatus = $client->getHotelBookingStatus("WTBSbm8yS001a0dVNFo3VTdMcWFDOUphNEhwNnRDOGlKQ21nZHorSHd0TnNnd3dncjNUbjZrTjhVaTZ6N29ERA==", $trackingId);
			  }
			  catch (SoapFault $exception) 
			  {
				   $data['errordesc'] =  $exception->getMessage();
				  // exit;
			  }
			   if($data['errordesc']!='')
			  {
				   $data['errordesc']=$data['errordesc'];
				   $this->load->view('hotel/error_page',$data);
			  }
			  else
			  {
				 $ConfirmationNumbervalue=$getHotelBookingStatus->hotelBookingInfo->confirmationNumber;
			  }
			$ProcessIdvalue=$ProcessIdvalue;
			$BookingStatusvalue =$BookingStatusvalue;
			$hotelcode = $h_hotel_id;
			$CheckInvalue = $CheckInvalue;
			$CheckOutvalue = $CheckOutvalue;
			$cancel_date = $cancel_till_date;
			$h_room_type = $service->room_type;
			$h_cancel_policy = '';
			$BoardTypevalue = $BoardTypevalue;
			$ConfirmationNumbervalue = $ConfirmationNumbervalue;
			$guestadult= $this->session->userdata('adult_count');
			$guestchild= $this->session->userdata('child_count');
			
			$sd_new = $this->session->userdata('cin1');
			$sds = explode('/',$sd_new);
			$sds_new = $sds[2]."-".$sds[1]."-".$sds[0];
			$cin=date("Y-m-d", strtotime($sds_new));
			//echo $cin; exit;
			$ed_new = $this->session->userdata('cout1');
			$eds = explode('/',$ed_new);
			$eds_new = $eds[2]."-".$eds[1]."-".$eds[0];
			$cout=date("Y-m-d", strtotime($eds_new));
			$date=date('Y-m-d');
			$roomcountss= $this->session->userdata('room_count');
			$user_id=0;
			$nights = $this->session->userdata('dt');
			$dateFromValc = Date('Y-m-d', strtotime("+5 days" , strtotime ( $cin )));
			$nights = $this->session->userdata('dt');
			$trans_id2 = $parent_transaction_id;
			$agent_id = '';
			//echo "<pre>"; print_r($policies); exit;
		 $val_last=$this->Home_Model->inser_customer_book_hotelpro($h_hotel_id,$h_hotel_name,$h_star,$h_description,$h_address,$h_phone,$h_fax,$h_room_type,$h_cancel_policy,$cin,$cout,$date,$roomcountss,$user_id,$nights,$trans_id2,$adults,$child,$con_id_org,$dateFromValc,$h_city,"hotelspro",$trackingId,$agent_id,$policies);
    		 $this->Home_Model->inser_customer_book_hotelpro_trans_hotel($trans_id,$ConfirmationNumbervalue,$user_id,$val_last,$BookingStatusvalue);
                 $this->Home_Model->insert_payment_detail($val_last,$locale,$batchNo,$command,$message,$version,$cardType,$orderInfo,$receiptNo,$merchantID,$authorizeID,$merchTxnRef,$transactionNo,$acqResponseCode,$txnResponseCode);
                 
			redirect('home/confirm_hp/'.$val_last,'refresh');
		}
		
		}
                else
                {
                    $HotelSearchCode = $this->session->userdata('HotelSearchCode');
		    $start_date = $this->session->userdata('start_date');
                    $nights = $this->session->userdata('dt');
                    $room_type = $this->session->userdata('room_types');
                    $room_type2 = $this->session->userdata('room_types2');
                    $room_type3 = $this->session->userdata('room_types3');
                    //echo "<pre>"; print_r($room_type); exit;
                    $room_count = $this->session->userdata('room_count');
			
		    $adult = $this->session->userdata('adult');
		    $adult2 = $this->session->userdata('adult2');
                    $adult3 = $this->session->userdata('adult3');
                    
                    $title = $this->session->userdata('title');
                    $first_name = $this->session->userdata('first_name');
                    $last_name = $this->session->userdata('last_name');
                    
                    $title2 = $this->session->userdata('title2');
                    $first_name2 = $this->session->userdata('first_name2');
                    $last_name2 = $this->session->userdata('last_name2');
                    
                    $title3 = $this->session->userdata('title3');
                    $first_name3 = $this->session->userdata('first_name3');
                    $last_name3 = $this->session->userdata('last_name3');
                    
                    
                    if($room_type == 'SGL')
                        {
                                $title = $this->session->userdata('title');
                                $first_name = $this->session->userdata('first_name');
                                $last_name = $this->session->userdata('last_name');
                                $room ='<Rooms>
                                            <RoomType Type="SGL">
                                            <Room RoomID="1">
                                                    <PersonName PersonID="1">'.$title[0].' '.$first_name[0].' '.$last_name[0].'</PersonName>
                                            </Room>
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type == 'TPL')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->session->userdata('title');
                                            $first_name = $this->session->userdata('first_name');
                                            $last_name = $this->session->userdata('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room ='<Rooms>
                                            <RoomType Type="TPL">
                                             '.$ro.'
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type == 'DBLSGL')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->session->userdata('title');
                                            $first_name = $this->session->userdata('first_name');
                                            $last_name = $this->session->userdata('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room ='<Rooms>
                                            <RoomType Type="DBLSGL">
                                             '.$ro.'
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type == 'QDR')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->session->userdata('title');
                                            $first_name = $this->session->userdata('first_name');
                                            $last_name = $this->session->userdata('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room ='<Rooms>
                                            <RoomType Type="QDR ">
                                             '.$ro.'
                                                 <ExtraBed PersonID="3" ChildAge="2">JERRY DOE</ExtraBed>
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type == 'DBL')
                        {
                           
                            if($this->session->userdata('child_room1') == '1')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $ro = '';
                                    for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->session->userdata('title');
                                            $first_name = $this->session->userdata('first_name');
                                            $last_name = $this->session->userdata('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title[$i].' '.$first_name[$i].' '.$last_name[$i].'</PersonName>';
                                    }
                                        $room ='<Rooms>
                                            <RoomType Type="DBL">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                                
                            }
                            if($this->session->userdata('child_room1') == '2')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $child_age2 = $this->session->userdata('child_age2');
                                $ro = '';
                                for($i =0; $i<$adult; $i++)
				{
					$title = $this->session->userdata('title');
                                        $first_name = $this->session->userdata('first_name');
                                        $last_name = $this->session->userdata('last_name');
                                        $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                }
                                $room ='<Rooms>
                                            <RoomType Type="DBL">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                                <ExtraBed PersonID="4" ChildAge="'.$child_age2.'">JERRYs DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                            }
                               
                        }
                        if($room_type == 'TWN')
                        {
                           
                            if($this->session->userdata('child_room1') == '1')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $ro = '';
                                    for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->session->userdata('title');
                                            $first_name = $this->session->userdata('first_name');
                                            $last_name = $this->session->userdata('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                        $room ='<Rooms>
                                            <RoomType Type="TWN">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                                
                            }
                            if($this->session->userdata('child_room1') == '2')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $child_age2 = $this->session->userdata('child_age2');
                                $ro = '';
                                for($i =0; $i<$adult; $i++)
				{
					$title = $this->session->userdata('title');
                                        $first_name = $this->session->userdata('first_name');
                                        $last_name = $this->session->userdata('last_name');
                                        $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                }
                                $room ='<Rooms>
                                            <RoomType Type="TWN">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                                <ExtraBed PersonID="4" ChildAge="'.$child_age2.'">JERRYs DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                            }
                               
                        }
                        
                         if($room_type2 == 'SGL')
                        {
                                $title = $this->session->userdata('title2');
                                $first_name = $this->session->userdata('first_name2');
                                $last_name = $this->session->userdata('last_name2');
                                $room3 ='<Rooms>
                                            <RoomType Type="SGL">
                                            <Room RoomID="1">
                                                    <PersonName PersonID="1">'.$title[0].' '.$first_name[0].' '.$last_name[0].'</PersonName>
                                            </Room>
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type2 == 'TPL')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult2; $i++)
                                    {
                                            $title = $this->session->userdata('title2');
                                            $first_name = $this->session->userdata('first_name2');
                                            $last_name = $this->session->userdata('last_name2');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room2 ='<Rooms>
                                            <RoomType Type="TPL">
                                             '.$ro.'
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type2 == 'DBLSGL')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult2; $i++)
                                    {
                                            $title = $this->session->userdata('title2');
                                            $first_name = $this->session->userdata('first_name2');
                                            $last_name = $this->session->userdata('last_name2');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room2 ='<Rooms>
                                            <RoomType Type="DBLSGL">
                                             '.$ro.'
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type2 == 'QDR')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult2; $i++)
                                    {
                                            $title = $this->session->userdata('title2');
                                            $first_name = $this->session->userdata('first_name2');
                                            $last_name = $this->session->userdata('last_name2');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room2 ='<Rooms>
                                            <RoomType Type="QDR">
                                             '.$ro.'
                                                 <ExtraBed PersonID="3" ChildAge="2">JERRY DOE</ExtraBed>
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type2 == 'DBL')
                        {
                           
                            if($this->session->userdata('child_room2') == '1')
                            {
                                $child_age1 = $this->session->userdata('child2_age1');
                                $ro = '';
                                    for($i =0; $i<$adult2; $i++)
                                    {
                                            $title = $this->session->userdata('title2');
                                            $first_name = $this->session->userdata('first_name2');
                                            $last_name = $this->session->userdata('last_name2');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title[$i].' '.$first_name[$i].' '.$last_name[$i].'</PersonName>';
                                    }
                                        $room2 ='<Rooms>
                                            <RoomType Type="DBL">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                                
                            }
                            if($this->session->userdata('child_room2') == '2')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $child_age2 = $this->session->userdata('child_age2');
                                $ro = '';
                                for($i =0; $i<$adult2; $i++)
				{
					$title = $this->session->userdata('title2');
                                        $first_name = $this->session->userdata('first_name2');
                                        $last_name = $this->session->userdata('last_name2');
                                        $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                }
                                $room2 ='<Rooms>
                                            <RoomType Type="DBL">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child2_age1.'">JERRY DOE</ExtraBed>
                                                <ExtraBed PersonID="4" ChildAge="'.$child2_age2.'">JERRYs DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                            }
                               
                        }
                        if($room_type2 == 'TWN')
                        {
                           
                            if($this->session->userdata('child_room2') == '1')
                            {
                                $child_age1 = $this->session->userdata('child2_age1');
                                $ro = '';
                                    for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->session->userdata('title2');
                                            $first_name = $this->session->userdata('first_name2');
                                            $last_name = $this->session->userdata('last_name2');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                        $room2 ='<Rooms>
                                            <RoomType Type="TWN">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                                
                            }
                            if($this->session->userdata('child_room2') == '2')
                            {
                                $child_age1 = $this->session->userdata('child2_age1');
                                $child_age2 = $this->session->userdata('child2_age2');
                                $ro = '';
                                for($i =0; $i<$adult; $i++)
				{
					$title = $this->session->userdata('title2');
                                        $first_name = $this->session->userdata('first_name2');
                                        $last_name = $this->session->userdata('last_name2');
                                        $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                }
                                $room2 ='<Rooms>
                                            <RoomType Type="TWN">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                                <ExtraBed PersonID="4" ChildAge="'.$child_age2.'">JERRYs DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                            }
                               
                        }
                        if($room_type3 == 'SGL')
                        {
                                $title = $this->session->userdata('title3');
                                $first_name = $this->session->userdata('first_name3');
                                $last_name = $this->session->userdata('last_name3');
                                $room3 ='<Rooms>
                                            <RoomType Type="SGL">
                                            <Room RoomID="1">
                                                    <PersonName PersonID="1">'.$title[0].' '.$first_name[0].' '.$last_name[0].'</PersonName>
                                            </Room>
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type3 == 'TPL')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult3; $i++)
                                    {
                                            $title = $this->session->userdata('title3');
                                            $first_name = $this->session->userdata('first_name3');
                                            $last_name = $this->session->userdata('last_name3');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room3 ='<Rooms>
                                            <RoomType Type="TPL">
                                             '.$ro.'
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type3 == 'DBLSGL')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult3; $i++)
                                    {
                                            $title = $this->session->userdata('title3');
                                            $first_name = $this->session->userdata('first_name3');
                                            $last_name = $this->session->userdata('last_name3');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room3 ='<Rooms>
                                            <RoomType Type="DBLSGL">
                                             '.$ro.'
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type3 == 'QDR')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult3; $i++)
                                    {
                                            $title = $this->session->userdata('title3');
                                            $first_name = $this->session->userdata('first_name3');
                                            $last_name = $this->session->userdata('last_name3');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room3 ='<Rooms>
                                            <RoomType Type="QDR ">
                                             '.$ro.'
                                                 <ExtraBed PersonID="3" ChildAge="2">JERRY DOE</ExtraBed>
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type3 == 'DBL')
                        {
                           
                            if($this->session->userdata('child_room3') == '1')
                            {
                                $child_age1 = $this->session->userdata('child3_age1');
                                $ro = '';
                                    for($i =0; $i<$adult3; $i++)
                                    {
                                            $title = $this->session->userdata('title3');
                                            $first_name = $this->session->userdata('first_name3');
                                            $last_name = $this->session->userdata('last_name3');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title[$i].' '.$first_name[$i].' '.$last_name[$i].'</PersonName>';
                                    }
                                        $room3 ='<Rooms>
                                            <RoomType Type="DBL">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                                
                            }
                            if($this->session->userdata('child_room3') == '2')
                            {
                                $child_age1 = $this->session->userdata('child3_age1');
                                $child_age2 = $this->session->userdata('child3_age2');
                                $ro = '';
                                for($i =0; $i<$adult3; $i++)
				{
					$title = $this->session->userdata('title3');
                                        $first_name = $this->session->userdata('first_name3');
                                        $last_name = $this->session->userdata('last_name3');
                                        $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                }
                                $room3 ='<Rooms>
                                            <RoomType Type="DBL">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                                <ExtraBed PersonID="4" ChildAge="'.$child_age2.'">JERRYs DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                            }
                               
                        }
                        if($room_type3 == 'TWN')
                        {
                           
                            if($this->session->userdata('child_room3') == '1')
                            {
                                $child_age1 = $this->session->userdata('child3_age1');
                                $ro = '';
                                    for($i =0; $i<$adult3; $i++)
                                    {
                                            $title = $this->session->userdata('title3');
                                            $first_name = $this->session->userdata('first_name3');
                                            $last_name = $this->session->userdata('last_name3');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                        $room3 ='<Rooms>
                                            <RoomType Type="TWN">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                                
                            }
                            if($this->session->userdata('child_room1') == '2')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $child_age2 = $this->session->userdata('child_age2');
                                $ro = '';
                                for($i =0; $i<$adult; $i++)
				{
					$title = $this->session->userdata('title');
                                        $first_name = $this->session->userdata('first_name');
                                        $last_name = $this->session->userdata('last_name');
                                        $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                }
                                $room ='<Rooms>
                                            <RoomType Type="TWN">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                                <ExtraBed PersonID="4" ChildAge="'.$child_age2.'">JERRYs DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                            }
                               
                        }
                        //echo $room; exit;
                         if($room_count == 1)
                         {
                             $room = $room;
                             $room2 ='';
                             $room3 ='';
                         }
                         if($room_count == 2)
                         {
                             $room = $room;
                             $room2 = $room2;
                             $room3 ='';
                         }
                          if($room_count == 3)
                         {
                             $room = $room;
                             $room2 = $room2;
                             $room3 = $room3;
                         }
			$email_id = $this->session->userdata('email_id');
                        if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
					{
						$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
						$agency = '1521228';
						$user = 'TRVLMRTXML';
						$password = 'SLA2WLEP';
					}
					else
					{
						$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
						$agency = '37398';
						$user = 'TRAVELLINGMARTXML';
						$password = 'SAYADMANAMAH';
                                           /* $url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
                                            $agency = '1521228';
                                            $user = 'TRVLMRTXML';
                                            $password = 'SLA2WLEP';*/
					}
                                         $agent_ref = "travel".rand('100','1000');
			try {
				 $options = array(
				  'soap_version' => SOAP_1_1,
				  'exceptions' => true,
				  'trace'   => 1,
				  'cache_wsdl' => WSDL_CACHE_NONE,
				  "Content-Type: text/json; charset=UTF-8",
					"Content-Encoding: UTF-8",
					"Accept: application/xml",
					"Accept-Encoding: gzip"
				 );
				 
				 $soapclient = new SoapClient($url, $options);
				} catch(Exception $e) {
				 echo "<h2>Exception Error!</h2>";
				 echo $e->getMessage();
				}
				 
				try {
				 $param=array ('requestType'=>'2','xmlRequest'=>'<Root>
					<Header>
						<Agency>'.$agency.'</Agency>
						<User>'.$user.'</User>
						<Password>'.$password.'</Password>
						<Operation>BOOKING_INSERT_REQUEST</Operation>
						<OperationType>Request</OperationType>
					</Header>
					<Main>
						<AgentReference>'.$agent_ref.'</AgentReference>
						<HotelSearchCode>'.$HotelSearchCode.'</HotelSearchCode>
						<ArrivalDate>'.$start_date.'</ArrivalDate>
						<Nights>'.$nights.'</Nights>
						<NoAlternativeHotel>1</NoAlternativeHotel>
						<Leader LeaderPersonID="1"/>
						'.$room.''.$room2.''.$room3.'
					</Main>
	
				</Root>');
				//print_r($param);  exit;
				$result = $soapclient->MakeRequest($param);
				} catch(Exception $e) {
				 echo "Caught exception : ", $e->getMessage, "\n";
				}
				 
				//echo "<pre>";
				//print_r($result); exit;
				$arr = (array) $result;
			
				$array = $this->xml2array($arr['MakeRequestResult']);
				//echo "<pre>"; print_r($array); exit;
				if(isset($array['Root']['Header']))
				{
					$headr = $array['Root']['Header'];
					$Agency = $headr['Agency']['value'];
					$User = $headr['User']['value'];
					$Password = $headr['Password']['value'];
					$Operation = $headr['Operation']['value'];
					$OperationType = $headr['OperationType']['value'];
				}
				if(isset($array['Root']['Main']['Error']['value']))
				{
					redirect('home/hotel_search','refresh');
				}
				else
				{
					if(isset($array['Root']['Main']))
					{
						$mian = $array['Root']['Main'];
						if(isset($mian['GoBookingCode']['value']))
						{
							$GoBookingCode = $mian['GoBookingCode']['value'];
						}
						else
						{
							$GoBookingCode = '';
						}
						if(isset($mian['GoReference']['value']))
						{
							$GoReference = $mian['GoReference']['value'];
						}
						else
						{
							$GoReference = '';
						}
						if(isset($mian['ClientBookingCode']['value']))
						{
							$ClientBookingCode = $mian['ClientBookingCode']['value'];
						}
						else
						{
							$ClientBookingCode = '';
						}
						if(isset($mian['BookingStatus']['value']))
						{
							$BookingStatus = $mian['BookingStatus']['value'];
						}
						else
						{
							$BookingStatus = '';
						}
						if(isset($mian['TotalPrice']['value']))
						{
							$TotalPrice = $mian['TotalPrice']['value'];
						}
						else
						{
							$TotalPrice = '';
						}
						if(isset($mian['Currency']['value']))
						{
							$Currency = $mian['Currency']['value'];
						}
						else
						{
							$Currency = '';
						}
						if(isset($mian['HotelName']['value']))
						{
							$HotelName = $mian['HotelName']['value'];
						}
						else
						{
							$HotelName = '';
						}
						if(isset($mian['HotelSearchCode']['value']))
						{
							$HotelSearchCode = $mian['HotelSearchCode']['value'];
						}
						else
						{
							$HotelSearchCode = '';
						}
						if(isset($mian['RoomType']['value']))
						{
							$RoomType = $mian['RoomType']['value'];
						}
						else
						{
							$RoomType = '';
						}
						if(isset($mian['RoomBasis']['value']))
						{
							$RoomBasis = $mian['RoomBasis']['value'];
						}
						else
						{
							$RoomBasis = '';
						}
						if(isset($mian['ArrivalDate']['value']))
						{
							$ArrivalDate = $mian['ArrivalDate']['value'];
						}
						else
						{
							$ArrivalDate = '';
						}
						if(isset($mian['CancellationDeadline']['value']))
						{
							$CancellationDeadline = $mian['CancellationDeadline']['value'];
						}
						else
						{
							$CancellationDeadline = '';
						}
						if(isset($mian['Nights']['value']))
						{
							$Nights = $mian['Nights']['value'];
						}
						else
						{
							$Nights = '';
						}
						if(isset($mian['NoAlternativeHotel']['value']))
						{
							$NoAlternativeHotel = $mian['NoAlternativeHotel']['value'];
						}
						else
						{
							$NoAlternativeHotel = '';
						}
						$title = implode('<br>',$title);
						$first_name = implode('<br>',$first_name);
						$last_name = implode('<br>',$last_name);
						$id = $this->Home_Model->insert_booking($GoBookingCode,$GoReference,$ClientBookingCode,$BookingStatus,$TotalPrice,$Currency,$HotelName,$HotelSearchCode,$RoomType,$RoomBasis,$ArrivalDate,$CancellationDeadline,$Nights,$NoAlternativeHotel,$title,$first_name,$last_name,$email_id);
                                                $this->Home_Model->insert_payment_detail($id,$locale,$batchNo,$command,$message,$version,$cardType,$orderInfo,$receiptNo,$merchantID,$authorizeID,$merchTxnRef,$transactionNo,$acqResponseCode,$txnResponseCode);
					}
				}
				
							
				
		 redirect('home/confirm/'.$id,'refresh');
                }
                }
                else
                {
                     $errorTxt = "Error In Transaction System.";
                     $data['errordesc']=$errorTxt;
			
                     $this->load->view('hotel/error_page',$data);
                }
                
	}
	function booking()
	{
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$api = $this->input->post('api');
		if($api == 'hotelspro')
		{
			$result_id = $this->input->post('result_id');
			$search=$this->Home_Model->get_cancel_attrib_new($result_id);
			$fname = $this->input->post('first_name');
			$lname = $this->input->post('last_name');
                        //echo "<pre>"; print_r($fname); exit;
			$trns_id =  time();
			 for($i=0; $i< count($fname); $i++)
			 {
				$data1 = array(
					 'last_name' => $lname[$i], 
					 'first_name' => $fname[$i],
					 'parent_id' => $trns_id
			);
				
			$this->db->insert('customer_info_details', $data1);//adult_booking_details 
			$customer_info_details_id = $this->db->insert_id();
				
			}
			$data['surname_co']=$lname[0];
			$data['name_co']=$fname[0];
			$data['phone_co']= '';
			$data['email_co']=$this->input->post('email_id');
			$data4 = array(
						 'last_name' => $data['surname_co'], 
						 'first_name' => $data['name_co'],
						 'mobile' => $data['phone_co'],
						 'email' => $data['email_co'],
						 'customer_info_details_id' =>$customer_info_details_id
					);
			$this->db->insert('customer_contact_details', $data4); 
			$parent_customer_id = $this->db->insert_id();
			$user_id ='';
			$data5 = array(
				 'product_id' => 2,
				 'user_id' => $user_id,
				 'amount' => $search->nightperroom,
				 'customer_contact_details_id' => $parent_customer_id, 
				 'created_date' => date("Y-m-d")
			);
			
			$this->db->insert('transaction_details', $data5); //exit;
			$parent_transaction_id = $this->db->insert_id();
			//echo $result_id; exit;
			$service=$this->Home_Model->get_searchresult($result_id);
			//echo "<pre>"; print_r($service); exit;
			$h_hotel_id = $service->hotel_id;
			$h_hotel_name = $service->HotelName;
			$h_star = $service->StarRating;
			//$h_description = $service->HotelInfo;
			$h_description = '';
			$h_address = $service->HotelAddress;
			$h_city = $service->Destination;
			$h_phone = $service->HotelPhoneNumber;
			$h_fax = '';
			$trans_id = $parent_customer_id;
	 		$contact_info=$this->Home_Model->contact_info_detail_update($trans_id);
           	$con_id = $contact_info->customer_info_details_id;
	 		$pass_info=$this->Home_Model->pass_info_detail($trns_id);
			$con_id_org =$contact_info->customer_contact_details_id;
			
			$fname1=$pass_info[0]->first_name;			 
			$lname1=$pass_info[0]->last_name;	
		
			$adults=$search->adult;
			$child=$search->child;
			$roomcat=$search->room_catecode;
			$hotel_id=$search->hotel_id;
			
			$leadTravellerInfo = array();
			$paxInfo = array("paxType" => "Adult", "title" => 'Mr', "firstName" => $fname1, "lastName" => $lname1);
			//echo "<pre>"; print_r($paxInfo);exit;
			$leadTravellerInfo = $paxInfo;
			$leadTravellerInfo["paxInfo"] = $paxInfo;
			$leadTravellerInfo["nationality"] = "US";
			
			$processId=$search->room_catecode;
			if(count($pass_info)>1)
			{
				for($i=1;$i< count($pass_info);$i++)
				{
					  $otherTravellerInfo[] = array("title" => 'Mr', "firstName" => $pass_info[$i]->first_name, "lastName" => $pass_info[$i]->last_name);
				}
			}
			else
			{
				$otherTravellerInfo= '';
			}
			//echo "<pre>"; print_r($otherTravellerInfo); exit;
			 $preferences = "";
       		 $note = "";
	    	 $agencyReferenceNumber = 'AL2001';
			//echo $processId.$agencyReferenceNumber;
			//print_r($leadTravellerInfo); exit;
			//print_r($leadTravellerInfo.$otherTravellerInfo.$preferences.$note); exit;
			if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
			{
				$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			else
			{
				$url = "http://api.hotelspro.com/4.1/hotel/b2bHotelSOAP.wsdl";
				//$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			 $client = new SoapClient($url, array('trace' => 1));
				 try {
	 
			   $data['errordesc']='';
			   $makeHotelBooking = $client->makeHotelBooking("WTBSbm8yS001a0dVNFo3VTdMcWFDOUphNEhwNnRDOGlKQ21nZHorSHd0TnNnd3dncjNUbjZrTjhVaTZ6N29ERA==", $processId, $agencyReferenceNumber, $leadTravellerInfo,$otherTravellerInfo,  $preferences, $note);
			//echo "<pre>"; print_r($makeHotelBooking);exit;
			  $hotel = $makeHotelBooking->hotelBookingInfo;
			  $rooms = is_array($hotel->rooms) ? $hotel->rooms : array($hotel->rooms);
			  $policies = is_array($hotel->cancellationPolicy) ? $hotel->cancellationPolicy : array($hotel->cancellationPolicy);
			}
			 catch (SoapFault $exception) {
		 
			 $data['errordesc'] = $exception->getMessage();
		 
			}
			if($data['errordesc']!='')
			{
				$data['errordesc']=$data['errordesc'];
				//echo "<pre>"; print_r($data['error']); exit;
				$this->load->view('hotel/error_page',$data);
     		}
			else
			{
				//echo "hi";
				  $ProcessIdvalue = $makeHotelBooking->trackingId;

				  if (false == empty($hotel)) 
				  {
				  $BookingStatusvalue11 = $hotel->bookingStatus;
				  if($BookingStatusvalue11==1)
				  {
					  $BookingStatusvalue ='Confirmed Booking';
				  }
				  elseif($BookingStatusvalue11==2)
				  {
					  $BookingStatusvalue ='On Request Booking';
				  }
				  elseif($BookingStatusvalue11==3)
				  {
					  $BookingStatusvalue ='Rejected Booking';
				  }
				  elseif($BookingStatusvalue11==4)
				  {
					  $BookingStatusvalue ='Cancelled Booking';
				  }
				  elseif($BookingStatusvalue11==5)
				  {
					  $BookingStatusvalue ='Payment Processing';
				  }
				  $CheckInvalue = $hotel->checkIn;
				  $CheckOutvalue = $hotel->checkOut;
				  $BoardTypevalue = $hotel->boardType;
				  $cancellationPolicy11 = $hotel->cancellationPolicy;
				  foreach ($cancellationPolicy11 as $policy)
				  {
						 $val[]= $policy->cancellationDay;
						 if(isset($policy->currency))
						 {
						  $val1[]=  $policy->currency;
						 }
						 else
						 {
							 $val1[]="USD";
						 }
					  $val2=  $policy->feeAmount;
					  $cutype = $policy->feeType;
				   //  $policy->remarks;
				  }
				  $newdate = strtotime ( '-'.$val[0].' day' , strtotime ( $CheckInvalue ) ) ;
				  $cancel_till_date = date ( 'Y-m-d' , $newdate );
			 }
			// $ConfirmationNumbervalue='';
			if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
			{
				$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			else
			{
				$url = "http://api.hotelspro.com/4.1/hotel/b2bHotelSOAP.wsdl";
				//$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
			}
			 $client = new SoapClient($url, array('trace' => 1));
			  $trackingId=$ProcessIdvalue;
			  try {
				   $data['errordesc']='';
				 //  $getHotelBookingStatus = $client->getHotelBookingStatus("WTBSbm8yS001a0dVNFo3VTdMcWFDOUphNEhwNnRDOGlKQ21nZHorSHd0TnNnd3dncjNUbjZrTjhVaTZ6N29ERA==", $trackingId);
			  }
			  catch (SoapFault $exception) 
			  {
				   $data['errordesc'] =  $exception->getMessage();
				  // exit;
			  }
			   if($data['errordesc']!='')
			  {
				   $data['errordesc']=$data['errordesc'];
				   $this->load->view('hotel/error_page',$data);
			  }
			  else
			  {
				 $ConfirmationNumbervalue=$getHotelBookingStatus->hotelBookingInfo->confirmationNumber;
			  }
			$ProcessIdvalue=$ProcessIdvalue;
			$BookingStatusvalue =$BookingStatusvalue;
			$hotelcode = $h_hotel_id;
			$CheckInvalue = $CheckInvalue;
			$CheckOutvalue = $CheckOutvalue;
			$cancel_date = $cancel_till_date;
			$h_room_type = $service->room_type;
			$h_cancel_policy = '';
			$BoardTypevalue = $BoardTypevalue;
			$ConfirmationNumbervalue = $ConfirmationNumbervalue;
			$guestadult= $this->session->userdata('adult_count');
			$guestchild= $this->session->userdata('child_count');
			
			$sd_new = $this->session->userdata('cin1');
			$sds = explode('/',$sd_new);
			$sds_new = $sds[2]."-".$sds[1]."-".$sds[0];
			$cin=date("Y-m-d", strtotime($sds_new));
			//echo $cin; exit;
			$ed_new = $this->session->userdata('cout1');
			$eds = explode('/',$ed_new);
			$eds_new = $eds[2]."-".$eds[1]."-".$eds[0];
			$cout=date("Y-m-d", strtotime($eds_new));
			$date=date('Y-m-d');
			$roomcountss= $this->session->userdata('room_count');
			$user_id=0;
			$nights = $this->session->userdata('dt');
			$dateFromValc = Date('Y-m-d', strtotime("+5 days" , strtotime ( $cin )));
			$nights = $this->session->userdata('dt');
			$trans_id2 = $parent_transaction_id;
			$agent_id = '';
			//echo "<pre>"; print_r($policies); exit;
			  $val_last=$this->Home_Model->inser_customer_book_hotelpro($h_hotel_id,$h_hotel_name,$h_star,$h_description,$h_address,$h_phone,$h_fax,$h_room_type,$h_cancel_policy,$cin,$cout,$date,$roomcountss,$user_id,$nights,$trans_id2,$adults,$child,$con_id_org,$dateFromValc,$h_city,"hotelspro",$trackingId,$agent_id,$policies);
    		 $this->Home_Model->inser_customer_book_hotelpro_trans_hotel($trans_id,$ConfirmationNumbervalue,$user_id,$val_last,$BookingStatusvalue);
			 redirect('home/confirm_hp/'.$val_last,'refresh');
			 
		}
		$this->confirm_mail($var_last);
		}
		else
		{
			$HotelSearchCode = $this->input->post('HotelSearchCode');
			$start_date = $this->session->userdata('start_date');
			$nights = $this->session->userdata('dt');
			$room_type = $this->session->userdata('room_types');
			//echo "<pre>"; print_r($room_type); exit;
			$room_count = $this->session->userdata('room_count');
			
			$adult = $this->input->post('adult');
			$adult2 = $this->input->post('adult2');
			$adult3 = $this->input->post('adult3');
			$title = $this->input->post('title');
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			
			//echo "<pre>"; print_r($title);
			//$this->Home_Model->insert_book_details($HotelSearchCode,$start_date,$nights,$room_type,$room_count);
			
			$rooms = '';
			if($room_count == 1)
			{
				for($i =0; $i<$adult; $i++)
				{
					$title = $title[$i];
					$first_name = $first_name[$i];
					$last_name = $last_name[$i];
					$rooms ='<Room RoomID="'.($i+1).'">
									<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>
								</Room>';
				}
				
			}
			if($room_count == 2)
			{
				for($i =0; $i<$adult; $i++)
				{
					$title = $title[$i];
					$first_name = $first_name[$i];
					$last_name = $last_name[$i];
				}
				$title2 = $this->input->post('title2');
				$first_name2 = $this->input->post('first_name2');
				$last_name2 = $this->input->post('last_name2');
				for($i =0; $i<$adult2; $i++)
				{
					$title2 = $title2[$i];
					$first_name2 = $first_name2[$i];
					$last_name2 = $last_name2[$i];
				}
			}
			if($room_count == 3)
			{
				for($i =0; $i<$adult; $i++)
				{
					$title = $title[$i];
					$first_name = $first_name[$i];
					$last_name = $last_name[$i];
				}
				$title2 = $this->input->post('title2');
				$first_name2 = $this->input->post('first_name2');
				$last_name2 = $this->input->post('last_name2');
				for($i =0; $i<$adult2; $i++)
				{
					$title2 = $title2[$i];
					$first_name2 = $first_name2[$i];
					$last_name2 = $last_name2[$i];
				}
				$title3 = $this->input->post('title3');
				$first_name3 = $this->input->post('first_name3');
				$last_name3 = $this->input->post('last_name3');
				for($i =0; $i<$adult3; $i++)
				{
					$title3 = $title3[$i];
					$first_name3 = $first_name3[$i];
					$last_name3 = $last_name3[$i];
				}
			}
			
			
                      // echo "<pre>"; print_r($this->session->userdata); exit;
                        if($room_type == 'SGL')
                        {
                                $title = $this->input->post('title');
                                $first_name = $this->input->post('first_name');
                                $last_name = $this->input->post('last_name');
                                $room ='<Rooms>
                                            <RoomType Type="SGL">
                                            <Room RoomID="1">
                                                    <PersonName PersonID="1">'.$title[0].' '.$first_name[0].' '.$last_name[0].'</PersonName>
                                            </Room>
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type == 'TPL')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->input->post('title');
                                            $first_name = $this->input->post('first_name');
                                            $last_name = $this->input->post('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room ='<Rooms>
                                            <RoomType Type="TPL">
                                             '.$ro.'
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type == 'DBLSGL')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->input->post('title');
                                            $first_name = $this->input->post('first_name');
                                            $last_name = $this->input->post('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room ='<Rooms>
                                            <RoomType Type="DBLSGL">
                                             '.$ro.'
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type == 'QDR')
                        {
                                $ro = '';
                                   for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->input->post('title');
                                            $first_name = $this->input->post('first_name');
                                            $last_name = $this->input->post('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                $room ='<Rooms>
                                            <RoomType Type="QDR ">
                                             '.$ro.'
                                                 <ExtraBed PersonID="3" ChildAge="2">JERRY DOE</ExtraBed>
                                            </RoomType>
					</Rooms>';
                        }
                        if($room_type == 'DBL')
                        {
                           
                            if($this->session->userdata('child_room1') == '1')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $ro = '';
                                    for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->input->post('title');
                                            $first_name = $this->input->post('first_name');
                                            $last_name = $this->input->post('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title[$i].' '.$first_name[$i].' '.$last_name[$i].'</PersonName>';
                                    }
                                        $room ='<Rooms>
                                            <RoomType Type="DBL">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                                
                            }
                            if($this->session->userdata('child_room1') == '2')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $child_age2 = $this->session->userdata('child_age2');
                                $ro = '';
                                for($i =0; $i<$adult; $i++)
				{
					$title = $this->input->post('title');
                                        $first_name = $this->input->post('first_name');
                                        $last_name = $this->input->post('last_name');
                                        $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                }
                                $room ='<Rooms>
                                            <RoomType Type="DBL">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                                <ExtraBed PersonID="4" ChildAge="'.$child_age2.'">JERRYs DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                            }
                               
                        }
                        if($room_type == 'TWN')
                        {
                           
                            if($this->session->userdata('child_room1') == '1')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $ro = '';
                                    for($i =0; $i<$adult; $i++)
                                    {
                                            $title = $this->input->post('title');
                                            $first_name = $this->input->post('first_name');
                                            $last_name = $this->input->post('last_name');
                                            $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                    }
                                        $room ='<Rooms>
                                            <RoomType Type="TWN">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                                
                            }
                            if($this->session->userdata('child_room1') == '2')
                            {
                                $child_age1 = $this->session->userdata('child_age1');
                                $child_age2 = $this->session->userdata('child_age2');
                                $ro = '';
                                for($i =0; $i<$adult; $i++)
				{
					$title = $this->input->post('title');
                                        $first_name = $this->input->post('first_name');
                                        $last_name = $this->input->post('last_name');
                                        $ro .= '<PersonName PersonID="'.($i+1).'">'.$title.' '.$first_name.' '.$last_name.'</PersonName>';
                                }
                                $room ='<Rooms>
                                            <RoomType Type="TWN">
                                            <Room RoomID="1">
                                                '.$ro.'
                                                <ExtraBed PersonID="3" ChildAge="'.$child_age1.'">JERRY DOE</ExtraBed>
                                                <ExtraBed PersonID="4" ChildAge="'.$child_age2.'">JERRYs DOE</ExtraBed>
                                        </Room>
                                            </RoomType>
					</Rooms>';
                            }
                               
                        }
                        //echo $room; exit;
			$email_id = $this->input->post('email_id');
			
			if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
					{
						$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
						$agency = '1521228';
						$user = 'TRVLMRTXML';
						$password = 'SLA2WLEP';
					}
					else
					{
						$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
						$agency = '37398';
						$user = 'TRAVELLINGMARTXML';
						$password = 'SAYADMANAMAH';
                                           /* $url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
                                            $agency = '1521228';
                                            $user = 'TRVLMRTXML';
                                            $password = 'SLA2WLEP';*/
					}
                              $agent_ref = "travel".rand('100','1000');
			try {
				 $options = array(
				  'soap_version' => SOAP_1_1,
				  'exceptions' => true,
				  'trace'   => 1,
				  'cache_wsdl' => WSDL_CACHE_NONE,
				  "Content-Type: text/json; charset=UTF-8",
					"Content-Encoding: UTF-8",
					"Accept: application/xml",
					"Accept-Encoding: gzip"
				 );
				 
				 $soapclient = new SoapClient($url, $options);
				} catch(Exception $e) {
				 echo "<h2>Exception Error!</h2>";
				 echo $e->getMessage();
				}
				 
				try {
				 $param=array ('requestType'=>'2','xmlRequest'=>'<Root>
					<Header>
						<Agency>'.$agency.'</Agency>
						<User>'.$user.'</User>
						<Password>'.$password.'</Password>
						<Operation>BOOKING_INSERT_REQUEST</Operation>
						<OperationType>Request</OperationType>
					</Header>
					<Main>
						<AgentReference>'.$agent_ref.'</AgentReference>
						<HotelSearchCode>'.$HotelSearchCode.'</HotelSearchCode>
						<ArrivalDate>'.$start_date.'</ArrivalDate>
						<Nights>'.$nights.'</Nights>
						<NoAlternativeHotel>1</NoAlternativeHotel>
						<Leader LeaderPersonID="1"/>
						'.$room.'
					</Main>
	
				</Root>');
				//print_r($param);  exit;
				$result = $soapclient->MakeRequest($param);
				} catch(Exception $e) {
				 echo "Caught exception : ", $e->getMessage, "\n";
				}
				 
				//echo "<pre>";
				//print_r($result); exit;
				$arr = (array) $result;
			
				$array = $this->xml2array($arr['MakeRequestResult']);
				//echo "<pre>"; print_r($array); 
				if(isset($array['Root']['Header']))
				{
					$headr = $array['Root']['Header'];
					$Agency = $headr['Agency']['value'];
					$User = $headr['User']['value'];
					$Password = $headr['Password']['value'];
					$Operation = $headr['Operation']['value'];
					$OperationType = $headr['OperationType']['value'];
				}
				if(isset($array['Root']['Main']['Error']['value']))
				{
					//redirect('home/hotel_search','refresh');
				}
				else
				{
					if(isset($array['Root']['Main']))
					{
						$mian = $array['Root']['Main'];
						if(isset($mian['GoBookingCode']['value']))
						{
							$GoBookingCode = $mian['GoBookingCode']['value'];
						}
						else
						{
							$GoBookingCode = '';
						}
						if(isset($mian['GoReference']['value']))
						{
							$GoReference = $mian['GoReference']['value'];
						}
						else
						{
							$GoReference = '';
						}
						if(isset($mian['ClientBookingCode']['value']))
						{
							$ClientBookingCode = $mian['ClientBookingCode']['value'];
						}
						else
						{
							$ClientBookingCode = '';
						}
						if(isset($mian['BookingStatus']['value']))
						{
							$BookingStatus = $mian['BookingStatus']['value'];
						}
						else
						{
							$BookingStatus = '';
						}
						if(isset($mian['TotalPrice']['value']))
						{
							$TotalPrice = $mian['TotalPrice']['value'];
						}
						else
						{
							$TotalPrice = '';
						}
						if(isset($mian['Currency']['value']))
						{
							$Currency = $mian['Currency']['value'];
						}
						else
						{
							$Currency = '';
						}
						if(isset($mian['HotelName']['value']))
						{
							$HotelName = $mian['HotelName']['value'];
						}
						else
						{
							$HotelName = '';
						}
						if(isset($mian['HotelSearchCode']['value']))
						{
							$HotelSearchCode = $mian['HotelSearchCode']['value'];
						}
						else
						{
							$HotelSearchCode = '';
						}
						if(isset($mian['RoomType']['value']))
						{
							$RoomType = $mian['RoomType']['value'];
						}
						else
						{
							$RoomType = '';
						}
						if(isset($mian['RoomBasis']['value']))
						{
							$RoomBasis = $mian['RoomBasis']['value'];
						}
						else
						{
							$RoomBasis = '';
						}
						if(isset($mian['ArrivalDate']['value']))
						{
							$ArrivalDate = $mian['ArrivalDate']['value'];
						}
						else
						{
							$ArrivalDate = '';
						}
						if(isset($mian['CancellationDeadline']['value']))
						{
							$CancellationDeadline = $mian['CancellationDeadline']['value'];
						}
						else
						{
							$CancellationDeadline = '';
						}
						if(isset($mian['Nights']['value']))
						{
							$Nights = $mian['Nights']['value'];
						}
						else
						{
							$Nights = '';
						}
						if(isset($mian['NoAlternativeHotel']['value']))
						{
							$NoAlternativeHotel = $mian['NoAlternativeHotel']['value'];
						}
						else
						{
							$NoAlternativeHotel = '';
						}
						$title = implode('<br>',$title);
						$first_name = implode('<br>',$first_name);
						$last_name = implode('<br>',$last_name);
						$id = $this->Home_Model->insert_booking($GoBookingCode,$GoReference,$ClientBookingCode,$BookingStatus,$TotalPrice,$Currency,$HotelName,$HotelSearchCode,$RoomType,$RoomBasis,$ArrivalDate,$CancellationDeadline,$Nights,$NoAlternativeHotel,$title,$first_name,$last_name,$email_id);
					}
				}
				
				//without payment gateway
				
				$this->confirm_mail($id);
				
				redirect('home/confirm/1','refresh');
		}
			//redirect('home/confirm_book/'.$id,'refresh');
	}
	
	function send_mail($toEmail,$fromName,$fromEmail,$ccEmail='',$msg,$subject)
    {
        $CI =& get_instance();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.provab.com';
        $config['smtp_port'] = 25;
        $config['smtp_user'] = 'christin@provab.com';
        $config['smtp_pass'] = 'provab123';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $CI->load->library('email',$config);
        $message=preg_replace('/\s[\s]+/', '',$msg);
        $toEmail = strip_tags($toEmail);
        
        $CI->email->set_newline("\r\n");
        $CI->email->from($fromEmail,$fromName);
        $CI->email->to($toEmail);
        if($ccEmail!='')
        {
            $CI->email->cc($ccEmail);
        }
        $CI->email->subject($subject);
        $CI->email->message($message);

		if($CI->email->send())
        {
            return true;
        }
        else
        {
            //echo $CI->email->print_debugger();
            return false;
        }
    }
	
	function confirm_mail($id)
	{
		$book_det = $this->Home_Model->book_det($id);
		$message= '<html>
					<head>
					<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
					</head>
					<style>
					.tablebody
					{
						width:100%;
						height:auto;
						float:left;
					}
					.tablebody-in
					{
						width:850px;
						height:auto;
						margin:0px auto;
					}
					.inin
					{
						width:420px;
						float:left;
						height:auto;
						border-radius:5px;
						border:1px solid #DCDCDC;
					}
					.tablebody-in1
					{
						width:850px;
						height:auto;
						margin:0px auto;
						font-family:Arial, Helvetica, sans-serif;
					}
					.in-left
					{
						width:420px;
						float:left;
						height:auto;
					}
					.in-left p
					{
						width:400px;
						float:left;
						text-align:justify;
						font-size:12px;
						line-height:0px;
						margin-left:15px;
					}
					.in-left h1
					{
						width:400px;
						float:left;
						font-size:14px;
						font-weight:bold;
						margin-left:15px;
					}

					.in-left h2
					{
						width:400px;
						float:left;
						font-size:13px;
						font-weight:bold;
						margin-left:15px;
					}

					.in-right
					{
						width:420px;
						float:right;
						height:auto;
					}

					.in-right p
					{
						width:400px;
						float:left;
						text-align:justify;
						font-size:12px;
						line-height:0px;
						margin-left:15px;
					}
					.in-right h1
					{
						width:400px;
						float:left;
						font-size:14px;
						font-weight:bold;
						margin-left:15px;
					}

					.in-right h2
					{
						width:400px;
						float:left;
						font-size:13px;
						font-weight:bold;
						margin-left:15px;
					}

					p
					{
						font-size:11px;
						color:#000;
						text-align:justify;
						text-decoration:none;
					}
					a
					{
						color:#FFF;
						text-decoration:none;
					}
					a:hover
					{
						color:#000;
						text-decoration:underline;
					}
					.step2
					{
						width:850px;
						height:auto;
						float:left;
						margin-top:20px;
					}
					.step3
					{
						width:850px;
						height:auto;
						float:left;
						margin-top:20px;
					}

					.step3  p
					{
						width:820px;
						float:left;
						text-align:justify;
						font-size:12px;
						line-height:0px;
						margin-left:15px;
					}
					.step3 h1
					{
									  width:820px;
						float:left;
						font-size:14px;
						font-weight:bold;
						margin-left:15px;
					}

					.step3 h2
					{
						width:820px;
						float:left;
						font-size:13px;
						font-weight:bold;
						margin-left:15px;
					}
					</style>
					<body>
					<div class="tablebody">
					<div class="tablebody-in1">
					<table width="100%" border="0" style="float:left; margin-bottom:15px; margin-top:15px;">
					  <tr>
						<td height="30" align="center">Thanks, <span>'.$book_det->name1.'</span>! Your reservation is now confirmed</td>
						</tr>
					</table>
					</div>
					<div class="tablebody-in">

					<table width="100%" border="0" style="float:left; margin-bottom:0px; margin-top:0px; background:url('.WEB_DIR.'images/header_slice.jpg) repeat;">
					  <tr>
						<td height="30" align="center">    
					<table width="33%" border="0" style="float:left;">
					  <tr>
						<td><img src="'.WEB_DIR.'images/logo.png" width="294" height="73" style="margin-left:15px; float:left;" /></td>
					 
					  </tr>
					</table>
					<table width="50%" border="0" style="float:right; margin-top:37px;">
					  <tr style="color:#fff; font-size:12px;">
						<td width="41%"><img src="'.WEB_DIR.'images/img1.png" width="19" height="19" />&nbsp;<a href="#">Best price Guaranteed</a></td>
						<td width="17%"><img src="'.WEB_DIR.'images/img2.png" width="24" height="21" />&nbsp;<a href="#" onclick="javascript:window.print();">Print</a></td>
						
					  </tr>
					</table>
					</td>
						</tr>
					</table>
					</div>
					<div class="tablebody-in" style="margin-top:10px;">

					<table width="100%" border="0" style="float:left; margin-bottom:0px; margin-top:10px; ">
					  <tr>
						<td height="30" align="center">
						
					<table width="49%" border="0" style="float:left;  border:1px solid #ED2020; font-size:12px;">
					  <tr>
						<td width="46%" height="30">Booking number</td>
						<td width="54%" align="right"> 1000'.$book_det->booking_no.'</td>
					 
					  </tr>
					  <tr>
						<td height="30">PIN Code</td>
						<td align="right">'.$book_det->zip.'</td>
					  </tr>
					  <tr>
						<td height="30">Email</td>
						<td align="right"><a href="#" style="color:#ED2020;">'.$book_det->email.'</a></td>
					  </tr>
					  <tr>
						<td height="30">Booked by</td>
						<td align="right">'.$book_det->name1.'</td></td>
					  </tr>
					</table>
					<table width="49%" border="0" style="float:right;  border:1px solid #ED2020; font-size:12px;">
					  <tr>
						<td height="30" colspan="2" align="center">'.$book_det->hotelname.'</td>
						</tr>
					  <tr>
						<td height="30" colspan="2"><table width="100%" border="0">
						  
						</table></td>
						</tr>   
						<tr>
						<td height="20" colspan="2">     </td>
						</tr>
					  
					  <tr>
						<td width="46%" height="54">Address:</td>
						<td width="54%" align="right"> <address>'.$book_det->address.'

					</address>
						</td>
					  </tr>
					  <tr>
						<td height="30">Phone:</td>
						<td align="right">'.$book_det->ph.'</td>
					  </tr>
					  
					</table>

					<table width="49%" border="0" style="float:left;  border:1px solid #ED2020; font-size:12px; margin-top:15px;">
					  <tr>
						<td width="46%" height="30">Your reservation</td>
						<td width="54%" align="right"> '.$book_det->Nights.' night</td>
					  </tr>
					  <tr>
						<td height="30">Check in</td>
						<td align="right"> '.date('D, d M Y',strtotime($book_det->check_in)).'<br />
						 <span style="color:#9b9b9b;"></span>
						</td>
					  </tr>
					  <tr>
						<td height="30">Check - out</td>
						<td align="right"> '.date('D, d M Y',strtotime($book_det->check_out)).' <br />
						 <span style="color:#9b9b9b;"></span>
						</td>
					  </tr>
					  
					</table>
					</td>
						</tr>
					</table>
					
					<table width="100%" border="0" style="float:left; margin-bottom:0px; margin-top:10px; ">
					  <tr>
						<td height="30" align="center">   
					<table width="49%" border="0" style="float:left;  border:1px solid #ED2020; font-size:12px; background-color:#f9f9f9;">
					  <tr>
						<td width="46%" height="30">room Details </td>
						<td width="54%" align="right"> USD '.$book_det->amount.'</td>
					  </tr>
					  <tr>
						<td height="30"><span style="font-size:15px; color:#ED2020;">Total Price</span></td>
						<td align="right"> <span style="font-size:15px; color:#ED2020;">USD '.$book_det->amount.'</span>    
						</td>
					  </tr>
					  <tr>
						<td height="20" colspan="2"><p>You will pay when stay at '.$book_det->hotelname.'
					</p><p>Service charge not included</p>
					 
					<p>The total price shown is the amount you will pay to the property Travellingmart  does not change any reservation adminstration or other fees</p></td>
					  </tr>
					</table>
					<table width="49%" border="0" style="float:right; ">
					  <tr style="color:#fff; font-size:12px;">
						<td height="30"><img src='.WEB_DIR.'images/map.jpg width="356" height="220" /></td>
						</tr>
					</table>
					</td>
						</tr>
					</table>
					<table width="100%" border="0" style="float:left; margin-bottom:0px; margin-top:10px; background:url(header_slice.jpg) repeat; color:#fff; font-size:14px;">
					  <tr style="margin-top:18px; margin-bottom:18px">
						<td height="50" align="center">You can esaliy change or cancel this booking for free before 31 December 2013 by <br/>visiting My Travellingmart.com</td>
						</tr>   
					</table>
					</div>
					<div class="tablebody-in">
					<div class="step2">
					<div class="in-left">
					<div class="inin">
					<h1>Room Details : '.$book_det->room_type.'</h1>
										<p>
					Gustname : '.$book_det->name1.'</p>
					<h2>Meal plan :</h2>
					<ul style="font-size:12px; font-weight:normal; margin-left:0px;">
					<li>'.$book_det->inclusion.'</li>
					</ul>
					
					<h2>Cancellation policy :</h2>
					<ul style="font-size:12px; font-weight:normal; margin-left:0px; line-height:18px; margin-right:1px text-align:justify;">
					<li>Cancellation Till Date : '.$book_det->cancel_tilldate.'</li>
					</ul>
										
					</div>
					</div>
					<div class="in-right">
					<div class="inin">
					
					<p><img src='.WEB_DIR.'images/img6.png width="36" height="35" /></p>
					<h2>Important Information</h2>
					<p>Please check your visa requirements before you travel. </p>
					<p style="line-height:18px;">
					Transfers to and from Dubai International Airport are available on a request basis from the hotel. Please contact the hotel once a reservation is in place for further information on this service. </p>
					<p style="line-height:18px;">
					Please note that payment or settlement for all non-refundable bookings, an original credit card should be presented upon arrival. 
					</p>
					<p style="line-height:18px;">
					Please note that the guest name and credit card holder s name should be the same.
					</p>
										</div>
					</div>
					</div>
					<div class="step3">
					
					</div>
					</div>
					</div>
					</body>
					</html>';
		$subject='Travellingmart Hotel Booking Confirmation ';
        $from="info@travellingmart.com";
        $headers ="MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .="From: $from";
        //$from = "";
        //ini_set("SMTP","mail.travellingmart.com");
       // ini_set("smtp_port",25);
		$to = $book_det->email;
		$ccEmail ='balup.provab@gmail.com';
		$message = 'Hi '.$book_det->name1.',<br/><br/>

			 The Hotel booking with Travellingmart completed. The details as follows<br/><br/>
			
			'.$message.'
			<br/><br/>
			
			Regards<br/><br/>
			Travellingmart
			';
        //$mail= mail($to, $subject, $message, $headers);
		$this->send_mail($to,$book_det->name1,$from,$ccEmail,$message,$subject);
	}
	function confirm_book($id)
	{
		//$data['hotel'] = $this->Home_Model->book_det($id);
		$this->load->view('hotel/thankyou_new');
	}
	function confirm($id)
	{
		$data['hotel'] = $this->Home_Model->book_det($id);
         $data['payment_det'] = $this->Home_Model->payment_details($id);
		$this->load->view('hotel/thankyou',$data);
	}
	function confirm_hp($id)
	{
		$data['hotel'] = $this->Home_Model->book_det_hp($id);
                $data['payment_det'] = $this->Home_Model->payment_details($id);
		$this->load->view('hotel/thankyou_hp',$data);
	}
	function cancel_hotel($id)
	{
		$data['hotel'] = $hotel = $this->Home_Model->book_det($id);
		try {
			 $options = array(
			  'soap_version' => SOAP_1_1,
			  'exceptions' => true,
			  'trace'   => 1,
			  'cache_wsdl' => WSDL_CACHE_NONE,
			  "Content-Type: text/json; charset=UTF-8",
				"Content-Encoding: UTF-8",
				"Accept: application/xml",
				"Accept-Encoding: gzip"
			 );
			  if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.108')
				{
					$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '1521228';
					$user = 'TRVLMRTXML';
					$password = 'SLA2WLEP';
				}
				else
				{
					$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '37398';
					$user = 'TRAVELLINGMARTXML';
					$password = 'SAYADMANAMAH';
                   
				}
			 $soapclient = new SoapClient($url, $options);
			} catch(Exception $e) {
			 echo "<h2>Exception Error!</h2>";
			 echo $e->getMessage();
			}
			 
			try {
			 $param1=array ('requestType'=>'3','xmlRequest'=>'<Root>
						<Header>
							<Agency>1521228</Agency>
							<User>TRVLMRTXML</User>
							<Password>SLA2WLEP</Password>
							<Operation>BOOKING_CANCEL_REQUEST</Operation>
							<OperationType>Request</OperationType>
						</Header>
						<Main>
							<GoBookingCode>'.trim($hotel->ProcessId).'</GoBookingCode>
						</Main>
					</Root>');
			print_r($param1);  
			$result = $soapclient->MakeRequest($param1);
			} catch(Exception $e) {
			 echo "Caught exception : ", $e->getMessage, "\n";
			}
			 
			echo "<pre>";
			print_r($result); exit;
			$arr = (array) $result;
		
			$array = $this->xml2array($arr['MakeRequestResult']);
			//echo "<pre>"; print_r($array); exit;
			if(isset($array['Root']['Main']))
			{
				$hotel = $array['Root']['Main'];
				if(isset($hotel['GoBookingCode']['value']))
				{
					$GoBookingCode = $hotel['GoBookingCode']['value'];
				}
				else
				{
					$GoBookingCode = '';
				}
				if(isset($hotel['BookingStatus']['value']))
				{
					$BookingStatus = $hotel['BookingStatus']['value'];
				}
				else
				{
					$BookingStatus = '';
				}
				$this->Home_Model->update_hotel_status($id,$GoBookingCode,$BookingStatus);
			}
			redirect('home/print_voucher/'.$id,'refresh');
	}
	function check_hotel($id)
	{
		$data['hotel'] = $hotel = $this->Home_Model->book_det($id);
		
		try {
			 $options = array(
			  'soap_version' => SOAP_1_1,
			  'exceptions' => true,
			  'trace'   => 1,
			  'cache_wsdl' => WSDL_CACHE_NONE,
			  "Content-Type: text/json; charset=UTF-8",
				"Content-Encoding: UTF-8",
				"Accept: application/xml",
				"Accept-Encoding: gzip"
			 );
			   if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.108')
				{
					$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '1521228';
					$user = 'TRVLMRTXML';
					$password = 'SLA2WLEP';
				}
				else
				{
					$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '37398';
					$user = 'TRAVELLINGMARTXML';
					$password = 'SAYADMANAMAH';
                   
				}
			 $soapclient = new SoapClient($url, $options);
			} catch(Exception $e) {
			 echo "<h2>Exception Error!</h2>";
			 echo $e->getMessage();
			}
			 
			try {
			 $param1=array ('requestType'=>'5','xmlRequest'=>'<Root>
						<Header>
							<Agency>1521228</Agency>
							<User>TRVLMRTXML</User>
							<Password>SLA2WLEP</Password>
							<Operation>BOOKING_STATUS_REQUEST</Operation>
							<OperationType>Request</OperationType>
						</Header>
						<Main>
							<GoBookingCode>'.trim($hotel->ProcessId).'</GoBookingCode>
						</Main>
					</Root>');
			//print_r($param1);   exit;
			$result = $soapclient->MakeRequest($param1);
			} catch(Exception $e) {
			 echo "Caught exception : ", $e->getMessage, "\n";
			}
			 
			//echo "<pre>";
			//print_r($result); exit;
			$arr = (array) $result;
		
			$array = $this->xml2array($arr['MakeRequestResult']);
			//echo "<pre>"; print_r($array); exit;
			if(isset($array['Root']['Main']))
			{
				$hotel = $array['Root']['Main'];
				if(isset($hotel['GoBookingCode']['value']))
				{
					$GoBookingCode = $hotel['GoBookingCode']['value'];
				}
				else
				{
					$GoBookingCode = '';
				}
				if(isset($hotel['GoBookingCode']['value']['attr']['Status']))
				{
					$BookingStatus = $hotel['GoBookingCode']['value']['attr']['Status'];
				}
				else
				{
					$BookingStatus = '';
				}
				if(isset($hotel['GoBookingCode']['value']['attr']['GoReference']))
				{
					$GoReference = $hotel['GoBookingCode']['value']['attr']['GoReference'];
				}
				else
				{
					$GoReference = '';
				}
				if(isset($hotel['GoBookingCode']['value']['attr']['TotalPrice']))
				{
					$TotalPrice = $hotel['GoBookingCode']['value']['attr']['TotalPrice'];
				}
				else
				{
					$TotalPrice = '';
				}
				if(isset($hotel['GoBookingCode']['value']['attr']['Currency']))
				{
					$Currency = $hotel['GoBookingCode']['value']['attr']['Currency'];
				}
				else
				{
					$Currency = '';
				}
				$this->Home_Model->update_hotel_status2($id,$GoBookingCode,$BookingStatus,$GoReference,$TotalPrice,$Currency);
			}
			redirect('home/print_voucher/'.$id,'refresh');
			
	}
	function voucher($id)
	{
		$data['hotel'] = $this->Home_Model->book_det_hp($id);
		$this->load->view('hotel/voucher_hp',$data);
	}
	function get_voucher($id)
	{
		$data['hotel'] = $hotel = $this->Home_Model->book_det($id);
		
				
			
		try {
			 $options = array(
			  'soap_version' => SOAP_1_1,
			  'exceptions' => true,
			  'trace'   => 1,
			  'cache_wsdl' => WSDL_CACHE_NONE,
			  "Content-Type: text/json; charset=UTF-8",
				"Content-Encoding: UTF-8",
				"Accept: application/xml",
				"Accept-Encoding: gzip"
			 );
			   if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
				{
					$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '1521228';
					$user = 'TRVLMRTXML';
					$password = 'SLA2WLEP';
				}
				else
				{
					$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
					$agency = '37398';
					$user = 'TRAVELLINGMARTXML';
					$password = 'SAYADMANAMAH';
                   
				}
			 $soapclient = new SoapClient($url, $options);
			} catch(Exception $e) {
			 echo "<h2>Exception Error!</h2>";
			 echo $e->getMessage();
			}
			 
			try {
			 $param=array ('requestType'=>'8','xmlRequest'=>'<Root>
						<Header>
							<Agency>1521228</Agency>
							<User>TRVLMRTXML</User>
							<Password>SLA2WLEP</Password>
							<Operation>VOUCHER_DETAILS_REQUEST</Operation>
							<OperationType>Request</OperationType>
						</Header>
						<Main>
							<GoBookingCode>'.$hotel->ProcessId.'</GoBookingCode>
						</Main>
					</Root>');
			 //print_r($param);   
			$result2 = $soapclient->MakeRequest($param);
			} catch(Exception $e) {
			 echo "Caught exception : ", $e->getMessage, "\n";
			}
			 
			//echo "<pre>";
			//print_r($result2); exit;
			$arr2 = (array) $result2;
		
			$array = $this->xml2array($arr2['MakeRequestResult']);
			//echo "<pre>"; print_r($array2); exit;
			if(isset($array['Root']['Main']))
			{
				$hotel = $array['Root']['Main'];
				if(isset($hotel['GoBookingCode']['value']))
				{
					$GoBookingCode = $hotel['GoBookingCode']['value'];
				}
				else
				{
					$GoBookingCode = '';
				}
				if(isset($hotel['HotelName']['value']))
				{
					$HotelName = $hotel['HotelName']['value'];
				}
				else
				{
					$HotelName = '';
				}
				if(isset($hotel['Address']['value']))
				{
					$Address = $hotel['Address']['value'];
				}
				else
				{
					$Address = '';
				}
				if(isset($hotel['GoBookingCode']['value']['attr']['TotalPrice']))
				{
					$TotalPrice = $hotel['GoBookingCode']['value']['attr']['TotalPrice'];
				}
				else
				{
					$TotalPrice = '';
				}
				if(isset($hotel['Phone']['value']))
				{
					$Phone = $hotel['Phone']['value'];
				}
				else
				{
					$Phone = '';
				}
				if(isset($hotel['Fax']['value']))
				{
					$Fax = $hotel['Fax']['value'];
				}
				else
				{
					$Fax = '';
				}
				if(isset($hotel['CheckInDate']['value']))
				{
					$CheckInDate = $hotel['CheckInDate']['value'];
				}
				else
				{
					$CheckInDate = '';
				}
				if(isset($hotel['RoomBasis']['value']))
				{
					$RoomBasis = $hotel['RoomBasis']['value'];
				}
				else
				{
					$RoomBasis = '';
				}
				if(isset($hotel['Nights']['value']))
				{
					$Nights = $hotel['Nights']['value'];
				}
				else
				{
					$Nights = '';
				}
				if(isset($hotel['Rooms']['value']))
				{
					$Rooms = $hotel['Rooms']['value'];
				}
				else
				{
					$Rooms = '';
				}
				if(isset($hotel['Remarks']['value']))
				{
					$Remarks = $hotel['Remarks']['value'];
				}
				else
				{
					$Remarks = '';
				}
				if(isset($hotel['BookedAndPayableBy']['value']))
				{
					$BookedAndPayableBy = $hotel['BookedAndPayableBy']['value'];
				}
				else
				{
					$BookedAndPayableBy = '';
				}
				if(isset($hotel['SupplierReferenceNumber']['value']))
				{
					$SupplierReferenceNumber = $hotel['SupplierReferenceNumber']['value'];
				}
				else
				{
					$SupplierReferenceNumber = '';
				}
				$this->Home_Model->update_hotel_status3($id,$GoBookingCode,$SupplierReferenceNumber,$BookedAndPayableBy,$Remarks,$Address);
			}
			redirect('home/print_voucher/'.$id,'refresh');
	}
	function print_voucher($id)
	{
		$data['hotel'] = $this->Home_Model->book_det($id);
		$this->load->view('hotel/voucher',$data);
	}
	function index()
	{
		header('Cache-Control: max-age=900');
		$changed_cur = $this->input->post('changed_cur');
		if($changed_cur == '')
		{
			/*if($this->session->userdata('host_currencyCode'))
			{echo 'asfdasfd';exit;
			}
			else
			{*/
			//	echo 'asdfasdf';exit;
				require_once('geoplugin.class.php');
				$geoplugin = new geoPlugin();
				$geoplugin->locate($_SERVER['REMOTE_ADDR']);
				"Currency Code: {$geoplugin->currencyCode} <br />\n".
				"Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
				"Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
				//$data['host_currencyCode'] = $geoplugin->currencyCode;
				$data['host_currencyCode'] = 'USD';
				$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
			//}
		}
		else
		{
			//$data['host_currencyCode'] = $changed_cur;
			$data['host_currencyCode'] = 'USD';
			$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
		}
		if($this->session->userdata('memid') != '')
		{
			$data['memid'] = $memid = $this->session->userdata('memid');
			$this->load->view('member/index', $data);
		}
		else
		{
			$this->load->view('index');		
		}
	}
	function change_currency()
	{
		$changed_cur = $this->input->post('changed_cur');
		$data['host_currencyCode'] = $changed_cur;
		$this->session->set_userdata(array('host_currencyCode'=>$data['host_currencyCode']));
		echo $this->session->userdata('host_currencyCode');
	}
	function hotel_home()
	{
		header('Cache-Control: max-age=900');
		$this->load->view('hotel/hotel_home');		
	}
	function car_home()
	{
		header('Cache-Control: max-age=900');
		$this->load->view('car/car_home');		
	}
	function packages_home()
	{
		header('Cache-Control: max-age=900');
		$this->load->view('packages/packages_home');		
	}
	function flight_home()
	{
		$this->load->view('flight/flight_home');		
	}
	function scroll()
	{
		$this->load->view('flight/scroll');
	}
	function supplier($x='')
	{
		$data['x'] = $x;
		$this->load->view('supplier/partner',$data);
	}
	function thankyou($id)
	{
		$data['id'] = $id;
		//$data['ins_id'] = $ins_id;
		$data['email'] = $email = $this->Home_Model->get_last_email($id);
		//header("HTTP/1.1 301 Moved Permanently"); 
		$this->load->view('supplier/thankyou',$data);
	}
	function load_hotel()
	{
		//echo "<pre>"; print_r($this->input->post()); exit;
		header('Cache-Control: max-age=900');
		//echo 'ghkkjgj';exit;
		$sec_res=session_id(); 
		$this->Home_Model->delete_search_result($sec_res);
		$data['sd'] = $sd = $this->input->post('sd_hotel');
		$data['ed'] = $ed = $this->input->post('ed_hotel');
		//echo $ed; exit;
	    $data['adult_count'] = $adult_count  = '1';
		$hotel_city = explode(',',$this->input->post('hotel_city'));
		$data['disp_city'] = $disp_city = $hotel_city[0];
		$data['disp_country'] = $disp_country = trim($hotel_city[1]);
		$data['hotel_name'] = $hotel_name = $this->input->post('hotel_name');
		//echo $hotel_name; exit;
		//$data['countrycode1']= $countrycode1 = $this->Home_Model->get_countrycode(trim($disp_city));
		//echo "<pre>"; print_r($countrycode1); exit;
		$countrycode = '';
		$start_date1 = explode('/',$sd);
		$start_date = $start_date1['2'].'-'.$start_date1[1].'-'.$start_date1[0];
		$end_date1 = explode('/',$ed);
		$end_date = $end_date1['2'].'-'.$end_date1[1].'-'.$end_date1[0];
		$citycode = $this->Home_Model->get_global_citycode($disp_city);
		if(strstr($disp_city,'('))
		{
			$disp_city1 = explode('(',$disp_city);
			//echo "<pre>"; print_r($disp_city1); 
			$disp_city = $disp_city1[0];
		}
		else
		{
			$disp_city = $disp_city;
		}
		$hp_citycode = $this->Home_Model->get_hp_citycode($disp_city);
		$room_types = $this->input->post('room_types');
		$room_types2 = $this->input->post('room_types2');
		$room_types3 = $this->input->post('room_types3');
		$child = $this->input->post('child');
		$childroom2 = $this->input->post('childroom2');
		$childroom3 = $this->input->post('childroom3');
		//echo "<pre>"; print_r($room_types); exit;
		$room_count = $this->input->post('room_count');
		if($room_count == '1')
		{
			//for($i= 0; $i< count($room_types); $i++)
			//{
				$room_types = $room_types; 
				if($room_types == 'DBL')
				{
					if($child == '1')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = '';
					}
					else if($child == '2')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = $this->input->post('child_age2');
					}
					else
					{
						$child_age1 = '';
						$child_age2 = '';
					}
					$infant = $this->input->post('infant');
				}
				else if($room_types == 'TWN')
				{
					if($child == '1')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = '';
					}
					else if($child == '2')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = $this->input->post('child_age2');
					}
					else
					{
						$child_age1 = '';
						$child_age2 = '';
					}
					$infant = $this->input->post('infant');
				}
				else if($room_types == 'DBLSGL')
				{
					$infant = $this->input->post('infant');
					$child_age1 = '';
					$child_ag2 = '';
				}
				else
				{
					$child_age1 = '';
					$child_age2 = '';
					$infant = '';
				}
				$child2_age1 = '';
				$child2_age2 = '';
				$child3_age1 = '';
				$child3_age2 = '';
				$infant2 = '';
				$infant3 = '';
			//}
		}
		if($room_count == '2')
		{
			//for($i= 0; $i< count($room_types); $i++)
			//{
				//$room_types = $room_types[0]; 
				if($room_types == 'DBL')
				{
					if($child == '1')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = '';
					}
					else if($child == '2')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = $this->input->post('child_age2');
					}
					else
					{
						$child_age1 = '';
						$child_age2 = '';
					}
					$infant = $this->input->post('infant');
				}
				else if($room_types == 'TWN')
				{
					if($child == '1')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = '';
					}
					else if($child == '2')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = $this->input->post('child_age2');
					}
					else
					{
						$child_age1 = '';
						$child_age2 = '';
					}
					$infant = $this->input->post('infant');
				}
				else if($room_types == 'DBLSGL')
				{
					$infant = $this->input->post('infant');
					$child_age1 = '';
					$child_ag2 = '';
				}
				else
				{
					$child_age1 = '';
					$child_age2 = '';
					$infant = '';
				}
			//}
			$room_types2 = $room_types2;
			if($room_types2 == 'DBL')
			{
					if($childroom2 == '1')
					{
						$child2_age1 = $this->input->post('child2_age1');
						$child2_age2 = '';
					}
					else if($childroom2 == '2')
					{
						$child2_age1 = $this->input->post('child2_age1');
						$child2_age2 = $this->input->post('child2_age2');
					}
					else
					{
						$child2_age1 = '';
						$child2_age2 = '';
					}
					$infant2 = $this->input->post('infant2');
				}
			else if($room_types2 == 'TWN')
			{
					if($childroom2 == '1')
					{
						$child2_age1 = $this->input->post('child2_age1');
						$child2_age2 = '';
					}
					else if($childroom2 == '2')
					{
						$child2_age1 = $this->input->post('child2_age1');
						$child2_age2 = $this->input->post('child2_age2');
					}
					else
					{
						$child2_age1 = '';
						$child2_age2 = '';
					}
					$infant2 = $this->input->post('infant2');
				}
			else if($room_types2 == 'DBLSGL')
			{
					$infant2 = $this->input->post('infant2');
					$child2_age1 = '';
					$child2_age2 = '';
			}
			else
			{
					$child2_age1 = '';
					$child2_age2 = '';
					$infant2 = '';
			}
			$child3_age1 = '';
			$child3_age2 = '';
			$infant3 = '';
		}
		
		if($room_count == '3')
		{
			//echo "hi"; exit;//for($i= 0; $i< count($room_types); $i++)
			//{
				$room_types = $room_types; 
				if($room_types == 'DBL')
				{
					if($child == '1')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = '';
					}
					else if($child == '2')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = $this->input->post('child_age2');
					}
					else
					{
						$child_age1 = '';
						$child_age2 = '';
					}
					$infant = $this->input->post('infant');
				}
				else if($room_types == 'TWN')
				{
					if($child == '1')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = '';
					}
					else if($child == '2')
					{
						$child_age1 = $this->input->post('child_age1');
						$child_age2 = $this->input->post('child_age2');
					}
					else
					{
						$child_age1 = '';
						$child_age2 = '';
					}
					$infant = $this->input->post('infant');
				}
				else if($room_types == 'DBLSGL')
				{
					$infant = $this->input->post('infant');
					$child_age1 = '';
					$child_ag2 = '';
				}
				else
				{
					$child_age1 = '';
					$child_age2 = '';
					$infant = '';
				}
			//}
			$room_types2 = $room_types2;
			if($room_types2 == 'DBL')
			{
					//echo "hihhi";
					if($childroom2 == '1')
					{
						$child2_age1 = $this->input->post('child2_age1');
						$child2_age2 = '';
					}
					else if($childroom2 == '2')
					{
						$child2_age1 = $this->input->post('child2_age1');
						$child2_age2 = $this->input->post('child2_age2');
					}
					else
					{
						$child2_age1 = '';
						$child2_age2 = '';
					}
					$infant2 = $this->input->post('infant2');
				}
			else if($room_types2 == 'TWN')
			{
					if($childroom2 == '1')
					{
						$child2_age1 = $this->input->post('child2_age1');
						$child2_age2 = '';
					}
					else if($childroom2 == '2')
					{
						$child2_age1 = $this->input->post('child2_age1');
						$child2_age2 = $this->input->post('child2_age2');
					}
					else
					{
						$child2_age1 = '';
						$child2_age2 = '';
					}
					$infant2 = $this->input->post('infant2');
				}
			else if($room_types2 == 'DBLSGL')
			{
					$infant2 = $this->input->post('infant2');
					$child2_age1 = '';
					$child2_age2 = '';
			}
			else
			{
					$child2_age1 = '';
					$child2_age2 = '';
					$infant2 = '';
			}
			
			//$room_types3 = $room_types[2];
			if($room_types3 == 'DBL')
			{
					if($childroom3 == '1')
					{
						$child3_age1 = $this->input->post('child3_age1');
						$child3_age2 = '';
					}
					else if($childroom3 == '2')
					{
						$child3_age1 = $this->input->post('child3_age1');
						$child3_age2 = $this->input->post('child3_age2');
					}
					else
					{
						$child3_age1 = '';
						$child3_age2 = '';
					}
					$infant3 = $this->input->post('infant3');
				}
			else if($room_types3 == 'TWN')
			{
					if($childroom3 == '1')
					{
						$child3_age1 = $this->input->post('child3_age1');
						$child3_age2 = '';
					}
					else if($childroom3 == '2')
					{
						$child3_age1 = $this->input->post('child3_age1');
						$child3_age2 = $this->input->post('child3_age2');
					}
					else
					{
						$child3_age1 = '';
						$child3_age2 = '';
					}
					$infant3 = $this->input->post('infant3');
				}
			else if($room_types3 == 'DBLSGL')
			{
					$infant3 = $this->input->post('infant3');
					$child3_age1 = '';
					$child3_age2 = '';
			}
			else
			{
					$child3_age1 = '';
					$child3_age2 = '';
					//$infant2 = '';
			}
		}
		//echo $child2_age1.$child2_age2.$child_age1; exit;
		$room_type = array();
		$room_type = array('0'=>$room_types,'1'=>$room_types2,'2'=>$room_types3);
		$this->session->set_userdata(array('sec_res'=>$sec_res,'citycode'=>$citycode,'countrycode'=>$countrycode,'cin1'=>$data['sd'],'cout1'=>$data['ed'],'adult_count'=>$data['adult_count'],'disp_city'=>$data['disp_city'],'disp_country'=>$data['disp_country'],'start_date'=>$start_date,'end_date'=>$end_date,'room_types'=>$room_types,'room_types2'=>$room_types2,'room_types3'=>$room_types3,'child_age1'=>$child_age1,'child_age2'=>$child_age2,'infant'=>$infant,'child2_age1'=>$child2_age1,'child2_age2'=>$child2_age2,'infant2'=>$infant2,'child3_age1'=>$child3_age1,'child3_age2'=>$child3_age2,'infant3'=>$infant3,'room_count'=>$room_count,'child_room1'=>$child,'child_room2'=>$childroom2,'child_room3'=>$childroom3,'hp_citycode'=>$hp_citycode,'room_type'=>$room_type,'hotel_name'=>$hotel_name));
		
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$this->load->view('hotel/load_cust',$data);
		//redirect('home/cust_search','refresh');
	}
	function cust_search()
	{
		//echo "hi"; exit;
		header('Cache-Control: max-age=900');
		set_time_limit(0);
		ini_set('memory_limit', '-1');
		$city1=$this->session->userdata('citycode');
		$sec_res=$this->session->userdata('sec_res');
		$data['cin'] = $this->session->userdata('cin');
		$data['cout'] = $this->session->userdata('cout');
		$data['star'] = $this->session->userdata('star');
		$data['apt_sel'] = $this->session->userdata('apt_sel');
		$data['amt_sel'] = $this->session->userdata('amt_sel');
		$data['adult_count'] = $adult_count  = $this->session->userdata('adult_count');
		//$data['nor']=$noofroom;
		$data['city']=$city1;
		$data['dt']= '';
		$cin = '';
		$cout = '';
		$days = '';
		if($this->session->userdata('cin1'))
		{	
			//echo $this->session->userdata('cin1'); exit;
			$out=explode("/",$this->session->userdata('cout1'));
			date_default_timezone_set("Asia/Kolkata");
			$cout=$out[2]."-".$out[1]."-".$out[0];
			//$cout = $this->session->userdata('cout');
			$cout_hb=$out[2].$out[1].$out[0];
			$in=explode("/",$this->session->userdata('cin1'));
			$cin=$in[2]."-".$in[1]."-".$in[0];
			//$cin = $this->session->userdata('cin');
			$diff = strtotime($cout) - strtotime($cin);
			$sec   = $diff % 60;
			$diff  = intval($diff / 60);
			$min   = $diff % 60;
			$diff  = intval($diff / 60);
			$hours = $diff % 24;
			$days  = intval($diff / 24);
			$data['dt']=$days;
			//echo $days; exit;
		}
		$roomCode='';
		$rooms='';
		$room1='';
		$hotelbed_rooms='';
		$hotelbed_room1='';
		$roomtype='';
		$data['roomCode']=$roomtype;
		$rooms=$room1;
		$roomusedtype=$roomCode;
		$this->session->set_userdata(array('dt'=>$data['dt'],'city'=>$data['city'],'cin'=>$cin,'cout'=>$cout,'modify_cin'=>$this->input->post('sd'),'modify_cout'=>$this->input->post('ed')));
		//echo "<pre>"; print_r($this->session->userdata);exit;
		//***********  crs    ****************
		
        //if($this->session->userdata('citycode') && $this->session->userdata('countrycode'))
		//{
			//$this->crs_availability($cin,$cout,$days,$sec_res,$adult_count);
		//}
		//$this->hotel_avail();
		$this->h_hotel_availabilty();
		redirect('home/hotel_search','refresh');
	}
	function h_hotel_availabilty()
	{
		header('Cache-Control: max-age=900');
		//echo '<pre>'; print_r($this->session->userdata);exit;
		$data['flag'] ='1';
		//exit;
		$hotel_name = $this->session->userdata('hotel_name');
		$room_used_type = $this->session->userdata('room_type');
		$sd = $this->session->userdata('start_date');
		$room_count = $this->session->userdata('room_count');
		$ed = $this->session->userdata('end_date');
		$city_code = $this->session->userdata('hp_citycode');
		$cin = $this->session->userdata('cin1');
		$cout =  $this->session->userdata('cout1');
		$sb_room_cnt =0;
		$db_room_cnt =0;
		$tb_room_cnt =0;
		$q_room_cnt =0;
		$dbc_room_cnt =0;
		$dbcc_room_cnt =0;
		$room1='';
		$hotelbed_rooms='';
		for($k=0;$k< $room_count;$k++)
		{
			if($room_used_type[$k]=='SGL')
			{
				
				$sb_room_cnt =$sb_room_cnt + 1;
			}
			if($room_used_type[$k]=='DBL')
			{
				
				$db_room_cnt =$db_room_cnt + 1;
			}
			if($room_used_type[$k]=='TWN')
			{
				
				$dbc_room_cnt =$dbc_room_cnt + 1;
			}
			if($room_used_type[$k]=='DBLSGL')
			{
				$dbcc_room_cnt =$dbcc_room_cnt + 1;
			}
			if($room_used_type[$k]=='TPL')
			{
				$tb_room_cnt =$tb_room_cnt + 1;
			}
			if($room_used_type[$k]=='QDR')
			{
				$q_room_cnt =$q_room_cnt + 1;
			}

		}
		$rooms = array();
		if($sb_room_cnt >0)
		{
			$tot_adult=1;
			for($h=0;$h< $sb_room_cnt;$h++)
			{
				  $rooms[] = array(array("paxType" => "Adult"));
			}

		}
		if($db_room_cnt>0)
		{			
			$tot_adult=2;
			for($h=0;$h< $db_room_cnt;$h++)
			{
				 $rooms[] = array(array("paxType" => "Adult"), array("paxType" => "Adult"));
			}
		}
		if($dbc_room_cnt>0)
		{
			$tot_adult=2;
			$tot_child=1;
			for($h=0;$h< $dbc_room_cnt;$h++)
			{
				   $rooms[] = array(array("paxType" => "Adult"), array("paxType" => "Adult"), array("paxType" => "Child", "age" => 8));

			}

		}
		if($dbcc_room_cnt>0)
		{
			$tot_adult=2;
			$tot_child=2;
			for($h=0;$h< $dbcc_room_cnt;$h++)
			{
			
			   $rooms[] = array(array("paxType" => "Adult"), array("paxType" => "Adult"), array("paxType" => "Child", "age" => 8), array("paxType" => "Child", "age" => 8));
			}

		}
		if($tb_room_cnt >0)
		{
			$tot_adult=3;
			 $rooms[] = array(array("paxType" => "Adult"), array("paxType" => "Adult"), array("paxType" => "Adult"));
		}
		if($q_room_cnt>0)
		{
			$tot_adult=4;
			for($h=0;$h< $q_room_cnt;$h++)
			{
				 $rooms[] = array(array("paxType" => "Adult"), array("paxType" => "Adult"), array("paxType" => "Adult"), array("paxType" => "Adult"));
			}
		}
		$_SESSION['pro_search_id'] ='';
		if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.17')
		{
			$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
		}
		else
		{
			$url = "http://api.hotelspro.com/4.1/hotel/b2bHotelSOAP.wsdl";
			//$url = "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl";
		}
               // echo "<pre>"; print_r($rooms); exit;
			   
		$client = new SoapClient( $url, array('connection_timeout'=> 5, 'soap_version'=>SOAP_1_2, 'trace' => 1, 'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP));
  		try
		{
		 	$filters = array();
	  		$filters[] = array("filterType" => "resultLimit", "filterValue" => "200");
			/*if($hotel_name != '')
			{
				$filters[] = array("filterType" => "hotelName", "filterValue" => $hotel_name);
			}*/
      		$checkAvailability = $client->getAvailableHotel("WTBSbm8yS001a0dVNFo3VTdMcWFDOUphNEhwNnRDOGlKQ21nZHorSHd0TnNnd3dncjNUbjZrTjhVaTZ6N29ERA==", $city_code, $sd, $ed, "USD", "US", "false", $rooms, $filters);
			//echo "<pre>"; print_r($checkAvailability); exit;
  		}
	 	catch (SoapFault $exception)
		{
      		//echo $exception->getMessage();
      		//exit;
			$data['error_desc'] = $exception->getMessage();
			$this->load->view('hotel/error_page',$data);
  		}	
		if(isset($data['error_desc']) && $data['error_desc']!='')
		{
			$data['error_desc'] = $exception->getMessage();
			$this->load->view('hotel/error_page',$data);
		}
		else
		{
		$searchId =  $checkAvailability->searchId;
		$this->session->set_userdata(array('searchId'=>$searchId));
		if (is_object($checkAvailability->availableHotels)) 
  		{
      		$hotelResponse[] = $checkAvailability->availableHotels;
		}
		else 
  		{
	    	$hotelResponse = $checkAvailability->availableHotels;
  		}
  		foreach ((array)$hotelResponse as $hnum => $hotel) 
  		{
			$processId = $hotel->processId; 
			$hotelCode =  $hotel->hotelCode;
			$availabilityStatus = $hotel->availabilityStatus;
			$totalPrice = $hotel->totalPrice;
			$totalTax =  $hotel->totalTax;
			$currency =  $hotel->currency;
			$boardType =  $hotel->boardType;
  	    	if (is_object($hotel->rooms))
			{
	        	$roomResponse[] = $hotel;
      		}
	  		else 
	  		{
          		$roomResponse = $hotel->rooms;
      		}
	  		$roomCategory=array();
			//$totalRoomRate=array();
	  		$each_ngt_amount=array();
		  	$totalcost_m_m_ddn=array();
		    foreach ((array)$roomResponse as $rnum => $room) 
	  		{
        		$roomCategory[] = $room->roomCategory;
                $totalRoomRate =  $room->totalRoomRate;
                if (is_object($room->paxes)) 
		  		{
              		$roomsInfo[] = $room->paxes;
          		}
				else 
		  		{
              		$roomsInfo = $room->paxes;
          		}
		        if (is_object($room->ratesPerNight))
		  		{
		           $ratesPerNight[] = $room->ratesPerNight;
          		} 
		  		else 
		  		{
              		$ratesPerNight = $room->ratesPerNight;
          		}
                foreach ((array)$roomsInfo as $pnum => $pax) 
		  		{
              		$paxType= $pax->paxType;
          		}
	          	foreach ((array)$ratesPerNight as $rpnum => $price) 
		  		{    
		   			$priceeachrate = $price->date;
           			$each_ngt_amount[] = $price->amount;
		        }
		  		$a=count($each_ngt_amount);
				$roomrateavg = $totalRoomRate/$a;
				unset($each_ngt_amount);
	   			$totalcost_m_m_ddn[]=$roomrateavg;
			}
			$api="hotelspro";	
			$totalcost_m_m = $totalPrice;
			$roomtype=implode("<br>",$roomCategory);
	  		$totalRoomRate=implode("-",$totalcost_m_m_ddn);
			$agent_id = $this->session->userdata('agent_id');
			if($agent_id != '')
			{
				$get_markup = $this->Home_Model->get_markup_agent($agent_id);
				if($get_markup->hotel_type == 'fixed')
				{
					$totalRoomRate = $totalRoomRate + $get_markup->hotel;
				}
				else
				{
					$totalRoomRate = $totalRoomRate + (($totalRoomRate*$get_markup->hotel)/100);
				}
			}
			else
			{
				$totalRoomRate = $totalRoomRate;
			}
			$subagent_id = $this->session->userdata('subagent_id');
			if($subagent_id != '' && $this->session->userdata('flag'))
			{
				$get_markup = $this->Home_Model->get_markup_subagent($subagent_id);
				if($get_markup->hotel_type == 'fixed')
				{
					$totalRoomRate = $totalRoomRate + $get_markup->hotel;
				}
				else
				{
					$totalRoomRate = $totalRoomRate + (($totalRoomRate*$get_markup->hotel)/100);
				}
				$data['flag'] ='1';
			}
			else
			{
				$totalRoomRate = $totalRoomRate;
			}
		    $sec_res=$this->session->userdata('sec_res');
	  		$adult =  $this->session->userdata('adult_count');
			$child =  $this->session->userdata('child_count');
			$star = $this->Home_Model->get_hotel_star($hotelCode);
			$markup = $this->Home_Model->get_markup();
			if($markup != '')
			{
				if($markup->hotel_type == 'fixed')
				{
					$makup_hotel = $markup->hotel;
				}
				else
				{
					$makup_hotel = (($totalRoomRate * $markup->hotel)/100);
				}
				if($markup->gateway_type == 'fixed')
				{
					$payment_gateway_m = $markup->payment_gateway;
				}
				else
				{
					$payment_gateway_m = (($totalRoomRate * $markup->payment_gateway)/100);
				}
				$totalRoomRate = $totalRoomRate + $makup_hotel + $payment_gateway_m;
			}
			else
			{
				$totalRoomRate = $totalRoomRate;
			}
			$this->Home_Model->insert_gta_temp_result($sec_res,'hotelspro',$hotelCode,$processId,$roomtype,$totalRoomRate,$availabilityStatus,$boardType,$adult,$child,$star);   
			  	  }
		}
			//$tmp_data = $this->Hotel_Model->fetch_search_result($sec_res);
		    //$data['result'] = $tmp_data['result'];
			//$this->load->view('search_result',$data);
			//redirect('hotel/search_result','refresh');
  	}
	function football()
	{
		
	}
	function hotel_homes($val)
	{
		$sec_res=session_id(); 
		if($val =='1')
		{
			$data['disp_city']  = 'London, United Kingdom';
		}
		if($val =='2')
		{
			$data['disp_city']  = 'ABU DHABI, UNITED ARAB EMIRATES';
		}
		if($val =='3')
		{
			$data['disp_city']  = 'PARIS, FRANCE';
		}
		if($val =='4')
		{
			$data['disp_city']  = 'NEW YORK (NY), UNITED STATES';
		}
		if($val == '5')
		{
			$data['disp_city']  = 'VLORE, ALBANIA';
		}
		if($val == '6')
		{
			$data['disp_city']  = 'DURRES, ALBANIA';
		}
		if($val == '16')
		{
			$data['disp_city']  = 'TIRANA, ALBANIA';
		}
		if($val == '7')
		{
			$data['disp_city']  = 'PERTH, AUSTRALIA';
		}
		if($val == '8')
		{
			$data['disp_city']  = 'BRASILIA, BRAZIL';
		}
		if($val == '9')
		{
			$data['disp_city']  = 'TORONTO, CANADA';
		}
		if($val == '10')
		{
			$data['disp_city']  = 'MUNICH, GERMANY';
		}
		if($val == '11')
		{
			$data['disp_city']  = 'PUEBLA, MEXICO';
		}
		if($val == '12')
		{
			$data['disp_city']  = 'DUBLIN, UNITED STATES';
		}
		if($val == '13')
		{
			$data['disp_city']  = 'AUCKLAND, NEW ZEALAND';
		}
		if($val == '14')
		{
			$data['disp_city']  = 'BANGALORE, INDIA';
		}
		if($val == '15')
		{
			$data['disp_city']  = 'BOSTON, UNITED KINGDOM';
		}
		if($val == '16')
		{
			$data['disp_city']  = 'AL-MANAMAH, BAHRAIN';
		}
		if($val == '17')
		{
			$data['disp_city']  = 'ZALLAQ, BAHRAIN';
		}
		if($val == '18')
		{
			$data['disp_city']  = 'ABHA, SAUDI ARABIA';
		}
		if($val == '19')
		{
			$data['disp_city']  = 'AL AHSA, SAUDI ARABIA';
		}
		if($val == '20')
		{
			$data['disp_city']  = 'AL KHOBAR, SAUDI ARABIA';
		}
		if($val == '22')
		{
			$data['disp_city']  = 'RIYADH, SAUDI ARABIA';
		}
		if($val == '21')
		{
			$data['disp_city']  = 'NAHRAWAS, SAUDI ARABIA';
		}
		if($val == '23')
		{
			$data['disp_city']  = 'DAMMAM, SAUDI ARABIA';
		}
		if($val == '25')
		{
			$data['disp_city']  = 'AL JAHRA, KUWAIT';
		}
		if($val == '26')
		{
			$data['disp_city']  = 'KUWAIT CITY, KUWAIT';
		}
		if($val == '27')
		{
			$data['disp_city']  = 'AL KHOR, QATAR';
		}
		if($val == '28')
		{
			$data['disp_city']  = 'DOHA, QATAR';
		}
		if($val == '29')
		{
			$data['disp_city']  = 'AYUTTHAYA, THAILAND';
		}
		if($val == '30')
		{
			$data['disp_city']  = 'BANGKOK, THAILAND';
		}
		if($val == '31')
		{
			$data['disp_city']  = 'PAI, THAILAND';
		}
		if($val == '32')
		{
			$data['disp_city']  = 'SINGAPORE-ALL LOCATIONS, SINGAPORE';
		}
		if($val == '33')
		{
			$data['disp_city']  = 'HONG KONG ISLAND, HONG KONG';
		}
		if($val == '34')
		{
			$data['disp_city']  = 'HONG KONG-KOWLOON, HONG KONG';
		}
		if($val == '35')
		{
			$data['disp_city']  = 'LANTAU ISLAND - HONG KONG AIRPORT, HONG KONG';
		}
		
		$data['cin1'] = date('Y-m-d', strtotime('+8 day'));
		$data['cout1'] = date('Y-m-d', strtotime('+9 day'));
		$data['val'] = $val;
		$this->session->set_userdata(array('sec_res'=>$sec_res,'disp_city'=>$data['disp_city'],'city'=>$data['disp_city'] ,'cin'=>$data['cin1'],'cout'=>$data['cout1']));
		$this->load->view('hotel/load_home',$data);
	}
	function load_hotels($val)
	{
		$return = date('Y-m-d', strtotime('+8 day'));
		$start_date = $return;
		$nights = '1';
		if($val == '1')
		{
			$city_code = '1133';
		}
		if($val == '2')
		{
			$city_code = '128';
		}
		if($val == '3')
		{
			$city_code = '1459';
		}
		if($val == '4')
		{
			$city_code = '1380';
		}
		if($val == '5')
		{
			$city_code = '13812';
		}
		if($val == '6')
		{
			$city_code = '4992';
		}
		if($val == '16')
		{
			$city_code = '4268';
		}
		if($val == '7')
		{
			$city_code = '1481';
		}
		if($val == '8')
		{
			$city_code = '284';
		}
		if($val == '9')
		{
			$city_code = '3037';
		}
		if($val == '10')
		{
			$city_code = '1301';
		}
		if($val == '11')
		{
			$city_code = '2479';
		}
		if($val == '12')
		{
			$city_code = '15094';
		}
		if($val == '13')
		{
			$city_code = '36';
		}
		if($val == '14')
		{
			$city_code = '234';
		}
		if($val == '15')
		{
			$city_code = '6198';
		}
		if($val == '16')
		{
			$city_code = '149';
		}
		if($val == '17')
		{
			$city_code = '16228';
		}
		if($val == '18')
		{
			$city_code = '10';
		}
		if($val == '19')
		{
			$city_code = '10056';
		}
		if($val == '20')
		{
			$city_code = '58';
		}
		if($val == '22')
		{
			$city_code = '1680';
		}
		if($val == '21')
		{
			$city_code = '906';
		}
		if($val == '23')
		{
			$city_code = '1582';
		}
		if($val == '25')
		{
			$city_code = '19163';
		}
		if($val == '26')
		{
			$city_code = '1022';
		}
		if($val == '27')
		{
			$city_code = '20269';
		}
		if($val == '28')
		{
			$city_code = '534';
		}
		if($val == '29')
		{
			$city_code = '138';
		}
		if($val == '30')
		{
			$city_code = '224';
		}
		if($val == '31')
		{
			$city_code = '3950';
		}
		if($val == '32')
		{
			$city_code = '1784';
		}
		if($val == '33')
		{
			$city_code = '822';
		}
		if($val == '34')
		{
			$city_code = '1002';
		}
		if($val == '35')
		{
			$city_code = '3880';
		}
		try {
			 $options = array(
			  'soap_version' => SOAP_1_1,
			  'exceptions' => true,
			  'trace'   => 1,
			  'cache_wsdl' => WSDL_CACHE_NONE,
			  "Content-Type: text/json; charset=UTF-8",
				"Content-Encoding: UTF-8",
				"Accept: application/xml",
				"Accept-Encoding: gzip"
			 );
			 
			 $soapclient = new SoapClient('http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL', $options);
			} catch(Exception $e) {
			 echo "<h2>Exception Error!</h2>";
			 echo $e->getMessage();
			}
			 
			try {
			 $param=array ("requestType"=>"1","xmlRequest"=>"<Root>
				<Header>
					<Agency>1521228</Agency>
					<User>TRVLMRTXML</User>
					<Password>SLA2WLEP</Password>
					<Operation>HOTEL_SEARCH_REQUEST</Operation>
					<OperationType>Request</OperationType>
				</Header>
				<Main>
					<CityCode>".$city_code."</CityCode>
					<ArrivalDate>".$start_date."</ArrivalDate>
					<Nights>".$nights."</Nights>
					<Rooms>
						<Room Type='SGL' RoomCount='1'/>
					</Rooms>
				</Main>
			</Root>");
			//echo "<pre>"; print_r($param); exit;
			 $result = $soapclient->MakeRequest($param);
			} catch(Exception $e) {
			 echo "Caught exception : ", $e->getMessage, "\n";
			}
			 
			//echo "<pre>";
			//print_r($result); exit;
			$arr = (array) $result;
			//echo "<pre>";
			//print_r($arr);
			$array = $this->xml2array($arr['MakeRequestResult']);
			//echo "<pre>"; print_r($array); 
			$api_name = 'goglobal';
			$sec_res=$this->session->userdata('sec_res');
			if(isset($array['Root']['Main']['Error']['value']))
			{
				redirect('home/hotel_search','refresh');
			}
			else
			{
				if(isset($array['Root']['Main']['Hotel'][0]))
				{
					$Hotel = $array['Root']['Main']['Hotel'];
					foreach($Hotel as $hotl)
					{
						if(isset($hotl['HotelSearchCode']['value']))
						{
							$HotelSearchCode = $hotl['HotelSearchCode']['value'];
						}
						else
						{
							$HotelSearchCode = '';
						}
						if(isset($hotl['HotelCode']['value']))
						{
							$HotelCode = $hotl['HotelCode']['value'];
						}
						else
						{
							$HotelCode = '';
						}
						if(isset($hotl['HotelName']['value']))
						{
							$HotelName = $hotl['HotelName']['value'];
						}
						else
						{
							$HotelName = '';
						}
						if(isset($hotl['CountryId']['value']))
						{
							$CountryId = $hotl['CountryId']['value'];
						}
						else
						{
							$CountryId = '';
						}
						if(isset($hotl['CxlDeadline']['value']))
						{
							$CxlDeadline = $hotl['CxlDeadline']['value'];
						}
						else
						{
							$CxlDeadline = '';
						}
						if(isset($hotl['RoomType']['value']))
						{
							$RoomType = $hotl['RoomType']['value'];
						}
						else
						{
							$RoomType = '';
						}
						if(isset($hotl['RoomBasis']['value']))
						{
							$RoomBasis = $hotl['RoomBasis']['value'];
						}
						else
						{
							$RoomBasis = '';
						}
						if(isset($hotl['Availability']['value']))
						{
							$Availability = $hotl['Availability']['value'];
						}
						else
						{
							$Availability = '';
						}
						if(isset($hotl['TotalPrice']['value']))
						{
							$TotalPrice = $hotl['TotalPrice']['value'];
						}
						else
						{
							$TotalPrice = '';
						}
						if(isset($hotl['Currency']['value']))
						{
							$Currency = $hotl['Currency']['value'];
						}
						else
						{
							$Currency = '';
						}
						if(isset($hotl['Category']['value']))
						{
							$Category = $hotl['Category']['value'];
						}
						else
						{
							$Category = '';
						}
						if(isset($hotl['Location']['value']))
						{
							$Location = $hotl['Location']['value'];
						}
						else
						{
							$Location = '';
						}
						if(isset($hotl['LocationCode']['value']))
						{
							$LocationCode = $hotl['LocationCode']['value'];
						}
						else
						{
							$LocationCode = '';
						}
						if(isset($hotl['Preferred']['value']))
						{
							$Preferred = $hotl['Preferred']['value'];
						}
						else
						{
							$Preferred = '';
						}
						if(isset($hotl['Remark']['value']))
						{
							$Remark = $hotl['Remark']['value'];
						}
						else
						{
							$Remark = '';
						}
						if(isset($hotl['Thumbnail']['value']))
						{
							$Thumbnail = $hotl['Thumbnail']['value'];
						}
						else
						{
							$Thumbnail = '';
						}
						if(isset($hotl['TripAdvisor']))
						{
							$TripAdvisor = $hotl['TripAdvisor'];
							if(isset($TripAdvisor['Rating']['value']) && $TripAdvisor['Rating']['value'] != '')
							{
								$Rating = $TripAdvisor['Rating']['value'];
							}
							else
							{
								$Rating = '';
							}
							if(isset($TripAdvisor['RatingImage']['value']) && $TripAdvisor['RatingImage']['value'] != '')
							{
								$RatingImage = $TripAdvisor['RatingImage']['value'];
							}
							else
							{
								$RatingImage = '';
							}
							if(isset($TripAdvisor['ReviewCount']['value']) && $TripAdvisor['ReviewCount']['value'] != '')
							{
								$ReviewCount = $TripAdvisor['ReviewCount']['value'];
							}
							else
							{
								$ReviewCount = '';
							}
							if(isset($TripAdvisor['Reviews']['value']) && $TripAdvisor['Reviews']['value'] != '')
							{
								$Reviews = $TripAdvisor['Reviews']['value'];
							}
							else
							{
								$Reviews = '';
							}
						}
						$this->Home_Model->insert_global_hotels($api_name,$sec_res,$city_code,$HotelSearchCode,$HotelCode,$HotelName,$CountryId,$CxlDeadline,$RoomType,$RoomBasis,$Availability,$TotalPrice,$Currency,$Category,$Location,$LocationCode,$Preferred,$Remark,$Thumbnail,$Rating,$RatingImage,$ReviewCount,$Reviews);
					}
				}
				else
				{
					$hotl = $array['Root']['Main']['Hotel'];
					if(isset($hotl['HotelSearchCode']['value']))
					{
						$HotelSearchCode = $hotl['HotelSearchCode']['value'];
					}
					else
					{
						$HotelSearchCode = '';
					}
					if(isset($hotl['HotelCode']['value']))
					{
						$HotelCode = $hotl['HotelCode']['value'];
					}
					else
					{
						$HotelCode = '';
					}
					if(isset($hotl['HotelName']['value']))
					{
						$HotelName = $hotl['HotelName']['value'];
					}
					else
					{
						$HotelName = '';
					}
					if(isset($hotl['CountryId']['value']))
					{
						$CountryId = $hotl['CountryId']['value'];
					}
					else
					{
						$CountryId = '';
					}
					if(isset($hotl['CxlDeadline']['value']))
					{
						$CxlDeadline = $hotl['CxlDeadline']['value'];
					}
					else
					{
						$CxlDeadline = '';
					}
					if(isset($hotl['RoomType']['value']))
					{
						$RoomType = $hotl['RoomType']['value'];
					}
					else
					{
						$RoomType = '';
					}
					if(isset($hotl['RoomBasis']['value']))
					{
						$RoomBasis = $hotl['RoomBasis']['value'];
					}
					else
					{
						$RoomBasis = '';
					}
					if(isset($hotl['Availability']['value']))
					{
						$Availability = $hotl['Availability']['value'];
					}
					else
					{
						$Availability = '';
					}
					if(isset($hotl['TotalPrice']['value']))
					{
						$TotalPrice = $hotl['TotalPrice']['value'];
					}
					else
					{
						$TotalPrice = '';
					}
					if(isset($hotl['Currency']['value']))
					{
						$Currency = $hotl['Currency']['value'];
					}
					else
					{
						$Currency = '';
					}
					if(isset($hotl['Category']['value']))
					{
						$Category = $hotl['Category']['value'];
					}
					else
					{
						$Category = '';
					}
					if(isset($hotl['Location']['value']))
					{
						$Location = $hotl['Location']['value'];
					}
					else
					{
						$Location = '';
					}
					if(isset($hotl['LocationCode']['value']))
					{
						$LocationCode = $hotl['LocationCode']['value'];
					}
					else
					{
						$LocationCode = '';
					}
					if(isset($hotl['Preferred']['value']))
					{
						$Preferred = $hotl['Preferred']['value'];
					}
					else
					{
						$Preferred = '';
					}
					if(isset($hotl['Remark']['value']))
					{
						$Remark = $hotl['Remark']['value'];
					}
					else
					{
						$Remark = '';
					}
					if(isset($hotl['Thumbnail']['value']))
					{
						$Thumbnail = $hotl['Thumbnail']['value'];
					}
					else
					{
						$Thumbnail = '';
					}
					if(isset($hotl['TripAdvisor']))
					{
						$TripAdvisor = $hotl['TripAdvisor'];
						if(isset($TripAdvisor['Rating']['value']) && $TripAdvisor['Rating']['value'] != '')
						{
							$Rating = $TripAdvisor['Rating']['value'];
						}
						else
						{
							$Rating = '';
						}
						if(isset($TripAdvisor['RatingImage']['value']) && $TripAdvisor['RatingImage']['value'] != '')
						{
							$RatingImage = $TripAdvisor['RatingImage']['value'];
						}
						else
						{
							$RatingImage = '';
						}
						if(isset($TripAdvisor['ReviewCount']['value']) && $TripAdvisor['ReviewCount']['value'] != '')
						{
							$ReviewCount = $TripAdvisor['ReviewCount']['value'];
						}
						else
						{
							$ReviewCount = '';
						}
						if(isset($TripAdvisor['Reviews']['value']) && $TripAdvisor['Reviews']['value'] != '')
						{
							$Reviews = $TripAdvisor['Reviews']['value'];
						}
						else
						{
							$Reviews = '';
						}
					}
					$this->Home_Model->insert_global_hotels($api_name,$sec_res,$city_code,$HotelSearchCode,$HotelCode,$HotelName,$CountryId,$CxlDeadline,$RoomType,$RoomBasis,$Availability,$TotalPrice,$Currency,$Category,$Location,$LocationCode,$Preferred,$Remark,$Thumbnail,$Rating,$RatingImage,$ReviewCount,$Reviews);
					
				}
			}
			redirect('home/hotel_search','refresh');
	}
	function hotel_avail()
	{
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$sec_res=$this->session->userdata('sec_res');
		$hotel_name = $this->session->userdata('hotel_name');
		$city_code = $this->session->userdata('citycode');
		$start_date = $this->session->userdata('start_date');
		$end_date = $this->session->userdata('end_date');
		$nights = $this->session->userdata('dt');
		$room_types = $this->session->userdata('room_types');
		$room_types2 = $this->session->userdata('room_types2');
		$room_types3 = $this->session->userdata('room_types3');
		$child_age1 = $this->session->userdata('child_age1');
		$child_age2 = $this->session->userdata('child_age2');
		$room_count = $this->session->userdata('room_count');
		
		$child2_age1 = $this->session->userdata('child2_age1');
		$child2_age2 = $this->session->userdata('child2_age2');
		
		$child3_age1 = $this->session->userdata('child3_age1');
		$child3_age2 = $this->session->userdata('child3_age2');
		
		if($room_count == '1')
		{
			if($room_types == 'SGL')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types == 'DBL')
			{
				if($child_age1 != '' && $child_age2 != '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>
								<ChildAge>".$child_age2."</ChildAge>";
				}
				if($child_age1 != '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>";
				}
				if($child_age1 == '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types == 'TWN')
			{
				if($child_age1 != '' && $child_age2 != '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>
								<ChildAge>".$child_age2."</ChildAge>";
				}
				if($child_age1 != '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>";
				}
				if($child_age1 == '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types == 'TPL')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types == 'QDR')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types == 'DBLSGL')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
		}
		else if($room_count == '2')
		{
			if($room_types == 'SGL')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types == 'DBL')
			{
				if($child_age1 != '' && $child_age2 != '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>
								<ChildAge>".$child_age2."</ChildAge>";
				}
				if($child_age1 != '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>";
				}
				if($child_age1 == '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types == 'TWN')
			{
				if($child_age1 != '' && $child_age2 != '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>
								<ChildAge>".$child_age2."</ChildAge>";
				}
				if($child_age1 != '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>";
				}
				if($child_age1 == '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types == 'TPL')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types == 'QDR')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types == 'DBLSGL')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			
			if($room_types2 == 'SGL')
			{
				$rooms2 = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types2 == 'DBL')
			{
				if($child2_age1 != '' && $child2_age2 != '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>
								<ChildAge>".$child2_age1."</ChildAge>
								<ChildAge>".$child2_age2."</ChildAge>";
				}
				if($child2_age1 != '' && $child2_age2 == '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>
								<ChildAge>".$child2_age1."</ChildAge>";
				}
				if($child2_age1 == '' && $child2_age2 == '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types2 == 'TWN')
			{
				if($child2_age1 != '' && $child2_age2 != '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>
								<ChildAge>".$child2_age1."</ChildAge>
								<ChildAge>".$child2_age2."</ChildAge>";
				}
				if($child2_age1 != '' && $child2_age2 == '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>
								<ChildAge>".$child2_age1."</ChildAge>";
				}
				if($child2_age1 == '' && $child2_age2 == '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types2 == 'TPL')
			{
				$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>";
			}
			if($room_types2 == 'QDR')
			{
				$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>";
			}
			if($room_types2 == 'DBLSGL')
			{
				$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>";
			}
		}
		
		else if($room_count == '3')
		{
			if($room_types == 'SGL')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types == 'DBL')
			{
				if($child_age1 != '' && $child_age2 != '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>
								<ChildAge>".$child_age2."</ChildAge>";
				}
				if($child_age1 != '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>";
				}
				if($child_age1 == '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types == 'TWN')
			{
				if($child_age1 != '' && $child_age2 != '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>
								<ChildAge>".$child_age2."</ChildAge>";
				}
				if($child_age1 != '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1'/>
								<ChildAge>".$child_age1."</ChildAge>";
				}
				if($child_age1 == '' && $child_age2 == '')
				{
					$rooms = "<Room Type='".$room_types."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types == 'TPL')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types == 'QDR')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types == 'DBLSGL')
			{
				$rooms = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			
			if($room_types2 == 'SGL')
			{
				$rooms2 = "<Room Type='".$room_types."' RoomCount='1'/>";
			}
			if($room_types2 == 'DBL')
			{
				if($child2_age1 != '' && $child2_age2 != '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>
								<ChildAge>".$child2_age1."</ChildAge>
								<ChildAge>".$child2_age2."</ChildAge>";
				}
				if($child2_age1 != '' && $child2_age2 == '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>
								<ChildAge>".$child2_age1."</ChildAge>";
				}
				if($child2_age1 == '' && $child2_age2 == '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types2 == 'TWN')
			{
				if($child2_age1 != '' && $child2_age2 != '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>
								<ChildAge>".$child2_age1."</ChildAge>
								<ChildAge>".$child2_age2."</ChildAge>";
				}
				if($child2_age1 != '' && $child2_age2 == '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>
								<ChildAge>".$child2_age1."</ChildAge>";
				}
				if($child2_age1 == '' && $child2_age2 == '')
				{
					$rooms2 = "<Room Type='".$room_types2."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types2 == 'TPL')
			{
				$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>";
			}
			if($room_types2 == 'QDR')
			{
				$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>";
			}
			if($room_types2 == 'DBLSGL')
			{
				$rooms2 = "<Room Type='".$room_types2."' RoomCount='1'/>";
			}
			
			if($room_types3 == 'SGL')
			{
				$rooms3 = "<Room Type='".$room_types3."' RoomCount='1'/>";
			}
			if($room_types3 == 'DBL')
			{
				if($child3_age1 != '' && $child3_age2 != '')
				{
					$rooms3 = "<Room Type='".$room_types3."' RoomCount='1'/>
								<ChildAge>".$child3_age1."</ChildAge>
								<ChildAge>".$child3_age2."</ChildAge>";
				}
				if($child3_age1 != '' && $child3_age2 == '')
				{
					$rooms3 = "<Room Type='".$room_types3."' RoomCount='1'/>
								<ChildAge>".$child3_age1."</ChildAge>";
				}
				if($child3_age1 == '' && $child3_age2 == '')
				{
					$rooms3 = "<Room Type='".$room_types3."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types3 == 'TWN')
			{
				if($child3_age1 != '' && $child3_age2 != '')
				{
					$rooms3 = "<Room Type='".$room_types3."' RoomCount='1'/>
								<ChildAge>".$child3_age1."</ChildAge>
								<ChildAge>".$child3_age2."</ChildAge>";
				}
				if($child3_age1 != '' && $child3_age2 == '')
				{
					$rooms3 = "<Room Type='".$room_types3."' RoomCount='1'/>
								<ChildAge>".$child3_age1."</ChildAge>";
				}
				if($child3_age1 == '' && $child3_age2 == '')
				{
					$rooms3 = "<Room Type='".$room_types3."' RoomCount='1' CotCount='1' />";
				}
			}
			if($room_types3 == 'TPL')
			{
				$rooms3 = "<Room Type='".$room_types3."' RoomCount='1'/>";
			}
			if($room_types3 == 'QDR')
			{
				$rooms3 = "<Room Type='".$room_types3."' RoomCount='1'/>";
			}
			if($room_types3 == 'DBLSGL')
			{
				$rooms3 = "<Room Type='".$room_types3."' RoomCount='1'/>";
			}
		}
		else
		{
			$room2 = '';
			$room3 = '';
		}
		
		$api_name = 'goglobal';
		if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.108')
		{
			$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
			//$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
		}
		else
		{
			$url = 'http://xml.goglobal.travel/XMLWebService.asmx?WSDL';
			//$url = 'http://xml.qa.goglobal.travel/XMLWebService.asmx?WSDL';
		}
		try {
			 $options = array(
			  'soap_version' => SOAP_1_1,
			  'exceptions' => true,
			  'trace'   => 1,
			  'cache_wsdl' => WSDL_CACHE_NONE,
			  "Content-Type: text/json; charset=UTF-8",
				"Content-Encoding: UTF-8",
				"Accept: application/xml",
				"Accept-Encoding: gzip"
			 );
			 $soapclient = new SoapClient($url, $options);
			} catch(Exception $e) {
			 echo "<h2>Exception Error!</h2>";
			 echo $e->getMessage();
			}
			// echo $room_types; exit;
			if($room_count =='1')
			{
				$room_tag = "<Rooms>
							".$rooms."
					</Rooms>";
			}
			else if($room_count =='2')
			{
				$room_tag = "<Rooms>
							".$rooms."
							".$rooms2."
					</Rooms>";
			}
			else if($room_count =='3')
			{
				$room_tag = "<Rooms>
							".$rooms."
							".$rooms2."
							".$rooms3."
					</Rooms>";
			}
			if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.108')
			{
				$agency = '1521228';
				$user = 'TRVLMRTXML';
				$password = 'SLA2WLEP';
				/*$agency = '37398';
				$user = 'TRAVELLINGMARTXML';
				$password = 'SAYADMANAMAH';*/
				
			}
			else
			{
				$agency = '37398';
				$user = 'TRAVELLINGMARTXML';
				$password = 'SAYADMANAMAH';
				/*$agency = '1521228';
				$user = 'TRVLMRTXML';
				$password = 'SLA2WLEP';*/
			}
			if($hotel_name == 'Enter Hotel Name')
			{
				$hotel_name = '';
			}
			else
			{
				$hotel_name = $hotel_name;
			}
			try {
			 $param=array ("requestType"=>"1","xmlRequest"=>"<Root>
				<Header>
					<Agency>".$agency."</Agency>
					<User>".$user."</User>
					<Password>".$password."</Password>
					<Operation>HOTEL_SEARCH_REQUEST</Operation>
					<OperationType>Request</OperationType>
				</Header>
				<Main>
					<HotelName>".$hotel_name."</HotelName>
					<CityCode>".$city_code."</CityCode>
					<ArrivalDate>".$start_date."</ArrivalDate>
					<Nights>".$nights."</Nights>
					".$room_tag."
				</Main>
			</Root>");
		   	//print_r($param);    exit;
			 $result = $soapclient->MakeRequest($param);
			} catch(Exception $e) {
			 //echo "Caught exception : ", $e->getMessage, "\n";
			 redirect('home/hotel_search','refresh');
			}
			 
			//echo "<pre>";
			//print_r($result); exit;
			$arr = (array) $result;
			//echo "<pre>";
			//print_r($arr); exit;
			$array = $this->xml2array($arr['MakeRequestResult']);
			//echo "<pre>"; print_r($array);  exit;
			if(isset($array['Root']['Header']))
			{
				$headr = $array['Root']['Header'];
				$Agency = $headr['Agency']['value'];
				$User = $headr['User']['value'];
				$Password = $headr['Password']['value'];
				$Operation = $headr['Operation']['value'];
				$OperationType = $headr['OperationType']['value'];
				//$ResultsQty = $headr['Statistics']['ResultsQty']['value'];
			}
			if(isset($array['Root']['Main']['Error']['value']))
			{
				redirect('home/hotel_search','refresh');
			}
			else
			{
				if(isset($array['Root']['Main']['Hotel'][0]))
				{
					$Hotel = $array['Root']['Main']['Hotel'];
					foreach($Hotel as $hotl)
					{
						if(isset($hotl['HotelSearchCode']['value']))
						{
							$HotelSearchCode = $hotl['HotelSearchCode']['value'];
						}
						else
						{
							$HotelSearchCode = '';
						}
						if(isset($hotl['HotelCode']['value']))
						{
							$HotelCode = $hotl['HotelCode']['value'];
						}
						else
						{
							$HotelCode = '';
						}
						if(isset($hotl['HotelName']['value']))
						{
							$HotelName = $hotl['HotelName']['value'];
						}
						else
						{
							$HotelName = '';
						}
						if(isset($hotl['CountryId']['value']))
						{
							$CountryId = $hotl['CountryId']['value'];
						}
						else
						{
							$CountryId = '';
						}
						if(isset($hotl['CxlDeadline']['value']))
						{
							$CxlDeadline = $hotl['CxlDeadline']['value'];
						}
						else
						{
							$CxlDeadline = '';
						}
						if(isset($hotl['RoomType']['value']))
						{
							$RoomType = $hotl['RoomType']['value'];
						}
						else
						{
							$RoomType = '';
						}
						if(isset($hotl['RoomBasis']['value']))
						{
							$RoomBasis = $hotl['RoomBasis']['value'];
						}
						else
						{
							$RoomBasis = '';
						}
						if(isset($hotl['Availability']['value']))
						{
							$Availability = $hotl['Availability']['value'];
						}
						else
						{
							$Availability = '';
						}
						if(isset($hotl['TotalPrice']['value']))
						{
							$TotalPrice = $hotl['TotalPrice']['value'];
						}
						else
						{
							$TotalPrice = '';
						}
						if(isset($hotl['Currency']['value']))
						{
							$Currency = $hotl['Currency']['value'];
						}
						else
						{
							$Currency = '';
						}
						if(isset($hotl['Category']['value']))
						{
							$Category = $hotl['Category']['value'];
						}
						else
						{
							$Category = '';
						}
						if(isset($hotl['Location']['value']))
						{
							$Location = $hotl['Location']['value'];
						}
						else
						{
							$Location = '';
						}
						if(isset($hotl['LocationCode']['value']))
						{
							$LocationCode = $hotl['LocationCode']['value'];
						}
						else
						{
							$LocationCode = '';
						}
						if(isset($hotl['Preferred']['value']))
						{
							$Preferred = $hotl['Preferred']['value'];
						}
						else
						{
							$Preferred = '';
						}
						if(isset($hotl['Remark']['value']))
						{
							$Remark = $hotl['Remark']['value'];
						}
						else
						{
							$Remark = '';
						}
						if(isset($hotl['Thumbnail']['value']))
						{
							$Thumbnail = $hotl['Thumbnail']['value'];
						}
						else
						{
							$Thumbnail = '';
						}
						if(isset($hotl['TripAdvisor']['Rating']['value']))
						{
							$TripAdvisor = $hotl['TripAdvisor'];
							if(isset($TripAdvisor['Rating']['value']) && $TripAdvisor['Rating']['value'] != '')
							{
								$Rating = $TripAdvisor['Rating']['value'];
							}
							else
							{
								$Rating = '';
							}
							if(isset($TripAdvisor['RatingImage']['value']) && $TripAdvisor['RatingImage']['value'] != '')
							{
								$RatingImage = $TripAdvisor['RatingImage']['value'];
							}
							else
							{
								$RatingImage = '';
							}
							if(isset($TripAdvisor['ReviewCount']['value']) && $TripAdvisor['ReviewCount']['value'] != '')
							{
								$ReviewCount = $TripAdvisor['ReviewCount']['value'];
							}
							else
							{
								$ReviewCount = '';
							}
							if(isset($TripAdvisor['Reviews']['value']) && $TripAdvisor['Reviews']['value'] != '')
							{
								$Reviews = $TripAdvisor['Reviews']['value'];
							}
							else
							{
								$Reviews = '';
							}
						}
						else
						{
							$Rating = '';
							$RatingImage = '';
							$ReviewCount = '';
							$Reviews = '';
						}
						/*$url = "http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency=".$Currency."&ToCurrency=USD";  
						$options = array(
							CURLOPT_RETURNTRANSFER => true, // return web page
									CURLOPT_HEADER         => false,// don't return headers
									CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
							);
							$ch = curl_init($url);
							curl_setopt_array( $ch, $options );
							$amtcon = curl_exec( $ch ); //let's fetch the result using cURL
							//echo $amtcon;
							curl_close( $ch );
							$array = $this->xml2array($amtcon);
							if(isset($array['double']['value']))
							{
								$new_cost = $array['double']['value'];
							}
							else
							{
								$new_cost = '';
							}
							$TotalPrice = $new_cost * $TotalPrice;*/
						$markup = $this->Home_Model->get_markup();
						if($markup != '')
						{
							if($markup->hotel_type == 'fixed')
							{
								$makup_hotel = $markup->hotel;
							}
							else
							{
								$makup_hotel = (($TotalPrice * $markup->hotel)/100);
							}
							if($markup->gateway_type == 'fixed')
							{
								$payment_gateway_m = $markup->payment_gateway;
							}
							else
							{
								$payment_gateway_m = (($TotalPrice * $markup->payment_gateway)/100);
							}
							$TotalPrice = $TotalPrice + $makup_hotel + $payment_gateway_m; 
						}
						else
						{
							$TotalPrice = $TotalPrice;
						}
						//echo $payment_gateway_m; 
						$Currency1 = 'USD';
						$this->Home_Model->insert_global_hotels($api_name,$sec_res,$city_code,$HotelSearchCode,$HotelCode,$HotelName,$CountryId,$CxlDeadline,$RoomType,$RoomBasis,$Availability,$TotalPrice,$Currency1,$Category,$Location,$LocationCode,$Preferred,$Remark,$Thumbnail,$Rating,$RatingImage,$ReviewCount,$Reviews);
					}
				}
				else
				{
					$hotl = $array['Root']['Main']['Hotel'];
					if(isset($hotl['HotelSearchCode']['value']))
					{
						$HotelSearchCode = $hotl['HotelSearchCode']['value'];
					}
					else
					{
						$HotelSearchCode = '';
					}
					if(isset($hotl['HotelCode']['value']))
					{
						$HotelCode = $hotl['HotelCode']['value'];
					}
					else
					{
						$HotelCode = '';
					}
					if(isset($hotl['HotelName']['value']))
					{
						$HotelName = $hotl['HotelName']['value'];
					}
					else
					{
						$HotelName = '';
					}
					if(isset($hotl['CountryId']['value']))
					{
						$CountryId = $hotl['CountryId']['value'];
					}
					else
					{
						$CountryId = '';
					}
					if(isset($hotl['CxlDeadline']['value']))
					{
						$CxlDeadline = $hotl['CxlDeadline']['value'];
					}
					else
					{
						$CxlDeadline = '';
					}
					if(isset($hotl['RoomType']['value']))
					{
						$RoomType = $hotl['RoomType']['value'];
					}
					else
					{
						$RoomType = '';
					}
					if(isset($hotl['RoomBasis']['value']))
					{
						$RoomBasis = $hotl['RoomBasis']['value'];
					}
					else
					{
						$RoomBasis = '';
					}
					if(isset($hotl['Availability']['value']))
					{
						$Availability = $hotl['Availability']['value'];
					}
					else
					{
						$Availability = '';
					}
					if(isset($hotl['TotalPrice']['value']))
					{
						$TotalPrice = $hotl['TotalPrice']['value'];
					}
					else
					{
						$TotalPrice = '';
					}
					if(isset($hotl['Currency']['value']))
					{
						$Currency = $hotl['Currency']['value'];
					}
					else
					{
						$Currency = '';
					}
					if(isset($hotl['Category']['value']))
					{
						$Category = $hotl['Category']['value'];
					}
					else
					{
						$Category = '';
					}
					if(isset($hotl['Location']['value']))
					{
						$Location = $hotl['Location']['value'];
					}
					else
					{
						$Location = '';
					}
					if(isset($hotl['LocationCode']['value']))
					{
						$LocationCode = $hotl['LocationCode']['value'];
					}
					else
					{
						$LocationCode = '';
					}
					if(isset($hotl['Preferred']['value']))
					{
						$Preferred = $hotl['Preferred']['value'];
					}
					else
					{
						$Preferred = '';
					}
					if(isset($hotl['Remark']['value']))
					{
						$Remark = $hotl['Remark']['value'];
					}
					else
					{
						$Remark = '';
					}
					if(isset($hotl['Thumbnail']['value']))
					{
						$Thumbnail = $hotl['Thumbnail']['value'];
					}
					else
					{
						$Thumbnail = '';
					}
					if(isset($hotl['TripAdvisor']))
					{
						$TripAdvisor = $hotl['TripAdvisor'];
						if(isset($TripAdvisor['Rating']['value']) && $TripAdvisor['Rating']['value'] != '')
						{
							$Rating = $TripAdvisor['Rating']['value'];
						}
						else
						{
							$Rating = '';
						}
						if(isset($TripAdvisor['RatingImage']['value']) && $TripAdvisor['RatingImage']['value'] != '')
						{
							$RatingImage = $TripAdvisor['RatingImage']['value'];
						}
						else
						{
							$RatingImage = '';
						}
						if(isset($TripAdvisor['ReviewCount']['value']) && $TripAdvisor['ReviewCount']['value'] != '')
						{
							$ReviewCount = $TripAdvisor['ReviewCount']['value'];
						}
						else
						{
							$ReviewCount = '';
						}
						if(isset($TripAdvisor['Reviews']['value']) && $TripAdvisor['Reviews']['value'] != '')
						{
							$Reviews = $TripAdvisor['Reviews']['value'];
						}
						else
						{
							$Reviews = '';
						}
					}
					/*$url = "http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency=".$Currency."&ToCurrency=USD";  
						$options = array(
							CURLOPT_RETURNTRANSFER => true, // return web page
									CURLOPT_HEADER         => false,// don't return headers
									CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
							);
							$ch = curl_init($url);
							curl_setopt_array( $ch, $options );
							$amtcon = curl_exec( $ch ); //let's fetch the result using cURL
							//echo $amtcon;
							curl_close( $ch );
							$array = $this->xml2array($amtcon);
							if(isset($array['double']['value']))
							{
								$new_cost = $array['double']['value'];
							}
							else
							{
								$new_cost = '';
							}
							$TotalPrice = $new_cost * $TotalPrice;*/
					$markup = $this->Home_Model->get_markup();
					if($markup != '')
					{
						if($markup->hotel_type == 'fixed')
						{
							$makup_hotel = $markup->hotel;
						}
						else
						{
							$makup_hotel = (($TotalPrice * $markup->hotel)/100);
						}
						if($markup->gateway_type == 'fixed')
						{
							$payment_gateway_m = $markup->payment_gateway;
						}
						else
						{
							$payment_gateway_m = (($TotalPrice * $markup->payment_gateway)/100);
						}
						$TotalPrice = $TotalPrice + $makup_hotel + $payment_gateway_m; 
					}
					else
					{
						$TotalPrice = $TotalPrice;
					}
					 //echo $payment_gateway_m." - ".($TotalPrice-$payment_gateway_m);
					 $Currency1 = 'USD';
					$this->Home_Model->insert_global_hotels($api_name,$sec_res,$city_code,$HotelSearchCode,$HotelCode,$HotelName,$CountryId,$CxlDeadline,$RoomType,$RoomBasis,$Availability,$TotalPrice,$Currency1,$Category,$Location,$LocationCode,$Preferred,$Remark,$Thumbnail,$Rating,$RatingImage,$ReviewCount,$Reviews);
					
				}
			}
			//exit;//echo "<pre>"; print_r($array); exit;
			//redirect('home/hotel_search','refresh');
	}
	
	function crs_availability($cin,$cout,$days,$sec_res,$adult_count)
	{
		header('Cache-Control: max-age=900');
		$cin=$this->session->userdata('cin1');
		$cin1 = explode('/',$cin);
		$cin = $cin1['2'].'-'.$cin1[1].'-'.$cin1[0];
	 	$cout=$this->session->userdata('cout1');
		$cout1 = explode('/',$cout);
		$cout = $cout1['2'].'-'.$cout1[1].'-'.$cout1[0];
  		$city=$this->session->userdata('citycode');
		$countrycode=$this->session->userdata('countrycode');
		if($cin)
		{
			$resultdb = $this->Home_Model->crs_availability($cin,$cout,$city,$adult_count,$days);
		}
		else
		{
			$resultdb = $this->Home_Model->crs_availability_without_dates($city);
		}
			//echo "<pre>"; print_r($resultdb);exit;
			if($resultdb!='')
			{
				if($cin == '')
				{
					//echo "aannd";exit;
					for($i=0;$i < count($resultdb); $i++)
					{
						$cntry_name = $this->Home_Model->get_cntryname($resultdb[$i]->country_id);
						$cityCode = $resultdb[$i]->city;
						$apt_id=$resultdb[$i]->apartment_id;
						$itemCode=$resultdb[$i]->apartment_id;
						$itemVal=$resultdb[$i]->apartment_name;
						$district_id=$resultdb[$i]->district_id;
						$class_type = $this->Home_Model->get_class_type_id($resultdb[$i]->sup_apart_list_id);
						$capacity = '';
						$starVal='';
						$roomDesc='';
						$roomDesc = substr($roomDesc, 0, -1); 
						$roomdescCode = '';
						$ConfirmationVal = '';
						$image='';
						$desc ='';
						$breakfast = '';
						$status = '';
						$charge_nights = '';
						$images = $this->Home_Model->get_images($resultdb[$i]->sup_apart_list_id);
						if($images != '')
						{
							if($images->added_by == 1)
							{
								$image = WEB_DIR_ADMIN.'uploadimage/'.$images->image_name;
							}
							else
							{
								$image = WEB_DIR.'uploadimage/'.$images->image_name;
							}
						}
						$pernight=0;
						$currencyVal = 'HDK';
						$curtype='HDK';
						$dateFromValc = '';
						$dateToValc = '';  	  
						$dateFromTimeValc = '';  	  
						$dateToTimeVal = ''; 
						$serviceval = '';
						$finalcurval ='';
						$cancelCodeVal='';
						$purTokenVal='';
						$roomDesc11 = $roomDesc;
						$min_cost = $this->Home_Model->get_min_cost($resultdb[$i]->sup_apart_list_id);
						//echo $min_cost;exit;
						$pernight11 = $min_cost;
						$hotel_mark=0;
						$admark=0;
						$tot_cost = '';
						$api4="gta";
						$tot_cost_state = '';
						$tot_cost_city = '';
						$tot_cost_vat ='';
						$tot_cost_room ='';
						$tot_cost_service ='';
						$common_commission_id=$this->Home_Model->get_common_markup($resultdb[$i]->user_id);
						$night = 1;
						$nightval = $pernight11*$night;
						//$cost = $pernight11*$adult_count*$night;
						$cost = $pernight11*$night;
						$pppn = $pernight11;
						$ppps = $pernight11*$night;
						$prpn = $pernight11;
						$prps = $pernight11*$night;
						$tot_cost_val = '';
						$can_time = '';
						$can_cost = '';
						$currency = $this->Home_Model->get_cur($resultdb[$i]->sup_apart_list_id);
						$star_rate = $this->Home_Model->get_starrate($resultdb[$i]->sup_apart_list_id);
						$address = $this->Home_Model->get_address($resultdb[$i]->sup_apart_list_id);
						$taxes = $this->Home_Model->get_taxes($resultdb[$i]->sup_apart_list_id);
						if($tot_cost_state || $tot_cost_city || $tot_cost_room || $tot_cost_vat || $tot_cost_service)
						{
							$tot_cost = $tot_cost_state + $tot_cost_city + $tot_cost_room + $tot_cost_vat + $tot_cost_service;
						}
						else
						{
							$tot_cost = $cost;
						}
						//echo $tot_cost;exit;
						if($tot_cost != '')
							{
								$comm_val = $this->Home_Model->get_comm_val($common_commission_id);
									$comm = '';
								if($comm_val != '')
								{
									
									if($comm_val->type == 1)
									{
										$comm = $comm_val->value;
										$tot_cost_val =  $comm + $tot_cost;
									}
									else
									{//	echo "anand";exit;
										$comm = $comm_val->value*$tot_cost/100;
										$tot_cost_val = $tot_cost + $comm;
									}
								}
								else
								{
									$tot_cost_val = $tot_cost;
								}
								$can = '';
								//echo $tot_cost_val;exit;
								//$can = $this->Home_Model->can($resultdb[$i]->sup_apart_rateplan_id);
								//echo "<pre>"; print_r($ca);exit;
								if($can != '')
								{
									$breakfast = $can->breakfast;
									if($can->policy_flag == 1)
									{
										$can_time = $can->hours1;
									}
									else if($can->policy_flag == 2)
									{
										$can_time = $can->hours1;
									}	
									else if($can->policy_flag == 3)
									{
										$can_time = 0;
									}
									if($can->charges == 1)
									{
										if($can->charge_nights == '1 night')
										{
											$can_cost = ($tot_cost_val * $can->charge_persent)/100;
											//$can_cost = $can_cost * $this->session->userdata('dt');
										}
										else
										{
											$can_cost = ($tot_cost_val * $can->charge_persent)/100;
										//$sup_can_cnt = explode(' ',$can->charge_nights);
									//$can_cost = ($can_cost)/($sup_can_cnt[0]);
									//$can_cost = $can_cost * $this->session->userdata('dt');									
										}
									}
									else if($can->charges == 2)
									{
										if($can->charge_nights == '1 night')
										{
											$can_cost = $can->charge_price;
											//$can_cost = $can_cost * $this->session->userdata('dt');
										}
										else
										{
											$can_cost = $can->charge_price;
									//$sup_can_cnt = explode(' ',$can->charge_nights);
									//$can_cost = $can_cost/$sup_can_cnt[0];
									//$can_cost = $can_cost * $this->session->userdata('dt');	
										}
									}
								}
						
							if($can != '')
							{
								$charge_nights = $can->charge_nights;
							}
							$apt_fac = $this->Home_Model->get_apt_fac($resultdb[$i]->sup_apart_list_id);
							$fac = '';
							$roomfac1 = '';
							if($apt_fac!='')
							{
								foreach($apt_fac as $row)
								{
									$fac .= $row->sup_apart_facilities_list_id.',';
								}
							}
							$fac1 = substr($fac,0,-1);
							$cat_num = '';
							$rate_plan = '';
							$unit_name = '';
							$roomfac = '';
							if($roomfac!='')
							{
								foreach($roomfac as $res)
								{
									$roomfac1 .= $res->sup_apart_roomfacilities_list_id.',';
								}
							}
							$roomfac1 = substr($roomfac1,0,-1);
							$api='crs';
							$mealsval='';
							
							$this->Home_Model->insert_search_result_crs($api,$city,$cntry_name,$resultdb[$i]->sup_apart_list_id,$itemVal,$star_rate,$pernight11,$tot_cost_val,$unit_name,$rate_plan,$breakfast,$adult_count,$address->address,$this->session->userdata('sec_res'),$cin,$cout,$image,$night,$fac1,$roomfac1,$address->latitude,$address->longitude,$common_commission_id,$cat_num,$status,$comm,$capacity,$currency,$can_cost,$charge_nights,$can_time,$district_id,$class_type);
							}
						
					}
				}
				else
				{
					for($i=0;$i < count($resultdb); $i++)
					{
						if($resultdb[$i]->block_arrival == 0 && $resultdb[$i]->block_departure == 0)
						{
	
							$cntry_name = $this->Home_Model->get_cntryname($resultdb[$i]->country_id);
							$cityCode = $resultdb[$i]->city;
							$apt_id=$resultdb[$i]->apartment_id;
							$itemCode=$resultdb[$i]->apartment_id;
							$itemVal=$resultdb[$i]->apartment_name;
							$capacity = $resultdb[$i]->capacity;
							$district_id=$resultdb[$i]->district_id;
							$class_type = $this->Home_Model->get_class_type_id($resultdb[$i]->sup_apart_list_id);
							$starVal='';
							$roomDesc='';
							$roomDesc = substr($roomDesc, 0, -1); 
							$roomdescCode = '';
							$ConfirmationVal = $this->Home_Model->get_status($resultdb[$i]->sup_apart_maintain_month_id);
							$image='';
							$desc ='';
							$images = $this->Home_Model->get_images($resultdb[$i]->sup_apart_list_id);
							if($images != '')
						{
							if($images->added_by == 1)
							{
								$image = WEB_DIR_ADMIN.'uploadimage/'.$images->image_name;
							}
							else
							{
								$image = WEB_DIR.'uploadimage/'.$images->image_name;
							}
						}
							$pernight=0;
							$currencyVal = 'HDK';
							$curtype='HDK';
							$dateFromValc = '';
							$dateToValc = '';  	  
							$dateFromTimeValc = '';  	  
							$dateToTimeVal = ''; 
							$serviceval = '';
							$finalcurval ='';
							$cancelCodeVal='';
							$purTokenVal='';
							$roomDesc11 = $roomDesc;
							$pernight11 = $resultdb[$i]->rate;
							$hotel_mark=0;
							$admark=0;
							$tot_cost = '';
							$api4="gta";
							$tot_cost_state = '';
							$tot_cost_city = '';
							$tot_cost_vat ='';
							$tot_cost_room ='';
							$tot_cost_service ='';
							$common_commission_id=$this->Home_Model->get_common_markup($resultdb[$i]->user_id);
							//$common_commission_id= '';
							$night=$this->session->userdata('dt');	 
							$nightval = $pernight11*$night;
							//$cost = $pernight11*$adult_count*$night;
							//echo $night;exit;
							if($night >1)
							{
								$cost = $this->Home_Model->get_individual_dates_avail($resultdb[$i]->sup_apart_rateplan_id,$night,$adult_count,$cin);
							}
							
							else
							{
								$cost = $pernight11*$night;
							}
							//echo $cost;exit;
							
							$pppn = $pernight11;
							$ppps = $pernight11*$night;
							$prpn = $pernight11;
							$prps = $pernight11*$night;
							$tot_cost_val = '';
							$can_time = '';
							$can_cost = '';
							$currency = $this->Home_Model->get_cur($resultdb[$i]->sup_apart_list_id);
							$star_rate = $this->Home_Model->get_starrate($resultdb[$i]->sup_apart_list_id);
							$address = $this->Home_Model->get_address($resultdb[$i]->sup_apart_list_id);
							$taxes = $this->Home_Model->get_taxes($resultdb[$i]->sup_apart_list_id);
							/*if($currency != 'USD')
							{
								$url = "http://www.google.com/ig/calculator?hl=en&q=".$cost.$currency."=?USD";
								$options = array(
								CURLOPT_RETURNTRANSFER => true, // return web page
							CURLOPT_HEADER         => false,// don't return headers
							CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
							);
							$ch = curl_init($url);
							curl_setopt_array( $ch, $options );
							$amtcon = curl_exec( $ch ); //let's fetch the result using cURL
							curl_close( $ch );
							if( $amtcon === FALSE )
								return $amtcon;
							$amtcon = explode('"',$amtcon);
							$amtcon = str_replace(chr(160), '', substr( $amtcon[3], 0, strpos($amtcon[3], ' ') ) );
							( $amtcon == 0 ) ? FALSE : $amtcon;
								 $cost = sprintf ("%.2f", $amtcon);
								$currency = 'USD';
							}*/
						if($tot_cost_state || $tot_cost_city || $tot_cost_room || $tot_cost_vat || $tot_cost_service)
						{
							$tot_cost = $tot_cost_state + $tot_cost_city + $tot_cost_room + $tot_cost_vat + $tot_cost_service;
						}
						else
						{
							$tot_cost = $cost;
						}
					//echo $tot_cost;exit;
							if($tot_cost != '')
							{
								$comm_val = $this->Home_Model->get_comm_val($common_commission_id);
									$comm = '';
								if($comm_val != '')
								{
									
									if($comm_val->type == 1)
									{
										$comm = $comm_val->value;
										$tot_cost_val =  $comm + $tot_cost;
									}
									else
									{//	echo "anand";exit;
										$comm = $comm_val->value*$tot_cost/100;
										$tot_cost_val = $tot_cost + $comm;
									}
								}
								else
								{
									$tot_cost_val = $tot_cost;
								}
								//echo $tot_cost_val;exit;
								$can = $this->Home_Model->can($resultdb[$i]->sup_apart_rateplan_id);
								if($can->policy_flag == 1)
								{
									//echo "<pre>"; print_r($can);exit;
								}
								if($can != '')
								{
									$breakfast = $can->breakfast;
									if($can->policy_flag == 1)
									{
										$can_time = $can->hours1;
									}
									else if($can->policy_flag == 2)
									{
										$can_time = $can->hours1;
									}	
									else if($can->policy_flag == 3)
									{
										$can_time = 0;
									}
									if($can->policy_flag == 1)
									{
										
										if($can->charge_nights == '1 night')
										{
											$can_cost = ($tot_cost_val * $can->charge_persent)/100;
											//$can_cost = $can_cost * $this->session->userdata('dt');
										}
										else
										{
											$can_cost = ($tot_cost_val * $can->charge_persent)/100;
										//$sup_can_cnt = explode(' ',$can->charge_nights);
									//$can_cost = ($can_cost)/($sup_can_cnt[0]);
									//$can_cost = $can_cost * $this->session->userdata('dt');									
										}
										//echo "anand";exit;
									}
									else if($can->policy_flag == 2)
									{
										if($can->charge_nights == '1 night')
										{
											$can_cost = $can->charge_price;
											//$can_cost = $can_cost * $this->session->userdata('dt');
										}
										else
										{
											$can_cost = $can->charge_price;
									//$sup_can_cnt = explode(' ',$can->charge_nights);
									//$can_cost = $can_cost/$sup_can_cnt[0];
									//$can_cost = $can_cost * $this->session->userdata('dt');	
										}
									}
								}
										
							$charge_nights = $can->charge_nights;
							$apt_fac = $this->Home_Model->get_apt_fac($resultdb[$i]->sup_apart_list_id);
							$fac = '';
							$roomfac1 = '';
							if($apt_fac!='')
							{
								foreach($apt_fac as $row)
								{
									$fac .= $row->sup_apart_facilities_list_id.',';
								}
							}
							$fac1 = substr($fac,0,-1);
							$cat_num = $this->Home_Model->get_cat($resultdb[$i]->sup_apart_rateplan_id);
							$rate_plan = $this->Home_Model->get_rate_plan($resultdb[$i]->sup_apart_rateplan_id);
							$unit_name = $this->Home_Model->get_unit_name($cat_num);
							$roomfac = $this->Home_Model->get_roomfac($cat_num,$resultdb[$i]->sup_apart_list_id);
							if($roomfac!='')
							{
								foreach($roomfac as $res)
								{
									$roomfac1 .= $res->sup_apart_roomfacilities_list_id.',';
								}
							}
							$roomfac1 = substr($roomfac1,0,-1);
							$api='crs';
							$mealsval='';
							if($resultdb[$i]->on_request == 1)
							{
								$status = 'OnRequest';
							}
							else
							{
								$status = 'Available';
							}
							//echo $tot_cost_val;exit;
							if($can_cost != '')
							{
								//echo $can_cost;exit;
							}
							if(strstr($tot_cost_val,','))
							{
								$tot_cost_val = str_replace(',','',$tot_cost_val);
							}
							//echo $currency;echo $tot_cost_val;exit;
							$this->Home_Model->insert_search_result_crs($api,$city,$cntry_name,$resultdb[$i]->sup_apart_list_id,$itemVal,$star_rate,$pernight11,$tot_cost_val,$unit_name,$rate_plan,$breakfast,$adult_count,$address->address,$this->session->userdata('sec_res'),$cin,$cout,$image,$night,$fac1,$roomfac1,$address->latitude,$address->longitude,$common_commission_id,$cat_num,$status,$comm,$capacity,$currency,$can_cost,$charge_nights,$can_time,$district_id,$class_type);
							}
						}
					}
				}
				
			 }
			redirect('home/hotel_search','refresh');
		 //exit;
		 
	}
	
	function load_package()
	{
		header('Cache-Control: max-age=900');
		if($this->input->post('hotel_city') != '')
		{
			$data['hotel_city'] = $hotel_city = $this->input->post('hotel_city');
			$city_div = explode(",",$hotel_city);
			$city = $city_div[0];
			$country = trim($city_div[1]);
			$city_code = $this->Hotel_Model->get_dest_Code($city,$country);
		}
		else
		{
			$data['hotel_city_domestic'] = $hotel_city_domestic = $this->input->post('hotel_city_domestic');
			$city_div_domestic = explode(",",$hotel_city_domestic);
			$city_domestic = $city_div_domestic[0];
			$country_domestic = trim($city_div_domestic[1]);
			$city_code_domestic = $this->Hotel_Model->get_dest_Code($city_domestic,$country_domestic);
		}
		if($sd_holi = $this->input->post('sd_hotel') != '')
		{
			$data['sd_holi'] = $sd_holi = $this->input->post('sd_hotel');
			$sd1 = explode("/",$sd_holi); 
			$sd = $sd1[2]."-".$sd1[1]."-".$sd1[0];
		}
		
		if( $this->input->post('ed_hotel') != '')
		{
			$data['ed_holi'] = $ed_holi = $this->input->post('ed_hotel');
			$ed1 = explode("/",$ed_holi); 
			$ed = $ed1[2]."-".$ed1[1]."-".$ed1[0];
		}
		
		if($this->input->post('adult') != '' )
		{
			$data['adult'] = $adult = $this->input->post('adult');
		}
		else
		{
			$data['adult_domestic'] = $adult_domestic = $this->input->post('adult_domestic');
		}
		if($this->input->post('child') != '' )
		{
			$data['child'] = $child = $this->input->post('child');
		}
		else
		{
			$data['child_domestic'] = $child_domestic = $this->input->post('child_domestic');
		}
		if($this->input->post('holiday_type') != '')
		{
			$data['holiday_type'] = $holiday_type = $this->input->post('holiday_type');
	 	}
		else
		{
			$data['holiday_type_domestic'] = $holiday_type_domestic = $this->input->post('holiday_type_domestic');
		}
		if($this->input->post('hotel_city') != '')
		{
			$this->session->set_userdata(array('hotel_city'=>$hotel_city, 'city_code'=>$city_code, 'city'=>$city, 'country'=>$country,'sd'=>$sd, 'ed'=>$ed,'adult'=>$adult, 'child'=>$child));
		}
		
		//echo "<pre>";print_r($this->session->userdata);exit;
		$this->load->view('holiday/load_holiday');
		
		//$this->load->view('holiday/load_holiday');
	}
	function holiday_search()
	{
		header('Cache-Control: max-age=900');
		$data['holiday_loc_city'] = "All";
		$data['radio'] = '0';
		$type = $this->session->userdata('holiday_type');
		$city = $this->session->userdata('city');
		$country = $this->session->userdata('country');
		$checkin = $this->session->userdata('sd');
		$checkout = $this->session->userdata('ed');
		$data['holi_res'] = $holi_res = $this->Home_Model->holiday_search_dom($type, $city, $checkin, $checkout);
			//echo "<pre>";print_r($holi_res);exit;
			
	
		$this->load->view('holiday/holiday_results',$data);
	}
	function confirm_price($ex_id)
	{
		header('Cache-Control: max-age=900');
		$data['ex_id'] = $ex_id;
		$data['holi_res'] = $holi_res = $this->Home_Model->holiday_confirm_price($ex_id);
		//echo "<pre>";print_r($holi_res);exit;
		$this->load->view('holiday/confirm_price',$data);
	}
	function xml2array($contents, $get_attributes=1)
		{
		
		/**
		* xml2array() will convert the given XML text to an array in the XML structure.
		* Link: http://www.bin-co.com/php/scripts/xml2array/
		* Arguments : $contents - The XML text
		* $get_attributes - 1 or 0. If this is 1 the function will get the attributes as well as the tag values - this results in a different 							array structure in the return value.
		* Return: The parsed XML in an array form.
		*/
		if(!$contents) return array();
		
		if(!function_exists('xml_parser_create')) 
		{
		//print "'xml_parser_create()' function not found!";
		return array();
		}
		//Get the XML parser of PHP - PHP must have this module for the parser to work
		$parser = xml_parser_create();
		xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
		xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
		xml_parse_into_struct( $parser, $contents, $xml_values );
		xml_parser_free( $parser );
		
		if(!$xml_values) return;//Hmm...
		
		// Initializations
		$xml_array = array();
		$parents = array();
		$opened_tags = array();
		$arr = array();
		
		$current = &$xml_array;
		
		//Go through the tags.
		foreach($xml_values as $data) {
		unset($attributes,$value);//Remove existing values, or there will be trouble
		
		//This command will extract these variables into the foreach scope
		// tag(string), type(string), level(int), attributes(array).
		extract($data);//We could use the array by itself, but this cooler.
		
		$result = '';
		if($get_attributes) {//The second argument of the function decides this.
		$result = array();
		if(isset($value)) $result['value'] = $value;
		
		// Set the attributes too.
		if(isset($attributes)) {
		foreach($attributes as $attr => $val) {
		if($get_attributes == 1) $result['attr'][$attr] = $val; // Set all the attributes in a array called 'attr'
		/** : TODO: should we change the key name to '_attr'? Someone may use the tagname 'attr'. Same goes for 'value' too */
		}
		}
		} elseif(isset($value)) {
		$result = $value;
		}
		
		// See tag status and do the needed.
		if($type == "open") { // The starting of the tag "
		$parent[$level-1] = &$current;
		
		if(!is_array($current) or (!in_array($tag, array_keys($current)))) { // Insert New tag
		$current[$tag] = $result;
		$current = &$current[$tag];
		
		} else { // There was another element with the same tag name
		if(isset($current[$tag][0])) {
		array_push($current[$tag], $result);
		} else {
		$current[$tag] = array($current[$tag],$result);
		}
		$last = count($current[$tag]) - 1;
		$current = &$current[$tag][$last];
		}
		
		} elseif($type == "complete") { // Tags that ends in 1 line "
		// See if the key is already taken.
		if(!isset($current[$tag])) { // New Key
		$current[$tag] = $result;
		
		} else { // If taken, put all things inside a list(array)
		if((is_array($current[$tag]) and $get_attributes == 0)//If it is already an array\85
		or (isset($current[$tag][0]) and is_array($current[$tag][0]) and $get_attributes == 1)) {
		array_push($current[$tag],$result); // \85push the new element into that array.
		} else { //If it is not an array\85
		$current[$tag] = array($current[$tag],$result); //\85Make it an array using using the existing value and the new value
		}
		}
		
		} elseif($type == 'close') { //End of tag "
		$current = &$parent[$level-1];
		}
		}
		
		return($xml_array);

	}
	function agent_login()
	{
		$data['flag'] ='7';
		$this->load->view('agent/partner',$data);
	}
	function newslterr()
	{
		echo $email = $this->input->post('email');
	}
	function football_tickets()
	{
		$data['all_football_events'] = $this->Home_Model->all_football_events();
		$data['all_football_events_all'] = $this->Home_Model->all_football_events_all();
		$this->load->view('football/footbal_home',$data);
	}
	function football_search()
	{
		$data['team'] = $this->input->post('team_name');
		$data['date_range'] = $this->input->post('date_range');
		$data['sd'] = $this->input->post('sd');
		$data['ed'] = $this->input->post('ed');
		$data['all_football_events'] = $this->Home_Model->all_football_events();
		$data['all_football_events_all'] = $this->Home_Model->all_football_events_all();
		$this->load->view('football/search_result',$data);
	}
	function football_event_det($id)
	{
		$data['event_det'] = $this->Home_Model->all_football_event_det($id);
		//$data['all_football_events_all'] = $this->Home_Model->all_football_events_all();
		$this->load->view('football/football_event_det',$data);
	}
	function football_tickets1()
	{
		$session = session_id();
		$date = date('Y-m-d');
		$check_football_inserted = $this->Home_Model->check_football_inserted($date);
		if($check_football_inserted == 1)
		{
			//redirect('home/football_tickets1','refresh');
		}
		else
		{
			$url = 'http://hotfootballtickets.com/affman/subaff/request?u=Travellingmart&p=tm123&r=events&t=1';
			$res = $this->get_data($url);
			$array =$this->xml2array($res);
			if(isset($array['response']['rates']))
			{
				$rates = $array['response']['rates'];
				if(isset($rates['USD']['value']))
				{
					$USD = $rates['USD']['value'];
				}
				if(isset($rates['EUR']['value']))
				{
					$EUR = $rates['EUR']['value'];
				}
				if(isset($rates['GBP']['value']))
				{
					$GBP = $rates['GBP']['value'];
				}
			}
			if(isset($array['response']['events']['event'][0]))
			{
				$event = $array['response']['events']['event'];
				foreach($event as $evnt)
				{
					if(isset($evnt['event_id']['value']))
					{
						$event_id = $evnt['event_id']['value'];
					}
					else
					{
						$event_id = '';
					}
					if(isset($evnt['event_type_id']['value']))
					{
						$event_type_id = $evnt['event_type_id']['value'];
					}
					else
					{
						$event_type_id = '';
					}
					if(isset($evnt['event_name']['value']))
					{
						$event_name = $evnt['event_name']['value'];
					}
					else
					{
						$event_name = '';
					}
					if(isset($evnt['event_place']['value']))
					{
						$event_place = $evnt['event_place']['value'];
					}
					else
					{
						$event_place = '';
					}
					if(isset($evnt['event_currency']['value']))
					{
						$event_currency = $evnt['event_currency']['value'];
					}
					else
					{
						$event_currency = '';
					}
					if(isset($evnt['event_date']['value']))
					{
						$event_date = $evnt['event_date']['value'];
					}
					else
					{
						$event_date = '';
					}
					if(isset($evnt['event_time']['value']))
					{
						$event_time = $evnt['event_time']['value'];
					}
					else
					{
						$event_time = '';
					}
					if(isset($evnt['handlingfee']['value']))
					{
						$handlingfee = $evnt['handlingfee']['value'];
					}
					else
					{
						$handlingfee = '';
					}
					if(isset($evnt['size_433x274']['value']))
					{
						$size_433x274 = $evnt['size_433x274']['value'];
					}
					else
					{
						$size_433x274 = '';
					}
					if(isset($evnt['home_team']['value']))
					{
						$home_team = $evnt['home_team']['value'];
					}
					else
					{
						$home_team = '';
					}
					if(isset($evnt['guest_team']['value']))
					{
						$guest_team = $evnt['guest_team']['value'];
					}
					else
					{
						$guest_team = '';
					}
					if(isset($evnt['city']['value']))
					{
						$city = $evnt['city']['value'];
					}
					else
					{
						$city = '';
					}
					if(isset($evnt['country']['value']))
					{
						$country = $evnt['country']['value'];
					}
					else
					{
						$country = '';
					}
					if(isset($evnt['tournament']['value']))
					{
						$tournament = $evnt['tournament']['value'];
					}
					else
					{
						$tournament = '';
					}
					if(isset($evnt['event_page']['value']))
					{
						$event_page = $evnt['event_page']['value'];
					}
					else
					{
						$event_page = '';
					}
					if(isset($evnt['event_text']['value']))
					{
						$event_text = $evnt['event_text']['value'];
					}
					else
					{
						$event_text = '';
					}
					//insert into first table
					$id = $this->Home_Model->insert_football_event($event_id,$event_type_id,$event_name,$event_place,$event_currency,$event_date,$event_time,$handlingfee,$size_433x274,$home_team,$guest_team,$city,$country,$tournament,$event_page,$event_text,$session);
					if(isset($evnt['tickets']['ticket'][0]))
					{
						$tickets = $evnt['tickets']['ticket'];
						foreach($tickets as $tkts)
						{
							if(isset($tkts['ticket_id']['value']))
							{
								$ticket_id = $tkts['ticket_id']['value'];
							}
							else
							{
								$ticket_id = '';
							}
							if(isset($tkts['ticket_price']['value']))
							{
								$ticket_price = $tkts['ticket_price']['value'];
							}
							else
							{
								$ticket_price = '';
							}
							if(isset($tkts['service_fee']['value']))
							{
								$service_fee = $tkts['service_fee']['value'];
							}
							else
							{
								$service_fee = '';
							}
							if(isset($tkts['category']['value']))
							{
								$category = $tkts['category']['value'];
							}
							else
							{
								$category = '';
							}
							//insert into second table
							$this->Home_Model->insert_football_tickets($id,$ticket_id,$ticket_price,$service_fee,$category,$session);
						}
					}
					else
					{
						$tkts = $evnt['tickets']['ticket'];
						if(isset($tkts['ticket_id']['value']))
						{
							$ticket_id = $tkts['ticket_id']['value'];
						}
						else
						{
							$ticket_id = '';
						}
						if(isset($tkts['ticket_price']['value']))
						{
							$ticket_price = $tkts['ticket_price']['value'];
						}
						else
						{
							$ticket_price = '';
						}
						if(isset($tkts['service_fee']['value']))
						{
							$service_fee = $tkts['service_fee']['value'];
						}
						else
						{
							$service_fee = '';
						}
						if(isset($tkts['category']['value']))
						{
							$category = $tkts['category']['value'];
						}
						else
						{
							$category = '';
						}
						//insert into second table
						$this->Home_Model->insert_football_tickets($id,$ticket_id,$ticket_price,$service_fee,$category,$session);
					}
				}
			}
			}
		redirect('home/football_tickets1','refresh');
	}
	function get_data($url) {
			  $ch = curl_init();
			  $timeout = 30;
			  curl_setopt($ch, CURLOPT_URL, $url);
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			  $data = curl_exec($ch);
			  curl_close($ch);
			  return $data; 
			}
	function car_result()
	{
		$this->load->view('car/vip_cars');
	}
	function football_results2()
	{
		$page = $this->input->post('page');
		$team = $this->input->post('team');
		$date_rnge = $this->input->post('date_rnge');
		$start_date = $this->input->post('start');
		$end_date = $this->input->post('end');
		$cur_page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		$data['result_pag_data'] = $result_pag_data = $this->Home_Model->get_football_results2($start,$per_page,$team,$date_rnge,$start_date,$end_date);
		//echo "<pre>"; print_r($result_pag_data); exit;
		$football_search_result  = $this->load->view('football/search_result_ajax',$data,true);
		$query_pag_num = $this->Home_Model->get_all_football_results2($team,$start_date,$end_date);
		$count = count($query_pag_num);
		$no_of_paginations = ceil($count / $per_page);
		$msg = $this->pagination_football($cur_page,$no_of_paginations);
		print json_encode(array(
			'football_search_result' => $football_search_result,
			'msg' => $msg
			));
				
	}
	function football_results()
	{
	header('Cache-Control: max-age=900');	
            $page = $this->input->post('page');
		$cur_page = $page;
		$page -= 1;
		$per_page = 10;
		$start = $page * $per_page;
		$data['result_pag_data'] = $result_pag_data = $this->Home_Model->get_football_results($start,$per_page);
		$football_search_result  = $this->load->view('football/search_result_ajax',$data,true);
		$query_pag_num = $this->Home_Model->get_all_football_results();
		$count = count($query_pag_num);
		$no_of_paginations = ceil($count / $per_page);
		$msg = $this->pagination_football($cur_page,$no_of_paginations);
		print json_encode(array(
			'football_search_result' => $football_search_result,
			'msg' => $msg
			));
				
	}
	function football_form($id,$tk_id,$currency)
	{
            header('Cache-Control: max-age=900');
		$quantity = $this->input->post('quantity');
		$ticket_id = $this->input->post('ticket_id');
		$data['event_det'] = $this->Home_Model->all_football_event_det($id);
                $data['tkt_det'] = $this->Home_Model->get_tktdet($tk_id);
                $data['id'] = $id;
                $data['tk_id'] = $tk_id;
                $data['currency'] = $currency;
		$this->load->view('football/football_form',$data);
	}
        function football_booking($id,$tk_id,$currency)
        {
            header('Cache-Control: max-age=900');
            $data['$id'] = $id;
            $quantity = $this->input->post('quantity');
            $title = $this->input->post('title');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $gender = $this->input->post('gender');
            $phone = $this->input->post('phone');
            $company_name = $this->input->post('company_name');
            $address = $this->input->post('address');
            $city = $this->input->post('city');
            $postcode = $this->input->post('postcode');
            $state = $this->input->post('state');
            $country = $this->input->post('country');
            $hotelname = $this->input->post('hotelname');
            $hotel_book_info = $this->input->post('hotel_book_info');
            $hotel_arriving_date = $this->input->post('hotel_arriving_date');
            $arriving_time = $this->input->post('arriving_time');
            $hotelphone = $this->input->post('hotelphone');
            //$data['event_det'] = $event_det = $this->Home_Model->all_football_event_det($id);
            //$data['tickets'] = $this->Home_Model->get_tickets($event_det->id);
            $data['tkt_det'] = $tks = $this->Home_Model->get_tktdet($tk_id);
            if($currency == 'GBP')
            {
                $ex_fee = 28;
            }
            if($currency == 'EUR')
            {
                $ex_fee = 30;
            }
            $data['tk_id'] = $tk_id;
            $amount = round($tks->ticket_price + $tks->service_fee + $ex_fee);
            $url = "http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency=".$currency."&ToCurrency=GBP";  
	    $options = array(
			CURLOPT_RETURNTRANSFER => true, // return web page
					CURLOPT_HEADER         => false,// don't return headers
					CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
			);
            $ch = curl_init($url);
            curl_setopt_array( $ch, $options );
            $amtcon = curl_exec( $ch ); //let's fetch the result using cURL
            //echo $amtcon;
            curl_close( $ch );
            $array = $this->xml2array($amtcon);
            if(isset($array['double']['value']))
            {
		$data['new_cost'] = $new_cost = $array['double']['value'];
            }
            else
            {
		$data['new_cost'] = $new_cost = '';
            }
            $data['amount'] = $amount = round($amount * $new_cost * 1000);
            $this->Home_Model->insert_foobal_booking($id,$tk_id,$currency,$quantity,$title,$first_name,$last_name,$gender,$phone,$company_name,$address,$city,$postcode,$state,$country,$hotelname,$hotel_book_info,$hotel_arriving_date,$arriving_time,$hotelphone,$amount);
            $this->session->set_userdata(array('quantity'=>$quantity,'f_amount'=>$amount,'title'=>$title,'first_name'=>$first_name,'last_name'=>$last_name,'gender'=>$gender,'phone'=>$phone,'company_name'=>$company_name,'address'=>$address,'city'=>$city,'postcode'=>$postcode,'state'=>$state,'country'=>$country,'hotelname'=>$hotelname,'hotel_book_info'=>$hotel_book_info,'hotel_arriving_date'=>$hotel_arriving_date,'arriving_time'=>$arriving_time,'hotelphone'=>$hotelphone,'f_currency'=>$currency));
            $this->load->view('football/load_payment_gateway',$data);
        }
        function footballbooking($id,$tk_id)
        {
            header('Cache-Control: max-age=900');
            $quantity = $this->session->userdata('quantity');
            $title = $this->session->userdata('title');
            $first_name = $this->session->userdata('first_name');
            $last_name = $this->session->userdata('last_name');
            $gender = $this->session->userdata('gender');
            $phone = $this->session->userdata('phone');
            $company_name = $this->session->userdata('company_name');
            $address = $this->session->userdata('address');
            $city = $this->session->userdata('city');
            $postcode = $this->session->userdata('postcode');
            $state = $this->session->userdata('state');
            $country = $this->session->userdata('country');
            $hotelname = $this->session->userdata('hotelname');
            $hotel_book_info = $this->session->userdata('hotel_book_info');
            $hotel_arriving_date = $this->session->userdata('hotel_arriving_date');
            $arriving_time = $this->session->userdata('arriving_time');
            $hotelphone = $this->session->userdata('hotelphone');
            $f_amount = $this->session->userdata('f_amount');
            $url = 'http://hotfootballtickets.com/affman/subaff/request?u=Travellingmart&p=tm123&r=order';
            /*$xml_instruction ='<?xml version="1.0" encoding="UTF-8"?>
                   <customer>             
                    <firstname>'.$first_name.'</firstname>
                    <lastname>'.$last_name.'</lastname>
                    <mail>email@emailserver.com</mail>
                    </customer>
                   <billing> 
		<firstname>'.$first_name.'</firstname>
		<lastname>'.$last_name.'</lastname>
		<gender>'.$gender.'</gender>
		<phone>'.$phone.'</phone>
		<company>'.$company_name.'</company>
		<address>'.$address.'</address>
		<city>'.$city.'</city>
		<postcode>'.$postcode.'</postcode>
		<state>'.$state.'</state>
		<country>'.$country.'</country>
                </billing>
                <shipping>
		<firstname>'.$first_name.'</firstname>
		<lastname>'.$last_name.'</lastname>
		<phone>'.$phone.'</phone>
		<company>'.$company_name.'</company>
		<address_type>Hotel</address_type>
		<address>'.$address.'</address>
		<city>'.$city.'</city>
		<postcode>'.$postcode.'</postcode>
		<state>'.$state.'</state>
		<country>'.$country.'</country>
		<hotel_name>'.$hotelname.'</hotel_name>
		<hotel_phone>'.$hotelphone.'</hotel_phone>
		<hotel_bookinfo>'.$hotel_book_info.'</hotel_bookinfo>
		<hotel_arriving_date>'.$hotel_arriving_date.'</hotel_arriving_date>
		</shipping>
                <events>
		<event id="'.$id.'">
			<ticket id="'.$tk_id.'" qty="'.$quantity.'" unit_price="'.$f_amount.'" />
		</event>
	</events>
	<comment><![CDATA[<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis condimentum lacus, id mattis elit pharetra et. Ut purus mauris, malesuada ac molestie vel, consectetur et sapien. Maecenas non nibh libero. Fusce est lacus, congue id fermentum in, dignissim ac erat.</p>]]></comment>
        </order>';
            $ch2=curl_init();
	    curl_setopt($ch2, CURLOPT_URL, $url);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
            curl_setopt($ch2, CURLOPT_HEADER, 0);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml_instruction);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
            $httpHeader2 = array(
				"Content-Type: text/xml; charset=UTF-8",
				"Content-Encoding: UTF-8",
				"Accept: application/xml",
				"Accept-Encoding: gzip"
			);
	    curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
            curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
            $data3=curl_exec($ch2);
            curl_close($ch2);*/
            redirect('home/thankyouf','refresh');
        }  
        function thankyouf()
        {
            $this->load->view('football/thankyou');
        }
	function privacy_policy()
	{
		$this->load->view('privacy_policy');
	} 
	function about_us()
	{
		$this->load->view('about_us');
	}
	function terms()
	{
		$this->load->view('terms');
	}
	function contactus()
	{
		$this->load->view('contactus');
	}
	function car_search()
	{
		$this->load->view('car');
	}
	function book_summary($ex_id)
	{
		$data['ex_id'] = $ex_id;
		$data['country'] = $this->Home_Model->get_holiday_country();
		$data['language'] = $this->Home_Model->get_holiday_language();
		$data['holi_res'] = $holi_res = $this->Home_Model->holiday_confirm_price($ex_id);
		$this->load->view('holiday/book_summary',$data);
	}
	function pagination_football($cur_page,$no_of_paginations)
	{
			
		$msg = "";
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
$msg = "<div class='data'><ul>" . $msg . "</ul></div>";
/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 5) {
    $start_loop = $cur_page - 2;
    if ($no_of_paginations > $cur_page + 2)
        $end_loop = $cur_page + 2;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 4) {
        $start_loop = $no_of_paginations - 4;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 5)
        $end_loop = 5;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>First</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>Previous</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#e32121;' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
}
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:8px; border:1px #e32121 solid; margin-right:5px; padding:2px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
return $msg;
	}
//redirect('home/GetChainTypes','refresh');
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */






}
?>
