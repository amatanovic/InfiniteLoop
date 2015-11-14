<?php
include_once '../konfiguracija.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set("Europe/Zagreb");
$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$kor_ime = $request->kor_ime;
    @$lozinka = $request->lozinka;   
$izraz=$veza->prepare("select sifra from korisnik where kor_ime=:kor_ime and lozinka=:lozinka");
$izraz->bindValue(":kor_ime", $kor_ime); 
$izraz->bindValue(":lozinka", md5($lozinka));
$izraz->execute();
$korisnik=$izraz->fetch(PDO::FETCH_OBJ);
if ($korisnik == null ){
$izraz=$veza->prepare("select sifra from frizerski_salon where kor_ime=:kor_ime and lozinka=:lozinka");
$izraz->bindValue(":kor_ime", $kor_ime); 
$izraz->bindValue(":lozinka", md5($lozinka));
$izraz->execute();
$korisnik=$izraz->fetch(PDO::FETCH_OBJ);

if ($korisnik !=null ){
	echo json_encode($korisnik);
}
else {echo "false";}
}

else {
echo json_encode($korisnik);
}
