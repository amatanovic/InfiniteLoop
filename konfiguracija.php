<?php
$title = "OMS Društvena mreža";
$server="localhost";
$baza="omsdm";
$korisnik="root";
$lozinka="admin";
$putanja="/InfiniteLoop/";
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8;");
