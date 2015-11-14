<?php include "head.php"; 
if (isset($_SESSION['autoriziran']->salon) != null || !isset($_SESSION['autoriziran'])) {
  header("location: odjava.php");
}
?>
    <body class="bodyIndex">
        <div class="container">
           <p class="indexh2"> <?php echo $_SESSION['autoriziran']->ime; ?> <a href="">Arhiva slika</a>
           <a href="">Kalendar</a><a href="odjava.php">Odjava</a> </p>
            <div class="rowIndex">
           <?php  $izraz=$veza->prepare("select * from slike where korisnik=:sifra");
$izraz->bindValue(":sifra", $_SESSION['autoriziran']->sifra);
$izraz->execute();
$slike=$izraz->fetchALL(PDO::FETCH_OBJ);     
   foreach($slike as $slika):          
?>
<img src="<?php echo $slika->putanja; ?>" />
<?php endforeach; ?>
    <?php include "scripts.php"; ?>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
   


        </script>

    </body>

</html>
