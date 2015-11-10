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
          <h2 class="imeRoditelja">Mama Vilček</h2><input class=
          "btn btn-default pull-right ravnateljBtn" name="registracija" type=
          "submit" value="Odjavi se">
        </header>
      </div>
    </div>
    <div class="row profesorUplate">
      <div class="col-md-12">
        <form action="" enctype="multipart/form-data" method="post">
          <div class="form-group input-group">
            <input name="sifra" type="hidden" value=
            "<?php echo $_SESSION['autoriziran']->sifra ?>"> <input accept=
            "image/*" class="uplatnica" id="slika" name="slika" style=
            "margin-top:1em;margin-left: 16%;border: none;" type="file">
            <button class="btn btn-default promjena" name="uplatnica" type=
            "submit" value="Objavi">Objavi</button>
          </div>
        </form>
        <div class="thumbnail roditelj"><img alt="Uplatnica" src=
        "slike/uplatnica.gif"></div>
        <p>Uspješno ste pohranili sliku uplatnice za Tenu Vilček. Molimo Vas
        pričekajte obavijest o proknjiženju.</p>
      </div>
    </div><?php include "footer.php"; ?>
  </div>
</body>
</html>