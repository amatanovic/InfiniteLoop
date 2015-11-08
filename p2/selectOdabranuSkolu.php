<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select grad from skola where sifra=:sifra");
$izraz->bindValue(":sifra", $_POST['skola']); 
$izraz->execute();
$grad=$izraz->fetch(PDO::FETCH_OBJ);
echo json_encode($grad);