<?php


require 'src/config.php';
require 'src/facebook.php';
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => $config['App_ID'],
  'secret' => $config['App_Secret'],
  'cookie' => true
));

if(isset($_GET['logout']))       
{
    $url = 'https://www.facebook.com/logout.php?next=' . urlencode('http://projects.comuv.com/facebook_login_graph_api/') .
      '&access_token='.$_GET['tocken'];
    session_destroy();
    header('Location: '.$url);
}
if(isset($_GET['fbTrue']))
{
    $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=".$config['App_ID']."&redirect_uri=" . urlencode($config['callback_url'])
       . "&client_secret=".$config['App_Secret']."&code=" . $_GET['code']; 

     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
     $extra = "<a href='index.php?logout=1&tocken=".$params['access_token']."'>Logout</a><br>";     
     $content = $user;
$izraz=$veza->prepare("insert into korisnik (facebook, ime) values (:sifra, :ime)");
$izraz->bindValue(":sifra", $content->id); 
$izraz->bindValue(":ime", $content->name); 
$izraz->execute();
}

