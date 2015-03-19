<?php
/*
******************************************************************
			* COMPANY    - FSS Pvt. Ltd.
******************************************************************

Name of the Program : Tranportal VbyV [3D Secure] UMI Pages
Page Description    : Allows Merchant to connect Payment Gateway and send request
Request parameters  : TranporatID,TranportalPassword,Action,Amount,CardNumber,CVV,
					  ExpiryMonth,ExpiryYear,CardHolderName,Currency,TrackID,UDF1 to UDF5.
Response parameters : Result,Amount,Track ID,PaymentID Transaction ID, Reference ID, UDF1 to UDF5, Auth Code,postdate,AVR,Error
Values from Session : No
Values to Session   : No
Created by          : FSS Payment Gateway Team
Created On          : 01-01-2013
Version             : Version 2.0
******************************************************************************
NOTE - 
This pages are developed and tested on below platform
PHP Version - 5.3.5 (Curl function enabled)
Apache Version - 2.2.17
Tested using - WampServer Version - 2.1
Operating System - Windows XP Professional Service Pack 2 and Windows 7 
****************************************************************
*/
/*
*******IMPORTANT INFORMATION**************
This document is provided by Financial Software and System Pvt Ltd on the basis 
that you will treat it as private and confidential.
Data used in examples and sample data files are intended to be fictional and any 
resemblance to real persons or entities is entirely coincidental.
This example assumes that a form has been sent to this example with the required 
fields. The example then processes the command and displays the receipt or error 
to a HTML page in the users web browser.
*/

/*
Getting Required User Fields from Initial HTML page
Since this page for demonstration, values from HTML page are directly
taken from browser and used for transaction processing. 
Merchants SHOULD NOT follow this practice in production environment.
*/
/*Below are the parameters are taken from Initial Page for demonstration,
we suggest merchant SHOULD take this values from secure channel*/
/*
$cardno=isset($_POST['cardno']) ? $_POST['cardno'] : '';
$cvv=isset($_POST['cvv']) ? $_POST['cvv'] : '';
$expmm=isset($_POST['expmm']) ? $_POST['expmm'] : '';
$expyy=isset($_POST['expyy']) ? $_POST['expyy'] : '';
$amt=isset($_POST['amt']) ? $_POST['amt'] : '';
$MTrackid=isset($_POST['MTrackid']) ? $_POST['MTrackid'] : '';
$membername=isset($_POST['membername']) ? $_POST['membername'] : '';
*/

//************START--PG Initial Request Parameters have to set here**************//

/* to pass Tranportal ID provided by the bank to merchant. Tranportal ID is sensitive information of 
merchant from the bank, merchant MUST ensure that Tranportal ID is never passed to customer browser 
by any means. Merchant MUST ensure that Tranportal ID is stored in secure environment & securely at 
merchant end. Tranportal Id is referred as id. Tranportal ID for test and production will be different.
please contact bank for test and production Tranportal ID*/
// Here XXXXXX refers to tranportal id of the respective merchant,Merchant should replace this with his original tranportal ID//	

//$query=$this->db->query("SELECT * FROM payment_gateway_details LIMIT 1;");
$query=$this->db->query("SELECT * FROM payment_gateway_details LIMIT 1;");
$pay_details=$query->row_array();
//print_r($pay_details);exit;
$TranportalID = "<id>".$pay_details['tranportal_id']."</id>"; //Mandatory

/* to pass Tranportal password provided by the bank to merchant. Tranportal password is sensitive 
information of merchant from the bank, merchant MUST ensure that Tranportal password is never passed 
to customer browser by any means. Merchant MUST ensure that Tranportal password is stored in secure 
environment & securely at merchant end. Tranportal password is referred as password. Tranportal 
password for test and production will be different, please contact bank for test and production
Tranportal password */
// Here XXXXXX refers to tranportal password of the respective merchant ,Merchant should replace this with his original Password//	
$TranportalPwd = "<password>".$pay_details['tranportal_password']."</password>";  //Mandatory
//if (!$res = mysql_fetch_array(mysql_query("SELECT amount,mtrackid FROM payment_gateway WHERE mtrackid= '".trim($_POST['MTrackid'])."' LIMIT 1;")))    die(mysql_error());
$res = $this->Flights_Model->get_tran_details($mtrackid);
if($res != '')
{
	//echo "<pre/>";print_r($res);exit;
	$cardno = $res->cardno;
	$cvv = $res->cvv;
	$expyy = $res->expyy;
	$expmm = $res->expmm;
	$amt = $res->amount;
	$membername = $res->membername;
	$MTrackid = $res->mtrackid;
}
/*Setting Customer Card NO*/
$strcard = "<card>".$cardno."</card>";		//Mandatory for Action code "1" & "4"

