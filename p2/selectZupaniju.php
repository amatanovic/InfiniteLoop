<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select zupanija from grad where sifra=:sifra");
$izraz->bindValue(":sifra", $_POST['grad']); 
$izraz->execute();
$zupanija=$izraz->fetch(PDO::FETCH_OBJ);
echo json_encode($zupanija);