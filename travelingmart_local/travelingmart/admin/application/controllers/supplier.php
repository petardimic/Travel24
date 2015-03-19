<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Supplier extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('Supplier_Model');	
		$this->load->model('Home_Model');	
		if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='192.168.0.229' || $_SERVER['HTTP_HOST']=='192.168.0.26')
		{}
		else
		{
			if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
			$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			header("Location: $redirect");
			}
		}
   }
   function supplier_login()
   {
//   echo "anand";	exit;
   	 if($this->input->post('user'))
	{  
		 $login_name = $this->input->post('user');
		 $password = $this->input->post('pass');
		 $res=$this->Supplier_Model->check_login_sup($login_name,$password);
			 if($res!='')
			 {
				foreach($res as $row)
				{
					$this->session->set_userdata(array('user_name'=>$row->first_name));	
					$this->session->set_userdata(array('user_id'=>$row->user_id));	
				}
				$data['sup_details'] = $this->Supplier_Model->get_sup_details($this->session->userdata('admin_user_id'));
				//$sup_id = $this->Supplier_Model->get_sup_id($this->session->userdata('admin_user_id'));
				$this->session->set_userdata(array('apt_id'=>''));
				//echo $this->session->userdata('apt_id');exit;
				//redirect('supplier/supplier_home');
			
				redirect('supplier/apart_list','refresh');
			}
			else
			{
				$data['error']="<font color=red>Your password doesn't match</font>";
				$this->load->view('supplier/partner',$data);	
			}
		}
		else
		{
			redirect('home/supplier','refresh');
		}
   }
   function resend_voucher12()
	{
		//require("PHPMailer/class.phpmailer.php");
		$booking_ref = $this->input->post('booking_ref');
		$resend_email = $this->input->post('resend_email');
		$details = $this->Home_Model->get_resend_voucher($booking_ref);
		$get_confrm_mail = $this->Home_Model->get_confrm_mail();
		$get_booking_details = $this->Home_Model->get_booking_details($booking_ref);
		$get_book_details12=  $get_book_details12 = $this->Home_Model->get_book_details12($details->booking_no);
		$sup_email = $this->Home_Model->get_sup_email($details->hotel_code);
		$get_book_det = $this->Home_Model->get_book_det($get_book_details12->passenger_info_id);
		$get_confrm_mail = $this->Home_Model->get_confrm_mail();
	if($details->status == 'Available'){
		$msg17 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style=" border-width:20; border-color:#ebebeb; ">		
						<table width="610" bgcolor="#fff" border-bottom:1px solid #fff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="610" height="25" align="left"  style=" background-color: #ebebeb;  border-bottom: 1px solid #cbcbcb;"> </td>		
							</tr>		
							<tr>
									<td width="610" valign="top" align="left" style="padding: 0px 14px 0px 14px; background-color: #ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">				
		           			<table width="580" cellspacing="0" align="center" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="700" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><br />	
				Dear '.$sup_email->fname.',<br /><br />
					The booking for '.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).' is confirmed.<br /><br />
				<strong>The Stayserviced Booking No. Code is: '.$get_booking_details->booking_ref_no.'</strong><br /><br />											
				View the booking details online:<a href="https://www.stayserviced.com/index.php/home/supplier" style="color:#003466">Click Here</a></td> <br />						
			
				
																														
				</td>										
								
			</tr>
		</table>
	</td>
</tr>						
														
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					 foreach($get_book_det as $row1){
					$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg17 .= 'N';}else{$msg17 .= 'Y';}
							$msg17 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg17 .='N';}else{$msg17 .= 'Y';}
						$msg17 .='</td>            
					</tr>';
					}
																	                               
 				$msg17 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						
				</tr>';
				foreach($get_book_det as $row1){
				$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg17 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg17 .='Non - refundable';}'</td>
					</tr>';
				}
				
					
				$msg17 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				foreach($get_book_det as $row1){
				$msg17 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' :</b> '.$row1->request.'</td>        

					</tr>';
				}
			$msg17 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
					
											<tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:15px 5px 0px 5px; background-color:#fff;">   																					 
		<table cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-bottom:10px;">
				Should you need to amend or cancel this reservation, please feel free to contact us at any time.<br /></a><br /><br />
				Best Regards,<br />
				The Stayserviced Team<br /><br />																		
				</td>
						</tr>
																		
	</table>
									
							</td>
						</tr>
						<td>
						 											
					
				</table>
		</table>
		
		
		
							<tr>
							 <td valign="top" align="center" height="25" style=" background-color: #ebebeb;  "> </td>                                                         
							  </tr>                    
					  </table>			

</body>
</html>';
	
	$sp_email = $this->Home_Model->get_sup_email_sending($get_booking_details->hotel_code);
	$get_confrm_mail_sup = $this->Home_Model->get_confrm_mail_sup();
	$sub1 = str_replace('{Accom Name}',$this->Home_Model->get_accom_name($get_booking_details->hotel_code),$get_confrm_mail_sup->email_subject);
	$mail1 = new PHPMailer();
	//$mail1->From = 'info@stayserviced.com';
	$mail1->FromName = "no-reply@stayserviced.com";
	//$mail1->Host='mail.stayserviced.com';
	$mail1->Port='587';
	//$mail1->Username   = 'info@stayserviced.com';
	//$mail1->Password   = 'sunlight';
	$mail1->SMTPKeepAlive = true;
	$mail1->Mailer = "smtp";
	$mail1->WordWrap = FALSE;
	$mail1->IsSMTP();
	$mail1->IsHTML(true);
	$mail1->AddAddress($sp_email);
	$mail1->Subject = $sub1;
	$mail1->Body = $msg17;
	$mail1->SMTPAuth   = true;                 // enable SMTP authentication
	$mail1->CharSet = 'utf-8';
	$mail1->SMTPDebug  = 0;
	if(!$mail1->Send())
	{
		show_error($this->email->print_debugger());
	}
	}
		else
		{$msg17 = '<html>
			<body bgcolor="#ebebeb">
			<table bgcolor="#fff" cellspacing="0" cellpadding="0" width="650" border="0" >
				<tr>
					<td width="650" bgcolor="#ebebeb" style="border-width:20; border-color:#ebebeb;">		
						<table width="610" bgcolor="#fff" border-bottom:1px solid #fff; style="margin-left:15px; "cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="610" height="25" align="left"  style=" background-color: #ebebeb;  border-bottom: 1px solid #cbcbcb;"> </td>		
							</tr>					
							<tr>
									<td width="610" valign="top" align="left" style="padding: 0px 14px 0px 14px; background-color: #ffffff; border-left: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;">				
		           			<table width="580" cellspacing="0" cellpadding="0" border="0">
							<tr>
					 		<td width="580" style="background-color: #ffffff;">						
							  <table width="580" cellspacing="0" cellpadding="0" border="0">								
								<tr>
	<td width="580" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-bottom:10px;">
		<table width="580" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td width="700" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-right: 10px;">
				<img src="'.WEB_DIR.'images/eml_stayserviced_logo.png" width="136" height="50" border="0" alt="Stayserviced" /><br />	
				'.$sup_email->fname.',<br/><br/>
					You have recieved a booking request for '.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'.<br /><br />
					<strong>The Stayserviced Booking No. Code is: '.$get_booking_details->booking_ref_no.'</strong><br /><br />													
				Please give approval and confirmation <a href="https://www.stayserviced.com/index.php/home/guest_login">Click Here</a><br/><br/>
						
				If this booking request cannot be accepted, please email us <a href="mailto:reserv@stayserviced.com">reserv@stayserviced.com</a> within 12 hours with any alternative options.<br/>						
			
				
																														
				</td>										
								
			</tr>
		</table>
	</td>
</tr>						
														
								<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Accommodation</strong></font>
    			</td>
			</tr>									
			<tr>
    			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
					
				
								   				   								 
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Booking No.:</strong> 
				<strong>'.$get_booking_details->booking_ref_no.'</strong> 
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Client:</strong> '.$get_book_details12->firstname.' '.$get_book_details12->lastname.'
				</td>				
				</tr>
				<tr>
				<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of nights:</strong> '.$this->session->userdata('dt').'
				</td>
				<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
				<strong>Number of units:</strong> '.$get_booking_details->no_of_room.'
				</td>				
				</tr>
					<tr>
					
					<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><strong>'.$this->Home_Model->get_accom_name($get_booking_details->hotel_code).'</strong><br />
'.$get_booking_details->address.'<br />
				  </tr>
					<tr>
						<td valign="top" width="60%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;"><br />
						 			
						</td>							
						<td valign="top" width="40%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-top:10px;">
						<strong>Check in:</strong> '.$get_booking_details->check_in.'<br />
						<strong>Check out:</strong> '.$get_booking_details->check_out.'<br />
																	
						</td>
					
					
					
					
					
					
					
						</tr>						
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>										
																
<tr>
   <td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding-top:20px;">                    			         
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"><font style="margin:0; color:#003366;"><strong>Pricing & Details</strong></font>
    			</td>
			</tr>	
			
			<td width="100%" style="border: 1px solid #dddddd; background-color: #f4f4f4; padding:7px;">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td width="75%">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="27%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Lead Guest Name</strong></td>
						<td width="33%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Adults</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Child.</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Smoking</strong></td>
						<td width="10%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Breakfast</strong></td>
													
					</tr>';
					 foreach($get_book_det as $row1){
					$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->guest_name.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->adults.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$row1->childs.'</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->breakfast == 'NO'){
							$msg17 .= 'N';}else{$msg17 .= 'Y';}
							$msg17 .='</td>
						<td style="text-align:center;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($row1->smoking == 'no'){
						$msg17 .='N';}else{$msg17 .= 'Y';}
						$msg17 .='</td>            
					</tr>';
					}
																	                               
 				$msg17 .= '</table>
							
						
																										
					</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Cancellation Policy</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td width="30%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Accom. Type</strong></td>
						<td width="70%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><strong>Description</strong></td>						
				</tr>';
				foreach($get_book_det as $row1){
				$msg17 .= '<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$get_booking_details->room_type.'</td>        
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">';
						if($get_booking_details->cancel_tilldate != 'null'){ 
						
						$msg17 .= 'If cancelled before '.$get_booking_details->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$get_booking_details->cancel_amount.' '. $get_booking_details->currency_type.' will be charged.';}else{ $msg17 .='Non - refundable';}'</td>
					</tr>';
				}
				
					
				$msg17 .='</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
				
																		
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Special Requests</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
				';
				foreach($get_book_det as $row1){
				$msg17 .='<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;"><b>'.$row1->guest_name.', '.$get_booking_details->room_type.' :</b> '.$row1->request.'</td>        
						
					</tr>';
				}
			$msg17 .= '</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
												
					<tr>
	<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;  padding-top:20px;">                    			         
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
    			<td width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding: 5px; background-color:#d3deef; color:#003366;"> <font style="margin:0; color:#003366;"><strong>Remarks</strong></font>
    			</td>
			</tr>									
			<tr>
			<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:15px 5px 0px 5px;">
				<table cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
				<tr>
						<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">'.$this->Home_Model->get_remarks($get_booking_details->type,$get_booking_details->roomUseCode).'</td>        
						
												
															</tr>
				</table>									
				</td>
			</tr>								
		</table>
	</td>
