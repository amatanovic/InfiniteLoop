<?php
include "head.php"; ?>

<body class="bodyRavnatelj">
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-md-12">
  <header class="headerRavnatelj">
  <h2>Dobrodošli</h2>      
  <h2 class="imeRoditelja">Mama Vilček</h2>
  <input type="submit" name="registracija" value="Odjavi se" class="btn btn-default pull-right ravnateljBtn" />           
  </header>
</div>
</div>
<div class="row profesorUplate">
	<div class="col-md-12">
		<form method="POST" action="" enctype="multipart/form-data">
  <div class="form-group input-group">
  <input type="hidden" name="sifra" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
  <input class="uplatnica" style="margin-top:1em;margin-left: 16%;border: none;" type="file" name="slika" id="slika" accept="image/*"/>
    <button type="submit" value="Objavi" name="uplatnica" class="btn btn-default promjena">Objavi</button>
  </div>
  </form>
  <div class="thumbnail roditelj">
    <img src="slike/uplatnica.gif" alt="Uplatnica">
  </div>
  <p>Uspješno ste pohranili sliku uplatnice za Tenu Vilček. Molimo Vas pričekajte obavijest o proknjiženju.</p>
</div>
</div>
<?php include "footer.php"; ?>
</body>