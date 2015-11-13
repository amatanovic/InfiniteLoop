<html>

    <head>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Include roboto.css to use the Roboto web font, material.css to include the theme and ripples.css to style the ripple effect -->
        <link href="css/roboto.css" rel="stylesheet">
        <link href="css/material.min.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    </head>

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
                    <p class="indexP">Ukoliko nemate račun, <a href="">registrirajte se</a></p>
                </div>
            </div>
        </div>

        <!-- Your site ends -->

        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

        <script src="js/ripples.min.js"></script>
        <script src="js/material.min.js"></script>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

    </body>

</html>
