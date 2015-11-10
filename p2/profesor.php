<?php
include "head.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body class="bodyRavnatelj">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <header class="headerRavnatelj">
          <h2>Dobrodošli</h2>
          <h2 class="imeProfesora">Profesor Profesorić</h2><input class=
          "btn btn-default pull-right ravnateljBtn" name="registracija" type=
          "submit" value="Odjavi se">
        </header>
      </div>
    </div>
    <div class="row profesor">
      <div class="col-md-12">
        <h1 style="padding-bottom: 60px; color: black">Profesor Profesorić</h1>
        <p>Ukoliko želite poslati obavijest o nelaćenim uplatnicama, unesite
        obavijest i pritisnite 'Pošalji'.</p>
        <textarea class="form-control obavijest" cols="50" id="obavijest"
        maxlength="255" name="obavijest" placeholder="Unesite obavijest" rows=
        "8">
</textarea> <input class="btn btn-default pull-right obavijestBtn"
        name="posaljiObavijest" type="submit" value="Pošalji">
      </div>
    </div><?php include "footer.php"; ?>
  </div>
</body>
</html>