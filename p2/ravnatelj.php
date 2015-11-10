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
          <h2 class="imeRavnatelja">Ravnatelj Ravnatović</h2><input class=
          "btn btn-default pull-right ravnateljBtn" name="registracija" type=
          "submit" value="Odjavi se">
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
            <input aria-describedby="basic-addon1" class="form-control" name=
            "cijena" type="text">
          </div>
        </div>
        <table class="table">
          <tr>
            <th>PROFESOR</th>
            <th>RAZRED</th>
            <th>ODJELJENJE</th>
          </tr>
          <tr>
            <td>Jill</td>
            <td>Smith</td>
            <td>50</td>
          </tr>
          <tr>
            <td>Eve</td>
            <td>Jackson</td>
            <td>94</td>
          </tr>
          <tr>
            <td>John</td>
            <td>Doe</td>
            <td>80</td>
          </tr>
        </table><input class="btn btn-default pull-right" name="promjeni" type=
        "submit" value="Pohrani promjene">
      </div>
    </div>
    <div class="row"></div>
  </div><?php include "footer.php"; ?>
</body>
</html>