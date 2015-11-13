<?php include "head.php"; 
if(isset($_POST['registracija'])){
$izraz=$veza->prepare("insert into korisnik (ime, prezime, kor_ime, lozinka, mjesto) values (:ime, :prezime, :kor_ime, :lozinka, :mjesto)");
$izraz->bindValue(":ime", $_POST['ime']); 
$izraz->bindValue(":prezime", $_POST['prezime']);
$izraz->bindValue(":kor_ime", $_POST['kor_ime']);
$izraz->bindValue(":lozinka", md5($_POST['lozinka']));
$izraz->bindValue(":mjesto", $_POST['mjesto']);
$izraz->execute();
header ("location: registracija.php?true");
}
if(isset($_POST['registracijaSalona'])){
$izraz=$veza->prepare("insert into frizerski_salon (naziv, grad, adresa, kor_ime, lozinka) values (:naziv, :grad, :adresa, :kor_ime, :lozinka)");
$izraz->bindValue(":naziv", $_POST['naziv']); 
$izraz->bindValue(":grad", $_POST['grad']);
$izraz->bindValue(":adresa", $_POST['adresa']);
$izraz->bindValue(":kor_ime", $_POST['kor_ime']);
$izraz->bindValue(":lozinka", md5($_POST['lozinka']));
$izraz->execute();
header ("location: registracija.php?true");
}
?>
    <body class="bodyIndex">
        <div class="container">
            <div class="rowIndex">
                <div class="col-md-6 divForma">
                    <form class="form-horizontal indexForma">
                        <fieldset>
                            <h2 class="indexH2">Registracija frizerskog salona</h2>
                            <div class="form-group">
                                <input type="text" class="form-control" id="naziv" placeholder="ime salona">                        
                            </div>
                            <div class="form-group">
    <select name="grad">
                   <?php
$izraz=$veza->prepare("select * from mjesto");
$izraz->execute();
$mjesta=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($mjesta as $mjesto): 
  ?>
<option value="<?php echo $mjesto->sifra; ?>" id="<?php echo $mjesto->sifra; ?>"><?php echo $mjesto->naziv; ?></option>
<?php endforeach; ?>
             </select>                       
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="adresa" placeholder="adresa">                        
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" name="kor_ime" placeholder="korisničko ime">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="lozinka" placeholder="lozinka">                        
                            </div>
<<<<<<< HEAD
                            <a href="#" id="prijava" class="btn btn-default btnKorisnik">Prijavi se</a>         
=======
                            <input type="submit" name="registracija" class="btn btn-default" value="Registriraj salon" />  
         
>>>>>>> origin/master
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-6 divRegKorisnika">
                    <form class="form-horizontal regKorisnika">
                        <fieldset>
                            <h2>Registracija korisnika</h2>
                            <div class="form-group">                                
                                <input type="text" class="form-control" name="ime" placeholder="ime">
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" name="prezime" placeholder="prezime">
                            </div>
                            <div class="form-group">                                
    <select name="grad">
                   <?php
$izraz=$veza->prepare("select * from mjesto");
$izraz->execute();
$mjesta=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($mjesta as $mjesto): 
  ?>
<option value="<?php echo $mjesto->sifra; ?>" id="<?php echo $mjesto->sifra; ?>"><?php echo $mjesto->naziv; ?></option>
<?php endforeach; ?>
             </select>
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" name="kor_ime" placeholder="korisničko ime">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="lozinka" placeholder="lozinka">                        
                            </div>
<<<<<<< HEAD
                            <a href="#" id="prijava" class="btn btn-default btnKorisnik">Registriraj se</a>  
=======
                             <input type="submit" name="registracija" class="btn btn-default" value="Registriraj se" />  
>>>>>>> origin/master
                            <?php include "facebook_login_graph_api/facebookRegistracija.php"; ?>
<p><a href="https://www.facebook.com/dialog/oauth?client_id=<?php echo $config['App_ID']; ?>&redirect_uri=<?php echo $config['callback_url']; ?>&scope=email">Sign up using Facebook</a><p>
 <p>
<p><?php if(isset($_GET['fbTrue']))
{
  echo "Uspješno ste se registrirali.";
  } ?></p>       
                        </fieldset>
                    </form>                    
                </div>


<?php include "scripts.php" ?>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>
    </body>
</html>
