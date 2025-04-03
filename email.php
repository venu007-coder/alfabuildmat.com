
<?php
session_start();
// For Sending Sms
//require_once dirname(__FILE__) . '\captcha\securimage.php';

//$securimage = new Securimage();
			$captcha = @$_REQUEST['ct_captcha']; // the user's entry for the captcha code
           if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {
				try{
                  
                  require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Debugoutput = 'html';
$mail->Host = "mail.alfabuildmat.com";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = "mailenquiry@alfabuildmat.com";
$mail->Password = "Rtk#r5065";
$mail->setFrom('mailenquiry@alfabuildmat.com', 'Amson Enquiry');
$mail->addReplyTo('amsonwebzenquiry@gmail.com', 'Amson Enquiry');
$mail->addAddress('alfabuildmat@yahoo.com', 'ALFA BUILDMAT'); //CHANGE THIS

$recipients = array(
   'amsonwebzenquiry@gmail.com', //CHANGE THIS


);
foreach($recipients as $email)
{
   $mail->AddCC($email);
}

$mail->Subject = 'ALFA BUILDMAT'; //CHANGE THIS
$body = "
<div style='background: linear-gradient(45deg, #4158d0, #c850c0); padding: 30px; font-family:Trebuchet MS;', align='center'>
<table width='80%;' style='border: 2px solid #fff; border-radius: 10px; background-color: #fff; ' >
	                        
							 <tr style='height: 50px; background: #36304a; font-size: 24px; color: #fff; border-radius: 10px;' >
							    <th colspan='2' align='center' valign='middle' >ENQUIRY FROM WEBSITE</th>
							 </tr>
							 
<tr style='background: #fff; font-size: 16px; color: #000;' >
<td style='padding: 20px; font-family:Trebuchet MS;' >Name : </td>
<td style='padding: 20px; font-family:Trebuchet MS;' >".$_REQUEST['name']."</td>
							 </tr>
							 
<tr style='background: #f5f5f5; font-size: 16px; color: #000;' >
<td style='padding: 20px; font-family:Trebuchet MS;' >Email : </td>
<td style='padding: 20px; font-family:Trebuchet MS;' >".$_REQUEST['email']."</td>
							 </tr>

<tr style='background: #fff; font-size: 16px; color: #000;' >
<td style='padding: 20px; font-family:Trebuchet MS;' >Number:</td>
<td style='padding: 20px; font-family:Trebuchet MS;' >".$_REQUEST['mobile']."</td>
							 </tr>
							 
				 
							 						 
<tr style='background: #fff; font-size: 16px; color: #000;' >
<td style='padding: 20px; font-family:Trebuchet MS;' >Description:</td>
<td style='padding: 20px; font-family:Trebuchet MS;' >".$_REQUEST['select1']." ".$_REQUEST['interstedin']."</td>
							 </tr>
                             
                             
							 
  <td colspan='2' align='center' valign='middle'>&nbsp;</td>
</tr>						 
							 
	                     </table></div>";
$mail->msgHTML($body);
 $mail->send();                 
            	$gatewayURL = 'https://www.smsintegra.net/api/smsapi.aspx?';
				$request = 'uid=AMSONWEBZ';
				$request .= '&pwd=amsonamson';
				$request .= '&mobile=9841589864';
				$request .= '&type=0';
				$request .= '&msg='.urlencode('C.Id: 1234,Got Enquiry from website ALFA BUILDMAT : Name: .'.$_REQUEST['name'].', Email: '.$_REQUEST['email'].', Mobile: +91'.$_REQUEST['mobile'].'. Interested in - '.$_REQUEST['select1'].'. -Amson Marketing Consultants');                             
                $request .= '&sid='.urlencode('AMSONW');
				$request .= '&dtTimeNow='.$dtTimeNow.'&entityid=1601100000000004361&tempid=1607100000000093595';
				$url =  $gatewayURL . $request; 
				$url = preg_replace("/ /", "%20", $url);    
				$parse_url=file($url);
				echo $parse_url[0];				 
				
				$gatewayURL = 'https://www.smsintegra.net/api/smsapi.aspx?';
				$request = 'uid=AMSONWEBZ';
				$request .= '&pwd=amsonamson';
				$request .= '&mobile= +91'.$_REQUEST['mobile'];
				$request .= '&type=0';
				$request .= '&msg='.urlencode('Hi '.$_REQUEST['name'].',C.Id: 1234, Your Enquiry has been sent to ALFA BUILDMAT - Amson Marketing Consultants');
				$request .= '&sid='.urlencode('AMSONW');
				$request .= '&dtTimeNow='.$dtTimeNow.'&entityid=1601100000000004361&tempid=1607100000000093593';
				$url =  $gatewayURL . $request; 
				$url = preg_replace("/ /", "%20", $url);    
				$parse_url=file($url);
				echo $parse_url[0];
				header('Location: index.html');   
				}
				catch(Exception $e)
				{
					echo 'Message:' .$e->getMessage();
				}	                      
            } else{
		die("The Code You have entered is incorrect ");	
	    }
