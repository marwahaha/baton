<?php
    header("content-type: text/xml; charset=utf-8");
    require('twilio-php/Services/Twilio.php'); 
    require('require.php');
$client->account->messages->sendMessage("+15306014224",$_REQUEST["To"],$_REQUEST["Text"]);
echo '<Response/>'
?>
