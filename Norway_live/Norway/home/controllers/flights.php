<?php
session_start();
ini_set("memory_limit",-1);
error_reporting(0);
class Flights extends CI_Controller {

	public function __construct()
    {
	    parent::__construct();
		$this->load->helper('cookie');
		$this->load->model('Home_Model');
		$this->load->model('Flights_Model');
		$this->load->library("pagination");
		//error_reporting(0);
	}
	function index()
	{
		$data['special_offers'] = $special_offers = $this->Home_Model->getspecialoffers();
		$data['nationality_codes'] = $this->Home_Model->get_nationality_codes();
		$this->load->view('flight/index',$data);		
	}
	function flight_load()
	{
		//echo '<pre>';print_r($this->input->post());exit;
		
		
				
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
				
				$this->session->set_userdata(array('fromcityval'=>$_POST['from_city'],'tocityval'=>$_POST['to_city'],'sd'=>$_POST['sd'],'ed'=>$_POST['ed'],'adults'=>$adult_count,'childs'=>$child_count,'infants'=>$infant_count,'journey_types'=>$_POST['journey_type'],'cabin_selected'=>$_POST['cabin']));
				
				     $api='amadeus';
					//echo $api;exit;
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
						//$this->load->view('flights/flight_load');
						}

		$this->load->view('flights/flight_load');
	}
	function search_flight()
	{
	        $sess_id = '';$SessionId = "";$SequenceNumber = "";$SecurityToken = "";$session_flag = "true";
        // ***** Retrieve Session Details for AMADEUS *****
        $sourceOffice = 'ODES12110';// ODES12110 for flight_hotel ODES128AB
        $result_query=$this->Flights_Model->get_amadeus_session_details($sourceOffice);
        
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
                            $this->Flights_Model->update_amadeus_session_details_start($time,$SequenceNumber,$SessionId,$sourceOffice);
                        } else {
                            $SessionId = $result_query[($no - 1)]->Session_Number;
                            $SequenceNumber = (($result_query[($no - 1)]->Sequence_Number) + 1);
                            $SecurityToken = (($result_query[($no - 1)]->Security_Token));
                            $sess_id = ($no - 1);
                            $Security_SignOut = '<?xml version="1.0" encoding="utf-8"?>
														<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
															<soapenv:Header>
																   <Session>
																		  <SessionId>'.$SessionId.'</SessionId>
																		  <SequenceNumber>'.$SequenceNumber.'</SequenceNumber>
																		  <SecurityToken>'.$SecurityToken.'</SecurityToken>
																	</Session>
															</soapenv:Header>
															<soapenv:Body>
																<Security_SignOut xmlns="http://xml.amadeus.com/VLSSOQ_04_1_1A">
																</Security_SignOut>
															</soapenv:Body>
														 </soapenv:Envelope>';

                            
                          
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
                            $this->Flights_Model->set_amadeus_session_details($SessionId,$sourceOffice);
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
                                $this->Flights_Model->update_amadeus_session_details_start($time,$SequenceNumber,$SessionId,$sourceOffice);
                                break;
                            } else {
                                $SessionId = $result_query[$s]->Session_Number;
                                $SequenceNumber = (($result_query[$s]->Sequence_Number) + 1);
                                $SecurityToken = (($result_query[$s]->Security_Token));
                                $sess_id = ($no - 1);
								$Security_SignOut = '<?xml version="1.0" encoding="utf-8"?>
															<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
																<soapenv:Header>
																	   <Session>
																			  <SessionId>' . $SessionId . '</SessionId>
																			  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																			  <SecurityToken>' . $SecurityToken . '</SecurityToken>
																		</Session>
																</soapenv:Header>
																<soapenv:Body>
																	<Security_SignOut xmlns="http://xml.amadeus.com/VLSSOQ_04_1_1A">
																	</Security_SignOut>
																</soapenv:Body>
															 </soapenv:Envelope>';

                              
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
                                $this->Flights_Model->set_amadeus_session_details($SessionId,$sourceOffice);
                                $session_flag = "true";
                            }
                        }
                    }
                }
            }
        }

        if ($session_flag == "true") {
            $Security_Auth = '<?xml version="1.0" encoding="utf-8"?>
							<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
							xmlns:vls="http://xml.amadeus.com/VLSSLQ_06_1_1A">
							<soapenv:Header></soapenv:Header>
								<soapenv:Body>
								<Security_Authenticate> 
								  <userIdentifier>
									<originIdentification>
									  <sourceOffice>ODES12110</sourceOffice>
									</originIdentification>
									<originatorTypeCode>U</originatorTypeCode>
									<originator>WSDREDBG</originator>
								  </userIdentifier>
								  <dutyCode>
									<dutyCodeDetails>
									  <referenceQualifier>DUT</referenceQualifier>
									  <referenceIdentifier>SU</referenceIdentifier>
									</dutyCodeDetails>
								  </dutyCode>
								  <systemDetails>
									<organizationDetails>
									  <organizationId>NMC-SCANDI</organizationId>
									</organizationDetails>
								  </systemDetails>
								  <passwordInfo>
									<dataLength>8</dataLength>
									<dataType>E</dataType>
									<binaryData>ZWRQZEdGcGo=</binaryData>
								  </passwordInfo>
								</Security_Authenticate>         
							  </soapenv:Body>
							</soapenv:Envelope>';

            
          
				$URL2 = "https://test.webservices.amadeus.com";
				// $URL2 = "https://production.webservices.amadeus.com";
				$soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/VLSSLQ_06_1_1A";
            

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
				$this->Flights_Model->insert_amadeus_session_details($time,$SequenceNumber,$SessionId,$SecurityToken,$sourceOffice);
            }
        }

        $adult_count = $_SESSION['adults'];
        $child_count = $_SESSION['childs'];
        $infant_count = $_SESSION['infants'];

        $from_city_code = "";$to_city_code = "";
        $Pcount = $_SESSION['adults'] + $_SESSION['childs'];
        $fromcity = $_SESSION['fromcityval'];
        $tocity = $_SESSION['tocityval'];
        $include_city = $_SESSION['include_city'];
        $exclude_city = $_SESSION['exclude_city'];
        $sd = $_SESSION['sd'];
        $ed = $_SESSION['ed'];
        $cabin = $_SESSION['cabin'];
        $cabin_type = $_SESSION['cabin_type'];
        $hours = $_SESSION['hours_connect_point'];
        $mins = $_SESSION['min_connect_point'];
        $daterange = $_SESSION['daterange'];
        $slice_dice = $_SESSION['slice_dice'];
        $nonstop = $_SESSION['nonstop'];
        $hours_time = $_SESSION['hours_time'];
        $mins_time = $_SESSION['mins_time'];
        $time_qualifier = $_SESSION['time_qualifier'];
        $time_interval = $_SESSION['time_interval'];
        $dradius = $_SESSION['dradius'];
        $aradius = $_SESSION['aradius'];
