<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("update cijena set iznos=:cijena where skola=:skola");
$izraz->bindValue(":cijena", $_POST['cijena']); 
$izraz->bindValue(":skola", $_POST['skola']); 
$izraz->execute();
echo "OK";