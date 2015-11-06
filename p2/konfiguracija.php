<?php
$title = "Školska kuhinja";
$server="localhost";
$baza="skolskakuhinja";
$korisnik="root";
$lozinka="admin";
$putanja="/InfiniteLoop/p2/";
$veza=new PDO("mysql:host=" . $server . ";dbname=" . $baza,$korisnik,$lozinka);
$veza->exec("set names utf8;");
session_start();