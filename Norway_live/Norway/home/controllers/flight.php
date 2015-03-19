<?php

/*----- code by shubhalaxmi-------*/
/*----- Controller name:Flight.php-------*/
/*----- Model Used:Home_Model.php,Flight_Model-------*/
/*----- Project Name:Norway-------*/
/*----- Project Framework:Codeignator-------*/


session_start();
ini_set("memory_limit",-1);
error_reporting(0);
class Flight extends CI_Controller {

	public function __construct()
    {
	    parent::__construct();
		$this->load->helper('cookie');
		$this->load->model('Home_Model');
		$this->load->model('Flight_Model');
		if(!isset($_SESSION['norway_session']) || $_SESSION['norway_session']=='')
        {
            $_SESSION['norway_session'] = date('ymd').rand(1, 999999);
        }
	}
	
	
	function flight_search_result()
	{
	
	
		header('Cache-Control: max-age=900');
		$_SESSION['session_id']=session_id();
		if ((isset($_POST['from_city'])) && (isset($_POST['to_city'])))
		{
				$_SESSION['hashing_activate'] = '';
				$adult_count = $_POST['adult'];
				$child_count = $_POST['child'];
				$infant_count = $_POST['infant'];
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
				
				$this->session->set_userdata(array('fromcityval'=>$_POST['from_city'],'tocityval'=>$_POST['to_city'],'sd'=>$_POST['sd'],
				'ed'=>$_POST['ed'],'adults'=>$adult_count,'childs'=>$child_count,'infants'=>$infant_count,
				'journey_types'=>$_POST['journey_type'],'cabin_selected'=>$_POST['cabin']));
				
				     $api='amadeus';
					$_SESSION['hashing_activate'] = '';
					if ($_SESSION['hashing_activate'] != 1) {
						
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
						switch ($api) {
							
								case 'amadeus':
								$this->get_flight_availabilty1($rand_id,$api);
								break;
								
								default: echo '';
						}
					}
			}
			else
			{
                            $displayLimitflight	= 5;
                            $data['cityArflight'] = $cityArflight = $this->Flight_Model->getAllCities($displayLimitflight);
                            $this->load->view('home/flight_index');
			}
	}
	function call_api($api='')
    {
        $api='amadeus';
        $_SESSION['hashing_activate'] = '';
        if ($_SESSION['hashing_activate'] != 1) {
			
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
            switch ($api) {
				
                    case 'amadeus':
                    $this->get_flight_availabilty1($rand_id,$api);
                    break;
					
                    default: echo '';
            }
        }
    }
	function get_flight_availabilty1($rand_id,$api='')
	{
	     $sess_id = '';$SessionId = "";$SequenceNumber = "";$SecurityToken = "";$session_flag = "true";
        // ***** Retrieve Session Details for AMADEUS *****
        $sourceOffice = 'MIA1S21AV';// MIA1S21AV for flight_hotel MIA1S21AV
        $result_query=$this->Flight_Model->get_amadeus_session_details($sourceOffice);
        
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
                            $session_flag = "false";$sess_id = ($no - 1);
                            // ***** Update Session Details for AMADEUS *****
                            $this->Flight_Model->update_amadeus_session_details_start($time,$SequenceNumber,$SessionId,$sourceOffice);
                        } else {
                            $SessionId = $result_query[($no - 1)]->Session_Number;
                            $SequenceNumber = (($result_query[($no - 1)]->Sequence_Number) + 1);
                            $SecurityToken = (($result_query[($no - 1)]->Security_Token));
                            $sess_id = ($no - 1);
                            $Security_SignOut = '<?xml version="1.0" encoding="utf-8"?>
														<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://www.w3.org/2003/05/soap-envelope"														xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"														xmlns:xenc="http://www.w3.org/2001/04/xmlenc"
xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3
xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
xmlns:xs="http://www.w3.org/2001/XMLSchema"
xmlns:tns="http://xml.amadeus.com"
xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1"
xmlns:typ="http://xml.amadeus.com/2010/06/Types_v1"
xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
xmlns:wsp="http://schemas.xmlsoap.org/ws/2004/09/policy"
xmlns:wsa="http://www.w3.org/2007/05/addressing"
xmlns:amasec="http://xml.amadeus.com/2010/06/Security_v1" <!-- Omitted Namespaces-->">
											
															<SOAP-ENV:Header>
											<awsse:Session TransactionStatusCode="End">
																		  <awsse:SessionId>'.$SessionId.'</awsse:SessionId>
																		  <awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
																		  <awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
																	</awsse:Session>
															</SOAP-ENV:Header>
															<SOAP-ENV:Body>
																<Security_SignOut xmlns="http://xml.amadeus.com/VLSSOQ_04_1_1A">
																</Security_SignOut>
															</SOAP-ENV:Body>
														 </SOAP-ENV:Envelope>';

                            
                          
								$URL2 = "https://test.webservices.amadeus.com";
								// $URL2 = "https://production.webservices.amadeus.com";
								$soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/VLSSOQ_04_1_1A";
						

							$ch2 = curl_init();
                            curl_setopt($ch2, CURLOPT_URL, $URL2);
                            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                            curl_setopt($ch2, CURLOPT_HEADER, 0);
                            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch2, CURLOPT_POST, 1);
                            curl_setopt($ch2, CURLOPT_POSTFIELDS, $Security_SignOut);
                            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
                            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
                            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
                            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

                            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
                            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
                            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

