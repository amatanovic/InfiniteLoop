  <div class="col-md-2">
          <?php
$izraz=$veza->prepare("select * from korisnik");
$izraz->execute();
$korisnici=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($korisnici as $korisnik): 
if ($korisnik->admin != 1 and $korisnik->sifra != $_SESSION['autoriziran']->sifra):
?>
<p>
<img src="<?php echo $korisnik->avatar; ?>" style="width:20%" />
</p>
<?php 
endif;
endforeach; ?>
</div>
      </div>
    </div>