<?php
include_once 'konfiguracija.php';
if(isset($_GET["term"])){
$uvjet="%" . $_GET["term"] . "%";
}
else {
	$uvjet="%";
}
$skola = $_GET['skola'];
$izraz=$veza->prepare("select ime, prezime, sifra from korisnik where status=2 and skola=$skola and ime like :uvjet or status=2 and skola=$skola and prezime like :uvjet ");
	  //$izraz->bindValue(":skola", $_GET['skola']);
					$izraz->execute(array("uvjet"=>"%" . $uvjet . "%"));
					$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
					
					echo json_encode($rezultati);