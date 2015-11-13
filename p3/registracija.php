<?php include "head.php"; ?>

    <body class="bodyIndex">
        <div class="container">
            <div class="rowIndex">
                <div class="col-md-6 divForma">
                    <form class="form-horizontal indexForma">
                        <fieldset>
                            <h2 class="indexH2">Registracija frizerskog salona</h2>
                            <div class="form-group">
                                <input type="password" class="form-control" id="imeSalona" placeholder="ime salona">                        
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="grad" placeholder="grad">                        
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="adresa" placeholder="adresa">                        
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="korisnickoIme" placeholder="korisničko ime">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="lozinka" placeholder="lozinka">                        
                            </div>
                            <a href="#" id="prijava" class="btn btn-default btnKorisnik">Prijavi se</a>         
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-6 divRegKorisnika">
                    <form class="form-horizontal regKorisnika">
                        <fieldset>
                            <h2>Registracija korisnika</h2>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="ime" placeholder="ime">
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="prezime" placeholder="prezime">
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="grad" placeholder="grad">
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="korisnickoIme" placeholder="korisničko ime">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="lozinka" placeholder="lozinka">                        
                            </div>
                            <a href="#" id="prijava" class="btn btn-default btnKorisnik">Registriraj se</a>  
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
