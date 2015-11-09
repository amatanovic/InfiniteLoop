<?php
include "head.php";

?>
<body class="bodyIndex">
  <div class="container-fluid">
  <header>
      <div class="trakaIndex">
      Profesor <?php echo $_SESSION['autoriziran']->ime . " " . $_SESSION['autoriziran']->prezime; ?>
      <a href="odjava.php" class="btn btn-default">Odjava</a>
</div>
          
  </header>
  <div class="col-md-12">

</div>
</div>
<?php include "footer.php"; ?>
</body>
<script>
    

</script>
</html>