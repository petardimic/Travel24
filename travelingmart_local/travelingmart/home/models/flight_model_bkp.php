<?php 
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
}
?>
