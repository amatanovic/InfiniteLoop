<?php
include "head.php"; 
if (!isset($_SESSION['autoriziran']->status) == 2) {
  header("location: odjava.php");
}
?>

<body class="bodyRavnatelj">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <header class="headerRavnatelj">
          <h2>Dobrodošli</h2>
          <a href="profesor.php" style="color:white;text-decoration:none"><h2 class="imeProfesora"><?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?></h2></a>
          <a class="btn btn-default pull-right ravnateljBtn" href="odjava.php">Odjava</a>
        </header>
      </div>
    </div>
    <div class="row profesorUplate">
      <div class="col-md-6">
        <h3 style="padding-bottom: 50px">Proknjižene uplate</h3>
        <?php     
  $vrijeme = date("m");
  $izraz=$veza->prepare("select a.slika, b.ime, b.prezime from uplata a inner join uplatakorisnikprofesorrazred c on c.uplata=a.sifra inner join korisnikprofesorrazred d on d.sifra=c.korisnikprofesorrazred inner join ucenikroditelj e on e.sifra=d.ucenikroditelj inner join korisnik b on b.sifra=e.ucenik where c.proknjizeno=1
 and month(a.vrijeme)='$vrijeme'");
  $izraz->bindValue(":sifra", $_SESSION['autoriziran']->sifra);
  $izraz->execute();
  $uplate=$izraz->fetchALL(PDO::FETCH_OBJ); 
  foreach ($uplate as $uplata):?>
        <div class="thumbnail">
        <h4><?php echo $uplata->ime . " " . $uplata->prezime; ?></h4>
        <img alt="Uplatnica" src="<?php echo $uplata->slika; ?>">
        </div>
  <?php endforeach; ?>
  </div>
      <div class="col-md-6">
        <h3 style="padding-bottom: 20px">Neproknjižene uplate</h3>
        <p>(očekivani iznos uplate je 150 kn)</p>
         <?php     
  $vrijeme = date("m");
  $izraz=$veza->prepare("select a.slika, b.ime, b.prezime, c.sifra from uplata a inner join uplatakorisnikprofesorrazred c on c.uplata=a.sifra inner join korisnikprofesorrazred d on d.sifra=c.korisnikprofesorrazred inner join ucenikroditelj e on e.sifra=d.ucenikroditelj inner join korisnik b on b.sifra=e.ucenik where c.proknjizeno=0
 and month(a.vrijeme)='$vrijeme'");
  $izraz->bindValue(":sifra", $_SESSION['autoriziran']->sifra);
  $izraz->execute();
  $uplate=$izraz->fetchALL(PDO::FETCH_OBJ); 
  foreach ($uplate as $uplata):?>
        <div class="thumbnail">
        <h4><?php echo $uplata->ime . " " . $uplata->prezime; ?></h4>
        <img alt="Uplatnica" src="<?php echo $uplata->slika; ?>">
        <div class="checkbox pull-right">
            <label class="proknjizi" id="<?php echo $uplata->sifra; ?>"><input type="checkbox"> Proknjiženo</label>
          </div>
        </div>
  <?php endforeach; ?>        
        </div>
      </div>
    </div>

  <?php include "footer.php"; ?>
  <script>
  $(".proknjizi").click(function() {
    var sifra = $(this).attr("id");
    $.ajax({
        type: "POST",
        url: "proknjizi.php",
        data: "sifra=" + sifra,
        success: function(msg){
          if(msg=="OK") {
          window.location="profesorUplate.php";
          }
        }
      });
  })

  </script>
</body>
</html>