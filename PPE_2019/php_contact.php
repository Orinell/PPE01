<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <link href="CSS/PPE_CSS_2019.css" rel="stylesheet" type="text/css" /> 

    <!-- SCRIPT JS MAP -->     
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBswfZFa8_vUQJZN07vMouN16m_ltr7u-Y"></script>
	<script type="text/javascript">
        
		function initialize() {
			var mapOptions = {
				zoom: 10,
				scrollwheel: false,
				center: new google.maps.LatLng( 43.706313, 4.132194 )
			};

			var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            
            // MARQUEUR PARIS

			var infowindow1 = new google.maps.InfoWindow({
				content: "<h3>Centre équestre Les Genets</h3>"
            });
            

            var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';

            var marker = new google.maps.Marker({
                position: {lat:  43.706313,   lng: 4.132194},
                map: map,
                //icon: 'images/marker2.png'
            });
      

			marker.addListener('click', function() {
				infowindow1.open(map, marker);
            });

            infowindow1.open(map, marker);
            

        }

		google.maps.event.addDomListener(window, 'load', initialize);
		
    </script>
    <!-- SCRIPT JS MAP FIN --> 

    <title>Les Genets Acceuil</title>
    </head>

    <body>
        <div class="toppp">
            <!-- entete -->
            <div class ="entete">
                <font size="+4"><b><u><center>Centre Equestre LES GENETS</center></u></b></font>
            </div>

            <!-- menu -->
            <div class ="menu">
                <a href="php_acceuil.php"><input type="button" class="btn-success" value="Accueil" ></a>
                <a href="php_chevaux.php"><input type="button" class="btn-success" value="Chevaux" ></a>
                <a href="php_prestations.php"><input type="button" class="btn-success" value="Prestations" ></a>            
                <a href="php_contact.php"><input type="button" class="btn-success" value="Contact" ></a>
                <a href="php_espace_client.php"><input type="button" class="btn-success" value="Espace Client" ></a>
            </div>
        </div>
        
        <!-- pas des session sur cette page-->

        <div>
        <br><br><font size="+2"><b><center>Contact</center></b></font>
        <br><br><br><br>
        <b>Nous contacter : </b><br>
        Tel : 0467888888 <br>
        Mail : centrelesgenets@gmail.com <br>
       
        <br> <br>
        <b>Nos horraires d'ouvertures : </b><br>
        Du lundi au vendredi de 12h à 18h <br>
        Et le samedi et le dimanche de 8h à 18h <br>

        <br> <br>
        <b>Notre adresse : </b><br>
        10 route de villetelle 34400 Luenel France <br>

    
        </div>

        <!-- Image du centre/carte -->
        <div id="map">
			<!-- Ici s'affichera la carte -->
		</div>
        
    </body> 
</html>