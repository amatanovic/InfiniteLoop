<?php 
/*
OVA DATOTEKA SLUŽI ZA PREUZIMANJE ŠKOLA 

header('Content-Type: text/html; charset=UTF-8');
set_time_limit(500);
include_once 'konfiguracija.php';
$string = file_get_contents("http://www.skole.hr/skole/popis?mod_instance=229_1150_0.html");
$doc = new DomDocument('1.0', 'utf-8');
@$doc->loadHTML($string);
$nodeElement = $doc->getElementsByTagName('option');
foreach ($nodeElement as $element) {
	if ($element->nodeValue != "Odaberite županiju") {
		$nazivZupanije = $element->nodeValue;
		$izraz=$veza->prepare("insert into zupanija (naziv) values ('$nazivZupanije')");
		$izraz->execute();
		$zupanijaID = $veza->lastInsertId();
		$uvjet = "č";
		$rezultat = strpos($element->nodeValue, $uvjet);
		if ($rezultat !== false) { 
			$element->nodeValue =str_replace("č","%E8",$element->nodeValue);	
		}
		$uvjet = "ž";
		$rezultat = strpos($element->nodeValue, $uvjet);
		if ($rezultat !== false) { 
			$element->nodeValue =str_replace("ž","%BE",$element->nodeValue);	
		}
		$uvjet = "đ";
		$rezultat = strpos($element->nodeValue, $uvjet);
		if ($rezultat !== false) { 
			$element->nodeValue =str_replace("đ","%F0",$element->nodeValue);	
		}
		$uvjet = "š";
		$rezultat = strpos($element->nodeValue, $uvjet);
		if ($rezultat !== false) { 
			$element->nodeValue =str_replace("š","%B9",$element->nodeValue);	
		}
		$uvjet = "Š";
		$rezultat = strpos($element->nodeValue, $uvjet);
		if ($rezultat !== false) { 
			$element->nodeValue =str_replace("Š","%A9",$element->nodeValue);	
		}
		$zupanija = file_get_contents("http://www.skole.hr/skole/popis?mod_instance=229_1150_0&pu_zupanija=" . $element->nodeValue);
		$newZ = new DomDocument('1.0', 'utf-8');
		@$newZ->loadHTML($zupanija);
		$gradovi = $newZ->getElementsByTagName('div');
		foreach ($gradovi as $grad) {
			if ($grad->getAttribute("class") == "ustanova_cont") {
				$popis = $grad->getElementsByTagName('span'); 
				foreach ($popis as $p) {
					if ($p->getAttribute("class") == "grad") {
						$nazivGrad = $p->nodeValue; 
						$izraz=$veza->prepare("insert into grad (naziv, zupanija) values ('$nazivGrad', $zupanijaID)");
						$izraz->execute();
						$gradID = $veza->lastInsertId();
						$skole = $grad->getElementsByTagName('a'); 
						foreach ($skole as $skola) {
						$nazivSkola = $skola->nodeValue;
						$izraz=$veza->prepare("insert into skola (naziv, grad) values ('$nazivSkola', $gradID)");
						$izraz->execute();
						}
					}
				
				}
			}
		}
	}
}
