<?php include "head.php"; ?>
<body class="indexNadzorna">
	<div class="container-fluid">
		<header>
			<div class="navbar navbar-default">
    			<div class="navbar-collapse collapse navbar-responsive-collapse">
    				<h3>Korisnik Korisnik</h3>
        			<ul class="nav navbar-nav navbar-right">
        				<li><a href="#">	Početna	|</a></li>
            			<li><a href="#">	Arhiva Slika	|</a></li>
            			<li><a href="#">	Kalendar	|</a></li>
            			<li><a href="#">	Odjava	|</a></li>
        			</ul>
    			</div>
 			</div>
		</header>
		<div class="row">
			<div class="col-md-8 divPostavke">	
				<h3 style="color: #c21e5c; text-align: center">Frizerski salon Mata</h3>	
				<h3 style="color: #c21e5c; text-align: center">Usluge</h3>
				<ol>
					<li>Šišanje kratke kose</li>
				</ol>
			</div>
			<div class="col-md-4 divInformacije" style="height: 100%; margin-top: -20px">
				<address><span class="mdi-maps-place" style="color: black"></span>Gundulićeva 43b, Osijek</address>
				<p><span class="mdi-maps-local-phone" style="color: black"></span>091/375-487</p>
				<p><img src="facebook.png">http://facebook.com</p>
				<div style="overflow:hidden;">
				    <div class="form-group">
				        <div class="row">
				            <div class="col-md-8">
				                <div id="datetimepicker12"></div>
				            </div>
				        </div>
				    </div>
				    <script type="text/javascript">
				        $(function () {
				            $('#datetimepicker12').datetimepicker({
				                inline: true,
				                sideBySide: true
				            });
				        });
				    </script>
				</div>
			    <h2>Djelatnici</h2>		
			    <div class="thumbnail">
 					<img class="avatarNadzorna" src="avatar.jpg">
 					<div class="checkbox">
 						<label>
                        	<input type="checkbox"><p>Manuela Mikulecki</p>
                        </label>
                	</div>
 				</div>        
			</div>
		</div>
	</div>
</body>