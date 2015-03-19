<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set("memory_limit",-1);
error_reporting(0);
session_start();
/*
 * Akbar Travels - Flight Controller
 *  
 *
 * @package		Akbar Travels
 * @author		Provab Technosoft Pvt. Ltd.
 * @copyright           Copyright (c) 2013 - 2014, Provabtechnosoft Pvt. Ltd.
 * @license		http://www.akbartravels.us/support/license-agreement
 * @link		http://www.akbartravels.us
 * 
 */

class Flights extends MX_Controller
{
	/******* START SET CREDENTIAL **********/
	private $base_currency;
	private $client_id;
	private $email;
	private $password;
	private $api_url;
	private $set_crediential;
	private $api_flag;
	/******* START SET CREDENTIAL **********/
    function __construct()
    {
        parent::__construct();		
        $this->load->model('Flights_Model');
        $this->load->model('home/Home_Model');
        $this->load->model('Expedia_Model');
        $this->get_credentials();
    }
    public function get_credentials()
    {
        $api='expedia';
        $authDetails=$this->Expedia_Model->getApiAuthDetails($api);
        if($authDetails!='')
        {
            $this->api_flag=true;
            $this->api_url=$authDetails->apiurl;
            $this->client_id = $authDetails->cid;
            $this->username = $authDetails->apiusername;
            $this->password = $authDetails->apipassword;
        }
        else
        {
            $this->api_flag=false;
        }
    }
    function index()
    {
        $displayLimitflight = 5;
        $data['cityArflight'] = $cityArflight = $this->Flights_Model->getAllCities($displayLimitflight);
        $this->load->view('flight_index',$data);
    }
    
    public function flights_city_auto_list()
    {		
		if(isset($_GET['term']))
		{
			$cityList = $this->Flights_Model->getFlightsCityData($_GET['term']);
			$jsonData = array();
			if(!empty($cityList)) 
			{				
				foreach($cityList as $list)
				{
					$airport = $list->city."-".$list->country.",".$list->city_code;
					$airport1 = $list->country."-".$list->city.",".$list->city_code;
					$airport2 = $list->city_code."-".$list->country.",".$list->city;
					if(count($airport)==1)
					{
						$aUsers=$airport;
					}
					if(count($airport1)==1)
					{
						$aUsers1=$airport1;
					}
					if(count($airport2)==1)
					{
						$aUsers2=$airport2;
					}
					$len = strlen($_GET['term']);
					if ((strtolower(substr(utf8_decode($aUsers),0,$len)) == $_GET['term']) || (strtolower(substr(utf8_decode($aUsers1),0,$len)) == $_GET['term']) || (strtolower(substr(utf8_decode($aUsers2),0,$len)) == $_GET['term']))
						$jsonData[] = array(
									'value'=> $aUsers,
									'label'=> $aUsers
								  );			
				}
			}
			else
			{
				$jsonData[] = array(
								'value'=> '',
								'label'=> 'No Results Found'
							  );					
			}

			echo json_encode($jsonData);
		}
		else
		{
			echo 'No Results Found';
		}
	}
      
    function search()
    {
		//print_r($_POST);die;
		$_SESSION['currency_value']	= 1;
		$_SESSION['currency'] = 'USD';
		$newdata = array(
		   'currency_value'  => 1,
		   'currency'  => 'USD'
		);
		$this->session->set_userdata($newdata);
		$_SESSION['session_id']=session_id();
		$this->form_validation->set_rules('from_city', 'Departure City', 'required|callback_alpha_city_validation');
		$this->form_validation->set_rules('to_city', 'Arival City', 'required|callback_alpha_city_validation');
		$this->form_validation->set_rules('sd', 'CheckIn', 'required|callback_date_validation');
		//if ($this->form_validation->run() == FALSE)
	   // {
		   //echo "hi"; exit;
			//$this->load->view('hotel_index');
	   // } 
		//else
	   // {
			
			 if ((isset($_POST['from_city'])) && (isset($_POST['to_city'])))
			 {
				
				$_SESSION['hashing_activate'] = '';

				$adult_count = $_POST['adult'];
				$child_count = $_POST['child'];
				$infant_count = $_POST['infant'];

			   // if ($infant_count > $adult_count) {
			   //     $this->load->view('hotel_index');
			  //  } //else if (($adult_count + $child_count) > 9) {
				 //   $this->load->view('hotel_index');
			   // }

		   //     if ($_POST['from_city'] == $_POST['include_city'] || $_POST['from_city'] == $_POST['exclude_city'] || $_POST['to_city'] == $_POST['include_city'] || $_POST['to_city'] == $_POST['exclude_city']) {
		   //         $this->load->view('hotel_index');
		   //     }

				
				$cabin_value = $_POST['cabin'];
				if ($cabin_value == "First, Supersonic")
					$cabin_code = "F";
				else if ($cabin_value == "Business")
					$cabin_code = "C";
				else if ($cabin_value == "Economic")
					$cabin_code = "Y";
				else if ($cabin_value == "Premium Economy")
					$cabin_code = "W";
				else if ($cabin_value == "Standard Economy")
					$cabin_code = "M";
				else
					$cabin_code = "All";

				if (isset($_POST['cabin_type'])) {
					$cabin_type_value = $_POST['cabin_type'];
					if ($cabin_type_value == "Mandatory cabin")
						$cabin_type = "";
					else if ($cabin_type_value == "Recommended cabin")
						$cabin_type = "RC";
					else if ($cabin_type_value == "Major cabin")
						$cabin_type = "MC";
				}
				else
					$cabin_type = "";

				if (isset($_POST['hours']))
					$hours_connect_point = $_POST['hours'];
				else
					$hours_connect_point = '';
				if (isset($_POST['mins']))
					$min_connect_point = $_POST['mins'];
				else
					$min_connect_point = '';

				$_SESSION['fromcityval'] = $_POST['from_city'];
				$_SESSION['tocityval'] = $_POST['to_city'];

				if (isset($_POST['include_city']))
					$_SESSION['include_city'] = $_POST['include_city'];
				else
					$_SESSION['include_city'] = "";

				if (isset($_POST['exclude_city']))
					$_SESSION['exclude_city'] = $_POST['exclude_city'];
				else
					$_SESSION['exclude_city'] = "";


				if (isset($_POST['daterange']))
					$daterange = $_POST['daterange'];
				else
					$daterange = '';

				if (isset($_POST['slice_dice']))
					$slice_dice = $_POST['slice_dice'];
				else
					$slice_dice = '';

				if (isset($_POST['nonstop']))
					$nonstop = $_POST['nonstop'];
				else
					$nonstop = '';
				
				if(isset($_POST['ed'])) $ed=$_POST['ed'];else $ed='';
				$_SESSION['sd'] = $_POST['sd'];
				$_SESSION['ed'] = $ed;
				$_SESSION['adults'] = $adult_count;
				$_SESSION['childs'] = $child_count;
				$_SESSION['infants'] = $infant_count;
				$_SESSION['journey_type'] = $_POST['journey_type'];
				$_SESSION['cabin'] = $cabin_code;
				$_SESSION['cabin_type'] = $cabin_type;
				$_SESSION['hours_connect_point'] = $hours_connect_point;
				$_SESSION['min_connect_point'] = $min_connect_point;
				$_SESSION['daterange'] = $daterange;
				$_SESSION['slice_dice'] = $slice_dice;
				$_SESSION['nonstop'] = $nonstop;

				if (isset($_POST['hours_time']))
					$_SESSION['hours_time'] = $_POST['hours_time'];
				else
					$_SESSION['hours_time'] = '';

				if (isset($_POST['hours_time']))
					$_SESSION['mins_time'] = $_POST['mins_time'];
				else
					$_SESSION['mins_time'] = '';

				if (isset($_POST['time_qualifier']))
					$_SESSION['time_qualifier'] = $_POST['time_qualifier'];
				else
					$_SESSION['time_qualifier'] = '';

				if (isset($_POST['time_interval']))
					$_SESSION['time_interval'] = $_POST['time_interval'];
				else
					$_SESSION['time_interval'] = '';



				if ($_POST['journey_type'] == "OneWay") {
					$_SESSION['way_type'] = 1;
				}
				if ($_POST['journey_type'] == "Round") {
					$_SESSION['way_type'] = 2;
				} else if ($_POST['journey_type'] == "MultiCity") {
					$_SESSION['way_type'] = 3;
				} else if ($_POST['journey_type'] == "Calendar") {
					$_SESSION['way_type'] = 4;
				}

				if (isset($_POST['m_fromc']))
					$_SESSION['multi_city_dlist'] = $_POST['m_fromc'];
				else
					$_SESSION['multi_city_dlist'] = '';

				if (isset($_POST['m_toc']))
					$_SESSION['multi_city_alist'] = $_POST['m_toc'];
				else
					$_SESSION['multi_city_alist'] = '';

				if (isset($_POST['m_sdt']))
					$_SESSION['multi_city_datelist'] = $_POST['m_sdt'];
				else
					$_SESSION['multi_city_datelist'] = '';

				$city_pair_count=((count($_SESSION['multi_city_datelist']))+1);
				$_SESSION['city_pair_count']=$city_pair_count;

				if (isset($_POST['dradius']))
					$_SESSION['dradius'] = $_POST['dradius'];
				else
					$_SESSION['dradius'] = '';

				if (isset($_POST['dradius']))
					$_SESSION['dradius'] = $_POST['dradius'];
				else
					$_SESSION['dradius'] = '';

				if (isset($_POST['aradius']))
					$_SESSION['aradius'] = $_POST['aradius'];
				else
					$_SESSION['aradius'] = '';
				
				$fromCity=explode('-',$_SESSION['fromcityval']);
				$toCity=explode('-',$_SESSION['tocityval']);
				$_SESSION['fromCity']=$data['fromCity']=$fromCity[0];
				$_SESSION['toCity']=$data['toCity']=$toCity[0];
				$api = "amadeus";
				$api_f = "$api";
				$data['api_fs'] = $api_f;
				//echo $_SESSION['hours_time'];echo $_SESSION['mins_time'];exit;
				// exit;
				//echo "<pre/>Session Details: ";print_r($_POST);exit;//echo "<br/>Data : ";print_r($data);exit;
				
				$this->session->set_userdata(array('fromcityval'=>$_POST['from_city'],'tocityval'=>$_POST['to_city'],'sd'=>$_POST['sd'],'ed'=>$_POST['ed'],'adults'=>$adult_count,'childs'=>$child_count,'infants'=>$infant_count,'journey_types'=>$_POST['journey_type'],'cabin_selected'=>$_POST['cabin']));
				
				if (($_SESSION['journey_type'] == "Round"))
				{
					$this->load->view('flights/search_result_round', $data);
				}
				else if ((($_SESSION['journey_type'] == "MultiCity")))
				{
					 $this->load->view('flights/search_result_multi', $data);
				} 
				else if (($_SESSION['journey_type'] == "Calendar"))
				{
					$this->load->view('flights/search_result', $data);
				}
				else
				{
					$this->load->view('flights/search_result_oneway', $data);
				}
			}
			else
			{
				$displayLimitflight	= 5;
				$data['cityArflight'] = $cityArflight = $this->Flights_Model->getAllCities($displayLimitflight);
				$this->load->view('home/flight_index');
			}
	   // }
	}
	
	function call_api($api)
    {
        $_SESSION['hashing_activate'] = '';
        if ($_SESSION['hashing_activate'] != 1) {
            switch ($api) {
                case 'amadeus':
                    $rand_id = md5(time() . rand() . crypt(time()));
                    $_SESSION['Rand_id'] = $rand_id;
                    $_SESSION[$rand_id]['fromcityval'] = $_SESSION['fromcityval'];
                    $_SESSION[$rand_id]['tocityval'] = $_SESSION['tocityval'];
                    $_SESSION[$rand_id]['include_city'] = $_SESSION['include_city'];
                    $_SESSION[$rand_id]['exclude_city'] = $_SESSION['exclude_city'];
                    $_SESSION[$rand_id]['sd'] = $_SESSION['sd'];
                    $_SESSION[$rand_id]['ed'] = $_SESSION['ed'];
                    $_SESSION[$rand_id]['adults'] = $_SESSION['adults'];
                    $_SESSION[$rand_id]['childs'] = $_SESSION['childs'];
                    $_SESSION[$rand_id]['infants'] = $_SESSION['infants'];
                    $_SESSION[$rand_id]['journey_type'] = $_SESSION['journey_type'];
                    $_SESSION[$rand_id]['way_type'] = $_SESSION['way_type'];
                    $_SESSION[$rand_id]['cabin'] = $_SESSION['cabin'];
                    $_SESSION[$rand_id]['cabin_type'] = $_SESSION['cabin_type'];
                    $_SESSION[$rand_id]['hours_connect_point'] = $_SESSION['hours_connect_point'];
                    $_SESSION[$rand_id]['min_connect_point'] = $_SESSION['min_connect_point'];
                    $_SESSION[$rand_id]['daterange'] = $_SESSION['daterange'];
                    $_SESSION[$rand_id]['slice_dice'] = $_SESSION['slice_dice'];
                    $_SESSION[$rand_id]['nonstop'] = $_SESSION['nonstop'];
                    $_SESSION[$rand_id]['hours_time'] = $_SESSION['hours_time'];
                    $_SESSION[$rand_id]['mins_time'] = $_SESSION['mins_time'];
                    $_SESSION[$rand_id]['time_qualifier'] = $_SESSION['time_qualifier'];
                    $_SESSION[$rand_id]['time_interval'] = $_SESSION['time_interval'];
                    $_SESSION[$rand_id]['dradius'] = $_SESSION['dradius'];
                    $_SESSION[$rand_id]['aradius'] = $_SESSION['aradius'];
                    $_SESSION[$rand_id]['multi_city_datelist'] = $_SESSION['multi_city_datelist'];
                    $_SESSION[$rand_id]['multi_city_dlist'] = $_SESSION['multi_city_dlist'];
                    $_SESSION[$rand_id]['multi_city_alist'] = $_SESSION['multi_city_alist'];
                    $this->get_flight_availabilty($rand_id);
                    break;
                default: echo '';
            }
        }
    }
    
    function create_file()
	{
		//$ourFileName = "testFile.txt";
		//$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
		$myFile = "testFile.txt";
		$fh = fopen($myFile, 'w') or die("can't open file");
		$stringData = "Bobby Bopper\n";
		fwrite($fh, $stringData);
		$stringData = "Tracy Tanner\n";
		fwrite($fh, $stringData);
		fclose($fh);
		//fclose($ourFileHandle);
	}
	function cancel_policy()
	{
		$session_flag = 'true';
		if ($session_flag == "true") {
            $Security_Auth = '<?xml version="1.0" encoding="utf-8"?>
							<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
							xmlns:vls="http://xml.amadeus.com/VLSSLQ_06_1_1A">
							<soapenv:Header></soapenv:Header>
								<soapenv:Body>
								<Security_Authenticate> 
								  <userIdentifier>
									<originIdentification>
									  <sourceOffice>LGA1S211T</sourceOffice>
									</originIdentification>
									<originatorTypeCode>U</originatorTypeCode>
									<originator>WSAKBATO</originator>
								  </userIdentifier>
								  <dutyCode>
									<dutyCodeDetails>
									  <referenceQualifier>DUT</referenceQualifier>
									  <referenceIdentifier>SU</referenceIdentifier>
									</dutyCodeDetails>
								  </dutyCode>
								  <systemDetails>
									<organizationDetails>
									  <organizationId>NMC-US</organizationId>
									</organizationDetails>
								  </systemDetails>
								  <passwordInfo>
									<dataLength>8</dataLength>
									<dataType>E</dataType>
									<binaryData>ZXVXRnVoa2g=</binaryData>
								  </passwordInfo>
								</Security_Authenticate>         
							  </soapenv:Body>
							</soapenv:Envelope>';

            //$URL2 = "https://test.webservices.amadeus.com";
            $URL2 = "https://production.webservices.amadeus.com";
            $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/VLSSLQ_06_1_1A";

            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $URL2);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
            curl_setopt($ch2, CURLOPT_HEADER, 0);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, $Security_Auth);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

            /* $httpHeader2 = array(
              "Content-Type: text/xml; charset=UTF-8",
              "Content-Encoding: UTF-8"
              ); */

            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");

            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

            // Execute request, store response and HTTP response code
            $data2 = curl_exec($ch2);
            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
            curl_close($ch2);
            if (!empty($data2)) {
                $xml = new DOMDocument();
                $xml->loadXML($data2);
                $authSessionId=$xml->getElementsByTagName("SessionId")->item(0)->nodeValue;
                $explodeId=explode('|',$authSessionId);
                $SessionId = $explodeId[0];
                $SequenceNumber=$explodeId[1];
                $SecurityToken='';
                //$SequenceNumber = $xml->getElementsByTagName("SequenceNumber")->item(0)->nodeValue;
                //$SecurityToken = $xml->getElementsByTagName("SecurityToken")->item(0)->nodeValue;

                $no = (count($_SESSION['amadeus']));
                $time = time();
                $_SESSION['amadeus'][$no]['SessionId'] = $SessionId;
                $_SESSION['amadeus'][$no]['SequenceNumber'] = $SequenceNumber;
                $_SESSION['amadeus'][$no]['SecurityToken'] = $SecurityToken;
                $_SESSION['amadeus'][$no]['SessionStatus'] = "true";
                $_SESSION['amadeus'][$no]['SessionTime'] = $time;
                $sess_id = $no;
            }
			
        }
			
		$xml = '<?xml version="1.0" encoding="utf-8"?>
                                                <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                        <soapenv:Header>
																  <SessionId>' . $_SESSION['amadeus'][$no]['SessionId'] . '</SessionId>
																  <SequenceNumber>' . $_SESSION['amadeus'][$no]['SequenceNumber'] . '</SequenceNumber>
                                                        </soapenv:Header>
                                                        <soapenv:Body><Fare_CheckRules xmlns="http://xml.amadeus.com/FARQNQ_07_1_1A" >
															<msgType>
															<messageFunctionDetails>
															<messageFunction>712</messageFunction>
															</messageFunctionDetails>
															</msgType>
															<itemNumber>
															<itemNumberDetails>
															<number>1</number>
															</itemNumberDetails>
															</itemNumber>
															<fareRule>
															<tarifFareRule>
															<ruleSectionId>AP</ruleSectionId>
															</tarifFareRule>
															</fareRule>
															</Fare_CheckRules></soapenv:Body>
                                                     </soapenv:Envelope>';
													 echo $xml; 
							$URL2 = "https://production.webservices.amadeus.com";
                            $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/VLSSLQ_06_1_1A";
                            $ch2 = curl_init();
                            curl_setopt($ch2, CURLOPT_URL, $URL2);
                            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                            curl_setopt($ch2, CURLOPT_HEADER, 0);
                            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch2, CURLOPT_POST, 1);
                            curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml);
                            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                            // Execute request, store response and HTTP response code
                            $data2 = curl_exec($ch2);
                            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                            curl_close($ch2);
							echo $data2;
	}
    
    function get_flight_availabilty($rand_id)
    {
		//echo "<pre>"; print_r($_SESSION); exit;
		$fromcityval_for_cache = $this->session->userdata('fromcityval');
		$tocityval_for_cache  = $this->session->userdata('tocityval');
		$sd_cache1 = $this->session->userdata('sd');
		$sd_cache2 = explode('-',$sd_cache1);
		$sd_cache = $sd_cache2[2]."-".$sd_cache2[1]."-".$sd_cache2[0];
		$ed_cache1 = $this->session->userdata('ed');
		$ed_cache2 = explode('-',$ed_cache1);
		$ed_cache = $ed_cache2[2]."-".$ed_cache2[1]."-".$ed_cache2[0];
		$adults_cache = $this->session->userdata('adults');
		$childs_cache = $this->session->userdata('childs');
		$infants_cache = $this->session->userdata('infants');
		$journey_types_cache = $this->session->userdata('journey_types');
		$cabin_selected_cache = $this->session->userdata('cabin_selected');
		$checked = $this->Flights_Model->check_flights_available($fromcityval_for_cache,$tocityval_for_cache,$sd_cache,$ed_cache,$adults_cache,$childs_cache,$infants_cache,$journey_types_cache,$cabin_selected_cache);
		if($checked == 0)
		{		
		$fromcityval = $_SESSION['fromcityval'];
		$tocityval = $_SESSION['tocityval'];
		$sd = $_SESSION['sd'];
		$ed = $_SESSION['ed'];
		$adults = $_SESSION['adults'];
		$childs = $_SESSION['childs'];
		$infants = $_SESSION['infants'];
		$journey_type = $_SESSION['journey_type'];
		$cabin_selected = $_SESSION['cabin'];
		
		$session_id=$_SESSION['session_id'];
		$SessionId = "";
        $SequenceNumber = "";
        $SecurityToken = "";
        $session_flag = "true";
        $sess_id = '';

        $this->db->select('*');
        $this->db->from('session_amadeus');
        $this->db->where('Active', 'Active');
        $query = $this->db->get();

        if ($query->num_rows() == 0)
            $result_query = '';
        else
            $result_query = $query->result();

        //echo '<pre/>dfsdfs';print_r($result_query);exit;

        if (!isset($result_query[0])) {
            $session_flag = "true";
        } else {
            
            $no = (count($result_query));
            if ($no <= 1) {
               
                if (isset($result_query[($no - 1)])) {
                    $SessionStatus = $result_query[($no - 1)]->Query_In_Progress;
                    if ($SessionStatus == "NO") {
                        $time = time();
                        $SessionTime = $result_query[($no - 1)]->Last_Query_Time;
                        if (($time - $SessionTime) < 780) {
                            $SessionId = $result_query[($no - 1)]->Session_Number;
                            $SequenceNumber = (($result_query[($no - 1)]->Sequence_Number) + 1);
                            $SecurityToken = (($result_query[($no - 1)]->Security_Token));
                            //$result_query['SessionStatus']="false";
                            //$result_query['Last_Query_Time']=$time;
                            //$result_query['Sequence_Number']=$SequenceNumber;
                            $session_flag = "false";
                            $sess_id = ($no - 1);
                            $this->db->query("UPDATE session_amadeus SET Query_In_Progress='YES', Last_Query_Time='$time', Sequence_Number='$SequenceNumber'  WHERE Session_Number='$SessionId'");
                        } else {
                            $SessionId = $result_query[($no - 1)]->Session_Number;
                            $SequenceNumber = (($result_query[($no - 1)]->Sequence_Number) + 1);
                            $SecurityToken = (($result_query[($no - 1)]->Security_Token));
                            $sess_id = ($no - 1);

                            $Security_SignOut = '<?xml version="1.0" encoding="utf-8"?>
                                                <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                        <soapenv:Header>
																  <SessionId>' . $SessionId . '</SessionId>
																  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                        </soapenv:Header>
                                                        <soapenv:Body>
                                                                <Security_SignOut xmlns="http://xml.amadeus.com/VLSSLQ_06_1_1A">
                                                                </Security_SignOut>
                                                        </soapenv:Body>
                                                 </soapenv:Envelope>';

                            $URL2 = "https://production.webservices.amadeus.com";
                            $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/VLSSLQ_06_1_1A";
                            $ch2 = curl_init();
                            curl_setopt($ch2, CURLOPT_URL, $URL2);
                            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                            curl_setopt($ch2, CURLOPT_HEADER, 0);
                            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch2, CURLOPT_POST, 1);
                            curl_setopt($ch2, CURLOPT_POSTFIELDS, $Security_SignOut);
                            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                            // Execute request, store response and HTTP response code
                            $data2 = curl_exec($ch2);
                            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                            curl_close($ch2);

                            $session_flag = "true";
                            $this->db->query("UPDATE session_amadeus SET Active='InActive' WHERE Session_Number='$SessionId'");
                            //unset($_SESSION['amadeus'][($no-1)]);
							
							$myFile = $_SESSION['akbar_session']."security_xml.txt";
							$fh = fopen($myFile, 'w') or die("can't open file");
							$stringData = "Security Authentication XML Request <br /><br />".$Security_SignOut;
							fwrite($fh, $stringData);
							$stringData = "Security Authentication XML Response <br /><br />".$data2;
							fwrite($fh, $stringData);
							fclose($fh);
							
                        }
                    } else {
                        $session_flag = "true";
                    }
                } else {
                    $session_flag = "true";
                }
            } else {
                 
                for ($s = 0; $s < $no; $s++) {
                    if (isset($result_query[$s])) {
                        
                        //echo '<pre/>';print_r( $_SESSION['amadeus'][$s]);
                        $SessionStatus = $result_query[$s]->Query_In_Progress;
                        //echo $SessionStatus;
                        if ($SessionStatus == "NO") {
                            
                            $time = time();
                            $SessionTime = $result_query[$s]->Last_Query_Time;
                            //echo $SessionTime." - ".($time - $SessionTime);
                            if (($time - $SessionTime) < (780)) {
                                $SessionId = $result_query[$s]->Session_Number;
                                $SequenceNumber = (($result_query[$s]->Sequence_Number) + 1);
                                $SecurityToken = (($result_query[$s]->Security_Token));
                                //$_SESSION['amadeus'][$s]['SessionStatus']="false";
                                //$_SESSION['amadeus'][$s]['SequenceNumber']=$SequenceNumber; 
                                //$_SESSION['amadeus'][$s]['SessionTime']=$time;
                                $session_flag = "false";
                                $sess_id = $s;
                                $this->db->query("UPDATE session_amadeus SET Query_In_Progress='YES', Last_Query_Time='$time', Sequence_Number='$SequenceNumber'  WHERE Session_Number='$SessionId'");
                                break;
                            } else {
                                $SessionId = $result_query[$s]->Session_Number;
                                $SequenceNumber = (($result_query[$s]->Sequence_Number) + 1);
                                $SecurityToken = (($result_query[$s]->Security_Token));
                                $sess_id = ($no - 1);

                                $Security_SignOut = '<?xml version="1.0" encoding="utf-8"?>
                                                    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                            <soapenv:Header>
                                                                                      <SessionId>' . $SessionId . '</SessionId>
                                                                                      <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                            </soapenv:Header>
                                                            <soapenv:Body>
                                                                    <Security_SignOut xmlns="http://xml.amadeus.com/VLSSLQ_06_1_1A">
                                                                    </Security_SignOut>
                                                            </soapenv:Body>
                                                     </soapenv:Envelope>';

                                $URL2 = "https://production.webservices.amadeus.com";
                                $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/VLSSLQ_06_1_1A";


                                $ch2 = curl_init();
                                curl_setopt($ch2, CURLOPT_URL, $URL2);
                                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                curl_setopt($ch2, CURLOPT_HEADER, 0);
                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch2, CURLOPT_POST, 1);
                                curl_setopt($ch2, CURLOPT_POSTFIELDS, $Security_SignOut);
                                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                // Execute request, store response and HTTP response code
                                $data2 = curl_exec($ch2);
                                $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                curl_close($ch2);
                                $this->db->query("UPDATE session_amadeus SET Active='InActive' WHERE Session_Number='$SessionId'");
                                //unset($_SESSION['amadeus'][$s]);
                                $session_flag = "true";
								
								$myFile = $_SESSION['akbar_session']."security_xml.txt";
								$fh = fopen($myFile, 'w') or die("can't open file");
								$stringData = "Security Authentication XML Request <br /><br />".$Security_SignOut;
								fwrite($fh, $stringData);
								$stringData = "Security Authentication XML Response <br /><br />".$data2;
								fwrite($fh, $stringData);
								fclose($fh);
							
							
                            }
                        }
                    }
                }
            }
        }

        //echo $session_flag;exit;
        if ($session_flag == "true") {
            
            $Security_Auth = '<?xml version="1.0" encoding="utf-8"?>
							<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
							xmlns:vls="http://xml.amadeus.com/VLSSLQ_06_1_1A">
							<soapenv:Header></soapenv:Header>
								<soapenv:Body>
								<Security_Authenticate> 
								  <userIdentifier>
									<originIdentification>
									  <sourceOffice>LGA1S211T</sourceOffice>
									</originIdentification>
									<originatorTypeCode>U</originatorTypeCode>
									<originator>WSAKBATO</originator>
								  </userIdentifier>
								  <dutyCode>
									<dutyCodeDetails>
									  <referenceQualifier>DUT</referenceQualifier>
									  <referenceIdentifier>SU</referenceIdentifier>
									</dutyCodeDetails>
								  </dutyCode>
								  <systemDetails>
									<organizationDetails>
									  <organizationId>NMC-US</organizationId>
									</organizationDetails>
								  </systemDetails>
								  <passwordInfo>
									<dataLength>8</dataLength>
									<dataType>E</dataType>
									<binaryData>ZXVXRnVoa2g=</binaryData>
								  </passwordInfo>
								</Security_Authenticate>         
							  </soapenv:Body>
							</soapenv:Envelope>';

            //$URL2 = "https://test.webservices.amadeus.com";
            $URL2 = "https://production.webservices.amadeus.com";
            $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/VLSSLQ_06_1_1A";

            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $URL2);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
            curl_setopt($ch2, CURLOPT_HEADER, 0);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, $Security_Auth);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

            /* $httpHeader2 = array(
              "Content-Type: text/xml; charset=UTF-8",
              "Content-Encoding: UTF-8"
              ); */

            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

            // Execute request, store response and HTTP response code
            $data2 = curl_exec($ch2);
            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
            curl_close($ch2);
           //echo '<<<>>>'.$data2;die;
           $file_num = rand(0,100);
           $_SESSION['file_num'] = $file_num;
            if (!empty($data2)) {
                $xml = new DOMDocument();
                $xml->loadXML($data2);
                $SessionId = $xml->getElementsByTagName("SessionId")->item(0)->nodeValue;
                $myFile = $_SESSION['file_num']."-".$_SESSION['akbar_session']."security_xml_request.txt";
				$fh = fopen('xmllogs/'.$myFile, 'w','r');
				$stringData = "Security Authentication XML Request".$Security_Auth;
				fwrite($fh, $stringData);
				fclose($fh);
				
				$myFile1 = $_SESSION['file_num']."-".$_SESSION['akbar_session']."security_xml_response.txt";
				$fh1 = fopen('xmllogs/'.$myFile1, 'w','r');
				$stringData = "Security Authentication XML Response ".$data2;
				fwrite($fh1, $stringData);
				fclose($fh1);
				
				//exit;
				$method = 'Security Authentication';
				//echo $myFile; exit;
				
				$this->Flights_Model->insert_logs_security($_SESSION['akbar_session'],$method,$myFile,$myFile1,$_SESSION['journey_type']);
               // $SequenceNumber = $xml->getElementsByTagName("SequenceNumber")->item(0)->nodeValue;
               // $SecurityToken = $xml->getElementsByTagName("SecurityToken")->item(0)->nodeValue;

                $time = time();
                
                //Security values and status
                /* if(isset($_SESSION['amadeus']))
                  {

                  $no=(count($_SESSION['amadeus']));
                  $_SESSION['amadeus'][$no]['SessionId']=$SessionId;
                  $_SESSION['amadeus'][$no]['SequenceNumber']=$SequenceNumber;
                  $_SESSION['amadeus'][$no]['SecurityToken']=$SecurityToken;
                  $_SESSION['amadeus'][$no]['SessionTime']=$time;
                  $_SESSION['amadeus'][$no]['SessionStatus']="true";
                  $sess_id=$no;
                  }
                  else
                  {
                  $no=0;
                  $time = time();
                  $_SESSION['amadeus'][$no]['SessionId']=$SessionId;
                  $_SESSION['amadeus'][$no]['SequenceNumber']=$SequenceNumber;
                  $_SESSION['amadeus'][$no]['SecurityToken']=$SecurityToken;
                  $_SESSION['amadeus'][$no]['SessionTime']=$time;
                  $_SESSION['amadeus'][$no]['SessionStatus']="true";
                  $sess_id=$no;
                  }
                 */
                 $SecurityToken='';
                 $seq=explode('|',$SessionId);
                $data = array('Session_Number' => $seq[0], 'Sequence_Number' => $seq[1], 'Security_Token' => $SecurityToken, 'Last_Query_Time' => $time, 'Query_In_Progress' => "YES", 'Active' => "Active");
                $this->db->insert('session_amadeus', $data);
                $insert_session_id = $this->db->insert_id();
                
                
            }
        }

        //echo '<pre/>';print_r($_SESSION['amadeus']);
        $adult_count = $_SESSION[$rand_id]['adults'];
        $child_count = $_SESSION[$rand_id]['childs'];
        $infant_count = $_SESSION[$rand_id]['infants'];

        $from_city_code = "";
        $to_city_code = "";
        $Pcount = $_SESSION[$rand_id]['adults'] + $_SESSION[$rand_id]['childs'];
        $fromcity = $_SESSION[$rand_id]['fromcityval'];
        $tocity = $_SESSION[$rand_id]['tocityval'];
        $include_city = $_SESSION[$rand_id]['include_city'];
        $exclude_city = $_SESSION[$rand_id]['exclude_city'];
        $sd = $_SESSION[$rand_id]['sd'];
        $ed = $_SESSION[$rand_id]['ed'];
        $cabin = $_SESSION[$rand_id]['cabin'];
        $cabin_type = $_SESSION[$rand_id]['cabin_type'];
        $hours = $_SESSION[$rand_id]['hours_connect_point'];
        $mins = $_SESSION[$rand_id]['min_connect_point'];
        $daterange = $_SESSION[$rand_id]['daterange'];
        $slice_dice = $_SESSION[$rand_id]['slice_dice'];
        $nonstop = $_SESSION[$rand_id]['nonstop'];
        $hours_time = $_SESSION[$rand_id]['hours_time'];
        $mins_time = $_SESSION[$rand_id]['mins_time'];
        $time_qualifier = $_SESSION[$rand_id]['time_qualifier'];
        $time_interval = $_SESSION[$rand_id]['time_interval'];
        $dradius = $_SESSION[$rand_id]['dradius'];
        $aradius = $_SESSION[$rand_id]['aradius'];

        if ($nonstop == "nonstop") {
            $nonstop_code = "N";
        } else {
            $nonstop_code = "";
        }
		//echo $sd." ".$ed;
        $cinval = explode("-", $sd);
        $cins = $cinval[2];
        $cins = substr($cins, -2);
        $cin = $cinval[0] . $cinval[1] . $cins;
	//echo $cin." ";
        if($ed!='')
        {
            $coutval = explode("-", $ed);
            $couts = $coutval[2];if ($nonstop == "nonstop") {
            $nonstop_code = "N";
        } else {
            $nonstop_code = "";
        }
		//echo $sd." ".$ed;
        $cinval = explode("-", $sd);
        $cins = $cinval[2];
        $cins = substr($cins, -2);
        $cin = $cinval[0] . $cinval[1] . $cins;
	//echo $cin." ";
        if($ed!='')
        {
            $coutval = explode("-", $ed);
            $couts = $coutval[2];
            $couts = substr($couts, -2);
            $cout = $coutval[0] . $coutval[1] . $couts;
        }
        else
        {
            $cout='';
        }
        //echo $cout;exit;
        if (!empty($hours_time) && (!empty($mins_time))) {
            if (strlen($hours_time) == 1) {
                $hours_time = "0" . $hours_time;
            }

            if (strlen($mins_time) == 1) {
                $mins_time = "0" . $mins_time;
            }
            $Time_window = $hours_time . $mins_time;
        }
        else
            $Time_window = '';


        if (!empty($time_qualifier)) {
            if ($time_qualifier == "Depart from") {
                $time_qualifier_code = "TD";
            } else if ($time_qualifier == "Arrival by") {
                $time_qualifier_code = "TA";
            }
        }
            $couts = substr($couts, -2);
            $cout = $coutval[0] . $coutval[1] . $couts;
        }
        else
        {
            $cout='';
        }
        //echo $cout;exit;
        if (!empty($hours_time) && (!empty($mins_time))) {
            if (strlen($hours_time) == 1) {
                $hours_time = "0" . $hours_time;
            }

            if (strlen($mins_time) == 1) {
                $mins_time = "0" . $mins_time;
            }
            $Time_window = $hours_time . $mins_time;
        }
        else
            $Time_window = '';


        if (!empty($time_qualifier)) {
            if ($time_qualifier == "Depart from") {
                $time_qualifier_code = "TD";
            } else if ($time_qualifier == "Arrival by") {
                $time_qualifier_code = "TA";
            }
        }

        if (empty($daterange)) {
            $timeDetails = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <date>' . $cin . '</date>
                                      </firstDateTimeDetail>	
                             </timeDetails>';
            $timeDetails1 = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <date>' . $cout . '</date>
                                      </firstDateTimeDetail>	
                             </timeDetails>';
        } else if ($daterange == "plus2days") {
            $timeDetails = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <date>' . $cin . '</date>
                                      </firstDateTimeDetail>
                                      <rangeOfDate>
                                            <rangeQualifier>P</rangeQualifier>
                                            <dayInterval>2</dayInterval>
                                      </rangeOfDate>
                             </timeDetails>';
            $timeDetails1 = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <date>' . $cout . '</date>
                                      </firstDateTimeDetail>
                                      <rangeOfDate>
                                            <rangeQualifier>P</rangeQualifier>
                                            <dayInterval>2</dayInterval>
                                      </rangeOfDate>
                             </timeDetails>';
        } else if ($daterange == "minus2days") {
            $timeDetails = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <date>' . $cin . '</date>
                                      </firstDateTimeDetail>
                                      <rangeOfDate>
                                            <rangeQualifier>M</rangeQualifier>
                                            <dayInterval>2</dayInterval>
                                      </rangeOfDate>	
                             </timeDetails>';
            $timeDetails1 = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <date>' . $cout . '</date>
                                      </firstDateTimeDetail>
                                      <rangeOfDate>
                                            <rangeQualifier>M</rangeQualifier>
                                            <dayInterval>2</dayInterval>
                                      </rangeOfDate>	
                             </timeDetails>';
        } else if ($daterange == "bothdays") {
            $timeDetails = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <date>' . $cin . '</date>
                                      </firstDateTimeDetail>
                                      <rangeOfDate>
                                            <rangeQualifier>C</rangeQualifier>
                                            <dayInterval>1</dayInterval>
                                      </rangeOfDate>	
                             </timeDetails>';
            $timeDetails1 = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <date>' . $cout . '</date>
                                      </firstDateTimeDetail>
                                      <rangeOfDate>
                                            <rangeQualifier>C</rangeQualifier>
                                            <dayInterval>1</dayInterval>
                                      </rangeOfDate>	
                             </timeDetails>';
        } else if ($daterange == "timewindow") {
            $timeDetails = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <timeQualifier>' . $time_qualifier_code . '</timeQualifier>
                                            <date>' . $cin . '</date>
                                            <time>' . $Time_window . '</time>
                                            <timeWindow>' . $time_interval . '</timeWindow>
                                      </firstDateTimeDetail>
                             </timeDetails>';
            $timeDetails1 = '<timeDetails>
                                    <firstDateTimeDetail>
                                            <timeQualifier>' . $time_qualifier_code . '</timeQualifier>
                                            <date>' . $cout . '</date>
                                            <time>' . $Time_window . '</time>
                                            <timeWindow>' . $time_interval . '</timeWindow>
                                      </firstDateTimeDetail>
                             </timeDetails>';
        }


        if ((!empty($hours)) && (!empty($mins))) {
            $Layover = '<unitNumberDetail>
                                <numberOfUnits>' . $hours . '</numberOfUnits>
                                <typeOfUnit>MLH</typeOfUnit>
                          </unitNumberDetail>
                         <unitNumberDetail>
                                <numberOfUnits>' . $mins . '</numberOfUnits>
                                <typeOfUnit>MLM</typeOfUnit>
                        </unitNumberDetail>';
        } else {
            $Layover = '';
        }


        $fcityname = explode(",", $fromcity);
        $fcount_city_code = (count($fcityname));
        $from_city_code = $fcityname[($fcount_city_code - 1)];

        $tcityname = explode(",", $tocity);
        $tcount_city_code = (count($tcityname));
        $to_city_code = $tcityname[($tcount_city_code - 1)];

        if (!empty($include_city)) {

            $include_city_val = explode(",", $include_city);
            $include_city_val_count = (count($include_city_val));
            $include_city_code = $include_city_val[($include_city_val_count - 1)];

            $include_conncet_point = '<inclusionDetail>
                                        <inclusionIdentifier>M</inclusionIdentifier>
                                             <locationId>' . $include_city_code . '</locationId>
                                     </inclusionDetail>';
        } else {
            $include_city_code = '';
            $include_conncet_point = '';
        }

        if (!empty($exclude_city)) {
            $exclude_city_val = explode(",", $exclude_city);
            $exclude_city_val_count = (count($exclude_city_val));
            $exclude_city_code = $exclude_city_val[($exclude_city_val_count - 1)];

            $exclude_conncet_point = '<exclusionDetail>
                                            <exclusionIdentifier>X</exclusionIdentifier>
                                                 <locationId>' . $exclude_city_code . '</locationId>
                                   </exclusionDetail>';
        } else {
            $exclude_city_code = '';
            $exclude_conncet_point = '';
        }



        $adult_info = "";
        $adult = "";
        if ($adult_count > 0) {
            for ($x = 1; $x <= $adult_count; $x++) {
                $adult_info.='<traveller>
                                    <ref>' . $x . '</ref>
                            </traveller>';
            }
            $adult = '<paxReference>
                       <ptc>ADT</ptc>' .
                        $adult_info . '
                      </paxReference>';
        }

        $child_info = "";
        $child = "";
        if ($child_count > 0) {
            for ($y = 0; $y < $child_count; $y++) {
                $child_info.='<traveller>
                                    <ref>' . $x++ . '</ref>
                            </traveller>';
            }
            $child = '<paxReference>
			<ptc>CH</ptc>' .
                    $child_info . '
		      </paxReference>';
        }

        $infant_info = "";
        $infant = "";
        if ($infant_count > 0) {
            for ($z = 1; $z <= $infant_count; $z++) {
                $infant_info.='<traveller>
                                    <ref>' . $z . '</ref>
                                    <infantIndicator>' . $z . '</infantIndicator>
                            </traveller>';
            }
            $infant = '<paxReference>
			<ptc>INF</ptc>' .
                    $infant_info . '
		       </paxReference>';
        }
        $passenger_info = $adult . $child . $infant;

        if ($cabin_type == "")
            $cabinQualifier = "";
        else
            $cabinQualifier = '<cabinQualifier>' . $cabin_type . '</cabinQualifier>';
        if ($cabin == "All")
            $cabin_text_value = '';
        else {
            $cabin_text_value = '<cabinId>
                                        ' . $cabinQualifier . '
                                        <cabin>' . $cabin . '</cabin>
                                </cabinId>';
        }


        if (!empty($dradius)) {
            $dradius_value = '<departureLocalization>
                                    <departurePoint>
                                            <distance>' . $dradius . '</distance>
                                            <distanceUnit>K</distanceUnit>
                                            <locationId>' . $from_city_code . '</locationId>
                                    </departurePoint>
                            </departureLocalization>';
            $dradius_value1 = '<departureLocalization>
                                        <departurePoint>
                                                <distance>' . $dradius . '</distance>
                                                <distanceUnit>K</distanceUnit>
                                                <locationId>' . $to_city_code . '</locationId>
                                        </departurePoint>
                                </departureLocalization>';
        } else {
            $dradius_value = '<departureLocalization>
                                    <departurePoint>
                                            <locationId>' . $from_city_code . '</locationId>
                                    </departurePoint>
                            </departureLocalization>';
            $dradius_value1 = '<departureLocalization>
                                        <departurePoint>
                                                <locationId>' . $to_city_code . '</locationId>
                                        </departurePoint>
                                </departureLocalization>';
        }

        if (!empty($aradius)) {
            $aradius_value = '<arrivalLocalization>
                                    <arrivalPointDetails>
                                            <distance>' . $aradius . '</distance>
                                            <distanceUnit>K</distanceUnit>
                                            <locationId>' . $to_city_code . '</locationId>
                                    </arrivalPointDetails>
                            </arrivalLocalization>';
            $aradius_value1 = '<arrivalLocalization>
                                        <arrivalPointDetails>
                                                <distance>' . $aradius . '</distance>
                                                <distanceUnit>K</distanceUnit>
                                                <locationId>' . $from_city_code . '</locationId>
                                        </arrivalPointDetails>
                                </arrivalLocalization>';
        } else {
            $aradius_value = '<arrivalLocalization>
                                    <arrivalMultiCity>
                                            <locationId>' . $to_city_code . '</locationId>
                                    </arrivalMultiCity>
                            </arrivalLocalization>';
            $aradius_value1 = '<arrivalLocalization>
                                        <arrivalMultiCity>
                                                <locationId>' . $from_city_code . '</locationId>
                                        </arrivalMultiCity>
                                </arrivalLocalization>';
        }


        $date_multi = $_SESSION[$rand_id]['multi_city_datelist'];
        $departure_multi = $_SESSION[$rand_id]['multi_city_dlist'];
        $arrival_multi = $_SESSION[$rand_id]['multi_city_alist'];
        //echo '<pre/>';print_r($arrival_multi);print_r($departure_multi);


        if ((!empty($_SESSION[$rand_id]['multi_city_dlist'])) && (!empty($_SESSION[$rand_id]['multi_city_alist'])) && (!empty($_SESSION[$rand_id]['multi_city_datelist']))) {
            $multiCity_final = '<itinerary>
                                        <requestedSegmentRef>
                                                <segRef>1</segRef>
                                        </requestedSegmentRef>
                                        <departureLocalization>
                                                <departurePoint>
                                                        <locationId>' . $from_city_code . '</locationId>
                                                </departurePoint>
                                        </departureLocalization>
                                        <arrivalLocalization>
                                                <arrivalPointDetails>
                                                        <locationId>' . $to_city_code . '</locationId>
                                                </arrivalPointDetails>
                                        </arrivalLocalization>
                                        <timeDetails>
                                                <firstDateTimeDetail>
                                                        <date>' . $cin . '</date>
                                                </firstDateTimeDetail>
                                        </timeDetails>
                                </itinerary>';
            for ($i = 0; $i < (count($departure_multi)); $i++) {

                $departure_multi_val = explode(",", $departure_multi[$i]);
                $departure_multi_val_count = (count($departure_multi_val));
                $multi_city_de_code = $departure_multi_val[($departure_multi_val_count - 1)];

                $arrival_multi_val = explode(",", $arrival_multi[$i]);
                $arrival_multi_val_count = (count($arrival_multi_val));
                $multi_city_ar_code = $arrival_multi_val[($arrival_multi_val_count - 1)];

                $date_multival = explode("-", $date_multi[$i]);
                $date_multis = $date_multival[2];
                $date_multis = substr($date_multis, -2);
                $date_multi_code = $date_multival[0] . $date_multival[1] . $date_multis;

                $multiCity_final.='<itinerary>
                                        <requestedSegmentRef>
                                                <segRef>' . ($i + 2) . '</segRef>
                                        </requestedSegmentRef>
                                        <departureLocalization>
                                                <departurePoint>
                                                        <locationId>' . $multi_city_de_code . '</locationId>
                                                </departurePoint>
                                        </departureLocalization>
                                        <arrivalLocalization>
                                                <arrivalPointDetails>
                                                        <locationId>' . $multi_city_ar_code . '</locationId>
                                                </arrivalPointDetails>
                                        </arrivalLocalization>
                                        <timeDetails>
                                                <firstDateTimeDetail>
                                                        <date>' . $date_multi_code . '</date>
                                                </firstDateTimeDetail>
                                        </timeDetails>
                                </itinerary>';
            }
        } else {
            $multiCity_final = '';
        }

        if ($slice_dice != '') {
            $slice_dice_details = '<companyIdentity>
                                    <carrierQualifier>M</carrierQualifier>
                                    <carrierId>AA</carrierId>
                                  </companyIdentity>';
        } else {
            $slice_dice_details = '';
        }
        if ($nonstop_code != '') {
            $nonstop_details = '<flightDetail>
                                    <flightType>N</flightType>
                              </flightDetail>';
        } else {
            $nonstop_details = '';
        }

        //echo "Nonstop: ".$nonstop_details;exit;
        //echo "include_conncet_point: ".$include_conncet_point."<br/>";
        //echo "exclude_conncet_point: ".$exclude_conncet_point."<br/>";
        //echo "cabin_text_value: ".$exclude_conncet_point."<br/>";
        //echo "Layover: ".$Layover."<br/>";

        /*
          $include_conncet_point='<inclusionDetail>
          <inclusionIdentifier>M</inclusionIdentifier>
          <locationId>'.$include_city_code.'</locationId>
          </inclusionDetail>';

          $exclude_conncet_point='<exclusionDetail>
          <exclusionIdentifier>X</exclusionIdentifier>
          <locationId>'.$exclude_city_code.'</locationId>
          </exclusionDetail>';
         */

			$traveller_info=$nonstop_details.$slice_dice_details.$cabin_text_value.$Layover;
			if(!empty($traveller_info))
			{
				$Traveller_inf_final='<travelFlightInfo>'.$traveller_info.'
						      </travelFlightInfo>';
			}
			else
			{
				$Traveller_inf_final='';
			}		


        $dataforgetavail = "";
        //echo "sdfgsduhg".$Traveller_inf_final;exit;
        if ($_SESSION['journey_type'] != "MultiCity") {
            //echo "true";
            if ($_SESSION['journey_type'] == "Round") {
                //echo "true : round";
                $Fare_MasterPricerTravelBoardSearch = '<?xml version="1.0" encoding="utf-8"?>
                                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                             <soapenv:Header>
                                                              <SessionId>' . $SessionId . '</SessionId>
                                                              <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                               </soapenv:Header>
                                              <soapenv:Body>
                                                        <Fare_MasterPricerTravelBoardSearch xmlns="http://xml.amadeus.com/FMPTBQ_10_3_1A">
                                                                        <numberOfUnit>
                                                                                <unitNumberDetail>
                                                                                        <numberOfUnits>' . $Pcount . '</numberOfUnits>
                                                                                        <typeOfUnit>PX</typeOfUnit>
                                                                                </unitNumberDetail>
                                                                                <unitNumberDetail>
                                                                                        <numberOfUnits>200</numberOfUnits>
                                                                                        <typeOfUnit>RC</typeOfUnit>
                                                                                </unitNumberDetail>
                                                                        </numberOfUnit>
                                                                        ' . $passenger_info . '
                                                                        <fareOptions>
                                                                                <pricingTickInfo>
                                                                                        <pricingTicketing>
                                                                                                <priceType>RU</priceType>
                                                                                                <priceType>RP</priceType>
                                                                                                <priceType>ET</priceType>
                                                                                                <priceType>TAC</priceType>
                                                                                                <priceType>CUC</priceType>
                                                                                        </pricingTicketing>
                                                                                         <sellingPoint> 
                                                                                                <locationId>ODE</locationId> 
                                                                                        </sellingPoint> 
                                                                                        <ticketingPoint> 
                                                                                                <locationId>ODE</locationId> 
                                                                                        </ticketingPoint> 
                                                                                </pricingTickInfo>
                                                                                 <conversionRate> 
                                                                                        <conversionRateDetail> 
                                                                                                <currency>USD</currency> 
                                                                                        </conversionRateDetail> 
                                                                                </conversionRate> 
                                                                        </fareOptions>
                                                                        '.$Traveller_inf_final.'
                                                                        <itinerary>
                                                                                <requestedSegmentRef>
                                                                                        <segRef>1</segRef>
                                                                                </requestedSegmentRef>
                                                                                ' . $dradius_value . '
                                                                                ' . $aradius_value . '
                                                                                ' . $timeDetails . '
                                                                                 <flightInfo>
                                                                                        ' . $include_conncet_point . '
                                                                                        ' . $exclude_conncet_point . '
                                                                                 </flightInfo>
                                                                        </itinerary>
                                                                        <itinerary>
                                                                                <requestedSegmentRef>
                                                                                        <segRef>2</segRef>
                                                                                </requestedSegmentRef>
                                                                                ' . $dradius_value1 . '
                                                                                ' . $aradius_value1 . '
                                                                                ' . $timeDetails1 . '
                                                                                 <flightInfo>
                                                                                        ' . $include_conncet_point . '
                                                                                        ' . $exclude_conncet_point . '
                                                                                 </flightInfo>
                                                                        </itinerary>
                                                                </Fare_MasterPricerTravelBoardSearch>
                                                </soapenv:Body>
                                        </soapenv:Envelope>';

                $request_stirng = "FMPTBQ_10_3_1A";
            } 
            else if ($_SESSION['journey_type'] == "OneWay") {
                //echo "true : oneway";	
                $Fare_MasterPricerTravelBoardSearch = '<?xml version="1.0" encoding="utf-8"?>
                                                <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                 <soapenv:Header>
															  <SessionId>' . $SessionId . '</SessionId>
															  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                   </soapenv:Header>
                                                  <soapenv:Body>
                                                        <Fare_MasterPricerTravelBoardSearch xmlns="http://xml.amadeus.com/FMPTBQ_12_4_1A">
                                                                        <numberOfUnit>
                                                                                <unitNumberDetail>
                                                                                        <numberOfUnits>' . $Pcount . '</numberOfUnits>
                                                                                        <typeOfUnit>PX</typeOfUnit>
                                                                                </unitNumberDetail>
                                                                                <unitNumberDetail>
                                                                                        <numberOfUnits>200</numberOfUnits>
                                                                                        <typeOfUnit>RC</typeOfUnit>
                                                                                </unitNumberDetail>
                                                                        </numberOfUnit>
                                                                        ' . $passenger_info . '
                                                                        <fareOptions>
                                                                        <pricingTickInfo>
                                                                                <pricingTicketing>
                                                                                        <priceType>RU</priceType>
                                                                                        <priceType>RP</priceType>
                                                                                        <priceType>ET</priceType>
                                                                                        <priceType>TAC</priceType>
                                                                                        <priceType>CUC</priceType>
                                                                                        <priceType>MTK</priceType>
                                                                                </pricingTicketing>
                                                                                 <sellingPoint> 
                                                                                        <locationId>ODE</locationId> 
                                                                                </sellingPoint> 
                                                                                <ticketingPoint> 
                                                                                        <locationId>ODE</locationId> 
                                                                                </ticketingPoint> 
                                                                        </pricingTickInfo>
                                                                         <conversionRate> 
                                                                                <conversionRateDetail> 
                                                                                        <currency>USD</currency> 
                                                                                </conversionRateDetail> 
                                                                        </conversionRate> 
                                                                </fareOptions>
                                                                '.$Traveller_inf_final.'
                                                                        <itinerary>
                                                                                <requestedSegmentRef>
                                                                                        <segRef>1</segRef>
                                                                                </requestedSegmentRef>
                                                                                ' . $dradius_value . '
                                                                        ' . $aradius_value . '
                                                                        ' . $timeDetails . '
                                                                         <flightInfo>
                                                                                ' . $include_conncet_point . '
                                                                                ' . $exclude_conncet_point . '
                                                                         </flightInfo>		
                                                                        </itinerary>
                                                                </Fare_MasterPricerTravelBoardSearch>
                                                </soapenv:Body>
                                        </soapenv:Envelope>';

                $request_stirng = "FMPTBQ_10_3_1A";
            } 
            else if ($_SESSION['journey_type'] == "MultiCity") {
                //echo "true : multi";			
                $Fare_MasterPricerTravelBoardSearch = '<?xml version="1.0" encoding="utf-8"?>
                                                    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                     <soapenv:Header>
															  <SessionId>' . $SessionId . '</SessionId>
															  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                       </soapenv:Header>
                                                      <soapenv:Body>
                                                            <Fare_MasterPricerTravelBoardSearch xmlns="http://xml.amadeus.com/FMPTBQ_12_4_1A">
                                                                            <numberOfUnit>
                                                                                    <unitNumberDetail>
                                                                                            <numberOfUnits>' . $Pcount . '</numberOfUnits>
                                                                                            <typeOfUnit>PX</typeOfUnit>
                                                                                    </unitNumberDetail>
                                                                                    <unitNumberDetail>
                                                                                            <numberOfUnits>200</numberOfUnits>
                                                                                            <typeOfUnit>RC</typeOfUnit>
                                                                                    </unitNumberDetail>
                                                                            </numberOfUnit>
                                                                            ' . $passenger_info . '
                                                                            <fareOptions>
                                                                            <pricingTickInfo>
                                                                                    <pricingTicketing>
                                                                                            <priceType>RU</priceType>
                                                                                            <priceType>RP</priceType>
                                                                                            <priceType>ET</priceType>
                                                                                            <priceType>TAC</priceType>
                                                                                            <priceType>CUC</priceType>
                                                                                    </pricingTicketing>
                                                                                     <sellingPoint> 
                                                                                            <locationId>ODE</locationId> 
                                                                                    </sellingPoint> 
                                                                                    <ticketingPoint> 
                                                                                            <locationId>ODE</locationId> 
                                                                                    </ticketingPoint> 
                                                                            </pricingTickInfo>
                                                                             <conversionRate> 
                                                                                    <conversionRateDetail> 
                                                                                            <currency>USD</currency> 
                                                                                    </conversionRateDetail> 
                                                                            </conversionRate> 
                                                                    </fareOptions>
                                                                    '.$Traveller_inf_final.'
                                                                            <itinerary>
                                                                                    <requestedSegmentRef>
                                                                                            <segRef>1</segRef>
                                                                                    </requestedSegmentRef>
                                                                                    ' . $multi_city . '
                                                                            ' . $timeDetails . '
                                                                             <flightInfo>
                                                                                    ' . $include_conncet_point . '
                                                                                    ' . $exclude_conncet_point . '
                                                                             </flightInfo>		
                                                                            </itinerary>
                                                                    </Fare_MasterPricerTravelBoardSearch>
                                                    </soapenv:Body>
                                            </soapenv:Envelope>';


                $Fare_MasterPricerTravelBoardSearch1 = '<?xml version="1.0" encoding="utf-8"?>
                                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                         <soapenv:Header>
                                                           <Session>
                                                                          <SessionId>' . $SessionId . '</SessionId>
                                                                          <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                                          <SecurityToken>' . $SecurityToken . '</SecurityToken>
                                                                </Session>
                                           </soapenv:Header>
                                          <soapenv:Body>
                                                <Fare_MasterPricerTravelBoardSearch xmlns="http://xml.amadeus.com/FMPTBQ_12_4_1A">
                                                                <numberOfUnit>
                                                                        <unitNumberDetail>
                                                                                <numberOfUnits>' . $Pcount . '</numberOfUnits>
                                                                                <typeOfUnit>PX</typeOfUnit>
                                                                        </unitNumberDetail>
                                                                        <unitNumberDetail>
                                                                                <numberOfUnits>200</numberOfUnits>
                                                                                <typeOfUnit>RC</typeOfUnit>
                                                                        </unitNumberDetail>
                                                                </numberOfUnit>
                                                                ' . $passenger_info . '
                                                                <fareOptions>
                                                                <pricingTickInfo>
                                                                        <pricingTicketing>
                                                                                <priceType>RU</priceType>
                                                                                <priceType>RP</priceType>
                                                                                <priceType>ET</priceType>
                                                                                <priceType>TAC</priceType>
                                                                                <priceType>MTK</priceType>
                                                                        </pricingTicketing>
                                                                </pricingTickInfo>
                                                        </fareOptions>
                                                        '.$Traveller_inf_final.'
                                                                <itinerary>
                                                                <requestedSegmentRef>
                                                                        <segRef>1</segRef>
                                                                </requestedSegmentRef>
                                                                <departureLocalization>
                                                                        <departurePoint>
                                                                                <locationId>ATH</locationId>
                                                                        </departurePoint>
                                                                </departureLocalization>
                                                                <arrivalLocalization>
                                                                        <arrivalPointDetails>
                                                                                <locationId>ROM</locationId>
                                                                        </arrivalPointDetails>
                                                                </arrivalLocalization>
                                                                <timeDetails>
                                                                        <firstDateTimeDetail>
                                                                                <date>010913</date>
                                                                        </firstDateTimeDetail>
                                                                </timeDetails>
                                                        </itinerary>
                                                        <itinerary>
                                                                <requestedSegmentRef>
                                                                        <segRef>2</segRef>
                                                                </requestedSegmentRef>
                                                                <departureLocalization>
                                                                        <departurePoint>
                                                                                <locationId>ROM</locationId>
                                                                        </departurePoint>
                                                                </departureLocalization>
                                                                <arrivalLocalization>
                                                                        <arrivalPointDetails>
                                                                                <locationId>MAD</locationId>
                                                                        </arrivalPointDetails>
                                                                </arrivalLocalization>
                                                                <timeDetails>
                                                                        <firstDateTimeDetail>
                                                                                <date>050913</date>
                                                                        </firstDateTimeDetail>
                                                                </timeDetails>
                                                        </itinerary>
                                                        <itinerary>
                                                                <requestedSegmentRef>
                                                                        <segRef>3</segRef>
                                                                </requestedSegmentRef>
                                                                <departureLocalization>
                                                                        <departurePoint>
                                                                                <locationId>MAD</locationId>
                                                                        </departurePoint>
                                                                </departureLocalization>
                                                                <arrivalLocalization>
                                                                        <arrivalPointDetails>
                                                                                <locationId>PAR</locationId>
                                                                        </arrivalPointDetails>
                                                                </arrivalLocalization>
                                                                <timeDetails>
                                                                        <firstDateTimeDetail>
                                                                                <date>100913</date>
                                                                        </firstDateTimeDetail>
                                                                </timeDetails>
                                                        </itinerary>
                                                <itinerary>
                                                                <requestedSegmentRef>
                                                                        <segRef>4</segRef>
                                                                </requestedSegmentRef>
                                                                <departureLocalization>
                                                                        <departurePoint>
                                                                                <locationId>PAR</locationId>
                                                                        </departurePoint>
                                                                </departureLocalization>
                                                                <arrivalLocalization>
                                                                        <arrivalPointDetails>
                                                                                <locationId>AMS</locationId>
                                                                        </arrivalPointDetails>
                                                                </arrivalLocalization>
                                                                <timeDetails>
                                                                        <firstDateTimeDetail>
                                                                                <date>120913</date>
                                                                        </firstDateTimeDetail>
                                                                </timeDetails>
                                                        </itinerary>
                                                        </Fare_MasterPricerTravelBoardSearch>
                                        </soapenv:Body>
                                </soapenv:Envelope>';

                $request_stirng = "FMPTBQ_10_3_1A";
            } 
            else if ($_SESSION['journey_type'] == "Calendar") {
                $Fare_MasterPricerTravelBoardSearch = '<?xml version="1.0" encoding="utf-8"?>
                                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                             <soapenv:Header>
                                                               <Session>
																		  <SessionId>' . $SessionId . '</SessionId>
																		  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																		  <SecurityToken>' . $SecurityToken . '</SecurityToken>
																</Session>
                                               </soapenv:Header>
                                              <soapenv:Body>
                                                    <Fare_MasterPricerCalendar xmlns="http://xml.amadeus.com/FMPCAQ_12_4_1A">
                                                            <numberOfUnit>
                                                                    <unitNumberDetail>
                                                                            <numberOfUnits>' . $Pcount . '</numberOfUnits>
                                                                            <typeOfUnit>PX</typeOfUnit>
                                                                    </unitNumberDetail>
                                                            </numberOfUnit>
                                                            ' . $passenger_info . '
                                                            <fareOptions>
                                                    <pricingTickInfo>
                                                            <pricingTicketing>
                                                                    <priceType>RU</priceType>
                                                                    <priceType>RP</priceType>
                                                                    <priceType>ET</priceType>
                                                                    <priceType>TAC</priceType>
                                                                    <priceType>CUC</priceType>
                                                            </pricingTicketing>
                                                             <sellingPoint> 
                                                                    <locationId>ODE</locationId> 
                                                            </sellingPoint> 
                                                            <ticketingPoint> 
                                                                    <locationId>ODE</locationId> 
                                                            </ticketingPoint> 
                                                    </pricingTickInfo>
                                                     <conversionRate> 
                                                            <conversionRateDetail> 
                                                                    <currency>USD</currency> 
                                                            </conversionRateDetail> 
                                                    </conversionRate> 
                                            </fareOptions>
                                            '.$Traveller_inf_final.'
                                                            <itinerary>
                                                                    <requestedSegmentRef>
                                                                            <segRef>1</segRef>
                                                                    </requestedSegmentRef>
                                                                    <departureLocalization>
                                                                            <departurePoint>
                                                                                    <locationId>' . $from_city_code . '</locationId>
                                                                            </departurePoint>
                                                                    </departureLocalization>
                                                                    <arrivalLocalization>
                                                                            <arrivalPointDetails>
                                                                                    <locationId>' . $to_city_code . '</locationId>
                                                                            </arrivalPointDetails>
                                                                    </arrivalLocalization>
                                                                    <timeDetails>
                                                                            <firstDateTimeDetail>
                                                                                    <date>' . $cin . '</date>
                                                                            </firstDateTimeDetail>
                                                                            <rangeOfDate>
                                                                                    <rangeQualifier>C</rangeQualifier>
                                                                                    <dayInterval>3</dayInterval>
                                                                            </rangeOfDate>
                                                                    </timeDetails>
                                                            </itinerary>
                                                            <itinerary>
                                                                    <requestedSegmentRef>
                                                                            <segRef>2</segRef>
                                                                    </requestedSegmentRef>
                                                                    <departureLocalization>
                                                                            <departurePoint>
                                                                                    <locationId>' . $to_city_code . '</locationId>
                                                                            </departurePoint>
                                                                    </departureLocalization>
                                                                    <arrivalLocalization>
                                                                            <arrivalPointDetails>
                                                                                    <locationId>' . $from_city_code . '</locationId>
                                                                            </arrivalPointDetails>
                                                                    </arrivalLocalization>
                                                                    <timeDetails>
                                                                            <firstDateTimeDetail>
                                                                                    <date>' . $cout . '</date>
                                                                            </firstDateTimeDetail>
                                                                            <rangeOfDate>
                                                                                    <rangeQualifier>C</rangeQualifier>
                                                                                    <dayInterval>3</dayInterval>
                                                                            </rangeOfDate>
                                                                    </timeDetails>
                                                            </itinerary>
                                                    </Fare_MasterPricerCalendar>
                                            </soapenv:Body>
                                    </soapenv:Envelope>';

                $request_stirng = "FMPTBQ_10_3_1A";
            }
            //echo '<pre/>'.$Fare_MasterPricerTravelBoardSearch;
            //$URL2 = "https://production.webservices.amadeus.com";
            //$soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/" . $request_stirng;
			$URL2 = "https://production.webservices.amadeus.com";
            $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/". $request_stirng;
            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $URL2);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
            curl_setopt($ch2, CURLOPT_HEADER, 0);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); //$Air_FlightInfo
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, $Fare_MasterPricerTravelBoardSearch); //$Security_Auth
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

            // Execute request, store response and HTTP response code
            $dataforgetavail = curl_exec($ch2);
            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
            curl_close($ch2);
			
			$myFile = $_SESSION['file_num']."-".$_SESSION['akbar_session']."avaialability_request.txt";
			$fh = fopen('xmllogs/'.$myFile, 'w','r');
			$stringData = "Availability XML Request".$Fare_MasterPricerTravelBoardSearch;
			fwrite($fh, $stringData);
			fclose($fh);
			
			$myFile1 = $_SESSION['file_num']."-".$_SESSION['akbar_session']."avaialability_response.txt";
			$fh1 = fopen('xmllogs/'.$myFile1, 'w','r');
			$stringData = "Availability XML Response ".$dataforgetavail;
			fwrite($fh1, $stringData);
			fclose($fh1);
			
			$method = 'Flight Search XML';
			$this->Flights_Model->insert_logs_security($_SESSION['akbar_session'],$method,$myFile,$myFile1,$_SESSION['journey_type']);
			
           //echo '<pre/>';print_r($dataforgetavail);exit;
            $fare_search_result = $this->xml2array($dataforgetavail);
		//echo '<pre />';print_r($fare_search_result);die;
		if (!isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerTravelBoardSearchReply']['errorMessage'])) 
		{
			if (isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerTravelBoardSearchReply']))
				$data['flight_result'] = $fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerTravelBoardSearchReply'];
			else
				$data['flight_result'] = "";
		}
		else 
		{
			$data['flight_result'] = "";
			$data['currency'] = "";
		}
		//echo '<pre />';print_r($data['flight_result']);die;
		// Getting the mrakups
		//$adminmarkup = $this->Flights_Model->get_adminmarkup();
		//$pg = $this->Flights_Model->get_pgmarkup();
		if($data['flight_result']!='' && $_SESSION['journey_type'] == "OneWay")
		{
			$flight_result = $data['flight_result'];
            $currency = $flight_result['conversionRate']['conversionRateDetail']['currency'];
			if (!isset($flight_result['flightIndex'][0]))
            {
				$flight_details = $flight_result['flightIndex']['groupOfFlights'];
				if (!isset($flight_details[0]))
				{
					$i = 0;
					$testing[$i]['ref'] = $flight_details['propFlightGrDetail']['flightProposal'][0]['ref'];
					$testing[$i]['eft'] = $flight_details['propFlightGrDetail']['flightProposal'][1]['ref'];
					if(!isset($flight_details[$i]['flightDetails'][0]))
					{
						$testing[$i]['dateOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
						$testing[$i]['timeOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
						$testing[$i]['dateOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
						$testing[$i]['timeOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
						$testing[$i]['flightNumber'] = $flight_details['flightDetails']['flightInformation']['flightNumber'];
						$testing[$i]['marketingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
						$testing[$i]['operatingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
						$testing[$i]['locationIdDeparture'] = $flight_details['flightDetails']['flightInformation']['location'][0]['locationId'];
						$testing[$i]['locationIdArival'] = $flight_details['flightDetails']['flightInformation']['location'][1]['locationId'];
						$testing[$i]['equipmentType'] = $flight_details['flightDetails']['flightInformation']['productDetail']['equipmentType'];
						$testing[$i]['electronicTicketing'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
						if (isset($flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
							$testing[$i]['productDetailQualifier'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
						else
							$testing[$i]['productDetailQualifier'] = '';
					}
					else
				    {
						$count_flight_details = count($flight_details['flightDetails']);
						for ($j = 0; $j < $count_flight_details; $j++) 
						{
							$testing[$i]['dateOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
							$testing[$i]['timeOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
							$testing[$i]['dateOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
							$testing[$i]['timeOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
							$testing[$i]['flightNumber'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['flightNumber'];
							$testing[$i]['marketingCarrier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
							$testing[$i]['operatingCarrier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
							$testing[$i]['locationIdDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['location'][0]['locationId'];
							$testing[$i]['locationIdArival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['location'][1]['locationId'];
							$testing[$i]['equipmentType'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType'];
							$testing[$i]['electronicTicketing'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing'];
							if (isset($flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']))
								$testing[$i]['productDetailQualifier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
							else
								$testing[$i]['productDetailQualifier'][$j];
						}
					}
				}
				else
			    {
					
					$count_flight_result = count($flight_details);
					for ($i = 0; $i < $count_flight_result; $i++) 
					{
						$testing[$i]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref'];
						$testing[$i]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref'];
						if(!isset($flight_details[$i]['flightDetails'][0]))
						{
							
							$testing[$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
							//echo $testing[$i]['dateOfDeparture'];die;
							$testing[$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
							$testing[$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
							$testing[$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
							$testing[$i]['flightNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightNumber'];
							$testing[$i]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
							if(isset($flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier']))
							{
								$testing[$i]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
							}
							else
							{
								$testing[$i]['operatingCarrier'] = '';
							}
							$testing[$i]['locationIdDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][0]['locationId'];
							$testing[$i]['locationIdArival'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][1]['locationId'];
							$testing[$i]['equipmentType'] = $flight_details[$i]['flightDetails']['flightInformation']['productDetail']['equipmentType'];
							$testing[$i]['electronicTicketing'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
							if (isset($flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
								$testing[$i]['productDetailQualifier'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
							else
								$testing[$i]['productDetailQualifier'] = '';
						}
						else
						{
							$count_flight_details = count($flight_details[$i]['flightDetails']);
							for ($j = 0; $j < $count_flight_details; $j++) 
							{
								$testing[$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
								$testing[$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
								$testing[$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
								$testing[$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
								$testing[$i]['flightNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightNumber'];
								$testing[$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
								if(isset($flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier']))
								{
									$testing[$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
								}
								else
								{
									$testing[$i]['operatingCarrier'][$j] = '';
								}
								$testing[$i]['locationIdDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][0]['locationId'];
								$testing[$i]['locationIdArival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][1]['locationId'];
								$testing[$i]['equipmentType'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType'];
								$testing[$i]['electronicTicketing'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing'];
								if (isset($flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']))
									$testing[$i]['productDetailQualifier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
								else
									$testing[$i]['productDetailQualifier'][$j] = '';
							}
							  
						}
					}
					 
				}
			}
			else
			{
				$count_group = (count($flight_result['flightIndex']));
				$k = 0;
				for ($fg = 0; $fg < $count_group; $fg++) 
				{
					$flight_details = $flight_result['flightIndex'][$fg]['groupOfFlights'];
					if (!isset($flight_details[0]))
					{
						$testing[$k]['ref'] = $flight_details['propFlightGrDetail']['flightProposal'][0]['ref'];
						$testing[$k]['eft'] = $flight_details['propFlightGrDetail']['flightProposal'][1]['ref'];
						if(!isset($flight_details[$i]['flightDetails'][0]))
						{
							$testing[$k]['dateOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
							$testing[$k]['timeOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
							$testing[$k]['dateOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
							$testing[$k]['timeOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
							$testing[$k]['flightNumber'] = $flight_details['flightDetails']['flightInformation']['flightNumber'];
							$testing[$k]['marketingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
							$testing[$k]['operatingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
							$testing[$k]['locationIdDeparture'] = $flight_details['flightDetails']['flightInformation']['location'][0]['locationId'];
							$testing[$k]['locationIdArival'] = $flight_details['flightDetails']['flightInformation']['location'][1]['locationId'];
							$testing[$k]['equipmentType'] = $flight_details['flightDetails']['flightInformation']['productDetail']['equipmentType'];
							$testing[$k]['electronicTicketing'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
							if (isset($flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
								$testing[$k]['productDetailQualifier'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
							else
								$testing[$k]['productDetailQualifier'] = '';
								$k++;
						}
						else 
						{
							$count_flight_details = count($flight_details['flightDetails']);
							for ($j = 0; $j < $count_flight_details; $j++) 
							{
								$testing[$k]['dateOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
								$testing[$k]['timeOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
								$testing[$k]['dateOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
								$testing[$k]['timeOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
								$testing[$k]['flightNumber'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['flightNumber'];
								$testing[$k]['marketingCarrier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
								$testing[$k]['operatingCarrier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
								$testing[$k]['locationIdDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['location'][0]['locationId'];
								$testing[$k]['locationIdArival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['location'][1]['locationId'];
								$testing[$k]['equipmentType'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType'];
								$testing[$k]['electronicTicketing'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing'];
								if (isset($light_details['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']))
									$testing[$k]['productDetailQualifier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
								else
									$testing[$k]['productDetailQualifier'][$j];
							}
							$k++;
						}
					}
					else 
					{
						$count_flight_result = count($flight_details);
						for ($i = 0; $i < $count_flight_result; $i++) 
						{
							$testing[$k]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref'];
							$testing[$k]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref'];
							if(!isset($flight_details[$i]['flightDetails'][0]))
							{
								$testing[$k]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
								$testing[$k]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
								$testing[$k]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
								$testing[$k]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
								$testing[$k]['flightNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightNumber'];
								$testing[$k]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
								$testing[$k]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
								$testing[$k]['locationIdDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][0]['locationId'];
								$testing[$k]['locationIdArival'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][1]['locationId'];
								$testing[$k]['equipmentType'] = $flight_details[$i]['flightDetails']['flightInformation']['productDetail']['equipmentType'];
								$testing[$k]['electronicTicketing'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
								if (isset($flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
									$testing[$k]['productDetailQualifier'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
								else
									$testing[$k]['productDetailQualifier'] = '';$k++;
							}
							else 
							{
								$count_flight_details = count($flight_details[$i]['flightDetails']);
								for ($j = 0; $j < $count_flight_details; $j++) 
								{
									$testing[$k]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
									$testing[$k]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
									$testing[$k]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
									$testing[$k]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
									$testing[$k]['flightNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightNumber'];
									$testing[$k]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
									$testing[$k]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
									$testing[$k]['locationIdDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][0]['locationId'];
									$testing[$k]['locationIdArival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][1]['locationId'];
									$testing[$k]['equipmentType'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType'];
									$testing[$k]['electronicTicketing'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing'];
									if (isset($flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']))
										$testing[$k]['productDetailQualifier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
									else
										$testing[$k]['productDetailQualifier'][$j] = '';
								}
								$k++;
							}
						}
					}
				}
			}
             
            $flight_recommendation = $flight_result['recommendation'];
            $count_recommendation = count($flight_recommendation);  
            $count_testing = count($testing);
            //echo '<pre />';print_r($flight_recommendation);die;
           // echo  $count_testing.'<<>>'.$count_recommendation;die;
            for ($n = 0; $n < $count_testing; $n++)
            {
				//echo '<pre />';print_r($flight_recommendation);die;
				foreach ($flight_recommendation as $s)
				{
					$count_segmentFlightRef = (count($s['segmentFlightRef']));
					//echo $count_segmentFlightRef;die;
					if (!isset($s['segmentFlightRef'][0]))
					{
						
						if (isset($s['segmentFlightRef']['referencingDetail'][0]))
						{
							
							$count_referencingDetail = (count($s['segmentFlightRef']['referencingDetail']));
							for ($crd = 0; $crd < $count_referencingDetail; $crd++) 
							{
								if (($testing[$n]['ref'] == $s['segmentFlightRef']['referencingDetail'][$crd]['refNumber']) && ($s['segmentFlightRef']['referencingDetail'][$crd]['refQualifier']=="S"))
								{
									//echo $n;die;
									$testing[$n]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
									$testing[$n]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];
									//echo $n.": ".$testing[$n]['totalFareAmount']." ".$testing[$n]['totalFareAmount']."<br/>";die;
									if (!isset($s['paxFareProduct'][0])) 
									{
										$testing[$n]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
										$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));

										if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) 
										{
											$testing[$n]['paxFareProduct']['count'] = "1";
											$testing[$n]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
											if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) 
											{
												$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
											} 
											else 
											{
												$testing[$n]['paxFareProduct']['infantIndicator'] = "";
											}
										} 
										else 
										{
											$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
											$count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
											for ($p = 0; $p < $count_traveller; $p++) 
											{
												$testing[$n]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
												if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) 
												{
													$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
												} 
												else 
												{
													$testing[$n]['paxFareProduct']['infantIndicator'] = "";
												}
											}
										}

										$testing[$n]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
										$testing[$n]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];

										$testing[$n]['paxFareProduct']['description'] = "";
										if (!isset($s['paxFareProduct']['fare'][0])) 
										{
											//need updation	
											$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
											$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];

											//Description
											$count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
											if ($count_description <= 1) 
											{
												$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description'] . " ";
											} else 
											{
												for ($f = 0; $f < $count_description; $f++) 
												{
													$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f] . " ";
												}
											}
										} 
										else 
										{
											$count_fare = (count($s['paxFareProduct']['fare']));
											for ($e = 0; $e < $count_fare; $e++) 
											{
												$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
												$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

												//Description
												if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) 
												{
													$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description'] . " ";
												} 
												else 
												{
													$count_description = (count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']));
													for ($f = 0; $f < $count_description; $f++) 
													{
														$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f] . " ";
													}
												}
											}
										}

										if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) 
										{
											$testing[$n]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
											$testing[$n]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
											if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
												$testing[$n]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
											else
												$testing[$n]['paxFareProduct']['avlStatus'] = '';
											$testing[$n]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
											$testing[$n]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
										}
										else 
										{
											$count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
											for ($u = 0; $u < $count_groupOfFares; $u++) 
											{
												$testing[$n]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
												$testing[$n]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
												if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
													$testing[$n]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
												else
													$testing[$n]['paxFareProduct']['avlStatus'][$u] = '';
												$testing[$n]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
												$testing[$n]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
											}
										}
										$testing[$n]['paxFareProduct']['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
										$testing[$n]['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
									}
									else 
									{
										$count_paxFareProduct = (count($s['paxFareProduct']));
										//echo "<br/>".$count_paxFareProduct." ";
										for ($d = 0; $d < $count_paxFareProduct; $d++) 
										{
											$testing[$n]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
											if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) 
											{
												$testing[$n]['paxFareProduct'][$d]['count'] = "1";
												$testing[$n]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
												if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) 
												{
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
												} 
												else 
												{
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
												}
											}
											else 
											{
												$testing[$n]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
												$count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
												for ($p = 0; $p < $count_traveller; $p++) 
												{
													$testing[$n]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
												}
												if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) 
												{
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
												} 
												else 
												{
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
												}
											}

											$testing[$n]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
											$testing[$n]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

											$testing[$n]['paxFareProduct'][$d]['description'] = "";
											if (!isset($s['paxFareProduct'][$d]['fare'][0])) 
											{
												//need updation	
												$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
												$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

												if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) 
												{
													$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description'] . " ";
												} 
												else 
												{
													$count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
													for ($f = 0; $f < $count_description; $f++) 
													{
														$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f];
													}
												}
											} 
											else 
											{
												$count_fare = (count($s['paxFareProduct'][$d]['fare']));
												for ($e = 0; $e < $count_fare; $e++) 
												{
													$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
													$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

													$count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
													if ($count_description <= 1) 
													{
														$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'] . " ";
													} 
													else 
													{
														for ($f = 0; $f < $count_description; $f++) 
														{
															$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f] . " ";
														}
													}
												}
											}
											if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) 
											{
												if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) 
												{
													$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
													$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
													$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
													$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
													$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
												} 
												else 
												{
													$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
													for ($g = 0; $g < $count_groupOfFares; $g++) {
														$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
														$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
														$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
														$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
														$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
													}
												}
												$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];
												$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];
											} 
											else 
											{
												$count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
												for ($cfd = 0; $cfd < $count_fareDetails; $cfd++) 
												{
													if (!isset($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][0])) 
													{
														$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
														$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
														$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
														$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['breakPoint'];
														$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
													} 
													else 
													{
														$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']);
														for ($g = 0; $g < $count_groupOfFares; $g++) 
														{
															$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
															$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
															$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
															$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['breakPoint'];
															$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
														}
													}
													$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];
													$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];
												}
											}		
										}
									}

									if (isset($s['specificRecDetails'])) 
									{
										if (isset($s['specificRecDetails'][0])) 
										{
											$count_specificRecDetails = (count($s['specificRecDetails']));
											for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) 
											{
												if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) 
												{
													if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber']) 
													{
														if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
														{
															$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
															{
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														} 
														else 
														{
															$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													}
												} 
												else 
												{
													$count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
													for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
													{
														if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber']) 
														{
															if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
															{
																$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
																{
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															} 
															else 
															{
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														}
													}
												}
											}
										} 
										else 
										{
											if (!isset($s['specificRecDetails']['specificRecItem'][0])) 
											{
												if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem']['refNumber']) 
												{
													if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
													{
														$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
														for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
														{
															$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													} 
													else 
													{
														$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
													}
												}
											} 
											else 
											{
												$count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
												for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
												{
													if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem'][$sif]['refNumber']) 
													{
														if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
															$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														} 
														else 
														{
															$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													}
												}
											}
										}
									} 
									else 
									{
										
									}
								} 
								else 
								{
									
								}
							}
						}
						else 
						{
							
							if (($testing[$n]['ref'] == $s['segmentFlightRef']['referencingDetail']['refNumber']) && ($s['segmentFlightRef']['referencingDetail']['refQualifier']=="S"))
							{
								
								$testing[$n]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
								$testing[$n]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

								if (!isset($s['paxFareProduct'][0])) 
								{
									$testing[$n]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
									$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));

									//if((count($s['paxFareProduct']['paxReference']['traveller'])) == count(($s['paxFareProduct']['paxReference']['traveller']), COUNT_RECURSIVE))
									if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) 
									{
										$testing[$n]['paxFareProduct']['count'] = "1";
										$testing[$n]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
										if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) 
										{
											$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
										}
										else 
										{
											$testing[$n]['paxFareProduct']['infantIndicator'] = "";
										}
									} 
									else 
									{
										$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
										$count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
										for ($p = 0; $p < $count_traveller; $p++) 
										{
											$testing[$n]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
											if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) 
											{
												$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
											} 
											else 
											{
												$testing[$n]['paxFareProduct']['infantIndicator'] = "";
											}
										}
									}

									$testing[$n]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
									$testing[$n]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];

									$testing[$n]['paxFareProduct']['description'] = "";
									if (!isset($s['paxFareProduct']['fare'][0])) 
									{
										//need updation	
										$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
										$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];

										//Description
										$count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
										if ($count_description <= 1) 
										{
											$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description'] . " ";
										} 
										else 
										{
											for ($f = 0; $f < $count_description; $f++) 
											{
												$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f] . " ";
											}
										}
									} else 
									{
										$count_fare = (count($s['paxFareProduct']['fare']));
										for ($e = 0; $e < $count_fare; $e++) 
										{
											$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
											$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

											//Description
											if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) 
											{
												$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description'] . " ";
											} 
											else 
											{
												$count_description = (count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']));
												for ($f = 0; $f < $count_description; $f++) 
												{
													$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f] . " ";
												}
											}
										}
									}

									if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) 
									{
										$testing[$n]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
										$testing[$n]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
										if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
											$testing[$n]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
										else
											$testing[$n]['paxFareProduct']['avlStatus'] = '';
										$testing[$n]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
										$testing[$n]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
									}
									else 
									{
										$count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
										for ($u = 0; $u < $count_groupOfFares; $u++) 
										{
											$testing[$n]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
											$testing[$n]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
											if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
												$testing[$n]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
											else
												$testing[$n]['paxFareProduct']['avlStatus'][$u] = '';
											$testing[$n]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
											$testing[$n]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
										}
									}
									if(isset($s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']))
									{
										$testing[$n]['paxFareProduct']['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
									}
									else
									{
										$testing[$n]['paxFareProduct']['designator'] = '';
									}
									if(isset($s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']))
									{
										$testing[$n]['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
									}
									else
									{
										$testing[$n]['designator'] = '';
									}
								}
								else 
								{
									$count_paxFareProduct = (count($s['paxFareProduct']));
									for ($d = 0; $d < $count_paxFareProduct; $d++) 
									{
										$testing[$n]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
										if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) 
										{
											$testing[$n]['paxFareProduct'][$d]['count'] = "1";
											$testing[$n]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
											if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) 
											{
												$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
											} 
											else 
											{
												$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
											}
										} 
										else 
										{
											$testing[$n]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
											$count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
											for ($p = 0; $p < $count_traveller; $p++) {
												$testing[$n]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
											}
											if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
												$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
											} else {
												$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
											}
										}

										$testing[$n]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
										$testing[$n]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

										$testing[$n]['paxFareProduct'][$d]['description'] = "";
										if (!isset($s['paxFareProduct'][$d]['fare'][0])) 
										{
											//need updation	
											$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
											$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

											if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) 
											{
												$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description'] . " ";
											} 
											else 
											{
												$count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
												for ($f = 0; $f < $count_description; $f++) 
												{
													$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f];
												}
											}
										} 
										else 
										{
											$count_fare = (count($s['paxFareProduct'][$d]['fare']));
											for ($e = 0; $e < $count_fare; $e++) 
											{
												$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
												$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

												$count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
												if ($count_description <= 1) 
												{
													$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'] . " ";
												} 
												else 
												{
													for ($f = 0; $f < $count_description; $f++) 
													{
														$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f] . " ";
													}
												}
											}
										}

										if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) 
										{
											if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) 
											{
												$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
												$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
												$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
												$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
												$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
											} 
											else 
											{
												$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
												for ($g = 0; $g < $count_groupOfFares; $g++) 
												{
													$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
													$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
													$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
													$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
													$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
												}
											}
											$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];
											$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];
										} 
										else 
										{
											$countfareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
											for ($cfd = 0; $cfd < $countfareDetails; $cfd++) 
											{
												if (!isset($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][0])) 
												{
													$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
													$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
													$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
													$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['breakPoint'];
													$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
												} 
												else 
												{
													$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']);
													for ($g = 0; $g < $count_groupOfFares; $g++) 
													{
														$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
														$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
														$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
														$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['breakPoint'];
														$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
													}
												}
												$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];
												$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];
											}
										}
										// $testing[$n]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];									
										// $testing[$n]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];		
									}
								}


								if (isset($s['specificRecDetails'])) 
								{
									
									if (isset($s['specificRecDetails'][0])) 
									{
										$count_specificRecDetails = (count($s['specificRecDetails']));
										for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) 
										{
											if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) 
											{
												if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber']) 
												{
													if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
													{
														$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
														for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
														{
															$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													} 
													else 
													{
														$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
													}
												}
											} 
											else 
											{
												$count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
												for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
												{
													if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber']) 
													{
														if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
														{
															$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
															{
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														} 
														else 
														{
															$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													}
												}
											}
										}
									} 
									else 
									{
										if (!isset($s['specificRecDetails']['specificRecItem'][0])) 
										{
											if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem']['refNumber']) 
											{
												if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
												{
													$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
													for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
													{
														$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
													}
												} 
												else 
												{
													$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
												}
											}
										} 
										else 
										{
											$count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
											for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
											{
												if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem'][$sif]['refNumber']) 
												{
													if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
														$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
														for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
														{
															$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													} 
													else 
													{
														$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
													}
												}
											}
										}
									}
								} 
								else 
								{
									
								}
							} 
							else 
							{
								
							}
						}   
					}
					else
					{
						$count_segmentFlightRef = (count($s['segmentFlightRef']));
						for ($c = 0; $c < $count_segmentFlightRef; $c++) 
						{
							if (isset($s['segmentFlightRef'][$c]['referencingDetail'][0]))
							{
								$count_referencingDetail = (count($s['segmentFlightRef'][$c]['referencingDetail']));
								for ($crd = 0; $crd < $count_referencingDetail; $crd++) 
								{
									if (($testing[$n]['ref'] == $s['segmentFlightRef'][$c]['referencingDetail'][$crd]['refNumber']) && ($s['segmentFlightRef'][$c]['referencingDetail'][$crd]['refQualifier']=="S"))
									{
										$testing[$n]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
										$testing[$n]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

										if (!isset($s['paxFareProduct'][0])) 
										{
											$testing[$n]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
											
											$testing[$n]['paxFareProduct']['count'] = count($s['paxFareProduct']['paxReference']['traveller']);

											if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) 
											{
												$testing[$n]['paxFareProduct']['count'] = "1";
												$testing[$n]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
												if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) 
												{
													$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
												} 
												else 
												{
													$testing[$n]['paxFareProduct']['infantIndicator'] = "";
												}
											} 
											else 
											{
												$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
												$count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
												for ($p = 0; $p < $count_traveller; $p++) 
												{
													$testing[$n]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
												}
												if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) 
												{
													$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
												} 
												else 
												{
													$testing[$n]['paxFareProduct']['infantIndicator'] = "";
												}
											}

											$testing[$n]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
											$testing[$n]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];

											$testing[$n]['paxFareProduct']['description'] = "";
											if (!isset($s['paxFareProduct']['fare'][0])) 
											{
												//need updation
												$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
												$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];

												if (!isset($s['paxFareProduct']['fare']['pricingMessage']['description'][0])) 
												{
													$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description'] . " ";
												} 
												else 
												{
													$count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
													for ($f = 0; $f < $count_description; $f++) 
													{
														$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f] . " ";
													}
												}
											} 
											else 
											{
												$count_fare = count($s['paxFareProduct']['fare']);
												for ($e = 0; $e < $count_fare; $e++) 
												{
													$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
													$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

													if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) 
													{
														$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description'] . " ";
													} 
													else 
													{
														$count_description = count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']);
														for ($f = 0; $f < $count_description; $f++) 
														{
															$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f] . " ";
														}
													}
												}
											}

											if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) 
											{
												$testing[$n]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
												$testing[$n]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
												if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
													$testing[$n]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
												else
													$testing[$n]['paxFareProduct']['avlStatus'] = '';
												$testing[$n]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
												$testing[$n]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
											}
											else 
											{
												$count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
												for ($u = 0; $u < $count_groupOfFares; $u++) 
												{
													$testing[$n]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
													$testing[$n]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
													if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
														$testing[$n]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
													else
														$testing[$n]['paxFareProduct']['avlStatus'][$u] = '';
													$testing[$n]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
													$testing[$n]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
												}
											}
											$testing[$n]['paxFareProduct']['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
											$testing[$n]['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
										}
										else 
										{
											$count_paxFareProduct = (count($s['paxFareProduct']));
											for ($d = 0; $d < $count_paxFareProduct; $d++) 
											{
												$testing[$n]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
												if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) 
												{
													$testing[$n]['paxFareProduct'][$d]['count'] = "1";
													$testing[$n]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
													if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) 
													{
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
													} 
													else 
													{
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
													}
												} 
												else 
												{
													$testing[$n]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
													$count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
													for ($p = 0; $p < $count_traveller; $p++) 
													{
														$testing[$n]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
													}
													if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) 
													{
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
													} 
													else 
													{
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
													}
												}

												$testing[$n]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
												$testing[$n]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

												$testing[$n]['paxFareProduct'][$d]['description'] = "";
												if (!isset($s['paxFareProduct'][$d]['fare'][0])) 
												{
													//need updation	
													$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
													$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

													if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) 
													{
														$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description'] . " ";
													} 
													else 
													{
														$count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
														for ($f = 0; $f < $count_description; $f++) 
														{
															$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f] . " ";
														}
													}
												} 
												else 
												{
													$count_fare = (count($s['paxFareProduct'][$d]['fare']));
													for ($e = 0; $e < $count_fare; $e++) 
													{
														$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
														$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

														if (!isset($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][0])) 
														{
															$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'] . " ";
														} 
														else 
														{
															$count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
															for ($f = 0; $f < $count_description; $f++) {
																$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f];
															}
														}
													}
												}
												if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) 
												{
													if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) 
													{
														$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
														$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
														$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
														$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
														$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
													} 
													else 
													{
														$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
														for ($g = 0; $g < $count_groupOfFares; $g++) 
														{
															$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
															$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
															$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
															$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
															$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
														}
													}
													$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];
													$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];
												} 
												else 
												{
													$count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
													for ($cfd = 0; $cfd < $count_fareDetails; $cfd++) 
													{
														if (!isset($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][0])) 
														{
															$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
															$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
															$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
															$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['breakPoint'];
															$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
														} 
														else 
														{
															$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']);
															for ($g = 0; $g < $count_groupOfFares; $g++) 
															{
																$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
																$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
																$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
																$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['breakPoint'];
																$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
															}
														}
														$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];
														$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];
													}
												}
												//$testing[$n]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
												//$testing[$n]['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
											}
										}


										if (isset($s['specificRecDetails'])) 
										{
											if (isset($s['specificRecDetails'][0])) 
											{
												$count_specificRecDetails = (count($s['specificRecDetails']));
												for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) 
												{
													if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) 
													{
														if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber']) 
														{
															if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
															{
																$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
																{
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															} 
															else 
															{
																$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														}
													} 
													else 
													{
														$count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
														for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
														{
															if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber']) {
																if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
																{
																	$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																	for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
																	{
																		$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																	}
																} 
																else 
																{
																	$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															}
														}
													}
												}
											} 
											else 
											{
												if (!isset($s['specificRecDetails']['specificRecItem'][0])) {
													if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem']['refNumber']) 
													{
														if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
														{
															$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
															{
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														} 
														else 
														{
															$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													}
												} 
												else 
												{
													$count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
													for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
													{
														if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem'][$sif]['refNumber']) 
														{
															if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
															{
																$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
																{
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															} 
															else 
															{
																$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														}
													}
												}
											}
										} 
										else 
										{
											
										}
									} 
									else 
									{
										//nothing
									}
								}
							}
							else
							{
								if ($testing[$n]['ref'] == $s['segmentFlightRef'][$c]['referencingDetail']['refNumber']) 
								{
									
									$testing[$n]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
									$testing[$n]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];
									if (!isset($s['paxFareProduct'][0])) 
									{
										$testing[$n]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
										$testing[$n]['paxFareProduct']['count'] = count($s['paxFareProduct']['paxReference']['traveller']);

										if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) 
										{
											$testing[$n]['paxFareProduct']['count'] = "1";
											$testing[$n]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
											if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) 
											{
												$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
											} 
											else 
											{
												$testing[$n]['paxFareProduct']['infantIndicator'] = "";
											}
										} 
										else 
										{
											$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
											$count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
											for ($p = 0; $p < $count_traveller; $p++) 
											{
												$testing[$n]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
											}
											if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) 
											{
												$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
											} 
											else 
											{
												$testing[$n]['paxFareProduct']['infantIndicator'] = "";
											}
										}

										$testing[$n]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
										$testing[$n]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];

										$testing[$n]['paxFareProduct']['description'] = "";
										if (!isset($s['paxFareProduct']['fare'][0])) 
										{
											//need updation
											$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
											$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];

											if (!isset($s['paxFareProduct']['fare']['pricingMessage']['description'][0])) 
											{
												$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description'] . " ";
											} 
											else 
											{
												$count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
												for ($f = 0; $f < $count_description; $f++) 
												{
													$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f] . " ";
												}
											}
										} 
										else 
										{
											$count_fare = count($s['paxFareProduct']['fare']);
											for ($e = 0; $e < $count_fare; $e++) 
											{
												$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
												$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

												if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) 
												{
													$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description'] . " ";
												} 
												else 
												{
													$count_description = count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']);
													for ($f = 0; $f < $count_description; $f++) 
													{
														$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f] . " ";
													}
												}
											}
										}

										if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) 
										{
											$testing[$n]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
											$testing[$n]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
											if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
												$testing[$n]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
											else
												$testing[$n]['paxFareProduct']['avlStatus'] = '';
											$testing[$n]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
											$testing[$n]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
										}
										else 
										{
											$count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
											for ($u = 0; $u < $count_groupOfFares; $u++) 
											{
												$testing[$n]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
												$testing[$n]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
												if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
													$testing[$n]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
												else
													$testing[$n]['paxFareProduct']['avlStatus'][$u] = '';
												$testing[$n]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
												$testing[$n]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
											}
										}
										if(isset($s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']))
										{
											$testing[$n]['paxFareProduct']['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
										}
										else
										{
											$testing[$n]['paxFareProduct']['designator'] = '';
										}
										if(isset($s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']))
										{
											$testing[$n]['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
										}
										else
										{
											$testing[$n]['designator'] = '';
										}
									}
									else 
									{
										$count_paxFareProduct = (count($s['paxFareProduct']));
										for ($d = 0; $d < $count_paxFareProduct; $d++) 
										{
											$testing[$n]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
											if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) 
											{
												$testing[$n]['paxFareProduct'][$d]['count'] = "1";
												$testing[$n]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
												if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) 
												{
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
												} 
												else 
												{
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
												}
											} 
											else 
											{
												$testing[$n]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
												$count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
												for ($p = 0; $p < $count_traveller; $p++) {
													$testing[$n]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
												}
												if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
												} 
												else 
												{
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
												}
											}

											$testing[$n]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
											$testing[$n]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

											$testing[$n]['paxFareProduct'][$d]['description'] = "";
											if (!isset($s['paxFareProduct'][$d]['fare'][0])) 
											{
												//need updation	
												$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
												$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

												if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) 
												{
													$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description'] . " ";
												} 
												else 
												{
													$count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
													for ($f = 0; $f < $count_description; $f++) 
													{
														$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f] . " ";
													}
												}
											} 
											else 
											{
												$count_fare = (count($s['paxFareProduct'][$d]['fare']));
												for ($e = 0; $e < $count_fare; $e++) 
												{
													$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
													$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

													if (!isset($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][0])) 
													{
														$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'] . " ";
													} 
													else 
													{
														$count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
														for ($f = 0; $f < $count_description; $f++) 
														{
															$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f];
														}
													}
												}
											}

											if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) 
											{
												$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
												$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
												$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
												$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
												$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
											} 
											else 
											{
												$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
												for ($g = 0; $g < $count_groupOfFares; $g++) 
												{
													$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
													$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
													$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
													$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
													$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
												}
											}
											$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];
											$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];
										}
									}

									if (isset($s['specificRecDetails'])) 
									{
										if (isset($s['specificRecDetails'][0])) 
										{
											$count_specificRecDetails = (count($s['specificRecDetails']));
											for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) 
											{
												if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) 
												{
													if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber']) 
													{
														if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
															$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
															{
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														} 
														else 
														{
															$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													}
												} 
												else 
												{
													$count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
													for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
													{
														if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber']) 
														{
															if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
																{
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															} 
															else 
															{
																$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														}
													}
												}
											}
										} 
										else 
										{
											if (!isset($s['specificRecDetails']['specificRecItem'][0])) 
											{
												if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem']['refNumber']) 
												{
													if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
														$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
														for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
														{
															$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													} 
													else 
													{
														$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
													}
												}
											} 
											else 
											{
												$count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
												for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
												{
													if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem'][$sif]['refNumber']) 
													{
														if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
															$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
															{
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														} 
														else 
														{
															$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													}
												}
											}
										}
									} 
									else 
									{
										
									}
									
								} 
								else 
								{
									//nothing
								}
							}
							
							
						}
					   
					}
				}
			}
			
			
			//echo '<pre />';print_r($testing);die;
			
			$data['flight_result'] = $flight_result = $testing;
            $data['currency'] = $currency;
            if ($flight_result != '') 
			{
				$count_val = count($flight_result);
				$i = 0;
				$total = 0;
				$jj=0;
				foreach ($flight_result as $flight_result) 
				{
					$count_code = count($flight_result['marketingCarrier']);
					if ($count_code <= 1) 
					{
						$name = $this->Flights_Model->get_flight_name($flight_result['marketingCarrier']);
						if ($name != '') 
						{
							
							$testing1[$i]['cicode'] = $flight_result['marketingCarrier'];
							$testing1[$i]['name'] = $name;
							$testing1[$i]['fnumber'] = $flight_result['flightNumber'];
							$testing1[$i]['dlocation'] = $flight_result['locationIdDeparture'];
							$testing1[$i]['alocation'] = $flight_result['locationIdArival'];
							$testing1[$i]['timeOfDeparture'] = $flight_result['timeOfDeparture'];
							$testing1[$i]['timeOfArrival'] = $flight_result['timeOfArrival'];
							$testing1[$i]['dateOfDeparture'] = $flight_result['dateOfDeparture'];
							$testing1[$i]['dateOfArrival'] = $flight_result['dateOfArrival'];
							$testing1[$i]['equipmentType'] = $flight_result['equipmentType'];

							$departureDate = $flight_result['dateOfDeparture'];
							$departureTime = $flight_result['timeOfDeparture'];
							$arrivalDate = $flight_result['dateOfArrival'];
							$arrivalTime = $flight_result['timeOfArrival'];

							if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
								$testing1[$i]['redeye'] = "Yes";
							else
								$testing1[$i]['redeye'] = "No";

							$testing1[$i]['dtime_filter'] = $departureTime;
							$testing1[$i]['atime_filter'] = $arrivalTime;

							$testing1[$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
							$testing1[$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";
							
							$testing1[$i]['dep_date'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
							$testing1[$i]['arv_date'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));

							//Final Duration Part
							$testing1[$i]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
							$testing1[$i]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
							$date_a = new DateTime($testing1[$i]['ddate1']);
							$date_b = new DateTime($testing1[$i]['adate1']);
							$interval = date_diff($date_a, $date_b);
							$testing1[$i]['duration_final'] = $interval->format('%h Hours %i Minutes');
							$testing1[$i]['duration_final1'] = $interval->format('%h H %i M');
							
							
							$hours_eft = floor(($flight_result['eft']) / 60);
							$day_eft = floor(($flight_result['eft']) / 1440);
							$minutes_eft = (($flight_result['eft']) % 60);
							if($hours_eft>24)
									$hours_eft=($hours_eft % 24);

							if ($day_eft > 0)
									$testing1[$i]['duration_final_eft'] = $day_eft."D ".$hours_eft."H ".$minutes_eft."M";
							else
									$testing1[$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
							
							$hour = $interval->format('%h');
							$min = $interval->format('%i');
							$dur_in_min = (($hour * 60) + $min);
							$testing1[$i]['dur_in_min'] = $dur_in_min;
							
							$total = (($flight_result['totalFareAmount']));
							$testing1[$i]['FareAmount'] = $flight_result['totalFareAmount'];
							$testing1[$i]['TaxAmount'] = $flight_result['totalTaxAmount'];
							$testing1[$i]['pamount'] = $total;
							$testing1[$i]['fareType'] = $flight_result['paxFareProduct']['fareType'];
							$testing1[$i]['ccode'] = $data['currency'];
							$testing1[$i]['id'] = $i;
							if (!isset($fligh_result['designator']))
								$testing1[$i]['designator'] = "";
							else
								$testing1[$i]['designator'] = $flight_result['designator'];
							$testing1[$i]['stops'] = "0";
							$testing1[$i]['flag'] = "false";
							$testing1[$i]['rand_id'] = $rand_id;

							//Markup Values
							//$adminmarkupvalue = $adminmarkup->markup;
							//$pgvalue = $pg->charge;
							$adminmarkupvalue=0;
							$pgvalue=0;

							$testing1[$i]['admin_markup'] = $adminmarkupvalue;
							$testing1[$i]['payment_charge'] = $pgvalue;

							$API_FareAmount = $total;
							$admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
							$markup1 = $API_FareAmount + $admin_markup;
							$pg_charge = ($markup1 * $pgvalue) / 100;
							$Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
							$total_markup = $admin_markup + $pg_charge;
							$testing1[$i]['Total_FareAmount'] = ($Total_FareAmount);
							if (isset($flight_result['paxFareProduct'][0]['rbd'])) 
							{
								$testing1[$i]['BookingClass'] = $flight_result['paxFareProduct'][0]['rbd'];
								$testing1[$i]['cabin'] = $flight_result['paxFareProduct'][0]['cabin'];
							} 
							else 
							{
								$testing1[$i]['BookingClass'] = $flight_result['paxFareProduct']['rbd'];
								$testing1[$i]['cabin'] = $flight_result['paxFareProduct']['cabin'];
							}

							$i++;
						}
						
					} 
					else 
					{
						$testing1[$i]['dur_in_min'] = "";
						$testing1[$i]['dur_in_min_layover'] = "";
						$testing1[$i]['pamount'] = "";
						$flag_marketingCarrier_set_true = false;
						$flag_marketingCarrier_set_false = true;
						$h = 0;
						$m = 0;
						$total = 0;
						for ($j = 0; $j < ($count_code); $j++) 
						{
							$name = $this->Flights_Model->get_flight_name($flight_result['marketingCarrier'][$j]);
							if ($name != '') 
							{
								$testing1[$i]['cicode'][$j] = $flight_result['marketingCarrier'][$j];
								$testing1[$i]['name'][$j] = $name;
								$testing1[$i]['fnumber'][$j] = $flight_result['flightNumber'][$j];
								$testing1[$i]['dlocation'][$j] = $flight_result['locationIdDeparture'][$j];
								$testing1[$i]['alocation'][$j] = $flight_result['locationIdArival'][$j];
								$testing1[$i]['timeOfDeparture'][$j] = $flight_result['timeOfDeparture'][$j];
								$testing1[$i]['timeOfArrival'][$j] = $flight_result['timeOfArrival'][$j];
								$testing1[$i]['dateOfDeparture'][$j] = $flight_result['dateOfDeparture'][$j];
								$testing1[$i]['dateOfArrival'][$j] = $flight_result['dateOfArrival'][$j];

								$departureDate = $flight_result['dateOfDeparture'][$j];
								$departureTime = $flight_result['timeOfDeparture'][$j];
								$arrivalDate = $flight_result['dateOfArrival'][$j];
								$arrivalTime = $flight_result['timeOfArrival'][$j];
								$testing1[$i]['equipmentType'] = $flight_result['equipmentType'];

								$testing1[$i]['dtime_filter'] = $flight_result['timeOfDeparture'][0];
								$testing1[$i]['atime_filter'] = $arrivalTime;

								if ((($flight_result['timeOfDeparture'][0]) <= "0700") && ($arrivalTime >= "2000"))
									$testing1[$i]['redeye'] = "Yes";
								else
									$testing1[$i]['redeye'] = "No";



								$testing1[$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
								$testing1[$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

								$testing1[$i]['dep_date'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
								$testing1[$i]['arv_date'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));

								//Final Duration Part
								$testing1[$i]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
								$testing1[$i]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
								$date_a = new DateTime($testing1[$i]['ddate1'][$j]);
								$date_b = new DateTime($testing1[$i]['adate1'][$j]);
								$interval = date_diff($date_a, $date_b);
								$testing1[$i]['duration_final'][$j] = $interval->format('%h Hours %i Minutes');
								$testing1[$i]['duration_final1'][$j] = $interval->format('%h H %i M');
								
								$hours_eft = floor(($flight_result['eft']) / 60);
								$day_eft = floor(($flight_result['eft']) / 1440);
								$minutes_eft = (($flight_result['eft']) % 60);
								if($hours_eft>24)
										$hours_eft=($hours_eft % 24);

								if ($day_eft > 0)
										$testing1[$i]['duration_final_eft'] = $day_eft."D ".$hours_eft."H ".$minutes_eft."M";
								else
										$testing1[$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
								

								$hour = $interval->format('%h');
								$min = $interval->format('%i');
								$dur_in_min = (($hour * 60) + $min);
								$testing1[$i]['dur_in_min']+= $dur_in_min;

								if ($j != ($count_code - 1)) 
								{
									$arrivalDate_layover = $flight_result['dateOfArrival'][0];
									$arrivalTime_layover = $flight_result['timeOfArrival'][0];
									$departureDate_layover = $flight_result['dateOfDeparture'][($j + 1)];
									$departureTime_layover = $flight_result['timeOfDeparture'][($j + 1)];

									$depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
									$arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
									$date_c = new DateTime($depart_layover);
									$date_d = new DateTime($arival_layover);
									$interval_layover = date_diff($date_c, $date_d);
									$testing1[$i]['duration_final_layover'][$j] = $interval_layover->format('%h hours %i minutes');

									$hour_layover = $interval_layover->format('%h');
									$min_layover = $interval_layover->format('%i');
									$dur_in_min_layover = (($hour_layover * 60) + $min_layover);
									$testing1[$i]['dur_in_min_layover'][$j] = $dur_in_min_layover;
								} 
								else 
								{
									$testing1[$i]['duration_final_layover'][$j] = '';
									$testing1[$i]['dur_in_min_layover'][$j] = '';
								}

								if ($flight_result['marketingCarrier'][0] != $flight_result['marketingCarrier'][$j])
									$flag_marketingCarrier_set_true = true;
								else
									$flag_marketingCarrier_set_flag = false;

								if ($flag_marketingCarrier_set_true == true)
									$testing1[$i]['flag_marketingCarrier'] = true;
								else
									$testing1[$i]['flag_marketingCarrier'] = false;
									
								$total = (($flight_result['totalFareAmount']));
								$testing1[$i]['FareAmount'] = $flight_result['totalFareAmount'];
								$testing1[$i]['TaxAmount'] = $flight_result['totalTaxAmount'];
								$testing1[$i]['fareType'] = $flight_result['paxFareProduct']['fareType'];
								$testing1[$i]['pamount'] = $total;
								$testing1[$i]['ccode'] = $data['currency'];
								$testing1[$i]['id'] = $i;
								if (!isset($fligh_result['designator']))
									$testing1[$i]['designator'] = "";
								else
									$testing1[$i]['designator'] = $flight_result['designator'];
								$testing1[$i]['stops'] = ($count_code - 1);
								$testing1[$i]['flag'] = "true";
								$testing1[$i]['rand_id'] = $rand_id;

								//Markup Values
								//$adminmarkupvalue = $adminmarkup->markup;
								//$pgvalue = $pg->charge;
								$adminmarkupvalue=0;
								$pgvalue=0;

								$testing1[$i]['admin_markup'] = $adminmarkupvalue;
								$testing1[$i]['payment_charge'] = $pgvalue;

								$API_FareAmount = $total;
								$admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
								$markup1 = $API_FareAmount + $admin_markup;
								$pg_charge = ($markup1 * $pgvalue) / 100;
								$Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
								$total_markup = $admin_markup + $pg_charge;
								$testing1[$i]['Total_FareAmount'] = ($Total_FareAmount);
								if (isset($flight_result['paxFareProduct'][0]['rbd'][$j])) 
								{
									$testing1[$i]['BookingClass'][$j] = $flight_result['paxFareProduct'][0]['rbd'][$j];
									$testing1[$i]['cabin'][$j] = $flight_result['paxFareProduct'][0]['cabin'][$j];
								} 
								else 
								{
									$testing1[$i]['BookingClass'][$j] = $flight_result['paxFareProduct']['rbd'][$j];
									$testing1[$i]['cabin'][$j] = $flight_result['paxFareProduct']['cabin'][$j];
								}
							}
						}
						$i++;
					}
					
					//echo '<pre />';print_r($testing1);//die;
					if($testing1[$jj]['stops'] > 0)
					{
						$dur_in_min_layover=implode('<br>',$testing1[$jj]['dur_in_min_layover']);
						$cicode=implode('<br>',$testing1[$jj]['cicode']);
						$name=implode('<br>',$testing1[$jj]['name']);
						$fnumber=implode('<br>',$testing1[$jj]['fnumber']);
						$dlocation=implode('<br>',$testing1[$jj]['dlocation']);
						$alocation=implode('<br>',$testing1[$jj]['alocation']);
						$timeOfDeparture=implode('<br>',$testing1[$jj]['timeOfDeparture']);
						$timeOfArrival=implode('<br>',$testing1[$jj]['timeOfArrival']);
						$dateOfDeparture=implode('<br>',$testing1[$jj]['dateOfDeparture']);
						$dateOfArrival=implode('<br>',$testing1[$jj]['dateOfArrival']);
						$equipmentType=implode('<br>',$testing1[$jj]['equipmentType']);
						$ddate=implode('<br>',$testing1[$jj]['ddate']);
						$adate=implode('<br>',$testing1[$jj]['adate']);
						$dep_date=implode('<br>',$testing1[$jj]['dep_date']);
						$arv_date=implode('<br>',$testing1[$jj]['arv_date']);
						$ddate1=implode('<br>',$testing1[$jj]['ddate1']);
						$adate1=implode('<br>',$testing1[$jj]['adate1']);
						$duration_final=implode('<br>',$testing1[$jj]['duration_final']);
						$duration_final1=implode('<br>',$testing1[$jj]['duration_final1']);
						$duration_final_layover=implode('<br>',$testing1[$jj]['duration_final_layover']);
						$fareType=implode('<br>',$testing1[$jj]['fareType']);
						$BookingClass=implode('<br>',$testing1[$jj]['BookingClass']);
						$cabin=implode('<br>',$testing1[$jj]['cabin']);
						
						
						$insert_array[]=array(
						'session_id'=>$session_id,'akbar_session'=>$_SESSION['akbar_session'],'journey_type'=>'OneWay','cicode'=>$cicode,'name'=>$name,'fnumber'=>$fnumber,
						'dlocation'=>$dlocation,'alocation'=>$alocation,'timeOfDeparture'=>$timeOfDeparture,'timeOfArrival'=>$timeOfArrival,'dateOfDeparture'=>$dateOfDeparture,
						'dateOfArrival'=>$dateOfArrival,'equipmentType'=>$equipmentType,'redeye'=>$testing1[$jj]['redeye'],'dtime_filter'=>$testing1[$jj]['dtime_filter'],'atime_filter'=>$testing1[$jj]['atime_filter'],'ddate'=>$ddate,'adate'=>$adate,'dep_date'=>$dep_date,'arv_date'=>$arv_date,
						'ddate1'=>$ddate1,'adate1'=>$adate1,'duration_final'=>$duration_final,'duration_final1'=>$duration_final1,
						'duration_final_eft'=>$testing1[$jj]['duration_final_eft'],'duration_final_layover'=>$duration_final_layover,
						'dur_in_min'=>$testing1[$jj]['dur_in_min'],'dur_in_min_layover'=>$dur_in_min_layover,'FareAmount'=>$testing1[$jj]['FareAmount'],
						'TaxAmount'=>$testing1[$jj]['TaxAmount'],'pamount'=>$testing1[$jj]['pamount'],'fareType'=>$fareType,'ccode'=>$testing1[$jj]['ccode'],
						'designator'=>$testing1[$jj]['designator'],'stops'=>$testing1[$jj]['stops'],'flag'=>$testing1[$jj]['flag'],'rand_id'=>$testing1[$jj]['rand_id'],
						'admin_markup'=>$testing1[$jj]['admin_markup'],'payment_charge'=>$testing1[$jj]['payment_charge'],'Total_FareAmount'=>$testing1[$jj]['Total_FareAmount'],
						'BookingClass'=>$BookingClass,'cabin'=>$cabin,'flag_marketingCarrier'=>$testing1[$jj]['flag_marketingCarrier'],'from_airport'=>'','to_airport'=>'','fromcityval'=>$fromcityval_for_cache,'tocityval'=>$tocityval_for_cache,'sd'=>$sd_cache,'ed'=>$ed_cache,'adults'=>$adults_cache,'childs'=>$childs_cache,'infants'=>$infants_cache,'journey_types'=>$journey_types_cache,'cabin_selected'=>$cabin_selected_cache);
					}
					else
					{
						if(is_array($testing1[$jj]['fareType']))
						{
								$fareType=implode('<br>',$testing1[$jj]['fareType']);
						}
						else $fareType=$testing1[$jj]['fareType'];
						$insert_array[]=array(
						'session_id'=>$session_id,'akbar_session'=>$_SESSION['akbar_session'],'journey_type'=>'OneWay','cicode'=>$testing1[$jj]['cicode'],'name'=>$testing1[$jj]['name'],'fnumber'=>$testing1[$jj]['fnumber'],
						'dlocation'=>$testing1[$jj]['dlocation'],'alocation'=>$testing1[$jj]['alocation'],'timeOfDeparture'=>$testing1[$jj]['timeOfDeparture'],'timeOfArrival'=>$testing1[$jj]['timeOfArrival'],'dateOfDeparture'=>$testing1[$jj]['dateOfDeparture'],
						'dateOfArrival'=>$testing1[$jj]['dateOfArrival'],'equipmentType'=>$testing1[$jj]['equipmentType'],'redeye'=>$testing1[$jj]['redeye'],'dtime_filter'=>$testing1[$jj]['dtime_filter'],'atime_filter'=>$testing1[$jj]['atime_filter'],'ddate'=>$testing1[$jj]['ddate'],'adate'=>$testing1[$jj]['adate'],'dep_date'=>$testing1[$jj]['dep_date'],'arv_date'=>$testing1[$jj]['arv_date'],
						'ddate1'=>$testing1[$jj]['ddate1'],'adate1'=>$testing1[$jj]['adate1'],'duration_final'=>$testing1[$jj]['duration_final'],'duration_final1'=>$testing1[$jj]['duration_final1'],'duration_final_eft'=>$testing1[$jj]['duration_final_eft'],'duration_final_layover'=>'','dur_in_min'=>$testing1[$jj]['dur_in_min'],'dur_in_min_layover'=>'','FareAmount'=>$testing1[$jj]['FareAmount'],
						'TaxAmount'=>$testing1[$jj]['TaxAmount'],'pamount'=>$testing1[$jj]['pamount'],'fareType'=>$fareType,'ccode'=>$testing1[$jj]['ccode'],'designator'=>$testing1[$jj]['designator'],'stops'=>$testing1[$jj]['stops'],'flag'=>$testing1[$jj]['flag'],'rand_id'=>$testing1[$jj]['rand_id'],'admin_markup'=>$testing1[$jj]['admin_markup'],
						'payment_charge'=>$testing1[$jj]['payment_charge'],'Total_FareAmount'=>$testing1[$jj]['Total_FareAmount'],'BookingClass'=>$testing1[$jj]['BookingClass'],'cabin'=>$testing1[$jj]['cabin'],'flag_marketingCarrier'=>'','from_airport'=>'','to_airport'=>'','fromcityval'=>$fromcityval_for_cache,'tocityval'=>$tocityval_for_cache,'sd'=>$sd_cache,'ed'=>$ed_cache,'adults'=>$adults_cache,'childs'=>$childs_cache,'infants'=>$infants_cache,'journey_types'=>$journey_types_cache,'cabin_selected'=>$cabin_selected_cache);
					}
					
					$jj++;
				}
				//echo 'fdgdsfgdfg';die;
				//echo $_SESSION['akbar_session'].'<<<<>>>>'.$session_id;die;
				//echo '<pre />';print_r($insert_array);die;
				$this->db->query($sql="delete from flight_search_result where session_id='".$session_id."'");
				$this->db->insert_batch('flight_search_result',$insert_array);
			}
		}
		else if($data['flight_result']!='' && $_SESSION['journey_type'] == "Round")
		{
			if (!empty($data['flight_result'])) 
			{			
                $flight_result = $data['flight_result'];
                $currency = $flight_result['conversionRate']['conversionRateDetail']['currency'];

                //Flight Details for OneWay
                if (!isset($flight_result['flightIndex'][0])) 
                {
                    $flight_details = $flight_result['flightIndex']['groupOfFlights'];
                    $count_flight_result = count($flight_details);

                    for ($i = 0; $i < $count_flight_result; $i++) 
                    {
                        $count_flight_details = count($flight_details[$i]['flightDetails']);
                        //echo "Loop ".$i." : ".$count_flight_details."<br/>";

                        $flightDetails[$i]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref'];
                        $flightDetails[$i]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref'];
                        if ($count_flight_details <= 1) 
                        {
                            $flightDetails[$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                            $flightDetails[$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                            $flightDetails[$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                            $flightDetails[$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                            $flightDetails[$i]['flightNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightNumber'];
                            $flightDetails[$i]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
                            $flightDetails[$i]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
                            $flightDetails[$i]['locationIdDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][0]['locationId'];
                            $flightDetails[$i]['locationIdArival'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][1]['locationId'];
                            $flightDetails[$i]['equipmentType'] = $flight_details[$i]['flightDetails']['flightInformation']['productDetail']['equipmentType'];
                            $flightDetails[$i]['electronicTicketing'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
                            $flightDetails[$i]['productDetailQualifier'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
                        } 
                        else 
                        {
                            for ($j = 0; $j < $count_flight_details; $j++) {
                                $flightDetails[$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                $flightDetails[$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                $flightDetails[$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                $flightDetails[$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                $flightDetails[$i]['flightNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightNumber'];
                                $flightDetails[$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
                                $flightDetails[$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
                                $flightDetails[$i]['locationIdDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][0]['locationId'];
                                $flightDetails[$i]['locationIdArival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][1]['locationId'];
                                $flightDetails[$i]['equipmentType'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType'];
                                $flightDetails[$i]['electronicTicketing'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing'];
                                $flightDetails[$i]['productDetailQualifier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
                            }
                        }
                    }
                }//Flight Details for Return_Part
                else 
                {
                    $return_count = (count($flight_result['flightIndex']));
                    for ($re = 0; $re < $return_count; $re++) 
                    {
                        $flight_details = $flight_result['flightIndex'][$re]['groupOfFlights'];
                        $count_flight_result = (count($flight_details));

                        for ($i = 0; $i < $count_flight_result; $i++) 
                        {
                            $count_flight_details = count($flight_details[$i]['flightDetails']);


                            $flightDetails[$re]['return'][$i]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref'];
                            $flightDetails[$re]['return'][$i]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref'];
                            //if ($count_flight_details <= 1) {
                            if(!isset($flight_details[$i]['flightDetails'][0]))
                            {
                                $flightDetails[$re]['return'][$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                                $flightDetails[$re]['return'][$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                                $flightDetails[$re]['return'][$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                                $flightDetails[$re]['return'][$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                                $flightDetails[$re]['return'][$i]['flightNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightNumber'];
                                $flightDetails[$re]['return'][$i]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
                                if(isset($flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier']))
								{
									$flightDetails[$re]['return'][$i]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
								}
								else
								{
									$flightDetails[$re]['return'][$i]['operatingCarrier'] = '';
								}
                                $flightDetails[$re]['return'][$i]['locationIdDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][0]['locationId'];
                                $flightDetails[$re]['return'][$i]['locationIdArival'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][1]['locationId'];
                                $flightDetails[$re]['return'][$i]['equipmentType'] = $flight_details[$i]['flightDetails']['flightInformation']['productDetail']['equipmentType'];
                                $flightDetails[$re]['return'][$i]['electronicTicketing'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
                                if (isset($flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
                                    $flightDetails[$re]['return'][$i]['productDetailQualifier'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
                                else
                                    $flightDetails[$re]['return'][$i]['productDetailQualifier'] = '';
                            }
                            else 
                            {
                                for ($j = 0; $j < $count_flight_details; $j++) {
                                    $flightDetails[$re]['return'][$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                    $flightDetails[$re]['return'][$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                    $flightDetails[$re]['return'][$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                    $flightDetails[$re]['return'][$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                    $flightDetails[$re]['return'][$i]['flightNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightNumber'];
                                    $flightDetails[$re]['return'][$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
                                    if(isset($flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier']))
									{
										$flightDetails[$re]['return'][$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
									}
									else
									{
										$flightDetails[$re]['return'][$i]['operatingCarrier'][$j] = '';
									}
                                    $flightDetails[$re]['return'][$i]['locationIdDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][0]['locationId'];
                                    $flightDetails[$re]['return'][$i]['locationIdArival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][1]['locationId'];
                                    $flightDetails[$re]['return'][$i]['equipmentType'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType'];
                                    $flightDetails[$re]['return'][$i]['electronicTicketing'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing'];
                                    if (isset($flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']))
                                        $flightDetails[$re]['return'][$i]['productDetailQualifier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
                                    else
                                        $flightDetails[$re]['return'][$i]['productDetailQualifier'][$j] = '';
                                }
                            }
                        }
                    }
                }



                //echo '<pre/>Flight Details:<br/>';print_r($flightDetails);exit;
                $flight_recommendation = $flight_result['recommendation'];
                $count_recommendation = count($flight_recommendation);
                $i = 0;
                foreach ($flight_recommendation as $p => $s) 
                {
                    $rt = $p;
                    $count_segmentFlightRef = (count($s['segmentFlightRef']));
                    if (!isset($s['segmentFlightRef'][0])) 
                    {
                        if (isset($s['segmentFlightRef']['referencingDetail'][0])) 
                        {
                            $count_referencingDetail = (count($s['segmentFlightRef']['referencingDetail']));
                            for ($cr = 0; $cr < $count_referencingDetail; $cr++) 
                            {
                                $testing[$rt]['MultiTicket']="No";
                                $testing[$rt]['segmentFlightRef']['refNumber'][$cr] = $s['segmentFlightRef']['referencingDetail'][$cr]['refNumber'];
							}
						}
						else
						{	
							$testing[$rt]['MultiTicket']="Yes";
							$testing[$rt]['segmentFlightRef']['refNumber'] = $s['segmentFlightRef']['referencingDetail']['refNumber'];
						}
							
                                $testing[$rt]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
                                $testing[$rt]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

                                if (!isset($s['paxFareProduct'][0])) 
                                {
                                    $testing[$rt]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
                                    $testing[$rt]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));

                                    if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) 
                                    {
                                        $testing[$rt]['paxFareProduct']['count'] = "1";
                                        $testing[$rt]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
                                        if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) 
                                        {
                                            $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
                                        } 
                                        else 
                                        {
                                            $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                        }
                                    } 
                                    else 
                                    {
                                        $testing[$rt]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
                                        $count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
                                        for ($p = 0; $p < $count_traveller; $p++) 
                                        {
                                            $testing[$rt]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
                                            if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) 
                                            {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
                                            } 
                                            else 
                                            {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                            }
                                        }
                                    }

                                    $testing[$rt]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
                                    $testing[$rt]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];
                                    
//                                    if(array_key_exists('0',$s['paxFareProduct']['fareDetails']['groupOfFares']))
//                                        $testing[$rt]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares'][0]['productInformation']['fareProductDetail']['fareType'];
//                                    else
//                                        $testing[$rt]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];

                                    $testing[$rt]['paxFareProduct']['description'] = "";
                                    if (!isset($s['paxFareProduct']['fare'][0])) 
                                    {

                                        $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                        $testing[$rt]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];


                                        $count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
                                        if ($count_description <= 1) 
                                        {
                                            $testing[$rt]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description'] . " ";
                                        } 
                                        else 
                                        {
                                            for ($f = 0; $f < $count_description; $f++) 
                                            {
                                                $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f] . " ";
                                            }
                                        }
                                    } 
                                    else 
                                    {
                                        $count_fare = (count($s['paxFareProduct']['fare']));
                                        for ($e = 0; $e < $count_fare; $e++) 
                                        {
                                            $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'][$e] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                            $testing[$rt]['paxFareProduct']['fare']['informationType'][$e] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                            $count_description = (count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']));
                                            if (($count_description <= 1)) 
                                            {
                                                $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'] . " - ";
                                            } 
                                            else 
                                            {
                                                for ($f = 0; $f < $count_description; $f++) 
                                                {
                                                    $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f] . " ";
                                                }
                                            }
                                        }
                                    }

                                    if (!isset($s['paxFareProduct']['fareDetails'][0])) 
                                    {
                                        if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) 
                                        {
                                            $testing[$rt]['paxFareProduct']['fareDetails']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                        } 
                                        else 
                                        {
                                            $count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
                                            for ($u = 0; $u < $count_groupOfFares; $u++) 
                                            {
                                                $testing[$rt]['paxFareProduct']['fareDetails']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                            }
                                        }
                                        //$testing[$rt]['paxFareProduct']['fareDetails']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                        // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                    } 
                                    else 
                                    {
                                        $count_fareDetails = (count($s['paxFareProduct']['fareDetails']));
                                        for ($fd = 0; $fd < $count_fareDetails; $fd++) 
                                        {
                                            if (!isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][0])) 
                                            {
                                                $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['rbd'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin']))
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                else
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'] = '';
                                                if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                else
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'] = '';
                                                $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint'];
                                                $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['fareType'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                            }
                                            else 
                                            {
                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']));
                                                for ($u = 0; $u < $count_groupOfFares; $u++) 
                                                {
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['rbd'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                    if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']))
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                    else
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'][$u] = '';
                                                    if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                    else
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'][$u] = '';
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['breakPoint'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['fareType'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                                }
                                            }
                                            // $testing[$rt]['paxFareProduct']['fareDetails']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                            //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                        }
                                    }
                                }

                                else 
                                {
                                    $count_paxFareProduct = (count($s['paxFareProduct']));
                                    for ($d = 0; $d < $count_paxFareProduct; $d++) 
                                    {
                                        $testing[$rt]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
                                        if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) 
                                        {
                                            $testing[$rt]['paxFareProduct'][$d]['count'] = "1";
                                            $testing[$rt]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
                                            if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
                                            } 
                                            else 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                            }
                                        } 
                                        else 
                                        {
                                            $testing[$rt]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                            $count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                            for ($p = 0; $p < $count_traveller; $p++) 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
                                            }
                                            if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
                                            } 
                                            else 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                            }
                                        }

                                        $testing[$rt]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
                                        $testing[$rt]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

                                        $testing[$rt]['paxFareProduct'][$d]['description'] = "";
                                        if (!isset($s['paxFareProduct'][$d]['fare'][0])) 
                                        {
                                            $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                            $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                            if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description'] . " ";
                                            } 
                                            else 
                                            {
                                                $count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
                                                for ($f = 0; $f < $count_description; $f++) 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f];
                                                }
                                            }
                                        } 
                                        else 
                                        {
                                            $count_fare = (count($s['paxFareProduct'][$d]['fare']));
                                            for ($e = 0; $e < $count_fare; $e++) 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'][$e] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'][$e] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                $count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
                                                if ($count_description <= 1) 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'] . " - ";
                                                } 
                                                else 
                                                {
                                                    for ($f = 0; $f < $count_description; $f++) 
                                                    {
                                                        $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f] . " - ";
                                                    }
                                                }
                                            }
                                        }

                                        if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) 
                                        {
                                            if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                            } 
                                            else 
                                            {
                                                $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
                                                for ($g = 0; $g < $count_groupOfFares; $g++) 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                }
                                                //$testing[$rt]['paxFareProduct'][$d]['fareDetails']['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
                                                //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];		
                                            }
                                        } 
                                        else 
                                        {
                                            $count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
                                            for ($fd = 0; $fd < $count_fareDetails; $fd++) 
                                            {
                                                if (!isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][0])) 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                    if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                    else
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = '';
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                }
                                                else 
                                                {
                                                    $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']);
                                                    for ($g = 0; $g < $count_groupOfFares; $g++) 
                                                    {
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                        if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']))
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                        else
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'][$g] = '';
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                    }
                                                }
                                                //$testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];									
                                                //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];		
                                            }
                                        }
                                    }
                                }

                                if (isset($s['specificRecDetails'])) 
                                {
                                    if (isset($s['specificRecDetails'][0])) 
                                    {
                                        $count_specificRecDetails = (count($s['specificRecDetails']));
                                        for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) 
                                        {
                                            if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) 
                                            {
                                                $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem']['refNumber'] = $s['refNumber'][$sdi]['specificRecItem']['refNumber'];
                                                //if($testing[$n]['ref']==$s['specificRecDetails'][$sdi]['specificRecItem']['refNumber'])
                                                //{
                                                if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
                                                {
                                                    $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                    for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                    {
                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                    }
                                                } 
                                                else 
                                                {
                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                }
                                                //}
                                            } 
                                            else 
                                            {
                                                $count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
                                                for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
                                                {
                                                    $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber'] = $s['refNumber'][$sdi]['specificRecItem'][$sif]['refNumber'];
                                                    //if($testing[$n]['ref']==$s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber'])
                                                    //{
                                                    if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
                                                    {
                                                        $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                        for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                        {
                                                            $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    } 
                                                    else 
                                                    {
                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                    }
                                                    //}
                                                }
                                            }
                                        }
                                    } 
                                    else 
                                    {
                                        if (!isset($s['specificRecDetails']['specificRecItem'][0])) 
                                        {
                                            $testing[$rt]['specificRecDetails']['specificRecItem']['refNumber'] = $s['refNumber']['specificRecItem']['refNumber'];
                                            //if($testing[$n]['ref']==$s['specificRecDetails']['specificRecItem']['refNumber'])
                                            //{
                                            if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
                                            {
                                                $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                {
                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                }
                                            } 
                                            else 
                                            {
                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                            }
                                            //}
                                        } 
                                        else 
                                        {
                                            $count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
                                            for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
                                            {
                                                $testing[$rt]['specificRecDetails']['specificRecItem'][$sif]['refNumber'] = $s['refNumber']['specificRecItem'][$sif]['refNumber'];
                                                //if($testing[$n]['ref']==$s['specificRecDetails']['specificRecItem'][$sif]['refNumber'])
                                                //{
                                                if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
                                                {
                                                    $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                    for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                    {
                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                    }
                                                } 
                                                else 
                                                {
                                                    $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                }
                                                //}
                                            }
                                        }
                                    }
                                }
                         
                    } 
                    else 
                    {
                        $count_segmentFlightRef = (count($s['segmentFlightRef']));
                        for ($c = 0; $c < $count_segmentFlightRef; $c++) 
                        {
                            if (isset($s['segmentFlightRef'][$c]['referencingDetail'][0])) 
                            {
                                $count_referencingDetail = (count($s['segmentFlightRef'][$c]['referencingDetail']));
                                for ($cr = 0; $cr < $count_referencingDetail; $cr++) 
                                {
                                    $testing[$rt]['MultiTicket']="No";
                                    $testing[$rt]['segmentFlightRef'][$c]['refNumber'][$cr] = $s['segmentFlightRef'][$c]['referencingDetail'][$cr]['refNumber'];
                                }
							}
						    else
						    {
							   $testing[$rt]['MultiTicket']="No";
							   $testing[$rt]['segmentFlightRef'][$c]['refNumber'] = $s['segmentFlightRef'][$c]['referencingDetail']['refNumber'];
						    }
                                   
                                   
                                    $testing[$rt]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
                                    $testing[$rt]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

                                    if (!isset($s['paxFareProduct'][0])) 
                                    {
                                        $testing[$rt]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
                                        $testing[$rt]['paxFareProduct']['count'] = count($s['paxFareProduct']['paxReference']['traveller']);

                                        if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) 
                                        {
                                            $testing[$rt]['paxFareProduct']['count'] = "1";
                                            $testing[$rt]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
                                            if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) 
                                            {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
                                            } 
                                            else 
                                            {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                            }
                                        } 
                                        else 
                                        {
                                            $testing[$rt]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
                                            $count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
                                            for ($p = 0; $p < $count_traveller; $p++) 
                                            {
                                                $testing[$rt]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
                                            }
                                            if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) 
                                            {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
                                            }
                                            else 
                                            {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                            }
                                        }

                                        $testing[$rt]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
                                        $testing[$rt]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];

                                        $testing[$rt]['paxFareProduct']['description'] = "";
                                        if (!isset($s['paxFareProduct']['fare'][0])) 
                                        {

                                            $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                            $testing[$rt]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                            if (!isset($s['paxFareProduct']['fare']['pricingMessage']['description'][0])) 
                                            {
                                                $testing[$rt]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description'] . " ";
                                            } 
                                            else 
                                            {
                                                $count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
                                                for ($f = 0; $f < $count_description; $f++) 
                                                {
                                                    $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f] . " ";
                                                }
                                            }
                                        } 
                                        else 
                                        {
                                            $count_fare = count($s['paxFareProduct']['fare']);
                                            for ($e = 0; $e < $count_fare; $e++) 
                                            {
                                                $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                $testing[$rt]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) 
                                                {
                                                    $testing[$rt]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description'] . " ";
                                                } 
                                                else 
                                                {
                                                    $count_description = count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']);
                                                    for ($f = 0; $f < $count_description; $f++) 
                                                    {
                                                        $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f] . " ";
                                                    }
                                                }
                                            }
                                        }

                                        if (!isset($s['paxFareProduct']['fareDetails'][0])) 
                                        {
                                            if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) 
                                            {
                                                $testing[$rt]['paxFareProduct']['fareDetails']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                            } 
                                            else 
                                            {
                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
                                                for ($u = 0; $u < $count_groupOfFares; $u++) 
                                                {
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                                }
                                            }
                                            //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                            //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                        } 
                                        else 
                                        {
                                            $count_fareDetails = (count($s['paxFareProduct']['fareDetails']));
                                            for ($fd = 0; $fd < $count_fareDetails; $fd++) 
                                            {
                                                if (!isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][0])) 
                                                {
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['rbd'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                    if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin']))
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                    else
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'] = '';
                                                    if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                    else
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'] = '';
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['fareType'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                }
                                                else 
                                                {
                                                    $count_groupOfFares = (count($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']));
                                                    for ($u = 0; $u < $count_groupOfFares; $u++) 
                                                    {
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['rbd'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                        if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']))
                                                            $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                        else
                                                            $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'][$u] = '';
                                                        if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
                                                            $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                        else
                                                            $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'][$u] = '';

                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['breakPoint'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['fareType'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                                    }
                                                }
                                                // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                                // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                            }
                                        }
                                    }
                                    else 
                                    {
                                        $count_paxFareProduct = (count($s['paxFareProduct']));
                                        for ($d = 0; $d < $count_paxFareProduct; $d++) 
                                        {
                                            $testing[$rt]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
                                            if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['count'] = "1";
                                                $testing[$rt]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
                                                } 
                                                else 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                }
                                            } 
                                            else 
                                            {
                                                $testing[$rt]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                $count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                for ($p = 0; $p < $count_traveller; $p++) 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
                                                }
                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
                                                } 
                                                else 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                }
                                            }

                                            $testing[$rt]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
                                            $testing[$rt]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

                                            $testing[$rt]['paxFareProduct'][$d]['description'] = "";
                                            if (!isset($s['paxFareProduct'][$d]['fare'][0])) 
                                            {

                                                $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                                if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) 
                                                {
                                                    $testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description'] . " ";
                                                } 
                                                else 
                                                {
                                                    $count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
                                                    for ($f = 0; $f < $count_description; $f++) 
                                                    {
                                                        $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f] . " ";
                                                    }
                                                }
                                            } 
                                            else 
                                            {
                                                $count_fare = (count($s['paxFareProduct'][$d]['fare']));
                                                for ($e = 0; $e < $count_fare; $e++) 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                    if (!isset($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][0])) 
                                                    {
                                                        $testing[$rt]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'] . " ";
                                                    } 
                                                    else 
                                                    {
                                                        $count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
                                                        for ($f = 0; $f < $count_description; $f++) 
                                                        {
                                                            $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f];
                                                        }
                                                    }
                                                }
                                            }

                                            if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) 
                                            {
                                                if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) 
                                                {
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                } 
                                                else 
                                                {
                                                    $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
                                                    for ($g = 0; $g < $count_groupOfFares; $g++) 
                                                    {
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                    }
                                                }
                                                //$testing[$rt]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];									
                                                // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
                                            } 
                                            else 
                                            {
                                                $count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
                                                for ($fd = 0; $fd < $count_fareDetails; $fd++) 
                                                {
                                                    if (!isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][0])) 
                                                    {
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                        if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                        else
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = '';
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                    }
                                                    else 
                                                    {
                                                        $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']);
                                                        for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                            if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']))
                                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                            else
                                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'][$g] = '';
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                        }
                                                    }
                                                    //$testing[$rt]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];									
                                                    // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];									
                                                }
                                            }
                                        }
                                    }

                                    if (isset($s['specificRecDetails'])) 
                                    {
                                        if (isset($s['specificRecDetails'][0])) 
                                        {
                                            $count_specificRecDetails = (count($s['specificRecDetails']));
                                            for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) 
                                            {
                                                if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) 
                                                {
                                                    $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem']['refNumber'] = $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber'];
                                                    if (!isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][0])) 
                                                    {
                                                        if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
                                                        {
                                                            $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                            for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                            {
                                                                $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        } 
                                                        else 
                                                        {
                                                            $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['requestedSegmentInfo']['segRef'];
                                                            $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    } 
                                                    else 
                                                    {
                                                        $count_fareContextDetails = (($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']));
                                                        for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) 
                                                        {
                                                            if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                                $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                                {
                                                                    $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                }
                                                            } 
                                                            else 
                                                            {
                                                                $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef'];
                                                                $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        }
                                                    }
                                                } 
                                                else 
                                                {
                                                    $count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
                                                    for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
                                                    {
                                                        $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber'] = $s['refNumber'][$sdi]['specificRecItem'][$sif]['refNumber'];
                                                        if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) 
                                                        {
                                                            if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
                                                            {
                                                                $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                                {
                                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                }
                                                            } 
                                                            else 
                                                            {
                                                                $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        } 
                                                        else 
                                                        {
                                                            $count_fareContextDetails = (($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']));
                                                            for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) 
                                                            {
                                                                if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                                    $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                                    for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                                    {
                                                                        $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                    }
                                                                } 
                                                                else 
                                                                {
                                                                    $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef'];
                                                                    $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        } 
                                        else 
                                        {
                                            if (!isset($s['specificRecDetails']['specificRecItem'][0])) 
                                            {
                                                $testing[$rt]['specificRecDetails']['specificRecItem']['refNumber'] = $s['specificRecDetails']['specificRecItem']['refNumber'];
                                                if (!isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails'])) 
                                                {
                                                    if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
                                                    {
                                                        $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                        for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                        {
                                                            $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    } 
                                                    else 
                                                    {
                                                        $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                    }
                                                } 
                                                else 
                                                {
                                                    $count_fareContextDetails = (($s['specificRecDetails']['specificProductDetails']['fareContextDetails']));
                                                    for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) 
                                                    {
                                                        if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) 
                                                        {
                                                            $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                            for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                            {
                                                                $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        } 
                                                        else 
                                                        {
                                                            $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef'];
                                                            $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    }
                                                }
                                            } 
                                            else 
                                            {
                                                $count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
                                                for ($sif = 0; $sif < $count_specificRecItem; $sif++) 
                                                {
                                                    $testing[$rt]['specificRecDetails']['specificRecItem'][$sif]['refNumber'] = $s['refNumber']['specificRecItem'][$sif]['refNumber'];
                                                    if (!isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][0])) 
                                                    {
                                                        if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) 
                                                        {
                                                            $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                            for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                            {
                                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        } 
                                                        else 
                                                        {
                                                            $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    } 
                                                    else 
                                                    {
                                                        $count_fareContextDetails = (($s['specificRecDetails']['specificProductDetails']['fareContextDetails']));
                                                        for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) 
                                                        {
                                                            if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                                $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) 
                                                                {
                                                                    $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                }
                                                            } 
                                                            else 
                                                            {
                                                                $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef'];
                                                                $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    } 
                                }
                    }
                }
               // echo '<pre/><br/>Recomm:<br/> ';print_r($testing);exit;
                 if (isset($flightDetails[0])) {
                    $count_oneway = (count($flightDetails[0]['return']));
                    $count_return = (count($flightDetails[1]['return']));
                    $count_recomm = (count($testing));
                    //echo "oneway: ".$count_oneway."Return: ".$count_return."Recom: ".$count_recomm."<br/>";
                    $oneway = ($flightDetails[0]['return']);
                    $return = ($flightDetails[1]['return']);
                    //echo '<pre/><br/>OneWay:<br/> ';print_r($oneway);exit;
                    //echo '<pre/><br/>Recomm:<br/> ';print_r($return);exit;
                   //echo '<pre/><br/>Recomm:<br/> ';print_r($testing);exit;
                    $no = 0;
                    $final_result = '';
                    for ($o = 0; $o < $count_oneway; $o++) {
                        for ($r = 0; $r < $count_return; $r++) {
                            for ($rc = 0; $rc < $count_recomm; $rc++) {
                               if (!isset($testing[$rc]['segmentFlightRef'][0])) {
                                    //if(isset($testing[$rc]['segmentFlightRef']['refNumber'][0])){
									if(is_array($testing[$rc]['segmentFlightRef']['refNumber'])){
										if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'][0])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'][1]))) {
											$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'][0] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'][1];
											$final_result[$no]['combination'] = $combination;
											$final_result[$no]['flag'] = "One";
											$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
											$final_result[$no]['oneWay'] = $oneway[$o];
											$final_result[$no]['Return'] = $return[$r];
											$final_result[$no]['Recomm'] = $testing[$rc];
											$no++;
										} 
                                    }
                                    else
                                    {
										if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber']))) {
											$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'];
											$final_result[$no]['combination'] = $combination;
											$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
											$final_result[$no]['flag'] = "One";
											$final_result[$no]['oneWay'] = $oneway[$o];
											$final_result[$no]['Return'] = $return[$r];
											$final_result[$no]['Recomm'] = $testing[$rc];
											//echo '<pre/>';print_r($testing[$rc]);exit;
											$no++;
										}
									}
                                } else {
                                    $count_segmentFlightRef = (count($testing[$rc]['segmentFlightRef']));
                                    for ($cs = 0; $cs < $count_segmentFlightRef; $cs++) {
										 if(isset($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0])){
											if(isset($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][1])){
												if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][1]))) {
													$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef'][$cs]['refNumber'][1] . " => " . $cs;
													$final_result[$no]['combination'] = $combination;
													$final_result[$no]['flag'] = "Multiple";
													$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
													$final_result[$no]['SegmentNo'] = $cs;
													$final_result[$no]['oneWay'] = $oneway[$o];
													$final_result[$no]['Return'] = $return[$r];
													$final_result[$no]['Recomm'] = $testing[$rc];
													$no++;
												}
										} 
										}
										else
										{
											if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber']))) {
												$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef'][$cs]['refNumber'] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef'][$cs]['refNumber'] . " => " . $cs;
												$final_result[$no]['combination'] = $combination;
												$final_result[$no]['flag'] = "Multiple";
												$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
												$final_result[$no]['SegmentNo'] = $cs;
												$final_result[$no]['oneWay'] = $oneway[$o];
												$final_result[$no]['Return'] = $return[$r];
												$final_result[$no]['Recomm'] = $testing[$rc];
												$no++;
											}
										}
                                    }
                                }
                            }
                        }
                    }
                }


                //echo '<pre/><br/>Final Resusult:<br/> ';print_r($final_result);exit;
                $data['flight_result'] = $final_result;
                $data['currency'] = $currency;
            } else {
                $data['flight_result'] = '';
                $data['currency'] = '';
            }
            
								    $flight_result=$data['flight_result'];
									$testing1 = "";
									$_SESSION['MTK_flag'] ="No";
									if ($flight_result != '') 
									{
										$count_val = count($flight_result);
										$i = 0;
										$total = 0;
										foreach ($flight_result as $flight_result1) 
										{
											$count_code = count($flight_result1['oneWay']['marketingCarrier']);
											if ($count_code <= 1) 
											{
												$name = $this->Flights_Model->get_flight_name($flight_result1['oneWay']['marketingCarrier']);
												if ($name != '') 
												{
													$testing1['oneway'][$i]['cicode'] = $flight_result1['oneWay']['marketingCarrier'];
													$testing1['oneway'][$i]['eft'] = $flight_result1['oneWay']['eft'];
													$testing1['oneway'][$i]['name'] = $name;
													$testing1['oneway'][$i]['fnumber'] = $flight_result1['oneWay']['flightNumber'];
													$testing1['oneway'][$i]['equipmentType'] = $flight_result1['oneWay'] ['equipmentType'];
													$testing1['oneway'][$i]['dlocation'] = $flight_result1['oneWay']['locationIdDeparture'];
													$departureDate = $flight_result1['oneWay']['dateOfDeparture'];
													$departureTime = $flight_result1['oneWay']['timeOfDeparture'];
													$testing1['oneway'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

													$testing1['oneway'][$i]['alocation'] = $flight_result1['oneWay']['locationIdArival'];
													$arrivalDate = $flight_result1['oneWay']['dateOfArrival'];
													$arrivalTime = $flight_result1['oneWay']['timeOfArrival'];
													$testing1['oneway'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";


													$departureDate=$testing1['oneway'][$i]['dateOfDeparture'] = $flight_result1['oneWay']['dateOfDeparture'];
													$departureTime = $flight_result1['oneWay']['timeOfDeparture'];
													$arrivalDate = $testing1['oneway'][$i]['dateOfArrival']=  $flight_result1['oneWay']['dateOfArrival'];
													$arrivalTime = $flight_result1['oneWay']['timeOfArrival'];
													$testing1['oneway'][$i]['timeOfDeparture'] = $flight_result1['oneWay']['timeOfDeparture'];
													$testing1['oneway'][$i]['timeOfArrival'] = $flight_result1['oneWay']['timeOfArrival'];

													if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
														$testing1['oneway'][$i]['redeye'] = "Yes";
													else
														$testing1['oneway'][$i]['redeye'] = "No";

													$testing1['oneway'][$i]['dtime_filter'] = $flight_result1['oneWay']['timeOfDeparture'];
													$testing1['oneway'][$i]['atime_filter'] = $arrivalTime;


													$testing1['oneway'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
													$testing1['oneway'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

													$testing1['oneway'][$i]['dep_date'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
													$testing1['oneway'][$i]['arv_date'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));
								

													//Final Duration Part
													$testing1['oneway'][$i]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
													$testing1['oneway'][$i]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
													$date_a = new DateTime($testing1['oneway'][$i]['ddate1']);
													$date_b = new DateTime($testing1['oneway'][$i]['adate1']);
													$interval = date_diff($date_a, $date_b);
													$testing1['oneway'][$i]['duration_final'] = $interval->format('%h hours %i minutes');
													$testing1['oneway'][$i]['duration_final1'] = $interval->format('%h h %i m');
													
													$hours_eft = floor(($flight_result1['oneWay']['eft']) / 60);
													$day_eft = floor(($flight_result1['oneWay']['eft']) / 1440);
													$minutes_eft = (($flight_result1['oneWay']['eft']) % 60);
													
													$testing1['oneway'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
													

													$hour = $interval->format('%h');
													$min = $interval->format('%i');
													$dur_in_min = (($hour * 60) + $min);
													$testing1['oneway'][$i]['dur_in_min'] = $dur_in_min;


													//$total=(($flight_result1['Recomm']['totalFareAmount'])+($flight_result1['Recomm']['totalTaxAmount']));
													if($flight_result1['MultiTicket']=="Yes")
													{
														$total = (($flight_result1['Recomm'][0]['totalFareAmount'])+(($flight_result1['Recomm'][1]['totalFareAmount'])));
														$testing1['oneway'][$i]['pamount'] = $total;
														$testing1['oneway'][$i]['FareAmount'] = (($flight_result1['Recomm'][0]['totalFareAmount'])+($flight_result1['Recomm'][1]['totalFareAmount']));
														$testing1['oneway'][$i]['TaxAmount'] = (($flight_result1['Recomm'][0]['totalTaxAmount'])+($flight_result1['Recomm'][1]['totalTaxAmount']));
													}
													else
													{
														$total = (($flight_result1['Recomm']['totalFareAmount']));
														$testing1['oneway'][$i]['pamount'] = $total;
														$testing1['oneway'][$i]['FareAmount'] = $flight_result1['Recomm']['totalFareAmount'];
														$testing1['oneway'][$i]['TaxAmount'] = $flight_result1['Recomm']['totalTaxAmount'];
													}
													$testing1['oneway'][$i]['ccode'] = $data['currency'];
													$testing1['oneway'][$i]['id'] = $i;
													//$testing['oneway'][$i]['designator']=$flight_result1['Recomm']['paxFareProduct']['designator'];
													$testing1['oneway'][$i]['stops'] = "0";
													$testing1['oneway'][$i]['flag'] = "false";
													$testing1['oneway'][$i]['MultiTicket']=$flight_result1['MultiTicket'];
													$testing1['oneway'][$i]['rand_id'] = $rand_id;

													//Markup Values
							//                        $adminmarkup = $this->Flights_Model->get_adminmarkup();
							//                        $adminmarkupvalue = $adminmarkup->markup;
							//                        $pg = $this->Flights_Model->get_pgmarkup();
							//                        $pgvalue = $pg->charge;
													
													$adminmarkupvalue = 0;
													$pgvalue = 0;

													$testing1['oneway'][$i]['admin_markup'] = $adminmarkupvalue;
													$testing1['oneway'][$i]['payment_charge'] = $pgvalue;

													$API_FareAmount = $total;
													$admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
													$markup1 = $API_FareAmount + $admin_markup;
													$pg_charge = ($markup1 * $pgvalue) / 100;
													$Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
													$total_markup = $admin_markup + $pg_charge;
													$testing1['oneway'][$i]['Total_FareAmount'] = $Total_FareAmount;


													if($flight_result1['MultiTicket']=="Yes")
													{
														$count_rbd = count($flight_result1['Recomm'][0]['paxFareProduct']);
														if (isset($flight_result1['Recomm'][0]['paxFareProduct'][0])) 
														{
															if(isset($flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]))
															{
																$testing1['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['rbd'];
																$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['cabin'];
															}
															else
															{
																$testing1['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'];
																$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['cabin'];

															}
														} 
														else 
														{
															if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]))
															{
																$testing1['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'];
																$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['cabin'];
															}
															else
															{
																$testing1['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'];
																$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'];
															}
														}
													}
													else
													{
														$count_rbd = count($flight_result1['Recomm']['paxFareProduct']);
														if (isset($flight_result1['Recomm']['paxFareProduct'][0])) 
														{
															if(isset($flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]))
															{
																$testing1['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'];
																$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['cabin'];
															}
															else
															{
																$testing1['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'];
																$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'];

															}
														} 
														else 
														{
															if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]))
															{
																$testing1['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'];
																$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['cabin'];
															}
															else
															{
																$testing1['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'];
																$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'];
															}
														}
													}

													$i++;
												}
											} 
											else 
											{
												$testing1['oneway'][$i]['dur_in_min'] = "";
												$h = 0;
												$m = 0;
												$total = 0;
												for ($j = 0; $j < ($count_code); $j++) {
													$name = $this->Flights_Model->get_flight_name($flight_result1['oneWay']['marketingCarrier'][$j]);
													if ($name != '') {
														$testing1['oneway'][$i]['cicode'][$j] = $flight_result1['oneWay']['marketingCarrier'][$j];
														$testing1['oneway'][$i]['eft'] = $flight_result1['oneWay']['eft'];
														$testing1['oneway'][$i]['name'][$j] = $name;
														$testing1['oneway'][$i]['fnumber'][$j] = $flight_result1['oneWay']['flightNumber'][$j];
														$testing1['oneway'][$i]['equipmentType'] = $flight_result1['oneWay'] ['equipmentType'];
														$testing1['oneway'][$i]['dlocation'][$j] = $flight_result1['oneWay']['locationIdDeparture'][$j];
														$departureDate = $flight_result1['oneWay']['dateOfDeparture'][$j];
														$departureTime = $flight_result1['oneWay']['timeOfDeparture'][$j];
														$testing1['oneway'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

														$testing1['oneway'][$i]['alocation'][$j] = $flight_result1['oneWay']['locationIdArival'][$j];
														$arrivalDate = $flight_result1['oneWay']['dateOfArrival'][$j];
														$arrivalTime = $flight_result1['oneWay']['timeOfArrival'][$j];
														$testing1['oneway'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";


														$testing1['oneway'][$i]['dateOfDeparture'][$j]=$departureDate = $flight_result1['oneWay']['dateOfDeparture'][$j];
														$departureTime = $flight_result1['oneWay']['timeOfDeparture'][$j];
														$testing1['oneway'][$i]['dateOfArrival'][$j]=$arrivalDate = $flight_result1['oneWay']['dateOfArrival'][$j];
														$arrivalTime = $flight_result1['oneWay']['timeOfArrival'][$j];

														$testing1['oneway'][$i]['timeOfDeparture'][$j] = $flight_result1['oneWay']['timeOfDeparture'][$j];
														$testing1['oneway'][$i]['timeOfArrival'][$j] = $flight_result1['oneWay']['timeOfArrival'][$j];

														if (($flight_result1['oneWay']['timeOfDeparture'][0] <= "0700") && ($arrivalTime >= "2000"))
															$testing1['oneWay'][$i]['redeye'] = "Yes";
														else
															$testing1['oneway'][$i]['redeye'] = "No";

														$testing1['oneway'][$i]['dtime_filter'] = $flight_result1['oneWay']['timeOfDeparture'][0];
														$testing1['oneway'][$i]['atime_filter'] = $arrivalTime;


														$testing1['oneway'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
														$testing1['oneway'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

														$testing1['oneway'][$i]['dep_date'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
														$testing1['oneway'][$i]['arv_date'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));


														//Final Duration Part
														$testing1['oneway'][$i]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
														$testing1['oneway'][$i]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
														$date_a = new DateTime($testing1['oneway'][$i]['ddate1'][$j]);
														$date_b = new DateTime($testing1['oneway'][$i]['adate1'][$j]);
														$interval = date_diff($date_a, $date_b);
														$testing1['oneway'][$i]['duration_final'][$j] = $interval->format('%h hours %i minutes');
														$testing1['oneway'][$i]['duration_final1'][$j] = $interval->format('%h h %i m');

														
														$hours_eft = floor(($flight_result1['oneWay']['eft']) / 60);
														$day_eft = floor(($flight_result1['oneWay']['eft']) / 1440);
														$minutes_eft = (($flight_result1['oneWay']['eft']) % 60);
														
														$testing1['oneway'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
														
														
														$hour = $interval->format('%h');
														$min = $interval->format('%i');
														$dur_in_min = (($hour * 60) + $min);
														$testing1['oneway'][$i]['dur_in_min']+= $dur_in_min;

														if ($j != ($count_code - 1)) 
														{
															$arrivalDate_layover = $flight_result1['oneWay']['dateOfArrival'][$j];
															$arrivalTime_layover = $flight_result1['oneWay']['timeOfArrival'][$j];
															$departureDate_layover = $flight_result1['oneWay']['dateOfArrival'][($j + 1)];
															$departureTime_layover = $flight_result1['oneWay']['timeOfArrival'][($j + 1)];

															$depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
															$arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
															$date_c = new DateTime($depart_layover);
															$date_d = new DateTime($arival_layover);
															$interval_layover = date_diff($date_c, $date_d);
															$testing1['oneway'][$i]['duration_final_layover'][$j] = $interval_layover->format('%h hours %i minutes');

															$hour_layover = $interval_layover->format('%h');
															$min_layover = $interval_layover->format('%i');
															$dur_in_min_layover = (($hour_layover * 60) + $min_layover);
															$testing1['oneway'][$i]['dur_in_min_layover'][$j] = $dur_in_min_layover;
														} 
														else 
														{
															$testing1['oneway'][$i]['duration_final_layover'][$j] = '';
															$testing1['oneway'][$i]['dur_in_min_layover'][$j] = '';
														}


														if ($flight_result1['oneWay']['marketingCarrier'][0] != $flight_result1['oneWay']['marketingCarrier'][$j])
															$flag_marketingCarrier = true;
														else
															$flag_marketingCarrier = false;

														$testing1['oneway'][$i]['flag_marketingCarrier'] = $flag_marketingCarrier;

														//$total=(($flight_result1['Recomm']['totalFareAmount'])+($flight_result1['Recomm']['totalTaxAmount']));
														if(isset($flight_result1['Recomm'][0]))
														{
															$total = (($flight_result1['Recomm'][0]['totalFareAmount'])+($flight_result1['Recomm'][1]['totalFareAmount']));
															$testing1['oneway'][$i]['pamount'] = $total;
															$testing1['oneway'][$i]['FareAmount'] = (($flight_result1['Recomm'][0]['totalFareAmount'])+($flight_result1['Recomm'][1]['totalFareAmount']));
															$testing1['oneway'][$i]['TaxAmount'] = (($flight_result1['Recomm'][01]['totalTaxAmount'])+($flight_result1['Recomm'][1]['totalTaxAmount']));
														}
														else
														{
															$total = ($flight_result1['Recomm']['totalFareAmount']);
															$testing1['oneway'][$i]['pamount'] = $total;
															$testing1['oneway'][$i]['FareAmount'] = $flight_result1['Recomm']['totalFareAmount'];
															$testing1['oneway'][$i]['TaxAmount'] = $flight_result1['Recomm']['totalTaxAmount'];
														}
															
														
														$testing1['oneway'][$i]['ccode'] = $data['currency'];
														$testing1['oneway'][$i]['id'] = $i;

														//$testing['oneway'][$i]['designator']=$flight_result1['Recomm']['paxFareProduct']['designator'];
														$testing1['oneway'][$i]['stops'] = ($count_code - 1);
														$testing1['oneway'][$i]['flag'] = "true";
														$testing1['oneway'][$i]['MultiTicket']=$flight_result1['MultiTicket'];
														$testing1['oneway'][$i]['rand_id'] = $rand_id;

														//Markup Values
							//                            $adminmarkup = $this->Flights_Model->get_adminmarkup();
							//                            $adminmarkupvalue = $adminmarkup->markup;
							//                            $pg = $this->Flights_Model->get_pgmarkup();
							//                            $pgvalue = $pg->charge;
														
														
														$adminmarkupvalue = 0;
														$pgvalue = 0;

														$testing1['oneway'][$i]['admin_markup'] = $adminmarkupvalue;
														$testing1['oneway'][$i]['payment_charge'] = $pgvalue;

														$API_FareAmount = $total;
														$admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
														$markup1 = $API_FareAmount + $admin_markup;
														$pg_charge = ($markup1 * $pgvalue) / 100;
														$Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
														$total_markup = $admin_markup + $pg_charge;
														$testing1['oneway'][$i]['Total_FareAmount'] = $Total_FareAmount;

													   if($flight_result1['MultiTicket']!="Yes")
													   {
															$count_rbd = count($flight_result1['Recomm']['paxFareProduct']);
															if (isset($flight_result1['Recomm']['paxFareProduct'][0])) 
															{
																if(isset($flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]))
																{
																	$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'][$j];
																	$testing1['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['cabin'][$j];
																}
																else
																{
																	$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'][$j];
																	$testing1['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'][$j];								
																}
															} 
															else 
															{
																if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]))
																{
																	$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'][$j];
																	$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['cabin'][$j];
																}
																else
																{
																	if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j]))
																		$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j];
																	else
																		$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'];
																	if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j]))
																		$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j];
																	else
																		$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'];
																}
															}
														}
														else
														{
															$count_rbd = count($flight_result1['Recomm'][0]['paxFareProduct']);
															if (isset($flight_result1['Recomm'][0]['paxFareProduct'][0])) 
															{
																if(isset($flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]))
																{
																	$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['rbd'][$j];
																	$testing1['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['cabin'][$j];
																}
																else
																{
																	$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'][$j];
																	$testing1['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['cabin'][$j];								
																}
															} 
															else 
															{
																if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]))
																{
																	$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'][$j];
																	$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['cabin'][$j];
																}
																else
																{
																	if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][$j]))
																		$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][$j];
																	else
																		$testing1['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'];
																	if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'][$j]))
																		$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'][$j];
																	else
																		$testing1['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'];
																}
															}
														}
													}
												}

												$i++;
											}
										}
									}

									if ($flight_result != '') 
									{
										$count_val = (count($flight_result));
										$i = 0;
										$total = 0;
										foreach ($flight_result as $flight_result2) 
										{
											//if($flight_result2['flag']!="Multiple")
											//{

											$count_code = count($flight_result2['Return']['marketingCarrier']);
											if ($count_code <= 1) 
											{
												$name = $this->Flights_Model->get_flight_name($flight_result2['Return']['marketingCarrier']);
												if ($name != '') 
												{
													$testing1['Return'][$i]['cicode'] = $flight_result2['Return']['marketingCarrier'];
													$testing1['Return'][$i]['eft'] = $flight_result2['Return']['eft'];
													$testing1['Return'][$i]['name'] = $name;
													$testing1['Return'][$i]['fnumber'] = $flight_result2['Return']['flightNumber'];
													$testing1['Return'][$i]['equipmentType'] = $flight_result1['Return'] ['equipmentType'];
													$testing1['Return'][$i]['dlocation'] = $flight_result2['Return']['locationIdDeparture'];
													$testing1['Return'][$i]['dateOfDeparture']=$departureDate = $flight_result2['Return']['dateOfDeparture'];
													$departureTime = $flight_result2['Return']['timeOfDeparture'];
													$testing1['Return'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

													$testing1['Return'][$i]['alocation'] = $flight_result2['Return']['locationIdArival'];
													$arrivalDate = $flight_result2['Return']['dateOfArrival'];
													$arrivalTime = $flight_result2['Return']['timeOfArrival'];
													$testing1['Return'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";



													$departureDate = $flight_result2['Return']['dateOfDeparture'];
													$departureTime = $flight_result2['Return']['timeOfDeparture'];
													$testing1['Return'][$i]['dateOfArrival']=$arrivalDate = $flight_result2['Return']['dateOfArrival'];
													$arrivalTime = $flight_result2['Return']['timeOfArrival'];

													$testing1['Return'][$i]['timeOfDeparture'] = $flight_result2['Return']['timeOfDeparture'];
													$testing1['Return'][$i]['timeOfArrival'] = $flight_result2['Return']['timeOfArrival'];

													if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
														$testing1['Return'][$i]['redeye'] = "Yes";
													else
														$testing1['Return'][$i]['redeye'] = "No";

													$testing1['Return'][$i]['dtime_filter'] = $flight_result2['Return']['timeOfDeparture'];
													$testing1['Return'][$i]['atime_filter'] = $arrivalTime;


													$testing1['Return'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
													$testing1['Return'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

													$testing1['Return'][$i]['dep_date'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
													$testing1['Return'][$i]['arv_date'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));

													//Final Duration Part
													$testing1['Return'][$i]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
													$testing1['Return'][$i]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
													$date_a = new DateTime($testing1['Return'][$i]['ddate1']);
													$date_b = new DateTime($testing1['Return'][$i]['adate1']);
													$interval = date_diff($date_a, $date_b);
													$testing1['Return'][$i]['duration_final'] = $interval->format('%h hours %i minutes');
													$testing1['Return'][$i]['duration_final1'] = $interval->format('%h h %i m');
													
													$hours_eft = floor(($flight_result2['Return']['eft']) / 60);
													$day_eft = floor(($flight_result2['Return']['eft']) / 1440);
													$minutes_eft = (($flight_result2['Return']['eft']) % 60);
													// if($hours_eft>24)
														// $hours_eft=($hours_eft % 24);
														// 
													// if ($day_eft > 0)
														// $testing['Return'][$i]['duration_final_eft'] = $day_eft."D ".$hours_eft."H ".$minutes_eft."M";
													// else
														$testing1['Return'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";

													$hour = $interval->format('%h');
													$min = $interval->format('%i');
													$dur_in_min = (($hour * 60) + $min);
													$testing1['Return'][$i]['dur_in_min'] = $dur_in_min;

													//$total=(($flight_result2['Recomm']['totalFareAmount'])+($flight_result2['Recomm']['totalTaxAmount']));
													if($flight_result2['MultiTicket']=="Yes")
													{
														$total = (($flight_result2['Recomm'][0]['totalFareAmount'])+($flight_result2['Recomm'][1]['totalFareAmount']));
														$testing1['Return'][$i]['pamount'] = $total;
														$testing1['Return'][$i]['FareAmount'] = (($flight_result2['Recomm'][0]['totalFareAmount'])+($flight_result2['Recomm'][1]['totalFareAmount']));
														$testing1['Return'][$i]['TaxAmount'] = (($flight_result2['Recomm'][0]['totalTaxAmount'])+($flight_result2['Recomm'][1]['totalTaxAmount']));
													}
													else
													{
														$total = (($flight_result2['Recomm']['totalFareAmount']));
														$testing1['Return'][$i]['pamount'] = $total;
														$testing1['Return'][$i]['FareAmount'] = $flight_result2['Recomm']['totalFareAmount'];
														$testing1['Return'][$i]['TaxAmount'] = $flight_result2['Recomm']['totalTaxAmount'];
													}
													$testing1['Return'][$i]['ccode'] = $data['currency'];
													$testing1['Return'][$i]['id'] = $i;
													//$testing['Return'][$i]['designator']=$flight_result2['Recomm']['paxFareProduct']['designator'];
													$testing1['Return'][$i]['stops'] = "0";
													$testing1['Return'][$i]['flag'] = "false";
													$testing1['Return'][$i]['MultiTicket']=$flight_result1['MultiTicket'];
													$testing1['Return'][$i]['rand_id'] = $rand_id;

													//Markup Values
							//                        $adminmarkup = $this->Flights_Model->get_adminmarkup();
							//                        $adminmarkupvalue = $adminmarkup->markup;
							//                        $pg = $this->Flights_Model->get_pgmarkup();
							//                        $pgvalue = $pg->charge;
													
													
													$adminmarkupvalue = 0;
													$pgvalue = 0;

													$testing1['Return'][$i]['admin_markup'] = $adminmarkupvalue;
													$testing1['Return'][$i]['payment_charge'] = $pgvalue;

													$API_FareAmount = $total;
													$admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
													$markup1 = $API_FareAmount + $admin_markup;
													$pg_charge = ($markup1 * $pgvalue) / 100;
													$Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
													$total_markup = $admin_markup + $pg_charge;
													$testing1['Return'][$i]['Total_FareAmount'] = $Total_FareAmount;

													
													if($flight_result2['MultiTicket']=="Yes")
													{
														$count_rbd = count($flight_result1['Recomm'][1]['paxFareProduct']);
														if (isset($flight_result1['Recomm'][1]['paxFareProduct'][0])) {
															if(isset($flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]))
															{
																$testing1['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['rbd'];
																$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['cabin'];
															}
															else
															{
																$testing1['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'];
																$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['cabin'];
															}
														} else {
															if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]))
															{
																$testing1['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'];
																$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['cabin'];
															}
															else
															{
																$testing1['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'];
																$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'];
															}
														}
													}
													else
													{
														$count_rbd = count($flight_result1['Recomm']['paxFareProduct']);
														if (isset($flight_result1['Recomm']['paxFareProduct'][0])) {
															if(isset($flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]))
															{
																$testing1['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'];
																$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['cabin'];
															}
															else
															{
																$testing1['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'];
																$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'];
															}
														} else {
															if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]))
															{
																$testing1['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'];
																$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['cabin'];
															}
															else
															{
																$testing1['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'];
																$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'];
															}
														}
													}

													$i++;
												}
											} 
											else 
											{
												$testing1['Return'][$i]['dur_in_min'] = "";
												$h = 0;
												$m = 0;
												$total = 0;
												for ($j = 0; $j < ($count_code); $j++) 
												{
													$name = $this->Flights_Model->get_flight_name($flight_result2['Return']['marketingCarrier'][$j]);
													if ($name != '') 
													{
														$testing1['Return'][$i]['cicode'][$j] = $flight_result2['Return']['marketingCarrier'][$j];
														$testing1['Return'][$i]['eft'] = $flight_result2['Return']['eft'];
														$testing1['Return'][$i]['name'][$j] = $name;
														$testing1['Return'][$i]['fnumber'][$j] = $flight_result2['Return']['flightNumber'][$j];
														$testing1['Return'][$i]['equipmentType'] = $flight_result1['Return'] ['equipmentType'];
														$testing1['Return'][$i]['dlocation'][$j] = $flight_result2['Return']['locationIdDeparture'][$j];
														$departureDate = $flight_result2['Return']['dateOfDeparture'][$j];
														$departureTime = $flight_result2['Return']['timeOfDeparture'][$j];
														$testing1['Return'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

														$testing1['Return'][$i]['alocation'][$j] = $flight_result2['Return']['locationIdArival'][$j];
														$arrivalDate = $flight_result2['Return']['dateOfArrival'][$j];
														$arrivalTime = $flight_result2['Return']['timeOfArrival'][$j];
														$testing1['Return'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

														$testing1['Return'][$i]['dateOfDeparture'][$j]=$departureDate = $flight_result2['Return']['dateOfDeparture'][$j];
														$departureTime = $flight_result2['Return']['timeOfDeparture'][$j];
														$testing1['Return'][$i]['dateOfArrival'][$j]=$arrivalDate = $flight_result2['Return']['dateOfArrival'][$j];
														$arrivalTime = $flight_result2['Return']['timeOfArrival'][$j];

														$testing1['Return'][$i]['timeOfDeparture'][$j] = $flight_result2['Return']['timeOfDeparture'][$j];
														$testing1['Return'][$i]['timeOfArrival'][$j] = $flight_result2['Return']['timeOfArrival'][$j];

														$testing1['Return'][$i]['dtime_filter'] = $flight_result2['Return']['timeOfDeparture'][0];
														$testing1['Return'][$i]['atime_filter'] = $arrivalTime;

														if ((($flight_result2['Return']['timeOfDeparture'][0]) <= "0700") && ($arrivalTime >= "2000"))
															$testing1['Return'][$i]['redeye'] = "Yes";
														else
															$testing1['Return'][$i]['redeye'] = "No";

														$testing1['Return'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
														$testing1['Return'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

														$testing1['Return'][$i]['dep_date'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
														$testing1['Return'][$i]['arv_date'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));


														//Final Duration Part
														$testing1['Return'][$i]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
														$testing1['Return'][$i]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
														$date_a = new DateTime($testing1['Return'][$i]['ddate1'][$j]);
														$date_b = new DateTime($testing1['Return'][$i]['adate1'][$j]);
														$interval = date_diff($date_a, $date_b);
														$testing1['Return'][$i]['duration_final'][$j] = $interval->format('%h hours %i minutes');
														$testing1['Return'][$i]['duration_final1'][$j] = $interval->format('%h h %i m');
														
														$hours_eft = floor(($flight_result2['Return']['eft']) / 60);
														$day_eft = floor(($flight_result2['Return']['eft']) / 1440);
														$minutes_eft = (($flight_result2['Return']['eft']) % 60);
														// if($hours_eft>24)
															// $hours_eft=($hours_eft % 24);
															// 
														// if ($day_eft > 0)
															// $testing['Return'][$i]['duration_final_eft'] = $day_eft."D ".$hours_eft."H ".$minutes_eft."M";
														// else
															$testing1['Return'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";


														$hour = $interval->format('%h');
														$min = $interval->format('%i');
														$dur_in_min = (($hour * 60) + $min);
														$testing1['Return'][$i]['dur_in_min']+= $dur_in_min;

														if ($j != ($count_code - 1)) 
														{
															$arrivalDate_layover = $flight_result2['Return']['dateOfArrival'][$j];
															$arrivalTime_layover = $flight_result2['Return']['timeOfArrival'][$j];
															$departureDate_layover = $flight_result2['Return']['dateOfArrival'][($j + 1)];
															$departureTime_layover = $flight_result2['Return']['timeOfArrival'][($j + 1)];

															$depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
															$arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
															$date_c = new DateTime($depart_layover);
															$date_d = new DateTime($arival_layover);
															$interval_layover = date_diff($date_c, $date_d);
															$testing1['Return'][$i]['duration_final_layover'][$j] = $interval_layover->format('%h hours %i minutes');

															$hour_layover = $interval_layover->format('%h');
															$min_layover = $interval_layover->format('%i');
															$dur_in_min_layover = (($hour_layover * 60) + $min_layover);
															$testing1['Return'][$i]['dur_in_min_layover'][$j] = $dur_in_min_layover;
														} 
														else 
														{
															$testing1['Return'][$i]['duration_final_layover'][$j] = '';
															$testing1['Return'][$i]['dur_in_min_layover'][$j] = '';
														}


														if ($flight_result2['Return']['marketingCarrier'][0] != $flight_result2['Return']['marketingCarrier'][$j])
															$flag_marketingCarrier = true;
														else
															$flag_marketingCarrier = false;

														$testing1['Return'][$i]['flag_marketingCarrier'] = $flag_marketingCarrier;

														//$total=(($flight_result2['Recomm']['totalFareAmount'])+($flight_result2['Recomm']['totalTaxAmount']));
														if($flight_result2['MultiTicket']=="Yes")
														{
															$total = (($flight_result2['Recomm'][0]['totalFareAmount'])+(($flight_result2['Recomm'][1]['totalFareAmount'])));
															$testing1['Return'][$i]['pamount'] = $total;
															$testing1['Return'][$i]['FareAmount'] = (($flight_result2['Recomm'][0]['totalFareAmount'])+($flight_result2['Recomm'][1]['totalFareAmount']));
															$testing1['Return'][$i]['TaxAmount'] = (($flight_result2['Recomm'][0]['totalTaxAmount'])+($flight_result2['Recomm'][1]['totalTaxAmount']));
														}
														else
														{
															$total = (($flight_result2['Recomm']['totalFareAmount']));
															$testing1['Return'][$i]['pamount'] = $total;
															$testing1['Return'][$i]['FareAmount'] = $flight_result2['Recomm']['totalFareAmount'];
															$testing1['Return'][$i]['TaxAmount'] = $flight_result2['Recomm']['totalTaxAmount'];
														}
														$testing1['Return'][$i]['ccode'] = $data['currency'];
														$testing1['Return'][$i]['id'] = $i;

														//$testing['Return'][$i]['designator']=$flight_result2['Recomm']['paxFareProduct']['designator'];
														$testing1['Return'][$i]['stops'] = ($count_code - 1);
														$testing1['Return'][$i]['flag'] = "true";
														$testing1['Return'][$i]['MultiTicket']=$flight_result2['MultiTicket'];
														$testing1['Return'][$i]['rand_id'] = $rand_id;

														//Markup Values
							//                            $adminmarkup = $this->Flights_Model->get_adminmarkup();
							//                            $adminmarkupvalue = $adminmarkup->markup;
							//                            $pg = $this->Flights_Model->get_pgmarkup();
							//                            $pgvalue = $pg->charge;
														
														
														$adminmarkupvalue = 0;
														$pgvalue = 0;

														$testing1['Return'][$i]['admin_markup'] = $adminmarkupvalue;
														$testing1['Return'][$i]['payment_charge'] = $pgvalue;

														$API_FareAmount = $total;
														$admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
														$markup1 = $API_FareAmount + $admin_markup;
														$pg_charge = ($markup1 * $pgvalue) / 100;
														$Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
														$total_markup = $admin_markup + $pg_charge;
														$testing1['Return'][$i]['Total_FareAmount'] = $Total_FareAmount;


														if($flight_result2['MultiTicket']=="Yes")
														{
															$count_rbd = count($flight_result1['Recomm'][1]['paxFareProduct']);
															if (isset($flight_result1['Recomm'][1]['paxFareProduct'][0])) 
															{
																if(isset($flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]))
																{
																	$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['rbd'][$j];
																	$testing1['Return'][$i]['cabin'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['cabin'][$j];
																}
																else
																{
																	$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'][$j];
																	$testing1['Return'][$i]['cabin'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['cabin'][$j];
																}
															} 
															else 
															{
																if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]))
																{
																	$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'][$j];
																	$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['cabin'][$j];
																}
																else
																{
																	if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][$j]))
																		$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][$j];
																	else
																		$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'];
																	if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'][$j]))
																		$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'][$j];
																	else
																		$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'];
																}
															}
														}
														else
														{
															$count_rbd = count($flight_result1['Recomm']['paxFareProduct']);
															if (isset($flight_result1['Recomm']['paxFareProduct'][0])) {
																if(isset($flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]))
																{
																	$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'][$j];
																	$testing1['Return'][$i]['cabin'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['cabin'][$j];
																}
																else
																{
																	$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'][$j];
																	$testing1['Return'][$i]['cabin'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'][$j];
																}
															} 
															else 
															{
																if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]))
																{
																	$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'][$j];
																	$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['cabin'][$j];
																}
																else
																{
																	if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j]))
																		$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j];
																	else
																		$testing1['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'];
																	if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j]))
																		$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j];
																	else
																		$testing1['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'];
																}
															}
														}
													}
												}
												$i++;
											}
										}
									}
        
            
            //echo '<pre />';print_r($testing1);
            $countOneway=count($testing1['oneway']);
            for($r=0;$r < $countOneway;$r++)
            {
					if($testing1['oneway'][$r]['stops']>0)
					{
						$dur_in_min_layover=implode('<br>',$testing1['oneway'][$r]['dur_in_min_layover']);
						$cicode=implode('<br>',$testing1['oneway'][$r]['cicode']);
						$name=implode('<br>',$testing1['oneway'][$r]['name']);
						$fnumber=implode('<br>',$testing1['oneway'][$r]['fnumber']);
						$dlocation=implode('<br>',$testing1['oneway'][$r]['dlocation']);
						$alocation=implode('<br>',$testing1['oneway'][$r]['alocation']);
						$timeOfDeparture=implode('<br>',$testing1['oneway'][$r]['timeOfDeparture']);
						$timeOfArrival=implode('<br>',$testing1['oneway'][$r]['timeOfArrival']);
						$dateOfDeparture=implode('<br>',$testing1['oneway'][$r]['dateOfDeparture']);
						$dateOfArrival=implode('<br>',$testing1['oneway'][$r]['dateOfArrival']);
						$equipmentType=implode('<br>',$testing1['oneway'][$r]['equipmentType']);
						$ddate=implode('<br>',$testing1['oneway'][$r]['ddate']);
						$adate=implode('<br>',$testing1['oneway'][$r]['adate']);
						$dep_date=implode('<br>',$testing1['oneway'][$r]['dep_date']);
						$arv_date=implode('<br>',$testing1['oneway'][$r]['arv_date']);
						$ddate1=implode('<br>',$testing1['oneway'][$r]['ddate1']);
						$adate1=implode('<br>',$testing1['oneway'][$r]['adate1']);
						$duration_final=implode('<br>',$testing1['oneway'][$r]['duration_final']);
						$duration_final1=implode('<br>',$testing1['oneway'][$r]['duration_final1']);
						$duration_final_layover=implode('<br>',$testing1['oneway'][$r]['duration_final_layover']);
						$dur_in_min_layover=implode('<br>',$testing1['oneway'][$r]['dur_in_min_layover']);
						/*if(is_array($testing1['oneway'][$r]['fareType']))
						{
							$fareType=implode('<br>',$testing1['oneway'][$r]['fareType']);
						}
						else
						{
							$fareType=$testing1['oneway'][$r]['fareType'];
						}*/
						$fareType= '';
						if(is_array($testing1['oneway'][$r]['BookingClass']))
						{
							$BookingClass=implode('<br>',$testing1['oneway'][$r]['BookingClass']);
						}
						else
						{
							$BookingClass=$testing1['oneway'][$r]['BookingClass'];
						}
						if(is_array($testing1['oneway'][$r]['cabin']))
						{
							$cabin=implode('<br>',$testing1['oneway'][$r]['cabin']);
						}
						else
						{
							$cabin=$testing1['oneway'][$r]['cabin'];
						}
						$insert_array[]=array(
						'session_id'=>$session_id,'akbar_session'=>$_SESSION['akbar_session'], 'journey_type'=>'Round_oneway',
						'cicode'=>$cicode,'name'=>$name,
						'fnumber'=>$fnumber,
						'dlocation'=>$dlocation,
						'alocation'=>$alocation,
						'timeOfDeparture'=>$timeOfDeparture,
						'timeOfArrival'=>$timeOfArrival,
						'dateOfDeparture'=>$dateOfDeparture,
						'dateOfArrival'=>$dateOfArrival,
						'equipmentType'=>$equipmentType,
						'redeye'=>$testing1['oneway'][$r]['redeye'],
						'dtime_filter'=>$testing1['oneway'][$r]['dtime_filter'],
						'atime_filter'=>$testing1['oneway'][$r]['atime_filter'],
						'ddate'=>$ddate,
						'adate'=>$adate,
						'dep_date'=>$dep_date,
						'arv_date'=>$arv_date,
						'ddate1'=>$ddate1,
						'adate1'=>$adate1,
						'duration_final'=>$duration_final,
						'duration_final1'=>$duration_final1,
						'duration_final_eft'=>$testing1['oneway'][$r]['duration_final_eft'],
						'dur_in_min'=>$testing1['oneway'][$r]['dur_in_min'],
						'dur_in_min_layover'=>$dur_in_min_layover,
						'duration_final_layover'=>$duration_final_layover,
						'flag_marketingCarrier'=>$testing1['oneway'][$r]['flag_marketingCarrier'],
						'FareAmount'=>$testing1['oneway'][$r]['FareAmount'],
						'TaxAmount'=>$testing1['oneway'][$r]['TaxAmount'],
						'pamount'=>$testing1['oneway'][$r]['pamount'],
						'fareType'=>$fareType,
						'ccode'=>$testing1['oneway'][$r]['ccode'],
						'ref_id'=>$testing1['Return'][$r]['id'],
						'stops'=>$testing1['oneway'][$r]['stops'],
						'flag'=>$testing1['oneway'][$r]['flag'],
						'MultiTicket'=>$testing1['oneway'][$r]['MultiTicket'],
						'rand_id'=>$testing1['oneway'][$r]['rand_id'],
						'admin_markup'=>$testing1['oneway'][$r]['admin_markup'],
						'payment_charge'=>$testing1['oneway'][$r]['payment_charge'],
						'Total_FareAmount'=>$testing1['oneway'][$r]['Total_FareAmount'],
						'BookingClass'=>$BookingClass,
						'cabin'=>$cabin,
						'cabin'=>$cabin,'fromcityval'=>$fromcityval_for_cache,'tocityval'=>$tocityval_for_cache,'sd'=>$sd_cache,'ed'=>$ed_cache,'adults'=>$adults_cache,'childs'=>$childs_cache,'infants'=>$infants_cache,'journey_types'=>$journey_types_cache,'cabin_selected'=>$cabin_selected_cache
						);
					}
					else
					{
						//is_array
						//echo $testing1['oneway'][$r]['fareType'];
						/*if(is_array($testing1['oneway'][$r]['fareType']))
						{
								$fareType=implode('<br>',$testing1['oneway'][$r]['fareType']);
						}
						else $fareType=$testing1['oneway'][$r]['fareType'];*/
						$fareType = '';
						$insert_array[]=array(
						'session_id'=>$session_id,'akbar_session'=>$_SESSION['akbar_session'], 'journey_type'=>'Round_oneway',
						'cicode'=>$testing1['oneway'][$r]['cicode'],'name'=>$testing1['oneway'][$r]['name'],
						'fnumber'=>$testing1['oneway'][$r]['fnumber'],
						'dlocation'=>$testing1['oneway'][$r]['dlocation'],
						'alocation'=>$testing1['oneway'][$r]['alocation'],
						'timeOfDeparture'=>$testing1['oneway'][$r]['timeOfDeparture'],
						'timeOfArrival'=>$testing1['oneway'][$r]['timeOfArrival'],
						'dateOfDeparture'=>$testing1['oneway'][$r]['dateOfDeparture'],
						'dateOfArrival'=>$testing1['oneway'][$r]['dateOfArrival'],
						'equipmentType'=>$testing1['oneway'][$r]['equipmentType'],
						'redeye'=>$testing1['oneway'][$r]['redeye'],
						'dtime_filter'=>$testing1['oneway'][$r]['dtime_filter'],
						'atime_filter'=>$testing1['oneway'][$r]['atime_filter'],
						'ddate'=>$testing1['oneway'][$r]['ddate'],
						'adate'=>$testing1['oneway'][$r]['adate'],
						'dep_date'=>$testing1['oneway'][$r]['dep_date'],
						'arv_date'=>$testing1['oneway'][$r]['arv_date'],
						'ddate1'=>$testing1['oneway'][$r]['ddate1'],
						'adate1'=>$testing1['oneway'][$r]['adate1'],
						'duration_final'=>$testing1['oneway'][$r]['duration_final'],
						'duration_final1'=>$testing1['oneway'][$r]['duration_final1'],
						'duration_final_eft'=>$testing1['oneway'][$r]['duration_final_eft'],
						'dur_in_min'=>$testing1['oneway'][$r]['dur_in_min'],
						'dur_in_min_layover'=>'',
						'duration_final_layover'=>'',
						'flag_marketingCarrier'=>'',
						'FareAmount'=>$testing1['oneway'][$r]['FareAmount'],
						'TaxAmount'=>$testing1['oneway'][$r]['TaxAmount'],
						'pamount'=>$testing1['oneway'][$r]['pamount'],
						'fareType'=>$fareType,
						'ccode'=>$testing1['oneway'][$r]['ccode'],
						'ref_id'=>$testing1['Return'][$r]['id'],
						'stops'=>$testing1['oneway'][$r]['stops'],
						'flag'=>$testing1['oneway'][$r]['flag'],
						'MultiTicket'=>$testing1['oneway'][$r]['MultiTicket'],
						'rand_id'=>$testing1['oneway'][$r]['rand_id'],
						'admin_markup'=>$testing1['oneway'][$r]['admin_markup'],
						'payment_charge'=>$testing1['oneway'][$r]['payment_charge'],
						'Total_FareAmount'=>$testing1['oneway'][$r]['Total_FareAmount'],
						'BookingClass'=>$testing1['oneway'][$r]['BookingClass'],
						'cabin'=>$testing1['oneway'][$r]['cabin'],
						'cabin'=>$cabin,'fromcityval'=>$fromcityval_for_cache,'tocityval'=>$tocityval_for_cache,'sd'=>$sd_cache,'ed'=>$ed_cache,'adults'=>$adults_cache,'childs'=>$childs_cache,'infants'=>$infants_cache,'journey_types'=>$journey_types_cache,'cabin_selected'=>$cabin_selected_cache
						);
					}
					
					if($testing1['Return'][$r]['stops']>0)
					{
						$dur_in_min_layover=implode('<br>',$testing1['Return'][$r]['dur_in_min_layover']);
						$cicode=implode('<br>',$testing1['Return'][$r]['cicode']);
						$name=implode('<br>',$testing1['Return'][$r]['name']);
						$fnumber=implode('<br>',$testing1['Return'][$r]['fnumber']);
						$dlocation=implode('<br>',$testing1['Return'][$r]['dlocation']);
						$alocation=implode('<br>',$testing1['Return'][$r]['alocation']);
						$timeOfDeparture=implode('<br>',$testing1['Return'][$r]['timeOfDeparture']);
						$timeOfArrival=implode('<br>',$testing1['Return'][$r]['timeOfArrival']);
						$dateOfDeparture=implode('<br>',$testing1['Return'][$r]['dateOfDeparture']);
						$dateOfArrival=implode('<br>',$testing1['Return'][$r]['dateOfArrival']);
						if(is_array($testing1['Return'][$r]['equipmentType']))
						{
							$equipmentType=implode('<br>',$testing1['Return'][$r]['equipmentType']);
						}
						else
						{
							$equipmentType=$testing1['Return'][$r]['equipmentType'];
						}
						$ddate=implode('<br>',$testing1['Return'][$r]['ddate']);
						$adate=implode('<br>',$testing1['Return'][$r]['adate']);
						$dep_date=implode('<br>',$testing1['Return'][$r]['dep_date']);
						$arv_date=implode('<br>',$testing1['Return'][$r]['arv_date']);
						$ddate1=implode('<br>',$testing1['Return'][$r]['ddate1']);
						$adate1=implode('<br>',$testing1['Return'][$r]['adate1']);
						$duration_final=implode('<br>',$testing1['Return'][$r]['duration_final']);
						$duration_final1=implode('<br>',$testing1['Return'][$r]['duration_final1']);
						$duration_final_layover=implode('<br>',$testing1['Return'][$r]['duration_final_layover']);
						$dur_in_min_layover=implode('<br>',$testing1['Return'][$r]['dur_in_min_layover']);
						/*if(is_array($testing1['Return'][$r]['equipmentType']))
						{
							$fareType=implode('<br>',$testing1['Return'][$r]['fareType']);
						}
						else
						{
							$fareType=$testing1['Return'][$r]['fareType'];
						}*/
						$fareType= '';
						//$fareType=implode('<br>',$testing1['Return'][$r]['fareType']);
						if(is_array($testing1['Return'][$r]['BookingClass']))
						{
							$BookingClass=implode('<br>',$testing1['Return'][$r]['BookingClass']);
						}
						else
						{
							$BookingClass=$testing1['Return'][$r]['BookingClass'];
						}
						if(is_array($testing1['Return'][$r]['cabin']))
						{
							$cabin=implode('<br>',$testing1['Return'][$r]['cabin']);
						}
						else
						{
							$cabin=$testing1['Return'][$r]['cabin'];
						}
						$insert_array[]=array(
						'session_id'=>$_SESSION['session_id'],'akbar_session'=>$_SESSION['akbar_session'], 'journey_type'=>'Round_return',
						'cicode'=>$cicode,'name'=>$name,
						'fnumber'=>$fnumber,
						'dlocation'=>$dlocation,
						'alocation'=>$alocation,
						'timeOfDeparture'=>$timeOfDeparture,
						'timeOfArrival'=>$timeOfArrival,
						'dateOfDeparture'=>$dateOfDeparture,
						'dateOfArrival'=>$dateOfArrival,
						'equipmentType'=>$equipmentType,
						'redeye'=>$testing1['Return'][$r]['redeye'],
						'dtime_filter'=>$testing1['Return'][$r]['dtime_filter'],
						'atime_filter'=>$testing1['Return'][$r]['atime_filter'],
						'ddate'=>$ddate,
						'adate'=>$adate,
						'dep_date'=>$dep_date,
						'arv_date'=>$arv_date,
						'ddate1'=>$ddate1,
						'adate1'=>$adate1,
						'duration_final'=>$duration_final,
						'duration_final1'=>$duration_final1,
						'duration_final_eft'=>$testing1['Return'][$r]['duration_final_eft'],
						'dur_in_min'=>$testing1['Return'][$r]['dur_in_min'],
						'dur_in_min_layover'=>$dur_in_min_layover,
						'duration_final_layover'=>$duration_final_layover,
						'flag_marketingCarrier'=>$testing1['Return'][$r]['flag_marketingCarrier'],
						'FareAmount'=>$testing1['Return'][$r]['FareAmount'],
						'TaxAmount'=>$testing1['Return'][$r]['TaxAmount'],
						'pamount'=>$testing1['Return'][$r]['pamount'],
						'fareType'=>$fareType,
						'ccode'=>$testing1['Return'][$r]['ccode'],
						'ref_id'=>$testing1['Return'][$r]['id'],
						'stops'=>$testing1['Return'][$r]['stops'],
						'flag'=>$testing1['Return'][$r]['flag'],
						'MultiTicket'=>$testing1['Return'][$r]['MultiTicket'],
						'rand_id'=>$testing1['Return'][$r]['rand_id'],
						'admin_markup'=>$testing1['Return'][$r]['admin_markup'],
						'payment_charge'=>$testing1['Return'][$r]['payment_charge'],
						'Total_FareAmount'=>$testing1['Return'][$r]['Total_FareAmount'],
						'BookingClass'=>$BookingClass,
						'cabin'=>$cabin,'fromcityval'=>$fromcityval_for_cache,'tocityval'=>$tocityval_for_cache,'sd'=>$sd_cache,'ed'=>$ed_cache,'adults'=>$adults_cache,'childs'=>$childs_cache,'infants'=>$infants_cache,'journey_types'=>$journey_types_cache,'cabin_selected'=>$cabin_selected_cache
						);
					}
					else
					{
						/*if(is_array($testing1['Return'][$r]['fareType']))
						{
							$fareType=implode('<br>',$testing1['Return'][$r]['fareType']);
						}
						else { $fareType=$testing1['Return'][$r]['fareType']; } */
						$fareType = '';
						if(is_array($testing1['Return'][$r]['equipmentType']))
						{
							$equipmentType = implode('<br>',$testing1['Return'][$r]['equipmentType']);
						}
						else
						{
							$equipmentType = $testing1['Return'][$r]['equipmentType'];
						}
						//$fareType = '';
						$insert_array[]=array(
						'session_id'=>$session_id,'akbar_session'=>$_SESSION['akbar_session'], 'journey_type'=>'Round_return',
						'cicode'=>$testing1['Return'][$r]['cicode'],'name'=>$testing1['Return'][$r]['name'],
						'fnumber'=>$testing1['Return'][$r]['fnumber'],
						'dlocation'=>$testing1['Return'][$r]['dlocation'],
						'alocation'=>$testing1['Return'][$r]['alocation'],
						'timeOfDeparture'=>$testing1['Return'][$r]['timeOfDeparture'],
						'timeOfArrival'=>$testing1['Return'][$r]['timeOfArrival'],
						'dateOfDeparture'=>$testing1['Return'][$r]['dateOfDeparture'],
						'dateOfArrival'=>$testing1['Return'][$r]['dateOfArrival'],
						'equipmentType'=>$equipmentType,
						'redeye'=>$testing1['Return'][$r]['redeye'],
						'dtime_filter'=>$testing1['Return'][$r]['dtime_filter'],
						'atime_filter'=>$testing1['Return'][$r]['atime_filter'],
						'ddate'=>$testing1['Return'][$r]['ddate'],
						'adate'=>$testing1['Return'][$r]['adate'],
						'dep_date'=>$testing1['Return'][$r]['dep_date'],
						'arv_date'=>$testing1['Return'][$r]['arv_date'],
						'ddate1'=>$testing1['Return'][$r]['ddate1'],
						'adate1'=>$testing1['Return'][$r]['adate1'],
						'duration_final'=>$testing1['Return'][$r]['duration_final'],
						'duration_final1'=>$testing1['Return'][$r]['duration_final1'],
						'duration_final_eft'=>$testing1['Return'][$r]['duration_final_eft'],
						'dur_in_min'=>$testing1['Return'][$r]['dur_in_min'],
						'dur_in_min_layover'=>'',
						'duration_final_layover'=>'',
						'flag_marketingCarrier'=>'',
						'FareAmount'=>$testing1['Return'][$r]['FareAmount'],
						'TaxAmount'=>$testing1['Return'][$r]['TaxAmount'],
						'pamount'=>$testing1['Return'][$r]['pamount'],
						'fareType'=>$fareType,
						'ccode'=>$testing1['Return'][$r]['ccode'],
						'ref_id'=>$testing1['Return'][$r]['id'],
						'stops'=>$testing1['Return'][$r]['stops'],
						'flag'=>$testing1['Return'][$r]['flag'],
						'MultiTicket'=>$testing1['Return'][$r]['MultiTicket'],
						'rand_id'=>$testing1['Return'][$r]['rand_id'],
						'admin_markup'=>$testing1['Return'][$r]['admin_markup'],
						'payment_charge'=>$testing1['Return'][$r]['payment_charge'],
						'Total_FareAmount'=>$testing1['Return'][$r]['Total_FareAmount'],
						'BookingClass'=>$testing1['Return'][$r]['BookingClass'],
						'cabin'=>$testing1['Return'][$r]['cabin'],
						'fromcityval'=>$fromcityval_for_cache,'tocityval'=>$tocityval_for_cache,'sd'=>$sd_cache,'ed'=>$ed_cache,'adults'=>$adults_cache,'childs'=>$childs_cache,'infants'=>$infants_cache,'journey_types'=>$journey_types_cache,'cabin_selected'=>$cabin_selected_cache
						);
					}
			}
			/*'fromcityval'=>$_SESSION['fromcityval'],
						'tocityval'=>$_SESSION['tocityval'],
						'sd'=>$_SESSION['sd'],'ed'=>$_SESSION['ed'],'adults'=>$_SESSION['adults'],'childs'=>$_SESSION['childs'],'infants'=>$infants,'journey_types'=>$_SESSION['journey_type'],'cabin_selected'=>$_SESSION['cabin'] */
			//echo "<pre>"; print_r($insert_array); exit;
			$this->db->query($sql="delete from flight_search_result where session_id='".$session_id."'");
			$this->db->insert_batch('flight_search_result',$insert_array);
            
		}
		else
		{
			$data['flight_result'] = '';
			$data['currency'] = '';
		}
		
		}
		
		if (($_SESSION['journey_type'] == "OneWay")) {
            $this->fetch_flight_search_result($session_id,$_SESSION['akbar_session'],$rand_id);
        } else if ($_SESSION['journey_type'] == "Round") {
            $this->fetch_flight_search_result_Round_Trip($session_id,$_SESSION['akbar_session'],$rand_id);
        } else if ($_SESSION['journey_type'] == "Calendar") {
            $this->fetch_flight_search_result_Round_Trip_Calendar($data, $rand_id);
        } else if ($_SESSION['journey_type'] == "MultiCity") {
            //echo '<pre/>';print_r($data);exit;
            $this->fetch_flight_search_result_multicity($data, $rand_id);
        }
	}
	else
	{
		$session_id=$_SESSION['session_id'];
		if (($_SESSION['journey_type'] == "OneWay")) {
            $this->fetch_flight_search_resultcache($fromcityval_for_cache,$tocityval_for_cache,$sd_cache,$ed_cache,$adults_cache,$childs_cache,$infants_cache,$journey_types_cache,$cabin_selected_cache);
        } else if ($_SESSION['journey_type'] == "Round") {
            $this->fetch_flight_search_result_Round_Trip($session_id,$_SESSION['akbar_session'],$rand_id);
        } else if ($_SESSION['journey_type'] == "Calendar") {
            $this->fetch_flight_search_result_Round_Trip_Calendar($data, $rand_id);
        } else if ($_SESSION['journey_type'] == "MultiCity") {
            //echo '<pre/>';print_r($data);exit;
            $this->fetch_flight_search_result_multicity($data, $rand_id);
        }
	}
	
}
	public function fetch_flight_search_resultcache($fromcityval_for_cache,$tocityval_for_cache,$sd_cache,$ed_cache,$adults_cache,$childs_cache,$infants_cache,$journey_types_cache,$cabin_selected_cache)
    {
        //echo "Working : OneWay ";exit;
        //echo $rand_id;exit;
         $rand_id = $_SESSION['Rand_id'];
        $flightResult = $flight_result = $this->Flights_Model->getFlightSearchResultcache($fromcityval_for_cache,$tocityval_for_cache,$sd_cache,$ed_cache,$adults_cache,$childs_cache,$infants_cache,$journey_types_cache,$cabin_selected_cache);
        $data['flight_result']=$flightResult['search_result'];
       // echo '<pre />dfsfsdf';print_r($data['flight_result']);die;
        $flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
        if($data['flight_result']!='')
        {
			$flight_search_result = $this->load->view('flights/search_result_ajax',$data,true);
			$airlines=$flightResult['airlines'];
			$stops = $flightResult['stops'];
		}
		else 
		{
			$flight_search_result = false;
			$airlines = "";
			$stops = "";
		}
        $testing = $data['flight_result'];	
        $min_amount = "";
        $min_duration = "";
        $max_amount = "";
        $max_duration = "";
       
        $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
		
		$min_time_arival = '';
		$max_time_arival = '';
		$min_time_departure = '';
		$max_time_departure = '';
       
        $airline_data['airline']=$airlines;
        //echo '<pre />';print_r($airline_data['airline']);die;
        $stops_data['stops']=$stops;
        
        //$matrixData['airline_data']=$airline_data;
        //$matrixData['stops']=$stops;
        $matrixData['flight_result']=$testing;
        
        $airline_filter_result=$this->load->view('flights/search_result_airline_ajax_round',$airline_data,true);
        $stops_filter_result=$this->load->view('flights/search_result_stops_ajax',$stops_data,true);
        $matrix_search_result= $this->load->view('flights/search_result_matrix',$matrixData,true);
        //print_r($airlines);die;
        echo json_encode(array(
            'flight_search_result' => $flight_search_result,
            'airline_filter_search' => $airline_filter_result,
            'stops_filter_search' => $stops_filter_result,
            'matrix_search_result' => $matrix_search_result,
            'min_flight_price_val' => $min_amount,
            'max_flight_price_val' => $max_amount,
            'min_flight_duration_val' => $min_duration,
            'max_flight_duration_val' => $max_duration,
            'min_flight_atime_val' => $min_time_arival,
            'max_flight_atime_val' => $max_time_arival,
            'min_flight_dtime_val' => $min_time_departure,
            'max_flight_dtime_val' => $max_time_departure,
            'airLine' => $airlines,
            'rand_id' => $rand_id,
            'stops' => $stops
        ));
    }
	public function fetch_flight_search_result($session_id,$akbar_session,$rand_id)
    {
        //echo "Working : OneWay ";exit;
        //echo $rand_id;exit;
        $flightResult = $flight_result = $this->Flights_Model->getFlightSearchResult($session_id,$akbar_session);
        $data['flight_result']=$flightResult['search_result'];
       // echo '<pre />dfsfsdf';print_r($data['flight_result']);die;
        $flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
        if($data['flight_result']!='')
        {
			$flight_search_result = $this->load->view('flights/search_result_ajax',$data,true);
			$airlines=$flightResult['airlines'];
			$stops = $flightResult['stops'];
		}
		else 
		{
			$flight_search_result = false;
			$airlines = "";
			$stops = "";
		}
        $testing = "";	
        $min_amount = "";
        $min_duration = "";
        $max_amount = "";
        $max_duration = "";
        $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
		
		$min_time_arival = '';
		$max_time_arival = '';
		$min_time_departure = '';
		$max_time_departure = '';
       
        $airline_data['airline']=$airlines;
        //echo '<pre />';print_r($airline_data['airline']);die;
        $stops_data['stops']=$stops;
        
        //$matrixData['airline_data']=$airline_data;
        //$matrixData['stops']=$stops;
        $matrixData['flight_result']=$testing;
        
        $airline_filter_result=$this->load->view('flights/search_result_airline_ajax_round',$airline_data,true);
        $stops_filter_result=$this->load->view('flights/search_result_stops_ajax',$stops_data,true);
        $matrix_search_result= $this->load->view('flights/search_result_matrix',$matrixData,true);
        //print_r($airlines);die;
        echo json_encode(array(
            'flight_search_result' => $flight_search_result,
            'airline_filter_search' => $airline_filter_result,
            'stops_filter_search' => $stops_filter_result,
            'matrix_search_result' => $matrix_search_result,
            'min_flight_price_val' => $min_amount,
            'max_flight_price_val' => $max_amount,
            'min_flight_duration_val' => $min_duration,
            'max_flight_duration_val' => $max_duration,
            'min_flight_atime_val' => $min_time_arival,
            'max_flight_atime_val' => $max_time_arival,
            'min_flight_dtime_val' => $min_time_departure,
            'max_flight_dtime_val' => $max_time_departure,
            'airLine' => $airlines,
            'rand_id' => $rand_id,
            'stops' => $stops
        ));
    }
    
    public function fetch_flight_search_result_Round_Trip($session_id,$akbar_session,$rand_id)
    {
		$flightResult = $flight_result = $this->Flights_Model->getFlightSearchResultRound($session_id,$akbar_session);
        $data['flight_result']=$flightResult['search_result'];
        //echo '<pre />dfsfsdf';print_r($data['flight_result']);die;
        $flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
        if($data['flight_result']!='')
        {
			$flight_search_result = $this->load->view('flights/search_result_ajax_round_new',$data,true);
			$airlines=$flightResult['airlines'];
			$stops = $flightResult['stops'];
		}
		else 
		{
			$flight_search_result = false;
			$airlines = "";
			$stops = "";
		}
        $testing = "";	
        $min_amount = "";
        $min_duration = "";
        $max_amount = "";
        $max_duration = "";
        $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
		
		$min_time_arival = '';
		$max_time_arival = '';
		$min_time_departure = '';
		$max_time_departure = '';
       
        $airline_data['airline']=$airlines;
        //echo '<pre />';print_r($airline_data['airline']);die;
        $stops_data['stops']=$stops;
        
        //$matrixData['airline_data']=$airline_data;
        //$matrixData['stops']=$stops;
        $matrixData['flight_result']=$testing;
        
        //$airline_filter_result=$this->load->view('flights/search_result_airline_ajax',$airline_data,true);
		$airline_filter_result=$this->load->view('flights/search_result_airline_ajax_round',$airline_data,true);
        $stops_filter_result=$this->load->view('flights/search_result_stops_ajax',$stops_data,true);
        $matrix_search_result= $this->load->view('flights/search_result_matrix',$matrixData,true);
        //echo "<pre>"; print_r($flight_search_result);die;
        echo json_encode(array(
            'flight_search_result' => $flight_search_result,
            'airline_filter_search' => $airline_filter_result,
            'stops_filter_search' => $stops_filter_result,
            'matrix_search_result' => $matrix_search_result,
            'min_flight_price_val' => $min_amount,
            'max_flight_price_val' => $max_amount,
            'min_flight_duration_val' => $min_duration,
            'max_flight_duration_val' => $max_duration,
            'min_flight_atime_val' => $min_time_arival,
            'max_flight_atime_val' => $max_time_arival,
            'min_flight_dtime_val' => $min_time_departure,
            'max_flight_dtime_val' => $max_time_departure,
            'airLine' => $airlines,
            'rand_id' => $rand_id,
            'stops' => $stops
        ));
	}
    
	function flight_details($id, $rand_id, $ref_id='')
    {
		$data['results'] = $this->Flights_Model->get_hotels();
        $flight_result=$this->Flights_Model->getFlightDetails($id, $rand_id);
        //echo $flight_result->journey_type; exit;
        if ($flight_result->journey_type == "Round") 
        {
            $data['flightDetails_oneway'] = $flight_result['oneway'][$id];
            $data['flightDetails_return'] = $flight_result['Return'][$id];
            $data['flightDetails1'] = $flight_result1[$id];
            //echo '<pre/>flightDetails_oneway:<br/>';print_r($data['flightDetails_oneway']);
            //echo '<pre/>flightDetails_return:<br/>';print_r($data['flightDetails_return']);
            //echo '<pre/>flightDetails1:<br/>';print_r($data['flightDetails1']);exit;
        } 
        else if ($flight_result->journey_type == "MultiCity")
        {
            $data['flightDetails'] = $flight_result[$id]['multi'];
            $recomm_id = $data['flightDetails'][0]['recom'];
            $seg_id = $data['flightDetails'][0]['seg_id'];
            $_SESSION[$rand_id]['multi_id'] = $id;
            //echo '<pre/>';print_r($data['flightDetails']);exit;
            //echo $recomm_id." ".$seg_id;echo '<pre/>flightDetails:<br/>';print_r($data['flightDetails']);exit;
            $data['flightDetails1'] = $flight_result1[$recomm_id][$seg_id];
            //echo '<pre/>flightDetails:<br/>';print_r($_SESSION);exit;
            //echo '<pre/>flightDetails:<br/>';print_r($data['flightDetails']);exit;
            //echo '<pre/>flightDetails1:<br/>';print_r($data['flightDetails1']);exit;			
            $data['recom'] = $recomm_id;
            $data['seg_id'] = $seg_id;
        } 
        else 
        {
            $data['flightDetails'] = $flight_result;
           
        }

        $data['rand_id'] = $rand_id;
        if ($flight_result->journey_types == "Round") 
        {
			$data['flight_details_return'] = $this->Flights_Model->get_return_flights($ref_id);
            $this->load->view('flights/flight_detail_round', $data);
        } 
        else if ($flight_result->journey_type == "MultiCity") 
        {
            $this->load->view('flights/flight_detail_multi', $data);
        }
        else
            $this->load->view('flights/flight_details', $data);
    }
    
    function pro_pre_booking($id,$rand_id,$ref_id='')
    {
		if($this->input->post('guest_booking'))
        {
            $guestEmail=$this->input->post('guest_email');
            $this->form_validation->set_rules('guest_email','Email','required|valid_email|is_unique[master_customer.emailid]');
            if($this->form_validation->run()==true)
            {
                $_SESSION['guest_email']=$guestEmail;
                redirect('flights/pre_booking/'.$id.'/'.$rand_id.'/'.$ref_id, 'refresh');
            }
            else
            {
				$flight_result=$this->Flights_Model->getFlightDetails($id, $rand_id);
				if ($flight_result->journey_type == "Round") 
				{
					$data['flightDetails_oneway'] = $flight_result['oneway'][$id];
					$data['flightDetails_return'] = $flight_result['Return'][$id];
					$data['flightDetails1'] = $flight_result1[$id];
				} 
				else if ($flight_result->journey_type == "MultiCity")
				{
					$data['flightDetails'] = $flight_result[$id]['multi'];
					$recomm_id = $data['flightDetails'][0]['recom'];
					$seg_id = $data['flightDetails'][0]['seg_id'];
					$_SESSION[$rand_id]['multi_id'] = $id;
					$data['flightDetails1'] = $flight_result1[$recomm_id][$seg_id];	
					$data['recom'] = $recomm_id;
					$data['seg_id'] = $seg_id;
				} 
				else 
				{
					$data['flightDetails'] = $flight_result;
				}

				$data['rand_id'] = $rand_id;
				if ($flight_result->journey_types == "Round") 
				{
					$this->load->view('flights/flight_detail_round', $data);
				} 
				else if ($flight_result->journey_type == "MultiCity") 
				{
					$this->load->view('flights/flight_detail_multi', $data);
				}
				else
					$this->load->view('flights/flight_details', $data);
			 }
		}
        elseif($this->input->post('user_booking'))
        {
            $userName=$this->input->post('user_name');
            $password=$this->input->post('user_password');
            $this->form_validation->set_rules('user_name','Email','required|valid_email');
            $this->form_validation->set_rules('user_password','Password','required');
            $userCheck=$this->Flights_Model->checkUserExists($userName,$password);
            $userCheck1 = 'user';
            if($this->form_validation->run()==true && $userCheck==true)
            {
                $_SESSION['user_email']=$userName;
                redirect('flights/pre_booking/'.$id.'/'.$rand_id.'/'.$ref_id.'/'.$userCheck1, 'refresh');
            }
            else
            {
                $flight_result=$this->Flights_Model->getFlightDetails($id, $rand_id);
				if ($flight_result->journey_type == "Round") 
				{
					$data['flightDetails_oneway'] = $flight_result['oneway'][$id];
					$data['flightDetails_return'] = $flight_result['Return'][$id];
					$data['flightDetails1'] = $flight_result1[$id];
				} 
				else if ($flight_result->journey_type == "MultiCity")
				{
					$data['flightDetails'] = $flight_result[$id]['multi'];
					$recomm_id = $data['flightDetails'][0]['recom'];
					$seg_id = $data['flightDetails'][0]['seg_id'];
					$_SESSION[$rand_id]['multi_id'] = $id;
					$data['flightDetails1'] = $flight_result1[$recomm_id][$seg_id];	
					$data['recom'] = $recomm_id;
					$data['seg_id'] = $seg_id;
				} 
				else 
				{
					$data['flightDetails'] = $flight_result;
				}

				$data['rand_id'] = $rand_id;
				if ($flight_result->journey_types == "Round") 
				{
					$this->load->view('flights/flight_detail_round', $data);
				} 
				else if ($flight_result->journey_type == "MultiCity") 
				{
					$this->load->view('flights/flight_detail_multi', $data);
				}
				else
					$this->load->view('flights/flight_details', $data);
            }
        }
        else
        {
            $flight_result=$this->Flights_Model->getFlightDetails($id, $rand_id);
			if ($flight_result->journey_type == "Round") 
			{
				$data['flightDetails_oneway'] = $flight_result['oneway'][$id];
				$data['flightDetails_return'] = $flight_result['Return'][$id];
				$data['flightDetails1'] = $flight_result1[$id];
			} 
			else if ($flight_result->journey_type == "MultiCity")
			{
				$data['flightDetails'] = $flight_result[$id]['multi'];
				$recomm_id = $data['flightDetails'][0]['recom'];
				$seg_id = $data['flightDetails'][0]['seg_id'];
				$_SESSION[$rand_id]['multi_id'] = $id;
				$data['flightDetails1'] = $flight_result1[$recomm_id][$seg_id];	
				$data['recom'] = $recomm_id;
				$data['seg_id'] = $seg_id;
			} 
			else 
			{
				$data['flightDetails'] = $flight_result;
			}

			$data['rand_id'] = $rand_id;
			if ($flight_result->journey_types == "Round") 
			{
				$this->load->view('flights/flight_detail_round', $data);
			} 
			else if ($flight_result->journey_type == "MultiCity") 
			{
				$this->load->view('flights/flight_detail_multi', $data);
			}
			else
				$this->load->view('flights/flight_details', $data);
        }
        
    }
    
	function pre_booking($id,$rand_id,$ref_id = '',$userCheck = '')
    {
		$data['results'] = $this->Flights_Model->get_hotels();
		$flight_result=$this->Flights_Model->getFlightDetails($id, $rand_id);
        //echo $data['userCheck'] = $userCheck; exit;
        if ($flight_result->journey_type == "Round") 
        {
            $data['flightDetails_oneway'] = $flight_result['oneway'][$id];
            $data['flightDetails_return'] = $flight_result['Return'][$id];
            $data['flightDetails1'] = $flight_result1[$id];
        }
        else if ($flight_result->journey_type == "MultiCity") 
        {
            $data['flightDetails'] = $flight_result[$id]['multi'];
            $recomm_id = $data['flightDetails'][0]['recom'];
            $seg_id = $data['flightDetails'][0]['seg_id'];
            $_SESSION[$rand_id]['multi_id'] = $id;
            $data['flightDetails1'] = $flight_result1[$recomm_id][$seg_id];			
            $data['recom'] = $recomm_id;
            $data['seg_id'] = $seg_id;
        }
        else 
        {
            $data['flightDetails'] = $flight_result;
        }
		if($flight_result->journey_types == "Round")
		{
			$data['flight_details_return'] = $flight_details_return = $this->Flights_Model->get_return_flights($ref_id);
			//echo "<pre>"; print_r($flight_details_return); exit;
		}
        $data['id']=$id;
        $data['rand_id'] = $rand_id;
        $this->load->view('flights/pre_booking',$data);
    }
	
	 function booking_final($id, $rand_id)
    {	
          $user_email = $_POST["user_email"];
######################################################################################################
//        $check = $this->Flights_Model->check_user($user_email);
//        if($check == 0)
//        {
//            $user_title = $_POST['user_title'];
//            $user_fname = $_POST['user_fname'];
//            $user_lname = $_POST['user_lname'];
//            $user_address = $_POST['user_address'];
//            $user_city = $_POST['user_city'];
//            $user_state = $_POST['user_country'];
//            $user_country = $_POST['user_state'];
//            $user_mobile = $_POST['user_mobile'];
//            $akbar_ref = "akb".rand(100,100000);
//            $password = "akb".rand(100,100000);
//            $this->Flights_Model->insert_mastercustomer($user_email,$user_title,$user_fname,$user_lname,$user_address,$user_city,$user_state,$user_country,$user_mobile,$akbar_ref,$password);
//        }
##########################################################################################################
        $query=$this->db->query($sql="select * from flight_search_result where id='".$id."'");
        $res=$query->row_array();
        
        $_SESSION['amadeus'] = '';
        $sess_id = '';
        $SessionId = '';
        $SequenceNumber = '';
        $SecurityToken = '';
        $session_flag = "true";
        //$value = $_SESSION[$rand_id]['book_final_book_val'];
        
        $insure_amount = 00.00;
        if ($session_flag == "true") 
        {
            $Security_Auth = '<?xml version="1.0" encoding="utf-8"?>
							<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
							xmlns:vls="http://xml.amadeus.com/VLSSLQ_06_1_1A">
							<soapenv:Header></soapenv:Header>
								<soapenv:Body>
								<Security_Authenticate> 
								  <userIdentifier>
									<originIdentification>
									  <sourceOffice>LGA1S211T</sourceOffice>
									</originIdentification>
									<originatorTypeCode>U</originatorTypeCode>
									<originator>WSAKBATO</originator>
								  </userIdentifier>
								  <dutyCode>
									<dutyCodeDetails>
									  <referenceQualifier>DUT</referenceQualifier>
									  <referenceIdentifier>SU</referenceIdentifier>
									</dutyCodeDetails>
								  </dutyCode>
								  <systemDetails>
									<organizationDetails>
									  <organizationId>NMC-US</organizationId>
									</organizationDetails>
								  </systemDetails>
								  <passwordInfo>
									<dataLength>8</dataLength>
									<dataType>E</dataType>
									<binaryData>ZXVXRnVoa2g=</binaryData>
								  </passwordInfo>
								</Security_Authenticate>         
							  </soapenv:Body>
							</soapenv:Envelope>';

            //$URL2 = "https://test.webservices.amadeus.com";
            $URL2 = "https://production.webservices.amadeus.com";
            $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/VLSSLQ_06_1_1A";

            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $URL2);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
            curl_setopt($ch2, CURLOPT_HEADER, 0);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, $Security_Auth);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

            /* $httpHeader2 = array(
              "Content-Type: text/xml; charset=UTF-8",
              "Content-Encoding: UTF-8"
              ); */

            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");

            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

            // Execute request, store response and HTTP response code
            $data2 = curl_exec($ch2);
            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
            curl_close($ch2);
            if (!empty($data2)) {
                $xml = new DOMDocument();
                $xml->loadXML($data2);
                $authSessionId=$xml->getElementsByTagName("SessionId")->item(0)->nodeValue;
                $explodeId=explode('|',$authSessionId);
                $SessionId = $explodeId[0];
                $SequenceNumber=$explodeId[1];
                $SecurityToken='';
                //$SequenceNumber = $xml->getElementsByTagName("SequenceNumber")->item(0)->nodeValue;
                //$SecurityToken = $xml->getElementsByTagName("SecurityToken")->item(0)->nodeValue;

                $no = (count($_SESSION['amadeus']));
                $time = time();
                $_SESSION['amadeus'][$no]['SessionId'] = $SessionId;
                $_SESSION['amadeus'][$no]['SequenceNumber'] = $SequenceNumber;
                $_SESSION['amadeus'][$no]['SecurityToken'] = $SecurityToken;
                $_SESSION['amadeus'][$no]['SessionStatus'] = "true";
                $_SESSION['amadeus'][$no]['SessionTime'] = $time;
                $sess_id = $no;
            }
			
        }

        $id = $_POST['result_id'];
        $rand_id=$_POST['rand_id'];
        
        //echo $rand_id.'<<>>>'.$id;die;
        $fromcity = $_SESSION[$rand_id]['fromcityval'];
        $tocity = $_SESSION[$rand_id]['tocityval'];
        if (($res['journey_type'] == "Round_oneway")) 
        {
            $query1=$this->db->query($sql="select * from flight_search_result where session_id='".$_SESSION['session_id']."' and akbar_session='".$_SESSION['akbar_session']."' and ref_id='".$res['ref_id']."'");
            $res1=$query1->row_array();
            //echo '<pre />';print_r($res1);die;
            $flightDetails_oneway = $res;
            $flightDetails_return = $res1;
            $flightDetails1 = $res;
            $flightDetails2 = $res1;

            $API_FareAmount = $flightDetails_oneway['pamount'];
            $admin_markup = ($API_FareAmount * $flightDetails_oneway['admin_markup']) / 100;
            $markup1 = $API_FareAmount + $admin_markup;
            $pg_charge = ($markup1 * $flightDetails_oneway['payment_charge']) / 100;
            $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
            $total_markup = $admin_markup + $pg_charge;

            $value['admin_markup'] = $admin_markup;
            $value['payment_charge'] = $pg_charge;
            $value['Total_price'] = $Total_FareAmount;
            $_SESSION[$rand_id]['book_final_book_val'] = $value;
            // echo '<pre/>flightDetails_oneway:<br/>';print_r($flightDetails_oneway);echo "flightDetails_return:<br/>";print_r($flightDetails_return);echo "flightDetails1:<br/>";print_r($flightDetails1);echo "value:<br/>";print_r($value);exit;
        } 
        else if (($_SESSION[$rand_id]['journey_type'] == "MultiCity")) 
        {
            $flight_result_temp = $_SESSION[$rand_id]['flight_result1'];
            $flight_result = $_SESSION[$rand_id]['flight_result'];
            $iii = 0;

            foreach ($flight_result_temp as $testing_final)
                $flight_result1[$iii++] = $testing_final;

            //echo '<pre/>flightDetails_oneway:<br/>';print_r($flight_result1);exit;
            for ($i = 0; $i < (count($_SESSION[$rand_id]['multi_id'])); $i++) {
                $id = $_SESSION[$rand_id]['multi_id'][$i];
                $flightDetails[$i] = $flight_result[$id]['multi'][$i];
                $r = $flightDetails[$i]['recom'];
                $seg = $flightDetails[$i]['seg_id'];
                $flightDetails1[$i] = $flight_result1[$r][$seg][$i];
            }
            $API_FareAmount = $flightDetails[0]['pamount'];
            $admin_markup = ($API_FareAmount * $flightDetails[0]['admin_markup']) / 100;
            $markup1 = $API_FareAmount + $admin_markup;
            $pg_charge = ($markup1 * $flightDetails[0]['payment_charge']) / 100;
            $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
            $total_markup = $admin_markup + $pg_charge;
            $value['admin_markup'] = $admin_markup;
            $value['payment_charge'] = $pg_charge;
            $value['Total_price'] = $Total_FareAmount;
            $_SESSION[$rand_id]['book_final_book_val'] = $value;
        } 
        else if ($_SESSION[$rand_id]['journey_type'] == "OneWay") 
        {	
            //echo '<pre />';print_r($_SESSION[$rand_id]);die;
            $flightDetails = $res;
            //$flightDetails1 = $_SESSION[$rand_id]['flight_result1'][$id];
            $API_FareAmount = $flightDetails['pamount'];
            $admin_markup = ($API_FareAmount * $flightDetails['admin_markup']) / 100;
            $markup1 = $API_FareAmount + $admin_markup;
            $pg_charge = ($markup1 * $flightDetails['payment_charge']) / 100;
            $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
            $total_markup = $admin_markup + $pg_charge;

            $value['admin_markup'] = $admin_markup;
            $value['payment_charge'] = $pg_charge;
            $value['Total_price'] = $Total_FareAmount;
            //$_SESSION[$rand_id]['book_final_book_val'] = $value;
            //echo '<pre/>flightDetails:<br/>';print_r($flightDetails);echo "flightDetails1: <br/>";print_r($flightDetails1);echo "Value : >br/>";print_r($value);exit;
           // exit;
        }
        $quantity = $_SESSION[$rand_id]['adults'] + $_SESSION[$rand_id]['childs'];
        if ($res['journey_type'] == "Round_oneway") 
        {
            //if ((count($flightDetails_oneway['alocation'])) <= 1) 
            if(!strpos($flightDetails_oneway['alocation'],'<br>'))
            {	
                $fromcity_oneway = $flightDetails_oneway['dlocation'];
                $tocity_oneway = $flightDetails_oneway['alocation'];
                $origin_oneway = $flightDetails_oneway['dlocation'];
                $destination_oneway = $flightDetails_oneway['alocation'];
                $fnumber_oneway = $flightDetails_oneway['fnumber'];
                $airline_code_oneway = $flightDetails_oneway['cicode'];

                if ($flightDetails_oneway['MultiTicket'] != "Yes") 
                {
                    //if (!isset($flightDetails1['Recomm']['paxFareProduct'][0])) 
                    if(!strpos($flightDetails_oneway['BookingClass'],'<br>'))
                    {
                        $bookingClass_oneway['onestopone'] = $flightDetails_oneway['BookingClass'];
//                        if (isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0])) 
//                        {
//                            if (!isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'][0]))
//                                $bookingClass_oneway['onestopone'] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'];
//                            else 
//                            {
//                                for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd']); $pp++) 
//                                {
//                                    $bookingClass_oneway['onestopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'][$pp];
//                                }
//                            }
//                        } 
//                        else 
//                        {
//                            if (!isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'][0]))
//                                $bookingClass_oneway['onestopone'] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'];
//                            else 
//                            {
//                                for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd']); $pp++) 
//                                {
//                                    $bookingClass_oneway['onestopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$pp];
//                                }
//                            }
//                        }
                    } 
                    else 
                    {
                        $bookingClassArray=explode($flightDetails_oneway['BookingClass']);
                        for ($b = 0; $b < (count($bookingClassArray)); $b++) 
                        {
                            $bookingClass_oneway['onestopmulti'][$b] = $bookingClassArray[$b];
//                            if (isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0])) 
//                            {
//                                if (!isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0]['rbd'][0]))
//                                    $bookingClass_oneway['onestopone'] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0]['rbd'];
//                                else 
//                                {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0]['rbd']); $pp++) 
//                                    {
//                                        $bookingClass_oneway['onestopmulti'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0]['rbd'][$pp];
//                                    }
//                                }
//                            } 
//                            else 
//                            {
//                                if (!isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'][0]))
//                                    $bookingClass_oneway['onestopone'] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'];
//                                else 
//                                {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd']); $pp++) 
//                                    {
//                                        $bookingClass_oneway['onestopmulti'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'][$pp];
//                                    }
//                                }
//                            }
                        }
                    }
                } 
                else 
                {
                    if(!strpos($flightDetails_oneway['BookingClass'],'<br>')) 
                    {
                          $bookingClass_oneway['onestopone'] = $flightDetails_oneway['BookingClass'];
//                        if (isset($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0])) 
//                        {
//                            
//                            if (!isset($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'][0]))
//                                $bookingClass_oneway['onestopone'] = $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'];
//                            else {
//                                for ($pp = 0; $pp < count($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd']); $pp++) {
//                                    $bookingClass_oneway['onestopmulti'][$pp] = $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'][$pp];
//                                }
//                            }
//                        } 
//                        else 
//                        {
//                            if (!isset($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][0]))
//                                $bookingClass_oneway['onestopone'] = $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'];
//                            else 
//                            {
//                                for ($pp = 0; $pp < count($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd']); $pp++) 
//                                {
//                                    $bookingClass_oneway['onestopmulti'][$pp] = $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][$pp];
//                                }
//                            }
//                        }
                    } 
                    else 
                    {
                        $bookingClassArray=explode('<br>',$flightDetails_oneway['BookingClass']);
                        for ($b = 0; $b < (count($bookingClassArray)); $b++)
                        {
                            $bookingClass_oneway['onestopmulti'][$b] = $bookingClassArray[$b];
//                            if (isset($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0])) 
//                            {
//                                if (!isset($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0]['rbd'][0]))
//                                    $bookingClass_oneway['onestopone'] = $flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0]['rbd'];
//                                else 
//                                {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0]['rbd']); $pp++) 
//                                    {
//                                        $bookingClass_oneway['onestopmulti'][$b] = $flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0]['rbd'][$pp];
//                                    }
//                                }
//                            } 
//                            else 
//                            {
//                                if (!isset($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails']['rbd'][0]))
//                                    $bookingClass_oneway['onestopone'] = $flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails']['rbd'];
//                                else 
//                                {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails']['rbd']); $pp++) 
//                                    {
//                                        $bookingClass_oneway['onestopmulti'][$b] = $flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails']['rbd'][$pp];
//                                    }
//                                }
//                            }
                        }
                    }
                }

                $cin_oneway = $flightDetails1['dateOfDeparture'];
            } 
            else 
            {
                $alocationArray=explode('<br>',$flightDetails_oneway['alocation']);
                $dlocationArray=explode('<br>',$flightDetails_oneway['dlocation']);
                $fnumberArray=explode('<br>',$flightDetails_oneway['fnumber']);
                $cicodeArray=explode('<br>',$flightDetails_oneway['cicode']);
                $id_to_oneway = ((count($alocationArray)) - 1);
                for ($o = 0; $o < (count($alocationArray)); $o++) 
                {
                    $fromcity_oneway = $dlocationArray[0];
                    $tocity_oneway = $alocationArray[$id_to_oneway];
                    $origin_oneway[$o] = $dlocationArray[$o];
                    $destination_oneway[$o] = $alocationArray[$o];
                    $fnumber_oneway[$o] = $fnumberArray[$o];
                    $airline_code_oneway[$o] = $cicodeArray[$o];
                    
                    if ($flightDetails_oneway['MultiTicket'] != "Yes") 
                    {
                        if (!strpos($flightDetails1['BookingClass'],'<br>')) 
                        {
                            $bookingClass_oneway['multistopone'] = $flightDetails1['BookingClass'];
//                            if (isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0])) 
//                            {
//                                if (!is_array($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd']))
//                                    $bookingClass_oneway['multistopone'] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'];
//                                else 
//                                {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd']); $pp++) {
//                                        $bookingClass_oneway['multistopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'][$pp];
//                                    }
//                                }
//                            } else {
//                                if (!isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'][0]))
//                                    $bookingClass_oneway['multistopone'] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'];
//                                else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd']); $pp++) {
//                                        $bookingClass_oneway['multistopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$pp];
//                                    }
//                                }
//                            }
                        } 
                        else 
                        {
                            $bookingClassArray=explode('<br>',$flightDetails1['BookingClass']);
                            for ($b = 0; $b < (count($bookingClassArray)); $b++) 
                            {
                                 $bookingClass_oneway['multistopmulti'][$b] = $bookingClassArray[$b];
//                                if (isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0])) 
//                                {
//                                    if (!isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0]['rbd'][0])) {
//                                        $bookingClass_oneway['multistopone'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0]['rbd'];
//                                    } else {
//                                        for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0]['rbd'][0]); $pp++) {
//                                            $bookingClass_oneway['multistopmulti'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][0]['rbd'][$pp];
//                                        }
//                                    }
//                                } 
//                                else 
//                                {
//                                    if (!isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'][0])) {
//                                        $bookingClass_oneway['multistopone'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'];
//                                    } else {
//                                        for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'][0]); $pp++) {
//                                            $bookingClass_oneway['multistopmulti'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'][$pp];
//                                        }
//                                    }
//                                }
                            }
                        }
                    } 
                    else 
                    {
                        if (!strpos($flightDetails1['BookingClass'],'<br>')) 
                        {
                            $bookingClass_oneway['multistopone'] = $flightDetails1['BookingClass'];
//                            if (isset($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0])) 
//                            {
//                                if (!isset($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'][0]))
//                                    $bookingClass_oneway['multistopone'] = $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'];
//                                else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd']); $pp++) {
//                                        $bookingClass_oneway['multistopmulti'][$pp] = $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'][$pp];
//                                    }
//                                }
//                            } 
//                            else 
//                            {
//                                if (!isset($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][0]))
//                                    $bookingClass_oneway['multistopone'] = $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'];
//                                else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd']); $pp++) {
//                                        $bookingClass_oneway['multistopmulti'][$pp] = $flightDetails1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][$pp];
//                                    }
//                                }
//                            }
                        } 
                        else 
                        {
                            $bookingClassArray=explode('<br>',$flightDetails1['BookingClass']);
                            $dateOfDepartureArray=explode('<br>',$flightDetails1['dateOfDeparture']);
                            for ($b = 0; $b < (count($bookingClassArray)); $b++) 
                            {
                                $bookingClass_oneway['multistopmulti'][$b] = $bookingClassArray[$b];
//                                if (isset($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0])) {
//                                    if (!isset($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0]['rbd'][0])) {
//                                        $bookingClass_oneway['multistopone'][$b] = $flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0]['rbd'];
//                                    } else {
//                                        for ($pp = 0; $pp < count($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0]['rbd'][0]); $pp++) {
//                                            $bookingClass_oneway['multistopmulti'][$b] = $flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails'][0]['rbd'][$pp];
//                                        }
//                                    }
//                                } 
//                                else 
//                                {
//                                    if (!isset($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails']['rbd'][0])) {
//                                        $bookingClass_oneway['multistopone'][$b] = $flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails']['rbd'];
//                                    } else {
//                                        for ($pp = 0; $pp < count($flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails']['rbd'][0]); $pp++) {
//                                            $bookingClass_oneway['multistopmulti'][$b] = $flightDetails1['Recomm'][0]['paxFareProduct'][$b]['fareDetails']['rbd'][$pp];
//                                        }
//                                    }
//                                }
                            }
                        }
                    }
                    $cin_oneway[$o] = $dateOfDepartureArray[$o];
                }
            }

            // echo count($flightDetails_return['alocation']);exit;
            $alocArray=explode('<br>',$flightDetails_return['alocation']);
            if (count($alocArray) <= 1) 
            {
                $fromcity_return = $flightDetails_return['dlocation'];
                $tocity_return = $flightDetails_return['alocation'];
                $origin_return = $flightDetails_return['dlocation'];
                $destination_return = $flightDetails_return['alocation'];
                $fnumber_return = $flightDetails_return['fnumber'];
                $airline_code_return = $flightDetails_return['cicode'];
                if ($flightDetails_return['MultiTicket'] != "Yes") 
                {
                    if (!strpos($flightDetails1['BookingClass'],'<br>')) 
                    {
                          $bookingClass_return['onestopone'] = $flightDetails1['BookingClass'];
//                        if (isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1])) 
//                        {
//                            if (!isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'][0])) {
//                                $bookingClass_return['onestopone'] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'];
//                            } else {
//                                for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd']); $pp++) {
//                                    $bookingClass_return['onestopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'][$pp];
//                                }
//                            }
//                        } 
//                        else 
//                        {
//                            if (!isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'][1])) {
//                                $bookingClass_return['onestopone'] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'];
//                            } else {
//                                for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd']); $pp++) {
//                                    $bookingClass_return['onestopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$pp];
//                                }
//                            }
//                        }
                    } 
                    else 
                    {
                        $bookingClassArr=explode('<br>',$flightDetails1['BookingClass']);
                        for ($b = 0; $b < (count($bookingClassArr)); $b++) 
                        {
                            $bookingClass_return['onestopmulti'][$pp] = $bookingClassArr[$b];
//                            if (isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1])) 
//                            {
//                                if (!isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1]['rbd'][1])) {
//                                    $bookingClass_return['onestopmulti'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1]['rbd'];
//                                } else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1]['rbd']); $pp++) {
//                                        $bookingClass_return['onestopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1]['rbd'][$pp];
//                                    }
//                                }
//                            } 
//                            else 
//                            {
//                                if (!isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'][1])) {
//                                    $bookingClass_return['onestopmulti'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'];
//                                } else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd']); $pp++) {
//                                        $bookingClass_return['onestopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'][$pp];
//                                    }
//                                }
//                            }
                        }
                    }
                } 
                else 
                {
                    if (!strpos($flightDetails1['BookingClass'],'<br>')) 
                    {
                          $bookingClass_return['onestopone'] = $flightDetails1['BookingClass'];
//                        if (isset($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails'][1])) 
//                        {
//                            
//                            if (!isset($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'][1])) {
//                                $bookingClass_return['onestopone'] = $flightDetails1['Recomm'][1]['paxFareProduct'][1]['fareDetails'][1]['rbd'];
//                            } 
//                            else 
//                            {
//                                for ($pp = 0; $pp < count($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd']); $pp++) 
//                                {
//                                    $bookingClass_return['onestopmulti'][$pp] = $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'][$pp];
//                                }
//                            }
//                        } 
//                        else 
//                        {
//                            if (!isset($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][1])) {
//                                $bookingClass_return['onestopone'] = $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'];
//                            } else {
//                                for ($pp = 0; $pp < count($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd']); $pp++) {
//                                    $bookingClass_return['onestopmulti'][$pp] = $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][$pp];
//                                }
//                            }
//                        }
                    } 
                    else 
                    {
                        $bookingClassArr=explode('<br>',$flightDetails1['BookingClass']);
                        for ($b = 0; $b < (count($bookingClassArr)); $b++) 
                        {
                            $bookingClass_return['onestopmulti'][$pp] = $bookingClassArr[$b];
//                            if (isset($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1])) 
//                            {
//                                if (!isset($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1]['rbd'][1])) {
//                                    $bookingClass_return['onestopmulti'][$b] = $flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1]['rbd'];
//                                } else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1]['rbd']); $pp++) {
//                                        $bookingClass_return['onestopmulti'][$pp] = $flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1]['rbd'][$pp];
//                                    }
//                                }
//                            } else {
//                                if (!isset($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails']['rbd'][1])) {
//                                    $bookingClass_return['onestopmulti'][$b] = $flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails']['rbd'];
//                                } else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails']['rbd']); $pp++) {
//                                        $bookingClass_return['onestopmulti'][$pp] = $flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails']['rbd'][$pp];
//                                    }
//                                }
//                            }
                        }
                    }
                }
                $cin_return = $flightDetails2['dateOfDeparture'];
            } 
            else 
            {
                $alocationRarray=explode('<br>',$flightDetails_return['alocation']);
                $dlocationRarray=explode('<br>',$flightDetails_return['dlocation']);
                $fnumberRarray=explode('<br>',$flightDetails_return['fnumber']);
                $cicodeRarray=explode('<br>',$flightDetails_return['cicode']);
                
                $id_to_return = ((count($alocationRarray)) - 1);
                for ($o = 0; $o < (count($flightDetails_return['alocation'])); $o++) 
                {
                    $fromcity_return = $dlocationRarray[0];
                    $tocity_return = $alocationRarray[$id_to_return];
                    $origin_return[$o] = $dlocationRarray[$o];
                    $destination_return[$o] = $alocationRarray[$o];
                    $fnumber_return[$o] = $fnumberRarray[$o];
                    $airline_code_return[$o] = $cicodeRarray[$o];
                    if ($flightDetails_return['MultiTicket'] != "Yes") 
                    {
                        if (!strpos($flightDetails1['BookingClass'],'<br>')) 
                        {
                              $bookingClass_return['multistopone'] = $flightDetails1['BookingClass'];
//                            if (isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1])) 
//                            {
//                                if (!isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'][1])) {
//                                    $bookingClass_return['multistopone'] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'];
//                                } else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd']); $pp++) {
//                                        $bookingClass_return['multistopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'][$pp];
//                                    }
//                                }
//                            } 
//                            else 
//                            {
//                                if (!isset($flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'][1])) {
//                                    $bookingClass_return['multistopone'] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'];
//                                } else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd']); $pp++) {
//                                        $bookingClass_return['multistopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$pp];
//                                    }
//                                }
//                            }
                        } 
                        else 
                        {
                            $bookClassArr=explode('<br>',$flightDetails1['BookingClass']);
                            for ($b = 0; $b < (count($bookClassArr)); $b++) 
                            {
                                  $bookingClass_return['multistopmulti'][$b] = $bookClassArr[$b];
//                                if (isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1])) {
//                                    if (!isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1]['rbd'][1])) {
//                                        $bookingClass_return['multistopmulti'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1]['rbd'];
//                                    } else {
//                                        for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1]['rbd']); $pp++) {
//                                            $bookingClass_return['multistopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails'][1]['rbd'][$pp];
//                                        }
//                                    }
//                                } else {
//                                    if (!isset($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'][1])) {
//                                        $bookingClass_return['multistopmulti'][$b] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'];
//                                    } else {
//                                        for ($pp = 0; $pp < count($flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd']); $pp++) {
//                                            $bookingClass_return['multistopmulti'][$pp] = $flightDetails1['Recomm']['paxFareProduct'][$b]['fareDetails']['rbd'][$pp];
//                                        }
//                                    }
//                                }
                            }
                        }
                    } 
                    else 
                    {
                        if (!strpos($flightDetails1['BookingClass'],'<br>')) 
                        {
                            $bookingClass_return['multistopone'] = $flightDetails1['BookingClass'];
//                            if (isset($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails'][1])) 
//                            {
//                                if (!isset($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'][1])) {
//                                    $bookingClass_return['multistopone'] = $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'];
//                                } else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd']); $pp++) {
//                                        $bookingClass_return['multistopmulti'][$pp] = $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'][$pp];
//                                    }
//                                }
//                            } 
//                            else 
//                            {
//                                if (!isset($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][1])) {
//                                    $bookingClass_return['multistopone'] = $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'];
//                                } else {
//                                    for ($pp = 0; $pp < count($flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd']); $pp++) {
//                                        $bookingClass_return['multistopmulti'][$pp] = $flightDetails1['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][$pp];
//                                    }
//                                }
//                            }
                        } 
                        else 
                        {
                            $bookClassArr=explode('<br>',$flightDetails1['BookingClass']);
                            for ($b = 0; $b < (count($bookClassArr)); $b++) 
                            {
                                $bookingClass_return['multistopmulti'][$b] = $bookClassArr[$b];
//                                if (isset($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1])) 
//                                {
//                                    if (!isset($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1]['rbd'][1])) {
//                                        $bookingClass_return['multistopmulti'][$b] = $flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1]['rbd'];
//                                    } else {
//                                        for ($pp = 0; $pp < count($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1]['rbd']); $pp++) {
//                                            $bookingClass_return['multistopmulti'][$pp] = $flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails'][1]['rbd'][$pp];
//                                        }
//                                    }
//                                } 
//                                else 
//                                {
//                                    if (!isset($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails']['rbd'][1])) {
//                                        $bookingClass_return['multistopmulti'][$b] = $flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails']['rbd'];
//                                    } else {
//                                        for ($pp = 0; $pp < count($flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails']['rbd']); $pp++) {
//                                            $bookingClass_return['multistopmulti'][$pp] = $flightDetails1['Recomm'][1]['paxFareProduct'][$b]['fareDetails']['rbd'][$pp];
//                                        }
//                                    }
//                                }
                            }
                        }
                    }
                    $dateOfDepartureRarray=explode('<br>',$flightDetails2['dateOfDeparture']);
                    $cin_return[$o] = $dateOfDepartureRarray[$o];
                }
            }
        }
        else if (($_SESSION[$rand_id]['journey_type'] == "MultiCity")) 
        {
            $count_flightDetails = (count($flightDetails));
            for ($fi = 0; $fi < $count_flightDetails; $fi++) {
                if ((count($flightDetails[$fi]['alocation'])) <= 1) {
                    $fromcity[$fi] = $flightDetails[$fi]['dlocation'];
                    $tocity[$fi] = $flightDetails[$fi]['alocation'];
                    $origin[$fi] = $flightDetails[$fi]['dlocation'];
                    $destination[$fi] = $flightDetails[$fi]['alocation'];
                    $fnumber[$fi] = $flightDetails[$fi]['fnumber'];
                    $airline_code[$fi] = $flightDetails[$fi]['cicode'];

                    if (!isset($flightDetails1[$fi]['paxFareProduct'][0])) {
                        $bookingClass[$fi]['onestopone'] = $flightDetails1[$fi]['paxFareProduct']['rbd'];
                    } else {
                        $count = (count($flightDetails1[$fi]['paxFareProduct']));
                        for ($pr = 0; $pr < $count; $pr++) {
                            $bookingClass[$fi]['onestopmulti'][$pr] = $flightDetails1[$fi]['paxFareProduct'][$pr]['rbd'];
                        }
                    }
                    $cin[$fi] = $flightDetails1[$fi]['dateOfDeparture'];
                } else {
                    $id_to[$fi] = ((count($flightDetails[$fi]['alocation'])) - 1);
                    for ($o = 0; $o < (count($flightDetails[$fi]['alocation'])); $o++) {
                        $fromcity[$fi] = $flightDetails[$fi]['dlocation'][0];
                        $tocity[$fi] = $flightDetails[$fi]['alocation'][$id_to[$fi]];
                        $origin[$fi][$o] = $flightDetails[$fi]['dlocation'][$o];
                        $destination[$fi][$o] = $flightDetails[$fi]['alocation'][$o];
                        $fnumber[$fi][$o] = $flightDetails[$fi]['fnumber'][$o];
                        $airline_code[$fi][$o] = $flightDetails[$fi]['cicode'][$o];
                        $cin[$fi][$o] = $flightDetails1[$fi]['dateOfDeparture'][$o];
                    }

                    if (!isset($flightDetails1[$fi]['paxFareProduct'][0])) {
                        $bookingClass[$fi]['multistopone'] = $flightDetails1[$fi]['paxFareProduct']['rbd'];
                    } else {
                        $count = (count($flightDetails1[$fi]['paxFareProduct']));
                        for ($pr = 0; $pr < $count; $pr++) {
                            $bookingClass[$fi]['multistopmulti'][$pr] = $flightDetails1[$fi]['paxFareProduct'][$pr]['rbd'];
                        }
                    }
                }
            }
        }
        else if ($_SESSION[$rand_id]['journey_type'] == "OneWay") 
        {
            $alocCheck=strpos($res['alocation'],'<br>');
            if (!strpos($res['alocation'],'<br>')) 
            {
                $fromcity = $flightDetails['dlocation'];
                $tocity = $flightDetails['alocation'];
                $origin = $flightDetails['dlocation'];
                $destination = $flightDetails['alocation'];
                $fnumber = $flightDetails['fnumber'];
                //echo 'hello';die;
                //echo '<pre />';print_r($flightDetails);die;
                //echo '<pre />';print_r($flightDetails1['paxFareProduct']);die;
                $airline_code = $flightDetails['cicode'];
                if (!strpos($res['BookingClass'],'<br>')) 
                {
                    $bookingClass['onestopone'] = $res['BookingClass'];
                } 
                else 
                {
                    $bookingclassArray=explode('<br>',$res['BookingClass']);
                    $count = count($bookingclassArray);
                    for ($pr = 0; $pr < $count; $pr++) {
                        $bookingClass['onestopmulti'][$pr] = $bookingclassArray[$pr];
                    }
                }
                
                
                $cin = $flightDetails['dateOfDeparture'];
            } 
            else 
            {
                $alocationArray=explode('<br>',$flightDetails['alocation']);
                $dlocationArray=explode('<br>',$flightDetails['dlocation']);
                $fnumberArray=explode('<br>',$flightDetails['fnumber']);
                $cicodeArray=explode('<br>',$flightDetails['cicode']);
                $dateOfDepartureArray=explode('<br>',$flightDetails['dateOfDeparture']);
                $id_to = ((count($alocationArray)) - 1);
                for ($o = 0; $o < (count($alocationArray)); $o++) 
                {
                    $fromcity = $dlocationArray[0];
                    $tocity = $alocationArray[$id_to];
                    $origin[$o] = $dlocationArray[$o];
                    $destination[$o] = $alocationArray[$o];
                    $fnumber[$o] = $fnumberArray[$o];
                    $airline_code[$o] = $cicodeArray[$o];
                    $cin[$o] = $dateOfDepartureArray[$o];
                }
				
				//echo '<pre />';print_r($flightDetails1['paxFareProduct']);die;
                if (!strpos($res['BookingClass'],'<br>')) 
                {
                        $bookingClass['multistopone'] = $res['BookingClass'];
                } 
                else 
                {
                    $bookingclassArray=explode('<br>',$res['BookingClass']);
                    $count = (count($bookingclassArray));
                    for ($pr = 0; $pr < $count; $pr++) 
                    {
                            $bookingClass['multistopmulti'][$pr] = $bookingclassArray[$pr];
                    }
                }
            }
        }
        //print_r($bookingClass['onestopone']);die;
        
        // echo '<pre/>';print_r($origin);print_r($destination);exit;
       //  echo $cin_return;echo $cin_oneway;
       //  echo '<pre/>bookingClass:';print_r($bookingClass_oneway);echo ' ';print_r($airline_code);echo ' ';print_r($fnumber);echo ' ';print_r($origin);echo ' ';print_r($destination);exit;
        // echo '<pre/>bookingClass_oneway:';print_r($bookingClass_oneway);echo "<br/>bookingClass_return:";print_r($bookingClass_return);
        if ($res['journey_type'] == "Round_oneway") 
        {
            $segmentInformation = '';
            $segmentInformation1 = '';
            // echo '<pre/>bookingClass_oneway';print_r($bookingClass_oneway);echo "bookingClass_return<br/>";print_r($bookingClass_return);
            if ((count($origin_oneway)) <= 1) {
                if (isset($bookingClass_oneway['onestopone']))
                    $bookingClass_oneway_final = $bookingClass_oneway['onestopone'];

                else if (isset($bookingClass_oneway['onestopmulti']))
                    $bookingClass_oneway_final = $bookingClass_oneway['onestopmulti'][0];


                $segmentInformation = '<segmentInformation>
									<travelProductInformation>
										<flightDate>
											<departureDate>' . $cin_oneway . '</departureDate>
										</flightDate>
										<boardPointDetails>
											<trueLocationId>' . $origin_oneway . '</trueLocationId>
										</boardPointDetails>
										<offpointDetails>
											<trueLocationId>' . $destination_oneway . '</trueLocationId>
										</offpointDetails>
										<companyDetails>
											<marketingCompany>' . $airline_code_oneway . '</marketingCompany>
										</companyDetails>
										<flightIdentification>
											<flightNumber>' . $fnumber_oneway . '</flightNumber>
											<bookingClass>' . $bookingClass_oneway_final . '</bookingClass>
										</flightIdentification>
									</travelProductInformation>
									<relatedproductInformation>
										<quantity>' . $quantity . '</quantity>
										<statusCode>NN</statusCode>
									</relatedproductInformation>
								</segmentInformation>';

                if ((count($destination_return)) <= 1) {
                    if (isset($bookingClass_return['onestopone']))
                        $bookingClass_return_final = $bookingClass_return['onestopone'];
                    else if (isset($bookingClass_return['onestopmulti']))
                        $bookingClass_return_final = $bookingClass_return['onestopmulti'][0];

                    $segmentInformation1 = '<segmentInformation>
										<travelProductInformation>
											<flightDate>
												<departureDate>' . $cin_return . '</departureDate>
											</flightDate>
											<boardPointDetails>
												<trueLocationId>' . $origin_return . '</trueLocationId>
											</boardPointDetails>
											<offpointDetails>
												<trueLocationId>' . $destination_return . '</trueLocationId>
											</offpointDetails>
											<companyDetails>
												<marketingCompany>' . $airline_code_return . '</marketingCompany>
											</companyDetails>
											<flightIdentification>
												<flightNumber>' . $fnumber_return . '</flightNumber>
												<bookingClass>' . $bookingClass_return_final . '</bookingClass>
											</flightIdentification>
										</travelProductInformation>
										<relatedproductInformation>
											<quantity>' . $quantity . '</quantity>
											<statusCode>NN</statusCode>
										</relatedproductInformation>
									</segmentInformation>';
                }
                else {
                    for ($e = 0; $e < (count($destination_return)); $e++) {

                        if (isset($bookingClass_return['multistopone']))
                            $bookingClass_return_final[$e] = $bookingClass_return['multistopone'][$e];

                        else if (isset($bookingClass_return['multistopmulti']))
                            $bookingClass_return_final[$e] = $bookingClass_return['multistopmulti'][$e];

                        if (empty($bookingClass_return_final[$e]))
                            $bookingClass_return_final[$e] = $bookingClass_return['multistopmulti'][0];

                        $segmentInformation1.='<segmentInformation>
											<travelProductInformation>
												<flightDate>
													<departureDate>' . $cin_return[$e] . '</departureDate>
												</flightDate>
												<boardPointDetails>
													<trueLocationId>' . $origin_return[$e] . '</trueLocationId>
												</boardPointDetails>
												<offpointDetails>
													<trueLocationId>' . $destination_return[$e] . '</trueLocationId>
												</offpointDetails>
												<companyDetails>
													<marketingCompany>' . $airline_code_return[$e] . '</marketingCompany>
												</companyDetails>
												<flightIdentification>
													<flightNumber>' . $fnumber_return[$e] . '</flightNumber>
													<bookingClass>' . $bookingClass_return_final[$e] . '</bookingClass>
												</flightIdentification>
											</travelProductInformation>
											<relatedproductInformation>
												<quantity>' . $quantity . '</quantity>
												<statusCode>NN</statusCode>
											</relatedproductInformation>
										</segmentInformation>';
                    }
                }
            }
            else 
            {

                for ($e = 0; $e < (count($origin_oneway)); $e++) 
                {
                    if (isset($bookingClass_oneway['multistopone']))
                        $bookingClass_oneway_final[$e] = $bookingClass_oneway['multistopone'][$e];

                    if (isset($bookingClass_oneway['multistopmulti']))
                        $bookingClass_oneway_final[$e] = $bookingClass_oneway['multistopmulti'][$e];

                    if (empty($bookingClass_oneway_final[$e]))
                        $bookingClass_oneway_final[$e] = $bookingClass_oneway['multistopmulti'][0];

                    $segmentInformation.='<segmentInformation>
                                                    <travelProductInformation>
                                                            <flightDate>
                                                                    <departureDate>' . $cin_oneway[$e] . '</departureDate>
                                                            </flightDate>
                                                            <boardPointDetails>
                                                                    <trueLocationId>' . $origin_oneway[$e] . '</trueLocationId>
                                                            </boardPointDetails>
                                                            <offpointDetails>
                                                                    <trueLocationId>' . $destination_oneway[$e] . '</trueLocationId>
                                                            </offpointDetails>
                                                            <companyDetails>
                                                                    <marketingCompany>' . $airline_code_oneway[$e] . '</marketingCompany>
                                                            </companyDetails>
                                                            <flightIdentification>
                                                                    <flightNumber>' . $fnumber_oneway[$e] . '</flightNumber>
                                                                    <bookingClass>' . $bookingClass_oneway_final[$e] . '</bookingClass>
                                                            </flightIdentification>
                                                    </travelProductInformation>
                                                    <relatedproductInformation>
                                                            <quantity>' . $quantity . '</quantity>
                                                            <statusCode>NN</statusCode>
                                                    </relatedproductInformation>
                                            </segmentInformation>';
                }
                if ((count($destination_return)) <= 1) 
                {

                    if (isset($bookingClass_return['onestopone']))
                        $bookingClass_return_final = $bookingClass_return['onestopone'];

                    else if (isset($bookingClass_return['onestopmulti']))
                        $bookingClass_return_final = $bookingClass_return['onestopmulti'][0];

                    $segmentInformation1.='<segmentInformation>
										<travelProductInformation>
											<flightDate>
												<departureDate>' . $cin_return . '</departureDate>
											</flightDate>
											<boardPointDetails>
												<trueLocationId>' . $origin_return . '</trueLocationId>
											</boardPointDetails>
											<offpointDetails>
												<trueLocationId>' . $destination_return . '</trueLocationId>
											</offpointDetails>
											<companyDetails>
												<marketingCompany>' . $airline_code_return . '</marketingCompany>
											</companyDetails>
											<flightIdentification>
												<flightNumber>' . $fnumber_return . '</flightNumber>
												<bookingClass>' . $bookingClass_return_final . '</bookingClass>
											</flightIdentification>
											<flightTypeDetails>
												<flightIndicator>S1</flightIndicator>
											</flightTypeDetails>
										</travelProductInformation>
										<relatedproductInformation>
											<quantity>' . $quantity . '</quantity>
											<statusCode>NN</statusCode>
										</relatedproductInformation>
									</segmentInformation>';
                }
                else 
                {

                    for ($e = 0; $e < (count($destination_return)); $e++) 
                    {

                        if (isset($bookingClass_return['multistopone']))
                            $bookingClass_return_final[$e] = $bookingClass_return['multistopone'][$e];

                        if (isset($bookingClass_return['multistopmulti']))
                            $bookingClass_return_final[$e] = $bookingClass_return['multistopmulti'][$e];

                        if (empty($bookingClass_return_final[$e]))
                            $bookingClass_return_final[$e] = $bookingClass_return['multistopmulti'][0];


                        $segmentInformation1.='<segmentInformation>
                                <travelProductInformation>
                                        <flightDate>
                                                <departureDate>' . $cin_return[$e] . '</departureDate>
                                        </flightDate>
                                        <boardPointDetails>
                                                <trueLocationId>' . $origin_return[$e] . '</trueLocationId>
                                        </boardPointDetails>
                                        <offpointDetails>
                                                <trueLocationId>' . $destination_return[$e] . '</trueLocationId>
                                        </offpointDetails>
                                        <companyDetails>
                                                <marketingCompany>' . $airline_code_return[$e] . '</marketingCompany>
                                        </companyDetails>
                                        <flightIdentification>
                                                <flightNumber>' . $fnumber_return[$e] . '</flightNumber>
                                                <bookingClass>' . $bookingClass_return_final[$e] . '</bookingClass>
                                        </flightIdentification>
                                </travelProductInformation>
                                <relatedproductInformation>
                                        <quantity>' . $quantity . '</quantity>
                                        <statusCode>NN</statusCode>
                                </relatedproductInformation>
                        </segmentInformation>';
                    }
                }
            }
        }
        if (($_SESSION[$rand_id]['journey_type'] == "MultiCity")) 
        {

            $segmentInformation = '';
            $count_origin = (count($origin));
            for ($fi = 0; $fi < $count_origin; $fi++) {
                if ((count($origin[$fi])) <= 1) {
                    if (isset($bookingClass[$fi]['onestopone']))
                        $bookingClass[$fi] = $bookingClass[$fi]['onestopone'];
                    else if (isset($bookingClass[$fi]['onestopmulti']))
                        $bookingClass[$fi] = $bookingClass[$fi]['onestopmulti'][0];

                    //echo '<pre/>';print_r($availabilityCnxType);exit;
                    $flightIndicator_details[$fi] = '';
                    if (isset($flightDetails1[$fi]['availabilityCnxType'])) {
                        if ($flightDetails1[$fi]['availabilityCnxType'] != '') {
                            if (!isset($flightDetails1[$fi]['availabilityCnxType'][0])) {
                                $flightIndicator_details[$fi] = '<flightTypeDetails>
												  <flightIndicator>' . $flightDetails1[$fi]['availabilityCnxType'] . '</flightIndicator>
												</flightTypeDetails>';
                                $flag_fi[$fi] = 'NO';
                            } else {
                                $count_flightIndicator = (count($flightDetails1[$fi]['availabilityCnxType']));
                                for ($ki = 0; $ki < $count_flightIndicator; $ki++) {
                                    $flightIndicator_details[$fi] = '<flightTypeDetails>
															  <flightIndicator>' . $flightDetails1['availabilityCnxType'][$ki] . '</flightIndicator>
															</flightTypeDetails>';
                                }
                                $flag_fi[$fi] = 'NO';
                            }
                        } else {
                            $flag_fi[$fi] = 'Yes';
                        }
                    } else {
                        $flag_fi[$fi] = 'Yes';
                    }


                    $segmentInformation[$fi] = '<segmentInformation>
										<travelProductInformation>
											<flightDate>
												<departureDate>' . $cin[$fi] . '</departureDate>
											</flightDate>
											<boardPointDetails>
												<trueLocationId>' . $origin[$fi] . '</trueLocationId>
											</boardPointDetails>
											<offpointDetails>
												<trueLocationId>' . $destination[$fi] . '</trueLocationId>
											</offpointDetails>
											<companyDetails>
												<marketingCompany>' . $airline_code[$fi] . '</marketingCompany>
											</companyDetails>
											<flightIdentification>
												<flightNumber>' . $fnumber[$fi] . '</flightNumber>
												<bookingClass>' . $bookingClass[$fi] . '</bookingClass>
											</flightIdentification>
										</travelProductInformation>
										<relatedproductInformation>
											<quantity>' . $quantity . '</quantity>
											<statusCode>NN</statusCode>
										</relatedproductInformation>
									</segmentInformation>';
                } else {
                    if (isset($bookingClass[$fi]['multistopone']))
                        $bookingClass[$fi] = $bookingClass[$fi]['multistopone'];
                    else if (isset($bookingClass[$fi]['multistopmulti']))
                        $bookingClass[$fi] = $bookingClass[$fi]['multistopmulti'][0];

                    //echo '<pre/>';print_r($flightDetails1['availabilityCnxType']);exit;

                    $flightIndicator_details[$fi] = '';
                    if (isset($flightDetails1[$fi]['availabilityCnxType'])) {
                        if ($flightDetails1[$fi]['availabilityCnxType'] != '') {
                            if (!isset($flightDetails1[$fi]['availabilityCnxType'][0])) {
                                $flightIndicator_details[$fi][0] = '<flightTypeDetails>
													  <flightIndicator>' . $flightDetails1[$fi]['availabilityCnxType'] . '</flightIndicator>
													</flightTypeDetails>';
                                $flag_fi[$fi] = 'NO';
                            } else {
                                $count_flightIndicator[$fi] = (count($flightDetails1[$fi]['availabilityCnxType']));
                                for ($ki = 0; $ki < $count_flightIndicator; $ki++) {
                                    $flightIndicator_details[$fi][$ki] = '<flightTypeDetails>
																  <flightIndicator>' . $flightDetails1[$fi]['availabilityCnxType'][$ki] . '</flightIndicator>
																</flightTypeDetails>';
                                }
                                $flag_fi[$fi] = 'NO';
                            }
                        } else {
                            $flag_fi[$fi] = 'Yes';
                        }
                    } else {
                        $flag_fi = 'Yes';
                    }
                    //echo '<pre/>';print_r($flightIndicator_details);	exit;
                    for ($e = 0; $e < (count($origin[$fi])); $e++) {
                        $segmentInformation[$fi] = '';
                    }

                    for ($e = 0; $e < (count($origin[$fi])); $e++) {
                        //if($flag_fi[$fi]=="Yes")
                        //$flightIndicator_details[$fi][$e]='';

                        $segmentInformation[$fi].='<segmentInformation>
											<travelProductInformation>
												<flightDate>
													<departureDate>' . $cin[$fi][$e] . '</departureDate>
												</flightDate>
												<boardPointDetails>
													<trueLocationId>' . $origin[$fi][$e] . '</trueLocationId>
												</boardPointDetails>
												<offpointDetails>
													<trueLocationId>' . $destination[$fi][$e] . '</trueLocationId>
												</offpointDetails>
												<companyDetails>
													<marketingCompany>' . $airline_code[$fi][$e] . '</marketingCompany>
												</companyDetails>
												<flightIdentification>
													<flightNumber>' . $fnumber[$fi][$e] . '</flightNumber>
													<bookingClass>' . $bookingClass[$fi][$e] . '</bookingClass>
												</flightIdentification>
											</travelProductInformation>
											<relatedproductInformation>
												<quantity>' . $quantity . '</quantity>
												<statusCode>NN</statusCode>
											</relatedproductInformation>
										</segmentInformation>';
                    }
                }
            }
        }
        else if ($_SESSION[$rand_id]['journey_type'] == "OneWay") 
        {
            $segmentInformation = '';
            if ((count($origin)) <= 1) 
            {
                if (isset($bookingClass['onestopone']))
                    $bookingClass = $bookingClass['onestopone'];
                else if (isset($bookingClass['onestopmulti']))
                    $bookingClass = $bookingClass['onestopmulti'][0];

                //echo '<pre/>';print_r($availabilityCnxType);exit;

                $flightIndicator_details = '';
                if (isset($flightDetails['availabilityCnxType'])) 
                {
                    if ($flightDetails['availabilityCnxType'] != '') 
                    {
                        if (!isset($flightDetails['availabilityCnxType'][0])) 
                        {
                            $flightIndicator_details = '<flightTypeDetails>
                                                        <flightIndicator>' . $flightDetails1['availabilityCnxType'] . '</flightIndicator>
                                                      </flightTypeDetails>';
                            $flag_fi = 'NO';
                        } 
                        else 
                        {
                            $count_flightIndicator = (count($flightDetails1['availabilityCnxType']));
                            for ($ki = 0; $ki < $count_flightIndicator; $ki++) 
                            {
                                $flightIndicator_details = '<flightTypeDetails>
															  <flightIndicator>' . $flightDetails1['availabilityCnxType'][$ki] . '</flightIndicator>
															</flightTypeDetails>';
                            }
                            $flag_fi = 'NO';
                        }
                    } 
                    else 
                    {
                        $flag_fi = 'Yes';
                    }
                } 
                else 
                {
                    $flag_fi = 'Yes';
                }


                $segmentInformation = '<segmentInformation>
                                            <travelProductInformation>
                                                    <flightDate>
                                                            <departureDate>' . $cin . '</departureDate>
                                                    </flightDate>
                                                    <boardPointDetails>
                                                            <trueLocationId>' . $origin . '</trueLocationId>
                                                    </boardPointDetails>
                                                    <offpointDetails>
                                                            <trueLocationId>' . $destination . '</trueLocationId>
                                                    </offpointDetails>
                                                    <companyDetails>
                                                            <marketingCompany>' . $airline_code . '</marketingCompany>
                                                    </companyDetails>
                                                    <flightIdentification>
                                                            <flightNumber>' . $fnumber . '</flightNumber>
                                                            <bookingClass>' . $bookingClass . '</bookingClass>
                                                    </flightIdentification>
                                                    ' . $flightIndicator_details . '
                                            </travelProductInformation>
                                            <relatedproductInformation>
                                                    <quantity>' . $quantity . '</quantity>
                                                    <statusCode>NN</statusCode>
                                            </relatedproductInformation>
                                    </segmentInformation>';
            } 
            else 
            {
                if (isset($bookingClass['multistopone']))
                    $bookingClass = $bookingClass['multistopone'];
                else if (isset($bookingClass['multistopmulti']))
                    $bookingClass = $bookingClass['multistopmulti'][0];

                //echo '<pre/>';print_r($flightDetails1['availabilityCnxType']);exit;

                $flightIndicator_details = '';
                if (isset($flightDetails['availabilityCnxType'])) 
                {
                    if ($flightDetails['availabilityCnxType'] != '') {
                        if (!isset($flightDetails['availabilityCnxType'][0])) {
                            $flightIndicator_details[0] = '<flightTypeDetails>
												  <flightIndicator>' . $flightDetails['availabilityCnxType'] . '</flightIndicator>
												</flightTypeDetails>';
                            $flag_fi = 'NO';
                        } else {
                            $count_flightIndicator = (count($flightDetails['availabilityCnxType']));
                            for ($ki = 0; $ki < $count_flightIndicator; $ki++) {
                                $flightIndicator_details[$ki] = '<flightTypeDetails>
															  <flightIndicator>' . $flightDetails['availabilityCnxType'][$ki] . '</flightIndicator>
															</flightTypeDetails>';
                            }
                            $flag_fi = 'NO';
                        }
                    } else {
                        $flag_fi = 'Yes';
                    }
                } else {
                    $flag_fi = 'Yes';
                }
                //echo '<pre/>';print_r($flightIndicator_details);	exit;

                for ($e = 0; $e < (count($origin)); $e++) 
                {
                    if ($flag_fi == "Yes")
                        $flightIndicator_details[$e] = '';

                    $segmentInformation.='<segmentInformation>
                                            <travelProductInformation>
                                                    <flightDate>
                                                            <departureDate>' . $cin[$e] . '</departureDate>
                                                    </flightDate>
                                                    <boardPointDetails>
                                                            <trueLocationId>' . $origin[$e] . '</trueLocationId>
                                                    </boardPointDetails>
                                                    <offpointDetails>
                                                            <trueLocationId>' . $destination[$e] . '</trueLocationId>
                                                    </offpointDetails>
                                                    <companyDetails>
                                                            <marketingCompany>' . $airline_code[$e] . '</marketingCompany>
                                                    </companyDetails>
                                                    <flightIdentification>
                                                            <flightNumber>' . $fnumber[$e] . '</flightNumber>
                                                            <bookingClass>' . $bookingClass . '</bookingClass>
                                                    </flightIdentification>
                                                    ' . $flightIndicator_details[$e] . '
                                            </travelProductInformation>
                                            <relatedproductInformation>
                                                    <quantity>' . $quantity . '</quantity>
                                                    <statusCode>NN</statusCode>
                                            </relatedproductInformation>
                                    </segmentInformation>';
                }
            }
        }
//exit;die;
        // echo "segmentInformation: <br/>";print_r($segmentInformation);die;
        // echo "segmentInformation: <br/>".$segmentInformation1;exit;
        $SequenceNumber = $SequenceNumber + 1;
        if ($res['journey_type'] == "Round_oneway")
        {
            $SellFromRecommendation = '<?xml version="1.0" encoding="utf-8"?>
                                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                             <soapenv:Header>
                                                    <SessionId>' . $SessionId . '</SessionId>
                                                    <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                              </soapenv:Header>
                                              <soapenv:Body>
                                                    <Air_SellFromRecommendation xmlns="http://xml.amadeus.com/ITAREQ_05_2_IA">
                                                            <messageActionDetails>
                                                                    <messageFunctionDetails>
                                                                            <messageFunction>183</messageFunction>
                                                                            <additionalMessageFunction>M1</additionalMessageFunction>
                                                                    </messageFunctionDetails>
                                                            </messageActionDetails>
                                                            <itineraryDetails>
                                                                    <originDestinationDetails>
                                                                            <origin>' . $fromcity_oneway . '</origin>
                                                                            <destination>' . $tocity_oneway . '</destination>
                                                                    </originDestinationDetails>
                                                                    <message>
                                                                            <messageFunctionDetails>
                                                                                    <messageFunction>183</messageFunction>
                                                                            </messageFunctionDetails>
                                                                    </message>
                                                               ' . $segmentInformation . '
                                                            </itineraryDetails>
                                                            <itineraryDetails>
                                                                    <originDestinationDetails>
                                                                            <origin>' . $fromcity_return . '</origin>
                                                                            <destination>' . $tocity_return . '</destination>
                                                                    </originDestinationDetails>
                                                                    <message>
                                                                            <messageFunctionDetails>
                                                                                    <messageFunction>183</messageFunction>
                                                                            </messageFunctionDetails>
                                                                    </message>
                                                               ' . $segmentInformation1 . '
                                                            </itineraryDetails>
                                                    </Air_SellFromRecommendation>
                                              </soapenv:Body>
                                            </soapenv:Envelope>';
        }
        if (($_SESSION[$rand_id]['journey_type'] == "MultiCity")) 
        {

            // echo '<pre/>';print_r($origin);print_r($destination);
            if (isset($origin[0][0]))
                $origin_final = $origin[0][0];
            else if (isset($origin[0]))
                $origin_final = $origin[0];
            else
                $origin_final = $origin;


            if (isset($destination[0][0])) {
                $count_destination = (count($destination[0]));
                $destination_final = $destination[0][($count_destination - 1)];
            } else if (isset($destination[0]))
                $destination_final = $destination[0];
            else
                $destination_final = $destination;

            $fromcity = $_SESSION[$rand_id]['fromcityval'];
            $tocity = $_SESSION[$rand_id]['tocityval'];
            $arrival_multi = $_SESSION[$rand_id]['sd'];

            $fcityname = explode(",", $fromcity);
            $fcount_city_code = (count($fcityname));
            $from_city_code = $fcityname[($fcount_city_code - 1)];

            $tcityname = explode(",", $tocity);
            $tcount_city_code = (count($tcityname));
            $to_city_code = $tcityname[($tcount_city_code - 1)];


            $final_segmentInformation = '';
            $final_segmentInformation = '<itineraryDetails>
									<originDestinationDetails>
										<origin>' . $from_city_code . '</origin>
										<destination>' . $to_city_code . '</destination>
									</originDestinationDetails>
									<message>
										<messageFunctionDetails>
											<messageFunction>183</messageFunction>
										</messageFunctionDetails>
									</message>
								   ' . $segmentInformation[0] . '
								</itineraryDetails>';

            $date_multi = $_SESSION[$rand_id]['multi_city_datelist'];
            $departure_multi = $_SESSION[$rand_id]['multi_city_dlist'];
            $arrival_multi = $_SESSION[$rand_id]['multi_city_alist'];

            if ((!empty($_SESSION[$rand_id]['multi_city_dlist'])) && (!empty($_SESSION[$rand_id]['multi_city_alist']))) {

                for ($i = 0; $i < (count($departure_multi)); $i++) {

                    $departure_multi_val = explode(",", $departure_multi[$i]);
                    $departure_multi_val_count = (count($departure_multi_val));
                    $multi_city_de_code = $departure_multi_val[($departure_multi_val_count - 1)];

                    $arrival_multi_val = explode(",", $arrival_multi[$i]);
                    $arrival_multi_val_count = (count($arrival_multi_val));
                    $multi_city_ar_code = $arrival_multi_val[($arrival_multi_val_count - 1)];

                    $final_segmentInformation.='<itineraryDetails>
												<originDestinationDetails>
													<origin>' . $multi_city_de_code . '</origin>
													<destination>' . $multi_city_ar_code . '</destination>
												</originDestinationDetails>
												<message>
													<messageFunctionDetails>
														<messageFunction>183</messageFunction>
													</messageFunctionDetails>
												</message>
											   ' . $segmentInformation[($i + 1)] . '
											</itineraryDetails>';
                }
            }


            $SellFromRecommendation = '<?xml version="1.0" encoding="utf-8"?>
                                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                             <soapenv:Header>
                                                       <Session>
                                                              <SessionId>' . $SessionId . '</SessionId>
                                                              <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                              <SecurityToken>' . $SecurityToken . '</SecurityToken>
                                                        </Session>
                                               </soapenv:Header>
                                              <soapenv:Body>
                                                        <Air_SellFromRecommendation xmlns="http://xml.amadeus.com/ITAREQ_05_2_IA">
                                                            <messageActionDetails>
                                                                <messageFunctionDetails>
                                                                    <messageFunction>183</messageFunction>
                                                                    <additionalMessageFunction>M1</additionalMessageFunction>
                                                                </messageFunctionDetails>
                                                            </messageActionDetails>
                                                            ' . $final_segmentInformation . '
                                                        </Air_SellFromRecommendation>
                                              </soapenv:Body>
                                            </soapenv:Envelope>';
        } 
        else if ($_SESSION[$rand_id]['journey_type'] == "OneWay") 
        {
            $SellFromRecommendation = '<?xml version="1.0" encoding="utf-8"?>
                                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                             <soapenv:Header>
                                                              <SessionId>' . $SessionId . '</SessionId>
                                                              <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                               </soapenv:Header>
                                              <soapenv:Body>
                                                        <Air_SellFromRecommendation xmlns="http://xml.amadeus.com/ITAREQ_05_2_IA">
                                                            <messageActionDetails>
                                                                <messageFunctionDetails>
                                                                    <messageFunction>183</messageFunction>
                                                                    <additionalMessageFunction>M1</additionalMessageFunction>
                                                                </messageFunctionDetails>
                                                            </messageActionDetails>
                                                            <itineraryDetails>
                                                                <originDestinationDetails>
                                                                    <origin>' . $fromcity . '</origin>
                                                                    <destination>' . $tocity . '</destination>
                                                                </originDestinationDetails>
                                                                <message>
                                                                    <messageFunctionDetails>
                                                                        <messageFunction>183</messageFunction>
                                                                    </messageFunctionDetails>
                                                                </message>
                                                               ' . $segmentInformation . '
                                                            </itineraryDetails>
                                                        </Air_SellFromRecommendation>
                                              </soapenv:Body>
                                            </soapenv:Envelope>';
        }
//print_r($_POST);die;
         //echo  "Air_SellFromRecommendation Request:<br/>".($SellFromRecommendation);//exit;
        //$URL2 = "https://test.webservices.amadeus.com";
         $URL2 = "https://production.webservices.amadeus.com";
        $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/ITAREQ_05_2_IA";

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $URL2);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $SellFromRecommendation);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

        $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");


        $dataSellFromRecommendation = curl_exec($ch2);
        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        curl_close($ch2);

        //echo "Air_SellFromRecommendationReply Response:<br/>"; print_r($dataSellFromRecommendation);//exit;
		
	//echo 'helllll';die;	
		
        if (!empty($dataSellFromRecommendation)) 
        {
            $segment_status = $this->xml2array($dataSellFromRecommendation);
             echo'<PRE/>Air_SellFromRecommendationReply Response:<br/>'; print_r($segment_status);//exit;
            if (isset($segment_status['soap:Envelope']['soap:Body']['Air_SellFromRecommendationReply']['itineraryDetails'])) {
                if (($_SESSION[$rand_id]['journey_type'] == "Round") || ($_SESSION[$rand_id]['journey_type'] == "Calendar") || ($_SESSION[$rand_id]['journey_type'] == "MultiCity")) {
                    $data['segment_result'] = $segment_status['soap:Envelope']['soap:Body']['Air_SellFromRecommendationReply']['itineraryDetails'];
                } else {
                    $data['segment_result'] = $segment_status['soap:Envelope']['soap:Body']['Air_SellFromRecommendationReply']['itineraryDetails']['segmentInformation'];
                }
            } else {
                $data['segment_result'] = "";
            }

            $status_msg = "";
            if (($res['journey_type'] == "Round_oneway") || ($_SESSION[$rand_id]['journey_type'] == "MultiCity")) 
            {
				
                if (!empty($data['segment_result'])) 
                {
                    if (!isset($data['segment_result'][0])) 
                    {
                        $status = $data['segment_result']['actionDetails']['statusCode'];
                        if ($status == "OK") {
                            $status_msg = "Sold";
                            $data['flightIndicator'] = $data['segment_result'][$s]['segmentInformation']['flightDetails']['flightTypeDetails']['flightIndicator'];
                            $data['equipment'] = $data['segment_result'][$s]['segmentInformation']['apdSegment']['legDetails']['equipment'];
                            $data['dterminal'] = $data['segment_result'][$s]['segmentInformation']['apdSegment']['departureStationInfo']['terminal'];
                            $data['aterminal'] = $data['segment_result'][$s]['segmentInformation']['apdSegment']['arrivalStationInfo']['terminal'];
                            $data['status_msg'] = $status_msg;
                        } else if ($status == "UNS") {
                            $status_msg = "Unable to sell";
                            $data['status_msg'] = $status_msg;
                        } else if ($status == "WL") {
                            $status_msg = "Wait listed";
                            $data['status_msg'] = $status_msg;
                        } else if ($status == "X") {
                            $status_msg = "Cancelled after a successful sell";
                            $data['status_msg'] = $status_msg;
                        } else if ($status == "RQ") {
                            $status_msg = "Sell was not even attempted";
                            $data['status_msg'] = $status_msg;
                        }
                    } 
                    else 
                    {
                        for ($si = 0; $si < (count($data['segment_result'])); $si++) {
                            if (!isset($data['segment_result'][$si]['segmentInformation'][0]))
                                $status[$si] = $data['segment_result'][$si]['segmentInformation']['actionDetails']['statusCode'];
                            else {
                                for ($s = 0; $s < (count($data['segment_result'][$si]['segmentInformation'])); $s++) {
                                    $status[$si][$s] = $data['segment_result'][$si]['segmentInformation'][$s]['actionDetails']['statusCode'];
                                }
                            }
                        }
                        //echo '<pre/>dasd';print_r($status);
                        for ($si = 0; $si < (count($data['segment_result'])); $si++) 
                        {
                            if ((count($status[$si])) <= 1) {
                                if ($status[$si] == "OK") {
                                    $status_msg[$si] = "Sold";
                                    $data['flightIndicator'][$si] = $data['segment_result'][$si]['segmentInformation']['flightDetails']['flightTypeDetails']['flightIndicator'];
                                    $data['equipment'][$si] = $data['segment_result'][$si]['segmentInformation']['apdSegment']['legDetails']['equipment'];
                                    //$data['dterminal'][$si]=$data['segment_result'][$si]['segmentInformation']['apdSegment']['departureStationInfo']['terminal'];
                                    //$data['aterminal'][$si]=$data['segment_result'][$si]['segmentInformation']['apdSegment']['arrivalStationInfo']['terminal'];
                                    $data['status_msg'][$si] = $status_msg[$si];
                                } else if ($status[$si] == "UNS") {
                                    $status_msg[$si] = "Unable to sell";
                                    $data['status_msg'][$si] = $status_msg[$si];
                                } else if ($status == "WL") {
                                    $status_msg[$si] = "Wait listed";
                                    $data['status_msg'][$si] = $status_msg[$si];
                                } else if ($status[$si] == "X") {
                                    $status_msg[$si] = "Cancelled after a successful sell";
                                    $data['status_msg'][$si] = $status_msg[$si];
                                } else if ($status[$si] == "RQ") {
                                    $status_msg[$i] = "Sell was not even attempted";
                                    $data['status_msg'][$si] = $status_msg[$si];
                                }
                            } 
                            else 
                            {
                                for ($d = 0; $d < (count($status[$si])); $d++) 
                                {
                                    if ($status[$si][$d] == "OK") {
                                        $status_msg[$si] = "Sold";
                                        $data['flightIndicator'][$si][$d] = $data['segment_result'][$si]['segmentInformation'][$d]['flightDetails']['flightTypeDetails']['flightIndicator'];
                                        $data['equipment'][$si][$d] = $data['segment_result'][$si]['segmentInformation'][$d]['apdSegment']['legDetails']['equipment'];
                                        if (isset($data['segment_result'][$si]['segmentInformation'][$d]['apdSegment']['departureStationInfo']))
                                            $data['dterminal'][$si][$d] = $data['segment_result'][$si]['segmentInformation'][$d]['apdSegment']['departureStationInfo']['terminal'];
                                        if (isset($data['segment_result'][$si]['segmentInformation'][$d]['apdSegment']['arrivalStationInfo']))
                                            $data['aterminal'][$si][$d] = $data['segment_result'][$si]['segmentInformation'][$d]['apdSegment']['arrivalStationInfo']['terminal'];
                                        $data['status_msg'][$si][$d] = $status_msg[$si];
                                    }
                                    else if ($status[$si][$d] == "UNS") {
                                        $status_msg[$si] = "Unable to sell";
                                        $data['status_msg'][$si][$d] = $status_msg[$si];
                                    } else if ($status[$si][$d] == "WL") {
                                        $status_msg[$si] = "Wait listed";
                                        $data['status_msg'][$si][$d] = $status_msg[$si];
                                    } else if ($status[$si][$d] == "X") {
                                        $status_msg[$si] = "Cancelled after a successful sell";
                                        $data['status_msg'][$si][$d] = $status_msg[$si];
                                    } else if ($status[$si][$d] == "RQ") {
                                        $status_msg[$si] = "Sell was not even attempted";
                                        $data['status_msg'][$si][$d] = $status_msg[$si];
                                    }
                                }
                            }
                        }
                    }
                }
                else 
                {
                    $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                    unset($_SESSION['amadeus'][$sess_id]);
                    $error_msg = "Air_SellFromRecommendation Response is Empty";
                    $this->error_page($error_msg);
                }
            } 
            else 
            {
				
                if (!empty($data['segment_result'])) 
                {
                    if (!isset($data['segment_result'][0]))
                        $status = $data['segment_result']['actionDetails']['statusCode'];
                    else 
                    {
                        for ($s = 0; $s < (count($data['segment_result'])); $s++) 
                        {
                            $status[$s] = $data['segment_result'][$s]['actionDetails']['statusCode'];
                        }
                    }

                    if ((count($status)) <= 1) 
                    {
						
                        if ($status == "OK") 
                        {
							//echo 'dfsdfdsdddd';die;
                            $status_msg = "Sold";
                            if(isset($data['segment_result']['flightDetails']['flightTypeDetails']['flightIndicator']))
							{
								$data['flightIndicator'] = $data['segment_result']['flightDetails']['flightTypeDetails']['flightIndicator'];
							}
							else
							{
								$data['flightIndicator'] = '';
							}
                            if(isset($data['segment_result']['apdSegment']['legDetails']['equipment']))
							{
								$data['equipment'] = $data['segment_result']['apdSegment']['legDetails']['equipment'];
							}
							else
							{
								$data['equipment'] = '';
							}
                            if(isset($data['segment_result']['apdSegment']['departureStationInfo']['terminal']))
							{
								$data['dterminal'] = $data['segment_result']['apdSegment']['departureStationInfo']['terminal'];
							}
							else
							{
								$data['dterminal'] = '';
							}
                            if(isset($data['segment_result']['apdSegment']['arrivalStationInfo']['terminal']))
							{
								$data['aterminal'] = $data['segment_result']['apdSegment']['arrivalStationInfo']['terminal'];
							}
							else
							{
								$data['aterminal'] = '';
							}
                            $data['status_msg'] = $status_msg;
                        } 
                        else if ($status == "UNS") 
                        {
                            $status_msg = "Unable to sell";
                            $data['status_msg'] = $status_msg;
                        } 
                        else if ($status == "WL") 
                        {
                            $status_msg = "Wait listed";
                            $data['status_msg'] = $status_msg;
                        } 
                        else if ($status == "X") 
                        {
                            $status_msg = "Cancelled after a successful sell";
                            $data['status_msg'] = $status_msg;
                        } 
                        else if ($status == "RQ") 
                        {
                            $status_msg = "Sell was not even attempted";
                            $data['status_msg'] = $status_msg;
                        }
                    } 
                    else 
                    {
                        for ($d = 0; $d < (count($status)); $d++) 
                        {
                            if ($status[$d] == "OK") 
                            {
                                $status_msg = "Sold";
                                $data['flightIndicator'][$d] = $data['segment_result'][$d]['flightDetails']['flightTypeDetails']['flightIndicator'];
                                $data['equipment'][$d] = $data['segment_result'][$d]['apdSegment']['legDetails']['equipment'];
                                if (isset($data['segment_result'][$d]['apdSegment']['departureStationInfo']))
                                    $data['dterminal'][$d] = $data['segment_result'][$d]['apdSegment']['departureStationInfo']['terminal'];
                                if (isset($data['segment_result'][$d]['apdSegment']['arrivalStationInfo']))
                                    $data['aterminal'][$d] = $data['segment_result'][$d]['apdSegment']['arrivalStationInfo']['terminal'];
                                $data['status_msg'][$d] = $status_msg;
                            }
                            else if ($status[$d] == "UNS") 
                            {
                                $status_msg = "Unable to sell";
                                $data['status_msg'][$d] = $status_msg;
                            } 
                            else if ($status[$d] == "WL") 
                            {
                                $status_msg = "Wait listed";
                                $data['status_msg'][$si][$d] = $status_msg;
                            } 
                            else if ($status[$d] == "X") 
                            {
                                $status_msg = "Cancelled after a successful sell";
                                $data['status_msg'][$d] = $status_msg;
                            } 
                            else if ($status[$d] == "RQ") 
                            {
                                $status_msg = "Sell was not even attempted";
                                $data['status_msg'][$d] = $status_msg;
                            }
                        }
                    }
                }
            }
            //echo'<pre/>Segment status_msg: ';print_r($data['status_msg']);exit;
            //$status_flag = "false";
            if (($res['journey_type'] == "Round_oneway") || ($_SESSION[$rand_id]['journey_type'] == "MultiCity")) 
            {
                if (!empty($data['status_msg'])) 
                {
                    if ((count($data['status_msg'][0])) <= 1) 
                    {
                        if ($data['status_msg'][0] == "Sold")
                            $status_flag = "true";
                        else
                            $status_flag = "false";
                    }
                    else
                    {
                        $st = 0;
                        for ($b = 0; $b < (count($data['status_msg'][0])); $b++) 
                        {
                            if ($data['status_msg'][0][$b] == "Sold") {
                                ++$st;
                                if ($st == (count($data['status_msg'][0])))
                                    $status_flag = "true";
                                else
                                    $status_flag = "false";
                            }
                            else {
                                $status_flag = "false";
                                break;
                            }
                        }
                    }
                    if ((count($data['status_msg'][1])) <= 1) {
                        if ($data['status_msg'][1] == "Sold")
                            $status_flag = "true";
                        else
                            $status_flag = "false";
                    }
                    else {
                        $st = 0;
                        for ($b = 0; $b < (count($data['status_msg'][1])); $b++) {
                            if ($data['status_msg'][1][$b] == "Sold") {
                                ++$st;
                                if ($st == (count($data['status_msg'][1])))
                                    $status_flag = "true";
                                else
                                    $status_flag = "false";
                            }
                            else {
                                $status_flag = "false";
                                break;
                            }
                        }
                    }
                }
            } 
            else 
            {
                if (!empty($data['status_msg'])) {
                    if ((count($data['status_msg'])) <= 1) {
                        if ($data['status_msg'] == "Sold") {
                            $status_flag = "true";
                        } else {
                            $status_flag = "false";
                        }
                    } else {
                        for ($b = 0; $b < (count($data['status_msg'])); $b++) {
                            if ($data['status_msg'][$b] == "Sold") {
                                $status_flag = "true";
                            } else {
                                $status_flag = "false";
                                break;
                            }
                        }
                    }
                }
            }
            
            if ($status_flag == "true") 
            {
		//echo 'sdfdsfsf';die;		
                $quantity = $_SESSION[$rand_id]['adults'] + $_SESSION[$rand_id]['childs'] + $_SESSION[$rand_id]['infants'];
                $adult = $_SESSION[$rand_id]['adults'];
                $child = $_SESSION[$rand_id]['childs'];
                $infant = $_SESSION[$rand_id]['infants'];
                $count = $adult + $infant;
                $travellerInf_ADT = "";
                $travellerInf_CH = "";
                $travellerInf_INF = "";
                $testing_sample = '';

                $travellerInformation_ADT = '';
                $ad = '';
                $i = 1;

                if (empty($infant)) {
                    for ($ad = 0; $ad < $adult; $ad++) {
                        $travellerInformation_ADT.='<passengerData>
                                                            <travellerInformation>
                                                                    <traveller>
                                                                            <surname>' . ($_POST['fnameadult'][$ad]) . '</surname>
                                                                            <quantity>1</quantity>
                                                                    </traveller>
                                                                    <passenger>
                                                                            <firstName>' . ($_POST['lnameadult'][$ad]) . '</firstName>
                                                                    </passenger>
                                                            </travellerInformation>
                                                    </passengerData>';

                        if (($ad + 1) != $adult || ($ad + 1) != ($adult + $child)) 
                        {
                            $travellerInformation_ADT.='</travellerInfo>
                                                            <travellerInfo>
                                                                  <elementManagementPassenger>
                                                                    <reference>
                                                                          <qualifier>PR</qualifier>
                                                                          <number>' . (++$i) . '</number>
                                                                    </reference>
                                                                    <segmentName>NM</segmentName>
                                                                  </elementManagementPassenger>';
}
                    }
                } 
                else 
                {

                    for ($ad = 0; $ad < $infant; $ad++) 
                    {
                        $result_dob_inf = str_replace("-", "", $_POST['adobinfant'][$ad]);
                        $travellerInformation_ADT.='<passengerData>
                                                        <travellerInformation>
                                                                <traveller>
                                                                        <surname>' . ($_POST['fnameadult'][$ad]) . '</surname>
                                                                        <quantity>2</quantity>
                                                                </traveller>
                                                                <passenger>
                                                                        <firstName>' . ($_POST['lnameadult'][$ad]) . '</firstName>
                                                                        <infantIndicator>3</infantIndicator>
                                                                </passenger>
                                                        </travellerInformation>
                                                </passengerData>
                                                <passengerData> 
                                                        <travellerInformation> 
                                                                <traveller> 
                                                                        <surname>' . ($_POST['fnameinfant'][$ad]) . '</surname> 
                                                                </traveller> 
                                                                <passenger>
                                                                        <firstName>' . ($_POST['lnameinfant'][$ad]) . '</firstName>
                                                                        <type>INF</type>
                                                                </passenger>
                                                        </travellerInformation> 
                                                        <dateOfBirth> 
                                                                <dateAndTimeDetails> 
                                                                        <qualifier>706</qualifier> 
                                                                        <date>' . $result_dob_inf . '</date> 
                                                                </dateAndTimeDetails> 
                                                        </dateOfBirth> 
                                                </passengerData> ';

                        $travellerInformation_ADT2 = ' <passengerData> 
                                                            <travellerInformation> 
                                                                    <traveller> 
                                                                            <surname>PROVAB</surname> 
                                                                            <quantity>2</quantity> 
                                                                    </traveller> 
                                                                    <passenger> 
                                                                            <firstName>SUNIL</firstName> 
                                                                            <infantIndicator>3</infantIndicator> 
                                                                    </passenger> 
                                                            </travellerInformation> 
                                                    </passengerData> 
                                                    <passengerData> 
                                                            <travellerInformation> 
                                                                    <traveller> 
                                                                            <surname>BROWN</surname> 
                                                                    </traveller> 
                                                                    <passenger> 
                                                                            <firstName>TEST</firstName> 
                                                                            <type>INF</type> 
                                                                    </passenger> 
                                                            </travellerInformation> 
                                                            <dateOfBirth> 
                                                                    <dateAndTimeDetails> 
                                                                            <qualifier>706</qualifier> 
                                                                            <date>12052012</date> 
                                                                    </dateAndTimeDetails> 
                                                            </dateOfBirth> 
                                                    </passengerData> 
                                            </travellerInfo> 
                                            <travellerInfo> 
                                                    <elementManagementPassenger> 
                                                            <reference> 
                                                                    <qualifier>PR</qualifier> 
                                                                    <number>2</number> 
                                                            </reference> 
                                                            <segmentName>NM</segmentName> 
                                                    </elementManagementPassenger> 
                                                    <passengerData> 
                                                            <travellerInformation> 
                                                                    <traveller> 
                                                                            <surname>PROVAB</surname> 
                                                                            <quantity>2</quantity> 
                                                                    </traveller> 
                                                                    <passenger> 
                                                                            <firstName>RUBY</firstName> 
                                                                            <infantIndicator>3</infantIndicator> 
                                                                    </passenger> 
                                                                                    <passenger> 
                                                                            <firstName>TESTIING</firstName> 
                                                                            <type>INF</type> 
                                                                    </passenger> 
                                                            </travellerInformation>               
                                                            <dateOfBirth> 
                                                                    <dateAndTimeDetails> 
                                                                            <qualifier>706</qualifier> 
                                                                            <date>12052012</date> 
                                                                    </dateAndTimeDetails> 
                                                            </dateOfBirth> 
                                                    </passengerData> ';


                        if ((($adult + $child) > ($ad + 1))) 
                        {
                            $travellerInformation_ADT.='</travellerInfo>
                                                            <travellerInfo>
                                                                  <elementManagementPassenger>
                                                                    <reference>
                                                                          <qualifier>PR</qualifier>
                                                                          <number>' . (++$i) . '</number>
                                                                    </reference>
                                                                    <segmentName>NM</segmentName>
                                                                  </elementManagementPassenger>';
                        }
                    }

                    if ($adult > $infant) 
                    {

                        for ($ad1 = $infant; $ad1 < $adult; $ad1++) 
                        {
                            $travellerInformation_ADT.='<passengerData>
                                                                <travellerInformation>
                                                                        <traveller>
                                                                                <surname>' . ($_POST['fnameadult'][$ad1]) . '</surname>
                                                                                <quantity>1</quantity>
                                                                        </traveller>
                                                                        <passenger>
                                                                                <firstName>' . ($_POST['lnameadult'][$ad1]) . '</firstName>
                                                                        </passenger>
                                                                </travellerInformation>
                                                        </passengerData>';

                            if ((($adult + $child) > ($ad1 + 1))) {
                                $travellerInformation_ADT.='</travellerInfo>
                                                                <travellerInfo>
                                                                      <elementManagementPassenger>
                                                                        <reference>
                                                                              <qualifier>PR</qualifier>
                                                                              <number>' . (++$i) . '</number>
                                                                        </reference>
                                                                        <segmentName>NM</segmentName>
                                                                      </elementManagementPassenger>';
                            }
                        }
                    }
                }

                $ad = $adult;
                $travellerInformation_CHD = '';
                $result_dob = '';
                if (!empty($child)) {
                    for ($ch = 0; $ch < $child; $ch++) {
                        $result_dob = str_replace("-", "", $_POST['adobchild'][$ch]);
                        $travellerInformation_CHD.='<passengerData>
                                                            <travellerInformation>
                                                                    <traveller>
                                                                            <surname>' . ($_POST['fnamechild'][$ch]) . '</surname>
                                                                            <quantity>1</quantity>
                                                                    </traveller>
                                                                    <passenger>
                                                                            <firstName>' . ($_POST['lnamechild'][$ch]) . '</firstName>
                                                                            <type>CHD</type>
                                                                    </passenger>
                                                            </travellerInformation>
                                                            <dateOfBirth>
                                                                    <dateAndTimeDetails>
                                                                      <qualifier>706</qualifier>
                                                                      <date>' . $result_dob . '</date>
                                                                    </dateAndTimeDetails>
                                                              </dateOfBirth>
                                                    </passengerData>';


                        if ((($adult + $child) > ($ad + $ch + 1))) 
                        {
                            $travellerInformation_CHD.='</travellerInfo>
                                                            <travellerInfo>
                                                                  <elementManagementPassenger>
                                                                    <reference>
                                                                          <qualifier>PR</qualifier>
                                                                          <number>' . (++$i) . '</number>
                                                                    </reference>
                                                                    <segmentName>NM</segmentName>
                                                                  </elementManagementPassenger>';
                        }
                    }
                }
                $SequenceNumber = $SequenceNumber + 1;
                $passengerData = $travellerInformation_ADT . $travellerInformation_CHD;

                $SSR_DOC = '';

                if (isset($_POST['user_country'])) 
                {
                    if (!empty($_POST['user_country'])) 
                    {
                        //$code = $this->Flights_Model->get_countyr_code($value['country']);
                        //$countyr_code_final = $code[0]->iso3;
                        $countyr_code_final = $_POST['user_country'];
                    }
                    else
                        $countyr_code_final = '';
                }
                else
                    $countyr_code_final = '';

                for ($i = 0; $i < count($_POST['saladult']); $i++) 
                {
                    if ($_POST['saladult'][$i] == "Mr")
                        $gender[$i] = "M";
                    else
                        $gender[$i] = "F";

                    if (isset($_POST['passportadult'])) 
                    {
                        if (!empty($_POST['passportadult'][$i]))
                            $passport_no[$i] = $_POST['passportadult'][$i];
                        else
                            $passport_no[$i] = '';
                    }
                    else $passport_no[$i] = '';
                    
                    if (isset($_POST['visaadult'])) 
                    {
                        if (!empty($_POST['visaadult'][$i])) {
                            $visa_no = $_POST['visaadult'][$i];
                        } else {
                            $visa_no = '';
                        }
                    }
                    else $visa_no = '';
                    
                    if (isset($_POST['Pcountry'])) 
                    {
                        if (!empty($_POST['Pcountry'][$i])) 
                        {
                            $code = $this->Flights_Model->get_countyr_code($_POST['Pcountry'][$i]);
                            $countyr_code[$i] = $code[0]->iso3;
                        } 
                        else 
                        {
                            $countyr_code[$i] = '';
                        }
                    } 
                    else 
                    {
                        $countyr_code_final = '';
                        $countyr_code[$i] = '';
                    }



                    if (isset($_POST['plname'])) 
                    {
                        if (!empty($_POST['plname'][$i])) {
                            $plname = $_POST['plname'][$i];
                        } else {
                            $plname = '';
                        }
                    }
                    else $plname = '';

                    if (isset($_POST['pexpiry'][$i])) {
                        if (!empty($_POST['pexpiry'][$i])) {
                            $dadult_exp = $value['pexpiry'][$i];
                            $pexpiry = date('dMy', (strtotime("+0 day", (strtotime($dadult_exp)))));
                        } else {
                            $pexpiry = '';
                        }
                    } 
                    else 
                    {
                        $pexpiry = '';
                    }
                    
                    $fullname_adult = $_POST['fnameadult'][$i] . "/" . $_POST['lnameadult'][$i] . " " . $plname;

                    $dadult = $_POST['adobadult'][$i];
                    $date_adult = date('dMy', (strtotime("+0 day", (strtotime($dadult)))));


                    $freetext = "P/" . $countyr_code[$i] . "/" . $passport_no[$i] . "/" . $countyr_code_final . "/" . $date_adult . "/" . $gender[$i] . "/" . $pexpiry . "/" . $fullname_adult;
                    $freetext_visa = "OSLO NOR/V/11223344/OSLO/03JAN90/USA";
                    $SSR_DOC.='<dataElementsIndiv>
							<elementManagementData>
								<segmentName>SSR</segmentName>
							</elementManagementData>
							<serviceRequest>
								<ssr>
									<type>DOCS</type>
									<status>HK</status>
									<quantity>1</quantity>
									<companyId>YY</companyId>
									<freetext>' . $freetext . '</freetext>
								</ssr>
							</serviceRequest>
							<referenceForDataElement>
									<reference>
									  <qualifier>PR</qualifier>
									  <number>' . ($i + 1) . '</number>
									</reference>
								  </referenceForDataElement>
							</dataElementsIndiv>';
                }
                $j = $i;
                if (isset($_POST['salchild'])) 
                {
                    for ($i = 0; $i < count($_POST['salchild']); $i++) 
                    {
                        if ($_POST['salchild'][$i] == "Mr")
                            $gender[$i] = "M";
                        else
                            $gender[$i] = "F";


                        if (isset($_POST['passportchild'])) 
                        {
                            if (!empty($_POST['passportchild'][$i])) {
                                $passport_no_child[$i] = $_POST['passportchild'][$i];
                            } else {
                                $passport_no_child[$i] = '';
                            }
                        }
                        $passport_no_child[$i] = '';
                        
                        if (isset($_POST['visachild'])) 
                        {
                            if (!empty($_POST['visachild'][$i])) {
                                $visa_no_child = $_POST['visachild'][$i];
                            } else {
                                $visa_no_child = '';
                            }
                        }
                        else $visa_no_child = '';
                        
                        if (isset($_POST['Pcountrychild'])) 
                        {
                            if (!empty($_POST['Pcountrychild'][$i])) {
                                $code = $this->Flights_Model->get_countyr_code($_POST['Pcountrychild'][$i]);
                                $countyr_code_child[$i] = $code[0]->iso3;
                            } else {
                                $countyr_code_child[$i] = '';
                            }
                        } else {
                            $countyr_code_child[$i] = '';
                        }

                        if (isset($_POST['pexpirychild'][$i])) 
                        {
                            if (!empty($_POST['pexpirychild'][$i])) {
                                $dchild_exp = $_POST['pexpirychild'][$i];
                                $date_child_exp = date('dMy', (strtotime("+0 day", (strtotime($dchild_exp)))));
                            } else {
                                $date_child_exp = '';
                            }
                        } 
                        else 
                        {
                            $date_child_exp = '';
                        }


                        if (isset($_POST['plnamechild'])) 
                        {
                            if (!empty($_POST['plnamechild'][$i])) {
                                $plnamechild = $_POST['plnamechild'][$i];
                            } else {
                                $plnamechild = '';
                            }
                        }
                        else $plnamechild = '';

                        $fullname_child = $_POST['fnamechild'][$i] . "/" . $_POST['lnamechild'][$i] . " " . $plnamechild;
                        $dchild = $_POST['adobchild'][$i];
                        $date_child = date('dMy', (strtotime("+0 day", (strtotime($dchild)))));
                        $freetext = "P/" . $countyr_code[$i] . "/" . $passport_no_child[$i] . "/" . $countyr_code_child[$i] . "/" . $date_child . "/" . $gender[$i] . "/" . $date_child_exp . "/" . $fullname_child;

                        $SSR_DOC.='<dataElementsIndiv>
								<elementManagementData>
									<segmentName>SSR</segmentName>
								</elementManagementData>
								<serviceRequest>
									<ssr>
										<type>DOCS</type>
										<status>HK</status>
										<quantity>1</quantity>
										<companyId>YY</companyId>
										<freetext>' . $freetext . '</freetext>
									</ssr>
								</serviceRequest>
								<referenceForDataElement>
									<reference>
									  <qualifier>PR</qualifier>
									  <number>' . ($i + 1) . '</number>
									</reference>
								  </referenceForDataElement>
							</dataElementsIndiv>';
                        $j++;
                    }
                }

                if (isset($_POST['salinfant'])) 
                {
                    for ($i = 0; $i < count($_POST['salinfant']); $i++) 
                    {
                        if ($_POST['salinfant'][$i] == "Mr")
                            $gender[$i] = "MI";
                        else
                            $gender[$i] = "FI";

                        if (isset($_POST['passportinfant'])) 
                        {
                            if (!empty($_POST['passportinfant'][$i]))
                                $passport_no_child[$i] = $_POST['passportinfant'][$i];
                            else
                                $passport_no_child[$i] = '';
                        }
                        else $passport_no_child[$i] = '';
                        
                        if (isset($_POST['visainfant'])) 
                        {
                            if (!empty($_POST['visainfant'][$i]))
                                $visa_no_child = $_POST['visainfant'][$i];
                            else
                                $visa_no_child = '';
                        }
                        else $visa_no_child = '';
                        
                        if (isset($_POST['Pcountryinfant'])) 
                        {
                            if (!empty($_POST['Pcountryinfant'][$i])) {
                                $code = $this->Flights_Model->get_countyr_code($_POST['Pcountryinfant'][$i]);
                                $countyr_code_child[$i] = $code[0]->iso3;
                            }
                            else
                                $countyr_code_child[$i] = '';
                        }
                        else
                            $countyr_code_child[$i] = '';

                        if (isset($_POST['pexpiryinfant'][$i])) 
                        {
                            if (!empty($_POST['pexpiryinfant'][$i])) {
                                $dinfant_exp = $_POST['pexpiryinfant'][$i];
                                $date_infant_exp = date('dMy', (strtotime("+0 day", (strtotime($dinfant_exp)))));
                            }
                            else
                                $date_infant_exp = '';
                        }
                        else
                            $date_infant_exp = '';


                        if (isset($_POST['plnameinfant'])) 
                        {
                            if (!empty($_POST['plnameinfant'][$i]))
                                $plnameinfant = $_POST['plnameinfant'][$i];
                            else
                                $plnameinfant = '';
                        }
                        else $plnameinfant = '';
                        
                        $fullname_infant = $_POST['fnameinfant'][$i] . "/" . $_POST['lnameinfant'][$i] . " " . $plnameinfant;
                        $dinfant = $_POST['adobinfant'][$i];
                        $date_infant = date('dMy', (strtotime("+0 day", (strtotime($dinfant)))));

                        $freetext = "P/" . $countyr_code[$i] . "/" . $passport_no_child[$i] . "/" . $countyr_code_child[$i] . "/" . $date_infant . "/" . $gender[$i] . "/" . $date_infant_exp . "/" . $fullname_infant;
                        $SSR_DOC.='<dataElementsIndiv>
								<elementManagementData>
									<segmentName>SSR</segmentName>
								</elementManagementData>
								<serviceRequest>
									<ssr>
										<type>DOCS</type>
										<status>HK</status>
										<quantity>1</quantity>
										<companyId>YY</companyId>
										<freetext>' . $freetext . '</freetext>
									</ssr>
								</serviceRequest>
								<referenceForDataElement>
									<reference>
									  <qualifier>PR</qualifier>
									  <number>' . ($i + 1) . '</number>
									</reference>
								  </referenceForDataElement>
							</dataElementsIndiv>';
                        $j++;
                    }
                }
                
                //$value['email']='jalaj.provab@gmail.com';
                $dlocArray=explode('<br>',$flightDetails['dlocation']);
                $alocArray=explode('<br>',$flightDetails['alocation']);
                $dloc=$dlocArray[0];
                $aloc=end($alocArray);
                
                $query=$this->db->query($sql="select country from city_code_amadeus where city_code='".$dloc."'");
                $query1=$this->db->query($sql="select country from city_code_amadeus where city_code='".$aloc."'");
                //echo $query->countrycode.'<<<>>>';
                //$query1->countrycode;
                //die;
                $internationalCheck='false';
                if($query->num_rows()>0 && $query1->num_rows()>0)
                {
                    //echo 'hello';die;
                    $loc=$query->row();
                    $loc1=$query1->row();
                    $alocCountry=$loc->country;
                    $dlocCountry=$loc1->country;
                    if($alocCountry==$dlocCountry)
                    {
                        $internationalCheck='false';
                    }
                    else
                    {
                        $internationalCheck='true';
                    }
                }
                $fop='';
                if($internationalCheck=='false' || $_POST['card_type']=='American Express')
                {
                    $cardText='visa/CC/'.$flightDetails["Total_FareAmount"].'/AX/'.$_POST["card_number"].'/'.$_POST["exp_year"].$_POST["exp_month"];
                    //$fop='<fop>
                     //           <identification>CC</identification>
                    //            <amount>'.$flightDetails["Total_FareAmount"].'</amount>
                   //             <creditCardCode>AX</creditCardCode>
                   //             <accountNumber>'.$_POST["card_number"].'</accountNumber>
                   //             <expiryDate>'.$_POST["exp_year"].$_POST["exp_month"].'</expiryDate>
                   //             <currencyCode>USD</currencyCode>
                   //       </fop>';
                }
                else
                {
                    $cardText='';
                    //$fop='<identification>CA</identification>';
                }
                
                if($cardText!='')
                {
                $visaElement='<dataElementsIndiv>
                                                                        <elementManagementData>
                                                                        <segmentName>RM</segmentName>
                                                                        </elementManagementData>
                                                                        <miscellaneousRemark>
                                                                        <remarks>
                                                                        <type>RM</type>
                                                                        <category>*</category>
                                                                        <freetext>'.$cardText.'</freetext>
                                                                        </remarks>
                                                                        </miscellaneousRemark>
                                                                    </dataElementsIndiv>';
                }else $visaElement='';
                $lastBookingIdQuery=$this->db->query($sql="select booking_id from amadeus_flight_book_passengers where 1 order by psg_id desc limit 0,1");
                if($lastBookingIdQuery->num_rows()>0)
                {
                    $lastBookingId=$lastBookingIdQuery->row();
                    if($lastBookingId->booking_id!='')
                    {
                        $len=strlen($lastBookingId->booking_id);
                        $exp=explode('U',$booking_id);
                        //echo strlen($exp[1]);die;
                        $cnt=0;
                        for($f=0;$f<strlen($exp[1]);$f++)
                        {
                            if($exp[1][$f]==0)
                            {
                                $cnt++;
                            }
                        }
                       
                        $ad=0;
                        if($cnt>0)
                        {
                            $gg=$cnt+1;
                            $exp1=explode('0',$exp[1],$gg);
                            $ad=end($exp1)+1;
                        
                            $booking_id='ATU';
                            for($h=0;$h<$cnt;$h++)
                            {
                                $booking_id.='0';
                            }

                            $booking_id.=$ad;
                        }
                        else $booking_id='ATU'.($exp[1]+1);
                        
                    }
                    else
                    {
                        $booking_id='ATU000001'; 
                    }
                }
                //echo $booking_id.'<<<';die;
                
                $RM_freeText='AIAN 2011007775/'.$booking_id.'/'.$flightDetails["Total_FareAmount"].'/'.$flightDetails["TaxAmount"].'/'.$flightDetails["admin_markup"];
                
                $PNR_AddMultiElements = '<?xml version="1.0" encoding="utf-8"?>
                                            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                             <soapenv:Header>
                                                        <SessionId>' . $SessionId . '</SessionId>
                                                        <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                               </soapenv:Header>
                                              <soapenv:Body>
                                                    <PNR_AddMultiElements xmlns="http://xml.amadeus.com/PNRADD_08_3_1A" >
                                                            <pnrActions>
                                                                    <optionCode>0</optionCode>
                                                            </pnrActions>
                                                            <travellerInfo>
                                                                    <elementManagementPassenger>
                                                                            <reference>
                                                                                    <qualifier>PR</qualifier>
                                                                                    <number>1</number>
                                                                            </reference>
                                                                            <segmentName>NM</segmentName>
                                                                    </elementManagementPassenger>
                                                                    ' . $passengerData . '
                                                            </travellerInfo>
                                                            <dataElementsMaster>
                                                                    <marker1/>
                                                                    <dataElementsIndiv>
                                                                            <elementManagementData>
                                                                                    <segmentName>TK</segmentName>
                                                                            </elementManagementData>
                                                                            <ticketElement>
                                                                                    <ticket>
                                                                                            <indicator>TL</indicator>
                                                                                    </ticket>
                                                                            </ticketElement>
                                                                    </dataElementsIndiv>

                                                                    <dataElementsIndiv>
                                                                            <elementManagementData>
                                                                                    <segmentName>AP</segmentName>
                                                                            </elementManagementData>
                                                                            <freetextData>
                                                                                    <freetextDetail>
                                                                                            <subjectQualifier>3</subjectQualifier>
                                                                                            <type>P02</type>
                                                                                    </freetextDetail>
                                                                                    <longFreetext>' . $_POST["user_email"] . '</longFreetext>
                                                                            </freetextData>
                                                                    </dataElementsIndiv>
                                                                    <dataElementsIndiv>
                                                                            <elementManagementData>
                                                                                    <reference>
                                                                                            <qualifier>OT</qualifier>
                                                                                            <number>1</number>
                                                                                    </reference>
                                                                                    <segmentName>AP</segmentName>
                                                                            </elementManagementData>
                                                                            <freetextData>
                                                                                    <freetextDetail>
                                                                                            <subjectQualifier>3</subjectQualifier>
                                                                                            <type>7</type>
                                                                                    </freetextDetail>
                                                                                    <longFreetext>+45 7022 1819</longFreetext>
                                                                            </freetextData>
                                                                    </dataElementsIndiv>
                                                                    '.$SSR_DOC.'
                                                                    <dataElementsIndiv>
                                                                            <elementManagementData>
                                                                                    <segmentName>FP</segmentName>
                                                                            </elementManagementData>
                                                                            <formOfPayment>
                                                                                <fop>
                                                                                    <identification>CA</identification>
                                                                                </fop>
                                                                             </formOfPayment>
                                                                    </dataElementsIndiv>
                                                                    <dataElementsIndiv>
                                                                        <elementManagementData>
                                                                        <segmentName>RM</segmentName>
                                                                        </elementManagementData>
                                                                        <miscellaneousRemark>
                                                                        <remarks>
                                                                        <type>RM</type>
                                                                        <category>*</category>
                                                                        <freetext>'.$RM_freeText.'</freetext>
                                                                        </remarks>
                                                                        </miscellaneousRemark>
                                                                    </dataElementsIndiv>
                                                                    '.$visaElement.'
                                                            </dataElementsMaster>
                                                    </PNR_AddMultiElements>
                                               </soapenv:Body>
                                            </soapenv:Envelope>';
               // echo "PNR_AddMultiElements Request:<br/>".$PNR_AddMultiElements;//die;
                //$URL2 = "https://test.webservices.amadeus.com";
                $URL2 = "https://production.webservices.amadeus.com";
                $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/PNRADD_08_3_1A";

                $ch2 = curl_init();
                curl_setopt($ch2, CURLOPT_URL, $URL2);
                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                curl_setopt($ch2, CURLOPT_HEADER, 0);
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch2, CURLOPT_POST, 1);
                curl_setopt($ch2, CURLOPT_POSTFIELDS, $PNR_AddMultiElements);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
                $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                // Execute request, store response and HTTP response code
                $PNRAddMultiElements = curl_exec($ch2);
                $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                curl_close($ch2);
                // echo "PNRAddMultiElements Response :<br/>";print_r($PNRAddMultiElements);

				
                $PNRAddMultiElements_result = $this->xml2array($PNRAddMultiElements);
               
               //echo'<pre/>: Paasenger Information';print_r($PNRAddMultiElements_result);//exit;

                if (!empty($PNRAddMultiElements_result))
                {
                    if (isset($PNRAddMultiElements_result['soap:Envelope']['soap:Body']['PNR_Reply']['securityInformation']))
                        $data['PNR_result'] = $PNRAddMultiElements_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                    else
                        $data['PNR_result'] = "";
				
                    if (!empty($data['PNR_result']))
                    {
			
                        if (true) 
                        {
                            $attributeType = $data['PNR_result']['securityInformation']['responsibilityInformation']['typeOfPnrElement'];

                            if (!isset($data['PNR_result']['travellerInfo'][0])) 
                            {

                                $flightType = $data['PNR_result']['travellerInfo']['elementManagementPassenger']['reference']['qualifier'];
                                $traveller_segmentName = $data['PNR_result']['travellerInfo']['elementManagementPassenger']['segmentName'];
                            } 
                            else 
                            {
                                $count = (count($data['PNR_result']['travellerInfo']));
                                for ($as = 0; $as < $count; $as++) 
                                {
                                    $flightType[$as] = $data['PNR_result']['travellerInfo'][$as]['elementManagementPassenger']['reference']['qualifier'];
                                    $traveller_segmentName[$as] = $data['PNR_result']['travellerInfo'][$as]['elementManagementPassenger']['segmentName'];
                                }
                            }
                            $qualifier_code = '';
                            $qualifier_number = '';
                            if (!isset($data['PNR_result']['originDestinationDetails'][0])) 
                            {
                                if (!isset($data['PNR_result']['originDestinationDetails']['itineraryInfo'][0])) 
                                {
                                    $qualifier = $data['PNR_result']['originDestinationDetails']['itineraryInfo'];
                                    $qualifier_code[0] = $qualifier['elementManagementItinerary']['reference']['qualifier'];
                                    $qualifier_number[0] = $qualifier['elementManagementItinerary']['reference']['number'];
                                } 
                                else 
                                {
                                    $qualifier = $data['PNR_result']['originDestinationDetails']['itineraryInfo'];
                                    for ($qi = 0; $qi < count($qualifier); $qi++) 
                                    {
                                        $qualifier_code[$qi] = $qualifier[$qi]['elementManagementItinerary']['reference']['qualifier'];
                                        $qualifier_number[$qi] = $qualifier[$qi]['elementManagementItinerary']['reference']['number'];
                                    }
                                }
                            }
                            if (isset($flightType[0])) 
                            {
                                $flightType = $flightType[0];
                            }
                            if ($_SESSION['journey_type'] == "OneWay")
                            {
                                $cur_over = '<cityOverride>
                                                <cityDetail>
                                                      <cityCode>ODE</cityCode>
                                                      <cityQualifier>162</cityQualifier>
                                                </cityDetail>
                                                <cityDetail>
                                                      <cityCode>ODE</cityCode>
                                                      <cityQualifier>91</cityQualifier>
                                                </cityDetail>
                                              </cityOverride>
                                              <currencyOverride>
                                                <firstRateDetail>
                                                      <currencyCode>EUR</currencyCode>
                                                </firstRateDetail>
                                              </currencyOverride>';
                            }
                            else
                            {
                                $cur_over = '';
                            }
						//echo $cur_over;die;
                            $SequenceNumber = $SequenceNumber + 1;

                            if ($res['journey_type'] == "Round_oneway")
                            {
								//echo 'ddsfdsfdsfdfdsffsf';die;
                                if ($flightDetails_oneway['MultiTicket'] == 'Yes') 
                                {

                                    if (is_array($flightDetails1['oneWay']['operatingCarrier']))
                                        $code_oneway = $flightDetails1['oneWay']['operatingCarrier'][0];
                                    else
                                        $code_oneway = $flightDetails1['oneWay']['operatingCarrier'];

                                    if (is_array($flightDetails1['Return']['operatingCarrier']))
                                        $code_return = $flightDetails1['Return']['operatingCarrier'][0];
                                    else
                                        $code_return = $flightDetails1['Return']['operatingCarrier'];

                                    $paxSegReference_oneway = '<paxSegReference>';
                                    $paxSegReference_return = '<paxSegReference>';
                                    for ($ilo = 0; $ilo < count($flightDetails_oneway['fnumber']); $ilo++) {
                                        $paxSegReference_oneway.='<refDetails> 
																			  <refQualifier>' . $qualifier_code[$ilo][0] . '</refQualifier> 
																			  <refNumber>' . $qualifier_number[$ilo] . '</refNumber> 
																			</refDetails>';
                                    }
                                    for ($ilr = 0; $ilr < count($flightDetails_return['fnumber']); $ilr++) {

                                        $paxSegReference_return.='<refDetails> 
																			  <refQualifier>' . $qualifier_code[$ilo][0] . '</refQualifier> 
																			  <refNumber>' . $qualifier_number[$ilo++] . '</refNumber> 
																			</refDetails>';
                                    }
                                    $paxSegReference_oneway.='</paxSegReference>';
                                    $paxSegReference_return.='</paxSegReference>';

                                    $validatingCarrier_MTK_oneway = '<validatingCarrier> 
																			<carrierInformation> 
																			  <carrierCode>' . $code_oneway . '</carrierCode> 
																			</carrierInformation> 
																		  </validatingCarrier> ';

                                    $validatingCarrier_MTK_return = '<validatingCarrier> 
																		<carrierInformation> 
																		  <carrierCode>' . $code_return . '</carrierCode> 
																		</carrierInformation> 
																	  </validatingCarrier> ';
                                } else {
                                    $paxSegReference_oneway = '';
                                    $paxSegReference_return = '';
                                    $validatingCarrier_MTK = '';
                                }
                            }
                            //print_r($flightDetails);die;
                            //echo $flightDetails_oneway['MultiTicket'].'<<<>>';die;
                            //echo 'helllllllllllllll';die;
                            if ($flightDetails_oneway['MultiTicket'] == 'Yes')
                            {
								
                                $Fare_PricePNRWithBookingClass = '<?xml version="1.0" encoding="utf-8"?>
											<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
											 <soapenv:Header>
                                                                                                <SessionId>' . $SessionId . '</SessionId>
                                                                                                <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
											   </soapenv:Header>
											  <soapenv:Body><Fare_PricePNRWithBookingClass xmlns="http://xml.amadeus.com/TPCBRQ_07_3_1A">
													 ' . $paxSegReference_oneway . '
													 <overrideInformation>
														<attributeDetails>
															<attributeType>RP</attributeType>
														</attributeDetails>
														<attributeDetails>
															<attributeType>RU</attributeType>
														</attributeDetails>
														<attributeDetails>
															<attributeType>RLO</attributeType>
														</attributeDetails>
														<attributeDetails>
															<attributeType>MTK</attributeType>
														</attributeDetails>
														<attributeDetails>
															<attributeType>ET</attributeType>
														</attributeDetails>
														<attributeDetails>
															<attributeType>TAC</attributeType>
														</attributeDetails>
													</overrideInformation>
													' . $cur_over . '
													' . $validatingCarrier_MTK_oneway . '
												</Fare_PricePNRWithBookingClass>
											</soapenv:Body>
										</soapenv:Envelope>';


                                // echo'Fare_PricePNRWithBookingClass Request:<br/>'. $Fare_PricePNRWithBookingClass;
                                //$URL2 = "https://test.webservices.amadeus.com";
                                $URL2 = "https://production.webservices.amadeus.com";
                                $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/TPCBRQ_07_3_1A";

                                $ch2 = curl_init();
                                curl_setopt($ch2, CURLOPT_URL, $URL2);
                                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                curl_setopt($ch2, CURLOPT_HEADER, 0);
                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch2, CURLOPT_POST, 1);
                                curl_setopt($ch2, CURLOPT_POSTFIELDS, $Fare_PricePNRWithBookingClass);
                                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                /* $httpHeader2 = array(
                                  "Content-Type: text/xml; charset=UTF-8",
                                  "Content-Encoding: UTF-8"
                                  ); */

                                $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                // Execute request, store response and HTTP response code
                                $PricePNRWithBookingClass = curl_exec($ch2);
                                $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                curl_close($ch2);

                                 //echo "<pre/>PricePNRWithBookingClass Response: <br/>";print_r($PricePNRWithBookingClass).'>>>>>>>>>>>>>>>>>>>';//exit;
                                $PricePNRWithBookingClass_result = $this->xml2array($PricePNRWithBookingClass);
                                //echo "<pre/>PricePNRWithBookingClass_result Response_yes: <br/>";print_r($PricePNRWithBookingClass_result);exit;

                                if (!empty($PricePNRWithBookingClass_result)) 
                                {
                                    if (isset($PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError'])) 
                                    {
                                        //if(false){
                                        $errorCategory = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorOrWarningCodeDetails']['errorDetails']['errorCategory'];
                                        $errorCodeOwner = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorOrWarningCodeDetails']['errorDetails']['errorCodeOwner'];
                                        $errorCode = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorOrWarningCodeDetails']['errorDetails']['errorCode'];
                                        $errorWarningDescription = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorWarningDescription']['freeText'];
                                        $error_msg = $errorCode . " :-" . $errorWarningDescription . " : " . $errorCategory . " (" . $errorCodeOwner . "), Please Try Again : PricePNRWithBookingClass_result";          // echo $error_msg." PricePNRWithBookingClass_result";
                                        $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                        unset($_SESSION['amadeus'][$sess_id]);
                                        $this->error_page($error_msg);
                                    } 
                                    else 
                                    {
                                        //$data['PricePNRWithBookingClass_result'] = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['fareList'];
                                        $psaList = '';
                                        if (isset($_SESSION[$rand_id]['adults'])) {
                                            if (!empty($_SESSION[$rand_id]['adults'])) {
                                                $psaList.='<psaList>
															<itemReference>
																<referenceType>TST</referenceType>
																<uniqueReference>1</uniqueReference>
															</itemReference>
														</psaList>';
                                            }
                                        } else {
                                            $psaList.='';
                                        }
                                        if (isset($_SESSION[$rand_id]['childs'])) {
                                            if (!empty($_SESSION[$rand_id]['childs'])) {
                                                $psaList.='<psaList>
															<itemReference>
																<referenceType>TST</referenceType>
																<uniqueReference>2</uniqueReference>
															</itemReference>
														</psaList>';
                                            }
                                        } else {
                                            $psaList.='';
                                        }
                                        if (isset($_SESSION[$rand_id]['infants'])) {
                                            if (!empty($_SESSION[$rand_id]['infants'])) {
                                                $psaList.='<psaList>
															<itemReference>
																<referenceType>TST</referenceType>
																<uniqueReference>3</uniqueReference>
															</itemReference>
														</psaList>';
                                            }
                                        } else {
                                            $psaList.='';
                                        }
                                        $SequenceNumber = $SequenceNumber + 1;
                                        $Ticket_CreateTSTFromPricing = '<?xml version="1.0" encoding="utf-8"?>
																		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
																		 <soapenv:Header>
																				   <Session>
																						  <SessionId>' . $SessionId . '</SessionId>
																						  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																						  <SecurityToken>' . $SecurityToken . '</SecurityToken>
																					</Session>
																		   </soapenv:Header>
																		  <soapenv:Body>
																		  <Ticket_CreateTSTFromPricing xmlns="http://xml.amadeus.com/TAUTCQ_04_1_1A">
																					' . $psaList . '
																				</Ticket_CreateTSTFromPricing>
																		</soapenv:Body>
																	</soapenv:Envelope>';

                                        // echo 'Ticket_CreateTSTFromPricing Request:<br/>'. $Ticket_CreateTSTFromPricing;		

                                        $URL2 = "https://test.webservices.amadeus.com";
                                        // $URL2 = "https://production.webservices.amadeus.com";
                                        $soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/TAUTCQ_04_1_1A";

                                        $ch2 = curl_init();
                                        curl_setopt($ch2, CURLOPT_URL, $URL2);
                                        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                        curl_setopt($ch2, CURLOPT_HEADER, 0);
                                        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt($ch2, CURLOPT_POST, 1);
                                        curl_setopt($ch2, CURLOPT_POSTFIELDS, $Ticket_CreateTSTFromPricing);
                                        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                        $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                        // Execute request, store response and HTTP response code
                                        $Ticket_CreateTSTFromPricing = curl_exec($ch2);
                                        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                        curl_close($ch2);
                                        //echo "Ticket_CreateTSTFromPricing Response: <br/>";print_r($Ticket_CreateTSTFromPricing);exit;

                                        if (!empty($Ticket_CreateTSTFromPricing)) {
                                            $Ticket_CreateTSTFromPricing_result = $this->xml2array($Ticket_CreateTSTFromPricing);
                                            //echo'<pre/>: Ticket_CreateTSTFromPricing:<br> ';print_r($Ticket_CreateTSTFromPricing_result);


                                            if (true) 
                                            {
                                                $Fare_PricePNRWithBookingClass = '<?xml version="1.0" encoding="utf-8"?>
                                                                                        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                                                         <soapenv:Header>
                                                                                                           <Session>
                                                                                                                          <SessionId>' . $SessionId . '</SessionId>
                                                                                                                          <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                                                                                          <SecurityToken>' . $SecurityToken . '</SecurityToken>
                                                                                                                </Session>
                                                                                           </soapenv:Header>
                                                                                          <soapenv:Body><Fare_PricePNRWithBookingClass xmlns="http://xml.amadeus.com/TPCBRQ_12_4_1A">
                                                                                                         ' . $paxSegReference_return . '
                                                                                                         <overrideInformation>
                                                                                                                <attributeDetails>
                                                                                                                        <attributeType>RP</attributeType>
                                                                                                                </attributeDetails>
                                                                                                                <attributeDetails>
                                                                                                                        <attributeType>RU</attributeType>
                                                                                                                </attributeDetails>
                                                                                                                <attributeDetails>
                                                                                                                        <attributeType>RLO</attributeType>
                                                                                                                </attributeDetails>
                                                                                                                <attributeDetails>
                                                                                                                        <attributeType>MTK</attributeType>
                                                                                                                </attributeDetails>
                                                                                                                <attributeDetails>
                                                                                                                        <attributeType>ET</attributeType>
                                                                                                                </attributeDetails>
                                                                                                                <attributeDetails>
                                                                                                                        <attributeType>TAC</attributeType>
                                                                                                                </attributeDetails>
                                                                                                        </overrideInformation>
                                                                                                        ' . $cur_over . '
                                                                                                        ' . $validatingCarrier_MTK_return . '
                                                                                                </Fare_PricePNRWithBookingClass>
                                                                                        </soapenv:Body>
                                                                                </soapenv:Envelope>';


                                                // echo'Fare_PricePNRWithBookingClass Request:<br/>'. $Fare_PricePNRWithBookingClass;
                                                $URL2 = "https://test.webservices.amadeus.com";
                                                // $URL2 = "https://production.webservices.amadeus.com";
                                                $soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/TPCBRQ_12_4_1A";

                                                $ch2 = curl_init();
                                                curl_setopt($ch2, CURLOPT_URL, $URL2);
                                                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                                curl_setopt($ch2, CURLOPT_HEADER, 0);
                                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch2, CURLOPT_POST, 1);
                                                curl_setopt($ch2, CURLOPT_POSTFIELDS, $Fare_PricePNRWithBookingClass);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                                curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                                /* $httpHeader2 = array(
                                                  "Content-Type: text/xml; charset=UTF-8",
                                                  "Content-Encoding: UTF-8"
                                                  ); */

                                                $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                                curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                                // Execute request, store response and HTTP response code
                                                $PricePNRWithBookingClass = curl_exec($ch2);
                                                $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                                curl_close($ch2);
                                                // echo'<pre/>: PricePNRWithBookingClass:<br> ';print_r($PricePNRWithBookingClass);
                                                $PricePNRWithBookingClass_result = $this->xml2array($PricePNRWithBookingClass);

                                                if (!empty($PricePNRWithBookingClass_result)) {
                                                    //if(false)
                                                    if (isset($PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError'])) {
                                                        $errorCategory = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorOrWarningCodeDetails']['errorDetails']['errorCategory'];
                                                        $errorCodeOwner = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorOrWarningCodeDetails']['errorDetails']['errorCodeOwner'];
                                                        $errorCode = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorOrWarningCodeDetails']['errorDetails']['errorCode'];
                                                        $errorWarningDescription = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorWarningDescription']['freeText'];
                                                        $error_msg = $errorCode . " :-" . $errorWarningDescription . " : " . $errorCategory . " (" . $errorCodeOwner . "), Please Try Again : PricePNRWithBookingClass_result";          // echo $error_msg." PricePNRWithBookingClass_result";
                                                        $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                        unset($_SESSION['amadeus'][$sess_id]);
                                                        $this->error_page($error_msg);
                                                    } else {
                                                        //$data['PricePNRWithBookingClass_result'] = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['fareList'];
                                                        $psaList = '';
                                                        if (isset($_SESSION[$rand_id]['adults'])) {
                                                            if (!empty($_SESSION[$rand_id]['adults'])) {
                                                                $psaList.='<psaList>
																			<itemReference>
																				<referenceType>TST</referenceType>
																				<uniqueReference>1</uniqueReference>
																			</itemReference>
																		</psaList>';
                                                            }
                                                        } else {
                                                            $psaList.='';
                                                        }
                                                        if (isset($_SESSION[$rand_id]['childs'])) {
                                                            if (!empty($_SESSION[$rand_id]['childs'])) {
                                                                $psaList.='<psaList>
																			<itemReference>
																				<referenceType>TST</referenceType>
																				<uniqueReference>2</uniqueReference>
																			</itemReference>
																		</psaList>';
                                                            }
                                                        } else {
                                                            $psaList.='';
                                                        }
                                                        if (isset($_SESSION[$rand_id]['infants'])) {
                                                            if (!empty($_SESSION[$rand_id]['infants'])) {
                                                                $psaList.='<psaList>
																			<itemReference>
																				<referenceType>TST</referenceType>
																				<uniqueReference>3</uniqueReference>
																			</itemReference>
																		</psaList>';
                                                            }
                                                        } else {
                                                            $psaList.='';
                                                        }
                                                        $SequenceNumber = $SequenceNumber + 1;
                                                        $Ticket_CreateTSTFromPricing = '<?xml version="1.0" encoding="utf-8"?>
                                                                                                    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">

                                                                                                     <soapenv:Header>
                                                                                                                       <Session>
                                                                                                                                      <SessionId>' . $SessionId . '</SessionId>
                                                                                                                                      <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                                                                                                      <SecurityToken>' . $SecurityToken . '</SecurityToken>
                                                                                                                            </Session>
                                                                                                       </soapenv:Header>
                                                                                                      <soapenv:Body>
                                                                                                      <Ticket_CreateTSTFromPricing xmlns="http://xml.amadeus.com/TAUTCQ_04_1_1A">
                                                                                                                            ' . $psaList . '
                                                                                                                    </Ticket_CreateTSTFromPricing>
                                                                                                    </soapenv:Body>
                                                                                            </soapenv:Envelope>';

                                                        // echo'Ticket_CreateTSTFromPricing Request:<br/>'. $Ticket_CreateTSTFromPricing;		

                                                        $URL2 = "https://test.webservices.amadeus.com";
                                                        // $URL2 = "https://production.webservices.amadeus.com";
                                                        $soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/TAUTCQ_04_1_1A";

                                                        $ch2 = curl_init();
                                                        curl_setopt($ch2, CURLOPT_URL, $URL2);
                                                        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                                        curl_setopt($ch2, CURLOPT_HEADER, 0);
                                                        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_setopt($ch2, CURLOPT_POST, 1);
                                                        curl_setopt($ch2, CURLOPT_POSTFIELDS, $Ticket_CreateTSTFromPricing);
                                                        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                                        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                                        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                                        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                                        $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                                        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                                        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                                        // Execute request, store response and HTTP response code
                                                        $Ticket_CreateTSTFromPricing = curl_exec($ch2);
                                                        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                                        curl_close($ch2);
                                                        // echo'<pre/>: Ticket_CreateTSTFromPricing:<br> ';print_r($Ticket_CreateTSTFromPricing);
                                                        $Ticket_CreateTSTFromPricing_result = $this->xml2array($Ticket_CreateTSTFromPricing);
                                                        //echo'<pre/>: Ticket_CreateTSTFromPricing:<br> ';print_r($Ticket_CreateTSTFromPricing_result);exit;
                                                    }
                                                }
                                            }

                                            $SequenceNumber = $SequenceNumber + 1;
                                            $PNR_AddMultiElements_End = '<?xml version="1.0" encoding="utf-8"?>
                                                                                <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                                                 <soapenv:Header>
                                                                                                   <Session>
                                                                                                                  <SessionId>' . $SessionId . '</SessionId>
                                                                                                                  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                                                                                  <SecurityToken>' . $SecurityToken . '</SecurityToken>
                                                                                                        </Session>
                                                                                   </soapenv:Header>
                                                                                  <soapenv:Body>
                                                                                  <PNR_AddMultiElements xmlns="http://xml.amadeus.com/PNRADD_11_3_1A">
                                                                                        <pnrActions>
                                                                                                <optionCode>10</optionCode>
                                                                                                <optionCode>30</optionCode>
                                                                                        </pnrActions>
                                                                                        <dataElementsMaster>
                                                                                                <marker1/>
                                                                                                <dataElementsIndiv>
                                                                                                        <elementManagementData>
                                                                                                                <segmentName>RF</segmentName>
                                                                                                        </elementManagementData>
                                                                                                        <freetextData>
                                                                                                                <freetextDetail>
                                                                                                                        <subjectQualifier>3</subjectQualifier>
                                                                                                                        <type>P12</type>
                                                                                                                </freetextDetail>
                                                                                                                <longFreetext>FREE TEXT</longFreetext>
                                                                                                        </freetextData>
                                                                                                </dataElementsIndiv>
                                                                                        </dataElementsMaster>
                                                                                </PNR_AddMultiElements>
                                                                                </soapenv:Body>
                                                                        </soapenv:Envelope>';

                                            // echo 'PNR_AddMultiElements_End Request:<br/>'. $PNR_AddMultiElements_End;

                                            $URL2 = "https://test.webservices.amadeus.com";
                                            // $URL2 = "https://production.webservices.amadeus.com";
                                            $soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/PNRADD_11_3_1A";

                                            $ch2 = curl_init();
                                            curl_setopt($ch2, CURLOPT_URL, $URL2);
                                            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                            curl_setopt($ch2, CURLOPT_HEADER, 0);
                                            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch2, CURLOPT_POST, 1);
                                            curl_setopt($ch2, CURLOPT_POSTFIELDS, $PNR_AddMultiElements_End);
                                            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                            $PNR_AddMultiElements_End = curl_exec($ch2);
                                            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                            curl_close($ch2);
											$PNR_AddMultiElements_Endres = $PNR_AddMultiElements_End;
                                            $PNR_AddMultiElements_End_result = $this->xml2array($PNR_AddMultiElements_End);
                                            
                                            // echo '<pre/>: PNR_AddMultiElements_End:<br> ';print_r($PNR_AddMultiElements_End_result);exit;
                                            $flag_add = false;
                                            $controlNumber = '';
                                            $companyId = '';
                                            if (!empty($PNR_AddMultiElements_End_result)) {
                                                if (isset($PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply']['pnrHeader']))
                                                    $data['PNR_result_End'] = $PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                else if (isset($PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply']['securityInformation']))
                                                    $data['PNR_result_End'] = $PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                else
                                                    $data['PNR_result_End'] = "";

                                                if (!empty($data['PNR_result_End'])) {

                                                    if (isset($data['PNR_result_End']['pnrHeaderTag'])) {
                                                        $Error_text = $data['PNR_result_End']['pnrHeaderTag']['statusInformation']['indicator'];
                                                        if ($Error_text == "NHP") {
                                                            $Error_type = $data['PNR_result_End']['freetextData']['freetextDetail']['type'];
                                                            $Error_msg = $data['PNR_result_End']['freetextData']['longFreetext'];
                                                            $_SESSION['amadeus'][$sess_id]['SessionStatus'] = "false";
                                                            $error_msg = $Error_msg . " Entry not allowewd in NHP Condition" . " - " . $Error_type . ", Please try again";
                                                            $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                            unset($_SESSION['amadeus'][$sess_id]);
                                                            $this->error_page($error_msg);
                                                        } else if (isset($data['PNR_result_End']['generalErrorInfo'])) {
                                                            $error_msg = '';
                                                            $_SESSION['amadeus'][$sess_id]['SessionStatus'] = "false";
                                                            if (!isset($data['PNR_result_End']['generalErrorInfo']['messageErrorText']['text'][0]))
                                                                $error_msg = $data['PNR_result_End']['generalErrorInfo']['messageErrorText']['text'] . ",  Please try again : PNR_result_End GENERAL_ERROR_INFO";
                                                            else {
                                                                for ($gi = 0; $gi < (count($data['PNR_result_End']['generalErrorInfo']['messageErrorText']['text'])); $gi++) {
                                                                    $error_msg.=$data['PNR_result_End']['generalErrorInfo']['messageErrorText']['text'][$gi] . "  ";
                                                                }
                                                                $error_msg.=",  Please try again : PNR_result_End GENERAL_ERROR_INFO";
                                                            }
                                                            $flag_add = true;
                                                            $controlNumber = '';
                                                        } else {
                                                            $error_msg = "Error while generating PNR Number, Please try again";
                                                            $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                            unset($_SESSION['amadeus'][$sess_id]);
                                                            $this->error_page($error_msg);
                                                        }
                                                    } else {
                                                        if (isset($data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['controlNumber'])) {
                                                            $controlNumber = $data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['controlNumber'];
                                                            $companyId = $data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['companyId'];
                                                        }
                                                        else
                                                            $controlNumber = '';
                                                        $_SESSION[$id]['controlNumber'] = $controlNumber;
                                                    }
                                                }
                                                else {
                                                    $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                    unset($_SESSION['amadeus'][$sess_id]);
                                                    $error_msg = "PNR_result_End is Empty, Please try again";
                                                    $this->error_page($error_msg);
                                                }
                                            } else {
                                                $error_msg = "PNR_AddMultiElements_End_result Response is Empty,  Please try again";
                                                $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                unset($_SESSION['amadeus'][$sess_id]);
                                                $this->error_page($error_msg);
                                            }

                                            if ($flag_add == true)
                                            {
                                                $PNR_AddMultiElements_End = '<?xml version="1.0" encoding="utf-8"?>
																			<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
																			 <soapenv:Header>
																					   <Session>
																							  <SessionId>' . $SessionId . '</SessionId>
																							  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																							  <SecurityToken>' . $SecurityToken . '</SecurityToken>
																						</Session>
																			   </soapenv:Header>
																			  <soapenv:Body>
																			  <PNR_AddMultiElements xmlns="http://xml.amadeus.com/PNRADD_11_3_1A">
																				<pnrActions>
																					<optionCode>10</optionCode>
																				</pnrActions>
																				<dataElementsMaster>
																					<marker1/>
																					<dataElementsIndiv>
																						<elementManagementData>
																							<segmentName>RF</segmentName>
																						</elementManagementData>
																						<freetextData>
																							<freetextDetail>
																								<subjectQualifier>3</subjectQualifier>
																								<type>P12</type>
																							</freetextDetail>
																							<longFreetext>FREE TEXT</longFreetext>
																						</freetextData>
																					</dataElementsIndiv>
																				</dataElementsMaster>
																			</PNR_AddMultiElements>
																			</soapenv:Body>
																		</soapenv:Envelope>';

                                                // echo 'PNR_AddMultiElements_End Request:<br/>'. $PNR_AddMultiElements_End;

                                                $URL2 = "https://test.webservices.amadeus.com";
                                                // $URL2 = "https://production.webservices.amadeus.com";
                                                $soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/PNRADD_11_3_1A";

                                                $ch2 = curl_init();
                                                curl_setopt($ch2, CURLOPT_URL, $URL2);
                                                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                                curl_setopt($ch2, CURLOPT_HEADER, 0);
                                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch2, CURLOPT_POST, 1);
                                                curl_setopt($ch2, CURLOPT_POSTFIELDS, $PNR_AddMultiElements_End);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                                curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                                $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                                curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                                $PNR_AddMultiElements_End = curl_exec($ch2);
                                                $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                                curl_close($ch2);

                                                $PNR_AddMultiElements_End_result = $this->xml2array($PNR_AddMultiElements_End);
                                                // echo '<pre/>: second time: PNR_AddMultiElements_End:<br> ';print_r($PNR_AddMultiElements_End_result);exit;

                                                if (isset($PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply']['pnrHeader']))
                                                    $data['PNR_result_End'] = $PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                else if (isset($PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply']['securityInformation']))
                                                    $data['PNR_result_End'] = $PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                else
                                                    $data['PNR_result_End'] = "";

                                                if (isset($data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['controlNumber'])) {
                                                    $controlNumber = $data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['controlNumber'];
                                                    $companyId = $data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['companyId'];
                                                }
                                                else
                                                    $controlNumber = '';
                                            }
                                            if (!empty($controlNumber)) {
                                                $SequenceNumber = $SequenceNumber + 1;
                                                $PNR_Retrieve = '<?xml version="1.0" encoding="utf-8"?>
																					<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
																					 <soapenv:Header>
																							   <Session>
																									  <SessionId>' . $SessionId . '</SessionId>
																									  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																									  <SecurityToken>' . $SecurityToken . '</SecurityToken>
																								</Session>
																					   </soapenv:Header>

																					  <soapenv:Body>
																					  <PNR_Retrieve xmlns="http://xml.amadeus.com/PNRRET_11_3_1A">
																							<retrievalFacts>
																								<retrieve>
																									<type>2</type>
																								</retrieve>
																								<reservationOrProfileIdentifier>
																									<reservation>
																										<controlNumber>' . $controlNumber . '</controlNumber>
																									</reservation>
																								</reservationOrProfileIdentifier>
																							</retrievalFacts>
																						</PNR_Retrieve>
																					</soapenv:Body>
																				</soapenv:Envelope>';

                                                $URL2 = "https://test.webservices.amadeus.com";
                                                // $URL2 = "https://production.webservices.amadeus.com";
                                                $soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/PNRRET_11_3_1A";
                                                // echo'<pre/>: PNR_Retrieve request:<br> ';print_r($PNR_Retrieve);
                                                $ch2 = curl_init();
                                                curl_setopt($ch2, CURLOPT_URL, $URL2);
                                                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                                curl_setopt($ch2, CURLOPT_HEADER, 0);
                                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch2, CURLOPT_POST, 1);
                                                curl_setopt($ch2, CURLOPT_POSTFIELDS, $PNR_Retrieve);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                                curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                                $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                                curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                                // Execute request, store response and HTTP response code
                                                $PNR_Retrieve = curl_exec($ch2);
                                                $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                                curl_close($ch2);
                                                //echo "PNR_AddMultiElements_End Response: <br/>";print_r($PNR_AddMultiElements_End);
                                                $_SESSION['amadeus'][$sess_id]['SessionStatus'] = "false";

                                                $PNR_Retrieve_result = $this->xml2array($PNR_Retrieve);
                                                // echo'<pre/>: PNR_Retrieve_result:<br> ';print_r($PNR_Retrieve_result);exit;

                                                $final_result = '';
                                                if (!empty($PNR_Retrieve_result)) {
                                                    if (isset($PNR_Retrieve_result['soap:Envelope']['soap:Body']['PNR_Reply']['securityInformation']))
                                                        $data['PNR_result_final'] = $PNR_Retrieve_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                    else
                                                        $data['PNR_result_final'] = "";

                                                    if (!empty($data['PNR_result_final'])) {
                                                        $final_result['originatorId'] = $data['PNR_result_final']['sbrPOSDetails']['sbrUserIdentificationOwn']['originIdentification']['originatorId'];
                                                        $final_result['inHouseIdentification1'] = $data['PNR_result_final']['sbrPOSDetails']['sbrUserIdentificationOwn']['originIdentification']['inHouseIdentification1'];
                                                        $final_result['originatorTypeCode'] = $data['PNR_result_final']['sbrPOSDetails']['sbrUserIdentificationOwn']['originatorTypeCode'];
                                                        $final_result['companyId'] = $data['PNR_result_final']['pnrHeader']['reservationInfo']['reservation']['companyId'];
                                                        $final_result['controlNumber'] = $data['PNR_result_final']['pnrHeader']['reservationInfo']['reservation']['controlNumber'];
                                                        $final_result['date'] = $data['PNR_result_final']['pnrHeader']['reservationInfo']['reservation']['date'];
                                                        $final_result['time'] = $data['PNR_result_final']['pnrHeader']['reservationInfo']['reservation']['time'];

                                                        $final_result['typeOfPnrElement'] = $data['PNR_result_final']['securityInformation']['responsibilityInformation']['typeOfPnrElement'];
                                                        $final_result['agentId'] = $data['PNR_result_final']['securityInformation']['responsibilityInformation']['agentId'];

                                                        if (isset($data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][0])) {
                                                            $count = (count($data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv']));
                                                            for ($i = 0; $i < $count; $i++) {
                                                                $segmentName = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['elementManagementData']['segmentName'];
                                                                if ($segmentName == "TK") {
                                                                    $final_result['segmentNameDetails'][$i]['segmentName'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['elementManagementData']['segmentName'];
                                                                    $final_result['segmentNameDetails'][$i]['indicator'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['ticketElement']['ticket']['indicator'];
                                                                    $final_result['segmentNameDetails'][$i]['date'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['ticketElement']['ticket']['date'];
                                                                    $final_result['segmentNameDetails'][$i]['officeId'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['ticketElement']['ticket']['officeId'];
                                                                } else if ($segmentName == "AP") {

                                                                    $final_result['segmentNameDetails'][$i]['segmentName'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['elementManagementData']['segmentName'];
                                                                    $final_result['segmentNameDetails'][$i]['longFreetext'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['longFreetext'];
                                                                    $final_result['segmentNameDetails'][$i]['subjectQualifier'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['freetextDetail']['subjectQualifier'];
                                                                    $final_result['segmentNameDetails'][$i]['type'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['freetextDetail']['type'];
                                                                } else if (($segmentName == "FE") || ($segmentName == "FP") || ($segmentName == "FV")) {
                                                                    $final_result['segmentNameDetails'][$i]['segmentName'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['elementManagementData']['segmentName'];
                                                                    $final_result['segmentNameDetails'][$i]['subjectQualifier'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['freetextDetail']['subjectQualifier'];
                                                                    $final_result['segmentNameDetails'][$i]['type'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['freetextDetail']['type'];
                                                                    $final_result['segmentNameDetails'][$i]['otherDataFreetext'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['longFreetext'];
                                                                }
                                                            }
                                                        }
                                                        $SequenceNumber = $SequenceNumber + 1;
                                                        $Queue_PlacePNR = '<?xml version="1.0" encoding="utf-8"?>
																			<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
																				<soapenv:Header>
																					   <Session>
																							  <SessionId>' . $SessionId . '</SessionId>
																							  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																							  <SecurityToken>' . $SecurityToken . '</SecurityToken>
																						</Session>
																				</soapenv:Header>
																				<soapenv:Body>
																					<Queue_PlacePNR xmlns="http://xml.amadeus.com/QUQPCQ_03_1_1A">
																						<placementOption>
																							<selectionDetails>
																								<option>QEQ</option>
																							</selectionDetails>
																						</placementOption>
																						<targetDetails>
																							<targetOffice>
																								<sourceType>
																									<sourceQualifier1>3</sourceQualifier1>
																								</sourceType>
																								<originatorDetails>
																									<inHouseIdentification1>' . $final_result['inHouseIdentification1'] . '</inHouseIdentification1>
																								</originatorDetails>
																							</targetOffice>
																							<queueNumber>
																								<queueDetails>
																									<number>3</number>
																								</queueDetails>
																							</queueNumber>
																							<categoryDetails>
																								<subQueueInfoDetails>
																									<identificationType>C</identificationType>
																									<itemNumber>0</itemNumber>
																								</subQueueInfoDetails>
																							</categoryDetails>
																						</targetDetails>
																						<recordLocator>
																							<reservation>
																								<controlNumber>' . $final_result['controlNumber'] . '</controlNumber>
																							</reservation>
																						</recordLocator>
																					</Queue_PlacePNR>
																				</soapenv:Body>
																			 </soapenv:Envelope>';

                                                        $URL2 = "https://test.webservices.amadeus.com";
                                                        // $URL2 = "https://production.webservices.amadeus.com";
                                                        $soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/QUQPCQ_03_1_1A";

                                                        //echo'<pre/>: Queue_PlacePNR request:<br> ';print_r($Queue_PlacePNR);exit;
                                                        $ch2 = curl_init();
                                                        curl_setopt($ch2, CURLOPT_URL, $URL2);
                                                        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                                        curl_setopt($ch2, CURLOPT_HEADER, 0);
                                                        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                                        curl_setopt($ch2, CURLOPT_POST, 1);
                                                        curl_setopt($ch2, CURLOPT_POSTFIELDS, $Queue_PlacePNR);
                                                        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                                        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                                        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                                        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                                        $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                                        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                                        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                                        // Execute request, store response and HTTP response code
                                                        $data2 = curl_exec($ch2);
                                                        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                                        curl_close($ch2);
                                                        $data2_result = $this->xml2array($data2);
                                                        //echo'<pre/>: data2_result:<br> ';print_r($data2_result);EXIT;	

                                                        if (!empty($data2_result)) {
                                                            if (isset($data2_result['soap:Envelope']['soap:Body']['Queue_PlacePNRReply']['errorReturn'])) {
                                                                echo "Error while executing Queue_PlacePNR";
                                                            }
                                                        } else {
                                                            $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                            unset($_SESSION['amadeus'][$sess_id]);
                                                            $error_msg = "Queue_PlacePNR is empty, Please try again";
                                                            $this->error_page($error_msg);
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                        unset($_SESSION['amadeus'][$sess_id]);
                                                        $error_msg = "PNR_result_final is empty, Please try again";
                                                        $this->error_page($error_msg);
                                                    }
                                                }
                                                else
                                                {
                                                    $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                    unset($_SESSION['amadeus'][$sess_id]);
                                                    $error_msg = "PNR_Retrieve_result is empty, Please try again";
                                                    $this->error_page($error_msg);
                                                }

                                                //echo '<pre/>Final Result: ';print_r($final_result);
                                                $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                unset($_SESSION['amadeus'][$sess_id]);

                                                $data['id'] = $id;
                                                $data['final_result'] = $final_result;
                                                if (($_SESSION[$rand_id]['journey_type'] == "Round") || ($_SESSION[$rand_id]['journey_type'] == "Calendar")) {
                                                    $db_insert_flightDetails_oneway = $flightDetails_oneway;
                                                    $db_insert_flightDetails_return = $flightDetails_return;
                                                    $db_insert_flightDetails1 = $flightDetails1;
                                                    $db_insert_flightDetails2 = $flightDetails2;
                                                    $db_insert_final_result = $final_result;
                                                    $db_insert_value = $value;
                                                    $db_insert_segmentNameDetails = $data['final_result']['segmentNameDetails'];
                                                    $this->Flights_Model->insert_amadeus_booking_details_mtk($db_insert_flightDetails_oneway, $db_insert_flightDetails_return, $db_insert_flightDetails1, $db_insert_flightDetails2, $db_insert_final_result, $db_insert_value);
                                                    $this->Flights_Model->insert_amadeus_passenger_details($db_insert_flightDetails_oneway, $db_insert_final_result, $db_insert_value);
                                                    $this->Flights_Model->insert_amadeus_voucher_details($db_insert_flightDetails_oneway, $db_insert_flightDetails_return, $db_insert_segmentNameDetails, $db_insert_final_result, $db_insert_value);
                                                    $this->voucher_email_round($rand_id, $data);
                                                    $this->voucher_round($rand_id, $data);
                                                }
                                            }
                                        } else {
                                            $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                            unset($_SESSION['amadeus'][$sess_id]);
                                            $error_msg = "PNR Number is not generated, Please try again";
                                            $this->error_page($error_msg);
                                        }
                                    }
                                }
                                else
                                {
                                    $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                    unset($_SESSION['amadeus'][$sess_id]);
                                    $error_msg = "PricePNRWithBookingClass Response is empty, Please try again";
                                    $this->error_page($error_msg);
                                }
                            }
                            
                            else
                            {
								//echo 'helllllllll';die;
                                $Fare_PricePNRWithBookingClass = '<?xml version="1.0" encoding="utf-8"?>
											<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
											 <soapenv:Header>
															  <SessionId>' . $SessionId . '</SessionId>
															  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
											   </soapenv:Header>
											  <soapenv:Body><Fare_PricePNRWithBookingClass xmlns="http://xml.amadeus.com/TPCBRQ_07_3_1A">
													 <overrideInformation>
														<attributeDetails>
															<attributeType>RP</attributeType>
														</attributeDetails>
														<attributeDetails>
															<attributeType>RU</attributeType>
														</attributeDetails>
														<attributeDetails>
															<attributeType>RLO</attributeType>
														</attributeDetails>
													</overrideInformation>
													' . $cur_over . '
												</Fare_PricePNRWithBookingClass>
											</soapenv:Body>
										</soapenv:Envelope>';

                                // echo $Fare_PricePNRWithBookingClass;
                                //$URL2 = "https://test.webservices.amadeus.com";
                                 $URL2 = "https://production.webservices.amadeus.com";
                                $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/TPCBRQ_07_3_1A";

                                $ch2 = curl_init();
                                curl_setopt($ch2, CURLOPT_URL, $URL2);
                                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                curl_setopt($ch2, CURLOPT_HEADER, 0);
                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch2, CURLOPT_POST, 1);
                                curl_setopt($ch2, CURLOPT_POSTFIELDS, $Fare_PricePNRWithBookingClass);
                                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
                                $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                // Execute request, store response and HTTP response code
                                $PricePNRWithBookingClass = curl_exec($ch2);
                                $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                curl_close($ch2);

                                  //  echo $PricePNRWithBookingClass.'<<<<<<<<<<<<<<<<<<<<<<<';
                                $PricePNRWithBookingClass_result = $this->xml2array($PricePNRWithBookingClass);
                                // echo "<pre/>PricePNRWithBookingClass_result Response: <br/>";print_r($PricePNRWithBookingClass_result);exit;

                                if (!empty($PricePNRWithBookingClass_result)) 
                                {
                                    if (isset($PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError'])) {
                                        $errorCategory = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorOrWarningCodeDetails']['errorDetails']['errorCategory'];
                                        $errorCodeOwner = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorOrWarningCodeDetails']['errorDetails']['errorCodeOwner'];
                                        $errorCode = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorOrWarningCodeDetails']['errorDetails']['errorCode'];
                                        $errorWarningDescription = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['applicationError']['errorWarningDescription']['freeText'];
                                        $error_msg = $errorCode . " :-" . $errorWarningDescription . " : " . $errorCategory . " (" . $errorCodeOwner . "), Please Try Again : PricePNRWithBookingClass_result";          // echo $error_msg." PricePNRWithBookingClass_result";
                                        $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                        unset($_SESSION['amadeus'][$sess_id]);
                                        $this->error_page($error_msg);
                                    }
                                    else 
                                    {
                                        $data['PricePNRWithBookingClass_result'] = $PricePNRWithBookingClass_result['soap:Envelope']['soap:Body']['Fare_PricePNRWithBookingClassReply']['fareList'];
                                        $psaList = '';
                                        if (isset($_SESSION[$rand_id]['adults'])) {
                                            if (!empty($_SESSION[$rand_id]['adults'])) {
                                                $psaList.='<psaList>
                                                                    <itemReference>
                                                                            <referenceType>TST</referenceType>
                                                                            <uniqueReference>1</uniqueReference>
                                                                    </itemReference>
                                                            </psaList>';
                                            }
                                        } 
                                        else 
                                        {
                                            $psaList.='';
                                        }
                                        if (isset($_SESSION[$rand_id]['childs'])) 
                                        {
                                            if (!empty($_SESSION[$rand_id]['childs'])) 
                                            {
                                                $psaList.='<psaList>
															<itemReference>
																<referenceType>TST</referenceType>
																<uniqueReference>2</uniqueReference>
															</itemReference>
														</psaList>';
                                            }
                                        } 
                                        else 
                                        {
                                            $psaList.='';
                                        }
                                        if (isset($_SESSION[$rand_id]['infants'])) {
                                            if (!empty($_SESSION[$rand_id]['infants'])) {
                                                $psaList.='<psaList>
															<itemReference>
																<referenceType>TST</referenceType>
																<uniqueReference>3</uniqueReference>
															</itemReference>
														</psaList>';
                                            }
                                        } else {
                                            $psaList.='';
                                        }
                                        $SequenceNumber = $SequenceNumber + 1;
                                        $Ticket_CreateTSTFromPricing = '<?xml version="1.0" encoding="utf-8"?>
																		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
																		 <soapenv:Header>
																						  <SessionId>' . $SessionId . '</SessionId>
																						  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																		   </soapenv:Header>
																		  <soapenv:Body>
																		  <Ticket_CreateTSTFromPricing xmlns="http://xml.amadeus.com/TAUTCQ_04_1_1A">
																					' . $psaList . '
																				</Ticket_CreateTSTFromPricing>
																		</soapenv:Body>
																	</soapenv:Envelope>';

                                        //echo'Fare_PricePNRWithBookingClass Request:<br/>'. $Ticket_CreateTSTFromPricing;		

                                        //$URL2 = "https://test.webservices.amadeus.com";
                                        $URL2 = "https://production.webservices.amadeus.com";
                                        $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/TAUTCQ_04_1_1A";

                                        $ch2 = curl_init();
                                        curl_setopt($ch2, CURLOPT_URL, $URL2);
                                        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                        curl_setopt($ch2, CURLOPT_HEADER, 0);
                                        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt($ch2, CURLOPT_POST, 1);
                                        curl_setopt($ch2, CURLOPT_POSTFIELDS, $Ticket_CreateTSTFromPricing);
                                        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                        $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                        // Execute request, store response and HTTP response code
                                        $Ticket_CreateTSTFromPricing = curl_exec($ch2);
                                        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                        curl_close($ch2);
                                         //echo "Ticket_CreateTSTFromPricing Response: <br/>";print_r($Ticket_CreateTSTFromPricing);exit;
                                        //}
                                        if (!empty($Ticket_CreateTSTFromPricing)) 
                                        {
                                            $Ticket_CreateTSTFromPricing_result = $this->xml2array($Ticket_CreateTSTFromPricing);
                                            //echo'<pre/>: Ticket_CreateTSTFromPricing:<br> ';print_r($Ticket_CreateTSTFromPricing_result);//exit;
                                            $SequenceNumber = $SequenceNumber + 1;
                                            $PNR_AddMultiElements_End = '<?xml version="1.0" encoding="utf-8"?>
                                                                                <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                                                 <soapenv:Header>
                                                                                        <SessionId>' . $SessionId . '</SessionId>
                                                                                        <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                                                   </soapenv:Header>
                                                                                  <soapenv:Body>
                                                                                  <PNR_AddMultiElements xmlns="http://xml.amadeus.com/PNRADD_08_3_1A">
                                                                                        <pnrActions>
                                                                                                <optionCode>10</optionCode>
                                                                                        </pnrActions>
                                                                                        <dataElementsMaster>
                                                                                                <marker1/>
                                                                                                <dataElementsIndiv>
                                                                                                        <elementManagementData>
                                                                                                                <segmentName>RF</segmentName>
                                                                                                        </elementManagementData>
                                                                                                        <freetextData>
                                                                                                                <freetextDetail>
                                                                                                                        <subjectQualifier>3</subjectQualifier>
                                                                                                                        <type>P12</type>
                                                                                                                </freetextDetail>
                                                                                                                <longFreetext>FREE TEXT</longFreetext>
                                                                                                        </freetextData>
                                                                                                </dataElementsIndiv>
                                                                                        </dataElementsMaster>
                                                                                </PNR_AddMultiElements>
                                                                                </soapenv:Body>
                                                                        </soapenv:Envelope>';

                                           // $URL2 = "https://test.webservices.amadeus.com";
                                            $URL2 = "https://production.webservices.amadeus.com";
                                            $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/PNRADD_08_3_1A";
					    //echo $PNR_AddMultiElements_End.'<br />';
                                            $ch2 = curl_init();
                                            curl_setopt($ch2, CURLOPT_URL, $URL2);
                                            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                            curl_setopt($ch2, CURLOPT_HEADER, 0);
                                            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch2, CURLOPT_POST, 1);
                                            curl_setopt($ch2, CURLOPT_POSTFIELDS, $PNR_AddMultiElements_End);
                                            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                            // Execute request, store response and HTTP response code
                                            $PNR_AddMultiElements_End = curl_exec($ch2);
                                            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                            curl_close($ch2);
                                            //echo "PNR_AddMultiElements_End Response: <br/>";print_r($PNR_AddMultiElements_End);//exit;
											
                                            $PNR_AddMultiElements_End_result = $this->xml2array($PNR_AddMultiElements_End);
                                            //echo '<pre/>: PNR_AddMultiElements_End:<br> ';print_r($PNR_AddMultiElements_End_result);exit;
                                            $flag_add = false;
                                            $controlNumber = '';
                                            $companyId = '';
                                            if (!empty($PNR_AddMultiElements_End_result)) {
                                                if (isset($PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply']['pnrHeader']))
                                                    $data['PNR_result_End'] = $PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                else if (isset($PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply']['securityInformation']))
                                                    $data['PNR_result_End'] = $PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                else
                                                    $data['PNR_result_End'] = "";

                                                if (!empty($data['PNR_result_End']))
                                                {
													//echo '<pre />';print_r($data['PNR_result_End']);die;
                                                    if (isset($data['PNR_result_End']['pnrHeader']))
                                                    {
							if(isset($data['PNR_result_End']['pnrHeaderTag']))
                                                        {//echo 'hhhhhaa';die;
                                                            $Error_text = $data['PNR_result_End']['pnrHeaderTag']['statusInformation']['indicator'];
                                                            if ($Error_text == "NHP")
                                                            {
                                                                $Error_type = $data['PNR_result_End']['freetextData']['freetextDetail']['type'];
                                                                $Error_msg = $data['PNR_result_End']['freetextData']['longFreetext'];
                                                                $_SESSION['amadeus'][$sess_id]['SessionStatus'] = "false";
                                                                $error_msg = $Error_msg . " Entry not allowewd in NHP Condition" . " - " . $Error_type . ", Please try again";
                                                                $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                                unset($_SESSION['amadeus'][$sess_id]);
                                                                $this->error_page($error_msg);
                                                            }
                                                        }
                                                        else if (isset($data['PNR_result_End']['generalErrorInfo'])) 
                                                        {
                                                            $error_msg = '';
                                                            $_SESSION['amadeus'][$sess_id]['SessionStatus'] = "false";
                                                            if (!isset($data['PNR_result_End']['generalErrorInfo']['messageErrorText']['text'][0]))
                                                                $error_msg = $data['PNR_result_End']['generalErrorInfo']['messageErrorText']['text'] . ",  Please try again : PNR_result_End GENERAL_ERROR_INFO";
                                                            else {
                                                                for ($gi = 0; $gi < (count($data['PNR_result_End']['generalErrorInfo']['messageErrorText']['text'])); $gi++) {
                                                                    $error_msg.=$data['PNR_result_End']['generalErrorInfo']['messageErrorText']['text'][$gi] . "  ";
                                                                }
                                                                $error_msg.=",  Please try again : PNR_result_End GENERAL_ERROR_INFO";
                                                            }
                                                            $flag_add = true;
                                                            $controlNumber = '';
                                                        }
                                                        else
                                                        {
                                                            if (isset($data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['controlNumber'])) {
                                                                   $controlNumber = $data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['controlNumber'];
                                                                   $companyId = $data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['companyId'];
                                                            }
                                                            else
                                                                   $controlNumber = '';

                                                           $_SESSION[$id]['controlNumber'] = $controlNumber;
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $error_msg = "Error while generating PNR Number, Please try again";
                                                        $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                        unset($_SESSION['amadeus'][$sess_id]);
                                                        $this->error_page($error_msg);
                                                    }
                                                }
                                                else 
                                                {
                                                    $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                    unset($_SESSION['amadeus'][$sess_id]);
                                                    $error_msg = "PNR_result_End is Empty, Please try again";
                                                    $this->error_page($error_msg);
                                                }
                                            }
                                            else
                                            {
                                                $error_msg = "PNR_AddMultiElements_End_result Response is Empty,  Please try again";
                                                $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                unset($_SESSION['amadeus'][$sess_id]);
                                                $this->error_page($error_msg);
                                            }
											//echo 'hellooooooo';die;
                                            if ($flag_add == true) {
                                                $PNR_AddMultiElements_End = '<?xml version="1.0" encoding="utf-8"?>
                                                                                <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                                                 <soapenv:Header>
                                                                                                                  <SessionId>' . $SessionId . '</SessionId>
                                                                                                                  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                                                   </soapenv:Header>
                                                                                  <soapenv:Body>
                                                                                  <PNR_AddMultiElements xmlns="http://xml.amadeus.com/PNRADD_08_3_1A">
                                                                                        <pnrActions>
                                                                                                <optionCode>10</optionCode>
                                                                                        </pnrActions>
                                                                                        <dataElementsMaster>
                                                                                                <marker1/>
                                                                                                <dataElementsIndiv>
                                                                                                        <elementManagementData>
                                                                                                                <segmentName>RF</segmentName>
                                                                                                        </elementManagementData>
                                                                                                        <freetextData>
                                                                                                                <freetextDetail>
                                                                                                                        <subjectQualifier>3</subjectQualifier>
                                                                                                                        <type>P12</type>
                                                                                                                </freetextDetail>
                                                                                                                <longFreetext>FREE TEXT</longFreetext>
                                                                                                        </freetextData>
                                                                                                </dataElementsIndiv>
                                                                                        </dataElementsMaster>
                                                                                </PNR_AddMultiElements>
                                                                                </soapenv:Body>
                                                                        </soapenv:Envelope>';

                                                // echo 'PNR_AddMultiElements_End Request:<br/>'. $PNR_AddMultiElements_End;

                                                //$URL2 = "https://test.webservices.amadeus.com";
                                                $URL2 = "https://production.webservices.amadeus.com";
                                                $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/PNRADD_08_3_1A";

                                                $ch2 = curl_init();
                                                curl_setopt($ch2, CURLOPT_URL, $URL2);
                                                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                                curl_setopt($ch2, CURLOPT_HEADER, 0);
                                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch2, CURLOPT_POST, 1);
                                                curl_setopt($ch2, CURLOPT_POSTFIELDS, $PNR_AddMultiElements_End);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                                curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
                                                $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                                curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                                // Execute request, store response and HTTP response code
                                                $PNR_AddMultiElements_End = curl_exec($ch2);
                                                $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                                curl_close($ch2);
                                                //echo "PNR_AddMultiElements_End Response: <br/>";print_r($PNR_AddMultiElements_End);

                                                $PNR_AddMultiElements_End_result = $this->xml2array($PNR_AddMultiElements_End);
                                               // echo '<pre/>: second time: PNR_AddMultiElements_End:<br> ';print_r($PNR_AddMultiElements_End_result);//exit;

                                                if (isset($PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply']['pnrHeader']))
                                                    $data['PNR_result_End'] = $PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                else if (isset($PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply']['securityInformation']))
                                                    $data['PNR_result_End'] = $PNR_AddMultiElements_End_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                else
                                                    $data['PNR_result_End'] = "";

                                                if (isset($data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['controlNumber'])) {
                                                    $controlNumber = $data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['controlNumber'];
                                                    $companyId = $data['PNR_result_End']['pnrHeader']['reservationInfo']['reservation']['companyId'];
                                                }
                                                else
                                                    $controlNumber = '';
                                            }
                                            if (!empty($controlNumber)) 
                                            {
                                                $SequenceNumber = $SequenceNumber + 1;
                                                $PNR_Retrieve = '<?xml version="1.0" encoding="utf-8"?>
                                                                    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
                                                                     <soapenv:Header>
                                                                            <SessionId>' . $SessionId . '</SessionId>
                                                                            <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
                                                                       </soapenv:Header>
                                                                      <soapenv:Body>
                                                                      <PNR_Retrieve xmlns="http://xml.amadeus.com/PNRRET_08_3_1A">
                                                                                    <retrievalFacts>
                                                                                            <retrieve>
                                                                                                    <type>2</type>
                                                                                            </retrieve>
                                                                                            <reservationOrProfileIdentifier>
                                                                                                    <reservation>
                                                                                                            <controlNumber>' . $controlNumber . '</controlNumber>
                                                                                                    </reservation>
                                                                                            </reservationOrProfileIdentifier>
                                                                                    </retrievalFacts>
                                                                            </PNR_Retrieve>
                                                                    </soapenv:Body>
                                                            </soapenv:Envelope>';

                                               // $URL2 = "https://test.webservices.amadeus.com";
                                                 $URL2 = "https://production.webservices.amadeus.com";
                                                $soapAction = "http://webservices.amadeus.com/1ASIWATOAKB/PNRRET_08_3_1A";
                                                // echo'<pre/>: PNR_Retrieve request:<br> ';print_r($PNR_Retrieve);
                                                $ch2 = curl_init();
                                                curl_setopt($ch2, CURLOPT_URL, $URL2);
                                                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                                curl_setopt($ch2, CURLOPT_HEADER, 0);
                                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                                curl_setopt($ch2, CURLOPT_POST, 1);
                                                curl_setopt($ch2, CURLOPT_POSTFIELDS, $PNR_Retrieve);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
                                                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                                                curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                                                curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                                                $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                                                curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                                                curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                                                // Execute request, store response and HTTP response code
                                                $PNR_Retrieve = curl_exec($ch2);
                                                $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                                                curl_close($ch2);
                                                //echo "PNR_AddMultiElements_End Response: <br/>";print_r($PNR_AddMultiElements_End);
                                                $_SESSION['amadeus'][$sess_id]['SessionStatus'] = "false";

                                                $PNR_Retrieve_result = $this->xml2array($PNR_Retrieve);
                                                //echo'<pre/>: PNR_Retrieve_result:<br> ';print_r($PNR_Retrieve_result); exit;

                                                $final_result = '';
                                                if (!empty($PNR_Retrieve_result)) {
                                                    if (isset($PNR_Retrieve_result['soap:Envelope']['soap:Body']['PNR_Reply']['securityInformation']))
                                                        $data['PNR_result_final'] = $PNR_Retrieve_result['soap:Envelope']['soap:Body']['PNR_Reply'];
                                                    else
                                                        $data['PNR_result_final'] = "";

                                                    if (!empty($data['PNR_result_final'])) 
                                                    {
                                                        $final_result['originatorId'] = $data['PNR_result_final']['sbrPOSDetails']['sbrUserIdentificationOwn']['originIdentification']['originatorId'];
                                                        $final_result['inHouseIdentification1'] = $data['PNR_result_final']['sbrPOSDetails']['sbrUserIdentificationOwn']['originIdentification']['inHouseIdentification1'];
                                                        $final_result['originatorTypeCode'] = $data['PNR_result_final']['sbrPOSDetails']['sbrUserIdentificationOwn']['originatorTypeCode'];
                                                        $final_result['companyId'] = $data['PNR_result_final']['pnrHeader']['reservationInfo']['reservation']['companyId'];
                                                        $final_result['controlNumber'] = $data['PNR_result_final']['pnrHeader']['reservationInfo']['reservation']['controlNumber'];
                                                        $final_result['date'] = $data['PNR_result_final']['pnrHeader']['reservationInfo']['reservation']['date'];
                                                        $final_result['time'] = $data['PNR_result_final']['pnrHeader']['reservationInfo']['reservation']['time'];

                                                        $final_result['typeOfPnrElement'] = $data['PNR_result_final']['securityInformation']['responsibilityInformation']['typeOfPnrElement'];
                                                        $final_result['agentId'] = $data['PNR_result_final']['securityInformation']['responsibilityInformation']['agentId'];

                                                        if (isset($data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][0])) 
                                                        {
                                                            $count = (count($data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv']));
                                                            for ($i = 0; $i < $count; $i++) {
                                                                $segmentName = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['elementManagementData']['segmentName'];
                                                                if ($segmentName == "TK") {
                                                                    $final_result['segmentNameDetails'][$i]['segmentName'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['elementManagementData']['segmentName'];
                                                                    $final_result['segmentNameDetails'][$i]['indicator'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['ticketElement']['ticket']['indicator'];
                                                                    $final_result['segmentNameDetails'][$i]['date'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['ticketElement']['ticket']['date'];
                                                                    $final_result['segmentNameDetails'][$i]['officeId'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['ticketElement']['ticket']['officeId'];
                                                                } else if ($segmentName == "AP") {

                                                                    $final_result['segmentNameDetails'][$i]['segmentName'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['elementManagementData']['segmentName'];
                                                                    $final_result['segmentNameDetails'][$i]['longFreetext'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['longFreetext'];
                                                                    $final_result['segmentNameDetails'][$i]['subjectQualifier'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['freetextDetail']['subjectQualifier'];
                                                                    $final_result['segmentNameDetails'][$i]['type'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['freetextDetail']['type'];
                                                                } else if (($segmentName == "FE") || ($segmentName == "FP") || ($segmentName == "FV")) {
                                                                    $final_result['segmentNameDetails'][$i]['segmentName'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['elementManagementData']['segmentName'];
                                                                    $final_result['segmentNameDetails'][$i]['subjectQualifier'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['freetextDetail']['subjectQualifier'];
                                                                    $final_result['segmentNameDetails'][$i]['type'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['freetextDetail']['type'];
                                                                    $final_result['segmentNameDetails'][$i]['otherDataFreetext'] = $data['PNR_result_final']['dataElementsMaster']['dataElementsIndiv'][$i]['otherDataFreetext']['longFreetext'];
                                                                }
                                                            }
                                                        }
                                                      
                                                    } 
                                                    else 
                                                    {
                                                        $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                        unset($_SESSION['amadeus'][$sess_id]);
                                                        $error_msg = "PNR_result_final is empty, Please try again";
                                                        $this->error_page($error_msg);
                                                    }  
                                                } 
                                                else 
                                                {
                                                    $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                    unset($_SESSION['amadeus'][$sess_id]);
                                                    $error_msg = "PNR_Retrieve_result is empty, Please try again";
                                                    $this->error_page($error_msg);
                                                }

                                                //echo '<pre/>Final Result: ';print_r($final_result);
                                                
                                                $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                unset($_SESSION['amadeus'][$sess_id]);

                                                $data['id'] = $id;
                                                $data['final_result'] = $final_result;

                                                $insert_id = '';

                                                if (isset($_SESSION['logged_in'])) {
                                                    $user_id = $_SESSION['b2c_userid'];
                                                    $agent_id = 0;
                                                    $user_type = 4;
                                                } else {
                                                    $user_id = 0;
                                                    $agent_id = 0;
                                                    $user_type = 4;
                                                }

                                                if ($res['journey_type'] == "Round_oneway") 
                                                {
                                                    $db_insert_flightDetails_oneway = $flightDetails_oneway;
                                                    $db_insert_flightDetails_return = $flightDetails_return;
                                                    
                                                    $db_insert_final_result = $final_result;
                                                    $db_insert_value = $value;
                                                    $db_insert_segmentNameDetails = $data['final_result']['segmentNameDetails'];
                                                    
													/*echo "<pre>"; print_r($final_result);
													echo "<pre>"; print_r($_POST);
													echo "<pre>"; print_r($db_insert_flightDetails); die;*/
													
                                                    $pnr_id = $this->Flights_Model->final_response_details_booking($final_result,$_POST);
                                                    $this->Flights_Model->booking_airline_details($db_insert_flightDetails_oneway,$pnr_id);
                                                    $this->Flights_Model->booking_airline_details($db_insert_flightDetails_return,$pnr_id);
                                                    $this->Flights_Model->bookingpassenger_details($_POST,$pnr_id);
                                                    
                                                    //echo $pnr_id.'<<<>>>';die;
                                                    redirect('flights/thankyou/'.$pnr_id,'refresh');
                                                } 
                                                else if (($_SESSION[$rand_id]['journey_type'] == "MultiCity")) 
                                                {
                                                    $this->voucher_email_multicity($rand_id, $data);
                                                    $this->voucher_multicity($rand_id, $data);
                                                } 
                                                else 
                                                {
                                                    $db_insert_flightDetails = $flightDetails;
                                                    $db_insert_flightDetails1 = $flightDetails;
                                                    $db_insert_final_result = $final_result;
                                                    $db_insert_value = $value;
                                                    $db_insert_segmentNameDetails = $data['final_result']['segmentNameDetails'];
                                                    
													/*echo "<pre>"; print_r($final_result);
													echo "<pre>"; print_r($_POST);
													echo "<pre>"; print_r($db_insert_flightDetails); die;*/
													
                                                    $pnr_id = $this->Flights_Model->final_response_details_booking($final_result,$_POST);
                                                    $this->Flights_Model->booking_airline_details($db_insert_flightDetails,$pnr_id);
                                                    $this->Flights_Model->bookingpassenger_details($_POST,$pnr_id);
                                                    
                                                    $myFile = $_SESSION['file_num']."-".$_SESSION['akbar_session']."booking_xml_request.txt";
                                                    $fh = fopen('xmllogs/'.$myFile, 'w','r');
                                                    $stringData = "Booking XML Request".$SellFromRecommendation." ".$PNR_AddMultiElements." ".$Fare_PricePNRWithBookingClass." ".$Ticket_CreateTSTFromPricing." ".$Fare_PricePNRWithBookingClass." ".$Ticket_CreateTSTFromPricing." ".$PNR_AddMultiElements_End;
                                                    fwrite($fh, $stringData);
                                                    fclose($fh);

                                                    $myFile1 = $_SESSION['file_num']."-".$_SESSION['akbar_session']."booking_xml_response.txt";
                                                    $fh1 = fopen('xmllogs/'.$myFile1, 'w','r');
                                                    $stringData = "Booking XML Response ".$dataSellFromRecommendation." ".$PNRAddMultiElements." ".$PricePNRWithBookingClass." ".$Ticket_CreateTSTFromPricing." ".$PricePNRWithBookingClass." ".$Ticket_CreateTSTFromPricing." ".$PNR_AddMultiElements_Endres;
                                                    fwrite($fh1, $stringData);
                                                    fclose($fh1);

                                                    //exit;
                                                    $method = 'Booking XML';
                                                    //echo $myFile; exit;

                                                    $this->Flights_Model->insert_logs_security($_SESSION['akbar_session'],$method,$myFile,$myFile1,$_SESSION['journey_type']);
											
                                                    redirect('flights/thankyou/'.$pnr_id,'refresh');
                                                }
                                            } 
                                            else 
                                            {
                                                $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                                unset($_SESSION['amadeus'][$sess_id]);
                                                $error_msg = "PNR Number is not generated, Please try again";
                                                $this->error_page($error_msg);
                                            }
                                        }
                                        else
                                        {
                                            $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                            unset($_SESSION['amadeus'][$sess_id]);
                                            $error_msg = "Ticket_CreateTSTFromPricing Response is Empty, Please Try again";
                                            $this->error_page($error_msg);
                                        }
                                    }
                                }
                                else
                                {
                                    $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                                    unset($_SESSION['amadeus'][$sess_id]);
                                    $error_msg = "PricePNRWithBookingClass Response is empty, Please try again";
                                    $this->error_page($error_msg);
                                }
                            }
                        
                        }
                    } else {
                        $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                        unset($_SESSION['amadeus'][$sess_id]);
                        $error_msg = " PNR_result is empty, Please try again";
                        $this->error_page($error_msg);
                    }
                } else {
                    $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                    unset($_SESSION['amadeus'][$sess_id]);
                    $error_msg = " PNRAddMultiElements Response is Empty, Please try again";
                    $this->error_page($error_msg);
                }
            } else {
                $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
                unset($_SESSION['amadeus'][$sess_id]);
                if (!isset($status_msg[0])) {
                    $error_msg = " Unable to Sold Segment, Please try again<br/>Status Message :" . $status_msg;
                } else {
                    $error_msg = " Unable to Sold Segment, Please try again<br/>Status Message : ";
                    for ($si = 0; $si < (count($status_msg)); $si++) {
                        $error_msg.=$status_msg[$si] . " ";
                    }
                }
                $this->error_page($error_msg);
            }
        } else {
            $this->sign_out($SessionId, $SequenceNumber, $SecurityToken);
            unset($_SESSION['amadeus'][$sess_id]);
            $error_msg = " Unable to retrieve the Segment Information, Please try again";
            $this->error_page($error_msg);
        }
    }
	function thankyou($id)
	{
		$data['id'] = $id;
		$this->load->view('thankyou',$data);
	}
	function sign_out($Id, $Number, $Token)
    {
        $SessionId = $Id;
        $SequenceNumber = $Number;
        $SecurityToken = $Token;
        $Security_SignOut = '<?xml version="1.0" encoding="utf-8"?>
									<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
										<soapenv:Header>
													  <SessionId>' . $SessionId . '</SessionId>
													  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
										</soapenv:Header>
										<soapenv:Body>
											<Security_SignOut xmlns="http://xml.amadeus.com/VLSSOQ_04_1_1A">
											</Security_SignOut>
										</soapenv:Body>
									 </soapenv:Envelope>';

        $URL2 = "https://test.webservices.amadeus.com";
        $soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/VLSSOQ_04_1_1A";


        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $URL2);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_POSTFIELDS, $Security_SignOut);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

        $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
        curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

        // Execute request, store response and HTTP response code
        $data2 = curl_exec($ch2);
        $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        curl_close($ch2);
    }
    
    function get_voucher($id)
	{
		$data['id']=$id;
		$this->load->view('voucher',$data);
	}

    
	
	function xml2array($xmlStr, $get_attributes = 1, $priority = 'tag')
    {
        // I renamed $url to $xmlStr, $url was the first parameter in the method if you
        // want to load from a URL then rename $xmlStr to $url everywhere in this method
        $contents = "";
        if (!function_exists('xml_parser_create')) {
            return array();
        }
        $parser = xml_parser_create('');
        // commented out since I already have the xml text stored in memory 
        // this reads XML in from a URL
        /* 	    
          if (!($fp = @ fopen($url, 'rb')))
          {
          return array ();
          }
          while (!feof($fp))
          {
          $contents .= fread($fp, 8192);
          }
          fclose($fp);
         */
        xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, trim($xmlStr), $xml_values);
        xml_parser_free($parser);
        if (!$xml_values)
            return; //Hmm...
        $xml_array = array();
        $parents = array();
        $opened_tags = array();
        $arr = array();
        $current = & $xml_array;
        $repeated_tag_index = array();
        foreach ($xml_values as $data) {
            unset($attributes, $value);
            extract($data);
            $result = array();
            $attributes_data = array();
            if (isset($value)) {
                if ($priority == 'tag')
                    $result = $value;
                else
                    $result['value'] = $value;
            }
            if (isset($attributes) and $get_attributes) {
                foreach ($attributes as $attr => $val) {
                    if ($priority == 'tag')
                        $attributes_data[$attr] = $val;
                    else
                        $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
                }
            }
            if ($type == "open") {
                $parent[$level - 1] = & $current;
                if (!is_array($current) or (!in_array($tag, array_keys($current)))) {
                    $current[$tag] = $result;
                    if ($attributes_data)
                        $current[$tag . '_attr'] = $attributes_data;
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    $current = & $current[$tag];
                }
                else {
                    if (isset($current[$tag][0])) {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                        $repeated_tag_index[$tag . '_' . $level]++;
                    } else {
                        $current[$tag] = array(
                            $current[$tag],
                            $result
                        );
                        $repeated_tag_index[$tag . '_' . $level] = 2;
                        if (isset($current[$tag . '_attr'])) {
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset($current[$tag . '_attr']);
                        }
                    }
                    $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                    $current = & $current[$tag][$last_item_index];
                }
            } elseif ($type == "complete") {
                if (!isset($current[$tag])) {
                    $current[$tag] = $result;
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $attributes_data)
                        $current[$tag . '_attr'] = $attributes_data;
                }
                else {
                    if (isset($current[$tag][0]) and is_array($current[$tag])) {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                        if ($priority == 'tag' and $get_attributes and $attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                        }

                        $repeated_tag_index[$tag . '_' . $level]++;
                    } else {
                        $current[$tag] = array(
                            $current[$tag],
                            $result
                        );
                        $repeated_tag_index[$tag . '_' . $level] = 1;
                        if ($priority == 'tag' and $get_attributes) {
                            if (isset($current[$tag . '_attr'])) {
                                $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                                unset($current[$tag . '_attr']);
                            }
                            if ($attributes_data) {
                                $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                            }
                        }
                        $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                    }
                }
            } elseif ($type == 'close') {
                $current = & $parent[$level - 1];
            }
        }
        return ($xml_array);
    }
	function error_page($msg)
	{
		$data['msg'] = $msg;
		$this->load->view('error_page',$data);
	}
	
	public function hotel_in_search()
	{
		//echo "<pre>"; print_r($this->session->userdata); exit;
		$cin1 = $this->session->userdata('sd');
		$cin2 = explode('-',$cin1);
		$cin1 = $cin2['2']."-".$cin2[1]."-".$cin2[0];
		if($this->session->userdata('ed') != '')
		{
			$cout1 = date('Y-m-d',strtotime($cin1.'+1 day')); 
		}
		else
		{
			$cout1 = $this->session->userdata('ed');	
		}
		
		$cin2 = explode('-',$cin1);
		$cin = $cin2[1]."/".$cin2[2]."/".$cin2[0];
		
		$cout2 = explode('-',$cout1);
		$cout = $cout2[1]."/".$cout2[2]."/".$cout2[0];
		
		$fromcity = $this->session->userdata('fromcityval');
		$tocityval = $this->session->userdata('tocityval');
		
		$city = explode('-',$tocityval);
		$city1 = $city[0];
		$citycode = $this->Flights_Model->get_exp_citycode(trim($city1));
		$DestinationID = $citycode->DestinationID;
		
		 $apiKey='yenghyyycks8eufhga3yh9hf';
		 $this->client_id;
		 $this->api_url;
		 $this->username;
		 $this->password;
		 $url  = 'http://api.ean.com/ean-services/rs/hotel/v3/list?minorRev=99';
         $url .= '&apiKey=dcfxhbbdt4phacd7npcjwz48';
         $url .= '&cid=447925';
         $url .= '&locale=en_US&numberOfResults=2';
         $url .= '&searchRadius=50';
         $url .= '&supplierCacheTolerance=MED_ENHANCED';
         $url .= '&destinationId='.$DestinationID.'';
         $url .= '&arrivalDate='.$cin.'&departureDate='.$cout;
		  $_SESSION["hotel_search"]["room_count"] = 1;
		  $_SESSION["hotel_search"]["child"][0] = 0;
		  $_SESSION["hotel_search"]["adult"][0] = $this->session->userdata('adults');
         for($r=0;$r<$_SESSION["hotel_search"]["room_count"]; $r++)
         {
             $rm=$r+1;
             if($_SESSION["hotel_search"]["child"][$r]!='' || $_SESSION["hotel_search"]["child"][$r]!=0)
             {
                 $childAge='';
                 
                 //$ageCount=count($_SESSION["hotel_search"]["child_age"][$r]);
                 $ageCount = 0;
                 if($ageCount >1)
                 {
                     $url.='&room'.$rm.'='.$_SESSION["hotel_search"]["adult"][$r].','.implode(',',$_SESSION["hotel_search"]["child_age"][$r]);
                 }
                 else
                 $url.='&room'.$rm.'='.$_SESSION["hotel_search"]["adult"][$r].','.$_SESSION["hotel_search"]["child_age"][$r][0];
              }
              else
              {
                 $url.='&room'.$rm.'='.$_SESSION["hotel_search"]["adult"][$r];
              }
           }
//echo $url; die;
            $response=$this->getCurl($url);
            //print_r($response);
            $xml = new DOMDocument();
            $xml->loadXML($response);
            $_SESSION['customerSessionId']='';
            $_SESSION['filters']='';
            $numberOfRoomsRequested=$customerSessionId=$moreResultsAvailable=$cacheKey=$cacheLocation='';
            if($xml->getElementsByTagName('HotelList')->length > 0)
            {
                if($xml->getElementsByTagName('numberOfRoomsRequested')->length > 0)
                $numberOfRoomsRequested=$xml->getElementsByTagName('numberOfRoomsRequested')->item(0)->nodeValue;
            
                if($xml->getElementsByTagName('customerSessionId')->length > 0)
                {
                    $customerSessionId=$xml->getElementsByTagName('customerSessionId')->item(0)->nodeValue;
                    $_SESSION['customerSessionId']=$customerSessionId;
                }

                if($xml->getElementsByTagName('moreResultsAvailable')->length > 0)
                    $moreResultsAvailable=$xml->getElementsByTagName('moreResultsAvailable')->item(0)->nodeValue;

                if($xml->getElementsByTagName('cacheKey')->length > 0)
                    $cacheKey=$xml->getElementsByTagName('cacheKey')->item(0)->nodeValue;

                if($xml->getElementsByTagName('cacheLocation')->length > 0)
                    $cacheLocation=$xml->getElementsByTagName('cacheLocation')->item(0)->nodeValue;
                
                if($xml->getElementsByTagName('HotelList')->item(0)->getElementsByTagName('HotelSummary')->length > 0)
                {
                    $HotelSummary=$xml->getElementsByTagName('HotelList')->item(0)->getElementsByTagName('HotelSummary');
                    foreach($HotelSummary as $hotels)
                    {
                       $hotelId=$hotels->getElementsByTagName('hotelId')->item(0)->nodeValue;
                       $name=$hotels->getElementsByTagName('name')->item(0)->nodeValue;
                       $address1=$hotels->getElementsByTagName('address1')->item(0)->nodeValue;
                       $city=$hotels->getElementsByTagName('city')->item(0)->nodeValue;
                       $countryCode=$hotels->getElementsByTagName('countryCode')->item(0)->nodeValue;
                       $supplierType=$hotels->getElementsByTagName('supplierType')->item(0)->nodeValue;
                       $propertyCategory=$hotels->getElementsByTagName('propertyCategory')->item(0)->nodeValue;
                       $hotelRating=$hotels->getElementsByTagName('hotelRating')->item(0)->nodeValue;
                       $confidenceRating=$hotels->getElementsByTagName('confidenceRating')->item(0)->nodeValue;
                       $amenityMask=$hotels->getElementsByTagName('amenityMask')->item(0)->nodeValue;
                       $tripAdvisorRating=$tripAdvisorReviewCount=$tripAdvisorRatingUrl='';
                       if($hotels->getElementsByTagName('tripAdvisorRating')->length > 0)
                            $tripAdvisorRating=$hotels->getElementsByTagName('tripAdvisorRating')->item(0)->nodeValue;
                       if($hotels->getElementsByTagName('tripAdvisorReviewCount')->length > 0)
                            $tripAdvisorReviewCount=$hotels->getElementsByTagName('tripAdvisorReviewCount')->item(0)->nodeValue;
                       if($hotels->getElementsByTagName('tripAdvisorRatingUrl')->length > 0)
                            $tripAdvisorRatingUrl=$hotels->getElementsByTagName('tripAdvisorRatingUrl')->item(0)->nodeValue;
                       $locationDescription=$hotels->getElementsByTagName('locationDescription')->item(0)->nodeValue;
                       $shortDescription=$hotels->getElementsByTagName('shortDescription')->item(0)->nodeValue;
                       $highRate=$hotels->getElementsByTagName('highRate')->item(0)->nodeValue;
                       $lowRate=$hotels->getElementsByTagName('lowRate')->item(0)->nodeValue;
                       $rateCurrencyCode=$hotels->getElementsByTagName('rateCurrencyCode')->item(0)->nodeValue;
                       $latitude=$hotels->getElementsByTagName('latitude')->item(0)->nodeValue;
                       $longitude=$hotels->getElementsByTagName('longitude')->item(0)->nodeValue;
                       $proximityDistance=$hotels->getElementsByTagName('proximityDistance')->item(0)->nodeValue;
                       $proximityUnit=$hotels->getElementsByTagName('proximityUnit')->item(0)->nodeValue;
                       $hotelInDestination=$hotels->getElementsByTagName('hotelInDestination')->item(0)->nodeValue;
                       $thumbNailUrl=$hotels->getElementsByTagName('thumbNailUrl')->item(0)->nodeValue;
                       $deepLink=$hotels->getElementsByTagName('deepLink')->item(0)->nodeValue;
                       
                       if($hotels->getElementsByTagName('RoomRateDetailsList')->length > 0 && $hotels->getElementsByTagName('RoomRateDetails')->length >0)
                       {
                           $roomDetails=$hotels->getElementsByTagName('RoomRateDetails');
                           foreach($roomDetails as $details)
                           {
                               $roomTypeCode=$details->getElementsByTagName('roomTypeCode')->item(0)->nodeValue;
                               $rateCode=$details->getElementsByTagName('rateCode')->item(0)->nodeValue;
                               $maxRoomOccupancy=$details->getElementsByTagName('maxRoomOccupancy')->item(0)->nodeValue;
                               $quotedRoomOccupancy=$details->getElementsByTagName('quotedRoomOccupancy')->item(0)->nodeValue;
                               $minGuestAge=$details->getElementsByTagName('minGuestAge')->item(0)->nodeValue;
                               $roomDescription=$details->getElementsByTagName('roomDescription')->item(0)->nodeValue;
                               $propertyAvailable=$details->getElementsByTagName('propertyAvailable')->item(0)->nodeValue;
                               $propertyRestricted=$details->getElementsByTagName('propertyRestricted')->item(0)->nodeValue;
                               
                                $promo='';
                                $total = '';
                                $surchargeTotal = '';
                                $nightlyRate = '';
                                $nightlybaseRate = '';
                                $currencyCode = '';
                                $commissionableUsdTotal = '';
                                $averageRate = '';
                                $averageBaseRate = '';
                                $nonRefundable='';
                                $currentAllotment='';
                               if($details->getElementsByTagName('RateInfos')->length > 0 && $details->getElementsByTagName('RateInfo')->length > 0)
                               {
                                   $promo=$details->getElementsByTagName('RateInfo')->item(0)->getAttribute('promo');
                                   $total=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getAttribute('total');
                                   $currencyCode=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getAttribute('currencyCode');
                                   $averageBaseRate=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getAttribute('averageBaseRate');
                                   $averageRate=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getAttribute('averageRate');
                                   $nightly=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getElementsByTagName('NightlyRatesPerRoom');
                                   $nightlyRate=$nightly->item(0)->getAttribute('rate');
                                   $nightlybaseRate=$nightly->item(0)->getAttribute('baseRate');
                                   $nonRefundable=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('nonRefundable')->item(0)->nodeValue;
                                   $currentAllotment=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('currentAllotment')->item(0)->nodeValue;
                               }
                               
                               $tempData[]=array(
                                   'session_id'=>'',
                                   'api'=>'expedia',
                                   'hotelId'=>$hotelId,
                                   'name'=>$name,
                                   'address1'=>$address1,
                                   'city'=>$city,
                                   'countryCode'=>$countryCode,
                                   'supplierType'=>$supplierType,
                                   'propertyCategory'=>$propertyCategory,
                                   'hotelRating'=>$hotelRating,
                                   'confidenceRating'=>$confidenceRating,
                                   'amenityMask'=>$amenityMask,
                                   'tripAdvisorRating'=>$tripAdvisorRating,
                                   'tripAdvisorReviewCount'=>$tripAdvisorReviewCount,
                                   'tripAdvisorRatingUrl'=>$tripAdvisorRatingUrl,
                                   'locationDescription'=>$locationDescription,
                                   'shortDescription'=>$shortDescription,
                                   'highRate'=>$highRate,
                                   'lowRate'=>$lowRate,
                                   'rateCurrencyCode'=>$rateCurrencyCode,
                                   'latitude'=>$latitude,
                                   'longitude'=>$longitude,
                                   'proximityDistance'=>$proximityDistance,
                                   'proximityUnit'=>$proximityUnit,
                                   'hotelInDestination'=>$hotelInDestination,
                                   'thumbNailUrl'=>$thumbNailUrl,
                                   'deepLink'=>$deepLink,
                                   'roomTypeCode'=>$roomTypeCode,
                                   'rateCode'=>$rateCode,
                                   'maxRoomOccupancy'=>$maxRoomOccupancy,
                                   'quotedRoomOccupancy'=>$quotedRoomOccupancy,
                                   'minGuestAge'=>$minGuestAge,
                                   'roomDescription'=>$roomDescription,
                                   'propertyAvailable'=>$propertyAvailable,
                                   'propertyRestricted'=>$propertyRestricted,
                                   'promo'=>$promo,
                                   'total'=>$total,
                                   'currencyCode'=>$currencyCode,
                                   'averageBaseRate'=>$averageBaseRate,
                                   'averageRate'=>$averageRate,
                                   'nightlyRate'=>$nightlyRate,
                                   'nightlybaseRate'=>$nightlybaseRate,
                                   'nonRefundable'=>$nonRefundable,
                                   'currentAllotment'=>$currentAllotment
                               );
                           }
                       }
                       $_SESSION['filters']['location_list'][]=$locationDescription;
                       $_SESSION['filters']['type_list'][]=$propertyCategory;
                       $_SESSION['customerSessionId']=$customerSessionId;
                    }
                    
                   // $this->db->query($sql="delete from api_hotel_detail_t where session_id='".$_SESSION['hotel_search']['session_id']."'");
                    //$this->db->query($sql="delete from api_hotel_room_detail_t where session_id='".$_SESSION['hotel_search']['session_id']."'");
                    $this->db->insert_batch('api_hotel_detail_t',$tempData);
                }
                
                if($moreResultsAvailable=='true')
                {
                    $url  = 'http://api.ean.com/ean-services/rs/hotel/v3/list?minorRev=99';
                    $url .= '&apiKey=dcfxhbbdt4phacd7npcjwz48';
                    $url .= '&cid=447925';
                    $url .='&cacheKey='.$cacheKey.'&cacheLocation='.$cacheLocation;
                    $response1=$this->getCurl($url);
                    $xml1 = new DOMDocument();
                    $xml1->loadXML($response1);
                    if($xml1->getElementsByTagName('HotelList')->length > 0)
                    {
                        if($xml1->getElementsByTagName('numberOfRoomsRequested')->length > 0)
                        $numberOfRoomsRequested=$xml->getElementsByTagName('numberOfRoomsRequested')->item(0)->nodeValue;
                        
                        if($xml1->getElementsByTagName('customerSessionId')->length > 0)
                        {
                            $customerSessionId=$xml->getElementsByTagName('customerSessionId')->item(0)->nodeValue;
                        }

                        if($xml1->getElementsByTagName('moreResultsAvailable')->length > 0)
                            $moreResultsAvailable=$xml->getElementsByTagName('moreResultsAvailable')->item(0)->nodeValue;

                        if($xml1->getElementsByTagName('cacheKey')->length > 0)
                            $cacheKey=$xml->getElementsByTagName('cacheKey')->item(0)->nodeValue;

                        if($xml1->getElementsByTagName('cacheLocation')->length > 0)
                            $cacheLocation=$xml->getElementsByTagName('cacheLocation')->item(0)->nodeValue;

                        if($xml1->getElementsByTagName('HotelList')->item(0)->getElementsByTagName('HotelSummary')->length > 0)
                        {
                            $HotelSummary=$xml1->getElementsByTagName('HotelList')->item(0)->getElementsByTagName('HotelSummary');
                            foreach($HotelSummary as $hotels)
                            {
                               $hotelId=$hotels->getElementsByTagName('hotelId')->item(0)->nodeValue;
                               $name=$hotels->getElementsByTagName('name')->item(0)->nodeValue;
                               $address1=$hotels->getElementsByTagName('address1')->item(0)->nodeValue;
                               $city=$hotels->getElementsByTagName('city')->item(0)->nodeValue;
                               $countryCode=$hotels->getElementsByTagName('countryCode')->item(0)->nodeValue;
                               $supplierType=$hotels->getElementsByTagName('supplierType')->item(0)->nodeValue;
                               $propertyCategory=$hotels->getElementsByTagName('propertyCategory')->item(0)->nodeValue;
                               $hotelRating=$hotels->getElementsByTagName('hotelRating')->item(0)->nodeValue;
                               $confidenceRating=$hotels->getElementsByTagName('confidenceRating')->item(0)->nodeValue;
                               $amenityMask=$hotels->getElementsByTagName('amenityMask')->item(0)->nodeValue;
                               if($hotels->getElementsByTagName('tripAdvisorRating')->length > 0)
                                    $tripAdvisorRating=$hotels->getElementsByTagName('tripAdvisorRating')->item(0)->nodeValue;
                               if($hotels->getElementsByTagName('tripAdvisorReviewCount')->length > 0)
                                    $tripAdvisorReviewCount=$hotels->getElementsByTagName('tripAdvisorReviewCount')->item(0)->nodeValue;
                               if($hotels->getElementsByTagName('tripAdvisorRatingUrl')->length > 0)
                                    $tripAdvisorRatingUrl=$hotels->getElementsByTagName('tripAdvisorRatingUrl')->item(0)->nodeValue;
                               $locationDescription=$hotels->getElementsByTagName('locationDescription')->item(0)->nodeValue;
                               $shortDescription=$hotels->getElementsByTagName('shortDescription')->item(0)->nodeValue;
                               $highRate=$hotels->getElementsByTagName('highRate')->item(0)->nodeValue;
                               $lowRate=$hotels->getElementsByTagName('lowRate')->item(0)->nodeValue;
                               $rateCurrencyCode=$hotels->getElementsByTagName('rateCurrencyCode')->item(0)->nodeValue;
                               $latitude=$hotels->getElementsByTagName('latitude')->item(0)->nodeValue;
                               $longitude=$hotels->getElementsByTagName('longitude')->item(0)->nodeValue;
                               $proximityDistance=$hotels->getElementsByTagName('proximityDistance')->item(0)->nodeValue;
                               $proximityUnit=$hotels->getElementsByTagName('proximityUnit')->item(0)->nodeValue;
                               $hotelInDestination=$hotels->getElementsByTagName('hotelInDestination')->item(0)->nodeValue;
                               $thumbNailUrl=$hotels->getElementsByTagName('thumbNailUrl')->item(0)->nodeValue;
                               $deepLink=$hotels->getElementsByTagName('deepLink')->item(0)->nodeValue;

                               if($hotels->getElementsByTagName('RoomRateDetailsList')->length > 0 && $hotels->getElementsByTagName('RoomRateDetails')->length >0)
                               {
                                   $roomDetails=$hotels->getElementsByTagName('RoomRateDetails');
                                   foreach($roomDetails as $details)
                                   {
                                       $roomTypeCode=$details->getElementsByTagName('roomTypeCode')->item(0)->nodeValue;
                                       $rateCode=$details->getElementsByTagName('rateCode')->item(0)->nodeValue;
                                       $maxRoomOccupancy=$details->getElementsByTagName('maxRoomOccupancy')->item(0)->nodeValue;
                                       $quotedRoomOccupancy=$details->getElementsByTagName('quotedRoomOccupancy')->item(0)->nodeValue;
                                       $minGuestAge=$details->getElementsByTagName('minGuestAge')->item(0)->nodeValue;
                                       $roomDescription=$details->getElementsByTagName('roomDescription')->item(0)->nodeValue;
                                       $propertyAvailable=$details->getElementsByTagName('propertyAvailable')->item(0)->nodeValue;
                                       $propertyRestricted=$details->getElementsByTagName('propertyRestricted')->item(0)->nodeValue;

                                        $promo='';
                                        $total = '';
                                        $surchargeTotal = '';
                                        $nightlyRate = '';
                                        $nightlybaseRate = '';
                                        $currencyCode = '';
                                        $commissionableUsdTotal = '';
                                        $averageRate = '';
                                        $averageBaseRate = '';
                                        $nonRefundable='';
                                        $currentAllotment='';
                                       if($details->getElementsByTagName('RateInfos')->length > 0 && $details->getElementsByTagName('RateInfo')->length > 0)
                                       {
                                           $promo=$details->getElementsByTagName('RateInfo')->item(0)->getAttribute('promo');
                                           $total=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getAttribute('total');
                                           $currencyCode=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getAttribute('currencyCode');
                                           $averageBaseRate=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getAttribute('averageBaseRate');
                                           $averageRate=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getAttribute('averageRate');
                                           $nightly=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('ChargeableRateInfo')->item(0)->getElementsByTagName('NightlyRatesPerRoom');
                                           $nightlyRate=$nightly->item(0)->getAttribute('rate');
                                           $nightlybaseRate=$nightly->item(0)->getAttribute('baseRate');
                                           $nonRefundable=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('nonRefundable')->item(0)->nodeValue;
                                           $currentAllotment=$details->getElementsByTagName('RateInfo')->item(0)->getElementsByTagName('currentAllotment')->item(0)->nodeValue;
                                       }

                                       $tempData1[]=array(
                                           'session_id'=>'',
                                           'api'=>'expedia',
                                           'hotelId'=>$hotelId,
                                           'name'=>$name,
                                           'address1'=>$address1,
                                           'city'=>$city,
                                           'countryCode'=>$countryCode,
                                           'supplierType'=>$supplierType,
                                           'propertyCategory'=>$propertyCategory,
                                           'hotelRating'=>$hotelRating,
                                           'confidenceRating'=>$confidenceRating,
                                           'amenityMask'=>$amenityMask,
                                           'tripAdvisorRating'=>$tripAdvisorRating,
                                           'tripAdvisorReviewCount'=>$tripAdvisorReviewCount,
                                           'tripAdvisorRatingUrl'=>$tripAdvisorRatingUrl,
                                           'locationDescription'=>$locationDescription,
                                           'shortDescription'=>$shortDescription,
                                           'highRate'=>$highRate,
                                           'lowRate'=>$lowRate,
                                           'rateCurrencyCode'=>$rateCurrencyCode,
                                           'latitude'=>$latitude,
                                           'longitude'=>$longitude,
                                           'proximityDistance'=>$proximityDistance,
                                           'proximityUnit'=>$proximityUnit,
                                           'hotelInDestination'=>$hotelInDestination,
                                           'thumbNailUrl'=>$thumbNailUrl,
                                           'deepLink'=>$deepLink,
                                           'roomTypeCode'=>$roomTypeCode,
                                           'rateCode'=>$rateCode,
                                           'maxRoomOccupancy'=>$maxRoomOccupancy,
                                           'quotedRoomOccupancy'=>$quotedRoomOccupancy,
                                           'minGuestAge'=>$minGuestAge,
                                           'roomDescription'=>$roomDescription,
                                           'propertyAvailable'=>$propertyAvailable,
                                           'propertyRestricted'=>$propertyRestricted,
                                           'promo'=>$promo,
                                           'total'=>$total,
                                           'currencyCode'=>$currencyCode,
                                           'averageBaseRate'=>$averageBaseRate,
                                           'averageRate'=>$averageRate,
                                           'nightlyRate'=>$nightlyRate,
                                           'nightlybaseRate'=>$nightlybaseRate,
                                           'nonRefundable'=>$nonRefundable,
                                           'currentAllotment'=>$currentAllotment
                                       );
                                   }
                               }
                                $_SESSION['filters']['location_list'][]=$locationDescription;
                                $_SESSION['filters']['type_list'][]=$propertyCategory;
                            }
                            $this->db->insert_batch('api_hotel_detail_t',$tempData1);
                        }
                    }
                }
            }
     $this->hotel_in_search2();
	}
	function hotel_in_search2()
	{
		$data['results'] = $this->Flights_Model->get_hotels();
		
        $hotel_search_result = $this->load->view('hotel_details', $data, true);
        //$locations = $this->load->view('search_result_ajax_location',$data1,true);
        //$types = $this->load->view('search_result_ajax_types',$data2,true);
        echo json_encode(array(
             'hotel_search_result2' => $hotel_search_result,
              
               ));
	}
	function getCurl($url)
    {	
        $header[] = "Accept: application/xml";
        $header[] = "Accept-Encoding: gzip";
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt($ch,CURLOPT_ENCODING , "gzip");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $response=curl_exec($ch);
        return $response;
    }
     
}
