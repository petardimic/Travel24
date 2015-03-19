<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);
session_start();
/*
 * Akbar Travels USA
 *  
 *
 * @package		Akbar Travels
 * @author		Provab Techonosoft Pvt. Ltd.
 * @copyright	Copyright (c) 2013 - 2014, Provabtechnosoft Pvt. Ltd.
 * @license		http://www.akbartravels.com/support/license-agreement
 * @link		http://www.akbartravels.com
 * 
 */

class Home extends Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Home_Model', 'home', true);
		//$this->load->model('car/Car_Model');
        $this->load->helper('home');
        if(!isset($_SESSION['akbar_session']) || $_SESSION['akbar_session']=='')
        {
            $_SESSION['akbar_session'] = date('ymd').rand(1, 999999);
        }
    }

    public function index() {
        $data['airports'] = $this->home->get_airports();
        $data['imp_airports'] = $this->home->get_imp_airports();
        $customer_id = $this->session->userdata('customer_id');
        if ($customer_id != '') {
            $data['custdet'] = $custdet = $this->home->getcustomerdet($customer_id);
        }
        $this->load->view('flight_index', $data);
    }

    public function flights() {
        $data['airports'] = $this->home->get_airports();
        $data['imp_airports'] = $this->home->get_imp_airports();
        $customer_id = $this->session->userdata('customer_id');
        if ($customer_id != '') {
            $data['custdet'] = $custdet = $this->home->getcustomerdet($customer_id);
        }
        $this->load->view('flight_index', $data);
    }

    public function hotels() {
        $customer_id = $this->session->userdata('customer_id');
        if ($customer_id != '') {
            $data['custdet'] = $custdet = $this->home->getcustomerdet($customer_id);
        }
        $this->load->view('hotel_index', $data);
    }

    function customers() {
        $this->load->view('customers');
    }

    function customer_det() {
        $this->load->view('customer_book_det');
    }

    public function cars() {
        $data['outs_city'] = $this->home->car_outstation_city();
        $data['duration'] = $this->home->get_durations();
        $data['local_city'] = $this->home->get_local_city();
        $customer_id = $this->session->userdata('customer_id');
        if ($customer_id != '') {
            $data['custdet'] = $custdet = $this->home->getcustomerdet($customer_id);
        }
		$data['countryy']=$countryy = $this->Car_Model->getcountryofres();
		$data['pickup_world'] = $this->home->pickup_world();
        $this->load->view('car_index', $data);
    }

    function get_destinations() {
        $source = $this->input->post('source');
        $outs_dest = $this->home->car_outstation_dest($source);
        echo '<select class="search_input_box" name="city_to" id="testtoinput">';
        if (isset($outs_dest)) {
            if ($outs_dest != '') {
                foreach ($outs_dest as $outc) {

                    echo '<option value=' . $outc->CityID . '>' . $outc->Name . '</option>';
                }
            }
        }
        echo "</select";
    }

    function get_destinations2() {
        $source = $this->input->post('source');
        $outs_dest = $this->home->car_outstation_dest($source);
        echo '<select class="search_input_box" name="city_to" id="testtoinput" style="width:160px;">';
        if (isset($outs_dest)) {
            if ($outs_dest != '') {
                foreach ($outs_dest as $outc) {

                    echo '<option value=' . $outc->CityID . '>' . $outc->Name . '</option>';
                }
            }
        }
        echo "</select";
    }

    public function packages() {
        $this->load->view('flight_index');
    }

    // Auto complete list for Hotel Cities
    public function hotels_city_auto_list() {
        if (isset($_GET['term'])) {
            $cityList = $this->home->getHotelsCityData($_GET['term']);
            $jsonData = array();
            if (!empty($cityList)) {
                foreach ($cityList as $list) {
                    $jsonData[] = array(
                        'value' => $list->Destination . ', ' . $list->Country,
                        'label' => $list->Destination . ', ' . $list->Country
                    );
                }
            } else {
                $jsonData[] = array(
                    'value' => '',
                    'label' => 'No Results Found'
                );
            }

            echo json_encode($jsonData);
        } else {
            echo 'No Results Found';
        }
    }

    public function getAdultChilds() {
        $roomCount = $_GET['count'];
        $showAdultChild = showAdultChildBox($roomCount); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showAdultChild
        ));
    }

    public function showChildAgeBox() {
        $childCount = $_GET['count'];
        $rm = $_GET['rm'];
        $showChild = showChildAgeBox($childCount, $rm); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showChild
        ));
    }

    public function getAdultChildsModifySearch() {
        $roomCount = $_GET['count'];
        $showAdultChild = showAdultChildBoxModify($roomCount); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showAdultChild
        ));
    }

    public function showChildAgeBoxModify() {
        $childCount = $_GET['count'];
        $rm = $_GET['rm'];
        $showChild = showChildAgeBoxModify($childCount, $rm); // showing adult child boxes from home helper function
        print json_encode(array(
            'total_result' => $showChild
        ));
    }

    public function package() {
        $data['package_countries'] = $this->home->getPackageCountries();
        $data['durations'] = $this->home->getDurations();
        $this->load->view('package_index', $data);
    }

    public function getpackages() {
        $country_id = $this->input->post('id');
        $aPackages = $this->home->getPackagesByCountry($country_id);
        $sHtml = '';
        if (!empty($aPackages)) {
            foreach ($aPackages as $key => $value) {
                $sHtml .= '<option>Select Package</option>';
                $sHtml .= '<option value=' . $value->holi_id . '>' . $value->package_name . '</option>';
            }
        } else {
            $sHtml .= '<option>Select Package</option>';
        }
        print json_encode(array(
            'result' => $sHtml
        ));
    }

    function register() {
        $data['country'] = $this->home->getPackageCountries();
        $this->load->view('customer/register', $data);
    }

    function b2creginsert() {
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email_id = $this->input->post('email_id');
        $pwfield = $this->input->post('pwfield');
        $phone = $this->input->post('phone');
        $postalcode = $this->input->post('postalcode');
        $country = $this->input->post('country');
        $city = $this->input->post('city');
        $addresss = $this->input->post('address');
        $akbar_ref = "akb" . rand(100, 100000);
        $this->home->b2creginsert($first_name, $last_name, $email_id, $pwfield, $phone, $postalcode, $country, $city, $addresss, $akbar_ref);
        redirect('home/regsuccess', 'refresh');
    }

    function regsuccess() {
        $data['flag'] = 1;
        $data['country'] = $this->home->getPackageCountries();
        $this->load->view('customer/register', $data);
    }

    function login($x = '') {
        $data['x'] = $x;
        $this->load->view('customer/login', $data);
    }

    function support() {
        $this->load->view('customer/support');
    }

    function b2clogincheck() {

        if ($this->input->post('email_id')) {
            $email_id = $this->input->post('email_id');
            $pass = $this->input->post('pwfield');
            $res = $this->home->b2clogincheck($email_id, $pass);
            if ($res) {
                $this->session->set_userdata(array('customer_id' => $res->id, 'cust_email' => $res->emailid));
                redirect('home/myprofile', 'refresh');
            } else {
                redirect('home/login/1', 'refresh');
            }
        }
    }

    function b2cforgotpwd() {
        $email_id = $this->input->post('email_id');
        $check_fwd_pwd = $this->home->check_fwd_pwd($email_id);
        $this->load->helper('mymail_helper');
        $fromEmail = 'test.akbartravels@gmail.com';
        $ccEmail = '';
        $subject = 'Forgot Password';
        $toEmail = $email_id;
        $msg = 'Dear ' . ucfirst($check_fwd_pwd->firstname) . ' ' . ucfirst($check_fwd_pwd->lastname) . ', <br/><br/>
				Per your request, we have retrieved your Akbartravels login details:<br/>
				Username:  ' . $email_id . '<br/>
				Password:  ' . $check_fwd_pwd->password . '<br/>
				If you wish to change your password, you may do so by logging into your Akbar Travels profile at:' . site_url() . '/home/forgotpassword<br/><br/>
				Best Regards,
				The Akbartravels Team';
        send_mail($toEmail, $fromName, $fromEmail, $ccEmail, $msg, $subject);
        redirect('home/forgotpassword/1', 'refresh');
    }

    function crmlogin() {
        
    }

    function mybooking() {
        $customer_id = $this->session->userdata('customer_id');
        $this->load->view('customer/mybooking');
    }

    function custlogout() {
        $this->session->set_userdata(array('customer_id' => '', 'cust_email' => ''));
		unset($_SESSION['user_email']);
		$_SESSION['user_email'] = '';
        redirect('home/index');
    }

    function check_sub() {
        $source = $this->input->post('source');
        if ($this->home->check_sub($source)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function myaccount() {
        //print_r($_POST);die;
        $data['fromdate'] = $fromdate = $this->input->post('from');
        $data['todate'] = $todate = $this->input->post('ed');
        $data['pnrno'] = $pnrno = $this->input->post('pnrno');
        $data['tripid'] = $tripid = $this->input->post('tripid');
        $customer_id = $this->session->userdata('customer_id');
        $data['custdet'] = $custdet = $this->home->getcustomerdet($customer_id);
        //echo $pnrno;die;
       if($fromdate!='')
       {
        $fdateArr=explode('-',$fromdate);
        $fdat=$fdateArr[2].'-'.$fdateArr[1].'-'.$fdateArr[0];
       }
       else $fdat='';
       if($fromdate!='')
       {
         $todate=explode('-',$todate);
         $tdat=$tdateArr[2].'-'.$tdateArr[1].'-'.$tdateArr[0];
       }
       else $tdat='';
        
        
        
        if ($fromdate != '' || $todate != '' || $pnrno != '' || $tripid != '') {
            $data['upcoming_bookings'] = $this->home->upcoming_mybookings_sort($custdet->emailid, $fdat, $tdat, $pnrno, $tripid);
        } else {
            $data['upcoming_bookings'] = $this->home->upcoming_mybookings($custdet->emailid);
        }

        if ($fromdate != '' || $todate != '' || $pnrno != '' || $tripid != '') {
            $data['recently_completed'] = $this->home->recent_mybookings_sort($custdet->emailid, $fdat, $tdat, $pnrno, $tripid);
        } else {
            $data['recently_completed'] = $this->home->recent_mybookings($custdet->emailid);
        }
        //$data['recently_bookings'] = $this->home->recently_mybookings($custdet->emailid);
        //echo '<pre>'; print_r($data);exit;
        $this->load->view('customer/myaccount', $data);
    }

    function forgotpassword($x = '') {
        $data['x'] = $x;
        $this->load->view('customer/forgotpassword', $data);
    }

    function check_fwd() {
        $source = $this->input->post('source');
        if ($this->home->check_fwd($source)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function myprofile() {
        $customer_id = $this->session->userdata('customer_id');
        $data['custdet'] = $this->home->getcustomerdet($customer_id);
        $this->load->view('customer/myprofile', $data);
    }

    function mycancellation() {
        $this->load->view('customer/mycancellation');
    }

    function search_itinerary() {
        $from = $this->input->post('from');
        $todate = $this->input->post('todate');
        $pnrno = $this->input->post('pnrno');
        $tripid = $this->input->post('tripid');
        $service_type = $this->input->post('service_type');
        $this->load->view('customer/myaccount');
    }

    function ticket_details($pnr,$dloca='',$aloc = '') {
        $customer_id = $this->session->userdata('customer_id');
        $data['custdet'] = $custdet = $this->home->getcustomerdet($customer_id);
        $data['ticket_details'] = $ticket_details = $this->home->ticket_details($pnr);
		//echo "<pre>"; print_r($ticket_details); exit;
        $data['pnr'] = $pnr;
        $data['passenger_details'] = $this->home->flight_passenger_details($ticket_details->pnr_id);
		$data['dloc']= $dloca;
		$data['aloc'] = $aloc;
        //echo '<pre>'; print_r($data);exit;
        $this->load->view('customer/ticket_details', $data);
    }
	function ticket_details2($pnr,$dloca='',$aloc = '') {
        $customer_id = $this->session->userdata('customer_id');
        $data['custdet'] = $custdet = $this->home->getcustomerdet($customer_id);
        $data['ticket_details'] = $ticket_details = $this->home->ticket_details2($pnr);
		$data['flight_details'] = $ticket_details = $this->home->flight_details($pnr);
        $data['pnr'] = $pnr;
        $data['passenger_details'] = $this->home->flight_passenger_details($ticket_details->pnr_id);
		$data['dloc']= $dloca;
		$data['aloc'] = $aloc;
       //echo '<pre>'; print_r($data);exit;
        $this->load->view('customer/ticket_details', $data);
    }
	
    function edit_profile() {
        $data['customer_id'] = $customer_id = $this->session->userdata('customer_id');
        $data['member_details'] = $this->home->member_details($customer_id);
        $data['country'] = $this->home->getPackageCountries();
        $this->load->view('customer/edit_profile', $data);
    }

    function edit_myprofile() {
        $customer_id = $this->session->userdata('customer_id');
        $title = $this->input->post('title');
        $firstname = mysql_real_escape_string($this->input->post('firstname'));
        $lastname = mysql_real_escape_string($this->input->post('lastname'));
        $address = mysql_real_escape_string($this->input->post('address'));
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $zip = $this->input->post('zip');
        $country = $this->input->post('country');
        $off_num = $this->input->post('off_num');
        $fax = $this->input->post('fax');
        $newsletter_signup = $this->input->post('newsletter_signup');
        $smsalert_signup = $this->input->post('smsalert_signup');
        $mobile = $this->input->post('mobile');
        $alt_number = $this->input->post('alt_number');
        $address = trim(mysql_real_escape_string($address));
        $address2 = trim(mysql_real_escape_string($this->input->post('address2')));
        $this->home->edit_myprofile($customer_id, $title, $firstname, $lastname, $address, $city, $state, $zip, $country, $off_num, $fax, $newsletter_signup, $smsalert_signup, $mobile, $alt_number, $address, $address2);
        redirect('home/edit_profile');
    }

    function change_pwd() {
        $data['customer_id'] = $customer_id = $this->session->userdata('customer_id');
        $data['member_details'] = $this->home->member_details($customer_id);
        $this->load->view('customer/change_pwd', $data);
    }

    function check_present_pwd() {
        $source = $this->input->post('source');
        if ($this->home->check_present_pwd($source)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function change_cust_pwd() {
        //echo '111';exit;
        $new_pwd = $this->input->post('new_pwd');
        $this->home->change_cust_pwd($new_pwd);
        redirect('home/myprofile');
    }

    function get_password() {
        $email = $this->input->post('source');
        $check_pwd = $this->home->check_password($email);
        if ($check_pwd == '') {
            echo "The email id is not registered with us";
        } else {
            $this->load->helper('mymail_helper');
            $fromEmail = 'test.akbartravels@gmail.com';
            $ccEmail = '';
            $subject = 'Forgot Password';
            $toEmail = $email_id;
            $msg = 'Dear ' . ucfirst($check_fwd_pwd->firstname) . ' ' . ucfirst($check_fwd_pwd->lastname) . ', <br/><br/>
					Per your request, we have retrieved your Akbartravels login details:<br/>
					Username:  ' . $email_id . '<br/>
					Password:  ' . $check_fwd_pwd->password . '<br/>
					<br/><br/>
					Best Regards,
					The Akbartravels Team';
            send_mail($toEmail, $fromName, $fromEmail, $ccEmail, $msg, $subject);
            echo 'Your Password has been sent!!!';
        }
    }

}

?>
