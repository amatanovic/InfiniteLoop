<?php include "header_navigation.php"; ?>
        <div class="col-md-8">
        <div class="col-md-6">
        

      </div>
       <div class="col-md-2">
          <?php
          $vrijeme = date("Y-m-d");
          $izraz=$veza->prepare("select * from zadaca");
          $izraz->execute();
          $zadace=$izraz->fetchALL(PDO::FETCH_OBJ);
          foreach ($zadace as $zadaca):
          if ($zadaca->pocetak < $vrijeme):
          ?>
        <p>
        <?php echo $zadaca->naziv; ?>
        </p>
        <?php 
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


    </script>
  </body>
</html>