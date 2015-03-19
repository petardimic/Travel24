<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * MyBookingSystem - Gta Api Model
 *  
 *
 * @package		MyBookingSystem
 * @author		Khadharvalli
 * @copyright	Copyright (c) 2013 - 2014, Provabtechnosoft Pvt. Ltd.
 * @license		http://www.mybookingsystem.com/support/license-agreement
 * @link		http://www.mybookingsystem.com
 * 
 */

class Expedia_Model extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }

    public function getApiAuthDetails($api)
    {
        $this->db->select('*');
        $this->db->from('apimanagement');
        $this->db->where('apiname', $api);
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';
        }
        else
        {
           return $query->row();
        }
    }
    
    function get_currecy_details($currency)
    {
        $que="select * from  currency_converter where country='$currency' ";
        $query= $this->db->query($que);
        if($query->num_rows() =='')
        {
           return '';
        }
        else
        {
           return $query->row();
        }	
    }
    
    function fetch_search_result($session_id,$api)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$session_id);
        $this->db->where('api',$api);
        $this->db->group_by('hotelId');
        $this->db->order_by('total','ASC');

        $query = $this->db->get();

        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
    
    function getRoomAvaibilityData($hotelcode,$sessId)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_room_detail_t');
        $this->db->where('session_id',$sessId);
        $this->db->where('hotel_code',$hotelcode);
        $this->db->order_by('total','ASC');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
    
    function getHotelDetailsOnCode($hotelCode,$sessionId)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_detail_t');
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotelId',$hotelCode);
        $this->db->where('api','expedia');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
    }
    
    function getRoomDetailsOnCode($hotelCode,$roomCode,$sessionId)
    {
        $this->db->select('*');
        $this->db->from('api_hotel_room_detail_t');
        $this->db->where('session_id',$sessionId);
        $this->db->where('hotel_code',$hotelCode);
        $this->db->where('roomTypeCode',$roomCode);
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->row(); 			
        }
    }
    
    function getExpediaCountryList()
    {
        $this->db->select('*');
        $this->db->from('expedia_country_list');
        $this->db->order_by('NAME','ASC');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
    
    function getExpediaStateListOnCountry($country)
    {
        $this->db->select('*');
        $this->db->from('expedia_state_list');
        $this->db->where('CountryCode',$country);
        $this->db->order_by('StateName','ASC');
        $query = $this->db->get();
        if($query->num_rows() == 0 )
        {
           return '';   
        }
        else
        {
            return $query->result(); 			
        }
    }
    
    function insertExpediaBookingDetails($data)
    {
        $this->db->insert('transection_details',$data);
        return $this->db->insert_id();
    }
    
    function insertBookingPaxDetails($data)
    {
        $this->db->insert('booking_passenger_information',$data);
    }
    
    function insertBookingUserDetails($bookerInfo)
    {
         $this->db->insert('customer_contact_details',$bookerInfo);
    }
    
    function getPropertyTypeOnID($id)
    {
        $query=$this->db->query($sql="select PropertyCategoryDesc from expedia_property_type_list where PropertyCategory='".$id."'");
        if($query->num_rows() > 0)
        {
            $res=$query->row();
            return $res->PropertyCategoryDesc;
        }
        else return '';
    }
	function check_promo_code($promo_code,$total_amount,$departure_date,$return_date)
	{
		$query=$this->db->query($sql="select * from promocodes WHERE promo_code='".$promo_code."' AND max_amount < '".$total_amount."' AND valid_From < '".$departure_date."' AND valid_to > '".$departure_date."' AND status = 'Active'");
		//AND max_amount < '".$total_amount."' AND valid_From > '".$departure_date."' AND valid_to < '".$return_date."' AND status = 'Active'
		//echo $sql; exit;
        if($query->num_rows() > 0)
        {
              $result=$query->row();
             return $result;
         }
           else return '';
	}
}

?>
