<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select * from skolarazred where skola=:skola and razred=:razred and odjeljenje=:odjeljenje");
$izraz->bindValue(":skola", $_POST['skola']); 
$izraz->bindValue(":razred", $_POST['razred']); 
$izraz->bindValue(":odjeljenje", $_POST['odjeljenje']); 
$izraz->execute();
$skolarazred=$izraz->fetch(PDO::FETCH_OBJ);
if ($skolarazred==null) {
$izraz=$veza->prepare("insert into skolarazred (skola, razred, odjeljenje) values(:skola, :razred, :odjeljenje)");
$izraz->bindValue(":skola", $_POST['skola']); 
$izraz->bindValue(":razred", $_POST['razred']); 
$izraz->bindValue(":odjeljenje", $_POST['odjeljenje']); 
$izraz->execute();
$id = $veza->lastInsertId();
$izraz=$veza->prepare("insert into profesorrazred (skolarazred, profesor) values($id, null)");
$izraz->execute();
echo "OK";
}
else  {
	echo "false";
}
