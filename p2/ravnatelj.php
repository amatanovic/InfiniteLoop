<?php
include "head.php"; ?>

<body class="bodyRavnatelj">
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-md-12">
  <header class="headerRavnatelj">
  <h2>Dobrodošli</h2>      
  <h2 class="imeRavnatelja">Ravnatelj Ravnatović</h2>
  <input type="submit" name="registracija" value="Odjavi se" class="btn btn-default pull-right ravnateljBtn" />           
  </header>
</div>
</div>
<div class="row tablica">
	<div class="col-md-12">
		<h3><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Dodaj novi razred</h3>
		<div class="form-group input-group">
     	<div class="input-group">
  		<span class="input-group-addon" style="color: black">CIJENA:</span>
  		<input type="text" name="cijena" class="form-control" aria-describedby="basic-addon1" />
		</div>
	</div>
		<table class="table">
  <tr>
    <th>PROFESOR</th>
    <th>RAZRED</th>		
    <th>ODJELJENJE</th>
  </tr>
  <tr>
    <td>Jill</td>
    <td>Smith</td>		
    <td>50</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>		
    <td>94</td>
  </tr>
  <tr>
    <td>John</td>
    <td>Doe</td>		
    <td>80</td>
  </tr>
</table>
<input type="submit" name="promjeni" value="Pohrani promjene" class="btn btn-default pull-right" />
	</div>
</div>


     
    <!-- <div class="input-group statusProfesor" style="display:none">
      <span class="input-group-addon profil">Odaberite svoj razred</span>
       <select name="profesor" class="selectProfesor">
    
      </select>
    </div>
 <div class="input-group statusUcenik" style="display:none">
      <span class="input-group-addon profil">Odaberi svoj razred</span>
       <select name="ucenik" class="selectUcenik">
     
      </select>
    </div>
 <div class="input-group statusRoditelj" style="display:none">
      <span class="input-group-addon profil">Odaberite svog učenika</span>
       <select name="roditelj" class="selectRoditelj">
     
</select>
    </div> -->
    <div class="row">
      
  </div>

</div>
</div>
</body>