                            $data2 = curl_exec($ch2);
                            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
                            curl_close($ch2);
							$session_flag = "true";
                            // ***** Set Session Status for AMADEUS *****
                            $this->Flight_Model->set_amadeus_session_details($SessionId,$sourceOffice);
                        }// $time<780 else
                    } //$session No
					 else {
                        $session_flag = "true";
                    } //$session No else
                }//result no -1
				 else {
                    $session_flag = "true";
                }//result no -1 else
            }//n<=1
			 else {
                for ($s = 0; $s < $no; $s++) {
                    if (isset($result_query[$s])) {
					
					
                        $SessionStatus = $result_query[$s]->Query_In_Progress;
                        if ($SessionStatus == "NO") {
                            $time = time();
                            $SessionTime = $result_query[$s]->Last_Query_Time;
                            if (($time - $SessionTime) < (780)) {
                                $SessionId = $result_query[$s]->Session_Number;
                                $SequenceNumber = (($result_query[$s]->Sequence_Number) + 1);
                                $SecurityToken = (($result_query[$s]->Security_Token));
                                $session_flag = "false";$sess_id = $s;
                                // ***** Update Session Details for AMADEUS *****
                                $this->Flight_Model->update_amadeus_session_details_start($time,$SequenceNumber,$SessionId,$sourceOffice);
                                break;
                            } else {
                                $SessionId = $result_query[$s]->Session_Number;
                                $SequenceNumber = (($result_query[$s]->Sequence_Number) + 1);
                                $SecurityToken = (($result_query[$s]->Security_Token));
                                $sess_id = ($no - 1);
								$Security_SignOut = '<?xml version="1.0" encoding="utf-8"?>
														<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://www.w3.org/2003/05/soap-envelope"															xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"														xmlns:xenc="http://www.w3.org/2001/04/xmlenc"
xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3
xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
xmlns:xs="http://www.w3.org/2001/XMLSchema"
xmlns:tns="http://xml.amadeus.com"
xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1"
xmlns:typ="http://xml.amadeus.com/2010/06/Types_v1"
xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
xmlns:wsp="http://schemas.xmlsoap.org/ws/2004/09/policy"
xmlns:wsa="http://www.w3.org/2007/05/addressing"
xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" <!-- Omitted Namespaces-->">
											
															<SOAP-ENV:Header>
											<awsse:Session TransactionStatusCode="End">
																		  <awsse:SessionId>'.$SessionId.'</awsse:SessionId>
																		  <awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
																		  <awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
																	</awsse:Session>
															</SOAP-ENV:Header>
															<SOAP-ENV:Body>
																	<Security_SignOut xmlns="http://xml.amadeus.com/VLSSOQ_04_1_1A">
																	</Security_SignOut>
																</SOAP-ENV:Body>
														 </SOAP-ENV:Envelope>';

                              
								$URL2 = "https://test.webservices.amadeus.com";
									// $URL2 = "https://production.webservices.amadeus.com";
								$soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/VLSSOQ_04_1_1A";
								$ch2 = curl_init();
                                curl_setopt($ch2, CURLOPT_URL, $URL2);
                                curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
                                curl_setopt($ch2, CURLOPT_HEADER, 0);
                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch2, CURLOPT_POST, 1);
                                curl_setopt($ch2, CURLOPT_POSTFIELDS, $Security_SignOut);
                                curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
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
                                // ***** Set Session Status for AMADEUS *****
                                $this->Flight_Model->set_amadeus_session_details($SessionId,$sourceOffice);
                                $session_flag = "true";
                            }//$time<780 else
                        }//$session status No
                    } //$result_query isset
                }//for loop
            } //n<=1 else
        }//result[0]

        if ($session_flag == "true") {
            $Security_Auth = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://www.w3.org/2003/05/soap-envelope" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
 xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3
 xmlns:xsd="http://www.w3.org/2001/XMLSchema">
          

     <SOAP-ENV:Header xmlns="http://webservices.amadeus.com/definitions">

        <awsse:Session>
			<awsse:SessionId/>
			<awsse:SequenceNumber/>
		    <awsse:SecurityToken/>
			</awsse:Session>		
		
     </SOAP-ENV:Header>

     <SOAP-ENV:Body>
		<Security_Authenticate>
			<userIdentifier>
			<originIdentification>
			<sourceOffice>MIA1S21AV</sourceOffice>
			</originIdentification>
			<originatorTypeCode>U</originatorTypeCode>
			<originator>WSTHXBBT</originator>
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
					<dataLength>07</dataLength>
					<dataType>E</dataType>
					<binaryData>QU1BREVVUw==</binaryData>
			</passwordInfo>
		</Security_Authenticate>
	</SOAP-ENV:Body>
	</SOAP-ENV:Envelope>';

            
          
				$URL2 = "https://test.webservices.amadeus.com";
				// $URL2 = "https://production.webservices.amadeus.com";
				$soapAction = "http://webservices.amadeus.com/1ASIWBBTTHX/VLSSLQ_06_1_1A";
				//$soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/VLSSLQ_06_1_1A";
            

            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $URL2);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
            curl_setopt($ch2, CURLOPT_HEADER, 0);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, $Security_Auth);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
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
            
            if (!empty($data2)) 
            {
                $xml = new DOMDocument();
                $xml->loadXML($data2);
                $SessionId = $xml->getElementsByTagName("SessionId")->item(0)->nodeValue;
                $SequenceNumber = $xml->getElementsByTagName("SequenceNumber")->item(0)->nodeValue;
                $SecurityToken = $xml->getElementsByTagName("SecurityToken")->item(0)->nodeValue;
				$time = time();
				// ***** Insert Session Details for AMADEUS *****
				$this->Flight_Model->insert_amadeus_session_details($time,$SequenceNumber,$SessionId,$SecurityToken,$sourceOffice);
            }
        }// $sessionflag=true

        $adult_count = $_SESSION[$rand_id]['adults'];
        $child_count = $_SESSION[$rand_id]['childs'];
        $infant_count = $_SESSION[$rand_id]['infants'];

        $from_city_code = "";$to_city_code = "";
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
		$cinval = explode("-", $sd);$cins = $cinval[2];$cins = substr($cins, -2);
        $cin = $cinval[0] . $cinval[1] . $cins;
		
        $coutval = explode("-", $ed);$couts = $coutval[2];$couts = substr($couts, -2);
        $cout = $coutval[0] . $coutval[1] . $couts;

        if (!empty($hours_time) && (!empty($mins_time))) 
        {
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


        if (!empty($time_qualifier)) 
        {
            if ($time_qualifier == "Depart from") {
                $time_qualifier_code = "TD";
            } else if ($time_qualifier == "Arrival by") {
                $time_qualifier_code = "TA";
            }
        }

        if (empty($daterange)) 
        {
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
        } else if ($daterange == "plus2days") 
        {
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
        } else if ($daterange == "minus2days") 
        {
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
        } else if ($daterange == "bothdays") 
        {
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
        } else if ($daterange == "timewindow") 
        {
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


        if ((!empty($hours)) && (!empty($mins))) 
        {
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
        if ($_SESSION['journey_type'] != "MultiCity") {
            if ($_SESSION['journey_type'] == "Round") {
                $Fare_MasterPricerTravelBoardSearch = '<?xml version="1.0" encoding="utf-8"?>
														<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://www.w3.org/2003/05/soap-envelope"
xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"														xmlns:xenc="http://www.w3.org/2001/04/xmlenc"
xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3
xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
xmlns:xs="http://www.w3.org/2001/XMLSchema"
xmlns:tns="http://xml.amadeus.com"
xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1"
xmlns:typ="http://xml.amadeus.com/2010/06/Types_v1"
xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
xmlns:wsp="http://schemas.xmlsoap.org/ws/2004/09/policy"
xmlns:wsa="http://www.w3.org/2007/05/addressing"
xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" <!-- Omitted Namespaces-->">
											
															<SOAP-ENV:Header>
											<awsse:Session>
																		  <awsse:SessionId>'.$SessionId.'</awsse:SessionId>
																		  <awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
																		  <awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
																	</awsse:Session>
															</SOAP-ENV:Header>                                        
                            <SOAP-ENV:Body>                   
												<Fare_MasterPricerTravelboardSearch xmlns="http://xml.amadeus.com/FMPCAQ_08_2_1A">
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
																	<currency>EUR</currency> 
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
													</Fare_MetaPricerTravelboardSearch>
											</SOAP-ENV:Body>
														 </SOAP-ENV:Envelope>';

                $request_stirng = "FMPCAQ_08_2_1A";
            } // round
			else if ($_SESSION['journey_type'] == "OneWay") {
                $Fare_MasterPricerTravelBoardSearch = '<?xml version="1.0" encoding="utf-8"?>
														<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://www.w3.org/2003/05/soap-envelope"
xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"														xmlns:xenc="http://www.w3.org/2001/04/xmlenc"
xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3
xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
xmlns:xs="http://www.w3.org/2001/XMLSchema"
xmlns:tns="http://xml.amadeus.com"
xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1"
xmlns:typ="http://xml.amadeus.com/2010/06/Types_v1"
xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
xmlns:wsp="http://schemas.xmlsoap.org/ws/2004/09/policy"
xmlns:wsa="http://www.w3.org/2007/05/addressing"
xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" <!-- Omitted Namespaces-->">
											
															<SOAP-ENV:Header>
											<awsse:Session>
																		  <awsse:SessionId>'.$SessionId.'</awsse:SessionId>
																		  <awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
																		  <awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
																	</awsse:Session>
															</SOAP-ENV:Header>                                        
                            <SOAP-ENV:Body>       
															<Fare_MasterPricerCalendar xmlns="http://xml.amadeus.com/FMPCAQ_08_2_1A">
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
																	<currency>EUR</currency> 
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
															</Fare_MasterPricerCalendar>
														</SOAP-ENV:Body>
														 </SOAP-ENV:Envelope>';


                $request_stirng = "FMPCAQ_08_2_1A";
            }// one way
			 else if ($_SESSION['journey_type'] == "Calendar") {
                $Fare_MasterPricerTravelBoardSearch = '<?xml version="1.0" encoding="utf-8"?>
														<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://www.w3.org/2003/05/soap-envelope"
xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"														xmlns:xenc="http://www.w3.org/2001/04/xmlenc"
xmlns:awsse="http://xml.amadeus.com/2010/06/Session_v3
xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
xmlns:xs="http://www.w3.org/2001/XMLSchema"
xmlns:tns="http://xml.amadeus.com"
xmlns:link="http://wsdl.amadeus.com/2010/06/ws/Link_v1"
xmlns:typ="http://xml.amadeus.com/2010/06/Types_v1"
xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"
xmlns:wsp="http://schemas.xmlsoap.org/ws/2004/09/policy"
xmlns:wsa="http://www.w3.org/2007/05/addressing"
xmlns:sec="http://xml.amadeus.com/2010/06/Security_v1" <!-- Omitted Namespaces-->">
											
															<SOAP-ENV:Header>
											<awsse:Session>
																		  <awsse:SessionId>'.$SessionId.'</awsse:SessionId>
																		  <awsse:SequenceNumber>'.$SequenceNumber.'</awsse:SequenceNumber>
																		  <awsse:SecurityToken>'.$SecurityToken.'</awsse:SecurityToken>
																	</awsse:Session>
															</SOAP-ENV:Header>                                        
                            <SOAP-ENV:Body>     
															<Fare_MasterPricerCalendar xmlns="http://xml.amadeus.com/FMPCAQ_08_2_1A">
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
																	<currency>EUR</currency> 
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
														</SOAP-ENV:Body>
														 </SOAP-ENV:Envelope>';	

                $request_stirng = "FMPCAQ_08_2_1A";
            }// Calender
            
			
			
         
				$URL2 = "https://test.webservices.amadeus.com";
				$soapAction = "http://webservices.amadeus.com/1ASIWBBTTHX/" . $request_stirng;
         //  echo  $Fare_MasterPricerTravelBoardSearch;

            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $URL2);
            curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
            curl_setopt($ch2, CURLOPT_HEADER, 0);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); //$Air_FlightInfo
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, $Fare_MasterPricerTravelBoardSearch); //$Security_Auth
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
            curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

            $httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
            curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
            curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

            // Execute request, store response and HTTP response code
            $dataforgetavail = curl_exec($ch2);
			//print_r($dataforgetavail);
			
            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
            curl_close($ch2);
            
			$fp = fopen('calendar.xml', 'a+');
            fwrite($fp, "Request:".$Fare_MasterPricerTravelBoardSearch."\n URL: ".$URL2."Soap Action :".$soapAction." \n------------------Response:".$dataforgetavail);
            fclose($fp);
            
            $fare_search_result = $this->xml2array($dataforgetavail);
		$count_flight_details = null;$count_val = null;



            if ($_SESSION['journey_type'] != "Calendar") {
				 
                if (!isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerCalendarReply']['errorMessage'])) {
                    if (isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerCalendarReply']))
                        $data['flight_result'] = $fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerCalendarReply'];
                    else
                        $data['flight_result'] = "";
                }
                else {
                    $data['flight_result'] = "";
                    $data['currency'] = "";
                }
            } else {
				
				
				
				
                if (!isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerCalendarReply']['errorMessage'])) {
                    if (isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerCalendarReply']))
                        $data['flight_result'] = $fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerCalendarReply'];
                    else
                        $data['flight_result'] = "";
                }
                else {
                    $data['flight_result'] = "";
                    $data['currency'] = "";
                }
            }
            $time = time();
            // ***** Update Session Details for AMADEUS *****
            $this->Flight_Model->update_amadeus_session_details($time,$SequenceNumber,$SessionId,$sourceOffice);
        } // multicity
		
		
		if ($_SESSION['journey_type'] == "Round" || ($_SESSION['journey_type'] == "Calendar")) {
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
                        $flightDetails[$i]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref'];
                        $flightDetails[$i]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref'];
                        if ($count_flight_details <= 1) 
                        {
                            $flightDetails[$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                            $flightDetails[$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                            $flightDetails[$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                            $flightDetails[$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                            $flightDetails[$i]['flightOrtrainNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightOrtrainNumber'];
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
                            for ($j = 0; $j < $count_flight_details; $j++) 
                            {
                                $flightDetails[$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                $flightDetails[$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                $flightDetails[$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                $flightDetails[$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                $flightDetails[$i]['flightOrtrainNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightOrtrainNumber'];
                                $flightDetails[$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
                                $flightDetails[$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
                                $flightDetails[$i]['locationIdDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][0]['locationId'];
                                $flightDetails[$i]['locationIdArival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][1]['locationId'];
                                $flightDetails[$i]['equipmentType'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType'];
                                $flightDetails[$i]['electronicTicketing'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing'];
                                $flightDetails[$i]['productDetailQualifier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
                            }
                        }//$count flight details else
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
                            if(!isset($flight_details[$i]['flightDetails'][0]))
                            {
                                $flightDetails[$re]['return'][$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                                $flightDetails[$re]['return'][$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                                $flightDetails[$re]['return'][$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                                $flightDetails[$re]['return'][$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                                $flightDetails[$re]['return'][$i]['flightOrtrainNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightOrtrainNumber'];
                                $flightDetails[$re]['return'][$i]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
                                $flightDetails[$re]['return'][$i]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
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
                                for ($j = 0; $j < $count_flight_details; $j++) 
                                {
                                    $flightDetails[$re]['return'][$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                    $flightDetails[$re]['return'][$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                    $flightDetails[$re]['return'][$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                    $flightDetails[$re]['return'][$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                    $flightDetails[$re]['return'][$i]['flightOrtrainNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightOrtrainNumber'];
                                    $flightDetails[$re]['return'][$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
                                    $flightDetails[$re]['return'][$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
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
                // ***** Recommendatio Part (Fare Details) *****
                if(isset($flight_result['recommendation'][0]))
					$flight_recommendation = $flight_result['recommendation'];
				else
					$flight_recommendation[0] = $flight_result['recommendation'];
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
                                if(isset($s['itemNumber']['itemNumberId']['numberType']))
                                {
									$testing[$rt]['MultiTicket']="Yes";
									$testing[$rt]['MultiTicket_type']=$s['itemNumber']['itemNumberId']['numberType'];
									$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number'];
								}
								else
								{
									$testing[$rt]['MultiTicket']="No";
									$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number'];
								}
                                $testing[$rt]['segmentFlightRef']['refNumber'][$cr] = $s['segmentFlightRef']['referencingDetail'][$cr]['refNumber'];
							}
						}
						else
						{	
							if(isset($s['itemNumber']['itemNumberId']['numberType']))
							{
								$testing[$rt]['MultiTicket']="Yes";
								$testing[$rt]['MultiTicket_type']=$s['itemNumber']['itemNumberId']['numberType'];
								$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number'];
							}
							else
							{
								$testing[$rt]['MultiTicket']="No";
								$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number'];
							}
							$testing[$rt]['segmentFlightRef']['refNumber'] = $s['segmentFlightRef']['referencingDetail']['refNumber'];
						}
							
                                $testing[$rt]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
                                $testing[$rt]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

                                if (!isset($s['paxFareProduct'][0])) {
                                    $testing[$rt]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
                                    $testing[$rt]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));

                                    if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
                                        $testing[$rt]['paxFareProduct']['count'] = "1";
                                        $testing[$rt]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
                                        if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
                                            $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
                                        } else {
                                            $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                        }
                                    } else {
                                        $testing[$rt]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
                                        $count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
                                        for ($p = 0; $p < $count_traveller; $p++) {
                                            $testing[$rt]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
                                            if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
                                            } else {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                            }
                                        }
                                    }

                                    $testing[$rt]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
                                    $testing[$rt]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];

                                    $testing[$rt]['paxFareProduct']['description'] = "";
                                    if (!isset($s['paxFareProduct']['fare'][0])) {

                                        $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                        $testing[$rt]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];


                                        $count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
                                        if ($count_description <= 1) {
                                            $testing[$rt]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description']['value'] . " ";
                                        } else {
                                            for ($f = 0; $f < $count_description; $f++) {
                                                $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f]['value'] . " ";
                                            }
                                        }
                                    } else {
                                        $count_fare = (count($s['paxFareProduct']['fare']));
                                        for ($e = 0; $e < $count_fare; $e++) {
                                            $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'][$e] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                            $testing[$rt]['paxFareProduct']['fare']['informationType'][$e] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                            $count_description = (count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']));
                                            if (($count_description <= 1)) {
                                                $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description']['value'] . " - ";
                                            } else {
                                                for ($f = 0; $f < $count_description; $f++) {
                                                    $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f]['value'] . " ";
                                                }
                                            }
                                        }
                                    }

                                    if (!isset($s['paxFareProduct']['fareDetails'][0])) {
										$testing[$rt]['flight_mtk_ref']=$s['paxFareProduct']['fareDetails']['segmentRef']['segRef'];
                                        if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
                                            $testing[$rt]['paxFareProduct']['fareDetails']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                        } else {
                                            $count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
                                            for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                $testing[$rt]['paxFareProduct']['fareDetails']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                            }
                                        }
                                    } else {
                                        $count_fareDetails = (count($s['paxFareProduct']['fareDetails']));
                                        for ($fd = 0; $fd < $count_fareDetails; $fd++) {
                                            $testing[$rt]['flight_mtk_ref'][$fd]=$s['paxFareProduct']['fareDetails'][$fd]['segmentRef']['segRef'];
                                            if (!isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][0])) {
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
                                            else {
                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']));
                                                for ($u = 0; $u < $count_groupOfFares; $u++) {
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

                                        }
                                    }
                                }

                                else {
                                    $count_paxFareProduct = (count($s['paxFareProduct']));
                                    for ($d = 0; $d < $count_paxFareProduct; $d++) {
                                        $testing[$rt]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
                                        if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
                                            $testing[$rt]['paxFareProduct'][$d]['count'] = "1";
                                            $testing[$rt]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
                                            if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
                                            } else {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                            }
                                        } else {
                                            $testing[$rt]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                            $count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                            for ($p = 0; $p < $count_traveller; $p++) {
                                                $testing[$rt]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
                                            }
                                            if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
                                            } else {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                            }
                                        }

                                        $testing[$rt]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
                                        $testing[$rt]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

                                        $testing[$rt]['paxFareProduct'][$d]['description'] = "";
                                        if (!isset($s['paxFareProduct'][$d]['fare'][0])) {
                                            $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                            $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                            if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) {
                                                $testing[$rt]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description']['value'] . " ";
                                            } else {
                                                $count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
                                                for ($f = 0; $f < $count_description; $f++) {
                                                    $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f]['value'];
                                                }
                                            }
                                        } else {
                                            $count_fare = (count($s['paxFareProduct'][$d]['fare']));
                                            for ($e = 0; $e < $count_fare; $e++) {
                                                $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'][$e] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'][$e] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                $count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
                                                if ($count_description <= 1) {
                                                    $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']['value'] . " - ";
                                                } else {
                                                    for ($f = 0; $f < $count_description; $f++) {
                                                        $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f]['value'] . " - ";
                                                    }
                                                }
                                            }
                                        }

                                        if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) {
											$testing[$rt]['flight_mtk_ref']=$s['paxFareProduct'][$d]['fareDetails']['segmentRef']['segRef'];
                                            if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) {
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                            } else {
                                                $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
                                                for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                }
		
                                            }
                                        } else {
                                            $count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
                                            for ($fd = 0; $fd < $count_fareDetails; $fd++) {
                                                $testing[$rt]['flight_mtk_ref'][$fd]=$s['paxFareProduct'][$d]['fareDetails'][$fd]['segmentRef']['segRef'];
                                                if (!isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][0])) {
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                    if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                    else
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = '';
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                }
                                                else {
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
	
                                            }
                                        }
                                    }
                                }

                                if (isset($s['specificRecDetails'])) {
                                    if (isset($s['specificRecDetails'][0])) {
                                        $count_specificRecDetails = (count($s['specificRecDetails']));
                                        for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) {
                                            if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) {
                                                $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem']['refNumber'] = $s['refNumber'][$sdi]['specificRecItem']['refNumber'];
                                                
                                                if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                    $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                    for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                    }
                                                } else {
                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                }
                                                
                                            } else {
                                                $count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
                                                for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
                                                    $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber'] = $s['refNumber'][$sdi]['specificRecItem'][$sif]['refNumber'];
                                                   
                                                    if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                        $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                        for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                            $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    } else {
                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                    }
                                                    //}
                                                }
                                            }
                                        }
                                    } else {
                                        if (!isset($s['specificRecDetails']['specificRecItem'][0])) {
                                            $testing[$rt]['specificRecDetails']['specificRecItem']['refNumber'] = $s['refNumber']['specificRecItem']['refNumber'];
                                            //if($testing[$n]['ref']==$s['specificRecDetails']['specificRecItem']['refNumber'])
                                            //{
                                            if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                }
                                            } else {
                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                            }
                                            //}
                                        } else {
                                            $count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
                                            for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
                                                $testing[$rt]['specificRecDetails']['specificRecItem'][$sif]['refNumber'] = $s['refNumber']['specificRecItem'][$sif]['refNumber'];
                                                //if($testing[$n]['ref']==$s['specificRecDetails']['specificRecItem'][$sif]['refNumber'])
                                                //{
                                                if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                    $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                    for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                    }
                                                } else {
                                                    $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                }
                                                //}
                                            }
                                        }
                                    }
                                }
                         
                    } else {
                        $count_segmentFlightRef = (count($s['segmentFlightRef']));
                        for ($c = 0; $c < $count_segmentFlightRef; $c++) {
                            if (isset($s['segmentFlightRef'][$c]['referencingDetail'][0])) {
                                $count_referencingDetail = (count($s['segmentFlightRef'][$c]['referencingDetail']));
                                for ($cr = 0; $cr < $count_referencingDetail; $cr++) {
                                    if(isset($s['itemNumber']['itemNumberId']['numberType']))
									{
										$testing[$rt]['MultiTicket']="Yes";
										$testing[$rt]['MultiTicket_type']=$s['itemNumber']['itemNumberId']['numberType'];
										$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number'];
									}
									else
									{
										$testing[$rt]['MultiTicket']="No";
										$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number'];
									}
                                    $testing[$rt]['segmentFlightRef'][$c]['refNumber'][$cr] = $s['segmentFlightRef'][$c]['referencingDetail'][$cr]['refNumber'];
                                   }
							   }
							   else
							   {
								    if(isset($s['itemNumber']['itemNumberId']['numberType']))
									{
										$testing[$rt]['MultiTicket']="Yes";
										$testing[$rt]['MultiTicket_type']=$s['itemNumber']['itemNumberId']['numberType'];
										$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number'];
									}
									else
									{
										$testing[$rt]['MultiTicket']="No";
										$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number'];
									}
								   $testing[$rt]['segmentFlightRef'][$c]['refNumber'] = $s['segmentFlightRef'][$c]['referencingDetail']['refNumber'];
							   }
                                   
                                   
                                    $testing[$rt]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
                                    $testing[$rt]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

                                    if (!isset($s['paxFareProduct'][0])) {
                                        $testing[$rt]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
                                        ;
                                        $testing[$rt]['paxFareProduct']['count'] = count($s['paxFareProduct']['paxReference']['traveller']);

                                        if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
                                            $testing[$rt]['paxFareProduct']['count'] = "1";
                                            $testing[$rt]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
                                            if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
                                            } else {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                            }
                                        } else {
                                            $testing[$rt]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
                                            $count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
                                            for ($p = 0; $p < $count_traveller; $p++) {
                                                $testing[$rt]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
                                            }
                                            if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
                                            } else {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                            }
                                        }

                                        $testing[$rt]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
                                        $testing[$rt]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];

                                        $testing[$rt]['paxFareProduct']['description'] = "";
                                        if (!isset($s['paxFareProduct']['fare'][0])) {

                                            $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                            $testing[$rt]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                            if (!isset($s['paxFareProduct']['fare']['pricingMessage']['description'][0])) {
                                                $testing[$rt]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description']['value'] . " ";
                                            } else {
                                                $count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
                                                for ($f = 0; $f < $count_description; $f++) {
                                                    $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f]['value'] . " ";
                                                }
                                            }
                                        } else {
                                            $count_fare = count($s['paxFareProduct']['fare']);
                                            for ($e = 0; $e < $count_fare; $e++) {
                                                $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                $testing[$rt]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) {
                                                    $testing[$rt]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description']['value'] . " ";
                                                } else {
                                                    $count_description = count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']);
                                                    for ($f = 0; $f < $count_description; $f++) {
                                                        $testing[$rt]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f]['value'] . " ";
                                                    }
                                                }
                                            }
                                        }

                                        if (!isset($s['paxFareProduct']['fareDetails'][0])) {
                                             $testing[$rt]['flight_mtk_ref']=$s['paxFareProduct']['fareDetails']['segmentRef']['segRef'];
                                            if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
                                                $testing[$rt]['paxFareProduct']['fareDetails']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                            } else {
                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
                                                for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                                }
                                            }
                                            //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                            //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                        } else {
                                            $count_fareDetails = (count($s['paxFareProduct']['fareDetails']));
                                            for ($fd = 0; $fd < $count_fareDetails; $fd++) {
                                                 $testing[$rt]['flight_mtk_ref'][$fd]=$s['paxFareProduct']['fareDetails'][$fd]['segmentRef']['segRef'];
                                                if (!isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][0])) {
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
                                                else {
                                                    $count_groupOfFares = (count($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']));
                                                    for ($u = 0; $u < $count_groupOfFares; $u++) {
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
                                                
                                            }
                                        }
                                    }
                                    else {
                                        $count_paxFareProduct = (count($s['paxFareProduct']));
                                        for ($d = 0; $d < $count_paxFareProduct; $d++) {
                                            $testing[$rt]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
                                            if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
                                                $testing[$rt]['paxFareProduct'][$d]['count'] = "1";
                                                $testing[$rt]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
                                                } else {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                }
                                            } else {
                                                $testing[$rt]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                $count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                for ($p = 0; $p < $count_traveller; $p++) {
                                                    $testing[$rt]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
                                                }
                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
                                                } else {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                }
                                            }

                                            $testing[$rt]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
                                            $testing[$rt]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

                                            $testing[$rt]['paxFareProduct'][$d]['description'] = "";
                                            if (!isset($s['paxFareProduct'][$d]['fare'][0])) {

                                                $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                                if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) {
                                                    $testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description']['value'] . " ";
                                                } else {
                                                    $count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
                                                    for ($f = 0; $f < $count_description; $f++) {
                                                        $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f]['value'] . " ";
                                                    }
                                                }
                                            } else {
                                                $count_fare = (count($s['paxFareProduct'][$d]['fare']));
                                                for ($e = 0; $e < $count_fare; $e++) {
                                                    $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                    if (!isset($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][0])) {
                                                        $testing[$rt]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']['value'] . " ";
                                                    } else {
                                                        $count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
                                                        for ($f = 0; $f < $count_description; $f++) {
                                                            $testing[$rt]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f]['value'];
                                                        }
                                                    }
                                                }
                                            }

                                            if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) {
                                                 $testing[$rt]['flight_mtk_ref']=$s['paxFareProduct'][$d]['fareDetails']['segmentRef']['segRef'];
                                                if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) {
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                } else {
                                                    $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
                                                    for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                    }
                                                }
								
                                            } else {
                                                $count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
                                                for ($fd = 0; $fd < $count_fareDetails; $fd++) {
                                                     $testing[$rt]['flight_mtk_ref'][$fd]=$s['paxFareProduct'][$d]['fareDetails'][$fd]['segmentRef']['segRef'];
                                                    if (!isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][0])) {
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                        if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                        else
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = '';
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                    }
                                                    else {
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
								
                                                }
                                            }
                                        }
                                    }

                                    if (isset($s['specificRecDetails'])) {
                                        if (isset($s['specificRecDetails'][0])) {
                                            $count_specificRecDetails = (count($s['specificRecDetails']));
                                            for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) {
                                                if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) {
                                                    $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem']['refNumber'] = $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber'];
                                                    if (!isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][0])) {
                                                        if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                            $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                            for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        } else {
                                                            $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['requestedSegmentInfo']['segRef'];
                                                            $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    } else {
                                                        $count_fareContextDetails = (($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']));
                                                        for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) {
                                                            if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                                $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                    $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                }
                                                            } else {
                                                                $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef'];
                                                                $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
                                                    for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
                                                        $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber'] = $s['refNumber'][$sdi]['specificRecItem'][$sif]['refNumber'];
                                                        if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                            if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                                $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                }
                                                            } else {
                                                                $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        } else {
                                                            $count_fareContextDetails = (($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']));
                                                            for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) {
                                                                if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                                    $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                                    for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                        $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                    }
                                                                } else {
                                                                    $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef'];
                                                                    $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            if (!isset($s['specificRecDetails']['specificRecItem'][0])) {
                                                $testing[$rt]['specificRecDetails']['specificRecItem']['refNumber'] = $s['specificRecDetails']['specificRecItem']['refNumber'];
                                                if (!isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails'])) {
                                                    if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                        $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                        for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                            $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    } else {
                                                        $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                    }
                                                } else {
                                                    $count_fareContextDetails = (($s['specificRecDetails']['specificProductDetails']['fareContextDetails']));
                                                    for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) {
                                                        if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                            $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                            for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {

                                                                $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        } else {
                                                            $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef'];
                                                            $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    }
                                                }
                                            } else {
                                                $count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
                                                for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
                                                    $testing[$rt]['specificRecDetails']['specificRecItem'][$sif]['refNumber'] = $s['refNumber']['specificRecItem'][$sif]['refNumber'];
                                                    if (!isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][0])) {
                                                        if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                            $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                            for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                            }
                                                        } else {
                                                            $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                        }
                                                    } else {
                                                        $count_fareContextDetails = (($s['specificRecDetails']['specificProductDetails']['fareContextDetails']));
                                                        for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) {
                                                            if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                                $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                    $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef'];
                                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
                                                                }
                                                            } else {
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
                }//flight_result
				
                if (isset($flightDetails[0])) 
                {
                    $count_oneway = (count($flightDetails[0]['return']));
                    $count_return = (count($flightDetails[1]['return']));
                    $count_recomm = (count($testing));
                    $oneway = ($flightDetails[0]['return']);
                    $return = ($flightDetails[1]['return']);
                    $no = 0;
                    $final_result = '';
                    for ($o = 0; $o < $count_oneway; $o++) {
                        for ($r = 0; $r < $count_return; $r++) {
                            for ($rc = 0; $rc < $count_recomm; $rc++) {
                               if (!isset($testing[$rc]['segmentFlightRef'][0])) 
                               {
                                    //if(isset($testing[$rc]['segmentFlightRef']['refNumber'][0])){
									if(is_array($testing[$rc]['segmentFlightRef']['refNumber']))
									{
										if($testing[$rc]['MultiTicket']=="Yes")
										{
											if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'][0])) && (($testing[$rc]['flight_mtk_ref']=="1"))) 
											{
												$final_result[$no]['flag'] = "One";
												$final_result[$no]['oneWay'] = $oneway[$o];
												$final_result[$no]['Recomm'][0] = $testing[$rc];
											}
											if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'][0])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'][1])) && (($testing[$rc]['flight_mtk_ref']=="2")))  
											{
												$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'][0] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'][1];
												$final_result[$no]['combination'] = $combination;
												$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
												$final_result[$no]['Return'] = $return[$r];
												$final_result[$no]['Recomm'][1] = $testing[$rc];
												$no++;
											}
										}
										else
										{
											if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'][0])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'][1]))) 
											{
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
                                    }
                                    else
                                    {
										if($testing[$rc]['MultiTicket']=="Yes")
										{
											
											if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($testing[$rc]['flight_mtk_ref']=="1"))) 
											{
												$final_result[$no]['flag'] = "One";
												$final_result[$no]['oneWay'] = $oneway[$o];
												$final_result[$no]['Recomm'][0] = $testing[$rc];
											}
											
											if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($testing[$rc]['flight_mtk_ref']=="2")))  
											{
												$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'];
												$final_result[$no]['combination'] = $combination;
												$final_result[$no]['Return'] = $return[$r];
												$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
												$final_result[$no]['Recomm'][1] = $testing[$rc];
												
												$no++;
											}
										}
										else
										{
											if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber']))) 
											{
												$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'];
												$final_result[$no]['combination'] = $combination;
												$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
												$final_result[$no]['flag'] = "One";
												$final_result[$no]['oneWay'] = $oneway[$o];
												$final_result[$no]['Return'] = $return[$r];
												$final_result[$no]['Recomm'] = $testing[$rc];
												
												$no++;
											}
										}
									}
                                } 
                                else 
                                {
                                    $count_segmentFlightRef = (count($testing[$rc]['segmentFlightRef']));
                                    for ($cs = 0; $cs < $count_segmentFlightRef; $cs++) 
                                    {
										 if(is_array($testing[$rc]['segmentFlightRef'][$cs]['refNumber']))
										 {
											if(isset($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][1]))
											{
												if($testing[$rc]['MultiTicket']=="Yes")
												{
													if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0])) && (($testing[$rc]['flight_mtk_ref']=="1")))  
													{
														$final_result[$no]['flag'] = "Multiple";
														$final_result[$no]['SegmentNo'] = $cs;
														$final_result[$no]['oneWay'] = $oneway[$o];
														$final_result[$no]['Recomm'][0] = $testing[$rc];
														
													}
													
													if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][1])) && (($testing[$rc]['flight_mtk_ref']=="2")))  
													{
														$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef'][$cs]['refNumber'][1] . " => " . $cs;
														$final_result[$no]['combination'] = $combination;
														$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
														$final_result[$no]['Return'] = $return[$r];
														$final_result[$no]['Recomm'][1] = $testing[$rc];
														$no++;
													}
													
												}
												else
												{
													if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][1]))) 
													{
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
										}
										else
										{
											if($testing[$rc]['MultiTicket']=="Yes")
											{
												 
												if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'])) && (($testing[$rc]['flight_mtk_ref']=="1")))  
												{
													$final_result[$no]['flag'] = "Multiple";
													$final_result[$no]['SegmentNo'] = $cs;
													$final_result[$no]['oneWay'] = $oneway[$o];
													$final_result[$no]['Recomm'][0] = $testing[$rc];
												}
												
												if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'])) && (($testing[$rc]['flight_mtk_ref']=="2")))  
												{
													$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef'][$cs]['refNumber'] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef'][$cs]['refNumber'] . " => " . $cs;
													$final_result[$no]['combination'] = $combination;
													$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
													$final_result[$no]['Return'] = $return[$r];
													$final_result[$no]['SegmentNo'] = $cs;
													$final_result[$no]['Recomm'][1] = $testing[$rc];
													$no++;
												}
											}
											else
											{
												if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber']))) 
												{
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
                }
                $data['flight_result'] = $final_result;
                $data['currency'] = $currency;
            } else {
                $data['flight_result'] = '';
                $data['currency'] = '';
            }
        } //round or calender
        else if (($_SESSION['journey_type'] == "OneWay")) {
            if (!empty($data['flight_result'])) {
                $flight_result = $data['flight_result'];
                $currency = $flight_result['conversionRate']['conversionRateDetail']['currency'];
                if (!isset($flight_result['flightIndex'][0])) {
                    $flight_details = $flight_result['flightIndex']['groupOfFlights'];
                    if (!isset($flight_details[0])) {
                        $count_flight_details = count($flight_details['flightDetails']);
                        $i = 0;
                        $testing[$i]['ref'] = $flight_details['propFlightGrDetail']['flightProposal'][0]['ref'];
                        $testing[$i]['eft'] = $flight_details['propFlightGrDetail']['flightProposal'][1]['ref'];
                        if ($count_flight_details <= 1) {
                            $testing[$i]['dateOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture']['value'];
                            $testing[$i]['timeOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture']['value'];
                            $testing[$i]['dateOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfArrival']['value'];
                            $testing[$i]['timeOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfArrival']['value'];
                            $testing[$i]['flightOrtrainNumber'] = $flight_details['flightDetails']['flightInformation']['flightOrtrainNumber']['value'];
                            $testing[$i]['marketingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['marketingCarrier']['value'];
                            $testing[$i]['operatingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['operatingCarrier']['value'];
                            $testing[$i]['locationIdDeparture'] = $flight_details['flightDetails']['flightInformation']['location'][0]['locationId']['value'];
                            $testing[$i]['locationIdArival'] = $flight_details['flightDetails']['flightInformation']['location'][1]['locationId']['value'];
                            $testing[$i]['equipmentType'] = $flight_details['flightDetails']['flightInformation']['productDetail']['equipmentType']['value'];
                            $testing[$i]['electronicTicketing'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing']['value'];
                            if (isset($flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
                                $testing[$i]['productDetailQualifier'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']['value'];
                            else
                                $testing[$i]['productDetailQualifier'] = '';
                        }
                        else {
                            for ($j = 0; $j < $count_flight_details; $j++) {
                                $testing[$i]['dateOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture']['value'];
                                $testing[$i]['timeOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture']['value'];
                                $testing[$i]['dateOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival']['value'];
                                $testing[$i]['timeOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival']['value'];
                                $testing[$i]['flightOrtrainNumber'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['flightOrtrainNumber']['value'];
                                $testing[$i]['marketingCarrier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier']['value'];
                                $testing[$i]['operatingCarrier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier']['value'];
                                $testing[$i]['locationIdDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['location'][0]['locationId']['value'];
                                $testing[$i]['locationIdArival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['location'][1]['locationId']['value'];
                                $testing[$i]['equipmentType'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType']['value'];
                                $testing[$i]['electronicTicketing'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing']['value'];
                                if (isset($flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']))
                                    $testing[$i]['productDetailQualifier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']['value'];
                                else
                                    $testing[$i]['productDetailQualifier'][$j];
                            }
                        }
                    }
                    else {
                        $count_flight_result = count($flight_details);
                        for ($i = 0; $i < $count_flight_result; $i++) {
                            $count_flight_details = count($flight_details[$i]['flightDetails']);
                            $testing[$i]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref'];
                            $testing[$i]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref'];
                            if ($count_flight_details <= 1) {
                                $testing[$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                                $testing[$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                                $testing[$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                                $testing[$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                                $testing[$i]['flightOrtrainNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightOrtrainNumber'];
                                $testing[$i]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
                                $testing[$i]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
                                $testing[$i]['locationIdDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][0]['locationId'];
                                $testing[$i]['locationIdArival'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][1]['locationId'];
                                $testing[$i]['equipmentType'] = $flight_details[$i]['flightDetails']['flightInformation']['productDetail']['equipmentType'];
                                $testing[$i]['electronicTicketing'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
                                if (isset($flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
                                    $testing[$i]['productDetailQualifier'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
                                else
                                    $testing[$i]['productDetailQualifier'] = '';
                            }
                            else {
                                for ($j = 0; $j < $count_flight_details; $j++) {
                                    $testing[$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                    $testing[$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                    $testing[$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                    $testing[$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                    $testing[$i]['flightOrtrainNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightOrtrainNumber'];
                                    $testing[$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
                                    $testing[$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
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
                else {
                    $count_group = (count($flight_result['flightIndex']));
                    $k = 0;
                    for ($fg = 0; $fg < $count_group; $fg++) {
                        $flight_details = $flight_result['flightIndex'][$fg]['groupOfFlights'];
                        if (!isset($flight_details[0])) {
                            $count_flight_details = count($flight_details['flightDetails']);

                            $testing[$k]['ref'] = $flight_details['propFlightGrDetail']['flightProposal'][0]['ref'];
                            $testing[$k]['eft'] = $flight_details['propFlightGrDetail']['flightProposal'][1]['ref'];
                            if ($count_flight_details <= 1) {
                                $testing[$k]['dateOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                                $testing[$k]['timeOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                                $testing[$k]['dateOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                                $testing[$k]['timeOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                                $testing[$k]['flightOrtrainNumber'] = $flight_details['flightDetails']['flightInformation']['flightOrtrainNumber'];
                                $testing[$k]['marketingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
                                $testing[$k]['operatingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
                                $testing[$k]['locationIdDeparture'] = $flight_details['flightDetails']['flightInformation']['location'][0]['locationId'];
                                $testing[$k]['locationIdArival'] = $flight_details['flightDetails']['flightInformation']['location'][1]['locationId'];
                                $testing[$k]['equipmentType'] = $flight_details['flightDetails']['flightInformation']['productDetail']['equipmentType'];
                                $testing[$k]['electronicTicketing'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
                                if (isset($flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
                                    $testing[$k]['productDetailQualifier'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
                                else
                                    $testing[$k]['productDetailQualifier'] = '';$k++;
                            }
                            else {
                                for ($j = 0; $j < $count_flight_details; $j++) {
                                    $testing[$k]['dateOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                    $testing[$k]['timeOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                    $testing[$k]['dateOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                    $testing[$k]['timeOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                    $testing[$k]['flightOrtrainNumber'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['flightOrtrainNumber'];
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
                                }$k++;
                            }
                        }
                        else {
                            $count_flight_result = count($flight_details);
                            for ($i = 0; $i < $count_flight_result; $i++) {
                                $count_flight_details = count($flight_details[$i]['flightDetails']);
                                $testing[$k]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref'];
                                $testing[$k]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref'];
                                if ($count_flight_details <= 1) {
                                    $testing[$k]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                                    $testing[$k]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                                    $testing[$k]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                                    $testing[$k]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                                    $testing[$k]['flightOrtrainNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightOrtrainNumber'];
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
                                else {
                                    for ($j = 0; $j < $count_flight_details; $j++) {
                                        $testing[$k]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                        $testing[$k]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                        $testing[$k]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                        $testing[$k]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                        $testing[$k]['flightOrtrainNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightOrtrainNumber'];
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
                                    }$k++;
                                }
                            }
                        }
                    }
                }
                if(isset($flight_result['recommendation'][0])){
					
					$flight_recommendation = $flight_result['recommendation'];}
				else{
					$flight_recommendation[0] = $flight_result['recommendation'];}
               $count_recommendation = count($flight_recommendation);
			   $count_testing = count($testing);
                for ($n = 0; $n < $count_testing; $n++) {   
					foreach ($flight_recommendation as $p => $s) {
						$count_segmentFlightRef = (count($s['segmentFlightRef']));
						if (!isset($s['segmentFlightRef'][0])) {
							if (isset($s['segmentFlightRef']['referencingDetail'][0])) {
								$count_referencingDetail = (count($s['segmentFlightRef']['referencingDetail']));
								for ($crd = 0; $crd < $count_referencingDetail; $crd++) {
									if ($testing[$n]['ref'] == $s['segmentFlightRef']['referencingDetail'][$crd]['refNumber']['value']) {
										$testing[$n]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount']['value'];
										$testing[$n]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount']['value'];
										if (!isset($s['paxFareProduct'][0])) {
											$testing[$n]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc']['value'];
											$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));

											if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
												$testing[$n]['paxFareProduct']['count'] = "1";
												$testing[$n]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref']['value'];
												if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
													$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator']['value'];
												} else {
													$testing[$n]['paxFareProduct']['infantIndicator'] = "";
												}
											} else {
												$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
												$count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
												for ($p = 0; $p < $count_traveller; $p++) {
													$testing[$n]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref']['value'];
													if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
														$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator']['value'];
													} else {
														$testing[$n]['paxFareProduct']['infantIndicator'] = "";
													}
												}
											}

											$testing[$n]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount']['value'];
											$testing[$n]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount']['value'];

											$testing[$n]['paxFareProduct']['description'] = "";
											if (!isset($s['paxFareProduct']['fare'][0])) {
												//need updation	
												$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
												$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

												//Description
												$count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
												if ($count_description <= 1) {
													$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description']['value'] . " ";
												} else {
													for ($f = 0; $f < $count_description; $f++) {
														$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f]['value'] . " ";
													}
												}
											} else {
												$count_fare = (count($s['paxFareProduct']['fare']));
												for ($e = 0; $e < $count_fare; $e++) {
													$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
													$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

													//Description
													if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) {
														$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description']['value'] . " ";
													} else {
														$count_description = (count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']));
														for ($f = 0; $f < $count_description; $f++) {
															$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f]['value'] . " ";
														}
													}
												}
											}

											if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
												$testing[$n]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
												$testing[$n]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
												if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
													$testing[$n]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
												else
													$testing[$n]['paxFareProduct']['avlStatus'] = '';
												$testing[$n]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
												$testing[$n]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
											}
											else {
												$count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
												for ($u = 0; $u < $count_groupOfFares; $u++) {
													$testing[$n]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd']['value'];
													$testing[$n]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']['value'];
													if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
														$testing[$n]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']['value'];
													else
														$testing[$n]['paxFareProduct']['avlStatus'][$u] = '';
													$testing[$n]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint']['value'];
													$testing[$n]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType']['value'];
												}
											}
											$testing[$n]['paxFareProduct']['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
											$testing[$n]['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
										}
										else {
											$count_paxFareProduct = (count($s['paxFareProduct']));
											for ($d = 0; $d < $count_paxFareProduct; $d++) {
												$testing[$n]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc']['value'];
												if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
													$testing[$n]['paxFareProduct'][$d]['count'] = "1";
													$testing[$n]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref']['value'];
													if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) {
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator']['value'];
													} else {
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
													}
												} else {
													$testing[$n]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
													$count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
													for ($p = 0; $p < $count_traveller; $p++) {
														$testing[$n]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref']['value'];
													}
													if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator']['value'];
													} else {
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
													}
												}

												$testing[$n]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount']['value'];
												$testing[$n]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount']['value'];

												$testing[$n]['paxFareProduct'][$d]['description'] = "";
												if (!isset($s['paxFareProduct'][$d]['fare'][0])) {
													//need updation	
													$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
													$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

													if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) {
														$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description']['value'] . " ";
													} else {
														$count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
														for ($f = 0; $f < $count_description; $f++) {
															$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f]['value'];
														}
													}
												} else {
													$count_fare = (count($s['paxFareProduct'][$d]['fare']));
													for ($e = 0; $e < $count_fare; $e++) {
														$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
														$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

														$count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
														if ($count_description <= 1) {
															$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']['value'] . " ";
														} else {
															for ($f = 0; $f < $count_description; $f++) {
																$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f]['value'] . " ";
															}
														}
													}
												}
												if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) {
													if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) {
														$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
														$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
														$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
														$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
														$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
													} else {
														$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
														for ($g = 0; $g < $count_groupOfFares; $g++) {
															$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
															$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
															$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
															$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
															$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
														}
													}
													$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
													$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
												} else {
													$count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
													for ($cfd = 0; $cfd < $count_fareDetails; $cfd++) {
														if (!isset($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][0])) {
															$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
															$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
															$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
															$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['breakPoint']['value'];
															$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
														} else {
															$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']);
															for ($g = 0; $g < $count_groupOfFares; $g++) {
																$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
																$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
																$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
																$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
																$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
															}
														}
														$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator']['value'];
														$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator']['value'];
													}
												}
														
											}
										}

										if (isset($s['specificRecDetails'])) {
											if (isset($s['specificRecDetails'][0])) {
												$count_specificRecDetails = (count($s['specificRecDetails']));
												for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) {
													if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) {
														if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber']) {
															if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															} else {
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														}
													} else {
														$count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
														for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
															if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber']) {
																if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																	$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																	for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																		$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																	}
																} else {
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															}
														}
													}
												}
											} else {
												if (!isset($s['specificRecDetails']['specificRecItem'][0])) {
													if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem']['refNumber']) {
														if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
															$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														} else {
															$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													}
												} else {
													$count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
													for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
														if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem'][$sif]['refNumber']) {
															if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															} else {
																$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														}
													}
												}
											}
										} else {
											
										}
									} else {
										
									}
								}
							} else {
								if ($testing[$n]['ref'] == $s['segmentFlightRef']['referencingDetail']['refNumber']) {
									$testing[$n]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount']['value'];
									$testing[$n]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount']['value'];

									if (!isset($s['paxFareProduct'][0])) {
										$testing[$n]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc']['value'];
										$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));

										if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
											$testing[$n]['paxFareProduct']['count'] = "1";
											$testing[$n]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref']['value'];
											if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
												$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator']['value'];
											} else {
												$testing[$n]['paxFareProduct']['infantIndicator'] = "";
											}
										} else {
											$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
											$count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
											for ($p = 0; $p < $count_traveller; $p++) {
												$testing[$n]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref']['value'];
												if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
													$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator']['value'];
												} else {
													$testing[$n]['paxFareProduct']['infantIndicator'] = "";
												}
											}
										}

										$testing[$n]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount']['value'];
										$testing[$n]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount']['value'];

										$testing[$n]['paxFareProduct']['description'] = "";
										if (!isset($s['paxFareProduct']['fare'][0])) {
											//need updation	
											$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
											$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

											//Description
											$count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
											if ($count_description <= 1) {
												$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description']['value'] . " ";
											} else {
												for ($f = 0; $f < $count_description; $f++) {
													$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f]['value'] . " ";
												}
											}
										} else {
											$count_fare = (count($s['paxFareProduct']['fare']));
											for ($e = 0; $e < $count_fare; $e++) {
												$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
												$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

												//Description
												if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) {
													$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description']['value'] . " ";
												} else {
													$count_description = (count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']));
													for ($f = 0; $f < $count_description; $f++) {
														$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f]['value'] . " ";
													}
												}
											}
										}

										if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
											$testing[$n]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
											$testing[$n]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
											if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
												$testing[$n]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
											else
												$testing[$n]['paxFareProduct']['avlStatus'] = '';
											$testing[$n]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
											$testing[$n]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
										}
										else {
											$count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
											for ($u = 0; $u < $count_groupOfFares; $u++) {
												$testing[$n]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd']['value'];
												$testing[$n]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']['value'];
												if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
													$testing[$n]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']['value'];
												else
													$testing[$n]['paxFareProduct']['avlStatus'][$u] = '';
												$testing[$n]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint']['value'];
												$testing[$n]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType']['value'];
											}
										}
										$testing[$n]['paxFareProduct']['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
										$testing[$n]['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
									}
									else {
										$count_paxFareProduct = (count($s['paxFareProduct']));
										for ($d = 0; $d < $count_paxFareProduct; $d++) {
											$testing[$n]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc']['value'];
											if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
												$testing[$n]['paxFareProduct'][$d]['count'] = "1";
												$testing[$n]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref']['value'];
												if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator']['value'])) {
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator']['value'];
												} else {
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
												}
											} else {
												$testing[$n]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
												$count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
												for ($p = 0; $p < $count_traveller; $p++) {
													$testing[$n]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref']['value'];
												}
												if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator']['value'];
												} else {
													$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
												}
											}

											$testing[$n]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
											$testing[$n]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

											$testing[$n]['paxFareProduct'][$d]['description'] = "";
											if (!isset($s['paxFareProduct'][$d]['fare'][0])) {
												//need updation	
												$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
												$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

												if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) {
													$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description']['value'] . " ";
												} else {
													$count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
													for ($f = 0; $f < $count_description; $f++) {
														$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f]['value'];
													}
												}
											} else {
												$count_fare = (count($s['paxFareProduct'][$d]['fare']));
												for ($e = 0; $e < $count_fare; $e++) {
													$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
													$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

													$count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
													if ($count_description <= 1) {
														$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']['value'] . " ";
													} else {
														for ($f = 0; $f < $count_description; $f++) {
															$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f]['value'] . " ";
														}
													}
												}
											}

											if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) {
												if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) {
													$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
													$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
													$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
													$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value']['value'];
													$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
												} else {
													$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
													for ($g = 0; $g < $count_groupOfFares; $g++) {
														$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
														$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
														$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
														$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
														$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
													}
												}
												$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
												$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
											} else {
												$countfareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
												for ($cfd = 0; $cfd < $countfareDetails; $cfd++) {
													if (!isset($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][0])) {
														$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
														$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
														$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
														$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['breakPoint']['value'];
														$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
													} else {
														$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']);
														for ($g = 0; $g < $count_groupOfFares; $g++) {
															$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
															$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
															$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
															$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
															$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
														}
													}
													$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator']['value'];
													$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];
												}
											}
												
										}
									}


									if (isset($s['specificRecDetails'])) {
										if (isset($s['specificRecDetails'][0])) {
											$count_specificRecDetails = (count($s['specificRecDetails']));
											for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) {
												if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) {
													if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber']) {
														if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
															$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														} else {
															$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													}
												} else {
													$count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
													for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
														if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber']) {
															if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															} else {
																$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														}
													}
												}
											}
										} else {
											if (!isset($s['specificRecDetails']['specificRecItem'][0])) {
												if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem']['refNumber']) {
													if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
														$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
														for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
															$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													} else {
														$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
													}
												}
											} else {
												$count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
												for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
													if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem'][$sif]['refNumber']) {
														if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
															$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														} else {
															$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
														}
													}
												}
											}
										}
									} else {
										
									}
								} else {
									
								}
							}
						} else {
							$count_segmentFlightRef = (count($s['segmentFlightRef']));
							for ($c = 0; $c < $count_segmentFlightRef; $c++) {
								if (isset($s['segmentFlightRef'][$c]['referencingDetail'][0])) {
									$count_referencingDetail = (count($s['segmentFlightRef'][$c]['referencingDetail']));
									for ($crd = 0; $crd < $count_referencingDetail; $crd++) {
										if ($testing[$n]['ref'] == $s['segmentFlightRef'][$c]['referencingDetail'][$crd]['refNumber']) {
											$testing[$n]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount']['value'];
											$testing[$n]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount']['value'];

											if (!isset($s['paxFareProduct'][0])) {
												$testing[$n]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc']['value'];
												;
												$testing[$n]['paxFareProduct']['count'] = count($s['paxFareProduct']['paxReference']['traveller']);

												if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
													$testing[$n]['paxFareProduct']['count'] = "1";
													$testing[$n]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref']['value'];
													if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
														$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator']['value'];
													} else {
														$testing[$n]['paxFareProduct']['infantIndicator'] = "";
													}
												} else {
													$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
													$count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
													for ($p = 0; $p < $count_traveller; $p++) {
														$testing[$n]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref']['value'];
													}
													if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
														$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator']['value'];
													} else {
														$testing[$n]['paxFareProduct']['infantIndicator'] = "";
													}
												}

												$testing[$n]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount']['value'];
												$testing[$n]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount']['value'];

												$testing[$n]['paxFareProduct']['description'] = "";
												if (!isset($s['paxFareProduct']['fare'][0])) {
													//need updation
													$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
													$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

													if (!isset($s['paxFareProduct']['fare']['pricingMessage']['description'][0])) {
														$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description']['value'] . " ";
													} else {
														$count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
														for ($f = 0; $f < $count_description; $f++) {
															$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f]['value'] . " ";
														}
													}
												} else {
													$count_fare = count($s['paxFareProduct']['fare']);
													for ($e = 0; $e < $count_fare; $e++) {
														$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
														$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

														if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) {
															$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description']['value'] . " ";
														} else {
															$count_description = count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']);
															for ($f = 0; $f < $count_description; $f++) {
																$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f]['value'] . " ";
															}
														}
													}
												}

												if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
													$testing[$n]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
													$testing[$n]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
													if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
														$testing[$n]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
													else
														$testing[$n]['paxFareProduct']['avlStatus'] = '';
													$testing[$n]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
													$testing[$n]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
												}

												else {
													$count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
													for ($u = 0; $u < $count_groupOfFares; $u++) {
														$testing[$n]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd']['value'];
														$testing[$n]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']['value'];
														if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
															$testing[$n]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']['value'];
														else
															$testing[$n]['paxFareProduct']['avlStatus'][$u] = '';
														$testing[$n]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint']['value'];
														$testing[$n]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType']['value'];
													}
												}
												$testing[$n]['paxFareProduct']['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
												$testing[$n]['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
											}
											else {
												$count_paxFareProduct = (count($s['paxFareProduct']));
												for ($d = 0; $d < $count_paxFareProduct; $d++) {
													$testing[$n]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc']['value'];
													if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
														$testing[$n]['paxFareProduct'][$d]['count'] = "1";
														$testing[$n]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref']['value'];
														if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) {
															$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator']['value'];
														} else {
															$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
														}
													} else {
														$testing[$n]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
														$count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
														for ($p = 0; $p < $count_traveller; $p++) {
															$testing[$n]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref']['value'];
														}
														if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
															$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator']['value'];
														} else {
															$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
														}
													}

													$testing[$n]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount']['value'];
													$testing[$n]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount']['value'];

													$testing[$n]['paxFareProduct'][$d]['description'] = "";
													if (!isset($s['paxFareProduct'][$d]['fare'][0])) {
														//need updation	
														$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
														$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

														if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) {
															$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description']['value'] . " ";
														} else {
															$count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
															for ($f = 0; $f < $count_description; $f++) {
																$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f]['value'] . " ";
															}
														}
													} else {
														$count_fare = (count($s['paxFareProduct'][$d]['fare']));
														for ($e = 0; $e < $count_fare; $e++) {
															$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
															$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

															if (!isset($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][0])) {
																$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']['value'] . " ";
															} else {
																$count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
																for ($f = 0; $f < $count_description; $f++) {
																	$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f]['value'];
																}
															}
														}
													}
													if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) {
														if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) {
															$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
															$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
															$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
															$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
															$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
														} else {
															$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
															for ($g = 0; $g < $count_groupOfFares; $g++) {
																$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
																$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
																$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
																$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
																$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
															}
														}
														$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
														$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];
													} else {
														$count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
														for ($cfd = 0; $cfd < $count_fareDetails; $cfd++) {
															if (!isset($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][0])) {
																$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
																$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
																$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
																$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['breakPoint']['value'];
																$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
															} else {
																$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares']);
																for ($g = 0; $g < $count_groupOfFares; $g++) {
																	$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
																	$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
																	$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
																	$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
																	$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
																}
															}
															$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator']['value'];
															$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator']['value'];
														}
													}
								
												}
											}


											if (isset($s['specificRecDetails'])) {
												if (isset($s['specificRecDetails'][0])) {
													$count_specificRecDetails = (count($s['specificRecDetails']));
													for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) {
														if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) {
															if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber']) {
																if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																	$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																	for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																		$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																	}
																} else {
																	$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															}
														} else {
															$count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
															for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
																if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber']) {
																	if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																		$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																		for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																			$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																		}
																	} else {
																		$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																	}
																}
															}
														}
													}
												} else {
													if (!isset($s['specificRecDetails']['specificRecItem'][0])) {
														if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem']['refNumber']) {
															if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															} else {
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
															}
														}
													} else {
														$count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
														for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
															if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem'][$sif]['refNumber']) {
																if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																	$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																	for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																		$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																	}
																} else {
																	$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType'];
																}
															}
														}
													}
												}
											} else {
												
											}
										} else {
											//nothing
										}
									}
								} else {
									if ($testing[$n]['ref'] == $s['segmentFlightRef'][$c]['referencingDetail']['refNumber']) {
										$testing[$n]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount']['value'];
										$testing[$n]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount']['value'];

										if (!isset($s['paxFareProduct'][0])) {
											$testing[$n]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc']['value'];
											;
											$testing[$n]['paxFareProduct']['count'] = count($s['paxFareProduct']['paxReference']['traveller']);

											if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
												$testing[$n]['paxFareProduct']['count'] = "1";
												$testing[$n]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref']['value'];
												if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
													$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator']['value'];
												} else {
													$testing[$n]['paxFareProduct']['infantIndicator'] = "";
												}
											} else {
												$testing[$n]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
												$count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
												for ($p = 0; $p < $count_traveller; $p++) {
													$testing[$n]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref']['value'];
												}
												if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
													$testing[$n]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator']['value'];
												} else {
													$testing[$n]['paxFareProduct']['infantIndicator'] = "";
												}
											}

											$testing[$n]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount']['value'];
											$testing[$n]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount']['value'];

											$testing[$n]['paxFareProduct']['description'] = "";
											if (!isset($s['paxFareProduct']['fare'][0])) {
												//need updation
												$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
												$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];

												if (!isset($s['paxFareProduct']['fare']['pricingMessage']['description'][0])) {
													$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description']['value'] . " ";
												} else {
													$count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
													for ($f = 0; $f < $count_description; $f++) {
														$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f]['value'] . " ";
													}
												}
											} else {
												$count_fare = count($s['paxFareProduct']['fare']);
												for ($e = 0; $e < $count_fare; $e++) {
													$testing[$n]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
													$testing[$n]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

													if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) {
														$testing[$n]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description']['value'] . " ";
													} else {
														$count_description = count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']);
														for ($f = 0; $f < $count_description; $f++) {
															$testing[$n]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f]['value'] . " ";
														}
													}
												}
											}

											if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
												$testing[$n]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
												$testing[$n]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
												if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
													$testing[$n]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
												else
													$testing[$n]['paxFareProduct']['avlStatus'] = '';
												$testing[$n]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
												$testing[$n]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
											}
											else {
												$count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
												for ($u = 0; $u < $count_groupOfFares; $u++) {
													$testing[$n]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd']['value'];
													$testing[$n]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']['value'];
													if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
														$testing[$n]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']['value'];
													else
														$testing[$n]['paxFareProduct']['avlStatus'][$u] = '';
													$testing[$n]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint']['value'];
													$testing[$n]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType']['value'];
												}
											}
											$testing[$n]['paxFareProduct']['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
											$testing[$n]['designator'] = $s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
										}
										else {
											$count_paxFareProduct = (count($s['paxFareProduct']));
											for ($d = 0; $d < $count_paxFareProduct; $d++) {
												$testing[$n]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc']['value'];
												if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
													$testing[$n]['paxFareProduct'][$d]['count'] = "1";
													$testing[$n]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref']['value'];
													if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) {
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator']['value'];
													} else {
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
													}
												} else {
													$testing[$n]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
													$count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
													for ($p = 0; $p < $count_traveller; $p++) {
														$testing[$n]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref']['value'];
													}
													if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator']['value'];
													} else {
														$testing[$n]['paxFareProduct'][$d]['infantIndicator'] = "";
													}
												}

												$testing[$n]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount']['value'];
												$testing[$n]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount']['value'];

												$testing[$n]['paxFareProduct'][$d]['description'] = "";
												if (!isset($s['paxFareProduct'][$d]['fare'][0])) {
													//need updation	
													$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
													$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

													if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) {
														$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description']['value'] . " ";
													} else {
														$count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
														for ($f = 0; $f < $count_description; $f++) {
															$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f]['value'] . " ";
														}
													}
												} else {
													$count_fare = (count($s['paxFareProduct'][$d]['fare']));
													for ($e = 0; $e < $count_fare; $e++) {
														$testing[$n]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
														$testing[$n]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

														if (!isset($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][0])) {
															$testing[$n]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']['value'] . " ";
														} else {
															$count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
															for ($f = 0; $f < $count_description; $f++) {
																$testing[$n]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f]['value'];
															}
														}
													}
												}

												if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) {
													$testing[$n]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
													$testing[$n]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
													$testing[$n]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
													$testing[$n]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
													$testing[$n]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
												} else {
													$count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
													for ($g = 0; $g < $count_groupOfFares; $g++) {
														$testing[$n]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
														$testing[$n]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
														$testing[$n]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
														$testing[$n]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
														$testing[$n]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
													}
												}
												$testing[$n]['paxFareProduct'][$d]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
												$testing[$n]['designator'] = $s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator']['value'];
											}
										}

										if (isset($s['specificRecDetails'])) {
											if (isset($s['specificRecDetails'][0])) {
												$count_specificRecDetails = (count($s['specificRecDetails']));
												for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) {
													if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) {
														if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber']) {
															if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
																}
															} else {
																$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
															}
														}
													} else {
														$count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
														for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
															if ($testing[$n]['ref'] == $s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber']) {
																if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																	$count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																	for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																		$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
																	}
																} else {
																	$testing[$n]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
																}
															}
														}
													}
												}
											} else {
												if (!isset($s['specificRecDetails']['specificRecItem'][0])) {
													if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem']['refNumber']) {
														if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
															$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
															for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
															}
														} else {
															$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
														}
													}
												} else {
													$count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
													for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
														if ($testing[$n]['ref'] == $s['specificRecDetails']['specificRecItem'][$sif]['refNumber']) {
															if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
																$count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
																for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
																	$testing[$n]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
																}
															} else {
																$testing[$n]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
															}
														}
													}
												}
											}
										} else {
											
										}
									} else {
										//nothing
									}
								}
							}
						}
					}
				}
                


                $data['flight_result'] = $testing;
                $data['currency'] = $currency;
            } else {
                $data['flight_result'] = '';
                $data['currency'] = '';
            }
        } 
        else if (($_SESSION['journey_type'] == "MultiCity")) {
            if (!empty($data['flight_result'])) {
                $flight_result = $data['flight_result'];
                $currency = $flight_result['conversionRate']['conversionRateDetail']['currency'];

                if (!isset($flight_result['flightIndex'][0])) {
                    $flight_details = $flight_result['flightIndex']['groupOfFlights'];
                    if (!isset($flight_details[0])) {
                        $count_flight_details = count($flight_details['flightDetails']);
                        $i = 0;
                        $testing[$i]['ref'] = $flight_details['propFlightGrDetail']['flightProposal'][0]['ref'];
                        $testing[$i]['eft'] = $flight_details['propFlightGrDetail']['flightProposal'][1]['ref'];
                        if ($count_flight_details <= 1) {
                            $testing[$i]['dateOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                            $testing[$i]['timeOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                            $testing[$i]['dateOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                            $testing[$i]['timeOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                            $testing[$i]['flightOrtrainNumber'] = $flight_details['flightDetails']['flightInformation']['flightOrtrainNumber'];
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
                        else {
                            for ($j = 0; $j < $count_flight_details; $j++) {
                                $testing[$i]['dateOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                $testing[$i]['timeOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                $testing[$i]['dateOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                $testing[$i]['timeOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                $testing[$i]['flightOrtrainNumber'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['flightOrtrainNumber'];
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
                    else {
                        $count_flight_result = count($flight_details);
                        for ($i = 0; $i < $count_flight_result; $i++) {
                            $count_flight_details = count($flight_details[$i]['flightDetails']);
                            $testing[$i]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref'];
                            $testing[$i]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref'];
                            if ($count_flight_details <= 1) {
                                $testing[$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                                $testing[$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                                $testing[$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                                $testing[$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                                $testing[$i]['flightOrtrainNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightOrtrainNumber'];
                                $testing[$i]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
                                $testing[$i]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
                                $testing[$i]['locationIdDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][0]['locationId'];
                                $testing[$i]['locationIdArival'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][1]['locationId'];
                                $testing[$i]['equipmentType'] = $flight_details[$i]['flightDetails']['flightInformation']['productDetail']['equipmentType'];
                                $testing[$i]['electronicTicketing'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
                                if (isset($flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
                                    $testing[$i]['productDetailQualifier'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
                                else
                                    $testing[$i]['productDetailQualifier'] = '';
                            }
                            else {
                                for ($j = 0; $j < $count_flight_details; $j++) {
                                    $testing[$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                    $testing[$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                    $testing[$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                    $testing[$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                    $testing[$i]['flightOrtrainNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightOrtrainNumber'];
                                    $testing[$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
                                    $testing[$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
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
                else {
                    $count_group = (count($flight_result['flightIndex']));
                    $k = 0;
                    for ($fg = 0; $fg < $count_group; $fg++) {
                        $flight_details = $flight_result['flightIndex'][$fg]['groupOfFlights'];
                        if (!isset($flight_details[0])) {
                            $count_flight_details = count($flight_details['flightDetails']);
                            $i = 0;
                            $testing[$fg][$i]['ref'] = $flight_details['propFlightGrDetail']['flightProposal'][0]['ref'];
                            $testing[$fg][$i]['eft'] = $flight_details['propFlightGrDetail']['flightProposal'][1]['ref'];
                            if ($count_flight_details <= 1) {
                                $testing[$fg][$i]['dateOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                                $testing[$fg][$i]['timeOfDeparture'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                                $testing[$fg][$i]['dateOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                                $testing[$fg][$i]['timeOfArrival'] = $flight_details['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                                $testing[$fg][$i]['flightOrtrainNumber'] = $flight_details['flightDetails']['flightInformation']['flightOrtrainNumber'];
                                $testing[$fg][$i]['marketingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
                                $testing[$fg][$i]['operatingCarrier'] = $flight_details['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
                                $testing[$fg][$i]['locationIdDeparture'] = $flight_details['flightDetails']['flightInformation']['location'][0]['locationId'];
                                $testing[$fg][$i]['locationIdArival'] = $flight_details['flightDetails']['flightInformation']['location'][1]['locationId'];
                                $testing[$fg][$i]['equipmentType'] = $flight_details['flightDetails']['flightInformation']['productDetail']['equipmentType'];
                                $testing[$fg][$i]['electronicTicketing'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
                                if (isset($flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
                                    $testing[$fg][$i]['productDetailQualifier'] = $flight_details['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
                                else
                                    $testing[$fg][$i]['productDetailQualifier'] = '';
                            }
                            else {
                                for ($j = 0; $j < $count_flight_details; $j++) {
                                    $testing[$fg][$i]['dateOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                    $testing[$fg][$i]['timeOfDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                    $testing[$fg][$i]['dateOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                    $testing[$fg][$i]['timeOfArrival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                    $testing[$fg][$i]['flightOrtrainNumber'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['flightOrtrainNumber'];
                                    $testing[$fg][$i]['marketingCarrier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
                                    $testing[$fg][$i]['operatingCarrier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
                                    $testing[$fg][$i]['locationIdDeparture'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['location'][0]['locationId'];
                                    $testing[$fg][$i]['locationIdArival'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['location'][1]['locationId'];
                                    $testing[$fg][$i]['equipmentType'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType'];
                                    $testing[$fg][$i]['electronicTicketing'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing'];
                                    if (isset($light_details['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']))
                                        $testing[$fg][$i]['productDetailQualifier'][$j] = $flight_details['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
                                    else
                                        $testing[$fg][$i]['productDetailQualifier'][$j];
                                }
                            }
                        }
                        else {
                            $count_flight_result = count($flight_details);
                            for ($i = 0; $i < $count_flight_result; $i++) {
                                $count_flight_details = count($flight_details[$i]['flightDetails']);
                                $testing[$fg][$i]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref'];
                                $testing[$fg][$i]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref'];
                                if (!isset($flight_details[$i]['flightDetails'][0])) {
                                    $testing[$fg][$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture'];
                                    $testing[$fg][$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture'];
                                    $testing[$fg][$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival'];
                                    $testing[$fg][$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival'];
                                    $testing[$fg][$i]['flightOrtrainNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightOrtrainNumber'];
                                    $testing[$fg][$i]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier'];
                                    $testing[$fg][$i]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier'];
                                    $testing[$fg][$i]['locationIdDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][0]['locationId'];
                                    $testing[$fg][$i]['locationIdArival'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][1]['locationId'];
                                    $testing[$fg][$i]['equipmentType'] = $flight_details[$i]['flightDetails']['flightInformation']['productDetail']['equipmentType'];
                                    $testing[$fg][$i]['electronicTicketing'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing'];
                                    if (isset($flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
                                        $testing[$fg][$i]['productDetailQualifier'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier'];
                                    else
                                        $testing[$fg][$i]['productDetailQualifier'] = '';$k++;
                                }
                                else {
                                    for ($j = 0; $j < $count_flight_details; $j++) {
                                        $testing[$fg][$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture'];
                                        $testing[$fg][$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture'];
                                        $testing[$fg][$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival'];
                                        $testing[$fg][$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival'];
                                        $testing[$fg][$i]['flightOrtrainNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightOrtrainNumber'];
                                        $testing[$fg][$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier'];
                                        $testing[$fg][$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier'];
                                        $testing[$fg][$i]['locationIdDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][0]['locationId'];
                                        $testing[$fg][$i]['locationIdArival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][1]['locationId'];
                                        $testing[$fg][$i]['equipmentType'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType'];
                                        $testing[$fg][$i]['electronicTicketing'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing'];
                                        if (isset($flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']))
                                            $testing[$fg][$i]['productDetailQualifier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier'];
                                        else
                                            $testing[$fg][$i]['productDetailQualifier'][$j] = '';
                                    }
                                }
                            }
                        }
                    }
                }
                if(isset($flight_result['recommendation'][0]))
					$flight_recommendation = $flight_result['recommendation'];
				else
					$flight_recommendation[0] = $flight_result['recommendation'];
                $i = 0;
                foreach ($flight_recommendation as $p => $s) {
                    $count_segmentFlightRef = (count($s['segmentFlightRef']));
                    if (!isset($s['segmentFlightRef'][0])) {
						$c=0;
                         $count_testing = count($testing);
                            for ($ni = 0; $ni < $count_testing; $ni++) {
                                $count_testing_segment = count($testing[$ni]);
                                for ($n = 0; $n < $count_testing_segment; $n++) {
                                    if (isset($s['segmentFlightRef']['referencingDetail'][0])) {
                                        $count_referencingDetail = (count($s['segmentFlightRef']['referencingDetail']));
                                        for ($crd = 0; $crd < $count_referencingDetail; $crd++) {
                                            if ($ni == $crd) {
                                                if ($testing[$ni][$n]['ref'] == $s['segmentFlightRef']['referencingDetail'][$crd]['refNumber']) {
                                                    $segflightFinal[$i][$c][$crd] = $testing[$ni][$n];
                                                    $segflightFinal[$i][$c][$crd]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
                                                    $segflightFinal[$i][$c][$crd]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

                                                    if (!isset($s['paxFareProduct'][0])) {
                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['count'] = count($s['paxFareProduct']['paxReference']['traveller']);

                                                        if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['count'] = "1";
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
                                                            if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
                                                            } else {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['infantIndicator'] = "";
                                                            }
                                                        } else {
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
                                                            $count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
                                                            for ($p = 0; $p < $count_traveller; $p++) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
                                                            }
                                                            if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
                                                            } else {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['infantIndicator'] = "";
                                                            }
                                                        }

                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];

                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'] = "";
                                                        if (!isset($s['paxFareProduct']['fare'][0])) {
                                                            //need updation
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                                            if (!isset($s['paxFareProduct']['fare']['pricingMessage']['description'][0])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description'] . " ";
                                                            } else {
                                                                $count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
                                                                for ($f = 0; $f < $count_description; $f++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f] . " ";
                                                                }
                                                            }
                                                        } else {
                                                            $count_fare = count($s['paxFareProduct']['fare']);
                                                            for ($e = 0; $e < $count_fare; $e++) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                                if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description'] . " ";
                                                                } else {
                                                                    $count_description = count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']);
                                                                    for ($f = 0; $f < $count_description; $f++) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f] . " ";
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        if (!isset($s['paxFareProduct']['fareDetails'][0])) {
                                                            if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                                if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                                else
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'] = '';
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                            }
                                                            else {
                                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
                                                                for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                                    if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                                    else
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'][$u] = '';
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                                                }
                                                            }
                                                        }
                                                        else {
                                                            $count_fareDetails = (count($s['paxFareProduct']['fareDetails']));
                                                           
                                                            if (!isset($s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][0])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                                if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation'][$crd]['cabinProduct']['avlStatus']))
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                                else
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'] = '';
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['breakPoint'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                            }
                                                            else {
                                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']));
                                                                for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                                    if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation'][$crd]['cabinProduct']['avlStatus']))
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                                    else
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'][$u] = '';
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                                                }
                                                            }
                                                            //}
                                                        }
                                                      
                                                    }
                                                    else {
                                                        $count_paxFareProduct = (count($s['paxFareProduct']));
                                                        for ($d = 0; $d < $count_paxFareProduct; $d++) {
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
                                                            if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['count'] = "1";
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
                                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
                                                                } else {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                                }
                                                            } else {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                                $count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                                for ($p = 0; $p < $count_traveller; $p++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
                                                                }
                                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
                                                                } else {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                                }
                                                            }

                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'] = "";
                                                            if (!isset($s['paxFareProduct'][$d]['fare'][0])) {
                                                                //need updation	
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                                                if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description'] . " ";
                                                                } else {
                                                                    $count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
                                                                    for ($f = 0; $f < $count_description; $f++) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f] . " ";
                                                                    }
                                                                }
                                                            } else {
                                                                $count_fare = (count($s['paxFareProduct'][$d]['fare']));
                                                                for ($e = 0; $e < $count_fare; $e++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                                    if (!isset($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][0])) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'] . " ";
                                                                    } else {
                                                                        $count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
                                                                        for ($f = 0; $f < $count_description; $f++) {
                                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) {
                                                                if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                                } else {
                                                                    $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
                                                                    for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                                    }
                                                                }
                                                            } else {
                                                                $count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
                                                                
                                                                if (!isset($s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][0])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['breakPoint'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                                } else {
                                                                    $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']);
                                                                    for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                                    }
                                                                }
                                                                //}
                                                            }
								
                                                        }
                                                    }
                                                } else {
                                                    //nothing
                                                }
                                            } else {
                                                
                                            }
                                        }
                                    } else {
                                        
                                    }
                                }
                            }
                       
                    } else {
                        $count_segmentFlightRef = (count($s['segmentFlightRef']));
                        for ($c = 0; $c < $count_segmentFlightRef; $c++) {
                            $count_testing = count($testing);
                            for ($ni = 0; $ni < $count_testing; $ni++) {
                                $count_testing_segment = count($testing[$ni]);
                                for ($n = 0; $n < $count_testing_segment; $n++) {
                                    if (isset($s['segmentFlightRef'][$c]['referencingDetail'][0])) {
                                        $count_referencingDetail = (count($s['segmentFlightRef'][$c]['referencingDetail']));
                                        for ($crd = 0; $crd < $count_referencingDetail; $crd++) {
                                            if ($ni == $crd) {
                                                if ($testing[$ni][$n]['ref'] == $s['segmentFlightRef'][$c]['referencingDetail'][$crd]['refNumber']) {
                                                    $segflightFinal[$i][$c][$crd] = $testing[$ni][$n];
                                                    $segflightFinal[$i][$c][$crd]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount'];
                                                    $segflightFinal[$i][$c][$crd]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount'];

                                                    if (!isset($s['paxFareProduct'][0])) {
                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc'];
                                                        ;
                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['count'] = count($s['paxFareProduct']['paxReference']['traveller']);

                                                        if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['count'] = "1";
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref'];
                                                            if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator'];
                                                            } else {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['infantIndicator'] = "";
                                                            }
                                                        } else {
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
                                                            $count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
                                                            for ($p = 0; $p < $count_traveller; $p++) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref'];
                                                            }
                                                            if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'];
                                                            } else {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['infantIndicator'] = "";
                                                            }
                                                        }

                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount'];
                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount'];

                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'] = "";
                                                        if (!isset($s['paxFareProduct']['fare'][0])) {
                                                            //need updation
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                                            if (!isset($s['paxFareProduct']['fare']['pricingMessage']['description'][0])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'] = $s['paxFareProduct']['fare']['pricingMessage']['description'] . " ";
                                                            } else {
                                                                $count_description = (count($s['paxFareProduct']['fare']['pricingMessage']['description']));
                                                                for ($f = 0; $f < $count_description; $f++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'].=$s['paxFareProduct']['fare']['pricingMessage']['description'][$f] . " ";
                                                                }
                                                            }
                                                        } else {
                                                            $count_fare = count($s['paxFareProduct']['fare']);
                                                            for ($e = 0; $e < $count_fare; $e++) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                                if (!isset($s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][0])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['description'] . " ";
                                                                } else {
                                                                    $count_description = count($s['paxFareProduct']['fare'][$e]['pricingMessage']['description']);
                                                                    for ($f = 0; $f < $count_description; $f++) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['description'].=$s['paxFareProduct']['fare'][$e]['pricingMessage']['description'][$f] . " ";
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        if (!isset($s['paxFareProduct']['fareDetails'][0])) {
                                                            if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                                if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                                else
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'] = '';
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                            }
                                                            else {
                                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
                                                                for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                                    if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                                    else
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'][$u] = '';
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                                                }
                                                            }
                                                        }
                                                        else {
                                                            $count_fareDetails = (count($s['paxFareProduct']['fareDetails']));
                                                          
                                                            if (!isset($s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][0])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['rbd'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['cabin'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                                if (isset($s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation'][$crd]['cabinProduct']['avlStatus']))
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                                else
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'] = '';
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['breakPoint'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['breakPoint'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct']['fareType'] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                            }
                                                            else {
                                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails'][$crd]['groupOfFares']));
                                                                for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['rbd'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['cabin'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin'];
                                                                    if (isset($s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation'][$crd]['cabinProduct']['avlStatus']))
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus'];
                                                                    else
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct']['avlStatus'][$u] = '';
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['breakPoint'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct']['fareType'][$u] = $s['paxFareProduct']['fareDetails'][$crd]['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType'];
                                                                }
                                                            }
                                                            
                                                        }
                                                       
                                                    }
                                                    else {
                                                        $count_paxFareProduct = (count($s['paxFareProduct']));
                                                        for ($d = 0; $d < $count_paxFareProduct; $d++) {
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc'];
                                                            if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['count'] = "1";
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref'];
                                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'];
                                                                } else {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                                }
                                                            } else {
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                                $count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                                for ($p = 0; $p < $count_traveller; $p++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref'];
                                                                }
                                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'];
                                                                } else {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                                }
                                                            }

                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount'];
                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount'];

                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'] = "";
                                                            if (!isset($s['paxFareProduct'][$d]['fare'][0])) {
                                                                //need updation	
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                                $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType'];

                                                                if (!isset($s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][0])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['description'] . " ";
                                                                } else {
                                                                    $count_description = (count($s['paxFareProduct'][$d]['fare']['pricingMessage']['description']));
                                                                    for ($f = 0; $f < $count_description; $f++) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare']['pricingMessage']['description'][$f] . " ";
                                                                    }
                                                                }
                                                            } else {
                                                                $count_fare = (count($s['paxFareProduct'][$d]['fare']));
                                                                for ($e = 0; $e < $count_fare; $e++) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType'];

                                                                    if (!isset($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][0])) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'] . " ";
                                                                    } else {
                                                                        $count_description = (count($s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description']));
                                                                        for ($f = 0; $f < $count_description; $f++) {
                                                                            $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['description'].=$s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['description'][$f];
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            if (!isset($s['paxFareProduct'][$d]['fareDetails'][0])) {
                                                                if (!isset($s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][0])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                                } else {
                                                                    $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
                                                                    for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                                    }
                                                                }
                                                            } else {
                                                                $count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
                                                                //for($cfd=0;$cfd<$count_fareDetails;$cfd++)
                                                                //{
                                                                if (!isset($s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][0])) {
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['rbd'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['cabin'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['breakPoint'];
                                                                    $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']['productInformation']['fareProductDetail']['fareType'];
                                                                } else {
                                                                    $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares']);
                                                                    for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['breakPoint'];
                                                                        $segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$crd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType'];
                                                                    }
                                                                }
                                                                //}
                                                            }
                                                           								
                                                        }
                                                    }
                                                } else {
                                                    //nothing
                                                }
                                            } else {
                                                
                                            }
                                        }
                                    } else {
                                        
                                    }
                                }
                            }
                       
                        }
                    }$i++;
                }


                $data['flight_result'] = $segflightFinal;
                $data['currency'] = $currency;
            } else {
                $data['flight_result'] = '';
                $data['currency'] = '';
            }
        }
        
        if (($_SESSION['journey_type'] == "OneWay")) {
            $this->fetch_flight_search_result($data, $rand_id);
        } else if ($_SESSION['journey_type'] == "Round") {
        	           
        	
            $this->fetch_flight_search_result_Round_Trip($data, $rand_id);
        } else if ($_SESSION['journey_type'] == "Calendar") {
            $this->fetch_flight_search_result_Round_Trip_Calendar($data, $rand_id);
        } 
    }

    // Converting arry details for display and filter for Round_Trip_Calendar
    public function fetch_flight_search_result_Round_Trip_Calendar($data, $rand_id) 
    {
	$flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
	$data2 = "";$data4 = "";$testing = "";
        if ($flight_result != '') {
            $count_val = count($flight_result);
            $i = 0;$total = 0;
            foreach ($flight_result as $flight_result1) {
                $count_code = count($flight_result1['oneWay']['marketingCarrier']);
				
                if ($count_code <= 1) {
                    $name = $this->Flight_Model->get_flight_name($flight_result1['oneWay']['marketingCarrier']);
                    if ($name != '') {
                        $testing['oneway'][$i]['cicode'] = $flight_result1['oneWay']['marketingCarrier']['value'];
                        $testing['oneway'][$i]['eft'] = $flight_result1['oneWay']['eft']['value'];
                        $testing['oneway'][$i]['name'] = $name;
			$testing['oneway'][$i]['fnumber'] = $flight_result1['oneWay']['flightOrtrainNumber']['value'];
                        $testing['oneway'][$i]['equipmentType'] = $flight_result1['oneWay'] ['equipmentType']['value'];
                        $testing['oneway'][$i]['dlocation'] = $flight_result1['oneWay']['locationIdDeparture']['value'];
                        $departureDate = $flight_result1['oneWay']['dateOfDeparture']['value'];
                        $departureTime = $flight_result1['oneWay']['timeOfDeparture']['value'];
                        $testing['oneway'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

                        $testing['oneway'][$i]['alocation'] = $flight_result1['oneWay']['locationIdArival']['value'];
                        $arrivalDate = $flight_result1['oneWay']['dateOfArrival'];
                        $arrivalTime = $flight_result1['oneWay']['timeOfArrival'];
                        $testing['oneway'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

                        $departureDate=$testing['oneway'][$i]['dateOfDeparture'] = $flight_result1['oneWay']['dateOfDeparture']['value'];
                        $departureTime = $flight_result1['oneWay']['timeOfDeparture']['value'];
                        $arrivalDate = $testing['oneway'][$i]['dateOfArrival']=  $flight_result1['oneWay']['dateOfArrival']['value'];
                        $arrivalTime = $flight_result1['oneWay']['timeOfArrival']['value'];
                        $testing['oneway'][$i]['timeOfDeparture'] = $flight_result1['oneWay']['timeOfDeparture']['value'];
                        $testing['oneway'][$i]['timeOfArrival'] = $flight_result1['oneWay']['timeOfArrival']['value'];

                        if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
                            $testing['oneway'][$i]['redeye'] = "Yes";
                        else
                            $testing['oneway'][$i]['redeye'] = "No";

                        $testing['oneway'][$i]['dtime_filter'] = $flight_result1['oneWay']['timeOfDeparture']['value'];
                        $testing['oneway'][$i]['atime_filter'] = $arrivalTime;
                        $testing['oneway'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                        $testing['oneway'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";
						$testing['oneway'][$i]['dep_date'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                        $testing['oneway'][$i]['arv_date'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));
						
						//Final Duration Part
                        $testing['oneway'][$i]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                        $testing['oneway'][$i]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                        $date_a = new DateTime($testing['oneway'][$i]['ddate1']);
                        $date_b = new DateTime($testing['oneway'][$i]['adate1']);
                        $interval = date_diff($date_a, $date_b);
                        $testing['oneway'][$i]['duration_final'] = $interval->format('%h hours %i minutes');
                        $testing['oneway'][$i]['duration_final1'] = $interval->format('%h h %i m');
						$eft_final = str_split($flight_result1['oneWay']['eft'],2);
						if($_SESSION['lang']=='en')
							$testing['oneway'][$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
						else
							$testing['oneway'][$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
                        
                        $hour = $interval->format('%h');
                        $min = $interval->format('%i');
                        $dur_in_min = (($hour * 60) + $min);
                        $testing['oneway'][$i]['dur_in_min'] = $dur_in_min;
                        if($flight_result1['MultiTicket']=="Yes")
                        {
							$total = (($flight_result1['Recomm'][0]['totalFareAmount']['value'])+(($flight_result1['Recomm'][1]['totalFareAmount']['value'])));
							$testing['oneway'][$i]['pamount'] = $total;
							$testing['oneway'][$i]['FareAmount'] = (($flight_result1['Recomm'][0]['totalFareAmount']['value'])+($flight_result1['Recomm'][1]['totalFareAmount']['value']));
							$testing['oneway'][$i]['TaxAmount'] = (($flight_result1['Recomm'][0]['totalTaxAmount']['value'])+($flight_result1['Recomm'][1]['totalTaxAmount']['value']));
						}
						else
						{
							$total = (($flight_result1['Recomm']['totalFareAmount']['value']));
							$testing['oneway'][$i]['pamount'] = $total;
							$testing['oneway'][$i]['FareAmount'] = $flight_result1['Recomm']['totalFareAmount']['value'];
							$testing['oneway'][$i]['TaxAmount'] = $flight_result1['Recomm']['totalTaxAmount']['value'];
						}
                        $testing['oneway'][$i]['ccode'] = $data['currency'];
                        $testing['oneway'][$i]['id'] = $i;
                    	$testing['oneway'][$i]['stops'] = "0";
                        $testing['oneway'][$i]['flag'] = "false";
                        $testing['oneway'][$i]['MultiTicket']=$flight_result1['MultiTicket'];
                        $testing['oneway'][$i]['rand_id'] = $rand_id;
			$adminmarkupvalue =0;// $adminmarkup->markup;
                        $pgvalue =0;// $pg->charge;
			$testing['oneway'][$i]['admin_markup'] = $adminmarkupvalue;
                        $testing['oneway'][$i]['payment_charge'] = $pgvalue;
			$API_FareAmount = $total;
                        $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                        $markup1 = $API_FareAmount + $admin_markup;
                        $pg_charge = ($markup1 * $pgvalue) / 100;
                        $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                        $total_markup = $admin_markup + $pg_charge;
                        $testing['oneway'][$i]['Total_FareAmount'] = $Total_FareAmount;


                        if($flight_result1['MultiTicket']=="Yes")
                        {
							$count_rbd = count($flight_result1['Recomm'][0]['paxFareProduct']);
							if (isset($flight_result1['Recomm'][0]['paxFareProduct'][0])) 
							{
								if(isset($flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]))
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['rbd']['value'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['cabin']['value'];
								}
								else
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd']['value'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['cabin']['value'];

								}
							} 
							else 
							{
								if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]))
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd']['value'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['cabin']['value'];
								}
								else
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd']['value'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin']['value'];
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
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd']['value'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['cabin']['value'];
								}
								else
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['rbd']['value'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['cabin']['value'];

								}
							} 
							else 
							{
								if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]))
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd']['value'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['cabin']['value'];
								}
								else
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd']['value'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin']['value'];
								}
							}
						}
						
						
					 // Time Zone Related Code
					 
						$dep_code=$testing['oneway'][$i]['dlocation'];
						$arv_code=$testing['oneway'][$i]['alocation'];
						
						$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
						
						$testing['oneway'][$i]['dep_time_zone_offset'] = $country_time_zone_offset;
						
						$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
						$testing['oneway'][$i]['arv_time_zone_offset'] = $country_time_zone_offset;
						
						$ddate = ''; $adate = '';
						$ddate = $testing['oneway'][$i]['ddate1'];
						$adate = $testing['oneway'][$i]['adate1'];
						
						
						$dep_zone = explode(":",($testing['oneway'][$i]['dep_time_zone_offset']));
						$arv_zone = explode(":",($testing['oneway'][$i]['arv_time_zone_offset']));
						$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
						
						if(!is_int($Change_clock))
						{
							$Changeclock=explode(".", $Change_clock);
							$Changeclock1=$Changeclock[1];
							$Changeclock1=($Changeclock1*6);
							$Changeclock0=$Changeclock[0];
						}
						else
						{
							$Changeclock0=$Change_clock;
							$Changeclock1= 0;
						}

						$date_a = new DateTime($ddate);
						$date_b = new DateTime($adate);
						$interval = date_diff($date_a, $date_b);
						$hour = $interval->format('%h');
						$min = $interval->format('%i');
						$min=$min+$Changeclock1;
						$hour=$hour-$Changeclock0;
						
						if($min>=60)
						{
							$H = FLOOR($min / 60);
							$M = $min%60;
							$hour+=$H;
							$min=$M;
						}
						if($hour<0)
						{
							$hour=((24)+($hour));
						}
						if($min<0)
						{
							$min=((60)+($min));
						}
						//echo $hour." ".$min."<br/> ";
						
						$dur_in_min = (($hour * 60) + $min);
						$day = floor($dur_in_min / 1440);
						$hours = floor($dur_in_min / 60);
						$minutes = ($dur_in_min % 60);
						if($hours>24)
						{
							$hours=($hours % 24);
						}
						//$hours=($hours) -($Change_clock);
						if($_SESSION['lang']=='en')
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
							else
								$duration_time_zone=$hours." h ".$minutes." min";
						}
						else
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
							else
								$duration_time_zone=$hours." t ".$minutes." min";
						}
						$testing['oneway'][$i]['duration_time_zone'] = $duration_time_zone;
						$testing['oneway'][$i]['Clock_Changes']=$Change_clock;
						$testing['oneway'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
                        $i++;
                    }
                } else {
                    $testing['oneway'][$i]['dur_in_min'] = "";
                    $h = 0;
                    $m = 0;
                    $total = 0;
                    for ($j = 0; $j < ($count_code); $j++) {
                        $name = $this->Flight_Model->get_flight_name($flight_result1['oneWay']['marketingCarrier'][$j]);
                        if ($name != '') {
                            $testing['oneway'][$i]['cicode'][$j] = $flight_result1['oneWay']['marketingCarrier'][$j]['value'];
                            $testing['oneway'][$i]['eft'] = $flight_result1['oneWay']['eft']['value'];
							
                            $testing['oneway'][$i]['name'][$j] = $name;
                            $testing['oneway'][$i]['fnumber'][$j] = $flight_result1['oneWay']['flightOrtrainNumber'][$j]['value'];
                            $testing['oneway'][$i]['equipmentType'] = $flight_result1['oneWay'] ['equipmentType'][$j]['value'];
                            $testing['oneway'][$i]['dlocation'][$j] = $flight_result1['oneWay']['locationIdDeparture'][$j]['value'];
                            $departureDate = $flight_result1['oneWay']['dateOfDeparture'][$j]['value'];
                            $departureTime = $flight_result1['oneWay']['timeOfDeparture'][$j]['value'];
                            $testing['oneway'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
						
                            $testing['oneway'][$i]['alocation'][$j] = $flight_result1['oneWay']['locationIdArival'][$j]['value'];
                            $arrivalDate = $flight_result1['oneWay']['dateOfArrival'][$j]['value'];
                            $arrivalTime = $flight_result1['oneWay']['timeOfArrival'][$j]['value'];
                            $testing['oneway'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";


                            $testing['oneway'][$i]['dateOfDeparture'][$j]=$departureDate = $flight_result1['oneWay']['dateOfDeparture'][$j]['value'];
                            $departureTime = $flight_result1['oneWay']['timeOfDeparture'][$j]['value'];
                            $testing['oneway'][$i]['dateOfArrival'][$j]=$arrivalDate = $flight_result1['oneWay']['dateOfArrival'][$j]['value'];
                            $arrivalTime = $flight_result1['oneWay']['timeOfArrival'][$j]['value'];

                            $testing['oneway'][$i]['timeOfDeparture'][$j] = $flight_result1['oneWay']['timeOfDeparture'][$j]['value'];
                            $testing['oneway'][$i]['timeOfArrival'][$j] = $flight_result1['oneWay']['timeOfArrival'][$j]['value'];

                            if (($flight_result1['oneWay']['timeOfDeparture'][0]['value'] <= "0700") && ($arrivalTime >= "2000"))
                                $testing['oneWay'][$i]['redeye'] = "Yes";
                            else
                                $testing['oneway'][$i]['redeye'] = "No";

                            $testing['oneway'][$i]['dtime_filter'] = $flight_result1['oneWay']['timeOfDeparture'][0]['value'];
                            $testing['oneway'][$i]['atime_filter'] = $arrivalTime;


                            $testing['oneway'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                            $testing['oneway'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

							$testing['oneway'][$i]['dep_date'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                            $testing['oneway'][$i]['arv_date'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));


                            //Final Duration Part
                            $testing['oneway'][$i]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                            $testing['oneway'][$i]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                            $date_a = new DateTime($testing['oneway'][$i]['ddate1'][$j]);
                            $date_b = new DateTime($testing['oneway'][$i]['adate1'][$j]);
                            $interval = date_diff($date_a, $date_b);
                            $testing['oneway'][$i]['duration_final'][$j] = $interval->format('%h hours %i minutes');
                            $testing['oneway'][$i]['duration_final1'][$j] = $interval->format('%h h %i m');
                            $eft_final = str_split($flight_result1['oneWay']['eft']['value'],2);
                           
								$testing['oneway'][$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
                            
                            $hour = $interval->format('%h');
                            $min = $interval->format('%i');
                            $dur_in_min = (($hour * 60) + $min);
                            $testing['oneway'][$i]['dur_in_min']+= $dur_in_min;

                            if ($j != ($count_code - 1)) 
                            {
                                $arrivalDate_layover = $flight_result1['oneWay']['dateOfArrival'][$j]['value'];
                                $arrivalTime_layover = $flight_result1['oneWay']['timeOfArrival'][$j]['value'];
                                $departureDate_layover = $flight_result1['oneWay']['dateOfDeparture'][($j + 1)]['value'];
                                $departureTime_layover = $flight_result1['oneWay']['timeOfDeparture'][($j + 1)]['value'];

                                $depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
                                $arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
                                $date_c = new DateTime($depart_layover);
                                $date_d = new DateTime($arival_layover);
                                $interval_layover = date_diff($date_c, $date_d);
                                $testing['oneway'][$i]['duration_final_layover'][$j] = $interval_layover->format('%h hours %i minutes');

                                $hour_layover = $interval_layover->format('%h');
                                $min_layover = $interval_layover->format('%i');
                                $dur_in_min_layover = (($hour_layover * 60) + $min_layover);
                                $testing['oneway'][$i]['dur_in_min_layover'][$j] = $dur_in_min_layover;
                            } 
                            else 
                            {
                                $testing['oneway'][$i]['duration_final_layover'][$j] = '';
                                $testing['oneway'][$i]['dur_in_min_layover'][$j] = '';
                            }


                            if ($flight_result1['oneWay']['marketingCarrier'][0]['value'] != $flight_result1['oneWay']['marketingCarrier'][$j]['value'])
                                $flag_marketingCarrier = true;
                            else
                                $flag_marketingCarrier = false;

                            $testing['oneway'][$i]['flag_marketingCarrier'] = $flag_marketingCarrier;
			if(isset($flight_result1['Recomm'][0]))
                            {
								$total = (($flight_result1['Recomm'][0]['totalFareAmount']['value'])+($flight_result1['Recomm'][1]['totalFareAmount']['value']));
								$testing['oneway'][$i]['pamount'] = $total;
								$testing['oneway'][$i]['FareAmount'] = (($flight_result1['Recomm'][0]['totalFareAmount']['value'])+($flight_result1['Recomm'][1]['totalFareAmount']['value']));
								$testing['oneway'][$i]['TaxAmount'] = (($flight_result1['Recomm'][0]['totalTaxAmount']['value'])+($flight_result1['Recomm'][1]['totalTaxAmount']['value']));
							}
							else
							{
								$total = ($flight_result1['Recomm']['totalFareAmount']['value']);
								$testing['oneway'][$i]['pamount'] = $total;
								$testing['oneway'][$i]['FareAmount'] = $flight_result1['Recomm']['totalFareAmount']['value'];
								$testing['oneway'][$i]['TaxAmount'] = $flight_result1['Recomm']['totalTaxAmount']['value'];
								
							}
								
                            
                            $testing['oneway'][$i]['ccode'] = $data['currency']['value'];
                            $testing['oneway'][$i]['id'] = $i;

                            //$testing['oneway'][$i]['designator']=$flight_result1['Recomm']['paxFareProduct']['designator'];
                            $testing['oneway'][$i]['stops'] = ($count_code - 1);
                            $testing['oneway'][$i]['flag'] = "true";
                            $testing['oneway'][$i]['MultiTicket']=$flight_result1['MultiTicket'];
                            $testing['oneway'][$i]['rand_id'] = $rand_id;
			    $adminmarkupvalue = 0;//$adminmarkup->markup;
                            $pgvalue =0;// $pg->charge;

                            $testing['oneway'][$i]['admin_markup'] = $adminmarkupvalue;
                            $testing['oneway'][$i]['payment_charge'] = $pgvalue;

                            $API_FareAmount = $total;
                            $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                            $markup1 = $API_FareAmount + $admin_markup;
                            $pg_charge = ($markup1 * $pgvalue) / 100;
                            $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                            $total_markup = $admin_markup + $pg_charge;
                            $testing['oneway'][$i]['Total_FareAmount'] = $Total_FareAmount;

                           if($flight_result1['MultiTicket']!="Yes")
                           {
								$count_rbd = count($flight_result1['Recomm']['paxFareProduct']);
								if (isset($flight_result1['Recomm']['paxFareProduct'][0])) 
								{
									if(isset($flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]))
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'][$j]['value'];
										$testing['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['cabin'][$j]['value'];
									}
									else
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'][$j]['value'];
										$testing['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'][$j]['value'];								
									}
								} 
								else 
								{
									if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]))
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'][$j]['value'];
										$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['cabin'][$j]['value'];
									}
									else
									{
										if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j]))
											$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j]['value'];
										else
											$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd']['value'];
										if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j]))
											$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j]['value'];
										else
											$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin']['value'];
									}
								}
							}
							else
							{//echo 'hghghj'. $testing['oneway'][$i]['ccode'];exit;
								$count_rbd = count($flight_result1['Recomm'][0]['paxFareProduct']);
								if (isset($flight_result1['Recomm'][0]['paxFareProduct'][0])) 
								{
									if(isset($flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]))
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['rbd'][$j]['value'];
										$testing['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['cabin'][$j]['value'];
									}
									else
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'][$j]['value'];
										$testing['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['cabin'][$j]['value'];								
									}
								} 
								else 
								{
									if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]))
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'][$j]['value'];
										$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['cabin'][$j]['value'];
									}
									else
									{
										if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][$j]))
											$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][$j]['value'];
										else
											$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd']['value'];
										if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'][$j]))
											$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'][$j]['value'];
										else
											$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin']['value'];
									}
								}
							}
							
							 // Time Zone Related Code
                            $dep_code=$testing['oneway'][$i]['dlocation'][$j];
                            $arv_code=$testing['oneway'][$i]['alocation'][$j];
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
							$testing['oneway'][$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
							$testing['oneway'][$i]['arv_time_zone_offset'][$j] = $country_time_zone_offset;
							
                            $ddate = ''; $adate = '';
							$ddate = $testing['oneway'][$i]['ddate1'][$j];
							$adate = $testing['oneway'][$i]['adate1'][$j];
							
							
							$dep_zone = explode(":",($testing['oneway'][$i]['dep_time_zone_offset'][$j]));
							$arv_zone = explode(":",($testing['oneway'][$i]['arv_time_zone_offset'][$j]));
							$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
							
							if(!is_int($Change_clock))
							{
								$Changeclock=explode(".", $Change_clock);
								$Changeclock1=$Changeclock[1];
								$Changeclock1=($Changeclock1*6);
								$Changeclock0=$Changeclock[0];
							}
							else
							{
								$Changeclock0=$Change_clock;
								$Changeclock1= 0;
							}

							$date_a = new DateTime($ddate);
							$date_b = new DateTime($adate);
							$interval = date_diff($date_a, $date_b);
							$hour = $interval->format('%h');
							$min = $interval->format('%i');
							$min=$min+$Changeclock1;
							$hour=$hour-$Changeclock0;
							
						    if($min>=60)
							{
								$H = FLOOR($min / 60);
								$M = $min%60;
								$hour+=$H;
								$min=$M;
							}
							if($hour<0)
							{
								$hour=((24)+($hour));
							}
							if($min<0)
							{
								$min=((60)+($min));
							}
							//echo $hour." ".$min."<br/> ";
							
							$dur_in_min = (($hour * 60) + $min);
							$day = floor($dur_in_min / 1440);
							$hours = floor($dur_in_min / 60);
							$minutes = ($dur_in_min % 60);
							if($hours>24)
							{
								$hours=($hours % 24);
							}
							//$hours=($hours) -($Change_clock);
							if($_SESSION['lang']=='en')
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
								else
									$duration_time_zone=$hours." h ".$minutes." min";
								//$hours=($hours) -($Change_clock);
							}
							else
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
								else
									$duration_time_zone=$hours." t ".$minutes." min";
							}
							$testing['oneway'][$i]['duration_time_zone'][$j] = $duration_time_zone;
							$testing['oneway'][$i]['Clock_Changes'][$j]=$Change_clock;
							$testing['oneway'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
                            
						}
                    }

                    $i++;
                }
            }
        }
		
		if ($flight_result != '') {
            $count_val = (count($flight_result));$i = 0;$total = 0;
            foreach ($flight_result as $flight_result2) {
                
                if(isset($flight_result2['oneWay'])){
                $count_code = count($flight_result2['Return']['marketingCarrier']);
				//echo 'fgdfgd'.$count_code;exit;
                if ($count_code <= 1) {
                    $name = $this->Flight_Model->get_flight_name($flight_result2['Return']['marketingCarrier']);
                    if ($name != '') {
                        $testing['Return'][$i]['cicode'] = $flight_result2['Return']['marketingCarrier']['value'];
                        $testing['Return'][$i]['eft'] = $flight_result2['Return']['eft']['value'];
                        $testing['Return'][$i]['name'] = $name;
                        $testing['Return'][$i]['fnumber'] = $flight_result2['Return']['flightOrtrainNumber']['value'];
                        $testing['Return'][$i]['equipmentType'] = $flight_result2['Return'] ['equipmentType']['value'];
                        $testing['Return'][$i]['dlocation'] = $flight_result2['Return']['locationIdDeparture']['value'];
                        $testing['Return'][$i]['dateOfDeparture']=$departureDate = $flight_result2['Return']['dateOfDeparture']['value'];
                        $departureTime = $flight_result2['Return']['timeOfDeparture']['value'];
                        $testing['Return'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

                        $testing['Return'][$i]['alocation'] = $flight_result2['Return']['locationIdArival']['value'];
                        $arrivalDate = $flight_result2['Return']['dateOfArrival']['value'];
                        $arrivalTime = $flight_result2['Return']['timeOfArrival']['value'];
                        $testing['Return'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

                        $departureDate = $flight_result2['Return']['dateOfDeparture']['value'];
                        $departureTime = $flight_result2['Return']['timeOfDeparture']['value'];
                        $testing['Return'][$i]['dateOfArrival']=$arrivalDate = $flight_result2['Return']['dateOfArrival']['value'];
                        $arrivalTime = $flight_result2['Return']['timeOfArrival']['value'];

                        $testing['Return'][$i]['timeOfDeparture'] = $flight_result2['Return']['timeOfDeparture']['value'];
                        $testing['Return'][$i]['timeOfArrival'] = $flight_result2['Return']['timeOfArrival']['value'];

                        if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
                            $testing['Return'][$i]['redeye'] = "Yes";
                        else
                            $testing['Return'][$i]['redeye'] = "No";

                        $testing['Return'][$i]['dtime_filter'] = $flight_result2['Return']['timeOfDeparture']['value'];
                        $testing['Return'][$i]['atime_filter'] = $arrivalTime;
                        $testing['Return'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                        $testing['Return'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

						$testing['Return'][$i]['dep_date'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                        $testing['Return'][$i]['arv_date'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));

                        //Final Duration Part
                        $testing['Return'][$i]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                        $testing['Return'][$i]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                        $date_a = new DateTime($testing['Return'][$i]['ddate1']);
                        $date_b = new DateTime($testing['Return'][$i]['adate1']);
                        $interval = date_diff($date_a, $date_b);
                        $testing['Return'][$i]['duration_final'] = $interval->format('%h hours %i minutes');
                        $testing['Return'][$i]['duration_final1'] = $interval->format('%h h %i m');

						$eft_final = str_split($flight_result2['Return']['eft']['value'],2);
						if($_SESSION['lang']=='en')
							$testing['Return'][$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
						else
							$testing['Return'][$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
						
                        $hour = $interval->format('%h');
                        $min = $interval->format('%i');
                        $dur_in_min = (($hour * 60) + $min);
                        $testing['Return'][$i]['dur_in_min'] = $dur_in_min;
                        if($flight_result2['MultiTicket']=="Yes")
                        {
							$total = (($flight_result2['Recomm'][0]['totalFareAmount']['value'])+($flight_result2['Recomm'][1]['totalFareAmount']['value']));
							$testing['Return'][$i]['pamount'] = $total;
							$testing['Return'][$i]['FareAmount'] = (($flight_result2['Recomm'][0]['totalFareAmount']['value'])+($flight_result2['Recomm'][1]['totalFareAmount']['value']));
							$testing['Return'][$i]['TaxAmount'] = (($flight_result2['Recomm'][0]['totalTaxAmount']['value'])+($flight_result2['Recomm'][1]['totalTaxAmount']['value']));
						}
						else
						{
							$total = (($flight_result2['Recomm']['totalFareAmount']['value']));
							$testing['Return'][$i]['pamount'] = $total;
							$testing['Return'][$i]['FareAmount'] = $flight_result2['Recomm']['totalFareAmount']['value'];
							$testing['Return'][$i]['TaxAmount'] = $flight_result2['Recomm']['totalTaxAmount']['value'];
						}
                        $testing['Return'][$i]['ccode'] = $data['currency']['value'];
                        $testing['Return'][$i]['id'] = $i;
                        //$testing['Return'][$i]['designator']=$flight_result2['Recomm']['paxFareProduct']['designator'];
                        $testing['Return'][$i]['stops'] = "0";
                        $testing['Return'][$i]['flag'] = "false";
                        $testing['Return'][$i]['MultiTicket']=$flight_result2['MultiTicket'];
                        $testing['Return'][$i]['rand_id'] = $rand_id;

                        //Markup Values
                       // $adminmarkup = $this->Flight_Model->get_adminmarkup();
                        $adminmarkupvalue =0;// $adminmarkup->markup;
                       // $pg = $this->Flight_Model->get_pgmarkup();
                        $pgvalue = 0;//$pg->charge;

                        $testing['Return'][$i]['admin_markup'] = $adminmarkupvalue;
                        $testing['Return'][$i]['payment_charge'] = $pgvalue;

                        $API_FareAmount = $total;
                        $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                        $markup1 = $API_FareAmount + $admin_markup;
                        $pg_charge = ($markup1 * $pgvalue) / 100;
                        $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                        $total_markup = $admin_markup + $pg_charge;
                        $testing['Return'][$i]['Total_FareAmount'] = $Total_FareAmount;

                        if($flight_result2['MultiTicket']=="Yes")
                        {
							$count_rbd = count($flight_result2['Recomm'][1]['paxFareProduct']);
							if (isset($flight_result2['Recomm'][1]['paxFareProduct'][0])) {
								if(isset($flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]))
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['rbd']['value'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['cabin']['value'];
								}
								else
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd']['value'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['cabin']['value'];
								}
							} else {
								if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]))
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd']['value'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['cabin']['value'];
								}
								else
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd']['value'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin']['value'];
								}
							}
						}
						else
						{
							$count_rbd = count($flight_result2['Recomm']['paxFareProduct']);
							if (isset($flight_result2['Recomm']['paxFareProduct'][0])) {
								if(isset($flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]))
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd']['value'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['cabin']['value'];
								}
								else
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['rbd']['value'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['cabin']['value'];
								}
							} else {
								if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]))
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['rbd']['value'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['cabin']['value'];
								}
								else
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd']['value'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin']['value'];
								}
							}
						}
						
						// Time Zone Related Code
						$dep_code=$testing['Return'][$i]['dlocation'];
						$arv_code=$testing['Return'][$i]['alocation'];
						
						$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
						$testing['Return'][$i]['dep_time_zone_offset'] = $country_time_zone_offset;
						
						$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
						$testing['Return'][$i]['arv_time_zone_offset'] = $country_time_zone_offset;
						
						$ddate = ''; $adate = '';
						$ddate = $testing['Return'][$i]['ddate1'];
						$adate = $testing['Return'][$i]['adate1'];
						
						
						$dep_zone = explode(":",($testing['Return'][$i]['dep_time_zone_offset']));
						$arv_zone = explode(":",($testing['Return'][$i]['arv_time_zone_offset']));
						$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
						
						if(!is_int($Change_clock))
						{
							$Changeclock=explode(".", $Change_clock);
							$Changeclock1=$Changeclock[1];
							$Changeclock1=($Changeclock1*6);
							$Changeclock0=$Changeclock[0];
						}
						else
						{
							$Changeclock0=$Change_clock;
							$Changeclock1= 0;
						}

						$date_a = new DateTime($ddate);
						$date_b = new DateTime($adate);
						$interval = date_diff($date_a, $date_b);
						$hour = $interval->format('%h');
						$min = $interval->format('%i');
						$min=$min+$Changeclock1;
						
						//~ if(($test['DepartureDate'][0])==($test['ArrivalDate'][$count_date]))
						//~ {
							//~ $hour=$hour-$Changeclock0;
						//~ }
						//~ else
						//~ {
							//~ $hour=$hour+$Changeclock0;
						//~ }
						
						$hour=$hour-$Changeclock0;
						
						if($min>=60)
						{
							$H = FLOOR($min / 60);
							$M = $min%60;
							$hour+=$H;
							$min=$M;
						}
						if($hour<0)
						{
							$hour=((24)+($hour));
						}
						if($min<0)
						{
							$min=((60)+($min));
						}
						//echo $hour." ".$min."<br/> ";
						
						$dur_in_min = (($hour * 60) + $min);
						$day = floor($dur_in_min / 1440);
						$hours = floor($dur_in_min / 60);
						$minutes = ($dur_in_min % 60);
						if($hours>24)
						{
							$hours=($hours % 24);
						}
						//$hours=($hours) -($Change_clock);
						if($_SESSION['lang']=='en')
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
							else
								$duration_time_zone=$hours." h ".$minutes." min";
						}
						else
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
							else
								$duration_time_zone=$hours." t ".$minutes." min";
						}
						$testing['Return'][$i]['duration_time_zone'] = $duration_time_zone;
						$testing['Return'][$i]['Clock_Changes']=$Change_clock;
						
						
						//~ if ($days > 0)
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
						//~ else
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
						

						$testing['Return'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
						// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
						

                        $i++;
                    }
                } else {
                    $testing['Return'][$i]['dur_in_min'] = "";$h = 0;$m = 0;$total = 0;
                    for ($j = 0; $j < ($count_code); $j++) {
                        $name = $this->Flight_Model->get_flight_name($flight_result2['Return']['marketingCarrier'][$j]);
                        if ($name != '') {
                            $testing['Return'][$i]['cicode'][$j] = $flight_result2['Return']['marketingCarrier'][$j]['value'];
                            $testing['Return'][$i]['eft'] = $flight_result2['Return']['eft']['value'];
                            $testing['Return'][$i]['name'][$j] = $name;
                            $testing['Return'][$i]['fnumber'][$j] = $flight_result2['Return']['flightOrtrainNumber'][$j]['value'];
                            $testing['Return'][$i]['equipmentType'] = $flight_result2['Return'] ['equipmentType']['value'];
                            $testing['Return'][$i]['dlocation'][$j] = $flight_result2['Return']['locationIdDeparture'][$j]['value'];
                            $departureDate = $flight_result2['Return']['dateOfDeparture'][$j]['value'];
                            $departureTime = $flight_result2['Return']['timeOfDeparture'][$j]['value'];
                            $testing['Return'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

                            $testing['Return'][$i]['alocation'][$j] = $flight_result2['Return']['locationIdArival'][$j]['value'];
                            $arrivalDate = $flight_result2['Return']['dateOfArrival'][$j]['value'];
                            $arrivalTime = $flight_result2['Return']['timeOfArrival'][$j]['value'];
                            $testing['Return'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

                            $testing['Return'][$i]['dateOfDeparture'][$j]=$departureDate = $flight_result2['Return']['dateOfDeparture'][$j]['value'];
                            $departureTime = $flight_result2['Return']['timeOfDeparture'][$j]['value'];
                            $testing['Return'][$i]['dateOfArrival'][$j]=$arrivalDate = $flight_result2['Return']['dateOfArrival'][$j]['value'];
                            $arrivalTime = $flight_result2['Return']['timeOfArrival'][$j]['value'];

                            $testing['Return'][$i]['timeOfDeparture'][$j] = $flight_result2['Return']['timeOfDeparture'][$j]['value'];
                            $testing['Return'][$i]['timeOfArrival'][$j] = $flight_result2['Return']['timeOfArrival'][$j]['value'];

                            $testing['Return'][$i]['dtime_filter'] = $flight_result2['Return']['timeOfDeparture'][0]['value'];
                            $testing['Return'][$i]['atime_filter'] = $arrivalTime;

                            if ((($flight_result2['Return']['timeOfDeparture'][0]['value']) <= "0700") && ($arrivalTime >= "2000"))
                                $testing['Return'][$i]['redeye'] = "Yes";
                            else
                                $testing['Return'][$i]['redeye'] = "No";

                            $testing['Return'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                            $testing['Return'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

							$testing['Return'][$i]['dep_date'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                            $testing['Return'][$i]['arv_date'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));


                            //Final Duration Part
                            $testing['Return'][$i]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                            $testing['Return'][$i]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                            $date_a = new DateTime($testing['Return'][$i]['ddate1'][$j]);
                            $date_b = new DateTime($testing['Return'][$i]['adate1'][$j]);
                            $interval = date_diff($date_a, $date_b);
                            $testing['Return'][$i]['duration_final'][$j] = $interval->format('%h hours %i minutes');
                            $testing['Return'][$i]['duration_final1'][$j] = $interval->format('%h h %i m');
                            $eft_final = str_split($flight_result2['Return']['eft']['value'],2);
							if($_SESSION['lang']=='en')
								$testing['Return'][$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
							else
								$testing['Return'][$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
							
							$hour = $interval->format('%h');
                            $min = $interval->format('%i');
                            $dur_in_min = (($hour * 60) + $min);
                            $testing['Return'][$i]['dur_in_min']+= $dur_in_min;

                            if ($j != ($count_code - 1)) {
                                $arrivalDate_layover = $flight_result2['Return']['dateOfArrival'][$j]['value'];
                                $arrivalTime_layover = $flight_result2['Return']['timeOfArrival'][$j]['value'];
                                $departureDate_layover = $flight_result2['Return']['dateOfDeparture'][($j + 1)]['value'];
                                $departureTime_layover = $flight_result2['Return']['timeOfDeparture'][($j + 1)]['value'];

                                $depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
                                $arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
                                $date_c = new DateTime($depart_layover);
                                $date_d = new DateTime($arival_layover);
                                $interval_layover = date_diff($date_c, $date_d);
                                $testing['Return'][$i]['duration_final_layover'][$j] = $interval_layover->format('%h hours %i minutes');

                                $hour_layover = $interval_layover->format('%h');
                                $min_layover = $interval_layover->format('%i');
                                $dur_in_min_layover = (($hour_layover * 60) + $min_layover);
                                $testing['Return'][$i]['dur_in_min_layover'][$j] = $dur_in_min_layover;
                            } else {
                                $testing['Return'][$i]['duration_final_layover'][$j] = '';
                                $testing['Return'][$i]['dur_in_min_layover'][$j] = '';
                            }


                            if ($flight_result2['Return']['marketingCarrier'][0]['value'] != $flight_result2['Return']['marketingCarrier'][$j]['value'])
                                $flag_marketingCarrier = true;
                            else
                                $flag_marketingCarrier = false;

                            $testing['Return'][$i]['flag_marketingCarrier'] = $flag_marketingCarrier;

                            //$total=(($flight_result2['Recomm']['totalFareAmount'])+($flight_result2['Recomm']['totalTaxAmount']));
                            if($flight_result2['MultiTicket']=="Yes")
							{
								$total = (($flight_result2['Recomm'][0]['totalFareAmount'])+($flight_result2['Recomm'][1]['totalFareAmount']['value']));
								$testing['Return'][$i]['pamount'] = $total;
								$testing['Return'][$i]['FareAmount'] = (($flight_result2['Recomm'][0]['totalFareAmount'])+($flight_result2['Recomm'][1]['totalFareAmount']['value']));
								$testing['Return'][$i]['TaxAmount'] = (($flight_result2['Recomm'][0]['totalTaxAmount'])+($flight_result2['Recomm'][1]['totalTaxAmount']['value']));
								$testing['Return'][$i]['Total_FareAmount1']=(($flight_result2['Recomm'][0]['totalFareAmount'])." + ".($flight_result2['Recomm'][1]['totalFareAmount']['value']));
							}
							else
							{
								$total = (($flight_result2['Recomm']['totalFareAmount']['value']));
								$testing['Return'][$i]['pamount'] = $total;
								$testing['Return'][$i]['FareAmount'] = $flight_result2['Recomm']['totalFareAmount']['value'];
								$testing['Return'][$i]['TaxAmount'] = $flight_result2['Recomm']['totalTaxAmount']['value'];
							}
                            $testing['Return'][$i]['ccode'] = $data['currency']['value'];
                            $testing['Return'][$i]['id'] = $i;

                            //$testing['Return'][$i]['designator']=$flight_result2['Recomm']['paxFareProduct']['designator'];
                            $testing['Return'][$i]['stops'] = ($count_code - 1);
                            $testing['Return'][$i]['flag'] = "true";
                            $testing['Return'][$i]['MultiTicket']=$flight_result2['MultiTicket'];
                            $testing['Return'][$i]['rand_id'] = $rand_id;

                            //Markup Values
                            //$adminmarkup = $this->Flight_Model->get_adminmarkup();
                            $adminmarkupvalue =0;// $adminmarkup->markup;
                            //$pg = $this->Flight_Model->get_pgmarkup();
                            $pgvalue =0;// $pg->charge;

                            $testing['Return'][$i]['admin_markup'] = $adminmarkupvalue;
                            $testing['Return'][$i]['payment_charge'] = $pgvalue;

                            $API_FareAmount = $total;
                            $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                            $markup1 = $API_FareAmount + $admin_markup;
                            $pg_charge = ($markup1 * $pgvalue) / 100;
                            $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                            $total_markup = $admin_markup + $pg_charge;
                            $testing['Return'][$i]['Total_FareAmount'] = $Total_FareAmount;


                            if($flight_result2['MultiTicket']=="Yes")
                            {
								if (isset($flight_result2['Recomm'][1]['paxFareProduct'][0])) {
									if(isset($flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]))
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['rbd'][$j]['value'];
										$testing['Return'][$i]['cabin'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['cabin'][$j]['value'];
									}
									else
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'][$j]['value'];
										$testing['Return'][$i]['cabin'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['cabin'][$j]['value'];
									}
								} 
								else 
								{
									if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]))
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'][$j]['value'];
										$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['cabin'][$j]['value'];
									}
									else
									{
										if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][$j]))
											$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][$j]['value'];
										else
											$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd']['value'];
										if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'][$j]))
											$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'][$j]['value'];
										else
											$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin']['value'];
									}
								}
							}
							else
							{
								if (isset($flight_result2['Recomm']['paxFareProduct'][0])) {
									if(isset($flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]))
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'][$j]['value'];
										$testing['Return'][$i]['cabin'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['cabin'][$j]['value'];
									}
									else
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'][$j]['value'];
										$testing['Return'][$i]['cabin'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'][$j]['value'];
									}
								} 
								else 
								{
									if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]))
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'][$j]['value'];
										$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['cabin'][$j]['value'];
									}
									else
									{
										if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j]))
											$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j]['value'];
										else
											$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd']['value'];
										if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j]))
											$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j]['value'];
										else
											$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin']['value'];
									}
								}
							}
							
							// Time Zone Related Code
                            $dep_code=$testing['Return'][$i]['dlocation'][$j];
                            $arv_code=$testing['Return'][$i]['alocation'][$j];
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
							$testing['Return'][$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
							$testing['Return'][$i]['arv_time_zone_offset'][$j] = $country_time_zone_offset;
							
                            $ddate = ''; $adate = '';
							$ddate = $testing['Return'][$i]['ddate1'][$j];
							$adate = $testing['Return'][$i]['adate1'][$j];
							
							
							$dep_zone = explode(":",($testing['Return'][$i]['dep_time_zone_offset'][$j]));
							$arv_zone = explode(":",($testing['Return'][$i]['arv_time_zone_offset'][$j]));
							$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
							
							if(!is_int($Change_clock))
							{
								$Changeclock=explode(".", $Change_clock);
								$Changeclock1=$Changeclock[1];
								$Changeclock1=($Changeclock1*6);
								$Changeclock0=$Changeclock[0];
							}
							else
							{
								$Changeclock0=$Change_clock;
								$Changeclock1= 0;
							}

							$date_a = new DateTime($ddate);
							$date_b = new DateTime($adate);
							$interval = date_diff($date_a, $date_b);
							$hour = $interval->format('%h');
							$min = $interval->format('%i');
							$min=$min+$Changeclock1;
							$hour=$hour-$Changeclock0;
							
						    if($min>=60)
							{
								$H = FLOOR($min / 60);
								$M = $min%60;
								$hour+=$H;
								$min=$M;
							}
							if($hour<0)
							{
								$hour=((24)+($hour));
							}
							if($min<0)
							{
								$min=((60)+($min));
							}
							//echo $hour." ".$min."<br/> ";
							
							$dur_in_min = (($hour * 60) + $min);
							$day = floor($dur_in_min / 1440);
							$hours = floor($dur_in_min / 60);
							$minutes = ($dur_in_min % 60);
							if($hours>24)
							{
								$hours=($hours % 24);
							}
							//$hours=($hours) -($Change_clock);
							if($_SESSION['lang']=='en')
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
								else
									$duration_time_zone=$hours." h ".$minutes." min";
							}
							else
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
								else
									$duration_time_zone=$hours." t ".$minutes." min";
							}
							$testing['Return'][$i]['duration_time_zone'][$j] = $duration_time_zone;
							$testing['Return'][$i]['Clock_Changes'][$j]=$Change_clock;
							
							$testing['Return'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
                        }
                    }
                    $i++;
                }
			}
            }
        }
    
        $data['flight_result'] = $testing;
        $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
        
        $min_amount = "";
        $min_duration = "";
        $max_amount = "";
        $max_duration = "";
        if (!empty($testing)) {
			
			
            $input = "Total_FareAmount";
            $flag = SORT_ASC;
            $usernames = array();
            foreach ($testing['oneway'] as $user) {
                $usernames[] = $user[$input];
            }
            array_multisort($usernames, $flag, $testing['oneway']);
            
            $usernames1 = array();
            foreach ($testing['Return'] as $user) {
                $usernames1[] = $user[$input];
            }
            array_multisort($usernames1, $flag, $testing['Return']);
            $minmxprice = $testing['oneway'];
            $usernames = array();
            foreach ($minmxprice as $user) {
                $usernames[] = $user['Total_FareAmount'];
            }
            array_multisort($usernames, SORT_ASC, $minmxprice);
            $count = (count($minmxprice));
            $min_amount = ($minmxprice[0]['Total_FareAmount']);
            $max_amount = ($minmxprice[($count - 1)]['Total_FareAmount']);

			$data['lowest_price_amount'] = $min_amount;
            $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
            $_SESSION['flight_result']=$data['flight_result'];
		
		 $calanderData=$this->load->view('search_result_ajax', $data, true);
		 echo $calanderData;
		
        } 
    }
