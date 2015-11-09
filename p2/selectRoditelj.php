<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select a.ime, a.prezime from ucenikroditelj b inner join korisnik a on b.ucenik=a.sifra inner join korisnikprofesorrazred c on b.sifra=c.ucenikroditelj inner join profesorrazred d on c.sifra=d.profesor inner join skolarazred e on e.sifra=d.skolarazred where e.skola=:skola and b.roditelj is null");
$izraz->bindValue(":skola", $_POST['skola']); 
$izraz->execute();
$ucenik=$izraz->fetchALL(PDO::FETCH_OBJ);
echo json_encode($ucenik);