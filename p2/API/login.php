<?php
include_once '../konfiguracija.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set("Europe/Zagreb");
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
$vrijeme = date ("m");
$izraz=$veza->prepare("select a.slika, b.proknjizeno from uplata a inner join uplatakorisnikprofesorrazred b on b.uplata=a.sifra inner join korisnikprofesorrazred c on c.sifra=b.korisnikprofesorrazred inner join ucenikroditelj d on d.sifra=c.ucenikroditelj inner join korisnik e on e.sifra=d.ucenik where e.sifra=:sifra and month(a.vrijeme)='$vrijeme'");
$izraz->bindValue(":sifra", $korisnik->sifra); 
$izraz->execute();
$sifra=$izraz->fetch(PDO::FETCH_OBJ);
if ($sifra!=null) {
echo json_encode($sifra);
}
else {
$vrijeme = date ("m");
$izraz=$veza->prepare("select a.slika, b.proknjizeno from uplata a inner join uplatakorisnikprofesorrazred b on b.uplata=a.sifra inner join korisnikprofesorrazred c on c.sifra=b.korisnikprofesorrazred inner join ucenikroditelj d on d.sifra=c.ucenikroditelj inner join korisnik e on e.sifra=d.roditelj where e.sifra=:sifra and month(a.vrijeme)='$vrijeme'");
$izraz->bindValue(":sifra", $korisnik->sifra); 
$izraz->execute();
$sifra=$izraz->fetch(PDO::FETCH_OBJ);	
if ($sifra!=null) {
	echo json_encode($sifra);
} 
else {
	echo json_encode("prazno");
}
}
}

