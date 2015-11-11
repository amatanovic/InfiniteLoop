<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("update uplatakorisnikprofesorrazred set proknjizeno=1 where sifra=:sifra");
$izraz->bindValue(":sifra", $_POST['sifra']); 
$izraz->execute();
echo "OK";