<?php
   $account_sid = 'AC4894ad7af5054c7616f82046a03b96f0';
   $auth_token = '89603f54a28e114170b493410c1e7b40';
   $limit =  2;
   $client = new Services_Twilio($account_sid, $auth_token);
   $yesterday  = gmmktime(0, 0, 0, gmdate("m"), gmdate("d")-1, gmdate("Y"));
?>