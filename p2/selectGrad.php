<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select * from grad where zupanija=:zupanija");
$izraz->bindValue(":zupanija", $_POST['zupanija']); 
$izraz->execute();
$gradovi=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($gradovi);