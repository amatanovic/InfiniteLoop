<?php
$title = "Frizerski salon";
$server="localhost";
$baza="frizer";
$korisnik="root";
$lozinka="admin";
$putanja="/InfiniteLoop/p3/";
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8;");
session_start();