</tr>
					
												<tr>
    <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:15px 5px 0px 5px;">   																					 
		<table cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td colspan="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding-bottom:10px;">
				<strong>Policies</strong>																		
				</td>															
			</tr>
				
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				A Government-issued photo ID is required at the accommodation and for additional services.
				</td>															
			</tr>	
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				You will be responsible for any additional services used during your stay
				</td>															
			</tr>								
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Any refund will be automatically processed to the credit card used during the transaction.
				</td>															
			</tr>
						<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				A no-show will be treated as a cancellation and you will be billed accordingly. 
				</td>															
			</tr>				
			<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Stayservicved does not charge a processing fee for cancellations. 
				</td>		
				<tr>
				<td valign="top" style="padding:5px 7px 0px 0px;"><img src="'.WEB_DIR.'images/bullet.gif" width="5" height="5" border="0" alt="bullet" /></td>
				<td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">
				Always refer to your Booking Reference '.$get_booking_details->booking_ref_no.' in all your correspondence.
				</td>													
			</tr>
			<tr>
				<td colspan="2" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:5px 7px 0px 0px;">
				<a href="http://stayserviced.tenderapp.com/kb/general/terms-of-service" style="color:#003466">Terms of Service</a><br />
				<a href="http://www.stayserviced.com/index.php/home/faq/1" style="color:#003466">FAQs</a><br />
				<a href="http://www.stayserviced.com/index.php/home/aboutus" style="color:#003466">About Us</a><br /><br />			

												
												
							</td>
						</tr>
																		
	</table>
									
							</td>
						</tr>
						<td>
						 											
					
				</table>
		</table>
		
		
		
							<tr>
							 <td valign="top" align="center" height="25" style=" background-color: #ebebeb;  "> </td>                                                         
							  </tr>                       
					  </table>		
		

