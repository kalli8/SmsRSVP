<?php
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
    // Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
    // and move it into the folder containing this file.


    require "twilio-php-master/Services/Twilio.php";
	require __DIR__ . '/vendor/autoload.php'; 
  	
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "ACb4601ebfba5a649c4aae1ccbf6b1ee8f";
    $AuthToken = "a4d6a5026b373ccd8cd7405d8026adfa";
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
 	$uid = $_GET['uid'];
 	
    $DEFAULT_TOKEN = 'k3dLF9ZLz7EykmRzfQhjMvVqblLcSTxyCOqXN8yM';
	$DEFAULT_URL = 'https://smsrsvp.firebaseio.com/'; 
	$firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
	$people = array($firebase->get($uid . '/subscriber/'));
	
	$twilio  = $firebase->get($uid . '/phoneNumber/');
   
    debug_to_console( $people );
    // Step 4: make an array of people we know, to send them a message. 
    // Feel free to change/add your own phone number and name here.
    // $people = array(
//         "+17033444899" => "Kalli",
//         "+16164321090" => "Michael",
//         "+12154311593" => "Miguel",
//     );
 
    // Step 5: Loop over all our friends. $number is a phone number above, and 
    // $name is the name next to it
    
    $jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator($people),
    RecursiveIteratorIterator::SELF_FIRST);
    $json_i=json_decode($people[0]);
// 	echo $people[0];
// 	echo "<br />";
$phoneNumbers = array();
 foreach ($json_i as $key => $val) {
	$phoneNumbers[] = $val->phone;
	echo $val->phone;
}


 $firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);
	$message = $firebase->get($uid . '/message/body');
	$option1 = $firebase->get($uid . '/message/option1');
	$option2 = $firebase->get($uid . '/message/option2');
		$option3 = $firebase->get($uid . '/message/option3'); 
    
    
    foreach ($phoneNumbers as $number) {
 
 		
        $sms = $client->account->messages->sendMessage(

// Step 6: Change the 'From' number below to be a valid Twilio number 
        // that you've purchased, or the (deprecated) Sandbox number
            $twilio, 
            
 // the number we are sending to - Any phone number
             $number,
        
 
            // the sms body
            "$message Please reply $option1, $option2, or $option3."
        );
 
        // Display a confirmation message on the screen
       // echo "Sent message to $name";
   }
?>
