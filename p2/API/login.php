<?php
include_once '../konfiguracija.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$email = $request->email;
    @$lozinka = $request->lozinka;   
$izraz=$veza->prepare("select sifra from korisnik where email=:email and lozinka=:lozinka and status=3 or email=:email and lozinka=:lozinka and status=4");
$izraz->bindValue(":email", $email); 
$izraz->bindValue(":lozinka", md5($lozinka));
$izraz->execute();
$korisnik=$izraz->fetch(PDO::FETCH_OBJ);
if ($korisnik == null ){
	echo "false";
}

else {
	echo json_encode($korisnik);
}