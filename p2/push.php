<?php
$device_token="APA91bFykpoo75ALJu_nKbwAKxj7Apj0JEAlr2rQHu6uH2fU5GHLvcdoDhk9Q-L6thgzF-1QUmZZl6tNDgjfehqFAHeS0fG1xG5SkJ36ygDJ-u6nXB5kSKtlPBxCoJ47XBsvWJPhPLCj7rQrZQtTjvKKBgLM5YBaTg";
$poruka = "Ovo je push notifikacija!";

$url = 'http://push.ionic.io/api/v1/push';

$data = array(
                  'tokens' => array($device_token), 
                  'notification' => array('alert' => $poruka),    
                  );
      
$content = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
curl_setopt($ch, CURLOPT_USERPWD, "690edb1965ec579c2bc5fcbbeed3a321970e7da0a58cff16" . ":" );  
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'X-Ionic-Application-Id: 8d496e29' 
));
$result = curl_exec($ch);
curl_close($ch);