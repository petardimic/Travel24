<?php 
//session_start();
class Flight_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function insert_flight($sessionid,$curency,$airline,$idprop,$prad,$prch,$prbe,$total,$taxes,$taxad,$taxch,$taxbe,$airport_from,$airport_to,$date_from_db,$date_to_db)
	{
		$data = array('criteria_id'=>$sessionid,'currency'=>$curency,'airline'=>$airline,'idprop'=>$idprop,'prad'=>$prad,'prch'=>$prch,'prbe'=>$prbe,'total'=>$total,'taxes'=>$taxes,'taxad'=>$taxad,'taxch'=>$taxch,'taxbe'=>$taxbe,'airport_from'=>$airport_from,'airport_to'=>$airport_to,'departure'=>$date_from_db,'return'=>$date_to_db);
		//echo "<pre>"; print_r($data); exit;
		$this->db->insert('flight_price_details',$data);
		return $this->dn->insert_id();
	}
	function insert_segments($idprop,$nbseg,$idseg,$codseg,$nbopt,$datdep,$timdep,$datarr,$timarr,$from,$to,$airline1,$flnb,$sessionid,$from,$to,$date_from_db,$date_to_db,$fpid)
	{
		$data = array('idprop'=>$idprop,'nbseg'=>$nbseg,'idseg'=>$idseg,'codseg'=>$codseg,'nbopt'=>$nbopt,'datdep'=>$datdep,'timdep'=>$timdep,'datarr'=>$datarr,'timarr'=>$timarr,'from'=>$from,'to'=>$to,'airline'=>$airline1,'flnb'=>$flnb,'sess_id'=>$sessionid,'airport_from'=>$from,'airport_to'=>$to,'departure'=>$date_from_db,'return'=>$date_to_db,'f_priceid'=>$fpid);
		$this->db->insert('segments',$data);
	}
	
	function get_airportname($code)
	{
		$query=$this->db->query($sql="select * from city_code_amadeus where city_code='".$code."'");
		//echo $this->db->last_query();exit;
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
	 function get_flight_name($hotelCode)
    {
    //$val="GEN";
	$code= $hotelCode['value'];
            $query = $this->db->query("SELECT AirLineName FROM  amadeus_airline_code WHERE AirLineCode='$code' ");
			//echo $this->db->last_query();exit;
            if($query->num_rows =='')
            {
                    return '';
            }else{
                    $dd =  $query->row();
					//echo'<pre>'; print_r($dd);exit;
                    return $dd->AirLineName;
            }
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
	function getFlightRound($session_id,$akbar_session){
		$query=$this->db->query($sql="select * from flight_search_result where session_id='".$session_id."' and akbar_session='".$akbar_session."' and journey_type='Round_oneway' order by Total_FareAmount asc");
		if($query->num_rows() > 0)
			{
				$result=$query->result();
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
	
	
	 function getAllMarkups($depDt)
        {
            $query=$this->db->query($sql="select * from markup_airlines where date_from>='".$depDt."' and date_to<='".$depDt."'");
            if($query->num_rows()>0)
            {
                return $query->result();
            }
            else return '';
        }
		
		 function getLocationType($from_city_code,$to_city_code)
                {
                    $locCheck='';
                    $query=$this->db->query($sql="select country as dep_country, (select country from city_code_amadeus where city_code='".$to_city_code."' limit 0,1) as arr_country from city_code_amadeus where city_code='".$from_city_code."' limit 0,1");
                    if($query->num_rows() > 0)
                    {
                        $countryName=$query->row();
                        $fromCountry=$countryName->dep_country;
                        $toCountry=$countryName->arr_country;
                        
                        if($fromCountry=='India' && $toCountry=='India')
                        {
                            $locCheck='India';
                        }
                        else if($fromCountry=='USA' && $toCountry=='USA')
                        {
                            $locCheck='USA';
                        }
                    }
                    
                    return $locCheck;
                }
				
				
				###################################################################################################################################################
				
				function get_amadeus_session_details($sourceOffice)
				{
					$this->db->select('*');
					$this->db->from('session_amadeus');
					$this->db->where('Active', 'Active');
					$this->db->where('sourceOffice', $sourceOffice);
					$query = $this->db->get();
			
					if ($query->num_rows() == 0)
						return '';
					else
						return $query->result();
				}
				/*
				function update_amadeus_session_details_start($time,$SequenceNumber,$SessionId,$sourceOffice)
				{
					$this->db->query("UPDATE session_amadeus SET Query_In_Progress='YES', Last_Query_Time='$time', Sequence_Number='$SequenceNumber'  WHERE Session_Number='$SessionId' and sourceOffice='$sourceOffice'");
				}*/
				
				function set_amadeus_session_details($SessionId ,$sourceOffice)
				{
					$this->db->query("UPDATE session_amadeus SET Active='InActive' WHERE Session_Number='$SessionId' and sourceOffice='$sourceOffice'");
				}
				function update_amadeus_session_details($time,$SequenceNumber,$SessionId,$sourceOffice)
	{
		$this->db->query("UPDATE session_amadeus SET Query_In_Progress='NO', Last_Query_Time='$time', Sequence_Number='$SequenceNumber'  WHERE Session_Number='$SessionId' and sourceOffice='$sourceOffice'");
	}
				function update_amadeus_session_details_start($time,$SequenceNumber,$SessionId,$sourceOffice)
				{
					$this->db->query("UPDATE session_amadeus SET Query_In_Progress='YES', Last_Query_Time='$time', Sequence_Number='$SequenceNumber'  WHERE Session_Number='$SessionId' and sourceOffice='$sourceOffice'");
				}
				
				function insert_amadeus_session_details($time,$SequenceNumber,$SessionId,$SecurityToken,$sourceOffice)
				{
					$data = array('sourceOffice' => $sourceOffice, 'Session_Number' => $SessionId, 'Sequence_Number' => $SequenceNumber, 'Security_Token' => $SecurityToken, 'Last_Query_Time' => $time, 'Query_In_Progress' => "YES", 'Active' => "Active");
					$this->db->insert('session_amadeus', $data);
				}
				
				function get_time_zone_details($CityCode)
				{
					$query = $this->db->query("SELECT country FROM  city_code_amadeus WHERE city_code = '$CityCode' ");
					if($query->num_rows =='')
						$country='';
					else
					{
						$dd =  $query->row();
						$country = $dd->country;
					}
					if($country!='')
					{
						$query = $this->db->query("SELECT iso FROM country_iso WHERE printable_name ='$country'");
						if($query->num_rows =='')
							$country_time_zone='';
						else
						{
							$dd =  $query->row();
							$country_code = $dd->iso;
							$query = $this->db->query("SELECT UTC_offset FROM timezones WHERE CountryCode ='$country_code'");
							if($query->num_rows =='')
								$country_time_zone='';
							else
							{
								$dd =  $query->row();
								$country_time_zone = $dd->UTC_offset;
							}
						}
					}
					else
						$country_time_zone = '';
					return $country_time_zone;
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
									
				
					function get_country_name($code)
	{
		$que="select * from  city_code_amadeus where city_code='$code'";
		$query= $this->db->query($que);
		echo $this->db->last_query();exit;
			if($query->num_rows() ==''){
				return '';
			}else{
				return $query->result();
			}

	}
	
	
}
?>
