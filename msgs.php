<!DOCTYPE html>
<?php
   header("content-type: text/html; charset=utf-8");
   require('twilio-php/Services/Twilio.php'); 
   require('require.php');

/* gets messages and sorts them by phone number */
$messages = $client->account->messages->getIterator(0, 100, array(
	'To' => '+15306014224',
	'DateSent>' => gmdate("Y-m-d"),
));
$phones = array();
foreach ($messages as $message) { $f = $message->from; $phones[$f][] = $message;
}
?>

<html>
<head><title>Baton</title></head>
<style>
html {
font-family: "Impact", Charcoal, sans-serif;
}
.msgbox {
float:left;
height:200px;
width:29%;
overflow-y:auto;
border:1px solid #AAAAAA;
margin: 10px 2%;
}
.phone_number {
border-bottom: 1px solid #AAAAAA;
background-color: #EEEEEE;
}
.msgs {
max-height:89%;
overflow-y:auto;
overflow-x:hidden;
}
.dates {
padding-top:2px;
font-size: 8px;
}
.from_me, .from_client {
padding:10px 5px;
border-bottom: 2px solid #EEEEEE;
}
.from_me {
text-align:right;
padding-left:10%;
}
.from_client {
padding-right: 10%;

}
</style>
<body>
<div><b>Today's messages</b></div>
  <img style="height:100px; padding-right:30px;" align="right" src='https://skypeblogs.files.wordpress.com/2014/10/mac4.png'></img>
<div style="margin-bottom:50px; max-height:250px" class='head_text'>
  <div>Your phone number is +15306014224.</div>
  <div>Your clients are limited to <?php echo $limit ?> messages per day.</div>
  <div>Digital hangouts coming soon!</div>

</div>
  <div style="width:100%;height:280px">
  <?php 
     function bytime($a, $b) { 
     $at = intval(strtotime($a->date_sent));
  $bt = intval(strtotime($b->date_sent));
  return ($at > $bt) ? 1 : -1;
  }
  
  foreach ($phones as $num=>$phone) {
  /* Gets sent messages for this phone number*/
  $msgs = array();
  $sentmsgs = $client->account->messages->getIterator(0, 100, array(
  'From' => '+15306014224',
  'To' => $num,
  'DateSent>' => gmdate("Y-m-d"),
  ));
  foreach($sentmsgs as $s) { $msgs[] = $s; }
  
  /* Gets incoming messages from this phone number */
  echo '<div class="msgbox" id=' . strval($num) . '>';
    $i = 0;
    echo '<div class="phone_number">' . strval($num) . '</div>';
    echo '<div class="msgs">';
    /*adds incoming msgs to be sorted*/
    foreach ($phone as $msg) {
    $msgs[] = $msg;
    }
    usort($msgs, "bytime");
    foreach ($msgs as $m) {

    $sender =  'from_me';    
    if ($m->from != '+15306014224') {
    $sender = 'from_client';
    $i++;
    }
    if (($m->from != '+15306014224') && ($i > $limit) 
      || ($m->from == '+15306014224') && (strpos($m->body, '***') === 0))
      {} else {    
      echo '<div class=\'' . $sender . '\'>' .  $m->body;
	echo '<div class="dates">' . gmdate('m/d h:ia', strtotime($m->date_sent)) . '</div></div>'; }
      }
      
      echo '</div></div>';
  }
  ?>  


</div>
<script>
function sendmsg() {
var oReq = new XMLHttpRequest();
oReq.open("get", "send.php?To=" +document.getElementById('textnum').value + "&Text=" + document.getElementById('textmsg').value);
oReq.send();
return false;
}
</script>

<button onclick="sendmsg()" >Send Message</button>
<input placeholder="+12345678910" id="textnum">
<textarea placeholder="my text message" rows=4 id="textmsg"></textarea>
</body>
</html>
