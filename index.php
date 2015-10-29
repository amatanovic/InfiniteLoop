<!DOCTYPE html>
<?php include "konfiguracija.php"; ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>OMS Društvena Mreža</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6" id="logo">
          <h1 style="margin-top:150px;">OMS</h1>
          <h1>društvena<br>mreža</h1>
        </div>
        <div class="col-md-6" id="forma">
          <form>
            <h2>Prijava</h2>
            <div class="form-group">
              <input type="text" class="form-control" id="korisnickoIme" placeholder="Korisničko ime">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="lozinka" placeholder="Lozinka">
            </div>
            <button type="submit" class="btn btn-default">Prijavi se</button>
          </form>
      </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>