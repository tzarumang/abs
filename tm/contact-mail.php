<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//echo "<pre>";
//print_r($_REQUEST);
if (isset($_REQUEST['email']))  { 

$to = 'alex@bizngine.com,jack@bizngine.com, Mark@ablending.com, markventrone@gmail.com';

$subject = 'New Lead';

$request_email = $_REQUEST['email'];

$headers = "From: " . strip_tags($request_email) . "\r\n"."X-Mailer: php";
$headers .= "Reply-To: ". strip_tags($request_email) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1". "\r\n";

/*$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"
$headers .= 'From: '.$request_email."\r\n".

    'Reply-To: '.$request_email."\r\n" .

    'X-Mailer: PHP/' . phpversion();*/

$message = '<html><style>
.heading{ color: #3498db;font-size:24px;}
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 40%;
	text-align:center;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
    padding: 2px 16px;
}
</style><body>';
$message .= '<p class="heading">Hi there,</p>';
$message .= '<p>Please find following details</p>';
$message .= '<div class="card"><table width="50%" rules="all" style="border-color: #666;" cellpadding="10">';

$request_text='';


$checkArray = '';


$allFieldArry = array("loanpurpose" => "Home loan",
"PROP_DESC" => "Property type",
"mortgagegoal" => "When are you likely to buy",
"SPEC_HOME" => "Have you found a home",
"AGENT_FOUND" => "Do you have a real estate agent",
"AGENT_CONTACT" => "Would you like a top-rated real estate agent to contact you",
"purchaseprice" => "Purchase price",
"DOWN_PMT_PERCENT" => "Down payment percent",
"VA_STATUS_PURCH" => "Have you ever served in the U.S. military",
"propertyvalue" => "Home worth",
"mortgagebalance" => "How much do you still owe on your home",
"mortgagerate" => "Current mortgage rate",
"MTG_TWO" => "Do you have a 2nd mortgage",
"mortgagebalance2" => "2nd mortgage balance",
"addcash" => "Additional cash",
"VA_STATUS_REFI" => "Have you ever served in the U.S. military",
"VA_LOAN" => "Do you currently have a VA loan",
"FHA_LOAN" => "Do you currently have an FHA loan",
"FHA_BANK_FORECLOSURE" => "Any bankruptcy or foreclosure",
"credgrade" => "What's your estimated credit rating",
"geocomplete" => "Street address",
"first_name" => "First Name",
"last_name" => "Last Name",
"email" => "Email",
"phone" => "Phone"
);



$refinanceArray = array("propertyvalue", "mortgagebalance", "mortgagerate", "MTG_TWO", "mortgagebalance2", "addcash", "VA_STATUS_REFI", "VA_LOAN", "TCPA","universal_leadid");

$buyArray = array("mortgagegoal", "SPEC_HOME", "AGENT_FOUND", "AGENT_CONTACT","purchaseprice", "DOWN_PMT_PERCENT", "VA_STATUS_PURCH", "TCPA" ,"universal_leadid");


if($_REQUEST['loanpurpose'] == "Refinance"){
	$checkArray = $buyArray;
} else {
	$checkArray = $refinanceArray;
}




foreach ($_REQUEST as $key => $value) {


	if (in_array($key, $checkArray))
	{
	 	 continue;
	}
	
	if (array_key_exists($key, $allFieldArry)){
	
		$keyValue = $allFieldArry[$key];
	} else {
		$keyValue = $key;
	}
	
	

$request_text.= "<tr><td><strong>".$keyValue.":</strong> </td><td>" . strip_tags($value) . "</td></tr>";
}
$message .= $request_text;


$message .= "</table></div>";
//$message .= "<p>Thank you for contacting us!</p>";
$message .= "</body></html>";

//echo $headers;

//echo $message;
//die;
if (mail($to,$subject,$message,$headers)) {
	 //echo 'Your mail has been sent successfully.';
	 header('Location: http://offers.ablending.com/thankyou.php');
} else {
    echo 'Unable to send email. Please try again.';
	$errorMessage = error_get_last();
	print_r($errorMessage);

}



//echo "Thank you for contacting us!";

}