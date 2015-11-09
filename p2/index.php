<?php include "head.php"; ?>
<body>

<form method="POST" action="">
    <div class="form-group input-group">
     	<div class="input-group">
  		<span class="input-group-addon profil">IME</span>
  		<input type="text" name="ime" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon profil">PREZIME</span>
  		<input type="text" name="prezime" class="form-control"aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon profil">LOZINKA</span>
  		<input type="password" name="lozinka" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon profil">EMAIL</span>
  		<input type="password" name="email" class="form-control" aria-describedby="basic-addon1" />
		</div>

    <div class="input-group">
      <span class="input-group-addon profil">ŽUPANIJA</span>
      <select name="zupanija" class="zupanija">
       <!-- ovaj option ispod gdje piše izaberite županije mora ostati. isto je tako i za gradove i skole -->
      <option disabled selected> -- Izaberite županiju -- </option>
      <?php
$izraz=$veza->prepare("select * from zupanija");
$izraz->execute();
$zupanije=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($zupanije as $zupanija): 
  ?>
<option value="<?php echo $zupanija->sifra; ?>" id="<?php echo $zupanija->sifra; ?>"><?php echo $zupanija->naziv; ?></option>
<?php endforeach; ?>
</select>
    </div>
     <div class="input-group">
      <span class="input-group-addon profil">GRAD</span>
      <select name="grad" class="selectGradovi">
      <option disabled selected> -- Izaberite grad -- </option>
      <?php
$izraz=$veza->prepare("select * from grad group by naziv ASC");
$izraz->execute();
$gradovi=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($gradovi as $grad): 
  ?>
<option value="<?php echo $grad->sifra; ?>" class="grad" id="<?php echo $grad->sifra; ?>"><?php echo $grad->naziv; ?></option>
<?php endforeach; ?>
</select>
    </div>
        <div class="input-group">
      <span class="input-group-addon profil">ŠKOLA</span>
      <select name="skola" class="selectSkole">
      <option disabled selected> -- Izaberite školu -- </option>
      <?php
$izraz=$veza->prepare("select * from skola group by naziv ASC");
$izraz->execute();
$skole=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($skole as $skola): 
  ?>
<option value="<?php echo $skola->sifra; ?>" class="skola" id="<?php echo $skola->sifra; ?>"><?php echo $skola->naziv; ?></option>
<?php endforeach; ?>
</select>
    </div>
     <div class="input-group status" style="display: none">
      <span class="input-group-addon profil">STATUS</span>
       <select name="status" class="selectStatus">
      <option disabled selected> -- Izaberite status u pripadajućoj školi -- </option>
      <?php
$izraz=$veza->prepare("select * from status group by status ASC");
$izraz->execute();
$statusi=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($statusi as $status): 
  ?>
<option value="<?php echo $status->sifra; ?>" class="skola" id="<?php echo $status->sifra; ?>"><?php echo $status->status; ?></option>
<?php endforeach; ?>
</select>
    </div>
    <div class="input-group statusProfesor" style="display:none">
      <span class="input-group-addon profil">Odaberite svoj razred</span>
       <select name="profesor" class="selectProfesor">
    
      </select>
    </div>
 <div class="input-group statusUcenik" style="display:none">
      <span class="input-group-addon profil">Odaberi svoj razred</span>
       <select name="ucenik" class="selectUcenik">
     
      </select>
    </div>
 <div class="input-group statusRoditelj" style="display:none">
      <span class="input-group-addon profil">Odaberite svog učenika</span>
       <select name="roditelj" class="selectRoditelj">
     
</select>
    </div>
    <div class="row">
      <button type="submit" value="Registracija" name="registracija" class="btn btn-default">Registracija</button>
  </div>
  </div>
	</form>

</body>
<?php include "footer.php"; ?>
<script>
$(function(){
  selectGrad();
});

function selectGrad() {
$(".zupanija").change(function(){
  $(".status").css("display", "none");
  $(".statusProfesor").css("display", "none");
  $(".statusUcenik").css("display", "none");
  $(".statusRoditelj").css("display", "none");
  var zupanija = $(this).find(':selected').val();
      $.ajax({
        type: "POST",
        url: "selectGrad.php",
        data: "zupanija=" + zupanija,
        success: function(msg){
          podatci=$.parseJSON(msg);
          $(".selectGradovi").html("<option disabled selected> -- Izaberite grad -- </option>");
          $.each(podatci, function(i, item){
          $(".selectGradovi").append($('<option value=' + item.sifra + ' class="grad" id=' + item.sifra + '>' + item.naziv + '</option>'));
        });
          selectSkola();
        }
      });
        
      });
    
  } 

 function selectSkola() {
     var zupanija = $(".zupanija").find(':selected').val();
      $.ajax({
        type: "POST",
        url: "selectSkola.php",
        data: "zupanija=" + zupanija,
        success: function(msg){
          podatci=$.parseJSON(msg);
          $(".selectSkole").html("<option disabled selected> -- Izaberite školu -- </option>");
          $.each(podatci, function(i, item){
          $(".selectSkole").append($('<option value=' + item.sifra + ' class="grad" id=' + item.sifra + '>' + item.naziv + '</option>'));
        });
        }
      });
    }

