<?php include "head.php"; ?>
<body class="indexNadzorna">
	<div class="container-fluid">
		<header>
			<div class="navbar navbar-default">
    			<div class="navbar-collapse collapse navbar-responsive-collapse">
    				<h3>Frizerski salon Mata<span class="mdi-hardware-keyboard-arrow-down" style="color: #fff"></h3>
        			<ul class="nav navbar-nav navbar-right">
            			<li><a href="#">|	Arhiva Slika	|</a></li>
            			<li><a href="#">	Postavke	|</a></li>
            			<li><a href="#">	Odjava	|</a></li>
        			</ul>
    			</div>
 			</div>
 			<div class="row">
 				<p style="color: #fff; padding-left: 50px; padding-right: 15px; margin-right: 15px;">Manuela Mikulecki</p>
 				
 			</div>
		</header>
		<div class="row">
			<div class="col-md-8 divPostavke">
				<div class="row divPostavkeRed">
					<div class="col-md-6 dodajDjelatnika">
						<h3><span class="mdi-content-add-circle-outline"></span>Dodaj djelatnika</h3>
					</div>
					<div class="col-md-6">
						<form class="form-horizontal">
	                        <fieldset>
	                            <div class="form-group" style="margin: 5px; padding: 5px">                                
	                                <input type="text" class="form-control postavke" id="ime" placeholder="Ime">
	                            </div>
	                            <div class="form-group" style="margin: 5px; padding: 5px">
	                                <input type="text" class="form-control postavke" id="prezime" placeholder="Prezime">
	                            </div>
	                            <p style="color: #B6B6B6; margin-left: 11px">Dodaj avatar<span class="mdi-content-add-circle-outline"></span></p>
	                        </fieldset>
                    	</form>
					</div>
				</div>
				<div class="row divPostavkeRed">
					<div class="col-md-6 dodajDjelatnika">
						<h3><span class="mdi-content-add-circle-outline"></span>Dodaj kontakt</h3>
					</div>
					<div class="col-md-6">
						<form class="form-horizontal">
	                        <fieldset>
	                            <div class="form-group" style="margin: 5px; padding: 5px">                                
	                                <input type="text" class="form-control postavke" id="adresa" placeholder="Adresa">
	                            </div>
	                            <div class="form-group" style="margin: 5px; padding: 5px">
	                                <input type="text" class="form-control postavke" id="telefon" placeholder="Telefon">
	                            </div>
	                            <div class="form-group" style="margin: 5px; padding: 5px">
	                                <input type="text" class="form-control postavke" id="facebookLink" placeholder="Facebook link">
	                            </div>
	                        </fieldset>
                    	</form>
					</div>
				</div>
				<div class="row divPostavkeRed">
					<div class="col-md-6 dodajDjelatnika">
						<h3><span class="mdi-content-add-circle-outline"></span>Dodaj usluge</h3>
					</div>
					<div class="col-md-6">
						<form class="form-horizontal">
	                        <fieldset>
	                            <div class="checkbox">
				                    <label>
				                        <input type="checkbox">
				                        <span class="checkbox-material">
				                        	<span class="check"></span>
				                        </span> Šišanje kratke kose
				                    </label>
				                </div>
				                <div class="checkbox" style="padding-bottom: 30px">
				                    <label>
				                        <input type="checkbox">
				                        <span class="checkbox-material">
				                        	<span class="check"></span>
				                        </span> Šišanje duge kose
				                    </label>
				                </div>
				                <a href="#" id="prijava" class="btn btn-default">Spremi promjene</a> 
	                        </fieldset>
                    	</form>
					</div>
				</div>
			</div>
			<div class="col-md-4 divInformacije" style="height: 100%">
				<div class="thumbnail" style="padding-top: 40px">
					<span class="mdi-navigation-close" style="color: black"></span>
 					<img class="avatarNadzorna" src="avatar.jpg">
 					<div class="checkbox">
 						<label>
                        	<input type="checkbox"><p>Manuela Mikulecki</p>
                        </label>
                	</div>
 				</div>
 				<div class="thumbnail">
					<span class="mdi-navigation-close" style="color: black"></span>
 					<img class="avatarNadzorna" src="avatar.jpg">
 					<div class="checkbox">
 						<label>
                        	<input type="checkbox"><p>Andrea Mihaljević</p>
                        </label>
                	</div>
 				</div>
			</div>
		</div>
	</div>
</body>