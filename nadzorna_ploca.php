<?php 
include "head.php";
session_start();
if(!isset($_SESSION['autoriziran'])){
  header("location: odjava.php");  
}
if(isset($_POST['objava'])){
$izraz = $veza->prepare("insert into status (tekst, korisnik, vrijeme) values (:status, :korisnik, now())");
$izraz->bindValue(':korisnik', $_POST['korisnik']);
$izraz->bindValue(':status', $_POST['status']);
$izraz->execute();
header("location: nadzorna_ploca.php");
}
?>

  <body class="bodyNadzorna">
    <div class="container-fluid">
      <header>
        <h2>OMS</h2>
        <h3 class="nadzornaH3"><?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?></h3>
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
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="from-group input-group">
               <span class="input-group-addon"> <img src="<?php echo $_SESSION['autoriziran']->avatar; ?>" style="width:100px" /></span>
               <input type="hidden" name="korisnik" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
              <textarea name="status" cols="50" rows="2" maxlength="255" class="form-control" id="username" placeholder="Na umu mi je..."></textarea>
              <button type="submit" class="btn btn-default pull-right nadzornaBtn" name="objava">Objavi</button>
            </div>
          </form>
                 
            <?php
$izraz=$veza->prepare("select a.*, b.ime, b.prezime, b.sifra as korisnik_sifra from status a inner join korisnik b on a.korisnik=b.sifra order by a.vrijeme DESC");
$izraz->execute();
$statusi=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($statusi as $status): 
?>
<div class="row">
<?php echo $status->ime . " " . $status->prezime; ?>
             
            <div class="panel panel-default">
              <div class="panel-body">
              <p>
              <?php echo $status->tekst; ?>
              </p>
              <p>
            <span class="glyphicon glyphicon-heart">
              <?php
            $statusID = $status->sifra;
            $liked = false;
            $izraz=$veza->prepare("select COUNT(liked) as numberLikes from likestatus where status=$statusID");
            $izraz->execute();
            $likeovi=$izraz->fetch(PDO::FETCH_OBJ);
            $izraz=$veza->prepare("select * from likestatus where status=$statusID");
            $izraz->execute();
            $likes=$izraz->fetchALL(PDO::FETCH_OBJ);
            foreach ($likes as $like) {
              if ($like->korisnik == $_SESSION['autoriziran']->sifra) {
                $liked = true;
              }
            }
            if ($liked == true) {
            echo "<span class='status statusLiked' id='liked'>" . $likeovi->numberLikes . "</span>";
            }
            else {
              echo "<span class='status statusNotLiked' id='" . $statusID . "'>" . $likeovi->numberLikes . "</span>";
            }
            ?>
            </span>
           <span class="komentari" id="<?php echo $statusID; ?>"> Komentari </span>
             </p>
              </div>
            </div>
           <div class="izlistaniKomentari" id="izlistani_<?php echo $statusID; ?>">

           </div>
              <div class="form-group input-group">
                <span class="input-group-addon"> <img src="<?php echo $_SESSION['autoriziran']->avatar; ?>" style="width:100px" /></span>
                <input type="hidden" id="korisnik" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
                <input type="hidden" id="status" value="<?php echo $statusID; ?>">
                <textarea name="text" cols="50" rows="1" minlength="1" maxlength="255" class="form-control" id="komentar" placeholder="Napiši komentar"></textarea>
                <button class="btn btn-default" id="komentiraj">Komentiraj</button>
              </div>
          </div>
<?php endforeach; ?>
        </div>
        <div class="col-md-2">
          <?php
$izraz=$veza->prepare("select * from korisnik");
$izraz->execute();
$korisnici=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($korisnici as $korisnik): 
if ($korisnik->admin != 1):
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(".status").click(function(){
       if ($(this).attr("id") !== "liked") {
       var ovajStatus = $(this);
       var status = ovajStatus.attr("id");
       var korisnik = <?php echo $_SESSION['autoriziran']->sifra ?>;
        $.ajax({
        type: "POST",
        url: "like.php",
        data: "status=" + status + "&korisnik=" + korisnik,
        success: function(msg){
            brojLikeova=$.parseJSON(msg);
            ovajStatus.removeClass("statusNotLiked").addClass("statusLiked");
            ovajStatus.attr("id", "liked");
            ovajStatus.html(brojLikeova.numberLikes);

        }
      });
       }
        return false;
      });

       $(".komentari").click(function(){
       var ovajStatus = $(this);
       var status = ovajStatus.attr("id");
        $.ajax({
        type: "POST",
        url: "izlistajKomentare.php",
        data: "status=" + status,
        success: function(msg){
        podaci=$.parseJSON(msg);
        $.each(podaci, function(i, item){
        $("#izlistani_" + status).append($('<p><img src="' + item.avatar + '" style="width:25px" />' + item.ime + ' ' + item.prezime + '</p><p>' + item.naziv + '</p>'));
        });

        }
      });
        return false;
      });

       $("#komentiraj").click(function(){
       var status = $("#status").val();
       var korisnik = $("#korisnik").val();
       var naziv = $("#komentar").val();
        $.ajax({
        type: "POST",
        url: "komentiraj.php",
        data: "status=" + status + "&korisnik=" + korisnik + "&naziv=" + naziv,
        success: function(msg){
        podaci=$.parseJSON(msg);
        $("#izlistani_" + status).html("");
        $("#komentar").val("");
        $.each(podaci, function(i, item){
        $("#izlistani_" + status).append($('<p><img src="' + item.avatar + '" style="width:25px" />' + item.ime + ' ' + item.prezime + '</p><p>' + item.naziv + '</p>'));
        });

        }
      });
        return false;
      });

    </script>
  </body>
</html>