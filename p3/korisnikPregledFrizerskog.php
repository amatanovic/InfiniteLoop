<?php include "head.php"; ?>
<body class="indexNadzorna">
	<div class="container-fluid">
		<header>
			<div class="navbar navbar-default">
    			<div class="navbar-collapse collapse navbar-responsive-collapse">
    				<h3><?php echo $_SESSION['autoriziran']->ime; ?></h3>
        			<ul class="nav navbar-nav navbar-right">
        				<li><a href="#">	Početna	|</a></li>
            			<li><a href="#">	Arhiva Slika	|</a></li>
            			<li><a href="#">	Kalendar	|</a></li>
            			<li><a href="odjava.php">	Odjava	|</a></li>
        			</ul>
    			</div>
 			</div>
		</header>
<?php 
$izraz=$veza->prepare("select * from frizerski_salon where sifra=:sifra");
$izraz->bindValue(":sifra", $_GET["sifra"]);
$izraz->execute();
$salon=$izraz->fetch(PDO::FETCH_OBJ); ?>
		<div class="row">
			<div class="col-md-8 divPostavke">	
				<h3 style="color: #c21e5c; text-align: center"><?php echo $salon->naziv; ?></h3>	
				<h3 style="color: #c21e5c; text-align: center">Usluge</h3>
				<ol>
					<li>Šišanje kratke kose</li>
				</ol>
			</div>
            <?php 
$izraz=$veza->prepare("select naziv from mjesto where sifra=:sifra");
$izraz->bindValue(":sifra", $salon->mjesto);
$izraz->execute();
$mjesto=$izraz->fetch(PDO::FETCH_OBJ); ?>
			<div class="col-md-4 divInformacije" style="height: 100%; margin-top: -20px">
				<address><span class="mdi-maps-place" style="color: black"></span><?php echo $salon->adresa . ", " . $mjesto->naziv; ?></address>
				<p><span class="mdi-maps-local-phone" style="color: black"></span><?php echo $salon->kontakt; ?></p>
				<p><img src="facebook.png"><?php echo $salon->facebook; ?></p>
				<div style="overflow:hidden;">
				    <div class="form-group">
				        <div class="row">
				            <div class="col-md-8">
				                <div id="datetimepicker12"></div>
				            </div>
				        </div>
				    </div>
				    
				</div>
				<div>

			    <h2>Djelatnici</h2>	
<?php  $izraz=$veza->prepare("select * from korisnik where salon=:sifra");
$izraz->bindValue(":sifra", $salon->sifra);
$izraz->execute();
$djelatnici=$izraz->fetchALL(PDO::FETCH_OBJ); 
foreach ($djelatnici as $djelatnik):
?>	
			    <div class="thumbnail">
 					<img class="avatarNadzorna" style="height:85px" src="<?php echo $djelatnik->avatar; ?>">
 					<div class="checkbox">
 						<label>
                        	<input type="checkbox"><p><?php echo $djelatnik->ime . " " . $djelatnik->prezime; ?></p>
                        </label>
                	</div>
 				</div> 
                <?php endforeach; ?>       
			</div>
		</div>
	</div>
 <?php include "scripts.php"; ?>
  <script type="text/javascript" src="bower_components/moment/min/moment.min.js"></script>
 <script type="text/javascript" src="bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript">
        $(function () {
            $('#datetimepicker12').datetimepicker({
                inline: true,
                sideBySide: false
            });
        });
    </script>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

    </body>

</html>
