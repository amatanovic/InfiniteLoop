<?php include "head.php"; 
if (isset($_SESSION['autoriziran']->naziv) == null) {
	header("location: odjava.php");
}
?>

<body class="indexNadzorna">
	<div class="container-fluid">
		<header>
			<div class="navbar navbar-default">
    			<div class="navbar-collapse collapse navbar-responsive-collapse">
    				<h3><?php echo $_SESSION['autoriziran']->naziv; ?><span class="mdi-hardware-keyboard-arrow-down" style="color: #fff"></h3>
        			<ul class="nav navbar-nav navbar-right">
            			<li><a href="#">|	Arhiva Slika	|</a></li>
            			<li><a href="#">	Postavke	|</a></li>
            			<li><a href="#">	Odjava	|</a></li>
        			</ul>
    			</div>
 			</div>
 			<div class="row">
 				<p style="color: #fff; margin-left: 50px">Manuela Mikulecki</p>
 				<div class="thumbnail">
 					<img class="avatarNadzorna" src="avatar.jpg">
 					<div class="checkbox">
 						<label>
                        	<input type="checkbox">
                        	<span class="checkbox-material">
                        	<span class="check checkArhiva"></span><p>Manuela Mikulecki</p>
                        	</span>
                        </label>
                	</div>
 				</div>
 			</div>
		</header>
		<div class="row">
			<div class="col-md-8 divRaspored">
				<table class="table table-striped table-hover ">
				    <thead>
				        <tr>
				            <th>IME I PREZIME</th>
				            <th>USLUGA</th>
				            <th>TERMIN</th>
				            <th>SLIKA</th>
				        </tr>
				    </thead>
				    <tbody>
				        <tr>
				            <td>Manuela Mikulecki</td>
				            <td>šišanje duge kose</td>
				            <td>12.11.2015. <br> 09:00-09:30</td>
				            <td><span class="mdi-content-add-circle-outline" style="color: #c21e5c"></span></td>
				        </tr>
				    </tbody>
				</table>
			</div>
			<div class="col-md-4 divInformacije">
				<h2><?php echo $_SESSION['autoriziran']->naziv; ?></h2>
<?php 
$izraz=$veza->prepare("select naziv from mjesto where sifra=:sifra");
$izraz->bindValue(":sifra", $_SESSION['autoriziran']->mjesto);
$izraz->execute();
$mjesto=$izraz->fetch(PDO::FETCH_OBJ); ?>
				<address><span class="mdi-maps-place" style="color: black"></span><?php echo $_SESSION['autoriziran']->adresa . ", " . $mjesto->naziv; ?></address>
				<p><span class="mdi-maps-local-phone" style="color: black"></span><?php echo $_SESSION['autoriziran']->kontakt; ?></p>
				<p><img src="facebook.png"><?php echo $_SESSION['autoriziran']->facebook; ?></p>
				<h2>Usluge</h2>
				<ol>
					<li>šišanje kratke kose</li>
					<li>šišanje duge kose</li>
					<li>frizure (kratka kosa)</li>
					<li>frizure (duga kosa)</li>
				</ol>
			</div>
		</div>
	</div>
</body>