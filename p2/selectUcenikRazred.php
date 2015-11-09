<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select a.razred, b.odjeljenje, d.sifra from razred a inner join skolarazred c on a.sifra=c.razred inner join odjeljenje b on b.sifra=c.odjeljenje inner join profesorrazred d on c.sifra=d.skolarazred where c.skola=:skola and d.profesor is not null");
$izraz->bindValue(":skola", $_POST['skola']); 
$izraz->execute();
$razred=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($razred);