<?php
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    require('twilio-php/Services/Twilio.php'); 
    require('require.php');

    $messages = $client->account->messages->getIterator(0, 100, array(
    	'From' => $_REQUEST['From'],
	'To' => "+15306014224",
	'DateSent>' => gmdate("Y-m-d"),
));
if (iterator_count($messages) >= $limit ) {
   echo "<Response><Message>***I can only receive " . $limit . " messages per day. Please call my office or send me an email.</Message></Response>";
   } else {

   echo "<Response/>";
}
?>