<?php include "head.php"; 
if (isset($_SESSION['autoriziran']->salon) != null || !isset($_SESSION['autoriziran'])) {
  header("location: odjava.php");
}
?>
    <body class="bodyIndex">
        <div class="container">
           <p class="indexh2"> <?php echo $_SESSION['autoriziran']->ime; ?> <a href="arhivaSlikaKorisnik.php">Arhiva slika</a>
           <a href="">Kalendar</a><a href="odjava.php">Odjava</a> </p>
            <div class="rowIndex">
                    <div id="map_canvas"></div>
             

<?php include "scripts.php"; ?>
<script src="http://maps.googleapis.com/maps/api/js"></script>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
             var map;
    var elevator;
    var myOptions = {
        zoom: 12,
        center: new google.maps.LatLng(45.5511111, 18.6938889),
        mapTypeId: 'terrain'
    };
    map = new google.maps.Map($('#map_canvas')[0], myOptions);

    var addresses = ['osijek Vukovarska 270'];

    for (var x = 0; x < addresses.length; x++) {
        $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses[x]+'&sensor=false', null, function (data) {
            var p = data.results[0].geometry.location
            var latlng = new google.maps.LatLng(p.lat, p.lng);
            new google.maps.Marker({
                position: latlng,
                map: map
            });

        });
    }
            });
   


        </script>

    </body>

</html>
