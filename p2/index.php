<?php
include "head.php";
if(isset($_POST['registracija'])){
  if ($_POST['status'] != 1 && $_POST['profesor'] || $_POST['roditelj'] || $_POST['ucenik']) {
$izraz=$veza->prepare("insert into korisnik (ime, prezime, email, lozinka, status, skola) values (:ime, :prezime, :email, :lozinka, :status, :skola)");
$izraz->bindValue(":ime", $_POST['ime']); 
$izraz->bindValue(":prezime", $_POST['prezime']);
$izraz->bindValue(":email", $_POST['email']);
$izraz->bindValue(":lozinka", md5($_POST['lozinka']));
$izraz->bindValue(":status", $_POST['status']);
$izraz->bindValue(":skola", $_POST['skola']);
$izraz->execute();
$id = $veza->lastInsertId();
if($_POST['profesor']){
$izraz=$veza->prepare("update profesorrazred set profesor=$id where sifra=:profesor");
$izraz->bindValue(":profesor", $_POST['profesor']);
$izraz->execute(); 
}
if($_POST['ucenik']){
$izraz=$veza->prepare("insert into ucenikroditelj (ucenik) values ($id)");
$izraz->execute(); 
$id = $veza->lastInsertId();
$izraz=$veza->prepare("insert into korisnikprofesorrazred (ucenikroditelj, profesorrazred) values ($id, :ucenik)");
$izraz->bindValue(":ucenik", $_POST['ucenik']);
$izraz->execute(); 
}
if($_POST['roditelj']){
$izraz=$veza->prepare("update ucenikroditelj set roditelj=$id where sifra=:roditelj");
$izraz->bindValue(":roditelj", $_POST['roditelj']);
$izraz->execute(); 
}
header ("location: index.php?uspjesnaRegistracija");
}
else {
header ("location: index.php?porukaPogreske");
}
}
if(isset($_POST['prijava'])){
$izraz=$veza->prepare("select * from korisnik where email=:email and lozinka=:lozinka");
$izraz->bindValue(":email", $_POST['email']);
$izraz->bindValue(":lozinka", md5($_POST['lozinka']));
$izraz->execute();
$operater=$izraz->fetch(PDO::FETCH_OBJ); 
if($operater!=null){
  session_start();
  $_SESSION['autoriziran']=$operater;
  if ($_SESSION['autoriziran']->status == 1) {
    header("location: ravnatelj.php");
  }
    if ($_SESSION['autoriziran']->status == 2) {
    header("location: profesorUplate.php");
  }
    if ($_SESSION['autoriziran']->status == 3 || $_SESSION['autoriziran']->status == 4) {
    header("location: roditeljUcenik.php");
  }
}
else{
  header("location: index.php?loginError");
}

}
?>
<body class="bodyIndex">
  <div class="container-fluid">
  <header>
    <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="indexForma">
      <div class="trakaIndex"></div>
            <h2 class="indexH2">Prijava</h2>
            <div class="form-group input-group">
              <div class="input-group"> 
              <span class="input-group-addon logIn" style="background-color: #00BCD4">email</span>             
              <input type="text" class="form-control logIn" name="email" aria-describedby="basic-addon1" style="background-color: #00BCD4">
            </div>
            </div>
            <div class="form-group input-group">
              <div class="input-group">
                <span class="input-group-addon logIn" style="background-color: #00BCD4">lozinka</span>
              <input type="password" class="form-control logIn" name="lozinka" aria-describedby="basic-addon1" style="background-color: #00BCD4">
            </div>
            </div>
            <input type="submit" name="prijava" class="btn btn-default" value="Prijavi se" />
          </form>
          <p>
            <?php if(isset($_GET['loginError'])) {
              echo "Neuspješna prijava.";
              } ?>
          </p>
  </header>
  <div class="col-md-12">
    <h2>Registracija</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group input-group">
     	<div class="input-group">
  		<span class="input-group-addon">ime</span>
  		<input type="text" name="ime" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon">prezime</span>
  		<input type="text" name="prezime" class="form-control"aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon">lozinka</span>
  		<input type="password" name="lozinka" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon">email</span>
  		<input type="password" name="email" class="form-control" aria-describedby="basic-addon1" />
		</div>

    <div class="input-group">
      <span class="input-group-addon">županija</span>
      <select name="zupanija" class="zupanija">
  	       <!-- ovaj option ispod gdje piše izaberite županije mora ostati. isto je tako i za gradove i skole -->
      <option disabled selected></option>
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
      <span class="input-group-addon">grad</span>
      <select name="grad" class="selectGradovi">   
      <option disabled selected></option>
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
      <span class="input-group-addon">škola</span>
      <select name="skola" class="selectSkole">
      <option disabled selected></option>
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
     <div class="input-group status">
      <span class="input-group-addon">status</span>
       <select name="status" class="selectStatus"> 
      <option disabled selected></option>
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
    <div class="input-group statusProfesor">
      <span class="input-group-addon odaberi-razred">razred</span>
       <select name="profesor" class="selectProfesor">
    
      </select>
    </div>
 <div class="input-group statusUcenik">
      <span class="input-group-addon">razred</span>
       <select name="ucenik" class="selectUcenik">
     
      </select>
    </div>
 <div class="input-group statusRoditelj">
      <span class="input-group-addon">učenik</span>
       <select name="roditelj" class="selectRoditelj">
     
</select>
    </div>
    <div class="row">
      <input type="submit" name="registracija" value="Registracija" class="btn btn-default" />
  </div>
  </div>
	</form>
    <p>
    <?php if(isset($_GET['porukaPogreske'])) {
      echo "Neuspješna registracija.";
      } ?>
    <?php if(isset($_GET['uspjesnaRegistracija'])) {
      echo "Uspješno ste registrirani.";
      } ?>
  </p>
</div>
</div>
<?php include "footer.php"; ?>
</body>
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
          $(".selectUcenik").append($('<option selected value=' + item.sifra + '  id=' + item.sifra + '>' + item.razred + item.odjeljenje + '</option>'));
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
          $(".selectRoditelj").append($('<option selected value=' + item.sifra + ' id=' + item.sifra + '>' + item.ime + " " + item.prezime + '</option>'));
        });
        }
      });
  
  }
        
      });

</script>
</html>