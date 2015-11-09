<?php
include "head.php";

?>
<body class="bodyIndex">
  <div class="container-fluid">
  <header>
      <div class="trakaIndex">
      Dobrodošli <?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?>
      <a href="odjava.php" class="btn btn-default">Odjava</a>
</div>
          
  </header>
  <div class="col-md-12">
  <?php 
  $izraz=$veza->prepare("select iznos from cijena where skola=:skola");
  $izraz->bindValue(":skola", $_SESSION['autoriziran']->skola);
  $izraz->execute();
  $cijena=$izraz->fetch(PDO::FETCH_OBJ); 
   ?>
   Cijena<input type="text" value="<?php echo $cijena->iznos; ?>" id="cijena" />
   <p id="porukaCijena"></p>
   <!-- dodaj novi ne radi zasada -->
   <p>Dodaj novi razred</p>
   <table border="1" style="width:100%">
   <thead>
   <th>Profesor</th>
   <th>Razred</th>
   <th>Odjeljenje</th>
   </thead>
   <tbody>
    <?php 
  $izraz=$veza->prepare("select a.razred, b.odjeljenje, e.ime, e.prezime, d.sifra from razred a inner join skolarazred c on a.sifra=c.razred inner join odjeljenje b on b.sifra=c.odjeljenje inner join profesorrazred d on c.sifra=d.skolarazred inner join korisnik e on d.profesor=e.sifra where c.skola=:skola and d.profesor is not null");
  $izraz->bindValue(":skola", $_SESSION['autoriziran']->skola);
  $izraz->execute();
  $podaci=$izraz->fetchALL(PDO::FETCH_OBJ); 
  foreach ($podaci as $podatak):
   ?>
<tr><td><input type="hidden" value="<?php echo $podatak->sifra ?>" id="profesorrazred" /><input type="text" value="<?php echo $podatak->ime . " " . $podatak->prezime; ?>" id="traziProfesora" /></td><td><?php echo $podatak->razred; ?></td><td><?php echo $podatak->odjeljenje; ?></td></tr>
<?php endforeach; ?>
   </tbody>
   </table>
   <p>
     <?php if(isset($_GET['uspjesanUpdate'])) {
      echo "Uspješno ste izmijenili profesora.";
      } ?>
   </p>
</div>
</div>
<?php include "footer.php"; ?>
</body>
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
  var term = $("#traziProfesora").val();
    $("#traziProfesora").autocomplete({

    source: "traziProfesora.php?skola=<?php echo $_SESSION['autoriziran']->skola; ?>&term=" + term,

    minLength: 1,

    focus: function( event, ui ) {
    event.preventDefault();
    },

    select: function(event, ui) {

        $(this).val('').blur();

        event.preventDefault();

      spremiUBazuPitanje(ui.item);

    }

}).data( "ui-autocomplete" )._renderItem = function( ul, profesor ) {

      return $( "<li>" )

        .append( "<a>" + profesor.ime + " " + profesor.prezime + "</a>" )

        .appendTo( ul );
    }; 

});

  function spremiUBazuPitanje(item){

  $.ajax({

type: "POST",

url: "dodajProfesoraURazred.php",

data: "profesorrazred=" + $("#profesorrazred").val() + "&profesor=" + item.sifra,

success: function(vratioServer){

if(vratioServer=="OK"){
window.location="nadzornaRavnatelj.php?uspjesanUpdate";
}



}


});

  };


    

</script>
</html>