/*Setting Customer Card CVV value*/
$strcvv = "<cvv2>".$cvv."</cvv2>";			//Mandatory for Action code "1" & "4"
		
/*Setting Customer Card expiry year value in YYYY format */
$strexpyear = "<expyear>".$expyy."</expyear>";	      //Mandatory for Action code "1" & "4"
		
/*Setting Customer Card expiry Month value in MM format */
$strexpmonth = "<expmonth>".$expmm."</expmonth>";	  //Mandatory for Action code "1" & "4"

/* Action Code of the transaction, this refers to type of transaction. Action Code 1 stands of 
Purchase transaction and Action code 4 stands for Authorization (pre-auth). Merchant should 
confirm from Bank action code enabled for the merchant by the bank*/ 
$straction = "<action>1</action>";  //Mandatory

/* Transaction Amount that will be send to payment gateway by merchant for processing
NOTE - Merchant MUST ensure amount is sent from merchant back-end system like database
and not from customer browser. In below sample amount is taken from Initial HTML page, merchant need to pass 
transaction amount ,amount including decimal point if required*/

$stramt = "<amt>".$amt."</amt>";  //Mandatory

/* Currency code of the transaction. By default INR i.e. 356 is configured. If merchant wishes 
to do multiple currency code transaction, merchant needs to check with bank team on the available 
currency code */
$strcurrency = "<currencycode>840</currencycode>";  //Mandatory

//$membername = 'Test';
/*Setting CardHolder Name/Member name */ 
$strmember = "<member>".$membername."</member>";  //Mandatory

/* To pass the merchant track id, in below sample merchant track id taken from Initial HTML page. 
Merchant MUST pass his Merchant Track ID in this parameter. Track Id passed here should be 
from merchant backend system like database and not from customer browser. */
$strtrackid ="<trackid>".$MTrackid."</trackid>";  //Highly Recommended for Merchant Reference.

/* User Defined Fields as per Merchant or bank requirement. Merchant MUST ensure  
he is not passing junk values OR CRLF in any of the UDF. In below sample UDF values 
are not utilized */
$strinitudf1="<udf1>".$_SESSION['post']['booking_id']."</udf1>";
$strinitudf2="<udf2>".$_SESSION['post']['user_email']."</udf2>";
$strinitudf3="<udf3>Test3</udf3>";
$strinitudf4="<udf4>Test4</udf4>";
$strinitudf5="<udf5>Test5</udf5>";	

/*
NOTE -
ME should now do the validations on the amount value set like - 
a) Transaction Amount should not be blank and should be only numeric
b) Language should always be USA
c) Action Code should not be blank
d) UDF values should not have junk values and CRLF 
(line terminating parameters)Like--> [ !#$%^&*()+[]\\\';,{}|\":<>?~` ]
*/

