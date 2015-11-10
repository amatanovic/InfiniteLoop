<?php
include "head.php"; 
if (!isset($_SESSION['autoriziran']->status) == 1) {
  header("location: odjava.php");
}
?>

<body class="bodyRavnatelj">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <header class="headerRavnatelj">
          <h2>Dobrodošli</h2>
          <h2 class="imeRavnatelja"><?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?></h2>
          <a class="btn btn-default pull-right ravnateljBtn" href="odjava.php">Odjavi se</a>
        </header>
      </div>
    </div>
    <div class="row tablica">
      <div class="col-md-12">
        <h3><span aria-hidden="true" class=
        "glyphicon glyphicon-plus"></span>Dodaj novi razred</h3>
        <div class="form-group input-group">
          <div class="input-group">
            <span class="input-group-addon" style="color: black">CIJENA:</span>
             <?php 
  $izraz=$veza->prepare("select iznos from cijena where skola=:skola");
  $izraz->bindValue(":skola", $_SESSION['autoriziran']->skola);
  $izraz->execute();
  $cijena=$izraz->fetch(PDO::FETCH_OBJ); 
   ?>
            <input aria-describedby="basic-addon1" class="form-control" id="cijena" type="text" value="<?php echo $cijena->iznos; ?>">
          </div>
          <p id="porukaCijena"></p>
        </div>
        <table class="table">
          <tr>
            <th>PROFESOR</th>
            <th>RAZRED</th>
            <th>ODJELJENJE</th>
          </tr>
          <?php 
  $izraz=$veza->prepare("select a.razred, b.odjeljenje, e.ime, e.prezime, d.sifra from razred a inner join skolarazred c on a.sifra=c.razred inner join odjeljenje b on b.sifra=c.odjeljenje inner join profesorrazred d on c.sifra=d.skolarazred inner join korisnik e on d.profesor=e.sifra where c.skola=:skola and d.profesor is not null");
  $izraz->bindValue(":skola", $_SESSION['autoriziran']->skola);
  $izraz->execute();
  $podaci=$izraz->fetchALL(PDO::FETCH_OBJ); 
  foreach ($podaci as $podatak):
   ?>
<tr><td>
<input type="hidden" value="<?php echo $podatak->sifra ?>" /><input type="text" value="<?php echo $podatak->ime . " " . $podatak->prezime; ?>" class="form-control" /></td><td><?php echo $podatak->razred; ?></td><td><?php echo $podatak->odjeljenje; ?></td></tr>
<?php endforeach; ?>
        </table>
    <p>
     <?php if(isset($_GET['uspjesanUpdate'])) {
      echo "Uspješno ste izmijenili profesora.";
      } ?>
   </p>
<input class="btn btn-default pull-right" name="promjeni" type="submit" value="Pohrani promjene" style="display:none">
      </div>
    </div>
    <div class="row"></div>
  </div><?php include "footer.php"; ?>
  <script>
  $(function(){
  $("#cijena").focusout(function() {
    $.ajax({
        type: "POST",
        url: "updateCijena.php",
        data: "cijena=" + $("#cijena").val() + "&skola=" + <?php echo $_SESSION['autoriziran']->skola; ?>,
        success: function(msg){
          if (msg="OK") {
          $("#porukaCijena").html("Uspješno ste izmjenili cijenu za svoju školu.");
          }
        }
      });
  })
   $("#cijena").keypress(function(e) {
    if(e.which == 13) {
      $.ajax({
        type: "POST",
        url: "updateCijena.php",
        data: "cijena=" + $("#cijena").val() + "&skola=" + <?php echo $_SESSION['autoriziran']->skola; ?>,
        success: function(msg){
          if (msg="OK") {
          $("#porukaCijena").html("Uspješno ste izmjenili cijenu za svoju školu.");
          }
        }
      });
    }
});
   $(".form-control").on("input", function() {
      var term = $(this).val();
      var profesorrazred = $(this).siblings("input").val();
      $(this).autocomplete({

    source: "traziProfesora.php?skola=<?php echo $_SESSION['autoriziran']->skola; ?>&term=" + term,

    minLength: 1,

    focus: function( event, ui ) {
    event.preventDefault();
    },

    select: function(event, ui) {

        $(this).val('').blur();

        event.preventDefault();

      spremiUBazuPitanje(ui.item, profesorrazred);

    }

}).data( "ui-autocomplete" )._renderItem = function( ul, profesor ) {

      return $( "<li>" )

        .append( "<a>" + profesor.ime + " " + profesor.prezime + "</a>" )

        .appendTo( ul );
    }; 

});
   })


  function spremiUBazuPitanje(item, profesorrazred){

  $.ajax({

type: "POST",

url: "dodajProfesoraURazred.php",

data: "profesorrazred=" + profesorrazred + "&profesor=" + item.sifra,

success: function(vratioServer){

if(vratioServer=="OK"){
window.location="ravnatelj.php?uspjesanUpdate";
}



}


});

  };
  </script>
</body>
</html>