<?php
$server="localhost";
$baza="omsdrustvenamreza";
$korisnik="root";
$lozinka="admin";
$putanja="/InfiniteLoop/";
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8;");
