<?php include "head.php";
session_start();
if(!isset($_SESSION['autoriziran'])){
  header("location: odjava.php");  
}
?>
  <body class="bodyNadzorna">
    <div class="container-fluid">
      <header>
        <h2>OMS <?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?></h2>
      </header>
      <div class="row">
        <div class="col-md-2">
          <!--<div id="sidebar-wrapper">-->
            <ul class="sidebar-nav">
              <li>
                <a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>Zadaće <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Postavljene zadaće</a></li>
                  <li><a href="#">Nova zadaća</a></li>
                </ul>
              </li>
              <li>
                <a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Moj profil</a>
              </li>
              <li>
                <a href="<?php echo $putanja; ?>odjava.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>Odjava</a>
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
        <div class="col-md-2">
          <?php
$izraz=$veza->prepare("select * from korisnik");
$izraz->execute();
$korisnici=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($korisnici as $korisnik): ?>
<p>
<img src="<?php echo $korisnik->avatar; ?>" style="width:20%" />
</p>
<?php endforeach; ?>
</div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>