$(".selectGradovi").change(function (){
  $(".status").css("display", "none");
  $(".statusProfesor").css("display", "none");
  $(".statusUcenik").css("display", "none");
  $(".statusRoditelj").css("display", "none");
   var grad = $(".selectGradovi").find(':selected').val();
      $.ajax({
        type: "POST",
        url: "selectSkolaGrad.php",
        data: "grad=" + grad,
        success: function(msg){
          podatci=$.parseJSON(msg);
          $(".selectSkole").html("<option disabled selected> -- Izaberite školu -- </option>");
          $.each(podatci, function(i, item){
          $(".selectSkole").append($('<option value=' + item.sifra + ' class="grad" id=' + item.sifra + '>' + item.naziv + '</option>'));
        });
        }
      });
      $.ajax({
        type: "POST",
        url: "selectZupaniju.php",
        data: "grad=" + grad,
        success: function(msg){
            podatak=$.parseJSON(msg);
            $(".zupanija option").each(function() {
            if ($(this).attr("id") === podatak.zupanija) {
              $(this).attr("selected", "selected");
            }
            })
        }
      });
        
      });

$(".selectSkole").change(function (){
  $(".status").css("display", "block");
   var skola = $(".selectSkole").find(':selected').val();
  $(".statusProfesor").css("display", "none");
  $(".statusUcenik").css("display", "none");
  $(".statusRoditelj").css("display", "none");
  $(".status option").each(function() { 
    if ($(this).val() == "-- Izaberite status u pripadajućoj školi --") {
      $(this).attr("selected", "selected");
    }
  })
 
     $.ajax({
        type: "POST",
        url: "selectOdabranuSkolu.php",
        data: "skola=" + skola,
        success: function(msg){
            podatak=$.parseJSON(msg);
            $(".selectGradovi option").each(function() {
            if ($(this).attr("id") === podatak.grad) {
              $(this).attr("selected", "selected");
                 $.ajax({
                  type: "POST",
                  url: "selectZupaniju.php",
                 data: "grad=" + $(this).attr("id"),
                 success: function(msg){
            podatak=$.parseJSON(msg);
            $(".zupanija option").each(function() {
            if ($(this).attr("id") === podatak.zupanija) {
              $(this).attr("selected", "selected");
            }
            })
        }
          
       })
     }
    })
  }
      
})
});

$(".selectStatus").change(function(){
  $(".statusProfesor").css("display", "none");
  $(".statusUcenik").css("display", "none");
  $(".statusRoditelj").css("display", "none");

  var status = $(this).find(':selected').val();
  var skola = $(".selectSkole").find(':selected').val();
  if (status == 2) {
      $(".statusProfesor").css("display", "block");
      $(".selectProfesor").html("<option disabled selected> -- Izaberite svoj razred -- </option>");
      $.ajax({
        type: "POST",
        url: "selectProfesorRazred.php",
        data: "skola=" + skola,
        success: function(msg){
          podatci=$.parseJSON(msg);
          $.each(podatci, function(i, item){
          $(".selectProfesor").append($('<option selected value=' + item.sifra + ' class="profesor" id=' + item.sifra + '>' + item.razred + item.odjeljenje + '</option>'));
        });
        }
      });
  }
  if (status == 3) {
      $(".statusUcenik").css("display", "block");
      $(".selectUcenik").html("<option disabled selected> -- Izaberi svoj razred -- </option>");
       $.ajax({
        type: "POST",
        url: "selectUcenikRazred.php",
        data: "skola=" + skola,
        success: function(msg){
          podatci=$.parseJSON(msg);
          $.each(podatci, function(i, item){
          $(".selectUcenik").append($('<option selected value=' + item.sifra + ' class="profesor" id=' + item.sifra + '>' + item.razred + item.odjeljenje + '</option>'));
        });
        }
      });
  }
  if (status == 4) {
      $(".statusRoditelj").css("display", "block");
      $(".selectRoditelj").html("<option disabled selected> -- Izaberite svog učenika -- </option>");
      $.ajax({
        type: "POST",
        url: "selectRoditelj.php",
        data: "skola=" + skola,
        success: function(msg){
          podatci=$.parseJSON(msg);
          $.each(podatci, function(i, item){
          $(".selectRoditelj").append($('<option selected value=' + item.sifra + ' class="profesor" id=' + item.sifra + '>' + item.ime + " " + item.prezime + '</option>'));
        });
        }
      });
  
  }
        
      });

</script>
</html>