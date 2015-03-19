<?php
session_start();
class Hotel extends CI_Controller {

	public function __construct()
    {
	    parent::__construct();
		$this->load->helper('cookie');
		$this->load->model('Home_Model');
		
		$this->load->model('Hotel_Model');
		$this->load->library("pagination");
		$this->load->helper("url");
		/*if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.229' || $_SERVER['HTTP_HOST']=='192.168.0.26')
		{}
		else
		{
		if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
		$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		header("Location: $redirect");
		}
		}*/
	}
	function index()
	{
		$this->load->view('hotel/index');
	}
	
	function cancel_details($id)
	{
		$memberid=$this->session->userdata('memberid');    
        $data['member_info']=$member_info=$this->Home_Model->member_last_login($memberid);
		  $data['book_details']=$book_details=$this->Hotel_Model->get_one_bookid_details($id);
		  if($book_details=='')
		{
			$data['book_details']=$book_details=$this->Hotel_Model->get_onebook_details($id);
		}
		 $data['bookid']=$id;
		$this->load->view('cancel_details',$data);
	}
	function booking_details($id)
	{
		header('Cache-Control: max-age=900');
		$this->session->unset_userdata('memberid');
		
		  $data['book_details']=$book_details=$this->Hotel_Model->get_one_bookid_details($id);
		if($book_details=='')
		{
			$data['book_details']=$book_details=$this->Hotel_Model->get_onebook_details($id);
		}
		 $data['bookid']=$id;
		$this->load->view('booking_details',$data);
	}
	function load_dest($id)
	{
		$data['flag'] ='1';
		$sec_res = session_id();
		$this->Hotel_Model->delete_session($sec_res);
		if($id =='1')
		{
			$hotel_city = explode(',','Las Vegas, United States');
			$dest_code = $this->Hotel_Model->get_dest_Code($hotel_city[0],trim($hotel_city[1]));
		}
		if($id =='2')
		{
			$hotel_city = explode(',','New York, United States');
			$dest_code = $this->Hotel_Model->get_dest_Code($hotel_city[0],trim($hotel_city[1]));
		}
		if($id =='3')
		{
			$hotel_city = explode(',','London, United Kingdom');
			$dest_code = $this->Hotel_Model->get_dest_Code($hotel_city[0],trim($hotel_city[1]));
		}
		if($id =='4')
		{
			$hotel_city = explode(',','Washington, United States');
			$dest_code = $this->Hotel_Model->get_dest_Code($hotel_city[0],trim($hotel_city[1]));
		}
		if($id =='5')
		{
			$hotel_city = explode(',','Toronto, Canada');
			$dest_code = $this->Hotel_Model->get_dest_Code($hotel_city[0],trim($hotel_city[1]));
		}
		if($id =='6')
		{
			$hotel_city = explode(',','Vancouver, Canada');
			$dest_code = $this->Hotel_Model->get_dest_Code($hotel_city[0],trim($hotel_city[1]));
		}
		if($id =='7')
		{
			$hotel_city = explode(',','Cancun, Mexico');
			$dest_code = $this->Hotel_Model->get_dest_Code($hotel_city[0],trim($hotel_city[1]));
		}
		if($id =='8')
		{
			$hotel_city = explode(',','Rio De Janeiro, Brazil');
			$dest_code = $this->Hotel_Model->get_dest_Code($hotel_city[0],trim($hotel_city[1]));
		}
		$sd = date('d/m/Y', strtotime('+1 day')); 
		$ed = date('d/m/Y', strtotime('+8 day'));
		
		
		$room_count = '1';
		
		
		$org_adult =  array('0'=>1);
		
		$org_child =  array('0'=>0);
		$adultval =  array('0'=>1);
		$childval =  array('0'=>0);
		
		$newdate = explode('/',$sd);
		$newdate_cin = $newdate[2].'-'.$newdate[1].'-'.$newdate[0];
		$newdateout = explode('/',$ed);
		$newdate_cout = $newdateout[2].'-'.$newdateout[1].'-'.$newdateout[0];
		$diff = strtotime($newdate_cout) - strtotime($newdate_cin);
		$sec   = $diff % 60;
		$diff  = intval($diff / 60);
		$min   = $diff % 60;
		$diff  = intval($diff / 60);
		$hours = $diff % 24;
		$days  = intval($diff / 24);
		$room_used_type=array();
		$adult_count=0;
		$child_count=0;
		for($i=0;$i< 1;$i++)
		{
			if($adultval[$i]==1 && $childval[$i]==0)
			{
				$room_used_type[] = 'sb';
				$adult_count = $adult_count + 1;
				$child_count = $child_count + 0;
			}
			if($adultval[$i]==1 && $childval[$i]==1)
			{
				$room_used_type[] = 'db';
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 0;
			}
			if($adultval[$i]==1 && $childval[$i]==2)
			{
				$room_used_type[] = 'tr';
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 0;
			}
			if($adultval[$i]==1 && $childval[$i]==3)
			{
				$room_used_type[] = 'qu';
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 0;
			}
			if($adultval[$i]==2 && $childval[$i]==0)
			{
				$room_used_type[] = 'db';
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 0;
			}
			if($adultval[$i]==3 && $childval[$i]==0)
			{
				$room_used_type[] = 'tr';
				$adult_count = $adult_count + 3;
				$child_count = $child_count + 0;
			}
			if($adultval[$i]==3 && $childval[$i]==1)
			{
				$room_used_type[] = 'qu';
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 0;
			}
			if($adultval[$i]==4 && $childval[$i]==0)
			{
				$room_used_type[] = 'qu';
				$adult_count = $adult_count + 4;
				$child_count = $child_count + 0;
			}
			if($adultval[$i]==2 && $childval[$i]==1)
			{
				$room_used_type[] = 'dbc';
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 1;
			}
			if($adultval[$i]==2 && $childval[$i]==2)
			{
				$room_used_type[] = 'dbcc';
				$adult_count = $adult_count + 2;
				$child_count = $child_count + 2;
			}
		}	
			$this->session->set_userdata(array('city_name'=>$hotel_city[0],'country_name'=>trim($hotel_city[1]),'dest_code'=>$dest_code,'room_used_type'=>$room_used_type,'adult_count'=>$adult_count,'child_count'=>$child_count,'org_adult'=>$adult_count,'org_child'=>$child_count,'days'=>$days,'room_count'=>$room_count,'cin'=>$newdate_cin,'cout'=>$newdate_cout,'sd'=>$sd,'ed'=>$ed,'ses_id'=>$sec_res));
		
		//echo '<pre>'; print_r($this->session->userdata);exit;
		//redirect('hotel/hotelspro_hotel_availabilty','refresh');
//		echo $this->session->set_userdata());
		$this->load->view('load_cust');
	}
	function load_cust($id=false)
	{
		header('Cache-Control: max-age=900');
		$sec_res = session_id();
		
		
		if($this->input->post('hotel_city')!='' && strstr($this->input->post('hotel_city'), ','))
		{
			$this->Hotel_Model->delete_session($sec_res);
			$data['api']="hotelspro";
			$hotel_city = explode(',',$this->input->post('hotel_city'));
			$dest_code = $this->Hotel_Model->get_dest_Code($hotel_city[0],trim($hotel_city[1]));
			if($this->input->post('sd_hotel')!='')
			{
			 $sd = $this->input->post('sd_hotel');
			 }
			 
			if($this->input->post('ed_hotel')!='')
			{
			$ed = $this->input->post('ed_hotel');
			}
			
		
		if($this->input->post('room_count')!='')
		{
			$room_count = $this->input->post('room_count');
		}
		else
		{
			$room_count = 1;
		}
		if($this->input->post('adult')!='')
		{
			$org_adult = $this->input->post('adult');
		}
		else
		{
			$org_adult[] =1;
		}
		if($this->input->post('child')!='')
		{
			$org_child = $this->input->post('child');
		}
		else
		{
			$org_child[] =0;
		}
		if($this->input->post('adult')!='')
		{
			$adultval = $this->input->post('adult');
		}
		else
		{
			$adultval[] =1;
			
		}
		if($this->input->post('child')!='')
		{
			$childval = $this->input->post('child');
		}
		else
		{
			$childval[] =0;
		}
			//echo $room_count;
			//echo '<pre>'; print_r($this->input->post('adult'));exit;
			
			$newdate = explode('/',$sd);
			$newdate_cin = $newdate[2].'-'.$newdate[1].'-'.$newdate[0];
			$newdateout = explode('/',$ed);
			$newdate_cout = $newdateout[2].'-'.$newdateout[1].'-'.$newdateout[0];
			$diff = strtotime($newdate_cout) - strtotime($newdate_cin);
			$sec   = $diff % 60;
			$diff  = intval($diff / 60);
			$min   = $diff % 60;
			$diff  = intval($diff / 60);
			$hours = $diff % 24;
			$days  = intval($diff / 24);
			$room_used_type=array();
			$adult_count=0;
			$child_count=0;
			
			for($i=0;$i< $room_count;$i++)
			{
				
				if($adultval[$i]==1 && $childval[$i]==0)
				{
					$room_used_type[] = 'sb';
					$adult_count = $adult_count + 1;
					$child_count = $child_count + 0;
				}
				if($adultval[$i]==1 && $childval[$i]==1)
				{
					$room_used_type[] = 'db';
					$adult_count = $adult_count + 2;
					$child_count = $child_count + 0;
				}
				if($adultval[$i]==1 && $childval[$i]==2)
				{
					$room_used_type[] = 'tr';
					$adult_count = $adult_count + 3;
					$child_count = $child_count + 0;
				}
				if($adultval[$i]==1 && $childval[$i]==3)
				{
					$room_used_type[] = 'qu';
					$adult_count = $adult_count + 4;
					$child_count = $child_count + 0;
				}
				if($adultval[$i]==2 && $childval[$i]==0)
				{
					$room_used_type[] = 'db';
					$adult_count = $adult_count + 2;
					$child_count = $child_count + 0;
				}
				if($adultval[$i]==3 && $childval[$i]==0)
				{
					$room_used_type[] = 'tr';
					$adult_count = $adult_count + 3;
					$child_count = $child_count + 0;
				}
				if($adultval[$i]==3 && $childval[$i]==1)
				{
					$room_used_type[] = 'qu';
					$adult_count = $adult_count + 4;
					$child_count = $child_count + 0;
				}
				if($adultval[$i]==4 && $childval[$i]==0)
				{
					$room_used_type[] = 'qu';
					$adult_count = $adult_count + 4;
					$child_count = $child_count + 0;
				}
				if($adultval[$i]==2 && $childval[$i]==1)
				{
					$room_used_type[] = 'dbc';
					$adult_count = $adult_count + 2;
					$child_count = $child_count + 1;
				}
				if($adultval[$i]==2 && $childval[$i]==2)
				{
					$room_used_type[] = 'dbcc';
					$adult_count = $adult_count + 2;
					$child_count = $child_count + 2;
				}
			}	
				$this->session->set_userdata(array('city_name'=>$hotel_city[0],'country_name'=>trim($hotel_city[1]),'dest_code'=>$dest_code,'room_used_type'=>$room_used_type,'adult_count'=>$adult_count,'child_count'=>$child_count,'org_adult'=>$adult_count,'org_child'=>$child_count,'days'=>$days,'room_count'=>$room_count,'cin'=>$newdate_cin,'cout'=>$newdate_cout,'sd'=>$sd,'ed'=>$ed,'ses_id'=>$sec_res,'childval'=>$childval,'adultval'=>$adultval));
			
		//echo '<pre>'; print_r($this->session->userdata);exit;
			$this->load->view('load_cust',$data);
	//		echo $this->session->set_userdata());
			//$this->load->view('load_cust');
		}
		else
		{
			if($id!='')
			{
				echo $id;exit;
				
			}
			else
			{
			$hotel_city = $this->input->post('hotel_city');
			}
		  $data['api']="canada";
			if($this->input->post('sd')!='')
			{
			 $start_date = $this->input->post('sd');
			 }
			 else
			 {
				 $start_date = $this->input->post('start_date');
			}
			if($this->input->post('ed')!='')
			{
			$end_date = $this->input->post('ed');
			}
			else
			{
				$end_date = $this->input->post('end_date');
			}
		
		$this->session->set_userdata(array('city_name'=>$hotel_city,'sd'=>$start_date,'ed'=>$end_date,'ses_id'=>$sec_res));
			$this->load->view('load_cust',$data);

	}
	}
	