//************END--PG Initial Request Parameters have to set here**************//	
try
{
	//Collecting PARes from ACS
	$PARes = isset($_POST['PaRes']) ? $_POST['PaRes'] : '';
	//echo "Read me PARes :".$PARes."<br>";
	//Check the PAREs value if it is null then initiate Initial VReq request to PG
	If ($PARes == null)
	{
		/* Now merchant sets all the inputs in one string for passing request to Payment Gateway URL */	
		$Envreq=$TranportalID.$TranportalPwd.$strcard.$strcvv.$strexpyear.$strexpmonth.$straction.$stramt.$strcurrency.$strmember.$strtrackid.$strinitudf1.$strinitudf2.$strinitudf3.$strinitudf4.$strinitudf5;
		$postfields_hdfc = "TranportalID : ".$TranportalID."TranportalPwd : :".$TranportalPwd."Card Number :".$strcard."CVV : ".$strcvv."Expiry Year :".$strexpyear."Expiry Month : ".$strexpmonth."Action : ".$straction."Amount : ".$stramt."Currency : ".$strcurrency."Member Name : ".$strmember."Track Id :".$strtrackid."UDF 1:".$strinitudf1."UDF 2".$strinitudf2;
		
		
		/* 	Payment Gateway URL for sending initial request - Card Enrollment Verification Request */
		/* This is test environment URL,production URL will be different and will be shared by Bank during production movement */
		$url = "https://securepgtest.fssnet.co.in/pgway/servlet/MPIVerifyEnrollmentXMLServlet"; 
	
		$ch = curl_init() or die(curl_error()); 
		curl_setopt($ch, CURLOPT_PORT, 443); // port 443
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml")); //defining content type
		curl_setopt($ch, CURLOPT_POST,1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,$Envreq); // posting the request string
		curl_setopt($ch, CURLOPT_URL,$url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0); 
		$data1=curl_exec($ch) or die(curl_error()); 
		curl_close($ch);  // closing the port
		$InitialResponse = $data1; //response recieved from PG is stored in variable
		
		$myFile = $_SESSION['file_num']."-".$_SESSION['akbar_session']."hdfc_pg_postfields.txt";
		$fh = fopen('xmllogs/'.$myFile, 'w','r');
		$stringData = "HDFC PG Post Fields ".$postfields_hdfc;
		fwrite($fh, $stringData);
		fclose($fh);
		
		$myFile1 = $_SESSION['file_num']."-".$_SESSION['akbar_session']."hdfc_pg_response.txt";
		$fh1 = fopen('xmllogs/'.$myFile1, 'w','r');
		$stringData = "HDFC PG Response ".$InitialResponse;
		fwrite($fh1, $stringData);
		fclose($fh1);
		
		$method = 'HDFC Payment Gateway';
		$this->Flights_Model->insert_logs_security($_SESSION['akbar_session'],$method,$myFile,$myFile1,$_SESSION['journey_type']);
		
		//Collects Any error in initial Request using GetTextBetweenTags() function
		$strError=GetTextBetweenTags($InitialResponse, "<error_text>","</error_text>");
		//Result response recieved from PG is stored in variable
		$strEnrollmentResult=GetTextBetweenTags($InitialResponse,"<result>","</result>");
		
		/***********ECI Value Logic Start Here(Response does not has ECI value)***********/
		//check whether ECI is present in the response received from Payment Gateway
		//If response does not has ECI value than pass it as "7" 
		$strECIValue = GetTextBetweenTags($InitialResponse,"<eci>","</eci>");
		If($strECIValue == null)
		{
			$strECIValue="7";
		}
		$strECIValueTag="<eci>".$strECIValue."</eci>";
		/***********ECI Value Logic End Here(Response does not has ECI value)***********/
		
		//Below Condition Checks Any Error Present or not in the Initial Request
		If($strError == null)
		{
			//Now checking PG Result parameter 
			If($strEnrollmentResult == "ENROLLED") 
			{
				/*************Enrolled card condition starts here************/
				$acsurl=GetTextBetweenTags($InitialResponse,"<url>","</url>");//Collects ACS url
				$PAReq=GetTextBetweenTags($InitialResponse,"<PAReq>","</PAReq>");//Collects PAReq
				$paymentid=GetTextBetweenTags($InitialResponse,"<paymentid>","</paymentid>");//Collects paymentid
				$termURL = "http://testing.benzyinfotech.com/index.php/flights/send_perform_request";
				
				?>
				<HTML>
				<BODY OnLoad="OnLoadEvent();">
				<form name="form1" action="<?php echo $acsurl;?>" method="post">
					<input type="hidden" name="PaReq" value="<?php echo $PAReq;?>">
					<input type="hidden" name="MD" value="<?php echo $paymentid;?>">
      				<input type="hidden" name="TermUrl" value="<?php echo $termURL?>">
     			</form>
			    <script language="JavaScript">
			        function OnLoadEvent() 
				      {
				        document.form1.submit();
				      }

				</script>
				</BODY>
				</HTML>
				<?php
				/*************Enrolled card condition Ends here************/						
			}
			elseif($strEnrollmentResult == "NOT ENROLLED")
			{
				/*************NOT ENROLLED card condition Starts here************/
				
				$strZIP= "<zip></zip>";  //Optinal,LEAVE field BLANK
				$strADDR = "<addr></addr>"; //Optinal,LEAVE field BLANK
						
				/* Now merchant sets all the inputs in one string for passing request to the Payment Gateway URL */	
				$NEAuthReq= $TranportalID.$TranportalPwd.$strcard.$strcvv.$strexpyear.$strexpmonth.$straction.$stramt.$strcurrency.$strmember.$strtrackid.$strinitudf1.$strinitudf2.$strinitudf3.$strinitudf4.$strinitudf5.$strZIP.$strADDR.$strECIValueTag;
			
				/* Below URL is used only when NOT ENROLLED response is received from Payment Gateway */
				/* This is test environment URL,production URL will be different and will be shared by Bank during production movement */
				$url2= "https://securepgtest.fssnet.co.in/pgway/servlet/TranPortalXMLServlet";
				
				$ch2 = curl_init() or die(curl_error()); 
				curl_setopt($ch2, CURLOPT_PORT, 443);
				curl_setopt($ch2, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml")); 
				curl_setopt($ch2, CURLOPT_POST,1); 
				curl_setopt($ch2, CURLOPT_POSTFIELDS,$NEAuthReq); 
				curl_setopt($ch2, CURLOPT_URL,$url2); 
				curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST,0); 
				curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER,0); 
				$data2=curl_exec($ch2) or die(curl_error());
				curl_close($ch2); 
				$NEAuthResponse = $data2;  //response received from payment gateway is stored here
					
				//Collect All Authorization RESULT for NOT ENROLLED CASE																		
				$NEResResult=GetTextBetweenTags($NEAuthResponse,"<result>","</result>");//It will give  Result 
				$NEResAmount=GetTextBetweenTags($NEAuthResponse,"<amt>","</amt>");//It will give Amount
				$NEResTrackId=GetTextBetweenTags($NEAuthResponse,"<trackid>","</trackid>");//It will give TrackID 
				$NEResPayid=GetTextBetweenTags($NEAuthResponse,"<payid>","</payid>");//It will give PaymentID
				$NEResRef=GetTextBetweenTags($NEAuthResponse,"<ref>","</ref>");//It will give Reference NO
				$NEResTranid=GetTextBetweenTags($NEAuthResponse,"<tranid>","</tranid>");//It will give Transaction ID
											
				//MERCHANT CAN GET ALL RESULT PARAMETERS USING BELOW CODE ,
				//Currently below code is commented,merchant can uncomment it and use the below parameters if required.
				/*
				$NEResAutht=GetTextBetweenTags($NEAuthResponse,"<auth>","</auth>");//It will give Authorization code
				$NEResAvr=GetTextBetweenTags($NEAuthResponse,"<avr>","</avr>");//It will give AVR 
				$NEResPostdate=GetTextBetweenTags($NEAuthResponse,"<postdate>","</postdate>");//It will give  postdate
				$NEResUdf1=GetTextBetweenTags($NEAuthResponse,"<udf1>","</udf1>");//It will give udf1
				$NEResUdf2=GetTextBetweenTags($NEAuthResponse,"<udf2>","</udf2>");//It will give udf2
				$NEResUdf3=GetTextBetweenTags($NEAuthResponse,"<udf3>","</udf3>");//It will give udf3
				$NEResUdf4=GetTextBetweenTags($NEAuthResponse,"<udf4>","</udf4>");//It will give udf4
				$NEResUdf5=GetTextBetweenTags($NEAuthResponse,"<udf5>","</udf5>");//It will give udf5
				*/
				/*	
					IMPORTANT NOTE - MERCHANT DOES RESPONSE HANDLING AND VALIDATIONS OF 
					TRACK ID, AMOUNT AT THIS PLACE. THEN ONLY MERCHANT SHOULD UPDATE 
					TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
					AND THEN REDIRECT CUSTOMER ON RESULT PAGE
				*/
				/* !!IMPORTANT INFORMATION!!
					During redirection, MERCHANT can pass the values as per MERCHANT requirement.
					NOTE: NO PROCESSING should be done on the RESULT PAGE basis of values passed in the RESULT PAGE from this page. 
					MERCHANT does all validations on this page and then redirects the customer to RESULT 
					PAGE ONLY FOR RECEIPT PRESENTATION/TRANSACTION STATUS CONFIRMATION
				*/
				/* If merchant wants, he can display All results in current Page itself or
				he wants to redirect customer to Result/Display page ,then merchant need to make 
				sure that correct values should be displayed on Result/display page form 
				secure channel like DataBase after all response validations only.
				*/

				//echo($NEResResult);
				/*Redirecting to Final Status Page with required parameters*/
				header("location:".'http://testing.benzyinfotech.com/index.php/flights/status_transaction?ResResult='.$NEResResult.'&ResTrackId='.$NEResTrackId.'&ResPaymentId='.$NEResPayid.'&ResRef='.$NEResRef.'&ResTranId='.$NEResTranid.'&ResAmount='.$NEResAmount);
				
				/*************NOT ENROLLED card condition Ends here************/						
			}
			else
			{
					/*
						IMPORTANT NOTE - MERCHANT SHOULD UPDATE 
						TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
						AND THEN REDIRECT CUSTOMER ON RESULT PAGE
					*/
					/* If merchant wants, he can display All results in current Page itself or
						he wants to redirect customer to Result/Display page ,then merchant need to make 
						sure that correct values should be displayed on Result/display page form 
						secure channel like DataBase after all response validations only.
					*/
					//Below code will display/Show result other than ENROLLED & NOT ENROLLED
					//echo($strEnrollmentResult);
					$Othrespaymentid=GetTextBetweenTags($InitialResponse,"<paymentid>","</paymentid>");//It will give payid
					$Othrestrackid=GetTextBetweenTags($InitialResponse,"<trackid>","</trackid>");//It will give TrackID 
					/*Redirecting to Final Status Page with required parameters*/
					header("location:".'http://testing.benzyinfotech.com/index.php/flights/status_transaction?ResResult='.$strEnrollmentResult.'&ResTrackId='.$Othrestrackid.'&ResPaymentId='.$Othrespaymentid);
			}			
		}
		else
		{
				/*
				ERROR IN TRANSACTION REQUEST PROCESSING
				IMPORTANT NOTE - MERCHANT SHOULD UPDATE 
				TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
				AND THEN REDIRECT CUSTOMER ON RESULT PAGE
				*/
				/*	If merchant wants, he can display All results in current Page itself or
					he wants to redirect customer to Result/Display page ,then merchant need to make 
					sure that correct values should be displayed on Result/display page form 
					secure channel like DataBase after all response validations only.
				*/
				//Below code will display/Show Any Error if comes from PG
				//echo($strError);
				/*Redirecting to Final Status Page with required parameters along with Error*/
				header("location:".'http://testing.benzyinfotech.com/index.php/flights/status_transaction?ResTrackId='.$MTrackid.'&ResError='.$strError);
		}
	}
	else
	{
		//*******If PARES is not NULL means once response from ACS is received then..condition starts here*****/
			
			//Collect paymentid recieved from ACS
			$PaymentIDMDValue=isset($_POST['MD']) ? $_POST['MD'] : '';
			$PaymentIDMD = "<paymentid>".$PaymentIDMDValue."</paymentid>";
			//Collect PaRes recieved from ACS
			$PAResValue = isset($_POST['PaRes']) ? $_POST['PaRes'] : '';
			$PARes = "<PARes>".$PAResValue."</PARes>";
			
			//Creating Payers Authentication Request to PG
			$EnrollAuth= $TranportalID.$TranportalPwd.$PaymentIDMD.$PARes;

			/* Below URL is used to sent PARES and Payment ID to Payment Gateway once the response is received from Bank ACS */
			/* This is test environment URL,production URL will be different and will be shared by Bank during production movement */
			$url3 = "https://securepgtest.fssnet.co.in/pgway/servlet/MPIPayerAuthenticationXMLServlet";
	
			$ch3 = curl_init() or die(curl_error()); 
			curl_setopt($ch3, CURLOPT_PORT, 443);
			curl_setopt($ch3, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml")); 
			curl_setopt($ch3, CURLOPT_POST,1); 
			curl_setopt($ch3, CURLOPT_POSTFIELDS,$EnrollAuth); 
			curl_setopt($ch3, CURLOPT_URL,$url3); 
			curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST,0); 
			curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER,0); 
			$data3=curl_exec($ch3) or die(curl_error());
			curl_close($ch3); 
			$ENMPIAuthResponse = $data3;//response recieved from PG is stored in variable
			
			if(strlen($ENMPIAuthResponse)>0)
			{
						//Collect all The Authorization Response or Result Parameters using GetTextBetweenTags() Function
						$EnMPIReserror=GetTextBetweenTags($ENMPIAuthResponse, "<error_text>","</error_text>");//It will give  error_text 
						$EnMPIResResult = GetTextBetweenTags($ENMPIAuthResponse, "<result>","</result>");//It will give  Result 
						$EnMPIResTrackId=GetTextBetweenTags($ENMPIAuthResponse, "<trackid>","</trackid>");//It will give TrackID 
						$EnMPIResPayid=GetTextBetweenTags($ENMPIAuthResponse,"<paymentid>","</paymentid>");//It will give PaymentID
						$EnMPIResRef=GetTextBetweenTags($ENMPIAuthResponse,"<ref>","</ref>");//It will give Reference NO.
						$EnMPIResTranid=GetTextBetweenTags($ENMPIAuthResponse,"<tranid>","</tranid>");//It will give Transaction ID
													
						//MERCHANT CAN GET ALL Authorization RESULT PARAMETERS USING BELOW CODE 
						//Currently below code is commented,,merchant can uncomment it and use the below parameters if required.
						/*
						$EnMPIResAutht=GetTextBetweenTags($ENMPIAuthResponse,"<auth>","</auth>");//It will give Authorization Code 
						$EnMPIResAvr=GetTextBetweenTags($ENMPIAuthResponse,"<avr>","</avr>");//It will give AVR 
						$EnMPIResPostdate=GetTextBetweenTags($ENMPIAuthResponse,"<postdate>","</postdate>");//It will give  postdate
						$EnMPIResUdf1=GetTextBetweenTags($ENMPIAuthResponse,"<udf1>","</udf1>");//It will give udf1
						$EnMPIResUdf2=GetTextBetweenTags($ENMPIAuthResponse,"<udf2>","</udf2>");//It will give udf2
						$EnMPIResUdf3=GetTextBetweenTags($ENMPIAuthResponse,"<udf3>","</udf3>");//It will give udf3
						$EnMPIResUdf4=GetTextBetweenTags($ENMPIAuthResponse,"<udf4>","</udf4>");//It will give udf4
						$EnMPIResUdf5=GetTextBetweenTags($ENMPIAuthResponse,"<udf5>","</udf5>");//It will give udf5
						*/
						/*	
							IMPORTANT NOTE - MERCHANT DOES RESPONSE HANDLING AND VALIDATIONS OF 
							TRACK ID, AMOUNT AT THIS PLACE. THEN ONLY MERCHANT SHOULD UPDATE 
							TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
							AND THEN REDIRECT CUSTOMER ON RESULT PAGE
						*/
						/* !!IMPORTANT INFORMATION!!
							During redirection, MERCHANT can pass the values as per MERCHANT requirement.
							NOTE: NO PROCESSING should be done on the RESULT PAGE basis of values passed in the RESULT PAGE from this page. 
							MERCHANT does all validations on this page and then redirects the customer to RESULT 
							PAGE ONLY FOR RECEIPT PRESENTATION/TRANSACTION STATUS CONFIRMATION
						*/
						/* If merchant wants, he can display All results in current Page itself or
						he wants to redirect customer to Result/Display page ,then merchant need to make 
						sure that correct values should be displayed on Result/display page form 
						secure channel like DataBase after all response validations only.
						*/
						//echo($EnMPIResResult);
						/*Redirecting to Final Status Page with required parameters*/
						header("location:".'http://testing.benzyinfotech.com/index.php/flights/status_transaction?ResResult='.$EnMPIResResult.'&ResTrackId='.$EnMPIResTrackId.'&ResPaymentId='.$EnMPIResPayid.'&ResRef='.$EnMPIResRef.'&ResTranId='.$EnMPIResTranid.'&ResError='.$EnMPIReserror);
			}
			else
			{
				/*
					IMPORTANT NOTE - MERCHANT SHOULD UPDATE 
					TRANACTION PAYMENT STATUS IN MERCHANT DATABASE AT THIS POSITION 
					AND THEN REDIRECT CUSTOMER ON RESULT PAGE
				*/
				/* If merchant wants, he can display All results in current Page itself or
						he wants to redirect customer to Result/Display page ,then merchant need to make 
						sure that correct values should be displayed on Result/display page form 
						secure channel like DataBase after all response validations only.
						*/
				//Below code will display/Show Message if No Response Recived
				//echo("No Response");
				/*Redirecting to Final Status Page with required parameters*/
				header("location:".'http://testing.benzyinfotech.com/index.php/flights/status_transaction?&ResError=Authorization Response is Blank');
			}
			/********If PARES is not NULL means once response from ACS is received then..condition ends here*******/
	}
}
catch(Exception $e)
{
	//Merchant Can handle the exception in his/Her own logic/Way
	//echo($e->getMessage());
	//Below code will display/Show Any Error if comes from PG
	/*Redirecting to Final Status Page with required parameters along with Error*/
	header("location:".'http://testing.benzyinfotech.com/index.php/flights/status_transaction?ResError='.$e->getMessage());
}
//=======This is GetTextBetweenTags function which return the value between two XML tags or two string =====
function GetTextBetweenTags($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}


?>
