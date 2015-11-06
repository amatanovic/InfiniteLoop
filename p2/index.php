<?php include "head.php"; ?>
<body>
<form method="POST" action="">
    <div class="form-group input-group">
		<input type="hidden" name="sifra" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
     	<div class="input-group">
  		<span class="input-group-addon profil">IME</span>
  		<input type="text" name="ime" class="form-control" value="<?php echo $korisnik->ime;?>" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon profil">PREZIME</span>
  		<input type="text" name="prezime" class="form-control" value="<?php echo $korisnik->prezime;?>" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon profil">LOZINKA</span>
  		<input type="password" name="lozinka" class="form-control" aria-describedby="basic-addon1" />
		</div>
		<div class="input-group">
  		<span class="input-group-addon profil"></span>
  		<input type="password" name="lozinka2" class="form-control" aria-describedby="basic-addon1" />
		</div>
    <div class="row">
      <button type="submit" value="Promjeni" name="promjeni" class="btn btn-default">Odustani</button>
		<button type="submit" value="Promjeni" name="promjeni" class="btn btn-default">Promjeni</button>
  </div>
  </div>
	</form>

</body>
<?php include "footer.php"; ?>
<script>

</script>
</html>