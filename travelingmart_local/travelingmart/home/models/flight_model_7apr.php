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
            $query = $this->db->query("SELECT AirLineName FROM  amadeus_airline_code WHERE AirLineCode='$hotelCode' ");
            if($query->num_rows =='')
            {
                    return '';
            }else{
                    $dd =  $query->row();
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
	
	
}
?>