	function hotel_avalability()
	{
		
		header('Cache-Control: max-age=900');
		if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.17')
	{
		$url = "https://192.168.0.229/dhaka/xml_xplorer_bd/search_hotels.php";
	}
	else
	{
		$url = "https://bdrooms.com/xml_xplorer_bd/search_hotels.php";
	}
	
	
	$_SESSION['city'] = $hotel_city 		= trim($this->session->userdata('city_name'));
	 $_SESSION['start_date'] = $start_date 		= trim($this->session->userdata('sd'));
	$_SESSION['end_date'] = $end_date 		= trim($this->session->userdata('ed'));
	$_SESSION['sec_res']=$sec_res = $this->session->userdata('ses_id');
	$this->Hotel_Model->delete_hotel($sec_res);
	$date1=$start_date;
	list($d1,$m1,$y1)=explode('/',$date1);
	$newdate=$y1.'-'.$m1.'-'.$d1;
	$date2=$end_date ;
	list($d,$m,$y)=explode('/',$date2);
	$newdate1=$y.'-'.$m.'-'.$d;
	$d3=mktime(0,0,0,$m1,$d1,$y1);
	$d2=mktime(0,0,0,$m,$d,$y);
	$days = floor(($d2-$d3)/86400);
	$date1=$start_date;
	list($d1,$m1,$y1)=explode('/',$date1);
	$newdate=$y1.'-'.$m1.'-'.$d1;
	$date2=$end_date ;
	list($d,$m,$y)=explode('/',$date2);
	$newdate1=$y.'-'.$m.'-'.$d;
	$d3=mktime(0,0,0,$m1,$d1,$y1);
	$d2=mktime(0,0,0,$m,$d,$y);
	$days  = $_SESSION['days'] = floor(($d2-$d3)/86400);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"city=".$hotel_city ."&startdate=".$start_date."&enddate=".$end_date."&sec_res=".$sec_res);
	$contentz=curl_exec($ch);
	$array=$this->xml2array2($contentz);
	//echo "<pre>"; print_r($array);exit;
	if(isset($array['hotelresults']['result'][0]))
	{
		//die("a");exit;
		if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.229')
		{
			$url1 = "https://192.168.0.229/dhaka/xml_xplorer_bd/search_rooms.php";
		}
		else
		{
			$url1 = "https://bdrooms.com/xml_xplorer_bd/search_rooms.php";
		}
		$allhotels = $array['hotelresults']['result'];
		//echo "<pre>"; print_r($allhotels);exit;
		foreach($allhotels as $hotels)
		{
			//echo "<pre>"; print_r($hotels);
				$hotel_id = $hotels['hotel_id'];
			$supplier_id = $hotels['supplier_id'];
			$hotel_name = $hotels['hotel_name'];
			$hotel_address = $hotels['hotel_address'];
			$hotel_desc = $hotels['hotel_desc'];
			$loc_info = $hotels['loc_info'];
			$picture1 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture1'];
			$picture2 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture2'];
			$picture3 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture3'];
			$picture4 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture4'];
			$picture5 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture5'];
			$picture6 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture6'];
			$picture7 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture7'];
			$picture8 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture8'];
			if($hotels['picture9'])
			{
				$picture9 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture9'];
			}
			else
			{
				$picture9 = '';
			}
			
			$star_rate = $hotels['star_rate'];
			if($hotels['amenities'])
			{
				$amenities = $hotels['amenities'];
			}
			else
			{
				$amenities = '';
			}
			if($hotels['room_services'])
			{
				$compulsary_services = $hotels['room_services'];
			}
			else
			{
				$compulsary_services = '';
			}
			if($hotels['latitude'])
			{
				$latitude = $hotels['latitude'];
			}
			else
			{
				$latitude = '';
			}
			if($hotels['longitude'])
			{
				$longitude = $hotels['longitude'];
			}
			else
			{
				$longitude = '';
			}
			if($hotels['earliest_checkin'])
			{
				$earliest_checkin = $hotels['earliest_checkin'];
			}
			else
			{
				$earliest_checkin = '';
			}
			if($hotels['earliest_checkout'])
			{
				$earliest_checkout = $hotels['earliest_checkout'];
			}
			else
			{
				$earliest_checkout = '';
			}
			if($hotels['built'])
			{
				$built = $hotels['built'];
			}
			else
			{
				$built = '';
			}
			if($hotels['children_policy'])
			{
				$children_policy = $hotels['children_policy'];
			}
			else
			{
				$children_policy = '';
			}
			if($hotels['cancellation_policy'])
			{
				$cancellation_policy = $hotels['cancellation_policy'];
			}
			else
			{
				$cancellation_policy = '';
			}
			if($hotels['email'])
			{
				$email = $hotels['email'];
			}
			else
			{
				$email = '';
			}
			if($hotels['review'])
			{
				$review = $hotels['review'];
			}
			else
			{
				$review = '';
			}
			if($hotels['reviews_count'])
			{
				$reviews_count = $hotels['reviews_count'];
			}
			else
			{
				$reviews_count = '';
			}
			$hotel_commision = $hotels['hotel_commision'];
			$mobile_no = $hotels['mobile_no'];
			
			
			$ins = "INSERT INTO search_result(criteria_id,hotel_id,supplier_id,hotel_name,hotel_address,hotel_desc,
			loc_info,star_rate,picture1,picture2,picture3,picture4,picture5,picture6,picture7,picture8,
			picture9,latitude,longitude,amenities,compulsary_services,earliestcheckin,earliestcheckout,
			yearofbuilt,children_policy,cancellation_policy,hotel_commision,mobile_no,email,review,reviews_count)
			values('".$_SESSION['sec_res']."','".$hotel_id."','".$supplier_id."','".$hotel_name."','".$hotel_address."','".$hotel_desc."','".$loc_info."','".$star_rate."','".$picture1."','".$picture2."','".$picture3."','".$picture4."','".$picture5."','".$picture6."','".$picture7."','".$picture8."','".$picture9."','".$latitude."','".$longitude."','".$amenities."','".$compulsary_services."','".$earliest_checkin."','".$earliest_checkout."','".$built."','".$children_policy."','".$cancellation_policy."','".$hotel_commision."','".$mobile_no."','".$email."','".$review."','".$reviews_count."')";
			$this->db->query($ins);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_URL,$url1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"supplier_id=".$supplier_id."&startdate=".$start_date."&enddate=".$end_date.
			"&sec_res=".$sec_res."&days=".$days);
			$contentz1=curl_exec($ch);
			//echo $supplier_id;exit;
			/*if($supplier_id == 'HOTSP1356453606')
			{
				$array1=xml2array2($contentz1);
				echo "<pre>"; print_r($array1);
			}*/
			$array1=$this->xml2array2($contentz1);
			//echo "<pre>"; print_r($array1);exit;
			if(isset($array1['availablerooms']['result'][0]))
			{
				
				$availablerooms = $array1['availablerooms']['result'];
				foreach($availablerooms as $rooms)
				{
					$supplier_id = $rooms['supplier_id'];
					$roomid = $rooms['roomid'];
					$room_type_name = $rooms['room_type_name'];
					$max_persons = $rooms['max_persons'];
					$extra_beds = $rooms['extra_beds'];
					$single_rate = $rooms['single_rate'];
					//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
					$double_rate = $rooms['double_rate'];
					//$double_rate = $double_rate + (($hotel_commision * $double_rate)/100);
					$breakfast = $rooms['breakfast'];
					$date = $rooms['date'];
					$day = $rooms['day'];
				//	echo "<pre>"; print_r($rooms);
					if($rooms['room_picture0']!='')
					{
						$room_picture0 = $rooms['room_picture0'];
					}
					else
					{
						$room_picture0 = '';
					}
					if($rooms['room_picture1'])
					{
						$room_picture1 = $rooms['room_picture1'];
					}
					else
					{
						$room_picture1 = '';
					}
					if(isset($rooms['room_picture3']) && $rooms['room_picture3']!='')
					{
						$room_picture3 = $rooms['room_picture3'];
					}
					else
					{
						$room_picture3 = '';
					}
					if(isset($rooms['room_picture2']) && $rooms['room_picture2']!='')
					{
						$room_picture2 = $rooms['room_picture2'];
					}
					else
					{
						$room_picture2 = '';
					}
					if($rooms['amenities_room'])
					{
						$amenities_room = $rooms['amenities_room'];
					}
					else
					{
						$amenities_room = '';
					}
					if($rooms['available_rooms'])
					{
						$available_rooms = $rooms['available_rooms'];
					}
					else
					{
						$available_rooms = '';
					}
					$ins_room = "INSERT INTO search_result_rooms(criteria_id,roomid,room_type_name,max_persons,
					extra_beds,single_rate,double_rate,breakfast,room_picture0,room_picture1,
					room_picture2,amenities_room,supplier_id,available_rooms,date,day)
					values('".$_SESSION['sec_res']."','".$roomid."','".$room_type_name."','".$max_persons."',
					'".$extra_beds."','".$single_rate."','".$double_rate."','".$breakfast."',
					'".$room_picture0."','".$room_picture1."','".$room_picture2."','".$amenities_room."','".$supplier_id."','".$available_rooms."','".$date."','".$day."')";
					$this->db->query($ins_room);
			
			
				}
			}
			else
			{
				
				if(isset($array1['availablerooms']['result']))
				{
			
				$rooms = $array1['availablerooms']['result'];
				$supplier_id = $rooms['supplier_id'];
				$roomid = $rooms['roomid'];
				$room_type_name = $rooms['room_type_name'];
				$max_persons = $rooms['max_persons'];
				$extra_beds = $rooms['extra_beds'];
				$single_rate = $rooms['single_rate'];
				//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
				$double_rate = $rooms['double_rate'];
				//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
				$breakfast = $rooms['breakfast'];
				$date = $rooms['date'];
				$day = $rooms['day'];
				if($rooms['room_picture0'])
				{
					$room_picture0 = $rooms['room_picture0'];
				}
				else
				{
					$room_picture0 = '';
				}
				if(isset($rooms['room_picture1']) && $rooms['room_picture1']!='')
				{
					$room_picture1 = $rooms['room_picture1'];
				}
				else
				{
					$room_picture1 = '';
				}
				if(isset($rooms['room_picture3']) && $rooms['room_picture3']!='')
				{
					$room_picture3 = $rooms['room_picture3'];
				}
				else
				{
					$room_picture3 = '';
				}
				
				if(isset($rooms['room_picture2']) && $rooms['room_picture2']!='')
				{
					$room_picture2 = $rooms['room_picture2'];
				}
				else
				{
					$room_picture2 = '';
				}
				
				if($rooms['amenities_room'])
				{
					$amenities_room = $rooms['amenities_room'];
				}
				else
				{
					$amenities_room = '';
				}
				if($rooms['available_rooms'])
				{
					$available_rooms = $rooms['available_rooms'];
				}
				else
				{
					$available_rooms = '';
				}
				$ins_room = "INSERT INTO search_result_rooms(criteria_id,roomid,room_type_name,max_persons,extra_beds,single_rate,double_rate,breakfast,room_picture0,room_picture1,room_picture2,amenities_room,supplier_id,available_rooms,date,day)values('".$_SESSION['sec_res']."','".$roomid."','".$room_type_name."','".$max_persons."','".$extra_beds."','".$single_rate."','".$double_rate."','".$breakfast."','".$room_picture0."','".$room_picture1."','".$room_picture2."','".$amenities_room."','".$supplier_id."','".$available_rooms."','".$date."','".$day."')";
				$this->db->query($ins_room);
			}
			}
			
			$min_costs =$this->Hotel_Model->fetch_min_price($_SESSION['sec_res'],$supplier_id);
 
			
			
			foreach($min_costs as $groups)
			{
			
			foreach($groups as $r)
    {
		
				$min = $r;
				
				$update = "UPDATE search_result SET min_cost = '".$min."' WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."'";
				$this->db->query($update);
				
				if($min=="")
				{
				 $sel = "SELECT min(double_rate) as min_cost FROM search_result_rooms WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."' AND double_rate != 0";
					
					$query=$this->db->query($sel);
					$res=$query->result();
					if($res!='')
					{
						foreach($res as $groups1)
			{
			
			foreach($groups1 as $r1)
    {
		$min = $r1;
						$update = "UPDATE search_result SET min_cost = '".$min."' WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."'";
					$this->db->query($update);
	}
}
						
					}
				}
			
			}
		}
		}
	}
	else
	{
		
		if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.229')
		{
			$url1 = "https://192.168.0.229/dhaka/xml_xplorer_bd/search_rooms.php";
		}
		else
		{
			$url1 = "https://bdrooms.com/xml_xplorer_bd/search_rooms.php";
		}
		$hotels = $array['hotelresults']['result'];
		$hotel_id = $hotels['hotel_id'];
		$supplier_id = $hotels['supplier_id'];
		$hotel_name = $hotels['hotel_name'];
		$hotel_address = $hotels['hotel_address'];
		$hotel_desc = $hotels['hotel_desc'];
		$loc_info = $hotels['loc_info'];
		$picture1 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture1'];
		$picture2 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture2'];
		$picture3 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture3'];
		$picture4 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture4'];
		$picture5 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture5'];
		$picture6 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture6'];
		$picture7 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture7'];
		$picture8 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture8'];
		$star_rate = $hotels['star_rate'];
		if($hotels['latitude'])
			{
				$latitude = $hotels['latitude'];
			}
			else
			{
				$latitude = '';
			}
			if($hotels['longitude'])
			{
				$longitude = $hotels['longitude'];
			}
			else
			{
				$longitude = '';
			}
			if($hotels['amenities'])
			{
				$amenities = $hotels['amenities'];
			}
			else
			{
				$amenities = '';
			}
			if($hotels['room_services'])
			{
				$compulsary_services = $hotels['room_services'];
			}
			else
			{
				$compulsary_services = '';
			}
			if($hotels['earliest_checkin'])
			{
				$earliest_checkin = $hotels['earliest_checkin'];
			}
			else
			{
				$earliest_checkin = '';
			}
			if($hotels['earliest_checkout'])
			{
				$earliest_checkout = $hotels['earliest_checkout'];
			}
			else
			{
				$earliest_checkout = '';
			}
			if($hotels['built'])
			{
				$built = $hotels['built'];
			}
			else
			{
				$built = '';
			}
			if($hotels['children_policy'])
			{
				$children_policy = $hotels['children_policy'];
			}
			else
			{
				$children_policy = '';
			}
			if($hotels['cancellation_policy'])
			{
				$cancellation_policy = $hotels['cancellation_policy'];
			}
			else
			{
				$cancellation_policy = '';
			}
			$hotel_commision = $hotels['hotel_commision'];
			$mobile_no = $hotels['mobile_no'];
			
			
			$ins = "INSERT INTO search_result(criteria_id,hotel_id,supplier_id,hotel_name,hotel_address,hotel_desc,
			loc_info,star_rate,picture1,picture2,picture3,picture4,picture5,picture6,picture7,picture8,latitude,
			longitude,amenities,compulsary_services,earliestcheckin,earliestcheckout,yearofbuilt,children_policy,
			cancellation_policy,hotel_commision,mobile_no)values('".$_SESSION['sec_res']."','".$hotel_id."','".$supplier_id."','".$hotel_name."','".$hotel_address."','".mysql_real_escape_string($hotel_desc)."','".$loc_info."','".$star_rate."','".$picture1."','".$picture2."','".$picture3."','".$picture4."','".$picture5."','".$picture6."','".$picture7."','".$picture8."','".$latitude."','".$longitude."','".$amenities."','".$compulsary_services."','".$earliest_checkin."','".$earliest_checkout."','".$built."','".$children_policy."','".$cancellation_policy."','".$hotel_commision."','".$mobile_no."')";
			
			//$ins = "INSERT INTO search_result(criteria_id,hotel_id,supplier_id,hotel_name,hotel_address,hotel_desc,loc_info,star_rate,picture1,picture2,picture3,picture4,picture5,picture6,picture7,picture8,latitude,longitude,amenities,compulsary_services,earliestcheckin,earliestcheckout,yearofbuilt,children_policy,cancellation_policy)values('".$_SESSION['sec_res']."','".$hotel_id."','".$supplier_id."','".$hotel_name."','".$hotel_address."','".mysql_real_escape_string($hotel_desc)."','".$loc_info."','".$star_rate."','".$picture1."','".$picture2."','".$picture3."','".$picture4."','".$picture5."','".$picture6."','".$picture7."','".$picture8."','".$latitude."','".$longitude."','".$amenities."','".$compulsary_services."','".$earliest_checkin."','".$earliest_checkout."','".$built."','".$children_policy."','".$cancellation_policy."')";
			
		$this->db->query($ins);
		$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_URL,$url1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"supplier_id=".$supplier_id."&startdate=".$start_date."&enddate=".$end_date."&sec_res=".$sec_res."&days=".$days);
			$contentz1=curl_exec($ch);
			$array1=$this->xml2array2($contentz1);
			if(isset($array1['availablerooms']['result'][0]))
			{
				$availablerooms = $array1['availablerooms']['result'];
				foreach($availablerooms as $rooms)
				{
					$supplier_id = $rooms['supplier_id'];
					$roomid = $rooms['roomid'];
					$room_type_name = $rooms['room_type_name'];
					$max_persons = $rooms['max_persons'];
					$extra_beds = $rooms['extra_beds'];
					$single_rate = $rooms['single_rate'];
					//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
					$double_rate = $rooms['double_rate'];
					//$double_rate = $double_rate + (($hotel_commision * $double_rate)/100);
					$breakfast = $rooms['breakfast'];
					$date = $rooms['date'];
					$day = $rooms['day'];
					if($rooms['room_picture0'])
					{
						$room_picture0 = "https://bdrooms.com/uploadimage/room/".$rooms['room_picture0'];
					}
					else
					{
						$room_picture0 = '';
					}
					if($rooms['room_picture1'])
					{
						$room_picture1 = $rooms['room_picture1'];
					}
					else
					{
						$room_picture1 = '';
					}
					if($rooms['room_picture3'])
					{
						$room_picture3 = $rooms['room_picture3'];
					}
					else
					{
						$room_picture3 = '';
					}
					if($rooms['amenities_room'])
					{
						$amenities_room = $rooms['amenities_room'];
					}
					else
					{
						$amenities_room = '';
					}
					if($rooms['available_rooms'])
					{
						$available_rooms = $rooms['available_rooms'];
					}
					else
					{	
						$available_rooms = '';
					}
					$ins_room = "INSERT INTO search_result_rooms(criteria_id,roomid,room_type_name,max_persons,extra_beds,single_rate,double_rate,breakfast,room_picture0,room_picture1,room_picture2,amenities_room,supplier_id,available_rooms,date,day)values('".$_SESSION['sec_res']."','".$roomid."','".$room_type_name."','".$max_persons."','".$extra_beds."','".$single_rate."','".$double_rate."','".$breakfast."','".$room_picture0."','".$room_picture1."','".$room_picture2."','".$amenities_room."','".$supplier_id."','".$available_rooms."','".$date."','".$day."')";
					$this->db->query($ins_room);
				}
			}
			else
			{
				$rooms = $array1['availablerooms']['result'];
				$supplier_id = $rooms['supplier_id'];
				$roomid = $rooms['roomid'];
				$room_type_name = $rooms['room_type_name'];
				$max_persons = $rooms['max_persons'];
				$extra_beds = $rooms['extra_beds'];
				$single_rate = $rooms['single_rate'];
				//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
				$double_rate = $rooms['double_rate'];
				//$double_rate = $double_rate + (($hotel_commision * $double_rate)/100);
				$breakfast = $rooms['breakfast'];
				$date = $rooms['date'];
				$day = $rooms['day'];
				if($rooms['room_picture0'])
				{
					$room_picture0 = $rooms['room_picture0'];
				}
				else
				{
					$room_picture0 = '';
				}
				if($rooms['room_picture1'])
				{
					$room_picture1 = $rooms['room_picture1'];
				}
				else
				{
					$room_picture1 = '';
				}
				if($rooms['room_picture3'])
				{
					$room_picture3 = $rooms['room_picture3'];
				}
				else
				{
					$room_picture3 = '';
				}
				if($rooms['amenities_room'])
				{
					$amenities_room = $rooms['amenities_room'];
				}
				else
				{
					$amenities_room = '';
				}
				if($rooms['available_rooms'])
				{
					$available_rooms = $rooms['available_rooms'];
				}
				else
				{	
					$available_rooms = '';
				}
				$ins_room = "INSERT INTO search_result_rooms(criteria_id,roomid,room_type_name,max_persons,extra_beds,single_rate,double_rate,breakfast,room_picture0,room_picture1,room_picture2,amenities_room,supplier_id,available_rooms,date,day)values('".$_SESSION['sec_res']."','".$roomid."','".$room_type_name."','".$max_persons."','".$extra_beds."','".$single_rate."','".$double_rate."','".$breakfast."','".$room_picture0."','".$room_picture1."','".$room_picture2."','".$amenities_room."','".$supplier_id."','".$available_rooms."','".$date."','".$day."')";
				$this->db->query($ins_room);
			}
			
				$min_costs =$this->Hotel_Model->fetch_min_price($_SESSION['sec_res'],$supplier_id);
 
			
			
			foreach($min_costs as $groups)
			{
			
			foreach($groups as $r)
    {
		
				$min = $r;
				
				$update = "UPDATE search_result SET min_cost = '".$min."' WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."'";
				$this->db->query($update);
				echo $min;echo "<br>";
				if($min=="")
				{
				 $sel = "SELECT min(double_rate) as min_cost FROM search_result_rooms WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."' AND double_rate != 0";
					
					$query=$this->db->query($sel);
					$res=$query->result();
					if($res!='')
					{
						foreach($res as $groups1)
			{
			
			foreach($groups1 as $r1)
    {
		$min = $r1;
						$update = "UPDATE search_result SET min_cost = '".$min."' WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."'";
					$this->db->query($update);
	}
}
						
					}
				}
			
			}
		}
		}
		
		redirect('hotel/search_result_hotel','refresh');
	}
	
	
	
	
	function hotel_avalability_fet()
	{
		//echo 'asfdasdf';exit;
		
		if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.229')
	{
		$url = "https://192.168.0.229/dhaka/xml_xplorer_bd/search_hotels.php";
	}
	else
	{
		$url = "https://bdrooms.com/xml_xplorer_bd/search_hotels.php";
	}
	//echo '<pre>'; print_r($this->session->userdata);exit;
	
	$_SESSION['city'] = $hotel_city 		= trim($this->session->userdata('city_name'));
	 $_SESSION['start_date'] = $start_date 		= trim($this->session->userdata('sd'));
	$_SESSION['end_date'] = $end_date 		= trim($this->session->userdata('ed'));
	$_SESSION['sec_res']=$sec_res = $this->session->userdata('ses_id');
	//echo $hotel_city; echo $start_date; echo $end_date;
	$this->Hotel_Model->delete_hotel($sec_res);
	$date1=$start_date;
	list($d1,$m1,$y1)=explode('/',$date1);
	$newdate=$y1.'-'.$m1.'-'.$d1;
	$date2=$end_date ;
	list($d,$m,$y)=explode('/',$date2);
	$newdate1=$y.'-'.$m.'-'.$d;
	$d3=mktime(0,0,0,$m1,$d1,$y1);
	$d2=mktime(0,0,0,$m,$d,$y);
	$days = floor(($d2-$d3)/86400);
	$date1=$start_date;
	list($d1,$m1,$y1)=explode('/',$date1);
	$newdate=$y1.'-'.$m1.'-'.$d1;
	$date2=$end_date ;
	list($d,$m,$y)=explode('/',$date2);
	$newdate1=$y.'-'.$m.'-'.$d;
	$d3=mktime(0,0,0,$m1,$d1,$y1);
	$d2=mktime(0,0,0,$m,$d,$y);
	$days  = $_SESSION['days'] = floor(($d2-$d3)/86400);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"city=".$hotel_city ."&startdate=".$start_date."&enddate=".$end_date."&sec_res=".$sec_res);
	$contentz=curl_exec($ch);
	$array=$this->xml2array2($contentz);
	//echo "<pre>"; print_r($array);exit;
	if(isset($array['hotelresults']['result'][0]))
	{
		//die("a");exit;
		if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.229')
		{
			$url1 = "https://192.168.0.229/dhaka/xml_xplorer_bd/search_rooms.php";
		}
		else
		{
			$url1 = "https://bdrooms.com/xml_xplorer_bd/search_rooms.php";
		}
		$allhotels = $array['hotelresults']['result'];
		//echo "<pre>"; print_r($allhotels);exit;
		foreach($allhotels as $hotels)
		{
	
			//$hotel_id = $hotels['hotel_id'];
			$supplier_id = $hotels['supplier_id'];
			$this->session->userdata('featured_sup_id');
			if($supplier_id == $this->session->userdata('featured_sup_id'))
			{
				$hotel_id = $hotels['hotel_id'];
				$hotel_name = $hotels['hotel_name'];
				$hotel_address = $hotels['hotel_address'];
				$hotel_desc = $hotels['hotel_desc'];
				$loc_info = $hotels['loc_info'];
				$picture1 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture1'];
				$picture2 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture2'];
				$picture3 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture3'];
				$picture4 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture4'];
				$picture5 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture5'];
				$picture6 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture6'];
				$picture7 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture7'];
				$picture8 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture8'];
				if($hotels['picture9'])
				{
					$picture9 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture9'];
				}
				else
				{
					$picture9 = '';
				}
				
				$star_rate = $hotels['star_rate'];
				if($hotels['amenities'])
				{
					$amenities = $hotels['amenities'];
				}
				else
				{
					$amenities = '';
				}
				if($hotels['room_services'])
				{
					$compulsary_services = $hotels['room_services'];
				}
				else
				{
					$compulsary_services = '';
				}
				if($hotels['latitude'])
				{
					$latitude = $hotels['latitude'];
				}
				else
				{
					$latitude = '';
				}
				if($hotels['longitude'])
				{
					$longitude = $hotels['longitude'];
				}
				else
				{
					$longitude = '';
				}
				if($hotels['earliest_checkin'])
				{
					$earliest_checkin = $hotels['earliest_checkin'];
				}
				else
				{
					$earliest_checkin = '';
				}
				if($hotels['earliest_checkout'])
				{
					$earliest_checkout = $hotels['earliest_checkout'];
				}
				else
				{
					$earliest_checkout = '';
				}
				if($hotels['built'])
				{
					$built = $hotels['built'];
				}
				else
				{
					$built = '';
				}
				if($hotels['children_policy'])
				{
					$children_policy = $hotels['children_policy'];
				}
				else
				{
					$children_policy = '';
				}
				if($hotels['cancellation_policy'])
				{
					$cancellation_policy = $hotels['cancellation_policy'];
				}
				else
				{
					$cancellation_policy = '';
				}
				if($hotels['email'])
				{
					$email = $hotels['email'];
				}
				else
				{
					$email = '';
				}
				if($hotels['review'])
				{
					$review = $hotels['review'];
				}
				else
				{
					$review = '';
				}
				if($hotels['reviews_count'])
				{
					$reviews_count = $hotels['reviews_count'];
				}
				else
				{
					$reviews_count = '';
				}
				$hotel_commision = $hotels['hotel_commision'];
				$mobile_no = $hotels['mobile_no'];
				
				
				$ins = "INSERT INTO search_result(criteria_id,hotel_id,supplier_id,hotel_name,hotel_address,hotel_desc,
				loc_info,star_rate,picture1,picture2,picture3,picture4,picture5,picture6,picture7,picture8,
				picture9,latitude,longitude,amenities,compulsary_services,earliestcheckin,earliestcheckout,
				yearofbuilt,children_policy,cancellation_policy,hotel_commision,mobile_no,email,review,reviews_count)
				values('".$_SESSION['sec_res']."','".$hotel_id."','".$supplier_id."','".$hotel_name."','".$hotel_address."','".$hotel_desc."','".$loc_info."','".$star_rate."','".$picture1."','".$picture2."','".$picture3."','".$picture4."','".$picture5."','".$picture6."','".$picture7."','".$picture8."','".$picture9."','".$latitude."','".$longitude."','".$amenities."','".$compulsary_services."','".$earliest_checkin."','".$earliest_checkout."','".$built."','".$children_policy."','".$cancellation_policy."','".$hotel_commision."','".$mobile_no."','".$email."','".$review."','".$reviews_count."')";
				$this->db->query($ins);
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_URL,$url1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_POSTFIELDS,"supplier_id=".$supplier_id."&startdate=".$start_date."&enddate=".$end_date.
				"&sec_res=".$sec_res."&days=".$days);
				$contentz1=curl_exec($ch);
				//echo $supplier_id;exit;
				/*if($supplier_id == 'HOTSP1356453606')
				{
					$array1=xml2array2($contentz1);
					echo "<pre>"; print_r($array1);
				}*/
				$array1=$this->xml2array2($contentz1);
				//echo "<pre>"; print_r($array1);exit;
				if(isset($array1['availablerooms']['result'][0]))
				{
					
					$availablerooms = $array1['availablerooms']['result'];
					foreach($availablerooms as $rooms)
					{
						$supplier_id = $rooms['supplier_id'];
						$roomid = $rooms['roomid'];
						$room_type_name = $rooms['room_type_name'];
						$max_persons = $rooms['max_persons'];
						$extra_beds = $rooms['extra_beds'];
						$single_rate = $rooms['single_rate'];
						//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
						$double_rate = $rooms['double_rate'];
						//$double_rate = $double_rate + (($hotel_commision * $double_rate)/100);
						$breakfast = $rooms['breakfast'];
						$date = $rooms['date'];
						$day = $rooms['day'];
					//	echo "<pre>"; print_r($rooms);
						if($rooms['room_picture0']!='')
						{
							$room_picture0 = $rooms['room_picture0'];
						}
						else
						{
							$room_picture0 = '';
						}
						if($rooms['room_picture1'])
						{
							$room_picture1 = $rooms['room_picture1'];
						}
						else
						{
							$room_picture1 = '';
						}
						if(isset($rooms['room_picture3']) && $rooms['room_picture3']!='')
						{
							$room_picture3 = $rooms['room_picture3'];
						}
						else
						{
							$room_picture3 = '';
						}
						if(isset($rooms['room_picture2']) && $rooms['room_picture2']!='')
						{
							$room_picture2 = $rooms['room_picture2'];
						}
						else
						{
							$room_picture2 = '';
						}
						if($rooms['amenities_room'])
						{
							$amenities_room = $rooms['amenities_room'];
						}
						else
						{
							$amenities_room = '';
						}
						if($rooms['available_rooms'])
						{
							$available_rooms = $rooms['available_rooms'];
						}
						else
						{
							$available_rooms = '';
						}
						$ins_room = "INSERT INTO search_result_rooms(criteria_id,roomid,room_type_name,max_persons,
						extra_beds,single_rate,double_rate,breakfast,room_picture0,room_picture1,
						room_picture2,amenities_room,supplier_id,available_rooms,date,day)
						values('".$_SESSION['sec_res']."','".$roomid."','".$room_type_name."','".$max_persons."',
						'".$extra_beds."','".$single_rate."','".$double_rate."','".$breakfast."',
						'".$room_picture0."','".$room_picture1."','".$room_picture2."','".$amenities_room."','".$supplier_id."','".$available_rooms."','".$date."','".$day."')";
						$this->db->query($ins_room);
				
				
					}
				}
				else
				{
					
					if(isset($array1['availablerooms']['result']))
					{
				
					$rooms = $array1['availablerooms']['result'];
					$supplier_id = $rooms['supplier_id'];
					$roomid = $rooms['roomid'];
					$room_type_name = $rooms['room_type_name'];
					$max_persons = $rooms['max_persons'];
					$extra_beds = $rooms['extra_beds'];
					$single_rate = $rooms['single_rate'];
					//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
					$double_rate = $rooms['double_rate'];
					//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
					$breakfast = $rooms['breakfast'];
					$date = $rooms['date'];
					$day = $rooms['day'];
					if($rooms['room_picture0'])
					{
						$room_picture0 = $rooms['room_picture0'];
					}
					else
					{
						$room_picture0 = '';
					}
					if(isset($rooms['room_picture1']) && $rooms['room_picture1']!='')
					{
						$room_picture1 = $rooms['room_picture1'];
					}
					else
					{
						$room_picture1 = '';
					}
					if(isset($rooms['room_picture3']) && $rooms['room_picture3']!='')
					{
						$room_picture3 = $rooms['room_picture3'];
					}
					else
					{
						$room_picture3 = '';
					}
					
					if(isset($rooms['room_picture2']) && $rooms['room_picture2']!='')
					{
						$room_picture2 = $rooms['room_picture2'];
					}
					else
					{
						$room_picture2 = '';
					}
					
					if($rooms['amenities_room'])
					{
						$amenities_room = $rooms['amenities_room'];
					}
					else
					{
						$amenities_room = '';
					}
					if($rooms['available_rooms'])
					{
						$available_rooms = $rooms['available_rooms'];
					}
					else
					{
						$available_rooms = '';
					}
					$ins_room = "INSERT INTO search_result_rooms(criteria_id,roomid,room_type_name,max_persons,extra_beds,single_rate,double_rate,breakfast,room_picture0,room_picture1,room_picture2,amenities_room,supplier_id,available_rooms,date,day)values('".$_SESSION['sec_res']."','".$roomid."','".$room_type_name."','".$max_persons."','".$extra_beds."','".$single_rate."','".$double_rate."','".$breakfast."','".$room_picture0."','".$room_picture1."','".$room_picture2."','".$amenities_room."','".$supplier_id."','".$available_rooms."','".$date."','".$day."')";
					$this->db->query($ins_room);
				}
			}
			$min_costs =$this->Hotel_Model->fetch_min_price($_SESSION['sec_res'],$supplier_id);
			foreach($min_costs as $groups)
			{
				foreach($groups as $r)
				{
					$min = $r;
					$update = "UPDATE search_result SET min_cost = '".$min."' WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."'";
					$this->db->query($update);
					if($min=="")
					{
						$sel = "SELECT min(double_rate) as min_cost FROM search_result_rooms WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."' AND double_rate != 0";
						$query=$this->db->query($sel);
						$res=$query->result();
						if($res!='')
						{
							foreach($res as $groups1)
							{
								foreach($groups1 as $r1)
								{
									$min = $r1;
									$update = "UPDATE search_result SET min_cost = '".$min."' WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."'";
									$this->db->query($update);
								}
							}
						}
					}
				}
			}
		}
	}
	}
	else
	{
		
		if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.229')
		{
			$url1 = "https://192.168.0.229/dhaka/xml_xplorer_bd/search_rooms.php";
		}
		else
		{
			$url1 = "https://bdrooms.com/xml_xplorer_bd/search_rooms.php";
		}
		$hotels = $array['hotelresults']['result'];
		
		$supplier_id = $hotels['supplier_id'];
		if($supplier_id == $this->session->userdata('featured_sup_id'))
		{
			$hotel_id = $hotels['hotel_id'];
			$hotel_name = $hotels['hotel_name'];
			$hotel_address = $hotels['hotel_address'];
			$hotel_desc = $hotels['hotel_desc'];
			$loc_info = $hotels['loc_info'];
			$picture1 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture1'];
			$picture2 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture2'];
			$picture3 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture3'];
			$picture4 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture4'];
			$picture5 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture5'];
			$picture6 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture6'];
			$picture7 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture7'];
			$picture8 = "https://bdrooms.com/uploadimage/hotel/".$hotels['picture8'];
			$star_rate = $hotels['star_rate'];
			if($hotels['latitude'])
				{
					$latitude = $hotels['latitude'];
				}
				else
				{
					$latitude = '';
				}
				if($hotels['longitude'])
				{
					$longitude = $hotels['longitude'];
				}
				else
				{
					$longitude = '';
				}
				if($hotels['amenities'])
				{
					$amenities = $hotels['amenities'];
				}
				else
				{
					$amenities = '';
				}
				if($hotels['room_services'])
				{
					$compulsary_services = $hotels['room_services'];
				}
				else
				{
					$compulsary_services = '';
				}
				if($hotels['earliest_checkin'])
				{
					$earliest_checkin = $hotels['earliest_checkin'];
				}
				else
				{
					$earliest_checkin = '';
				}
				if($hotels['earliest_checkout'])
				{
					$earliest_checkout = $hotels['earliest_checkout'];
				}
				else
				{
					$earliest_checkout = '';
				}
				if($hotels['built'])
				{
					$built = $hotels['built'];
				}
				else
				{
					$built = '';
				}
				if($hotels['children_policy'])
				{
					$children_policy = $hotels['children_policy'];
				}
				else
				{
					$children_policy = '';
				}
				if($hotels['cancellation_policy'])
				{
					$cancellation_policy = $hotels['cancellation_policy'];
				}
				else
				{
					$cancellation_policy = '';
				}
				$hotel_commision = $hotels['hotel_commision'];
				$mobile_no = $hotels['mobile_no'];
				
				
				$ins = "INSERT INTO search_result(criteria_id,hotel_id,supplier_id,hotel_name,hotel_address,hotel_desc,
				loc_info,star_rate,picture1,picture2,picture3,picture4,picture5,picture6,picture7,picture8,latitude,
				longitude,amenities,compulsary_services,earliestcheckin,earliestcheckout,yearofbuilt,children_policy,
				cancellation_policy,hotel_commision,mobile_no)values('".$_SESSION['sec_res']."','".$hotel_id."','".$supplier_id."','".$hotel_name."','".$hotel_address."','".mysql_real_escape_string($hotel_desc)."','".$loc_info."','".$star_rate."','".$picture1."','".$picture2."','".$picture3."','".$picture4."','".$picture5."','".$picture6."','".$picture7."','".$picture8."','".$latitude."','".$longitude."','".$amenities."','".$compulsary_services."','".$earliest_checkin."','".$earliest_checkout."','".$built."','".$children_policy."','".$cancellation_policy."','".$hotel_commision."','".$mobile_no."')";
				
				//$ins = "INSERT INTO search_result(criteria_id,hotel_id,supplier_id,hotel_name,hotel_address,hotel_desc,loc_info,star_rate,picture1,picture2,picture3,picture4,picture5,picture6,picture7,picture8,latitude,longitude,amenities,compulsary_services,earliestcheckin,earliestcheckout,yearofbuilt,children_policy,cancellation_policy)values('".$_SESSION['sec_res']."','".$hotel_id."','".$supplier_id."','".$hotel_name."','".$hotel_address."','".mysql_real_escape_string($hotel_desc)."','".$loc_info."','".$star_rate."','".$picture1."','".$picture2."','".$picture3."','".$picture4."','".$picture5."','".$picture6."','".$picture7."','".$picture8."','".$latitude."','".$longitude."','".$amenities."','".$compulsary_services."','".$earliest_checkin."','".$earliest_checkout."','".$built."','".$children_policy."','".$cancellation_policy."')";
				
			$this->db->query($ins);
			$ch = curl_init();
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_URL,$url1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_POSTFIELDS,"supplier_id=".$supplier_id."&startdate=".$start_date."&enddate=".$end_date."&sec_res=".$sec_res."&days=".$days);
				$contentz1=curl_exec($ch);
				$array1=$this->xml2array2($contentz1);
				if(isset($array1['availablerooms']['result'][0]))
				{
					$availablerooms = $array1['availablerooms']['result'];
					foreach($availablerooms as $rooms)
					{
						$supplier_id = $rooms['supplier_id'];
						$roomid = $rooms['roomid'];
						$room_type_name = $rooms['room_type_name'];
						$max_persons = $rooms['max_persons'];
						$extra_beds = $rooms['extra_beds'];
						$single_rate = $rooms['single_rate'];
						//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
						$double_rate = $rooms['double_rate'];
						//$double_rate = $double_rate + (($hotel_commision * $double_rate)/100);
						$breakfast = $rooms['breakfast'];
						$date = $rooms['date'];
						$day = $rooms['day'];
						if($rooms['room_picture0'])
						{
							$room_picture0 = "https://bdrooms.com/uploadimage/room/".$rooms['room_picture0'];
						}
						else
						{
							$room_picture0 = '';
						}
						if($rooms['room_picture1'])
						{
							$room_picture1 = $rooms['room_picture1'];
						}
						else
						{
							$room_picture1 = '';
						}
						if($rooms['room_picture3'])
						{
							$room_picture3 = $rooms['room_picture3'];
						}
						else
						{
							$room_picture3 = '';
						}
						if($rooms['amenities_room'])
						{
							$amenities_room = $rooms['amenities_room'];
						}
						else
						{
							$amenities_room = '';
						}
						if($rooms['available_rooms'])
						{
							$available_rooms = $rooms['available_rooms'];
						}
						else
						{	
							$available_rooms = '';
						}
						$ins_room = "INSERT INTO search_result_rooms(criteria_id,roomid,room_type_name,max_persons,extra_beds,single_rate,double_rate,breakfast,room_picture0,room_picture1,room_picture2,amenities_room,supplier_id,available_rooms,date,day)values('".$_SESSION['sec_res']."','".$roomid."','".$room_type_name."','".$max_persons."','".$extra_beds."','".$single_rate."','".$double_rate."','".$breakfast."','".$room_picture0."','".$room_picture1."','".$room_picture2."','".$amenities_room."','".$supplier_id."','".$available_rooms."','".$date."','".$day."')";
						$this->db->query($ins_room);
					}
				}
				else
				{
					$rooms = $array1['availablerooms']['result'];
					$supplier_id = $rooms['supplier_id'];
					$roomid = $rooms['roomid'];
					$room_type_name = $rooms['room_type_name'];
					$max_persons = $rooms['max_persons'];
					$extra_beds = $rooms['extra_beds'];
					$single_rate = $rooms['single_rate'];
					//$single_rate = $single_rate + (($hotel_commision * $single_rate)/100);
					$double_rate = $rooms['double_rate'];
					//$double_rate = $double_rate + (($hotel_commision * $double_rate)/100);
					$breakfast = $rooms['breakfast'];
					$date = $rooms['date'];
					$day = $rooms['day'];
					if($rooms['room_picture0'])
					{
						$room_picture0 = $rooms['room_picture0'];
					}
					else
					{
						$room_picture0 = '';
					}
					if($rooms['room_picture1'])
					{
						$room_picture1 = $rooms['room_picture1'];
					}
					else
					{
						$room_picture1 = '';
					}
					if($rooms['room_picture3'])
					{
						$room_picture3 = $rooms['room_picture3'];
					}
					else
					{
						$room_picture3 = '';
					}
					if($rooms['amenities_room'])
					{
						$amenities_room = $rooms['amenities_room'];
					}
					else
					{
						$amenities_room = '';
					}
					if($rooms['available_rooms'])
					{
						$available_rooms = $rooms['available_rooms'];
					}
					else
					{	
						$available_rooms = '';
					}
					$ins_room = "INSERT INTO search_result_rooms(criteria_id,roomid,room_type_name,max_persons,extra_beds,single_rate,double_rate,breakfast,room_picture0,room_picture1,room_picture2,amenities_room,supplier_id,available_rooms,date,day)values('".$_SESSION['sec_res']."','".$roomid."','".$room_type_name."','".$max_persons."','".$extra_beds."','".$single_rate."','".$double_rate."','".$breakfast."','".$room_picture0."','".$room_picture1."','".$room_picture2."','".$amenities_room."','".$supplier_id."','".$available_rooms."','".$date."','".$day."')";
					$this->db->query($ins_room);
				}
				
					$min_costs =$this->Hotel_Model->fetch_min_price($_SESSION['sec_res'],$supplier_id);
	 
				
				
				foreach($min_costs as $groups)
				{
				
				foreach($groups as $r)
		{
			
					$min = $r;
					
					$update = "UPDATE search_result SET min_cost = '".$min."' WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."'";
					$this->db->query($update);
					echo $min;echo "<br>";
					if($min=="")
					{
					 $sel = "SELECT min(double_rate) as min_cost FROM search_result_rooms WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."' AND double_rate != 0";
						
						$query=$this->db->query($sel);
						$res=$query->result();
						if($res!='')
						{
							foreach($res as $groups1)
				{
				
				foreach($groups1 as $r1)
		{
			$min = $r1;
							$update = "UPDATE search_result SET min_cost = '".$min."' WHERE criteria_id='".$_SESSION['sec_res']."' AND supplier_id='".$supplier_id."'";
						$this->db->query($update);
		}
	}
							
						}
					}
				
				}
			}
		}
	}
		
		redirect('hotel/hotel_description/'.$hotel_id.'/1','refresh');
	}
	
	
	function xml2array2($contents, $get_attributes=1, $priority = 'tag') {
    if(!$contents) return array();

    if(!function_exists('xml_parser_create')) {
        //print "'xml_parser_create()' function not found!";
        return array();
    }

    //Get the XML parser of PHP - PHP must have this module for the parser to work
    $parser = xml_parser_create('');
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);

    if(!$xml_values) return;//Hmm...

    //Initializations
    $xml_array = array();
    $parents = array();
    $opened_tags = array();
    $arr = array();

    $current = &$xml_array; //Refference

    //Go through the tags.
    $repeated_tag_index = array();//Multiple tags with same name will be turned into an array
    foreach($xml_values as $data) {
        unset($attributes,$value);//Remove existing values, or there will be trouble

        //This command will extract these variables into the foreach scope
        // tag(string), type(string), level(int), attributes(array).
        extract($data);//We could use the array by itself, but this cooler.

        $result = array();
        $attributes_data = array();
        
        if(isset($value)) {
            if($priority == 'tag') $result = $value;
            else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode
        }

        //Set the attributes too.
        if(isset($attributes) and $get_attributes) {
            foreach($attributes as $attr => $val) {
                if($priority == 'tag') $attributes_data[$attr] = $val;
                else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
            }
        }

        //See tag status and do the needed.
        if($type == "open") {//The starting of the tag '<tag>'
            $parent[$level-1] = &$current;
            if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
                $current[$tag] = $result;
                if($attributes_data) $current[$tag. '_attr'] = $attributes_data;
                $repeated_tag_index[$tag.'_'.$level] = 1;

                $current = &$current[$tag];

            } else { //There was another element with the same tag name

                if(isset($current[$tag][0])) {//If there is a 0th element it is already an array
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                    $repeated_tag_index[$tag.'_'.$level]++;
                } else {//This section will make the value an array if multiple tags with the same name appear together
                    $current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array
                    $repeated_tag_index[$tag.'_'.$level] = 2;
                    
                    if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                        $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                        unset($current[$tag.'_attr']);
                    }

                }
                $last_item_index = $repeated_tag_index[$tag.'_'.$level]-1;
                $current = &$current[$tag][$last_item_index];
            }

        } elseif($type == "complete") { //Tags that ends in 1 line '<tag />'
            //See if the key is already taken.
            if(!isset($current[$tag])) { //New Key
                $current[$tag] = $result;
                $repeated_tag_index[$tag.'_'.$level] = 1;
                if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data;

            } else { //If taken, put all things inside a list(array)
                if(isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array...

                    // ...push the new element into that array.
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                    
                    if($priority == 'tag' and $get_attributes and $attributes_data) {
                        $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag.'_'.$level]++;

                } else { //If it is not an array...
                    $current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
                    $repeated_tag_index[$tag.'_'.$level] = 1;
                    if($priority == 'tag' and $get_attributes) {
                        if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                            
                            $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                            unset($current[$tag.'_attr']);
                        }
                        
                        if($attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken
                }
            }

        } elseif($type == 'close') { //End of tag '</tag>'
            $current = &$parent[$level-1];
        }
    }
    
    return($xml_array); 
	}
	function hotelspro_hotel_availabilty()
	{
		//exit;
		$room_used_type = $this->session->userdata('room_used_type');
		$sd = $this->session->userdata('sd');
		$room_count = $this->session->userdata('room_count');
		$ed = $this->session->userdata('ed');
		$city_code = $this->session->userdata('dest_code');
		$cin = $this->session->userdata('cin');
		$cout =  $this->session->userdata('cout');
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
			if($room_used_type[$k]=='sb')
			{
				
				$sb_room_cnt =$sb_room_cnt + 1;
			}
			if($room_used_type[$k]=='db')
			{
				
				$db_room_cnt =$db_room_cnt + 1;
			}
			if($room_used_type[$k]=='dbc')
			{
				
				$dbc_room_cnt =$dbc_room_cnt + 1;
			}
			if($room_used_type[$k]=='dbcc')
			{
				$dbcc_room_cnt =$dbcc_room_cnt + 1;
			}
			if($room_used_type[$k]=='tr')
			{
				$tb_room_cnt =$tb_room_cnt + 1;
			}
			if($room_used_type[$k]=='qu')
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
		//echo '<pre>'; print_r($rooms);
		$_SESSION['pro_search_id'] ='';
		$client = new SoapClient( "http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1, 'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP));
  		try
		{
		 	$filters = array();
	  		$filters[] = array("filterType" => "boardType", "filterValue" => "BB");
      		$checkAvailability = $client->getAvailableHotel("V2ZXQTA4RFRjMVducExBSzU5djdUUUExYmJYQ0NrQmk2c1lQYjhnOWxyZk1GUnF1SVlOamRRMjd0OVBOSFZiRw==", $city_code, $cin, $cout, "USD", "US", "false", $rooms,$filters);
  		}
	 	catch (SoapFault $exception)
		{
      		echo $exception->getMessage();
      		exit;
  		}
  		//echo '<pre>';print_r($checkAvailability); exit;
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
				 $comm=$this->Hotel_Model->get_comm_admin1();
			$api="hotelspro";	
			 $totalcost_m_m = $totalPrice;
			$roomtype=implode("<br>",$roomCategory);
			
	  		$totalRoomRate=implode("-",$totalcost_m_m_ddn);
	  	

$totalRoomRate = $totalRoomRate + ($totalRoomRate*$comm)/100;
	  		
		    $sec_res=$this->session->userdata('ses_id');
	  		$adult =  $this->session->userdata('org_adult');
			$child =  $this->session->userdata('org_child');
			$this->Hotel_Model->insert_gta_temp_result($sec_res,'hotelspro',$hotelCode,$processId,$roomtype,$totalRoomRate,
			$availabilityStatus,$boardType,$adult,$child);   
			  	  }
			  	  //exit;
			//$tmp_data = $this->Hotel_Model->fetch_search_result($sec_res);
		    //$data['result'] = $tmp_data['result'];
			//$this->load->view('search_result',$data);
			
			//$this->load->view('load_page');
			
			redirect('hotel/search_result','refresh');
  	}
	function search_result($id=false)
	{
	
		ini_set('max_execution_time', 0);
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
		$sec_res=$this->session->userdata('ses_id');
		
		$data['view_details']=$view_details = $this->Hotel_Model->fetch_last_viewd_deta($sec_res);
		$tmp_data1 = $this->Hotel_Model->fetch_search_result($sec_res);
	
	$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result";
        $config["total_rows"] = count($tmp_data1['result']);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_page($sec_res,$config["per_page"], $page);
        
        $data["links"] = $this->pagination->create_links();
		//echo "<pre>"; print_r($tmp_data); exit;
		$data['result'] = $tmp_data['result'];
		if($tmp_data1['result']!='')
		{
			foreach($tmp_data1['result'] as $res)
				{
				 $cost[]= $res->low_cost;	
				}
				$data['minimum']= min($cost);
		$data['maximum']= max($cost);
		$this->session->set_userdata(array("minimum"=>$data['minimum'],"maximum"=>$data['maximum']));
		
		
	}
	else
	{
		$data['minimum']= '';
		$data['maximum']= '';
		
	}
	//echo "<pre>"; print_r($data); exit;
		$this->load->view('search_result',$data);
	}
	
	function search_result_hotel($id=false)
	{
		if($id!='')
		{
		$data['page_num']=$page_num= $id;	
		}
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->get_result($sec_res);
	$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_hotel";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->get_result($sec_res,$config["per_page"], $page);
        
        $data["links"] = $this->pagination->create_links();
		//echo "<pre>"; print_r($tmp_data1); exit;
		$data['result'] = $tmp_data;
		foreach($tmp_data1 as $res)
		{
		 $cost[]= $res->min_cost;	
		}
		 $data['min_price']= min($cost);
		$data['max_price']= max($cost);
		$this->session->set_userdata(array("minprice"=>$data['min_price'],"maxprice"=>$data['max_price']));
		$this->load->view('best_result_hotels',$data);
		
	}
	
	function search_result_pltoh($id=false)
	{
		
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
	
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_ptol($sec_res);
		$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_pltoh";
        $config["total_rows"] = count($tmp_data1['result']);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_ptol_page($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data['result'];
		$data['minimum']=$this->session->userdata('minimum');
		$data['maximum']=$this->session->userdata('maximum');
		$this->load->view('search_result',$data);
		
	}
	function search_result_hotel_pltoh($id=false)
	{
		
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
	
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_hotel_ptol($sec_res);
		$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_hotel_pltoh";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_hotel_ptol($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data;
		$data['min_price']=$this->session->userdata('minprice');
		$data['max_price']=$this->session->userdata('maxprice');
		$this->load->view('best_result_hotels',$data);
		
	}
	function search_result_hotel_sltoh($id=false)
	{
		
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
	
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_hotel_sltoh($sec_res);
		$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_hotel_sltoh";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_hotel_sltoh($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data;
		$data['min_price']=$this->session->userdata('minprice');
		$data['max_price']=$this->session->userdata('maxprice');
		$this->load->view('best_result_hotels',$data);
		
	}
	
	function search_result_hotel_shtol($id=false)
	{
		
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
	
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_hotel_shtol($sec_res);
		$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_hotel_shtol";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_hotel_shtol($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data;
		$data['min_price']=$this->session->userdata('minprice');
		$data['max_price']=$this->session->userdata('maxprice');
		$this->load->view('best_result_hotels',$data);
		
	}
	
	function search_result_hotel_altoh($id=false)
	{
		
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
	
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_hotel_altoh($sec_res);
		$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_hotel_altoh";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_hotel_altoh($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data;
		$data['min_price']=$this->session->userdata('minprice');
		$data['max_price']=$this->session->userdata('maxprice');
		$this->load->view('best_result_hotels',$data);
		
	}
	function search_result_hotel_alhol($id=false)
	{
		
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
	
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_hotel_ahtol($sec_res);
		$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_hotel_alhol";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_hotel_ahtol($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data;
		$data['min_price']=$this->session->userdata('minprice');
		$data['max_price']=$this->session->userdata('maxprice');
		$this->load->view('best_result_hotels',$data);
		
	}
	
	function search_result_hotel_pHtoL($id=false)
	{
		
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
	
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_hotel_pHol($sec_res);
		$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_hotel_pHtoL";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_hotel_pHol($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data;
		$data['min_price']=$this->session->userdata('minprice');
		$data['max_price']=$this->session->userdata('maxprice');
		$this->load->view('best_result_hotels',$data);
		
	}
	function sort_by_facilty($id=false)
	{
	   	
		header('Cache-Control: max-age=900');
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
	
		$sec_res=$this->session->userdata('ses_id');
		if($this->input->post('facility')!='')
		{
		$data['facvalue'] = $fac=$this->input->post('facility');
		
		$tmp_data1 = $this->Hotel_Model->fetch_sort_by_facilty($sec_res,$fac);
		$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/sort_by_facilty";
        $config["total_rows"] = count($tmp_data1['result']);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_sort_by_facilty($sec_res,$fac,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data['result'];
		$data['minimum']=$this->session->userdata('minimum');
		$data['maximum']=$this->session->userdata('maximum');
		$this->load->view('search_result',$data);
	}
	else
	{
		redirect('hotel/search_result','refresh');
		
	}
		
	
	}
	
	function search_result_altoh($id=false)
	{
		
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
	
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_altoh($sec_res);
			$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_altoh";
        $config["total_rows"] = count($tmp_data1['result']);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_altoh_price($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data['result'];
		$data['minimum']=$this->session->userdata('minimum');
		$data['maximum']=$this->session->userdata('maximum');
		$this->load->view('search_result',$data);
		
	}
	
	function search_result_alhol($id=false)
	{
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_ahtol($sec_res);
				$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_alhol";
        $config["total_rows"] = count($tmp_data1['result']);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_ahtol($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data['result'];
		$data['result'] = $tmp_data['result'];
		$data['minimum']=$this->session->userdata('minimum');
		$data['maximum']=$this->session->userdata('maximum');
		$this->load->view('search_result',$data);
		
	}
	
	function search_result_sltoh($id=false)
	{
		if($id!='')
	{
	$data['page_num']=$page_num= $id;	
	}
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_sltoh($sec_res);
			$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_sltoh";
        $config["total_rows"] = count($tmp_data1['result']);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_sltoh_price($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data['result'];
		$data['minimum']=$this->session->userdata('minimum');
		$data['maximum']=$this->session->userdata('maximum');
		$this->load->view('search_result',$data);
		
	}
	
	function search_result_shtol($id=false)
	{
		if($id!='')
		{
		$data['page_num']=$page_num= $id;	
		}
		$sec_res=$this->session->userdata('ses_id');
		
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_shtol($sec_res);
					$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/search_result_shtol";
        $config["total_rows"] = count($tmp_data1['result']);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_shtol_price($sec_res,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data['result'];
		$data['minimum']=$this->session->userdata('minimum');
		$data['maximum']=$this->session->userdata('maximum');
		$this->load->view('search_result',$data);
		
	}
	
	function sort_by_slider($id=false)
	{
		header('Cache-Control: max-age=900');
		if($id!='')
		{
		 	$data['page_num']=$page_num= $id;	
		}
		
		$sec_res=$this->session->userdata('ses_id');
		if($this->input->post('min_pr')!='')
		{
			 $data['min_pr']=$min_pri=$this->input->post('min_pr');
		}
		else
		{
		   $data['min_pr']=$min_pri=$this->session->userdata('minpr');
		}
		if($this->input->post('max_pr')!='')
		{
		 	$data['max_pr']=$max_pr=$this->input->post('max_pr');
		}
		else
		{
			$data['max_pr']=$max_pr=$this->session->userdata('maxpr');
		}
		 $this->session->set_userdata(array("minpr"=>$min_pri,"maxpr"=>$max_pr));
		 $tmp_data1 = $this->Hotel_Model->fetch_search_result_sBYp($sec_res,$limit='',$page1='', $page=1, $minVal = $min_pri, $maxVal = $max_pr, $minStar = 0, $maxStar = 5, $fac = '', $sorting='');
		
		$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/sort_by_slider";
        $config["total_rows"] = count($tmp_data1['result']);
	    $config["per_page"] = 20;
      	$config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page1 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_sBYp($sec_res,$config["per_page"], $page1, $page=1, $minVal = $min_pri, $maxVal = $max_pr, $minStar = 0, $maxStar = 5, $fac = '', $sorting='');
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data['result'];
		
		$data['minimum']=$this->session->userdata('minimum');
		$data['maximum']=$this->session->userdata('maximum');
		$this->load->view('search_result',$data);	
	
	
	}
	
	function sort_by_price($id=false)
	{
		header('Cache-Control: max-age=900');
		if($id!='')
		{
		$data['page_num']=$page_num= $id;	
		}
		
	$sec_res=$this->session->userdata('ses_id');
	if($this->input->post('pricevalue'))
	{
	 	   $data['price_value']=$this->input->post('pricevalue');
		
		$pricevalue=explode("-",$this->input->post('pricevalue'));
		 $tmp_data1 = $this->Hotel_Model->fetch_search_result_sBYp($sec_res,$limit='',$page1='', $page=1, $minVal = $pricevalue[0], $maxVal = $pricevalue[1], $minStar = 0, $maxStar = 5, $fac = '', $sorting='');
		
			$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/sort_by_price";
        $config["total_rows"] = count($tmp_data1['result']);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page1 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_sBYp($sec_res,$config["per_page"], $page1, $page=1, $minVal = $pricevalue[0], $maxVal = $pricevalue[1], $minStar = 0, $maxStar = 5, $fac = '', $sorting='');
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data['result'];
		$this->load->view('search_result',$data);	
	}
	else
	{
	   redirect('hotel/search_result','refresh');	
	}
	}
	function sort_by_star()
	{
		
	header('Cache-Control: max-age=900');
	$sec_res=$this->session->userdata('ses_id');
	if($this->input->post('strvalue')!='')
	{
		$data['strvalue']=$strvalue=$this->input->post('strvalue');
		$tmp_data1 = $this->Hotel_Model->fetch_search_result_sBYs($sec_res,$limit='',$start='', $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='', $str_value=$strvalue);
			$data['totalresult'] =$tmp_data1['result'];
		$config = array();
        $config["base_url"] = base_url() . "hotel/sort_by_star";
        $config["total_rows"] = count($tmp_data1['result']);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_search_result_sBYs($sec_res,$config["per_page"], $page, $page=1, $minVal = '', $maxVal = '', $minStar = 0, $maxStar = 5, $fac = '', $sorting='', $str_value=$strvalue);
        $data["links"] = $this->pagination->create_links();
		$data['result'] = $tmp_data['result'];
		$data['minimum']=$this->session->userdata('minimum');
		$data['maximum']=$this->session->userdata('maximum');
		$this->load->view('search_result',$data);	
		}
	else
	{
	   redirect('hotel/search_result','refresh');	
	}
	}
	function hp_reserv()
	{
		
	$this->load->view('hp_reserv');
	}
	function mapping_detail($id)
	{
		$data['flag'] ='1';
		$service=$this->Hotel_Model->get_searchresult($id);
		$data['result_id']=$id;
		$data['result']=$this->Hotel_Model->fetch_search_result_map_new_select($id);
		
		$api = $service->api;
		$hotel_code = $service->HotelCode;
		$hotel_name = $service->HotelName;
		$star = $service->StarRating;
		$image = $service->HotelImages1;
		$data['service']=$service;
		$sec_res=$this->session->userdata('ses_id');
				
			$data['hotel_facility'] = $this->Hotel_Model->get_facility_details_hotel($hotel_code);
			$data['room_facility'] = $this->Hotel_Model->get_facility_details_room($hotel_code);
			
			
			$data['hotelCode']=$hotel_code;
			
			$data['star']=$service->StarRating;
			$data['phone']=$service->HotelPhoneNumber;
			$data['location']=$service->HotelArea;
			
			
			$data['lat']=$service->Latitude;
			$data['long']=$service->Longitude;
			$data['hotel_name']=$service->HotelName;
			
			$data['description'] = $service->HotelInfo;
			$data['address'] = $service->HotelAddress;
			$data['dest'] = $service->Destination;
			
			$data['result_id']=$id;
			$data['cur_id'] = $id;
			$data['api'] = 'gta';
		
		$this->load->view('hotel/hotel_detail_search',$data);
		
		
	}
	function mapping_photo($id)
	{
		$data['result_id']=$id;
		$result=$this->Hotel_Model->fetch_search_result_map_new_select($id);
		 $api = $result[0]['api'];
		$hotel_code = $result[0]['hotel_code'];
		if($api=='hotelsbed')
			{
			$hotel_image= $this->Hotel_Model->gethb_hotelimage_new($hotel_code);
		    if($hotel_image!="")
			{
				$img1=array();
				for($i=0;$i< count($hotel_image); $i++)
				{
					 $img=$hotel_image[$i]->IMAGEPATH;
					 $img1[]= "http://www.hotelbeds.com/giata/" . $img;
				}
				$data['img_array']=$img1;
			}
			else
			{
				$img1="";
				$data['img_array']="";
			}	
			}
			elseif($api=='gta')	
			{
				$data['img_array'][]= WEB_DIR.'image_gta/'.$hotel_code.'.jpg';
			}
			elseif($api=='travco')	
			{
					$hotel_image= $this->Hotel_Model->gethb_hotelimage_new_travco($hotel_code);
					if($hotel_image!="")
					{
						$img1=array();
						for($i=0;$i< count($hotel_image); $i++)
						{
							 $img=$hotel_image[$i]->path;
							 $img1[]= "http://www.travco.co.uk/images/hotel_pics" . $img;
						}
						$data['img_array']=$img1;
					}
					else
					{
						$img1="";
						$data['img_array']="";
					}	
			}
			elseif($api=='hotelspro')
			{
			$hotel_image= $this->Hotel_Model->gethb_hotelimage_new_pro($hotel_code);
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
			}

		$this->load->view('hotel/hotel_photo',$data);
		
	}
	
	function hotel_details()
	{
		$this->load->view('hotel_room_deails');
	 	
	}
	function reservation_hotel($result_id)
	{	
		header('Cache-Control: max-age=900');
		$room_count = $this->session->userdata('room_count');
		$sec_res=$this->session->userdata('ses_id');
		if($room_count == 1)
		{
			
			$service=$this->Hotel_Model->get_searchresult($result_id);
			//echo "<pre>"; print_r($service);exit;
			$api = $service->api;
			$hotel_code = $service->HotelCode;
			$hotel_name = $service->HotelName;
			$star = $service->StarRating;
			$image = $service->HotelImages1;
			$data['service']=$service;
			$sec_res=$this->session->userdata('ses_id');
			$data['result_id']=$result_id;
			$rm_info=array();
		    $rm_info[]=$this->Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res,$result_id);
			$data['room_info'] = $rm_info;
		}
		else
		{
			$result_id1 = explode("-",$result_id);
			$service=$this->Hotel_Model->get_searchresult($result_id1[0]);
			$api = $service->api;
			$hotel_code = $service->HotelCode;
			$hotel_name = $service->HotelName;
			$star = $service->StarRating;
			$image = $service->HotelImages1;
			$data['service']=$service;
			$sec_res=$this->session->userdata('ses_id');
			$data['result_id']=$result_id;
			$rm_info=array();
			for($r=0;$r< count($result_id1);$r++)
			{
			 $rm_info[]=$this->Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res,$result_id1[$r]);
			}
			
			$data['room_info'] = $rm_info;
		
		}
		if($api=='hotelspro')
		{
			$pre = $this->Hotel_Model->insert_last_viewed($sec_res,$hotel_name,$hotel_code);
			$pre = $this->Hotel_Model->get_pro_pre_detail_hotelspro($result_id);
			$hotel_proid = $pre->room_code;
			$data['tot']= $pre->total_cost;
			$data['usd']= $pre->total_cost;
			$data['share_cost']=$pre->total_cost;
			$data['pro_room_type']= $pre->room_type;;
			$without_markup=$pre->total_cost;
			$data['inc']=$pre->inclusion;
			/*$client = new SoapClient("http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1));
   			$processId=$hotel_proid;*/
			$hotel_image= $this->Hotel_Model->gethb_hotelimage_new_pro($hotel_code);
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
			$client = new SoapClient("http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1));
			try
			{
				$pid=$this->session->userdata('searchId');;
				$hid=$hotel_code;
				$filters = array();
	  		$filters[] = array("filterType" => "boardType", "filterValue" => "BB");
			    $allocateHotelCode = 
			    $client->allocateHotelCode("V2ZXQTA4RFRjMVducExBSzU5djdUUUExYmJYQ0NrQmk2c1lQYjhnOWxyZk1GUnF1SVlOamRRMjd0OVBOSFZiRw==",$pid,$hid);
			}
            catch (SoapFault $exception) 
			{
				
                $data['errordesc'] = $exception->getMessage();
             } 
			if($data['errordesc']!='')
			{
                    $data['error']=$data['errordesc'];
                   $this->load->view('error_page',$data);                   
			}
			else
			{
				$this->Hotel_Model->delete_already_hotels($this->session->userdata('ses_id'),$hid);
                if (is_object($allocateHotelCode->availableHotels)) 
                {
					$availableHotels[] = $allocateHotelCode->availableHotels;
				}
				else
				{
					$availableHotels = $allocateHotelCode->availableHotels;
				}
			}
			//echo '<pre>'; print_r($availableHotels);exit;
			if(isset($availableHotels))
		{
			foreach ((array)$availableHotels as $hnum => $hotel) 
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
			 $comm=$this->Hotel_Model->get_comm_admin1();
			$api="hotelspro";	
			$totalcost_m_m = $totalPrice;
			$roomtype=implode("<br>",$roomCategory);
	  		$totalRoomRate=implode("-",$totalcost_m_m_ddn);
	  		
	  		 $totalRoomRate = $totalRoomRate + ($totalRoomRate*$comm)/100;
		    $sec_res=$this->session->userdata('ses_id');
	  		$adult =  $this->session->userdata('org_adult');
			$child =  $this->session->userdata('org_child');
			$reserv = $this->Hotel_Model->insert_gta_temp_result($sec_res,'hotelspro',$hotelCode,$processId,$roomtype,$totalRoomRate,$availabilityStatus,$boardType,$adult,$child);   
			  	  }
 		
		
		//$this->load->view('hotel/reservation_form_hotelspro',$data);
		redirect('hotel/reserv/'.$reserv,'refresh');
  }
  else
  {
	  redirect('hotel/search_result','refresh');
	  
	}
		}
		
		
	}
	function reserv($result_id)
	{
		header('Cache-Control: max-age=900');
		$room_count = $this->session->userdata('room_count');
		if($room_count == 1)
		{
			
			$service=$this->Hotel_Model->get_searchresult($result_id);
			//echo "<pre>"; print_r($service);exit;
			$api = $service->api;
			$hotel_code = $service->HotelCode;
			$hotel_name = $service->HotelName;
			$star = $service->StarRating;
			$image = $service->HotelImages1;
			$data['service']=$service;
			$sec_res=$this->session->userdata('ses_id');
			$data['result_id']=$result_id;
			$rm_info=array();
		    $rm_info[]=$this->Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res,$result_id);
			$data['room_info'] = $rm_info;
		}
		else
		{
			$result_id1 = explode("-",$result_id);
			$service=$this->Hotel_Model->get_searchresult($result_id1[0]);
			$api = $service->api;
			$hotel_code = $service->HotelCode;
			$hotel_name = $service->HotelName;
		 $data['star']=$star = $service->StarRating;
			$image = $service->HotelImages1;
			$data['service']=$service;
			$sec_res=$this->session->userdata('ses_id');
			$data['result_id']=$result_id;
			$rm_info=array();
			for($r=0;$r< count($result_id1);$r++)
			{
			 $rm_info[]=$this->Hotel_Model->fetch_gta_temp_result_room_result_id($sec_res,$result_id1[$r]);
			}
			
			$data['room_info'] = $rm_info;
		
		}
		$hotel_image= $this->Hotel_Model->gethb_hotelimage_new_pro($hotel_code);
		
		$data['hotel_facility'] = $this->Hotel_Model->get_facility_details_hotel($hotel_code);
	
			$data['room_facility'] = $this->Hotel_Model->get_facility_details_room($hotel_code);
		    if($hotel_image!="")
			{
				$img1=array();
				$img1[] = $hotel_image->HotelImages1;
				$img1[] = $hotel_image->HotelImages2;
				$img1[] = $hotel_image->HotelImages3;
				$img1[] = $hotel_image->HotelImages4;
				$img1[] = $hotel_image->HotelImages5;
				$img1[] = $hotel_image->HotelImages6;
				$img1[] = $hotel_image->HotelImages7;
				$img1[] = $hotel_image->HotelImages8;
				$img1[] = $hotel_image->HotelImages9;
				$img1[] = $hotel_image->HotelImages10;
				$data['img_array']=$img1;
			}
			else
			{
				$img1="";
				$data['img_array']="";
			}
		
			
		$data['HOTELNAME'] = $service->HotelName;
		$data['desc'] = $service->HotelAddress;
		$data['HotelInfo'] = $service->HotelInfo;
		$data['HotelArea'] = $service->HotelArea;
		/*$data['amount_deposit'] = $this->Agent_Model->get_amount_deposit($this->session->userdata('agent_id'));*/
		 $data['StNAME'] = $service->HotelAddress;
		$data['StPIN'] = $service->HotelPostalCode;
		$data['hb_phone'] = $service->HotelPhoneNumber;
		$this->load->view('reservation_form_hotelspro',$data);
	}
	function booking_form_hotelspro($roomid=false,$hcode=false)
	{
		if($this->input->post('selected_room_id')!='')
		{
			$data['result_id']=$result_id = $this->input->post('selected_room_id');
		}
		else
		{
			$result_id =$roomid;
		}
		if($this->input->post('hotel_code')!='')
		{
			$data['hotel_code']=$hotel_code = $this->input->post('hotel_code');
		}
         else
		{
			$hotel_code =$hcode;
		}
	 $pre = $this->Hotel_Model->get_pro_pre_detail_hotelspro($result_id);
	$service=$this->Hotel_Model->get_searchresult($result_id);
	$data['service']=$service;
			$hotel_proid = $pre->room_code;
			$data['tot']= $pre->total_cost;
			$data['usd']= $pre->total_cost;
			$data['share_cost']=$pre->total_cost;
			$data['pro_room_type']= $pre->room_type;;
			$without_markup=$pre->total_cost;
			$data['inc']=$pre->inclusion;
			$client = new SoapClient("http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1));
   			$processId=$hotel_proid;
			$hotel_image= $this->Hotel_Model->gethb_hotelimage_new_pro($hotel_code);
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
 			try
			{
				$data['errordesc']='';
				$getHotelCancellationPolicy = $client->getHotelCancellationPolicy("V2ZXQTA4RFRjMVducExBSzU5djdUUUExYmJYQ0NrQmk2c1lQYjhnOWxyZk1GUnF1SVlOamRRMjd0OVBOSFZiRw==", $processId);
			}
			catch (SoapFault $exception)
			{
				$data['errordesc'] = $exception->getMessage();
			} 
			//echo $data['errordesc'];exit;
			if($data['errordesc']!='')
  			{
				$data['error']=$data['errordesc'];
				$this->load->view('error_page',$data);
			}
  			else
		  {
	//echo "<pre>"; print_r($$getHotelCancellationPolicy);exit;
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
   //  $policy->remarks;
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
        $data['cancel_policy']=$cancel;
		//$data['api_countries'] = $this->Agent_Model->get_api_countries();
		//$data['bal'] = $bl = $this->Agent_Model->get_bal($this->session->userdata('agent_id'));
      //	$data['agent'] = $this->Agent_Model->get_details($this->session->userdata('agent_id'));
		//$data['def_cur'] = $this->Agent_Model->get_def_val();
		//$data['country'] = $this->Agent_Model->get_country();
		$data['HOTELNAME'] = $service->HotelName;
		$data['desc'] = $service->HotelInfo;
		//$data['amount_deposit'] = $this->Agent_Model->get_amount_deposit($this->session->userdata('agent_id'));
		$data['StNAME'] = $service->HotelAddress;
		$data['StPIN'] = $service->HotelPostalCode;
		$data['hb_phone'] = $service->HotelPhoneNumber;
		 if($this->session->userdata('memberid')!='')
    {
		$memberid=$this->session->userdata('memberid');
		$data['member_info']=$this->Home_Model->member_last_login($memberid);
	}
		$this->load->view('hp_reserv',$data);
		  }
	}
	function insert_customer_details()
	{
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$natiomality = $this->input->post('natiomality');
		 $city = $this->input->post('city');
		$trns_id =  time();
		//echo count($fname);exit;
		$amount = $this->input->post('booked_amount_gta');
		 for($i=0; $i< count($fname); $i++)
		 {
			$data1 = array(
				 'last_name' => $lname[$i], 
				 'first_name' => $fname[$i],
				 'parent_id' => $trns_id
				 
			);
			
			$this->db->insert('customer_info_details', $data1);//adult_booking_details 
			 $customer_info_details_id = $this->db->insert_id();
			 $data['surname_co']=$lname[0];
		$data['name_co']=$fname[0];
		$data['phone_co']=$this->input->post('contactno');
		$data['email_co']=$this->input->post('mailaddress');
		$data4 = array(
					 'last_name' => $data['surname_co'], 
					 'first_name' => $data['name_co'],
					 'mobile' => $data['phone_co'],
					 'email' => $data['email_co'],
					 'customer_info_details_id ' =>$customer_info_details_id,
					 'city' => $city
				);
		$this->db->insert('customer_contact_details', $data4); 
		$parent_customer_id = $this->db->insert_id();
		$data5 = array(
		 'product_id' => 2,
		 'amount' => $amount,
		 'customer_contact_details_id' => $parent_customer_id, 
		 'created_date' => date("Y-m-d")
	);
	
	$this->db->insert('transaction_details', $data5);
	$data['customer_info_details_id'] = $customer_info_details_id;
	$data['result_id'] = $this->input->post('result_id');
		$data['hotelcode'] = $this->input->post('hotelcode');
			//echo '<pre>'; print_r($data);exit;
			$this->session->set_userdata(array('booking_resultid'=>$data['result_id'],'booking_hotelcode'=>$data['hotelcode'],'booking_customer_info_details_id'=>$data['customer_info_details_id']));
			$this->load->view('payment',$data);
			
		}
	}
	function paymet_verify()
	{
		
	}
	 function hotelspro_booking()
	{
		header('Cache-Control: max-age=900');
		$result_id = $this->input->post('result_id');
		$hotelcode = $this->input->post('hotelcode');
		if($this->session->userdata('memberid')!='')
		{
			
		   	$email=$this->input->post('email');
				$password=$this->input->post('password');
				$res=$this->Home_Model->check_member_login($email,$password);
				
		if($res!='')
		{
		
	   $memid= $res->MEMcode;
		$this->session->set_userdata(array('memberid'=>$memid));
		$search=$this->Hotel_Model->get_cancel_attrib_new($result_id);
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$natiomality = $this->input->post('natiomality');
		 $city = $this->input->post('city');
		$trns_id =  time();
		//echo count($fname);exit;
		$amount = $this->input->post('booked_amount_gta');
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
		$data['phone_co']=$this->input->post('contactno');
		$data['email_co']=$this->input->post('mailaddress');
		$data4 = array(
					 'last_name' => $data['surname_co'], 
					 'first_name' => $data['name_co'],
					 'mobile' => $data['phone_co'],
					 'email' => $data['email_co'],
					 'customer_info_details_id ' =>$customer_info_details_id,
					 'city' => $city
				);
		$this->db->insert('customer_contact_details', $data4); 
		$parent_customer_id = $this->db->insert_id();
		$user_id=$this->session->userdata('agent_id');
		$data5 = array(
		 'product_id' => 2,
		 'user_id' => $user_id,
		 'amount' => $amount,
		 'customer_contact_details_id' => $parent_customer_id, 
		 'created_date' => date("Y-m-d")
	);
	
	$this->db->insert('transaction_details', $data5); //exit;
	$parent_transaction_id = $this->db->insert_id();
	$room_count = $this->session->userdata('room_count');
		//if($room_count == 1)
		//{
		
			$service=$this->Hotel_Model->get_searchresult($result_id);
			$h_hotel_id = $service->HotelCode;
			$h_hotel_name = $service->HotelName;
			$h_star = $service->StarRating;
			$h_description = $service->HotelInfo;
			$h_address = $service->HotelAddress;
			$h_city = $service->Destination;
			$h_phone = $service->HotelPhoneNumber;
			$h_fax = '';
			$trans_id = $parent_customer_id;
	 		$contact_info=$this->Hotel_Model->contact_info_detail_update($trans_id);
           $con_id = $contact_info->customer_info_details_id;
	 		$pass_info=$this->Hotel_Model->pass_info_detail($trns_id);
			$con_id_org =$contact_info->customer_contact_details_id;
	
	//echo "<pre>"; print_r($search);
	//echo "<pre>"; print_r($pass_info);exit;
		$adults=$search->adult;
		$child=$search->child;
		$roomcat=$search->room_code;
		$hotel_id=$search->hotel_code;
		$roomcountss=$this->session->userdata('room_count');
		$noofdays=$this->session->userdata('days');
		$data['guestadult']= $this->session->userdata('adult_count');
		$data['guestchild']= $this->session->userdata('child_count');
		$address=$contact_info->city;
		$cin=date("Y-m-d", strtotime($this->session->userdata('sd')));
		$cout=date("Y-m-d", strtotime($this->session->userdata('ed')));
		$noofroom= $this->session->userdata('room_count');
		$child= $this->session->userdata('child_count');
		$adult= $this->session->userdata('adult_count');
		$api='hotelspro';
		$fname1=$pass_info[0]->first_name;			 
		$lname1=$pass_info[0]->last_name;			
		$roomusedtypeval= $this->session->userdata('room_used_type');
		$roomcount= $this->session->userdata('room_count');
		$result_id=$result_id;
		$email = $contact_info->email;
		$nameval='';
		$m=1;
		$j=0;
		$adult=0;
		$child=0;
		//$lname1=$fname1;
 		$room_used_type = $this->session->userdata('room_used_type');
		$city = $this->session->userdata('city_name');
		//.', '.$this->session->userdata('country_name')
		$sd = $this->session->userdata('sd');
		$room_count = $this->session->userdata('room_count');
		$ed = $this->session->userdata('ed');
		$city_val = $this->Hotel_Model->get_city_code($city);
		//echo "<pre>"; print_r($city_val);exit;  
		//$citycode = $city_val->hotelspro;
		$citycode = $city_val->DestinationId;
		$sb_room_cnt =0;
		$db_room_cnt =0;
		$tb_room_cnt =0;
		$q_room_cnt =0;
		$dbc_room_cnt =0;
		$dbcc_room_cnt =0;
		$room1='';
		$hotelbed_rooms='';
		$bookroom='';
		$PFirstNamevalue= 'Mr.'.' '.$fname1.' '.$lname1;
      	$leadTravellerInfo = array();
      	$paxInfo = array("paxType" => "Adult", "title" => 'Mr', "firstName" => $fname1, "lastName" => $lname1);
		//echo "<pre>"; print_r($paxInfo);exit;
		$leadTravellerInfo = $paxInfo;
	  	$leadTravellerInfo["paxInfo"] = $paxInfo;
	  	$leadTravellerInfo["nationality"] = "US";
		$otherTravellerInfo = array();
        $processId=$search->room_code;
		//echo count($pass_info);exit;
   		if(count($pass_info)>1)
   		{
			for($i=1;$i< count($pass_info);$i++)
			{
				  $otherTravellerInfo[] = array("title" => 'Mr', "firstName" => $pass_info[$i]->first_name, "lastName" => $pass_info[$i]->last_name);
			}
   		}
   		else
   		{
	    	$otherTravellerInfo='';
   		}
//echo "<pre>"; print_r($otherTravellerInfo);exit;
	$preferences = "";
      $note = "";
	   $agencyReferenceNumber = 'QF9787';
	
		 $client = new SoapClient("http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1));
		// echo "<pre>"; print_r($client);exit;
  
  try {
 
	   $data['errordesc']='';
	   $makeHotelBooking = $client->makeHotelBooking("V2ZXQTA4RFRjMVducExBSzU5djdUUUExYmJYQ0NrQmk2c1lQYjhnOWxyZk1GUnF1SVlOamRRMjd0OVBOSFZiRw==", $processId, $agencyReferenceNumber, $leadTravellerInfo,$otherTravellerInfo,  $preferences, $note);
    //  echo "<pre>"; print_r($makeHotelBooking);exit;
      $hotel = $makeHotelBooking->hotelBookingInfo;
      $rooms = is_array($hotel->rooms) ? $hotel->rooms : array($hotel->rooms);
      $policies = is_array($hotel->cancellationPolicy) ? $hotel->cancellationPolicy : array($hotel->cancellationPolicy);
    }
	 catch (SoapFault $exception) {
	 
      $data['errordesc'] = $exception->getMessage();
     
  }
//  echo "<pre>"; print_r($data['errordesc']);exit;
   if($data['errordesc']!='')
  {
	  $data['error']=$data['errordesc'];
	  //echo "<pre>"; print_r($data['error']); exit;
  	   $this->load->view('error_page',$data);
	 
  }
  else
  {
   
 //echo $hotel->bookingStatus;exit;
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
/*			
if($cutype=='Percent')
{
	
	$cancelamount=($_REQUEST['amount']/100)*$val2;
	
}
else
{
	$cancelamount=$val2;
}*/

//end
  }
  //$currr = $this->session->userdata('costtype');
  $ConfirmationNumbervalue='';
 
//	$a=($booked_amount_gta1/100)*$markup;
	//		$final=$booked_amount_gta1-$a;
			//$TotalPricevalue=number_format($booked_amount_gta1,'2','.','');
  $hotelcode=$this->input->post('hotelcode');
 
  $client = new SoapClient("http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1));
  $trackingId=$ProcessIdvalue;
  try {
	   $data['errordesc']='';
       $getHotelBookingStatus = $client->getHotelBookingStatus("V2ZXQTA4RFRjMVducExBSzU5djdUUUExYmJYQ0NrQmk2c1lQYjhnOWxyZk1GUnF1SVlOamRRMjd0OVBOSFZiRw==", $trackingId);
  }
  catch (SoapFault $exception) 
  {
       $data['errordesc'] =  $exception->getMessage();
       exit;
  }
   if($data['errordesc']!='')
  {
	   $data['error']=$data['errordesc'];
	   $this->load->view('hotel/error_page',$data);
  }
  else
  {
     $ConfirmationNumbervalue=$getHotelBookingStatus->hotelBookingInfo->confirmationNumber;
  }
  
//  $perday_cancel_amt=$cancelamount;


$ProcessIdvalue=$ProcessIdvalue;
$BookingStatusvalue =$BookingStatusvalue;
$hotelcode = $hotelcode;
$CheckInvalue = $CheckInvalue;
$CheckOutvalue = $CheckOutvalue;
$cancel_date = $cancel_till_date;
//$amount = $booked_amount_gta1;
$h_room_type = $service->room_type."@".$service->inclusion;
$h_cancel_policy = $this->input->post('cancel_policy');
$BoardTypevalue = $BoardTypevalue;
$ConfirmationNumbervalue = $ConfirmationNumbervalue;
		$guestadult= $this->session->userdata('adult_count');
		$guestchild= $this->session->userdata('child_count');
		$sd_new = $this->session->userdata('sd');
		$sds = explode('/',$sd_new);
		$sds_new = $sds[2]."-".$sds[1]."-".$sds[0];
		$cin=date("Y-m-d", strtotime($sds_new));
		//echo $cin; exit;
		$ed_new = $this->session->userdata('ed');
		$eds = explode('/',$ed_new);
		$eds_new = $eds[2]."-".$eds[1]."-".$eds[0];
		$cout=date("Y-m-d", strtotime($eds_new));
	$date=date('Y-m-d');
	$roomcountss= $this->session->userdata('room_count');
	
	$nights = $this->session->userdata('days');
    $dateFromValc = Date('Y-m-d', strtotime("+5 days" , strtotime ( $cin )));
	$nights = $this->session->userdata('days');
	$trans_id2 = $parent_transaction_id;
	$val_last=$this->Hotel_Model->inser_customer_book_hotelpro($h_hotel_id,$h_hotel_name,$h_star,$h_description,$h_address,$h_phone,$h_fax,$h_room_type,$h_cancel_policy,$cin,$cout,$date,$roomcountss,$user_id,$nights,$trans_id2,$adults,$child,$con_id_org,$dateFromValc,$h_city,"hotelspro",$trackingId,$memid);
    $this->Hotel_Model->inser_customer_book_hotelpro_trans_hotel($trans_id,$ConfirmationNumbervalue,$memid,$val_last,$BookingStatusvalue);
	//$this->voucher_email($val_last);	
	redirect('hotel/voucher/'.$val_last, 'refresh');	//redirect('hotel/voucher/'.$val_last, 'refresh');		
	
	}
		}
		
		else
		{
			redirect('hotel/booking_form_hotelspro/'.$result_id.'/'.$hotelcode,'refresh');
			
		}
		}
		else
		{
			
			
			 $memid = 'MEM'.time();
			 $fname = $this->input->post('fname');
			 $lname = $this->input->post('lname');
			$email=$this->input->post('email');
				$password=$this->input->post('password');
				$city=$this->input->post('city');
				$state='';
				$country=$this->input->post('natiomality');
				$number=$this->input->post('contactno');
				$address='';
				$res=$this->Home_Model->insert_new_member_registration( $fname[0], $lname[0],$email,$password,$city,$country,$number,$memid,$address);
				$this->session->set_userdata(array('memberid'=>$memid));
				$search=$this->Hotel_Model->get_cancel_attrib_new($result_id);
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$natiomality = $this->input->post('natiomality');
		 $city = $this->input->post('city');
		$trns_id =  time();
		//echo count($fname);exit;
		$amount = $this->input->post('booked_amount_gta');
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
		$data['phone_co']=$this->input->post('contactno');
		$data['email_co']=$this->input->post('mailaddress');
		$data4 = array(
					 'last_name' => $data['surname_co'], 
					 'first_name' => $data['name_co'],
					 'mobile' => $data['phone_co'],
					 'email' => $data['email_co'],
					 'customer_info_details_id ' =>$customer_info_details_id,
					 'city' => $city
				);
		$this->db->insert('customer_contact_details', $data4); 
		$parent_customer_id = $this->db->insert_id();
		$user_id=$this->session->userdata('agent_id');
		$data5 = array(
		 'product_id' => 2,
		 'user_id' => $user_id,
		 'amount' => $amount,
		 'customer_contact_details_id' => $parent_customer_id, 
		 'created_date' => date("Y-m-d")
	);
	
	$this->db->insert('transaction_details', $data5); //exit;
	$parent_transaction_id = $this->db->insert_id();
	$room_count = $this->session->userdata('room_count');
		//if($room_count == 1)
		//{
		
			$service=$this->Hotel_Model->get_searchresult($result_id);
			$h_hotel_id = $service->HotelCode;
			$h_hotel_name = $service->HotelName;
			$h_star = $service->StarRating;
			$h_description = $service->HotelInfo;
			$h_address = $service->HotelAddress;
			$h_city = $service->Destination;
			$h_phone = $service->HotelPhoneNumber;
			$h_fax = '';
			$trans_id = $parent_customer_id;
	 		$contact_info=$this->Hotel_Model->contact_info_detail_update($trans_id);
           $con_id = $contact_info->customer_info_details_id;
	 		$pass_info=$this->Hotel_Model->pass_info_detail($trns_id);
			$con_id_org =$contact_info->customer_contact_details_id;
	
	//echo "<pre>"; print_r($search);
	//echo "<pre>"; print_r($pass_info);exit;
		$adults=$search->adult;
		$child=$search->child;
		$roomcat=$search->room_code;
		$hotel_id=$search->hotel_code;
		$roomcountss=$this->session->userdata('room_count');
		$noofdays=$this->session->userdata('days');
		$data['guestadult']= $this->session->userdata('adult_count');
		$data['guestchild']= $this->session->userdata('child_count');
		$address=$contact_info->city;
		$cin=date("Y-m-d", strtotime($this->session->userdata('sd')));
		$cout=date("Y-m-d", strtotime($this->session->userdata('ed')));
		$noofroom= $this->session->userdata('room_count');
		$child= $this->session->userdata('child_count');
		$adult= $this->session->userdata('adult_count');
		$api='hotelspro';
		$fname1=$pass_info[0]->first_name;			 
		$lname1=$pass_info[0]->last_name;			
		$roomusedtypeval= $this->session->userdata('room_used_type');
		$roomcount= $this->session->userdata('room_count');
		$result_id=$result_id;
		$email = $contact_info->email;
		$nameval='';
		$m=1;
		$j=0;
		$adult=0;
		$child=0;
		//$lname1=$fname1;
 		$room_used_type = $this->session->userdata('room_used_type');
		$city = $this->session->userdata('city_name');
		//.', '.$this->session->userdata('country_name')
		$sd = $this->session->userdata('sd');
		$room_count = $this->session->userdata('room_count');
		$ed = $this->session->userdata('ed');
		$city_val = $this->Hotel_Model->get_city_code($city);
		//echo "<pre>"; print_r($city_val);exit;  
		//$citycode = $city_val->hotelspro;
		$citycode = $city_val->DestinationId;
		$sb_room_cnt =0;
		$db_room_cnt =0;
		$tb_room_cnt =0;
		$q_room_cnt =0;
		$dbc_room_cnt =0;
		$dbcc_room_cnt =0;
		$room1='';
		$hotelbed_rooms='';
		$bookroom='';
		$PFirstNamevalue= 'Mr.'.' '.$fname1.' '.$lname1;
      	$leadTravellerInfo = array();
      	$paxInfo = array("paxType" => "Adult", "title" => 'Mr', "firstName" => $fname1, "lastName" => $lname1);
		//echo "<pre>"; print_r($paxInfo);exit;
		$leadTravellerInfo = $paxInfo;
	  	$leadTravellerInfo["paxInfo"] = $paxInfo;
	  	$leadTravellerInfo["nationality"] = "US";
		$otherTravellerInfo = array();
        $processId=$search->room_code;
		//echo count($pass_info);exit;
   		if(count($pass_info)>1)
   		{
			for($i=1;$i< count($pass_info);$i++)
			{
				  $otherTravellerInfo[] = array("title" => 'Mr', "firstName" => $pass_info[$i]->first_name, "lastName" => $pass_info[$i]->last_name);
			}
   		}
   		else
   		{
	    	$otherTravellerInfo='';
   		}
//echo "<pre>"; print_r($otherTravellerInfo);exit;
	$preferences = "";
      $note = "";
	   $agencyReferenceNumber = 'QF9787';
	
		 $client = new SoapClient("http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1));
		// echo "<pre>"; print_r($client);exit;
  
  try {
 
	   $data['errordesc']='';
	   $makeHotelBooking = $client->makeHotelBooking("V2ZXQTA4RFRjMVducExBSzU5djdUUUExYmJYQ0NrQmk2c1lQYjhnOWxyZk1GUnF1SVlOamRRMjd0OVBOSFZiRw==", $processId, $agencyReferenceNumber, $leadTravellerInfo,$otherTravellerInfo,  $preferences, $note);
    //  echo "<pre>"; print_r($makeHotelBooking);exit;
      $hotel = $makeHotelBooking->hotelBookingInfo;
      $rooms = is_array($hotel->rooms) ? $hotel->rooms : array($hotel->rooms);
      $policies = is_array($hotel->cancellationPolicy) ? $hotel->cancellationPolicy : array($hotel->cancellationPolicy);
    }
	 catch (SoapFault $exception) {
	 
      $data['errordesc'] = $exception->getMessage();
     
  }
//  echo "<pre>"; print_r($data['errordesc']);exit;
   if($data['errordesc']!='')
  {
	  $data['error']=$data['errordesc'];
	  //echo "<pre>"; print_r($data['error']); exit;
  	   $this->load->view('error_page',$data);
	 
  }
  else
  {
   
 //echo $hotel->bookingStatus;exit;
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
/*			
if($cutype=='Percent')
{
	
	$cancelamount=($_REQUEST['amount']/100)*$val2;
	
}
else
{
	$cancelamount=$val2;
}*/

//end
  }
  //$currr = $this->session->userdata('costtype');
  $ConfirmationNumbervalue='';
 
//	$a=($booked_amount_gta1/100)*$markup;
	//		$final=$booked_amount_gta1-$a;
			//$TotalPricevalue=number_format($booked_amount_gta1,'2','.','');
  $hotelcode=$this->input->post('hotelcode');
 
  $client = new SoapClient("http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1));
  $trackingId=$ProcessIdvalue;
  try {
	   $data['errordesc']='';
       $getHotelBookingStatus = $client->getHotelBookingStatus("V2ZXQTA4RFRjMVducExBSzU5djdUUUExYmJYQ0NrQmk2c1lQYjhnOWxyZk1GUnF1SVlOamRRMjd0OVBOSFZiRw==", $trackingId);
  }
  catch (SoapFault $exception) 
  {
       $data['errordesc'] =  $exception->getMessage();
       exit;
  }
   if($data['errordesc']!='')
  {
	   $data['error']=$data['errordesc'];
	   $this->load->view('hotel/error_page',$data);
  }
  else
  {
     $ConfirmationNumbervalue=$getHotelBookingStatus->hotelBookingInfo->confirmationNumber;
  }
  
//  $perday_cancel_amt=$cancelamount;


$ProcessIdvalue=$ProcessIdvalue;
$BookingStatusvalue =$BookingStatusvalue;
$hotelcode = $hotelcode;
$CheckInvalue = $CheckInvalue;
$CheckOutvalue = $CheckOutvalue;
$cancel_date = $cancel_till_date;
//$amount = $booked_amount_gta1;
$h_room_type = $service->room_type."@".$service->inclusion;
$h_cancel_policy = $this->input->post('cancel_policy');
$BoardTypevalue = $BoardTypevalue;
$ConfirmationNumbervalue = $ConfirmationNumbervalue;
		$guestadult= $this->session->userdata('adult_count');
		$guestchild= $this->session->userdata('child_count');
		$sd_new = $this->session->userdata('sd');
		$sds = explode('/',$sd_new);
		$sds_new = $sds[2]."-".$sds[1]."-".$sds[0];
		$cin=date("Y-m-d", strtotime($sds_new));
		//echo $cin; exit;
		$ed_new = $this->session->userdata('ed');
		$eds = explode('/',$ed_new);
		$eds_new = $eds[2]."-".$eds[1]."-".$eds[0];
		$cout=date("Y-m-d", strtotime($eds_new));
	$date=date('Y-m-d');
	$roomcountss= $this->session->userdata('room_count');
	
	$nights = $this->session->userdata('days');
    $dateFromValc = Date('Y-m-d', strtotime("+5 days" , strtotime ( $cin )));
	$nights = $this->session->userdata('days');
	$trans_id2 = $parent_transaction_id;
	$val_last=$this->Hotel_Model->inser_customer_book_hotelpro($h_hotel_id,$h_hotel_name,$h_star,$h_description,$h_address,$h_phone,$h_fax,$h_room_type,$h_cancel_policy,$cin,$cout,$date,$roomcountss,$user_id,$nights,$trans_id2,$adults,$child,$con_id_org,$dateFromValc,$h_city,"hotelspro",$trackingId,$memid);
    $this->Hotel_Model->inser_customer_book_hotelpro_trans_hotel($trans_id,$ConfirmationNumbervalue,$memid,$val_last,$BookingStatusvalue);
	//$this->voucher_email($val_last);	
	redirect('hotel/voucher/'.$val_last, 'refresh');	//redirect('hotel/voucher/'.$val_last, 'refresh');		
			
		}
	}
		
	}
	
	
	function voucher($val_last)
	{//echo $val_last;exit;
		
		$data['id']=$val_last;
			$data['result_view']=$result_view=$this->Hotel_Model->book_detail_view_voucher1($val_last);
			$con_id = $data['result_view']->customer_contact_details_id;
	
	  $data['contact_info']=$contact_info=$this->Hotel_Model->contact_info_detail_update($con_id);
	  $data['trans']=$trans=$this->Hotel_Model->transation_detail_contact($con_id);
	//$trans_id = $trans->transaction_details_id;
	//customer_info_details_id
	 $con_id_pass = $data['contact_info']->customer_info_details_id;
	 $data['pass_info']=$this->Hotel_Model->pass_info_detail($con_id_pass);
	 $data['getmemdet']=$getmemdet=$this->Home_Model->get_member($result_view->memid);
	
		
		 $hotel_id = $data['result_view']->hotel_code;
		 //$data['hotel_details']=$this->Hotel_Model->gethb_hoteldet($hotel_id);
		 $data['hotel_image']= $this->Hotel_Model->gethb_hotelimage_new($hotel_id);
		 $data['hotel_decs']='';	

		 $this->load->view('thank_you',$data);
	}
	function print_voucher($val_last)
	{//echo $val_last;exit;
		
			$data['result_view']=$this->Hotel_Model->book_detail_view_voucher1($val_last);
	 $con_id = $data['result_view']->customer_contact_details_id;
	
	  $data['contact_info']=$this->Hotel_Model->contact_info_detail_update($con_id);
	  $data['trans']=$this->Hotel_Model->transation_detail_contact($con_id);
	//$trans_id = $trans->transaction_details_id;
	//customer_info_details_id
	 $con_id_pass = $data['contact_info']->customer_info_details_id;
	 $data['pass_info']=$this->Hotel_Model->pass_info_detail($con_id_pass);
	 
		
		 $hotel_id = $data['result_view']->hotel_code;
		 //$data['hotel_details']=$this->Hotel_Model->gethb_hoteldet($hotel_id);
		 $data['hotel_image']= $this->Hotel_Model->gethb_hotelimage_new($hotel_id);
		 $data['hotel_decs']='';
	
			
			//echo "<pre>"; print_r($data);exit;
		 $this->load->view('hotel/voucher',$data);
	}
	function cancel_book()
	{
		
		 $val_last=$this->input->post('bookid');
		$time=time();
		$vat_time=date('Y-m-d').""."T".date('h:i:s');
		
		$res = $this->Hotel_Model->get_room_process($val_last);
		//echo "<pre>"; print_r($res); exit;
		$process_id=$res->item_code;
		$hcode=$res->hotel_code;
		$transid=$res->trans_id;
		
		 //$client = new SoapClient("wsdl_hotel_path", array('trace' => 1));
		  $client = new SoapClient("http://api.hotelspro.com/4.1_test/hotel/b2bHotelSOAP.wsdl", array('trace' => 1));
		  
		  try {
			  $cancelHotelBooking = $client->cancelHotelBooking("V2ZXQTA4RFRjMVducExBSzU5djdUUUExYmJYQ0NrQmk2c1lQYjhnOWxyZk1GUnF1SVlOamRRMjd0OVBOSFZiRw==", $process_id);
		  }
		  catch (SoapFault $exception) {
			  
			$data['error'] = $exception->getMessage();
			//$this->load->view('hotel/error_page',$data);
		  }
		  if(isset($data['error']) && $data['error']!='')
			{
				$data['error']=$data['error'];
				$this->load->view('error_page',$data);
			}
			else
			{
				//echo "<pre>"; print_r($data); exit;
				$cancel_hotel=$cancelHotelBooking->agencyReferenceNumber; //$array['XMLResponse']['CancelResult'];
				$cancel_status=$cancelHotelBooking->bookingStatus; //$cancel_hotel['CancellationStatus'];
				$cancel_note=$cancelHotelBooking->note; //$cancel_hotel['Note'];
				$get_data=$this->Hotel_Model->get_amout_cancel1($transid);
				$cancel_amount=$get_data->amount;
				$book_amount=$get_data->amount;
				$cancel_date=$get_data->cancel_tilldate;
				$trans_id = $get_data->trans_id;
				//	$cancel_amount_comm=$get_data->commission_amount;
					//if($cancel_status=='Cancelled'){
						$exp_date =  $cancel_date;
						$todays_date = date("Y-m-d");
						$today = strtotime($todays_date);
						$expiration_date = strtotime($exp_date);
						if($expiration_date >= $today){
						$tot_cancel = $cancel_amount;
						}
						else{
						$tot_cancel=$cancel_amount-$cancel_amount;
						}
						//echo $cancel_status;
						$res=$this->Hotel_Model->update_booking_status1($cancel_status,$cancel_note,$tot_cancel,$trans_id);
			//}
			}
		  redirect('home/dashboard','refresh');
	}
	
	function hotel_description($hid,$k='')
	{
		$data['hid']=$hid;
		$data['hotel_details']=$hotel_details = $this->Hotel_Model->hotel_details($hid);
		
	$data['supp_id']=$hotel_details->supplier_id;
	$data['k'] = $k;
		$this->load->view('hotel_description',$data);
	}
	
	function hotel_confirmation()
	{
		$this->session->unset_userdata('bd_adult');
		 $data['count']=$count=$this->input->post('roomscnt');
	 $data['hotel_id']=$hotel_id= $this->input->post('hotel_id');
	 $data['room_id']= $room_id= $this->input->post('room_id');
	  $data['amount']= $amount= $this->input->post('amount');
	 $data['comm']= $comm= $this->input->post('comm');
	 $data['hotel_details']=$hotel_details = $this->Hotel_Model->hotel_details($hotel_id);
	$supp_id=$hotel_details->supplier_id;
	 $data['room_details']= $room_details = $this->Hotel_Model->get_room_details_new($supp_id,$room_id);
	$this->session->set_userdata(array('roomscnt'=>$count,'hotel_id'=>$hotel_id,'room_id'=>$room_id,'amount'=>$amount,'count'=>$count,'comm'=>$comm));
		// echo '<pre>'; print_r($this->session->userdata);exit;
		$this->load->view('hotel_confirmation',$data);
	}
	function member_registration()
	{
		$data['MEMcode']=$MEMcode = 'MEM'.time();
		
		$title= $this->input->post('salutation');
		$fname= $this->input->post('fname');
		$lname= $this->input->post('lname');
		 $country= $this->input->post('country');
		$address= $this->input->post('address');
		$city= $this->input->post('city');
		$state= $this->input->post('state');
		$number= $this->input->post('contactno');
		$adult= $this->input->post('adults');
		$child= $this->input->post('childs');
		$data['email']=$email= $this->input->post('email');
		$password= $this->input->post('password');
		if($this->input->post('special_request')!='')
		{
		 $request= 	$this->input->post('special_request');
		}
		else
		{
			$request= '';
		}
		 $data['fname']=$fname[0];
		 $data['lname']=$lname[0];
		 $data['lname']=$lname[0];
		$this->load->view ('member_email',$data);
		$this->session->set_userdata(array('fname'=>$fname[0],'lname'=>$lname[0],'country'=>$country,'address'=>$address,'city'=>$city,
		'number'=>$number,'bd_adult'=>$adult,'bd_child'=>$child,'email'=>$email,'password'=>$password,'memberid'=>$MEMcode));
		 $this->Home_Model->insert_into_member_registration_new($title[0],$fname[0],$lname[0],$country,$city,$state,$address,$number,$email,
		 $password,$MEMcode,$request);   

					
		redirect('hotel/member_login_confirm','refresh');
		
	}
	
		function member_registration_update()
	{
		$memberid = $this->session->userdata('memberid');	 
		$title= $this->input->post('salutation');
		$fname= $this->input->post('fname');
		$lname= $this->input->post('lname');
		 $country= $this->input->post('country');
		$address= $this->input->post('address');
		$city= $this->input->post('city');
		$state= $this->input->post('state');
		$number= $this->input->post('contactno');
		$adult= $this->input->post('adults');
		$child= $this->input->post('childs');
		$email= $this->input->post('email');
		$password= $this->input->post('password');
				if($this->input->post('special_request')!='')
		{
		 $request= 	$this->input->post('special_request');
		}
		else
		{
			$request= '';
		}
		$this->session->set_userdata(array('fname'=>$fname,'lname'=>$lname,'country'=>$country,'address'=>$address,'city'=>$city,
		'number'=>$number,'bd_adult'=>$adult,'bd_child'=>$child,'email'=>$email,'password'=>$password));
		 $this->Home_Model->member_registration_update($title,$fname,$lname,$country,$city,$state,$address,$number,$email,
		 $password,$memberid,$request);   

					
		redirect('hotel/member_login_confirm','refresh');
		
	}
	
	
	function member_login_confirm()
	{
		$data['time']=time();
		 $data['hotel_id']=$hid=$this->session->userdata('hotel_id');
		 $room_id=$this->session->userdata('room_id');
		  $data['amount']= $amount= $this->session->userdata('amount');
		 $data['count']= $count= $this->session->userdata('roomscnt');
		 $total=$amount*$count;
		 $data['cost']=$total;
				 $data['hotel_details']=$hotel_details = $this->Hotel_Model->hotel_details($hid);
		 $supp_id=$hotel_details->supplier_id;
		 $data['room_details']= $room_details = $this->Hotel_Model->get_room_details_new($supp_id,$room_id);
		 $memberid=$this->session->userdata('memberid');	 
					$data['result']=$result=$this->Home_Model->member_last_login($memberid);
					$this->load->view('hotel_confirmation',$data);
				
					
	}
	
	function book_hotel()
	{
		$hotelname = $this->input->post('hotel_name');
		$hotel_address = $this->input->post('hotel_address');
		$earliestcheckin = $this->input->post('earliestcheckin');
		$earliestcheckout = $this->input->post('earliestcheckout');
		$hotel_commision = $this->input->post('hotel_commision');
		$hotel_cnt_no = $this->input->post('hotel_cnt_no');
		
		 $hotel_email = $this->input->post('hotel_email');
		$roomname = $this->input->post('roomname');
		$hotel_id = $this->input->post('hotel_id');
		$cost = $this->input->post('cost');
		$adult=$this->session->userdata('bd_adult');
		  $child= $this->session->userdata('bd_child');
		  $roomid=$this->session->userdata('room_id');
		$date = explode('/',$this->session->userdata('sd'));
       $city=$this->session->userdata('city_name');
	$start_date = $date[2].'-'.$date[1].'-'.$date[0];
	$date2 = explode('/',$this->session->userdata('ed'));
	$end_date = $date2[2].'-'.$date2[1].'-'.$date2[0];
		  $roomcount= $this->session->userdata('roomscnt');
		   $memberid=$this->session->userdata('memberid');	
		   $days=$_SESSION['days']; 
		/*if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.229')
	{
		
		$url = "https://192.168.0.229/dhaka/xml_xplorer_bd/booking.php";
	
	$date = explode('/',$this->session->userdata('sd'));

	$date1 = $date[2].'-'.$date[1].'-'.$date[0];
	$date2 = explode('/',$this->session->userdata('ed'));
	$date3 = $date2[2].'-'.$date2[1].'-'.$date2[0];
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"hotel_id=".$hotel_id ."&hotelname=".$hotelname."&startdate=".$date1."&enddate=".$date3."&roomid=".$roomid."&rooms=".$roomcount."&adult=".$adults."&childs=".$childs."&billing_amount=".$cost);
	}
	$contentz=curl_exec($ch);*/
	
	

	
$ins = "INSERT INTO hotel_booking_info(hotel_code,hotel_name,hotel_email,check_in,check_out,no_of_room,
adult,child,memid,voucher_date,room_type,api,city,address,phone,nights,item_code)
values('".$hotel_id."','".$hotelname."','".$hotel_email."','".$start_date."',
'".$end_date."','".$roomcount."',
'".$adult."','".$child."',
'".$memberid."','".date('Y-m-d')."','".$roomname."','bdroom','".$city."','".$hotel_address."','".$hotel_cnt_no."','".$days."','".$roomid."')";
$que=$this->db->query($ins);
 $id=$this->db->insert_id();
$ins1 = "INSERT INTO transaction_details(booking_number,prn_no,amount,status,hotel_booking_id,created_date)
values('test000','test000','".$cost."',
'Confirmed Booking','".$id."','".date('Y-m-d')."')";
$que=$this->db->query($ins1);
 $id1=$this->db->insert_id();
 redirect('hotel/thank_you/'.$id,'refresh');

		
	}
	function thank_you($id)
	{
		$data['id']=$id;
		$data['result_view']=$result_view=$this->Hotel_Model->book_detail_view($id);
		
		$memberid=$result_view->memid;
		$data['contact_info']=$contact_info=$this->Home_Model->member_last_login($memberid);
		//echo '<pre>'; print_r($data['contact_info']);exit;
		$data['trans']=$this->Hotel_Model->booking_transation_detail($id);
		 $this->load->view('thankyou',$data);
	
	}
	
	function sort_slider_hotels()
	{
		
		$sec_res=$this->session->userdata('ses_id');
		
			if($this->input->post('min_pr')!='')
			{
				 $data['min_pr']=$min_pr=$this->input->post('min_pr');
			}
			else
			{
				$data['min_pr']=$min_pr=$this->session->userdata('minp');
			}
			if($this->input->post('max_pr')!='')
			{
				$data['max_pr']=$max_pr=$this->input->post('max_pr');
			}
			else
			{
				$data['max_pr']=$max_pr=$this->session->userdata('maxp');
				
			}
			$this->session->set_userdata(array("minp"=>$data['min_pr'],"maxp"=>$data['max_pr']));
			$pricevalue[]=$min_pr."-".$max_pr;
			$strvalue='';
			$data['facvalue']=$facility='';
			$tmp_data1 = $this->Hotel_Model->fetch_price_result_details($sec_res,$limit='',$start='',$pricevalue,$strvalue,$facility);
		
	$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/sort_slider_hotels";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_price_result_details($sec_res,$config["per_page"], $page,$pricevalue,$strvalue,$facility);
        $data["links"] = $this->pagination->create_links();
		//echo "<pre>"; print_r($tmp_data); exit;
		
		$data['result'] = $tmp_data1;
		//echo count($tmp_data1);exit;
		$data['min_price']=$this->session->userdata('minprice');
		$data['max_price']=$this->session->userdata('maxprice');
		$this->load->view('best_result_hotels',$data);
	
	}
	
	function sort_hotels()
	{
		
		$sec_res=$this->session->userdata('ses_id');
		if($this->input->post('pricevalue')!='' || $this->input->post('strvalue')!='' || $this->input->post('facility')!='')
		{
			if($this->input->post('pricevalue')!='')
			{
				$data['price_value']=$pricevalue=$this->input->post('pricevalue');
			}
			else
			{
				$data['price_value']=$pricevalue="";
			}
			if($this->input->post('strvalue')!='')
			{
				$data['strvalue']=$strvalue=$this->input->post('strvalue');
			}
			else
			{
				$data['strvalue']=$strvalue='';
				
			}
			
			if($this->input->post('facility')!='')
			{
				$data['facvalue']=$facility=$this->input->post('facility');
			}
			else
			{
				$data['facvalue']=$facility='';
				
			}
			
			$tmp_data1 = $this->Hotel_Model->fetch_price_result_details($sec_res,$limit='',$start='',$pricevalue,$strvalue,$facility);
		
	$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/sort_star_by_price";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_price_result_details($sec_res,$config["per_page"], $page,$pricevalue,$strvalue,$facility);
        $data["links"] = $this->pagination->create_links();
		//echo "<pre>"; print_r($tmp_data); exit;
		
		$data['result'] = $tmp_data1;
		//echo count($tmp_data1);exit;
		$data['min_price']=$this->session->userdata('minprice');
		$data['max_price']=$this->session->userdata('maxprice');
		$this->load->view('best_result_hotels',$data);
	}
	else
	{
		
	  redirect('hotel/search_result_hotel','refresh');	
	}
	}
	
	function sort_star_by_price()
	{
		
		$sec_res=$this->session->userdata('ses_id');
		if($this->input->post('strvalue')!='')
		{
		$data['strvalue']=$strvalue=$this->input->post('strvalue');
			$tmp_data1 = $this->Hotel_Model->fetch_star_result_details($sec_res,$limit='',$start='',$strvalue);
		
	$data['totalresult'] =$tmp_data1;
		$config = array();
        $config["base_url"] = base_url() . "hotel/sort_star_by_price";
        $config["total_rows"] = count($tmp_data1);
	        $config["per_page"] = 20;
      $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
	 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $tmp_data = $this->Hotel_Model->fetch_star_result_details($sec_res,$config["per_page"], $page,$strvalue);
        $data["links"] = $this->pagination->create_links();
		//echo "<pre>"; print_r($tmp_data); exit;
		
		$data['result'] = $tmp_data1;
		//echo count($tmp_data1);exit;
		$this->load->view('best_result_hotels',$data);
	}
	else
	{
		
	  redirect('hotel/search_result_hotel','refresh');	
	}
		
	}
	function payment_gateway()
	{
		require_once "api/Api.php";
		$api_name = 'sales@explore-bd.com';
		$api_id = 'JPEV5W2GRCI7';
		$api_pass = 'cUR1aieaXwse47vaKCxMyKv3eoBPtwRN';
		$oAuth = new EgoPayAuth($api_name, $api_id, $api_pass);
		$oApiAgent = new EgoPaySoapApiAgent($oAuth);
		echo '<pre>'; print_r($oApiAgent);exit;
		
	}
	function check_new_availabilty()
	 {
		 
if(isset($_REQUEST['start_date']))
{
	$total_cost = '';
	  $comm=$this->Hotel_Model->get_comm_admin();
	if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.17')
	{
		$url = "https://192.168.0.229/dhaka/xml_xplorer_bd/ammend.php";
	}
	else
	{
		$url = "https://bdrooms.com/xml_xplorer_bd/ammend.php";
	}
	$date1=$_REQUEST['start_date'];
	list($d1,$m1,$y1)=explode('/',$date1);
	$newdate=$y1.'-'.$m1.'-'.$d1;
	$date2=$_REQUEST['end_date'];
	list($d,$m,$y)=explode('/',$date2);
	$newdate1=$y.'-'.$m.'-'.$d;
	$d3=mktime(0,0,0,$m1,$d1,$y1);
	$d2=mktime(0,0,0,$m,$d,$y);
	$days = floor(($d2-$d3)/86400);
	$_SESSION['new_checkin'] = $newdate;
	$_SESSION['new_checkout'] = $newdate1;
	$supplier_id = $this->input->post('supplier_id');
	$roomid = $this->input->post('roomid');
	$roomscount = $this->input->post('roomscount');
	$booking_ref_id = $this->input->post('booking_ref_id');
	$booking_night = $this->input->post('booking_night');
	$booking_id = $this->input->post('id');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"supplier_id=".$supplier_id ."&roomid=".$roomid."&roomscount=".$roomscount."&booking_ref_id=".$booking_ref_id."&start_date=".$newdate."&end_date=".$newdate1."&days=".$days);
	$contentz=curl_exec($ch);
	$array = $this->xml2array2($contentz);
//	echo "<pre>"; print_r($array);exit;
  if($days>$booking_night)
  {
	  if($booking_night==1)
	  {
		$day="day";  
	  }
	  else
	  {
		  $day="days";  
	   }
	  $data['msg']="You Can select only $booking_night $day ";
	  $data['id']=$booking_id;
	  $memberid=$this->session->userdata('memberid');	 
		$data['member_info']=$this->Home_Model->member_last_login($memberid);
		$data['bookdetails']=$bookdetails=$this->Hotel_Model->get_all_bookid_ind($booking_id);
		$this->load->view('view_booking_bdrooms_amend',$data);
	}
	else
	{
	if($days >1)
	{
		
		if(isset($array['ammend']['result'][0]))
		{
			
				 $availablerooms = $array['ammend']['result'];
				//echo "<pre>";print_r($availablerooms);
				//echo $roomscount;exit;
			foreach($availablerooms as $rooms)
				{
					if(($rooms['single_rate']))
					{
						$cost = $rooms['single_rate'];
					}
					else
					{
						$cost = $rooms['double_rate'];
					}
					if($rooms['available_rooms'])
					{
						 $available_rooms1 = $rooms['available_rooms'];
					}
					else
					{
						$available_rooms1 = '';
					}
					if($roomscount <= $available_rooms1)
					{
						$total_cost = $total_cost + $cost;
					}
					else
					{
						//header('Location:notavilable.php');
						//header('Location:ammend_confirm.php?ref_id='.$booking_ref_id);
						redirect('hotel/ammend_confirm/'.$booking_ref_id,'refresh');
					}
			}//exit;
	}
		else
		{
			
			redirect('hotel/ammend_confirm/'.$booking_ref_id,'refresh');
		}
		//echo 'aaaa';exit;
		 if($total_cost != '')
  		{
			 $comm = (($total_cost*$roomscount)*$comm)/100;
		  $cost = ($total_cost*$roomscount)+$comm;
	
		redirect('hotel/ammend_confirm/'.$booking_ref_id.'/'.$cost,'refresh');
		//  header('Location:ammend_confirm.php?ref_id='.$booking_ref_id.'&cost='.trim($cost).'&comm='.$comm);
  		}
	}
	else
	{
	
		if(isset($array['ammend']))
		{
			if($array['ammend']['result']['single_rate'])
			{
				$comm = ((($array['ammend']['result']['single_rate']*$roomscount)*$comm)/100);
				$cost = (($array['ammend']['result']['single_rate'])*$roomscount)+$comm;
				
			}
			else
			{
				$comm  = ((($array['ammend']['result']['double_rate']*$roomscount)*$comm)/100);
				$cost = (($array['ammend']['result']['double_rate'])*$roomscount)+$comm;
				
			}
			
			
			redirect('hotel/ammend_confirm/'.$booking_ref_id.'/'.$cost,'refresh');
		}
		else
		{
			redirect('hotel/ammend_confirm/'.$booking_ref_id,'refresh');
		}
	}
}

}
	 }
	 function ammend_confirm($booking_ref_id,$cost='')
	 {
		 	$memberid=$this->session->userdata('memberid');	 
		$data['member_info']=$this->Home_Model->member_last_login($memberid);
		$data['bookdetails']=$bookdetails=$this->Hotel_Model->get_all_bookid_ind($booking_ref_id);
		$data['booking_ref_id'] = $booking_ref_id;
		 $data['cost'] = $cost;
		$this->load->view('view_booking_bdrooms_amend_confirm',$data);
	 }
	 function ammendment_confirm()
	 {
		
		 $bal = $this->input->post('bal');
		 $booking_cost = $this->input->post('booking_cost');
		 $booking_ref_id = $this->input->post('ref_id');
		 $data['bookdetails']=$bookdetails=$this->Hotel_Model->get_all_bookid_ind($booking_ref_id);
		 if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.229')
		{
			$url = "https://192.168.0.229/dhaka/xml_xplorer_bd/booking_ammend.php";
			$date = explode('/',$_SESSION['start_date']);
			$date1 = $date[2].'-'.$date[1].'-'.$date[0];
			$date2 = explode('/',$_SESSION['end_date']);
			$date3 = $date2[2].'-'.$date2[1].'-'.$date2[0];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"ref_id=".$booking_ref_id);
			$contentz=curl_exec($ch);
		}
		
		$check_check_date = $bookdetails->check_in;
		$check_out_date = $bookdetails->check_out;
		$today_date = date('Y-m-d');
		$days = (strtotime($check_check_date) - strtotime($today_date)) / (60 * 60 * 24);
		
		if($days > 3)
		{
			$refund = $bookdetails->amount;
			$cancel_cost = 0;
			$anand = 0;
		}
		else
		{
			$total_days  = (strtotime($check_out_date) - strtotime($check_check_date)) / (60 * 60 * 24);
			$cancel_cost = $bookdetails->amount/$total_days;
			$refund = $bookdetails->amount;
			$anand = $refund - $cancel_cost;
		}
		list($y1,$m1,$d1)=explode('-',$_SESSION['new_checkin']);
	$newdate=$y1.'-'.$m1.'-'.$d1;
	$date2=$_SESSION['new_checkout'];
	list($y,$m,$d)=explode('-',$date2);
	$newdate1=$y.'-'.$m.'-'.$d;
	$d3=mktime(0,0,0,$m1,$d1,$y1);
	$d2=mktime(0,0,0,$m,$d,$y);
	 $days = floor(($d2-$d3)/86400);
		//echo $days;exit;
		$ins = "UPDATE transaction_details SET status = 'Amend',net_amount = '".$anand."' WHERE hotel_booking_id =".$booking_ref_id;
		$this->db->query($ins);
		$date = explode('-',$_SESSION['new_checkin']);
		$date1 = $date[2].'/'.$date[1].'/'.$date[0];
		$date2 = explode('-',$_SESSION['new_checkout']);
		$date3 = $date2[2].'/'.$date2[1].'/'.$date2[0];
		//,cost = '".$cost."'
	$up = "UPDATE hotel_booking_info SET check_in = '".$_SESSION['new_checkin']."', check_out = '".$_SESSION['new_checkout']."',voucher_date = '".date('Y-m-d')."', cancel_tilldate ='".$today_date."',nights='".$days."' WHERE hotel_booking_info_id = '".$booking_ref_id."'";
	$this->db->query($up);
	//echo $cancel_cost;echo $booking_cost;exit;
	
	$up1 = "UPDATE transaction_details SET amount  = '".$booking_cost."' WHERE hotel_booking_id  = '".$booking_ref_id."'";
	//echo $up1;exit;
	$this->db->query($up1);

 $data['bookdetails']=$bookdetails=$this->Hotel_Model->get_all_bookid_ind($booking_ref_id);

 

	redirect('hotel/confirm_ammend/'.$booking_ref_id,'refresh');
		 }
		 
	 function confirm_ammend($id)
	 {
		 $data['bookdetails']=$bookdetails=$this->Hotel_Model->get_all_bookid_ind($id);
		  $data['bookdetailss']=$bookdetailss=$this->Hotel_Model->get_room_process($id);
		 $data['hoteladdress']=$hoteladdress=$this->Hotel_Model->get_room_process($id);
	 $data['bookid']=$id;
		  
		
		
		$this->load->view('confirm_ammend',$data);
		
		
	 //$this->load->view('amend_mail',$data);
	
	 }
	  function cancel_book_bdrooms()
	 {
		$booking_ref_id =$id = $bookid = $this->input->post('bookid');
		 $data['bookdetails']=$bookdetails=$this->Hotel_Model->get_all_bookid_ind($id);
		  $data['bookdetailss']=$bookdetailss=$this->Hotel_Model->get_room_process($id);
		  
		  $this->load->view('cancel_email',$data);
		 
		
		 
		 if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.229')
		{
			$url = "https://192.168.0.229/dhaka/xml_xplorer_bd/cancel.php";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"ref_id=".$booking_ref_id);
			$contentz=curl_exec($ch);
		}
		
		//if($result != ''){
		$check_check_date = $bookdetails->check_in;
		$check_out_date = $bookdetails->check_out;
		$today_date = date('Y-m-d');
		$days = (strtotime($check_check_date) - strtotime($today_date)) / (60 * 60 * 24);
		if($days > 3)
		{
			$refund = $bookdetails->amount;
			$cancel_cost = '';
			$anand = '';
		}
		else
		{
			$total_days  = (strtotime($check_out_date) - strtotime($check_check_date)) / (60 * 60 * 24);
			$cancel_cost = $bookdetails->amount/$total_days;
			$refund = $bookdetails->amount;
			$anand = $refund - $cancel_cost;
		}
			$ins = "UPDATE transaction_details SET status = 'Cancel',net_amount = '".$anand."' WHERE hotel_booking_id =".$booking_ref_id;
			$this->db->query($ins);
			$up = "UPDATE hotel_booking_info SET cancel_tilldate ='".$today_date."' WHERE hotel_booking_info_id = '".$booking_ref_id."'";
			$this->db->query($up);
			
			
			 redirect('home/dashboard','refresh');
		 }
		
}
?>
