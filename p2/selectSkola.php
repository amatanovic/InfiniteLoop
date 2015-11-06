<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select * from skola where grad=:grad");
$izraz->bindValue(":grad", $_POST['grad']); 
$izraz->execute();
$skole=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($skole);