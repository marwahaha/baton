<?php
    // require 'twilio-php/Services/Twilio.php';
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    
?>
<Response>
    <Message>Hello,<?php echo $_REQUEST['From'] ?> Monkey</Message>
</Response>