<?php include "header_navigation.php";
$korisnikID = $_SESSION['autoriziran']->sifra; 
$poruke=array();
if(isset($_POST['promjenaAvatara'])){
  if ($_FILES['slika']) {
    $slike_dir = "slike/";
    $ext = pathinfo($_FILES['slika']['name'], PATHINFO_EXTENSION);
    $slika_datoteka = $slike_dir . "avatar_" . $korisnikID . "." . $ext;
    $izraz1 = $veza->prepare("update korisnik set avatar='$slika_datoteka' where sifra=$korisnikID");
    $izraz1->execute();
    echo $slika_datoteka;
    move_uploaded_file($_FILES["slika"]["tmp_name"], $slika_datoteka);
  }
  header("location: mojProfil.php");
}
if(isset($_POST['promjeni'])){
if($_POST['lozinka'] == "" || $_POST['lozinka'] != $_POST['lozinka2']){
	array_push($poruke, "Unešene lozinke nisu identične");
	goto ostalo;
}
  $izraz = $veza->prepare("update korisnik set ime=:ime, prezime=:prezime, lozinka=:lozinka where sifra=$korisnikID");
  $izraz->bindValue(":ime",$_POST['ime']);
  $izraz->bindValue(":prezime",$_POST['prezime']); 
  $izraz->bindValue(":lozinka",md5($_POST['lozinka']));
  $izraz->execute();
  header("location: mojProfil.php");
}
ostalo:
?>
<div class="col-md-8">
<?php 
$izraz=$veza->prepare("select * from korisnik where sifra=$korisnikID");
$izraz->execute();
$korisnik=$izraz->fetch(PDO::FETCH_OBJ);
?>
<p>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<img src="<?php echo $korisnik->avatar; ?>" style="width:20%" />
  <input class="odaberi-avatar " style="margin-top:1em;width:72%;margin-left: 16%;border: none;" type="file" name="slika" id="slika" accept="image/*" />
    <input type="submit" value="Promjeni avatar" name="promjenaAvatara" />
  </form>
</p>
<p>
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      	<div class="input-group">
  		<span class="input-group-addon">Ime</span>
  		<input type="text" name="ime" class="form-control" value="<?php echo $korisnik->ime;?>" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon">Prezime</span>
  		<input type="text" name="prezime" class="form-control" value="<?php echo $korisnik->prezime;?>" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon">Lozinka</span>
  		<input type="password" name="lozinka" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon">Ponovi lozinku</span>
  		<input type="password" name="lozinka2" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<input type="submit" value="Promjeni" name="promjeni" /><br />
	</form>
	<?php if(!empty($poruke)): ?>
	<?php foreach ($poruke as $p): ?>
	<span><?php echo $p; ?></span>
	<?php 
	endforeach; 
	endif; ?>

</p>
</div>
<?php include "korisnici.php"; ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>


    </script>
  </body>
</html>