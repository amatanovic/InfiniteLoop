<?php include "head.php"; ?>
    <body class="bodyIndex">
        <div class="container">
            <div class="rowIndex">
                <div class="col-md-6">

<?php


require 'config.php';
require 'facebook.php';
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => $config['1086359581374842'],
  'secret' => $config['a7ffd68ba532420febaf77507826f979'],
  'cookie' => true
));

if(isset($_GET['logout']))       
{
    $url = 'https://www.facebook.com/logout.php?next=' . urlencode('http://localhost/InfiniteLoop/p3/') .
      '&access_token='.$_GET['tocken'];
    session_destroy();
    header('Location: '.$url);
}
if(isset($_GET['fbTrue']))
{
    $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=".$config['1086359581374842']."&redirect_uri=" . urlencode($config['callback_url'])
       . "&client_secret=".$config['a7ffd68ba532420febaf77507826f979']."&code=" . $_GET['code']; 

     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
     $extra = "<a href='index.php?logout=1&tocken=".$params['access_token']."'>Logout</a><br>";     
     $content = $user;
}
else
{
    $content = '<a href="https://www.facebook.com/dialog/oauth?client_id='.$config['1086359581374842'].'&redirect_uri='.$config['callback_url'].'&scope=email,user_likes,publish_stream"><img src="./images/login-button.png" alt="Sign in with Facebook"/></a>';
}

include "scripts.php" ?>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

    </body>

</html>
