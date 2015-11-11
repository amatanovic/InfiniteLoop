<?php
include "head.php"; 
if (!isset($_SESSION['autoriziran']->status) == 3 || !isset($_SESSION['autoriziran']->status) == 4) {
  header("location: odjava.php");
}
date_default_timezone_set("Europe/Zagreb");
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
        <form action="" enctype="multipart/form-data" method="post">
          <div class="form-group input-group">
            <input name="sifra" type="hidden" value=
            "<?php echo $_SESSION['autoriziran']->sifra ?>"> <input accept=
            "image/*" class="uplatnica" id="slika" name="slika" style=
            "margin-top:1em;margin-left: 16%;border: none;" type="file">
            <button class="btn btn-default promjena" name="uplatnica" type=
            "submit" value="Objavi">Objavi</button>
          </div>
        </form>
         <?php
  $vrijeme = date("m");
  $izraz=$veza->prepare("select a.slika from uplata a inner join uplatakorisnikprofesorrazred b on b.uplata=a.sifra inner join korisnikprofesorrazred c on c.sifra=b.korisnikprofesorrazred inner join ucenikroditelj d on d.sifra=c.ucenikroditelj inner join korisnik e on e.sifra=d.ucenik where e.sifra=:sifra and month(a.vrijeme)='$vrijeme'");
  $izraz->bindValue(":sifra", $_SESSION['autoriziran']->sifra);
  $izraz->execute();
  $uplata=$izraz->fetch(PDO::FETCH_OBJ); 
   ?>
        <div class="thumbnail roditelj"><img alt="Uplatnica" src="<?php echo $uplata->slika; ?>"></div>
        <p>Uspješno ste pohranili sliku uplatnice za Tenu Vilček. Molimo Vas
        pričekajte obavijest o proknjiženju.</p>
      </div>
    </div><?php include "footer.php"; ?>
  </div>
</body>
</html>