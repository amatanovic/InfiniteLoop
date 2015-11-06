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
$izraz=$veza->prepare("select * from grad");
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
$izraz=$veza->prepare("select * from skola");
$izraz->execute();
$skole=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($skole as $skola): 
  ?>
<option value="<?php echo $skola->sifra; ?>" class="skola" id="<?php echo $skola->sifra; ?>"><?php echo $skola->naziv; ?></option>
<?php endforeach; ?>
</select>
    </div>
     <div class="input-group">
      <span class="input-group-addon profil">STATUS</span>
      <input type="password" name="skola" class="form-control" aria-describedby="basic-addon1" />
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
  var zupanija = $(this).find(':selected').val();
      $.ajax({
        type: "POST",
        url: "selectGrad.php",
        data: "zupanija=" + zupanija,
        success: function(msg){
          podatci=$.parseJSON(msg);
          $(".selectGradovi").html("");
          var i = 0;
          $.each(podatci, function(i, item){
          if (i == 0) {
          $(".selectGradovi").append($('<option selected value=' + item.sifra + ' class="grad" id=' + item.sifra + '>' + item.naziv + '</option>'));
        }
        else if (i !== 0) {
          $(".selectGradovi").append($('<option value=' + item.sifra + ' class="grad" id=' + item.sifra + '>' + item.naziv + '</option>'));
        }
        i++;
        });
          selectSkola();
        }
      });
        
      });
    
  } 

  function selectSkola() {
     var grad = $(".selectGradovi").find(':selected').val();
      $.ajax({
        type: "POST",
        url: "selectSkola.php",
        data: "grad=" + grad,
        success: function(msg){
          podatci=$.parseJSON(msg);
          $(".selectSkole").html("");
          $.each(podatci, function(i, item){
          $(".selectSkole").append($('<option value=' + item.sifra + ' class="grad" id=' + item.sifra + '>' + item.naziv + '</option>'));
        });
        }
      });
    }

$(".selectGradovi").change(function (){
   var grad = $(".selectGradovi").find(':selected').val();
      $.ajax({
        type: "POST",
        url: "selectSkola.php",
        data: "grad=" + grad,
        success: function(msg){
          podatci=$.parseJSON(msg);
          $(".selectSkole").html("");
          $.each(podatci, function(i, item){
          $(".selectSkole").append($('<option value=' + item.sifra + ' class="grad" id=' + item.sifra + '>' + item.naziv + '</option>'));
        });
        }
      });
        return false;
      });

</script>
</html>