function flight_result_calender(){
	//echo '<pre>ffgbbfgfgb';print_r($_SESSION['flight_result']);exit;
	$data['flight_result']=$_SESSION['flight_result'];
	$this->load->view('search_result_ajax_roundtrip_calendar', $data);
	}
        // Converting arry details for display and filter for OneWay
	public function fetch_flight_search_result($data,$rand_id){
		
        $flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
        $data2 = "";$data4 = "";$testing = "";
	$adminmarkupvalue =0;// $adminmarkup->markup;
	// Payment Gateway Based Markup Values
	$pgvalue =0;// $pg->charge;
	// Airline Based Markup Values
	$airlinemarkup = 0;//$this->Flight_Model->get_airlinemarkup();
	// Country Based Markup Values
	$countrymarkup =0;// $this->Flight_Model->get_countrymarkup();
		
        if ($flight_result != '') {
            $count_val = count($flight_result);
            $i = 0;
            $total = 0;
            foreach ($flight_result as $flight_result) {
                $count_code = count($flight_result['marketingCarrier']);
                if ($count_code <= 1) {
                    $name = $this->Flight_Model->get_flight_name($flight_result['marketingCarrier']);
                    if ($name != '') {

                        $testing[$i]['cicode'] = $flight_result['marketingCarrier']['value'];
                        $testing[$i]['name'] = $name;
                        $testing[$i]['fnumber'] = $flight_result['flightOrtrainNumber']['value'];
                        $testing[$i]['dlocation'] = $flight_result['locationIdDeparture']['value'];
                        $testing[$i]['alocation'] = $flight_result['locationIdArival']['value'];
                        $testing[$i]['timeOfDeparture'] = $flight_result['timeOfDeparture']['value'];
                        $testing[$i]['timeOfArrival'] = $flight_result['timeOfArrival']['value'];
                        $testing[$i]['dateOfDeparture'] = $flight_result['dateOfDeparture']['value'];
                        $testing[$i]['dateOfArrival'] = $flight_result['dateOfArrival']['value'];
                        $testing[$i]['equipmentType'] = $flight_result['equipmentType']['value'];

                        $departureDate = $flight_result['dateOfDeparture']['value'];
                        $departureTime = $flight_result['timeOfDeparture']['value'];
                        $arrivalDate = $flight_result['dateOfArrival']['value'];
                        $arrivalTime = $flight_result['timeOfArrival']['value'];
						
                        if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
                            $testing[$i]['redeye'] = "Yes";
                        else
                            $testing[$i]['redeye'] = "No";

                        $testing[$i]['dtime_filter'] = $departureTime;
                        $testing[$i]['atime_filter'] = $arrivalTime;

                        $testing[$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                        $testing[$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";
						
						$testing[$i]['dep_date'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                        $testing[$i]['arv_date'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));

                        //Final Duration Part
                        $testing[$i]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                        $testing[$i]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                        $date_a = new DateTime($testing[$i]['ddate1']);
                        $date_b = new DateTime($testing[$i]['adate1']);
                        $interval = date_diff($date_a, $date_b);
                        $testing[$i]['duration_final'] = $interval->format('%h Hours %i Minutes');
                        if($_SESSION['lang']=='en')
							$testing[$i]['duration_final1'] = $interval->format('%h h %i min');
						else
							$testing[$i]['duration_final1'] = $interval->format('%h t %i min');
						$eft_final = str_split($flight_result['eft'],2);
						if($_SESSION['lang']=='en')
							$testing[$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
						else
							$testing[$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
						
                        $hour = $interval->format('%h');
                        $min = $interval->format('%i');
                        $dur_in_min = (($hour * 60) + $min);
                        $testing[$i]['dur_in_min'] = $dur_in_min;

                        //$total=(($flight_result['totalFareAmount'])+($flight_result['totalTaxAmount']));
                        $total = (($flight_result['totalFareAmount']));
                        $testing[$i]['FareAmount'] = $flight_result['totalFareAmount'];
                        $testing[$i]['TaxAmount'] = $flight_result['totalTaxAmount'];
                        $testing[$i]['pamount'] = $total;
                        $testing[$i]['ccode'] = $data['currency'];
                        $testing[$i]['id'] = $i;
                        if (!isset($fligh_result['designator']))
                            $testing[$i]['designator'] = "";
                        else
                            $testing[$i]['designator'] = $flight_result['designator'];
                        $testing[$i]['stops'] = "0";
                        $testing[$i]['flag'] = "false";
                        $testing[$i]['rand_id'] = $rand_id;

                        $testing[$i]['admin_markup'] = $adminmarkupvalue;
                        $testing[$i]['payment_charge'] = $pgvalue;

                        // Markup Related Code
                        
                        $API_FareAmount = $total;
                        $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                        $markup1 = $API_FareAmount + $admin_markup;
                        $pg_charge = ($markup1 * $pgvalue) / 100;
                        
                        $airline_markup=0;$country_markup=0;
                        if($airlinemarkup!='')
                        {
							for($m = 0;$m < count($airlinemarkup);$m++)
							{
								if((strcmp($testing[$i]['name'], $airlinemarkup[$m]->airline))==0)
									$airline_markup += ($API_FareAmount * ($airlinemarkup[$m]->markup)) / 100;
							}
						}
						
                        
                        if($countrymarkup!='')
                        {
							for($m = 0;$m < count($countrymarkup);$m++)
							{
								$country_name = $this->Flight_Model->get_country_name($flight_result['locationIdDeparture']);						
								if((strcmp($country_name[0]->country, $countrymarkup[$m]->country))==0)
									$country_markup += ($API_FareAmount * ($countrymarkup[$m]->markup)) / 100;
							}
						}
                        $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge + $country_markup + $airline_markup;
                        $total_markup = $admin_markup + $pg_charge;
                        $testing[$i]['Total_FareAmount'] = ($Total_FareAmount);
                        $testing[$i]['airline_markup'] = ($airline_markup);
                        $testing[$i]['country_markup'] = ($country_markup);
                        
                        if (isset($flight_result['paxFareProduct'][0]['rbd'])) {
                            $testing[$i]['BookingClass'] = $flight_result['paxFareProduct'][0]['rbd'];
                            $testing[$i]['cabin'] = $flight_result['paxFareProduct'][0]['cabin'];
                        } else {
                            $testing[$i]['BookingClass'] = $flight_result['paxFareProduct']['rbd'];
                            $testing[$i]['cabin'] = $flight_result['paxFareProduct']['cabin'];
                        }
                        
                        
                         // Time Zone Related Code
						$country_time_zone_offset_dep = $this->Flight_Model->get_time_zone_details($testing[$i]['dlocation']); 
						$testing[$i]['dep_time_zone_offset'] = $country_time_zone_offset_dep;
						
						$country_time_zone_offset_arv = $this->Flight_Model->get_time_zone_details($testing[$i]['alocation']); 
						$testing[$i]['arv_time_zone_offset'] = $country_time_zone_offset_arv;
						
						$ddate = ''; $adate = '';
						$ddate = $testing[$i]['ddate1'];
						$adate = $testing[$i]['adate1'];
						
						
						$dep_zone = explode(":",($testing[$i]['dep_time_zone_offset']));
						$arv_zone = explode(":",($testing[$i]['arv_time_zone_offset']));
						$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
						
						if(!is_int($Change_clock))
						{
							$Changeclock=explode(".", $Change_clock);
							$Changeclock1=$Changeclock[1];
							$Changeclock1=($Changeclock1*6);
							$Changeclock0=$Changeclock[0];
						}
						else
						{
							$Changeclock0=$Change_clock;
							$Changeclock1= 0;
						}

						$date_a = new DateTime($ddate);
						$date_b = new DateTime($adate);
						$interval = date_diff($date_a, $date_b);
						$hour = $interval->format('%h');
						$min = $interval->format('%i');
						$min=$min+$Changeclock1;
						
						$hour=$hour-$Changeclock0;
						
						if($min>=60)
						{
							$H = FLOOR($min / 60);
							$M = $min%60;
							$hour+=$H;
							$min=$M;
						}
						if($hour<0)
						{
							$hour=((24)+($hour));
						}
						if($min<0)
						{
							$min=((60)+($min));
						}
						
						
						$dur_in_min = (($hour * 60) + $min);
						$day = floor($dur_in_min / 1440);
						$hours = floor($dur_in_min / 60);
						$minutes = ($dur_in_min % 60);
						if($hours>24)
						{
							$hours=($hours % 24);
						}
						if($_SESSION['lang']=='en')
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." h ".$minutes." M";
							else
								$duration_time_zone=$hours." h ".$minutes." min";
						}
						else
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
							else
								$duration_time_zone=$hours." t ".$minutes." min";
						}
						
						
						$testing[$i]['duration_time_zone'] = $duration_time_zone;
						$testing[$i]['Clock_Changes']=$Change_clock;
						$testing[$i]['dur_in_min_time_zone'] = $dur_in_min;
						

                        $i++;
                    }
                } else {
                    $testing[$i]['dur_in_min'] = "";$testing[$i]['dur_in_min_layover'] = "";$testing[$i]['pamount'] = "";
                    $flag_marketingCarrier_set_true = false;$flag_marketingCarrier_set_false = true;
                    $h = 0;$m = 0;$total = 0;$airline_markup=0;$country_markup=0;
                    for ($j = 0; $j < ($count_code); $j++) {
                        $name = $this->Flight_Model->get_flight_name($flight_result['marketingCarrier'][$j]);
                        if ($name != '') {
                            $testing[$i]['cicode'][$j] = $flight_result['marketingCarrier'][$j]['value'];
                            $testing[$i]['name'][$j] = $name;
                            $testing[$i]['fnumber'][$j] = $flight_result['flightOrtrainNumber'][$j]['value'];
                            $testing[$i]['dlocation'][$j] = $flight_result['locationIdDeparture'][$j]['value'];
                            $testing[$i]['alocation'][$j] = $flight_result['locationIdArival'][$j]['value'];
                            $testing[$i]['timeOfDeparture'][$j] = $flight_result['timeOfDeparture'][$j]['value'];
                            $testing[$i]['timeOfArrival'][$j] = $flight_result['timeOfArrival'][$j]['value'];
                            $testing[$i]['dateOfDeparture'][$j] = $flight_result['dateOfDeparture'][$j]['value'];
                            $testing[$i]['dateOfArrival'][$j] = $flight_result['dateOfArrival'][$j]['value'];

                            $departureDate = $flight_result['dateOfDeparture'][$j]['value'];
                            $departureTime = $flight_result['timeOfDeparture'][$j]['value'];
                            $arrivalDate = $flight_result['dateOfArrival'][$j]['value'];
                            $arrivalTime = $flight_result['timeOfArrival'][$j]['value'];
                            $testing[$i]['equipmentType'] = $flight_result['equipmentType'][$j]['value'];

                            $testing[$i]['dtime_filter'] = $flight_result['timeOfDeparture'][0]['value'];
                            $testing[$i]['atime_filter'] = $arrivalTime;
							
                            if ((($flight_result['timeOfDeparture'][0]['value']) <= "0700") && ($arrivalTime >= "2000"))
                                $testing[$i]['redeye'] = "Yes";
                            else
                                $testing[$i]['redeye'] = "No";

                            $testing[$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                            $testing[$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

                            $testing[$i]['dep_date'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                            $testing[$i]['arv_date'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));

                            //Final Duration Part
							
                            $testing[$i]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                            $testing[$i]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
							
                            $date_a = new DateTime($testing[$i]['ddate1'][$j]);
                            $date_b = new DateTime($testing[$i]['adate1'][$j]);
                            $interval = date_diff($date_a, $date_b);
			    $testing[$i]['duration_final'][$j] = $interval->format('%h Hours %i Minutes');
                            $testing[$i]['duration_final1'][$j] = $interval->format('%h t %i min');
                            $eft_final = str_split($flight_result['eft']['value'],2);
			    $testing[$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
			    $hour = $interval->format('%h');
                            $min = $interval->format('%i');
                            $dur_in_min = (($hour * 60) + $min);
                            $testing[$i]['dur_in_min']+= $dur_in_min;

                            if ($j != ($count_code - 1)) {
                                $arrivalDate_layover = $flight_result['dateOfArrival'][0]['value'];
                                $arrivalTime_layover = $flight_result['timeOfArrival'][0]['value'];
                                $departureDate_layover = $flight_result['dateOfDeparture'][($j + 1)]['value'];
                                $departureTime_layover = $flight_result['timeOfDeparture'][($j + 1)]['value'];

                                $depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
                                $arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
                                $date_c = new DateTime($depart_layover);
                                $date_d = new DateTime($arival_layover);
                                $interval_layover = date_diff($date_c, $date_d);
                                $testing[$i]['duration_final_layover'][$j] = $interval_layover->format('%h t %i min');
				$hour_layover = $interval_layover->format('%h');
                                $min_layover = $interval_layover->format('%i');
                                $dur_in_min_layover = (($hour_layover * 60) + $min_layover);
                                $testing[$i]['dur_in_min_layover'][$j] = $dur_in_min_layover;
                            } else {
                                $testing[$i]['duration_final_layover'][$j] = ' ';
                                $testing[$i]['dur_in_min_layover'][$j] = ' ';
                            }

                            if ($flight_result['marketingCarrier'][0]['value'] != $flight_result['marketingCarrier'][$j]['value'])
                                $flag_marketingCarrier_set_true = true;
                            else
                                $flag_marketingCarrier_set_flag = false;

                            if ($flag_marketingCarrier_set_true == true)
                                $testing[$i]['flag_marketingCarrier'] = true;
                            else
                                $testing[$i]['flag_marketingCarrier'] = false;
							$total = (($flight_result['totalFareAmount']['value']));
			    $testing[$i]['FareAmount'] = $flight_result['totalFareAmount']['value'];
                            $testing[$i]['TaxAmount'] = $flight_result['totalTaxAmount']['value'];
                            $testing[$i]['pamount'] = $total;
                            $testing[$i]['ccode'] = $data['currency'];
                            $testing[$i]['id'] = $i;
			    if (!isset($fligh_result['designator']))
                                $testing[$i]['designator'] = "";
                            else
                                $testing[$i]['designator'] = $flight_result['designator']['value'];
                            $testing[$i]['stops'] = ($count_code - 1);
                            $testing[$i]['flag'] = "true";
                            $testing[$i]['rand_id'] = $rand_id;

                            $API_FareAmount = $total;
                            $admin_markup = $API_FareAmount / 100;
                            $markup1 = $API_FareAmount + $admin_markup;
                            $pg_charge = $markup1 / 100;
                            if($airlinemarkup!='')
							{
								for($m = 0;$m < count($airlinemarkup);$m++)
								{
									if($j==0)
									{
										if((strcmp($testing[$i]['name'][$j], $airlinemarkup[$m]->airline))==0)
												$airline_markup += ($API_FareAmount * ($airlinemarkup[$m]->markup)) / 100;
									}
									else
									{
										$val = (strcmp($testing[$i]['name'][$j], $testing[$i]['name'][$j-1]));
										if($val!=0)
										{
											if((strcmp($testing[$i]['name'][$j], $airlinemarkup[$m]->airline))==0)
												$airline_markup += ($API_FareAmount * ($airlinemarkup[$m]->markup)) / 100;
										}
									}
								}
							}
							
							if($countrymarkup!='' && $j==0)
							{
								for($m = 0;$m < count($countrymarkup);$m++)
								{
									$country_name = $this->Flight_Model->get_country_name($flight_result['locationIdDeparture'][$j]);						
									if((strcmp($country_name[0]->country, $countrymarkup[$m]->country))==0)
										$country_markup += ($API_FareAmount * ($countrymarkup[$m]->markup)) / 100;
								}
							}
                            
                            $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge + $country_markup + $airline_markup;
                            $total_markup = $admin_markup + $pg_charge;
                            $testing[$i]['Total_FareAmount'] = ($Total_FareAmount);
                            $testing[$i]['airline_markup'] = ($airline_markup);
                            $testing[$i]['country_markup'] = ($country_markup);
                            if (isset($flight_result['paxFareProduct'][0]['rbd'][$j])) {
                                $testing[$i]['BookingClass'][$j] = $flight_result['paxFareProduct'][0]['rbd'][$j];
                                $testing[$i]['cabin'][$j] = $flight_result['paxFareProduct'][0]['cabin'][$j];
                            } else {
                                $testing[$i]['BookingClass'][$j] = $flight_result['paxFareProduct']['rbd'][$j];
                                $testing[$i]['cabin'][$j] = $flight_result['paxFareProduct']['cabin'][$j];
                            }
                            
                            
                            
                            
                             // Time Zone Related Code
                            $dep_code=$testing[$i]['dlocation'][$j];
                            $arv_code=$testing[$i]['alocation'][$j];
							//echo '<prre>';print_r( $dep_code);exit;
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
							$testing[$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
							$testing[$i]['arv_time_zone_offset'][$j] = $country_time_zone_offset;
							
                            $ddate = ''; $adate = '';
							$ddate = $testing[$i]['ddate1'][$j];
							$adate = $testing[$i]['adate1'][$j];
							
							
							$dep_zone = explode(":",($testing[$i]['dep_time_zone_offset'][$j]));
							$arv_zone = explode(":",($testing[$i]['arv_time_zone_offset'][$j]));
							$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
							
							if(!is_int($Change_clock))
							{
								$Changeclock=explode(".", $Change_clock);
								$Changeclock1=$Changeclock[1];
								$Changeclock1=($Changeclock1*6);
								$Changeclock0=$Changeclock[0];
							}
							else
							{
								$Changeclock0=$Change_clock;
								$Changeclock1= 0;
							}

							$date_a = new DateTime($ddate);
							$date_b = new DateTime($adate);
							$interval = date_diff($date_a, $date_b);
							$hour = $interval->format('%h');
							$min = $interval->format('%i');
							$min=$min+$Changeclock1;
							$hour=$hour-$Changeclock0;
							
						    if($min>=60)
							{
								$H = FLOOR($min / 60);
								$M = $min%60;
								$hour+=$H;
								$min=$M;
							}
							if($hour<0)
							{
								$hour=((24)+($hour));
							}
							if($min<0)
							{
								$min=((60)+($min));
							}
							//echo $hour." ".$min."<br/> ";
							
							$dur_in_min = (($hour * 60) + $min);
							$day = floor($dur_in_min / 1440);
							$hours = floor($dur_in_min / 60);
							$minutes = ($dur_in_min % 60);
							if($hours>24)
							{
								$hours=($hours % 24);
							}
							if ($day > 0)
									$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
								else
									$duration_time_zone=$hours." t ".$minutes." min";
							
							$testing[$i]['duration_time_zone'][$j] = $duration_time_zone;
							$testing[$i]['Clock_Changes'][$j]=$Change_clock;
							$testing[$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
							// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                            
                        }
                    } 
                    $i++;
                }
            }
        }
        
       
	$min_amount = "";$min_duration = "";$max_amount = "";$max_duration = "";
        $data['flight_result'] = $testing;
	$_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
	$_SESSION['flight_result_final']= $_SESSION[$rand_id]['testing'];
	$this->load->view('search_result_ajax_oneway', $data);
		
        
    }
	function flight_result(){
		
		
		$data['flight_result_final']=$_SESSION['flight_result_final'];
		//echo '<pre/>dfsdsdfssdfdfsd';print_r($data['flight_result_final']);
		$this->load->view('flight/search_result', $data);		
		}
    public function fetch_flight_search_result1($data, $rand_id) 
    {
        $flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
        
        $data2 = "";$data4 = "";$testing = "";
        	$adminmarkupvalue = 0;//$adminmarkup->markup;
		$pgvalue =0;// $pg->charge;
	if ($flight_result != '') {
            $count_val = count($flight_result);
            $i = 0;
            $total = 0;
            foreach ($flight_result as $flight_result) {
                $count_code = count($flight_result['marketingCarrier']);
                if ($count_code <= 1) {
                    $name = $this->Flight_Model->get_flight_name($flight_result['marketingCarrier']);
                    if ($name != '') {

                        $testing[$i]['cicode'] = $flight_result['marketingCarrier'];
                        $testing[$i]['name'] = $name;
                        $testing[$i]['fnumber'] = $flight_result['flightOrtrainNumber'];
                        $testing[$i]['dlocation'] = $flight_result['locationIdDeparture'];
                        $testing[$i]['alocation'] = $flight_result['locationIdArival'];
                        $testing[$i]['timeOfDeparture'] = $flight_result['timeOfDeparture'];
                        $testing[$i]['timeOfArrival'] = $flight_result['timeOfArrival'];
                        $testing[$i]['dateOfDeparture'] = $flight_result['dateOfDeparture'];
                        $testing[$i]['dateOfArrival'] = $flight_result['dateOfArrival'];
                        $testing[$i]['equipmentType'] = $flight_result['equipmentType'];

                        $departureDate = $flight_result['dateOfDeparture'];
                        $departureTime = $flight_result['timeOfDeparture'];
                        $arrivalDate = $flight_result['dateOfArrival'];
                        $arrivalTime = $flight_result['timeOfArrival'];

                        if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
                            $testing[$i]['redeye'] = "Yes";
                        else
                            $testing[$i]['redeye'] = "No";

                        $testing[$i]['dtime_filter'] = $departureTime;
                        $testing[$i]['atime_filter'] = $arrivalTime;

                        $testing[$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                        $testing[$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";
						
						$testing[$i]['dep_date'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                        $testing[$i]['arv_date'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));

                        //Final Duration Part
                        $testing[$i]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                        $testing[$i]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                        $date_a = new DateTime($testing[$i]['ddate1']);
                        $date_b = new DateTime($testing[$i]['adate1']);
                        $interval = date_diff($date_a, $date_b);
                        $testing[$i]['duration_final'] = $interval->format('%h Hours %i Minutes');
                        if($_SESSION['lang']=='en')
							$testing[$i]['duration_final1'] = $interval->format('%h h %i min');
						else
							$testing[$i]['duration_final1'] = $interval->format('%h t %i min');
						$eft_final = str_split($flight_result['eft'],2);
						if($_SESSION['lang']=='en')
							$testing[$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
						else
							$testing[$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
						
                        $hour = $interval->format('%h');
                        $min = $interval->format('%i');
                        $dur_in_min = (($hour * 60) + $min);
                        $testing[$i]['dur_in_min'] = $dur_in_min;
			$total = (($flight_result['totalFareAmount']));
                        $testing[$i]['FareAmount'] = $flight_result['totalFareAmount'];
                        $testing[$i]['TaxAmount'] = $flight_result['totalTaxAmount'];
                        $testing[$i]['pamount'] = $total;
                        $testing[$i]['ccode'] = $data['currency'];
                        $testing[$i]['id'] = $i;
                        if (!isset($fligh_result['designator']))
                            $testing[$i]['designator'] = "";
                        else
                            $testing[$i]['designator'] = $flight_result['designator'];
                        $testing[$i]['stops'] = "0";
                        $testing[$i]['flag'] = "false";
                        $testing[$i]['rand_id'] = $rand_id;

                        $testing[$i]['admin_markup'] = $adminmarkupvalue;
                        $testing[$i]['payment_charge'] = $pgvalue;

                        // Markup Related Code
                        
                        $API_FareAmount = $total;
                        $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                        $markup1 = $API_FareAmount + $admin_markup;
                        $pg_charge = ($markup1 * $pgvalue) / 100;
                        
                        $airline_markup=0;$country_markup=0;
                        if($airlinemarkup!='')
                        {
							for($m = 0;$m < count($airlinemarkup);$m++)
							{
								if((strcmp($testing[$i]['name'], $airlinemarkup[$m]->airline))==0)
									$airline_markup += ($API_FareAmount * ($airlinemarkup[$m]->markup)) / 100;
							}
						}
						
                        
                        if($countrymarkup!='')
                        {
							for($m = 0;$m < count($countrymarkup);$m++)
							{
								$country_name = $this->Flight_Model->get_country_name($flight_result['locationIdDeparture']);						
								if((strcmp($country_name[0]->country, $countrymarkup[$m]->country))==0)
									$country_markup += ($API_FareAmount * ($countrymarkup[$m]->markup)) / 100;
							}
						}
                        $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge + $country_markup + $airline_markup;
                        $total_markup = $admin_markup + $pg_charge;
                        $testing[$i]['Total_FareAmount'] = ($Total_FareAmount);
                        $testing[$i]['airline_markup'] = ($airline_markup);
                        $testing[$i]['country_markup'] = ($country_markup);
                        
                        if (isset($flight_result['paxFareProduct'][0]['rbd'])) {
                            $testing[$i]['BookingClass'] = $flight_result['paxFareProduct'][0]['rbd'];
                            $testing[$i]['cabin'] = $flight_result['paxFareProduct'][0]['cabin'];
                        } else {
                            $testing[$i]['BookingClass'] = $flight_result['paxFareProduct']['rbd'];
                            $testing[$i]['cabin'] = $flight_result['paxFareProduct']['cabin'];
                        }
                        
                        
                         // Time Zone Related Code
						$country_time_zone_offset_dep = $this->Flight_Model->get_time_zone_details($testing[$i]['dlocation']); 
						$testing[$i]['dep_time_zone_offset'] = $country_time_zone_offset_dep;
						
						$country_time_zone_offset_arv = $this->Flight_Model->get_time_zone_details($testing[$i]['alocation']); 
						$testing[$i]['arv_time_zone_offset'] = $country_time_zone_offset_arv;
						
						$ddate = ''; $adate = '';
						$ddate = $testing[$i]['ddate1'];
						$adate = $testing[$i]['adate1'];
						
						
						$dep_zone = explode(":",($testing[$i]['dep_time_zone_offset']));
						$arv_zone = explode(":",($testing[$i]['arv_time_zone_offset']));
						$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
						
						if(!is_int($Change_clock))
						{
							$Changeclock=explode(".", $Change_clock);
							$Changeclock1=$Changeclock[1];
							$Changeclock1=($Changeclock1*6);
							$Changeclock0=$Changeclock[0];
						}
						else
						{
							$Changeclock0=$Change_clock;
							$Changeclock1= 0;
						}

						$date_a = new DateTime($ddate);
						$date_b = new DateTime($adate);
						$interval = date_diff($date_a, $date_b);
						$hour = $interval->format('%h');
						$min = $interval->format('%i');
						$min=$min+$Changeclock1;
						
						$hour=$hour-$Changeclock0;
						
						if($min>=60)
						{
							$H = FLOOR($min / 60);
							$M = $min%60;
							$hour+=$H;
							$min=$M;
						}
						if($hour<0)
						{
							$hour=((24)+($hour));
						}
						if($min<0)
						{
							$min=((60)+($min));
						}
						
						
						$dur_in_min = (($hour * 60) + $min);
						$day = floor($dur_in_min / 1440);
						$hours = floor($dur_in_min / 60);
						$minutes = ($dur_in_min % 60);
						if($hours>24)
						{
							$hours=($hours % 24);
						}
						//$hours=($hours) -($Change_clock);
						if($_SESSION['lang']=='en')
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." h ".$minutes." M";
							else
								$duration_time_zone=$hours." h ".$minutes." min";
						}
						else
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
							else
								$duration_time_zone=$hours." t ".$minutes." min";
						}
						
						
						$testing[$i]['duration_time_zone'] = $duration_time_zone;
						$testing[$i]['Clock_Changes']=$Change_clock;
						$testing[$i]['dur_in_min_time_zone'] = $dur_in_min;
						

                        $i++;
                    }
                } else {
                    $testing[$i]['dur_in_min'] = "";$testing[$i]['dur_in_min_layover'] = "";$testing[$i]['pamount'] = "";
                    $flag_marketingCarrier_set_true = false;$flag_marketingCarrier_set_false = true;
                    $h = 0;$m = 0;$total = 0;$airline_markup=0;$country_markup=0;
                    for ($j = 0; $j < ($count_code); $j++) {
                        $name = $this->Flight_Model->get_flight_name($flight_result['marketingCarrier'][$j]);
                        if ($name != '') {
                            $testing[$i]['cicode'][$j] = $flight_result['marketingCarrier'][$j];
                            $testing[$i]['name'][$j] = $name;
                            $testing[$i]['fnumber'][$j] = $flight_result['flightOrtrainNumber'][$j];
                            $testing[$i]['dlocation'][$j] = $flight_result['locationIdDeparture'][$j];
                            $testing[$i]['alocation'][$j] = $flight_result['locationIdArival'][$j];
                            $testing[$i]['timeOfDeparture'][$j] = $flight_result['timeOfDeparture'][$j];
                            $testing[$i]['timeOfArrival'][$j] = $flight_result['timeOfArrival'][$j];
                            $testing[$i]['dateOfDeparture'][$j] = $flight_result['dateOfDeparture'][$j];
                            $testing[$i]['dateOfArrival'][$j] = $flight_result['dateOfArrival'][$j];

                            $departureDate = $flight_result['dateOfDeparture'][$j];
                            $departureTime = $flight_result['timeOfDeparture'][$j];
                            $arrivalDate = $flight_result['dateOfArrival'][$j];
                            $arrivalTime = $flight_result['timeOfArrival'][$j];
                            $testing[$i]['equipmentType'] = $flight_result['equipmentType'];

                            $testing[$i]['dtime_filter'] = $flight_result['timeOfDeparture'][0];
                            $testing[$i]['atime_filter'] = $arrivalTime;

                            if ((($flight_result['timeOfDeparture'][0]) <= "0700") && ($arrivalTime >= "2000"))
                                $testing[$i]['redeye'] = "Yes";
                            else
                                $testing[$i]['redeye'] = "No";

                            $testing[$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                            $testing[$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

                            $testing[$i]['dep_date'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                            $testing[$i]['arv_date'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));

                            //Final Duration Part
                            $testing[$i]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                            $testing[$i]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                            $date_a = new DateTime($testing[$i]['ddate1'][$j]);
                            $date_b = new DateTime($testing[$i]['adate1'][$j]);
                            $interval = date_diff($date_a, $date_b);
                            $testing[$i]['duration_final'][$j] = $interval->format('%h Hours %i Minutes');
                            if($_SESSION['lang']=='en')
								$testing[$i]['duration_final1'][$j] = $interval->format('%h h %i min');
                            else
								$testing[$i]['duration_final1'][$j] = $interval->format('%h t %i min');
                            $eft_final = str_split($flight_result['eft'],2);
							if($_SESSION['lang']=='en')
								$testing[$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
							else
								$testing[$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
							
                            $hour = $interval->format('%h');
                            $min = $interval->format('%i');
                            $dur_in_min = (($hour * 60) + $min);
                            $testing[$i]['dur_in_min']+= $dur_in_min;

                            if ($j != ($count_code - 1)) {
                                $arrivalDate_layover = $flight_result['dateOfArrival'][0];
                                $arrivalTime_layover = $flight_result['timeOfArrival'][0];
                                $departureDate_layover = $flight_result['dateOfDeparture'][($j + 1)];
                                $departureTime_layover = $flight_result['timeOfDeparture'][($j + 1)];

                                $depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
                                $arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
                                $date_c = new DateTime($depart_layover);
                                $date_d = new DateTime($arival_layover);
                                $interval_layover = date_diff($date_c, $date_d);
                                if($_SESSION['lang']=='en')
									$testing[$i]['duration_final_layover'][$j] = $interval_layover->format('%h h %i min');
								else
									$testing[$i]['duration_final_layover'][$j] = $interval_layover->format('%h t %i min');

                                $hour_layover = $interval_layover->format('%h');
                                $min_layover = $interval_layover->format('%i');
                                $dur_in_min_layover = (($hour_layover * 60) + $min_layover);
                                $testing[$i]['dur_in_min_layover'][$j] = $dur_in_min_layover;
                            } else {
                                $testing[$i]['duration_final_layover'][$j] = '';
                                $testing[$i]['dur_in_min_layover'][$j] = '';
                            }

                            if ($flight_result['marketingCarrier'][0] != $flight_result['marketingCarrier'][$j])
                                $flag_marketingCarrier_set_true = true;
                            else
                                $flag_marketingCarrier_set_flag = false;

                            if ($flag_marketingCarrier_set_true == true)
                                $testing[$i]['flag_marketingCarrier'] = true;
                            else
                                $testing[$i]['flag_marketingCarrier'] = false;
							$total = (($flight_result['totalFareAmount']));

                            //$total=(($flight_result['totalFareAmount'])+($flight_result['totalTaxAmount']));
                            $testing[$i]['FareAmount'] = $flight_result['totalFareAmount'];
                            $testing[$i]['TaxAmount'] = $flight_result['totalTaxAmount'];
                            $testing[$i]['pamount'] = $total;
                            $testing[$i]['ccode'] = $data['currency'];
                            $testing[$i]['id'] = $i;
                            if (!isset($fligh_result['designator']))
                                $testing[$i]['designator'] = "";
                            else
                                $testing[$i]['designator'] = $flight_result['designator'];
                            $testing[$i]['stops'] = ($count_code - 1);
                            $testing[$i]['flag'] = "true";
                            $testing[$i]['rand_id'] = $rand_id;

                            $API_FareAmount = $total;
                            $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                            $markup1 = $API_FareAmount + $admin_markup;
                            $pg_charge = ($markup1 * $pgvalue) / 100;
                            
                            if($airlinemarkup!='')
							{
								for($m = 0;$m < count($airlinemarkup);$m++)
								{
									if($j==0)
									{
										if((strcmp($testing[$i]['name'][$j], $airlinemarkup[$m]->airline))==0)
												$airline_markup += ($API_FareAmount * ($airlinemarkup[$m]->markup)) / 100;
									}
									else
									{
										$val = (strcmp($testing[$i]['name'][$j], $testing[$i]['name'][$j-1]));
										if($val!=0)
										{
											if((strcmp($testing[$i]['name'][$j], $airlinemarkup[$m]->airline))==0)
												$airline_markup += ($API_FareAmount * ($airlinemarkup[$m]->markup)) / 100;
										}
									}
								}
							}
							
							if($countrymarkup!='' && $j==0)
							{
								for($m = 0;$m < count($countrymarkup);$m++)
								{
									$country_name = $this->Flight_Model->get_country_name($flight_result['locationIdDeparture'][$j]);						
									if((strcmp($country_name[0]->country, $countrymarkup[$m]->country))==0)
										$country_markup += ($API_FareAmount * ($countrymarkup[$m]->markup)) / 100;
								}
							}
                            
                            $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge + $country_markup + $airline_markup;
                            $total_markup = $admin_markup + $pg_charge;
                            $testing[$i]['Total_FareAmount'] = ($Total_FareAmount);
                            $testing[$i]['airline_markup'] = ($airline_markup);
                            $testing[$i]['country_markup'] = ($country_markup);
                            if (isset($flight_result['paxFareProduct'][0]['rbd'][$j])) {
                                $testing[$i]['BookingClass'][$j] = $flight_result['paxFareProduct'][0]['rbd'][$j];
                                $testing[$i]['cabin'][$j] = $flight_result['paxFareProduct'][0]['cabin'][$j];
                            } else {
                                $testing[$i]['BookingClass'][$j] = $flight_result['paxFareProduct']['rbd'][$j];
                                $testing[$i]['cabin'][$j] = $flight_result['paxFareProduct']['cabin'][$j];
                            }
                            
                            
                            
                            
                             // Time Zone Related Code
                            $dep_code=$testing[$i]['dlocation'][$j];
                            $arv_code=$testing[$i]['alocation'][$j];
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
							$testing[$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
							$testing[$i]['arv_time_zone_offset'][$j] = $country_time_zone_offset;
							
                            $ddate = ''; $adate = '';
							$ddate = $testing[$i]['ddate1'][$j];
							$adate = $testing[$i]['adate1'][$j];
							
							
							$dep_zone = explode(":",($testing[$i]['dep_time_zone_offset'][$j]));
							$arv_zone = explode(":",($testing[$i]['arv_time_zone_offset'][$j]));
							$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
							
							if(!is_int($Change_clock))
							{
								$Changeclock=explode(".", $Change_clock);
								$Changeclock1=$Changeclock[1];
								$Changeclock1=($Changeclock1*6);
								$Changeclock0=$Changeclock[0];
							}
							else
							{
								$Changeclock0=$Change_clock;
								$Changeclock1= 0;
							}

							$date_a = new DateTime($ddate);
							$date_b = new DateTime($adate);
							$interval = date_diff($date_a, $date_b);
							$hour = $interval->format('%h');
							$min = $interval->format('%i');
							$min=$min+$Changeclock1;
							$hour=$hour-$Changeclock0;
							
						    if($min>=60)
							{
								$H = FLOOR($min / 60);
								$M = $min%60;
								$hour+=$H;
								$min=$M;
							}
							if($hour<0)
							{
								$hour=((24)+($hour));
							}
							if($min<0)
							{
								$min=((60)+($min));
							}
							//echo $hour." ".$min."<br/> ";
							
							$dur_in_min = (($hour * 60) + $min);
							$day = floor($dur_in_min / 1440);
							$hours = floor($dur_in_min / 60);
							$minutes = ($dur_in_min % 60);
							if($hours>24)
							{
								$hours=($hours % 24);
							}
							//$hours=($hours) -($Change_clock);
							if($_SESSION['lang']=='en')
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
								else
									$duration_time_zone=$hours." h ".$minutes." min";
							}
							else
							{		
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
								else
									$duration_time_zone=$hours." t ".$minutes." min";
							}
							$testing[$i]['duration_time_zone'][$j] = $duration_time_zone;
							$testing[$i]['Clock_Changes'][$j]=$Change_clock;
							$testing[$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
							// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                            
                        }
                    } 
                    $i++;
                }
            }
        }
        
         
		$min_amount = "";$min_duration = "";$max_amount = "";$max_duration = "";
        //$data['flight_result'] = $testing;
        $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
		//echo '<pre/>dfsdsdfssdfdfsd';print_r($_SESSION[$rand_id]['flight_result']);exit;
        if (!empty($testing)) {
		
			$flight_search_result = $this->load->view('search_result_ajax', $data, true);
		
            
			$minmxprice = $testing;
            $usernames = array();
            foreach ($minmxprice as $user) {
                $usernames[] = $user['Total_FareAmount'];
            }

            array_multisort($usernames, SORT_ASC, $minmxprice);
            $count = (count($minmxprice));
            $min_amount = ($minmxprice[0]['Total_FareAmount']);
            $max_amount = ($minmxprice[($count - 1)]['Total_FareAmount']);

            $minmxdur = $testing;
            $usernames = array();
            foreach ($minmxdur as $user) {
                $usernames[] = $user['dur_in_min'];
            }

            array_multisort($usernames, SORT_ASC, $minmxdur);
            $count = count($minmxdur);
            $min_duration = $minmxdur[0]['dur_in_min'];
            $max_duration = $minmxdur[($count - 1)]['dur_in_min'];


            $minmxdtime = $testing;
            $usernames = array();
            foreach ($minmxdtime as $user) {
                $usernames[] = $user['dtime_filter'];
            }

            array_multisort($usernames, SORT_ASC, $minmxdtime);
            $count = count($minmxdtime);
            $min_time_departure = $minmxdtime[0]['dtime_filter'];
            $max_time_departure = $minmxdtime[($count - 1)]['dtime_filter'];

            $min_departure = ((substr("$min_time_departure", 0, -2)) . ":" . (substr("$min_time_departure", -2)));
            $max_departure = ((substr("$max_time_departure", 0, -2)) . ":" . (substr("$max_time_departure", -2)));
            $arr = explode(":", $min_departure);
            $min_time_departure = $arr[0] * 60 + $arr[1];
            $arr = explode(":", $max_departure);
            $max_time_departure = $arr[0] * 60 + $arr[1];


            $minmxatime = $testing;
            $usernames = array();
            foreach ($minmxatime as $user) {
                $usernames[] = $user['atime_filter'];
            }

            array_multisort($usernames, SORT_ASC, $minmxatime);
            $count = count($minmxatime);
            $min_time_arival = $minmxatime[0]['atime_filter'];
            $max_time_arival = $minmxatime[($count - 1)]['atime_filter'];

            $min_arival = ((substr("$min_time_arival", 0, -2)) . ":" . (substr("$min_time_arival", -2)));
            $max_arival = ((substr("$max_time_arival", 0, -2)) . ":" . (substr("$max_time_arival", -2)));
            $arr = explode(":", $min_arival);
            $min_time_arival = $arr[0] * 60 + $arr[1];
            $arr = explode(":", $max_arival);
            $max_time_arival = $arr[0] * 60 + $arr[1];
            $result_name = array();
            $ai = 0;
            foreach ($testing as $p => $v) {
                if (count($v['name']) <= 1)
                    $result_name[$ai++] = $v['name'];
                else
                    $result_name[$ai++] = $v['name'][0];
            }

            $name_array = array_unique($result_name);
            $aa = 0;
            foreach ($name_array as $result) {
                $airlines[$aa++] = $result;
            }
            $st = 0;
            $result_stops = array();
            foreach ($testing as $p => $v) {
                $result_stops[$st++] = $v['stops'];
            }
            $stop_array = array_unique($result_stops);
            $aa = 0;
            foreach ($stop_array as $result) {
                $stops[$aa++] = $result;
            }
            // echo '<pre/>sdsa';print_r($stops);exit;
        } else {
            $flight_search_result = false;
            $airlines = "";
            $stops = "";
            $min_time_arival = '';
            $max_time_arival = '';
            $min_time_departure = '';
            $max_time_departure = '';
        }
       
    }

    // Converting arry details for display and filter for Roundtrip
    public function fetch_flight_search_result_Round_Trip($data, $rand_id) 
    {
        $flight_result = $data['flight_result'];
        $_SESSION['flight_result1'] = $flight_result;
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
        $data2 = "";
        $data4 = "";
        
        //Markup Values
	$adminmarkupvalue =0;// $adminmarkup->markup;
	$pgvalue = 0;//$pg->charge;
        $testing = "";
        $_SESSION['MTK_flag'] ="No";
        if ($flight_result != '') {
            $count_val = count($flight_result);
            $i = 0;$total = 0;
            foreach ($flight_result as $flight_result1) {
                $count_code = count($flight_result1['oneWay']['marketingCarrier']);
                if ($count_code <= 1) {
                    $name = $this->Flight_Model->get_flight_name($flight_result1['oneWay']['marketingCarrier']);
                    if ($name != '') {
                        $testing['oneway'][$i]['cicode'] = $flight_result1['oneWay']['marketingCarrier'];
                        $testing['oneway'][$i]['eft'] = $flight_result1['oneWay']['eft'];
                        $testing['oneway'][$i]['name'] = $name;
                        $testing['oneway'][$i]['fnumber'] = $flight_result1['oneWay']['flightOrtrainNumber'];
                        $testing['oneway'][$i]['equipmentType'] = $flight_result1['oneWay'] ['equipmentType'];
                        $testing['oneway'][$i]['dlocation'] = $flight_result1['oneWay']['locationIdDeparture'];
                        $departureDate = $flight_result1['oneWay']['dateOfDeparture'];
                        $departureTime = $flight_result1['oneWay']['timeOfDeparture'];
                        $testing['oneway'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

                        $testing['oneway'][$i]['alocation'] = $flight_result1['oneWay']['locationIdArival'];
                        $arrivalDate = $flight_result1['oneWay']['dateOfArrival'];
                        $arrivalTime = $flight_result1['oneWay']['timeOfArrival'];
                        $testing['oneway'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

                        $departureDate=$testing['oneway'][$i]['dateOfDeparture'] = $flight_result1['oneWay']['dateOfDeparture'];
                        $departureTime = $flight_result1['oneWay']['timeOfDeparture'];
                        $arrivalDate = $testing['oneway'][$i]['dateOfArrival']=  $flight_result1['oneWay']['dateOfArrival'];
                        $arrivalTime = $flight_result1['oneWay']['timeOfArrival'];
                        $testing['oneway'][$i]['timeOfDeparture'] = $flight_result1['oneWay']['timeOfDeparture'];
                        $testing['oneway'][$i]['timeOfArrival'] = $flight_result1['oneWay']['timeOfArrival'];

                        if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
                            $testing['oneway'][$i]['redeye'] = "Yes";
                        else
                            $testing['oneway'][$i]['redeye'] = "No";

                        $testing['oneway'][$i]['dtime_filter'] = $flight_result1['oneWay']['timeOfDeparture'];
                        $testing['oneway'][$i]['atime_filter'] = $arrivalTime;
                        $testing['oneway'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                        $testing['oneway'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";
						$testing['oneway'][$i]['dep_date'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                        $testing['oneway'][$i]['arv_date'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));
						
						//Final Duration Part
                        $testing['oneway'][$i]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                        $testing['oneway'][$i]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                        $date_a = new DateTime($testing['oneway'][$i]['ddate1']);
                        $date_b = new DateTime($testing['oneway'][$i]['adate1']);
                        $interval = date_diff($date_a, $date_b);
                        $testing['oneway'][$i]['duration_final'] = $interval->format('%h hours %i minutes');
                        $testing['oneway'][$i]['duration_final1'] = $interval->format('%h h %i m');
 						$eft_final = str_split($flight_result1['oneWay']['eft'],2);
						if($_SESSION['lang']=='en')
							$testing['oneway'][$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
						else
							$testing['oneway'][$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
                        
                        $hour = $interval->format('%h');
                        $min = $interval->format('%i');
                        $dur_in_min = (($hour * 60) + $min);
                        $testing['oneway'][$i]['dur_in_min'] = $dur_in_min;
                        //$total=(($flight_result1['Recomm']['totalFareAmount'])+($flight_result1['Recomm']['totalTaxAmount']));
                        if($flight_result1['MultiTicket']=="Yes")
                        {
							$total = (($flight_result1['Recomm'][0]['totalFareAmount'])+(($flight_result1['Recomm'][1]['totalFareAmount'])));
							$testing['oneway'][$i]['pamount'] = $total;
							$testing['oneway'][$i]['FareAmount'] = (($flight_result1['Recomm'][0]['totalFareAmount'])+($flight_result1['Recomm'][1]['totalFareAmount']));
							$testing['oneway'][$i]['TaxAmount'] = (($flight_result1['Recomm'][0]['totalTaxAmount'])+($flight_result1['Recomm'][1]['totalTaxAmount']));
						}
						else
						{
							$total = (($flight_result1['Recomm']['totalFareAmount']));
							$testing['oneway'][$i]['pamount'] = $total;
							$testing['oneway'][$i]['FareAmount'] = $flight_result1['Recomm']['totalFareAmount'];
							$testing['oneway'][$i]['TaxAmount'] = $flight_result1['Recomm']['totalTaxAmount'];
						}
                        $testing['oneway'][$i]['ccode'] = $data['currency'];
                        $testing['oneway'][$i]['id'] = $i;
                        //$testing['oneway'][$i]['designator']=$flight_result1['Recomm']['paxFareProduct']['designator'];
                        $testing['oneway'][$i]['stops'] = "0";
                        $testing['oneway'][$i]['flag'] = "false";
                        $testing['oneway'][$i]['MultiTicket']=$flight_result1['MultiTicket'];
                        $testing['oneway'][$i]['rand_id'] = $rand_id;

                        // //Markup Values
                        $testing['oneway'][$i]['admin_markup'] = $adminmarkupvalue;
                        $testing['oneway'][$i]['payment_charge'] = $pgvalue;

                        $API_FareAmount = $total;
                        $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                        $markup1 = $API_FareAmount + $admin_markup;
                        $pg_charge = ($markup1 * $pgvalue) / 100;
                        $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                        $total_markup = $admin_markup + $pg_charge;
                        $testing['oneway'][$i]['Total_FareAmount'] = $Total_FareAmount;


                        if($flight_result1['MultiTicket']=="Yes")
                        {
							$count_rbd = count($flight_result1['Recomm'][0]['paxFareProduct']);
							if (isset($flight_result1['Recomm'][0]['paxFareProduct'][0])) 
							{
								if(isset($flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]))
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['rbd'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['cabin'];
								}
								else
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['cabin'];

								}
							} 
							else 
							{
								if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]))
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['cabin'];
								}
								else
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'];
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
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['cabin'];
								}
								else
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'];

								}
							} 
							else 
							{
								if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]))
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['cabin'];
								}
								else
								{
									$testing['oneway'][$i]['BookingClass'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'];
									$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'];
								}
							}
						}
						
						
					 // Time Zone Related Code
						$dep_code=$testing['oneway'][$i]['dlocation'];
						$arv_code=$testing['oneway'][$i]['alocation'];

						
						$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
						$testing['oneway'][$i]['dep_time_zone_offset'] = $country_time_zone_offset;
						
						$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
						$testing['oneway'][$i]['arv_time_zone_offset'] = $country_time_zone_offset;
						
						$ddate = ''; $adate = '';
						$ddate = $testing['oneway'][$i]['ddate1'];
						$adate = $testing['oneway'][$i]['adate1'];
						
						
						$dep_zone = explode(":",($testing['oneway'][$i]['dep_time_zone_offset']));
						$arv_zone = explode(":",($testing['oneway'][$i]['arv_time_zone_offset']));
						$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
						
						if(!is_int($Change_clock))
						{
							$Changeclock=explode(".", $Change_clock);
							$Changeclock1=$Changeclock[1];
							$Changeclock1=($Changeclock1*6);
							$Changeclock0=$Changeclock[0];
						}
						else
						{
							$Changeclock0=$Change_clock;
							$Changeclock1= 0;
						}

						$date_a = new DateTime($ddate);
						$date_b = new DateTime($adate);
						$interval = date_diff($date_a, $date_b);
						$hour = $interval->format('%h');
						$min = $interval->format('%i');
						$min=$min+$Changeclock1;
						$hour=$hour-$Changeclock0;
						
						if($min>=60)
						{
							$H = FLOOR($min / 60);
							$M = $min%60;
							$hour+=$H;
							$min=$M;
						}
						if($hour<0)
						{
							$hour=((24)+($hour));
						}
						if($min<0)
						{
							$min=((60)+($min));
						}
						//echo $hour." ".$min."<br/> ";
						
						$dur_in_min = (($hour * 60) + $min);
						$day = floor($dur_in_min / 1440);
						$hours = floor($dur_in_min / 60);
						$minutes = ($dur_in_min % 60);
						if($hours>24)
						{
							$hours=($hours % 24);
						}
						//$hours=($hours) -($Change_clock);
						if($_SESSION['lang']=='en')
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
							else
								$duration_time_zone=$hours." h ".$minutes." min";
						}
						else
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
							else
								$duration_time_zone=$hours." t ".$minutes." min";
						}
						$testing['oneway'][$i]['duration_time_zone'] = $duration_time_zone;
						$testing['oneway'][$i]['Clock_Changes']=$Change_clock;
						$testing['oneway'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
                        $i++;
                    }
                } else {
                    $testing['oneway'][$i]['dur_in_min'] = "";
                    $h = 0;
                    $m = 0;
                    $total = 0;
                    for ($j = 0; $j < ($count_code); $j++) {
                        $name = $this->Flight_Model->get_flight_name($flight_result1['oneWay']['marketingCarrier'][$j]);
                        if ($name != '') {
                            $testing['oneway'][$i]['cicode'][$j] = $flight_result1['oneWay']['marketingCarrier'][$j];
                            $testing['oneway'][$i]['eft'] = $flight_result1['oneWay']['eft'];
                            $testing['oneway'][$i]['name'][$j] = $name;
                            $testing['oneway'][$i]['fnumber'][$j] = $flight_result1['oneWay']['flightOrtrainNumber'][$j];
                            $testing['oneway'][$i]['equipmentType'] = $flight_result1['oneWay'] ['equipmentType'];
                            $testing['oneway'][$i]['dlocation'][$j] = $flight_result1['oneWay']['locationIdDeparture'][$j];
                            $departureDate = $flight_result1['oneWay']['dateOfDeparture'][$j];
                            $departureTime = $flight_result1['oneWay']['timeOfDeparture'][$j];
                            $testing['oneway'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

                            $testing['oneway'][$i]['alocation'][$j] = $flight_result1['oneWay']['locationIdArival'][$j];
                            $arrivalDate = $flight_result1['oneWay']['dateOfArrival'][$j];
                            $arrivalTime = $flight_result1['oneWay']['timeOfArrival'][$j];
                            $testing['oneway'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";


                            $testing['oneway'][$i]['dateOfDeparture'][$j]=$departureDate = $flight_result1['oneWay']['dateOfDeparture'][$j];
                            $departureTime = $flight_result1['oneWay']['timeOfDeparture'][$j];
                            $testing['oneway'][$i]['dateOfArrival'][$j]=$arrivalDate = $flight_result1['oneWay']['dateOfArrival'][$j];
                            $arrivalTime = $flight_result1['oneWay']['timeOfArrival'][$j];

                            $testing['oneway'][$i]['timeOfDeparture'][$j] = $flight_result1['oneWay']['timeOfDeparture'][$j];
                            $testing['oneway'][$i]['timeOfArrival'][$j] = $flight_result1['oneWay']['timeOfArrival'][$j];

                            if (($flight_result1['oneWay']['timeOfDeparture'][0] <= "0700") && ($arrivalTime >= "2000"))
                                $testing['oneWay'][$i]['redeye'] = "Yes";
                            else
                                $testing['oneway'][$i]['redeye'] = "No";

                            $testing['oneway'][$i]['dtime_filter'] = $flight_result1['oneWay']['timeOfDeparture'][0];
                            $testing['oneway'][$i]['atime_filter'] = $arrivalTime;


                            $testing['oneway'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                            $testing['oneway'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

							$testing['oneway'][$i]['dep_date'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                            $testing['oneway'][$i]['arv_date'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));


                            //Final Duration Part
                            $testing['oneway'][$i]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                            $testing['oneway'][$i]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                            $date_a = new DateTime($testing['oneway'][$i]['ddate1'][$j]);
                            $date_b = new DateTime($testing['oneway'][$i]['adate1'][$j]);
                            $interval = date_diff($date_a, $date_b);
                            $testing['oneway'][$i]['duration_final'][$j] = $interval->format('%h hours %i minutes');
                            $testing['oneway'][$i]['duration_final1'][$j] = $interval->format('%h h %i m');
			    $eft_final = str_split($flight_result1['oneWay']['eft'],2);
                            if($_SESSION['lang']=='en')
								$testing['oneway'][$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
							else
								$testing['oneway'][$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
                            
                            $hour = $interval->format('%h');
                            $min = $interval->format('%i');
                            $dur_in_min = (($hour * 60) + $min);
                            $testing['oneway'][$i]['dur_in_min']+= $dur_in_min;

                            if ($j != ($count_code - 1)) 
                            {
                                $arrivalDate_layover = $flight_result1['oneWay']['dateOfArrival'][$j];
                                $arrivalTime_layover = $flight_result1['oneWay']['timeOfArrival'][$j];
                                $departureDate_layover = $flight_result1['oneWay']['dateOfDeparture'][($j + 1)];
                                $departureTime_layover = $flight_result1['oneWay']['timeOfDeparture'][($j + 1)];

                                $depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
                                $arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
                                $date_c = new DateTime($depart_layover);
                                $date_d = new DateTime($arival_layover);
                                $interval_layover = date_diff($date_c, $date_d);
                                $testing['oneway'][$i]['duration_final_layover'][$j] = $interval_layover->format('%h hours %i minutes');

                                $hour_layover = $interval_layover->format('%h');
                                $min_layover = $interval_layover->format('%i');
                                $dur_in_min_layover = (($hour_layover * 60) + $min_layover);
                                $testing['oneway'][$i]['dur_in_min_layover'][$j] = $dur_in_min_layover;
                            } 
                            else 
                            {
                                $testing['oneway'][$i]['duration_final_layover'][$j] = '';
                                $testing['oneway'][$i]['dur_in_min_layover'][$j] = '';
                            }


                            if ($flight_result1['oneWay']['marketingCarrier'][0] != $flight_result1['oneWay']['marketingCarrier'][$j])
                                $flag_marketingCarrier = true;
                            else
                                $flag_marketingCarrier = false;

                            $testing['oneway'][$i]['flag_marketingCarrier'] = $flag_marketingCarrier;

                            //$total=(($flight_result1['Recomm']['totalFareAmount'])+($flight_result1['Recomm']['totalTaxAmount']));
                            if(isset($flight_result1['Recomm'][0]))
                            {
								$total = (($flight_result1['Recomm'][0]['totalFareAmount'])+($flight_result1['Recomm'][1]['totalFareAmount']));
								$testing['oneway'][$i]['pamount'] = $total;
								$testing['oneway'][$i]['FareAmount'] = (($flight_result1['Recomm'][0]['totalFareAmount'])+($flight_result1['Recomm'][1]['totalFareAmount']));
								$testing['oneway'][$i]['TaxAmount'] = (($flight_result1['Recomm'][01]['totalTaxAmount'])+($flight_result1['Recomm'][1]['totalTaxAmount']));
							}
							else
							{
								$total = ($flight_result1['Recomm']['totalFareAmount']);
								$testing['oneway'][$i]['pamount'] = $total;
								$testing['oneway'][$i]['FareAmount'] = $flight_result1['Recomm']['totalFareAmount'];
								$testing['oneway'][$i]['TaxAmount'] = $flight_result1['Recomm']['totalTaxAmount'];
							}
								
                            
                            $testing['oneway'][$i]['ccode'] = $data['currency'];
                            $testing['oneway'][$i]['id'] = $i;

                            //$testing['oneway'][$i]['designator']=$flight_result1['Recomm']['paxFareProduct']['designator'];
                            $testing['oneway'][$i]['stops'] = ($count_code - 1);
                            $testing['oneway'][$i]['flag'] = "true";
                            $testing['oneway'][$i]['MultiTicket']=$flight_result1['MultiTicket'];
                            $testing['oneway'][$i]['rand_id'] = $rand_id;

                            // //Markup Values
                            $testing['oneway'][$i]['admin_markup'] = $adminmarkupvalue;
                            $testing['oneway'][$i]['payment_charge'] = $pgvalue;

                            $API_FareAmount = $total;
                            $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                            $markup1 = $API_FareAmount + $admin_markup;
                            $pg_charge = ($markup1 * $pgvalue) / 100;
                            $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                            $total_markup = $admin_markup + $pg_charge;
                            $testing['oneway'][$i]['Total_FareAmount'] = $Total_FareAmount;

                           if($flight_result1['MultiTicket']!="Yes")
                           {
								$count_rbd = count($flight_result1['Recomm']['paxFareProduct']);
								if (isset($flight_result1['Recomm']['paxFareProduct'][0])) 
								{
									if(isset($flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]))
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['rbd'][$j];
										$testing['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails'][0]['cabin'][$j];
									}
									else
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'][$j];
										$testing['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'][$j];								
									}
								} 
								else 
								{
									if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]))
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['rbd'][$j];
										$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails'][0]['cabin'][$j];
									}
									else
									{
										if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j]))
											$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j];
										else
											$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['rbd'];
										if(isset($flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j]))
											$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j];
										else
											$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm']['paxFareProduct']['fareDetails']['cabin'];
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
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['rbd'][$j];
										$testing['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails'][0]['cabin'][$j];
									}
									else
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['rbd'][$j];
										$testing['oneway'][$i]['cabin'][$j] = $flight_result1['Recomm'][0]['paxFareProduct'][0]['fareDetails']['cabin'][$j];								
									}
								} 
								else 
								{
									if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]))
									{
										$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['rbd'][$j];
										$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails'][0]['cabin'][$j];
									}
									else
									{
										if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][$j]))
											$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'][$j];
										else
											$testing['oneway'][$i]['BookingClass'][$j] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['rbd'];
										if(isset($flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'][$j]))
											$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'][$j];
										else
											$testing['oneway'][$i]['cabin'] = $flight_result1['Recomm'][0]['paxFareProduct']['fareDetails']['cabin'];
									}
								}
							}
							
							 // Time Zone Related Code
                            $dep_code=$testing['oneway'][$i]['dlocation'][$j];
                            $arv_code=$testing['oneway'][$i]['alocation'][$j];
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
							$testing['oneway'][$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
							$testing['oneway'][$i]['arv_time_zone_offset'][$j] = $country_time_zone_offset;
							
                            $ddate = ''; $adate = '';
							$ddate = $testing['oneway'][$i]['ddate1'][$j];
							$adate = $testing['oneway'][$i]['adate1'][$j];
							
							
							$dep_zone = explode(":",($testing['oneway'][$i]['dep_time_zone_offset'][$j]));
							$arv_zone = explode(":",($testing['oneway'][$i]['arv_time_zone_offset'][$j]));
							$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
							
							if(!is_int($Change_clock))
							{
								$Changeclock=explode(".", $Change_clock);
								$Changeclock1=$Changeclock[1];
								$Changeclock1=($Changeclock1*6);
								$Changeclock0=$Changeclock[0];
							}
							else
							{
								$Changeclock0=$Change_clock;
								$Changeclock1= 0;
							}

							$date_a = new DateTime($ddate);
							$date_b = new DateTime($adate);
							$interval = date_diff($date_a, $date_b);
							$hour = $interval->format('%h');
							$min = $interval->format('%i');
							$min=$min+$Changeclock1;
							$hour=$hour-$Changeclock0;
							
						    if($min>=60)
							{
								$H = FLOOR($min / 60);
								$M = $min%60;
								$hour+=$H;
								$min=$M;
							}
							if($hour<0)
							{
								$hour=((24)+($hour));
							}
							if($min<0)
							{
								$min=((60)+($min));
							}
							//echo $hour." ".$min."<br/> ";
							
							$dur_in_min = (($hour * 60) + $min);
							$day = floor($dur_in_min / 1440);
							$hours = floor($dur_in_min / 60);
							$minutes = ($dur_in_min % 60);
							if($hours>24)
							{
								$hours=($hours % 24);
							}
							//$hours=($hours) -($Change_clock);
							if($_SESSION['lang']=='en')
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
								else
									$duration_time_zone=$hours." h ".$minutes." min";
								//$hours=($hours) -($Change_clock);
							}
							else
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
								else
									$duration_time_zone=$hours." t ".$minutes." min";
							}
							$testing['oneway'][$i]['duration_time_zone'][$j] = $duration_time_zone;
							$testing['oneway'][$i]['Clock_Changes'][$j]=$Change_clock;
							$testing['oneway'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
							// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                            
						}
                    }

                    $i++;
                }
            }
        }
		if ($flight_result != '') {
            $count_val = (count($flight_result));$i = 0;$total = 0;
            foreach ($flight_result as $flight_result2) {
                
                if(isset($flight_result2['oneWay'])){
                $count_code = count($flight_result2['Return']['marketingCarrier']);
                if ($count_code <= 1) {
                    $name = $this->Flight_Model->get_flight_name($flight_result2['Return']['marketingCarrier']);
                    if ($name != '') {
                        $testing['Return'][$i]['cicode'] = $flight_result2['Return']['marketingCarrier'];
                        $testing['Return'][$i]['eft'] = $flight_result2['Return']['eft'];
                        $testing['Return'][$i]['name'] = $name;
                        $testing['Return'][$i]['fnumber'] = $flight_result2['Return']['flightOrtrainNumber'];
                        $testing['Return'][$i]['equipmentType'] = $flight_result2['Return'] ['equipmentType'];
                        $testing['Return'][$i]['dlocation'] = $flight_result2['Return']['locationIdDeparture'];
                        $testing['Return'][$i]['dateOfDeparture']=$departureDate = $flight_result2['Return']['dateOfDeparture'];
                        $departureTime = $flight_result2['Return']['timeOfDeparture'];
                        $testing['Return'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

                        $testing['Return'][$i]['alocation'] = $flight_result2['Return']['locationIdArival'];
                        $arrivalDate = $flight_result2['Return']['dateOfArrival'];
                        $arrivalTime = $flight_result2['Return']['timeOfArrival'];
                        $testing['Return'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

                        $departureDate = $flight_result2['Return']['dateOfDeparture'];
                        $departureTime = $flight_result2['Return']['timeOfDeparture'];
                        $testing['Return'][$i]['dateOfArrival']=$arrivalDate = $flight_result2['Return']['dateOfArrival'];
                        $arrivalTime = $flight_result2['Return']['timeOfArrival'];

                        $testing['Return'][$i]['timeOfDeparture'] = $flight_result2['Return']['timeOfDeparture'];
                        $testing['Return'][$i]['timeOfArrival'] = $flight_result2['Return']['timeOfArrival'];

                        if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
                            $testing['Return'][$i]['redeye'] = "Yes";
                        else
                            $testing['Return'][$i]['redeye'] = "No";

                        $testing['Return'][$i]['dtime_filter'] = $flight_result2['Return']['timeOfDeparture'];
                        $testing['Return'][$i]['atime_filter'] = $arrivalTime;
                        $testing['Return'][$i]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                        $testing['Return'][$i]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

						$testing['Return'][$i]['dep_date'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                        $testing['Return'][$i]['arv_date'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));

                        //Final Duration Part
                        $testing['Return'][$i]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                        $testing['Return'][$i]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                        $date_a = new DateTime($testing['Return'][$i]['ddate1']);
                        $date_b = new DateTime($testing['Return'][$i]['adate1']);
                        $interval = date_diff($date_a, $date_b);
                        $testing['Return'][$i]['duration_final'] = $interval->format('%h hours %i minutes');
                        $testing['Return'][$i]['duration_final1'] = $interval->format('%h h %i m');
						$eft_final = str_split($flight_result2['Return']['eft'],2);
						if($_SESSION['lang']=='en')
							$testing['Return'][$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
						else
							$testing['Return'][$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
						
                        $hour = $interval->format('%h');
                        $min = $interval->format('%i');
                        $dur_in_min = (($hour * 60) + $min);
                        $testing['Return'][$i]['dur_in_min'] = $dur_in_min;

                        //$total=(($flight_result2['Recomm']['totalFareAmount'])+($flight_result2['Recomm']['totalTaxAmount']));
                        if($flight_result2['MultiTicket']=="Yes")
                        {
							$total = (($flight_result2['Recomm'][0]['totalFareAmount'])+($flight_result2['Recomm'][1]['totalFareAmount']));
							$testing['Return'][$i]['pamount'] = $total;
							$testing['Return'][$i]['FareAmount'] = (($flight_result2['Recomm'][0]['totalFareAmount'])+($flight_result2['Recomm'][1]['totalFareAmount']));
							$testing['Return'][$i]['TaxAmount'] = (($flight_result2['Recomm'][0]['totalTaxAmount'])+($flight_result2['Recomm'][1]['totalTaxAmount']));
						}
						else
						{
							$total = (($flight_result2['Recomm']['totalFareAmount']));
							$testing['Return'][$i]['pamount'] = $total;
							$testing['Return'][$i]['FareAmount'] = $flight_result2['Recomm']['totalFareAmount'];
							$testing['Return'][$i]['TaxAmount'] = $flight_result2['Recomm']['totalTaxAmount'];
						}
                        $testing['Return'][$i]['ccode'] = $data['currency'];
                        $testing['Return'][$i]['id'] = $i;
                        //$testing['Return'][$i]['designator']=$flight_result2['Recomm']['paxFareProduct']['designator'];
                        $testing['Return'][$i]['stops'] = "0";
                        $testing['Return'][$i]['flag'] = "false";
                        $testing['Return'][$i]['MultiTicket']=$flight_result2['MultiTicket'];
                        $testing['Return'][$i]['rand_id'] = $rand_id;

                        $testing['Return'][$i]['admin_markup'] = $adminmarkupvalue;
                        $testing['Return'][$i]['payment_charge'] = $pgvalue;

                        $API_FareAmount = $total;
                        $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                        $markup1 = $API_FareAmount + $admin_markup;
                        $pg_charge = ($markup1 * $pgvalue) / 100;
                        $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                        $total_markup = $admin_markup + $pg_charge;
                        $testing['Return'][$i]['Total_FareAmount'] = $Total_FareAmount;

                        if($flight_result2['MultiTicket']=="Yes")
                        {
							$count_rbd = count($flight_result2['Recomm'][1]['paxFareProduct']);
							if (isset($flight_result2['Recomm'][1]['paxFareProduct'][0])) {
								if(isset($flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]))
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['rbd'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['cabin'];
								}
								else
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['cabin'];
								}
							} else {
								if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]))
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['cabin'];
								}
								else
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'];
								}
							}
						}
						else
						{
							$count_rbd = count($flight_result2['Recomm']['paxFareProduct']);
							if (isset($flight_result2['Recomm']['paxFareProduct'][0])) {
								if(isset($flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]))
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['cabin'];
								}
								else
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'];
								}
							} else {
								if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]))
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['cabin'];
								}
								else
								{
									$testing['Return'][$i]['BookingClass'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'];
									$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'];
								}
							}
						}
						
						// Time Zone Related Code
						$dep_code=$testing['Return'][$i]['dlocation'];
						$arv_code=$testing['Return'][$i]['alocation'];
						
						$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
						$testing['Return'][$i]['dep_time_zone_offset'] = $country_time_zone_offset;
						
						$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
						$testing['Return'][$i]['arv_time_zone_offset'] = $country_time_zone_offset;
						
						$ddate = ''; $adate = '';
						$ddate = $testing['Return'][$i]['ddate1'];
						$adate = $testing['Return'][$i]['adate1'];
						
						
						$dep_zone = explode(":",($testing['Return'][$i]['dep_time_zone_offset']));
						$arv_zone = explode(":",($testing['Return'][$i]['arv_time_zone_offset']));
						$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
						
						if(!is_int($Change_clock))
						{
							$Changeclock=explode(".", $Change_clock);
							$Changeclock1=$Changeclock[1];
							$Changeclock1=($Changeclock1*6);
							$Changeclock0=$Changeclock[0];
						}
						else
						{
							$Changeclock0=$Change_clock;
							$Changeclock1= 0;
						}

						$date_a = new DateTime($ddate);
						$date_b = new DateTime($adate);
						$interval = date_diff($date_a, $date_b);
						$hour = $interval->format('%h');
						$min = $interval->format('%i');
						$min=$min+$Changeclock1;
						$hour=$hour-$Changeclock0;
						
						if($min>=60)
						{
							$H = FLOOR($min / 60);
							$M = $min%60;
							$hour+=$H;
							$min=$M;
						}
						if($hour<0)
						{
							$hour=((24)+($hour));
						}
						if($min<0)
						{
							$min=((60)+($min));
						}
						//echo $hour." ".$min."<br/> ";
						
						$dur_in_min = (($hour * 60) + $min);
						$day = floor($dur_in_min / 1440);
						$hours = floor($dur_in_min / 60);
						$minutes = ($dur_in_min % 60);
						if($hours>24)
						{
							$hours=($hours % 24);
						}
						//$hours=($hours) -($Change_clock);
						if($_SESSION['lang']=='en')
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
							else
								$duration_time_zone=$hours." h ".$minutes." min";
						}
						else
						{
							if ($day > 0)
								$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
							else
								$duration_time_zone=$hours." t ".$minutes." min";
						}
						$testing['Return'][$i]['duration_time_zone'] = $duration_time_zone;
						$testing['Return'][$i]['Clock_Changes']=$Change_clock;
						$testing['Return'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
						// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
						

                        $i++;
                    }
                } else {
                    $testing['Return'][$i]['dur_in_min'] = "";$h = 0;$m = 0;$total = 0;
                    for ($j = 0; $j < ($count_code); $j++) {
                        $name = $this->Flight_Model->get_flight_name($flight_result2['Return']['marketingCarrier'][$j]);
                        if ($name != '') {
                            $testing['Return'][$i]['cicode'][$j] = $flight_result2['Return']['marketingCarrier'][$j];
                            $testing['Return'][$i]['eft'] = $flight_result2['Return']['eft'];
                            $testing['Return'][$i]['name'][$j] = $name;
                            $testing['Return'][$i]['fnumber'][$j] = $flight_result2['Return']['flightOrtrainNumber'][$j];
                            $testing['Return'][$i]['equipmentType'] = $flight_result2['Return'] ['equipmentType'];
                            $testing['Return'][$i]['dlocation'][$j] = $flight_result2['Return']['locationIdDeparture'][$j];
                            $departureDate = $flight_result2['Return']['dateOfDeparture'][$j];
                            $departureTime = $flight_result2['Return']['timeOfDeparture'][$j];
                            $testing['Return'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";

                            $testing['Return'][$i]['alocation'][$j] = $flight_result2['Return']['locationIdArival'][$j];
                            $arrivalDate = $flight_result2['Return']['dateOfArrival'][$j];
                            $arrivalTime = $flight_result2['Return']['timeOfArrival'][$j];
                            $testing['Return'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

                            $testing['Return'][$i]['dateOfDeparture'][$j]=$departureDate = $flight_result2['Return']['dateOfDeparture'][$j];
                            $departureTime = $flight_result2['Return']['timeOfDeparture'][$j];
                            $testing['Return'][$i]['dateOfArrival'][$j]=$arrivalDate = $flight_result2['Return']['dateOfArrival'][$j];
                            $arrivalTime = $flight_result2['Return']['timeOfArrival'][$j];

                            $testing['Return'][$i]['timeOfDeparture'][$j] = $flight_result2['Return']['timeOfDeparture'][$j];
                            $testing['Return'][$i]['timeOfArrival'][$j] = $flight_result2['Return']['timeOfArrival'][$j];

                            $testing['Return'][$i]['dtime_filter'] = $flight_result2['Return']['timeOfDeparture'][0];
                            $testing['Return'][$i]['atime_filter'] = $arrivalTime;

                            if ((($flight_result2['Return']['timeOfDeparture'][0]) <= "0700") && ($arrivalTime >= "2000"))
                                $testing['Return'][$i]['redeye'] = "Yes";
                            else
                                $testing['Return'][$i]['redeye'] = "No";

                            $testing['Return'][$i]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                            $testing['Return'][$i]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

							$testing['Return'][$i]['dep_date'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2)));
                            $testing['Return'][$i]['arv_date'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2)));


                            //Final Duration Part
                            $testing['Return'][$i]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                            $testing['Return'][$i]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                            $date_a = new DateTime($testing['Return'][$i]['ddate1'][$j]);
                            $date_b = new DateTime($testing['Return'][$i]['adate1'][$j]);
                            $interval = date_diff($date_a, $date_b);
                            $testing['Return'][$i]['duration_final'][$j] = $interval->format('%h hours %i minutes');
                            $testing['Return'][$i]['duration_final1'][$j] = $interval->format('%h h %i m');
							$eft_final = str_split($flight_result2['Return']['eft'],2);
							if($_SESSION['lang']=='en')
								$testing['Return'][$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
							else
								$testing['Return'][$i]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
							
							$hour = $interval->format('%h');
                            $min = $interval->format('%i');
                            $dur_in_min = (($hour * 60) + $min);
                            $testing['Return'][$i]['dur_in_min']+= $dur_in_min;

                            if ($j != ($count_code - 1)) {
                                $arrivalDate_layover = $flight_result2['Return']['dateOfArrival'][$j];
                                $arrivalTime_layover = $flight_result2['Return']['timeOfArrival'][$j];
                                $departureDate_layover = $flight_result2['Return']['dateOfDeparture'][($j + 1)];
                                $departureTime_layover = $flight_result2['Return']['timeOfDeparture'][($j + 1)];

                                $depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
                                $arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
                                $date_c = new DateTime($depart_layover);
                                $date_d = new DateTime($arival_layover);
                                $interval_layover = date_diff($date_c, $date_d);
                                $testing['Return'][$i]['duration_final_layover'][$j] = $interval_layover->format('%h hours %i minutes');

                                $hour_layover = $interval_layover->format('%h');
                                $min_layover = $interval_layover->format('%i');
                                $dur_in_min_layover = (($hour_layover * 60) + $min_layover);
                                $testing['Return'][$i]['dur_in_min_layover'][$j] = $dur_in_min_layover;
                            } else {
                                $testing['Return'][$i]['duration_final_layover'][$j] = '';
                                $testing['Return'][$i]['dur_in_min_layover'][$j] = '';
                            }


                            if ($flight_result2['Return']['marketingCarrier'][0] != $flight_result2['Return']['marketingCarrier'][$j])
                                $flag_marketingCarrier = true;
                            else
                                $flag_marketingCarrier = false;

                            $testing['Return'][$i]['flag_marketingCarrier'] = $flag_marketingCarrier;

                            //$total=(($flight_result2['Recomm']['totalFareAmount'])+($flight_result2['Recomm']['totalTaxAmount']));
                            if($flight_result2['MultiTicket']=="Yes")
							{
								$total = (($flight_result2['Recomm'][0]['totalFareAmount'])+($flight_result2['Recomm'][1]['totalFareAmount']));
								$testing['Return'][$i]['pamount'] = $total;
								$testing['Return'][$i]['FareAmount'] = (($flight_result2['Recomm'][0]['totalFareAmount'])+($flight_result2['Recomm'][1]['totalFareAmount']));
								$testing['Return'][$i]['TaxAmount'] = (($flight_result2['Recomm'][0]['totalTaxAmount'])+($flight_result2['Recomm'][1]['totalTaxAmount']));
								$testing['Return'][$i]['Total_FareAmount1']=(($flight_result2['Recomm'][0]['totalFareAmount'])." + ".($flight_result2['Recomm'][1]['totalFareAmount']));
							}
							else
							{
								$total = (($flight_result2['Recomm']['totalFareAmount']));
								$testing['Return'][$i]['pamount'] = $total;
								$testing['Return'][$i]['FareAmount'] = $flight_result2['Recomm']['totalFareAmount'];
								$testing['Return'][$i]['TaxAmount'] = $flight_result2['Recomm']['totalTaxAmount'];
							}
                            $testing['Return'][$i]['ccode'] = $data['currency'];
                            $testing['Return'][$i]['id'] = $i;

                            //$testing['Return'][$i]['designator']=$flight_result2['Recomm']['paxFareProduct']['designator'];
                            $testing['Return'][$i]['stops'] = ($count_code - 1);
                            $testing['Return'][$i]['flag'] = "true";
                            $testing['Return'][$i]['MultiTicket']=$flight_result2['MultiTicket'];
                            $testing['Return'][$i]['rand_id'] = $rand_id;

                            $testing['Return'][$i]['admin_markup'] = $adminmarkupvalue;
                            $testing['Return'][$i]['payment_charge'] = $pgvalue;

                            $API_FareAmount = $total;
                            $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                            $markup1 = $API_FareAmount + $admin_markup;
                            $pg_charge = ($markup1 * $pgvalue) / 100;
                            $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                            $total_markup = $admin_markup + $pg_charge;
                            $testing['Return'][$i]['Total_FareAmount'] = $Total_FareAmount;


                            if($flight_result2['MultiTicket']=="Yes")
                            {
								if (isset($flight_result2['Recomm'][1]['paxFareProduct'][0])) {
									if(isset($flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]))
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['rbd'][$j];
										$testing['Return'][$i]['cabin'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails'][1]['cabin'][$j];
									}
									else
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['rbd'][$j];
										$testing['Return'][$i]['cabin'][$j] = $flight_result2['Recomm'][1]['paxFareProduct'][0]['fareDetails']['cabin'][$j];
									}
								} 
								else 
								{
									if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]))
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['rbd'][$j];
										$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails'][1]['cabin'][$j];
									}
									else
									{
										if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][$j]))
											$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'][$j];
										else
											$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['rbd'];
										if(isset($flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'][$j]))
											$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'][$j];
										else
											$testing['Return'][$i]['cabin'] = $flight_result2['Recomm'][1]['paxFareProduct']['fareDetails']['cabin'];
									}
								}
							}
							else
							{
								if (isset($flight_result2['Recomm']['paxFareProduct'][0])) {
									if(isset($flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]))
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['rbd'][$j];
										$testing['Return'][$i]['cabin'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails'][1]['cabin'][$j];
									}
									else
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['rbd'][$j];
										$testing['Return'][$i]['cabin'][$j] = $flight_result2['Recomm']['paxFareProduct'][0]['fareDetails']['cabin'][$j];
									}
								} 
								else 
								{
									if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]))
									{
										$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['rbd'][$j];
										$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails'][1]['cabin'][$j];
									}
									else
									{
										if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j]))
											$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'][$j];
										else
											$testing['Return'][$i]['BookingClass'][$j] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['rbd'];
										if(isset($flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j]))
											$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'][$j];
										else
											$testing['Return'][$i]['cabin'] = $flight_result2['Recomm']['paxFareProduct']['fareDetails']['cabin'];
									}
								}
							}
							
							// Time Zone Related Code
                            $dep_code=$testing['Return'][$i]['dlocation'][$j];
                            $arv_code=$testing['Return'][$i]['alocation'][$j];
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($dep_code); 
							$testing['Return'][$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flight_Model->get_time_zone_details($arv_code); 
							$testing['Return'][$i]['arv_time_zone_offset'][$j] = $country_time_zone_offset;
							
                            $ddate = ''; $adate = '';
							$ddate = $testing['Return'][$i]['ddate1'][$j];
							$adate = $testing['Return'][$i]['adate1'][$j];
							
							
							$dep_zone = explode(":",($testing['Return'][$i]['dep_time_zone_offset'][$j]));
							$arv_zone = explode(":",($testing['Return'][$i]['arv_time_zone_offset'][$j]));
							$Change_clock=(($arv_zone[0].".".$arv_zone[1])-($dep_zone[0].".".$dep_zone[1]));
							
							if(!is_int($Change_clock))
							{
								$Changeclock=explode(".", $Change_clock);
								$Changeclock1=$Changeclock[1];
								$Changeclock1=($Changeclock1*6);
								$Changeclock0=$Changeclock[0];
							}
							else
							{
								$Changeclock0=$Change_clock;
								$Changeclock1= 0;
							}

							$date_a = new DateTime($ddate);
							$date_b = new DateTime($adate);
							$interval = date_diff($date_a, $date_b);
							$hour = $interval->format('%h');
							$min = $interval->format('%i');
							$min=$min+$Changeclock1;
							$hour=$hour-$Changeclock0;
							
						    if($min>=60)
							{
								$H = FLOOR($min / 60);
								$M = $min%60;
								$hour+=$H;
								$min=$M;
							}
							if($hour<0)
							{
								$hour=((24)+($hour));
							}
							if($min<0)
							{
								$min=((60)+($min));
							}
							//echo $hour." ".$min."<br/> ";
							
							$dur_in_min = (($hour * 60) + $min);
							$day = floor($dur_in_min / 1440);
							$hours = floor($dur_in_min / 60);
							$minutes = ($dur_in_min % 60);
							if($hours>24)
							{
								$hours=($hours % 24);
							}
							//$hours=($hours) -($Change_clock);
							if($_SESSION['lang']=='en')
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
								else
									$duration_time_zone=$hours." h ".$minutes." min";
							}
							else
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
								else
									$duration_time_zone=$hours." t ".$minutes." min";
							}
							$testing['Return'][$i]['duration_time_zone'][$j] = $duration_time_zone;
							$testing['Return'][$i]['Clock_Changes'][$j]=$Change_clock;
							$testing['Return'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
							// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                        }
                    }
                    $i++;
                }
			}
            }
        }
        // echo '<pre/>asdas';print_r($testing);exit;
        $data['flight_result'] = $testing;
        $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
        $min_amount = "";$min_duration = "";$max_amount = "";$max_duration = "";
        if (!empty($testing)) {
			$n = 0;
            foreach ($testing['oneway'] as $final_result) {
                $testing['oneway'][$n++] = $final_result;
            }
            $n = 0;
            foreach ($testing['Return'] as $final_result1) {
                $testing['Return'][$n++] = $final_result1;
            }
            $data['flight_result'] = $testing;
            $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
            $flight_search_result = $this->load->view('search_result_ajax_roundtrip', $data, true);
	    $minmxprice = $testing['oneway'];
            $usernames = array();
            foreach ($minmxprice as $user) {
                $usernames[] = $user['Total_FareAmount'];
            }

            array_multisort($usernames, SORT_ASC, $minmxprice);
            $count = (count($minmxprice));
            $min_amount = ($minmxprice[0]['Total_FareAmount']);
            $max_amount = ($minmxprice[($count - 1)]['Total_FareAmount']);
			$minmxdtime = $testing['oneway'];
            $usernames = array();
            foreach ($minmxdtime as $user) {
                $usernames[] = $user['dtime_filter'];
            }

            array_multisort($usernames, SORT_ASC, $minmxdtime);
            $count = count($minmxdtime);
            $min_time_departure = $minmxdtime[0]['dtime_filter'];
            $max_time_departure = $minmxdtime[($count - 1)]['dtime_filter'];

            $minmxatime = $testing['oneway'];
            $usernames = array();
            foreach ($minmxatime as $user) {
                $usernames[] = $user['atime_filter'];
            }

            array_multisort($usernames, SORT_ASC, $minmxatime);
            $count = count($minmxatime);
            $min_time_arival = $minmxatime[0]['atime_filter'];
            $max_time_arival = $minmxatime[($count - 1)]['atime_filter'];

            $min_hours_ar = intval($min_time_arival / 100);
            $min_min_ar = ($min_time_arival % 100);
            $minInHours_ar = ($min_hours_ar * 60);
            $min_time_arival = $minInHours_ar + $min_min_ar;

            $max_hours_ar = intval($max_time_arival / 100);
            $max_min_ar = ($max_time_arival % 100);
            $maxInHours_ar = ($max_hours_ar * 60);
            $max_time_arival = $maxInHours_ar + $max_min_ar;


            $min_hours_de = intval($min_time_departure / 100);
            $min_min_de = ($min_time_departure % 100);
            $minInHours_de = ($min_hours_de * 60);
            $min_time_departure = $minInHours_de + $min_min_de;

            $max_hours_de = intval($max_time_departure / 100);
            $max_min_de = ($max_time_departure % 100);
            $maxInHours_de = ($max_hours_de * 60);
            $max_time_departure = $maxInHours_de + $max_min_de;



            $minmxdur = $testing['oneway'];
            $usernames = array();
            foreach ($minmxdur as $user) {
                $usernames[] = $user['dur_in_min'];
            }

            array_multisort($usernames, SORT_ASC, $minmxdur);
            $count = count($minmxdur);
            $min_duration = $minmxdur[0]['dur_in_min'];
            $max_duration = $minmxdur[($count - 1)]['dur_in_min'];

            $result_name = array();
            $ai = 0;
            foreach ($testing['oneway'] as $p => $v) {
                if (count($v['name']) <= 1)
                    $result_name[$ai++] = $v['name'];
                else
                    $result_name[$ai++] = $v['name'][0];
            }

            $name_array = array_unique($result_name);
            $aa = 0;
            foreach ($name_array as $result) {
                $airlines[$aa++] = $result;
            }
            $st = 0;
            $result_stops = array();
            foreach ($testing['oneway'] as $p => $v) {
                $result_stops[$st++] = $v['stops'];
            }
            $stop_array = array_unique($result_stops);
            $aa = 0;
            foreach ($stop_array as $result) {
                $stops[$aa++] = $result;
            }
        } else {
            $flight_search_result = false;
            $airlines = "";
            $min_time_arival = '';
            $max_time_arival = '';
            $min_time_departure = '';
            $max_time_departure = '';
            $stops = "";
        }

		echo json_encode(array(
            'flight_search_result' => $flight_search_result,
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
	
    // Flight Deatils for calendar
    public function calendar_flight_detail() 
    {
	
		$id=$_POST['id'];
		$id1=$_POST['id1'];
		$rand_id=$_POST['ids'];
		$date_id=$_POST['date'];
		
        $ed = date('d-m-y', (strtotime("+0 day", (strtotime($_SESSION[$rand_id][$date_id]['date_ed'])))));
        $sd = date('d-m-y', (strtotime("+0 day", (strtotime($_SESSION[$rand_id][$date_id]['date_sd'])))));
        $_SESSION[$rand_id]['sd'] = $sd;
        $_SESSION[$rand_id]['ed'] = $ed;
        $_SESSION[$rand_id]['flight_id_oneway'] = $id;
        $_SESSION[$rand_id]['flight_id_return'] = $id1;
        $_SESSION[$rand_id]['journey_type'] = "Calendar";
		
		
		$flight_result = $_SESSION[$rand_id]['flight_result'];
        $flight_result1 = $_SESSION[$rand_id]['flight_result1'];
        $country = $this->Flight_Model->country_list();
        $country_phonecode = $this->Flight_Model->country_list_phonecode();
        $data['country'] = $country;
        $data['country_phonecode'] = $country_phonecode;
        $total_fare_amount=0;
	if (($_SESSION['journey_type'] == "Round")) {
			//echo 'hiii';exit;
            $id_oneway = $_POST['oneway_trip'];
            $id_return = $_POST['round_trip'];
            $_SESSION[$rand_id]['id_oneway']=$id_oneway;
            $_SESSION[$rand_id]['id_return']=$id_return;
            $data['flightDetails_oneway'] = $flight_result['oneway'][$id_oneway];
            $data['flightDetails_return'] = $flight_result['Return'][$id_return];
			$data['flightDetails1'] = $_SESSION[$rand_id]['flight_result1'][$id_oneway];
            $data['flightDetails2'] = $_SESSION[$rand_id]['flight_result1'][$id_return];
            $total_fare_amount=$data['flightDetails_oneway']['Total_FareAmount'];
            
        } else if (($_SESSION['journey_type'] == "Calendar")) {
			//echo 'hiigfghf';exit;
			$id=$_SESSION[$rand_id]['flight_id_oneway'];
			$id1=$_SESSION[$rand_id]['flight_id_return'];
            $data['flightDetails_oneway'] = $_SESSION['flight_result']['oneway'][$id];
            $data['flightDetails_return'] = $_SESSION['flight_result']['Return'][$id1];
            $data['flightDetails1'] = $_SESSION[$rand_id]['flight_result1'][$id];
            $data['flightDetails2'] = $_SESSION[$rand_id]['flight_result1'][$id1];
			$_SESSION['flightDetails1']= $data['flightDetails_oneway'];
			$_SESSION['flightDetails2']= $data['flightDetails_return'];
            $total_fare_amount=$data['flightDetails_oneway']['Total_FareAmount'];
           
        }  else {
            $id=$_POST['oneway_trip'];
            $data['flightDetails'] = $flight_result[$id];
            $data['flightDetails1'] = $flight_result1[$id];
            $total_fare_amount=$data['flightDetails']['Total_FareAmount'];
        }
		// echo '<pre/>';print_r($data['flightDetails_oneway']);exit;
		    $details=$this->load->view('details_ajax', $data,true);
		echo $details;
    }
	function calendar_flight_detail_oneway(){
		$id=$_POST['id'];
		//$rand_id=$_POST['rand_id'];
		$data['fetch_result_id']=$_SESSION['deatils']=$_SESSION['flight_result_final'][$id];
		$deatils_oneway_ajax=$this->load->view('deatils_oneway_ajax', $data,true);
		echo $deatils_oneway_ajax;
		}
		function showmoreinform_oneway(){
			$data['finalinformation']=$_SESSION['deatils'];
			$information_oneway_ajax=$this->load->view('information_oneway_ajax', $data,true);
		echo $information_oneway_ajax;
			}
    function showmoreinform(){
		 $data['flightDetails1']=$_SESSION['flightDetails1'];
		 $data['flightDetails2']=$_SESSION['flightDetails2'];
		 $informartion_ajax=$this->load->view('informartion_ajax', $data,true);
		echo $informartion_ajax;
		}
		    public function fetch_flight_search_result2($session_id,$norway_session,$rand_id)
    {
        $flightResult = $flight_result = $this->Flight_Model->getFlightSearchResult($session_id,$norway_session);
        $flight_resultmatrix = $this->Flight_Model->getFlightSearchResultmatrix_normal($session_id,$norway_session);
        $data['flight_result']=$flightResult['search_result'];
        $data['session_id']=$session_id;
        $data['norway_session']=$norway_session;
        $data['flight_resultmatrix'] =$flight_resultmatrix['search_result'];
        $flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
		        $testing = $data['flight_resultmatrix'];
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
       
        $data['airline']=$airline_data['airline']=$airlines;
       $data['stops']= $stops_data['stops']=$stops;
        
        $data['flight_result']=$matrixData['flight_result']=$testing;
        if($data['flight_result']!='')
        {
            $flight_search_result = $this->load->view('flight/search-result',$data,true);
            $airlines=$flightResult['airlines'];
            $stops = $flightResult['stops'];
        }
        else 
        {
            $flight_search_result = false;
            $airlines = "";
            $stops = "";
        }

      
    }
		
		
		
		    public function fetch_flight_search_result_Round_Trip1($session_id,$norway_session,$rand_id)
    {
        $flightResult = $flight_result = $this->Flight_Model->getFlightSearchResultRound($session_id,$norway_session);
        $flight_resultmatrix = $this->Flight_Model->getFlightSearchResultmatrix_round($session_id,$norway_session);
        $data['flight_result']=$flightResult['search_result'];
        $flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
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
       
        $data['airline']=$airline_data['airline']=$airlines;
        $data['stops']=$stops_data['stops']=$stops;
        
         $data['flight_result']=$matrixData['flight_result']=$flight_resultmatrix;
         $data['session_id']=$matrixData['session_id']=$session_id;
         $data['norway_session']=$matrixData['norway_session']=$norway_session;
        if($data['flight_result']!='')
        {
			$data['airlines']=$airlines=$flightResult['airlines'];
            $data['stops']=$stops = $flightResult['stops'];
            $this->load->view('search-result',$data);
            
        }
        else 
        {
            $flight_search_result = false;
            $airlines = "";
            $stops = "";
        }

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
	

	
	
	
	function xml2array($contents, $get_attributes=1) {
		
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
	function agoda()
	{
			$url = 'http://ajaxsearch.partners.agoda.com/partners/partnersearch.aspx?CkInDay=09&CkInMonth=12&CkInYear=2013&CkOutDay=10&CkOutMonth=12&CkOutYear=2013&NumberOfRooms=1&NumberOfAdults=2&NumberOfChildren=0&CityCode=9395&CID=1610784';
redirect($url);

	}
	
	 public function getCredentialXml() 
    {
		
        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:webs="http://webs.europaeiske.dk">
			   <soapenv:Header/>
			   <soapenv:Body>
			      <webs:Login>
			         <webs:agencyId>' . $this->credentials['agencyId'] . '</webs:agencyId>
			         <webs:password>' . $this->credentials['password'] . '</webs:password>
			      </webs:Login>
			   </soapenv:Body>
			</soapenv:Envelope>';
        return $xml;
    }

	
		//redirect('home/GetChainTypes','refresh');
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
}
?>
