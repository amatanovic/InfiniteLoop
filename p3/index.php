<?php include "head.php";
if(isset($_GET['fbTrue']))
{
require 'facebook_login_graph_api/src/config.php';
require 'facebook_login_graph_api/src/facebook.php';
    $token_url = "https://graph.facebook.com/oauth/access_token?"
       . "client_id=1086359581374842&redirect_uri=http://localhost/InfiniteLoop/p3/index.php?fbTrue=true&client_secret=a7ffd68ba532420febaf77507826f979&code=" . $_GET['code']; 

     $response = file_get_contents($token_url);
     $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
     echo $user->id;
$izraz=$veza->prepare("select * from korisnik where facebook=:sifra and ime=:ime");
$izraz->bindValue(":sifra",$user->id);
$izraz->bindValue(":ime", $user->name);
$izraz->execute();
$operater=$izraz->fetch(PDO::FETCH_OBJ); 
if($operater!=null){
  $_SESSION['autoriziran']=$operater;
  header("location: nadzornaKorisnik.php");
}
else{
  header("location: index.php?loginError");
}

}
if(isset($_POST['prijava'])){
$izraz=$veza->prepare("select * from korisnik where kor_ime=:kor_ime and lozinka=:lozinka");
$izraz->bindValue(":kor_ime", $_POST['kor_ime']);
$izraz->bindValue(":lozinka", md5($_POST['lozinka']));
$izraz->execute();
$operater=$izraz->fetch(PDO::FETCH_OBJ); 
if($operater!=null){
  $_SESSION['autoriziran']=$operater;
  header("location: nadzornaKorisnik.php");
}
else{
$izraz=$veza->prepare("select * from frizerski_salon where kor_ime=:kor_ime and lozinka=:lozinka");
$izraz->bindValue(":kor_ime", $_POST['kor_ime']);
$izraz->bindValue(":lozinka", md5($_POST['lozinka']));
$izraz->execute();
$operater=$izraz->fetch(PDO::FETCH_OBJ); 
if($operater!=null) {
   $_SESSION['autoriziran']=$operater;
  header("location: nadzornaKorisnik.php");
}
else {
header("location: index.php?loginError");
}
}
}
?>
    <body class="bodyIndex">
        <div class="container">
            <div class="rowIndex">
                <div class="col-md-6 divPozadina" style="background-image: url('slika.jpg')">
                    <h1 style="margin-top:200px;">Frizeraj</h1>
                    <h4>Trebaš novu frizuru? Dođi kod nas i dobit ćeš!</h4>
                </div>
                <div class="col-md-6 divForma">
                    <form class="form-horizontal indexForma" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset>
                            <h2 class="indexH2">Prijava</h2>
                            <div class="form-group">                                
                                <input type="text" class="form-control" name="kor_ime" placeholder="korisničko ime">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="lozinka" placeholder="lozinka">                        
                            </div>
                            <input type="submit" name="prijava" class="btn btn-default" value="Prijavi se" />        
                        </fieldset>
                    </form>
                    <p class="indexP"><a href="https://www.facebook.com/dialog/oauth?client_id=1086359581374842&redirect_uri=http://localhost/InfiniteLoop/p3/index.php?fbTrue=true&scope=email"><img src="facebook_login_graph_api/images/login-button.png" /></a></p>
                    <p class="indexP">Ukoliko nemate račun, <a href="registracija.php">registrirajte se</a></p>
                </div>
            </div>
        </div>
        <p>
            <?php if(isset($_GET['loginError'])) {
              echo "Neuspješna prijava.";
              } ?>
          </p>

    <?php include "scripts.php"; ?>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

    </body>

</html>
