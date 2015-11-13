﻿<?php include "head.php"; ?>
    <body class="bodyIndex">
        <div class="container">
            <div class="rowIndex">
                <div class="col-md-6">

                </div>
                <div class="col-md-6 divForma">
                    <form class="form-horizontal indexForma">
                        <fieldset>
                            <h2 class="indexH2">Prijava</h2>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="salon"> salon
                                </label>
                                <label>
                                    <input type="checkbox" value="korisnik"> korisnik
                                </label>
                            </div>
                            <div class="form-group">                                
                                <input type="text" class="form-control" id="korisnickoIme" placeholder="korisničko ime">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="lozinka" placeholder="lozinka">                        
                            </div>
                            <a href="#" id="prijava" class="btn btn-default">Prijavi se</a>         
                        </fieldset>
                    </form>
                    <p class="indexP">Prijavite se putem facebook-a</p>
                    <p class="indexP">Ukoliko nemate račun, <a href="registracija.php">registrirajte se</a></p>
                </div>
            </div>
        </div>

    <?php include "scripts.php"; ?>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

    </body>

</html>
