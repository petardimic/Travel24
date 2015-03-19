<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flights_Model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function auth($email, $password)
    {
        $this->db->where('user_email', $email);

        $query = $this->db->get('fi_users');

        if ($query->num_rows())
        {
            $user = $query->row();

            $this->load->library('crypt');

            /**
             * Password hashing changed after 1.2.0
             * Check to see if user has logged in since the password change
             */
            if (!$user->user_psalt)
            {
                /**
                 * The user has not logged in, so we're going to attempt to
                 * update their record with the updated hash
                 */
                if (md5($password) == $user->user_password)
                {
                    /**
                     * The md5 login validated - let's update this user 
                     * to the new hash
                     */
                    $salt = $this->crypt->salt();
                    $hash = $this->crypt->generate_password($password, $salt);

                    $db_array = array(
                        'user_psalt'    => $salt,
                        'user_password' => $hash
                    );

                    $this->db->where('user_id', $user->user_id);
                    $this->db->update('fi_users', $db_array);

                    $this->db->where('user_email', $email);
                    $user = $this->db->get('fi_users')->row();

                }
                else
                {
                    /**
                     * The password didn't verify against original md5
                     */
                    return FALSE;
                }
            }

            if ($this->crypt->check_password($user->user_password, $password))
            {
                $session_data = array(
                    'user_type' => $user->user_type,
                    'user_id'   => $user->user_id,
                );

                $this->session->set_userdata($session_data);

                return TRUE;
            }
        }

        return FALSE;
    }
    
    public function getFlightsCityData($input)
    {
        $sql="SELECT city,country, city_code FROM city_code_amadeus WHERE city LIKE '%$input%' OR city_code LIKE '%$input%' OR country LIKE '%$input%' order by city ASC";
        $query=$this->db->query($sql);
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else return '';
    }
   
    function getAllCities()
    {
         $que = "SELECT citycode,cityname FROM amadeus_city_code";
         $query = $this->db->query($que);
         if ($query->num_rows() == '')
         {
                 return '';
         } 
         else
         {
                 return $query->result();
         }
    }
   
    function get_flight_name($hotelCode)
    {
    //$val="GEN";
            $query = $this->db->query("SELECT AirLineName FROM  amadeus_airline_code WHERE AirLineCode='$hotelCode' ");
            if($query->num_rows =='')
            {
                    return '';
            }else{
                    $dd =  $query->row();
                    return $dd->AirLineName;
            }
    }
    
    function get_City_name($city_code)
    {

            $query = $this->db->query("SELECT * FROM  city_code_amadeus WHERE city_code='$city_code'");
            if($query->num_rows =='')
            {
                    return '';
            }else{
                    $dd =  $query->row();
                    return $dd;
            }
    }
    function get_airport_name($city_code)
	{
		$query = $this->db->query("SELECT city FROM  city_code_amadeus WHERE city_code='$city_code'");
        if($query->num_rows =='')
            {
                    return '';
            }else{
                    $dd =  $query->row();
                    return $dd;
            }
	}
    function checkUserExists($userName,$password)
    {
        $query = $this->db->query("SELECT * FROM  master_customer WHERE emailid='$userName' AND password='".$password."'");
        if($query->num_rows > 0)
        {
                return true;
        }else{
               return false;
        }
    }
    
    function get_countyr_code($name)
    {
        $que="select * from  country_iso where name='$name'";
        $query= $this->db->query($que);
        if($query->num_rows() ==''){
                return '';
        }else{
                return $query->result();
        }
    }
    
    
    // Insert Amadeus Booking Details For OneWay
    function insert_amadeus_booking_details_oneway($flightDetails, $flightDetails1, $final_result, $value,$rand_id) 
    {
       // if (isset($_SESSION['logged_in'])) {
       //     $user_id = $_SESSION['b2c_userid'];
       //     $agent_id = 0;
       //     $user_type = 4;
       // } else {
            $user_id = 0;
            $agent_id = 0;
            $user_type = 4;
       // }

        $count_db = (count($flightDetails->cicode));
        if ($count_db <= 1) {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                $data_db_insert = array('rand_id' => $flightDetails->rand_id, 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails->dlocation, 'alocation' => $flightDetails->alocation, 'airline_code' => $flightDetails->cicode, 'fnumber' => $flightDetails->fnumber, 'ddate' => $flightDetails->ddate, 'adate' => $flightDetails->adate, 'curr_code' => $flightDetails->ccode, 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails->dateOfDeparture, 'dateOfArrival' => $flightDetails->dateOfArrival, 'timeOfDeparture' => $flightDetails->timeOfDeparture, 'timeOfArrival' => $flightDetails->timeOfArrival, 'segref_id' => $flightDetails->id, 'flag' => $flightDetails->flag, 'stops' => $flightDetails->stops, 'pamount' => $flightDetails->pamount, 'booking_class' => $flightDetails->bookingClass, 'totalFareAmount_ADT' => $flightDetails->totalFareAmount, 'totalFareAmount_CHD' => $flightDetails->totalFareAmount, 'totalFareAmount_INF' => $flightDetails->totalFareAmount, 'totalTaxAmount_ADT' => $flightDetails->totalTaxAmount, 'totalTaxAmount_CHD' => $flightDetails->totalTaxAmount, 'totalTaxAmount_INF' => $flightDetails->totalTaxAmount, 'totalFareAmount_Price' => $flightDetails->totalFareAmount, 'totalTaxAmount_Price' => $flightDetails->totalTaxAmount, 'count_ADT' => $_SESSION[$rand_id]['adults'], 'count_CHD' => $_SESSION[$rand_id]['childs'], 'count_INF' => $_SESSION[$rand_id]['infants'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => '', 'description_Search_CHD' => '', 'description_Search_INF' => '', 'breakPoint_ADT' => '', 'breakPoint_CHD' => '', 'breakPoint_INF' => '', 'fareType_ADT' => '', 'fareType_CHD' => '', 'fareType_INF' => '', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                $data_db_insert = array('rand_id' => $flightDetails->rand_id, 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails->dlocation, 'alocation' => $flightDetails->alocation, 'airline_code' => $flightDetails->cicode, 'fnumber' => $flightDetails->fnumber, 'ddate' => $flightDetails->ddate, 'adate' => $flightDetails->adate, 'curr_code' => $flightDetails->ccode, 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails->dateOfDeparture, 'dateOfArrival' => $flightDetails->dateOfArrival, 'timeOfDeparture' => $flightDetails->timeOfDeparture, 'timeOfArrival' => $flightDetails->timeOfArrival, 'segref_id' => $flightDetails->id, 'flag' => $flightDetails->flag, 'stops' => $flightDetails->stops, 'pamount' => $flightDetails->pamount, 'booking_class' => $flightDetails->bookingClass, 'totalFareAmount_ADT' => $flightDetails->totalFareAmount, 'totalFareAmount_CHD' => $flightDetails->totalFareAmount, 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails->totalTaxAmount, 'totalTaxAmount_CHD' => $flightDetails->totalTaxAmount, 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails->totalFareAmount, 'totalTaxAmount_Price' => $flightDetails->totalTaxAmount, 'count_ADT' => $_SESSION[$rand_id]['adults'], 'count_CHD' => $_SESSION[$rand_id]['childs'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => '', 'description_Search_CHD' => '', 'description_Search_INF' => '0', 'breakPoint_ADT' => '', 'breakPoint_CHD' => '', 'breakPoint_INF' => '0', 'fareType_ADT' => $flightDetails->fareType, 'fareType_CHD' => $flightDetails->fareType, 'fareType_INF' => 'NA', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                $data_db_insert = array('rand_id' => $flightDetails->rand_id, 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails->dlocation, 'alocation' => $flightDetails->alocation, 'airline_code' => $flightDetails->cicode, 'fnumber' => $flightDetails->fnumber, 'ddate' => $flightDetails->ddate, 'adate' => $flightDetails->adate, 'curr_code' => $flightDetails->ccode, 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'], 'dateOfArrival' => $flightDetails->dateOfArrival, 'timeOfDeparture' => $flightDetails->timeOfDeparture, 'timeOfArrival' => $flightDetails->timeOfArrival, 'segref_id' => $flightDetails->id, 'flag' => $flightDetails->flag, 'stops' => $flightDetails->stops, 'pamount' => $flightDetails->pamount, 'booking_class' => $flightDetails->bookingClass, 'totalFareAmount_ADT' => $flightDetails->totalFareAmount, 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails->totalFareAmount, 'totalTaxAmount_ADT' => $flightDetails->totalFareAmount, 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails->totalTaxAmount, 'totalFareAmount_Price' => $flightDetails->totalFareAmount, 'totalTaxAmount_Price' => $flightDetails->totalTaxAmount, 'count_ADT' => $_SESSION[$rand_id]['adults'], 'count_CHD' => '0', 'count_INF' => $_SESSION[$rand_id]['infants'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => '', 'description_Search_CHD' => '0', 'description_Search_INF' => '', 'breakPoint_ADT' => '', 'breakPoint_CHD' => '0', 'breakPoint_INF' => '', 'fareType_ADT' => $flightDetails->fareType, 'fareType_CHD' => 'NA', 'fareType_INF' => $flightDetails1['paxFareProduct'][1]['fareType'][0], 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else {
                $data_db_insert = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails['dlocation'], 'alocation' => $flightDetails['alocation'], 'airline_code' => $flightDetails['cicode'], 'fnumber' => $flightDetails['fnumber'], 'ddate' => $flightDetails['ddate'], 'adate' => $flightDetails['adate'], 'curr_code' => $flightDetails['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'], 'dateOfArrival' => $flightDetails1['dateOfArrival'], 'timeOfDeparture' => $flightDetails['timeOfDeparture'], 'timeOfArrival' => $flightDetails['timeOfArrival'], 'segref_id' => $flightDetails['id'], 'flag' => $flightDetails['flag'], 'stops' => $flightDetails['stops'], 'pamount' => $flightDetails['pamount'], 'booking_class' => $flightDetails1['paxFareProduct']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['totalTaxAmount'], 'count_ADT' => $flightDetails1['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['paxFareProduct']['breakPoint'], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => $flightDetails1['paxFareProduct']['fareType'][0], 'fareType_CHD' => 'NA', 'fareType_INF' => 'NA', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            }
        } else {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                for ($adt = 0; $adt < (count($flightDetails['cicode'])); $adt++) {
                    if ($adt == 0) {
                        $data_db_insert[$adt] = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails['dlocation'][$adt], 'alocation' => $flightDetails['alocation'][$adt], 'airline_code' => $flightDetails['cicode'][$adt], 'fnumber' => $flightDetails['fnumber'][$adt], 'ddate' => $flightDetails['ddate'][$adt], 'adate' => $flightDetails['adate'][$adt], 'curr_code' => $flightDetails['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails['timeOfArrival'][$adt], 'segref_id' => $flightDetails['id'], 'flag' => $flightDetails['flag'], 'stops' => $flightDetails['stops'], 'pamount' => $flightDetails['pamount'], 'booking_class' => $flightDetails1['paxFareProduct'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['totalTaxAmount'], 'count_ADT' => $flightDetails1['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['paxFareProduct'][0]['breakPoint'][0], 'breakPoint_CHD' => $flightDetails1['paxFareProduct'][1]['breakPoint'][0], 'breakPoint_INF' => $flightDetails1['paxFareProduct'][2]['breakPoint'][0], 'fareType_ADT' => $flightDetails1['paxFareProduct'][0]['fareType'][0], 'fareType_CHD' => $flightDetails1['paxFareProduct'][1]['fareType'][0], 'fareType_INF' => $flightDetails1['paxFareProduct'][2]['fareType'][0], 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                    } else {
                        $data_db_insert[$adt] = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails['dlocation'][$adt], 'alocation' => $flightDetails['alocation'][$adt], 'airline_code' => $flightDetails['cicode'][$adt], 'fnumber' => $flightDetails['fnumber'][$adt], 'ddate' => $flightDetails['ddate'][$adt], 'adate' => $flightDetails['adate'][$adt], 'curr_code' => $flightDetails['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails['timeOfArrival'][$adt], 'segref_id' => $flightDetails['id'], 'flag' => $flightDetails['flag'], 'stops' => '-1', 'pamount' => $flightDetails['pamount'], 'booking_class' => $flightDetails1['paxFareProduct'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['totalTaxAmount'], 'count_ADT' => $flightDetails1['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['paxFareProduct'][0]['breakPoint'][0], 'breakPoint_CHD' => $flightDetails1['paxFareProduct'][1]['breakPoint'][0], 'breakPoint_INF' => $flightDetails1['paxFareProduct'][2]['breakPoint'][0], 'fareType_ADT' => $flightDetails1['paxFareProduct'][0]['fareType'][0], 'fareType_CHD' => $flightDetails1['paxFareProduct'][1]['fareType'][0], 'fareType_INF' => $flightDetails1['paxFareProduct'][2]['fareType'][0], 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                    }
                    //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                    $this->db->insert('amadeus_flight_booking_details', $data_db_insert[$adt]);
                }
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                for ($adt = 0; $adt < (count($flightDetails['cicode'])); $adt++) {
                    if ($adt == 0) {
                        $data_db_insert[$adt] = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails['dlocation'][$adt], 'alocation' => $flightDetails['alocation'][$adt], 'airline_code' => $flightDetails['cicode'][$adt], 'fnumber' => $flightDetails['fnumber'][$adt], 'ddate' => $flightDetails['ddate'][$adt], 'adate' => $flightDetails['adate'][$adt], 'curr_code' => $flightDetails['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails['timeOfArrival'][$adt], 'segref_id' => $flightDetails['id'], 'flag' => $flightDetails['flag'], 'stops' => $flightDetails['stops'], 'pamount' => $flightDetails['pamount'], 'booking_class' => $flightDetails1['paxFareProduct'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['totalTaxAmount'], 'count_ADT' => $flightDetails1['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['paxFareProduct'][0]['breakPoint'][0], 'breakPoint_CHD' => $flightDetails1['paxFareProduct'][1]['breakPoint'][0], 'breakPoint_INF' => '0', 'fareType_ADT' => $flightDetails1['paxFareProduct'][0]['fareType'][0], 'fareType_CHD' => $flightDetails1['paxFareProduct'][1]['fareType'][0], 'fareType_INF' => 'NA', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                    } else {
                        $data_db_insert[$adt] = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails['dlocation'][$adt], 'alocation' => $flightDetails['alocation'][$adt], 'airline_code' => $flightDetails['cicode'][$adt], 'fnumber' => $flightDetails['fnumber'][$adt], 'ddate' => $flightDetails['ddate'][$adt], 'adate' => $flightDetails['adate'][$adt], 'curr_code' => $flightDetails['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails['timeOfArrival'][$adt], 'segref_id' => $flightDetails['id'], 'flag' => $flightDetails['flag'], 'stops' => '-1', 'pamount' => $flightDetails['pamount'], 'booking_class' => $flightDetails1['paxFareProduct'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['totalTaxAmount'], 'count_ADT' => $flightDetails1['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['paxFareProduct'][0]['breakPoint'][0], 'breakPoint_CHD' => $flightDetails1['paxFareProduct'][1]['breakPoint'][0], 'breakPoint_INF' => '0', 'fareType_ADT' => $flightDetails1['paxFareProduct'][0]['fareType'][0], 'fareType_CHD' => $flightDetails1['paxFareProduct'][1]['fareType'][0], 'fareType_INF' => 'NA', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                    }
                    //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                    $this->db->insert('amadeus_flight_booking_details', $data_db_insert[$adt]);
                }
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                for ($adt = 0; $adt < (count($flightDetails['cicode'])); $adt++) {
                    if ($adt == 0) {
                        $data_db_insert[$adt] = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails['dlocation'][$adt], 'alocation' => $flightDetails['alocation'][$adt], 'airline_code' => $flightDetails['cicode'][$adt], 'fnumber' => $flightDetails['fnumber'][$adt], 'ddate' => $flightDetails['ddate'][$adt], 'adate' => $flightDetails['adate'][$adt], 'curr_code' => $flightDetails['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails['timeOfArrival'][$adt], 'segref_id' => $flightDetails['id'], 'flag' => $flightDetails['flag'], 'stops' => $flightDetails['stops'], 'pamount' => $flightDetails['pamount'], 'booking_class' => $flightDetails1['paxFareProduct'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['totalTaxAmount'], 'count_ADT' => $flightDetails1['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['paxFareProduct'][0]['breakPoint'][0], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['paxFareProduct'][1]['breakPoint'][0], 'fareType_ADT' => $flightDetails1['paxFareProduct'][0]['fareType'][0], 'fareType_CHD' => 'NA', 'fareType_INF' => $flightDetails1['paxFareProduct'][1]['fareType'][0], 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                    } else {
                        $data_db_insert[$adt] = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails['dlocation'][$adt], 'alocation' => $flightDetails['alocation'][$adt], 'airline_code' => $flightDetails['cicode'][$adt], 'fnumber' => $flightDetails['fnumber'][$adt], 'ddate' => $flightDetails['ddate'][$adt], 'adate' => $flightDetails['adate'][$adt], 'curr_code' => $flightDetails['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails['timeOfArrival'][$adt], 'segref_id' => $flightDetails['id'], 'flag' => $flightDetails['flag'], 'stops' => '-1', 'pamount' => $flightDetails['pamount'], 'booking_class' => $flightDetails1['paxFareProduct'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['totalTaxAmount'], 'count_ADT' => $flightDetails1['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['paxFareProduct'][0]['breakPoint'][0], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['paxFareProduct'][1]['breakPoint'][0], 'fareType_ADT' => $flightDetails1['paxFareProduct'][0]['fareType'][0], 'fareType_CHD' => 'NA', 'fareType_INF' => $flightDetails1['paxFareProduct'][1]['fareType'][0], 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                    }
                    //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                    $this->db->insert('amadeus_flight_booking_details', $data_db_insert[$adt]);
                    // $insert_id = $this->db->last_query();
                }
            } else {
                for ($adt = 0; $adt < (count($flightDetails['cicode'])); $adt++) {
                    if ($adt == 0) {
                        $data_db_insert[$adt] = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails['dlocation'][$adt], 'alocation' => $flightDetails['alocation'][$adt], 'airline_code' => $flightDetails['cicode'][$adt], 'fnumber' => $flightDetails['fnumber'][$adt], 'ddate' => $flightDetails['ddate'][$adt], 'adate' => $flightDetails['adate'][$adt], 'curr_code' => $flightDetails['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails['timeOfArrival'][$adt], 'segref_id' => $flightDetails['id'], 'flag' => $flightDetails['flag'], 'stops' => $flightDetails['stops'], 'pamount' => $flightDetails['pamount'], 'booking_class' => $flightDetails1['paxFareProduct']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['totalTaxAmount'], 'count_ADT' => $flightDetails1['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['paxFareProduct']['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => $flightDetails1['paxFareProduct']['fareType'][0], 'fareType_CHD' => 'NA', 'fareType_INF' => 'NA', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                    } else {
                        $data_db_insert[$adt] = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails['dlocation'][$adt], 'alocation' => $flightDetails['alocation'][$adt], 'airline_code' => $flightDetails['cicode'][$adt], 'fnumber' => $flightDetails['fnumber'][$adt], 'ddate' => $flightDetails['ddate'][$adt], 'adate' => $flightDetails['adate'][$adt], 'curr_code' => $flightDetails['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails['timeOfArrival'][$adt], 'segref_id' => $flightDetails['id'], 'flag' => $flightDetails['flag'], 'stops' => '-1', 'pamount' => $flightDetails['pamount'], 'booking_class' => $flightDetails1['paxFareProduct']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['totalTaxAmount'], 'count_ADT' => $flightDetails1['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['paxFareProduct']['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => $flightDetails1['paxFareProduct']['fareType'][0], 'fareType_CHD' => 'NA', 'fareType_INF' => 'NA', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                    }
                    //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                    $this->db->insert('amadeus_flight_booking_details', $data_db_insert[$adt]);
                }
            }
        }
    }

    // Insert Amadeus Booking Details For RoundTrip
    function insert_amadeus_booking_details_round($flightDetails_oneway, $flightDetails_return, $flightDetails1, $flightDetails2, $final_result, $value)
    {
        if (isset($_SESSION['logged_in'])) {
            $user_id = $_SESSION['b2c_userid'];
            $agent_id = 0;
            $user_type = 4;
        } else {
            $user_id = 0;
            $agent_id = 0;
            $user_type = 4;
        }

        $count_db_oneway = (count($flightDetails_oneway['cicode']));
        $count_db_return = (count($flightDetails_return['cicode']));
        $rand_id = $flightDetails_oneway['rand_id'];

        if ($count_db_oneway <= 1) {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'], 'alocation' => $flightDetails_oneway['alocation'], 'airline_code' => $flightDetails_oneway['cicode'], 'fnumber' => $flightDetails_oneway['fnumber'], 'ddate' => $flightDetails_oneway['ddate'], 'adate' => $flightDetails_oneway['adate'], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][0]['breakPoint'], 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][0]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'], 'alocation' => $flightDetails_oneway['alocation'], 'airline_code' => $flightDetails_oneway['cicode'], 'fnumber' => $flightDetails_oneway['fnumber'], 'ddate' => $flightDetails_oneway['ddate'], 'adate' => $flightDetails_oneway['adate'], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][0]['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'], 'alocation' => $flightDetails_oneway['alocation'], 'airline_code' => $flightDetails_oneway['cicode'], 'fnumber' => $flightDetails_oneway['fnumber'], 'ddate' => $flightDetails_oneway['ddate'], 'adate' => $flightDetails_oneway['adate'], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][0]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else {
                $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'], 'alocation' => $flightDetails_oneway['alocation'], 'airline_code' => $flightDetails_oneway['cicode'], 'fnumber' => $flightDetails_oneway['fnumber'], 'ddate' => $flightDetails_oneway['ddate'], 'adate' => $flightDetails_oneway['adate'], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['breakPoint'], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            }
        } else {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                for ($adt = 0; $adt < $count_db_oneway; $adt) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['breakPoint'][0], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][0]['breakPoint'][0], 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][0]['breakPoint'][0], 'fareType_ADT' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][0]['fareType'][0], 'fareType_CHD' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][0]['fareType'][0], 'fareType_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][0]['fareType'][0], 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => "-1", 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['breakPoint'][0], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][0]['breakPoint'][0], 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][0]['breakPoint'][0], 'fareType_ADT' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][0]['breakPoint'][0], 'fareType_CHD' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][0]['fareType'][0], 'fareType_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][0]['fareType'][0], 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                for ($adt = 0; $adt < $count_db_oneway; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][0]['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $dta_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => "-1", 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][0]['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                for ($adt = 0; $adt < $count_db_oneway; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][0]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => "-1", 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][0]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else {
                for ($adt = 0; $adt < $count_db_oneway; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => "-1", 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            }
        }

        if ($count_db_return <= 1) {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'], 'alocation' => $flightDetails_return['alocation'], 'airline_code' => $flightDetails_return['cicode'], 'fnumber' => $flightDetails_return['fnumber'], 'ddate' => $flightDetails_return['ddate'], 'adate' => $flightDetails_return['adate'], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][1]['breakPoint'], 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][1]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'], 'alocation' => $flightDetails_return['alocation'], 'airline_code' => $flightDetails_return['cicode'], 'fnumber' => $flightDetails_return['fnumber'], 'ddate' => $flightDetails_return['ddate'], 'adate' => $flightDetails_return['adate'], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][1]['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'], 'alocation' => $flightDetails_return['alocation'], 'airline_code' => $flightDetails_return['cicode'], 'fnumber' => $flightDetails_return['fnumber'], 'ddate' => $flightDetails_return['ddate'], 'adate' => $flightDetails_return['adate'], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][1]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else {
                $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'], 'alocation' => $flightDetails_return['alocation'], 'airline_code' => $flightDetails_return['cicode'], 'fnumber' => $flightDetails_return['fnumber'], 'ddate' => $flightDetails_return['ddate'], 'adate' => $flightDetails_return['adate'], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            }
        } else {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                for ($adt = 0; $adt < $count_db_return; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][1]['breakPoint'], 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][1]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => "-1", 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][1]['breakPoint'], 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][2]['fareDetails'][1]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                for ($adt = 0; $adt < $count_db_return; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][1]['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => "-1", 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][1]['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                for ($adt = 0; $adt < $count_db_return; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][1]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => "-1", 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct'][0]['fareDetails'][1]['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm']['paxFareProduct'][1]['fareDetails'][1]['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else {
                for ($adt = 0; $adt < $count_db_return; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => "-1", 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm']['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm']['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm']['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm']['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm']['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        //echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            }
        }
    }

    // Insert Amadeus Booking Details For MTK
    function insert_amadeus_booking_details_mtk($flightDetails_oneway, $flightDetails_return, $flightDetails1, $flightDetails2, $final_result, $value)
    {
        if (isset($_SESSION['logged_in'])) {
            $user_id = $_SESSION['b2c_userid'];
            $agent_id = 0;
            $user_type = 4;
        } else {
            $user_id = 0;
            $agent_id = 0;
            $user_type = 4;
        }

        $count_db_oneway = (count($flightDetails_oneway['cicode']));
        $count_db_return = (count($flightDetails_return['cicode']));
        $rand_id = $flightDetails_oneway['rand_id'];
        if ($count_db_oneway <= 1) {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'], 'alocation' => $flightDetails_oneway['alocation'], 'airline_code' => $flightDetails_oneway['cicode'], 'fnumber' => $flightDetails_oneway['fnumber'], 'ddate' => $flightDetails_oneway['ddate'], 'adate' => $flightDetails_oneway['adate'], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'], 'alocation' => $flightDetails_oneway['alocation'], 'airline_code' => $flightDetails_oneway['cicode'], 'fnumber' => $flightDetails_oneway['fnumber'], 'ddate' => $flightDetails_oneway['ddate'], 'adate' => $flightDetails_oneway['adate'], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'], 'alocation' => $flightDetails_oneway['alocation'], 'airline_code' => $flightDetails_oneway['cicode'], 'fnumber' => $flightDetails_oneway['fnumber'], 'ddate' => $flightDetails_oneway['ddate'], 'adate' => $flightDetails_oneway['adate'], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else {
                $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'], 'alocation' => $flightDetails_oneway['alocation'], 'airline_code' => $flightDetails_oneway['cicode'], 'fnumber' => $flightDetails_oneway['fnumber'], 'ddate' => $flightDetails_oneway['ddate'], 'adate' => $flightDetails_oneway['adate'], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm'][0]['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['breakPoint'], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            }
        } else {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                for ($adt = 0; $adt < $count_db_oneway; $adt) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['breakPoint'][0], 'breakPoint_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['fareDetails']['breakPoint'][0], 'breakPoint_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['fareDetails']['breakPoint'][0], 'fareType_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['fareDetails']['fareType'][0], 'fareType_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['fareDetails']['fareType'][0], 'fareType_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['fareDetails']['fareType'][0], 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => "-1", 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['breakPoint'][0], 'breakPoint_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['fareDetails']['breakPoint'][0], 'breakPoint_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['fareDetails']['breakPoint'][0], 'fareType_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['fareDetails']['breakPoint'][0], 'fareType_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['fareDetails']['fareType'][0], 'fareType_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][2]['fareDetails']['fareType'][0], 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                for ($adt = 0; $adt < $count_db_oneway; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $dta_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => "-1", 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                for ($adt = 0; $adt < $count_db_oneway; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => "-1", 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm'][0]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else {
                for ($adt = 0; $adt < $count_db_oneway; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => $flightDetails_oneway['stops'], 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm'][0]['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_oneway['dlocation'][$adt], 'alocation' => $flightDetails_oneway['alocation'][$adt], 'airline_code' => $flightDetails_oneway['cicode'][$adt], 'fnumber' => $flightDetails_oneway['fnumber'][$adt], 'ddate' => $flightDetails_oneway['ddate'][$adt], 'adate' => $flightDetails_oneway['adate'][$adt], 'curr_code' => $flightDetails_oneway['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails1['oneWay']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails1['oneWay']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails1['oneWay']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails1['oneWay']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_oneway['id'], 'flag' => $flightDetails_oneway['flag'], 'stops' => "-1", 'pamount' => $flightDetails_oneway['pamount'], 'booking_class' => $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][0]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][0]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][0]['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm'][0]['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            }
        }

        if ($count_db_return <= 1) {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'], 'alocation' => $flightDetails_return['alocation'], 'airline_code' => $flightDetails_return['cicode'], 'fnumber' => $flightDetails_return['fnumber'], 'ddate' => $flightDetails_return['ddate'], 'adate' => $flightDetails_return['adate'], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'], 'alocation' => $flightDetails_return['alocation'], 'airline_code' => $flightDetails_return['cicode'], 'fnumber' => $flightDetails_return['fnumber'], 'ddate' => $flightDetails_return['ddate'], 'adate' => $flightDetails_return['adate'], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'], 'alocation' => $flightDetails_return['alocation'], 'airline_code' => $flightDetails_return['cicode'], 'fnumber' => $flightDetails_return['fnumber'], 'ddate' => $flightDetails_return['ddate'], 'adate' => $flightDetails_return['adate'], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            } else {
                $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'], 'alocation' => $flightDetails_return['alocation'], 'airline_code' => $flightDetails_return['cicode'], 'fnumber' => $flightDetails_return['fnumber'], 'ddate' => $flightDetails_return['ddate'], 'adate' => $flightDetails_return['adate'], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm'][1]['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['breakPoint'], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
            }
        } else {
            if (!empty($_SESSION[$rand_id]['childs']) && (!empty($_SESSION[$rand_id]['infants']))) {
                for ($adt = 0; $adt < $count_db_return; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => "-1", 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['count'], 'count_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['description'], 'description_Search_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][2]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else if (!empty($_SESSION[$rand_id]['childs'])) {
                for ($adt = 0; $adt < $count_db_return; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => "-1", 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalFareAmount'], 'totalFareAmount_INF' => '0', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalTaxAmount'], 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['count'], 'count_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['count'], 'count_INF' => '0', 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['description'], 'description_Search_INF' => '0', 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'breakPoint_INF' => '0', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else if (!empty($_SESSION[$rand_id]['infants'])) {
                for ($adt = 0; $adt < $count_db_return; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => "-1", 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalFareAmount'], 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['totalTaxAmount'], 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['count'], 'count_CHD' => '0', 'count_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['count'], 'infantIndicator_ADT' => 'nill', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['description'], 'description_Search_CHD' => '0', 'description_Search_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct'][0]['fareDetails']['breakPoint'], 'breakPoint_CHD' => '0', 'breakPoint_INF' => $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails']['breakPoint'], 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            } else {
                for ($adt = 0; $adt < $count_db_return; $adt++) {
                    if ($adt == 0) {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => $flightDetails_return['stops'], 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm'][1]['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    } else {
                        $data_db_insert = array('rand_id' => $flightDetails_return['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'dlocation' => $flightDetails_return['dlocation'][$adt], 'alocation' => $flightDetails_return['alocation'][$adt], 'airline_code' => $flightDetails_return['cicode'][$adt], 'fnumber' => $flightDetails_return['fnumber'][$adt], 'ddate' => $flightDetails_return['ddate'][$adt], 'adate' => $flightDetails_return['adate'][$adt], 'curr_code' => $flightDetails_return['ccode'], 'api' => 'amadeus', 'dateOfDeparture' => $flightDetails2['Return']['dateOfDeparture'][$adt], 'dateOfArrival' => $flightDetails2['Return']['dateOfArrival'][$adt], 'timeOfDeparture' => $flightDetails2['Return']['timeOfDeparture'][$adt], 'timeOfArrival' => $flightDetails2['Return']['timeOfArrival'][$adt], 'segref_id' => $flightDetails_return['id'], 'flag' => $flightDetails_return['flag'], 'stops' => "-1", 'pamount' => $flightDetails_return['pamount'], 'booking_class' => $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][0], 'totalFareAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['totalFareAmount'], 'totalFareAmount_CHD' => '0', 'totalFareAmount_INF' => 'NS', 'totalTaxAmount_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['totalTaxAmount'], 'totalTaxAmount_CHD' => '0', 'totalTaxAmount_INF' => '0', 'totalFareAmount_Price' => $flightDetails1['Recomm'][1]['totalFareAmount'], 'totalTaxAmount_Price' => $flightDetails1['Recomm'][1]['totalTaxAmount'], 'count_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['count'], 'count_CHD' => '0', 'count_INF' => '0', 'infantIndicator_ADT' => 'NEED', 'description_Search_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['description'], 'description_Search_CHD' => $flightDetails1['Recomm'][1]['paxFareProduct']['description'], 'description_Search_INF' => $flightDetails1['Recomm'][1]['paxFareProduct']['description'], 'breakPoint_ADT' => $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['breakPoint'][0], 'breakPoint_CHD' => 'NA', 'breakPoint_INF' => 'NA', 'fareType_ADT' => 'Need', 'fareType_CHD' => 'Need', 'fareType_INF' => 'Need', 'PNR_Number' => $final_result['controlNumber'], 'companyId' => $final_result['companyId'], 'originatorId' => $final_result['originatorId'], 'inHouseIdentification1' => $final_result['inHouseIdentification1'], 'originatorTypeCode' => $final_result['originatorTypeCode'], 'creation_date' => $final_result['date'], 'Creation_Time' => $final_result['time'], 'typeOfPnrElement' => $final_result['typeOfPnrElement'], 'agentId' => $final_result['agentId'], 'contact_email' => $value['email'], 'contact_phone' => $value['mobile'], 'country' => $value['country'], 'admin_markup' => $value['admin_markup'], 'payment_charge' => $value['payment_charge'], 'Total_price' => $value['Total_price'], 'journey_type' => $_SESSION[$rand_id]['journey_type'], 'Passenger_id' => 'need', 'Result_id' => 'need', 'booked_currency' => $_SESSION['currency'], 'booked_currency_value' => $_SESSION['currency_value']);
                        // echo '<pre/>final_result : ';print_r($data_db_insert);exit;
                        $this->db->insert('amadeus_flight_booking_details', $data_db_insert);
                    }
                }
            }
        }
    }

    // Insert Voucher Details Round_trip and MTK
    function insert_amadeus_voucher_details($flightDetails_oneway, $flightDetails_return, $segmentNameDetails, $final_result, $value)
    {
        if (isset($_SESSION['logged_in'])) {
            $user_id = $_SESSION['b2c_userid'];
            $agent_id = 0;
            $user_type = 4;
        } else {
            $user_id = 0;
            $agent_id = 0;
            $user_type = 4;
        }

        $i = 0;
        $count_db_oneway = (count($flightDetails_oneway['cicode']));
        $count_db_return = (count($flightDetails_return['cicode']));
        $rand_id = $flightDetails_oneway['rand_id'];
        $adult_count = $_SESSION[$rand_id]['adults'];
        $child_count = $_SESSION[$rand_id]['childs'];
        $infant_count = $_SESSION[$rand_id]['infants'];
        $stops_oneway = $flightDetails_oneway['stops'];
        $stops_return = $flightDetails_return['stops'];

        foreach ($segmentNameDetails as $segmentNameDetails)
            $segmentDetails[$i++] = $segmentNameDetails;
        $result_segment = '';
        for ($j = 0; $j < (count($segmentDetails)); $j++) {
            if ($segmentDetails[$j]['segmentName'] == "AP")
                $result_segment.="SegmentName : " . $segmentDetails[$j]['segmentName'] . " Contact Details : " . $segmentDetails[$j]['longFreetext'] . "<br/>";
            else if ($segmentDetails[$j]['segmentName'] == "TK")
                $result_segment.='';
            else {
                if ($segmentDetails[$j]['otherDataFreetext'] == "NONREF") {
                    $result_segment.="SegmentName : " . $segmentDetails[$j]['segmentName'] . " Description : " . $segmentDetails[$j]['otherDataFreetext'] . " (Non Refundable)<br/>";
                } else {
                    $result_segment.="SegmentName : " . $segmentDetails[$j]['segmentName'] . " Description : " . $segmentDetails[$j]['otherDataFreetext'] . "<br/>";
                }
            }
        }

        $ADT_Details = '';
        $CHD_Details = '';
        $INF_Details = '';

        if (!isset($value['saladult'][0]))
            $Traveller_Name = $value['saladult'] . " " . $value['fnameadult'] . " " . $value['lnameadult'] . "<br/>";
        else
            $Traveller_Name = $value['saladult'][0] . " " . $value['fnameadult'][0] . " " . $value['lnameadult'][0] . "<br/>";

        $ad = 0;
        if (isset($value['saladult'][0])) {
            for ($ad = 0; $ad < $adult_count; $ad++) {
                $ADT_Details.=$value['saladult'][$ad] . " " . $value['fnameadult'][$ad] . " " . $value['lnameadult'][$ad] . "<br/>";
            }
        } else {
            $ADT_Details.=$value['saladult'] . " " . $value['fnameadult'] . " " . $value['lnameadult'] . "<br/>";
        }

        if (!empty($child_count)) {
            if (isset($value['salchild'][0])) {
                for ($ch = 0; $ch < $child_count; $ch++) {
                    $CHD_Details.=$value['fnamechild'][$ch] . " " . $value['lnamechild'][$ch] . "<br/>";
                }
            } else {
                $CHD_Details.=$value['fnamechild'] . " " . $value['lnamechild'] . "<br/>";
            }
        }

        if (!empty($infant_count)) {
            if (isset($value['salinfant'][0])) {
                for ($in = 0; $in < $infant_count; $in++) {
                    $INF_Details.=$value['fnameinfant'][$in] . " " . $value['lnameinfant'][$in] . "<br/>";
                }
            } else {
                $INF_Details.=$value['fnameinfant'] . " " . $value['lnameinfant'] . "<br/>";
            }
        }


        if ((!empty($CHD_Details)) && (!empty($INF_Details)))
            $Passenger_Info = "Adult_Information:<br/> " . $ADT_Details . "<br>Child_Information:<br/> " . $CHD_Details . "<br/>Infant_Information:<br/> " . $INF_Details;
        else if (!empty($CHD_Details))
            $Passenger_Info = "Adult_Information:<br/> " . $ADT_Details . "<br>Child_Information:<br/> " . $CHD_Details;
        else if (!empty($INF_Details))
            $Passenger_Info = "Adult_Information:<br/> " . $ADT_Details . "<br/>Infant_Information:<br/> " . $INF_Details;
        else
            $Passenger_Info = "Adult_Information:<br/> " . $ADT_Details;


        $duration_final_oneway = 0;
        if (isset($flightDetails_oneway['duration_final'][0])) {
            $duration_final = '';
            $count = (count($flightDetails_oneway['duration_final']));
            for ($io = 0; $io < $count; $io++) {
                $duration_final_oneway.=$flightDetails_oneway['duration_final'][$io] . "<br/>";
            }
        } else {
            $duration_final_oneway = $flightDetails_oneway['duration_final'];
        }

        $duration_final_return = 0;
        if (isset($flightDetails_return['duration_final'][0])) {
            $duration_final = '';
            $count = (count($flightDetails_return['duration_final']));
            for ($io = 0; $io < $count; $io++) {
                $duration_final_return.=$flightDetails_return['duration_final'][$io] . "<br/>";
            }
        } else {
            $duration_final_return = $flightDetails_return['duration_final'];
        }
        $duration_final = $duration_final_return . "<br/>" . $duration_final_return;
        $voucher_db_insert = array('rand_id' => $flightDetails_oneway['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'PNR_Number' => $final_result['controlNumber'], 'traveller_name' => $Traveller_Name, 'fare_rules' => $result_segment, 'cabin_type' => 'NA', 'passenger_info' => $Passenger_Info, 'duration' => $duration_final);
        $this->db->insert('amadeus_voucher_info', $voucher_db_insert);
    }

    // Insert Voucher Details OneWay
    function insert_amadeus_voucher_details_oneway($flightDetails, $segmentNameDetails, $final_result, $value)
    {
        if (isset($_SESSION['logged_in'])) {
            $user_id = $_SESSION['b2c_userid'];
            $agent_id = 0;
            $user_type = 4;
        } else {
            $user_id = 0;
            $agent_id = 0;
            $user_type = 4;
        }

        $i = 0;
        $adult_count = $_SESSION[$rand_id]['adults'];
        $child_count = $_SESSION[$rand_id]['childs'];
        $infant_count = $_SESSION[$rand_id]['infants'];
        $stops = $flightDetails['stops'];

        $db_insert_segmentNameDetails = $data['final_result']['segmentNameDetails'];

        $segmentNameDetails = $data['final_result']['segmentNameDetails'];
        foreach ($segmentNameDetails as $segmentNameDetails)
            $segmentDetails[$i++] = $segmentNameDetails;
        $result_segment = '';
        for ($j = 0; $j < (count($segmentDetails)); $j++) {
            if ($segmentDetails[$j]['segmentName'] == "AP")
                $result_segment.="SegmentName : " . $segmentDetails[$j]['segmentName'] . " Contact Details : " . $segmentDetails[$j]['longFreetext'] . "<br/>";
            else if ($segmentDetails[$j]['segmentName'] == "TK")
                $result_segment.='';
            else {
                if ($segmentDetails[$j]['otherDataFreetext'] == "NONREF") {
                    $result_segment.="SegmentName : " . $segmentDetails[$j]['segmentName'] . " Description : " . $segmentDetails[$j]['otherDataFreetext'] . " (Non Refundable)<br/>";
                } else {
                    $result_segment.="SegmentName : " . $segmentDetails[$j]['segmentName'] . " Description : " . $segmentDetails[$j]['otherDataFreetext'] . "<br/>";
                }
            }
        }


        $ADT_Details = '';
        $CHD_Details = '';
        $INF_Details = '';

        if (!isset($value['saladult'][0]))
            $Traveller_Name = $value['saladult'] . " " . $value['fnameadult'] . " " . $value['lnameadult'] . "<br/>";
        else
            $Traveller_Name = $value['saladult'][0] . " " . $value['fnameadult'][0] . " " . $value['lnameadult'][0] . "<br/>";

        $ad = 0;
        if (isset($value['saladult'][0])) {
            for ($ad = 0; $ad < $adult_count; $ad++) {
                $ADT_Details.=$value['saladult'][$ad] . " " . $value['fnameadult'][$ad] . " " . $value['lnameadult'][$ad] . "<br/>";
            }
        } else {
            $ADT_Details.=$value['saladult'] . " " . $value['fnameadult'] . " " . $value['lnameadult'] . "<br/>";
        }

        if (!empty($child_count)) {
            if (isset($value['salchild'][0])) {
                for ($ch = 0; $ch < $child_count; $ch++) {
                    $CHD_Details.=$value['fnamechild'][$ch] . " " . $value['lnamechild'][$ch] . "<br/>";
                }
            } else {
                $CHD_Details.=$value['fnamechild'] . " " . $value['lnamechild'] . "<br/>";
            }
        }

        if (!empty($infant_count)) {
            if (isset($value['salinfant'][0])) {
                for ($in = 0; $in < $infant_count; $in++) {
                    $INF_Details.=$value['fnameinfant'][$in] . " " . $value['lnameinfant'][$in] . "<br/>";
                }
            } else {
                $INF_Details.=$value['fnameinfant'] . " " . $value['lnameinfant'] . "<br/>";
            }
        }


        if ((!empty($CHD_Details)) && (!empty($INF_Details)))
            $Passenger_Info = "Adult_Information:<br/> " . $ADT_Details . "<br>Child_Information:<br/> " . $CHD_Details . "<br/>Infant_Information:<br/> " . $INF_Details;
        else if (!empty($CHD_Details))
            $Passenger_Info = "Adult_Information:<br/> " . $ADT_Details . "<br>Child_Information:<br/> " . $CHD_Details;
        else if (!empty($INF_Details))
            $Passenger_Info = "Adult_Information:<br/> " . $ADT_Details . "<br/>Infant_Information:<br/> " . $INF_Details;
        else
            $Passenger_Info = "Adult_Information:<br/> " . $ADT_Details;

        $duration_final = 0;
        if (isset($flightDetails['duration_final'][0])) {
            $duration_final = '';
            $count = (count($flightDetails['duration_final']));
            for ($io = 0; $io < $count; $io++) {
                $duration_final.=$flightDetails['duration_final'][$io] . "<br/>";
            }
        } else {
            $duration_final = $flightDetails['duration_final'];
        }

        $voucher_db_insert = array('rand_id' => $flightDetails['rand_id'], 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'PNR_Number' => $final_result['controlNumber'], 'traveller_name' => $Traveller_Name, 'fare_rules' => $result_segment, 'cabin_type' => 'NA', 'passenger_info' => $Passenger_Info, 'duration' => $duration_final);
        $this->db->insert('amadeus_voucher_info', $voucher_db_insert);
    }

    // Insert Passenger Details Round_trip and MTK
    function insert_amadeus_passenger_details($flightDetails_oneway, $final_result, $value)
    {
        if (isset($_SESSION['logged_in'])) {
            $user_id = $_SESSION['b2c_userid'];
            $agent_id = 0;
            $user_type = 4;
        } else {
            $user_id = 0;
            $agent_id = 0;
            $user_type = 4;
        }

        $rand_id = $flightDetails_oneway['rand_id'];

        if (!empty($_SESSION[$rand_id]['adults'])) {
            $count_saladult = (count($value['saladult']));
            for ($i = 0; $i < $count_saladult; $i++) {
                $value_db_insert_adt[$i] = array('rand_id' => $flightDetails_oneway['rand_id'], 'PNR_Number' => $final_result['controlNumber'], 'booked_by' => 'user', 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'title' => $value['saladult'][$i], 'surname' => $value['fnameadult'][$i], 'fname' => $value['lnameadult'][$i], 'dob' => '0', 'type' => 'ADT', 'creation_date' => $final_result['date']);
                // echo '<pre/>final_result : ';print_r($value_db_insert_adt);
                $this->db->insert('amadeus_flight_book_passengers', $value_db_insert_adt[$i]);
            }
        }

        if (!empty($_SESSION[$rand_id]['childs'])) {
            $count_salchild = (count($value['salchild']));
            for ($i = 0; $i < $count_salchild; $i++) {
                $value_db_insert_chd[$i] = array('rand_id' => $flightDetails_oneway['rand_id'], 'PNR_Number' => $final_result['controlNumber'], 'booked_by' => 'user', 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'title' => $value['salchild'][$i], 'surname' => $value['fnamechild'][$i], 'fname' => $value['lnamechild'][$i], 'dob' => $value['adobchild'][$i], 'type' => 'CHD', 'creation_date' => $final_result['date']);
                // echo '<pre/>final_result : ';print_r($value_db_insert_chd);
                $this->db->insert('amadeus_flight_book_passengers', $value_db_insert_chd[$i]);
            }
        }

        if (!empty($_SESSION[$rand_id]['infants'])) {
            $count_salinfant = (count($value['salinfant']));
            for ($i = 0; $i < $count_salinfant; $i++) {
                $value_db_insert_inf[$i] = array('rand_id' => $flightDetails_oneway['rand_id'], 'PNR_Number' => $final_result['controlNumber'], 'booked_by' => 'user', 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'title' => $value['salinfant'][$i], 'surname' => $value['fnameinfant'][$i], 'fname' => $value['lnameinfant'][$i], 'dob' => $value['adobinfant'][$i], 'type' => 'INF', 'creation_date' => $final_result['date']);
                //echo '<pre/>final_result : ';print_r($value_db_insert_inf);
                $this->db->insert('amadeus_flight_book_passengers', $value_db_insert_inf[$i]);
            }
        }
    }

    // Insert Passenger Details OneWay
    function insert_amadeus_passenger_details_oneway($flightDetails, $final_result, $value)
    {
        if (isset($_SESSION['logged_in'])) {
            $user_id = $_SESSION['b2c_userid'];
            $agent_id = 0;
            $user_type = 4;
        } else {
            $user_id = 0;
            $agent_id = 0;
            $user_type = 4;
        }

        $rand_id = $flightDetails['rand_id'];

        if (!empty($_SESSION[$rand_id]['adults'])) {
            $count_saladult = (count($value['saladult']));
            for ($i = 0; $i < $count_saladult; $i++) {
                $value_db_insert_adt[$i] = array('rand_id' => $flightDetails['rand_id'], 'PNR_Number' => $final_result['controlNumber'], 'booked_by' => 'user', 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'title' => $value['saladult'][$i], 'surname' => $value['fnameadult'][$i], 'fname' => $value['lnameadult'][$i], 'dob' => '0', 'type' => 'ADT', 'creation_date' => $final_result['date']);
                //echo '<pre/>final_result : ';print_r($value_db_insert_adt);
                $this->db->insert('amadeus_flight_book_passengers', $value_db_insert_adt[$i]);
            }
        }

        if (!empty($_SESSION[$rand_id]['childs'])) {
            $count_salchild = (count($value['salchild']));
            for ($i = 0; $i < $count_salchild; $i++) {
                $value_db_insert_chd[$i] = array('rand_id' => $flightDetails['rand_id'], 'PNR_Number' => $final_result['controlNumber'], 'booked_by' => 'user', 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'title' => $value['salchild'][$i], 'surname' => $value['fnamechild'][$i], 'fname' => $value['lnamechild'][$i], 'dob' => $value['adobchild'][$i], 'type' => 'CHD', 'creation_date' => $final_result['date']);
                //echo '<pre/>final_result : ';print_r($value_db_insert_chd);
                $this->db->insert('amadeus_flight_book_passengers', $value_db_insert_chd[$i]);
            }
        }

        if (!empty($_SESSION[$rand_id]['infants'])) {
            $count_salinfant = (count($value['salinfant']));
            for ($i = 0; $i < $count_salinfant; $i++) {
                $value_db_insert_inf[$i] = array('rand_id' => $flightDetails['rand_id'], 'PNR_Number' => $final_result['controlNumber'], 'booked_by' => 'user', 'user_id' => $user_id, 'user_type' => $user_type, 'agent_id' => $agent_id, 'title' => $value['salinfant'][$i], 'surname' => $value['fnameinfant'][$i], 'fname' => $value['lnameinfant'][$i], 'dob' => $value['adobinfant'][$i], 'type' => 'INF', 'creation_date' => $final_result['date']);
                //echo '<pre/>final_result : ';print_r($value_db_insert_inf);
                $this->db->insert('amadeus_flight_book_passengers', $value_db_insert_inf[$i]);
            }
        }
    }
    
    function get_adminmarkup()
    {
			//$query=$this->db->query($sql="select * from ");
	}
	function getFlightSearchResultcache($fromcityval_for_cache,$tocityval_for_cache,$sd_cache,$ed_cache,$adults_cache,$childs_cache,$infants_cache,$journey_types_cache,$cabin_selected_cache)
	{
		$query=$this->db->query($sql="select * from flight_search_result where fromcityval='".$fromcityval_for_cache."' and tocityval='".$tocityval_for_cache."' and sd='".$sd_cache."' and ed='".$ed_cache."' and adults='".$adults_cache."' and childs='".$childs_cache."' and infants='".$infants_cache."' and journey_types='".$journey_types_cache."' and cabin_selected='".$cabin_selected_cache."' order by Total_FareAmount asc");
		if($query->num_rows() > 0)
			{
					$query1=$this->db->query($sql="select name from flight_search_result where fromcityval='".$fromcityval_for_cache."' and tocityval='".$tocityval_for_cache."' and sd='".$sd_cache."' and ed='".$ed_cache."' and adults='".$adults_cache."' and childs='".$childs_cache."' and infants='".$infants_cache."' and journey_types='".$journey_types_cache."' and cabin_selected='".$cabin_selected_cache."' group by name");
					$query2=$this->db->query($sql="select stops from flight_search_result where fromcityval='".$fromcityval_for_cache."' and tocityval='".$tocityval_for_cache."' and sd='".$sd_cache."' and ed='".$ed_cache."' and adults='".$adults_cache."' and childs='".$childs_cache."' and infants='".$infants_cache."' and journey_types='".$journey_types_cache."' and cabin_selected='".$cabin_selected_cache."' group by stops");
					$result['airlines']=$query1->result();
					$result['stops']=$query2->result();
					$result['search_result']=$query->result();
					return $result;
			}
			else return '';
	}
	function getFlightSearchResultmatrix($fromcityval_for_cache,$tocityval_for_cache,$sd_cache,$ed_cache,$adults_cache,$childs_cache,$infants_cache,$journey_types_cache,$cabin_selected_cache)
	{
		$query=$this->db->query($sql="select * from flight_search_result where fromcityval='".$fromcityval_for_cache."' and tocityval='".$tocityval_for_cache."' and sd='".$sd_cache."' and ed='".$ed_cache."' and adults='".$adults_cache."' and childs='".$childs_cache."' and infants='".$infants_cache."' and journey_types='".$journey_types_cache."' and cabin_selected='".$cabin_selected_cache."' group by name order by Total_FareAmount asc");
		if($query->num_rows() > 0)
			{
					//$query1=$this->db->query($sql="select name from flight_search_result where fromcityval='".$fromcityval_for_cache."' and tocityval='".$tocityval_for_cache."' and sd='".$sd_cache."' and ed='".$ed_cache."' and adults='".$adults_cache."' and childs='".$childs_cache."' and infants='".$infants_cache."' and journey_types='".$journey_types_cache."' and cabin_selected='".$cabin_selected_cache."' group by name");
					//$query2=$this->db->query($sql="select stops from flight_search_result where fromcityval='".$fromcityval_for_cache."' and tocityval='".$tocityval_for_cache."' and sd='".$sd_cache."' and ed='".$ed_cache."' and adults='".$adults_cache."' and childs='".$childs_cache."' and infants='".$infants_cache."' and journey_types='".$journey_types_cache."' and cabin_selected='".$cabin_selected_cache."' group by stops");
					//$result['airlines']=$query1->result();
					//$result['stops']=$query2->result();
					$result['search_result']=$query->result();
					return $result;
			}
			else return '';
	}
	function getFlightSearchResult($session_id,$akbar_session)
	{
			$query=$this->db->query($sql="select * from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' order by Total_FareAmount asc");
			if($query->num_rows() > 0)
			{
					$query1=$this->db->query($sql="select name from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' group by name");
					$query2=$this->db->query($sql="select stops from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' group by stops");
					$result['airlines']=$query1->result();
					$result['stops']=$query2->result();
					$result['search_result']=$query->result();
					return $result;
			}
			else return '';
	}
	function getFlightSearchResultmatrix_normal($session_id,$akbar_session)
	{
            $query=$this->db->query($sql="select * from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' group by name order by Total_FareAmount asc");
            if($query->num_rows() > 0)
            {
                            //$query1=$this->db->query($sql="select name from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' group by name");
                            //$query2=$this->db->query($sql="select stops from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' group by stops");
                            //$result['airlines']=$query1->result();
                            //$result['stops']=$query2->result();
                            $result['search_result']=$query->result();
                            return $result;
            }
            else return '';
	}
        
        function getFlightSearchResultmatrix_round($session_id,$akbar_session)
	{
            $query=$this->db->query($sql="select name,cicode,stops,Total_FareAmount from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and journey_type='Round_oneway' group by name order by Total_FareAmount asc");
            $query1=$this->db->query($sql="select name,cicode,stops,Total_FareAmount from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and journey_type='Round_return' group by name order by Total_FareAmount asc");
            if($query->num_rows() > 0)
            {
                $result['search_result_oneway']=$query->result();
                $result['search_result_round']=$query1->result();
                return $result;
            }
            else return '';
	}
        
	function getFlightSearchResultRound($session_id,$akbar_session)
	{
			$query=$this->db->query($sql="select * from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and journey_type='Round_oneway' order by Total_FareAmount asc");
			if($query->num_rows() > 0)
			{
					$query1=$this->db->query($sql="select name from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' group by name");
					$query2=$this->db->query($sql="select stops from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' group by stops");
					$result['airlines']=$query1->result();
					$result['stops']=$query2->result();
					$result['search_result']=$query->result();
					return $result;
			}
			else return '';
	}
	
	function getdeals()
	{
		 $que="select dealofday from  dealofday";
        $query= $this->db->query($que);
        if($query->num_rows() ==''){
                return '';
        }else{
                return $query->row();
        }
	}
	
	function getFlightDetails($id, $rand_id)
	{
			$query=$this->db->query($sql="select * from flight_search_result where id='".$id."' and rand_id='".$rand_id."'");
			if($query->num_rows() > 0)
			{
				$result=$query->row();
				return $result;
			}
			else return '';
	}
	function final_response_details_booking($data,$postdata,$adminMarkup,$paymentCharge,$totalPrice,$booking_id)
	{
		$originatorId = $data['originatorId'];
		$inHouseIdentification1 = $data['inHouseIdentification1'];
		$originatorTypeCode = $data['originatorTypeCode'];
		$companyId = $data['companyId'];
		$controlNumber = $data['controlNumber'];
		$date = $data['date'];
		$time = $data['time'];
		$typeOfPnrElement = $data['typeOfPnrElement'];
		//$agentId = $data['agentId'];
		$agentId = 0;
		$segmentNameDetails = $data['segmentNameDetails'];
		
		$result_id = $_SESSION['post']['result_id'];
		$rand_id = $_SESSION['post']['rand_id'];
		$user_title = $_SESSION['post']['user_title'];
		$user_fname = $_SESSION['post']['user_fname'];
		$user_lname = $_SESSION['post']['user_lname'];
		$user_address =  $_SESSION['post']['user_address'];
		$user_city = $_SESSION['post']['user_pincode'];
		$user_pincode = $_SESSION['post']['user_city'];
		$user_state = $_SESSION['post']['user_state'];
		$user_country = $_SESSION['post']['user_country'];
		$user_email = $_SESSION['post']['user_email'];
		$user_mobile = $_SESSION['post']['user_mobile'];
		$input = $_SESSION['post']['input'];
		$admin_markup = $adminMarkup;
		$payment_charge = $paymentCharge;
		$Total_pric = $totalPrice;
			
		$creation_date = date('Y-m-d');
		$user_type = 0;
		$status = 'New Booking';
		//echo "test"; exit;
		$data1 = array('originatorId'=>$originatorId,'inHouseIdentification1'=>$inHouseIdentification1,'originatorTypeCode'=>$originatorTypeCode,'companyId'=>$companyId,'PNR_Number'=>$controlNumber,'date'=>$date,'time'=>$time,'type'=>$typeOfPnrElement,'agent_id'=>$agentId,'result_id'=>$result_id,'rand_id'=>$rand_id,'title'=>$user_title,'fname'=>$user_fname,'lname'=>$user_lname,'address'=>$user_address,'city'=>$user_city,'zip'=>$user_pincode,'state'=>$user_state,'country'=>$user_country,'user_email'=>$user_email,'user_mobile'=>$user_mobile,'admin_markup'=>$admin_markup,'payment_charge'=>$payment_charge,'Total_pric'=>$Total_pric,'creation_date'=>$creation_date,'user_type'=>$user_type,'status'=>$status,'booking_id'=>$booking_id);
		//$this->db->insert('amadeus_flight_book_passengers',$data1);
		$this->db->where('booking_id',$_SESSION['post']['booking_id']);
		$this->db->update('amadeus_flight_book_passengers',$data1);
		$query=$this->db->query($sql="select * from amadeus_flight_book_passengers where booking_id='".$_SESSION['post']['booking_id']."'");
			if($query->num_rows() > 0)
			{
				$result=$query->row();
				
			}
			else return '';
			
		//$insert_id = $this->db->insert_id();
		 $insert_id = $result->psg_id; 
		for($i = 0; $i < count($segmentNameDetails); $i++)
		{
                        if(isset($segmentNameDetails[$i]['segmentName']))
                            $segmentName = $segmentNameDetails[$i]['segmentName'];
                        else $segmentName='';
                        
                        if(isset($segmentNameDetails[$i]['longFreetext']))
                            $longFreetext = $segmentNameDetails[$i]['longFreetext'];
                        else $longFreetext='';
                        
                        if(isset($segmentNameDetails[$i]['subjectQualifier']))
                            $subjectQualifier = $segmentNameDetails[$i]['subjectQualifier'];
                        else $subjectQualifier='';
                        
                        if(isset($segmentNameDetails[$i]['type']))
                            $type = $segmentNameDetails[$i]['type'];
                        else $type='';
                        
			$segarray = array('pnr_id'=>$insert_id,'segmentName'=>$segmentName,'longFreetext'=>$longFreetext,'subjectQualifier'=>$subjectQualifier,'type'=>$type);
			$this->db->insert('amadeus_book_segments',$segarray);
		}
		return $insert_id;
		
	}
        
        function final_response_details_booking_new($postdata,$adminMarkup,$paymentCharge,$totalPrice,$booking_id,$departureDate,$akbar_session,$gateway_type)
        {
                $result_id = $postdata['result_id'];
		$rand_id = $postdata['rand_id'];
		$user_title = $postdata['user_title'];
		$user_fname = $postdata['user_fname'];
		$user_lname = $postdata['user_lname'];
		$user_address =  $postdata['user_address'];
		$user_city = $postdata['user_pincode'];
		$user_pincode = $postdata['user_city'];
		$user_state = $postdata['user_state'];
		$user_country = $postdata['user_country'];
		$user_email = $postdata['user_email'];
		$user_mobile = $postdata['user_mobile'];
		$input = $postdata['input'];
		$admin_markup = $adminMarkup;
		$payment_charge = $paymentCharge;
		$Total_pric = $totalPrice;
			
		$creation_date = date('Y-m-d');
		$user_type = 0;
		$status = 'New Booking';
		$data1 = array('departure_date'=>$departureDate,'result_id'=>$result_id,'rand_id'=>$rand_id,'title'=>$user_title,'fname'=>$user_fname,'lname'=>$user_lname,'address'=>$user_address,'city'=>$user_city,'zip'=>$user_pincode,'state'=>$user_state,'country'=>$user_country,'user_email'=>$user_email,'user_mobile'=>$user_mobile,'admin_markup'=>$admin_markup,'payment_charge'=>$payment_charge,'Total_pric'=>$Total_pric,'creation_date'=>$creation_date,'user_type'=>$user_type,'status'=>$status,'booking_id'=>$booking_id,'akbar_session_id'=>$akbar_session,'gateway_type'=>$gateway_type);
		$this->db->insert('amadeus_flight_book_passengers',$data1);
                return $this->db->insert_id();
        }
        
        function final_response_details_booking_update($final_result,$booking_id)
        {
            $originatorId = $final_result['originatorId'];
            $inHouseIdentification1 = $final_result['inHouseIdentification1'];
            $originatorTypeCode = $final_result['originatorTypeCode'];
            $companyId = $final_result['companyId'];
            $controlNumber = $final_result['controlNumber'];
            $date = $final_result['date'];
            $time = $final_result['time'];
            $typeOfPnrElement = $final_result['typeOfPnrElement'];
            $segmentNameDetails = $final_result['segmentNameDetails'];
            $data = array('originatorId'=>$originatorId,'inHouseIdentification1'=>$inHouseIdentification1,'originatorTypeCode'=>$originatorTypeCode,'companyId'=>$companyId,'PNR_Number'=>$controlNumber,'date'=>$date,'time'=>$time,'type'=>$typeOfPnrElement);
            $this->db->where('booking_id',$booking_id);
            $this->db->update('amadeus_flight_book_passengers',$data);
            
            $query=$this->db->query($sql="select psg_id from amadeus_flight_book_passengers where booking_id='".$booking_id."'");
            $result=$query->row();
            return $result->psg_id;
        }
        
        
    function booking_airline_details($data,$pnr_id)
	{
		//echo '<pre />';print_r($data);die;
		$id = $data['id'];
		$session_id = $data['session_id'];
		$akbar_session = $data['akbar_session'];
		$journey_type = $data['journey_type'];
		$cicode = $data['cicode'];
		$name = $data['name'];
		$fnumber = $data['fnumber'];
		$dlocation =  $data['dlocation'];
		$alocation = $data['alocation'];
		$timeOfDeparture = $data['timeOfDeparture'];
		$timeOfArrival = $data['timeOfArrival'];
		$dateOfDeparture = $data['dateOfDeparture'];
		$dateOfArrival = $data['dateOfArrival'];
		$equipmentType =   $data['equipmentType'];
		$redeye =  $data['redeye'];
		$dtime_filter =  $data['dtime_filter'];
		$atime_filter =  $data['atime_filter'];
		$ddate =  $data['ddate'];
		$adate =  $data['adate'];
		$dep_date =  $data['dep_date'];
		$arv_date =  $data['arv_date'];
		$ddate1 =  $data['ddate1'];
		$adate1 =  $data['adate1'];
		$duration_final =  $data['duration_final'];
		$duration_final1 = $data['duration_final1'];
		$duration_final_eft =  $data['duration_final_eft'];
		$dur_in_min =  $data['dur_in_min'];
		$dur_in_min_layover  =  $data['dur_in_min_layover'];
		$duration_final_layover =  $data['duration_final_layover'];
		$flag_marketingCarrier =  $data['flag_marketingCarrier'];
		$FareAmount =  $data['FareAmount'];
		$TaxAmount =  $data['TaxAmount'];
		$pamount =  $data['pamount'];
		$fareType =  $data['fareType'];
		$ccode =  $data['ccode'];
		$designator =  $data['designator'];
		$stops  =  $data['stops'];
		$flag =  $data['flag'];
		$rand_id =  $data['rand_id'];
		$admin_markup =  $data['admin_markup'];
		$payment_charge =  $data['payment_charge'];
		$Total_FareAmount =  $data['Total_FareAmount'];
		$BookingClass =  $data['BookingClass'];
		$cabin =  $data['cabin'];
		$from_airport =  $data['from_airport'];
		$to_airport =  $data['to_airport'];
		$adult_count = $_SESSION['adults'];
		$child_count = $_SESSION['childs'];
		$infant_count = $_SESSION['infants'];
                $totalFareAmount_ADT=$data['Adult_FareAmount'];
                $totalFareAmount_CHD=$data['Child_FareAmount'];
                $totalFareAmount_INF=$data['Infant_FareAmount'];
                $totalTaxAmount_ADT=$data['Adult_TaxAmount'];
                $totalTaxAmount_CHD=$data['Child_TaxAmount'];
                $totalTaxAmount_INF=$data['Infant_TaxAmount'];
		$data1 = array('pnr_id'=>$pnr_id,'Result_id'=>$id,'session_id'=>$session_id,'akbar_session'=>$akbar_session,'journey_type'=>$journey_type,'airline_code'=>$cicode,'airline'=>$name,'fnumber'=>$fnumber,'dlocation'=>$dlocation,'alocation'=>$alocation,'timeOfDeparture'=>$timeOfDeparture,'timeOfArrival'=>$timeOfArrival,'dateOfDeparture'=>$dateOfDeparture,'dateOfArrival'=>$dateOfArrival,'equipmentType'=>$equipmentType,'redeye'=>$redeye,'dtime_filter'=>$dtime_filter,'atime_filter'=>$atime_filter,'ddate'=>$ddate,'adate'=>$adate,'dep_date'=>$dep_date,'arv_date'=>$arv_date,'ddate1'=>$ddate1,'adate1'=>$adate1,'duration_final'=>$duration_final,'duration_final1'=>$duration_final1,'duration_final_eft'=>$duration_final_eft,'dur_in_min'=>$dur_in_min,'dur_in_min_layover'=>$dur_in_min_layover,'duration_final_layover'=>$duration_final_layover,'flag_marketingCarrier'=>$flag_marketingCarrier,'totalFareAmount_Price'=>$FareAmount,'totalTaxAmount_Price'=>$TaxAmount,'pamount'=>$pamount,'fareType_ADT'=>$fareType,'curr_code'=>$ccode,'designator'=>$designator,'stops'=>$stops,'flag'=>$flag,'rand_id'=>$rand_id,'admin_markup'=>$admin_markup,'payment_charge'=>$payment_charge,'Total_price'=>$Total_FareAmount,'booking_class'=>$BookingClass,'cabin'=>$cabin,'from_airport'=>$from_airport,'to_airport'=>$to_airport,'count_ADT'=>$adult_count,'count_CHD'=>$child_count,'count_INF'=>$infant_count,
                    'totalFareAmount_ADT'=>$totalFareAmount_ADT,'totalFareAmount_CHD'=>$totalFareAmount_CHD,'totalFareAmount_INF'=>$totalFareAmount_INF,
                   'totalTaxAmount_ADT'=>$totalTaxAmount_ADT, 'totalTaxAmount_CHD'=>$totalTaxAmount_CHD,'totalTaxAmount_INF'=>$totalTaxAmount_INF);
		$this->db->insert('amadeus_flight_booking_details',$data1);
	}
	
	function bookingpassenger_details($data,$pnr_id,$adultfare= '',$adulttax= '',$childfare='',$childtax= '',$infantfare='',$infanttax='',$adminMarkup='',$paymentCharge='',$totalPrice='')
	{
		$internationalCheck = $data['internationalCheck'];
			if($data['internationalCheck'] == 'false')
			{
                          
				if(isset($data['saladult']))
				{
					for($i = 0; $i < count($data['saladult']); $i++)
					{
						$saladult1 = $data['saladult'][$i];
						$fnameadult = $data['fnameadult'][$i];
						$lnameadult = $data['lnameadult'][$i];
						$type = 'Adult';
						$final_id = 0;
						$data1 = array('salutation'=>$saladult1,'fname'=>$fnameadult,'lname'=>$lnameadult,'pnr_id'=>$pnr_id,'type'=>$type,'final_id'=>$final_id,'international_check'=>$internationalCheck,'fare'=>$adultfare,'tax'=>$adulttax);
						$this->db->insert('amadeus_flight_paasengers',$data1);
					}
				}
			
				if(isset($data['salchild']))
				{
					for($i = 0; $i < count($data['salchild']); $i++)
					{
						$salchild = $data['salchild'][$i];
						$fnamechild = $data['fnamechild'][$i];
						$lnamechild = $data['lnamechild'][$i];
						$adobchild = $data['adobchild'][$i];
						$type = 'Child';
						$final_id = 0;
						$data1 = array('salutation'=>$salchild,'fname'=>$fnameadult,'lname'=>$lnamechild,'pnr_id'=>$pnr_id,'type'=>$type,'adobchild'=>$adobchild,'final_id'=>$final_id,'international_check'=>$internationalCheck,'fare'=>$childfare,'tax'=>$childtax);
						$this->db->insert('amadeus_flight_paasengers',$data1);
					}
				}
				if(isset($data['salinfant']))
				{
					for($i = 0; $i < count($data['salinfant']); $i++)
					{
						$salinfant = $data['salinfant'][$i];
						$fnameinfant = $data['fnameinfant'][$i];
						$lnameinfant = $data['lnameinfant'][$i];
						$adobinfant = $data['adobinfant'][$i];
						$type = 'Infant';
						$final_id = 0;
						$data1 = array('salutation'=>$salinfant,'fname'=>$fnameinfant,'lname'=>$lnameinfant,'pnr_id'=>$pnr_id,'type'=>$type,'adobchild'=>$adobinfant,'final_id'=>$final_id,'international_check'=>$internationalCheck,'fare'=>$infantfare,'tax'=>$infanttax);
						$this->db->insert('amadeus_flight_paasengers',$data1);
					}
				}
			}
			else
			{
				if(isset($data['saladult']))
				{
					for($i = 0; $i < count($data['saladult']); $i++)
					{
                                            $saladult1 = $data['saladult'][$i];
                                            $fnameadult = $data['fnameadult'][$i];
                                            $lnameadult = $data['lnameadult'][$i];
                                            $type = 'Adult';
                                            $final_id = 0;
                                            $plname = $data['plname'][$i];
                                            $adobadult = $data['adobadult'][$i];
                                            $Pcountry = $data['Pcountry'][$i];
                                            $passportadult = $data['passportadult'][$i];
                                            $visaadult = $data['visaadult'][$i];
                                            $pexpiry = $data['pexpiry'][$i];
                                            $data1 = array('salutation'=>$saladult1,'fname'=>$fnameadult,'lname'=>$lnameadult,'pnr_id'=>$pnr_id,'type'=>$type,'final_id'=>$final_id,'plname'=>$plname,'adobchild'=>$adobadult,'Pcountry'=>$Pcountry,'passport'=>$passportadult,'visa'=>$visaadult,'pexpiry'=>$pexpiry,'international_check'=>$internationalCheck,'fare'=>$adultfare,'tax'=>$adulttax);
                                            $this->db->insert('amadeus_flight_paasengers',$data1);
					}
				}
			
				if(isset($data['salchild']))
				{
					for($i = 0; $i < count($data['salchild']); $i++)
					{
						$salchild = $data['salchild'][$i];
						$fnamechild = $data['fnamechild'][$i];
						$lnamechild = $data['lnamechild'][$i];
						$adobchild = $data['adobchild'][$i];
						$type = 'Child';
						$final_id = 0;
						$plnamechild = $data['plnamechild'][$i];
						$Pcountrychild = $data['Pcountrychild'][$i];
						$passportchild = $data['passportchild'][$i];
						$visachild = $data['visachild'][$i];
						$pexpirychild = $data['pexpirychild'][$i];
						$data1 = array('salutation'=>$salchild,'fname'=>$fnameadult,'lname'=>$lnamechild,'pnr_id'=>$pnr_id,'type'=>$type,'adobchild'=>$adobchild,'final_id'=>$final_id,'plname'=>$plnamechild,'Pcountry'=>$Pcountrychild,'passport'=>$passportchild,'visa'=>$visachild,'pexpiry'=>$pexpirychild,'international_check'=>$internationalCheck,'fare'=>$childfare,'tax'=>$childtax);
						$this->db->insert('amadeus_flight_paasengers',$data1);
					}
				}
				if(isset($data['salinfant']))
				{
					for($i = 0; $i < count($data['salinfant']); $i++)
					{
						$salinfant = $data['salinfant'][$i];
						$fnameinfant = $data['fnameinfant'][$i];
						$lnameinfant = $data['lnameinfant'][$i];
						$adobinfant = $data['adobinfant'][$i];
						$type = 'Infant';
						$final_id = 0;
						$plnameinfant = $data['plnameinfant'][$i];
						$Pcountryinfant = $data['Pcountryinfant'][$i];
						$passportinfant = $data['passportinfant'][$i];
						$visainfant = $data['visainfant'][$i];
						$pexpiryinfant = $data['pexpiryinfant'][$i];
						$data1 = array('salutation'=>$salinfant,'fname'=>$fnameinfant,'lname'=>$lnameinfant,'pnr_id'=>$pnr_id,'type'=>$type,'adobchild'=>$adobinfant,'final_id'=>$final_id,'plname'=>$plnameinfant,'Pcountry'=>$Pcountryinfant,'passport'=>$passportinfant,'visa'=>$visainfant,'pexpiry'=>$pexpiryinfant,'international_check'=>$internationalCheck,'fare'=>$infantfare,'tax'=>$infanttax);
						$this->db->insert('amadeus_flight_paasengers',$data1);
                                                
					}
				}
			}
                        $result_id = $data['result_id'];
			$rand_id = $data['rand_id'];
			$user_title = $data['user_title'];
			$user_fname = $data['user_fname'];
			$user_lname = $data['user_lname'];
			$user_address =  $data['user_address'];
			$user_city = $data['user_city'];
			$user_pincode = $data['user_pincode'];
			$user_state = $data['user_state'];
			$user_country = $data['user_country'];
			$user_email = $data['user_email'];
			$user_mobile = $data['user_mobile'];
			$input = $data['input'];
			$admin_markup = $adminMarkup;
			$payment_charge = $paymentCharge;
			$Total_pric = $totalPrice;
	}
	function getflightdetvoucher($id)
	{
            $query=$this->db->query($sql="select * from amadeus_flight_booking_details where pnr_id='".$id."'");
            if($query->num_rows() > 0)
            {
                    $result=$query->row();
                    return $result;
            }
            else return '';
	}
	function get_transaction_det($id)
	{
            $query=$this->db->query($sql="select * from amadeus_flight_book_passengers where psg_id='".$id."'");
            if($query->num_rows() > 0)
            {
                    $result=$query->row();
                    return $result;
            }
            else return '';
	}
	function getflightbookdet($id)
	{
            $query=$this->db->query($sql="select * from amadeus_flight_book_passengers where psg_id='".$id."'");
            if($query->num_rows() > 0)
            {
                    $result=$query->row();
                    return $result;
            }
            else return '';
	}
	function get_return_flightss($result_id)
	{
            $query=$this->db->query($sql="select * from amadeus_flight_book_passengers where result_id='".$result_id."' ORDER BY psg_id desc LIMIT 0,1");
            if($query->num_rows() > 0)
            {
                    $result=$query->row();
                    return $result;
            }
            else return '';
	}
	function get_airportname($code)
	{
		$query=$this->db->query($sql="select * from city_code_amadeus where city_code='".$code."'");
		if($query->num_rows() > 0)
		{
			$result=$query->row();
			return $result;
		}
		else return '';
	}
	function getall_passengers($id)
	{
		$query=$this->db->query($sql="select * from amadeus_flight_paasengers where pnr_id='".$id."'");
		if($query->num_rows() > 0)
		{
			$result=$query->result();
			return $result;
		}
		else return '';
	}
	function get_countries()
	{
		$query=$this->db->query($sql="select * from country");
		if($query->num_rows() > 0)
		{
			$result=$query->result();
			return $result;
		}
		else return '';
	}
	function get_return_flights($session_id,$akbar_session,$refid)
	{
		$query=$this->db->query($sql="select * from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and ref_id ='".$refid."' AND journey_type ='Round_return'");
		if($query->num_rows() > 0)
		{
			$result=$query->row();
			return $result;
		}
		else return '';
	}
	function insert_logs_security($akbar_session,$method,$requestfilename,$responsefilename,$type)
	{
		$data = array('akbar_session'=>$akbar_session,'method'=>$method,'requestfilename'=>$requestfilename,'responsefilename'=>$responsefilename,'type'=>$type);
		$this->db->insert('xml_logs',$data);
	}
	function check_user($user_email)
	{
		$query = $this->db->query("SELECT * FROM  master_customer WHERE emailid='$user_email'");
		//echo "SELECT * FROM  master_customer WHERE emailid='$user_email'";
        if($query->num_rows > 0)
        {
                return 1;
        }else{
               return 0;
        }
	}
	function insert_mastercustomer($user_email,$user_title,$user_fname,$user_lname,$user_address,$user_city,$user_state,$user_country,$user_mobile,$akbar_ref,$password)
	{
		$data = array('emailid'=>$user_email,'title'=>$user_title,'firstname'=>$user_fname,'lastname'=>$user_lname,'address'=>$user_address,'city'=>$user_city,'state'=>$user_state,'country'=>$user_country,'mobile'=>$user_mobile,'akbar_cus_id'=>$akbar_ref,'password'=>$password);
		$this->db->insert('master_customer',$data);
                $insert_id=$this->db->insert_id();
                return $insert_id;
	}
	function check_flights_available($fromcityval_for_cache,$tocityval_for_cache,$sd_cache,$ed_cache,$adults_cache,$childs_cache,$infants_cache,$journey_types_cache,$cabin_selected_cache)
	{
		$this->db->select('*');
		$this->db->from('flight_search_result');
		$this->db->where('fromcityval',$fromcityval_for_cache);
		$this->db->where('tocityval',$tocityval_for_cache);
		$this->db->where('sd',$sd_cache);
		$this->db->where('ed',$ed_cache);
		$this->db->where('adults',$adults_cache);
		$this->db->where('infants',$infants_cache);
		$this->db->where('journey_types',$journey_types_cache);
		$this->db->where('cabin_selected',$cabin_selected_cache);
		$query = $this->db->get();
		if($query->num_rows > 0)
        {
                return 1;
        }else{
               return 0;
        }
	}
	function get_exp_citycode($city1)
	{
		$query = $this->db->query("SELECT * FROM  expedia_destination_list WHERE Destination='$city1'");
		//echo "SELECT * FROM  expedia_destination_list WHERE emailid='$user_email'";
        if($query->num_rows > 0)
        {
                $result=$query->row();
				return $result;
        }else{
               return '';
        }
	}
	function get_contactdetails($emailid)
	{
		$query = $this->db->query("SELECT * FROM  master_customer WHERE emailid='$emailid'");
		//echo "SELECT * FROM  master_customer WHERE emailid='$emailid'";
        if($query->num_rows > 0)
        {
                $result=$query->row();
				return $result;
        }else{
               return '';
        }
	}
	function get_hotels()
        {
            $query=$this->db->query($sql="select * from api_hotel_detail_t ORDER BY temp_id desc LIMIT 0,2");
            if($query->num_rows() > 0)
            {
                    $result=$query->result();
                    return $result;
            }
            else return '';
        }
        function morning_rates($cicode,$session_id,$akbar_session)
        {
            //echo $sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '0500' AND timeOfDeparture <= '1200' AND cicode='$cicode' ORDER BY FareAmount LIMIT 0,1";die;
            $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '0500' AND timeOfDeparture <= '1200' AND cicode='$cicode' ORDER BY FareAmount LIMIT 0,1");
            if($query->num_rows() > 0)
            {
                    $result=$query->row();
                    return $result;
            }
            else return '';
        }
        function afternoon_rates($cicode,$session_id,$akbar_session)
        {
            $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '1200' AND timeOfDeparture <= '1900' AND cicode='$cicode' ORDER BY FareAmount LIMIT 0,1");
            if($query->num_rows() > 0)
            {
                    $result=$query->row();
                    return $result;
            }
            else return '';
        }
        function night_rates($cicode,$session_id,$akbar_session)
        {
            $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '1900' AND timeOfDeparture <= '2400' AND cicode='$cicode' ORDER BY FareAmount LIMIT 0,1");
            if($query->num_rows() > 0)
            {
                    $result=$query->row();
                    return $result;
            }
            else return '';
        }
        function midnight_rates($cicode,$session_id,$akbar_session)
        {
            $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '0100' AND timeOfDeparture <= '0500' AND cicode='$cicode' ORDER BY FareAmount LIMIT 0,1");
            if($query->num_rows() > 0)
            {
                    $result=$query->row();
                    return $result;
            }
            else return '';
        }
        
        function morning_rates_zerostop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                //echo $sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1";die;
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '0500' AND timeOfDeparture <= '1200' AND cicode='$cicode' AND stops='0' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '0500' AND timeOfDeparture <= '1200' AND cicode='$cicode' AND stops='0' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops=0
                    AND
                    a.timeOfDeparture>= '0500'
                    AND 
                    a.timeOfDeparture<= '1200'
                    AND 
                    a.cicode='".$cicode."'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        function afternoon_rates_zerostop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '1200' AND timeOfDeparture <= '1900' AND cicode='$cicode' AND stops='0' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '1200' AND timeOfDeparture <= '1900' AND cicode='$cicode' AND stops='0' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops=0
                    AND
                    a.timeOfDeparture>= '1200'
                    AND 
                    a.timeOfDeparture<= '1900'
                    AND 
                    a.cicode='".$cicode."'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        
        function night_rates_zerostop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '1900' AND timeOfDeparture <= '2400' AND cicode='$cicode' AND stops='0' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND timeOfDeparture >= '1900' AND timeOfDeparture <= '2400' AND cicode='$cicode' AND stops='0' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops=0
                    AND
                    a.timeOfDeparture>= '1900'
                    AND 
                    a.timeOfDeparture<= '2400'
                    AND 
                    a.cicode='".$cicode."'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        function midnight_rates_zerostop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=="OneWay")
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0100' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '0500' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='0' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0100' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '0500' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='0' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops=0
                    AND
                    a.timeOfDeparture>= '0100'
                    AND 
                    a.timeOfDeparture<= '0500'
                    AND 
                    a.cicode='".$cicode."'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        
        function morning_rates_onestop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                //echo $sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1";die;
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //echo $sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1";die;
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops=1  
                    AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(a.cicode,'<br>',1)='$cicode'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        function afternoon_rates_onestop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1200' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1900' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1200' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1900' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops=1  
                    AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '1200' AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '1900' AND SUBSTRING_INDEX(a.cicode,'<br>',1)='$cicode'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        function night_rates_onestop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1900' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '2400' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1900' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '2400' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                 $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops=1  
                    AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '1900' AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '2400' AND SUBSTRING_INDEX(a.cicode,'<br>',1)='$cicode'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        function midnight_rates_onestop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0100' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '0500' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0100' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '0500' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops=1  
                    AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '0100' AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '0500' AND SUBSTRING_INDEX(a.cicode,'<br>',1)='$cicode'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        
        
        function morning_rates_multistop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                //echo $sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1";die;
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops>'1' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                 //echo $sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1";die;
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops>'1' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops>1  
                    AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(a.cicode,'<br>',1)='$cicode'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        function afternoon_rates_multistop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1200' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1900' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops>'1' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1200' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1900' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops>'1' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops>1  
                    AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '1200' AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '1900' AND SUBSTRING_INDEX(a.cicode,'<br>',1)='".$cicode."'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        function night_rates_multistop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1900' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '2400' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops>'1' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1900' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '2400' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops>'1' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                 $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops>1  
                    AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '1900' AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '2400' AND SUBSTRING_INDEX(a.cicode,'<br>',1)='".$cicode."'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    //print_r($res);die;
                    
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        function midnight_rates_multistop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0100' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '0500' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops>'1' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                //$query=$this->db->query($sql="select Total_FareAmount,ref_id from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0100' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '0500' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops>'1' AND journey_type='Round_oneway' ORDER BY FareAmount LIMIT 0,1");
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' AND a.stops>1  
                    AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '0100' AND SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '0500' AND SUBSTRING_INDEX(a.cicode,'<br>',1)='".$cicode."'
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    //print_r($res);die;
                    
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
                
            }
        }
        
        
        function morning_rates_allstop($cicode,$session_id,$akbar_session,$type)
        {
            //echo $sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' AND stops='1' ORDER BY FareAmount LIMIT 0,1";die;
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."'
                        AND
                        CASE WHEN INSTR(`timeOfDeparture`, '<br>') > 0 THEN SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0500'
                        ELSE timeOfDeparture>= '0500'
                        END
                        AND 
                        CASE WHEN INSTR(`timeOfDeparture`, '<br>') > 0 THEN SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1200'
                        ELSE timeOfDeparture<= '1200'
                        END
                        AND 
                        CASE WHEN INSTR(`cicode`, '<br>') > 0 THEN SUBSTRING_INDEX(cicode,'<br>',1)='".$cicode."'
                        ELSE cicode='".$cicode."'
                        END
                        ORDER BY FareAmount LIMIT 0,1");
                
                        if($query->num_rows() > 0)
                        {
                                $result=$query->row();
                                return $result;
                        }
                        else return '';
            }
            else if($type=='Round')
            {
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway' 
                    AND
                    CASE WHEN INSTR(a.timeOfDeparture, '<br>') > 0 THEN SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '0500'
                    ELSE a.timeOfDeparture>= '0500'
                    END
                    AND 
                    CASE WHEN INSTR(a.timeOfDeparture, '<br>') > 0 THEN SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '1200'
                    ELSE a.timeOfDeparture<= '1200'
                    END
                    AND 
                    CASE WHEN INSTR(a.cicode, '<br>') > 0 THEN SUBSTRING_INDEX(a.cicode,'<br>',1)='".$cicode."'
                    ELSE a.cicode='".$cicode."'
                    END
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    //print_r($res);die;
                    
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
           
        }
        
        function afternoon_rates_allstop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."'
                        AND
                        CASE WHEN INSTR(`timeOfDeparture`, '<br>') > 0 THEN SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1200'
                        ELSE timeOfDeparture>= '1200'
                        END
                        AND 
                        CASE WHEN INSTR(`timeOfDeparture`, '<br>') > 0 THEN SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1900'
                        ELSE timeOfDeparture<= '1900'
                        END
                        AND 
                        CASE WHEN INSTR(`cicode`, '<br>') > 0 THEN SUBSTRING_INDEX(cicode,'<br>',1)='".$cicode."'
                        ELSE cicode='".$cicode."'
                        END
                        ORDER BY FareAmount LIMIT 0,1");
                //$query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1200' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '1900' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
               $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway'
                    AND
                    CASE WHEN INSTR(a.timeOfDeparture, '<br>') > 0 THEN SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '1200'
                    ELSE a.timeOfDeparture>= '1200'
                    END
                    AND 
                    CASE WHEN INSTR(a.timeOfDeparture, '<br>') > 0 THEN SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '1900'
                    ELSE a.timeOfDeparture<= '1900'
                    END
                    AND 
                    CASE WHEN INSTR(a.cicode, '<br>') > 0 THEN SUBSTRING_INDEX(a.cicode,'<br>',1)='".$cicode."'
                    ELSE a.cicode='".$cicode."'
                    END
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        
        function night_rates_allstop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."'
                        AND
                        CASE WHEN INSTR(`timeOfDeparture`, '<br>') > 0 THEN SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1900'
                        ELSE timeOfDeparture>= '1900'
                        END
                        AND 
                        CASE WHEN INSTR(`timeOfDeparture`, '<br>') > 0 THEN SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '2400'
                        ELSE timeOfDeparture<= '2400'
                        END
                        AND 
                        CASE WHEN INSTR(`cicode`, '<br>') > 0 THEN SUBSTRING_INDEX(cicode,'<br>',1)='".$cicode."'
                        ELSE cicode='".$cicode."'
                        END
                        ORDER BY FareAmount LIMIT 0,1");
                //$query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '1900' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '2400' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway'
                    AND
                    CASE WHEN INSTR(a.timeOfDeparture, '<br>') > 0 THEN SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '1900'
                    ELSE a.timeOfDeparture>= '1900'
                    END
                    AND 
                    CASE WHEN INSTR(a.timeOfDeparture, '<br>') > 0 THEN SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '2400'
                    ELSE a.timeOfDeparture<= '2400'
                    END
                    AND 
                    CASE WHEN INSTR(a.cicode, '<br>') > 0 THEN SUBSTRING_INDEX(a.cicode,'<br>',1)='".$cicode."'
                    ELSE a.cicode='".$cicode."'
                    END
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
            }
        }
        
        function midnight_rates_allstop($cicode,$session_id,$akbar_session,$type)
        {
            if($type=='OneWay')
            {
                $query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."'
                        AND
                        CASE WHEN INSTR(`timeOfDeparture`, '<br>') > 0 THEN SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0100'
                        ELSE timeOfDeparture>= '0100'
                        END
                        AND 
                        CASE WHEN INSTR(`timeOfDeparture`, '<br>') > 0 THEN SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '0500'
                        ELSE timeOfDeparture<= '0500'
                        END
                        AND 
                        CASE WHEN INSTR(`cicode`, '<br>') > 0 THEN SUBSTRING_INDEX(cicode,'<br>',1)='".$cicode."'
                        ELSE cicode='".$cicode."'
                        END
                        ORDER BY FareAmount LIMIT 0,1");
                //$query=$this->db->query($sql="select * from flight_search_result WHERE session_id='".$session_id."' AND akbar_session='".$akbar_session."' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) >= '0100' AND SUBSTRING_INDEX(timeOfDeparture,'<br>',1) <= '0500' AND SUBSTRING_INDEX(cicode,'<br>',1)='$cicode' ORDER BY FareAmount LIMIT 0,1");
                if($query->num_rows() > 0)
                {
                        $result=$query->row();
                        return $result;
                }
                else return '';
            }
            else if($type=='Round')
            {
                $query=$this->db->query($sql="SELECT a.id, a.cicode, a.name, a.ref_id, a.Total_FareAmount,a.timeOfDeparture, (

                    SELECT Total_FareAmount
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS price_round, (

                    SELECT ref_id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS ref_round, (

                    SELECT id
                    FROM flight_search_result AS b
                    WHERE a.ref_id = b.ref_id
                    AND b.session_id = '".$session_id."'
                    AND b.akbar_session = '".$akbar_session."'
                    AND b.journey_type = 'Round_return'
                    ) AS id_round
                    FROM flight_search_result AS a
                    WHERE a.session_id = '".$session_id."'
                    AND a.akbar_session = '".$akbar_session."'
                    AND a.journey_type = 'Round_oneway'
                    AND
                    CASE WHEN INSTR(a.timeOfDeparture, '<br>') > 0 THEN SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) >= '0100'
                    ELSE a.timeOfDeparture>= '0100'
                    END
                    AND 
                    CASE WHEN INSTR(a.timeOfDeparture, '<br>') > 0 THEN SUBSTRING_INDEX(a.timeOfDeparture,'<br>',1) <= '0500'
                    ELSE a.timeOfDeparture<= '0500'
                    END
                    AND 
                    CASE WHEN INSTR(a.cicode, '<br>') > 0 THEN SUBSTRING_INDEX(a.cicode,'<br>',1)='".$cicode."'
                    ELSE a.cicode='".$cicode."'
                    END
                    ORDER BY a.Total_FareAmount ASC , price_round ASC limit 0,1");
                
                if($query->num_rows() > 0)
                {
                    $res=$query->row();
                    $totalAmount=($res->Total_FareAmount+round($res->price_round,2));
                    $result=array('total_amount'=>$totalAmount);
                    return $result;
                }
                else return '';
                
            }
        }
        
        function check_promo_code($code)
        {
			 $query=$this->db->query($sql="select * from promocodes WHERE promo_code='".$code."'");
            if($query->num_rows() > 0)
            {
                    $result=$query->row();
                    return $result;
            }
            else return '';
	}
	/***** payment Gateway ******/
	function hdfc_payment_gateway($data,$booking_id)
    {
		//$this->db->insert('payment_gateway', $data); 
		$this->db->where('booking_id',$booking_id);
		$this->db->update('amadeus_flight_book_passengers', $data); 
		
		//return $this->db->insert_id();
	}
	
	function get_tran_details($mtrackid)
	{
		$this->db->select('amount,mtrackid,cardno,expyy,expmm,membername,cvv');
		//$this->db->from('payment_gateway');
		$this->db->from('amadeus_flight_book_passengers');
		$this->db->where('mtrackid',$mtrackid);
		$this->db->where('trackid_status','Yes');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
				$result=$query->row();
				return $result;
		}
		else return '';
	}
	
	function update_payment_gateway_status($data)
	{
		$mtrackid = $data['mtrackid'];
		unset($data['mtrackid']);
		//this->db->where('mtrackid', $mtrackid);
		$this->db->where('booking_id',$_SESSION['post']['booking_id']);
		//$this->db->update('payment_gateway', $data); 
		$this->db->update('amadeus_flight_book_passengers', $data); 
		//echo $this->db->last_query();
		
	}
	/***** End Payment Gateway ******/
    function insert_ebs($ReferenceNo,$TxnLogID,$CreatedOn,$RiskLevel,$RiskPercentage,$email,$status,$CardNumber,$card_cvv,$exp_month,$exp_year)
	{
		//$CreatedOn = date('Y-m-d');
		$cardtype = $this->input->post('card_type');
		$data = array('reference_no'=> mysql_real_escape_string($ReferenceNo),'TxnLogID'=> mysql_real_escape_string($TxnLogID),'created_on'=> mysql_real_escape_string($CreatedOn),'risk_level'=> mysql_real_escape_string($RiskLevel),'risk_percentage'=>$RiskPercentage,'email_id'=> mysql_real_escape_string($email),'status'=>$status,'cardno'=>$CardNumber,'cvv'=>$card_cvv,'expiry_mm'=>$exp_month,'expiry_yy'=>$exp_year,'cartdtype'=>$cardtype);
		$this->db->insert('customer_ebs',$data);
	}
	function check_ebs_validate($email,$cardno)
	{
		$query=$this->db->query($sql="select * from customer_ebs WHERE email_id='".$email."' AND cardno='".$cardno."' AND status='Whitelisted'");
		//echo $sql; exit;
        if($query->num_rows() > 0)
        {
           $result=$query->row();
           return $result;
        }
        else return '';
	}
        function insert_booking_id($data)
		{
			$booking_id = $data['booking_id'];
			$akbar_session_id = $data['akbar_session_id'];
			$this->db->insert('amadeus_flight_book_passengers', $data); 
		}  
        
        function getAllMarkups($depDt)
        {
            $query=$this->db->query($sql="select * from markup_airlines where date_from>='".$depDt."' and date_to<='".$depDt."'");
            if($query->num_rows()>0)
            {
                return $query->result();
            }
            else return '';
        }
		function invoice_insert($booking_id,$book_date,$dlocation,$alocation,$dateOfDeparture,$user_title,$user_fname,$user_lname,$fareType,$cabin,$cicode,$Adult_FareAmount,$Adult_TaxAmount,$Child_FareAmount,$Child_TaxAmount,$Infant_FareAmount,$Infant_TaxAmount,$gateway_type)
		{
			$sector = $dlocation."-".$alocation;
			$traveldate = $dateOfDeparture;
			$paxname = $user_title." ".$user_fname." ".$user_lname;
			
		}
}

?>
