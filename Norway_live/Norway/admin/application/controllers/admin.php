<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin extends CI_Controller {

public function __construct()
   {
	parent::__construct();
	$this->load->model('Home_Model');
	//$this->load->model('Hotel_Model');
	$this->load->model('Supplier_Model');
	$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	$this->output->set_header('Pragma: no-cache');
	$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
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
		$data['error'] = '';
		$this->load->view('login');
	}
	function admin_login_check()
	{
	     if($this->input->post('username_admin'))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			/*$row = $this->Home_Model->get_ip_valid($ip);
			if($row!='' || $row!=0)
			{*/
					$admin_username = $this->input->post('username_admin');
					$admin_password = $this->input->post('password_admin');
					$res = $this->Home_Model->admin_login_check_db($admin_username,$admin_password);
				 if($res)
				 {
					foreach($res as $row)
					{
						$_SESSION['admin'] = $admin_username;
						$this->session->set_userdata(array('admin'=>$admin_username));	
						$this->session->set_userdata(array('admin_id'=>$row->admin_id));	
						$_SESSION['admin']='admin';	 
					}
						redirect('admin/admin_dashboard');
				}
				else
				{
					$data['error']="invalid login details";
					redirect('admin/index','refresh');
				}
			/*}
			else
				{
					$data['error']="invalid login details";
					redirect('admin/index','refresh');
				}*/
		}
		else
		{
	
				redirect('admin/index','refresh');
		}
	}
	function admin_dashboard()
	{
		//echo $this->session->userdata('admin_id');exit;
		if($this->session->userdata('admin_id')!='')
		{	 
			$admin_id = $this->session->userdata('admin_id');
			$data['access'] = $this->Home_Model->access_details($admin_id);
			$this->load->view('dashboard',$data);
			
		}
		else
		{
			redirect('admin','refresh');
		}
		
	}
	function add_hotels()
	{
	if($_SESSION['admin']!='')
	{
		$data['country'] =$country= $this->Home_Model->get_country();		
		$this->load->view('addhotels',$data);
	}
	else
	{
	redirect('admin','refresh');
	
	}
		//$this->load->view('addhotels');
	}
	function add_cars()
	{
	if($_SESSION['admin']!='')
	{
		$data['country'] =$country= $this->Home_Model->get_country();		
		$this->load->view('addcars',$data);
	}
	else
	{
	redirect('admin','refresh');
	
	}
		//$this->load->view('addhotels');
	}
	

	function view_hotels()
	{
		
		if($_SESSION['admin']!='')
		{
			
			$this->load->view('viewhotels');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function filter()
	{
		if($this->session->userdata('admin_id')!='')
		{
		$data['agency_name']= $agency_name=$this->input->post('hotel');
		if($agency_name!="Select" && $agency_name!="all")
		{
	       	$data['agents'] = $agents = $this->Home_Model->hotel_FILTER_byname($agency_name);
			$data['cnt'] = $this->Home_Model->get_cnt($agents[0]->country);
		}
		if($agency_name=="all")
		{
		
			$data['agents']= $agents = $this->Home_Model->view_agents();
			$data['cnt'] = $this->Home_Model->get_cnt($agents[0]->country);
		}
		$this->load->view('header');
	    $this->load->view('view_age',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function view_cust_details($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['users'] = $this->Home_Model->edit_user($id);
			$data['user_type'] = $user_type = $this->Home_Model->get_uer_type();
			$data['country'] =$country= $this->Home_Model->get_country();
			$data['commid'] = $commid = $this->Home_Model->get_comm_id();
			//$data['customer'] = $this->Home_Model->view_cust_details($id);
			$this->load->view('view_cust_details',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function change_pwd()
	{
		if($this->session->userdata('admin_id')!='')
		{
		//$data['msg']='';
			$this->load->view('change_password');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function logout()
	{
		//echo $_SESSION['admin'];
		//echo $this->session->userdata('admin');
		// echo $this->session->unset_userdata('admin');
		  $this->session->sess_destroy();
	 	//$this->session->set_userdata(array('admin'=>''));
		redirect('admin', 'refresh');
		
	}
	function password_check()
	{
		if($this->session->userdata('admin_id'))
		{
			$adminid = $this->session->userdata('admin_id');
			$oldpwd = $this->input->post('current_pwd');
			$newpwd = $this->input->post('new_pwd');
			$res = $this->Home_Model->change_pwd($adminid,$oldpwd,$newpwd);
			if($res)
			{
				$this->Home_Model->update_pwd($adminid,$newpwd);
				$data['msg']= "Your Password successfully changed";
				$this->load->view('change_password',$data); 
			}
			else
			{
				$data['msg'] = "Passwords Mismatch";
			   $this->load->view('change_password');
			}
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_hotel_info()
	{
		$hotel_name = $this->input->post('hotel_name');
		$contact_person = $this->input->post('cpname');
		$email = $this->input->post('email');
		$office_no = $this->input->post('office_no');
		$website = $this->input->post('website');
		$city = $this->input->post('city');
		$btoc=$this->input->post('b2c');
		$btob=$this->input->post('b2b');
	  	if($btob!="" && $btoc!="" )
	  	{
			$sell_envirn='all';
	 	}
		else if($btob!="" && $btoc=="" )
		{
			$sell_envirn=$btob;
		}
		else if($btob=="" && $btoc!="" )
		{
		       $sell_envirn=$btoc;
		}
		else
		{
	 	      $sell_envirn='all';
	 	 }
		$data['res'] = $this->Home_Model->add_hotel($hotel_name,$contact_person,$email,$office_no,$website,$city,$sell_envirn);
		redirect('hotel/view_hotels',$data);	
	}
	function add_package_info()
	{
		$package_name = $this->input->post('package_name');
		$hotel_name = $this->input->post('hotel_name');
		$days = $this->input->post('days');
		$nights = $this->input->post('nights');
		$city = $this->input->post('city');
		$startdate = $this->input->post('startdate');
		list($d,$m,$y) = explode('/',$startdate);
		$newdate = $y.'-'.$m.'-'.$d;
		$enddate = $this->input->post('enddate');
		list($d1,$m1,$y1) = explode('/',$enddate);
		$newdate1 = $y1.'-'.$m1.'-'.$d1;
		$cost = $this->input->post('cost');
		$specification = $this->input->post('specification');
		$map = $this->input->post('map');
		$data['res'] = $this->Home_Model->add_package($package_name,$hotel_name,$days,$nights,$city,$newdate,$newdate1,$cost,$specification,$map);
		redirect('hotel/view_packages',$data);	
	}
	function update_package_info()
	{
		$id = $this->input->post('package_id');
		$package_name = $this->input->post('package_name');
		$hotel_name = $this->input->post('hotel_name');
		$days = $this->input->post('days');
		$nights = $this->input->post('nights');
		$city = $this->input->post('city');
		$startdate = $this->input->post('startdate');
		list($d,$m,$y) = explode('/',$startdate);
		$newdate = $y.'-'.$m.'-'.$d;
		$enddate = $this->input->post('enddate');
		list($d1,$m1,$y1) = explode('/',$enddate);
		$newdate1 = $y1.'-'.$m1.'-'.$d1;
		$cost = $this->input->post('cost');
		$specification = $this->input->post('specification');
		$map = $this->input->post('map');
		$data['res'] = $this->Home_Model->update_package($package_name,$hotel_name,$days,$nights,$city,$newdate,$newdate1,$cost,$specification,$id,$map);
		redirect('hotel/view_packages',$data);
	}
	function view_cars()
	{  
		if($_SESSION['admin']!='')
   		{
                	 $data['hotel_name']='';
			 $data['hotel_city']='';
			$data['hotel_desc']= $this->Hotel_Model->car_details();
			$data['hotel_desc_name']= $this->Hotel_Model->car_details_merge();
			$data['hotel_desc_city']= $this->Hotel_Model->car_city_details();
			$this->load->view('header');
	     	        $this->load->view('viewcars',$data);
   		}
   		else
   		{
		       redirect('admin','refresh');
	   
	 	}
	   
	}
	function add_car_info()
	{
		$hotel_name = $this->input->post('hotel_name');
		$contact_person = $this->input->post('cpname');
		$email = $this->input->post('email');
		$office_no = $this->input->post('office_no');
		$website = $this->input->post('website');
		$city = $this->input->post('city');
		$btoc=$this->input->post('b2c');
		$btob=$this->input->post('b2b');
	  	if($btob!="" && $btoc!="" )
	  	{
			$sell_envirn='all';
	 	}
		else if($btob!="" && $btoc=="" )
		{
			$sell_envirn=$btob;
		}
		else if($btob=="" && $btoc!="" )
		{
		       $sell_envirn=$btoc;
		}
		else
		{
	 	      $sell_envirn='all';
	 	 }
		$data['res'] = $this->Home_Model->add_car($hotel_name,$contact_person,$email,$office_no,$website,$city,$sell_envirn);
		redirect('admin/view_cars',$data);	
	}
	function add_moreimages($id)
	{
		if($_SESSION['admin']!='')
		{
			$data['hotel_id'] = $id;
			$data['res'] = $this->Home_Model->get_image($id);	
			$this->load->view('add_images',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_packageimages($id)
	{
		if($_SESSION['admin']!='')
		{
			$data['hotel_id'] = $id;
			$data['res'] = $this->Home_Model->get_packimage($id);	
			//echo "<pre>"; print_r($data['res']);exit;
			$this->load->view('pack_images',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_images_info()
	{
		if($_SESSION['admin']!='')
		{
			$hotel_id = $this->input->post('hotelid');
			if(isset($_FILES['image1']['name'])!='' && $_FILES['image1']['type']=='image/jpeg' || $_FILES['image1']['type']=='image/jpg' || $_FILES['image1']['type']=='image/gif' || $_FILES['image1']['type']=='image/png')
			  {         
			        $file=$_FILES['image1']['name'];             
				copy($_FILES['image1']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img1="hotel1".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img1);			
	    		 }
			 else
			 {
				$img1 = $this->input->post('img1');
			 }
			if(isset($_FILES['image2']['name'])!='' && $_FILES['image2']['type']=='image/jpeg' || $_FILES['image2']['type']=='image/jpg' || $_FILES['image2']['type']=='image/gif' || $_FILES['image2']['type']=='image/png')
			  {         
			        $file=$_FILES['image2']['name'];             
				copy($_FILES['image2']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img2="hotel2".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img2);				 
	    		 }
			  else
			 {
				$img2 = $this->input->post('img2');
			 }
			if(isset($_FILES['image3']['name'])!='' && $_FILES['image3']['type']=='image/jpeg' || $_FILES['image3']['type']=='image/jpg' || $_FILES['image3']['type']=='image/gif' || $_FILES['image3']['type']=='image/png')
			  {         
			        $file=$_FILES['image3']['name'];             
				copy($_FILES['image3']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img3="hotel3".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img3);				 
	    		 }
			 else
			 {
				$img3 = $this->input->post('img3');
			 }
			if(isset($_FILES['image4']['name'])!='' && $_FILES['image4']['type']=='image/jpeg' || $_FILES['image4']['type']=='image/jpg' || $_FILES['image4']['type']=='image/gif' || $_FILES['image4']['type']=='image/png')
			  {         
			        $file=$_FILES['image4']['name'];             
				copy($_FILES['image4']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img4="hotel4".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img4);				 
	    		 }
			 else
			 {
				$img4 = $this->input->post('img4');
			 }
			if(isset($_FILES['image5']['name'])!='' && $_FILES['image5']['type']=='image/jpeg' || $_FILES['image5']['type']=='image/jpg' || $_FILES['image5']['type']=='image/gif' || $_FILES['image5']['type']=='image/png')
			  {         
			        $file=$_FILES['image5']['name'];             
				copy($_FILES['image5']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img5="hotel5".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img5);				 
	    		 }
			 else
			 {
				$img5 = $this->input->post('img5');
			 }
			$this->Home_Model->insert_image($img1,$img2,$img3,$img4,$img5,$hotel_id);		
			redirect('admin/add_packageimages/'.$hotel_id,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}		
	}
	function add_images_pack()
	{
		if($_SESSION['admin']!='')
		{
			$hotel_id = $this->input->post('hotelid');
			if(isset($_FILES['image1']['name'])!='' && $_FILES['image1']['type']=='image/jpeg' || $_FILES['image1']['type']=='image/jpg' || $_FILES['image1']['type']=='image/gif' || $_FILES['image1']['type']=='image/png')
			  {         
			        $file=$_FILES['image1']['name'];             
				copy($_FILES['image1']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img1="pack1".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img1);			
	    		 }
			 else
			 {
				$img1 = $this->input->post('img1');
			 }
			if(isset($_FILES['image2']['name'])!='' && $_FILES['image2']['type']=='image/jpeg' || $_FILES['image2']['type']=='image/jpg' || $_FILES['image2']['type']=='image/gif' || $_FILES['image2']['type']=='image/png')
			  {         
			        $file=$_FILES['image2']['name'];             
				copy($_FILES['image2']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img2="pack2".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img2);				 
	    		 }
			  else
			 {
				$img2 = $this->input->post('img2');
			 }
			if(isset($_FILES['image3']['name'])!='' && $_FILES['image3']['type']=='image/jpeg' || $_FILES['image3']['type']=='image/jpg' || $_FILES['image3']['type']=='image/gif' || $_FILES['image3']['type']=='image/png')
			  {         
			        $file=$_FILES['image3']['name'];             
				copy($_FILES['image3']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img3="pack3".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img3);				 
	    		 }
			 else
			 {
				$img3 = $this->input->post('img3');
			 }
			if(isset($_FILES['image4']['name'])!='' && $_FILES['image4']['type']=='image/jpeg' || $_FILES['image4']['type']=='image/jpg' || $_FILES['image4']['type']=='image/gif' || $_FILES['image4']['type']=='image/png')
			  {         
			        $file=$_FILES['image4']['name'];             
				copy($_FILES['image4']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img4="pack4".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img4);				 
	    		 }
			 else
			 {
				$img4 = $this->input->post('img4');
			 }
			if(isset($_FILES['image5']['name'])!='' && $_FILES['image5']['type']=='image/jpeg' || $_FILES['image5']['type']=='image/jpg' || $_FILES['image5']['type']=='image/gif' || $_FILES['image5']['type']=='image/png')
			  {         
			        $file=$_FILES['image5']['name'];             
				copy($_FILES['image5']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img5="pack5".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img5);				 
	    		 }
			 else
			 {
				$img5 = $this->input->post('img5');
			 }
			$this->Home_Model->insert_pack_image($img1,$img2,$img3,$img4,$img5,$hotel_id);		
			redirect('admin/add_packageimages/'.$hotel_id,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}		
	}
	function markup()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$adminid=$this->session->userdata('adminid');	
			$data['markup']=$this->Home_Model->get_markup();
			$this->load->view('view_common_settings',$data);
		}
		else
		{
			redirect('admin','refresh');
		}					
	}
	function markup1()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$adminid=$this->session->userdata('adminid');	
			$data['markup']=$this->Home_Model->get_markup();
			$this->load->view('view_common_settings',$data);
		}
		else
		{
			redirect('admin','refresh');
		}					
	}
	function rebate_setting()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$adminid=$this->session->userdata('adminid');	
			$data['markup']=$this->Home_Model->get_rebate();
			$this->load->view('view_rebate_settings',$data);
		}
		else
		{
			redirect('admin','refresh');
		}	
	}
	function insert_rebate()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$markup_type = $this->input->post('markup_type');
			$payment_gateway = $this->input->post('payment_gateway');
			$bus = $this->input->post('bus');
			$car = $this->input->post('car');
			$hotel = $this->input->post('hotel');
			$air_india = $this->input->post('air_india');
			$jetairways = $this->input->post('jetairways');
			$jetlite = $this->input->post('jetlite');
			$kingfisher = $this->input->post('kingfisher');
			$airindia_express = $this->input->post('airindia_express');
			$goair = $this->input->post('goair');
			$indigo = $this->input->post('indigo');
			$spicjet = $this->input->post('spicjet');
			$air_india_inter = $this->input->post('air_india_inter');
			$jetairways_inter = $this->input->post('jetairways_inter');
			$jetlite_inter = $this->input->post('jetlite_inter');
			$kingfisher_inter = $this->input->post('kingfisher_inter');
			$airindia_express_inter = $this->input->post('airindia_express_inter');
			$goair_inter = $this->input->post('goair_inter');
			$indigo_inter = $this->input->post('indigo_inter');
			$mdlr = $this->input->post('mdlr');
			$paramount = $this->input->post('paramount');
			$spicejet = $this->input->post('spicejet');
			$other_flights = $this->input->post('other_flights');
			$holidays = $this->input->post('holidays');
			$this->Home_Model->update_rebate($payment_gateway,$bus,$car,$hotel,$air_india,$jetairways,$jetlite,$kingfisher,$airindia_express,$goair,$indigo,$spicjet,$air_india_inter,$jetairways_inter,$jetlite_inter,$kingfisher_inter,$airindia_express_inter,$goair_inter,$indigo_inter,$mdlr,$paramount,$spicejet,$other_flights,$holidays,$markup_type);
			redirect('admin/rebate_setting','refresh');			
		}
		else
		{
			redirect('admin','refresh');
		}	
	}
	function insert_marup()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$markup_type = $this->input->post('markup_type');
			$payment_gateway = $this->input->post('payment_gateway');
			$football = $this->input->post('football');
			$football_type = $this->input->post('football_type');
			//$bus = $this->input->post('bus');
			//$car = $this->input->post('car');
			$hotel = $this->input->post('hotel');
			/*$air_india = $this->input->post('air_india');
			$jetairways = $this->input->post('jetairways');
			$jetlite = $this->input->post('jetlite');
			$kingfisher = $this->input->post('kingfisher');
			$airindia_express = $this->input->post('airindia_express');
			$goair = $this->input->post('goair');
			$indigo = $this->input->post('indigo');
			$spicjet = $this->input->post('spicjet');
			$air_india_inter = $this->input->post('air_india_inter');
			$jetairways_inter = $this->input->post('jetairways_inter');
			$jetlite_inter = $this->input->post('jetlite_inter');
			$kingfisher_inter = $this->input->post('kingfisher_inter');
			$airindia_express_inter = $this->input->post('airindia_express_inter');
			$goair_inter = $this->input->post('goair_inter');
			$indigo_inter = $this->input->post('indigo_inter');
			$mdlr = $this->input->post('mdlr');
			$paramount = $this->input->post('paramount');
			$spicejet = $this->input->post('spicejet');
			$other_flights = $this->input->post('other_flights');*/
			$holidays = $this->input->post('holidays');
			
			//$bus_type = $this->input->post('bus_type');
			$gateway_type = $this->input->post('gateway_type');
			//$car_type = $this->input->post('car_type');
			$hotel_type = $this->input->post('hotel_type');
			$holiday_type = $this->input->post('holiday_type');
			$this->Home_Model->update_markup_new($payment_gateway,$gateway_type,$hotel,$hotel_type,$holidays,$holiday_type,$football_type,$football);
			/*$air_india_type = $this->input->post('air_india_type');
			$jetairways_type = $this->input->post('jetairways_type');
			$jetlite_type = $this->input->post('jetlite_type');
			$kingfisher_type = $this->input->post('kingfisher_type');
			$airindia_express_type = $this->input->post('airindia_express_type');
			$goair_type = $this->input->post('goair_type');
			$indigo_type = $this->input->post('indigo_type');
			$spicjet_type = $this->input->post('spicjet_type');
			$air_india_inter_type = $this->input->post('air_india_inter_type');
			$jetairways_inter_type = $this->input->post('jetairways_inter_type');
			$jetlite_inter_type = $this->input->post('jetlite_inter_type');
			$kingfisher_inter_type = $this->input->post('kingfisher_inter_type');
			$airindia_express_inter_type = $this->input->post('airindia_express_inter_type');
			$goair_inter_type = $this->input->post('goair_inter_type');
			$indigo_inter_type = $this->input->post('indigo_inter_type');
			$mdlr_type = $this->input->post('mdlr_type');
			$spicejet_type = $this->input->post('spicejet_type');
			$other_flights_type = $this->input->post('other_flights_type');*/
			
			//$this->Home_Model->update_markup($payment_gateway,$bus,$car,$hotel,$air_india,$jetairways,$jetlite,$kingfisher,$airindia_express,$goair,$indigo,$spicjet,$air_india_inter,$jetairways_inter,$jetlite_inter,$kingfisher_inter,$airindia_express_inter,$goair_inter,$indigo_inter,$mdlr,$paramount,$spicejet,$other_flights,$holidays,$bus_type,$gateway_type,$car_type,$hotel_type,$holiday_type,$air_india_type,$jetairways_type,$jetlite_type,$kingfisher_type,$airindia_express_type,$goair_type,$indigo_type,$spicjet_type,$air_india_inter_type,$jetairways_inter_type,$jetlite_inter_type,$kingfisher_inter_type,$airindia_express_inter_type,$goair_inter_type,$indigo_inter_type,$mdlr_type,$spicejet_type ,$other_flights_type);
			redirect('admin/markup','refresh');			
		}
		else
		{
			redirect('admin','refresh');
		}	
	}
	function add_user_type()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$adminid=$this->session->userdata('adminid');	
			$data['commission_list']=$this->Home_Model->add_user_type();
			$this->load->view('add_user_type',$data);
		}
		else
		{
			redirect('admin','refresh');
		}					
	}
	function add_commission_details()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$value = $this->input->post('value');
			//$type = $this->input->post('type');
			$type = 2;
			$created_by = 1;
			$this->Home_Model->add_commission_detail($value,$type,$created_by);
			redirect('admin/markup','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function user_type()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$value = $this->input->post('user_type');
			$this->Home_Model->user_type($value);
			redirect('admin/add_user_type','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
function website_settings()
{
	
		if($this->session->userdata('admin_id')!='')
		{
					$adminid=$this->session->userdata('adminid');	
                 $data['websetting_details']=$websetting_details = $this->Home_Model->website_settings_details();
				$data['currency_types'] = $res = $this->Home_Model->get_currency_types();
				$this->load->view('view_website_settings',$data);
					//$this->load->view('admin/footer');
		}
		else
		{
			redirect('admin','refresh');
		}	
	
}
	function website_settings_update(){
	
	   $id=$this->input->post('web_id');
	   $post_data=array('name'=>$this->input->post('name'),'company_name'=>$this->input->post('company_name'),'website_url'=>$this->input->post('web_url'),'email_id'=>$this->input->post('email_id'),'contact_no'=>$this->input->post('contact_no'),'address'=>$this->input->post('address'),'fixed_amount'=>$this->input->post('fixed_amount'),'currency_id'=>$this->input->post('currency'));
		 $websetting_result=$this->Home_Model->website_settings_update($post_data,$id);
		
		 if($_SESSION['admin'] !=''){
				$data['username'] = $this->session->userdata('username');
				$data['websetting_details']=$websetting_details = $this->Home_Model->website_settings_details();
				$data['currency_types'] = $res = $this->Home_Model->get_currency_types();
				/*print_r($websetting_details);
				exit;*/
				$this->load->view('view_website_settings',$data);
		}else{
			redirect('admin','refresh');
		}
	
	}
function api_control()
{
	
			if($_SESSION['admin'] !='')
		{
					$adminid=$this->session->userdata('adminid');	
					$data['apiselect']=$this->Home_Model->apiselect();
					$this->load->view('view_api_control',$data);
					//$this->load->view('admin/footer');
		}
		else
		{
			redirect('admin','refresh');
		}	
	
}

function currency_details()
	{
		
		
		if(isset($_POST['profit']))
		{
			$cur_type =$this->input->post('profit');
			$data['profit']=$cur_type;
			$this->session->set_userdata(array('profit'=>$cur_type));
			$this->Admin_Model->currency_margin_update($cur_type);
		}
		else
		{
			$data['profit']='';
		}
		if($this->session->userdata('admin_id')!='')
		{
			$data['currency_list']=$this->Home_Model->currency_details();
			$data['default_currency'] = $this->Home_Model->default_currency();
			$this->load->view('view_currency_settings',$data);
				
		}else
		{
			redirect('admin','refresh');
		}
	}
function edit_commission_details()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$comm_id = $this->input->post('comm_id');
			$markup = $this->input->post('markup');
			$this->Home_Model->edit_commission_details($comm_id,$markup);
			$data['commission_list']=$this->Home_Model->view_commission_detail();
		    redirect('admin/markup','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function ipcontrol()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['commission_list'] = $this->Home_Model->get_ip();
			$this->load->view('addip',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function insert_ip()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$ipadds = $this->input->post('ipadds');
			$desc = $this->input->post('desc');
			$this->Home_Model->insert_ip($ipadds,$desc);
			redirect('admin/ipcontrol','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
		
	}
	function edit_currency_details()
	{
		if($_SESSION['admin'] !='' )
		{
					
				$currencyid=$this->input->post('currency_id');
				$amt=$this->input->post('value');
				
				$this->Home_Model->update_currency_detail($currencyid,$amt);
				$data['currency_list']=$this->Home_Model->currency_details();
				$data['default_currency'] = $this->Home_Model->default_currency();
				$this->load->view('view_currency_settings',$data);
				
				
				
		}else{
			redirect('member','refresh');
		}
	}

function api_status($id,$status)
{
	if($_SESSION['admin']!=''){
		
			
			if($status==1)
			{
					$status=0;
					
					$this->Home_Model->api_status($id,$status);
					redirect('admin/api_control','refresh');
			}
			else if($status==0)
			{
				$status=1;
				$this->Home_Model->api_status($id,$status);
				redirect('admin/api_control','refresh');
			}
						
				
		}else{
			redirect('admin','refresh');
		}

	}
	function add_currecny()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('header');
			$this->load->view('add_currency');
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
		
	}
	function add_currency_details()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$currency_code = $this->input->post('currency_code');
			$currency_name = $this->input->post('currency_name');
			$amount = $this->input->post('amount');
			$this->Home_Model->add_currency_details($currency_code,$currency_name,$amount);
			redirect('admin/currency_details','refresh');
			
		}
		else
		{
			redirect('admin','refresh');
		}
		
	}
	function edit_currency($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['edit_currency'] = $this->Home_Model->edit_currency($id);
			$this->load->view('header');
			$this->load->view('edit_currency',$data);
			$this->load->view('footer');
			
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_currency_details($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$currency_code = $this->input->post('currency_code');
			$currency_name = $this->input->post('currency_name');
			$amount = $this->input->post('amount');
			$this->Home_Model->update_currency_details($currency_code,$currency_name,$amount,$id);
			redirect('admin/currency_details','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_currency_details($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_currency_details($id);
			redirect('admin/currency_details','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function delete_customer_details($custid)
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_customer_details($custid);
			redirect('admin/customer_details','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
		
	function view_agents()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$perpage=15;
	   	 	$product_id = $this->uri->segment(3, 0);
			$data['agents'] = $this->Home_Model->view_agents();
			//$data['agents'] = $this->Home_Model->view_agents_per($product_id,$perpage);
			//$data['cnt'] =  $this->Home_Model->get_cnt($agents[0]->country);
			//$count= count($agents);
			//$config['base_url'] = base_url().'index.php/admin/view_agents';
			////$config['total_rows'] = $count;
			//$config['per_page'] = 15;
			//$this->pagination->initialize($config);	 
			$this->load->view('header');		
			//$this->load->view('view_agents',$data);
			
			$this->load->view('view_age',$data);
			
			$this->load->view('footer'); 
			
			
			
		
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function customer_details()
	{
		if($this->session->userdata('admin_id')!='')
		{
			/*$perpage=15;
	   	 	$product_id = $this->uri->segment(3, 0);*/
			$data['customer'] = $this->Home_Model->view_customers1();
			//$data['customer'] = $this->Home_Model->view_customers_per($product_id,$perpage);
			/*$count= count($customer);
			$config['base_url'] = base_url().'index.php/admin/customer_details';
			$config['total_rows'] = $count;
			$config['per_page'] = 15;
			$this->pagination->initialize($config);	*/
			$this->load->view('header');		
			$this->load->view('view_customers',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_customer($custid)
	{
		if($_SESSION['admin']!='')
		{
			$data['country'] =$country= $this->Home_Model->get_country();
			$data['cust'] = $this->Home_Model->view_customer_detail1($custid);
			$this->load->view('edit_customer',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
		
	}
function update_cust_details()
	{
	
if($_SESSION['admin']!='')
		{
			$cust_id=$this->input->post('cust_id');
			$agent_name=$this->input->post('agent_name');
			$last_name=$this->input->post('last_name');
			$address=$this->input->post('address');
			$city=$this->input->post('city');
			$pincode=$this->input->post('pincode');
			$country=$this->input->post('country');
			$email=$this->input->post('login_mail');
			$mobile=$this->input->post('mobile');
			$country_code=$this->input->post('inputfiled7');
			$main_mob=$mobile;
			$password=$this->input->post('password');
			$confirm_password=$this->input->post('confirm_password');
		
			//if($_SESSION["captcha"]==$captcha)
			//{

				$custid=$this->Home_Model->update_customer($agent_name,$last_name,$address,$city,$pincode,$country,$mobile,$cust_id);
				
				redirect('admin/customer_details','refresh');
			
			}
			else
		{
			redirect('admin','refresh');
		}
		}
		
	
		

	function view_visa()
	{
		if($_SESSION['admin']!='')
		{
			$perpage=15;
	   	 	$product_id = $this->uri->segment(3, 0);
			$visa = $this->Home_Model->view_visa_applied();
			$data['visa'] =  $this->Home_Model->view_visa_applied_per($product_id,$perpage);
			$count= count($visa);
			$config['base_url'] = base_url().'index.php/vehicle/viewvehicledetails';
			$config['total_rows'] = $count;
			$config['per_page'] = 15;
			$this->pagination->initialize($config);	
			//$data['visa_dependent'] = $this->Home_Model->view_visa_applied_with_dependent($visaid);
			$this->load->view('header');		
			$this->load->view('view_visa',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	
	
	function edit_visa($id)
	{
	   if($_SESSION['admin']!='')
	   {
			    $data['visa_det']=$this->Home_Model->visa_det($id);
				$data['visa_dependent'] = $this->Home_Model->view_visa_applied_with_dependent($id);
			    $data['visa_id']=$id;
				$this->load->view('view_visa_det',$data);
				
	   }
	   else
	   {
		   redirect('admin','refresh');
		   
	   }
	}

	
	function user_status($status,$id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->update_agent_status($status,$id);
			redirect('admin/view_users','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function sup_approval($id)
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
			  redirect('admin/edit_sup/'.$id,'refresh');	  
		}	
	}
	function sup_status($status,$id)
	{		
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->update_sup_status($status,$id);
			redirect('admin/view_suppliers','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function prop_status($status,$id)
	{		
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->update_prop_status($status,$id);
			redirect('admin/view_prop/'.$this->session->userdata('admin_user_id'),'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function agent_approval($id)
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
		redirect('admin/edit_agent/'.$id,'refresh');
	}
	function agent_view_status($status,$id)
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->agent_view_status($status,$id);
			redirect('admin/view_agents','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	
	function delete_user($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_user($id);
			redirect('admin/view_users','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_sup($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_sup($id);
			redirect('admin/view_suppliers','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function delete_viewagent($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_viewagent($id);
			redirect('admin/view_agents','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function visa_status($status,$id)
	{
		if($_SESSION['admin']!='')
		{
	
			$this->Home_Model->update_visa_status($status,$id);
			redirect('admin/view_visa','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function delete_visa($id)
	{
	   if($_SESSION['admin']!='')
	   {
			$this->Home_Model->delete_visa_applied($id);
			redirect('admin/view_visa','refresh');
	   }
	   else
	   {
		   redirect('admin','refresh');
		   
	   }
			
	}

	function view_agent_details()
	{
		if($this->session->userdata('admin_id') !='')
			{
				$adminid=$this->session->userdata('admin_id');
				//$data['admin_info']=$this->Home_Model->admin_last_login($adminid);
				
				$data['list_agent']=$this->Home_Model->list_agent();
				
				$this->load->view('header',$data);
				$this->load->view('list_agents',$data);
				$this->load->view('footer');
			}
			else
			{
				redirect('admin/index','refresh');
			}
		 
	}
	function view_user_detail($id)
	 {
		 
		 if($this->session->userdata('admin_id') !='')
			{
				$data['id']=$id;
				$data['user_list']=$user_list=$this->Home_Model->view_agent_detail($id);
				$data['deposit_list']=$this->Home_Model->agent_deposit($id);
				$data['admin_deposit_list']=$this->Home_Model->admin_deposit_details($id);
				$data['agent_markup'] = $this->Home_Model->get_agent_markup($id);
				$this->load->view('header',$data);
				$this->load->view('view_user_detail',$data);
				//$this->load->view('footer');
			}
			else
			{
				redirect('admin/index','refresh');
			}
		 
		}
		function markup_agents($agent_id)
		{
			$this->Home_Model->delete_markup($agent_id);
			$payment_gateway = $this->input->post('payment_gateway');
			$gateway_type = $this->input->post('gateway_type');
			$hotel = $this->input->post('hotel');
			$hotel_type = $this->input->post('hotel_type');
			$bus = $this->input->post('bus');
			$bus_type = $this->input->post('bus_type');
			$car = $this->input->post('car');
			$car_type = $this->input->post('car_type');
			$holidays = $this->input->post('holidays');
			$holiday_type = $this->input->post('holiday_type');
			$airindia_dom = $this->input->post('airindia_dom');
			$airindia_type = $this->input->post('airindia_type');
			$jet_airways_dom = $this->input->post('jet_airways_dom');
			$jeta_type = $this->input->post('jeta_type');
			$jetlite_dom = $this->input->post('jetlite_dom');
			$jetlite_type = $this->input->post('jetlite_type');
			$kingfisher_dom = $this->input->post('kingfisher_dom');
			$kingfisher_type = $this->input->post('kingfisher_type');
			$airindia_express = $this->input->post('airindia_express');
			$aiindiaex_type = $this->input->post('aiindiaex_type');
			$goair_dom = $this->input->post('goair_dom');
			$goair_type = $this->input->post('goair_type');
			$indigo_dom = $this->input->post('indigo_dom');
			$indigo_type = $this->input->post('indigo_type');
			$spicejet_dom = $this->input->post('spicejet_dom');
			$spicejet_type = $this->input->post('spicejet_type');
			$all_dom_airline = $this->input->post('all_dom_airline');
			$other_airline = $this->input->post('other_airline');
			
			$airindia_inter = $this->input->post('airindia_inter');
			$airindia_typeinter = $this->input->post('airindia_typeinter');
			$jetairways_inter = $this->input->post('jetairways_inter');
			$jetairways_typeinter = $this->input->post('jetairways_typeinter');
			$jetlite_inter = $this->input->post('jetlite_inter');
			$jetlite_typeinter = $this->input->post('jetlite_typeinter');
			$kingfisher_inter = $this->input->post('kingfisher_inter');
			$kingfisher_typeinter = $this->input->post('kingfisher_typeinter');
			$airindiaexp_inter = $this->input->post('airindiaexp_inter');
			$airindiaex_typeinter = $this->input->post('airindiaex_typeinter');
			$goair_inter = $this->input->post('goair_inter');
			$goair_typeinter = $this->input->post('goair_typeinter');
			$indigo_inter = $this->input->post('indigo_inter');
			$indigo_typeinter = $this->input->post('indigo_typeinter');
			$mdlr_inter = $this->input->post('mdlr_inter');
			$mdlr_typeinter = $this->input->post('mdlr_typeinter');
			$paramount_inter = $this->input->post('paramount_inter');
			$paramount_typeinter = $this->input->post('paramount_typeinter');
			$spicejet_inter = $this->input->post('spicejet_inter');
			$spicejet_typeinter = $this->input->post('spicejet_typeinter');
			$other_inter = $this->input->post('other_inter');
			$other_typeinter = $this->input->post('other_typeinter');
			$this->Home_Model->markup_agents_insert($agent_id,$payment_gateway,$gateway_type,$hotel,$hotel_type,$bus,$bus_type,$car,$car_type,$holidays,$holiday_type,$airindia_dom,$airindia_type,$jet_airways_dom,$jeta_type,$jetlite_dom,$jetlite_type,$kingfisher_dom,$kingfisher_type,$airindia_express,$aiindiaex_type,$goair_dom,$goair_type,$indigo_dom,$indigo_type,$spicejet_dom,$spicejet_type,$all_dom_airline,$other_airline,$airindia_inter,$airindia_typeinter,$jetairways_inter,$jetairways_typeinter,$jetlite_inter,$jetlite_typeinter,$kingfisher_inter,$kingfisher_typeinter,$airindiaexp_inter,$airindiaex_typeinter,$goair_inter,$goair_typeinter,$indigo_inter,$indigo_typeinter,$mdlr_inter,$mdlr_typeinter,$paramount_inter,$paramount_typeinter,$spicejet_inter,$spicejet_typeinter,$other_inter,$other_typeinter);
			redirect('admin/view_user_detail/'.$agent_id,'refresh');
		}
		function add_deposit_details()
		{
		
		if($this->session->userdata('admin_id') !='')
			{
			
			//echo'<pre/>';print_r($_POST);
		
			$agnt=$this->input->post('agentid');
			$amount_depo=$this->input->post('amount_depo');
			$current_limit=$this->input->post('current_limit');
			$dob=$this->input->post('dod');
			$mode_of_depo=$this->input->post('users');
			$bank_name=$this->input->post('bank_name');
			$branch_name=$this->input->post('branch_name');
			$city=$this->input->post('city');
			$remarks=$this->input->post('remarks');
			
			$trans_id=$this->input->post('transaction_id');
			$cheque_no=$this->input->post('cheque_no');
			$cheque_date=$this->input->post('cheque_date');	
		
			$dob1 = explode('/',$dob);
			$dob = $dob1[2]."-".$dob1[1]."-".$dob1[0];
			$admin_name = $this->input->post('admin_name');
			$remarks = $this->input->post('remarks');
			$this->Home_Model->add_new_deposit_details($agnt,$amount_depo,$current_limit,$dob,$mode_of_depo,$bank_name,$branch_name,$city,$remarks,$trans_id,$cheque_no,$cheque_date,$admin_name,$remarks);
			
			redirect('admin/view_user_detail/'.$agnt,'refresh');
	
	
						
				
			}
			else
			{
				$this->load->view('login_form');
			}
		}
		function change_status($agentid,$status)
		{
			//echo $status;
			//echo $this->session->userdata('adminid');exit;
			if($this->session->userdata('admin_id') !='')
			{
				
				if($status=='no')
				{
					$st = 'yes';
				}
				elseif($status=='yes')
				{
					$st = 'no';
				}
			
				$stat=$this->Home_Model->update_agent_status($agentid,$st);
				redirect('admin/view_agent_details','refresh');
				}
				else
				{
					redirect('admin/index','refresh');
				}
		}
		function create_agent_id($id)
		{
			if($this->session->userdata('admin_id') !='')
			{
				$data['id'] = $id;
				$this->load->view('header');
				$this->load->view('create_id',$data);
				$this->load->view('footer');
				}
				else
				{
					redirect('admin/index','refresh');
				}
		}
		function creates_agent_id($id)
		{
			$agent_id = $this->input->post('agent_id');
			$data = array('agent_id_new'=>$agent_id);
			$this->db->where('agent_id',$id);
			$this->db->update('agents',$data);
			redirect('admin//view_agent_details','refresh');
		}
		function export_agent()
		{
			 if($this->session->userdata('admin_id') !='')
			{
				$data['list_agent']=$this->Home_Model->list_agent();
				
				$this->load->view('list_agent_excel',$data);
				//$this->load->view('footer');
			}
			else
			{
				redirect('admin/index','refresh');
			}
		}
	function edit_discount($id)
	{
		if($_SESSION['admin']!='')
		{
			$discount = $this->input->post('discount');
			$data['discount'] = $this->Home_Model->discount($id,$discount);
			redirect('admin/view_agent_details/'.$id);
		}
		else
		{
			redirect('admin','refresh');
		}	
	}
	function delete_agent($id)
	{
		if($this->session->userdata('admin_id') !='')
		{
			$adminid=$this->session->userdata('admin_id');
			$deleted = $this->Home_Model->delete_agent($id);
			redirect('admin/view_agent_details','refresh');
		}
		else
		{
			redirect('admin/index','refresh');
		}
	}
	function bookings()
	{
		if($this->session->userdata('admin_id')!='')
		{	 
			//echo $class1 = $this->input->post('class1');exit;
			$newdate = ''; $newdate1 = '';
			$data['class1'] = $class = $this->input->post('class4');
			$data['hotel_city'] = $hotel_city= $this->input->post('hotel_city');
			$class1 = $this->input->post('class1');
			//echo $class; echo $class1;exit;
		//	echo $class;exit;
			if($class1 != '')
			{
				$data['class1'] = $class = $class1 ;
			}
			$hotel_city1 = $this->input->post('hotel_city1');
			if($hotel_city1 != '')
			{
				$data['hotel_city'] = $hotel_city = $hotel_city1;
			}
			$data['sd'] = $sd = $this->input->post('stdate');
			if($sd != '')
			{
				list($d,$m,$y) = explode('/',$sd);
				$newdate = $y.'-'.$m.'-'.$d;
			}
			$data['ed'] = $ed = $this->input->post('seconddate');
			if($ed != '')
			{
				list($d1,$m1,$y1) = explode('/',$ed);
				$newdate1 = $y1.'-'.$m1.'-'.$d1;
			}
			$data['stat'] = $stat = $this->input->post('stat');
			if($class1 && $hotel_city1 && $newdate && $newdate1)
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings4($class1,$hotel_city1,$newdate,$newdate1,$stat);
			}
			else if($class && $newdate && $newdate1)
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings5($class,$newdate,$newdate1,$stat);
			}
			else if($hotel_city && $newdate && $newdate1)
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings6($hotel_city,$newdate,$newdate1,$stat);
			}
			else if($class && $hotel_city && $stat)
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings2($class,$hotel_city,$stat);
			}
			else if($class && $stat)
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings1($class,$stat);
			}
			else if($hotel_city && $stat)
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings3($hotel_city,$stat);
			}
			else if($newdate && $newdate1)
			{
				//$stat = 1;
				$data['books'] = $books =  $this->Home_Model->get_bookings7($newdate,$newdate1,$stat);
			}
			else if($hotel_city)
			{
				//$stat = 1;
				$data['books'] = $books =  $this->Home_Model->get_bookings8($hotel_city,$stat);
			}
			else if($class)
			{
				//echo "aaa";exit;
				//$stat = 1;
				$data['books'] = $books =  $this->Home_Model->get_bookings9($class);
			}
			else if($stat)
			{
				//echo "hgfhkgk";exit;
				
				$data['books'] = $books =  $this->Home_Model->get_bookings($stat);
			}
			else 
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings10();
			}
			$data['class'] = $this->Home_Model->get_brand_name();
			$this->load->view('header');
			$this->load->view('search_booking',$data);
			$this->load->view('footer');
			
		}
		else
		{
			redirect('admin','refresh');
		}
		
	}
	function view_agent_bookings($id)
	{
		$newdate = '';
		$newdate1 = '';
		$data['stat'] = $stat = $this->input->post('stat');
		$data['sd'] = $sd = $this->input->post('stdate');
		if($sd != '')
		{
			list($d,$m,$y) = explode('/',$sd);
			$newdate = $y.'-'.$m.'-'.$d;
		}
		$data['ed'] = $ed = $this->input->post('seconddate');
		if($ed != '')
		{
			list($d1,$m1,$y1) = explode('/',$ed);
			$newdate1 = $y1.'-'.$m1.'-'.$d1;
		}
		if($newdate && $newdate1 && $stat)
		{
			$data['books'] = $books =  $this->Home_Model->view_agent_bookings_dates_status($id,$newdate,$newdate1,$stat);
			//echo "<pre>"; print_r($data['books']);exit;
		}
		else if($stat)
		{
			$data['books'] = $books =  $this->Home_Model->view_agent_bookings__status($id,$stat);
		}
		else
		{
			$data['books'] = $books =  $this->Home_Model->view_agent_bookings($id);
		}
		$data['id'] = $id;
		$this->load->view('header');
		$this->load->view('search_booking_agent',$data);
		$this->load->view('footer');
	}
	function view_cust_bookings($id)
	{
		$newdate = '';
		$newdate1 = '';
		$data['stat'] = $stat = $this->input->post('stat');
		$data['sd'] = $sd = $this->input->post('stdate');
		if($sd != '')
		{
			list($d,$m,$y) = explode('/',$sd);
			$newdate = $y.'-'.$m.'-'.$d;
		}
		$data['ed'] = $ed = $this->input->post('seconddate');
		if($ed != '')
		{
			list($d1,$m1,$y1) = explode('/',$ed);
			$newdate1 = $y1.'-'.$m1.'-'.$d1;
		}
		if($newdate && $newdate1 && $stat)
		{
			$data['books'] = $books =  $this->Home_Model->view_cust_bookings_dates_status($id,$newdate,$newdate1,$stat);
			//echo "<pre>"; print_r($data['books']);exit;
		}
		else if($stat)
		{
			$data['books'] = $books =  $this->Home_Model->view_cust_bookings__status($id,$stat);
		}
		else
		{
			$data['books'] = $books =  $this->Home_Model->view_cust_bookings($id);
		}
		$data['id'] = $id;
		$this->load->view('header');
		$this->load->view('search_booking_customer',$data);
		$this->load->view('footer');
	}
	function view_franchise_bookings($id)
	{
		$newdate = '';
		$newdate1 = '';
		$data['stat'] = $stat = $this->input->post('stat');
		$data['sd'] = $sd = $this->input->post('stdate');
		if($sd != '')
		{
			list($d,$m,$y) = explode('/',$sd);
			$newdate = $y.'-'.$m.'-'.$d;
		}
		$data['ed'] = $ed = $this->input->post('seconddate');
		if($ed != '')
		{
			list($d1,$m1,$y1) = explode('/',$ed);
			$newdate1 = $y1.'-'.$m1.'-'.$d1;
		}
		if($newdate && $newdate1 && $stat)
		{
			$data['books'] = $books =  $this->Home_Model->view_cust_bookings_dates_status($id,$newdate,$newdate1,$stat);
			//echo "<pre>"; print_r($data['books']);exit;
		}
		else if($stat)
		{
			$data['books'] = $books =  $this->Home_Model->view_cust_bookings__status($id,$stat);
		}
		else
		{
			$data['books'] = $books =  $this->Home_Model->view_cust_bookings($id);
		}
		$data['id'] = $id;
		$this->load->view('header');
		$this->load->view('search_booking_customer',$data);
		$this->load->view('footer');
	}
	function bookings1()
	{
		if($this->session->userdata('admin_id')!='')
		{	 
			//echo $class1 = $this->input->post('class1');exit;
			$data['class1'] = $class = $this->input->post('class4');
			$data['hotel_city'] = $hotel_city= $this->input->post('hotel_city');
	
			//echo $class; exit;
		//	echo $class;exit;
			$stat =1;
			if($class && $hotel_city)
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings2($class,$hotel_city,$stat);
			}
			else if($class )
			{
				//echo "anand";exit;
				$data['books'] = $books =  $this->Home_Model->get_bookings1($class,$stat);
			}
			else if($hotel_city )
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings3($hotel_city,$stat);
			}
			else 
			{
				$data['books'] = $books =  $this->Home_Model->get_bookings10();
			}
			$data['class'] = $this->Home_Model->get_brand_name();
			$this->load->view('header');
			$this->load->view('search_booking',$data);
			$this->load->view('footer');
			
		}
		else
		{
			redirect('admin','refresh');
		}
		
	}
	function view_bookings($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['bookings'] = $this->Home_Model->get_booking_details($id);
	   		$this->load->view('view_bookings',$data);	
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function resend_voucher()
	{
		$booking_ref = $this->input->post('booking_ref');
		$details = $this->Home_Model->get_resend_voucher($booking_ref);
		$get_confrm_mail = $this->Home_Model->get_confrm_mail();
		$get_booking_details = $this->Home_Model->get_booking_details($booking_ref);
//		echo "<pre>"; print_r($get_booking_details);exit;
		$get_book_details12=  $get_book_details12 = $this->Home_Model->get_book_details12($details->booking_no);
		$get_book_det =  $this->Home_Model->get_book_det($get_book_details12->passenger_info_id);	
		if($details->status == 'Available'){
		 $msg16 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style="  border-width:20;   ">		
						<table width="610" bgcolor="#ffffff" border-bottom:1px solid #ffffff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="610" height="30" align="left"  style=" background-color: #ebebeb;  border-bottom: 1px solid #cbcbcb;"> </td>		
							</tr>			
							<tr>
									<td width="582" valign="top" align="left"  style="background-color:#ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">				
		           			<table width="580" cellspacing="0" align="center" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="325" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><img src="'.WEB_DIR.'images/eml_purchaseconfirmation.png" width="180" height="50" border="0" alt="Purchase Confirmation" /><br />										 								<strong>'.$get_book_details12->firstname.',<br/><br/></strong>
								Thank you for booking your stay with Stayserviced.<br /><br />
						
				<strong>Your Stayserviced Booking No. is: '.$get_booking_details->booking_ref_no.'</strong><br />
				<strong>Your Stayserviced Pin Code is: '.$get_booking_details->itemcode.'</strong><br /><br />													
			
				To view and print this booking in PDF: <a href="">Click Here</a><br /><br />
				To change, amend or cancel your booking: <a href="https://www.stayserviced.com/index.php/home/guest_login/" style="color:#003466">Click Here</a></td> <br />																													
				</td>										
				<td width="245" valign="top">										 
				<img src="'.WEB_DIR.'images/eml_top_polaroidphotos_cities.jpg" width="240" height="216" border="0" alt="Stayserviced" />
				</td>				
			</tr>
		</table>
	</td>
</tr>						
								<tr>
  <td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Customer Support</strong></td>
						<td width="30%"><br /></td>
						<td align="left" width="35%"><br /></td>									
					</tr>
					<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><a href="mailto:cs@stayserviced.com" style="color:#003466">Email Stayserviced</a></td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><a href="https://stayserviced.tenderapp.com/discussion/new" style="color:#003466">Online Customer Support</a></td>     
					</tr>
     
						
																		                               
 				</table>
			</td>
					
						
		</tr>
	</table>									             
  </td>
</tr>	
						
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					 foreach($get_book_det as $row1){
					$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg16 .= 'N';}else{$msg16 .= 'Y';}
							$msg16 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg16 .='N';}else{$msg16 .= 'Y';}
						$msg16 .='</td>            
					</tr>';
					}
																	                               
 				$msg16 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						
				</tr>';
				foreach($get_book_det as $row1){
				$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg16 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg16 .='Non - refundable';}'</td>
					</tr>';
				}
				
					
				$msg16 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				foreach($get_book_det as $row1){
				$msg16 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' :</b> '.$row1->request.'</td>        

					</tr>';
				}
			$msg16 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
					
												<tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:15px 5px 0px 5px;">   																					 
		<table cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-bottom:10px;">
				<strong>Policies</strong>																		
				</td>															
			</tr>
				
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				A Government-issued photo ID is required at the accommodation and for additional services.
				</td>															
			</tr>	
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				You will be responsible for any additional services used during your stay
				</td>															
			</tr>								
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Any refund will be automatically processed to the credit card used during the transaction.
				</td>															
			</tr>
						<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				A no-show will be treated as a cancellation and you will be billed accordingly. 
				</td>															
			</tr>				
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Stayservicved does not charge a processing fee for cancellations. 
				</td>		
				<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Always refer to your Booking Reference '.$get_booking_details->booking_ref_no.' in all your correspondence.
				</td>													

			</tr>
			<tr>
				<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:5px 7px 0px 0px;">
				<a href="http://stayserviced.tenderapp.com/kb/general/terms-of-service" style="color:#003466">Terms of Service</a><br />
				<a href="http://www.stayserviced.com/index.php/home/faq/1" style="color:#003466">FAQs</a><br />
				<a href="http://www.stayserviced.com/index.php/home/aboutus" style="color:#003466">About Us</a><br /><br />			

												
							</td>
						</tr>
																		
	</table>
									
							</td>
						</tr>
						<td>
						 											
					
				</table>
		</table>
		
		
		
							<tr>
							 <td valign="top" align="center" height="25" style=" background-color: #ebebeb;  "> </td>                                                         
							  </tr>                       
					  </table>		

</body>
</html>';
require("PHPMailer/class.phpmailer.php"); 
//$sup_email = $this->Home_Model->get_sup_email($this->session->userdata('apt_id'));
$get_confrm_mail = $this->Home_Model->get_confrm_mail();
$sub = str_replace('{Reference Number}',$booking_ref,$get_confrm_mail->email_subject);
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
				$mail->AddAddress($get_book_details12->email);
				$mail->Subject = $sub;
				$mail->Body = $msg16;
				$mail->SMTPAuth   = true;                 // enable SMTP authentication
				$mail->CharSet = 'utf-8';
				$mail->SMTPDebug  = 0;
				if(!$mail->Send())
				{
					show_error($this->email->print_debugger());
				}
		}
		else
		{
			$msg16 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style="border-width:20; border-color:#ebebeb; ">		
						<table width="610" bgcolor="#fff" border-bottom:1px solid #fff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="610" height="30" align="left"  style=" background-color: #ebebeb;  border-bottom: 1px solid #cbcbcb;"> </td>		
							</tr>		
							<tr>
									<td width="610" valign="top" align="left" style="padding: 0px 14px 0px 14px; background-color: #ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">				
		           			<table width="580" cellspacing="0" align="center" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="700" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><br />	
				<b>IMPORTANT: THIS IS *NOT* YOUR BOOKING CONFIRMATION</b><br/><br/>
							<strong>'.$get_book_details12->firstname.',<br/><br/></strong>
								Thanks for choosing Stayserviced. We are in the process of checking availability, and once your selected accommodation has been approved, we will send you another email confirming your reservation. You should receive this email within <strong>one business day.</strong><br /><br />
								
Below is your booking verification which includes the main contact information, special requests, itinerary and policies you agreed to at the time of booking, and a few other messages from Stayserviced.</strong><br /><br />
						
				<strong>Your Stayserviced Booking No. is: '.$get_booking_details->booking_ref_no.'</strong><br />
				<strong>Your Stayserviced Pin Code is: '.$get_booking_details->itemcode.'</strong><br /><br />													
			
				
				To change, amend or cancel your booking: <a href="https://www.stayserviced.com/index.php/home/guest_login/" style="color:#003466">Click Here</a></td> <br />																													
				</td>										
								
			</tr>
		</table>
	</td>
</tr>						
								<tr>
  <td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Customer Support</strong></td>
						<td width="30%"><br /></td>
						<td align="left" width="35%"><br /></td>									
					</tr>
					<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><a href="mailto:cs@stayserviced.com" style="color:#003466">Email Stayserviced</a></td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><a href="https://stayserviced.tenderapp.com/discussion/new" style="color:#003466">Online Customer Support</a></td>     
					</tr>
     
						
																		                               
 				</table>
			</td>
					
						
		</tr>
	</table>									             
  </td>
</tr>	
						
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					 foreach($get_book_det as $row1){
					$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg16 .= 'N';}else{$msg16 .= 'Y';}
							$msg16 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg16 .='N';}else{$msg16 .= 'Y';}
						$msg16 .='</td>            
					</tr>';
					}
																	                               
 				$msg16 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						

				</tr>';
				foreach($get_book_det as $row1){
				$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg16 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg16 .='Non - refundable';}'</td>
					</tr>';
				}
				
					
				$msg16 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				foreach($get_book_det as $row1){
				$msg16 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' :</b> '.$row1->request.'</td>        
						
					</tr>';
				}
			$msg16 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
					
												<tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:15px 5px 0px 5px;">   																					 
		<table cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-bottom:10px;">
				<strong>Policies</strong>																		
				</td>															
			</tr>
				
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				A Government-issued photo ID is required at the accommodation and for additional services.
				</td>															
			</tr>	
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				You will be responsible for any additional services used during your stay
				</td>															
			</tr>								
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Any refund will be automatically processed to the credit card used during the transaction.
				</td>															
			</tr>
						<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				A no-show will be treated as a cancellation and you will be billed accordingly. 
				</td>															
			</tr>				
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Stayservicved does not charge a processing fee for cancellations. 
				</td>		
				<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Always refer to your Booking Reference '.$get_booking_details->booking_ref_no.' in all your correspondence.
				</td>													
			</tr>
			<tr>
				<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:5px 7px 0px 0px;">
				<a href="http://stayserviced.tenderapp.com/kb/general/terms-of-service" style="color:#003466">Terms of Service</a><br />
				<a href="http://www.stayserviced.com/index.php/home/faq/1" style="color:#003466">FAQs</a><br />
				<a href="http://www.stayserviced.com/index.php/home/aboutus" style="color:#003466">About Us</a><br /><br />			

												
							</td>
						</tr>
																		
	</table>
									
							</td>
						</tr>
						<td>
						 											
					
				</table>
		</table>
		
		
		
							<tr>
							 <td valign="top" align="center" height="25" style=" background-color: #ebebeb;  "> </td>                                                         
							  </tr>                          
					  </table>		

</body>
</html>';
$sup_email = $this->Home_Model->get_sup_email($this->session->userdata('apt_id'));
require("PHPMailer/class.phpmailer.php"); 
$get_confrm_mail = $this->Home_Model->get_confrm_mail_req();
$sub = str_replace('{Reference Number}',$booking_ref,$get_confrm_mail->email_subject);
//$sub = str_replace('{Reference Number}',$this->session->userdata('trans_id'),$get_confrm_mail->email_subject);
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
				$mail->AddAddress($get_book_details12->email);
				$mail->Subject = $sub;
				$mail->Body = $msg16;
				$mail->SMTPAuth   = true;                 // enable SMTP authentication
				$mail->CharSet = 'utf-8';
				$mail->SMTPDebug  = 0;
				if(!$mail->Send())
				{
					show_error($this->email->print_debugger());
				}
		}
		redirect('admin/view_bookings/'.$booking_ref,'refresh');
	}
	function resend_reciept()
	{
		$booking_ref = $this->input->post('booking_ref');
		$details = $this->Home_Model->get_resend_voucher($booking_ref);
		$get_confrm_mail = $this->Home_Model->get_confrm_mail_reciept();
		require("PHPMailer/class.phpmailer.php"); 
		$sub = str_replace('{id number}',$booking_ref,$get_confrm_mail->email_subject);
		$msg = str_replace('{name}',ucfirst($details->firstname),$get_confrm_mail->html_content);
		$msg = str_replace('View',"<a href='".WEB_DIR."voucher/Reciept/".$details->reciept_pdf.".pdf'>View</a>",$msg);
		$msg .= $get_confrm_mail->footer;
		//$msg .="1 Attachment <a href='".WEB_DIR."voucher/Reciept/".$details->reciept_pdf.".pdf'>View</a>";
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
		$mail->AddAddress($details->email);
		$mail->Subject = $sub;
		$mail->Body = $msg;
		$mail->SMTPAuth   = true;                 // enable SMTP authentication
		$mail->CharSet = 'utf-8';
		$mail->SMTPDebug  = 0;
		if(!$mail->Send())
		{
			show_error($this->email->print_debugger());
		}
		redirect('admin/view_bookings/'.$booking_ref,'refresh');
	}
	function search_booking_view()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$in=explode("/",$this->input->post('sd'));
			$cin=$in[2]."-".$in[1]."-".$in[0];	 
			$out=explode("/",$this->input->post('ed'));
			$cout=$out[2]."-".$out[1]."-".$out[0];
			$data['confirm_booking']=$this->Home_Model->search_booking_view($cin,$cout);	
			$data['cancel_booking']=$this->Home_Model->search_cancel_booking_view($cin,$cout);	
			$data['onrequest_booking']=$this->Home_Model->search_onreq_booking_view($cin,$cout);	
			$data['type'] =$this->input->post('type');
			$data['cin']=$cin;
			$data['cout']=$cout;
			$this->load->view('header',$data);
			$this->load->view('search_booking_view',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}	
	function changestatus($id)
	{
	  $book_no=$id;
	  $gta_re=$this->Home_Model->show_val($id);	
	  $agnt=$gta_re->agent_id;
	  $hotelIdent=$this->input->post('hotelname');
	  $hotel=$this->input->post('hotelIdent');
	  $status=$this->input->post('chstatus');
       $this->Home_Model->update_stat($book_no,$status);
	
	redirect('admin/show_search_booking');
	}
	
	function cancel_booking_db($book_id)
	{
		if($this->session->userdata('admin_id')!='')
		{	
				$adminid=$this->session->userdata('adminid');	
				$data['admin_info']=$this->Home_Model->admin_last_login($adminid);
				$data['bookdet']=$bkdet=$this->Home_Model->get_booking_details_db($book_id);
				if($bkdet->status=='Confirmed')
				{
				  $status='Cancelled';
				}
				 $agentid=$bkdet->agent_id ;
				 $hotelid=$bkdet->apt_code;
				 $amount=ceil($bkdet->amount);
				 $perday=$bkdet->perday;
				 $cancel=$this->Home_Model->cancel_info($hotelid);
				  $markupdet=$this->Home_Model->Agent_mark_details($agentid);					
				 if($agentid!=0||$agentid!="")
				{
					if(isset($cancel) && $cancel!="")
				 {
				
				$cancel_type=$cancel[0]->chargetype;
				$cancel_days=$cancel[0]->canceldays;	
				
				 $cin1=date('Y-m-d');
				 $end=$bkdet->indate;
				 $now = strtotime($cin1); // or your date as well
				 $your_date = strtotime($end);
				 $datediff = $your_date- $now;
				 $days=floor($datediff/(60*60*24)); //days before checkin
				  
				  if($days>$cancel_days)
				  {
				
					$bal_agnt=$markupdet->Total_Bal;
					$balance=$bal_agnt+$amount;
				  }
				  
				  else
				  {
				
				  if($cancel_type=='amt')
					{
					$cancel_amt=$cancel[0]->cancelamount;
					$bal_agnt=$markupdet->Total_Bal;
					$balance=($bal_agnt+$amount)-$cancel_amt;
					}
					else
					{
					
					
					$bal_agnt=$markupdet->Total_Bal;
					$balance=($bal_agnt+$amount)-$cancel_amt;
					}
				  }	
					
					}
				
			else
			{
						
			  $bal_agnt=$markupdet->Total_Bal+$amount;
			  $balance=$bal_agnt;
					  
			}
					
			
					//$this->Home_Model->update_book_status_db($status,$book_id);	
					$this->Home_Model->agent_total_bal_db($agentid,$balance);	
				    
					}
                    $this->Home_Model->update_book_status_db($status,$book_id);	
					redirect('admin/show_search_booking',$data);
		 }
		 else{
		 	redirect('admin','refresh');
		 }
	}
	function show_search_booking()
	{
		$adminid=$this->session->userdata('admin');	
		
		$data['user_list']=$this->Home_Model->manage_user();
		$data['user_list1']=$this->Home_Model->manage_user1();
		$data['user_list2']=$this->Home_Model->manage_user2();	
		
		$this->load->view('header',$data);
		
		$this->load->view('search_booking',$data);
		$this->load->view('footer');	
	}
	function add_packages()
	{
	  	if($_SESSION['admin']!='')
		{
			$data['country'] =$country= $this->Home_Model->get_country();		
			$this->load->view('addpackages',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function user_reg()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['user_type'] = $user_type = $this->Home_Model->get_uer_type();
			$data['country'] =$country= $this->Home_Model->get_country();
			$data['commid'] = $commid = $this->Home_Model->get_comm_id();	
			$data['cur'] = $this->Home_Model->get_allcur();	
			$this->load->view('agent_registration',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function user_regisrtaion()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$user_type = $this->input->post('user_type');
			$userf_name = $this->input->post('userf_name');
			$userl_name = $this->input->post('userl_name');
			$agency_name = $this->input->post('agency_name');
			$gender = $this->input->post('gender');
			list($d,$m,$y) = explode('/',$this->input->post('dob'));
			$dob = $y.'-'.$m.'-'.$d;
			$address = $this->input->post('address');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$postalcode = $this->input->post('postalcode');
			$email = $this->input->post('email');
			$office_no = $this->input->post('office_no');
			$mob_phn = $this->input->post('mob_phn');
			$nation = $this->input->post('nation');
			$passd = $this->input->post('passd');	
			$date = date("Y-m-d");
			$currency = $this->input->post('currency');
			if($this->session->userdata('admin_id')!='')
			{
				$added = 1;
				$status = "Active";
			}
			else
			{	
				$status = "Inactive";
			}
			$comm_id = $this->input->post('comm_id');
			$this->Home_Model->user_registration($user_type,$userf_name,$userl_name,$gender,$dob,$address,$country,$city,$postalcode,$email,$office_no,$mob_phn,$nation,$passd,$date,$added,$status,$comm_id,$agency_name,$currency);	
			redirect('admin/admin_dashboard','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function view_users()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['users'] = $this->Home_Model->view_users();
			$this->load->view('header');
			$this->load->view('view_users',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function view_suppliers()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['users'] = $this->Home_Model->view_suppliers();
			$this->load->view('header');
			$this->load->view('view_sup',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function asc_names()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['users'] = $this->Home_Model->view_suppliers_asc_names();
			$this->load->view('header');
			$this->load->view('view_sup',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function view_static()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['users'] = $this->Home_Model->view_static();
			$this->load->view('header');
			$this->load->view('view_static',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function edit_user($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['users'] = $this->Home_Model->edit_user($id);
			$data['user_type'] = $user_type = $this->Home_Model->get_uer_type();
			$data['country'] =$country= $this->Home_Model->get_country();
			$data['commid'] = $commid = $this->Home_Model->get_comm_id();
			$this->load->view('edit_user',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_agent($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['users'] = $this->Home_Model->edit_user($id);
			$data['user_type'] = $user_type = $this->Home_Model->get_uer_type();
			$data['country'] =$country= $this->Home_Model->get_country();
			$data['commid'] = $commid = $this->Home_Model->get_comm_id();
			$this->load->view('edit_agent',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_cust($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['users'] = $this->Home_Model->edit_user($id);
			$data['user_type'] = $user_type = $this->Home_Model->get_uer_type();
			$data['country'] =$country= $this->Home_Model->get_country();
			$data['commid'] = $commid = $this->Home_Model->get_comm_id();
//			echo "<pre>"; print_r($data['country']);exit;
			$this->load->view('edit_customer',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_sup($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['users'] = $this->Home_Model->edit_user($id);
			//$data['user_type'] = $user_type = $this->Home_Model->get_uer_type();
			$data['country'] =$country= $this->Home_Model->get_country();
			$data['commid'] = $commid = $this->Home_Model->get_comm_id();
			$this->load->view('edit_sup',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_user($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			//echo $user_type = $this->input->post('user_type');exit;
			$userf_name = $this->input->post('userf_name');
			$userl_name = $this->input->post('userl_name');
			/*$gender = $this->input->post('gender');
			list($d,$m,$y) = explode('/',$this->input->post('dob'));
			$dob = $y.'-'.$m.'-'.$d;*/
			$address = $this->input->post('address');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$postalcode = $this->input->post('postalcode');
			$office_no = $this->input->post('office_no');
			$mob_phn = $this->input->post('mob_phn');
			$nation = $this->input->post('nation');
			$comm_id = $this->input->post('comm_id');
			
			$this->Home_Model->update_user($userf_name,$userl_name,$address,$country,$city,$postalcode,$office_no,$mob_phn,$nation,$id,$comm_id);
			redirect('admin/edit_user/'.$id,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_agent($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$userf_name = $this->input->post('userf_name');
			$userl_name = $this->input->post('userl_name');
			$com_type = $this->input->post('com_type');
			$comp_name = $this->input->post('comp_name');
			$address = $this->input->post('address');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$postalcode = $this->input->post('postalcode');
			$office_no = $this->input->post('office_no');
			$mob_phn = $this->input->post('mob_phn');
			$mark_up = $this->input->post('mark_up');
			$comm_id = $this->input->post('comm_id');
			
			$this->Home_Model->update_agent($userf_name,$userl_name,$com_type,$comp_name,$address,$country,$city,$postalcode,$office_no,$mob_phn,$mark_up,$id,$comm_id);
			redirect('admin/edit_agent/'.$id,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	
	function update_cust($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email = $this->input->post('email');
			$mobile_no = $this->input->post('mobile_no');
			$pan = $this->input->post('pan');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$country = $this->input->post('country');
			$pincode = $this->input->post('pincode');
			$designation = $this->input->post('designation');
			
			$this->Home_Model->update_cust1($id,$first_name,$last_name,$mobile_no,$pan,$city,$state,$country,$pincode,$designation);
			redirect('admin/customer_details','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_sup($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$userf_name = $this->input->post('userf_name');
			$userl_name = $this->input->post('userl_name');
			$address = $this->input->post('address');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$postalcode = $this->input->post('postalcode');
			$office_no = $this->input->post('office_no');
			$mob_phn = $this->input->post('mob_phn');
			$nation = $this->input->post('nation');
			$comm_id = $this->input->post('comm_id');
			$markup = $this->input->post('markup');
			$brand = $this->input->post('brand');
			$position = $this->input->post('position');
			$this->Home_Model->update_sup($userf_name,$userl_name,$address,$country,$city,$postalcode,$office_no,$mob_phn,$nation,$id,$comm_id,$brand,$position,$markup);
			redirect('admin/edit_sup/'.$id,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function export_newsletter()
	{
		//$email = '';
		$data['sel'] = $sel =  $this->input->post('Del_Id');
		//echo print_r($sel);exit;
		$i =1;
		
		$email="<table><tr><th>SI No.</th><th>User Type</th><th>Company/Group/Brand Name</th><th>First Name/ Last Name</th><th>Email</th><th>Country</th><th>City</th><th>Comp New</th><th>Promos</th></tr>";
		
		foreach($sel as $users)
		{
			$row =  $this->Home_Model->view_users_sub_ind($users);
			$comp = '';
			$news = '';
			$type = ($this->Home_Model->get_type($row->user_type_id)); 
			if($type == ''){ $type = '-';}
			$cnt = $this->Home_Model->get_ind_country($row->country);
			$not = $this->Home_Model->get_notify($row->user_id);
			 if(isset($not)){
				 if($not != '')
				 {
		   			if($not->peridoic == 1){ 
				  	  $comp = 'Y';
				   	}
		   			else
		   			{
					   $comp = 'N';
				  	}
				}
		   		else
		   	    {
			   		$comp = 'N';
		   		}
			 }
			  if(isset($not)){
				 if($not != '')
				 {
		   			if($not->news == 1)
		   			{
			   		 $news = 'Y';
		  			 }
		   			else
		   			{
			   			$news = 'N';
		  			 }
				}
		   		else
		   	    {
			   		$news = 'N';
		   		}
			 }
		  
			$email.='<tr><td>'.$i.'</td><td>'.$type.'</td><td>'.$row->agency_name.'</td><td>'.$row->first_name.$row->last_name.'</td><td>'.$row->email.'</td><td>'.$cnt.'</td><td>'.$row->city.'</td><td>'.$comp.'</td><td>'.$news.'</td></tr>';
			$i++;
		}	
		
		$email.="</table>";
		$data['email'] = $email; 
		$this->load->view('news_letter_export',$data);

	}
	function export_bookings()
	{
			$sel =  $this->input->post('Del_Id');
		$email="<table><tr><th>Transaction ID.</th><th>Accom ID</th><th>Accom Name</th><th>Check - in</th><th>Check - out</th><th>Booking date</th><th>Nights</th><th>Status</th><th>Billing Amount</th><th>Mark - up</th><th>Comms</th></tr>";
		$i = 1;
		foreach($sel as $users)
		{
			$row =  $this->Home_Model->get_booking_details($users);
			//echo "<pre>"; print_r($row);exit;
			if($row->status == 'Available')
			{
				$stat =  'Confirmed';
			}
			else if($row->status == 'Cancel')
			{
				$stat =  'Cancelled';
			}
			else
			{ 
				$stat = 'Pending Confirmation';
			}
			$ded = '';
			if($row->markup_amount)
			{
				
				$markup = $this->Home_Model->getadminmarkup($row->markup_amount);
				if($markup->type == 1)
				{
					$ded = $markup->value;
				}
				else
				{
					$ded = $markup->value;
					$ded =  ($row->amount*$ded)/100;
				}
			}
			$email.='<tr><td>'.$row->booking_ref_no.'</td><td>'.$row->hotel_code.'</td><td>'.$this->Home_Model->get_accom_name($row->hotel_code).'</td><td>'.$row->check_in.'</td><td>'.$row->check_out.'</td><td>'.$row->voucher_date.'</td><td>'.(strtotime($row->check_out)-strtotime($row->check_in))/(60*60*24).'</td><td>'.$stat.'</td><td>'.$row->amount.'</td><td>'.$ded.'</td><td>'.$row->commission_amount.'</td></tr>';
			$i++;
		}	
		
		$email.="</table>";
		$data['email'] = $email; 
		$this->load->view('bookings_export',$data);

	}
	function subscribe_list()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$perpage=15;
	   	 	$product_id = $this->uri->segment(3, 0);
			$data['users'] = $users =  $this->Home_Model->view_users_sub();
			//$data['users'] = $this->Home_Model->view_users_per($product_id,$perpage);
			$count= count($users);
		//	$config['base_url'] = base_url().'index.php/admin/subscribe_list';
			//$config['total_rows'] = $count;
			//$config['per_page'] = 15;
		//	$this->pagination->initialize($config);	
			$this->load->view('header');
			$this->load->view('view_subscribed',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function popular_dest()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$perpage=15;
	   	 	$product_id = $this->uri->segment(3, 0);
			$users = $this->Home_Model->popular_dest();
			$data['users'] = $this->Home_Model->popular_dest_per($product_id,$perpage);
			$data['res'] = $this->Home_Model->get_api_cnts();
			$count= count($users);
			$config['base_url'] = base_url().'index.php/admin/popular_dest';
			$config['total_rows'] = $count;
			$config['per_page'] = 15;
			$this->pagination->initialize($config);	
			$this->load->view('header');
			$this->load->view('view_pop_dest',$data);
			$this->load->view('footer');
			//$data['users'] = $this->Home_Model->popular_dest();
			
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function featured_dest()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['users'] = $this->Home_Model->fet_dest();
			$this->load->view('header');
			$this->load->view('view_feat_dest',$data);
			$this->load->view('footer');
			//$data['users'] = $this->Home_Model->popular_dest();
			
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_pop_dest_city()
	{
		$img1 = '';
		if(isset($_FILES['image1']['name'])!='' && $_FILES['image1']['type']=='image/jpeg' || $_FILES['image1']['type']=='image/jpg' || $_FILES['image1']['type']=='image/gif' || $_FILES['image1']['type']=='image/png')
			  {         
			        $file=$_FILES['image1']['name'];             
				copy($_FILES['image1']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img1="dest".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img1);			
	    		 }
			$x = '"';
			$y = "'";
		  $title = $this->input->post('title');
		 $order = $this->input->post('order');
		 $hotel_city = explode(',',$this->input->post('city'));
		 $image_text = $this->input->post('image_text');
		 $edit_page_t = $this->input->post('edit_page_t');
		 $edit_meta = $this->input->post('edit_meta');
		 $edit_metakeyword = $this->input->post('edit_metakeyword');
		 $edit_text = str_replace($x,$y,$this->input->post('edit_text'));
		 $disp_city = $hotel_city[0];
		$disp_country = trim($hotel_city[1]);
		 $countrycode = $this->Home_Model->get_countrycode($disp_country);
		$citycode = $this->Home_Model->get_citycode($disp_city,$countrycode);
		
		$disp_city = $this->input->post('city');
		if($citycode == '')
		{

			$citycode = $this->Home_Model->get_regioncode($hotel_city[0],$countrycode);
			$this->Home_Model->add_pop_dest_region($disp_city,$citycode,$order,$title,$img1,$image_text,$edit_text,$edit_page_t,$edit_meta,$edit_metakeyword);
		}
		else
		{
		 $this->Home_Model->add_pop_dest_city($disp_city,$citycode,$order,$title,$img1,$image_text,$edit_text,$edit_page_t,$edit_meta,$edit_metakeyword);
		}
		 redirect('admin/popular_dest','refresh');
	}
	function add_fet_dest_city()
	{
		// $disp_city = $this->input->post('city');
		 $hotel =$this->input->post('hotel');
		 $loc = $this->input->post('loc');
		 $hotel_city = explode(',',$this->input->post('city'));
		$data['disp_city'] = $disp_city = $hotel_city[0];
		$data['disp_country'] = $disp_country = $hotel_city[1];
		$countrycode = $this->Home_Model->get_countrycode($disp_country);
		 $citycode = $this->Home_Model->get_citycode($disp_city,$countrycode); 
		//$hotel_id = $this->Home_Model->get_hotel_id($hotel,$citycode);
		$hotel_id = $this->Home_Model->get_hotel_id1($hotel,$citycode);
		$type="stay";
		$disp_city = $this->input->post('city');
		$image_text = $this->input->post('image_text');
		 $this->Home_Model->add_fet_dest_city($disp_city,$citycode,$hotel,$loc,$hotel_id,$type,$image_text);
		 redirect('admin/featured_dest','refresh');
	}
	function add_fet_dest_city_api()
	{
		// $disp_city = $this->input->post('city');
		 $hotel =$this->input->post('hotel');
		 $loc = $this->input->post('loc');
		 $hotel_city = explode(',',$this->input->post('city'));
		$data['disp_city'] = $disp_city = $hotel_city[0];
		$data['disp_country'] = $disp_country = $hotel_city[1];
		$countrycode = $this->Home_Model->get_countrycode($disp_country);
		 $citycode = $this->Home_Model->get_citycode($disp_city,$countrycode); 
		$hotel_id = $this->Home_Model->get_hotel_id_api1($hotel,$citycode);
		$type="api";
		$image_text = $this->input->post('image_text');
		$disp_city = $this->input->post('city');
		 $this->Home_Model->add_fet_dest_city($disp_city,$citycode,$hotel,$loc,$hotel_id,$type,$image_text);
		 redirect('admin/featured_dest','refresh');
	}
	function update_fet_dest_city()
	{
		 $hotel =$this->input->post('hotel');
		 $loc = $this->input->post('loc');
		 $hotel_city = explode(',',$this->input->post('city'));
		$data['disp_city'] = $disp_city = $hotel_city[0];
		$data['disp_country'] = $disp_country = $hotel_city[1];
		$countrycode = $this->Home_Model->get_countrycode($disp_country);
		 $citycode = $this->Home_Model->get_citycode($disp_city,$countrycode);
		 	$hotel_id = $this->Home_Model->get_hotel_id_api($hotel,$citycode);
		 $edit_id = $this->input->post('edit_id');
		 $disp_city = $this->input->post('city');
		$image_text = $this->input->post('image_text');
		 $this->Home_Model->up_fet_dest_city($disp_city,$citycode,$hotel,$loc,$edit_id,$image_text);
		 redirect('admin/featured_dest','refresh');
	}
	function update_fet_dest_city_api()
	{
		 //$disp_city = $this->input->post('edit_city');
		 $hotel =$this->input->post('edit_hotel');
		 $loc = $this->input->post('edit_loc');
		 $hotel_city = explode(',',$this->input->post('edit_city'));
		$data['disp_city'] = $disp_city = $hotel_city[0];
		$data['disp_country'] = $disp_country = $hotel_city[1];
		$countrycode = $this->Home_Model->get_countrycode($disp_country);
		 $citycode = $this->Home_Model->get_citycode($disp_city,$countrycode);
		 	$hotel_id = $this->Home_Model->get_hotel_id_api($hotel,$citycode);
		 $edit_id = $this->input->post('edit_id_api');
		 $disp_city = $this->input->post('edit_city');
			$image_text = $this->input->post('image_text');
		 $this->Home_Model->up_fet_dest_city($disp_city,$citycode,$hotel,$loc,$edit_id,$image_text);
		 redirect('admin/featured_dest','refresh');
	}
	function update_pop_dest_city()
	{
		if(isset($_FILES['image1']['name'])!='' && $_FILES['image1']['type']=='image/jpeg' || $_FILES['image1']['type']=='image/jpg' || $_FILES['image1']['type']=='image/gif' || $_FILES['image1']['type']=='image/png')
			  {         
			        $file=$_FILES['image1']['name'];             
				copy($_FILES['image1']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img1="dest".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img1);			
	    		 }
				 else
				 {
					 $img1 = $this->input->post('edit_image_del');
				 }
				 $x = '"';
				 $y = "'";
			$edit_id = $this->input->post('edit_id');
		  $title = $this->input->post('title');
		  $hotel_city =explode(',',$this->input->post('city'));
		  $image_text = $this->input->post('image_t');
		    $edit_text = str_replace($x,$y,$this->input->post('edit_text'));
		      $edit_page_t = $this->input->post('edit_page_t');
		        $edit_meta = $this->input->post('edit_meta');
		          $edit_metakeyword = $this->input->post('edit_metakeyword');
		  
		
		 $disp_city = $hotel_city[0];
		 $disp_country = $hotel_city[1];
		
		$countrycode = $this->Home_Model->get_countrycode(trim($disp_country));
		 $citycode = $this->Home_Model->get_citycode($disp_city,$countrycode);
		 
		  $order = $this->input->post('order');
		  $disp_city = $this->input->post('city');
		  
		  
		  
		  if($citycode == '')
		{

			$citycode = $this->Home_Model->get_regioncode($hotel_city[0],$countrycode);
			$this->Home_Model->update_pop_dest_region($disp_city,$citycode,$order,$title,$img1,$image_text,$edit_text,$edit_page_t,$edit_meta,$edit_metakeyword,$edit_id);
		}
		else
		{
		  $this->Home_Model->update_pop_dest_city($disp_city,$citycode,$order,$title,$img1,$image_text,$edit_text,$edit_page_t,$edit_meta,$edit_metakeyword,$edit_id);
		}
		
		 redirect('admin/popular_dest','refresh');
	}
	function order_avail()
	{
		$order = $this->input->post('order');
		if($this->Home_Model->order_avail($order))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	function ip_status($status,$id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->update_ip_status($status,$id);
			redirect('admin/view_subadmis','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function agent_regisrtaion()
	{
		$agent_name = $this->input->post('agent_name');
		$agency_name = $this->input->post('agency_name');
		$address = $this->input->post('address');
		$country = $this->input->post('country');
		$city = $this->input->post('city');
		$pincode = $this->input->post('pincode');
		$email = $this->input->post('email');
		//$alt_email = $this->input->post('alt_email');
		$off_phn = $this->input->post('off_phn');
		$mob_phn = $this->input->post('mob_phn');
		$agent_login = $this->input->post('agent_login');
		$passd = $this->input->post('passd');
		$mail1 = '';
		$mail2 = '';	
		$this->Home_Model->agent_registration($agent_name,$agency_name,$address,$country,$city,$pincode,$email,$off_phn,$mob_phn,$agent_login,$passd);
		$admin = $this->Home_Model->get_admin_email();
		$admin_email =  $admin->email_id;
		$tomailid=array($email,$admin_email);
		$count=count($tomailid);
		for($i=0; $i<$count;$i++)
	  	{
				$to=$tomailid[$i];
				if($tomailid[$i]==$email)
				{
				      $from = "info@nooritravel.co.uk";
				      $subject ="Congratulations! Your mail id has been Registered as Agent in nooritravel.co.uk";
				      $txt="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
							<html xmlns='http://www.w3.org/1999/xhtml'>
							<head>
							<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
							<title>nooritravel.co.uk</title>
							<style>
		.cointaner{margin-left:auto; margin-right:auto; margin-bottom:40px; width:800px; height:auto; min-height:200px;}
		.box{margin-left:auto; margin-right:auto; margin-top:5px; margin-bottom:5px; width:800px; height:auto; float:left; background:#fff; border:#a8e4ff 1px solid;}
		.top_header{height:30px; width:800px; float:left; background:#c1ebfe; font-family:Georgia, 'Times New Roman', Times, serif; line-height:20px; font-size:14px; padding-left:8px; line-height:30px; font-weight:bold;}
		.heading{font-weight:bold; font-size:13px; line-height:24px; font-family:Georgia, 'Times New Roman', Times, serif; border-bottom:2px #c1ebfe solid; margin-bottom:7px;}
		.content_box{width:760px; height:auto; float:left; padding:20px;}
		.content_box_individual{width:740px; height:auto; float:left; padding:20px 30px;}
		.content_box_individual_contact{width:740px; height:auto; float:left; padding:10px 30px;}
		.saperation1{width:340px; height:auto; float:left; padding:0 10px; font-size:14px; line-height:20px;}
		.saperation2{width:220px; height:auto; float:left; margin:0 10px; font-size:14px; line-height:20px;}
		.header_image{margin-bottom:20px;}
		.link{color:#1177cc; text-decoration:none;}
		.plain_header{background-color:#fff; height:20px; width:800px; float:left; font-family:Georgia, 'Times New Roman', Times, serif; line-height:20px; font-size:14px; padding-left:8px; line-height:30px; font-weight:bold;}
		</style>
							</head>
							
							<body>
		<table border='0' width='1000'>
			  <tr class='cointaner'>
				<td>
					<div class='header_image'><img src='http://www.nooritravel.co.uk/admin/images/logo.gif' width='395' height='76' /></div>
				<div style='font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; font-weight:bold; margin-bottom:5px; padding-bottom:5px; border-bottom:#c1ebfe 2px solid;'>
					Package Request
				</div>
				<div style='width:800px; height:50px; float:left;'>
					Dear <span style='text-transform:capitalize;'>".$agent_name."</span>,
					<br />
					Congratulations, Your package Request has been sent successfully..
				</div>
				
				</td>
			  </tr>
			  
			  <tr>
				<td>
					<div class='box'>
						<div class='top_header'>
							<strong>Login Details</strong>
						</div>
						<div class='content_box'>
								<table border='0'>
									  <tr>
										<td width='150'>Login Email.</td>
										<td width='850'>: ".$email."</td>
									  </tr>
									  <tr>
										<td>Login Password.</td>
										<td>: ".$passd."</td>
									  </tr>
							</table>
						</div>
					</div>
				
				</td>
			  </tr>
			  <tr>
				<td>
					<div class='box'>
						<div style='margin:20px; float:left;'>
						For any assistance please call:
						<br /><br />
						<strong>By Land phone :</strong> <span style='margin-left:20px;'>+01733 706515</span><br />
						 <strong>By E-mail :</strong> <br />
						<span style='margin-left:10px;'>
							24 Hours Customer Care Unit	: <span style='margin-left:27px;'><a href='mailto:info@nooritravel.co.uk' class='link'>info@nooritravel.co.uk</a></span></span><br />
						
						
						
					</div>	
						
					</div>
				</td>
			  </tr>
			  <tr>
				<td>
					<div class='box'>
						<div style='margin:20px; float:left;'>
						Thanks and Regards,<br />
						<a href='http://www.nooritravel.co.uk' target='_blank' class='link'>Nooritravel.co.uk</a> Team
					</div>	
						
					</div>
				</td>
			  </tr>
			 			  
		</table>
			
		</body>
		</html>";
					   $headers  = "From: $from\r\n";
				       $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					   $mail1 = mail($to,$subject,$txt,$headers);
						
			}
				if($tomailid[$i]==$admin_email)
				{
					 $from = "info@nooritravel.co.uk";
					$subject="New Agent Registration has been successfully done.";
					$txt="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
					<html xmlns='http://www.w3.org/1999/xhtml'>
					<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
					<title>nooritravel.co.uk</title>
					</head>
					
					<body>
						<div style='margin-left:auto; margin-right:auto; margin-bottom:40px; width:1000px; height:auto; min-height:200px;'>
							<div style='margin-bottom:20px;'><img src='http://www.nooritravel.co.uk/admin/images/logo.gif' width='395' height='76' /></div>
							<div style='font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; font-weight:bold; margin-bottom:5px; padding-bottom:5px; border-bottom:#c1ebfe 2px solid;'>
								<br/><br/>
							</div>       
							<div style='margin-left:auto; margin-right:auto; margin-top:5px; margin-bottom:5px; width:1000px; height:auto; float:left; background:#fff; border:#a8e4ff 1px solid;'>
							   
								<div style='width:960px; height:auto; float:left; padding:20px;'>
									<div style='width:440px; height:auto; float:left; padding:0 10px; font-size:14px; line-height:20px;'>
										<div style='font-weight:bold; font-size:13px; line-height:24px; font-family:Georgia, 'Times New Roman', Times, serif; border-bottom:2px #c1ebfe solid; margin-bottom:7px;'></div>
										Dear Admin, <br />
										".ucfirst($agent_name)."<br/>
										Subject :".$subject."<br/>
										Details :<br/>
										Name:Dear Admin<br/>
									</div>
									
								</div>
						
						</div>
						
					
					<div style='margin:20px 0; float:left;'>
							Thanks and Regards,<br />
							<a href='#' style='color:#1177cc; text-decoration:none;'>nootitravel.co.uk</a> Team
						</div>
					</body>
					</html>";
					  $headers  = "From: $from\r\n";
				      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					  $mail2 = mail($to,$subject,$txt,$headers);
				}
		}	
		if($mail2 && $mail1)
		{
			redirect('admin/admin_dashboard','refresh');
		}
		else
		{
			redirect('admin/admin_dashboard','refresh');
		}
		//$this->load->view('agent_registration_successful');
	}
	function req_packages()
	{
		$data['req'] = $this->Home_Model->get_req_pack();	
		$this->load->view('view_pack_req',$data);
	}
	function delete_req_details($id)
	{
		$this->Home_Model->del_req($id);
		redirect('admin/req_packages','refresh');
	}
	function confirm_agent($email,$user_type)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data=$this->Home_Model->check_username_valid($email,$user_type);
	    	if($data!='')
	  	 	{
	   			echo 'Login Name Already exist';
	   		}else{
	   		}
		}
		else
		{
			redirect('admin','refresh');
		}
		
	}
	function maintain()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('admin_maintain');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_subadmin()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('add_subadmin');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function subadmin_check($email)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data=$this->Home_Model->check_admin_valid($email);
	    	if($data!='')
	  	 	{
	   			echo 'Login Name Already exist';
	   		}else{
	   		}
		}
		else
		{
			redirect('admin','refresh');
		}
		
	}
	function insert_subadmin()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$userf_name = $this->input->post('userf_name');
			$userl_name = $this->input->post('userl_name');
			$email = $this->input->post('email');
			$login = $this->input->post('passd');
			$passd = $this->input->post('passd');
			if($this->session->userdata('admin_id')!='')
			{	
				$status = 1;
				$create = 1;
				$admin_type = 2;
			}
			$date = date("Y-m-d");
			$this->Home_Model->add_subadmin($userf_name,$userl_name,$email,$login,$passd,$status,$create,$date,$admin_type);
			redirect('admin/maintain','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function view_subadmis()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['subadmins'] = $this->Home_Model->get_subadmins();
			$this->load->view('header');
			$this->load->view('view_subaadmins',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_subadmin($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['subadmins'] = $this->Home_Model->get_subadmin($id);
			$this->load->view('edit_subadmin',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_subadmin($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$userf_name = $this->input->post('userf_name');
			$userl_name = $this->input->post('userl_name');
			$data['subadmins'] = $this->Home_Model->update_subadmin($id,$userf_name,$userl_name);
			redirect('admin/view_subadmis','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function subadmin_status($status,$id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->update_subadmin_status($status,$id);
			redirect('admin/view_subadmis','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_com_status($status,$id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->update_comm_status($status,$id);
			redirect('admin/markup','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_ip_status($status,$id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->edit_ip_status($status,$id);
			redirect('admin/ipcontrol','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_ip($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_ip($id);
			redirect('admin/ipcontrol','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_subadmin($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_subadmin($id);
			redirect('admin/view_subadmis','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function cardaccept_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['users'] = $this->Home_Model->cardaccept_list();
			$this->load->view('view_cardaccept_list',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function view_cardaccept_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('view_cardaccept_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_cardaccept_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card = $this->input->post('card');
			$this->Home_Model->add_cardaccept_list($card);
			redirect('admin/cardaccept_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_cardaccept_list($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card = $this->input->post('card');
			$this->Home_Model->add_cardaccept_list($card);
			redirect('admin/cardaccept_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_cardaccept_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card_id = $this->input->post('card_id');
			$edit_card = $this->input->post('edit_card');
			$this->Home_Model->update_cardaccept_list($card_id,$edit_card);
			redirect('admin/cardaccept_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function cardaccept_status($status,$id)
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->update_cardaccept_status($status,$id);
			redirect('admin/cardaccept_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_cardaccept($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_cardaccept($id);
			redirect('admin/cardaccept_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function facilities_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$perpage=15;
	   	 	$product_id = $this->uri->segment(3, 0);
			$users = $this->Home_Model->facilities_list();
			$data['users'] = $this->Home_Model->facilities_list_per($product_id,$perpage);
			$count= count($users);
			$config['base_url'] = base_url().'index.php/admin/facilities_list';
			$config['total_rows'] = $count;
			$config['per_page'] = 15;
			$this->pagination->initialize($config);	
			$this->load->view('view_facilities_list',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_facility_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card = $this->input->post('card');
			$this->Home_Model->add_facility_list($card);
			redirect('admin/facilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_facility_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card_id = $this->input->post('card_id');
			$edit_card = $this->input->post('edit_card');
			$this->Home_Model->update_facility_list($card_id,$edit_card);
			//redirect('admin/facilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function facility_status()
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			if($this->Home_Model->update_facility_status($status,$id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			//redirect('admin/facilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function dest_status()
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			if($this->Home_Model->update_dest_status($status,$id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			//redirect('admin/facilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function frtfacility_status()
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			if($this->Home_Model->frtupdate_facility_status($status,$id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			redirect('admin/facilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	function fea_dest_status()
	{
		if($this->session->userdata('admin_id')!='')
		{ //echo "sdgfsd";exit;
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			$cont = $this->input->post('cont');
			if($this->Home_Model->featu_desti_status($status,$id,$cont))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			redirect('admin/featured_dest','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function fea_dest_euro_status()
	{
		if($this->session->userdata('admin_id')!='')
		{ //echo "sdgfsd";exit;
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			$cont = $this->input->post('cont');
			if($this->Home_Model->featu_desti_euro_status($status,$id,$cont))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			redirect('admin/featured_dest','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function fea_dest_east_status()
	{
		if($this->session->userdata('admin_id')!='')
		{ //echo "sdgfsd";exit;
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			$cont = $this->input->post('cont');
			if($this->Home_Model->featu_desti_east_status($status,$id,$cont))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			redirect('admin/featured_dest','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function fea_dest_asia_status()
	{
		if($this->session->userdata('admin_id')!='')
		{ //echo "sdgfsd";exit;
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			$cont = $this->input->post('cont');
			if($this->Home_Model->featu_desti_asia_status($status,$id,$cont))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			redirect('admin/featured_dest','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function fea_dest_southasia_status()
	{
		if($this->session->userdata('admin_id')!='')
		{ //echo "sdgfsd";exit;
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			$cont = $this->input->post('cont');
			if($this->Home_Model->featu_desti_southasia_status($status,$id,$cont))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			redirect('admin/featured_dest','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function fea_dest_oceania_status()
	{
		if($this->session->userdata('admin_id')!='')
		{ //echo "sdgfsd";exit;
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			$cont = $this->input->post('cont');
			if($this->Home_Model->featu_desti_oceania_status($status,$id,$cont))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			redirect('admin/featured_dest','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	
	
	function delete_facility()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('id');
			if($this->Home_Model->delete_facility($id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
				
			//redirect('admin/facilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_dest()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('id');
			if($this->Home_Model->delete_dest($id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
				
			//redirect('admin/facilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_fet()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('id');
			if($this->Home_Model->delete_fet($id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
				
			//redirect('admin/facilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function roomfacilities_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$perpage=15;
	   	 	$product_id = $this->uri->segment(3, 0);
			$users = $this->Home_Model->roomfacilities_list();
			$data['users'] = $this->Home_Model->roomfacilities_list_per($product_id,$perpage);
			$count= count($users);
			$config['base_url'] = base_url().'index.php/admin/roomfacilities_list';
			$config['total_rows'] = $count;
			$config['per_page'] = 15;
			$this->pagination->initialize($config);	
			$this->load->view('view_roomfacilities_list',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function room_filter($char)
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$perpage=15;
	   	 	$product_id = 0;
			$users = $this->Home_Model->roomfacilities_list_filter($char);
			$data['users'] = $this->Home_Model->roomfacilities_list_per_filter($product_id,$perpage,$char);
			$count= count($users);
			$config['base_url'] = base_url().'index.php/admin/room_filter';
			$config['total_rows'] = $count;
			$config['per_page'] = 15;
			$this->pagination->initialize($config);	
			$this->load->view('view_roomfacilities_list',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_room_facility_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card = $this->input->post('card');
			$this->Home_Model->add_room_facility_list($card);
			redirect('admin/roomfacilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_room_facility_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card_id = $this->input->post('card_id');
			$edit_card = $this->input->post('edit_card');
			$this->Home_Model->update_room_facility_list($card_id,$edit_card);
			//redirect('admin/roomfacilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_timezone()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card_id = $this->input->post('card_id');
			$edit_card = $this->input->post('edit_card');
			$value = $this->input->post('value');
			$edit_location = $this->input->post('edit_location');
			$this->Home_Model->update_timezone($card_id,$edit_card,$value,$edit_location);
			//redirect('admin/timezone_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function room_facility_status()
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			if($this->Home_Model->update_room_facility_status($status,$id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			//redirect('admin/roomfacilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function timezone_status()
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			if($this->Home_Model->update_timezone_status($status,$id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			//redirect('admin/timezone_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_room_facility()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('id');
			if($this->Home_Model->delete_room_facility($id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			//redirect('admin/roomfacilities_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_timezone()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('id');
			if($this->Home_Model->delete_timezone($id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			//redirect('admin/timezone_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function timezone_list()
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$perpage=15;
	   	 	$product_id = $this->uri->segment(3, 0);
			$data['value'] = $this->Home_Model->get_timezone();
			$users = $this->Home_Model->timezone_list();
			$data['users'] = $this->Home_Model->timezone_list_per($product_id,$perpage);
			$count= count($users);
			$config['base_url'] = base_url().'index.php/admin/timezone_list';
			$config['total_rows'] = $count;
			$config['per_page'] = 15;
			$this->pagination->initialize($config);	
			$this->load->view('view_timezone_list',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function apartclass_type()
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$perpage=15;
	   	 	$product_id = $this->uri->segment(3, 0);
			$users = $this->Home_Model->apartclass_type();
			$data['users'] = $this->Home_Model->apartclass_type_per($product_id,$perpage);
			$count= count($users);
			$config['base_url'] = base_url().'index.php/admin/apartclass_type';
			$config['total_rows'] = $count;
			$config['per_page'] = 15;
			$this->pagination->initialize($config);	
			$this->load->view('view_apartclass_list',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function class_filter($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$perpage=15;
	   	 	$product_id = 0;
			$users = $this->Home_Model->apartclass_type_filter($id);
			$data['users'] = $this->Home_Model->apartclass_type_per_filter($product_id,$perpage,$id);
			$count= count($users);
			$config['base_url'] = base_url().'index.php/admin/apartclass_type';
			$config['total_rows'] = $count;
			$config['per_page'] = 15;
			$this->pagination->initialize($config);	
			$this->load->view('view_apartclass_list',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_apartclass_type()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card = $this->input->post('card');
			$this->Home_Model->add_apartclass_type($card);
			redirect('admin/apartclass_type','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_apartclass_type()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card_id = $this->input->post('card_id');
			$edit_card = $this->input->post('edit_card');
			$this->Home_Model->update_apartclass_type($card_id,$edit_card);
			//redirect('admin/apartclass_type','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	/*function room_apartclass_type_status($status,$id)
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->update_room_apartclass_type_status($status,$id);
			redirect('admin/apartclass_type','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}*/
	function room_apartclass_type_status()
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			if($this->Home_Model->update_room_apartclass_type_status($status,$id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			//redirect('admin/apartclass_type','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function frontroom_apartclass_type_status($status,$id)
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$status = $this->input->post('status');
			$id = $this->input->post('id');
			if($this->Home_Model->update_frnroom_apartclass_type_status($status,$id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			//redirect('admin/apartclass_type','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function delete_apartclass_type($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('id');
			if($this->Home_Model->delete_apartclass_type($id))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			//redirect('admin/apartclass_type','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_timezone()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$card = $this->input->post('card');
			$value = $this->input->post('value');
			$location = $this->input->post('location');
			$this->Home_Model->add_timezone($card,$value,$location);
			redirect('admin/timezone_list','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_static_page()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('header');
			$this->load->view('add_static');
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_static()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$menu = $this->input->post('menu');
			$sub_menu_about = $this->input->post('sub_menu_about');
			$sub_menu_insider = $this->input->post('sub_menu_insider');
			$title = $this->input->post('title');
			$test = $this->input->post('test');
			$date = date('Y-m-d');
			$this->Home_Model->add_static($menu,$sub_menu_about,$sub_menu_insider,$title,$test,$date);
			redirect('admin/view_static','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_static_page($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['res'] = $this->Home_Model->edit_static_page($id);
			$this->load->view('header');
			$this->load->view('edit_static',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_static($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			 $menu = $this->input->post('menu');
			 $sub_menu_about = $this->input->post('sub_menu_about');
			 $sub_menu_insider = $this->input->post('sub_menu_insider');
			 $title = $this->input->post('title');
			 $test = $this->input->post('test');
			$date = date('Y-m-d');
			$this->Home_Model->update_static($menu,$sub_menu_about,$sub_menu_insider,$title,$test,$date,$id);
			redirect('admin/view_static','refresh');
		}
		else
		{
			redirect('admin','refresh');			
		}
	}
	function delete_static_page($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_static_page($id);
			redirect('admin/view_static','refresh');
		}
		else
		{
			redirect('admin','refresh');			
		}
	}
	function frontend_view($id)
	{
		$data['res'] = $this->Home_Model->frontend_view($id);
		$this->load->view('customer/whystaykey',$data);
	}
	function external_links()
	{
		$data['res'] = $this->Home_Model->get_external_links();
		$this->load->view('header');
		$this->load->view('view_ext',$data);
		$this->load->view('footer');
	}
	function add_ext_page()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('header');
			$this->load->view('add_ext');
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_ext()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$menu = $this->input->post('menu');
			$title = $this->input->post('title');
			$date = date('Y-m-d');
			$this->Home_Model->add_ext($menu,$title,$date);
			redirect('admin/external_links','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_ext_page($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['res'] = $this->Home_Model->edit_ext_page($id);
			$this->load->view('header');
			$this->load->view('edit_ext',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_ext($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			 $menu = $this->input->post('menu');
			 $title = $this->input->post('title');
			$date = date('Y-m-d');
			$this->Home_Model->update_ext($menu,$title,$date,$id);
			redirect('admin/external_links','refresh');
		}
		else
		{
			redirect('admin','refresh');			
		}
	}
	function delete_ext_page($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_ext_page($id);
			redirect('admin/external_links','refresh');
		}
		else
		{
			redirect('admin','refresh');			
		}
	}
	function city_guides()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['res'] = $this->Home_Model->get_cities();
			$this->load->view('header');
			$this->load->view('view_city',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');		
		}
	}
	function add_city_guide()
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$this->load->view('header');
			$this->load->view('add_city');
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');		
		}
	}
	function add_city()
	{
		$title = $this->input->post('title');
		$content = $this->input->post('test');
		$date = date('Y-m-d');
		$this->Home_Model->add_city($title,$content,$date);
		redirect('admin/city_guides','refresh');
	}
	function city_status($id,$status)
	{
		
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->update_city_status($id,$status);
			redirect('admin/city_guides','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function edit_city_page($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['res'] = $this->Home_Model->edit_city_page($id);
			$this->load->view('header');
			$this->load->view('edit_city_guide',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_city_guide($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			 $title = $this->input->post('title');
			 $test = $this->input->post('test');
			$date = date('Y-m-d');
			$this->Home_Model->update_city_guide($title,$test,$date,$id);
			redirect('admin/city_guides','refresh');
		}
		else
		{
			redirect('admin','refresh');			
		}
	}
	function view_city($id)
	{
		$data['res'] = $this->Home_Model->view_city($id);
		$this->load->view('customer/city_guide',$data);
	}
	function delete_city_page($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_city_page($id);
			redirect('admin/city_guides','refresh');
		}
		else
		{
			redirect('admin','refresh');			
		}
	}
	function aboutus($flag="")
	{
		$data['aflag'] = $flag;
		$data['res'] = $this->Home_Model->get_static();
		$this->load->view('customer/whystaykey',$data);
	}
	function team($flag="")
	{
		$data['tflag'] = $flag;
		$data['res'] = $this->Home_Model->get_team();
		$this->load->view('customer/whystaykey',$data);
	}
	function careers()
	{
		$data['res'] = $this->Home_Model->get_careers();
		$this->load->view('customer/whystaykey',$data);
	}
	function insider()
	{
		$data['res'] = $this->Home_Model->get_insider();
		$this->load->view('customer/whystaykey',$data);
	}
	function save()
	{
		$data['res'] = $this->Home_Model->get_save();
		$this->load->view('customer/whystaykey',$data);
	}
	function contact()
	{
		$data['res'] = $this->Home_Model->get_contact();
		$this->load->view('customer/whystaykey',$data);
	}
	function faq()
	{
		$data['res'] = $this->Home_Model->get_faq();
		$this->load->view('customer/whystaykey',$data);
	}
	function solutions()
	{
		$data['res'] = $this->Home_Model->get_solutions();
		//echo "<pre>"; print_r($res);exit;
		$this->load->view('customer/whystaykey',$data);
	}
	function cancel_booking($transid)
	{
	
		$client="1184";
 		$email="XML.PROVAB@ITRAVELUKRAINE.COM";
		$pass="PASS"; // local
 		$URL = "https://interface.demo.gta-travel.com/wbsapi/RequestListenerServlet";//local
		$xml_data ='<?xml version="1.0" encoding="UTF-8"?>
		<Request>
		 <Source>
		  <RequestorID Client="'.$client.'" EMailAddress="'.$email.'" Password="'.$pass.'" />
		  <RequestorPreferences Language="en" Currency="HKD">
		   <RequestMode>SYNCHRONOUS</RequestMode>
		  </RequestorPreferences>
		 </Source>
		 <RequestDetails>
		  <CancelBookingItemRequest>
		   <BookingReference ReferenceSource="client">'.$transid.'</BookingReference>
		   <ItemReferences>
			<ItemReference>1</ItemReference>
		   </ItemReferences>
		  </CancelBookingItemRequest>
		 </RequestDetails>
		</Request>';
		//echo $xml_data;exit;
		$ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
   		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
        $httpHeader = array(
            "Content-Type: text/xml; charset=UTF-8",
            "Content-Encoding: UTF-8"
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        $output=curl_exec($ch);
        $errno = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close($ch);
		echo $output;exit;
		$BookingStatus=$dom2->getElementsByTagName("BookingStatus");
		$cancel_status=$BookingStatus->item(0)->nodeValue;
		$data['xml_data']=$output;
		$data['book_id'] = $itemcode;
		$this->Home_Model->Update_cancel_status('Cancelled',$transid);
		redirect('admin/bookings/','refresh');
	}
	function view_emails()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['emails'] = $this->Home_Model->view_emails();
			$this->load->view('header');
			$this->load->view('view_emails',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');	
		}
	}
	function add_email()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('add_email_type');
		}
		else
		{
			redirect('admin','refresh');			
		}
	}
	function add_email_type()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$add_email_type = $this->input->post('add_email_type');
			$add_email_code = $this->input->post('add_email_code');
			$this->Home_Model->add_email_type($add_email_type,$add_email_code);
			redirect('admin/view_emails','refresh');
		}
		else
		{
			redirect('admin/','refresh');			
		}
	}
	function edit_email_type($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['email'] = $this->Home_Model->edit_email_type($id);
			$this->load->view('edit_email_type',$data);
		}
		else
		{
			redirect('admin/','refresh');			
		}
	}
	function edit_email_type_content($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$add_email_type = $this->input->post('add_email_type');
			$add_email_code = $this->input->post('add_email_code');
			$this->Home_Model->edit_email_type_content($add_email_type,$add_email_code,$id);
			redirect('admin/view_emails','refresh');
		}
		else
		{
			redirect('admin/','refresh');			
		}
	}
	function delete_email_type($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_email_type($id);
			redirect('admin/view_emails','refresh');
		}
		else
		{
			redirect('admin/','refresh');			
		}
	}
	function email_content($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['id'] = $id;
			$data['emails'] = $this->Home_Model->view_emails();
			$data['content'] = $this->Home_Model->get_email_content($id);
			$this->load->view('header');
			$this->load->view('add_email_content',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/','refresh');			
		}
	}
	function add_email_content()
	{
		$email_type_id = $this->input->post('email_type_id');
		$title = $this->input->post('title');
		$subject = $this->input->post('subject');
		$html_content = $this->input->post('html_content');
		$footer = $this->input->post('footer');
		$this->Home_Model->add_email_content($email_type_id,$title,$subject,$html_content,$footer);
		redirect('admin/view_emails','refresh');
	}
	function admin_commission()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['comm'] = $this->Home_Model->admin_commission();
			$this->load->view('admin_commission',$data);
		}
		else
		{
			redirect('admin/','refresh');			
		}
	}
	function update_comm()
	{
		$add_update_comm = $this->input->post('add_update_comm');
		$comm_status = $this->input->post('comm_status');
		$this->Home_Model->update_comm($add_update_comm,$comm_status);
		redirect('admin/admin_commission','refresh');
	}
	function view_prop($id)
	{
		if($this->session->userdata('admin_id')!='')
		{		
			 $data['id'] = $id;	
		     $data['prop'] = $this->Home_Model->view_prop($id);
			 $this->session->set_userdata(array('admin_user_id'=>$id));
			 $data['sup_details'] = $this->Supplier_Model->get_sup_details($this->session->userdata('admin_user_id'));
			 $this->load->view('header');
			 $this->load->view('view_props',$data);
			 $this->load->view('footer');
		}
		else
		{
			redirect('admin/','refresh');			
		}
	}
	function apart_list()
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['apartment_list'] = $this->Supplier_Model->apartment_list($this->session->userdata('admin_user_id'));
			//print_r($data['apartment_list']);exit();
			redirect('admin/view_prop/'.$this->session->userdata('admin_user_id'),'refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
	 function supplier_home($apart_id,$flag="",$id)
   {
	   if($this->session->userdata('admin_id')!='')
		{
   			$data['gciflag'] = $flag;
			 $this->session->set_userdata(array('apt_id'=>$apart_id));
			
			$data['sup_details'] = $this->Supplier_Model->get_sup_details($this->session->userdata('admin_user_id'));
			$data['country'] = $this->Supplier_Model->get_country();
			$data['cnt'] = $this->Supplier_Model->get_sup_cnt($this->session->userdata('apt_id'));
			$data['sup'] = $this->Supplier_Model->get_sup_details1($this->session->userdata('apt_id'));
			$data['apt'] = $this->Supplier_Model->get_apt_details($this->session->userdata('apt_id'));
			$data['language'] = $language = $this->Supplier_Model->get_language();
			$data['lang'] = $this->Supplier_Model->get_language_sup($this->session->userdata('user_id'));
			$data['res'] = $this->Supplier_Model->get_reservation_info($this->session->userdata('apt_id'));
			$data['mar'] = $this->Supplier_Model->get_market_info($this->session->userdata('apt_id'));
			$data['fin'] = $this->Supplier_Model->get_finance_info($this->session->userdata('apt_id'));
			$data['id'] = $id;
			$data['apart_id'] = $apart_id;
   			$this->load->view('prop_home',$data);
		}
		else
		{
			 redirect('admin', 'refresh');
		}
   }  
   function cancel_booking_available_cancel($booking_ref)
   {
	     if($this->session->userdata('admin_id')!='')
		{
		   $details1 = $this->Home_Model->get_detail_ref($booking_ref);
		   $type = $details1->type;
		   $roomcode = $details1->roomUseCode;
		   $rate_id = $this->Home_Model->get_rate_id($type,$roomcode);
		   $date = date('Y-m-d');
		   if($date >= $details1->cancel_fromdate)
		   {
			   $refund_amount = $details1->amount;
		   }
		   else
		   {
			   $refund_amount = $details1->amount-$details1->cancel_amount;
		   }
		   
		$get_booking_details = $this->Home_Model->get_booking_details1($booking_ref);
		$get_book_details12 =  $get_book_details12 = $this->Home_Model->get_book_details12($get_booking_details->booking_no);
		$get_book_det =  $this->Home_Model->get_book_det($get_book_details12->passenger_info_id);
		// echo "<pre>"; print_r($get_book_det);exit;  
	  $msg16 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style="border-style:solid;  border-width:20; border-color:#ebebeb; border-bottom:1px solid #cbcbcb;">		
						<table width="610" bgcolor="#fff" border-bottom:1px solid #fff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td width="610" height="30" align="left"  style=" background-color: #ebebeb;  border-bottom: 1px solid #cbcbcb;"> </td>		
					</tr>
							<tr>
									<td width="610" valign="top" align="left" style="padding: 0px 14px 0px 14px; background-color: #ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">				
		           			<table width="580" cellspacing="0" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="700" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><br />	
				<b>IMPORTANT: YOUR BOOKING HAS BEEN CANCELLED</b><br/><br/>
							<strong>Dear '.$get_book_details12->firstname.',<br/><br/></strong>
								The booking for '.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).' has been cancelled<br /><br />
										
				<strong>Your Stayserviced Booking No. is: '.$get_booking_details->booking_ref_no.'</strong><br /><br/>
				Should you have any questions or concerns, please feel free to contact us at any time.<br/>
				Email:<a href="mailto:cs@stayserviced.com">cs@stayserviced.com</a>
																																	
				</td>										
								
			</tr>
		</table>
	</td>
</tr>						
							
						
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					if($get_book_det != ''){
					 foreach($get_book_det as $row1){
					$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg16 .= 'N';}else{$msg16 .= 'Y';}
							$msg16 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg16 .='N';}else{$msg16 .= 'Y';}
						$msg16 .='</td>            
					</tr>';
					}
					}											                               
 				$msg16 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						
				</tr>';
				if($get_book_det != ''){
				foreach($get_book_det as $row1){
				$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg16 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg16 .='Non - refundable';}'</td>
					</tr>';
				}}
				
					
				$msg16 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				if($get_book_det != ''){
				foreach($get_book_det as $row1){
				$msg16 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;width:auto;"><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' :</b> '.$row1->request.'</td>        
						
					</tr>';
				}}
			$msg16 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
					
																		
					</table>
				</td>
			</tr>
							<tr>
							 <td valign="top" align="center" height="25" style=" background-color: #ebebeb;  "> </td>                                                         
							  </tr>
					  </table>	
						

</body>
</html>';
//echo $msg16;exit;
$sup_email = $this->Home_Model->get_sup_email($get_booking_details->hotel_code);
require("PHPMailer/class.phpmailer.php"); 
$get_confrm_mail = $this->Home_Model->get_confrm_mail_req();
//$sub = str_replace('{Reference Number}',$booking_ref,$get_confrm_mail->email_subject);
$sub = 'Booking Cancellation '.$booking_ref;
//$sub = str_replace('{Reference Number}',$this->session->userdata('trans_id'),$get_confrm_mail->email_subject);
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
				$mail->AddAddress($get_book_details12->email);
				$mail->Subject = $sub;
				$mail->Body = $msg16;
				$mail->SMTPAuth   = true;                 // enable SMTP authentication
				$mail->CharSet = 'utf-8';
				$mail->SMTPDebug  = 0;
				if(!$mail->Send())
				{
					show_error($this->email->print_debugger());
				}
				 $msg17 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style=" border-width:20; border-color:#ebebeb; ">	
						<table width="610" bgcolor="#fff" border-bottom:1px solid #fff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="610" height="25" align="left"  style=" background-color: #ebebeb;  border-bottom: 1px solid #cbcbcb;"> </td>		
							</tr>		
							<tr>
									<td width="610" valign="top" align="left" style="padding: 0px 14px 0px 14px; background-color: #ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">				
		           			<table width="580" cellspacing="0" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" align="center" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="700" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><br />
				<b>IMPORTANT: A BOOKING HAS BEEN CANCELLED</b><br/><br/>	
				Dear '.$sup_email->fname.',<br/><br/>
					The booking for '.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).' has been cancelled.<br /><br />
					<strong>The Stayserviced Booking No. is: '.$get_booking_details->booking_ref_no.'</strong><br /><br />	
					Reason:<br/>
					 '.$get_booking_details->cancellationDeadlineTime.'<br/><br/>
					 Inline with your cancellation policy please advise if there is an outstanding balance to be paid or credit card details are required for the cancellation.<br/><br/>
					 Should you have any questions or concerns, please feel free to contact us at any time.<br/>
					 Email:<a href="mailto:supplier@stayserviced.com>supplier@stayserviced.com</a>

				Please give approval and confirmation <a href="https://www.stayserviced.com/index.php/home/guest_login">Click Here</a><br/><br/>
						
				If this booking request cannot be accepted, please email us <a href="mailto:reserv@stayserviced.com">reserv@stayserviced.com</a> within 12 hours with any alternative options.<br/>						
			
				
																														
				</td>										
								
			</tr>
		</table>
	</td>
</tr>						
														
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					if($get_book_det != ''){
					 foreach($get_book_det as $row1){
					$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg17 .= 'N';}else{$msg17 .= 'Y';}
							$msg17 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg17 .='N';}else{$msg17 .= 'Y';}
						$msg17 .='</td>            
					</tr>';
					}}
																	                               
 				$msg17 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						
				</tr>';
				if($get_book_det != ''){
				foreach($get_book_det as $row1){
				$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg17 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg17 .='Non - refundable';}'</td>
					</tr>';
				}}
				
					
				$msg17 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				if($get_book_det != ''){
				foreach($get_book_det as $row1){
				$msg17 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;width:atuo;"><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' :</b> '.$row1->request.'</td>        
						
					</tr>';
				}}
			$msg17 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
					
												
																		
					</table>
				</td>
			</tr>
			
							<tr>
							 <td valign="top" align="center" height="25" style=" background-color: #ebebeb;  "> </td>                                                         
							  </tr>

</body>
</html>';
	
	$sp_email = $this->Home_Model->get_sup_email_sending($get_booking_details->hotel_code);
	$get_confrm_mail_sup = $this->Home_Model->get_confrm_mail_sup();
	//$sub1 = str_replace('{Accom Name}',$this->Home_Model->get_accom_name($get_booking_details->hotel_code),$get_confrm_mail_sup->email_subject);
	$sub1 = 'Booking Cancellation '.$booking_ref;
	$mail1 = new PHPMailer();
	$mail1->From = 'info@stayserviced.com';
	$mail1->FromName = "no-reply@stayserviced.com";
	$mail1->Host='mail.stayserviced.com';
	$mail1->Port='587';
	$mail1->Username   = 'info@stayserviced.com';
	$mail1->Password   = 'sunlight';
	$mail1->SMTPKeepAlive = true;
	$mail1->Mailer = "smtp";
	$mail1->WordWrap = FALSE;
	$mail1->IsSMTP();
	$mail1->IsHTML(true);
	$mail1->AddAddress($sp_email);
	$mail1->AddBcc("admin@stayserviced.com");
	$mail1->Subject = $sub1;
	$mail1->Body = $msg17;
	$mail1->SMTPAuth   = true;                 // enable SMTP authentication
	$mail1->CharSet = 'utf-8';
	$mail1->SMTPDebug  = 0;
	if(!$mail1->Send())
	{
		show_error($this->email->print_debugger());
	}
 	$this->Home_Model->update_cancel_booking($booking_ref);	
	$diff = ((strtotime($details1->check_out) - strtotime($details1->check_in)))/(60*60*24);
				for($k=0;$k<$diff;$k++)
				{
					$date =  date("Y-m-d", strtotime('+'.$k.' day', strtotime($details1->check_in)));
					$this->Home_Model->update_maintain_month($rate_id,$date,$details1->no_of_room,$details1->hotel_code);
				}
				redirect('admin/view_bookings/'.$booking_ref,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
   }
   function cancel_booking_onrequest_cancel($booking_ref)
   {
	     if($this->session->userdata('admin_id')!='')
		{
		   		$get_booking_details = $this->Home_Model->get_booking_details1($booking_ref);
		$get_book_details12 =  $get_book_details12 = $this->Home_Model->get_book_details12($get_booking_details->booking_no);
		$get_book_det =  $this->Home_Model->get_book_det($get_book_details12->passenger_info_id);
		// echo "<pre>"; print_r($get_book_det);exit;  
	  $msg16 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style="  border-width:20;   ">
						<table width="610" bgcolor="#fff" border-bottom:1px solid #fff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="610" height="30" align="left"  style=" background-color: #ebebeb;  border-bottom: 1px solid #cbcbcb;"> </td>		
							</tr>			
							<tr>
									<td width="582" valign="top" align="left"  style="background-color:#ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">				
		           			<table width="580" align="center" cellspacing="0" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="700" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><br />	
				<b>IMPORTANT: YOUR BOOKING HAS BEEN CANCELLED</b><br/><br/>
							<strong>Dear '.$get_book_details12->firstname.',<br/><br/></strong>
								The booking for '.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).' has been cancelled<br /><br />
										
				<strong>Your Stayserviced Booking No. is: '.$get_booking_details->booking_ref_no.'</strong><br /><br/>
				Should you have any questions or concerns, please feel free to contact us at any time.<br/>
				Email:<a href="mailto:cs@stayserviced.com">cs@stayserviced.com</a>
																																	
				</td>										
								
			</tr>
		</table>
	</td>
</tr>						
							
						
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					 foreach($get_book_det as $row1){
					$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg16 .= 'N';}else{$msg16 .= 'Y';}
							$msg16 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg16 .='N';}else{$msg16 .= 'Y';}
						$msg16 .='</td>            
					</tr>';
					}
																	                               
 				$msg16 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						
				</tr>';
				foreach($get_book_det as $row1){
				$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg16 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg16 .='Non - refundable';}'</td>
					</tr>';
				}
				
					
				$msg16 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				foreach($get_book_det as $row1){
				$msg16 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;width:auto;"><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' :</b> '.$row1->request.'</td>        
						
					</tr>';
				}
			$msg16 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
						</tr>
																		
	</table>
									
							</td>
						</tr>
						<td>
						 											
					
				</table>
		</table>
		
		
		
							  <tr>
							 <td valign="top" align="center" height="25" style=" background-color: #ebebeb;  "> </td>                                                         
							  </tr>                      
					  </table>			

</body>
</html>';
//echo $msg16;exit;
$sup_email = $this->Home_Model->get_sup_email($get_booking_details->hotel_code);
require("PHPMailer/class.phpmailer.php"); 
$get_confrm_mail = $this->Home_Model->get_confrm_mail_req();
//$sub = str_replace('{Reference Number}',$booking_ref,$get_confrm_mail->email_subject);
$sub = 'Booking Cancellation '.$booking_ref;
//$sub = str_replace('{Reference Number}',$this->session->userdata('trans_id'),$get_confrm_mail->email_subject);
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
				$mail->AddAddress($get_book_details12->email);
				$mail->Subject = $sub;
				$mail->Body = $msg16;
				$mail->SMTPAuth   = true;                 // enable SMTP authentication
				$mail->CharSet = 'utf-8';
				$mail->SMTPDebug  = 0;
				if(!$mail->Send())
				{
					show_error($this->email->print_debugger());
				}
				 $msg17 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style=" border-width:20; border-color:#ebebeb; ">	
						<table width="610" bgcolor="#fff" border-bottom:1px solid #fff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="610" height="51" align="left"><img src="'.WEB_DIR.'images/eml_top_background.gif" width="612" height="51" border="0" alt="Stayserviced Confirmation Email" /></td>		
							</tr>				
							<tr>
									<td width="610" valign="top" align="left" style="padding: 0px 14px 0px 14px; background-color: #ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">				
		           			<table width="580" cellspacing="0" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" align="center" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="700" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><br />
				<b>IMPORTANT: A BOOKING HAS BEEN CANCELLED</b><br/><br/>	
				Dear '.$sup_email->fname.',<br/><br/>
					The booking for '.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).' has been cancelled.<br /><br />
					<strong>The Stayserviced Booking No. is: '.$get_booking_details->booking_ref_no.'</strong><br /><br />	
					Reason:<br/>
					 '.$get_booking_details->cancellationDeadlineTime.'<br/><br/>
					 Inline with your cancellation policy please advise if there is an outstanding balance to be paid or credit card details are required for the cancellation.<br/><br/>
					 Should you have any questions or concerns, please feel free to contact us at any time.<br/>
					 Email:<a href="mailto:supplier@stayserviced.com>supplier@stayserviced.com</a>

				Please give approval and confirmation <a href="https://www.stayserviced.com/index.php/home/guest_login">Click Here</a><br/><br/>
						
				If this booking request cannot be accepted, please email us <a href="mailto:reserv@stayserviced.com">reserv@stayserviced.com</a> within 12 hours with any alternative options.<br/>						
			
				
																														
				</td>										
								
			</tr>
		</table>
	</td>
</tr>						
														
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					 foreach($get_book_det as $row1){
					$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg17 .= 'N';}else{$msg17 .= 'Y';}
							$msg17 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg17 .='N';}else{$msg17 .= 'Y';}
						$msg17 .='</td>            
					</tr>';
					}
																	                               
 				$msg17 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						
				</tr>';
				foreach($get_book_det as $row1){
				$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg17 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg17 .='Non - refundable';}'</td>
					</tr>';
				}
				
					
				$msg17 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				foreach($get_book_det as $row1){
				$msg17 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;width:atuo;"><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' :</b> '.$row1->request.'</td>        
						
					</tr>';
				}
			$msg17 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
						</tr>
																		
	</table>
									
							</td>
						</tr>
						<td>
						 											
					
				</table>
		</table>
		
		
		
							<tr>
							  <td valign="top" align="left" style=" background-color: #ebebeb;padding-left:15px; "><img src="'.WEB_DIR.'images/eml_bottom_background.gif"alt="Stayserviced Confirmation Email" width="612" height="41" border="0" />                                                          
					  </table>		

</body>
</html>';
	
	$sp_email = $this->Home_Model->get_sup_email_sending($get_booking_details->hotel_code);
	$get_confrm_mail_sup = $this->Home_Model->get_confrm_mail_sup();
	//$sub1 = str_replace('{Accom Name}',$this->Home_Model->get_accom_name($get_booking_details->hotel_code),$get_confrm_mail_sup->email_subject);
	$sub1 = 'Booking Cancellation '.$booking_ref;
	$mail1 = new PHPMailer();
	$mail1->From = 'info@stayserviced.com';
	$mail1->FromName = "no-reply@stayserviced.com";
	$mail1->Host='mail.stayserviced.com';
	$mail1->Port='587';
	$mail1->Username   = 'info@stayserviced.com';
	$mail1->Password   = 'sunlight';
	$mail1->SMTPKeepAlive = true;
	$mail1->Mailer = "smtp";
	$mail1->WordWrap = FALSE;
	$mail1->IsSMTP();
	$mail1->IsHTML(true);
	$mail1->AddAddress($sp_email);
	$mail1->AddBcc("admin@stayserviced.com");
	$mail1->Subject = $sub1;
	$mail1->Body = $msg17;
	$mail1->SMTPAuth   = true;                 // enable SMTP authentication
	$mail1->CharSet = 'utf-8';
	$mail1->SMTPDebug  = 0;
	if(!$mail1->Send())
	{
		show_error($this->email->print_debugger());
	}
		   		$this->Home_Model->update_cancel_booking($booking_ref);	
			  redirect('admin/view_bookings/'.$booking_ref,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
   }
   function cancel_booking_onrequest_confirm($booking_ref)
   {
	     if($this->session->userdata('admin_id')!='')
		{
  $con_pdf = $this->Home_Model->get_con_pdf($booking_ref);
?>
<?php /*?><script type="text/javascript" src="<?php echo WEB_DIR; ?>js/jquery_tab2.js"></script><?php */?>
			<script type="text/javascript">
var cnfm_pdf = "<?php echo $con_pdf; ?>"; 

		 $.post('<?php echo WEB_DIR?>voucher/confirmation_email.php',{'name':cnfm_pdf,'id':<?php echo $booking_ref?>},function(data){ 
		
	});
</script>
<?php 

/*$this->Home_Model->update_request_booking($booking_ref);
		   $details1 = $this->Home_Model->get_detail_ref($booking_ref);
		   $info = $this->Home_Model->cancel_info_mail();
		    $type = $details1->type;
		   $roomcode = $details1->roomUseCode;
		   $rate_id = $this->Home_Model->get_rate_id($type,$roomcode);
		   for($k=0;$k<$diff;$k++)
			{
				$date =  date("Y-m-d", strtotime('+'.$k.' day', strtotime($details1->check_in)));
				$this->Home_Model->update_maintain_month_add($rate_id,$date,$details1->no_of_room,$details1->hotel_code);
			}*/
		   	$get_booking_details = $this->Home_Model->get_booking_details1($booking_ref);
		$get_book_details12 =  $get_book_details12 = $this->Home_Model->get_book_details12($get_booking_details->booking_no);
		$get_book_det =  $this->Home_Model->get_book_det($get_book_details12->passenger_info_id);
	//	echo "<pre>"; print_r($get_book_details12);exit;
				$msg16 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style="  border-width:20; ">		
						<table width="610" bgcolor="#fff" border-bottom:1px solid #fff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="610" height="30" align="left"  style=" background-color: #ebebeb;  border-bottom: 1px solid #cbcbcb;"> </td>		
							</tr>
							<tr>
									<td width="582" valign="top" align="left"  style="background-color:#ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">			
		           			<table width="580" align="center" cellspacing="0" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="325" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><img src="'.WEB_DIR.'images/eml_purchaseconfirmation.png" width="180" height="50" border="0" alt="Purchase Confirmation" /><br />										 								<strong>'.$get_book_details12->firstname.',<br/><br/></strong>
								Thank you for booking your stay with Stayserviced.<br /><br />
						
				<strong>Your Stayserviced Booking No. is: '.$get_booking_details->booking_ref_no.'</strong><br />
				<strong>Your Stayserviced Pin Code is: '.$get_booking_details->itemcode.'</strong><br /><br />													
			
				To view and print this booking in PDF: <a href="'.WEB_DIR.'voucher/email/'.$get_booking_details->cnfm_pdf.'.pdf">Click Here</a><br /><br />
				To change, amend or cancel your booking: <a href="https://www.stayserviced.com/index.php/home/guest_login/" style="color:#003466">Click Here</a></td> <br />																													
				</td>										
				<td width="245" valign="top">										 
				<img src="'.WEB_DIR.'images/eml_top_polaroidphotos_cities.jpg" width="240" height="216" border="0" alt="Stayserviced" />
				</td>				
			</tr>
		</table>
	</td>
</tr>						
								<tr>
  <td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Customer Support</strong></td>
						<td width="30%"><br /></td>
						<td align="left" width="35%"><br /></td>									
					</tr>
					<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><a href="mailto:cs@stayserviced.com" style="color:#003466">Email Stayserviced</a></td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><a href="https://stayserviced.tenderapp.com/discussion/new" style="color:#003466">Online Customer Support</a></td>     
					</tr>
     
						
																		                               
 				</table>
			</td>
					
						
		</tr>
	</table>									             
  </td>
</tr>	
						
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					 foreach($get_book_det as $row1){
					$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg16 .= 'N';}else{$msg16 .= 'Y';}
							$msg16 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg16 .='N';}else{$msg16 .= 'Y';}
						$msg16 .='</td>            
					</tr>';
					}
																	                               
 				$msg16 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						
				</tr>';
				foreach($get_book_det as $row1){
				$msg16 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg16 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg16 .='Non - refundable';}'</td>
					</tr>';
				}
				
					
				$msg16 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				foreach($get_book_det as $row1){
				$msg16 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; width:auto;" ><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' : </b> '.$row1->request.'</td>        
						
					</tr>';
				}
			$msg16 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
					
												<tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:15px 5px 0px 5px;">   																					 
		<table cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-bottom:10px;">
				<strong>Policies</strong>																		
				</td>															
			</tr>
				
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				A Government-issued photo ID is required at the accommodation and for additional services.
				</td>															
			</tr>	
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				You will be responsible for any additional services used during your stay
				</td>															
			</tr>								
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Any refund will be automatically processed to the credit card used during the transaction.
				</td>															
			</tr>
						<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				A no-show will be treated as a cancellation and you will be billed accordingly. 
				</td>															
			</tr>				
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Stayservicved does not charge a processing fee for cancellations. 
				</td>		
				<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Always refer to your Booking Reference '.$get_booking_details->booking_ref_no.' in all your correspondence.
				</td>													
			</tr>
			<tr>
				<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:5px 7px 0px 0px;">
				<a href="http://stayserviced.tenderapp.com/kb/general/terms-of-service" style="color:#003466">Terms of Service</a><br />
				<a href="http://www.stayserviced.com/index.php/home/faq/1" style="color:#003466">FAQs</a><br />
				<a href="http://www.stayserviced.com/index.php/home/aboutus" style="color:#003466">About Us</a><br /><br />			

												
								</td>
						</tr>
																		
	</table>
									
							</td>
						</tr>
						<td>
						 											
					
				</table>
		</table>
		
		
		<tr>
							 <td valign="top" align="center" height="25" style=" background-color: #ebebeb;  "> </td>                                                         
							  </tr>                          
					  </table>	
</body>
</html>';
require("PHPMailer/class.phpmailer.php"); 
//echo $get_book_details12->email;exit;
//echo $get_booking_details->email;exit;
$sup_email = $this->Home_Model->get_sup_email($get_booking_details->hotel_code);
$get_confrm_mail = $this->Home_Model->get_confrm_mail();
$sub = str_replace('{Reference Number}',$get_booking_details->booking_ref_no,$get_confrm_mail->email_subject);
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
				$mail->AddAddress($get_book_details12->email);
				$mail->Subject = $sub;
				$mail->Body = $msg16;
				$mail->SMTPAuth   = true;                 // enable SMTP authentication
				$mail->CharSet = 'utf-8';
				$mail->SMTPDebug  = 0;
				if(!$mail->Send())
				{
					show_error($this->email->print_debugger());
				}
 $msg17 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style=" border-width:20; border-color:#ebebeb; ">	
						<table width="610" bgcolor="#fff" border-bottom:1px solid #fff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="610" height="51" align="left"><img src="'.WEB_DIR.'images/eml_top_background.gif" width="612" height="51" border="0" alt="Stayserviced Confirmation Email" /></td>		
							</tr>						
							<tr>
									<td width="610" valign="top" align="left" style="padding: 0px 14px 0px 14px; background-color: #ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">				
		           			<table width="580" cellspacing="0" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" align="center" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="700" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><br />	
				Dear '.$sup_email->fname.',<br /><br />
					The booking for '.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).' is confirmed.<br /><br />
				<strong>The Stayserviced Booking No. Code is: '.$get_booking_details->booking_ref_no.'</strong><br /><br />											
				View the booking details online:<a href="https://www.stayserviced.com/index.php/home/supplier" style="color:#003466">Click Here</a></td> <br />						
			
				
																														
				</td>										
								
			</tr>
		</table>
	</td>
</tr>						
														
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					 foreach($get_book_det as $row1){
					$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg17 .= 'N';}else{$msg17 .= 'Y';}
							$msg17 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg17 .='N';}else{$msg17 .= 'Y';}
						$msg17 .='</td>            
					</tr>';
					}
																	                               
 				$msg17 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						
				</tr>';
				foreach($get_book_det as $row1){
				$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg17 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg17 .='Non - refundable';}'</td>
					</tr>';
				}
				
					
				$msg17 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				foreach($get_book_det as $row1){
				$msg17 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;width:auto;"><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' :</b> '.$row1->request.' </td>        
						
					</tr>';
				}
			$msg17 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>

    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
					
											<tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:15px 5px 0px 5px; background-color:#fff;">   																					 
		<table cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-bottom:10px;">
				Should you need to amend or cancel this reservation, please feel free to contact us at any time.<br /></a><br /><br />
				Best Regards,<br />
				The Stayserviced Team<br /><br />																		
				</td>
						</tr>
																		
	</table>
									
							</td>
						</tr>
						<td>
						 											
					
				</table>
		</table>
		
		
		
							<tr>
							  <td valign="top" align="left" style=" background-color: #ebebeb;padding-left:15px; "><img src="'.WEB_DIR.'images/eml_bottom_background.gif"alt="Stayserviced Confirmation Email" width="612" height="41" border="0" />                                                          
					  </table>	
</body>
</html>';
	$sup_email = $this->Home_Model->get_sup_email($get_booking_details->hotel_code);
	$sp_email = $this->Home_Model->get_sup_email_sending($get_booking_details->hotel_code);
	$get_confrm_mail_sup = $this->Home_Model->get_confrm_mail_sup();
	$sub1 = str_replace('{Accom Name}',$this->session->userdata('apt_name'),$get_confrm_mail_sup->email_subject);
	$mail1 = new PHPMailer();
	$mail1->From = 'info@stayserviced.com';
	$mail1->FromName = "no-reply@stayserviced.com";
	$mail1->Host='mail.stayserviced.com';
	$mail1->Port='587';
	$mail1->Username   = 'info@stayserviced.com';
	$mail1->Password   = 'sunlight';
	$mail1->SMTPKeepAlive = true;
	$mail1->Mailer = "smtp";
	$mail1->WordWrap = FALSE;
	$mail1->IsSMTP();
	$mail1->IsHTML(true);
	$mail1->AddAddress($sp_email);
	$mail1->AddBcc("admin@stayserviced.com");
	$mail1->Subject = $sub1;
	$mail1->Body = $msg17;
	$mail1->SMTPAuth   = true;                 // enable SMTP authentication
	$mail1->CharSet = 'utf-8';
	$mail1->SMTPDebug  = 0;
	if(!$mail1->Send())
	{
		show_error($this->email->print_debugger());
	}
				
			     redirect('admin/view_bookings/'.$booking_ref,'refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
   }
   function newsletter()
   {
	   	if($this->session->userdata('admin_id')!='')
		{
			$data['sub'] = $this->Home_Model->newsletter();
			$this->load->view('header');
			$this->load->view('newsletter',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
   }
   function newsletter_template()
   {
	  if($this->session->userdata('admin_id')!='')
	  {
		  $data['sel'] = $sel =  $this->input->post('Del_Id');
		  $this->load->view('header');
			$this->load->view('newsletter_details',$data);
			$this->load->view('footer');
	  }
	  else
	  {
		  redirect('admin','refresh');
	  }
	}
	function send_newsletter()
	{
		$tomailid = $this->input->post('email');
		$msg = $this->input->post('test');
		$sub = $this->input->post('subject');
		require("PHPMailer/class.phpmailer.php");
		$x=explode(', ',$tomailid);
		$cnt = count($x)-1;
		for($to=0;$to<$cnt;$to++)
		{
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
			$mail->AddAddress($x[$to]);
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
		redirect('admin/newsletter','refresh');
	}
	function delete_prop($user_id,$prop_id)
	{
		$this->Home_Model->delete_prop($user_id,$prop_id);
		redirect('admin/view_prop/'.$user_id,'refresh');
	}
	function payment()
	{
	  if($this->session->userdata('admin_id')!='')
	  {
		  $data['currency_types'] = $res = $this->Home_Model->get_currency_types();
		  $data['payment'] = $this->Home_Model->get_payment();
		  $this->load->view('payment',$data);
	  }
	  else
	  {
		  redirect('admin','refresh');
	  }
	}
	function payment_details()
	{
		if($this->session->userdata('admin_id')!='')
	  {
		 $payment =  $this->input->post('payment');
		// $currency = $this->input->post('currency');
		$currency = '';
		 $this->Home_Model->payment_details($payment,$currency);
		 redirect('admin/payment','refresh');
	  }
	  else
	  {
		  redirect('admin','refresh');
	  }
	}
	function refresh_booking()
	{
		redirect(WEB_URL.'home/get_countires','refresh');
	}
	function update_pop_table($id)
	{
		$this->Home_Model->delete_pop($id);
		$apt_id_activate = '';
		$res = $this->Home_Model->get_api_cnts();
		foreach($res as $a)
		{
			$apt_id_activate .= $a->booking_type_id_new.',';
		}
		$apt_id_activate = substr($apt_id_activate,0,-1);
		$resultdb = $this->Home_Model->crs_availability_without_dates($id);
		if($resultdb!='')
		{
				
					for($i=0;$i < count($resultdb); $i++)
					{
						$cntry_name = $this->Home_Model->get_cntryname($resultdb[$i]->country_id);
						$cityCode = $resultdb[$i]->city;
						$apt_id=$resultdb[$i]->apartment_id;
						$itemCode=$resultdb[$i]->apartment_id;
						$itemVal=$resultdb[$i]->apartment_name;
						$district = $resultdb[$i]->district_id;
						$class_type = $this->Home_Model->get_class_type_id($itemCode);
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
						$tot_cost = $cost;
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
							$adult_count = '';
							$this->Home_Model->insert_search_result_crs($api,$id,$cntry_name,$resultdb[$i]->sup_apart_list_id,$itemVal,$star_rate,$pernight11,$tot_cost_val,$unit_name,$rate_plan,$breakfast,$adult_count,$address->address,$image,$night,$fac1,$roomfac1,$address->latitude,$address->longitude,$common_commission_id,$cat_num,$status,$comm,$capacity,$currency,$can_cost,$charge_nights,$can_time,$district,$class_type);
							}
						
					}
				
			}
		$resultdb1 = $this->Home_Model->booking_availability_without_dates_pop($id,$apt_id_activate);
		
		if($resultdb1!='')
		{
			//$email="<table><tr><th>API</th><th>city_name</th><th>country_name</th><th>hotel_id</th><th>hotel_name</th><th>star_rate</th><th>nightperroom</th><th>cost_value</th><th>cost_type</th><th>location</th><th>status</th><th>image_url</th><th>room_code</th><th>amenities</th><th>latitude</th><th>longitude</th><th>preferred</th></tr>";
			foreach($resultdb1 as $row)
			{
					$img = '';
					$address = $row->address;
					$city_id = $row->city_id;
					$hotel_name = $row->name;
					$hotel_id= $row->hotel_id;
					$city_name = $this->Home_Model->get_booking_city($city_id);
					$countrycode = $row->countrycode;
					$minrate = $row->minrate;
					$class = $row->class;
					$latitude = $row->latitude;
					$longitude= $row->longitude;
					$img = $this->Home_Model->get_book_image($hotel_id);
					$currencycode = $row->currencycode;
					$hoteltype_id = $row->hoteltype_id;
					$district_id = $row->district;
					$amenities = $this->Home_Model->get_amenties($hotel_id);
					$class_type = $this->Home_Model->get_class_type_booking($row->hotel_id);
					$all_am = '';
					$all = '';
					$bookk_fac_all = '';
					$book_fac = $this->Home_Model->get_booking_nodates_fac($row->hotel_id);
					if($book_fac != '')
					{
						foreach($book_fac as $book_fac1)
						{
							$bookk_fac_all .= $book_fac1->hotelfacilitytype_id.',';
						}
					}
					$bookk_fac_all = substr($bookk_fac_all,0,-1);
					$amenities = explode(',',$bookk_fac_all);
					$all_fac = '';
					if($amenities != '')
					{
						for($p=0;$p<count($amenities);$p++)
						{
							$all_fac1 = $this->Home_Model->get_book_facility_name($amenities[$p]);
							if($all_fac1 != '')
							{
								$all_fac .= $all_fac1.',';
							}
						}
						$all = substr($all_fac,0,-1);
					}
					$preferred = $row->preferred;
					$this->Home_Model->insert_booking_availability_without_dates($hotel_id,$address,$city_id,$hotel_name,$countrycode,$this->session->userdata('sec_res'),$minrate,$class,$latitude,$longitude,$img,$currencycode,$hoteltype_id,$all,$class_type,$district_id,$bookk_fac_all,$preferred);
					}
				
				
			 }
			redirect('admin/popular_dest','refresh');
	}
	function slider_images()
	{
		$data['pic'] = $this->Home_Model->get_all_pic();
		$this->load->view('slider_images',$data);
	}
	 function check_pictures()
	{
		$this->Home_Model->update_uncheck_pictures();
		$checkedval = $this->input->post('apartfec_val');
		$checkval = explode(",",$checkedval);
		for($i=0;$i<=count($checkval)-1;$i++)
		{
			$comments = $this->input->post("cmnts_$checkval[$i]");
			$this->Home_Model->add_check_pictures($checkval[$i],$comments);
			$comments = "";
		}	
		redirect('admin/slider_images','refresh');
	}
	function delete_picture($id)
   		{
			//echo $id;exit;
			$img = $this->Home_Model->delete_picture($id);
			unlink($_SERVER['DOCUMENT_ROOT']."/Journey_junction/admin/static_images/".$img);
			$this->Home_Model->delete_pictures($id);
		
	
   }
   function add_banner()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$this->load->view('header');
			$this->load->view('cms/add_banner');
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function add_banner_images()
	{
		if($_FILES['image']['name'] !='')
		  {		
		   $file=$_FILES['image']['name'];
		  $image="image/".$file;
						copy($_FILES['image']['tmp_name'],"banner_images/".$file);
							$image=$file;	
	
			}
		$image_text=$this->input->post('image_text');
		$image_url=$this->input->post('image_url');
		$this->Home_Model->add_banner_image($image,$image_text,$image_url);
		redirect('admin/banner_images','refresh');
	}
	function banner_images()
	{
		if($this->session->userdata('admin_id') !='')
		{
			$data['banner_images']=$this->Home_Model->banner_images();
			$this->load->view('header',$data); 
			$this->load->view('cms/banner_images',$data);
			$this->load->view('footer'); 
		}
		else
		{
			redirect('admin/index','refresh');
			
		}
	}
	function edit_banner_image($id)
	{
		if($this->session->userdata('admin_id') !='')
		{
			$data['banner_image']=$this->Home_Model->banner_image($id);
			$this->load->view('header',$data); 
			$this->load->view('cms/edit_banner',$data);
			$this->load->view('footer'); 
		}
		else
		{
			redirect('admin/index','refresh');
			
		}
	}
	function edit_banner_images()
	{
		if($_FILES['image']['name'] !='')
		  {		
		   $file=$_FILES['image']['name'];
		  $image="image/".$file;
						copy($_FILES['image']['tmp_name'],"banner_images/".$file);
							$image=$file;	
	
			}
			else
			{
				$image=$this->input->post('logo');
			}
		$image_text=$this->input->post('image_text');
		$id=$this->input->post('id');
		$image_url=$this->input->post('image_url');
		$this->Home_Model->update_banner_image($id,$image,$image_text,$image_url);
		redirect('admin/banner_images','refresh');
	}
	function delete_banner_image($id)
	{
		if($this->session->userdata('admin_id') !='')
		{
			$this->db->delete('banner_images',array('id'=>$id));
			redirect('admin/banner_images','refresh');
		}
		else{
			redirect('admin/index','refresh');
			
		}
	}
	function bottom_right()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['images'] = $this->Home_Model->bottom_images();
			$this->load->view('header');
			$this->load->view('cms/bottom_right',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function add_bottom_images()
	{
		//echo $_FILES['image1']['name']; 
		if(isset($_FILES['image1']['name'])!='' && $_FILES['image1']['type']=='image/jpeg' || $_FILES['image1']['type']=='image/jpg' || $_FILES['image1']['type']=='image/gif' || $_FILES['image1']['type']=='image/png')
		      {         
		           $file=$_FILES['image1']['name'];             
		        	copy($_FILES['image1']['tmp_name'],"bottom_images/$file");
		        	$ext = end(explode('.',$file));
		       		$date=date('ymdhis');
		        	$image1="bottom".$date.".".$ext;
		        	rename('bottom_images/'.$file,'bottom_images/'.$image1);             
		      }
		      else
		      {
		           $image1 = $this->input->post('image_1');
		      }
			/*if($_FILES['image2']['name'] !='')
		  {		
		   $file=$_FILES['image2']['name'];
		  $image2="image/".$file;
						copy($_FILES['image2']['tmp_name'],"bottom_images/".$file);
							$image2=$file;	
	
			}
			else
			{
				$image2=$this->input->post('image_2');
			}
			if($_FILES['image3']['name'] !='')
		  {		
		   $file=$_FILES['image3']['name'];
		  $image3="image/".$file;
						copy($_FILES['image3']['tmp_name'],"bottom_images/".$file);
							$image3=$file;	
	
			}
			else
			{
				$image3=$this->input->post('image_3');
			}
			if($_FILES['image4']['name'] !='')
		  {		
		   $file=$_FILES['image4']['name'];
		  $image4="image/".$file;
						copy($_FILES['image4']['tmp_name'],"bottom_images/".$file);
							$image4=$file;	
	
			}
			else
			{
				$image4=$this->input->post('image_4');
			}*/
			
		
		//$this->Home_Model->add_bottom_images($image1,$image2,$image3,$image4);
		redirect('admin/add_bottom_images','refresh');
	}
	function reports()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['flag'] = '1';
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function search_book_hotel()
	{
		$data['flag'] = '1';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$status = $this->input->post('status');
			$transaction_id = $this->input->post('transaction_id');
			$city = $this->input->post('city');
			$book_from = $this->input->post('book_from');
			$book_to = $this->input->post('book_to');
			$data['res'] =  $res = $this->Home_Model->search_book_hotel($status,$transaction_id,$city,$book_from,$book_to);
			//echo "<pre>"; print_r($res); exit;
			$this->load->view('reports/reports_hotel',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function reports_flight()
	{
		$data['flag'] = '2';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports_flight',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function reports_bus()
	{
		$data['flag'] = '3';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports_bus',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function reports_car()
	{
		$data['flag'] = '4';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports_car',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function reports_holiday()
	{
		$data['flag'] = '5';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports_holiday',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function reports_flighthotel()
	{
		$data['flag'] = '6';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports_flighthotel',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function reports_flighthotelcar()
	{
		$data['flag'] = '7';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports_flighthotelcar',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function reports_refund()
	{
		$data['flag'] = '8';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports_refund',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function agent_reports()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['flag'] = '1';
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/agent/reports',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function agent_reports_flight()
	{
		$data['flag'] = '2';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/agent/reports_flight',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function agent_reports_bus()
	{
		$data['flag'] = '3';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/agent/reports_bus',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function agent_reports_car()
	{
		$data['flag'] = '4';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/agent/reports_car',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function agent_reports_holiday()
	{
		$data['flag'] = '5';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/agent/reports_holiday',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function agent_reports_flighthotel()
	{
		$data['flag'] = '6';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/agent_reports_flighthotel',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function agent_reports_flighthotelcar()
	{
		$data['flag'] = '7';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports_flighthotelcar',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function agent_reports_refund()
	{
		$data['flag'] = '8';
		if($this->session->userdata('admin_id')!='')
		{	
			$adminid=$this->session->userdata('adminid');	
			$this->load->view('reports/reports_refund',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function manage_franchise()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['franchise_list'] = $this->Home_Model->franchise_list();
			
			$this->load->view('header');		
			$this->load->view('view_franchise',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function edit_franchise($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['id'] = $id;
			$data['franchise_edit'] = $this->Home_Model->franchise_edit($id);
			$this->load->view('header');		
			$this->load->view('edit_franchise',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function update_franchise()
	{
		if($this->session->userdata('admin_id')!='')
		{
			 $data['id'] 				= $id 				= $this->input->post('id');
			 
			 $data['franchise_name'] 	= $franchise_name 	= $this->input->post('franchise_name');
			 $data['agent_name'] 		= $agent_name 		= $this->input->post('agent_name');
			 
			 $data['org_name'] 			= $org_name 		= $this->input->post('org_name');
			 $data['nearest_bra'] 		= $nearest_bra 		= $this->input->post('nearest_bra');
			 $data['land_line'] 		= $land_line 		= $this->input->post('land_line');
			 $data['fax'] 				= $fax 				= $this->input->post('fax');
			 $data['mobile_no'] 		= $mobile_no 		= $this->input->post('mobile_no');
			 
			 $data['website_add'] 		= $website_add 		= $this->input->post('website_add');
			
			 $data['other_det']		 	= $other_det 		= $this->input->post('other_det');
			 $data['off_add'] 			= $off_add 			= $this->input->post('off_add');
			 $data['country'] 			= $country 			= $this->input->post('country');
			 $data['bank_name'] 		= $bank_name 		= $this->input->post('bank_name');
			 $data['bank_acc'] 			= $bank_acc 		= $this->input->post('bank_acc');
			 $data['pan_no'] 			= $pan_no 			= $this->input->post('pan_no');
			 $data['pan_name'] 			= $pan_name 		= $this->input->post('pan_name');
			 $data['service_tax'] 		= $service_tax 		= $this->input->post('service_tax');
			 $data['details'] 			= $details 			= $this->input->post('details');
			 $data['gds'] 				= $gds 				= $this->input->post('gds');
			 $data['currency'] 			= $currency 		= $this->input->post('currency');
		 
		  
		
			 //echo $img1;exit;
	 $this->Home_Model->update_franchise( $franchise_name,  $agent_name, $org_name, $nearest_bra, $land_line, $fax, $mobile_no,  $website_add,  $other_det, $off_add, $country, $bank_name, $bank_acc, $pan_no, $pan_name, $service_tax, $details, $gds, $currency,$id);
	 redirect('admin/manage_franchise_afterUpdate/'.$id,'refresh');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function manage_franchise_afterUpdate($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['id'] = $id;
			$data['franchise_edit'] = $this->Home_Model->franchise_edit($id);
			$data['message'] = "Franchise has been updated Successfully...!";
			$this->load->view('header');		
			$this->load->view('edit_franchise',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function delete_franchise_details($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['id'] = $id;
			$this->Home_Model->delete_franchise($id);
			$data['message'] = "Franchise has been Deleted Successfully...!";
			$data['franchise_list'] = $this->Home_Model->franchise_list();
			
			$this->load->view('header');		
			$this->load->view('view_franchise',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function list_excursion()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
				
			//$data['excursion'] = $this->Home_Model->get_excursion();
			$data['excursion'] = $this->Home_Model->get_excursion_domestic();
			$data['excursion_inter'] = $this->Home_Model->get_excursion_inter();
			//$this->load->view('header');
			$this->load->view('list_excursion',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function list_excursion_domestic()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
				
			$data['excursion'] = $this->Home_Model->get_excursion_domestic();
			//$this->load->view('header');
			$this->load->view('list_excursion_domestic',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function list_selected_dome()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
				
			$data['excursion'] = $this->Home_Model->get_excursion_domestic();
			//$this->load->view('header');
			$this->load->view('holiday/list_selected_dome',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function list_selected_inter()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
				
			$data['excursion'] = $this->Home_Model->get_excursion_inter();
			//$this->load->view('header');
			$this->load->view('holiday/list_selected_inter',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function select_dome_excursion()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
			$data['selected_h'] = $this->Home_Model->get_selected_holiday();
			$data['excursion'] = $this->Home_Model->get_excursion_domestic();
			//$this->load->view('header');
			$this->load->view('holiday/select_dome_excursion',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function select_inter_excursion()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
			$data['selected_h'] = $this->Home_Model->get_selected_holiday_inter();
			$data['excursion'] = $this->Home_Model->get_excursion_inter();
			//$this->load->view('header');
			$this->load->view('holiday/select_inter_excursion',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function list_domestic_sel()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
			$data['selected_h'] = $this->Home_Model->get_selected_holiday_inter();
			$data['excursion'] = $this->Home_Model->get_excursion_inter();
			//$this->load->view('header');
			$this->load->view('holiday/select_inter_excursion',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function insert_select_dome()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$holiday1 = $this->input->post('holiday1');
			$holiday2 = $this->input->post('holiday2');
			$holiday3 = $this->input->post('holiday3');
			$holiday4 = $this->input->post('holiday4');
			$this->Home_Model->insert_select_dome($holiday1,$holiday2,$holiday3,$holiday4);
			redirect('admin/select_dome_excursion','refresh');
		}
		else
		{
			 redirect('admin','refresh');
		}	
	}
	function insert_select_inter()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$holiday1 = $this->input->post('holiday1');
			$holiday2 = $this->input->post('holiday2');
			$holiday3 = $this->input->post('holiday3');
			$holiday4 = $this->input->post('holiday4');
			$this->Home_Model->insert_select_inter($holiday1,$holiday2,$holiday3,$holiday4);
			redirect('admin/select_inter_excursion','refresh');
		}
		else
		{
			 redirect('admin','refresh');
		}	
	}
	function selected_dome()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
				
			$data['excursion'] = $this->Home_Model->selected_dome();
			//$this->load->view('header');
			$this->load->view('holiday/select_dome_excursion',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function list_excursion_inetr()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
				
			$data['excursion'] = $this->Home_Model->get_excursion_inter();
			//$this->load->view('header');
			$this->load->view('list_excursion_inter',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function add_excursion()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id = $this->session->userdata('admin_id');	
			
			$this->load->view('add_excursion');
			
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function edi_excursion($excursion_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$admin_id=$this->session->userdata('admin_id');	
			
			$data['excursion_det'] = $this->Home_Model->get_excursion_det($excursion_id);
			$data['excursion_id'] = $excursion_id;
			
			$this->load->view('holiday/edit_excursion',$data);
			
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function delete_excursion($excursion_id)
	{
		$this->Home_Model->delete_excursion($excursion_id);
		redirect('admin/list_excursion','refresh');
	}
	function update_holiday($ex_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$holiday_theme	 = $this->input->post('holiday_theme');
			$duration_hours	 = $this->input->post('duration_hours');
			$price_fake	 = $this->input->post('price_fake');
			
			$highlight = $this->input->post('highlight');
			$inclusion = $this->input->post('inclusion');
			$exclusion = $this->input->post('exclusion');
			$transportation = $this->input->post('transportation');
			$itinary_basic = $this->input->post('itinary_basic');
			$holiday_plan = $this->input->post('holiday_plan');
			
			$ex_type	 = $this->input->post('pack_type');
			$ex_location = $this->input->post('city');
			$country1  = explode(',',$ex_location);
			$country = $country1[1];
			$ex_name = $this->input->post('activity_name');
			$ex_duration = $this->input->post('duration');
			$ex_details = $this->input->post('ex_details');
			$ex_price = $this->input->post('price');
			$ex_product_code = $this->input->post('product_code');
			$ex_video = $this->input->post('video');
			$ex_shedule_details = $this->input->post('shedule_details');
			$ex_price_infant = '';
			$ex_price_child = '';
			$ex_price_adult = '';
			
			
			$ex_price_includes = '';
			$ex_price_includes2 = '';
			$ex_price_includes3 = '';
			$ex_price_includes4 = '';
			$ex_price_includes5 = '';
			$ex_price_includes6 = '';
			$ex_price_includes7 = '';
			$ex_price_includes8 = '';
			$ex_price_includes9 = '';
			$ex_price_includes_chk = '';
			$ex_price_includes_chk2 = '';
			$ex_price_includes_chk3 = '';
			$ex_price_includes_chk4 = '';
			$ex_price_includes_chk5 = '';
			$ex_price_includes_chk6 = '';
			$ex_price_includes_chk7 = '';
			$ex_price_includes_chk8 = '';
			$ex_price_includes_chk9 = '';
			
			$ex_price_excludes = '';
			$ex_additional_details = $this->input->post('additional_details');
			$ex_more_det = $this->input->post('more_det');
			$ex_diving = '';
			$ex_surfing = '';
			
			$cancel_policy = $this->input->post('cancel_policy');
			$term_cond = $this->input->post('term_cond');
			//echo "<pre>";print_r($this->input->post());exit;
			$added_by = "Admin";
			if(isset($_FILES['image']['name'])!='' && $_FILES['image']['type']=='image/jpeg' || $_FILES['image']['type']=='image/jpg' || $_FILES['image']['type']=='image/gif' || $_FILES['image']['type']=='image/png')
		      {         
		            $file=$_FILES['image']['name'];             
		        	copy($_FILES['image']['tmp_name'],"excursionimages/$file");
		        	$ext = end(explode('.',$file));
		       		$date=date('ymdhis');
		        	$img1="exmain".$date.".".$ext;
		        	rename('excursionimages/'.$file,'excursionimages/'.$img1);            
		      }
		      else
		      {
		           $img1 = $this->input->post('image_holi');
		      }
			   
			$ex_id = $this->Home_Model->update_holiday($ex_id,$ex_type,$ex_location,$ex_name,$ex_duration,$ex_details,$ex_price,$ex_product_code,$ex_video,$ex_shedule_details,$ex_price_infant,$ex_price_child,$ex_price_adult, $ex_price_excludes, $ex_additional_details,$ex_more_det,$img1,$ex_diving,$ex_surfing,$added_by,$country,$cancel_policy,$term_cond,$holiday_theme,$duration_hours,$price_fake,$highlight,$inclusion,$exclusion,$transportation,$itinary_basic,$holiday_plan);
			 
			
			/*$cont = count($_FILES['banner']['name']);
			   for($i=0;$i<$cont;$i++)
				{
				  if(isset($_FILES['banner']['name'][$i])!='' && $_FILES['banner']['type'][$i]=='image/jpeg' || $_FILES['banner']['type'][$i]=='image/jpg' || $_FILES['banner']['type'][$i]=='image/gif' || $_FILES['banner']['type'][$i]=='image/png')
				  {         
						$file=$_FILES['banner']['name'][$i];             
						copy($_FILES['banner']['tmp_name'][$i],"excursionimages/$file");
						$ext = end(explode('.',$file));
						$date=date('ymdhis');
						$img_banner="ex".$date.".".$ext;
						rename('excursionimages/'.$file,'excursionimages/'.$img_banner);            
				  }
				 
		     	 else
		     	 {
		           $img_banner = '';
		      	 }
			  	$this->Home_Model->add_banner_holiday($img_banner,$ex_id);	
				}*/
		
			redirect('admin/list_excursion','refresh');
		}
		else
		{
			 redirect('admin', 'refresh');
		}
	}
	function insert_excursion()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$holiday_theme	 = $this->input->post('holiday_theme');
			$duration_hours	 = $this->input->post('duration_hours');
			$price_fake	 = $this->input->post('price_fake');
			
			$highlight = $this->input->post('highlight');
			$inclusion = $this->input->post('inclusion');
			$exclusion = $this->input->post('exclusion');
			$transportation = $this->input->post('transportation');
			$itinary_basic = $this->input->post('itinary_basic');
			$holiday_plan = $this->input->post('holiday_plan');
			
			$ex_type	 = $this->input->post('pack_type');
			$ex_location = $this->input->post('city');
			$country1  = explode(',',$ex_location);
			$country = $country1[1];
			$ex_name = $this->input->post('activity_name');
			$ex_duration = $this->input->post('duration');
			$ex_details = $this->input->post('ex_details');
			$ex_price = $this->input->post('price');
			$ex_product_code = $this->input->post('product_code');
			$ex_video = $this->input->post('video');
			$ex_shedule_details = $this->input->post('shedule_details');
			$ex_price_infant = '';
			$ex_price_child = '';
			$ex_price_adult = '';
			
			/*$ex_price_includes = $this->input->post('price_includes');
			$ex_price_includes2 = $this->input->post('price_includes2');
			$ex_price_includes3 = $this->input->post('price_includes3');
			$ex_price_includes4 = $this->input->post('price_includes4');
			$ex_price_includes5 = $this->input->post('price_includes5');
			$ex_price_includes6 = $this->input->post('price_includes6');
			$ex_price_includes7 = $this->input->post('price_includes7');
			$ex_price_includes8 = $this->input->post('price_includes8');
			$ex_price_includes9 = $this->input->post('price_includes9');
			$ex_price_includes_chk = $this->input->post('price_includes_chk');
			$ex_price_includes_chk2 = $this->input->post('price_includes_chk2');
			$ex_price_includes_chk3 = $this->input->post('price_includes_chk3');
			$ex_price_includes_chk4 = $this->input->post('price_includes_chk4');
			$ex_price_includes_chk5 = $this->input->post('price_includes_chk5');
			$ex_price_includes_chk6 = $this->input->post('price_includes_chk6');
			$ex_price_includes_chk7 = $this->input->post('price_includes_chk7');
			$ex_price_includes_chk8 = $this->input->post('price_includes_chk8');
			$ex_price_includes_chk9 = $this->input->post('price_includes_chk9');*/
			$ex_price_includes = '';
			$ex_price_includes2 = '';
			$ex_price_includes3 = '';
			$ex_price_includes4 = '';
			$ex_price_includes5 = '';
			$ex_price_includes6 = '';
			$ex_price_includes7 = '';
			$ex_price_includes8 = '';
			$ex_price_includes9 = '';
			$ex_price_includes_chk = '';
			$ex_price_includes_chk2 = '';
			$ex_price_includes_chk3 = '';
			$ex_price_includes_chk4 = '';
			$ex_price_includes_chk5 = '';
			$ex_price_includes_chk6 = '';
			$ex_price_includes_chk7 = '';
			$ex_price_includes_chk8 = '';
			$ex_price_includes_chk9 = '';
			
			$ex_price_excludes = '';
			$ex_additional_details = $this->input->post('additional_details');
			$ex_more_det = $this->input->post('more_det');
			$ex_diving = '';
			$ex_surfing = '';
			
			$cancel_policy = $this->input->post('cancel_policy');
			$term_cond = $this->input->post('term_cond');
			//echo "<pre>";print_r($this->input->post());exit;
			$added_by = "Admin";
			if(isset($_FILES['image']['name'])!='' && $_FILES['image']['type']=='image/jpeg' || $_FILES['image']['type']=='image/jpg' || $_FILES['image']['type']=='image/gif' || $_FILES['image']['type']=='image/png')
		      {         
		            $file=$_FILES['image']['name'];             
		        	copy($_FILES['image']['tmp_name'],"excursionimages/$file");
		        	$ext = end(explode('.',$file));
		       		$date=date('ymdhis');
		        	$img1="exmain".$date.".".$ext;
		        	rename('excursionimages/'.$file,'excursionimages/'.$img1);            
		      }
		      else
		      {
		           $img1 = '';
		      }
			   
			$ex_id = $this->Home_Model->insert_excursion($ex_type,$ex_location,$ex_name,$ex_duration,$ex_details,$ex_price,$ex_product_code,$ex_video,$ex_shedule_details,$ex_price_infant,$ex_price_child,$ex_price_adult, $ex_price_excludes, $ex_additional_details,$ex_more_det,$img1,$ex_diving,$ex_surfing,$added_by,$country,$cancel_policy,$term_cond,$holiday_theme,$duration_hours,$price_fake,$highlight,$inclusion,$exclusion,$transportation,$itinary_basic,$holiday_plan);
			 
			 //$cnt = count($_FILES['new_image']['name']);
			//echo '<pre>'; print_r($_FILES['new_image']['name']);exit;
			$cont = count($_FILES['banner']['name']);
			   for($i=0;$i<$cont;$i++)
				{
				  if(isset($_FILES['banner']['name'][$i])!='' && $_FILES['banner']['type'][$i]=='image/jpeg' || $_FILES['banner']['type'][$i]=='image/jpg' || $_FILES['banner']['type'][$i]=='image/gif' || $_FILES['banner']['type'][$i]=='image/png')
				  {         
						$file=$_FILES['banner']['name'][$i];             
						copy($_FILES['banner']['tmp_name'][$i],"excursionimages/$file");
						$ext = end(explode('.',$file));
						$date=date('ymdhis');
						$img_banner="ex".$date.".".$ext;
						rename('excursionimages/'.$file,'excursionimages/'.$img_banner);            
				  }
				 
		     	 else
		     	 {
		           $img_banner = '';
		      	 }
			  	$this->Home_Model->add_banner_holiday($img_banner,$ex_id);	
				}
			/*for($i=0;$i<$cnt;$i++)
			{
				//echo $_FILES['new_image']['name'][$i];
			if(isset($_FILES['new_image']['name'][$i])!='' && $_FILES['new_image']['type'][$i]=='image/jpeg' || $_FILES['new_image']['type'][$i]=='image/jpg' || $_FILES['new_image']['type'][$i]=='image/gif' || $_FILES['new_image']['type'][$i]=='image/png')
			  {         
			    $file=$_FILES['new_image']['name'][$i];
				copy($_FILES['new_image']['tmp_name'][$i],"excursionimages/$file");
				$img1=$file;
				rename('excursionimages/'.$file,'excursionimages/'.$img1);	
				$title = explode('.',$file);
				
				
			  }
		    else
		  		{
					$img1='';	
					
		  		}
				$this->Home_Model->add_new_photo($img1,$title[0],$ex_id);	
			}*/
			redirect('admin/list_excursion','refresh');
		}
		else
		{
			 redirect('admin', 'refresh');
		}
	}
	function add_holiday_hotel($ex_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['ex_id'] = $ex_id;
			$admin_id = $this->session->userdata('admin_id');	
			$this->load->view('holiday/add_holiday_hotel',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
			
	}
	function insert_holiday_hotel($ex_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$hotel_name = $this->input->post('hotel_name');
			$hotel_city = $this->input->post('hotel_city');
			$type = $this->input->post('type');
			$duration = $this->input->post('duration');
			$duration_hours = $this->input->post('duration_hours');
			$star_rate = $this->input->post('star_rate');
			$meal_plan = $this->input->post('meal_plan');
			$hotel_facility = $this->input->post('hotel_facility');
			$hotel_id = $this->Home_Model->insert_holiday_hotel($ex_id,$hotel_name,$hotel_city,$duration,$duration_hours,$star_rate,$meal_plan,$hotel_facility,$type);
			$cont = count($_FILES['banner']['name']);
			for($i=0;$i<$cont;$i++)
				{
				  if(isset($_FILES['banner']['name'][$i])!='' && $_FILES['banner']['type'][$i]=='image/jpeg' || $_FILES['banner']['type'][$i]=='image/jpg' || $_FILES['banner']['type'][$i]=='image/gif' || $_FILES['banner']['type'][$i]=='image/png')
				  {         
						$file=$_FILES['banner']['name'][$i];             
						copy($_FILES['banner']['tmp_name'][$i],"excursionimages/$file");
						$ext = end(explode('.',$file));
						$date=date('ymdhis');
						$img_banner="ex".$date.".".$ext;
						rename('excursionimages/'.$file,'excursionimages/'.$img_banner);            
				  }
				 
		     	 else
		     	 {
		           $img_banner = '';
		      	 }
			  	$this->Home_Model->add_banner_holidayhotel($img_banner,$hotel_id,$ex_id);	
			}
			redirect('admin/list_holiday_hotels/'.$ex_id,'refresh');
		}
		else
		{
		 redirect('admin','refresh');	
		}
	}
	function list_holiday_hotels($ex_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['ex_id'] = $ex_id;
			$admin_id = $this->session->userdata('admin_id');	
			$data['ex_det'] = $this->Home_Model->get_excursion_det($ex_id);
			$data['hotels'] = $this->Home_Model->get_holiday_hotels($ex_id);
			$this->load->view('holiday/list_holiday_hotels',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function delete_holiday_hotel($id,$ex_id)
	{
		$this->db->where('id',$id);
		$this->db->delete('holiday_hotel');
		redirect('admin/list_holiday_hotels/'.$ex_id,'refresh');
	}
	function delete_holiday_destination($id,$ex_id)
	{
		$this->db->where('id',$id);
		$this->db->delete('holiday_destination');
		redirect('admin/list_holiday_destination/'.$ex_id,'refresh');
	}
	function add_holiday_destination($ex_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['ex_id'] = $ex_id;
			$admin_id = $this->session->userdata('admin_id');	
			$this->load->view('holiday/add_holiday_destination',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
			
	}
	function insert_holiday_destination($ex_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$destination_name = $this->input->post('destination_name');
			$destination_det = $this->input->post('destination_det');
			$dest_id = $this->Home_Model->insert_holiday_destination($ex_id,$destination_name,$destination_det);
			$cont = count($_FILES['banner']['name']);
			for($i=0;$i<$cont;$i++)
				{
				  if(isset($_FILES['banner']['name'][$i])!='' && $_FILES['banner']['type'][$i]=='image/jpeg' || $_FILES['banner']['type'][$i]=='image/jpg' || $_FILES['banner']['type'][$i]=='image/gif' || $_FILES['banner']['type'][$i]=='image/png')
				  {         
						$file=$_FILES['banner']['name'][$i];             
						copy($_FILES['banner']['tmp_name'][$i],"excursionimages/$file");
						$ext = end(explode('.',$file));
						$date=date('ymdhis');
						$img_banner="ex".$date.".".$ext;
						rename('excursionimages/'.$file,'excursionimages/'.$img_banner);            
				  }
				 
		     	 else
		     	 {
		           $img_banner = '';
		      	 }
			  	$this->Home_Model->add_banner_holidaydest($img_banner,$dest_id,$ex_id);	
			}
			redirect('admin/list_holiday_destination/'.$ex_id,'refresh');
		}
		else
		{
		 redirect('admin','refresh');	
		}
	}
	
	function list_holiday_destination($ex_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['ex_id'] = $ex_id;
			$admin_id = $this->session->userdata('admin_id');	
			$data['ex_det'] = $this->Home_Model->get_excursion_det($ex_id);
			$data['dest'] = $this->Home_Model->get_holiday_dest($ex_id);
			$this->load->view('holiday/list_holiday_destination',$data);
			$this->load->view('footer');
		}
		else
		{
			 redirect('admin','refresh');
		}
	}
	function delete_gallery_pic($id,$ex_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->Home_Model->delete_gallery_pic($id);
			redirect('admin/edi_excursion/'.$ex_id,'refresh');
		}
		else
		{
			 redirect('admin', 'refresh');
		}
	}
	function update_excursion($excursion_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			
			$ex_type = $this->input->post('pack_type');
			$ex_location = $this->input->post('city');
			$country1  = explode(',',$ex_location);
			$country = $country1[1];
			$ex_name = $this->input->post('activity_name');
			$ex_duration = $this->input->post('duration');
			$ex_details = $this->input->post('ex_details');
			$ex_price = $this->input->post('price');
			$ex_product_code = $this->input->post('product_code');
			$ex_video = $this->input->post('video');
			$ex_shedule_details = $this->input->post('shedule_details');
			$ex_price_infant = $this->input->post('price_infant');
			$ex_price_child = $this->input->post('price_child');
			$ex_price_adult = $this->input->post('price_adult');
			$ex_price_includes = $this->input->post('price_includes');
			$ex_price_includes2 = $this->input->post('price_includes2');
			$ex_price_includes3 = $this->input->post('price_includes3');
			$ex_price_includes4 = $this->input->post('price_includes4');
			$ex_price_includes5 = $this->input->post('price_includes5');
			$ex_price_includes6 = $this->input->post('price_includes6');
			$ex_price_includes7 = $this->input->post('price_includes7');
			$ex_price_includes8 = $this->input->post('price_includes8');
			$ex_price_includes9 = $this->input->post('price_includes9');
			$ex_price_includes_chk = $this->input->post('price_includes_chk');
			$ex_price_includes_chk2 = $this->input->post('price_includes_chk2');
			$ex_price_includes_chk3 = $this->input->post('price_includes_chk3');
			$ex_price_includes_chk4 = $this->input->post('price_includes_chk4');
			$ex_price_includes_chk5 = $this->input->post('price_includes_chk5');
			$ex_price_includes_chk6 = $this->input->post('price_includes_chk6');
			$ex_price_includes_chk7 = $this->input->post('price_includes_chk7');
			$ex_price_includes_chk8 = $this->input->post('price_includes_chk8');
			$ex_price_includes_chk9 = $this->input->post('price_includes_chk9');
			$ex_price_excludes = $this->input->post('price_excludes');
			$ex_additional_details = $this->input->post('additional_details');
			$ex_more_det = $this->input->post('more_det');
			$ex_diving = $this->input->post('diving');
			$ex_surfing = $this->input->post('surfing');
			$cancel_policy = $this->input->post('cancel_policy');
			$term_cond = $this->input->post('term_cond');
			if(isset($_FILES['image']['name'])!='' && $_FILES['image']['type']=='image/jpeg' || $_FILES['image']['type']=='image/jpg' || $_FILES['image']['type']=='image/gif' || $_FILES['image']['type']=='image/png')
		      {         
		            $file=$_FILES['image']['name'];             
		        	copy($_FILES['image']['tmp_name'],"excursionimages/$file");
		        	$ext = end(explode('.',$file));
		       		$date=date('ymdhis');
		        	$img1="ex".$date.".".$ext;
		        	rename('excursionimages/'.$file,'excursionimages/'.$img1);            
		      }
		      else
		      {
		           $img1 = $this->input->post('excursion_image');
		      }
			  if(isset($_FILES['banner']['name'])!='' && $_FILES['banner']['type']=='image/jpeg' || $_FILES['banner']['type']=='image/jpg' || $_FILES['banner']['type']=='image/gif' || $_FILES['banner']['type']=='image/png')
		      {         
		            $file=$_FILES['banner']['name'];             
		        	copy($_FILES['banner']['tmp_name'],"excursionimages/$file");
		        	$ext = end(explode('.',$file));
		       		$date=date('ymdhis');
		        	$img_banner="ex".$date.".".$ext;
		        	rename('excursionimages/'.$file,'excursionimages/'.$img_banner);            
		      }
		      else
		      {
		           $img_banner = $this->input->post('banner_image');
		      }
			  
			  
			 $this->Home_Model->update_excursion($ex_type,$excursion_id,$ex_location,$ex_name,$ex_duration,$ex_details,$ex_price,$ex_product_code,$ex_video,$ex_shedule_details,$ex_price_infant,$ex_price_child,$ex_price_adult,$ex_price_includes, $ex_price_includes2, $ex_price_includes3, $ex_price_includes4, $ex_price_includes5, $ex_price_includes6, $ex_price_includes7, $ex_price_includes8, $ex_price_includes9, $ex_price_includes_chk, $ex_price_includes_chk2, $ex_price_includes_chk3, $ex_price_includes_chk4, $ex_price_includes_chk5, $ex_price_includes_chk6, $ex_price_includes_chk7, $ex_price_includes_chk8, $ex_price_includes_chk9,$ex_price_excludes,$ex_additional_details,$ex_more_det,$img1,$img_banner,$ex_diving,$ex_surfing,$country,$cancel_policy,$term_cond);
			 
			 
			  $cnt = count($_FILES['new_image']['name']);
			//echo '<pre>'; print_r($_FILES['new_image']['name']);exit;
			for($i=0;$i<$cnt;$i++)
			{
				//echo $_FILES['new_image']['name'][$i];
			if(isset($_FILES['new_image']['name'][$i])!='' && $_FILES['new_image']['type'][$i]=='image/jpeg' || $_FILES['new_image']['type'][$i]=='image/jpg' || $_FILES['new_image']['type'][$i]=='image/gif' || $_FILES['new_image']['type'][$i]=='image/png')
			  {         
			    $file=$_FILES['new_image']['name'][$i];
				copy($_FILES['new_image']['tmp_name'][$i],"excursionimages/$file");
				$gal=$file;
				rename('excursionimages/'.$file,'excursionimages/'.$gal);	
				if($file != '')
				{
					$title = explode('.',$file);
					$this->Home_Model->add_new_photo($gal,$title[0],$excursion_id);
				}
				else
				{
					
				}
				//$title = explode('.',$file);
				
				
			  }
		    else
		  		{
					$gal='';	
					
		  		}
					
			}
			 
			redirect('admin/edi_excursion/'.$excursion_id,'refresh');
		}
		else
		{
			 redirect('admin', 'refresh');
		}
	}
	function notice_board($id)
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['id'] = $id;
			$data['notice_list'] = $this->Home_Model->get_notice($id);
			$this->load->view('header');
			$this->load->view('cms/notice_board',$data);
			$this->load->view('footer');
		}
		else
		{	
			redirect('admin','refresh');
		}
		
	}
	function add_notice()
	{
		if($this->session->userdata('admin_id')!='')
		{	
			$data['id'] = $id = $this->input->post('id');
			$data['notice_title'] = $notice_title = $this->input->post('notice_title');
			$data['notice_content'] = $notice_content = $this->input->post('notice_content');
			if(isset($_FILES['notice_image']['name'])!='' && $_FILES['notice_image']['type']=='image/jpeg' || $_FILES['notice_image']['type']=='image/jpg' || $_FILES['notice_image']['type']=='image/gif' || $_FILES['notice_image']['type']=='image/png')
		      {         
		            $file=$_FILES['notice_image']['name'];             
		        	copy($_FILES['notice_image']['tmp_name'],"excursionimages/$file");
		        	$ext = end(explode('.',$file));
		       		$date=date('ymdhis');
		        	$img_banner="notice".$date.".".$ext;
		        	rename('excursionimages/'.$file,'excursionimages/'.$img_banner);    
					       
		      }
		      else
		      {
		           $img_banner = $this->input->post('banner_image');
		      }
			 $this->Home_Model->add_notice($notice_title, $notice_content, $img_banner, $id); 
			 redirect('admin/notice_board/'.$id,'refresh');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function view_account_summary($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['id'] = $id;
			$data['acc_det'] = $this->Home_Model->franchise_acc_det($id);
			$data['deposite_list'] = $this->Home_Model->get_deposited_franchise($id);
			$this->load->view('franchise_acc_summ',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function update_franchise_acc()
		{
			if($this->session->userdata('admin_id')!='')
			{
				$data['id'] = $id = $this->input->post('id');
				$amount_deposited = $this->input->post('amount_deposited');
				$current_limit = $this->input->post('current_limit');
				$deposit_date = $this->input->post('deposit_date');
				$dt = explode("/", $deposit_date);
				$newdate = $dt[2].'-'.$dt[1].'-'.$dt[0];
				$mode_deposit = $this->input->post('mode_deposit');
				$bank_name = $this->input->post('bank_name');
				$branch_name = $this->input->post('branch_name');
				$city = $this->input->post('city');
				$remarks = $this->input->post('remarks');
				$transaction_id = $this->input->post('transaction_id');
				
				$cheque_no = $this->input->post('cheque_no');
				//echo "<pre>"; print_r($this->input->post());exit;
				if(!$cheque_no)
				{
					$this->Home_Model->add_franchise_deposit($id,$amount_deposited,$current_limit,$newdate,$mode_deposit,$bank_name,$branch_name,$city,$remarks,$transaction_id);
				}
				else
				{
					$cheque_date1 = $this->input->post('cheque_date');
					$dt1 = explode("/", $cheque_date1);
					$cheque_date = $dt1[2].'-'.$dt1[1].'-'.$dt1[0];
					$this->Home_Model->add_franchise_deposit_chque($id,$amount_deposited,$current_limit,$newdate,$mode_deposit,$bank_name,$branch_name,$city,$remarks,$transaction_id,$cheque_no,$cheque_date );
				}
				
				redirect('admin/view_account_summary_updated/'.$id,'refresh');
			}
			else
			{
				redirect('admin','refresh');
			}
		
	}
	function view_account_summary_updated($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['id'] = $id;
			$data['acc_det'] = $this->Home_Model->franchise_acc_det($id);
			$data['deposite_list'] = $this->Home_Model->get_deposited_franchise($id);
			$data['message'] = "Your Account will be credited shortly..!";
			$this->load->view('franchise_acc_summ',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function change_deposite_status($id,$status,$franchise_id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['id'] = $id;
			if($status == 'active')
			{
				$stat = 'inactive';
				$this->Home_Model->change_deposited_status_franchise($id,$stat);
			}
			else
			{
				$stat = 'active';
				$this->Home_Model->change_deposited_status_franchise($id,$stat);
			}
			redirect('admin/deposite_status_updated/'.$franchise_id,'refresh');
			
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function deposite_status_updated($id)
	{
		//echo $id;exit;
		if($this->session->userdata('admin_id')!='')
		{
			$data['id'] = $id;
			$data['acc_det'] = $this->Home_Model->franchise_acc_det($id);
			$data['deposite_list'] = $this->Home_Model->get_deposited_franchise($id);
			
			$data['message'] = "Your Status has been updated..!";
			$this->load->view('franchise_acc_summ',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function member_credit_limit()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['agent'] = $this->Home_Model->get_agents();
			$this->load->view('header');
			$this->load->view('member_credit_limit',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function get_agent_detai()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('user');
			$data['agent'] = $this->Home_Model->get_agents_det($id);
			$this->load->view('header');
			$this->load->view('member_credit_limit_det',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function update_member_crdit()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('id');
			$account_balance = $this->input->post('account_balance');
			$remarks = $this->input->post('remarks');
			$amount = $this->input->post('amount');
			$update_limit = $this->input->post('update_limit');
			if($update_limit == 'Add')
			{
				$balance = $account_balance + $amount;
			}
			if($update_limit == 'Reduce')
			{
				$balance = $account_balance - $amount;
			}
			$this->Home_Model->update_member_crdit($id,$balance,$remarks,$amount);
			redirect('admin/member_credit_limit','refresh');
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function member_credit_det()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['agent'] = $this->Home_Model->get_agents();
			$this->load->view('header');
			$this->load->view('member_credit_det',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function offline_bus()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['bus'] = $this->Home_Model->bus_requests();
			$this->load->view('header');
			$this->load->view('offline_bus',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function offline_offer()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['bus'] = $this->Home_Model->offline_requests();
			$this->load->view('header');
			$this->load->view('offline_offer',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function offline_flight()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['bus'] = $this->Home_Model->flight_requests();
			$this->load->view('header');
			$this->load->view('offline_flight',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function offline_hotel()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['bus'] = $this->Home_Model->hotel_requests();
			$this->load->view('header');
			$this->load->view('offline_hotel',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function offline_package()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['bus'] = $this->Home_Model->holidays_requests();
			$this->load->view('header');
			$this->load->view('offline_package',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function news_management()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['news'] = $this->Home_Model->news_management();
			$this->load->view('header');
			$this->load->view('news_management',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_news()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('header');
			$this->load->view('add_news');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function insert_news()
	{
		$news_for = $this->input->post('news_for');
		$show_at = $this->input->post('show_at');
		$news_title = $this->input->post('news_title');
		$message = $this->input->post('message');
		$this->Home_Model->insert_news($news_for,$show_at,$news_title,$message);
		redirect('admin/news_management','refresh');
	}
	function edit_news($id)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['id'] = $id;
			$data['news'] = $this->Home_Model->get_news_det($id);
			$this->load->view('header');
			$this->load->view('edit_news',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function update_news($id)
	{
		$news_for = $this->input->post('news_for');
		$show_at = $this->input->post('show_at');
		$news_title = $this->input->post('news_title');
		$message = $this->input->post('message');
		$this->Home_Model->update_news($id,$news_for,$show_at,$news_title,$message);
		redirect('admin/news_management','refresh');
	}
	function delete_news($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('news_management');
		redirect('admin/news_management','refresh');
	}
	function service_management()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['agent'] = $this->Home_Model->get_agents();
			$this->load->view('header');
			$this->load->view('service_management',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function get_agent_detai2()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$id = $this->input->post('user');
			$data['agent'] = $this->Home_Model->get_agents_det($id);
			$this->load->view('header');
			$this->load->view('service_management_add',$data);
		}
		else
		{	
			redirect('admin','refresh');
		}
	}
	function update_member_services()
	{
		$id = $this->input->post('id');
		$flight = $this->input->post('flight');
		$hotel = $this->input->post('hotel');
		$bus = $this->input->post('bus');
		$holidays = $this->input->post('holidays');
		$this->Home_Model->update_member_service($id,$flight,$hotel,$bus,$holidays); 
		$data['agent'] = $this->Home_Model->get_agents_det($id);
		$this->load->view('header');
		$this->load->view('service_management_add',$data);
	}
	function hoteloffers()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['bus'] = $this->Home_Model->hotel_requests();
			$this->load->view('header');
			$this->load->view('hoteloffers',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function selct_hotel($hotel_list_id,$status)
	{
		$this->Home_Model->insert_selected_hotel($hotel_list_id,$status);
		redirect('admin/hoteloffers','refresh');
	}
	function pagemanament()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('header');
			$this->load->view('pagemanament');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function cms($val)
	{
		if($this->session->userdata('admin_id')!='')
		{
			$contects = $this->Home_Model->get_cms();
			if($val == '1')
			{
				$data['page_name'] = "Why Us";
				$data['content'] = $contects->whyus;
			}
			if($val == '2')
			{
				$data['page_name'] = "About Us";
				$data['content'] = $contects->aboutus;
			}
			if($val == '3')
			{
				$data['page_name'] = "Contact Us";
				$data['content'] = $contects->contactus;
			}
			if($val == '4')
			{
				$data['page_name'] = "FAQ";
				$data['content'] = $contects->faq;
			}
			if($val == '5')
			{
				$data['page_name'] = "Terms & Conditions";
				$data['content'] = $contects->terms;
			}
			if($val == '6')
			{
				$data['page_name'] = "Privacy Policy";
				$data['content'] = $contects->privacy;
			}
			if($val == '7')
			{
				$data['page_name'] = "Feedback";
				$data['content'] = $contects->feedback;
			}
			$data['val'] = $val; 
			$this->load->view('header');
			$this->load->view('cms',$data);
			
		}
		else
		{
			redirect('admin','refresh');
		}	
	}
	function cms_agent()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['contects'] = $this->Home_Model->get_cms();
			$this->load->view('header');
			$this->load->view('cms_agent',$data);
		}
		else
		{
			redirect('admin','refresh');
		}	
	}
	function cms_update($val)
	{
		$content = $this->input->post('content');
		$this->Home_Model->cms_update($val,$content);
		redirect('admin/pagemanament','refresh');
	}
	function cms_update_agent()
	{
		$agent_moreprofit = $this->input->post('agent_moreprofit');
		$agent_ontarget = $this->input->post('agent_ontarget');
		$agent_customersupport = $this->input->post('agent_customersupport');
		$this->Home_Model->cms_update_agent($agent_moreprofit,$agent_ontarget,$agent_customersupport);
		redirect('admin/pagemanament','refresh');
	}
	function hotel_page_offers()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['offers'] = $this->Home_Model->get_list_hoteloffers();
			$data['hotels_inter'] = $this->Home_Model->hotel_page_offers();
			$data['hotels_domestic'] = $this->Home_Model->hotel_page_offers2();
			$this->load->view('header');
			$this->load->view('hotel_page_offers',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function hotel_offers_add()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$inter1 = $this->input->post('inter1');
			$inter2 = $this->input->post('inter2');
			$inter3 = $this->input->post('inter3');
			$dom1 = $this->input->post('dom1');
			$dom2 = $this->input->post('dom2');
			$dom3 = $this->input->post('dom3');
			$this->Home_Model->hotel_offers_add($inter1,$inter2,$inter3,$dom1,$dom2,$dom3);
			redirect('admin/list_hoteloffers','refresh');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function list_hoteloffers()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['hotels'] = $this->Home_Model->get_list_hoteloffers();
			$this->load->view('header');
			$this->load->view('list_hoteloffers',$data);
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function add_supplier()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['country'] = $country = $this->Supplier_Model->get_country();
			$data['language'] = $language = $this->Supplier_Model->get_language();
			$this->load->view('header');
			$this->load->view('supplier/add_supplier',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function insert_supplier()
	{
		$country = $this->input->post('country');
		$city = $this->input->post('city');
		$appt_name = $this->input->post('appt_name');
		$language = $this->input->post('language');
		$gen_sal = $this->input->post('gen_sal');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$passd = $this->input->post('passd');
		//$prop_name = $this->input->post('prop_name');
		$prop_name = '';
		$res = $this->Supplier_Model->get_sup_emails();
		$ins_id = $this->Supplier_Model->add_supplier($country,$city,$appt_name,$language,$gen_sal,$fname,$lname,$email,$passd,$prop_name);
		redirect('admin/view_suppliers','refresh');
	}
	function holiday_reports()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('holiday/booking_list');
		}
		else
		{
			redirect('admin','refresh');
		}
	}
	function super_admin()
	{
		$data['error'] = '';
		$this->load->view('superadmin/login');
	}
	function super_login_check()
	{
	     if($this->input->post('username_admin'))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$admin_username = $this->input->post('username_admin');
			$admin_password = $this->input->post('password_admin');
			$res = $this->Home_Model->super_login_check_db($admin_username,$admin_password);
			if($res)
			{
				foreach($res as $row)
				{
					$_SESSION['super_admin'] = $admin_username;
					$this->session->set_userdata(array('super_admin'=>$admin_username));	
					$this->session->set_userdata(array('super_admin_id'=>$row->id));	
					$_SESSION['super_admin']='admin';	 
				}
				redirect('admin/super_dashboard');
			}
			else
			{
				$data['error']="invalid login details";
				redirect('admin/super_admin','refresh');
			}
			
		}
		else
		{
	
				redirect('admin/super_admin','refresh');
		}
	}
	function super_dashboard()
	{
		if($this->session->userdata('super_admin_id')!='')
		{	 
			$this->load->view('superadmin/dashboard');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function super_logout()
	{
		$this->session->sess_destroy();
		redirect('admin/super_admin', 'refresh');
	}
	function add_admin()
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$data['country'] =$country= $this->Home_Model->get_country();
			$this->load->view('superadmin/add_admin',$data);
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function insert_admin()
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$postalcode = $this->input->post('postalcode');
			$userf_name = $this->input->post('userf_name');
			$userl_name = $this->input->post('userl_name');
			$position = $this->input->post('position');
			$email = $this->input->post('email');
			$office_no = $this->input->post('office_no');
			$mob_phn = $this->input->post('mob_phn');
			$nation = $this->input->post('nation');
			$admin_id = $this->Home_Model->insert_admin($username,$password,$country,$city,$postalcode,$userf_name,$userl_name,$position,$email,$office_no,$mob_phn,$nation);
			$this->Home_Model->insert_access_id($admin_id);
			redirect('admin/admin_list','refresh');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function admin_list()
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$data['users'] = $this->Home_Model->admin_list();
			$this->load->view('superadmin/header');
			$this->load->view('superadmin/admin_list',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function edit_admin($id)
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$data['user'] = $this->Home_Model->admin_det($id);
			$data['country'] =$country= $this->Home_Model->get_country();
			$this->load->view('superadmin/edit_admin',$data);
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function update_admin($id)
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$postalcode = $this->input->post('postalcode');
			$userf_name = $this->input->post('userf_name');
			$userl_name = $this->input->post('userl_name');
			$position = $this->input->post('position');
			$email = $this->input->post('email');
			$office_no = $this->input->post('office_no');
			$mob_phn = $this->input->post('mob_phn');
			$nation = $this->input->post('nation');
			$this->Home_Model->update_admin($id,$username,$password,$country,$city,$postalcode,$userf_name,$userl_name,$position,$email,$office_no,$mob_phn,$nation);
			redirect('admin/admin_list','refresh');
			
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function admin_status($status,$id)
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			if($status =='0')
			{
				$status ='1';	
			}
			else
			{
				$status ='0';
			}
			$this->Home_Model->admin_status($status,$id);
			redirect('admin/admin_list','refresh');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function delete_admin($id)
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$this->db->where('admin_id',$id);
			$this->db->delete('admin_new');
			redirect('admin/admin_list','refresh');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function admin_access()
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$data['users'] = $this->Home_Model->admin_list();
			$this->load->view('superadmin/header');
			$this->load->view('superadmin/admin_access',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function insert_admin_access()
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$admin_id = $this->input->post('admin_id');
			
			$supplier = $this->input->post('supplier');
			$agent = $this->input->post('agent');
			$slider_image = $this->input->post('slider_image');
			$holidays = $this->input->post('holidays');
			$Markup = $this->input->post('Markup');
			$member_credit = $this->input->post('member_credit');
			$changepassword = $this->input->post('changepassword');
			$offlinebus = $this->input->post('offlinebus');
			$offlineflight = $this->input->post('offlineflight');
			$offlineoffer = $this->input->post('offlineoffer');
			$offlinehotel = $this->input->post('offlinehotel');
			$offlineholiday = $this->input->post('offlineholiday');
			$news_management = $this->input->post('news_management');
			$imagemanagement = $this->input->post('imagemanagement');
			$B2C_report = $this->input->post('B2C_report');
			$B2B_report = $this->input->post('B2B_report');
			$service_managemnt = $this->input->post('service_managemnt');
			$page_management = $this->input->post('page_management');
			$user_managemnt = $this->input->post('user_managemnt');
			$banner_images = $this->input->post('banner_images');
			$mail_agent = $this->input->post('mail_agent');
			$lbs_flight = $this->input->post('lbs_flight');
			$this->Home_Model->insert_admin_access($admin_id,$supplier,$agent,$slider_image,$holidays,$Markup,$member_credit,$changepassword,$offlinebus,$offlineflight,$offlineoffer,$offlinehotel,$offlineholiday,$news_management,$imagemanagement,$B2C_report,$B2B_report,$service_managemnt,$page_management,$user_managemnt,$banner_images,$mail_agent,$lbs_flight);
			redirect('admin/admin_accessupdated/'.$admin_id,'refresh');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function admin_accessupdated($admin_id)
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$data['access_det'] = $this->Home_Model->access_details($admin_id);
			$data['users'] = $this->Home_Model->admin_det($admin_id);
			$this->load->view('superadmin/header');
			$this->load->view('superadmin/admin_accessupdated',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function mail_admin()
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$this->load->view('superadmin/header');
			$this->load->view('superadmin/mail_admin');
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function send_mail_super()
	{
		if($this->session->userdata('super_admin_id')!='')
		{
			$msg_heder = $this->input->post('msg_heder');
			$mail_con = $this->input->post('mail_con');
			$this->load->view('superadmin/header');
			$this->load->view('superadmin/mail_admin');
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/super_admin','refresh');
		}
	}
	function mail_agent()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('header');
			$this->load->view('mail_agent');
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/index','refresh');
		}
	}
	function lbs_flight()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$data['flight'] = $this->Home_Model->lbs_flight();
			$this->load->view('header');
			$this->load->view('lbs_flight',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/index','refresh');
		}
	}
	function agent_search()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$this->load->view('header');
			$this->load->view('agent_search');
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/index','refresh');
		}
	}
	function get_agents()
	{
		if($this->session->userdata('admin_id')!='')
		{
			$agent_name = $this->input->post('agent_name');
			$agent_id = $this->input->post('agent_id');
			$cell_no = $this->input->post('cell_no');
			$email_id = $this->input->post('email_id');
			$data['list_agent']=$this->Home_Model->get_agents_search($agent_id,$agent_name,$cell_no,$email_id);
			$this->load->view('header');
			$this->load->view('list_agents',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('admin/index','refresh');
		}
	}
	
}?>