//echo '<pre>';print_r($_SESSION);exit;
        if ($nonstop == "nonstop") {
            $nonstop_code = "N";
        } else {
            $nonstop_code = "";
        }
		$cinval = explode("-", $sd);$cins = $cinval[2];$cins = substr($cins, -2);
        $cin = $cinval[0] . $cinval[1] . $cins;
		//echo 'ffbvc'.$cin;
        $coutval = explode("-", $ed);$couts = $coutval[2];$couts = substr($couts, -2);
        $cout = $coutval[0] . $coutval[1] . $couts;
		//echo 'vhvhj'.$cout;
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
													</Fare_MasterPricerTravelBoardSearch>
											</soapenv:Body>
										</soapenv:Envelope>';

                $request_stirng = "FMPTBQ_12_4_1A";
            } 
			else if ($_SESSION['journey_type'] == "OneWay") {
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
														</soapenv:Body>
													</soapenv:Envelope>';

                $request_stirng = "FMPCAQ_12_4_1A";
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
														</soapenv:Body>
													</soapenv:Envelope>';

                $request_stirng = "FMPCAQ_12_4_1A";
            }
            
         
				$URL2 = "https://test.webservices.amadeus.com";
				// $URL2 = "https://production.webservices.amadeus.com";
				$soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/" . $request_stirng;
		
            //echo '<pre/>';print_r($Fare_MasterPricerTravelBoardSearch) ;

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
            $error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
            curl_close($ch2);
            
			$fp = fopen('calendar.xml', 'a+');
            fwrite($fp, "Request:".$Fare_MasterPricerTravelBoardSearch."\n URL: ".$URL2."Soap Action :".$soapAction." \n------------------Response:".$dataforgetavail);
            fclose($fp);
            
            $fare_search_result = $this->xml2array($dataforgetavail);
             //echo '<pre/>Main Result of Flight as array:<br/>';print_r($fare_search_result)."<br/>";die;
            $count_flight_details = null;$count_val = null;

            if ($_SESSION['journey_type'] != "Calendar") {
                if (!isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerTravelBoardSearchReply']['errorMessage'])) {
                    if (isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerTravelBoardSearchReply']))
                        $data['flight_result'] = $fare_search_result['soap:Envelope']['soap:Body']['Fare_MasterPricerTravelBoardSearchReply'];
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
            $this->Flights_Model->update_amadeus_session_details($time,$SequenceNumber,$SessionId,$sourceOffice);
        }
		if ($_SESSION['journey_type'] == "Round" || ($_SESSION['journey_type'] == "Calendar")) {
			//echo '<pre>vvbvbbbb';print_r($data['flight_result']);exit;
			if (!empty($data['flight_result'])) 
			{
				//echo '<pre>';print_r($flight_result);
                $flight_result = $data['flight_result'];
                $currency = $flight_result['conversionRate']['conversionRateDetail']['currency']['value'];
				//Flight Details for OneWay
                if (!isset($flight_result['flightIndex'][0])) 
                {
                    $flight_details = $flight_result['flightIndex']['groupOfFlights'];
                    $count_flight_result = count($flight_details);
					for ($i = 0; $i < $count_flight_result; $i++) 
                    {
                        $count_flight_details = count($flight_details[$i]['flightDetails']);
                        $flightDetails[$i]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref']['value'];
                        $flightDetails[$i]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref']['value'];
                        if ($count_flight_details <= 1) 
                        {
                            $flightDetails[$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture']['value'];
                            $flightDetails[$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture']['value'];
                            $flightDetails[$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival']['value'];
                            $flightDetails[$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival']['value'];
                            $flightDetails[$i]['flightOrtrainNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightOrtrainNumber']['value'];
                            $flightDetails[$i]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier']['value'];
                            $flightDetails[$i]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier']['value'];
                            $flightDetails[$i]['locationIdDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][0]['locationId']['value'];
                            $flightDetails[$i]['locationIdArival'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][1]['locationId']['value'];
                            $flightDetails[$i]['equipmentType'] = $flight_details[$i]['flightDetails']['flightInformation']['productDetail']['equipmentType']['value'];
                            $flightDetails[$i]['electronicTicketing'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing']['value'];
                            $flightDetails[$i]['productDetailQualifier'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']['value'];
                        } 
                        else 
                        {
                            for ($j = 0; $j < $count_flight_details; $j++) 
                            {
                                $flightDetails[$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture']['value'];
                                $flightDetails[$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture']['value'];
                                $flightDetails[$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival']['value'];
                                $flightDetails[$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival']['value'];
                                $flightDetails[$i]['flightOrtrainNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightOrtrainNumber']['value'];
                                $flightDetails[$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier']['value'];
                                $flightDetails[$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier']['value'];
                                $flightDetails[$i]['locationIdDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][0]['locationId']['value'];
                                $flightDetails[$i]['locationIdArival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][1]['locationId']['value'];
                                $flightDetails[$i]['equipmentType'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType']['value'];
                                $flightDetails[$i]['electronicTicketing'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing']['value'];
                                $flightDetails[$i]['productDetailQualifier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']['value'];
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
							$flightDetails[$re]['return'][$i]['ref'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][0]['ref']['value'];
                            $flightDetails[$re]['return'][$i]['eft'] = $flight_details[$i]['propFlightGrDetail']['flightProposal'][1]['ref']['value'];
                            if(!isset($flight_details[$i]['flightDetails'][0]))
                            {
                                $flightDetails[$re]['return'][$i]['dateOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfDeparture']['value'];
                                $flightDetails[$re]['return'][$i]['timeOfDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfDeparture']['value'];
                                $flightDetails[$re]['return'][$i]['dateOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['dateOfArrival']['value'];
                                $flightDetails[$re]['return'][$i]['timeOfArrival'] = $flight_details[$i]['flightDetails']['flightInformation']['productDateTime']['timeOfArrival']['value'];
                                $flightDetails[$re]['return'][$i]['flightOrtrainNumber'] = $flight_details[$i]['flightDetails']['flightInformation']['flightOrtrainNumber']['value'];
                                $flightDetails[$re]['return'][$i]['marketingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['marketingCarrier']['value'];
                                $flightDetails[$re]['return'][$i]['operatingCarrier'] = $flight_details[$i]['flightDetails']['flightInformation']['companyId']['operatingCarrier']['value'];
                                $flightDetails[$re]['return'][$i]['locationIdDeparture'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][0]['locationId']['value'];
                                $flightDetails[$re]['return'][$i]['locationIdArival'] = $flight_details[$i]['flightDetails']['flightInformation']['location'][1]['locationId']['value'];
                                $flightDetails[$re]['return'][$i]['equipmentType'] = $flight_details[$i]['flightDetails']['flightInformation']['productDetail']['equipmentType']['value'];
                                $flightDetails[$re]['return'][$i]['electronicTicketing'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['electronicTicketing']['value'];
                                if (isset($flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']))
                                    $flightDetails[$re]['return'][$i]['productDetailQualifier'] = $flight_details[$i]['flightDetails']['flightInformation']['addProductDetail']['productDetailQualifier']['value'];
                                else
                                    $flightDetails[$re]['return'][$i]['productDetailQualifier'] = '';
                            }
                            else 
                            {
                                for ($j = 0; $j < $count_flight_details; $j++) 
                                {
                                    $flightDetails[$re]['return'][$i]['dateOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfDeparture']['value'];
                                    $flightDetails[$re]['return'][$i]['timeOfDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfDeparture']['value'];
                                    $flightDetails[$re]['return'][$i]['dateOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['dateOfArrival']['value'];
                                    $flightDetails[$re]['return'][$i]['timeOfArrival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDateTime']['timeOfArrival']['value'];
                                    $flightDetails[$re]['return'][$i]['flightOrtrainNumber'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['flightOrtrainNumber']['value'];
                                    $flightDetails[$re]['return'][$i]['marketingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['marketingCarrier']['value'];
                                    $flightDetails[$re]['return'][$i]['operatingCarrier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['companyId']['operatingCarrier']['value'];
                                    $flightDetails[$re]['return'][$i]['locationIdDeparture'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][0]['locationId']['value'];
                                    $flightDetails[$re]['return'][$i]['locationIdArival'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['location'][1]['locationId']['value'];
                                    $flightDetails[$re]['return'][$i]['equipmentType'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['productDetail']['equipmentType']['value'];
                                    $flightDetails[$re]['return'][$i]['electronicTicketing'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['electronicTicketing']['value'];
                                    if (isset($flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']))
                                        $flightDetails[$re]['return'][$i]['productDetailQualifier'][$j] = $flight_details[$i]['flightDetails'][$j]['flightInformation']['addProductDetail']['productDetailQualifier']['value'];
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
									$testing[$rt]['MultiTicket_type']=$s['itemNumber']['itemNumberId']['numberType']['value'];
									$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number']['value'];
								}
								else
								{
									$testing[$rt]['MultiTicket']="No";
									$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number']['value'];
								}
                                $testing[$rt]['segmentFlightRef']['refNumber'][$cr] = $s['segmentFlightRef']['referencingDetail'][$cr]['refNumber']['value'];
							}
						}
						else
						{	
							if(isset($s['itemNumber']['itemNumberId']['numberType']))
							{
								$testing[$rt]['MultiTicket']="Yes";
								$testing[$rt]['MultiTicket_type']=$s['itemNumber']['itemNumberId']['numberType']['value'];
								$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number']['value'];
							}
							else
							{
								$testing[$rt]['MultiTicket']="No";
								$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number']['value'];
							}
							$testing[$rt]['segmentFlightRef']['refNumber'] = $s['segmentFlightRef']['referencingDetail']['refNumber']['value'];
						}
							
                                $testing[$rt]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount']['value'];
                                $testing[$rt]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount']['value'];

                                if (!isset($s['paxFareProduct'][0])) {
                                    $testing[$rt]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc']['value'];
                                    $testing[$rt]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));

                                    if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
                                        $testing[$rt]['paxFareProduct']['count'] = "1";
                                        $testing[$rt]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref']['value'];
                                        if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
                                            $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator']['value'];
                                        } else {
                                            $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                        }
                                    } else {
                                        $testing[$rt]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
                                        $count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
                                        for ($p = 0; $p < $count_traveller; $p++) {
                                            $testing[$rt]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref']['value'];
                                            if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator']['value'];
                                            } else {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                            }
                                        }
                                    }

                                    $testing[$rt]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount']['value'];
                                    $testing[$rt]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount']['value'];

                                    $testing[$rt]['paxFareProduct']['description'] = "";
                                    if (!isset($s['paxFareProduct']['fare'][0])) {

                                        $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
                                        $testing[$rt]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];


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
                                            $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'][$e] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
                                            $testing[$rt]['paxFareProduct']['fare']['informationType'][$e] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

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
										$testing[$rt]['flight_mtk_ref']=$s['paxFareProduct']['fareDetails']['segmentRef']['segRef']['value'];
                                        if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
                                            $testing[$rt]['paxFareProduct']['fareDetails']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
                                            $testing[$rt]['paxFareProduct']['fareDetails']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
                                        } else {
                                            $count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
                                            for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                $testing[$rt]['paxFareProduct']['fareDetails']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd']['value'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']['value'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']['value'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint']['value'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType']['value'];
                                            }
                                        }
                                        //$testing[$rt]['paxFareProduct']['fareDetails']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                        // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                    } else {
                                        $count_fareDetails = (count($s['paxFareProduct']['fareDetails']));
                                        for ($fd = 0; $fd < $count_fareDetails; $fd++) {
                                            $testing[$rt]['flight_mtk_ref'][$fd]=$s['paxFareProduct']['fareDetails'][$fd]['segmentRef']['segRef']['value'];
                                            if (!isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][0])) {
                                                $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['rbd'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
                                                if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin']))
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
                                                else
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'] = '';
                                                if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
                                                else
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'] = '';
                                                $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint']['value'];
                                                $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['fareType'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
                                            }
                                            else {
                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']));
                                                for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['rbd'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd']['value'];
                                                    if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']))
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']['value'];
                                                    else
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'][$u] = '';
                                                    if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']['value'];
                                                    else
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'][$u] = '';
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['breakPoint'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['breakPoint']['value'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['fareType'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType']['value'];
                                                }
                                            }
                                            // $testing[$rt]['paxFareProduct']['fareDetails']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                            //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                        }
                                    }
                                }

                                else {
                                    $count_paxFareProduct = (count($s['paxFareProduct']));
                                    for ($d = 0; $d < $count_paxFareProduct; $d++) {
                                        $testing[$rt]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc']['value'];
                                        if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
                                            $testing[$rt]['paxFareProduct'][$d]['count'] = "1";
                                            $testing[$rt]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref']['value'];
                                            if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator']['value'];
                                            } else {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                            }
                                        } else {
                                            $testing[$rt]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                            $count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                            for ($p = 0; $p < $count_traveller; $p++) {
                                                $testing[$rt]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref']['value'];
                                            }
                                            if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator']['value'];
                                            } else {
                                                $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                            }
                                        }

                                        $testing[$rt]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount']['value'];
                                        $testing[$rt]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount']['value'];

                                        $testing[$rt]['paxFareProduct'][$d]['description'] = "";
                                        if (!isset($s['paxFareProduct'][$d]['fare'][0])) {
                                            $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
                                            $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

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
                                                $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'][$e] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
                                                $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'][$e] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

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
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
                                            } else {
                                                $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
                                                for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
                                                }
                                                //$testing[$rt]['paxFareProduct'][$d]['fareDetails']['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
                                                //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];		
                                            }
                                        } else {
                                            $count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
                                            for ($fd = 0; $fd < $count_fareDetails; $fd++) {
                                                $testing[$rt]['flight_mtk_ref'][$fd]=$s['paxFareProduct'][$d]['fareDetails'][$fd]['segmentRef']['segRef'];
                                                if (!isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][0])) {
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
                                                    if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
                                                    else
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = '';
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
                                                }
                                                else {
                                                    $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']);
                                                    for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
                                                        if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']))
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
                                                        else
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'][$g] = '';
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
                                                    }
                                                }
                                                //$testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];									
                                                //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];		
                                            }
                                        }
                                    }
                                }

                                if (isset($s['specificRecDetails'])) {
                                    if (isset($s['specificRecDetails'][0])) {
                                        $count_specificRecDetails = (count($s['specificRecDetails']));
                                        for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) {
                                            if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) {
                                                $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem']['refNumber'] = $s['refNumber'][$sdi]['specificRecItem']['refNumber']['value'];
                                                //if($testing[$n]['ref']==$s['specificRecDetails'][$sdi]['specificRecItem']['refNumber'])
                                                //{
                                                if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                    $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                    for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                    }
                                                } else {
                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                }
                                                //}
                                            } else {
                                                $count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
                                                for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
                                                    $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber'] = $s['refNumber'][$sdi]['specificRecItem'][$sif]['refNumber']['value'];
                                                    //if($testing[$n]['ref']==$s['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber'])
                                                    //{
                                                    if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                        $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                        for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                            $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                        }
                                                    } else {
                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                    }
                                                    //}
                                                }
                                            }
                                        }
                                    } else {
                                        if (!isset($s['specificRecDetails']['specificRecItem'][0])) {
                                            $testing[$rt]['specificRecDetails']['specificRecItem']['refNumber'] = $s['refNumber']['specificRecItem']['refNumber']['value'];
                                            //if($testing[$n]['ref']==$s['specificRecDetails']['specificRecItem']['refNumber'])
                                            //{
                                            if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                }
                                            } else {
                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                            }
                                            //}
                                        } else {
                                            $count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
                                            for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
                                                $testing[$rt]['specificRecDetails']['specificRecItem'][$sif]['refNumber'] = $s['refNumber']['specificRecItem'][$sif]['refNumber']['value'];
                                                //if($testing[$n]['ref']==$s['specificRecDetails']['specificRecItem'][$sif]['refNumber'])
                                                //{
                                                if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                    $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                    for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                    }
                                                } else {
                                                    $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
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
										$testing[$rt]['MultiTicket_type']=$s['itemNumber']['itemNumberId']['numberType']['value'];
										$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number']['value'];
									}
									else
									{
										$testing[$rt]['MultiTicket']="No";
										$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number']['value'];
									}
                                    $testing[$rt]['segmentFlightRef'][$c]['refNumber'][$cr] = $s['segmentFlightRef'][$c]['referencingDetail'][$cr]['refNumber']['value'];
                                   }
							   }
							   else
							   {
								    if(isset($s['itemNumber']['itemNumberId']['numberType']))
									{
										$testing[$rt]['MultiTicket']="Yes";
										$testing[$rt]['MultiTicket_type']=$s['itemNumber']['itemNumberId']['numberType']['value'];
										$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number']['value'];
									}
									else
									{
										$testing[$rt]['MultiTicket']="No";
										$testing[$rt]['MultiTicket_number']=$s['itemNumber']['itemNumberId']['number']['value'];
									}
								   $testing[$rt]['segmentFlightRef'][$c]['refNumber'] = $s['segmentFlightRef'][$c]['referencingDetail']['refNumber']['value'];
							   }
                                   
                                   
                                    $testing[$rt]['totalFareAmount'] = $s['recPriceInfo']['monetaryDetail'][0]['amount']['value'];
                                    $testing[$rt]['totalTaxAmount'] = $s['recPriceInfo']['monetaryDetail'][1]['amount']['value'];

                                    if (!isset($s['paxFareProduct'][0])) {
                                        $testing[$rt]['paxFareProduct']['ptc'] = $s['paxFareProduct']['paxReference']['ptc']['value'];
                                        ;
                                        $testing[$rt]['paxFareProduct']['count'] = count($s['paxFareProduct']['paxReference']['traveller']);

                                        if (!isset($s['paxFareProduct']['paxReference']['traveller'][0])) {
                                            $testing[$rt]['paxFareProduct']['count'] = "1";
                                            $testing[$rt]['paxFareProduct']['ref'] = $s['paxFareProduct']['paxReference']['traveller']['ref']['value'];
                                            if (isset($s['paxFareProduct']['paxReference']['traveller']['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller']['infantIndicator']['value'];
                                            } else {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                            }
                                        } else {
                                            $testing[$rt]['paxFareProduct']['count'] = (count($s['paxFareProduct']['paxReference']['traveller']));
                                            $count_traveller = (count($s['paxFareProduct']['paxReference']['traveller']));
                                            for ($p = 0; $p < $count_traveller; $p++) {
                                                $testing[$rt]['paxFareProduct']['ref'][$p] = $s['paxFareProduct']['paxReference']['traveller'][$p]['ref']['value'];
                                            }
                                            if (isset($s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = $s['paxFareProduct']['paxReference']['traveller'][$p]['infantIndicator']['value'];
                                            } else {
                                                $testing[$rt]['paxFareProduct']['infantIndicator'] = "";
                                            }
                                        }

                                        $testing[$rt]['paxFareProduct']['totalFareAmount'] = $s['paxFareProduct']['paxFareDetail']['totalFareAmount']['value'];
                                        $testing[$rt]['paxFareProduct']['totalTaxAmount'] = $s['paxFareProduct']['paxFareDetail']['totalTaxAmount']['value'];

                                        $testing[$rt]['paxFareProduct']['description'] = "";
                                        if (!isset($s['paxFareProduct']['fare'][0])) {

                                            $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
                                            $testing[$rt]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

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
                                                $testing[$rt]['paxFareProduct']['fare']['textSubjectQualifier'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
                                                $testing[$rt]['paxFareProduct']['fare']['informationType'] = $s['paxFareProduct']['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

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
                                             $testing[$rt]['flight_mtk_ref']=$s['paxFareProduct']['fareDetails']['segmentRef']['segRef']['value'];
                                            if (!isset($s['paxFareProduct']['fareDetails']['groupOfFares'][0])) {
                                                $testing[$rt]['paxFareProduct']['fareDetails']['rbd'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['cabin'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
                                                $testing[$rt]['paxFareProduct']['fareDetails']['fareType'] = $s['paxFareProduct']['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
                                            } else {
                                                $count_groupOfFares = (count($s['paxFareProduct']['fareDetails']['groupOfFares']));
                                                for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['rbd'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd']['value'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['cabin'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']['value'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['avlStatus'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']['value'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['breakPoint'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['breakPoint']['value'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails']['fareType'][$u] = $s['paxFareProduct']['fareDetails']['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType']['value'];
                                                }
                                            }
                                            //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                            //$testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails']['majCabin']['bookingClassDetails']['designator'];
                                        } else {
                                            $count_fareDetails = (count($s['paxFareProduct']['fareDetails']));
                                            for ($fd = 0; $fd < $count_fareDetails; $fd++) {
                                                 $testing[$rt]['flight_mtk_ref'][$fd]=$s['paxFareProduct']['fareDetails'][$fd]['segmentRef']['segRef'];
                                                if (!isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][0])) {
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['rbd'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
                                                    if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin']))
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
                                                    else
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'] = '';
                                                    if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
                                                    else
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'] = '';
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint']['value'];
                                                    $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['fareType'] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
                                                }
                                                else {
                                                    $count_groupOfFares = (count($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares']));
                                                    for ($u = 0; $u < $count_groupOfFares; $u++) {
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['rbd'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['rbd']['value'];
                                                        if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']))
                                                            $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['cabin']['value'];
                                                        else
                                                            $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['cabin'][$u] = '';
                                                        if (isset($s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']))
                                                            $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['cabinProduct']['avlStatus']['value'];
                                                        else
                                                            $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['avlStatus'][$u] = '';

                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['breakPoint'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['breakPoint']['value'];
                                                        $testing[$rt]['paxFareProduct']['fareDetails'][$fd]['fareType'][$u] = $s['paxFareProduct']['fareDetails'][$fd]['groupOfFares'][$u]['productInformation']['fareProductDetail']['fareType']['value'];
                                                    }
                                                }
                                                // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                                // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                            }
                                        }
                                    }
                                    else {
                                        $count_paxFareProduct = (count($s['paxFareProduct']));
                                        for ($d = 0; $d < $count_paxFareProduct; $d++) {
                                            $testing[$rt]['paxFareProduct'][$d]['ptc'] = $s['paxFareProduct'][$d]['paxReference']['ptc']['value'];
                                            if (!isset($s['paxFareProduct'][$d]['paxReference']['traveller'][0])) {
                                                $testing[$rt]['paxFareProduct'][$d]['count'] = "1";
                                                $testing[$rt]['paxFareProduct'][$d]['ref'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['ref']['value'];
                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator'])) {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller']['infantIndicator']['value'];
                                                } else {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                }
                                            } else {
                                                $testing[$rt]['paxFareProduct'][$d]['count'] = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                $count_traveller = (count($s['paxFareProduct'][$d]['paxReference']['traveller']));
                                                for ($p = 0; $p < $count_traveller; $p++) {
                                                    $testing[$rt]['paxFareProduct'][$d]['ref'][$p] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['ref']['value'];
                                                }
                                                if (isset($s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator'])) {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = $s['paxFareProduct'][$d]['paxReference']['traveller'][$p]['infantIndicator']['value'];
                                                } else {
                                                    $testing[$rt]['paxFareProduct'][$d]['infantIndicator'] = "";
                                                }
                                            }

                                            $testing[$rt]['paxFareProduct'][$d]['totalFareAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalFareAmount']['value'];
                                            $testing[$rt]['paxFareProduct'][$d]['totalTaxAmount'] = $s['paxFareProduct'][$d]['paxFareDetail']['totalTaxAmount']['value'];

                                            $testing[$rt]['paxFareProduct'][$d]['description'] = "";
                                            if (!isset($s['paxFareProduct'][$d]['fare'][0])) {

                                                $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
                                                $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare']['pricingMessage']['freeTextQualification']['informationType']['value'];

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
                                                    $testing[$rt]['paxFareProduct'][$d]['fare']['textSubjectQualifier'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['textSubjectQualifier']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fare']['informationType'] = $s['paxFareProduct'][$d]['fare'][$e]['pricingMessage']['freeTextQualification']['informationType']['value'];

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
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['breakPoint']['value'];
                                                    $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
                                                } else {
                                                    $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails']['groupOfFares']);
                                                    for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails']['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails']['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
                                                    }
                                                }
                                                //$testing[$rt]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];									
                                                // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
                                            } else {
                                                $count_fareDetails = (count($s['paxFareProduct'][$d]['fareDetails']));
                                                for ($fd = 0; $fd < $count_fareDetails; $fd++) {
                                                     $testing[$rt]['flight_mtk_ref'][$fd]=$s['paxFareProduct'][$d]['fareDetails'][$fd]['segmentRef']['segRef']['value'];
                                                    if (!isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][0])) {
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['rbd']['value'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['cabin']['value'];
                                                        if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']))
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['cabinProduct']['avlStatus']['value'];
                                                        else
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'] = '';
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['breakPoint']['value'];
                                                        $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']['productInformation']['fareProductDetail']['fareType']['value'];
                                                    }
                                                    else {
                                                        $count_groupOfFares = count($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares']);
                                                        for ($g = 0; $g < $count_groupOfFares; $g++) {
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['rbd'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['rbd']['value'];
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['cabin'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['cabin']['value'];
                                                            if (isset($s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']))
                                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['cabinProduct']['avlStatus']['value'];
                                                            else
                                                                $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['avlStatus'][$g] = '';
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['breakPoint'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['breakPoint']['value'];
                                                            $testing[$rt]['paxFareProduct'][$d]['fareDetails'][$fd]['fareType'][$g] = $s['paxFareProduct'][$d]['fareDetails'][$fd]['groupOfFares'][$g]['productInformation']['fareProductDetail']['fareType']['value'];
                                                        }
                                                    }
                                                    //$testing[$rt]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];									
                                                    // $testing[$rt]['paxFareProduct']['designator']=$s['paxFareProduct'][$d]['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];									
                                                }
                                            }
                                        }
                                    }

                                    if (isset($s['specificRecDetails'])) {
                                        if (isset($s['specificRecDetails'][0])) {
                                            $count_specificRecDetails = (count($s['specificRecDetails']));
                                            for ($sdi = 0; $sdi < $count_specificRecDetails; $sdi++) {
                                                if (!isset($s['specificRecDetails'][$sdi]['specificRecItem'][0])) {
                                                    $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem']['refNumber'] = $s['specificRecDetails'][$sdi]['specificRecItem']['refNumber']['value'];
                                                    if (!isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][0])) {
                                                        if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                            $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                            for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef']['value'];
                                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                            }
                                                        } else {
                                                            $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['requestedSegmentInfo']['segRef']['value'];
                                                            $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                        }
                                                    } else {
                                                        $count_fareContextDetails = (($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']));
                                                        for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) {
                                                            if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                                $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                    $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef']['value'];
                                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                                }
                                                            } else {
                                                                $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef']['value'];
                                                                $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $count_specificRecItem = (count($s['specificRecDetails'][$sdi]['specificRecItem']));
                                                    for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
                                                        $testing[$rt]['specificRecDetails'][$sdi]['specificRecItem'][$sif]['refNumber'] = $s['refNumber'][$sdi]['specificRecItem'][$sif]['refNumber']['value'];
                                                        if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                            if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                                $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                                }
                                                            } else {
                                                                $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                            }
                                                        } else {
                                                            $count_fareContextDetails = (($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']));
                                                            for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) {
                                                                if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                                    $count_cnxContextDetails = (count($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                                    for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                        $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef']['value'];
                                                                        $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                                    }
                                                                } else {
                                                                    $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef']['value'];
                                                                    $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            if (!isset($s['specificRecDetails']['specificRecItem'][0])) {
                                                $testing[$rt]['specificRecDetails']['specificRecItem']['refNumber'] = $s['specificRecDetails']['specificRecItem']['refNumber']['value'];
                                                if (!isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails'])) {
                                                    if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                        $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                        for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                            $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                        }
                                                    } else {
                                                        $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                    }
                                                } else {
                                                    $count_fareContextDetails = (($s['specificRecDetails']['specificProductDetails']['fareContextDetails']));
                                                    for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) {
                                                        if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                            $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                            for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {

                                                                $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef']['value'];
                                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                            }
                                                        } else {
                                                            $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef']['value'];
                                                            $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                        }
                                                    }
                                                }
                                            } else {
                                                $count_specificRecItem = (count($s['specificRecDetails']['specificRecItem']));
                                                for ($sif = 0; $sif < $count_specificRecItem; $sif++) {
                                                    $testing[$rt]['specificRecDetails']['specificRecItem'][$sif]['refNumber'] = $s['refNumber']['specificRecItem'][$sif]['refNumber']['value'];
                                                    if (!isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails'][0])) {
                                                        if (isset($s['specificRecDetails'][$sdi]['specificProductDetails']['fareContextDetails']['cnxContextDetails'][0])) {
                                                            $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']));
                                                            for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                            }
                                                        } else {
                                                            $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails']['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                        }
                                                    } else {
                                                        $count_fareContextDetails = (($s['specificRecDetails']['specificProductDetails']['fareContextDetails']));
                                                        for ($fcfd = 0; $fcfd < $count_fareContextDetails; $fcfd++) {
                                                            if (isset($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][0])) {
                                                                $count_cnxContextDetails = (count($s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']));
                                                                for ($ccd = 0; $ccd < $count_cnxContextDetails; $ccd++) {
                                                                    $testing[$rt]['requestedSegmentInfo'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['requestedSegmentInfo']['segRef']['value'];
                                                                    $testing[$rt]['availabilityCnxType'][$ccd] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails'][$ccd]['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
                                                                }
                                                            } else {
                                                                $testing[$rt]['requestedSegmentInfo'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['requestedSegmentInfo']['segRef']['value'];
                                                                $testing[$rt]['availabilityCnxType'] = $s['specificRecDetails']['specificProductDetails']['fareContextDetails'][$fcfd]['cnxContextDetails']['fareCnxInfo']['contextDetails']['availabilityCnxType']['value'];
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
               //echo '<pre/><br />Recomm:<br/> ';print_r($testing);exit;
                if (isset($flightDetails[0])) 
                {
                    $count_oneway = (count($flightDetails[0]['return']));
                    $count_return = (count($flightDetails[1]['return']));
                    $count_recomm = (count($testing));
                    //echo "oneway: ".$count_oneway."Return: ".$count_return."Recom: ".$count_recomm."<br/>";
                    $oneway = ($flightDetails[0]['return']);
                    $return = ($flightDetails[1]['return']);
                    // echo '<pre/><br/>OneWay:<br/> ';print_r($oneway);exit;
                    // echo '<pre/><br/>Return:<br/> ';print_r($return);exit;
                    // echo '<pre/><br/>Recomm:<br/> ';print_r($testing);exit;
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
											// if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber']))) 
											if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($testing[$rc]['flight_mtk_ref']=="1"))) 
											{
												$final_result[$no]['flag'] = "One";
												$final_result[$no]['oneWay'] = $oneway[$o];
												$final_result[$no]['Recomm'][0] = $testing[$rc];
												// echo '<pre/>'.$rc." ".$no;print_r($final_result);
												
											}
											// if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber']))) 
											if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef']['refNumber'])) && (($testing[$rc]['flight_mtk_ref']=="2")))  
											{
												$combination = $oneway[$o]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'] . " , " . $return[$r]['ref'] . " = " . $testing[$rc]['segmentFlightRef']['refNumber'];
												$final_result[$no]['combination'] = $combination;
												$final_result[$no]['Return'] = $return[$r];
												$final_result[$no]['MultiTicket'] = $testing[$rc]['MultiTicket'];
												$final_result[$no]['Recomm'][1] = $testing[$rc];
												// echo '<pre/>'.$rc." ".$no;print_r($final_result);exit;
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
												//echo '<pre/>';print_r($testing[$rc]);exit;
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
													// if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][1]))) 
													if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0])) && (($testing[$rc]['flight_mtk_ref']=="1")))  
													{
														$final_result[$no]['flag'] = "Multiple";
														$final_result[$no]['SegmentNo'] = $cs;
														$final_result[$no]['oneWay'] = $oneway[$o];
														$final_result[$no]['Recomm'][0] = $testing[$rc];
														
													}
													// if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][0])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'][1]))) 
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
												// if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber']))) 
												if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'])) && (($testing[$rc]['flight_mtk_ref']=="1")))  
												{
													$final_result[$no]['flag'] = "Multiple";
													$final_result[$no]['SegmentNo'] = $cs;
													$final_result[$no]['oneWay'] = $oneway[$o];
													$final_result[$no]['Recomm'][0] = $testing[$rc];
												}
												// if ((($oneway[$o]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber'])) && (($return[$r]['ref']) == ($testing[$rc]['segmentFlightRef'][$cs]['refNumber']))) 
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

               //echo '<pre/><br/>Final Resusult:<br/> ';print_r($final_result);exit;
                $data['flight_result'] = $final_result;
                $data['currency'] = $currency;
            } else {
                $data['flight_result'] = '';
                $data['currency'] = '';
            }
        } 
        else if (($_SESSION['journey_type'] == "OneWay")) {
			//echo 'hhhh';
            if (!empty($data['flight_result'])) {
                $flight_result = $data['flight_result'];
                $currency = $flight_result['conversionRate']['conversionRateDetail']['currency'];


                if (!isset($flight_result['flightIndex'][0])) {
					//echo 'hjsdghfjs';exit;
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
                            //echo "Loop ".$i." : ".$count_flight_details."<br/>";

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
                                //echo "Loop ".$i." : ".$count_flight_details."<br/>";

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
                //echo '<pre/>';print_r($flight_recommendation);exit;
                if(isset($flight_result['recommendation'][0])){
					
					$flight_recommendation = $flight_result['recommendation'];}
				else{
					$flight_recommendation[0] = $flight_result['recommendation'];}
					//
               $count_recommendation = count($flight_recommendation);
			   $count_testing = count($testing);
			   //echo '<pre>';print_r($count_testing);exit;
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
										//echo $n.": ".$testing[$n]['totalFareAmount']." ".$testing[$n]['totalFareAmount']."<br/>";
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
											//echo "<br/>".$count_paxFareProduct." ";
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
													//echo "count_fareDetails :".$count_fareDetails;
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
												// $testing[$n]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];									
												//$testing[$n]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];		
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

										//if((count($s['paxFareProduct']['paxReference']['traveller'])) == count(($s['paxFareProduct']['paxReference']['traveller']), COUNT_RECURSIVE))
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
											// $testing[$n]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];									
											// $testing[$n]['designator']=$s['paxFareProduct'][$d]['fareDetails'][$cfd]['majCabin']['bookingClassDetails']['designator'];		
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
													//$testing[$n]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
													//$testing[$n]['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
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
           // echo '<pre/>Test_Slice and Dice';print_r($data['flight_result']);exit;
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
                            //echo "Loop ".$i." : ".$count_flight_details."<br/>";

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
                                //echo "Loop ".$i." : ".$count_flight_details."<br/>";

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
                
              //  echo '<pre/>';print_r($testing);exit;
                
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
                            //echo "count_testing: ".$count_testing."<br/>";
                            for ($ni = 0; $ni < $count_testing; $ni++) {
                                $count_testing_segment = count($testing[$ni]);
                                //echo $count_testing_segment."  ";
                                for ($n = 0; $n < $count_testing_segment; $n++) {
                                    if (isset($s['segmentFlightRef']['referencingDetail'][0])) {
                                        $count_referencingDetail = (count($s['segmentFlightRef']['referencingDetail']));
                                        //echo "dfsaf: ".$count_referencingDetail;exit;
                                        for ($crd = 0; $crd < $count_referencingDetail; $crd++) {
                                            if ($ni == $crd) {
                                                if ($testing[$ni][$n]['ref'] == $s['segmentFlightRef']['referencingDetail'][$crd]['refNumber']) {
                                                    $segflightFinal[$i][$c][$crd] = $testing[$ni][$n];
                                                    //echo "Ni ".$ni."N: ".$n."C : ".$c.">*-*< Crd : ".$crd." <br/>";
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
                                                            //for($fd=0;$fd<$count_fareDetails;$fd++)  
                                                            //{
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
                                                        // $segflightFinal[$i][$c][$crd]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                                        //$segflightFinal[$i][$c][$crd]['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
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
                                                            //$segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
                                                            //$segflightFinal[$i][$c][$crd]['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
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
                            //echo "count_testing: ".$count_testing."<br/>";
                            for ($ni = 0; $ni < $count_testing; $ni++) {
                                $count_testing_segment = count($testing[$ni]);
                                //echo $count_testing_segment."  ";
                                for ($n = 0; $n < $count_testing_segment; $n++) {
                                    if (isset($s['segmentFlightRef'][$c]['referencingDetail'][0])) {
                                        $count_referencingDetail = (count($s['segmentFlightRef'][$c]['referencingDetail']));
                                        //echo "dfsaf: ".$count_referencingDetail;exit;
                                        for ($crd = 0; $crd < $count_referencingDetail; $crd++) {
                                            if ($ni == $crd) {
                                                if ($testing[$ni][$n]['ref'] == $s['segmentFlightRef'][$c]['referencingDetail'][$crd]['refNumber']) {
                                                    $segflightFinal[$i][$c][$crd] = $testing[$ni][$n];
                                                    //echo "Ni ".$ni."N: ".$n."C : ".$c.">*-*< Crd : ".$crd." <br/>";
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
                                                            //for($fd=0;$fd<$count_fareDetails;$fd++)  
                                                            //{
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
                                                        // $segflightFinal[$i][$c][$crd]['paxFareProduct']['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
                                                        //$segflightFinal[$i][$c][$crd]['designator']=$s['paxFareProduct']['fareDetails'][$fd]['majCabin']['bookingClassDetails']['designator'];
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
                                                            //$segflightFinal[$i][$c][$crd]['paxFareProduct'][$d]['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
                                                            //$segflightFinal[$i][$c][$crd]['designator']=$s['paxFareProduct'][$d]['fareDetails']['majCabin']['bookingClassDetails']['designator'];									
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
            $this->fetch_flight_search_result($data);
        } else if ($_SESSION['journey_type'] == "Round") {
            $this->fetch_flight_search_result_Round_Trip($data);
        } else if ($_SESSION['journey_type'] == "Calendar") {
            $this->fetch_flight_search_result_Round_Trip_Calendar($data);
        } 
    }
	
	
	
	
	function search_flight_bkp(){
		//echo '<pre>';print_r($this->session->userdata);exit;
		$mode = $this->session->userdata('mode');
		$departure = $this->session->userdata('flight_departure');
		$arrival = $this->session->userdata('flight_arrival');
		
   $adult_count = $this->session->userdata('adult_count');
   $child_count = $this->session->userdata('child_count');
   $infant_count = $this->session->userdata('infant_count');
   $flight_class = $this->session->userdata('flight_class');
   
   $flight_sd = $this->session->userdata('flight_sd');
   $flight_ed = $this->session->userdata('flight_ed');
   
  
   
		$fsd = explode('/',$flight_sd);
		$sd = $fsd[2].'-'.$fsd[1].'-'.$fsd[0];
		
		
		if($flight_ed != ''){ // oneway
			
		   $fed = explode('/',$flight_ed);
		   $ed = $fed[2].'-'.$fed[1].'-'.$fed[0];
	    }
	    else { //return trip
				$fed = explode('/',$flight_sd);
				$next_day = $fed[0]+1 ;
				$ed = $fed[2].'-'.$fed[1].'-'.$next_day;
			}
		
		
		$this->session->set_userdata(array('sd'=>$sd,'ed'=>$ed));
		$flight_sd = $this->session->userdata('sd');
		$flight_ed = $this->session->userdata('ed');
		//echo '<pre>';print_r($this->session->userdata);exit;
 	   //echo $orig_departure;exit;  
 	
 	if($mode == 'O'){
		//echo 1;
  $xml = 
'<AirSearchRQ>
 <AirOriginDestinations>
  <AirOriginDestination>
    <DepartureAirport>'.trim($departure).'</DepartureAirport>
    <ArrivalAirport>'.trim($arrival).'</ArrivalAirport>
    <DepartureDate>'.trim($flight_sd).'</DepartureDate>
    <DepartureTime></DepartureTime>
  </AirOriginDestination>
 
 </AirOriginDestinations>
 <AirPassengerQuantities>
   <PassengerTypeQuantity Code="ADT" Quantity="'.$adult_count.'"/>
   <PassengerTypeQuantity Code="CHD" Quantity="'.$child_count.'"/>
   <PassengerTypeQuantity Code="INF" Quantity="'.$infant_count.'"/>
 </AirPassengerQuantities>
 <AirSearchPreferences>
 <MinSeatingClass>'.$flight_class.'</MinSeatingClass>
 </AirSearchPreferences>
 </AirSearchRQ>';	
 }else{
	// echo 2;
	  $xml = 
'<AirSearchRQ>
 <AirOriginDestinations>
  <AirOriginDestination>
    <DepartureAirport>'.trim($departure).'</DepartureAirport>
    <ArrivalAirport>'.trim($arrival).'</ArrivalAirport>
    <DepartureDate>'.trim($flight_sd).'</DepartureDate>
    <DepartureTime></DepartureTime>
  </AirOriginDestination>
  <AirOriginDestination>
    <DepartureAirport>'.trim($arrival).'</DepartureAirport>
    <ArrivalAirport>'.trim($departure).'</ArrivalAirport>
    <DepartureDate>'.trim($flight_ed).'</DepartureDate>
    <DepartureTime></DepartureTime>
  </AirOriginDestination>
 </AirOriginDestinations>
 <AirPassengerQuantities>
   <PassengerTypeQuantity Code="ADT" Quantity="'.$adult_count.'"/>
   <PassengerTypeQuantity Code="CHD" Quantity="'.$child_count.'"/>
   <PassengerTypeQuantity Code="INF" Quantity="'.$infant_count.'"/>
 </AirPassengerQuantities>
 <AirSearchPreferences>
 <MinSeatingClass>'.$flight_class.'</MinSeatingClass>
 </AirSearchPreferences>
 </AirSearchRQ>';	
	 }
 
 echo $xml;exit;
 
 	if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.108'){
	
	$user_id = "10172";
	$password = "Travelapi@123";
	//$url = "https://test.sastiticket.com/websvc";
	$url = 'https://test.sastiticket.com/websvc/AirSearchServiceV1?';
	
	
 }
else{
	
	$user_id = "10172";
	$password = "Travelapi@123";
	//$url = "https://test.sastiticket.com/websvc";
	$url = 'https://test.sastiticket.com/websvc/AirSearchServiceV1?';
}
$xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns="http://webservice.zillious.com/ns/V1">
	<soapenv:Header>
		<wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" soapenv:mustUnderstand="1">
			<wsse:UsernameToken xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" wsu:Id="UsernameToken-25616143">
				<wsse:Username>'.$user_id.'</wsse:Username>
				<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$password.'</wsse:Password>
			</wsse:UsernameToken>
		</wsse:Security>
	</soapenv:Header>
				<soapenv:Body>'.
				$xml
				.'</soapenv:Body>
				</soapenv:Envelope>'; 
								
	//echo $xml_request ;exit;
		//$soap_url = 'https://test.sastiticket.com/websvc/AirSearchServiceV1';
			//echo 123;
			
		$ch2=curl_init();
		curl_setopt($ch2, CURLOPT_URL, $url);
		curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
		curl_setopt($ch2, CURLOPT_HEADER, 0);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch2, CURLOPT_POST, 1);
		curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml_request);
		curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
		curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, FALSE);
		$httpHeader2 = array("SOAPAction: AirSearch","Content-Type: text/xml; charset=UTF-8","Content-Encoding: UTF-8");
		curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
		curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
		$data2=curl_exec($ch2);
		
		/*
		$xml = new DOMDocument();
			$xml->loadXML($data2);
			$main  = $xml->getElementsByTagName('soapenv:Envelope');
			echo '<pre>';print_r($main);exit;*/
			
	
		 echo '<pre>';print_r($data2);exit;
		 $array =$this->xml2array($data2);
			//echo '<pre>';print_r($array);exit;
		 
		 $flight_session = $this->session->userdata('flight_session');
         $this->Flights_Model->delete_flight_results($flight_session);
        
		 
		 if(isset($array['soapenv:Envelope']))
		 {
			 if(is_array($array['soapenv:Envelope']['soapenv:Body']['ns1:AirSearchRS']['ns1:PricedItineraries']))
			 {
				 $SearchFormData = $array['soapenv:Envelope']['soapenv:Body']['ns1:AirSearchRS']['ns1:SearchFormData']['value'];
				 
				 $PricedItinerary = $array['soapenv:Envelope']['soapenv:Body']['ns1:AirSearchRS']['ns1:PricedItineraries']['ns1:PricedItinerary'];
		          	//echo '<pre>';print_r($PricedItinerary);exit;
				  if(is_array($PricedItinerary))
				  {
					  foreach($PricedItinerary as $pItinerary)
					  {
						  // There are 3 sections as follows
						 $AirItinerary            = $pItinerary['ns1:AirItinerary'];			//  1
						 $AirItineraryPricingInfo = $pItinerary['ns1:AirItineraryPricingInfo'];	//	2
						 $ItineraryPricingInfo    = $pItinerary['ns1:ItineraryPricingInfo'];	//	3
						 
						 $ItineraryCurrency = $ItineraryPricingInfo['attr']['Currency'];
						 $ItinTotalFare = $ItineraryPricingInfo['ns1:ItinTotalFare']['value'];
						 $ItinServiceTax = $ItineraryPricingInfo['ns1:ItinServiceTax']['value'];
						 $ItinCommission = $ItineraryPricingInfo['ns1:ItinCommission']['value'];
						 
						 
						 $AirItineraryCurrency = $AirItineraryPricingInfo['attr']['Currency'];
						 $AirItinTotalFare  = $AirItineraryPricingInfo['ns1:AirItinTotalFare']['value'];
						 $AirItinBaseFare  = $AirItineraryPricingInfo['ns1:AirItinBaseFare']['value'];
						 $AirItinCommission  = $AirItineraryPricingInfo['ns1:AirItinCommission']['value'];
							
						if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][0]) && $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][0] != '')
						{
						 $AdultPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][0];
						 if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][1]))
						 {
						  $ChildtPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][1];
						 }
						 if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][2]))
						 {
						 $InfantPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][2];
						 }
						 $AdultCode = $AdultPricingInfo['attr']['Code'];
						 $AdultCount = $AdultPricingInfo['attr']['Quantity'];
						 $AdultTotalFare = $AdultPricingInfo['ns1:TotalFare']['value'];
						 $AdultBaseFare = $AdultPricingInfo['ns1:BaseFare']['value'];
						 $AdultTransactionFee = $AdultPricingInfo['ns1:TransactionFee']['value'];
						 $AdultBookingFee = $AdultPricingInfo['ns1:BookingFee']['value'];
						 $AdultServiceTax = $AdultPricingInfo['ns1:ServiceTax']['value'];
						 
						 $AdultAirTaxes = $AdultPricingInfo ['ns1:AirTaxes']['ns1:Tax'];
						 
						 $AdultAirTaxesYQ = $AdultAirTaxes[0]['attr'];
						 $AdultAirTaxesYQ_Amount = $AdultAirTaxesYQ['Amount'];
						 $AdultAirTaxesYQ_Code = $AdultAirTaxesYQ['Code'];
						 
						 $AdultAirTaxesWO = $AdultAirTaxes[1]['attr'];
						 $AdultAirTaxesWO_Amount = $AdultAirTaxesWO['Amount'];
						 $AdultAirTaxesWO_Code = $AdultAirTaxesWO['Code'];
						 
						 $AdultAirTaxesIN = $AdultAirTaxes[2]['attr'];
						 $AdultAirTaxesIN_Amount = $AdultAirTaxesIN['Amount'];
						 $AdultAirTaxesIN_Code = $AdultAirTaxesIN['Code'];
						 
						 $AdultAirTaxesJN = $AdultAirTaxes[3]['attr'];
						 $AdultAirTaxesJN_Amount = $AdultAirTaxesJN['Amount'];
						 $AdultAirTaxesJN_Code = $AdultAirTaxesJN['Code'];
						 
						 $AdultAirTaxesYR = $AdultAirTaxes[4]['attr'];
						 $AdultAirTaxesYR_Amount = $AdultAirTaxesYR['Amount'];
						 $AdultAirTaxesYR_Code = $AdultAirTaxesYR['Code'];
						 
						 $ChildCode = '';
						 $ChildCount = '';
						 $ChildTotalFare = '';
						 $ChildBaseFare = '';
						 $ChildTransactionFee = '';
						 $ChildBookingFee = '';
						 $ChildServiceTax = '';
						 
						 $ChildAirTaxes = '';
						 
						 $ChildAirTaxesYQ = '';
						 $ChildAirTaxesYQ_Amount = '';
						 $ChildAirTaxesYQ_Code = '';
						 
						 $ChildAirTaxesWO = '';
						 $ChildAirTaxesWO_Amount = '';
						 $ChildAirTaxesWO_Code = '';
						 
						 $ChildAirTaxesIN = '';
						 $ChildAirTaxesIN_Amount = '';
						 $ChildAirTaxesIN_Code = '';
						 
						 $ChildAirTaxesJN = '';
						 $ChildAirTaxesJN_Amount = '';
						 $ChildAirTaxesJN_Code = '';
						 
						 $ChildAirTaxesYR = '';
						 $ChildAirTaxesYR_Amount = '';
						 $ChildAirTaxesYR_Code = '';
						 
						 $InfantCode = '';
						 $InfantCount = '';
						 $InfantTotalFare = '';
						 $InfantBaseFare = '';
						 $InfantTransactionFee = '';
						 $InfantBookingFee = '';
						 $InfantServiceTax = '';
						 
						 $InfantAirTaxes = '';
						 
						 $InfantAirTaxesYQ = '';
						 $InfantAirTaxesYQ_Amount = '';
						 $InfantAirTaxesYQ_Code = '';
						 
						 $InfantAirTaxesWO = '';
						 $InfantAirTaxesWO_Amount = '';
						 $InfantAirTaxesWO_Code = '';
						 
						 $InfantAirTaxesIN = '';
						 $InfantAirTaxesIN_Amount = '';
						 $InfantAirTaxesIN_Code = '';
						 
						 $InfantAirTaxesJN = '';
						 $InfantAirTaxesJN_Amount = '';
						 $InfantAirTaxesJN_Code = '';
						 
						 $InfantAirTaxesYR = '';
						 $InfantAirTaxesYR_Amount = '';
						 $InfantAirTaxesYR_Code = ''; 
						 
						 if(isset($ChildtPricingInfo) && $ChildtPricingInfo !='')
						 {
						 $ChildCode = $ChildtPricingInfo['attr']['Code'];
						 $ChildCount = $ChildtPricingInfo['attr']['Quantity'];
						 $ChildTotalFare = $ChildtPricingInfo['ns1:TotalFare']['value'];
						 $ChildBaseFare = $ChildtPricingInfo['ns1:BaseFare']['value'];
						 $ChildTransactionFee = $ChildtPricingInfo['ns1:TransactionFee']['value'];
						 $ChildBookingFee = $ChildtPricingInfo['ns1:BookingFee']['value'];
						 $ChildServiceTax = $ChildtPricingInfo['ns1:ServiceTax']['value'];
						 
						 $ChildAirTaxes = $ChildtPricingInfo['ns1:AirTaxes']['ns1:Tax'];
						 
						 $ChildAirTaxesYQ = $ChildAirTaxes[0]['attr'];
						 $ChildAirTaxesYQ_Amount = $ChildAirTaxesYQ['Amount'];
						 $ChildAirTaxesYQ_Code = $ChildAirTaxesYQ['Code'];
						 
						 $ChildAirTaxesWO = $ChildAirTaxes[1]['attr'];
						 $ChildAirTaxesWO_Amount = $ChildAirTaxesWO['Amount'];
						 $ChildAirTaxesWO_Code = $ChildAirTaxesWO['Code'];
						 
						 $ChildAirTaxesIN = $ChildAirTaxes[2]['attr'];
						 $ChildAirTaxesIN_Amount = $ChildAirTaxesIN['Amount'];
						 $ChildAirTaxesIN_Code = $ChildAirTaxesIN['Code'];
						 
						 $ChildAirTaxesJN = $ChildAirTaxes[3]['attr'];
						 $ChildAirTaxesJN_Amount = $ChildAirTaxesJN['Amount'];
						 $ChildAirTaxesJN_Code = $ChildAirTaxesJN['Code'];
						 
						 $ChildAirTaxesYR = $ChildAirTaxes[4]['attr'];
						 $ChildAirTaxesYR_Amount = $ChildAirTaxesYR['Amount'];
						 $ChildAirTaxesYR_Code = $ChildAirTaxesYR['Code']; 
						 
						 }
						 
						 if(isset($InfantPricingInfo) && $InfantPricingInfo !='' )
						 {
						 $InfantCode = $InfantPricingInfo['attr']['Code'];
						 $InfantCount = $InfantPricingInfo['attr']['Quantity'];
						 $InfantTotalFare = $InfantPricingInfo['ns1:TotalFare']['value'];
						 $InfantBaseFare = $InfantPricingInfo['ns1:BaseFare']['value'];
						 $InfantTransactionFee = $InfantPricingInfo['ns1:TransactionFee']['value'];
						 $InfantBookingFee = $InfantPricingInfo['ns1:BookingFee']['value'];
						 $InfantServiceTax = $InfantPricingInfo['ns1:ServiceTax']['value'];
						 
						 $InfantAirTaxes = $InfantPricingInfo['ns1:AirTaxes']['ns1:Tax'];
						 
						 $InfantAirTaxesYQ = $InfantAirTaxes[0]['attr'];
						 $InfantAirTaxesYQ_Amount = $InfantAirTaxesYQ['Amount'];
						 $InfantAirTaxesYQ_Code = $InfantAirTaxesYQ['Code'];
						 
						 $InfantAirTaxesWO = $InfantAirTaxes[1]['attr'];
						 $InfantAirTaxesWO_Amount = $InfantAirTaxesWO['Amount'];
						 $InfantAirTaxesWO_Code = $InfantAirTaxesWO['Code'];
						 
						 $InfantAirTaxesIN = $InfantAirTaxes[2]['attr'];
						 $InfantAirTaxesIN_Amount = $InfantAirTaxesIN['Amount'];
						 $InfantAirTaxesIN_Code = $InfantAirTaxesIN['Code'];
						 
						 $InfantAirTaxesJN = $InfantAirTaxes[3]['attr'];
						 $InfantAirTaxesJN_Amount = $InfantAirTaxesJN['Amount'];
						 $InfantAirTaxesJN_Code = $InfantAirTaxesJN['Code'];
						 
						 $InfantAirTaxesYR = $InfantAirTaxes[4]['attr'];
						 $InfantAirTaxesYR_Amount = $InfantAirTaxesYR['Amount'];
						 $InfantAirTaxesYR_Code = $InfantAirTaxesYR['Code']; 
						 
						 
						 }
						}
						else
						{
						 $AdultPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'];
						 $AdultCode = $AdultPricingInfo['attr']['Code'];
						 $AdultCount = $AdultPricingInfo['attr']['Quantity'];
						 $AdultTotalFare = $AdultPricingInfo['ns1:TotalFare']['value'];
						 $AdultBaseFare = $AdultPricingInfo['ns1:BaseFare']['value'];
						 $AdultTransactionFee = $AdultPricingInfo['ns1:TransactionFee']['value'];
						 $AdultBookingFee = $AdultPricingInfo['ns1:BookingFee']['value'];
						 $AdultServiceTax = $AdultPricingInfo['ns1:ServiceTax']['value'];
						 
						 $AdultAirTaxes = $AdultPricingInfo ['ns1:AirTaxes']['ns1:Tax'];
						 
						 $AdultAirTaxesYQ = $AdultAirTaxes[0]['attr'];
						 $AdultAirTaxesYQ_Amount = $AdultAirTaxesYQ['Amount'];
						 $AdultAirTaxesYQ_Code = $AdultAirTaxesYQ['Code'];
						 
						 $AdultAirTaxesWO = $AdultAirTaxes[1]['attr'];
						 $AdultAirTaxesWO_Amount = $AdultAirTaxesWO['Amount'];
						 $AdultAirTaxesWO_Code = $AdultAirTaxesWO['Code'];
						 
						 $AdultAirTaxesIN = $AdultAirTaxes[2]['attr'];
						 $AdultAirTaxesIN_Amount = $AdultAirTaxesIN['Amount'];
						 $AdultAirTaxesIN_Code = $AdultAirTaxesIN['Code'];
						 
						 $AdultAirTaxesJN = $AdultAirTaxes[3]['attr'];
						 $AdultAirTaxesJN_Amount = $AdultAirTaxesJN['Amount'];
						 $AdultAirTaxesJN_Code = $AdultAirTaxesJN['Code'];
						 
						 $AdultAirTaxesYR = $AdultAirTaxes[4]['attr'];
						 $AdultAirTaxesYR_Amount = $AdultAirTaxesYR['Amount'];
						 $AdultAirTaxesYR_Code = $AdultAirTaxesYR['Code'];
						 
						 					 
						  $ChildCode = '';
						 $ChildCount = '';
						 $ChildTotalFare = '';
						 $ChildBaseFare = '';
						 $ChildTransactionFee = '';
						 $ChildBookingFee = '';
						 $ChildServiceTax = '';
						 
						 $ChildAirTaxes = '';
						 
						 $ChildAirTaxesYQ = '';
						 $ChildAirTaxesYQ_Amount = '';
						 $ChildAirTaxesYQ_Code = '';
						 
						 $ChildAirTaxesWO = '';
						 $ChildAirTaxesWO_Amount = '';
						 $ChildAirTaxesWO_Code = '';
						 
						 $ChildAirTaxesIN = '';
						 $ChildAirTaxesIN_Amount = '';
						 $ChildAirTaxesIN_Code = '';
						 
						 $ChildAirTaxesJN = '';
						 $ChildAirTaxesJN_Amount = '';
						 $ChildAirTaxesJN_Code = '';
						 
						 $ChildAirTaxesYR = '';
						 $ChildAirTaxesYR_Amount = '';
						 $ChildAirTaxesYR_Code = ''; 
						 
						  $InfantCode = '';
						 $InfantCount = '';
						 $InfantTotalFare = '';
						 $InfantBaseFare = '';
						 $InfantTransactionFee = '';
						 $InfantBookingFee = '';
						 $InfantServiceTax = '';
						 
						 $InfantAirTaxes = '';
						 
						 $InfantAirTaxesYQ = '';
						 $InfantAirTaxesYQ_Amount = '';
						 $InfantAirTaxesYQ_Code = '';
						 
						 $InfantAirTaxesWO = '';
						 $InfantAirTaxesWO_Amount = '';
						 $InfantAirTaxesWO_Code = '';
						 
						 $InfantAirTaxesIN = '';
						 $InfantAirTaxesIN_Amount = '';
						 $InfantAirTaxesIN_Code = '';
						 
						 $InfantAirTaxesJN = '';
						 $InfantAirTaxesJN_Amount = '';
						 $InfantAirTaxesJN_Code = '';
						 
						 $InfantAirTaxesYR = '';
						 $InfantAirTaxesYR_Amount = '';
						 $InfantAirTaxesYR_Code = ''; 
						 
						 
						} 
						 
						 $ResultType = $AirItinerary['ns1:ResultType']['value'];
						 
						 $OptionFormData = $AirItinerary['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']['ns1:OptionFormData']['value'];
						 $FlightSegment = $AirItinerary['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']['ns1:FlightSegment'];
                        
						//echo '<pre>';print_r($FlightSegment);exit;
						 if(is_array($FlightSegment))
						 {
							 if($this->session->userdata('mode')=='O')
							 {
								// echo 'oneway';exit;
							//echo 'm'.$MarketingAirline = $FlightSegment[0]['ns1:MarketingAirline']['value'];
							 if(isset($FlightSegment[0]) && $FlightSegment[0] != '')
							 {
								 $count = count($FlightSegment);
								 
								 $OperatingAirline = '';
								 $MarketingAirline = '';
								 $ValidatingAirline = '';
								 $FlightNumber ='';
								 $DepartureAirport ='';
								 $ArrivalAirport ='';
								// $DepartureTerminal='';
								 //$ArrivalTerminal ='';
								 $DepartureDateTime ='';
								 $ArrivalDateTime ='';
								 $ETicketEligibility ='';
								 $FareType ='';
								 $CabinClass = '';
								 $BookingClass ='';
								 $StopQuantity ='';
								// $StopCodes ='';
								 $Equipment ='';
								 $JourneyTime ='';
								  
							 for($i=0;$i<$count;$i++)
							 {
								
								
									 if($count-$i==1)
									 {
									 $OperatingAirline .= $FlightSegment[$i]['ns1:OperatingAirline']['value'];
									 $MarketingAirline .= $FlightSegment[$i]['ns1:MarketingAirline']['value'];
									 $ValidatingAirline .= $FlightSegment[$i]['ns1:ValidatingAirline']['value'];
									 $FlightNumber .= $FlightSegment[$i]['ns1:FlightNumber']['value'];
									 $DepartureAirport .= $FlightSegment[$i]['ns1:DepartureAirport']['value'];
									 $ArrivalAirport .= $FlightSegment[$i]['ns1:ArrivalAirport']['value'];
									 //$DepartureTerminal .= $FlightSegment['ns1:DepartureTerminal']['value'];
									 // $ArrivalTerminal .= $FlightSegment[$i]['ns1:ArrivalTerminal']['value'];
									 $DepartureDateTime .= $FlightSegment[$i]['ns1:DepartureDateTime']['value'];
									 $ArrivalDateTime .= $FlightSegment[$i]['ns1:ArrivalDateTime']['value'];
									 $ETicketEligibility .= $FlightSegment[$i]['ns1:ETicketEligibility']['value'];
									 $FareType .= $FlightSegment[$i]['ns1:FareType']['value'];
									 $CabinClass .= $FlightSegment[$i]['ns1:CabinClass']['value'];
									 $BookingClass .= $FlightSegment[$i]['ns1:BookingClass']['value'];
									 $StopQuantity .= $FlightSegment[$i]['ns1:StopQuantity']['value'];
									 //$StopCodes .= $FlightSegment[$i]['ns1:StopCodes']['value'];
									 $Equipment .= $FlightSegment[$i]['ns1:Equipment']['value'];
									 $JourneyTime .= $FlightSegment[$i]['ns1:JourneyTime']['value'];
									 
									 }
									 else
									 {
										 
									 $OperatingAirline .= $FlightSegment[$i]['ns1:OperatingAirline']['value'].'/';
									 $MarketingAirline .= $FlightSegment[$i]['ns1:MarketingAirline']['value'].'/';
									 $ValidatingAirline .= $FlightSegment[$i]['ns1:ValidatingAirline']['value'].'/';
									 $FlightNumber .= $FlightSegment[$i]['ns1:FlightNumber']['value'].'/';
									 $DepartureAirport .= $FlightSegment[$i]['ns1:DepartureAirport']['value'].'/';
									 $ArrivalAirport .= $FlightSegment[$i]['ns1:ArrivalAirport']['value'].'/';
									 // $DepartureTerminal = $FlightSegment['ns1:DepartureTerminal']['value'].'/';
									 // $ArrivalTerminal .= $FlightSegment[$i]['ns1:ArrivalTerminal']['value'].'/';
									 $DepartureDateTime .= $FlightSegment[$i]['ns1:DepartureDateTime']['value'].'/';
									 $ArrivalDateTime .= $FlightSegment[$i]['ns1:ArrivalDateTime']['value'].'/';
									 $ETicketEligibility .= $FlightSegment[$i]['ns1:ETicketEligibility']['value'].'/';
									 $FareType .= $FlightSegment[$i]['ns1:FareType']['value'].'/';
									 $CabinClass .= $FlightSegment[$i]['ns1:CabinClass']['value'].'/';
									 $BookingClass .= $FlightSegment[$i]['ns1:BookingClass']['value'].'/';
									 $StopQuantity .= $FlightSegment[$i]['ns1:StopQuantity']['value'].'/';
									 // $StopCodes .= $FlightSegment[$i]['ns1:StopCodes']['value'].'/';
									 $Equipment .= $FlightSegment[$i]['ns1:Equipment']['value'].'/';
									 $JourneyTime .= $FlightSegment[$i]['ns1:JourneyTime']['value'].'/';
										 
									 }
																
							 }
							 
							// echo $OperatingAirline;
							 
							}
							else
							{
								$FlightStops = 0;
							
								$OperatingAirline = $FlightSegment['ns1:OperatingAirline']['value'];
								$MarketingAirline = $FlightSegment['ns1:MarketingAirline']['value'];
								$ValidatingAirline = $FlightSegment['ns1:ValidatingAirline']['value'];
								$FlightNumber = $FlightSegment['ns1:FlightNumber']['value'];
								$DepartureAirport = $FlightSegment['ns1:DepartureAirport']['value'];
								$ArrivalAirport = $FlightSegment['ns1:ArrivalAirport']['value'];
								//$DepartureTerminal = $FlightSegment['ns1:DepartureTerminal']['value'];
								//$ArrivalTerminal = $FlightSegment['ns1:ArrivalTerminal']['value'];
								$DepartureDateTime = $FlightSegment['ns1:DepartureDateTime']['value'];
								$ArrivalDateTime = $FlightSegment['ns1:ArrivalDateTime']['value'];
								$ETicketEligibility = $FlightSegment['ns1:ETicketEligibility']['value'];
								$FareType = $FlightSegment['ns1:FareType']['value'];
								$CabinClass = $FlightSegment['ns1:CabinClass']['value'];
								$BookingClass = $FlightSegment['ns1:BookingClass']['value'];
								$StopQuantity = $FlightSegment['ns1:StopQuantity']['value'];
								//$StopCodes = $FlightSegment['ns1:StopCodes']['value'];
								$Equipment = $FlightSegment['ns1:Equipment']['value'];
								$JourneyTime = $FlightSegment['ns1:JourneyTime']['value'];	
								
							}
							
						    }
						    if($this->session->userdata('mode')=='R')
						    {
								//echo 'round';exit;
								if($ResultType =='itinerary'){ 
									//echo 'itinerary';exit;
						if(isset($FlightSegment[0]) && $FlightSegment[0] != '')
							 {
								//echo '<pre>';print_r($FlightSegment);
								 $count = count($FlightSegment);
								// echo $count;exit;
								 //$FlightStops = $count -1;
								 $OperatingAirline = '';
								 $MarketingAirline = '';
								 $ValidatingAirline = '';
								 $FlightNumber ='';
								 $DepartureAirport ='';
								 $ArrivalAirport ='';
								// $DepartureTerminal='';
								 //$ArrivalTerminal ='';
								 $DepartureDateTime ='';
								 $ArrivalDateTime ='';
								 $ETicketEligibility ='';
								 $FareType ='';
								 $CabinClass = '';
								 $BookingClass ='';
								 $StopQuantity ='';
								// $StopCodes ='';
								 $Equipment ='';
								 $JourneyTime ='';
								  
							 for($i=0;$i<$count;$i++)
							 {
								
							 if($count-$i==1)
									 {
									$OperatingAirline .= $FlightSegment[$i]['ns1:OperatingAirline']['value'];
									 $MarketingAirline .= $FlightSegment[$i]['ns1:MarketingAirline']['value'];
									 $ValidatingAirline .= $FlightSegment[$i]['ns1:ValidatingAirline']['value'];
									 $FlightNumber .= $FlightSegment[$i]['ns1:FlightNumber']['value'];
									 $DepartureAirport .= $FlightSegment[$i]['ns1:DepartureAirport']['value'];
									$ArrivalAirport .= $FlightSegment[$i]['ns1:ArrivalAirport']['value'];
									// $DepartureTerminal .= $FlightSegment['ns1:DepartureTerminal']['value'];
									 // $ArrivalTerminal .= $FlightSegment[$i]['ns1:ArrivalTerminal']['value'];
									$DepartureDateTime .= $FlightSegment[$i]['ns1:DepartureDateTime']['value'];
									 $ArrivalDateTime .= $FlightSegment[$i]['ns1:ArrivalDateTime']['value'];
									 $ETicketEligibility .= $FlightSegment[$i]['ns1:ETicketEligibility']['value'];
									  $FareType .= $FlightSegment[$i]['ns1:FareType']['value'];
									  $CabinClass .= $FlightSegment[$i]['ns1:CabinClass']['value'];
									 $BookingClass .= $FlightSegment[$i]['ns1:BookingClass']['value'];
									 // $StopQuantity .= $FlightSegment[$i]['ns1:StopQuantity']['value'];
									 //$StopCodes .= $FlightSegment[$i]['ns1:StopCodes']['value'];
									$Equipment .= $FlightSegment[$i]['ns1:Equipment']['value'];
									 $JourneyTime .= $FlightSegment[$i]['ns1:JourneyTime']['value'];
									 
									 }
									 else
									 {
										 
									$OperatingAirline .= $FlightSegment[$i]['ns1:OperatingAirline']['value'].'/';
									 $MarketingAirline .= $FlightSegment[$i]['ns1:MarketingAirline']['value'].'/';
									$ValidatingAirline .= $FlightSegment[$i]['ns1:ValidatingAirline']['value'].'/';
									$FlightNumber .= $FlightSegment[$i]['ns1:FlightNumber']['value'].'/';
									 $DepartureAirport .= $FlightSegment[$i]['ns1:DepartureAirport']['value'].'/';
									 $ArrivalAirport .= $FlightSegment[$i]['ns1:ArrivalAirport']['value'].'/';
									// $DepartureTerminal = $FlightSegment['ns1:DepartureTerminal']['value'].'/';
									// $ArrivalTerminal .= $FlightSegment[$i]['ns1:ArrivalTerminal']['value'].'/';
									$DepartureDateTime .= $FlightSegment[$i]['ns1:DepartureDateTime']['value'].'/';
									$ArrivalDateTime .= $FlightSegment[$i]['ns1:ArrivalDateTime']['value'].'/';
									 $ETicketEligibility .= $FlightSegment[$i]['ns1:ETicketEligibility']['value'].'/';
									  $FareType .= $FlightSegment[$i]['ns1:FareType']['value'].'/';
									 $CabinClass .= $FlightSegment[$i]['ns1:CabinClass']['value'].'/';
									$BookingClass .= $FlightSegment[$i]['ns1:BookingClass']['value'].'/';
									 // $StopQuantity .= $FlightSegment[$i]['ns1:StopQuantity']['value'].'/';
									// $StopCodes .= $FlightSegment[$i]['ns1:StopCodes']['value'].'/';
									$Equipment .= $FlightSegment[$i]['ns1:Equipment']['value'].'/';
									 $JourneyTime .= $FlightSegment[$i]['ns1:JourneyTime']['value'].'/';
										 
									 }
								
							 }
							 // $DepartureDateTime.'++'.
							// echo $JourneyTime;exit;
							
							  $DepartureAirportInbound = '';
							  $DepartureAirportOutbound=''; 
							  $ArrivalAirportInbound ='';
							  $ArrivalAirportOutbound='';
							  $OperatingAirlineInbound ='';
							  $OperatingAirlineOutbound ='';
							  $MarketingAirlineInbound='';
							  $MarketingAirlineOutbound ='';
							  $ValidatingAirlineInbound ='';
							  $ValidatingAirlineOutbound ='';
							  $FlightNumberInbound='';
							  $FlightNumberOutbound='';
							  $DepartureDateTimeInbound ='';
							  $DepartureDateTimeOutbound='';
							  $ArrivalDateTimeInbound='';
							  $ArrivalDateTimeOutbound='';
							  $ETicketEligibilityInbound='';
							  $ETicketEligibilityOutbound='';
							  $FareTypeInbound='';
							  $FareTypeOutbound='';
							  $CabinClassInbound='';
							  $CabinClassOutbound ='';
							  $BookingClassInbound ='';
							  $BookingClassOutbound='';
							  //$StopQuantityInbound =''; 
							  //$StopQuantityOutbound='';
							  $EquipmentInbound='';
							  $EquipmentOutbound='';
							  $JourneyTimeInbound='';
							  $JourneyTimeOutbound='';
							 for($i=0;$i<$count;$i++)
							 {
								 $flight_departure =$this->session->userdata('flight_departure');
								 $flight_arrival =$this->session->userdata('flight_arrival');
								 //echo ' Stop : '.$flight_arrival;exit;
								 $DepartureAirport1 = explode('/',$DepartureAirport);
								 $ArrivalAirport1   = explode('/',$ArrivalAirport);
								 $OperatingAirline1 = explode('/',$OperatingAirline);
								 $MarketingAirline1 = explode('/',$MarketingAirline);
								 $ValidatingAirline1 = explode('/',$ValidatingAirline);
								 $FlightNumber1 = explode('/',$FlightNumber);
								 $DepartureDateTime1 = explode('/',$DepartureDateTime);
								 $ArrivalDateTime1 = explode('/',$ArrivalDateTime);
								 $ETicketEligibility1 = explode('/',$ETicketEligibility);
								 $FareType1 = explode('/',$FareType);
								 $CabinClass1 = explode('/',$CabinClass);
								 $BookingClass1 = explode('/',$BookingClass);
								 //$StopQuantity1 = explode('/',$StopQuantity);
								 $Equipment1 = explode('/',$Equipment);
								 $JourneyTime1 = explode('/',$JourneyTime);
								 
								 if($DepartureAirport1[$i]==$flight_arrival)
								 {
									 
									 // Here we are checking the condition for return flight
									 
									 for($j=$i; $j<$count;$j++)
									 {
										 if($count-$j==1)
									   {
										   $DepartureAirportInbound .= $DepartureAirport1[$j]; // inbound departure
										   $ArrivalAirportInbound .= $ArrivalAirport1[$j];     // inbound arrival
										   $OperatingAirlineInbound .= $OperatingAirline1[$j];
										   $MarketingAirlineInbound .= $MarketingAirline1[$j];
										   $ValidatingAirlineInbound .= $ValidatingAirline1[$j];
										   $FlightNumberInbound .= $FlightNumber1[$j];
										   $DepartureDateTimeInbound .= $DepartureDateTime1[$j];
										   $ArrivalDateTimeInbound .= $ArrivalDateTime1[$j];
										   $ETicketEligibilityInbound .= $ETicketEligibility1[$j];
										   $FareTypeInbound .= $FareType1[$j];
										   $CabinClassInbound .= $CabinClass1[$j];
										   $BookingClassInbound .= $BookingClass1[$j];
										  // $StopQuantityInbound .= $StopQuantity1[$j];
										   $EquipmentInbound .= $Equipment1[$j];
										   $JourneyTimeInbound .= $JourneyTime1[$j];
										   	
									   }
									   else
									   {
										   $DepartureAirportInbound .= $DepartureAirport1[$j].'/'; // inbound departure
										   $ArrivalAirportInbound .= $ArrivalAirport1[$j].'/';     // inbound arrival
										   $OperatingAirlineInbound .= $OperatingAirline1[$j].'/';
										   $MarketingAirlineInbound .= $MarketingAirline1[$j].'/';
										   $ValidatingAirlineInbound .= $ValidatingAirline1[$j].'/';
										   $FlightNumberInbound .= $FlightNumber1[$j].'/';
										   $DepartureDateTimeInbound .= $DepartureDateTime1[$j].'/';
										   $ArrivalDateTimeInbound .= $ArrivalDateTime1[$j].'/';
										   $ETicketEligibilityInbound .= $ETicketEligibility1[$j].'/';
										   $FareTypeInbound .= $FareType1[$j].'/';
										   $CabinClassInbound .= $CabinClass1[$j].'/';
										   $BookingClassInbound .= $BookingClass1[$j].'/';
										   //$StopQuantityInbound .= $StopQuantity1[$j].'/';
										   $EquipmentInbound .= $Equipment1[$j].'/';
										   $JourneyTimeInbound .= $JourneyTime1[$j].'/';
									   }
									 }
									 for($k=0; $k<$i ; $k++)
									 {
										 if($i-$k==1)
									   {
										   $DepartureAirportOutbound .=  $DepartureAirport1[$k];   //  outbound departure
										   $ArrivalAirportOutbound .= $ArrivalAirport1[$k];        //  outbound arrival
										   $OperatingAirlineOutbound .= $OperatingAirline1[$k];
										   $MarketingAirlineOutbound .= $MarketingAirline1[$k];
										   $ValidatingAirlineOutbound .= $ValidatingAirline1[$k];
										   $FlightNumberOutbound .= $FlightNumber1[$k];
										   $DepartureDateTimeOutbound .= $DepartureDateTime1[$k];
										   $ArrivalDateTimeOutbound .= $ArrivalDateTime1[$k];
										   $ETicketEligibilityOutbound .= $ETicketEligibility1[$k];
										   $FareTypeOutbound .= $FareType1[$k];
										   $CabinClassOutbound .= $CabinClass1[$k];
										   $BookingClassOutbound .= $BookingClass1[$k];
										  // $StopQuantityOutbound .= $StopQuantity1[$k];
										   $EquipmentOutbound .= $Equipment1[$k];
										   $JourneyTimeOutbound .= $JourneyTime1[$k];
										}
										else
										{
											$DepartureAirportOutbound .=  $DepartureAirport1[$k].'/';   //  outbound departure
										    $ArrivalAirportOutbound .= $ArrivalAirport1[$k].'/';        //  outbound arrival
										    $OperatingAirlineOutbound .= $OperatingAirline1[$k].'/';
										   $MarketingAirlineOutbound .= $MarketingAirline1[$k].'/';
										   $ValidatingAirlineOutbound .= $ValidatingAirline1[$k].'/';
										   $FlightNumberOutbound .= $FlightNumber1[$k].'/';
										   $DepartureDateTimeOutbound .= $DepartureDateTime1[$k].'/';
										   $ArrivalDateTimeOutbound .= $ArrivalDateTime1[$k].'/';
										   $ETicketEligibilityOutbound .= $ETicketEligibility1[$k].'/';
										   $FareTypeOutbound .= $FareType1[$k].'/';
										   $CabinClassOutbound .= $CabinClass1[$k].'/';
										   $BookingClassOutbound .= $BookingClass1[$k].'/';
										   //$StopQuantityOutbound .= $StopQuantity1[$k].'/';
										   $EquipmentOutbound .= $Equipment1[$k].'/';
										   $JourneyTimeOutbound .= $JourneyTime1[$k].'/';
										}
									 }									  
								 }
							 }
						//	echo $OperatingAirlineInbound	;
						//	echo '===';
						//	echo $OperatingAirlineOutbound;exit;
							}
							else
							{
								
								$OperatingAirline = $FlightSegment['ns1:OperatingAirline']['value'];
								$MarketingAirline = $FlightSegment['ns1:MarketingAirline']['value'];
								$ValidatingAirline = $FlightSegment['ns1:ValidatingAirline']['value'];
								$FlightNumber = $FlightSegment['ns1:FlightNumber']['value'];
								$DepartureAirport = $FlightSegment['ns1:DepartureAirport']['value'];
								$ArrivalAirport = $FlightSegment['ns1:ArrivalAirport']['value'];
								
								$DepartureDateTime = $FlightSegment['ns1:DepartureDateTime']['value'];
								$ArrivalDateTime = $FlightSegment['ns1:ArrivalDateTime']['value'];
								$ETicketEligibility = $FlightSegment['ns1:ETicketEligibility']['value'];
								$FareType = $FlightSegment['ns1:FareType']['value'];
								$CabinClass = $FlightSegment['ns1:CabinClass']['value'];
								$BookingClass = $FlightSegment['ns1:BookingClass']['value'];
								$StopQuantity = $FlightSegment['ns1:StopQuantity']['value'];
								//$StopCodes = $FlightSegment['ns1:StopCodes']['value'];
								$Equipment = $FlightSegment['ns1:Equipment']['value'];
								$JourneyTime = $FlightSegment['ns1:JourneyTime']['value'];	
								
							}
						
						    }
							
							if($ResultType == 'onward'){
								//echo 'onward';exit;
							//echo 'm'.$MarketingAirline = $FlightSegment[0]['ns1:MarketingAirline']['value'];
							 if(isset($FlightSegment[0]) && $FlightSegment[0] != '')
							 {
								 $count = count($FlightSegment);
								 
								 
								 $OperatingAirline = '';
								 $MarketingAirline = '';
								 $ValidatingAirline = '';
								 $FlightNumber ='';
								 $DepartureAirport ='';
								 $ArrivalAirport ='';
								// $DepartureTerminal='';
								 //$ArrivalTerminal ='';
								 $DepartureDateTime ='';
								 $ArrivalDateTime ='';
								 $ETicketEligibility ='';
								 $FareType ='';
								 $CabinClass = '';
								 $BookingClass ='';
								 $StopQuantity ='';
								// $StopCodes ='';
								 $Equipment ='';
								 $JourneyTime ='';
								  
							 for($i=0;$i<$count;$i++)
							 {
								
								
									 if($count-$i==1)
									 {
									$OperatingAirline .= $FlightSegment[$i]['ns1:OperatingAirline']['value'];
									 $MarketingAirline .= $FlightSegment[$i]['ns1:MarketingAirline']['value'];
									 $ValidatingAirline .= $FlightSegment[$i]['ns1:ValidatingAirline']['value'];
									 $FlightNumber .= $FlightSegment[$i]['ns1:FlightNumber']['value'];
									 $DepartureAirport .= $FlightSegment[$i]['ns1:DepartureAirport']['value'];
									$ArrivalAirport .= $FlightSegment[$i]['ns1:ArrivalAirport']['value'];
									// $DepartureTerminal .= $FlightSegment['ns1:DepartureTerminal']['value'];
									 // $ArrivalTerminal .= $FlightSegment[$i]['ns1:ArrivalTerminal']['value'];
									$DepartureDateTime .= $FlightSegment[$i]['ns1:DepartureDateTime']['value'];
									 $ArrivalDateTime .= $FlightSegment[$i]['ns1:ArrivalDateTime']['value'];
									 $ETicketEligibility .= $FlightSegment[$i]['ns1:ETicketEligibility']['value'];
									  $FareType .= $FlightSegment[$i]['ns1:FareType']['value'];
									  $CabinClass .= $FlightSegment[$i]['ns1:CabinClass']['value'];
									 $BookingClass .= $FlightSegment[$i]['ns1:BookingClass']['value'];
									  $StopQuantity .= $FlightSegment[$i]['ns1:StopQuantity']['value'];
									 //$StopCodes .= $FlightSegment[$i]['ns1:StopCodes']['value'];
									$Equipment .= $FlightSegment[$i]['ns1:Equipment']['value'];
									 $JourneyTime .= $FlightSegment[$i]['ns1:JourneyTime']['value'];
									 
									 }
									 else
									 {
										 
									$OperatingAirline .= $FlightSegment[$i]['ns1:OperatingAirline']['value'].'/';
									 $MarketingAirline .= $FlightSegment[$i]['ns1:MarketingAirline']['value'].'/';
									$ValidatingAirline .= $FlightSegment[$i]['ns1:ValidatingAirline']['value'].'/';
									$FlightNumber .= $FlightSegment[$i]['ns1:FlightNumber']['value'].'/';
									  $DepartureAirport .= $FlightSegment[$i]['ns1:DepartureAirport']['value'].'/';
									 $ArrivalAirport .= $FlightSegment[$i]['ns1:ArrivalAirport']['value'].'/';
									// $DepartureTerminal = $FlightSegment['ns1:DepartureTerminal']['value'].'/';
									// $ArrivalTerminal .= $FlightSegment[$i]['ns1:ArrivalTerminal']['value'].'/';
									$DepartureDateTime .= $FlightSegment[$i]['ns1:DepartureDateTime']['value'].'/';
									$ArrivalDateTime .= $FlightSegment[$i]['ns1:ArrivalDateTime']['value'].'/';
									 $ETicketEligibility .= $FlightSegment[$i]['ns1:ETicketEligibility']['value'].'/';
									  $FareType .= $FlightSegment[$i]['ns1:FareType']['value'].'/';
									 $CabinClass .= $FlightSegment[$i]['ns1:CabinClass']['value'].'/';
									$BookingClass .= $FlightSegment[$i]['ns1:BookingClass']['value'].'/';
									  $StopQuantity .= $FlightSegment[$i]['ns1:StopQuantity']['value'].'/';
									// $StopCodes .= $FlightSegment[$i]['ns1:StopCodes']['value'].'/';
									$Equipment .= $FlightSegment[$i]['ns1:Equipment']['value'].'/';
									 $JourneyTime .= $FlightSegment[$i]['ns1:JourneyTime']['value'].'/';
										 
									 }
																
							 }
							 
							// echo $OperatingAirline;
							 
							}
							else
							{
								$FlightStops = 0;
							
								$OperatingAirline = $FlightSegment['ns1:OperatingAirline']['value'];
								$MarketingAirline = $FlightSegment['ns1:MarketingAirline']['value'];
								$ValidatingAirline = $FlightSegment['ns1:ValidatingAirline']['value'];
								$FlightNumber = $FlightSegment['ns1:FlightNumber']['value'];
								$DepartureAirport = $FlightSegment['ns1:DepartureAirport']['value'];
								$ArrivalAirport = $FlightSegment['ns1:ArrivalAirport']['value'];
								//$DepartureTerminal = $FlightSegment['ns1:DepartureTerminal']['value'];
								//$ArrivalTerminal = $FlightSegment['ns1:ArrivalTerminal']['value'];
								$DepartureDateTime = $FlightSegment['ns1:DepartureDateTime']['value'];
								$ArrivalDateTime = $FlightSegment['ns1:ArrivalDateTime']['value'];
								$ETicketEligibility = $FlightSegment['ns1:ETicketEligibility']['value'];
								$FareType = $FlightSegment['ns1:FareType']['value'];
								$CabinClass = $FlightSegment['ns1:CabinClass']['value'];
								$BookingClass = $FlightSegment['ns1:BookingClass']['value'];
								$StopQuantity = $FlightSegment['ns1:StopQuantity']['value'];
								//$StopCodes = $FlightSegment['ns1:StopCodes']['value'];
								$Equipment = $FlightSegment['ns1:Equipment']['value'];
								$JourneyTime = $FlightSegment['ns1:JourneyTime']['value'];	
								
							}
							
						    }
						    				
						   if($ResultType == 'return'){
							   
								//echo 'return';exit;
							//echo 'm'.$MarketingAirline = $FlightSegment[0]['ns1:MarketingAirline']['value'];
							 if(isset($FlightSegment[0]) && $FlightSegment[0] != '')
							 {
								 $count = count($FlightSegment);
								 
								 
								 $OperatingAirline = '';
								 $MarketingAirline = '';
								 $ValidatingAirline = '';
								 $FlightNumber ='';
								 $DepartureAirport ='';
								 $ArrivalAirport ='';
								// $DepartureTerminal='';
								 //$ArrivalTerminal ='';
								 $DepartureDateTime ='';
								 $ArrivalDateTime ='';
								 $ETicketEligibility ='';
								 $FareType ='';
								 $CabinClass = '';
								 $BookingClass ='';
								 $StopQuantity ='';
								// $StopCodes ='';
								 $Equipment ='';
								 $JourneyTime ='';
								  
							 for($i=0;$i<$count;$i++)
							 {
								
								
									 if($count-$i==1)
									 {
									$OperatingAirline .= $FlightSegment[$i]['ns1:OperatingAirline']['value'];
									 $MarketingAirline .= $FlightSegment[$i]['ns1:MarketingAirline']['value'];
									 $ValidatingAirline .= $FlightSegment[$i]['ns1:ValidatingAirline']['value'];
									 $FlightNumber .= $FlightSegment[$i]['ns1:FlightNumber']['value'];
									 $DepartureAirport .= $FlightSegment[$i]['ns1:DepartureAirport']['value'];
									$ArrivalAirport .= $FlightSegment[$i]['ns1:ArrivalAirport']['value'];
									// $DepartureTerminal .= $FlightSegment['ns1:DepartureTerminal']['value'];
									 // $ArrivalTerminal .= $FlightSegment[$i]['ns1:ArrivalTerminal']['value'];
									$DepartureDateTime .= $FlightSegment[$i]['ns1:DepartureDateTime']['value'];
									 $ArrivalDateTime .= $FlightSegment[$i]['ns1:ArrivalDateTime']['value'];
									 $ETicketEligibility .= $FlightSegment[$i]['ns1:ETicketEligibility']['value'];
									  $FareType .= $FlightSegment[$i]['ns1:FareType']['value'];
									  $CabinClass .= $FlightSegment[$i]['ns1:CabinClass']['value'];
									 $BookingClass .= $FlightSegment[$i]['ns1:BookingClass']['value'];
									  $StopQuantity .= $FlightSegment[$i]['ns1:StopQuantity']['value'];
									 //$StopCodes .= $FlightSegment[$i]['ns1:StopCodes']['value'];
									$Equipment .= $FlightSegment[$i]['ns1:Equipment']['value'];
									 $JourneyTime .= $FlightSegment[$i]['ns1:JourneyTime']['value'];
									 
									 }
									 else
									 {
										 
									$OperatingAirline .= $FlightSegment[$i]['ns1:OperatingAirline']['value'].'/';
									 $MarketingAirline .= $FlightSegment[$i]['ns1:MarketingAirline']['value'].'/';
									$ValidatingAirline .= $FlightSegment[$i]['ns1:ValidatingAirline']['value'].'/';
									$FlightNumber .= $FlightSegment[$i]['ns1:FlightNumber']['value'].'/';
									  $DepartureAirport .= $FlightSegment[$i]['ns1:DepartureAirport']['value'].'/';
									 $ArrivalAirport .= $FlightSegment[$i]['ns1:ArrivalAirport']['value'].'/';
									// $DepartureTerminal = $FlightSegment['ns1:DepartureTerminal']['value'].'/';
									// $ArrivalTerminal .= $FlightSegment[$i]['ns1:ArrivalTerminal']['value'].'/';
									$DepartureDateTime .= $FlightSegment[$i]['ns1:DepartureDateTime']['value'].'/';
									$ArrivalDateTime .= $FlightSegment[$i]['ns1:ArrivalDateTime']['value'].'/';
									 $ETicketEligibility .= $FlightSegment[$i]['ns1:ETicketEligibility']['value'].'/';
									  $FareType .= $FlightSegment[$i]['ns1:FareType']['value'].'/';
									 $CabinClass .= $FlightSegment[$i]['ns1:CabinClass']['value'].'/';
									$BookingClass .= $FlightSegment[$i]['ns1:BookingClass']['value'].'/';
									  $StopQuantity .= $FlightSegment[$i]['ns1:StopQuantity']['value'].'/';
									// $StopCodes .= $FlightSegment[$i]['ns1:StopCodes']['value'].'/';
									$Equipment .= $FlightSegment[$i]['ns1:Equipment']['value'].'/';
									 $JourneyTime .= $FlightSegment[$i]['ns1:JourneyTime']['value'].'/';
										 
									 }
																
							 }
							 
							// echo $OperatingAirline;
							 
							}
							else
							{
								$FlightStops = 0;
							
								$OperatingAirline = $FlightSegment['ns1:OperatingAirline']['value'];
								$MarketingAirline = $FlightSegment['ns1:MarketingAirline']['value'];
								$ValidatingAirline = $FlightSegment['ns1:ValidatingAirline']['value'];
								$FlightNumber = $FlightSegment['ns1:FlightNumber']['value'];
								$DepartureAirport = $FlightSegment['ns1:DepartureAirport']['value'];
								$ArrivalAirport = $FlightSegment['ns1:ArrivalAirport']['value'];
								//$DepartureTerminal = $FlightSegment['ns1:DepartureTerminal']['value'];
								//$ArrivalTerminal = $FlightSegment['ns1:ArrivalTerminal']['value'];
								$DepartureDateTime = $FlightSegment['ns1:DepartureDateTime']['value'];
								$ArrivalDateTime = $FlightSegment['ns1:ArrivalDateTime']['value'];
								$ETicketEligibility = $FlightSegment['ns1:ETicketEligibility']['value'];
								$FareType = $FlightSegment['ns1:FareType']['value'];
								$CabinClass = $FlightSegment['ns1:CabinClass']['value'];
								$BookingClass = $FlightSegment['ns1:BookingClass']['value'];
								$StopQuantity = $FlightSegment['ns1:StopQuantity']['value'];
								//$StopCodes = $FlightSegment['ns1:StopCodes']['value'];
								$Equipment = $FlightSegment['ns1:Equipment']['value'];
								$JourneyTime = $FlightSegment['ns1:JourneyTime']['value'];	
								
							}
							
						    
							   }				
							  }
							
							}
							// print_r('hello');exit;
						 
						
						 $flight_session = $this->session->userdata('flight_session');
						
					if($this->session->userdata('mode')=='O')
						{ 
						$data = array('SearchFormData'=>$SearchFormData,'FlightSessionId '=>$flight_session,'ResultType'=>$ResultType,'CartBookingId'=>0,'CartFormData'=>0,
						
						/*'OperatingAirline'=>$OperatingAirline,'MarketingAirline'=>$MarketingAirline,'ValidatingAirline'=>$ValidatingAirline,'FlightNumber'=>$FlightNumber,'DepartureAirport'=>$DepartureAirport,'ArrivalAirport'=>$ArrivalAirport,'DepartureDateTime'=>$DepartureDateTime,'ArrivalDateTime'=>$ArrivalDateTime,'ETicketEligibility'=>$ETicketEligibility,'FareType'=>$FareType,'CabinClass'=>$CabinClass,'BookingClass'=>$BookingClass,'JourneyTime'=>$JourneyTime,*/
						
						'DepartureAirportOutbound'=>$DepartureAirport,'ArrivalAirportOutbound'=>$ArrivalAirport,'OperatingAirlineOutbound'=>$OperatingAirline,'MarketingAirlineOutbound'=>$MarketingAirline,'ValidatingAirlineOutbound'=>$ValidatingAirline,'FlightNumberOutbound'=>$FlightNumber,'DepartureDateTimeOutbound'=>$DepartureDateTime,'ArrivalDateTimeOutbound'=>$ArrivalDateTime,'ETicketEligibilityOutbound'=>$ETicketEligibility,'FareTypeOutbound'=>$FareType,'CabinClassOutbound'=>$CabinClass,'BookingClassOutbound'=>$BookingClass,'JourneyTimeOutbound'=>$JourneyTime,
						
						'OptionFormData'=>$OptionFormData,'AirItineraryCurrency'=>$AirItineraryCurrency,'AirItinTotalFare'=>$AirItinTotalFare,'AirItinBaseFare'=>$AirItinBaseFare,'AirItinCommission'=>$AirItinCommission,
						
						'AdultCount'=>$AdultCount,'AdultTotalFare'=>$AdultTotalFare,'AdultBaseFare'=>$AdultBaseFare,'AdultTransactionFee'=>$AdultTransactionFee,'AdultBookingFee'=>$AdultBookingFee,'AdultServiceTax'=>$AdultServiceTax,
						'AdultAirTaxesYQ_Amount'=>$AdultAirTaxesYQ_Amount,'AdultAirTaxesWO_Amount'=>$AdultAirTaxesWO_Amount,'AdultAirTaxesIN_Amount'=>$AdultAirTaxesIN_Amount,'AdultAirTaxesJN_Amount'=>$AdultAirTaxesJN_Amount,'AdultAirTaxesYR_Amount'=>$AdultAirTaxesYR_Amount,
						
						'ChildCount'=>$ChildCount,'ChildTotalFare'=>$ChildTotalFare,'ChildBaseFare'=>$ChildBaseFare,'ChildTransactionFee'=>$ChildTransactionFee,'ChildBookingFee'=>$ChildBookingFee,'ChildServiceTax'=>$ChildServiceTax,
						'ChildAirTaxesYQ_Amount'=>$ChildAirTaxesYQ_Amount,'ChildAirTaxesWO_Amount'=>$ChildAirTaxesWO_Amount,'ChildAirTaxesIN_Amount'=>$ChildAirTaxesIN_Amount,'ChildAirTaxesJN_Amount'=>$ChildAirTaxesJN_Amount,'ChildAirTaxesYR_Amount'=>$ChildAirTaxesYR_Amount,
						
						'InfantCount'=>$InfantCount,'InfantTotalFare'=>$InfantTotalFare,'InfantBaseFare'=>$InfantBaseFare,'InfantTransactionFee'=>$InfantTransactionFee,'InfantBookingFee'=>$InfantBookingFee,'InfantServiceTax'=>$InfantServiceTax,
						'InfantAirTaxesYQ_Amount'=>$InfantAirTaxesYQ_Amount,'InfantAirTaxesWO_Amount'=>$InfantAirTaxesWO_Amount,'InfantAirTaxesIN_Amount'=>$InfantAirTaxesIN_Amount,'InfantAirTaxesJN_Amount'=>$InfantAirTaxesJN_Amount,'InfantAirTaxesYR_Amount'=>$InfantAirTaxesYR_Amount,
						
						'ItineraryCurrency'=>$ItineraryCurrency,'ItinTotalFare'=>$ItinTotalFare,'ItinServiceTax'=>$ItinServiceTax,'ItinCommission'=>$ItinCommission);
					}
					if($this->session->userdata('mode')=='R')
					{
						if($ResultType =='itinerary')
						{
							//echo 'kjhfs'.$JourneyTimeOutbound;exit;
						$data = array('SearchFormData'=>$SearchFormData,'FlightSessionId '=>$flight_session,'ResultType'=>$ResultType,'CartBookingId'=>0,'CartFormData'=>0,
						
						'DepartureAirportOutbound'=>$DepartureAirportOutbound,'ArrivalAirportOutbound'=>$ArrivalAirportOutbound,'OperatingAirlineOutbound'=>$OperatingAirlineOutbound,'MarketingAirlineOutbound'=>$MarketingAirlineOutbound,'ValidatingAirlineOutbound'=>$ValidatingAirlineOutbound,'FlightNumberOutbound'=>$FlightNumberOutbound,'DepartureDateTimeOutbound'=>$DepartureDateTimeOutbound,'ArrivalDateTimeOutbound'=>$ArrivalDateTimeOutbound,'ETicketEligibilityOutbound'=>$ETicketEligibilityOutbound,'FareTypeOutbound'=>$FareTypeOutbound,'CabinClassOutbound'=>$CabinClassOutbound,'BookingClassOutbound'=>$BookingClassOutbound,'JourneyTimeOutbound'=>$JourneyTimeOutbound,
						
						'DepartureAirportInbound'=>$DepartureAirportInbound,'ArrivalAirportInbound'=>$ArrivalAirportInbound,'OperatingAirlineInbound'=>$OperatingAirlineInbound,'MarketingAirlineInbound'=>$MarketingAirlineInbound,'ValidatingAirlineInbound'=>$ValidatingAirlineInbound,'FlightNumberInbound'=>$FlightNumberInbound,'DepartureDateTimeInbound'=>$DepartureDateTimeInbound,'ArrivalDateTimeInbound'=>$ArrivalDateTimeInbound,'ETicketEligibilityInbound'=>$ETicketEligibilityInbound,'FareTypeInbound'=>$FareTypeInbound,'CabinClassInbound'=>$CabinClassInbound,'BookingClassInbound'=>$BookingClassInbound,'JourneyTimeInbound'=>$JourneyTimeInbound,
						
						'OptionFormData'=>$OptionFormData,'AirItineraryCurrency'=>$AirItineraryCurrency,'AirItinTotalFare'=>$AirItinTotalFare,'AirItinBaseFare'=>$AirItinBaseFare,'AirItinCommission'=>$AirItinCommission,
						
						'AdultCount'=>$AdultCount,'AdultTotalFare'=>$AdultTotalFare,'AdultBaseFare'=>$AdultBaseFare,'AdultTransactionFee'=>$AdultTransactionFee,'AdultBookingFee'=>$AdultBookingFee,'AdultServiceTax'=>$AdultServiceTax,
						'AdultAirTaxesYQ_Amount'=>$AdultAirTaxesYQ_Amount,'AdultAirTaxesWO_Amount'=>$AdultAirTaxesWO_Amount,'AdultAirTaxesIN_Amount'=>$AdultAirTaxesIN_Amount,'AdultAirTaxesJN_Amount'=>$AdultAirTaxesJN_Amount,'AdultAirTaxesYR_Amount'=>$AdultAirTaxesYR_Amount,
						
						'ChildCount'=>$ChildCount,'ChildTotalFare'=>$ChildTotalFare,'ChildBaseFare'=>$ChildBaseFare,'ChildTransactionFee'=>$ChildTransactionFee,'ChildBookingFee'=>$ChildBookingFee,'ChildServiceTax'=>$ChildServiceTax,
						'ChildAirTaxesYQ_Amount'=>$ChildAirTaxesYQ_Amount,'ChildAirTaxesWO_Amount'=>$ChildAirTaxesWO_Amount,'ChildAirTaxesIN_Amount'=>$ChildAirTaxesIN_Amount,'ChildAirTaxesJN_Amount'=>$ChildAirTaxesJN_Amount,'ChildAirTaxesYR_Amount'=>$ChildAirTaxesYR_Amount,
						
						'InfantCount'=>$InfantCount,'InfantTotalFare'=>$InfantTotalFare,'InfantBaseFare'=>$InfantBaseFare,'InfantTransactionFee'=>$InfantTransactionFee,'InfantBookingFee'=>$InfantBookingFee,'InfantServiceTax'=>$InfantServiceTax,
						'InfantAirTaxesYQ_Amount'=>$InfantAirTaxesYQ_Amount,'InfantAirTaxesWO_Amount'=>$InfantAirTaxesWO_Amount,'InfantAirTaxesIN_Amount'=>$InfantAirTaxesIN_Amount,'InfantAirTaxesJN_Amount'=>$InfantAirTaxesJN_Amount,'InfantAirTaxesYR_Amount'=>$InfantAirTaxesYR_Amount,
						
						'ItineraryCurrency'=>$ItineraryCurrency,'ItinTotalFare'=>$ItinTotalFare,'ItinServiceTax'=>$ItinServiceTax,'ItinCommission'=>$ItinCommission);
						//echo 'fafsd<pre>';print_r($data);exit;
					  }
						if($ResultType =='onward')
						{
						$data = array('SearchFormData'=>$SearchFormData,'FlightSessionId '=>$flight_session,'ResultType'=>$ResultType,'CartBookingId'=>0,'CartFormData'=>0,
												
						'DepartureAirportOutbound'=>$DepartureAirport,'ArrivalAirportOutbound'=>$ArrivalAirport,'OperatingAirlineOutbound'=>$OperatingAirline,'MarketingAirlineOutbound'=>$MarketingAirline,'ValidatingAirlineOutbound'=>$ValidatingAirline,'FlightNumberOutbound'=>$FlightNumber,'DepartureDateTimeOutbound'=>$DepartureDateTime,'ArrivalDateTimeOutbound'=>$ArrivalDateTime,'ETicketEligibilityOutbound'=>$ETicketEligibility,'FareTypeOutbound'=>$FareType,'CabinClassOutbound'=>$CabinClass,'BookingClassOutbound'=>$BookingClass,'JourneyTimeOutbound'=>$JourneyTime,
												
						'OptionFormData'=>$OptionFormData,'AirItineraryCurrency'=>$AirItineraryCurrency,'AirItinTotalFare'=>$AirItinTotalFare,'AirItinBaseFare'=>$AirItinBaseFare,'AirItinCommission'=>$AirItinCommission,
						
						'AdultCount'=>$AdultCount,'AdultTotalFare'=>$AdultTotalFare,'AdultBaseFare'=>$AdultBaseFare,'AdultTransactionFee'=>$AdultTransactionFee,'AdultBookingFee'=>$AdultBookingFee,'AdultServiceTax'=>$AdultServiceTax,
						'AdultAirTaxesYQ_Amount'=>$AdultAirTaxesYQ_Amount,'AdultAirTaxesWO_Amount'=>$AdultAirTaxesWO_Amount,'AdultAirTaxesIN_Amount'=>$AdultAirTaxesIN_Amount,'AdultAirTaxesJN_Amount'=>$AdultAirTaxesJN_Amount,'AdultAirTaxesYR_Amount'=>$AdultAirTaxesYR_Amount,
						
						'ChildCount'=>$ChildCount,'ChildTotalFare'=>$ChildTotalFare,'ChildBaseFare'=>$ChildBaseFare,'ChildTransactionFee'=>$ChildTransactionFee,'ChildBookingFee'=>$ChildBookingFee,'ChildServiceTax'=>$ChildServiceTax,
						'ChildAirTaxesYQ_Amount'=>$ChildAirTaxesYQ_Amount,'ChildAirTaxesWO_Amount'=>$ChildAirTaxesWO_Amount,'ChildAirTaxesIN_Amount'=>$ChildAirTaxesIN_Amount,'ChildAirTaxesJN_Amount'=>$ChildAirTaxesJN_Amount,'ChildAirTaxesYR_Amount'=>$ChildAirTaxesYR_Amount,
						
						'InfantCount'=>$InfantCount,'InfantTotalFare'=>$InfantTotalFare,'InfantBaseFare'=>$InfantBaseFare,'InfantTransactionFee'=>$InfantTransactionFee,'InfantBookingFee'=>$InfantBookingFee,'InfantServiceTax'=>$InfantServiceTax,
						'InfantAirTaxesYQ_Amount'=>$InfantAirTaxesYQ_Amount,'InfantAirTaxesWO_Amount'=>$InfantAirTaxesWO_Amount,'InfantAirTaxesIN_Amount'=>$InfantAirTaxesIN_Amount,'InfantAirTaxesJN_Amount'=>$InfantAirTaxesJN_Amount,'InfantAirTaxesYR_Amount'=>$InfantAirTaxesYR_Amount,
						
						'ItineraryCurrency'=>$ItineraryCurrency,'ItinTotalFare'=>$ItinTotalFare,'ItinServiceTax'=>$ItinServiceTax,'ItinCommission'=>$ItinCommission);
					  }
					     if($ResultType =='return')
						{
						$data = array('SearchFormData'=>$SearchFormData,'FlightSessionId '=>$flight_session,'ResultType'=>$ResultType,'CartBookingId'=>0,'CartFormData'=>0,
												
						'DepartureAirportInbound'=>$DepartureAirport,'ArrivalAirportInbound'=>$ArrivalAirport,'OperatingAirlineInbound'=>$OperatingAirline,'MarketingAirlineInbound'=>$MarketingAirline,'ValidatingAirlineInbound'=>$ValidatingAirline,'FlightNumberInbound'=>$FlightNumber,'DepartureDateTimeInbound'=>$DepartureDateTime,'ArrivalDateTimeInbound'=>$ArrivalDateTime,'ETicketEligibilityInbound'=>$ETicketEligibility,'FareTypeInbound'=>$FareType,'CabinClassInbound'=>$CabinClass,'BookingClassInbound'=>$BookingClass,'JourneyTimeInbound'=>$JourneyTime,
												
						'OptionFormData'=>$OptionFormData,'AirItineraryCurrency'=>$AirItineraryCurrency,'AirItinTotalFare'=>$AirItinTotalFare,'AirItinBaseFare'=>$AirItinBaseFare,'AirItinCommission'=>$AirItinCommission,
						
						'AdultCount'=>$AdultCount,'AdultTotalFare'=>$AdultTotalFare,'AdultBaseFare'=>$AdultBaseFare,'AdultTransactionFee'=>$AdultTransactionFee,'AdultBookingFee'=>$AdultBookingFee,'AdultServiceTax'=>$AdultServiceTax,
						'AdultAirTaxesYQ_Amount'=>$AdultAirTaxesYQ_Amount,'AdultAirTaxesWO_Amount'=>$AdultAirTaxesWO_Amount,'AdultAirTaxesIN_Amount'=>$AdultAirTaxesIN_Amount,'AdultAirTaxesJN_Amount'=>$AdultAirTaxesJN_Amount,'AdultAirTaxesYR_Amount'=>$AdultAirTaxesYR_Amount,
						
						'ChildCount'=>$ChildCount,'ChildTotalFare'=>$ChildTotalFare,'ChildBaseFare'=>$ChildBaseFare,'ChildTransactionFee'=>$ChildTransactionFee,'ChildBookingFee'=>$ChildBookingFee,'ChildServiceTax'=>$ChildServiceTax,
						'ChildAirTaxesYQ_Amount'=>$ChildAirTaxesYQ_Amount,'ChildAirTaxesWO_Amount'=>$ChildAirTaxesWO_Amount,'ChildAirTaxesIN_Amount'=>$ChildAirTaxesIN_Amount,'ChildAirTaxesJN_Amount'=>$ChildAirTaxesJN_Amount,'ChildAirTaxesYR_Amount'=>$ChildAirTaxesYR_Amount,
						
						'InfantCount'=>$InfantCount,'InfantTotalFare'=>$InfantTotalFare,'InfantBaseFare'=>$InfantBaseFare,'InfantTransactionFee'=>$InfantTransactionFee,'InfantBookingFee'=>$InfantBookingFee,'InfantServiceTax'=>$InfantServiceTax,
						'InfantAirTaxesYQ_Amount'=>$InfantAirTaxesYQ_Amount,'InfantAirTaxesWO_Amount'=>$InfantAirTaxesWO_Amount,'InfantAirTaxesIN_Amount'=>$InfantAirTaxesIN_Amount,'InfantAirTaxesJN_Amount'=>$InfantAirTaxesJN_Amount,'InfantAirTaxesYR_Amount'=>$InfantAirTaxesYR_Amount,
						
						'ItineraryCurrency'=>$ItineraryCurrency,'ItinTotalFare'=>$ItinTotalFare,'ItinServiceTax'=>$ItinServiceTax,'ItinCommission'=>$ItinCommission);
					  }
					
									
					
					}					
						$this->Flights_Model->insert_flight_results($data);
					  }
				  }
				
			 }
			 //echo '<pre>';print_r($PricedItineraries);exit;
		 }
		 
		redirect("flights/load_search_results");
		 
	}

    // Converting arry details for display and filter for Round_Trip_Calendar
    public function fetch_flight_search_result_Round_Trip_Calendar($data) 
    {
       //echo 'hiiii';exit;
        $flight_result = $data['flight_result'];
        $_SESSION['flight_result1_calender'] = $flight_result;
		
		//echo '<pre>';print_r($flight_result);exit;
        $data2 = "";$data4 = "";$testing = "";
        if ($flight_result != '') {
            $count_val = count($flight_result);
            $i = 0;$total = 0;
            foreach ($flight_result as $flight_result1) {
                $count_code = count($flight_result1['oneWay']['marketingCarrier']);
				
                if ($count_code <= 1) {
                    $name = $this->Flights_Model->get_flight_name($flight_result1['oneWay']['marketingCarrier']);
                    if ($name != '') {
                        $testing['oneway'][$i]['cicode'] = $flight_result1['oneWay']['marketingCarrier']['value'];
                        $testing['oneway'][$i]['eft'] = $flight_result1['oneWay']['eft']['value'];
                        $testing['oneway'][$i]['name'] = $name;
						//echo '<pre>dfddfdf';print_r($testing['oneway'][$i]['name']);exit;
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
                        
                        // $hours_eft = floor(($flight_result1['oneWay']['eft']) / 60);
						// $day_eft = floor(($flight_result1['oneWay']['eft']) / 1440);
						// $minutes_eft = (($flight_result1['oneWay']['eft']) % 60);
						// $testing['oneway'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
						
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
                        //$testing['oneway'][$i]['designator']=$flight_result1['Recomm']['paxFareProduct']['designator'];
                        $testing['oneway'][$i]['stops'] = "0";
                        $testing['oneway'][$i]['flag'] = "false";
                        $testing['oneway'][$i]['MultiTicket']=$flight_result1['MultiTicket'];
                        $testing['oneway'][$i]['rand_id'] = $rand_id;

                        //Markup Values
                        //$adminmarkup = $this->Flight_Model->get_adminmarkup();
                        $adminmarkupvalue =0;// $adminmarkup->markup;
                        //$pg = $this->Flight_Model->get_pgmarkup();
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
						
						$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($dep_code); 
						
						$testing['oneway'][$i]['dep_time_zone_offset'] = $country_time_zone_offset;
						
						$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($arv_code); 
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
						$testing['oneway'][$i]['duration_time_zone'] = $duration_time_zone;
						$testing['oneway'][$i]['Clock_Changes']=$Change_clock;
						
						
						//~ if ($days > 0)
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
						//~ else
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
						

						$testing['oneway'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
						// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
						
						

                        $i++;
                    }
                } else {
                    $testing['oneway'][$i]['dur_in_min'] = "";
                    $h = 0;
                    $m = 0;
                    $total = 0;
                    for ($j = 0; $j < ($count_code); $j++) {
                        $name = $this->Flights_Model->get_flight_name($flight_result1['oneWay']['marketingCarrier'][$j]);
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

                           
                            // $hours_eft = floor(($flight_result1['oneWay']['eft']) / 60);
							// $day_eft = floor(($flight_result1['oneWay']['eft']) / 1440);
							// $minutes_eft = (($flight_result1['oneWay']['eft']) % 60);
							// $testing['oneway'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
                             
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

                            //$total=(($flight_result1['Recomm']['totalFareAmount'])+($flight_result1['Recomm']['totalTaxAmount']));
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

                            //Markup Values
                           // $adminmarkup = $this->Flight_Model->get_adminmarkup();
                            $adminmarkupvalue = 0;//$adminmarkup->markup;
                           // $pg = $this->Flight_Model->get_pgmarkup();
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
							
							$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($dep_code); 
							$testing['oneway'][$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($arv_code); 
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
							
							
							//~ if ($days > 0)
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
							//~ else
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
							

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
				//echo 'fgdfgd'.$count_code;exit;
                if ($count_code <= 1) {
                    $name = $this->Flights_Model->get_flight_name($flight_result2['Return']['marketingCarrier']);
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
                        
                        // $hours_eft = floor(($flight_result2['Return']['eft']) / 60);
						// $day_eft = floor(($flight_result2['Return']['eft']) / 1440);
						// $minutes_eft = (($flight_result2['Return']['eft']) % 60);
						// $testing['Return'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
						
						$eft_final = str_split($flight_result2['Return']['eft']['value'],2);
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
						
						$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($dep_code); 
						$testing['Return'][$i]['dep_time_zone_offset'] = $country_time_zone_offset;
						
						$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($arv_code); 
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
                        $name = $this->Flights_Model->get_flight_name($flight_result2['Return']['marketingCarrier'][$j]);
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
                            
                            // $hours_eft = floor(($flight_result2['Return']['eft']) / 60);
							// $day_eft = floor(($flight_result2['Return']['eft']) / 1440);
							// $minutes_eft = (($flight_result2['Return']['eft']) % 60);
							// $testing['Return'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
							
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
							
							$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($dep_code); 
							$testing['Return'][$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($arv_code); 
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
			 $calanderData=$this->load->view('flights/search_result_ajax', $data, true);
		 echo $calanderData;
		} 
    }
	function flight_result_calender(){
	$data['flight_result']=$_SESSION['flight_result'];
	$this->load->view('search_result_ajax_roundtrip_calendar', $data);
	}
    // Converting arry details for display and filter for Multicity
    public function fetch_flight_search_result_multicity($data, $rand_id) 
    {

        $flight_result = '';
        $flight_result1 = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result1;
        
        $data2 = "";$data4 = "";$h=0;
        if(!empty($flight_result1)){
			foreach ($flight_result1 as $recom) 
			{
				$flight_result[$h++]=$recom;
			}
		}    
        $testing = "";$f = 0;
        if ($flight_result != '') {
            foreach ($flight_result as $recom1) {
                $flight_result[$f++] = $recom1;
            }
        }
		$_SESSION['flight_result_details'] = $flight_result;
		if ($flight_result != '') {
            $count_val = (count($flight_result));
            $i = 0;
            $total = 0;
            $r = 0;
            foreach ($flight_result as $recom) {
                $kk = 0;
                foreach ($recom as $groupofflights) {
                    $jj = 0;
                    foreach ($groupofflights as $flights) {
                        $count_code = count($flights['marketingCarrier']);
                        if ($count_code <= 1) {
                            $name = $this->Flight_Model->get_flight_name($flights['marketingCarrier']);
                            if ($name != '') {
                                $testing[$i]['multi'][$jj]['cicode'] = $flights['marketingCarrier'];
                                $testing[$i]['multi'][$jj]['name'] = $name;
                                $testing[$i]['multi'][$jj]['fnumber'] = $flights['flightOrtrainNumber'];
                                $testing[$i]['multi'][$jj]['dlocation'] = $flights['locationIdDeparture'];
                                $testing[$i]['multi'][$jj]['alocation'] = $flights['locationIdArival'];
                                $testing[$i]['multi'][$jj]['timeOfDeparture'] = $flights['timeOfDeparture'];
                                $testing[$i]['multi'][$jj]['timeOfArrival'] = $flights['timeOfArrival'];
                                $testing[$i]['multi'][$jj]['equipmentType'] = $flights['equipmentType'];

                                
                                // $hours_eft = floor(($flights['eft']) / 60);
								// $day_eft = floor(($flights['eft']) / 1440);
								// $minutes_eft = (($flights['eft']) % 60);
								// $testing[$i]['multi'][$jj]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
								
								$eft_final = str_split($flights['eft'],2);
								if($_SESSION['lang']=='en')
									$testing[$i]['multi'][$jj]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
								else
									$testing[$i]['multi'][$jj]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
                                
                                $departureDate = $flights['dateOfDeparture'];
                                $departureTime = $flights['timeOfDeparture'];
                                $arrivalDate = $flights['dateOfArrival'];
                                $arrivalTime = $flights['timeOfArrival'];

                                if (($departureTime <= "0700") && ($arrivalTime >= "2000"))
                                    $testing[$i]['multi'][$jj]['redeye'] = "Yes";
                                else
                                    $testing[$i]['multi'][$jj]['redeye'] = "No";
								
								$testing[$i]['multi'][$jj]['dtime_filter'] = $departureTime;
                                $testing[$i]['multi'][$jj]['atime_filter'] = $arrivalTime;

                                $testing[$i]['multi'][$jj]['ddate'] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                                $testing[$i]['multi'][$jj]['adate'] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

								//Final Duration Part
                                $testing[$i]['multi'][$jj]['ddate1'] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                                $testing[$i]['multi'][$jj]['adate1'] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                                $date_a = new DateTime($testing[$i]['multi'][$jj]['ddate1']);
                                $date_b = new DateTime($testing[$i]['multi'][$jj]['adate1']);
                                $interval = date_diff($date_a, $date_b);
                                $testing[$i]['multi'][$jj]['duration_final'] = $interval->format('%h hours %i minutes');
                                $testing[$i]['multi'][$jj]['duration_final1'] = $interval->format('%h h %i m');

                                $hour = $interval->format('%h');
                                $min = $interval->format('%i');
                                $dur_in_min = (($hour * 60) + $min);
                                $testing[$i]['multi'][$jj]['dur_in_min'] = $dur_in_min;

                                //$total=(($flights['totalFareAmount'])+($flights['totalTaxAmount']));
                                $total = (($flights['totalFareAmount']));
                                $testing[$i]['multi'][$jj]['pamount'] = $total;
                                $testing[$i]['multi'][$jj]['FareAmount'] = $flights['totalFareAmount'];
                                $testing[$i]['multi'][$jj]['TaxAmount'] = $flights['totalTaxAmount'];
                                $testing[$i]['multi'][$jj]['ccode'] = $data['currency'];
                                $testing[$i]['multi'][$jj]['id'] = $i;
                                $testing[$i]['multi'][$jj]['seg_id'] = $kk;
                                $testing[$i]['multi'][$jj]['recom'] = $r;
                                //$testing[$i]['multi'][$j]['designator']=$flights['designator'];
                                $testing[$i]['multi'][$jj]['stops'] = "0";
                                $testing[$i]['multi'][$jj]['flag'] = "false";
                                $testing[$i]['multi'][$jj]['rand_id'] = $rand_id;

                                //Markup Values
                               // $adminmarkup = $this->Flight_Model->get_adminmarkup();
                                $adminmarkupvalue =0;// $adminmarkup->markup;
                                //$pg = $this->Flight_Model->get_pgmarkup();
                                $pgvalue = 0;//$pg->charge;

                                $testing[$i]['multi'][$jj]['admin_markup'] = $adminmarkupvalue;
                                $testing[$i]['multi'][$jj]['payment_charge'] = $pgvalue;

                                $API_FareAmount = $total;
                                $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                                $markup1 = $API_FareAmount + $admin_markup;
                                $pg_charge = ($markup1 * $pgvalue) / 100;
                                $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                                $total_markup = $admin_markup + $pg_charge;
                                $testing[$i]['multi'][$jj]['Total_FareAmount'] = $Total_FareAmount;
                                
                                if (isset($flights['paxFareProduct'][0]['rbd'])) {
									$testing[$i]['multi'][$jj]['BookingClass'] = $flights['paxFareProduct'][0]['rbd'];
									$testing[$i]['multi'][$jj]['cabin'] = $flights['paxFareProduct'][0]['cabin'];
								} else {
									$testing[$i]['multi'][$jj]['BookingClass'] = $flights['paxFareProduct']['rbd'];
									$testing[$i]['multi'][$jj]['cabin'] = $flights['paxFareProduct']['cabin'];
								}
								
								 // Time Zone Related Code
								$country_time_zone_offset_dep = $this->Flight_Model->get_time_zone_details($testing[$i]['multi'][$jj]['dlocation']); 
								$testing[$i]['multi'][$jj]['dep_time_zone_offset'] = $country_time_zone_offset_dep;
								
								$country_time_zone_offset_arv = $this->Flight_Model->get_time_zone_details($testing[$i]['multi'][$jj]['alocation']); 
								$testing[$i]['multi'][$jj]['arv_time_zone_offset'] = $country_time_zone_offset_arv;
								
								$ddate = ''; $adate = '';
								$ddate = $testing[$i]['multi'][$jj]['ddate1'];
								$adate = $testing[$i]['multi'][$jj]['adate1'];
								
								
								$dep_zone = explode(":",($testing[$i]['multi'][$jj]['dep_time_zone_offset']));
								$arv_zone = explode(":",($testing[$i]['multi'][$jj]['arv_time_zone_offset']));
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
								$testing[$i]['multi'][$jj]['duration_time_zone'] = $duration_time_zone;
								$testing[$i]['multi'][$jj]['Clock_Changes']=$Change_clock;
								
								
								//~ if ($days > 0)
									//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
								//~ else
									//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
								

								$testing[$i]['multi'][$jj]['dur_in_min_time_zone'] = $dur_in_min;
								// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                        

                            }
                        }
                        else {
                            $testing[$i]['multi'][$jj]['dur_in_min'] = "";
                            $testing[$i]['multi'][$jj]['pamount'] = "";
                            $flag_marketingCarrier_set_true = false;
                            $flag_marketingCarrier_set_false = true;
                            $h = 0;$m = 0;$total = 0;
                            for ($j = 0; $j < ($count_code); $j++) {
                                $name = $this->Flight_Model->get_flight_name($flights['marketingCarrier'][$j]);
                                if ($name != '') {
                                    $testing[$i]['multi'][$jj]['cicode'][$j] = $flights['marketingCarrier'][$j];
                                    $testing[$i]['multi'][$jj]['name'][$j] = $name;
                                    $testing[$i]['multi'][$jj]['fnumber'][$j] = $flights['flightOrtrainNumber'][$j];
                                    $testing[$i]['multi'][$jj]['dlocation'][$j] = $flights['locationIdDeparture'][$j];
                                    $testing[$i]['multi'][$jj]['alocation'][$j] = $flights['locationIdArival'][$j];
                                    $testing[$i]['multi'][$jj]['timeOfDeparture'][$j] = $flights['timeOfDeparture'][$j];
                                    $testing[$i]['multi'][$jj]['timeOfArrival'][$j] = $flights['timeOfArrival'][$j];
                                    $departureDate = $flights['dateOfDeparture'][$j];
                                    $departureTime = $flights['timeOfDeparture'][$j];
                                    $arrivalDate = $flights['dateOfArrival'][$j];
                                    $arrivalTime = $flights['timeOfArrival'][$j];

                                    // $hours_eft = floor(($flights['eft']) / 60);
									// $day_eft = floor(($flights['eft']) / 1440);
									// $minutes_eft = (($flights['eft']) % 60);
									// $testing[$i]['multi'][$jj]['duration_final_eft'][$j] = $hours_eft."H ".$minutes_eft."M";
                                    
                                    $eft_final = str_split($flights['eft'],2);
                                    if($_SESSION['lang']=='en')
										$testing[$i]['multi'][$jj]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
									else
										$testing[$i]['multi'][$jj]['duration_final_eft'] = $eft_final[0]." t ".$eft_final[1]." min";
                                    
                                    $testing[$i]['multi'][$jj]['dtime_filter'] = $flights['timeOfDeparture'][0];
                                    $testing[$i]['multi'][$jj]['atime_filter'] = $arrivalTime;
									$testing[$i]['multi'][$jj]['equipmentType'] = $flights['equipmentType'];
									
                                    if ((($flights['timeOfDeparture'][0]) <= "0700") && ($arrivalTime >= "2000"))
                                        $testing[$i]['multi'][$jj]['redeye'] = "Yes";
                                    else
                                        $testing[$i]['multi'][$jj]['redeye'] = "No";

                                    $testing[$i]['multi'][$jj]['ddate'][$j] = ((substr("$departureDate", 0, -4)) . "/" . (substr("$departureDate", -4, 2)) . "/" . (substr("$departureDate", -2))) . "(" . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . ")";
                                    $testing[$i]['multi'][$jj]['adate'][$j] = ((substr("$arrivalDate", 0, -4)) . "/" . (substr("$arrivalDate", -4, 2)) . "/" . (substr("$arrivalDate", -2))) . "(" . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . ")";

                                    //Final Duration Part
                                    $testing[$i]['multi'][$jj]['ddate1'][$j] = ((substr("$departureDate", 0, -4)) . "-" . (substr("$departureDate", -4, 2)) . "-" . (substr("$departureDate", -2))) . " " . ((substr("$departureTime", 0, -2)) . ":" . (substr("$departureTime", -2))) . "";
                                    $testing[$i]['multi'][$jj]['adate1'][$j] = ((substr("$arrivalDate", 0, -4)) . "-" . (substr("$arrivalDate", -4, 2)) . "-" . (substr("$arrivalDate", -2))) . " " . ((substr("$arrivalTime", 0, -2)) . ":" . (substr("$arrivalTime", -2))) . "";
                                    $date_a = new DateTime($testing[$i]['multi'][$jj]['ddate1'][$j]);
                                    $date_b = new DateTime($testing[$i]['multi'][$jj]['adate1'][$j]);
                                    $interval = date_diff($date_a, $date_b);
                                    $testing[$i]['multi'][$jj]['duration_final'][$j] = $interval->format('%h hours %i minutes');
                                    $testing[$i]['multi'][$jj]['duration_final1'][$j] = $interval->format('%h h %i m');

                                    $hour = $interval->format('%h');
                                    $min = $interval->format('%i');
                                    $dur_in_min = (($hour * 60) + $min);
                                    $testing[$i]['multi'][$jj]['dur_in_min']+= $dur_in_min;

                                    if ($j != ($count_code - 1)) {
                                        $arrivalDate_layover = $flights['dateOfArrival'][$j];
                                        $arrivalTime_layover = $flights['timeOfArrival'][$j];
                                        $departureDate_layover = $flights['dateOfDeparture'][($j + 1)];
                                        $departureTime_layover = $flights['timeOfDeparture'][($j + 1)];
                                        
                                        $depart_layover = ((substr("$arrivalDate_layover", 0, -4)) . "-" . (substr("$arrivalDate_layover", -4, 2)) . "-" . (substr("$arrivalDate_layover", -2))) . " " . ((substr("$arrivalTime_layover", 0, -2)) . ":" . (substr("$arrivalTime_layover", -2))) . "";
                                        $arival_layover = ((substr("$departureDate_layover", 0, -4)) . "-" . (substr("$departureDate_layover", -4, 2)) . "-" . (substr("$departureDate_layover", -2))) . " " . ((substr("$departureTime_layover", 0, -2)) . ":" . (substr("$departureTime_layover", -2))) . "";
                                        $date_c = new DateTime($depart_layover);
                                        $date_d = new DateTime($arival_layover);
                                        $interval_layover = date_diff($date_c, $date_d);
                                        
                                        $testing[$i]['multi'][$jj]['duration_final_layover'][$j] = $interval_layover->format('%h hours %i minutes');

                                        $hour_layover = $interval_layover->format('%h');
                                        $min_layover = $interval_layover->format('%i');
                                        $dur_in_min_layover = (($hour_layover * 60) + $min_layover);
                                        $testing[$i]['multi'][$jj]['dur_in_min_layover'][$j] = $dur_in_min_layover;
                                    } else {
                                        $testing[$i]['multi'][$jj]['duration_final_layover'][$j] = '';
                                        $testing[$i]['multi'][$jj]['dur_in_min_layover'][$j] = '';
                                    }

                                    if ($flights['marketingCarrier'][0] != $flights['marketingCarrier'][$j])
                                        $flag_marketingCarrier_set_true = true;
                                    else
                                        $flag_marketingCarrier_set_flag = false;

                                    if ($flag_marketingCarrier_set_true == true)
                                        $testing[$i]['multi'][$jj]['flag_marketingCarrier'] = true;
                                    else
                                        $testing[$i]['multi'][$jj]['flag_marketingCarrier'] = false;

                                    if ((!isset($flights['totalFareAmount'])) && (!isset($flights['totalTaxAmount'])))
                                        $total = 0;
                                    else
                                        $total = (($flights['totalFareAmount']));
                                    //$total=(($flights['totalFareAmount'])+($flights['totalTaxAmount']));
                                    $testing[$i]['multi'][$jj]['pamount'] = $total;
                                    $testing[$i]['multi'][$jj]['FareAmount'] = $flights['totalFareAmount'];
                                    $testing[$i]['multi'][$jj]['TaxAmount'] = $flights['totalTaxAmount'];
                                    $testing[$i]['multi'][$jj]['ccode'] = $data['currency'];
                                    $testing[$i]['multi'][$jj]['id'] = $i;
                                    $testing[$i]['multi'][$jj]['recom'] = $r;
                                    $testing[$i]['multi'][$jj]['seg_id'] = $kk;
                                    if (!isset($flights['designator']))
                                        $testing[$i]['multi'][$jj]['designator'] = "";
                                    else
                                        $testing[$i]['multi'][$jj]['designator'] = $flights['designator'];
                                    $testing[$i]['multi'][$jj]['stops'] = ($count_code - 1);
                                    $testing[$i]['multi'][$jj]['flag'] = "true";
                                    $testing[$i]['multi'][$jj]['rand_id'] = $rand_id;

                                    //Markup Values
                                   // $adminmarkup = $this->Flight_Model->get_adminmarkup();
                                    $adminmarkupvalue =0;// $adminmarkup->markup;
                                   // $pg = $this->Flight_Model->get_pgmarkup();
                                    $pgvalue = 0;//$pg->charge;

                                    $testing[$i]['multi'][$jj]['admin_markup'] = $adminmarkupvalue;
                                    $testing[$i]['multi'][$jj]['payment_charge'] = $pgvalue;
                                    
                                    $API_FareAmount = $total;
                                    $admin_markup = ($API_FareAmount * $adminmarkupvalue) / 100;
                                    $markup1 = $API_FareAmount + $admin_markup;
                                    $pg_charge = ($markup1 * $pgvalue) / 100;
                                    $Total_FareAmount = $API_FareAmount + $admin_markup + $pg_charge;
                                    $total_markup = $admin_markup + $pg_charge;
                                    $testing[$i]['multi'][$jj]['Total_FareAmount'] = $Total_FareAmount;
                                    if (isset($flights['paxFareProduct'][0]['rbd'])) {
										$testing[$i]['multi'][$jj]['BookingClass'][$j] = $flights['paxFareProduct'][0]['rbd'][$j];
										$testing[$i]['multi'][$jj]['cabin'][$j] = $flights['paxFareProduct'][0]['cabin'][$j];
									} else {
										$testing[$i]['multi'][$jj]['BookingClass'][$j] = $flights['paxFareProduct']['rbd'][$j];
										$testing[$i]['multi'][$jj]['cabin'][$j] = $flights['paxFareProduct']['cabin'][$j];
									}
									
									// Time Zone Related Code
									$country_time_zone_offset_dep = $this->Flight_Model->get_time_zone_details($testing[$i]['multi'][$jj]['dlocation'][$j]); 
									$testing[$i]['multi'][$jj]['dep_time_zone_offset'][$j] = $country_time_zone_offset_dep;
									
									$country_time_zone_offset_arv = $this->Flight_Model->get_time_zone_details($testing[$i]['multi'][$jj]['alocation'][$j]); 
									$testing[$i]['multi'][$jj]['arv_time_zone_offset'][$j] = $country_time_zone_offset_arv;
									
									$ddate = ''; $adate = '';
									$ddate = $testing[$i]['multi'][$jj]['ddate1'][$j];
									$adate = $testing[$i]['multi'][$jj]['adate1'][$j];
									
									
									$dep_zone = explode(":",($testing[$i]['multi'][$jj]['dep_time_zone_offset'][$j]));
									$arv_zone = explode(":",($testing[$i]['multi'][$jj]['arv_time_zone_offset'][$j]));
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
									$testing[$i]['multi'][$jj]['duration_time_zone'][$j] = $duration_time_zone;
									$testing[$i]['multi'][$jj]['Clock_Changes'][$j]=$Change_clock;
									
									$testing[$i]['multi'][$jj]['dur_in_min_time_zone'][$j] = $dur_in_min;
									// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                        
									
                                }
                            }
                        }

                        $jj++;
                    }
                    $kk++;
                    $i++;
                }
                $r++;
            }
        }
        echo '<pre/>';print_r($testing);exit;
        $data['flight_result'] = $testing;
        $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
        
        $flight_result_segment_new = array();
        if ($testing != '') 
        {            
            $newindex = 0;          
            for($i = 0; $i < count($testing[0]['multi']); ++$i)
            {
                foreach ($testing as $recom) 
                {                                       
                        foreach ($recom as $groupofflights) 
                        {
                            $flight_result_segment_new[$newindex][]  = $groupofflights[$newindex];                   
                        }
                }
                $newindex++;
            }
        }        
        $min_amount = "";$min_duration = "";$max_amount = "";$max_duration = "";
        $data['flight_result'] = $testing;
        $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
        if (true) {          
            
            
		if(!empty($_SESSION['lang']))
		{
			if($_SESSION['lang']=='en')
			{
				$flight_search_result = $this->load->view('flight/search_result_ajax_multicity', $data, true);
			}
			else
			{
				$flight_search_result = $this->load->view('flight/danish/search_result_ajax_multicity', $data, true);
			}
		}
		else
		{
			$flight_search_result = $this->load->view('flight/search_result_ajax_multicity', $data, true);
		}            
            
            
            $max_duration_segment = array();$max_time_departure = array();$min_time_departure = array();$max_time_arival = array();
            $min_amount_segment = array();$max_amount_segment = array();$min_duration_segment = array();$min_time_departure_segment = array();
            $min_time_departure_segment = array();$airlines = array();$stops = array();$min_time_arival = array();
            for ($i=0; $i < count($flight_result_segment_new); $i++) { 
                //price slider
                $minmxprice_segment = $flight_result_segment_new[$i];
                $usernames = array();
                foreach ($minmxprice_segment as $user) 
                {
                   $usernames[] = $user['Total_FareAmount'];
                }
                array_multisort($usernames, SORT_ASC, $minmxprice_segment);
                
                $count = (count($minmxprice_segment));
                $min_amount_segment[] = ($minmxprice_segment[0]['Total_FareAmount']);
                $max_amount_segment[] = ($minmxprice_segment[($count - 1)]['Total_FareAmount']);  
                
                //duration slider
				$minmxdur_segment = $flight_result_segment_new[$i];
				$usernames = array();
				foreach ($minmxdur_segment as $user) 
				{
					$usernames[] = $user['dur_in_min'];
				}

				array_multisort($usernames, SORT_ASC, $minmxdur_segment);
				$count = count($minmxdur_segment);
				$min_duration_segment[] = $minmxdur_segment[0]['dur_in_min'];
				$max_duration_segment[] = $minmxdur_segment[($count - 1)]['dur_in_min']; 
				
				//departure slider
				$minmxdtime_segment = $flight_result_segment_new[$i];
				$usernames = array();
				foreach ($minmxdtime_segment as $user) 
				{
					$usernames[] = $user['dtime_filter'];
				}

				array_multisort($usernames, SORT_ASC, $minmxdtime_segment);
				$count = count($minmxdtime_segment);
				$min_time_departure_segment[] = $minmxdtime_segment[0]['dtime_filter'];
				$max_time_departure_segment[] = $minmxdtime_segment[($count - 1)]['dtime_filter'];  
				
				//airline
				$result_name = array();$ai = 0;
				foreach ($flight_result_segment_new[$i] as $p => $v) 
				{
					if (count($v['name']) <= 1)
						$result_name[$ai++] = $v['name'];
					else
						$result_name[$ai++] = $v['name'][0];
				}

				$name_array = array_unique($result_name);
				$aa = 0;
				foreach ($name_array as $result) 
				{
					$airlines[$i][$aa++] = $result;
				} 
				
				//no of stops
				$st = 0;
				$result_stops = array();
				foreach ($flight_result_segment_new[$i] as $p => $v) 
				{
					$result_stops[$st++] = $v['stops'];
				}
				$stop_array = array_unique($result_stops);
				$aa = 0;
				foreach ($stop_array as $result) 
				{
					$stops[$i][$aa++] = $result;
				}
				
				//arrival slider
				$minmxatime_segment = $flight_result_segment_new[$i];
				$usernames = array();
				foreach ($minmxatime_segment as $user) {
					$usernames[] = $user['atime_filter'];
				}

				array_multisort($usernames, SORT_ASC, $minmxatime_segment);
				$count = count($minmxatime_segment);
				$min_time_arival_segment[] = $minmxatime_segment[0]['atime_filter'];
				$max_time_arival_segment[] = $minmxatime_segment[($count - 1)]['atime_filter'];
				
				$min_hours_ar = intval($min_time_arival_segment[$i] / 100);
				$min_min_ar = ($min_time_arival_segment[$i] % 100);
				$minInHours_ar = ($min_hours_ar * 60);
				$min_time_arival[] = $minInHours_ar + $min_min_ar;

				$max_hours_ar = intval($max_time_arival_segment[$i] / 100);
				$max_min_ar = ($max_time_arival_segment[$i] % 100);
				$maxInHours_ar = ($max_hours_ar * 60);
				$max_time_arival[] = $maxInHours_ar + $max_min_ar;


				$min_hours_de = intval($min_time_departure_segment[$i] / 100);
				$min_min_de = ($min_time_departure_segment[$i] % 100);
				$minInHours_de = ($min_hours_de * 60);
				$min_time_departure[] = $minInHours_de + $min_min_de;

				$max_hours_de = ($max_time_departure_segment[$i] / 100);
				$max_min_de = ($max_time_departure_segment[$i] % 100);
				$maxInHours_de = ($max_hours_de * 60);
				$max_time_departure[] = $maxInHours_de + $max_min_de;
				    
			}  

           
           
        }
		echo json_encode(array(
            'flight_search_result' => $flight_search_result,
            'min_flight_price_val' => $min_amount_segment,
            'max_flight_price_val' => $max_amount_segment,
            'min_flight_duration_val' => $min_duration_segment,
            'max_flight_duration_val' => $max_duration_segment,
            'min_flight_atime_val' => $min_time_arival,
            'max_flight_atime_val' => $max_time_arival,
            'min_flight_dtime_val' => $min_time_departure,
            'max_flight_dtime_val' => $max_time_departure,
            'airLine' => $airlines,
            'rand_id' => $rand_id,
            'stops' => $stops
        ));
    }

    // Converting arry details for display and filter for OneWay
	public function fetch_flight_search_result($data,$rand_id){
		
        $flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
       
        $data2 = "";$data4 = "";$testing = "";
     // echo 'hii<pre>';print_r($flight_result);exit;
        //Markup Values
		// Admin(Amadeus API) Based Markup Values
		//$adminmarkup = $this->Flight_Model->get_adminmarkup();
		$adminmarkupvalue =0;// $adminmarkup->markup;
		
		// Payment Gateway Based Markup Values
		//$pg = $this->Flight_Model->get_pgmarkup();
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
						
						
						// $hours_eft = floor(($flight_result['eft']) / 60);
						// $day_eft = floor(($flight_result['eft']) / 1440);
						// $minutes_eft = (($flight_result['eft']) % 60);
						// $testing[$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
						
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
						
						
						//~ if ($days > 0)
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
						//~ else
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
						

						$testing[$i]['dur_in_min_time_zone'] = $dur_in_min;
						// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                        

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
							//echo '<pre>hiii';print_r($date_a);
                            $testing[$i]['duration_final'][$j] = $interval->format('%h Hours %i Minutes');
                            
								$testing[$i]['duration_final1'][$j] = $interval->format('%h t %i min');
                            
                            // $hours_eft = floor(($flight_result['eft']) / 60);
							// $day_eft = floor(($flight_result['eft']) / 1440);
							// $minutes_eft = (($flight_result['eft']) % 60);
							// $testing[$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
							
							$eft_final = str_split($flight_result['eft']['value'],2);
							/*<!--if($_SESSION['lang']=='en')
								$testing[$i]['duration_final_eft'] = $eft_final[0]." h ".$eft_final[1]." min";
							else-->*/
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
                                /*if($_SESSION['lang']=='en')
									$testing[$i]['duration_final_layover'][$j] = $interval_layover->format('%h h %i min');
								else*/
									$testing[$i]['duration_final_layover'][$j] = $interval_layover->format('%h t %i min');
//echo '<prre>';print_r($testing[$i]['duration_final_layover'][$j]);
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

                            //$total=(($flight_result['totalFareAmount'])+($flight_result['totalTaxAmount']));
                            $testing[$i]['FareAmount'] = $flight_result['totalFareAmount']['value'];
                            $testing[$i]['TaxAmount'] = $flight_result['totalTaxAmount']['value'];
                            $testing[$i]['pamount'] = $total;
                            $testing[$i]['ccode'] = $data['currency'];
                            $testing[$i]['id'] = $i;
							//echo '<prre>';print_r($total);
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
                            //echo '<prre>';print_r($admin_markup);
                            if($airlinemarkup!='')
							{//echo '<prre>';print_r( $airlinemarkup);
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
						/*	if($_SESSION['lang']=='en')
							{
								if ($day > 0)
									$duration_time_zone=$day." D ".$hours." h ".$minutes." min";
								else
									$duration_time_zone=$hours." h ".$minutes." min";
							}
							else
							{		
							*/	if ($day > 0)
									$duration_time_zone=$day." D ".$hours." t ".$minutes." min";
								else
									$duration_time_zone=$hours." t ".$minutes." min";
							//}
							$testing[$i]['duration_time_zone'][$j] = $duration_time_zone;
							$testing[$i]['Clock_Changes'][$j]=$Change_clock;
							
							
							//~ if ($days > 0)
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
							//~ else
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
							

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
		//echo '<pre/>dfsdsdfssdfdfsd';print_r($data['flight_result']);exit;
        $_SESSION[$rand_id]['flight_result'] = $data['flight_result'];
        $_SESSION[$rand_id]['testing'] = $data['flight_result'];
		$_SESSION['flight_result_final']= $_SESSION[$rand_id]['testing'];
      // echo 'fgfgfdg'.$calanderData;exit;
		$this->load->view('search_result_ajax_oneway', $data);
    }
	function flight_result(){
		$data['flight_result_final']=$_SESSION['flight_result_final'];
		$this->load->view('flight/search_result', $data);		
		}
    public function fetch_flight_search_result1($data, $rand_id) 
    {
        $flight_result = $data['flight_result'];
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
        
        $data2 = "";$data4 = "";$testing = "";
        
        //Markup Values
		// Admin(Amadeus API) Based Markup Values

		//$adminmarkup = $this->Flight_Model->get_adminmarkup();
		$adminmarkupvalue = 0;//$adminmarkup->markup;
		
		// Payment Gateway Based Markup Values
		//$pg = $this->Flight_Model->get_pgmarkup();
		$pgvalue =0;// $pg->charge;
		
		// Airline Based Markup Values
		//$airlinemarkup = $this->Flight_Model->get_airlinemarkup();
		
		// Country Based Markup Values
		//$countrymarkup = $this->Flight_Model->get_countrymarkup();
		
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
						
						
						// $hours_eft = floor(($flight_result['eft']) / 60);
						// $day_eft = floor(($flight_result['eft']) / 1440);
						// $minutes_eft = (($flight_result['eft']) % 60);
						// $testing[$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
						
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
						
						
						//~ if ($days > 0)
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
						//~ else
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
						

						$testing[$i]['dur_in_min_time_zone'] = $dur_in_min;
						// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                        

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
                            
                            // $hours_eft = floor(($flight_result['eft']) / 60);
							// $day_eft = floor(($flight_result['eft']) / 1440);
							// $minutes_eft = (($flight_result['eft']) % 60);
							// $testing[$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
							
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
							$testing[$i]['duration_time_zone'][$j] = $duration_time_zone;
							$testing[$i]['Clock_Changes'][$j]=$Change_clock;
							
							
							//~ if ($days > 0)
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
							//~ else
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
							

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
		echo 'hii';
		if(!empty($_SESSION['lang']))
		{
			if($_SESSION['lang']=='en')
			{
				$flight_search_result = $this->load->view('flight/search_result_ajax', $data, true);
			}
			else
			{
				$flight_search_result = $this->load->view('flight/danish/search_result_ajax', $data, true);
			}
		}
		else
		{
			$flight_search_result = $this->load->view('search_result_ajax', $data, true);
		}

            
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


            /*
              $min_hours_ar=intval($min_time_arival/100);
              $min_min_ar=($min_time_arival%100);
              $minInHours_ar=($min_hours_ar * 60);
              $min_time_arival=$minInHours_ar+$min_min_ar;

              $max_hours_ar=intval($max_time_arival/100);
              $max_min_ar=($max_time_arival%100);
              $maxInHours_ar= ($max_hours_ar * 60);
              $max_time_arival=$maxInHours_ar+$max_min_ar;


              $min_hours_de=intval($min_time_departure/100);
              $min_min_de=($min_time_departure%100);
              $minInHours_de=($min_hours_de * 60);
              $min_time_departure=$minInHours_de+$min_min_de;

              $max_hours_de=intval($max_time_departure/100);
              $max_min_de=($max_time_departure%100);
              $maxInHours_de= ($max_hours_de * 60);
              $max_time_departure=$maxInHours_de+$max_min_de;
             */

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
    public function fetch_flight_search_result_Round_Trip($data) 
    {
		
        $flight_result = $data['flight_result'];
        $_SESSION['flight_result1'] = $flight_result;
        $_SESSION[$rand_id]['flight_result1'] = $flight_result;
        $data2 = "";
        $data4 = "";
        //echo 'vcv<pre/>';print_r($_SESSION['flight_result1']);exit;
        //Markup Values
		//$adminmarkup = $this->Flight_Model->get_adminmarkup();
		$adminmarkupvalue =0;// $adminmarkup->markup;
		//$pg = $this->Flight_Model->get_pgmarkup();
		$pgvalue = 0;//$pg->charge;

        // echo '<pre/>asdas';print_r($flight_result);exit;
        $testing = "";
        $_SESSION['MTK_flag'] ="No";
        if ($flight_result != '') {
            $count_val = count($flight_result);
            $i = 0;$total = 0;
            foreach ($flight_result as $flight_result1) {
                $count_code = count($flight_result1['oneWay']['marketingCarrier']);
                if ($count_code <= 1) {
                    $name = $this->Flights_Model->get_flight_name1($flight_result1['oneWay']['marketingCarrier']);
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
                        
                        // $hours_eft = floor(($flight_result1['oneWay']['eft']) / 60);
						// $day_eft = floor(($flight_result1['oneWay']['eft']) / 1440);
						// $minutes_eft = (($flight_result1['oneWay']['eft']) % 60);
						// $testing['oneway'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
						
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
                        // $adminmarkup = $this->Flight_Model->get_adminmarkup();
                         $adminmarkupvalue = 0;
                        // $pg = $this->Flight_Model->get_pgmarkup();
                         $pgvalue = 0;

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

						
						$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($dep_code); 
						$testing['oneway'][$i]['dep_time_zone_offset'] = $country_time_zone_offset;
						
						$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($arv_code); 
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
						$testing['oneway'][$i]['duration_time_zone'] = $duration_time_zone;
						$testing['oneway'][$i]['Clock_Changes']=$Change_clock;
						
						
						//~ if ($days > 0)
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
						//~ else
							//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
						

						$testing['oneway'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
						// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
						
						

                        $i++;
                    }
                } else {
                    $testing['oneway'][$i]['dur_in_min'] = "";
                    $h = 0;
                    $m = 0;
                    $total = 0;
                    for ($j = 0; $j < ($count_code); $j++) {
                        $name = $this->Flights_Model->get_flight_name1($flight_result1['oneWay']['marketingCarrier'][$j]);
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

                            
                            // $hours_eft = floor(($flight_result1['oneWay']['eft']) / 60);
							// $day_eft = floor(($flight_result1['oneWay']['eft']) / 1440);
							// $minutes_eft = (($flight_result1['oneWay']['eft']) % 60);
							// $testing['oneway'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
                            
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
                            // $adminmarkup = $this->Flight_Model->get_adminmarkup();
                             $adminmarkupvalue = 0;
                            // $pg = $this->Flight_Model->get_pgmarkup();
                             $pgvalue = 0;

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
							
							$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($dep_code); 
							$testing['oneway'][$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($arv_code); 
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
							
							
							//~ if ($days > 0)
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
							//~ else
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
							

							$testing['oneway'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
							// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                            
						}
                    }

                    $i++;
                }
            }
        }
		// echo '<pre/>asdas';print_r($testing);exit;
		if ($flight_result != '') {
            $count_val = (count($flight_result));$i = 0;$total = 0;
            foreach ($flight_result as $flight_result2) {
                
                if(isset($flight_result2['oneWay'])){
                $count_code = count($flight_result2['Return']['marketingCarrier']);
                if ($count_code <= 1) {
                    $name = $this->Flights_Model->get_flight_name1($flight_result2['Return']['marketingCarrier']);
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
                        
                        // $hours_eft = floor(($flight_result2['Return']['eft']) / 60);
						// $day_eft = floor(($flight_result2['Return']['eft']) / 1440);
						// $minutes_eft = (($flight_result2['Return']['eft']) % 60);
						// $testing['Return'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
						
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
						
						$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($dep_code); 
						$testing['Return'][$i]['dep_time_zone_offset'] = $country_time_zone_offset;
						
						$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($arv_code); 
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
                        $name = $this->Flights_Model->get_flight_name1($flight_result2['Return']['marketingCarrier'][$j]);
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
                            
                            // $hours_eft = floor(($flight_result2['Return']['eft']) / 60);
							// $day_eft = floor(($flight_result2['Return']['eft']) / 1440);
							// $minutes_eft = (($flight_result2['Return']['eft']) % 60);
							// $testing['Return'][$i]['duration_final_eft'] = $hours_eft."H ".$minutes_eft."M";
							
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

                            //Markup Values
                            // $adminmarkup = $this->Flight_Model->get_adminmarkup();
                             $adminmarkupvalue = 0;
                            // $pg = $this->Flight_Model->get_pgmarkup();
                             $pgvalue = 0;

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
							
							$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($dep_code); 
							$testing['Return'][$i]['dep_time_zone_offset'][$j] = $country_time_zone_offset;
							
							$country_time_zone_offset = $this->Flights_Model->get_time_zone_details($arv_code); 
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
							
							
							//~ if ($days > 0)
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%d Day %h H %i M');
							//~ else
								//~ $flight_result[($ij)]['duration_final'] = $interval->format('%h H %i M');
							

							$testing['Return'][$i]['dur_in_min_time_zone'][$j] = $dur_in_min;
							// $flight_result[($ij++)]['Layover_time'] = (($dur_in_min) - ($test['ElapsedTime']));
                        }
                    }
                    $i++;
                }
			}
            }
        }
         //echo '<pre/>';print_r($testing);exit;
        $data['flight_result'] = $testing;
        $_SESSION['flight_result'] = $data['flight_result'];
        $_SESSION['testing'] = $data['flight_result'];
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
            $_SESSION['flight_result'] = $data['flight_result'];
         // echo '<pre>';print_r($data);exit;
		if(!empty($_SESSION['lang']))
		{

			$flight_search_result = $this->load->view('flights/search_result_ajax_roundtrip', $data, true);
		}
		else
		{

			$flight_search_result = $this->load->view('flights/search_result_ajax_roundtrip', $data, true);
		}            
            
		echo 	$flight_search_result;								
            /*$minmxprice = $testing['oneway'];
            
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
            }*/
        } /*else {
            $flight_search_result = false;
            $airlines = "";
            $min_time_arival = '';
            $max_time_arival = '';
            $min_time_departure = '';
            $max_time_departure = '';
            $stops = "";
        }*/
		//echo'<pre/>';print_r($flight_search_result);echo "MIN_DURATION:". $min_duration." MAX_DURATION:".$max_duration. " MIN_AMOUNT:".$min_amount." MAX_AMOUNT:".($max_amount);exit;
		/*echo json_encode(array(
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
        ));*/
    }
	
	// Fare Rules for All modules
	function flight_detail_fare($id, $rand_id) 
	{
		$flight_result = $_SESSION[$rand_id]['flight_result'];        
		$flight_result1 = $_SESSION[$rand_id]['flight_result1'];
		if (($_SESSION[$rand_id]['journey_type'] == "Round") || $_SESSION[$rand_id]['journey_type'] == "Calendar") {
            $data['flightDetails_oneway'] = $flight_result['oneway'][$id];
            $data['flightDetails_return'] = $flight_result['Return'][$id];
            $data['flightDetails1'] = $flight_result1[$id];
        } else if (($_SESSION[$rand_id]['journey_type'] == "MultiCity")) {
            $data['flightDetails'] = $flight_result[$id]['multi'];
            $recomm_id = $data['flightDetails'][0]['recom'];
            $seg_id = $data['flightDetails'][0]['seg_id'];
            $_SESSION[$rand_id]['multi_id'] = $id;
            $data['flightDetails1'] = $flight_result1[$recomm_id][$seg_id];
            $data['recom'] = $recomm_id;
            $data['seg_id'] = $seg_id;
        } else {
            $flightDetails = $flight_result[$id];//Normal Array (Filter Purpose)
            $flightDetails1 = $data['flightDetails1'] = $flight_result1[$id];
            // echo '<pre/>';print_r($flightDetails1);exit;
           
        }
		if(true)
		{
			$SessionId = "";$SequenceNumber = "";$SecurityToken = "";$session_flag = "true";$sess_id = '';
			$result_query=$this->Flight_Model->get_amadeus_session_details();
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
								$session_flag = "false";
								$sess_id = ($no - 1);
								$this->Flight_Model->update_amadeus_session_details($time,$SequenceNumber,$SessionId,$sourceOffice);
							} else {
								$SessionId = $result_query[($no - 1)]->Session_Number;
								$SequenceNumber = (($result_query[($no - 1)]->Sequence_Number) + 1);
								$SecurityToken = (($result_query[($no - 1)]->Security_Token));
								$sess_id = ($no - 1);

								$Security_SignOut = '<?xml version="1.0" encoding="utf-8"?>
															<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
																<soapenv:Header>
																	   <Session>
																			  <SessionId>' . $SessionId . '</SessionId>
																			  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																			  <SecurityToken>' . $SecurityToken . '</SecurityToken>
																		</Session>
																</soapenv:Header>
																<soapenv:Body>
																	<Security_SignOut xmlns="http://xml.amadeus.com/VLSSOQ_04_1_1A">
																	</Security_SignOut>
																</soapenv:Body>
															 </soapenv:Envelope>';

								
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
								$session_flag = "true";
								$this->Flight_Model->set_amadeus_session_details($SessionId);
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
							$SessionStatus = $result_query[$s]->Query_In_Progress;
							if ($SessionStatus == "NO") {
								$time = time();
								$SessionTime = $result_query[$s]->Last_Query_Time;
								if (($time - $SessionTime) < (780)) {
									$SessionId = $result_query[$s]->Session_Number;
									$SequenceNumber = (($result_query[$s]->Sequence_Number) + 1);
									$SecurityToken = (($result_query[$s]->Security_Token));
									$session_flag = "false";
									$sess_id = $s;
									$this->Flight_Model->update_amadeus_session_details($time,$SequenceNumber,$SessionId,$sourceOffice);
									break;
								} else {
									$SessionId = $result_query[$s]->Session_Number;
									$SequenceNumber = (($result_query[$s]->Sequence_Number) + 1);
									$SecurityToken = (($result_query[$s]->Security_Token));
									$sess_id = ($no - 1);

									$Security_SignOut = '<?xml version="1.0" encoding="utf-8"?>
																<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
																	<soapenv:Header>
																		   <Session>
																				  <SessionId>' . $SessionId . '</SessionId>
																				  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																				  <SecurityToken>' . $SecurityToken . '</SecurityToken>
																			</Session>
																	</soapenv:Header>
																	<soapenv:Body>
																		<Security_SignOut xmlns="http://xml.amadeus.com/VLSSOQ_04_1_1A">
																		</Security_SignOut>
																	</soapenv:Body>
																 </soapenv:Envelope>';

									
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
									$this->Flight_Model->set_amadeus_session_details($SessionId);
									$session_flag = "true";
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
										  <sourceOffice>ODES12110</sourceOffice>
										</originIdentification>
										<originatorTypeCode>U</originatorTypeCode>
										<originator>WSDREDBG</originator>
									  </userIdentifier>
									  <dutyCode>
										<dutyCodeDetails>
										  <referenceQualifier>DUT</referenceQualifier>
										  <referenceIdentifier>SU</referenceIdentifier>
										</dutyCodeDetails>
									  </dutyCode>
									  <systemDetails>
										<organizationDetails>
										  <organizationId>NMC-SCANDI</organizationId>
										</organizationDetails>
									  </systemDetails>
									  <passwordInfo>
										<dataLength>8</dataLength>
										<dataType>E</dataType>
										<binaryData>ZWRQZEdGcGo=</binaryData>
									  </passwordInfo>
									</Security_Authenticate>         
								  </soapenv:Body>
								</soapenv:Envelope>';

				
					$URL2 = "https://test.webservices.amadeus.com";
					// $URL2 = "https://production.webservices.amadeus.com";
					$soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/VLSSLQ_06_1_1A";
				
				

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
			    if (!empty($data2)) {
					$xml = new DOMDocument();
					$xml->loadXML($data2);
					$SessionId = $xml->getElementsByTagName("SessionId")->item(0)->nodeValue;
					$SequenceNumber = $xml->getElementsByTagName("SequenceNumber")->item(0)->nodeValue;
					$SecurityToken = $xml->getElementsByTagName("SecurityToken")->item(0)->nodeValue;
					$time = time();
					$this->Flight_Model->insert_amadeus_session_details($time,$SequenceNumber,$SessionId,$SecurityToken);
				}
			}
			
			$no_of_pax = $_SESSION[$rand_id]['adults']+$_SESSION[$rand_id]['childs']+$_SESSION[$rand_id]['infants'];
			$segment_details = '';$destination='';$origin='';
			if(is_array($flightDetails['dlocation']))
			{
				for($l= 0;$l < (count($flightDetails['dlocation'])); $l++)
				{ 
					$origin=$flightDetails['dlocation'][0];
					$destination=$flightDetails['alocation'][$l];
					$segment_details.= '<segmentGroup>
											<segmentInformation>
											<flightDate>
												<departureDate>'.$flightDetails['dateOfDeparture'][$l].'</departureDate>
											</flightDate>
											<boardPointDetails>
												<trueLocationId>'.$flightDetails['dlocation'][$l].'</trueLocationId>
											</boardPointDetails>
											<offpointDetails>
												<trueLocationId>'.$flightDetails['alocation'][$l].'</trueLocationId>
											</offpointDetails>
											<companyDetails>
												<marketingCompany>'.$flightDetails['cicode'][$l].'</marketingCompany>
											</companyDetails>
											<flightIdentification>
												<flightNumber>'.$flightDetails['fnumber'][$l].'</flightNumber>
												<bookingClass>'.$flightDetails['BookingClass'][$l].'</bookingClass>
											</flightIdentification>
										</segmentInformation>
										<trigger></trigger>
										</segmentGroup>';
				}
			}
			else
			{
				$origin=$flightDetails['dlocation'];
				$destination=$flightDetails['alocation'];
				$segment_details= '<segmentGroup>
									<segmentInformation>
									<flightDate>
										<departureDate>'.$flightDetails['dateOfDeparture'].'</departureDate>
									</flightDate>
									<boardPointDetails>
										<trueLocationId>'.$flightDetails['dlocation'].'</trueLocationId>
									</boardPointDetails>
									<offpointDetails>
										<trueLocationId>'.$flightDetails['alocation'].'</trueLocationId>
									</offpointDetails>
									<companyDetails>
										<marketingCompany>'.$flightDetails['cicode'].'</marketingCompany>
									</companyDetails>
									<flightIdentification>
										<flightNumber>'.$flightDetails['fnumber'].'</flightNumber>
										<bookingClass>'.$flightDetails['BookingClass'].'</bookingClass>
									</flightIdentification>
								</segmentInformation>
								<trigger></trigger>
								</segmentGroup>';
			}
			
			$Passenger_group_ADT='';
			$Passenger_group_ADT='<passengersGroup>
								<segmentRepetitionControl>
									<segmentControlDetails>
										<quantity>1</quantity>
										<numberOfUnits>'.$_SESSION[$rand_id]['adults'].'</numberOfUnits>
									</segmentControlDetails>
								</segmentRepetitionControl>
								<ptcGroup>
									<discountPtc>
										<valueQualifier>ADT</valueQualifier>
									</discountPtc>
								</ptcGroup>
							</passengersGroup>';
							
			if($_SESSION[$rand_id]['childs']!=0)
			{
				if($_SESSION[$rand_id]['infants']!='')
				{
					$quantity_chd="2";
				}
				else
				{
					$quantity_chd="3";
				}
				$Passenger_group_ADT.='<passengersGroup>
									<segmentRepetitionControl>
										<segmentControlDetails>
											<quantity>'.$quantity_chd.'</quantity>
											<numberOfUnits>'.$_SESSION[$rand_id]['childs'].'</numberOfUnits>
										</segmentControlDetails>
									</segmentRepetitionControl>
									<ptcGroup>
										<discountPtc>
											<valueQualifier>CH</valueQualifier>
										</discountPtc>
									</ptcGroup>
								</passengersGroup>';
			}
			
			if($_SESSION[$rand_id]['infants']!=0)
			{
				$Passenger_group_ADT.='<passengersGroup>
									<segmentRepetitionControl>
										<segmentControlDetails>
											<quantity>2</quantity>
											<numberOfUnits>'.$_SESSION[$rand_id]['infants'].'</numberOfUnits>
										</segmentControlDetails>
									</segmentRepetitionControl>
									<ptcGroup>
										<discountPtc>
											<valueQualifier>INF</valueQualifier>
										</discountPtc>
									</ptcGroup>
								</passengersGroup>';
			}
			// Fare Rule Request start
			$Fare_InformativePricingWithoutPNR = '<?xml version="1.0" encoding="utf-8"?>
												<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
												 <soapenv:Header>
														   <Session>
																  <SessionId>' . $SessionId . '</SessionId>
																  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																  <SecurityToken>' . $SecurityToken . '</SecurityToken>
															</Session>
												   </soapenv:Header>
												  <soapenv:Body>
													<Fare_InformativePricingWithoutPNR xmlns="http://xml.amadeus.com/TIPNRQ_12_4_1A">
														<messageDetails>
															<messageFunctionDetails>
																<businessFunction>1</businessFunction>
																<messageFunction>741</messageFunction>
																<responsibleAgency>1A</responsibleAgency>
															</messageFunctionDetails>
														</messageDetails>
														'.$Passenger_group_ADT.'
														<tripsGroup>
															<originDestination>
																<origin>'.$origin.'</origin>
																<destination>'.$destination.'</destination>
															</originDestination>
																'.$segment_details.'
														</tripsGroup>
													</Fare_InformativePricingWithoutPNR>
												</soapenv:Body>
											</soapenv:Envelope>';
			// echo $Fare_InformativePricingWithoutPNR;Exit;
			
			
				$URL2 = "https://test.webservices.amadeus.com";
				// $URL2 = "https://production.webservices.amadeus.com";
				$soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/TIPNRQ_12_4_1A";
			
            
            $ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_URL, $URL2);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch2, CURLOPT_POST, 1);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $Fare_InformativePricingWithoutPNR); 
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

			$httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
			curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

			// Execute request, store response and HTTP response code
			$fare_rules_data = curl_exec($ch2);
			$error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
			curl_close($ch2);			
			$fare_search_result = $this->xml2array($fare_rules_data);
			// echo '<pre/>';print_r($fare_search_result);exit;
			 if (!isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_InformativePricingWithoutPNRReply']['errorMessage'])) 
			 {
				if (isset($fare_search_result['soap:Envelope']['soap:Body']['Fare_InformativePricingWithoutPNRReply']))
					$fare_rules_data = $fare_search_result['soap:Envelope']['soap:Body']['Fare_InformativePricingWithoutPNRReply'];
				else
					$fare_rules_data = "";
			}
			else
			{
				$fare_rules_data = "";
			}
			if($fare_rules_data != "")
			{
				if(isset($fare_rules_data['mainGroup']['pricingGroupLevelGroup'][0]))
				{
					$count_level_group=count($fare_rules_data['mainGroup']['pricingGroupLevelGroup']);
					for($lg=0;$lg<$count_level_group;$lg++)
					{
						 if(isset($flightDetails1['paxFareProduct'][$lg]))
							$last_ticket_date=$flightDetails1['paxFareProduct'][$lg]['description'];
						 else
							$last_ticket_date=$flightDetails1['paxFareProduct']['description'];
						
						$text=$fare_rules_data['mainGroup']['pricingGroupLevelGroup'][$lg]['fareInfoGroup']['textData'];
						$count_text=count($text);
						for($t=0;$t<$count_text;$t++)
						{
							if($t!=0)
							{
								$fare_rules['text_data'][$t]['textSubjectQualifier']=$text[$t]['freeTextQualification']['textSubjectQualifier'];
								$fare_rules['text_data'][$t]['informationType']=$text[$t]['freeTextQualification']['informationType'];
								$text_data = $fare_rules['text_data'][$t]['freeText']=$text[$t]['freeText'];
								
								if($text_data=="NON-REFUNDABLE")
								{
									$final_data[$lg][$t]['description']="Tickets are Non-Refundable.";
									$final_data[$lg][$t]['code']=$text_data;
								}
								else if($text_data=="REFUNDABLE")
								{
									$final_data[$lg][$t]['description']="Tickets are Refundable.";
									$final_data[$lg][$t]['code']=$text_data;
								}
								else if($text_data=="NON ENDO")
								{
									$final_data[$lg][$t]['description']="The ticket can't be Re-Issued to be used on another carrier";
									$final_data[$lg][$t]['code']=$text_data;
								}
								else if($text_data=="ENDO")
								{
									$final_data[$t]['description']="The ticket can be Re-Issued to be used on another carrier";
									$final_data[$t]['code']=$text_data;
								}
								else if(($text_data==" - SEE ADV PURCHASE") || ($text_data==" - DATE OF ORIGIN"))
								{
									$final_data[$lg][$t]['description']=$last_ticket_date;
									$final_data[$lg][$t]['code']=$text_data;
								}
								else if($text_data=="TICKET STOCK RESTRICTION")
								{
									$final_data[$lg][$t]['description']="Validating the carrier determined at pricing time will be checked against the stock restriction potentially filed";
									$final_data[$lg][$t]['code']=$text_data;
								}
								else if($text_data=="PENALTY APPLIES")
								{
									$final_data[$lg][$t]['description']="Penalty information that applies to this fare";
									$final_data[$lg][$t]['code']=$text_data;
								}
								else
								{
									$dataa_explode=explode(":",$text_data);
									if($dataa_explode[0]=="BG CXR")
									{
										$final_data[$lg][$t]['description']='';
										$final_text_baggage=explode("|",$dataa_explode[1]);
										$final_segment=explode("*",$final_text_baggage[0]);
										$name = $this->Flight_Model->get_flight_name($final_segment[1]);
										$final_data[$lg][$t]['description'].=$final_segment[0]." Segments on which the rule of the carrier applies - <br/> * Surface segments are not taken into account in the numbering<br/> * When the baggage unit of travel is composed by only one sector, nonumber is specified";
										$final_data[$lg][$t]['description'].="<br/>For the <b>".$name."</b> carrier free baggage rule applies for the specific segment";
										$final_data[$lg][$t]['code']=$text_data;
									}
									else
										$final_data[$lg][$t]['description']=$text_data;
										$final_data[$lg][$t]['code']=$text_data;
								}
							}
						}
					}
				}
				else
				{
					$text=$fare_rules_data['mainGroup']['pricingGroupLevelGroup']['fareInfoGroup']['textData'];
					$count_text=count($text);
					
					if(isset($flightDetails1['paxFareProduct'][0]))
						$last_ticket_date=$flightDetails1['paxFareProduct'][0]['description'];
					 else
						$last_ticket_date=$flightDetails1['paxFareProduct']['description'];
					
					for($t=0;$t<$count_text;$t++)
					{
						if($t!=0)
						{
							$fare_rules['text_data'][$t]['textSubjectQualifier']=$text[$t]['freeTextQualification']['textSubjectQualifier'];
							$fare_rules['text_data'][$t]['informationType']=$text[$t]['freeTextQualification']['informationType'];
							$text_data = $fare_rules['text_data'][$t]['freeText']=$text[$t]['freeText'];
							
							if($text_data=="NON-REFUNDABLE")
							{
								$final_data[$t]['description']="Tickets are Non-Refundable.";
								$final_data[$t]['code']=$text_data;
							}
							else if($text_data=="REFUNDABLE")
							{
								$final_data[$t]['description']="Tickets are Refundable.";
								$final_data[$t]['code']=$text_data;
							}
							else if($text_data=="NON ENDO")
							{
								$final_data[$t]['description']="The ticket can't be Re-Issued to be used on another carrier";
								$final_data[$t]['code']=$text_data;
							}
							else if($text_data=="ENDO")
							{
								$final_data[$t]['description']="The ticket can be Re-Issued to be used on another carrier";
								$final_data[$t]['code']=$text_data;
							}
							else if(($text_data==" - SEE ADV PURCHASE") || ($text_data==" - DATE OF ORIGIN"))
							{
								$final_data[$t]['description']=$last_ticket_date;
								$final_data[$t]['code']=$text_data;
							}
							else if($text_data=="TICKET STOCK RESTRICTION")
							{
								$final_data[$t]['description']="Validating the carrier determined at pricing time will be checked against the stock restriction potentially filed";
								$final_data[$t]['code']=$text_data;
							}
							else if($text_data=="PENALTY APPLIES")
							{
								$final_data[$t]['description']="Penalty information that applies to this fare";
								$final_data[$t]['code']=$text_data;
							}
							else
							{
								$dataa_explode=explode(":",$text_data);
								if($dataa_explode[0]=="BG CXR")
								{
									$final_data[$t]['description']='';
									$final_text_baggage=explode("|",$dataa_explode[1]);
									$final_segment=explode("*",$final_text_baggage[0]);
									$name = $this->Flight_Model->get_flight_name($final_segment[1]);
									$final_data[$t]['description'].=$final_segment[0]." Segments on which the rule of the carrier applies - <br/> * Surface segments are not taken into account in the numbering<br/> * When the baggage unit of travel is composed by only one sector, nonumber is specified";
									$final_data[$t]['description'].="<br/>For the <b>".$name."</b> carrier free baggage rule applies for the specific segment";
									$final_data[$t]['code']=$text_data;
								}
								else
									$final_data[$t]['description']=$text_data;
									$final_data[$t]['code']=$text_data;
							}
						}
					}
					$final_data[0]=$final_data;
				}
				// echo "<pre/>";print_r($final_data);exit;
				/*
				$baggage=$fare_rules_data['mainGroup']['pricingGroupLevelGroup']['fareInfoGroup']['segmentLevelGroup'];
				$fare_rules['baggage_freeAllowance']=$baggage['baggageAllowance']['baggageDetails']['freeAllowance'];
				$fare_rules['baggage_quantityCode']=$baggage['baggageAllowance']['baggageDetails']['quantityCode'];
				$fare_rules['fareBasis']=$baggage['fareBasis']['additionalFareDetails']['rateClass'];
				$fare_rules['secondRateClass']=$baggage['fareBasis']['additionalFareDet	ails']['secondRateClass'];
				
				$fareamount=$fare_rules_data['mainGroup']['pricingGroupLevelGroup']['fareInfoGroup']['fareAmount'];
				$fare_rules['typeQualifier']=$fareamount['monetaryDetails']['typeQualifier'];
				$fare_rules['fare_amount']=$fareamount['monetaryDetails']['amount'];
				$fare_rules['fare_currency']=$fareamount['monetaryDetails']['currency'];
				$otherMonetaryDetails=$fareamount['otherMonetaryDetails'];
				if(isset($otherMonetaryDetails[0]))
				{
					for($m=0;$m<(count($otherMonetaryDetails));$m++)
					{
						$fare_rules['fareamount'][$m]['typeQualifier']=$otherMonetaryDetails[$m]['typeQualifier'];
						$fare_rules['fareamount'][$m]['amount']=$otherMonetaryDetails[$m]['amount'];
						$fare_rules['fareamount'][$m]['currency']=$otherMonetaryDetails[$m]['currency'];
					}
				}*/
			}
			// echo "<pre/>"; print_r($fare_rules);exit;
			// $counter_fare_text = count($fare_rules['text_data']);
			
			$display_rules='';
			$counter_fare_loop = count($final_data);
			for($cfl=0;$cfl<$counter_fare_loop;$cfl++)
			{
				if($cfl==0){ $type="Adult"; }else if($cfl==1){ $type="Child"; }else{ $type="Infant"; }
				$counter_fare_text = count($final_data[$cfl]);
				$display_rules.= '<div STYLE=" height: 300px; width: 100%; font-size: 12px;background-color:#EEEEEE;">
									<div style="width:100%; padding-bottom:5px; padding-top:5px; background-color:#CCCCCC; text-align:center; font-weight:bold;">Air Fare Rules ('.$type.')</div>
									<table cellpadding="5" cellspacing="0" bordercolor="#EEEEEE" border="2px">
									<thead>
										<tr style="border:1px solid ;">
											<th style="border:1px solid ;" width="10%" bgcolor="#EEEEEE" align="left">Sl No.</th>
											<th style="border:1px solid ;" width="35%" bgcolor="#EEEEEE">Fare Rule</th>
											<th style="border:1px solid ;" width="55%" bgcolor="#EEEEEE">Fare Rules Description</th>
										</tr>
									</thead><tbody>';
				$slno =1;
				// for($loop =0 ;$loop< $counter_fare_text; $loop++)	
				// {
					// $display_rules .= '<tr>
										// <td>'.$slno .'</td>
										// <td>&nbsp;</td>
										// <td >'.trim($fare_rules['text_data'][$loop]['freeText']).'</td>
									// </tr>';	
					// $slno++;
				// }								
				
				for($loop =1 ;$loop< $counter_fare_text; $loop++)	
				{
					if(is_array($final_data[$cfl][$loop]['code']))
						$code_loop = $final_data[$cfl][$loop]['code'][0]." ".$final_data[$cfl][$loop]['code'][1];
					else
						$code_loop = $final_data[$cfl][$loop]['code'];
					
					if(is_array($final_data[$cfl][$loop]['description']))
						$description_loop = $final_data[$cfl][$loop]['description'][0]." ".$final_data[$cfl][$loop]['description'][1];
					else
						$description_loop = $final_data[$cfl][$loop]['description'];
						
					$display_rules .= '<tr style="border:1px solid ;">
										<td style="border:1px solid ;" width="10%" bgcolor="#F0F0F0">'.$slno++ .'</td>
										<td style="border:1px solid ;" width="35%" bgcolor="#F0F0F0">'.($code_loop).'</td>
										<td style="border:1px solid ;" width="55%" bgcolor="#F0F0F0">'.($description_loop).'</td>
									</tr>';	
				}
				
				$display_rules .='</tbody></table></div>';
			}
			
			$Fare_CheckRules = '<?xml version="1.0" encoding="utf-8"?>
												<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
												 <soapenv:Header>
														   <Session>
																  <SessionId>' . $SessionId . '</SessionId>
																  <SequenceNumber>' . $SequenceNumber . '</SequenceNumber>
																  <SecurityToken>' . $SecurityToken . '</SecurityToken>
															</Session>
												   </soapenv:Header>
												  <soapenv:Body>
													<Fare_CheckRules xmlns="http://xml.amadeus.com/FARQNQ_07_1_1A">
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
																		<ruleSectionId>TF</ruleSectionId>
																	</tarifFareRule>
																</fareRule>
															</Fare_CheckRules>
												</soapenv:Body>
											</soapenv:Envelope>';
											
			
				$URL2 = "https://test.webservices.amadeus.com";
				// $URL2 = "https://production.webservices.amadeus.com";
				$soapAction = "http://webservices.amadeus.com/1ASIWDBGDRE/FARQNQ_07_1_1A";
			
			
            
            $ch2 = curl_init();
			curl_setopt($ch2, CURLOPT_URL, $URL2);
			curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
			curl_setopt($ch2, CURLOPT_HEADER, 0);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch2, CURLOPT_POST, 1);
			curl_setopt($ch2, CURLOPT_POSTFIELDS, $Fare_CheckRules); 
			curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 1);
			curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch2, CURLOPT_SSLVERSION, 3);
			curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);

			$httpHeader2 = array("SOAPAction: {$soapAction}", "Content-Type: text/xml; charset=utf-8");
			curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
			curl_setopt($ch2, CURLOPT_ENCODING, "gzip");

			// Execute request, store response and HTTP response code
			$Fare_CheckRules_data = curl_exec($ch2);
			$error2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
			
			echo $display_rules;
			
		}
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
       // echo '<pre/>';print_r($country_phonecode);exit;
        $data['country'] = $country;
        $data['country_phonecode'] = $country_phonecode;
       // $countryName = $this->getCountry();
       // $data['IPcountryName'] = $countryName;
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
    // Pre Booking Page with Insurance details
    function pro_pre_booking($id, $rand_id) 
    {
		$flight_result = $_SESSION[$rand_id]['flight_result'];
        $flight_result1 = $_SESSION[$rand_id]['flight_result1'];
        $country = $this->Flight_Model->country_list();
        $country_phonecode = $this->Flight_Model->country_list_phonecode();
       // echo '<pre/>';print_r($country_phonecode);exit;
        $data['country'] = $country;
        $data['country_phonecode'] = $country_phonecode;
       // $countryName = $this->getCountry();
       // $data['IPcountryName'] = $countryName;
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
            $data['flightDetails_oneway'] = $flight_result['oneway'][$id];
            $data['flightDetails_return'] = $flight_result['Return'][$id1];
            $data['flightDetails1'] = $_SESSION[$rand_id]['flight_result1'][$id];
            $data['flightDetails2'] = $_SESSION[$rand_id]['flight_result1'][$id1];
            $total_fare_amount=$data['flightDetails_oneway']['Total_FareAmount'];
             //echo '<pre/>';print_r($data['flightDetails_oneway']);exit;
        } else if (($_SESSION['journey_type'] == "MultiCity")) {
           for($i=0;$i<3;$i++)
			{
				$id=$_POST['oneway_trip'.$i];
				$_SESSION[$rand_id]['multi_id'][]=$id;
				$data['flightDetails'][$i] = $flight_result[$id]['multi'][$i];
				$data['flightDetails1'][$i] = $flight_result1[$id][$i];
				$total_fare_amount=$data['flightDetails'][0]['Total_FareAmount'];
				
				
			}
            
        } else {
            $id=$_POST['oneway_trip'];
            $data['flightDetails'] = $flight_result[$id];
            $data['flightDetails1'] = $flight_result1[$id];
            $total_fare_amount=$data['flightDetails']['Total_FareAmount'];
        }
       // echo '<pre/>';print_r($data['flightDetails1']);exit;
        // if ($countryName == 'DENMARK') 
        if(true)
        {
			// if(!isset($_SESSION[$rand_id]['insurance']))	
			if(true)	
			{
				$xml = $this->getCredentialXml();
				$soapAction = "Login";
				//echo "<pre/>"; print_r($getList);
				$doLogin = $this->executeRequest($xml, $soapAction);
				$doLogin_array = $this->xml2array($doLogin);
				//echo "<pre/>"; print_r($doLogin_array);die;
				if(!isset($doLogin_array['soap:Envelope']['soap:Body']['soap:Fault']))
				{
					if(isset($doLogin_array['soap:Envelope']['soap:Body']['LoginResponse']))
					{
						$token = $_SESSION['insurence_token'] = $data['insurence_token'] = $doLogin_array['soap:Envelope']['soap:Body']['LoginResponse']['LoginResult']['Token'];
					}
					else
						$token = $_SESSION['insurence_token'] = $data['insurence_token'] = '';
				}
				else
				{
					$token = $_SESSION['insurence_token'] = $data['insurence_token'] = '';
					$error_text = $doLogin_array['soap:Envelope']['soap:Body']['soap:Fault']['faultstring'];
					echo $error_text;die;
				}
				
				if(!empty($token))
				{
					$data['fixed_insurance']='';	$data['static_insurance'] ='';
					$data['static_insurance'] = $static_insurance = $this->Flight_Model->getstaticInsurance();
					$xml_product = $this->getProductXml($token);
					$soapAction_product = "ProductList2";
					$getList = $this->executeRequest($xml_product, $soapAction_product);
					$getInsProductList = $this->xml2array($getList);
					if(!empty($getInsProductList))
						$this->storeProductList($getInsProductList);
					else
						$_SESSION['product_list'] = '';	
					//echo "<pre/>"; print_r($data);	exit;	
				   
					$data['pricing_info'] = ''; 
					$TripValueAmount = ceil($total_fare_amount); 
					// $TripValueAmount = 123.00;
					$pro_code = '041'; $l = 0;
					$data['pricing_info'][$l] = $this->getPricing($pro_code, $rand_id,$TripValueAmount,$token); 
					//echo "<pre/>"; print_r($data['pricing_info']);	exit;
					if(!empty($data['pricing_info'][$l]))
					{
						$data['insurance'][$l]['pro_code'] = $pro_code;
						$data['insurance'][$l]['amount'] = $data['pricing_info'][$l]['total'];// . '.00'
						$data['insurance'][$l]['status'] = 'false';
						$data['insurance'][$l]['currency'] = 'DKK';
						$data['insurance'][$l]['tax'] = $data['pricing_info'][$l]['tax'];
						$data['insurance'][$l]['name'] = $data['pricing_info'][$l]['name'];
						$data['insurance'][$l]['description'] = (($static_insurance[0]->description) != '') ? ($static_insurance[0]->description) : '';
					}
					else
					{
						$data['insurance'][$l] = '';
					}

					$pro_code = '112B'; $l = 1;      
					$data['pricing_info'][$l] = $this->getPricing($pro_code, $rand_id,$TripValueAmount,$token);
					if(!empty($data['pricing_info'][$l]))
					{
						$data['insurance'][$l]['pro_code'] = $pro_code;
						$data['insurance'][$l]['amount'] = $data['pricing_info'][$l]['total']; // . '.00'
						$data['insurance'][$l]['status'] = 'false';
						$data['insurance'][$l]['currency'] = 'DKK';
						$data['insurance'][$l]['tax'] = $data['pricing_info'][$l]['tax'];
						$data['insurance'][$l]['name'] = $data['pricing_info'][$l]['name'];
						$data['insurance'][$l]['description'] = (($static_insurance[1]->description) != '') ? ($static_insurance[1]->description) : '';
					}
					else
					{
						$data['insurance'][$l] = '';
					}
				}
				else
				{
					$data['pricing_info'] = '';	$_SESSION['product_list'] = '';	
					$_SESSION[$rand_id]['insurance'] = '';
				}
				 
				 $data['fixed_insurance'] = $fixed_insurance = $this->Flight_Model->getFixedInsurance();
				 // $data['static_insurance'] = $static_insurance = $this->Flight_Model->getstaticInsurance();
				 // echo '<pre/>';print_r($data['static_insurance']);exit;
				 if(!empty($fixed_insurance))
				 {
					 $data['insurance'][2]['pro_code'] = 'DGOVT';              
					 if(empty($data['insurance'][2]['amount']))
					 {
						foreach($fixed_insurance as $value)
						{
							$data['insurance'][2]['amount'][] = $value->amount;                
							$data['insurance'][2]['description'][] = $value->description;   
							 $data['insurance'][2]['status'][] = 'false';             
						}              
					 }
					
					 $data['insurance'][2]['currency'] = 'DKK';
					 $data['insurance'][2]['tax'] = '';
					 $data['insurance'][2]['name'] = 'Konkursforsikring';
				 }
				 else
				 {
					$data['insurance'][2]['pro_code'] = '';	$data['insurance'][2]['amount'] = '';
					$data['insurance'][2]['status'][0] = 'false';$data['insurance'][2]['status'][1] = 'false';	$data['insurance'][2]['currency'] = 'DKK';
				 }

				$data['insurance'][3]['pro_code'] = '';
				$data['insurance'][3]['amount'] = '';
				$data['insurance'][3]['status'] = '';
				$data['insurance'][3]['currency'] = '';
				
				// echo '<pre/>';print_r($_SESSION_SESSION[$rand_id]['insurance']);exit;
			}
			else
			{
         		
         		$data['insurance'] = $_SESSION[$rand_id]['insurance'];
         		$data['static_insurance'] = $_SESSION[$rand_id]['static_insurance'];
         		$data['fixed_insurance'] = $_SESSION[$rand_id]['fixed_insurance'];
         		for($l=0;$l<4;$l++)
         		{
					$data['insurance'][$l]['status'] = 'false';					
				}
				$_SESSION[$rand_id]['insurance'] = $data['insurance'];
				// echo '<pre/>';print_r($data['insurance']);exit;
			}
		}
        else 
        {
            $data['pricing_info'] = '';$_SESSION['insurence_token'] = '';$_SESSION['product_list'] = '';$_SESSION[$rand_id]['insurance'] = '';
        }
	
	    $data['fixed_insurance'] = $fixed_insurance = $this->Flight_Model->getFixedInsurance();
		$data['static_insurance'] = $static_insurance = $this->Flight_Model->getstaticInsurance();
        $data['rand_id'] = $rand_id;
        $_SESSION[$rand_id]['insurance'] = $data['insurance'];
        $_SESSION[$rand_id]['static_insurance'] = $data['static_insurance'];
        $_SESSION[$rand_id]['fixed_insurance'] = $data['fixed_insurance'];
        
        // echo "insurance<pre/>"; print_r($data['fixed_insurance']);	// exit;
        // echo "insurance product_list<pre/>"; print_r($_SESSION['product_list']);	// exit;
        // echo "static_insurance <pre/>"; print_r($data['static_insurance']);	exit;
        
        
        
        if (($_SESSION[$rand_id]['journey_type'] == "Round") || ($_SESSION[$rand_id]['journey_type'] == "Calendar")) 
        {
			if(!empty($_SESSION['lang']))
			{
				if($_SESSION['lang']=='en')
					$this->load->view('flight/pre_booking_round', $data);
				else
					$this->load->view('flight/danish/pre_booking_round', $data);
			}
			else
				$this->load->view('flight/pre_booking_round', $data);
            
        } 
        else if (($_SESSION[$rand_id]['journey_type'] == "MultiCity")) 
        {
			if(!empty($_SESSION['lang']))
			{
				if($_SESSION['lang']=='en')
					 $this->load->view('flight/pre_booking_multicity', $data);
				else
					 $this->load->view('flight/danish/pre_booking_multicity', $data);
			}
			else
				 $this->load->view('flight/pre_booking_multicity', $data);
        } 
        else 
        {
			if(!empty($_SESSION['lang']))
			{
				if($_SESSION['lang']=='en')
					 $this->load->view('flight/pre_booking', $data);
				else
					$this->load->view('flight/danish/pre_booking', $data);
			}
			else
				$this->load->view('flight/pre_booking', $data);
        }
    
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


	function load_search_results()
	{
		//echo '<pre>';print_r($this->session->userdata);
		$data['flight_session'] = $flight_session = $this->session->userdata('flight_session');
		$data['mode'] = $mode= $this->session->userdata('mode');
		//echo $mode;exit;
		if($mode =='O')
		{
			//echo $flight_session;
			$data['flight_res'] = $this->Flights_Model->getFlightResults($flight_session);
			//echo '<pre>fcgfdgd';print_r($data['flight_res']);exit;
			$this->load->view('flights/flight_search_oneway',$data);
	    }
	    else if($mode =='R')
	    {
			$flight_dep = $this->session->userdata('flight_departure');
			$flight_arr = $this->session->userdata('flight_arrival');
			
			$flight_dep_country = $this->Flights_Model->airportCountry($flight_dep);
			$flight_arr_country = $this->Flights_Model->airportCountry($flight_arr);
						
			if($flight_dep_country == 'India' AND  $flight_arr_country == 'India')
			{ // Domestic flights
				$flight_session = $this->session->userdata('flight_session');
	
 
 $data['result_outbound'] = $result_outbound =$this->Flights_Model->getFlightResultsIndian_outbound($flight_session);

			$data['result_inbound'] = $result_inbound =$this->Flights_Model->getFlightResultsIndian_inbound($flight_session);
			 $this->load->view('flights/flightsearch_result',$data);
			 //echo "Domestic flight details is under construction";
		
			}
			else
			{   // only itinerary flights
			
				//echo 'foreign';exit;
				 $data['flight_res'] = $this->Flights_Model->getFlightResultsItinerary($flight_session);
				 
				 //echo '<pre>fcgfdgd';print_r($data['flight_res']);exit;
			     $this->load->view('flights/flight_search_round',$data);
			}
			
		}
		
		
		
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
	
	function flight_details($onward_id,$return_id)
	{
		/*   If $mode = 'R', $onward_id and $return_id are both same then the flights is itinerary 
		 * 						else flights are onward and return
		 *   If $mode = 'O', $onward_id and $return_id ='' or $return_id = $onward_id the flights is itinerary or ( onward for domestic )
		 * */
		//echo '<pre>';print_r($this->session->userdata);exit;
		$mode = $this->session->userdata('mode');
		 $onward_result_id = $onward_id;
		 $return_result_id = $return_id;
		
		$this->session->set_userdata(array('onward_result_id'=>$onward_result_id));
		$this->session->set_userdata(array('return_result_id'=>$return_result_id));
		
		$FlightSession = $this->session->userdata('flight_session');
		if($mode == 'O')
		{
			// Pass
			//echo '<pre>';print_r($this->session->userdata);exit;
			
				
				$this->session->unset_userdata('return_result_id');
				
				
				$itinerary_flight = $this->Flights_Model->get_Flight_details($onward_result_id,$FlightSession);
				//echo '<pre>';print_r($itinerary_flight);exit;
				$SearchFormData = $itinerary_flight->SearchFormData;
				$OptionFormData = $itinerary_flight->OptionFormData;
				
				$xml = '<AirPriceRQ>
                           <SearchFormData>'.$SearchFormData.'</SearchFormData>
                           <AirOriginDestinationOptions>
								<AirOriginDestinationOption>
									<OptionFormData>'.$OptionFormData.'</OptionFormData>
								</AirOriginDestinationOption>
							</AirOriginDestinationOptions>
						</AirPriceRQ>';
					//echo $xml;exit;
		}
		if($mode == 'R')
		{
			//echo '<pre>';print_r($this->session->userdata);exit;
			
			
			if($onward_id == $return_id)
			{
				
				$ResultType = 'itinerary';
			
				$this->session->set_userdata(array('onward_result_id'=>$onward_result_id));
				
				$itinerary_flight = $this->Flights_Model->get_Flight_details($onward_result_id,$FlightSession);
				//echo '<pre>';print_r($itinerary_flight);exit;
				$SearchFormData = $itinerary_flight->SearchFormData;
				$OptionFormData = $itinerary_flight->OptionFormData;
				
				$xml = '<AirPriceRQ>
                           <SearchFormData>'.$SearchFormData.'</SearchFormData>
                           <AirOriginDestinationOptions>
								<AirOriginDestinationOption>
									<OptionFormData>'.$OptionFormData.'</OptionFormData>
								</AirOriginDestinationOption>
							</AirOriginDestinationOptions>
						</AirPriceRQ>';
				//echo $xml;exit;
			}
			else
			{
								
				 $onward_result_id = $onward_id;
				 $return_result_id = $return_id;
				
				$ResultType = 'onward_return';
								
				$onward_flights = $this->Flights_Model->get_Flight_details($onward_result_id,$FlightSession);
				$return_flights = $this->Flights_Model->get_Flight_details($return_result_id,$FlightSession);
				
				 $SearchFormData = $onward_flights->SearchFormData; 
				 $SearchFormData = $return_flights->SearchFormData;// $SearchFormData will be same for onward and return
				
				$OptionFormDataOnward = $onward_flights->OptionFormData;
				$OptionFormDataReturn = $return_flights->OptionFormData;
				
				$xml = '<AirPriceRQ>
                           <SearchFormData>'.$SearchFormData.'</SearchFormData>
                           <AirOriginDestinationOptions>
								<AirOriginDestinationOption>
									<OptionFormData>'.$OptionFormDataOnward.'</OptionFormData>
								</AirOriginDestinationOption>
								<AirOriginDestinationOption>
									<OptionFormData>'.$OptionFormDataReturn.'</OptionFormData>
								</AirOriginDestinationOption>
							</AirOriginDestinationOptions>
						</AirPriceRQ>';
				//echo '<pre>';print_r($xml);exit;
			}
		  
		   
	    }
	   
	   //echo 'hi';
	    if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.0.108')
	    {	
			$user_id = "10172";
			$password = "Travelapi@123";
			$url = 'https://test.sastiticket.com/websvc/AirPriceServiceV1?';
	    }
		else
		{
			$user_id = "10172";
			$password = "Travelapi@123";
			$url = 'https://test.sastiticket.com/websvc/AirPriceServiceV1?';
		}

$xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns="http://webservice.zillious.com/ns/V1">
	<soapenv:Header>
		<wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" soapenv:mustUnderstand="1">
			<wsse:UsernameToken xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" wsu:Id="UsernameToken-25616143">
				<wsse:Username>'.$user_id.'</wsse:Username>
				<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$password.'</wsse:Password>
			</wsse:UsernameToken>
		</wsse:Security>
	</soapenv:Header>
				<soapenv:Body>'.
				$xml
				.'</soapenv:Body>
				</soapenv:Envelope>'; 
		//echo $xml_request ;exit;
		
		$ch2=curl_init();
		curl_setopt($ch2, CURLOPT_URL, $url);
		curl_setopt($ch2, CURLOPT_TIMEOUT, 180);
		curl_setopt($ch2, CURLOPT_HEADER, 0);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch2, CURLOPT_POST, 1);
		curl_setopt($ch2, CURLOPT_POSTFIELDS, $xml_request);
		curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch2, CURLOPT_SSLVERSION, 3);	
		curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, FALSE);
		$httpHeader2 = array("SOAPAction: AirPrice","Content-Type: text/xml; charset=UTF-8","Content-Encoding: UTF-8");
		curl_setopt($ch2, CURLOPT_HTTPHEADER, $httpHeader2);
		curl_setopt ($ch2, CURLOPT_ENCODING, "gzip");
		$data2=curl_exec($ch2);
		
		// echo '<pre>';print_r($data2);exit;
		 $array =$this->xml2array($data2);
		//echo '<pre>';print_r($array);exit;
		
		
		$response1 = str_replace("<soap:Body>","",$data2);
            $response2 = str_replace("</soap:Body>","",$response1);
      $lang= htmlspecialchars(print_r($response2, true));
   $xmlString = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3",  $data2);
           $xml_responce = SimpleXML_Load_String($xmlString);
         $xml_responce = new SimpleXMLElement($xml_responce->asXML());
		
	//	echo '<pre>';print_r($xml_responce);
		 if(isset($xml_responce->soapenvBody))
		 {
		 	
		 	
			 if(is_array($array['soapenv:Envelope']['soapenv:Body']['ns1:AirPriceRS']))
			 {
				 $AirPriceRS = $array['soapenv:Envelope']['soapenv:Body']['ns1:AirPriceRS'];
				 
				 $SearchFormData = $AirPriceRS['ns1:SearchFormData']['value'];
				 $CartBookingId = $AirPriceRS['ns1:CartBookingId']['value'];
				 $CartFormData = $AirPriceRS['ns1:CartFormData']['value'];
				 $PricedItinerary = $AirPriceRS['ns1:PricedItineraries']['ns1:PricedItinerary'];
				// echo '<pre>';print_r($PricedItinerary);exit;
				 if($this->session->userdata('mode')=='O')
				{
					if(isset($PricedItinerary[0]) && $PricedItinerary[0] !='')
					 {
						// echo 123;exit;
						  $count = count($PricedItinerary);
						  $AirItineraryPricingInfo =  $PricedItinerary[0]['ns1:AirItineraryPricingInfo'];
					      $ItineraryPricingInfo = $PricedItinerary[0]['ns1:ItineraryPricingInfo'];
					      
					     // $ItineraryCurrency = $ItineraryPricingInfo['attr']['Currency'];
					      $ItinTotalFare = $ItineraryPricingInfo['ns1:ItinTotalFare']['value'];
					      $ItinServiceTax = $ItineraryPricingInfo['ns1:ItinServiceTax']['value'];
					      $ItinCommission = $ItineraryPricingInfo['ns1:ItinCommission']['value'];
					      
					      
					      $AirItineraryCurrency = $AirItineraryPricingInfo['attr']['Currency'];
					      $AirItinTotalFare = $AirItineraryPricingInfo['ns1:AirItinTotalFare']['value'];
					      $AirItinBaseFare = $AirItineraryPricingInfo['ns1:AirItinBaseFare']['value'];
					      $AirItinCommission = $AirItineraryPricingInfo['ns1:AirItinCommission']['value'];
					      
					      //echo $AirItinCommission;
					    //echo '<pre>';print_r($AirItineraryPricingInfo);exit;
					  
					  if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][0]))
					  {
						  $AdultPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][0];
						     if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][1]))
							 {
								$ChildtPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][1];
							 }
							 if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][2]))
							 {
								$InfantPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][2];
							 }
							 $AdultTotalFare = $AdultPricingInfo['ns1:TotalFare']['value'];
							 $AdultBaseFare = $AdultPricingInfo['ns1:BaseFare']['value'];
							 $AdultTransactionFee = $AdultPricingInfo['ns1:TransactionFee']['value'];
							 $AdultBookingFee = $AdultPricingInfo['ns1:BookingFee']['value'];
							 $AdultServiceTax = $AdultPricingInfo['ns1:ServiceTax']['value'];
							 
							 $AdultAirTaxes = $AdultPricingInfo ['ns1:AirTaxes']['ns1:Tax'];
					        
					         $AdultAirTaxesYQ_Amount = $AdultAirTaxes[0]['attr']['Amount'];
					         $AdultAirTaxesWO_Amount = $AdultAirTaxes[1]['attr']['Amount'];
						 	 $AdultAirTaxesIN_Amount = $AdultAirTaxes[2]['attr']['Amount'];
						 	 $AdultAirTaxesJN_Amount = $AdultAirTaxes[3]['attr']['Amount'];
					         $AdultAirTaxesYR_Amount = $AdultAirTaxes[4]['attr']['Amount'];
						     
						    					         
					     if(isset($ChildtPricingInfo) && $ChildtPricingInfo !='')
						 {
						 $ChildTotalFare = $ChildtPricingInfo['ns1:TotalFare']['value'];
						 $ChildBaseFare = $ChildtPricingInfo['ns1:BaseFare']['value'];
						 $ChildTransactionFee = $ChildtPricingInfo['ns1:TransactionFee']['value'];
						 $ChildBookingFee = $ChildtPricingInfo['ns1:BookingFee']['value'];
						 $ChildServiceTax = $ChildtPricingInfo['ns1:ServiceTax']['value'];
						 
						 $ChildAirTaxes = $ChildtPricingInfo['ns1:AirTaxes']['ns1:Tax'];
						 
						 $ChildAirTaxesYQ_Amount = $ChildAirTaxes[0]['attr']['Amount'];
						 $ChildAirTaxesWO_Amount = $ChildAirTaxes[1]['attr']['Amount'];
						 $ChildAirTaxesIN_Amount = $ChildAirTaxes[2]['attr']['Amount'];
						 $ChildAirTaxesJN_Amount = $ChildAirTaxes[3]['attr']['Amount'];
						 $ChildAirTaxesYR_Amount = $ChildAirTaxes[4]['attr']['Amount'];
												 
						 }
						 else{
							  $ChildTotalFare = '';
							 $ChildBaseFare = '';
							 $ChildTransactionFee = '';
							 $ChildBookingFee = '';
							 $ChildServiceTax = '';
							 
							 $ChildAirTaxes = '';
					        
					         $ChildAirTaxesYQ_Amount = '';
					         $ChildAirTaxesWO_Amount = '';
						 	 $ChildAirTaxesIN_Amount = '';
						 	 $ChildAirTaxesJN_Amount = '';
					         $ChildAirTaxesYR_Amount = '';
							 }
						 
						 if(isset($InfantPricingInfo) && $InfantPricingInfo !='' )
						 {
						 
						 $InfantTotalFare = $InfantPricingInfo['ns1:TotalFare']['value'];
						 $InfantBaseFare = $InfantPricingInfo['ns1:BaseFare']['value'];
						 $InfantTransactionFee = $InfantPricingInfo['ns1:TransactionFee']['value'];
						 $InfantBookingFee = $InfantPricingInfo['ns1:BookingFee']['value'];
						 $InfantServiceTax = $InfantPricingInfo['ns1:ServiceTax']['value'];
						 
						 $InfantAirTaxes = $InfantPricingInfo['ns1:AirTaxes']['ns1:Tax'];
						 
						 $InfantAirTaxesYQ_Amount = $InfantAirTaxes[0]['attr']['Amount'];
						 $InfantAirTaxesWO_Amount = $InfantAirTaxes[1]['attr']['Amount'];
						 $InfantAirTaxesIN_Amount = $InfantAirTaxes[2]['attr']['Amount'];
						 $InfantAirTaxesJN_Amount = $InfantAirTaxes[3]['attr']['Amount'];
						 $InfantAirTaxesYR_Amount = $InfantAirTaxes[4]['attr']['Amount'];
						 }
						 else{
							 
					         $InfantTotalFare = '';
							 $InfantBaseFare = '';
							 $InfantTransactionFee = '';
							 $InfantBookingFee = '';
							 $InfantServiceTax = '';
							 
							 $InfantAirTaxes = '';
					        
					         $InfantAirTaxesYQ_Amount = '';
					         $InfantAirTaxesWO_Amount = '';
						 	 $InfantAirTaxesIN_Amount = '';
						 	 $InfantAirTaxesJN_Amount = '';
					         $InfantAirTaxesYR_Amount = '';
							 }								
						}
						else
						{
							 $AdultPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'];
							 $AdultTotalFare = $AdultPricingInfo['ns1:TotalFare']['value'];
							 $AdultBaseFare = $AdultPricingInfo['ns1:BaseFare']['value'];
							 $AdultTransactionFee = $AdultPricingInfo['ns1:TransactionFee']['value'];
							 $AdultBookingFee = $AdultPricingInfo['ns1:BookingFee']['value'];
							 $AdultServiceTax = $AdultPricingInfo['ns1:ServiceTax']['value'];
							 
							 $AdultAirTaxes = $AdultPricingInfo ['ns1:AirTaxes']['ns1:Tax'];
					        
					         $AdultAirTaxesYQ_Amount = $AdultAirTaxes[0]['attr']['Amount'];
					         $AdultAirTaxesWO_Amount = $AdultAirTaxes[1]['attr']['Amount'];
						 	 $AdultAirTaxesIN_Amount = $AdultAirTaxes[2]['attr']['Amount'];
						 	 $AdultAirTaxesJN_Amount = $AdultAirTaxes[3]['attr']['Amount'];
					         $AdultAirTaxesYR_Amount = $AdultAirTaxes[4]['attr']['Amount'];
					         
					         $ChildTotalFare = '';
							 $ChildBaseFare = '';
							 $ChildTransactionFee = '';
							 $ChildBookingFee = '';
							 $ChildServiceTax = '';
							 
							 $ChildAirTaxes = '';
					        
					         $ChildAirTaxesYQ_Amount = '';
					         $ChildAirTaxesWO_Amount = '';
						 	 $ChildAirTaxesIN_Amount = '';
						 	 $ChildAirTaxesJN_Amount = '';
					         $ChildAirTaxesYR_Amount = '';
					         
					          $InfantTotalFare = '';
							 $InfantBaseFare = '';
							 $InfantTransactionFee = '';
							 $InfantBookingFee = '';
							 $InfantServiceTax = '';
							 
							 $InfantAirTaxes = '';
					        
					         $InfantAirTaxesYQ_Amount = '';
					         $InfantAirTaxesWO_Amount = '';
						 	 $InfantAirTaxesIN_Amount = '';
						 	 $InfantAirTaxesJN_Amount = '';
					         $InfantAirTaxesYR_Amount = '';
						}	//echo '<pre>';print_r($count);exit;
							     $OperatingAirline = '';
								 $MarketingAirline = '';
								 $ValidatingAirline = '';
								 $FlightNumber ='';
								 $DepartureAirport ='';
								 $ArrivalAirport ='';
								 $DepartureDateTime ='';
								 $ArrivalDateTime ='';
								 $ETicketEligibility ='';
								 $FareType ='';
								 $CabinClass = '';
								 $BookingClass ='';
								 $Equipment ='';
								 $JourneyTime ='';
								 
					     for($i=0;$i<$count;$i++)
					     {
							   if($count-$i==1)
									 {
										
$OperatingAirline .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:OperatingAirline']['value'];
$MarketingAirline .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:MarketingAirline']['value'];
$ValidatingAirline .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:ValidatingAirline']['value'];
$FlightNumber .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:FlightNumber']['value'];
$DepartureAirport .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:DepartureAirport']['value'];
$ArrivalAirport .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:ArrivalAirport']['value'];
$DepartureDateTime .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:DepartureDateTime']['value'];
$ArrivalDateTime .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:ArrivalDateTime']['value'];		
$ETicketEligibility .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']['ns1:FlightSegment']['ns1:ETicketEligibility']['value'];			
$FareType .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:FareType']['value'];
$CabinClass .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:CabinClass']['value'];	
$BookingClass .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:BookingClass']['value'];
$Equipment .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:Equipment']['value'];			
 $JourneyTime .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:JourneyTime']['value'];															 		
									
									 }
						         else
									 {
										
$OperatingAirline .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:OperatingAirline']['value'].'/';
$MarketingAirline .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:MarketingAirline']['value'].'/';
$ValidatingAirline .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:ValidatingAirline']['value'].'/';
$FlightNumber .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:FlightNumber']['value'].'/';				 
$DepartureAirport .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:DepartureAirport']['value'].'/';
$ArrivalAirport .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:ArrivalAirport']['value'].'/';
$DepartureDateTime .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:DepartureDateTime']['value'].'/';
$ArrivalDateTime .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:ArrivalDateTime']['value'].'/';
$ETicketEligibility .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']['ns1:FlightSegment']['ns1:ETicketEligibility']['value'].'/';		
$FareType .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:FareType']['value'].'/';
$CabinClass .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:CabinClass']['value'].'/';
$BookingClass .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:BookingClass']['value'].'/';
$Equipment .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:Equipment']['value'].'/';			
 $JourneyTime .= $PricedItinerary[$i]['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:JourneyTime']['value'].'/';								 
									 
										 
									 }
						 
						 }
						 
					 }
					 
					 else{
						  $AirItineraryPricingInfo =  $PricedItinerary['ns1:AirItineraryPricingInfo'];
					      $ItineraryPricingInfo = $PricedItinerary['ns1:ItineraryPricingInfo'];
					      
					      $ItineraryCurrency = $ItineraryPricingInfo['attr']['Currency'];
					      $ItinTotalFare = $ItineraryPricingInfo['ns1:ItinTotalFare']['value'];
					      $ItinServiceTax = $ItineraryPricingInfo['ns1:ItinServiceTax']['value'];
					      $ItinCommission = $ItineraryPricingInfo['ns1:ItinCommission']['value'];
					      
					      
					      $AirItineraryCurrency = $AirItineraryPricingInfo['attr']['Currency'];
					      $AirItinTotalFare = $AirItineraryPricingInfo['ns1:AirItinTotalFare']['value'];
					      $AirItinBaseFare = $AirItineraryPricingInfo['ns1:AirItinBaseFare']['value'];
					      $AirItinCommission = $AirItineraryPricingInfo['ns1:AirItinCommission']['value'];
					      
					         $AdultPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][0];
						     if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][1]))
							 {
								$ChildtPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][1];
							 }
							 if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][2]))
							 {
								$InfantPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][2];
							 }
							 $AdultTotalFare = $AdultPricingInfo['ns1:TotalFare']['value'];
							 $AdultBaseFare = $AdultPricingInfo['ns1:BaseFare']['value'];
							 $AdultTransactionFee = $AdultPricingInfo['ns1:TransactionFee']['value'];
							 $AdultBookingFee = $AdultPricingInfo['ns1:BookingFee']['value'];
							 $AdultServiceTax = $AdultPricingInfo['ns1:ServiceTax']['value'];
							 
							 $AdultAirTaxes = $AdultPricingInfo ['ns1:AirTaxes']['ns1:Tax'];
					        
					         $AdultAirTaxesYQ_Amount = $AdultAirTaxes[0]['attr']['Amount'];
					         $AdultAirTaxesWO_Amount = $AdultAirTaxes[1]['attr']['Amount'];
						 	 $AdultAirTaxesIN_Amount = $AdultAirTaxes[2]['attr']['Amount'];
						 	 $AdultAirTaxesJN_Amount = $AdultAirTaxes[3]['attr']['Amount'];
					         $AdultAirTaxesYR_Amount = $AdultAirTaxes[4]['attr']['Amount'];
						     
						    					         
					     if(isset($ChildtPricingInfo) && $ChildtPricingInfo !='')
						 {
						 $ChildTotalFare = $ChildtPricingInfo['ns1:TotalFare']['value'];
						 $ChildBaseFare = $ChildtPricingInfo['ns1:BaseFare']['value'];
						 $ChildTransactionFee = $ChildtPricingInfo['ns1:TransactionFee']['value'];
						 $ChildBookingFee = $ChildtPricingInfo['ns1:BookingFee']['value'];
						 $ChildServiceTax = $ChildtPricingInfo['ns1:ServiceTax']['value'];
						 
						 $ChildAirTaxes = $ChildtPricingInfo['ns1:AirTaxes']['ns1:Tax'];
						 
						 $ChildAirTaxesYQ_Amount = $ChildAirTaxes[0]['attr']['Amount'];
						 $ChildAirTaxesWO_Amount = $ChildAirTaxes[1]['attr']['Amount'];
						 $ChildAirTaxesIN_Amount = $ChildAirTaxes[2]['attr']['Amount'];
						 $ChildAirTaxesJN_Amount = $ChildAirTaxes[3]['attr']['Amount'];
						 $ChildAirTaxesYR_Amount = $ChildAirTaxes[4]['attr']['Amount'];
												 
						 }
						 else{
							  $ChildTotalFare = '';
							 $ChildBaseFare = '';
							 $ChildTransactionFee = '';
							 $ChildBookingFee = '';
							 $ChildServiceTax = '';
							 
							 $ChildAirTaxes = '';
					        
					         $ChildAirTaxesYQ_Amount = '';
					         $ChildAirTaxesWO_Amount = '';
						 	 $ChildAirTaxesIN_Amount = '';
						 	 $ChildAirTaxesJN_Amount = '';
					         $ChildAirTaxesYR_Amount = '';
							 }
						 
						 if(isset($InfantPricingInfo) && $InfantPricingInfo !='' )
						 {
						 
						 $InfantTotalFare = $InfantPricingInfo['ns1:TotalFare']['value'];
						 $InfantBaseFare = $InfantPricingInfo['ns1:BaseFare']['value'];
						 $InfantTransactionFee = $InfantPricingInfo['ns1:TransactionFee']['value'];
						 $InfantBookingFee = $InfantPricingInfo['ns1:BookingFee']['value'];
						 $InfantServiceTax = $InfantPricingInfo['ns1:ServiceTax']['value'];
						 
						 $InfantAirTaxes = $InfantPricingInfo['ns1:AirTaxes']['ns1:Tax'];
						 
						 $InfantAirTaxesYQ_Amount = $InfantAirTaxes[0]['attr']['Amount'];
						 $InfantAirTaxesWO_Amount = $InfantAirTaxes[1]['attr']['Amount'];
						 $InfantAirTaxesIN_Amount = $InfantAirTaxes[2]['attr']['Amount'];
						 $InfantAirTaxesJN_Amount = $InfantAirTaxes[3]['attr']['Amount'];
						 $InfantAirTaxesYR_Amount = $InfantAirTaxes[4]['attr']['Amount'];
						 }
						 else{
							 
					         $InfantTotalFare = '';
							 $InfantBaseFare = '';
							 $InfantTransactionFee = '';
							 $InfantBookingFee = '';
							 $InfantServiceTax = '';
							 
							 $InfantAirTaxes = '';
					        
					         $InfantAirTaxesYQ_Amount = '';
					         $InfantAirTaxesWO_Amount = '';
						 	 $InfantAirTaxesIN_Amount = '';
						 	 $InfantAirTaxesJN_Amount = '';
					         $InfantAirTaxesYR_Amount = '';
							 }								
							//echo '<pre>';print_r($count);exit;
							     $OperatingAirline = '';
								 $MarketingAirline = '';
								 $ValidatingAirline = '';
								 $FlightNumber ='';
								 $DepartureAirport ='';
								 $ArrivalAirport ='';
								 $DepartureDateTime ='';
								 $ArrivalDateTime ='';
								 $ETicketEligibility ='';
								 $FareType ='';
								 $CabinClass = '';
								 $BookingClass ='';
								 $Equipment ='';
								 $JourneyTime ='';
								 
$OperatingAirline .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:OperatingAirline']['value'];
$MarketingAirline .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:MarketingAirline']['value'];
$ValidatingAirline .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:ValidatingAirline']['value'];
$FlightNumber .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:FlightNumber']['value'];
$DepartureAirport .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:DepartureAirport']['value'];
$ArrivalAirport .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:ArrivalAirport']['value'];
$DepartureDateTime .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:DepartureDateTime']['value'];
$ArrivalDateTime .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:ArrivalDateTime']['value'];		
$ETicketEligibility .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']['ns1:FlightSegment']['ns1:ETicketEligibility']['value'];			
$FareType .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:FareType']['value'];
$CabinClass .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:CabinClass']['value'];	
$BookingClass .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:BookingClass']['value'];
$Equipment .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:Equipment']['value'];			
 $JourneyTime .= $PricedItinerary['ns1:AirItinerary']['ns1:AirOriginDestinationOptions']['ns1:AirOriginDestinationOption']
									 ['ns1:FlightSegment']['ns1:JourneyTime']['value'];	
					
						 
					 }
					
					// write here update query for one way itinerary or onward(for dpmestic airlines)
					$Flight_session = $this->session->userdata('flight_session');
					$onward_result_id = $this->session->userdata('onward_result_id');
					
					
$data = array('AirItinTotalFare'=>$AirItinTotalFare,'AirItinBaseFare'=>$AirItinBaseFare,'AirItinCommission'=>$AirItinCommission,
'AdultTotalFare'=>$AdultTotalFare,'AdultBaseFare'=>$AdultBaseFare,'AdultTransactionFee'=>$AdultTransactionFee,'AdultBookingFee'=>$AdultBookingFee,'AdultServiceTax'=>$AdultServiceTax,'AdultAirTaxesYQ_Amount'=>$AdultAirTaxesYQ_Amount,'AdultAirTaxesWO_Amount'=>$AdultAirTaxesWO_Amount,'AdultAirTaxesIN_Amount'=>$AdultAirTaxesIN_Amount,'AdultAirTaxesJN_Amount'=>$AdultAirTaxesJN_Amount,'AdultAirTaxesYR_Amount'=>$AdultAirTaxesYR_Amount,
'ChildTotalFare'=>$ChildTotalFare,'ChildBaseFare'=>$ChildBaseFare,'ChildTransactionFee'=>$ChildTransactionFee,'ChildBookingFee'=>$ChildBookingFee,'ChildServiceTax'=>$ChildServiceTax,'ChildAirTaxesYQ_Amount'=>$ChildAirTaxesYQ_Amount,'ChildAirTaxesWO_Amount'=>$ChildAirTaxesWO_Amount,'ChildAirTaxesIN_Amount'=>$ChildAirTaxesIN_Amount,'ChildAirTaxesJN_Amount'=>$ChildAirTaxesJN_Amount,'ChildAirTaxesYR_Amount'=>$ChildAirTaxesYR_Amount,
'InfantTotalFare'=>$InfantTotalFare,'InfantBaseFare'=>$InfantBaseFare,'InfantTransactionFee'=>$InfantTransactionFee,'InfantBookingFee'=>$InfantBookingFee,'InfantServiceTax'=>$InfantServiceTax,'InfantAirTaxesYQ_Amount'=>$InfantAirTaxesYQ_Amount,'InfantAirTaxesWO_Amount'=>$InfantAirTaxesWO_Amount,'InfantAirTaxesIN_Amount'=>$InfantAirTaxesIN_Amount,'InfantAirTaxesJN_Amount'=>$InfantAirTaxesJN_Amount,'InfantAirTaxesYR_Amount'=>$InfantAirTaxesYR_Amount,
'ItinTotalFare'=>$ItinTotalFare,'ItinServiceTax'=>$ItinServiceTax,'ItinCommission'=>$ItinCommission,
'OperatingAirlineOutbound'=>$OperatingAirline,'MarketingAirlineOutbound'=>$MarketingAirline,'ValidatingAirlineOutbound'=>$ValidatingAirline,'FlightNumberOutbound'=>$FlightNumber,'DepartureAirportOutbound'=>$DepartureAirport,'ArrivalAirportOutbound'=>$ArrivalAirport,'DepartureDateTimeOutbound'=>$DepartureDateTime,'ArrivalDateTimeOutbound'=>$ArrivalDateTime,'ETicketEligibilityOutbound'=>$ETicketEligibility,'FareTypeOutbound'=>$FareType,'CabinClassOutbound'=>$CabinClass,'BookingClassOutbound'=>$BookingClass,'JourneyTimeOutbound'=>$JourneyTime,'CartBookingId'=>$CartBookingId,'CartFormData'=>$CartFormData,'SearchFormData'=>$SearchFormData
);

$this->Flights_Model->update_flightPriceDetails($Flight_session,$onward_result_id,$data);
redirect('flights/guest_details','refresh');

//echo 'Show the guest details page';exit;
				}
				if($this->session->userdata('mode')=='R')
				{
					if($ResultType == 'itinerary')
					{
					 if(isset($PricedItinerary[0]) && $PricedItinerary[0] !='')
					 {
						  $count = count($PricedItinerary);
						  $AirItineraryPricingInfo =  $PricedItinerary[0]['ns1:AirItineraryPricingInfo'];
					      $ItineraryPricingInfo = $PricedItinerary[0]['ns1:ItineraryPricingInfo'];
					      
					      $ItineraryCurrency = $ItineraryPricingInfo['attr']['Currency'];
					      $ItinTotalFare = $ItineraryPricingInfo['ns1:ItinTotalFare']['value'];
					      $ItinServiceTax = $ItineraryPricingInfo['ns1:ItinServiceTax']['value'];
					      $ItinCommission = $ItineraryPricingInfo['ns1:ItinCommission']['value'];
					      
					      
					      $AirItineraryCurrency = $AirItineraryPricingInfo['attr']['Currency'];
					      $AirItinTotalFare = $AirItineraryPricingInfo['ns1:AirItinTotalFare']['value'];
					      $AirItinBaseFare = $AirItineraryPricingInfo['ns1:AirItinBaseFare']['value'];
					      $AirItinCommission = $AirItineraryPricingInfo['ns1:AirItinCommission']['value'];
					      
					      
					      
					     echo $ItineraryCurrency;exit;
					      
					      if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][0]) && $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][0] != '')
					      {
							  $AdultPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][0];
						 if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][1]))
						 {
						  $ChildtPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][1];
						 }
						 if(isset($AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][2]))
						 {
						 $InfantPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'][2];
						 }
						 $AdultCode = $AdultPricingInfo['attr']['Code'];
						 $AdultCount = $AdultPricingInfo['attr']['Quantity'];
						 $AdultTotalFare = $AdultPricingInfo['ns1:TotalFare']['value'];
						 $AdultBaseFare = $AdultPricingInfo['ns1:BaseFare']['value'];
						 $AdultTransactionFee = $AdultPricingInfo['ns1:TransactionFee']['value'];
						 $AdultBookingFee = $AdultPricingInfo['ns1:BookingFee']['value'];
						 $AdultServiceTax = $AdultPricingInfo['ns1:ServiceTax']['value'];
						 
						 $AdultAirTaxes = $AdultPricingInfo ['ns1:AirTaxes']['ns1:Tax'];
						 
						 $AdultAirTaxesYQ = $AdultAirTaxes[0]['attr'];
						 $AdultAirTaxesYQ_Amount = $AdultAirTaxesYQ['Amount'];
						 $AdultAirTaxesYQ_Code = $AdultAirTaxesYQ['Code'];
						 
						 $AdultAirTaxesWO = $AdultAirTaxes[1]['attr'];
						 $AdultAirTaxesWO_Amount = $AdultAirTaxesWO['Amount'];
						 $AdultAirTaxesWO_Code = $AdultAirTaxesWO['Code'];
						 
						 $AdultAirTaxesIN = $AdultAirTaxes[2]['attr'];
						 $AdultAirTaxesIN_Amount = $AdultAirTaxesIN['Amount'];
						 $AdultAirTaxesIN_Code = $AdultAirTaxesIN['Code'];
						 
						 $AdultAirTaxesJN = $AdultAirTaxes[3]['attr'];
						 $AdultAirTaxesJN_Amount = $AdultAirTaxesJN['Amount'];
						 $AdultAirTaxesJN_Code = $AdultAirTaxesJN['Code'];
						 
						 $AdultAirTaxesYR = $AdultAirTaxes[4]['attr'];
						 $AdultAirTaxesYR_Amount = $AdultAirTaxesYR['Amount'];
						 $AdultAirTaxesYR_Code = $AdultAirTaxesYR['Code'];
						 
						$ChildCode = '';
						 $ChildCount = '';
						 $ChildTotalFare = '';
						 $ChildBaseFare = '';
						 $ChildTransactionFee = '';
						 $ChildBookingFee = '';
						 $ChildServiceTax = '';
						 
						 $ChildAirTaxes = '';
						 
						 $ChildAirTaxesYQ = '';
						 $ChildAirTaxesYQ_Amount = '';
						 $ChildAirTaxesYQ_Code = '';
						 
						 $ChildAirTaxesWO = '';
						 $ChildAirTaxesWO_Amount = '';
						 $ChildAirTaxesWO_Code = '';
						 
						 $ChildAirTaxesIN = '';
						 $ChildAirTaxesIN_Amount = '';
						 $ChildAirTaxesIN_Code = '';
						 
						 $ChildAirTaxesJN = '';
						 $ChildAirTaxesJN_Amount = '';
						 $ChildAirTaxesJN_Code = '';
						 
						 $ChildAirTaxesYR = '';
						 $ChildAirTaxesYR_Amount = '';
						 $ChildAirTaxesYR_Code = '';
						 
						 $InfantCode = '';
						 $InfantCount = '';
						 $InfantTotalFare = '';
						 $InfantBaseFare = '';
						 $InfantTransactionFee = '';
						 $InfantBookingFee = '';
						 $InfantServiceTax = '';
						 
						 $InfantAirTaxes = '';
						 
						 $InfantAirTaxesYQ = '';
						 $InfantAirTaxesYQ_Amount = '';
						 $InfantAirTaxesYQ_Code = '';
						 
						 $InfantAirTaxesWO = '';
						 $InfantAirTaxesWO_Amount = '';
						 $InfantAirTaxesWO_Code = '';
						 
						 $InfantAirTaxesIN = '';
						 $InfantAirTaxesIN_Amount = '';
						 $InfantAirTaxesIN_Code = '';
						 
						 $InfantAirTaxesJN = '';
						 $InfantAirTaxesJN_Amount = '';
						 $InfantAirTaxesJN_Code = '';
						 
						 $InfantAirTaxesYR = '';
						 $InfantAirTaxesYR_Amount = '';
						 $InfantAirTaxesYR_Code = ''; 
						 
						 if(isset($ChildtPricingInfo) && $ChildtPricingInfo !='')
						 {
						 $ChildCode = $ChildtPricingInfo['attr']['Code'];
						 $ChildCount = $ChildtPricingInfo['attr']['Quantity'];
						 $ChildTotalFare = $ChildtPricingInfo['ns1:TotalFare']['value'];
						 $ChildBaseFare = $ChildtPricingInfo['ns1:BaseFare']['value'];
						 $ChildTransactionFee = $ChildtPricingInfo['ns1:TransactionFee']['value'];
						 $ChildBookingFee = $ChildtPricingInfo['ns1:BookingFee']['value'];
						 $ChildServiceTax = $ChildtPricingInfo['ns1:ServiceTax']['value'];
						 
						 $ChildAirTaxes = $ChildtPricingInfo['ns1:AirTaxes']['ns1:Tax'];
						 
						 $ChildAirTaxesYQ = $ChildAirTaxes[0]['attr'];
						 $ChildAirTaxesYQ_Amount = $ChildAirTaxesYQ['Amount'];
						 $ChildAirTaxesYQ_Code = $ChildAirTaxesYQ['Code'];
						 
						 $ChildAirTaxesWO = $ChildAirTaxes[1]['attr'];
						 $ChildAirTaxesWO_Amount = $ChildAirTaxesWO['Amount'];
						 $ChildAirTaxesWO_Code = $ChildAirTaxesWO['Code'];
						 
						 $ChildAirTaxesIN = $ChildAirTaxes[2]['attr'];
						 $ChildAirTaxesIN_Amount = $ChildAirTaxesIN['Amount'];
						 $ChildAirTaxesIN_Code = $ChildAirTaxesIN['Code'];
						 
						 $ChildAirTaxesJN = $ChildAirTaxes[3]['attr'];
						 $ChildAirTaxesJN_Amount = $ChildAirTaxesJN['Amount'];
						 $ChildAirTaxesJN_Code = $ChildAirTaxesJN['Code'];
						 
						 $ChildAirTaxesYR = $ChildAirTaxes[4]['attr'];
						 $ChildAirTaxesYR_Amount = $ChildAirTaxesYR['Amount'];
						 $ChildAirTaxesYR_Code = $ChildAirTaxesYR['Code']; 
						 
						 }
						 
						 if(isset($InfantPricingInfo) && $InfantPricingInfo !='' )
						 {
						 $InfantCode = $InfantPricingInfo['attr']['Code'];
						 $InfantCount = $InfantPricingInfo['attr']['Quantity'];
						 $InfantTotalFare = $InfantPricingInfo['ns1:TotalFare']['value'];
						 $InfantBaseFare = $InfantPricingInfo['ns1:BaseFare']['value'];
						 $InfantTransactionFee = $InfantPricingInfo['ns1:TransactionFee']['value'];
						 $InfantBookingFee = $InfantPricingInfo['ns1:BookingFee']['value'];
						 $InfantServiceTax = $InfantPricingInfo['ns1:ServiceTax']['value'];
						 
						 $InfantAirTaxes = $InfantPricingInfo['ns1:AirTaxes']['ns1:Tax'];
						 
						 $InfantAirTaxesYQ = $InfantAirTaxes[0]['attr'];
						 $InfantAirTaxesYQ_Amount = $InfantAirTaxesYQ['Amount'];
						 $InfantAirTaxesYQ_Code = $InfantAirTaxesYQ['Code'];
						 
						 $InfantAirTaxesWO = $InfantAirTaxes[1]['attr'];
						 $InfantAirTaxesWO_Amount = $InfantAirTaxesWO['Amount'];
						 $InfantAirTaxesWO_Code = $InfantAirTaxesWO['Code'];
						 
						 $InfantAirTaxesIN = $InfantAirTaxes[2]['attr'];
						 $InfantAirTaxesIN_Amount = $InfantAirTaxesIN['Amount'];
						 $InfantAirTaxesIN_Code = $InfantAirTaxesIN['Code'];
						 
						 $InfantAirTaxesJN = $InfantAirTaxes[3]['attr'];
						 $InfantAirTaxesJN_Amount = $InfantAirTaxesJN['Amount'];
						 $InfantAirTaxesJN_Code = $InfantAirTaxesJN['Code'];
						 
						 $InfantAirTaxesYR = $InfantAirTaxes[4]['attr'];
						 $InfantAirTaxesYR_Amount = $InfantAirTaxesYR['Amount'];
						 $InfantAirTaxesYR_Code = $InfantAirTaxesYR['Code']; 
						 
						 
						 }
						  
						  
						  }
						  else
						{
						 $AdultPricingInfo = $AirItineraryPricingInfo['ns1:AirPaxPricingInfo'];
						 $AdultCode = $AdultPricingInfo['attr']['Code'];
						 $AdultCount = $AdultPricingInfo['attr']['Quantity'];
						 $AdultTotalFare = $AdultPricingInfo['ns1:TotalFare']['value'];
						 $AdultBaseFare = $AdultPricingInfo['ns1:BaseFare']['value'];
						 $AdultTransactionFee = $AdultPricingInfo['ns1:TransactionFee']['value'];
						 $AdultBookingFee = $AdultPricingInfo['ns1:BookingFee']['value'];
						 $AdultServiceTax = $AdultPricingInfo['ns1:ServiceTax']['value'];
						 
						 $AdultAirTaxes = $AdultPricingInfo ['ns1:AirTaxes']['ns1:Tax'];
						 
						 $AdultAirTaxesYQ = $AdultAirTaxes[0]['attr'];
						 $AdultAirTaxesYQ_Amount = $AdultAirTaxesYQ['Amount'];
						 $AdultAirTaxesYQ_Code = $AdultAirTaxesYQ['Code'];
						 
						 $AdultAirTaxesWO = $AdultAirTaxes[1]['attr'];
						 $AdultAirTaxesWO_Amount = $AdultAirTaxesWO['Amount'];
						 $AdultAirTaxesWO_Code = $AdultAirTaxesWO['Code'];
						 
						 $AdultAirTaxesIN = $AdultAirTaxes[2]['attr'];
						 $AdultAirTaxesIN_Amount = $AdultAirTaxesIN['Amount'];
						 $AdultAirTaxesIN_Code = $AdultAirTaxesIN['Code'];
						 
						 $AdultAirTaxesJN = $AdultAirTaxes[3]['attr'];
						 $AdultAirTaxesJN_Amount = $AdultAirTaxesJN['Amount'];
						 $AdultAirTaxesJN_Code = $AdultAirTaxesJN['Code'];
						 
						 $AdultAirTaxesYR = $AdultAirTaxes[4]['attr'];
						 $AdultAirTaxesYR_Amount = $AdultAirTaxesYR['Amount'];
						 $AdultAirTaxesYR_Code = $AdultAirTaxesYR['Code'];
						 
						 					 
						  $ChildCode = '';
						 $ChildCount = '';
						 $ChildTotalFare = '';
						 $ChildBaseFare = '';
						 $ChildTransactionFee = '';
						 $ChildBookingFee = '';
						 $ChildServiceTax = '';
						 
						 $ChildAirTaxes = '';
						 
						 $ChildAirTaxesYQ = '';
						 $ChildAirTaxesYQ_Amount = '';
						 $ChildAirTaxesYQ_Code = '';
						 
						 $ChildAirTaxesWO = '';
						 $ChildAirTaxesWO_Amount = '';
						 $ChildAirTaxesWO_Code = '';
						 
						 $ChildAirTaxesIN = '';
						 $ChildAirTaxesIN_Amount = '';
						 $ChildAirTaxesIN_Code = '';
						 
						 $ChildAirTaxesJN = '';
						 $ChildAirTaxesJN_Amount = '';
						 $ChildAirTaxesJN_Code = '';
						 
						 $ChildAirTaxesYR = '';
						 $ChildAirTaxesYR_Amount = '';
						 $ChildAirTaxesYR_Code = ''; 
						 
						  $InfantCode = '';
						 $InfantCount = '';
						 $InfantTotalFare = '';
						 $InfantBaseFare = '';
						 $InfantTransactionFee = '';
						 $InfantBookingFee = '';
						 $InfantServiceTax = '';
						 
						 $InfantAirTaxes = '';
						 
						 $InfantAirTaxesYQ = '';
						 $InfantAirTaxesYQ_Amount = '';
						 $InfantAirTaxesYQ_Code = '';
						 
						 $InfantAirTaxesWO = '';
						 $InfantAirTaxesWO_Amount = '';
						 $InfantAirTaxesWO_Code = '';
						 
						 $InfantAirTaxesIN = '';
						 $InfantAirTaxesIN_Amount = '';
						 $InfantAirTaxesIN_Code = '';
						 
						 $InfantAirTaxesJN = '';
						 $InfantAirTaxesJN_Amount = '';
						 $InfantAirTaxesJN_Code = '';
						 
						 $InfantAirTaxesYR = '';
						 $InfantAirTaxesYR_Amount = '';
						 $InfantAirTaxesYR_Code = ''; 
						 
						 
						} 
						 
						
						  
						  for($i=0;$i<$count;$i++)
						  {
							  $AirItinerary =  $PricedItinerary[$i]['ns1:AirItinerary'];
							  
							  
								 $OperatingAirline = '';
								 $MarketingAirline = '';
								 $ValidatingAirline = '';
								 $FlightNumber ='';
								 $DepartureAirport ='';
								 $ArrivalAirport ='';
								// $DepartureTerminal='';
								 //$ArrivalTerminal ='';
								 $DepartureDateTime ='';
								 $ArrivalDateTime ='';
								 $ETicketEligibility ='';
								 $FareType ='';
								 $CabinClass = '';
								 $BookingClass ='';
								 $StopQuantity ='';
								// $StopCodes ='';
								 $Equipment ='';
								 $JourneyTime ='';
						  }
					 }
					 else
					 {
						 echo 123;exit;
					 }
					
			  }
			  }
			 
			 
			 }
			 
		 }
	}
	function terms_condition()
	{
		$this->load->view('flights/terms_condition');
	}
	function privacy_policy()
	{
		$this->load->view('flights/privacy_policy');
	}

		//redirect('home/GetChainTypes','refresh');
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
}
?>
