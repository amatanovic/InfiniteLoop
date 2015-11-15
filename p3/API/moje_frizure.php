<?php
include_once '../konfiguracija.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set("Europe/Zagreb");
$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$sifra = $request->sifra;   
$izraz=$veza->prepare("select putanja from slike where korisnik=:korisnik");
$izraz->bindValue(":korisnik", $sifra); 
$izraz->execute();
$korisnik=$izraz->fetchALL(PDO::FETCH_OBJ);
foreach ($korisnik as $k) {
	$k->putanja=base64_encode(file_get_contents("http://localhost/infiniteloop/p3/" . $k->putanja));
}
echo json_encode($korisnik);