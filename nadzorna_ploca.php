<!DOCTYPE html>
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
        <div class="col-md-2">
          <!--<div id="sidebar-wrapper">-->
            <ul class="sidebar-nav">
              <li>
                <a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a>
              </li>
              <li>
                <a href="#"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>Zadaće</a>
              </li>
              <li>
                <a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Moj profil</a>
              </li>
              <li>
                <a href="#"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>Odjava</a>
              </li>
            </ul>
          <!--</div>-->
        </div>
        <div class="col-md-8">
          <form>
            <div class="form-group">
              <textarea name="text" cols="50" rows="2" maxlength="255" class="form-control" id="username" placeholder="Na umu mi je..."></textarea>
              <button type="submit" class="btn btn-default">Objavi</button>
            </div>
          </form>
          <div class="row">
            <!-- 
            <h3>KOMENTARI:</h3>

              <?php foreach($komentari as $komentar):
              echo $komentar->operater; ?>
            -->
            <div class="panel panel-default">
              <div class="panel-body">

                <!-- <?php echo $komentar->tekst; ?> -->

              </div>
            </div>
            <form>
              <div class="form-group">
                <textarea name="text" cols="50" rows="1" maxlength="255" class="form-control" id="username" placeholder="Napiši komentar"></textarea>
                <button type="submit" class="btn btn-default">Komentiraj</button>
              </div>
            </form>
    
            <!-- <?php endforeach; ?> -->

          </div>
        </div>
        <div class="col-md-2">.col-md-4</div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>