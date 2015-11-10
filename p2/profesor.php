<?php
include "head.php"; ?>

<body class="bodyRavnatelj">
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-md-12">
  <header class="headerRavnatelj">
  <h2>Dobrodošli</h2>      
  <h2 class="imeProfesora">Profesor Profesorić</h2>
  <input type="submit" name="registracija" value="Odjavi se" class="btn btn-default pull-right ravnateljBtn" />           
  </header>
</div>
</div>
<div class="row profesor">
	<div class="col-md-12">
		<h1 style="padding-bottom: 60px; color: black">Profesor Profesorić</h1>
    <p>Ukoliko želite poslati obavijest o nelaćenim uplatnicama, unesite obavijest i pritisnite 'Pošalji'.</p>
    <textarea name="obavijest" cols="50" rows="8" maxlength="255" class="form-control obavijest" id="obavijest" placeholder="Unesite obavijest"></textarea>
    <input type="submit" name="posaljiObavijest" value="Pošalji" class="btn btn-default pull-right obavijestBtn" />

</div>
</div>
<?php include "footer.php"; ?>
</body>