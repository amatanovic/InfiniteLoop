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
          <a class="btn btn-default pull-right ravnateljBtn" href="odjava.php">Odjava</a>
        </header>
      </div>
    </div>
    <div class="row tablica">
      <div class="col-md-12">
        <h3 id="dodajNovi"><span aria-hidden="true" class=
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
  $izraz=$veza->prepare("select a.razred, b.odjeljenje, d.profesor, d.sifra from razred a inner join skolarazred c on a.sifra=c.razred inner join odjeljenje b on b.sifra=c.odjeljenje inner join profesorrazred d on c.sifra=d.skolarazred where c.skola=:skola group by a.razred ASC");
  $izraz->bindValue(":skola", $_SESSION['autoriziran']->skola);
  $izraz->execute();
  $podaci=$izraz->fetchALL(PDO::FETCH_OBJ); 
  foreach ($podaci as $podatak):

   ?>
<tr>
<td>
 <?php 
 if ($podatak->profesor==null) { ?>
 <input type="hidden" value="<?php echo $podatak->sifra ?>" />
 <input type="text" placeholder="Ukoliko ne možete pronaći profesora, on još uvijek nije registriran" class="form-control" />

<?php  }
 else {
  $izraz=$veza->prepare("select a.ime, a.prezime from korisnik a inner join profesorrazred b on a.sifra=b.profesor where profesor=:profesor");
  $izraz->bindValue(":profesor", $podatak->profesor);
  $izraz->execute();
  $profesor=$izraz->fetch(PDO::FETCH_OBJ); 
  ?>
<input type="hidden" value="<?php echo $podatak->sifra ?>" />
<input type="text" value="<?php echo $profesor->ime . " " . $profesor->prezime; ?>" class="form-control" />
<?php } ?>
</td>
<td><?php echo $podatak->razred; ?></td><td><?php echo $podatak->odjeljenje; ?></td></tr>
<?php endforeach; ?>
  <tr><td></td><td class="pokaziNovi" style="visibility:hidden"><select class="razred">
     <?php 
  $izraz=$veza->prepare("select * from razred");
  $izraz->execute();
  $razredi=$izraz->fetchALL(PDO::FETCH_OBJ); 
  foreach ($razredi as $razred): ?>
  <option value="<?php echo $razred->sifra; ?>"><?php echo $razred->razred; ?></option>
<?php endforeach; ?>
  </select>
  <td class="pokaziNovi" style="visibility:hidden">
   <select class="odjeljenje">
     <?php 
  $izraz=$veza->prepare("select * from odjeljenje");
  $izraz->execute();
  $odjeljenja=$izraz->fetchALL(PDO::FETCH_OBJ); 
  foreach ($odjeljenja as $odjeljenje): ?>
  <option value="<?php echo $odjeljenje->sifra; ?>"><?php echo $odjeljenje->odjeljenje; ?></option>
<?php endforeach; ?>
  </select> 
  </td>
  </tr>
        </table>
    <p>
     <?php if(isset($_GET['uspjesanUpdate'])) {
      echo "Uspješno ste izmijenili profesora.";
      } ?>
   </p>
    <p id="errorRazred"></p>
  <a class="btn btn-default pull-right" style="display:none" id="pohrana">Pohrani razrede</a>
      </div>
    </div>
    <div class="row"></div>
  </div><?php include "footer.php"; ?>
  <script>
  $(function(){
  $("#dodajNovi").click(function() {
    $(".pull-right").css("display", "block");
    $(".pokaziNovi").css("visibility", "visible");
  })
  $("#pohrana").click(function() {
    var razred = $(".razred").find(':selected').val();
    var odjeljenje = $(".odjeljenje").find(':selected').val();
    $.ajax({
        type: "POST",
        url: "insertRazred.php",
        data: "razred=" + razred + "&odjeljenje=" + odjeljenje + "&skola=" + <?php echo $_SESSION['autoriziran']->skola; ?>,
        success: function(msg){
          if (msg=="OK") {
            window.location="ravnatelj.php";
          }
          else {
            $("#errorRazred").html("Ovaj razred već postoji.");
          }
        }
      });
  })

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