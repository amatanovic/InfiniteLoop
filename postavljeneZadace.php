<?php include "header_navigation.php"; ?>
        <div class="col-md-8">
        <div class="col-md-6 popisZadaca">
        <?php
          $izraz=$veza->prepare("select a.ime, a.prezime, a.avatar, b.* from korisnik a inner join uploadzadaca b on a.sifra=b.korisnik where b.zadaca=1");
          $izraz->execute();
          $korisnikoveZadace=$izraz->fetchALL(PDO::FETCH_OBJ);
          foreach ($korisnikoveZadace as $korisnikovaZadaca): ?>
          <div class="row">
          <div class="panel panel-default">
          <div class="panel-body">
          <p>
          <img src="<?php echo $korisnikovaZadaca->avatar; ?>" style="width:100px" /> <?php echo $korisnikovaZadaca->ime . "" . $korisnikovaZadaca->prezime; ?> 
          <?php echo "<a href='" . $korisnikovaZadaca->putanja . "'>" . $korisnikovaZadaca->putanja ."</a>"?>
          </p>
          <p>
              <span class="glyphicon glyphicon-heart">
              <?php
            $uploadzadacaID = $korisnikovaZadaca->sifra;
            $liked = false;
            $izraz=$veza->prepare("select COUNT(liked) as numberLikes from likezadaca where uploadzadaca=$uploadzadacaID");
            $izraz->execute();
            $likeovi=$izraz->fetch(PDO::FETCH_OBJ);
            $izraz=$veza->prepare("select * from likezadaca where uploadzadaca=$uploadzadacaID");
            $izraz->execute();
            $likes=$izraz->fetchALL(PDO::FETCH_OBJ);
            foreach ($likes as $like) {
              if ($like->korisnik == $_SESSION['autoriziran']->sifra) {
                $liked = true;
              }
            }
            if ($liked == true) {
            echo "<span class='zadaca statusLiked' id='liked'>" . $likeovi->numberLikes . "</span>";
           }
            else {
              echo "<span class='zadaca statusNotLiked' id='" . $uploadzadacaID . "'>" . $likeovi->numberLikes . "</span>";
            }
            ?>
            </span>
            <span class="komentari" id="<?php echo $uploadzadacaID; ?>"> Komentari </span>
          </p>
          </div>
          </div>
          <div class="izlistaniKomentari" id="izlistani_<?php echo $uploadzadacaID; ?>">

           </div>
              <div class="form-group input-group">
                <span class="input-group-addon"> <img src="<?php echo $_SESSION['autoriziran']->avatar; ?>" style="width:100px" /></span>
                <input type="hidden" id="korisnik_<?php echo $uploadzadacaID; ?>" value="<?php echo $_SESSION['autoriziran']->sifra ?>">
                <textarea name="text" cols="50" rows="1" minlength="1" maxlength="255" class="form-control" id="komentar_<?php echo $uploadzadacaID; ?>" placeholder="Napiši komentar"></textarea>
                <button class="btn btn-default komentiraj" id="<?php echo $uploadzadacaID; ?>">Komentiraj</button>
              </div>
          </div>
        <?php endforeach; ?>
      </div>
       <div class="col-md-2">
          <?php
          $vrijeme = date("Y-m-d");
          $izraz=$veza->prepare("select * from zadaca");
          $izraz->execute();
          $zadace=$izraz->fetchALL(PDO::FETCH_OBJ);
          $i = 0;
          foreach ($zadace as $zadaca):
          if ($zadaca->pocetak < $vrijeme):
          if ($i == 0) {
         echo "<p class='naziviZadaca oznacenaZadaca' id='" . $zadaca->sifra . "'>" . $zadaca->naziv . "</p>";
        }
        else if ($i != 0) {
          echo "<p class='naziviZadaca' id='" . $zadaca->sifra . "'>" . $zadaca->naziv . "</p>";
        }
        $i++;
        endif;
        endforeach;
        ?>
      </div>

      </div>
<?php include "korisnici.php"; ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(function(){
    $(".naziviZadaca").click(function(){
    $(".popisZadaca").html("");
    $(".naziviZadaca").removeClass("oznacenaZadaca");
    $(this).addClass("oznacenaZadaca");
     $.ajax({
        type: "POST",
        url: "popisPostavljenihZadaca.php",
        data: "zadaca=" + $(this).attr('id'),
        success: function(msg){
        podaci=$.parseJSON(msg);
        if (podaci.length == 0) {
        $(".popisZadaca").append($('<p>Trenutno nitko nema postavljenu ovu zadaću!</p>'));
        }
        $.each(podaci, function(i, item){
          $(".popisZadaca").append($('<p><img src="' + item.avatar + '" style="width:100px" />' + item.ime + ' ' + item.prezime + ' <a href="' + item.putanja + '">' + item.putanja + '</a></p>'));
          });

        }
      });
      });

        });

      $(".zadaca").click(function(){
       if ($(this).attr("id") !== "liked") {
       var ovajUpload = $(this);
       var uploadZadaca = ovajUpload.attr("id");
       var korisnik = <?php echo $_SESSION['autoriziran']->sifra ?>;
        $.ajax({
        type: "POST",
        url: "likeZadaca.php",
        data: "uploadzadaca=" + uploadZadaca + "&korisnik=" + korisnik,
        success: function(msg){
            brojLikeova=$.parseJSON(msg);
            ovajUpload.removeClass("statusNotLiked").addClass("statusLiked");
            ovajUpload.attr("id", "liked");
            ovajUpload.html(brojLikeova.numberLikes);

        }
      });
       }
        return false;
      });

      $(".komentari").click(function(){
        $(".izlistaniKomentari").html("");
       var ovajUpload = $(this);
       var uploadzadaca = ovajUpload.attr("id");
        $.ajax({
        type: "POST",
        url: "izlistajKomentareUpload.php",
        data: "uploadzadaca=" + uploadzadaca,
        success: function(msg){
        podaci=$.parseJSON(msg);
        $.each(podaci, function(i, item){
        $("#izlistani_" + uploadzadaca).append($('<p><img src="' + item.avatar + '" style="width:25px" />' + item.ime + ' ' + item.prezime + '</p><p>' + item.naziv + '</p>'));
        });

        }
      });
        return false;
      });

      $(".komentiraj").click(function(){
       var upload = $(this).attr("id");
       var korisnik = $("#korisnik_" + upload).val();
       var naziv = $("#komentar_" + upload).val();
        $.ajax({
        type: "POST",
        url: "komentirajUpload.php",
        data: "uploadzadaca=" + upload + "&korisnik=" + korisnik + "&naziv=" + naziv,
        success: function(msg){
        podaci=$.parseJSON(msg);
        $("#izlistani_" + upload).html("");
        $("#komentar_" + upload).val("");
        $.each(podaci, function(i, item){
        $("#izlistani_" + upload).append($('<p><img src="' + item.avatar + '" style="width:25px" />' + item.ime + ' ' + item.prezime + '</p><p>' + item.naziv + '</p>'));
        });

        }
      });
        return false;
      });

    </script>
  </body>
</html>