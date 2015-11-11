<?php
include "head.php"; 
if (!isset($_SESSION['autoriziran']->status) == 2) {
  header("location: odjava.php");
}
?>
<body class="bodyRavnatelj">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <header class="headerRavnatelj">
          <h2>Dobrodošli</h2>
          <h2 class="imeProfesora" style="margin-right:200px"><?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?></h2>
          <a class="btn btn-default pull-right ravnateljBtn" href="odjava.php">Odjava</a>
          <a class="btn btn-default pull-right ravnateljBtn povratak" href="profesorUplate.php">Povratak</a>
        </header>
      </div>
    </div>
    <div class="row profesor">
      <div class="col-md-12">
        <p style="padding-top:5%">Ukoliko želite poslati obavijest o neplaćenim uplatnicama, unesite
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