<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * MyBookingSystem
 *  
 *
 * @package		MyBookingSystem
 * @author		Khadharvalli
 * @copyright	Copyright (c) 2013 - 2014, Provabtechnosoft Pvt. Ltd.
 * @license		http://www.mybookingsystem.com/support/license-agreement
 * @link		http://www.mybookingsystem.com
 * 
 */

class Home_Model extends CI_Model {
    public function getHotelsCityData($cityName)
    {
        $this->db->select('Destination');
        $this->db->select('Country');
        $this->db->select('DestinationID');
        $this->db->from('expedia_destination_list');
        $this->db->like('Destination',$cityName,'after');
		$this->db->group_by('Destination');
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();           
        }
        else
        {
            return '';
        }
        
    }
    
    public function getAllNationalityCodes()
    {
        $this->db->select('*');
        $this->db->from('nationality_codes');
        $this->db->order_by('country_name','asc');
        $query=$this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else return '';
    }
    
    public function getPackageCountries()
	{
		$this->db->select('*');
        $this->db->from('country');
        $this->db->order_by('name','asc');
        $query=$this->db->get();
        
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else 
        {	
			return '';
		}	
	}
	
	public function getPackagesByCountry($id)
	{
		$this->db->select('*');
        $this->db->from('holiday_package');
        $this->db->where('country_id',$id);
        $this->db->order_by('package_name','asc');
        $query=$this->db->get();
        
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else 
        {	
			return '';
		}
	}
	
	public function getDurations()
	{
		$this->db->select('*');
        $this->db->from('durations');
        $this->db->order_by('id','asc');
        $query=$this->db->get();
        
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else 
        {	
			return '';
		}
	}
	function b2creginsert($first_name,$last_name,$email_id,$pwfield,$phone,$postalcode,$country,$city,$addresss,$akbar_ref)
	{
		$date = date('Y-m-d');
		$status = 'Inactive';
		$data = array('firstname'=>$first_name,'lastname'=>$last_name,'emailid'=>$email_id,'password'=>$pwfield,'mobile'=>$phone,'zip'=>$postalcode,'country'=>$country,'city'=>$city,'address'=>$addresss,'akbar_cus_id'=>$akbar_ref);
		$this->db->insert('master_customer',$data);
	}
	function b2clogincheck($email_id,$pass)
	{
			$this->db->select('*');
			$this->db->from('master_customer');
			$this->db->where('emailid',$email_id);
			$this->db->where('password',$pass);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
	}
	function getflightreports($val)
		{
			$this->db->select('*');
			$this->db->from('book_flight_tickets');
			$this->db->where('transid !=','');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function gethotelreports($val)
		{
			$this->db->select('*');
			$this->db->from('hotel_booking_info');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_transactiondet($id)
		{
			$this->db->select('*');
			$this->db->from('transaction_details');
			$this->db->where('hotel_booking_id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		function get_custdet($id)
		{
			$this->db->select('*');
			$this->db->from('customer_contact_details');
			$this->db->where('customer_info_details_id',$id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		function car_outstation_city()
		{
			$this->db->select('*');
			$this->db->from('wheels_outst_source');
			$this->db->order_by('city','asc');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function car_outstation_dest($source)
		{
			$this->db->select('*');
			$this->db->from('wheels_out_dest');
			$this->db->where('StateID',$source);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_durations()
		{
			$this->db->select('*');
			$this->db->from('wheels_out_days');
			$this->db->order_by('id','asc');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_local_city()
		{
			$this->db->select('*');
			$this->db->from('wheels_local_source');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
				}else{
					return $query->result();
				}
		}

/*............. CMS Begins......  */

		function get_carDeals()
		{
			$this->db->select('*');
			$this->db->from('cms_car_deals');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(4);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_businessFares()
		{
			$this->db->select('*');
			$this->db->from('cms_buisiness_fares');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(5);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_from_city($citycode)
		{
			$this->db->select('*');
			$this->db->from('city_code_amadeus');
			$this->db->like('city_code',$citycode);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->row();
			}
		}
		function get_hotelDeals()
		{
			$this->db->select('*');
			$this->db->from('cms_hotel_deals');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(4);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_middle_east_flights()
		{
			$this->db->select('*');
			$this->db->from('cms_cheap_flights');
			$this->db->where('destination','Middle East');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(4);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_europe_flights()
		{
			$this->db->select('*');
			$this->db->from('cms_cheap_flights');
			$this->db->where('destination','Europe');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(4);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_india_flights()
		{
			$this->db->select('*');
			$this->db->from('cms_cheap_flights');
			$this->db->where('destination','India');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(4);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_far_east_flights()
		{
			$this->db->select('*');
			$this->db->from('cms_cheap_flights');
			$this->db->where('destination','Far East');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(4);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_americas_flights()
		{
			$this->db->select('*');
			$this->db->from('cms_cheap_flights');
			$this->db->where('destination','Americas');
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(4);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}


/*............. CMS Ends......  */
/*............. Banner Images Begins......  */
		function get_carsliderImages()
		{
			$location = array('generic','car');
			
			$this->db->select('*');
			$this->db->from('banner_images');
			$this->db->or_where_in('imageloca', $location);
			$this->db->where('image_subloca','Top');
			$this->db->where('status',1);
			$this->db->order_by('banner_id', 'RANDOM');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_fightsliderImages()
		{
			$location = array('generic','flight');
			
			$this->db->select('file_path');
			$this->db->from('banner_images');
			$this->db->or_where_in('imageloca', $location);
			$this->db->where('image_subloca','Top');
			$this->db->where('status',1);
			$this->db->order_by('banner_id', 'RANDOM');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_hotelsliderImages()
		{
			$location = array('generic','hotel');
			
			$this->db->select('*');
			$this->db->from('banner_images');
			$this->db->or_where_in('imageloca', $location);
			$this->db->where('image_subloca','Top');
			$this->db->where('status',1);
			$this->db->order_by('banner_id', 'RANDOM');
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_carmiddleBanner()
		{
			$location = array('generic','car');
			
			$this->db->select('*');
			$this->db->from('banner_images');
			$this->db->or_where_in('imageloca', $location);
			$this->db->where('image_subloca','Middle');
			$this->db->where('status',1);
			$this->db->order_by('banner_id', 'RANDOM');
			$this->db->limit(1);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
		function get_flightmiddleBanner()
		{
			$location = array('generic','flight');
			
			$this->db->select('*');
			$this->db->from('banner_images');
			$this->db->or_where_in('imageloca', $location);
			$this->db->where('image_subloca','Middle');
			$this->db->where('status',1);
			$this->db->order_by('banner_id', 'RANDOM');
			$this->db->limit(1);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}
		}
/*............. Banner Images Ends......  */
		function check_sub($email)
		{
			$this->db->select('*');
			$this->db->from('newsletters');
			$this->db->where('emailid',$email);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				$data = array('emailid'=>$email);				
				$this->db->insert('newsletters',$data);
				return 0;
			}else{
				return 1;
			}
		}
		function check_fwd($email)
		{
			$this->db->select('*');
			$this->db->from('master_customer');
			$this->db->where('emailid',$email);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return 0;
			}else{
				return 1;
			}
		}
		function check_fwd_pwd($email)
		{
			$this->db->select('*');
			$this->db->from('master_customer');
			$this->db->where('emailid',$email);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return 0;
			}else{
				$val = $query->row();
				return  $val;
			}
		}
		function recent_search()
		{
		    $que="select * from  flight_search_result GROUP BY fromcityval ORDER BY id desc LIMIT 0,5";
	        $query= $this->db->query($que);
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
 		}
 		function getcustomerdet($customer_id)
 		{
			$this->db->select('*');
			$this->db->from('master_customer');
			$this->db->where('id',$customer_id);
			$query=$this->db->get();
			if($query->num_rows() ==''){
				return 0;
			}else{
				$val = $query->row();
				return  $val;
			}
		}
		function get_airports()
 		{
			$que="select city,country,city_code from  city_code_amadeus WHERE country ='USA' ORDER BY city";
	        $query= $this->db->query($que);
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
		}
		function get_imp_airports()
 		{
			$que="select * from  important_airport where status = 1 ORDER BY imp_airport asc";
	        $query= $this->db->query($que);
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
		}
		
		
		
		/* Customer Section starts here*/
		function member_details($id)
 		{
			$this->db->select('*');
			$this->db->from('master_customer');
			$this->db->where('id',$id);
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->row();
        	}
		}
		function upcoming_mybookings($email_id)
		{
                    $date = date('Y-m-d');
			$this->db->select('*,amadeus_flight_book_passengers.creation_date as main_creation_date,amadeus_flight_book_passengers.PNR_Number as main_PNR_Number');
			$this->db->from('master_customer');
			$this->db->join('amadeus_flight_book_passengers', 'amadeus_flight_book_passengers.user_email = master_customer.emailid');
			$this->db->join('amadeus_flight_booking_details', 'amadeus_flight_booking_details.pnr_id = amadeus_flight_book_passengers.psg_id');
			$this->db->where('amadeus_flight_book_passengers.departure_date >=',$date);
                        //$this->db->limit('2');
                        $this->db->where('user_email',$email_id);
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
		}
		function ticket_details($id)
		{
			$this->db->select('*,amadeus_flight_book_passengers.PNR_Number as main_PNR_Number');
			$this->db->from('amadeus_flight_book_passengers');
			$this->db->join('amadeus_flight_paasengers', 'amadeus_flight_paasengers.pnr_id  = amadeus_flight_book_passengers.psg_id');
			$this->db->join('amadeus_flight_booking_details', 'amadeus_flight_booking_details.pnr_id = amadeus_flight_book_passengers.psg_id');
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->row();
        	}
		}
		/*function ticket_details2($id)
		{
			$this->db->select('*,amadeus_flight_book_passengers.PNR_Number as main_PNR_Number');
			$this->db->from('amadeus_flight_book_passengers');
			$this->db->join('amadeus_flight_paasengers', 'amadeus_flight_paasengers.pnr_id  = amadeus_flight_book_passengers.psg_id');
			$this->db->join('amadeus_flight_booking_details', 'amadeus_flight_booking_details.pnr_id = amadeus_flight_book_passengers.psg_id');
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->row();
        	}
		}*/
		function ticket_details2($id)
		{
			$this->db->select('*');
			$this->db->from('amadeus_flight_book_passengers');
			$this->db->where('psg_id',$id);
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->row();
        	}
		}
		function flight_details($id)
		{
			$this->db->select('*');
			$this->db->from('amadeus_flight_booking_details');
			$this->db->where('pnr_id',$id);
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->row();
        	}
		}
		function edit_myprofile($customer_id,$title,$firstname,$lastname,$address,$city,$state,$zip,$country,$off_num,$fax,$newsletter_signup,$smsalert_signup,$mobile,$alt_number,$address,$address2)
		{
			$data = array('title'=>$title,'firstname'=>$firstname,'lastname'=>$lastname,'address'=>$address,'city'=>$city,'state'=>$state,'zip'=>$zip,'country'=>$country,'off_num'=>$off_num,'fax'=>$fax,'signup_newsletter'=>$newsletter_signup,'signup_smsalert'=>$smsalert_signup,'mobile'=>$mobile,'alt_number'=>$alt_number,'address'=>$address,'address2'=>$address2);
			$this->db->where('id',$customer_id);
			$this->db->update('master_customer',$data);
		}
		function check_present_pwd($source)
		{
			$this->db->select('*');
			$this->db->from('master_customer');
			$this->db->where('password',$source);
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return 0;
        	}else{
                return 1;
        	}
		}
		function change_cust_pwd($pwd)
		{
			$customer_id = $this->session->userdata('customer_id');
			$data = array('password'=>$pwd);
			$this->where('id',$customer_id);
			$this->update('master_customer',$data);
		}
		function get_citycode_amedeous($id)
		{
			$this->db->select('*');
			$this->db->from('city_code_amadeus');
			$this->db->where('city_code',$id);
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                $val =  $query->row();
                return $val->city;
        	}
		}
		function flight_passenger_details($id)
		{
			$this->db->select('*');
			$this->db->from('amadeus_flight_paasengers');
			$this->db->where('pnr_id',$id);
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                $val =  $query->result();
                return $val;
        	}
		}
		function upcoming_mybookings_sort($email_id,$fromdate,$todate,$pnrno,$tripid)
		{
                    //echo $pnrno;die;
                   // echo $fromdate.'<<<>>'.$todate;die;
           $date = date('Y-m-d');
			$where="user_email='$email_id' ";
            if($fromdate!='' && $todate!='')
			{
                            if($where=='')
                            {
                            $where .=" amadeus_flight_book_passengers.departure_date >='$fromdate' AND amadeus_flight_book_passengers.departure_date <='$todate' ";
                            }
                            else
                            {
                                $where .=" AND amadeus_flight_book_passengers.departure_date >='$todate' AND amadeus_flight_book_passengers.departure_date <='$todate'";
                            }
                        }
                        else if($pnrno != '')
                        {
                            if($where=='')
                            {
                            $where .=" amadeus_flight_book_passengers.PNR_Number='$pnrno' ";
                            }
                            else
                            {
                                $where .=" AND amadeus_flight_book_passengers.PNR_Number='$pnrno'";
                            } 
                        }
                        else if($tripid != '')
                        {
                           if($where=='')
                            {
                                $where .=" amadeus_flight_book_passengers.booking_id='$tripid' ";
                            }
                            else
                            {
                                $where .=" AND amadeus_flight_book_passengers.booking_id='$tripid'";
                            } 
                        }
                        
                       
                       $query=$this->db->query($sql="SELECT *, `amadeus_flight_book_passengers`.`creation_date` as main_creation_date,
                                `amadeus_flight_book_passengers`.`PNR_Number` as main_PNR_Number FROM (`master_customer`) 
                               JOIN `amadeus_flight_book_passengers` ON `amadeus_flight_book_passengers`.`user_email` = `master_customer`.`emailid` 
                               JOIN `amadeus_flight_booking_details` ON `amadeus_flight_booking_details`.`pnr_id` = `amadeus_flight_book_passengers`.`psg_id` 
                               WHERE ".$where);
			//echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
		}
		function recent_mybookings_sort($email_id,$fromdate,$todate,$pnrno,$tripid)
		{
                        $date = date('Y-m-d');
//			$this->db->select('*,amadeus_flight_book_passengers.creation_date as main_creation_date,amadeus_flight_book_passengers.PNR_Number as main_PNR_Number');
//			$this->db->from('master_customer');
//			$this->db->join('amadeus_flight_book_passengers', 'amadeus_flight_book_passengers.user_email = master_customer.emailid');
//			$this->db->join('amadeus_flight_booking_details', 'amadeus_flight_booking_details.pnr_id = amadeus_flight_book_passengers.psg_id');
//			if($fromdate != '' || $todate != '' || $pnrno != '' || $tripid != '')
//			{
//				$this->db->or_where('amadeus_flight_book_passengers.departure_date >=',$fromdate);
//                                $this->db->or_where('amadeus_flight_book_passengers.departure_date <=',$todate);
//                                if($pnrno != '')
//                                {
//                                    $this->db->where('amadeus_flight_book_passengers.PNR_Number',$pnrno);
//                                }
//			}
//			else 
//			if($pnrno != '')
//			{
//				$this->db->or_like('amadeus_flight_book_passengers.PNR_Number',$pnrno);
//			}
//                        $this->db->where('amadeus_flight_book_passengers.departure_date <=',$date);
//			$query=$this->db->get();
//			echo $this->db->last_query();exit;
                        $where="user_email='$email_id' ";
                        if($fromdate!='' && $todate!='')
			{
                            if($where=='')
                            {
                            $where .=" amadeus_flight_book_passengers.departure_date >='$fromdate' AND amadeus_flight_book_passengers.departure_date <='$todate' ";
                            }
                            else
                            {
                                $where .=" AND amadeus_flight_book_passengers.departure_date >='$todate' AND amadeus_flight_book_passengers.departure_date <='$todate'";
                            }
                        }
                        else if($pnrno != '')
                        {
                           if($where=='')
                            {
                            $where .=" amadeus_flight_book_passengers.PNR_Number='$pnrno' ";
                            }
                            else
                            {
                                $where .=" AND amadeus_flight_book_passengers.PNR_Number='$pnrno'";
                            } 
                        }
                        else if($tripid != '')
                        {
                           if($where=='')
                            {
                                $where .=" amadeus_flight_book_passengers.booking_id='$tripid' ";
                            }
                            else
                            {
                                $where .=" AND amadeus_flight_book_passengers.booking_id='$tripid'";
                            } 
                        }
                        else $where.=" 1";
                       $query=$this->db->query($sql="SELECT *, `amadeus_flight_book_passengers`.`creation_date` as main_creation_date,
                                `amadeus_flight_book_passengers`.`PNR_Number` as main_PNR_Number FROM (`master_customer`) 
                               JOIN `amadeus_flight_book_passengers` ON `amadeus_flight_book_passengers`.`user_email` = `master_customer`.`emailid` 
                               JOIN `amadeus_flight_booking_details` ON `amadeus_flight_booking_details`.`pnr_id` = `amadeus_flight_book_passengers`.`psg_id` 
                               WHERE ".$where);
                        
                        
                        
                        
			if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
		}
		
		function recent_mybookings($email_id)
		{
             $date = date('Y-m-d');
			$this->db->select('*,amadeus_flight_book_passengers.creation_date as main_creation_date,amadeus_flight_book_passengers.PNR_Number as main_PNR_Number');
			$this->db->from('master_customer');
			$this->db->join('amadeus_flight_book_passengers', 'amadeus_flight_book_passengers.user_email = master_customer.emailid');
			$this->db->join('amadeus_flight_booking_details', 'amadeus_flight_booking_details.pnr_id = amadeus_flight_book_passengers.psg_id');
			$this->db->where('amadeus_flight_book_passengers.departure_date <=',$date);
                        $this->db->where('user_email',$email_id);
                        $query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                return $query->result();
        	}
		}
		/* Customer Section ends here*/
		function check_password($email)
		{
			$this->db->select('*');
			$this->db->from('master_customer');
			$this->db->where('emailid',$email);
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                $val =  $query->row();
                return $val;
        	}
		}
		function pickup_world()
		{
			$this->db->select('city_name');
			$this->db->from('car_city_int');
			$query=$this->db->get();
    	    if($query->num_rows() ==''){
                return '';
        	}else{
                $val =  $query->result();
                return $val;
        	}
		}
}

?>
