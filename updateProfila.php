<form method="POST" action="" enctype="multipart/form-data">
  <input type="hidden" name="sifra" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
  <input class="odaberi-avatar " style="margin-top:1em;width:72%;margin-left: 16%;border: none;" type="file" name="slika" id="slika" accept="image/*" />
    <input type="submit" value="Promjeni avatar" name="promjenaAvatara" />
  </form>
</p>
<p>
	<form method="POST" action="">
		<input type="hidden" name="sifra" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
     	<div class="input-group">
  		<span class="input-group-addon">Ime</span>
  		<input type="text" name="ime" class="form-control" value="<?php echo $korisnik->ime;?>" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon">Prezime</span>
  		<input type="text" name="prezime" class="form-control" value="<?php echo $korisnik->prezime;?>" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon">Lozinka</span>
  		<input type="password" name="lozinka" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon">Ponovi lozinku</span>
  		<input type="password" name="lozinka2" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<input type="submit" value="Promjeni" name="promjeni" /><br />
	</form>