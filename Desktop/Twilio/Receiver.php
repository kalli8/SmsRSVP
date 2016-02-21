
<?php
require __DIR__ . '/vendor/autoload.php';

$DEFAULT_TOKEN = 'k3dLF9ZLz7EykmRzfQhjMvVqblLcSTxyCOqXN8yM';
$DEFAULT_URL = 'https://smsrsvp.firebaseio.com/'; 
$firebase = new \Firebase\FirebaseLib($DEFAULT_URL, $DEFAULT_TOKEN);

$body = $_POST['body'];
$to = $_POST['to'];

//$name = $firebase->get(DEFAULT_PATH . '/name/contact001');
$uid = $firebase->get('Phones/' . $to . '/uid');
echo $uid;

$arr = array('response' =>  $body, 'phone' => $to);

$firebase->push($uid . '/Replies/', $arr);

// $firebasePhones = new \Firebase\FirebaseLib($DEFAULT_URL . '/Phones/'. $to.'/uid/', $DEFAULT_TOKEN);


// 
// refPhones.on("value", function(snapshot) {
// 	$uid = snapshot.uid;
// }
// 
// var replyRef = new Firebase($DEFAULT_URL + $uid + '/Replies');
// replyRef.set({
// 	phoneNumber: $from,
// 	response: $body,
// });

?>

