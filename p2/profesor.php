<?php
include "head.php"; 
if (!isset($_SESSION['autoriziran']->status) == 2) {
  header("location: odjava.php");
}
if (isset($_POST['posaljiObavijest'])) {
$poruka = $_POST['obavijest'];
$vrijeme = date("m");
  $izraz=$veza->prepare("select b.device from uplata a inner join uplatakorisnikprofesorrazred c on c.uplata=a.sifra inner join korisnikprofesorrazred d on d.sifra=c.korisnikprofesorrazred inner join ucenikroditelj e on e.sifra=d.ucenikroditelj inner join korisnik b on b.sifra=e.roditelj where c.proknjizeno=0
 and month(a.vrijeme)='$vrijeme'");
  $izraz->execute();
  $korisnici=$izraz->fetchALL(PDO::FETCH_OBJ);
  foreach ($korisnici as $korisnik) {
    $device_token=$korisnik->device;
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
  } 
  header("location: profesor.php?uspjeh");
}
?>
<body class="bodyRavnatelj">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <header class="headerRavnatelj">
          <h2>Dobrodošli</h2>
          <h2 class="imeProfesora" style="margin-right:200px"><?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?></h2>
          <a class="btn btn-default pull-right ravnateljBtn" href="odjava.php">Odjava</a>
          <a class="btn btn-default pull-right ravnateljBtn povratak" href="profesorUplate.php">Povratak</a>
        </header>
      </div>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="row profesor">
      <div class="col-md-12">
       <p>
     <?php if(isset($_GET['uspjeh'])) {
      echo "Poruke su poslane svim korisnicima koji nisu uplatili do sada.";
      } ?>
   </p>
        <p style="padding-top:5%">Ukoliko želite poslati obavijest o neplaćenim uplatnicama, unesite
        obavijest i pritisnite 'Pošalji'.</p>
        <textarea class="form-control obavijest" cols="50" id="obavijest"
        maxlength="255" name="obavijest" placeholder="Unesite obavijest" rows=
        "8">
</textarea> <input class="btn btn-default pull-right obavijestBtn"
        name="posaljiObavijest" type="submit" value="Pošalji">
      </div>
    </div>
    </form>
  </div>
<?php include "footer.php"; ?>
</body>
</html>