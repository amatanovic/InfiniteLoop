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
    <div class="row profesorUplate">
      <div class="col-md-6">
        <h3 style="padding-bottom: 20px">Proknjižene uplate</h3>
        <div class="thumbnail">
        <h4>Andrea Mihaljević</h4><img alt="Uplatnica" src=
        "slike/uplatnica.gif"></div>
      </div>
      <div class="col-md-6">
        <h3 style="padding-bottom: 20px">Neproknjižene uplate</h3>
        <div class="thumbnail">
          <h4>Manuela Mikulecki (uplaćeno)</h4><img alt="Uplatnica" src=
          "slike/uplatnica.gif">
          <div class="checkbox pull-right">
            <label><input type="checkbox"> Proknjiženo</label>
          </div>
        </div>
      </div>
    </div><?php include "footer.php"; ?>
  </div>
</body>
</html>