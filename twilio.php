<?php
    // require 'twilio-php/Services/Twilio.php';
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    require('/path/to/twilio-php/Services/Twilio.php');
 
$account_sid = 'AC4894ad7af5054c7616f82046a03b96f0';
$auth_token = '89603f54a28e114170b493410c1e7b40';
$client = new Services_Twilio($account_sid, $auth_token);
 
$messages = $client->account->messages->getIterator(0, 100, array(
	'From' => $_REQUEST['From'],
	'To' => "+15306014224",
));
 
foreach ($messages as $message) {
	echo $message->body;
}
?>
<Response>
    <Message>Hello,<?php echo $_REQUEST['From'] ?> Monkey</Message>
</Response>