</body>
</html>';
	
	$sp_email = $this->Home_Model->get_sup_email_sending($details->hotel_code);
	$get_confrm_mail_sup = $this->Home_Model->get_confrm_mail_sup();
	$sub1 = str_replace('{Accom Name}',$this->Home_Model->get_accom_name($get_booking_details->hotel_code),$get_confrm_mail_sup->email_subject);
	$mail1 = new PHPMailer();
	//$mail1->From = 'info@stayserviced.com';
	//$mail1->FromName = "no-reply@stayserviced.com";
	//$mail1->Host='mail.stayserviced.com';
	$mail1->Port='587';
	//$mail1->Username   = 'info@stayserviced.com';
	//$mail1->Password   = 'sunlight';
	$mail1->SMTPKeepAlive = true;
	$mail1->Mailer = "smtp";
	$mail1->WordWrap = FALSE;
	$mail1->IsSMTP();
	$mail1->IsHTML(true);
	$mail1->AddAddress($sp_email);
	$mail1->Subject = $sub1;
	$mail1->Body = $msg17;
	$mail1->SMTPAuth   = true;                 // enable SMTP authentication
	$mail1->CharSet = 'utf-8';
	$mail1->SMTPDebug  = 0;
	if(!$mail1->Send())
	{
		show_error($this->email->print_debugger());
	}
	}
		redirect('admin/view_bookings/'.$booking_ref,'refresh');
	}
	function resend_voucher1()
	{
		$booking_ref = $this->input->post('booking_ref');
		$resend_email = $this->input->post('resend_email');
		$details = $this->Home_Model->get_resend_voucher($booking_ref);
		$get_confrm_mail = $this->Home_Model->get_confrm_mail();
		//require("PHPMailer/class.phpmailer.php"); 
		$sub="Resend Invoice";
		
		$msg ="1 Attachment <a href='".WEB_DIR."voucher/Invoice/".$details->invoice_pdf.".pdf'>View</a>";
		$mail = new PHPMailer();
		//$mail->From = 'info@stayserviced.com';
		//$mail->FromName = "no-reply@stayserviced.com";
		//$mail->Host='mail.stayserviced.com';
		$mail->Port='587';
		//$mail->Username   = 'info@stayserviced.com';
		//$mail->Password   = 'sunlight';
		//$mail->SMTPKeepAlive = true;
		$mail->Mailer = "smtp";
		$mail->WordWrap = FALSE;
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->AddAddress($resend_email);
		$mail->Subject = $sub;
		$mail->Body = $msg;
		$mail->SMTPAuth   = true;                 // enable SMTP authentication
		$mail->CharSet = 'utf-8';
		$mail->SMTPDebug  = 0;
		if(!$mail->Send())
		{
			show_error($this->email->print_debugger());
		}
		redirect('admin/view_bookings/'.$booking_ref,'refresh');
	}
   function cat_status($id,$stat)
   {
   		$this->Supplier_Model->cat_status($id,$stat);
		redirect('supplier/unit/1','refresh');
		
   }
   function gotohow()
   {

		$this->load->view('howtowork');

   }
    function gotowhy()
   {

		$this->load->view('whystaykey');

   }
  	function logout()
   {
   		//$this->session->unset_userdata('user_id');
   		 $this->session->sess_destroy();
		// echo "<pre>"; print_r($this->session->userdata);exit;
		 redirect('home/supplier', 'refresh');
   }
	function general_info()
	{
		
		if($this->session->userdata('admin_user_id')!='')
		{
			$user_id = $this->session->userdata('admin_user_id');
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$apt_name = $this->input->post('apt_name');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$district = $this->input->post('district');
			$country= $this->input->post('country');
			$language= $this->input->post('language');
			$email = $this->input->post('email');
			$region = $this->input->post('region');
			if($this->input->post('apart_id'))
			{
				$apt = $this->input->post('apart_id');
				$this->Supplier_Model->update_sup_list($fname,$lname,$user_id,$apt_name,$city,$email,$apt,$district,$region);
			}
			else
			{
				$apt = 'APT'.time();
				$apt_id = $this->Supplier_Model->insert_sup_list($fname,$lname,$user_id,$apt_name,$city,$country,$language,$email,$apt,$district,$region);
				$this->session->set_userdata(array('apt_id'=>$apt_id));
			}
			$apt_id = $this->session->userdata('apt_id');
			$this->Supplier_Model->delete_contact($apt_id);
			for($i=0;$i<3;$i++)
			{
				$fname = $this->input->post('fname'.$i);
				$lname = $this->input->post('lname'.$i);
				$phone = $this->input->post('phone'.$i);
				$fax = $this->input->post('fax'.$i);
				$email = $this->input->post('email'.$i);
				$user_id = $this->session->userdata('admin_user_id');
				$apt_id = $this->session->userdata('apt_id');
				if($i==0)
				{
					$req = 1;
				}
				else if($i == 1)
				{
					$req = 2;
				}
				else
				{
					$req = 3;
				}
				$this->Supplier_Model->insert_contact($fname,$lname,$phone,$fax,$email,$req,$user_id,$apt_id);
			}
			redirect('admin/supplier_home/'.$this->session->userdata('apt_id').'/1/'.$this->session->userdata('admin_user_id'),'refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
		
	}
	function forgot_password()
	{
		$this->load->view('supplier/forgot_password');
	}
	function get_pwd()
	{
		$user = $this->input->post('user');
		$pass = $this->Supplier_Model->get_pwd($user);
		$password = $pass->password;
		$fname = $pass->first_name;
		$fname = $pass->last_name;
		$res = $this->Supplier_Model->get_forgotpassword_emails();
		if($password != ""){
		//require("PHPMailer/class.phpmailer.php"); 
        $email = $user;
		$mail = new PHPMailer();
		//$mail->From = 'info@stayserviced.com';
		//$mail->FromName = "no-reply@stayserviced.com";
		//$mail->Host='mail.stayserviced.com';
		$mail->Port='587';
		//$mail->Username   = 'info@stayserviced.com';
		//$mail->Password   = 'sunlight';
		$mail->SMTPKeepAlive = true;
		$mail->Mailer = "smtp";
		$mail->WordWrap = FALSE;
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->AddAddress($email);
		$sub =  $res->email_subject;
		$msg = str_replace('{name}',$fname,$res->html_content);
		$msg = str_replace('{user email}',$user,$msg);
		$msg = str_replace('{password}',$password,$msg);
		$msg.= $res->footer;
		$mail->Subject = $sub;
        $mail->Body = $msg;
		$mail->SMTPAuth   = true;                 // enable SMTP authentication
		$mail->CharSet = 'utf-8';
		$mail->SMTPDebug  = 0;
		if(!$mail->Send())
		{
		    show_error($this->email->print_debugger());
		}
		else
		{
			redirect('home/supplier','refresh'); 
		}
		
		}
	}
	function change_pwd()
	{
		if($this->session->userdata('admin_user_id')!='')
		{
			$this->load->view('supplier/change_pwd');
		}
		else
		{
			redirect('home/supplier','refresh'); 
		}
	}
	function insert_unit_info()
	{
		if($this->session->userdata('admin_user_id')!='')
		{
			$unitcate = $this->input->post('unitcate');
			$plan = $this->input->post('plan');
			$personn = $this->input->post('personn');
			$personm = $this->input->post('personm');
			$size = $this->input->post('size');
			$meter = $this->input->post('meter');
			$rooms = $this->input->post('rooms');
			//$terrace = $this->input->post('terrace');
			$terrace = '';
			$floors = $this->input->post('floors');
			$brooms = $this->input->post('brooms');
			//$charge = $this->input->post('charge');
			$charge = '';
			$apt_id = $this->session->userdata('apt_id');
			$desc = $this->input->post('desc');
			$size = $size.' '.$meter;
			//$this->Supplier_Model->delete_unit_info($apt_id);
			$this->Supplier_Model->insert_unit_info($apt_id,$personn,$personm,$size,$rooms,$terrace,$floors,$brooms,$charge,$unitcate,$plan,$desc);
			$sup_apart_category_id  = $this->db->insert_id();
			$checkedval = $this->input->post('roomfec_val');
			$checkval = explode(",",$checkedval);
			$user = $this->session->userdata('admin_user_id');
			$apartid = $this->session->userdata('apt_id');
			$this->Supplier_Model->del_supplier_roomfecility($apartid);
			$comments = "";
			for($i=0;$i<=count($checkval)-1;$i++)
			{
				$comments = $this->input->post("cmnts_$checkval[$i]");
				$this->Supplier_Model->add_supplier_roomfecility($user,$apartid,$checkval[$i],$comments,$sup_apart_category_id);
				$comments = "";
			}
			redirect('supplier/unit','refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
		
	} 
	function insert_house_info()
	{
		if($this->session->userdata('admin_user_id')!='')
		{
			//$atimefrom= $this->input->post('atimefrom');
			//$dtimebefore = $this->input->post('dtimebefore');
			$atimefrom = '';
			$dtimebefore = '';
			$checkin_from1= $this->input->post('checkin_from1');
			$costin1 = $this->input->post('costin1');
			$checkin_from2= $this->input->post('checkin_from2');
			$costin2 = $this->input->post('costin2');
			$checkout_from1= $this->input->post('checkout_from1');
			$costout1 = $this->input->post('costout1');
			$checkout_from2= $this->input->post('checkout_from2');
			$costout2 = $this->input->post('costout2');
			$mistay= $this->input->post('mistay');
			$mxstay = $this->input->post('mxstay');
			//$mistay = '';
			//$mxstay = '';
			//$rentamt= $this->input->post('rentamt');
			//$pmode = $this->input->post('pmode');
			$pmode = '';
			$rentamtday= $this->input->post('rentamtday');
			$clean = $this->input->post('clean');
			$supp = $this->input->post('supp');
			$apt_id = $this->session->userdata('apt_id');
			$house_id = $this->input->post('house_id');
			$policy = $this->input->post('policy');
			$pets = $this->input->post('pets');
			if($house_id =='')
			{
				$this->Supplier_Model->insert_house_info($atimefrom,$dtimebefore,$checkin_from1,$costin1,$checkin_from2,$costin2,$checkout_from1,$costout1,$checkout_from2,$costout2,$mistay,$mxstay,$pmode,$rentamtday,$clean,$supp,$apt_id,$policy,$pets);
			}
			else
			{
				$this->Supplier_Model->update_house_info($atimefrom,$dtimebefore,$checkin_from1,$costin1,$checkin_from2,$costin2,$checkout_from1,$costout1,$checkout_from2,$costout2,$mistay,$mxstay,$pmode,$rentamtday,$clean,$supp,$apt_id,$policy,$pets);
			}
			redirect('supplier/house_rules','refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
	}
	function update_unit_info($id)
	{
	//echo $id;exit;
		if($this->session->userdata('admin_user_id')!='')
		{
			$unitcate = $this->input->post('unitcate');
			$plan = $this->input->post('plan');
			$personn = $this->input->post('personn');
			$personm = $this->input->post('personm');
			$size = $this->input->post('size');
			$meter = $this->input->post('meter');
			$rooms = $this->input->post('rooms');
			//$terrace = $this->input->post('terrace');
			$terrace = '';
			$floors = $this->input->post('floors');
			$brooms = $this->input->post('brooms');
			//$charge = $this->input->post('charge');
			$charge = '';
			$apt_id = $this->session->userdata('apt_id');
			$desc = $this->input->post('desc');
			$size = $size.' '.$meter;
			//$this->Supplier_Model->delete_unit_info($apt_id);
			$this->Supplier_Model->update_unit_info($apt_id,$personn,$personm,$size,$rooms,$terrace,$floors,$brooms,$charge,$unitcate,$plan,$id,$desc);
			$checkedval = $this->input->post('roomfec_val');
			$checkval = explode(",",$checkedval);
			$user = $this->session->userdata('admin_user_id');
			$apartid = $this->session->userdata('apt_id');
			$this->Supplier_Model->del_supplier_roomfecility($id);
			$comments = "";
			for($i=0;$i<=count($checkval)-1;$i++)
			{
				$comments = $this->input->post("cmnts_$checkval[$i]");
				$this->Supplier_Model->add_supplier_roomfecility($user,$apartid,$checkval[$i],$comments,$id);
				$comments = "";
			}
			$checkedval1 = $this->input->post('roomfec_val1');
			$checkval1 = explode(",",$checkedval1);
			$user = $this->session->userdata('admin_user_id');
			$apartid = $this->session->userdata('apt_id');
			$comments = "";
			for($i=0;$i<=count($checkval1)-1;$i++)
			{
				//$this->Supplier_Model->add_check_pictures($apartid,$checkval[$i],$comments);
				$comments = $this->input->post("cmnts1_$checkval1[$i]");
				$this->Supplier_Model->add_check_roomfecility($user,$apartid,$checkval1[$i],$comments,$id);
				$comments = "";
			}
			redirect('supplier/view_unit_details/'.$id,'refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
		
	}
	function insert_extra_info()
	{
		if($this->session->userdata('admin_user_id')!='')
		{
			$apt_id = $this->session->userdata('apt_id');
			$this->Supplier_Model->delete_extra_info($apt_id);
			for($i=1;$i<=4;$i++){
				$service = $this->input->post("service$i");
				$cost = $this->input->post("cost$i");
				$mode = $this->input->post("mode$i");
				$apt_id = $this->session->userdata('apt_id');
				if($service !=""){
					$this->Supplier_Model->insert_extra_info($apt_id,$service,$cost,$mode);
				}
			}
			redirect('supplier/property_info','refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
		
	} 
	function add_rate_details()
	{
		if($this->session->userdata('admin_user_id')!='')
		{
			$apt_id = $this->session->userdata('apt_id');
			$rate_plan = $this->input->post('rate_plan');
			$default_avail = $this->input->post('default_avail');
			$capacity = $this->input->post('capacity');
			$def_max = $this->input->post('def_max');
			$def_min = $this->input->post('def_min');
			$day_befr = $this->input->post('day_befr');
			$rate = $this->input->post('rate');
			//$booking = $this->input->post('booking');
			$booking = '';
			$breakfast = $this->input->post('breakfast');
			$breakfast_type = $this->input->post('breakfast_type');
			$breakfastfrom = $this->input->post('breakfastfrom');
			$breakfastto = $this->input->post('breakfastto');
			$cancellation = $this->input->post('cancellation');
			if($cancellation == 1)
			{
				$cancellation_days = $this->input->post('cancellation_days');
				$charge_percent = $this->input->post('charge_percent');
				$charge_rate = '';
				$per_night = $this->input->post('per_night_percent');
			}
			else if($cancellation == 2)
			{
				$cancellation_days = $this->input->post('cancellation_days');
				$charge_rate = $this->input->post('charge_rate');
				$charge_percent = '';
				$per_night = $this->input->post('per_night_price');
			}
			else
			{
				$cancellation_days = '';
				$charge_rate = '';
				$charge_percent = '';
				$per_night = '';
			}
			
			$booking_details = $this->input->post('booking_details');
			//$cancel_details = $this->input->post('cancel_details');
			$cancel_details = '';
			$plan_name= $this->input->post('plan_name');
			$stdate = $this->input->post('stdate');
			list($d,$m,$y) = explode('/',$stdate);
			$newdate = $y.'-'.$m.'-'.$d;
			$eddate = $this->input->post('eddate');
			list($d1,$m1,$y1) = explode('/',$eddate);
			$newdate1 = $y1.'-'.$m1.'-'.$d1;
			$remarks_room = $this->input->post('remarks_room');
			/*$datediff = ($newdate1-$newdate)/(60*60*24);
			echo $datediff;exit;*/
			if($m1!='' && $d1!='' && $y1!='' && $m!='' && $d!='' && $y!=''){
			$d3=mktime(0,0,0,$m1,$d1,$y1);
			$d2=mktime(0,0,0,$m,$d,$y);}
			$diff = floor(($d3-$d2)/86400);
			$cancellation_nights = '';
			$charges = '';
			$type_book = $this->input->post('type_book');
			$pre_payment = $this->input->post('pre_payment');
			$percentage = $this->input->post('percentage');
			$amount = $this->input->post('amount');
			$security_deposit = $this->input->post('security_deposit');
			if($security_deposit == 1)
			{
				$percentage_val = '';
				$per_days = '';
				$amount_val = '';
				$amt_days = '';
				$deposit_method = $this->input->post('deposit_method');
				if($deposit_method == 1)
				{
					$percentage_val = '';
					$per_days = '';
					$amount_val = '';
					$amt_days = '';
				}
				else if($deposit_method == 2)
				{
					$percentage_val = $this->input->post('percentage_val');
					$per_days = $this->input->post('per_days');
					$amount_val = '';
					$amt_days = '';
				}
				else if($deposit_method == 3)
				{
					$amount_val = $this->input->post('amount_val');
					$amt_days = $this->input->post('amt_days');
					$percentage_val = '';
					$per_days = '';
				}
			}
			else 
			{
				$amount_val = '';
				$amt_days = '';
				$percentage_val = '';
				$per_days = '';
				$deposit_method = '';
			}
			$this->Supplier_Model->add_rate_details($rate_plan,$default_avail,$capacity,$def_max,$def_min,$day_befr,$rate,$booking,$breakfast,$breakfast_type,$breakfastfrom,$breakfastto,$cancellation,$cancellation_days,$cancellation_nights,$charges,$charge_percent,$charge_rate,$per_night,$booking_details,$cancel_details,$apt_id,$plan_name,$newdate,$newdate1,$remarks_room,$diff,$type_book,$pre_payment,$percentage,$amount,$security_deposit,$deposit_method,$percentage_val,$per_days,$amount_val,$amt_days);
			redirect('supplier/rate/1','refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');	
		}
	}
	function update_rate_details($id)
	{
	
		if($this->session->userdata('admin_user_id')!='')
		{
			$apt_id = $this->session->userdata('apt_id');
			$rate_plan = $this->input->post('rate_plan');
			$default_avail = $this->input->post('default_avail');
			$capacity = $this->input->post('capacity');
			$def_max = $this->input->post('def_max');
			$def_min = $this->input->post('def_min');
			$day_befr = $this->input->post('day_befr');
			$rate = $this->input->post('rate');
			//$booking = $this->input->post('booking');
			$booking = '';
			$breakfast = $this->input->post('breakfast');
			$breakfast_type = $this->input->post('breakfast_type');
			$breakfastfrom = $this->input->post('breakfastfrom');
			$breakfastto = $this->input->post('breakfastto');
			$cancellation = $this->input->post('cancellation');
			if($cancellation == 1)
			{
				$cancellation_days = $this->input->post('cancellation_days');
				$charge_percent = $this->input->post('charge_percent');
				$charge_rate = '';
				$per_night = $this->input->post('per_night_percent');
			}
			else if($cancellation == 2)
			{
				$cancellation_days = $this->input->post('cancellation_days');
				$charge_rate = $this->input->post('charge_rate');
				$charge_percent = '';
				$per_night = $this->input->post('per_night_price');
			}
			else
			{
				$cancellation_days = '';
				$charge_rate = '';
				$charge_percent = '';
				$per_night = '';
			}
			
			$booking_details = $this->input->post('booking_details');
			//$cancel_details = $this->input->post('cancel_details');
			$cancel_details = '';
			$stdate = $this->input->post('stdate');
			list($y,$m,$d) = explode('-',$stdate);
			$newdate = $y.'-'.$m.'-'.$d;
			$eddate = $this->input->post('eddate');
			list($y1,$m1,$d1) = explode('-',$eddate);
			$newdate1 = $y1.'-'.$m1.'-'.$d1;
			$remarks_room = $this->input->post('remarks_room');
			if($m1!='' && $d1!='' && $y1!='' && $m!='' && $d!='' && $y!=''){
			$d3=mktime(0,0,0,$m1,$d1,$y1);
			$d2=mktime(0,0,0,$m,$d,$y);}
			$diff = floor(($d3-$d2)/86400);
			$cancellation_nights = '';
			$charges = '';
			$type_book = $this->input->post('type_book');
			$pre_payment = $this->input->post('pre_payment');
			$percentage = $this->input->post('percentage');
			$amount = $this->input->post('amount');
			$security_deposit = $this->input->post('security_deposit');
			if($security_deposit == 1)
			{
				$percentage_val = '';
				$per_days = '';
				$amount_val = '';
				$amt_days = '';
				$deposit_method = $this->input->post('deposit_method');
				if($deposit_method == 1)
				{
					$percentage_val = '';
					$per_days = '';
					$amount_val = '';
					$amt_days = '';
				}
				else if($deposit_method == 2)
				{
					$percentage_val = $this->input->post('percentage_val');
					$per_days = $this->input->post('per_days');
					$amount_val = '';
					$amt_days = '';
				}
				else if($deposit_method == 3)
				{
					$amount_val = $this->input->post('amount_val');
					$amt_days = $this->input->post('amt_days');
					$percentage_val = '';
					$per_days = '';
				}
			}
			else 
			{
				$amount_val = '';
				$amt_days = '';
				$percentage_val = '';
				$per_days = '';
				$deposit_method = '';
			}
			//echo $cancellation_days;echo $charge_percent;exit;
		//	echo $security_deposit;exit;
			$this->Supplier_Model->update_rate_details($rate_plan,$default_avail,$capacity,$def_max,$def_min,$day_befr,$rate,$booking,$breakfast,$breakfast_type,$breakfastfrom,$breakfastto,$cancellation,$cancellation_days,$cancellation_nights,$charges,$charge_percent,$charge_rate,$per_night,$booking_details,$cancel_details,$apt_id,$id,$newdate,$newdate1,$remarks_room,$diff,$type_book,$pre_payment,$percentage,$amount,$security_deposit,$deposit_method,$percentage_val,$per_days,$amount_val,$amt_days);
			$checkedval1 = $this->input->post('roomfec_val1');
			$checkval1 = explode(",",$checkedval1);
			$apartid = $this->session->userdata('apt_id');
			$comments = "";
			for($i=0;$i<=count($checkval1)-1;$i++)
			{
				//$this->Supplier_Model->add_check_pictures($apartid,$checkval[$i],$comments);
				$comments = $this->input->post("cmnts1_$checkval1[$i]");
				$this->Supplier_Model->add_check_planpictures($apartid,$checkval1[$i],$comments);
				$comments = "";
			}
			
			redirect('supplier/view_details/'.$id.'/1','refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');	
		}
	}
	function delete_room($id)
	{
		if($this->session->userdata('admin_user_id')!='')
		{
			$apt_id = $this->session->userdata('apt_id');
			$this->Supplier_Model->delete_room($id,$apt_id);
			redirect('supplier/rate/1','refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
	}
	function insert_property_info()
	{
		if($this->session->userdata('admin_user_id')!='')
		{
			$class = $this->input->post('class');
			$group = $this->input->post('group');
			$long = $this->input->post('long');
			$lat = $this->input->post('lat');
			$time_zone = $this->input->post('time_zone');
			$star = $this->input->post('star');
			$currency = $this->input->post('currency');
			$website = $this->input->post('website');
			//$response = $this->input->post('response');
			$response = '';
			$fax = $this->input->post('fax');
			$email = $this->input->post('email');
			$confirmation_fax = $this->input->post('confirmation_fax');
			$confirmation_email = $this->input->post('confirmation_email');
			$address = $this->input->post('address');
			$apt_id = $this->session->userdata('apt_id');
			$prop_info = $this->input->post('prop_info');
			$this->Supplier_Model->delete_property_info($apt_id);
			$this->Supplier_Model->insert_property_info($class,$group,$long,$lat,$time_zone,$star,$currency,$website,$response,$fax,$email,$confirmation_fax,$confirmation_email,$apt_id,$address,$prop_info);
			redirect('supplier/property_info/1','refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
		
	}
	
   function supplier_home($apart_id,$flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['gciflag'] = $flag;
			 $this->session->set_userdata(array('apt_id'=>$apart_id));
			
			$data['sup_details'] = $this->Supplier_Model->get_sup_details($this->session->userdata('admin_user_id'));
			$data['country'] = $this->Supplier_Model->get_country();
			$data['cnt'] = $this->Supplier_Model->get_sup_cnt($this->session->userdata('apt_id'));
			$data['sup'] = $this->Supplier_Model->get_sup_details1($this->session->userdata('apt_id'));
			$data['apt'] = $this->Supplier_Model->get_apt_details($this->session->userdata('apt_id'));
			$data['language'] = $language = $this->Supplier_Model->get_language();
			$data['lang'] = $this->Supplier_Model->get_language_sup($this->session->userdata('admin_user_id'));
			$data['res'] = $this->Supplier_Model->get_reservation_info($this->session->userdata('apt_id'));
			$data['mar'] = $this->Supplier_Model->get_market_info($this->session->userdata('apt_id'));
			$data['fin'] = $this->Supplier_Model->get_finance_info($this->session->userdata('apt_id'));
   			redirect('admin/supplier_home/1/1/'.$this->session->userdata('admin_user_id'),'refresh');
		}
		else
		{
			 redirect('admin', 'refresh');
		}
   }  
   function personel_details($user_id,$flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['perflag'] = $flag;
			$data['sup_details'] = $this->Supplier_Model->get_sup_details($this->session->userdata('admin_user_id'));
			$data['country'] = $this->Supplier_Model->get_country();
			$data['language'] = $language = $this->Supplier_Model->get_language();
			$data['lang'] = $this->Supplier_Model->get_language_sup($this->session->userdata('admin_user_id'));
			$this->load->view('supplier/personel_details',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   } 
   function address_details($user_id,$flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['paflag'] = $flag;
			$data['sup_details'] = $this->Supplier_Model->get_sup_details($this->session->userdata('admin_user_id'));
			$data['country'] = $this->Supplier_Model->get_country();
			$this->load->view('supplier/address_details',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }   
   function update_personel_info($flag="")
   {
	   if($this->session->userdata('admin_user_id')!='')
		{
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$cnum = $this->input->post('cnum');
			$brand = $this->input->post('brand');
			$pos = $this->input->post('pos');
			$noofemp = $this->input->post('noofemp');
			$this->Supplier_Model->update_personel_info($this->session->userdata('admin_user_id'),$fname,$lname,$cnum,$brand,$pos,$noofemp);
			redirect('supplier/personel_details/'.$this->session->userdata('admin_user_id').'/1','refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function update_adds_info()
   {
	   if($this->session->userdata('admin_user_id')!='')
		{
			$address = $this->input->post('address');
			$country = $this->input->post('country');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$postal_code = $this->input->post('postal_code');
			$this->Supplier_Model->update_adds_info($this->session->userdata('admin_user_id'),$address,$country,$state,$city,$postal_code);
			redirect('supplier/address_details/'.$this->session->userdata('admin_user_id').'/1','refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function payment_details($user_id,$apt_id,$flag="")
   {
	   if($this->session->userdata('admin_user_id')!='')
		{
			$data['ppflag'] = $flag;
			$data['sup_details'] = $this->Supplier_Model->get_payment_details($this->session->userdata('admin_user_id'),$apt_id);
			$data['currency'] = $this->Supplier_Model->get_currency();
			$data['country'] = $this->Supplier_Model->get_country();

			$this->load->view('supplier/payment_details',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function sites($user_id,$flag="")
   { if($this->session->userdata('admin_user_id')!='')
		{
			$data['psflag'] = $flag;
			$data['sites'] = $this->Supplier_Model->sites($this->session->userdata('admin_user_id'));
			$this->load->view('supplier/sites',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
	   
   }
   function addsite($flag = "")
   {
	    if($this->session->userdata('admin_user_id')!='')
		{
			$data['psflag'] = $flag;
			$this->load->view('supplier/addsite',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function add_site($flag = "")
   {
	    if($this->session->userdata('admin_user_id')!='')
		{
			$data['psflag'] = $flag;
			$site_id = $this->input->post('site_id');
			$site_name = $this->input->post('site_name');
			$url = $this->input->post('url');
			$status = $this->input->post('status');
			$this->Supplier_Model->add_site($this->session->userdata('admin_user_id'),$site_id,$site_name,$url,$status);
			redirect('supplier/sites/'.$this->session->userdata('admin_user_id').'/1','refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function update_payment_details()
   {
	   if($this->session->userdata('admin_user_id')!='')
		{
			$transfer_to = $this->input->post('transfer_to');
			$acc_num = $this->input->post('acc_num');
			$swjft = $this->input->post('swjft');
			$currency = $this->input->post('currency');
			//$payment = $this->input->post('payment');
			$payment = '';
			$bank_name = $this->input->post('bank_name');
			$bank_adds1 = $this->input->post('bank_adds1');
			$bank_adds2 = $this->input->post('bank_adds2');
			$country = $this->input->post('country');
			$bank_state = $this->input->post('bank_state');
			$bank_city = $this->input->post('bank_city');
			$postal_code = $this->input->post('postal_code');
			$tax_id = $this->input->post('tax_id');
			$this->Supplier_Model->update_payment_details($this->session->userdata('admin_user_id'),$transfer_to,$acc_num,$swjft,$currency,$payment,$bank_name,$bank_adds1,$bank_adds2,$country,$bank_state,$bank_city,$postal_code,$tax_id,$this->session->userdata('apt_id'));
			redirect('supplier/payment_details/'.$this->session->userdata('admin_user_id').'/1','refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function add_accommodation($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['gcflag'] = $flag;
			$apt_id = $this->session->set_userdata(array('apt_id'=>''));
			$data['sup_details'] = $this->Supplier_Model->get_sup_details($this->session->userdata('apt_id'));
			$apart_id = $this->db->insert_id();
			$data['country'] = $this->Supplier_Model->get_country();
			$data['cnt'] = "";
			$data['sup'] = $this->Supplier_Model->get_sup_details($this->session->userdata('admin_user_id'));
			$data['apt'] = $this->Supplier_Model->get_apt_details($this->session->userdata('apt_id'));
			$data['language'] = $language = $this->Supplier_Model->get_language();
			$data['lang'] = $this->Supplier_Model->get_language_sup($this->session->userdata('admin_user_id'));
			/*$data['res'] = $this->Supplier_Model->get_reservation_info($this->session->userdata('apt_id'));
			$data['mar'] = $this->Supplier_Model->get_market_info($this->session->userdata('apt_id'));
			$data['fin'] = $this->Supplier_Model->get_finance_info($this->session->userdata('apt_id'));*/
   			$this->load->view('supplier/supplier_home',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function apart_list()
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['apartment_list'] = $this->Supplier_Model->apartment_list($this->session->userdata('admin_user_id'));
			//print_r($data['apartment_list']);exit();
			$this->load->view('view_props',$data); 
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function detail_loc($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['dlflag']=$flag;
			$data['pos'] = $this->Supplier_Model->get_position($this->session->userdata('apt_id'));
			$data['loc'] = $this->Supplier_Model->get_location($this->session->userdata('apt_id'));
			$this->load->view('supplier/detail_loc',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function prop_level($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['prop_levellflag']=$flag;
			$data['pos'] = $this->Supplier_Model->get_pay_process($this->session->userdata('apt_id'));
			$this->load->view('supplier/payment_process',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function insert_pay_process($flag="")
   {
	   if($this->session->userdata('admin_user_id')!='')
		{
			$pay_process = $this->input->post('pay_process');
			$pos = $this->Supplier_Model->get_pay_process($this->session->userdata('apt_id'));
			if($pos != '')
			{
				$this->Supplier_Model->update_pay_process($pay_process,$this->session->userdata('apt_id'));
			}
			else
			{
				$this->Supplier_Model->insert_pay_process($pay_process,$this->session->userdata('apt_id'));
			}
			redirect('supplier/prop_level/1','refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function add_location()
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$location = $this->input->post('location');
			$airport = $this->input->post('airport');
			$transport = $this->input->post('transport');
			$interest = $this->input->post('interest');
			$apt_id = $this->session->userdata('apt_id');
			$this->Supplier_Model->delete_location($apt_id);
			$this->Supplier_Model->add_location($location,$airport,$transport,$interest,$apt_id);
			 redirect('supplier/detail_loc', 'refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function upload_picture()
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			if(isset($_FILES['image1']['name'])!='' && $_FILES['image1']['type']=='image/jpeg' || $_FILES['image1']['type']=='image/jpg' || $_FILES['image1']['type']=='image/gif' || $_FILES['image1']['type']=='image/png')
			  {         
			    $file=$_FILES['image1']['name'];
				copy($_FILES['image1']['tmp_name'],"uploadimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img1="apt".$date.".".$ext;
				rename('uploadimage/'.$file,'uploadimage/'.$img1);	
				$apt_id = $this->session->userdata('apt_id');
				$this->Supplier_Model->upload_picture($img1,$apt_id);		
	    	}
			
			redirect('supplier/appartment_pictures','refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
   }
   function upload_room_picture()
   {
   		$room_id = $this->input->post('room_id');
   		if($this->session->userdata('admin_user_id')!='')
		{
			if(isset($_FILES['image1']['name'])!='' && $_FILES['image1']['type']=='image/jpeg' || $_FILES['image1']['type']=='image/jpg' || $_FILES['image1']['type']=='image/gif' || $_FILES['image1']['type']=='image/png')
			  {         
			    $file=$_FILES['image1']['name'];
				copy($_FILES['image1']['tmp_name'],"uploadroomimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img1="apt".$date.".".$ext;
				rename('uploadroomimage/'.$file,'uploadroomimage/'.$img1);	
				$apt_id = $this->session->userdata('apt_id');
				$this->Supplier_Model->upload_room_picture($img1,$apt_id,$room_id);		
	    	}
			
			redirect('supplier/view_unit_details/'.$room_id,'refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
   }
   function unit_info($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['ctflag'] = $flag;
			$apt_id = $this->session->userdata('apt_id');
			$data['roomfecility_list'] = $this->Supplier_Model->get_roomfecilitylist(); 
			$data['plan_list'] = $this->Supplier_Model->get_plan_listval($apt_id);
			$data['plan1'] = $plan =  $this->Supplier_Model->get_plans($this->session->userdata('apt_id'));
			$this->load->view('supplier/unit_info',$data); 
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function get_ind_units()
   {
	  $data['id'] =  $id = $this->input->post('plan_name');
	   $data['ctflag'] = 1;
	   $data['unit_details'] = $this->Supplier_Model->get_unit_details_indi($id);
		$data['plan_list'] = $this->Supplier_Model->get_plan_listval($this->session->userdata('apt_id'));
		$data['roomfecility_list'] = $this->Supplier_Model->get_roomfecilitylist(); 
		$data['roomfecility_val'] = $this->Supplier_Model->get_roomfecilities($this->session->userdata('apt_id'));
		$data['plan1'] = $plan =  $this->Supplier_Model->get_plans($this->session->userdata('apt_id'));
		//$data['pic'] = $this->Supplier_Model->get_room_picures($id); 
		$this->load->view('supplier/unit_info',$data);
   }
   function delete_unit($id)
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$this->Supplier_Model->delete_unit($id);
			redirect('supplier/unit','refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function house_rules($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['hrflag'] = $flag;
			$data['time'] = $this->Supplier_Model->get_times();
			$data['rules'] = $this->Supplier_Model->get_rules($this->session->userdata('apt_id'));
			$this->load->view('supplier/house_rules',$data); 
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function extra_services($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['esflag'] = $flag;
			$apt_id = $this->session->userdata('apt_id');
			$data['extra_details'] = $this->Supplier_Model->get_extra_details($apt_id);
			$this->load->view('supplier/extra_services',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function rate($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['rtflag'] = $flag;
			$data['rooms'] = $this->Supplier_Model->get_rooms($this->session->userdata('apt_id'));
			$this->load->view('supplier/rate_list',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function open_close_date($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$apt_id = $this->session->userdata('apt_id');
			$data['opflag'] = $flag;
			$month = $this->input->post('month');
			$data['months'] = $months =  $this->Supplier_Model->get_all_months($apt_id);
			if($month!='')
			{
				$month = explode(',',$month);
				$data['month_name'] = $month_name = $month[0];
				$data['year_name'] = $year_name = $month[1];
				$data['plan'] = $plan = $this->Supplier_Model->get_indiv_plans($apt_id);
				$data['dates'] = $this->Supplier_Model->get_all_dates($month_name,$year_name,$apt_id);
			}
			else
			{
				if($months!='')
				{
					$data['month_name'] =  $month_name = $months[0]->month;
					$data['year_name'] =  $year_name = $months[0]->year;
					$data['plan'] = $plan = $this->Supplier_Model->get_indiv_plans($apt_id);
					$data['dates'] = $this->Supplier_Model->get_all_dates($month_name,$year_name,$apt_id);				
				}
				else
				{
					$data['month_name'] = '';
					$data['year_name'] = '';
				}
			}
			$this->load->view('supplier/open_close',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function change_status($flag="",$id,$status,$month_name,$year_name)
   {
   		$data['opflag'] = $flag;
		$apt_id = $this->session->userdata('apt_id');
		$data['months'] = $months =  $this->Supplier_Model->get_all_months($apt_id);
	   	if($this->session->userdata('admin_user_id')!='')
		{
			$data['month_name'] =  $month_name;
			$data['year_name'] =  $year_name;
			$this->Supplier_Model->change_status($id,$status);
			$data['plan'] = $plan = $this->Supplier_Model->get_indiv_plans($apt_id);
			$data['dates'] = $this->Supplier_Model->get_all_dates($month_name,$year_name,$apt_id);
			$this->load->view('supplier/open_close',$data);
			//redirect('supplier/open_close_date','refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function open_all($flag="",$date,$id,$month_name,$year_name)
   {
   		$data['opflag'] = $flag;
		$apt_id = $this->session->userdata('apt_id');
		$data['months'] = $months =  $this->Supplier_Model->get_all_months($apt_id);
	   	if($this->session->userdata('admin_user_id')!='')
		{
			$this->Supplier_Model->open_all($date,$id);
			$data['month_name'] =  $month_name;
			$data['year_name'] =  $year_name;
			$data['plan'] = $plan = $this->Supplier_Model->get_indiv_plans($apt_id);
			$data['dates'] = $this->Supplier_Model->get_all_dates($month_name,$year_name,$apt_id);
			$this->load->view('supplier/open_close',$data);
			//redirect('supplier/open_close_date','refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function close_all($flag="",$date,$id,$month_name,$year_name)
   {
   		$data['opflag'] = $flag;
		$apt_id = $this->session->userdata('apt_id');
		$data['months'] = $months =  $this->Supplier_Model->get_all_months($apt_id);
	   	if($this->session->userdata('admin_user_id')!='')
		{
			$this->Supplier_Model->close__all($date,$id);
			$data['month_name'] =  $month_name;
			$data['year_name'] =  $year_name;
			$data['plan'] = $plan = $this->Supplier_Model->get_indiv_plans($apt_id);
			$data['dates'] = $this->Supplier_Model->get_all_dates($month_name,$year_name,$apt_id);
			$this->load->view('supplier/open_close',$data);
			//redirect('supplier/open_close_date','refresh');
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function maintain_by_month($flag="")
   {
    	if($this->session->userdata('admin_user_id')!='')
		{
			$apt_id = $this->session->userdata('apt_id');
			$data['mflag'] = $flag;
			$data['room_plan'] = $room_plan = $this->input->post('room_plan');
			$data['month'] = $month = $this->input->post('month');
			$data['year'] = $year = $this->input->post('year');
			if($month!='')
			{
				$data['checkedval'] = $checkedval = $this->input->post('apartfec_val');
				$data['newdate'] = $newdate = $this->Supplier_Model->get_min_date($month,$year,$room_plan,$apt_id);
				list($y,$m,$d) = explode('-',$newdate);
				$data['stdate'] = $d.'/'.$m.'/'.$y;
				$data['newdate1'] = $newdate1 = $this->Supplier_Model->get_max_date($month,$year,$room_plan,$apt_id);
				list($y1,$m1,$d1) = explode('-',$newdate1);
				$data['eddate'] = $d1.'/'.$m1.'/'.$y1;
				$data['room'] = $room =  $this->Supplier_Model->get_maintain_plans($apt_id);
				$room_id = $room[0]->sup_apart_rateplan_id;
				$data['name'] = $this->Supplier_Model->get_name($room_plan);
				$data['month'] = $month = $this->Supplier_Model->get_months($apt_id,$room_plan);
				if($checkedval != '')
				{
					$data['all'] = $all = $this->Supplier_Model->get_latest_details_week($newdate,$newdate1,$room_plan,$checkedval);				}
				else
				{
					$data['all'] = $all = $this->Supplier_Model->get_latest_details($newdate,$newdate1,$room_plan);
				}
				
			}
			else if($room_plan != '')
			{
				$data['stdate'] =  $stdate = $this->input->post('stdate');
				list($d,$m,$y) = explode('/',$stdate);
				$newdate = $y.'-'.$m.'-'.$d;
				$data['eddate'] =  $eddate = $this->input->post('eddate');
				list($d1,$m1,$y1) = explode('/',$eddate);
				$newdate1 = $y1.'-'.$m1.'-'.$d1;
				$data['checkedval'] = $checkedval = $this->input->post('apartfec_val');
				$data['room'] = $room =  $this->Supplier_Model->get_maintain_plans($apt_id);
				$room_id = $room[0]->sup_apart_rateplan_id;
				$data['name'] = $this->Supplier_Model->get_name($room_plan);
				$data['month'] = $month = $this->Supplier_Model->get_months($apt_id,$room_plan);
				if($checkedval != '')
				{
					$data['all'] = $all = $this->Supplier_Model->get_latest_details_week($newdate,$newdate1,$room_plan,$checkedval);				}
				else
				{
					$data['all'] = $all = $this->Supplier_Model->get_latest_details($newdate,$newdate1,$room_plan);
				}
				
			}
			else
			{
			$room = '';
			$data['room'] = $room =  $this->Supplier_Model->get_maintain_plans($apt_id);
			if($room!='')
			{
				$room_id = $room[0]->sup_apart_rateplan_id;
			}
			else
			{
				$room_id = '';
			}
			$sdate =  date("d/m/Y",strtotime("+0 day"));
			list($d,$m,$y) = explode('/',$sdate);
			$newdate = $y.'-'.$m.'-'.$d;
			$edate =  date("d/m/Y",strtotime("+13 day"));
			list($d1,$m1,$y1) = explode('/',$edate);
			$newdate1 = $y1.'-'.$m1.'-'.$d1;
			$data['name'] = $this->Supplier_Model->get_name($room_id);
			$data['all'] = $all = $this->Supplier_Model->get_first_details($room_id,$newdate,$newdate1);
			$data['month'] = $month = $this->Supplier_Model->get_months($apt_id,$room_id);
			}
			$this->load->view('supplier/mainatain_month',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function update_maintain_month($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['mflag'] = $flag;
			$data['stdate'] = $from = $this->input->post('from');
			$data['eddate'] = $to = $this->input->post('to');
			list($d,$m,$y) = explode('/',$from);
			$newdate = $y.'-'.$m.'-'.$d;
			list($d1,$m1,$y1) = explode('/',$to);
			$newdate1 = $y1.'-'.$m1.'-'.$d1;
			$data['room_plan'] = $room_id = $this->input->post('room_id');
			$data['name'] = $this->Supplier_Model->get_name($room_id);
			$user_id = $this->session->userdata('admin_user_id');
			$apt_id = $this->session->userdata('apt_id');
			$data['month'] = $month = $this->Supplier_Model->get_months($apt_id,$room_id);
			$this->Supplier_Model->update_all($room_id,$apt_id,$newdate,$newdate1);
	   		$on_req_checked = $this->input->post('on_req_checked');
			$on_req_checked_val = explode(",",$on_req_checked);
			for($i=0;$i<=count($on_req_checked_val)-1;$i++)
			{
				$this->Supplier_Model->update_onreq($apt_id,$on_req_checked_val[$i],$room_id);
			}	
			$on_arr_checked = $this->input->post('on_arr_checked');
			$on_arr_checked_val = explode(",",$on_arr_checked);
			for($j=0;$j<=count($on_arr_checked_val)-1;$j++)
			{
				$this->Supplier_Model->update_on_arr($apt_id,$on_arr_checked_val[$j],$room_id);
			}
			$on_blk_checked = $this->input->post('on_blk_checked');
			$on_blk_checked_val = explode(",",$on_blk_checked);
			for($k=0;$k<=count($on_blk_checked_val)-1;$k++)
			{
				$this->Supplier_Model->update_on_blk($apt_id,$on_blk_checked_val[$k],$room_id);
			}
	   		$cnt = $this->input->post('cnt');
			$date1 = $this->input->post('date');
			$price1 = $this->input->post('price');
			$avial1 = $this->input->post('avail');
			$min1 = $this->input->post('min_stay');
			$max1 = $this->input->post('max_stay');
			for($i = 0; $i<$cnt;$i++)
			{
				$date = $this->input->post('date'.$i);
				$price = $price1[$i];
				$avail =  $avial1[$i];
				$min_stay =  $min1[$i];
				$max_stay =  $max1[$i];
				$this->Supplier_Model->update_by_month($apt_id,$room_id,$price,$avail,$min_stay,$max_stay,$date);
			}
			$data['room'] = $room =  $this->Supplier_Model->get_maintain_plans($apt_id);
			$data['all'] = $all = $this->Supplier_Model->get_first_details($room_id,$newdate,$newdate1);
			$this->load->view('supplier/mainatain_month',$data);
   		}
		
		else
		{
			redirect('home/supplier', 'refresh');
		}
	}
   function ratedetail($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['rtflag'] = $flag;
			$data['time'] = $this->Supplier_Model->get_times();
			$data['rate'] = $this->Supplier_Model->get_rate($this->session->userdata('apt_id'));
			$data['plan'] = $this->Supplier_Model->get_plans($this->session->userdata('apt_id'));
			$data['plan1'] = $plan =  $this->Supplier_Model->get_rate_plans($this->session->userdata('apt_id'));
			$data['pos'] = $this->Supplier_Model->get_pay_process($this->session->userdata('apt_id'));
			$this->load->view('supplier/rate_details',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function get_ind_plan($flag="")
   {
	  $data['id'] =  $id = $this->input->post('plan_name');
	  $data['rtflag'] = 1;
			$data['time'] = $this->Supplier_Model->get_times();
			$data['rate'] = $this->Supplier_Model->get_rate($id);
			$data['plan'] = $this->Supplier_Model->get_plans($this->session->userdata('apt_id'));
			$data['pic'] = $this->Supplier_Model->get_plan_picures($id); 
			$data['pre'] = $this->Supplier_Model->pre_payment($id);
		$data['plan1'] = $plan =  $this->Supplier_Model->get_rate_plans($this->session->userdata('apt_id'));
		$data['cat_name1'] = $cat_name1 =  $this->Supplier_Model->cat_name($id);
		//echo $cat_name;exit;
		//echo "<pre>"; print_r($data);exit;
		//$data['pic'] = $this->Supplier_Model->get_room_picures($id); 
		//echo $id;exit;
		$this->load->view('supplier/rate_details',$data);
   }
   function unit($flag="")
   {
   		$data['ctflag'] = $flag;
   		$data['units'] = $this->Supplier_Model->get_units($this->session->userdata('apt_id'));
   		$this->load->view('supplier/unit_list',$data);
   }
    function view_details($id,$flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['pos'] = $this->Supplier_Model->get_pay_process($this->session->userdata('apt_id'));
			$data['rtflag'] = $flag;
			$data['time'] = $this->Supplier_Model->get_times();
			$data['rate'] =$rate =  $this->Supplier_Model->get_rate($id);
			$data['plan'] = $this->Supplier_Model->get_plans($this->session->userdata('apt_id'));
			$data['pic'] = $this->Supplier_Model->get_plan_picures($id); 
			$data['pre'] = $this->Supplier_Model->pre_payment($id);
			$data['pos'] = $this->Supplier_Model->get_pay_process($this->session->userdata('apt_id'));
			$this->load->view('supplier/view_details',$data);
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
   }
   function upload_plan_picture()
   {
   		$room_id = $this->input->post('room_id');
   		if($this->session->userdata('admin_user_id')!='')
		{
			if(isset($_FILES['image1']['name'])!='' && $_FILES['image1']['type']=='image/jpeg' || $_FILES['image1']['type']=='image/jpg' || $_FILES['image1']['type']=='image/gif' || $_FILES['image1']['type']=='image/png')
			  {         
			    $file=$_FILES['image1']['name'];
				copy($_FILES['image1']['tmp_name'],WEB_DIR."uploadroomimage/$file");
				$ext = end(explode('.',$file));
				$date=date('ymdhis');
				$img1="apt".$date.".".$ext;
				rename(WEB_DIR.'uploadroomimage/'.$file,WEB_DIR.'uploadroomimage/'.$img1);	
				$apt_id = $this->session->userdata('apt_id');
				$this->Supplier_Model->upload_plan_picture($img1,$apt_id,$room_id);		
	    	}
			
			redirect('supplier/view_details/'.$room_id,'refresh');
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
   }
    function delete_planpicture($id)
   {
		if($this->session->userdata('admin_user_id')!='')
		{
			$img = $this->Supplier_Model->delete_planpicture($id);
			unlink(WEB_DIR.'/uploadroomimage/'.$img);
			$this->Supplier_Model->delete_planpictures($id);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function view_unit_details($id,$flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['ctflag'] = $flag;
			$data['unit_details'] = $this->Supplier_Model->get_unit_details_indi($id);
			$data['plan_list'] = $this->Supplier_Model->get_plan_listval($this->session->userdata('apt_id'));
			$data['roomfecility_list'] = $this->Supplier_Model->get_roomfecilitylist(); 
			$data['roomfecility_val'] = $this->Supplier_Model->get_roomfecilities($this->session->userdata('apt_id'));
			$data['pic'] = $this->Supplier_Model->get_room_picures($id); 
			$this->load->view('supplier/view_unit_info',$data);
		}
		else
		{
			redirect('home/supplier', 'refresh');
		}
   }
   function booking_list($flag="")
   {	
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['blflag'] = $flag;
			$stdate = $this->input->post('stdate');
			$eddate = $this->input->post('eddate');
			/*$class = $this->input->post('class');
			if($class)
			{
				
			}*/
			$status = $this->input->post('status');
			if($status && $stdate)
			{
				list($d,$m,$y) = explode('/',$stdate);
				$stdate = $y.'-'.$m.'-'.$d;
				list($d1,$m1,$y1) = explode('/',$eddate);
				$eddate = $y1.'-'.$m1.'-'.$d1;
			$data['bookings'] = $this->Supplier_Model->get_bokings_sup_dates_status($this->session->userdata('apt_id'),$stdate,$eddate,$status);	
			}
			else if($stdate)
			{
				list($d,$m,$y) = explode('/',$stdate);
				$stdate = $y.'-'.$m.'-'.$d;
				list($d1,$m1,$y1) = explode('/',$eddate);
				$eddate = $y1.'-'.$m1.'-'.$d1;
				$data['bookings'] = $this->Supplier_Model->get_bokings_sup_dates($this->session->userdata('apt_id'),$stdate,$eddate);
			}
			else if($status)
			{
				$data['bookings'] = $this->Supplier_Model->get_bokings_sup_status($this->session->userdata('apt_id'),$status);	
			}
			else
			{
				$data['bookings'] = $this->Supplier_Model->get_bokings_sup($this->session->userdata('apt_id'));
			}
			$data['class'] = $this->Supplier_Model->get_classtype();
			$this->load->view('supplier/booking_list',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function property_info($flag="")
   {
		if($this->session->userdata('admin_user_id')!='')
		{
			$data['piflag'] = $flag;
			$data['class'] = $this->Supplier_Model->get_classtype();
			$data['time'] = $this->Supplier_Model->get_timezone();
			$data['currency'] = $this->Supplier_Model->get_currency();
			$data['profile'] = $this->Supplier_Model->get_profile($this->session->userdata('apt_id'));
			//echo "<pre>"; print_r($data);exit;
			$this->load->view('supplier/property_info',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}

   }
   function general_settings($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['gsflag'] = $flag;
			$data['cards'] = $this->Supplier_Model->get_cards();
			$data['usedcards'] = $this->Supplier_Model->get_cardacceptedlist($this->session->userdata('apt_id'));
			$data['general'] = $this->Supplier_Model->get_taxes($this->session->userdata('apt_id'));
			$data['tax'] = $this->Supplier_Model->get_general($this->session->userdata('apt_id'));
			$data['time'] = $this->Supplier_Model->get_times();
			$this->load->view('supplier/general_settings',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
 
   function appartment_facilities($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['afflag'] = $flag;
			$data['apartfecility_list'] = $this->Supplier_Model->get_apartfecilitylist(); 
			$data['apartfecility_val'] = $this->Supplier_Model->get_apartfecilities($this->session->userdata('apt_id')); 
			$this->load->view('supplier/appartment_facilities',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function reg_apart_roomfacilityinfo()
	{
		$checkedval = $this->input->post('roomfec_val');
		$checkval = explode(",",$checkedval);
		$user = $this->session->userdata('admin_user_id');
		$apartid = $this->session->userdata('apt_id');
		$this->Supplier_Model->del_supplier_roomfecility($apartid);
		$comments = "";
		for($i=0;$i<=count($checkval)-1;$i++){
				$comments = $this->input->post("cmnts_$checkval[$i]");
				$this->Supplier_Model->add_supplier_roomfecility($user,$apartid,$checkval[$i],$comments);
				$comments = "";
			}	
		redirect("supplier/room_facilities/",'refresh');
	
	}
   function reg_apart_facilityinfo()
	{
		$checkedval = $this->input->post('apartfec_val');
		$checkval = explode(",",$checkedval);
		$user = $this->session->userdata('admin_user_id');
		$apartid = $this->session->userdata('apt_id');
		/*echo "Done"; print_r($checkval);
		echo "<br/>User==".$user;
		echo "<br/>hotelid==".$hotelid;
		exit();*/
		$this->Supplier_Model->del_supplier_apartfecility($apartid);
		$comments = "";
		for($i=0;$i<=count($checkval)-1;$i++){
				$comments = $this->input->post("cmnts_$checkval[$i]");
				$this->Supplier_Model->add_supplier_apartfecility($user,$apartid,$checkval[$i],$comments);
				$comments = "";
			}	
		//$this->Supplier_Model->add_supplier_apartfecility($user,$apartid,$checkval);
		redirect("supplier/appartment_facilities/1",'refresh');
	
	}
	function insert_general_settings()
	{
		$checkedval = $this->input->post('apartfec_val');
		$checkval = explode(",",$checkedval);
		$user = $this->session->userdata('admin_user_id');
		$apartid = $this->session->userdata('apt_id');
		$checkin_from = $this->input->post('checkin_from');
		//print $checkin_from; exit;
		$checkin_to = $this->input->post('checkin_to');
		$checkout_from = $this->input->post('checkout_from');
		//print $checkout_from; exit;
		$checkout_to = $this->input->post('checkout_to');
		$checkin_hr = $this->input->post('checkin_hr');
		$checkout_hr = $this->input->post('checkout_hr');
		$collection = $this->input->post('collection');
		$desc = $this->input->post('desc');
		$state_tax = $this->input->post('state_tax');
		$state_percentage = $this->input->post('state_percentage');
		if($state_percentage == 1)
		{
			$state_totalstay_flag = 1;
			$state_fixedprice_flag = 0;
		}
		else if($state_percentage == 2)
		{
			$state_totalstay_flag = 0;
			$state_fixedprice_flag = 1;
		}
		else
		{
			$state_totalstay_flag = 0;
			$state_fixedprice_flag = 0;
		}
		$state_percentage_val = $this->input->post('state_percentage_val');
		$state_persons = $this->input->post('state_persons');
		$state_price = $this->input->post('state_price');
		$city_tax = $this->input->post('city_tax');
		$city_percentage = $this->input->post('city_percentage');
		if($city_percentage == 1)
		{	
			$city_totalstay_flag = 1;
			$city_fixedprice_flag = 0;
		}
		else if($city_percentage == 2)
		{
			$city_totalstay_flag = 0;
			$city_fixedprice_flag = 1;
		}
		else
		{
			$city_totalstay_flag = 0;
			$city_fixedprice_flag = 0;
		}
		$city_percentage_val = $this->input->post('city_percentage_val');
		$city_persons = $this->input->post('city_persons');
		$city_price = $this->input->post('city_price');
		$room_tax = $this->input->post('room_tax');
		$room_percentage = $this->input->post('room_percentage');
		if($room_percentage == 1)
		{
			$room_totalstay_flag = 1;
			$room_fixedprice_flag = 0;
		}
		else if($room_percentage == 2)
		{
			$room_totalstay_flag = 0;
			$room_fixedprice_flag = 1;
		}
		else
		{
			$room_totalstay_flag = 0;
			$room_fixedprice_flag = 0;
		}
		$room_percentage_val = $this->input->post('room_percentage_val');
		$room_persons = $this->input->post('room_persons');
		$room_price = $this->input->post('room_price');
		$vat_tax = $this->input->post('vat_tax');
		$vat_percentage = $this->input->post('vat_percentage');
		if($vat_percentage == 1)
		{
			$vat_totalstay_flag = 1;
			$vat_fixedprice_flag = 0;
		}
		else if($vat_percentage == 2)
		{
			$vat_totalstay_flag = 0;
			$vat_fixedprice_flag = 1;
		}
		else
		{
			$vat_totalstay_flag = 0;
			$vat_fixedprice_flag = 0;
		}
		$vat_percentage_val = $this->input->post('vat_percentage_val');
		$vat_persons = $this->input->post('vat_persons');
		$vat_price = $this->input->post('vat_price');
		$service_tax = $this->input->post('service_tax');
		$service_percentage = $this->input->post('service_percentage');
		if($service_percentage == 1)
		{
			$service_totalstay_flag = 1;
			$service_fixedprice_flag = 0;
		}
		else if($service_percentage == 2)
		{
			$service_totalstay_flag = 0;
			$service_fixedprice_flag = 1;
		}
		else
		{
			$service_totalstay_flag = 0;
			$service_fixedprice_flag = 0;
		}
		$service_percentage_val = $this->input->post('service_percentage_val');
		$service_persons = $this->input->post('service_persons');
		$service_price = $this->input->post('service_price');
		$group = $this->input->post('group');
		$this->Supplier_Model->delete_general_settings($apartid);
		$this->Supplier_Model->insert_general_settings($checkin_from,$checkin_to,$checkout_from,$checkout_to,$checkin_hr,$checkout_hr,$collection,$desc,$state_tax,$state_percentage,$state_percentage_val,$state_persons,$state_price,$city_tax,$city_percentage,$city_percentage_val,$city_persons,$city_price,$room_tax,$room_percentage,$room_percentage_val,$room_persons,$room_price,$vat_tax,$vat_percentage,$vat_percentage_val,$vat_persons,$vat_price,$service_tax,$service_percentage,$service_percentage_val,$service_persons,$service_price,$group,$apartid,$state_totalstay_flag,$state_fixedprice_flag,$city_totalstay_flag,$city_fixedprice_flag,$room_totalstay_flag,$room_fixedprice_flag,$vat_totalstay_flag,$vat_fixedprice_flag,$service_totalstay_flag,$service_fixedprice_flag);
		for($i=0;$i<=count($checkval)-1;$i++){
				$this->Supplier_Model->insert_general_settings_cards($user,$apartid,$checkval[$i]);
		}
		redirect("supplier/general_settings/1",'refresh');
	
	}
	function check_pictures()
	{
		
		$checkedval = $this->input->post('apartfec_val');
		$checkval = explode(",",$checkedval);
		$user = $this->session->userdata('admin_user_id');
		$apartid = $this->session->userdata('apt_id');

		//echo $added_by ; exit;
		for($i=0;$i<=count($checkval)-1;$i++)
		{
			//echo count($checkval);
			$comments = $this->input->post("cmnts_$checkval[$i]");
			$status = $this->input->post("status");
			

			//echo $checkval[$i];exit;
			$this->Supplier_Model->add_check_pictures($apartid,$checkval[$i],$comments,$status);
			$comments = "";
		}	
		redirect("supplier/appartment_pictures",'refresh');
	}
   function room_facilities($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['sfflag'] = $flag;
			$data['roomfecility_list'] = $this->Supplier_Model->get_roomfecilitylist(); 
			$data['roomfecility_val'] = $this->Supplier_Model->get_roomfecilities($this->session->userdata('apt_id')); 
			$this->load->view('supplier/room_facilities',$data); 
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function delete_picture($id)
   {
		if($this->session->userdata('admin_user_id')!='')
		{
			$img = $this->Supplier_Model->delete_picture($id);
			unlink(WEB_DIR_ADMIN.'/uploadimage/'.$img);
			$this->Supplier_Model->delete_pictures($id);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function delete_roompicture($id)
   {
		if($this->session->userdata('admin_user_id')!='')
		{
			$img = $this->Supplier_Model->delete_roompicture($id);
			unlink(WEB_DIR.'/uploadroomimage/'.$img);
			$this->Supplier_Model->delete_roompictures($id);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function appartment_pictures($flag="")
   {
   		if($this->session->userdata('admin_user_id')!='')
		{
			$data['apflag'] = $flag;
			$data['apartfecility_list'] = $this->Supplier_Model->get_apartfecilitylist(); 
			$apt_id = $this->session->userdata('apt_id');
			$data['pic'] = $this->Supplier_Model->get_picures($apt_id);
			$this->load->view('supplier/appartment_pictures',$data);
			
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
   }
   function supplier_reg()
   {
   		$data['country'] = $country = $this->Supplier_Model->get_country();
		$data['language'] = $language = $this->Supplier_Model->get_language();
	   	$this->load->view('supplier/supplier_reg',$data);
		
   }
   function confirm_agent($email)
	{
		$data=$this->Supplier_Model->check_username_valid($email);
	    if($data!='')
	  	{
	   		echo 'Login Name Already exist';
	   	}
	}
	function confirm_sup()
	{
		$email = $this->input->post('user');
		//$data=$this->Supplier_Model->check_sup_email_valid($email);
	    if($this->Supplier_Model->check_sup_email_valid($email))
	  	{
	   		echo 1;
	   	}
		else
		{
			echo 0;
		}
	}
	function confirm_cust()
	{
		$email = $this->input->post('user');
		//$data=$this->Supplier_Model->check_sup_email_valid($email);
	    if($this->Supplier_Model->check_cust_email_valid($email))
	  	{
	   		echo 1;
	   	}
		else
		{
			echo 0;
		}
	}
	function confirm_pwd()
	{
		$cur_pwd = $this->input->post('cur_pwd');
		$id  = $this->session->userdata('admin_user_id');
	    $result = $this->Supplier_Model->check_confirm_pwd($id,$cur_pwd);
		if($result)
		{
	   		echo 1;
	   	}
		else
		{
			echo 0;
		}
	}
	function change_password()
	{
		if($this->session->userdata('admin_user_id')!='')
		{
			$cur_pwd = $this->input->post('cur_pwd');
			$new_pwd = $this->input->post('new_pwd');
			$renew_pwd = $this->input->post('renew_pwd');
			$id = $this->session->userdata('admin_user_id');
			$this->Supplier_Model->change_password($new_pwd,$id);
			if($this->session->userdata('apt_id')!='')
			{
				redirect('supplier/supplier_home/'.$this->session->userdata('apt_id').'/1','refresh');
			}
			else
			{
				redirect('supplier/apart_list','refresh');
			}
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
	}
	function add_supplier()
	{
		$country = $this->input->post('country');
		$city = $this->input->post('city');
		$appt_name = $this->input->post('appt_name');
		$language = $this->input->post('language');
		$gen_sal = $this->input->post('gen_sal');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$passd = $this->input->post('passd');
		$prop_name = $this->input->post('prop_name');
		$res = $this->Supplier_Model->get_sup_emails();
		$this->Supplier_Model->add_supplier($country,$city,$appt_name,$language,$gen_sal,$fname,$lname,$email,$passd,$prop_name);
		//require("PHPMailer/class.phpmailer.php"); 
       	$mail = new PHPMailer();
		//$mail->From = 'info@stayserviced.com';
		//$mail->FromName = "no-reply@stayserviced.com";
		//$mail->Host='mail.stayserviced.com';
		$mail->Port='587';
		//$mail->Username   = 'info@stayserviced.com';
		//$mail->Password   = 'sunlight';
		$mail->SMTPKeepAlive = true;
		//$mail->Mailer = "smtp";
		$mail->WordWrap = FALSE;
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->AddAddress($email);
		$sub =  $res->email_subject;
		$msg = str_replace('{name}',ucfirst($fname),$res->html_content);
		$msg = str_replace('{user email}',$email,$msg);
		$msg.= $res->footer;
		$mail->Subject = $sub;
       	$mail->Body = $msg;
		$mail->SMTPAuth   = true;                 // enable SMTP authentication
		$mail->CharSet = 'utf-8';
		$mail->SMTPDebug  = 0;
		if(!$mail->Send())
		{
		    show_error($this->email->print_debugger());
		}
		else
		{
			redirect('home/supplier','refresh');
		}
		
		
	}
	function view_supplier()
	{
		$this->load->view('header');
		$this->load->view('supplier/apartment_facilities');
		$this->load->view('footer');
	}
	function create_user()
   {
	$username=$this->input->post('username');
	$firstname=$this->input->post('firstname');
	$middlename=$this->input->post('middlename');
	$lastname=$this->input->post('lastname');
	$email=$this->input->post('email');
	$password=$this->input->post('password');
	$user_type=$this->input->post('user_type');
	$gender=$this->input->post('gender');
	$address=$this->input->post('address');
	$mobile_no=$this->input->post('mobile_no');
	$alternative_no=$this->input->post('alternative_no');
	$country=$this->input->post('country');
	$city=$this->input->post('city');
	$postal_code=$this->input->post('postal_code');
	$nationality=$this->input->post('nationality');
	$user_id=$this->Supplier_Model->insert_user($username,$firstname,$middlename,$lastname,$email,$password,$user_type);
	$profile_id=$this->Supplier_Model->insert_profile($gender,$address,$mobile_no,$alternative_no,$country,$city,$postal_code,$nationality,$user_id);
	$this->session->set_userdata(array('user_id'=>$user_id));
	redirect('supplier/supplier_main_home','refresh');
	
   }
   function update_profile()
   {
	if($this->session->userdata('admin_user_id') !='')
		{
			$data['hotel_name']='';
			$data['hotel_city']='';
			$data['hotel_desc']= $this->Supplier_Model->hotel_details($this->session->userdata('admin_user_id'));
			$data['hotel_desc_name']= $this->Supplier_Model->hotel_details_merge($this->session->userdata('admin_user_id'));
			$data['hotel_desc_city']= $this->Supplier_Model->hotel_city_details($this->session->userdata('admin_user_id'));
			$data['supplier_info']=$this->Supplier_Model->supplier_info($this->session->userdata('admin_user_id'));
			$supplier_info2=$this->Supplier_Model->supplier_info2($this->session->userdata('admin_user_id'));
			$data['supplier_info2']=$supplier_info2;
			$this->load->view('supplier/update_profile',$data);
		}
		else
		{
			redirect('hotel/index','refresh');
		}	
   }
 function login_check_book()
	{
		$rules['username']="required";
		$rules['password']="required";
			
		
		$this->validation->set_rules($rules);
				
				
		$fields['username']="Login Name";
		$fields['password']="Password";
	
				
		$this->validation->set_fields($fields);
		//echo "<br/>login1==".$login_name;
		if($this->validation->run()==FALSE)
		{
			//echo "<br/>login2==".$login_name;exit();
			$this->load->view('index');
			
			//redirect('home/agent_login','refresh');
		}
		else
		{
			//echo "<br/>login3==".$login_name;exit();
			 $login_name =$this->input->post('username');
			 $password=$this->input->post('password');
			 $res=$this->Home_Model->check_login_agent($login_name,$password);
			 if($res!='')
			 {
			 	$userid=$this->session->set_userdata(array('user_id'=>$res->group_book_agents_id));
				    
	                	$current_time = date("g:i A");
   				$current_date = date("l, F jS, Y");
				$time=$current_date." ".$current_time;
				
				//$userid=$this->session->set_userdata(array('user_id'=>$res->user_id));
				//$status=1;
				//$dat=$this->Home_Model->update_status_login($status,$res->agentid,$time);
				$data['gbagent_info']=$this->Supplier_Model->gbagent_info($this->session->userdata('admin_user_id'));
				//print_r($data['gbagent_info']);exit(0);
				//redirect('supplier/group_book_agent_summary',$data);
				$user = $this->session->userdata('admin_user_id');
				$data['group_list']= $this->Supplier_Model->agent_group_list($user);
				$data['supplier_info']=$this->Supplier_Model->supplier_info($user);
				$this->load->view('supplier/group_book_agent_summary',$data);
			}
			else
			{
				redirect('hotel/index','refresh');
			}
		}
	}
	
	function aprt_facilities()
	{
	
		$data['roomfecility_list'] = $this->Supplier_Model->get_roomfecilitylist();
		$data['rooms_val'] = $this->Supplier_Model->get_rooms_list();
		$this->load->view('supplier/apartment_facilities',$data);
		
	}
	
	
   function login_check()
	{
		$rules['username']="required";
		$rules['password']="required";
			
		
		 $this->validation->set_rules($rules);
				
				
		$fields['username']="Login Name";
		$fields['password']="Password";
	
				
		$this->validation->set_fields($fields);
		//echo "<br/>login1==".$login_name;
		if($this->validation->run()==FALSE)
		{
			//echo "<br/>login2==".$login_name;exit();
			$this->load->view('index');
			
			//redirect('home/agent_login','refresh');
		}
		else
		{
			//echo "<br/>login3==".$login_name;exit();
			 $login_name =$this->input->post('username');
			 $password=$this->input->post('password');
			 $res=$this->Home_Model->check_login($login_name,$password);
			 if($res!='')
			 {
			 	$userid=$this->session->set_userdata(array('user_id'=>$res->user_id));
				    
	                	$current_time = date("g:i A");
   				$current_date = date("l, F jS, Y");
				$time=$current_date." ".$current_time;
				
				//$userid=$this->session->set_userdata(array('user_id'=>$res->user_id));
				//$status=1;
				//$dat=$this->Home_Model->update_status_login($status,$res->agentid,$time);
				
				redirect('supplier/supplier_main_home','refresh');
			}
			else
			{
				redirect('admin/index','refresh');
			}
		}
	}
	function manageusers($flag = "")
	{
		if($this->session->userdata('admin_user_id') !='')
		{
			$data['psflag'] = 1;
			$data['users'] = $this->Supplier_Model->get_users($this->session->userdata('admin_user_id'));
			$this->load->view('supplier/manageusers',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}	
	}
	function add_user($flag = "")
	{
		if($this->session->userdata('admin_user_id') !='')
		{
			$data['psflag'] = 1;
			$data['apartment_list'] = $this->Supplier_Model->apartment_list($this->session->userdata('admin_user_id'));
			$this->load->view('supplier/add_user',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}	
	}
	function add_user_perm()
	{
		if($this->session->userdata('admin_user_id') !='')
		{
			$id = '';
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$pincode = $this->input->post('pincode');
			$position = $this->input->post('position');
			$email = $this->input->post('email');
			$pwd = $this->input->post('pwd');
			$cnt = $this->input->post('cnt');
			for($i=0;$i<$cnt;$i++)
			{
				$prop_per = $this->input->post('prop_permision'.$i);
				if($prop_per == 1)
				{
					$prop_id = $this->input->post('prop_id'.$i);
					$id.= $prop_id.',';
				}
			}
			$id = substr($id,0,-1);
			$this->Supplier_Model->insert_into_manage($fname,$lname,$pincode,$position,$email,$pwd,$id,$this->session->userdata('admin_user_id'));
			$data['psflag'] = 1;
			redirect('supplier/manageusers','refresh');
		}
		else
		{
			 redirect('admin/index', 'refresh');
		}	
	}
	function update_user_perm($id1)
	{
		if($this->session->userdata('admin_user_id') !='')
		{
			$id = '';
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$pincode = $this->input->post('pincode');
			$position = $this->input->post('position');
			$cnt = $this->input->post('cnt');
			for($i=0;$i<$cnt;$i++)
			{
				$prop_per = $this->input->post('prop_permision'.$i);
				if($prop_per == 1)
				{
					$prop_id = $this->input->post('prop_id'.$i);
					$id.= $prop_id.',';
				}
			}
			$id = substr($id,0,-1);
			$this->Supplier_Model->udpate_into_manage($fname,$lname,$pincode,$position,$id,$this->session->userdata('admin_user_id'),$id1);
			$data['psflag'] = 1;
			redirect('supplier/manageusers','refresh');
		}
		else
		{
			 redirect('admin/index', 'refresh');
			 
		}	
	}
	function delete_user($id)
	{
		$this->Supplier_Model->delete_user($id);
		redirect('supplier/manageusers','refresh');	
	}
	function edit_user_manage($id)
	{
		if($this->session->userdata('admin_user_id') !='')
		{
			$data['psflag'] = 1;
			$data['apartment_list'] = $this->Supplier_Model->apartment_list($this->session->userdata('admin_user_id'));
			$data['manage'] = $this->Supplier_Model->edit_user_manage($id);
			$this->load->view('supplier/edit_user',$data);
		}
		else
		{
			 redirect('admin/index', 'refresh');
		}
	}	
	

function view_bookings($id)
   {
	    if($this->session->userdata('admin_user_id')!='')
		{
	   		$data['blflag'] = 1;
	   		$data['bookings'] = $this->Supplier_Model->get_booking_details($id);
	   		$this->load->view('supplier/view_bookings',$data);
		}
		else
		{
			 redirect('home/supplier', 'refresh');
		}
	}   
	
}
?>
