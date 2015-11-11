<?php
include "head.php"; 
if (!isset($_SESSION['autoriziran']->status) == 3 || !isset($_SESSION['autoriziran']->status) == 4) {
  header("location: odjava.php");
}
date_default_timezone_set("Europe/Zagreb");
if (isset($_POST['uplatnica'])) {
  if ($_FILES['slika']) {
    $vrijeme = date("Y-m-d");
$slika = file_get_contents($_FILES['slika']['tmp_name']);
$slika = base64_encode($slika);
$izraz=$veza->prepare("insert into uplata (slika, ocekivanacijena, vrijeme) values ('data:image/png;base64,$slika', :cijena, '$vrijeme')");
$izraz->bindValue(":cijena", $_POST['cijena']); 
$izraz->execute();
$id = $veza->lastInsertId();
$izraz=$veza->prepare("insert into uplatakorisnikprofesorrazred (korisnikprofesorrazred, uplata, proknjizeno) values (:sifra, $id, 0)");
$izraz->bindValue(":sifra", $_POST['sifra']); 
$izraz->execute();
header("location: roditeljUcenik.php");
  }
  else {
    header("location: roditeljUcenik.php?pogreska");
  }
}
?>

<body class="bodyRavnatelj">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <header class="headerRavnatelj">
          <h2>Dobrodošli</h2>
          <h2 class="imeRoditelja"><?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?></h2>
          <a class="btn btn-default pull-right ravnateljBtn" href="odjava.php">Odjava</a>
        </header>
      </div>
    </div>
    <div class="row profesorUplate">
      <div class="col-md-12">
  
  <?php
  $vrijeme = date("m");
  $izraz=$veza->prepare("select a.slika, b.proknjizeno from uplata a inner join uplatakorisnikprofesorrazred b on b.uplata=a.sifra inner join korisnikprofesorrazred c on c.sifra=b.korisnikprofesorrazred inner join ucenikroditelj d on d.sifra=c.ucenikroditelj inner join korisnik e on e.sifra=d.ucenik where e.sifra=:sifra and month(a.vrijeme)='$vrijeme'");
  $izraz->bindValue(":sifra", $_SESSION['autoriziran']->sifra);
  $izraz->execute();
  $uplata=$izraz->fetch(PDO::FETCH_OBJ);
  if ($uplata!=null) { ?>
    <div class="thumbnail roditelj"><img alt="Uplatnica" src="<?php echo $uplata->slika; ?>"></div>
      <?php if ($uplata->proknjizeno==1) { ?>
            <p>Poštovani, Vaša uplata je uspješno proknjižena.</p>
       <?php } else { ?>
        <p>Poštovani, Vaša uplata još nije proknjižena. Molimo Vas pričekajte
        obavijest o proknjiženju.</p>
       <?php }?>

 <?php }
  if ($uplata==null) {
   $izraz=$veza->prepare("select a.slika, b.proknjizeno from uplata a inner join uplatakorisnikprofesorrazred b on b.uplata=a.sifra inner join korisnikprofesorrazred c on c.sifra=b.korisnikprofesorrazred inner join ucenikroditelj d on d.sifra=c.ucenikroditelj inner join korisnik e on e.sifra=d.roditelj where e.sifra=:sifra and month(a.vrijeme)='$vrijeme'");
  $izraz->bindValue(":sifra", $_SESSION['autoriziran']->sifra);
  $izraz->execute();
  $uplata=$izraz->fetch(PDO::FETCH_OBJ);
  if ($uplata!=null) {
 
   ?>
        <div class="thumbnail roditelj"><img alt="Uplatnica" src="<?php echo $uplata->slika; ?>"></div>
        <?php if ($uplata->proknjizeno==1) { ?>
            <p>Poštovani, Vaša uplata je uspješno proknjižena.</p>
       <?php } else { ?>
        <p>Poštovani, Vaša uplata još nije proknjižena. Molimo Vas pričekajte
        obavijest o proknjiženju.</p>
       <?php }?>
<?php } 
  else { ?>
  <?php 
  $izraz=$veza->prepare("select iznos from cijena where skola=:skola");
  $izraz->bindValue(":skola", $_SESSION['autoriziran']->skola);
  $izraz->execute();
  $cijena=$izraz->fetch(PDO::FETCH_OBJ); 
   ?>
  <h3>Trenutna cijena iznosi <?php echo $cijena->iznos; ?> kuna</h3>
   <?php 
  $izraz=$veza->prepare("select a.sifra from korisnikprofesorrazred a inner join ucenikroditelj b on b.sifra=a.ucenikroditelj inner join korisnik c on c.sifra=b.ucenik where c.sifra=:sifra");
  $izraz->bindValue(":sifra", $_SESSION['autoriziran']->sifra);
  $izraz->execute();
  $korisnik=$izraz->fetch(PDO::FETCH_OBJ); 
  if ($korisnik!=null) { ?>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
          <div class="form-group input-group">
            <input name="sifra" type="hidden" value="<?php echo $korisnik->sifra; ?>">
            <input name="cijena" type="hidden" value="<?php echo $cijena->iznos; ?>">
             <input accept="image/*" class="uplatnica" id="slika" name="slika" style=
            "margin-top:1em;margin-left: 16%;border: none;" type="file">
            <button class="btn btn-default promjena" name="uplatnica" type=
            "submit" value="Objavi">Objavi</button>
          </div>
        </form>
 <?php
} else {
  $izraz=$veza->prepare("select a.sifra from korisnikprofesorrazred a inner join ucenikroditelj b on b.sifra=a.ucenikroditelj inner join korisnik c on c.sifra=b.roditelj where c.sifra=:sifra");
  $izraz->bindValue(":sifra", $_SESSION['autoriziran']->sifra);
  $izraz->execute();
  $korisnik=$izraz->fetch(PDO::FETCH_OBJ); ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
          <div class="form-group input-group">
            <input name="sifra" type="hidden" value="<?php echo $korisnik->sifra; ?>">
            <input name="cijena" type="hidden" value="<?php echo $cijena->iznos; ?>">
             <input accept="image/*" class="uplatnica" id="slika" name="slika" style=
            "margin-top:1em;margin-left: 16%;border: none;" type="file">
            <button class="btn btn-default promjena" name="uplatnica" type=
            "submit" value="Objavi">Objavi</button>
          </div>
        </form>
<?php
}
  }
  } 
  ?>
    </div>
  </div>
  <?php include "footer.php"; ?>
</body>
</html>