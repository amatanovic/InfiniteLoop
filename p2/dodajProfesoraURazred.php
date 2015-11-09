<?php
include_once 'konfiguracija.php';
$izraz = $veza->prepare("update profesorrazred set profesor=:profesor where sifra=:profesorrazred");
$izraz->execute(array(
		"profesorrazred" => $_POST["profesorrazred"],
		"profesor" => $_POST["profesor"]));
echo "OK";