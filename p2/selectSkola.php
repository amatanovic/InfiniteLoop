<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select a.naziv from skola a inner join grad b on a.grad=b.sifra where b.zupanija=:zupanija");
$izraz->bindValue(":zupanija", $_POST['zupanija']); 
$izraz->execute();
$skole=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($skole);