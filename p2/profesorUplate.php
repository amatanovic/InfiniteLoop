<?php
include "head.php"; ?>

<body class="bodyRavnatelj">
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-md-12">
  <header class="headerRavnatelj">
  <h2>Dobrodošli</h2>      
  <h2 class="imeRavnatelja">Profesor Profesorić</h2>
  <input type="submit" name="registracija" value="Odjavi se" class="btn btn-default pull-right ravnateljBtn" />           
  </header>
</div>
</div>
<div class="row profesorUplate">
<div class="col-md-6">
  <h3 style="padding-bottom: 20px">Proknjižene uplate</h3>
  <div class="thumbnail">
    <h4>Andrea Mihaljević</h4>
    <img src="slike/uplatnica.gif" alt="Uplatnica">
  </div>
</div>
<div class="col-md-6">
  <h3 style="padding-bottom: 20px">Neproknjižene uplate</h3>
  <div class="thumbnail">
    <h4>Manuela Mikulecki (uplaćeno)</h4>
    <img src="slike/uplatnica.gif" alt="Uplatnica">
    <div class="checkbox pull-right">
    <label>
      <input type="checkbox"> Proknjiženo
    </label>
  </div>
  </div>
</div>
</div>
<?php include "footer.php"; ?>
</body>