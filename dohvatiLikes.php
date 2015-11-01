<?php
include_once 'konfiguracija.php';
$izraz=$veza->prepare("select COUNT(liked) as numberLikes from likezadaca where uploadzadaca=:uploadzadaca");
$izraz->bindParam(":uploadzadaca", $_POST["uploadzadaca"]);
$izraz->execute();
$likeovi=$izraz->fetch(PDO::FETCH_OBJ);
echo json_encode($likeovi);
